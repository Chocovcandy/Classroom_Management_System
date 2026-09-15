<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\ClassGroup;
use App\Models\Material;
use App\Models\Resource;
use Illuminate\Support\Facades\Auth;

class StudentMaterialController extends Controller
{
    // =============================================================
    // MATERIALS INDEX
    // Show all materials for a class group
    // =============================================================

    public function index(ClassGroup $classGroup)
    {
        $student = Auth::user();

        // ---------------------------------------------------------
        // Check if the student is enrolled in this class
        // ---------------------------------------------------------

        $isStudent = $classGroup->students()
            ->where('users.id', $student->id)
            ->exists();

        if (!$isStudent) {
            abort(403, 'You are not enrolled in this class.');
        }

        // ---------------------------------------------------------
        // Get materials for this class
        // ---------------------------------------------------------

        $materials = $classGroup->materials()
            ->with([
                'topic',
                'resources',
                'user',
            ])
            ->latest()
            ->get();

        return view(
            'student.class_groups.classroom_group.classworks.materials.streams.index',
            compact('classGroup', 'materials')
        );
    }


    // =============================================================
    // MATERIAL SHOW
    // Show one material
    // =============================================================

public function show(
    ClassGroup $classGroup,
    Material $material
) {
    $student = Auth::user();

    // Check if student is enrolled
    $isStudent = $classGroup->students()
        ->where('users.id', $student->id)
        ->exists();

    if (!$isStudent) {
        abort(403, 'You are not enrolled in this class.');
    }

    // Make sure material belongs to this class
    if ($material->class_group_id !== $classGroup->id) {
        abort(404);
    }

    // Load material information
    $material->load([
        'topic',
        'resources',
        'user',
        'classGroup',
    ]);

    // Get where the student came from
    $returnTo = request()->query('return_to', 'classwork');

    // Only allow valid destinations
    if (!in_array($returnTo, ['stream', 'classwork'])) {
        $returnTo = 'classwork';
    }

    return view(
        'student.class_groups.classroom_group.classworks.materials.show',
        compact(
            'classGroup',
            'material',
            'returnTo'
        )
    );
}

    // =============================================================
    // RESOURCE DOWNLOAD
    // Download a resource belonging to a material
    // =============================================================

    public function downloadResource(
        ClassGroup $classGroup,
        Material $material,
        Resource $resource
    ) {
        $student = Auth::user();

        // ---------------------------------------------------------
        // Check if the student is enrolled in this class
        // ---------------------------------------------------------

        $isStudent = $classGroup->students()
            ->where('users.id', $student->id)
            ->exists();

        if (!$isStudent) {
            abort(403, 'You are not enrolled in this class.');
        }

        // ---------------------------------------------------------
        // Make sure material belongs to this class
        // ---------------------------------------------------------

        if ($material->class_group_id !== $classGroup->id) {
            abort(404);
        }

        // ---------------------------------------------------------
        // Make sure resource belongs to this material
        // ---------------------------------------------------------

        if (
            $resource->resourceable_type !== Material::class ||
            $resource->resourceable_id !== $material->id
        ) {
            abort(404);
        }

        // ---------------------------------------------------------
        // Download
        // ---------------------------------------------------------

        return response()->download(
            storage_path('app/public/' . $resource->file_path),
            $resource->file_name
        );
    }
}