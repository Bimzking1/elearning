<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Models\Teacher;
use App\Models\User;

class ProfileController extends Controller
{
    // Show profile
    public function index()
    {
        $user = auth()->user();
        $teacher = Teacher::where('user_id', $user->id)->first();
        return view('teacher.profile.index', compact('user', 'teacher'));
    }

    // Show edit form
    public function edit()
    {
        $user = auth()->user();
        $teacher = Teacher::where('user_id', $user->id)->first();
        return view('teacher.profile.edit', compact('user', 'teacher'));
    }

    // Handle update
    public function update(Request $request)
    {
        $user = auth()->user();
        $teacher = Teacher::where('user_id', $user->id)->first();

        $request->validate([
            'email' => 'required|email|unique:users,email,' . $user->id,
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:255',
            'photo' => 'nullable|image|max:2048',
            'password' => 'nullable|min:6|confirmed',
        ]);

        $user->email = $request->email;

        // Handle photo upload
        if ($request->hasFile('photo')) {
            if ($user->photo) {
                Storage::delete('public/' . $user->photo);
            }

            $path = $request->file('photo')->store('photos', 'public');
            $user->photo = $path;
        }

        if ($request->password) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        $teacher->phone = $request->phone;
        $teacher->address = $request->address;
        $teacher->save();

        return redirect()->route('teacher.profile.index')->with('success', 'Profile updated successfully.');
    }
}
