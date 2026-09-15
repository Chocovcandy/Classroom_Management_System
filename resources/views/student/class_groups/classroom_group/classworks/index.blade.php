<style>
/* ============================================================
   STUDENT CLASSWORK
   ============================================================ */

.classwork-page {
    --material-color: #4f7df3;
    --material-soft: rgba(79, 125, 243, 0.10);

    --assignment-color: #22b07d;
    --assignment-soft: rgba(34, 176, 125, 0.10);

    --quiz-color: #9b5de5;
    --quiz-soft: rgba(155, 93, 229, 0.10);

    --exam-color: #e25555;
    --exam-soft: rgba(226, 85, 85, 0.10);

    /* Project = Yellow */
    --project-color: #eab308;
    --project-soft: rgba(234, 179, 8, 0.10);

    --topic-color: #3b82f6;
    --topic-soft: rgba(59, 130, 246, 0.09);

    --classwork-date-color: var(--secondary-text-color);

    width: 100%;
    min-height: 100%;
    box-sizing: border-box;
}


/* ============================================================
   DARK MODE
   ============================================================ */

.dark-mode .classwork-page {
    --material-color: #7fa3ff;
    --material-soft: rgba(127, 163, 255, 0.14);

    --assignment-color: #55d6a5;
    --assignment-soft: rgba(85, 214, 165, 0.14);

    --quiz-color: #c18af2;
    --quiz-soft: rgba(193, 138, 242, 0.14);

    --exam-color: #ff8d8d;
    --exam-soft: rgba(255, 141, 141, 0.14);

    --project-color: #facc15;
    --project-soft: rgba(250, 204, 21, 0.14);

    --topic-color: #8fa8ff;
    --topic-soft: rgba(143, 168, 255, 0.14);

    --classwork-date-color: var(--secondary-text-color);
}


/* ============================================================
   HEADER
   ============================================================ */

.classwork-header-row {
    width: calc(100% - 10px);
    margin-top: 8px;
    box-sizing: border-box;
}

.classwork-header {
    position: relative;

    display: flex;
    align-items: center;
    justify-content: space-between;

    min-height: 170px;
    padding: 22px 26px;

    overflow: hidden;
    box-sizing: border-box;

    background-color: var(--card-color);
    border: 1px solid var(--border-color);
    border-radius: 15px;
}

.classwork-header-content {
    position: relative;
    z-index: 2;
    min-width: 0;
}

.classwork-eyebrow {
    display: block;
    margin-bottom: 6px;

    color: var(--button-color);

    font-size: 10px;
    font-weight: 800;
    letter-spacing: 1.2px;
}

.classwork-header h1 {
    margin: 0;

    color: var(--heading-color);

    font-size: 25px;
    font-weight: 800;
    line-height: 1.25;
}

.classwork-header p {
    max-width: 520px;
    margin: 7px 0 0;

    color: var(--secondary-text-color);

    font-size: 13px;
    line-height: 1.5;
}


/* ============================================================
   HEADER ILLUSTRATION
   ============================================================ */

.classwork-header-illustration {
    position: relative;

    display: flex;
    align-items: center;
    justify-content: center;

    width: 175px;
    height: 125px;

    margin-left: 20px;
    flex-shrink: 0;
}

.classwork-illustration-circle {
    position: absolute;

    width: 105px;
    height: 105px;

    background-color: var(--topic-soft);

    border: 1px solid var(--primary-border);
    border-radius: 50%;
}

.classwork-document {
    position: relative;
    z-index: 2;

    display: flex;
    flex-direction: column;

    width: 72px;
    height: 88px;

    padding: 18px 13px;

    box-sizing: border-box;

    background-color: var(--card-color);
    border: 1px solid var(--border-color);
    border-radius: 10px;

    box-shadow: 0 8px 20px var(--shadow-color);

    transform: rotate(2deg);

    animation: classworkDocumentFloat 4s ease-in-out infinite;
}

.document-line {
    width: 100%;
    height: 5px;

    margin-bottom: 8px;

    background-color: var(--border-color);
    border-radius: 5px;
}

.document-line-one {
    width: 70%;
}

.document-line-two {
    width: 90%;
}

.document-line-three {
    width: 55%;
}

.document-check {
    display: flex;
    align-items: center;
    justify-content: center;

    width: 22px;
    height: 22px;

    margin-top: auto;

    color: var(--assignment-color);
    background-color: var(--assignment-soft);

    border-radius: 6px;

    font-size: 14px;
}

.classwork-illustration-icon {
    position: absolute;
    z-index: 3;

    display: flex;
    align-items: center;
    justify-content: center;

    width: 34px;
    height: 34px;

    background-color: var(--card-color);
    border: 1px solid var(--border-color);
    border-radius: 9px;

    box-shadow: 0 5px 15px var(--shadow-color);

    font-size: 17px;
}

