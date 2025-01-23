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
        User::insert([
            [
                'name' => 'Admin',
                'email' => 'admin@gmail.com',
                'password' => Hash::make('password'),
                'role' => 'admin',
            ],
            [
                'name' => 'Doctor',
                'email' => 'doctor@gmail.com',
                'password' => Hash::make('password'),
                'role' => 'doctor',
            ],
            [
                'name' => 'Nurse',
                'email' => 'nurse@gmail.com',
                'password' => Hash::make('password'),
                'role' => 'nurse',
            ],
        ]);
    }
}
