<?php

namespace reservas\Http\Controllers;

use Illuminate\Http\Request;

use reservas\Http\Requests;
use reservas\Contrato;

use Session;

class ContratosController extends Controller
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
        $cantPages = 10;
        //Se obtienen todas los contratos.
        $contratos = Contrato::paginate($cantPages);


        //Se carga la vista y se pasan los registros. ->paginate($cantPages)
        return view('contratos/index')->with('contratos', $contratos);
    }

    /**
     * Muestra el formulario para crear un nuevo registro.
     *
     * @return Response
     */
    public function create()
    {
        // Carga el formulario para crear un nuevo registro (views/create.blade.php)
        return view('contratos/create');
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
                'nombres' => ['required', 'max:50']
            ]);
        //Guarda todos los datos recibidos del formulario
        $contrato = request()->except(['_token']);


        Contrato::create($contrato);

        //Permite seleccionar los datos que se desean guardar.
        /*
        $contrato = new Contrato;
        $contrato->titulo = Input::get('titulo');
        $contrato->status = Contrato::NUEVA;
        $contrato->created_by = auth()->user()->username;
        $contrato->save();
		*/

        // redirecciona al index de controlador
        Session::flash('message', '¡Contrato creado exitosamente!');
        return redirect()->to('contratos');
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
        $contrato = Contrato::find($id);
        // Muestra la vista y pasa el registro
        return view('contratos/show')->with('contrato', $contrato);
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
        $contrato = Contrato::find($id);

        // Muestra el formulario de edición y pasa el registro a editar
        return view('encuestas/edit')->with('encuesta', $contrato);
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
        $contrato = Contrato::find($id);
        $contrato->titulo = Input::get('titulo');
        $contrato->edited_by = auth()->user()->username;
        $contrato->save();

        // redirecciona al index de controlador
        Session::flash('message', '¡Contrato actualizada exitosamente!');
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
        $contrato = Contrato::find($id);
        $contrato->delete();

        // redirecciona al index de controlador
        Session::flash('message', '¡Contrato '.$id.' borrado!');
        return redirect()->to('contratos');
    }

}

