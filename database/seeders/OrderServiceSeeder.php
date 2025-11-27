<?php

namespace Database\Seeders;

use App\Models\orderService;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OrderServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $orderServices = [
            // total_amount set to match ServiceSeeder prices
            ['order_id' => 1, 'service_id' => 3, 'total_amount' => 300],
            ['order_id' => 1, 'service_id' => 5, 'total_amount' => 100],
            ['order_id' => 2, 'service_id' => 1, 'total_amount' => 500],
            ['order_id' => 3, 'service_id' => 2, 'total_amount' => 150],
            ['order_id' => 4, 'service_id' => 4, 'total_amount' => 200],
            ['order_id' => 5, 'service_id' => 7, 'total_amount' => 120],
            ['order_id' => 6, 'service_id' => 6, 'total_amount' => 50],
            ['order_id' => 7, 'service_id' => 8, 'total_amount' => 80],
            ['order_id' => 8, 'service_id' => 9, 'total_amount' => 250],
            ['order_id' => 9, 'service_id' => 10, 'total_amount' => 75],
        ];

        foreach ($orderServices as $orderService) {
            orderService::create($orderService);
        }
    }
}
