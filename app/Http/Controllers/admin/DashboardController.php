<?php

namespace App\Http\Controllers\admin;
namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Reservation;
use App\Models\Room;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        // 1. Reserva por status (pie)
        $byStatus = Reservation::selectRaw('status, count(*) as total')
            ->groupBy('status')
            ->pluck('total','status');

        // 2. Reservas nos últimos 7 dias (line)
        $last7 = collect();
        for ($i = 6; $i >= 0; $i--) {
            $date = Carbon::today()->subDays($i)->toDateString();
            $count = Reservation::whereDate('reservation_date', $date)->count();
            $last7->push(['date' => $date, 'count' => $count]);
        }

        // 3. Top 5 salas mais reservadas (bar)
        $topRooms = Reservation::selectRaw('room_id, count(*) as total')
            ->groupBy('room_id')
            ->orderByDesc('total')
            ->take(5)
            ->get()
            ->map(function($r){
                return [
                    'name'  => $r->room->room_name,
                    'total' => $r->total,
                ];
            });

        // 4. Novos usuários últimos 7 dias (line)
        $newUsers = collect();
        for ($i = 6; $i >= 0; $i--) {
            $date = Carbon::today()->subDays($i)->toDateString();
            $count = User::whereDate('created_at', $date)->count();
            $newUsers->push(['date' => $date, 'count' => $count]);
        }

        return view('admin.dashboard', compact('byStatus','last7','topRooms','newUsers'));
    }
}
