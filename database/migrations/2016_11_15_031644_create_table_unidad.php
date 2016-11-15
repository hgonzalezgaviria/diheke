<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableUnidad extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('UNIDAD', function (Blueprint $table) {

			$table->increments('UNID_ID') 
				->comment = "Valor autonumerico, llave primaria de la tabla UNIDAD.";

			$table->string('UNID_NOMBRE', 100)
				->comment = "Nombre de la Unidad, son las diferentes dependencias con las que cuenta la Universidad, como: Facultad de Ingenieria de Sistemas , Facultad de Arquitectura, Sedes (Unidad Operativa Cucuta, Unidad Oca";

			$table->string('UNID_CODIGO', 40)
				->comment = "Codigo de la unidad, asignado por la universidad a dicha dependencia";

			$table->string('UNID_TELEFONO', 30)
				->comment = "Telefono de la Unidad";

			$table->string('UNID_EXTTELEFONO', 5)
				->comment = "Extension de la Unidad";

			$table->string('UNID_EMAIL', 100)
				->comment = "Correo Electronico de la Unidad";

			$table->string('UNID_UBICACION', 50)
				->comment = "Ubicacion dentro de la Universidad";

			$table->string('UNID_NIVEL', 10)
				->comment = "	Nivel de jerarquia u Organizacional de la Unidad dentro de la universidad";

			$table->boolean('UNID_ASOCIAPROGRAMADIRECTA')
				->comment = "Campo de tipo Check que indica ( si la unidad tiene asociado otros programas = 1, si la unidad no tiene asociado otros programas = 0)";
			
			$table->boolean('UNID_ASOCIAMATERIADIRECTA')
				->comment = "Campo de tipo Check que indica ( si la unidad tiene asociado materias = 1, si la unidad no tiene asociado materias = 0) como por ejemplo Bienestar Universitario , tiene materias como Oratoria,Pint";
			
			$table->boolean('UNID_REGIONAL')
				->comment = "Campo de tipo Check que indica (1=Si, 0=No), 1 si la Unidad es una Regional";
			
			
			//Campos foráneos
			$table->unSignedInteger('TIUN_ID')
				->comment = "Campo foráneo de la tabla TIPOUNIDAD.";
				/*
			$table->unSignedInteger('CIGE_ID')
				->comment = "Campo foráneo de la tabla GENERAL.CIUDADGENERAL.";
				*/

			//Traza
			$table->string('UNID_CREADOPOR')
				->comment('Usuario que creó el registro en la tabla');
			$table->timestamp('UNID_FECHACREADO')
				->comment('Fecha en que se creó el registro en la tabla.');
			$table->string('UNID_MODIFICADOPOR')->nullable()
				->comment('Usuario que realizó la última modificación del registro en la tabla.');
			$table->timestamp('UNID_FECHAMODIFICADO')->nullable()
				->comment('Fecha de la última modificación del registro en la tabla.');
			$table->string('UNID_ELIMINADOPOR')->nullable()
				->comment('Usuario que eliminó el registro en la tabla.');
			$table->timestamp('UNID_FECHAELIMINADO')->nullable()
				->comment('Fecha en que se eliminó el registro en la tabla.');


			//Relaciones
			$table->foreign('TIUN_ID')
				->references('TIUN_ID')->on('TIPOUNIDAD')
				->onUpdate('cascade')
				->onDelete('restrict');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('UNIDAD');
	}
}
