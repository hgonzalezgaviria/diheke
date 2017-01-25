<?php

namespace reservas\Http\Controllers;

use reservas\Http\Requests;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Route;
use Illuminate\Routing\Redirector;

use reservas\Politica;

class ConsultaEquiposController extends Controller
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

		$salas = \reservas\Sala::orderBy('SALA_ID')
						->select('SALA_ID', 'SALA_DESCRIPCION')
						->get();

		$arrSalas = [];
		foreach ($salas as $sala) {
			$arrSalas = array_add(
				$arrSalas,
				$sala->SALA_ID,
				$sala->SALA_DESCRIPCION
			);
		}

		$equipos = \reservas\Equipo::all();


		//Se carga la vista y se pasan los registros
		return view('consultas/equipos/index', compact('politicas','arrSedes','arrSalas','equipos'));
	}

	/**
	 * Muestra el formulario para crear un nuevo registro.
	 *
	 * @return Response
	 */



	/**
	 * Guarda el registro nuevo en la base de datos.
	 *
	 * @return Response
	 */
	


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


	
	public function consultaEquipos($SEDE_ID, $SALA_ID)
	{
		// Se obtiene el registro
		$politica = Politica::findOrFail($POLI_ID);

		// Muestra la vista y pasa el registro
		return view('politicas/show', compact('politica'));

		$SQL= "SELECT e.EQUI_ID, e.EQUI_DESCRIPCION, e.EQUI_OBSERVACIONES, es.ESTA_DESCRIPCION from equipos e, estados es, salas sa, sedes se, tipoestados tes WHERE e.SALA_ID=sa.SALA_ID and sa.SEDE_ID=se.SEDE_ID and es.ESTA_ID=e.ESTA_ID and es.TIES_ID=tes.TIES_ID";
	}



	/**
	 * Actualiza un registro en la base de datos.
	 *
	 * @param  int  $ESFI_ID
	 * @return Response	 */
	

}
