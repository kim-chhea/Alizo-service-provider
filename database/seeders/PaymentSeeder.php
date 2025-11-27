<?php

namespace Database\Seeders;

use App\Models\payment;
use Illuminate\Support\Str;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;


class PaymentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $payments = [
            ['order_id' => 1, 'booking_id' => 1, 'transaction_id' => 'TXN-' . strtoupper(Str::random(10)), 'discount_amount' => null, 'amount' => 300.00, 'currency' => 'USD', 'payment_method' => 'PayWay', 'status' => 'paid'],
            ['order_id' => 2, 'booking_id' => 2, 'transaction_id' => 'TXN-' . strtoupper(Str::random(10)), 'discount_amount' => null, 'amount' => 150.00, 'currency' => 'USD', 'payment_method' => 'ABA', 'status' => 'pending'],
            ['order_id' => 3, 'booking_id' => 3, 'transaction_id' => 'TXN-' . strtoupper(Str::random(10)), 'discount_amount' => null, 'amount' => 300.00, 'currency' => 'USD', 'payment_method' => 'Wing', 'status' => 'paid'],
            ['order_id' => 4, 'booking_id' => 4, 'transaction_id' => 'TXN-' . strtoupper(Str::random(10)), 'discount_amount' => null, 'amount' => 200.00, 'currency' => 'USD', 'payment_method' => 'Wing', 'status' => 'failed'],
            ['order_id' => 5, 'booking_id' => 5, 'transaction_id' => 'TXN-' . strtoupper(Str::random(10)), 'discount_amount' => null, 'amount' => 100.00, 'currency' => 'USD', 'payment_method' => 'ABA', 'status' => 'paid'],
            ['order_id' => 6, 'booking_id' => 6, 'transaction_id' => 'TXN-' . strtoupper(Str::random(10)), 'discount_amount' => null, 'amount' => 50.00, 'currency' => 'USD', 'payment_method' => 'PayWay', 'status' => 'pending'],
            ['order_id' => 7, 'booking_id' => 7, 'transaction_id' => 'TXN-' . strtoupper(Str::random(10)), 'discount_amount' => null, 'amount' => 120.00, 'currency' => 'USD', 'payment_method' => 'ABA', 'status' => 'paid'],
            ['order_id' => 8, 'booking_id' => 8, 'transaction_id' => 'TXN-' . strtoupper(Str::random(10)), 'discount_amount' => null, 'amount' => 80.00, 'currency' => 'USD', 'payment_method' => 'Wing', 'status' => 'failed'],
            ['order_id' => 9, 'booking_id' => 9, 'transaction_id' => 'TXN-' . strtoupper(Str::random(10)), 'discount_amount' => null, 'amount' => 250.00, 'currency' => 'USD', 'payment_method' => 'PayWay', 'status' => 'pending'],
            ['order_id' => 10,'booking_id' => 10, 'transaction_id' => 'TXN-' . strtoupper(Str::random(10)), 'discount_amount' => null, 'amount' => 75.00, 'currency' => 'USD', 'payment_method' => 'ABA', 'status' => 'paid'],
        ];

        foreach ($payments as $payment) {
            payment::create($payment);
        }
    }
}
