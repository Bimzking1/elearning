<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Teacher;
use App\Models\User;
use App\Models\Subject;

class TeacherSeeder extends Seeder
{
    public function run(): void
    {
        $teachers = [
            ['name' => 'Drs. Lukas Kambali, S.H., M.H.', 'subjects' => ['Geografi']],
            ['name' => 'Paulus Widhi, S.E.', 'subjects' => ['Ekonomi', 'Geografi', 'Sosiologi', 'Sejarah']],
            ['name' => 'L. Williyan Putra Perdana, S.E., M.M.', 'subjects' => ['Ekonomi']],
            ['name' => 'Baihaqi Al Chasan, S.Hum.', 'subjects' => ['Sejarah']],
            ['name' => 'Sutrisno', 'subjects' => ['Agama Islam']],
            ['name' => 'Rismawati Sitanggang, S.Pd.', 'subjects' => ['Sosiologi']],
            ['name' => 'Dr. B. Budiono, M.Pd.', 'subjects' => ['Bahasa Inggris']],
            ['name' => 'Drs. Himawan Setyo W., M.Pd.', 'subjects' => ['Bahasa Inggris']],
            ['name' => 'Drs. Esti Nugroho', 'subjects' => ['Matematika']],
            ['name' => 'Drs. Soejatmiko', 'subjects' => ['Bahasa Indonesia']],
            ['name' => 'Fajar Novianto', 'subjects' => ['PPKN']],
            ['name' => 'Albert Kurniawan, S.T.', 'subjects' => ['Fisika', 'Biologi', 'Kimia']],
            ['name' => 'Cristina, S.Pd., M.Pd.', 'subjects' => ['Matematika']],
            ['name' => 'Fieda S., S.Pd., M.Pd.', 'subjects' => ['Budi Pekerti']],
            ['name' => 'Johanes Nugroho, S.Kom.', 'subjects' => ['Komputer']],
            ['name' => 'Nito, S.E.', 'subjects' => ['Wira Usaha']],
            ['name' => 'Adi Ardiansyah, S.Si.', 'subjects' => ['Seni Musik']],
        ];

        $nipStart = 2025010001; // start from NIP 2025010001
        $phoneStart = 87855162401; // starting phone number 087855162401

        foreach ($teachers as $teacherData) {
            // create user first
            $user = User::create([
                'name' => $teacherData['name'],
                'email' => strtolower(
                    str_replace(' ', '.', str_replace('.', '', $teacherData['name']))
                ) . '@example.com',
                'password' => bcrypt('password'), // default password
                'role' => 'teacher',
            ]);

            // Specialization = first subject
            $specialization = $teacherData['subjects'][0] ?? 'Teaching';

            // create teacher profile
            $teacher = $user->teacher()->create([
                'nip' => $nipStart++, // assign NIP then increment
                'date_of_birth' => now()->subYears(30),
                'gender' => 'male',
                'phone' => '087' . $phoneStart++, // increment phone number
                'address' => fake()->address(),
                'specialization' => $specialization,
                'joined_date' => now(),
            ]);

            // attach subjects
            foreach ($teacherData['subjects'] as $subjectName) {
                $subject = Subject::where('name', $subjectName)->first();
                if ($subject) {
                    $teacher->subjects()->attach($subject->id);
                }
            }
        }
    }
}
