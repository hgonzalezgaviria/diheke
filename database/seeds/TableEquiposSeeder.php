<?php

use Illuminate\Database\Seeder;

class TableEquiposSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    Public function run() {

      $this->command->info('------Equipos en sala id 1');
      for ($i=1; $i <= 20; $i++) {
        \reservas\Equipo::create([
          'EQUI_DESCRIPCION' => 'HP PROBOOK 1400 LA',
          'EQUI_OBSERVACIONES' => 'EQUIPO DE ALTA GAMA',
          'SALA_ID' => 1,
          'ESTA_ID' => 3,
          'EQUI_CREADOPOR' => 'USER_PRUEBA',
        ]);
      }

      $this->command->info('------Equipos en sala id 2');
      for ($i=1; $i <= 20; $i++) {
        \reservas\Equipo::create([
          'EQUI_DESCRIPCION' => 'LENOVO G400',
          'EQUI_OBSERVACIONES' => 'EQUIPO DE BAJA GAMA (UN TIESTO)',
          'SALA_ID' => 2,
          'ESTA_ID' => 4,
          'EQUI_CREADOPOR' => 'USER_PRUEBA',
        ]);
      }

      $this->command->info('------Equipos en sala id 3');
      for ($i=1; $i <= 20; $i++) {
        \reservas\Equipo::create([
          'EQUI_DESCRIPCION' => 'LENOVO THINKPAD T61',
          'EQUI_OBSERVACIONES' => 'EQUIPO OBSOLETO',
          'SALA_ID' => 3,
          'ESTA_ID' => 3,
          'EQUI_CREADOPOR' => 'USER_PRUEBA',
        ]);
      }

	}
}
