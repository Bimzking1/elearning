<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Teacher;
use App\Models\Student;
use App\Models\Classroom;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = User::where('role', '!=', 'admin')->get(); // Exclude admins
        return view('admin.users.index', compact('users')); // ✅ Fixed view path
    }

    public function create()
    {
        $classrooms = Classroom::all(); // ✅ Fetch all classrooms
        return view('admin.users.create', compact('classrooms'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
            'role' => 'required|in:teacher,student',
            'date_of_birth' => 'nullable|date',
            'nip' => 'required_if:role,teacher|nullable|string|max:20',
            'specialization' => 'required_if:role,teacher|nullable|string|max:255',
            'joined_date' => 'required_if:role,teacher|nullable|date',
            'nis' => 'required_if:role,student|nullable|string|max:20',
            'nisn' => 'required_if:role,student|nullable|string|max:255',
            'classroom_id' => 'required_if:role,student|nullable|exists:classrooms,id',
            'guardian_name' => 'required_if:role,student|nullable|string|max:255',
            'guardian_phone' => 'required_if:role,student|nullable|string|max:20',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);

        if ($request->role == 'teacher') {
            Teacher::create([
                'user_id' => $user->id,
                'date_of_birth' => $request->date_of_birth,
                'address' => $request->address,
                'phone' => $request->phone,
                'nip' => $request->nip,
                'specialization' => $request->specialization,
                'joined_date' => $request->joined_date,
            ]);
        } elseif ($request->role == 'student') {
            Student::create([
                'user_id' => $user->id,
                'nis' => $request->nis,
                'nisn' => $request->nisn,
                'classroom_id' => $request->classroom_id,
                'guardian_name' => $request->guardian_name,
                'guardian_phone' => $request->guardian_phone,
            ]);
        }

        return redirect()->route('admin.users.index')->with('success', 'User created successfully.'); // ✅ Fixed redirect
    }

    public function edit(User $user)
    {
        $classrooms = Classroom::all(); // Fetch all classes
        return view('admin.users.edit', compact('user', 'classrooms'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'date_of_birth' => 'nullable|date',
            'address' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:20',
            'nip' => 'required_if:role,teacher|nullable|string|max:20',
            'specialization' => 'required_if:role,teacher|nullable|string|max:255',
            'joined_date' => 'required_if:role,teacher|nullable|date',
            'nis' => 'required_if:role,student|nullable|string|max:20',
            'nisn' => 'required_if:role,student|nullable|string|max:255',
            'classroom_id' => 'required_if:role,student|nullable|exists:classrooms,id',
            'guardian_name' => 'required_if:role,student|nullable|string|max:255',
            'guardian_phone' => 'required_if:role,student|nullable|string|max:20',
        ]);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        if ($user->role === 'teacher') {
            $teacher = Teacher::where('user_id', $user->id)->first();
            if ($teacher) {
                $teacher->update([
                    'date_of_birth' => $request->date_of_birth,
                    'address' => $request->address,
                    'phone' => $request->phone,
                    'nip' => $request->nip,
                    'specialization' => $request->specialization,
                    'joined_date' => $request->joined_date,
                ]);
            }
        } elseif ($user->role === 'student') {
            $student = Student::where('user_id', $user->id)->first();
            if ($student) {
                $student->update([
                    'nis' => $request->nis,
                    'nisn' => $request->nisn,
                    'classroom_id' => $request->classroom_id,
                    'guardian_name' => $request->guardian_name,
                    'guardian_phone' => $request->guardian_phone,
                ]);
            }
        }

        return redirect()->route('admin.users.index')->with('success', 'User updated successfully.');
    }

    public function destroy(User $user)
    {
        if ($user->role === 'teacher') {
            Teacher::where('user_id', $user->id)->delete(); // ✅ Fixed relation deletion
        } elseif ($user->role === 'student') {
            Student::where('user_id', $user->id)->delete(); // ✅ Fixed relation deletion
        }

        $user->delete();

        return redirect()->route('admin.users.index')->with('success', 'User deleted successfully.');
    }
}
