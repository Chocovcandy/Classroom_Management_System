<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\ClassGroup;
use App\Models\Project;
use App\Models\ProjectSubmission;
use App\Models\Resource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class StudentProjectController extends Controller
{
    /**
     * ============================================================
     * SHOW PROJECT
     * ============================================================
     *
     * Display a project to an enrolled student.
     *
     * Individual project:
     * - Show the student's own submission.
     *
     * Team project:
     * - Find the student's team.
     * - Show only that team.
     * - Show the team's submission.
     */
    public function show(
        ClassGroup $classGroup,
        Project $project
    ) {
        $student = Auth::user();

        /*
        |--------------------------------------------------------------------------
        | 1. Make sure the student is enrolled in this class
        |--------------------------------------------------------------------------
        */

        $isStudent = $classGroup->students()
            ->where('users.id', $student->id)
            ->exists();

        if (!$isStudent) {
            abort(403, 'You are not enrolled in this class.');
        }

        /*
        |--------------------------------------------------------------------------
        | 2. Make sure the project belongs to this class
        |--------------------------------------------------------------------------
        */

        if ($project->class_group_id !== $classGroup->id) {
            abort(404);
        }

        /*
        |--------------------------------------------------------------------------
        | 3. Load project information
        |--------------------------------------------------------------------------
        */

        $project->load([
            'topic',
            'user',
            'resources',
        ]);

        /*
        |--------------------------------------------------------------------------
        | 4. Find student's team
        |--------------------------------------------------------------------------
        */

        $projectGroup = null;

        if ($project->project_type === 'team') {

            $projectGroup = $project->groups()
                ->whereHas('members', function ($query) use ($student) {
                    $query->where('user_id', $student->id);
                })
                ->with([
                    'members.user',
                ])
                ->first();
        }

        /*
        |--------------------------------------------------------------------------
        | 5. Find student's submission
        |--------------------------------------------------------------------------
        |
        | Individual:
        |   project_id + student_id
        |
        | Team:
        |   project_id + project_group_id
        |
        */

        $submission = null;

        if ($project->project_type === 'team') {

            if ($projectGroup) {

                $submission = $project->submissions()
                    ->where('project_group_id', $projectGroup->id)
                    ->with([
                        'resources',
                        'grades',
                    ])
                    ->latest()
                    ->first();
            }

        } else {

            $submission = $project->submissions()
                ->where('student_id', $student->id)
                ->whereNull('project_group_id')
                ->with([
                    'resources',
                    'grades',
                ])
                ->latest()
                ->first();
        }

        /*
        |--------------------------------------------------------------------------
        | 6. Return project page
        |--------------------------------------------------------------------------
        */

        return view(
            'student.class_groups.classroom_group.classworks.projects.show',
            compact(
                'classGroup',
                'project',
                'projectGroup',
                'submission'
            )
        );
    }


    /**
     * ============================================================
     * DOWNLOAD PROJECT RESOURCE
     * ============================================================
     *
     * Download a file attached by the professor to the project.
     */
    public function downloadResource(
        ClassGroup $classGroup,
        Project $project,
        Resource $resource
    ) {
        $student = Auth::user();

        /*
        |--------------------------------------------------------------------------
        | 1. Make sure student is enrolled
        |--------------------------------------------------------------------------
        */

        $isStudent = $classGroup->students()
            ->where('users.id', $student->id)
            ->exists();

        if (!$isStudent) {
            abort(403, 'You are not enrolled in this class.');
        }

        /*
        |--------------------------------------------------------------------------
        | 2. Make sure project belongs to class
        |--------------------------------------------------------------------------
        */

        if ($project->class_group_id !== $classGroup->id) {
            abort(404);
        }

        /*
        |--------------------------------------------------------------------------
        | 3. Make sure resource belongs to project
        |--------------------------------------------------------------------------
        */

        if (
            $resource->resourceable_type !== Project::class ||
            $resource->resourceable_id !== $project->id
        ) {
            abort(404);
        }

        /*
        |--------------------------------------------------------------------------
        | 4. Make sure file exists
        |--------------------------------------------------------------------------
        */

        if (
            !$resource->file_path ||
            !Storage::disk('public')->exists($resource->file_path)
        ) {
            abort(404, 'Resource file not found.');
        }

        /*
        |--------------------------------------------------------------------------
        | 5. Download
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
     * ============================================================
     * SUBMIT PROJECT
     * ============================================================
     *
     * Create or update the student's project submission.
     *
     * Individual project:
     * - One submission for the student.
     *
     * Team project:
     * - One submission for the student's team.
     * - The student submitting is recorded in student_id.
     */
    public function submit(
        Request $request,
        ClassGroup $classGroup,
        Project $project
    ) {
        $student = Auth::user();

        /*
        |--------------------------------------------------------------------------
        | 1. Make sure student is enrolled
        |--------------------------------------------------------------------------
        */

        $isStudent = $classGroup->students()
            ->where('users.id', $student->id)
            ->exists();

        if (!$isStudent) {
            abort(403, 'You are not enrolled in this class.');
        }

        /*
        |--------------------------------------------------------------------------
        | 2. Make sure project belongs to class
        |--------------------------------------------------------------------------
        */

        if ($project->class_group_id !== $classGroup->id) {
            abort(404);
        }

        /*
        |--------------------------------------------------------------------------
        | 3. Validate uploaded files
        |--------------------------------------------------------------------------
        |
        | Same upload structure as Assignment:
        | - attachments
        | - multiple files
        | - maximum 100 MB per file
        |
        */

        $request->validate([
            'attachments' => [
                'required',
                'array',
                'min:1',
            ],

            'attachments.*' => [
                'file',
                'max:102400',
            ],
        ]);

        /*
        |--------------------------------------------------------------------------
        | 4. Find team if this is a team project
        |--------------------------------------------------------------------------
        */

        $projectGroup = null;

        if ($project->project_type === 'team') {

            $projectGroup = $project->groups()
                ->whereHas('members', function ($query) use ($student) {
                    $query->where('user_id', $student->id);
                })
                ->with('members')
                ->first();

            /*
            |--------------------------------------------------------------------------
            | Student must belong to a team
            |--------------------------------------------------------------------------
            */

            if (!$projectGroup) {
                return back()->with(
                    'error',
                    'You have not been assigned to a team for this project.'
                );
            }

            /*
            |--------------------------------------------------------------------------
            | Only Team Leader or Backup Submitter may submit
            |--------------------------------------------------------------------------
            |
            | Leader   = primary submitter
            | Backup   = may submit when the leader is unavailable
            | Member   = cannot submit the final project
            |
            | If neither leader nor backup submits, the professor must
            | intervene by submitting for the team or changing the role.
            |--------------------------------------------------------------------------
            */

            $studentRole = $projectGroup->members
                ->firstWhere('user_id', $student->id)
                ?->role;

            if (!in_array($studentRole, ['leader', 'backup'], true)) {
                return back()->with(
                    'error',
                    'Only the Team Leader can submit the final project. The Backup Submitter can submit when the Team Leader is unavailable.'
                );
            }
        }

        /*
        |--------------------------------------------------------------------------
        | 5. Find existing submission
        |--------------------------------------------------------------------------
        */

        if ($project->project_type === 'team') {

            $submission = ProjectSubmission::query()
                ->where('project_id', $project->id)
                ->where('project_group_id', $projectGroup->id)
                ->first();

        } else {

            $submission = ProjectSubmission::query()
                ->where('project_id', $project->id)
                ->where('student_id', $student->id)
                ->whereNull('project_group_id')
                ->first();
        }

        /*
        |--------------------------------------------------------------------------
        | 6. One final submission per student/team
        |--------------------------------------------------------------------------
        */

        if ($submission && $submission->submitted_at) {

            return back()->with(
                'error',
                'This project has already been submitted. The professor must reopen it before a new submission can be made.'
            );
        }

        if (!$submission) {

            $submission = ProjectSubmission::create([
                'project_id' => $project->id,
                'student_id' => $student->id,
                'project_group_id' => $projectGroup?->id,
                'submitted_at' => now(),
                'status' => 'submitted',
            ]);

        } else {

            $submission->update([
                'student_id' => $student->id,
                'submitted_at' => now(),
                'status' => 'submitted',
            ]);
        }

        /*
        |--------------------------------------------------------------------------
        | 7. Store uploaded files
        |--------------------------------------------------------------------------
        */

        foreach ($request->file('attachments', []) as $file) {

            $path = $file->store(
                'project-submissions',
                'public'
            );

            $submission->resources()->create([
                'title' => $file->getClientOriginalName(),
                'type' => 'file',
                'file_path' => $path,
                'file_name' => $file->getClientOriginalName(),
                'mime_type' => $file->getMimeType(),
                'file_size' => $file->getSize(),
                'url' => null,
            ]);
        }

        /*
        |--------------------------------------------------------------------------
        | 8. Redirect back to project
        |--------------------------------------------------------------------------
        */

        return redirect()
            ->route(
                'student.class-groups.projects.show',
                [
                    'classGroup' => $classGroup,
                    'project' => $project,
                ]
            )
            ->with(
                'success',
                'Project submitted successfully.'
            );
    }


/**
 * ============================================================
 * CANCEL SUBMISSION
 * ============================================================
 *
 * Individual:
 * - A student can cancel their own submission.
 *
 * Team:
 * - Only the student who uploaded the current submission
 *   can cancel it.
 * - Leader can submit and cancel their own submission.
 * - Backup can submit and cancel their own submission.
 * - Member cannot submit or cancel.
 */
public function cancel(
    ClassGroup $classGroup,
    Project $project
) {
    $student = Auth::user();

    /*
    |--------------------------------------------------------------------------
    | 1. Make sure the student is enrolled
    |--------------------------------------------------------------------------
    */

    $isStudent = $classGroup->students()
        ->where('users.id', $student->id)
        ->exists();

    if (!$isStudent) {
        abort(403, 'You are not enrolled in this class.');
    }

    /*
    |--------------------------------------------------------------------------
    | 2. Make sure project belongs to this class
    |--------------------------------------------------------------------------
    */

    if ($project->class_group_id !== $classGroup->id) {
        abort(404);
    }

    /*
    |--------------------------------------------------------------------------
    | 3. Find the correct submission
    |--------------------------------------------------------------------------
    */

    $submission = null;

    if ($project->project_type === 'team') {

        /*
        |--------------------------------------------------------------------------
        | Find the student's team
        |--------------------------------------------------------------------------
        */

        $projectGroup = $project->groups()
            ->whereHas('members', function ($query) use ($student) {
                $query->where('user_id', $student->id);
            })
            ->with('members')
            ->first();

        if (!$projectGroup) {
            return back()->with(
                'error',
                'You are not assigned to a team for this project.'
            );
        }

        /*
        |--------------------------------------------------------------------------
        | Check the student's team role
        |--------------------------------------------------------------------------
        */

        $studentRole = $projectGroup->members
            ->firstWhere('user_id', $student->id)
            ?->role;

        /*
        |--------------------------------------------------------------------------
        | Members cannot cancel
        |--------------------------------------------------------------------------
        */

        if (!in_array($studentRole, ['leader', 'backup'], true)) {
            return back()->with(
                'error',
                'Only the Team Leader or Backup Submitter can cancel the team submission.'
            );
        }

        /*
        |--------------------------------------------------------------------------
        | Find the team's submission
        |--------------------------------------------------------------------------
        */

        $submission = ProjectSubmission::query()
            ->where('project_id', $project->id)
            ->where('project_group_id', $projectGroup->id)
            ->first();

    } else {

        /*
        |--------------------------------------------------------------------------
        | Individual project
        |--------------------------------------------------------------------------
        */

        $submission = ProjectSubmission::query()
            ->where('project_id', $project->id)
            ->where('student_id', $student->id)
            ->whereNull('project_group_id')
            ->first();
    }

    /*
    |--------------------------------------------------------------------------
    | 4. Make sure a submission exists
    |--------------------------------------------------------------------------
    */

    if (!$submission) {
        return back()->with(
            'error',
            'You do not have a project submission.'
        );
    }

    /*
    |--------------------------------------------------------------------------
    | 5. Only the actual uploader can cancel
    |--------------------------------------------------------------------------
    |
    | Example:
    | - Leader submits  -> only leader can cancel.
    | - Backup submits  -> only backup can cancel.
    |
    */

    if ((int) $submission->student_id !== (int) $student->id) {
        return back()->with(
            'error',
            'Only the student who submitted this project can cancel it.'
        );
    }

    /*
    |--------------------------------------------------------------------------
    | 6. Prevent cancellation after grading
    |--------------------------------------------------------------------------
    */

    if ($submission->graded_at) {
        return back()->with(
            'error',
            'This submission has already been graded and cannot be cancelled.'
        );
    }

    /*
    |--------------------------------------------------------------------------
    | 7. Delete submitted resource files
    |--------------------------------------------------------------------------
    */

    $submission->load('resources');

    foreach ($submission->resources as $resource) {

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

    /*
    |--------------------------------------------------------------------------
    | 8. Delete submission
    |--------------------------------------------------------------------------
    */

    $submission->delete();

    /*
    |--------------------------------------------------------------------------
    | 9. Return to project page
    |--------------------------------------------------------------------------
    */

    return redirect()
        ->route(
            'student.class-groups.projects.show',
            [
                'classGroup' => $classGroup,
                'project' => $project,
            ]
        )
        ->with(
            'success',
            'Project submission cancelled successfully.'
        );
}
}