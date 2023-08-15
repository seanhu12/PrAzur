<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\Browser\Pages\Administracion\Usuario as Usuario;
use Tests\Browser\Pages\Administracion\UsuarioPerfil as UsuarioPerfil;
use App\User;

class UsuarioTest extends DuskTestCase
{
    /**
     * Registro de usuario con datos correctos
     *
     */
    public function testRegistrarUsuarioDatosCorrecto()
    {

        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::find(1))
                ->maximize()
                ->visit(new Usuario)
                ->clicK('@btn-formulario-crear')
                ->assertPathIs('/usuario/create')
                ->type('#nombre', 'María')
                ->type('#apellido', 'Pérez López')
                ->type('#rut', '80645139')
                ->seleccionarRolesUsuario(6)
                ->seleccionarRolesUsuario(4)
                ->type('#mail', 'm.perez@gmail.com')
                ->type('#password', 'Abc123456')
                ->type('#confirmar_password', 'Abc123456')
                ->clicK('@btn-crear')
                ->waitForReload()
                ->assertPathIs('/usuario');
        });

        $this->assertDatabaseHas('users', ['mail' => 'm.perez@gmail.com']);
    }

    /**
     * Registro de usuario con datos incorrectos 
     * 
     */
    public function testRegistrarUsuarioDatosIncorrecto()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::find(1))
                ->maximize()
                ->visit(new Usuario)
                ->clicK('@btn-formulario-crear')
                ->assertPathIs('/usuario/create')
                ->assertSee('Crear Usuario')
                ->type('#nombre', 'María23')
                ->type('#apellido', 'Per3z L0pez')
                ->type('#rut', '12324')
                ->type('#mail', 'm.perez.gmail.com')
                ->type('#password', 'abc123456')
                ->type('#confirmar_password', 'bc123456')
                ->clicK('@btn-crear')
                ->assertPathIs('/usuario/create');
        });
    }

    /**
     * Registro de usuario sin datos.
     * 
     */
    public function testRegistrarUsuarioSinDatos()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::find(1))
                ->maximize()
                ->visit(new Usuario)
                ->clicK('@btn-formulario-crear')
                ->assertPathIs('/usuario/create')
                ->clicK('@btn-crear')
                ->assertPathIs('/usuario/create');
        });
    }

    /**
     * Registro de usuario con datos faltantes.
     * 
     */
    public function testRegistrarUsuarioDatosFaltantes()
    {

        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::find(1))
                ->maximize()
                ->visit(new Usuario)
                ->clicK('@btn-formulario-crear')
                ->assertPathIs('/usuario/create')
                ->type('#rut', '80645139')
                ->type('#password', 'Abc123456')
                ->type('#confirmar_password', 'Abc123456')
                ->clicK('@btn-crear')
                ->assertPathIs('/usuario/create');
        });
    }

    /**
     * Registro de usuario ya existente.
     * 
     */
    public function testRegistrarUsuarioExistente()
    {

        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::find(1))
                ->maximize()
                ->visit(new Usuario)
                ->clicK('@btn-formulario-crear')
                ->assertPathIs('/usuario/create')
                ->assertSee('Crear Usuario')
                ->type('#nombre', 'Juan')
                ->type('#apellido', 'Pérez López')
                ->type('#rut', '80645139')
                ->seleccionarRolesUsuario(6)
                ->seleccionarRolesUsuario(4)
                ->type('#mail', 'm.perez@gmail.com')
                ->type('#password', 'Abc123456')
                ->type('#confirmar_password', 'Abc123456')
                ->clicK('@btn-crear')
                ->pause('400')
                ->assertSee('El mail ya ha sido registrado')
                ->assertSee('El rut ya ha sido registrado')
                ->assertPathIs('/usuario/create');
        });
    }

    /**
     * Modificación de usuario con datos correctos
     * 
     */
    public function testModificarUsuarioConDatosCorrectos()
    {
        $user = User::where('rut', '8.064.513-9')->first();

        $this->browse(function ($browser) use ($user) {
            $browser->loginAs(User::find(1))
                ->maximize()
                ->visit(new UsuarioPerfil($user->id))
                ->click('@btn-formulario-editar')
                ->assertSee('Editar Usuario')
                ->type('#nombre', 'Carla')
                ->type('#apellido', 'Muñoz')
                ->type('#mail', 'c.munoz@gmail.com')
                ->scrollTo('#button-editar')
                ->press('@btn-editar')
                ->waitForReload()
                ->assertPathIs('/usuario/show/' . $user->id)
                ->assertsee('Información Usuario');
        });

        $this->assertDatabaseHas('users', ['mail' => 'c.munoz@gmail.com']);
    }


    /**
     * Modificación de usuario con datos incorrectos
     * Se modifica los datos del usuario con Rut: 80645139 
     * Apellidos: Muñoz123
     */
    public function testModificarUsuarioConDatosIncorrectos()
    {
        $user = User::where('rut', '8.064.513-9')->first();

        $this->browse(function ($browser) use ($user) {
            $browser->loginAs(User::find(1))
                ->maximize()
                ->visit(new UsuarioPerfil($user->id))
                ->click('@btn-formulario-editar')
                ->assertSee('Editar Usuario')
                ->type('#apellido', 'Muñoz123')
                ->scrollTo('#button-editar')
                ->press('@btn-editar')
                ->assertPathIs('/usuario/edit/' . $user->id);
        });
    }


    /**
     * Modificación de usuario sin datos
     * 
     */
    public function testModificarUsuarioSinDatos()
    {
        $user = User::where('rut', '8.064.513-9')->first();

        $this->browse(function ($browser) use ($user) {
            $browser->loginAs(User::find(1))
                ->maximize()
                ->visit(new UsuarioPerfil($user->id))
                ->click('@btn-formulario-editar')
                ->assertSee('Editar Usuario')
                ->clear('#nombre')
                ->clear('#apellido')
                ->clear('#mail')
                ->scrollTo('#button-editar')
                ->press('@btn-editar')
                ->assertPathIs('/usuario/edit/' . $user->id);
        });
    }

    /**
     * Modificación de usuario con datos faltantes
     * Se modifica los datos del usuario con Rut: 80645139 
     * Apellidos: Muñoz Rut: 80645139  Correo Electrónico: c.munoz@gmail.com
     *  
     */
    public function testModificarUsuarioConDatosFaltantes()
    {
        $user = User::where('rut', '8.064.513-9')->first();

        $this->browse(function ($browser) use ($user) {
            $browser->loginAs(User::find(1))
                ->maximize()
                ->visit(new UsuarioPerfil($user->id))
                ->click('@btn-formulario-editar')
                ->assertSee('Editar Usuario')
                ->clear('#nombre')
                ->scrollTo('#button-editar')
                ->press('@btn-editar')
                ->assertPathIs('/usuario/edit/' . $user->id);
        });
    }


    /**
     * Despliegue de perfil usuario
     * 
     */
    public function testDesplieguePerfilUsuario()
    {
        $user = User::where('rut', '8.064.513-9')->first();

        $this->browse(function ($browser) use ($user) {
            $browser->loginAs(User::find(1))
                ->maximize()
                ->visit(new UsuarioPerfil($user->id))
                ->assertSee($user->rut)
                ->assertSee($user->nombre)
                ->assertSee($user->apellido)
                ->assertSee($user->mail);
        });
    }


    /**
     * Eliminación  de usuario
     * 
     */
    public function testEliminarUsuario()
    {
        $user = User::where('rut', '8.064.513-9')->first();

        $this->browse(function ($browser) use ($user) {
            $browser->loginAs(User::find(1))
                ->maximize()
                ->visit(new UsuarioPerfil($user->id))
                ->click('@eliminar')
                ->acceptDialog()
                ->waitForReload()
                ->assertPathIs('/usuario');
        });

        $this->assertSoftDeleted('users', ['rut' => $user->rut]);
    }

    /**
     * Reingreso de usuario con datos correctos
     * 
     */
    public function testReingresoUsuarioEliminado()
    {

        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::find(1))
                ->maximize()
                ->visit(new Usuario)
                ->clicK('@btn-formulario-crear')
                ->assertPathIs('/usuario/create')
                ->type('#nombre', 'María')
                ->type('#apellido', 'Pérez López')
                ->type('#rut', '80645139')           
                ->seleccionarRolesUsuario(6)
                ->seleccionarRolesUsuario(4)
                ->type('#mail', 'm.perez@gmail.com')
                ->type('#password', 'Abc123456')
                ->type('#confirmar_password', 'Abc123456')
                ->clicK('@btn-crear')
                ->waitForReload()
                ->assertPathIs('/usuario');
        });

        $this->assertDatabaseHas('users', ['mail' => 'm.perez@gmail.com']);
    }
}
