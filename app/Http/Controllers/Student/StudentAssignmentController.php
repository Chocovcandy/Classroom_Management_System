<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Assignment;
use App\Models\AssignmentSubmission;
use App\Models\ClassGroup;
use App\Models\Resource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class StudentAssignmentController extends Controller
{
    /**
     * Show assignment details.
     */
    public function show(
        Request $request,
        ClassGroup $classGroup,
        Assignment $assignment
    ) {
        $student = Auth::user();

        // Make sure the student is enrolled in this class.
        $isStudent = $classGroup->students()
            ->where('users.id', $student->id)
            ->exists();

        if (!$isStudent) {
            abort(403, 'You are not enrolled in this class.');
        }

        // Make sure the assignment belongs to this class.
        if ($assignment->class_group_id !== $classGroup->id) {
            abort(404);
        }

        // Load assignment information and student's submission.
        $assignment->load([
            'user',
            'topic',
            'resources',
            'submissions' => function ($query) use ($student) {
                $query->where('student_id', $student->id)
                    ->with('resources');
            },
        ]);


// Only allow known return locations.
$returnTo = $request->query('return_to', 'classwork');

if (!in_array($returnTo, ['stream', 'classwork', 'marks'])) {
    $returnTo = 'classwork';
}

        // Because submissions() is a collection.
        $submission = $assignment->submissions->first();

        return view(
            'student.class_groups.classroom_group.classworks.assignments.show',
            compact(
                'classGroup',
                'assignment',
                'submission',
                'returnTo'
            )
        );
    }


    /**
     * Download a professor's assignment resource.
     */
    public function downloadResource(
        ClassGroup $classGroup,
        Assignment $assignment,
        Resource $resource
    ) {
        $student = Auth::user();

        // Make sure the student is enrolled in this class.
        $isStudent = $classGroup->students()
            ->where('users.id', $student->id)
            ->exists();

        if (!$isStudent) {
            abort(403, 'You are not enrolled in this class.');
        }

        // Make sure assignment belongs to this class.
        if ($assignment->class_group_id !== $classGroup->id) {
            abort(404);
        }

        // Make sure this resource belongs to this assignment.
        if (
            $resource->resourceable_type !== Assignment::class ||
            $resource->resourceable_id !== $assignment->id
        ) {
            abort(404);
        }

        $path = storage_path(
            'app/public/' . $resource->file_path
        );

        if (!file_exists($path)) {
            abort(404, 'File not found.');
        }

        return response()->download(
            $path,
            $resource->file_name
        );
    }


    /**
     * Submit assignment.
     */
    public function submit(
        Request $request,
        ClassGroup $classGroup,
        Assignment $assignment
    ) {
        $student = Auth::user();

        // Make sure the student is enrolled in this class.
        $isStudent = $classGroup->students()
            ->where('users.id', $student->id)
            ->exists();

        if (!$isStudent) {
            abort(403, 'You are not enrolled in this class.');
        }

        // Make sure assignment belongs to this class.
        if ($assignment->class_group_id !== $classGroup->id) {
            abort(404);
        }

        /*
         * Prevent submission after the assignment deadline.
         */
        $dueAt = null;

        if ($assignment->due_date) {
            $dueAt = \Carbon\Carbon::parse($assignment->due_date);

            if ($assignment->due_time) {
                $dueAt->setTimeFromTimeString($assignment->due_time);
            } else {
                $dueAt->endOfDay();
            }
        }

        if ($dueAt && now()->greaterThan($dueAt)) {
            return redirect()
                ->route(
                    'student.class-groups.assignments.show',
                    [
                        'classGroup' => $classGroup->id,
                        'assignment' => $assignment->id,
                        'return_to' => 'classwork',
                    ]
                )
                ->with(
                    'error',
                    'The assignment deadline has passed. You can no longer submit this assignment.'
                );
        }

        $request->validate([
            'attachments' => ['required', 'array', 'min:1'],

            'attachments.*' => [
                'file',
                'max:102400',
            ],
        ]);

        /*
         * Find the student's existing submission.
         *
         * Because assignment_id + student_id is unique,
         * the student has only one submission record.
         */
        $submission = AssignmentSubmission::firstOrCreate(
            [
                'assignment_id' => $assignment->id,
                'student_id' => $student->id,
            ]
        );

        // Store submitted files.
        foreach ($request->file('attachments', []) as $file) {

            $path = $file->store(
                'assignment-submissions',
                'public'
            );

            $submission->resources()->create([
                'title' => $file->getClientOriginalName(),
                'type' => 'file',
                'file_path' => $path,
                'file_name' => $file->getClientOriginalName(),
                'mime_type' => $file->getMimeType(),
                'file_size' => $file->getSize(),
                'url' => null,
            ]);
        }

        // Record the submission time.
        $submission->update([
            'submitted_at' => now(),
        ]);

        // Keep the page where the student originally opened the assignment.
        $returnTo = $request->input('return_to', 'stream');

        if (!in_array($returnTo, ['stream', 'classwork', 'marks'], true)) {
            $returnTo = 'stream';
        }

        return redirect()
            ->route(
                'student.class-groups.assignments.show',
                [
                    'classGroup' => $classGroup->id,
                    'assignment' => $assignment->id,
                    'return_to' => $returnTo,
                ]
            )
            ->with('success', 'Assignment submitted successfully.');
    }

    public function cancel(
    Request $request,
    ClassGroup $classGroup,
    Assignment $assignment
) {
    $student = Auth::user();

    // Check enrollment
    $isStudent = $classGroup->students()
        ->where('users.id', $student->id)
        ->exists();

    if (!$isStudent) {
        abort(403, 'You are not enrolled in this class.');
    }

    // Make sure assignment belongs to this class
    if ($assignment->class_group_id !== $classGroup->id) {
        abort(404);
    }

    /*
    |--------------------------------------------------------------------------
    | Prevent cancellation after the assignment deadline
    |--------------------------------------------------------------------------
    */
    $dueAt = null;

    if ($assignment->due_date) {
        $dueAt = \Carbon\Carbon::parse($assignment->due_date);

        if ($assignment->due_time) {
            $dueAt->setTimeFromTimeString($assignment->due_time);
        } else {
            $dueAt->endOfDay();
        }
    }

    if ($dueAt && now()->greaterThan($dueAt)) {
        return redirect()
            ->route(
                'student.class-groups.assignments.show',
                [
                    'classGroup' => $classGroup->id,
                    'assignment' => $assignment->id,
                    'return_to' => $request->input(
                        'return_to',
                        'classwork'
                    ),
                ]
            )
            ->with(
                'error',
                'The assignment deadline has passed. You can no longer cancel your submission.'
            );
    }

    $submission = AssignmentSubmission::where(
        'assignment_id',
        $assignment->id
    )
        ->where(
            'student_id',
            $student->id
        )
        ->first();

    if (!$submission) {

        return redirect()
            ->route(
                'student.class-groups.assignments.show',
                [
                    'classGroup' => $classGroup->id,
                    'assignment' => $assignment->id,
                    'return_to' => $request->input(
                        'return_to',
                        'classwork'
                    ),
                ]
            )
            ->with(
                'error',
                'No submission was found.'
            );
    }

    /*
    |--------------------------------------------------------------------------
    | Delete submitted files
    |--------------------------------------------------------------------------
    */

    $submission->load('resources');

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
    | Delete submission
    |--------------------------------------------------------------------------
    */

    $submission->delete();

    return redirect()
        ->route(
            'student.class-groups.assignments.show',
            [
                'classGroup' => $classGroup->id,
                'assignment' => $assignment->id,
                'return_to' => $request->input(
                    'return_to',
                    'classwork'
                ),
            ]
        )
        ->with(
            'success',
            'Assignment submission cancelled successfully.'
        );
}
}
