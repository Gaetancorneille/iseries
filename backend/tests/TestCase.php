<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User;
use Tymon\JWTAuth\Facades\JWTAuth;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication, RefreshDatabase;

    /**
     * Crée un utilisateur et retourne ses headers JWT prêts à l'emploi.
     */
    protected function actingAsUser(array $overrides = []): array
    {
        $user  = User::factory()->create($overrides);
        $token = JWTAuth::fromUser($user);

        return [
            'user'    => $user,
            'headers' => ['Authorization' => "Bearer {$token}"],
        ];
    }

    /**
     * Crée deux utilisateurs : owner (auteur) + other (intrus).
     */
    protected function twoUsers(): array
    {
        $owner = User::factory()->create();
        $other = User::factory()->create();

        return [
            'owner'        => $owner,
            'owner_headers'=> ['Authorization' => 'Bearer ' . JWTAuth::fromUser($owner)],
            'other'        => $other,
            'other_headers'=> ['Authorization' => 'Bearer ' . JWTAuth::fromUser($other)],
        ];
    }
}
