<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableSituacionrecursofisico extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
   public function up()
    {       
        Schema::create('SITUACIONRECURSOFISICO', function (Blueprint $table) {

            $table->increments('SIRF_ID') 
                ->comment = "Valor autonumerico, llave primaria de la tabla SITUACIONRECURSOFISICO.";

            $table->string('SIRF_DESCRIPCION', 300)
                ->comment = "Descripcion de la Situacion del Recurso Fisico ejemplo: En Remodelacion, En Adecuacion, En Buen estado, Deteriorado, En Restauracion";

            $table->date('SIRF_FECHACAMBIO')
                ->comment = "campo de auditoria. este campo es la fecha en que se cambio el registro de la tabla.";

            $table->string('SIRF_REGISTRADOPOR', 300)
                ->comment = "campo de auditoria. este campo guarda el nombre del usuario que realizo el registro.";

            $table->timestamps();
            
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
        Schema::drop('SITUACIONRECURSOFISICO');
    }
}
