<!-- cSpell:ignore endsection -->
@extends('layouts.hod_layout')

@section('title', 'Schedule Management')

@section('content')
@php
/*
* Read Browse values directly from the request.
* This also keeps the Blade language server from seeing an unassigned
* $year / $selectedPromotion / $selectedSemester variable.
*/
$selectedYear = request()->query('year', $year ?? 'all');
$selectedPromotion = request()->query('promotion', 'all');
$selectedSemester = request()->query('semester', 'all');
$selectedPromotions = collect(
$scheduleGroups
->pluck('promotion')
->filter(fn ($promotion) => $promotion !== null && $promotion !== '')
->map(fn ($promotion) => (int) $promotion)
->unique()
->sort()
->values()
->all()
);


$collegeName = optional($department->college)->college_name;
$scheduleGroups = $scheduleGroups ?? collect();

/*
* Build weekly cards from the schedule groups supplied by the controller.
* Combined years are never used in the official schedule title.
*/
$weeklyGroups = $scheduleGroups
->groupBy(function ($group) use ($selectedYear) {
/*
* Official schedule identity:
* Main Year + Semester + Promotion + Academic Year.
*
* Combined years are session-level data and must never create
* another official schedule card.
*/
return (string) ($group->schedule_group_id ?? $group->id ?? 'unknown');
})
->map(function ($group) {
$first = $group->first();

$sessions = $group
->flatMap(function ($weeklyGroup) {
return $weeklyGroup->sessions ?? collect();
})
->sortBy(function ($session) {
$dayOrder = [
'Monday' => 1,
'Tuesday' => 2,
'Wednesday' => 3,
'Thursday' => 4,
'Friday' => 5,
];

return [
$dayOrder[$session->day_of_week] ?? 99,
(int) ($session->slot_id ?? 0),
];
})
->values();

return (object) [
'id' => $first->id ?? null,
'schedule_group_id' => $first->schedule_group_id ?? null,
'semester' => $first->semester ?? null,
'academic_year' => $first->academic_year ?? null,
'main_year' => optional(
collect($first->sessions ?? [])
->flatMap(fn ($session) => $session->scheduleDepartments ?? collect())
->sortBy('id')
->first()
)->year_level,
'promotion' => $first->promotion ?? null,
'year_level' => optional(
collect($first->sessions ?? [])
->flatMap(fn ($session) => $session->scheduleDepartments ?? collect())
->sortBy('id')
->first()
)->year_level,
'status' => $first->status ?? 'draft',
'sessions' => $sessions,
'session_count' => $sessions->count(),
'day_count' => $sessions->pluck('day_of_week')->unique()->count(),
];
})
->values();

$scheduleCount = $weeklyGroups->count();
$firstGroup = $weeklyGroups->first();
$academicYear = $firstGroup?->academic_year;

$selectedSemesterLabel = match ($selectedSemester) {
'Semester 1' => 'First Semester',
'Semester 2' => 'Second Semester',
'all' => 'All Semesters',
default => $selectedSemester,
};

$yearLabel = $selectedYear === 'all' ? 'All Years' : 'Year ' . $selectedYear;
$viewLabel = $yearLabel . ' · ' . $selectedSemesterLabel;

$weekDays = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday'];
@endphp

<div class="schedule-page">

    {{-- HEADER --}}
    <div class="schedule-header-row">
        <section class="schedule-header-card">
            <div class="schedule-header-content">
                <span class="schedule-eyebrow">ACADEMIC SCHEDULE</span>
                <h1>Schedule Management</h1>

                <p>
                    Create, review and manage weekly schedules for
                    <strong>{{ $department->department_name }}</strong>.
                </p>

                <div class="schedule-context">
                    <span>
                        <i class="bx bx-building-house"></i>
                        {{ $department->department_name }}
                    </span>

                    @if($collegeName)
                    <span class="context-dot">•</span>
                    <span>{{ $collegeName }}</span>
                    @endif

                    @if($academicYear)
                    <span class="context-dot">•</span>
                    <span>{{ $academicYear }}</span>
                    @endif
                </div>
            </div>

            <div class="schedule-header-illustration" aria-hidden="true">
                <div class="illustration-circle"></div>

                <div class="illustration-icon icon-calendar">
                    <i class="bx bx-calendar"></i>
                </div>

                <div class="illustration-icon icon-clock">
                    <i class="bx bx-time-five"></i>
                </div>

                <div class="illustration-icon icon-book">
                    <i class="bx bx-book-open"></i>
                </div>

                <div class="illustration-icon icon-room">
                    <i class="bx bx-buildings"></i>
                </div>

                <div class="schedule-document">
                    <div class="document-top"></div>
                    <div class="document-line line-one"></div>
                    <div class="document-line line-two"></div>
                    <div class="document-line line-three"></div>

                    <div class="document-row">
                        <span></span><span></span><span></span>
                    </div>

                    <div class="document-row">
                        <span></span><span></span><span></span>
                    </div>

                    <div class="document-check">
                        <i class="bx bx-check"></i>
                    </div>
                </div>
            </div>
        </section>


    </div>

    {{-- FLASH MESSAGES --}}
    @if(session('success'))
    <div class="flash-message flash-success">
        <div class="flash-icon"><i class="bx bx-check"></i></div>
        <div>
            <strong>Schedule updated</strong>
            <p>{{ session('success') }}</p>
        </div>
    </div>
    @endif

    @if($errors->any())
    <div class="flash-message flash-error">
        <div class="flash-icon"><i class="bx bx-error-circle"></i></div>
        <div>
            <strong>Please check the schedule</strong>
            <ul>
                @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    </div>
    @endif

    {{-- WEEKLY SCHEDULE LIST --}}
    <section class="schedule-list-section">
