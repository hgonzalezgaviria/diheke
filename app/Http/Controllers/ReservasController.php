<?php

namespace reservas\Http\Controllers;

use Illuminate\Http\Request;

use reservas\Http\Requests;

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
        //$contratos = Contrato::paginate($cantPages);


        //Se carga la vista y se pasan los registros. ->paginate($cantPages)
        return view('reservas/index');
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
