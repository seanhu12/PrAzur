<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\Browser\Pages\Administracion\Notebook as NotebookPage;
use Tests\Browser\Pages\Administracion\NotebookEdit as NotebookEditPage;
use App\User;
use App\Notebook;

class NotebookTest extends DuskTestCase
{
    /**
     * Registro de notebook con datos correctos
     *
     */
    public function testRegistrarNotebookDatosCorrecto()
    {

        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::find(1))
                ->maximize()
                ->visit(new NotebookPage)
                ->clicK('@btn-formulario-crear')
                ->assertPathIs('/notebook/create')
                ->type('#marca', 'Sony')
                ->type('#fecha_adquisicion', '10-10-2018')
                ->attach('#custom_file_notebook', base_path('tests/Browser/file/test.png'))
                ->clicK('@btn-crear')
                ->waitForReload()
                ->pause('500')
                ->assertPathIs('/notebook');
        });

        $this->assertDatabaseHas('notebooks', ['marca' => 'Sony']);
    }

    /**
     * Registro de notebook sin datos
     *
     */
    public function testRegistrarNotebookSinDatos()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::find(1))
                ->maximize()
                ->visit(new NotebookPage)
                ->clicK('@btn-formulario-crear')
                ->assertPathIs('/notebook/create')
                ->clicK('@btn-crear')
                ->assertPathIs('/notebook/create');
        });
    }

    /**
     * Registro de notebook ya existente
     *
     */
    public function testRegistrarNotebookExistente()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::find(1))
                ->maximize()
                ->visit(new NotebookPage)
                ->clicK('@btn-formulario-crear')
                ->assertPathIs('/notebook/create')
                ->type('#marca', 'Sony')
                ->type('#fecha_adquisicion', '10-10-2018')
                ->attach('#custom_file_notebook', base_path('tests/Browser/file/test.png'))
                ->clicK('@btn-crear')
                ->waitForReload()
                ->pause('500')
                ->assertPathIs('/notebook');
        });
    }

    /**
     * Modificación de notebook con datos correctos
     * TODO revisar modificación de archivo.
     */
    public function testModificarNotebookConDatosCorrectos()
    {
        $notebook = Notebook::all()->last();

        $this->browse(function ($browser) use ($notebook) {
            $browser->loginAs(User::find(1))
                ->maximize()
                ->visit(new NotebookEditPage($notebook->id))
                ->type('#marca', 'Sony Vaio')
                ->type('#fecha_adquisicion', '11-10-2018')
                ->attach('#custom_file_notebook', base_path('tests/Browser/file/test.png'))
                ->press('@btn-editar')
                ->waitForReload()
                ->pause('500')
                ->assertPathIs('/notebook');
                //->assertPathIs('/notebook/edit/' . $notebook->id);
        });

        $this->assertDatabaseHas('notebooks', ['marca' => 'Sony Vaio']);
    }

    /**
     * Modificación de notebook con datos incorrectos
     * TODO revisar modificación de archivo.
     */
    public function testModificarNotebookConDatosIncorrectos()
    {
        $notebook = Notebook::all()->last();

        $this->browse(function ($browser) use ($notebook) {
            $browser->loginAs(User::find(1))
                ->maximize()
                ->visit(new NotebookEditPage($notebook->id))
                ->type('#marca', 'Sony Vaio')
                ->type('#fecha_adquisicion', '18991-10--2018')
                ->attach('#custom_file_notebook', base_path('tests/Browser/file/test.png'))
                ->press('@btn-editar')
                ->pause('500')
                ->assertPathIs('/notebook/edit/' . $notebook->id);
        });
    }

    /**
     * Modificación de notebook sin datos
     * 
     */
    public function testModificarNotebookSinDatos()
    {
        $notebook = Notebook::all()->last();

        $this->browse(function ($browser) use ($notebook) {
            $browser->loginAs(User::find(1))
                ->maximize()
                ->visit(new NotebookEditPage($notebook->id))
                ->clear('#marca', 'Sony Vaio')
                ->clear('#fecha_adquisicion')
                ->press('@btn-editar')
                //->waitForReload()
                ->assertPathIs('/notebook/edit/' . $notebook->id);
        });
    }
}
