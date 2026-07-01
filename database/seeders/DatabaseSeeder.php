<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create categories first
        $this->call(CategorySeeder::class);

        // Create or update admin user
        User::updateOrCreate(
            ['email' => 'admin@m3alam.com'],
            [
                'name' => 'Admin User',
                'password' => Hash::make('admin123'),
                'role' => 'admin',
                'status' => 'active',
                'is_verified' => true,
                'verified_at' => now(),
                'phone' => '+1234567890',
                'city' => 'Admin City',
            ]
        );

        // Create or update test user
        User::updateOrCreate(
            ['email' => 'test@example.com'],
            [
                'name' => 'Test User',
                'password' => Hash::make('password'),
                'role' => 'client',
                'status' => 'active',
                'phone' => '+1234567890',
                'city' => 'Test City',
            ]
        );
    }
}
