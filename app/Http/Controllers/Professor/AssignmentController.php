<?php

namespace App\Http\Controllers\Professor;

use App\Http\Controllers\Controller;
use App\Models\Assignment;
use App\Models\ClassGroup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;

class AssignmentController extends Controller
{
    /**
     * Show create assignment form.
     */
public function create(int $classGroupId)
{
    $classGroup = ClassGroup::findOrFail($classGroupId);

    Gate::authorize('manage', $classGroup);

    return view(
        'professor.class_groups.classroom_group.classworks.assignments.create',
        compact('classGroup')
    );
}

    /**
     * Store assignment.
     */
/**
 * Store assignment.
 */
public function store(
    Request $request,
    int $classGroupId
) {
    $classGroup = ClassGroup::findOrFail($classGroupId);

    Gate::authorize('manage', $classGroup);


    /*
    |--------------------------------------------------------------------------
    | Validate request
    |--------------------------------------------------------------------------
    */

    $validated = $request->validate([

        'topic_id' => [
            'required',
            'integer',
        ],

        'title' => [
            'required',
            'string',
            'max:255',
        ],

        'description' => [
            'required',
            'string',
        ],

        'due_date' => [
            'required',
            'date',
        ],

        'due_time' => [
            'nullable',
            'date_format:H:i',
        ],

        'points' => [
            'nullable',
            'integer',
            'min:0',
        ],

        'attachment' => [
            'nullable',
            'file',
            'max:51200',
        ],

    ]);


    /*
    |--------------------------------------------------------------------------
    | Verify topic belongs to this class group
    |--------------------------------------------------------------------------
    */

    $topic = $classGroup->topics()
        ->where('id', $validated['topic_id'])
        ->firstOrFail();


    /*
    |--------------------------------------------------------------------------
    | Upload attachment
    |--------------------------------------------------------------------------
    */

    $attachmentPath = null;

    if ($request->hasFile('attachment')) {

        $attachmentPath = $request
            ->file('attachment')
            ->store('assignments', 'public');
    }


    /*
    |--------------------------------------------------------------------------
    | Create assignment
    |--------------------------------------------------------------------------
    */

    Assignment::create([

        'class_group_id' => $classGroup->id,

        'topic_id' => $topic->id,

        'user_id' => Auth::id(),

        'title' => $validated['title'],

        'description' => $validated['description'],

        'due_date' => $validated['due_date'],

        'due_time' => $validated['due_time'] ?? null,

        'points' => $validated['points'] ?? 100,

        'attachment' => $attachmentPath,

    ]);


    /*
    |--------------------------------------------------------------------------
    | Redirect to Classwork
    |--------------------------------------------------------------------------
    */

    return redirect()
        ->route(
            'professor.class-groups.classroom-group.classwork',
            $classGroup
        )
        ->with(
            'success',
            'Assignment created successfully.'
        );
}



/**
 * Show assignment detail.
 */
public function show(
    int $classGroupId,
    int $assignmentId
) {
    $classGroup = ClassGroup::findOrFail($classGroupId);

    Gate::authorize('manage', $classGroup);

    $assignment = Assignment::with([
        'user',
        'topic',
    ])
        ->where('id', $assignmentId)
        ->where('class_group_id', $classGroup->id)
        ->firstOrFail();

    return view(
        'professor.class_groups.classroom_group.classworks.assignments.show',
        compact(
            'classGroup',
            'assignment'
        )
    );
}
    /**
     * Show edit assignment form.
     */
    public function edit(
       int  $classGroupId,
       int $assignmentId
    ) {
        $classGroup = ClassGroup::findOrFail($classGroupId);

        Gate::authorize('manage', $classGroup);

        $assignment = Assignment::where('id', $assignmentId)
            ->where('class_group_id', $classGroup->id)
            ->firstOrFail();

        return view(
            'professor.class_groups.classroom_group.classworks.assignments.edit',
            compact(
                'classGroup',
                'assignment'
            )
        );
    }

    /**
     * Update assignment.
     */
    public function update(
        Request $request,
        int $classGroupId,
         int $assignmentId
    ) {
        $classGroup = ClassGroup::findOrFail($classGroupId);

        Gate::authorize('manage', $classGroup);

        $assignment = Assignment::where('id', $assignmentId)
            ->where('class_group_id', $classGroup->id)
            ->firstOrFail();

        $validated = $request->validate([
            'title' => [
                'required',
                'string',
                'max:255',
            ],

            'description' => [
                'required',
                'string',
            ],

            'due_date' => [
                'required',
                'date',
            ],

            'due_time' => [
                'nullable',
                'date_format:H:i',
            ],

            'points' => [
                'nullable',
                'integer',
                'min:0',
            ],

            'attachment' => [
                'nullable',
                'file',
                'max:51200',
            ],
        ]);

        /*
        |--------------------------------------------------------------------------
        | Replace attachment
        |--------------------------------------------------------------------------
        */

        if ($request->hasFile('attachment')) {

            if (
                $assignment->attachment &&
                Storage::disk('public')
                    ->exists($assignment->attachment)
            ) {
                Storage::disk('public')
                    ->delete($assignment->attachment);
            }

            $assignment->attachment = $request
                ->file('attachment')
                ->store(
                    'assignments',
                    'public'
                );
        }

        /*
        |--------------------------------------------------------------------------
        | Update assignment
        |--------------------------------------------------------------------------
        */

        $assignment->title =
            $validated['title'];

        $assignment->description =
            $validated['description'];

        $assignment->due_date =
            $validated['due_date'];

        $assignment->due_time =
            $validated['due_time'] ?? null;

        $assignment->points =
            $validated['points'] ?? 100;

        $assignment->save();

        return redirect()
            ->route(
                'professor.class-groups.classroom-group',
                $classGroup
            )
            ->with(
                'success',
                'Assignment updated successfully.'
            );
    }

    /**
     * Delete assignment.
     */
    public function destroy(
        int $classGroupId,
       int  $assignmentId
    ) {
        $classGroup = ClassGroup::findOrFail($classGroupId);

        Gate::authorize('manage', $classGroup);

        $assignment = Assignment::where('id', $assignmentId)
            ->where('class_group_id', $classGroup->id)
            ->firstOrFail();

        /*
        |--------------------------------------------------------------------------
        | Delete attachment
        |--------------------------------------------------------------------------
        */

        if (
            $assignment->attachment &&
            Storage::disk('public')
                ->exists($assignment->attachment)
        ) {
            Storage::disk('public')
                ->delete($assignment->attachment);
        }

        /*
        |--------------------------------------------------------------------------
        | Delete assignment
        |--------------------------------------------------------------------------
        */

        $assignment->delete();

        return redirect()
            ->route(
                'professor.class-groups.classroom-group',
                $classGroup
            )
            ->with(
                'success',
                'Assignment deleted successfully.'
            );
    }
}