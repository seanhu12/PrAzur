<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\Browser\Pages\Administracion\Otic as OticPage;
use Tests\Browser\Pages\Administracion\OticPerfil as OticPerfilPage;
use App\User;
use App\Otic;

class OticTest extends DuskTestCase
{
    /**
     * Registro de OTIC con datos correctos
     *
     */
    public function testRegistrarOticDatosCorrecto()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::find(1))
                ->maximize()
                ->visit(new OticPage)
                ->clicK('@btn-formulario-crear')
                ->assertPathIs('/otic/create')
                ->type('#nombre', 'Centro Intermedio para Capacitación Proforma')
                ->type('#rut', '74.252.300-4')
                ->type('#mail', 'contacto@proforma.cl')
                ->type('#direccion', 'Avda. Los Leones N° 668, Providencia, 13 ')
                ->type('#telefono_fijo', '223529800')
                ->type('#celular', '56997123123')
                ->clicK('@btn-crear')
                ->waitForReload()
                ->assertPathIs('/otic');
        });

        $this->assertDatabaseHas('otics', ['rut' => '74.252.300-4']);
    }

    /**
     * Registro de otic con datos incorrectos 
     * 
     */
    public function testRegistrarOticDatosIncorrecto()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::find(1))
                ->maximize()
                ->visit(new OticPage)
                ->clicK('@btn-formulario-crear')
                ->assertPathIs('/otic/create')
                ->type('#nombre', 'Corporación de Capacitación y Desarrollo')
                ->type('#rut', '968430-7')
                ->type('#mail', 'contacto.oticpromaule.cl')
                ->type('#direccion', 'Avenida Américo Vespucio 0631')
                ->type('#telefono_fijo', '2230')
                ->type('#celular', '569')
                ->clicK('@btn-crear')
                ->assertPathIs('/otic/create');
        });
    }

    /**
     * Registro de otic sin datos.
     * 
     */
    public function testRegistrarOticSinDatos()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::find(1))
                ->maximize()
                ->visit(new OticPage)
                ->clicK('@btn-formulario-crear')
                ->assertPathIs('/otic/create')
                ->clicK('@btn-crear')
                ->assertPathIs('/otic/create');
        });
    }


    /**
     * Registro de otic con datos faltantes.
     * 
     */
    public function testRegistrarOticDatosFaltantes()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::find(1))
                ->maximize()
                ->visit(new OticPage)
                ->clicK('@btn-formulario-crear')
                ->assertPathIs('/otic/create')
                ->type('#direccion', 'Avenida Américo Vespucio 631')
                ->clicK('@btn-crear')
                ->assertPathIs('/otic/create');
        });
    }

    /**
     * Registro de otic ya existente.
     * 
     */
    public function testRegistrarOticExistente()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::find(1))
                ->maximize()
                ->visit(new OticPage)
                ->clicK('@btn-formulario-crear')
                ->assertPathIs('/otic/create')
                ->type('#nombre', 'Centro Intermedio para Capacitación Proforma')
                ->type('#rut', '74.252.300-4')
                ->type('#mail', 'contacto@proforma.cl')
                ->type('#direccion', 'Avda. Los Leones N° 668, Providencia, 13 ')
                ->type('#telefono_fijo', '223529800')
                ->type('#celular', '56997123123')
                ->clicK('@btn-crear')
                ->pause('400')
                ->assertSee('El rut ya ha sido registrado')
                ->assertPathIs('/otic/create');
        });
    }

    /**
     * Modificación de otic con datos correctos
     * 
     */
    public function testModificarOticConDatosCorrectos()
    {
        $otic = Otic::where('rut', '74.252.300-4')->first();

        $this->browse(function ($browser) use ($otic) {
            $browser->loginAs(User::find(1))
                ->maximize()
                ->visit(new OticPerfilPage($otic->id))
                ->click('@btn-formulario-editar')
                ->assertSee('Editar OTIC')
                ->type('#nombre', 'Centro Proforma')
                ->type('#mail', 'contact@centroproforma.cl')
                ->type('#direccion', 'Avda. Los Leones N° 668, Providencia, 13')
                ->type('#telefono_fijo', '223529812')
                ->type('#celular', '56977123123')
                ->scrollTo('#button-crear')
                ->press('@btn-editar')
                ->waitForReload()
                ->assertPathIs('/otic/show/' . $otic->id)
                ->assertsee('Información OTIC');
        });

        $this->assertDatabaseHas('otics', [
            'rut' => '74.252.300-4',
            'direccion' => 'Avda. Los Leones N° 668, Providencia, 13',
            'mail' => 'contact@centroproforma.cl'
        ]);
    }

    /**
     * Modificación de otic con datos incorrectos
     * 
     */
    public function testModificarOticConDatosIncorrectos()
    {
        $otic = Otic::where('rut', '74.252.300-4')->first();

        $this->browse(function ($browser) use ($otic) {
            $browser->loginAs(User::find(1))
                ->maximize()
                ->visit(new OticPerfilPage($otic->id))
                ->click('@btn-formulario-editar')
                ->assertSee('Editar OTIC')
                ->type('#mail', 'contact@centroproforma')
                ->scrollTo('#button-crear')
                ->press('@btn-editar')
                ->assertPathIs('/otic/edit/' . $otic->id);
        });
    }

    /**
     * Modificación de otic sin datos
     * 
     */
    public function testModificarOticSinDatos()
    {
        $otic = Otic::where('rut', '74.252.300-4')->first();

        $this->browse(function ($browser) use ($otic) {
            $browser->loginAs(User::find(1))
                ->maximize()
                ->visit(new OticPerfilPage($otic->id))
                ->click('@btn-formulario-editar')
                ->assertSee('Editar OTIC')
                ->clear('#nombre')
                ->clear('#mail')
                ->clear('#direccion')
                ->clear('#telefono_fijo', '223529812')
                ->clear('#celular', '56977123123')
                ->scrollTo('#button-crear')
                ->press('@btn-editar')
                ->assertPathIs('/otic/edit/' . $otic->id);
        });
    }

    /**
     * Despliegue de perfil otic
     * 
     */
    public function testDesplieguePerfilOtic()
    {
        $otic = Otic::where('rut', '74.252.300-4')->first();

        $this->browse(function ($browser) use ($otic) {
            $browser->loginAs(User::find(1))
                ->maximize()
                ->visit(new OticPerfilPage($otic->id))
                ->assertSee($otic->rut)
                ->assertSee($otic->nombre)
                ->assertSee($otic->mail);
        });
    }

    /**
     * Eliminación  de otic
     * 
     */
    public function testEliminarOtic()
    {
        $otic = Otic::where('rut', '74.252.300-4')->first();

        $this->browse(function ($browser) use ($otic) {
            $browser->loginAs(User::find(1))
                ->maximize()
                ->visit(new OticPerfilPage($otic->id))
                ->click('@eliminar')
                ->acceptDialog()
                ->waitForReload()
                ->assertPathIs('/otic');
        });

        $this->assertSoftDeleted('otics', ['rut' => $otic->rut]);
    }

    
    /**
     * Registro de otic con datos correctos
     * 
     */
    public function testReingresoOticEliminada()
    {

        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::find(1))
                ->maximize()
                ->visit(new OticPage)
                ->clicK('@btn-formulario-crear')
                ->assertPathIs('/otic/create')
                ->type('#nombre', 'Centro Intermedio para Capacitación Proforma')
                ->type('#rut', '74.252.300-4')
                ->type('#mail', 'contacto@proforma.cl')
                ->type('#direccion', 'Avda. Los Leones N° 668, Providencia, 13 ')
                ->type('#telefono_fijo', '223529800')
                ->type('#celular', '56997123123')
                ->clicK('@btn-crear')
                ->waitForReload()
                ->assertPathIs('/otic');
        });

        $this->assertDatabaseHas('otics', ['rut' => '74.252.300-4']);
    }
}
