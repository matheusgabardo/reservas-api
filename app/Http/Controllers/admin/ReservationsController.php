<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Reservation;
use Illuminate\Http\Request;

class ReservationsController extends Controller
{
    public function index(Request $request)
    {
        $reservations = Reservation::with(['user', 'room'])->get();

        return view('admin.reservations', compact('reservations'));
    }
    // public function delete(Reservation $reservation)
    // {
    //     $reservationId = $reservation->id;
    //     $reservationDate = $reservation->reservation_date;
    //     $reservationTime = $reservation->reservation_time;

    //     // Excluindo a reserva
    //     $reservation->delete();
        
    //     // Exibindo mensagem de sucesso
    //     session()->flash('status', "Reserva {$reservationId} para o dia {$reservationDate} às {$reservationTime} foi removida com sucesso.");

    //     // Redirecionar de volta para a página de reservas
    //     return redirect()->route('admin.reservations');
    // }
    public function destroy(Reservation $reservation)
    {
        if ($reservation->status !== 'pendente') {
            session()->flash('status', "A reserva {$reservation->id} não pode ser cancelada.");
            return redirect()->route('admin.reservations');
        }

        $reservation->update(['status' => 'cancelado']);

        session()->flash('status', "Reserva {$reservation->id} cancelada com sucesso.");
        return redirect()->route('admin.reservations');
    }

}
