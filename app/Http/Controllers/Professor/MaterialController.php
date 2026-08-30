<?php

namespace App\Http\Controllers\Professor;

use App\Http\Controllers\Controller;
use App\Models\ClassGroup;
use App\Models\Material;
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

        return view(
            'professor.class_groups.classroom_group.classworks.materials.create',
            compact('classGroup')
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
            'file' => 'required|file|max:51200',
        ]);

        /*
        |--------------------------------------------------------------------------
        | Store uploaded file
        |--------------------------------------------------------------------------
        */

        $filePath = $request
            ->file('file')
            ->store('materials', 'public');

        /*
        |--------------------------------------------------------------------------
        | Create material
        |--------------------------------------------------------------------------
        */

        $material = new Material();

        $material->class_group_id = $classGroup->id;
        $material->user_id = Auth::id();
        $material->title = $validated['title'];
        $material->description = $validated['description'] ?? null;
        $material->file_path = $filePath;

        $material->save();

        return redirect()
            ->route(
                'professor.class-groups.classroom-group',
                $classGroup
            )
            ->with(
                'success',
                'Material uploaded successfully.'
            );
    }


    /**
 * Show material detail.
 */
public function show(
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

    $material->load([
        'user',
    ]);

    return view(
        'professor.class_groups.classroom_group.classworks.materials.show',
        compact(
            'classGroup',
            'material'
        )
    );
}

    /**
     * Show edit material form.
     */
    public function edit(
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

        return view(
            'professor.class_groups.classroom_group.classworks.materials.edit',
            compact(
                'classGroup',
                'material'
            )
        );
    }

    /**
     * Update material.
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

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'file' => 'nullable|file|max:51200',
        ]);

        $material->title =
            $validated['title'];

        $material->description =
            $validated['description'] ?? null;

        /*
        |--------------------------------------------------------------------------
        | Replace file if new file uploaded
        |--------------------------------------------------------------------------
        */

        if ($request->hasFile('file')) {

            /*
            | Delete old file
            */

            if (
                $material->file_path &&
                Storage::disk('public')
                    ->exists($material->file_path)
            ) {
                Storage::disk('public')
                    ->delete($material->file_path);
            }

            /*
            | Store new file
            */

            $material->file_path =
                $request
                    ->file('file')
                    ->store(
                        'materials',
                        'public'
                    );
        }

        $material->save();

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
     * Download material.
     */
public function download(
    ClassGroup $classGroup,
    Material $material
) {
    /*
    |--------------------------------------------------------------------------
    | Authorize professor
    |--------------------------------------------------------------------------
    */

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
    | Make sure file exists
    |--------------------------------------------------------------------------
    */

    if (!$material->file_path) {
        abort(404, 'Material file not found.');
    }

    if (!Storage::disk('public')->exists($material->file_path)) {
        abort(404, 'Material file not found.');
    }

    /*
    |--------------------------------------------------------------------------
    | Download file
    |--------------------------------------------------------------------------
    */

    $filePath = Storage::disk('public')
        ->path($material->file_path);

    return response()->download(
        $filePath,
        basename($material->file_path)
    );
}

    /**
     * Delete material.
     */
    public function destroy(
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
        | Delete physical file
        |--------------------------------------------------------------------------
        */

        if (
            $material->file_path &&
            Storage::disk('public')
                ->exists($material->file_path)
        ) {
            Storage::disk('public')
                ->delete($material->file_path);
        }

        /*
        |--------------------------------------------------------------------------
        | Delete database record
        |--------------------------------------------------------------------------
        */

        $material->delete();

        return back()->with(
            'success',
            'Material deleted successfully.'
        );
    }
}