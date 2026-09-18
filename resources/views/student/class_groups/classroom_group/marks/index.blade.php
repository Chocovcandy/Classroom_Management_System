@extends('layouts.student_layout')

@section('title', 'Marks - ' . $classGroup->group_name)

@section('content')

<div class="student-marks-page">


    {{-- ============================================================
         CLASSROOM NAVIGATION
    ============================================================= --}}
    @include('student.class_groups.classroom_group.navigation')
    {{-- ============================================================
        PAGE HEADER
    ============================================================= --}}
    <div class="marks-top">

        <div class="marks-student">

            <div class="marks-avatar">
                @if($student->profile_image)
                    <img
                        src="{{ asset('storage/' . $student->profile_image) }}"
                        alt="{{ $student->name }}"
                    >
                @else
                    <span>
                        {{ strtoupper(substr($student->name ?? 'S', 0, 1)) }}
                    </span>
                @endif
            </div>

            <div class="marks-student-info">
                <span class="marks-label">
                    STUDENT MARKS
                </span>

                <h1>
                    {{ $student->name }}
                </h1>

                <p>
                    {{ $classGroup->group_name }}
                </p>
            </div>

        </div>


        {{-- ========================================================
            OVERALL GRADE
        ========================================================= --}}
        <div class="overall-grade">

            <span class="overall-label">
                Overall grade
            </span>

            @if($overallPercentage !== null)

                <strong class="overall-value">
                    {{ rtrim(rtrim(number_format($overallPercentage, 2), '0'), '.') }}%
                </strong>

                <span class="overall-points">
                    {{ rtrim(rtrim(number_format($totalEarned, 2), '0'), '.') }}
                    /
                    {{ rtrim(rtrim(number_format($totalPoints, 2), '0'), '.') }}
                    points
                </span>

            @else

                <strong class="overall-value empty">
                    —
                </strong>

                <span class="overall-points">
                    No graded work yet
                </span>

            @endif

        </div>

    </div>


    {{-- ============================================================
        FILTER
    ============================================================= --}}
    <div class="marks-toolbar">

        <div class="marks-filter-wrap">

            <span class="marks-filter-label">
                Task filter
            </span>

            <div class="marks-filter-buttons" role="group" aria-label="Task filter">

                <button
                    type="button"
                    class="marks-filter-button active"
                    data-filter="all"
                >
                    All
                </button>

                <button
                    type="button"
                    class="marks-filter-button"
                    data-filter="assignment"
                >
                    Assignments
                </button>

                <button
                    type="button"
                    class="marks-filter-button"
                    data-filter="quiz"
                >
                    Quizzes
                </button>

                <button
                    type="button"
                    class="marks-filter-button"
                    data-filter="exam"
                >
                    Exams
                </button>

                <button
                    type="button"
                    class="marks-filter-button"
                    data-filter="project"
                >
                    Projects
                </button>

            </div>

        </div>

        <a
            href="{{ route(
                'student.class-groups.classroom-group',
                ['classGroup' => $classGroup->id]
            ) }}"
            class="back-classroom"
        >
            <i class="bx bx-arrow-back"></i>
            Back to Classroom
        </a>

    </div>


    {{-- ============================================================
        PROJECT VISIBILITY
    ============================================================= --}}
    @php
        /*
        |--------------------------------------------------------------------------
        | Individual projects
        |   -> visible to every student in this class.
        |
        | Team projects
        |   -> visible only when this student is assigned to a team
        |      for that specific project.
        |--------------------------------------------------------------------------
        */
        $visibleProjects = $projects->filter(function ($project) use ($student) {

            if ($project->project_type !== 'team') {
                return true;
            }

            return $project->groups()
                ->whereHas('members', function ($query) use ($student) {
                    $query->where('user_id', $student->id);
                })
                ->exists();
        })->values();
    @endphp


    {{-- ============================================================
        MARKS LIST
    ============================================================= --}}
    @if(
        $assignments->isNotEmpty() ||
        $quizzes->isNotEmpty() ||
        $exams->isNotEmpty() ||
        $visibleProjects->isNotEmpty()
    )

    <div class="marks-list" id="marksList">

        {{-- ========================================================
            ASSIGNMENTS
        ========================================================= --}}
        @foreach($assignments as $assignment)

            @php
                $submission = $assignment->submissions->first();
                $hasSubmission = $submission !== null;
                $isGraded = $hasSubmission && $submission->score !== null;
                $points = (float) $assignment->points;
                $score = $isGraded ? (float) $submission->score : null;
                $percentage = ($isGraded && $points > 0)
                    ? ($score / $points) * 100
                    : null;
            @endphp

            <article
                class="mark-item"
                data-type="assignment"
                data-detail-type="assignment"
            >

                <div class="mark-item-main">

                    <div class="mark-type-icon assignment">
                        <i class="bx bx-task"></i>
                    </div>

                    <div class="mark-item-content">

                        <div class="mark-item-title-row">

                            <h2>
                                {{ $assignment->title }}
                            </h2>

                            <span class="mark-type">
                                Assignment
                            </span>

                        </div>

                        <div class="mark-item-meta">

                            @if($assignment->due_date)

                                <span>
                                    <i class="bx bx-calendar"></i>
                                    Due
                                    {{ \Carbon\Carbon::parse($assignment->due_date)->format('M d, Y') }}

                                    @if($assignment->due_time)
                                        , {{ \Carbon\Carbon::parse($assignment->due_time)->format('g:i A') }}
                                    @endif
                                </span>

                            @else

                                <span>
                                    <i class="bx bx-calendar"></i>
                                    No due date
                                </span>

                            @endif

                        </div>

                    </div>

                </div>


                <div class="mark-result">

                    @if($isGraded)

                        <strong class="mark-score">
                            {{ rtrim(rtrim(number_format($score, 2), '0'), '.') }}
                            /
                            {{ rtrim(rtrim(number_format($points, 2), '0'), '.') }}
                        </strong>

                        @if($percentage !== null)
                            <span class="mark-percentage">
                                {{ rtrim(rtrim(number_format($percentage, 1), '0'), '.') }}%
                            </span>
                        @endif

                    @elseif($hasSubmission)

                        <strong class="mark-status pending">
                            Not Graded
                        </strong>

                        <span class="mark-status-sub">
                            Submitted
                        </span>

                    @else

                        <strong class="mark-status missing">
                            Missing
                        </strong>

                        <span class="mark-status-sub">
                            Not submitted
                        </span>

                    @endif

                </div>

                <div class="mark-item-details" hidden>
                    <div class="mark-detail-summary">
                        <div class="mark-detail-info">
                            <span class="mark-detail-label">Assignment</span>
                            <span class="mark-detail-text">View the assignment description, resources, submission, and due date.</span>
                        </div>

                        <a
                            href="{{ route('student.class-groups.assignments.show', [
                                'classGroup' => $classGroup->id,
                                'assignment' => $assignment->id,
                               'return_to' => 'marks',
                            ]) }}"
                            class="mark-view-details"
                        >
                            <span>View Details</span>
                            <i class="bx bx-right-arrow-alt"></i>
                        </a>
                    </div>
                </div>
            </article>

        @endforeach


        {{-- ========================================================
            QUIZZES
        ========================================================= --}}
        @foreach($quizzes as $quiz)

            @php
                $submission = $quiz->submissions->first();
                $hasSubmission = $submission !== null;
                $isGraded = $hasSubmission && $submission->score !== null;
                $points = (float) $quiz->points;
                $score = $isGraded ? (float) $submission->score : null;
                $percentage = ($isGraded && $points > 0)
                    ? ($score / $points) * 100
                    : null;
            @endphp

            <article
                class="mark-item"
                data-type="quiz"
                data-detail-type="quiz"
            >

                <div class="mark-item-main">

                    <div class="mark-type-icon quiz">
                        <i class="bx bx-help-circle"></i>
                    </div>

                    <div class="mark-item-content">

                        <div class="mark-item-title-row">

                            <h2>
                                {{ $quiz->title }}
                            </h2>

                            <span class="mark-type">
                                Quiz
                            </span>

                        </div>

                        <div class="mark-item-meta">

                            @if($quiz->due_date)

                                <span>
                                    <i class="bx bx-calendar"></i>
                                    Due
                                    {{ \Carbon\Carbon::parse($quiz->due_date)->format('M d, Y') }}

                                    @if($quiz->due_time)
                                        , {{ \Carbon\Carbon::parse($quiz->due_time)->format('g:i A') }}
                                    @endif
                                </span>

                            @else

                                <span>
                                    <i class="bx bx-calendar"></i>
                                    No due date
                                </span>

                            @endif

                        </div>

                    </div>

                </div>


                <div class="mark-result">

                    @if($isGraded)

                        <strong class="mark-score">
                            {{ rtrim(rtrim(number_format($score, 2), '0'), '.') }}
                            /
                            {{ rtrim(rtrim(number_format($points, 2), '0'), '.') }}
                        </strong>

                        @if($percentage !== null)
                            <span class="mark-percentage">
                                {{ rtrim(rtrim(number_format($percentage, 1), '0'), '.') }}%
                            </span>
                        @endif

                    @elseif($hasSubmission)

                        <strong class="mark-status pending">
                            Not Graded
                        </strong>

                        <span class="mark-status-sub">
                            Submitted
                        </span>

                    @else

                        <strong class="mark-status missing">
                            Missing
                        </strong>

                        <span class="mark-status-sub">
                            Not submitted
                        </span>

                    @endif

                </div>

                <div class="mark-item-details" hidden>
                    <div class="mark-detail-summary">
                        <div class="mark-detail-info">
                            <span class="mark-detail-label">Quiz</span>
                            <span class="mark-detail-text">View the quiz instructions, resources, submission, and due date.</span>
                        </div>

                        <a
                            href="{{ route('student.class-groups.quizzes.show', [
                                'classGroup' => $classGroup->id,
                                'quiz' => $quiz->id,
                                'return_to' => 'marks',
                            ]) }}"
                            class="mark-view-details"
                        >
                            <span>View Details</span>
                            <i class="bx bx-right-arrow-alt"></i>
                        </a>
                    </div>
                </div>
            </article>

        @endforeach


        {{-- ========================================================
            EXAMS
        ========================================================= --}}
        @foreach($exams as $exam)

            @php
                $submission = $exam->submissions->first();
                $hasSubmission = $submission !== null;
                $isGraded = $hasSubmission && $submission->score !== null;
                $points = (float) $exam->points;
                $score = $isGraded ? (float) $submission->score : null;
                $percentage = ($isGraded && $points > 0)
                    ? ($score / $points) * 100
                    : null;
            @endphp

            <article
                class="mark-item"
                data-type="exam"
                data-detail-type="exam"
            >

                <div class="mark-item-main">

                    <div class="mark-type-icon exam">
                        <i class="bx bx-edit-alt"></i>
                    </div>

                    <div class="mark-item-content">

                        <div class="mark-item-title-row">

                            <h2>
                                {{ $exam->title }}
                            </h2>

                            <span class="mark-type">
                                Exam
                            </span>

                        </div>

                        <div class="mark-item-meta">

                            @if($exam->due_date)

                                <span>
                                    <i class="bx bx-calendar"></i>
                                    Due
                                    {{ \Carbon\Carbon::parse($exam->due_date)->format('M d, Y') }}

                                    @if($exam->due_time)
                                        , {{ \Carbon\Carbon::parse($exam->due_time)->format('g:i A') }}
                                    @endif
                                </span>

                            @else

                                <span>
                                    <i class="bx bx-calendar"></i>
                                    No due date
                                </span>

                            @endif

                        </div>

                    </div>

                </div>


                <div class="mark-result">

                    @if($isGraded)

                        <strong class="mark-score">
                            {{ rtrim(rtrim(number_format($score, 2), '0'), '.') }}
                            /
                            {{ rtrim(rtrim(number_format($points, 2), '0'), '.') }}
                        </strong>

                        @if($percentage !== null)
                            <span class="mark-percentage">
                                {{ rtrim(rtrim(number_format($percentage, 1), '0'), '.') }}%
                            </span>
                        @endif

                    @elseif($hasSubmission)

                        <strong class="mark-status pending">
                            Not Graded
                        </strong>

                        <span class="mark-status-sub">
                            Submitted
                        </span>

                    @else

                        <strong class="mark-status missing">
                            Missing
                        </strong>

                        <span class="mark-status-sub">
                            Not submitted
                        </span>

                    @endif

                </div>

                <div class="mark-item-details" hidden>
                    <div class="mark-detail-summary">
                        <div class="mark-detail-info">
                            <span class="mark-detail-label">Exam</span>
                            <span class="mark-detail-text">View the exam instructions, resources, submission, and due date.</span>
                        </div>
                    <a
                        href="{{ route('student.class-groups.exams.show', [
                            'classGroup' => $classGroup->id,
                            'exam' => $exam->id,
                            'return_to' => 'marks',
                        ]) }}"
                        class="mark-view-details"
                    >
                        <i class="bx bx-right-arrow-alt"></i>
                        View Details
                    </a>
                    </div>
                </div>
            </article>

        @endforeach


        {{-- ========================================================
            PROJECTS
        ========================================================= --}}
        @foreach($visibleProjects as $project)

            @php
                $submission = $project->submissions->first();
                $hasSubmission = $submission !== null;

                $points = (float) ($project->points ?? 0);

                $score = null;

                /*
                |----------------------------------------------------------
                | Individual project
                |----------------------------------------------------------
                */
                if ($project->project_type !== 'team') {
                    if ($submission && $submission->score !== null) {
                        $score = (float) $submission->score;
                    }
                }

                /*
                |----------------------------------------------------------
                | Team project
                |----------------------------------------------------------
                | Use this student's individual team grade first.
                | If there is no individual grade, use the common
                | team score.
                */
                else {
                    $individualGrade = $submission?->grades?->first();

                    if ($individualGrade && $individualGrade->score !== null) {
                        $score = (float) $individualGrade->score;
                    } elseif ($submission && $submission->score !== null) {
                        $score = (float) $submission->score;
                    }
                }

                $isGraded = $score !== null;

                $percentage = ($isGraded && $points > 0)
                    ? ($score / $points) * 100
                    : null;
            @endphp

            <article
                class="mark-item"
                data-type="project"
                data-detail-type="project"
            >

                <div class="mark-item-main">

                    <div class="mark-type-icon project">
                        <i class="bx bx-folder-open"></i>
                    </div>

                    <div class="mark-item-content">

                        <div class="mark-item-title-row">

                            <h2>
                                {{ $project->title }}
                            </h2>

                            <span class="mark-type">
                                Project
                            </span>

                        </div>

                        <div class="mark-item-meta">

                            @if($project->due_date)

                                <span>
                                    <i class="bx bx-calendar"></i>
                                    Due
                                    {{ \Carbon\Carbon::parse($project->due_date)->format('M d, Y') }}

                                    @if($project->due_time)
                                        , {{ \Carbon\Carbon::parse($project->due_time)->format('g:i A') }}
                                    @endif
                                </span>

                            @else

                                <span>
                                    <i class="bx bx-calendar"></i>
                                    No due date
                                </span>

                            @endif

                            <span>
                                <i class="bx bx-group"></i>
                                {{ $project->project_type === 'team' ? 'Team' : 'Individual' }}
                            </span>

                        </div>

                    </div>

                </div>

                <div class="mark-result">

                    @if($isGraded)

                        <strong class="mark-score">
                            {{ rtrim(rtrim(number_format($score, 2), '0'), '.') }}
                            /
                            {{ rtrim(rtrim(number_format($points, 2), '0'), '.') }}
                        </strong>

                        @if($percentage !== null)
                            <span class="mark-percentage">
                                {{ rtrim(rtrim(number_format($percentage, 1), '0'), '.') }}%
                            </span>
                        @endif

                    @elseif($hasSubmission)

                        <strong class="mark-status pending">
                            Not Graded
                        </strong>

                        <span class="mark-status-sub">
                            Submitted
                        </span>

                    @else

                        <strong class="mark-status missing">
                            Missing
                        </strong>

                        <span class="mark-status-sub">
                            Not submitted
                        </span>

                    @endif

                </div>

                <div class="mark-item-details" hidden>
                    <div class="mark-detail-summary">

                        <div class="mark-detail-info">
                            <span class="mark-detail-label">Project</span>
                            <span class="mark-detail-text">
                                View the project instructions, resources, team details, submission, and grade.
                            </span>
                        </div>

                        <a
                            href="{{ route('student.class-groups.projects.show', [
                                'classGroup' => $classGroup->id,
                                'project' => $project->id,
                                'return_to' => 'marks',
                            ]) }}"
                            class="mark-view-details"
                        >
                            <span>View Details</span>
                            <i class="bx bx-right-arrow-alt"></i>
                        </a>

                    </div>
                </div>

            </article>

        @endforeach


        {{-- ========================================================
            EMPTY FILTER RESULT
        ========================================================= --}}
        <div
            class="marks-filter-empty"
            id="marksFilterEmpty"
            hidden
        >
            <div class="filter-empty-icon">
                <i class="bx bx-filter-alt"></i>
            </div>

            <h3>
                No marks found
            </h3>

            <p>
                There are no tasks in this category.
            </p>
        </div>


    </div>

    @else

        <div class="marks-empty">

            <div class="marks-empty-icon">
                <i class="bx bx-bar-chart-alt-2"></i>
            </div>

            <h3>
                No classwork yet
            </h3>

            <p>
                Your marks will appear here when your professor
                creates assignments, quizzes, or exams.
            </p>

        </div>

    @endif

