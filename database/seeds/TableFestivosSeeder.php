<?php

use Illuminate\Database\Seeder;

class TableFestivosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    Public function run() {

           $festivo = new \reservas\Festivo;
           $festivo->FEST_FECHA = '2017-02-15';
           $festivo->FEST_DESCRIPCION = 'DIA FESTIVO DE PRUEBA';
           $festivo->FEST_CREADOPOR =  'USER_PRUEBA';
           $festivo->save();

	}
}
