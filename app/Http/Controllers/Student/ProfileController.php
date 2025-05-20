<?php

namespace App\Http\Controllers\Student;
use App\Http\Controllers\Controller;
use App\Models\Student;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    // Show profile for students (view-only)
    public function index()
    {
        $user = auth()->user(); // Get the authenticated user
        $student = Student::where('user_id', $user->id)->first(); // Fetch the related student data

        return view('student.profile.index', compact('user', 'student')); // Pass both user and student data to the view
    }
}
