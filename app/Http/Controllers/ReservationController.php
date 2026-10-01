<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    // GET /api/reservations
    public function index()
    {
        return response()->json(Reservation::orderBy('created_at', 'desc')->get());
    }

    // POST /api/reservations
    public function store(Request $request)
    {
        $validated = $request->validate([
            'booking_code'   => 'nullable|string|unique:reservations,booking_code',
            'guest'          => 'required|string',
            'phone'          => 'required|string',
            'email'          => 'nullable|email',
            'room_number'    => 'required|string',
            'room_type'      => 'required|string',
            'check_in'       => 'required|date',
            'check_out'      => 'required|date|after_or_equal:check_in',
            'nights'         => 'required|integer|min:1',
            'total'          => 'required|numeric|min:0',
            'status'         => 'nullable|in:Confirmed,Pending,Cancelled,Checked In',
            'payment_status' => 'nullable|in:Paid,Deposit Paid,Unpaid,Refunded',
            'guests_count'   => 'nullable|integer|min:1',
        ]);

        if (empty($validated['booking_code'])) {
            $validated['booking_code'] = 'RC-' . rand(1000, 9999);
        }

        $reservation = Reservation::create($validated);
        return response()->json($reservation, 201);
    }

    // GET /api/reservations/{reservation}
    public function show(Reservation $reservation)
    {
        return response()->json($reservation);
    }

    // PUT /api/reservations/{reservation}
    public function update(Request $request, Reservation $reservation)
    {
        $validated = $request->validate([
            'status'         => 'sometimes|in:Confirmed,Pending,Cancelled,Checked In',
            'payment_status' => 'sometimes|in:Paid,Deposit Paid,Unpaid,Refunded',
        ]);

        $reservation->update($validated);
        return response()->json($reservation);
    }

    // DELETE /api/reservations/{reservation}
    public function destroy(Reservation $reservation)
    {
        $reservation->delete();
        return response()->json(['message' => 'Reservation deleted successfully']);
    }
}
