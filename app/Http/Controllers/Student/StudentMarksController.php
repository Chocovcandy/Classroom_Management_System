<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Assignment;
use App\Models\ClassGroup;
use App\Models\Exam;
use App\Models\Project;
use App\Models\Quiz;
use Illuminate\Support\Facades\Auth;

class StudentMarksController extends Controller
{
    /**
     * Display the student's marks for a classroom.
     */
    public function index(int $classGroupId)
    {
        /*
        |--------------------------------------------------------------------------
        | CLASSROOM
        |--------------------------------------------------------------------------
        */

        $classGroup = ClassGroup::with('students')
            ->findOrFail($classGroupId);

        /*
        |--------------------------------------------------------------------------
        | STUDENT
        |--------------------------------------------------------------------------
        */

        $student = Auth::user();

        /*
        |--------------------------------------------------------------------------
        | CHECK THAT STUDENT BELONGS TO THIS CLASS
        |--------------------------------------------------------------------------
        */

        $isMember = $classGroup->students()
            ->where('users.id', $student->id)
            ->exists();

        abort_unless($isMember, 403);

        /*
        |--------------------------------------------------------------------------
        | ASSIGNMENTS
        |--------------------------------------------------------------------------
        */

        $assignments = Assignment::where(
            'class_group_id',
            $classGroup->id
        )
            ->with([
                'topic',

                'submissions' => function ($query) use ($student) {
                    $query->where('student_id', $student->id);
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

                'submissions' => function ($query) use ($student) {
                    $query->where('student_id', $student->id);
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

                'submissions' => function ($query) use ($student) {
                    $query->where('student_id', $student->id);
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

                'submissions' => function ($query) use ($student) {

                    $query
                        ->where(function ($query) use ($student) {

                            /*
                            |--------------------------------------------------------------------------
                            | INDIVIDUAL PROJECT
                            |--------------------------------------------------------------------------
                            |
                            | Get the student's own submission.
                            |
                            */

                            $query->where(function ($subQuery) use ($student) {
                                $subQuery
                                    ->whereNull('project_group_id')
                                    ->where('student_id', $student->id);
                            })

                            /*
                            |--------------------------------------------------------------------------
                            | TEAM PROJECT
                            |--------------------------------------------------------------------------
                            |
                            | Get the submission belonging to the team
                            | that contains this student.
                            |
                            */

                            ->orWhereHas(
                                'projectGroup.members',
                                function ($memberQuery) use ($student) {
                                    $memberQuery->where(
                                        'user_id',
                                        $student->id
                                    );
                                }
                            );
                        })

                        /*
                        |--------------------------------------------------------------------------
                        | INDIVIDUAL TEAM MEMBER GRADE
                        |--------------------------------------------------------------------------
                        |
                        | Load only this student's individual grade.
                        |
                        */

                        ->with([
                            'grades' => function ($gradeQuery) use ($student) {
                                $gradeQuery->where(
                                    'student_id',
                                    $student->id
                                );
                            },
                        ]);
                },
            ])
            ->orderBy('created_at')
            ->get();

        /*
        |--------------------------------------------------------------------------
        | CALCULATE CURRENT MARKS
        |--------------------------------------------------------------------------
        */

        $totalEarned = 0;
        $totalPoints = 0;
        $gradedClassworks = 0;

        /*
        |--------------------------------------------------------------------------
        | ASSIGNMENT MARKS
        |--------------------------------------------------------------------------
        */

        foreach ($assignments as $assignment) {

            $submission = $assignment->submissions->first();

            if (
                $submission &&
                $submission->score !== null
            ) {
                $totalEarned += (float) $submission->score;

                $totalPoints += (float) $assignment->points;

                $gradedClassworks++;
            }
        }

        /*
        |--------------------------------------------------------------------------
        | QUIZ MARKS
        |--------------------------------------------------------------------------
        */

        foreach ($quizzes as $quiz) {

            $submission = $quiz->submissions->first();

            if (
                $submission &&
                $submission->score !== null
            ) {
                $totalEarned += (float) $submission->score;

                $totalPoints += (float) $quiz->points;

                $gradedClassworks++;
            }
        }

        /*
        |--------------------------------------------------------------------------
        | EXAM MARKS
        |--------------------------------------------------------------------------
        */

        foreach ($exams as $exam) {

            $submission = $exam->submissions->first();

            if (
                $submission &&
                $submission->score !== null
            ) {
                $totalEarned += (float) $submission->score;

                $totalPoints += (float) $exam->points;

                $gradedClassworks++;
            }
        }

        /*
        |--------------------------------------------------------------------------
        | PROJECT MARKS
        |--------------------------------------------------------------------------
        */

        foreach ($projects as $project) {

            $submission = $project->submissions->first();

            /*
            |--------------------------------------------------------------------------
            | NO SUBMISSION
            |--------------------------------------------------------------------------
            */

            if (!$submission) {
                continue;
            }

            $score = null;

            /*
            |--------------------------------------------------------------------------
            | INDIVIDUAL PROJECT
            |--------------------------------------------------------------------------
            */

            if ($project->project_type !== 'team') {

                if ($submission->score !== null) {
                    $score = (float) $submission->score;
                }
            }

            /*
            |--------------------------------------------------------------------------
            | TEAM PROJECT
            |--------------------------------------------------------------------------
            */

            else {

                /*
                |--------------------------------------------------------------------------
                | USE INDIVIDUAL MEMBER GRADE FIRST
                |--------------------------------------------------------------------------
                |
                | Professor may give each team member a different score.
                |
                */

                $individualGrade = $submission->grades->first();

                if (
                    $individualGrade &&
                    $individualGrade->score !== null
                ) {
                    $score = (float) $individualGrade->score;
                }

                /*
                |--------------------------------------------------------------------------
                | FALL BACK TO TEAM SCORE
                |--------------------------------------------------------------------------
                |
                | If the professor has not given an individual member
                | grade, use the common team score.
                |
                */

                elseif ($submission->score !== null) {
                    $score = (float) $submission->score;
                }
            }

            /*
            |--------------------------------------------------------------------------
            | ADD PROJECT TO OVERALL MARKS
            |--------------------------------------------------------------------------
            */

            if ($score !== null) {

                $totalEarned += $score;

                $totalPoints += (float) $project->points;

                $gradedClassworks++;
            }
        }

        /*
        |--------------------------------------------------------------------------
        | OVERALL PERCENTAGE
        |--------------------------------------------------------------------------
        */

        $overallPercentage = $totalPoints > 0
            ? ($totalEarned / $totalPoints) * 100
            : null;

        /*
        |--------------------------------------------------------------------------
        | RETURN VIEW
        |--------------------------------------------------------------------------
        */

        return view(
            'student.class_groups.classroom_group.marks.index',
            [
                'classGroup' => $classGroup,
                'student' => $student,

                'assignments' => $assignments,
                'quizzes' => $quizzes,
                'exams' => $exams,
                'projects' => $projects,

                'totalEarned' => $totalEarned,
                'totalPoints' => $totalPoints,
                'overallPercentage' => $overallPercentage,
                'gradedClassworks' => $gradedClassworks,
            ]
        );
    }
}