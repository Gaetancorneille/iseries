<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Series;
use App\Models\Season;
use App\Models\Episode;

class SeasonEpisodeTest extends TestCase
{
    // ── Saisons ───────────────────────────────────────────────────────────────

    public function test_anyone_can_list_seasons_of_a_series(): void
    {
        $series = Series::factory()->create();
        Season::factory()->count(3)->create(['series_id' => $series->id]);

        $response = $this->getJson("/api/v1/series/{$series->id}/seasons")
                         ->assertStatus(200);

        $this->assertCount(3, $response->json('seasons'));
    }

    public function test_list_seasons_returns_404_for_nonexistent_series(): void
    {
        $this->getJson('/api/v1/series/9999/seasons')
             ->assertStatus(404);
    }

    public function test_anyone_can_view_season_detail_with_episodes(): void
    {
        $series = Series::factory()->create();
        $season = Season::factory()->create([
            'series_id'     => $series->id,
            'season_number' => 1,
        ]);
        Episode::factory()->count(5)->create([
            'series_id' => $series->id,
            'season_id' => $season->id,
        ]);

        $response = $this->getJson("/api/v1/series/{$series->id}/seasons/1")
                         ->assertStatus(200);

        $this->assertCount(5, $response->json('episodes'));
    }

    public function test_authenticated_user_can_create_season(): void
    {
        ['headers' => $headers] = $this->actingAsUser();
        $series = Series::factory()->create();

        $this->postJson("/api/v1/series/{$series->id}/seasons", [
            'season_number' => 1,
            'title'         => 'Saison 1',
            'release_date'  => '2020-01-01',
        ], $headers)
             ->assertStatus(201)
             ->assertJsonPath('season_number', 1);

        $this->assertDatabaseHas('seasons', [
            'series_id'     => $series->id,
            'season_number' => 1,
        ]);
    }

    public function test_cannot_create_duplicate_season_number(): void
    {
        ['headers' => $headers] = $this->actingAsUser();
        $series = Series::factory()->create();
        Season::factory()->create(['series_id' => $series->id, 'season_number' => 1]);

        $this->postJson("/api/v1/series/{$series->id}/seasons", [
            'season_number' => 1,
        ], $headers)
             ->assertStatus(422);
    }

    public function test_unauthenticated_user_cannot_create_season(): void
    {
        $series = Series::factory()->create();

        $this->postJson("/api/v1/series/{$series->id}/seasons", [
            'season_number' => 1,
        ])->assertStatus(401);
    }

    // ── Épisodes ──────────────────────────────────────────────────────────────

    public function test_anyone_can_list_episodes_of_a_season(): void
    {
        $series = Series::factory()->create();
        $season = Season::factory()->create(['series_id' => $series->id, 'season_number' => 1]);
        Episode::factory()->count(8)->create([
            'series_id' => $series->id,
            'season_id' => $season->id,
        ]);

        $response = $this->getJson("/api/v1/series/{$series->id}/seasons/1/episodes")
                         ->assertStatus(200);

        $this->assertCount(8, $response->json('episodes'));
    }

    public function test_episode_detail_includes_prev_and_next(): void
    {
        $series = Series::factory()->create();
        $season = Season::factory()->create(['series_id' => $series->id, 'season_number' => 1]);

        Episode::factory()->create([
            'series_id'      => $series->id,
            'season_id'      => $season->id,
            'episode_number' => 1,
            'title'          => 'Épisode 1',
        ]);
        Episode::factory()->create([
            'series_id'      => $series->id,
            'season_id'      => $season->id,
            'episode_number' => 2,
            'title'          => 'Épisode 2',
        ]);
        Episode::factory()->create([
            'series_id'      => $series->id,
            'season_id'      => $season->id,
            'episode_number' => 3,
            'title'          => 'Épisode 3',
        ]);

        $response = $this->getJson("/api/v1/series/{$series->id}/seasons/1/episodes/2")
                         ->assertStatus(200);

        $this->assertEquals(1, $response->json('previous_episode.episode_number'));
        $this->assertEquals(3, $response->json('next_episode.episode_number'));
    }

    public function test_first_episode_has_no_previous(): void
    {
        $series = Series::factory()->create();
        $season = Season::factory()->create(['series_id' => $series->id, 'season_number' => 1]);
        Episode::factory()->create([
            'series_id'      => $series->id,
            'season_id'      => $season->id,
            'episode_number' => 1,
        ]);

        $response = $this->getJson("/api/v1/series/{$series->id}/seasons/1/episodes/1")
                         ->assertStatus(200);

        $this->assertNull($response->json('previous_episode'));
    }

    public function test_authenticated_user_can_create_episode(): void
    {
        ['headers' => $headers] = $this->actingAsUser();
        $series = Series::factory()->create();
        $season = Season::factory()->create(['series_id' => $series->id, 'season_number' => 1]);

        $this->postJson("/api/v1/series/{$series->id}/seasons/1/episodes", [
            'episode_number' => 1,
            'title'          => 'Pilot',
            'duration'       => 62,
        ], $headers)
             ->assertStatus(201)
             ->assertJsonPath('title', 'Pilot');
    }

    public function test_episode_store_increments_season_episode_count(): void
    {
        ['headers' => $headers] = $this->actingAsUser();
        $series = Series::factory()->create();
        $season = Season::factory()->create([
            'series_id'     => $series->id,
            'season_number' => 1,
            'episode_count' => 0,
        ]);

        $this->postJson("/api/v1/series/{$series->id}/seasons/1/episodes", [
            'episode_number' => 1,
            'title'          => 'Pilot',
        ], $headers)->assertStatus(201);

        $this->assertDatabaseHas('seasons', [
            'id'            => $season->id,
            'episode_count' => 1,
        ]);
    }

    public function test_episode_delete_decrements_season_episode_count(): void
    {
        ['headers' => $headers] = $this->actingAsUser();
        $series = Series::factory()->create();
        $season = Season::factory()->create([
            'series_id'     => $series->id,
            'season_number' => 1,
            'episode_count' => 3,
        ]);
        Episode::factory()->create([
            'series_id'      => $series->id,
            'season_id'      => $season->id,
            'episode_number' => 1,
        ]);

        $this->deleteJson("/api/v1/series/{$series->id}/seasons/1/episodes/1", [], $headers)
             ->assertStatus(200);

        $this->assertDatabaseHas('seasons', [
            'id'            => $season->id,
            'episode_count' => 2,
        ]);
    }
}
