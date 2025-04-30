<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Subject;

class SubjectSeeder extends Seeder
{
    public function run(): void
    {
        $subjects = [
            ['name' => 'Bahasa Indonesia'],
            ['name' => 'Matematika'],
            ['name' => 'PPKN'],
            ['name' => 'IPA'],
            ['name' => 'IPS'],
            ['name' => 'Bahasa Inggris'],
            ['name' => 'Agama Islam'],
            ['name' => 'Ekonomi'],
            ['name' => 'Fisika'],
            ['name' => 'Geografi'],
            ['name' => 'Kimia'],
            ['name' => 'Sosiologi'],
            ['name' => 'Biologi'],
            ['name' => 'Sejarah'],
            ['name' => 'Budi Pekerti'],
            ['name' => 'Komputer'],
            ['name' => 'Wirausaha'],
            ['name' => 'Seni Musik'],
        ];

        foreach ($subjects as $subject) {
            Subject::create([
                'name' => $subject['name'],
                'description' => 'Description of ' . $subject['name'],
            ]);
        }
    }
}
