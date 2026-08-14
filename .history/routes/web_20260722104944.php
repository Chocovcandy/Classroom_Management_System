<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoleSelectController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DepartmentController;
use App\Http\Controllers\Admin\UserController;

Route::get('/', [AuthController::class, 'welcome'])->name('welcome');
Route::get('/register', [AuthController::class, 'register'])->name('register');

// Authentication routes (login, register, etc.) are provided by Breeze
Route::middleware(['auth'])->group(function () {

    // Role selection (after login)
    Route::get('/role/select', [RoleSelectController::class, 'show'])
        ->name('role.select');

    Route::post('/role/select', [RoleSelectController::class, 'store'])
        ->name('role.select.store');

    // Profile (any logged-in user)
    Route::controller(ProfileController::class)->group(function () {
        Route::get('/profile', 'edit')->name('profile.edit');
        Route::patch('/profile', 'update')->name('profile.update');
        Route::delete('/profile', 'destroy')->name('profile.destroy');
    });

    // Admin routes
    Route::prefix('admin')
        ->name('admin.')
        ->middleware(['role:Admin'])
        ->group(function () {

            Route::view('/dashboard', 'admin.dashboard')
                ->name('dashboard');

            Route::resource('users', UserController::class);
            Route::resource('departments', DepartmentController::class);
        });

 // Dean rputes
    Route::prefix('dean')
        ->name('dean.')
        ->middleware(['role:Dean'])
        ->group(function () {
            Route::view('/dashboard', 'dean.dashboard')
                ->name('dashboard');
        });

    //HoD routes
    Route::prefix('hod')
        ->name('hod.')
        ->middleware(['role:HoD'])
        ->group(function () {
            Route::view('/dashboard', 'hod.dashboard')
                ->name('dashboard');
        });

    // Professor routes
    Route::prefix('professor')
        ->name('professor.')
        ->middleware(['role:Professor'])
        ->group(function () {
            Route::view('/dashboard', 'professor.dashboard')
                ->name('dashboard');
        });

    // Student routes
    Route::prefix('student')
        ->name('student.')
        ->middleware(['role:Student'])
        ->group(function () {
            Route::view('/dashboard', 'student.dashboard')
                ->name('dashboard');
        });

    
});

require __DIR__.'/auth.php';