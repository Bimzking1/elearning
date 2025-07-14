<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Schedule;
use App\Models\Presence;
use App\Models\Classroom;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class PresenceController extends Controller
{
    public function index(Request $request)
    {
        $view = $request->get('view', 'table');
        $subjectFilter = $request->input('subject');
        $classroomFilter = $request->input('classroom');

        // Load classrooms with their schedules, subject, and teacher's user
        $query = Classroom::with(['schedules.subject', 'schedules.teacher.user']);

        if ($classroomFilter) {
            $query->where('name', 'like', '%' . $classroomFilter . '%');
        }

        $classrooms = $query->get();

        // Table View (Grouped by classroom)
        $groupedSchedules = $classrooms->map(function ($classroom) use ($subjectFilter) {
            $filteredSchedules = $classroom->schedules;

            if (request()->filled('subject')) {
                $filteredSchedules = $filteredSchedules->filter(function ($schedule) use ($subjectFilter) {
                    return str_contains(strtolower($schedule->subject->name ?? ''), strtolower($subjectFilter));
                });
            }

            return [
                'classroom' => $classroom,
                'schedules' => $filteredSchedules,
            ];
        });

        // List View (Flat list of schedules with sorting and pagination)
        if ($view === 'list') {
            $flattenedSchedules = $classrooms->pluck('schedules')->flatten();

            // Apply filters
            if ($subjectFilter) {
                $flattenedSchedules = $flattenedSchedules->filter(function ($schedule) use ($subjectFilter) {
                    return str_contains(strtolower($schedule->subject->name ?? ''), strtolower($subjectFilter));
                });
            }

            if ($classroomFilter) {
                $flattenedSchedules = $flattenedSchedules->filter(function ($schedule) use ($classroomFilter) {
                    return str_contains(strtolower($schedule->classroom->name), strtolower($classroomFilter));
                });
            }

            // Apply sorting
            $allowedSorts = ['classroom', 'subject', 'teacher', 'day', 'start_time'];
            $sort = $request->get('sort');
            $direction = $request->get('direction', 'asc');

            if ($sort && in_array($sort, $allowedSorts)) {
                $flattenedSchedules = $flattenedSchedules->sortBy(function ($item) use ($sort) {
                    return match ($sort) {
                        'classroom' => $item->classroom->name,
                        'subject' => $item->subject->name ?? '',
                        'teacher' => $item->teacher->user->name ?? '',
                        'day' => $item->day,
                        'start_time' => $item->start_time,
                        default => '',
                    };
                }, SORT_REGULAR, $direction === 'desc');
            }

            // Reset keys before pagination
            $flattenedSchedules = $flattenedSchedules->values();

            // Manual pagination
            $currentPage = LengthAwarePaginator::resolveCurrentPage();
            $perPage = 20; // Change to your desired limit
            $schedules = new LengthAwarePaginator(
                $flattenedSchedules->slice(($currentPage - 1) * $perPage, $perPage)->values(),
                $flattenedSchedules->count(),
                $perPage,
                $currentPage,
                ['path' => request()->url(), 'query' => request()->query()]
            );
        } else {
            $schedules = collect(); // empty for table view
            $sort = null;
            $direction = null;
        }

        return view('admin.presence.index', compact(
            'view',
            'classrooms',
            'groupedSchedules',
            'schedules',
            'sort',
            'direction'
        ));
    }

    public function showSchedulePresence(Classroom $classroom, Schedule $schedule, Request $request)
    {
        $query = Presence::where('schedule_id', $schedule->id);

        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        $sortableColumns = ['id', 'name', 'opened_at', 'reopened_at', 'closed_at', 'status'];
        $sort = in_array($request->get('sort'), $sortableColumns) ? $request->get('sort') : 'opened_at';
        $direction = $request->get('direction') === 'asc' ? 'asc' : 'desc';

        if ($sort === 'status') {
            $presences = $query->orderByRaw('CASE WHEN closed_at IS NULL THEN 0 ELSE 1 END ' . $direction)
                ->paginate(20)
                ->withQueryString();
        } else {
            $presences = $query->orderBy($sort, $direction)
                ->paginate(20)
                ->withQueryString();
        }

        return view('admin.presence.show', compact('classroom', 'schedule', 'presences', 'sort', 'direction'));
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

    public function viewPresence(Classroom $classroom, Schedule $schedule, Presence $presence, Request $request)
    {
        $query = $presence->submissions()->with('student.user');

        // ✅ Search by student name
        if ($request->filled('search')) {
            $query->whereHas('student.user', function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%');
            });
        }

        // ✅ Sortable columns
        $sortableColumns = ['name', 'nis', 'created_at'];
        $sort = in_array($request->get('sort'), $sortableColumns) ? $request->get('sort') : 'created_at';
        $direction = $request->get('direction') === 'asc' ? 'asc' : 'desc';

        if ($sort === 'name') {
            $query->join('students', 'presence_submissions.student_id', '=', 'students.id')
                ->join('users', 'students.user_id', '=', 'users.id')
                ->orderBy('users.name', $direction)
                ->select('presence_submissions.*'); // needed after join
        } elseif ($sort === 'nis') {
            $query->join('students', 'presence_submissions.student_id', '=', 'students.id')
                ->orderBy('students.nis', $direction)
                ->select('presence_submissions.*');
        } else {
            $query->orderBy('created_at', $direction);
        }

        $submissions = $query->paginate(20)->withQueryString();

        return view('admin.presence.detail', compact('classroom', 'schedule', 'presence', 'submissions', 'sort', 'direction'));
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
