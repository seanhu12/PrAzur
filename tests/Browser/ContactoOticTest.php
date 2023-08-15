<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\Browser\Pages\Administracion\ContactoOtic as ContactoOticPage;
use Tests\Browser\Pages\Administracion\ContactoOticPerfil as ContactoOticPerfilPage;
use App\User;
use App\Otic;
use App\ContactoOtic;

class ContactoOticTest extends DuskTestCase
{
    /**
     * Registro de OTIC con datos correctos
     *
     */
    public function testRegistrarContactoOticDatosCorrecto()
    {

        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::find(1))
                ->maximize()
                ->visit(new ContactoOticPage)
                ->clicK('@btn-formulario-crear')
                ->assertPathIs('/contacto_otic/create')
                ->type('#nombre', 'Mario')
                ->type('#apellido', 'Casas Uribe')
                ->type('#mail', 'm.casas@gmail.com')
                ->seleccionarOtic(1)
                ->type('#area', 'Finanzas')
                ->type('#direccion', 'Calle Menéndez, 2, 7º 2º, 60986, O Linares del Puerto')
                ->type('#telefono_fijo', '223529800')
                ->type('#celular', '56997123123')
                ->clicK('@btn-crear')
                ->waitForReload()
                ->assertPathIs('/contacto_otic/');
        });

        $this->assertDatabaseHas('contacto_otics', ['mail' => 'm.casas@gmail.com']);
    }

    /**
     * Registro de otic con datos incorrectos 
     * 
     */
    public function testRegistrarContactoOticDatosIncorrecto()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::find(1))
                ->maximize()
                ->visit(new ContactoOticPage)
                ->clicK('@btn-formulario-crear')
                ->assertPathIs('/contacto_otic/create')
                ->type('#nombre', 'Juna12')
                ->type('#apellido', '-3Uribe')
                ->type('#mail', 'm.casas@gmail.com')
                ->seleccionarOtic(1)
                ->type('#area', 'Finanzas')
                ->type('#direccion', 'Calle Menéndez, 2, 7º 2º, 60986, O Linares del Puerto')
                ->type('#telefono_fijo', '04223529800')
                ->type('#celular', 'as-12313')
                ->clicK('@btn-crear')
                ->assertPathIs('/contacto_otic/create');
        });
    }

    /**
     * Registro de contacto otic sin datos.
     * 
     */
    public function testRegistrarContactoOticSinDatos()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::find(1))
                ->maximize()
                ->visit(new ContactoOticPage)
                ->clicK('@btn-formulario-crear')
                ->assertPathIs('/contacto_otic/create')
                ->clicK('@btn-crear')
                ->assertPathIs('/contacto_otic/create');
        });
    }

    /**
     * Registro de contacto otic con datos faltantes.
     * 
     */
    public function testRegistrarContactoOticDatosFaltantes()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::find(1))
                ->maximize()
                ->visit(new ContactoOticPage)
                ->clicK('@btn-formulario-crear')
                ->assertPathIs('/contacto_otic/create')
                ->type('#nombre', 'Karina')
                ->clicK('@btn-crear')
                ->assertPathIs('/contacto_otic/create');
        });
    }

    /**
     * Registro de contacto otic ya existente.
     * 
     */
    public function testRegistrarContactoOticExistente()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::find(1))
                ->maximize()
                ->visit(new ContactoOticPage)
                ->clicK('@btn-formulario-crear')
                ->assertPathIs('/contacto_otic/create')
                ->type('#nombre', 'Mario')
                ->type('#apellido', 'Casas Uribe')
                ->type('#mail', 'm.casas@gmail.com')
                ->seleccionarOtic(1)
                ->type('#area', 'Finanzas')
                ->type('#direccion', 'Calle Menéndez, 2, 7º 2º, 60986, O Linares del Puerto')
                ->type('#telefono_fijo', '223529800')
                ->type('#celular', '56997123123')
                ->clicK('@btn-crear')
                ->assertPathIs('/contacto_otic/create');
        });
    }

    /**
     * Modificación de contacto otic con datos correctos
     * 
     */
    public function testModificarContactoOticConDatosCorrectos()
    {
        $contactoOtic = ContactoOtic::where('mail', 'm.casas@gmail.com')->first();

        $this->browse(function ($browser) use ($contactoOtic) {
            $browser->loginAs(User::find(1))
                ->maximize()
                ->visit(new ContactoOticPerfilPage($contactoOtic->id))
                ->click('@btn-formulario-editar')
                ->assertSee('Editar Contacto de OTIC')
                ->type('#mail', 'mario.casas@gmail.com')
                ->type('#celular', '56997134977')
                ->scrollTo('#button-crear')
                ->press('@btn-editar')
                ->waitForReload()
                ->assertPathIs('/contacto_otic/show/' . $contactoOtic->id)
                ->assertsee('Información del Contacto de OTIC');
        });

        $this->assertDatabaseHas('contacto_otics', [
            'mail' => 'mario.casas@gmail.com'
        ]);
    }

    /**
     * Modificación de otic con datos incorrectos
     * 
     */
    public function testModificarContactoOticConDatosIncorrectos()
    {
        $contactoOtic = ContactoOtic::where('mail', 'mario.casas@gmail.com')->first();

        $this->browse(function ($browser) use ($contactoOtic) {
            $browser->loginAs(User::find(1))
                ->maximize()
                ->visit(new ContactoOticPerfilPage($contactoOtic->id))
                ->click('@btn-formulario-editar')
                ->assertSee('Editar Contacto de OTIC')
                ->type('#nombre', 'Mario17')
                ->type('#apellido', 'Muñoz123')
                ->scrollTo('#button-crear')
                ->press('@btn-editar')
                ->assertPathIs('/contacto_otic/edit/' . $contactoOtic->id);
        });
    }

    /**
     * Modificación de contacto otic sin datos
     * 
     */
    public function testModificarContactoOticSinDatos()
    {
        $contactoOtic = ContactoOtic::where('mail', 'mario.casas@gmail.com')->first();

        $this->browse(function ($browser) use ($contactoOtic) {
            $browser->loginAs(User::find(1))
                ->maximize()
                ->visit(new ContactoOticPerfilPage($contactoOtic->id))
                ->click('@btn-formulario-editar')
                ->assertSee('Editar Contacto de OTIC')
                ->clear('#nombre')
                ->clear('#apellido')
                ->clear('#mail')
                ->clear('#area')
                ->clear('#direccion')
                ->clear('#telefono_fijo')
                ->clear('#celular')
                ->scrollTo('#button-crear')
                ->press('@btn-editar')
                ->assertPathIs('/contacto_otic/edit/' . $contactoOtic->id);
        });
    }
    
    /**
     * Despliegue de perfil contacto otic
     * 
     */
    public function testDesplieguePerfilContactoOtic()
    {
        $contactoOtic = ContactoOtic::where('mail', 'mario.casas@gmail.com')->first();

        $this->browse(function ($browser) use ($contactoOtic) {
            $browser->loginAs(User::find(1))
                ->maximize()
                ->visit(new ContactoOticPerfilPage($contactoOtic->id))
                ->assertSee($contactoOtic->nombre)
                ->assertSee($contactoOtic->apellido)
                ->assertSee($contactoOtic->mail);
        });
    }

    /**
     * Eliminación  de contacto otic
     * 
     */
    public function testEliminarContactoOtic()
    {
        $contactoOtic = ContactoOtic::where('mail', 'mario.casas@gmail.com')->first();

        $this->browse(function ($browser) use ($contactoOtic) {
            $browser->loginAs(User::find(1))
                ->maximize()
                ->visit(new ContactoOticPerfilPage($contactoOtic->id))
                ->click('@eliminar')
                ->acceptDialog()
                ->waitForReload()
                ->assertPathIs('/contacto_otic');
        });

        $this->assertSoftDeleted('contacto_otics', ['mail' => $contactoOtic->mail]);
    }


    /**
     * Reingreso de contacto otic con datos correctos
     * 
     */
    public function testReingresoContactoOticEliminada()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::find(1))
                ->maximize()
                ->visit(new ContactoOticPage)
                ->clicK('@btn-formulario-crear')
                ->assertPathIs('/contacto_otic/create')
                ->type('#nombre', 'Mario')
                ->type('#apellido', 'Casas Uribe')
                ->type('#mail', 'mario.casas@gmail.com')
                ->seleccionarOtic(1)
                ->type('#area', 'Finanzas')
                ->type('#direccion', 'Calle Menéndez, 2, 7º 2º, 60986, O Linares del Puerto')
                ->type('#telefono_fijo', '223529800')
                ->type('#celular', '56997123123')
                ->clicK('@btn-crear')
                ->waitForReload()
                ->assertPathIs('/contacto_otic/');
        });

        $this->assertDatabaseHas('contacto_otics', ['mail' => 'mario.casas@gmail.com']);
    }
}
