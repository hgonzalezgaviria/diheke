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
        $this->call(UsersTableSeeder::class);
        //$this->call(EncuestasTableSeeder::class);
        
        //foreach(Config::get('enums.preg_tipos') as $tipo){
         //   \DB::table('preg_tipos')->insert( array('descripcion' => $tipo) );
        //}

    }
}
