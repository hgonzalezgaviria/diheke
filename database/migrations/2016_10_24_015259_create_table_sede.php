<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableSede extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
   {       
        Schema::create('SEDES', function (Blueprint $table) {

            $table->increments('SEDE_ID');
            $table->string('SEDE_DESCRIPCION', 300);
            $table->string('SEDE_DIRECCION', 300);
            $table->string('SEDE_OBSERVACIONES', 300);
            $table->integer('USER_ID')->unsigned();

            $table->foreign('USER_ID')
                  ->references('USER_ID')->on('USERS')
                  ->onDelete('cascade');


            //Traza
            $table->string('SEDE_CREADOPOR')
                ->comment('Usuario que creó el registro en la tabla');
            $table->timestamp('SEDE_FECHACREADO')
                ->comment('Fecha en que se creó el registro en la tabla.');
            $table->string('SEDE_MODIFICADOPOR')->nullable()
                ->comment('Usuario que realizó la última modificación del registro en la tabla.');
            $table->timestamp('SEDE_FECHAMODIFICADO')->nullable()
                ->comment('Fecha de la última modificación del registro en la tabla.');
            $table->string('SEDE_ELIMINADOPOR')->nullable()
                ->comment('Usuario que eliminó el registro en la tabla.');
            $table->timestamp('SEDE_FECHAELIMINADO')->nullable()
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
        Schema::drop('SEDES');
    }
}
