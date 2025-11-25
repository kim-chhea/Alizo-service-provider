<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 

        $users = [
            [
                'name' => 'John Doe',
                'first_name' => 'John',
                'sure_name' => 'Doe',
                 'work_position' => 'Developer',
                'email' => 'john@example.com',
                'password' => Hash::make('password123'),
                'gender' => 'male',

            ],
            [
                'name' => 'Jane Smith',
                'first_name' => 'Jane',
                'sure_name' => 'Smith',
                'work_position' => 'Designer',
                'email' => 'jane@example.com',
                'gender' => 'male',
                'password' => Hash::make('password123'),
            ],
            [
                'name' => 'Mike Johnson',
                'first_name' => 'Mike',
                'sure_name' => 'Johnson',
                'work_position' => 'Manager',
                'gender' => 'male',
                'email' => 'mike@example.com',
                'password' => Hash::make('password123'),
            ],
            [
                'name' => 'Emily Davis',
                'first_name' => 'Emily',
                'sure_name' => 'Davis',
                'gender' => 'male',
                'work_position' => 'Analyst',
                'email' => 'emily@example.com',
                'password' => Hash::make('password123'),
            ],
            [
                'name' => 'Robert Brown',
                'first_name' => 'Robert',
                'sure_name' => 'Brown',
                'gender' => 'male',
                'work_position' => 'Consultant',
                'email' => 'robert@example.com',
                'password' => Hash::make('password123'),
            ],
            [
                'name' => 'Linda White',
                'first_name' => 'Linda',
                'sure_name' => 'White',
                'gender' => 'female',
                'work_position' => 'Engineer',
                'email' => 'linda@example.com',
                'password' => Hash::make('password123'),
            ],
            [
                'name' => 'David Wilson',
                'first_name' => 'David',
                'sure_name' => 'Wilson',
                'gender' =>'male',
                'work_position' => 'Technician',
                'email' => 'david@example.com',
                'password' => Hash::make('password123'),

            ],
            [
                'name' => 'Susan Taylor',
                'first_name' => 'Susan',
                'sure_name' => 'Taylor',
                'work_position' => 'Administrator',
                'gender' => 'female',
                'email' => 'susan@example.com',
                'password' => Hash::make('password123'),
            ],
            [
                'name' => 'James Anderson',
                'email' => 'james@example.com',
                'first_name' => 'James',
                'sure_name' => 'Anderson',
                'work_position' => 'Coordinator',
                'gender' => 'male',
                'password' => Hash::make('password123'),

            ],
            [
                'name' => 'Karen Thomas',
                'first_name' => 'Karen',
                'sure_name' => 'Thomas',
                'work_position' => 'developer',
                'gender' => 'female',
                'email' => 'karen@example.com',
                'password' => Hash::make('password123'),
              
            ],
        ];
        
        foreach ($users as $user)
        {
            User::create($user);
        }
    }
}
