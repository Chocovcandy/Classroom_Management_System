<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\ClassGroup;
use App\Models\Quiz;
use App\Models\QuizSubmission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class StudentQuizController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Show Quiz
    |--------------------------------------------------------------------------
    */

    public function show(
        Request $request,
        ClassGroup $classGroup,
        Quiz $quiz
    ) {
        $student = Auth::user();

        /*
        |--------------------------------------------------------------------------
        | Check Enrollment
        |--------------------------------------------------------------------------
        */

        $isStudent = $classGroup->students()
            ->where('users.id', $student->id)
            ->exists();

        if (!$isStudent) {
            abort(403, 'You are not enrolled in this class.');
        }


        /*
        |--------------------------------------------------------------------------
        | Make Sure Quiz Belongs To This Class
        |--------------------------------------------------------------------------
        */

        if ($quiz->class_group_id !== $classGroup->id) {
            abort(404);
        }


        /*
        |--------------------------------------------------------------------------
        | Load Quiz
        |--------------------------------------------------------------------------
        */

        $quiz->load([
            'user',
            'topic',
            'resources',
        ]);


        /*
        |--------------------------------------------------------------------------
        | Get Student Submission
        |--------------------------------------------------------------------------
        */

        $submission = QuizSubmission::with('resources')
            ->where('quiz_id', $quiz->id)
            ->where('student_id', $student->id)
            ->first();


        /*
        |--------------------------------------------------------------------------
        | Return Location
        |--------------------------------------------------------------------------
        */

// Only allow known return locations.
$returnTo = $request->query('return_to', 'classwork');

if (!in_array($returnTo, ['stream', 'classwork', 'marks'])) {
    $returnTo = 'classwork';
}


        return view(
            'student.class_groups.classroom_group.classworks.quizzes.show',
            compact(
                'classGroup',
                'quiz',
                'submission',
                'returnTo'
            )
        );
    }


    /*
    |--------------------------------------------------------------------------
    | Submit Quiz
    |--------------------------------------------------------------------------
    */

    public function submit(
        Request $request,
        ClassGroup $classGroup,
        Quiz $quiz
    ) {
        $student = Auth::user();


        /*
        |--------------------------------------------------------------------------
        | Check Enrollment
        |--------------------------------------------------------------------------
        */

        $isStudent = $classGroup->students()
            ->where('users.id', $student->id)
            ->exists();

        if (!$isStudent) {
            abort(403, 'You are not enrolled in this class.');
        }


        /*
        |--------------------------------------------------------------------------
        | Make Sure Quiz Belongs To This Class
        |--------------------------------------------------------------------------
        */

        if ($quiz->class_group_id !== $classGroup->id) {
            abort(404);
        }


        /*
        |--------------------------------------------------------------------------
        | Validate Uploaded Files
        |--------------------------------------------------------------------------
        */

        $request->validate([
            'attachments' => [
                'nullable',
                'array',
            ],

            'attachments.*' => [
                'file',
                'max:102400',
            ],
        ]);


        /*
        |--------------------------------------------------------------------------
        | Get Existing Submission
        |--------------------------------------------------------------------------
        */

        $submission = QuizSubmission::firstOrCreate(
            [
                'quiz_id' => $quiz->id,
                'student_id' => $student->id,
            ],
            [
                'started_at' => now(),
            ]
        );


        /*
        |--------------------------------------------------------------------------
        | Save Uploaded Files
        |--------------------------------------------------------------------------
        */

        if ($request->hasFile('attachments')) {

            foreach ($request->file('attachments') as $file) {

                $path = $file->store(
                    'quiz-submissions',
                    'public'
                );

                if ($request->hasFile('attachments')) {

    foreach ($request->file('attachments') as $file) {

       $path = $file->store(
    'quiz-submissions',
    'public'
);

$submission->resources()->create([
    'title' => $file->getClientOriginalName(),
    'type' => 'file',
    'file_path' => $path,
    'file_name' => $file->getClientOriginalName(),
    'mime_type' => $file->getClientMimeType(),
    'file_size' => $file->getSize(),
    'url' => null,
]);
    }
}
            }
        }


        /*
        |--------------------------------------------------------------------------
        | Mark Submission As Submitted
        |--------------------------------------------------------------------------
        */

        $submission->update([
            'submitted_at' => now(),
        ]);


        /*
        |--------------------------------------------------------------------------
        | Redirect
        |--------------------------------------------------------------------------
        */

        return redirect()
            ->route(
                'student.class-groups.quizzes.show',
                [
                    'classGroup' => $classGroup->id,
                    'quiz' => $quiz->id,
                    'return_to' => $request->input(
                        'return_to',
                        'classwork'
                    ),
                ]
            )
            ->with(
                'success',
                'Quiz submitted successfully.'
            );
    }


    /*
    |--------------------------------------------------------------------------
    | Cancel Submission
    |--------------------------------------------------------------------------
    */

    public function cancel(
        Request $request,
        ClassGroup $classGroup,
        Quiz $quiz
    ) {
        $student = Auth::user();


        /*
        |--------------------------------------------------------------------------
        | Check Enrollment
        |--------------------------------------------------------------------------
        */

        $isStudent = $classGroup->students()
            ->where('users.id', $student->id)
            ->exists();

        if (!$isStudent) {
            abort(403, 'You are not enrolled in this class.');
        }


        /*
        |--------------------------------------------------------------------------
        | Make Sure Quiz Belongs To This Class
        |--------------------------------------------------------------------------
        */

        if ($quiz->class_group_id !== $classGroup->id) {
            abort(404);
        }


        /*
        |--------------------------------------------------------------------------
        | Find Submission
        |--------------------------------------------------------------------------
        */

        $submission = QuizSubmission::with('resources')
            ->where('quiz_id', $quiz->id)
            ->where('student_id', $student->id)
            ->first();


        if (!$submission) {

            return redirect()
                ->route(
                    'student.class-groups.quizzes.show',
                    [
                        'classGroup' => $classGroup->id,
                        'quiz' => $quiz->id,
                        'return_to' => $request->input(
                            'return_to',
                            'classwork'
                        ),
                    ]
                )
                ->with(
                    'error',
                    'No quiz submission was found.'
                );
        }


        /*
        |--------------------------------------------------------------------------
        | Calculate Due Date / Time
        |--------------------------------------------------------------------------
        */

        $dueAt = null;

        if ($quiz->due_date) {

            $dueAt = Carbon::parse(
                $quiz->due_date
            );

            if ($quiz->due_time) {

                $dueAt->setTimeFromTimeString(
                    $quiz->due_time
                );

            } else {

                $dueAt->endOfDay();

            }
        }


        /*
        |--------------------------------------------------------------------------
        | Prevent Cancellation After Due Time
        |--------------------------------------------------------------------------
        */

        if (
            $dueAt &&
            now()->greaterThan($dueAt)
        ) {

            return redirect()
                ->route(
                    'student.class-groups.quizzes.show',
                    [
                        'classGroup' => $classGroup->id,
                        'quiz' => $quiz->id,
                        'return_to' => $request->input(
                            'return_to',
                            'classwork'
                        ),
                    ]
                )
                ->with(
                    'error',
                    'You can no longer cancel this submission because the quiz is past the due time.'
                );
        }


        /*
        |--------------------------------------------------------------------------
        | Delete Uploaded Submission Files
        |--------------------------------------------------------------------------
        */

        foreach ($submission->resources as $resource) {

            if (
                $resource->file_path &&
                Storage::disk('public')->exists(
                    $resource->file_path
                )
            ) {
                Storage::disk('public')->delete(
                    $resource->file_path
                );
            }

            $resource->delete();
        }


        /*
        |--------------------------------------------------------------------------
        | Delete Submission
        |--------------------------------------------------------------------------
        */

        $submission->delete();


        /*
        |--------------------------------------------------------------------------
        | Redirect
        |--------------------------------------------------------------------------
        */

        return redirect()
            ->route(
                'student.class-groups.quizzes.show',
                [
                    'classGroup' => $classGroup->id,
                    'quiz' => $quiz->id,
                    'return_to' => $request->input(
                        'return_to',
                        'classwork'
                    ),
                ]
            )
            ->with(
                'success',
                'Quiz submission cancelled successfully.'
            );
    }
}