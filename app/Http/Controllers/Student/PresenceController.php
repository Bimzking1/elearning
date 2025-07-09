<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Presence;
use App\Models\PresenceSubmission;

class PresenceController extends Controller
{
    public function index()
    {
        $student = Auth::user()->student;

        $presences = Presence::with(['schedule.subject', 'schedule.teacher.user'])
            ->whereHas('schedule', function ($q) use ($student) {
                $q->where('classroom_id', $student->classroom_id);
            })->latest()->get();

        $schedules = \App\Models\Schedule::with(['subject', 'teacher.user'])
            ->where('classroom_id', $student->classroom_id)
            ->get();

        return view('student.presence.index', compact('presences', 'schedules'));
    }

    public function scheduleHistory($scheduleId)
    {
        $student = Auth::user()->student;

        $presences = Presence::where('schedule_id', $scheduleId)
            ->whereHas('schedule', function ($query) use ($student) {
                $query->where('classroom_id', $student->classroom_id);
            })
            ->latest()
            ->get();

        return view('student.presence.history', compact('presences'));
    }

    public function show(Presence $presence)
    {
        $student = Auth::user()->student;

        // Make sure the student is allowed to view
        if ($presence->schedule->classroom_id !== $student->classroom_id) {
            abort(403);
        }

        $submitted = PresenceSubmission::where('presence_id', $presence->id)
            ->where('student_id', $student->id)
            ->first();

        return view('student.presence.show', compact('presence', 'submitted'));
    }

    public function submit(Request $request, Presence $presence)
    {
        $student = Auth::user()->student;

        if ($presence->schedule->classroom_id !== $student->classroom_id) {
            abort(403);
        }

        $request->validate([
            'photo' => 'required|image|max:2048',
        ]);

        // Store file
        $path = $request->file('photo')->store('presence_photos', 'public');

        PresenceSubmission::create([
            'presence_id' => $presence->id,
            'student_id' => $student->id,
            'photo_path' => $path,
        ]);

        return redirect()->route('student.presence.index')->with('success', 'Presence submitted!');
    }
}
