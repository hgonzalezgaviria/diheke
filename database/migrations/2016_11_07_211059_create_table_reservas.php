<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableReservas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {       
        Schema::create('RESERVAS', function (Blueprint $table) {

            $table->increments('RESE_ID') 
                ->comment = "Valor autonumerico, llave primaria de la tabla RESERVAS.";

            $table->datetime('RESE_FECHAINI')
                ->comment = "fecha inicio de la reserva";

            $table->datetime('RESE_FECHAFIN')->nullable()
                ->comment = "fecha fin de la reserva";

            $table->boolean('RESE_TODOELDIA')->nullable()
                ->comment = "indica si la reunion es todo el día";

            /*$table->string('RESE_COLOR')->nullable()
                ->comment = "color de la reserva.";*/

            $table->mediumText('RESE_TITULO')->nullable()
                ->comment = "titulo de la reserva.";

            $table->integer('SALA_ID')->unsigned()
                ->comment = 'Campo foráneo de la tabla SALAS.';

            $table->integer('EQUI_ID')->unsigned()->nullable()
                ->comment = 'Campo foráneo de la tabla EQUIPOS.';

             //Traza
            $table->string('RESE_CREADOPOR')
                ->comment('Usuario que creó el registro en la tabla');
            $table->timestamp('RESE_FECHACREADO')
                ->comment('Fecha en que se creó el registro en la tabla.');
            $table->string('RESE_MODIFICADOPOR')->nullable()
                ->comment('Usuario que realizó la última modificación del registro en la tabla.');
            $table->timestamp('RESE_FECHAMODIFICADO')->nullable()
                ->comment('Fecha de la última modificación del registro en la tabla.');
            $table->string('RESE_ELIMINADOPOR')->nullable()
                ->comment('Usuario que eliminó el registro en la tabla.');
            $table->timestamp('RESE_FECHAELIMINADO')->nullable()
                ->comment('Fecha en que se eliminó el registro en la tabla.');


            //Relaciones
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
        Schema::drop('RESERVAS');
    }

}
