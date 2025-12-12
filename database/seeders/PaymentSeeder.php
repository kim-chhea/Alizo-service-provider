<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PaymentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('payments')->insert([
            [
                'booking_id' => 1,
                'transaction_id' => 'TXN123456',
                'discount_id' => null,
                'discount_amount' => 0.00,
                'status' => 'pending',
                'payment_method' => 'credit_card',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'booking_id' => 2,
                'transaction_id' => 'TXN789012',
                'discount_id' => 1,
                'discount_amount' => 10.00,
                'status' => 'paid',
                'payment_method' => 'paypal',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
