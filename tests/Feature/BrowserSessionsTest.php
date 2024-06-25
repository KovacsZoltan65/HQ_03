<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * Tesztosztály a böngésző munkamenetek funkcióhoz.
 */
class BrowserSessionsTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Tesztelje, hogy más böngésző-munkamenetek kijelentkezhetők-e.
     *
     * @return void
     */
    public function test_other_browser_sessions_can_be_logged_out(): void
    {
        // Hozzon létre egy felhasználót és jelentkezzen be
        $this->actingAs(User::factory()->create());

        // Készítsen DELETE kérelmet a többi böngésző-munkamenet-végponthoz
        // a jelszóval
        $response = $this->delete('/user/other-browser-sessions', [
            'password' => 'password',
        ]);

        // Biztosítsa, hogy a válaszban nincsenek munkamenet-hibák
        $response->assertSessionHasNoErrors();
    }
}
