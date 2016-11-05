<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableElementosrecursofisico extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
     public function up()
    {       
        Schema::create('ELEMENTOSRECURSOFISICO', function (Blueprint $table) {

            $table->increments('ELRF_ID') 
                ->comment = "Valor autonumerico, llave primaria de la tabla ELEMENTOSRECURSOFISICO.";

            $table->string('ELRF_DESCRIPCION', 300)
                ->comment = "Referencia el nombre del activo dentro del recurso fisico.";

            $table->string('ELRF_REGISTRADOPOR', 300)
                ->comment = "campo de auditoria. este campo guarda el nombre del usuario que realizo el registro.";

            $table->date('ELRF_FECHACAMBIO')
                ->comment = "campo de auditoria. este campo es la fecha en que se cambio el registro de la tabla.";

            $table->string('ELRF_NOMBRE', 300)
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
        Schema::drop('ELEMENTOSRECURSOFISICO');
    }
}
