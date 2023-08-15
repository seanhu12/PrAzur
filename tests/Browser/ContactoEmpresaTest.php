<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\Browser\Pages\Administracion\ContactoEmpresa as ContactoEmpresaPage;
use Tests\Browser\Pages\Administracion\ContactoEmpresaPerfil as ContactoEmpresaPerfilPage;
use App\User;
use App\Empresa;
use App\ContactoEmpresa;

class ContactoEmpresaTest extends DuskTestCase
{
     /**
     * Registro de Empresa con datos correctos
     *
     */
    public function testRegistrarContactoEmpresaDatosCorrecto()
    {

        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::find(1))
                ->maximize()
                ->visit(new ContactoEmpresaPage)
                ->clicK('@btn-formulario-crear')
                ->assertPathIs('/contacto_empresa/create')
                ->type('#nombre', 'Marco')
                ->type('#apellido', 'Casas Uribe')
                ->type('#mail', 'm.casas@gmail.com')
                ->seleccionarEmpresa(1)
                ->type('#area', 'Finanzas')
                ->type('#cargo', 'SubGerente')
                ->type('#direccion', 'Calle Menéndez, 2, 7º 2º, 60986, O Linares del Puerto')
                ->type('#telefono_fijo', '223529800')
                ->type('#celular', '56997123123')
                ->clicK('@btn-crear')
                ->waitForReload()
                ->pause(400)
                ->assertPathIs('/contacto_empresa/');
        });

        $this->assertDatabaseHas('contacto_empresas', ['mail' => 'm.casas@gmail.com']);
    }

    /**
     * Registro de empresa con datos incorrectos 
     * 
     */
    public function testRegistrarContactoEmpresaDatosIncorrecto()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::find(1))
                ->maximize()
                ->visit(new ContactoEmpresaPage)
                ->clicK('@btn-formulario-crear')
                ->assertPathIs('/contacto_empresa/create')
                ->type('#nombre', 'Juna12')
                ->type('#apellido', '-3Uribe')
                ->type('#mail', 'm.casas@gmail.com')
                ->seleccionarEmpresa(1)
                ->type('#area', 'Finanzas')
                ->type('#cargo', 'SubGerente')
                ->type('#direccion', 'Calle Menéndez, 2, 7º 2º, 60986, O Linares del Puerto')
                ->type('#telefono_fijo', '04223529800')
                ->type('#celular', 'as-12313')
                ->clicK('@btn-crear')
                ->assertPathIs('/contacto_empresa/create');
        });
    }

    /**
     * Registro de contacto empresa sin datos.
     * 
     */
    public function testRegistrarContactoEmpresaSinDatos()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::find(1))
                ->maximize()
                ->visit(new ContactoEmpresaPage)
                ->clicK('@btn-formulario-crear')
                ->assertPathIs('/contacto_empresa/create')
                ->clicK('@btn-crear')
                ->assertPathIs('/contacto_empresa/create');
        });
    }

    /**
     * Registro de contacto empresa con datos faltantes.
     * 
     */
    public function testRegistrarContactoEmpresaDatosFaltantes()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::find(1))
                ->maximize()
                ->visit(new ContactoEmpresaPage)
                ->clicK('@btn-formulario-crear')
                ->assertPathIs('/contacto_empresa/create')
                ->type('#nombre', 'Claudio')
                ->clicK('@btn-crear')
                ->assertPathIs('/contacto_empresa/create');
        });
    }

    /**
     * Registro de contacto empresa ya existente.
     * 
     */
    public function testRegistrarContactoEmpresaExistente()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::find(1))
                ->maximize()
                ->visit(new ContactoEmpresaPage)
                ->clicK('@btn-formulario-crear')
                ->assertPathIs('/contacto_empresa/create')
                ->type('#nombre', 'Marco')
                ->type('#apellido', 'Casas Uribe')
                ->type('#mail', 'm.casas@gmail.com')
                ->seleccionarEmpresa(1)
                ->type('#area', 'Finanzas')
                ->type('#cargo', 'SubGerente')
                ->type('#direccion', 'Calle Menéndez, 2, 7º 2º, 60986, O Linares del Puerto')
                ->type('#telefono_fijo', '223529800')
                ->type('#celular', '56997123123')
                ->clicK('@btn-crear')
                ->pause('500')
                ->assertPathIs('/contacto_empresa/');
        });
    }

    /**
     * Modificación de contacto empresa con datos correctos
     * 
     */
    public function testModificarContactoEmpresaConDatosCorrectos()
    {
        $contactoEmpresa = ContactoEmpresa::where('mail', 'm.casas@gmail.com')->first();

        $this->browse(function ($browser) use ($contactoEmpresa) {
            $browser->loginAs(User::find(1))
                ->maximize()
                ->visit(new ContactoEmpresaPerfilPage($contactoEmpresa->id))
                ->click('@btn-formulario-editar')
                ->assertSee('Editar Contacto de Empresa')
                ->type('#mail', 'mario.casas@gmail.com')
                ->type('#celular', '56997134977')
                ->scrollTo('#button-crear')
                ->press('@btn-editar')
                //->pause(6000)
                ->waitForReload()
                ->pause(600)
                ->assertPathIs('/contacto_empresa/show/' . $contactoEmpresa->id)
                ->assertsee('Información del Contacto de Empresa');
        });

        $this->assertDatabaseHas('contacto_empresas', [
            'mail' => 'mario.casas@gmail.com'
        ]);
    }

    /**
     * Modificación de empresa con datos incorrectos
     * 
     */
    public function testModificarContactoEmpresaConDatosIncorrectos()
    {
        $contactoEmpresa = ContactoEmpresa::where('mail', 'mario.casas@gmail.com')->first();

        $this->browse(function ($browser) use ($contactoEmpresa) {
            $browser->loginAs(User::find(1))
                ->maximize()
                ->visit(new ContactoEmpresaPerfilPage($contactoEmpresa->id))
                ->click('@btn-formulario-editar')
                ->assertSee('Editar Contacto de Empresa')
                ->type('#nombre', 'Mario17')
                ->type('#apellido', 'Muñoz123')
                ->scrollTo('#button-crear')
                ->press('@btn-editar')
                ->assertPathIs('/contacto_empresa/edit/' . $contactoEmpresa->id);
        });
    }

    /**
     * Modificación de contacto empresa sin datos
     * 
     */
    public function testModificarContactoEmpresaSinDatos()
    {
        $contactoEmpresa = ContactoEmpresa::where('mail', 'mario.casas@gmail.com')->first();

        $this->browse(function ($browser) use ($contactoEmpresa) {
            $browser->loginAs(User::find(1))
                ->maximize()
                ->visit(new ContactoEmpresaPerfilPage($contactoEmpresa->id))
                ->click('@btn-formulario-editar')
                ->assertSee('Editar Contacto de Empresa')
                ->clear('#nombre')
                ->clear('#apellido')
                ->clear('#mail')
                ->clear('#area')
                ->clear('#direccion')
                ->clear('#telefono_fijo')
                ->clear('#celular')
                ->scrollTo('#button-crear')
                ->press('@btn-editar')
                ->assertPathIs('/contacto_empresa/edit/' . $contactoEmpresa->id);
        });
    }
    
    /**
     * Despliegue de perfil contacto empresa
     * 
     */
    public function testDesplieguePerfilContactoEmpresa()
    {
        $contactoEmpresa = ContactoEmpresa::where('mail', 'mario.casas@gmail.com')->first();

        $this->browse(function ($browser) use ($contactoEmpresa) {
            $browser->loginAs(User::find(1))
                ->maximize()
                ->visit(new ContactoEmpresaPerfilPage($contactoEmpresa->id))
                ->assertSee($contactoEmpresa->nombre)
                ->assertSee($contactoEmpresa->apellido)
                ->assertSee($contactoEmpresa->mail);
        });
    }

    /**
     * Eliminación  de contacto empresa
     * 
     */
    public function testEliminarContactoEmpresa()
    {
        $contactoEmpresa = ContactoEmpresa::where('mail', 'mario.casas@gmail.com')->first();

        $this->browse(function ($browser) use ($contactoEmpresa) {
            $browser->loginAs(User::find(1))
                ->maximize()
                ->visit(new ContactoEmpresaPerfilPage($contactoEmpresa->id))
                ->click('@eliminar')
                ->acceptDialog()
                ->waitForReload()
                ->pause(400)
                ->assertPathIs('/contacto_empresa');
        });

        $this->assertSoftDeleted('contacto_empresas', ['mail' => $contactoEmpresa->mail]);
    }


    /**
     * Reingreso de contacto empresa con datos correctos
     * 
     */
    public function testReingresoContactoEmpresaEliminada()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::find(1))
                ->maximize()
                ->visit(new ContactoEmpresaPage)
                ->clicK('@btn-formulario-crear')
                ->assertPathIs('/contacto_empresa/create')
                ->type('#nombre', 'Marco')
                ->type('#apellido', 'Casas Uribe')
                ->type('#mail', 'mario.casas@gmail.com')
                ->seleccionarEmpresa(1)
                ->type('#area', 'Finanzas')
                ->type('#cargo', 'SubGerente')
                ->type('#direccion', 'Calle Menéndez, 2, 7º 2º, 60986, O Linares del Puerto')
                ->type('#telefono_fijo', '223529800')
                ->type('#celular', '56997123123')
                ->clicK('@btn-crear')
                ->waitForReload()
                ->pause(400)
                ->assertPathIs('/contacto_empresa/');
        });

        $this->assertDatabaseHas('contacto_empresas', ['mail' => 'mario.casas@gmail.com']);
    }
}

