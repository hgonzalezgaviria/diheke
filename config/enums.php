<?php
return [

//Config::get('enums.estados_encuesta')
/*
    'preg_tipos' => [
    	'Abierta',
    	'SI/NO',
    	'Escala',
		'Elección única',
		'Elección múltiple',
    ],
	
	'estados_encuesta' => [
		'Abierta',
		'Publicada',
		'Cerrada',
		'Finalizada',
		'Eliminada',
	]
*/

	'roles' => [
		['rol' => 'admin', 'descripcion' => 'Admin'],
		['rol' => 'editor', 'descripcion' => 'Editor'],
		['rol' => 'docente', 'descripcion' => 'Docente'],
		['rol' => 'estudiante', 'descripcion' => 'Estudiante'],
		['rol' => 'user', 'descripcion' => 'Usuario'],
	],

];