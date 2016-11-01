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
        Schema::create('recursosalas', function (Blueprint $table) {

         $table->increments('id');
         $table->integer('id_sala')->unsigned();
         $table->integer('id_recurso')->unsigned();

            $table->foreign('id_sala')
                  ->references('id')->on('salas')
                  ->onDelete('cascade');

            $table->foreign('id_recurso')
                  ->references('id')->on('recursos')
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
         Schema::drop('recursosalas');
    }
}
