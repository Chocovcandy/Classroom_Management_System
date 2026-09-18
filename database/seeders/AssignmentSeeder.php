<?php

namespace Database\Seeders;

use App\Models\Assignment;
use App\Models\ClassGroup;
use App\Models\Topic;
use App\Models\User;
use Illuminate\Database\Seeder;

class AssignmentSeeder extends Seeder
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

                $assignments = [
                    'Introduction' => [
                        [
                            'title' => 'HTML Page Structure',
                            'description' => 'Create a basic webpage using HTML elements and proper page structure.',
                            'points' => 10,
                            'due_date' => '2026-09-22',
                            'due_time' => '23:59:00',
                        ],
                    ],

                    'Core Concepts' => [
                        [
                            'title' => 'CSS Layout Exercise',
                            'description' => 'Create a responsive webpage using CSS layout techniques.',
                            'points' => 15,
                            'due_date' => '2026-09-29',
                            'due_time' => '23:59:00',
                        ],
                        [
                            'title' => 'JavaScript Practice',
                            'description' => 'Complete the JavaScript programming exercises provided in class.',
                            'points' => 20,
                            'due_date' => '2026-10-06',
                            'due_time' => '23:59:00',
                        ],
                    ],

                    'Practical Work' => [
                        [
                            'title' => 'Build a Personal Web Page',
                            'description' => 'Build a complete personal webpage using HTML, CSS, and JavaScript.',
                            'points' => 25,
                            'due_date' => '2026-10-13',
                            'due_time' => '23:59:00',
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

                $assignments = [
                    'Introduction' => [
                        [
                            'title' => 'Database Concepts Exercise',
                            'description' => 'Answer questions about databases, tables, records, and database systems.',
                            'points' => 10,
                            'due_date' => '2026-09-23',
                            'due_time' => '23:59:00',
                        ],
                    ],

                    'Core Concepts' => [
                        [
                            'title' => 'SQL Query Practice',
                            'description' => 'Write SQL queries using SELECT, INSERT, UPDATE, and DELETE.',
                            'points' => 20,
                            'due_date' => '2026-09-30',
                            'due_time' => '23:59:00',
                        ],
                        [
                            'title' => 'Database Relationship Exercise',
                            'description' => 'Design database relationships for a given system.',
                            'points' => 15,
                            'due_date' => '2026-10-07',
                            'due_time' => '23:59:00',
                        ],
                    ],

                    'Practical Work' => [
                        [
                            'title' => 'Design a Student Database',
                            'description' => 'Design a relational database for a student management system.',
                            'points' => 25,
                            'due_date' => '2026-10-14',
                            'due_time' => '23:59:00',
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

                $assignments = [
                    'Introduction' => [
                        [
                            'title' => 'Software Engineering Introduction',
                            'description' => 'Answer questions about software engineering principles and practices.',
                            'points' => 10,
                            'due_date' => '2026-09-24',
                            'due_time' => '23:59:00',
                        ],
                    ],

                    'Core Concepts' => [
                        [
                            'title' => 'SDLC Analysis',
                            'description' => 'Explain the stages of the Software Development Life Cycle.',
                            'points' => 15,
                            'due_date' => '2026-10-01',
                            'due_time' => '23:59:00',
                        ],
                        [
                            'title' => 'Requirements Analysis',
                            'description' => 'Identify and document functional and non-functional requirements.',
                            'points' => 20,
                            'due_date' => '2026-10-08',
                            'due_time' => '23:59:00',
                        ],
                    ],

                    'Practical Work' => [
                        [
                            'title' => 'Software Project Proposal',
                            'description' => 'Create a proposal for a software project including requirements and project goals.',
                            'points' => 25,
                            'due_date' => '2026-10-15',
                            'due_time' => '23:59:00',
                        ],
                    ],
                ];
            }

            /*
            |--------------------------------------------------------------------------
            | Create Assignments
            |--------------------------------------------------------------------------
            */

            foreach ($assignments as $topicName => $topicAssignments) {

                $topic = Topic::where('class_group_id', $classGroup->id)
                    ->where('topic_name', $topicName)
                    ->first();

                if (!$topic) {
                    continue;
                }

                foreach ($topicAssignments as $assignmentData) {

                    Assignment::firstOrCreate(
                        [
                            'class_group_id' => $classGroup->id,
                            'topic_id' => $topic->id,
                            'title' => $assignmentData['title'],
                        ],
                        [
                            'user_id' => $professor->id,
                            'description' => $assignmentData['description'],
                            'due_date' => $assignmentData['due_date'],
                            'due_time' => $assignmentData['due_time'],
                            'points' => $assignmentData['points'],
                            'google_form_url' => null,
                        ]
                    );
                }
            }
        }

        $this->command->info('Assignments seeded successfully.');
    }
}