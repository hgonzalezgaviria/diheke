<?php

namespace reservas\Http\Controllers\Auth;

use reservas\User;
use Validator;
use reservas\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Route;

class AuthController extends Controller
{
	/*
	|--------------------------------------------------------------------------
	| Registration & Login Controller
	|--------------------------------------------------------------------------
	|
	| This controller handles the registration of new users, as well as the
	| authentication of existing users. By default, this controller uses
	| a simple trait to add these behaviors. Why don't you explore it?
	|
	*/

	use AuthenticatesAndRegistersUsers, ThrottlesLogins;

	/**
	 * Where to redirect users after login / registration.
	 *
	 * @var string
	 */
	protected $redirectTo = 'usuarios';

	/**
	 * Create a new authentication controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{

		//Lista de acciones que no requieren autenticación
		$arrActionsLogin = [
			'logout',
			'login',
			'getLogout',
		];

		//Lista de acciones que solo puede realizar los administradores
		$arrActionsAdmin = [
			'index',
			'edit',
			'show',
			'update',
			'destroy',
			'register',
			'showRegistrationForm',
			'getRegister',
			'postRegister',
		];


		//Requiere que el usuario inicie sesión, excepto en la vista logout.
		$this->middleware($this->guestMiddleware(),
			['except' => array_collapse([$arrActionsLogin, $arrActionsAdmin])]
		);

		if(Route::currentRouteAction() !== null){//Compatibilidad con el comando "php artisan route:list", ya que ingresa como guest y la ruta es nula.		
			$action = Route::currentRouteAction();
			$role = isset(auth()->user()->role) ? auth()->user()->role : 'user';

			
			if(in_array(explode("@", $action)[1], $arrActionsAdmin))//Si la acción del controlador se encuentra en la lista de acciones de admin...
			{
				if( ! in_array($role , ['admin']))//Si el rol no es admin, se niega el acceso.
				{
					Session::flash('error', '¡Usuario no tiene permisos!');
					abort(403, '¡Usuario no tiene permisos!.');
				}
			}
		}
	}

	/**
	 * Get a validator for an incoming registration request.
	 *
	 * @param  array  $data
	 * @return \Illuminate\Contracts\Validation\Validator
	 */
	protected function validator(array $data)
	{
		return Validator::make($data, [
			'name' => 'required|max:255',
			'username' => 'required|max:15|unique:users',
			'email' => 'required|email|max:255',
			'password' => 'required|min:6|confirmed',
			'role' => 'required',
		]);
	}

	/**
	 * Create a new user instance after a valid registration.
	 *
	 * @param  array  $data
	 * @return User
	 */
	protected function create(array $data)
	{
		return User::create([
			'name' => $data['name'],
			'username' => $data['username'],
			'email' => $data['email'],
			'password' => bcrypt($data['password']),
			'role' => $data['role'],
			'USER_creadopor' => auth()->user()->username,
		]);
	}

	/**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $validator = $this->validator($request->all());

        if ($validator->fails()) {
            $this->throwValidationException(
                $request, $validator
            );
        }

        //Auth::guard($this->getGuard())->login($this->create($request->all()));
        $user = $this->create($request->all());

		Session::flash('message', 'Usuario '.$user->username.' creado exitosamente!');
        return redirect($this->redirectPath());
    }


    /**
     * Get the login username to be used by the controller.
     *
     * @return string
     */
    public function loginUsername()
    {
    	//Se modifica para que la autenticación se realice por username y no por email
        return property_exists($this, 'username') ? $this->username : 'username';
    }


	/**
	 * Muestra una lista de los registros.
	 *
	 * @return Response
	 */
	public function index()
	{
		//Se obtienen todos los registros.
		$usuarios = User::orderBy('id')->get();

		//Se carga la vista y se pasan los registros
		return view('auth/index', compact('usuarios'));
	}

	/**
	 * Muestra información de un registro.
	 *
	 * @param  int  $ESFI_ID
	 * @return Response
	 */
	public function show($USER_id)
	{
		// Se obtiene el registro
		$usuario = User::findOrFail($USER_id);

		// Muestra la vista y pasa el registro
		return view('auth/show', compact('usuario'));
	}

	/**
	 * Muestra el formulario para editar un registro en particular.
	 *
	 * @param  int  $ENCU_id
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($USER_id)
	{
		// Se obtiene el registro
		$usuario = User::findOrFail($USER_id);

		//Se crea un arreglo con los roles.
		$arrRoles = [];

		// Muestra el formulario de edición y pasa el registro a editar
		return view('auth/edit', compact('usuario', 'arrRoles'));
	}

    /**
     * Actualiza un registro en la base de datos.
     *
     * @param  int  $TIEF_ID
     * @return Response
     */
    public function update($USER_id)
    {
        //Validación de datos
        $this->validate(request(), [
			'name' => 'required|max:255',
			'email' => 'required|email|max:255',
			'role' => 'required',
        ]);

        // Se obtiene el registro
        $usuario = User::findOrFail($USER_id);

        $usuario->name = Input::get('name');
        $usuario->email = Input::get('email');
        $usuario->role = Input::get('role');
        $usuario->USER_modificadopor = auth()->user()->username;
        //Se guarda modelo
        $usuario->save();

        // redirecciona al index de controlador
        Session::flash('message', 'Usuario '.$usuario->username.' modificado exitosamente!');
        return redirect($this->redirectPath());
    }

    /**
	 * Elimina un registro de la base de datos.
	 *
	 * @param  int  $USER_id
	 * @return Response
	 */
	public function destroy($USER_id)
	{
		$usuario = User::findOrFail($USER_id);
		$usuario->USER_eliminadopor = auth()->user()->username;
		$usuario->save();
		$usuario->delete();
		
		Session::flash('warning', '¡Usuario '.$usuario->username.' borrado!');
        return redirect($this->redirectPath());
	}
}
