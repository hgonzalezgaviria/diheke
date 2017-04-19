<?php

use Illuminate\Database\Seeder;

class TableReservasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    Public function run() {

           $reserva = new \reservas\Reserva;
           $reserva->RESE_FECHAINI = '2017-01-15 10:00:00';
           $reserva->RESE_FECHAFIN = '2017-01-15 12:00:00';
           $reserva->RESE_TODOELDIA = 0;
           //$reserva->RESE_COLOR = 'rgb(192,192,192)';
           $reserva->RESE_TITULO = 'TALLER DE BASES DE DATOS';
           $reserva->SALA_ID = 1;
           $reserva->EQUI_ID = NULL;
           $reserva->RESE_CREADOPOR =  'USER_PRUEBA';
           $reserva->save();

	}

}
