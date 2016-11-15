<?php

namespace reservas\Http\Controllers;

use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Route;
use Illuminate\Routing\Redirector;

use reservas\TipoUnidad;

class TipoUnidadController extends Controller
{
    public function __construct(Redirector $redirect=null)
    {
        //Requiere que el usuario inicie sesión.
        $this->middleware('auth');
        if(isset($redirect)){

            $action = Route::currentRouteAction();
            $role = isset(auth()->user()->role) ? auth()->user()->role : 'user';

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
        //Se obtienen todos los registros.
        $tiposUnidades = TipoUnidad::all();
        //Se carga la vista y se pasan los registros
        return view('tipounidad/index', compact('tiposUnidades'));
    }

    /**
     * Muestra el formulario para crear un nuevo registro.
     *
     * @return Response
     */
    public function create()
    {
        return view('tipounidad/create');
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
            'TIUN_DESCRIPCION' => ['required', 'max:300'],
        ]);

        //Permite seleccionar los datos que se desean guardar.
        $tipoUnidad = new TipoUnidad;
        $tipoUnidad->TIUN_DESCRIPCION = Input::get('TIUN_DESCRIPCION');
        $tipoUnidad->TIUN_CREADOPOR = auth()->user()->username;
        //Se guarda modelo
        $tipoUnidad->save();

        // redirecciona al index de controlador
        Session::flash('message', 'Tipo de Unidad '.$tipoUnidad->TIUN_ID.' creado exitosamente!');
        return redirect()->to('tipounidad');
    }


    /**
     * Muestra información de un registro.
     *
     * @param  int  $TIUN_ID
     * @return Response
     */
    public function show($TIUN_ID)
    {
        // Se obtiene el registro
        $tipoUnidad = TipoUnidad::findOrFail($TIUN_ID);

        // Muestra la vista y pasa el registro
        return view('tipounidad/show', compact('tipoUnidad'));
    }


    /**
     * Muestra el formulario para editar un registro en particular.
     *
     * @param  int  $TIUN_ID
     * @return Response
     */
    public function edit($TIUN_ID)
    {
        // Se obtiene el registro
        $tipoUnidad = TipoUnidad::findOrFail($TIUN_ID);

        // Muestra el formulario de edición y pasa el registro a editar
        return view('tipounidad/edit', compact('tipoUnidad'));
    }


    /**
     * Actualiza un registro en la base de datos.
     *
     * @param  int  $TIUN_ID
     * @return Response
     */
    public function update($TIUN_ID)
    {
        //Validación de datos
        $this->validate(request(), [
            'TIUN_DESCRIPCION' => ['required', 'max:300'],
        ]);

        // Se obtiene el registro
        $tipoUnidad = TipoUnidad::findOrFail($TIUN_ID);

        $tipoUnidad->TIUN_DESCRIPCION = Input::get('TIUN_DESCRIPCION');
        $tipoUnidad->TIUN_MODIFICADOPOR = auth()->user()->username;
        //Se guarda modelo
        $tipoUnidad->save();

        // redirecciona al index de controlador
        Session::flash('message', 'Tipo de Unidad '.$tipoUnidad->TIUN_ID.' modificado exitosamente!');
        return redirect()->to('tipounidad');
    }

    /**
     * Elimina un registro de la base de datos.
     *
     * @param  int  $TIUN_ID
     * @return Response
     */
    public function destroy($TIUN_ID, $showMsg=True)
    {
        $tipoUnidad = TipoUnidad::findOrFail($TIUN_ID);

        try {
            // delete
            $tipoUnidad->TIUN_ELIMINADOPOR = auth()->user()->username;
            $tipoUnidad->save();
            $tipoUnidad->delete();
        }
        catch (\Illuminate\Database\QueryException $e) {
            if($e->getCode() == "23000"){ //23000 is sql code for integrity constraint violation
                abort(400, '¡Error 23000 (sql code): Integrity constraint violation!.');
            }
        }

        // redirecciona al index de controlador
        if($showMsg){
            Session::flash('message', 'Tipo de Unidad '.$tipoUnidad->TIUN_ID.' eliminado exitosamente!');
            return redirect()->to('tipounidad');
        }
    }


}

