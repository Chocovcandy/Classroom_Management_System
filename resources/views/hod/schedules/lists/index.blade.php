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
            return ($selectedYear !== 'all' ? (string) $selectedYear : 'all')
                . '|'
                . ($group->semester ?? 'unknown')
                . '|'
                . ($group->promotion ?? 'unknown')
                . '|'
                . ($group->academic_year ?? 'unknown');
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
                'promotion' => $first->promotion ?? null,
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

        <div class="schedule-header-actions">
            <a href="{{ route('hod.schedules.create', [
                'year' => $selectedYear === 'all' ? 1 : $selectedYear,
                'semester' => $selectedSemester === 'all' ? 'Semester 1' : $selectedSemester
            ]) }}" class="schedule-header-action">
                <i class="bx bx-calendar-plus"></i>

                <span>
                    <strong>Create Schedule</strong>
                    <small>Add classes and sessions</small>
                </span>

                <i class="bx bx-chevron-right action-arrow"></i>
            </a>
        </div>
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

    {{-- BROWSE --}}
    <section class="schedule-browse-card">
        <div class="browse-copy">
            <span class="section-kicker">BROWSE SCHEDULES</span>
            <h2>Find an existing schedule</h2>
            <p>Choose the year, promotion and semester to view.</p>
        </div>

        <div class="browse-current">
            <span class="browse-current-label">CURRENT VIEW</span>
            <strong>{{ $viewLabel }}</strong>
        </div>

        <button type="button" class="browse-button" id="openScheduleBrowse">
            <i class="bx bx-search"></i>
            <span>Browse Schedules</span>
            <i class="bx bx-chevron-down"></i>
        </button>
    </section>

    {{-- WEEKLY SCHEDULE LIST --}}
    <section class="schedule-list-section">
        <div class="schedule-list-heading">
            <div>
                <span class="section-kicker">YOUR SCHEDULES</span>
                <h2>Weekly Schedule Overview</h2>
                <p>Each card represents one weekly schedule.</p>
            </div>

            <div class="schedule-total">
                <strong>{{ $scheduleCount }}</strong>
                <span>{{ $scheduleCount === 1 ? 'schedule' : 'schedules' }}</span>
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

            $yearLabel = $selectedYear !== 'all'
                ? 'Year ' . $selectedYear
                : 'Year —';

            /*
             * Semester label.
             */
            $groupSemesterLabel = match ($scheduleGroup->semester) {
                'Semester 1' => 'First Semester',
                'Semester 2' => 'Second Semester',
                default => $scheduleGroup->semester,
            };

            /*
             * Build final schedule title.
             */
            $scheduleTitle = $yearLabel . ' · ' . $groupSemesterLabel;

            if ($scheduleGroup->promotion) {
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

                            <button type="button"
                                    class="weekly-card-toggle"
                                    data-weekly-toggle
                                    aria-expanded="true"
                                    aria-controls="weekly-days-{{ $weeklyScheduleId }}">
                                <span class="weekly-toggle-label">Hide Week</span>
                                <i class="bx bx-chevron-up"></i>
                            </button>

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

                    <div class="weekly-days-list" id="weekly-days-{{ $weeklyScheduleId }}">

                        @foreach($weekDays as $dayName)

                            @php
                                $daySessions = $daysForGroup->get($dayName, collect())
                                    ->sortBy(function ($session) {
                                        return (int) ($session->slot_id ?? 0);
                                    })
                                    ->values();
                            @endphp

                            <div class="weekly-day-row {{ $daySessions->isEmpty() ? 'is-empty' : '' }}">

                                <div class="weekly-day-name">
                                    <span class="weekly-day-dot"></span>
                                    <strong>{{ $dayName }}</strong>
                                </div>

                                <div class="weekly-day-content">

                                    @if($daySessions->isNotEmpty())

                                        <div class="weekly-day-summary">
                                            {{ $daySessions->count() }}
                                            {{ $daySessions->count() === 1 ? 'session' : 'sessions' }}
                                        </div>

                                        <div class="weekly-session-chips">

                                            @foreach($daySessions as $session)

                                                @php
                                                    $course = $session->course;
                                                    $room = $session->room;
                                                    $slot = $session->timeSlot;
                                                @endphp

                                                <span class="weekly-session-chip">

                                                    <strong>
                                                        S{{ $slot?->session_number ?? $session->slot_id }}
                                                    </strong>

                                                    @if($slot)
                                                        <span>
                                                            {{ \Carbon\Carbon::parse($slot->start_time)->format('h:i A') }}
                                                            –
                                                            {{ \Carbon\Carbon::parse($slot->end_time)->format('h:i A') }}
                                                        </span>
                                                    @endif

                                                    @if($course)
                                                        <span class="chip-course">
                                                            <strong class="chip-course-code">
                                                                {{ $course->course_code }}
                                                            </strong>
                                                            <span class="chip-course-title">
                                                                {{ $course->course_name }}
                                                            </span>
                                                        </span>
                                                    @endif

                                                    @if($room)
                                                        <span class="chip-room">
                                                            Room {{ $room->room_name }}
                                                        </span>
                                                    @endif

                                                </span>

                                            @endforeach

                                        </div>

                                    @else

                                        <span class="weekly-day-empty">No sessions</span>

                                    @endif

                                </div>
                            </div>

                        @endforeach

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

{{-- BROWSE MODAL --}}
<div class="schedule-browse-modal"
     id="scheduleBrowseModal"
     aria-hidden="true">

    <div class="schedule-browse-overlay" data-browse-close></div>

    <div class="schedule-browse-dialog"
         role="dialog"
         aria-modal="true"
         aria-labelledby="scheduleBrowseTitle">

        <div class="schedule-browse-header">
            <div>
                <span class="section-kicker">BROWSE SCHEDULES</span>
                <h2 id="scheduleBrowseTitle">Find a schedule</h2>
                <p>Choose the year, promotion and semester you want to view.</p>
            </div>

            <button type="button"
                    class="modal-close-button"
                    data-browse-close
                    aria-label="Close">
                <i class="bx bx-x"></i>
            </button>
        </div>

        <form method="GET"
              action="{{ route('hod.schedules.index') }}"
              class="schedule-browse-form"
              id="scheduleBrowseForm">

            <div class="browse-field">
                <label for="browse_year">Year</label>

                <div class="browse-select-shell">
                    <select name="year" id="browse_year">
                        <option value="all"
                            {{ $selectedYear === 'all' ? 'selected' : '' }}>
                            All Years
                        </option>

                        @foreach([1, 2, 3, 4] as $yearLevel)
                            <option value="{{ $yearLevel }}"
                                {{ (string) $selectedYear === (string) $yearLevel ? 'selected' : '' }}>
                                Year {{ $yearLevel }}
                            </option>
                        @endforeach
                    </select>

                    <i class="bx bx-chevron-down"></i>
                </div>
            </div>

            <div class="browse-field">
                <label for="browse_promotion">Promotion</label>

                <div class="browse-select-shell">
                    <select name="promotion" id="browse_promotion">
                        <option value="all"
                            {{ $selectedPromotion === 'all' ? 'selected' : '' }}>
                            All Promotions
                        </option>

                        @foreach($selectedPromotions as $selectedPromotionOption)
                            <option value="{{ $selectedPromotionOption }}"
                                {{ (string) $selectedPromotion === (string) $selectedPromotionOption ? 'selected' : '' }}>
                                Promotion {{ $selectedPromotionOption }}
                            </option>
                        @endforeach
                    </select>

                    <i class="bx bx-chevron-down"></i>
                </div>
            </div>

            <div class="browse-field">
                <label for="browse_semester">Semester</label>

                <div class="browse-select-shell">
                    <select name="semester" id="browse_semester">
                        <option value="all"
                            {{ $selectedSemester === 'all' ? 'selected' : '' }}>
                            All Semesters
                        </option>

                        <option value="Semester 1"
                            {{ $selectedSemester === 'Semester 1' ? 'selected' : '' }}>
                            Semester 1
                        </option>

                        <option value="Semester 2"
                            {{ $selectedSemester === 'Semester 2' ? 'selected' : '' }}>
                            Semester 2
                        </option>
                    </select>

                    <i class="bx bx-chevron-down"></i>
                </div>
            </div>

            <div class="browse-modal-actions">
                <button type="button"
                        class="browse-cancel"
                        data-browse-close>
                    Cancel
                </button>

                <button type="submit"
                        class="browse-apply">
                    <i class="bx bx-search"></i>
                    Apply Filters
                </button>
            </div>

        </form>
    </div>
</div>

<style>
/* ============================================================
   WEEKLY SCHEDULE VIEW
   ============================================================ */

.weekly-schedule-card {
    width: 100%;
    margin-bottom: 12px;
    padding: 18px 20px;
    background: var(--card-color);
    border: 1px solid var(--border-color);
    border-radius: 14px;
    transition: border-color .2s ease, box-shadow .2s ease, transform .2s ease;
}

.weekly-schedule-card:hover {
    border-color: var(--primary-border);
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
    font-size: 9px;
    font-weight: 700;
}

.weekly-card-schedule-subline span {
    display: inline-flex;
    align-items: center;
    gap: 4px;
}

.weekly-card-schedule-subline i {
    color: var(--button-color);
    font-size: 13px;
}

.weekly-card-actions {
    display: inline-flex;
    align-items: center;
    gap: 7px;
    flex-shrink: 0;
}

.weekly-card-toggle {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 6px;
    min-height: 34px;
    padding: 7px 10px;
    border: 1px solid var(--border-color);
    border-radius: 8px;
    color: var(--heading-color);
    background: var(--surface-color);
    font-size: 10px;
    font-weight: 800;
    cursor: pointer;
    transition: background .2s ease, border-color .2s ease, color .2s ease;
}

.weekly-card-toggle:hover {
    color: var(--button-color);
    border-color: var(--primary-border);
    background: var(--schedule-accent-soft);
}

.weekly-card-toggle i {
    font-size: 16px;
    transition: transform .2s ease;
}

.weekly-days-list {
    margin-top: 17px;
    border-top: 1px solid var(--border-color);
    overflow: hidden;
    max-height: 1200px;
    opacity: 1;
    transition: max-height .28s ease, opacity .2s ease, margin-top .28s ease, border-color .2s ease;
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
    background: var(--button-color);
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
    color: var(--button-color);
    background: var(--schedule-accent-soft);
    border: 1px solid var(--primary-border);
    border-radius: 7px;
    font-size: 8px;
    font-weight: 800;
}

.weekly-session-chips {
    display: flex;
    align-items: center;
    flex-wrap: wrap;
    gap: 7px;
}

.weekly-session-chip {
    display: inline-flex;
    align-items: center;
    flex-wrap: wrap;
    gap: 6px;
    max-width: 100%;
    padding: 6px 8px;
    color: var(--secondary-text-color);
    background: var(--surface-color);
    border: 1px solid var(--border-color);
    border-radius: 7px;
    font-size: 10px;
    line-height: 1.35;
}

.weekly-session-chip > strong {
    color: var(--button-color);
    font-size: 8px;
}

.weekly-session-chip .chip-course {
    color: var(--heading-color);
    font-weight: 800;
}

.weekly-session-chip .chip-course {
    display: inline-flex;
    align-items: baseline;
    gap: 5px;
}

.weekly-session-chip .chip-course-code {
    color: var(--button-color);
    font-size: 10px;
    font-weight: 900;
}

.weekly-session-chip .chip-course-title {
    color: var(--heading-color);
    font-size: 10px;
    font-weight: 700;
}

.weekly-day-empty {
    color: var(--secondary-text-color);
    font-size: 9px;
    font-style: italic;
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


/* Schedule status */
.schedule-status {
    display: inline-flex;
    align-items: center;
    gap: 7px;
    font-size: 11px;
    font-weight: 850;
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
</style>

<style>
/* ============================================================
   SCHEDULE LIST — CLASSWORK STYLE
   ============================================================ */
.schedule-page {
    --schedule-accent: #7c72e8;
    --schedule-accent-soft: rgba(124, 114, 232, 0.10);
    --schedule-green: #3ca977;
    --schedule-green-soft: rgba(60, 169, 119, 0.10);
    --schedule-blue: #4d8df5;
    --schedule-blue-soft: rgba(77, 141, 245, 0.10);
    --schedule-amber: #d59b3a;
    --schedule-amber-soft: rgba(213, 155, 58, 0.11);

    width: 100%;
    max-width: 1380px;
    margin: 0 auto;
    padding: 18px 28px 50px;
    box-sizing: border-box;
    color: var(--heading-color);
}

.schedule-page * { box-sizing: border-box; }
.schedule-page a { -webkit-tap-highlight-color: transparent; }

/* HEADER */
.schedule-header-row {
    display: grid;
    grid-template-columns: minmax(0, 1fr) 280px;
    gap: 12px;
    width: calc(100% - 10px);
    margin-bottom: 14px;
}

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

.schedule-header-content {
    position: relative;
    z-index: 2;
    min-width: 0;
}

.schedule-eyebrow,
.section-kicker {
    display: block;
    font-weight: 800;
    letter-spacing: 1.2px;
    text-transform: uppercase;
}

.schedule-eyebrow {
    margin-bottom: 6px;
    color: var(--button-color);
    font-size: 10px;
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
    margin: 7px 0 0;
    color: var(--secondary-text-color);
    font-size: 13px;
    line-height: 1.55;
}

.schedule-context {
    display: flex;
    align-items: center;
    flex-wrap: wrap;
    gap: 7px;
    margin-top: 12px;
    color: var(--secondary-text-color);
    font-size: 10px;
    font-weight: 600;
}

.schedule-context span:first-child {
    display: inline-flex;
    align-items: center;
    gap: 5px;
}

.schedule-context i { color: var(--button-color); font-size: 14px; }
.schedule-context .context-dot { color: var(--border-color); }

/* Make Department and Academic Year the main header context. */
.schedule-context > span:first-of-type,
.schedule-context > span:last-of-type {
    display: inline-flex;
    align-items: center;
    gap: 7px;
    min-height: 34px;
    padding: 7px 11px;
    border: 1px solid var(--primary-border);
    border-radius: 9px;
    background: var(--schedule-accent-soft);
    color: var(--heading-color);
    font-size: 12px;
    font-weight: 850;
}

.schedule-context > span:first-of-type {
    font-size: 13px;
}

.schedule-context > span:first-of-type i {
    color: var(--button-color);
    font-size: 17px;
}

.schedule-context > span:not(:first-of-type):not(:last-of-type) {
    color: var(--secondary-text-color);
    font-size: 10px;
    font-weight: 700;
}

/* ILLUSTRATION */
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
    background: var(--schedule-accent-soft);
    border: 1px solid var(--primary-border);
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
    animation: scheduleDocumentFloat 4s ease-in-out infinite;
}

.document-top {
    width: 48%;
    height: 8px;
    margin-bottom: 8px;
    background: var(--schedule-accent-soft);
    border-radius: 4px;
}

.document-line {
    width: 100%;
    height: 4px;
    margin-bottom: 6px;
    background: var(--border-color);
    border-radius: 5px;
}

.line-one { width: 86%; }
.line-two { width: 70%; }
.line-three { width: 92%; }

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
    color: var(--schedule-green);
    background: var(--schedule-green-soft);
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
    color: var(--schedule-accent);
    transform: rotate(7deg);
    animation: scheduleCalendarFloat 3.3s ease-in-out infinite;
}

.icon-clock {
    left: 4px;
    top: 28px;
    color: var(--schedule-blue);
    transform: rotate(-9deg);
    animation: scheduleClockFloat 3.6s ease-in-out infinite;
}

.icon-book {
    left: 18px;
    bottom: 8px;
    color: var(--schedule-green);
    transform: rotate(-6deg);
    animation: scheduleBookFloat 3.2s ease-in-out infinite;
}

.icon-room {
    right: 3px;
    bottom: 15px;
    color: var(--schedule-amber);
    transform: rotate(7deg);
    animation: scheduleRoomFloat 3.8s ease-in-out infinite;
}

@keyframes scheduleDocumentFloat {
    0%, 100% { transform: translateY(0) rotate(2deg); }
    50% { transform: translateY(-5px) rotate(-1deg); }
}

@keyframes scheduleCalendarFloat {
    0%, 100% { transform: translateY(0) rotate(7deg); }
    50% { transform: translateY(-5px) rotate(3deg); }
}

@keyframes scheduleClockFloat {
    0%, 100% { transform: translateY(0) rotate(-9deg); }
    50% { transform: translateY(4px) rotate(-5deg); }
}

@keyframes scheduleBookFloat {
    0%, 100% { transform: translateY(0) rotate(-6deg); }
    50% { transform: translateY(4px) rotate(-2deg); }
}

@keyframes scheduleRoomFloat {
    0%, 100% { transform: translateY(0) rotate(7deg); }
    50% { transform: translateY(-4px) rotate(3deg); }
}

/* HEADER ACTIONS */
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
    transition: color .2s ease, background-color .2s ease, border-color .2s ease, transform .2s ease;
}

