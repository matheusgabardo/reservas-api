<?php

namespace Database\Seeders;

use App\Models\Reservation;
use App\Models\User;
use App\Models\Room;
use Illuminate\Database\Seeder;

class ReservationSeeder extends Seeder
{
    public function run()
    {
        // Criar algumas reservas com salas e usuários aleatórios
        Reservation::factory(10)->create(); // Gera 10 reservas aleatórias

        // Ou criar manualmente algumas reservas
        $user1 = User::first(); // Obtém o primeiro usuário
        $room1 = Room::first(); // Obtém a primeira sala

        Reservation::create([
            'reservation_date' => now()->addDays(1)->toDateString(), // Reserva para amanhã
            'reservation_time' => '14:00',
            'user_id' => $user1->id,
            'room_id' => $room1->id,
            'status' => 'pendente',
        ]);

        $user2 = User::skip(1)->first(); // Obtém o segundo usuário
        $room2 = Room::skip(1)->first(); // Obtém a segunda sala

        Reservation::create([
            'reservation_date' => now()->addDays(2)->toDateString(), // Reserva para depois de amanhã
            'reservation_time' => '16:00',
            'user_id' => $user2->id,
            'room_id' => $room2->id,
            'status' => 'concluido',
        ]);
    }
}
