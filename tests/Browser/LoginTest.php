<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use PHPUnit\Framework\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Support\Facades\Artisan;
use App\User;


class LoginTest extends DuskTestCase
{
    public function testLoginUsuarioCredencialesIncorrectas()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/login')
                ->assertSee('ID Usuario')
                ->assertSee('Contraseña')
                ->type('rut', '11.111.121-1')
                ->type('password', 'password')
                ->press('Ingresar')
                ->assertPathIsNot('/home');
        });
    }

   public function testLoginUsuarioSinCredenciales()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/login')
                ->assertSee('ID Usuario')
                ->assertSee('Contraseña')
                ->press('Ingresar')
                ->assertPathIsNot('/home');
        });
    }


    public function testLoginAdmin()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/login')
                ->assertSee('ID Usuario')
                ->assertSee('Contraseña')
                ->type('rut', '77.934.650-1')
                ->type('password', '123456')
                ->press('Ingresar')
                ->assertPathIs('/home')
                ->logout()
                ->assertGuest();
        }); 
    }

}