<div class="schedule-list-heading">

    <div>
        <span class="section-kicker">YOUR SCHEDULES</span>

        <h2>Weekly Schedule Overview</h2>

        <p>Each card represents one weekly schedule.</p>
    </div>

    <div class="schedule-heading-right">

        {{-- Existing schedule count --}}
        <div class="schedule-total">
            <strong>{{ $scheduleCount }}</strong>

            <span>
                {{ $scheduleCount === 1 ? 'schedule' : 'schedules' }}
            </span>
        </div>

        {{-- Moved Create Schedule button --}}
        <a href="{{ route('hod.schedules.create', [
            'year' => $selectedYear === 'all' ? 1 : $selectedYear,
            'semester' => $selectedSemester === 'all' ? 'Semester 1' : $selectedSemester
        ]) }}"
           class="schedule-header-action">

            <i class="bx bx-calendar-plus"></i>

            <span>
                <strong>Create Schedule</strong>
                <small>Add classes and sessions</small>
            </span>

            <i class="bx bx-chevron-right action-arrow"></i>

        </a>

    </div>

</div>

        @if($weeklyGroups->isNotEmpty())

        @foreach($weeklyGroups as $scheduleGroup)

        @php
        /*
        * Display ONLY the main selected year.
        *
        * Example:
        * Main Year: 1
        * Combined Year: 2
        *
        * Display:
        * Year 1
        *
        * Do not display:
        * Year 1 + Year 2
        */

        $displayYear = $scheduleGroup->main_year ?? $scheduleGroup->year_level ?? null;

        $yearLabel = $displayYear !== null && $displayYear !== ''
        ? 'Year ' . (int) $displayYear
        : 'Year —';

        $groupSemesterLabel = match ($scheduleGroup->semester) {
        'Semester 1' => 'First Semester',
        'Semester 2' => 'Second Semester',
        default => $scheduleGroup->semester ?? 'Semester',
        };

        $scheduleTitle = $yearLabel . ' · ' . $groupSemesterLabel;

        if (!empty($scheduleGroup->promotion)) {
        $scheduleTitle .= ' · Promotion ' . $scheduleGroup->promotion;
        }

        $daysForGroup = $scheduleGroup->sessions->groupBy('day_of_week');

        $weeklyScheduleId = $scheduleGroup->id;
        @endphp

        <article class="weekly-schedule-card">

            <div class="weekly-card-top">
                <div class="weekly-card-identity">

                    <div class="schedule-card-icon">
                        <i class="bx bx-calendar-event"></i>
                    </div>

                    <div class="weekly-card-title">

                        @php
                        $scheduleStatus = strtolower($scheduleGroup->status ?? 'draft');
                        @endphp

                        <div class="schedule-card-meta">
                            <span class="schedule-badge">WEEKLY SCHEDULE</span>

                            <span class="schedule-status status-{{ $scheduleStatus === 'published' ? 'published' : 'draft' }}">
                                <span class="schedule-status-dot"></span>
                                <span class="schedule-status-text">{{ $scheduleStatus === 'published' ? 'Published' : 'Draft' }}</span>
                            </span>
                        </div>

                        <h3>{{ $scheduleTitle }}</h3>

                        <div class="weekly-card-schedule-subline">
                            @if($scheduleGroup->academic_year)
                            <span>
                                <i class="bx bx-calendar"></i>
                                {{ $scheduleGroup->academic_year }}
                            </span>
                            @endif

                            <span>
                                <i class="bx bx-time-five"></i>
                                {{ $scheduleGroup->session_count }}
                                {{ $scheduleGroup->session_count === 1 ? 'session' : 'sessions' }}
                            </span>

                            <span>
                                <i class="bx bx-calendar-week"></i>
                                {{ $scheduleGroup->day_count }}
                                {{ $scheduleGroup->day_count === 1 ? 'day' : 'days' }}
                            </span>
                        </div>
                    </div>
                </div>

                <div class="weekly-card-actions">



                    <a href="{{ route('hod.schedules.previewDocx', $weeklyScheduleId) }}"
                        class="schedule-view-button">
                        <span>View Schedule</span>
                        <i class="bx bx-right-arrow-alt"></i>
                    </a>

                    <div class="schedule-menu">
                        <button type="button"
                            class="schedule-menu-button"
                            aria-label="Schedule actions"
                            aria-expanded="false">
                            <i class="bx bx-dots-vertical-rounded"></i>
                        </button>

                        <div class="schedule-menu-dropdown">

                            <a href="{{ route('hod.schedules.edit', $weeklyScheduleId) }}">
                                <i class="bx bx-edit-alt"></i>
                                <span>Edit Schedule</span>
                            </a>

                            <form method="POST"
                                action="{{ route('hod.schedules.destroy', $weeklyScheduleId) }}"
                                onsubmit="return confirm('Delete this entire weekly schedule? This will remove all sessions in the schedule.');">

                                @csrf
                                @method('DELETE')

                                <input type="hidden" name="delete_type" value="week">
                                <input type="hidden" name="year" value="{{ $selectedYear }}">
                                <input type="hidden" name="promotion" value="{{ $scheduleGroup->promotion }}">
                                <input type="hidden" name="semester" value="{{ $scheduleGroup->semester }}">

                                <button type="submit">
                                    <i class="bx bx-trash"></i>
                                    <span>Delete Schedule</span>
                                </button>

                            </form>

                        </div>
                    </div>
                </div>
            </div>



        </article>

        @endforeach

        @else

        <div class="schedule-empty-card">
            <div class="schedule-empty-illustration">
                <i class="bx bx-calendar-x"></i>
            </div>

            <span class="section-kicker">NO SCHEDULE FOUND</span>

            <h3>Nothing has been scheduled yet.</h3>

            <p>
                There is currently no schedule for {{ $yearLabel }}
                in {{ $selectedSemesterLabel }}.
            </p>

            <a href="{{ route('hod.schedules.create', [
                    'year' => $selectedYear === 'all' ? 1 : $selectedYear,
                    'semester' => $selectedSemester === 'all' ? 'Semester 1' : $selectedSemester
                ]) }}" class="primary-button">
                <i class="bx bx-plus"></i>
                Create Schedule
            </a>
        </div>

        @endif
    </section>