.schedule-header-action > i:first-child {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 46px;
    height: 46px;
    flex-shrink: 0;
    border-radius: 9px;
    font-size: 19px;
}

.schedule-header-action:nth-child(1) > i:first-child {
    color: var(--schedule-accent);
    background: var(--schedule-accent-soft);
}

.schedule-header-action:nth-child(2) > i:first-child {
    color: var(--schedule-green);
    background: var(--schedule-green-soft);
}

.schedule-header-action span {
    flex: 1;
    min-width: 0;
}

.schedule-header-action strong,
.schedule-header-action small { display: block; }

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
    background: var(--button-color);
    border-color: var(--button-color);
    transform: translateY(-2px);
    box-shadow: 0 10px 24px var(--shadow-color);
}

.schedule-header-action:hover > i:first-child {
    color: #fff;
    background: rgba(255,255,255,.16);
}

.schedule-header-action:hover strong {
    color: #fff;
}

.schedule-header-action:hover small,
.schedule-header-action:hover .action-arrow {
    color: rgba(255,255,255,.82);
}

.schedule-header-action:hover .action-arrow {
    color: #fff;
    transform: translateX(3px);
}

.schedule-header-action.is-disabled {
    opacity: .52;
    pointer-events: none;
}

/* FLASH */
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

.flash-message strong { display: block; font-size: 11px; }
.flash-message p { margin: 3px 0 0; font-size: 10px; line-height: 1.5; }
.flash-message ul { margin: 4px 0 0; padding-left: 16px; font-size: 10px; }
.flash-success { color: #2c8a61; background: var(--schedule-green-soft); border-color: rgba(60,169,119,.18); }
.flash-success .flash-icon { background: rgba(60,169,119,.14); }
.flash-error { color: #c65e65; background: rgba(220,92,92,.07); border-color: rgba(220,92,92,.14); }
.flash-error .flash-icon { background: rgba(220,92,92,.11); }

/* BROWSE CARD */
.schedule-browse-card {
    display: grid;
    grid-template-columns: minmax(0, 1fr) auto auto;
    align-items: center;
    gap: 16px;
    width: calc(100% - 10px);
    margin-top: 10px;
    padding: 20px 24px;
    background: var(--card-color);
    border: 1px solid var(--border-color);
    border-radius: 14px;
}

.section-kicker {
    margin-bottom: 5px;
    color: var(--button-color);
    font-size: 9px;
}

.browse-copy h2,
.schedule-list-heading h2 {
    margin: 0;
    color: var(--heading-color);
    font-size: 18px;
    font-weight: 800;
}

.browse-copy p,
.schedule-list-heading p {
    margin: 4px 0 0;
    color: var(--secondary-text-color);
    font-size: 11px;
    line-height: 1.55;
}

.browse-current {
    min-width: 220px;
    padding: 9px 12px;
    background: var(--schedule-accent-soft);
    border: 1px solid var(--primary-border);
    border-radius: 9px;
}

.browse-current-label {
    display: block;
    margin-bottom: 3px;
    color: var(--secondary-text-color);
    font-size: 8px;
    font-weight: 800;
    letter-spacing: .08em;
}

.browse-current strong {
    color: var(--heading-color);
    font-size: 10px;
}

.browse-button {
    display: inline-flex;
    align-items: center;
    gap: 7px;
    min-height: 39px;
    padding: 0 12px;
    color: var(--heading-color);
    background: var(--surface-color);
    border: 1px solid var(--border-color);
    border-radius: 9px;
    font: inherit;
    font-size: 10px;
    font-weight: 800;
    cursor: pointer;
    transition: border-color .2s ease, background-color .2s ease, transform .2s ease;
}

.browse-button i:first-child { color: var(--button-color); font-size: 18px; }
.browse-button i:last-child { color: var(--secondary-text-color); font-size: 18px; }
.browse-button:hover { background: var(--card-color); border-color: var(--primary-border); transform: translateY(-1px); }

/* LIST */
.schedule-list-section {
    width: calc(100% - 10px);
    margin-top: 12px;
}

.schedule-list-heading {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 16px;
    margin-bottom: 10px;
}

.schedule-total {
    display: flex;
    align-items: baseline;
    gap: 5px;
    padding: 7px 10px;
    background: var(--surface-color);
    border: 1px solid var(--border-color);
    border-radius: 999px;
    color: var(--secondary-text-color);
    font-size: 9px;
    font-weight: 700;
}

.schedule-total strong { color: var(--heading-color); font-size: 12px; }

.schedule-list-card {
    position: relative;
    display: grid;
    grid-template-columns: 56px minmax(0, 1fr) auto;
    align-items: center;
    gap: 13px;
    width: 100%;
    padding: 20px;
    background: var(--card-color);
    border: 1px solid var(--border-color);
    border-radius: 14px;
    transition: border-color .2s ease, box-shadow .2s ease, transform .2s ease;
    animation: scheduleCardFadeUp .35s ease both;
}

.schedule-list-card:hover {
    border-color: var(--primary-border);
    box-shadow: 0 10px 25px var(--shadow-color);
    transform: translateY(-2px);
}

@keyframes scheduleCardFadeUp {
    from { opacity: 0; transform: translateY(7px); }
    to { opacity: 1; transform: translateY(0); }
}

.schedule-card-icon {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 52px;
    height: 52px;
    color: var(--schedule-accent);
    background: var(--schedule-accent-soft);
    border: 1px solid var(--primary-border);
    border-radius: 11px;
    font-size: 23px;
}

.schedule-card-main { min-width: 0; }

.schedule-card-meta {
    display: flex;
    align-items: center;
    gap: 7px;
    flex-wrap: wrap;
    color: var(--secondary-text-color);
    font-size: 9px;
    font-weight: 700;
}

.schedule-badge {
    display: inline-flex;
    align-items: center;
    padding: 4px 7px;
    color: var(--button-color);
    background: var(--schedule-accent-soft);
    border-radius: 6px;
    font-size: 8px;
    font-weight: 800;
    letter-spacing: .05em;
}

.schedule-card-main h3 {
    margin: 5px 0 0;
    color: var(--heading-color);
    font-size: 18px;
    font-weight: 800;
}

.schedule-card-main p {
    max-width: 720px;
    margin: 4px 0 0;
    color: var(--secondary-text-color);
    font-size: 10px;
    line-height: 1.55;
}

.schedule-card-info {
    display: flex;
    align-items: center;
    flex-wrap: wrap;
    gap: 12px;
    margin-top: 10px;
    color: var(--secondary-text-color);
    font-size: 9px;
}

.schedule-card-info span {
    display: inline-flex;
    align-items: center;
    gap: 4px;
}

.schedule-card-info i { color: var(--button-color); font-size: 13px; }

.schedule-view-button {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 5px;
    min-height: 36px;
    padding: 0 11px;
    color: var(--button-color);
    background: var(--schedule-accent-soft);
    border: 1px solid var(--primary-border);
    border-radius: 9px;
    text-decoration: none;
    font-size: 9px;
    font-weight: 800;
    white-space: nowrap;
    transition: transform .18s ease, background-color .18s ease;
}

.schedule-view-button i { font-size: 14px; transition: transform .18s ease; }
.schedule-view-button:hover { background: rgba(124,114,232,.16); transform: translateY(-1px); }
.schedule-view-button:hover i { transform: translateX(2px); }
.schedule-view-button.disabled { color: var(--secondary-text-color); background: var(--surface-color); border-color: var(--border-color); }


/* ============================================================
   BACK BUTTON + CARD ACTIONS
   ============================================================ */




.schedule-card-actions {
    display: inline-flex;
    align-items: center;
    gap: 7px;
    flex-shrink: 0;
}

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
    color: var(--button-color);
    border-color: var(--primary-border);
    background: var(--schedule-accent-soft);
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
    color: var(--button-color);
}

.schedule-menu-dropdown form button:hover {
    background: rgba(220,92,92,.07);
    color: #c65e65;
}

.schedule-menu-dropdown i {
    width: 16px;
    font-size: 15px;
}

.schedule-menu-dropdown form {
    margin: 0;
}

/* EMPTY */
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
    color: var(--schedule-accent);
    background: var(--schedule-accent-soft);
    border-radius: 14px;
    font-size: 27px;
    animation: emptyScheduleFloat 3.5s ease-in-out infinite;
}

