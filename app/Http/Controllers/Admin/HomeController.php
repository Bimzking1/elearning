<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Teacher;
use App\Models\Student;
use App\Models\Classroom;

class HomeController extends Controller
{
    public function index()
    {
        $totalUsers = User::count();
        $totalTeachers = Teacher::count();
        $totalStudents = Student::count();
        $totalClassrooms = Classroom::count();

        return view('admin.home.index', compact(
            'totalUsers',
            'totalTeachers',
            'totalStudents',
            'totalClassrooms'
        ));
    }
}
