<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Room;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/v1/rooms",
     *     summary="Lista todas as salas",
     *     tags={"Salas"},
     *     security={{ "sanctum": {} }},
     *     @OA\Response(response=200, description="Lista de salas",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(ref="#/components/schemas/Room")
     *         )
     *     )
     * )
     */
    public function index()
    {
        $rooms = Room::all();
        return response()->json($rooms);
    }
}
