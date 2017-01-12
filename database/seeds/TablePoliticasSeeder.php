<?php

use Illuminate\Database\Seeder;

class TablePoliticasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
     Public function run() {

           $politica = new \reservas\Politica;
           $politica->POLI_HORA_MIN = '10:00:00';
           $politica->POLI_HORA_MAX = '12:00:00';
           $politica->POLI_HORAS_MIN_RESERVA = 1;
           $politica->POLI_DIAS_MIN_CANCELAR = 2;
           $politica->POLI_CREADOPOR =  'USER_PRUEBA';
           $politica->save();

	}

}
