<?php

namespace Database\Seeders;

use App\Models\ClassGroup;
use App\Models\Material;
use App\Models\Topic;
use App\Models\User;
use Illuminate\Database\Seeder;

class MaterialSeeder extends Seeder
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
            | WEB DEVELOPMENT
            |--------------------------------------------------------------------------
            */
            if ($classGroup->group_name === 'Web Development A') {

                $materials = [
                    'Introduction' => [
                        [
                            'title' => 'Web Development Overview',
                            'description' => 'Introduction to web development and how websites work.',
                        ],
                        [
                            'title' => 'HTML Basics',
                            'description' => 'Basic HTML structure, elements, and tags.',
                        ],
                    ],

                    'Core Concepts' => [
                        [
                            'title' => 'CSS Fundamentals',
                            'description' => 'Learn CSS selectors, properties, layouts, and styling.',
                        ],
                        [
                            'title' => 'JavaScript Basics',
                            'description' => 'Introduction to JavaScript syntax, variables, and functions.',
                        ],
                    ],

                    'Practical Work' => [
                        [
                            'title' => 'Build a Simple Web Page',
                            'description' => 'Practice HTML and CSS by creating a simple webpage.',
                        ],
                        [
                            'title' => 'JavaScript Practice',
                            'description' => 'Practice basic JavaScript through small programming exercises.',
                        ],
                    ],
                ];
            }

            /*
            |--------------------------------------------------------------------------
            | DATABASE MANAGEMENT
            |--------------------------------------------------------------------------
            */
            elseif ($classGroup->group_name === 'Database Management A') {

                $materials = [
                    'Introduction' => [
                        [
                            'title' => 'Introduction to Databases',
                            'description' => 'Introduction to databases and database management systems.',
                        ],
                        [
                            'title' => 'Database Concepts',
                            'description' => 'Basic database concepts, tables, records, and relationships.',
                        ],
                    ],

                    'Core Concepts' => [
                        [
                            'title' => 'SQL Fundamentals',
                            'description' => 'Introduction to SQL commands and database queries.',
                        ],
                        [
                            'title' => 'Database Relationships',
                            'description' => 'Learn one-to-one, one-to-many, and many-to-many relationships.',
                        ],
                    ],

                    'Practical Work' => [
                        [
                            'title' => 'SQL Query Exercises',
                            'description' => 'Practice SELECT, INSERT, UPDATE, and DELETE queries.',
                        ],
                        [
                            'title' => 'Database Design Exercise',
                            'description' => 'Practice designing tables and relationships for a database system.',
                        ],
                    ],
                ];
            }

            /*
            |--------------------------------------------------------------------------
            | SOFTWARE ENGINEERING
            |--------------------------------------------------------------------------
            */
            elseif ($classGroup->group_name === 'Software Engineering A') {

                $materials = [
                    'Introduction' => [
                        [
                            'title' => 'Introduction to Software Engineering',
                            'description' => 'Introduction to software engineering principles and practices.',
                        ],
                        [
                            'title' => 'Software Development Process',
                            'description' => 'Overview of how software systems are planned and developed.',
                        ],
                    ],

                    'Core Concepts' => [
                        [
                            'title' => 'Software Development Life Cycle',
                            'description' => 'Learn the major stages of the software development life cycle.',
                        ],
                        [
                            'title' => 'Requirements Engineering',
                            'description' => 'Introduction to gathering, analyzing, and documenting requirements.',
                        ],
                    ],

                    'Practical Work' => [
                        [
                            'title' => 'Software Requirements Exercise',
                            'description' => 'Practice identifying and documenting system requirements.',
                        ],
                        [
                            'title' => 'Project Planning Exercise',
                            'description' => 'Practice creating a basic software project plan.',
                        ],
                    ],
                ];
            }

            /*
            |--------------------------------------------------------------------------
            | CREATE MATERIALS
            |--------------------------------------------------------------------------
            */

            foreach ($materials as $topicName => $topicMaterials) {

                $topic = Topic::where('class_group_id', $classGroup->id)
                    ->where('topic_name', $topicName)
                    ->first();

                if (!$topic) {
                    continue;
                }

                foreach ($topicMaterials as $material) {

                    Material::firstOrCreate(
                        [
                            'class_group_id' => $classGroup->id,
                            'topic_id' => $topic->id,
                            'title' => $material['title'],
                        ],
                        [
                            'user_id' => $professor->id,
                            'description' => $material['description'],
                        ]
                    );
                }
            }
        }

        $this->command->info('Materials seeded successfully.');
    }
}