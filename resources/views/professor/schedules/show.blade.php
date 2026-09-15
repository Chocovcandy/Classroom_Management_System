@extends('layouts.prof_layout')

@section('title', 'Schedule Details')

@section('content')

<div class="docx-preview-page">

    {{-- =====================================================
             PAGE HEADER
        ====================================================== --}}

    <div class="preview-header">
        <div class="preview-title-area">
            <div class="preview-brand-icon" aria-hidden="true">
                <i class='bx bx-file-find'></i>
            </div>

            <div class="preview-heading">
                <div class="preview-eyebrow">SCHEDULE • OFFICIAL PUBLISHED SCHEDULE</div>
                <h1>Schedule Details</h1>
                <p>Official published weekly schedule. This page is read-only.</p>
            </div>
        </div>
    </div>

    <div class="preview-action-row professor-detail-actions">
        <div class="preview-action-left">
            <a
                href="{{ route('professor.schedule.index') }}"
                class="preview-action preview-back-action"
            >
                <i class='bx bx-arrow-back'></i>
                <span>Back to My Schedules</span>
            </a>
<a
    href="{{ route('professor.schedule.downloadDocx', $schedule->id) }}"
    class="preview-action preview-download-action"
>
    <i class='bx bx-download'></i>
    <span>Download DOCX</span>
</a>
        </div>

        <div class="professor-published-state">
            <span class="professor-published-dot"></span>
            <span>Published Schedule</span>
        </div>
    </div>

    {{-- =====================================================
             DOCUMENT PREVIEW
        ====================================================== --}}

    <div class="document-preview-wrapper">

        <div class="document-paper">

            {{-- HEADER --}}

            <div class="document-header">

                <div class="document-logo">
                    <img
                        src="{{ asset('assets/img/Life_circle_blue_LG.png') }}"
                        alt="Life University">
                </div>

                <div class="document-header-text">

                    <div class="document-university">
                        LIFE UNIVERSITY
                    </div>

                    <div class="document-college">
                        COLLEGE SCIENCE AND ENGINEERING
                    </div>

                    <div class="document-degree">
                        BACHELOR DEGREE OF COMPUTER SCIENCE
                        YEAR {{ $year }}
                    </div>

                    <div class="document-promotion">
                        PROMOTION {{ $schedule->promotion }},
                        {{ $semesterText }}
                    </div>

                    <div class="document-academic">
                        ACADEMIC :
                        {{ str_replace('-', ' – ', $schedule->academic_year) }}
                    </div>

                </div>

            </div>


            {{-- SCHEDULE TABLE --}}

            <table class="document-table">

                <thead>
                    <tr>
                        <th>TIME</th>

                        @foreach([
                            'Monday',
                            'Tuesday',
                            'Wednesday',
                            'Thursday',
                            'Friday'
                        ] as $dayName)

                            <th>
                                {{ strtoupper($dayName) }}
                            </th>

                        @endforeach
                    </tr>
                </thead>

                <tbody>

                    @foreach($timeSlots as $timeSlot)

                        <tr>

                            <td class="document-time">
                                {{ date('g:iA', strtotime($timeSlot->start_time)) }}
                                -
                                {{ date('g:iA', strtotime($timeSlot->end_time)) }}
                            </td>

                            @foreach([
                                'Monday',
                                'Tuesday',
                                'Wednesday',
                                'Thursday',
                                'Friday'
                            ] as $dayName)

                                @php
                                    $daySchedule = $schedules
                                        ->where('day_of_week', $dayName)
                                        ->where('slot_id', $timeSlot->id)
                                        ->first();
                                @endphp

                                <td>

                                    @if($daySchedule)

                                        @if(($daySchedule->activity_type ?? 'course') === 'course')

                                            <div class="preview-course">
                                                {{ $daySchedule->course?->course_name }}
                                            </div>

                                            @if($daySchedule->professor?->name)
                                                <div class="preview-professor">
                                                    Prof. {{ $daySchedule->professor->name }}
                                                </div>
                                            @endif

                                            @php
                                                $combinedYears = $daySchedule->scheduleDepartments
                                                    ->where(
                                                        'department_id',
                                                        $department?->id
                                                    )
                                                    ->pluck('year_level')
                                                    ->map(fn ($yearLevel) => (int) $yearLevel)
                                                    ->filter(
                                                        fn ($yearLevel) =>
                                                            $yearLevel !== (int) $year
                                                    )
                                                    ->unique()
                                                    ->sort()
                                                    ->values();

                                                $romanYears = $combinedYears->map(
                                                    function ($yearLevel) {
                                                        return match ($yearLevel) {
                                                            1 => 'I',
                                                            2 => 'II',
                                                            3 => 'III',
                                                            4 => 'IV',
                                                            default => (string) $yearLevel,
                                                        };
                                                    }
                                                );
                                            @endphp

                                            @if($romanYears->isNotEmpty())
                                                <div class="preview-combined-year">
                                                    Combine Year {{ $romanYears->implode(', ') }}
                                                </div>
                                            @endif