</div>


{{-- ================================================================
    CSS
================================================================ --}}
<style>
    /* ============================================================
   STUDENT MARKS — REDESIGNED
   Clean academic dashboard / gradebook
   ============================================================ */

.student-marks-page {
    --marks-primary: #2563eb;
    --marks-primary-soft: #eff6ff;

    --marks-text: #172033;
    --marks-muted: #6f7889;
    --marks-border: #e4e8ef;

    --marks-surface: #ffffff;
    --marks-page: #f6f8fc;

    width: 100%;
    max-width: 1350px;
    margin: 0 auto;
    padding: 0 28px 45px;
    box-sizing: border-box;
}


/* ============================================================
   PAGE HEADER
   ============================================================ */

.marks-top {
    display: flex;
    align-items: stretch;
    justify-content: space-between;

    gap: 35px;

    padding: 32px 36px;

    background: var(--marks-surface);

    border: 1px solid var(--marks-border);
    border-radius: 22px;

    box-shadow:
        0 8px 30px rgba(25, 35, 60, .045);
}


/* ============================================================
   STUDENT
   ============================================================ */

.marks-student {
    min-width: 0;

    display: flex;
    align-items: center;

    gap: 20px;
}

.marks-avatar {
    width: 76px;
    height: 76px;
    min-width: 76px;

    display: flex;
    align-items: center;
    justify-content: center;

    overflow: hidden;

    border-radius: 19px;

    background: var(--marks-primary-soft);
    color: var(--marks-primary);

    font-size: 27px;
    font-weight: 750;
}

