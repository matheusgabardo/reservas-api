<?php

namespace Database\Seeders;

use App\Models\Room;
use App\Models\User;
use App\Models\Reservation;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Criando usuários
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
        
        // Criando salas
        Room::factory()->count(5)->create();

        // Criando reservas associadas aos usuários e salas
        Reservation::factory(10)->create(); // Cria 10 reservas aleatórias

        // Ou criando algumas manualmente para garantir o controle
        $user1 = User::first(); // Obtém o primeiro usuário
        $room1 = Room::first(); // Obtém a primeira sala

        Reservation::create([
            'reservation_date' => now()->addDays(1)->toDateString(),
            'reservation_time' => '14:00',
            'user_id' => $user1->id,
            'room_id' => $room1->id,
            'status' => 'pendente',
        ]);

        $user2 = User::skip(1)->first(); // Obtém o segundo usuário
        $room2 = Room::skip(1)->first(); // Obtém a segunda sala

        Reservation::create([
            'reservation_date' => now()->addDays(2)->toDateString(),
            'reservation_time' => '16:00',
            'user_id' => $user2->id,
            'room_id' => $room2->id,
            'status' => 'concluido',
        ]);
    }
}
