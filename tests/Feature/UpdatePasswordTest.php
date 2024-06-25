<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;


/**
 * Tesztosztály a felhasználói jelszó frissítéséhez.
 */
class UpdatePasswordTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Tesztelje, hogy a jelszó frissíthető.
     *
     * @return void
     */
    public function test_password_can_be_updated(): void
    {
        // Felhasználóként való fellépés, új felhasználó létrehozása és jelszavának frissítése.
        $this->actingAs($user = User::factory()->create());

        $this->put('/user/password', [
            'current_password' => 'password',
            'password' => 'new-password',
            'password_confirmation' => 'new-password',
        ]);

        // Ellenőrizze, hogy a jelszó megfelelően frissült-e.
        $this->assertTrue(Hash::check('new-password', $user->fresh()->password));
    }

    /**
     * Tesztelje, hogy a jelenlegi jelszó helyes-e.
     *
     * @return void
     */
    public function test_current_password_must_be_correct(): void
    {
        // Felhasználói tevékenység, új felhasználó létrehozása és jelszavának frissítése.
        $this->actingAs($user = User::factory()->create());

        $response = $this->put('/user/password', [
            'current_password' => 'wrong-password',
            'password' => 'new-password',
            'password_confirmation' => 'new-password',
        ]);

        // Ellenőrzi, hogy vannak-e hibák a munkamenetben.
        $response->assertSessionHasErrors();

        // Ellenőrizzük, hogy nem frissítették-e a jelszót.
        $this->assertTrue(Hash::check('password', $user->fresh()->password));
    }

    /**
     * Tesztelje, hogy az új jelszavaknak egyeznie kell.
     *
     * @return void
     */
    public function test_new_passwords_must_match(): void
    {
        // Felhasználói tevékenység, új felhasználó létrehozása és jelszavának frissítése.
        $this->actingAs($user = User::factory()->create());

        $response = $this->put('/user/password', [
            'current_password' => 'password',
            'password' => 'new-password',
            'password_confirmation' => 'wrong-password',
        ]);

        // Ellenőrzi, hogy vannak-e hibák a munkamenetben.
        $response->assertSessionHasErrors();

        // Ellenőrizzük, hogy nem frissítették-e a jelszót.
        $this->assertTrue(Hash::check('password', $user->fresh()->password));
    }
}
