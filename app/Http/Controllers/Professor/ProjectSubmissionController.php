<?php

namespace App\Http\Controllers\Professor;

use App\Http\Controllers\Controller;
use App\Models\ClassGroup;
use App\Models\Project;
use App\Models\ProjectGroup;
use App\Models\ProjectGroupMember;
use App\Models\ProjectSubmission;
use App\Models\ProjectSubmissionGrade;
use App\Models\Resource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;

class ProjectSubmissionController extends Controller
{
    /**
     * ============================================================
     * SHOW SUBMISSION
     * ============================================================
     *
     * Show one project submission.
     *
     * Works for:
     * - Individual Project
     * - Team Project
     */
    public function show(
        Request $request,
        int $classGroupId,
        int $projectId,
        int $submissionId
    ) {
        // Get class group
        $classGroup = ClassGroup::findOrFail($classGroupId);

        // Professor authorization
        Gate::authorize('manage', $classGroup);

        // Make sure project belongs to this class
        $project = Project::where('id', $projectId)
            ->where('class_group_id', $classGroup->id)
            ->firstOrFail();

        // Get submission
        $submission = ProjectSubmission::with([
            'student',
            'projectGroup.members.user',
            'resources',
            'grades.student',
        ])
            ->where('id', $submissionId)
            ->where('project_id', $project->id)
            ->firstOrFail();

        // Keep track of where the professor came from
        $returnTo = $request->query('return_to', 'stream');

        // Only allow the expected values
        if (!in_array($returnTo, ['stream', 'classwork'])) {
            $returnTo = 'stream';
        }

        return view(
            'professor.class_groups.classroom_group.classworks.projects.submissions.show',
            compact(
                'classGroup',
                'project',
                'submission',
                'returnTo'
            )
        );
    }

    /**
     * ============================================================
     * GRADE INDIVIDUAL SUBMISSION
     * ============================================================
     *
     * Used for Individual Projects.
     */public function grade(
    Request $request,
    int $classGroupId,
    int $projectId,
    int $submissionId
) {
    // Get class group
    $classGroup = ClassGroup::findOrFail($classGroupId);

    // Professor authorization
    Gate::authorize('manage', $classGroup);

    // Make sure project belongs to class
    $project = Project::where('id', $projectId)
        ->where('class_group_id', $classGroup->id)
        ->firstOrFail();

    // Make sure submission belongs to project
    $submission = ProjectSubmission::where('id', $submissionId)
        ->where('project_id', $project->id)
        ->firstOrFail();

    // This method is only for Individual Projects
    if ($project->project_type !== 'individual') {
        abort(404);
    }

    $validated = $request->validate([
        'score' => [
            'required',
            'numeric',
            'min:0',
            'max:' . $project->points,
        ],

        'feedback' => [
            'nullable',
            'string',
        ],
    ]);

    $submission->update([
        'score' => $validated['score'],
        'feedback' => $validated['feedback'] ?? null,
        'graded_at' => now(),
    ]);

    // Grading from Marks page
    if ($request->boolean('from_marks')) {
        return redirect()
            ->route(
                'professor.class-groups.marks',
                $classGroupId
            )
            ->with(
                'success',
                'Project grade updated successfully.'
            );
    }

    // Remember where the professor came from
    $returnTo = $request->input(
        'return_to',
        $request->input('origin', 'stream')
    );

    if (!in_array($returnTo, ['stream', 'classwork'], true)) {
        $returnTo = 'stream';
    }

    // Return to submission page and preserve origin
    return redirect()
        ->route(
            'professor.classworks.projects.submissions.show',
            [
                'classGroupId' => $classGroupId,
                'projectId' => $projectId,
                'submissionId' => $submissionId,
                'return_to' => $returnTo,
            ]
        )
        ->with(
            'success',
            'Project grade updated successfully.'
        );
}

    /**
     * ============================================================
     * GRADE ALL TEAMS
     * ============================================================
     *
     * Give the same score to every submitted team member.
     *
     * Example:
     *
     * Team 1
     * Student A -> 85
     * Student B -> 85
     *
     * Team 2
     * Student C -> 85
     * Student D -> 85
     */
    public function gradeAllTeams(
        Request $request,
        ClassGroup $classGroup,
        Project $project
    ) {
        // Professor authorization
        Gate::authorize('manage', $classGroup);

        // Make sure project belongs to this class
        if ($project->class_group_id !== $classGroup->id) {
            abort(404);
        }

        // This method is only for Team Projects
        if ($project->project_type !== 'team') {
            abort(404);
        }

        $validated = $request->validate([
            'score' => [
                'required',
                'numeric',
                'min:0',
                'max:' . $project->points,
            ],
        ]);

        $submissions = ProjectSubmission::with(
            'projectGroup.members'
        )
            ->where('project_id', $project->id)
            ->whereNotNull('submitted_at')
            ->whereNotNull('project_group_id')
            ->get();

        foreach ($submissions as $submission) {

            if (!$submission->projectGroup) {
                continue;
            }

            foreach ($submission->projectGroup->members as $member) {

                ProjectSubmissionGrade::updateOrCreate(
                    [
                        'project_submission_id' => $submission->id,
                        'student_id' => $member->user_id,
                    ],
                    [
                        'score' => $validated['score'],
                        'graded_at' => now(),
                    ]
                );
            }
        }

        return redirect()
            ->route(
                'professor.class-groups.marks',
                $classGroup->id
            )
            ->with(
                'success',
                'All submitted project teams have been graded successfully.'
            );
    }

