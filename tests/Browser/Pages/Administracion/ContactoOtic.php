<?php

namespace Tests\Browser\Pages\Administracion;

use Laravel\Dusk\Browser;
use Tests\Browser\Pages\Page as Page;

class ContactoOtic extends Page
{
    /**
     * Get the URL for the page.
     *
     * @return string
     */
    public function url()
    {
        return '/contacto_otic';
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
            ->assertSee('Contactos de OTICs');
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

    public function seleccionarOtic(Browser $browser, $idOtic)
    {
        $browser->assertPathIs('/contacto_otic/create')
            ->click('.selectize-input')  
        //->click('div.col-md-4:nth-child(1) > div:nth-child(1) > div:nth-child(4) > div:nth-child(1)')
            ->click('div.option:nth-child(' . $idOtic . ')');

    }
}
