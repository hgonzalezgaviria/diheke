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

       $sede = new \reservas\Sede;
       $sede->SEDE_DESCRIPCION = 'SEDE NORTE';
       $sede->SEDE_DIRECCION =  'AVENIDA 6TA CON CALLE 28';
       $sede->SEDE_OBSERVACIONES =  'SEDE PRINCIPAL NORTE UNIAJC';
       $sede->SEDE_CREADOPOR =  'USER_PRUEBA';
       $sede->save();


       $sede = new \reservas\Sede;
       $sede->SEDE_DESCRIPCION = 'SEDE JENNY';
       $sede->SEDE_DIRECCION =  'AVENIDA 5BN';
       $sede->SEDE_OBSERVACIONES =  'SEDE IDIOMAS';
       $sede->SEDE_CREADOPOR =  'USER_PRUEBA';
       $sede->save();

       $sede = new \reservas\Sede;
       $sede->SEDE_DESCRIPCION = 'SEDE SUR';
       $sede->SEDE_DIRECCION =  'AVENIDA 5BN';
       $sede->SEDE_OBSERVACIONES =  'SEDE IDIOMAS';
       $sede->SEDE_CREADOPOR =  'USER_PRUEBA';
       $sede->save();

	}

}
