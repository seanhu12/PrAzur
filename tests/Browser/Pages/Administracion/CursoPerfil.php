<?php

namespace Tests\Browser\Pages\Administracion;

use Laravel\Dusk\Browser;
use Tests\Browser\Pages\Page as Page;

class CursoPerfil extends Page
{
    protected $curso_id;

    public function __construct($curso_id)
    {
        $this->curso_id = $curso_id;
    }
    /**
     * Get the URL for the page.
     *
     * @return string
     */
    public function url()
    {
        return '/curso/show/' . $this->curso_id;
    }

    /**
     * Assert that the browser is on the page.
     *
     * @param  Browser  $browser
     * @return void
     */
    public function assert(Browser $browser)
    {
        $browser->assertPathIs($this->url())
            ->assertSee('Información Curso');
    }

    /**
     * Get the element shortcuts for the page.
     *
     * @return array
     */
    public function elements()
    {
        return [
            '@btn-formulario-editar' => '.btn-blue',
            '@eliminar' => '#button_deshabilitar',
            '@btn-editar' => '#button-crear',
        ];
    }
}
