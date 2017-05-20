<?php

namespace reservas\Http\Controllers;

use Illuminate\Http\Request;

use reservas\Http\Requests;
use reservas\Reserva;
use reservas\Autorizacion;
use reservas\Estado;
use Carbon\Carbon;

use reservas\Mail;

use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Route;
use Illuminate\Routing\Redirector;

class ReservasController extends Controller
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
				if( ! in_array($role , ['admin','editor','docente']))//Si el rol no es admin o editor, se niega el acceso.
				{
					Session::flash('alert-danger', '¡Usuario no tiene permisos!');
					abort(403, '¡Usuario no tiene permisos!.');
				}
			}
		}
	}

	public function show()
	{
		return view('reservas/index');
	}

	public function listarReservas()
	{
		return view('reservas/listarreservas');
	}
   
	
	/**
	 * Muestra una lista de los registros.
	 *
	 * @return Response
	 */
	public function index($sala = null)
	{

		//$sala = $request->input('sala');
		
		$data = array(); //declaramos un array principal que va contener los datos

		//$reservas = \reservas\Sala::findOrFail($sala)->reservas;
		$reservas = \reservas\Reserva::programadas()
									->join('SALAS', 'SALAS.SALA_ID', '=', 'RESERVAS.SALA_ID')
									->join('SEDES', 'SEDES.SEDE_ID', '=', 'SALAS.SEDE_ID')
									->join('RESERVAS_AUTORIZADAS AS RES_AUT', 'RES_AUT.RESE_ID', '=', 'RESERVAS.RESE_ID')
									->join('AUTORIZACIONES AS AUTORIZ', 'AUTORIZ.AUTO_ID', '=', 'RESERVAS_AUTORIZADAS.AUTO_ID')
									->join('ESTADOS', 'ESTADOS.ESTA_ID', '=', 'AUTORIZACIONES.ESTA_ID')
									->join('MATERIAS', 'MATERIAS.MATE_CODIGOMATERIA', '=', 'AUTORIZ.MATE_CODIGOMATERIA')
									->join('GRUPOS', 'GRUPOS.GRUP_ID', '=', 'AUTORIZ.GRUP_ID')
									->where('RESERVAS.SALA_ID', $sala)
									->join('UNIDADES', 'UNIDADES.UNID_ID', '=', 'AUTORIZ.UNID_ID')
						->join('PERSONANATURALGENERAL', 'PERSONANATURALGENERAL.PEGE_ID', '=', 'AUTORIZ.PEGE_ID')
						->where('RESERVAS.SALA_ID', $sala)
						->get();

		$count = count($reservas); //contamos los ids obtenidos para saber el numero exacto de eventos
		
		//hacemos un ciclo para anidar los valores obtenidos a nuestro array principal $data
		for($i=0;$i<$count;$i++){

			//Se calcula el color de la reserva según el estado de la autorización
			$ESTA_ID = $reservas[$i]->autorizaciones->first()->ESTA_ID;
			switch ($ESTA_ID) {
				case Estado::RESERVA_PENDIENTE:
					$backgroundColor = Reserva::COLOR_PENDIENTE;
					break;
				case Estado::RESERVA_APROBADA:
					$backgroundColor = Reserva::COLOR_APROBADO;
					break;
				case Estado::RESERVA_RECHAZADA:
					$backgroundColor = Reserva::COLOR_RECHAZADO;
					break;
				case Estado::RESERVA_ANULADA:
					$backgroundColor = Reserva::COLOR_RECHAZADO;
					break;
				default:
					$backgroundColor = Reserva::COLOR_FINALIZADO;
					break;
			}
			
			$data[$i] = [
				"title"=>substr($reservas[$i]->MATE_NOMBRE, 0, 3) . "..", //obligatoriamente "title", "start" y "url" son campos requeridos
				"start"=>$reservas[$i]->RESE_FECHAINI, //por el plugin asi que asignamos a cada uno el valor correspondiente
				"end"=>$reservas[$i]->RESE_FECHAFIN,
				"allDay"=>$reservas[$i]->ALLDAY,
				//"backgroundColor"=>$reservas[$i]->RESE_COLOR,
				"backgroundColor"=>$backgroundColor,
				//"borderColor"=>$borde[$i],
				"RESE_ID"=>$reservas[$i]->RESE_ID,
				"SALA_DESCRIPCION"=>$reservas[$i]->SALA_DESCRIPCION,
				"SALA_CAPACIDAD"=>$reservas[$i]->SALA_CAPACIDAD,
				"SEDE_DESCRIPCION"=>$reservas[$i]->SEDE_DESCRIPCION,
				"ESTA_DESCRIPCION" => $reservas[$i]->ESTA_DESCRIPCION,
				"AUTO_ID" => $reservas[$i]->AUTO_ID,
				"count_reservas" => Autorizacion::find($reservas[$i]->AUTO_ID)->reservas->count(),
				"RESE_CREADOPOR" => $reservas[$i]->RESE_CREADOPOR,
				"MATE_NOMBRE"=>$reservas[$i]->MATE_NOMBRE,
				"UNID_NOMBRE"=>$reservas[$i]->UNID_NOMBRE,
				"GRUP_NOMBRE"=>$reservas[$i]->GRUP_NOMBRE,
				"PENG_NOMBRE"=>$reservas[$i]->PENG_PRIMERNOMBRE . " " . $reservas[$i]->PENG_SEGUNDONOMBRE
				. " " . $reservas[$i]->PENG_PRIMERAPELLIDO . " " . $reservas[$i]->PENG_SEGUNDOAPELLIDO,
				//"url"=>"cargaEventos".$id[$i]
				//en el campo "url" concatenamos el el URL con el id del evento para luego
				//en el evento onclick de JS hacer referencia a este y usar el método show
				//para mostrar los datos completos de un evento
			];
		}
 
		 //convertimos el array principal $data a un objeto Json 
	   return json_encode($data); //para luego retornarlo y estar listo para consumirlo
	}

	public function consultarReservas($sala = null)
	{
		
		$data = array(); //declaramos un array principal que va contener los datos


		//$reservas = \reservas\Sala::findOrFail($sala)->reservas;
		$reservas = \reservas\Reserva::todas()
									->join('SALAS', 'SALAS.SALA_ID', '=', 'RESERVAS.SALA_ID')
									->join('SEDES', 'SEDES.SEDE_ID', '=', 'SALAS.SEDE_ID')
									->join('RESERVAS_AUTORIZADAS AS RES_AUT', 'RES_AUT.RESE_ID', '=', 'RESERVAS.RESE_ID')
									->join('AUTORIZACIONES AS AUTORIZ', 'AUTORIZ.AUTO_ID', '=', 'RESERVAS_AUTORIZADAS.AUTO_ID')
									->join('ESTADOS', 'ESTADOS.ESTA_ID', '=', 'AUTORIZACIONES.ESTA_ID')
									->join('MATERIAS', 'MATERIAS.MATE_CODIGOMATERIA', '=', 'AUTORIZ.MATE_CODIGOMATERIA')
									->join('GRUPOS', 'GRUPOS.GRUP_ID', '=', 'AUTORIZ.GRUP_ID')
									->where('RESERVAS.SALA_ID', $sala)
									//->Where('AUTORIZ.UNID_ID', $facultad)
									->join('UNIDADES', 'UNIDADES.UNID_ID', '=', 'AUTORIZ.UNID_ID')
					->join('PERSONANATURALGENERAL', 'PERSONANATURALGENERAL.PEGE_ID', '=', 'AUTORIZ.PEGE_ID')
					->where('RESERVAS.SALA_ID', $sala)
					//->orWhere('RESERVAS.SALA_ID', '=' , 'RESERVAS.SALA_ID')
						->get();

		$count = count($reservas); //contamos los ids obtenidos para saber el numero exacto de eventos
		
		//hacemos un ciclo para anidar los valores obtenidos a nuestro array principal $data
		for($i=0;$i<$count;$i++){

			//Se calcula el color de la reserva según el estado de la autorización
			$ESTA_ID = $reservas[$i]->autorizaciones->first()->ESTA_ID;
			switch ($ESTA_ID) {
				case Estado::RESERVA_PENDIENTE:
					$backgroundColor = Reserva::COLOR_PENDIENTE;
					break;
				case Estado::RESERVA_APROBADA:
					$backgroundColor = Reserva::COLOR_APROBADO;
					break;
				case Estado::RESERVA_RECHAZADA:
					$backgroundColor = Reserva::COLOR_RECHAZADO;
					break;
				case Estado::RESERVA_ANULADA:
					$backgroundColor = Reserva::COLOR_RECHAZADO;
					break;
				default:
					$backgroundColor = Reserva::COLOR_FINALIZADO;
					break;
			}
			
			$data[$i] = [
				"title"=>substr($reservas[$i]->MATE_NOMBRE, 0, 10) . "..", //obligatoriamente "title", "start" y "url" son campos requeridos
				"start"=>$reservas[$i]->RESE_FECHAINI, //por el plugin asi que asignamos a cada uno el valor correspondiente
				"end"=>$reservas[$i]->RESE_FECHAFIN,
				"allDay"=>$reservas[$i]->ALLDAY,
				//"backgroundColor"=>$reservas[$i]->RESE_COLOR,
				"backgroundColor"=>$backgroundColor,
				//"borderColor"=>$borde[$i],
				"RESE_ID"=>$reservas[$i]->RESE_ID,
				"SALA_DESCRIPCION"=>$reservas[$i]->SALA_DESCRIPCION,
				"SALA_CAPACIDAD"=>$reservas[$i]->SALA_CAPACIDAD,
				"SEDE_DESCRIPCION"=>$reservas[$i]->SEDE_DESCRIPCION,
				"ESTA_DESCRIPCION" => $reservas[$i]->ESTA_DESCRIPCION,
				"AUTO_ID" => $reservas[$i]->AUTO_ID,
				"count_reservas" => Autorizacion::find($reservas[$i]->AUTO_ID)->reservas->count(),
				"RESE_CREADOPOR" => $reservas[$i]->RESE_CREADOPOR,
				"MATE_NOMBRE"=>$reservas[$i]->MATE_NOMBRE,
				"UNID_NOMBRE"=>$reservas[$i]->UNID_NOMBRE,
				"GRUP_NOMBRE"=>$reservas[$i]->GRUP_NOMBRE,
				"PENG_NOMBRE"=>$reservas[$i]->PENG_PRIMERNOMBRE . " " . $reservas[$i]->PENG_SEGUNDONOMBRE
				. " " . $reservas[$i]->PENG_PRIMERAPELLIDO . " " . $reservas[$i]->PENG_SEGUNDOAPELLIDO,
				//"url"=>"cargaEventos".$id[$i]
				//en el campo "url" concatenamos el el URL con el id del evento para luego
				//en el evento onclick de JS hacer referencia a este y usar el método show
				//para mostrar los datos completos de un evento
			];
		}
 
		 //convertimos el array principal $data a un objeto Json 
	   return json_encode($data); //para luego retornarlo y estar listo para consumirlo
	}

	public function consultarReservasFiltro($sala = null)
	{

		$facultad = $_POST["facultad"];

		
		$data = array(); //declaramos un array principal que va contener los datos


		//$reservas = \reservas\Sala::findOrFail($sala)->reservas;
		$reservas = \reservas\Reserva()
									->join('SALAS', 'SALAS.SALA_ID', '=', 'RESERVAS.SALA_ID')
									->join('SEDES', 'SEDES.SEDE_ID', '=', 'SALAS.SEDE_ID')
									->join('RESERVAS_AUTORIZADAS AS RES_AUT', 'RES_AUT.RESE_ID', '=', 'RESERVAS.RESE_ID')
									->join('AUTORIZACIONES AS AUTORIZ', 'AUTORIZ.AUTO_ID', '=', 'RESERVAS_AUTORIZADAS.AUTO_ID')
									->join('ESTADOS', 'ESTADOS.ESTA_ID', '=', 'AUTORIZACIONES.ESTA_ID')
									->join('MATERIAS', 'MATERIAS.MATE_CODIGOMATERIA', '=', 'AUTORIZ.MATE_CODIGOMATERIA')
									->join('GRUPOS', 'GRUPOS.GRUP_ID', '=', 'AUTORIZ.GRUP_ID')
									->where('RESERVAS.SALA_ID', $sala)
									->Where('AUTORIZ.UNID_ID', $facultad)
									->join('UNIDADES', 'UNIDADES.UNID_ID', '=', 'AUTORIZ.UNID_ID')
					->join('PERSONANATURALGENERAL', 'PERSONANATURALGENERAL.PEGE_ID', '=', 'AUTORIZ.PEGE_ID')
					->where('RESERVAS.SALA_ID', $sala)
					//->orWhere('RESERVAS.SALA_ID', '=' , 'RESERVAS.SALA_ID')
						->get();

		$count = count($reservas); //contamos los ids obtenidos para saber el numero exacto de eventos
		
		//hacemos un ciclo para anidar los valores obtenidos a nuestro array principal $data
		for($i=0;$i<$count;$i++){

			//Se calcula el color de la reserva según el estado de la autorización
			$ESTA_ID = $reservas[$i]->autorizaciones->first()->ESTA_ID;
			switch ($ESTA_ID) {
				case Estado::RESERVA_PENDIENTE:
					$backgroundColor = Reserva::COLOR_PENDIENTE;
					break;
				case Estado::RESERVA_APROBADA:
					$backgroundColor = Reserva::COLOR_APROBADO;
					break;
				case Estado::RESERVA_RECHAZADA:
					$backgroundColor = Reserva::COLOR_RECHAZADO;
					break;
				case Estado::RESERVA_ANULADA:
					$backgroundColor = Reserva::COLOR_RECHAZADO;
					break;
				default:
					$backgroundColor = Reserva::COLOR_FINALIZADO;
					break;
			}
			
			$data[$i] = [
				"title"=>substr($reservas[$i]->MATE_NOMBRE, 0, 10) . "..", //obligatoriamente "title", "start" y "url" son campos requeridos
				"start"=>$reservas[$i]->RESE_FECHAINI, //por el plugin asi que asignamos a cada uno el valor correspondiente
				"end"=>$reservas[$i]->RESE_FECHAFIN,
				"allDay"=>$reservas[$i]->ALLDAY,
				//"backgroundColor"=>$reservas[$i]->RESE_COLOR,
				"backgroundColor"=>$backgroundColor,
				//"borderColor"=>$borde[$i],
				"RESE_ID"=>$reservas[$i]->RESE_ID,
				"SALA_DESCRIPCION"=>$reservas[$i]->SALA_DESCRIPCION,
				"SALA_CAPACIDAD"=>$reservas[$i]->SALA_CAPACIDAD,
				"SEDE_DESCRIPCION"=>$reservas[$i]->SEDE_DESCRIPCION,
				"ESTA_DESCRIPCION" => $reservas[$i]->ESTA_DESCRIPCION,
				"AUTO_ID" => $reservas[$i]->AUTO_ID,
				"count_reservas" => Autorizacion::find($reservas[$i]->AUTO_ID)->reservas->count(),
				"RESE_CREADOPOR" => $reservas[$i]->RESE_CREADOPOR,
				"MATE_NOMBRE"=>$reservas[$i]->MATE_NOMBRE,
				"UNID_NOMBRE"=>$reservas[$i]->UNID_NOMBRE,
				"GRUP_NOMBRE"=>$reservas[$i]->GRUP_NOMBRE,
				"PENG_NOMBRE"=>$reservas[$i]->PENG_PRIMERNOMBRE . " " . $reservas[$i]->PENG_SEGUNDONOMBRE
				. " " . $reservas[$i]->PENG_PRIMERAPELLIDO . " " . $reservas[$i]->PENG_SEGUNDOAPELLIDO,
				//"url"=>"cargaEventos".$id[$i]
				//en el campo "url" concatenamos el el URL con el id del evento para luego
				//en el evento onclick de JS hacer referencia a este y usar el método show
				//para mostrar los datos completos de un evento
			];
		}
 
		 //convertimos el array principal $data a un objeto Json 
	   return json_encode($data); //para luego retornarlo y estar listo para consumirlo
	}



	public function create()
	{
		// Carga el formulario para crear un nuevo registro (views/create.blade.php)
		return view('reservas/create');
	}

	public function store()
	{
		//Validación de datos
		
		$this->validate(request(), [
				'start' => ['required', 'max:50'],
				'end' => ['required', 'max:50'],
				'background' => ['required', 'max:100'],
				'title' => ['required', 'max:100'],
				'sala' => ['required', 'max:100'],
			]);
		
		$titulo = Input::get('title');

		$reserva = new Reserva;
		$reserva->RESE_FECHAINI = Input::get('start');
		$reserva->RESE_FECHAFIN = Input::get('end');
		$reserva->RESE_TODOELDIA = false;
		//$reserva->RESE_COLOR = Input::get('background');
		//$reserva->SALA_ID = 1;
		//$reserva->EQUI_ID = null;        

		$sala = \reservas\Sala::findOrFail(Input::get('sala'));
		$reserva->SALA_ID = $sala->SALA_ID;


		if(Input::get('equipo') != 0){
			$equipo = $this->getEquipoDisp($sala->SALA_ID, $reserva->RESE_FECHAINI, $reserva->RESE_FECHAFIN);
			$titulo = "R.E";
			$reserva->EQUI_ID = $equipo->EQUI_ID;
		}

		$reserva->RESE_TITULO = $titulo;
		$reserva->RESE_CREADOPOR = auth()->user()->username;
		$reserva->save();

		
		//Se guarda modelo
		//var_dump($reserva);

		
		//dd($reserva);

		// redirecciona al index de controlador
		Session::flash('alert-info', 'Reserva creado exitosamente!');
		return redirect()->to('reservas');
	}


	/* Crea las reservas recibidas por ajax y su respectiva autorización.
	 * 
	*/
	public function guardarReservas(Request $request)
	{


		$ROLE_ID = auth()->check() ? auth()->user()->ROLE_ID : 0;
		$fechaactual = Carbon::now();

		$rawReservasInput = $request->get('reservas');

		//Arreglo para almacenar los id´s de las reservas creadas
		$arrRESE_ID = [];

		if(!isset($rawReservasInput) OR !is_array($rawReservasInput) OR empty($rawReservasInput)){
			return response()->json([
				'ERROR' => 'Datos incompletos.',
				'reservas' => json_encode($rawReservasInput)
			], 400); //400 Bad Request: La solicitud contiene sintaxis errónea y no debería repetirse
		}

		foreach ($rawReservasInput as $rawReserva) {

			//El color no se guarda en la BD sino que se calcula dependiento el estado de la reserva
			/*if($ROLE_ID == \reservas\Rol::ADMIN)
				$color = Reserva::COLOR_APROBADO;
			else
				$color = Reserva::COLOR_PENDIENTE;*/

			//Crear reserva:
			$reserva = Reserva::create(
				array_only($rawReserva, [
					'RESE_TITULO',
					'RESE_FECHAINI',
					'RESE_TODOELDIA',
					'RESE_FECHAFIN',
					'SALA_ID',
				])/* + [
					'RESE_COLOR' => $color,
				]*/
			);
			//Se adiciona el ID al arreglo de reservas
			array_push($arrRESE_ID, $reserva->RESE_ID);
		}

		//Si se crearon reservas...
		if(count($arrRESE_ID) > 0){


			//Recopiando datos para la autorización...
			$datosAutoriz = $request->only([
				'UNID_ID',
				'PEGE_ID',
				'GRUP_ID',
				'MATE_CODIGOMATERIA',
				]) + [
				'AUTO_FECHASOLICITUD' => $fechaactual,
			];

			//Si el usuario es ADMIN, la reserva se autoriza automáticamente.
			if($ROLE_ID != \reservas\Rol::ADMIN){
				$datosAutoriz = $datosAutoriz + [
					'ESTA_ID' => Estado::RESERVA_PENDIENTE,
					'AUTO_FECHAAPROBACION' => $fechaactual,
				];
			} else {
				$datosAutoriz = $datosAutoriz + [
					'ESTA_ID' => Estado::RESERVA_APROBADA,
				];
			}

			/*return response()->json([
				'request' => json_encode($datosAutoriz)
			]);*/

			//Crear Autorización:
			$autorizacion = Autorizacion::create($datosAutoriz);
			//Creando registros de relación entre AUTORIZACIONES y RESERVAS 
			$autorizacion->reservas()->sync($arrRESE_ID, false);

		} else {
			return response()->json([
				'ERROR' => 'No se crearon reservas.',
				'request' => json_encode($request->all())
			]);
		}

		

		return $arrRESE_ID;
	}



	public function consultaMaterias(){

		//$SEDE_ID = $_POST['sede'];

		$materias = \DB::table('MATERIAS')
							->select(
									'MATERIAS.MATE_CODIGOMATERIA',
									'MATERIAS.MATE_NOMBRE',
									'MATERIAS.UNID_ID')
							//->where('SALAS.SEDE_ID','=',$SEDE_ID)
							->get();

		return json_encode($materias);
		//return $salas;materias
	
	}

	public function consultaFacultades(){

		//$SEDE_ID = $_POST['sede'];

		$facultades = \DB::table('UNIDADES')
							->select(
									'UNIDADES.UNID_ID',
									'UNIDADES.UNID_NOMBRE',
									'UNIDADES.UNID_CODIGO')
							//->where('SALAS.SEDE_ID','=',$SEDE_ID)
							->get();

		return json_encode($facultades);
		//return $salas;materias
	
	}

	public function consultaDocentes(){

		//$UNID_ID = $_POST['unidad'];
		$UNID_ID = Input::get('unidad');

		$docentes = \DB::table('PERSONANATURALGENERAL')
							->select(
									'PERSONANATURALGENERAL.PEGE_ID',
									'PERSONANATURALGENERAL.PENG_PRIMERNOMBRE',
									'PERSONANATURALGENERAL.PENG_PRIMERAPELLIDO',
									'PERSONANATURALGENERAL.PENG_SEGUNDOAPELLIDO',
									'PERSONANATURALGENERAL.PENG_SEGUNDONOMBRE')
							->join('PERSONAGENERAL','PERSONAGENERAL.PEGE_ID','=','PERSONANATURALGENERAL.PEGE_ID')
							->join('DOCENTESUNIDADES','PERSONAGENERAL.PEGE_ID','=','DOCENTESUNIDADES.PEGE_ID')
							->where('DOCENTESUNIDADES.UNID_ID','=',$UNID_ID)
							->get();

		return json_encode($docentes);
		//return $salas;materias
	
	}

	public function consultaDocentesd(){

		//$UNID_ID = $_POST['unidad'];
		$UNID_ID = Input::get('unidad');


		$docentes = \DB::table('PERSONANATURALGENERAL')
							->select(
									'PERSONANATURALGENERAL.PEGE_ID',
									'PERSONANATURALGENERAL.PENG_PRIMERNOMBRE',
									'PERSONANATURALGENERAL.PENG_PRIMERAPELLIDO',
									'PERSONANATURALGENERAL.PENG_SEGUNDOAPELLIDO',
									'PERSONANATURALGENERAL.PENG_SEGUNDONOMBRE')
							->join('PERSONAGENERAL','PERSONAGENERAL.PEGE_ID','=','PERSONANATURALGENERAL.PEGE_ID')
							->join('DOCENTESUNIDADES','PERSONAGENERAL.PEGE_ID','=','DOCENTESUNIDADES.PEGE_ID')
							->where('DOCENTESUNIDADES.UNID_ID','=',$UNID_ID)
							->get();


		return json_encode($docentes);
		//return $salas;materias
	
	}

	public function consultaGrupos(){

		//$SEDE_ID = $_POST['sede'];

		$grupos = \DB::table('GRUPOS')
							->select(
									'GRUPOS.GRUP_ID',
									'GRUPOS.GRUP_NOMBRE',
									'GRUPOS.MATE_CODIGOMATERIA')
							//->where('SALAS.SEDE_ID','=',$SEDE_ID)
							->get();

		return json_encode($grupos);
		//return $salas;materias
	
	}


	public function consultaEstados(){

		//$SEDE_ID = $_POST['sede'];

		$estados = \DB::table('ESTADOS')
							->select(
									'ESTADOS.ESTA_ID',
									'ESTADOS.ESTA_DESCRIPCION')
							->where('ESTADOS.TIES_ID','=',3)
							->get();

		return json_encode($estados);
		//return $salas;materias
	
	}


	public function guardarReservasDocente(Request $request)
	{
	  $reservas = Input::all();

	  /*
	  for ($i=0; $i < $hasta; $i++) { 
		  for ($j=0; $j < 7; $j++) { 
			  
		  }
	  }
	  */

	  $fechaactual = Carbon::now();

	  $cont = 0;
	  $idauto = null;

	  foreach ($reservas as $res) {
		  
		foreach ($res as $k) {
		
			if($k[0] != null){
			

				if($cont == 0){
					$idauto = \DB::table('AUTORIZACIONES')->insertGetId(
						[
						'AUTO_FECHASOLICITUD' => $fechaactual, 
						'ESTA_ID' => 'NAP'
						]
					);
				}

				$cont++;

				//Insertando evento a base de datos
				$reserva = new Reserva;
				
				$reserva->RESE_TITULO = $k[0];
				$reserva->RESE_FECHAINI = $k[1];
				$reserva->RESE_TODOELDIA = $k[2];
				$reserva->RESE_COLOR = $k[3];
				$reserva->RESE_FECHAFIN = $k[4];
				$reserva->SALA_ID = $k[5];
				$reserva->EQUI_ID = NULL;
				$reserva->RESE_CREADOPOR = auth()->user()->username;

				$reserva->save();

				$reservaid = $reserva->RESE_ID;

				\DB::table('RESERVAS_AUTORIZADAS')->insertGetId(
						[
						'RESE_ID' => $reservaid, 
						'AUTO_ID' => $idauto
						]
				);

				
			}
		
		}

	  }

	  $correcto = "correcto";
	  return $reserva;
	  //return Response::json($correcto);
	}

	protected function getEquipoDisp($SALA_ID, $start, $end){

		$ids_EqReservados = Reserva::where('SALA_ID', $SALA_ID)
/*
							->where(function ($query) use ($start, $end) {
									$query->where('RESE_FECHAINI', '>', $start)
										->where('RESE_FECHAFIN', '<', $end);
								})
*/
							->orWhere(function ($query) use ($start, $end) {
									$query->where('RESE_FECHAINI', '>', $start)
										->where('RESE_FECHAFIN', '<', $start);
								})

									->get(['EQUI_ID','RESE_FECHAINI','RESE_FECHAFIN'])->toArray();


		dump($ids_EqReservados);

		$equipo = \reservas\Equipo::orderBy('EQUI_ID')
							->where('ESTA_ID', 2)
							->where('SALA_ID', $SALA_ID)
							->whereNotIn('EQUI_ID', $ids_EqReservados)
							->get()
							->first();

		dd($equipo);


		return $equipo;
	}





	public function create2(){
		//Valores recibidos via ajax
		$title = $_POST['title'];
		$start = $_POST['start'];
		$back = $_POST['background'];
		$end = $_POST['end'];
		$sala = $_POST['sala'];
		$equipo = $_POST['equipo'];

		//Insertando evento a base de datos
		$reserva = new Reserva;
		$reserva->RESE_FECHAINI = $start;
		$reserva->RESE_FECHAFIN = $end;
		$reserva->RESE_TODOELDIA =false;
		$reserva->RESE_COLOR = $back;
		$reserva->RESE_TITULO = $title;
		$reserva->SALA_ID = $sala;

		if($equipo != 0){
			$equipo = $this->getEquipoDisp($sala, $reserva->RESE_FECHAINI, $reserva->RESE_FECHAFIN);
			$reserva->EQUI_ID = $equipo->EQUI_ID;
		}

		$reserva->save();
   }

   public function update(){
		//Valores recibidos via ajax
		$id = $_POST['id'];
		$title = $_POST['title'];
		$start = $_POST['start'];
		$end = $_POST['end'];
		$allDay = $_POST['allday'];
		$back = $_POST['background'];

		$evento=Reserva::find($id);
		if($end=='NULL'){
			$evento->fechafin=NULL;
		}else{
			$evento->fechafin=$end;
		}
		$evento->fechaini=$start;
		$evento->todoeldia=$allDay;
		$evento->color=$back;
		$evento->titulo=$title;
		//$evento->fechafin=$end;

		$evento->save();
   }

   public function delete(){
		//Valor id recibidos via ajax
		$id = $_POST['id'];

		Reserva::destroy($id);
   }

}
