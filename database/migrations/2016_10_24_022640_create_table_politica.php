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
         $table->timestamp('POLI_HORA_MIN');
         $table->timestamp('POLI_HORA_MAX');
         $table->integer('POLI_HORAS_MIN_RESERVA');
         $table->integer('POLI_DIAS_MIN_CANCELAR');
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
         Schema::drop('POLITICAS');
    }
}
