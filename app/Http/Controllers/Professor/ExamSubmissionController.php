<?php

namespace App\Http\Controllers\Professor;

use App\Http\Controllers\Controller;
use App\Models\ClassGroup;
use App\Models\Exam;
use App\Models\ExamSubmission;
use Illuminate\Http\Request;
use App\Models\Resource;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;    
use Illuminate\Support\Facades\Storage;

class ExamSubmissionController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Show Student Submission
    |--------------------------------------------------------------------------
    */

    public function show(
        int $classGroupId,
        int $examId,
        int $submissionId
    ) {
        $classGroup = ClassGroup::findOrFail($classGroupId);

        Gate::authorize('manage', $classGroup);

        $exam = Exam::where('id', $examId)
            ->where('class_group_id', $classGroup->id)
            ->firstOrFail();

        $submission = ExamSubmission::with([
            'student',
            'resources',
        ])
            ->where('id', $submissionId)
            ->where('exam_id', $exam->id)
            ->firstOrFail();

        return view(
            'professor.class_groups.classroom_group.classworks.exams.submissions.show',
            compact(
                'classGroup',
                'exam',
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
        int $examId,
        int $submissionId,
        int $resourceId
    ) {
        $classGroup = ClassGroup::findOrFail($classGroupId);

        Gate::authorize('manage', $classGroup);

        $exam = Exam::where('id', $examId)
            ->where('class_group_id', $classGroup->id)
            ->firstOrFail();

        $submission = ExamSubmission::where('id', $submissionId)
            ->where('exam_id', $exam->id)
            ->firstOrFail();

        $resource = Resource::where('id', $resourceId)
            ->where(
                'resourceable_type',
                ExamSubmission::class
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
        int $examId,
        int $submissionId,
        int $resourceId
    ) {
        $classGroup = ClassGroup::findOrFail($classGroupId);

        Gate::authorize('manage', $classGroup);

        $exam = Exam::where('id', $examId)
            ->where('class_group_id', $classGroup->id)
            ->firstOrFail();

        $submission = ExamSubmission::where('id', $submissionId)
            ->where('exam_id', $exam->id)
            ->firstOrFail();

        $resource = Resource::where('id', $resourceId)
            ->where(
                'resourceable_type',
                ExamSubmission::class
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
    int $examId,
    int $submissionId
) {
    $classGroup = ClassGroup::findOrFail($classGroupId);

    Gate::authorize('manage', $classGroup);

    $exam = Exam::where('class_group_id', $classGroupId)
        ->findOrFail($examId);

    $submission = ExamSubmission::where(
        'exam_id',
        $exam->id
    )->findOrFail($submissionId);

    $validated = $request->validate([
        'score' => [
            'required',
            'numeric',
            'min:0',
            'max:' . $exam->points,
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

    return redirect()
        ->route(
            'professor.class-groups.marks',
            $classGroupId
        )
        ->with(
            'success',
            'Exam grade updated successfully.'
        );
}

// ============================================================
// GRADE ALL
// ============================================================

public function gradeAll(
    Request $request,
    ClassGroup $classGroup,
    Exam $exam
) {
    Gate::authorize('manage', $classGroup);

    if ($exam->class_group_id !== $classGroup->id) {
        abort(404);
    }

    $validated = $request->validate([
        'score' => [
            'required',
            'numeric',
            'min:0',
            'max:' . $exam->points,
        ],
    ]);

    ExamSubmission::where(
        'exam_id',
        $exam->id
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
            'All submitted exam work has been graded.'
        );
}

    // ============================================================
    // GRADE AS COMPLETE
    // ============================================================

    public function gradeAsComplete(
        int $classGroupId,
        int $examId
    ) {
        $classGroup = ClassGroup::findOrFail($classGroupId);

        Gate::authorize('manage', $classGroup);

        $exam = Exam::where('id', $examId)
            ->where('class_group_id', $classGroupId)
            ->firstOrFail();

        ExamSubmission::where('exam_id', $exam->id)
            ->whereNotNull('submitted_at')
            ->update([
                'score' => $exam->points,
                'graded_at' => now(),
            ]);

        return redirect()
            ->route(
                'professor.class-groups.marks',
                $classGroup->id
            )
            ->with(
                'success',
                'All submitted exam work has been graded as complete.'
            );
    }
}
