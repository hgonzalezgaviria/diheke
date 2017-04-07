<?php

namespace reservas\Http\Controllers\Auth;

use reservas\Http\Controllers\Controller;

use Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Route;
use Illuminate\Routing\Redirector;
use Maatwebsite\Excel\Facades\Excel;

use Illuminate\Http\Request;

use reservas\User;
use reservas\Rol;

class UploadController extends Controller
{

	/**
	 * Crea usuarios por ajax cargados desde un archivo de excel.
	 *
	 */
	public function createFromAjax(Request $request)
	{
		if( auth()->guest() )
			return response()->json([
				'status' => 'ERR',
			    'msg' => 'Usuario no autenticado.',
			], 403);
		
		if( auth()->user()->ROLE_ID != Rol::ADMIN )
			return response()->json([
				'status' => 'ERR',
			    'msg' => 'Usuario no tiene permisos.',
			], 403);

		$currentUser = auth()->user()->username;

		$ROLE_DESCRIPCION = Input::get('rol');
		if(!isset($ROLE_DESCRIPCION))
			return response()->json([
				'status' => 'ERR',
			    'msg' => 'Rol no definido.',
			]);


		$rol = Rol::where('ROLE_DESCRIPCION' , $ROLE_DESCRIPCION)->get()->first();
		if(!isset($rol))
			return response()->json([
				'status' => 'ERR',
			    'msg' => 'Rol '.$ROLE_DESCRIPCION.' no existe.',
			]);

		$data = [
			'name'     => Input::get('name'),
			'username' => Input::get('username'),
			'email'    => Input::get('email'),
			'password' => bcrypt(Input::get('password')),
			'ROLE_ID'  => $rol->ROLE_ID,
		];


		//Se busca el usuario entre los eliminados.
		$usuario = User::onlyTrashed()
		                ->where('username', $data['username'])
		                ->get()->first();

		$USER_ID = isset($usuario) ? $usuario->USER_ID : 0;
		$validator = $this->validator($data, $USER_ID);

		if( !$validator->fails() ) {
			$msg = '';
			//Si el usuario existen en los eliminados...
			if( isset($usuario) ){
				//Se restaura usuario y se actualiza
				$usuario->restore();
				$usuario->update( $data + ['USER_MODIFICADOPOR' => $currentUser] );
				$msg = 'Usuario '.$usuario->username.' restaurado y actualizado.';
			} else {
				//Sino, se crea usuario
				$usuario = User::create( $data + ['USER_CREADOPOR' => $currentUser] );
				$msg = 'Usuario '.$usuario->username.' creado.';
			}

			return response()->json([
						'status' => 'OK',
						'msg' => $msg
					]);
		} else {
			return response()->json([
				'status' => 'ERR',
			    'msg' => json_encode($validator->errors()->all(), JSON_UNESCAPED_UNICODE)
			]);
		}

	}


	/**
	 * Get a validator for an incoming registration request.
	 *
	 * @param  array  $data
	 * @return \Illuminate\Contracts\Validation\Validator
	 */
	protected function validator(array $data, $USER_ID = 0)
	{
		$arrVal = [
			'name' => 'required|max:255',
			'username' => 'required|max:15|unique:USERS,username,'.$USER_ID.',USER_ID',
			'email' => 'required|email|max:255|unique:USERS,email,'.$USER_ID.',USER_ID',
			'password' => 'required|min:6',
			'ROLE_ID' => 'required',
		];

		return \Validator::make($data, $arrVal);
	}
}