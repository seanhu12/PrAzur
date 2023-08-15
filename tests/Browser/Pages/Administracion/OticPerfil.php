<?php

namespace Tests\Browser\Pages\Administracion;

use Laravel\Dusk\Browser;
use Tests\Browser\Pages\Page as Page;

class OticPerfil extends Page
{
    
    protected $otic_id;

    public function __construct($otic_id)
    {
        $this->otic_id = $otic_id;
    }

    /**
     * Get the URL for the page.
     *
     * @return string
     */
    public function url()
    {
        return '/otic/show/'.$this->otic_id;
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
        ->assertSee('Información OTIC');
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
