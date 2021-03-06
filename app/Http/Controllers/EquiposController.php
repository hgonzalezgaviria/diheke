<?php

namespace reservas\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Route;
use Illuminate\Routing\Redirector;

use reservas\Equipo;

class EquiposController extends Controller
{
    //
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
        //Se genera paginación cada $cantPages registros.
        $equipos = Equipo::all();
        //Se obtienen todas los equipos.
/*
        $sedes = \reservas\Sede::orderBy('SEDE_ID')
                        ->select('SEDE_ID', 'SEDE_DESCRIPCION')
                        ->get();

        $arrSedes = [];
        foreach ($sedes as $sede) {
            $arrSedes = array_add(
                $arrSedes,
                $sede->SEDE_ID,
                $sede->SEDE_DESCRIPCION
            );
        }
        */

          $salas = \DB::table('SALAS')
                            ->select('SALAS.*')
                            ->get();

        $sedes = \DB::table('SEDES')
                           ->select('SEDES.*')
                           ->get();


//Covertir imagen en base64
$image = asset('assets/img/Logo_opt1.png');
$type = pathinfo($image, PATHINFO_EXTENSION);
$data = file_get_contents($image);
$dataUri = 'data:image/' . $type . ';base64,' . base64_encode($data);
//dd($dataUri);


        //Se carga la vista y se pasan los registros. ->paginate($cantPages)
        return view('equipos/index', compact('equipos','sedes', 'salas','dataUri'));
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

        $estados = \DB::table('ESTADOS')
                            ->select('ESTADOS.*')
                            ->where('ESTADOS.TIES_ID','=',2)
                            ->get();

        $sedes = \DB::table('SEDES')
                            ->select('SEDES.*')
                            ->get();

        // Carga el formulario para crear un nuevo registro (views/create.blade.php)
        return view('equipos/create', compact('salas','estados','sedes'));
    }

    public function consultaSalas(){

        $SEDE_ID = $_POST['sede'];

        $salas = \DB::table('SALAS')
                            ->select('SALAS.SALA_ID','SALAS.SALA_DESCRIPCION')
                            ->where('SALAS.SEDE_ID','=',$SEDE_ID)
                            ->get();

        return json_encode($salas);
        //return $salas;
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
                'EQUI_DESCRIPCION' => ['required', 'max:300'],
                'EQUI_OBSERVACIONES' => ['max:300'],
                'SALA_ID' => ['required', 'numeric'],
                'ESTA_ID' => ['required', 'numeric']
            ]);
        //Guarda todos los datos recibidos del formulario
        $equipo = request()->except(['_token']);


        $equipo = Equipo::create($equipo);
        $equipo->EQUI_CREADOPOR = auth()->user()->username;
        //Se guarda modelo
        $equipo->save();


        //Permite seleccionar los datos que se desean guardar.
        /*
        $contrato = new Contrato;
        $contrato->titulo = Input::get('titulo');
        $contrato->status = Contrato::NUEVA;
        $contrato->created_by = auth()->user()->username;
        $contrato->save();
        */

        // redirecciona al index de controlador
        Session::flash('alert-info', 'Equipo creado exitosamente!');
        return redirect()->to('equipos');
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
        $equipo = Equipo::find($id);
        // Muestra la vista y pasa el registro
        return view('equipos/show')->with('equipo', $equipo);
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
        $equipo = Equipo::find($id);

        $salas = \DB::table('SALAS')
                            ->select('SALAS.*')
                            ->get();

        $estados = \DB::table('ESTADOS')
                            ->select('ESTADOS.*')
                            ->where('estados.TIES_ID','=',2)
                            ->get();


        $sedes = \DB::table('SEDES')
                            ->select('SEDES.*')
                            ->get();

        // Muestra el formulario de edición y pasa el registro a editar
        return view('equipos/edit', compact('equipo','salas','estados','sedes'));
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
                'EQUI_DESCRIPCION' => ['required', 'max:300'],
                'EQUI_OBSERVACIONES' => ['max:300'],
                'SALA_ID' => ['required', 'numeric'],
                'ESTA_ID' => ['required', 'numeric']
        ]);

        // Se obtiene el registro
        $equipo = Equipo::findOrFail($id);
        $equipo->EQUI_DESCRIPCION = Input::get('EQUI_DESCRIPCION');
        $equipo->EQUI_OBSERVACIONES = Input::get('EQUI_OBSERVACIONES');
        $equipo->SALA_ID = Input::get('SALA_ID');
        $equipo->ESTA_ID = Input::get('ESTA_ID');
        //$equipo->edited_by = auth()->user()->username;
        $equipo->EQUI_MODIFICADOPOR = auth()->user()->username;
        $equipo->save();

        // redirecciona al index de controlador
        Session::flash('alert-info', 'Equipo actualizado exitosamente!');
        return redirect()->to('equipos/'.$id);
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
        $equipo = Equipo::findOrFail($id);
        $equipo->EQUI_ELIMINADOPOR = auth()->user()->username;
        $equipo->save();
        $equipo->delete();

        // redirecciona al index de controlador
        Session::flash('alert-info', 'Equipo '.$id.' borrado!');
        return redirect()->to('equipos');
    }

}
