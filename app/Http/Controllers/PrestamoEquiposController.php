<?php

namespace reservas\Http\Controllers;

use Illuminate\Http\Request;

use reservas\Http\Requests;
use reservas\Prestamo;
use reservas\Equipo;
use Session;
use Illuminate\Support\Facades\Route;
use Illuminate\Routing\Redirector;

class PrestamoEquiposController extends Controller
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
                if( ! in_array($role , ['admin','editor']))//Si el rol no es admin o editor, se niega el acceso.
                {
                    Session::flash('alert-danger', '¡Usuario no tiene permisos!');
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
        

        $equipoPrestamos = \reservas\Prestamo::orderBy('PRES_ID')
                        ->select('PRES_ID', 'PRES_IDUSARIO','PRES_NOMBREUSARIO','EQUI_ID','PRES_CREADOPOR',
                            'PRES_FECHACREADO')
                        ->where('PRES_FECHAFIN', null)
                        ->get();

       
        //$fechaActual = \Carbon\Carbon::now()->toDateTimeString(); 
       // $fechaRegistro=Prestamo::all()->lists('PRES_FECHACREADO');
         //dd($equipoPrestamos);


        //Para el filtro
        $salas = \DB::table('SALAS')
                            ->select('SALAS.*')
                            ->get();

        $sedes = \DB::table('SEDES')
                           ->select('SEDES.*')
                           ->get();

        //Se carga la vista y se pasan los registros
        return view('consultas/prestamos/index', compact('equipoPrestamos','salas','sedes','fechaRegistro'));
    }


    /**
     * Muestra información de un registro.
     *
     * @param  int  $ESFI_ID
     * @return Response
     */


	public function crearPrestamo()
	{    
        //Recibe parametros por metodo POST
        $equipo = $_POST['equipo'];
        $doc_usuario = $_POST['doc_usuario'];
        $nombre = $_POST['nombre'];
        //dd($nombre);

        $prestamo = new Prestamo;
        $prestamo->PRES_IDUSARIO = $doc_usuario;
        $prestamo->PRES_NOMBREUSARIO = $nombre;
        $prestamo->EQUI_ID = $equipo;
        $prestamo->PRES_CREADOPOR = auth()->user()->username;

         $prestamo->save();

        //Cambia el estado del equipo, una vez es prestado
        $equipo = Equipo::findOrFail($equipo);
        $equipo->ESTA_ID = 4;
        $equipo->EQUI_MODIFICADOPOR = auth()->user()->username;
        $equipo->save();



   		Session::flash('modal-success', 'Equipo en prestamo:  '.' '.  $equipo->EQUI_ID);
        return redirect()->back();


	}


        public function finalizarPrestamo($PRES_ID, $showMsg=true)
    {
        $prestamo = Prestamo::findOrFail($PRES_ID);
        $idquipo= $prestamo -> EQUI_ID;

            $prestamo ->PRES_FECHAFIN = \Carbon\Carbon::now()->toDateTimeString();  
            $prestamo->PRES_MODIFICADOPOR = auth()->user()->username;
            $prestamo->save();       

             //Cambia el estado del equipo, una vez es liberado
            $equipo = Equipo::findOrFail($idquipo);
            $equipo->ESTA_ID = 3;
            $equipo->EQUI_MODIFICADOPOR = auth()->user()->username;
            $equipo->save();

                // redirecciona al index de controlador
        if($showMsg){
            Session::flash('modal-success', 'Solicitud '.$prestamo->PRES_ID.' a finalizado exitosamente!');
            return redirect()->to('consultaPrestamos');
        }
    }
}
