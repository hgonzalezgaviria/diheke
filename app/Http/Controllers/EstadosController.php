<?php

namespace reservas\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Route;

use reservas\Http\Requests;
use reservas\Estado;
use reservas\Tipoestado;

use Session;
use Illuminate\Support\Facades\Input;
use DB;


class EstadosController extends Controller
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
       $estados=Estado::all();


        //Se carga la vista y se pasan los registros. 
        return view('estados/index')->with('estados', $estados);
    }

    /**
     * Muestra el formulario para crear un nuevo registro.
     *
     * @return Response
     */
    public function create()
    {
        //Se crea un array con los tipos de estados disponibles
        $tipoestados = \reservas\TipoEstado::orderBy('TIES_ID')
                        ->select('TIES_ID', 'TIES_DESCRIPCION')
                        ->get();

        $arrTipoEstados = [];
        foreach ($tipoestados as $tipoestado) {
            $arrTipoEstados = array_add(
                $arrTipoEstados,
                $tipoestado->TIES_ID,
                $tipoestado->TIES_DESCRIPCION
            );
        }

        // Carga el formulario para crear un nuevo registro (views/create.blade.php)
        return view('estados/create',compact('arrTipoEstados'));
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
                'ESTA_DESCRIPCION' => ['required', 'max:50']
            ]);
        //Guarda todos los datos recibidos del formulario
        $estado = request()->except(['_token']);

        $estado= Estado::create($estado);

        

        $estado->ESTA_CREADOPOR = auth()->user()->username;
        //Se guarda modelo
        $estado->save();


        //Permite seleccionar los datos que se desean guardar.

        /*
        $contrato = new Contrato;
        $contrato->titulo = Input::get('titulo');
        $contrato->status = Contrato::NUEVA;
        $contrato->created_by = auth()->user()->username;
        $contrato->save();
        */

        // redirecciona al index de controlador
        Session::flash('message', 'Estado creado exitosamente!');
        return redirect()->to('estados');
    }


    /**
     * Muestra información de un registro.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($ESTA_ID)
    {


            // Se obtiene el registro
        $estado = Estado::findOrFail($ESTA_ID);

        // Muestra la vista y pasa el registro
        

        // Se obtiene el registro
        //$estado = Estado::find($id);
        // Muestra la vista y pasa el registro
       /*
        $estado = DB::table('estados')
            ->join('tipoestados', 'estados.tipo_estado', '=', 'tipoestados.id')
            ->select('estados.*', 
                     'tipoestados.id as tipoestado_id',
                     'tipoestados.descripcion as tipoestado_desc')
            ->where('estados.tipo_estado','=',$id)
            ->get();
*/
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
    public function edit($ESTA_ID)
    {
        // Se obtiene el registro
        $estado = Estado::find($ESTA_ID);

        //Se crea un array con los tipos de estados disponibles
        $tipoestados = \reservas\TipoEstado::orderBy('TIES_ID')
                        ->select('TIES_ID', 'TIES_DESCRIPCION')
                        ->get();

        $arrTipoEstados = [];
        foreach ($tipoestados as $tipoestado) {
            $arrTipoEstados = array_add(
                $arrTipoEstados,
                $tipoestado->TIES_ID,
                $tipoestado->TIES_DESCRIPCION
            );
        }

        // Muestra el formulario de edición y pasa el registro a editar
        return view('estados/edit',compact('estado','arrTipoEstados'));
    }

    /**
     * Actualiza un registro en la base de datos.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($ESTA_ID)
    {
        //Validación de datos
        $this->validate(request(), [
            'ESTA_DESCRIPCION' => ['required', 'max:100']
            
        ]);

        // Se obtiene el registro
        $estado = Estado::findOrFail($ESTA_ID);
        // $estado->fill(request()->except(['_token']));

        //$sala = Sala::findOrFail($SALA_ID);
        $estado->ESTA_DESCRIPCION = Input::get('ESTA_DESCRIPCION');
        $estado->TIES_ID = Input::get('TIES_ID');
        //$estado->edited_by = auth()->user()->username;

        $estado->ESTA_MODIFICADOPOR = auth()->user()->username;
        //Se guarda modelo
        $estado->save();


        // redirecciona al index de controlador
        Session::flash('message', 'Estado actualizado exitosamente!');
        return redirect()->to('estados/');
    }

    /**
     * Elimina un registro de la base de datos.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($ESTA_ID)
    {

    $estado = Estado::findOrFail($ESTA_ID);

        // delete
        $estado->ESTA_ELIMINADOPOR = auth()->user()->username;
        $estado->save();
        $estado->delete();

        // delete
        //$estado = Estado::find($ESTA_ID);
        //$estado->delete();

        // redirecciona al index de controlador
        Session::flash('message', 'estado '.$ESTA_ID.' borrado!');
        return redirect()->to('estados');
    }

}

