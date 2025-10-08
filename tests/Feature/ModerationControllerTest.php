<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ModerationControllerTest extends TestCase
{
    use RefreshDatabase;

    protected User $user;

    protected function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create();
    }

    public function test_nickname_moderation_endpoint()
    {
        $response = $this->actingAs($this->user)
            ->postJson('/moderation/nickname', [
                'nickname' => 'TestUser123'
            ]);

        $response->assertStatus(200)
            ->assertJsonStructure([
                'approved',
                'reason'
            ]);
    }

    public function test_proposition_moderation_endpoint()
    {
        $response = $this->actingAs($this->user)
            ->postJson('/moderation/proposition', [
                'content' => 'Nous devrions avoir de meilleurs horaires pour la bibliothèque.'
            ]);

        $response->assertStatus(200)
            ->assertJsonStructure([
                'approved',
                'reason'
            ]);
    }

    public function test_comment_moderation_endpoint()
    {
        $response = $this->actingAs($this->user)
            ->postJson('/moderation/comment', [
                'content' => 'Je suis d\'accord avec cette proposition.'
            ]);

        $response->assertStatus(200)
            ->assertJsonStructure([
                'approved',
                'reason'
            ]);
    }

    public function test_moderation_requires_authentication()
    {
        $response = $this->postJson('/moderation/nickname', [
            'nickname' => 'TestUser'
        ]);

        $response->assertStatus(401);
    }

    public function test_validation_errors()
    {
        $response = $this->actingAs($this->user)
            ->postJson('/moderation/nickname', []);

        $response->assertStatus(422)
            ->assertJsonValidationErrors(['nickname']);
    }
}