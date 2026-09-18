<?php

namespace Database\Seeders;

use App\Models\Project;
use App\Models\ProjectGroup;
use Illuminate\Database\Seeder;

class ProjectGroupSeeder extends Seeder
{
    public function run(): void
    {
        // Only team projects need project groups
        $projects = Project::where('project_type', 'team')->get();

        foreach ($projects as $project) {

            $groups = [
                [
                    'group_name' => 'Team 1',
                    'group_number' => 1,
                ],
                [
                    'group_name' => 'Team 2',
                    'group_number' => 2,
                ],
                [
                    'group_name' => 'Team 3',
                    'group_number' => 3,
                ],
            ];

            foreach ($groups as $group) {

                ProjectGroup::firstOrCreate(
                    [
                        'project_id' => $project->id,
                        'group_number' => $group['group_number'],
                    ],
                    [
                        'group_name' => $group['group_name'],
                    ]
                );
            }
        }

        $this->command->info('Project groups seeded successfully.');
    }
}