@extends('layouts.student_layout')

@section('title', 'My Class Schedule')

@section('content')

@php
    /*
    |--------------------------------------------------------------------------
    | Academic years fallback
    |--------------------------------------------------------------------------
    */

    $academicYears = collect($academicYears ?? [])
        ->filter(fn ($year) => filled($year))
        ->map(fn ($year) => (string) $year)
        ->unique()
        ->values();

    if ($academicYears->isEmpty()) {
        $currentYear = now()->year;

        $academicYears = collect([
            ($currentYear - 1) . '-' . $currentYear,
            $currentYear . '-' . ($currentYear + 1),
            ($currentYear + 1) . '-' . ($currentYear + 2),
            ($currentYear + 2) . '-' . ($currentYear + 3),
        ]);
    }

    /*
    |--------------------------------------------------------------------------
    | Selected information
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | Get available time slots from the schedules
    |--------------------------------------------------------------------------
    */

    /*
     * Keep all four standard time slots supplied by the controller.
     * This preserves special sessions such as Chapel and Break.
     */
    $availableTimeSlots = collect($availableTimeSlots ?? [])
        ->sortBy('session_number')
        ->values();

    /*
    |--------------------------------------------------------------------------
    | Weekdays
    |--------------------------------------------------------------------------
    */

    $weekdays = [
        'Monday',
        'Tuesday',
        'Wednesday',
        'Thursday',
        'Friday',
    ];

    /*
    |--------------------------------------------------------------------------
    | Find schedule for a specific day and time slot
    |--------------------------------------------------------------------------
    */

    $getSchedule = function ($day, $slotId) use ($schedules) {
        return $schedules->first(function ($item) use ($day, $slotId) {
            return $item->day_of_week === $day
                && (int) $item->slot_id === (int) $slotId;
        });
    };

    /*
    |--------------------------------------------------------------------------
    | Format time
    |--------------------------------------------------------------------------
    */

    $formatTime = function ($time) {
        if (!$time) {
            return '';
        }

        try {
            return \Carbon\Carbon::parse($time)->format('g:iA');
        } catch (\Throwable $exception) {
            return $time;
        }
    };
@endphp

<div class="student-schedule-page">

    {{-- =========================================================
         PAGE HEADER
    ========================================================== --}}

    <div class="schedule-page-header">

        <div class="schedule-page-heading">

            <span class="schedule-page-eyebrow">
                STUDENT PORTAL
            </span>

            <h1>
                My Class Schedule
            </h1>

            <p>
                View your weekly class timetable using your selected study information.
            </p>

        </div>

<div class="schedule-header-actions">

    <button
        type="button"
        class="schedule-primary-button"
        id="openScheduleModal"
    >
        <svg
            width="20"
            height="20"
            viewBox="0 0 24 24"
            fill="none"
            stroke="currentColor"
            stroke-width="2"
            stroke-linecap="round"
            stroke-linejoin="round"
            aria-hidden="true"
        >
            <line x1="4" y1="6" x2="20" y2="6"></line>
            <line x1="4" y1="12" x2="20" y2="12"></line>
            <line x1="4" y1="18" x2="20" y2="18"></line>
            <circle cx="8" cy="6" r="2"></circle>
            <circle cx="16" cy="12" r="2"></circle>
            <circle cx="10" cy="18" r="2"></circle>
        </svg>

        <span>Change Schedule</span>
    </button>

    @if($selectedSchedule && ($searched ?? false))
        <a
            href="{{ route('student.schedule.downloadDocx', request()->query()) }}"
            class="schedule-download-button"
        >
            <svg
                width="20"
                height="20"
                viewBox="0 0 24 24"
                fill="none"
                stroke="currentColor"
                stroke-width="2"
                stroke-linecap="round"
                stroke-linejoin="round"
                aria-hidden="true"
            >
                <path d="M12 3v12"></path>
                <path d="m7 10 5 5 5-5"></path>
                <path d="M5 21h14"></path>
            </svg>

            <span>Download DOCX</span>
        </a>
    @endif

