<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

//Autenticación
Route::auth();

//Inicio
Route::get('/home', 'HomeController@index');
Route::get('/', 'HomeController@index');

//Ayuda
Route::get('/help', function(){
	return View::make('help');
});
//Prueba
Route::get('/prueba', function(){
	return View::make('prueba');
});


//contratos
Route::resource('contratos', 'ContratosController');

//contratos
Route::resource('tiporecursofisico', 'TiporecursofisicoController');

//recursos
Route::resource('recursos', 'RecursosController');

//tipos de estados
Route::resource('tipoestados', 'TipoestadosController');

//estados
Route::resource('estados', 'EstadosController');

//estados
Route::resource('situacionrecursofisico', 'SituacionRecursoFisicoController');



/*
//Pregunta
Route::resource('encuestas/{id_encuesta}/pregs', 'PreguntaController');

//Respuesta
Route::resource('encuestas/{id_encuesta}/resps', 'RespuestaController',
    ['parameters' => ['id_encuesta' => 'id_encuesta']]);

//Menu
Route::get('menu', 'MenuController@index');

//https://laravel.com/docs/5.3/routing#route-group-prefixes

Route::group(['prefix' => 'admin'], function () {
    Route::get('users', function ()    {
        // Matches The "/admin/users" URL
    });
});
*/
