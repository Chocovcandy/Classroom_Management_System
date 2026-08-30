<?php

namespace App\Http\Controllers\Professor;

use App\Http\Controllers\Controller;
use App\Models\ClassGroup;
use App\Models\Topic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class TopicController extends Controller
{
    /**
     * Show the create topic form.
     */
    public function create(ClassGroup $classGroup)
    {
        Gate::authorize('manage', $classGroup);

        return view(
            'professor.class_groups.classroom_group.classworks.topics.create',
            compact('classGroup')
        );
    }

    /**
     * Store a new topic.
     */
public function store(
    Request $request,
    ClassGroup $classGroup
) {
    Gate::authorize('manage', $classGroup);

    $validated = $request->validate([
        'topic_name' => [
            'required',
            'string',
            'max:255',
        ],

        'description' => [
            'nullable',
            'string',
            'max:1000',
        ],
    ]);

    $nextOrder = ($classGroup->topics()->max('order') ?? 0) + 1;

    $classGroup->topics()->create([
        'topic_name' => $validated['topic_name'],
        'description' => $validated['description'] ?? null,
        'order' => $nextOrder,
    ]);

    return redirect()
        ->route(
            'professor.class-groups.classroom-group.classwork',
            ['classGroup' => $classGroup->id]
        )
        ->with(
            'success',
            'Topic created successfully.'
        );
}


    /**
 * Show the edit topic form.
 */
public function edit(
    ClassGroup $classGroup,
    Topic $topic
) {
    Gate::authorize('manage', $classGroup);

    /*
    |--------------------------------------------------------------------------
    | Make sure topic belongs to this class group
    |--------------------------------------------------------------------------
    */

    if ($topic->class_group_id !== $classGroup->id) {
        abort(404);
    }

    return view(
        'professor.class_groups.classroom_group.classworks.topics.edit',
        compact(
            'classGroup',
            'topic'
        )
    );
}


/**
 * Update topic.
 */
public function update(
    Request $request,
    ClassGroup $classGroup,
    Topic $topic
) {
    Gate::authorize('manage', $classGroup);

    /*
    |--------------------------------------------------------------------------
    | Make sure topic belongs to this class group
    |--------------------------------------------------------------------------
    */

    if ($topic->class_group_id !== $classGroup->id) {
        abort(404);
    }

    $validated = $request->validate([
        'topic_name' => [
            'required',
            'string',
            'max:255',
        ],

        'description' => [
            'nullable',
            'string',
            'max:1000',
        ],
    ]);

    $topic->update([
        'topic_name' => $validated['topic_name'],
        'description' => $validated['description'] ?? null,
    ]);

    return redirect()
        ->route(
            'professor.class-groups.classroom-group.classwork',
            ['classGroup' => $classGroup->id]
        )
        ->with(
            'success',
            'Topic updated successfully.'
        );
}
}