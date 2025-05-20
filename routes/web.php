<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\TeacherController;
use App\Http\Controllers\Admin\SubjectController;
use App\Http\Controllers\Admin\StudentController;
use App\Http\Controllers\Admin\ScheduleController as AdminScheduleController;
use App\Http\Controllers\Student\ScheduleController as StudentScheduleController;
use App\Http\Controllers\Teacher\ScheduleController as TeacherScheduleController;
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
use App\Http\Controllers\Admin\TaskController as AdminTaskController;
use App\Http\Controllers\Teacher\TaskController as TeacherTaskController;
use App\Http\Controllers\Student\TaskSubmissionController as StudentTaskSubmissionController;
use App\Http\Controllers\Teacher\TaskSubmissionController as TeacherTaskSubmissionController;
use App\Http\Controllers\Admin\TaskSubmissionController as AdminTaskSubmissionController;
use App\Http\Controllers\Student\ProfileController as StudentProfileController;
use App\Http\Controllers\Teacher\ProfileController as TeacherProfileController;

Route::get('/', function () {
    if (auth()->check()) {
        return redirect()->route('redirect');
    }

    return view('welcome');
})->name('welcome');

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

    // Subjects Management
    Route::controller(SubjectController::class)->group(function () {
        Route::get('/subjects', 'index')->name('admin.subjects.index');
        Route::get('/subjects/create', 'create')->name('admin.subjects.create');
        Route::post('/subjects', 'store')->name('admin.subjects.store');
        Route::get('/subjects/{subject}/edit', 'edit')->name('admin.subjects.edit');
        Route::put('/subjects/{subject}', 'update')->name('admin.subjects.update');
        Route::delete('/subjects/{subject}', 'destroy')->name('admin.subjects.destroy');
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

    // Schedule Management (Admins only)
    Route::controller(AdminScheduleController::class)->group(function () {
        Route::get('/schedules', 'index')->name('admin.schedules.index');
        Route::get('/schedules/create', 'create')->name('admin.schedules.create');
        Route::post('/schedules', 'store')->name('admin.schedules.store');
        Route::get('/schedules/{schedule}/edit', 'edit')->name('admin.schedules.edit');
        Route::put('/schedules/{schedule}', 'update')->name('admin.schedules.update');
        Route::delete('/schedules/{schedule}', 'destroy')->name('admin.schedules.destroy');
    });

    Route::controller(AdminTaskController::class)->group(function () {
        Route::get('/tasks', 'index')->name('admin.tasks.index');
        Route::get('/tasks/create', 'create')->name('admin.tasks.create');
        Route::post('/tasks', 'store')->name('admin.tasks.store');
        Route::get('/tasks/{task}/edit', 'edit')->name('admin.tasks.edit');
        Route::put('/tasks/{task}', 'update')->name('admin.tasks.update');
        Route::delete('/tasks/{task}', 'destroy')->name('admin.tasks.destroy');

        // Task Submission Routes inside the admin group (Corrected)
        Route::prefix('/tasks/{task}/submissions')->name('admin.tasks.submissions.')->group(function () {
            Route::get('/', [AdminTaskSubmissionController::class, 'index'])->name('index');
            Route::get('/{submission}/edit', [AdminTaskSubmissionController::class, 'edit'])->name('edit');
            Route::put('/{submission}', [AdminTaskSubmissionController::class, 'update'])->name('update'); // Make sure this is correct
        });
    });
});

// Teacher Routes (Only for Teachers)
Route::prefix('teacher')->middleware(['auth', RoleMiddleware::class . ':teacher'])->group(function () {
    Route::get('/home', [TeacherHomeController::class, 'index'])->name('teacher.home');
    Route::get('/schedules', [TeacherScheduleController::class, 'index'])->name('teacher.schedules.index');
    Route::resource('/tasks', TeacherTaskController::class)->names('teacher.tasks');

    // Teacher Task Submission Routes (Corrected)
    Route::prefix('tasks/{task}/submissions')->name('teacher.tasks.submissions.')->group(function () {
        Route::get('/', [TeacherTaskSubmissionController::class, 'index'])->name('index');
        Route::get('/{submission}/edit', [TeacherTaskSubmissionController::class, 'edit'])->name('edit');
        Route::put('/{submission}', [TeacherTaskSubmissionController::class, 'update'])->name('update'); // Fixed route
    });
    Route::get('/profile', [TeacherProfileController::class, 'index'])->name('profile.index');
});

// Student Routes (Only for Students)
Route::prefix('student')->middleware(['auth', 'role:student'])->name('student.')->group(function () {
    // Student Dashboard Route
    Route::get('/home', [StudentHomeController::class, 'index'])->name('home');

    // Student Schedule Route
    Route::get('/schedules', [StudentScheduleController::class, 'index'])->name('schedules.index');

    // Task Submission Routes
    Route::prefix('tasks')->name('tasks.')->group(function () {
        Route::get('/', [StudentTaskSubmissionController::class, 'index'])->name('index');
        Route::get('/{task}/submit', [StudentTaskSubmissionController::class, 'create'])->name('submit');
        Route::post('/{task}/submit', [StudentTaskSubmissionController::class, 'store'])->name('store');
        Route::get('/{task}/submission', [StudentTaskSubmissionController::class, 'show'])->name('show');

        // New Routes for Edit and Update
        Route::get('/{task}/edit', [StudentTaskSubmissionController::class, 'edit'])->name('edit');
        Route::put('/{task}/update', [StudentTaskSubmissionController::class, 'update'])->name('update');
    });

    Route::get('/profile', [StudentProfileController::class, 'index'])->name('profile.index');
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
