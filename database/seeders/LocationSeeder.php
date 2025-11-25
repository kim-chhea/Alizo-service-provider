<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('locations')->insert([
            ['address' => '123 Main St', 'city' => 'Phnom Penh','user_id' => 1,'country' => 'Cambodia','postal_code' => '12000'],
            ['address' => '456 Riverside Blvd', 'city' => 'Siem Reap','user_id' => 2,'country' => 'Cambodia','postal_code' => '12000'],
            ['address' => '789 Mekong Rd', 'city' => 'Battambang','user_id' => 3,'country' => 'Cambodia','postal_code' => '12000'],
            ['address' => '12 Angkor Ave', 'city' => 'Siem Reap','user_id' => 4,'country' => 'Cambodia','postal_code' => '12000'],
            ['address' => '34 Independence Blvd', 'city' => 'Phnom Penh','user_id' => 5,'country' => 'Cambodia','postal_code' => '12000'],
            ['address' => '56 Victory St', 'city' => 'Sihanoukville','user_id' => 6,'country' => 'Cambodia','postal_code' => '12000'],
            ['address' => '78 National Hwy', 'city' => 'Kampot','user_id' => 7,'country' => 'Cambodia','postal_code' => '12000'],
            ['address' => '90 Street 63', 'city' => 'Phnom Penh','user_id' => 8,'country' => 'Cambodia','postal_code' => '12000'],
            ['address' => '101 Pub Street', 'city' => 'Siem Reap','user_id' => 9,'country' => 'Cambodia','postal_code' => '12000'],
            ['address' => '202 Royal Palace Rd', 'city' => 'Phnom Penh','user_id' => 10,'country' => 'Cambodia','postal_code' => '12000'],
        ]);
    }
}
