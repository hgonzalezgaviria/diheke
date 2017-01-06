<?php

namespace reservas\Http\Controllers;

use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Route;
use Illuminate\Routing\Redirector;

use reservas\Sede;
use reservas\TipoSede;
use reservas\TipoPosesion;
use reservas\Localidad;

class SedeController extends Controller
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
		$sedes = Sede::all();

		//Se carga la vista y se pasan los registros
		return view('sede/index', compact('sedes'));
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

		$tiposEspaciosFisicos = TipoSede::all();
		$arrTiposEspaciosFisicos = [];
		foreach ($tiposEspaciosFisicos as $tipo) {
			$arrTiposEspaciosFisicos = array_add(
				$arrTiposEspaciosFisicos,
				$tipo->TIEF_ID,
				$tipo->TIEF_DESCRIPCION
			);
		}

		$localidades = Localidad::all();
		$arrLocalidades = [];
		foreach ($localidades as $localidad) {
			$arrLocalidades = array_add(
				$arrLocalidades,
				$localidad->LOCA_ID,
				$localidad->LOCA_DESCRIPCION
			);
		}

		return view('sede/create', compact(
			'arrTiposPosesiones',
			'arrTiposEspaciosFisicos',
			'arrLocalidades'
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
			'ESFI_DESCRIPCION' => ['required', 'max:300'],
			'ESFI_AREA' => ['required', 'max:300'],
			'ESFI_NRONIVELES' => ['required'],
			'ESFI_NOMBRE' => ['required', 'max:300'],
			'ESFI_NOMENCLATURA' => ['required', 'max:300'],
			'TIPO_ID' => ['required'],
			'TIEF_ID' => ['required'],
			'LOCA_ID' => ['required'],
		]);

		//Permite seleccionar los datos que se desean guardar.
		$espacioFisico = new Sede;
		$espacioFisico->ESFI_DESCRIPCION = Input::get('ESFI_DESCRIPCION');
		$espacioFisico->ESFI_AREA = Input::get('ESFI_AREA');
		$espacioFisico->ESFI_NRONIVELES = Input::get('ESFI_NRONIVELES');
		$espacioFisico->ESFI_NOMBRE = Input::get('ESFI_NOMBRE');
		$espacioFisico->ESFI_NOMENCLATURA = Input::get('ESFI_NOMENCLATURA');
		$espacioFisico->TIPO_ID = Input::get('TIPO_ID'); //Relación con TipoPosesion
		$espacioFisico->TIEF_ID = Input::get('TIEF_ID'); //Relación con TipoSede
		$espacioFisico->LOCA_ID = Input::get('LOCA_ID'); //Relación con Localidad
        $espacioFisico->ESFI_CREADOPOR = auth()->user()->username;
        //Se guarda modelo
		$espacioFisico->save();

		// redirecciona al index de controlador
		Session::flash('message', 'Espacio Fisico '.$espacioFisico->ESFI_ID.' creado exitosamente!');
		return redirect()->to('sede');
	}


	/**
	 * Muestra información de un registro.
	 *
	 * @param  int  $ESFI_ID
	 * @return Response
	 */
	public function show($ESFI_ID)
	{
		// Se obtiene el registro
		$espacioFisico = Sede::findOrFail($ESFI_ID);

		// Muestra la vista y pasa el registro
		return view('sede/show', compact('espacioFisico'));
	}


	/**
	 * Muestra el formulario para editar un registro en particular.
	 *
	 * @param  int  $ESFI_ID
	 * @return Response
	 */
	public function edit($ESFI_ID)
	{
		// Se obtiene el registro a modificar
		$espacioFisico = Sede::findOrFail($ESFI_ID);

		$tiposPosesiones = TipoPosesion::all();
		$arrTiposPosesiones = [];
		foreach ($tiposPosesiones as $tipos) {
			$arrTiposPosesiones = array_add(
				$arrTiposPosesiones,
				$tipos->TIPO_ID,
				$tipos->TIPO_DESCRIPCION
			);
		}

		$tiposEspaciosFisicos = TipoSede::all();
		$arrTiposEspaciosFisicos = [];
		foreach ($tiposEspaciosFisicos as $tipo) {
			$arrTiposEspaciosFisicos = array_add(
				$arrTiposEspaciosFisicos,
				$tipo->TIEF_ID,
				$tipo->TIEF_DESCRIPCION
			);
		}

		$localidades = Localidad::all();
		$arrLocalidades = [];
		foreach ($localidades as $localidad) {
			$arrLocalidades = array_add(
				$arrLocalidades,
				$localidad->LOCA_ID,
				$localidad->LOCA_DESCRIPCION
			);
		}

		// Muestra el formulario de edición y pasa el registro a editar
		// y arreglos para llenar los Selects
		return view('sede/edit', compact(
			'espacioFisico',
			'arrTiposPosesiones',
			'arrTiposEspaciosFisicos',
			'arrLocalidades'
			));
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
		$this->validate(request(), [
			'ESFI_DESCRIPCION' => ['required', 'max:300'],
			'ESFI_AREA' => ['required', 'max:300'],
			'ESFI_NRONIVELES' => ['required'],
			'ESFI_NOMBRE' => ['required', 'max:300'],
			'ESFI_NOMENCLATURA' => ['required', 'max:300'],
			'TIPO_ID' => ['required'],
			'TIEF_ID' => ['required'],
			'LOCA_ID' => ['required'],
		]);

		// Se obtiene el registro
		$espacioFisico = Sede::findOrFail($ESFI_ID);

		$espacioFisico->ESFI_DESCRIPCION = Input::get('ESFI_DESCRIPCION');
		$espacioFisico->ESFI_AREA = Input::get('ESFI_AREA');
		$espacioFisico->ESFI_NRONIVELES = Input::get('ESFI_NRONIVELES');
		$espacioFisico->ESFI_NOMBRE = Input::get('ESFI_NOMBRE');
		$espacioFisico->ESFI_NOMENCLATURA = Input::get('ESFI_NOMENCLATURA');
		$espacioFisico->TIPO_ID = Input::get('TIPO_ID'); //Relación con TipoPosesion
		$espacioFisico->TIEF_ID = Input::get('TIEF_ID'); //Relación con TipoSede
		$espacioFisico->LOCA_ID = Input::get('LOCA_ID'); //Relación con Localidad
        $espacioFisico->ESFI_MODIFICADOPOR = auth()->user()->username;
        //Se guarda modelo
		$espacioFisico->save();

		// redirecciona al index de controlador
		Session::flash('message', 'Espacio Fisico '.$espacioFisico->ESFI_ID.' modificado exitosamente!');
		return redirect()->to('sede');
	}

	/**
	 * Elimina un registro de la base de datos.
	 *
	 * @param  int  $ESFI_ID
	 * @return Response
	 */
	public function destroy($ESFI_ID, $showMsg=True)
	{
		$espacioFisico = Sede::findOrFail($ESFI_ID);

		// delete
        $espacioFisico->ESFI_ELIMINADOPOR = auth()->user()->username;
		$espacioFisico->save();
		$espacioFisico->delete();

		// redirecciona al index de controlador
		if($showMsg){
			Session::flash('message', 'Espacio Fisico '.$espacioFisico->ESFI_ID.' eliminado exitosamente!');
			return redirect()->to('sede');
		}
	}


}

