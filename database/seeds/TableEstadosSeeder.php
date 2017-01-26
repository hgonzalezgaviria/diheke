<?php

use Illuminate\Database\Seeder;

class TableEstadosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
   Public function run() {
          //SALAS
           $estado = new \reservas\Estado;
           $estado->ESTA_DESCRIPCION = 'DISPONIBLE';
           $estado->TIES_ID = 1;
           $estado->ESTA_CREADOPOR =  'SYSTEM';
           $estado->save();

           $estado = new \reservas\Estado;
           $estado->ESTA_DESCRIPCION = 'OCUPADA';
           $estado->TIES_ID = 1;
           $estado->ESTA_CREADOPOR =  'SYSTEM';
           $estado->save();


           //EQUIPOS
           $estado = new \reservas\Estado;
           $estado->ESTA_DESCRIPCION = ' DISPONIBLE';
           $estado->TIES_ID = 2;
           $estado->ESTA_CREADOPOR =  'SYSTEM';
           $estado->save();

          $estado = new \reservas\Estado;
           $estado->ESTA_DESCRIPCION = ' OCUPADO';
           $estado->TIES_ID = 2;
           $estado->ESTA_CREADOPOR =  'SYSTEM';
           $estado->save();

	 }

}
