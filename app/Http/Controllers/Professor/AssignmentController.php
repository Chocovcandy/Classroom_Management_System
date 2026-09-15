<?php

namespace App\Http\Controllers\Professor;

use App\Http\Controllers\Controller;
use App\Models\Assignment;
use App\Models\AssignmentSubmission;
use App\Models\ClassGroup;
use App\Models\Resource;
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
                'nullable',
                'integer',
            ],

            'title' => [
                'required',
                'string',
                'max:255',
            ],

            'description' => [
                'nullable',
                'string',
            ],

            'google_form_url' => [
                'nullable',
                'url',
                'max:2048',
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

            /*
            |--------------------------------------------------------------------------
            | Multiple assignment files
            |--------------------------------------------------------------------------
            |
            | Maximum:
            | - 100 MB per file
            | - Total request size is controlled by PHP
            |
            */

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
        | Verify topic belongs to this class group
        |--------------------------------------------------------------------------
        */

        $topic = null;

        if (!empty($validated['topic_id'])) {

            $topic = $classGroup->topics()
                ->where('id', $validated['topic_id'])
                ->firstOrFail();
        }


        /*
        |--------------------------------------------------------------------------
        | Create assignment
        |--------------------------------------------------------------------------
        */

        $assignment = Assignment::create([

            'class_group_id' => $classGroup->id,

            'topic_id' => $topic?->id,

            'user_id' => Auth::id(),

            'title' => $validated['title'],

            'description' => $validated['description'] ?? null,

            'google_form_url' => $validated['google_form_url'] ?? null,

            'due_date' => $validated['due_date'],

            'due_time' => $validated['due_time'] ?? null,

            'points' => $validated['points'] ?? 100,

        ]);


        /*
        |--------------------------------------------------------------------------
        | Upload assignment resources
        |--------------------------------------------------------------------------
        */

        if ($request->hasFile('attachments')) {

            foreach ($request->file('attachments') as $file) {

                $path = $file->store(
                    'assignments',
                    'public'
                );


                $assignment->resources()->create([

                    'title' =>
                        $file->getClientOriginalName(),

                    'type' => 'file',

                    'file_path' => $path,

                    'file_name' =>
                        $file->getClientOriginalName(),

                    'mime_type' =>
                        $file->getClientMimeType(),

                    'file_size' =>
                        $file->getSize(),

                    'url' => null,

                ]);
            }
        }


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
        Request $request,
        int $classGroupId,
        int $assignmentId
    ) {
        $classGroup = ClassGroup::with('students')
            ->findOrFail($classGroupId);

        Gate::authorize('manage', $classGroup);


        $assignment = Assignment::with([

            'user',

            'topic',

            'resources',

            'submissions' => function ($query) {

                $query
                    ->whereNotNull('submitted_at')
                    ->with([
                        'student',
                        'resources',
                    ])
                    ->orderByDesc('submitted_at');
            },

        ])
            ->where('id', $assignmentId)
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

        $returnTo = $request->query(
            'return_to',
            'stream'
        );


        return view(
            'professor.class_groups.classroom_group.classworks.assignments.show',
            compact(
                'classGroup',
                'assignment',
                'returnTo'
            )
        );
    }


    /**
     * Show edit assignment form.
     */
    public function edit(
        Request $request,
        int $classGroupId,
        int $assignmentId
    ) {
        $classGroup = ClassGroup::findOrFail($classGroupId);

        Gate::authorize('manage', $classGroup);


        $assignment = Assignment::with('resources')
            ->where('id', $assignmentId)
            ->where(
                'class_group_id',
                $classGroup->id
            )
            ->firstOrFail();


        /*
        |--------------------------------------------------------------------------
        | Determine where the user came from
        |--------------------------------------------------------------------------
        */

        $returnTo = $request->query(
            'return_to',
            'stream'
        );

        $origin = $request->query(
            'origin',
            'stream'
        );


        return view(
            'professor.class_groups.classroom_group.classworks.assignments.edit',
            compact(
                'classGroup',
                'assignment',
                'returnTo',
                'origin'
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


        $assignment = Assignment::with('resources')
            ->where('id', $assignmentId)
            ->where(
                'class_group_id',
                $classGroup->id
            )
            ->firstOrFail();


        /*
        |--------------------------------------------------------------------------
        | Validate request
        |--------------------------------------------------------------------------
        */

        $validated = $request->validate([

            'topic_id' => [
                'nullable',
                'integer',
            ],

            'title' => [
                'required',
                'string',
                'max:255',
            ],

            'description' => [
                'nullable',
                'string',
            ],

            'google_form_url' => [
                'nullable',
                'url',
                'max:2048',
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

            /*
            |--------------------------------------------------------------------------
            | Existing resources selected for removal
            |--------------------------------------------------------------------------
            */

            'remove_resources' => [
                'nullable',
                'array',
            ],

            'remove_resources.*' => [
                'integer',
            ],

            /*
            |--------------------------------------------------------------------------
            | New assignment files
            |--------------------------------------------------------------------------
            */

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
        | Verify topic belongs to this class group
        |--------------------------------------------------------------------------
        */

        $topic = null;

        if (!empty($validated['topic_id'])) {

            $topic = $classGroup->topics()
                ->where('id', $validated['topic_id'])
                ->firstOrFail();
        }


        /*
        |--------------------------------------------------------------------------
        | Remove selected existing resources
        |--------------------------------------------------------------------------
        */

        if (!empty($validated['remove_resources'])) {

            $resources = $assignment->resources()
                ->whereIn(
                    'id',
                    $validated['remove_resources']
                )
                ->get();


            foreach ($resources as $resource) {

                /*
                |--------------------------------------------------------------------------
                | Delete physical file
                |--------------------------------------------------------------------------
                */

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


                /*
                |--------------------------------------------------------------------------
                | Delete database record
                |--------------------------------------------------------------------------
                */

                $resource->delete();
            }
        }


        /*
        |--------------------------------------------------------------------------
        | Add new resources
        |--------------------------------------------------------------------------
        */

        if ($request->hasFile('attachments')) {

            foreach (
                $request->file('attachments')
                as $file
            ) {

                $path = $file->store(
                    'assignments',
                    'public'
                );


                $assignment->resources()->create([

                    'title' =>
                        $file->getClientOriginalName(),

                    'type' => 'file',

                    'file_path' => $path,

                    'file_name' =>
                        $file->getClientOriginalName(),

                    'mime_type' =>
                        $file->getClientMimeType(),

                    'file_size' =>
                        $file->getSize(),

                    'url' => null,

                ]);
            }
        }


        /*
        |--------------------------------------------------------------------------
        | Update assignment information
        |--------------------------------------------------------------------------
        */

        $assignment->topic_id =
            $topic?->id;

        $assignment->title =
            $validated['title'];

        $assignment->description =
            $validated['description'] ?? null;

        $assignment->google_form_url =
            $validated['google_form_url'] ?? null;

        $assignment->due_date =
            $validated['due_date'];

        $assignment->due_time =
            $validated['due_time'] ?? null;

        $assignment->points =
            $validated['points'] ?? 100;


        $assignment->save();


        /*
        |--------------------------------------------------------------------------
        | Return to correct page
        |--------------------------------------------------------------------------
        */

        /*
        |--------------------------------------------------------------------------
        | Edit was opened from Assignment Show
        |--------------------------------------------------------------------------
        */

        if ($request->input('return_to') === 'show') {

            return redirect()
                ->route(
                    'professor.class-groups.assignments.show',
                    [
                        'classGroup' => $classGroup,

                        'assignment' => $assignment,

                        'return_to' =>
                            $request->input(
                                'origin',
                                'stream'
                            ),
                    ]
                )
                ->with(
                    'success',
                    'Assignment updated successfully.'
                );
        }


        /*
        |--------------------------------------------------------------------------
        | Edit was opened from Marks
        |--------------------------------------------------------------------------
        */

        if ($request->input('return_to') === 'marks') {

            return redirect()
                ->route(
                    'professor.class-groups.marks',
                    $classGroup
                )
                ->with(
                    'success',
                    'Assignment updated successfully.'
                );
        }


        /*
        |--------------------------------------------------------------------------
        | Edit was opened from Classwork
        |--------------------------------------------------------------------------
        */

        if (
            $request->input('return_to')
            === 'classwork'
        ) {

            return redirect()
                ->route(
                    'professor.class-groups.classroom-group.classwork',
                    $classGroup
                )
                ->with(
                    'success',
                    'Assignment updated successfully.'
                );
        }


        /*
        |--------------------------------------------------------------------------
        | Default: Stream
        |--------------------------------------------------------------------------
        */

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
     * Delete a single assignment resource.
     */
    public function destroyResource(
        ClassGroup $classGroup,
        Assignment $assignment,
        Resource $resource
    ) {
        Gate::authorize(
            'manage',
            $classGroup
        );


        /*
        |--------------------------------------------------------------------------
        | Make sure assignment belongs to this class group
        |--------------------------------------------------------------------------
        */

        if (
            $assignment->class_group_id
            !== $classGroup->id
        ) {
            abort(404);
        }


        /*
        |--------------------------------------------------------------------------
        | Make sure resource belongs to this assignment
        |--------------------------------------------------------------------------
        */

        $resource = $assignment->resources()
            ->whereKey($resource->id)
            ->firstOrFail();


        /*
        |--------------------------------------------------------------------------
        | Delete physical file
        |--------------------------------------------------------------------------
        */

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


        /*
        |--------------------------------------------------------------------------
        | Delete resource record
        |--------------------------------------------------------------------------
        */

        $resource->delete();


        return back()->with(
            'success',
            'File deleted successfully.'
        );
    }


    /**
     * Delete assignment.
     */
    public function destroy(
        Request $request,
        int $classGroupId,
        int $assignmentId
    ) {
        $classGroup = ClassGroup::findOrFail(
            $classGroupId
        );

        Gate::authorize(
            'manage',
            $classGroup
        );


        $assignment = Assignment::with('resources')
            ->where('id', $assignmentId)
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
        | Delete assignment resources
        |--------------------------------------------------------------------------
        */

        foreach (
            $assignment->resources
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
        | Delete assignment
        |--------------------------------------------------------------------------
        */

        $assignment->delete();


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
                    'Assignment deleted successfully.'
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
                    'Assignment deleted successfully.'
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
                'Assignment deleted successfully.'
            );
    }
}