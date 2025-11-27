<?php

namespace Database\Seeders;

use App\Models\cartService;
use App\Models\Service;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CartServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $cartServices = [
            ['cart_id' => 1, 'service_id' => 2,"quantity" =>1],
            ['cart_id' => 1, 'service_id' => 3,"quantity" =>1],
            ['cart_id' => 2, 'service_id' => 4,"quantity" => 1],
            ['cart_id' => 3, 'service_id' => 1,"quantity" =>1],
            ['cart_id' => 4, 'service_id' => 5,"quantity" =>1],
            ['cart_id' => 5, 'service_id' => 6,"quantity" =>1],
            ['cart_id' => 6, 'service_id' => 7,"quantity" =>1],
            ['cart_id' => 7, 'service_id' => 8,"quantity" =>1],
            ['cart_id' => 8, 'service_id' => 9,"quantity" =>1],
            ['cart_id' => 9, 'service_id' => 10,"quantity" => 2,]
        ];

        foreach ($cartServices as $item) {
            $service = Service::find($item['service_id']);
            $total = ($service ? $service->price : 0) * ($item['quantity'] ?? 1);
            DB::table('cart_items')->insert([
                'cart_id' => $item['cart_id'],
                'service_id' => $item['service_id'],
                'quantity' => $item['quantity'] ?? 1,
                'total_price' => $total,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
