<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTablePoliticaSede extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
     public function up()
    {
        //
        Schema::create('politicasedes', function (Blueprint $table) {
         $table->increments('id');
         $table->integer('id_politica')->unsigned();
         $table->integer('id_sede')->unsigned();

         $table->foreign('id_politica')
                  ->references('id')->on('politicas')
                  ->onDelete('cascade');

            $table->foreign('id_sede')
                  ->references('id')->on('sedes')
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
         Schema::drop('politicasedes');
    }
}
