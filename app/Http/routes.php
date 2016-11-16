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
Route::resource('usuarios', 'Auth\AuthController');

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
Route::resource('reservas', 'ReservasController');


//recursos
Route::resource('recursos', 'RecursosController');

//tipos de estados
Route::resource('tipoestados', 'TipoestadosController');

//estados
Route::resource('estados', 'EstadosController');

//Situación Recursos Físicos
Route::resource('situacionrecursofisico', 'SituacionRecursoFisicoController');

//Estados elemento recurso físico
Route::resource('estadoelementorecursofisico', 'EstadoElementoRecursoFisicoController');

//Elementos recurso físico
Route::resource('elementorecursofisico', 'ElementoRecursoFisicoController');

//Tipo de espacio físico
Route::resource('tipoespaciofisico', 'TipoEspacioFisicoController');

//Tipo de posesión
Route::resource('tipoposesion', 'TipoPosesionController');

//Localidades
Route::resource('localidad', 'LocalidadController');

//Espacio Físico
Route::resource('espaciofisico', 'EspacioFisicoController');

//Tipos Recurso Físico
Route::resource('tiporecursofisico', 'TipoRecursoFisicoController');

//Recurso Físico
Route::resource('recursofisico', 'RecursoFisicoController');

//Tipos Unidades
Route::resource('tipounidad', 'TipoUnidadController');

//Recurso Físico
Route::resource('unidad', 'UnidadController');


Route::get('cargaEventos{id?}','ReservasController@index');
Route::post('reservas/guardaEventos', array('as' => 'guardaEventos','uses' => 'ReservasController@create'));
Route::post('actualizaEventos','ReservasController@update');
Route::post('eliminaEvento','ReservasController@delete');
