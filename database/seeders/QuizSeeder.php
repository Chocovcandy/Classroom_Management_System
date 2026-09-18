<?php

namespace Database\Seeders;

use App\Models\ClassGroup;
use App\Models\Quiz;
use App\Models\Topic;
use App\Models\User;
use Illuminate\Database\Seeder;

class QuizSeeder extends Seeder
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

                $quizzes = [
                    'Introduction' => [
                        [
                            'title' => 'HTML Basics Quiz',
                            'description' => 'Quiz covering basic HTML elements, tags, and document structure.',
                            'points' => 10,
                            'due_date' => '2026-09-21',
                            'due_time' => '23:59:00',
                        ],
                    ],

                    'Core Concepts' => [
                        [
                            'title' => 'CSS Fundamentals Quiz',
                            'description' => 'Quiz covering CSS selectors, properties, and basic layouts.',
                            'points' => 15,
                            'due_date' => '2026-09-28',
                            'due_time' => '23:59:00',
                        ],
                        [
                            'title' => 'JavaScript Basics Quiz',
                            'description' => 'Quiz covering variables, functions, conditions, and basic JavaScript syntax.',
                            'points' => 15,
                            'due_date' => '2026-10-05',
                            'due_time' => '23:59:00',
                        ],
                    ],

                    'Practical Work' => [
                        [
                            'title' => 'Web Development Review Quiz',
                            'description' => 'Review quiz covering HTML, CSS, and JavaScript concepts.',
                            'points' => 20,
                            'due_date' => '2026-10-12',
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

                $quizzes = [
                    'Introduction' => [
                        [
                            'title' => 'Database Fundamentals Quiz',
                            'description' => 'Quiz covering basic database concepts and database management systems.',
                            'points' => 10,
                            'due_date' => '2026-09-22',
                            'due_time' => '23:59:00',
                        ],
                    ],

                    'Core Concepts' => [
                        [
                            'title' => 'SQL Fundamentals Quiz',
                            'description' => 'Quiz covering SQL commands and basic database queries.',
                            'points' => 15,
                            'due_date' => '2026-09-29',
                            'due_time' => '23:59:00',
                        ],
                        [
                            'title' => 'Database Relationships Quiz',
                            'description' => 'Quiz covering primary keys, foreign keys, and database relationships.',
                            'points' => 15,
                            'due_date' => '2026-10-06',
                            'due_time' => '23:59:00',
                        ],
                    ],

                    'Practical Work' => [
                        [
                            'title' => 'SQL Practice Quiz',
                            'description' => 'Quiz reviewing SQL queries and practical database operations.',
                            'points' => 20,
                            'due_date' => '2026-10-13',
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

                $quizzes = [
                    'Introduction' => [
                        [
                            'title' => 'Software Engineering Basics Quiz',
                            'description' => 'Quiz covering basic software engineering principles and concepts.',
                            'points' => 10,
                            'due_date' => '2026-09-23',
                            'due_time' => '23:59:00',
                        ],
                    ],

                    'Core Concepts' => [
                        [
                            'title' => 'SDLC Quiz',
                            'description' => 'Quiz covering the stages and activities of the Software Development Life Cycle.',
                            'points' => 15,
                            'due_date' => '2026-09-30',
                            'due_time' => '23:59:00',
                        ],
                        [
                            'title' => 'Requirements Engineering Quiz',
                            'description' => 'Quiz covering functional and non-functional requirements.',
                            'points' => 15,
                            'due_date' => '2026-10-07',
                            'due_time' => '23:59:00',
                        ],
                    ],

                    'Practical Work' => [
                        [
                            'title' => 'Software Project Planning Quiz',
                            'description' => 'Quiz reviewing software project planning and development practices.',
                            'points' => 20,
                            'due_date' => '2026-10-14',
                            'due_time' => '23:59:00',
                        ],
                    ],
                ];
            }

            /*
            |--------------------------------------------------------------------------
            | Create Quizzes
            |--------------------------------------------------------------------------
            */

            foreach ($quizzes as $topicName => $topicQuizzes) {

                $topic = Topic::where('class_group_id', $classGroup->id)
                    ->where('topic_name', $topicName)
                    ->first();

                if (!$topic) {
                    continue;
                }

                foreach ($topicQuizzes as $quizData) {

                    Quiz::firstOrCreate(
                        [
                            'class_group_id' => $classGroup->id,
                            'topic_id' => $topic->id,
                            'title' => $quizData['title'],
                        ],
                        [
                            'user_id' => $professor->id,
                            'description' => $quizData['description'],
                            'due_date' => $quizData['due_date'],
                            'due_time' => $quizData['due_time'],
                            'points' => $quizData['points'],
                            'google_form_url' => null,
                        ]
                    );
                }
            }
        }

        $this->command->info('Quizzes seeded successfully.');
    }
}