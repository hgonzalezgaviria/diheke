<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableRecursoSalas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('RECURSOSALAS', function (Blueprint $table) {

         $table->increments('id');
         $table->integer('SALA_id')->unsigned();
         $table->integer('RECU_id')->unsigned();

            $table->foreign('SALA_id')
                  ->references('SALA_id')->on('SALAS')
                  ->onDelete('cascade');

            $table->foreign('RECU_id')
                  ->references('RECU_id')->on('RECURSOS')
                  ->onDelete('cascade');

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
         Schema::drop('RECURSOSALAS');
    }
}
