<?php

namespace reservas\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Route;

use reservas\Http\Requests;
use reservas\Festivo;

use Session;
use Illuminate\Support\Facades\Input;
use DB;

class FestivosController extends Controller
{
    //
    public function __construct(Redirector $redirect=null)
    {
        //Requiere que el usuario inicie sesión.
        $this->middleware('auth');
        if(!auth()->guest() && isset($redirect)){

            $action = Route::currentRouteAction();
            $role = isset(auth()->user()->rol->ROLE_ROL) ? auth()->user()->rol->ROLE_ROL : 'guest';
            
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
        $festivos = Festivo::all();
        //Se carga la vista y se pasan los registros.
        return view('festivos/index', compact('festivos'));
    }

    /**
     * Muestra el formulario para crear un nuevo registro.
     *
     * @return Response
     */
    public function create()
    {
        // Carga el formulario para crear un nuevo registro (views/create.blade.php)
        return view('festivos/create');
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
                'FEST_FECHA' => ['required', 'max:50'],
                'FEST_DESCRIPCION' => ['required', 'max:300']
                
            ]);
        //Guarda todos los datos recibidos del formulario
        $festivo = request()->except(['_token']);

        //$tag =auth()->user()->username;
        //dump($tag);
         $festivo = Festivo::create($festivo);
         //dump(auth()->user()->username);
        $festivo->FEST_CREADOPOR = auth()->user()->username;
        
        //Se guarda modelo
        $festivo->save();


        //Permite seleccionar los datos que se desean guardar.
        /*
        $contrato = new Contrato;
        $contrato->titulo = Input::get('titulo');
        $contrato->status = Contrato::NUEVA;
        $contrato->created_by = auth()->user()->username;
        $contrato->save();
        */

        // redirecciona al index de controlador
        Session::flash('alert-info', 'Festivo creado exitosamente!');
        return redirect()->to('festivos');
    }


    /**
     * Muestra información de un registro.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($FEST_ID)
    {
        // Se obtiene el registro
        $festivo = Festivo::findOrFail($FEST_ID);
        // Muestra la vista y pasa el registro
        return view('festivos/show', compact('festivo'));        
    }

    /**
     * Muestra el formulario para editar un registro en particular.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($FEST_ID)
    {
        // Se obtiene el registro
        $festivo = Festivo::findOrFail($FEST_ID);

        // Muestra el formulario de edición y pasa el registro a editar
        return view('festivos/edit', compact('festivo'));   
        //return view('festivos/edit')->with('festivo', $festivo);
    }

    /**
     * Actualiza un registro en la base de datos.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($FEST_ID)
    {
        //Validación de datos
        $this->validate(request(), [
        		'FEST_FECHA' => ['required'],
                'FEST_DESCRIPCION' => ['required', 'max:100']
                
        ]);

        // Se obtiene el registro
        $festivo = Festivo::findOrFail($FEST_ID);
        $festivo->FEST_FECHA = Input::get('FEST_FECHA');
        $festivo->FEST_DESCRIPCION = Input::get('FEST_DESCRIPCION');
        //$festivo->edited_by = auth()->user()->username;
        $festivo->FEST_MODIFICADOPOR = auth()->user()->username;
        $festivo->save();

        // redirecciona al index de controlador
        Session::flash('alert-info', 'Festivo actualizado exitosamente!');
        return redirect()->to('festivos/');
    }

    /**
     * Elimina un registro de la base de datos.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($FEST_ID)
    {
        // delete
        $festivo = Festivo::findOrFail($FEST_ID);
        $festivo->FEST_ELIMINADOPOR = auth()->user()->username;
        $festivo->save();        
        $festivo->delete();

        // redirecciona al index de controlador
        Session::flash('alert-info', 'Festivo '.$FEST_ID.' borrado!');
        return redirect()->to('festivos');
    }

    public function getFestivos()
    {
        //Se obtienen todas los festivos.
        //$festivos = Festivo::all();

        $festivos = Festivo::orderBy('FEST_FECHA', 'desc')->get();
        
        return json_encode($festivos);
    }

}