    /**
     * ============================================================
     * GRADE AS COMPLETE
     * ============================================================
     *
     * Give full project points to every member
     * of every submitted team.
     */
    public function gradeAsComplete(
        int $classGroupId,
        int $projectId
    ) {
        // Get class group
        $classGroup = ClassGroup::findOrFail($classGroupId);

        // Professor authorization
        Gate::authorize('manage', $classGroup);

        // Make sure project belongs to class
        $project = Project::where('id', $projectId)
            ->where('class_group_id', $classGroupId)
            ->firstOrFail();

        // This method is only for Team Projects
        if ($project->project_type !== 'team') {
            abort(404);
        }

        $submissions = ProjectSubmission::with(
            'projectGroup.members'
        )
            ->where('project_id', $project->id)
            ->whereNotNull('submitted_at')
            ->whereNotNull('project_group_id')
            ->get();

        foreach ($submissions as $submission) {

            if (!$submission->projectGroup) {
                continue;
            }

            foreach ($submission->projectGroup->members as $member) {

                ProjectSubmissionGrade::updateOrCreate(
                    [
                        'project_submission_id' => $submission->id,
                        'student_id' => $member->user_id,
                    ],
                    [
                        'score' => $project->points,
                        'graded_at' => now(),
                    ]
                );
            }
        }

        return redirect()
            ->route(
                'professor.class-groups.marks',
                $classGroup->id
            )
            ->with(
                'success',
                'All submitted project teams have been graded as complete.'
            );
    }

    /**
     * ============================================================
     * GRADE ONE TEAM - SAME SCORE FOR ALL MEMBERS
     * ============================================================
     */
    public function gradeTeam(
        Request $request,
        int $classGroupId,
        int $projectId,
        int $submissionId
    ) {
        // Get class group
        $classGroup = ClassGroup::findOrFail($classGroupId);

        // Professor authorization
        Gate::authorize('manage', $classGroup);

        // Make sure project belongs to class
        $project = Project::where('id', $projectId)
            ->where('class_group_id', $classGroup->id)
            ->firstOrFail();

        // Team project only
        if ($project->project_type !== 'team') {
            abort(404);
        }

        // Get submission
        $submission = ProjectSubmission::with(
            'projectGroup.members'
        )
            ->where('id', $submissionId)
            ->where('project_id', $project->id)
            ->firstOrFail();

        // Submission must belong to a team
        if (!$submission->project_group_id) {
            abort(404);
        }

        $validated = $request->validate([
            'score' => [
                'required',
                'numeric',
                'min:0',
                'max:' . $project->points,
            ],

            'feedback' => [
                'nullable',
                'string',
            ],
        ]);

        foreach ($submission->projectGroup->members as $member) {

            ProjectSubmissionGrade::updateOrCreate(
                [
                    'project_submission_id' => $submission->id,
                    'student_id' => $member->user_id,
                ],
                [
                    'score' => $validated['score'],
                    'feedback' => $validated['feedback'] ?? null,
                    'graded_at' => now(),
                ]
            );
        }

        /*
         * If grading from the Marks page,
         * return to Marks.
         */
        if ($request->boolean('from_marks')) {
            return redirect()
                ->route(
                    'professor.class-groups.marks',
                    $classGroup->id
                )
                ->with(
                    'success',
                    'All members of the team received the same grade.'
                );
        }

        /*
         * Otherwise, keep the existing behavior
         * and return to the submission page.
         */
        return redirect()
            ->route(
                'professor.classworks.projects.submissions.show',
                [
                    'classGroupId' => $classGroup->id,
                    'projectId' => $project->id,
                    'submissionId' => $submission->id,
                ]
            )
            ->with(
                'success',
                'All members of the team received the same grade.'
            );
    }

