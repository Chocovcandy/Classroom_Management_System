<?php

namespace Database\Seeders;

use App\Models\ClassGroup;
use App\Models\Project;
use App\Models\Topic;
use App\Models\User;
use Illuminate\Database\Seeder;

class ProjectSeeder extends Seeder
{
    public function run(): void
    {
        $professor = User::where('email', 'theary@lifeun.edu.kh')->first();

        if (!$professor) {
            $this->command->error('Professor not found.');
            return;
        }

        $classGroups = ClassGroup::where('professor_id', $professor->id)->get();

        foreach ($classGroups as $classGroup) {

            /*
            |--------------------------------------------------------------------------
            | Web Development A
            |--------------------------------------------------------------------------
            */

            if ($classGroup->group_name === 'Web Development A') {

                $projects = [
                    'Practical Work' => [
                        [
                            'title' => 'Responsive Website Project',
                            'description' => 'Work in a team to design and develop a responsive website using HTML, CSS, and JavaScript.',
                            'due_date' => '2026-11-05',
                            'due_time' => '23:59:00',
                            'points' => 50,
                            'project_type' => 'team',
                        ],
                    ],
                ];
            }

            /*
            |--------------------------------------------------------------------------
            | Database Management A
            |--------------------------------------------------------------------------
            */

            elseif ($classGroup->group_name === 'Database Management A') {

                $projects = [
                    'Practical Work' => [
                        [
                            'title' => 'Student Management Database Project',
                            'description' => 'Work in a team to design and implement a relational database for a student management system.',
                            'due_date' => '2026-11-06',
                            'due_time' => '23:59:00',
                            'points' => 50,
                            'project_type' => 'team',
                        ],
                    ],
                ];
            }

            /*
            |--------------------------------------------------------------------------
            | Software Engineering A
            |--------------------------------------------------------------------------
            */

            elseif ($classGroup->group_name === 'Software Engineering A') {

                $projects = [
                    'Practical Work' => [
                        [
                            'title' => 'Software System Development Project',
                            'description' => 'Work in a team to analyze, design, and plan a complete software system.',
                            'due_date' => '2026-11-07',
                            'due_time' => '23:59:00',
                            'points' => 50,
                            'project_type' => 'team',
                        ],
                    ],
                ];
            }

            else {
                continue;
            }

            /*
            |--------------------------------------------------------------------------
            | Create Projects
            |--------------------------------------------------------------------------
            */

            foreach ($projects as $topicName => $topicProjects) {

                $topic = Topic::where('class_group_id', $classGroup->id)
                    ->where('topic_name', $topicName)
                    ->first();

                if (!$topic) {
                    continue;
                }

                foreach ($topicProjects as $projectData) {

                    Project::firstOrCreate(
                        [
                            'class_group_id' => $classGroup->id,
                            'topic_id' => $topic->id,
                            'title' => $projectData['title'],
                        ],
                        [
                            'user_id' => $professor->id,
                            'description' => $projectData['description'],
                            'due_date' => $projectData['due_date'],
                            'due_time' => $projectData['due_time'],
                            'points' => $projectData['points'],
                            'project_type' => $projectData['project_type'],
                        ]
                    );
                }
            }
        }

        $this->command->info('Projects seeded successfully.');
    }
}