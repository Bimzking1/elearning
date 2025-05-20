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
            ['name' => 'Drs. Lukas Kambali, S.H., M.H.', 'email' => 'lukas@gmail.com', 'subjects' => ['Geografi']],
            ['name' => 'Paulus Widhi, S.E.', 'email' => 'paulus@gmail.com', 'subjects' => ['Ekonomi', 'Geografi', 'Sosiologi', 'Sejarah']],
            ['name' => 'L. Williyan Putra Perdana, S.E., M.M.', 'email' => 'williyan@gmail.com', 'subjects' => ['Ekonomi']],
            ['name' => 'Baihaqi Al Chasan, S.Hum.', 'email' => 'baihaqi@gmail.com', 'subjects' => ['Sejarah']],
            ['name' => 'Sutrisno', 'email' => 'sutrisno@gmail.com', 'subjects' => ['Agama Islam']],
            ['name' => 'Rismawati Sitanggang, S.Pd.', 'email' => 'rismawati@gmail.com', 'subjects' => ['Sosiologi']],
            ['name' => 'Dr. B. Budiono, M.Pd.', 'email' => 'budiono@gmail.com', 'subjects' => ['Bahasa Inggris']],
            ['name' => 'Drs. Himawan Setyo W., M.Pd.', 'email' => 'himawan@gmail.com', 'subjects' => ['Bahasa Inggris']],
            ['name' => 'Drs. Esti Nugroho', 'email' => 'esti@gmail.com', 'subjects' => ['Matematika']],
            ['name' => 'Drs. Soejatmiko', 'email' => 'soejatmiko@gmail.com', 'subjects' => ['Bahasa Indonesia']],
            ['name' => 'Fajar Novianto', 'email' => 'fajar@gmail.com', 'subjects' => ['PPKN']],
            ['name' => 'Albert Kurniawan, S.T.', 'email' => 'albert@gmail.com', 'subjects' => ['Fisika', 'Biologi', 'Kimia']],
            ['name' => 'Cristina, S.Pd., M.Pd.', 'email' => 'cristina@gmail.com', 'subjects' => ['Matematika']],
            ['name' => 'Fieda S., S.Pd., M.Pd.', 'email' => 'fieda@gmail.com', 'subjects' => ['Budi Pekerti']],
            ['name' => 'Johanes Nugroho, S.Kom.', 'email' => 'johanes@gmail.com', 'subjects' => ['Komputer']],
            ['name' => 'Nito, S.E.', 'email' => 'nito@gmail.com', 'subjects' => ['Wira Usaha']],
            ['name' => 'Adi Ardiansyah, S.Si.', 'email' => 'adi@gmail.com', 'subjects' => ['Seni Musik']],
        ];

        $nipStart = 2025010001; // start from NIP 2025010001
        $phoneStart = 87855162401; // starting phone number 087855162401

        foreach ($teachers as $teacherData) {
            // create user first
            $user = User::create([
                'name' => $teacherData['name'],
                'email' => $teacherData['email'],
                'password' => bcrypt('12345678'), // default password
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
