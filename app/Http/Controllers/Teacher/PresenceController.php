<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Schedule;
use App\Models\Presence;
use App\Models\PresenceSubmission;
use App\Models\Classroom;

class PresenceController extends Controller
{
    public function index()
    {
        $teacher = Auth::user()->teacher;

        $schedules = Schedule::with(['subject', 'classroom'])
            ->where('teacher_id', $teacher->id)
            ->orderBy('day')
            ->orderBy('start_time')
            ->get();

        return view('teacher.presence.index', compact('schedules'));
    }

    public function showSchedulePresence(Request $request, Classroom $classroom, Schedule $schedule)
    {
        $this->authorizeSchedule($schedule);

        $query = Presence::where('schedule_id', $schedule->id);

        // Search
        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        // Sorting
        $allowedSorts = ['name', 'opened_at', 'reopened_at', 'closed_at'];
        $sort = $request->get('sort', 'opened_at');
        $direction = $request->get('direction', 'desc');

        if (in_array($sort, $allowedSorts)) {
            $query->orderBy($sort, $direction);
        }

        $presences = $query->paginate(20)->withQueryString();

        return view('teacher.presence.show', compact('classroom', 'schedule', 'presences', 'sort', 'direction'));
    }

    public function openPresence(Classroom $classroom, Schedule $schedule, Request $request)
    {
        $this->authorizeSchedule($schedule);

        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        Presence::create([
            'schedule_id' => $schedule->id,
            'name' => $request->name,
            'opened_at' => now(),
        ]);

        return redirect()->back()->with('success', 'Presence session opened.');
    }

    public function closePresence(Classroom $classroom, Schedule $schedule, Presence $presence)
    {
        $this->authorizeSchedule($schedule);

        $presence->update([
            'closed_at' => now(),
        ]);

        return redirect()->back()->with('success', 'Presence session closed.');
    }

    public function reopenPresence(Classroom $classroom, Schedule $schedule, Presence $presence)
    {
        $this->authorizeSchedule($schedule);

        $presence->update([
            'reopened_at' => now(),
            'closed_at' => null,
        ]);

        return redirect()->back()->with('success', 'Presence session reopened.');
    }

    public function viewPresence(Classroom $classroom, Schedule $schedule, Presence $presence)
    {
        $this->authorizeSchedule($schedule);

        $query = $presence->submissions()
            ->select('presence_submissions.*')
            ->join('students', 'presence_submissions.student_id', '=', 'students.id')
            ->join('users', 'students.user_id', '=', 'users.id')
            ->with('student.user');

        // Search by student name
        if (request('search')) {
            $query->where('users.name', 'like', '%' . request('search') . '%');
        }

        // Sorting
        $sort = request('sort', 'presence_submissions.created_at');
        $direction = request('direction', 'desc');

        $sortable = [
            'student_name' => 'users.name',
            'nis' => 'students.nis',
            'created_at' => 'presence_submissions.created_at',
        ];

        if (isset($sortable[$sort])) {
            $query->orderBy($sortable[$sort], $direction);
        }

        $submissions = $query->paginate(20)->withQueryString();

        return view('teacher.presence.detail', compact('schedule', 'classroom', 'presence', 'submissions', 'sort', 'direction'));
    }

    public function updateName(Request $request, Presence $presence)
    {
        $schedule = $presence->schedule;
        $this->authorizeSchedule($schedule);

        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $presence->update([
            'name' => $request->name,
        ]);

        return redirect()->back()->with('success', 'Presence name updated.');
    }

    public function destroy(Classroom $classroom, Schedule $schedule, Presence $presence)
    {
        $this->authorizeSchedule($schedule);

        $presence->delete();

        return redirect()->route('teacher.presence.show', [$classroom->id, $schedule->id])
            ->with('success', 'Presence session deleted.');
    }

    private function authorizeSchedule(Schedule $schedule)
    {
        if ($schedule->teacher_id !== Auth::user()->teacher->id) {
            abort(403);
        }
    }
}
