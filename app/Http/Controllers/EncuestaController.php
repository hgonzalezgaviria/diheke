<?php

namespace reservas\Http\Controllers;

use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Route;
use Illuminate\Routing\Redirector;

use reservas\Encuesta;
use reservas\Pregunta;
use reservas\Respuesta;

class EncuestaController extends Controller
{
    public function __construct(Redirector $redirect)
    {
        //Requiere que el usuario inicie sesión.
        $this->middleware('auth');

        //Si el rol es user, redirige al home
        $action = Route::currentRouteAction();
        $arrActionsAdmin = array('create', 'edit', 'store', 'show', 'destroy', 'approve', 'clone');
        
        if(in_array(explode("@", $action)[1], $arrActionsAdmin)){
            if(isset(auth()->user()->role) && (auth()->user()->role == 'user')){
                Session::flash('error', '¡Usuario no tiene permisos!');
                $redirect->to('/home')->send();
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
        //Se genera paginación cada $cantPages registros.
        $cantPages = 5;
        //Se obtienen todas las encuentas.
        $encuestas = Encuesta::all();


        //Si el usuario actual tiene rol 'user', se deben excluir las ecuenstas ya resueltas.
        if(auth()->user()->role == 'user'){
            $encuestas = Encuesta::all();
            $username = auth()->user()->username;
            $encuestas_id = [];


            //Se obtienen todas las resps creadas por el usuario actual.
            $resps = Respuesta::where('created_by', '=', $username)->get();
            foreach ($resps as $resp){
                //Se adiciona al array encuestas_id[] las encuestas resueltas.
                $encuestas_id[$resp->pregunta->encuesta_id] = $resp->pregunta->encuesta_id;
            }

            foreach ($encuestas as $encuesta){
                //Si no hay preguntas en la encuesta, no se debe cargar.
                if((count($encuesta->preguntas) == 0)){
                    $encuestas_id[$encuesta->id] = $encuesta->id;
                }
                if($encuesta->status <> Encuesta::APROBADA){
                    $encuestas_id[$encuesta->id] = $encuesta->id;
                }
            }

            //Se obtienen solo los registros de las encuestas sin responder.
            $encuestas = Encuesta::whereNotIn('id', $encuestas_id)->get();
        } elseif(auth()->user()->role == 'audit'){
            //$encuestas = Encuesta::all()->paginate($cantPages);
        } elseif(auth()->user()->role == 'audit'){
            //$encuestas = $encuestas->paginate($cantPages);
        }
        //Se carga la vista y se pasan los registros. ->paginate($cantPages)
        return view('encuestas/index')->with('encuestas', $encuestas);
    }

    /**
     * Muestra el formulario para crear un nuevo registro.
     *
     * @return Response
     */
    public function create()
    {
        // Carga el formulario para crear un nuevo registro (views/create.blade.php)
        return view('encuestas/create');
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
                'titulo' => ['required', 'max:50']
            ]);

        //Guarda todos los datos recibidos del formulario
        //$encuesta = request()->all();
        //Encuesta::create($encuesta);

        //Permite seleccionar los datos que se desean guardar.
        $encuesta = new Encuesta;
        $encuesta->titulo = Input::get('titulo');
        $encuesta->status = Encuesta::NUEVA;
        $encuesta->created_by = auth()->user()->username;
        $encuesta->save();

        // redirecciona al index de controlador
        Session::flash('message', '¡Encuesta creada exitosamente!');
        return redirect()->to('encuestas/'.$encuesta->id);
    }


    /**
     * Muestra información de un registro.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        // Se obtiene el registro
        $encuesta = Encuesta::find($id);
        // Muestra la vista y pasa el registro
        return view('encuestas/show')->with('encuesta', $encuesta);
    }

    /**
     * Muestra el formulario para editar un registro en particular.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        // Se obtiene el registro
        $encuesta = Encuesta::find($id);

        // Muestra el formulario de edición y pasa el registro a editar
        return view('encuestas/edit')->with('encuesta', $encuesta);
    }

    /**
     * Actualiza un registro en la base de datos.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id)
    {
        //Validación de datos
        $this->validate(request(), [
            'titulo' => ['required', 'max:50']
        ]);

        // Se obtiene el registro
        $encuesta = Encuesta::find($id);
        $encuesta->titulo = Input::get('titulo');
        $encuesta->edited_by = auth()->user()->username;
        $encuesta->save();

        // redirecciona al index de controlador
        Session::flash('message', '¡Encuesta actualizada exitosamente!');
        return redirect()->to('encuestas/'.$id);
    }

    /**
     * Elimina un registro de la base de datos.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        // delete
        $encuesta = Encuesta::find($id);

        //Al borrar (SoftDeletes) una encuesta, se borran las preguntas.
        foreach($encuesta->preguntas as $preg){
            (new PreguntaController)->destroy($encuesta->id, $preg, false);
        }

        $encuesta->deleted_by = auth()->user()->username;
        $encuesta->status = Encuesta::ELIMINADA;
        $encuesta->save();
        $encuesta->delete();

        // redirecciona al index de controlador
        Session::flash('message', '¡Encuesta '.$id.' borrada!');
        return redirect()->to('encuestas');
    }


    /**
     * Libera la encuesta para que sea visualizada por los usuarios
     *
     * @param  int  $id
     * @return Response
     */
    public function aprobar($id)
    {
        // Se obtiene el registro
        $encuesta = Encuesta::find($id);
        $encuesta->status = Encuesta::APROBADA;
        $encuesta->save();

        // redirecciona al index de controlador
        Session::flash('message', '¡Encuesta '.$id.' aprobada!');
        return redirect()->to('encuestas');
    }

