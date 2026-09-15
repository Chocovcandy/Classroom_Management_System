<?php

namespace App\Http\Controllers\Professor;

use App\Http\Controllers\Controller;
use App\Models\Assignment;
use App\Models\ClassGroup;
use App\Models\Exam;
use App\Models\Project;
use App\Models\Quiz;
use Illuminate\Support\Facades\Gate;

class ProfessorMarksController extends Controller
{
    public function index(int $classGroupId)
    {
        /*
        |--------------------------------------------------------------------------
        | CLASSROOM
        |--------------------------------------------------------------------------
        | Load the students because the Marks page is organized
        | student-by-student.
        |--------------------------------------------------------------------------
        */
        $classGroup = ClassGroup::with('students')
            ->findOrFail($classGroupId);

        /*
        |--------------------------------------------------------------------------
        | PROFESSOR AUTHORIZATION
        |--------------------------------------------------------------------------
        */
        Gate::authorize('manage', $classGroup);

        /*
        |--------------------------------------------------------------------------
        | ASSIGNMENTS
        |--------------------------------------------------------------------------
        | IMPORTANT:
        | Do NOT filter submissions by score here.
        |
        | We need:
        | - submitted + graded
        | - submitted + not graded
        |
        | If a student has no submission record, the Blade will display:
        | "Not Submitted".
        |--------------------------------------------------------------------------
        */
        $assignments = Assignment::where(
            'class_group_id',
            $classGroup->id
        )
            ->with([
                'topic',
                'submissions' => function ($query) {
                    $query->with('student');
                },
            ])
            ->orderBy('created_at')
            ->get();

        /*
        |--------------------------------------------------------------------------
        | QUIZZES
        |--------------------------------------------------------------------------
        */
        $quizzes = Quiz::where(
            'class_group_id',
            $classGroup->id
        )
            ->with([
                'topic',
                'submissions' => function ($query) {
                    $query->with('student');
                },
            ])
            ->orderBy('created_at')
            ->get();

        /*
        |--------------------------------------------------------------------------
        | EXAMS
        |--------------------------------------------------------------------------
        */
        $exams = Exam::where(
            'class_group_id',
            $classGroup->id
        )
            ->with([
                'topic',
                'submissions' => function ($query) {
                    $query->with('student');
                },
            ])
            ->orderBy('created_at')
            ->get();


        /*
|--------------------------------------------------------------------------
| PROJECTS
|--------------------------------------------------------------------------
*/

$projects = Project::where(
    'class_group_id',
    $classGroup->id
)
    ->with([
        'topic',
        'submissions' => function ($query) {
            $query->with([
                'student',
                'projectGroup.members.user',
                'grades.student',
            ]);
        },
    ])
    ->orderBy('created_at')
    ->get();

        /*
        |--------------------------------------------------------------------------
        | RETURN STUDENT-CENTERED MARKS PAGE
        |--------------------------------------------------------------------------
        */
        return view(
            'professor.class_groups.classroom_group.marks.index',
            [
                'classGroup' => $classGroup,
                'students' => $classGroup->students,
                'assignments' => $assignments,
                'quizzes' => $quizzes,
                'exams' => $exams,
                'projects' => $projects,

            ]
        );
    }
}
