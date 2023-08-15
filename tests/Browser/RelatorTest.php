<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\Browser\Pages\Administracion\Relator as RelatorPage;
use Tests\Browser\Pages\Administracion\RelatorPerfil as RelatorPerfilPage;
use App\User;
use App\Relator;
use App\ContactoOtic;

class RelatorTest extends DuskTestCase
{
   /**
     * Registro de Relator con datos correctos
     *
     */
    public function testRegistrarRelatorDatosCorrecto()
    {

        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::find(1))
                ->maximize()
                ->visit(new RelatorPage)
                ->clicK('@btn-formulario-crear')
                ->assertPathIs('/relator/create')
                ->type('#nombre', 'Camilo')
                ->type('#apellido', 'Muñoz Martin')
                ->type('#rut','20999187-k')
                ->type('#mail', 'm.m@gmail.com')
                ->seleccionarCiudad(233)
                ->type('#vigencia_sence', '13-10-2020')
                ->type('#celular', '56997123123')
                ->clicK('@btn-crear')
                ->waitForReload();
                //->assertPathIs('/relator/');
        });

        $this->assertDatabaseHas('relators', ['mail' => 'm.m@gmail.com']);
    }

    /**
     * Registro de relator con datos incorrectos 
     * 
     */
    public function testRegistrarRelatorDatosIncorrecto()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::find(1))
                ->maximize()
                ->visit(new RelatorPage)
                ->clicK('@btn-formulario-crear')
                ->assertPathIs('/relator/create')
                ->type('#nombre', 'Juna12')
                ->type('#apellido', '-3Uribe')
                ->type('#mail', 'm.m@gmail.com')
                ->seleccionarCiudad(233)
                ->type('#vigencia_sence', '13-10-2020')
                ->type('#celular', 'as-12313')
                ->clicK('@btn-crear')
                ->assertPathIs('/relator/create');
        });
    }

    /**
     * Registro de contacto relator sin datos.
     * 
     */
    public function testRegistrarRelatorSinDatos()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::find(1))
                ->maximize()
                ->visit(new RelatorPage)
                ->clicK('@btn-formulario-crear')
                ->assertPathIs('/relator/create')
                ->clicK('@btn-crear')
                ->assertPathIs('/relator/create');
        });
    }
    
    /**
     * Registro de contacto relator con datos faltantes.
     * 
     */
    public function testRegistrarRelatorDatosFaltantes()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::find(1))
                ->maximize()
                ->visit(new RelatorPage)
                ->clicK('@btn-formulario-crear')
                ->assertPathIs('/relator/create')
                ->type('#nombre', 'Karina')
                ->clicK('@btn-crear')
                ->assertPathIs('/relator/create');
        });
    }

    /**
     * Registro de contacto relator ya existente.
     * 
     */
    public function testRegistrarRelatorExistente()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::find(1))
                ->maximize()
                ->visit(new RelatorPage)
                ->clicK('@btn-formulario-crear')
                ->assertPathIs('/relator/create')
                ->type('#nombre', 'Camilo')
                ->type('#apellido', 'Muñoz Martin')
                ->type('#rut','20999187-k')
                ->type('#mail', 'm.m@gmail.com')
                ->seleccionarCiudad(233)
                ->type('#vigencia_sence', '13-10-2020')
                ->type('#celular', '56997123123')
                ->clicK('@btn-crear')
                ->assertPathIs('/relator/create');
        });
    }

    /**
     * Modificación de contacto relator con datos correctos
     * 
     */
    public function testModificarRelatorConDatosCorrectos()
    {
        $relator = Relator::where('mail', 'm.m@gmail.com')->first();

        $this->browse(function ($browser) use ($relator) {
            $browser->loginAs(User::find(1))
                ->maximize()
                ->visit(new RelatorPerfilPage($relator->id))
                ->click('@btn-formulario-editar')
                ->assertSee('Editar Relator')
                //->type('#mail', 'mario.casas@gmail.com')
                ->type('#celular', '56997134977')
                ->scrollTo('#button-crear')
                ->press('@btn-editar')
                ->waitForReload()
                ->assertPathIs('/relator/show/' . $relator->id)
                ->assertsee('Información Relator');
        });

        $this->assertDatabaseHas('relators', [
            'mail' => 'm.m@gmail.com'
        ]);
    }

    /**
     * Modificación de relator con datos incorrectos
     * 
     */
    public function testModificarRelatorConDatosIncorrectos()
    {
        $relator = Relator::where('mail', 'm.m@gmail.com')->first();

        $this->browse(function ($browser) use ($relator) {
            $browser->loginAs(User::find(1))
                ->maximize()
                ->visit(new RelatorPerfilPage($relator->id))
                ->click('@btn-formulario-editar')
                ->assertSee('Editar Relator')
                ->type('#nombre', 'Camilo17')
                ->type('#apellido', 'Muñoz123')
                ->scrollTo('#button-crear')
                ->press('@btn-editar')
                ->assertPathIs('/relator/edit/' . $relator->id);
        });
    }

    /**
     * Modificación de contacto relator sin datos
     * 
     */
    public function testModificarRelatorSinDatos()
    {
        $relator = Relator::where('mail', 'm.m@gmail.com')->first();

        $this->browse(function ($browser) use ($relator) {
            $browser->loginAs(User::find(1))
                ->maximize()
                ->visit(new RelatorPerfilPage($relator->id))
                ->click('@btn-formulario-editar')
                ->assertSee('Editar Relator')
                ->clear('#nombre')
                ->clear('#apellido')
                ->clear('#mail')
                ->clear('#celular')
                ->scrollTo('#button-crear')
                ->press('@btn-editar')
                ->assertPathIs('/relator/edit/' . $relator->id);
        });
    }
    
    /**
     * Despliegue de perfil contacto relator
     * 
     */
    public function testDesplieguePerfilRelator()
    {
        $relator = Relator::where('mail', 'm.m@gmail.com')->first();

        $this->browse(function ($browser) use ($relator) {
            $browser->loginAs(User::find(1))
                ->maximize()
                ->visit(new RelatorPerfilPage($relator->id))
                ->assertSee($relator->nombre)
                ->assertSee($relator->apellido)
                ->assertSee($relator->mail);
        });
    }

    /**
     * Eliminación  de contacto relator
     * 
     */
    public function testEliminarRelator()
    {
        $relator = Relator::where('mail', 'm.m@gmail.com')->first();

        $this->browse(function ($browser) use ($relator) {
            $browser->loginAs(User::find(1))
                ->maximize()
                ->visit(new RelatorPerfilPage($relator->id))
                ->click('@eliminar')
                ->acceptDialog()
                ->waitForReload();
                //->assertPathIs('/relator');
        });

        $this->assertSoftDeleted('relators', ['mail' => $relator->mail]);
    }


    /**
     * Reingreso de contacto relator con datos correctos
     * 
     */
    public function testReingresoRelatorEliminada()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::find(1))
                ->maximize()
                ->visit(new RelatorPage)
                ->clicK('@btn-formulario-crear')
                ->assertPathIs('/relator/create')
                ->type('#nombre', 'Camilo')
                ->type('#apellido', 'Muñoz Martin')
                ->type('#rut','20999187-k')
                ->type('#mail', 'm.m@gmail.com')
                ->seleccionarCiudad(233)
                ->type('#vigencia_sence', '13-10-2020')
                ->type('#celular', '56997123123')
                ->clicK('@btn-crear')
                ->waitForReload();
                //->assertPathIs('/relator/');
        });

        $this->assertDatabaseHas('relators', ['mail' => 'm.m@gmail.com']);
    }
}