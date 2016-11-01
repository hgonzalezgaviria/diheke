<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use Promo\Encuesta;

class EncuestasTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testListEncuestas()
    {
        //Having
        Encuesta::create(['titulo' => 'Encuesta 1']);
        Encuesta::create(['titulo' => 'Encuesta 2']);

        //When
        $this -> visit('encuestas')
            //Then
            -> see('Encuesta 1')
            -> see('Encuesta 2');

    }

    public function testCreateEncuesta()
    {
        $this->visit('encuestas')
            ->click('Nueva Encuesta')
            ->seePageIs('encuestas/create')
            ->see('Nueva Encuesta')
            ->type('otra encuesta', 'titulo')
            ->press('Guardar')
            ->seePageIs('encuestas')
            ->see('otra encuesta')
            ->seeInDataBase('encuestas', ['titulo' => 'otra encuesta']);
    }
}
