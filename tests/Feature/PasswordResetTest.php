<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Notification;
use Laravel\Fortify\Features;
use Tests\TestCase;

class PasswordResetTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Tesztelje, hogy a jelszó-visszaállítási hivatkozás képernyője megjeleníthető-e.
     *
     * Ez a teszt azt ellenőrzi, hogy a jelszó-visszaállítási hivatkozás képernyő megjeleníthető-e, ha a jelszó-visszaállítási funkció engedélyezve van.
     *
     * @return void
     */
    public function test_reset_password_link_screen_can_be_rendered(): void
    {
        // Ha a jelszó-visszaállítási funkció nincs engedélyezve, hagyja ki a tesztet.
        if (! Features::enabled(Features::resetPasswords())) {
            $this->markTestSkipped('Password updates are not enabled.');
        }

        // Küldjön GET kérelmet a jelszó-visszaállítási hivatkozás képernyőútvonalára, és állítsa be, hogy az állapotkód 200.
        $response = $this->get('/forgot-password');
        $response->assertStatus(200);
    }

    /**
     * Tesztelje, hogy a jelszó-visszaállítási link kérése sikeres legyen.
     *
     * Ez a teszt ellenőrzi, hogy a jelszó-visszaállítási link kérése sikeres lesz, ha a jelszó-visszaállítási funkció engedélyezve van.
     *
     * @return void
     */
    public function test_reset_password_link_can_be_requested(): void
    {
        // Ha a jelszó-visszaállítási funkció nincs engedélyezve, hagyja ki a tesztet.
        if (! Features::enabled(Features::resetPasswords())) {
            $this->markTestSkipped('Password updates are not enabled.');
        }

        // Elrejti a megjelenő értesítéseket.
        Notification::fake();

        // Létrehoz egy új felhasználót.
        $user = User::factory()->create();

        // Küldjön POST kérelmet a jelszó-visszaállítási kérelmének URL-jére, az email címmel, és állítsa be, hogy a felhasználónak értesítés lett küldve.
        $this->post('/forgot-password', [
            'email' => $user->email,
        ]);

        // Ellenőrzi, hogy az értesítés elküldésre került.
        Notification::assertSentTo($user, ResetPassword::class);
    }

    /**
     * Tesztelje, hogy a jelszó-visszaállítási képernyő megjeleníthető-e.
     *
     * Ez a teszt ellenőrzi, hogy a jelszó-visszaállítási képernyő megjeleníthető-e, ha a jelszó-visszaállítási funkció engedélyezve van,
     * és ha a jelszó-visszaállítási link kérése sikeres volt.
     *
     * @return void
     */
    public function test_reset_password_screen_can_be_rendered(): void
    {
        // Ha a jelszó-visszaállítási funkció nincs engedélyezve, hagyja ki a tesztet.
        if (! Features::enabled(Features::resetPasswords())) {
            $this->markTestSkipped('Password updates are not enabled.');
        }

        // Elrejti a megjelenő értesítéseket.
        Notification::fake();

        // Létrehoz egy új felhasználót.
        $user = User::factory()->create();

        // Küldjön POST kérelmet a jelszó-visszaállítási kérelmének URL-jére, az email címmel, és állítsa be, hogy a felhasználónak értesítés lett küldve.
        $this->post('/forgot-password', [
            'email' => $user->email,
        ]);

        // Ellenőrzi, hogy az értesítés elküldésre került.
        Notification::assertSentTo($user, ResetPassword::class, function (object $notification) {
            // Küldjön GET kérelmet a jelszó-visszaállítási képernyő útvonalára, és állítsa be, hogy az állapotkód 200.
            $response = $this->get('/reset-password/'.$notification->token);

            // Ellenőrzi, hogy a jelszó-visszaállítási képernyő megjeleníthető-e.
            $response->assertStatus(200);

            return true;
        });
    }

    /**
     * Tesztelje, hogy a jelszó visszaállítható érvényes tokennel.
     *
     * Ez a teszt ellenőrzi, hogy a jelszó visszaállítható érvényes tokennel, ha a jelszó-visszaállítás engedélyezve van.
     *
     * @return void
     */
    public function test_password_can_be_reset_with_valid_token(): void
    {
        // Ha a jelszó-visszaállítás funkció nincs engedélyezve, hagyja ki a tesztet.
        if (! Features::enabled(Features::resetPasswords())) {
            $this->markTestSkipped('Password updates are not enabled.');
        }

        // Elrejti a megjelenő értesítéseket.
        Notification::fake();

        // Létrehoz egy új felhasználót.
        $user = User::factory()->create();

        // Küldjön POST kérelmet a jelszó-visszaállítási kérelmének URL-jére, az email címmel, és állítsa be, hogy a felhasználónak értesítés lett küldve.
        $this->post('/forgot-password', [
            'email' => $user->email,
        ]);

        // Ellenőrzi, hogy az értesítés elküldésre került.
        Notification::assertSentTo($user, ResetPassword::class, function (object $notification) use ($user) {
            // Küldjön POST kérelmet a jelszó-visszaállítási kérelmének URL-jére, az email címmel, és állítsa be, hogy a felhasználónak jelszó-visszaállítása sikeres legyen.
            $response = $this->post('/reset-password', [
                'token' => $notification->token,
                'email' => $user->email,
                'password' => 'password',
                'password_confirmation' => 'password',
            ]);

            // Ellenőrzi, hogy a jelszó-visszaállítás sikeres volt, és nincs hiba a munkamenetben.
            $response->assertSessionHasNoErrors();

            return true;
        });
    }
}
