<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Announcement;

class HomeController extends Controller
{
    public function index()
    {
        $announcements = Announcement::where(function ($query) {
            $query->where('roles', 'like', '%"teacher"%')
                  ->orWhere('roles', 'like', '%"all"%');
        })
        ->orderBy('created_at', 'desc')
        ->paginate(3); // 👈 Only 3 announcements per page

        return view('teacher.home.index', compact('announcements'));
    }
}
