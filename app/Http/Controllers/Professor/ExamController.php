<?php

namespace App\Http\Controllers\Professor;

use App\Http\Controllers\Controller;
use App\Models\ClassGroup;
use App\Models\Exam;
use App\Models\Resource;
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

        $topics = $classGroup->topics()
            ->orderBy('topic_name')
            ->get();

        return view(
            'professor.class_groups.classroom_group.classworks.exams.create',
            compact('classGroup', 'topics')
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
                'nullable',
                'date',
            ],

            'due_time' => [
                'nullable',
                'date_format:H:i',
            ],

            'points' => [
                'nullable',
                'numeric',
                'min:0',
            ],

            /*
            |--------------------------------------------------------------------------
            | Multiple exam files
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
        | Create exam
        |--------------------------------------------------------------------------
        */

        $exam = Exam::create([

            'class_group_id' => $classGroup->id,

            'topic_id' => $topic?->id,

            'user_id' => Auth::id(),

            'title' => $validated['title'],

            'description' =>
                $validated['description'] ?? null,

            'google_form_url' =>
                $validated['google_form_url'] ?? null,

            'due_date' =>
                $validated['due_date'] ?? null,

            'due_time' =>
                $validated['due_time'] ?? null,

            'points' =>
                $validated['points'] ?? null,
        ]);


        /*
        |--------------------------------------------------------------------------
        | Upload exam resources
        |--------------------------------------------------------------------------
        */

        if ($request->hasFile('attachments')) {

            foreach (
                $request->file('attachments')
                as $file
            ) {

                $path = $file->store(
                    'exams',
                    'public'
                );


                $exam->resources()->create([

                    'title' =>
                        $file->getClientOriginalName(),

                    'type' =>
                        'file',

                    'file_path' =>
                        $path,

                    'file_name' =>
                        $file->getClientOriginalName(),

                    'mime_type' =>
                        $file->getClientMimeType(),

                    'file_size' =>
                        $file->getSize(),

                    'url' =>
                        null,
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
                'Exam created successfully.'
            );
    }


    /**
     * Show exam detail.
     */
    public function show(
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

        if (
            $exam->class_group_id
            !== $classGroup->id
        ) {
            abort(404);
        }


        /*
        |--------------------------------------------------------------------------
        | Load relationships
        |--------------------------------------------------------------------------
        */

        $exam->load([
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


        /*
        |--------------------------------------------------------------------------
        | Remember where user came from
        |--------------------------------------------------------------------------
        */

        $returnTo = $request->query(
            'return_to',
            'stream'
        );


        return view(
            'professor.class_groups.classroom_group.classworks.exams.show',
            compact(
                'classGroup',
                'exam',
                'returnTo'
            )
        );
    }


    /**
     * Show edit exam form.
     */
    public function edit(
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

        if (
            $exam->class_group_id
            !== $classGroup->id
        ) {
            abort(404);
        }


        /*
        |--------------------------------------------------------------------------
        | Load relationships
        |--------------------------------------------------------------------------
        */

        $exam->load([
            'topic',
            'resources',
        ]);


        /*
        |--------------------------------------------------------------------------
        | Load topics
        |--------------------------------------------------------------------------
        */

        $topics = $classGroup->topics()
            ->orderBy('topic_name')
            ->get();


        /*
        |--------------------------------------------------------------------------
        | Determine where user came from
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
            'professor.class_groups.classroom_group.classworks.exams.edit',
            compact(
                'classGroup',
                'exam',
                'topics',
                'returnTo',
                'origin'
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

        if (
            $exam->class_group_id
            !== $classGroup->id
        ) {
            abort(404);
        }


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
                'nullable',
                'date',
            ],

            'due_time' => [
                'nullable',
                'date_format:H:i',
            ],

            'points' => [
                'nullable',
                'numeric',
                'min:0',
            ],

            /*
            |--------------------------------------------------------------------------
            | New files
            |--------------------------------------------------------------------------
            */

            'files' => [
                'nullable',
                'array',
                'max:10',
            ],

            'files.*' => [
                'file',
                'max:102400',
            ],

            /*
            |--------------------------------------------------------------------------
            | Existing resources to remove
            |--------------------------------------------------------------------------
            */

            'remove_resources' => [
                'nullable',
                'array',
            ],

            'remove_resources.*' => [
                'integer',
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

            $resources = $exam->resources()
                ->whereIn(
                    'id',
                    $validated['remove_resources']
                )
                ->get();


            foreach ($resources as $resource) {

                /*
                | Delete physical file
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
                | Delete database record
                */

                $resource->delete();
            }
        }


        /*
        |--------------------------------------------------------------------------
        | Add new resources
        |--------------------------------------------------------------------------
        */

        if ($request->hasFile('files')) {

            foreach (
                $request->file('files')
                as $file
            ) {

                $path = $file->store(
                    'exams',
                    'public'
                );


                $exam->resources()->create([

                    'title' =>
                        $file->getClientOriginalName(),

                    'type' =>
                        'file',

                    'file_path' =>
                        $path,

                    'file_name' =>
                        $file->getClientOriginalName(),

                    'mime_type' =>
                        $file->getClientMimeType(),

                    'file_size' =>
                        $file->getSize(),

                    'url' =>
                        null,
                ]);
            }
        }


        /*
        |--------------------------------------------------------------------------
        | Update exam information
        |--------------------------------------------------------------------------
        */

        $exam->topic_id =
            $topic?->id;

        $exam->title =
            $validated['title'];

        $exam->description =
            $validated['description'] ?? null;

        $exam->google_form_url =
            $validated['google_form_url'] ?? null;

        $exam->due_date =
            $validated['due_date'] ?? null;

        $exam->due_time =
            $validated['due_time'] ?? null;

        $exam->points =
            $validated['points'] ?? null;


        $exam->save();


        /*
        |--------------------------------------------------------------------------
        | Return to correct page
        |--------------------------------------------------------------------------
        */

        // Edit was opened from Exam Show
        if (
            $request->input('return_to')
            === 'show'
        ) {

            return redirect()
                ->route(
                    'professor.class-groups.exams.show',
                    [
                        'classGroup' => $classGroup,

                        'exam' => $exam,

                        'return_to' =>
                            $request->input(
                                'origin',
                                'stream'
                            ),
                    ]
                )
                ->with(
                    'success',
                    'Exam updated successfully.'
                );
        }


        // Edit was opened from Classwork
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
                    'Exam updated successfully.'
                );
        }


        // Edit was opened from Marks
        if (
            $request->input('return_to')
            === 'marks'
        ) {

            return redirect()
                ->route(
                    'professor.class-groups.marks',
                    $classGroup
                )
                ->with(
                    'success',
                    'Exam updated successfully.'
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
                'Exam updated successfully.'
            );
    }


    /**
     * Delete one resource attached to the exam.
     */
    public function destroyResource(
        ClassGroup $classGroup,
        Exam $exam,
        Resource $resource
    ) {
        Gate::authorize(
            'manage',
            $classGroup
        );


        /*
        |--------------------------------------------------------------------------
        | Make sure exam belongs to this class group
        |--------------------------------------------------------------------------
        */

        if (
            $exam->class_group_id
            !== $classGroup->id
        ) {
            abort(404);
        }


        /*
        |--------------------------------------------------------------------------
        | Make sure resource belongs to this exam
        |--------------------------------------------------------------------------
        */

        $resource = $exam->resources()
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
        | Delete resource database record
        |--------------------------------------------------------------------------
        */

        $resource->delete();


        return back()->with(
            'success',
            'File deleted successfully.'
        );
    }


    /**
     * Delete exam.
     */
    public function destroy(
        Request $request,
        ClassGroup $classGroup,
        Exam $exam
    ) {
        Gate::authorize(
            'manage',
            $classGroup
        );


        /*
        |--------------------------------------------------------------------------
        | Make sure exam belongs to this class group
        |--------------------------------------------------------------------------
        */

        if (
            $exam->class_group_id
            !== $classGroup->id
        ) {
            abort(404);
        }


        /*
        |--------------------------------------------------------------------------
        | Remember where user came from
        |--------------------------------------------------------------------------
        */

        $returnTo = $request->input(
            'return_to',
            'stream'
        );


        /*
        |--------------------------------------------------------------------------
        | Delete Resource files
        |--------------------------------------------------------------------------
        */

        foreach (
            $exam->resources
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
        | Delete exam
        |--------------------------------------------------------------------------
        */

        $exam->delete();


        /*
        |--------------------------------------------------------------------------
        | Return to Classwork
        |--------------------------------------------------------------------------
        */

        if (
            $returnTo === 'classwork'
        ) {

            return redirect()
                ->route(
                    'professor.class-groups.classroom-group.classwork',
                    $classGroup
                )
                ->with(
                    'success',
                    'Exam deleted successfully.'
                );
        }


        /*
        |--------------------------------------------------------------------------
        | Return to Marks
        |--------------------------------------------------------------------------
        */

        if (
            $returnTo === 'marks'
        ) {

            return redirect()
                ->route(
                    'professor.class-groups.marks',
                    $classGroup
                )
                ->with(
                    'success',
                    'Exam deleted successfully.'
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
                'Exam deleted successfully.'
            );
    }
}