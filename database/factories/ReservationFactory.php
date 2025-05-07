<?php

namespace Database\Factories;

use App\Models\Reservation;
use App\Models\User;
use App\Models\Room;
use Illuminate\Database\Eloquent\Factories\Factory;

class ReservationFactory extends Factory
{
    protected $model = Reservation::class;

    public function definition()
    {
        return [
            'reservation_date' => $this->faker->date(),
            'reservation_time' => $this->faker->time(),
            'user_id' => User::inRandomOrder()->first()->id,
            'room_id' => Room::inRandomOrder()->first()->id,
            'status' => $this->faker->randomElement(['pendente', 'concluido', 'cancelado']),
        ];
    }
}
