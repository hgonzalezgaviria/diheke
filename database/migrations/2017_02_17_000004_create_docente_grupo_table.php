<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDocenteGrupoTable extends Migration
{
    private $nomTabla = 'DOCENTESGRUPOS';

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $commentTabla = 'Contiene informacion de los docentes por grupos con referencias a sus unidades regionales.';

        Schema::create($this->nomTabla, function (Blueprint $table) {
            $table->unsignedInteger('DOUN_ID')->primary()
                ->comment('Llave primaria de la tabla DOCENTESGRUPOS. Campo foráneo de la tabla DOCENTESUNIDADES.');

            $table->unsignedInteger('GRUP_ID')
                ->comment('Campo foráneo de la tabla GRUPOS.');


            //Traza
            $table->timestamp('DOGR_fechacreado')
                ->comment('Fecha en que se creó el registro en la tabla.');
            $table->timestamp('DOGR_fechamodificado')->nullable()
                ->comment('Fecha de la última modificación del registro en la tabla.');

            //Relación con tabla DOCENTESUNIDADES
            $table->foreign('DOUN_ID')
                ->references('DOUN_ID')
                ->on('DOCENTESUNIDADES')
                ->onDelete('cascade')
                ->onUpdate('cascade');
                
            //Relación con tabla PERSONAGENERAL
            $table->foreign('GRUP_ID')
                ->references('GRUP_ID')
                ->on('GRUPOS')
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
