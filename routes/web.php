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
use App\Http\Controllers\Admin\ClassroomController;

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

    // **Classroom Management**

    // Longer Way
    Route::controller(ClassroomController::class)->group(function () {
        Route::get('/classrooms', 'index')->name('admin.classrooms.index');
        Route::get('/classrooms/create', 'create')->name('admin.classrooms.create');
        Route::post('/classrooms', 'store')->name('admin.classrooms.store');
        Route::get('/classrooms/{classroom}/edit', 'edit')->name('admin.classrooms.edit');
        Route::put('/classrooms/{classroom}', 'update')->name('admin.classrooms.update');
        Route::delete('/classrooms/{classroom}', 'destroy')->name('admin.classrooms.destroy');
    });

    // Shorter Way and Clearner Way to define
    //     Route::resource('classrooms', ClassroomController::class)->names([
    //         'index' => 'admin.classrooms.index',
    //         'create' => 'admin.classrooms.create',
    //         'store' => 'admin.classrooms.store',
    //         'edit' => 'admin.classrooms.edit',
    //         'update' => 'admin.classrooms.update',
    //         'destroy' => 'admin.classrooms.destroy',
    //     ]);

    Route::controller(StudentController::class)->group(function () {
        Route::get('/students', 'index')->name('admin.students.index');
        Route::get('/students/create', 'create')->name('admin.students.create');
        Route::post('/students', 'store')->name('admin.students.store');
        Route::get('/students/{student}/edit', 'edit')->name('admin.students.edit'); // ✅ Fixes your issue
        Route::put('/students/{student}', 'update')->name('admin.students.update');
        Route::delete('/students/{student}', 'destroy')->name('admin.students.destroy');
    });
});

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
