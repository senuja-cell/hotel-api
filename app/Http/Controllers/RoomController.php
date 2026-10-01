<?php

namespace App\Http\Controllers;

use App\Models\Room;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    // GET /api/rooms
    public function index()
    {
        return response()->json(Room::orderBy('number', 'asc')->get());
    }

    // POST /api/rooms
    public function store(Request $request)
    {
        $validated = $request->validate([
            'number'    => 'required|string|unique:rooms,number',
            'type'      => 'required|string',
            'floor'     => 'nullable|string',
            'beds'      => 'nullable|string',
            'price'     => 'required|numeric|min:0',
            'status'    => 'nullable|in:Available,Occupied,Reserved,Cleaning',
            'amenities' => 'nullable|array',
        ]);

        $room = Room::create($validated);
        return response()->json($room, 201);
    }

    // GET /api/rooms/{room}
    public function show(Room $room)
    {
        return response()->json($room);
    }

    // PUT /api/rooms/{room}
    public function update(Request $request, Room $room)
    {
        $validated = $request->validate([
            'number'    => 'sometimes|string|unique:rooms,number,' . $room->id,
            'type'      => 'sometimes|string',
            'floor'     => 'nullable|string',
            'beds'      => 'nullable|string',
            'price'     => 'sometimes|numeric|min:0',
            'status'    => 'sometimes|in:Available,Occupied,Reserved,Cleaning',
            'guest'     => 'nullable|string',
            'amenities' => 'nullable|array',
        ]);

        $room->update($validated);
        return response()->json($room);
    }

    // DELETE /api/rooms/{room}
    public function destroy(Room $room)
    {
        $room->delete();
        return response()->json(['message' => 'Room deleted successfully']);
    }
}
