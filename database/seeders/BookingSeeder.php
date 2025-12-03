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
        $bookings = [
            ['user_id' => 1, 'note' => 'Website development consultation', 'scheduled' => now()->addDays(2), 'status' => 'confirmed'],
            ['user_id' => 2, 'note' => 'English tutoring session', 'scheduled' => now()->addDays(3), 'status' => 'confirmed'],
            ['user_id' => 3, 'note' => 'Event DJ booking for wedding', 'scheduled' => now()->addDays(5), 'status' => 'pending'],
            ['user_id' => 4, 'note' => 'Catering service for party', 'scheduled' => now()->addDays(7), 'status' => 'confirmed'],
            ['user_id' => 5, 'note' => 'General health checkup', 'scheduled' => now()->addDays(1), 'status' => 'confirmed'],
            ['user_id' => 6, 'note' => 'Private taxi to airport', 'scheduled' => now()->addDays(4), 'status' => 'confirmed'],
            ['user_id' => 7, 'note' => 'Angkor Wat guided tour', 'scheduled' => now()->addDays(10), 'status' => 'pending'],
            ['user_id' => 8, 'note' => 'House deep cleaning service', 'scheduled' => now()->addDays(6), 'status' => 'confirmed'],
            ['user_id' => 9, 'note' => 'Business consulting meeting', 'scheduled' => now()->addDays(8), 'status' => 'confirmed'],
            ['user_id' => 10, 'note' => 'Product listing assistance', 'scheduled' => now()->addDays(12), 'status' => 'pending'],
        ];

        foreach ($bookings as $booking) {
            booking::create($booking);
        }
    }
}
