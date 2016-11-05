<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableTiporecursofisico extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
   public function up()
    {       
        Schema::create('TIPORECURSOFISICO', function (Blueprint $table) {

            $table->increments('TIRF_ID') 
                ->comment = "Valor autonumerico, llave primaria de la tabla TIPORECURSOFISICO.";

            $table->string('TIRF_DESCRIPCION', 300)
                ->comment = "Descripcion, el cual puede ser: Aula, Laboratorio, Campo Deportivo";

            $table->string('TIRF_REGISTRADOPOR', 300)
                ->comment = "campo de auditoria. este campo guarda el nombre del usuario que realizo el registro.";

            $table->date('TIRF_FECHACAMBIO')
                ->comment = "campo de auditoria. este campo es la fecha en que se cambio el registro de la tabla.";
                
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
        Schema::drop('TIPORECURSOFISICO');
    }

}