</div>

    </div>


    {{-- =========================================================
         CURRENT SCHEDULE SUMMARY
    ========================================================== --}}

    <div class="schedule-summary-card">

        <div class="schedule-summary-icon">

            <svg
                width="32"
                height="32"
                viewBox="0 0 24 24"
                fill="none"
                stroke="currentColor"
                stroke-width="1.8"
                stroke-linecap="round"
                stroke-linejoin="round"
                aria-hidden="true"
            >
                <rect x="3" y="4" width="18" height="17" rx="2"></rect>
                <line x1="16" y1="2" x2="16" y2="6"></line>
                <line x1="8" y1="2" x2="8" y2="6"></line>
                <line x1="3" y1="10" x2="21" y2="10"></line>
                <path d="M8 15l2 2 5-5"></path>
            </svg>

        </div>

        <div class="schedule-summary-content">

            <span class="schedule-summary-label">
                CURRENT SCHEDULE
            </span>

            @if($selectedSchedule)

                <h2>
                    {{ $selectedDepartment?->department_name ?? 'Selected Department' }}
                </h2>

                <p>
                    Year {{ request('year_level') }}
                    <span>•</span>
                    {{ request('semester') }}
                    <span>•</span>
                    Academic Year {{ request('academic_year') }}
                </p>

            @else

                <h2>
                    Please select your schedule
                </h2>

                <p>
                    Choose your department, year level, semester and academic year.
                </p>

            @endif

        </div>
