<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\URL;
use Laravel\Fortify\Features;
use Tests\TestCase;

class EmailVerificationTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Tesztelje, hogy az e-mail megerősítő képernyő megjeleníthető-e.
     *
     * @return void
     */
    public function test_email_verification_screen_can_be_rendered(): void
    {
        // Ellenőrizze, hogy az e-mail megerősítés engedélyezve van-e.
        if (! Features::enabled(Features::emailVerification())) {
            $this->markTestSkipped('Email verification not enabled.');
        }

        // Hozzon létre egy nem megerősített felhasználót egy személyes csapattal.
        $user = User::factory()->withPersonalTeam()->unverified()->create();

        // Cselekedjen a felhasználóként, és jelenítse meg az e-mail megerősítő képernyőt.
        $response = $this->actingAs($user)->get('/email/verify');

        // Ellenőrizze, hogy a válasz státusza 200 (OK).
        $response->assertStatus(200);
    }

    /**
     * Ellenőrizze, hogy az e-mail cím megerősíthető-e.
     *
     * @return void
     */
    public function test_email_can_be_verified(): void
    {
        // Ellenőrizze, hogy az e-mail megerősítés engedélyezve van-e.
        if (! Features::enabled(Features::emailVerification())) {
            $this->markTestSkipped('Email verification not enabled.');
        }

        // Hamisítsa meg az eseményt, hogy megakadályozza annak elküldését.
        Event::fake();

        // Hozzon létre egy nem hitelesített felhasználót személyes csapattal.
        $user = User::factory()->unverified()->create();

        // Hozzon létre egy URL-t az email hitelesítéshez egy ideiglenes aláírt útvonal segítségével.
        $verificationUrl = URL::temporarySignedRoute(
            'verification.verify',
            now()->addMinutes(60),
            ['id' => $user->id, 'hash' => sha1($user->email)]
        );

        // Cselekedjen úgy, mintha a felhasználó lenne, és lépjen be az email hitelesítési URL-címre.
        $response = $this->actingAs($user)->get($verificationUrl);

        // Állítsa be, hogy megerősítse, hogy a "Verified" eseményt elküldték.
        Event::assertDispatched(Verified::class);

        // Eredményül adhatja meg, hogy az e-mail ellenőrzött-e, miután frissítette a felhasználót.
        $this->assertTrue($user->fresh()->hasVerifiedEmail());

        // Biztosítsa, hogy a felhasználó egy ellenőrzött paraméterrel át van irányítva az irányítópultra.
        $response->assertRedirect(route('dashboard', absolute: false).'?verified=1');
    }

    /**
     * Tesztelje, hogy egy e-mail nem ellenőrizhető érvénytelen hash-sel.
     *
     * @return void
     */
    public function test_email_can_not_verified_with_invalid_hash(): void
    {
        // Ellenőrizze, hogy az e-mail-ellenőrzés engedélyezve van-e
        if (! Features::enabled(Features::emailVerification())) {
            $this->markTestSkipped('Email verification not enabled.');
        }

        // Hozzon létre egy ellenőrizetlen felhasználót
        $user = User::factory()->unverified()->create();

        // Hozzon létre egy URL-t az e-mailek ellenőrzéséhez érvénytelen hash-sel
        $verificationUrl = URL::temporarySignedRoute(
            'verification.verify',
            now()->addMinutes(60),
            ['id' => $user->id, 'hash' => sha1('wrong-email')]
        );

        // Lépjen felhasználóként, és keresse fel az e-mail-ellenőrző URL-t
        $this->actingAs($user)->get($verificationUrl);

        // A felhasználó frissítése után állítsa, hogy az e-mail nincs ellenőrizve
        $this->assertFalse($user->fresh()->hasVerifiedEmail());
    }
}
