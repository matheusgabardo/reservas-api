<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Reservation;
use Illuminate\Http\JsonResponse;
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
     *     @OA\Response(response=401, description="Não autenticado",
     *         @OA\JsonContent(@OA\Property(property="message", type="string", example="Usuário não autenticado."))
     *     ),
     *     @OA\Response(response=422, description="Conflito de reserva",
     *         @OA\JsonContent(@OA\Property(property="message", type="string", example="Esta sala já está reservada para a data informada."))
     *     )
     * )
     */
    public function store(Request $request){
        $request->validate([
            'room_id'           => 'required|exists:rooms,id',
            'reservation_date'  => 'required|date',
            'reservation_time'  => 'required|date_format:H:i',
            'status'            => 'nullable|in:pendente,concluido,cancelado',
        ], [
            'room_id.required' => 'O campo sala é obrigatório.',
            'room_id.exists' => 'A sala selecionada não existe.',
            
            'reservation_date.required' => 'A data da reserva é obrigatória.',
            'reservation_date.date' => 'A data informada não é válida.',
        
            'reservation_time.required' => 'O horário da reserva é obrigatório.',
            'reservation_time.date_format' => 'O horário deve estar no formato HH:MM (ex: 14:30).',
        
            'status.in' => 'O status deve ser pendente, concluído ou cancelado.',
        ]);
        
    
        if (!Auth::check()) {
            return response()->json([
                'message' => 'Usuário não autenticado.',
            ], 401);
        }
    
        $userId = Auth::id();
        $roomId = $request->room_id;
        $date   = $request->reservation_date;
    
        $userHasActive = Reservation::where('user_id', $userId)
            ->where('status', 'pendente')
            ->exists();
    
        if ($userHasActive) {
            return response()->json([
                'message' => 'Você já possui uma reserva ativa no sistema.',
            ], 422);
        }
    
        $roomBooked = Reservation::where('room_id', $roomId)
            ->where('reservation_date', $date)
            ->where('status', 'pendente')
            ->exists();
    
        if ($roomBooked) {
            return response()->json([
                'message' => 'Esta sala já está reservada para a data informada.',
            ], 422);
        }
    
        $reservation = Reservation::create([
            'user_id'           => $userId,
            'room_id'           => $roomId,
            'reservation_date'  => $date,
            'reservation_time'  => $request->reservation_time,
            'status'            => $request->status ?? 'pendente',
        ]);
    
        return response()->json([
            'message'      => 'Reserva criada com sucesso!',
            'reservation' => $reservation,
        ], 201);
    }
    
    /**
     * @OA\Get(
     *     path="/api/v1/reservations/active",
     *     summary="Verifica se o usuário possui reserva ativa",
     *     tags={"Reservas"},
     *     security={{ "sanctum": {} }},
     *     @OA\Response(response=200, description="Nenhuma reserva ativa encontrada",
     *         @OA\JsonContent(@OA\Property(property="message", type="string", example="Nenhuma reserva ativa encontrada."))
     *     ),
     *     @OA\Response(response=401, description="Não autenticado",
     *         @OA\JsonContent(@OA\Property(property="message", type="string", example="Usuário não autenticado."))
     *     ),
     *     @OA\Response(response=422, description="Reserva ativa existente",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Você já possui uma reserva ativa no sistema."),
     *             @OA\Property(property="reservation", ref="#/components/schemas/Reservation")
     *         )
     *     )
     * )
     */
    public function active(Request $request)
    {
        if (! Auth::check()) {
            return response()->json([
                'message' => 'Usuário não autenticado.',
            ], 401);
        }

        $userId = Auth::id();

        $active = Reservation::where('user_id', $userId)
            ->where('status', 'pendente')
            ->first();

        if ($active) {
            return response()->json([
                'message'     => 'Você já possui uma reserva ativa no sistema.',
                'reservation' => $active,
            ], 422);
        }

        return response()->json([
            'message'   => 'Nenhuma reserva ativa encontrada.',
        ], 200);
    }

    /**
     * Cancela uma reserva pendente do usuário.
     *
     * @OA\Post(
     *     path="/api/v1/reservations/cancel",
     *     summary="Cancela uma reserva existente",
     *     tags={"Reservas"},
     *     security={{ "sanctum": {} }},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"id"},
     *             @OA\Property(property="id", type="integer", example=9)
     *         )
     *     ),
     *     @OA\Response(response=200, description="Reserva cancelada",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Reserva cancelada com sucesso!"),
     *             @OA\Property(property="reservation", ref="#/components/schemas/Reservation")
     *         )
     *     ),
     *     @OA\Response(response=401, description="Não autenticado"),
     *     @OA\Response(response=403, description="Reserva não pertence ao usuário ou já não está pendente")
     * )
     */
    public function cancel(Request $request)
    {
        $request->validate([
            'id' => 'required|integer|exists:reservations,id',
        ]);

        if (! Auth::check()) {
            return response()->json([
                'message' => 'Usuário não autenticado.',
            ], 401);
        }

        $reservation = Reservation::find($request->id);

        // Verifica se a reserva pertence ao usuário e está pendente
        if ($reservation->user_id !== Auth::id() || $reservation->status !== 'pendente') {
            return response()->json([
                'message' => 'Não autorizado a cancelar esta reserva.',
            ], 403);
        }

        $reservation->status = 'cancelado';
        $reservation->save();

        return response()->json([
            'message'      => 'Reserva cancelada com sucesso!',
            'reservation' => $reservation,
        ], 200);
    }
}