<div class="preview-mode">
    {{ ucfirst($daySchedule->teaching_mode ?? 'offline') }}
</div>

                                            @if($daySchedule->room?->room_name)
                                                <div class="preview-room">
                                                    Room :
                                                    {{ $daySchedule->room->room_name }}
                                                </div>
                                            @endif

                                        @else

                                            @php
                                                $activityLabel = match ($daySchedule->activity_type) {
                                                    'chapel' => 'Chapel',
                                                    'break' => 'Break',
                                                    'free' => 'Free Time',
                                                    'other' => 'Other',
                                                    default => 'Other',
                                                };
                                            @endphp

                                            <div class="preview-special-activity">
                                                {{ $activityLabel }}
                                            </div>

                                            @if(!empty($daySchedule->special_note))
                                                <div class="preview-special-note">
                                                    {{ $daySchedule->special_note }}
                                                </div>
                                            @endif

                                        @endif

                                    @else

                                        <span class="preview-empty">
                                            —
                                        </span>

                                    @endif

                                </td>

                            @endforeach

                        </tr>

                    @endforeach

                </tbody>

            </table>


            {{-- =====================================================
                 DATES
            ====================================================== --}}

            <div class="document-info-grid">

                <div>
                    <strong>
                        Starting Date:
                    </strong>

                    {{ $schedule->starting_date
                        ? date('d/m/Y', strtotime($schedule->starting_date))
                        : ''
                    }}

                    <br>

                    <strong>
                        Finished Date:
                    </strong>

                    {{ $schedule->finished_date
                        ? date('d/m/Y', strtotime($schedule->finished_date))
                        : ''
                    }}
                </div>

                <div>
                    <strong>
                        Mid-Term Exam:
                    </strong>

                    {{ $schedule->midterm_exam_start
                        ? date('d/m/Y', strtotime($schedule->midterm_exam_start))
                        : ''
                    }}

                    <br>

                    <strong>
                        Final Exam:
                    </strong>

                    {{ $schedule->final_exam_start
                        ? date('d/m/Y', strtotime($schedule->final_exam_start))
                        : ''
                    }}
                </div>

            </div>


            {{-- =====================================================
                 NOTE
            ====================================================== --}}

            <div class="document-note">

                <strong>Note:</strong>
                Professors/Lecturers are asked to give the final exam in
                softcopy to Academic office at least 2 weeks before the
                final examination

                @if(!empty($schedule->note))
                    <br>
                    <strong>Additional Note:</strong>
                    {{ $schedule->note }}
                @endif

            </div>


            {{-- =====================================================
                 APPROVAL
            ====================================================== --}}

            <div class="document-approval">

                @if($year == 1)

                    <div class="approval-column">

                        <span>
                            Date:
                            {{ $schedule->created_at
                                ? $schedule->created_at->format('d/m/Y')
                                : now()->format('d/m/Y')
                            }}
                        </span>

                        <strong>
                            HEAD OF FOUNDATION YEAR DEPARTMENT
                        </strong>

                        <div class="signature-space"></div>

                        <strong>
                            SOEUNG SAMBATH
                        </strong>

                    </div>

                @else

                    <div class="approval-column">

                        <span>
                            Date:
                            {{ $schedule->created_at
                                ? $schedule->created_at->format('d/m/Y')
                                : now()->format('d/m/Y')
                            }}
                        </span>

                        <strong>
                            HEAD OF ACADEMIC OFFICE
                        </strong>

                        <div class="signature-space"></div>

                        <strong>
                            LEC. SAN PISETH
                        </strong>

                    </div>

                    <div class="approval-column">

                        <span>
                            Date:
                            {{ $schedule->created_at
                                ? $schedule->created_at->format('d/m/Y')
                                : now()->format('d/m/Y')
                            }}
                        </span>

                        <strong>
                            HEAD OF {{ strtoupper($department->department_name) }}
                        </strong>

                        <div class="signature-space"></div>

                        <strong>
                            LEC.
                            {{ strtoupper(
                                $department->head?->name
                                ?? 'DEPARTMENT HEAD NOT ASSIGNED'
                            ) }}
                        </strong>

                    </div>

                @endif

            </div>

        </div>

    </div>

