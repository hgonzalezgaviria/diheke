<?php

use Illuminate\Database\Seeder;

class TableSedesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {

    	/*
            reservas\Sede->insert( array(
                'SEDE_DESCRIPCION' => 'SEDE PRINCIPAL AVN. 6TA',
                'SEDE_DIRECCION' => 'AVENIDA 6TA CON CALLE 28',
                'SEDE_OBSERVACIONES' => 'SEDE PRINCIPAL NORTE UNIAJC'
                'USER_ID' => 1,


            ));
            */
           $sede = new \reservas\Sede;
           $sede->SEDE_DESCRIPCION = 'SEDE PRINCIPAL AVN. 6TA';
           $sede->SEDE_DIRECCION =  'AVENIDA 6TA CON CALLE 28';
           $sede->SEDE_OBSERVACIONES =  'SEDE PRINCIPAL NORTE UNIAJC';
           $sede->SEDE_CREADOPOR =  'USER_PRUEBA';
           $sede->save();

	}

}
