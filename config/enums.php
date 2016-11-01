<?php
return [

//Config::get('enums.estados_encuesta')
    'preg_tipos' => [
    	'Abierta',
    	'Escala',
    	'Eleccion unica',
    	'SI/NO',
    ],

	'preg_tipos2' => [
		['id' => '1', 'value' => 'Abierta'],
		['id' => '2', 'value' => 'Escala'],
		['id' => '3', 'value' => 'Eleccion unica'],
		['id' => '4', 'value' => 'SI/NO'],
	],

	'roles' => [
		'admin', 
		'editor',
		'docente',
		'estudiante',
	],

	'estados_encuesta' => [
		['nueva'         => '1'],
		['pend_aprobar'  => '2'],
		['aprobada'      => '3'], 
		['rechazada'     => '4'],
		['eliminada'     => '5'],
	]

];