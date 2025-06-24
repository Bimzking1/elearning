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
        $faker = Faker::create();

        // ✅ Add default student first
        $defaultStudentUser = User::create([
            'name' => 'Default Student',
            'email' => 'student@gmail.com',
            'password' => Hash::make('student'), // password: student
            'role' => 'student',
        ]);

        Student::create([
            'user_id' => $defaultStudentUser->id,
            'nis' => (string)$nis++,
            'date_of_birth' => now()->subYears(15)->subDays(rand(0, 365)),
            'gender' => 'female',
            'phone' => '081234567890',
            'address' => 'Default Student Address',
            'classroom_id' => $classrooms->random()->id,
            'guardian_name' => 'Default Guardian',
            'guardian_phone' => '081122334455',
        ]);

        // 🌀 Add random students
        for ($i = 1; $i <= 20; $i++) {
            $user = User::create([
                'name' => $faker->name,
                'email' => "student$i@example.com",
                'password' => Hash::make('student'),
                'role' => 'student',
            ]);

            Student::create([
                'user_id' => $user->id,
                'nis' => (string)$nis++,
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
