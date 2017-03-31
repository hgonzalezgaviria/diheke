<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use reservas\User;
use reservas\Sede;

class SedesTest extends TestCase
{
    /**
     * Index de sedes. Debe mostrar un listado con todas los registros disponibles.
     *
     * @return void
     */
    public function testListSedes()
    {
        //Having
        Sede::create([
            'SEDE_DESCRIPCION' => 'Sede 1',
            'SEDE_DIRECCION' => 'Dir 1',
            'SEDE_OBSERVACIONES' => 'Obs 1',
            'SEDE_CREADOPOR' => 'PRUEBAS',
        ]);
        Sede::create([
            'SEDE_DESCRIPCION' => 'Sede 2',
            'SEDE_DIRECCION' => 'Dir 2',
            'SEDE_OBSERVACIONES' => 'Obs 2',
            'SEDE_CREADOPOR' => 'PRUEBAS',
        ]);

        $user = User::where('username','admin')->get()->first();

        $this->be($user); //You are now authenticated

        //When
        $this->actingAs($user)
            ->visit('sedes')
            ->see('Sede 1')
            ->see('Sede 2');

    }

    /**
     * Crear una sede. Debe cargar el formulario para crear un registro y guardarlo en la base de datos.
     *
     * @return void
     */
    public function testCreateSede()
    {
        $user = User::where('username','admin')->get()->first();
        $this->be($user); //You are now authenticated

        $this->actingAs($user)
            ->visit('sedes')
            ->see('Sedes')
            ->click('Nuevo Elemento')
            ->seePageIs('sedes/create')
            ->see('Nueva Sede')

            ->type('Sede de prueba # 3', 'SEDE_DESCRIPCION')
            ->type('Dirección de prueba', 'SEDE_DIRECCION')
            ->type('Obs', 'SEDE_OBSERVACIONES')
            ->press('Guardar')
            ->seePageIs('/sedes')
            ->assertResponseOk();

        $this->seeInDatabase('SEDES', ['SEDE_DESCRIPCION' => 'Sede de prueba # 3']);
    }
}
