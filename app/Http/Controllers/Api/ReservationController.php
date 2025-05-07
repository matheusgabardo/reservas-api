<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReservationController extends Controller
{
    // Método para criar uma reserva
    public function store(Request $request)
    {
        // Validação dos dados da reserva
        $request->validate([
            'room_id' => 'required|exists:rooms,id', // Verificar se a sala existe
            'reservation_date' => 'required|date',
            'reservation_time' => 'required|date_format:H:i', // Formato de hora (HH:mm)
            'status' => 'nullable|in:pendente,concluido,cancelado', // Status opcional, com valores possíveis
        ]);

        // Verificar se o usuário está autenticado
        if (Auth::check()) {
            // Criação da nova reserva
            $reservation = Reservation::create([
                'user_id' => Auth::id(), // Pega o ID do usuário autenticado
                'room_id' => $request->room_id,
                'reservation_date' => $request->reservation_date,
                'reservation_time' => $request->reservation_time,
                'status' => $request->status ?? 'pendente', // Se não passar status, assume 'pendente'
            ]);

            // Retornar a reserva criada com status 201
            return response()->json([
                'message' => 'Reserva criada com sucesso!',
                'reservation' => $reservation,
            ], 201);
        }

        // Caso o usuário não esteja autenticado
        return response()->json([
            'message' => 'Usuário não autenticado.',
        ], 401);
    }
}