</div>

<style>
    /* ============================================================
   SCHEDULE PAGE
   CLEAN BLUE STYLE — PROFESSORS PAGE
   ============================================================ */


    /* ============================================================
   COLOR SYSTEM
   ============================================================ */

    .schedule-page {

        --schedule-accent: #2563eb;

        --schedule-accent-soft: rgba(37, 99, 235, .10);

        --schedule-border: #dbe4ff;

        --schedule-blue: #2563eb;

        --schedule-blue-soft: rgba(37, 99, 235, .10);

        --schedule-green: #21865a;

        --schedule-green-soft: rgba(33, 134, 90, .10);

        --schedule-amber: #b7791f;

        --schedule-amber-soft: rgba(183, 121, 31, .10);

        width: 100%;

        max-width: 1380px;

        margin: 0 auto;

        padding: 18px 28px 50px;

        box-sizing: border-box;

        color: var(--heading-color);

    }

    .schedule-page * {
        box-sizing: border-box;
    }

    .schedule-page a {
        -webkit-tap-highlight-color: transparent;
    }


/* ============================================================
   MAIN HEADER
   ============================================================ */

.schedule-header-row {

    display: grid;

    /* Full width — no space reserved for Create Schedule */
    grid-template-columns: minmax(0, 1fr);

    gap: 12px;

    width: 100%;

    margin-bottom: 14px;

}


/* ============================================================
   SCHEDULE HEADER CARD
   ============================================================ */

.schedule-header-card {

    position: relative;

    display: flex;

    align-items: center;

    justify-content: space-between;

    min-height: 205px;

    padding: 28px 32px;

    overflow: hidden;

    background: var(--card-color);

    border: 1px solid var(--border-color);

    border-radius: 15px;

}


/* ============================================================
   SCHEDULE HEADER CONTENT
   ============================================================ */

