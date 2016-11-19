<?php

namespace reservas\Http\Controllers;

use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Route;
use Illuminate\Routing\Redirector;

use reservas\RecursoFisico;
use reservas\SituacionRecursoFisico;
use reservas\TipoRecursoFisico;
use reservas\TipoPosesion;
use reservas\EspacioFisico;

class RecursoFisicoController extends Controller
{
	public function __construct(Redirector $redirect=null)
	{
		//Requiere que el usuario inicie sesión.
		$this->middleware('auth');
		if(isset($redirect)){

			$action = Route::currentRouteAction();
			$role = isset(auth()->user()->rol->ROLE_rol) ? auth()->user()->rol->ROLE_rol : 'user';

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
		$recursosFisicos = RecursoFisico::all();

		//Se carga la vista y se pasan los registros
		return view('recursofisico/index', compact('recursosFisicos'));
	}

	/**
	 * Muestra el formulario para crear un nuevo registro.
	 *
	 * @return Response
	 */
	public function create()
	{

		$situacionesRecursosFisicos = SituacionRecursoFisico::all();
		$arrSituacionesRecursosFisicos = [];
		foreach ($situacionesRecursosFisicos as $situacion) {
			$arrSituacionesRecursosFisicos = array_add(
				$arrSituacionesRecursosFisicos,
				$situacion->SIRF_ID,
				$situacion->SIRF_DESCRIPCION
			);
		}
		
		$tiposRecursosFisicos = TipoRecursoFisico::all();
		$arrTiposRecursosFisicos = [];
		foreach ($tiposRecursosFisicos as $tipo) {
			$arrTiposRecursosFisicos = array_add(
				$arrTiposRecursosFisicos,
				$tipo->TIRF_ID,
				$tipo->TIRF_DESCRIPCION
			);
		}
		
		$tiposPosesiones = TipoPosesion::all();
		$arrTiposPosesiones = [];
		foreach ($tiposPosesiones as $tipo) {
			$arrTiposPosesiones = array_add(
				$arrTiposPosesiones,
				$tipo->TIPO_ID,
				$tipo->TIPO_DESCRIPCION
			);
		}

		$espaciosFisicos = EspacioFisico::all();
		$arrEspaciosFisicos = [];
		foreach ($espaciosFisicos as $espacio) {
			$arrEspaciosFisicos = array_add(
				$arrEspaciosFisicos,
				$espacio->ESFI_ID,
				$espacio->ESFI_DESCRIPCION
			);
		}
		return view('recursofisico/create', compact(
			'arrSituacionesRecursosFisicos',
			'arrTiposRecursosFisicos',
			'arrTiposPosesiones',
			'arrEspaciosFisicos'
			));
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

			'REFI_NOMENCLATURA' => ['required', 'max:20'],
			'REFI_CAPACIDADMAXIMA' => ['required', 'numeric'],
			'REFI_TIPOASIGNACION' => ['required', 'max:1'],
			'REFI_DESCRIPCION' => ['required', 'max:100'],
			'REFI_NIVEL' => ['required', 'max:25'],
			'REFI_ESTADO' => ['required', 'max:20'],
			'REFI_CAPACIDADREAL' => ['required', 'numeric'],
			'REFI_PRESTABLE' => ['boolean'],
			'REFI_AREAREAL' => ['required', 'numeric'],
			'REFI_AREAUSADA' => ['required', 'numeric'],

			'SIRF_ID' => ['required'],
			'TIRF_ID' => ['required'],
			'TIPO_ID' => ['required'],
			'ESFI_ID' => ['required'],
		]);

