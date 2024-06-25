<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Fortify\Features;
use Laravel\Jetstream\Jetstream;
use Tests\TestCase;


/**
 * A regisztrációs funkciók tesztjei.
 */
class RegistrationTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Tesztelje, hogy a regisztrációs képernyő megjeleníthető-e.
     *
     * @return void
     */
    public function test_registration_screen_can_be_rendered(): void
    {
        // Ellenőrizze, hogy a regisztráció engedélyezve van-e
        if (! Features::enabled(Features::registration())) {
            $this->markTestSkipped('Registration support is not enabled.');
        }

        // Küldjön GET kérelmet a regisztrációs oldalra, és érvényesítse a válasz állapotát
        $response = $this->get('/register');
        $response->assertStatus(200);
    }

    /**
     * Tesztelje, hogy a regisztrációs képernyő nem jeleníthető-e meg, ha a támogatás le van tiltva.
     *
     * @return void
     */
    public function test_registration_screen_cannot_be_rendered_if_support_is_disabled(): void
    {
        // Ellenőrizze, hogy a regisztráció le van-e tiltva
        if (Features::enabled(Features::registration())) {
            $this->markTestSkipped('Registration support is enabled.');
        }

        // Küldjön GET kérelmet a regisztrációs oldalra, és érvényesítse a válasz állapotát
        $response = $this->get('/register');
        $response->assertStatus(404);
    }

    /**
     * Tesztelje, hogy új felhasználók regisztrálhatnak-e.
     *
     * @return void
     */
    public function test_new_users_can_register(): void
    {
        // Ellenőrizze, hogy a regisztráció engedélyezve van-e
        if (! Features::enabled(Features::registration())) {
            $this->markTestSkipped('Registration support is not enabled.');
        }

        // POST kérés küldése érvényes adatokkal a regisztrációs végpontnak
        $response = $this->post('/register', [
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature(),
        ]);

        // Biztosítsa a felhasználó hitelesítését, és átirányítja az irányítópultra
        $this->assertAuthenticated();
        $response->assertRedirect(route('dashboard', absolute: false));
    }
}
