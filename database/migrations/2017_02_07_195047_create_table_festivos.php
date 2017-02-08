<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableFestivos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('FESTIVOS', function (Blueprint $table) {

            $table->increments('FEST_ID');
            $table->date('FEST_FECHA');
            $table->string('FEST_DESCRIPCION', 300)->nullable();

             //Traza
            $table->string('FEST_CREADOPOR')
                ->comment('Usuario que creó el registro en la tabla');
            $table->timestamp('FEST_FECHACREADO')
                ->comment('Fecha en que se creó el registro en la tabla.');
            $table->string('FEST_MODIFICADOPOR')->nullable()
                ->comment('Usuario que realizó la última modificación del registro en la tabla.');
            $table->timestamp('FEST_FECHAMODIFICADO')->nullable()
                ->comment('Fecha de la última modificación del registro en la tabla.');
            $table->string('FEST_ELIMINADOPOR')->nullable()
                ->comment('Usuario que eliminó el registro en la tabla.');
            $table->timestamp('FEST_FECHAELIMINADO')->nullable()
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
        Schema::drop('FESTIVOS');
    }
}
