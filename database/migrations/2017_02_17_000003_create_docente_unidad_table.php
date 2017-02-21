<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDocenteUnidadTable extends Migration
{
    private $nomTabla = 'DOCENTESUNIDADES';

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $commentTabla = 'Contiene informacion sobre la relacion existente entre el docente y la unidad.';

        Schema::create($this->nomTabla, function (Blueprint $table) {
            $table->unsignedInteger('DOUN_ID')->primary()
                ->comment('Valor autonumerico, llave primaria de la tabla DOCENTESUNIDADES.');

            $table->unsignedInteger('PEGE_ID')
                ->comment('Campo foráneo de la tabla TRABAJADORLABOR.');
            $table->unsignedInteger('UNID_ID')
                ->comment('Campo foráneo de la tabla UNIDADES.');
            $table->unsignedInteger('TRLU_ID')->nullable()
                ->comment('Campo foráneo de la tabla TRABAJADORLABORUNIDAD.');
            $table->unsignedInteger('LABO_ID')->nullable()
                ->comment('Campo foráneo de la tabla TRABAJADORLABOR.');
            $table->unsignedInteger('DOVI_ID')->nullable()
                ->comment('Campo foráneo de la tabla TRABAJADORLABOR¿?.');

            //Traza
            $table->timestamp('DOUN_fechacreado')
                ->comment('Fecha en que se creó el registro en la tabla.');
            $table->timestamp('DOUN_fechamodificado')->nullable()
                ->comment('Fecha de la última modificación del registro en la tabla.');

            //Relación con tabla PERSONAGENERAL
            $table->foreign('PEGE_ID')
                ->references('PEGE_ID')
                ->on('PERSONAGENERAL')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            //Relación con tabla PERSONAGENERAL
            $table->foreign('UNID_ID')
                ->references('UNID_ID')
                ->on('UNIDADES')
                ->onDelete('cascade')
                ->onUpdate('cascade');

        });
        
        if(env('DB_CONNECTION') == 'pgsql')
            DB::statement("COMMENT ON TABLE ".env('DB_SCHEMA').".\"".$this->nomTabla."\" IS '".$commentTabla."'");
        elseif(env('DB_CONNECTION') == 'mysql')
            DB::statement("ALTER TABLE ".$this->nomTabla." COMMENT = '".$commentTabla."'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop($this->nomTabla);
    }
}
