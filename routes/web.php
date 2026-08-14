<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoleSelectController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DepartmentController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\AdminAssignDeanDeptController;
use App\Http\Controllers\Admin\DashboardController;

//public routes accessible by everyone
Route::get('/', function () {
    return view('welcome');
})->name('welcome');

// Authentication routes (login, register, etc.) are provided by Breeze
Route::middleware(['auth'])->group(function () { // group func means that everything inside this block shared the same rules

// Role selection route(after login) if user have more than roles
    Route::get('/role/select', [RoleSelectController::class, 'show'])
        ->name('role.select'); // show role seletion forom

    Route::post('/role/select', [RoleSelectController::class, 'store'])
        ->name('role.select.store'); // submit the selected role

    // Profile (any logged-in user)
    Route::controller(ProfileController::class)->group(function () {
        Route::get('/profile', 'edit')->name('profile.edit');
        Route::patch('/profile', 'update')->name('profile.update');
        Route::delete('/profile', 'destroy')->name('profile.destroy');
    });

// Admin routes
Route::prefix('admin') // all URLs thst starts with /admin 
    ->name('admin.') // all routes names start with "admin"
    ->middleware(['role:Admin']) // only admin role can enter this 
    ->group(function () {
// these lines above actually mean that everything below here id for /admin/urls, named (admin.sth), and only Admin can access.

     Route::get('/dashboard', [DashboardController::class, 'index'])
            ->name('dashboard');
        Route::resource('users', UserController::class); // all crud route
        Route::resource('departments', DepartmentController::class); // all crud route


            
// these routes below are custom routes 
// why not use resource? it not a full CRUD ,cuz we have specail and specific action to do (like assign dean to departments) we only want to list dean info from department_users table in DB so that admin 
// can see which dean had assigned which departments , after admin decide to assign some depts to dean then we use edit route to modify dean dept in our DB. JUst like Dean dept will update 
// accordingly

        Route::get('/assign-dean', [AdminAssignDeanDeptController::class, 'index'])
            ->name('assign_dean.index'); // show all Dean info
 
        Route::get('/assign-dean/{id}/edit', [AdminAssignDeanDeptController::class, 'edit'])
            ->name('assign_dean.edit'); // edit by id 

        Route::put('/assign-dean/{id}', [AdminAssignDeanDeptController::class, 'update'])
            ->name('assign_dean.update'); // update by id 
    });

    // Dean rputes
    
    Route::prefix('dean')  // same like admin as well 
        ->name('dean.')
        ->middleware(['role:Dean'])
        ->group(function () {
            Route::view('/dashboard', 'dean.dashboard')
                ->name('dashboard'); // just return a view not a a
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

require __DIR__ . '/auth.php';
