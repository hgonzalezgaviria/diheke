<?php

namespace reservas\Http\Controllers;

use Illuminate\Http\Request;

use reservas\Http\Requests;
use reservas\Reserva;

use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Route;
use Illuminate\Routing\Redirector;

class ReservasController extends Controller
{
    //


    public function __construct(Redirector $redirect=null)
    {
        //Requiere que el usuario inicie sesión.
        $this->middleware('auth');
        if(isset($redirect)){

            $action = Route::currentRouteAction();
            $role = isset(auth()->user()->role) ? auth()->user()->role : 'guest';
            
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

    public function show()
    {
        return view('reservas/index');
    }
   
    
    /**
     * Muestra una lista de los registros.
     *
     * @return Response
     */
    public function index()
    {
        $data = array(); //declaramos un array principal que va contener los datos
        $id = Reserva::all()->lists('id'); //listamos todos los id de los eventos
        $titulo = Reserva::all()->lists('titulo'); //lo mismo para lugar y fecha
        $fechaini = Reserva::all()->lists('fechaini');
        $fechafin = Reserva::all()->lists('fechafin');
        $allDay = Reserva::all()->lists('todoeldia');
        $background = Reserva::all()->lists('color');
        $count = count($id); //contamos los ids obtenidos para saber el numero exacto de eventos
 
        //hacemos un ciclo para anidar los valores obtenidos a nuestro array principal $data
        for($i=0;$i<$count;$i++){
            $data[$i] = array(
                "title"=>$titulo[$i], //obligatoriamente "title", "start" y "url" son campos requeridos
                "start"=>$fechaini[$i], //por el plugin asi que asignamos a cada uno el valor correspondiente
                "end"=>$fechafin[$i],
                "allDay"=>$allDay[$i],
                "backgroundColor"=>$background[$i],
                //"borderColor"=>$borde[$i],
                "id"=>$id[$i]
                //"url"=>"cargaEventos".$id[$i]
                //en el campo "url" concatenamos el el URL con el id del evento para luego
                //en el evento onclick de JS hacer referencia a este y usar el método show
                //para mostrar los datos completos de un evento
            );
        }
 
        json_encode($data); //convertimos el array principal $data a un objeto Json 
       return $data; //para luego retornarlo y estar listo para consumirlo
    }

    public function create(){
        //Valores recibidos via ajax
        $title = $_POST['title'];
        $start = $_POST['start'];
        $back = $_POST['background'];
        $end = $_POST['end'];

        //Insertando evento a base de datos
        $reserva=new Reserva;
        $reserva->fechaini=$start;
        $reserva->fechafin=$end;
        $reserva->todoeldia=false;
        $reserva->color=$back;
        $reserva->titulo=$title;

        $reserva->save();
   }

   public function update(){
        //Valores recibidos via ajax
        $id = $_POST['id'];
        $title = $_POST['title'];
        $start = $_POST['start'];
        $end = $_POST['end'];
        $allDay = $_POST['allday'];
        $back = $_POST['background'];

        $evento=Reserva::find($id);
        if($end=='NULL'){
            $evento->fechafin=NULL;
        }else{
            $evento->fechafin=$end;
        }
        $evento->fechaini=$start;
        $evento->todoeldia=$allDay;
        $evento->color=$back;
        $evento->titulo=$title;
        //$evento->fechafin=$end;

        $evento->save();
   }

   public function delete(){
        //Valor id recibidos via ajax
        $id = $_POST['id'];

        Reserva::destroy($id);
   }

}
