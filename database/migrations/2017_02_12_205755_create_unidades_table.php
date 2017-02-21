<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUnidadesTable extends Migration
{
    private $nomTabla = 'UNIDADES';

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $commentTabla = 'Datos basicos de las unidades (Facultades) que integran la universidad.';

        Schema::create($this->nomTabla, function (Blueprint $table) {
            $table->unsignedInteger('UNID_ID')->primary()
                ->comment('Valor autonumérico, llave primaria de la tabla UNIDADES.');

            $table->string('UNID_NOMBRE', 30)
                ->comment('Nombre de la Unidad, son las diferentes dependencias con las que cuenta la Universidad, como: Facultad de Ingenieria de Sistemas , Facultad de Arquitectura, Sedes (Unidad Operativa Cucuta, Unidad Oca');
                
            $table->string('UNID_CODIGO', 8)
                ->comment('Código de la unidad, asignado por la universidad a dicha dependencia');

            //Traza
            $table->timestamp('UNID_fechacreado')
                ->comment('Fecha en que se creó el registro en la tabla.');
            $table->timestamp('UNID_fechamodificado')->nullable()
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
