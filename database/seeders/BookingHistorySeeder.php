<?php

namespace Database\Seeders;

use App\Models\BookingHistory;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class BookingHistorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $histories = [
            ['booking_id' => 1, 'user_id' => 1, 'transaction_uid' => 'HIST-' . strtoupper(Str::random(10)), 'status' => 'confirmed', 'notes' => 'Booking confirmed by user'],
            ['booking_id' => 2, 'user_id' => 2, 'transaction_uid' => 'HIST-' . strtoupper(Str::random(10)), 'status' => 'pending', 'notes' => 'Awaiting confirmation'],
            ['booking_id' => 3, 'user_id' => 3, 'transaction_uid' => 'HIST-' . strtoupper(Str::random(10)), 'status' => 'confirmed', 'notes' => 'Payment received'],
            ['booking_id' => 4, 'user_id' => 4, 'transaction_uid' => 'HIST-' . strtoupper(Str::random(10)), 'status' => 'cancelled', 'notes' => 'Customer requested cancellation'],
            ['booking_id' => 5, 'user_id' => 5, 'transaction_uid' => 'HIST-' . strtoupper(Str::random(10)), 'status' => 'confirmed', 'notes' => 'All requirements met'],
            ['booking_id' => 6, 'user_id' => 6, 'transaction_uid' => 'HIST-' . strtoupper(Str::random(10)), 'status' => 'pending', 'notes' => 'Waiting for payment'],
            ['booking_id' => 7, 'user_id' => 7, 'transaction_uid' => 'HIST-' . strtoupper(Str::random(10)), 'status' => 'confirmed', 'notes' => 'Ready to proceed'],
            ['booking_id' => 8, 'user_id' => 8, 'transaction_uid' => 'HIST-' . strtoupper(Str::random(10)), 'status' => 'cancelled', 'notes' => 'Service unavailable'],
            ['booking_id' => 9, 'user_id' => 9, 'transaction_uid' => 'HIST-' . strtoupper(Str::random(10)), 'status' => 'pending', 'notes' => 'Under review'],
            ['booking_id' => 10, 'user_id' => 10, 'transaction_uid' => 'HIST-' . strtoupper(Str::random(10)), 'status' => 'confirmed', 'notes' => 'Confirmed and scheduled'],
        ];

        foreach ($histories as $history) {
            BookingHistory::create($history);
        }
    }
}
