<?php

namespace reservas\Http\Controllers\Auth;

use reservas\Http\Controllers\Controller;

use Validator;
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
					Session::flash('alert-danger', '¡Usuario no tiene permisos!');
					abort(403, '¡Usuario no tiene permisos!.');
				}
			}
		}
	}

	/**
	 * Get a validator for an incoming registration request.
	 *
	 * @param  array  $data
	 * @return \Illuminate\Contracts\Validation\Validator
	 */
	protected function validator(array $data, $ROLE_ID = 0)
	{
		return Validator::make($data, [
			'ROLE_ROL' => ['required','max:15','unique:ROLES,ROLE_ROL,'.$ROLE_ID.',ROLE_ID'],
			'ROLE_DESCRIPCION' => ['required', 'max:255','unique:ROLES,ROLE_DESCRIPCION,'.$ROLE_ID.',ROLE_ID'],
		]);
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
		//Datos recibidos desde la vista.
		$request = request()->all();
		//Se valida que los datos recibidos cumplan los requerimientos necesarios.
		$validator = $this->validator($request);
		if( $validator->fails() ) {
			$this->throwValidationException(
				request(), $validator
			);
		}

		//Se crea el registro.
		$rol = Rol::create($request);

		//redirecciona al index de controlador
		Session::flash('alert-info', 'Rol '.$rol->ROLE_DESCRIPCION.' creado exitosamente.');
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
		//Datos recibidos desde la vista.
		$request = request()->all();
		//Se valida que los datos recibidos cumplan los requerimientos necesarios.
		$validator = $this->validator($request, $ROLE_ID);
		if( $validator->fails() ) {
			$this->throwValidationException(
				request(), $validator
			);
		}

		// Se obtiene el registro
		$rol = Rol::findOrFail($ROLE_ID);
		//y se actualiza con los datos recibidos.
		$rol->update(request()->except(['_token']));

		// redirecciona al index de controlador
		Session::flash('alert-info', 'Rol '.$rol->ROLE_DESCRIPCION.' modificado exitosamente.');
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
			Session::flash('modal-danger', 'Rol '.$rol->ROLE_DESCRIPCION.' no se puede borrar.');
			return redirect()->to('roles');
	    } else {

			$rol->delete();
			
			$opcBorrado = request()->get('opcBorrado');
			switch ($opcBorrado) {
				case 'moveRelations':
					$move_to_ROLE =  Rol::findOrFail(request()->get('roles'));
					foreach ($rol->usuarios as $usuario)
						$move_to_ROLE->usuarios()->save($usuario);
					break;
				case 'deleteRelations':
					$rol->usuarios()->delete(); //Pendiente registrar USER_eliminadopor	
					break;
			}


			// redirecciona al index de controlador
			if($showMsg){
				Session::flash('alert-info', 'Rol '.$rol->ROLE_DESCRIPCION.' eliminado exitosamente.');
				return redirect()->to('roles');
			}
		}
	}


	/**
	 * 
	 *
	 * @param  int  $ROLE_ID
	 * @return Response
	 */
	public function getUsuarios($ROLE_ID)
	{
		$rol = Rol::findOrFail($ROLE_ID);
		$contUsuarios = $rol->usuarios->count();
		return $contUsuarios;
	}

	/**
	 * 
	 *
	 * @return Response
	 */
	public function getRoles()
	{
		//Se crea un array con los roles disponibles
		$arrRoles = model_to_array(Rol::class, 'ROLE_DESCRIPCION');
		return json_encode($arrRoles);
	}


}

