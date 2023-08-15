<?php

namespace Tests\Browser\Pages\Administracion;

use Laravel\Dusk\Browser;
use Tests\Browser\Pages\Page as Page;

class UsuarioPerfil extends Page
{
    protected $user_id;

    public function __construct($user_id)
    {
        $this->user_id = $user_id;
    }
    /**
     * Get the URL for the page.
     *
     * @return string
     */
    public function url()
    {
        return '/usuario/show/'.$this->user_id;
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
        ->assertSee('Información Usuario');
    }

    /**
     * Get the element shortcuts for the page.
     *
     * @return array
     */
    public function elements()
    {
        return [
            '@cambiar-password' => '.btn-cyan',
            '@btn-formulario-editar' => 'a.btn:nth-child(2)',
            '@eliminar' => '#button_deshabilitar',
            '@btn-editar' => '#button-editar',
        ];
    }
}
