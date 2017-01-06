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
        Schema::create('POLITICASEDES', function (Blueprint $table) {
         $table->increments('POSE_id');
         $table->integer('POLI_ID')->unsigned();
         $table->integer('SEDE_ID')->unsigned();

         $table->foreign('POLI_ID')
                  ->references('POLI_ID')->on('POLITICAS')
                  ->onDelete('cascade');

            $table->foreign('SEDE_ID')
                  ->references('SEDE_ID')->on('SEDES')
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
         Schema::drop('POLITICASEDES');
    }
}
