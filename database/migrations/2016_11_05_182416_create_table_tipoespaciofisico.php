<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableTipoespaciofisico extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {       
        Schema::create('TIPOESPACIOFISICO', function (Blueprint $table) {

            $table->increments('TIEF_ID') 
                ->comment = "Valor autonumerico, llave primaria de la tabla TIPOESPACIOFISICO.";

            $table->string('TIEF_DESCRIPCION', 300)
                ->comment = "Descripcion del tipo de posesion, el cual puede ser: Propia, Alquiler, Convenio para que los estudiantes realicen practicas, como por ejemplo en un Hospital o en las Instalaciones del SENA";

                /*
            $table->string('TIEF_REGISTRADOPOR', 300)
                ->comment = "campo de auditoria. este campo guarda el nombre del usuario que realizo el registro.";

            $table->date('TIEF_FECHACAMBIO')
                ->comment = "campo de auditoria. este campo es la fecha en que se cambio el registro de la tabla.";
                
            $table->timestamps(); //created_at
            */

            //Traza
            $table->string('TIEF_CREADOPOR')
                ->comment('Usuario que creó el registro en la tabla');
            $table->timestamp('TIEF_FECHACREADO')
                ->comment('Fecha en que se creó el registro en la tabla.');
            $table->string('TIEF_MODIFICADOPOR')->nullable()
                ->comment('Usuario que realizó la última modificación del registro en la tabla.');
            $table->timestamp('TIEF_FECHAMODIFICADO')->nullable()
                ->comment('Fecha de la última modificación del registro en la tabla.');
            $table->string('TIEF_ELIMINADOPOR')->nullable()
                ->comment('Usuario que eliminó el registro en la tabla.');
            $table->timestamp('TIEF_FECHAELIMINADO')->nullable()
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
        //
        Schema::drop('TIPOESPACIOFISICO');
    }
}
