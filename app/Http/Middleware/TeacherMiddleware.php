<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TeacherMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        // Check if the user is authenticated and has the teacher role
        if (Auth::check() && Auth::user()->role === 'teacher') {
            return $next($request);
        }

        return redirect('/'); // Redirect if not a teacher
    }
}
