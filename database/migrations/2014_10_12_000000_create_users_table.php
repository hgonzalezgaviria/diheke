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
		Schema::create('users', function (Blueprint $table) {
			$table->increments('id');
			$table->string('name');
			$table->string('username')->unique();
			$table->string('email');
			$table->string('password');
			//$table->enum('role', ['admin', 'editor', 'docente', 'estudiante']);
			$table->enum('role', Config::get('enums.roles'));
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

		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('users');
	}
}
