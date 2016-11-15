<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableTiporecursofisico extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
   public function up()
    {       
        Schema::create('TIPORECURSOFISICO', function (Blueprint $table) {

            $table->increments('TIRF_ID') 
                ->comment = "Valor autonumerico, llave primaria de la tabla TIPORECURSOFISICO.";

            $table->string('TIRF_DESCRIPCION', 300)
                ->comment = "Descripcion, el cual puede ser: Aula, Laboratorio, Campo Deportivo";

              
            //Traza
            $table->string('TIRF_CREADOPOR')
                ->comment('Usuario que creó el registro en la tabla');
            $table->timestamp('TIRF_FECHACREADO')
                ->comment('Fecha en que se creó el registro en la tabla.');
            $table->string('TIRF_MODIFICADOPOR')->nullable()
                ->comment('Usuario que realizó la última modificación del registro en la tabla.');
            $table->timestamp('TIRF_FECHAMODIFICADO')->nullable()
                ->comment('Fecha de la última modificación del registro en la tabla.');
            $table->string('TIRF_ELIMINADOPOR')->nullable()
                ->comment('Usuario que eliminó el registro en la tabla.');
            $table->timestamp('TIRF_FECHAELIMINADO')->nullable()
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
        Schema::drop('TIPORECURSOFISICO');
    }

}
