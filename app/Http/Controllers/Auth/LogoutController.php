<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LogoutController extends Controller
{
    /**
     * Handle user logout.
     */
    public function logout(Request $request)
    {
        Auth::guard('web')->logout(); // Logs out the user

        $request->session()->invalidate(); // Invalidates the session
        $request->session()->regenerateToken(); // Regenerates CSRF token

        return redirect('/login')->with('success', 'You have been logged out.');
    }
}
