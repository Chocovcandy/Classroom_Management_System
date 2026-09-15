<?php

namespace App\Http\Controllers\Professor;

use App\Http\Controllers\Controller;
use App\Models\ClassGroup;
use App\Models\Quiz;
use App\Models\Resource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;

class QuizController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Create
    |--------------------------------------------------------------------------
    */

    public function create(ClassGroup $classGroup)
    {
        Gate::authorize('manage', $classGroup);

        $topics = $classGroup->topics()
            ->orderBy('topic_name')
            ->get();

        return view(
            'professor.class_groups.classroom_group.classworks.quizzes.create',
            compact('classGroup', 'topics')
        );
    }

    /*
    |--------------------------------------------------------------------------
    | Store
    |--------------------------------------------------------------------------
    */

    public function store(Request $request, ClassGroup $classGroup)
    {
        Gate::authorize('manage', $classGroup);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'due_date' => 'nullable|date',
            'due_time' => 'nullable',
            'points' => 'nullable|numeric|min:0',
            'topic_id' => 'nullable|exists:topics,id',

            // Google Form
            'google_form_url' => 'nullable|url|max:2048',

            // Multiple files
            'attachments' => 'nullable|array',
            'attachments.*' => 'file|max:102400',
        ]);

        /*
        |--------------------------------------------------------------------------
        | Create Quiz
        |--------------------------------------------------------------------------
        */

        $quiz = new Quiz();

        $quiz->class_group_id = $classGroup->id;
        $quiz->user_id = Auth::id();
        $quiz->topic_id = $validated['topic_id'] ?? null;
        $quiz->title = $validated['title'];
        $quiz->description = $validated['description'] ?? null;
        $quiz->due_date = $validated['due_date'] ?? null;
        $quiz->due_time = $validated['due_time'] ?? null;
        $quiz->points = $validated['points'] ?? 0;
        $quiz->google_form_url = $validated['google_form_url'] ?? null;

        $quiz->save();

        /*
        |--------------------------------------------------------------------------
        | Store Multiple Files as Resources
        |--------------------------------------------------------------------------
        */

        if ($request->hasFile('attachments')) {

            foreach ($request->file('attachments') as $file) {

                $path = $file->store('quizzes', 'public');

                $quiz->resources()->create([
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

        return redirect()
            ->route(
                'professor.class-groups.classroom-group.classwork',
                $classGroup
            )
            ->with('success', 'Quiz created successfully.');
    }

    /*
    |--------------------------------------------------------------------------
    | Show
    |--------------------------------------------------------------------------
    */

    public function show(
        Request $request,
        ClassGroup $classGroup,
        Quiz $quiz
    ) {
        Gate::authorize('manage', $classGroup);

        if ($quiz->class_group_id !== $classGroup->id) {
            abort(404);
        }

            $quiz->load([
            'user',
            'topic',
            'resources',
            'submissions' => function ($query) {
                $query
                    ->whereNotNull('submitted_at')
                    ->with(['student', 'resources'])
                    ->orderByDesc('submitted_at');
            },
        ]);

        $returnTo = $request->query('return_to', 'stream');

        return view(
            'professor.class_groups.classroom_group.classworks.quizzes.show',
            compact('classGroup', 'quiz', 'returnTo')
        );
    }

    /*
    |--------------------------------------------------------------------------
    | Edit
    |--------------------------------------------------------------------------
    */

    public function edit(
        Request $request,
        ClassGroup $classGroup,
        Quiz $quiz
    ) {
        Gate::authorize('manage', $classGroup);

        if ($quiz->class_group_id !== $classGroup->id) {
            abort(404);
        }

        $quiz->load([
            'topic',
            'resources',
        ]);

        $topics = $classGroup->topics()
            ->orderBy('topic_name')
            ->get();

        $returnTo = $request->query(
            'return_to',
            'stream'
        );

        $origin = $request->query(
            'origin',
            'stream'
        );

        return view(
            'professor.class_groups.classroom_group.classworks.quizzes.edit',
            compact(
                'classGroup',
                'quiz',
                'topics',
                'returnTo',
                'origin'
            )
        );
    }

    /*
    |--------------------------------------------------------------------------
    | Update
    |--------------------------------------------------------------------------
    */

    public function update(
        Request $request,
        ClassGroup $classGroup,
        Quiz $quiz
    ) {
        Gate::authorize('manage', $classGroup);

        if ($quiz->class_group_id !== $classGroup->id) {
            abort(404);
        }

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'due_date' => 'nullable|date',
            'due_time' => 'nullable',
            'points' => 'nullable|numeric|min:0',
            'topic_id' => 'nullable|exists:topics,id',

            // Google Form
            'google_form_url' => 'nullable|url|max:2048',

            // New multiple files
            'files' => 'nullable|array',
            'files.*' => 'file|max:102400',

            // Existing resources to delete
            'remove_resources' => 'nullable|array',
            'remove_resources.*' => 'integer|exists:resources,id',
        ]);

        /*
        |--------------------------------------------------------------------------
        | Update Quiz Information
        |--------------------------------------------------------------------------
        */

        $quiz->topic_id = $validated['topic_id'] ?? null;
        $quiz->title = $validated['title'];
        $quiz->description = $validated['description'] ?? null;
        $quiz->due_date = $validated['due_date'] ?? null;
        $quiz->due_time = $validated['due_time'] ?? null;
        $quiz->points = $validated['points'] ?? 0;
        $quiz->google_form_url = $validated['google_form_url'] ?? null;

        $quiz->save();

        /*
        |--------------------------------------------------------------------------
        | Remove Existing Resources
        |--------------------------------------------------------------------------
        */

        $removeResources = $request->input(
            'remove_resources',
            []
        );

        if (!empty($removeResources)) {

            $resources = $quiz->resources()
                ->whereIn('id', $removeResources)
                ->get();

            foreach ($resources as $resource) {

                if (
                    $resource->file_path &&
                    Storage::disk('public')->exists($resource->file_path)
                ) {
                    Storage::disk('public')->delete(
                        $resource->file_path
                    );
                }

                $resource->delete();
            }
        }

        /*
        |--------------------------------------------------------------------------
        | Add New Resources
        |--------------------------------------------------------------------------
        */

        if ($request->hasFile('files')) {

            foreach ($request->file('files') as $file) {

                $path = $file->store('quizzes', 'public');

                $quiz->resources()->create([
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

        /*
        |--------------------------------------------------------------------------
        | Redirect Based on Where Edit Was Opened
        |--------------------------------------------------------------------------
        */

        // Edit was opened from Quiz Show
        if ($request->input('return_to') === 'show') {

            return redirect()
                ->route(
                    'professor.class-groups.quizzes.show',
                    [
                        'classGroup' => $classGroup,
                        'quiz' => $quiz,
                        'return_to' => $request->input(
                            'origin',
                            'stream'
                        ),
                    ]
                )
                ->with(
                    'success',
                    'Quiz updated successfully.'
                );
        }

        // Edit was opened from Marks
        if ($request->input('return_to') === 'marks') {
            return redirect()
                ->route(
                    'professor.class-groups.marks',
                    $classGroup
                )
                ->with(
                    'success',
                    'Quiz updated successfully.'
                );
        }

        // Edit was opened from Classwork
        if ($request->input('return_to') === 'classwork') {

            return redirect()
                ->route(
                    'professor.class-groups.classroom-group.classwork',
                    $classGroup
                )
                ->with(
                    'success',
                    'Quiz updated successfully.'
                );
        }

        // Default: Stream
        return redirect()
            ->route(
                'professor.class-groups.classroom-group',
                $classGroup
            )
            ->with(
                'success',
                'Quiz updated successfully.'
            );
    }

    /*
    |--------------------------------------------------------------------------
    | Delete Resource
    |--------------------------------------------------------------------------
    */

    public function destroyResource(
        ClassGroup $classGroup,
        Quiz $quiz,
        Resource $resource
    ) {
        Gate::authorize('manage', $classGroup);

        if ($quiz->class_group_id !== $classGroup->id) {
            abort(404);
        }

        $resource = $quiz->resources()
            ->whereKey($resource->id)
            ->firstOrFail();

        if (
            $resource->file_path &&
            Storage::disk('public')->exists($resource->file_path)
        ) {
            Storage::disk('public')->delete(
                $resource->file_path
            );
        }

        $resource->delete();

        return back()->with(
            'success',
            'File deleted successfully.'
        );
    }

    /*
    |--------------------------------------------------------------------------
    | Destroy Quiz
    |--------------------------------------------------------------------------
    */

public function destroy(
    Request $request,
    int $classGroupId,
    int $quizId
) {
    $classGroup = ClassGroup::findOrFail(
        $classGroupId
    );

    Gate::authorize(
        'manage',
        $classGroup
    );

    $quiz = Quiz::with('resources')
        ->where('id', $quizId)
        ->where(
            'class_group_id',
            $classGroup->id
        )
        ->firstOrFail();

    /*
    |--------------------------------------------------------------------------
    | Remember where the user came from
    |--------------------------------------------------------------------------
    */

    $returnTo = $request->input(
        'return_to',
        'stream'
    );

    /*
    |--------------------------------------------------------------------------
    | Delete quiz resources
    |--------------------------------------------------------------------------
    */

    foreach (
        $quiz->resources
        as $resource
    ) {

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
    | Delete quiz
    |--------------------------------------------------------------------------
    */

    $quiz->delete();

    /*
    |--------------------------------------------------------------------------
    | Return to Classwork
    |--------------------------------------------------------------------------
    */

    if ($returnTo === 'classwork') {

        return redirect()
            ->route(
                'professor.class-groups.classroom-group.classwork',
                $classGroup
            )
            ->with(
                'success',
                'Quiz deleted successfully.'
            );
    }

    /*
    |--------------------------------------------------------------------------
    | Return to Marks
    |--------------------------------------------------------------------------
    */

    if ($returnTo === 'marks') {

        return redirect()
            ->route(
                'professor.class-groups.marks',
                $classGroup
            )
            ->with(
                'success',
                'Quiz deleted successfully.'
            );
    }

    /*
    |--------------------------------------------------------------------------
    | Return to Stream
    |--------------------------------------------------------------------------
    */

    return redirect()
        ->route(
            'professor.class-groups.classroom-group',
            $classGroup
        )
        ->with(
            'success',
            'Quiz deleted successfully.'
        );
}
}