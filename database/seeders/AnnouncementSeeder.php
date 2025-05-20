<?php

namespace Database\Seeders;

use App\Models\Announcement;
use App\Models\User;
use Illuminate\Database\Seeder;

class AnnouncementSeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::where('role', 'admin')->first();

        if (!$admin) {
            $admin = User::factory()->create([
                'role' => 'admin',
            ]);
        }

        $rolesOptions = [
            ['teacher'],
            ['teacher', 'student'],
            ['student'],
            ['all'],
            ['staff', 'teacher'],
        ];

        for ($i = 1; $i <= 10; $i++) {
            Announcement::create([
                'user_id' => $admin->id,
                'title' => "Announcement $i",
                'content' => "This is the content of announcement $i.",
                'roles' => $rolesOptions[array_rand($rolesOptions)], // Directly passing the array
                'start_date' => now(),
                'end_date' => now()->addDays(rand(5, 15)),
                'attachment' => null,
            ]);
        }
    }
}
