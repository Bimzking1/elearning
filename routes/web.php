<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\TeacherController;
use App\Http\Controllers\Admin\StudentController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Teacher\HomeController as TeacherHomeController;
use App\Http\Controllers\Student\HomeController as StudentHomeController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\TeacherMiddleware;
use App\Http\Middleware\StudentMiddleware;

// Welcome Page
Route::get('/', function () {
    return view('welcome');
});

// Dashboard (Redirect based on role)
Route::get('/redirect', function () {
    $user = auth()->user();

    if ($user->role === 'admin') {
        return redirect()->route('admin.home');
    } elseif ($user->role === 'teacher') {
        return redirect()->route('teacher.home');
    } elseif ($user->role === 'student') {
        return redirect()->route('student.home');
    }

    return abort(403);
})->middleware(['auth', 'verified'])->name('redirect');

// Admin Routes (Only for Admins)
Route::prefix('admin')->middleware(['auth', AdminMiddleware::class])->group(function () {
// Route::prefix('admin')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/home', function () {
        return view('admin.home.index');
    })->name('admin.home');

    // Teacher & Student Management
    Route::controller(TeacherController::class)->group(function () {
        Route::get('/teacher', 'index')->name('admin.teacher.index');
        Route::get('/teacher/create', 'create')->name('admin.teacher.create');
        Route::post('/teacher', 'store')->name('admin.teacher.store');
        Route::get('/teacher/{user}/edit', 'edit')->name('admin.teacher.edit');
        Route::put('/teacher/{user}', 'update')->name('admin.teacher.update');
        Route::delete('/teacher/{user}', 'destroy')->name('admin.teacher.destroy');
    });
});

// Admin Routes
// Route::prefix('admin')->middleware(['auth', 'admin'])->group(function () {
//     Route::get('/home', function () {
//         return view('admin.home.index');
//     })->name('admin.home');

//     // Teacher, Student, and other management routes
//     Route::get('/teacher', [TeacherController::class, 'index'])->name('admin.teacher.index');
//     Route::get('/student', [StudentController::class, 'index'])->name('admin.student.index');
//     Route::get('/users', [UserController::class, 'index'])->name('admin.users.index');
// });

// Teacher Routes (Only for Teachers)
Route::prefix('teacher')->middleware(['auth', TeacherMiddleware::class])->group(function () {
    Route::get('/home', [TeacherHomeController::class, 'index'])->name('teacher.home');
});

// Student Routes (Only for Students)
Route::prefix('student')->middleware(['auth', StudentMiddleware::class])->group(function () {
    Route::get('/home', [StudentHomeController::class, 'index'])->name('student.home');
});

// Profile routes (For All Authenticated Users)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Logout Route
Route::post('/logout', [LogoutController::class, 'logout'])->middleware('auth');

require __DIR__.'/auth.php';
