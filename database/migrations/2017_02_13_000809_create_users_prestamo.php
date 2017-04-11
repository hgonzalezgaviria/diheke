<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersPrestamo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('PRESTAMOS', function (Blueprint $table) {

            $table->increments('PRES_ID') 
                ->comment = "Valor autonumerico, llave primaria de la tabla PRESTAMOS.";

   

             $table->string('PRES_IDUSARIO', 15)
                ->comment = "Codigo/Identificación del usuario que adquiere el prestamo";  

                $table->string('PRES_NOMBREUSARIO', 100)
                ->comment = "Nombre del usuario que adquiere el prestamo";

            $table->integer('EQUI_ID')->unsigned()
                ->comment = "Campo foráneo de la tabla EQUIPOS.";

                $table->datetime('PRES_FECHAINI')->nullable()
                ->comment = "fecha inicio del prestamo del equipo";

            $table->datetime('PRES_FECHAFIN')->nullable()
                ->comment = "fecha fin del prestamo del equipo";
                

             //Traza
            $table->string('PRES_CREADOPOR')
                ->comment('Usuario que creó el registro en la tabla');
            $table->timestamp('PRES_FECHACREADO')
                ->comment('Fecha en que se creó el registro en la tabla.');
            $table->string('PRES_MODIFICADOPOR')->nullable()
                ->comment('Usuario que realizó la última modificación del registro en la tabla.');
            $table->timestamp('PRES_FECHAMODIFICADO')->nullable()
                ->comment('Fecha de la última modificación del registro en la tabla.');
            $table->string('PRES_ELIMINADOPOR')->nullable()
                ->comment('Usuario que eliminó el registro en la tabla.');
            $table->timestamp('PRES_FECHAELIMINADO')->nullable()
                ->comment('Fecha en que se eliminó el registro en la tabla.');


          //Relaciones

            $table->foreign('EQUI_ID')
                  ->references('EQUI_ID')->on('EQUIPOS')
                  ->onDelete('cascade');

           // $table->timestamps();
            
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

        Schema::drop('PRESTAMOS');
    }
}