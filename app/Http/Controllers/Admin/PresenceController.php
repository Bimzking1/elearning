<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Schedule;
use App\Models\Presence;
use App\Models\Classroom;
use Illuminate\Http\Request;

class PresenceController extends Controller
{
    public function index()
    {
        // Get classrooms with their schedules, including subject and teacher
        $classrooms = Classroom::with('schedules.subject', 'schedules.teacher.user')->get();

        // Grouped for list view
        $groupedSchedules = $classrooms->map(function ($classroom) {
            return [
                'classroom' => $classroom,
                'schedules' => $classroom->schedules,
            ];
        });

        // Flattened for table view
        $schedules = $classrooms->pluck('schedules')->flatten();

        return view('admin.presence.index', compact('classrooms', 'groupedSchedules', 'schedules'));
    }

    public function showSchedulePresence(Classroom $classroom, Schedule $schedule)
    {
        $presences = Presence::where('schedule_id', $schedule->id)
            ->orderByDesc('opened_at')
            ->get();

        return view('admin.presence.show', compact('classroom', 'schedule', 'presences'));
    }

    public function openPresence(Classroom $classroom, Schedule $schedule, Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        Presence::create([
            'schedule_id' => $schedule->id,
            'name' => $request->name,
            'opened_at' => now(),
        ]);

        return redirect()->back()->with('success', 'Presence opened successfully.');
    }

    public function closePresence(Classroom $classroom, Schedule $schedule, Presence $presence)
    {
        $presence->update([
            'closed_at' => now(),
        ]);

        return redirect()->back()->with('success', 'Presence closed.');
    }

    public function reopenPresence(Classroom $classroom, Schedule $schedule, Presence $presence)
    {
        $presence->update([
            'reopened_at' => now(),
            'closed_at' => null,
        ]);

        return redirect()->back()->with('success', 'Presence reopened.');
    }

    public function viewPresence(Classroom $classroom, Schedule $schedule, Presence $presence)
    {
        $submissions = $presence->submissions()->with('student.user')->get();

        return view('admin.presence.detail', compact('classroom', 'schedule', 'presence', 'submissions'));
    }

    public function updateName(Request $request, Presence $presence)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $presence->update([
            'name' => $request->name,
        ]);

        return redirect()->back()->with('success', 'Presence name updated.');
    }

    public function destroy($classroomId, $scheduleId, $presenceId)
    {
        $presence = Presence::findOrFail($presenceId);
        $presence->delete();

        return redirect()
            ->route('admin.presence.show', [$classroomId, $scheduleId])
            ->with('success', 'Presence session deleted successfully.');
    }
}