</div>
{{-- =========================================================
         DOCUMENT-STYLE TIMETABLE
    ========================================================== --}}

    <div class="schedule-document-wrapper">

        @if($selectedSchedule && $availableTimeSlots->count())

            <div class="schedule-document-paper">

                <div class="schedule-document-header">

                    <div class="schedule-document-logo">
                        <img
                            src="{{ asset('assets/img/Life_circle_blue_LG.png') }}"
                            alt="Life University"
                        >
                    </div>

                    <div class="schedule-document-header-text">

                        <div class="schedule-document-university">
                            LIFE UNIVERSITY
                        </div>

                        <div class="schedule-document-college">
                            COLLEGE SCIENCE AND ENGINEERING
                        </div>

                        <div class="schedule-document-degree">
                            BACHELOR DEGREE OF COMPUTER SCIENCE
                            YEAR {{ request('year_level') }}
                        </div>

                        <div class="schedule-document-promotion">
                            PROMOTION {{ $selectedSchedule->promotion }},
                            {{ strtoupper(request('semester')) }}
                        </div>

                        <div class="schedule-document-academic">
                            ACADEMIC :
                            {{ str_replace('-', ' – ', $selectedSchedule->academic_year) }}
                        </div>

                    </div>

                </div>

                <table class="schedule-document-table">

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

                        @foreach($availableTimeSlots as $timeSlot)

                            <tr>

                                <td class="schedule-document-time">
                                    {{ $formatTime($timeSlot->start_time) }}
                                    -
                                    {{ $formatTime($timeSlot->end_time) }}
                                </td>

                                @foreach([
                                    'Monday',
                                    'Tuesday',
                                    'Wednesday',
                                    'Thursday',
                                    'Friday'
                                ] as $dayName)

                                    @php
                                        $daySchedule = $getSchedule(
                                            $dayName,
                                            $timeSlot->id
                                        );
                                    @endphp

                                    <td>

                                        @if($daySchedule)

                                            @if(($daySchedule->activity_type ?? 'course') === 'course')

                                                <div class="schedule-preview-course">
                                                    {{
                                                        $daySchedule->course?->course_name
                                                        ?? $daySchedule->course?->name
                                                        ?? 'Class'
                                                    }}
                                                </div>

                                                @if($daySchedule->professor?->name)
                                                    <div class="schedule-preview-professor">
                                                        Prof. {{ $daySchedule->professor->name }}
                                                    </div>
                                                @endif

                                                @php
                                                    $combinedYears = $daySchedule->scheduleDepartments
                                                        ->where(
                                                            'department_id',
                                                            (int) request('department_id')
                                                        )
                                                        ->pluck('year_level')
                                                        ->map(fn ($yearLevel) => (int) $yearLevel)
                                                        ->filter(
                                                            fn ($yearLevel) =>
                                                                $yearLevel !== (int) request('year_level')
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
                                                    <div class="schedule-preview-combined-year">
                                                        Combine Year {{ $romanYears->implode(', ') }}
                                                    </div>
                                                @endif

                                                <div class="schedule-preview-mode">
                                                    {{ ucfirst($daySchedule->teaching_mode ?? 'offline') }}
                                                </div>

                                                @if($daySchedule->room?->room_name)
                                                    <div class="schedule-preview-room">
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

                                                <div class="schedule-preview-special-activity">
                                                    {{ $activityLabel }}
                                                </div>

                                                @if(!empty($daySchedule->special_note))
                                                    <div class="schedule-preview-special-note">
                                                        {{ $daySchedule->special_note }}
                                                    </div>
                                                @endif

                                            @endif

                                        @else

                                            <span class="schedule-preview-empty">
                                                —
                                            </span>

                                        @endif

                                    </td>

                                @endforeach

                            </tr>

                        @endforeach

                    </tbody>

                </table>

                <div class="schedule-document-info-grid">

                    <div>
                        <strong>Starting Date:</strong>
                        {{
                            $selectedSchedule->starting_date
                                ? date('d/m/Y', strtotime($selectedSchedule->starting_date))
                                : ''
                        }}

                        <br>

                        <strong>Finished Date:</strong>
                        {{
                            $selectedSchedule->finished_date
                                ? date('d/m/Y', strtotime($selectedSchedule->finished_date))
                                : ''
                        }}
                    </div>

                    <div>
                        <strong>Mid-Term Exam:</strong>
                        {{
                            $selectedSchedule->midterm_exam_start
                                ? date('d/m/Y', strtotime($selectedSchedule->midterm_exam_start))
                                : ''
                        }}

                        <br>

                        <strong>Final Exam:</strong>
                        {{
                            $selectedSchedule->final_exam_start
                                ? date('d/m/Y', strtotime($selectedSchedule->final_exam_start))
                                : ''
                        }}
                    </div>

                </div>

                <div class="schedule-document-note">
                    <strong>Note:</strong>
                    Professors/Lecturers are asked to give the final exam in
                    softcopy to Academic office at least 2 weeks before the
                    final examination

                    @if(!empty($selectedSchedule->note))
                        <br>
                        <strong>Additional Note:</strong>
                        {{ $selectedSchedule->note }}
                    @endif
                </div>

                {{-- =====================================================
                     APPROVAL / AUTHORIZATION
                ====================================================== --}}

                <div class="schedule-document-approval">

                    @if((int) request('year_level') === 1)

                        <div class="schedule-approval-column">

                            <span>
                                Date:
                                {{ $selectedSchedule->created_at
                                    ? $selectedSchedule->created_at->format('d/m/Y')
                                    : now()->format('d/m/Y')
                                }}
                            </span>

                            <strong>
                                HEAD OF FOUNDATION YEAR DEPARTMENT
                            </strong>

                            <div class="schedule-signature-space"></div>

                            <strong>
                                SOEUNG SAMBATH
                            </strong>

                        </div>

                    @else

                        <div class="schedule-approval-column">

                            <span>
                                Date:
                                {{ $selectedSchedule->created_at
                                    ? $selectedSchedule->created_at->format('d/m/Y')
                                    : now()->format('d/m/Y')
                                }}
                            </span>

                            <strong>
                                HEAD OF ACADEMIC OFFICE
                            </strong>

                            <div class="schedule-signature-space"></div>

                            <strong>
                                LEC. SAN PISETH
                            </strong>

                        </div>

                        <div class="schedule-approval-column">

                            <span>
                                Date:
                                {{ $selectedSchedule->created_at
                                    ? $selectedSchedule->created_at->format('d/m/Y')
                                    : now()->format('d/m/Y')
                                }}
                            </span>

                            <strong>
                                HEAD OF {{ strtoupper($selectedDepartment?->department_name ?? 'DEPARTMENT') }}
                            </strong>

                            <div class="schedule-signature-space"></div>

                            <strong>
                                LEC.
                                {{ strtoupper(
                                    $selectedDepartment?->head?->name
                                    ?? 'DEPARTMENT HEAD NOT ASSIGNED'
                                ) }}
                            </strong>

                        </div>

                    @endif

                </div>

            </div>

        @else

            <div class="schedule-timetable-card">
                <div class="schedule-empty-state">

                    <div class="schedule-empty-icon">
                        <svg
                            width="42"
                            height="42"
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="1.7"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            aria-hidden="true"
                        >
                            <rect x="3" y="4" width="18" height="17" rx="2"></rect>
                            <line x1="16" y1="2" x2="16" y2="6"></line>
                            <line x1="8" y1="2" x2="8" y2="6"></line>
                            <line x1="3" y1="10" x2="21" y2="10"></line>
                            <line x1="8" y1="14" x2="16" y2="14"></line>
                            <line x1="8" y1="17" x2="13" y2="17"></line>
                        </svg>
                    </div>

                    @if($searched ?? false)
                        <h3>No published classes available</h3>
                        <p>
                            We could not find a published timetable for your selected
                            information. Please change your schedule information and try again.
                        </p>
                    @else
                        <h3>Please select your schedule information</h3>
                        <p>
                            Choose your department, year level, semester and academic year
                            to view your weekly class timetable.
                        </p>
                    @endif

                    <button
                        type="button"
                        class="schedule-primary-button"
                        id="openScheduleModalFromEmpty"
                    >
                        Choose My Schedule
                    </button>

                </div>
            </div>

        @endif

    </div>

{{-- =============================================================
     CHANGE SCHEDULE MODAL
============================================================= --}}

<div
    class="schedule-modal-overlay"
    id="scheduleModal"
    aria-hidden="true"
>

    <div
        class="schedule-modal"
        role="dialog"
        aria-modal="true"
        aria-labelledby="scheduleModalTitle"
    >

        <div class="schedule-modal-header">

            <div class="schedule-modal-title-wrapper">

                <div class="schedule-modal-icon">

                    <svg
                        width="34"
                        height="34"
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="1.8"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        aria-hidden="true"
                    >
                        <rect x="3" y="4" width="18" height="17" rx="2"></rect>
                        <line x1="16" y1="2" x2="16" y2="6"></line>
                        <line x1="8" y1="2" x2="8" y2="6"></line>
                        <line x1="3" y1="10" x2="21" y2="10"></line>
                        <path d="M8 14h.01"></path>
                        <path d="M12 14h.01"></path>
                        <path d="M16 14h.01"></path>
                        <path d="M8 18h.01"></path>
                        <path d="M12 18h.01"></path>
                        <path d="M16 18h.01"></path>
                    </svg>

                </div>

                <div>

                    <h2 id="scheduleModalTitle">
                        Set Your Schedule
                    </h2>

                    <p>
                        Select your study information to view your timetable.
                    </p>

                </div>

            </div>

            <button
                type="button"
                class="schedule-modal-close"
                id="closeScheduleModal"
                aria-label="Close schedule form"
            >
                <svg
                    width="26"
                    height="26"
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="2"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    aria-hidden="true"
                >
                    <line x1="18" y1="6" x2="6" y2="18"></line>
                    <line x1="6" y1="6" x2="18" y2="18"></line>
                </svg>
            </button>

        </div>


        <form
            method="GET"
            action="{{ route('student.schedules.index') }}"
            class="schedule-form"
        >

            <div class="schedule-form-grid">

                {{-- Department --}}

                <div class="schedule-form-group">

                    <label for="department_id">
                        Department
                    </label>
<select name="department_id" id="department_id">


    @foreach($departments as $department)
        <option
            value="{{ $department->id }}"
            @selected((string) request('department_id') === (string) $department->id)
        >
            {{ $department->department_name }}
        </option>
    @endforeach
</select>

                </div>


                {{-- Year Level --}}

                <div class="schedule-form-group">

                    <label for="year_level">
                        Year Level
                    </label>

                    <select
                        name="year_level"
                        id="year_level"
                        required
                    >

                        <option value="">
                            Select year level
                        </option>

                        @foreach($yearLevels as $yearLevel)

                            <option
                                value="{{ $yearLevel }}"
                                @selected(
                                    (string) request('year_level')
                                    === (string) $yearLevel
                                )
                            >
                                Year {{ $yearLevel }}
                            </option>

                        @endforeach

                    </select>

                </div>


                {{-- Semester --}}

                <div class="schedule-form-group">

                    <label for="semester">
                        Semester
                    </label>

                    <select
                        name="semester"
                        id="semester"
                        required
                    >

                        <option value="">
                            Select semester
                        </option>

                        @foreach($semesters as $semester)

                            <option
                                value="{{ $semester }}"
                                @selected(
                                    (string) request('semester')
                                    === (string) $semester
                                )
                            >
                                {{ $semester }}
                            </option>

                        @endforeach

                    </select>

                </div>


                {{-- Academic Year --}}

                <div class="schedule-form-group">

                    <label for="academic_year">
                        Academic Year
                    </label>

                    <select
                        name="academic_year"
                        id="academic_year"
                        required
                    >

                        <option value="">
                            Select academic year
                        </option>

                        @foreach($academicYears as $academicYear)

                            <option
                                value="{{ $academicYear }}"
                                @selected(
                                    (string) request('academic_year')
                                    === (string) $academicYear
                                )
                            >
                                {{ $academicYear }}
                            </option>

                        @endforeach

                    </select>

                </div>

            </div>


            <div class="schedule-modal-footer">

                <button
                    type="button"
                    class="schedule-cancel-button"
                    id="cancelScheduleModal"
                >
                    Cancel
                </button>

                <button
                    type="submit"
                    class="schedule-save-button"
                >

                    <svg
                        width="20"
                        height="20"
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="2"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        aria-hidden="true"
                    >
                        <path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2Z"></path>
                        <polyline points="17 21 17 13 7 13 7 21"></polyline>
                        <polyline points="7 3 7 8 15 8"></polyline>
                    </svg>

                    <span>Save My Schedule</span>

                </button>

            </div>

        </form>

    </div>

</div>


<style>
    /* =========================================================
       STUDENT SCHEDULE PAGE
       Outer page styling
    ========================================================= */

    .student-schedule-page {
        width: 100%;
        max-width: 1450px;
        margin: 0 auto;
        padding: 18px 20px 34px;
        color: #303342;
    }

    .schedule-page-header {
        display: flex;
        align-items: flex-end;
        justify-content: space-between;
        gap: 24px;
        margin-bottom: 28px;
    }

    .schedule-page-eyebrow {
        display: block;
        margin-bottom: 8px;
        color: #2864e8;
        font-size: 14px;
        font-weight: 800;
        letter-spacing: 1.4px;
    }

    .schedule-page-heading h1 {
        margin: 0;
        font-size: 29px;
        line-height: 1.15;
        font-weight: 800;
        color: #303342;
    }

    .schedule-page-heading p {
        margin: 10px 0 0;
        color: #71819c;
        font-size: 13px;
        line-height: 1.5;
    }

    /* =========================================================
       BUTTONS
    ========================================================= */

    .schedule-primary-button,
    .schedule-save-button {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        border: 0;
        border-radius: 16px;
        background: #2864e8;
        color: #ffffff;
        padding: 12px 18px;
        font-size: 14px;
        font-weight: 800;
        cursor: pointer;
        transition: 0.2s ease;
    }

    .schedule-primary-button:hover,
    .schedule-save-button:hover {
        background: #1e52c9;
        transform: translateY(-1px);
    }
/* =========================================================
       SUMMARY
    ========================================================= */

    .schedule-summary-card {
        display: flex;
        align-items: center;
        gap: 16px;
        padding: 18px 22px;
        margin-bottom: 18px;
        border: 1px solid #d9e5f7;
        border-radius: 22px;
        background: linear-gradient(110deg, #f2f7ff, #ffffff);
    }

    .schedule-summary-icon {
        display: grid;
        place-items: center;
        width: 60px;
        height: 60px;
        flex-shrink: 0;
        border-radius: 20px;
        background: #2864e8;
        color: #ffffff;
    }

    .schedule-summary-content {
        min-width: 0;
        flex: 1;
    }

    .schedule-summary-label {
        display: block;
        margin-bottom: 5px;
        color: #2864e8;
        font-size: 12px;
        font-weight: 800;
        letter-spacing: 1px;
    }

    .schedule-summary-content h2 {
        margin: 0;
        color: #222a40;
        font-size: 21px;
        font-weight: 800;
    }

    .schedule-summary-content p {
        margin: 7px 0 0;
        color: #6e809d;
        font-size: 16px;
    }

    .schedule-summary-content p span {
        margin: 0 7px;
        color: #a3b0c5;
    }

    /* =========================================================
       DOCUMENT AREA
    ========================================================= */

    .schedule-document-wrapper {
        display: flex;
        justify-content: center;
        padding: 14px;
        overflow-x: auto;
        background:
            radial-gradient(
                circle at top,
                #eef2ff,
                #f8fafc 55%
            );
        border: 1px solid #e2e8f0;
        border-radius: 20px;
    }

    .schedule-document-paper {
        width: 1190px;
        min-width: 1190px;
        min-height: 790px;
        padding: 30px 38px 36px;
        background: #ffffff;
        border: 1px solid #d9dee8;
        box-shadow: 0 22px 55px rgba(15, 23, 42, .14);
        font-family: "Times New Roman", serif;
        color: #000000;
    }

    /* =========================================================
       DOCUMENT HEADER
    ========================================================= */

    .schedule-document-header {
        display: grid;
        grid-template-columns: 90px 1fr;
        align-items: center;
        margin-bottom: 18px;
    }

    .schedule-document-logo {
        display: flex;
        justify-content: center;
    }

    .schedule-document-logo img {
        width: 65px;
        height: 65px;
        object-fit: contain;
    }

    .schedule-document-header-text {
        text-align: center;
    }

    .schedule-document-university {
        font-size: 18px;
        font-weight: 800;
    }

    .schedule-document-college {
        margin-top: 3px;
        font-size: 13px;
    }

    .schedule-document-degree,
    .schedule-document-promotion,
    .schedule-document-academic {
        margin-top: 2px;
        font-size: 13px;
    }

    /* =========================================================
       TABLE — MATCH HOD PREVIEW
    ========================================================= */

    .schedule-document-table {
        width: 100%;
        border-collapse: collapse;
        table-layout: fixed;
        margin-top: 12px;
    }

    .schedule-document-table th,
    .schedule-document-table td {
        border: 1px solid #000000;
    }

    .schedule-document-table th {
        height: 38px;
        background: #7ccfe3;
        text-align: center;
        font-size: 12px;
        font-weight: 800;
    }

    .schedule-document-table td {
        min-height: 92px;
        padding: 8px;
        text-align: center;
        vertical-align: middle;
        font-size: 10px;
    }

    .schedule-document-table th:first-child,
    .schedule-document-table td:first-child {
        width: 115px;
    }

    .schedule-document-time {
        font-weight: 800;
        white-space: nowrap;
    }

    .schedule-preview-course {
        font-size: 12px;
        line-height: 1.25;
    }

    .schedule-preview-professor {
        margin-top: 3px;
        font-size: 11px;
    }

    .schedule-preview-combined-year {
        margin-top: 3px;
        font-size: 11px;
        line-height: 1.25;
        color: #c62828;
        font-weight: 500;
    }

    .schedule-preview-mode {
        margin-top: 3px;
        font-size: 10px;
    }

    .schedule-preview-room {
        margin-top: 3px;
        font-size: 10px;
    }

    .schedule-preview-empty {
        color: #94a3b8;
        font-size: 15px;
    }

    .schedule-preview-special-activity {
        font-size: 12px;
        font-weight: 800;
        line-height: 1.25;
    }

    .schedule-preview-special-note {
        margin-top: 3px;
        font-size: 10px;
        line-height: 1.25;
    }

    /* =========================================================
       BOTTOM INFORMATION
    ========================================================= */

    .schedule-document-info-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 30px;
        margin-top: 20px;
        font-size: 11px;
        line-height: 1.8;
    }

    .schedule-document-note {
        margin-top: 16px;
        font-size: 10px;
        line-height: 1.6;
    }

    /* =========================================================
       APPROVAL / SIGNATURE
    ========================================================= */

    .schedule-document-approval {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 30px;
        margin-top: 32px;
    }

    .schedule-approval-column {
        display: flex;
        flex-direction: column;
        gap: 5px;
        font-size: 11px;
    }

    .schedule-approval-column strong {
        font-size: 11px;
    }

    .schedule-signature-space {
        height: 70px;
    }

    /* =========================================================
   SCHEDULE HEADER ACTIONS
========================================================= */

.schedule-header-actions {
    display: flex;
    align-items: center;
    justify-content: flex-end;
    gap: 12px;
    flex-wrap: wrap;
}

.schedule-download-button {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 9px;
    min-height: 46px;
    padding: 12px 18px;
    border: 1px solid #d6e2f2;
    border-radius: 16px;
    background: #ffffff;
    color: #2864e8;
    text-decoration: none;
    font-size: 14px;
    font-weight: 800;
    cursor: pointer;
    transition: 0.2s ease;
}

.schedule-download-button:hover {
    border-color: #2864e8;
    background: #f2f6ff;
    transform: translateY(-1px);
}

.schedule-download-button svg {
    flex-shrink: 0;
}

/* Responsive */

@media (max-width: 900px) {
    .schedule-header-actions {
        width: 100%;
        justify-content: flex-start;
    }
}

@media (max-width: 600px) {
    .schedule-header-actions {
        flex-direction: column;
        align-items: stretch;
    }

    .schedule-header-actions .schedule-primary-button,
    .schedule-header-actions .schedule-download-button {
        width: 100%;
    }
}

    /* =========================================================
       EMPTY STATE
    ========================================================= */

    .schedule-timetable-card {
        overflow: hidden;
        border: 1px solid #dce3ee;
        border-radius: 24px;
        background: #ffffff;
    }

    .schedule-empty-state {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        min-height: 390px;
        padding: 50px 25px;
        text-align: center;
    }

    .schedule-empty-icon {
        display: grid;
        place-items: center;
        width: 92px;
        height: 92px;
        margin-bottom: 22px;
        border-radius: 28px;
        background: #eff5ff;
        color: #2864e8;
    }

    .schedule-empty-state h3 {
        margin: 0;
        color: #303342;
        font-size: 25px;
        font-weight: 800;
    }

    .schedule-empty-state p {
        max-width: 650px;
        margin: 12px 0 25px;
        color: #71819c;
        font-size: 16px;
        line-height: 1.7;
    }

    /* =========================================================
       MODAL
    ========================================================= */

    .schedule-modal-overlay {
        position: fixed;
        inset: 0;
        z-index: 9999;
        display: none;
        align-items: center;
        justify-content: center;
        padding: 25px;
        background: rgba(35, 45, 64, 0.65);
        backdrop-filter: blur(5px);
    }

    .schedule-modal-overlay.active {
        display: flex;
    }

    .schedule-modal {
        width: 100%;
        max-width: 900px;
        max-height: 90vh;
        overflow-y: auto;
        border-radius: 28px;
        background: #ffffff;
        box-shadow: 0 25px 80px rgba(0, 0, 0, 0.2);
    }

    .schedule-modal-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 20px;
        padding: 30px 36px;
        border-bottom: 1px solid #e1e6ef;
    }

    .schedule-modal-title-wrapper {
        display: flex;
        align-items: center;
        gap: 20px;
    }

    .schedule-modal-icon {
        display: grid;
        place-items: center;
        width: 78px;
        height: 78px;
        flex-shrink: 0;
        border-radius: 24px;
        background: #dceaff;
        color: #2864e8;
    }

    .schedule-modal-header h2 {
        margin: 0;
        color: #303342;
        font-size: 30px;
        font-weight: 800;
    }

    .schedule-modal-header p {
        margin: 7px 0 0;
        color: #71819c;
        font-size: 16px;
    }

    .schedule-modal-close {
        display: grid;
        place-items: center;
        width: 52px;
        height: 52px;
        flex-shrink: 0;
        border: 0;
        border-radius: 17px;
        background: #f1f5fa;
        color: #71819c;
        cursor: pointer;
    }

    .schedule-modal-close:hover {
        background: #e7edf5;
    }

    .schedule-form {
        padding: 34px 36px 0;
    }

    .schedule-form-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 25px;
    }

    .schedule-form-group {
        display: flex;
        flex-direction: column;
        gap: 10px;
    }

    .schedule-form-group label {
        color: #303342;
        font-size: 17px;
        font-weight: 800;
    }

    .schedule-form-group select {
        width: 100%;
        height: 62px;
        padding: 0 18px;
        border: 1.5px solid #dce2ec;
        border-radius: 16px;
        outline: none;
        background: #ffffff;
        color: #303342;
        font-size: 16px;
        cursor: pointer;
    }

    .schedule-form-group select:focus {
        border-color: #2864e8;
        box-shadow: 0 0 0 4px rgba(40, 100, 232, 0.1);
    }

    .schedule-modal-footer {
        display: flex;
        justify-content: flex-end;
        gap: 15px;
        margin: 34px -36px 0;
        padding: 25px 36px;
        border-top: 1px solid #e1e6ef;
    }

    .schedule-cancel-button {
        padding: 15px 25px;
        border: 1.5px solid #dce2ec;
        border-radius: 16px;
        background: #ffffff;
        color: #71819c;
        font-size: 16px;
        font-weight: 800;
        cursor: pointer;
    }

    .schedule-cancel-button:hover {
        background: #f5f7fa;
    }

    /* =========================================================
       RESPONSIVE
    ========================================================= */

    @media (max-width: 900px) {

        .student-schedule-page {
            padding: 18px 16px 32px;
        }

        .schedule-page-header {
            align-items: flex-start;
            flex-direction: column;
        }

        .schedule-page-heading h1 {
            font-size: 32px;
        }

        .schedule-summary-card {
            align-items: flex-start;
            flex-wrap: wrap;
        }

        .schedule-summary-content {
            flex-basis: calc(100% - 100px);
        }

        .schedule-outline-button {
            width: 100%;
        }

        .schedule-document-wrapper {
            justify-content: flex-start;
        }

        .schedule-document-paper {
            flex: 0 0 1120px;
        }

        .schedule-modal-header,
        .schedule-form {
            padding-left: 25px;
            padding-right: 25px;
        }

        .schedule-modal-footer {
            margin-left: -25px;
            margin-right: -25px;
            padding-left: 25px;
            padding-right: 25px;
        }
    }

    @media (max-width: 600px) {

        .schedule-page-heading h1 {
            font-size: 28px;
        }

        .schedule-page-heading p {
            font-size: 15px;
        }

        .schedule-primary-button {
            width: 100%;
        }

        .schedule-summary-card {
            padding: 20px;
        }

        .schedule-summary-icon {
            width: 58px;
            height: 58px;
        }

        .schedule-summary-content h2 {
            font-size: 21px;
        }

        .schedule-summary-content p {
            font-size: 14px;
            line-height: 1.7;
        }

        .schedule-info-message {
            align-items: flex-start;
            padding: 16px;
        }

        .schedule-document-wrapper {
            padding: 10px;
        }

        .schedule-document-paper {
            width: 1190px;
            min-width: 1190px;
            flex-basis: 1190px;
            padding: 25px 28px 34px;
        }

        .schedule-document-approval {
            grid-template-columns: 1fr;
        }

        .schedule-modal {
            border-radius: 22px;
        }

        .schedule-modal-header {
            padding: 22px;
        }

        .schedule-modal-title-wrapper {
            align-items: flex-start;
            gap: 12px;
        }

        .schedule-modal-icon {
            width: 55px;
            height: 55px;
        }

        .schedule-modal-header h2 {
            font-size: 23px;
        }

        .schedule-modal-header p {
            font-size: 14px;
        }

        .schedule-form {
            padding: 25px 22px 0;
        }

        .schedule-form-grid {
            grid-template-columns: 1fr;
            gap: 20px;
        }

        .schedule-modal-footer {
            flex-direction: column-reverse;
            margin: 25px -22px 0;
            padding: 22px;
        }

        .schedule-cancel-button,
        .schedule-save-button {
            width: 100%;
        }
    }
