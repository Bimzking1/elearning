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
use App\Http\Controllers\Admin\ClassroomController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\PasswordResetController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Middleware\RoleMiddleware;
use App\Http\Controllers\Admin\AnnouncementController;

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
Route::prefix('admin')->middleware(['auth', RoleMiddleware::class.':admin'])->group(function () {
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

    // Classroom Management
    Route::controller(ClassroomController::class)->group(function () {
        Route::get('/classrooms', 'index')->name('admin.classrooms.index');
        Route::get('/classrooms/create', 'create')->name('admin.classrooms.create');
        Route::post('/classrooms', 'store')->name('admin.classrooms.store');
        Route::get('/classrooms/{classroom}/edit', 'edit')->name('admin.classrooms.edit');
        Route::put('/classrooms/{classroom}', 'update')->name('admin.classrooms.update');
        Route::delete('/classrooms/{classroom}', 'destroy')->name('admin.classrooms.destroy');
    });

    Route::controller(StudentController::class)->group(function () {
        Route::get('/students', 'index')->name('admin.students.index');
        Route::get('/students/create', 'create')->name('admin.students.create');
        Route::post('/students', 'store')->name('admin.students.store');
        Route::get('/students/{student}/edit', 'edit')->name('admin.students.edit');
        Route::put('/students/{student}', 'update')->name('admin.students.update');
        Route::delete('/students/{student}', 'destroy')->name('admin.students.destroy');
    });

    Route::controller(AnnouncementController::class)->group(function () {
        Route::get('/announcements', 'index')->name('admin.announcements.index');
        Route::get('/announcements/create', 'create')->name('admin.announcements.create');
        Route::post('/announcements', 'store')->name('admin.announcements.store');
        Route::get('/announcements/{announcement}/edit', 'edit')->name('admin.announcements.edit');
        Route::put('/announcements/{announcement}', 'update')->name('admin.announcements.update');
        Route::delete('/announcements/{announcement}', 'destroy')->name('admin.announcements.destroy');
    });
});

// Teacher Routes (Only for Teachers)
// Route::prefix('teacher')->middleware(['auth', RoleMiddleware::class.':teacher'])->group(function () {
//     Route::get('/home', [TeacherHomeController::class, 'index'])->name('teacher.home');
// });

// Route::prefix('teacher')->middleware(['auth', RoleMiddleware::class.':teacher'])->group(function () {
//     Route::get('/home', function () {
//         return view('teacher.home.index');
//     })->name('teacher.home');
//     Route::controller(TeacherHomeController::class)->group(function () {
//         // Route::get('/home', 'index')->name('teacher.home.index');
//         Route::get('/announcement', 'index')->name('teacher.announcement.index');
//     });
// });

// ✅ This one is correct — KEEP THIS
Route::prefix('teacher')->middleware(['auth', RoleMiddleware::class.':teacher'])->group(function () {
    Route::get('/home', [TeacherHomeController::class, 'index'])->name('teacher.home');
    // Route::get('/announcement', [TeacherHomeController::class, 'announcement'])->name('teacher.announcement.index');
});

// Route::prefix('teacher')->middleware(['auth', RoleMiddleware::class.':teacher'])->group(function () {
//     Route::get('/home', [TeacherHomeController::class, 'index'])->name('teacher.home.index');
//     Route::get('/announcement', [TeacherHomeController::class, 'index'])->name('teacher.announcement.index');
// });


// Student Routes (Only for Students)
Route::prefix('student')->middleware(['auth', RoleMiddleware::class.':student'])->group(function () {
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

// Forgot Password Routes
Route::get('/forgot-password', [PasswordResetController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('/forgot-password', [PasswordResetController::class, 'sendResetLinkEmail'])->name('password.email');

// Reset Password Routes
Route::get('/reset-password/{token}', [NewPasswordController::class, 'create'])->name('password.reset');
Route::put('/reset-password', [NewPasswordController::class, 'store'])->name('password.override');

require __DIR__.'/auth.php';
