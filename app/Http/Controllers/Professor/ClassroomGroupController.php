<?php

namespace App\Http\Controllers\Professor;

use App\Http\Controllers\Controller;
use App\Models\ClassGroup;
use Illuminate\Support\Facades\Gate;

class ClassroomGroupController extends Controller
{
    /**
     * Show the classroom stream.
     */
public function stream(ClassGroup $classGroup)
{
    Gate::authorize('view', $classGroup);

$classGroup->load([
    'course',
    'students',
    'announcements.user',

    'materials.user',
    'materials.topic',

    'assignments.user',
    'assignments.topic',

    'quizzes.user',
    'quizzes.topic',

    'exams.user',
    'exams.topic',

    'projects.user',
    'projects.topic',
]);


    /*
    |--------------------------------------------------------------------------
    | Build Stream
    |--------------------------------------------------------------------------
    */

    $streamItems = collect();


    /*
    |--------------------------------------------------------------------------
    | Announcements
    |--------------------------------------------------------------------------
    */

    foreach ($classGroup->announcements as $announcement) {

        $streamItems->push([
            'type' => 'announcement',

            'title' => $announcement->title,

            'posted_by' => $announcement->user?->name ?? 'Professor',

            'created_at' => $announcement->created_at,

            'item' => $announcement,
        ]);
    }


    /*
    |--------------------------------------------------------------------------
    | Materials
    |--------------------------------------------------------------------------
    */

    foreach ($classGroup->materials as $material) {

        $streamItems->push([
            'type' => 'material',

            'title' => $material->title,

            'posted_by' => $material->user?->name ?? 'Professor',

            'created_at' => $material->created_at,

            'item' => $material,
        ]);
    }


    /*
    |--------------------------------------------------------------------------
    | Assignments
    |--------------------------------------------------------------------------
    */

    foreach ($classGroup->assignments as $assignment) {

        $streamItems->push([
            'type' => 'assignment',

            'title' => $assignment->title,

            'posted_by' => $assignment->user?->name ?? 'Professor',

            'created_at' => $assignment->created_at,

            'item' => $assignment,
        ]);
    }


    /*
    |--------------------------------------------------------------------------
    | Quizzes
    |--------------------------------------------------------------------------
    */

    foreach ($classGroup->quizzes as $quiz) {

        $streamItems->push([
            'type' => 'quiz',

            'title' => $quiz->title,

            'posted_by' => $quiz->user?->name ?? 'Professor',

            'created_at' => $quiz->created_at,

            'item' => $quiz,
        ]);
    }


    /*
    |--------------------------------------------------------------------------
    | Exams
    |--------------------------------------------------------------------------
    */

    foreach ($classGroup->exams as $exam) {

        $streamItems->push([
            'type' => 'exam',

            'title' => $exam->title,

            'posted_by' => $exam->user?->name ?? 'Professor',

            'created_at' => $exam->created_at,

            'item' => $exam,
        ]);
    }


    /*
|--------------------------------------------------------------------------
| Projects
|--------------------------------------------------------------------------
*/

foreach ($classGroup->projects as $project) {

    $streamItems->push([
        'type' => 'project',
        'title' => $project->title,
        'posted_by' => $project->user?->name ?? 'Professor',
        'created_at' => $project->created_at,
        'item' => $project,
    ]);
}


    /*
    |--------------------------------------------------------------------------
    | Newest First
    |--------------------------------------------------------------------------
    */

    $streamItems = $streamItems
        ->sortByDesc('created_at')
        ->values();


    return view(
        'professor.class_groups.classroom_group.streams.index',
        compact(
            'classGroup',
            'streamItems'
        )
    );
}
}