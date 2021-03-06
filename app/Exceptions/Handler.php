<?php

namespace reservas\Exceptions;

use Exception;
use Illuminate\Validation\ValidationException;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that should not be reported.
     *
     * @var array
     */
    protected $dontReport = [
        AuthorizationException::class,
        HttpException::class,
        ModelNotFoundException::class,
        ValidationException::class,
    ];

    /**
     * Report or log an exception.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param  \Exception  $e
     * @return void
     */
    public function report(Exception $e)
    {
        parent::report($e);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $e
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $e)
    {
        //Si está en modo depuración:
        if (!env('APP_DEBUG', false)){
            //Si la ruta no existe, mostar view 404.
            if($e instanceof \ReflectionException OR
                $e instanceof \Symfony\Component\HttpKernel\Exception\NotFoundHttpException){
                return response(view('errors.404'), 404);
            } /*else {
                //Sino, mostrar view 500. Actualmente no pasa la variable $errorMsg.
                $errorMsg = $e->getMessage();
                return response(view('errors.500', compact($errorMsg)), 500);
            }*/
        }

        return parent::render($request, $e);
    }
}
