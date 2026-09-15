<?php

namespace App\Http\Controllers\Professor;

use App\Http\Controllers\Controller;
use App\Models\ClassGroup;
use App\Models\Material;
use App\Models\Resource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;

class MaterialController extends Controller
{
    /**
     * Show create material form.
     */
    public function create(ClassGroup $classGroup)
    {
        Gate::authorize('manage', $classGroup);

        $topics = $classGroup->topics()->latest()->get();

        return view(
            'professor.class_groups.classroom_group.classworks.materials.create',
            compact('classGroup', 'topics')
        );
    }


    /**
     * Store material.
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

            'files' => 'required|array|max:10',
            'files.*' => 'required|file|max:102400',
        ]);

        /*
        |--------------------------------------------------------------------------
        | Create material
        |--------------------------------------------------------------------------
        */

        $material = new Material();

        $material->class_group_id = $classGroup->id;
        $material->user_id = Auth::id();
        $material->topic_id = $validated['topic_id'] ?? null;
        $material->title = $validated['title'];
        $material->description = $validated['description'] ?? null;

        $material->save();


        /*
        |--------------------------------------------------------------------------
        | Store multiple resources
        |--------------------------------------------------------------------------
        */

        foreach ($request->file('files') as $file) {

            $filePath = $file->store(
                'resources',
                'public'
            );

            $material->resources()->create([
                'title' => $file->getClientOriginalName(),
                'type' => 'file',
                'file_path' => $filePath,
                'file_name' => $file->getClientOriginalName(),
                'mime_type' => $file->getMimeType(),
                'file_size' => $file->getSize(),
                'url' => null,
            ]);
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
     * Show material detail.
     */
    public function show(
        Request $request,
        ClassGroup $classGroup,
        Material $material
    ) {
        Gate::authorize('manage', $classGroup);

        if ($material->class_group_id !== $classGroup->id) {
            abort(404);
        }

        $material->load([
            'user',
            'topic',
            'resources',
        ]);

        $returnTo = $request->query(
            'return_to',
            'stream'
        );

        return view(
            'professor.class_groups.classroom_group.classworks.materials.show',
            compact(
                'classGroup',
                'material',
                'returnTo'
            )
        );
    }


    /**
     * Show edit material form.
     */
    public function edit(
        Request $request,
        ClassGroup $classGroup,
        Material $material
    ) {
        Gate::authorize('manage', $classGroup);

        if ($material->class_group_id !== $classGroup->id) {
            abort(404);
        }

        $material->load([
            'resources',
            'topic',
        ]);

       $returnTo = $request->query(
    'return_to',
    'stream'
);

$origin = $request->query(
    'origin',
    'stream'
);

return view(
    'professor.class_groups.classroom_group.classworks.materials.edit',
    compact(
        'classGroup',
        'material',
        'returnTo',
        'origin'
    )

        );
    }

/**
 * Update material.
 *
 * Existing resources remain.
 * New files are added as additional resources.
 */
public function update(
    Request $request,
    ClassGroup $classGroup,
    Material $material
) {
    Gate::authorize('manage', $classGroup);

    /*
    |--------------------------------------------------------------------------
    | Make sure material belongs to this class group
    |--------------------------------------------------------------------------
    */
    if ($material->class_group_id !== $classGroup->id) {
        abort(404);
    }

    /*
    |--------------------------------------------------------------------------
    | Validate material
    |--------------------------------------------------------------------------
    */
    $validated = $request->validate([
        'title' => 'required|string|max:255',
        'description' => 'nullable|string',

        'files' => 'nullable|array|max:10',
        'files.*' => 'file|max:102400',
    ]);

    /*
    |--------------------------------------------------------------------------
    | Update material information
    |--------------------------------------------------------------------------
    */
    $material->title = $validated['title'];

    $material->description =
        $validated['description'] ?? null;

    $material->save();

    /*
    |--------------------------------------------------------------------------
    | Add new resources
    |--------------------------------------------------------------------------
    */
    if ($request->hasFile('files')) {

        foreach ($request->file('files') as $file) {

            $filePath = $file->store(
                'resources',
                'public'
            );

            $material->resources()->create([
                'title' => $file->getClientOriginalName(),
                'type' => 'file',
                'file_path' => $filePath,
                'file_name' => $file->getClientOriginalName(),
                'mime_type' => $file->getMimeType(),
                'file_size' => $file->getSize(),
                'url' => null,
            ]);
        }
    }

    /*
    |--------------------------------------------------------------------------
    | Return to correct page
    |--------------------------------------------------------------------------
    */

// Edit was opened from Material Show page
if ($request->input('return_to') === 'show') {

    return redirect()
        ->route(
            'professor.class-groups.materials.show',
            [
                'classGroup' => $classGroup,
                'material' => $material,
                'return_to' => $request->input(
                    'origin',
                    'stream'
                ),
            ]
        )
        ->with(
            'success',
            'Material updated successfully.'
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
                'Material updated successfully.'
            );
    }

    // Default: return to Stream
    return redirect()
        ->route(
            'professor.class-groups.classroom-group',
            $classGroup
        )
        ->with(
            'success',
            'Material updated successfully.'
        );
}

    /**
     * Download one resource.
     */
    public function downloadResource(
        ClassGroup $classGroup,
        Material $material,
        Resource $resource
    ) {
        Gate::authorize('manage', $classGroup);

        /*
        |--------------------------------------------------------------------------
        | Make sure material belongs to this class
        |--------------------------------------------------------------------------
        */

        if ($material->class_group_id !== $classGroup->id) {
            abort(404);
        }

        /*
        |--------------------------------------------------------------------------
        | Make sure resource belongs to material
        |--------------------------------------------------------------------------
        */

        if (
            $resource->resourceable_type !== Material::class ||
            $resource->resourceable_id !== $material->id
        ) {
            abort(404);
        }

        /*
        |--------------------------------------------------------------------------
        | Make sure file exists
        |--------------------------------------------------------------------------
        */

        if (
            !$resource->file_path ||
            !Storage::disk('public')
                ->exists($resource->file_path)
        ) {
            abort(404, 'Resource file not found.');
        }

        /*
        |--------------------------------------------------------------------------
        | Download
        |--------------------------------------------------------------------------
        */

        $filePath = Storage::disk('public')
            ->path($resource->file_path);

        return response()->download(
            $filePath,
            $resource->file_name
        );
    }


    /**
     * Delete a single resource from a material.
     */
    public function destroyResource(
        ClassGroup $classGroup,
        Material $material,
        Resource $resource
    ) {
        Gate::authorize('manage', $classGroup);

        /*
    |--------------------------------------------------------------------------
    | Make sure material belongs to this class group
    |--------------------------------------------------------------------------
    */

        if ($material->class_group_id !== $classGroup->id) {
            abort(404);
        }

        /*
    |--------------------------------------------------------------------------
    | Make sure this resource belongs to this material
    |--------------------------------------------------------------------------
    */

        $resource = $material->resources()
            ->whereKey($resource->id)
            ->firstOrFail();

        /*
    |--------------------------------------------------------------------------
    | Delete physical file
    |--------------------------------------------------------------------------
    */

        if (
            $resource->file_path &&
            Storage::disk('public')->exists($resource->file_path)
        ) {
            Storage::disk('public')
                ->delete($resource->file_path);
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
     * Delete material.
     *
     * Also removes all attached resources.
     */
    public function destroy(
        Request $request,
        ClassGroup $classGroup,
        Material $material
    ) {
        Gate::authorize('manage', $classGroup);

        if ($material->class_group_id !== $classGroup->id) {
            abort(404);
        }

        $returnTo = $request->input(
            'return_to',
            'stream'
        );

        $material->load('resources');

        foreach ($material->resources as $resource) {
            if (
                $resource->file_path &&
                Storage::disk('public')
                ->exists($resource->file_path)
            ) {
                Storage::disk('public')
                    ->delete($resource->file_path);
            }
        }

        $material->resources()->delete();
        $material->delete();

        if ($returnTo === 'classwork') {
            return redirect()
                ->route(
                    'professor.class-groups.classroom-group.classwork',
                    $classGroup
                )
                ->with(
                    'success',
                    'Material deleted successfully.'
                );
        }

        return redirect()
            ->route(
                'professor.class-groups.classroom-group',
                $classGroup
            )
            ->with(
                'success',
                'Material deleted successfully.'
            );
    }

    
}
