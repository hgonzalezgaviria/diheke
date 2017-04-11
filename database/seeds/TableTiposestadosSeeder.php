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
           $tipoestado->TIES_CREADOPOR =  'SYSTEM';
           $tipoestado->save();


           $tipoestado = new \reservas\Tipoestado;
           $tipoestado->TIES_DESCRIPCION = 'ESTADOS DE EQUIPOS';
           $tipoestado->TIES_OBSERVACIONES =  'ESTADOS PARA LOS EQUIPOS DE COMPUTO';
           $tipoestado->TIES_CREADOPOR =  'SYSTEM';
           $tipoestado->save();

           $tipoestado = new \reservas\Tipoestado;
           $tipoestado->TIES_DESCRIPCION = 'ESTADOS DE APROBACIONES';
           $tipoestado->TIES_OBSERVACIONES =  'ESTADOS PARA LAS APROBACIONES DE RESERVAS DE SALAS';
           $tipoestado->TIES_CREADOPOR =  'SYSTEM';
           $tipoestado->save();



	  }
  
}
