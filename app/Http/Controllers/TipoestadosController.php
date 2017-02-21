<?php

namespace reservas\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Route;

use reservas\Http\Requests;
use reservas\Tipoestado;

use Session;
use Illuminate\Support\Facades\Input;


class TipoEstadosController extends Controller
{
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
        $cantPages = 10;
        //Se obtienen todas los contratos.
        $tipoestados = Tipoestado::paginate($cantPages);


        //Se carga la vista y se pasan los registros. ->paginate($cantPages)
        return view('tipoestados/index')->with('tipoestados', $tipoestados);
    }

    /**
     * Muestra el formulario para crear un nuevo registro.
     *
     * @return Response
     */
    public function create()
    {
        // Carga el formulario para crear un nuevo registro (views/create.blade.php)
        return view('tipoestados/create');
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
                'TIES_DESCRIPCION' => ['required', 'max:50'],
                'TIES_OBSERVACIONES' => ['required', 'max:100']
                
            ]);
        //Guarda todos los datos recibidos del formulario
        $tipoestado = request()->except(['_token']);


         $tipoestado = Tipoestado::create($tipoestado);
         $tipoestado->TIES_CREADOPOR = auth()->user()->username;
        //Se guarda modelo
        $tipoestado->save();


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
        return redirect()->to('tipoestados');
    }


    /**
     * Muestra información de un registro.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($TIES_ID)
    {
        // Se obtiene el registro
        $tipoestado = Tipoestado::findOrFail($TIES_ID);
        // Muestra la vista y pasa el registro
        return view('tipoestados/show', compact('tipoestado'));        
    }

    /**
     * Muestra el formulario para editar un registro en particular.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($TIES_ID)
    {
        // Se obtiene el registro
        $tipoestado = Tipoestado::findOrFail($TIES_ID);

        // Muestra el formulario de edición y pasa el registro a editar
        return view('tipoestados/edit', compact('tipoestado'));   
        //return view('tipoestados/edit')->with('tipoestado', $tipoestado);
    }

    /**
     * Actualiza un registro en la base de datos.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($TIES_ID)
    {
        //Validación de datos
        $this->validate(request(), [
                 'TIES_DESCRIPCION' => ['required', 'max:50'],
                'TIES_OBSERVACIONES' => ['required', 'max:100']
        ]);

        // Se obtiene el registro
        $tipoestado = Tipoestado::findOrFail($TIES_ID);
        $tipoestado->TIES_DESCRIPCION = Input::get('TIES_DESCRIPCION');
        $tipoestado->TIES_OBSERVACIONES = Input::get('TIES_OBSERVACIONES');
        //$tipoestado->edited_by = auth()->user()->username;
        $tipoestado->TIES_MODIFICADOPOR = auth()->user()->username;
        $tipoestado->save();

        // redirecciona al index de controlador
        Session::flash('message', 'Tipo de estado actualizado exitosamente!');
        return redirect()->to('tipoestados/');
    }

    /**
     * Elimina un registro de la base de datos.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($TIES_ID)
    {
        // delete
        $tipoestado = Tipoestado::findOrFail($TIES_ID);
        $tipoestado->TIES_ELIMINADOPOR = auth()->user()->username;
        $tipoestado->save();        
        $tipoestado->delete();

        // redirecciona al index de controlador
        Session::flash('message', 'Tipo estado '.$TIES_ID.' borrado!');
        return redirect()->to('tipoestados');
    }

}

