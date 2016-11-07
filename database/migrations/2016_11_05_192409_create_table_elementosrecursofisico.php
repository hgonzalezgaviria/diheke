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

            $table->unSignedInteger('EERF_ID')
                ->comment = "Campo foráneo de la tabla ESTADOELEMENTORECURSOFISICO.";

                /*
            $table->string('ELRF_REGISTRADOPOR', 300)
                ->comment = "Campo de auditoria. este campo guarda el nombre del usuario que realizo el registro.";

            $table->date('ELRF_FECHACAMBIO')
                ->comment = "campo de auditoria. este campo es la fecha en que se cambio el registro de la tabla.";

            $table->string('ELRF_NOMBRE', 300)
                ->comment = "campo de auditoria. este campo guarda el nombre del usuario que realizo el registro.";

            $table->timestamps();
                */

            //Traza
            $table->string('ELRF_CREADOPOR')
                ->comment('Campo de auditoria. Usuario que creó el registro en la tabla');
            $table->timestamp('ELRF_FECHACREADO')
                ->comment('Campo de auditoria. Fecha en que se creó el registro en la tabla.');
            $table->string('ELRF_MODIFICADOPOR')->nullable()
                ->comment('Campo de auditoria. Usuario que realizó la última modificación del registro en la tabla.');
            $table->timestamp('ELRF_FECHAMODIFICADO')->nullable()
                ->comment('Campo de auditoria. Fecha de la última modificación del registro en la tabla.');
            $table->string('ELRF_ELIMINADOPOR')->nullable()
                ->comment('Campo de auditoria. Usuario que eliminó el registro en la tabla.');
            $table->timestamp('ELRF_FECHAELIMINADO')->nullable()
                ->comment('Campo de auditoria. Fecha en que se eliminó el registro en la tabla.');


            //Relaciones
            $table->foreign('EERF_ID')
                ->references('EERF_ID')->on('ESTADOELEMENTORECURSOFISICO')
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
        Schema::drop('ELEMENTOSRECURSOFISICO');
    }
}
