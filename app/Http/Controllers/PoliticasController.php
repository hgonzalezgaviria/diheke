<?php

namespace reservas\Http\Controllers;

use reservas\Http\Requests;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Route;
use Illuminate\Routing\Redirector;

use reservas\Politica;

class PoliticasController extends Controller
{
    //
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
		$politicas = Politica::all();

		//Se carga la vista y se pasan los registros
		return view('politicas/index', compact('politicas'));
	}

	/**
	 * Muestra el formulario para crear un nuevo registro.
	 *
	 * @return Response
	 */
	public function create()
	{

		return view('politicas/create');
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
			'POLI_HORA_MIN' => ['required', 'max:8'],
			'POLI_HORA_MAX' => ['required', 'max:8'],
			'POLI_HORAS_MIN_RESERVA' => ['required','max:2'],
			'POLI_DIAS_MIN_CANCELAR' => ['required','max:2'],
		]);

 		$politica = request()->except(['_token']);


        $politica = Politica::create($politica);
        $politica->POLI_CREADOPOR = auth()->user()->username;
        $politica->save();

		// redirecciona al index de controlador
		Session::flash('message', 'Politica creada exitosamente!');
		return redirect()->to('politicas');
	}


	/**
	 * Muestra información de un registro.
	 *
	 * @param  int  $ESFI_ID
	 * @return Response
	 */
	public function show($POLI_ID)
	{
		// Se obtiene el registro
		$politica = Politica::findOrFail($POLI_ID);

		// Muestra la vista y pasa el registro
		return view('politicas/show', compact('politica'));
	}


	/**
	 * Muestra el formulario para editar un registro en particular.
	 *
	 * @param  int  $ESFI_ID
	 * @return Response
	 */
	public function edit($POLI_ID)
	{
		// Se obtiene el registro a modificar
		$politica = Politica::findOrFail($POLI_ID);

		// Muestra el formulario de edición y pasa el registro a editar
		// y arreglos para llenar los Selects
		return view('politicas/edit', compact('politica'));
	}


	/**
	 * Actualiza un registro en la base de datos.
	 *
	 * @param  int  $ESFI_ID
	 * @return Response
	 */
	public function update($ESFI_ID)
	{
		//Validación de datos
		//Validación de datos
		//Validación de datos
		$this->validate(request(), [
			'POLI_HORA_MIN' => ['required', 'max:8'],
			'POLI_HORA_MAX' => ['required', 'max:8'],
			'POLI_HORAS_MIN_RESERVA' => ['required','max:2'],
			'POLI_DIAS_MIN_CANCELAR' => ['required','max:2'],
		]);

		// Se obtiene el registro
		$politica = Politica::findOrFail($ESFI_ID);

		$politica->POLI_HORA_MIN = Input::get('POLI_HORA_MIN');
		$politica->POLI_HORA_MAX = Input::get('POLI_HORA_MAX');
		$politica->POLI_HORAS_MIN_RESERVA = Input::get('POLI_HORAS_MIN_RESERVA');
		$politica->POLI_DIAS_MIN_CANCELAR = Input::get('POLI_DIAS_MIN_CANCELAR');
        $politica->POLI_MODIFICADOPOR = auth()->user()->username;
        //Se guarda modelo
		$politica->save();

		// redirecciona al index de controlador
		Session::flash('message', 'Politica '.$politica->POLI_ID.' modificada exitosamente!');
		return redirect()->to('politicas');
	}

	/**
	 * Elimina un registro de la base de datos.
	 *
	 * @param  int  $ESFI_ID
	 * @return Response
	 */
	public function destroy($POLI_ID, $showMsg=True)
	{
		$politica = Politica::findOrFail($POLI_ID);

		// delete
        $politica->POLI_ELIMINADOPOR = auth()->user()->username;
		$politica->save();
		$politica->delete();

		// redirecciona al index de controlador
		if($showMsg){
			Session::flash('message', 'Politica '.$politica->SEDE_ID.' eliminada exitosamente!');
			return redirect()->to('politicas');
		}
	}
}
