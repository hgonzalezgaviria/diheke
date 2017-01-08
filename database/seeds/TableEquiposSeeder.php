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

           $equipo = new \reservas\Equipo;
           $equipo->EQUI_DESCRIPCION = 'HP PROBOOK 1400 LA';
           $equipo->EQUI_OBSERVACIONES = 'EQUIPO DE ALMA GAMA';
           $equipo->SALA_ID = 1;
           $equipo->ESTA_ID = 2;
           $equipo->EQUI_CREADOPOR =  'USER_PRUEBA';
           $equipo->save();

	}
}