@keyframes emptyScheduleFloat {
    0%, 100% { transform: translateY(0); }
    50% { transform: translateY(-5px); }
}

.schedule-empty-card h3 { margin: 0; color: var(--heading-color); font-size: 17px; font-weight: 800; }
.schedule-empty-card p { max-width: 420px; margin: 6px 0 17px; color: var(--secondary-text-color); font-size: 10px; line-height: 1.6; }

.primary-button {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    min-height: 37px;
    padding: 0 13px;
    color: #fff;
    background: var(--button-color);
    border-radius: 9px;
    text-decoration: none;
    font-size: 10px;
    font-weight: 800;
    box-shadow: 0 6px 16px var(--shadow-color);
    transition: transform .2s ease, opacity .2s ease;
}

.primary-button:hover { transform: translateY(-2px); opacity: .92; }
.primary-button i { font-size: 14px; }

/* BROWSE MODAL */
.schedule-browse-modal {
    position: fixed;
    inset: 0;
    z-index: 1300;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 20px;
    opacity: 0;
    visibility: hidden;
    pointer-events: none;
    transition: opacity .2s ease, visibility .2s ease;
}

.schedule-browse-modal.is-open {
    opacity: 1;
    visibility: visible;
    pointer-events: auto;
}

.schedule-browse-overlay {
    position: absolute;
    inset: 0;
    background: rgba(0,0,0,.42);
    backdrop-filter: blur(3px);
}