.marks-avatar img {
    width: 100%;
    height: 100%;

    object-fit: cover;
}

.marks-student-info {
    min-width: 0;
}

.marks-label {
    display: block;

    margin-bottom: 8px;

    color: var(--marks-primary);

    font-size: 12px;
    font-weight: 800;

    letter-spacing: 1.2px;
    text-transform: uppercase;
}

.marks-student-info h1 {
    max-width: 700px;

    margin: 0;

    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;

    color: var(--marks-text);

    font-size: 27px;
    font-weight: 750;
    line-height: 1.25;
}

.marks-student-info p {
    margin: 7px 0 0;

    color: var(--marks-muted);

    font-size: 15px;
    line-height: 1.5;
}


/* ============================================================
   OVERALL GRADE
   ============================================================ */

.overall-grade {
    min-width: 250px;

    display: flex;
    flex-direction: column;
    justify-content: center;

    padding-left: 34px;

    border-left: 1px solid var(--marks-border);
}

.overall-label {
    color: var(--marks-muted);

    font-size: 13px;
    font-weight: 650;
}

.overall-value {
    display: block;

    margin-top: 7px;

    color: var(--marks-primary);

    font-size: 36px;
    font-weight: 800;

    line-height: 1.1;
    letter-spacing: -.5px;
}

