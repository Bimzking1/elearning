<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Teacher;
use App\Models\Student;
use App\Models\Classroom;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class TeacherController extends Controller {
    public function index() {
        // Fetch only users with the 'teacher' role
        $users = User::where('role', 'teacher')->get();
        return view('admin.teacher.index', compact('users'));
    }

    public function create() {
        $classrooms = Classroom::all();
        return view('admin.teacher.create', compact('classrooms'));
    }

    public function store(Request $request) {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
            'gender' => 'required|in:male,female,other',
            'date_of_birth' => 'nullable|date',
            'nip' => 'required|string|max:20|unique:teachers,nip',
            'specialization' => 'required|string|max:255',
            'joined_date' => 'required|date',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'teacher',
        ]);

        Teacher::create([
            'user_id' => $user->id,
            'date_of_birth' => $request->date_of_birth,
            'nip' => $request->nip,
            'gender' => $request->gender,
            'specialization' => $request->specialization,
            'joined_date' => $request->joined_date,
            'phone' => $request->phone,
            'address' => $request->address,
        ]);

        return redirect()->route('admin.teacher.index')->with('success', 'Teacher created successfully.');
    }

    public function edit(User $user) {
        $classrooms = Classroom::all();
        return view('admin.teacher.edit', compact('user', 'classrooms'));
    }

    public function update(Request $request, User $user) {
        // Validate the input
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'date_of_birth' => 'nullable|date',
            'gender' => 'required|in:male,female',
            'role' => 'teacher',
            'nip' => 'required_if:role,teacher|nullable|string|max:20',
            'specialization' => 'required_if:role,teacher|nullable|string|max:255',
            'joined_date' => 'required_if:role,teacher|nullable|date',
            'address' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
        ]);

        // Update the user data
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        // Update the teacher details
        $teacher = $user->teacher;
        $teacher->update([
            'date_of_birth' => $request->date_of_birth,
            'nip' => $request->nip,
            'gender' => $request->gender,
            'specialization' => $request->specialization,
            'joined_date' => $request->joined_date,
            'phone' => $request->phone, // Update phone field
        ]);

        // Check if password needs to be updated
        if ($request->has('change_password') && $request->change_password) {
            // Validate password only if the checkbox is checked
            $request->validate([
                'password' => 'required|min:6|confirmed',
            ]);

            // Update the password
            $user->update([
                'password' => Hash::make($request->password),
            ]);
        }

        return redirect()->route('admin.teacher.index')->with('success', 'User updated successfully.');
    }

    public function destroy(User $user) {
        Teacher::where('user_id', $user->id)->delete();

        $user->delete();

        return redirect()->route('admin.teacher.index')->with('success', 'User deleted successfully.');
    }
}