.illustration-book {
    top: 5px;
    right: 17px;

    color: var(--material-color);

    transform: rotate(8deg);

    animation: classworkBookFloat 3.2s ease-in-out infinite;
}

.illustration-assignment {
    bottom: 8px;
    left: 18px;

    color: var(--assignment-color);

    transform: rotate(-7deg);

    animation: classworkAssignmentFloat 3.5s ease-in-out infinite;
}

.illustration-pencil {
    top: 30px;
    left: 6px;

    color: var(--quiz-color);

    transform: rotate(-12deg);

    animation: classworkPencilFloat 3.8s ease-in-out infinite;
}

.illustration-check {
    right: 2px;
    bottom: 15px;

    color: var(--project-color);

    transform: rotate(6deg);

    animation: classworkCheckFloat 3.4s ease-in-out infinite;
}


/* ============================================================
   HEADER ANIMATIONS
   ============================================================ */

@keyframes classworkDocumentFloat {
    0%, 100% {
        transform: translateY(0) rotate(2deg);
    }

    50% {
        transform: translateY(-4px) rotate(-1deg);
    }
}

@keyframes classworkBookFloat {
    0%, 100% {
        transform: translateY(0) rotate(8deg);
    }

    50% {
        transform: translateY(-5px) rotate(3deg);
    }
}

@keyframes classworkAssignmentFloat {
    0%, 100% {
        transform: translateY(0) rotate(-7deg);
    }

    50% {
        transform: translateY(4px) rotate(-3deg);
    }
}

@keyframes classworkPencilFloat {
    0%, 100% {
        transform: translateY(0) rotate(-12deg);
    }

    50% {
        transform: translateY(-4px) rotate(-7deg);
    }
}

@keyframes classworkCheckFloat {
    0%, 100% {
        transform: translateY(0) rotate(6deg);
    }

    50% {
        transform: translateY(4px) rotate(2deg);
    }
}


/* ============================================================
   FILTER
   ============================================================ */

.classwork-filter {
    display: flex;
    align-items: center;
    gap: 7px;

    width: calc(100% - 10px);

    margin-top: 14px;
    padding: 4px;

    box-sizing: border-box;

    overflow-x: auto;

    scrollbar-width: none;
}

.classwork-filter::-webkit-scrollbar {
    display: none;
}

.classwork-filter-item {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 7px;

    min-width: 88px;
    height: 37px;

    padding: 0 13px;

    flex-shrink: 0;

    color: var(--secondary-text-color);
    background-color: transparent;

    border: 1px solid transparent;
    border-radius: 9px;

    font-family: inherit;
    font-size: 11px;
    font-weight: 700;

    cursor: pointer;

    transition:
        color 0.2s ease,
        background-color 0.2s ease,
        border-color 0.2s ease;
}

.classwork-filter-item i {
    font-size: 16px;
}

.classwork-filter-item:hover {
    color: var(--heading-color);
    background-color: var(--surface-hover);
}

.classwork-filter-item.active {
    color: var(--button-color);
    background-color: var(--card-color);

    border-color: var(--border-color);

    box-shadow: 0 2px 7px var(--shadow-color);
}


/* ============================================================
   CONTENT
   ============================================================ */

.classwork-content {
    display: flex;
    flex-direction: column;
    gap: 12px;

    width: calc(100% - 10px);

    margin-top: 10px;
    padding-bottom: 30px;

    box-sizing: border-box;
}


/* ============================================================
   TOPIC CARD
   ============================================================ */

.classwork-topic {
    width: 100%;

    background-color: var(--card-color);

    border: 1px solid var(--border-color);
    border-radius: 13px;

    overflow: hidden;

    transition:
        border-color 0.2s ease,
        box-shadow 0.2s ease;
}

.classwork-topic:hover {
    border-color: var(--primary-border);
}


/* ============================================================
   TOPIC HEADER
   ============================================================ */

.classwork-topic-header {
    display: flex;
    align-items: center;
    justify-content: space-between;

    min-height: 68px;

    padding: 10px 12px 10px 15px;

    box-sizing: border-box;

    cursor: pointer;

    transition: background-color 0.2s ease;
}

.classwork-topic-header:hover {
    background-color: var(--surface-color);
}

.classwork-topic-info {
    display: flex;
    align-items: center;
    gap: 12px;

    min-width: 0;
}

.classwork-topic-icon {
    display: flex;
    align-items: center;
    justify-content: center;

    width: 39px;
    height: 39px;

    flex-shrink: 0;

    color: var(--topic-color);
    background-color: var(--topic-soft);

    border: 1px solid var(--primary-border);
    border-radius: 10px;

    font-size: 19px;
}

