@extends('layouts.hod_layout')

@section('title', 'Edit Schedule')

@section('content')
@php
    $days = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday'];
    $sessionSlots = $timeSlots->sortBy('session_number')->take(4)->values();
@endphp

<div class="schedule-create-page">

    <a
        href="{{ !empty($returnToPreview)
            ? route('hod.schedules.previewDocx', $schedule->id)
            : url()->previous() }}"
        class="schedule-back-button"
    >
        <i class='bx bx-arrow-back'></i>
        <span>Back</span>
    </a>

    {{-- ============================================================
        PAGE HEADER
    ============================================================ --}}
    <div class="schedule-header">
        <div class="schedule-header-icon">
            <i class='bx bx-calendar-edit'></i>
        </div>

        <div class="schedule-header-copy">
            <span class="schedule-eyebrow">HoD • Schedule Management</span>
            <h1>Edit Schedule</h1>
            <p>
                Edit the complete weekly schedule from Monday to Friday. Your changes stay on this page
                until you review and save the whole week.
            </p>
        </div>
    </div>

    {{-- ============================================================
        VALIDATION ERRORS
    ============================================================ --}}
    @if ($errors->any())
        <div class="schedule-alert schedule-alert-error">
            <div class="schedule-alert-icon">
                <i class='bx bx-error-circle'></i>
            </div>

            <div>
                <strong>Please check the schedule information.</strong>

                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endif

    <form
        id="scheduleEditForm"
        method="POST"
        action="{{ route('hod.schedules.update', $schedule) }}"
        novalidate
    >
        @csrf
        @method('PUT')

        @if(!empty($returnToPreview))
            <input type="hidden" name="return_to_preview" value="1">
        @endif

        {{-- ========================================================
            01. SCHEDULE INFORMATION
        ========================================================= --}}
        <section class="create-section">
            <div class="section-heading">
                <div class="section-number section-blue">01</div>

                <div>
                    <span class="section-kicker">Schedule Setup</span>
                    <h2>Schedule Information</h2>
                    <p>Set the basic information for this weekly schedule.</p>
                </div>
            </div>

            <div class="form-grid four-columns">

                {{-- Semester --}}
                <div class="field-group">
                    <label for="semester">
                        Semester
                        <span>*</span>
                    </label>

                    <div class="input-shell">
                        <i class='bx bx-bookmark'></i>

                        <select name="semester" id="semester" required>
                            <option value="">Select semester</option>

                            <option value="Semester 1"
                                {{ old('semester', $schedule->semester) === 'Semester 1' ? 'selected' : '' }}>
                                Semester 1
                            </option>

                            <option value="Semester 2"
                                {{ old('semester', $schedule->semester) === 'Semester 2' ? 'selected' : '' }}>
                                Semester 2
                            </option>
                        </select>

                        <i class='bx bx-chevron-down input-chevron'></i>
                    </div>
                </div>

                {{-- Academic Year --}}
                <div class="field-group">
                    <label for="academic_year">
                        Academic Year
                        <span>*</span>
                    </label>

                    <div class="input-shell">
                        <i class='bx bx-calendar'></i>

                        <select name="academic_year" id="academic_year" required>
                            <option value="">Select academic year</option>

                            <option value="2025-2026"
                                {{ old('academic_year', $schedule->academic_year) === '2025-2026' ? 'selected' : '' }}>
                                2025-2026
                            </option>

                            <option value="2026-2027"
                                {{ old('academic_year', $schedule->academic_year) === '2026-2027' ? 'selected' : '' }}>
                                2026-2027
                            </option>
                        </select>

                        <i class='bx bx-chevron-down input-chevron'></i>
                    </div>
                </div>

                {{-- Promotion --}}
                <div class="field-group">
                    <label for="promotion">
                        Promotion
                        <span>*</span>
                    </label>

                    <div class="input-shell">
                        <i class='bx bx-group'></i>

                        <select name="promotion" id="promotion" required>
                            <option value="">Select promotion</option>

                            @for ($i = 1; $i <= 30; $i++)
                                <option value="{{ $i }}"
                                    {{ old('promotion', $schedule->promotion) == $i ? 'selected' : '' }}>
                                    Promotion {{ $i }}
                                </option>
                            @endfor
                        </select>

                        <i class='bx bx-chevron-down input-chevron'></i>
                    </div>
                </div>

                {{-- Main Year --}}
                <div class="field-group">
                    <label for="main_year">
                        Main Year
                        <span>*</span>
                    </label>

                    <div class="input-shell">
                        <i class='bx bx-layer'></i>

                        <select name="main_year" id="main_year" required>
                            @foreach ([1, 2, 3, 4] as $yearOption)
                                <option value="{{ $yearOption }}"
                                    {{ old('main_year', $year ?? 1) == $yearOption ? 'selected' : '' }}>
                                    Year {{ $yearOption }}
                                </option>
                            @endforeach
                        </select>

                        <i class='bx bx-chevron-down input-chevron'></i>
                    </div>
                </div>
            </div>

            {{-- Optional Note --}}
            <div class="field-group note-field">
                <label for="note">Note</label>

                <div class="input-shell input-shell-textarea">
                    <i class='bx bx-note textarea-icon'></i>

                    <textarea
                        name="note"
                        id="note"
                        rows="3"
                        placeholder="Optional note about this schedule..."
                    >{{ old('note', $schedule->note ?? '') }}</textarea>
                </div>
            </div>
        </section>

        {{-- ========================================================
            02. ACADEMIC DATES
        ========================================================= --}}
        <section class="create-section panel-yellow">
            <div class="section-heading">
                <div class="section-number section-yellow">02</div>

                <div>
                    <span class="section-kicker">Academic Period</span>
                    <h2>Academic Dates</h2>
                    <p>Define when the teaching period starts and ends.</p>
                </div>
            </div>

            <div class="form-grid two-columns">

                <div class="field-group">
                    <label for="starting_date">
                        Starting Date
                        <span>*</span>
                    </label>

                    <div class="input-shell">
                        <i class='bx bx-calendar'></i>

                        <input
                            type="date"
                            name="starting_date"
                            id="starting_date"
                            value="{{ old('starting_date', $schedule->starting_date ? \Illuminate\Support\Carbon::parse($schedule->starting_date)->format('Y-m-d') : '') }}"
                            required
                        >
                    </div>

                    <small>First day of the class schedule.</small>
                </div>

                <div class="field-group">
                    <label for="finished_date">
                        Finished Date
                        <span>*</span>
                    </label>

                    <div class="input-shell">
                        <i class='bx bx-calendar-check'></i>

                        <input
                            type="date"
                            name="finished_date"
                            id="finished_date"
                            value="{{ old('finished_date', $schedule->finished_date ? \Illuminate\Support\Carbon::parse($schedule->finished_date)->format('Y-m-d') : '') }}"
                            required
                        >
                    </div>

                    <small>Last day of the class schedule.</small>
                </div>
            </div>
        </section>

        {{-- ========================================================
            03. EXAM DATES
        ========================================================= --}}
        <section class="create-section panel-pink">
            <div class="section-heading">
                <div class="section-number section-pink">03</div>

                <div>
                    <span class="section-kicker">Assessment Period</span>
                    <h2>Exam Dates</h2>
                    <p>Select the beginning of each exam period.</p>
                </div>
            </div>

            <div class="form-grid two-columns">

                <div class="field-group">
                    <label for="midterm_exam_start">
                        Mid-Term
                        <span>*</span>
                    </label>

                    <div class="input-shell">
                        <i class='bx bx-edit-alt'></i>

                        <input
                            type="date"
                            name="midterm_exam_start"
                            id="midterm_exam_start"
                            value="{{ old('midterm_exam_start', $schedule->midterm_exam_start ? \Illuminate\Support\Carbon::parse($schedule->midterm_exam_start)->format('Y-m-d') : '') }}"
                            required
                        >
                    </div>

                    <small id="midterm_exam_range"></small>

                    <input
                        type="hidden"
                        id="midterm_exam_end"
                        name="midterm_exam_end"
                        value="{{ old('midterm_exam_end', $schedule->midterm_exam_end ? \Illuminate\Support\Carbon::parse($schedule->midterm_exam_end)->format('Y-m-d') : '') }}"
                    >
                </div>

                <div class="field-group">
                    <label for="final_exam_start">
                        Final
                        <span>*</span>
                    </label>

                    <div class="input-shell">
                        <i class='bx bx-graduation'></i>

                        <input
                            type="date"
                            name="final_exam_start"
                            id="final_exam_start"
                            value="{{ old('final_exam_start', $schedule->final_exam_start ? \Illuminate\Support\Carbon::parse($schedule->final_exam_start)->format('Y-m-d') : '') }}"
                            required
                        >
                    </div>

                    <small id="final_exam_range"></small>

                    <input
                        type="hidden"
                        id="final_exam_end"
                        name="final_exam_end"
                        value="{{ old('final_exam_end', $schedule->final_exam_end ? \Illuminate\Support\Carbon::parse($schedule->final_exam_end)->format('Y-m-d') : '') }}"
                    >
                </div>
            </div>
        </section>

        {{-- ========================================================
            04. WEEKLY SCHEDULE
        ========================================================= --}}
        <section class="create-section weekly-section">

            <div class="section-heading weekly-heading">
                <div class="section-number section-purple">04</div>

                <div>
                    <span class="section-kicker">Weekly Editor</span>
                    <h2>Weekly Schedule</h2>
                    <p>
                        Select a day first. Then configure the sessions for that day.
                        Nothing is saved to the database until the final step.
                    </p>
                </div>
            </div>

            {{-- Day Selector --}}
            <div class="day-selector-card">

                <div class="day-selector-header">
                    <div>
                        <span class="mini-label">Select Day</span>
                        <strong id="selectedDayLabel">Monday</strong>
                    </div>

                    <div class="day-progress">
                        <span id="dayProgressText">Day 1 of 5</span>
                    </div>
                </div>

                <div class="day-tabs" id="dayTabs">

                    @foreach ($days as $index => $dayName)
                        <button
                            type="button"
                            class="day-tab {{ $index === 0 ? 'active' : '' }}"
                            data-day="{{ $dayName }}"
                            data-day-index="{{ $index }}"
                        >
                            <span class="day-tab-check" aria-hidden="true">
                                <i class='bx bx-check'></i>
                            </span>

                            <span class="day-tab-name">{{ $dayName }}</span>

                            <small class="day-tab-status" data-day-status="{{ $dayName }}">
                                Not configured
                            </small>
                        </button>
                    @endforeach

                </div>
            </div>

            {{-- Current Day Schedule --}}
            <div class="day-workspace">

                <div class="workspace-header">
                    <div class="workspace-title">
                        <div class="workspace-icon">
                            <i class='bx bx-calendar'></i>
                        </div>

                        <div>
                            <span class="mini-label">Selected Day</span>
                            <h3 id="workspaceDayTitle">Monday Schedule</h3>
                        </div>
                    </div>

                    <div class="workspace-header-actions">
                        <div class="workspace-summary">
                            <span id="workspaceSessionCount">4 sessions</span>
                        </div>

                        <button
                            type="button"
                            id="selectAllSessionsBtn"
                            class="select-all-sessions-btn"
                            aria-pressed="false"
                        >
                            <i class='bx bx-check-square'></i>
                            <span>Select All Sessions</span>
                        </button>

                        <div class="workspace-nav-actions">
                            <button
                                type="button"
                                id="previousDayBtn"
                                class="nav-btn nav-btn-secondary"
                                disabled
                            >
                                <i class='bx bx-left-arrow-alt'></i>
                                Previous
                            </button>

                            <button
                                type="button"
                                id="continueDayBtn"
                                class="nav-btn nav-btn-primary"
                            >
                                Continue
                                <i class='bx bx-right-arrow-alt'></i>
                            </button>
                        </div>
                    </div>
                </div>

                {{-- Session editor will be rendered here by JS --}}
                <div id="sessionEditor" class="session-editor"></div>

                <div id="dayEmptyMessage" class="day-empty-message" hidden>
                    <div class="empty-icon">
                        <i class='bx bx-calendar-x'></i>
                    </div>

                    <div>
                        <strong>This day can be left empty.</strong>
                        <p>
                            You can continue to the next day and come back later
                            when the schedule is confirmed.
                        </p>
                    </div>
                </div>

                <div class="workspace-bottom-hint">
                    <i class='bx bx-info-circle'></i>
                    <span>Use the buttons above to move between days. Changes are saved at the final step.</span>
                </div>
            </div>
        </section>

        {{-- ========================================================
            05. WEEK REVIEW
        ========================================================= --}}
        <section id="weeklyReviewSection" class="create-section review-section">

            <div class="section-heading">
                <div class="section-number section-green">05</div>

                <div>
                    <span class="section-kicker">Final Check</span>
                    <h2>Review Weekly Schedule</h2>
                    <p>
                        Review all five days before the schedule is finally submitted.
                    </p>
                </div>
            </div>

            <div id="weeklyReviewGrid" class="weekly-review-grid"></div>

            <div class="review-note">
                <i class='bx bx-info-circle'></i>
                <div>
                    <strong>Nothing is permanently saved yet.</strong>
                    <span>
                        The final button below submits the complete weekly schedule
                        to Laravel.
                    </span>
                </div>
            </div>


        </section>

        {{-- ========================================================
            06. APPROVAL & AUTHORIZATION
        ========================================================= --}}
        <section class="create-section approval-section" id="approvalSection">

            <div class="section-heading">
                <div class="section-number section-orange">06</div>

                <div>
                    <span class="section-kicker">Approval & Authorization</span>
                    <h2>Approval & Authorization</h2>
                    <p>
                        Review the approval authorities associated with this schedule.
                    </p>
                </div>
            </div>

            {{-- Foundation Year --}}
            <div id="approval-year-1" class="approval-year-block">

                <div class="approval-card approval-card-single">
                    <div class="approval-card-icon">
                        <i class='bx bx-user-check'></i>
                    </div>

                    <div class="approval-content">
                        <span class="approval-role">
                            Head of Foundation Year Department
                        </span>

                        <strong class="approval-name">
                            LEC. Soeung Sambath
                        </strong>

                        <div class="approval-signature-line">
                            <span>Signature</span>
                        </div>
                    </div>
                </div>

            </div>

            {{-- Years 2, 3, 4 --}}
            <div id="approval-year-234" class="approval-grid">

                {{-- Head of Academic Office --}}
                <div class="approval-card">

                    <div class="approval-card-icon">
                        <i class='bx bx-briefcase-alt-2'></i>
                    </div>

                    <div class="approval-content">
                        <span class="approval-role">
                            Head of Academic Office
                        </span>

                        <strong class="approval-name">
                            LEC. SAN PISETH
                        </strong>

                        <div class="approval-signature-line">
                            <span>Signature</span>
                        </div>
                    </div>

                </div>

                {{-- Department Head --}}
                <div class="approval-card">

                    <div class="approval-card-icon">
                        <i class='bx bx-user-voice'></i>
                    </div>

                    <div class="approval-content">
                        <span class="approval-role">
                            Head of {{ $department->department_name }}
                        </span>

                        <strong class="approval-name">
                            LEC. {{ $department->head?->name ?? 'Department Head Not Assigned' }}
                        </strong>

                        <div class="approval-signature-line">
                            <span>Signature</span>
                        </div>
                    </div>

                </div>

            </div>

        </section>

        {{-- ========================================================
            FINAL FORM ACTIONS
        ========================================================= --}}
        <div class="final-actions">

            <a href="{{ route('hod.schedules.index', ['year' => old('main_year', $year ?? 1), 'semester' => old('semester', $schedule->semester)]) }}" class="cancel-action">
                <i class='bx bx-x'></i>
                Cancel
            </a>

            <button
                type="submit"
                id="saveWeeklyScheduleBtn"
                class="save-action"
            >
                <span>Save Changes</span>
                <i class='bx bx-check'></i>
            </button>
        </div>

        {{-- Hidden schedule input state --}}
        <div id="scheduleHiddenInputs"></div>

    </form>
