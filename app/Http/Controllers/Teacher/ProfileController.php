<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Teacher;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    // Show profile for teachers (view-only)
    public function index()
    {
        $user = auth()->user(); // Get the authenticated user
        $teacher = Teacher::where('user_id', $user->id)->first(); // Fetch the related teacher data

        return view('teacher.profile.index', compact('user', 'teacher')); // Pass both user and teacher data to the view
    }
}
