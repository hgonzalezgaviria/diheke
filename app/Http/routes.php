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
Route::get('layoutPDF', 'ExportarPdfController@layoutPDF');
Route::get('streamPDF', 'ExportarPdfController@streamPDF');
Route::get('savePDF', 'ExportarPdfController@savePDF');
//Route::get('encuestas/{ENCU_id}/downloadZIP', 'ExportarPdfController@downloadZIP');


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

//upload tablas Academusoft
Route::get('upload', 'UploadFacultadController@index');
Route::delete('eliminarRegistros', 'UploadFacultadController@eliminarRegistros');
Route::post('upload', 'UploadFacultadController@upload');


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

//Consulta y crear prestamo
Route::resource('consultaPrestamos', 'PrestamoEquiposController');
Route::post('prestamoEquipo', 'PrestamoEquiposController@crearPrestamo');


//reservas
Route::resource('reservas', 'ReservasController');
Route::get('cargaEventos{sala?}','ReservasController@index');
Route::post('reservas/guardaEventos', array('as' => 'guardaEventos','uses' => 'ReservasController@store'));
Route::post('reservas/guardarReservas', array('as' => 'guardarReservas','uses' => 'ReservasController@guardarReservas'));
Route::post('reservas/getFestivos', array('as' => 'getFestivos','uses' => 'FestivosController@getFestivos'));
Route::post('actualizaEventos','ReservasController@update');
Route::post('eliminaEvento','ReservasController@delete');
Route::post('consultaSalas', array('as' => 'consultaSalas','uses' => 'EquiposController@consultaSalas'));
Route::post('consultarEquipos', array('as'=>'consultarEquipos','uses' => 'ConsultaEquiposController@consultarEquipos'));

Route::get('autorizarReservas', 'AutorizacionesController@index');
Route::post('autorizarReservas/{AUTO_ID}/aprobar', 'AutorizacionesController@aprobar');
Route::post('autorizarReservas/{AUTO_ID}/rechazar', 'AutorizacionesController@rechazar');

Route::post('consultaMaterias', array('as' => 'consultaMaterias','uses' => 'ReservasController@consultaMaterias'));

Route::post('consultaFacultades', array('as' => 'consultaFacultades','uses' => 'ReservasController@consultaFacultades'));

Route::post('consultaGrupos', array('as' => 'consultaGrupos','uses' => 'ReservasController@consultaGrupos'));

Route::post('consultaDocentes', array('as' => 'consultaDocentes','uses' => 'ReservasController@consultaDocentes'));
Route::post('consultaDocentesd', array('as' => 'consultaDocentesd','uses' => 'ReservasController@consultaDocentesd'));


//recursos
Route::resource('recursos', 'RecursosController');

Route::post('consultaSalasR', array('as' => 'consultaSalasR','uses' => 'RecursosController@consultaSalasR'));


//Salas para equipos
Route::get('salas/{SALA_ID}/reservarSalaEquipos', 'SalasController@reservarSalaEquipos')->name('reservasSalaEquipos');

//Finalizar prestamos para equipos
Route::get('prestamos/{PRES_ID}/finalizarPrestamo', 'PrestamoEquiposController@finalizarPrestamo')->name('finalizarPrestamo');