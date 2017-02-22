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
            $table->string('AUTO_OBSERVACIONES', 300)->nullable();

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
