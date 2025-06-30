<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Schedule;
use App\Models\Classroom;

class ScheduleController extends Controller
{
    public function index()
    {
        $student = Auth::user()->student;

        if (!$student || !$student->classroom_id) {
            abort(403, 'No classroom assigned.');
        }

        $classroom = $student->classroom;
        $schedules = Schedule::with(['teacher.user', 'subject'])
            ->where('classroom_id', $classroom->id)
            ->orderBy('day')
            ->orderBy('start_time')
            ->get();

        $days = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday'];
        $timeSlots = ['19:00-20:00', '20:00-21:00', '21:00-21:30'];

        return view('student.schedule.index', compact('classroom', 'schedules', 'days', 'timeSlots'));
    }
}
