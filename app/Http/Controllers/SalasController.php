<?php

namespace reservas\Http\Controllers;

use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Route;
use Illuminate\Routing\Redirector;

use reservas\Sala;
use reservas\Equipo;
use reservas\Prestamo;

class SalasController extends Controller
{
	public function __construct(Redirector $redirect=null)
	{
		//Requiere que el usuario inicie sesión.
		$this->middleware('auth');
		if(!auth()->guest() && isset($redirect)){

			$action = Route::currentRouteAction();
			$role = isset(auth()->user()->rol->ROLE_ROL) ? auth()->user()->rol->ROLE_ROL : 'user';

			//Lista de acciones que solo puede realizar los administradores o los editores
			$arrActionsAdmin = array('index', 'create', 'edit', 'store', 'show', 'destroy');

			if(in_array(explode("@", $action)[1], $arrActionsAdmin))//Si la acción del controlador se encuentra en la lista de acciones de admin...
			{
				if( ! in_array($role , ['admin']))//Si el rol no es admin, se niega el acceso.
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
		//Se obtienen todos los registros.
		//$salas = Sala::all();
		$salas = \reservas\Sala::getSalas();

		    $sedes = \DB::table('SEDES')
                           ->select('SEDES.*')
                           ->get();
                


		//Se carga la vista y se pasan los registros
		return view('salas/index', compact('salas','sedes'));
	}

	/**
	 * Muestra el formulario para crear un nuevo registro.
	 *
	 * @return Response
	 */
	public function create()
	{
		//Se crea un array con las sedes disponibles
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


		//Se crea un array con los posibles estados de una sala.
		$tipoEstadoSala = 1;
		$estadosSala = \reservas\Estado::where('TIES_ID', $tipoEstadoSala)
						->orderBy('ESTA_ID')
						->select('ESTA_ID', 'ESTA_DESCRIPCION')
						->get();

		$arrEstadosSala = [];
		foreach ($estadosSala as $estado) {
			$arrEstadosSala = array_add(
				$arrEstadosSala,
				$estado->ESTA_ID,
				$estado->ESTA_DESCRIPCION
			);
		}


		// Carga el formulario para crear un nuevo registro y pasa las variables para llenar los dropdown
		return view('salas/create', compact('arrSedes', 'arrEstadosSala'));
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
			'SALA_DESCRIPCION' => ['required', 'max:300'],
			'SALA_CAPACIDAD' => ['required', 'numeric'],
			'SALA_FOTOSALA' => ['required', 'max:500'],
			'SALA_FOTOCROQUIS' => ['required', 'max:500'],
			'SALA_OBSERVACIONES' => ['required', 'max:300'],
			'ESTA_ID' => ['required', 'numeric'], //Relación con ESTADOS
			'SEDE_ID' => ['required', 'numeric'], //Relación con SEDES
		]);

	
		//Guarda todos los datos recibidos del formulario en un obj Sala
		$sala = new Sala(request()->except(['_token']));
		$sala->SALA_CREADOPOR = auth()->user()->username;
		//Se guarda modelo
		$sala->save();


		$FOTOSALA = request()->file('SALA_FOTOSALA');
		if ($FOTOSALA) {
			$sala->SALA_FOTOSALA = $sala->SALA_ID . '_FOTOSALA.'.$FOTOSALA->getClientOriginalExtension();

			$FOTOSALA->move(public_path('img'), $sala->SALA_FOTOSALA);
		}else{
			$sala->SALA_FOTOSALA = 'default.jpg';
		}

		$FOTOCROQUIS = request()->file('SALA_FOTOCROQUIS');
		if ($FOTOCROQUIS) {
			$sala->SALA_FOTOCROQUIS = $sala->SALA_ID . '_FOTOCROQUIS.'.$FOTOCROQUIS->getClientOriginalExtension();

			$FOTOCROQUIS->move(public_path('img'), $sala->SALA_FOTOCROQUIS);
		}else{
			$sala->SALA_FOTOCROQUIS = 'default.jpg';
		}

		$sala->save();
	 
		// redirecciona al index de controlador
		Session::flash('alert-info', 'Sala '.$sala->SALA_ID.' creada exitosamente!');
		return redirect()->to('salas');
	}


