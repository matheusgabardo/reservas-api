<?php

namespace Database\Seeders;

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
            'password' => 'password',
        ]);
        User::factory()->create([
            'name' => 'Admin 2',
            'email' => 'admin2@mail.dev',
            'password' => 'password',
        ]);
        User::factory()->create([
            'name' => 'Admin 3',
            'email' => 'admin3@mail.dev',
            'password' => 'password',
        ]);
    }
}