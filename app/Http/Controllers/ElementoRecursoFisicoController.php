<?php

namespace reservas\Http\Controllers;

use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Route;
use Illuminate\Routing\Redirector;

use reservas\ElementoRecursoFisico;
use reservas\EstadoElementoRecursoFisico;

class ElementoRecursoFisicoController extends Controller
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
		$elemRecursosFisicos = ElementoRecursoFisico::all();

		//Se carga la vista y se pasan los registros
		return view('elementorecursofisico/index', compact('elemRecursosFisicos'));
	}

	/**
	 * Muestra el formulario para crear un nuevo registro.
	 *
	 * @return Response
	 */
	public function create()
	{

		$estadosElemRecursosFisicos = EstadoElementoRecursoFisico::all();

		$arrEstados = [];
		foreach ($estadosElemRecursosFisicos as $estado) {
			$arrEstados = array_add(
				$arrEstados,
				$estado->EERF_ID,
				$estado->EERF_DESCRIPCION
			);
		}

		return view('elementorecursofisico/create', compact('arrEstados'));
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
			'ELRF_DESCRIPCION' => ['required', 'max:300'],
			'EERF_ID' => ['required'],
		]);

		//Permite seleccionar los datos que se desean guardar.
		$elemRecursoFisico = new ElementoRecursoFisico;
		$elemRecursoFisico->ELRF_DESCRIPCION = Input::get('ELRF_DESCRIPCION');
		$elemRecursoFisico->EERF_ID = Input::get('EERF_ID');
        $elemRecursoFisico->ELRF_CREADOPOR = auth()->user()->username;
        //Se guarda modelo
		$elemRecursoFisico->save();

		// redirecciona al index de controlador
		Session::flash('message', 'Elemento Recurso Físico '.$elemRecursoFisico->ELRF_ID.' creado exitosamente!');
		return redirect()->to('elementorecursofisico');
	}


	/**
	 * Muestra información de un registro.
	 *
	 * @param  int  $ELRF_ID
	 * @return Response
	 */
	public function show($ELRF_ID)
	{
		// Se obtiene el registro
		$elemRecursoFisico = ElementoRecursoFisico::findOrFail($ELRF_ID);

		// Muestra la vista y pasa el registro
		return view('elementorecursofisico/show', compact('elemRecursoFisico'));
	}


	/**
	 * Muestra el formulario para editar un registro en particular.
	 *
	 * @param  int  $ELRF_ID
	 * @return Response
	 */
	public function edit($ELRF_ID)
	{
		// Se obtiene el registro
		$elemRecursoFisico = ElementoRecursoFisico::findOrFail($ELRF_ID);

		$estadosElemRecursosFisicos = EstadoElementoRecursoFisico::all();
		$arrEstados = [];
		foreach ($estadosElemRecursosFisicos as $estado) {
			$arrEstados = array_add(
				$arrEstados,
				$estado->EERF_ID,
				$estado->EERF_DESCRIPCION
			);
		}

		// Muestra el formulario de edición y pasa el registro a editar
		return view('elementorecursofisico/edit', compact('elemRecursoFisico', 'arrEstados'));
	}


	/**
	 * Actualiza un registro en la base de datos.
	 *
	 * @param  int  $ELRF_ID
	 * @return Response
	 */
	public function update($ELRF_ID)
	{
		//Validación de datos
		$this->validate(request(), [
			'ELRF_DESCRIPCION' => ['required', 'max:300'],
			'EERF_ID' => ['required'],
		]);

		// Se obtiene el registro
		$elemRecursoFisico = ElementoRecursoFisico::findOrFail($ELRF_ID);

		$elemRecursoFisico->ELRF_DESCRIPCION = Input::get('ELRF_DESCRIPCION');
		$elemRecursoFisico->EERF_ID = Input::get('EERF_ID');
        $elemRecursoFisico->ELRF_MODIFICADOPOR = auth()->user()->username;
        //Se guarda modelo
		$elemRecursoFisico->save();

		// redirecciona al index de controlador
		Session::flash('message', 'Elemento Recurso Físico '.$elemRecursoFisico->ELRF_ID.' modificado exitosamente!');
		return redirect()->to('elementorecursofisico');
	}

	/**
	 * Elimina un registro de la base de datos.
	 *
	 * @param  int  $ELRF_ID
	 * @return Response
	 */
	public function destroy($ELRF_ID, $showMsg=True)
	{
		$elemRecursoFisico = ElementoRecursoFisico::findOrFail($ELRF_ID);

		// delete
        $elemRecursoFisico->ELRF_ELIMINADOPOR = auth()->user()->username;
		$elemRecursoFisico->save();
		$elemRecursoFisico->delete();

		// redirecciona al index de controlador
		if($showMsg){
			Session::flash('message', 'Elemento Recurso Físico '.$elemRecursoFisico->ELRF_ID.' eliminado exitosamente!');
			return redirect()->to('elementorecursofisico');
		}
	}


}

