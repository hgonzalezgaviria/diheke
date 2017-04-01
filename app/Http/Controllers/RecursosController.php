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
        //Se obtienen todas los contratos.
        //$recursos = Recurso::all();
        $recursos = \reservas\Recurso::getRecursos();


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

          $salas = \DB::table('SALAS')
                            ->select('SALAS.*')
                            ->get();        

        $sedes = \DB::table('SEDES')
                            ->select('SEDES.*')
                            ->get();
        // Carga el formulario para crear un nuevo registro (views/create.blade.php)
        return view('recursos/create', compact('salas','sedes'));
        //return view('equipos/create', compact('salas','estados','sedes'));
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
                'RECU_OBSERVACIONES' => ['required', 'max:100'],
                'SALA_ID' => ['required']
            ]);
        //Guarda todos los datos recibidos del formulario
        $recurso = request()->except(['_token']);




        $recurso= Recurso::create($recurso);

        $recurso->RECU_CREADOPOR = auth()->user()->username;

        //Se guarda modelo

        $recurso->save();

        $idsSalas = is_array(Input::get('SALA_ID')) ? Input::get('SALA_ID') : [];
        $recurso->salas()->sync($idsSalas);

        

    

        // redirecciona al index de controlador
        Session::flash('alert-info', 'Recurso creado exitosamente!');
        return redirect()->to('recursos');
    }


    /**
     * Muestra información de un registro.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($RECU_ID)
    {
        // Se obtiene el registro
        $recurso = Recurso::findOrFail($RECU_ID);
        // Muestra la vista y pasa el registro        
        return view('recursos/show', compact('recurso'));
    }

    /**
     * Muestra el formulario para editar un registro en particular.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($RECU_ID)
    {
        // Se obtiene el registro
        $recurso = Recurso::find($RECU_ID);

        $idsSalas = $recurso->salas()->getRelatedIds()->toArray();

           $salas = \DB::table('SALAS')
                            ->select('SALAS.*')
                            ->get();        

        $sedes = \DB::table('SEDES')
                            ->select('SEDES.*')
                            ->get();

        // Muestra el formulario de edición y pasa el registro a editar
        return view('recursos/edit', compact('recurso','idsSalas','salas','sedes'));
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
        $recurso = Recurso::findOrFail($RECU_ID);
        $recurso->RECU_DESCRIPCION = Input::get('RECU_DESCRIPCION');
        $recurso->RECU_VERSION = Input::get('RECU_VERSION');
        $recurso->RECU_OBSERVACIONES = Input::get('RECU_OBSERVACIONES');
        //$recurso->edited_by = auth()->user()->username;
        $recurso->RECU_MODIFICADOPOR = auth()->user()->username;
        $recurso->save();

        $idsSalas = is_array(Input::get('SALA_ID')) ? Input::get('SALA_ID') : [];
        $recurso->salas()->sync($idsSalas);

        // redirecciona al index de controlador
        Session::flash('alert-info', 'Recurso actualizado exitosamente!');
        return redirect()->to('recursos/');
    }

    /**
     * Elimina un registro de la base de datos.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($RECU_ID)
    {
        // delete

        $recurso = Recurso::findOrFail($RECU_ID);

        $recurso->RECU_ELIMINADOPOR = auth()->user()->username;
        $recurso->save();
        $recurso->delete();
        
        // redirecciona al index de controlador
        Session::flash('alert-info', 'Recurso '.$RECU_ID.' borrado!');
        return redirect()->to('recursos');
    }


    public function consultaSalasR(){

        $SEDE_ID = $_POST['sede'];

        $salas = \DB::table('SALAS')
                            ->select('SALAS.SALA_ID','SALAS.SALA_DESCRIPCION')
                            ->where('SALAS.SEDE_ID','=',$SEDE_ID)
                            ->get();

        return json_encode($salas);
        //return $salas;
    }

}

