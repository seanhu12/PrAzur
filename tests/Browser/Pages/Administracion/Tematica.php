<?php

namespace Tests\Browser\Pages\Administracion;

use Laravel\Dusk\Browser;
use Tests\Browser\Pages\Page as Page;

class Tematica extends Page
{
    /**
     * Get the URL for the page.
     *
     * @return string
     */
    public function url()
    {
        return '/tematica';
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
        ->assertSee('Temáticas');
    }

    /**
     * Get the element shortcuts for the page.
     *
     * @return array
     */
    public function elements()
    {
        return [
            '@btn-formulario-crear' => '.btn-cyan',
            '@btn-crear' => '#button-crear',
        ];
    }
}