.overall-value.empty {
    color: #aab1be;
}

.overall-points {
    display: block;

    margin-top: 8px;

    color: var(--marks-muted);

    font-size: 13px;
}


/* ============================================================
   TOOLBAR
   ============================================================ */

.marks-toolbar {
    display: flex;
    align-items: flex-end;
    justify-content: space-between;

    gap: 22px;

    margin: 30px 0 16px;
}

.marks-filter-wrap {
    min-width: 0;
}

.marks-filter-label {
    display: block;

    margin: 0 0 9px 2px;

    color: #626d80;

    font-size: 13px;
    font-weight: 700;
}

.marks-filter-buttons {
    display: flex;
    align-items: center;

    flex-wrap: wrap;

    gap: 8px;
}

.marks-filter-button {
    height: 40px;

    padding: 0 16px;

    border: 1px solid var(--marks-border);
    border-radius: 11px;

    background: var(--marks-surface);
    color: #6d7687;

    font-family: inherit;

    font-size: 13px;
    font-weight: 650;

    outline: none;
    cursor: pointer;

    transition:
        color .2s ease,
        background .2s ease,
        border-color .2s ease,
        box-shadow .2s ease,
        transform .18s ease;
}

.marks-filter-button:hover {
    color: var(--marks-primary);

    border-color: #cbdafe;

    background: #fafcff;
}

