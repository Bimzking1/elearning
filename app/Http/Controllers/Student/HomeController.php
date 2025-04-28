<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Announcement;

class HomeController extends Controller
{
    public function index()
    {
        $announcements = Announcement::where(function ($query) {
            $query->where('roles', 'like', '%"student"%')
                  ->orWhere('roles', 'like', '%"all"%');
        })
        ->orderBy('created_at', 'desc')
        ->paginate(3); // 👈 Only 3 announcements per page

        return view('student.home.index', compact('announcements'));
    }
}
