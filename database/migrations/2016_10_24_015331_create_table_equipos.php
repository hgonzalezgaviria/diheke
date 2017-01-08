<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableEquipos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('EQUIPOS', function (Blueprint $table) {

            $table->increments('EQUI_ID');
            $table->string('EQUI_DESCRIPCION', 300);
            $table->string('EQUI_OBSERVACIONES', 300);
            $table->integer('SALA_ID')->unsigned();
            $table->integer('ESTA_ID')->unsigned();

             //Traza
            $table->string('EQUI_CREADOPOR')
                ->comment('Usuario que creó el registro en la tabla');
            $table->timestamp('EQUI_FECHACREADO')
                ->comment('Fecha en que se creó el registro en la tabla.');
            $table->string('EQUI_MODIFICADOPOR')->nullable()
                ->comment('Usuario que realizó la última modificación del registro en la tabla.');
            $table->timestamp('EQUI_FECHAMODIFICADO')->nullable()
                ->comment('Fecha de la última modificación del registro en la tabla.');
            $table->string('EQUI_ELIMINADOPOR')->nullable()
                ->comment('Usuario que eliminó el registro en la tabla.');
            $table->timestamp('EQUI_FECHAELIMINADO')->nullable()
                ->comment('Fecha en que se eliminó el registro en la tabla.');


           //Relaciones
            $table->foreign('ESTA_ID')
                  ->references('ESTA_ID')->on('ESTADOS')
                  ->onDelete('cascade');


            $table->foreign('SALA_ID')
                  ->references('SALA_ID')->on('SALAS')
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
        Schema::drop('EQUIPOS');
    }
}
