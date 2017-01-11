<?php

namespace reservas\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Route;

use reservas\Http\Requests;
use reservas\Recurso;

use Session;
use Illuminate\Support\Facades\Input;


class RecursosController extends Controller
{
    public function __construct(Redirector $redirect=null)
    {
        //Requiere que el usuario inicie sesión.
        $this->middleware('auth');
        if(isset($redirect)){

            $action = Route::currentRouteAction();
            $role = isset(auth()->user()->rol->ROLE_ROL) ? auth()->user()->rol->ROLE_ROL : 'guest';
            
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
        //Se obtienen todas los contratos.
        $recursos = Recurso::all();


        //Se carga la vista y se pasan los registros. ->paginate($cantPages)
        return view('recursos/index', compact('recursos'));
    }

    /**
     * Muestra el formulario para crear un nuevo registro.
     *
     * @return Response
     */
    public function create()
    {
        // Carga el formulario para crear un nuevo registro (views/create.blade.php)
        return view('recursos/create');
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
                'RECU_DESCRIPCION' => ['required', 'max:50'],
                'RECU_VERSION' => ['required', 'max:50'],
                'RECU_OBSERVACIONES' => ['required', 'max:100']
            ]);
        //Guarda todos los datos recibidos del formulario
        $recurso = request()->except(['_token']);


        Recurso::create($recurso);

        //Permite seleccionar los datos que se desean guardar.
        /*
        $contrato = new Contrato;
        $contrato->titulo = Input::get('titulo');
        $contrato->status = Contrato::NUEVA;
        $contrato->created_by = auth()->user()->username;
        $contrato->save();
		*/

        // redirecciona al index de controlador
        Session::flash('message', 'Recurso creado exitosamente!');
        return redirect()->to('recursos');
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
        $recurso = Recurso::find($id);
        // Muestra la vista y pasa el registro
        return view('recursos/show')->with('recurso', $recurso);
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
        $recurso = Recurso::find($id);

        // Muestra el formulario de edición y pasa el registro a editar
        return view('recursos/edit')->with('recurso', $recurso);
    }

    /**
     * Actualiza un registro en la base de datos.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($RECU_ID)
    {
        //Validación de datos
        $this->validate(request(), [
            'RECU_DESCRIPCION' => ['required', 'max:50'],
            'RECU_VERSION' => ['required', 'max:50'],
            'RECU_OBSERVACIONES' => ['required', 'max:100']
        ]);

        // Se obtiene el registro
        $recurso = Recurso::find($RECU_ID);
        $recurso->RECU_DESCRIPCION = Input::get('RECU_DESCRIPCION');
        $recurso->RECU_VERSION = Input::get('RECU_VERSION');
        $recurso->RECU_OBSERVACIONES = Input::get('RECU_OBSERVACIONES');
        //$recurso->edited_by = auth()->user()->username;
        $recurso->save();

        // redirecciona al index de controlador
        Session::flash('message', 'Recurso actualizado exitosamente!');
        return redirect()->to('recursos/');
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
        $recurso = Recurso::find($id);
        $recurso->delete();

        // redirecciona al index de controlador
        Session::flash('message', 'Recurso '.$id.' borrado!');
        return redirect()->to('recursos');
    }

}

