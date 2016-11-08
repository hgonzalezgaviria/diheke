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
                ->comment = "Numero de niveles o pisos que tiene el edificio.";

            $table->string('ESFI_NOMBRE', 300)
                ->comment = "Nombre del Espacio Fisico. Ejemplo: Edificio Rafael Nuñez.";

            $table->string('ESFI_NOMENCLATURA', 300)
                ->comment = "Nomenclatura empleada por la institucion para clasificar el Espacio Físico.";

            $table->string('ESFI_AREA', 300)
                ->comment = "Area del Espacio Fisico, esta media puede ser en Mts2 o en Hectareas";

            $table->integer('TIEF_ID')->unsigned()
                ->comment = "Campo foráneo de la tabla TIPOESPACIOFISICO.";

            $table->integer('LOCA_ID')->unsigned()
                ->comment = "Campo foráneo de la tabla LOCALIDAD.";

            $table->integer('TIPO_ID')->unsigned()
                ->comment = "Campo foráneo de la tabla TIPOPOSESION.";

                /*
            $table->string('ESFI_REGISTRADOPOR', 300)
                ->comment = "campo de auditoria. este campo guarda el nombre del usuario que realizo el registro.";

            $table->date('ESFI_FECHACAMBIO')
                ->comment = "campo de auditoria. este campo es la fecha en que se cambio el registro de la tabla.";

            $table->timestamps();
              */

            //Traza
            $table->string('ESFI_CREADOPOR')
                ->comment('Usuario que creó el registro en la tabla');
            $table->timestamp('ESFI_FECHACREADO')
                ->comment('Fecha en que se creó el registro en la tabla.');
            $table->string('ESFI_MODIFICADOPOR')->nullable()
                ->comment('Usuario que realizó la última modificación del registro en la tabla.');
            $table->timestamp('ESFI_FECHAMODIFICADO')->nullable()
                ->comment('Fecha de la última modificación del registro en la tabla.');
            $table->string('ESFI_ELIMINADOPOR')->nullable()
                ->comment('Usuario que eliminó el registro en la tabla.');
            $table->timestamp('ESFI_FECHAELIMINADO')->nullable()
                ->comment('Fecha en que se eliminó el registro en la tabla.');

            //Relaciones
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
