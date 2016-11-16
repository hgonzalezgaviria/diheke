<?php
	
use Illuminate\Database\Seeder;

	class UsersTableSeeder extends Seeder {

		public function run() {
            //Admin
            \DB::table('users')->insert( array(
                'name' => 'Admin',
                'username' => 'admin',
                'email' => 'admin@correo.com',
                'password'  => \Hash::make('123'),
                'role' => 'admin',
                'USER_creadopor' => 'SYSTEM',
                'USER_fechacreado' => \Carbon\Carbon::now()->toDateTimeString(),
            ));

            //Editores
            \DB::table('users')->insert( array(
                'name' => 'Editor 1 de prueba',
                'username' => 'editor1',
                'email' => 'editor1@correo.com',
                'password'  => \Hash::make('123'),
                'role' => 'editor',
                'USER_creadopor' => 'SYSTEM',
                'USER_fechacreado' => \Carbon\Carbon::now()->toDateTimeString(),
            ));
            \DB::table('users')->insert( array(
                'name' => 'Editor 2 de prueba',
                'username' => 'editor2',
                'email' => 'editor2@correo.com',
                'password'  => \Hash::make('123'),
                'role' => 'editor',
                'USER_creadopor' => 'SYSTEM',
                'USER_fechacreado' => \Carbon\Carbon::now()->toDateTimeString(),
            ));

            //Estudiantes
            \DB::table('users')->insert( array(
                'name' => 'Estudiante 1 de prueba',
                'username' => 'estudiante1',
                'email' => 'estudiante1@correo.com',
                'password'  => \Hash::make('123'),
                'role' => 'estudiante',
                'USER_creadopor' => 'SYSTEM',
                'USER_fechacreado' => \Carbon\Carbon::now()->toDateTimeString(),
            ));
            \DB::table('users')->insert( array(
                'name' => 'Estudiante 2 de prueba',
                'username' => 'estudiante2',
                'email' => 'estudiante2@correo.com',
                'password'  => \Hash::make('123'),
                'role' => 'estudiante',
                'USER_creadopor' => 'SYSTEM',
                'USER_fechacreado' => \Carbon\Carbon::now()->toDateTimeString(),
            ));

            //Docentes
            \DB::table('users')->insert( array(
                'name' => 'Docente 1 de prueba',
                'username' => 'docente1',
                'email' => 'docente1@correo.com',
                'password'  => \Hash::make('123'),
                'role' => 'docente',
                'USER_creadopor' => 'SYSTEM',
                'USER_fechacreado' => \Carbon\Carbon::now()->toDateTimeString(),
            ));
            \DB::table('users')->insert( array(
                'name' => 'Docente 2 de prueba',
                'username' => 'docente2',
                'email' => 'docente2@correo.com',
                'password'  => \Hash::make('123'),
                'role' => 'docente',
                'USER_creadopor' => 'SYSTEM',
                'USER_fechacreado' => \Carbon\Carbon::now()->toDateTimeString(),
            ));

            \DB::table('users')->insert( array(
                'name' => 'Pepe Perez',
                'username' => 'pepe',
                'email' => 'pepe@correo.com',
                'password'  => \Hash::make('123'),
                'role' => 'docente',
                'USER_creadopor' => 'SYSTEM',
                'USER_fechacreado' => \Carbon\Carbon::now()->toDateTimeString(),
            ));
            \DB::table('users')->insert( array(
                'name' => 'Mazorca Gonzalez',
                'username' => 'mazorca',
                'email' => 'mazorca@correo.com',
                'password'  => \Hash::make('123'),
                'role' => 'estudiante',
                'USER_creadopor' => 'SYSTEM',
                'USER_fechacreado' => \Carbon\Carbon::now()->toDateTimeString(),
            ));

		}


	}