.marks-filter-button.active {
    color: var(--marks-primary);

    background: var(--marks-primary-soft);

    border-color: #cbdafe;

    box-shadow:
        0 2px 9px rgba(37, 99, 235, .08);
}

.marks-filter-button:active {
    transform: scale(.97);
}

.marks-filter-button:focus-visible {
    border-color: rgba(37, 99, 235, .45);

    box-shadow:
        0 0 0 4px rgba(37, 99, 235, .08);
}


/* ============================================================
   BACK CLASSROOM
   ============================================================ */

.back-classroom {
    display: inline-flex;
    align-items: center;
    justify-content: center;

    gap: 9px;

    height: 44px;

    padding: 0 17px;

    border: 1px solid var(--marks-border);
    border-radius: 11px;

    color: #5f697b;
    background: var(--marks-surface);

    text-decoration: none;

    font-size: 13px;
    font-weight: 650;

    white-space: nowrap;

    transition:
        border-color .2s ease,
        background .2s ease,
        color .2s ease,
        transform .2s ease;
}

.back-classroom i {
    font-size: 18px;
}

.back-classroom:hover {
    color: var(--marks-primary);

    background: #fafcff;

    border-color: #cbdafe;
}

.back-classroom:active {
    transform: scale(.98);
}


/* ============================================================
   MARK LIST
   ============================================================ */

.marks-list {
    overflow: hidden;

    background: var(--marks-surface);

    border: 1px solid var(--marks-border);
    border-radius: 18px;

    box-shadow:
        0 7px 26px rgba(25, 35, 60, .035);
}


/* ============================================================
   MARK ITEM
   ============================================================ */

.mark-item {
    position: relative;

    min-height: 92px;

    display: flex;
    align-items: center;
    justify-content: space-between;

    gap: 28px;

    padding: 18px 24px;

    background: var(--marks-surface);

    border-bottom: 1px solid var(--marks-border);

    transition:
        background .18s ease,
        transform .18s ease;
}

.mark-item:last-of-type {
    border-bottom: 0;
}

.mark-item:hover {
    background: #fbfcff;
}


/* ============================================================
   MARK MAIN
   ============================================================ */

.mark-item-main {
    min-width: 0;

    display: flex;
    align-items: center;

    gap: 17px;
}


/* ============================================================
   TYPE ICON
   ============================================================ */

.mark-type-icon {
    width: 50px;
    height: 50px;
    min-width: 50px;

    display: flex;
    align-items: center;
    justify-content: center;

    border-radius: 14px;

    font-size: 22px;
}


/* ASSIGNMENT — GREEN */

.mark-type-icon.assignment {
    color: #15803d;

    background: #eefbf2;

    border: 1px solid #d8f2df;
}


/* QUIZ — PURPLE */

.mark-type-icon.quiz {
    color: #7c3aed;

    background: #f5efff;

    border: 1px solid #e9dcff;
}


/* EXAM — RED */

.mark-type-icon.exam {
    color: #dc4037;

    background: #fff0ef;

    border: 1px solid #ffd9d6;
}


/* PROJECT — YELLOW */

.mark-type-icon.project {
    color: #b77900;

    background: #fffbea;

    border: 1px solid #f7e7a9;
}


/* ============================================================
   MARK CONTENT
   ============================================================ */

.mark-item-content {
    min-width: 0;
}

.mark-item-title-row {
    display: flex;
    align-items: center;

    flex-wrap: wrap;

    gap: 9px;
}

.mark-item-title-row h2 {
    max-width: min(760px, 60vw);

    margin: 0;

    overflow: hidden;

    text-overflow: ellipsis;
    white-space: nowrap;

    color: #293246;

    font-size: 16px;
    font-weight: 700;

    line-height: 1.4;
}


/* ============================================================
   TYPE BADGE
   ============================================================ */

.mark-type {
    display: inline-flex;
    align-items: center;

    padding: 5px 9px;

    border: 1px solid #e7eaf0;

    border-radius: 999px;

    background: #fafbfc;
    color: #7e8797;

    font-size: 10px;
    font-weight: 750;

    letter-spacing: .25px;
}


/* ============================================================
   META
   ============================================================ */

.mark-item-meta {
    display: flex;
    align-items: center;

    flex-wrap: wrap;

    gap: 14px;

    margin-top: 7px;
}

.mark-item-meta span {
    display: inline-flex;
    align-items: center;

    gap: 5px;

    color: #929aaa;

    font-size: 12px;
}

.mark-item-meta i {
    font-size: 14px;
}


/* ============================================================
   CLICKABLE CLASSWORK / DETAILS
   ============================================================ */

