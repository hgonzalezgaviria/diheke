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

           $estado = new \reservas\Estado;
           $estado->ESTA_DESCRIPCION = 'SALA DISPONIBLE';
           $estado->TIES_ID = 1;
           $estado->ESTA_CREADOPOR =  'USER_PRUEBA';
           $estado->save();

           $estado = new \reservas\Estado;
           $estado->ESTA_DESCRIPCION = 'EQUIPO DISPONIBLE';
           $estado->TIES_ID = 2;
           $estado->ESTA_CREADOPOR =  'USER_PRUEBA';
           $estado->save();

	 }

}
