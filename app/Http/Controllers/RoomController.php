<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\Guest;
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

    // POST /api/check-in
    public function checkIn(Request $request)
    {
        $validated = $request->validate([
            'room_number'  => 'required|string',
            'guest_name'   => 'required|string',
            'phone'        => 'required|string',
            'nic_passport' => 'required|string',
            'nationality'  => 'nullable|string',
            'advance_paid' => 'nullable|numeric',
        ]);

        $room = Room::where('number', $validated['room_number'])->firstOrFail();
        $room->update([
            'status' => 'Occupied',
            'guest'  => $validated['guest_name'],
        ]);

        // Automatically register or update guest in CRM database
        Guest::updateOrCreate(
            ['phone' => $validated['phone']],
            [
                'name'           => $validated['guest_name'],
                'nic_passport'   => $validated['nic_passport'],
                'country'        => $validated['nationality'] ?? 'Sri Lanka',
                'preferred_room' => $room->type,
            ]
        );

        return response()->json([
            'message' => 'Check-in successful',
            'room'    => $room
        ]);
    }

    // POST /api/check-out
    public function checkOut(Request $request)
    {
        $validated = $request->validate([
            'room_number' => 'required|string',
        ]);

        $room = Room::where('number', $validated['room_number'])->firstOrFail();
        $room->update([
            'status' => 'Cleaning',
            'guest'  => null,
        ]);

        return response()->json([
            'message' => 'Check-out successful. Room marked for housekeeping.',
            'room'    => $room
        ]);
    }
}
