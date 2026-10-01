<?php

namespace App\Http\Controllers;

use App\Models\Guest;
use Illuminate\Http\Request;

class GuestController extends Controller
{
    // GET /api/guests
    public function index()
    {
        return response()->json(Guest::orderBy('name', 'asc')->get());
    }

    // POST /api/guests
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'           => 'required|string',
            'country'        => 'nullable|string',
            'phone'          => 'required|string',
            'email'          => 'nullable|email',
            'nic_passport'   => 'nullable|string',
            'tier'           => 'nullable|in:Platinum VIP,Gold VIP,Regular Guest',
            'preferred_room' => 'nullable|string',
            'notes'          => 'nullable|string',
        ]);

        $guest = Guest::create($validated);
        return response()->json($guest, 201);
    }

    // GET /api/guests/{guest}
    public function show(Guest $guest)
    {
        return response()->json($guest);
    }

    // PUT /api/guests/{guest}
    public function update(Request $request, Guest $guest)
    {
        $validated = $request->validate([
            'name'           => 'sometimes|string',
            'country'        => 'nullable|string',
            'phone'          => 'sometimes|string',
            'email'          => 'nullable|email',
            'nic_passport'   => 'nullable|string',
            'tier'           => 'nullable|in:Platinum VIP,Gold VIP,Regular Guest',
            'preferred_room' => 'nullable|string',
            'notes'          => 'nullable|string',
        ]);

        $guest->update($validated);
        return response()->json($guest);
    }

    // DELETE /api/guests/{guest}
    public function destroy(Guest $guest)
    {
        $guest->delete();
        return response()->json(['message' => 'Guest profile deleted successfully']);
    }
}
