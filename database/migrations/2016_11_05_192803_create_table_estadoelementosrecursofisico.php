<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableEstadoelementosrecursofisico extends Migration
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

            $table->string('EERF_REGISTRADOPOR', 300)
                ->comment = "campo de auditoria. este campo guarda el nombre del usuario que realizo el registro.";

            $table->date('EERF_FECHACAMBIO')
                ->comment = "campo de auditoria. este campo es la fecha en que se cambio el registro de la tabla.";

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
        Schema::drop('ESTADOELEMENTORECURSOFISICO');
    }
}