.schedule-header-content {

    position: relative;

    z-index: 2;

    min-width: 0;

}


    /* ============================================================
   HEADER TEXT
   ============================================================ */

    .schedule-eyebrow,
    .section-kicker {

        display: block;

        font-weight: 800;

        letter-spacing: 1.8px;

        text-transform: uppercase;

    }

    .schedule-eyebrow {

        margin-bottom: 10px;

        color: #2563eb;

        font-size: 11px;

    }

    .schedule-header-card h1 {

        margin: 0;

        color: var(--heading-color);

        font-size: 31px;

        font-weight: 800;

        line-height: 1.25;

    }

    .schedule-header-card p {

        max-width: 540px;

        margin: 10px 0 0;

        color: var(--secondary-text-color);

        font-size: 13px;

        line-height: 1.55;

    }


    /* ============================================================
   HEADER CONTEXT
   ============================================================ */

    .schedule-context {

        display: flex;

        align-items: center;

        flex-wrap: wrap;

        gap: 8px;

        margin-top: 16px;

        color: var(--secondary-text-color);

        font-size: 10px;

        font-weight: 600;

    }

    .schedule-context span {

        display: inline-flex;

        align-items: center;

        gap: 5px;

    }

    .schedule-context i {

        color: #2563eb;

        font-size: 14px;

    }

    .schedule-context .context-dot {

        color: var(--border-color);

    }

    .schedule-context>span:first-of-type,
    .schedule-context>span:last-of-type {

        min-height: 34px;

        padding: 7px 11px;

        background: rgba(37, 99, 235, .10);

        border: 1px solid #dbe4ff;

        border-radius: 9px;

        color: var(--heading-color);

        font-size: 12px;

        font-weight: 800;

    }

    .schedule-context>span:first-of-type {

        font-size: 13px;

    }

    .schedule-context>span:first-of-type i {

        color: #2563eb;

        font-size: 17px;

    }

    .schedule-context>span:not(:first-of-type):not(:last-of-type) {

        color: var(--secondary-text-color);

        font-size: 10px;

        font-weight: 700;

    }


    /* ============================================================
   HEADER ILLUSTRATION
   ============================================================ */

    .schedule-header-illustration {

        position: relative;

        display: flex;

        align-items: center;

        justify-content: center;

        width: 215px;

        height: 150px;

        margin-left: 20px;

        flex-shrink: 0;

    }

    .illustration-circle {

        position: absolute;

        width: 128px;

        height: 128px;

        background: rgba(37, 99, 235, .10);

        border: 1px solid #dbe4ff;

        border-radius: 50%;

    }

    .schedule-document {

        position: relative;

        z-index: 2;

        display: flex;

        flex-direction: column;

        width: 84px;

        height: 103px;

        padding: 15px 12px;

        background: var(--card-color);

        border: 1px solid var(--border-color);

        border-radius: 10px;

        box-shadow: 0 8px 20px var(--shadow-color);

        transform: rotate(2deg);

    }

    .document-top {

        width: 48%;

        height: 8px;

        margin-bottom: 8px;

        background: rgba(37, 99, 235, .10);

        border-radius: 4px;

    }

    .document-line {

        width: 100%;

        height: 4px;

        margin-bottom: 6px;

        background: var(--border-color);

        border-radius: 5px;

    }

    .line-one {
        width: 86%;
    }

    .line-two {
        width: 70%;
    }

    .line-three {
        width: 92%;
    }

    .document-row {

        display: grid;

        grid-template-columns: 1fr 1.3fr .7fr;

        gap: 4px;

        margin-top: 5px;

    }

    .document-row span {

        height: 8px;

        background: var(--surface-color);

        border: 1px solid var(--border-color);

        border-radius: 2px;

    }

    .document-check {

        display: flex;

        align-items: center;

        justify-content: center;

        width: 22px;

        height: 22px;

        margin-top: auto;

        color: #21865a;

        background: rgba(33, 134, 90, .10);

        border-radius: 6px;

        font-size: 14px;

    }

    .illustration-icon {

        position: absolute;

        z-index: 3;

        display: flex;

        align-items: center;

        justify-content: center;

        width: 34px;

        height: 34px;

        background: var(--card-color);

        border: 1px solid var(--border-color);

        border-radius: 9px;

        box-shadow: 0 5px 15px var(--shadow-color);

        font-size: 17px;

    }

    .icon-calendar {

        top: 5px;

        right: 17px;

        color: #2563eb;

        transform: rotate(7deg);

    }

    .icon-clock {

        left: 4px;

        top: 28px;

        color: #2563eb;

        transform: rotate(-9deg);

    }

    .icon-book {

        left: 18px;

        bottom: 8px;

        color: #21865a;

        transform: rotate(-6deg);

    }

    .icon-room {

        right: 3px;

        bottom: 15px;

        color: #b7791f;

        transform: rotate(7deg);

    }


    /* ============================================================
   HEADER ACTION BUTTONS
   ============================================================ */

    .schedule-header-actions {

        display: flex;

        flex-direction: column;

        gap: 10px;

        min-height: 100%;

    }

    .schedule-header-action {

        display: flex;

        flex: 1;

        align-items: center;

        gap: 10px;

        width: 100%;

        min-height: 96px;

        padding: 13px;

        color: var(--heading-color);

        background: var(--card-color);

        border: 1px solid var(--border-color);

        border-radius: 12px;

        text-decoration: none;

        transition:

            color .2s ease,

            background-color .2s ease,

            border-color .2s ease,

            transform .2s ease;

    }

    .schedule-header-action>i:first-child {

        display: flex;

        align-items: center;

        justify-content: center;

        width: 46px;

        height: 46px;

        flex-shrink: 0;

        border-radius: 9px;

        font-size: 19px;

    }

    .schedule-header-action:nth-child(1)>i:first-child {

        color: #2563eb;

        background: rgba(37, 99, 235, .10);

    }

    .schedule-header-action:nth-child(2)>i:first-child {

        color: #21865a;

        background: rgba(33, 134, 90, .10);

    }

    .schedule-header-action span {

        flex: 1;

        min-width: 0;

    }

    .schedule-header-action strong,
    .schedule-header-action small {

        display: block;

    }

    .schedule-header-action strong {

        color: var(--heading-color);

        font-size: 13px;

        font-weight: 800;

    }

    .schedule-header-action small {

        margin-top: 3px;

        color: var(--secondary-text-color);

        font-size: 10px;

        line-height: 1.45;

    }

    .schedule-header-action .action-arrow {

        color: var(--secondary-text-color);

        font-size: 17px;

        transition: transform .2s ease, color .2s ease;

    }

    .schedule-header-action:hover {

        color: #fff;

        background: #2563eb;

        border-color: #2563eb;

        transform: translateY(-2px);

        box-shadow: 0 10px 24px var(--shadow-color);

    }

    .schedule-header-action:hover>i:first-child {

        color: #fff;

        background: rgba(255, 255, 255, .16);

    }

    .schedule-header-action:hover strong {

        color: #fff;

    }

    .schedule-header-action:hover small,
    .schedule-header-action:hover .action-arrow {

        color: rgba(255, 255, 255, .82);

    }

    .schedule-header-action:hover .action-arrow {

        color: #fff;

        transform: translateX(3px);

    }


    /* ============================================================
   SECTION KICKER + SCHEDULE LIST
   ============================================================ */

    .schedule-list-section {

        width: calc(100% - 10px);

        margin-top: 30px;

    }

    .section-kicker {

        display: block;

        margin-bottom: 12px;

        color: #2563eb;

        font-size: 11px;

        font-weight: 800;

        letter-spacing: 1.8px;

        line-height: 1.4;

    }

    .schedule-list-heading {

        display: flex;

        align-items: center;

        justify-content: space-between;

        gap: 16px;

        margin-bottom: 18px;

    }

    .schedule-list-heading h2 {

        margin: 0;

        color: var(--heading-color);

        font-size: 24px;

        font-weight: 800;

        line-height: 1.25;

    }

    .schedule-list-heading p {

        margin: 8px 0 0;

        color: var(--secondary-text-color);

        font-size: 12px;

        line-height: 1.5;

    }

    .schedule-total {

        display: flex;

        align-items: baseline;

        gap: 5px;

        padding: 8px 12px;

        background: rgba(37, 99, 235, .10);

        border: 1px solid #dbe4ff;

        border-radius: 999px;

        color: #2563eb;

        font-size: 10px;

        font-weight: 700;

    }

    .schedule-total strong {

        color: #2563eb;

        font-size: 13px;

    }


    /* ============================================================
   WEEKLY SCHEDULE CARD
   SAME CARD SIZE
   ============================================================ */

    .weekly-schedule-card {

        width: 100%;

        margin-bottom: 12px;

        padding: 18px 20px;

        background: var(--card-color);

        border: 1px solid var(--border-color);

        border-radius: 14px;

        transition:

            border-color .2s ease,

            box-shadow .2s ease,

            transform .2s ease;

    }

    .weekly-schedule-card:hover {

        border-color: #dbe4ff;

        box-shadow: 0 10px 26px var(--shadow-color);

        transform: translateY(-2px);

    }

    .weekly-card-top {

        display: flex;

        align-items: flex-start;

        justify-content: space-between;

        gap: 18px;

    }

    .weekly-card-identity {

        display: flex;

        align-items: flex-start;

        gap: 13px;

        min-width: 0;

    }

    .weekly-card-title {

        min-width: 0;

    }

    .weekly-card-title h3 {

        margin: 5px 0 0;

        color: var(--heading-color);

        font-size: 18px;

        font-weight: 800;

        line-height: 1.3;

    }

    .weekly-card-schedule-subline {

        display: flex;

        align-items: center;

        flex-wrap: wrap;

        gap: 11px;

        margin-top: 9px;

        color: var(--secondary-text-color);

        font-size: 10px;

        font-weight: 700;

    }

    .weekly-card-schedule-subline span {

        display: inline-flex;

        align-items: center;

        gap: 4px;

    }

    .weekly-card-schedule-subline i {

        color: #2563eb;

        font-size: 13px;

    }


    /* ============================================================
   SCHEDULE CARD ICON
   ============================================================ */

    .schedule-card-icon {

        display: flex;

        align-items: center;

        justify-content: center;

        width: 52px;

        height: 52px;

        flex-shrink: 0;

        color: #2563eb;

        background: rgba(37, 99, 235, .10);

        border: 1px solid #dbe4ff;

        border-radius: 11px;

        font-size: 23px;

    }


    /* ============================================================
   CARD META + BADGE
   ============================================================ */

    .schedule-card-meta {

        display: flex;

        align-items: center;

        gap: 7px;

        flex-wrap: wrap;

        color: var(--secondary-text-color);

        font-size: 10px;

        font-weight: 700;

    }

    .schedule-badge {

        display: inline-flex;

        align-items: center;

        padding: 5px 8px;

        color: #2563eb;

        background: rgba(37, 99, 235, .10);

        border: 1px solid #dbe4ff;

        border-radius: 6px;

        font-size: 9px;

        font-weight: 800;

        letter-spacing: .05em;

    }


    /* ============================================================
   STATUS
   ============================================================ */

    .schedule-status {

        display: inline-flex;

        align-items: center;

        gap: 7px;

        font-size: 11px;

        font-weight: 800;

        line-height: 1;

    }

    .schedule-status-dot {

        width: 8px;

        height: 8px;

        flex: 0 0 8px;

        border-radius: 50%;

    }

    .schedule-status.status-published {

        color: #21865a;

    }

    .schedule-status.status-published .schedule-status-dot {

        background: #22a06b;

        box-shadow: 0 0 0 3px rgba(34, 160, 107, .12);

    }

    .schedule-status.status-draft {

        color: #b7791f;

    }

    .schedule-status.status-draft .schedule-status-dot {

        background: #d79b24;

        box-shadow: 0 0 0 3px rgba(215, 155, 36, .12);

    }


    /* ============================================================
   CARD ACTIONS
   ============================================================ */

    .weekly-card-actions {

        display: inline-flex;

        align-items: center;

        gap: 7px;

        flex-shrink: 0;

    }

    .schedule-view-button {

        display: inline-flex;

        align-items: center;

        justify-content: center;

        gap: 5px;

        min-height: 36px;

        padding: 0 12px;

        color: #2563eb;

        background: rgba(37, 99, 235, .10);

        border: 1px solid #dbe4ff;

        border-radius: 9px;

        text-decoration: none;

        font-size: 10px;

        font-weight: 800;

        white-space: nowrap;

        transition:

            transform .18s ease,

            background-color .18s ease;

    }

    .schedule-view-button i {

        font-size: 14px;

        transition: transform .18s ease;

    }

    .schedule-view-button:hover {

        background: rgba(37, 99, 235, .16);

        transform: translateY(-1px);

    }

    .schedule-view-button:hover i {

        transform: translateX(2px);

    }

    .schedule-view-button.disabled {

        color: var(--secondary-text-color);

        background: var(--surface-color);

        border-color: var(--border-color);

    }


    /* ============================================================
   HIDE WEEK BUTTON
   ============================================================ */

    .weekly-card-toggle {

        display: inline-flex;

        align-items: center;

        justify-content: center;

        gap: 6px;

        min-height: 36px;

        padding: 7px 11px;

        color: var(--heading-color);

        background: var(--surface-color);

        border: 1px solid var(--border-color);

        border-radius: 9px;

        font-size: 10px;

        font-weight: 800;

        cursor: pointer;

        transition:

            background .2s ease,

            border-color .2s ease,

            color .2s ease;

    }

    .weekly-card-toggle:hover {

        color: #2563eb;

        border-color: #dbe4ff;

        background: rgba(37, 99, 235, .10);

    }

    .weekly-card-toggle i {

        font-size: 16px;

        transition: transform .2s ease;

    }


    /* ============================================================
   MONDAY — FRIDAY LIST
   ============================================================ */

    .weekly-days-list {

        margin-top: 17px;

        border-top: 1px solid var(--border-color);

        overflow: hidden;

        max-height: 1200px;

        opacity: 1;

        transition:

            max-height .28s ease,

            opacity .2s ease,

            margin-top .28s ease,

            border-color .2s ease;

    }

    .weekly-days-list.is-collapsed {

        max-height: 0;

        opacity: 0;

        margin-top: 0;

        border-top-color: transparent;

    }

    .weekly-card-toggle.is-collapsed i {

        transform: rotate(-90deg);

    }

    .weekly-day-row {

        display: grid;

        grid-template-columns: 120px minmax(0, 1fr);

        align-items: center;

        gap: 16px;

        min-height: 56px;

        padding: 10px 0;

        border-bottom: 1px solid var(--border-color);

    }

    .weekly-day-row:last-child {

        border-bottom: 0;

    }

    .weekly-day-row.is-empty {

        opacity: .7;

    }

    .weekly-day-name {

        display: flex;

        align-items: center;

        gap: 8px;

        color: var(--heading-color);

        font-size: 13px;

        font-weight: 800;

        letter-spacing: .04em;

        text-transform: uppercase;

    }

    .weekly-day-dot {

        width: 7px;

        height: 7px;

        flex: 0 0 7px;

        border-radius: 999px;

        background: #2563eb;

    }

    .weekly-day-row.is-empty .weekly-day-dot {

        background: var(--border-color);

    }

    .weekly-day-content {

        display: flex;

        align-items: center;

        flex-wrap: wrap;

        gap: 8px;

        min-width: 0;

    }

    .weekly-day-summary {

        flex-shrink: 0;

        padding: 5px 8px;

        color: #2563eb;

        background: rgba(37, 99, 235, .10);

        border: 1px solid #dbe4ff;

        border-radius: 7px;

        font-size: 9px;

        font-weight: 800;

    }

    .weekly-session-chips {

        display: flex;

        align-items: center;

        flex-wrap: wrap;

        gap: 7px;

    }


    /* ============================================================
   SESSION CHIP
   TIME / CODE / NAME / ROOM
   ============================================================ */

    .weekly-session-chip {

        display: inline-flex;

        align-items: center;

        flex-wrap: wrap;

        gap: 7px;

        max-width: 100%;

        padding: 6px 8px;

        color: var(--secondary-text-color);

        background: var(--surface-color);

        border: 1px solid var(--border-color);

        border-radius: 7px;

        font-size: 10px;

        line-height: 1.35;

    }


    /* Session number */

    .weekly-session-chip>strong {

        color: #64748b;

        font-size: 9px;

        font-weight: 800;

    }


    /* Time */

    .weekly-session-chip .chip-time {

        color: #64748b;

        font-size: 10px;

        font-weight: 600;

        white-space: nowrap;

    }


    /* Course wrapper */

    .weekly-session-chip .chip-course {

        display: inline-flex;

        align-items: baseline;

        gap: 5px;

        color: var(--heading-color);

        font-weight: 800;

    }


    /* Course code */

    .weekly-session-chip .chip-course-code {

        color: #2563eb;

        font-size: 10px;

        font-weight: 900;

    }


    /* Course name */

    .weekly-session-chip .chip-course-title {

        color: #172033;

        font-size: 10px;

        font-weight: 750;

    }


    /* Room */

    .weekly-session-chip .chip-room {

        color: #21865a;

        font-size: 10px;

        font-weight: 700;

    }

    .weekly-day-empty {

        color: var(--secondary-text-color);

        font-size: 9px;

        font-style: italic;

    }


    /* ============================================================
   SCHEDULE MENU
   ============================================================ */

    .schedule-menu {

        position: relative;

    }

    .schedule-menu-button {

        display: inline-flex;

        align-items: center;

        justify-content: center;

        width: 36px;

        height: 36px;

        padding: 0;

        color: var(--secondary-text-color);

        background: var(--surface-color);

        border: 1px solid var(--border-color);

        border-radius: 9px;

        cursor: pointer;

        transition: .18s ease;

    }

    .schedule-menu-button i {

        font-size: 20px;

    }

    .schedule-menu-button:hover,
    .schedule-menu-button[aria-expanded="true"] {

        color: #2563eb;

        border-color: #dbe4ff;

        background: rgba(37, 99, 235, .10);

    }

    .schedule-menu-dropdown {

        position: fixed;

        top: 0;

        left: 0;

        z-index: 99999;

        width: 175px;

        padding: 6px;

        background: var(--card-color);

        border: 1px solid var(--border-color);

        border-radius: 10px;

        box-shadow: 0 14px 30px var(--shadow-color);

        opacity: 0;

        visibility: hidden;

        pointer-events: none;

        transform: translateY(-4px);

        transition: .16s ease;

    }

    .schedule-menu-dropdown.is-visible {

        opacity: 1;

        visibility: visible;

        pointer-events: auto;

        transform: translateY(0);

    }

    .schedule-menu-dropdown a,
    .schedule-menu-dropdown form button {

        display: flex;

        align-items: center;

        width: 100%;

        gap: 8px;

        padding: 9px 10px;

        color: var(--heading-color);

        background: transparent;

        border: 0;

        border-radius: 7px;

        text-decoration: none;

        font: inherit;

        font-size: 10px;

        font-weight: 700;

        text-align: left;

        cursor: pointer;

    }

    .schedule-menu-dropdown a:hover {

        background: var(--surface-color);

        color: #2563eb;

    }

    .schedule-menu-dropdown form button:hover {

        background: rgba(220, 92, 92, .07);

        color: #c65e65;

    }

    .schedule-menu-dropdown i {

        width: 16px;

        font-size: 15px;

    }

    .schedule-menu-dropdown form {

        margin: 0;

    }
