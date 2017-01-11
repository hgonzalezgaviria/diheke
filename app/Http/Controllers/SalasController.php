<?php

namespace reservas\Http\Controllers;

use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Route;
use Illuminate\Routing\Redirector;

use reservas\Sala;

class SalasController extends Controller
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
		$salas = Sala::all();

		//Se carga la vista y se pasan los registros
		return view('salas/index', compact('salas'));
	}

	/**
	 * Muestra el formulario para crear un nuevo registro.
	 *
	 * @return Response
	 */
	public function create()
	{
		//Se crea un array con las sedes disponibles
		$sedes = \reservas\Sede::orderBy('SEDE_ID')
						->select('SEDE_ID', 'SEDE_DESCRIPCION')
						->get();

		$arrSedes = [];
		foreach ($sedes as $sede) {
			$arrSedes = array_add(
				$arrSedes,
				$sede->SEDE_ID,
				$sede->SEDE_DESCRIPCION
			);
		}


		//Se crea un array con los posibles estados de una sala.
		$tipoEstadoSala = 1;
		$estadosSala = \reservas\Estado::where('TIES_ID', $tipoEstadoSala)
						->orderBy('ESTA_ID')
						->select('ESTA_ID', 'ESTA_DESCRIPCION')
						->get();

		$arrEstadosSala = [];
		foreach ($estadosSala as $estado) {
			$arrEstadosSala = array_add(
				$arrEstadosSala,
				$estado->ESTA_ID,
				$estado->ESTA_DESCRIPCION
			);
		}


		// Carga el formulario para crear un nuevo registro y pasa las variables para llenar los dropdown
		return view('salas/create', compact('arrSedes', 'arrEstadosSala'));
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

			'SALA_DESCRIPCION' => ['required', 'max:300'],
			'SALA_CAPACIDAD' => ['required', 'numeric'],
			'SALA_FOTOSALA' => ['required', 'max:500'],
			'SALA_FOTOCROQUIS' => ['required', 'max:500'],
			'SALA_OBSERVACIONES' => ['required', 'max:300'],
			'ESTA_ID' => ['required', 'numeric'],
			'SEDE_ID' => ['required', 'numeric'],

		]);

		//Permite seleccionar los datos que se desean guardar.
		$sala = new Sala;
		$sala->REFI_NOMENCLATURA = Input::get('REFI_NOMENCLATURA');
		$sala->REFI_CAPACIDADMAXIMA = Input::get('REFI_CAPACIDADMAXIMA');
		$sala->REFI_TIPOASIGNACION = Input::get('REFI_TIPOASIGNACION');
		$sala->REFI_DESCRIPCION = Input::get('REFI_DESCRIPCION');
		$sala->REFI_NIVEL = Input::get('REFI_NIVEL');
		$sala->REFI_ESTADO = Input::get('REFI_ESTADO');
		$sala->REFI_CAPACIDADREAL = Input::get('REFI_CAPACIDADREAL');

		$sala->REFI_PRESTABLE =  (Input::get('REFI_PRESTABLE')) ? true : false;

		$sala->REFI_AREAREAL = Input::get('REFI_AREAREAL');
		$sala->REFI_AREAUSADA = Input::get('REFI_AREAUSADA');

		$sala->SIRF_ID = Input::get('SIRF_ID'); //Relación con SITUACIONRECURSOFISICO
		$sala->TIRF_ID = Input::get('TIRF_ID'); //Relación con TIPORECURSOFISICO
		$sala->TIPO_ID = Input::get('TIPO_ID'); //Relación con TipoPosesion
		$sala->ESFI_ID = Input::get('ESFI_ID'); //Relación con ESPACIOFISICO

		$sala->REFI_CREADOPOR = auth()->user()->username;
		//Se guarda modelo
		$sala->save();

		// redirecciona al index de controlador
		Session::flash('message', 'Espacio Fisico '.$sala->SALA_ID.' creado exitosamente!');
		return redirect()->to('sala');
	}


	/**
	 * Muestra información de un registro.
	 *
	 * @param  int  $SALA_ID
	 * @return Response
	 */
	public function show($SALA_ID)
	{
		// Se obtiene el registro
		$sala = Sala::findOrFail($SALA_ID);

		// Muestra la vista y pasa el registro
		return view('salas/show', compact('sala'));
	}


	/**
	 * Muestra el formulario para editar un registro en particular.
	 *
	 * @param  int  $SALA_ID
	 * @return Response
	 */
	public function edit($SALA_ID)
	{
		// Se obtiene el registro a modificar
		$sala = Sala::findOrFail($SALA_ID);

		//Se crea un array con las sedes disponibles
    	$sedes = \reservas\Sede::orderBy('SEDE_ID')
						->select('SEDE_ID', 'SEDE_DESCRIPCION')
						->get();

		$arrSedes = [];
		foreach ($sedes as $sede) {
			array_push($arrSedes, [ $sede->SEDE_ID , $sede->SEDE_DESCRIPCION ]);
		}


		//Se crea un array con los posibles estados de una sala.
		$tipoEstadoSala = 1;
		$estadosSala = \reservas\Estado::where('TIES_ID', $tipoEstadoSala)
    					->orderBy('ESTA_ID')
						->select('ESTA_ID', 'ESTA_DESCRIPCION')
						->get();

		$arrEstadosSala = [];
		foreach ($estadosSala as $estado) {
			array_push($arrEstadosSala, [ $estado->ESTA_ID => $estado->ESTA_DESCRIPCION ]);
		}


		// Muestra el formulario de edición y pasa el registro a editar
		// y arreglos para llenar los Selects
		return view('salas/edit', compact('sala', 'arrSedes', 'arrEstadosSala'));
	}


	/**
	 * Actualiza un registro en la base de datos.
	 *
	 * @param  int  $SALA_ID
	 * @return Response
	 */
	public function update($SALA_ID)
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
		$sala = Sala::findOrFail($SALA_ID);

		$sala->REFI_NOMENCLATURA = Input::get('REFI_NOMENCLATURA');
		$sala->REFI_CAPACIDADMAXIMA = Input::get('REFI_CAPACIDADMAXIMA');
		$sala->REFI_TIPOASIGNACION = Input::get('REFI_TIPOASIGNACION');
		$sala->REFI_DESCRIPCION = Input::get('REFI_DESCRIPCION');
		$sala->REFI_NIVEL = Input::get('REFI_NIVEL');
		$sala->REFI_ESTADO = Input::get('REFI_ESTADO');
		$sala->REFI_CAPACIDADREAL = Input::get('REFI_CAPACIDADREAL');
		$sala->REFI_PRESTABLE =  (Input::get('REFI_PRESTABLE')) ? true : false;
		$sala->REFI_AREAREAL = Input::get('REFI_AREAREAL');
		$sala->REFI_AREAUSADA = Input::get('REFI_AREAUSADA');

		$sala->SIRF_ID = Input::get('SIRF_ID'); //Relación con SITUACIONRECURSOFISICO
		$sala->TIRF_ID = Input::get('TIRF_ID'); //Relación con TIPORECURSOFISICO
		$sala->TIPO_ID = Input::get('TIPO_ID'); //Relación con TipoPosesion
		$sala->ESFI_ID = Input::get('ESFI_ID'); //Relación con ESPACIOFISICO
		$sala->REFI_MODIFICADOPOR = auth()->user()->username;
		//Se guarda modelo
		$sala->save();

		// redirecciona al index de controlador
		Session::flash('message', 'Espacio Fisico '.$sala->SALA_ID.' modificado exitosamente!');
		return redirect()->to('sala');
	}

	/**
	 * Elimina un registro de la base de datos.
	 *
	 * @param  int  $SALA_ID
	 * @return Response
	 */
	public function destroy($SALA_ID, $showMsg=True)
	{
		$sala = Sala::findOrFail($SALA_ID);

		// delete
		$sala->REFI_ELIMINADOPOR = auth()->user()->username;
		$sala->save();
		$sala->delete();

		// redirecciona al index de controlador
		if($showMsg){
			Session::flash('message', 'Espacio Fisico '.$sala->SALA_ID.' eliminado exitosamente!');
			return redirect()->to('sala');
		}
	}


}

