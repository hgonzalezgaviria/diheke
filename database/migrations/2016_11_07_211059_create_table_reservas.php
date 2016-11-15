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

            $table->increments('id') 
                ->comment = "Valor autonumerico, llave primaria de la tabla RESERVAS.";

            $table->datetime('fechaini')
                ->comment = "fecha inicio de la reserva";

            $table->datetime('fechafin')->nullable()
                ->comment = "fecha fin de la reserva";

            $table->boolean('todoeldia')->nullable()
                ->comment = "indica si la reunion es todo el día";

            $table->string('color')->nullable()
                ->comment = "color de la reserva.";

            $table->mediumText('titulo')->nullable()
                ->comment = "titulo de la reserva.";          

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
        Schema::drop('RESERVAS');
    }

}