.schedule-browse-dialog {
    position: relative;
    z-index: 2;
    width: 100%;
    max-width: 540px;
    background: var(--card-color);
    border: 1px solid var(--border-color);
    border-radius: 17px;
    box-shadow: 0 25px 60px var(--shadow-color);
    transform: translateY(10px) scale(.98);
    transition: transform .2s ease;
}

.schedule-browse-modal.is-open .schedule-browse-dialog {
    transform: translateY(0) scale(1);
}

.schedule-browse-header {
    display: flex;
    align-items: flex-start;
    justify-content: space-between;
    gap: 18px;
    padding: 21px 22px 17px;
    border-bottom: 1px solid var(--border-color);
}

.schedule-browse-header h2 {
    margin: 0;
    color: var(--heading-color);
    font-size: 19px;
    font-weight: 800;
}

.schedule-browse-header p {
    margin: 4px 0 0;
    color: var(--secondary-text-color);
    font-size: 11px;
    line-height: 1.55;
}

.modal-close-button {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 35px;
    height: 35px;
    flex-shrink: 0;
    color: var(--secondary-text-color);
    background: transparent;
    border: 1px solid var(--border-color);
    border-radius: 9px;
    font: inherit;
    cursor: pointer;
}

.modal-close-button:hover { color: var(--heading-color); background: var(--surface-hover); }
.modal-close-button i { font-size: 19px; }

