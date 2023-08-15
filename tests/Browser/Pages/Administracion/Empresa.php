<?php

namespace Tests\Browser\Pages\Administracion;

use Laravel\Dusk\Browser;
use Tests\Browser\Pages\Page as Page;

class Empresa extends Page
{
    /**
     * Get the URL for the page.
     *
     * @return string
     */
    public function url()
    {
        return '/empresa';
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
            ->assertSee('Empresas');
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

    public function seleccionarCiudad(Browser $browser, $idCiudad)
    {
        $browser->assertPathIs('/empresa/create')
            ->click('div.col-md-4:nth-child(1) > div:nth-child(1) > div:nth-child(4) > div:nth-child(1)')
            ->click('div.option:nth-child(' . $idCiudad . ')');

    }

    public function seleccionarHolding(Browser $browser, $idHolding)
    {
        $browser->assertPathIs('/empresa/create')
            ->click('div.row:nth-child(6) > div:nth-child(1) > div:nth-child(1) > div:nth-child(4) > div:nth-child(1)')
            ->click('div.row:nth-child(6) > div:nth-child(1) > div:nth-child(1) > div:nth-child(4) > div:nth-child(2) > div:nth-child(1) > div:nth-child(' . $idHolding . ')');
    }
}
