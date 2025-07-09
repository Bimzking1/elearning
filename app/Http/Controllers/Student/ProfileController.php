<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Models\Student;
use App\Models\User;

class ProfileController extends Controller
{
    // Show profile
    public function index()
    {
        $user = auth()->user();
        $student = Student::where('user_id', $user->id)->first();
        return view('student.profile.index', compact('user', 'student'));
    }

    // Show edit form
    public function edit()
    {
        $user = auth()->user();
        $student = Student::where('user_id', $user->id)->first();
        return view('student.profile.edit', compact('user', 'student'));
    }

    // Handle update
    public function update(Request $request)
    {
        $user = auth()->user();
        $student = Student::where('user_id', $user->id)->first();

        $request->validate([
            'email' => 'required|email|unique:users,email,' . $user->id,
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:255',
            'photo' => 'nullable|image|max:2048',
            'password' => 'nullable|min:6|confirmed',
        ]);

        // Update user info
        $user->email = $request->email;

        // Handle photo
        if ($request->hasFile('photo')) {
            if ($user->photo) {
                Storage::delete('public/' . $user->photo);
            }

            $path = $request->file('photo')->store('photos', 'public');
            $user->photo = $path;
        }

        // Update password if provided
        if ($request->password) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        // Update student info
        $student->phone = $request->phone;
        $student->address = $request->address;
        $student->save();

        return redirect()->route('student.profile.index')->with('success', 'Profile updated successfully.');
    }
}
