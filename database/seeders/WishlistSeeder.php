<?php

namespace Database\Seeders;

use App\Models\wishlist;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class WishlistSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $wishlists = [
            ['user_id' => 1, 'name' => 'Wishlist 1'],
            ['user_id' => 2, 'name' => 'Wishlist 2'],
            ['user_id' => 3, 'name' => 'Wishlist 3'],
            ['user_id' => 4, 'name' => 'Wishlist 4'],
            ['user_id' => 5, 'name' => 'Wishlist 5'],
            ['user_id' => 6, 'name' => 'Wishlist 6'],
            ['user_id' => 7, 'name' => 'Wishlist 7'],
            ['user_id' => 8, 'name' => 'Wishlist 8'],
            ['user_id' => 9, 'name' => 'Wishlist 9'],
            ['user_id' => 10, 'name' => 'Wishlist 10'],
        ];

        foreach ($wishlists as $wishlist) {
            wishlist::create($wishlist);
        }
    }
}
