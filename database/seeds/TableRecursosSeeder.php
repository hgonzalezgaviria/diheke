<?php

use Illuminate\Database\Seeder;

class TableRecursosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $this->command->info('--- Creación de Recursos de prueba');

       $recurso = new \reservas\Recurso;
       $recurso->RECU_DESCRIPCION = 'Oracle 11G';
       $recurso->RECU_VERSION =  '11g 11.0.1';
       $recurso->RECU_OBSERVACIONES =  'Base Datos Oracle 11g 11.0.1';
       $recurso->RECU_CREADOPOR =  'USER_PRUEBA';
       $recurso->save();

       $recurso = new \reservas\Recurso;
        $recurso->RECU_DESCRIPCION = 'Laravel';
       $recurso->RECU_VERSION =  '5.3';
       $recurso->RECU_OBSERVACIONES =  'Framework Laravel 5.*';
       $recurso->RECU_CREADOPOR =  'USER_PRUEBA';
       $recurso->save();

       $this->command->info('--- FIN de Creación de Recursos de prueba');

    }
}