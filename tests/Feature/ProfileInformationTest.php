<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;


/**
 * Teszteset a felhasználói profil információinak frissítéséhez.
 *
 * @return void
 */
class ProfileInformationTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Tesztelje, hogy a felhasználó profilinformációi frissíthetők-e.
     *
     * @return void
     */
    public function test_profile_information_can_be_updated(): void
    {
        // Hozzon létre egy felhasználót, és jelentkezzen be őként
        $this->actingAs($user = User::factory()->create());

        // PUT kérés küldése a felhasználó profilinformációinak frissítéséhez
        $this->put('/user/profile-information', [
            'name' => 'Test Name',
            'email' => 'test@example.com',
        ]);

        // Állítsd meg, hogy a felhasználó neve és e-mail címe frissült
        $this->assertEquals('Test Name', $user->fresh()->name);
        $this->assertEquals('test@example.com', $user->fresh()->email);
    }
}
