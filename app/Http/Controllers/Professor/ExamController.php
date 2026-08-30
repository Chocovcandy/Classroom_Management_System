<?php

namespace App\Http\Controllers\Professor;

use App\Http\Controllers\Controller;
use App\Models\ClassGroup;
use App\Models\Exam;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;

class ExamController extends Controller
{
    /**
     * Show create exam form.
     */
    public function create(ClassGroup $classGroup)
    {
        Gate::authorize('manage', $classGroup);

        return view(
            'professor.class_groups.classroom_group.classworks.exams.create',
            compact('classGroup')
        );
    }

    /**
     * Store exam.
     */
    public function store(
        Request $request,
        ClassGroup $classGroup
    ) {
        Gate::authorize('manage', $classGroup);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'topic_id' => 'nullable|exists:topics,id',
            'due_date' => 'nullable|date',
            'due_time' => 'nullable',
            'points' => 'nullable|numeric|min:0',
            'attachment' => 'nullable|file|max:51200',
        ]);

        /*
        |--------------------------------------------------------------------------
        | Store attachment
        |--------------------------------------------------------------------------
        */

        $attachmentPath = null;

        if ($request->hasFile('attachment')) {

            $attachmentPath = $request
                ->file('attachment')
                ->store('exams', 'public');
        }

        /*
        |--------------------------------------------------------------------------
        | Create exam
        |--------------------------------------------------------------------------
        */

        $exam = new Exam();

        $exam->class_group_id = $classGroup->id;
        $exam->user_id = Auth::id();
        $exam->topic_id = $validated['topic_id'] ?? null;
        $exam->title = $validated['title'];
        $exam->description = $validated['description'] ?? null;
        $exam->due_date = $validated['due_date'] ?? null;
        $exam->due_time = $validated['due_time'] ?? null;
        $exam->points = $validated['points'] ?? null;
        $exam->attachment = $attachmentPath;

        $exam->save();

        return redirect()
            ->route(
                'professor.class-groups.classroom-group.classwork',
                $classGroup
            )
            ->with(
                'success',
                'Exam created successfully.'
            );
    }

    /**
 * Show exam detail.
 */
public function show(
    ClassGroup $classGroup,
    Exam $exam
) {
    Gate::authorize('manage', $classGroup);

    /*
    |--------------------------------------------------------------------------
    | Make sure exam belongs to this class group
    |--------------------------------------------------------------------------
    */

    if ($exam->class_group_id !== $classGroup->id) {
        abort(404);
    }

    $exam->load([
        'user',
        'topic',
    ]);

    return view(
        'professor.class_groups.classroom_group.classworks.exams.show',
        compact(
            'classGroup',
            'exam'
        )
    );
}

    /**
     * Show edit exam form.
     */
    public function edit(
        ClassGroup $classGroup,
        Exam $exam
    ) {
        Gate::authorize('manage', $classGroup);

        /*
        |--------------------------------------------------------------------------
        | Make sure exam belongs to this class group
        |--------------------------------------------------------------------------
        */

        if ($exam->class_group_id !== $classGroup->id) {
            abort(404);
        }

        return view(
            'professor.class_groups.classroom_group.classworks.exams.edit',
            compact(
                'classGroup',
                'exam'
            )
        );
    }

    /**
     * Update exam.
     */
    public function update(
        Request $request,
        ClassGroup $classGroup,
        Exam $exam
    ) {
        Gate::authorize('manage', $classGroup);

        /*
        |--------------------------------------------------------------------------
        | Make sure exam belongs to this class group
        |--------------------------------------------------------------------------
        */

        if ($exam->class_group_id !== $classGroup->id) {
            abort(404);
        }

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'topic_id' => 'nullable|exists:topics,id',
            'due_date' => 'nullable|date',
            'due_time' => 'nullable',
            'points' => 'nullable|numeric|min:0',
            'attachment' => 'nullable|file|max:51200',
        ]);

        $exam->title =
            $validated['title'];

        $exam->description =
            $validated['description'] ?? null;

        $exam->topic_id =
            $validated['topic_id'] ?? null;

        $exam->due_date =
            $validated['due_date'] ?? null;

        $exam->due_time =
            $validated['due_time'] ?? null;

        $exam->points =
            $validated['points'] ?? null;

        /*
        |--------------------------------------------------------------------------
        | Replace attachment if new file uploaded
        |--------------------------------------------------------------------------
        */

        if ($request->hasFile('attachment')) {

            /*
            |--------------------------------------------------------------------------
            | Delete old attachment
            |--------------------------------------------------------------------------
            */

            if (
                $exam->attachment &&
                Storage::disk('public')
                    ->exists($exam->attachment)
            ) {

                Storage::disk('public')
                    ->delete($exam->attachment);
            }

            /*
            |--------------------------------------------------------------------------
            | Store new attachment
            |--------------------------------------------------------------------------
            */

            $exam->attachment = $request
                ->file('attachment')
                ->store('exams', 'public');
        }

        $exam->save();

        return redirect()
            ->route(
                'professor.class-groups.classroom-group.classwork',
                $classGroup
            )
            ->with(
                'success',
                'Exam updated successfully.'
            );
    }

    /**
     * Delete exam.
     */
    public function destroy(
        ClassGroup $classGroup,
        Exam $exam
    ) {
        Gate::authorize('manage', $classGroup);

        /*
        |--------------------------------------------------------------------------
        | Make sure exam belongs to this class group
        |--------------------------------------------------------------------------
        */

        if ($exam->class_group_id !== $classGroup->id) {
            abort(404);
        }

        /*
        |--------------------------------------------------------------------------
        | Delete attachment
        |--------------------------------------------------------------------------
        */

        if (
            $exam->attachment &&
            Storage::disk('public')
                ->exists($exam->attachment)
        ) {

            Storage::disk('public')
                ->delete($exam->attachment);
        }

        /*
        |--------------------------------------------------------------------------
        | Delete database record
        |--------------------------------------------------------------------------
        */

        $exam->delete();

        return back()->with(
            'success',
            'Exam deleted successfully.'
        );
    }
}