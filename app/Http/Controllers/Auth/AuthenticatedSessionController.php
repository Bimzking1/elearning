<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    public function create(): View
    {
        return view('auth.login');
    }

    public function store(Request $request)
    {
        $credentials = $request->validate([
            'identifier' => 'required|string',
            'password' => 'required|string',
            'login_type' => 'required|string|in:email,nisn_nip',
        ]);

        $identifier = $credentials['identifier'];
        $password = $credentials['password'];

        if ($credentials['login_type'] === 'email') {
            $user = \App\Models\User::where('email', $identifier)->first();
        } else {
            $student = \App\Models\Student::where('nis', $identifier)->first();
            $teacher = \App\Models\Teacher::where('nip', $identifier)->first();

            $user = $student?->user ?? $teacher?->user;
        }

        if (!$user || !\Hash::check($password, $user->password)) {
            return back()->withErrors(['identifier' => 'Invalid credentials'])->withInput();
        }

        Auth::login($user);
        $request->session()->regenerate();

        // Redirect based on role
        if ($user->role === 'admin') {
            return redirect()->route('admin.home');
        } elseif ($user->role === 'teacher') {
            return redirect()->route('teacher.home');
        } elseif ($user->role === 'student') {
            return redirect()->route('student.home');
        }

        // Default redirect (in case something goes wrong)
        return redirect('/');
    }

    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
