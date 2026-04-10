<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Series;
use App\Models\Favorite;

class FavoriteTest extends TestCase
{
    public function test_authenticated_user_can_get_favorites(): void
    {
        ['user' => $user, 'headers' => $headers] = $this->actingAsUser();
        $series = Series::factory()->count(3)->create();
        foreach ($series as $s) {
            Favorite::create(['user_id' => $user->id, 'series_id' => $s->id]);
        }

        $this->getJson('/api/v1/favorites', $headers)
             ->assertStatus(200)
             ->assertJsonCount(3);
    }

    public function test_unauthenticated_user_cannot_access_favorites(): void
    {
        $this->getJson('/api/v1/favorites')
             ->assertStatus(401);
    }

    public function test_user_can_add_series_to_favorites(): void
    {
        ['user' => $user, 'headers' => $headers] = $this->actingAsUser();
        $series = Series::factory()->create();

        $this->postJson('/api/v1/favorites', [
            'series_id' => $series->id,
        ], $headers)
             ->assertStatus(201)
             ->assertJsonPath('message', 'Series added to favorites');

        $this->assertDatabaseHas('favorites', [
            'user_id'   => $user->id,
            'series_id' => $series->id,
        ]);
    }

    public function test_user_cannot_add_same_series_twice(): void
    {
        ['user' => $user, 'headers' => $headers] = $this->actingAsUser();
        $series = Series::factory()->create();
        Favorite::create(['user_id' => $user->id, 'series_id' => $series->id]);

        $this->postJson('/api/v1/favorites', [
            'series_id' => $series->id,
        ], $headers)
             ->assertStatus(422)
             ->assertJsonPath('error', 'Series already in favorites');
    }

    public function test_user_can_remove_series_from_favorites(): void
    {
        ['user' => $user, 'headers' => $headers] = $this->actingAsUser();
        $series = Series::factory()->create();
        Favorite::create(['user_id' => $user->id, 'series_id' => $series->id]);

        $this->deleteJson("/api/v1/favorites/{$series->id}", [], $headers)
             ->assertStatus(200)
             ->assertJsonPath('message', 'Series removed from favorites');

        $this->assertDatabaseMissing('favorites', [
            'user_id'   => $user->id,
            'series_id' => $series->id,
        ]);
    }

    public function test_user_can_check_if_series_is_favorite(): void
    {
        ['user' => $user, 'headers' => $headers] = $this->actingAsUser();
        $series = Series::factory()->create();
        Favorite::create(['user_id' => $user->id, 'series_id' => $series->id]);

        $this->getJson("/api/v1/favorites/check/{$series->id}", $headers)
             ->assertStatus(200)
             ->assertJsonPath('is_favorite', true);
    }

    public function test_check_returns_false_when_not_favorite(): void
    {
        ['headers' => $headers] = $this->actingAsUser();
        $series = Series::factory()->create();

        $this->getJson("/api/v1/favorites/check/{$series->id}", $headers)
             ->assertStatus(200)
             ->assertJsonPath('is_favorite', false);
    }

    public function test_toggle_adds_to_favorites_when_not_yet_added(): void
    {
        ['user' => $user, 'headers' => $headers] = $this->actingAsUser();
        $series = Series::factory()->create();

        $this->postJson('/api/v1/favorites/toggle', [
            'series_id' => $series->id,
        ], $headers)
             ->assertStatus(200)
             ->assertJsonPath('is_favorite', true);

        $this->assertDatabaseHas('favorites', [
            'user_id'   => $user->id,
            'series_id' => $series->id,
        ]);
    }

    public function test_toggle_removes_from_favorites_when_already_added(): void
    {
        ['user' => $user, 'headers' => $headers] = $this->actingAsUser();
        $series = Series::factory()->create();
        Favorite::create(['user_id' => $user->id, 'series_id' => $series->id]);

        $this->postJson('/api/v1/favorites/toggle', [
            'series_id' => $series->id,
        ], $headers)
             ->assertStatus(200)
             ->assertJsonPath('is_favorite', false);

        $this->assertDatabaseMissing('favorites', [
            'user_id'   => $user->id,
            'series_id' => $series->id,
        ]);
    }

    public function test_favorites_are_isolated_between_users(): void
    {
        ['user' => $user1, 'headers' => $headers1] = $this->actingAsUser();
        ['user' => $user2, 'headers' => $headers2] = $this->actingAsUser();
        $series = Series::factory()->create();

        Favorite::create(['user_id' => $user1->id, 'series_id' => $series->id]);

        // User1 voit son favori
        $this->getJson('/api/v1/favorites', $headers1)
             ->assertStatus(200)
             ->assertJsonCount(1);

        // User2 ne voit pas les favoris de User1
        $this->getJson('/api/v1/favorites', $headers2)
             ->assertStatus(200)
             ->assertJsonCount(0);
    }
}
