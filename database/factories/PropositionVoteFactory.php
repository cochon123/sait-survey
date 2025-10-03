<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Proposition;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PropositionVote>
 */
class PropositionVoteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'proposition_id' => Proposition::factory(),
            'vote_type' => $this->faker->randomElement(['upvote', 'downvote']),
        ];
    }
}