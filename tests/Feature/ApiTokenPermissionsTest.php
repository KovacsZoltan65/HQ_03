<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Str;
use Laravel\Jetstream\Features;
use Tests\TestCase;


/**
 * Tesztosztály az API-token engedélyek frissítéséhez.
 */
class ApiTokenPermissionsTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Tesztelje, hogy az API-token engedélyek frissíthetők-e.
     *
     * @return void
     */
    public function test_api_token_permissions_can_be_updated(): void
    {
        // Ellenőrizze, hogy az API-funkciók engedélyezve vannak-e
        if (! Features::hasApiFeatures()) {
            $this->markTestSkipped('API support is not enabled.');
        }

        // Hozzon létre egy felhasználót egy személyes csapattal
        $this->actingAs($user = User::factory()->withPersonalTeam()->create());

        // Hozzon létre egy új API-jogkivonatot a meghatározott jogosultságokkal rendelkező felhasználó számára
        $token = $user->tokens()->create([
            'name' => 'Test Token',
            'token' => Str::random(40),
            'abilities' => ['create', 'read'],
        ]);

        // Frissítse a token engedélyeit
        $this->put('/user/api-tokens/'.$token->id, [
            'name' => $token->name,
            'permissions' => [
                'delete',
                'missing-permission',
            ],
        ]);

        // Erősítse meg, hogy a token engedélyei frissültek
        $this->assertTrue($user->fresh()->tokens->first()->can('delete'));
        $this->assertFalse($user->fresh()->tokens->first()->can('read'));
        $this->assertFalse($user->fresh()->tokens->first()->can('missing-permission'));
    }
}
