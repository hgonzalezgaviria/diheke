<?php

namespace reservas\Http\Controllers\Auth;

use reservas\Http\Controllers\Controller;

use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Route;
use Illuminate\Routing\Redirector;

use reservas\Rol;

class RolController extends Controller
{
	public function __construct(Redirector $redirect=null)
	{
		//Requiere que el usuario inicie sesión.
		$this->middleware('auth');
		
		if(!auth()->guest() && isset($redirect)){
			$action = Route::currentRouteAction();
			$role = isset(auth()->user()->rol->ROLE_ROL) ? auth()->user()->rol->ROLE_ROL : 'user';

			//Lista de acciones que solo puede realizar los administradores o los editores
			$arrActionsAdmin = array('index', 'create', 'edit', 'store', 'show', 'destroy');

			if(in_array(explode("@", $action)[1], $arrActionsAdmin))//Si la acción del controlador se encuentra en la lista de acciones de admin...
			{
				if( ! in_array($role , ['admin']))//Si el rol no es admin, se niega el acceso.
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
		$roles = Rol::orderBy('ROLE_ID')->get();
		//Se carga la vista y se pasan los registros
		return view('auth/roles/index', compact('roles'));
	}

	/**
	 * Muestra el formulario para crear un nuevo registro.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('auth/roles/create');
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
			'ROLE_ROL' => 'required|max:15|unique:ROLES',
			'ROLE_DESCRIPCION' => ['required', 'max:255'],
		]);

		//Permite seleccionar los datos que se desean guardar.
		$rol = new Rol;
		$rol->ROLE_ROL = Input::get('ROLE_ROL');
		$rol->ROLE_DESCRIPCION = Input::get('ROLE_DESCRIPCION');
        $rol->ROLE_CREADOPOR = auth()->user()->username;
        //Se guarda modelo
		$rol->save();

		// redirecciona al index de controlador
		Session::flash('message', 'Rol '.$rol->ROLE_DESCRIPCION.' creado exitosamente!');
		return redirect()->to('roles');
	}


	/**
	 * Muestra el formulario para editar un registro en particular.
	 *
	 * @param  int  $ROLE_ID
	 * @return Response
	 */
	public function edit($ROLE_ID)
	{
		// Se obtiene el registro
		$rol = Rol::findOrFail($ROLE_ID);

		// Muestra el formulario de edición y pasa el registro a editar
		return view('auth/roles/edit', compact('rol'));
	}


	/**
	 * Actualiza un registro en la base de datos.
	 *
	 * @param  int  $ROLE_ID
	 * @return Response
	 */
	public function update($ROLE_ID)
	{
		//Validación de datos
		$this->validate(request(), [
			'ROLE_ROL' => 'required|max:15|unique:ROLES',
			'ROLE_DESCRIPCION' => ['required', 'max:300'],
		]);

		// Se obtiene el registro
		$rol = Rol::findOrFail($ROLE_ID);

		$rol->ROLE_ROL = Input::get('ROLE_ROL');
		$rol->ROLE_DESCRIPCION = Input::get('ROLE_DESCRIPCION');
        $rol->ROLE_MODIFICADOPOR = auth()->user()->username;
        //Se guarda modelo
		$rol->save();

		// redirecciona al index de controlador
		Session::flash('message', 'Rol '.$rol->ROLE_DESCRIPCION.' modificado exitosamente!');
		return redirect()->to('roles');
	}

	/**
	 * Elimina un registro de la base de datos.
	 *
	 * @param  int  $ROLE_ID
	 * @return Response
	 */
	public function destroy($ROLE_ID, $showMsg=True)
	{
		$rol = Rol::findOrFail($ROLE_ID);

		//Si la encuesta fue creada por SYSTEM, no se puede borrar.
		if($rol->ROLE_CREADOPOR == 'SYSTEM'){
			Session::flash('error', 'Rol '.$rol->ROLE_DESCRIPCION.' no se puede borrar!');
			return redirect()->to('roles');
	    } else {

	        $rol->ROLE_ELIMINADOPOR = auth()->user()->username;
			$rol->save();
			$rol->delete();

			// redirecciona al index de controlador
			if($showMsg){
				Session::flash('message', 'Rol '.$rol->ROLE_DESCRIPCION.' eliminado exitosamente!');
				return redirect()->to('roles');
			}
		}
	}


}

