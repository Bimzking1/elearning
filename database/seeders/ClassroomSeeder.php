<?php

namespace Database\Seeders;

use App\Models\Classroom;
use App\Models\Teacher;
use Illuminate\Database\Seeder;

class ClassroomSeeder extends Seeder
{
    public function run(): void
    {
        $teacher = Teacher::first(); // Assign first teacher for now
        if (!$teacher) {
            // if no teacher found, create dummy
            $teacher = Teacher::factory()->create();
        }

        $classrooms = [
            'A1', 'A2', 'A3', 'A4', 'A5', 'A6',
            'B1', 'B2', 'B3',
            'C1', 'C2', 'C3',
        ];

        foreach ($classrooms as $name) {
            Classroom::create([
                'name' => $name,
                'teacher_id' => $teacher->id,
            ]);
        }
    }
}
