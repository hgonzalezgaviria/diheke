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
        Schema::create('politicas', function (Blueprint $table) {
         $table->increments('id');
         $table->timestamp('hora_min');
         $table->timestamp('hora_max');
         $table->integer('horas_min_reserva');
         $table->integer('dias_min_cancelar');
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
         Schema::drop('politicas');
    }
}
