<?php
	
use Illuminate\Database\Seeder;

	class UsersTableSeeder extends Seeder {

		public function run() {
            \DB::table('users')->insert( array(
                'name' => 'Admin',
                'username' => 'admin',
                'email' => 'admin@correo.com',
                'password'  => \Hash::make('123'),
                'role' => 'admin',
            ));

			\DB::table('users')->insert( array(
				'name' => 'Diego',
				'username' => 'shin',
				'email' => 'shin@correo.com',
				'password'  => \Hash::make('123'),
				'role' => 'editor',
			));

            \DB::table('users')->insert( array(
                'name' => 'Pepe Perez',
                'username' => 'pepe',
                'email' => 'pepe@correo.com',
                'password'  => \Hash::make('123'),
                'role' => 'docente',
            ));
            \DB::table('users')->insert( array(
                'name' => 'Mazorca Gonzalez',
                'username' => 'mazorca',
                'email' => 'mazorca@correo.com',
                'password'  => \Hash::make('123'),
                'role' => 'estudiante',
            ));


            $users = factory(reservas\User::class)->times(10)->create();
		}


	}