<?php

use App\Http\Controllers\CourseController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// everything below needs the user to be logged in (Jetstream)
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // ---- admin only ----
    Route::middleware('permission:students.manage')->group(function () {
        Route::resource('students', StudentController::class);
    });

    Route::middleware('permission:users.manage')->group(function () {
        Route::get('/users', [UserController::class, 'index'])->name('users.index');
        Route::put('/users/{user}/role', [UserController::class, 'updateRole'])->name('users.role');
    });

    Route::middleware('permission:courses.manage')->group(function () {
        // these must come BEFORE /courses/{course}, or "create" is read as a course id
        Route::resource('courses', CourseController::class)
            ->only(['create', 'store', 'edit', 'update', 'destroy']);
    });

    Route::post('/admin/registrations', [RegistrationController::class, 'storeForStudent'])
        ->middleware('permission:registrations.manage')->name('registrations.admin-store');

    // ---- student only ----
    Route::post('/registrations', [RegistrationController::class, 'store'])
        ->middleware('permission:registrations.create-own')->name('registrations.store');

    // ---- any user that has one of the three roles ("|" means OR) ----
    Route::middleware('role:admin|lecturer|student')->group(function () {
        Route::resource('courses', CourseController::class)->only(['index', 'show']);
        Route::get('/registrations', [RegistrationController::class, 'index'])->name('registrations.index');
        Route::delete('/registrations/{registration}', [RegistrationController::class, 'destroy'])->name('registrations.destroy');
    });
});
