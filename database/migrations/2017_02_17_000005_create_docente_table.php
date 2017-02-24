<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDocenteTable extends Migration
{
    private $nomTabla = 'DOCENTES';

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $commentTabla = 'Contiene informacion de los docentes.';

        Schema::create($this->nomTabla, function (Blueprint $table) {
            
            $table->integer('DOCE_IDENTIFICACION')
                ->unique()
                ->comment('Identificación del docente.');

            $table->string('DOCE_NOMBRES')
                ->comment('Nombre del docente.');

            $table->string('DOCE_APELLIDOS')
                ->comment('Apellidos del docente.');

            $table->string('DOCE_CORREO')
                ->comment('Correo del docente.');

            $table->unsignedInteger('UNID_ID')->nullable()
                ->comment('Campo foráneo de la tabla GRUPOS.');


            //Traza
            $table->timestamp('DOCE_fechacreado')
                ->comment('Fecha en que se creó el registro en la tabla.');
            $table->timestamp('DOCE_fechamodificado')->nullable()
                ->comment('Fecha de la última modificación del registro en la tabla.');


            $table->primary(['DOCE_IDENTIFICACION', 'UNID_ID']);

            
                

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
