<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Proposition;
use App\Models\PropositionVote;
use App\Models\User;
use App\Http\Controllers\PropositionController;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PropositionVoteLogicTest extends TestCase
{
    use RefreshDatabase;

    public function test_toggle_vote_creates_new_upvote()
    {
        $user = User::factory()->create();
        $proposition = Proposition::factory()->create();
        
        // Mock the controller to access private toggleVote method
        $controller = new PropositionController();
        
        // Use reflection to access the private method
        $reflection = new \ReflectionClass($controller);
        $method = $reflection->getMethod('toggleVote');
        $method->setAccessible(true);
        
        $result = $method->invoke($controller, $proposition, $user->id, 'upvote');
        
        // Check the response
        $data = json_decode($result->getContent(), true);
        $this->assertEquals(['upvotes' => 1, 'downvotes' => 0], $data);
        
        // Verify database changes
        $this->assertDatabaseHas('proposition_votes', [
            'user_id' => $user->id,
            'proposition_id' => $proposition->id,
            'vote_type' => 'upvote'
        ]);
        
        $this->assertDatabaseHas('propositions', [
            'id' => $proposition->id,
            'upvotes' => 1,
            'downvotes' => 0
        ]);
    }

    public function test_toggle_vote_creates_new_downvote()
    {
        $user = User::factory()->create();
        $proposition = Proposition::factory()->create();
        
        // Mock the controller to access private toggleVote method
        $controller = new PropositionController();
        
        // Use reflection to access the private method
        $reflection = new \ReflectionClass($controller);
        $method = $reflection->getMethod('toggleVote');
        $method->setAccessible(true);
        
        $result = $method->invoke($controller, $proposition, $user->id, 'downvote');
        
        // Check the response
        $data = json_decode($result->getContent(), true);
        $this->assertEquals(['upvotes' => 0, 'downvotes' => 1], $data);
        
        // Verify database changes
        $this->assertDatabaseHas('proposition_votes', [
            'user_id' => $user->id,
            'proposition_id' => $proposition->id,
            'vote_type' => 'downvote'
        ]);
        
        $this->assertDatabaseHas('propositions', [
            'id' => $proposition->id,
            'upvotes' => 0,
            'downvotes' => 1
        ]);
    }

    public function test_toggle_vote_removes_upvote()
    {
        $user = User::factory()->create();
        $proposition = Proposition::factory()->create();
        
        // Create an existing upvote
        PropositionVote::create([
            'user_id' => $user->id,
            'proposition_id' => $proposition->id,
            'vote_type' => 'upvote'
        ]);
        $proposition->increment('upvotes');
        
        // Mock the controller to access private toggleVote method
        $controller = new PropositionController();
        
        // Use reflection to access the private method
        $reflection = new \ReflectionClass($controller);
        $method = $reflection->getMethod('toggleVote');
        $method->setAccessible(true);
        
        $result = $method->invoke($controller, $proposition, $user->id, 'upvote');
        
        // Check the response
        $data = json_decode($result->getContent(), true);
        $this->assertEquals(['upvotes' => 0, 'downvotes' => 0], $data);
        
        // Verify database changes
        $this->assertDatabaseMissing('proposition_votes', [
            'user_id' => $user->id,
            'proposition_id' => $proposition->id
        ]);
        
        $this->assertDatabaseHas('propositions', [
            'id' => $proposition->id,
            'upvotes' => 0,
            'downvotes' => 0
        ]);
    }

    public function test_toggle_vote_removes_downvote()
    {
        $user = User::factory()->create();
        $proposition = Proposition::factory()->create();
        
        // Create an existing downvote
        PropositionVote::create([
            'user_id' => $user->id,
            'proposition_id' => $proposition->id,
            'vote_type' => 'downvote'
        ]);
        $proposition->increment('downvotes');
        
        // Mock the controller to access private toggleVote method
        $controller = new PropositionController();
        
        // Use reflection to access the private method
        $reflection = new \ReflectionClass($controller);
        $method = $reflection->getMethod('toggleVote');
        $method->setAccessible(true);
        
        $result = $method->invoke($controller, $proposition, $user->id, 'downvote');
        
        // Check the response
        $data = json_decode($result->getContent(), true);
        $this->assertEquals(['upvotes' => 0, 'downvotes' => 0], $data);
        
        // Verify database changes
        $this->assertDatabaseMissing('proposition_votes', [
            'user_id' => $user->id,
            'proposition_id' => $proposition->id
        ]);
        
        $this->assertDatabaseHas('propositions', [
            'id' => $proposition->id,
            'upvotes' => 0,
            'downvotes' => 0
        ]);
    }

    public function test_toggle_vote_switches_from_upvote_to_downvote()
    {
        $user = User::factory()->create();
        $proposition = Proposition::factory()->create();
        
        // Create an existing upvote
        PropositionVote::create([
            'user_id' => $user->id,
            'proposition_id' => $proposition->id,
            'vote_type' => 'upvote'
        ]);
        $proposition->increment('upvotes');
        
        // Mock the controller to access private toggleVote method
        $controller = new PropositionController();
        
        // Use reflection to access the private method
        $reflection = new \ReflectionClass($controller);
        $method = $reflection->getMethod('toggleVote');
        $method->setAccessible(true);
        
        $result = $method->invoke($controller, $proposition, $user->id, 'downvote');
        
        // Check the response
        $data = json_decode($result->getContent(), true);
        $this->assertEquals(['upvotes' => 0, 'downvotes' => 1], $data);
        
        // Verify database changes
        $this->assertDatabaseHas('proposition_votes', [
            'user_id' => $user->id,
            'proposition_id' => $proposition->id,
            'vote_type' => 'downvote'
        ]);
        
        $this->assertDatabaseHas('propositions', [
            'id' => $proposition->id,
            'upvotes' => 0,
            'downvotes' => 1
        ]);
    }

    public function test_toggle_vote_switches_from_downvote_to_upvote()
    {
        $user = User::factory()->create();
        $proposition = Proposition::factory()->create();
        
        // Create an existing downvote
        PropositionVote::create([
            'user_id' => $user->id,
            'proposition_id' => $proposition->id,
            'vote_type' => 'downvote'
        ]);
        $proposition->increment('downvotes');
        
        // Mock the controller to access private toggleVote method
        $controller = new PropositionController();
        
        // Use reflection to access the private method
        $reflection = new \ReflectionClass($controller);
        $method = $reflection->getMethod('toggleVote');
        $method->setAccessible(true);
        
        $result = $method->invoke($controller, $proposition, $user->id, 'upvote');
        
        // Check the response
        $data = json_decode($result->getContent(), true);
        $this->assertEquals(['upvotes' => 1, 'downvotes' => 0], $data);
        
        // Verify database changes
        $this->assertDatabaseHas('proposition_votes', [
            'user_id' => $user->id,
            'proposition_id' => $proposition->id,
            'vote_type' => 'upvote'
        ]);
        
        $this->assertDatabaseHas('propositions', [
            'id' => $proposition->id,
            'upvotes' => 1,
            'downvotes' => 0
        ]);
    }
}