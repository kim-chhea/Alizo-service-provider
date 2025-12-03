<?php

namespace Database\Factories;

use App\Models\Payment;
use Illuminate\Database\Eloquent\Factories\Factory;

class PaymentFactory extends Factory
{
    protected $model = Payment::class;

    public function definition(): array
    {
        return [
            'booking_id' => 1,
            'transaction_uid' => 'TXN-' . strtoupper($this->faker->bothify('????######')),
            'discount_amount' => null,
            'amount' => $this->faker->randomFloat(2, 10, 500),
            'currency' => 'USD',
            'payment_method' => $this->faker->randomElement(['card', 'cash', 'paypal', 'ABA', 'Wing']),
            'status' => $this->faker->randomElement(['pending', 'paid', 'failed']),
        ];
    }
}
