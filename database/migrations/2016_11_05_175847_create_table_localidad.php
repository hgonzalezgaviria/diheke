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

            $table->integer('TIPO_ID')->unsigned()
                ->comment = "Campo foráneo de la tabla TIPOPOSESION.";

            $table->string('LOCA_REGISTRADOPOR', 300)
                ->comment = "campo de auditoria. este campo guarda el nombre del usuario que realizo el registro.";

            $table->date('LOCA_FECHACAMBIO')
                ->comment = "campo de auditoria. este campo es la fecha en que se cambio el registro de la tabla.";

            $table->integer('CIGE_ID')->unsigned()
                ->comment = "Llave foranea de la tabla GENERAL.CIUDADGENERAL";

            $table->string('LOCA_AREA', 300)
                ->comment = "Area de la Localidad, esta medida puede ser en Mts2 o en Hectareas, en el caso de una finca.";

            $table->timestamps(); 

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
        Schema::drop('LOCALIDAD');
    }
}
