<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Services\ContentModerationService;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ContentModerationServiceTest extends TestCase
{
    use RefreshDatabase;

    protected ContentModerationService $moderationService;

    protected function setUp(): void
    {
        parent::setUp();
        $this->moderationService = new ContentModerationService();
    }

    public function test_moderate_safe_nickname()
    {
        $result = $this->moderationService->moderateNickname('JohnDoe123');
        
        $this->assertIsArray($result);
        $this->assertArrayHasKey('approved', $result);
        $this->assertArrayHasKey('reason', $result);
        $this->assertIsBool($result['approved']);
    }

    public function test_moderate_safe_proposition()
    {
        $result = $this->moderationService->moderateProposition(
            'Améliorer la cafétéria',
            'Je pense qu\'on devrait avoir plus d\'options végétariennes à la cafétéria.'
        );
        
        $this->assertIsArray($result);
        $this->assertArrayHasKey('approved', $result);
        $this->assertArrayHasKey('reason', $result);
    }

    public function test_moderate_safe_comment()
    {
        $result = $this->moderationService->moderateComment(
            'Excellente idée, je suis d\'accord !'
        );
        
        $this->assertIsArray($result);
        $this->assertArrayHasKey('approved', $result);
        $this->assertArrayHasKey('reason', $result);
    }

    public function test_moderate_potentially_unsafe_content()
    {
        $result = $this->moderationService->moderateComment(
            'Ce truc est vraiment nul et stupide'
        );
        
        $this->assertIsArray($result);
        $this->assertArrayHasKey('approved', $result);
        $this->assertArrayHasKey('reason', $result);
        // Le service devrait être permissif pour les critiques constructives
    }
}