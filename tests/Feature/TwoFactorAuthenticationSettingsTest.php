<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Fortify\Features;
use Tests\TestCase;

/**
 * Tesztosztály a kéttényezős hitelesítési beállításokhoz.
 */
class TwoFactorAuthenticationSettingsTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Tesztelje, hogy a kéttényezős hitelesítés engedélyezhető-e.
     *
     * @return void
     */
    public function test_two_factor_authentication_can_be_enabled(): void
    {
        // Ha a kéttényezős hitelesítés nincs engedélyezve, hagyja ki a tesztet.
        if (! Features::canManageTwoFactorAuthentication()) {
            $this->markTestSkipped('Two factor authentication is not enabled.');
        }

        // Hozzon létre egy felhasználót és hitelesítse.
        $this->actingAs($user = User::factory()->create());

        // Állítsa be a munkamenetet a jelszó megerősítéséhez.
        $this->withSession(['auth.password_confirmed_at' => time()]);

        // Kéttényezős hitelesítés engedélyezése.
        $this->post('/user/two-factor-authentication');

        // Állítsd meg, hogy a felhasználó kéttényezős titka nem nulla
        // és hogy a felhasználónak 8 helyreállítási kódja van.
        $this->assertNotNull($user->fresh()->two_factor_secret);
        $this->assertCount(8, $user->fresh()->recoveryCodes());
    }

    /**
     * Tesztelje, hogy a helyreállítási kódok újragenerálhatók-e.
     *
     * @return void
     */
    public function test_recovery_codes_can_be_regenerated(): void
    {
        // Ha a kéttényezős hitelesítés nincs engedélyezve, hagyja ki a tesztet.
        if (! Features::canManageTwoFactorAuthentication()) {
            $this->markTestSkipped('Two factor authentication is not enabled.');
        }

        // Hozzon létre egy felhasználót és hitelesítse.
        $this->actingAs($user = User::factory()->create());

        // Állítsa be a munkamenetet a jelszó megerősítéséhez.
        $this->withSession(['auth.password_confirmed_at' => time()]);

        // A kéttényezős hitelesítés engedélyezése és a helyreállítási kódok újragenerálása.
        $this->post('/user/two-factor-authentication');
        $this->post('/user/two-factor-recovery-codes');

        // Frissítse a felhasználó adatait.
        $user = $user->fresh();

        // Helyreállítási kódok újragenerálása.
        $this->post('/user/two-factor-recovery-codes');

        // Biztosítsa, hogy a felhasználónak 8 helyreállítási kódja van
        // és hogy a kódok eltérőek a regenerálás után.
        $this->assertCount(8, $user->recoveryCodes());
        $this->assertCount(
            8,
            array_diff($user->recoveryCodes(), $user->fresh()->recoveryCodes())
        );
    }

    /**
     * Tesztelje, hogy a kéttényezős hitelesítés letiltható-e.
     *
     * @return void
     */
    public function test_two_factor_authentication_can_be_disabled(): void
    {
        // Ha a kéttényezős hitelesítés nincs engedélyezve, hagyja ki a tesztet.
        if (! Features::canManageTwoFactorAuthentication()) {
            $this->markTestSkipped('Two factor authentication is not enabled.');
        }

        // Hozzon létre egy felhasználót és hitelesítse.
        $this->actingAs($user = User::factory()->create());

        // Állítsa be a munkamenetet a jelszó megerősítéséhez.
        $this->withSession(['auth.password_confirmed_at' => time()]);

        // Kéttényezős hitelesítés engedélyezése.
        $this->post('/user/two-factor-authentication');

        // Állapítsd meg, hogy a felhasználó kéttényezős titka nem nulla.
        $this->assertNotNull($user->fresh()->two_factor_secret);

        // A kéttényezős hitelesítés letiltása.
        $this->delete('/user/two-factor-authentication');

        // Állítsd meg, hogy a felhasználó kéttényezős titka nulla.
        $this->assertNull($user->fresh()->two_factor_secret);
    }
}
