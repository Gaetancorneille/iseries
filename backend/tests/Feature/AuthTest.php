<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;

class AuthTest extends TestCase
{
    // ── Register ─────────────────────────────────────────────────────────────

    public function test_user_can_register_with_valid_data(): void
    {
        $response = $this->postJson('/api/v1/register', [
            'name'                  => 'Gaetan Test',
            'email'                 => 'gaetan@test.com',
            'nickname'              => 'gaetan',
            'password'              => 'secret123',
            'password_confirmation' => 'secret123',
        ]);

        $response->assertStatus(201)
                 ->assertJsonStructure(['user', 'token', 'token_type', 'expires_in'])
                 ->assertJsonPath('user.email', 'gaetan@test.com');

        $this->assertDatabaseHas('users', ['email' => 'gaetan@test.com']);
    }

    public function test_register_fails_when_email_already_taken(): void
    {
        User::factory()->create(['email' => 'existing@test.com']);

        $response = $this->postJson('/api/v1/register', [
            'name'                  => 'Autre',
            'email'                 => 'existing@test.com',
            'nickname'              => 'autre',
            'password'              => 'secret123',
            'password_confirmation' => 'secret123',
        ]);

        $response->assertStatus(422);
    }

    public function test_register_fails_when_nickname_already_taken(): void
    {
        User::factory()->create(['nickname' => 'taken']);

        $response = $this->postJson('/api/v1/register', [
            'name'                  => 'Autre',
            'email'                 => 'autre@test.com',
            'nickname'              => 'taken',
            'password'              => 'secret123',
            'password_confirmation' => 'secret123',
        ]);

        $response->assertStatus(422);
    }

    public function test_register_fails_when_passwords_do_not_match(): void
    {
        $response = $this->postJson('/api/v1/register', [
            'name'                  => 'Test',
            'email'                 => 'test@test.com',
            'nickname'              => 'testuser',
            'password'              => 'secret123',
            'password_confirmation' => 'wrongpassword',
        ]);

        $response->assertStatus(422);
    }

    // ── Login ─────────────────────────────────────────────────────────────────

    public function test_user_can_login_with_correct_credentials(): void
    {
        User::factory()->create([
            'nickname' => 'testuser',
            'password' => bcrypt('secret123'),
        ]);

        $response = $this->postJson('/api/v1/login', [
            'nickname' => 'testuser',
            'password' => 'secret123',
        ]);

        $response->assertStatus(200)
                 ->assertJsonStructure(['user', 'token', 'token_type', 'expires_in']);
    }

    public function test_login_fails_with_wrong_password(): void
    {
        User::factory()->create([
            'nickname' => 'testuser',
            'password' => bcrypt('correct_password'),
        ]);

        $response = $this->postJson('/api/v1/login', [
            'nickname' => 'testuser',
            'password' => 'wrong_password',
        ]);

        $response->assertStatus(401)
                 ->assertJsonPath('error', 'Invalid credentials');
    }

    public function test_login_fails_with_nonexistent_user(): void
    {
        $response = $this->postJson('/api/v1/login', [
            'nickname' => 'ghost',
            'password' => 'anypassword',
        ]);

        $response->assertStatus(401);
    }

    // ── Logout & Me ───────────────────────────────────────────────────────────

    public function test_authenticated_user_can_logout(): void
    {
        ['headers' => $headers] = $this->actingAsUser();

        $this->postJson('/api/v1/logout', [], $headers)
             ->assertStatus(200)
             ->assertJsonPath('message', 'Successfully logged out');
    }

    public function test_unauthenticated_user_cannot_logout(): void
    {
        $this->postJson('/api/v1/logout')
             ->assertStatus(401);
    }

    public function test_me_returns_authenticated_user(): void
    {
        ['user' => $user, 'headers' => $headers] = $this->actingAsUser();

        $this->getJson('/api/v1/me', $headers)
             ->assertStatus(200)
             ->assertJsonPath('email', $user->email);
    }

    public function test_me_requires_authentication(): void
    {
        $this->getJson('/api/v1/me')
             ->assertStatus(401);
    }
}
