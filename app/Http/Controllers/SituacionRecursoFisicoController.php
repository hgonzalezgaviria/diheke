<?php

namespace reservas\Http\Controllers;

use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Route;
use Illuminate\Routing\Redirector;

use reservas\SituacionRecursoFisico;

class SituacionRecursoFisicoController extends Controller
{
	public function __construct(Redirector $redirect=null)
	{
		//Requiere que el usuario inicie sesión.
		$this->middleware('auth');
		if(isset($redirect)){

			$action = Route::currentRouteAction();
			$role = isset(auth()->user()->role) ? auth()->user()->role : 'user';

			//Lista de acciones que solo puede realizar los administradores o los editores
			$arrActionsAdmin = array('index', 'create', 'edit', 'store', 'show', 'destroy');

			if(in_array(explode("@", $action)[1], $arrActionsAdmin))//Si la acción del controlador se encuentra en la lista de acciones de admin...
			{
				if( ! in_array($role , ['admin','editor']))//Si el rol no es admin o editor, se niega el acceso.
				{
					Session::flash('error', '¡Usuario no tiene permisos!');
					abort(403, '¡Usuario no tiene permisos!.');
				}
			}
		}
	}

	/**
	 * Muestra una lista de los registros.
	 *
	 * @return Response
	 */
	public function index()
	{
		//Se obtienen todos los registros.
		$sitRecursosFisicos = SituacionRecursoFisico::all();
		//Se carga la vista y se pasan los registros
		return view('situacionrecursofisico/index', compact('sitRecursosFisicos'));
	}

	/**
	 * Muestra el formulario para crear un nuevo registro.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('situacionrecursofisico/create');
	}

	/**
	 * Guarda el registro nuevo en la base de datos.
	 *
	 * @return Response
	 */
	public function store()
	{
		//Validación de datos
		$this->validate(request(), [
			'SIRF_DESCRIPCION' => ['required', 'max:300'],
		]);

		//Permite seleccionar los datos que se desean guardar.
		$sitRecursosFisicos = new SituacionRecursoFisico;
		$sitRecursosFisicos->SIRF_DESCRIPCION = Input::get('SIRF_DESCRIPCION');
        $sitRecursosFisicos->SIRF_CREADOPOR = auth()->user()->username;
        //Se guarda modelo
		$sitRecursosFisicos->save();

		// redirecciona al index de controlador
		Session::flash('message', 'Situacion Recurso Fisico '.$sitRecursosFisicos->SIRF_ID.' creado exitosamente!');
		return redirect()->to('situacionrecursofisico');
	}