</style>

<script>
(function () {

    function initScheduleModal() {

        const modal = document.getElementById('scheduleModal');

        if (!modal) {
            return;
        }

        const openButtons = [
            document.getElementById('openScheduleModal'),
            document.getElementById('openScheduleModalFromEmpty')
        ].filter(Boolean);

        const closeButton =
            document.getElementById('closeScheduleModal');

        const cancelButton =
            document.getElementById('cancelScheduleModal');

        function openModal(event) {

            if (event) {
                event.preventDefault();
                event.stopPropagation();
            }

            modal.classList.add('active');
            modal.setAttribute('aria-hidden', 'false');

            document.body.style.overflow = 'hidden';
        }

        function closeModal(event) {

            if (event) {
                event.preventDefault();
                event.stopPropagation();
            }

            modal.classList.remove('active');
            modal.setAttribute('aria-hidden', 'true');

            document.body.style.overflow = '';
        }

        openButtons.forEach(function (button) {
            button.addEventListener('click', openModal);
        });

        if (closeButton) {
            closeButton.addEventListener('click', closeModal);
        }

        if (cancelButton) {
            cancelButton.addEventListener('click', closeModal);
        }

        modal.addEventListener('click', function (event) {

            if (event.target === modal) {
                closeModal();
            }

        });

        document.addEventListener('keydown', function (event) {

            if (
                event.key === 'Escape' &&
                modal.classList.contains('active')
            ) {
                closeModal();
            }

        });

    }

    if (document.readyState === 'loading') {
        document.addEventListener(
            'DOMContentLoaded',
            initScheduleModal
        );
    } else {
        initScheduleModal();
    }

})();
</script>

@endsection
