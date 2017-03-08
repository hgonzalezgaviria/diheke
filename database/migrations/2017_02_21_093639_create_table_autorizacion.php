<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableAutorizacion extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('AUTORIZACIONES', function (Blueprint $table) {

            $table->increments('AUTO_ID');
            $table->datetime('AUTO_FECHASOLICITUD');
            $table->datetime('AUTO_FECHAAPROBACION')->nullable();
            $table->unsignedInteger('AUTO_ESTADO');
            $table->unsignedInteger('UNID_ID')->nullable();
            $table->unsignedInteger('PEGE_ID')->nullable();
            $table->unsignedInteger('GRUP_ID')->nullable();
            $table->string('MATE_CODIGOMATERIA')->nullable();
            $table->string('AUTO_OBSERVACIONES', 300)->nullable();


            //Relaciones
            $table->foreign('UNID_ID')
                  ->references('UNID_ID')->on('UNIDADES')
                  ->onDelete('cascade');


            $table->foreign('GRUP_ID')
                  ->references('GRUP_ID')->on('GRUPOS')
                  ->onDelete('cascade');

            $table->foreign('MATE_CODIGOMATERIA')
                  ->references('MATE_CODIGOMATERIA')->on('MATERIAS')
                  ->onDelete('cascade');

            
            $table->foreign('PEGE_ID')
                  ->references('PEGE_ID')->on('PERSONAGENERAL')
                  ->onDelete('cascade');
            

             //Traza
            $table->string('AUTO_CREADOPOR')
                ->comment('Usuario que creó el registro en la tabla');
            $table->timestamp('AUTO_FECHACREADO')
                ->comment('Fecha en que se creó el registro en la tabla.');
            $table->string('AUTO_MODIFICADOPOR')->nullable()
                ->comment('Usuario que realizó la última modificación del registro en la tabla.');
            $table->timestamp('AUTO_FECHAMODIFICADO')->nullable()
                ->comment('Fecha de la última modificación del registro en la tabla.');
            $table->string('AUTO_ELIMINADOPOR')->nullable()
                ->comment('Usuario que eliminó el registro en la tabla.');
            $table->timestamp('AUTO_FECHAELIMINADO')->nullable()
                ->comment('Fecha en que se eliminó el registro en la tabla.');
            
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
        Schema::drop('AUTORIZACIONES');
    }

}
