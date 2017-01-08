<?php

use Illuminate\Database\Seeder;

class TableTiposestadosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {

           $tipoestado = new \reservas\Tipoestado;
           $tipoestado->TIES_DESCRIPCION = 'ESTADOS DE SALA';
           $tipoestado->TIES_OBSERVACIONES =  'ESTADOS PARA LAS SALAS DE SISTEMAS';
           $tipoestado->TIES_CREADOPOR =  'USER_PRUEBA';
           $tipoestado->save();

	  }
  
}
