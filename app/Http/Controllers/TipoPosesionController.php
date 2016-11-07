<?php

namespace reservas\Http\Controllers;

use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Route;
use Illuminate\Routing\Redirector;

use reservas\TipoPosesion;

class TipoPosesionController extends Controller
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
		$tiposPosesiones = TipoPosesion::all();
		//Se carga la vista y se pasan los registros
		return view('tipoposesion/index', compact('tiposPosesiones'));
	}

	/**
	 * Muestra el formulario para crear un nuevo registro.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('tipoposesion/create');
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
			'TIPO_DESCRIPCION' => ['required', 'max:300'],
		]);

		//Permite seleccionar los datos que se desean guardar.
		$tipoPosesion = new TipoPosesion;
		$tipoPosesion->TIPO_DESCRIPCION = Input::get('TIPO_DESCRIPCION');

		if(null !== Input::get('TIPO_CENTRODEPRACTICA')){
			$tipoPosesion->TIPO_CENTRODEPRACTICA = true;
		} else {
			$tipoPosesion->TIPO_CENTRODEPRACTICA = false;
		}

        $tipoPosesion->TIPO_CREADOPOR = auth()->user()->username;
        //Se guarda modelo
		$tipoPosesion->save();

		// redirecciona al index de controlador
		Session::flash('message', 'Tipo de Posesión '.$tipoPosesion->TIPO_ID.' creado exitosamente!');
		return redirect()->to('tipoposesion');
	}


	/**
	 * Muestra información de un registro.
	 *
	 * @param  int  $TIPO_ID
	 * @return Response
	 */
	public function show($TIPO_ID)
	{
		// Se obtiene el registro
		$tipoPosesion = TipoPosesion::findOrFail($TIPO_ID);

		// Muestra la vista y pasa el registro
		return view('tipoposesion/show', compact('tipoPosesion'));
	}


	/**
	 * Muestra el formulario para editar un registro en particular.
	 *
	 * @param  int  $TIPO_ID
	 * @return Response
	 */
	public function edit($TIPO_ID)
	{
		// Se obtiene el registro
		$tipoPosesion = TipoPosesion::findOrFail($TIPO_ID);

		// Muestra el formulario de edición y pasa el registro a editar
		return view('tipoposesion/edit', compact('tipoPosesion'));
	}


	/**
	 * Actualiza un registro en la base de datos.
	 *
	 * @param  int  $TIPO_ID
	 * @return Response
	 */
	public function update($TIPO_ID)
	{
		//Validación de datos
		$this->validate(request(), [
			'TIPO_DESCRIPCION' => ['required', 'max:300'],
		]);

		// Se obtiene el registro
		$tipoPosesion = TipoPosesion::findOrFail($TIPO_ID);

		$tipoPosesion->TIPO_DESCRIPCION = Input::get('TIPO_DESCRIPCION');

		if(null !== Input::get('TIPO_CENTRODEPRACTICA')){
			$tipoPosesion->TIPO_CENTRODEPRACTICA = true;
		} else {
			$tipoPosesion->TIPO_CENTRODEPRACTICA = false;
		}

        $tipoPosesion->TIPO_MODIFICADOPOR = auth()->user()->username;
        //Se guarda modelo
		$tipoPosesion->save();

		// redirecciona al index de controlador
		Session::flash('message', 'Tipo de Posesión '.$tipoPosesion->TIPO_ID.' modificado exitosamente!');
		return redirect()->to('tipoposesion');
	}

	/**
	 * Elimina un registro de la base de datos.
	 *
	 * @param  int  $TIPO_ID
	 * @return Response
	 */
	public function destroy($TIPO_ID, $showMsg=True)
	{
		$tipoPosesion = TipoPosesion::findOrFail($TIPO_ID);

		try {
			// delete
	        $tipoPosesion->TIPO_ELIMINADOPOR = auth()->user()->username;
			$tipoPosesion->save();
			$tipoPosesion->delete();
		}
		catch (\Illuminate\Database\QueryException $e) {
	        if($e->getCode() == "23000"){ //23000 is sql code for integrity constraint violation
	            abort(400, '¡Error 23000 (sql code): Integrity constraint violation!.');
	        }
		}

		// redirecciona al index de controlador
		if($showMsg){
			Session::flash('message', 'Tipo de Posesión '.$tipoPosesion->TIPO_ID.' eliminado exitosamente!');
			return redirect()->to('tipoposesion');
		}
	}


}

