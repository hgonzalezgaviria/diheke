<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableSoftware extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
   public function up()
   {       
        Schema::create('recursos', function (Blueprint $table) {

            $table->increments('id');
            $table->string('descripcion', 300);
            $table->string('version', 50);
            $table->string('observaciones', 300);
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
        Schema::drop('recursos');
    }
}