.schedule-browse-form { padding: 19px 22px 22px; }

.browse-field { margin-bottom: 14px; }
.browse-field label {
    display: block;
    margin-bottom: 6px;
    color: var(--secondary-text-color);
    font-size: 9px;
    font-weight: 800;
    letter-spacing: .06em;
    text-transform: uppercase;
}

.browse-select-shell { position: relative; }
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
    border-color: var(--button-color);
    box-shadow: 0 0 0 3px var(--schedule-accent-soft);
}

.browse-select-shell > i {
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

.browse-cancel:hover { background: var(--surface-hover); }

.browse-apply {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    color: #fff;
    background: var(--button-color);
    border: 1px solid var(--button-color);
}

.browse-apply:hover { opacity: .92; }
.browse-apply i { font-size: 14px; }


/* DARK MODE */
.dark-mode .schedule-page {
    --schedule-accent: #9b92f5;
    --schedule-accent-soft: rgba(155,146,245,.14);
    --schedule-green: #67d4a1;
    --schedule-green-soft: rgba(103,212,161,.13);
    --schedule-blue: #8fb4ff;
    --schedule-blue-soft: rgba(143,180,255,.13);
    --schedule-amber: #f0bc63;
    --schedule-amber-soft: rgba(240,188,99,.13);
}

.dark-mode .schedule-context > span:first-of-type,
.dark-mode .schedule-context > span:last-of-type {
    border-color: rgba(155,146,245,.28);
    background: rgba(155,146,245,.14);
    color: var(--heading-color);
}

/* RESPONSIVE */
@media (max-width: 1020px) {
    .schedule-header-row { grid-template-columns: 1fr 220px; }
    .schedule-browse-card { grid-template-columns: 1fr auto; }
    .browse-current { grid-column: 1 / -1; }
}

@media (max-width: 860px) {
    .schedule-page { padding: 15px 18px 40px; }
    .schedule-header-row { grid-template-columns: 1fr; }
    .schedule-header-actions { display: grid; grid-template-columns: 1fr 1fr; }
    .schedule-browse-card { grid-template-columns: 1fr auto; }
    .schedule-list-card { grid-template-columns: 42px minmax(0, 1fr); }
    .schedule-card-actions { grid-column: 2; justify-self: start; }
}

@media (max-width: 640px) {
    .schedule-page { padding: 12px 10px 35px; }

    .schedule-context > span:first-of-type,
    .schedule-context > span:last-of-type {
        min-height: 32px;
        padding: 6px 9px;
        font-size: 11px;
    }

    .schedule-context > span:first-of-type {
        font-size: 12px;
    }
    .schedule-header-card { min-height: 150px; padding: 20px; }
    .schedule-header-illustration { display: none; }
    .schedule-header-actions { grid-template-columns: 1fr; }
    .schedule-browse-card { grid-template-columns: 1fr; }
    .browse-current { grid-column: auto; min-width: 0; }
    .schedule-list-heading { align-items: flex-start; flex-direction: column; }
    .schedule-total { align-self: flex-start; }
    .schedule-list-card { grid-template-columns: 40px minmax(0, 1fr); padding: 14px; }
    .schedule-card-icon { width: 40px; height: 40px; }
    .schedule-card-actions { grid-column: 1 / -1; justify-self: stretch; }
    .schedule-card-info { gap: 8px; }
    .schedule-card-actions { width: 100%; }
    .schedule-view-button { flex: 1; }
    .schedule-browse-dialog { max-width: 100%; }
    .browse-modal-actions { flex-direction: column-reverse; }
    .browse-cancel, .browse-apply { width: 100%; }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const modal = document.getElementById('scheduleBrowseModal');
    const openButton = document.getElementById('openScheduleBrowse');

    if (!modal || !openButton) {
        return;
    }

    const closeButtons = modal.querySelectorAll('[data-browse-close]');

    function openBrowseModal() {
        modal.classList.add('is-open');
        modal.setAttribute('aria-hidden', 'false');
        document.body.style.overflow = 'hidden';
    }

    function closeBrowseModal() {
        modal.classList.remove('is-open');
        modal.setAttribute('aria-hidden', 'true');
        document.body.style.overflow = '';
    }

    openButton.addEventListener('click', openBrowseModal);

    closeButtons.forEach(function (button) {
        button.addEventListener('click', closeBrowseModal);
    });

    document.addEventListener('keydown', function (event) {
        if (event.key === 'Escape' && modal.classList.contains('is-open')) {
            closeBrowseModal();
        }
    });
});
</script>