</div>

<style>
    /* ============================================================
       PAGE
       ============================================================ */

    .docx-preview-page {
        width: min(1220px, calc(100% - 40px));
        margin: 0 auto;
        padding: 34px 0 65px;
        color: #172033;
        background: transparent;
    }


    /* ============================================================
       HEADER
       ============================================================ */

    .preview-header {
        display: flex;
        align-items: center;
        margin-bottom: 24px;
        animation: scheduleFadeUp .5s ease both;
    }

    .preview-title-area {
        display: flex;
        align-items: center;
        gap: 16px;
        min-width: 0;
    }

    .preview-brand-icon {
        width: 58px;
        height: 58px;
        flex: 0 0 auto;
        display: grid;
        place-items: center;
        border-radius: 18px;
        background: linear-gradient(135deg, #dbeafe, #ede9fe);
        border: 1px solid #e0e7ff;
        color: #4f46e5;
        font-size: 28px;
        box-shadow: 0 12px 27px rgba(79, 70, 229, .11);
        animation: scheduleFloat 3.5s ease-in-out infinite;
    }

    .preview-heading {
        min-width: 0;
    }

    .preview-eyebrow {
        display: block;
        margin-bottom: 5px;
        color: #6366f1;
        font-size: 11px;
        font-weight: 900;
        letter-spacing: .1em;
        text-transform: uppercase;
    }

    .preview-header h1 {
        margin: 0;
        color: #111827;
        font-size: clamp(29px, 4vw, 38px);
        line-height: 1.05;
        letter-spacing: -.035em;
        font-weight: 850;
    }

    .preview-header p {
        margin: 8px 0 0;
        color: #64748b;
        font-size: 14px;
        line-height: 1.5;
    }


    /* ============================================================
       ACTION / STATUS
       ============================================================ */

    .preview-action-row {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 16px;
        margin-bottom: 20px;
        animation: scheduleFadeUp .55s ease both;
    }

    .preview-action-left {
        display: flex;
        align-items: center;
        gap: 10px;
        flex-wrap: wrap;
    }

    .preview-action {
        min-height: 43px;
        padding: 9px 13px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 7px;
        border-radius: 12px;
        text-decoration: none;
        font-size: 11px;
        font-weight: 850;
        white-space: nowrap;
        transition: transform .16s ease, background .16s ease, border-color .16s ease, box-shadow .16s ease;
    }

    .preview-action i {
        font-size: 17px;
    }

    .preview-action:hover {
        transform: translateY(-1px);
    }

    .preview-back-action {
        border: 1px solid #dbe2ea;
        background: #ffffff;
        color: #2563eb;
        box-shadow: 0 6px 18px rgba(15, 23, 42, .04);
    }

    .preview-back-action:hover {
        background: #eff6ff;
        border-color: #bfdbfe;
        box-shadow: 0 10px 21px rgba(37, 99, 235, .08);
    }

    .preview-download-action {
        border: 1px solid #6366f1;
        background: linear-gradient(135deg, #6366f1, #4f46e5);
        color: #ffffff;
        box-shadow: 0 10px 22px rgba(79, 70, 229, .16);
    }

    .preview-download-action:hover {
        background: linear-gradient(135deg, #4f46e5, #4338ca);
        border-color: #4f46e5;
        box-shadow: 0 13px 26px rgba(79, 70, 229, .2);
    }

    .professor-published-state {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        min-height: 43px;
        padding: 9px 13px;
        border: 1px solid #bbf7d0;
        border-radius: 12px;
        background: #ecfdf5;
        color: #047857;
        font-size: 11px;
        font-weight: 850;
        white-space: nowrap;
    }

    .professor-published-dot {
        width: 8px;
        height: 8px;
        flex: 0 0 8px;
        border-radius: 50%;
        background: #16a34a;
        box-shadow: 0 0 0 3px rgba(22, 163, 74, .12);
    }


    /* ============================================================
       DOCUMENT PANEL
       ============================================================ */

    .document-preview-wrapper {
        padding: 23px;
        border: 1px solid #e7ebf2;
        border-radius: 23px;
        background: #ffffff;
        box-shadow: 0 13px 35px rgba(15, 23, 42, .05);
        animation: scheduleFadeUp .65s ease both;
        overflow-x: auto;
    }

    .document-paper {
        width: 1120px;
        min-height: 790px;
        margin: 0 auto;
        padding: 34px 42px 40px;
        background: #ffffff;
        border: 1px solid #e5eaf1;
        box-shadow: 0 10px 25px rgba(15, 23, 42, .05);
        font-family: "Times New Roman", serif;
        color: #000000;
    }


    /* ============================================================
       OFFICIAL DOCUMENT HEADER
       ============================================================ */

    .document-header {
        display: grid;
        grid-template-columns: 100px 1fr;
        align-items: center;
        margin-bottom: 18px;
    }

    .document-logo {
        display: flex;
        justify-content: center;
    }

    .document-logo img {
        width: 65px;
        height: 65px;
        object-fit: contain;
    }

    .document-header-text {
        text-align: center;
    }

    .document-university {
        font-size: 20px;
        font-weight: 800;
    }

    .document-college {
        margin-top: 3px;
        font-size: 15px;
    }

    .document-degree,
    .document-promotion,
    .document-academic {
        margin-top: 2px;
        font-size: 13px;
    }


    /* ============================================================
       SCHEDULE TABLE
       KEEP THIS TABLE STYLING UNCHANGED
       ============================================================ */

    .document-table {
        width: 100%;
        border-collapse: collapse;
        table-layout: fixed;
        margin-top: 12px;
    }

    .document-table th,
    .document-table td {
        border: 1px solid #000000;
    }

    .document-table th {
        height: 38px;
        background: #7ccfe3;
        text-align: center;
        font-size: 12px;
        font-weight: 800;
    }

    .document-table td {
        min-height: 92px;
        padding: 8px;
        text-align: center;
        vertical-align: middle;
        font-size: 11px;
    }

    .document-table th:first-child,
    .document-table td:first-child {
        width: 115px;
    }

    .document-time {
        font-weight: 800;
        white-space: nowrap;
    }

    .preview-course {
        font-size: 12px;
        line-height: 1.25;
    }

    .preview-professor {
        margin-top: 3px;
        font-size: 11px;
    }

    .preview-combined-year {
        margin-top: 3px;
        font-size: 10px;
        line-height: 1.25;
        color: #c62828;
        font-weight: 500;
    }

    .preview-mode {
        margin-top: 3px;
        font-size: 10px;
    }

    .preview-room {
        margin-top: 3px;
        font-size: 10px;
    }

    .preview-empty {
        color: #94a3b8;
        font-size: 15px;
    }

    .preview-special-activity {
        font-size: 12px;
        font-weight: 800;
        line-height: 1.25;
    }

    .preview-special-note {
        margin-top: 3px;
        font-size: 10px;
        line-height: 1.25;
    }


    /* ============================================================
       INFORMATION
       ============================================================ */

    .document-info-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 30px;
        margin-top: 20px;
        font-size: 11px;
        line-height: 1.8;
    }

    .document-note {
        margin-top: 16px;
        font-size: 10px;
    }


    /* ============================================================
       APPROVAL
       ============================================================ */

    .document-approval {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 30px;
        margin-top: 32px;
    }

    .approval-column {
        display: flex;
        flex-direction: column;
        gap: 5px;
        font-size: 11px;
    }

    .approval-column strong {
        font-size: 11px;
    }

    .signature-space {
        height: 70px;
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

    @keyframes scheduleFloat {
        0%, 100% {
            transform: translateY(0);
        }

        50% {
            transform: translateY(-4px);
        }
    }


    /* ============================================================
       RESPONSIVE
       ============================================================ */

    @media (max-width: 1050px) {
        .docx-preview-page {
            width: min(100% - 40px, 900px);
        }
    }

    @media (max-width: 760px) {

        .docx-preview-page {
            width: min(100% - 24px, 680px);
            padding-top: 22px;
        }

        .preview-title-area {
            align-items: flex-start;
        }

        .preview-brand-icon {
            width: 50px;
            height: 50px;
            flex-basis: 50px;
            border-radius: 15px;
            font-size: 23px;
        }

        .preview-header h1 {
            font-size: 28px;
        }

        .preview-action-row {
            flex-direction: column;
            align-items: stretch;
        }

        .professor-published-state,
        .preview-back-action,
        .preview-download-action {
            width: 100%;
        }

        .professor-published-state {
            justify-content: center;
        }

        .document-preview-wrapper {
            padding: 14px;
        }
    }

    @media (max-width: 520px) {

        .docx-preview-page {
            width: min(100% - 20px, 560px);
        }

        .preview-title-area {
            gap: 11px;
        }

        .preview-header h1 {
            font-size: 26px;
        }

        .preview-header p {
            font-size: 12px;
        }

        .document-preview-wrapper {
            padding: 8px;
        }
    }

    /* ============================================================
       DARK MODE
       Uses the application's global theme colors
       ============================================================ */

    .dark-mode .docx-preview-page {
        color: var(--text-color);
    }

    /* Header */
    .dark-mode .preview-brand-icon {
        background: var(--primary-light);
        border-color: var(--primary-border);
        color: var(--primary-color);
        box-shadow: none;
    }

    .dark-mode .preview-eyebrow {
        color: var(--primary-color);
    }

    .dark-mode .preview-header h1 {
        color: var(--heading-color);
    }

    .dark-mode .preview-header p {
        color: var(--secondary-text-color);
    }

    /* Back button */
    .dark-mode .preview-back-action {
        color: var(--link-color);
        background: var(--card-color);
        border-color: var(--border-color);
        box-shadow: none;
    }

    .dark-mode .preview-back-action:hover {
        color: var(--link-hover-color);
        background: var(--surface-hover);
        border-color: var(--primary-border);
        box-shadow: none;
    }

    /* Download button */
    .dark-mode .preview-download-action {
        background: var(--button-color);
        border-color: var(--button-color);
        color: var(--button-text-color);
        box-shadow: 0 8px 20px rgba(0, 0, 10, .25);
    }

    .dark-mode .preview-download-action:hover {
        background: var(--button-hover-color);
        border-color: var(--button-hover-color);
        box-shadow: 0 10px 24px rgba(0, 0, 10, .35);
    }

    /* Published status */
    .dark-mode .professor-published-state {
        background: rgba(73, 213, 167, .12);
        border-color: rgba(73, 213, 167, .28);
        color: var(--success-color);
    }

    .dark-mode .professor-published-dot {
        background: var(--success-color);
        box-shadow: 0 0 0 3px rgba(73, 213, 167, .12);
    }

    /* Main preview card */
    .dark-mode .document-preview-wrapper {
        background: var(--card-color);
        border-color: var(--border-color);
        box-shadow: 0 12px 30px var(--shadow-color);
    }

    /* Keep the official document itself white */
    .dark-mode .document-paper {
        background: #ffffff;
        border-color: #d9dee8;
        box-shadow: 0 18px 45px rgba(0, 0, 0, .28);
        color: #000000;
    }

    /* Extra protection so the official document stays readable */
    .dark-mode .document-paper .document-university,
    .dark-mode .document-paper .document-college,
    .dark-mode .document-paper .document-degree,
    .dark-mode .document-paper .document-promotion,
    .dark-mode .document-paper .document-academic,
    .dark-mode .document-paper .document-info-grid,
    .dark-mode .document-paper .document-note,
    .dark-mode .document-paper .document-approval {
        color: #000000;
    }

    /* The schedule table remains exactly the same */
    .dark-mode .document-paper .document-table th,
    .dark-mode .document-paper .document-table td {
        color: #000000;
    }

    .dark-mode .document-paper .preview-professor,
    .dark-mode .document-paper .preview-mode,
    .dark-mode .document-paper .preview-room,
    .dark-mode .document-paper .preview-special-note {
        color: #000000;
    }

    .dark-mode .document-paper .preview-empty {
        color: #64748b;
    }

</style>

@endsection