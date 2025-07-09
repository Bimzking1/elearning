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
        $nipStart = 2025010001;
        $phoneStart = 87855162401;

        // ✅ Add default teacher (matching teacher@gmail.com from UserSeeder)
        // $defaultUser = User::create([
        //     'name' => 'Default Teacher',
        //     'email' => 'teacher@gmail.com',
        //     'password' => bcrypt('12345678'), // password: teacher
        //     'role' => 'teacher',
        // ]);

        // $teacher = $defaultUser->teacher()->create([
        //     'nip' => $nipStart++,
        //     'date_of_birth' => now()->subYears(35),
        //     'gender' => 'male',
        //     'phone' => '087' . $phoneStart++,
        //     'address' => 'Default Teacher Address',
        //     'specialization' => 'Bahasa Indonesia',
        //     'joined_date' => now(),
        // ]);

        // Optional: attach one or more default subjects
        $subject = Subject::where('name', 'Bahasa Indonesia')->first();
        if ($subject) {
            $teacher->subjects()->attach($subject->id);
        }

        // 🌀 Other teachers
        $teachers = [
            ['name' => 'Drs. Lukas Kambali, S.H., M.H.', 'email' => 'lukas@gmail.com', 'gender' => 'male', 'subjects' => ['Geografi']],
            ['name' => 'Paulus Widhi, S.E.', 'email' => 'paulus@gmail.com', 'gender' => 'male', 'subjects' => ['Ekonomi', 'Geografi', 'Sosiologi', 'Sejarah']],
            ['name' => 'L. Williyan Putra Perdana, S.E., M.M.', 'email' => 'williyan@gmail.com', 'gender' => 'male', 'subjects' => ['Ekonomi']],
            ['name' => 'Baihaqi Al Chasan, S.Hum.', 'email' => 'baihaqi@gmail.com', 'gender' => 'male', 'subjects' => ['Sejarah']],
            ['name' => 'Sutrisno', 'email' => 'sutrisno@gmail.com', 'gender' => 'male', 'subjects' => ['Agama Islam']],
            ['name' => 'Rismawati Sitanggang, S.Pd.', 'email' => 'rismawati@gmail.com', 'gender' => 'female', 'subjects' => ['Sosiologi']],
            ['name' => 'Dr. B. Budiono, M.Pd.', 'email' => 'budiono@gmail.com', 'gender' => 'male', 'subjects' => ['Bahasa Inggris']],
            ['name' => 'Drs. Himawan Setyo W., M.Pd.', 'email' => 'himawan@gmail.com', 'gender' => 'male', 'subjects' => ['Bahasa Inggris']],
            ['name' => 'Drs. Esti Nugroho', 'email' => 'esti@gmail.com', 'gender' => 'female', 'subjects' => ['Matematika']],
            ['name' => 'Drs. Soejatmiko', 'email' => 'soejatmiko@gmail.com', 'gender' => 'male', 'subjects' => ['Bahasa Indonesia']],
            ['name' => 'Fajar Novianto', 'email' => 'fajar@gmail.com', 'gender' => 'male', 'subjects' => ['PPKN']],
            ['name' => 'Albert Kurniawan, S.T.', 'email' => 'albert@gmail.com', 'gender' => 'male', 'subjects' => ['Fisika', 'Biologi', 'Kimia']],
            ['name' => 'Cristina, S.Pd., M.Pd.', 'email' => 'cristina@gmail.com', 'gender' => 'female', 'subjects' => ['Matematika']],
            ['name' => 'Fieda S., S.Pd., M.Pd.', 'email' => 'fieda@gmail.com', 'gender' => 'female', 'subjects' => ['Budi Pekerti']],
            ['name' => 'Johanes Nugroho, S.Kom.', 'email' => 'johanes@gmail.com', 'gender' => 'male', 'subjects' => ['Komputer']],
            ['name' => 'Nito, S.E.', 'email' => 'nito@gmail.com', 'gender' => 'male', 'subjects' => ['Wira Usaha']],
            ['name' => 'Adi Ardiansyah, S.Si.', 'email' => 'adi@gmail.com', 'gender' => 'male', 'subjects' => ['Seni Musik']],
        ];

        foreach ($teachers as $teacherData) {
            $user = User::create([
                'name' => $teacherData['name'],
                'email' => $teacherData['email'],
                'password' => bcrypt('12345678'),
                'role' => 'teacher',
            ]);

            $specialization = json_encode($teacherData['subjects']);
            $gender = $teacherData['gender'];

            $teacher = $user->teacher()->create([
                'nip' => $nipStart++,
                'date_of_birth' => now()->subYears(30),
                'gender' => $gender,
                'phone' => '087' . $phoneStart++,
                'address' => fake()->address(),
                'specialization' => $specialization,
                'joined_date' => now(),
            ]);

            foreach ($teacherData['subjects'] as $subjectName) {
                $subject = Subject::where('name', $subjectName)->first();
                if ($subject) {
                    $teacher->subjects()->attach($subject->id);
                }
            }
        }
    }
}
