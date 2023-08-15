<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\Browser\Pages\Administracion\Programa as ProgramaPage;
use Tests\Browser\Pages\Administracion\ProgramaPerfil as ProgramaPerfilPage;
use App\User;
use App\Programa;

class ProgramaTest extends DuskTestCase
{
    /**
     * Registro de programa con datos correctos
     *
     */
    public function testRegistrarProgramaDatosCorrecto()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::find(1))
                ->maximize()
                ->visit(new ProgramaPage)
                ->clicK('@btn-formulario-crear')
                ->assertPathIs('/programa/create')
                ->seleccionarCurso(1)
                ->seleccionarCurso(3)
                ->type('#nombre', 'Programa de Entrenamiento en Competencias de Jefatura Efectiva')
                ->scrollTo('#button-crear')
                ->clicK('@btn-crear')
                ->waitForReload()
                ->pause('500')
                ->assertPathIs('/programa');
        });
        $this->assertDatabaseHas('programas', ['nombre' => 'Programa de Entrenamiento en Competencias de Jefatura Efectiva']);
    }

    public function testRegistrarProgramaDatosIncorrecto()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::find(1))
                ->maximize()
                ->visit(new ProgramaPage)
                ->clicK('@btn-formulario-crear')
                ->assertPathIs('/programa/create')
                ->seleccionarCurso(1)
                ->type('#nombre', 'Programa de Entrenamiento en Competencias de Autocuidado.')
                ->scrollTo('#button-crear')
                ->clicK('@btn-crear')
                ->pause('500')
                ->assertPathIs('/programa/create');
        });
        $this->assertDatabaseHas('programas', ['nombre' => 'Programa de Entrenamiento en Competencias de Jefatura Efectiva']);
    }

    /**
     * Registro de programa sin datos
     *
     */
    public function testRegistrarProgramaSinDatos()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::find(1))
                ->maximize()
                ->visit(new ProgramaPage)
                ->clicK('@btn-formulario-crear')
                ->assertPathIs('/programa/create')
                ->scrollTo('#button-crear')
                ->clicK('@btn-crear')
                ->assertPathIs('/programa/create');
        });
    }

    /**
     * Registro de programa ya existente
     *
     */
    public function testRegistrarProgramaExistente()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::find(1))
                ->maximize()
                ->visit(new ProgramaPage)
                ->clicK('@btn-formulario-crear')
                ->assertPathIs('/programa/create')
                ->seleccionarCurso(1)
                ->seleccionarCurso(3)
                ->type('#nombre', 'Programa de Entrenamiento en Competencias de Jefatura Efectiva')
                ->scrollTo('#button-crear')
                ->clicK('@btn-crear')
                ->pause('500')
                ->assertSee('El nombre ya ha sido registrado.')
                ->assertPathIs('/programa/create');
        });
    }

    /**
     * Modificación de programa con datos correctos
     * 
     */
    public function testModificarProgramaConDatosCorrectos()
    {
        $programa = Programa::where('nombre','Programa de Entrenamiento en Competencias de Jefatura Efectiva')->first();

        $this->browse(function ($browser) use ($programa) {
            $browser->loginAs(User::find(1))
                ->maximize()
                ->visit(new ProgramaPerfilPage($programa->id))
                ->click('@btn-formulario-editar')
                ->assertSee('Editar Programa')
                //->seleccionarCurso(4)
                ->type('#nombre', 'Programa de Entrenamiento en Competencias de Jefatura 2019')
                ->pause('6000')
                ->scrollTo('#button-crear')
                ->clicK('@btn-editar')
                //->pause('6000')
                ->waitForReload()
                ->pause('500')
                ->assertPathIs('/programa');
        });

        $this->assertDatabaseHas('programas', ['nombre' => 'Programa de Entrenamiento en Competencias de Jefatura 2019']);
    }

    /**
     * Modificación de programa sin datos
     * 
     */
    public function testModificarProgramaSinDatos()
    {
        $programa = Programa::where('nombre','Programa de Entrenamiento en Competencias de Jefatura 2019')->first();

        $this->browse(function ($browser) use ($programa) {
            $browser->loginAs(User::find(1))
                ->maximize()
                ->visit(new ProgramaPerfilPage($programa->id))
                ->click('@btn-formulario-editar')
                ->assertSee('Editar Programa')
                ->clear('#nombre')
                ->scrollTo('#button-crear')
                ->press('@btn-editar')
                ->assertPathIs('/programa/edit/' . $programa->id);
        });
    }

    /**
     * Despliegue de perfil programa
     * 
     */
    public function testDesplieguePerfilPrograma()
    {
        $programa = Programa::where('nombre','Programa de Entrenamiento en Competencias de Jefatura 2019')->first();

        $this->browse(function ($browser) use ($programa) {
            $browser->loginAs(User::find(1))
                ->maximize()
                ->visit(new ProgramaPerfilPage($programa->id))
                ->assertSee($programa->nombre);
        });
    }
}
