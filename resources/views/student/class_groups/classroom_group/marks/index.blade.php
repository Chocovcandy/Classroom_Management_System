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
                        class="view-details-btn"
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
    --marks-primary: #4f46e5;
    --marks-primary-soft: #eef2ff;
    --marks-text: #172033;
    --marks-muted: #7b8495;
    --marks-border: #e8ebf1;
    --marks-surface: #ffffff;
    --marks-page: #f7f8fb;

    width: 100%;
    max-width: 1180px;
    margin: 0 auto;
    padding: 32px 32px 56px;
    box-sizing: border-box;
}

/* ============================================================
   PAGE HEADER
   ============================================================ */

.marks-top {
    display: flex;
    align-items: stretch;
    justify-content: space-between;
    gap: 28px;

    padding: 28px 30px;

    background: var(--marks-surface);
    border: 1px solid var(--marks-border);
    border-radius: 20px;

    box-shadow:
        0 8px 28px rgba(25, 35, 60, .045);
}

.marks-student {
    min-width: 0;

    display: flex;
    align-items: center;
    gap: 18px;
}

.marks-avatar {
    width: 68px;
    height: 68px;
    min-width: 68px;

    display: flex;
    align-items: center;
    justify-content: center;

    overflow: hidden;
    border-radius: 18px;

    background: var(--marks-primary-soft);
    color: var(--marks-primary);

    font-size: 24px;
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
    margin-bottom: 7px;

    color: var(--marks-primary);

    font-size: 10px;
    font-weight: 800;
    letter-spacing: 1.2px;
    text-transform: uppercase;
}

.marks-student-info h1 {
    max-width: 560px;
    margin: 0;

    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;

    color: var(--marks-text);

    font-size: 24px;
    font-weight: 750;
    line-height: 1.25;
}

.marks-student-info p {
    margin: 6px 0 0;

    color: var(--marks-muted);

    font-size: 13px;
}

/* ============================================================
   OVERALL GRADE
   ============================================================ */

.overall-grade {
    min-width: 215px;

    display: flex;
    flex-direction: column;
    justify-content: center;

    padding-left: 30px;

    border-left: 1px solid var(--marks-border);
}

.overall-label {
    color: var(--marks-muted);

    font-size: 11px;
    font-weight: 650;
}

.overall-value {
    display: block;
    margin-top: 7px;

    color: var(--marks-primary);

    font-size: 32px;
    font-weight: 800;
    line-height: 1.1;
    letter-spacing: -.5px;
}

.overall-value.empty {
    color: #aab1be;
}

.overall-points {
    display: block;
    margin-top: 7px;

    color: var(--marks-muted);

    font-size: 11px;
}

/* ============================================================
   TOOLBAR
   ============================================================ */

.marks-toolbar {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 18px;

    margin: 28px 0 14px;
}

.marks-filter-wrap {
    min-width: 0;
}

.marks-filter-label {
    display: block;
    margin: 0 0 8px 2px;

    color: #697386;

    font-size: 11px;
    font-weight: 700;
}

.marks-filter-buttons {
    display: flex;
    align-items: center;
    flex-wrap: wrap;
    gap: 7px;
}

.marks-filter-button {
    height: 36px;

    padding: 0 13px;

    border: 1px solid var(--marks-border);
    border-radius: 10px;

    background: var(--marks-surface);
    color: #737c8d;

    font-family: inherit;
    font-size: 11px;
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
    border-color: #dfe1ff;
    background: #fafaff;
}

.marks-filter-button.active {
    color: var(--marks-primary);
    background: var(--marks-primary-soft);
    border-color: #dfe1ff;

    box-shadow:
        0 2px 8px rgba(79, 70, 229, .08);
}

.marks-filter-button:active {
    transform: scale(.97);
}

.marks-filter-button:focus-visible {
    border-color: rgba(79, 70, 229, .45);

    box-shadow:
        0 0 0 4px rgba(79, 70, 229, .08);
}

