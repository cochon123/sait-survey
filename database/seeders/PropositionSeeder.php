<?php

namespace Database\Seeders;

use App\Models\Proposition;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PropositionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::all();

        if ($users->isEmpty()) {
            // Create some test users if none exist
            $users = collect([
                User::factory()->create(['name' => 'Alice Johnson', 'email' => 'alice@example.com']),
                User::factory()->create(['name' => 'Bob Smith', 'email' => 'bob@example.com']),
                User::factory()->create(['name' => 'Charlie Brown', 'email' => 'charlie@example.com']),
                User::factory()->create(['name' => 'Diana Prince', 'email' => 'diana@example.com']),
            ]);
        }

        $propositions = [
            [
                'content' => 'Add more study spaces in the library with better lighting and comfortable seating.',
                'status' => 'one',
                'upvotes' => 15,
                'downvotes' => 2,
            ],
            [
                'content' => 'Implement a campus-wide recycling program with clearly marked bins in every building.',
                'status' => 'ready',
                'upvotes' => 23,
                'downvotes' => 1,
            ],
            [
                'content' => 'Create more affordable parking options for students, including discounted monthly passes.',
                'status' => 'two',
                'upvotes' => 18,
                'downvotes' => 5,
            ],
            [
                'content' => 'Expand the food options in the cafeteria with healthier choices and vegetarian/vegan alternatives.',
                'status' => 'zero',
                'upvotes' => 12,
                'downvotes' => 3,
            ],
            [
                'content' => 'Add more computer labs with the latest software and equipment for design and engineering students.',
                'status' => 'one',
                'upvotes' => 20,
                'downvotes' => 4,
            ],
            [
                'content' => 'Improve WiFi coverage throughout the campus, especially in outdoor areas and older buildings.',
                'status' => 'ready',
                'upvotes' => 28,
                'downvotes' => 2,
            ],
            [
                'content' => 'Create mentorship programs where upper-year students can guide first-year students.',
                'status' => 'zero',
                'upvotes' => 16,
                'downvotes' => 1,
            ],
            [
                'content' => 'Add more bike racks and improve bike path safety on campus.',
                'status' => 'two',
                'upvotes' => 14,
                'downvotes' => 6,
            ],
        ];

        foreach ($propositions as $index => $propData) {
            Proposition::create([
                'user_id' => $users->random()->id,
                'content' => $propData['content'],
                'status' => $propData['status'],
                'upvotes' => $propData['upvotes'],
                'downvotes' => $propData['downvotes'],
            ]);
        }
    }
}
