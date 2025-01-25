<?php

namespace Database\Seeders;

use App\Models\Patient;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class PatientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $faker = Faker::create();

        // Membuat 10 pasien dengan data acak menggunakan Faker
        foreach (range(1, 10) as $index) {
            Patient::create([
                'name' => $faker->name,
                'phone' => $faker->phoneNumber,
                'address' => $faker->address,
                'dob' => $faker->date(),
                'gender' => $faker->randomElement(['male', 'female']),
                'user_id' => 1, // Ganti dengan ID user yang sesuai
            ]);
        }
    }
}
