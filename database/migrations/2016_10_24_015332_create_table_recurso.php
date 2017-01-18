<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableRecurso extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
   public function up()
   {       
        Schema::create('RECURSOS', function (Blueprint $table) {

            $table->increments('RECU_ID');
            $table->string('RECU_DESCRIPCION', 300);
            $table->string('RECU_VERSION', 50);
            $table->string('RECU_OBSERVACIONES', 300);

            $table->integer('SALA_ID')->unsigned();

            
            //Traza
            $table->string('RECU_CREADOPOR')
                ->comment('Usuario que creó el registro en la tabla');
            $table->timestamp('RECU_FECHACREADO')
                ->comment('Fecha en que se creó el registro en la tabla.');
            $table->string('RECU_MODIFICADOPOR')->nullable()
                ->comment('Usuario que realizó la última modificación del registro en la tabla.');
            $table->timestamp('RECU_FECHAMODIFICADO')->nullable()
                ->comment('Fecha de la última modificación del registro en la tabla.');
            $table->string('RECU_ELIMINADOPOR')->nullable()
                ->comment('Usuario que eliminó el registro en la tabla.');
            $table->timestamp('RECU_FECHAELIMINADO')->nullable()
                ->comment('Fecha en que se eliminó el registro en la tabla.');
                
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
        Schema::drop('RECURSOS');
    }
}
