<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Classroom;
use App\Models\Teacher;
use Illuminate\Http\Request;

class ClassroomController extends Controller
{
    /**
     * Display a listing of the classrooms.
     */
    public function index()
    {
        $classrooms = Classroom::with('teacher')->get();
        return view('admin.classrooms.index', compact('classrooms'));
    }

    /**
     * Show the form for creating a new classroom.
     */
    public function create()
    {
        $teachers = Teacher::all(); // Get all teachers for selection
        $teachers = \App\Models\Teacher::with('user')->get();
        return view('admin.classrooms.create', compact('teachers'));
    }

    /**
     * Store a newly created classroom in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|unique:classrooms,name',
            'teacher_id' => 'required|exists:teachers,id'
        ]);

        Classroom::create($request->all());

        return redirect()->route('admin.classrooms.index')->with('success', 'Classroom created successfully!');
    }

    /**
     * Show the form for editing the specified classroom.
     */
    public function edit(Classroom $classroom)
    {
        $teachers = Teacher::all(); // Get all teachers for selection
        return view('admin.classrooms.edit', compact('classroom', 'teachers'));
    }

    /**
     * Update the specified classroom in storage.
     */
    public function update(Request $request, Classroom $classroom)
    {
        $request->validate([
            'name' => 'required|string|unique:classrooms,name,' . $classroom->id,
            'teacher_id' => 'required|exists:teachers,id'
        ]);

        $classroom->update($request->all());

        return redirect()->route('admin.classrooms.index')->with('success', 'Classroom updated successfully!');
    }

    /**
     * Remove the specified classroom from storage.
     */
    public function destroy(Classroom $classroom)
    {
        $classroom->delete();

        return redirect()->route('admin.classrooms.index')->with('success', 'Classroom deleted successfully!');
    }
}
