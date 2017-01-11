<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRolesTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{

		$nomTabla = 'ROLES';
		$commentTabla = 'Tabla de roles que puede tener un usuario.';
		
		Schema::create($nomTabla, function (Blueprint $table) {
			$table->increments('ROLE_ID')
				->comment('Valor autonumérico, llave primaria de la tabla ROLES.');
			$table->string('ROLE_ROL', 15)->unique()
				->comment('Define el tipo de rol. Debe ser único. Los roles creados por SYSTEM no se deben modificar.');
			$table->string('ROLE_DESCRIPCION')
				->comment('Texto con el cual será visualizado el rol. Puede ser modificado y no afectará la lógica del proceso.');
			
			//Traza
			$table->string('ROLE_CREADOPOR')
				->comment('Usuario que creó el registro en la tabla');
			$table->timestamp('ROLE_FECHACREADO')
				->comment('Fecha en que se creó el registro en la tabla.');
			$table->string('ROLE_MODIFICADOPOR')->nullable()
				->comment('Usuario que realizó la última modificación del registro en la tabla.');
			$table->timestamp('ROLE_FECHAMODIFICADO')->nullable()
				->comment('Fecha de la última modificación del registro en la tabla.');
			$table->string('ROLE_ELIMINADOPOR')->nullable()
				->comment('Usuario que eliminó el registro en la tabla.');
			$table->timestamp('ROLE_FECHAELIMINADO')->nullable()
				->comment('Fecha en que se eliminó el registro en la tabla.');
		});


		if(env('DB_CONNECTION') == 'pgsql')
			DB::statement("COMMENT ON TABLE ".env('DB_SCHEMA').".\"".$nomTabla."\" IS '".$commentTabla."'");
		elseif(env('DB_CONNECTION') == 'mysql')
			DB::statement("ALTER TABLE ".$nomTabla." COMMENT = '".$commentTabla."'");

	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('ROLES');
	}
}
