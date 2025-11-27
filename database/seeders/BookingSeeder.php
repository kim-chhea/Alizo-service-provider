<?php

namespace Database\Seeders;

use App\Models\booking;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BookingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        // Create 10 bookings with scheduled datetime to satisfy migration
        for ($i = 1; $i <= 10; $i++) {
            booking::create([
                'user_id' => $i,
                'note' => 'Booking for user ' . $i,
                'scheduled' => now()->addDays($i),
                'is_confirmed' => true,
            ]);
        }
    }
}
