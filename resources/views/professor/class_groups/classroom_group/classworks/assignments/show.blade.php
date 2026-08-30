@extends('layouts.prof_layout')

@section('content')

<div class="classwork-show-page">

    {{-- ============================================================
        HEADER
    ============================================================ --}}

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

            <div class="classwork-show-icon assignment">
                <i class="bx bx-task"></i>
            </div>

            <div>

                <span class="classwork-show-type assignment">
                    ASSIGNMENT
                </span>

                <h1>
                    {{ $assignment->title }}
                </h1>

                @if($assignment->topic)

                    <div class="classwork-show-topic">

                        <i class="bx bx-folder"></i>

                        {{ $assignment->topic->topic_name }}

                    </div>

                @endif

            </div>

        </div>

    </div>


    {{-- ============================================================
        CONTENT
    ============================================================ --}}

    <div class="classwork-show-grid">

        <div class="classwork-show-main">

            {{-- DESCRIPTION --}}

            <section class="classwork-detail-card">

                <div class="classwork-detail-card-header">

                    <h2>
                        Assignment Instructions
                    </h2>

                </div>

                <div class="classwork-description">

                    {!! nl2br(e($assignment->description)) !!}

                </div>

            </section>


            {{-- SUBMISSIONS --}}

            <section class="classwork-detail-card">

                <div class="classwork-detail-card-header">

                    <h2>
                        Student Submissions
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
                            Students submitted
                        </span>

                    </div>

                </div>

                <div class="submission-placeholder">

                    <i class="bx bx-time-five"></i>

                    <p>
                        Student submission details will appear here.
                    </p>

                </div>

            </section>

        </div>


        {{-- SIDEBAR --}}

        <aside class="classwork-show-sidebar">

            {{-- ASSIGNMENT INFORMATION --}}

            <section class="classwork-detail-card">

                <div class="classwork-detail-card-header">

                    <h2>
                        Assignment Details
                    </h2>

                </div>

                <div class="classwork-info-list">

                    <div class="classwork-info-item">

                        <i class="bx bx-star"></i>

                        <div>

                            <span>Points</span>

                            <strong>
                                {{ $assignment->points ?? 0 }}
                            </strong>

                        </div>

                    </div>


                    <div class="classwork-info-item">

                        <i class="bx bx-calendar"></i>

                        <div>

                            <span>Due Date</span>

                            <strong>
                                {{ \Carbon\Carbon::parse($assignment->due_date)->format('M d, Y') }}
                            </strong>

                        </div>

                    </div>


                    @if($assignment->due_time)

                    <div class="classwork-info-item">

                        <i class="bx bx-time"></i>

                        <div>

                            <span>Due Time</span>

                            <strong>
                                {{ \Carbon\Carbon::parse($assignment->due_time)->format('h:i A') }}
                            </strong>

                        </div>

                    </div>

                    @endif

                </div>

            </section>


            {{-- ACTIONS --}}

            <section class="classwork-detail-card">

                <div class="classwork-detail-card-header">

                    <h2>
                        Actions
                    </h2>

                </div>

                <a
                    href="{{ route(
                        'professor.class-groups.assignments.edit',
                        [
                            'classGroup' => $classGroup->id,
                            'assignment' => $assignment->id
                        ]
                    ) }}"
                    class="classwork-action-btn"
                >
                    <i class="bx bx-edit"></i>
                    Edit Assignment
                </a>

            </section>

        </aside>

    </div>

</div>

@endsection