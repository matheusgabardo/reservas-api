<?php

namespace Database\Seeders;

use App\Models\Room;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@mail.dev',
            'role' => 'admin',
            'password' => 'password',
        ]);
        User::factory()->create([
            'name' => 'user',
            'email' => 'user@mail.dev',
            'role' => 'user',
            'password' => 'password',
        ]);
        User::factory()->create([
            'name' => 'user 2',
            'email' => 'user2@mail.dev',
            'role' => 'user',
            'password' => 'password',
        ]);
        
        Room::factory()->count(5)->create();
    }
}