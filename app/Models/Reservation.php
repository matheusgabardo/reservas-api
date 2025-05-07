<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * @OA\Schema(
 *     schema="Reservation",
 *     @OA\Property(property="id", type="integer"),
 *     @OA\Property(property="user_id", type="integer"),
 *     @OA\Property(property="room_id", type="integer"),
 *     @OA\Property(property="reservation_date", type="string", format="date"),
 *     @OA\Property(property="reservation_time", type="string"),
 *     @OA\Property(property="status", type="string", enum={"pendente","concluido","cancelado"}),
 *     @OA\Property(property="created_at", type="string", format="date-time"),
 *     @OA\Property(property="updated_at", type="string", format="date-time")
 * )
 */
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