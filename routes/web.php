<?php

use Illuminate\Support\Facades\Route;

// ============================================================
// GENERAL CONTROLLERS
// ============================================================

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoleSelectController;

// ============================================================
// ADMIN CONTROLLERS
// ============================================================

use App\Http\Controllers\Admin\DepartmentController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\DashboardController;

// ============================================================
// PROFESSOR CONTROLLERS
// ============================================================

use App\Http\Controllers\Professor\ClassGroupController;
use App\Http\Controllers\Professor\ClassroomGroupController;
use App\Http\Controllers\Professor\ProfessorDashboardController;
use App\Http\Controllers\Professor\ClassGroupAnnouncementController;

use App\Http\Controllers\Professor\MaterialController;
use App\Http\Controllers\Professor\AssignmentController;
use App\Http\Controllers\Professor\ClassworkController;
use App\Http\Controllers\Professor\TopicController;
use App\Http\Controllers\Professor\QuizController;
use App\Http\Controllers\Professor\ExamController;
use App\Http\Controllers\Professor\ClassroomStudentsController;


// ============================================================
// STUDENT CONTROLLERS
// ============================================================

use App\Http\Controllers\Student\StudentDashboardController;
use App\Http\Controllers\Student\StudentClassGroupController;


// ============================================================
// PUBLIC ROUTES
// ============================================================

Route::get('/', function () {

    return view('welcome');

})->name('welcome');


Route::get('/role_selection', function () {

    return view('role_selection');

})->name('role_selection');


// ============================================================
// AUTHENTICATED ROUTES
// ============================================================

