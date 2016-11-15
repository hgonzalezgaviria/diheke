<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableRecursofisico extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('RECURSOFISICO', function (Blueprint $table) {

            $table->increments('REFI_ID') 
                ->comment = "Valor autonumerico, llave primaria de la tabla RECURSOFISICO.";

            $table->string('REFI_NOMENCLATURA', 20)
                ->comment = "Nomenclatura empleada para la asignacion del recurso fisico, ejemplo FA-101";

            $table->unSignedInteger('REFI_CAPACIDADMAXIMA')
                ->comment = "Capacidad Maxima del Recurso fisico.";


            $table->string('REFI_TIPOASIGNACION', 1)
                ->comment = "Tipo de Asignacion, el cual puede ser Global, Compartida, Exclusiva";

            $table->string('REFI_DESCRIPCION', 100)
                ->comment = "Descripcion del Recurso Fisico, el cual puede ser: Laboratorio de Quimica";

            $table->string('REFI_NIVEL', 25)
                ->comment = "Nivel en el cual se encuentra ubicado el Recurso Fisico, el cual puede ser: Sotano, Primer Nivel,, etc.";

            $table->string('REFI_ESTADO', 20)
                ->comment = "Estado del Recurso fisico, el cual puede ser: Activo (ocupado) Inactivo (desocupado)";

            $table->unSignedInteger('REFI_CAPACIDADREAL')
                ->comment = "Capacidad maxima de un recurso fisico";

            $table->boolean('REFI_PRESTABLE')
                ->comment = "Campo de tipo check ('1','0') que determina si el recurso es prestable.";
                
            $table->unSignedInteger('REFI_AREAREAL')
                ->comment = "Campo donde se guarda el Area del recurso fisico.";

            $table->unSignedInteger('REFI_AREAUSADA')
                ->comment = "Campo donde se guarda el Area que ha sido usada del recurso fisico.";
            
            //Campos foráneos
            $table->unSignedInteger('SIRF_ID')
                ->comment = "Campo foráneo de la tabla SITUACIONRECURSOFISICO.";
            $table->unSignedInteger('TIRF_ID')
                ->comment = "Campo foráneo de la tabla TIPORECURSOFISICO.";
            $table->unSignedInteger('ESFI_ID')
                ->comment = "Campo foráneo de la tabla ESPACIOFISICO.";
            $table->unSignedInteger('TIPO_ID')
                ->comment = "Campo foráneo de la tabla TIPOPOSESION.";


            //Traza
            $table->string('REFI_CREADOPOR')
                ->comment('Usuario que creó el registro en la tabla');
            $table->timestamp('REFI_FECHACREADO')
                ->comment('Fecha en que se creó el registro en la tabla.');
            $table->string('REFI_MODIFICADOPOR')->nullable()
                ->comment('Usuario que realizó la última modificación del registro en la tabla.');
            $table->timestamp('REFI_FECHAMODIFICADO')->nullable()
                ->comment('Fecha de la última modificación del registro en la tabla.');
            $table->string('REFI_ELIMINADOPOR')->nullable()
                ->comment('Usuario que eliminó el registro en la tabla.');
            $table->timestamp('REFI_FECHAELIMINADO')->nullable()
                ->comment('Fecha en que se eliminó el registro en la tabla.');


            //Relaciones
            $table->foreign('SIRF_ID')
                ->references('SIRF_ID')->on('SITUACIONRECURSOFISICO')
                ->onUpdate('cascade')
                ->onDelete('restrict');

            $table->foreign('TIRF_ID')
                ->references('TIRF_ID')->on('TIPORECURSOFISICO')
                ->onUpdate('cascade')
                ->onDelete('restrict');

            $table->foreign('ESFI_ID')
                ->references('ESFI_ID')->on('ESPACIOFISICO')
                ->onUpdate('cascade')
                ->onDelete('restrict');

            $table->foreign('TIPO_ID')
                ->references('TIPO_ID')->on('TIPOPOSESION')
                ->onUpdate('cascade')
                ->onDelete('restrict');
        });
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('RECURSOFISICO');
    }
}
