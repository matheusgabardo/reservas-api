<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Room;
use Illuminate\Http\Request;

class RoomsController extends Controller
{
    // Exibir salas
    public function index(Request $request)
    {
        $rooms = Room::all(); // Buscar todas as salas
        return view('admin.rooms', compact('rooms'));
    }

    // Criar nova sala
    public function store(Request $request)
    {
        $request->validate([
            'room_name' => 'required|string|max:255',
            'location_name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'capacity' => 'required|integer',
            'description' => 'nullable|string',
            'rating' => 'nullable|numeric|min:0|max:5',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Criar a nova sala
        $room = Room::create([
            'room_name' => $request->room_name,
            'location_name' => $request->location_name,
            'address' => $request->address,
            'capacity' => $request->capacity,
            'description' => $request->description,
            'rating' => $request->rating,
            'image' => $request->image ? $request->file('image')->store('rooms', 'public'): null, // Armazenando a imagem
        ]);

        return redirect()->route('admin.rooms')->with('status', 'Sala cadastrada com sucesso!');
    }
    
    public function destroy(Room $room)
    {
        $roomName = $room->room_name;

        $room->delete();
        
        session()->flash('status', "Sala {$roomName} removida com sucesso.");

        return redirect()->route('admin.rooms');
    }
}
