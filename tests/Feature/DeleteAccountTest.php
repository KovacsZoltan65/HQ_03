<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Jetstream\Features;
use Tests\TestCase;

/**
 * Tesztek a felhasználói fiókok törléséhez.
 */
class DeleteAccountTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Tesztelje, hogy a felhasználói fiókok törölhetők-e a megfelelő jelszóval.
     *
     * @return void
     */
    public function test_user_accounts_can_be_deleted(): void
    {
        // Ha a fióktörlési funkciók nincsenek engedélyezve, hagyja ki a tesztet
        if (! Features::hasAccountDeletionFeatures()) {
            $this->markTestSkipped('Account deletion is not enabled.');
        }

        // Hozzon létre egy felhasználót és jelentkezzen be
        $this->actingAs($user = User::factory()->create());

        // Törölje a felhasználói fiókot a megfelelő jelszóval
        $this->delete('/user', [
            'password' => 'password',
        ]);

        // Ellenőrizze, hogy a felhasználót törölték-e
        $this->assertNull($user->fresh());
    }

    /**
     * Ellenőrizze, hogy meg kell-e adni a helyes jelszót a fiók törlése előtt.
     *
     * @return void
     */
    public function test_correct_password_must_be_provided_before_account_can_be_deleted(): void
    {
        // Ha a fióktörlési funkciók nincsenek engedélyezve, hagyja ki a tesztet
        if (! Features::hasAccountDeletionFeatures()) {
            $this->markTestSkipped('Account deletion is not enabled.');
        }

        // Hozzon létre egy felhasználót és jelentkezzen be
        $this->actingAs($user = User::factory()->create());

        // Próbálja meg törölni a rossz jelszóval rendelkező felhasználói fiókot
        $this->delete('/user', [
            'password' => 'wrong-password',
        ]);

        // Ellenőrizze, hogy a felhasználót nem törölték-e
        $this->assertNotNull($user->fresh());
    }
}
