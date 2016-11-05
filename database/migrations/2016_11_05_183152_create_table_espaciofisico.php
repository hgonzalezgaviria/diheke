<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableEspaciofisico extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
 
    public function up()
    {       
        Schema::create('ESPACIOFISICO', function (Blueprint $table) {

            $table->increments('ESFI_ID') 
                ->comment = "Valor autonumerico, llave primaria de la tabla TIPOESPACIOFISICO.";

            $table->string('ESFI_DESCRIPCION', 300)
                ->comment = "Descripcion del tipo de posesion, el cual puede ser: Propia, Alquiler, Convenio para que los estudiantes realicen practicas, como por ejemplo en un Hospital o en las Instalaciones del SENA";

            $table->integer('ESFI_NRONIVELES')
                ->comment = "Campo foráneo de la tabla TIPOPOSESION.";

            $table->string('ESFI_NOMBRE', 300)
                ->comment = "campo de auditoria. este campo guarda el nombre del usuario que realizo el registro.";

            $table->integer('TIEF_ID')->unsigned()
                ->comment = "Campo foráneo de la tabla TIPOPOSESION.";

            $table->integer('LOCA_ID')->unsigned()
                ->comment = "Campo foráneo de la tabla TIPOPOSESION.";

            $table->string('ESFI_REGISTRADOPOR', 300)
                ->comment = "campo de auditoria. este campo guarda el nombre del usuario que realizo el registro.";

            $table->date('ESFI_FECHACAMBIO')
                ->comment = "campo de auditoria. este campo es la fecha en que se cambio el registro de la tabla.";

            $table->string('ESFI_NOMENCLATURA', 300)
                ->comment = "campo de auditoria. este campo guarda el nombre del usuario que realizo el registro.";

            $table->string('ESFI_AREA', 300)
                ->comment = "Descripcion del tipo de posesion, el cual puede ser: Propia, Alquiler, Convenio para que los estudiantes realicen practicas, como por ejemplo en un Hospital o en las Instalaciones del SENA";

            $table->integer('TIPO_ID')->unsigned()
                ->comment = "Campo foráneo de la tabla TIPOPOSESION.";

            $table->timestamps();

            $table->foreign('TIEF_ID')
                  ->references('TIEF_ID')->on('TIPOESPACIOFISICO')
                  ->onDelete('cascade');

            $table->foreign('LOCA_ID')
                  ->references('LOCA_ID')->on('LOCALIDAD')
                  ->onDelete('cascade');

            $table->foreign('TIPO_ID')
                  ->references('TIPO_ID')->on('TIPOPOSESION')
                  ->onDelete('cascade');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::drop('ESPACIOFISICO');
    }
}
