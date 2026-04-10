<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Series;
use App\Models\Season;
use App\Models\Episode;

class SeriesTest extends TestCase
{
    // ── Lecture publique ──────────────────────────────────────────────────────

    public function test_anyone_can_list_series(): void
    {
        Series::factory()->count(5)->create(['is_active' => true]);

        $this->getJson('/api/v1/series')
             ->assertStatus(200)
             ->assertJsonStructure(['data', 'total', 'per_page', 'current_page']);
    }

    public function test_series_list_supports_search_filter(): void
    {
        Series::factory()->create(['title' => 'Breaking Bad', 'is_active' => true]);
        Series::factory()->create(['title' => 'Game of Thrones', 'is_active' => true]);

        $response = $this->getJson('/api/v1/series?search=Breaking')
                         ->assertStatus(200);

        $this->assertCount(1, $response->json('data'));
        $this->assertEquals('Breaking Bad', $response->json('data.0.title'));
    }

    public function test_series_list_supports_genre_filter(): void
    {
        Series::factory()->create(['genre' => 'Drama', 'is_active' => true]);
        Series::factory()->create(['genre' => 'Comedy', 'is_active' => true]);
        Series::factory()->create(['genre' => 'Drama', 'is_active' => true]);

        $response = $this->getJson('/api/v1/series?genre=Drama')
                         ->assertStatus(200);

        $this->assertCount(2, $response->json('data'));
    }

    public function test_anyone_can_view_series_detail_with_relations(): void
    {
        $series = Series::factory()->create();
        $season = Season::factory()->create(['series_id' => $series->id]);
        Episode::factory()->count(3)->create([
            'series_id' => $series->id,
            'season_id' => $season->id,
        ]);

        $response = $this->getJson("/api/v1/series/{$series->id}")
                         ->assertStatus(200)
                         ->assertJsonPath('id', $series->id);

        // Les saisons et épisodes doivent être inclus
        $this->assertArrayHasKey('seasons', $response->json());
        $this->assertCount(1, $response->json('seasons'));
        $this->assertCount(3, $response->json('seasons.0.episodes'));
    }

    public function test_get_nonexistent_series_returns_404(): void
    {
        $this->getJson('/api/v1/series/9999')
             ->assertStatus(404);
    }

    // ── Écriture protégée ─────────────────────────────────────────────────────

    public function test_authenticated_user_can_create_series(): void
    {
        ['headers' => $headers] = $this->actingAsUser();

        $this->postJson('/api/v1/series', [
            'title'        => 'Breaking Bad',
            'description'  => 'Un chef de la drogue.',
            'genre'        => 'Crime Drama',
            'release_year' => 2008,
            'rating'       => 9.5,
            'is_active'    => true,
        ], $headers)
             ->assertStatus(201)
             ->assertJsonPath('title', 'Breaking Bad');
    }

    public function test_unauthenticated_user_cannot_create_series(): void
    {
        $this->postJson('/api/v1/series', [
            'title'        => 'Test',
            'description'  => 'Test.',
            'genre'        => 'Drama',
            'release_year' => 2020,
        ])->assertStatus(401);
    }

    public function test_create_series_validates_required_fields(): void
    {
        ['headers' => $headers] = $this->actingAsUser();

        $this->postJson('/api/v1/series', [], $headers)
             ->assertStatus(422)
             ->assertJsonValidationErrors(['title', 'description', 'genre', 'release_year']);
    }

    public function test_create_series_validates_release_year_range(): void
    {
        ['headers' => $headers] = $this->actingAsUser();

        $this->postJson('/api/v1/series', [
            'title'        => 'Test',
            'description'  => 'Test.',
            'genre'        => 'Drama',
            'release_year' => 1800, // Trop ancien
        ], $headers)
             ->assertStatus(422)
             ->assertJsonValidationErrors(['release_year']);
    }

    public function test_authenticated_user_can_update_series(): void
    {
        ['headers' => $headers] = $this->actingAsUser();
        $series = Series::factory()->create();

        $this->putJson("/api/v1/series/{$series->id}", [
            'title' => 'Titre mis à jour',
        ], $headers)
             ->assertStatus(200)
             ->assertJsonPath('title', 'Titre mis à jour');
    }

    public function test_authenticated_user_can_delete_series(): void
    {
        ['headers' => $headers] = $this->actingAsUser();
        $series = Series::factory()->create();

        $this->deleteJson("/api/v1/series/{$series->id}", [], $headers)
             ->assertStatus(200);

        $this->assertDatabaseMissing('series', ['id' => $series->id]);
    }
}
