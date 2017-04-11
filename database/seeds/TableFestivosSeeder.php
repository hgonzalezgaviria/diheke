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

          $feriados = [
            [ 'FEST_FECHA' => '2017-01-01', 'FEST_DESCRIPCION' => 'Año Nuevo' ],
            [ 'FEST_FECHA' => '2017-03-19', 'FEST_DESCRIPCION' => 'Día de los Reyes Magos' ],
            [ 'FEST_FECHA' => '2017-03-20', 'FEST_DESCRIPCION' => 'Día de San José' ],
            [ 'FEST_FECHA' => '2017-04-13', 'FEST_DESCRIPCION' => 'Jueves Santo' ],
            [ 'FEST_FECHA' => '2017-04-14', 'FEST_DESCRIPCION' => 'Viernes Santo' ],
            [ 'FEST_FECHA' => '2017-05-01', 'FEST_DESCRIPCION' => 'Día del Trabajo' ],
            [ 'FEST_FECHA' => '2017-05-25', 'FEST_DESCRIPCION' => 'Día de la Ascensión' ],
            [ 'FEST_FECHA' => '2017-06-15', 'FEST_DESCRIPCION' => 'Corpus Christi' ],
            [ 'FEST_FECHA' => '2017-06-26', 'FEST_DESCRIPCION' => 'Sagrado Corazón' ],
            [ 'FEST_FECHA' => '2017-07-03', 'FEST_DESCRIPCION' => 'San Pedro y San Pablo' ],
            [ 'FEST_FECHA' => '2017-07-20', 'FEST_DESCRIPCION' => 'Día de la Independencia' ],
            [ 'FEST_FECHA' => '2017-08-07', 'FEST_DESCRIPCION' => 'Batalla de Boyacá' ],
            [ 'FEST_FECHA' => '2017-08-21', 'FEST_DESCRIPCION' => 'La asunción de la Virgen' ],
            [ 'FEST_FECHA' => '2017-10-16', 'FEST_DESCRIPCION' => 'Día de la Raza' ],
            [ 'FEST_FECHA' => '2017-11-06', 'FEST_DESCRIPCION' => 'Todos los Santos' ],
            [ 'FEST_FECHA' => '2017-11-13', 'FEST_DESCRIPCION' => 'Independencia de Cartagena' ],
            [ 'FEST_FECHA' => '2017-12-08', 'FEST_DESCRIPCION' => 'Día de la Inmaculada Concepción' ],
            [ 'FEST_FECHA' => '2017-12-25', 'FEST_DESCRIPCION' => 'Día de Navidad' ],
            [ 'FEST_FECHA' => '2018-01-01', 'FEST_DESCRIPCION' => 'Año Nuevo' ],
            [ 'FEST_FECHA' => '2018-01-08', 'FEST_DESCRIPCION' => 'Día de los Reyes Magos' ],
            [ 'FEST_FECHA' => '2018-03-19', 'FEST_DESCRIPCION' => 'Día de San José' ],
            [ 'FEST_FECHA' => '2018-03-25', 'FEST_DESCRIPCION' => 'Domingo de Ramos' ],
            [ 'FEST_FECHA' => '2018-03-29', 'FEST_DESCRIPCION' => 'Jueves Santo' ],
            [ 'FEST_FECHA' => '2018-03-30', 'FEST_DESCRIPCION' => 'Viernes Santo' ],
            [ 'FEST_FECHA' => '2018-04-01', 'FEST_DESCRIPCION' => 'Domingo de Resurrección' ],
            [ 'FEST_FECHA' => '2018-05-01', 'FEST_DESCRIPCION' => 'Día del Trabajo' ],
            [ 'FEST_FECHA' => '2018-05-14', 'FEST_DESCRIPCION' => 'Día de la Ascensión' ],
            [ 'FEST_FECHA' => '2018-06-04', 'FEST_DESCRIPCION' => 'Corpus Christi' ],
            [ 'FEST_FECHA' => '2018-06-11', 'FEST_DESCRIPCION' => 'Sagrado Corazón' ],
            [ 'FEST_FECHA' => '2018-07-02', 'FEST_DESCRIPCION' => 'San Pedro y San Pablo' ],
            [ 'FEST_FECHA' => '2018-07-20', 'FEST_DESCRIPCION' => 'Día de la Independencia' ],
            [ 'FEST_FECHA' => '2018-08-07', 'FEST_DESCRIPCION' => 'Batalla de Boyacá' ],
            [ 'FEST_FECHA' => '2018-08-20', 'FEST_DESCRIPCION' => 'La asunción de la Virgen' ],
            [ 'FEST_FECHA' => '2018-10-15', 'FEST_DESCRIPCION' => 'Día de la Raza' ],
            [ 'FEST_FECHA' => '2018-11-05', 'FEST_DESCRIPCION' => 'Todos los Santos' ],
            [ 'FEST_FECHA' => '2018-11-12', 'FEST_DESCRIPCION' => 'Independencia de Cartagena' ],
            [ 'FEST_FECHA' => '2018-12-08', 'FEST_DESCRIPCION' => 'Día de la Inmaculada Concepción' ],
            [ 'FEST_FECHA' => '2018-12-25', 'FEST_DESCRIPCION' => 'Día de Navidad' ],
          ];


          foreach ($feriados as $feriado) {
                    \reservas\Festivo::create(
                      $feriado + [ 'FEST_CREADOPOR' => 'SYSTEM' ]
                    );
          }

	}
}