.classwork-topic-icon.no-topic {
    color: var(--secondary-text-color);
    background-color: var(--surface-color);

    border-color: var(--border-color);
}

.classwork-topic-text {
    min-width: 0;
}

.classwork-topic-text h2 {
    margin: 0;

    color: var(--heading-color);

    font-size: 15px;
    font-weight: 800;
    line-height: 1.3;

    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}

.classwork-topic-text p {
    margin: 3px 0 0;

    color: var(--secondary-text-color);

    font-size: 10px;
    line-height: 1.4;

    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}


/* ============================================================
   TOPIC TOGGLE
   ============================================================ */

.classwork-topic-actions {
    display: flex;
    align-items: center;
    gap: 3px;

    flex-shrink: 0;
    margin-left: 12px;
}

.classwork-topic-toggle {
    display: flex;
    align-items: center;
    justify-content: center;

    width: 34px;
    height: 34px;

    padding: 0;

    color: var(--secondary-text-color);
    background-color: transparent;

    border: 1px solid transparent;
    border-radius: 8px;

    cursor: pointer;

    transition:
        color 0.2s ease,
        background-color 0.2s ease,
        border-color 0.2s ease;
}

.classwork-topic-toggle i {
    font-size: 20px;
}

.classwork-topic-toggle:hover {
    color: var(--heading-color);
    background-color: var(--surface-hover);

    border-color: var(--border-color);
}


/* ============================================================
   CLASSWORK ITEMS
   ============================================================ */

.classwork-topic-items {
    padding: 0 10px 10px;
}

.classwork-item {
    position: relative;

    display: flex;
    align-items: center;

    min-height: 64px;

    padding: 8px 8px 8px 10px;

    box-sizing: border-box;

    border-top: 1px solid var(--border-color);

    text-decoration: none;

    transition:
        background-color 0.2s ease,
        padding-left 0.2s ease;
}

.classwork-item:hover {
    background-color: var(--surface-color);
    padding-left: 13px;
}


/* ============================================================
   ITEM ICON
   ============================================================ */

.classwork-item-icon {
    display: flex;
    align-items: center;
    justify-content: center;

    width: 38px;
    height: 38px;

    margin-right: 12px;

    flex-shrink: 0;

    border-radius: 10px;

    font-size: 18px;
}

.classwork-item-icon.material {
    color: var(--material-color);
    background-color: var(--material-soft);
}

.classwork-item-icon.assignment {
    color: var(--assignment-color);
    background-color: var(--assignment-soft);
}

.classwork-item-icon.quiz {
    color: var(--quiz-color);
    background-color: var(--quiz-soft);
}

.classwork-item-icon.exam {
    color: var(--exam-color);
    background-color: var(--exam-soft);
}

.classwork-item-icon.project {
    color: var(--project-color);
    background-color: var(--project-soft);
}


/* ============================================================
   ITEM CONTENT
   ============================================================ */

.classwork-item-content {
    min-width: 0;
    flex: 1;
}

.classwork-item-content h3 {
    margin: 0;

    color: var(--heading-color);

    font-size: 13px;
    font-weight: 700;
    line-height: 1.35;

    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}

.classwork-item-content p {
    display: flex;
    align-items: center;
    flex-wrap: wrap;
    gap: 6px;

    margin: 4px 0 0;

    font-size: 10px;
    line-height: 1.3;
}

.classwork-item-type {
    font-weight: 700;
}

.classwork-item-type.material {
    color: var(--material-color);
}

.classwork-item-type.assignment {
    color: var(--assignment-color);
}

.classwork-item-type.quiz {
    color: var(--quiz-color);
}

.classwork-item-type.exam {
    color: var(--exam-color);
}

.classwork-item-type.project {
    color: var(--project-color);
}

.classwork-item-separator {
    color: var(--border-color);
}

.classwork-item-date {
    color: var(--classwork-date-color);
    font-weight: 500;
}


/* ============================================================
   EMPTY TOPIC
   ============================================================ */

.classwork-topic-empty {
    display: flex;
    align-items: center;
    gap: 8px;

    min-height: 48px;

    padding: 8px 10px;

    color: var(--secondary-text-color);

    font-size: 11px;
}

.classwork-topic-empty i {
    color: var(--topic-color);
    font-size: 17px;
}


/* ============================================================
   EMPTY PAGE
   ============================================================ */

.classwork-empty {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;

    min-height: 260px;

    padding: 30px;

    box-sizing: border-box;

    text-align: center;

    background-color: var(--card-color);

    border: 1px solid var(--border-color);
    border-radius: 14px;
}

