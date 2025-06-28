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
        $schedules = Schedule::with(['classroom', 'subject', 'teacher'])->get();
        $classrooms = Classroom::all();

        return view('admin.schedule.index', compact('schedules', 'classrooms'));
    }

    // Show create form
    public function create()
    {
        $classrooms = Classroom::all();
        $subjects = Subject::all();
        $teachers = Teacher::all();

        // Get all existing schedules
        $schedules = Schedule::select('classroom_id', 'day', 'start_time', 'end_time')->get();

        // Build a map of occupied slots per classroom and day
        $occupiedSlots = [];
        foreach ($schedules as $schedule) {
            $slot = $schedule->start_time . '-' . $schedule->end_time;
            $occupiedSlots[$schedule->classroom_id][$schedule->day][] = $slot;
        }

        return view('admin.schedule.create', compact('classrooms', 'subjects', 'teachers', 'occupiedSlots'));
    }

    // Store new schedule
    public function store(Request $request)
    {
        $request->validate([
            'classroom_id' => 'required|exists:classrooms,id',
            'subject_id' => 'required|exists:subjects,id',
            'teacher_id' => 'required|exists:teachers,id',
            'day' => 'required|string',
            'time_slot' => 'required|regex:/^\d{2}:\d{2}:\d{2}-\d{2}:\d{2}:\d{2}$/',
        ]);

        [$start_time, $end_time] = explode('-', $request->time_slot);

        Schedule::create([
            'classroom_id' => $request->classroom_id,
            'subject_id' => $request->subject_id,
            'teacher_id' => $request->teacher_id,
            'day' => $request->day,
            'start_time' => $start_time,
            'end_time' => $end_time,
        ]);

        return redirect()->route('admin.schedules.index')->with('success', 'Schedule created successfully.');
    }

    // Show edit form
    public function edit($id)
    {
        $schedule = Schedule::findOrFail($id);
        $classrooms = Classroom::all();
        $subjects = Subject::all();
        $teachers = Teacher::all();

        // Combine start and end time into a time_slot string
        $time_slot = $schedule->start_time . '-' . $schedule->end_time;

        // Fetch all other schedules except the one being edited
        $otherSchedules = Schedule::where('id', '!=', $schedule->id)
            ->select('classroom_id', 'day', 'start_time', 'end_time')
            ->get();

        // Build occupiedSlots excluding the current one
        $occupiedSlots = [];
        foreach ($otherSchedules as $s) {
            $slot = $s->start_time . '-' . $s->end_time;
            $occupiedSlots[$s->classroom_id][$s->day][] = $slot;
        }

        return view('admin.schedule.edit', compact('schedule', 'classrooms', 'subjects', 'teachers', 'time_slot', 'occupiedSlots'));
    }

    // Update schedule
    public function update(Request $request, $id)
    {
        $request->validate([
            'classroom_id' => 'required|exists:classrooms,id',
            'subject_id' => 'required|exists:subjects,id',
            'teacher_id' => 'required|exists:teachers,id',
            'day' => 'required|string',
            'time_slot' => 'required|regex:/^\d{2}:\d{2}:\d{2}-\d{2}:\d{2}:\d{2}$/',
        ]);

        [$start_time, $end_time] = explode('-', $request->time_slot);

        $schedule = Schedule::findOrFail($id);
        $schedule->update([
            'classroom_id' => $request->classroom_id,
            'subject_id' => $request->subject_id,
            'teacher_id' => $request->teacher_id,
            'day' => $request->day,
            'start_time' => $start_time,
            'end_time' => $end_time,
        ]);

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
