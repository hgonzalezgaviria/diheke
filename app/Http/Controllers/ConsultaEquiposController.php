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
		

		$sedes = \reservas\Sede::orderBy('SEDE_ID')
						->select('SEDE_ID', 'SEDE_DESCRIPCION')
						->get();

		$sala = Input::get('sala');

		//$equipos = \reservas\Equipo::all();
		$equipos = \reservas\Equipo::where('SALA_ID',$sala)->get();


		//Se carga la vista y se pasan los registros
		return view('consultas/equipos/index', compact('sala','equipos'));
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

	}


     public function consultarEquipos(){

        //$SEDE_ID = $_POST['sede'];
        $SALA_ID = $_POST['sala'];

        $equipos = \DB::table('EQUIPOS')
                            ->select('EQUIPOS.*')
                            ->where('SALA_ID', $SALA_ID)
                            ->get();

        /*$equipos = \reservas\Equipo::where('SALA_ID', $SALA_ID)
        			->get();*/

        return json_encode($equipos);
        //return $salas;
    }







	/**
	 * Actualiza un registro en la base de datos.
	 *
	 * @param  int  $ESFI_ID
	 * @return Response	 */
	

}
