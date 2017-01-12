<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTablePolitica extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('POLITICAS', function (Blueprint $table) {
         $table->increments('POLI_ID');
         $table->time('POLI_HORA_MIN');
         $table->time('POLI_HORA_MAX');
         $table->integer('POLI_HORAS_MIN_RESERVA');
         $table->integer('POLI_DIAS_MIN_CANCELAR');
         
         //Traza
            $table->string('POLI_CREADOPOR')
                ->comment('Usuario que creó el registro en la tabla');
            $table->timestamp('POLI_FECHACREADO')
                ->comment('Fecha en que se creó el registro en la tabla.');
            $table->string('POLI_MODIFICADOPOR')->nullable()
                ->comment('Usuario que realizó la última modificación del registro en la tabla.');
            $table->timestamp('POLI_FECHAMODIFICADO')->nullable()
                ->comment('Fecha de la última modificación del registro en la tabla.');
            $table->string('POLI_ELIMINADOPOR')->nullable()
                ->comment('Usuario que eliminó el registro en la tabla.');
            $table->timestamp('POLI_FECHAELIMINADO')->nullable()
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
         Schema::drop('POLITICAS');
    }
}
