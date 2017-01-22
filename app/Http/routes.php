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
Route::resource('roles', 'Auth\RolController');
Route::get('password/email/{USER_ID}', 'Auth\PasswordController@sendEmail');
Route::get('password/reset/{USER_ID}', 'Auth\PasswordController@showResetForm');

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


//Sedes (EspacioFisico)
Route::resource('sedes', 'SedesController');

// Salas (recursofisico)
Route::resource('salas', 'SalasController');

// Equipos (equipos)
Route::resource('equipos', 'EquiposController');

//tipos de estados
Route::resource('tipoestados', 'TipoestadosController');

//estados
Route::resource('estados', 'EstadosController');

//politicas
Route::resource('politicas', 'PoliticasController');

//Consulta de equipos
Route::resource('consultaEquipos', 'ConsultaEquiposController');


/*






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


//Tipos Recurso Físico
Route::resource('tiporecursofisico', 'TipoRecursoFisicoController');

*/

//reservas
Route::resource('reservas', 'ReservasController');
Route::get('cargaEventos{id?}','ReservasController@index');
Route::post('reservas/guardaEventos', array('as' => 'guardaEventos','uses' => 'ReservasController@store'));
Route::post('actualizaEventos','ReservasController@update');
Route::post('eliminaEvento','ReservasController@delete');
Route::post('consultaSalas', array('as' => 'consultaSalas','uses' => 'EquiposController@consultaSalas'));

//recursos
Route::resource('recursos', 'RecursosController');