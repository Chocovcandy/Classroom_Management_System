<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\ClassGroup;
use App\Models\Exam;
use App\Models\ExamSubmission;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class StudentExamController extends Controller
{
    /**
     * Show exam details.
     */
    public function show(
        Request $request,
        ClassGroup $classGroup,
        Exam $exam
    ) {
        $student = Auth::user();

        /*
        |--------------------------------------------------------------------------
        | Check student enrollment
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
        | Make sure exam belongs to this class
        |--------------------------------------------------------------------------
        */

        if ($exam->class_group_id !== $classGroup->id) {
            abort(404);
        }

        /*
        |--------------------------------------------------------------------------
        | Load exam relationships
        |--------------------------------------------------------------------------
        */

        $exam->load([
            'user',
            'topic',
            'resources',
        ]);

        /*
        |--------------------------------------------------------------------------
        | Get student's submission
        |--------------------------------------------------------------------------
        */

        $submission = ExamSubmission::with('resources')
            ->where('exam_id', $exam->id)
            ->where('student_id', $student->id)
            ->first();

        /*
        |--------------------------------------------------------------------------
        | Return location
        |--------------------------------------------------------------------------
        */

// Only allow known return locations.
$returnTo = $request->query('return_to', 'classwork');

if (!in_array($returnTo, ['stream', 'classwork', 'marks'])) {
    $returnTo = 'classwork';
}

        return view(
            'student.class_groups.classroom_group.classworks.exams.show',
            compact(
                'classGroup',
                'exam',
                'submission',
                'returnTo'
            )
        );
    }


    /**
     * Submit exam.
     */
    public function submit(
        Request $request,
        ClassGroup $classGroup,
        Exam $exam
    ) {
        $student = Auth::user();

        /*
        |--------------------------------------------------------------------------
        | Check enrollment
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
        | Make sure exam belongs to class
        |--------------------------------------------------------------------------
        */

        if ($exam->class_group_id !== $classGroup->id) {
            abort(404);
        }

        /*
        |--------------------------------------------------------------------------
        | Validate uploaded files
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
        | Check existing submission
        |--------------------------------------------------------------------------
        */

        $submission = ExamSubmission::firstOrCreate(
            [
                'exam_id' => $exam->id,
                'student_id' => $student->id,
            ],
            [
                'started_at' => now(),
            ]
        );

        /*
        |--------------------------------------------------------------------------
        | Save uploaded files
        |--------------------------------------------------------------------------
        */

        if ($request->hasFile('attachments')) {

            foreach ($request->file('attachments') as $file) {

                $path = $file->store(
                    'exam-submissions',
                    'public'
                );

                $submission->resources()->create([
                    'user_id' => $student->id,
                    'title' => $file->getClientOriginalName(),
                    'type' => 'file',
                    'file_path' => $path,
                    'file_name' => $file->getClientOriginalName(),
                    'mime_type' => $file->getClientMimeType(),
                    'file_size' => $file->getSize(),
                ]);
            }
        }

        /*
        |--------------------------------------------------------------------------
        | Mark submitted
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

        return redirect()->route(
            'student.class-groups.exams.show',
            [
                'classGroup' => $classGroup->id,
                'exam' => $exam->id,
                'return_to' => $request->input(
                    'return_to',
                    'classwork'
                ),
            ]
        )->with(
            'success',
            'Exam submitted successfully.'
        );
    }


    /**
     * Cancel exam submission.
     */
    public function cancel(
        Request $request,
        ClassGroup $classGroup,
        Exam $exam
    ) {
        $student = Auth::user();

        /*
        |--------------------------------------------------------------------------
        | Check enrollment
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
        | Make sure exam belongs to class
        |--------------------------------------------------------------------------
        */

        if ($exam->class_group_id !== $classGroup->id) {
            abort(404);
        }

        /*
        |--------------------------------------------------------------------------
        | Calculate due time
        |--------------------------------------------------------------------------
        */

        $dueAt = null;

        if ($exam->due_date) {

            $dueAt = Carbon::parse(
                $exam->due_date
            );

            if ($exam->due_time) {

                $dueAt->setTimeFromTimeString(
                    $exam->due_time
                );

            } else {

                $dueAt->endOfDay();
            }
        }

        /*
        |--------------------------------------------------------------------------
        | Prevent cancellation after deadline
        |--------------------------------------------------------------------------
        */

        if ($dueAt && now()->greaterThan($dueAt)) {

            return redirect()->route(
                'student.class-groups.exams.show',
                [
                    'classGroup' => $classGroup->id,
                    'exam' => $exam->id,
                    'return_to' => $request->input(
                        'return_to',
                        'classwork'
                    ),
                ]
            )->with(
                'error',
                'The submission can no longer be cancelled because the exam is past its due time.'
            );
        }

        /*
        |--------------------------------------------------------------------------
        | Find submission
        |--------------------------------------------------------------------------
        */

        $submission = ExamSubmission::with('resources')
            ->where('exam_id', $exam->id)
            ->where('student_id', $student->id)
            ->first();

        if (!$submission) {

            return redirect()->route(
                'student.class-groups.exams.show',
                [
                    'classGroup' => $classGroup->id,
                    'exam' => $exam->id,
                    'return_to' => $request->input(
                        'return_to',
                        'classwork'
                    ),
                ]
            )->with(
                'error',
                'No exam submission was found.'
            );
        }

        /*
        |--------------------------------------------------------------------------
        | Delete uploaded files
        |--------------------------------------------------------------------------
        */

        foreach ($submission->resources as $resource) {

            if ($resource->file_path) {

                Storage::disk('public')->delete(
                    $resource->file_path
                );
            }

            $resource->delete();
        }

        /*
        |--------------------------------------------------------------------------
        | Delete submission
        |--------------------------------------------------------------------------
        */

        $submission->delete();

        /*
        |--------------------------------------------------------------------------
        | Redirect
        |--------------------------------------------------------------------------
        */

        return redirect()->route(
            'student.class-groups.exams.show',
            [
                'classGroup' => $classGroup->id,
                'exam' => $exam->id,
                'return_to' => $request->input(
                    'return_to',
                    'classwork'
                ),
            ]
        )->with(
            'success',
            'Exam submission cancelled successfully.'
        );
    }
}