.mark-item {
    cursor: pointer;
    flex-wrap: wrap;
}

.mark-item-main,
.mark-result {
    cursor: pointer;
}

.mark-item-details {
    width: 100%;

    flex-basis: 100%;

    padding: 16px 0 3px 67px;

    border-top: 1px solid #eef0f4;
}

.mark-detail-summary {
    display: flex;
    align-items: center;
    justify-content: space-between;

    gap: 18px;
}

.mark-detail-info {
    min-width: 0;

    display: flex;
    flex-direction: column;

    gap: 4px;
}

.mark-detail-label {
    color: var(--marks-primary);

    font-size: 12px;
    font-weight: 750;
}

.mark-detail-text {
    color: #8b94a4;

    font-size: 12px;
    line-height: 1.55;
}


/* ============================================================
   VIEW DETAILS BUTTON
   ============================================================ */

.mark-view-details {
    flex: 0 0 auto;

    display: inline-flex;
    align-items: center;
    justify-content: center;

    gap: 6px;

    min-height: 38px;

    padding: 0 14px;

    border: 1px solid #dfe3eb;
    border-radius: 10px;

    background: #ffffff;
    color: #566174;

    text-decoration: none;

    font-size: 12px;
    font-weight: 700;

    transition: all .18s ease;
}

.mark-view-details i {
    font-size: 16px;

    transition: transform .18s ease;
}

.mark-view-details:hover {
    color: var(--marks-primary);

    border-color: #cbdafe;

    background: #fafcff;
}

.mark-view-details:hover i {
    transform: translateX(2px);
}

.mark-item.is-open {
    background: #fcfdff;
}

.mark-item.is-open .mark-item-details {
    animation: markDetailsIn .18s ease;
}

@keyframes markDetailsIn {
    from {
        opacity: 0;
        transform: translateY(-3px);
    }

    to {
        opacity: 1;
        transform: translateY(0);
    }
}


/* ============================================================
   RESULT
   ============================================================ */

.mark-result {
    min-width: 145px;

    display: flex;
    flex-direction: column;
    align-items: flex-end;

    text-align: right;
}

.mark-score {
    color: #273044;

    font-size: 18px;
    font-weight: 800;

    line-height: 1.3;
}

.mark-percentage {
    display: inline-flex;
    align-items: center;

    margin-top: 5px;

    padding: 4px 9px;

    border-radius: 999px;

    background: var(--marks-primary-soft);
    color: var(--marks-primary);

    font-size: 10px;
    font-weight: 750;
}

.mark-status {
    font-size: 13px;
    font-weight: 700;
}

.mark-status.pending {
    color: #6b7280;
}

.mark-status.missing {
    color: #a0a7b3;
}

.mark-status-sub {
    margin-top: 4px;

    color: #9ba3b1;

    font-size: 10px;
}


/* ============================================================
   EMPTY STATES
   ============================================================ */

[hidden] {
    display: none !important;
}

.marks-empty,
.marks-filter-empty {
    min-height: 260px;

    display: flex;
    flex-direction: column;

    align-items: center;
    justify-content: center;

    padding: 42px 24px;

    text-align: center;

    background: var(--marks-surface);
}

.marks-empty {
    border: 1px solid var(--marks-border);

    border-radius: 18px;
}

.filter-empty-icon,
.marks-empty-icon {
    width: 58px;
    height: 58px;

    display: flex;
    align-items: center;
    justify-content: center;

    margin-bottom: 15px;

    border: 1px solid var(--marks-border);

    border-radius: 16px;

    background: #fafbfc;
    color: #9ca5b4;

    font-size: 24px;
}

.marks-empty h3,
.marks-filter-empty h3 {
    margin: 0 0 6px;

    color: #606a7b;

    font-size: 16px;
    font-weight: 700;
}

.marks-empty p,
.marks-filter-empty p {
    max-width: 450px;

    margin: 0;

    color: #9aa2af;

    font-size: 12px;

    line-height: 1.65;
}


/* ============================================================
   RESPONSIVE — TABLET
   ============================================================ */

@media (max-width: 1100px) {

    .student-marks-page {
        max-width: 100%;

        padding: 25px 24px 45px;
    }

    .marks-top {
        padding: 28px;
    }

    .overall-grade {
        min-width: 220px;

        padding-left: 28px;
    }

    .overall-value {
        font-size: 33px;
    }

    .mark-item-title-row h2 {
        max-width: 52vw;
    }
}


/* ============================================================
   RESPONSIVE — SMALL TABLET
   ============================================================ */

@media (max-width: 850px) {

    .marks-top {
        gap: 25px;
    }

    .overall-grade {
        min-width: 195px;
    }

    .mark-item {
        gap: 18px;

        padding: 17px 20px;
    }

    .mark-result {
        min-width: 120px;
    }

    .mark-item-title-row h2 {
        max-width: 45vw;

        font-size: 15px;
    }
}


/* ============================================================
   RESPONSIVE — MOBILE
   ============================================================ */

