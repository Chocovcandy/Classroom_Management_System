<?php

namespace App\Http\Controllers\Professor;

use App\Http\Controllers\Controller;
use App\Models\ClassGroup;
use App\Models\Quiz;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class QuizController extends Controller
{
    /**
     * Show create quiz form.
     */
    public function create(ClassGroup $classGroup)
    {
        Gate::authorize('manage', $classGroup);

        return view(
            'professor.class_groups.classroom_group.classworks.quizzes.create',
            compact('classGroup')
        );
    }

    /**
     * Store quiz.
     */
    public function store(
        Request $request,
        ClassGroup $classGroup
    ) {
        Gate::authorize('manage', $classGroup);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'due_date' => 'nullable|date',
            'due_time' => 'nullable',
            'points' => 'nullable|numeric|min:0',
            'topic_id' => 'nullable|exists:topics,id',
        ]);

        $quiz = new Quiz();

        $quiz->class_group_id = $classGroup->id;
        $quiz->user_id = Auth::id();
        $quiz->topic_id = $validated['topic_id'] ?? null;
        $quiz->title = $validated['title'];
        $quiz->description = $validated['description'] ?? null;
        $quiz->due_date = $validated['due_date'] ?? null;
        $quiz->due_time = $validated['due_time'] ?? null;
        $quiz->points = $validated['points'] ?? null;

        $quiz->save();

        return redirect()
            ->route(
                'professor.class-groups.classroom-group.classwork',
                $classGroup
            )
            ->with(
                'success',
                'Quiz created successfully.'
            );
    }


    /**
 * Show quiz detail.
 */
public function show(
    ClassGroup $classGroup,
    Quiz $quiz
) {
    Gate::authorize('manage', $classGroup);

    /*
    |--------------------------------------------------------------------------
    | Make sure quiz belongs to this class group
    |--------------------------------------------------------------------------
    */

    if ($quiz->class_group_id !== $classGroup->id) {
        abort(404);
    }

    $quiz->load([
        'user',
        'topic',
    ]);

    return view(
        'professor.class_groups.classroom_group.classworks.quizzes.show',
        compact(
            'classGroup',
            'quiz'
        )
    );
}


/**
 * Show edit quiz form.
 */
public function edit(
    ClassGroup $classGroup,
    Quiz $quiz
) {
    /*
    |--------------------------------------------------------------------------
    | Authorize quiz management
    |--------------------------------------------------------------------------
    */

    Gate::authorize('manage', $classGroup);

    /*
    |--------------------------------------------------------------------------
    | Make sure quiz belongs to this class group
    |--------------------------------------------------------------------------
    */

    if ($quiz->class_group_id !== $classGroup->id) {
        abort(404);
    }

    /*
    |--------------------------------------------------------------------------
    | Load relationships needed by edit form
    |--------------------------------------------------------------------------
    */

    $quiz->load([
        'topic',
    ]);

    /*
    |--------------------------------------------------------------------------
    | Return edit view
    |--------------------------------------------------------------------------
    */

    return view(
        'professor.class_groups.classroom_group.classworks.quizzes.edit',
        compact(
            'classGroup',
            'quiz'
        )
    );
}
}