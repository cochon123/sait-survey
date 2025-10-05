<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create admin user
        User::factory()->create([
            'name' => 'Admin User',
            'nickname' => 'admin',
            'email' => 'admin@sait.ca',
            'is_admin' => true,
            'profile_completed' => true,
        ]);

        // Create test user
        User::factory()->create([
            'name' => 'Test User',
            'nickname' => 'test_user',
            'email' => 'test@example.com',
            'profile_completed' => true,
        ]);

        $this->call([
            PropositionSeeder::class,
        ]);
    }
}
