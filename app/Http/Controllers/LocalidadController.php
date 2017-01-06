<?php

namespace reservas\Http\Controllers;

use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Route;
use Illuminate\Routing\Redirector;

use reservas\Localidad;
use reservas\TipoPosesion;

class LocalidadController extends Controller
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
		$localidades = Localidad::all();

		//Se carga la vista y se pasan los registros
		return view('localidad/index', compact('localidades'));
	}

	/**
	 * Muestra el formulario para crear un nuevo registro.
	 *
	 * @return Response
	 */
	public function create()
	{

		$tiposPosesiones = TipoPosesion::all();

		$arrTiposPosesiones = [];
		foreach ($tiposPosesiones as $tipos) {
			$arrTiposPosesiones = array_add(
				$arrTiposPosesiones,
				$tipos->TIPO_ID,
				$tipos->TIPO_DESCRIPCION
			);
		}

		return view('localidad/create', compact('arrTiposPosesiones'));
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
			'LOCA_DESCRIPCION' => ['required', 'max:300'],
			'LOCA_AREA' => ['required', 'max:300'],
			'TIPO_ID' => ['required'],
		]);

		//Permite seleccionar los datos que se desean guardar.
		$localidad = new Localidad;
		$localidad->LOCA_DESCRIPCION = Input::get('LOCA_DESCRIPCION');
		$localidad->LOCA_AREA = Input::get('LOCA_AREA');
		$localidad->TIPO_ID = Input::get('TIPO_ID'); //Relación con TipoPosesion
        $localidad->LOCA_CREADOPOR = auth()->user()->username;
        //Se guarda modelo
		$localidad->save();

		// redirecciona al index de controlador
		Session::flash('message', 'Localidad '.$localidad->LOCA_ID.' creado exitosamente!');
		return redirect()->to('localidad');
	}


	/**
	 * Muestra información de un registro.
	 *
	 * @param  int  $LOCA_ID
	 * @return Response
	 */
	public function show($LOCA_ID)
	{
		// Se obtiene el registro
		$localidad = Localidad::findOrFail($LOCA_ID);

		// Muestra la vista y pasa el registro
		return view('localidad/show', compact('localidad'));
	}


	/**
	 * Muestra el formulario para editar un registro en particular.
	 *
	 * @param  int  $LOCA_ID
	 * @return Response
	 */
	public function edit($LOCA_ID)
	{
		// Se obtiene el registro
		$localidad = Localidad::findOrFail($LOCA_ID);

		$tiposPosesiones = TipoPosesion::all();
		$arrTiposPosesiones = [];
		foreach ($tiposPosesiones as $tipos) {
			$arrTiposPosesiones = array_add(
				$arrTiposPosesiones,
				$tipos->TIPO_ID,
				$tipos->TIPO_DESCRIPCION
			);
		}

		// Muestra el formulario de edición y pasa el registro a editar
		return view('localidad/edit', compact('localidad', 'arrTiposPosesiones'));
	}


	/**
	 * Actualiza un registro en la base de datos.
	 *
	 * @param  int  $LOCA_ID
	 * @return Response
	 */
	public function update($LOCA_ID)
	{
		//Validación de datos
		$this->validate(request(), [
			'LOCA_DESCRIPCION' => ['required', 'max:300'],
			'LOCA_AREA' => ['required', 'max:300'],
			'TIPO_ID' => ['required'],
		]);

		// Se obtiene el registro
		$localidad = Localidad::findOrFail($LOCA_ID);

		$localidad->LOCA_DESCRIPCION = Input::get('LOCA_DESCRIPCION');
		$localidad->LOCA_AREA = Input::get('LOCA_AREA');
		$localidad->TIPO_ID = Input::get('TIPO_ID'); //Relación con TipoPosesion
        $localidad->LOCA_MODIFICADOPOR = auth()->user()->username;
        //Se guarda modelo
		$localidad->save();

		// redirecciona al index de controlador
		Session::flash('message', 'Localidad '.$localidad->LOCA_ID.' modificado exitosamente!');
		return redirect()->to('localidad');
	}

	/**
	 * Elimina un registro de la base de datos.
	 *
	 * @param  int  $LOCA_ID
	 * @return Response
	 */
	public function destroy($LOCA_ID, $showMsg=True)
	{
		$localidad = Localidad::findOrFail($LOCA_ID);

		// delete
        $localidad->LOCA_ELIMINADOPOR = auth()->user()->username;
		$localidad->save();
		$localidad->delete();

		// redirecciona al index de controlador
		if($showMsg){
			Session::flash('message', 'Localidad '.$localidad->LOCA_ID.' eliminado exitosamente!');
			return redirect()->to('localidad');
		}
	}


}

