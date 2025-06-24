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

        return view('teacher.schedule.index', compact('schedules', 'days', 'timeSlots'));
    }

    public function timetable()
    {
        $teacher = Auth::user()->teacher;

        $days = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday'];
        $timeSlots = ['19:00-20:00', '20:00-21:00', '21:00-21:30'];

        // Load schedules for all classes that this teacher teaches
        $schedules = Schedule::with(['subject', 'classroom', 'teacher.user'])
            ->whereHas('teacher', function ($query) use ($teacher) {
                $query->where('id', $teacher->id);
            })
            ->get();

        return view('teacher.schedule.timetable', compact('days', 'timeSlots', 'schedules'));
    }
}