.classwork-empty-icon {
    display: flex;
    align-items: center;
    justify-content: center;

    width: 52px;
    height: 52px;

    margin-bottom: 12px;

    color: var(--topic-color);
    background-color: var(--topic-soft);

    border-radius: 13px;

    font-size: 26px;
}

.classwork-empty h2 {
    margin: 0;

    color: var(--heading-color);

    font-size: 17px;
    font-weight: 800;
}

.classwork-empty p {
    max-width: 420px;

    margin: 7px 0 0;

    color: var(--secondary-text-color);

    font-size: 12px;
    line-height: 1.6;
}


/* ============================================================
   RESPONSIVE
   ============================================================ */

@media (max-width: 600px) {

    .classwork-header {
        min-height: 145px;
        padding: 20px;
    }

    .classwork-header-illustration {
        width: 120px;
        height: 100px;
        margin-left: 10px;
    }

    .classwork-illustration-circle {
        width: 85px;
        height: 85px;
    }

    .classwork-header h1 {
        font-size: 22px;
    }

    .classwork-header p {
        font-size: 12px;
    }
}


@media (max-width: 480px) {

    .classwork-header-illustration {
        display: none;
    }

    .classwork-filter-item {
        min-width: 78px;
        padding: 0 10px;
    }

    .classwork-topic-header {
        min-height: 62px;
        padding-left: 11px;
    }

    .classwork-topic-icon {
        width: 35px;
        height: 35px;
    }

    .classwork-topic-text h2 {
        font-size: 14px;
    }

    .classwork-item {
        min-height: 60px;
    }

    .classwork-item-icon {
        width: 35px;
        height: 35px;
        margin-right: 9px;
    }

    .classwork-item-content h3 {
        font-size: 12px;
    }

    .classwork-item-content p {
        font-size: 9px;
    }
}
</style>


@extends('layouts.student_layout')

@section('title', 'Classwork')

@section('content')

