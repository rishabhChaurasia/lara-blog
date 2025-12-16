<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create admin user
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
            'bio' => 'Administrator of the blog platform',
            'email_verified_at' => now(),
        ]);

        // Create author user
        User::create([
            'name' => 'Author User',
            'email' => 'author@example.com',
            'password' => Hash::make('password'),
            'role' => 'author',
            'bio' => 'Content creator and blogger',
            'email_verified_at' => now(),
        ]);

        // Create normal user
        User::create([
            'name' => 'Normal User',
            'email' => 'user@example.com',
            'password' => Hash::make('password'),
            'role' => 'user',
            'bio' => 'Regular blog reader and commenter',
            'email_verified_at' => now(),
        ]);

        // Create additional users using factory
        User::factory()->count(10)->create();
    }
}