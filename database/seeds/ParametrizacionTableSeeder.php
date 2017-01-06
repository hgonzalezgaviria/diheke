<?php

use Illuminate\Database\Seeder;

class ParametrizacionTableSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		$this->command->info('---Parametros iniciales');
		
		foreach(Config::get('enums.roles') as $rol){
			$newRol = new reservas\Rol;
			$newRol->ROLE_ROL         = $rol['rol'];
			$newRol->ROLE_DESCRIPCION = $rol['descripcion'];
			$newRol->ROLE_CREADOPOR   = 'SYSTEM';
			$newRol->save();
		}

		/*
		foreach(Config::get('enums.preg_tipos') as $tipo){
			$tipoPreg = new reservas\TipoPregunta;
			$tipoPreg->TIPR_descripcion = $tipo;
			$tipoPreg->TIPR_creadopor   = 'SYSTEM';
			$tipoPreg->save();
		}

		foreach(Config::get('enums.estados_encuesta') as $estado){
			$estEncuesta = new reservas\EstadoEncuesta;
			$estEncuesta->ESEN_descripcion = $estado;
			$estEncuesta->ESEN_creadopor   = 'SYSTEM';
			$estEncuesta->save();
		}
		*/

		$this->command->info('---FIN ParametrizacionTableSeeder');
	}
}
