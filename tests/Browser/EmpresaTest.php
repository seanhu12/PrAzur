<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Tests\Browser\Pages\Administracion\Empresa as EmpresaPage;
use Tests\Browser\Pages\Administracion\EmpresaPerfil as EmpresaPerfilPage;
use App\User;
use App\Empresa;

class EmpresaTest extends DuskTestCase
{
    /**
     * Registro de empresa con datos correctos
     *
     */
    public function testRegistrarEmpresaDatosCorrecto1()
    {

        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::find(1))
                ->maximize()
                ->visit(new EmpresaPage)
                ->clicK('@btn-formulario-crear')
                ->assertPathIs('/empresa/create')
                ->type('#nombre', 'Holding Komatsu Cummins')
                ->type('#rut', '76423423-5')
                ->type('#mail', 'contacto@holdingkomatsu.com')
                ->type('#direccion', 'Huerfanos 1270')
                ->seleccionarCiudad(233)
                ->click('@btn-crear')
                ->waitForReload()
                ->assertPathIs('/empresa/');
        });

        $this->assertDatabaseHas('empresas', ['rut' => '76.423.423-5']);
    }

    /**
     * Registro de empresa con datos correctos
     * Nombre: Komatsu Chile
     */
    public function testRegistrarEmpresaDatosCorrecto2()
    {

        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::find(1))
                ->maximize()
                ->visit(new EmpresaPage)
                ->clicK('@btn-formulario-crear')
                ->assertPathIs('/empresa/create')
                ->type('#nombre', 'Komatsu Chile')
                ->type('#rut', '76.423.424-3')
                ->type('#mail', 'contacto@komatsu.com')
                ->type('#direccion', 'Avenida Américo Vespucio 0631')
                ->seleccionarCiudad(233)
                ->seleccionarHolding(1)
                ->clicK('@btn-crear')
                ->waitForReload()
                ->assertPathIs('/empresa/');
        });

        $this->assertDatabaseHas('empresas', ['rut' => '76.423.424-3']);
    }

    /**
     * Registro de empresa con datos correctos
     * Nombre: Komatsu Reman Center
     */
    public function testRegistrarEmpresaDatosCorrecto3()
    {

        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::find(1))
                ->maximize()
                ->visit(new EmpresaPage)
                ->clicK('@btn-formulario-crear')
                ->assertPathIs('/empresa/create')
                ->type('#nombre', 'Komatsu Reman Center')
                ->type('#rut', '76423425-1')
                ->type('#mail', 'contacto@Komatsuremancenter.com')
                ->type('#direccion', 'Villarrica 351')
                ->seleccionarCiudad(233)
                ->seleccionarHolding(1)
                ->clicK('@btn-crear')
                ->waitForReload()
                ->assertPathIs('/empresa/');
        });

        $this->assertDatabaseHas('empresas', ['rut' => '76.423.425-1']);
    }

    /**
     * Registro de empresa con datos incorrectos 
     * "Nombre: Komatsu Chile
     */
    public function testRegistrarEmpresaDatosIncorrecto()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::find(1))
                ->maximize()
                ->visit(new EmpresaPage)
                ->clicK('@btn-formulario-crear')
                ->assertPathIs('/empresa/create')
                ->type('#nombre', 'Komatsu Chile')
                ->type('#rut', 'a.-6.423.424-3')
                ->type('#mail', 'contactokomatsu.com')
                ->type('#direccion', 'Avenida Américo Vespucio 0631')
                ->clicK('@btn-crear')
                ->assertPathIs('/empresa/create');
        });
    }


    /**
     * Registro de empresa sin datos.
     * 
     */
    public function testRegistrarEmpresaSinDatos()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::find(1))
                ->maximize()
                ->visit(new EmpresaPage)
                ->clicK('@btn-formulario-crear')
                ->assertPathIs('/empresa/create')
                ->clicK('@btn-crear')
                ->assertPathIs('/empresa/create');
        });
    }

    /**
     * Registro de empresa con datos faltantes.
     * 
     */
    public function testRegistrarEmpresaDatosFaltantes()
    {

        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::find(1))
                ->maximize()
                ->visit(new EmpresaPage)
                ->clicK('@btn-formulario-crear')
                ->assertPathIs('/empresa/create')
                ->type('#nombre', 'Codelco')
                ->seleccionarCiudad(233)
                ->clicK('@btn-crear')
                ->assertPathIs('/empresa/create');
        });
    }

    /**
     * Registro de Empresa ya existente.
     * 
     */
    public function testRegistrarEmpresaExistente()
    {

        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::find(1))
                ->maximize()
                ->visit(new EmpresaPage)
                ->clicK('@btn-formulario-crear')
                ->assertPathIs('/empresa/create')
                ->assertSee('Crear Empresa')
                ->type('#nombre', 'Holding Komatsu Cummins')
                ->type('#rut', '76423423-5')
                ->type('#mail', 'contacto@holdingkomatsu.com')
                ->type('#direccion', 'Huerfanos 1270')
                ->seleccionarCiudad(233)
                ->clicK('@btn-crear')
                ->assertSee('El rut ya ha sido registrado')
                ->assertPathIs('/empresa/create');
        });
    }

    /**
     * Modificación de empresa con datos correctos
     * 
     */
    public function testModificarEmpresaConDatosCorrectos()
    {
        $empresa = Empresa::where('rut', '76.423.425-1')->first();

        $this->browse(function ($browser) use ($empresa) {
            $browser->loginAs(User::find(1))
                ->maximize()
                ->visit(new EmpresaPerfilPage($empresa->id))
                ->click('@btn-formulario-editar')
                ->assertSee('Editar Empresa')
                ->type('#mail', 'contactanos@Komatsuremancenter.com')
                ->type('#direccion', 'Villarrica 1233')
                ->scrollTo('#button-crear')
                ->press('@btn-editar')
                ->waitForReload()
                ->assertPathIs('/empresa/show/' . $empresa->id)
                ->assertsee('Información Empresa');
        });

        $this->assertDatabaseHas('empresas', [
            'rut' => '76.423.425-1',
            'direccion' => 'Villarrica 1233',
            'mail' => 'contactanos@Komatsuremancenter.com'
        ]);
    }

    /**
     * Modificación de empresa con datos incorrectos
     * 
     */
    public function testModificarEmpresaConDatosIncorrectos()
    {
        $empresa = Empresa::where('rut', '76.423.425-1')->first();

        $this->browse(function ($browser) use ($empresa) {
            $browser->loginAs(User::find(1))
                ->maximize()
                ->visit(new EmpresaPerfilPage($empresa->id))
                ->click('@btn-formulario-editar')
                ->assertSee('Editar Empresa')
                ->type('#mail', 'Komatsuremancenter.com')
                ->scrollTo('#button-crear')
                ->press('@btn-editar')
                ->assertPathIs('/empresa/edit/' . $empresa->id);
        });
    }


    /**
     * Modificación de empresa sin datos
     * 
     */
    public function testModificarEmpresaSinDatos()
    {
        $empresa = Empresa::where('rut', '76.423.423-5')->first();

        $this->browse(function ($browser) use ($empresa) {
            $browser->loginAs(User::find(1))
                ->maximize()
                ->visit(new EmpresaPerfilPage($empresa->id))
                ->click('@btn-formulario-editar')
                ->assertSee('Editar Empresa')
                ->clear('#nombre')
                ->clear('#mail')
                ->clear('#direccion')
                ->scrollTo('#button-crear')
                ->press('@btn-editar')
                ->assertPathIs('/empresa/edit/' . $empresa->id);
        });
    }


    /**
     * Eliminación  de empresa
     * 
     */
    public function testEliminarEmpresa()
    {
        $empresa = Empresa::where('rut', '76.423.425-1')->first();

        $this->browse(function ($browser) use ($empresa) {
            $browser->loginAs(User::find(1))
                ->maximize()
                ->visit(new EmpresaPerfilPage($empresa->id))
                ->click('@eliminar')
                ->acceptDialog()
                ->waitForReload()
                ->assertPathIs('/empresa');
        });

        $this->assertSoftDeleted('empresas', ['rut' => $empresa->rut]);
    }
    /**
     * Despliegue de perfil empresa
     * 
     */
    public function testDesplieguePerfilEmpresa()
    {
        $empresa = Empresa::where('rut','76.423.423-5')->first();

        $this->browse(function ($browser) use ($empresa) {
            $browser->loginAs(User::find(1))
                ->maximize()
                ->visit(new EmpresaPerfilPage($empresa->id))
                ->assertSee($empresa->rut)
                ->assertSee($empresa->nombre)
                ->assertSee($empresa->mail);
        });
    }


    /**
     * Registro de empresa con datos correctos
     * Nombre: Komatsu Reman Center
     */
    public function testReingresoEmpresaEliminada()
    {

        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::find(1))
                ->maximize()
                ->visit(new EmpresaPage)
                ->clicK('@btn-formulario-crear')
                ->assertPathIs('/empresa/create')
                ->type('#nombre', 'Komatsu Reman Center')
                ->type('#rut', '76492400-2')
                ->type('#mail', 'contacto@Komatsuremancenter.com')
                ->type('#direccion', 'Villarrica 351')
                ->seleccionarCiudad(233)
                ->seleccionarHolding(1)
                ->clicK('@btn-crear')
                ->waitForReload()
                ->assertPathIs('/empresa/');
        });

        $this->assertDatabaseHas('empresas', ['rut' => '76.423.425-1']);
    }

}