@media (max-width: 760px) {

    .student-marks-page {
        padding: 20px 16px 35px;
    }

    .marks-top {
        align-items: flex-start;

        flex-direction: column;

        gap: 22px;

        padding: 24px;
    }

    .marks-student {
        width: 100%;
    }

    .overall-grade {
        width: 100%;
        min-width: 0;

        padding: 18px 0 0;

        border-left: 0;

        border-top: 1px solid var(--marks-border);
    }

    .marks-toolbar {
        align-items: stretch;

        flex-direction: column;

        gap: 15px;
    }

    .marks-filter-wrap {
        width: 100%;
    }

    .marks-filter-buttons {
        width: 100%;
    }

    .marks-filter-button {
        flex: 1 1 auto;
    }

    .back-classroom {
        align-self: flex-start;
    }
}


/* ============================================================
   RESPONSIVE — PHONE
   ============================================================ */

@media (max-width: 600px) {

    .student-marks-page {
        padding: 16px 12px 30px;
    }

    .marks-top {
        padding: 20px;

        border-radius: 17px;
    }

    .marks-student {
        gap: 14px;
    }

    .marks-avatar {
        width: 58px;
        height: 58px;
        min-width: 58px;

        border-radius: 14px;

        font-size: 21px;
    }

    .marks-label {
        font-size: 10px;
    }

    .marks-student-info h1 {
        max-width: 65vw;

        font-size: 20px;
    }

    .marks-student-info p {
        font-size: 12px;
    }

    .overall-value {
        font-size: 29px;
    }

    .mark-item {
        align-items: flex-start;

        gap: 13px;

        padding: 15px;
    }

    .mark-item-main {
        gap: 11px;
    }

    .mark-type-icon {
        width: 40px;
        height: 40px;
        min-width: 40px;

        border-radius: 10px;

        font-size: 18px;
    }

    .mark-item-title-row h2 {
        max-width: 45vw;

        font-size: 13px;
    }

    .mark-type {
        padding: 4px 7px;

        font-size: 8px;
    }

    .mark-item-meta {
        gap: 9px;

        margin-top: 5px;
    }

    .mark-item-meta span {
        font-size: 10px;
    }

    .mark-result {
        min-width: 82px;
    }

    .mark-score {
        font-size: 13px;
    }

    .mark-percentage {
        font-size: 8px;
    }

    .mark-status {
        font-size: 10px;
    }

    .mark-status-sub {
        font-size: 8px;
    }

    .mark-item-details {
        padding-left: 51px;
    }

    .mark-detail-summary {
        align-items: flex-start;

        flex-direction: column;

        gap: 10px;
    }

    .mark-view-details {
        width: 100%;
    }
}


/* ============================================================
   VERY SMALL PHONES
   ============================================================ */

@media (max-width: 420px) {

    .student-marks-page {
        padding-left: 10px;
        padding-right: 10px;
    }

    .marks-top {
        padding: 17px;
    }

    .marks-avatar {
        width: 52px;
        height: 52px;
        min-width: 52px;
    }

    .marks-student-info h1 {
        font-size: 18px;
    }

    .marks-student-info p {
        font-size: 11px;
    }

    .marks-filter-buttons {
        gap: 6px;
    }

    .marks-filter-button {
        height: 37px;

        padding: 0 11px;

        font-size: 11px;
    }

    .mark-item {
        padding: 13px 12px;
    }

    .mark-type-icon {
        width: 37px;
        height: 37px;
        min-width: 37px;

        font-size: 16px;
    }

    .mark-item-title-row h2 {
        max-width: 42vw;

        font-size: 12px;
    }

    .mark-result {
        min-width: 70px;
    }

    .mark-score {
        font-size: 12px;
    }
}
/* ============================================================
   DARK MODE — MATCH SIDEBAR CARD COLOR
   ============================================================ */

html.dark .marks-top,
body.dark .marks-top,
.dark-mode .marks-top {
    background: #111329;
    border-color: #292d4d;
}

/* Marks list */
html.dark .marks-list,
body.dark .marks-list,
.dark-mode .marks-list {
    background: #111329;
    border-color: #292d4d;
}

/* Every mark card */
html.dark .mark-item,
body.dark .mark-item,
.dark-mode .mark-item {
    background: #111329;
    border-bottom-color: #292d4d;
}

/* Card hover */
html.dark .mark-item:hover,
body.dark .mark-item:hover,
.dark-mode .mark-item:hover {
    background: #171a35;
}

/* Open card */
html.dark .mark-item.is-open,
body.dark .mark-item.is-open,
.dark-mode .mark-item.is-open {
    background: #171a35;
}

/* Details separator */
html.dark .mark-item-details,
body.dark .mark-item-details,
.dark-mode .mark-item-details {
    border-top-color: #292d4d;
}

/* Type badge */
html.dark .mark-type,
body.dark .mark-type,
.dark-mode .mark-type {
    background: #1b1e38;
    border-color: #34385a;
    color: #aeb4ce;
}

/* View Details button */
html.dark .mark-view-details,
body.dark .mark-view-details,
.dark-mode .mark-view-details {
    background: #191c35;
    border-color: #34385a;
    color: #b5bad0;
}

html.dark .mark-view-details:hover,
body.dark .mark-view-details:hover,
.dark-mode .mark-view-details:hover {
    background: #222642;
    border-color: #4a5080;
}

/* Filter buttons */
html.dark .marks-filter-button,
body.dark .marks-filter-button,
.dark-mode .marks-filter-button {
    background: #111329;
    border-color: #292d4d;
    color: #adb2c8;
}

html.dark .marks-filter-button:hover,
body.dark .marks-filter-button:hover,
.dark-mode .marks-filter-button:hover {
    background: #171a35;
    border-color: #3b4164;
}

