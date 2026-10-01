<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Room;
use App\Models\Reservation;
use App\Models\Guest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class HotelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Hotel Admin User
        User::updateOrCreate(
            ['email' => 'admin@royalceylon.com'],
            [
                'name' => 'Admin User',
                'password' => Hash::make('admin123'),
            ]
        );

        // 2. Rooms
        $rooms = [
            ['number' => '101', 'type' => 'Deluxe Room', 'floor' => '1st Floor', 'beds' => '1 King Bed', 'price' => 8500, 'status' => 'Available', 'guest' => null, 'amenities' => ['WiFi', 'AC', 'TV', 'Balcony']],
            ['number' => '102', 'type' => 'Royal Ocean Suite', 'floor' => '1st Floor', 'beds' => '2 King Beds', 'price' => 18500, 'status' => 'Occupied', 'guest' => 'Amal Perera', 'amenities' => ['WiFi', 'AC', 'TV', 'Jacuzzi', 'Ocean View']],
            ['number' => '103', 'type' => 'Standard Nature Room', 'floor' => '1st Floor', 'beds' => '1 Queen Bed', 'price' => 5500, 'status' => 'Available', 'guest' => null, 'amenities' => ['WiFi', 'AC', 'Coffee Maker']],
            ['number' => '201', 'type' => 'Deluxe Room', 'floor' => '2nd Floor', 'beds' => '1 King Bed', 'price' => 8500, 'status' => 'Reserved', 'guest' => 'Nimal Silva', 'amenities' => ['WiFi', 'AC', 'TV', 'Balcony']],
            ['number' => '202', 'type' => 'Royal Ocean Suite', 'floor' => '2nd Floor', 'beds' => '2 King Beds', 'price' => 18500, 'status' => 'Occupied', 'guest' => 'Dr. John Smith', 'amenities' => ['WiFi', 'AC', 'TV', 'Jacuzzi', 'Ocean View']],
            ['number' => '203', 'type' => 'Standard Nature Room', 'floor' => '2nd Floor', 'beds' => '2 Twin Beds', 'price' => 5500, 'status' => 'Cleaning', 'guest' => null, 'amenities' => ['WiFi', 'AC']],
            ['number' => '301', 'type' => 'Presidential Villa', 'floor' => '3rd Floor', 'beds' => '3 King Beds', 'price' => 35000, 'status' => 'Available', 'guest' => null, 'amenities' => ['WiFi', 'AC', 'TV', 'Private Pool', 'Butler Service']],
            ['number' => '302', 'type' => 'Deluxe Room', 'floor' => '3rd Floor', 'beds' => '1 King Bed', 'price' => 8500, 'status' => 'Cleaning', 'guest' => null, 'amenities' => ['WiFi', 'AC', 'TV', 'Balcony']],
        ];

        foreach ($rooms as $r) {
            Room::updateOrCreate(['number' => $r['number']], $r);
        }

        // 3. Reservations
        $reservations = [
            [
                'booking_code' => 'RC-1001',
                'guest' => 'Nimal Silva',
                'phone' => '+94 77 123 4567',
                'email' => 'nimal.silva@gmail.com',
                'room_number' => '201',
                'room_type' => 'Deluxe Room',
                'check_in' => '2026-10-02',
                'check_out' => '2026-10-05',
                'nights' => 3,
                'total' => 25500,
                'status' => 'Confirmed',
                'payment_status' => 'Paid',
                'guests_count' => 2
            ],
            [
                'booking_code' => 'RC-1002',
                'guest' => 'Sarah Jenkins',
                'phone' => '+44 7911 123456',
                'email' => 'sarah.j@outlook.com',
                'room_number' => '301',
                'room_type' => 'Presidential Villa',
                'check_in' => '2026-10-03',
                'check_out' => '2026-10-08',
                'nights' => 5,
                'total' => 175000,
                'status' => 'Confirmed',
                'payment_status' => 'Deposit Paid',
                'guests_count' => 4
            ],
            [
                'booking_code' => 'RC-1003',
                'guest' => 'Kasun Bandara',
                'phone' => '+94 71 987 6543',
                'email' => 'kasun.b@yahoo.com',
                'room_number' => '101',
                'room_type' => 'Deluxe Room',
                'check_in' => '2026-10-04',
                'check_out' => '2026-10-06',
                'nights' => 2,
                'total' => 17000,
                'status' => 'Pending',
                'payment_status' => 'Unpaid',
                'guests_count' => 2
            ],
        ];

        foreach ($reservations as $res) {
            Reservation::updateOrCreate(['booking_code' => $res['booking_code']], $res);
        }

        // 4. Guests
        $guests = [
            [
                'name' => 'Dr. John Smith',
                'country' => 'United Kingdom',
                'phone' => '+44 7911 123456',
                'email' => 'dr.smith@oxford.ac.uk',
                'nic_passport' => 'GB89234102',
                'tier' => 'Platinum VIP',
                'total_stays' => 4,
                'lifetime_spend' => 285000,
                'preferred_room' => 'Royal Ocean Suite',
                'notes' => 'Prefers extra quiet top-floor room, sparkling water on arrival.'
            ],
            [
                'name' => 'Amal Perera',
                'country' => 'Sri Lanka',
                'phone' => '+94 77 234 5678',
                'email' => 'amal.perera@dialog.lk',
                'nic_passport' => '19841203491V',
                'tier' => 'Gold VIP',
                'total_stays' => 3,
                'lifetime_spend' => 84000,
                'preferred_room' => 'Deluxe Room',
                'notes' => 'Vegetarian meals, late check-out requested when possible.'
            ],
            [
                'name' => 'Sarah Jenkins',
                'country' => 'Australia',
                'phone' => '+61 412 345 678',
                'email' => 'sarah.j@sydney.com.au',
                'nic_passport' => 'PA7823901',
                'tier' => 'Platinum VIP',
                'total_stays' => 2,
                'lifetime_spend' => 210000,
                'preferred_room' => 'Presidential Villa',
                'notes' => 'Celebrates wedding anniversary in October. Allergic to peanuts.'
            ],
            [
                'name' => 'Kumari Jayasinghe',
                'country' => 'Sri Lanka',
                'phone' => '+94 71 456 7890',
                'email' => 'kumari.j@gmail.com',
                'nic_passport' => '19925670123V',
                'tier' => 'Regular Guest',
                'total_stays' => 1,
                'lifetime_spend' => 17000,
                'preferred_room' => 'Standard Nature Room',
                'notes' => 'First time visitor, enjoys morning bird watching tours.'
            ]
        ];

        foreach ($guests as $g) {
            Guest::updateOrCreate(['phone' => $g['phone']], $g);
        }
    }
}
