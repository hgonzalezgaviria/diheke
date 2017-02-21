<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMateriasTable extends Migration
{
    private $nomTabla = 'MATERIAS';

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $commentTabla = 'Descripcion de las diferentes materias que se ofrecen en los diferentes programas.';

        Schema::create($this->nomTabla, function (Blueprint $table) {
            $table->string('MATE_CODIGOMATERIA', 30)->primary()
                ->comment('Valor autonumérico, llave primaria de la tabla MATERIAS. Código por el cual la comunidad academica identifica una asignatura.');

            $table->string('MATE_NOMBRE', 50)
                ->comment('Nombre de la materia. Ej: ELEC REDES I (COMUNICACIÓN DE DATOS II)');

            $table->unsignedInteger('UNID_ID')
                ->comment('Campo foráneo de la tabla UNIDADES.');

            //Traza
            $table->timestamp('MATE_fechacreado')
                ->comment('Fecha en que se creó el registro en la tabla.');
            $table->timestamp('MATE_fechamodificado')->nullable()
                ->comment('Fecha de la última modificación del registro en la tabla.');

            //Relación con tabla UNIDADES
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
