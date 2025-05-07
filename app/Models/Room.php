<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


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
