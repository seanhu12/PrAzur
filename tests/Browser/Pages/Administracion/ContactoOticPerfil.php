<?php

namespace Tests\Browser\Pages\Administracion;

use Laravel\Dusk\Browser;
use Tests\Browser\Pages\Page as Page;

class ContactoOticPerfil extends Page
{
    protected $contactoOtic_id;

    public function __construct($contactoOtic_id)
    {
        $this->contactoOtic_id = $contactoOtic_id;
    }

    /**
     * Get the URL for the page.
     *
     * @return string
     */
    public function url()
    {
        return '/contacto_otic/show/'.$this->contactoOtic_id;
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
        ->assertSee('Información del Contacto de OTIC');
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