.back-classroom {
    display: inline-flex;
    align-items: center;
    gap: 8px;

    height: 42px;
    padding: 0 14px;

    border: 1px solid var(--marks-border);
    border-radius: 11px;

    color: #626c7d;
    background: var(--marks-surface);

    text-decoration: none;

    font-size: 12px;
    font-weight: 650;

    transition:
        border-color .2s ease,
        background .2s ease,
        color .2s ease,
        transform .2s ease;
}

.back-classroom i {
    font-size: 16px;
}

.back-classroom:hover {
    color: var(--marks-primary);
    background: #fafaff;
    border-color: #dfe1ff;
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
    border-radius: 16px;

    box-shadow:
        0 6px 24px rgba(25, 35, 60, .035);
}

.mark-item {
    position: relative;

    min-height: 82px;

    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 24px;

    padding: 15px 20px;

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
    background: #fbfbfd;
}

.mark-item-main {
    min-width: 0;

    display: flex;
    align-items: center;
    gap: 14px;
}

.mark-type-icon {
    width: 44px;
    height: 44px;
    min-width: 44px;

    display: flex;
    align-items: center;
    justify-content: center;

    border-radius: 12px;

    font-size: 19px;
}

.mark-type-icon.assignment {
    color: #15803d;
    background: #eefbf2;
}

.mark-type-icon.quiz {
    color: #7c3aed;
    background: #f5efff;
}

.mark-type-icon.exam {
    color: #b45309;
    background: #fff7e6;
}

.mark-type-icon.project {
     color: #ca8a04;
     background: #fef9c3;
}

.mark-item-content {
    min-width: 0;
}

.mark-item-title-row {
    display: flex;
    align-items: center;
    flex-wrap: wrap;
    gap: 8px;
}

.mark-item-title-row h2 {
    max-width: min(620px, 55vw);

    margin: 0;

    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;

    color: #293246;

    font-size: 13px;
    font-weight: 700;
    line-height: 1.4;
}

.mark-type {
    display: inline-flex;
    align-items: center;

    padding: 4px 8px;

    border: 1px solid #eceef3;
    border-radius: 999px;

    background: #fafbfc;
    color: #8a93a3;

    font-size: 9px;
    font-weight: 750;
    letter-spacing: .2px;
}

.mark-item-meta {
    display: flex;
    align-items: center;
    gap: 12px;

    margin-top: 5px;
}

.mark-item-meta span {
    display: inline-flex;
    align-items: center;
    gap: 5px;

    color: #9aa2b0;

    font-size: 10px;
}

.mark-item-meta i {
    font-size: 13px;
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
    padding: 14px 0 2px 58px;
    border-top: 1px solid #f0f1f5;
}

.mark-detail-summary {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 16px;
}

.mark-detail-info {
    min-width: 0;
    display: flex;
    flex-direction: column;
    gap: 3px;
}

.mark-detail-label {
    color: #4f46e5;
    font-size: 10px;
    font-weight: 750;
}

.mark-detail-text {
    color: #929aaa;
    font-size: 10px;
    line-height: 1.5;
}

.mark-view-details {
    flex: 0 0 auto;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 5px;
    min-height: 34px;
    padding: 0 11px;
    border: 1px solid #e1e4eb;
    border-radius: 9px;
    background: #ffffff;
    color: #596274;
    text-decoration: none;
    font-size: 10px;
    font-weight: 700;
    transition: all .18s ease;
}

.mark-view-details i {
    font-size: 15px;
    transition: transform .18s ease;
}

.mark-view-details:hover {
    color: var(--marks-primary);
    border-color: #dfe1ff;
    background: #fafaff;
}

.mark-view-details:hover i {
    transform: translateX(2px);
}

.mark-item.is-open {
    background: #fcfcff;
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
    min-width: 120px;

    display: flex;
    flex-direction: column;
    align-items: flex-end;

    text-align: right;
}

