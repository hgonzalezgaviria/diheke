<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ReservasAutorizadas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('RESERVAS_AUTORIZADAS', function (Blueprint $table) {

            $table->increments('REAU_ID');
            $table->integer('AUTO_ID')->unsigned();
            $table->integer('RESE_ID')->unsigned();
            

            //Relaciones
            $table->foreign('AUTO_ID')
                  ->references('AUTO_ID')->on('AUTORIZACIONES')
                  ->onDelete('cascade');


            $table->foreign('RESE_ID')
                  ->references('RESE_ID')->on('RESERVAS')
                  ->onDelete('cascade');
            
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
        Schema::drop('RESERVAS_AUTORIZADAS');
    }

}
