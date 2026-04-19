<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoleSelectController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DepartmentAssignmentController;
use App\Http\Controllers\Admin\DepartmentController;

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::middleware(['auth'])->group(function () {

    // Role selection
    Route::get('/role/select', [RoleSelectController::class, 'show'])
        ->name('role.select');

    Route::post('/role/select', [RoleSelectController::class, 'store'])
        ->name('role.select.store');

    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');

    // ADMIN ROUTES
   Route::prefix('admin')
    ->name('admin.')
    ->middleware('role:Admin')
    ->group(function () {

        // Dashboard
        Route::view('/dashboard', 'admin.dashboard')
            ->name('dashboard');

        // Users CRUD
        Route::resource('users', \App\Http\Controllers\Admin\UserController::class);
    
        // Departments CRUD
        Route::resource('departments', DepartmentController::class);

        // Department assignments
        Route::get('/department-assignments', [DepartmentAssignmentController::class, 'index'])
            ->name('department.assignments');

        Route::post('/department-assign', [DepartmentAssignmentController::class, 'assign'])
            ->name('department.assign');

        Route::post('/department-remove', [DepartmentAssignmentController::class, 'remove'])
            ->name('department.remove');

        Route::post('/department-bulk-assign', [DepartmentAssignmentController::class, 'bulkAssign'])
            ->name('department.bulkAssign');
    });


    
    Route::middleware('role:Dean')->group(function () {
        Route::view('/dean/dashboard', 'dean.dashboard')->name('dean.dashboard');
    });

    Route::middleware('role:HoD')->group(function () {
        Route::view('/hod/dashboard', 'hod.dashboard')->name('hod.dashboard');
    });

    Route::middleware('role:Professor')->group(function () {
        Route::view('/professor/dashboard', 'professor.dashboard')->name('professor.dashboard');
    });

    Route::middleware('role:Student')->group(function () {
        Route::view('/student/dashboard', 'student.dashboard')->name('student.dashboard');
    });
});

require __DIR__.'/auth.php';