<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Teacher;
use App\Models\Classroom;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Models\Subject;

class TeacherController extends Controller {
    public function index() {
        $users = User::where('role', 'teacher')->get();
        return view('admin.teacher.index', compact('users'));
    }

    public function create() {
        $classrooms = Classroom::all();
        $subjects = Subject::all();
        return view('admin.teacher.create', compact('classrooms', 'subjects'));
    }

    public function store(Request $request) {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
            'gender' => 'required|in:male,female,other',
            'date_of_birth' => 'nullable|date',
            'nip' => 'required|string|max:20|unique:teachers,nip',
            'specialization' => 'required|array',
            'specialization.*' => 'string|max:255',
            'joined_date' => 'required|date',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'teacher',
        ]);

        if ($request->hasFile('photo')) {
            if ($user->photo) {
                Storage::disk('public')->delete($user->photo);
            }

            $photoPath = $request->file('photo')->store('teacher_photos', 'public');
            $user->update(['photo' => $photoPath]);
        }

        if ($request->has('cropped_photo')) {
            $imageData = $request->input('cropped_photo');
            $image = str_replace('data:image/jpeg;base64,', '', $imageData);
            $image = str_replace(' ', '+', $image);
            $imageName = 'teacher_' . Str::random(10) . '.jpg';
            $imagePath = 'teacher_photos/' . $imageName;

            Storage::disk('public')->put($imagePath, base64_decode($image));
            $user->update(['photo' => $imagePath]);
        }

        Teacher::create([
            'user_id' => $user->id,
            'date_of_birth' => $request->date_of_birth,
            'nip' => $request->nip,
            'gender' => $request->gender,
            'specialization' => $request->specialization, // Will be cast as JSON
            'joined_date' => $request->joined_date,
            'phone' => $request->phone,
            'address' => $request->address,
        ]);

        return redirect()->route('admin.teacher.index')->with('success', 'Teacher created successfully.');
    }

    public function edit(User $user) {
        $classrooms = Classroom::all();
        $subjects = Subject::all();
        return view('admin.teacher.edit', compact('user', 'classrooms', 'subjects'));
    }

    public function update(Request $request, User $user) {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'date_of_birth' => 'nullable|date',
            'gender' => 'required|in:male,female,other',
            'role' => 'teacher',
            'nip' => 'required_if:role,teacher|nullable|string|max:20',
            'specialization' => 'required_if:role,teacher|array',
            'specialization.*' => 'string|max:255',
            'joined_date' => 'required_if:role,teacher|nullable|date',
            'address' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $userData = [
            'name' => $request->name,
            'email' => $request->email,
        ];

        if ($request->hasFile('photo')) {
            if ($user->photo) {
                Storage::disk('public')->delete($user->photo);
            }

            $photoPath = $request->file('photo')->store('teacher_photos', 'public');
            $userData['photo'] = $photoPath;
        }

        $user->update($userData);

        $teacher = $user->teacher;
        $teacher->update([
            'date_of_birth' => $request->date_of_birth,
            'nip' => $request->nip,
            'gender' => $request->gender,
            'specialization' => $request->specialization, // Will be cast as JSON
            'joined_date' => $request->joined_date,
            'phone' => $request->phone,
            'address' => $request->address,
        ]);

        if ($request->has('change_password') && $request->change_password) {
            $request->validate([
                'password' => 'required|min:6|confirmed',
            ]);

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
