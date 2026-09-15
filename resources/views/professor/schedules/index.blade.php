@extends('layouts.prof_layout')

@section('title', 'My Schedules')

@section('content')

<div class="professor-schedules-page">

    {{-- ============================================================
        HEADER
    ============================================================ --}}
    <div class="schedules-header">

        <div class="schedules-header-left">

            <div class="schedules-icon">
                <i class='bx bx-calendar-event'></i>
            </div>

            <div>
                <span class="schedules-eyebrow">Professor • Academic Schedule</span>

                <h1>My Schedules</h1>

                <p>
                    View the official published schedules available to you.
                </p>
            </div>

        </div>

    </div>


    {{-- ============================================================
        STAT CARDS
    ============================================================ --}}
    <div class="schedule-stats">

        <div class="schedule-stat-card stat-blue">

            <div class="stat-icon">
                <i class='bx bx-calendar-check'></i>
            </div>

            <div class="stat-content">
                <span>Published Schedules</span>
                <strong>{{ $scheduleGroups->count() }}</strong>
            </div>

        </div>


        <div class="schedule-stat-card stat-purple">

            <div class="stat-icon">
                <i class='bx bx-book-open'></i>
            </div>

            <div class="stat-content">
                <span>Total Sessions</span>
                <strong>{{ $schedules->count() }}</strong>
            </div>

        </div>


        <div class="schedule-stat-card stat-yellow">

            <div class="stat-icon">
                <i class='bx bx-calendar-week'></i>
            </div>

            <div class="stat-content">
                <span>Teaching Days</span>
                <strong>
                    {{ $schedules->pluck('day_of_week')->unique()->count() }}
                </strong>
            </div>

        </div>

    </div>


    {{-- ============================================================
        MAIN PANEL
    ============================================================ --}}
    <div class="schedules-panel">

        <div class="schedules-panel-top">

            <div>
                <span class="panel-kicker">Official Schedules</span>

                <h2>Published Schedule List</h2>

                <p>
                    Select a schedule to view the complete Monday–Friday timetable.
                </p>
            </div>

            <div class="schedule-count-badge">
                <i class='bx bx-layer'></i>
                {{ $scheduleGroups->count() }}
                {{ $scheduleGroups->count() === 1 ? 'schedule' : 'schedules' }}
            </div>

        </div>


        {{-- ========================================================
            SCHEDULE LIST
        ========================================================= --}}
        @if($scheduleGroups->isNotEmpty())

            <div class="schedule-list">

                @foreach($scheduleGroups as $group)

                    @php
                        $firstSchedule = $group->first();

                        $semesterLabel = match ($firstSchedule->semester) {
                            'Semester 1' => 'First Semester',
                            'Semester 2' => 'Second Semester',
                            default => $firstSchedule->semester,
                        };

                        $dayCount = $group
                            ->pluck('day_of_week')
                            ->unique()
                            ->count();

                        $sessionCount = $group->count();
                    @endphp

                    <article class="schedule-card">

                        <div class="schedule-card-accent"></div>

                        <div class="schedule-main">

                            <div class="schedule-icon-box">
                                <i class='bx bx-calendar'></i>
                            </div>


                            <div class="schedule-information">

                                <div class="schedule-title-row">

                                    <div>
                                        <span class="schedule-kicker">
                                            PUBLISHED SCHEDULE
                                        </span>

                                        <h3>
                                            {{ $firstSchedule->academic_year }}
                                            · {{ $semesterLabel }}
                                        </h3>
                                    </div>

                                    <span class="schedule-status">
                                        <span class="schedule-status-dot"></span>
                                        Published
                                    </span>

                                </div>


                                <div class="schedule-meta">

                                    @if($firstSchedule->promotion)
                                        <span>
                                            <i class='bx bx-group'></i>
                                            Promotion {{ $firstSchedule->promotion }}
                                        </span>
                                    @endif

                                    <span>
                                        <i class='bx bx-time-five'></i>
                                        {{ $sessionCount }}
                                        {{ $sessionCount === 1 ? 'session' : 'sessions' }}
                                    </span>

                                    <span>
                                        <i class='bx bx-calendar-week'></i>
                                        {{ $dayCount }}
                                        {{ $dayCount === 1 ? 'day' : 'days' }}
                                    </span>

                                </div>

                            </div>

                        </div>


                        {{-- =================================================
                            ACTION
                        ================================================== --}}
                        <div class="schedule-actions">

                            <a
                                href="{{ route('professor.schedule.show', $firstSchedule->id) }}"
                                class="schedule-view-btn"
                            >
                                <span>View Schedule</span>
                                <i class='bx bx-right-arrow-alt'></i>
                            </a>

                        </div>

                    </article>

                @endforeach

            </div>

        @else

            {{-- ========================================================
                EMPTY STATE
            ========================================================= --}}
            <div class="schedule-empty">

                <div class="empty-illustration">

                    <div class="empty-circle circle-one"></div>
                    <div class="empty-circle circle-two"></div>

                    <div class="empty-calendar">
                        <i class='bx bx-calendar-x'></i>
                    </div>

                </div>

                <span class="empty-kicker">NO PUBLISHED SCHEDULES</span>

                <h3>No schedules available</h3>

                <p>
                    There are currently no published schedules available.
                    A schedule will appear here after the Head of Department publishes it.
                </p>

            </div>

        @endif

    </div>