</div>


{{-- ================================================================
    SESSION TEMPLATE DATA
================================================================ --}}
@php
    /*
     * Weekly schedule data for Edit.
     * The edit() controller should provide $weeklySchedules containing
     * all schedules for Monday-Friday in the selected semester,
     * academic year, promotion and department.
     */
    $editScheduleData = [];

    foreach ($days as $dayName) {
        $editScheduleData[$dayName] = [];
    }

    $sourceWeeklySchedules = $weeklySchedules ?? collect();

    foreach ($sourceWeeklySchedules as $session) {
        $slotIndex = $sessionSlots->search(function ($slot) use ($session) {
            return (string) $slot->id === (string) $session->slot_id;
        });

        if ($slotIndex === false) {
            continue;
        }

        $combinedYears = $session->scheduleDepartments
            ->where('department_id', $department->id)
            ->pluck('year_level')
            ->map(fn ($value) => (int) $value)
            ->reject(fn ($value) => $value === (int) ($year ?? 1))
            ->unique()
            ->values()
            ->all();

        $editScheduleData[$session->day_of_week][(int) $slotIndex] = [
            'id' => $session->id,
            'enabled' => true,
            'slot_id' => $session->slot_id,
            'activity_type' => $session->activity_type ?? 'course',
            'special_note' => $session->special_note ?? '',
            'course_id' => $session->course_id,
            'professor_id' => $session->professor_id,
            'room_id' => $session->room_id,
            'combined_years' => $combinedYears,
        ];
    }

    $oldScheduleData = old('days', $editScheduleData);

    // Existing schedule IDs that belong to the week being edited.
    // The conflict checker must ignore these records because they are
    // the schedules already displayed in this Edit form.
    $editScheduleIds = collect($editScheduleData)
        ->flatMap(function ($daySchedules) {
            return collect($daySchedules);
        })
        ->pluck('id')
        ->filter()
        ->map(fn ($id) => (int) $id)
        ->unique()
        ->values()
        ->all();
@endphp

<script type="application/json" id="scheduleDayData">{!! json_encode($days) !!}</script>

@php
    $courseData = $courses->map(function ($course) {
        return [
            'id' => $course->id,
            'label' => $course->course_code . ' - ' . $course->course_name,
        ];
    })->values();

    $professorData = $professors->map(function ($professor) {
        return [
            'id' => $professor->id,
            'label' => 'LEC. ' . $professor->name,
        ];
    })->values();

    $classroomData = $classrooms->map(function ($classroom) {
        return [
            'id' => $classroom->id,
            'label' => $classroom->room_name,
        ];
    })->values();

    $sessionSlotData = $sessionSlots->map(function ($slot) {
        return [
            'id' => $slot->id,
            'session_number' => $slot->session_number,
            'session_label' => $slot->session_label,
            'start_time' => $slot->start_time,
            'end_time' => $slot->end_time,
        ];
    })->values();

@endphp

<script type="application/json" id="courseData">{!! json_encode($courseData->values()->all()) !!}</script>
<script type="application/json" id="professorData">{!! json_encode($professorData->values()->all()) !!}</script>
<script type="application/json" id="classroomData">{!! json_encode($classroomData->values()->all()) !!}</script>
<script type="application/json" id="sessionSlotData">{!! json_encode($sessionSlotData->values()->all()) !!}</script>
<script type="application/json" id="oldScheduleData">{!! json_encode($oldScheduleData) !!}</script>
<script type="application/json" id="editScheduleIds">{!! json_encode($editScheduleIds) !!}</script>


