<?php

namespace reservas\Http\Controllers;

use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Route;
use Illuminate\Routing\Redirector;

use reservas\TipoRecursoFisico;

class TipoRecursoFisicoController extends Controller
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
        $tiposRecursosFisicos = TipoRecursoFisico::all();
        //Se carga la vista y se pasan los registros
        return view('tiporecursofisico/index', compact('tiposRecursosFisicos'));
    }

    /**
     * Muestra el formulario para crear un nuevo registro.
     *
     * @return Response
     */
    public function create()
    {
        return view('tiporecursofisico/create');
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
            'TIRF_DESCRIPCION' => ['required', 'max:300'],
        ]);

        //Permite seleccionar los datos que se desean guardar.
        $tipoRecursoFisico = new TipoRecursoFisico;
        $tipoRecursoFisico->TIRF_DESCRIPCION = Input::get('TIRF_DESCRIPCION');
        $tipoRecursoFisico->TIRF_CREADOPOR = auth()->user()->username;
        //Se guarda modelo
        $tipoRecursoFisico->save();

        // redirecciona al index de controlador
        Session::flash('message', 'Tipo de Recurso Físico '.$tipoRecursoFisico->TIRF_ID.' creado exitosamente!');
        return redirect()->to('tiporecursofisico');
    }


    /**
     * Muestra información de un registro.
     *
     * @param  int  $TIRF_ID
     * @return Response
     */
    public function show($TIRF_ID)
    {
        // Se obtiene el registro
        $tipoRecursoFisico = TipoRecursoFisico::findOrFail($TIRF_ID);

        // Muestra la vista y pasa el registro
        return view('tiporecursofisico/show', compact('tipoRecursoFisico'));
    }


    /**
     * Muestra el formulario para editar un registro en particular.
     *
     * @param  int  $TIRF_ID
     * @return Response
     */
    public function edit($TIRF_ID)
    {
        // Se obtiene el registro
        $tipoRecursoFisico = TipoRecursoFisico::findOrFail($TIRF_ID);

        // Muestra el formulario de edición y pasa el registro a editar
        return view('tiporecursofisico/edit', compact('tipoRecursoFisico'));
    }


    /**
     * Actualiza un registro en la base de datos.
     *
     * @param  int  $TIRF_ID
     * @return Response
     */
    public function update($TIRF_ID)
    {
        //Validación de datos
        $this->validate(request(), [
            'TIRF_DESCRIPCION' => ['required', 'max:300'],
        ]);

        // Se obtiene el registro
        $tipoRecursoFisico = TipoRecursoFisico::findOrFail($TIRF_ID);

        $tipoRecursoFisico->TIRF_DESCRIPCION = Input::get('TIRF_DESCRIPCION');
        $tipoRecursoFisico->TIRF_MODIFICADOPOR = auth()->user()->username;
        //Se guarda modelo
        $tipoRecursoFisico->save();

        // redirecciona al index de controlador
        Session::flash('message', 'Tipo de Recurso Físico '.$tipoRecursoFisico->TIRF_ID.' modificado exitosamente!');
        return redirect()->to('tiporecursofisico');
    }

    /**
     * Elimina un registro de la base de datos.
     *
     * @param  int  $TIRF_ID
     * @return Response
     */
    public function destroy($TIRF_ID, $showMsg=True)
    {
        $tipoRecursoFisico = TipoRecursoFisico::findOrFail($TIRF_ID);

        try {
            // delete
            $tipoRecursoFisico->TIRF_ELIMINADOPOR = auth()->user()->username;
            $tipoRecursoFisico->save();
            $tipoRecursoFisico->delete();
        }
        catch (\Illuminate\Database\QueryException $e) {
            if($e->getCode() == "23000"){ //23000 is sql code for integrity constraint violation
                abort(400, '¡Error 23000 (sql code): Integrity constraint violation!.');
            }
        }

        // redirecciona al index de controlador
        if($showMsg){
            Session::flash('message', 'Tipo de Recurso Físico '.$tipoRecursoFisico->TIRF_ID.' eliminado exitosamente!');
            return redirect()->to('tiporecursofisico');
        }
    }


}

