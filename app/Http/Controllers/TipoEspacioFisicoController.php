<?php

namespace reservas\Http\Controllers;

use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Route;
use Illuminate\Routing\Redirector;

use reservas\TipoEspacioFisico;

class TipoEspacioFisicoController extends Controller
{
    public function __construct(Redirector $redirect=null)
    {
        //Requiere que el usuario inicie sesión.
        $this->middleware('auth');
        if(isset($redirect)){

            $action = Route::currentRouteAction();
            $role = isset(auth()->user()->rol->ROLE_ROL) ? auth()->user()->rol->ROLE_ROL : 'user';

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
        $tiposEspaciosFisicos = TipoEspacioFisico::all();
        //Se carga la vista y se pasan los registros
        return view('tipoespaciofisico/index', compact('tiposEspaciosFisicos'));
    }

    /**
     * Muestra el formulario para crear un nuevo registro.
     *
     * @return Response
     */
    public function create()
    {
        return view('tipoespaciofisico/create');
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
            'TIEF_DESCRIPCION' => ['required', 'max:300'],
        ]);

        //Permite seleccionar los datos que se desean guardar.
        $tipoEspacioFisico = new TipoEspacioFisico;
        $tipoEspacioFisico->TIEF_DESCRIPCION = Input::get('TIEF_DESCRIPCION');
        $tipoEspacioFisico->TIEF_CREADOPOR = auth()->user()->username;
        //Se guarda modelo
        $tipoEspacioFisico->save();

        // redirecciona al index de controlador
        Session::flash('message', 'Tipo de Espacio Físico '.$tipoEspacioFisico->TIEF_ID.' creado exitosamente!');
        return redirect()->to('tipoespaciofisico');
    }


    /**
     * Muestra información de un registro.
     *
     * @param  int  $TIEF_ID
     * @return Response
     */
    public function show($TIEF_ID)
    {
        // Se obtiene el registro
        $tipoEspacioFisico = TipoEspacioFisico::findOrFail($TIEF_ID);

        // Muestra la vista y pasa el registro
        return view('tipoespaciofisico/show', compact('tipoEspacioFisico'));
    }


    /**
     * Muestra el formulario para editar un registro en particular.
     *
     * @param  int  $TIEF_ID
     * @return Response
     */
    public function edit($TIEF_ID)
    {
        // Se obtiene el registro
        $tipoEspacioFisico = TipoEspacioFisico::findOrFail($TIEF_ID);

        // Muestra el formulario de edición y pasa el registro a editar
        return view('tipoespaciofisico/edit', compact('tipoEspacioFisico'));
    }


    /**
     * Actualiza un registro en la base de datos.
     *
     * @param  int  $TIEF_ID
     * @return Response
     */
    public function update($TIEF_ID)
    {
        //Validación de datos
        $this->validate(request(), [
            'TIEF_DESCRIPCION' => ['required', 'max:300'],
        ]);

        // Se obtiene el registro
        $tipoEspacioFisico = TipoEspacioFisico::findOrFail($TIEF_ID);

        $tipoEspacioFisico->TIEF_DESCRIPCION = Input::get('TIEF_DESCRIPCION');
        $tipoEspacioFisico->TIEF_MODIFICADOPOR = auth()->user()->username;
        //Se guarda modelo
        $tipoEspacioFisico->save();

        // redirecciona al index de controlador
        Session::flash('message', 'Tipo de Espacio Físico '.$tipoEspacioFisico->TIEF_ID.' modificado exitosamente!');
        return redirect()->to('tipoespaciofisico');
    }

    /**
     * Elimina un registro de la base de datos.
     *
     * @param  int  $TIEF_ID
     * @return Response
     */
    public function destroy($TIEF_ID, $showMsg=True)
    {
        $tipoEspacioFisico = TipoEspacioFisico::findOrFail($TIEF_ID);

        try {
            // delete
            $tipoEspacioFisico->TIEF_ELIMINADOPOR = auth()->user()->username;
            $tipoEspacioFisico->save();
            $tipoEspacioFisico->delete();
        }
        catch (\Illuminate\Database\QueryException $e) {
            if($e->getCode() == "23000"){ //23000 is sql code for integrity constraint violation
                abort(400, '¡Error 23000 (sql code): Integrity constraint violation!.');
            }
        }

        // redirecciona al index de controlador
        if($showMsg){
            Session::flash('message', 'Tipo de Espacio Físico '.$tipoEspacioFisico->TIEF_ID.' eliminado exitosamente!');
            return redirect()->to('tipoespaciofisico');
        }
    }


}

