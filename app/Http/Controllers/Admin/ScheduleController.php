<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Schedule;
use App\Models\Classroom;
use App\Models\Subject;
use App\Models\Teacher;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    // Show all schedules
    public function index()
    {
        // Fetch all schedules along with related classrooms, subjects, and teachers
        $schedules = Schedule::with(['classroom', 'subject', 'teacher'])->get();

        // Fetch all classrooms to use in the view (if needed for switching tables)
        $classrooms = Classroom::all();

        // Pass both schedules and classrooms to the view
        return view('admin.schedule.index', compact('schedules', 'classrooms'));
    }

    // Show create form
    public function create()
    {
        $classrooms = Classroom::all();
        $subjects = Subject::all();
        $teachers = Teacher::all();
        return view('admin.schedule.create', compact('classrooms', 'subjects', 'teachers'));
    }

    // Store new schedule
    public function store(Request $request)
    {
        $request->validate([
            'classroom_id' => 'required|exists:classrooms,id',
            'subject_id' => 'required|exists:subjects,id',
            'teacher_id' => 'required|exists:teachers,id',
            'day' => 'required|string',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
        ]);

        Schedule::create($request->all());

        return redirect()->route('admin.schedules.index')->with('success', 'Schedule created successfully.');
    }

    // Show edit form
    public function edit($id)
    {
        $schedule = Schedule::findOrFail($id);
        $classrooms = Classroom::all();
        $subjects = Subject::all();
        $teachers = Teacher::all();
        return view('admin.schedule.edit', compact('schedule', 'classrooms', 'subjects', 'teachers'));
    }

    // Update schedule
    public function update(Request $request, $id)
    {
        $request->validate([
            'classroom_id' => 'required|exists:classrooms,id',
            'subject_id' => 'required|exists:subjects,id',
            'teacher_id' => 'required|exists:teachers,id',
            'day' => 'required|string',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
        ]);

        $schedule = Schedule::findOrFail($id);
        $schedule->update($request->all());

        return redirect()->route('admin.schedules.index')->with('success', 'Schedule updated successfully.');
    }

    // Delete schedule
    public function destroy($id)
    {
        $schedule = Schedule::findOrFail($id);
        $schedule->delete();

        return redirect()->route('admin.schedules.index')->with('success', 'Schedule deleted successfully.');
    }
}
