<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('orders')->insert([
            ['user_id' => 1, 'note' => 'Order for services', 'status' => 'pending'],
            ['user_id' => 2, 'note' => 'Order for services', 'status' => 'paid'],
            ['user_id' => 3, 'note' => 'Order for services', 'status' => 'pending'],
            ['user_id' => 4, 'note' => 'Order for services', 'status' => 'pending'],
            ['user_id' => 5, 'note' => 'Order for services', 'status' => 'pending'],
            ['user_id' => 6, 'note' => 'Order for services', 'status' => 'pending'],
            ['user_id' => 7, 'note' => 'Order for services', 'status' => 'pending'],
            ['user_id' => 8, 'note' => 'Order for services', 'status' => 'paid'],
            ['user_id' => 9, 'note' => 'Order for services', 'status' => 'pending'],
            ['user_id' => 10,'note' => 'Order for services', 'status' => 'pending'],
        ]);
        
    }
}
