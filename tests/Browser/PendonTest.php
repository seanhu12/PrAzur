<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\Browser\Pages\Administracion\Pendon as PendonPage;
use Tests\Browser\Pages\Administracion\PendonEdit as PendonEditPage;
use App\User;
use App\Pendon;

class PendonTest extends DuskTestCase
{
    /**
     * Registro de pendon con datos correctos
     *
     */
    public function testRegistrarPendonDatosCorrecto()
    {

        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::find(1))
                ->maximize()
                ->visit(new PendonPage)
                ->clicK('@btn-formulario-crear')
                ->assertPathIs('/pendon/create')
                ->seleccionarTematica(1)
                ->type('#nombre', 'Pendon Liderazgo')
                ->attach('#custom_file_pendon', base_path('tests/Browser/file/test.png'))
                ->clicK('@btn-crear')
                ->waitForReload()
                ->pause('500')
                ->assertPathIs('/pendon');
        });

        $this->assertDatabaseHas('pendons', ['nombre' => 'Pendon Liderazgo']);
    }

    /**
     * Registro de pendon sin datos
     *
     */
    public function testRegistrarPendonSinDatos()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::find(1))
                ->maximize()
                ->visit(new PendonPage)
                ->clicK('@btn-formulario-crear')
                ->assertPathIs('/pendon/create')
                ->clicK('@btn-crear')
                ->assertPathIs('/pendon/create');
        });
    }

    /**
     * Registro de pendon ya existente
     *
     */
    public function testRegistrarPendonExistente()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::find(1))
                ->maximize()
                ->visit(new PendonPage)
                ->clicK('@btn-formulario-crear')
                ->assertPathIs('/pendon/create')
                ->seleccionarTematica(1)
                ->type('#nombre', 'Pendon Liderazgo')
                ->type('#custom_file_pendon', base_path('tests/Browser/file/test.png'))
                ->clicK('@btn-crear')
                ->waitForReload()
                ->pause('500')
                ->assertPathIs('/pendon');
        });
    }

    /**
     * Modificación de pendon con datos correctos
     * 
     */
    public function testModificarPendonConDatosCorrectos()
    {
        $pendon = Pendon::all()->last();

        $this->browse(function ($browser) use ($pendon) {
            $browser->loginAs(User::find(1))
                ->maximize()
                ->visit(new PendonEditPage($pendon->id))
                ->type('#nombre', 'Pendon ADS')
                ->attach('#custom_file_pendon', base_path('tests/Browser/file/test.png'))
                ->press('@btn-editar')
                ->waitForReload()
                ->pause('500')
                ->assertPathIs('/pendon/show/' . $pendon->id);
        });

        $this->assertDatabaseHas('pendons', ['nombre' => 'Pendon ADS']);
    }

    /**
     * Modificación de pendon sin datos
     * 
     */
    public function testModificarPendonSinDatos()
    {
        $pendon = Pendon::all()->last();

        $this->browse(function ($browser) use ($pendon) {
            $browser->loginAs(User::find(1))
                ->maximize()
                ->visit(new PendonEditPage($pendon->id))
                ->clear('#nombre')
                ->press('@btn-editar')
                ->assertPathIs('/pendon/edit/' . $pendon->id);
        });
    }
}