		//Permite seleccionar los datos que se desean guardar.
		$recursoFisico = new RecursoFisico;
		$recursoFisico->REFI_NOMENCLATURA = Input::get('REFI_NOMENCLATURA');
		$recursoFisico->REFI_CAPACIDADMAXIMA = Input::get('REFI_CAPACIDADMAXIMA');
		$recursoFisico->REFI_TIPOASIGNACION = Input::get('REFI_TIPOASIGNACION');
		$recursoFisico->REFI_DESCRIPCION = Input::get('REFI_DESCRIPCION');
		$recursoFisico->REFI_NIVEL = Input::get('REFI_NIVEL');
		$recursoFisico->REFI_ESTADO = Input::get('REFI_ESTADO');
		$recursoFisico->REFI_CAPACIDADREAL = Input::get('REFI_CAPACIDADREAL');

		$recursoFisico->REFI_PRESTABLE =  (Input::get('REFI_PRESTABLE')) ? true : false;

		$recursoFisico->REFI_AREAREAL = Input::get('REFI_AREAREAL');
		$recursoFisico->REFI_AREAUSADA = Input::get('REFI_AREAUSADA');

		$recursoFisico->SIRF_ID = Input::get('SIRF_ID'); //Relación con SITUACIONRECURSOFISICO
		$recursoFisico->TIRF_ID = Input::get('TIRF_ID'); //Relación con TIPORECURSOFISICO
		$recursoFisico->TIPO_ID = Input::get('TIPO_ID'); //Relación con TipoPosesion
		$recursoFisico->ESFI_ID = Input::get('ESFI_ID'); //Relación con ESPACIOFISICO

        $recursoFisico->REFI_CREADOPOR = auth()->user()->username;
        //Se guarda modelo
		$recursoFisico->save();

