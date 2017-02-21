<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePersonaNaturalGeneralTable extends Migration
{
    private $nomTabla = 'PERSONANATURALGENERAL';

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $commentTabla = 'Contiene la informacion de las personas naturales.';

        Schema::create($this->nomTabla, function (Blueprint $table) {
            $table->unsignedInteger('PEGE_ID')->primary()
                ->comment('Llave primaria de la tabla PERSONANATURALGENERAL. Campo foráneo de la tabla PERSONAGENERAL.');

            $table->string('PENG_PRIMERAPELLIDO', 50)
                ->comment('Contiene el primer apellido');
            $table->string('PENG_SEGUNDOAPELLIDO', 50)->nullable()
                ->comment('Contiene el segundo apellido');
            $table->string('PENG_PRIMERNOMBRE', 50)
                ->comment('Contiene el primer nombre');
            $table->string('PENG_SEGUNDONOMBRE', 50)->nullable()
                ->comment('Contiene el segundo nombre');
            $table->string('PENG_SEXO', 1)
                ->comment('Contiene el sexo (M,F)');


            //Traza
            $table->timestamp('PENG_fechacreado')
                ->comment('Fecha en que se creó el registro en la tabla.');
            $table->timestamp('PENG_fechamodificado')->nullable()
                ->comment('Fecha de la última modificación del registro en la tabla.');

            //Relación con tabla PERSONAGENERAL
            $table->foreign('PEGE_ID')
                ->references('PEGE_ID')
                ->on('PERSONAGENERAL')
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