<style>

    /* ============================================================
       BACK BUTTON
    ============================================================ */

    .schedule-back-button {
        display: inline-flex;
        align-items: center;
        gap: 7px;
        margin-bottom: 14px;
        padding: 8px 12px;
        color: #64748b;
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 9px;
        text-decoration: none;
        font-size: 11px;
        font-weight: 800;
        transition: .18s ease;
    }

    .schedule-back-button i {
        font-size: 16px;
    }

    .schedule-back-button:hover {
        color: #2563eb;
        border-color: #bfdbfe;
        background: #eff6ff;
        transform: translateX(-2px);
    }


    /* ============================================================
       ROOT
    ============================================================ */

    .schedule-create-page {
        width: min(1280px, calc(100% - 40px));
        margin: 0 auto;
        padding: 34px 0 70px;
        color: #172033;
    }

    /* ============================================================
       HEADER
    ============================================================ */

    .schedule-header {
        display: flex;
        align-items: center;
        gap: 18px;
        margin-bottom: 28px;
        animation: scheduleFadeUp .55s ease both;
    }

    .schedule-header-icon {
        width: 58px;
        height: 58px;
        border-radius: 18px;
        display: grid;
        place-items: center;
        background: linear-gradient(135deg, #dbeafe, #ede9fe);
        color: #4f46e5;
        font-size: 27px;
        box-shadow: 0 12px 26px rgba(79, 70, 229, .11);
        flex: 0 0 auto;
    }

    .schedule-header-copy {
        min-width: 0;
    }

    .schedule-eyebrow {
        display: inline-block;
        margin-bottom: 6px;
        color: #6366f1;
        font-size: 12px;
        font-weight: 800;
        letter-spacing: .09em;
        text-transform: uppercase;
    }

    .schedule-header h1 {
        margin: 0;
        color: #111827;
        font-size: clamp(30px, 4vw, 40px);
        line-height: 1.05;
        letter-spacing: -.035em;
        font-weight: 850;
    }

    .schedule-header p {
        margin: 9px 0 0;
        max-width: 900px;
        color: #64748b;
        font-size: 15px;
        line-height: 1.6;
    }

    /* ============================================================
       ALERT
    ============================================================ */

    .schedule-alert {
        display: flex;
        gap: 12px;
        align-items: flex-start;
        margin-bottom: 22px;
        padding: 15px 17px;
        border-radius: 15px;
        animation: scheduleFadeUp .45s ease both;
    }

    .schedule-alert-error {
        background: #fff1f2;
        border: 1px solid #fecdd3;
        color: #9f1239;
    }

    .schedule-alert-icon {
        font-size: 22px;
        line-height: 1;
    }

    .schedule-alert strong {
        display: block;
        margin-bottom: 6px;
    }

    .schedule-alert ul {
        margin: 0;
        padding-left: 18px;
        line-height: 1.7;
    }

    /* ============================================================
       SECTIONS
    ============================================================ */

    .create-section {
        position: relative;
        margin-bottom: 24px;
        padding: 28px;
        background: rgba(255, 255, 255, .96);
        border: 1px solid #e8edf5;
        border-radius: 24px;
        box-shadow: 0 14px 40px rgba(30, 41, 59, .055);
        animation: scheduleFadeUp .6s ease both;
        overflow: hidden;
    }

    .create-section::before {
        content: "";
        position: absolute;
        top: 0;
        left: 0;
        width: 150px;
        height: 4px;
        border-radius: 0 0 999px 0;
        background: linear-gradient(90deg, #8b5cf6, #c4b5fd);
    }

    .panel-yellow::before {
        background: linear-gradient(90deg, #f59e0b, #fde68a);
    }

    .panel-pink::before {
        background: linear-gradient(90deg, #ec4899, #f9a8d4);
    }

    .weekly-section::before {
        background: linear-gradient(90deg, #6366f1, #c4b5fd);
    }

    .weekly-section {
        overflow: visible;
    }

    .day-workspace {
        overflow: visible;
    }

    .workspace-bottom-hint {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 6px;
        margin-top: 14px;
        color: #94a3b8;
        font-size: 10px;
        line-height: 1.4;
        text-align: center;
    }

    .workspace-bottom-hint i {
        font-size: 14px;
        flex: 0 0 auto;
    }

    .review-section::before {
        background: linear-gradient(90deg, #10b981, #a7f3d0);
    }

    .section-heading {
        display: flex;
        align-items: flex-start;
        gap: 14px;
        margin-bottom: 22px;
    }

    .section-number {
        width: 44px;
        height: 44px;
        border-radius: 14px;
        display: grid;
        place-items: center;
        font-size: 13px;
        font-weight: 900;
        flex: 0 0 auto;
    }

    .section-blue {
        background: #dbeafe;
        color: #2563eb;
    }

    .section-yellow {
        background: #fef3c7;
        color: #d97706;
    }

    .section-pink {
        background: #fce7f3;
        color: #db2777;
    }

    .section-purple {
        background: #ede9fe;
        color: #7c3aed;
    }

    .section-green {
        background: #d1fae5;
        color: #059669;
    }

    .section-kicker {
        display: block;
        margin-bottom: 4px;
        color: #94a3b8;
        font-size: 11px;
        font-weight: 850;
        letter-spacing: .1em;
        text-transform: uppercase;
    }

    .section-heading h2 {
        margin: 0;
        color: #111827;
        font-size: 22px;
        letter-spacing: -.025em;
    }

    .section-heading p {
        margin: 5px 0 0;
        color: #64748b;
        font-size: 13px;
        line-height: 1.55;
    }

    /* ============================================================
       FORM
    ============================================================ */

    .form-grid {
        display: grid;
        gap: 17px;
    }

    .four-columns {
        grid-template-columns: repeat(4, minmax(0, 1fr));
    }

    .two-columns {
        grid-template-columns: repeat(2, minmax(0, 1fr));
    }

    .field-group {
        min-width: 0;
    }

    .field-group label {
        display: flex;
        align-items: center;
        gap: 4px;
        margin-bottom: 7px;
        color: #334155;
        font-size: 13px;
        font-weight: 800;
    }

    .field-group label span {
        color: #ef4444;
    }

    .field-group small {
        display: block;
        margin-top: 7px;
        color: #94a3b8;
        font-size: 11.5px;
        line-height: 1.5;
    }

    .input-shell {
        position: relative;
    }

    .input-shell > i:first-child {
        position: absolute;
        top: 50%;
        left: 13px;
        transform: translateY(-50%);
        color: #94a3b8;
        font-size: 18px;
        pointer-events: none;
        z-index: 1;
    }

    .input-shell input,
    .input-shell select,
    .input-shell textarea {
        width: 100%;
        border: 1px solid #dbe2ea;
        border-radius: 13px;
        background: #ffffff;
        color: #172033;
        outline: none;
        transition: border-color .18s ease, box-shadow .18s ease, transform .18s ease;
        font: inherit;
    }

    .input-shell input,
    .input-shell select {
        min-height: 46px;
        padding: 11px 42px 11px 40px;
    }

    .input-shell textarea {
        min-height: 92px;
        resize: vertical;
        padding: 13px 14px 13px 40px;
        line-height: 1.55;
    }

    .input-shell input:focus,
    .input-shell select:focus,
    .input-shell textarea:focus,
    .session-field select:focus,
    .session-type-select:focus,
    .special-activity-input:focus {
        border-color: #818cf8;
        box-shadow: 0 0 0 4px rgba(99, 102, 241, .09);
    }

    .input-shell select {
        appearance: none;
        cursor: pointer;
    }

    .input-chevron {
        position: absolute;
        top: 50%;
        right: 13px;
        transform: translateY(-50%);
        color: #94a3b8;
        pointer-events: none;
    }

    .textarea-icon {
        top: 16px !important;
        transform: none !important;
    }

    .note-field {
        margin-top: 17px;
    }

    /* ============================================================
       DAY SELECTOR
    ============================================================ */

    .day-selector-card {
        margin-bottom: 22px;
        padding: 19px;
        border-radius: 20px;
        background: linear-gradient(135deg, #f8f7ff, #fdfcff);
        border: 1px solid #ebe7ff;
    }

    .day-selector-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 15px;
        margin-bottom: 15px;
    }

    .mini-label {
        display: block;
        margin-bottom: 3px;
        color: #94a3b8;
        font-size: 10px;
        font-weight: 900;
        letter-spacing: .1em;
        text-transform: uppercase;
    }

    .day-selector-header strong {
        color: #27223f;
        font-size: 21px;
        letter-spacing: -.025em;
    }

    .day-progress {
        padding: 8px 12px;
        border-radius: 999px;
        background: #ffffff;
        border: 1px solid #e7e4f7;
        color: #7c3aed;
        font-size: 11px;
        font-weight: 800;
        white-space: nowrap;
    }

    .day-tabs {
        display: grid;
        grid-template-columns: repeat(5, minmax(0, 1fr));
        gap: 10px;
    }

    .day-tab {
        position: relative;
        min-width: 0;
        padding: 14px 12px 12px;
        border: 1px solid #e2e8f0;
        border-radius: 15px;
        background: #ffffff;
        color: #334155;
        cursor: pointer;
        text-align: left;
        transition: transform .18s ease, box-shadow .18s ease, border-color .18s ease, background .18s ease;
    }

    .day-tab:hover {
        transform: translateY(-2px);
        border-color: #c7d2fe;
        box-shadow: 0 9px 20px rgba(99, 102, 241, .08);
    }

    .day-tab.active {
        border-color: #818cf8;
        background: linear-gradient(135deg, #eef2ff, #faf5ff);
        box-shadow: 0 10px 24px rgba(99, 102, 241, .11);
    }

    .day-tab-check {
        position: absolute;
        top: 10px;
        right: 10px;
        display: none;
        width: 19px;
        height: 19px;
        align-items: center;
        justify-content: center;
        border-radius: 999px;
        background: #10b981;
        color: #ffffff;
        font-size: 12px;
    }

    .day-tab.completed .day-tab-check {
        display: flex;
    }

    .day-tab-name {
        display: block;
        margin-bottom: 4px;
        font-size: 14px;
        font-weight: 850;
        color: #1e293b;
    }

    .day-tab-status {
        display: block;
        color: #94a3b8;
        font-size: 10px;
        font-weight: 700;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .day-tab.completed .day-tab-status {
        color: #059669;
    }

    /* ============================================================
       DAY WORKSPACE
    ============================================================ */

    .day-workspace {
        padding: 23px;
        border-radius: 21px;
        border: 1px solid #e8ecf3;
        background: #fbfdff;
    }

    .workspace-header {
        position: sticky;
        top: 12px;
        z-index: 40;
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 16px;
        margin: -6px -6px 19px;
        padding: 10px 6px 12px;
        background: rgba(251, 253, 255, .94);
        border-bottom: 1px solid rgba(226, 232, 240, .86);
        backdrop-filter: blur(12px);
        -webkit-backdrop-filter: blur(12px);
    }

    .workspace-header-actions {
        display: flex;
        align-items: center;
        gap: 10px;
        flex: 0 0 auto;
    }

    .select-all-sessions-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 7px;
        min-height: 40px;
        padding: 0 14px;
        border: 1px solid #dbe4f0;
        border-radius: 11px;
        background: #ffffff;
        color: #334155;
        font-size: 13px;
        font-weight: 700;
        cursor: pointer;
        transition: .18s ease;
        white-space: nowrap;
    }

    .select-all-sessions-btn i {
        font-size: 18px;
    }

    .select-all-sessions-btn:hover {
        border-color: #b9c9df;
        transform: translateY(-1px);
    }

    .select-all-sessions-btn[aria-pressed="true"] {
        border-color: #3b82f6;
        background: #eff6ff;
        color: #2563eb;
    }

    .workspace-nav-actions {
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .workspace-title {
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .workspace-icon {
        width: 42px;
        height: 42px;
        border-radius: 14px;
        display: grid;
        place-items: center;
        background: #e0e7ff;
        color: #4f46e5;
        font-size: 20px;
    }

    .workspace-title h3 {
        margin: 0;
        color: #1e293b;
        font-size: 20px;
    }

    .workspace-summary {
        padding: 8px 12px;
        border-radius: 999px;
        background: #f1f5f9;
        color: #475569;
        font-size: 11px;
        font-weight: 850;
    }

    /* ============================================================
       SESSION EDITOR
    ============================================================ */

    .session-editor {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 16px;
    }

    .session-card {
        position: relative;
        padding: 20px;
        border-radius: 18px;
        background: #ffffff;
        border: 1px solid #e3e8f0;
        box-shadow: 0 8px 22px rgba(15, 23, 42, .045);
        transition: transform .18s ease, box-shadow .18s ease, border-color .18s ease;
    }

    .session-card:hover {
        transform: translateY(-2px);
        border-color: #c7d2fe;
        box-shadow: 0 13px 28px rgba(15, 23, 42, .075);
    }

    .session-card.special {
        background: linear-gradient(135deg, #fffdf8, #fffaf1);
        border-color: #fde68a;
    }

    .session-card.conflict {
        border-color: #fca5a5;
        box-shadow: 0 10px 26px rgba(239, 68, 68, .09);
    }

    .session-top {
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        gap: 12px;
        padding-bottom: 13px;
        margin-bottom: 15px;
        border-bottom: 1px solid #eef2f7;
    }

    .session-title {
        min-width: 0;
    }

    .session-number {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        margin-bottom: 3px;
        color: #4f46e5;
        font-size: 11px;
        font-weight: 900;
        letter-spacing: .07em;
        text-transform: uppercase;
    }

    .session-title strong {
        display: block;
        color: #172033;
        font-size: 17px;
    }

    .session-time {
        margin-top: 4px;
        color: #64748b;
        font-size: 12px;
        font-weight: 700;
    }

    .session-selector {
        display: flex;
        align-items: center;
        gap: 8px;
        padding: 8px 10px;
        border-radius: 11px;
        background: #f8fafc;
        border: 1px solid #e2e8f0;
        cursor: pointer;
        user-select: none;
        flex: 0 0 auto;
    }

    .session-selector input {
        width: 16px;
        height: 16px;
        accent-color: #6366f1;
    }

    .session-selector span {
        color: #475569;
        font-size: 11px;
        font-weight: 800;
    }

    .session-fields {
        display: grid;
        gap: 11px;
    }

    .course-fields {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 11px;
    }

    .session-field label {
        display: block;
        margin-bottom: 6px;
        color: #475569;
        font-size: 11px;
        font-weight: 850;
    }

    .session-field select,
    .session-type-select,
    .special-activity-input {
        width: 100%;
        min-height: 42px;
        border: 1px solid #dbe2ea;
        border-radius: 11px;
        background: #ffffff;
        color: #172033;
        padding: 9px 12px;
        font: inherit;
        outline: none;
        transition: border-color .18s ease, box-shadow .18s ease;
    }

    .session-field select {
        appearance: auto;
    }

    .session-type-row {
        display: grid;
        grid-template-columns: minmax(0, 1fr) minmax(0, 1fr);
        gap: 11px;
    }

    .combined-years {
        display: flex;
        flex-wrap: wrap;
        gap: 7px;
    }

    .year-pill {
        position: relative;
        display: inline-flex;
    }

    .year-pill input {
        position: absolute;
        opacity: 0;
        pointer-events: none;
    }

    .year-pill span {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-width: 43px;
        padding: 7px 10px;
        border: 1px solid #dbe2ea;
        border-radius: 999px;
        background: #ffffff;
        color: #64748b;
        font-size: 11px;
        font-weight: 850;
        cursor: pointer;
        transition: all .18s ease;
    }

    .year-pill input:checked + span {
        background: #eef2ff;
        border-color: #818cf8;
        color: #4338ca;
    }

    .special-activity {
        padding-top: 9px;
        border-top: 1px dashed #f1d69a;
    }

    .special-activity-note {
        margin-bottom: 8px;
        color: #92400e;
        font-size: 11px;
        line-height: 1.5;
    }

    /* ============================================================
       COPY SESSION 1
    ============================================================ */

    .session-copy-tools {
        display: flex;
        justify-content: flex-end;
        margin-top: 12px;
    }

    .copy-session-toggle {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        min-height: 35px;
        padding: 0 11px;
        border: 1px solid #d8cff1;
        border-radius: 9px;
        background: #faf8ff;
        color: #6551ca;
        font: inherit;
        font-size: 10px;
        font-weight: 800;
        cursor: pointer;
        transition: .15s ease;
    }

    .copy-session-toggle i { font-size: 14px; }

    .copy-session-toggle:hover,
    .copy-session-toggle[aria-expanded="true"] {
        border-color: #bcaee1;
        background: #f4efff;
        color: #5745c2;
    }

    .copy-session-panel {
        margin-top: 10px;
        padding: 12px;
        border: 1px dashed #d9d0e9;
        border-radius: 11px;
        background: #faf8fe;
    }

    .copy-session-panel[hidden] {
        display: none;
    }

    .copy-session-panel-header {
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        gap: 10px;
        margin-bottom: 10px;
    }

    .copy-session-panel-header strong,
    .copy-session-panel-header span {
        display: block;
    }

    .copy-session-panel-header strong {
        color: #4d4659;
        font-size: 11px;
    }

    .copy-session-panel-header span {
        max-width: 680px;
        margin-top: 3px;
        color: #948da0;
        font-size: 10px;
        line-height: 1.45;
    }

    .copy-session-panel-header > i {
        color: #8c7ab7;
        font-size: 17px;
        flex: 0 0 auto;
    }

    .copy-session-targets {
        display: flex;
        align-items: center;
        flex-wrap: wrap;
        gap: 7px;
    }

    .copy-session-target {
        position: relative;
        display: inline-flex;
        align-items: center;
        cursor: pointer;
    }

    .copy-session-target input {
        position: absolute;
        opacity: 0;
        pointer-events: none;
    }

    .copy-session-target span {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-height: 34px;
        padding: 0 10px;
        border: 1px solid #dbe2ea;
        border-radius: 999px;
        background: #fff;
        color: #64748b;
        font-size: 10px;
        font-weight: 850;
        transition: .15s ease;
    }

    .copy-session-target:hover span {
        border-color: #c7b9e7;
        background: #faf7ff;
        color: #6551ca;
    }

    .copy-session-target input:checked + span {
        border-color: #818cf8;
        background: #eef2ff;
        color: #4338ca;
        box-shadow: 0 3px 9px rgba(99, 102, 241, .10);
    }

    .copy-session-apply {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 5px;
        min-height: 34px;
        padding: 0 11px;
        border: 1px solid #6366f1;
        border-radius: 9px;
        background: #6366f1;
        color: #fff;
        font: inherit;
        font-size: 10px;
        font-weight: 800;
        cursor: pointer;
        transition: .15s ease;
    }

    .copy-session-apply:hover {
        background: #4f46e5;
        border-color: #4f46e5;
    }

    .session-conflict {
        display: none;
        margin-top: 10px;
        padding: 10px 11px;
        border-radius: 11px;
        background: #fff1f2;
        border: 1px solid #fecdd3;
        color: #9f1239;
        font-size: 11px;
        line-height: 1.5;
    }

    .session-card.has-conflict .session-conflict {
        display: block;
    }

    .session-card.is-disabled {
        opacity: .62;
    }

    .session-card.is-disabled .session-fields {
        display: none;
    }

    .session-card.is-disabled .session-top {
        margin-bottom: 0;
        padding-bottom: 0;
        border-bottom: 0;
    }

    /* ============================================================
       DAY EMPTY
    ============================================================ */

    .day-empty-message {
        display: flex;
        align-items: flex-start;
        gap: 12px;
        padding: 15px;
        margin-bottom: 18px;
        border-radius: 15px;
        border: 1px dashed #cbd5e1;
        background: #f8fafc;
    }

    .empty-icon {
        width: 37px;
        height: 37px;
        flex: 0 0 auto;
        display: grid;
        place-items: center;
        border-radius: 12px;
        background: #e2e8f0;
        color: #64748b;
        font-size: 18px;
    }

    .day-empty-message strong {
        display: block;
        margin-bottom: 3px;
        color: #334155;
        font-size: 13px;
    }

    .day-empty-message p {
        margin: 0;
        color: #64748b;
        font-size: 11px;
        line-height: 1.5;
    }

    /* ============================================================
       NAVIGATION
    ============================================================ */

    .day-navigation {
        display: none;
    }

    .nav-btn {
        min-height: 44px;
        padding: 10px 16px;
        border-radius: 12px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 7px;
        border: 1px solid transparent;
        font: inherit;
        font-size: 12px;
        font-weight: 850;
        cursor: pointer;
        transition: transform .18s ease, box-shadow .18s ease, background .18s ease, opacity .18s ease;
    }

    .nav-btn:hover:not(:disabled) {
        transform: translateY(-2px);
    }

    .nav-btn:disabled {
        opacity: .38;
        cursor: not-allowed;
    }

    .nav-btn-secondary {
        background: #ffffff;
        border-color: #dbe2ea;
        color: #475569;
    }

    .nav-btn-primary {
        background: linear-gradient(135deg, #6366f1, #7c3aed);
        color: #ffffff;
        box-shadow: 0 10px 22px rgba(99, 102, 241, .19);
    }

    .day-navigation-note {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 6px;
        color: #94a3b8;
        font-size: 10.5px;
        text-align: center;
        line-height: 1.4;
    }

    .day-navigation-note i {
        font-size: 15px;
    }

    /* ============================================================
       REVIEW
    ============================================================ */

    .weekly-review-grid {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 13px;
        margin-bottom: 16px;
    }

    .review-day-card {
        padding: 15px;
        border: 1px solid #e5eaf1;
        border-radius: 15px;
        background: #fbfdff;
    }

    .review-day-card:last-child:nth-child(odd) {
        grid-column: span 2;
    }

    .review-day-top {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 10px;
    }

    .review-day-name {
        color: #1e293b;
        font-size: 13px;
        font-weight: 900;
    }

    .review-status {
        display: inline-flex;
        align-items: center;
        gap: 4px;
        padding: 5px 8px;
        border-radius: 999px;
        font-size: 10px;
        font-weight: 850;
    }

    .review-status.ready {
        background: #d1fae5;
        color: #047857;
    }

    .review-status.empty {
        background: #f1f5f9;
        color: #64748b;
    }

    .review-day-details {
        margin-top: 8px;
        color: #64748b;
        font-size: 10.5px;
        line-height: 1.55;
    }

    .review-note {
        display: flex;
        align-items: flex-start;
        gap: 10px;
        padding: 13px 15px;
        margin-top: 16px;
        border-radius: 14px;
        background: #eff6ff;
        border: 1px solid #dbeafe;
        color: #475569;
        font-size: 11px;
        line-height: 1.55;
    }

    .review-note > i {
        color: #2563eb;
        font-size: 17px;
        flex: 0 0 auto;
    }

    .review-note strong {
        display: block;
        margin-bottom: 2px;
        color: #1e3a8a;
    }

    .review-note span {
        display: block;
    }

    /* ============================================================
       FINAL ACTIONS
    ============================================================ */

    .final-actions {
        display: flex;
        justify-content: flex-end;
        align-items: center;
        gap: 10px;
        margin-top: 22px;
        padding-top: 18px;
        border-top: 1px solid #e8edf3;
    }

    .cancel-action,
    .save-action {
        min-height: 46px;
        padding: 10px 17px;
        border-radius: 13px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        text-decoration: none;
        font-size: 12px;
        font-weight: 850;
        border: 1px solid transparent;
        cursor: pointer;
        transition: transform .18s ease, box-shadow .18s ease, opacity .18s ease;
    }

    .cancel-action {
        background: #ffffff;
        border-color: #dbe2ea;
        color: #475569;
    }

    .save-action {
        color: #ffffff;
        background: linear-gradient(135deg, #10b981, #059669);
        box-shadow: 0 10px 23px rgba(16, 185, 129, .17);
    }

    .cancel-action:hover,
    .save-action:hover {
        transform: translateY(-2px);
    }

    .save-action:disabled {
        opacity: .5;
        cursor: not-allowed;
        transform: none;
    }

    /* ============================================================
       APPROVAL & AUTHORIZATION
    ============================================================ */

    .approval-section {
        margin-top: 24px;
    }

    .section-orange {
        background: #ffedd5;
        color: #ea580c;
    }

    .approval-year-block {
        margin-top: 3px;
    }

    #approval-year-234 {
        display: none;
    }

    .approval-grid {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 15px;
    }

    .approval-card {
        position: relative;
        display: flex;
        align-items: flex-start;
        gap: 14px;
        min-width: 0;
        padding: 18px;
        border: 1px solid #e7eaf0;
        border-radius: 17px;
        background: #ffffff;
        box-shadow: 0 7px 20px rgba(15, 23, 42, .04);
        transition:
            transform .18s ease,
            box-shadow .18s ease,
            border-color .18s ease;
    }

    .approval-card:hover {
        transform: translateY(-2px);
        border-color: #fed7aa;
        box-shadow: 0 11px 25px rgba(15, 23, 42, .07);
    }

    .approval-card-single {
        margin-bottom: 15px;
        background: linear-gradient(135deg, #fffaf5, #fffdfb);
        border-color: #fed7aa;
    }

    .approval-card-icon {
        width: 42px;
        height: 42px;
        flex: 0 0 auto;
        display: grid;
        place-items: center;
        border-radius: 13px;
        background: #fff7ed;
        color: #ea580c;
        font-size: 19px;
    }

    .approval-content {
        min-width: 0;
        flex: 1;
    }

    .approval-role {
        display: block;
        margin-bottom: 5px;
        color: #64748b;
        font-size: 10px;
        font-weight: 850;
        letter-spacing: .07em;
        text-transform: uppercase;
    }

    .approval-name {
        display: block;
        color: #1e293b;
        font-size: 14px;
        font-weight: 850;
    }

    .approval-signature-line {
        position: relative;
        height: 25px;
        margin-top: 24px;
        border-bottom: 1px dashed #cbd5e1;
    }

    .approval-signature-line span {
        position: absolute;
        bottom: 4px;
        left: 0;
        color: #94a3b8;
        font-size: 10px;
        font-weight: 700;
    }

    /* ============================================================
       ANIMATION
    ============================================================ */

    @keyframes scheduleFadeUp {
        from {
            opacity: 0;
            transform: translateY(10px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .session-card.entering {
        animation: sessionEnter .28s ease both;
    }

    @keyframes sessionEnter {
        from {
            opacity: 0;
            transform: translateY(6px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* ============================================================
       RESPONSIVE
    ============================================================ */

    @media (max-width: 1100px) {
        .four-columns {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }

        .session-editor {
            grid-template-columns: 1fr;
        }
    }

    @media (max-width: 800px) {
        .schedule-create-page {
            width: min(100% - 24px, 680px);
            padding-top: 22px;
        }

        .create-section {
            padding: 20px;
            border-radius: 19px;
        }

        .two-columns,
        .four-columns {
            grid-template-columns: 1fr;
        }

        .day-tabs {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }

        .day-navigation {
            grid-template-columns: 1fr 1fr;
        }

        .day-navigation-note {
            grid-column: span 2;
            grid-row: 1;
            order: -1;
        }

        .weekly-review-grid {
            grid-template-columns: 1fr;
        }

        .approval-grid {
            grid-template-columns: 1fr;
        }

        .review-day-card:last-child:nth-child(odd) {
            grid-column: auto;
        }
    }

    @media (max-width: 560px) {
        .schedule-header {
            align-items: flex-start;
        }

        .schedule-header-icon {
            width: 50px;
            height: 50px;
            border-radius: 15px;
            font-size: 23px;
        }

        .schedule-header h1 {
            font-size: 29px;
        }

        .day-selector-header,
        .workspace-header {
            align-items: flex-start;
            flex-direction: column;
        }

        .workspace-header-actions,
        .workspace-nav-actions {
            width: 100%;
        }

        .workspace-nav-actions {
            justify-content: flex-end;
        }

        .day-tabs {
            grid-template-columns: 1fr;
        }

        .session-type-row,
        .course-fields {
            grid-template-columns: 1fr;
        }

        .workspace-header-actions {
            align-items: stretch;
            flex-direction: column;
        }

        .workspace-summary {
            width: fit-content;
        }

        .workspace-nav-actions {
            justify-content: stretch;
        }

        .workspace-nav-actions .nav-btn {
            flex: 1;
        }

        .final-actions {
            flex-direction: column-reverse;
            align-items: stretch;
        }

        .cancel-action,
        .save-action {
            width: 100%;
        }
    }
</style>


<script>
document.addEventListener('DOMContentLoaded', function () {
    'use strict';

    const form = document.getElementById('scheduleEditForm');

    if (!form) {
        return;
    }

    /* ============================================================
       DATA
    ============================================================ */

    let days = [];

    try {
        days = JSON.parse(
            document.getElementById('scheduleDayData')?.textContent || '[]'
        );
    } catch (error) {
        days = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday'];
    }

    let timeSlots = [];

    try {
        timeSlots = JSON.parse(
            document.getElementById('sessionSlotData')?.textContent || '[]'
        );
    } catch (error) {
        timeSlots = [];
    }

    if (!timeSlots.length) {
        console.warn('No time slots were supplied to the schedule builder.');
    }

    let oldSchedule = {};

    try {
        oldSchedule = JSON.parse(
            document.getElementById('oldScheduleData')?.textContent || '{}'
        );
    } catch (error) {
        oldSchedule = {};
    }

    let courseData = [];
    let professorData = [];
    let classroomData = [];

    try {
        courseData = JSON.parse(
            document.getElementById('courseData')?.textContent || '[]'
        );

        professorData = JSON.parse(
            document.getElementById('professorData')?.textContent || '[]'
        );

        classroomData = JSON.parse(
            document.getElementById('classroomData')?.textContent || '[]'
        );
    } catch (error) {
        courseData = [];
        professorData = [];
        classroomData = [];
    }

    /*
     * State stays in the browser while HOD moves between Monday-Friday.
     * It is NOT submitted to Laravel until the final button is used.
     *
     * Structure:
     * {
     *   Monday: {
     *      0: {
     *          enabled: true,
     *          slot_id: 1,
     *          activity_type: 'course',
     *          course_id: '...',
     *          professor_id: '...',
     *          room_id: '...',
     *          combined_years: ['2']
     *      }
     *   }
     * }
     */
    const scheduleState = {};

    days.forEach(function (day) {
        scheduleState[day] = {};
    });

    let currentDayIndex = 0;

    /* ============================================================
       ELEMENTS
    ============================================================ */

    const dayTabs = Array.from(
        document.querySelectorAll('.day-tab')
    );

    const selectedDayLabel =
        document.getElementById('selectedDayLabel');

    const dayProgressText =
        document.getElementById('dayProgressText');

    const workspaceDayTitle =
        document.getElementById('workspaceDayTitle');

    const workspaceSessionCount =
        document.getElementById('workspaceSessionCount');

    const selectAllSessionsBtn =
        document.getElementById('selectAllSessionsBtn');

    const sessionEditor =
        document.getElementById('sessionEditor');

    const dayEmptyMessage =
        document.getElementById('dayEmptyMessage');

    const previousDayBtn =
        document.getElementById('previousDayBtn');

    const continueDayBtn =
        document.getElementById('continueDayBtn');

    const weeklyReviewSection =
        document.getElementById('weeklyReviewSection');

    const weeklyReviewGrid =
        document.getElementById('weeklyReviewGrid');

    const saveWeeklyScheduleBtn =
        document.getElementById('saveWeeklyScheduleBtn');

    const scheduleHiddenInputs =
        document.getElementById('scheduleHiddenInputs');

    /* ============================================================
       HELPERS
    ============================================================ */

    function escapeHtml(value) {
        return String(value ?? '')
            .replace(/&/g, '&amp;')
            .replace(/</g, '&lt;')
            .replace(/>/g, '&gt;')
            .replace(/"/g, '&quot;')
            .replace(/'/g, '&#039;');
    }

    function formatTime(value) {
        if (!value) {
            return '';
        }

        const parts = value.split(':');

        if (parts.length < 2) {
            return value;
        }

        let hours = parseInt(parts[0], 10);
        const minutes = parts[1];

        if (Number.isNaN(hours)) {
            return value;
        }

        const suffix = hours >= 12 ? 'PM' : 'AM';

        hours = hours % 12 || 12;

        return hours + ':' + minutes + ' ' + suffix;
    }

    function getSlot(slotIndex) {
        return timeSlots[slotIndex] || {
            id: '',
            session_number: slotIndex + 1,
            session_label: 'Session ' + (slotIndex + 1),
            start_time: '',
            end_time: ''
        };
    }

    function cloneYears(value) {
        if (!Array.isArray(value)) {
            return [];
        }

        return value.map(function (year) {
            return String(year);
        });
    }

    function getDayState(day) {
        if (!scheduleState[day]) {
            scheduleState[day] = {};
        }

        return scheduleState[day];
    }

    function hasSessionContent(session) {
        if (!session || !session.enabled) {
            return false;
        }

        if (session.activity_type && session.activity_type !== 'course') {
            return true;
        }

        return Boolean(
            session.course_id ||
            session.professor_id ||
            session.room_id ||
            (Array.isArray(session.combined_years) && session.combined_years.length)
        );
    }

    function isDayConfigured(day) {
        const state = getDayState(day);

        return Object.values(state).some(function (session) {
            return hasSessionContent(session);
        });
    }

    function configuredSessionCount(day) {
        const state = getDayState(day);

        return Object.values(state).filter(function (session) {
            return hasSessionContent(session);
        }).length;
    }

    function isDayCompletelyEmpty(day) {
        return configuredSessionCount(day) === 0;
    }

    function getSessionActivitySummary(session) {
        if (!session || !session.enabled) {
            return '';
        }

        if (session.activity_type === 'course') {
            const course = findCourseName(session.course_id);

            if (course) {
                return course;
            }

            return 'Course not selected';
        }

        const labels = {
            chapel: 'Chapel',
            break: 'Break',
            free: 'Free Time',
            other: 'Other'
        };

        return labels[session.activity_type] || 'Other';
    }

    function findCourseName(courseId) {
        const item = courseData.find(function (course) {
            return String(course.id) === String(courseId || '');
        });

        return item ? item.label : '';
    }

    function getProfessorName(professorId) {
        const item = professorData.find(function (professor) {
            return String(professor.id) === String(professorId || '');
        });

        return item ? item.label : '';
    }

    function getClassroomName(roomId) {
        const item = classroomData.find(function (classroom) {
            return String(classroom.id) === String(roomId || '');
        });

        return item ? item.label : '';
    }

    function ensureSession(day, slotIndex) {
        const state = getDayState(day);

        if (!state[slotIndex]) {
            const slot = getSlot(slotIndex);

            state[slotIndex] = {
                enabled: false,
                slot_id: String(slot.id),
                activity_type: 'course',
                course_id: '',
                professor_id: '',
                room_id: '',
                combined_years: []
            };
        }

        return state[slotIndex];
    }

    /* ============================================================
       DATA OPTIONS
    ============================================================ */

    function getCourseOptions(selectedValue) {
        const current = String(selectedValue || '');

        let html = '<option value="">Select course</option>';

        courseData.forEach(function (course) {
            const selected =
                current === String(course.id)
                    ? ' selected'
                    : '';

            html +=
                '<option class="course-option" ' +
                'data-course-id="' + escapeHtml(course.id) + '" ' +
                'data-course-label="' + escapeHtml(course.label) + '" ' +
                'value="' + escapeHtml(course.id) + '"' +
                selected +
                '>' +
                escapeHtml(course.label) +
                '</option>';
        });

        return html;
    }

    function getProfessorOptions(selectedValue) {
        const current = String(selectedValue || '');

        let html = '<option value="">Select professor</option>';

        professorData.forEach(function (professor) {
            const selected =
                current === String(professor.id)
                    ? ' selected'
                    : '';

            html +=
                '<option class="professor-option" ' +
                'data-professor-id="' + escapeHtml(professor.id) + '" ' +
                'data-professor-label="' + escapeHtml(professor.label) + '" ' +
                'value="' + escapeHtml(professor.id) + '"' +
                selected +
                '>' +
                escapeHtml(professor.label) +
                '</option>';
        });

        return html;
    }

    function getClassroomOptions(selectedValue) {
        const current = String(selectedValue || '');

        let html = '<option value="">Select classroom</option>';

        classroomData.forEach(function (classroom) {
            const selected =
                current === String(classroom.id)
                    ? ' selected'
                    : '';

            html +=
                '<option class="classroom-option" ' +
                'data-classroom-id="' + escapeHtml(classroom.id) + '" ' +
                'data-classroom-label="' + escapeHtml(classroom.label) + '" ' +
                'value="' + escapeHtml(classroom.id) + '"' +
                selected +
                '>' +
                escapeHtml(classroom.label) +
                '</option>';
        });

        return html;
    }

    function getCombinedYearOptions(session) {
        const mainYear = parseInt(
            document.getElementById('main_year')?.value || '1',
            10
        );

        const selectedYears = cloneYears(
            session.combined_years || []
        );

        let html = '';

        [1, 2, 3, 4].forEach(function (year) {

            if (year === mainYear) {
                return;
            }

            const checked =
                selectedYears.includes(String(year))
                    ? 'checked'
                    : '';

            html += `
                <label class="year-pill">
                    <input
                        type="checkbox"
                        class="session-year-checkbox"
                        data-year="${year}"
                        ${checked}
                    >
                    <span>Year ${year}</span>
                </label>
            `;
        });

        return html;
    }

    function updateSelectAllSessionsButton(day) {

        if (!selectAllSessionsBtn) {
            return;
        }

        const state = getDayState(day);
        const totalSessions = Math.min(timeSlots.length, 4);

        let selectedCount = 0;

        for (let index = 0; index < totalSessions; index++) {
            if (state[index] && state[index].enabled) {
                selectedCount++;
            }
        }

        const allSelected =
            totalSessions > 0 &&
            selectedCount === totalSessions;

        selectAllSessionsBtn.setAttribute(
            'aria-pressed',
            allSelected ? 'true' : 'false'
        );

        selectAllSessionsBtn.innerHTML = allSelected
            ? "<i class='bx bx-checkbox-checked'></i><span>Deselect All</span>"
            : "<i class='bx bx-check-square'></i><span>Select All Sessions</span>";
    }

    /* ============================================================
       SELECT / DESELECT ALL SESSIONS FOR CURRENT DAY
    ============================================================ */

    function toggleAllSessionsForCurrentDay() {

        const day = days[currentDayIndex];

        if (!day || !selectAllSessionsBtn) {
            return;
        }

        saveCurrentVisibleSessionValues();

        const state = getDayState(day);
        const totalSessions = Math.min(timeSlots.length, 4);

        let allSelected = true;

        for (let index = 0; index < totalSessions; index++) {
            if (!state[index] || !state[index].enabled) {
                allSelected = false;
                break;
            }
        }

        for (let index = 0; index < totalSessions; index++) {
            const slot = timeSlots[index];

            state[index] = state[index] || {
                enabled: false,
                slot_id: String(slot?.id || ''),
                activity_type: 'course',
                course_id: '',
                professor_id: '',
                room_id: '',
                combined_years: [],
                special_note: ''
            };

            state[index].enabled = !allSelected;

            if (!state[index].slot_id && slot) {
                state[index].slot_id = String(slot.id);
            }
        }

        renderSessionCards(day);
        updateDayStatusUI();
        updateSelectAllSessionsButton(day);

        checkAllConflicts();
    }

    selectAllSessionsBtn?.addEventListener(
        'click',
        toggleAllSessionsForCurrentDay
    );

    /* ============================================================
       RENDER CURRENT DAY
    ============================================================ */

    function renderCurrentDay() {

        const day = days[currentDayIndex];

        if (!day) {
            return;
        }

        selectedDayLabel.textContent = day;
        workspaceDayTitle.textContent = day + ' Schedule';
        dayProgressText.textContent =
            'Day ' + (currentDayIndex + 1) + ' of ' + days.length;

        dayTabs.forEach(function (tab, index) {
            tab.classList.toggle(
                'active',
                index === currentDayIndex
            );
        });

        previousDayBtn.disabled =
            currentDayIndex === 0;

        continueDayBtn.innerHTML =
            currentDayIndex === days.length - 1
                ? 'Review Schedule <i class="bx bx-right-arrow-alt"></i>'
                : 'Continue <i class="bx bx-right-arrow-alt"></i>';

        renderSessionCards(day);
        updateDayStatusUI();
    }

    function renderSessionCards(day) {

        const state = getDayState(day);

        sessionEditor.innerHTML = '';

        if (!timeSlots.length) {
            sessionEditor.innerHTML = `
                <div class="schedule-alert schedule-alert-error">
                    <div class="schedule-alert-icon">
                        <i class="bx bx-error-circle"></i>
                    </div>
                    <div>
                        <strong>No time slots found.</strong>
                        <div>Please seed the time_slots table before creating a schedule.</div>
                    </div>
                </div>
            `;

            workspaceSessionCount.textContent = '0 sessions';

            return;
        }

        let enabledCount = 0;

        timeSlots.slice(0, 4).forEach(function (slot, index) {

            const session =
                state[index]
                    ? state[index]
                    : {
                        enabled: false,
                        slot_id: String(slot.id),
                        activity_type: 'course',
                        course_id: '',
                        professor_id: '',
                        room_id: '',
                        combined_years: [],
                        special_note: ''
                    };

            const card = buildSessionCard(
                day,
                index,
                slot,
                session
            );

            sessionEditor.insertAdjacentHTML(
                'beforeend',
                card
            );

            if (session.enabled) {
                enabledCount++;
            }
        });

        workspaceSessionCount.textContent =
            enabledCount + ' sessions selected';

        updateSelectAllSessionsButton(day);

        bindSessionEvents(day);

        syncEmptyDayMessage(day);
    }

    function buildSessionCard(
        day,
        index,
        slot,
        session
    ) {
        const enabled =
            session.enabled !== false;

        const activityType =
            session.activity_type || 'course';

        const isSpecial =
            activityType !== 'course';

        const checkedAttr =
            enabled ? 'checked' : '';

        const specialClass =
            isSpecial ? 'special' : '';

        const disabledClass =
            enabled ? '' : 'is-disabled';

        const copyTargets = [0, 1, 2, 3]
            .filter(function (targetIndex) {
                return targetIndex !== index;
            })
            .map(function (targetIndex) {
                return `
                    <label class="copy-session-target">
                        <input type="checkbox" value="${targetIndex}" class="copy-session-target-checkbox">
                        <span>Session ${targetIndex + 1}</span>
                    </label>
                `;
            })
            .join('');

        const copyToolsHtml = `
            <div class="session-copy-tools">
                <button
                    type="button"
                    class="copy-session-toggle"
                    data-copy-session-toggle
                    aria-expanded="false"
                >
                    <i class='bx bx-copy'></i>
                    <span>Copy this session to...</span>
                </button>
            </div>

            <div class="copy-session-panel" data-copy-session-panel hidden>
                <div class="copy-session-panel-header">
                    <div>
                        <strong>Copy Session ${index + 1} setup</strong>
                        <span>Choose the other sessions that should use the same activity, course, professor, classroom and additional years.</span>
                    </div>
                    <i class='bx bx-copy'></i>
                </div>

                <div class="copy-session-targets">
                    ${copyTargets}

                    <button
                        type="button"
                        class="copy-session-apply"
                        data-copy-session-apply
                    >
                        <i class='bx bx-check'></i>
                        Apply
                    </button>
                </div>
            </div>
        `;

        return `
            <article
                class="session-card entering ${specialClass} ${disabledClass}"
                data-day="${escapeHtml(day)}"
                data-session-index="${index}"
            >

                <div class="session-top">

                    <div class="session-title">
                        <span class="session-number">
                            <i class='bx bx-time-five'></i>
                            Session ${index + 1}
                        </span>

                        <strong>
                            ${escapeHtml(
                                slot.session_label ||
                                'Session ' + (index + 1)
                            )}
                        </strong>

                        <div class="session-time">
                            ${escapeHtml(
                                formatTime(slot.start_time)
                            )}
                            ${slot.end_time ? ' – ' + escapeHtml(
                                formatTime(slot.end_time)
                            ) : ''}
                        </div>
                    </div>

                    <label class="session-selector">
                        <input
                            type="checkbox"
                            class="session-enabled-checkbox"
                            ${checkedAttr}
                        >
                        <span>Use session</span>
                    </label>

                </div>

                <div class="session-fields">

                    <div class="session-type-row">

                        <div class="session-field">
                            <label>Activity</label>

                            <select class="session-type-select">
                                <option
                                    value="course"
                                    ${activityType === 'course' ? 'selected' : ''}
                                >
                                    Course
                                </option>

                                <option
                                    value="chapel"
                                    ${activityType === 'chapel' ? 'selected' : ''}
                                >
                                    Chapel
                                </option>

                                <option
                                    value="break"
                                    ${activityType === 'break' ? 'selected' : ''}
                                >
                                    Break
                                </option>

                                <option
                                    value="free"
                                    ${activityType === 'free' ? 'selected' : ''}
                                >
                                    Free Time
                                </option>

                                <option
                                    value="other"
                                    ${activityType === 'other' ? 'selected' : ''}
                                >
                                    Other
                                </option>
                            </select>
                        </div>

                        <div class="session-field">
                            <label>Main Year</label>

                            <select disabled>
                                <option>
                                    Year ${escapeHtml(
                                        document.getElementById('main_year')?.value || 1
                                    )}
                                </option>
                            </select>
                        </div>

                    </div>

                    <div class="course-fields">

                        <div class="session-field">
                            <label>Course</label>

                            <select class="session-course-select">
                                ${getCourseOptions(session.course_id)}
                            </select>
                        </div>

                        <div class="session-field">
                            <label>Professor</label>

                            <select class="session-professor-select">
                                ${getProfessorOptions(session.professor_id)}
                            </select>
                        </div>

                        <div class="session-field">
                            <label>Classroom</label>

                            <select class="session-classroom-select">
                                ${getClassroomOptions(session.room_id)}
                            </select>
                        </div>

                        <div class="session-field">
                            <label>Additional Years</label>

                            <div class="combined-years">
                                ${getCombinedYearOptions(session)}
                            </div>
                        </div>

                    </div>

                    <div class="special-activity" style="${isSpecial ? '' : 'display:none;'}">

                        <div class="special-activity-note">
                            This time is not a teaching session. The HOD can use it
                            for Chapel, Break, Free Time, or another activity.
                        </div>

                        <input
                            type="text"
                            class="special-activity-input"
                            placeholder="Optional note for this time..."
                            value="${escapeHtml(session.special_note || '')}"
                        >

                    </div>

                    ${copyToolsHtml}

                    <div class="session-conflict"></div>

                </div>
            </article>
        `;
    }

    /* ============================================================
       SESSION EVENTS
    ============================================================ */

    function bindSessionEvents(day) {

        const cards = Array.from(
            sessionEditor.querySelectorAll('.session-card')
        );

        cards.forEach(function (card) {

            const index =
                parseInt(
                    card.dataset.sessionIndex,
                    10
                );

            const session =
                ensureSession(day, index);

            const checkbox =
                card.querySelector(
                    '.session-enabled-checkbox'
                );

            const activitySelect =
                card.querySelector(
                    '.session-type-select'
                );

            const courseSelect =
                card.querySelector(
                    '.session-course-select'
                );

            const professorSelect =
                card.querySelector(
                    '.session-professor-select'
                );

            const classroomSelect =
                card.querySelector(
                    '.session-classroom-select'
                );

            const specialInput =
                card.querySelector(
                    '.special-activity-input'
                );

            checkbox.addEventListener(
                'change',
                function () {

                    session.enabled =
                        checkbox.checked;

                    getDayState(day)[index] = session;

                    card.classList.toggle(
                        'is-disabled',
                        !checkbox.checked
                    );

                    const enabledCount =
                        configuredSessionCount(day);

                    workspaceSessionCount.textContent =
                        enabledCount + ' sessions selected';

                    updateSelectAllSessionsButton(day);

                    syncEmptyDayMessage(day);
                    updateDayStatusUI();
                }
            );

            activitySelect.addEventListener(
                'change',
                function () {

                    session.activity_type =
                        activitySelect.value;

                    getDayState(day)[index] = session;

                    const isCourse =
                        session.activity_type === 'course';

                    card.classList.toggle(
                        'special',
                        !isCourse
                    );

                    const courseFields =
                        card.querySelector(
                            '.course-fields'
                        );

                    const specialArea =
                        card.querySelector(
                            '.special-activity'
                        );

                    if (courseFields) {
                        courseFields.style.display =
                            isCourse ? '' : 'none';
                    }

                    if (specialArea) {
                        specialArea.style.display =
                            isCourse ? 'none' : '';
                    }

                    checkAllConflicts();
                }
            );

            courseSelect.addEventListener(
                'change',
                function () {
                    session.course_id =
                        courseSelect.value;

                    getDayState(day)[index] = session;

                    checkAllConflicts();
                }
            );

            professorSelect.addEventListener(
                'change',
                function () {

                    session.professor_id =
                        professorSelect.value;

                    getDayState(day)[index] = session;

                    checkAllConflicts();
                }
            );

            classroomSelect.addEventListener(
                'change',
                function () {

                    session.room_id =
                        classroomSelect.value;

                    getDayState(day)[index] = session;

                    checkSessionConflict(
                        day,
                        index,
                        card
                    );
                }
            );

            card.querySelectorAll(
                '.session-year-checkbox'
            ).forEach(function (checkbox) {

                checkbox.addEventListener(
                    'change',
                    function () {

                        const years =
                            Array.from(
                                card.querySelectorAll(
                                    '.session-year-checkbox:checked'
                                )
                            ).map(function (input) {
                                return input.dataset.year;
                            });

                        session.combined_years = years;

                        getDayState(day)[index] = session;

                        checkAllConflicts();
                    }
                );
            });

            if (specialInput) {
                specialInput.addEventListener(
                    'input',
                    function () {
                        session.special_note =
                            specialInput.value;

                        getDayState(day)[index] = session;
                    }
                );
            }

            syncActivityUI(
                card,
                session.activity_type
            );

            const copyToggle =
                card.querySelector('[data-copy-session-toggle]');

            const copyPanel =
                card.querySelector('[data-copy-session-panel]');

            const copyApply =
                card.querySelector('[data-copy-session-apply]');

            if (copyToggle && copyPanel) {
                copyToggle.addEventListener('click', function () {
                    const isOpen = !copyPanel.hasAttribute('hidden');

                    if (isOpen) {
                        copyPanel.setAttribute('hidden', '');
                        copyToggle.setAttribute('aria-expanded', 'false');
                    } else {
                        copyPanel.removeAttribute('hidden');
                        copyToggle.setAttribute('aria-expanded', 'true');
                    }
                });
            }

            if (copyApply) {
                copyApply.addEventListener('click', function () {
                    saveCurrentVisibleSessionValues();

                    const source = getDayState(day)[index];

                    if (!source || !source.enabled) {
                        alert('Please enable Session ' + (index + 1) + ' before copying it.');
                        return;
                    }

                    if (
                        source.activity_type === 'course' &&
                        (!source.course_id || !source.professor_id || !source.room_id)
                    ) {
                        alert(
                            'Please complete Session ' + (index + 1) + ' Course, Professor and Classroom before copying.'
                        );
                        return;
                    }

                    const targetChecks = Array.from(
                        copyPanel.querySelectorAll(
                            '.copy-session-target-checkbox:checked'
                        )
                    );

                    if (!targetChecks.length) {
                        alert('Please select at least one session to copy to.');
                        return;
                    }

                    targetChecks.forEach(function (checkbox) {
                        const targetIndex = parseInt(checkbox.value, 10);
                        const target = ensureSession(day, targetIndex);

                        target.enabled = true;
                        target.activity_type = source.activity_type || 'course';
                        target.course_id = source.course_id || '';
                        target.professor_id = source.professor_id || '';
                        target.room_id = source.room_id || '';
                        target.combined_years = cloneYears(source.combined_years || []);
                        target.special_note = source.special_note || '';

                        getDayState(day)[targetIndex] = target;
                    });

                    renderSessionCards(day);
                    checkAllConflicts();
                });
            }
        });
    }

    function syncActivityUI(card, activityType) {

        const isCourse =
            activityType === 'course';

        const courseFields =
            card.querySelector('.course-fields');

        const specialArea =
            card.querySelector('.special-activity');

        if (courseFields) {
            courseFields.style.display =
                isCourse ? '' : 'none';
        }

        if (specialArea) {
            specialArea.style.display =
                isCourse ? 'none' : '';
        }

        card.classList.toggle(
            'special',
            !isCourse
        );
    }

    /* ============================================================
       EMPTY DAY STATE
    ============================================================ */

    function syncEmptyDayMessage(day) {

        const enabledCount =
            configuredSessionCount(day);

        dayEmptyMessage.hidden =
            enabledCount > 0;

        workspaceSessionCount.textContent =
            enabledCount + ' sessions selected';
    }

    /* ============================================================
       DAY STATUS
    ============================================================ */

    function updateDayStatusUI() {

        days.forEach(function (day) {

            const tab =
                document.querySelector(
                    '.day-tab[data-day="' + day + '"]'
                );

            const status =
                document.querySelector(
                    '[data-day-status="' + day + '"]'
                );

            if (!tab || !status) {
                return;
            }

            const count =
                configuredSessionCount(day);

            if (count > 0) {

                tab.classList.add('completed');

                status.textContent =
                    count + ' session' +
                    (count === 1 ? '' : 's') +
                    ' configured';

            } else {

                tab.classList.remove('completed');

                status.textContent =
                    'Not configured';
            }
        });
    }

    /* ============================================================
       DAY NAVIGATION
    ============================================================ */

    dayTabs.forEach(function (tab) {

        tab.addEventListener(
            'click',
            function () {

                const index =
                    parseInt(
                        tab.dataset.dayIndex,
                        10
                    );

                if (Number.isNaN(index)) {
                    return;
                }

                saveCurrentVisibleSessionValues();
                currentDayIndex = index;
                renderCurrentDay();

                window.scrollTo({
                    top:
                        document.querySelector(
                            '.weekly-section'
                        ).offsetTop - 30,
                    behavior: 'smooth'
                });
            }
        );
    });

    previousDayBtn.addEventListener(
        'click',
        function () {

            saveCurrentVisibleSessionValues();

            if (currentDayIndex > 0) {
                currentDayIndex--;
                renderCurrentDay();
            }
        }
    );

    continueDayBtn.addEventListener(
        'click',
        function () {

            saveCurrentVisibleSessionValues();

            if (currentDayIndex < days.length - 1) {

                currentDayIndex++;
                renderCurrentDay();

                window.scrollTo({
                    top:
                        document.querySelector(
                            '.weekly-section'
                        ).offsetTop - 30,
                    behavior: 'smooth'
                });

                return;
            }

            renderWeeklyReview();

            weeklyReviewSection.scrollIntoView({
                behavior: 'smooth',
                block: 'start'
            });
        }
    );

    /* ============================================================
       SAVE VISIBLE SESSION VALUES TO JS STATE
    ============================================================ */

    function saveCurrentVisibleSessionValues() {

        const day =
            days[currentDayIndex];

        if (!day) {
            return;
        }

        const state =
            getDayState(day);

        sessionEditor
            .querySelectorAll('.session-card')
            .forEach(function (card) {

                const index =
                    parseInt(
                        card.dataset.sessionIndex,
                        10
                    );

                const checkbox =
                    card.querySelector(
                        '.session-enabled-checkbox'
                    );

                const activitySelect =
                    card.querySelector(
                        '.session-type-select'
                    );

                const courseSelect =
                    card.querySelector(
                        '.session-course-select'
                    );

                const professorSelect =
                    card.querySelector(
                        '.session-professor-select'
                    );

                const classroomSelect =
                    card.querySelector(
                        '.session-classroom-select'
                    );

                const specialInput =
                    card.querySelector(
                        '.special-activity-input'
                    );

                const years =
                    Array.from(
                        card.querySelectorAll(
                            '.session-year-checkbox:checked'
                        )
                    ).map(function (input) {
                        return input.dataset.year;
                    });

                const slot =
                    getSlot(index);

                state[index] = {
                    enabled: checkbox
                        ? checkbox.checked
                        : true,

                    slot_id:
                        String(
                            slot.id
                        ),

                    activity_type:
                        activitySelect
                            ? activitySelect.value
                            : 'course',

                    course_id:
                        courseSelect
                            ? courseSelect.value
                            : '',

                    professor_id:
                        professorSelect
                            ? professorSelect.value
                            : '',

                    room_id:
                        classroomSelect
                            ? classroomSelect.value
                            : '',

                    combined_years:
                        years,

                    special_note:
                        specialInput
                            ? specialInput.value
                            : ''
                };
            });

        updateDayStatusUI();
    }

    /* ============================================================
       CONFLICT CHECKING
    ============================================================ */

    let conflictCounter = 0;

    function getSessionConflictMessage(card) {
        const message = card?.querySelector('.session-conflict');
        return message || null;
    }

    function getCurrentSessionData(day, index, card) {
        const state = getDayState(day)[index];

        if (!state) {
            return null;
        }

        return {
            day: day,
            index: index,
            state: state,
            card: card,
            course_id: state.course_id || '',
            professor_id: state.professor_id || '',
            room_id: state.room_id || '',
            slot_id: String(state.slot_id || ''),
            years: [
                document.getElementById('main_year')?.value || '',
                ...(state.combined_years || [])
            ].filter(Boolean).map(String)
        };
    }

    function getLocalConflicts(day, index) {
        const currentState = getDayState(day)[index];

        if (!currentState || !currentState.enabled) {
            return [];
        }

        if (currentState.activity_type !== 'course') {
            return [];
        }

        const current = getCurrentSessionData(
            day,
            index,
            document.querySelector(
                '.session-card[data-session-index="' + index + '"]'
            )
        );

        if (!current) {
            return [];
        }

        const conflicts = [];
        const dayState = getDayState(day);

        Object.keys(dayState).forEach(function (otherIndex) {
            if (String(otherIndex) === String(index)) {
                return;
            }

            const otherState = dayState[otherIndex];

            if (
                !otherState ||
                !otherState.enabled ||
                otherState.activity_type !== 'course'
            ) {
                return;
            }

            const other = getCurrentSessionData(
                day,
                otherIndex,
                document.querySelector(
                    '.session-card[data-session-index="' + otherIndex + '"]'
                )
            );

            if (!other || other.slot_id !== current.slot_id) {
                return;
            }

            if (
                current.professor_id &&
                other.professor_id &&
                current.professor_id === other.professor_id
            ) {
                conflicts.push(
                    'This professor is already selected in another session at this time.'
                );
            }

            if (
                current.room_id &&
                other.room_id &&
                current.room_id === other.room_id
            ) {
                conflicts.push(
                    'This classroom is already selected in another session at this time.'
                );
            }

            const sameYear = current.years.some(function (year) {
                return other.years.includes(String(year));
            });

            if (sameYear) {
                conflicts.push(
                    'One or more selected year levels are already selected in another session at this time.'
                );
            }
        });

        return [...new Set(conflicts)];
    }

    async function checkSessionConflict(
        day,
        index,
        card
    ) {
        if (!card) {
            return true;
        }

        const state = getDayState(day)[index];

        if (!state || !state.enabled) {
            clearSessionConflict(card);
            return true;
        }

        if (state.activity_type !== 'course') {
            clearSessionConflict(card);
            return true;
        }

        const localConflicts = getLocalConflicts(day, index);

        if (localConflicts.length) {
            showSessionConflict(
                card,
                '⚠ Schedule conflict: ' + localConflicts.join(' ')
            );
            return false;
        }

        const semester =
            document.getElementById('semester')?.value || '';

        const year =
            document.getElementById('main_year')?.value || '';

        const years = [
            year,
            ...(state.combined_years || [])
        ].filter(Boolean);

        const slotId =
            state.slot_id;

        if (
            !semester ||
            !slotId ||
            !state.professor_id ||
            !state.room_id ||
            !state.course_id ||
            years.length === 0
        ) {
            clearSessionConflict(card);
            return true;
        }

        const requestId =
            ++conflictCounter;

        try {
            const editScheduleIds = JSON.parse(
                document.getElementById('editScheduleIds')?.textContent || '[]'
            );

            const params = new URLSearchParams({
                professor_id: state.professor_id || '',
                room_id: state.room_id || '',
                slot_id: slotId,
                day_of_week: day,
                semester: semester,
                academic_year: document.getElementById('academic_year')?.value || '',
                promotion: document.getElementById('promotion')?.value || '',
                year_levels: JSON.stringify(years),
                exclude_schedule_ids: JSON.stringify(editScheduleIds)
            });

            const response = await fetch(
                "{{ route('hod.schedules.checkConflict') }}" +
                "?" +
                params.toString(),
                {
                    method: 'GET',
                    headers: {
                        'Accept': 'application/json'
                    }
                }
            );

            if (!response.ok) {
                showSessionConflict(
                    card,
                    '⚠ Unable to check this session for conflicts.'
                );
                return false;
            }

            const data =
                await response.json();

            if (requestId !== conflictCounter) {
                return true;
            }

            const conflicts = [];

            if (data.professor_conflict) {
                conflicts.push(
                    'This professor already has a schedule at this time.'
                );
            }

            if (data.classroom_conflict) {
                conflicts.push(
                    'This classroom is already occupied at this time.'
                );
            }

            if (data.year_conflict || data.time_slot_conflict) {
                conflicts.push(
                    'One or more selected year levels already have a schedule at this time.'
                );
            }

            if (conflicts.length) {
                showSessionConflict(
                    card,
                    '⚠ Schedule conflict: ' + conflicts.join(' ')
                );
                return false;
            }

            clearSessionConflict(card);
            return true;

        } catch (error) {
            console.error(
                'Conflict check failed:',
                error
            );

            showSessionConflict(
                card,
                '⚠ Unable to check this session for conflicts.'
            );

            return false;
        }
    }

    async function checkAllConflicts() {
        const cards =
            Array.from(
                document.querySelectorAll('.session-card')
            );

        let hasConflict = false;

        for (const card of cards) {
            const day =
                card.dataset.day;

            const index =
                parseInt(
                    card.dataset.sessionIndex,
                    10
                );

            const result =
                await checkSessionConflict(
                    day,
                    index,
                    card
                );

            if (!result) {
                hasConflict = true;
            }
        }

        if (saveWeeklyScheduleBtn) {
            saveWeeklyScheduleBtn.disabled =
                hasConflict;
        }

        return !hasConflict;
    }

    function showSessionConflict(card, message) {

        card.classList.add('has-conflict');

        const box =
            card.querySelector('.session-conflict');

        if (box) {
            box.textContent = message;
        }
    }

    function clearSessionConflict(card) {

        card.classList.remove(
            'has-conflict'
        );

        const box =
            card.querySelector('.session-conflict');

        if (box) {
            box.textContent = '';
        }
    }

    /* ============================================================
       REVIEW
    ============================================================ */

    function renderWeeklyReview() {

        saveCurrentVisibleSessionValues();

        weeklyReviewGrid.innerHTML = '';

        days.forEach(function (day) {

            const state =
                getDayState(day);

            const configuredCount =
                configuredSessionCount(day);

            const statusHtml =
                configuredCount > 0
                    ? `
                        <span class="review-status ready">
                            <i class='bx bx-check-circle'></i>
                            ${configuredCount} session${configuredCount === 1 ? '' : 's'}
                        </span>
                    `
                    : `
                        <span class="review-status empty">
                            <i class='bx bx-minus-circle'></i>
                            Not configured
                        </span>
                    `;

            let details = '';

            if (configuredCount > 0) {

                const sessionLines = [];

                Object.values(state)
                    .forEach(function (session) {

                        if (!session || !session.enabled) {
                            return;
                        }

                        const slotIndex =
                            findSlotIndex(
                                session.slot_id
                            );

                        const slot =
                            getSlot(
                                slotIndex
                            );

                        sessionLines.push(
                            `
                                <div>
                                    <strong>
                                        ${escapeHtml(
                                            'S' + (slotIndex + 1)
                                        )}
                                    </strong>
                                    ·
                                    ${escapeHtml(
                                        formatTime(slot.start_time)
                                    )}
                                    –
                                    ${escapeHtml(
                                        formatTime(slot.end_time)
                                    )}
                                    ·
                                    ${escapeHtml(
                                        getSessionActivitySummary(session)
                                    )}
                                </div>
                            `
                        );
                    });

                details =
                    sessionLines.join('');
            } else {

                details =
                    'This day is empty and can be completed later.';
            }

            weeklyReviewGrid.insertAdjacentHTML(
                'beforeend',
                `
                    <div class="review-day-card">
                        <div class="review-day-top">
                            <span class="review-day-name">
                                ${escapeHtml(day)}
                            </span>
                            ${statusHtml}
                        </div>

                        <div class="review-day-details">
                            ${details}
                        </div>
                    </div>
                `
            );
        });

        saveWeeklyScheduleBtn.disabled =
            !hasAnyConfiguredSessions();
    }

    function findSlotIndex(slotId) {

        const index =
            timeSlots.findIndex(function (slot) {
                return String(slot.id) === String(slotId);
            });

        return index >= 0 ? index : 0;
    }

    function hasAnyConfiguredSessions() {

        return days.some(function (day) {
            return configuredSessionCount(day) > 0;
        });
    }

    /* ============================================================
       BUILD FINAL SERVER INPUTS
    ============================================================ */

function buildHiddenInputs() {

    scheduleHiddenInputs.innerHTML = '';

    days.forEach(function (day) {

        const state = getDayState(day);

        Object.keys(state)
            .sort(function (a, b) {
                return Number(a) - Number(b);
            })
            .forEach(function (index) {

                const session = state[index];

                if (!session || !session.enabled) {
                    return;
                }

                /*
                 * Time slot
                 */
                appendHidden(
                    `days[${day}][${index}][slot_id]`,
                    session.slot_id
                );

                /*
                 * Activity type
                 *
                 * course
                 * chapel
                 * break
                 * free
                 * other
                 */
                appendHidden(
                    `days[${day}][${index}][activity_type]`,
                    session.activity_type || 'course'
                );

                /*
                 * Special activity note
                 */
                appendHidden(
                    `days[${day}][${index}][special_note]`,
                    session.special_note || ''
                );

                /*
                 * Course fields
                 *
                 * For Chapel/Break/Free/Other these will be empty.
                 */
                appendHidden(
                    `days[${day}][${index}][course_id]`,
                    session.course_id || ''
                );

                appendHidden(
                    `days[${day}][${index}][professor_id]`,
                    session.professor_id || ''
                );

                appendHidden(
                    `days[${day}][${index}][room_id]`,
                    session.room_id || ''
                );

                /*
                 * Additional years only apply to courses.
                 */
                if (session.activity_type === 'course') {

                    (session.combined_years || [])
                        .forEach(function (year) {

                            appendHidden(
                                `days[${day}][${index}][combined_years][]`,
                                year
                            );

                        });

                }

            });

    });
}
    function appendHidden(name, value) {

        const input =
            document.createElement('input');

        input.type = 'hidden';
        input.name = name;
        input.value = value ?? '';

        scheduleHiddenInputs.appendChild(
            input
        );
    }

    /* ============================================================
       MAIN YEAR CHANGE
    ============================================================ */

    const mainYear =
        document.getElementById('main_year');

    /*
     * Keep the original approval logic:
     * - Main Year 1 → Foundation Year Department approval
     * - Main Years 2, 3, 4 → Academic Office + Department Head approval
     */
    function updateApprovalSection() {

        const approvalYear1 =
            document.getElementById('approval-year-1');

        const approvalYear234 =
            document.getElementById('approval-year-234');

        if (!mainYear || !approvalYear1 || !approvalYear234) {
            return;
        }

        if (String(mainYear.value) === '1') {
            approvalYear1.style.display = 'block';
            approvalYear234.style.display = 'none';
        } else {
            approvalYear1.style.display = 'none';
            approvalYear234.style.display = 'grid';
        }
    }

    if (mainYear) {
        mainYear.addEventListener(
            'change',
            function () {
                saveCurrentVisibleSessionValues();
                renderCurrentDay();
                updateApprovalSection();
            }
        );
    }

    /* ============================================================
       FINAL SUBMIT
    ============================================================ */

    let allowFinalSubmit = false;

    form.addEventListener(
        'submit',
        async function (event) {

            if (allowFinalSubmit) {
                return;
            }

            event.preventDefault();

            saveCurrentVisibleSessionValues();

            if (!hasAnyConfiguredSessions()) {
                weeklyReviewSection.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });

                alert(
                    'Please configure at least one schedule session before saving.'
                );

                return;
            }

            buildHiddenInputs();

            const missingCourseData = [];

            days.forEach(function (day) {
                const state =
                    getDayState(day);

                Object.keys(state)
                    .forEach(function (index) {
                        const session =
                            state[index];

                        if (
                            !session ||
                            !session.enabled ||
                            session.activity_type !== 'course'
                        ) {
                            return;
                        }

                        if (
                            !session.course_id ||
                            !session.professor_id ||
                            !session.room_id
                        ) {
                            missingCourseData.push(
                                day + ' — Session ' + (
                                    Number(index) + 1
                                )
                            );
                        }
                    });
            });

            if (missingCourseData.length) {
                alert(
                    'Please complete Course, Professor and Classroom for:\n\n' +
                    missingCourseData.join('\n')
                );

                return;
            }

            /*
             * Run the same conflict check again immediately before saving.
             * This prevents a stale page from submitting a new conflict.
             */
            const conflictFree =
                await checkAllConflicts();

            if (!conflictFree) {
                const firstConflict =
                    document.querySelector(
                        '.session-card.has-conflict'
                    );

                if (firstConflict) {
                    firstConflict.scrollIntoView({
                        behavior: 'smooth',
                        block: 'center'
                    });
                }

                alert(
                    'Please fix the schedule conflicts before saving.'
                );

                return;
            }

            allowFinalSubmit = true;

            saveWeeklyScheduleBtn.disabled = true;

            saveWeeklyScheduleBtn.innerHTML = `
                <span>Saving...</span>
                <i class='bx bx-loader-alt bx-spin'></i>
            `;

            /*
             * Calculate the exam end dates immediately before the real
             * native form submission.
             *
             * The final submit handler uses HTMLFormElement.prototype.submit(),
             * which bypasses normal submit event listeners. Therefore the exam
             * end dates must be set here.
             */
            const midtermStart =
                document.getElementById('midterm_exam_start');

            const midtermEnd =
                document.getElementById('midterm_exam_end');

            const finalStart =
                document.getElementById('final_exam_start');

            const finalEnd =
                document.getElementById('final_exam_end');

            if (midtermStart && midtermEnd) {
                midtermEnd.value =
                    getExamEndDate(midtermStart.value);
            }

            if (finalStart && finalEnd) {
                finalEnd.value =
                    getExamEndDate(finalStart.value);
            }

            HTMLFormElement.prototype.submit.call(form);
        }
    );

    /* ============================================================
       LOAD OLD INPUT AFTER VALIDATION ERROR
    ============================================================ */

    function loadOldSchedule() {

        if (
            !oldSchedule ||
            typeof oldSchedule !== 'object'
        ) {
            return;
        }

        days.forEach(function (day) {

            if (
                !oldSchedule[day] ||
                typeof oldSchedule[day] !== 'object'
            ) {
                return;
            }

            Object.keys(
                oldSchedule[day]
            ).forEach(function (index) {

                const oldSession =
                    oldSchedule[day][index];

                if (!oldSession) {
                    return;
                }

                const slot =
                    getSlot(
                        Number(index)
                    );

                scheduleState[day][index] = {
                    enabled: oldSession.enabled !== false,
                    slot_id:
                        String(
                            oldSession.slot_id ||
                            slot.id ||
                            ''
                        ),
                    activity_type:
                        oldSession.activity_type ||
                        'course',
                    course_id:
                        oldSession.course_id ||
                        '',
                    professor_id:
                        oldSession.professor_id ||
                        '',
                    room_id:
                        oldSession.room_id ||
                        '',
                    combined_years:
                        cloneYears(
                            oldSession.combined_years ||
                            []
                        ),
                    special_note:
                        oldSession.special_note ||
                        ''
                };
            });
        });
    }

    /* ============================================================
       EXAM DATE RANGE
    ============================================================ */

    function getExamEndDate(startDate) {
        if (!startDate) {
            return '';
        }

        const date = new Date(startDate + 'T00:00:00');

        if (Number.isNaN(date.getTime())) {
            return '';
        }

        /* Exam period = start date + 4 weekdays (5 weekdays total). */
        let weekdaysAdded = 0;

        while (weekdaysAdded < 4) {
            date.setDate(date.getDate() + 1);

            const dayNumber = date.getDay();

            if (dayNumber !== 0 && dayNumber !== 6) {
                weekdaysAdded++;
            }
        }

        return date.toISOString().split('T')[0];
    }

    function setupExamDateRange(startId, endId, rangeId) {
        const startInput =
            document.getElementById(startId);

        const endInput =
            document.getElementById(endId);

        const rangeText =
            document.getElementById(rangeId);

        if (!startInput || !endInput) {
            return;
        }

        function syncExamEndDate() {
            if (!startInput.value) {
                endInput.value = '';

                if (rangeText) {
                    rangeText.textContent = '';
                }

                return;
            }

            const start =
                new Date(startInput.value + 'T00:00:00');

            if (Number.isNaN(start.getTime())) {
                endInput.value = '';
                return;
            }

            const dayNumber = start.getDay();

            if (dayNumber === 0 || dayNumber === 6) {
                endInput.value = '';

                if (rangeText) {
                    rangeText.textContent =
                        '⚠ Please select a weekday.';
                }

                return;
            }

            const endDate =
                getExamEndDate(startInput.value);

            endInput.value = endDate;

            if (rangeText) {
                rangeText.textContent =
                    'Exam period: ' +
                    startInput.value +
                    ' to ' +
                    endDate;
            }
        }

        startInput.addEventListener(
            'change',
            syncExamEndDate
        );

        /* Also calculate it when an old value is loaded. */
        syncExamEndDate();
    }

    setupExamDateRange(
        'midterm_exam_start',
        'midterm_exam_end',
        'midterm_exam_range'
    );

    setupExamDateRange(
        'final_exam_start',
        'final_exam_end',
        'final_exam_range'
    );

    /* ============================================================
       INITIALISE
    ============================================================ */

    loadOldSchedule();
    updateApprovalSection();

    /*
     * Edit behavior:
     * Existing sessions are loaded from the database for all five days.
     * Empty sessions remain disabled/empty.
     * The HOD can move Monday-Friday, change any session, and review the
     * complete week before saving.
     */
    renderCurrentDay();
    updateDayStatusUI();

    setTimeout(function () {
        checkAllConflicts();
    }, 100);
});
</script>

@endsection
