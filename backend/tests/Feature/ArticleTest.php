<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Article;
use App\Models\User;

class ArticleTest extends TestCase
{
    // ── Lecture publique ──────────────────────────────────────────────────────

    public function test_anyone_can_list_published_articles(): void
    {
        $author = User::factory()->create();
        Article::factory()->count(3)->create([
            'author_id'    => $author->id,
            'published_at' => now()->subDay(),
        ]);
        // Article non publié : ne doit PAS apparaître
        Article::factory()->create([
            'author_id'    => $author->id,
            'published_at' => now()->addDay(),
        ]);

        $this->getJson('/api/v1/articles')
             ->assertStatus(200)
             ->assertJsonPath('total', 3);
    }

    public function test_anyone_can_view_a_single_published_article(): void
    {
        $author  = User::factory()->create();
        $article = Article::factory()->create([
            'author_id'    => $author->id,
            'published_at' => now()->subDay(),
        ]);

        $this->getJson("/api/v1/articles/{$article->id}")
             ->assertStatus(200)
             ->assertJsonPath('id', $article->id)
             ->assertJsonPath('title', $article->title);
    }

    public function test_get_nonexistent_article_returns_404(): void
    {
        $this->getJson('/api/v1/articles/9999')
             ->assertStatus(404);
    }

    // ── Création ──────────────────────────────────────────────────────────────

    public function test_authenticated_user_can_create_article(): void
    {
        ['headers' => $headers] = $this->actingAsUser();

        $this->postJson('/api/v1/articles', [
            'title'        => 'Mon premier article',
            'content'      => 'Un contenu de test pour cet article.',
            'published_at' => now()->toDateTimeString(),
        ], $headers)
             ->assertStatus(201)
             ->assertJsonPath('title', 'Mon premier article');

        $this->assertDatabaseHas('articles', ['title' => 'Mon premier article']);
    }

    public function test_article_author_is_set_to_authenticated_user(): void
    {
        ['user' => $user, 'headers' => $headers] = $this->actingAsUser();

        $response = $this->postJson('/api/v1/articles', [
            'title'   => 'Article auteur',
            'content' => 'Contenu.',
        ], $headers)->assertStatus(201);

        $this->assertEquals($user->id, $response->json('author_id'));
    }

    public function test_unauthenticated_user_cannot_create_article(): void
    {
        $this->postJson('/api/v1/articles', [
            'title'   => 'Tentative',
            'content' => 'Contenu.',
        ])->assertStatus(401);
    }

    public function test_create_article_fails_without_required_fields(): void
    {
        ['headers' => $headers] = $this->actingAsUser();

        $this->postJson('/api/v1/articles', [], $headers)
             ->assertStatus(422)
             ->assertJsonValidationErrors(['title', 'content']);
    }

    // ── Mise à jour ───────────────────────────────────────────────────────────

    public function test_author_can_update_own_article(): void
    {
        ['user' => $user, 'headers' => $headers] = $this->actingAsUser();

        $article = Article::factory()->create(['author_id' => $user->id]);

        $this->putJson("/api/v1/articles/{$article->id}", [
            'title' => 'Titre modifié',
        ], $headers)
             ->assertStatus(200)
             ->assertJsonPath('title', 'Titre modifié');
    }

    public function test_user_cannot_update_another_users_article(): void
    {
        ['headers' => $ownerHeaders, 'user' => $owner] = $this->actingAsUser();
        ['headers' => $otherHeaders]                    = $this->actingAsUser();

        $article = Article::factory()->create(['author_id' => $owner->id]);

        $this->putJson("/api/v1/articles/{$article->id}", [
            'title' => 'Tentative de vol',
        ], $otherHeaders)
             ->assertStatus(403);
    }

    // ── Suppression ───────────────────────────────────────────────────────────

    public function test_author_can_delete_own_article(): void
    {
        ['user' => $user, 'headers' => $headers] = $this->actingAsUser();
        $article = Article::factory()->create(['author_id' => $user->id]);

        $this->deleteJson("/api/v1/articles/{$article->id}", [], $headers)
             ->assertStatus(200)
             ->assertJsonPath('message', 'Article deleted successfully');

        $this->assertDatabaseMissing('articles', ['id' => $article->id]);
    }

    public function test_user_cannot_delete_another_users_article(): void
    {
        ['user' => $owner]   = $this->actingAsUser();
        ['headers' => $other] = $this->actingAsUser();

        $article = Article::factory()->create(['author_id' => $owner->id]);

        $this->deleteJson("/api/v1/articles/{$article->id}", [], $other)
             ->assertStatus(403);

        $this->assertDatabaseHas('articles', ['id' => $article->id]);
    }
}