	/**
	 * Muestra información de un registro.
	 *
	 * @param  int  $SALA_ID
	 * @return Response
	 */
	public function show($SALA_ID)
	{
		// Se obtiene el registro
		$sala = Sala::findOrFail($SALA_ID);

		// Muestra la vista y pasa el registro
		return view('salas/show', compact('sala'));
	}


	/**
	 * Muestra el formulario para editar un registro en particular.
	 *
	 * @param  int  $SALA_ID
	 * @return Response
	 */
	public function edit($SALA_ID)
	{
		// Se obtiene el registro a modificar
		$sala = Sala::findOrFail($SALA_ID);

		//Se crea un array con las sedes disponibles
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


		//Se crea un array con los posibles estados de una sala.
		$tipoEstadoSala = 1;
		$estadosSala = \reservas\Estado::where('TIES_ID', $tipoEstadoSala)
						->orderBy('ESTA_ID')
						->select('ESTA_ID', 'ESTA_DESCRIPCION')
						->get();

		$arrEstadosSala = [];
		foreach ($estadosSala as $estado) {
			$arrEstadosSala = array_add(
				$arrEstadosSala,
				$estado->ESTA_ID,
				$estado->ESTA_DESCRIPCION
			);
		}


		// Muestra el formulario de edición y pasa el registro a editar
		// y arreglos para llenar los Selects
		return view('salas/edit', compact('sala', 'arrSedes', 'arrEstadosSala'));
	}


	/**
	 * Actualiza un registro en la base de datos.
	 *
	 * @param  int  $SALA_ID
	 * @return Response
	 */
	public function update($SALA_ID)
	{
		$this->validate(request(), [
			'SALA_DESCRIPCION' => ['required', 'max:300'],
			'SALA_CAPACIDAD' => ['required', 'numeric'],
			//'SALA_FOTOSALA' => ['required', 'max:500'],
			//'SALA_FOTOCROQUIS' => ['required', 'max:500'],
			'SALA_OBSERVACIONES' => ['required', 'max:300'],
			'ESTA_ID' => ['required', 'numeric'], //Relación con ESTADOS
			'SEDE_ID' => ['required', 'numeric'], //Relación con SEDES
		]);


		//Guarda todos los datos recibidos del formulario en un obj Sala
		$sala = Sala::findOrFail($SALA_ID);

		$sala->fill(request()->except(['_token', 'SALA_FOTOSALA', 'SALA_FOTOCROQUIS']));

		$sala->SALA_MODIFICADOPOR = auth()->user()->username;
		//Se guarda modelo
		$sala->save();



		$FOTOSALA = request()->file('SALA_FOTOSALA');
		if ($FOTOSALA) {
			//Si ya existe una foto...
			if ($sala->SALA_FOTOSALA != 'default.jpg') {
				// borrar archivo foto actual
				unlink(public_path('img/'.$sala->SALA_FOTOSALA));
			}
			$sala->SALA_FOTOSALA = $sala->SALA_ID . '_FOTOSALA.'.$FOTOSALA->getClientOriginalExtension();
			$FOTOSALA->move(public_path('img'), $sala->SALA_FOTOSALA);
		}

		$FOTOCROQUIS = request()->file('SALA_FOTOCROQUIS');
		if ($FOTOCROQUIS) {
			//Si ya existe una foto...
			if ($sala->SALA_FOTOCROQUIS != 'default.jpg') {
				// borrar archivo foto actual
				unlink(public_path('img/'.$sala->SALA_FOTOCROQUIS));
			}
			$sala->SALA_FOTOCROQUIS = $sala->SALA_ID . '_FOTOCROQUIS.'.$FOTOCROQUIS->getClientOriginalExtension();
			$FOTOCROQUIS->move(public_path('img'), $sala->SALA_FOTOCROQUIS);
		}



		$sala->save();

		// redirecciona al index de controlador
		Session::flash('alert-info', 'Sala '.$sala->SALA_ID.' modificada exitosamente!');
		return redirect()->to('salas');
	}

