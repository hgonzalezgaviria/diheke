<?php

namespace reservas\Http\Controllers;

use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Route;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Routing\Redirector;
use Validator;

use reservas\Academusoft\Unidad;
use reservas\Academusoft\Materia;
use reservas\Academusoft\Grupo;
use reservas\Academusoft\PersonaNaturalGeneral;
use reservas\Academusoft\PersonaGeneral;
use reservas\Academusoft\DocenteGrupo;
use reservas\Academusoft\DocenteUnidad;

class UploadFacultadController extends Controller
{
	public function __construct(Redirector $redirect=null)
	{
		//Requiere que el usuario inicie sesión.
		$this->middleware('auth');
		
		if(!auth()->guest() && isset($redirect)){
			$action = Route::currentRouteAction();
            $role = isset(auth()->user()->rol->ROLE_ROL) ? auth()->user()->rol->ROLE_ROL : 'guest';
            
			//Lista de acciones que solo puede realizar los administradores o los editores
			$arrActionsAdmin = array('index', 'upload', 'eliminarRegistros');

			if(in_array(explode("@", $action)[1], $arrActionsAdmin))//Si la acción del controlador se encuentra en la lista de acciones de admin...
			{
				if( ! in_array($role , ['admin']))//Si el rol no es admin, se niega el acceso.
				{
					//Session::flash('error', '¡Usuario no tiene permisos!');
					abort(403, '¡Usuario no tiene permisos!.');
				}
			}
		}
	}

	/**
	 * Muestra formulario para carga de archivo al servidor.
	 *
	 * @return Response
	 */
	public function index()
	{
		$unidad = Unidad::all();
		$grupo = Grupo::all();
		$materia = Materia::all();
		$personaNaturalGeneral = PersonaNaturalGeneral::all();
		$personaGeneral = PersonaGeneral::all();
		$docenteGrupo = DocenteGrupo::all();
		$docenteUnidad = DocenteUnidad::all();

		$collections = compact(
			'unidad',
			'grupo',
			'materia',
			'personaNaturalGeneral',
			'personaGeneral',
			'docenteGrupo',
			'docenteUnidad'
		);

		return view('upload.upload', compact('collections'));
	}



	/**
	 * Muestra formulario para carga de archivo al servidor.
	 *
	 * @return Response
	 */
	public function upload()
	{
		$this->validate(request(), [
			'archivo' => ['required', 'file'],
		]);

		if (Input::file('archivo')->isValid()) {

			$archivo = Input::file('archivo');
			$path = $archivo->getRealPath();
			$sheetUsers = Excel::load($path, function($reader) {
			})->get();


			$errors = [];
			foreach($sheetUsers as $sheet)
			{
				$errors = $errors + $this->crearRegistros($sheet);
			}
		}

		return redirect('upload')->withErrors(compact('errors'));
	}


	/**
	 * 
	 *
	 */
	protected function crearRegistros($sheet)
	{
		$errors = [];
		$className = '\\reservas\\Academusoft\\' . ucwords(strtolower($sheet->getTitle()));

		if(class_exists($className)){

			if(!empty($sheet) && $sheet->count()){
				foreach ($sheet as $index => $row){

					$modelo = new $className;
					$primaryKey = $modelo->getKeyName();
					//Se busca el registro en la base de datos.
					$modelo = $className::find($row->$primaryKey);

					//Si el registro no existe...
					if( !isset($modelo) ){
						$modelo = new $className;
					}

					//Se instancia modelo
					$modelo = new $className;
					$data = [];
					foreach ($row as $key => $value) {
						if( !empty($key) ){
							if(empty($value) or is_null($value))
								$value = '';
							$data += [$key => $value];
						}
					}

					$creadopor = strtoupper(substr($modelo::CREATED_AT, 0, 4)).'_creadopor';
					$data += [$creadopor => auth()->user()->username];

					//Se guarda modelo
					try{
						$modelo = $className::create($data);
						//$modelo->save();
					}
					catch (\Exception $e){
						$strErr = class_basename($className).' > Fila '.($index+2).' :';
						if ($e instanceof \Illuminate\Database\QueryException OR $e instanceof \PDOException)
							$strErr = $strErr . $e->getPrevious()->errorInfo[2];
						elseif(isset($validator) && !empty($validator->messages()))
							$strErr = $strErr .array_implode( ': ', ' ', $validator->messages()->toArray());
						else
							$strErr = $strErr . $e->getMessage();

						array_push($errors, $strErr);
					}
				}
			}
		}
		else {
			$strErr = 'ClassException > No existe la clase '.$className;
			array_push($errors, $strErr);
		}
		return $errors;
	}



	/**
	 * Get a validator for an incoming registration request.
	 *
	 * @param  array  $data
	 * @return \Illuminate\Contracts\Validation\Validator
	 */
	protected function validator(array $data)
	{
		$arrVal = [
			'name' => 'required|max:255',
			'username' => 'required|max:15|unique:USERS',
			'email' => 'required|email|max:255|unique:USERS',
			'password' => 'required|min:6',
			'ROLE_id' => 'required',
		];

		if(isset($data['USER_id'])){
			$arrVal['username'] = $arrVal['username'] . ',username,'.$data['USER_id'].',USER_id';
			$arrVal['email'] = $arrVal['email'] . ',email,'.$data['USER_id'].',USER_id';
		}

		return \Validator::make($data, $arrVal);
	}


	/**
	 * Elimina todos los registros borrados de la base de datos.
	 *
	 * @param  int  $CERT_id
	 * @return Response
	 */
	public function eliminarRegistros($showMsg=True)
	{
		$nameModel = ucwords(strtolower(Input::get('nameModel')));
		$className = '\\reservas\\Academusoft\\' . $nameModel;
		$models = $className::getQuery();
		$count = count($models->get());
		$models->delete();

		// redirecciona al index de controlador
		if($showMsg){
			Session::flash('message', '¡'.$count.' '.class_basename($className).'(s) eliminados y sus relaciones exitosamente!');
			return redirect()->back();
		}
	}

}