</div>


<style>

    /* ============================================================
       PAGE
       ============================================================ */

    .professor-schedules-page {
        width: min(1220px, calc(100% - 40px));
        margin: 0 auto;
        padding: 34px 0 65px;
        color: #172033;
    }


    /* ============================================================
       HEADER
       ============================================================ */

    .schedules-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 22px;
        margin-bottom: 25px;
        animation: scheduleFadeUp .5s ease both;
    }

    .schedules-header-left {
        display: flex;
        align-items: center;
        gap: 16px;
        min-width: 0;
    }

    .schedules-icon {
        width: 58px;
        height: 58px;
        flex: 0 0 auto;
        display: grid;
        place-items: center;
        border-radius: 18px;
        background: linear-gradient(135deg, #dbeafe, #ede9fe);
        color: #4f46e5;
        font-size: 28px;
        box-shadow: 0 12px 27px rgba(79, 70, 229, .11);
        animation: scheduleFloat 3.5s ease-in-out infinite;
    }

    .schedules-eyebrow {
        display: block;
        margin-bottom: 5px;
        color: #6366f1;
        font-size: 11px;
        font-weight: 900;
        letter-spacing: .1em;
        text-transform: uppercase;
    }

    .schedules-header h1 {
        margin: 0;
        color: #111827;
        font-size: clamp(29px, 4vw, 38px);
        line-height: 1.05;
        letter-spacing: -.035em;
        font-weight: 850;
    }

    .schedules-header p {
        margin: 8px 0 0;
        color: #64748b;
        font-size: 14px;
        line-height: 1.5;
    }


    /* ============================================================
       STATS
       ============================================================ */

    .schedule-stats {
        display: grid;
        grid-template-columns: 1fr 1fr 1fr;
        gap: 14px;
        margin-bottom: 20px;
    }

    .schedule-stat-card {
        position: relative;
        display: flex;
        align-items: center;
        gap: 12px;
        min-width: 0;
        padding: 17px;
        border-radius: 18px;
        border: 1px solid #e7ebf2;
        background: #ffffff;
        box-shadow: 0 8px 23px rgba(15, 23, 42, .045);
        overflow: hidden;
        animation: scheduleFadeUp .55s ease both;
        transition: transform .18s ease, box-shadow .18s ease;
    }

    .schedule-stat-card::after {
        content: "";
        position: absolute;
        right: -20px;
        bottom: -26px;
        width: 85px;
        height: 85px;
        border-radius: 50%;
        opacity: .55;
    }

    .schedule-stat-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 13px 28px rgba(15, 23, 42, .07);
    }

    .stat-blue::after {
        background: #dbeafe;
    }

    .stat-purple::after {
        background: #ede9fe;
    }

    .stat-yellow::after {
        background: #fef3c7;
    }

    .stat-icon {
        width: 43px;
        height: 43px;
        flex: 0 0 auto;
        display: grid;
        place-items: center;
        border-radius: 14px;
        font-size: 20px;
    }

    .stat-blue .stat-icon {
        background: #dbeafe;
        color: #2563eb;
    }

    .stat-purple .stat-icon {
        background: #ede9fe;
        color: #7c3aed;
    }

    .stat-yellow .stat-icon {
        background: #fef3c7;
        color: #d97706;
    }

    .stat-content {
        min-width: 0;
        position: relative;
        z-index: 1;
    }

    .stat-content span {
        display: block;
        margin-bottom: 3px;
        color: #94a3b8;
        font-size: 10px;
        font-weight: 850;
        letter-spacing: .07em;
        text-transform: uppercase;
    }

    .stat-content strong {
        display: block;
        max-width: 240px;
        color: #1e293b;
        font-size: 17px;
        font-weight: 850;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }


    /* ============================================================
       PANEL
       ============================================================ */

    .schedules-panel {
        padding: 23px;
        border: 1px solid #e7ebf2;
        border-radius: 23px;
        background: #ffffff;
        box-shadow: 0 13px 35px rgba(15, 23, 42, .05);
        animation: scheduleFadeUp .65s ease both;
    }

    .schedules-panel-top {
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        gap: 15px;
        margin-bottom: 18px;
    }

    .panel-kicker {
        display: block;
        margin-bottom: 3px;
        color: #a1aab8;
        font-size: 10px;
        font-weight: 900;
        letter-spacing: .1em;
        text-transform: uppercase;
    }

    .schedules-panel-top h2 {
        margin: 0;
        color: #1e293b;
        font-size: 21px;
        letter-spacing: -.025em;
    }

    .schedules-panel-top p {
        margin: 5px 0 0;
        color: #64748b;
        font-size: 12px;
    }

    .schedule-count-badge {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 8px 11px;
        border-radius: 999px;
        background: #f8fafc;
        border: 1px solid #e2e8f0;
        color: #475569;
        font-size: 10.5px;
        font-weight: 850;
        white-space: nowrap;
    }

    .schedule-count-badge i {
        font-size: 15px;
        color: #6366f1;
    }


    /* ============================================================
       SCHEDULE LIST
       ============================================================ */

    .schedule-list {
        display: grid;
        gap: 13px;
    }

    .schedule-card {
        position: relative;
        display: flex;
        align-items: stretch;
        justify-content: space-between;
        gap: 17px;
        padding: 17px 18px 17px 20px;
        border: 1px solid #e5eaf1;
        border-radius: 18px;
        background: #ffffff;
        overflow: hidden;
        transition: transform .2s ease, box-shadow .2s ease, border-color .2s ease;
        animation: scheduleCardIn .35s ease both;
    }

    .schedule-card:hover {
        transform: translateY(-2px);
        border-color: #c7d2fe;
        box-shadow: 0 13px 27px rgba(15, 23, 42, .065);
    }

    .schedule-card-accent {
        position: absolute;
        top: 0;
        left: 0;
        bottom: 0;
        width: 4px;
        background: linear-gradient(180deg, #818cf8, #c4b5fd);
    }

    .schedule-main {
        display: flex;
        align-items: flex-start;
        gap: 14px;
        min-width: 0;
        flex: 1;
    }

    .schedule-icon-box {
        width: 58px;
        min-height: 58px;
        flex: 0 0 auto;
        display: grid;
        place-items: center;
        border-radius: 15px;
        background: #eef2ff;
        color: #4f46e5;
        font-size: 24px;
    }

    .schedule-information {
        min-width: 0;
        flex: 1;
    }

    .schedule-title-row {
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        gap: 12px;
        min-width: 0;
    }

    .schedule-kicker {
        display: block;
        margin-bottom: 4px;
        color: #a1aab8;
        font-size: 9px;
        font-weight: 900;
        letter-spacing: .09em;
    }

    .schedule-title-row h3 {
        margin: 0;
        color: #1e293b;
        font-size: 16px;
        line-height: 1.35;
        font-weight: 850;
    }

    .schedule-status {
        display: inline-flex;
        align-items: center;
        gap: 7px;
        flex: 0 0 auto;
        padding: 5px 9px;
        border-radius: 999px;
        background: #ecfdf5;
        color: #047857;
        border: 1px solid #bbf7d0;
        font-size: 9.5px;
        font-weight: 850;
        white-space: nowrap;
    }

    .schedule-status-dot {
        width: 7px;
        height: 7px;
        flex: 0 0 7px;
        border-radius: 50%;
        background: #16a34a;
    }

    .schedule-meta {
        display: flex;
        align-items: center;
        flex-wrap: wrap;
        gap: 8px 15px;
        margin-top: 10px;
        color: #94a3b8;
        font-size: 10px;
        font-weight: 700;
    }

    .schedule-meta span {
        display: inline-flex;
        align-items: center;
        gap: 4px;
    }

    .schedule-meta i {
        color: #818cf8;
        font-size: 14px;
    }


    /* ============================================================
       ACTION
       ============================================================ */

    .schedule-actions {
        display: flex;
        align-items: center;
        justify-content: flex-end;
        flex: 0 0 auto;
    }

    .schedule-view-btn {
        min-height: 39px;
        padding: 9px 13px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 7px;
        border-radius: 11px;
        border: 1px solid #6366f1;
        background: #6366f1;
        color: #ffffff;
        text-decoration: none;
        font-size: 11px;
        font-weight: 850;
        white-space: nowrap;
        box-shadow: 0 9px 20px rgba(99, 102, 241, .14);
        transition: transform .17s ease, background .17s ease, box-shadow .17s ease;
    }

    .schedule-view-btn i {
        font-size: 16px;
    }

    .schedule-view-btn:hover {
        color: #ffffff;
        background: #4f46e5;
        transform: translateY(-1px);
        box-shadow: 0 13px 24px rgba(99, 102, 241, .2);
    }


    /* ============================================================
       EMPTY
       ============================================================ */

    .schedule-empty {
        min-height: 330px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-direction: column;
        padding: 35px 20px;
        text-align: center;
    }

    .empty-illustration {
        position: relative;
        width: 100px;
        height: 85px;
        margin-bottom: 14px;
    }

    .empty-circle {
        position: absolute;
        border-radius: 50%;
        animation: emptyFloat 3s ease-in-out infinite;
    }

    .circle-one {
        width: 56px;
        height: 56px;
        top: 5px;
        left: 5px;
        background: #dbeafe;
    }

    .circle-two {
        width: 42px;
        height: 42px;
        right: 7px;
        bottom: 5px;
        background: #ede9fe;
        animation-delay: -.9s;
    }

    .empty-calendar {
        position: absolute;
        left: 29px;
        top: 18px;
        width: 46px;
        height: 46px;
        display: grid;
        place-items: center;
        border-radius: 15px;
        background: #ffffff;
        border: 1px solid #e7ebf2;
        box-shadow: 0 10px 21px rgba(15, 23, 42, .08);
        color: #6366f1;
        font-size: 22px;
    }

    .empty-kicker {
        display: block;
        margin-bottom: 4px;
        color: #a1aab8;
        font-size: 10px;
        font-weight: 900;
        letter-spacing: .1em;
        text-transform: uppercase;
    }

    .schedule-empty h3 {
        margin: 0;
        color: #1e293b;
        font-size: 19px;
        font-weight: 850;
    }

    .schedule-empty p {
        max-width: 510px;
        margin: 7px auto 0;
        color: #64748b;
        font-size: 12px;
        line-height: 1.6;
    }


    /* ============================================================
       DARK MODE
       ============================================================ */

    body.dark-mode .professor-schedules-page,
    body.dark .professor-schedules-page,
    body[data-theme="dark"] .professor-schedules-page {
        color: #e5e7eb;
    }

    body.dark-mode .schedules-header h1,
    body.dark .schedules-header h1,
    body[data-theme="dark"] .schedules-header h1 {
        color: #f8fafc;
    }

    body.dark-mode .schedules-header p,
    body.dark .schedules-header p,
    body[data-theme="dark"] .schedules-header p,
    body.dark-mode .schedules-panel-top p,
    body.dark .schedules-panel-top p,
    body[data-theme="dark"] .schedules-panel-top p {
        color: #94a3b8;
    }

    body.dark-mode .schedule-stat-card,
    body.dark .schedule-stat-card,
    body[data-theme="dark"] .schedule-stat-card,
    body.dark-mode .schedules-panel,
    body.dark .schedules-panel,
    body[data-theme="dark"] .schedules-panel,
    body.dark-mode .schedule-card,
    body.dark .schedule-card,
    body[data-theme="dark"] .schedule-card {
        background: var(--card-color);
        border-color: #2a3140;
        box-shadow: 0 12px 30px rgba(0, 0, 0, .22);
    }

    body.dark-mode .schedule-stat-card:hover,
    body.dark .schedule-stat-card:hover,
    body[data-theme="dark"] .schedule-stat-card:hover,
    body.dark-mode .schedule-card:hover,
    body.dark .schedule-card:hover,
    body[data-theme="dark"] .schedule-card:hover {
        border-color: #48536a;
        box-shadow: 0 16px 34px rgba(0, 0, 0, .28);
    }

    body.dark-mode .stat-blue .stat-icon,
    body.dark .stat-blue .stat-icon,
    body[data-theme="dark"] .stat-blue .stat-icon {
        background: #172554;
        color: #60a5fa;
    }

    body.dark-mode .stat-purple .stat-icon,
    body.dark .stat-purple .stat-icon,
    body[data-theme="dark"] .stat-purple .stat-icon {
        background: #2e1065;
        color: #c084fc;
    }

    body.dark-mode .stat-yellow .stat-icon,
    body.dark .stat-yellow .stat-icon,
    body[data-theme="dark"] .stat-yellow .stat-icon {
        background: #422006;
        color: #fbbf24;
    }

    body.dark-mode .stat-blue::after,
    body.dark .stat-blue::after,
    body[data-theme="dark"] .stat-blue::after {
        background: #172554;
    }

    body.dark-mode .stat-purple::after,
    body.dark .stat-purple::after,
    body[data-theme="dark"] .stat-purple::after {
        background: #2e1065;
    }

    body.dark-mode .stat-yellow::after,
    body.dark .stat-yellow::after,
    body[data-theme="dark"] .stat-yellow::after {
        background: #3a2410;
    }

    body.dark-mode .stat-yellow .stat-icon,
    body.dark .stat-yellow .stat-icon,
    body[data-theme="dark"] .stat-yellow .stat-icon {
        background: #38220d;
        color: #f5b84b;
    }

    body.dark-mode .stat-content span,
    body.dark .stat-content span,
    body[data-theme="dark"] .stat-content span,
    body.dark-mode .panel-kicker,
    body.dark .panel-kicker,
    body[data-theme="dark"] .panel-kicker {
        color: #7f8ea3;
    }

    body.dark-mode .stat-content strong,
    body.dark .stat-content strong,
    body[data-theme="dark"] .stat-content strong,
    body.dark-mode .schedules-panel-top h2,
    body.dark .schedules-panel-top h2,
    body[data-theme="dark"] .schedules-panel-top h2 {
        color: #f1f5f9;
    }

    body.dark-mode .schedule-count-badge,
    body.dark .schedule-count-badge,
    body[data-theme="dark"] .schedule-count-badge {
        background: #202633;
        border-color: #30394a;
        color: #cbd5e1;
    }

    body.dark-mode .schedule-card:hover,
    body.dark .schedule-card:hover,
    body[data-theme="dark"] .schedule-card:hover {
        background: #1b202b;
        border-color: #3a4558;
    }

    body.dark-mode .schedule-title-row h3,
    body.dark .schedule-title-row h3,
    body[data-theme="dark"] .schedule-title-row h3 {
        color: #f1f5f9;
    }

    body.dark-mode .schedule-kicker,
    body.dark .schedule-kicker,
    body[data-theme="dark"] .schedule-kicker {
        color: #8b98aa;
    }

    body.dark-mode .schedule-meta,
    body.dark .schedule-meta,
    body[data-theme="dark"] .schedule-meta {
        color: #9aa7b9;
    }

    body.dark-mode .schedule-meta i,
    body.dark .schedule-meta i,
    body[data-theme="dark"] .schedule-meta i {
        color: #8f85ff;
    }

    body.dark-mode .schedule-icon-box,
    body.dark .schedule-icon-box,
    body[data-theme="dark"] .schedule-icon-box {
        background: #20255a;
        color: #a5b4fc;
    }

    body.dark-mode .schedule-information,
    body.dark .schedule-information,
    body[data-theme="dark"] .schedule-information {
        color: #cbd5e1;
    }

    body.dark-mode .schedule-actions,
    body.dark .schedule-actions,
    body[data-theme="dark"] .schedule-actions {
        border-color: #30394a;
    }

    body.dark-mode .schedule-empty,
    body.dark .schedule-empty,
    body[data-theme="dark"] .schedule-empty {
        background: #171b24;
        border-color: #2a3140;
        color: #cbd5e1;
    }

    body.dark-mode .schedule-empty h3,
    body.dark .schedule-empty h3,
    body[data-theme="dark"] .schedule-empty h3 {
        color: #f1f5f9;
    }

    body.dark-mode .schedule-empty p,
    body.dark .schedule-empty p,
    body[data-theme="dark"] .schedule-empty p {
        color: #94a3b8;
    }

    body.dark-mode .empty-calendar,
    body.dark .empty-calendar,
    body[data-theme="dark"] .empty-calendar {
        background: #202633;
        border-color: #30394a;
        color: #a5b4fc;
        box-shadow: 0 10px 24px rgba(0, 0, 0, .24);
    }

    body.dark-mode .empty-kicker,
    body.dark .empty-kicker,
    body[data-theme="dark"] .empty-kicker {
        color: #7f8ea3;
    }

    body.dark-mode .circle-one,
    body.dark .circle-one,
    body[data-theme="dark"] .circle-one {
        background: #172554;
    }

    body.dark-mode .circle-two,
    body.dark .circle-two,
    body[data-theme="dark"] .circle-two {
        background: #2e1065;
    }


    /* ============================================================
       ANIMATION
       ============================================================ */

    @keyframes scheduleFadeUp {
        from {
            opacity: 0;
            transform: translateY(9px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @keyframes scheduleCardIn {
        from {
            opacity: 0;
            transform: translateY(7px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @keyframes scheduleFloat {
        0%, 100% {
            transform: translateY(0);
        }

        50% {
            transform: translateY(-4px);
        }
    }

    @keyframes emptyFloat {
        0%, 100% {
            transform: translateY(0);
        }

        50% {
            transform: translateY(-5px);
        }
    }


    /* ============================================================
       RESPONSIVE
       ============================================================ */

    @media (max-width: 980px) {

        .schedule-stats {
            grid-template-columns: 1fr 1fr;
        }

        .schedule-stat-card.stat-yellow {
            grid-column: span 2;
        }

    }


    @media (max-width: 760px) {

        .professor-schedules-page {
            width: min(100% - 24px, 680px);
            padding-top: 22px;
        }

        .schedules-header-left {
            align-items: flex-start;
        }

        .schedule-stats {
            grid-template-columns: 1fr;
        }

        .schedule-stat-card.stat-yellow {
            grid-column: auto;
        }

        .schedules-panel {
            padding: 18px;
        }

        .schedules-panel-top {
            flex-direction: column;
        }

        .schedule-card {
            flex-direction: column;
        }

        .schedule-actions {
            justify-content: flex-end;
            padding-top: 11px;
            border-top: 1px solid #eef2f6;
        }

    }


    @media (max-width: 520px) {

        .schedules-header-left {
            align-items: flex-start;
        }

        .schedules-icon {
            width: 50px;
            height: 50px;
            border-radius: 15px;
            font-size: 23px;
        }

        .schedules-header h1 {
            font-size: 28px;
        }

        .schedule-main {
            gap: 11px;
        }

        .schedule-icon-box {
            width: 50px;
            min-height: 50px;
            border-radius: 13px;
            font-size: 21px;
        }

        .schedule-title-row {
            align-items: flex-start;
            flex-direction: column;
        }

        .schedule-status {
            align-self: flex-start;
        }

        .schedule-view-btn {
            width: 100%;
        }

        .schedule-actions {
            width: 100%;
        }

    }

</style>

@endsection
