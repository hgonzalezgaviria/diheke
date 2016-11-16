<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableTipounidad extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('TIPOUNIDAD', function (Blueprint $table) {

			$table->increments('TIUN_ID') 
				->comment = "Valor autonumerico, llave primaria de la tabla TIPOUNIDAD.";

			$table->string('TIUN_DESCRIPCION', 100)
				->comment = "Descripción del tipo de una unidad";

			//Traza
			$table->string('TIUN_CREADOPOR')
				->comment('Usuario que creó el registro en la tabla');
			$table->timestamp('TIUN_FECHACREADO')
				->comment('Fecha en que se creó el registro en la tabla.');
			$table->string('TIUN_MODIFICADOPOR')->nullable()
				->comment('Usuario que realizó la última modificación del registro en la tabla.');
			$table->timestamp('TIUN_FECHAMODIFICADO')->nullable()
				->comment('Fecha de la última modificación del registro en la tabla.');
			$table->string('TIUN_ELIMINADOPOR')->nullable()
				->comment('Usuario que eliminó el registro en la tabla.');
			$table->timestamp('TIUN_FECHAELIMINADO')->nullable()
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
		Schema::drop('TIPOUNIDAD');
	}
}
