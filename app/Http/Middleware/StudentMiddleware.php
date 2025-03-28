<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        // Check if the user is authenticated and has the student role
        if (Auth::check() && Auth::user()->role === 'student') {
            return $next($request);
        }

        return redirect('/'); // Redirect if not a student
    }
}