<script>
document.addEventListener('DOMContentLoaded', function () {
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

        menus.forEach(function (otherMenu) {
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

    menus.forEach(function (menu) {
        const button = menu.querySelector('.schedule-menu-button');
        if (!button) return;

        button.addEventListener('click', function (event) {
            event.stopPropagation();

            if (menu.classList.contains('is-open')) {
                closeMenu(menu);
            } else {
                openMenu(menu);
            }
        });
    });

    document.addEventListener('click', function (event) {
        menus.forEach(function (menu) {
            const button = menu.querySelector('.schedule-menu-button');
            const dropdown = openMenus.get(menu);

            if (!menu.classList.contains('is-open')) return;
            if (button && button.contains(event.target)) return;
            if (dropdown && dropdown.contains(event.target)) return;

            closeMenu(menu);
        });
    });

    window.addEventListener('resize', function () {
        menus.forEach(function (menu) {
            if (!menu.classList.contains('is-open')) return;
            const button = menu.querySelector('.schedule-menu-button');
            const dropdown = openMenus.get(menu);
            if (button && dropdown) {
                positionDropdown(menu, button, dropdown);
            }
        });
    });

    window.addEventListener('scroll', function () {
        menus.forEach(function (menu) {
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
document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('[data-weekly-toggle]').forEach(function (toggle) {
        const targetId = toggle.getAttribute('aria-controls');
        const days = targetId ? document.getElementById(targetId) : null;

        if (!days) {
            return;
        }

        toggle.addEventListener('click', function () {
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

<script>
/*
 * Remember the last Browse selection.
 *
 * The selection only changes when the user submits the Browse form.
 * Opening/reloading the page does not randomly reset it.
 */
document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('scheduleBrowseForm');

    if (!form) {
        return;
    }

    const storageKey = 'hod.schedule.browse.filters';

    function readStoredFilters() {
        try {
            const value = localStorage.getItem(storageKey);

            if (!value) {
                return null;
            }

            const parsed = JSON.parse(value);

            if (
                !parsed ||
                typeof parsed !== 'object' ||
                !parsed.year ||
                !parsed.promotion ||
                !parsed.semester
            ) {
                return null;
            }

            return parsed;
        } catch (error) {
            return null;
        }
    }

    function saveFilters() {
        try {
            localStorage.setItem(storageKey, JSON.stringify({
                year: document.getElementById('browse_year')?.value || 'all',
                promotion: document.getElementById('browse_promotion')?.value || 'all',
                semester: document.getElementById('browse_semester')?.value || 'all'
            }));
        } catch (error) {
            // localStorage may be unavailable; normal URL filters still work.
        }
    }

    /*
     * Save only when the user intentionally applies Browse.
     */
    form.addEventListener('submit', function () {
        saveFilters();
    });

    /*
     * On a plain visit with no explicit filter in the URL, restore
     * the last selection instead of silently falling back to defaults.
     */
    const params = new URLSearchParams(window.location.search);

    if (
        !params.has('year') &&
        !params.has('promotion') &&
        !params.has('semester')
    ) {
        const stored = readStoredFilters();

        if (stored) {
            const currentYear = document.getElementById('browse_year')?.value || 'all';
            const currentPromotion = document.getElementById('browse_promotion')?.value || 'all';
            const currentSemester = document.getElementById('browse_semester')?.value || 'all';

            if (
                stored.year !== currentYear ||
                stored.promotion !== currentPromotion ||
                stored.semester !== currentSemester
            ) {
                const url = new URL(window.location.href);

                url.searchParams.set('year', stored.year);
                url.searchParams.set('promotion', stored.promotion);
                url.searchParams.set('semester', stored.semester);

                window.location.replace(url.toString());
            }
        }
    }
});
</script>

@endsection
