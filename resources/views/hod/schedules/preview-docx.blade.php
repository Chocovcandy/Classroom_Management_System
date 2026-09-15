@extends('layouts.hod_layout')

@section('title', 'Schedule Export Preview')

@section('content')

<div class="docx-preview-page">

    {{-- =====================================================
             PAGE HEADER
        ====================================================== --}}

    <div class="preview-back-row">
        <a
            href="{{ route('hod.schedules.index', ['year' => $year, 'day' => $schedule->day_of_week]) }}"
            class="preview-back-card">
            <span class="preview-back-icon">
                <i class='bx bx-arrow-back'></i>
            </span>
            <span class="preview-back-copy">
                <strong>Back to Schedules</strong>
                <small>Return to the schedule list</small>
            </span>
        </a>
    </div>

    @if(session('success'))
    <div class="preview-alert preview-alert-success">
        <div class="preview-alert-icon">
            <i class='bx bx-check-circle'></i>
        </div>
        <div class="preview-alert-content">
            <strong>Update successful</strong>
            <span>{{ session('success') }}</span>
        </div>
    </div>
    @endif

    @if(session('error'))
    <div class="preview-alert preview-alert-error">
        <div class="preview-alert-icon">
            <i class='bx bx-error-circle'></i>
        </div>
        <div class="preview-alert-content">
            <strong>Something went wrong</strong>
            <span>{{ session('error') }}</span>
        </div>
    </div>
    @endif

    <div class="preview-header">
        <div class="preview-title-area">
            <div class="preview-brand-icon" aria-hidden="true">
                <i class='bx bx-file-find'></i>
            </div>

            <div class="preview-heading">
                <div class="preview-eyebrow">SCHEDULE • DOCUMENT PREVIEW</div>
                <h1>Schedule Export Preview</h1>
                <p>Review your weekly schedule before exporting the final DOCX document.</p>
            </div>
        </div>
    </div>

    <div class="preview-action-row">

        <div class="preview-action-left">

            <a
                href="{{ route('hod.schedules.edit', ['schedule' => $schedule->id, 'return_to_preview' => 1]) }}"
                class="preview-action preview-edit">
                <i class='bx bx-edit-alt'></i>
                <span>Edit Schedule</span>
            </a>


            {{-- PUBLISH / UNPUBLISH --}}
            @if(($schedule->status ?? 'draft') === 'published')

            <form
                method="POST"
                action="{{ route('hod.schedules.unpublish', $schedule->id) }}"
                class="preview-publish-form"
                onsubmit="return confirm('Unpublish this schedule? Students will no longer see it.');">
                @csrf
                @method('PATCH')

                <button type="submit" class="preview-action preview-unpublish">
                    <i class='bx bx-cloud-download'></i>
                    <span>Unpublish Schedule</span>
                </button>
            </form>

            @else

            <form
                method="POST"
                action="{{ route('hod.schedules.publish', $schedule->id) }}"
                class="preview-publish-form"
                onsubmit="return confirm('Publish this schedule? Professors and students will be able to see it.');">
                @csrf
                @method('PATCH')

                <button type="submit" class="preview-action preview-publish">
                    <i class='bx bx-cloud-upload'></i>
                    <span>Publish Schedule</span>
                </button>
            </form>

            @endif

        </div>

        <a
            href="{{ route('hod.schedules.exportDocx', $schedule->id) }}"
            class="preview-action preview-download">
            <i class='bx bx-download'></i>
            <span>Confirm & Download DOCX</span>
        </a>

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
                                    ->where('department_id', $department->id)
                                    ->pluck('year_level')
                                    ->map(fn ($yearLevel) => (int) $yearLevel)
                                    ->filter(fn ($yearLevel) => $yearLevel !== (int) $year)
                                    ->unique()
                                    ->sort()
                                    ->values();

                                $romanYears = $combinedYears->map(function ($yearLevel) {
                                    return match ($yearLevel) {
                                        1 => 'I',
                                        2 => 'II',
                                        3 => 'III',
                                        4 => 'IV',
                                        default => (string) $yearLevel,
                                    };
                                });
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
    .docx-preview-page {
        max-width: 1500px;
        margin: 0 auto;
        padding: 34px 28px 64px;
        background: #f6f8fc;
    }
