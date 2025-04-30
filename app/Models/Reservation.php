<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Reservation extends Model
{
    use HasFactory;

    protected $fillable = [
        'reservation_date',
        'reservation_time',
        'user_id',
        'room_id',
        'status',
    ];

    // Relacionamento com usuário
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relacionamento com sala
    public function room()
    {
        return $this->belongsTo(Room::class);
    }
}