<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;


/**
 * A hitelesítési funkció tesztjei.
 */
class AuthenticationTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Tesztelje, hogy a bejelentkezési képernyő megjeleníthető-e.
     *
     * @return void
     */
    public function test_login_screen_can_be_rendered(): void
    {
        // Küldjön GET kérést a bejelentkezési oldalra
        $response = $this->get('/login');

        // Állítsa be, hogy a válasz állapota 200 (OK)
        $response->assertStatus(200);
    }

    /**
     * Tesztelje, hogy a felhasználók hitelesíthetik-e a bejelentkezési képernyőt.
     *
     * @return void
     */
    public function test_users_can_authenticate_using_the_login_screen(): void
    {
        // Hozzon létre egy felhasználót az adatbázisban
        $user = User::factory()->create();

        // Küldjön POST kérést a bejelentkezési oldalra a felhasználó e-mail címével és jelszavával
        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => 'password',
        ]);

        // Biztosítsa, hogy a felhasználó hitelesítve van
        $this->assertAuthenticated();

        // Assert that the user is redirected to the dashboard page
        $response->assertRedirect(route('dashboard', absolute: false));
    }

    /**
     * Tesztelje, hogy a felhasználók nem tudnak-e hitelesíteni érvénytelen jelszót.
     *
     * @return void
     */
    public function test_users_can_not_authenticate_with_invalid_password(): void
    {
        // Hozzon létre egy felhasználót az adatbázisban
        $user = User::factory()->create();

        // Küldjön POST kérést a bejelentkezési oldalra a felhasználó e-mail címével és érvénytelen jelszavával
        $this->post('/login', [
            'email' => $user->email,
            'password' => 'wrong-password',
        ]);

        // Biztosítsa, hogy a felhasználó nincs hitelesítve
        $this->assertGuest();
    }
}
