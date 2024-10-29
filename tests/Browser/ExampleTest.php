<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Symfony\Component\Panther\PantherTestCase;


class ExampleTest extends PantherTestCase
{
    /**
     * A basic browser test example.
     */
    public function testBasicExample(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('https://www.facebook.com/')
                ->assertSee('Example Domain');
        });
    }
}
