<?php

namespace reservas\Http\Controllers;

use Illuminate\Http\Request;

use reservas\Http\Requests;
use reservas\Estado;
use reservas\Tipoestado;

use Session;
use Illuminate\Support\Facades\Input;
use DB;


class EstadosController extends Controller
{
    /*
    public function __construct(Redirector $redirect)
    {
        //Requiere que el usuario inicie sesión.
        $this->middleware('auth');

        //Si el rol es user, redirige al home
        $action = Route::currentRouteAction();
        $arrActionsAdmin = array('create', 'edit', 'store', 'show', 'destroy');
        
        if(in_array(explode("@", $action)[1], $arrActionsAdmin)){
            if(isset(auth()->user()->role) && (auth()->user()->role == 'user')){
                Session::flash('error', '¡Usuario no tiene permisos!');
                $redirect->to('/home')->send();
            }
        }
    }*/


    /**
     * Muestra una lista de los registros.
     *
     * @return Response
     */
    public function index()
    {
        //Se genera paginación cada $cantPages registros.
        //$cantPages = 10;
        //Se obtienen todas los contratos.
        //$estados = Estado::paginate($cantPages);

        $estados = DB::table('estados')
            ->join('tipoestados', 'estados.tipo_estado', '=', 'tipoestados.id')
            ->select('estados.*', 
                     'tipoestados.id as tipoestado_id',
                     'tipoestados.descripcion as tipoestado_desc')
            ->get();


        //print_r($estados);


        //Se carga la vista y se pasan los registros. ->paginate($cantPages)
        return view('estados/index')->with('estados', $estados);
    }

    /**
     * Muestra el formulario para crear un nuevo registro.
     *
     * @return Response
     */
    public function create()
    {
        // Carga el formulario para crear un nuevo registro (views/create.blade.php)
        return view('estados/create');
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
                'descripcion' => ['required', 'max:50']
            ]);
        //Guarda todos los datos recibidos del formulario
        $estado = request()->except(['_token']);


        Estado::create($estado);

        //Permite seleccionar los datos que se desean guardar.
        /*
        $contrato = new Contrato;
        $contrato->titulo = Input::get('titulo');
        $contrato->status = Contrato::NUEVA;
        $contrato->created_by = auth()->user()->username;
        $contrato->save();
        */

        // redirecciona al index de controlador
        Session::flash('message', 'Tipo de estado creado exitosamente!');
        return redirect()->to('estados');
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
        //$estado = Estado::find($id);
        // Muestra la vista y pasa el registro
        $estado = DB::table('estados')
            ->join('tipoestados', 'estados.tipo_estado', '=', 'tipoestados.id')
            ->select('estados.*', 
                     'tipoestados.id as tipoestado_id',
                     'tipoestados.descripcion as tipoestado_desc')
            ->where('estados.tipo_estado','=',$id)
            ->get();

        //dd($estado);

        //return $estado;
            return view('estados/show', compact('estado'));

        //print_r($estado);
        //return view('estados/show')->with('estado', $estado);
        //return view('estados/show', compact('estado'));
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
        $estado = Estado::find($id);

        // Muestra el formulario de edición y pasa el registro a editar
        return view('estados/edit')->with('tipoestado', $estado);
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
            'descripcion' => ['required', 'max:100'],
            'observaciones' => ['max:500']
        ]);

        // Se obtiene el registro
        $estado = Estado::find($id);
        $estado->descripcion = Input::get('descripcion');
        $estado->observaciones = Input::get('observaciones');
        //$estado->edited_by = auth()->user()->username;
        $estado->save();

        // redirecciona al index de controlador
        Session::flash('message', 'Tipo de estado actualizado exitosamente!');
        return redirect()->to('estados/'.$id);
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
        $estado = Estado::find($id);
        $estado->delete();

        // redirecciona al index de controlador
        Session::flash('message', 'Tipo estado '.$id.' borrado!');
        return redirect()->to('estados');
    }

}

