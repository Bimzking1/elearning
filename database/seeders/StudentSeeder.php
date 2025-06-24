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
        $nis = 202502001; // Start from this number

        $faker = Faker::create(); // Instantiate Faker

        for ($i = 1; $i <= 20; $i++) {
            $user = User::create([
                'name' => $faker->name, // Generate random student name
                'email' => "student$i@example.com",
                'password' => Hash::make('student'), // Set password to 'student' and hash it
                'role' => 'student',
            ]);

            Student::create([
                'user_id' => $user->id,
                'nis' => (string)$nis++, // Increment the NIS
                'date_of_birth' => now()->subYears(15)->subDays(rand(0, 365)),
                'gender' => ['male', 'female'][rand(0, 1)],
                'phone' => '08' . rand(100000000, 999999999),
                'address' => 'Student Address ' . $i,
                'classroom_id' => $classrooms->random()->id,
                'guardian_name' => "Guardian $i",
                'guardian_phone' => '08' . rand(100000000, 999999999),
            ]);
        }
    }
}
