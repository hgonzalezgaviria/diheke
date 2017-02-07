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

      for ($i=1; $i <= 12; $i++) {

        $this->command->info('------Sala '.($i+300));
        $sala = new \reservas\Sala;
        $sala->SALA_DESCRIPCION = 'SALA '.($i+300);
        $sala->SALA_CAPACIDAD = 20;
        $sala->SALA_FOTOSALA = 'default.jpg';
        $sala->SALA_FOTOCROQUIS = 'default.jpg';
        $sala->SALA_OBSERVACIONES = 'SALA DISPONIBLE';
        $sala->SALA_PRESTAMO = 0;
        $sala->ESTA_ID = 1;
        $sala->SEDE_ID = 1;
        $sala->SALA_CREADOPOR =  'USER_PRUEBA';
        $sala->save();
      }
      
      for ($i=1; $i <= 4; $i++) {
        $this->command->info('------Sala '.($i+100));
        $sala = new \reservas\Sala;
        $sala->SALA_DESCRIPCION = 'SALA '.($i+100);
        $sala->SALA_CAPACIDAD = 20;
        $sala->SALA_FOTOSALA = 'default.jpg';
        $sala->SALA_FOTOCROQUIS = 'default.jpg';
        $sala->SALA_OBSERVACIONES = 'SALA DISPONIBLE';
        $sala->SALA_PRESTAMO = 0;
        $sala->ESTA_ID = 1;
        $sala->SEDE_ID = 2;        
        $sala->SALA_CREADOPOR =  'USER_PRUEBA';
        $sala->save();
      }

	}
  
}