/* ==========================================
   SCHEDULE HEADING RIGHT SIDE
   ========================================== */

/* ==========================================
   SCHEDULE HEADING RIGHT SIDE
   ========================================== */

.schedule-heading-right {
    display: flex;
    flex-direction: column;
    align-items: flex-end;
    justify-content: center;
    gap: 12px;
    flex-shrink: 0;
}

/* Create Schedule stays on top */

.schedule-heading-right .schedule-header-action {
    order: 1;
}

/* Schedule count goes underneath */

.schedule-heading-right .schedule-total {
    order: 2;
    flex-shrink: 0;
}

/* Mobile */

@media (max-width: 760px) {

    .schedule-heading-right {
        width: 100%;
        justify-content: space-between;
        flex-wrap: wrap;
    }

}

    /* ============================================================
   EMPTY STATE
   ============================================================ */

    .schedule-empty-card {

        display: flex;

        flex-direction: column;

        align-items: center;

        justify-content: center;

        min-height: 280px;

        padding: 32px 20px;

        background: var(--card-color);

        border: 1px solid var(--border-color);

        border-radius: 14px;

        text-align: center;

    }

    .schedule-empty-illustration {

        display: flex;

        align-items: center;

        justify-content: center;

        width: 60px;

        height: 60px;

        margin-bottom: 12px;

        color: #2563eb;

        background: rgba(37, 99, 235, .10);

        border-radius: 14px;

        font-size: 27px;

    }

    .schedule-empty-card h3 {

        margin: 0;

        color: var(--heading-color);

        font-size: 17px;

        font-weight: 800;

    }

    .schedule-empty-card p {

        max-width: 420px;

        margin: 6px 0 17px;

        color: var(--secondary-text-color);

        font-size: 10px;

        line-height: 1.6;

    }

    .primary-button {

        display: inline-flex;

        align-items: center;

        gap: 6px;

        min-height: 37px;

        padding: 0 13px;

        color: #fff;

        background: #2563eb;

        border-radius: 9px;

        text-decoration: none;

        font-size: 10px;

        font-weight: 800;

        box-shadow: 0 6px 16px var(--shadow-color);

        transition: transform .2s ease, opacity .2s ease;

    }

    .primary-button:hover {

        transform: translateY(-2px);

        opacity: .92;

    }

    .primary-button i {

        font-size: 14px;

    }


    /* ============================================================
   FLASH MESSAGES
   ============================================================ */

    .flash-message {

        display: flex;

        align-items: flex-start;

        gap: 10px;

        width: calc(100% - 10px);

        margin-bottom: 12px;

        padding: 12px 14px;

        background: var(--card-color);

        border: 1px solid var(--border-color);

        border-radius: 11px;

    }

    .flash-icon {

        display: flex;

        align-items: center;

        justify-content: center;

        width: 29px;

        height: 29px;

        flex-shrink: 0;

        border-radius: 8px;

        font-size: 16px;

    }

    .flash-message strong {

        display: block;

        font-size: 11px;

    }

    .flash-message p {

        margin: 3px 0 0;

        font-size: 10px;

        line-height: 1.5;

    }

    .flash-message ul {

        margin: 4px 0 0;

        padding-left: 16px;

        font-size: 10px;

    }

    .flash-success {

        color: #2c8a61;

        background: rgba(33, 134, 90, .10);

        border-color: rgba(33, 134, 90, .18);

    }

    .flash-success .flash-icon {

        background: rgba(33, 134, 90, .14);

    }

    .flash-error {

        color: #c65e65;

        background: rgba(220, 92, 92, .07);

        border-color: rgba(220, 92, 92, .14);

    }

    .flash-error .flash-icon {

        background: rgba(220, 92, 92, .11);

    }


    /* ============================================================
   BROWSE SELECT
   ============================================================ */

    .browse-select-shell {

        position: relative;

    }

    .browse-select-shell select {

        width: 100%;

        height: 42px;

        padding: 0 35px 0 11px;

        color: var(--heading-color);

        background: var(--surface-color);

        border: 1px solid var(--border-color);

        border-radius: 9px;

        font: inherit;

        font-size: 11px;

        font-weight: 700;

        outline: none;

        appearance: none;

        cursor: pointer;

    }

    .browse-select-shell select:focus {

        border-color: #2563eb;

        box-shadow: 0 0 0 3px rgba(37, 99, 235, .10);

    }

    .browse-select-shell>i {

        position: absolute;

        top: 50%;

        right: 10px;

        color: var(--secondary-text-color);

        font-size: 16px;

        transform: translateY(-50%);

        pointer-events: none;

    }

    .browse-modal-actions {

        display: flex;

        justify-content: flex-end;

        gap: 8px;

        margin-top: 17px;

    }

    .browse-cancel,
    .browse-apply {

        min-height: 37px;

        padding: 0 13px;

        border-radius: 9px;

        font: inherit;

        font-size: 10px;

        font-weight: 800;

        cursor: pointer;

    }

    .browse-cancel {

        color: var(--heading-color);

        background: transparent;

        border: 1px solid var(--border-color);

    }

    .browse-cancel:hover {

        background: var(--surface-hover);

    }

    .browse-apply {

        display: inline-flex;

        align-items: center;

        gap: 6px;

        color: #fff;

        background: #2563eb;

        border: 1px solid #2563eb;

    }

    .browse-apply:hover {

        opacity: .92;

    }

    .browse-apply i {

        font-size: 14px;

    }


    /* ============================================================
   RESPONSIVE
   ============================================================ */

    @media (max-width: 1020px) {

        .schedule-header-row {

            grid-template-columns: minmax(0, 1fr) 220px;

        }

    }

    @media (max-width: 860px) {

        .schedule-page {

            padding: 15px 18px 40px;

        }

        .schedule-header-row {

            grid-template-columns: 1fr;

        }

        .schedule-header-actions {

            display: grid;

            grid-template-columns: 1fr 1fr;

        }

        .schedule-list-card {

            grid-template-columns: 42px minmax(0, 1fr);

        }

        .schedule-card-actions {

            grid-column: 2;

            justify-self: start;

        }

    }

    @media (max-width: 760px) {

        .weekly-card-top {

            flex-direction: column;

        }

        .weekly-card-actions {

            width: 100%;

        }

        .weekly-card-actions .schedule-view-button {

            flex: 1;

        }

        .weekly-card-toggle {

            flex-shrink: 0;

        }

        .weekly-day-row {

            grid-template-columns: 1fr;

            gap: 7px;

        }

    }

    @media (max-width: 640px) {

        .schedule-page {

            padding: 12px 10px 35px;

        }

        .schedule-header-card {

            min-height: 150px;

            padding: 20px;

        }

        .schedule-header-illustration {

            display: none;

        }

        .schedule-header-actions {

            grid-template-columns: 1fr;

        }

        .schedule-list-heading {

            align-items: flex-start;

            flex-direction: column;

        }

        .schedule-total {

            align-self: flex-start;

        }

        .schedule-list-card {

            grid-template-columns: 40px minmax(0, 1fr);

            padding: 14px;

        }

        .schedule-card-icon {

            width: 40px;

            height: 40px;

        }

        .schedule-card-actions {

            grid-column: 1 / -1;

            justify-self: stretch;

        }

        .schedule-card-info {

            gap: 8px;

        }

        .schedule-card-actions {

            width: 100%;

        }

        .schedule-view-button {

            flex: 1;

        }

        .browse-modal-actions {

            flex-direction: column-reverse;

        }

        .browse-cancel,
        .browse-apply {

            width: 100%;

        }

    }

    @media (max-width: 540px) {

        .weekly-schedule-card {

            padding: 14px;

        }

        .weekly-card-title h3 {

            font-size: 16px;

        }

        .weekly-card-schedule-subline {

            gap: 7px;

        }

    }


    /* ============================================================
   DARK MODE
   ============================================================ */

    .dark-mode .schedule-page {

        --schedule-accent: #2563eb;

        --schedule-accent-soft: rgba(37, 99, 235, .10);

        --schedule-blue: #60a5fa;

        --schedule-blue-soft: rgba(37, 99, 235, .10);

        --schedule-green: #67d4a1;

        --schedule-green-soft: rgba(103, 212, 161, .13);

        --schedule-amber: #f0bc63;

        --schedule-amber-soft: rgba(240, 188, 99, .13);

    }

    .dark-mode .schedule-context>span:first-of-type,
    .dark-mode .schedule-context>span:last-of-type {

        border-color: rgba(37, 99, 235, .28);

        background: rgba(37, 99, 235, .10);

        color: var(--heading-color);

    }


    /* ============================================================
   END
   ============================================================ */
