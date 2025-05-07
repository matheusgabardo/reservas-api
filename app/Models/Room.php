<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * @OA\Schema(
 *     schema="Room",
 *     @OA\Property(property="id", type="integer"),
 *     @OA\Property(property="room_name", type="string"),
 *     @OA\Property(property="location_name", type="string"),
 *     @OA\Property(property="address", type="string"),
 *     @OA\Property(property="capacity", type="integer"),
 *     @OA\Property(property="description", type="string"),
 *     @OA\Property(property="rating", type="integer"),
 *     @OA\Property(property="image", type="string"),
 *     @OA\Property(property="created_at", type="string", format="date-time"),
 *     @OA\Property(property="updated_at", type="string", format="date-time")
 * )
 */
class Room extends Model
{
    use HasFactory;

    protected $fillable = [
        'room_name',
        'location_name',
        'address',
        'capacity',
        'description',
        'rating',
        'image',
    ];

    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }

}
