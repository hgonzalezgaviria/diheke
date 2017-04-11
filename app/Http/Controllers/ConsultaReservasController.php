<?php

namespace reservas\Http\Controllers;

use Illuminate\Http\Request;

use reservas\Http\Requests;
use reservas\Equipo;
use reservas\Reserva;
use Session;
use Illuminate\Support\Facades\Route;
use Illuminate\Routing\Redirector;

class ConsultaReservasController extends Controller
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
        

        $reservas = \reservas\Reserva::orderBy('RESE_ID')
                        ->select('RESE_ID', 'RESE_CREADOPOR','RESE_TITULO','SALA_ID',
                            'RESE_FECHAINI','RESE_FECHAFIN')
                       // ->where('PRES_FECHAFIN', null)
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
      //Covertir imagen en base64
      $image = asset('assets/img/Logo_opt1.png');
      $type = pathinfo($image, PATHINFO_EXTENSION);
      $data = file_get_contents($image);
      $dataUri = 'data:image/' . $type . ';base64,' . base64_encode($data);
      //dd($dataUri);


        //Se carga la vista y se pasan los registros
        return view('consultas/reservas/index', compact('reservas','salas','sedes','fechaRegistro','dataUri'));
    }

}
