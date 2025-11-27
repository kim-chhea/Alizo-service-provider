<?php

namespace Database\Factories;

use App\Models\cart;
use Illuminate\Database\Eloquent\Factories\Factory;

class CartFactory extends Factory
{
    protected $model = cart::class;

    public function definition(): array
    {
        return [
            'user_id' => 1,
            'name' => 'Default Cart',
            'status' => 'active',
        ];
    }
}