	/**
	 * Elimina un registro de la base de datos.
	 *
	 * @param  int  $SALA_ID
	 * @return Response
	 */
	public function destroy($SALA_ID, $showMsg=true)
	{
		$sala = Sala::findOrFail($SALA_ID);

		// delete
		//dd($this->validaDatosRelacionados($SALA_ID));
		if($this->validaDatosRelacionados($SALA_ID)) {
			$descripcionmsj='La sala '.$sala->SALA_ID.' tiene datos relacionados. No es posible borrar';    	
    			$mensaje='modal-warning';
		}else{
		
		$sala->SALA_ELIMINADOPOR = auth()->user()->username;
		$sala->save();
		$sala->delete();
		$descripcionmsj='La Sede '.$sala->SALA_ID.' eliminada exitosamente!';    		
				$mensaje='modal-success';

	}

		// redirecciona al index de controlador
		if($showMsg){
			Session::flash($mensaje, $descripcionmsj);
			return redirect()->to('salas');
		}
	}	

	public function reservarSalaEquipos($SALA_ID, $showMsg=true)
	{
		$sala = Sala::findOrFail($SALA_ID);
		$descripcionmsj='';
		$mensaje='';

		//dd($this->validaEquipoEnPrestamos($SALA_ID));
		

		$sala->SALA_PRESTAMO =  $sala->SALA_PRESTAMO ? false : true;

		if($this->validaEquipoEnPrestamos($SALA_ID)) {
    		//$sala->SALA_PRESTAMO = 1;
    			$descripcionmsj='La Sala '.$sala->SALA_ID.' Tiene Equipos En prestamos no se puede liberar';    	
    			$mensaje='modal-warning';
		}else{
				if($sala->ESTA_ID == 2){
					$sala->ESTA_ID = 1;
				}else{
					$sala->ESTA_ID = 2;
				}
				
				$sala->save();
				$descripcionmsj='La Sala '.$sala->SALA_ID.' Actualiza exitosamente!';    		
				$mensaje='modal-success';
		}

				// redirecciona al index de controlador
		if($showMsg){
			Session::flash($mensaje, $descripcionmsj);
			return redirect()->to('salas');
		}
	}

	/*
	Funcion que valida si la sala que esta asigna para prestamos tiene equipos en prestamos
	*/
	public function validaEquipoEnPrestamos($SALA_ID)
	{
		//$sala = Equipo::findOrFail($SALA_ID);
		 $data = array(); //declaramos un array principal que va contener los datos
		 $ocupacion=false;
		   $idequiposSalas = \reservas\Equipo::orderBy('EQUI_ID')
                        ->select('EQUI_ID')
                        ->where('SALA_ID', $SALA_ID)
                        ->get();

			$idequiposPrestamo = \reservas\Prestamo::orderBy('EQUI_ID')
                        ->select('EQUI_ID')
                        ->where('PRES_FECHAFIN', null)
                        ->get();
              foreach ($idequiposSalas as $equipos) {

              	foreach ($idequiposPrestamo as $equipop) {
              		if ($equipos->EQUI_ID == $equipop->EQUI_ID){
//              			dd($equipos->EQUI_ID);
              			 $ocupacion=true;
              			 break;
              		}
              	}

              }
			return $ocupacion;
		}

	 public function validaDatosRelacionados($SALA_ID)
    {
             
         $ocupacion=false;
           $idequipossala = \reservas\Equipo::orderBy('SALA_ID')
                        ->select('SALA_ID')
                        ->where('SALA_ID', $SALA_ID)
                        ->count();
                        //->get();

   		/*
   			$idsedesala = \reservas\Recurso::orderBy('SALA_ID')
                        ->select('SALA_ID')
                        ->where('SALA_ID', $SALA_ID)
                        ->count();
                        //->get();
*/
//                          dd($idsedesala);
                        if ($idequipossala>0){
                            $ocupacion=true;
                         //break;
                        }           
                    return $ocupacion;
        }

}

