<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\User;
use App\Models\Classroom;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;

class StudentController extends Controller
{
    public function index()
    {
        $students = Student::with('user', 'classroom')->get();
        return view('admin.students.index', compact('students'));
    }

    public function create()
    {
        $classrooms = Classroom::all();
        return view('admin.students.create', compact('classrooms'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
            'nis' => [
                'required',
                'numeric',
                'min:8',
                Rule::unique('students', 'nis'),
            ],
            'date_of_birth' => 'required|date',
            'gender' => 'required|in:male,female',
            'address' => 'required|string|max:255',
            'classroom_id' => 'required|exists:classrooms,id',
            'phone' => 'required|string|max:15',
            'guardian_name' => 'required|string|max:255',
            'guardian_phone' => 'required|string|max:15',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Create User
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'student', // Set role as student
        ]);

        // Handle photo upload (if provided)
        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('student_photos', 'public');
            $user->update(['photo' => $photoPath]);
        }

        // Create Student linked to the User
        Student::create([
            'user_id' => $user->id,
            'nis' => $request->nis,
            'date_of_birth' => $request->date_of_birth,
            'gender' => $request->gender,
            'phone' => $request->phone,
            'address' => $request->address,
            'classroom_id' => $request->classroom_id,
            'guardian_name' => $request->guardian_name,
            'guardian_phone' => $request->guardian_phone,
        ]);

        return redirect()->route('admin.students.index')->with('success', 'Student created successfully!');
    }

    public function edit(Student $student)
    {
        $classrooms = Classroom::all();
        return view('admin.students.edit', compact('student', 'classrooms'));
    }

    public function update(Request $request, Student $student)
    {
        $request->validate([
            'name' => 'required|string|max:255', // Ensure name is included
            'email' => 'required|email|unique:users,email,' . $student->user->id,
            'nis' => [
                'required',
                'numeric',
                'min:8',
                Rule::unique('students', 'nis')->ignore($student->id),
            ],
            'date_of_birth' => 'required|date',
            'gender' => 'required|in:male,female',
            'address' => 'required|string|max:255',
            'classroom_id' => 'required|exists:classrooms,id',
            'phone' => 'required|string|max:15',
            'guardian_name' => 'required|string|max:255',
            'guardian_phone' => 'required|string|max:15',
            'password' => 'nullable|min:6|confirmed',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Update User (Ensure name is not null)
        $student->user->update([
            'name' => $request->name,  // This prevents the "name cannot be null" error
            'email' => $request->email,
        ]);

        // Handle photo upload (if provided)
        if ($request->hasFile('photo')) {
            // Delete old photo if it exists
            if ($student->user->photo) {
                Storage::disk('public')->delete($student->user->photo);  // Delete the old photo
            }

            // Store the new photo and get the path
            $photoPath = $request->file('photo')->store('student_photos', 'public');
            $student->user->update(['photo' => $photoPath]);
        }

        // Update password if provided
        if ($request->filled('password')) {
            $student->user->update([
                'password' => Hash::make($request->password),
            ]);
        }

        // Update Student Data
        $student->update([
            'nis' => $request->nis,
            'date_of_birth' => $request->date_of_birth,
            'gender' => $request->gender,
            'phone' => $request->phone,
            'address' => $request->address,
            'classroom_id' => $request->classroom_id,
            'guardian_name' => $request->guardian_name,
            'guardian_phone' => $request->guardian_phone,
        ]);

        return redirect()->route('admin.students.index')->with('success', 'Student updated successfully!');
    }

    public function destroy(Student $student)
    {
        // Delete related User
        if ($student->user) {
            // Delete the user's photo if it exists
            if ($student->user->photo) {
                Storage::disk('public')->delete($student->user->photo);  // Delete the photo
            }

            $student->user->delete();
        }

        // Delete Student
        $student->delete();

        return redirect()->route('admin.students.index')->with('success', 'Student deleted successfully!');
    }
}
