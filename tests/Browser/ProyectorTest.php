<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\Browser\Pages\Administracion\Proyector as ProyectorPage;
use Tests\Browser\Pages\Administracion\ProyectorEdit as ProyectorEditPage;
use App\User;
use App\Proyector;

class ProyectorTest extends DuskTestCase
{
    /**
     * Registro de proyector con datos correctos
     *
     */
    public function testRegistrarProyectorDatosCorrecto()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::find(1))
                ->maximize()
                ->visit(new ProyectorPage)
                ->clicK('@btn-formulario-crear')
                ->assertPathIs('/proyector/create')
                ->type('#fecha_adquisicion', '10-10-2018')
                ->attach('#custom_file_proyector', base_path('tests/Browser/file/test.png'))
                ->clicK('@btn-crear')
                ->waitForReload()
                ->pause('500')
                ->assertPathIs('/proyector');
        });

        $this->assertDatabaseHas('proyectors', ['file_name' => 'test']);
    }

    /**
     * Registro de proyector sin datos
     *
     */
    public function testRegistrarProyectorSinDatos()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::find(1))
                ->maximize()
                ->visit(new ProyectorPage)
                ->clicK('@btn-formulario-crear')
                ->assertPathIs('/proyector/create')
                ->clicK('@btn-crear')
                ->assertPathIs('/proyector/create');
        });
    }

    /**
     * Registro de proyector ya existente
     *
     */
    public function testRegistrarProyectorExistente()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::find(1))
                ->maximize()
                ->visit(new ProyectorPage)
                ->clicK('@btn-formulario-crear')
                ->assertPathIs('/proyector/create')
                ->type('#fecha_adquisicion', '10-10-2018')
                ->attach('#custom_file_proyector', base_path('tests/Browser/file/test.png'))
                ->clicK('@btn-crear')
                ->waitForReload()
                ->pause('500')
                ->assertPathIs('/proyector');
        });
    }

    /**
     * Modificación de proyector con datos correctos
     * TODO revisar modificación de archivo.
     */
    public function testModificarProyectorConDatosCorrectos()
    {
        $proyector = Proyector::all()->last();

        $this->browse(function ($browser) use ($proyector) {
            $browser->loginAs(User::find(1))
                ->maximize()
                ->visit(new ProyectorEditPage($proyector->id))
                ->type('#fecha_adquisicion', '10-10-2017')
                ->attach('#custom_file_proyector', base_path('tests/Browser/file/test.png'))
                ->press('@btn-editar')
                ->waitForReload()
                ->pause('500')
                ->assertPathIs('/proyector');
                //->assertPathIs('/proyector/edit/' . $proyector->id);
        });

        $this->assertDatabaseHas('proyectors', ['file_name' => 'test']);
    }

    /**
     * Modificación de proyector sin datos
     *  
     */
    public function testModificarProyectorSinDatos()
    {
        $proyector = Proyector::all()->last();

        $this->browse(function ($browser) use ($proyector) {
            $browser->loginAs(User::find(1))
                ->maximize()
                ->visit(new ProyectorEditPage($proyector->id))
                ->clear('#fecha_adquisicion')
                ->press('@btn-editar')
                //->waitForReload()
                ->assertPathIs('/proyector/edit/' . $proyector->id);
        });
    }

}
