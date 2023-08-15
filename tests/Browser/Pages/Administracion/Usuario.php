<?php

namespace Tests\Browser\Pages\Administracion;

use Laravel\Dusk\Browser;
use Tests\Browser\Pages\Page as Page;

class Usuario extends Page
{
    /**
     * Get the URL for the page.
     *
     * @return string
     */
    public function url()
    {
        return '/usuario';
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
        ->assertSee('Usuarios');
    }

    /**
     * Get the element shortcuts for the page.
     *
     * @return array
     */
    public function elements()
    {
        return [
            '@btn-formulario-crear' =>'.btn-cyan',
            '@btn-crear' =>'#button-crear',
        ];
    }

    public function llenarFormularioUsuario(Browser $browser)
    {
        $browser->clicK('@btn-formulario-crear');

        //$browser->assertPathIs('/usuario/create44');
        //$browser->type('first_name', $this->faker->firstName);
        //$browser->type('last_name', $this->faker->lastName);
        //$browser->select('subject_sex');
        //DOB
        //$browser->select('DOBmon');
        //$browser->select('DOBday');
        //$browser->select('DOByear');
    }

    public function seleccionarRolesUsuario(Browser $browser,$idRol)
    {
        $browser->assertPathIs('/usuario/create')
        ->click('.selectize-input')
        ->click('div.option:nth-child('.$idRol.')');

    }
}
