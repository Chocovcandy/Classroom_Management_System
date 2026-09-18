<?php

namespace Database\Seeders;

use App\Models\ClassGroup;
use App\Models\Topic;
use Illuminate\Database\Seeder;

class TopicSeeder extends Seeder
{
    public function run(): void
    {
        $classGroups = ClassGroup::all();

        if ($classGroups->isEmpty()) {
            $this->command->error('No class groups found.');
            return;
        }

        foreach ($classGroups as $classGroup) {

            $topics = [
                [
                    'topic_name' => 'Introduction',
                    'description' => 'Introduction and basic concepts of the course.',
                    'order' => 1,
                ],
                [
                    'topic_name' => 'Core Concepts',
                    'description' => 'Main concepts and important lessons of the course.',
                    'order' => 2,
                ],
                [
                    'topic_name' => 'Practical Work',
                    'description' => 'Exercises and practical activities.',
                    'order' => 3,
                ],
            ];

            foreach ($topics as $topic) {

                Topic::firstOrCreate(
                    [
                        'class_group_id' => $classGroup->id,
                        'topic_name' => $topic['topic_name'],
                    ],
                    [
                        'description' => $topic['description'],
                        'order' => $topic['order'],
                    ]
                );
            }
        }

        $this->command->info(
            'Topics seeded successfully.'
        );
    }
}