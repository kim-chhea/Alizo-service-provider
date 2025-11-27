<?php

namespace Database\Seeders;

use App\Models\cart;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CartSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $carts = [
            ['user_id' => 1, 'name' => 'Default Cart 1'],
            ['user_id' => 2, 'name' => 'Default Cart 2'],
            ['user_id' => 3, 'name' => 'Default Cart 3'],
            ['user_id' => 4, 'name' => 'Default Cart 4'],
            ['user_id' => 5, 'name' => 'Default Cart 5'],
            ['user_id' => 6, 'name' => 'Default Cart 6'],
            ['user_id' => 7, 'name' => 'Default Cart 7'],
            ['user_id' => 8, 'name' => 'Default Cart 8'],
            ['user_id' => 9, 'name' => 'Default Cart 9'],
            ['user_id' => 10, 'name' => 'Default Cart 10'],
        ];

        foreach ($carts as $cart) {
            cart::create($cart);
        }
    }
}
