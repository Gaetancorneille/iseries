<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Series;
use App\Models\Article;
use App\Models\Actor;
use App\Models\User;

class SearchTest extends TestCase
{
    public function test_search_requires_query_param(): void
    {
        $this->getJson('/api/v1/search')
             ->assertStatus(422)
             ->assertJsonValidationErrors(['q']);
    }

    public function test_search_requires_minimum_2_characters(): void
    {
        $this->getJson('/api/v1/search?q=a')
             ->assertStatus(422)
             ->assertJsonValidationErrors(['q']);
    }

    public function test_search_returns_series_results(): void
    {
        Series::factory()->create(['title' => 'Breaking Bad', 'is_active' => true]);
        Series::factory()->create(['title' => 'Game of Thrones', 'is_active' => true]);

        $response = $this->getJson('/api/v1/search?q=Breaking')
                         ->assertStatus(200);

        $this->assertCount(1, $response->json('results.series'));
        $this->assertEquals('Breaking Bad', $response->json('results.series.0.title'));
    }

    public function test_search_returns_article_results(): void
    {
        $author = User::factory()->create();
        Article::factory()->create([
            'title'        => 'Analyse de Breaking Bad',
            'author_id'    => $author->id,
            'published_at' => now()->subDay(),
        ]);

        $response = $this->getJson('/api/v1/search?q=Breaking')
                         ->assertStatus(200);

        $this->assertCount(1, $response->json('results.articles'));
    }

    public function test_search_returns_actor_results(): void
    {
        Actor::factory()->create(['name' => 'Bryan Cranston']);

        $response = $this->getJson('/api/v1/search?q=Bryan')
                         ->assertStatus(200);

        $this->assertCount(1, $response->json('results.actors'));
        $this->assertEquals('Bryan Cranston', $response->json('results.actors.0.name'));
    }

    public function test_search_can_filter_by_type_series(): void
    {
        $author = User::factory()->create();
        Series::factory()->create(['title' => 'Breaking Bad', 'is_active' => true]);
        Article::factory()->create([
            'title'        => 'Breaking Bad Review',
            'author_id'    => $author->id,
            'published_at' => now()->subDay(),
        ]);

        $response = $this->getJson('/api/v1/search?q=Breaking&type=series')
                         ->assertStatus(200);

        $this->assertCount(1, $response->json('results.series'));
        $this->assertArrayNotHasKey('articles', $response->json('results'));
    }

    public function test_search_returns_zero_total_when_no_match(): void
    {
        $response = $this->getJson('/api/v1/search?q=xyznotfound')
                         ->assertStatus(200);

        $this->assertEquals(0, $response->json('total'));
    }

    public function test_search_returns_correct_structure(): void
    {
        $response = $this->getJson('/api/v1/search?q=test')
                         ->assertStatus(200)
                         ->assertJsonStructure([
                             'query',
                             'type',
                             'total',
                             'results' => ['series', 'articles', 'actors'],
                         ]);
    }

    public function test_search_rejects_invalid_type(): void
    {
        $this->getJson('/api/v1/search?q=test&type=invalid')
             ->assertStatus(422)
             ->assertJsonValidationErrors(['type']);
    }
}
