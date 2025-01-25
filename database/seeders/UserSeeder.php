<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        User::insert([
            [
                'name' => 'Admin',
                'email' => 'admin@gmail.com',
                'password' => Hash::make('password'),
                'role' => 'admin',
                'is_active' => true,
            ],
        ]);

        // Seeder untuk dokter
        $faker = Faker::create();
        for ($i = 0; $i < 6; $i++) {
            User::insert([
                [
                    'name' => 'Dr. ' . $faker->firstName . ' ' . $faker->lastName,
                    'email' => 'doctor' . ($i + 1) . '@gmail.com',
                    'password' => Hash::make('password'),
                    'role' => 'doctor',
                    'is_active' => true,
                ],
            ]);
        }

        // Seeder untuk suster
        User::insert([
            [
                'name' => 'Nurse',
                'email' => 'nurse@gmail.com',
                'password' => Hash::make('password'),
                'role' => 'nurse',
                'is_active' => true,
            ],
        ]);
    }
}
