<?php

namespace Database\Seeders;

use App\Models\ClassGroup;
use App\Models\Exam;
use App\Models\Topic;
use App\Models\User;
use Illuminate\Database\Seeder;

class ExamSeeder extends Seeder
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

                $exams = [
                    'Introduction' => [
                        [
                            'title' => 'Web Development Midterm Exam',
                            'description' => 'Midterm examination covering HTML, web fundamentals, and basic web development concepts.',
                            'points' => 50,
                            'due_date' => '2026-10-20',
                            'due_time' => '23:59:00',
                        ],
                    ],

                    'Core Concepts' => [
                        [
                            'title' => 'Web Technologies Final Exam',
                            'description' => 'Final examination covering CSS, JavaScript, and core web development concepts.',
                            'points' => 100,
                            'due_date' => '2026-12-15',
                            'due_time' => '23:59:00',
                        ],
                    ],

                    'Practical Work' => [
                        [
                            'title' => 'Web Development Practical Exam',
                            'description' => 'Practical examination requiring students to build a working web page.',
                            'points' => 50,
                            'due_date' => '2026-11-10',
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

                $exams = [
                    'Introduction' => [
                        [
                            'title' => 'Database Midterm Exam',
                            'description' => 'Midterm examination covering database fundamentals, tables, records, and relationships.',
                            'points' => 50,
                            'due_date' => '2026-10-21',
                            'due_time' => '23:59:00',
                        ],
                    ],

                    'Core Concepts' => [
                        [
                            'title' => 'SQL and Database Final Exam',
                            'description' => 'Final examination covering SQL, database relationships, and database design.',
                            'points' => 100,
                            'due_date' => '2026-12-16',
                            'due_time' => '23:59:00',
                        ],
                    ],

                    'Practical Work' => [
                        [
                            'title' => 'Database Practical Exam',
                            'description' => 'Practical examination requiring students to create and query a relational database.',
                            'points' => 50,
                            'due_date' => '2026-11-11',
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

                $exams = [
                    'Introduction' => [
                        [
                            'title' => 'Software Engineering Midterm Exam',
                            'description' => 'Midterm examination covering software engineering fundamentals and development processes.',
                            'points' => 50,
                            'due_date' => '2026-10-22',
                            'due_time' => '23:59:00',
                        ],
                    ],

                    'Core Concepts' => [
                        [
                            'title' => 'Software Engineering Final Exam',
                            'description' => 'Final examination covering SDLC, requirements engineering, and software project management.',
                            'points' => 100,
                            'due_date' => '2026-12-17',
                            'due_time' => '23:59:00',
                        ],
                    ],

                    'Practical Work' => [
                        [
                            'title' => 'Software Project Practical Exam',
                            'description' => 'Practical examination requiring students to analyze and plan a software project.',
                            'points' => 50,
                            'due_date' => '2026-11-12',
                            'due_time' => '23:59:00',
                        ],
                    ],
                ];
            }

            /*
            |--------------------------------------------------------------------------
            | Create Exams
            |--------------------------------------------------------------------------
            */

            foreach ($exams as $topicName => $topicExams) {

                $topic = Topic::where('class_group_id', $classGroup->id)
                    ->where('topic_name', $topicName)
                    ->first();

                if (!$topic) {
                    continue;
                }

                foreach ($topicExams as $examData) {

                    Exam::firstOrCreate(
                        [
                            'class_group_id' => $classGroup->id,
                            'topic_id' => $topic->id,
                            'title' => $examData['title'],
                        ],
                        [
                            'user_id' => $professor->id,
                            'description' => $examData['description'],
                            'due_date' => $examData['due_date'],
                            'due_time' => $examData['due_time'],
                            'points' => $examData['points'],
                            'google_form_url' => null,
                        ]
                    );
                }
            }
        }

        $this->command->info('Exams seeded successfully.');
    }
}