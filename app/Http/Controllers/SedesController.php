<?php

namespace reservas\Http\Controllers;

use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Route;
use Illuminate\Routing\Redirector;

use reservas\Sede;

class SedesController extends Controller
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
		//Se obtienen todos los registros.
		$sedes = Sede::all();


		//Se carga la vista y se pasan los registros
		return view('sedes/index', compact('sedes'));
	}

	/**
	 * Muestra el formulario para crear un nuevo registro.
	 *
	 * @return Response
	 */
	public function create()
	{

		return view('sedes/create');
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
			'SEDE_DESCRIPCION' => ['required', 'max:300'],
			'SEDE_DIRECCION' => ['required', 'max:300'],
			'SEDE_OBSERVACIONES' => ['max:300'],
		]);

        $sede = Sede::create(
			array_merge(
				request()->except(['_token']) ,
				['SEDE_CREADOPOR' => auth()->user()->username]
			)
		);
		

		// redirecciona al index de controlador
		Session::flash('alert-info', 'Sede creada exitosamente!');
		return redirect()->to('sedes');
	}


	/**
	 * Muestra información de un registro.
	 *
	 * @param  int  $SEDE_ID
	 * @return Response
	 */
	public function show($SEDE_ID)
	{
		// Se obtiene el registro
		$sede = Sede::findOrFail($SEDE_ID);

		// Muestra la vista y pasa el registro
		return view('sedes/show', compact('sede'));
	}


	/**
	 * Muestra el formulario para editar un registro en particular.
	 *
	 * @param  int  $SEDE_ID
	 * @return Response
	 */
	public function edit($SEDE_ID)
	{
		// Se obtiene el registro a modificar
		$sede = Sede::findOrFail($SEDE_ID);

		// Muestra el formulario de edición y pasa el registro a editar
		// y arreglos para llenar los Selects
		return view('sedes/edit', compact('sede'));
	}


	/**
	 * Actualiza un registro en la base de datos.
	 *
	 * @param  int  $SEDE_ID
	 * @return Response
	 */
	public function update($SEDE_ID)
	{
		//Validación de datos
		//Validación de datos
		$this->validate(request(), [
			'SEDE_DESCRIPCION' => ['required', 'max:300'],
			'SEDE_DIRECCION' => ['required', 'max:300'],
			'SEDE_OBSERVACIONES' => ['max:300'],
		]);

		// Se obtiene el registro
		$sede = Sede::findOrFail($SEDE_ID);

		$sede->SEDE_DESCRIPCION = Input::get('SEDE_DESCRIPCION');
		$sede->SEDE_DIRECCION = Input::get('SEDE_DIRECCION');
		$sede->SEDE_OBSERVACIONES = Input::get('SEDE_OBSERVACIONES');
        $sede->SEDE_MODIFICADOPOR = auth()->user()->username;
        //Se guarda modelo
		$sede->save();

		// redirecciona al index de controlador
		Session::flash('alert-info', 'Sede '.$sede->SEDE_ID.' modificada exitosamente!');
		return redirect()->to('sedes');
	}

	/**
	 * Elimina un registro de la base de datos.
	 *
	 * @param  int  $SEDE_ID
	 * @return Response
	 */
	public function destroy($SEDE_ID, $showMsg=True)
	{
		$sede = Sede::findOrFail($SEDE_ID);

		// delete
		//dd($this->validaDatosRelacionados($SEDE_ID));
		if($this->validaDatosRelacionados($SEDE_ID)) {
			$descripcionmsj='La Sede '.$sede->SEDE_ID.' tiene datos relacionados. No es posible borrar';    	
    			$mensaje='modal-warning';
		}else{
		$sede->SEDE_ELIMINADOPOR = auth()->user()->username;
		$sede->save();
		$sede->delete();
		$descripcionmsj='La Sede '.$sede->SEDE_ID.' eliminada exitosamente!';    		
				$mensaje='modal-success';


		}
        

		// redirecciona al index de controlador
		if($showMsg){
			Session::flash($mensaje, $descripcionmsj);
			return redirect()->to('sedes');
		}

	}

		public function validaDatosRelacionados($SEDE_ID)
	{
			 
		 $ocupacion=false;
		   $idsedesala = \reservas\Sala::orderBy('SEDE_ID')
                        ->select('SEDE_ID')
                        ->where('SEDE_ID', $SEDE_ID)
                        ->count();
                        //->get();

//	                        dd($idsedesala);
                        if ($idsedesala>0){
                        	$ocupacion=true;
              			 //break;
                        }			
        			return $ocupacion;
		}


}

