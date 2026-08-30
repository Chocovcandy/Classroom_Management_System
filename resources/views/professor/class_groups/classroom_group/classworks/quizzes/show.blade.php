@extends('layouts.prof_layout')

@section('content')

<div class="classwork-show-page">

    {{-- HEADER --}}

    <div class="classwork-show-header">

        <a
            href="{{ route(
                'professor.class-groups.classroom-group.classwork',
                $classGroup
            ) }}"
            class="classwork-back-btn"
        >
            <i class="bx bx-arrow-back"></i>
            Back to Classwork
        </a>

        <div class="classwork-show-heading">

            <div class="classwork-show-icon quiz">
                <i class="bx bx-help-circle"></i>
            </div>

            <div>

                <span class="classwork-show-type quiz">
                    QUIZ
                </span>

                <h1>
                    {{ $quiz->title }}
                </h1>

                @if($quiz->topic)

                    <div class="classwork-show-topic">

                        <i class="bx bx-folder"></i>

                        {{ $quiz->topic->topic_name }}

                    </div>

                @endif

            </div>

        </div>

    </div>


    <div class="classwork-show-grid">

        <div class="classwork-show-main">

            {{-- DESCRIPTION --}}

            <section class="classwork-detail-card">

                <div class="classwork-detail-card-header">

                    <h2>
                        Quiz Instructions
                    </h2>

                </div>

                <div class="classwork-description">

                    @if($quiz->description)

                        {!! nl2br(e($quiz->description)) !!}

                    @else

                        <span class="classwork-no-content">
                            No description provided.
                        </span>

                    @endif

                </div>

            </section>


            {{-- STUDENT ATTEMPTS --}}

            <section class="classwork-detail-card">

                <div class="classwork-detail-card-header">

                    <h2>
                        Student Attempts
                    </h2>

                </div>

                <div class="submission-summary">

                    <div class="submission-summary-icon">
                        <i class="bx bx-group"></i>
                    </div>

                    <div>

                        <strong>
                            0 / {{ $classGroup->students->count() }}
                        </strong>

                        <span>
                            Students completed
                        </span>

                    </div>

                </div>

                <div class="submission-placeholder">

                    <i class="bx bx-time-five"></i>

                    <p>
                        Student quiz results will appear here later.
                    </p>

                </div>

            </section>

        </div>


        {{-- SIDEBAR --}}

        <aside class="classwork-show-sidebar">

            <section class="classwork-detail-card">

                <div class="classwork-detail-card-header">

                    <h2>
                        Quiz Details
                    </h2>

                </div>

                <div class="classwork-info-list">

                    <div class="classwork-info-item">

                        <i class="bx bx-star"></i>

                        <div>

                            <span>Points</span>

                            <strong>
                                {{ $quiz->points ?? 0 }}
                            </strong>

                        </div>

                    </div>


                    @if($quiz->due_date)

                    <div class="classwork-info-item">

                        <i class="bx bx-calendar"></i>

                        <div>

                            <span>Due Date</span>

                            <strong>
                                {{ \Carbon\Carbon::parse($quiz->due_date)->format('M d, Y') }}
                            </strong>

                        </div>

                    </div>

                    @endif


                    @if($quiz->due_time)

                    <div class="classwork-info-item">

                        <i class="bx bx-time"></i>

                        <div>

                            <span>Due Time</span>

                            <strong>
                                {{ \Carbon\Carbon::parse($quiz->due_time)->format('h:i A') }}
                            </strong>

                        </div>

                    </div>

                    @endif

                </div>

            </section>


            <section class="classwork-detail-card">

                <div class="classwork-detail-card-header">

                    <h2>
                        Actions
                    </h2>

                </div>
                <a
                    href="{{ route(
                        'professor.class-groups.quizzes.edit',
                        [
                            'classGroup' => $classGroup->id,
                            'quiz' => $quiz->id,
                        ]
                    ) }}"
                    class="classwork-action-btn"
                >
                    <i class="bx bx-edit"></i>
                    Edit Quiz
                </a>

            </section>

        </aside>

    </div>

</div>

@endsection