<div class="classwork-page">

    {{-- ============================================================
         CLASSROOM NAVIGATION
         ============================================================ --}}
    @include('student.class_groups.classroom_group.navigation')


    {{-- ============================================================
         HEADER
         ============================================================ --}}

    <div class="classwork-header-row">

        <section class="classwork-header">

            <div class="classwork-header-content">

                <span class="classwork-eyebrow">
                    CLASSWORK
                </span>

                <h1>
                    Classwork
                </h1>

                <p>
                    View your learning materials, assignments, quizzes,
                    exams, and projects for {{ $classGroup->group_name }}.
                </p>

            </div>


            {{-- HEADER ILLUSTRATION --}}

            <div class="classwork-header-illustration">

                <div class="classwork-illustration-circle"></div>

                <div class="classwork-illustration-icon illustration-book">
                    <i class="bx bx-book-open"></i>
                </div>

                <div class="classwork-illustration-icon illustration-assignment">
                    <i class="bx bx-task"></i>
                </div>

                <div class="classwork-illustration-icon illustration-pencil">
                    <i class="bx bx-edit"></i>
                </div>

                <div class="classwork-illustration-icon illustration-check">
                    <i class="bx bx-git-branch"></i>
                </div>

                <div class="classwork-document">

                    <div class="document-line document-line-one"></div>
                    <div class="document-line document-line-two"></div>
                    <div class="document-line document-line-three"></div>

                    <div class="document-check">
                        <i class="bx bx-check"></i>
                    </div>

                </div>

            </div>

        </section>

    </div>


    {{-- ============================================================
         FILTER
         ============================================================ --}}

    <nav class="classwork-filter">

        <button
            type="button"
            class="classwork-filter-item active"
            data-filter="all"
        >
            <i class="bx bx-grid-alt"></i>
            <span>All</span>
        </button>


        <button
            type="button"
            class="classwork-filter-item"
            data-filter="materials"
        >
            <i class="bx bx-book-open"></i>
            <span>Materials</span>
        </button>


        <button
            type="button"
            class="classwork-filter-item"
            data-filter="assignments"
        >
            <i class="bx bx-task"></i>
            <span>Assignments</span>
        </button>


        <button
            type="button"
            class="classwork-filter-item"
            data-filter="quiz"
        >
            <i class="bx bx-help-circle"></i>
            <span>Quiz</span>
        </button>


        <button
            type="button"
            class="classwork-filter-item"
            data-filter="exam"
        >
            <i class="bx bx-edit"></i>
            <span>Exam</span>
        </button>


        {{-- NEW PROJECT FILTER --}}

        <button
            type="button"
            class="classwork-filter-item"
            data-filter="projects"
        >
            <i class="bx bx-git-branch"></i>
            <span>Projects</span>
        </button>

    </nav>


    {{-- ============================================================
         CLASSWORK CONTENT
         ============================================================ --}}

    <main class="classwork-content">


        {{-- ========================================================
             TOPIC CLASSWORK
             ======================================================== --}}

        @foreach($classGroup->topics as $topic)

            @php
                /*
                |--------------------------------------------------------------------------
                | PROJECTS VISIBLE TO THIS STUDENT
                |--------------------------------------------------------------------------
                | Individual projects are visible to every student.
                | Team projects are visible only when this student is
                | assigned to a team for that project.
                */
                $visibleProjects = $topic->projects()
                    ->where(function ($query) {
                        $query->where('project_type', 'individual')
                            ->orWhere(function ($teamQuery) {
                                $teamQuery
                                    ->where('project_type', 'team')
                                    ->whereHas('groups.members', function ($memberQuery) {
                                        $memberQuery->where(
                                            'user_id',
                                            auth()->id()
                                        );
                                    });
                            });
                    })
                    ->latest()
                    ->get();

                $hasClasswork =
                    $topic->materials->count() ||
                    $topic->assignments->count() ||
                    $topic->quizzes->count() ||
                    $topic->exams->count() ||
                    $visibleProjects->count();
            @endphp


            <section
                class="classwork-topic"
                data-topic-card
            >


                {{-- TOPIC HEADER --}}

                <div
                    class="classwork-topic-header"
                    data-topic-toggle
                >

                    <div class="classwork-topic-info">

                        <div class="classwork-topic-icon">
                            <i class="bx bx-folder"></i>
                        </div>


                        <div class="classwork-topic-text">

                            <h2>
                                {{ $topic->topic_name }}
                            </h2>

                            @if($topic->description)

                                <p>
                                    {{ $topic->description }}
                                </p>

                            @endif

                        </div>

                    </div>


                    <div class="classwork-topic-actions">

                        <button
                            type="button"
                            class="classwork-topic-toggle"
                            aria-label="Toggle topic"
                            aria-expanded="true"
                        >
                            <i class="bx bx-chevron-up"></i>
                        </button>

                    </div>

                </div>


                {{-- TOPIC ITEMS --}}

                <div class="classwork-topic-items">


                    {{-- =================================================
                         MATERIALS
                         ================================================= --}}

                    @foreach($topic->materials as $material)

                        <a
                            href="{{ route(
                                'student.class-groups.materials.show',
                                [
                                    'classGroup' => $classGroup->id,
                                    'material' => $material->id,
                                ]
                            ) }}"
                            class="classwork-item material"
                            data-classwork-type="materials"
                        >

                            <div class="classwork-item-icon material">
                                <i class="bx bx-book-open"></i>
                            </div>


                            <div class="classwork-item-content">

                                <h3>
                                    {{ $material->title }}
                                </h3>

                                <p>

                                    <span class="classwork-item-type material">
                                        Material
                                    </span>

                                    <span class="classwork-item-separator">
                                        •
                                    </span>

                                    <span class="classwork-item-date">
                                        {{ $material->created_at->format('M d, Y') }}
                                    </span>

                                </p>

                            </div>

                        </a>

                    @endforeach


                    {{-- =================================================
                         ASSIGNMENTS
                         ================================================= --}}

                    @foreach($topic->assignments as $assignment)

                        <a
                            href="{{ route(
                                'student.class-groups.assignments.show',
                                [
                                    'classGroup' => $classGroup->id,
                                    'assignment' => $assignment->id,
                                ]
                            ) }}"
                            class="classwork-item assignment"
                            data-classwork-type="assignments"
                        >

                            <div class="classwork-item-icon assignment">
                                <i class="bx bx-task"></i>
                            </div>


                            <div class="classwork-item-content">

                                <h3>
                                    {{ $assignment->title }}
                                </h3>

                                <p>

                                    <span class="classwork-item-type assignment">
                                        Assignment
                                    </span>

                                    <span class="classwork-item-separator">
                                        •
                                    </span>

                                    <span class="classwork-item-date">
                                        {{ $assignment->created_at->format('M d, Y') }}
                                    </span>

                                    @if($assignment->due_date)

                                        <span class="classwork-item-separator">
                                            •
                                        </span>

                                        <span class="classwork-item-date">
                                            Due {{ $assignment->due_date->format('M d, Y') }}
                                        </span>

                                    @endif

                                </p>

                            </div>

                        </a>

                    @endforeach


                    {{-- =================================================
                         QUIZZES
                         ================================================= --}}

                    @foreach($topic->quizzes as $quiz)

                        <a
                            href="{{ route(
                                'student.class-groups.quizzes.show',
                                [
                                    'classGroup' => $classGroup->id,
                                    'quiz' => $quiz->id,
                                ]
                            ) }}"
                            class="classwork-item quiz"
                            data-classwork-type="quiz"
                        >

                            <div class="classwork-item-icon quiz">
                                <i class="bx bx-help-circle"></i>
                            </div>


                            <div class="classwork-item-content">

                                <h3>
                                    {{ $quiz->title }}
                                </h3>

                                <p>

                                    <span class="classwork-item-type quiz">
                                        Quiz
                                    </span>

                                    <span class="classwork-item-separator">
                                        •
                                    </span>

                                    <span class="classwork-item-date">
                                        {{ $quiz->created_at->format('M d, Y') }}
                                    </span>

                                </p>

                            </div>

                        </a>

                    @endforeach


                    {{-- =================================================
                         EXAMS
                         ================================================= --}}

                    @foreach($topic->exams as $exam)

                        <a
                            href="{{ route(
                                'student.class-groups.exams.show',
                                [
                                    'classGroup' => $classGroup->id,
                                    'exam' => $exam->id,
                                ]
                            ) }}"
                            class="classwork-item exam"
                            data-classwork-type="exam"
                        >

                            <div class="classwork-item-icon exam">
                                <i class="bx bx-edit-alt"></i>
                            </div>


                            <div class="classwork-item-content">

                                <h3>
                                    {{ $exam->title }}
                                </h3>

                                <p>

                                    <span class="classwork-item-type exam">
                                        Exam
                                    </span>

                                    <span class="classwork-item-separator">
                                        •
                                    </span>

                                    <span class="classwork-item-date">
                                        {{ $exam->created_at->format('M d, Y') }}
                                    </span>

                                </p>

                            </div>

                        </a>

                    @endforeach


                    {{-- =================================================
                         PROJECTS
                         ================================================= --}}

                    @foreach($visibleProjects as $project)

                        <a
                            href="{{ route(
                                'student.class-groups.projects.show',
                                [
                                    'classGroup' => $classGroup->id,
                                    'project' => $project->id,
                                ]
                            ) }}"
                            class="classwork-item project"
                            data-classwork-type="projects"
                        >

                            <div class="classwork-item-icon project">
                                <i class="bx bx-git-branch"></i>
                            </div>


                            <div class="classwork-item-content">

                                <h3>
                                    {{ $project->title }}
                                </h3>

                                <p>

                                    <span class="classwork-item-type project">
                                        Project
                                    </span>

                                    <span class="classwork-item-separator">
                                        •
                                    </span>

                                    <span class="classwork-item-date">
                                        {{ $project->created_at->format('M d, Y') }}
                                    </span>

                                    @if($project->due_date)

                                        <span class="classwork-item-separator">
                                            •
                                        </span>

                                        <span class="classwork-item-date">
                                            Due {{ $project->due_date->format('M d, Y') }}
                                        </span>

                                    @endif

                                </p>

                            </div>

                        </a>

                    @endforeach


                    {{-- EMPTY TOPIC --}}

                    @if(!$hasClasswork)

                        <div class="classwork-topic-empty">

                            <i class="bx bx-folder-open"></i>

                            <span>
                                No classwork in this topic yet.
                            </span>

                        </div>

                    @endif

                </div>

            </section>

        @endforeach



        {{-- ========================================================
             NO TOPIC CLASSWORK
             ======================================================== --}}

        @php

            $noTopicMaterials =
                $classGroup->materials->whereNull('topic_id');

            $noTopicAssignments =
                $classGroup->assignments->whereNull('topic_id');

            $noTopicQuizzes =
                $classGroup->quizzes->whereNull('topic_id');

            $noTopicExams =
                $classGroup->exams->whereNull('topic_id');

            /*
            |--------------------------------------------------------------------------
            | PROJECTS WITHOUT A TOPIC VISIBLE TO THIS STUDENT
            |--------------------------------------------------------------------------
            */
            $noTopicProjects = $classGroup->projects()
                ->whereNull('topic_id')
                ->where(function ($query) {
                    $query->where('project_type', 'individual')
                        ->orWhere(function ($teamQuery) {
                            $teamQuery
                                ->where('project_type', 'team')
                                ->whereHas('groups.members', function ($memberQuery) {
                                    $memberQuery->where(
                                        'user_id',
                                        auth()->id()
                                    );
                                });
                        });
                })
                ->latest()
                ->get();


            $hasNoTopicClasswork =
                $noTopicMaterials->count() ||
                $noTopicAssignments->count() ||
                $noTopicQuizzes->count() ||
                $noTopicExams->count() ||
                $noTopicProjects->count();

        @endphp


        @if($hasNoTopicClasswork)

            <section
                class="classwork-topic classwork-no-topic"
                data-topic-card
            >


                {{-- NO TOPIC HEADER --}}

                <div
                    class="classwork-topic-header"
                    data-topic-toggle
                >

                    <div class="classwork-topic-info">

                        <div class="classwork-topic-icon no-topic">
                            <i class="bx bx-folder-minus"></i>
                        </div>


                        <div class="classwork-topic-text">

                            <h2>
                                No topic
                            </h2>

                            <p>
                                Classwork not assigned to a topic
                            </p>

                        </div>

                    </div>


                    <div class="classwork-topic-actions">

                        <button
                            type="button"
                            class="classwork-topic-toggle"
                            aria-label="Toggle no topic"
                            aria-expanded="true"
                        >
                            <i class="bx bx-chevron-up"></i>
                        </button>

                    </div>

                </div>


                {{-- NO TOPIC ITEMS --}}

                <div class="classwork-topic-items">


                    {{-- MATERIALS --}}

                    @foreach($noTopicMaterials as $material)

                        <a
                            href="{{ route(
                                'student.class-groups.materials.show',
                                [
                                    'classGroup' => $classGroup->id,
                                    'material' => $material->id,
                                ]
                            ) }}"
                            class="classwork-item material"
                            data-classwork-type="materials"
                        >

                            <div class="classwork-item-icon material">
                                <i class="bx bx-book-open"></i>
                            </div>

                            <div class="classwork-item-content">

                                <h3>
                                    {{ $material->title }}
                                </h3>

                                <p>

                                    <span class="classwork-item-type material">
                                        Material
                                    </span>

                                    <span class="classwork-item-separator">
                                        •
                                    </span>

                                    <span class="classwork-item-date">
                                        {{ $material->created_at->format('M d, Y') }}
                                    </span>

                                </p>

                            </div>

                        </a>

                    @endforeach


                    {{-- ASSIGNMENTS --}}

                    @foreach($noTopicAssignments as $assignment)

                        <a
                            href="{{ route(
                                'student.class-groups.assignments.show',
                                [
                                    'classGroup' => $classGroup->id,
                                    'assignment' => $assignment->id,
                                ]
                            ) }}"
                            class="classwork-item assignment"
                            data-classwork-type="assignments"
                        >

                            <div class="classwork-item-icon assignment">
                                <i class="bx bx-task"></i>
                            </div>

                            <div class="classwork-item-content">

                                <h3>
                                    {{ $assignment->title }}
                                </h3>

                                <p>

                                    <span class="classwork-item-type assignment">
                                        Assignment
                                    </span>

                                    <span class="classwork-item-separator">
                                        •
                                    </span>

                                    <span class="classwork-item-date">
                                        {{ $assignment->created_at->format('M d, Y') }}
                                    </span>

                                    @if($assignment->due_date)

                                        <span class="classwork-item-separator">
                                            •
                                        </span>

                                        <span class="classwork-item-date">
                                            Due {{ $assignment->due_date->format('M d, Y') }}
                                        </span>

                                    @endif

                                </p>

                            </div>

                        </a>

                    @endforeach


                    {{-- QUIZZES --}}

                    @foreach($noTopicQuizzes as $quiz)

                        <a
                            href="{{ route(
                                'student.class-groups.quizzes.show',
                                [
                                    'classGroup' => $classGroup->id,
                                    'quiz' => $quiz->id,
                                ]
                            ) }}"
                            class="classwork-item quiz"
                            data-classwork-type="quiz"
                        >

                            <div class="classwork-item-icon quiz">
                                <i class="bx bx-help-circle"></i>
                            </div>

                            <div class="classwork-item-content">

                                <h3>
                                    {{ $quiz->title }}
                                </h3>

                                <p>

                                    <span class="classwork-item-type quiz">
                                        Quiz
                                    </span>

                                    <span class="classwork-item-separator">
                                        •
                                    </span>

                                    <span class="classwork-item-date">
                                        {{ $quiz->created_at->format('M d, Y') }}
                                    </span>

                                </p>

                            </div>

                        </a>

                    @endforeach


                    {{-- EXAMS --}}

                    @foreach($noTopicExams as $exam)

                        <a
                            href="{{ route(
                                'student.class-groups.exams.show',
                                [
                                    'classGroup' => $classGroup->id,
                                    'exam' => $exam->id,
                                ]
                            ) }}"
                            class="classwork-item exam"
                            data-classwork-type="exam"
                        >

                            <div class="classwork-item-icon exam">
                                <i class="bx bx-edit-alt"></i>
                            </div>

                            <div class="classwork-item-content">

                                <h3>
                                    {{ $exam->title }}
                                </h3>

                                <p>

                                    <span class="classwork-item-type exam">
                                        Exam
                                    </span>

                                    <span class="classwork-item-separator">
                                        •
                                    </span>

                                    <span class="classwork-item-date">
                                        {{ $exam->created_at->format('M d, Y') }}
                                    </span>

                                </p>

                            </div>

                        </a>

                    @endforeach


                    {{-- PROJECTS --}}

                    @foreach($noTopicProjects as $project)

                        <a
                            href="{{ route(
                                'student.class-groups.projects.show',
                                [
                                    'classGroup' => $classGroup->id,
                                    'project' => $project->id,
                                ]
                            ) }}"
                            class="classwork-item project"
                            data-classwork-type="projects"
                        >

                            <div class="classwork-item-icon project">
                                <i class="bx bx-git-branch"></i>
                            </div>

                            <div class="classwork-item-content">

                                <h3>
                                    {{ $project->title }}
                                </h3>

                                <p>

                                    <span class="classwork-item-type project">
                                        Project
                                    </span>

                                    <span class="classwork-item-separator">
                                        •
                                    </span>

                                    <span class="classwork-item-date">
                                        {{ $project->created_at->format('M d, Y') }}
                                    </span>

                                    @if($project->due_date)

                                        <span class="classwork-item-separator">
                                            •
                                        </span>

                                        <span class="classwork-item-date">
                                            Due {{ $project->due_date->format('M d, Y') }}
                                        </span>

                                    @endif

                                </p>

                            </div>

                        </a>

                    @endforeach

                </div>

            </section>

        @endif



        {{-- ========================================================
             COMPLETELY EMPTY
             ======================================================== --}}

        @if(
            $classGroup->topics->count() === 0 &&
            !$hasNoTopicClasswork
        )

            <div class="classwork-empty">

                <div class="classwork-empty-icon">
                    <i class="bx bx-book-open"></i>
                </div>

                <h2>
                    No classwork yet
                </h2>

                <p>
                    Your professor has not added any classwork yet.
                </p>

            </div>

        @endif

    </main>