Route::middleware(['auth'])->group(function () {


    // ========================================================
    // ROLE SELECTION
    // ========================================================

    Route::get(
        '/role/select',
        [RoleSelectController::class, 'show']
    )->name('role.select');


    Route::post(
        '/role/select',
        [RoleSelectController::class, 'store']
    )->name('role.select.store');


    // ========================================================
    // PROFILE
    // ========================================================

    Route::controller(ProfileController::class)->group(function () {

        Route::get(
            '/profile',
            'edit'
        )->name('profile.edit');


        Route::patch(
            '/profile',
            'update'
        )->name('profile.update');


        Route::delete(
            '/profile',
            'destroy'
        )->name('profile.destroy');

    });


    // ========================================================
    // ADMIN ROUTES
    // ========================================================

    Route::prefix('admin')
        ->name('admin.')
        ->middleware(['role:Admin'])
        ->group(function () {


            // ==================================================
            // DASHBOARD
            // ==================================================

            Route::get(
                '/dashboard',
                [DashboardController::class, 'index']
            )->name('dashboard');


            // ==================================================
            // USERS
            // ==================================================

            Route::resource(
                'users',
                UserController::class
            );


            // ==================================================
            // DEPARTMENTS
            // ==================================================

            Route::resource(
                'departments',
                DepartmentController::class
            );

        });



    // ========================================================
    // HOD ROUTES
    // ========================================================

    Route::prefix('hod')
        ->name('hod.')
        ->middleware(['role:HoD'])
        ->group(function () {

            Route::view(
                '/dashboard',
                'hod.dashboard'
            )->name('dashboard');

        });


// ============================================================
// PROFESSOR ROUTES
// ============================================================

Route::prefix('professor')
    ->name('professor.')
    ->middleware(['role:Professor'])
    ->group(function () {


        // ========================================================
        // DASHBOARD
        // ========================================================

        Route::get(
            '/dashboard',
            [ProfessorDashboardController::class, 'index']
        )->name('dashboard');


        // ============================================================
        // CREATE CLASS
        // ============================================================

        Route::get(
            '/class-groups/create',
            [ClassGroupController::class, 'create']
        )->name('class-groups.create');

        Route::post(
            '/class-groups',
            [ClassGroupController::class, 'store']
        )->name('class-groups.store');

        // ========================================================
        // CLASS GROUPS
        // ========================================================

        // Show all class groups
        Route::get(
            '/class-groups',
            [ClassGroupController::class, 'index']
        )->name('class-groups.index');


        // Edit class group
        Route::get(
            '/class-groups/{classGroup}/edit',
            [ClassGroupController::class, 'edit']
        )->name('class-groups.edit');


        // Update class group
        Route::put(
            '/class-groups/{classGroup}',
            [ClassGroupController::class, 'update']
        )->name('class-groups.update');


        // ========================================================
        // CLASSROOM
        // ========================================================

        // Open one specific classroom — Stream
        Route::get(
            '/class-groups/{classGroup}/classroom-group',
            [ClassroomGroupController::class, 'stream']
        )->name('class-groups.classroom-group');


        // ========================================================
        // CLASSROOM — ANNOUNCEMENTS
        // ========================================================

        // Create announcement
        Route::post(
            '/class-groups/{classGroup}/announcements',
            [ClassGroupAnnouncementController::class, 'store']
        )->name('class-groups.announcements.store');


        // Edit announcement
        Route::get(
            '/class-groups/{classGroup}/announcements/{announcement}/edit',
            [ClassGroupAnnouncementController::class, 'edit']
        )->name('class-groups.announcements.edit');


        // Update announcement
        Route::put(
            '/class-groups/{classGroup}/announcements/{announcement}',
            [ClassGroupAnnouncementController::class, 'update']
        )->name('class-groups.announcements.update');


        // Delete announcement
        Route::delete(
            '/class-groups/{classGroup}/announcements/{announcement}',
            [ClassGroupAnnouncementController::class, 'destroy']
        )->name('class-groups.announcements.destroy');


        // ========================================================
        // CLASSWORK
        // ========================================================

        // Show classwork page
        Route::get(
            '/class-groups/{classGroup}/classwork',
            [ClassworkController::class, 'index']
        )->name('class-groups.classroom-group.classwork');


        // ========================================================
        // CLASSWORK — TOPICS
        // ========================================================

        // Create topic page
        Route::get(
            '/class-groups/{classGroup}/classroom-group/classwork/topics/create',
            [TopicController::class, 'create']
        )->name('class-groups.classroom-group.classwork.topics.create');


        // Store topic
        Route::post(
            '/class-groups/{classGroup}/classroom-group/classwork/topics',
            [TopicController::class, 'store']
        )->name('class-groups.classroom-group.classwork.topics.store');


        // Edit topic page
        Route::get(
            '/class-groups/{classGroup}/classroom-group/classwork/topics/{topic}/edit',
            [TopicController::class, 'edit']
        )->name('class-groups.classroom-group.classwork.topics.edit');


        // Update topic
        Route::put(
            '/class-groups/{classGroup}/classroom-group/classwork/topics/{topic}',
            [TopicController::class, 'update']
        )->name('class-groups.classroom-group.classwork.topics.update');


        // ========================================================
        // CLASSWORK — MATERIALS
        // ========================================================

        // Create material page
        Route::get(
            '/class-groups/{classGroup}/materials/create',
            [MaterialController::class, 'create']
        )->name('class-groups.materials.create');


        // Store material
        Route::post(
            '/class-groups/{classGroup}/materials',
            [MaterialController::class, 'store']
        )->name('class-groups.materials.store');


        // Edit material page
        Route::get(
            '/class-groups/{classGroup}/materials/{material}/edit',
            [MaterialController::class, 'edit']
        )->name('class-groups.materials.edit');


        // Update material
        Route::put(
            '/class-groups/{classGroup}/materials/{material}',
            [MaterialController::class, 'update']
        )->name('class-groups.materials.update');

        // show material detail

        Route::get(
    '/class-groups/{classGroup}/materials/{material}',
    [MaterialController::class, 'show']
)->name('class-groups.materials.show');


        // Delete material
        Route::delete(
            '/materials/{material}',
            [MaterialController::class, 'destroy']
        )->name('class-groups.materials.destroy');


        // Download material
        Route::get(
            '/class-groups/{classGroup}/materials/{material}/download',
            [MaterialController::class, 'download']
        )->name('class-groups.materials.download');


        // ========================================================
        // CLASSWORK — ASSIGNMENTS
        // ========================================================

        // Create assignment page
        Route::get(
            '/class-groups/{classGroup}/assignments/create',
            [AssignmentController::class, 'create']
        )->name('class-groups.assignments.create');


        // Store assignment
        Route::post(
            '/class-groups/{classGroup}/assignments',
            [AssignmentController::class, 'store']
        )->name('class-groups.assignments.store');


        // Edit assignment page
        Route::get(
            '/class-groups/{classGroup}/assignments/{assignment}/edit',
            [AssignmentController::class, 'edit']
        )->name('class-groups.assignments.edit');


        // Update assignment
        Route::put(
            '/class-groups/{classGroup}/assignments/{assignment}',
            [AssignmentController::class, 'update']
        )->name('class-groups.assignments.update');

        // show assignment detail 

                Route::get(
            '/class-groups/{classGroup}/assignments/{assignment}',
            [AssignmentController::class, 'show']
        )->name('class-groups.assignments.show');


        // Delete assignment
        Route::delete(
            '/class-groups/{classGroup}/assignments/{assignment}',
            [AssignmentController::class, 'destroy']
        )->name('class-groups.assignments.destroy');


 // ============================================================
// QUIZZES
// ============================================================

Route::post(
    '/class-groups/{classGroup}/quizzes',
    [QuizController::class, 'store']
)->name('class-groups.quizzes.store');

Route::get(
    '/class-groups/{classGroup}/quizzes/create',
    [QuizController::class, 'create']
)->name('class-groups.quizzes.create');

Route::get(
    '/class-groups/{classGroup}/quizzes/{quiz}',
    [QuizController::class, 'show']
)->name('class-groups.quizzes.show');

Route::get(
    '/class-groups/{classGroup}/quizzes/{quiz}/edit',
    [QuizController::class, 'edit']
)->name('class-groups.quizzes.edit');

Route::put(
    '/class-groups/{classGroup}/quizzes/{quiz}',
    [QuizController::class, 'update']
)->name('class-groups.quizzes.update');


        // ========================================================
        // CLASSWORK — EXAMS
        // ========================================================

        // Create exam page
        Route::get(
            '/class-groups/{classGroup}/exams/create',
            [ExamController::class, 'create']
        )->name('class-groups.exams.create');


        // Store exam
        Route::post(
            '/class-groups/{classGroup}/exams',
            [ExamController::class, 'store']
        )->name('class-groups.exams.store');


        // Edit exam page
        Route::get(
            '/class-groups/{classGroup}/exams/{exam}/edit',
            [ExamController::class, 'edit']
        )->name('class-groups.exams.edit');


        // Update exam
        Route::put(
            '/class-groups/{classGroup}/exams/{exam}',
            [ExamController::class, 'update']
        )->name('class-groups.exams.update');


        // show exam detail 
        Route::get(
    '/class-groups/{classGroup}/exams/{exam}',
    [ExamController::class, 'show']
)->name('class-groups.exams.show');


        // Delete exam
        Route::delete(
            '/class-groups/{classGroup}/exams/{exam}',
            [ExamController::class, 'destroy']
        )->name('class-groups.exams.destroy');

        //  for display students in professor classroom 
        Route::get(
    '/class-groups/{classGroup}/classroom-group/students',
    [ClassroomStudentsController::class, 'index']
)->name('class-groups.classroom-group.students');

    });








    // ========================================================
    // STUDENT ROUTES
    // ========================================================

    Route::prefix('student')
        ->name('student.')
        ->middleware(['role:Student'])
        ->group(function () {


            // ==================================================
            // STUDENT DASHBOARD
            // ==================================================

            Route::get(
                '/dashboard',
                [StudentDashboardController::class, 'index']
            )->name('dashboard');

        // ========================================================
        // CLASS GROUPS
        // ========================================================

        // Show all class groups
        Route::get(
            '/class-groups',
            [StudentClassGroupController::class, 'index']
        )->name('class-groups.lists.index');



            // ==================================================
            // STUDENT JOIN A CLASS
            // ==================================================

            Route::get(
                '/class-groups/join',
                [StudentClassGroupController::class, 'create']
            )->name('class-groups.join');

            Route::post(
                '/class-groups/join',
                [StudentClassGroupController::class, 'store']
            )->name('class-groups.join.store');


            // ==================================================
            // STUDENT CLASSROOM
            // ==================================================

            Route::get(
                '/class-groups/{classGroup}/classroom',
                [StudentClassGroupController::class, 'show']
            )->name('class-groups.classroom');


            // ==================================================
            // STUDENT MATERIAL DOWNLOAD
            // ==================================================

            Route::get(
                '/materials/{material}/download',
                [MaterialController::class, 'studentDownload']
            )->name('materials.download');

        });

});


// ============================================================
// AUTHENTICATION ROUTES
// ============================================================

require __DIR__ . '/auth.php';