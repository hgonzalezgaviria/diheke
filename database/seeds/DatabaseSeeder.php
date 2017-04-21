<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(ParametrizacionTableSeeder::class);
        $this->call(TableUsersSeeder::class);
        $this->call(TableSedesSeeder::class);
        $this->call(TableTiposestadosSeeder::class);
        $this->call(TableEstadosSeeder::class);
        $this->call(TableSalasSeeder::class);
        $this->call(TableEquiposSeeder::class);
        //$this->call(TableReservasSeeder::class);
        $this->call(TableRecursosSeeder::class);
        $this->call(TableFestivosSeeder::class);
        
        
    }
}