</div>


{{-- ============================================================
     JAVASCRIPT
     ============================================================ --}}

<script>

document.addEventListener('DOMContentLoaded', function () {

    /* ============================================================
       FILTER
       ============================================================ */

    const filterButtons =
        document.querySelectorAll('.classwork-filter-item');

    const classworkItems =
        document.querySelectorAll('.classwork-item');


    filterButtons.forEach(function (button) {

        button.addEventListener('click', function () {

            const filter =
                this.dataset.filter;


            /* Remove active state */

            filterButtons.forEach(function (item) {

                item.classList.remove('active');

            });


            /* Add active state */

            this.classList.add('active');


            /* Show / hide items */

            classworkItems.forEach(function (item) {

                const type =
                    item.dataset.classworkType;


                if (
                    filter === 'all' ||
                    filter === type
                ) {

                    item.style.display = '';

                } else {

                    item.style.display = 'none';

                }

            });


            /* Hide topics that have no visible items */

            document
                .querySelectorAll('.classwork-topic')
                .forEach(function (topic) {

                    const items =
                        topic.querySelectorAll('.classwork-item');

                    let hasVisibleItem = false;


                    items.forEach(function (item) {

                        if (item.style.display !== 'none') {

                            hasVisibleItem = true;

                        }

                    });


                    topic.style.display =
                        hasVisibleItem ? '' : 'none';

                });

        });

    });



    /* ============================================================
       TOPIC COLLAPSE / EXPAND
       ============================================================ */

    document
        .querySelectorAll('[data-topic-toggle]')
        .forEach(function (header) {

            header.addEventListener('click', function (event) {

                const topic =
                    this.closest('.classwork-topic');

                if (!topic) {
                    return;
                }


                const items =
                    topic.querySelector('.classwork-topic-items');

                const toggle =
                    topic.querySelector('.classwork-topic-toggle');

                const icon =
                    toggle.querySelector('i');


                const isOpen =
                    toggle.getAttribute('aria-expanded') === 'true';


                if (isOpen) {

                    items.style.display = 'none';

                    toggle.setAttribute(
                        'aria-expanded',
                        'false'
                    );

                    icon.classList.remove(
                        'bx-chevron-up'
                    );

                    icon.classList.add(
                        'bx-chevron-down'
                    );

                } else {

                    items.style.display = '';

                    toggle.setAttribute(
                        'aria-expanded',
                        'true'
                    );

                    icon.classList.remove(
                        'bx-chevron-down'
                    );

                    icon.classList.add(
                        'bx-chevron-up'
                    );

                }

            });

        });

});

</script>

@endsection

