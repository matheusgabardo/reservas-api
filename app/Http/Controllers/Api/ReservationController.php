<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReservationController extends Controller
{
    
    /**
     * @OA\Post(
     *     path="/api/v1/reservations",
     *     summary="Cria uma nova reserva",
     *     tags={"Reservas"},
     *     security={{ "sanctum": {} }},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"room_id","reservation_date","reservation_time"},
     *             @OA\Property(property="room_id", type="integer", example=1),
     *             @OA\Property(property="reservation_date", type="string", format="date", example="2025-12-12"),
     *             @OA\Property(property="reservation_time", type="string", example="14:30"),
     *             @OA\Property(property="status", type="string", enum={"pendente","concluido","cancelado"}, example="pendente")
     *         )
     *     ),
     *     @OA\Response(response=201, description="Reserva criada",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Reserva criada com sucesso!"),
     *             @OA\Property(property="reservation", ref="#/components/schemas/Reservation")
     *         )
     *     ),
     *     @OA\Response(response=401, description="Não autenticado")
     * )
     */

    public function store(Request $request)
    {
        $request->validate([
            'room_id' => 'required|exists:rooms,id',
            'reservation_date' => 'required|date',
            'reservation_time' => 'required|date_format:H:i',
            'status' => 'nullable|in:pendente,concluido,cancelado',
        ]);
        if (Auth::check()) {
            $reservation = Reservation::create([
                'user_id' => Auth::id(),
                'room_id' => $request->room_id,
                'reservation_date' => $request->reservation_date,
                'reservation_time' => $request->reservation_time,
                'status' => $request->status ?? 'pendente',
            ]);

            return response()->json([
                'message' => 'Reserva criada com sucesso!',
                'reservation' => $reservation,
            ], 201);
        }

        return response()->json([
            'message' => 'Usuário não autenticado.',
        ], 401);
    }
}