    /**
     *  Duplica una encuesta
     *
     * @param  int  $id
     * @return Response
     */
    public function duplicar($id)
    {
        // Se obtiene el registro
        $encuesta = Encuesta::find($id);

        $newEncuesta = $encuesta->replicate();
        $newEncuesta->titulo = $newEncuesta->titulo .' - copia';
        $newEncuesta->status = Encuesta::NUEVA;
        $newEncuesta->push();

        $preguntas = $encuesta->preguntas;
        foreach ($preguntas as $preg) {
            $newPreg = $preg->replicate();
            $newEncuesta->preguntas()->save($newPreg);
            foreach ($preg->pregItems as $pregItem) {
                $newPregItem = $pregItem->replicate();
                $newPreg->pregItems()->save($newPregItem);
            }
        }


        $newEncuesta->save();

        // redirecciona al index de controlador
        Session::flash('message', '¡Encuesta '.$id.' duplicada con id '.$newEncuesta->id.'!');
        return redirect()->to('encuestas');
    }

    /**
     * Genera reportes y gráficos de los resultados de la encuesta.
     *
     * @param  int  $id
     * @return Response
     */
    public function reportes($encuesta_id)
    {
        // Se obtiene el registro
        //$encuesta = Encuesta::find($encuesta_id);

        $pregs = Pregunta::where('encuesta_id',$encuesta_id)->get();

        $arrCharts = $resps_value = $label = []; 
        $tipo = 'pie';
        foreach($pregs as $preg){
            switch($preg->preg_tipo_id){
                case 1: //Abierta
                    break;

                case 2: //Escala de valores
echo 'Escala de valores<br>';
                    $tipo = 'bar2';

                    $pregItems = $preg->pregItems;
                    $resps = [];
                    foreach ($pregItems as $pregItem) {
                        $preg_item_id = $pregItem->id;
                        $resp = $pregItem->respuestas()
                                    ->select(['valor_int', \DB::raw("COUNT(valor_int) as count")])
                                    ->orderBy("valor_int")->groupBy('valor_int')->get();
                        $resps += [$preg_item_id => $resp];
                    }


                    $label = range(1, 5);

                    $resps_value =  [];
                    foreach (array_values($resps) as $key => $resp) {
                        $resps_value_item =  [];
                        foreach($label as $l){

                            $count = $resp->where('valor_int',$l)->first();
                            isset($count->count) ? $count = $count->count : $count = 0;
                            array_push($resps_value_item, $count);
                        }
                        array_push($resps_value, $resps_value_item);
                    }
                    break;

                case 3: //Selección Única
echo 'Selección Única<br>';
                    $tipo = 'bar';
                    $resps = $preg->respuestas()
                        ->select(['valor_int' ,\DB::raw("COUNT(valor_int) as count")])
                        ->orderBy("valor_int")->groupBy('valor_int')
                        ->get();

                    $arrLabel = $preg->pregItems()
                        ->select(['id', 'texto'])
                        ->distinct()
                        ->orderBy("id")->groupBy('id')
                        ->get();
                    $label = array_column($arrLabel->toArray(), 'texto');

                    $resps_value =  [];
                    foreach($arrLabel as $l){

                        $count = $resps->where('valor_int',$l->id)->first();
                        isset($count->count) ? $count = $count->count : $count = 0;

                        array_push($resps_value, $count);
                    }

//echo 'label= '.json_encode($label);
//echo '<br>resps_value= '.json_encode($resps_value);
//exit();
                    break;

                case 4: //Pregunta Si/No
                    $tipo = 'pie';
                    $resps = $preg->first()->respuestas()
                        ->select(['valor_int' ,\DB::raw("COUNT(valor_int) as count")])
                        ->orderBy("valor_int")->groupBy('valor_int')
                        ->get();

                    $label = ['NO', 'SI'];

                    //$resps_value = array_column($resps->toArray(), 'count');
                    $resps_value =  [];
                    for ($i=0; $i <= 1; $i++) {
                        $count = $resps->where('valor_int',$i)->first();
                        isset($count->count) ? $count = $count->count : $count = 0;
                        array_push($resps_value, $count);
                    }
                    break;

                default:
                //pendiente
            }
            array_push($arrCharts, [
                'tipo' => $tipo,
                'titulo' => 'Pregunta '.$preg->id,
                'label' => $label,
                'resps_value' => $resps_value,
            ]);
        }
        

        //Se carga la vista y se pasan los registros. ->paginate($cantPages)
        return view('charts/chart')
            ->with('arrCharts', $arrCharts);
    }
}

