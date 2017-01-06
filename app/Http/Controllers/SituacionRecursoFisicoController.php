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
			$role = isset(auth()->user()->rol->ROLE_ROL) ? auth()->user()->rol->ROLE_ROL : 'user';

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
		$sitRecursoFisico = new SituacionRecursoFisico;
		$sitRecursoFisico->SIRF_DESCRIPCION = Input::get('SIRF_DESCRIPCION');
        $sitRecursoFisico->SIRF_CREADOPOR = auth()->user()->username;
        //Se guarda modelo
		$sitRecursoFisico->save();

		// redirecciona al index de controlador
		Session::flash('message', 'Situación Recurso Físico '.$sitRecursoFisico->SIRF_ID.' creado exitosamente!');
		return redirect()->to('situacionrecursofisico');
	}


	/**
	 * Muestra información de un registro.
	 *
	 * @param  int  $SIRF_ID
	 * @return Response
	 */
	public function show($SIRF_ID)
	{
		// Se obtiene el registro
		$sitRecursoFisico = SituacionRecursoFisico::findOrFail($SIRF_ID);

		// Muestra la vista y pasa el registro
		return view('situacionrecursofisico/show', compact('sitRecursoFisico'));
	}


	/**
	 * Muestra el formulario para editar un registro en particular.
	 *
	 * @param  int  $SIRF_ID
	 * @return Response
	 */
	public function edit($SIRF_ID)
	{
		// Se obtiene el registro
		$sitRecursoFisico = SituacionRecursoFisico::findOrFail($SIRF_ID);

		// Muestra el formulario de edición y pasa el registro a editar
		return view('situacionrecursofisico/edit', compact('sitRecursoFisico'));
	}


	/**
	 * Actualiza un registro en la base de datos.
	 *
	 * @param  int  $SIRF_ID
	 * @return Response
	 */
	public function update($SIRF_ID)
	{
		//Validación de datos
		$this->validate(request(), [
			'SIRF_DESCRIPCION' => ['required', 'max:300'],
		]);

		// Se obtiene el registro
		$sitRecursoFisico = SituacionRecursoFisico::findOrFail($SIRF_ID);

		$sitRecursoFisico->SIRF_DESCRIPCION = Input::get('SIRF_DESCRIPCION');
        $sitRecursoFisico->SIRF_MODIFICADOPOR = auth()->user()->username;
        //Se guarda modelo
		$sitRecursoFisico->save();

		// redirecciona al index de controlador
		Session::flash('message', 'Situación Recurso Físico '.$sitRecursoFisico->SIRF_ID.' modificado exitosamente!');
		return redirect()->to('situacionrecursofisico');
	}

	/**
	 * Elimina un registro de la base de datos.
	 *
	 * @param  int  $SIRF_ID
	 * @return Response
	 */
	public function destroy($SIRF_ID, $showMsg=True)
	{
		$sitRecursoFisico = SituacionRecursoFisico::findOrFail($SIRF_ID);

		// delete
        $sitRecursoFisico->SIRF_ELIMINADOPOR = auth()->user()->username;
		$sitRecursoFisico->save();
		$sitRecursoFisico->delete();

		// redirecciona al index de controlador
		if($showMsg){
			Session::flash('message', 'Situación Recurso Físico '.$sitRecursoFisico->SIRF_ID.' eliminado exitosamente!');
			return redirect()->to('situacionrecursofisico');
		}
	}


}

