<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Room;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    // Método para listar todas as salas
    public function index()
    {
        $rooms = Room::all();
        return response()->json($rooms);
    }
}
