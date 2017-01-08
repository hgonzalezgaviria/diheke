<?php

use Illuminate\Database\Seeder;

class TableSalasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    Public function run() {

           $sala = new \reservas\Sala;
           $sala->SALA_DESCRIPCION = 'SALA DISPONIBLE';
           $sala->SALA_CAPACIDAD = 20;
           $sala->SALA_FOTOSALA = 'PATH DE LA FOTO';
           $sala->SALA_FOTOCROQUIS = 'PATH DE FOTOCROQUIS';
           $sala->SALA_OBSERVACIONES = 'SALA DISPONIBLE';
           $sala->ESTA_ID = 1;
           $sala->SEDE_ID = 1;
           $sala->SALA_CREADOPOR =  'USER_PRUEBA';
           $sala->save();

	}
  
}
