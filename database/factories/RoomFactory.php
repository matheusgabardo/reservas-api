<?php

namespace Database\Factories;

use App\Models\Room;
use Illuminate\Database\Eloquent\Factories\Factory;

class RoomFactory extends Factory
{
    protected $model = Room::class;

    public function definition()
    {
        return [
            'room_name' => $this->faker->word,
            'address' => $this->faker->address,
            'capacity' => $this->faker->numberBetween(1, 50),
            'description' => $this->faker->sentence,
            'rating' => $this->faker->numberBetween(1, 5),
            'image' => $this->faker->imageUrl(640, 480, 'business', true),
        ];
    }
}