    /**
     * ============================================================
     * GRADE TEAM MEMBERS MANUALLY
     * ============================================================
     *
     * Each team member can receive a different score.
     */
    public function gradeTeamMembers(
        Request $request,
        int $classGroupId,
        int $projectId,
        int $submissionId
    ) {
        // Get class group
        $classGroup = ClassGroup::findOrFail($classGroupId);

        // Professor authorization
        Gate::authorize('manage', $classGroup);

        // Make sure project belongs to class
        $project = Project::where('id', $projectId)
            ->where('class_group_id', $classGroup->id)
            ->firstOrFail();

        // Team project only
        if ($project->project_type !== 'team') {
            abort(404);
        }

        // Get submission and team members
        $submission = ProjectSubmission::with(
            'projectGroup.members'
        )
            ->where('id', $submissionId)
            ->where('project_id', $project->id)
            ->firstOrFail();

        if (!$submission->project_group_id) {
            abort(404);
        }

        /*
         * Expected request:
         *
         * grades[student_id][score]
         * grades[student_id][feedback]
         */
        $validated = $request->validate([
            'grades' => [
                'required',
                'array',
            ],

            'grades.*.score' => [
                'required',
                'numeric',
                'min:0',
                'max:' . $project->points,
            ],

            'grades.*.feedback' => [
                'nullable',
                'string',
            ],
        ]);

        /*
         * Only allow grades for actual members
         * of this team.
         */
        $memberIds = $submission->projectGroup
            ->members
            ->pluck('user_id')
            ->map(fn ($id) => (int) $id)
            ->toArray();

        foreach ($validated['grades'] as $studentId => $gradeData) {

            $studentId = (int) $studentId;

            if (!in_array($studentId, $memberIds, true)) {
                abort(403, 'Student is not a member of this team.');
            }

            ProjectSubmissionGrade::updateOrCreate(
                [
                    'project_submission_id' => $submission->id,
                    'student_id' => $studentId,
                ],
                [
                    'score' => $gradeData['score'],
                    'feedback' => $gradeData['feedback'] ?? null,
                    'graded_at' => now(),
                ]
            );
        }

        /*
         * If grading from the Marks page,
         * return to Marks.
         */
        if ($request->boolean('from_marks')) {
            return redirect()
                ->route(
                    'professor.class-groups.marks',
                    $classGroup->id
                )
                ->with(
                    'success',
                    'Team member grades updated successfully.'
                );
        }

        /*
         * Otherwise, keep the existing behavior
         * and return to the submission page.
         */
        return redirect()
            ->route(
                'professor.classworks.projects.submissions.show',
                [
                    'classGroupId' => $classGroup->id,
                    'projectId' => $project->id,
                    'submissionId' => $submission->id,
                ]
            )
            ->with(
                'success',
                'Team member grades updated successfully.'
            );
    }

    /**
     * ============================================================
     * VIEW SUBMITTED RESOURCE
     * ============================================================
     */
    public function viewResource(
        int $classGroupId,
        int $projectId,
        int $submissionId,
        int $resourceId
    ) {
        // Get class group
        $classGroup = ClassGroup::findOrFail($classGroupId);

        // Professor authorization
        Gate::authorize('manage', $classGroup);

        // Make sure project belongs to class
        $project = Project::where('id', $projectId)
            ->where('class_group_id', $classGroup->id)
            ->firstOrFail();

        // Make sure submission belongs to project
        $submission = ProjectSubmission::where('id', $submissionId)
            ->where('project_id', $project->id)
            ->firstOrFail();

        // Make sure resource belongs to this submission
        $resource = Resource::where('id', $resourceId)
            ->where(
                'resourceable_type',
                ProjectSubmission::class
            )
            ->where(
                'resourceable_id',
                $submission->id
            )
            ->firstOrFail();

        // Check file exists
        if (!Storage::disk('public')->exists($resource->file_path)) {
            abort(404, 'File not found.');
        }

        $path = Storage::disk('public')->path(
            $resource->file_path
        );

        return response()->file($path);
    }

    /**
     * ============================================================
     * DOWNLOAD SUBMITTED RESOURCE
     * ============================================================
     */
    public function downloadResource(
        int $classGroupId,
        int $projectId,
        int $submissionId,
        int $resourceId
    ) {
        // Get class group
        $classGroup = ClassGroup::findOrFail($classGroupId);

        // Professor authorization
        Gate::authorize('manage', $classGroup);

        // Make sure project belongs to class
        $project = Project::where('id', $projectId)
            ->where('class_group_id', $classGroup->id)
            ->firstOrFail();

        // Make sure submission belongs to project
        $submission = ProjectSubmission::where('id', $submissionId)
            ->where('project_id', $project->id)
            ->firstOrFail();

        // Make sure resource belongs to this submission
        $resource = Resource::where('id', $resourceId)
            ->where(
                'resourceable_type',
                ProjectSubmission::class
            )
            ->where(
                'resourceable_id',
                $submission->id
            )
            ->firstOrFail();

        // Check file exists
        if (!Storage::disk('public')->exists($resource->file_path)) {
            abort(404, 'File not found.');
        }

        $path = Storage::disk('public')->path(
            $resource->file_path
        );

        return response()->download(
            $path,
            $resource->file_name
        );
    }
}