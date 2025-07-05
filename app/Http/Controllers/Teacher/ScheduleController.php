<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Schedule;
use App\Models\Teacher;

class ScheduleController extends Controller
{
    public function index()
    {
        $teacher = Auth::user()->teacher;

        $dayOrder = ['monday', 'tuesday', 'wednesday', 'thursday', 'friday'];
        $days = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday'];
        $timeSlots = ['19:00-20:00', '20:00-21:00', '21:00-21:30'];

        $schedules = Schedule::with(['subject', 'classroom'])
            ->where('teacher_id', $teacher->id)
            ->orderByRaw("FIELD(day, '" . implode("','", $dayOrder) . "')")
            ->orderBy('start_time')
            ->get();

        $groupedSchedules = $schedules->groupBy(function ($schedule) {
            return $schedule->classroom->name;
        });

        return view('teacher.schedule.index', compact('schedules', 'days', 'timeSlots', 'groupedSchedules'));
    }

    public function timetable()
    {
        $teacher = Auth::user()->teacher;

        $days = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday'];
        $timeSlots = ['19:00-20:00', '20:00-21:00', '21:00-21:30'];

        $schedules = Schedule::with(['subject', 'classroom', 'teacher.user'])
            ->where('teacher_id', $teacher->id)
            ->get();

        // Group schedules by classroom name
        $groupedSchedules = $schedules->groupBy(function ($schedule) {
            return $schedule->classroom->name;
        });

        return view('teacher.schedule.timetable', compact('groupedSchedules', 'days', 'timeSlots'));
    }
}
