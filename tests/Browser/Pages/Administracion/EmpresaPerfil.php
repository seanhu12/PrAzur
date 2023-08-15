<?php

namespace Tests\Browser\Pages\Administracion;

use Laravel\Dusk\Browser;
use Tests\Browser\Pages\Page as Page;

class EmpresaPerfil extends Page
{

    protected $empresa_id;

    public function __construct($empresa_id)
    {
        $this->empresa_id = $empresa_id;
    }

    /**
     * Get the URL for the page.
     *
     * @return string
     */
    public function url()
    {
        return '/empresa/show/'.$this->empresa_id;
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
        ->assertSee('Información Empresa');
    }

    /**
     * Get the element shortcuts for the page.
     *
     * @return array
     */
    public function elements()
    {
        return [
            '@meta-venta' => '.btn-cyan',
            '@btn-formulario-editar' => 'a.btn:nth-child(2)',
            '@eliminar' => '#button_deshabilitar',
            '@btn-editar' => '#button-crear',
        ];
    }
}