		// redirecciona al index de controlador
		Session::flash('message', 'Espacio Fisico '.$recursoFisico->REFI_ID.' creado exitosamente!');
		return redirect()->to('recursofisico');
	}


	/**
	 * Muestra información de un registro.
	 *
	 * @param  int  $REFI_ID
	 * @return Response
	 */
	public function show($REFI_ID)
	{
		// Se obtiene el registro
		$recursoFisico = RecursoFisico::findOrFail($REFI_ID);

		// Muestra la vista y pasa el registro
		return view('recursofisico/show', compact('recursoFisico'));
	}


	/**
	 * Muestra el formulario para editar un registro en particular.
	 *
	 * @param  int  $REFI_ID
	 * @return Response
	 */
	public function edit($REFI_ID)
	{
		// Se obtiene el registro a modificar
		$recursoFisico = RecursoFisico::findOrFail($REFI_ID);


		$situacionesRecursosFisicos = SituacionRecursoFisico::all();
		$arrSituacionesRecursosFisicos = [];
		foreach ($situacionesRecursosFisicos as $situacion) {
			$arrSituacionesRecursosFisicos = array_add(
				$arrSituacionesRecursosFisicos,
				$situacion->SIRF_ID,
				$situacion->SIRF_DESCRIPCION
			);
		}
		
		$tiposRecursosFisicos = TipoRecursoFisico::all();
		$arrTiposRecursosFisicos = [];
		foreach ($tiposRecursosFisicos as $tipo) {
			$arrTiposRecursosFisicos = array_add(
				$arrTiposRecursosFisicos,
				$tipo->TIRF_ID,
				$tipo->TIRF_DESCRIPCION
			);
		}
		
		$tiposPosesiones = TipoPosesion::all();
		$arrTiposPosesiones = [];
		foreach ($tiposPosesiones as $tipo) {
			$arrTiposPosesiones = array_add(
				$arrTiposPosesiones,
				$tipo->TIPO_ID,
				$tipo->TIPO_DESCRIPCION
			);
		}

		$espaciosFisicos = EspacioFisico::all();
		$arrEspaciosFisicos = [];
		foreach ($espaciosFisicos as $espacio) {
			$arrEspaciosFisicos = array_add(
				$arrEspaciosFisicos,
				$espacio->ESFI_ID,
				$espacio->ESFI_DESCRIPCION
			);
		}

		// Muestra el formulario de edición y pasa el registro a editar
		// y arreglos para llenar los Selects
		return view('recursofisico/edit', compact(
			'recursoFisico',
			'arrSituacionesRecursosFisicos',
			'arrTiposRecursosFisicos',
			'arrTiposPosesiones',
			'arrEspaciosFisicos'
			));
	}


	/**
	 * Actualiza un registro en la base de datos.
	 *
	 * @param  int  $REFI_ID
	 * @return Response
	 */
	public function update($REFI_ID)
	{
		//Validación de datos
		$this->validate(request(), [

			'REFI_NOMENCLATURA' => ['required', 'max:20'],
			'REFI_CAPACIDADMAXIMA' => ['required', 'numeric'],
			'REFI_TIPOASIGNACION' => ['required', 'max:1'],
			'REFI_DESCRIPCION' => ['required', 'max:100'],
			'REFI_NIVEL' => ['required', 'max:25'],
			'REFI_ESTADO' => ['required', 'max:20'],
			'REFI_CAPACIDADREAL' => ['required', 'numeric'],
			'REFI_PRESTABLE' => ['boolean'],
			'REFI_AREAREAL' => ['required', 'numeric'],
			'REFI_AREAUSADA' => ['required', 'numeric'],

			'SIRF_ID' => ['required'],
			'TIRF_ID' => ['required'],
			'TIPO_ID' => ['required'],
			'ESFI_ID' => ['required'],
		]);

		// Se obtiene el registro
		$recursoFisico = RecursoFisico::findOrFail($REFI_ID);

		$recursoFisico->REFI_NOMENCLATURA = Input::get('REFI_NOMENCLATURA');
		$recursoFisico->REFI_CAPACIDADMAXIMA = Input::get('REFI_CAPACIDADMAXIMA');
		$recursoFisico->REFI_TIPOASIGNACION = Input::get('REFI_TIPOASIGNACION');
		$recursoFisico->REFI_DESCRIPCION = Input::get('REFI_DESCRIPCION');
		$recursoFisico->REFI_NIVEL = Input::get('REFI_NIVEL');
		$recursoFisico->REFI_ESTADO = Input::get('REFI_ESTADO');
		$recursoFisico->REFI_CAPACIDADREAL = Input::get('REFI_CAPACIDADREAL');
		$recursoFisico->REFI_PRESTABLE =  (Input::get('REFI_PRESTABLE')) ? true : false;
		$recursoFisico->REFI_AREAREAL = Input::get('REFI_AREAREAL');
		$recursoFisico->REFI_AREAUSADA = Input::get('REFI_AREAUSADA');

		$recursoFisico->SIRF_ID = Input::get('SIRF_ID'); //Relación con SITUACIONRECURSOFISICO
		$recursoFisico->TIRF_ID = Input::get('TIRF_ID'); //Relación con TIPORECURSOFISICO
		$recursoFisico->TIPO_ID = Input::get('TIPO_ID'); //Relación con TipoPosesion
		$recursoFisico->ESFI_ID = Input::get('ESFI_ID'); //Relación con ESPACIOFISICO
        $recursoFisico->REFI_MODIFICADOPOR = auth()->user()->username;
        //Se guarda modelo
		$recursoFisico->save();

		// redirecciona al index de controlador
		Session::flash('message', 'Espacio Fisico '.$recursoFisico->REFI_ID.' modificado exitosamente!');
		return redirect()->to('recursofisico');
	}

	/**
	 * Elimina un registro de la base de datos.
	 *
	 * @param  int  $REFI_ID
	 * @return Response
	 */
	public function destroy($REFI_ID, $showMsg=True)
	{
		$recursoFisico = RecursoFisico::findOrFail($REFI_ID);

		// delete
        $recursoFisico->REFI_ELIMINADOPOR = auth()->user()->username;
		$recursoFisico->save();
		$recursoFisico->delete();

		// redirecciona al index de controlador
		if($showMsg){
			Session::flash('message', 'Espacio Fisico '.$recursoFisico->REFI_ID.' eliminado exitosamente!');
			return redirect()->to('recursofisico');
		}
	}


}

