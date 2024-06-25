<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Str;
use Laravel\Jetstream\Features;
use Tests\TestCase;


/**
 * Teszteset API-tokenek törléséhez.
 */
class DeleteApiTokenTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Tesztelje, hogy az API-tokenok törölhetők-e.
     *
     * @return void
     */
    public function test_api_tokens_can_be_deleted(): void
    {
        // Ellenőrizze, hogy az API-támogatás engedélyezve van-e
        if (! Features::hasApiFeatures()) {
            $this->markTestSkipped('API support is not enabled.');
        }

        // Hozzon létre egy felhasználót személyes csapattal
        $this->actingAs($user = User::factory()->withPersonalTeam()->create());

        // Hozzon létre egy új API-jogkivonatot a meghatározott jogosultságokkal rendelkező felhasználó számára
        $token = $user->tokens()->create([
            'name' => 'Test Token',
            'token' => Str::random(40),
            'abilities' => ['create', 'read'],
        ]);

        // Törölje az API-jogkivonatot
        $this->delete('/user/api-tokens/'.$token->id);

        // Ellenőrizze, hogy az API-jogkivonatok listája üres
        $this->assertCount(0, $user->fresh()->tokens);
    }
}
