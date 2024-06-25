<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PasswordConfirmationTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Tesztelje, hogy a jelszó megerősítése képernyő megjeleníthető-e.
     *
     * Ez a teszt ellenőrzi, hogy a felhasználó hozzáfér-e a jelszó megerősítése képernyőhöz
     * amikor hitelesítették őket.
     *
     * @return void
     */
    public function test_confirm_password_screen_can_be_rendered(): void
    {
        // Hozzon létre egy felhasználót egy személyes csapattal
        $user = User::factory()->withPersonalTeam()->create();

        // Felhasználóként eljárva küldjön egy GET kérést a jelszó megerősítési útvonalára
        $response = $this->actingAs($user)->get('/user/confirm-password');

        // Állítsa be, hogy a válasz állapota 200 (OK)
        $response->assertStatus(200);
    }

    /**
     * Tesztelje, hogy a jelszó megerősítése sikeres lehet-e.
     *
     * Ez a teszt ellenőrzi, hogy a felhasználó sikeresen megerősítheti a jelszavát a megadott
     * jelszó megerősítési útvonalon keresztül.
     *
     * @return void
     */
    public function test_password_can_be_confirmed(): void
    {
        // Hozzon létre egy felhasználót
        $user = User::factory()->create([
            'password' => bcrypt('password'),
        ]);

        // Felhasználóként eljárva küldjön egy POST kérést a jelszó megerősítési útvonalára
        $response = $this->actingAs($user)->post('/user/confirm-password', [
            'password' => 'password', // A megerősíteni kívánt jelszó
        ]);

        // Ellenőrizze, hogy a válasz átirányítja a felhasználót
        $response->assertRedirect();

        // Ellenőrizze, hogy a válaszban nincs hibaüzenet
        $response->assertSessionHasNoErrors();
    }

    /**
     * Tesztelje, hogy a jelszó megerősítése sikertelen lehet-e, ha a megadott jelszó helytelen.
     *
     * Ez a teszt ellenőrzi, hogy a felhasználó nem sikerül megerősítenie a jelszavát, ha a megadott
     * jelszó helytelen.
     *
     * @return void
     */
    public function test_password_is_not_confirmed_with_invalid_password(): void
    {
        // Hozzon létre egy felhasználót
        $user = User::factory()->create();

        // Felhasználóként eljárva küldjön egy POST kérést a jelszó megerősítési útvonalára
        // Helytelen jelszó megadása
        $response = $this->actingAs($user)->post('/user/confirm-password', [
            'password' => 'wrong-password',
        ]);

        // Ellenőrizze, hogy a válaszban hibaüzenet található
        $response->assertSessionHasErrors();
    }
}