html.dark .marks-filter-button.active,
body.dark .marks-filter-button.active,
.dark-mode .marks-filter-button.active {
    background: #202758;
    border-color: #3f4d9a;
    color: #7c8cff;
}

/* Back to classroom */
html.dark .back-classroom,
body.dark .back-classroom,
.dark-mode .back-classroom {
    background: #111329;
    border-color: #292d4d;
    color: #adb2c8;
}

html.dark .back-classroom:hover,
body.dark .back-classroom:hover,
.dark-mode .back-classroom:hover {
    background: #171a35;
    border-color: #3b4164;
    color: #8290ff;
}

/* Empty states */
html.dark .marks-empty,
html.dark .marks-filter-empty,
body.dark .marks-empty,
body.dark .marks-filter-empty,
.dark-mode .marks-empty,
.dark-mode .marks-filter-empty {
    background: #111329;
    border-color: #292d4d;
}
/* ============================================================
   DARK MODE — WHITE TEXT
   ============================================================ */

html.dark .marks-top,
body.dark .marks-top,
.dark-mode .marks-top {
    color: #ffffff;
}

html.dark .marks-student-info h1,
body.dark .marks-student-info h1,
.dark-mode .marks-student-info h1 {
    color: #ffffff;
}

html.dark .overall-label,
body.dark .overall-label,
.dark-mode .overall-label {
    color: #ffffff;
}

html.dark .mark-item-title-row h2,
body.dark .mark-item-title-row h2,
.dark-mode .mark-item-title-row h2 {
    color: #ffffff;
}

html.dark .mark-score,
body.dark .mark-score,
.dark-mode .mark-score {
    color: #ffffff;
}

html.dark .mark-type,
body.dark .mark-type,
.dark-mode .mark-type {
    color: #ffffff;
}

html.dark .mark-item-meta span,
body.dark .mark-item-meta span,
.dark-mode .mark-item-meta span {
    color: #d5d9e5;
}

html.dark .overall-points,
body.dark .overall-points,
.dark-mode .overall-points {
    color: #d5d9e5;
}

html.dark .marks-filter-label,
body.dark .marks-filter-label,
.dark-mode .marks-filter-label {
    color: #ffffff;
}

html.dark .marks-filter-button,
body.dark .marks-filter-button,
.dark-mode .marks-filter-button {
    color: #ffffff;
}

html.dark .back-classroom,
body.dark .back-classroom,
.dark-mode .back-classroom {
    color: #ffffff;
}

html.dark .mark-detail-label,
body.dark .mark-detail-label,
.dark-mode .mark-detail-label {
    color: #ffffff;
}

html.dark .mark-detail-text,
body.dark .mark-detail-text,
.dark-mode .mark-detail-text {
    color: #d5d9e5;
}

html.dark .mark-view-details,
body.dark .mark-view-details,
.dark-mode .mark-view-details {
    color: #ffffff;
}

html.dark .marks-empty h3,
html.dark .marks-filter-empty h3,
body.dark .marks-empty h3,
body.dark .marks-filter-empty h3,
.dark-mode .marks-empty h3,
.dark-mode .marks-filter-empty h3 {
    color: #ffffff;
}
</style>

{{-- ================================================================
    FILTER SCRIPT
================================================================ --}}
<script>

document.addEventListener('DOMContentLoaded', function () {

    const markItems = Array.from(
        document.querySelectorAll('.mark-item')
    );

    markItems.forEach(function (item) {

        item.addEventListener('click', function (event) {

            // Do not toggle the card when the actual detail link is clicked.
            if (event.target.closest('.mark-view-details')) {
                return;
            }

            const details = item.querySelector('.mark-item-details');

            if (!details) {
                return;
            }

            const isOpen = !details.hidden;

            // Close other opened classworks first.
            markItems.forEach(function (otherItem) {
                if (otherItem !== item) {
                    const otherDetails = otherItem.querySelector('.mark-item-details');
                    if (otherDetails) {
                        otherDetails.hidden = true;
                    }
                    otherItem.classList.remove('is-open');
                }
            });

            details.hidden = isOpen;
            item.classList.toggle('is-open', !isOpen);

        });

    });

});

// ================================================================
// FILTER SCRIPT
// ================================================================

document.addEventListener('DOMContentLoaded', function () {

    const buttons = Array.from(
        document.querySelectorAll('.marks-filter-button')
    );

    const items = Array.from(
        document.querySelectorAll('.mark-item')
    );

    const emptyState = document.getElementById('marksFilterEmpty');

    if (!buttons.length || !items.length) {
        return;
    }

    function applyFilter(selectedType) {

        let visibleCount = 0;

        items.forEach(function (item) {

            const itemType = item.dataset.type;

            const shouldShow =
                selectedType === 'all' ||
                itemType === selectedType;

            item.hidden = !shouldShow;

            if (shouldShow) {
                visibleCount++;
            }

        });

        buttons.forEach(function (button) {

            button.classList.toggle(
                'active',
                button.dataset.filter === selectedType
            );

        });

        if (emptyState) {
            emptyState.hidden = visibleCount !== 0;
        }

    }

    buttons.forEach(function (button) {

        button.addEventListener('click', function () {

            applyFilter(this.dataset.filter);

        });

    });

    applyFilter('all');

});

</script>

@endsection

