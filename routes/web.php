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
// Hod CONTROLLERS
// ============================================================

use App\Http\Controllers\HoD\CourseController;
use App\Http\Controllers\HoD\SchedulePublicationController;

// ============================================================
// PROFESSOR CONTROLLERS
// ============================================================

use App\Http\Controllers\Professor\ProfessorScheduleController;
use App\Models\User;
use App\Models\Course;
use App\Models\Schedule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\ClassGroup;
use Carbon\Carbon;
use App\Http\Controllers\Professor\ClassGroupController;
use App\Http\Controllers\Professor\ClassroomGroupController;
use App\Http\Controllers\Professor\ProfessorDashboardController;
use App\Http\Controllers\Professor\ClassGroupAnnouncementController;


use App\Http\Controllers\Professor\MaterialController;
use App\Http\Controllers\Professor\AssignmentController;
use App\Http\Controllers\Professor\ClassworkController;
use App\Http\Controllers\Professor\TopicController;
use App\Http\Controllers\Professor\QuizController;
use App\Http\Controllers\Professor\QuizSubmissionController;
use App\Http\Controllers\Professor\ExamController;
use App\Http\Controllers\Professor\ExamSubmissionController;
use App\Http\Controllers\Professor\ClassroomStudentController;
use App\Http\Controllers\Professor\AssignmentSubmissionController;

use App\Http\Controllers\Professor\ProjectController;

use App\Http\Controllers\Professor\ProfessorMarksController;
use App\Http\Controllers\Professor\ProjectSubmissionController;



// ============================================================
// STUDENT CONTROLLERS
// ============================================================

use App\Http\Controllers\Student\StudentDashboardController;
use App\Http\Controllers\Student\StudentClassGroupController;
use App\Http\Controllers\Student\StudentMaterialController;
use App\Http\Controllers\Student\StudentAssignmentController;
use App\Http\Controllers\Student\StudentClassworkController;
use App\Http\Controllers\Student\StudentQuizController;
use App\Http\Controllers\Student\StudentExamController;
use App\Http\Controllers\Student\StudentMarksController;
use App\Http\Controllers\Student\StudentProjectController;
use App\Http\Controllers\Student\StudentScheduleController;

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

Route::get('/dashboard', function () {
    $currentUser = User::findOrFail(Auth::id());

    $departmentId = $currentUser
        ->departments()
        ->value('departments.id');

    /*
    |--------------------------------------------------------------------------
    | Total Statistics
    |--------------------------------------------------------------------------
    */

    $totalProfessors = User::whereHas('roles', function ($query) {
        $query->where('role_name', 'Professor');
    })
        ->whereHas('departments', function ($query) use ($departmentId) {
            $query->where('departments.id', $departmentId);
        })
        ->count();

    $totalCourses = Course::where('department_id', $departmentId)
        ->count();

    $totalSchedules = Schedule::whereNotNull('schedule_group_id')
        ->distinct()
        ->count('schedule_group_id');

    /*
    |--------------------------------------------------------------------------
    | Today's Summary
    |--------------------------------------------------------------------------
    */

    // New courses created today
    $newCoursesToday = Course::where('department_id', $departmentId)
        ->whereDate('created_at', today())
        ->count();

    // New schedules created today
$newSchedulesToday = Schedule::whereNotNull('schedule_group_id')
    ->whereDate('created_at', today())
    ->distinct()
    ->count('schedule_group_id');



    return view('hod.dashboard', compact(
        'currentUser',
        'totalProfessors',
        'totalCourses',
        'totalSchedules',
        'newCoursesToday',
        'newSchedulesToday',
    ));
})->name('dashboard');

        Route::get('/professors', [
            \App\Http\Controllers\Hod\ProfessorController::class,
            'index'
        ])->name('professors.index');

        // Courses
        Route::resource('courses', CourseController::class)
            ->except(['show']);

        // ========================================================
        // Schedule Management
        // ========================================================

        // Check schedule conflicts
        Route::get(
            '/schedules/check-conflict',
            [\App\Http\Controllers\HoD\ScheduleController::class, 'checkConflict']
        )->name('schedules.checkConflict');

        // DELETE ENTIRE DAY
        Route::delete(
            '/schedules/{schedule}/delete-day',
            [\App\Http\Controllers\HoD\ScheduleController::class, 'destroyDay']
        )->name('schedules.destroyDay');

        // Schedule CRUD
        Route::resource(
            'schedules',
            \App\Http\Controllers\HoD\ScheduleController::class
        )->except(['show']);

        // DOCX preview
        Route::get(
            '/schedules/{schedule}/export-docx/preview',
            [\App\Http\Controllers\HoD\ScheduleController::class, 'previewDocx']
        )->name('schedules.previewDocx');

        // DOCX export
        Route::get(
            '/schedules/{schedule}/export-docx',
            [\App\Http\Controllers\HoD\ScheduleController::class, 'exportDocx']
        )->name('schedules.exportDocx');

        Route::patch(
            '/schedules/{schedule}/publish',
            [SchedulePublicationController::class, 'publish']
        )->name('schedules.publish');

        Route::patch(
            '/schedules/{schedule}/unpublish',
            [SchedulePublicationController::class, 'unpublish']
        )->name('schedules.unpublish');

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

