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

         $table->increments('RESA_ID');
         $table->integer('SALA_ID')->unsigned();
         $table->integer('RECU_ID')->unsigned();

            $table->foreign('SALA_ID')
                  ->references('SALA_ID')->on('SALAS')
                  ->onDelete('cascade');

            $table->foreign('RECU_ID')
                  ->references('RECU_ID')->on('RECURSOS')
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
