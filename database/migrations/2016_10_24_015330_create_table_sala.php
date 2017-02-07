<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableSala extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('SALAS', function (Blueprint $table) {

            $table->increments('SALA_ID');
            $table->string('SALA_DESCRIPCION', 300);
            $table->integer('SALA_CAPACIDAD');
            $table->string('SALA_FOTOSALA', 500);
            $table->string('SALA_FOTOCROQUIS', 500);
            $table->string('SALA_OBSERVACIONES', 300);
            $table->integer('SALA_PRESTAMO'); 
            $table->integer('ESTA_ID')->unsigned();
            $table->integer('SEDE_ID')->unsigned(); 
            


             //Traza
            $table->string('SALA_CREADOPOR')
                ->comment('Usuario que creó el registro en la tabla');
            $table->timestamp('SALA_FECHACREADO')
                ->comment('Fecha en que se creó el registro en la tabla.');
            $table->string('SALA_MODIFICADOPOR')->nullable()
                ->comment('Usuario que realizó la última modificación del registro en la tabla.');
            $table->timestamp('SALA_FECHAMODIFICADO')->nullable()
                ->comment('Fecha de la última modificación del registro en la tabla.');
            $table->string('SALA_ELIMINADOPOR')->nullable()
                ->comment('Usuario que eliminó el registro en la tabla.');
            $table->timestamp('SALA_FECHAELIMINADO')->nullable()
                ->comment('Fecha en que se eliminó el registro en la tabla.');


          //Relaciones
            $table->foreign('ESTA_ID')
                  ->references('ESTA_ID')->on('ESTADOS')
                  ->onDelete('cascade');


            $table->foreign('SEDE_ID')
                  ->references('SEDE_ID')->on('SEDES')
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
        Schema::drop('SALAS');
    }
}
