<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePersonaGeneralTable extends Migration
{
    private $nomTabla = 'PERSONAGENERAL';

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $commentTabla = 'Contiene los datos de la persona.';

        Schema::create($this->nomTabla, function (Blueprint $table) {
            $table->unsignedInteger('PEGE_ID')->primary()
                ->comment('Llave primaria de la tabla PERSONAGENERAL.');

            $table->string('PEGE_DOCUMENTOIDENTIDAD', 15)
                ->comment('Contiene el primer apellido');


            //Traza
            $table->timestamp('PEGE_fechacreado')
                ->comment('Fecha en que se creó el registro en la tabla.');
            $table->timestamp('PEGE_fechamodificado')->nullable()
                ->comment('Fecha de la última modificación del registro en la tabla.');
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
