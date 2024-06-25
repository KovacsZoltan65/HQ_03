<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Jetstream\Features;
use Tests\TestCase;

/**
 * Teszteset API-tokenek létrehozásához.
 */
class CreateApiTokenTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Tesztelje, hogy létrehozhatók-e API-tokenek.
     *
     * @return void
     */
    public function test_api_tokens_can_be_created(): void
    {
        // Ellenőrizze, hogy az API-támogatás engedélyezve van-e
        if (! Features::hasApiFeatures()) {
            $this->markTestSkipped('API support is not enabled.');
        }

        // Hozzon létre egy felhasználót személyes csapattal
        $this->actingAs($user = User::factory()->withPersonalTeam()->create());

        // Hozzon létre egy API tokent a megadott névvel és engedélyekkel
        $this->post('/user/api-tokens', [
            'name' => 'Test Token',
            'permissions' => [
                'read',
                'update',
            ],
        ]);

        // Tegyük fel, hogy az API-token létrejött, és a tulajdonságai helyesek
        $this->assertCount(1, $user->fresh()->tokens);
        $this->assertEquals('Test Token', $user->fresh()->tokens->first()->name);
        $this->assertTrue($user->fresh()->tokens->first()->can('read'));
        $this->assertFalse($user->fresh()->tokens->first()->can('delete'));
    }
}
