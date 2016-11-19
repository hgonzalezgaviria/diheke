<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('ROLES', function (Blueprint $table) {
			$table->increments('ROLE_id')
				->comment('Valor autonumérico, llave primaria de la tabla ROLES.');
			$table->string('ROLE_rol', 15)->unique()
				->comment('Define el tipo de rol. Debe ser único. Los roles creados por SYSTEM no se deben modificar.');
			$table->string('ROLE_descripcion')
				->comment('Texto con el cual será visualizado el rol. Puede ser modificado y no afectará la lógica del proceso.');
			
			//Traza
			$table->string('ROLE_creadopor')
				->comment('Usuario que creó el registro en la tabla');
			$table->timestamp('ROLE_fechacreado')
				->comment('Fecha en que se creó el registro en la tabla.');
			$table->string('ROLE_modificadopor')->nullable()
				->comment('Usuario que realizó la última modificación del registro en la tabla.');
			$table->timestamp('ROLE_fechamodificado')->nullable()
				->comment('Fecha de la última modificación del registro en la tabla.');
			$table->string('ROLE_eliminadopor')->nullable()
				->comment('Usuario que eliminó el registro en la tabla.');
			$table->timestamp('ROLE_fechaeliminado')->nullable()
				->comment('Fecha en que se eliminó el registro en la tabla.');
		});

		if(env('DB_CONNECTION') == 'pgsql')
			DB::statement("COMMENT ON TABLE eva360.\"ROLES\" IS 'Tabla de roles que peude tener un usuario.'");

		Schema::create('USERS', function (Blueprint $table) {
			$table->increments('USER_id')
				->comment('Valor autonumérico, llave primaria de la tabla USERS.');
			$table->string('name')
				->comment('Nombre completo del usuario.');
			$table->string('username')->unique()
				->comment('Cuenta del usuario, con la cual realizará la autenticación. Valor único en la tabla');
			$table->string('email')
				->comment('Correo electrónico del usuario.');
			$table->string('password')
				->comment('Contraseña del usuario cifrada.');
			$table->unSignedInteger('ROLE_id')
				->comment('Campo foráneo de la tabla ROLES.');
			$table->rememberToken();

			//Traza
			$table->string('USER_creadopor')
				->comment('Usuario que creó el registro en la tabla');
			$table->timestamp('USER_fechacreado')
				->comment('Fecha en que se creó el registro en la tabla.');
			$table->string('USER_modificadopor')->nullable()
				->comment('Usuario que realizó la última modificación del registro en la tabla.');
			$table->timestamp('USER_fechamodificado')->nullable()
				->comment('Fecha de la última modificación del registro en la tabla.');
			$table->string('USER_eliminadopor')->nullable()
				->comment('Usuario que eliminó el registro en la tabla.');
			$table->timestamp('USER_fechaeliminado')->nullable()
				->comment('Fecha en que se eliminó el registro en la tabla.');

			//Relaciones
			$table->foreign('ROLE_id')
			->references('ROLE_id')
			->on('ROLES');
		});

		if(env('DB_CONNECTION') == 'pgsql')
			DB::statement("COMMENT ON TABLE eva360.\"USERS\" IS 'Tabla de usuarios para ingresar al aplicativo.'");
		//elseif(env('DB_CONNECTION') == 'mysql')

	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('USERS');
		Schema::drop('ROLES');
	}
}
