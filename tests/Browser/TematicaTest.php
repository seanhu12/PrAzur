<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\Browser\Pages\Administracion\Tematica as TematicaPage;
use Tests\Browser\Pages\Administracion\TematicaEdit as TematicaEditPage;
use App\User;
use App\Tematica;

class TematicaTest extends DuskTestCase
{
     /**
     * Registro de temática con datos correctos
     *
     */
    public function testRegistrarTematicaDatosCorrecto()
    {

        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::find(1))
                ->maximize()
                ->visit(new TematicaPage)
                ->clicK('@btn-formulario-crear')
                ->assertPathIs('/tematica/create')
                ->type('#nombre', 'Seguridad')
                ->clicK('@btn-crear')
                ->waitForReload()
                ->assertPathIs('/tematica');
        });

        $this->assertDatabaseHas('tematicas', ['nombre' => 'Seguridad']);
    }

    /**
     * Registro de temática sin datos 
     * 
     */
    public function testRegistrarTematicaSinDatos()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::find(1))
                ->maximize()
                ->visit(new TematicaPage)
                ->clicK('@btn-formulario-crear')
                ->assertPathIs('/tematica/create')
                ->assertSee('Crear Temática')
                ->clicK('@btn-crear')
                ->assertPathIs('/tematica/create');
        });
    }
 

     /**
     * Registro de temática ya existente
     *
     */
    public function testRegistrarTematicaExistente()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::find(1))
                ->maximize()
                ->visit(new TematicaPage)
                ->clicK('@btn-formulario-crear')
                ->assertPathIs('/tematica/create')
                ->type('#nombre', 'Seguridad')
                ->clicK('@btn-crear')
                ->pause('500')
                ->assertSee('El nombre ya ha sido registrado.')
                ->assertPathIs('/tematica/create');
        });
    }

    /**
     * Modificación de temática con datos correctos
     * 
     */
    public function testModificarTematicaConDatosCorrectos()
    {
        $tematica = Tematica::where('nombre', 'Seguridad')->first();

        $this->browse(function ($browser) use ($tematica) {
            $browser->loginAs(User::find(1))
                ->maximize()
                ->visit(new TematicaEditPage($tematica->id))
                //->click('@btn-formulario-editar')
                //->assertSee('Editar Temática')
                ->type('#nombre','Prevención')
                //->scrollTo('#button-editar')
                ->press('@btn-editar')
                ->waitForReload()
                ->pause('500')
                ->assertPathIs('/tematica/');
                //->assertPathIs('/tematica/edit/' . $tematica->id);
        });

        $this->assertDatabaseHas('tematicas', ['nombre' => 'Prevención']);
    }


    /**
     * Modificación de temática sin datos
     * 
     */
    public function testModificarTematicaSinDatos()
    {
        $tematica = Tematica::where('nombre', 'Prevención')->first();

        $this->browse(function ($browser) use ($tematica) {
            $browser->loginAs(User::find(1))
                ->maximize()
                ->visit(new TematicaEditPage($tematica->id))
                //->click('@btn-formulario-editar')
                //->assertSee('Editar Temática')
                ->clear('#nombre')
                //->scrollTo('#button-editar')
                ->press('@btn-editar')
                ->assertPathIs('/tematica/edit/' . $tematica->id);
        });
    }

    /**
     * Modificación de temática sin datos
     * 
     */
    /* public function testEliminarTematica()
    {
        $tematica = Tematica::where('nombre', 'Prevención')->first();

        $this->browse(function ($browser) use ($tematica) {
            $browser->loginAs(User::find(1))
                ->maximize()
                ->visit(new TematicaEditPage($tematica->id))
                //->click('#tabla > tbody:nth-child(2) > tr:nth-child(7) > td:nth-child(2) > div:nth-child(1) > a:nth-child(1)')
                //->click('#tabla > tbody:nth-child(2) > tr:nth-child(7) > td:nth-child(2) > div:nth-child(1) > button:nth-child(2)')
                ->click('button[onclick="javascript:deshabilitarTematica(9);"]')
                ->acceptDialog()
                ->waitForReload();
                //->assertPathIs('/tematica/edit/' . $tematica->id);
                
        });

        $this->assertSoftDeleted('tematicas', ['nombre' => 'Prevención']);

    } */


     /**
     * Reingreso de temática con datos correctos
     *
     */
    /* public function testReingresoTematicaEliminada()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::find(1))
                ->maximize()
                ->visit(new TematicaPage)
                ->clicK('@btn-formulario-crear')
                ->assertPathIs('/tematica/create')
                ->type('#nombre', 'Prevención')
                ->clicK('@btn-crear')
                ->waitForReload()
                ->assertPathIs('/tematica');
        });

        $this->assertDatabaseHas('tematicas', ['nombre' => 'Prevención']);
    } */
}