.signature-space {
    height: 70px;
}
    /* =====================================================
       PAGE HEADER
    ====================================================== */

    .preview-back-row {
        margin-bottom: 18px;
    }

    .preview-back-card {
        display: inline-flex;
        align-items: center;
        gap: 12px;
        min-width: 250px;
        padding: 10px 14px;
        background: #ffffff;
        border: 1px solid #dbe5f2;
        border-radius: 14px;
        box-shadow: 0 6px 18px rgba(15, 23, 42, .05);
        color: #172033;
        text-decoration: none;
        transition: transform .18s ease, border-color .18s ease, box-shadow .18s ease;
    }

    .preview-back-card:hover {
        transform: translateY(-1px);
        border-color: #b7d2fb;
        box-shadow: 0 10px 22px rgba(37, 99, 235, .08);
    }

    .preview-back-icon {
        width: 38px;
        height: 38px;
        display: grid;
        place-items: center;
        flex: 0 0 38px;
        border-radius: 11px;
        background: #eef5ff;
        color: #2563eb;
    }

    .preview-back-icon i {
        font-size: 19px;
    }

    .preview-back-copy {
        display: flex;
        flex-direction: column;
        gap: 2px;
    }

    .preview-back-copy strong {
        font-size: 13px;
        font-weight: 850;
        line-height: 1.2;
    }

    .preview-back-copy small {
        color: #64748b;
        font-size: 11px;
        line-height: 1.2;
    }

    /* =====================================================
       FLASH MESSAGES
    ====================================================== */

    .preview-alert {
        display: flex;
        align-items: center;
        gap: 12px;
        margin-bottom: 18px;
        padding: 13px 16px;
        border-radius: 14px;
        border: 1px solid transparent;
        box-shadow: 0 6px 18px rgba(15, 23, 42, .04);
    }

    .preview-alert-icon {
        width: 38px;
        height: 38px;
        display: grid;
        place-items: center;
        flex: 0 0 38px;
        border-radius: 11px;
        font-size: 19px;
    }

    .preview-alert-content {
        display: flex;
        flex-direction: column;
        gap: 2px;
        min-width: 0;
    }

    .preview-alert-content strong {
        font-size: 13px;
        font-weight: 850;
    }

    .preview-alert-content span {
        font-size: 12px;
        line-height: 1.45;
    }

    .preview-alert-success {
        background: #f0fdf4;
        border-color: #bbf7d0;
        color: #166534;
    }

    .preview-alert-success .preview-alert-icon {
        background: #dcfce7;
        color: #16a34a;
    }

    .preview-alert-error {
        background: #fef2f2;
        border-color: #fecaca;
        color: #991b1b;
    }

    .preview-alert-error .preview-alert-icon {
        background: #fee2e2;
        color: #dc2626;
    }

    .preview-header {
        display: flex;
        align-items: center;
        margin-bottom: 22px;
        padding: 4px 2px 0;
    }

    .preview-title-area {
        display: flex;
        align-items: center;
        gap: 16px;
        min-width: 0;
    }

    .preview-brand-icon {
        width: 62px;
        height: 62px;
        flex: 0 0 62px;
        display: grid;
        place-items: center;
        border-radius: 18px;
        background: #edf4ff;
        border: 1px solid #d4e4ff;
        color: #2563eb;
        font-size: 29px;
        box-shadow: 0 8px 22px rgba(37, 99, 235, .10);
    }

    .preview-heading {
        min-width: 0;
    }

    .preview-eyebrow {
        margin-bottom: 6px;
        color: #2563eb;
        font-size: 11px;
        font-weight: 900;
        letter-spacing: .14em;
    }

    .preview-header h1 {
        margin: 0;
        color: #172033;
        font-size: clamp(28px, 3vw, 38px);
        font-weight: 850;
        line-height: 1.08;
        letter-spacing: -.025em;
    }

    .preview-header p {
        max-width: 700px;
        margin: 8px 0 0;
        color: #64748b;
        font-size: 14px;
        line-height: 1.55;
    }

    .preview-action-row {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 18px;
        margin: 0 2px 26px;
    }

    .preview-action-left {
        display: flex;
        align-items: center;
        gap: 10px;
        flex-wrap: wrap;
    }

    .preview-publish-form {
        margin: 0;
    }

    .preview-action {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        min-height: 44px;
        padding: 0 17px;
        border-radius: 12px;
        font-size: 13px;
        font-weight: 800;
        text-decoration: none;
        white-space: nowrap;
        transition: transform .18s ease, box-shadow .18s ease, background .18s ease, border-color .18s ease;
    }

    .preview-action i {
        font-size: 17px;
    }

    .preview-action:hover {
        transform: translateY(-1px);
    }

    .preview-edit {
        color: #2563eb;
        background: #f8fbff;
        border: 1px solid #bdd8ff;
    }

    .preview-edit:hover {
        background: #eef6ff;
        box-shadow: 0 8px 18px rgba(37, 99, 235, .10);
    }

    .preview-publish {
        color: #15803d;
        background: #f0fdf4;
        border: 1px solid #bbf7d0;
        cursor: pointer;
        font-family: inherit;
    }

    .preview-publish:hover {
        color: #166534;
        background: #dcfce7;
        border-color: #86efac;
        box-shadow: 0 8px 18px rgba(34, 197, 94, .10);
    }

    .preview-unpublish {
        color: #b45309;
        background: #fffbeb;
        border: 1px solid #fde68a;
        cursor: pointer;
        font-family: inherit;
    }

    .preview-unpublish:hover {
        color: #92400e;
        background: #fef3c7;
        border-color: #fcd34d;
        box-shadow: 0 8px 18px rgba(245, 158, 11, .10);
    }

    .preview-download {
        color: #ffffff;
        background: #2563eb;
        border: 1px solid #2563eb;
        box-shadow: 0 9px 22px rgba(37, 99, 235, .18);
    }

    .preview-download:hover {
        background: #1d4ed8;
        border-color: #1d4ed8;
        box-shadow: 0 11px 24px rgba(37, 99, 235, .22);
    }

    /* =====================================================
       DOCUMENT AREA
===================================================== */

    .document-preview-wrapper {
        display: flex;
        justify-content: center;
        padding: 24px;
        overflow-x: auto;

        background:
            radial-gradient(circle at top,
                #eef2ff,
                #f8fafc 55%);

        border: 1px solid #e2e8f0;
        border-radius: 20px;
    }


    /* =====================================================
   PAPER
===================================================== */

    .document-paper {
        width: 1120px;
        min-height: 790px;

        padding: 34px 42px 40px;

        background: #ffffff;

        border: 1px solid #d9dee8;

        box-shadow:
            0 22px 55px rgba(15, 23, 42, .14);

        font-family:
            "Times New Roman",
            serif;

        color: #000000;
    }


    /* =====================================================
   DOCUMENT HEADER
===================================================== */

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


    /* =====================================================
   TABLE
===================================================== */

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

    .preview-mode {
        margin-top: 3px;
        font-size: 10px;
        color: #555;
        font-weight: 500;
    }

    .preview-combined-year {
        margin-top: 3px;
        font-size: 11px;
        line-height: 1.25;
        color: #c62828;
        font-weight: 500;
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


    /* =====================================================
   INFORMATION
===================================================== */

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


    /* =====================================================
   APPROVAL
===================================================== */

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


    /* =====================================================
   RESPONSIVE
===================================================== */

    @media (max-width: 1050px) {
        .preview-action-row {
            width: 100%;
        }
    }

    @media (max-width: 640px) {
        .docx-preview-page {
            padding: 18px 12px 40px;
        }

        .preview-header {
            padding: 4px 0 0;
        }

        .preview-title-area {
            align-items: flex-start;
        }

        .preview-brand-icon {
            width: 50px;
            height: 50px;
            flex-basis: 50px;
            border-radius: 14px;
            font-size: 23px;
        }

        .preview-header h1 {
            font-size: 22px;
        }

        .preview-action-row {
            display: grid;
            grid-template-columns: 1fr;
            width: 100%;
            margin-left: 0;
            margin-right: 0;
        }

        .preview-action-left {
            display: grid;
            grid-template-columns: 1fr;
            width: 100%;
        }

        .preview-publish-form {
            width: 100%;
        }

        .preview-action {
            width: 100%;
        }

        .document-preview-wrapper {
            padding: 10px;
        }
    }
</style>

@endsection