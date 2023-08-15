<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\Browser\Pages\Administracion\Curso as CursoPage;
use Tests\Browser\Pages\Administracion\CursoPerfil as CursoPerfilPage;
use App\User;
use App\Curso;

class CursoTest extends DuskTestCase
{
    /**
     * Registro de curso con datos correctos
     *
     */
    public function testRegistrarCursoDatosCorrecto()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::find(1))
                ->maximize()
                ->visit(new CursoPage)
                ->clicK('@btn-formulario-crear')
                ->assertPathIs('/curso/create')
                ->type('#nombre_venta', 'Coordiación de acciones')
                ->type('#descripcion', 'Curso orientado a la organizaciones.')
                ->seleccionarTematica(1)
                ->type('#cant_horas_practicas', '4')
                ->type('#cant_horas_teoricas', '3.5')
                ->type('#anio_creacion', '2018')
                ->type('#cant_participantes', '20')
                ->scrollTo('#button-crear')
                ->clicK('@btn-crear')
                ->waitForReload()
                ->pause('500')
                ->assertPathIs('/curso/');
        });

        $this->assertDatabaseHas('cursos', ['nombre_venta' => 'Coordiación de acciones']);
    }

    /**
     * Registro de curso con datos incorrectos
     *
     */
    public function testRegistrarCursoDatosIncorrecto()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::find(1))
                ->maximize()
                ->visit(new CursoPage)
                ->clicK('@btn-formulario-crear')
                ->assertPathIs('/curso/create')
                ->type('#nombre_venta', 'Coordiación de acciones')
                ->type('#descripcion', 'Curso orientado a la organizaciones.')
                ->seleccionarTematica(1)
                ->type('#cant_horas_practicas', '?')
                ->type('#cant_horas_teoricas', '.5')
                ->type('#anio_creacion', '2.0.18')
                ->type('#cant_participantes', '-20')
                ->scrollTo('#button-crear')
                ->clicK('@btn-crear')
                ->pause('500')
                ->assertPathIs('/curso/create');
        });
    }

    /**
     * Registro de curso sin datos
     *
     */
    public function testRegistrarCursoSinDatos()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::find(1))
                ->maximize()
                ->visit(new CursoPage)
                ->clicK('@btn-formulario-crear')
                ->assertPathIs('/curso/create')
                ->clicK('@btn-crear')
                ->assertPathIs('/curso/create');
        });
    }

    /**
     * Registro de curso ya existente
     *
     */
    public function testRegistrarCursoExistente()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::find(1))
                ->maximize()
                ->visit(new CursoPage)
                ->clicK('@btn-formulario-crear')
                ->assertPathIs('/curso/create')
                ->type('#nombre_venta', 'Coordiación de acciones')
                ->type('#descripcion', 'Curso orientado a la organizaciones.')
                ->seleccionarTematica(1)
                ->type('#cant_horas_practicas', '4')
                ->type('#cant_horas_teoricas', '3.5')
                ->type('#anio_creacion', '2018')
                ->type('#cant_participantes', '20')
                ->type('#cant_horas_teoricas', '3.5')
                ->scrollTo('#button-crear')
                ->clicK('@btn-crear')
                ->pause('500')
                ->assertSee('El nombre venta ya ha sido registrado.')
                ->assertPathIs('/curso/create');
        });
    }

    /**
     * Modificación de curso con datos correctos
     * 
     */
    public function testModificarCursoConDatosCorrectos()
    {
        $curso = Curso::where('nombre_venta','Coordiación de acciones')->first();

        $this->browse(function ($browser) use ($curso) {
            $browser->loginAs(User::find(1))
                ->maximize()
                ->visit(new CursoPerfilPage($curso->id))
                ->click('@btn-formulario-editar')
                ->assertSee('Editar Curso')
                ->type('#nombre_venta', 'Coordiación de acciones 2019')
                ->type('#descripcion', 'Curso orientado a la organizaciones grandes.')
                ->type('#cant_horas_practicas', '5')
                ->type('#cant_horas_teoricas', '4.5')
                ->type('#anio_creacion', '2019')
                ->type('#cant_participantes', '15')
                ->scrollTo('#button-crear')
                ->clicK('@btn-editar')
                ->waitForReload()
                ->pause('500')
                ->assertPathIs('/curso/show/' . $curso->id);
        });

        $this->assertDatabaseHas('cursos', ['nombre_venta' => 'Coordiación de acciones 2019']);
    }

     /**
     * Modificación de curso con datos incorrectos
     * 
     */
    public function testModificarCursoConDatosIncorrectos()
    {
        $curso = Curso::where('nombre_venta','Coordiación de acciones 2019')->first();

        $this->browse(function ($browser) use ($curso) {
            $browser->loginAs(User::find(1))
                ->maximize()
                ->visit(new CursoPerfilPage($curso->id))
                ->click('@btn-formulario-editar')
                ->assertSee('Editar Curso')
                ->type('#nombre_venta', 'Coordiación de acciones 2019')
                ->type('#descripcion', 'Curso orientado a la organizaciones grandes.')
                ->type('#cant_horas_practicas', 'a')
                ->type('#cant_horas_teoricas', '4.5454')
                ->type('#anio_creacion', '-2019')
                ->type('#cant_participantes', '15.3')
                ->type('#cant_horas_teoricas', '0.5')
                ->scrollTo('#button-crear')
                ->clicK('@btn-editar')
                ->assertPathIs('/curso/edit/' . $curso->id);
        });
    }

    /**
     * Modificación de curso sin datos
     * 
     */
    public function testModificarCursoSinDatos()
    {
        $curso = Curso::where('nombre_venta','Coordiación de acciones 2019')->first();

        $this->browse(function ($browser) use ($curso) {
            $browser->loginAs(User::find(1))
                ->maximize()
                ->visit(new CursoPerfilPage($curso->id))
                ->click('@btn-formulario-editar')
                ->assertSee('Editar Curso')
                ->clear('#nombre_venta')
                ->clear('#descripcion')
                ->clear('#cant_horas_practicas')
                ->clear('#cant_horas_teoricas')
                ->clear('#anio_creacion')
                ->clear('#cant_participantes')
                ->clear('#cant_horas_teoricas')
                ->scrollTo('#button-crear')
                ->press('@btn-editar')
                ->assertPathIs('/curso/edit/' . $curso->id);
        });
    }

    /**
     * Despliegue de perfil curso
     * 
     */
    public function testDesplieguePerfilCurso()
    {
        $curso = Curso::where('nombre_venta','Coordiación de acciones 2019')->first();

        $this->browse(function ($browser) use ($curso) {
            $browser->loginAs(User::find(1))
                ->maximize()
                ->visit(new CursoPerfilPage($curso->id))
                ->assertSee($curso->nombre_venta)
                ->assertSee($curso->descripcion);
        });
    }
}
