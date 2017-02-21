<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGruposTable extends Migration
{
    private $nomTabla = 'GRUPOS';

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $commentTabla = 'Contiene informacion general del grupo con referencias a sus materias, unidad y periodos.';

        Schema::create($this->nomTabla, function (Blueprint $table) {
            $table->unsignedInteger('GRUP_ID')->primary()
                ->comment('Valor autonumérico, llave primaria de la tabla GRUPOS.');

            $table->string('GRUP_NOMBRE', 30)
                ->comment('Contiene el identificador del grupo. ( A, B, C....)');
            $table->unsignedInteger('GRUP_CAPACIDAD')
                ->comment('Numero de cupos en el grupo.');


            $table->date('GRUP_FECHAINICIAL')
                ->comment('Fecha en la que inicia el grupo, segun cronograma de actividades.');
            $table->date('GRUP_FECHAFINAL')
                ->comment('Fecha en que termina el grupo, segun cronograma de actividades.');
            $table->boolean('GRUP_ACTIVO')
                ->comment('Campo de tipo Check(1 = Activo, 0=Inactivo).');

            $table->string('MATE_CODIGOMATERIA')
                ->comment('Campo foráneo de la tabla MATERIAS.');

            //Traza
            $table->timestamp('GRUP_fechacreado')
                ->comment('Fecha en que se creó el registro en la tabla.');
            $table->timestamp('GRUP_fechamodificado')->nullable()
                ->comment('Fecha de la última modificación del registro en la tabla.');

            //Relación con tabla MATERIAS
            $table->foreign('MATE_CODIGOMATERIA')
            ->references('MATE_CODIGOMATERIA')
            ->on('MATERIAS')
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
