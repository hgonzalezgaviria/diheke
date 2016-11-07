<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableTipoposesion extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
   public function up()
    {       
        Schema::create('TIPOPOSESION', function (Blueprint $table) {

            $table->increments('TIPO_ID') 
                ->comment = "Valor autonumerico, llave primaria de la tabla TIPOPOSESION.";

            $table->string('TIPO_DESCRIPCION', 300)
                ->comment = "Descripcion del tipo de Posesion, el cual puede ser: Propia, Arrendada, Convenio";

                ->comment = "indica si tipo de posesión es uncentro de práctica";
                

                /*
            $table->string('TIPO_REGISTRADOPOR', 300)
                ->comment = "campo de auditoria. este campo guarda el nombre del usuario que realizo el registro.";

            $table->date('TIPO_FECHACAMBIO')
                ->comment = "campo de auditoria. este campo es la fecha en que se cambio el registro de la tabla.";

            $table->timestamps();
                */

                        
            //Traza
            $table->string('TIPO_CREADOPOR')
                ->comment('Usuario que creó el registro en la tabla');
            $table->timestamp('TIPO_FECHACREADO')
                ->comment('Fecha en que se creó el registro en la tabla.');
            $table->string('TIPO_MODIFICADOPOR')->nullable()
                ->comment('Usuario que realizó la última modificación del registro en la tabla.');
            $table->timestamp('TIPO_FECHAMODIFICADO')->nullable()
                ->comment('Fecha de la última modificación del registro en la tabla.');
            $table->string('TIPO_ELIMINADOPOR')->nullable()
                ->comment('Usuario que eliminó el registro en la tabla.');
            $table->timestamp('TIPO_FECHAELIMINADO')->nullable()
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
        Schema::drop('TIPOPOSESION');
    }

}
