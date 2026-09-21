<?php

namespace App\Http\Controllers\Professor;

use App\Http\Controllers\Controller;
use App\Models\Assignment;
use App\Models\AssignmentSubmission;
use App\Models\ClassGroup;
use App\Models\Resource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;

class AssignmentSubmissionController extends Controller
{
    /**
     * Show one student's submission.
     */
    public function show(
        int $classGroupId,
        int $assignmentId,
        int $submissionId
    ) {
        // Get the class group
        $classGroup = ClassGroup::findOrFail($classGroupId);

        // Make sure the professor can manage this class
        Gate::authorize('manage', $classGroup);

        // Make sure the assignment belongs to this class
        $assignment = Assignment::where('id', $assignmentId)
            ->where('class_group_id', $classGroup->id)
            ->firstOrFail();

        // Make sure the submission belongs to this assignment
        $submission = AssignmentSubmission::with([
            'student',
            'resources',
        ])
            ->where('id', $submissionId)
            ->where('assignment_id', $assignment->id)
            ->firstOrFail();

        return view(
            'professor.class_groups.classroom_group.classworks.assignments.submissions.show',
            compact(
                'classGroup',
                'assignment',
                'submission'
            )
        );
    }

    /**
     * Grade a student's assignment submission.
     */
public function grade(
    Request $request,
    int $classGroupId,
    int $assignmentId,
    int $submissionId
) {
    $classGroup = ClassGroup::findOrFail($classGroupId);

    Gate::authorize('manage', $classGroup);

    $assignment = Assignment::where('class_group_id', $classGroupId)
        ->findOrFail($assignmentId);

    $submission = AssignmentSubmission::where(
        'assignment_id',
        $assignment->id
    )->findOrFail($submissionId);

    $validated = $request->validate([
        'score' => [
            'required',
            'numeric',
            'min:0',
            'max:' . $assignment->points,
        ],

        'feedback' => [
            'nullable',
            'string',
        ],
    ]);

    $submission->update([
        'score' => $validated['score'],
        'feedback' => $validated['feedback'] ?? null,
        'graded_at' => now(),
    ]);

    // Grading from the Marks page
    if ($request->boolean('from_marks')) {

        return redirect()
            ->route(
                'professor.class-groups.marks',
                $classGroupId
            )
            ->with(
                'success',
                'Assignment grade updated successfully.'
            );
    }

    // Remember where the professor originally came from
    $origin = $request->input('origin', 'stream');

    if (!in_array($origin, ['stream', 'classwork'], true)) {
        $origin = 'stream';
    }

    // Grading from the student's submission page
    return redirect()
        ->route(
            'professor.class-groups.assignments.submissions.show',
            [
                'classGroup' => $classGroupId,
                'assignment' => $assignmentId,
                'submission' => $submissionId,
                'origin' => $origin,
            ]
        )
        ->with(
            'success',
            'Assignment grade updated successfully.'
        );
}
    /**
     * View a submitted file in the browser.
     */
    public function viewResource(
        int $classGroupId,
        int $assignmentId,
        int $submissionId,
        int $resourceId
    ) {
        // Get class group
        $classGroup = ClassGroup::findOrFail($classGroupId);

        // Professor authorization
        Gate::authorize('manage', $classGroup);

        // Make sure assignment belongs to class
        $assignment = Assignment::where('id', $assignmentId)
            ->where('class_group_id', $classGroup->id)
            ->firstOrFail();

        // Make sure submission belongs to assignment
        $submission = AssignmentSubmission::where('id', $submissionId)
            ->where('assignment_id', $assignment->id)
            ->firstOrFail();

        // Make sure resource belongs to this submission
        $resource = Resource::where('id', $resourceId)
            ->where(
                'resourceable_type',
                AssignmentSubmission::class
            )
            ->where('resourceable_id', $submission->id)
            ->firstOrFail();

        // Check file exists
        if (!Storage::disk('public')->exists($resource->file_path)) {
            abort(404, 'File not found.');
        }

        $path = Storage::disk('public')->path(
            $resource->file_path
        );

        return response()->file($path);
    }

    /**
     * Download a submitted file.
     */
    public function downloadResource(
        int $classGroupId,
        int $assignmentId,
        int $submissionId,
        int $resourceId
    ) {
        // Get class group
        $classGroup = ClassGroup::findOrFail($classGroupId);

        // Professor authorization
        Gate::authorize('manage', $classGroup);

        // Make sure assignment belongs to class
        $assignment = Assignment::where('id', $assignmentId)
            ->where('class_group_id', $classGroup->id)
            ->firstOrFail();

        // Make sure submission belongs to assignment
        $submission = AssignmentSubmission::where('id', $submissionId)
            ->where('assignment_id', $assignment->id)
            ->firstOrFail();

        // Make sure resource belongs to this submission
        $resource = Resource::where('id', $resourceId)
            ->where(
                'resourceable_type',
                AssignmentSubmission::class
            )
            ->where('resourceable_id', $submission->id)
            ->firstOrFail();

        // Check file exists
        if (!Storage::disk('public')->exists($resource->file_path)) {
            abort(404, 'File not found.');
        }

        $path = Storage::disk('public')->path(
            $resource->file_path
        );

        return response()->download(
            $path,
            $resource->file_name
        );
    }

// ============================================================
// GRADE ALL
// ============================================================

public function gradeAll(
    Request $request,
    ClassGroup $classGroup,
    Assignment $assignment
) {
    Gate::authorize('manage', $classGroup);

    if ($assignment->class_group_id !== $classGroup->id) {
        abort(404);
    }

    $validated = $request->validate([
        'score' => [
            'required',
            'numeric',
            'min:0',
            'max:' . $assignment->points,
        ],
    ]);

    AssignmentSubmission::where(
        'assignment_id',
        $assignment->id
    )
        ->whereNotNull('submitted_at')
        ->update([
            'score' => $validated['score'],
            'graded_at' => now(),
        ]);

    return redirect()
        ->route(
            'professor.class-groups.marks',
            $classGroup->id
        )
        ->with(
            'success',
            'All submitted assignment work has been graded.'
        );
}
// ============================================================
// GRADE AS COMPLETE
// ============================================================

public function gradeAsComplete(
    int $classGroupId,
    int $assignmentId
) {
    $classGroup = ClassGroup::findOrFail($classGroupId);

    Gate::authorize('manage', $classGroup);

    $assignment = Assignment::where('id', $assignmentId)
        ->where('class_group_id', $classGroupId)
        ->firstOrFail();

    AssignmentSubmission::where('assignment_id', $assignment->id)
        ->whereNotNull('submitted_at')
        ->update([
            'score' => $assignment->points,
            'graded_at' => now(),
        ]);

    return redirect()
        ->route(
            'professor.class-groups.marks',
            $classGroup->id
        )
        ->with(
            'success',
            'All submitted assignment work has been graded as complete.'
        );
}

}