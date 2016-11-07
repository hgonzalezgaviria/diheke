<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableEstadoElementosRecursoFisico extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {       
        Schema::create('ESTADOELEMENTORECURSOFISICO', function (Blueprint $table) {

            $table->increments('EERF_ID') 
                ->comment = "Valor autonumerico, llave primaria de la tabla ESTADOELEMENTORECURSOFISICO.";

            $table->string('EERF_DESCRIPCION', 300)
                ->comment = "Descripción del estado del elemento del recurso físico";

                /*
            $table->string('EERF_REGISTRADOPOR', 300)
                ->comment = "campo de auditoria. este campo guarda el nombre del usuario que realizo el registro.";

            $table->date('EERF_FECHACAMBIO')
                ->comment = "campo de auditoria. este campo es la fecha en que se cambio el registro de la tabla.";

            $table->timestamps();
                */
            
            //Traza
            $table->string('EERF_CREADOPOR')
                ->comment('Usuario que creó el registro en la tabla');
            $table->timestamp('EERF_FECHACREADO')
                ->comment('Fecha en que se creó el registro en la tabla.');
            $table->string('EERF_MODIFICADOPOR')->nullable()
                ->comment('Usuario que realizó la última modificación del registro en la tabla.');
            $table->timestamp('EERF_FECHAMODIFICADO')->nullable()
                ->comment('Fecha de la última modificación del registro en la tabla.');
            $table->string('EERF_ELIMINADOPOR')->nullable()
                ->comment('Usuario que eliminó el registro en la tabla.');
            $table->timestamp('EERF_FECHAELIMINADO')->nullable()
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
        Schema::drop('ESTADOELEMENTORECURSOFISICO');
    }
}
