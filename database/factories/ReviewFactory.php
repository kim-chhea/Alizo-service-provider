<?php

namespace Database\Factories;

use App\Models\review;
use Illuminate\Database\Eloquent\Factories\Factory;

class ReviewFactory extends Factory
{
    protected $model = review::class;

    public function definition(): array
    {
        return [
            'user_id' => 1,
            'service_id' => 1,
            'comment' => $this->faker->sentence(),
            'rating' => $this->faker->numberBetween(1, 5),
        ];
    }
}
