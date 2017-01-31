<?php

namespace reservas\Http\Controllers\Auth;

use reservas\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;

class PasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    protected $subject = "Cambio de contraseña";

    /**
     * Create a new password controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        /* Se inactiva middleware ya que los cambios de contraseña puede realizarlos el rol admin.
        $this->middleware('guest',
            ['except' => ['showResetForm']]
        );
        */
    }

    public function sendEmail($USER_ID){
                dump($USER_ID);
        $user = \reservas\User::findOrFail($USER_ID);


        $this->sendResetLinkEmail($user);

    }


    /**
     * Display the password reset view for the given token.
     *
     * @param  string $token
     *
     * @return Response
     */
    public function showResetForm( $token = null )
    {
        //Si no está autenticado y no llegó un token, redirige a recuperar por email.
        if (auth()->guest() && is_null( $token )) {
            //return redirect('password/reset');
            return view( 'auth.passwords.email' );
        }


        $email = Input::get('email');
        //Si está autenticado y no llegó un token...
        if ( auth()->check() && is_null($token) ){
            //Si el rol es admin y el id recibido por GET no es null...
            if( auth()->user()->rol->ROLE_rol == 'admin' && Input::get('USER_ID') !== null)
                $user = \reservas\User::findOrFail(Input::get('USER_ID'));
            else
                $user = auth()->user();

            $email = $user->email;
            $token = \Password::getRepository()->create( $user );
        }

        return view( 'auth.passwords.reset' )
                ->with( 'email', $email )
                ->with( 'token', $token );

    }


    /**
     * Reset the given user's password.
     *
     * @param  \Illuminate\Contracts\Auth\CanResetPassword  $user
     * @param  string  $password
     * @return void
     */
    protected function resetPassword($user, $password)
    {
        $user->forceFill([
            'password' => bcrypt($password),
            'remember_token' => Str::random(60),
        ])->save();

        //Auth::guard($this->getGuard())->login($user);
        Session::flash('message', '¡Contraseña modificada para '.$user->username.'!');
    }

    /**
     * Get the response for after a successful password reset.
     *
     * @param  string  $response
     * @return \Symfony\Component\HttpFoundation\Response
     */
    protected function getResetSuccessResponse($response)
    {
        if( auth()->check() && auth()->user()->rol->ROLE_ROL == 'admin' )
            return redirect('usuarios')->with('status', trans($response));
        else
            return redirect($this->redirectPath())->with('status', trans($response));

    }
}
