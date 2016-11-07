<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableLocalidad extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {       
        Schema::create('LOCALIDAD', function (Blueprint $table) {

            $table->increments('LOCA_ID') 
                ->comment = "Valor autonumerico, llave primaria de la tabla LOCALIDAD.";

            $table->string('LOCA_DESCRIPCION', 300)
                ->comment = "Descripcion de la Localidad, EJ: Granja Villa Marina, Casona, Ciudad Universitaria, Villa del Rosario";

            $table->string('LOCA_AREA', 300)
                ->comment = "Area de la Localidad, esta medida puede ser en Mts2 o en Hectareas, en el caso de una finca.";
                
            $table->integer('TIPO_ID')->unsigned()
                ->comment = "Campo foráneo de la tabla TIPOPOSESION.";

            /*$table->integer('CIGE_ID')->unsigned()
                ->comment = "Llave foranea de la tabla GENERAL.CIUDADGENERAL";*/


                /*
            $table->string('LOCA_REGISTRADOPOR', 300)
                ->comment = "campo de auditoria. este campo guarda el nombre del usuario que realizo el registro.";

            $table->date('LOCA_FECHACAMBIO')
                ->comment = "campo de auditoria. este campo es la fecha en que se cambio el registro de la tabla.";

            $table->timestamps(); 
                */

            //Traza
            $table->string('LOCA_CREADOPOR')
                ->comment('Usuario que creó el registro en la tabla');
            $table->timestamp('LOCA_FECHACREADO')
                ->comment('Fecha en que se creó el registro en la tabla.');
            $table->string('LOCA_MODIFICADOPOR')->nullable()
                ->comment('Usuario que realizó la última modificación del registro en la tabla.');
            $table->timestamp('LOCA_FECHAMODIFICADO')->nullable()
                ->comment('Fecha de la última modificación del registro en la tabla.');
            $table->string('LOCA_ELIMINADOPOR')->nullable()
                ->comment('Usuario que eliminó el registro en la tabla.');
            $table->timestamp('LOCA_FECHAELIMINADO')->nullable()
                ->comment('Fecha en que se eliminó el registro en la tabla.');


            //Relaciones
            $table->foreign('TIPO_ID')
                ->references('TIPO_ID')->on('TIPOPOSESION')
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
        //
        Schema::drop('LOCALIDAD');
    }
}
