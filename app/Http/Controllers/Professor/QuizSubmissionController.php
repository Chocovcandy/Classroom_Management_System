<?php

namespace App\Http\Controllers\Professor;

use App\Http\Controllers\Controller;
use App\Models\ClassGroup;
use App\Models\Quiz;
use App\Models\QuizSubmission;
use App\Models\Resource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;

class QuizSubmissionController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Show Student Submission
    |--------------------------------------------------------------------------
    */

    public function show(
        int $classGroupId,
        int $quizId,
        int $submissionId
    ) {
        $classGroup = ClassGroup::findOrFail($classGroupId);

        Gate::authorize('manage', $classGroup);

        $quiz = Quiz::where('id', $quizId)
            ->where('class_group_id', $classGroup->id)
            ->firstOrFail();

        $submission = QuizSubmission::with([
            'student',
            'resources',
        ])
            ->where('id', $submissionId)
            ->where('quiz_id', $quiz->id)
            ->firstOrFail();

        return view(
            'professor.class_groups.classroom_group.classworks.quizzes.submissions.show',
            compact(
                'classGroup',
                'quiz',
                'submission'
            )
        );
    }

    /*
    |--------------------------------------------------------------------------
    | View Submitted Resource
    |--------------------------------------------------------------------------
    */

    public function viewResource(
        int $classGroupId,
        int $quizId,
        int $submissionId,
        int $resourceId
    ) {
        $classGroup = ClassGroup::findOrFail($classGroupId);

        Gate::authorize('manage', $classGroup);

        $quiz = Quiz::where('id', $quizId)
            ->where('class_group_id', $classGroup->id)
            ->firstOrFail();

        $submission = QuizSubmission::where('id', $submissionId)
            ->where('quiz_id', $quiz->id)
            ->firstOrFail();

        $resource = Resource::where('id', $resourceId)
            ->where(
                'resourceable_type',
                QuizSubmission::class
            )
            ->where(
                'resourceable_id',
                $submission->id
            )
            ->firstOrFail();

        if (
            !$resource->file_path ||
            !Storage::disk('public')->exists($resource->file_path)
        ) {
            abort(404, 'File not found.');
        }

        $path = Storage::disk('public')->path(
            $resource->file_path
        );

        return response()->file($path);
    }

    /*
    |--------------------------------------------------------------------------
    | Download Submitted Resource
    |--------------------------------------------------------------------------
    */

    public function downloadResource(
        int $classGroupId,
        int $quizId,
        int $submissionId,
        int $resourceId
    ) {
        $classGroup = ClassGroup::findOrFail($classGroupId);

        Gate::authorize('manage', $classGroup);

        $quiz = Quiz::where('id', $quizId)
            ->where('class_group_id', $classGroup->id)
            ->firstOrFail();

        $submission = QuizSubmission::where('id', $submissionId)
            ->where('quiz_id', $quiz->id)
            ->firstOrFail();

        $resource = Resource::where('id', $resourceId)
            ->where(
                'resourceable_type',
                QuizSubmission::class
            )
            ->where(
                'resourceable_id',
                $submission->id
            )
            ->firstOrFail();

        if (
            !$resource->file_path ||
            !Storage::disk('public')->exists($resource->file_path)
        ) {
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

        /*
    |--------------------------------------------------------------------------
    | Grade Student Submission
    |--------------------------------------------------------------------------
    */

public function grade(
    Request $request,
    int $classGroupId,
    int $quizId,
    int $submissionId
) {
    $classGroup = ClassGroup::findOrFail($classGroupId);

    Gate::authorize('manage', $classGroup);

    $quiz = Quiz::where('class_group_id', $classGroupId)
        ->findOrFail($quizId);

    $submission = QuizSubmission::where(
        'quiz_id',
        $quiz->id
    )->findOrFail($submissionId);

    $validated = $request->validate([
        'score' => [
            'required',
            'numeric',
            'min:0',
            'max:' . $quiz->points,
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

    // Grading from Marks page
    if ($request->boolean('from_marks')) {

        return redirect()
            ->route(
                'professor.class-groups.marks',
                $classGroupId
            )
            ->with(
                'success',
                'Quiz grade updated successfully.'
            );
    }

    // Remember where the professor came from
    $origin = $request->input('origin', 'stream');

    if (!in_array($origin, ['stream', 'classwork'], true)) {
        $origin = 'stream';
    }

    // Grading from student's submission page
    return redirect()
        ->route(
            'professor.class-groups.quizzes.submissions.show',
            [
                'classGroup' => $classGroupId,
                'quiz' => $quizId,
                'submission' => $submissionId,
                'origin' => $origin,
            ]
        )
        ->with(
            'success',
            'Quiz grade updated successfully.'
        );
}

// ============================================================
// GRADE ALL
// ============================================================

public function gradeAll(
    Request $request,
    ClassGroup $classGroup,
    Quiz $quiz
) {
    Gate::authorize('manage', $classGroup);

    if ($quiz->class_group_id !== $classGroup->id) {
        abort(404);
    }

    $validated = $request->validate([
        'score' => [
            'required',
            'numeric',
            'min:0',
            'max:' . $quiz->points,
        ],
    ]);

    QuizSubmission::where(
        'quiz_id',
        $quiz->id
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
            'All submitted quiz work has been graded.'
        );
}


// ============================================================
// GRADE AS COMPLETE
// ============================================================

public function gradeAsComplete(
    int $classGroupId,
    int $quizId
) {
    $classGroup = ClassGroup::findOrFail($classGroupId);

    Gate::authorize('manage', $classGroup);

    $quiz = Quiz::where('id', $quizId)
        ->where('class_group_id', $classGroupId)
        ->firstOrFail();

    QuizSubmission::where('quiz_id', $quiz->id)
        ->whereNotNull('submitted_at')
        ->update([
            'score' => $quiz->points,
            'graded_at' => now(),
        ]);

    return redirect()
        ->route(
            'professor.class-groups.marks',
            $classGroup->id
        )
        ->with(
            'success',
            'All submitted quiz work has been graded as complete.'
        );
}
}