.mark-score {
    color: #273044;

    font-size: 14px;
    font-weight: 800;
    line-height: 1.3;
}

.mark-percentage {
    display: inline-flex;
    align-items: center;

    margin-top: 4px;
    padding: 3px 7px;

    border-radius: 999px;

    background: var(--marks-primary-soft);
    color: var(--marks-primary);

    font-size: 9px;
    font-weight: 750;
}

.mark-status {
    font-size: 12px;
    font-weight: 700;
}

.mark-status.pending {
    color: #6b7280;
}

.mark-status.missing {
    color: #a0a7b3;
}

.mark-status-sub {
    margin-top: 3px;

    color: #a5acb8;

    font-size: 9px;
}

/* ============================================================
   EMPTY STATES
   ============================================================ */

[hidden] {
    display: none !important;
}

.marks-empty,
.marks-filter-empty {
    min-height: 230px;

    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;

    padding: 38px 20px;

    text-align: center;
    background: var(--marks-surface);
}

.marks-empty {
    border: 1px solid var(--marks-border);
    border-radius: 16px;
}

.filter-empty-icon,
.marks-empty-icon {
    width: 52px;
    height: 52px;

    display: flex;
    align-items: center;
    justify-content: center;

    margin-bottom: 13px;

    border: 1px solid var(--marks-border);
    border-radius: 15px;

    background: #fafbfc;
    color: #9ca5b4;

    font-size: 22px;
}

.marks-empty h3,
.marks-filter-empty h3 {
    margin: 0 0 5px;

    color: #606a7b;

    font-size: 14px;
    font-weight: 700;
}

.marks-empty p,
.marks-filter-empty p {
    max-width: 400px;

    margin: 0;

    color: #9aa2af;

    font-size: 11px;
    line-height: 1.65;
}

/* ============================================================
   RESPONSIVE
   ============================================================ */

@media (max-width: 900px) {
    .student-marks-page {
        padding: 25px 22px 45px;
    }

    .marks-top {
        padding: 24px;
    }

    .overall-grade {
        min-width: 185px;
        padding-left: 22px;
    }

    .overall-value {
        font-size: 29px;
    }

    .mark-item-title-row h2 {
        max-width: 45vw;
    }
}

@media (max-width: 760px) {
    .marks-top {
        align-items: flex-start;
        flex-direction: column;
        gap: 22px;
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

@media (max-width: 600px) {
    .mark-item-details {
        padding-left: 48px;
    }

    .mark-detail-summary {
        align-items: flex-start;
        flex-direction: column;
        gap: 9px;
    }

    .mark-view-details {
        width: 100%;
    }

    .student-marks-page {
        padding: 17px 13px 32px;
    }

    .marks-top {
        padding: 20px;
        border-radius: 16px;
    }

    .marks-student {
        gap: 13px;
    }

    .marks-avatar {
        width: 56px;
        height: 56px;
        min-width: 56px;

        border-radius: 15px;
        font-size: 21px;
    }

    .marks-student-info h1 {
        max-width: 65vw;
        font-size: 19px;
    }

    .marks-student-info p {
        font-size: 11px;
    }

    .overall-value {
        font-size: 27px;
    }

    .mark-item {
        align-items: flex-start;
        gap: 12px;
        padding: 14px;
    }

    .mark-item-main {
        gap: 10px;
    }

    .mark-type-icon {
        width: 38px;
        height: 38px;
        min-width: 38px;

        border-radius: 10px;
        font-size: 17px;
    }

    .mark-item-title-row h2 {
        max-width: 48vw;
        font-size: 12px;
    }

    .mark-type {
        padding: 3px 6px;
        font-size: 8px;
    }

    .mark-item-meta span {
        font-size: 9px;
    }

    .mark-result {
        min-width: 76px;
    }

    .mark-score {
        font-size: 11px;
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