	/**
	 * Muestra información de un registro.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($SIRF_ID, $id)
	{
		// Se obtiene el registro
		$pregunta = Pregunta::findOrFail($id);

		// Muestra la vista y pasa el registro
		return view('preguntas/show', compact('pregunta'));
	}


	/**
	 * Muestra el formulario para editar un registro en particular.
	 *
	 * @param  int  $SIRF_ID
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($SIRF_ID, $PREG_id)
	{
		// Se obtiene el registro
		$pregunta = Pregunta::findOrFail($PREG_id);

		$arrTiposPregunta = \DB::table('TIPOPREGUNTAS')
					->select('TIPOPREGUNTAS.*')
					->orderby('TIPOPREGUNTAS.TIPR_id')
					->get();

		// Muestra el formulario de edición y pasa el registro a editar
		return view('preguntas/edit', compact('pregunta', 'arrTiposPregunta'));
	}


	/**
	 * Actualiza un registro en la base de datos.
	 *
	 * @param  int  $SIRF_ID
	 * @param  int  $id
	 * @return Response
	 */
	public function update($SIRF_ID, $PREG_id)
	{
		//Validación de datos
		$this->validate(request(), [
			'PREG_texto' => ['required', 'max:255'],
			'TIPR_id' => ['required'],
		]);

		// Se obtiene el registro
		$pregunta = Pregunta::findOrFail($PREG_id);
		$pregunta->PREG_texto = Input::get('PREG_texto');

		$pregunta->TIPR_id = str_replace('object:', '', Input::get('TIPR_id'));
        $pregunta->PREG_modificadopor = auth()->user()->username;
		$pregunta->save();

		//Se guardan opciones de preguntas multiples.
		$itemPregsInput = request()->except(['_token','_method', 'PREG_texto', 'TIPR_id']);

		//Se separa el id de las preguntas del valor que se desa almacenar
		list($idPregsOpcsInput, $values) = array_divide($itemPregsInput);

		//Se deben separar las opciones existentes (itemPregsOld) de las nuevas (itemPregsNew) en la base de datos.
		$itemPregsOld = [];
		$itemPregsNew = [];
		foreach ($idPregsOpcsInput as $index => $idPregItem){
			if(str_contains($idPregItem, 'opc_old_')){
				$idPregItem = str_replace('opc_old_','', $idPregItem);
				$itemPregsOld = array_add($itemPregsOld, $idPregItem, $values[$index]);
			} elseif(str_contains($idPregItem, 'opc_new_')){
				$idPregItem = str_replace('opc_new_','', $idPregItem);
				$itemPregsNew = array_add($itemPregsNew, $idPregItem, $values[$index]);
			}
		}

		//1. Para las opciones existentes...
			//a. Se guardan las modificaciones
			if(isset($itemPregsOld)){
				foreach($itemPregsOld as $idPregOld => $newValue){
					(new PregItemController)->update($idPregOld, $newValue);
				}
			}

			//b. Se eliminan las opciones que no fueron incluídas en el campo cant_opc
			if(count($pregunta->itemPregs) > count($itemPregsOld)){
	        	$itemPregsCurrent = $pregunta->itemPregs;
				$iditemPregsOldInput = array_divide($itemPregsOld)[0];
				(new PregItemController)->destroyArray($itemPregsCurrent, $iditemPregsOldInput);
			}

		//2. Para los nuevos items...
		if(isset($itemPregsNew)){
			foreach($itemPregsNew as $newValue){
				(new PregItemController)->store($pregunta, $newValue);
			}
		}


		// redirecciona al index de controlador
		Session::flash('message', '¡Pregunta '.$PREG_id.' en encuesta '.$SIRF_ID.' actualizada exitosamente!');
		return redirect()->to('encuestas/'.$SIRF_ID);
	}

	/**
	 * Elimina un registro de la base de datos.
	 *
	 * @param  int  $SIRF_ID
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($SIRF_ID, $PREG_id, $showMsg=True)
	{
		isset($PREG_id->PREG_id) ? $preg = $PREG_id : $preg = Pregunta::findOrFail($PREG_id);

		if(!isset($SIRF_ID)) $SIRF_ID = $preg->encuesta->SIRF_ID;

		//Al borrar (SoftDeletes) una pregunta, se borran los items.
        foreach($preg->itemPregs as $itemPreg){
            (new PregItemController)->destroy($itemPreg);
        }

        foreach($preg->respuestas as $resp){
            (new RespuestaController)->destroy($resp);
        }

		// delete
		$preg->PREG_borradopor = auth()->user()->username;
		$preg->save();
		$preg->delete();

		$this->ordenar($SIRF_ID, false);

		// redirecciona al index de controlador
		if($showMsg){
			Session::flash('message', '¡Pregunta '.$PREG_id.' en encuesta '.$SIRF_ID.' borrada!');
			return redirect()->to('encuestas/'.$SIRF_ID);
		}
	}

		/**
	 * Elimina un registro de la base de datos.
	 *
	 * @param  int  $SIRF_ID
	 * @param  int  $id
	 * @return Response
	 */
	public function ordenar($SIRF_ID, $showMsg=True)
	{
		//Las preguntas pueden lllegar desde otro controlador ($SIRF_ID) o desde una vista (JSON).
		if(null !== Input::get('inputPreguntas'))
			$preguntas = json_decode(Input::get('inputPreguntas') ,JSON_NUMERIC_CHECK);
		else
			$preguntas = Pregunta::where('SIRF_ID',$SIRF_ID)
							->orderby('PREG_posicion')->get();

		foreach ($preguntas as $pos => $pregArray) {
			$preg = Pregunta::findOrFail((int)$pregArray['PREG_id']);
			if($preg->PREG_posicion != ($pos+1)){
				$preg->PREG_posicion = $pos + 1;
				$preg->save();
			}
		}

		// redirecciona al index de controlador
		if($showMsg)
			Session::flash('message', '¡Preguntas ordenadas!');
		return redirect()->to('encuestas/'.$SIRF_ID);
	}
}

