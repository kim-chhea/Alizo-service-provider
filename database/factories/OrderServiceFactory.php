<?php

namespace Database\Factories;

use App\Models\orderService;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderServiceFactory extends Factory
{
    protected $model = orderService::class;

    public function definition(): array
    {
        return [
            'order_id' => 1,
            'service_id' => 1,
            'total_amount' => 0,
        ];
    }
}
