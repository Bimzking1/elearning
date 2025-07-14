<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Student;
use App\Models\Classroom;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;

class StudentSeeder extends Seeder
{
    public function run(): void
    {
        $classrooms = Classroom::all();
        $faker = Faker::create();

        $nis = 202502001; // Start from this number

        for ($i = 1; $i <= 5; $i++) {
            // Generate nisn by appending the last 4 digits of nis
            $last3 = substr($nis, -3); // get last 4 digits
            $nisn = $nis . $last3;

            $user = User::create([
                'name' => $faker->name,
                'email' => "student$i@gmail.com",
                'password' => Hash::make('12345678'),
                'role' => 'student',
            ]);

            Student::create([
                'user_id' => $user->id,
                'nis' => (string)$nis,
                'nisn' => (string)$nisn,
                'date_of_birth' => now()->subYears(15)->subDays(rand(0, 365)),
                'gender' => ['male', 'female'][rand(0, 1)],
                'phone' => '08' . rand(100000000, 999999999),
                'address' => 'Student Address ' . $i,
                'classroom_id' => $classrooms->random()->id,
                'guardian_name' => $faker->name,
                'guardian_phone' => '08' . rand(100000000, 999999999),
            ]);

            $nis++; // increment for next student
        }
    }
}
