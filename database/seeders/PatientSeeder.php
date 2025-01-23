<?php

namespace Database\Seeders;

use App\Models\Patient;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PatientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Patient::insert([
            [
                'name' => 'John Doe',
                'phone' => '1234567890',
                'address' => '123 Main St',
                'dob' => '1990-01-01',
                'gender' => 'male',
                'user_id' => 1
            ],
            [
                'name' => 'Jane Doe',
                'phone' => '9876543210',
                'address' => '456 Elm St',
                'dob' => '1985-05-15',
                'gender' => 'female',
                'user_id' => 1
            ],
            [
                'name' => 'Bob Smith',
                'phone' => '5555555555',
                'address' => '789 Oak St',
                'dob' => '1970-10-10',
                'gender' => 'male',
                'user_id' => 1
            ],
        ]);
    }
}