// ============================================================
// DASHBOARD
// ============================================================

Route::get('/dashboard', function () {

    $today = now()->startOfDay();

    // Count classes created today
    $newClasses = \App\Models\ClassGroup::where(
        'created_at',
        '>=',
        $today
    )->count();

    // Count students registered today
    $newStudents = \App\Models\User::where(
        'created_at',
        '>=',
        $today
    )->count();

    // Get all class groups for dashboard cards
    $classGroups = \App\Models\ClassGroup::with([
        'course',
        'professor',
    ])->latest()->get();

    return view('professor.dashboard', compact(
        'newClasses',
        'newStudents',
        'classGroups'
    ));

})->name('dashboard');

            // ========================================================
            // SCHEDULE
            // ========================================================

            Route::get(
                '/schedule',
                [ProfessorScheduleController::class, 'index']
            )->name('schedule.index');

            Route::get(
                '/schedule/{schedule}',
                [ProfessorScheduleController::class, 'show']
            )->name('schedule.show');

            Route::get(
                '/schedules/{schedule}/download-docx',
                [ProfessorScheduleController::class, 'downloadDocx']
            )->name('schedule.downloadDocx');

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

            // Delete topic
            Route::delete(
                '/class-groups/{classGroup}/topics/{topic}',
                [TopicController::class, 'destroy']
            )->name('class-groups.classroom-group.classwork.topics.destroy');

            // ========================================================
            // CLASSWORK — MATERIALS
            // ========================================================

            // Create material
            Route::get(
                '/class-groups/{classGroup}/materials/create',
                [MaterialController::class, 'create']
            )->name('class-groups.materials.create');

            // Store material
            Route::post(
                '/class-groups/{classGroup}/materials',
                [MaterialController::class, 'store']
            )->name('class-groups.materials.store');

            // Show material
            Route::get(
                '/class-groups/{classGroup}/materials/{material}',
                [MaterialController::class, 'show']
            )->name('class-groups.materials.show');

            // Edit material
            Route::get(
                '/class-groups/{classGroup}/materials/{material}/edit',
                [MaterialController::class, 'edit']
            )->name('class-groups.materials.edit');

            // Update material
            Route::put(
                '/class-groups/{classGroup}/materials/{material}',
                [MaterialController::class, 'update']
            )->name('class-groups.materials.update');

            // Download individual resource
            Route::get(
                '/class-groups/{classGroup}/materials/{material}/resources/{resource}/download',
                [MaterialController::class, 'downloadResource']
            )->name('class-groups.materials.download');

            // Delete individual resource
            Route::delete(
                '/class-groups/{classGroup}/materials/{material}/resources/{resource}',
                [MaterialController::class, 'destroyResource']
            )->name('class-groups.materials.resources.destroy');

            // Delete entire material
            Route::delete(
                '/class-groups/{classGroup}/materials/{material}',
                [MaterialController::class, 'destroy']
            )->name('class-groups.materials.destroy');

            // ============================================================
            // CLASSWORK — ASSIGNMENTS
            // ============================================================

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

            // Update assignment maximum points from Marks
            Route::put(
                '/class-groups/{classGroup}/assignments/{assignment}/points',
                [AssignmentController::class, 'updatePoints']
            )->name('class-groups.assignments.points.update');

            // Delete one assignment resource
            Route::delete(
                '/class-groups/{classGroup}/assignments/{assignment}/resources/{resource}',
                [AssignmentController::class, 'destroyResource']
            )->name('class-groups.assignments.resources.destroy');

            // Show assignment detail
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
            // ASSIGNMENT — STUDENT SUBMISSIONS
            // ============================================================

            // View one student's submission
            Route::get(
                '/class-groups/{classGroup}/assignments/{assignment}/submissions/{submission}',
                [AssignmentSubmissionController::class, 'show']
            )->name('class-groups.assignments.submissions.show');

            // View submitted file
            Route::get(
                '/class-groups/{classGroup}/assignments/{assignment}/submissions/{submission}/resources/{resource}/view',
                [AssignmentSubmissionController::class, 'viewResource']
            )->name('class-groups.assignments.submissions.resources.view');

            // Download submitted file
            Route::get(
                '/class-groups/{classGroup}/assignments/{assignment}/submissions/{submission}/resources/{resource}/download',
                [AssignmentSubmissionController::class, 'downloadResource']
            )->name('class-groups.assignments.submissions.resources.download');

            // Grade student's assignment submission
            Route::post(
                '/class-groups/{classGroup}/assignments/{assignment}/submissions/{submission}/grade',
                [AssignmentSubmissionController::class, 'grade']
            )->name('class-groups.assignments.submissions.grade');



            // ============================================================
            // BULK GRADING
            // ============================================================

            Route::post(
                '/class-groups/{classGroup}/assignments/{assignment}/grade-all',
                [AssignmentSubmissionController::class, 'gradeAll']
            )->name('class-groups.assignments.grade-all');

            Route::post(
                '/class-groups/{classGroup}/assignments/{assignment}/grade-complete',
                [AssignmentSubmissionController::class, 'gradeAsComplete']
            )->name('class-groups.assignments.grade-complete');

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

            // Update quiz maximum points from Marks
            Route::put(
                '/class-groups/{classGroup}/quizzes/{quiz}/points',
                [QuizController::class, 'updatePoints']
            )->name('class-groups.quizzes.points.update');

            // Delete quiz
            Route::delete(
                '/class-groups/{classGroup}/quizzes/{quiz}',
                [QuizController::class, 'destroy']
            )->name('class-groups.quizzes.destroy');

            // remove file from quiz
            Route::delete(
                '/class-groups/{classGroup}/quizzes/{quiz}/resources/{resource}',
                [QuizController::class, 'destroyResource']
            )->name('class-groups.quizzes.resources.destroy');

            // ============================================================
            // QUIZ SUBMISSIONS
            // ============================================================
            Route::get(
                '/class-groups/{classGroup}/quizzes/{quiz}/submissions/{submission}',
                [QuizSubmissionController::class, 'show']
            )->name(
                'class-groups.quizzes.submissions.show'
            );

            Route::get(
                '/class-groups/{classGroup}/quizzes/{quiz}/submissions/{submission}/resources/{resource}/view',
                [QuizSubmissionController::class, 'viewResource']
            )->name(
                'class-groups.quizzes.submissions.resources.view'
            );

            Route::get(
                '/class-groups/{classGroup}/quizzes/{quiz}/submissions/{submission}/resources/{resource}/download',
                [QuizSubmissionController::class, 'downloadResource']
            )->name(
                'class-groups.quizzes.submissions.resources.download'
            );

            // Grade quiz submission*

            Route::post(
                '/class-groups/{classGroup}/quizzes/{quiz}/submissions/{submission}/grade',
                [QuizSubmissionController::class, 'grade']
            )->name(
                'class-groups.quizzes.submissions.grade'
            );

            // ============================================================
            // BULK GRADING
            // ============================================================

            Route::post(
                '/class-groups/{classGroup}/quizzes/{quiz}/grade-all',
                [QuizSubmissionController::class, 'gradeAll']
            )->name('class-groups.quizzes.grade-all');

            Route::post(
                '/class-groups/{classGroup}/quizzes/{quiz}/grade-complete',
                [QuizSubmissionController::class, 'gradeAsComplete']
            )->name('class-groups.quizzes.grade-complete');

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

            // Update exam maximum points from Marks
            Route::put(
                '/class-groups/{classGroup}/exams/{exam}/points',
                [ExamController::class, 'updatePoints']
            )->name('class-groups.exams.points.update');


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
                [ClassroomStudentController::class, 'index']
            )->name('class-groups.classroom-group.students');

            // ========================================================
            // EXAM — STUDENT SUBMISSIONS
            // ========================================================

            Route::get(
                '/class-groups/{classGroup}/exams/{exam}/submissions/{submission}',
                [ExamSubmissionController::class, 'show']
            )->name('class-groups.exams.submissions.show');


            Route::get(
                '/class-groups/{classGroup}/exams/{exam}/submissions/{submission}/resources/{resource}/view',
                [ExamSubmissionController::class, 'viewResource']
            )->name('class-groups.exams.submissions.resources.view');


            Route::get(
                '/class-groups/{classGroup}/exams/{exam}/submissions/{submission}/resources/{resource}/download',
                [ExamSubmissionController::class, 'downloadResource']
            )->name('class-groups.exams.submissions.resources.download');

            Route::post(
                '/class-groups/{classGroup}/exams/{exam}/submissions/{submission}/grade',
                [ExamSubmissionController::class, 'grade']
            )->name('class-groups.exams.submissions.grade');


            // ============================================================
            // BULK GRADING
            // ============================================================

            Route::post(
                '/class-groups/{classGroup}/exams/{exam}/grade-all',
                [ExamSubmissionController::class, 'gradeAll']
            )->name('class-groups.exams.grade-all');

            Route::post(
                '/class-groups/{classGroup}/exams/{exam}/grade-complete',
                [ExamSubmissionController::class, 'gradeAsComplete']
            )->name('class-groups.exams.grade-complete');


            // ============================================================*
            // PROJECT ROUTES*
            // ============================================================*


            // CREATE PROJECT*

            Route::get(
                '/{classGroupId}/classworks/projects/create',
                [ProjectController::class, 'create']
            )->name('classworks.projects.create');


            // GENERATE PROJECT GROUPS PREVIEW*

            Route::post(
                '/{classGroupId}/classworks/projects/generate-groups',
                [ProjectController::class, 'generateGroups']
            )->name('classworks.projects.generate-groups');


            // *STORE PROJECT*

            Route::post(
                '/{classGroupId}/classworks/projects',
                [ProjectController::class, 'store']
            )->name('classworks.projects.store');

            // SHOW PROJECT*

            Route::get(
                '/{classGroupId}/classworks/projects/{projectId}',
                [ProjectController::class, 'show']
            )->name('classworks.projects.show');


            // MANAGE PROJECT TEAMS*
            // IMPORTANT: THIS MUST COME BEFORE {groupId}

            Route::get(
                '/{classGroupId}/classworks/projects/{projectId}/groups/manage',
                [ProjectController::class, 'manageGroups']
            )->name('classworks.projects.groups.manage');


            // SHOW ONE TEAM

            Route::get(
                '/{classGroupId}/classworks/projects/{projectId}/groups/{groupId}',
                [ProjectController::class, 'showGroup']
            )->name('classworks.projects.groups.show');


            // EDIT PROJECT

            Route::get(
                '/{classGroupId}/classworks/projects/{projectId}/edit',
                [ProjectController::class, 'edit']
            )->name('classworks.projects.edit');


            // UPDATE PROJECT

            Route::put(
                '/{classGroupId}/classworks/projects/{projectId}',
                [ProjectController::class, 'update']
            )->name('classworks.projects.update');


            // DELETE PROJECT RESOURCE*

            Route::delete(
                '/{classGroup}/classworks/projects/{project}/resources/{resource}',
                [ProjectController::class, 'destroyResource']
            )->name('classworks.projects.resources.destroy');


            // DELETE PROJECT*

            Route::delete(
                '/{classGroupId}/classworks/projects/{projectId}',
                [ProjectController::class, 'destroy']
            )->name('classworks.projects.destroy');


            // ============================================================
            // MANAGE PROJECT TEAMS
            // ============================================================

            Route::get(
                '/{classGroupId}/classworks/projects/{projectId}/groups/manage',
                [ProjectController::class, 'manageGroups']
            )->name('classworks.projects.groups.manage');


            // ============================================================
            // CREATE TEAM
            // ============================================================

            Route::post(
                '/{classGroupId}/classworks/projects/{projectId}/groups',
                [ProjectController::class, 'createGroup']
            )->name('classworks.projects.groups.create');


            // ============================================================
            // RENAME TEAM
            // ============================================================

            Route::put(
                '/{classGroupId}/classworks/projects/{projectId}/groups/{groupId}',
                [ProjectController::class, 'renameGroup']
            )->name('classworks.projects.groups.rename');


            // ============================================================
            // DELETE TEAM
            // ============================================================

            Route::delete(
                '/{classGroupId}/classworks/projects/{projectId}/groups/{groupId}',
                [ProjectController::class, 'deleteGroup']
            )->name('classworks.projects.groups.delete');


            // ============================================================
            // ADD STUDENT
            // ============================================================

            Route::post(
                '/{classGroupId}/classworks/projects/{projectId}/groups/{groupId}/members',
                [ProjectController::class, 'addStudentToGroup']
            )->name('classworks.projects.groups.members.add');


            // ============================================================
            // REMOVE STUDENT
            // ============================================================

            Route::delete(
                '/{classGroupId}/classworks/projects/{projectId}/groups/{groupId}/members/{memberId}',
                [ProjectController::class, 'removeStudentFromGroup']
            )->name('classworks.projects.groups.members.remove');


            // ============================================================
            // CHANGE MEMBER ROLE
            // ============================================================

            Route::put(
                '/{classGroupId}/classworks/projects/{projectId}/groups/{groupId}/members/{memberId}/role',
                [ProjectController::class, 'updateMemberRole']
            )->name('classworks.projects.groups.members.role');


            // ============================================================
            // MOVE STUDENT
            // ============================================================

            Route::put(
                '/{classGroupId}/classworks/projects/{projectId}/groups/{groupId}/members/{memberId}/move',
                [ProjectController::class, 'moveStudentToGroup']
            )->name('classworks.projects.groups.members.move');


            // ============================================================
            // SHOW ONE TEAM
            // IMPORTANT: KEEP THIS AFTER /groups/manage
            // ============================================================

            Route::get(
                '/{classGroupId}/classworks/projects/{projectId}/groups/{groupId}',
                [ProjectController::class, 'showGroup']
            )->name('classworks.projects.groups.show');
            // ============================================================
            // PROJECT SUBMISSION ROUTES
            // ============================================================

            // SHOW SUBMISSION
            Route::get(
                '/{classGroupId}/classworks/projects/{projectId}/submissions/{submissionId}',
                [ProjectSubmissionController::class, 'show']
            )->name('classworks.projects.submissions.show');


            // GRADE INDIVIDUAL PROJECT SUBMISSION
            Route::put(
                '/{classGroupId}/classworks/projects/{projectId}/submissions/{submissionId}/grade',
                [ProjectSubmissionController::class, 'grade']
            )->name('classworks.projects.submissions.grade');


            // GRADE ALL TEAMS
            Route::put(
                '/{classGroup}/classworks/projects/{project}/submissions/grade-all-teams',
                [ProjectSubmissionController::class, 'gradeAllTeams']
            )->name('classworks.projects.submissions.grade-all-teams');


            // GRADE AS COMPLETE — ALL TEAMS
            Route::put(
                '/{classGroupId}/classworks/projects/{projectId}/submissions/grade-as-complete',
                [ProjectSubmissionController::class, 'gradeAsComplete']
            )->name('classworks.projects.submissions.grade-as-complete');


            // GRADE ONE TEAM — SAME SCORE FOR ALL MEMBERS
            Route::put(
                '/{classGroupId}/classworks/projects/{projectId}/submissions/{submissionId}/grade-team',
                [ProjectSubmissionController::class, 'gradeTeam']
            )->name('classworks.projects.submissions.grade-team');


            // GRADE ONE TEAM — MEMBER BY MEMBER
            Route::put(
                '/{classGroupId}/classworks/projects/{projectId}/submissions/{submissionId}/grade-members',
                [ProjectSubmissionController::class, 'gradeTeamMembers']
            )->name('classworks.projects.submissions.grade-members');


            // VIEW SUBMITTED FILE
            Route::get(
                '/{classGroupId}/classworks/projects/{projectId}/submissions/{submissionId}/resources/{resourceId}/view',
                [ProjectSubmissionController::class, 'viewResource']
            )->name('classworks.projects.submissions.resources.view');


            // DOWNLOAD SUBMITTED FILE
            Route::get(
                '/{classGroupId}/classworks/projects/{projectId}/submissions/{submissionId}/resources/{resourceId}/download',
                [ProjectSubmissionController::class, 'downloadResource']
            )->name('classworks.projects.submissions.resources.download');

            Route::delete(
    '/professor/class-groups/{classGroup}/classroom-group/students/{student}',
    [ClassroomStudentController::class, 'remove']
)->name('class-groups.students.remove');

            // ============================================================
            // CLASSWORK — MARKS
            // ============================================================


            Route::get(
                '/class-groups/{classGroup}/marks',
                [ProfessorMarksController::class, 'index']
            )->name('class-groups.marks');
        });

    // ============================================================
    // STUDENT ROUTES
    // ============================================================

    Route::prefix('student')
        ->name('student.')
        ->middleware(['role:Student'])
        ->group(function () {

            // ============================================================
            // DASHBOARD
            // ============================================================

            Route::get(
                '/dashboard',
                [StudentDashboardController::class, 'index']
            )
                ->name('dashboard');


            Route::get('/schedules', [StudentScheduleController::class, 'index'])
                ->name('schedules.index');

            Route::get(
                '/schedules/download-docx',
                [StudentScheduleController::class, 'downloadDocx']
            )->name('schedule.downloadDocx');





            // ============================================================
            // CLASS GROUPS
            // ============================================================

            Route::get(
                '/class-groups',
                [StudentClassGroupController::class, 'index']
            )
                ->name('class-groups.index');

            Route::get(
                '/class-groups/join',
                [StudentClassGroupController::class, 'create']
            )
                ->name('class-groups.join');

            Route::post(
                '/class-groups/join',
                [StudentClassGroupController::class, 'store']
            )
                ->name('class-groups.join.store');

            Route::get(
                '/class-groups/{classGroup}/classroom-group',
                [StudentClassGroupController::class, 'show']
            )
                ->name('class-groups.classroom-group');

            // ============================================================ 
            // CLASSROOM STREAM
            //
            Route::get(
                '/class-groups/{classGroup}/classroom-group/stream',
                [StudentClassGroupController::class, 'stream']
            )->name('class-groups.classroom-group.stream');




            // ============================================================
            // CLASSWORK
            // ============================================================

            Route::get(
                '/class-groups/{classGroup}/classwork',
                [StudentClassworkController::class, 'index']
            )->name('class-groups.classroom-group.classwork');



            // ============================================================
            // MATERIALS
            // ============================================================

            Route::get(
                '/class-groups/{classGroup}/materials/{material}',
                [StudentMaterialController::class, 'show']
            )->name('class-groups.materials.show');

            Route::get(
                '/class-groups/{classGroup}/materials/{material}/resources/{resource}/download',
                [StudentMaterialController::class, 'downloadResource']
            )->name('class-groups.materials.download');


            // ============================================================
            // ASSIGNMENTS
            // ============================================================

            Route::get(
                '/class-groups/{classGroup}/assignments/{assignment}',
                [StudentAssignmentController::class, 'show']
            )->name('class-groups.assignments.show');

            Route::get(
                '/class-groups/{classGroup}/assignments/{assignment}/resources/{resource}/download',
                [StudentAssignmentController::class, 'downloadResource']
            )->name('class-groups.assignments.download');

            Route::post(
                '/class-groups/{classGroup}/assignments/{assignment}/submit',
                [StudentAssignmentController::class, 'submit']
            )->name('class-groups.assignments.submit');

            // ============================================================
            // ASSIGNMENT SUBMISSIONS
            // ============================================================

            Route::get(
                '/class-groups/{classGroup}/assignments/{assignment}/submissions/{submission}',
                [AssignmentSubmissionController::class, 'show']
            )->name('class-groups.assignments.submissions.show');

            Route::get(
                '/class-groups/{classGroup}/assignments/{assignment}/submissions/{submission}/resources/{resource}/view',
                [AssignmentSubmissionController::class, 'viewResource']
            )->name('class-groups.assignments.submissions.resources.view');

            Route::get(
                '/class-groups/{classGroup}/assignments/{assignment}/submissions/{submission}/resources/{resource}/download',
                [AssignmentSubmissionController::class, 'downloadResource']
            )->name('class-groups.assignments.submissions.resources.download');

            Route::delete(
                '/class-groups/{classGroup}/assignments/{assignment}/submission',
                [StudentAssignmentController::class, 'cancel']
            )->name('class-groups.assignments.cancel');


            // =============================================================
            // QUIZZES
            // =============================================================

            Route::get(
                '/class-groups/{classGroup}/quizzes',
                [StudentQuizController::class, 'index']
            )->name('class-groups.quizzes.index');

            Route::get(
                '/class-groups/{classGroup}/quizzes/{quiz}',
                [StudentQuizController::class, 'show']
            )->name('class-groups.quizzes.show');

            Route::post(
                '/class-groups/{classGroup}/quizzes/{quiz}/submit',
                [StudentQuizController::class, 'submit']
            )->name('class-groups.quizzes.submit');

            Route::delete(
                '/class-groups/{classGroup}/quizzes/{quiz}/submission',
                [StudentQuizController::class, 'cancel']
            )->name('class-groups.quizzes.cancel');

            // ==================================================
            // STUDENT EXAMS
            // ==================================================

            Route::get(
                '/class-groups/{classGroup}/exams/{exam}',
                [StudentExamController::class, 'show']
            )->name('class-groups.exams.show');


            Route::post(
                '/class-groups/{classGroup}/exams/{exam}/submit',
                [StudentExamController::class, 'submit']
            )->name('class-groups.exams.submit');


            Route::delete(
                '/class-groups/{classGroup}/exams/{exam}/submission',
                [StudentExamController::class, 'cancel']
            )->name('class-groups.exams.cancel');

            // ============================================================*
            // PROJECTS
            // ============================================================*

            Route::get(
                '/class-groups/{classGroup}/projects/{project}',
                [StudentProjectController::class, 'show']
            )->name('class-groups.projects.show');

            Route::get(
                '/class-groups/{classGroup}/projects/{project}/resources/{resource}/download',
                [StudentProjectController::class, 'downloadResource']
            )->name('class-groups.projects.download');

            Route::post(
                '/class-groups/{classGroup}/projects/{project}/submit',
                [StudentProjectController::class, 'submit']
            )->name('class-groups.projects.submit');

            Route::delete(
                '/class-groups/{classGroup}/projects/{project}/submission',
                [StudentProjectController::class, 'cancel']
            )->name('class-groups.projects.cancel');

            // ============================================================
            // MARKS
            // ============================================================

            Route::get(
                '/class-groups/{classGroup}/marks',
                [StudentMarksController::class, 'index']
            )->name('class-groups.marks');
        });

    // route to check php upload info for debugging purposes
    // just type this in browser: http://localhost:8000/php-upload-info
    Route::get('/php-upload-info', function () {
        return [
            'upload_max_filesize' => ini_get('upload_max_filesize'),
            'post_max_size' => ini_get('post_max_size'),
        ];
    });
});

// ============================================================
// AUTHENTICATION ROUTES
// ============================================================

require __DIR__ . '/auth.php';
