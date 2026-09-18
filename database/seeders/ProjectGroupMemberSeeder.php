<?php

namespace Database\Seeders;

use App\Models\ClassGroup;
use App\Models\Project;
use App\Models\ProjectGroupMember;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProjectGroupMemberSeeder extends Seeder
{
    public function run(): void
    {
        // Get only team projects
        $projects = Project::where('project_type', 'team')
            ->with('classGroup')
            ->get();

        foreach ($projects as $project) {

            $classGroup = $project->classGroup;

            if (!$classGroup) {
                continue;
            }

            /*
            |--------------------------------------------------------------------------
            | Get students enrolled in this class
            |--------------------------------------------------------------------------
            */

            $students = $classGroup->students()
                ->orderBy('users.name')
                ->get()
                ->values();

            if ($students->isEmpty()) {
                $this->command->warn(
                    "No students found for {$classGroup->group_name}."
                );

                continue;
            }

            /*
            |--------------------------------------------------------------------------
            | Get project teams
            |--------------------------------------------------------------------------
            */

            $groups = $project->groups()
                ->orderBy('group_number')
                ->get();

            if ($groups->isEmpty()) {
                $this->command->warn(
                    "No project groups found for project: {$project->title}"
                );

                continue;
            }

            /*
            |--------------------------------------------------------------------------
            | Make sure we have enough students for every team
            |--------------------------------------------------------------------------
            */

            if ($students->count() < $groups->count()) {
                $this->command->warn(
                    "Not enough students to give every team a leader for: "
                    . $project->title
                );

                continue;
            }

            /*
            |--------------------------------------------------------------------------
            | Distribute students between teams
            |--------------------------------------------------------------------------
            */

            foreach ($students as $index => $student) {

                $groupIndex = $index % $groups->count();

                $group = $groups->get($groupIndex);

                /*
                |--------------------------------------------------------------------------
                | Determine role
                |--------------------------------------------------------------------------
                |
                | First student in each team = leader
                | Second student in each team = backup
                | Remaining students = member
                |
                */

                $membersInGroup = ProjectGroupMember::where(
                    'project_group_id',
                    $group->id
                )->count();

                if ($membersInGroup === 0) {
                    $role = 'leader';
                } elseif ($membersInGroup === 1) {
                    $role = 'backup';
                } else {
                    $role = 'member';
                }

                /*
                |--------------------------------------------------------------------------
                | Create member
                |--------------------------------------------------------------------------
                */

                ProjectGroupMember::firstOrCreate(
                    [
                        'project_group_id' => $group->id,
                        'project_id' => $project->id,
                        'user_id' => $student->id,
                    ],
                    [
                        'role' => $role,
                    ]
                );
            }
        }

        $this->command->info(
            'Project group members seeded successfully.'
        );
    }
}