</style>



<script>
    document.addEventListener('DOMContentLoaded', function() {
        const menus = Array.from(document.querySelectorAll('.schedule-menu'));
        const openMenus = new Map();

        function closeMenu(menu) {
            const button = menu.querySelector('.schedule-menu-button');
            const dropdown = openMenus.get(menu) || menu.querySelector('.schedule-menu-dropdown');

            if (dropdown && dropdown.parentElement === document.body) {
                const placeholder = dropdown.__menuPlaceholder;
                if (placeholder && placeholder.parentNode) {
                    placeholder.parentNode.insertBefore(dropdown, placeholder);
                    placeholder.remove();
                } else {
                    menu.appendChild(dropdown);
                }

                dropdown.style.position = '';
                dropdown.style.top = '';
                dropdown.style.left = '';
                dropdown.style.right = '';
                dropdown.style.bottom = '';
                dropdown.style.width = '';
                delete dropdown.__menuPlaceholder;
            }

            menu.classList.remove('is-open');
            dropdown.classList.remove('is-visible');
            if (button) {
                button.setAttribute('aria-expanded', 'false');
            }
            openMenus.delete(menu);
        }

        function positionDropdown(menu, button, dropdown) {
            const rect = button.getBoundingClientRect();
            const gap = 7;
            const padding = 10;
            const menuWidth = 175;
            const menuHeight = Math.min(dropdown.scrollHeight || 100, 220);

            let left = rect.right - menuWidth;
            let top = rect.bottom + gap;

            if (left < padding) {
                left = padding;
            }
            if (left + menuWidth > window.innerWidth - padding) {
                left = window.innerWidth - menuWidth - padding;
            }

            // Open upward when there is not enough room below the button.
            if (top + menuHeight > window.innerHeight - padding) {
                top = rect.top - menuHeight - gap;
            }

            if (top < padding) {
                top = padding;
            }

            dropdown.style.position = 'fixed';
            dropdown.style.top = `${top}px`;
            dropdown.style.left = `${left}px`;
            dropdown.style.right = 'auto';
            dropdown.style.bottom = 'auto';
            dropdown.style.width = `${menuWidth}px`;
        }

        function openMenu(menu) {
            const button = menu.querySelector('.schedule-menu-button');
            const dropdown = menu.querySelector('.schedule-menu-dropdown');

            if (!button || !dropdown) return;

            menus.forEach(function(otherMenu) {
                if (otherMenu !== menu) {
                    closeMenu(otherMenu);
                }
            });

            // Move the dropdown to <body> so parent containers with overflow:hidden
            // cannot cut it off.
            const placeholder = document.createComment('schedule-menu-placeholder');
            dropdown.__menuPlaceholder = placeholder;
            dropdown.parentNode.insertBefore(placeholder, dropdown);
            document.body.appendChild(dropdown);
            openMenus.set(menu, dropdown);

            menu.classList.add('is-open');
            dropdown.classList.add('is-visible');
            button.setAttribute('aria-expanded', 'true');

            positionDropdown(menu, button, dropdown);
        }

        menus.forEach(function(menu) {
            const button = menu.querySelector('.schedule-menu-button');
            if (!button) return;

            button.addEventListener('click', function(event) {
                event.stopPropagation();

                if (menu.classList.contains('is-open')) {
                    closeMenu(menu);
                } else {
                    openMenu(menu);
                }
            });
        });

        document.addEventListener('click', function(event) {
            menus.forEach(function(menu) {
                const button = menu.querySelector('.schedule-menu-button');
                const dropdown = openMenus.get(menu);

                if (!menu.classList.contains('is-open')) return;
                if (button && button.contains(event.target)) return;
                if (dropdown && dropdown.contains(event.target)) return;

                closeMenu(menu);
            });
        });

        window.addEventListener('resize', function() {
            menus.forEach(function(menu) {
                if (!menu.classList.contains('is-open')) return;
                const button = menu.querySelector('.schedule-menu-button');
                const dropdown = openMenus.get(menu);
                if (button && dropdown) {
                    positionDropdown(menu, button, dropdown);
                }
            });
        });

        window.addEventListener('scroll', function() {
            menus.forEach(function(menu) {
                if (!menu.classList.contains('is-open')) return;
                const button = menu.querySelector('.schedule-menu-button');
                const dropdown = openMenus.get(menu);
                if (button && dropdown) {
                    positionDropdown(menu, button, dropdown);
                }
            });
        }, true);
    });
</script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('[data-weekly-toggle]').forEach(function(toggle) {
            const targetId = toggle.getAttribute('aria-controls');
            const days = targetId ? document.getElementById(targetId) : null;

            if (!days) {
                return;
            }

            toggle.addEventListener('click', function() {
                const isOpen = toggle.getAttribute('aria-expanded') === 'true';

                toggle.setAttribute('aria-expanded', isOpen ? 'false' : 'true');
                toggle.classList.toggle('is-collapsed', isOpen);
                days.classList.toggle('is-collapsed', isOpen);

                const label = toggle.querySelector('.weekly-toggle-label');

                if (label) {
                    label.textContent = isOpen ? 'Show Week' : 'Hide Week';
                }
            });
        });
    });
</script>



@endsection