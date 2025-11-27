<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            RoleSeeder::class,
            UserSeeder::class,
            LocationSeeder::class,
            UserRoleSeeder::class,
            CategorieSeeder::class,
            ServiceSeeder::class,
            serviceCategoriesSeeder::class,
            BookingSeeder::class,
            BookingServiceSeeder::class,
            CartSeeder::class,
            CartServiceSeeder::class,
            WishlistSeeder::class,
            WishlistServiceSeeder::class,
            OrderSeeder::class,
            PaymentSeeder::class,
            OrderServiceSeeder::class,
            ReviewSeeder::class,
        ]);
    }
}
