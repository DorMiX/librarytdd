<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class RegisterTest extends DuskTestCase
{
    use DatabaseMigrations;
    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testRegisterPageCanBeFormedByRegisterUrl()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/register')
                    ->assertTitle('Laravel')
                    ->assertTitleContains('Laravel')
                    ->assertSee('Register')
                    ->type('name', 'dormix')
                    ->type('email', 'dormix@dormix.io')
                    ->type('password', 'dorMiX12')
                    ->type('password_confirmation', 'dorMiX12')
                    ->press('Register')
                    ->assertPathIs('/home')
                    ->assertPathIsNot('/register')
                    ->assertPathIsNot('/login');
        });
    }
}
