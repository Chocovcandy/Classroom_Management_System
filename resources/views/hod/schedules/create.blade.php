@extends('layouts.hod_layout')

@section('title', 'Create Schedule')

@section('content')
@php
    $days = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday'];
    $sessionSlots = $timeSlots->sortBy('session_number')->take(4)->values();
@endphp

<div class="schedule-create-page">

    <a href="{{ route('hod.schedules.index') }}" class="schedule-back-button">

        <i class='bx bx-arrow-back'></i>
        <span>Back to schedules</span>
    </a>

    {{-- ============================================================
        COMPACT PAGE HEADER
    ============================================================= --}}
    <div class="schedule-header">
        <div class="schedule-header-main">
            <div class="schedule-eyebrow">
                <i class='bx bx-calendar-edit'></i>
                HoD • Schedule Management
            </div>
            <h1>Create Weekly Schedule</h1>
            <p>Set the schedule details, build the week, then save.</p>
        </div>
    </div>

    {{-- ============================================================
        VALIDATION ERRORS
    ============================================================= --}}
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
        id="scheduleCreateForm"
        method="POST"
        action="{{ route('hod.schedules.store') }}"
        novalidate
    >
        @csrf

        {{-- ========================================================
            01. SCHEDULE DETAILS
        ========================================================= --}}
        <section class="create-section details-section">
            <div class="section-heading compact-heading">
                <div class="section-number section-blue">01</div>
                <div>
                    <span class="section-kicker">Schedule Setup</span>
                    <h2>Schedule Details</h2>
                </div>
            </div>

            <div class="details-grid">

                {{-- Semester --}}
                <div class="field-group">
                    <label for="semester">Semester <span>*</span></label>
                    <div class="input-shell">
                        <i class='bx bx-bookmark'></i>
                        <select name="semester" id="semester" required>
                            <option value="">Select semester</option>
                            <option value="Semester 1" {{ old('semester') === 'Semester 1' ? 'selected' : '' }}>
                                Semester 1
                            </option>
                            <option value="Semester 2" {{ old('semester') === 'Semester 2' ? 'selected' : '' }}>
                                Semester 2
                            </option>
                        </select>
                        <i class='bx bx-chevron-down input-chevron'></i>
                    </div>
                </div>

                {{-- Academic Year --}}
                <div class="field-group">
                    <label for="academic_year">Academic Year <span>*</span></label>
                    <div class="input-shell">
                        <i class='bx bx-calendar'></i>
                        <select name="academic_year" id="academic_year" required>
                            <option value="">Select academic year</option>
                            <option value="2025-2026" {{ old('academic_year') === '2025-2026' ? 'selected' : '' }}>
                                2025-2026
                            </option>
                            <option value="2026-2027" {{ old('academic_year') === '2026-2027' ? 'selected' : '' }}>
                                2026-2027
                            </option>
                        </select>
                        <i class='bx bx-chevron-down input-chevron'></i>
                    </div>
                </div>

                {{-- Promotion --}}
                <div class="field-group">
                    <label for="promotion">Promotion <span>*</span></label>
                    <div class="input-shell">
                        <i class='bx bx-group'></i>
                        <select name="promotion" id="promotion" required>
                            <option value="">Select promotion</option>
                            @for ($i = 1; $i <= 30; $i++)
                                <option value="{{ $i }}" {{ old('promotion') == $i ? 'selected' : '' }}>
                                    Promotion {{ $i }}
                                </option>
                            @endfor
                        </select>
                        <i class='bx bx-chevron-down input-chevron'></i>
                    </div>
                </div>

                {{-- Main Year: selectable --}}
                <div class="field-group">
                    <label for="main_year">
                        Main Year <span>*</span>
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

            <div class="compact-note-row">
                <label for="note">Note</label>
                <div class="input-shell input-shell-textarea compact-textarea-shell">
                    <i class='bx bx-note textarea-icon'></i>
                    <textarea
                        name="note"
                        id="note"
                        rows="2"
                        placeholder="Optional note..."
                    >{{ old('note') }}</textarea>
                </div>
            </div>
        </section>

        {{-- ========================================================
            02. DATES
        ========================================================= --}}
        <section class="create-section dates-section">
            <div class="section-heading compact-heading">
                <div class="section-number section-yellow">02</div>
                <div>
                    <span class="section-kicker">Academic Period</span>
                    <h2>Dates</h2>
                </div>
            </div>

            <div class="date-group-title">Class Period</div>
            <div class="date-grid">
                <div class="field-group">
                    <label for="starting_date">Starting Date <span>*</span></label>
                    <div class="input-shell">
                        <i class='bx bx-calendar'></i>
                        <input type="date" name="starting_date" id="starting_date" value="{{ old('starting_date') }}" required>
                    </div>
                </div>
                <div class="field-group">
                    <label for="finished_date">Finished Date <span>*</span></label>
                    <div class="input-shell">
                        <i class='bx bx-calendar-check'></i>
                        <input type="date" name="finished_date" id="finished_date" value="{{ old('finished_date') }}" required>
                    </div>
                </div>
            </div>

            <div class="date-group-title exam-title">Exams</div>
            <div class="date-grid">
                <div class="field-group">
                    <label for="midterm_exam_start">Mid-Term <span>*</span></label>
                    <div class="input-shell">
                        <i class='bx bx-edit-alt'></i>
                        <input type="date" name="midterm_exam_start" id="midterm_exam_start" value="{{ old('midterm_exam_start') }}" required>
                    </div>
                    <small id="midterm_exam_range"></small>
                    <input type="hidden" id="midterm_exam_end" name="midterm_exam_end" value="{{ old('midterm_exam_end') }}">
                </div>

                <div class="field-group">
                    <label for="final_exam_start">Final <span>*</span></label>
                    <div class="input-shell">
                        <i class='bx bx-graduation'></i>
                        <input type="date" name="final_exam_start" id="final_exam_start" value="{{ old('final_exam_start') }}" required>
                    </div>
                    <small id="final_exam_range"></small>
                    <input type="hidden" id="final_exam_end" name="final_exam_end" value="{{ old('final_exam_end') }}">
                </div>
            </div>
        </section>

        {{-- ========================================================
            03. WEEKLY SCHEDULE + LIVE REVIEW
        ========================================================= --}}
        <section class="create-section weekly-section" id="weeklyBuilderSection">
            <div class="section-heading compact-heading weekly-heading">
                <div class="section-number section-purple">03</div>
                <div>
                    <span class="section-kicker">Weekly Builder</span>
                    <h2>Weekly Schedule</h2>
                </div>
            </div>

            <div class="weekly-layout">
                <div class="weekly-main">
                    {{-- Day Selector --}}
                    <div class="day-selector-card">
                        <div class="day-selector-header">
                            <div>
                                <span class="mini-label">Selected Day</span>
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
                                    <small class="day-tab-status" data-day-status="{{ $dayName }}">Not configured</small>
                                </button>
                            @endforeach
                        </div>
                    </div>

                    {{-- Current Day Workspace --}}
                    <div class="day-workspace">
                        <div class="workspace-header">
                            <div class="workspace-title">
                                <div class="workspace-icon"><i class='bx bx-calendar'></i></div>
                                <div>
                                    <span class="mini-label">Current Day</span>
                                    <h3 id="workspaceDayTitle">Monday Schedule</h3>
                                </div>
                            </div>

                            <div class="workspace-header-actions">
                                <button type="button" id="selectAllSessionsBtn" class="select-all-sessions-btn" aria-pressed="false">
                                    <i class='bx bx-check-square'></i>
                                    <span>Select all</span>
                                </button>

                                <div class="workspace-summary">
                                    <span id="workspaceSessionCount">0 sessions selected</span>
                                </div>

                                <div class="workspace-nav-actions">
                                    <button type="button" id="previousDayBtn" class="nav-btn nav-btn-secondary" disabled>
                                        <i class='bx bx-left-arrow-alt'></i>
                                        Previous
                                    </button>
                                    <button type="button" id="continueDayBtn" class="nav-btn nav-btn-primary">
                                        Continue
                                        <i class='bx bx-right-arrow-alt'></i>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div id="sessionEditor" class="session-editor"></div>

                        <div id="dayEmptyMessage" class="day-empty-message" hidden>
                            <div class="empty-icon"><i class='bx bx-calendar-x'></i></div>
                            <div>
                                <strong>This day can be left empty.</strong>
                                <p>You can continue and return later.</p>
                            </div>
                        </div>

                        <div class="workspace-bottom-hint">
                            <i class='bx bx-info-circle'></i>
                            <span>Changes stay here until you save the complete week.</span>
                        </div>
                    </div>
                </div>


            </div>
        </section>

        {{-- ========================================================
            04. APPROVAL & AUTHORIZATION
        ========================================================= --}}
        <section class="create-section approval-section" id="approvalSection">
            <div class="section-heading compact-heading">
                <div class="section-number section-orange">04</div>
                <div>
                    <span class="section-kicker">Approval</span>
                    <h2>Approval & Authorization</h2>
                </div>
            </div>

            <div id="approval-year-1" class="approval-year-block">
                <div class="approval-card approval-card-single">
                    <div class="approval-card-icon"><i class='bx bx-user-check'></i></div>
                    <div class="approval-content">
                        <span class="approval-role">Head of Foundation Year Department</span>
                        <strong class="approval-name">LEC. Soeung Sambath</strong>
                        <div class="approval-signature-line"><span>Signature</span></div>
                    </div>
                </div>
            </div>

            <div id="approval-year-234" class="approval-grid">
                <div class="approval-card">
                    <div class="approval-card-icon"><i class='bx bx-briefcase-alt-2'></i></div>
                    <div class="approval-content">
                        <span class="approval-role">Head of Academic Office</span>
                        <strong class="approval-name">LEC. SAN PISETH</strong>
                        <div class="approval-signature-line"><span>Signature</span></div>
                    </div>
                </div>

                <div class="approval-card">
                    <div class="approval-card-icon"><i class='bx bx-user-voice'></i></div>
                    <div class="approval-content">
                        <span class="approval-role">Head of {{ $department->department_name }}</span>
                        <strong class="approval-name">
                            LEC. {{ $department->head?->name ?? 'Department Head Not Assigned' }}
                        </strong>
                        <div class="approval-signature-line"><span>Signature</span></div>
                    </div>
                </div>
            </div>
        </section>

        {{-- ========================================================
            FINAL ACTIONS
        ========================================================= --}}
        <div class="final-actions">
            <a href="{{ route('hod.dashboard') }}" class="cancel-action">
                <i class='bx bx-x'></i>
                Cancel
            </a>
            <button type="submit" id="saveWeeklyScheduleBtn" class="save-action">
                <span>Save Weekly Schedule</span>
                <i class='bx bx-check'></i>
            </button>
        </div>

        <div id="scheduleHiddenInputs"></div>
    </form>
</div>

{{-- ================================================================
    SESSION TEMPLATE DATA
================================================================ --}}
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

    $oldScheduleData = old('days', []);
@endphp

<script type="application/json" id="courseData">{!! json_encode($courseData->values()->all()) !!}</script>
<script type="application/json" id="professorData">{!! json_encode($professorData->values()->all()) !!}</script>
<script type="application/json" id="classroomData">{!! json_encode($classroomData->values()->all()) !!}</script>
<script type="application/json" id="sessionSlotData">{!! json_encode($sessionSlotData->values()->all()) !!}</script>
<script type="application/json" id="oldScheduleData">{!! json_encode($oldScheduleData) !!}</script>




<style>
/* ============================================================
   CLEAN SCHEDULE BUILDER
============================================================ */
.schedule-create-page {
    width: min(1380px, calc(100% - 32px));
    margin: 0 auto;
    padding: 22px 0 50px;
    color: #172033;
}

.schedule-back-button {
    display: inline-flex;
    align-items: center;
    gap: 7px;
    margin-bottom: 16px;
    color: #64748b;
    text-decoration: none;
    font-size: 12px;
    font-weight: 800;
}

.schedule-back-button i { font-size: 18px; }
.schedule-back-button:hover { color: #2563eb; }

.schedule-header {
    margin-bottom: 20px;
}

.schedule-eyebrow {
    display: inline-flex;
    align-items: center;
    gap: 7px;
    margin-bottom: 6px;
    color: #6366f1;
    font-size: 12px;
    font-weight: 900;
    letter-spacing: .08em;
    text-transform: uppercase;
}

.schedule-header h1 {
    margin: 0;
    color: #111827;
    font-size: clamp(28px, 3.5vw, 38px);
    line-height: 1.08;
    letter-spacing: -.04em;
    font-weight: 850;
}

.schedule-header p {
    margin: 6px 0 0;
    color: #64748b;
    font-size: 13px;
}

.schedule-alert {
    display: flex;
    gap: 11px;
    align-items: flex-start;
    margin-bottom: 16px;
    padding: 13px 15px;
    border-radius: 13px;
    font-size: 12px;
}

.schedule-alert-error {
    color: #9f1239;
    background: #fff1f2;
    border: 1px solid #fecdd3;
}

.schedule-alert-icon { font-size: 20px; }
.schedule-alert strong { display: block; margin-bottom: 4px; }
.schedule-alert ul { margin: 0; padding-left: 17px; line-height: 1.55; }

.create-section {
    position: relative;
    margin-bottom: 14px;
    padding: 21px 23px;
    background: #fff;
    border: 1px solid #e5eaf2;
    border-radius: 18px;
    box-shadow: 0 7px 24px rgba(15,23,42,.035);
}

.create-section::before {
    content: "";
    position: absolute;
    left: -1px;
    top: -1px;
    width: 220px;
    height: 28px;
    border-top: 3px solid #6366f1;
    border-left: 3px solid #6366f1;
    border-top-left-radius: 18px;
    pointer-events: none;
}

.dates-section::before {
    border-color: #f59e0b;
}

.weekly-section::before {
    border-color: #6366f1;
}

.approval-section::before {
    border-color: #f97316;
}

.compact-heading {
    display: flex;
    align-items: center;
    gap: 11px;
    margin-bottom: 15px;
}

.section-number {
    width: 34px;
    height: 34px;
    border-radius: 11px;
    display: grid;
    place-items: center;
    flex: 0 0 auto;
    font-size: 11px;
    font-weight: 900;
}

.section-blue { background:#dbeafe; color:#2563eb; }
.section-yellow { background:#fef3c7; color:#d97706; }
.section-purple { background:#ede9fe; color:#7c3aed; }
.section-orange { background:#ffedd5; color:#ea580c; }

.section-kicker {
    display: block;
    margin-bottom: 2px;
    color: #94a3b8;
    font-size: 10px;
    font-weight: 900;
    letter-spacing: .12em;
    text-transform: uppercase;
}

.section-heading h2,
.review-sidebar-header h3 {
    margin: 0;
    color: #111827;
    font-size: 21px;
    line-height: 1.2;
    letter-spacing: -.025em;
}

.details-grid,
.date-grid {
    display: grid;
    gap: 12px;
}

.details-grid { grid-template-columns: repeat(4, minmax(0, 1fr)); }
.date-grid { grid-template-columns: repeat(2, minmax(0, 1fr)); }

.field-group { min-width: 0; }

.field-group label {
    display: flex;
    align-items: center;
    gap: 3px;
    margin-bottom: 6px;
    color: #334155;
    font-size: 13px;
    font-weight: 850;
}

.field-group label span { color:#ef4444; }

.field-group small {
    display:block;
    margin-top: 5px;
    color:#94a3b8;
    font-size: 11px;
    line-height: 1.45;
}

.input-shell { position:relative; }

.input-shell > i:first-child {
    position:absolute;
    left:11px;
    top:50%;
    transform:translateY(-50%);
    color:#94a3b8;
    font-size:16px;
    z-index:1;
    pointer-events:none;
}

.input-shell input,
.input-shell select,
.input-shell textarea {
    width:100%;
    border:1px solid #dbe2ea;
    border-radius:10px;
    background:#fff;
    color:#172033;
    outline:none;
    font:inherit;
    transition:.18s ease;
}

.input-shell input,
.input-shell select {
    min-height:42px;
    padding:9px 34px 9px 34px;
    font-size:14px;
}

.input-shell textarea {
    min-height:58px;
    padding:10px 12px 10px 34px;
    resize:vertical;
    font-size:14px;
}

.input-shell input:focus,
.input-shell select:focus,
.input-shell textarea:focus {
    border-color:#818cf8;
    box-shadow:0 0 0 3px rgba(99,102,241,.08);
}

.input-shell select { appearance:none; cursor:pointer; }

/* Session Main Year is display-only: hide its native/custom arrow. */
.session-field select:disabled {
    appearance: none;
    -webkit-appearance: none;
    background-image: none;
    cursor: default;
    padding-right: 9px;
    color: #475569;
    background-color: #f8fafc;
}

.input-chevron {
    position:absolute;
    top:50%;
    right:11px;
    transform:translateY(-50%);
    color:#94a3b8;
    pointer-events:none;
}

.readonly-shell .readonly-value {
    min-height:42px;
    display:flex;
    align-items:center;
    padding:9px 12px 9px 34px;
    border:1px solid #dbe2ea;
    border-radius:10px;
    background:#f8fafc;
    color:#475569;
    font-size:12px;
    font-weight:800;
}

.readonly-shell > i:first-child { z-index:2; }

.compact-note-row {
    display:grid;
    grid-template-columns:60px minmax(0,1fr);
    gap:10px;
    align-items:start;
    margin-top:12px;
}

.compact-note-row > label {
    padding-top:11px;
    color:#334155;
    font-size:11px;
    font-weight:850;
}

.textarea-icon {
    top:12px !important;
    transform:none !important;
}

.date-group-title {
    margin-bottom:8px;
    color:#64748b;
    font-size:11px;
    font-weight:900;
    letter-spacing:.08em;
    text-transform:uppercase;
}

.exam-title { margin-top:13px; }

/* ============================================================
   WEEKLY BUILDER
============================================================ */
.weekly-layout {
    display: grid;
    grid-template-columns: minmax(0, 1fr);
    width: 100%;
    gap: 14px;
    align-items: start;
}

.weekly-main {
    width: 100%;
    min-width: 0;
}

.weekly-section .day-selector-card {
    padding: 15px;
    margin-bottom: 15px;
    border:1px solid #e7e3fb;
    border-radius:14px;
    background:#fbfaff;
}

.day-selector-header {
    display:flex;
    align-items:center;
    justify-content:space-between;
    margin-bottom:10px;
}

.mini-label {
    display:block;
    margin-bottom:2px;
    color:#94a3b8;
    font-size:8px;
    font-weight:900;
    letter-spacing:.1em;
    text-transform:uppercase;
}

.day-selector-header strong {
    color:#27223f;
    font-size:17px;
}

.day-progress {
    padding:6px 9px;
    border:1px solid #e6e1f7;
    border-radius:999px;
    background:#fff;
    color:#7c3aed;
    font-size:9px;
    font-weight:800;
}

.day-tabs {
    display:grid;
    grid-template-columns:repeat(5,minmax(0,1fr));
    gap:7px;
}

.day-tab {
    position:relative;
    min-width:0;
    padding:11px 11px 10px;
    border:1px solid #e1e6ee;
    border-radius:10px;
    background:#fff;
    color:#334155;
    cursor:pointer;
    text-align:left;
    transition:.16s ease;
}

.day-tab:hover { border-color:#c7d2fe; background:#fcfcff; }
.day-tab.active { border-color:#818cf8; background:#eef2ff; }

.day-tab-name {
    display:block;
    margin-bottom:2px;
    font-size:12px;
    font-weight:850;
}

.day-tab-status {
    display:block;
    overflow:hidden;
    color:#94a3b8;
    font-size:9px;
    font-weight:700;
    white-space:nowrap;
    text-overflow:ellipsis;
}

.day-tab.completed .day-tab-status { color:#059669; }

.day-tab-check {
    display:none;
    position:absolute;
    right:7px;
    top:7px;
    width:16px;
    height:16px;
    place-items:center;
    border-radius:50%;
    background:#10b981;
    color:#fff;
    font-size:11px;
}

.day-tab.completed .day-tab-check { display:grid; }

.day-workspace {
    padding:16px;
    border:1px solid #e8ecf3;
    border-radius:14px;
    background:#fbfdff;
}

.workspace-header {
    display:flex;
    justify-content:space-between;
    align-items:center;
    gap:10px;
    padding-bottom:10px;
    margin-bottom:11px;
    border-bottom:1px solid #edf1f6;
}

.workspace-title { display:flex; align-items:center; gap:9px; }
.workspace-icon {
    width:40px;
    height:40px;
    display:grid;
    place-items:center;
    border-radius:10px;
    background:#e0e7ff;
    color:#4f46e5;
    font-size:17px;
}

.workspace-title h3 {
    margin:0;
    color:#1e293b;
    font-size:18px;
}

.workspace-header-actions {
    display:flex;
    align-items:center;
    gap:7px;
}

.workspace-nav-actions { display:flex; gap:6px; }

.workspace-summary {
    padding:6px 9px;
    border-radius:999px;
    background:#f1f5f9;
    color:#64748b;
    font-size:9px;
    font-weight:850;
    white-space:nowrap;
}

.select-all-sessions-btn,
.nav-btn {
    min-height:36px;
    padding:7px 9px;
    display:inline-flex;
    align-items:center;
    justify-content:center;
    gap:5px;
    border-radius:9px;
    font:inherit;
    font-size:10px;
    font-weight:850;
    cursor:pointer;
    transition:.16s ease;
}

.select-all-sessions-btn {
    border:1px solid #c7d2fe;
    background:#fff;
    color:#4f46e5;
}

.select-all-sessions-btn:hover { background:#eef2ff; }

.nav-btn { border:1px solid transparent; }
.nav-btn-secondary { background:#fff; border-color:#dbe2ea; color:#475569; }
.nav-btn-primary { background:#6366f1; color:#fff; box-shadow:0 7px 16px rgba(99,102,241,.16); }
.nav-btn:disabled { opacity:.4; cursor:not-allowed; }

.session-editor {
    display:grid;
    grid-template-columns:repeat(2,minmax(0,1fr));
    gap:10px;
}

.session-card {
    position:relative;
    padding:15px;
    border:1px solid #e3e8f0;
    border-radius:13px;
    background:#fff;
    box-shadow:0 5px 15px rgba(15,23,42,.035);
}

.session-card:hover { border-color:#c7d2fe; }
.session-card.special { background:#fffdf8; border-color:#fde68a; }
.session-card.conflict { border-color:#fca5a5; }

.session-top {
    display:flex;
    justify-content:space-between;
    gap:8px;
    padding-bottom:9px;
    margin-bottom:10px;
    border-bottom:1px solid #eef2f7;
}

.session-number {
    display:flex;
    align-items:center;
    gap:4px;
    color:#4f46e5;
    font-size:9px;
    font-weight:900;
    letter-spacing:.06em;
    text-transform:uppercase;
}

.session-title strong {
    display:block;
    margin-top:2px;
    color:#172033;
    font-size:15px;
}

.session-time {
    margin-top:3px;
    color:#64748b;
    font-size:10px;
    font-weight:700;
}

.session-selector {
    display:flex;
    align-items:center;
    gap:5px;
    padding:6px 7px;
    border:1px solid #e2e8f0;
    border-radius:8px;
    background:#f8fafc;
    white-space:nowrap;
}

.session-selector input { width:13px; height:13px; accent-color:#6366f1; }
.session-selector span { color:#475569; font-size:8px; font-weight:800; }

.session-fields { display:grid; gap:8px; }
.course-fields { display:grid; grid-template-columns:repeat(2,minmax(0,1fr)); gap:8px; }
.session-type-row { display:grid; grid-template-columns:repeat(2,minmax(0,1fr)); gap:8px; }

.session-field label {
    display:block;
    margin-bottom:4px;
    color:#475569;
    font-size:10px;
    font-weight:850;
}

.session-field select,
.session-type-select,
.special-activity-input {
    width:100%;
    min-height:38px;
    padding:7px 8px;
    border:1px solid #dbe2ea;
    border-radius:8px;
    background:#fff;
    color:#172033;
    font:inherit;
    font-size:10px;
    outline:none;
}

.session-field select:focus,
.session-type-select:focus,
.special-activity-input:focus {
    border-color:#818cf8;
    box-shadow:0 0 0 3px rgba(99,102,241,.08);
}

.combined-years { display:flex; flex-wrap:wrap; gap:5px; }
.year-pill { position:relative; display:inline-flex; }
.year-pill input { position:absolute; opacity:0; pointer-events:none; }
.year-pill span {
    display:inline-flex;
    align-items:center;
    justify-content:center;
    min-width:37px;
    min-height:29px;
    padding:0 7px;
    border:1px solid #dbe2ea;
    border-radius:999px;
    background:#fff;
    color:#64748b;
    font-size:8px;
    font-weight:850;
    cursor:pointer;
}
.year-pill input:checked + span { background:#eef2ff; border-color:#818cf8; color:#4338ca; }

.special-activity { padding-top:7px; border-top:1px dashed #f1d69a; }
.special-activity-note { margin-bottom:6px; color:#92400e; font-size:8px; line-height:1.45; }

.session-copy-tools { display:flex; justify-content:flex-end; margin-top:8px; }
.copy-session-toggle {
    display:inline-flex;
    align-items:center;
    gap:4px;
    min-height:29px;
    padding:0 8px;
    border:1px solid #d8cff1;
    border-radius:8px;
    background:#faf8ff;
    color:#6551ca;
    font:inherit;
    font-size:8px;
    font-weight:800;
    cursor:pointer;
}
.copy-session-panel { margin-top:7px; padding:9px; border:1px dashed #d9d0e9; border-radius:9px; background:#faf8fe; }
.copy-session-panel[hidden] { display:none; }
.copy-session-panel-header { display:flex; justify-content:space-between; gap:8px; margin-bottom:8px; }
.copy-session-panel-header strong { display:block; color:#4d4659; font-size:8px; }
.copy-session-panel-header span { display:block; margin-top:2px; color:#948da0; font-size:7px; line-height:1.4; }
.copy-session-targets { display:flex; flex-wrap:wrap; gap:5px; align-items:center; }
.copy-session-target { position:relative; display:inline-flex; cursor:pointer; }
.copy-session-target input { position:absolute; opacity:0; pointer-events:none; }
.copy-session-target span { display:inline-flex; min-height:28px; align-items:center; padding:0 7px; border:1px solid #dbe2ea; border-radius:999px; background:#fff; color:#64748b; font-size:8px; font-weight:850; }
.copy-session-target input:checked + span { border-color:#818cf8; background:#eef2ff; color:#4338ca; }
.copy-session-apply { min-height:28px; padding:0 8px; border:1px solid #6366f1; border-radius:8px; background:#6366f1; color:#fff; font:inherit; font-size:8px; font-weight:800; cursor:pointer; }

.session-conflict { display:none; margin-top:7px; padding:8px; border:1px solid #fecdd3; border-radius:8px; background:#fff1f2; color:#9f1239; font-size:8px; line-height:1.45; }
.session-card.has-conflict .session-conflict { display:block; }
.session-card.is-disabled { opacity:.62; }
.session-card.is-disabled .session-fields { display:none; }
.session-card.is-disabled .session-top { margin-bottom:0; padding-bottom:0; border-bottom:0; }

.day-empty-message { display:flex; gap:9px; padding:10px; border:1px dashed #cbd5e1; border-radius:10px; background:#f8fafc; }
.empty-icon { width:28px; height:28px; display:grid; place-items:center; border-radius:8px; background:#e2e8f0; color:#64748b; font-size:13px; flex:0 0 auto; }
.day-empty-message strong { display:block; margin-bottom:2px; color:#334155; font-size:9px; }
.day-empty-message p { margin:0; color:#64748b; font-size:8px; }
.workspace-bottom-hint { display:flex; justify-content:center; align-items:center; gap:4px; margin-top:9px; color:#94a3b8; font-size:8px; }


/* ============================================================
   APPROVAL
============================================================ */
#approval-year-234 { display:none; }
.approval-grid { display:grid; grid-template-columns:repeat(2,minmax(0,1fr)); gap:10px; }
.approval-card { display:flex; gap:9px; padding:11px; border:1px solid #e7eaf0; border-radius:11px; background:#fff; }
.approval-card-single { background:#fffaf5; border-color:#fed7aa; }
.approval-card-icon { width:31px; height:31px; display:grid; place-items:center; flex:0 0 auto; border-radius:9px; background:#fff7ed; color:#ea580c; font-size:14px; }
.approval-content { min-width:0; flex:1; }
.approval-role { display:block; margin-bottom:3px; color:#64748b; font-size:8px; font-weight:850; letter-spacing:.06em; text-transform:uppercase; }
.approval-name { display:block; color:#1e293b; font-size:11px; font-weight:850; }
.approval-signature-line { height:18px; margin-top:13px; border-bottom:1px dashed #cbd5e1; position:relative; }
.approval-signature-line span { position:absolute; bottom:2px; left:0; color:#94a3b8; font-size:7px; }

.final-actions { display:flex; justify-content:flex-end; align-items:center; gap:8px; padding-top:13px; margin-top:4px; border-top:1px solid #e8edf3; }
.cancel-action,
.save-action { min-height:40px; padding:8px 13px; border-radius:10px; display:inline-flex; align-items:center; justify-content:center; gap:6px; font-size:10px; font-weight:850; text-decoration:none; border:1px solid transparent; cursor:pointer; }
.cancel-action { background:#fff; border-color:#dbe2ea; color:#475569; }
.save-action { background:#10b981; color:#fff; box-shadow:0 8px 17px rgba(16,185,129,.15); }
.save-action:disabled { opacity:.5; cursor:not-allowed; }

@media (max-width: 1100px) {
    .details-grid {
        grid-template-columns: repeat(2, minmax(0, 1fr));
    }
}

@media (max-width: 760px) {
    .schedule-create-page { width:min(100% - 20px, 680px); padding-top:16px; }
    .create-section { padding:14px; }
    .date-grid, .details-grid, .approval-grid { grid-template-columns:1fr; }
    .compact-note-row { grid-template-columns:1fr; gap:5px; }
    .compact-note-row > label { padding-top:0; }
    .day-tabs { grid-template-columns:repeat(2,minmax(0,1fr)); }
    .session-editor { grid-template-columns:1fr; }
    .workspace-header { align-items:flex-start; flex-direction:column; }
    .workspace-header-actions { width:100%; flex-wrap:wrap; }
    .workspace-nav-actions { margin-left:auto; }
    .final-actions { flex-direction:column-reverse; align-items:stretch; }
    .cancel-action, .save-action { width:100%; }
}

@media (max-width: 460px) {
    .schedule-header h1 { font-size:28px; }
    .day-tabs { grid-template-columns:1fr; }
    .session-type-row, .course-fields { grid-template-columns:1fr; }
}


/* ============================================================
   LARGE READABLE WEEKLY BUILDER
   Final typography pass for Section 03
============================================================ */

.weekly-section .section-kicker {
    font-size: 12px;
    letter-spacing: .10em;
}

.weekly-section .section-heading h2 {
    font-size: 26px;
}

/* Day selector */
.weekly-section .mini-label {
    font-size: 11px;
}

.weekly-section .day-selector-header strong {
    font-size: 20px;
}

.weekly-section .day-progress {
    padding: 8px 12px;
    font-size: 12px;
}

.weekly-section .day-tab {
    padding: 13px 13px 12px;
}

.weekly-section .day-tab-name {
    font-size: 14px;
}

.weekly-section .day-tab-status {
    font-size: 10px;
}

/* Workspace header */
.weekly-section .workspace-title .mini-label {
    font-size: 11px;
}

.weekly-section .workspace-title h3 {
    font-size: 21px;
}

.weekly-section .workspace-icon {
    width: 42px;
    height: 42px;
    font-size: 21px;
}

.weekly-section .workspace-summary {
    padding: 7px 10px;
    font-size: 11px;
}

.weekly-section .select-all-sessions-btn,
.weekly-section .nav-btn {
    min-height: 40px;
    padding: 8px 12px;
    font-size: 11px;
}

.weekly-section .select-all-sessions-btn i,
.weekly-section .nav-btn i {
    font-size: 16px;
}

/* Session cards */
.weekly-section .session-card {
    padding: 17px;
}

.weekly-section .session-number {
    font-size: 10px;
}

.weekly-section .session-number i {
    font-size: 14px;
}

.weekly-section .session-title strong {
    font-size: 18px;
}

.weekly-section .session-time {
    font-size: 12px;
}

.weekly-section .session-selector {
    padding: 8px 10px;
}

.weekly-section .session-selector input {
    width: 16px;
    height: 16px;
}

.weekly-section .session-selector span {
    font-size: 11px;
}

.weekly-section .session-field label {
    margin-bottom: 5px;
    font-size: 11px;
}

.weekly-section .session-field select,
.weekly-section .session-type-select,
.weekly-section .special-activity-input {
    min-height: 41px;
    padding: 8px 10px;
    font-size: 12px;
}

.weekly-section .year-pill span {
    min-width: 43px;
    min-height: 33px;
    padding: 0 9px;
    font-size: 11px;
}

.weekly-section .copy-session-toggle {
    min-height: 33px;
    padding: 0 10px;
    font-size: 10px;
}

.weekly-section .copy-session-panel-header strong {
    font-size: 10px;
}

.weekly-section .copy-session-panel-header span {
    font-size: 9px;
}

.weekly-section .copy-session-target span {
    min-height: 32px;
    padding: 0 9px;
    font-size: 10px;
}

.weekly-section .copy-session-apply {
    min-height: 32px;
    padding: 0 10px;
    font-size: 10px;
}

.weekly-section .special-activity-note {
    font-size: 10px;
}

.weekly-section .session-conflict {
    font-size: 10px;
}

.weekly-section .day-empty-message {
    padding: 13px;
}

.weekly-section .empty-icon {
    width: 33px;
    height: 33px;
    font-size: 16px;
}

.weekly-section .day-empty-message strong {
    font-size: 11px;
}

.weekly-section .day-empty-message p {
    font-size: 10px;
}

.weekly-section .workspace-bottom-hint {
    font-size: 10px;
}

/* Live review sidebar */
.weekly-section .review-sidebar-header h3 {
    font-size: 19px;
}

.weekly-section .live-badge {
    padding: 6px 9px;
    font-size: 9px;
}

.weekly-section .live-badge span {
    width: 7px;
    height: 7px;
}

.weekly-section .review-day-card {
    padding: 10px;
}

.weekly-section .review-day-name {
    font-size: 11px;
}

.weekly-section .review-status {
    padding: 5px 6px;
    font-size: 9px;
}

.weekly-section .review-day-details {
    font-size: 9px;
}

.weekly-section .review-total {
    padding: 10px;
}

.weekly-section .review-total span {
    font-size: 10px;
}

.weekly-section .review-total strong {
    font-size: 20px;
}

.weekly-section .review-sidebar-note {
    font-size: 9px;
}

/* Keep Section 01 Main Year selectable; only disabled session selects
   are rendered without a dropdown arrow. */
.session-field select:disabled {
    appearance: none;
    -webkit-appearance: none;
    background-image: none !important;
    cursor: default;
}

/* Accent follows the rounded top-left corner */
.create-section::before {
    left: -1px;
    top: -1px;
    width: 230px;
    height: 30px;
    border-top-left-radius: 18px;
}


/* ============================================================
   FINAL READABILITY PASS — SESSION CARDS + LIVE REVIEW
============================================================ */

/* Session card header */
.weekly-section .session-number {
    font-size: 12px;
    letter-spacing: .07em;
}

.weekly-section .session-number i {
    font-size: 16px;
}

.weekly-section .session-title strong {
    font-size: 20px;
    line-height: 1.2;
}

.weekly-section .session-time {
    font-size: 13px;
    line-height: 1.4;
}

/* Use-session control */
.weekly-section .session-selector {
    min-height: 48px;
    padding: 9px 12px;
    gap: 7px;
}

.weekly-section .session-selector input {
    width: 18px;
    height: 18px;
}

.weekly-section .session-selector span {
    font-size: 12px;
}

/* Session field labels */
.weekly-section .session-field label {
    margin-bottom: 6px;
    font-size: 12px;
}

/* Session inputs / selects */
.weekly-section .session-field select,
.weekly-section .session-type-select,
.weekly-section .special-activity-input {
    min-height: 44px;
    padding: 9px 11px;
    font-size: 13px;
}

/* Disabled session Main Year should remain clearly readable,
   but still have no dropdown arrow. */
.weekly-section .session-field select:disabled {
    appearance: none;
    -webkit-appearance: none;
    background-image: none !important;
    padding-right: 11px;
    color: #64748b;
    background-color: #f8fafc;
}

/* Additional year pills */
.weekly-section .year-pill span {
    min-width: 46px;
    min-height: 35px;
    padding: 0 10px;
    font-size: 11px;
}

/* Copy session */
.weekly-section .copy-session-toggle {
    min-height: 36px;
    padding: 0 11px;
    font-size: 11px;
}

.weekly-section .copy-session-panel-header strong {
    font-size: 11px;
}

.weekly-section .copy-session-panel-header span {
    font-size: 10px;
}

.weekly-section .copy-session-target span {
    min-height: 34px;
    padding: 0 10px;
    font-size: 11px;
}

.weekly-section .copy-session-apply {
    min-height: 34px;
    padding: 0 11px;
    font-size: 11px;
}

/* Empty-day message */
.weekly-section .day-empty-message strong {
    font-size: 12px;
}

.weekly-section .day-empty-message p {
    font-size: 11px;
}

.weekly-section .workspace-bottom-hint {
    font-size: 11px;
}
/* ============================================================
   LIVE REVIEW — LARGER GRAY / SECONDARY TEXT
============================================================ */

/* Small section label */
.weekly-review-sidebar .review-sidebar-header .section-kicker {
    font-size: 12px;
}

/* Day names */
.weekly-review-sidebar .review-day-name {
    font-size: 13px;
}

/* Not configured / session count badge */
.weekly-review-sidebar .review-status {
    font-size: 10px;
}

/* Session details */
.weekly-review-sidebar .review-day-details {
    font-size: 11px;
    line-height: 1.55;
}

/* Empty-day message */
.weekly-review-sidebar .review-day-details {
    color: #64748b;
}

/* Total sessions label */
.weekly-review-sidebar .review-total span {
    font-size: 11px;
}

/* Bottom helper text */
.weekly-review-sidebar .review-sidebar-note {
    font-size: 10px;
    line-height: 1.55;
}

/* Keep icons aligned with the larger text */
.weekly-review-sidebar .review-sidebar-note i {
    font-size: 14px;
}

/* Also make the Live badge a little easier to read */
.weekly-review-sidebar .live-badge {
    font-size: 10px;
}
/* ============================================================
   DARK MODE — CREATE SCHEDULE
============================================================ */

/* Page */
body.dark-mode .schedule-create-page,
[data-theme="dark"] .schedule-create-page {
    color: #f8fafc;
}

/* Back button */
body.dark-mode .schedule-back-button,
[data-theme="dark"] .schedule-back-button {
    color: #94a3b8;
}

body.dark-mode .schedule-back-button:hover,
[data-theme="dark"] .schedule-back-button:hover {
    color: #93c5fd;
}

/* Header */
body.dark-mode .schedule-eyebrow,
[data-theme="dark"] .schedule-eyebrow {
    color: #a5b4fc;
}

body.dark-mode .schedule-header h1,
[data-theme="dark"] .schedule-header h1 {
    color: #f8fafc;
}

body.dark-mode .schedule-header p,
[data-theme="dark"] .schedule-header p {
    color: #94a3b8;
}

/* Main sections */
body.dark-mode .create-section,
[data-theme="dark"] .create-section {
    background: #111827;
    border-color: #263449;
    box-shadow: 0 8px 28px rgba(0, 0, 0, .22);
}

/* Section headings */
body.dark-mode .section-kicker,
[data-theme="dark"] .section-kicker {
    color: #94a3b8;
}

body.dark-mode .section-heading h2,
[data-theme="dark"] .section-heading h2 {
    color: #f8fafc;
}

/* Form labels */
body.dark-mode .field-group label,
[data-theme="dark"] .field-group label {
    color: #dbe4f0;
}

body.dark-mode .field-group small,
[data-theme="dark"] .field-group small {
    color: #8796aa;
}

/* Inputs */
body.dark-mode .input-shell input,
body.dark-mode .input-shell select,
body.dark-mode .input-shell textarea,
[data-theme="dark"] .input-shell input,
[data-theme="dark"] .input-shell select,
[data-theme="dark"] .input-shell textarea {
    background: #1e293b;
    border-color: #334155;
    color: #f8fafc;
}

body.dark-mode .input-shell input::placeholder,
body.dark-mode .input-shell textarea::placeholder,
[data-theme="dark"] .input-shell input::placeholder,
[data-theme="dark"] .input-shell textarea::placeholder {
    color: #718096;
}

body.dark-mode .input-shell input:focus,
body.dark-mode .input-shell select:focus,
body.dark-mode .input-shell textarea:focus,
[data-theme="dark"] .input-shell input:focus,
[data-theme="dark"] .input-shell select:focus,
[data-theme="dark"] .input-shell textarea:focus {
    border-color: #818cf8;
    box-shadow: 0 0 0 3px rgba(129, 140, 248, .14);
}

/* Input icons + chevrons */
body.dark-mode .input-shell > i:first-child,
body.dark-mode .input-chevron,
[data-theme="dark"] .input-shell > i:first-child,
[data-theme="dark"] .input-chevron {
    color: #94a3b8;
}

/* Read-only Main Year inside sessions */
body.dark-mode .readonly-shell .readonly-value,
[data-theme="dark"] .readonly-shell .readonly-value,
body.dark-mode .session-field select:disabled,
[data-theme="dark"] .session-field select:disabled {
    background: #172033;
    border-color: #334155;
    color: #94a3b8;
}

/* Weekly day selector */
body.dark-mode .day-selector-card,
[data-theme="dark"] .day-selector-card {
    background: #151a2a;
    border-color: #373064;
}

body.dark-mode .day-selector-header strong,
[data-theme="dark"] .day-selector-header strong {
    color: #f1f5f9;
}

body.dark-mode .day-progress,
[data-theme="dark"] .day-progress {
    background: #1e293b;
    border-color: #3b4261;
    color: #a5b4fc;
}

/* Day tabs */
body.dark-mode .day-tab,
[data-theme="dark"] .day-tab {
    background: #172033;
    border-color: #334155;
    color: #dbe4f0;
}

body.dark-mode .day-tab:hover,
[data-theme="dark"] .day-tab:hover {
    background: #1e293b;
    border-color: #6366f1;
}

body.dark-mode .day-tab.active,
[data-theme="dark"] .day-tab.active {
    background: #20254a;
    border-color: #818cf8;
}

body.dark-mode .day-tab-name,
[data-theme="dark"] .day-tab-name {
    color: #f1f5f9;
}

body.dark-mode .day-tab-status,
[data-theme="dark"] .day-tab-status {
    color: #8492a6;
}

/* Workspace */
body.dark-mode .day-workspace,
[data-theme="dark"] .day-workspace {
    background: #0f172a;
    border-color: #334155;
}

body.dark-mode .workspace-header,
[data-theme="dark"] .workspace-header {
    border-bottom-color: #273449;
}

body.dark-mode .workspace-title h3,
[data-theme="dark"] .workspace-title h3 {
    color: #f8fafc;
}

body.dark-mode .workspace-icon,
[data-theme="dark"] .workspace-icon {
    background: #252a52;
    color: #a5b4fc;
}

body.dark-mode .workspace-summary,
[data-theme="dark"] .workspace-summary {
    background: #1e293b;
    color: #a8b4c7;
}

/* Buttons */
body.dark-mode .select-all-sessions-btn,
[data-theme="dark"] .select-all-sessions-btn {
    background: #172033;
    border-color: #4c5790;
    color: #a5b4fc;
}

body.dark-mode .select-all-sessions-btn:hover,
[data-theme="dark"] .select-all-sessions-btn:hover {
    background: #23284a;
}

body.dark-mode .nav-btn-secondary,
[data-theme="dark"] .nav-btn-secondary {
    background: #172033;
    border-color: #334155;
    color: #cbd5e1;
}

/* Session cards */
body.dark-mode .session-card,
[data-theme="dark"] .session-card {
    background: #151d2e;
    border-color: #334155;
    box-shadow: 0 5px 18px rgba(0, 0, 0, .18);
}

body.dark-mode .session-card:hover,
[data-theme="dark"] .session-card:hover {
    border-color: #6366f1;
}

body.dark-mode .session-top,
[data-theme="dark"] .session-top {
    border-bottom-color: #283447;
}

body.dark-mode .session-title strong,
[data-theme="dark"] .session-title strong {
    color: #f8fafc;
}

body.dark-mode .session-time,
[data-theme="dark"] .session-time {
    color: #9aa8ba;
}

body.dark-mode .session-number,
[data-theme="dark"] .session-number {
    color: #a5b4fc;
}

/* Use session */
body.dark-mode .session-selector,
[data-theme="dark"] .session-selector {
    background: #1e293b;
    border-color: #334155;
}

body.dark-mode .session-selector span,
[data-theme="dark"] .session-selector span {
    color: #cbd5e1;
}

/* Session fields */
body.dark-mode .session-field label,
[data-theme="dark"] .session-field label {
    color: #cbd5e1;
}

body.dark-mode .session-field select,
body.dark-mode .session-type-select,
body.dark-mode .special-activity-input,
[data-theme="dark"] .session-field select,
[data-theme="dark"] .session-type-select,
[data-theme="dark"] .special-activity-input {
    background: #1e293b;
    border-color: #334155;
    color: #f8fafc;
}

/* Additional years */
body.dark-mode .year-pill span,
[data-theme="dark"] .year-pill span {
    background: #1e293b;
    border-color: #3b4860;
    color: #a8b4c7;
}

body.dark-mode .year-pill input:checked + span,
[data-theme="dark"] .year-pill input:checked + span {
    background: #27275a;
    border-color: #818cf8;
    color: #c4b5fd;
}

/* Copy session */
body.dark-mode .copy-session-toggle,
[data-theme="dark"] .copy-session-toggle {
    background: #211d35;
    border-color: #4b426e;
    color: #c4b5fd;
}

body.dark-mode .copy-session-panel,
[data-theme="dark"] .copy-session-panel {
    background: #171529;
    border-color: #4b426e;
}

body.dark-mode .copy-session-panel-header strong,
[data-theme="dark"] .copy-session-panel-header strong {
    color: #e2e8f0;
}

body.dark-mode .copy-session-panel-header span,
[data-theme="dark"] .copy-session-panel-header span {
    color: #8f9aab;
}

body.dark-mode .copy-session-target span,
[data-theme="dark"] .copy-session-target span {
    background: #1e293b;
    border-color: #334155;
    color: #a8b4c7;
}

/* Empty day */
body.dark-mode .day-empty-message,
[data-theme="dark"] .day-empty-message {
    background: #141c29;
    border-color: #475569;
}

body.dark-mode .empty-icon,
[data-theme="dark"] .empty-icon {
    background: #243044;
    color: #94a3b8;
}

body.dark-mode .day-empty-message strong,
[data-theme="dark"] .day-empty-message strong {
    color: #dbe4f0;
}

body.dark-mode .day-empty-message p,
[data-theme="dark"] .day-empty-message p,
body.dark-mode .workspace-bottom-hint,
[data-theme="dark"] .workspace-bottom-hint {
    color: #8796aa;
}

/* ============================================================
   LIVE REVIEW SIDEBAR
============================================================ */

body.dark-mode .weekly-review-sidebar,
[data-theme="dark"] .weekly-review-sidebar {
    background: #101b18;
    border-color: #315449;
    box-shadow: 0 8px 24px rgba(0, 0, 0, .20);
}

body.dark-mode .review-sidebar-header,
[data-theme="dark"] .review-sidebar-header {
    border-bottom-color: #29443b;
}

body.dark-mode .review-sidebar-header h3,
[data-theme="dark"] .review-sidebar-header h3 {
    color: #f8fafc;
}

body.dark-mode .review-day-card,
[data-theme="dark"] .review-day-card {
    background: #16201e;
    border-color: #33443f;
}

body.dark-mode .review-day-card.active-review,
[data-theme="dark"] .review-day-card.active-review {
    background: #172a24;
    border-color: #3b705d;
}

body.dark-mode .review-day-name,
[data-theme="dark"] .review-day-name {
    color: #f1f5f9;
}

body.dark-mode .review-day-details,
[data-theme="dark"] .review-day-details {
    color: #9aa8a2;
}

body.dark-mode .review-day-details strong,
[data-theme="dark"] .review-day-details strong {
    color: #dbe7e1;
}

body.dark-mode .review-status.empty,
[data-theme="dark"] .review-status.empty {
    background: #25302e;
    color: #a3b2ad;
}

body.dark-mode .review-total,
[data-theme="dark"] .review-total {
    background: #102d20;
}

body.dark-mode .review-total span,
[data-theme="dark"] .review-total span {
    color: #9eb5a9;
}

body.dark-mode .review-sidebar-note,
[data-theme="dark"] .review-sidebar-note {
    color: #94a6a0;
}

/* ============================================================
   APPROVAL
============================================================ */

body.dark-mode .approval-card,
[data-theme="dark"] .approval-card {
    background: #151d2e;
    border-color: #334155;
}

body.dark-mode .approval-card-single,
[data-theme="dark"] .approval-card-single {
    background: #211c16;
    border-color: #7c542b;
}

body.dark-mode .approval-card-icon,
[data-theme="dark"] .approval-card-icon {
    background: #2a2118;
    color: #fb923c;
}

body.dark-mode .approval-role,
[data-theme="dark"] .approval-role {
    color: #94a3b8;
}

body.dark-mode .approval-name,
[data-theme="dark"] .approval-name {
    color: #f1f5f9;
}

body.dark-mode .approval-signature-line,
[data-theme="dark"] .approval-signature-line {
    border-bottom-color: #475569;
}

body.dark-mode .approval-signature-line span,
[data-theme="dark"] .approval-signature-line span {
    color: #7f8ea3;
}

/* ============================================================
   FINAL BUTTONS
============================================================ */

body.dark-mode .final-actions,
[data-theme="dark"] .final-actions {
    border-top-color: #2b3749;
}

body.dark-mode .cancel-action,
[data-theme="dark"] .cancel-action {
    background: #172033;
    border-color: #334155;
    color: #cbd5e1;
}
/* Keep the sidebar compact vertically while increasing readability. */
@media (min-width: 1101px) {
    .weekly-section .weekly-review-sidebar {
        top: 20px;
    }
}

/* ============================================================
   LIVE REVIEW — PREVENT HORIZONTAL OVERFLOW
   Fixes review cards becoming wider than the sidebar.
============================================================ */

.weekly-review-sidebar {
    min-width: 0;
    width: 100%;
    max-width: 100%;
    box-sizing: border-box;
}

.review-sidebar-header,
.weekly-review-grid,
.review-day-card,
.review-day-top,
.review-day-details {
    min-width: 0;
    max-width: 100%;
    box-sizing: border-box;
}

.review-day-card {
    width: 100%;
    overflow: hidden;
}

.review-day-top {
    width: 100%;
}

.review-day-name,
.review-status {
    min-width: 0;
}

.review-day-name {
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
}

.review-status {
    flex: 0 0 auto;
    max-width: 55%;
    white-space: nowrap;
}

.review-day-details {
    width: 100%;
    overflow: hidden;
}

.review-day-details div {
    min-width: 0;
    max-width: 100%;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
}

/* On narrower screens, keep the review panel comfortably inside
   the section instead of allowing its content to push outward. */
@media (max-width: 1100px) {
    .weekly-review-sidebar {
        width: 100%;
        max-width: 100%;
        margin-top: 0;
    }

    .weekly-review-grid {
        width: 100%;
    }
}

@media (max-width: 760px) {
    .weekly-review-sidebar {
        padding: 14px;
    }

    .review-day-top {
        align-items: flex-start;
    }

    .review-status {
        max-width: 50%;
    }
}

</style>



<script>
document.addEventListener('DOMContentLoaded', function () {
    'use strict';

    const form = document.getElementById('scheduleCreateForm');

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
     *          teaching_mode: 'offline',
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

    function syncSelectAllSessionsButton(day) {
        if (!selectAllSessionsBtn) {
            return;
        }

        const totalSessions = Math.min(timeSlots.length, 4);

        if (totalSessions === 0) {
            selectAllSessionsBtn.disabled = true;
            selectAllSessionsBtn.setAttribute('aria-pressed', 'false');
            selectAllSessionsBtn.innerHTML =
                "<i class='bx bx-check-square'></i><span>Select all sessions</span>";
            return;
        }

        const state = getDayState(day);
        const selectedCount = Array.from({ length: totalSessions })
            .filter(function (_, index) {
                return Boolean(state[index]?.enabled);
            })
            .length;

        const allSelected = selectedCount === totalSessions;

        selectAllSessionsBtn.disabled = false;
        selectAllSessionsBtn.setAttribute(
            'aria-pressed',
            allSelected ? 'true' : 'false'
        );

        if (allSelected) {
            selectAllSessionsBtn.innerHTML =
                "<i class='bx bx-x-square'></i><span>Deselect all sessions</span>";
        } else {
            selectAllSessionsBtn.innerHTML =
                "<i class='bx bx-check-square'></i><span>Select all sessions</span>";
        }
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
                teaching_mode: 'offline',
                combined_years: [],
                special_note: ''
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
                ? 'Done! <i class="bx bx-check"></i>'
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

        bindSessionEvents(day);
        syncSelectAllSessionsButton(day);

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
                        <input
                            type="checkbox"
                            value="${targetIndex}"
                            class="copy-session-target-checkbox"
                        >
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

            <div
                class="copy-session-panel"
                data-copy-session-panel
                hidden
            >
                <div class="copy-session-panel-header">
                    <div>
                        <strong>Copy Session ${index + 1} setup</strong>
                        <span>
                            Choose the other sessions that should use the same
                            activity, course, professor, classroom and
                            additional years.
                        </span>
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

                            ${
                                slot.end_time
                                    ? ' – ' + escapeHtml(
                                        formatTime(slot.end_time)
                                    )
                                    : ''
                            }
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
                                    ${
                                        activityType === 'course'
                                            ? 'selected'
                                            : ''
                                    }
                                >
                                    Course
                                </option>

                                <option
                                    value="chapel"
                                    ${
                                        activityType === 'chapel'
                                            ? 'selected'
                                            : ''
                                    }
                                >
                                    Chapel
                                </option>

                               

                            </select>

                        </div>

                        <div class="session-field">

                            <label>Main Year</label>

                            <select disabled>
                                <option>
                                    Year ${
                                        escapeHtml(
                                            document.getElementById('main_year')?.value || 1
                                        )
                                    }
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

                            <label>Combine Years</label>

                            <div class="combined-years">
                                ${getCombinedYearOptions(session)}
                            </div>

                        </div>

                        <div class="session-field">

                            <label>Teaching Mode</label>

                            <select class="session-teaching-mode-select">
                                <option
                                    value="offline"
                                    ${
                                        (session.teaching_mode || 'offline') === 'offline'
                                            ? 'selected'
                                            : ''
                                    }
                                >
                                    Offline
                                </option>

                                <option
                                    value="online"
                                    ${
                                        session.teaching_mode === 'online'
                                            ? 'selected'
                                            : ''
                                    }
                                >
                                    Online
                                </option>
                            </select>

                        </div>

                    </div>

                    <div
                        class="special-activity"
                        style="${isSpecial ? '' : 'display:none;'}"
                    >

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

            const teachingModeSelect =
                card.querySelector(
                    '.session-teaching-mode-select'
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

                    syncEmptyDayMessage(day);
                    updateDayStatusUI();
                 

                    checkSessionConflict(
                        day,
                        index,
                        card
                    );
                }
            );

            activitySelect.addEventListener(
                'change',
                function () {

                    session.activity_type =
                        activitySelect.value;

                    /*
                     * A special activity does not use course data.
                     * Clear course-related values when switching away
                     * from Course.
                     */
                    if (session.activity_type !== 'course') {
                        session.course_id = '';
                        session.professor_id = '';
                        session.room_id = '';
                        session.combined_years = [];
                    }

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

                    syncEmptyDayMessage(day);
                    updateDayStatusUI();
            

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

            if (teachingModeSelect) {
                teachingModeSelect.addEventListener(
                    'change',
                    function () {

                        session.teaching_mode =
                            teachingModeSelect.value ||
                            'offline';

                        getDayState(day)[index] =
                            session;


                    }
                );
            }

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

                        session.combined_years =
                            years;

                        getDayState(day)[index] =
                            session;

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

                        getDayState(day)[index] =
                            session;
                    }
                );
            }

            syncActivityUI(
                card,
                session.activity_type
            );

            const copyToggle =
                card.querySelector(
                    '[data-copy-session-toggle]'
                );

            const copyPanel =
                card.querySelector(
                    '[data-copy-session-panel]'
                );

            const copyApply =
                card.querySelector(
                    '[data-copy-session-apply]'
                );

            if (copyToggle && copyPanel) {

                copyToggle.addEventListener(
                    'click',
                    function () {

                        const isOpen =
                            !copyPanel.hasAttribute(
                                'hidden'
                            );

                        if (isOpen) {

                            copyPanel.setAttribute(
                                'hidden',
                                ''
                            );

                            copyToggle.setAttribute(
                                'aria-expanded',
                                'false'
                            );

                        } else {

                            copyPanel.removeAttribute(
                                'hidden'
                            );

                            copyToggle.setAttribute(
                                'aria-expanded',
                                'true'
                            );
                        }
                    }
                );
            }

            if (copyApply) {

                copyApply.addEventListener(
                    'click',
                    function () {

                        saveCurrentVisibleSessionValues();

                        const source =
                            getDayState(day)[index];

                        if (!source || !source.enabled) {
                            alert(
                                'Please enable Session ' +
                                (index + 1) +
                                ' before copying it.'
                            );

                            return;
                        }

                        if (
                            source.activity_type === 'course' &&
                            (
                                !source.course_id ||
                                !source.professor_id ||
                                !source.room_id
                            )
                        ) {
                            alert(
                                'Please complete Session ' +
                                (index + 1) +
                                ' Course, Professor and Classroom before copying.'
                            );

                            return;
                        }

                        const targetChecks =
                            Array.from(
                                copyPanel.querySelectorAll(
                                    '.copy-session-target-checkbox:checked'
                                )
                            );

                        if (!targetChecks.length) {
                            alert(
                                'Please select at least one session to copy to.'
                            );

                            return;
                        }

                        targetChecks.forEach(
                            function (checkbox) {

                                const targetIndex =
                                    parseInt(
                                        checkbox.value,
                                        10
                                    );

                                const target =
                                    ensureSession(
                                        day,
                                        targetIndex
                                    );

                                target.enabled = true;

                                target.activity_type =
                                    source.activity_type ||
                                    'course';

                                target.course_id =
                                    source.course_id ||
                                    '';

                                target.professor_id =
                                    source.professor_id ||
                                    '';

                                target.room_id =
                                    source.room_id ||
                                    '';

                                target.teaching_mode =
                                    source.teaching_mode ||
                                    'offline';

                                target.combined_years =
                                    cloneYears(
                                        source.combined_years ||
                                        []
                                    );

                                target.special_note =
                                    source.special_note ||
                                    '';

                                getDayState(day)[targetIndex] =
                                    target;
                            }
                        );

                        renderSessionCards(day);

                        checkAllConflicts();
                    }
                );
            }
        });
    }

    function syncActivityUI(
        card,
        activityType
    ) {

        const isCourse =
            activityType === 'course';

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
                isCourse
                    ? ''
                    : 'none';
        }

        if (specialArea) {
            specialArea.style.display =
                isCourse
                    ? 'none'
                    : '';
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

        syncSelectAllSessionsButton(day);
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

                tab.classList.add(
                    'completed'
                );

                status.textContent =
                    count +
                    ' session' +
                    (
                        count === 1
                            ? ''
                            : 's'
                    ) +
                    ' configured';

            } else {

                tab.classList.remove(
                    'completed'
                );

                status.textContent =
                    'Not configured';
            }
        });
    }

    /* ============================================================
       SELECT ALL SESSIONS
    ============================================================ */

    if (selectAllSessionsBtn) {
        selectAllSessionsBtn.addEventListener(
            'click',
            function () {
                const day = days[currentDayIndex];

                if (!day) {
                    return;
                }

                saveCurrentVisibleSessionValues();

                const state = getDayState(day);
                const totalSessions = Math.min(timeSlots.length, 4);

                if (totalSessions === 0) {
                    return;
                }

                const allSelected = Array.from({ length: totalSessions })
                    .every(function (_, index) {
                        return Boolean(state[index]?.enabled);
                    });

                for (let index = 0; index < totalSessions; index++) {
                    const session = ensureSession(day, index);
                    session.enabled = !allSelected;
                    state[index] = session;
                }

                renderSessionCards(day);
                updateDayStatusUI();
                checkAllConflicts();
            }
        );
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

                currentDayIndex =
                    index;

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

            if (
                currentDayIndex <
                days.length - 1
            ) {

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
            .querySelectorAll(
                '.session-card'
            )
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

                const teachingModeSelect =
                    card.querySelector(
                        '.session-teaching-mode-select'
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

                    enabled:
                        checkbox
                            ? checkbox.checked
                            : false,

                    slot_id:
                        String(slot.id),

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

                    teaching_mode:
                        teachingModeSelect
                            ? (teachingModeSelect.value || 'offline')
                            : 'offline',

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

        const message =
            card?.querySelector(
                '.session-conflict'
            );

        return message || null;
    }

    function getCurrentSessionData(
        day,
        index,
        card
    ) {

        const state =
            getDayState(day)[index];

        if (!state) {
            return null;
        }

        return {

            day: day,

            index: index,

            state: state,

            card: card,

            course_id:
                state.course_id || '',

            professor_id:
                state.professor_id || '',

            room_id:
                state.room_id || '',

            slot_id:
                String(
                    state.slot_id || ''
                ),

            years: [
                document.getElementById(
                    'main_year'
                )?.value || '',

                ...(state.combined_years || [])

            ].filter(Boolean)
                .map(String)
        };
    }

    function getLocalConflicts(
        day,
        index
    ) {

        const currentState =
            getDayState(day)[index];

        if (
            !currentState ||
            !currentState.enabled
        ) {
            return [];
        }

        if (
            currentState.activity_type !==
            'course'
        ) {
            return [];
        }

        const current =
            getCurrentSessionData(
                day,
                index,
                document.querySelector(
                    '.session-card[data-session-index="' +
                    index +
                    '"]'
                )
            );

        if (!current) {
            return [];
        }

        const conflicts = [];

        const dayState =
            getDayState(day);

        Object.keys(dayState)
            .forEach(function (otherIndex) {

                if (
                    String(otherIndex) ===
                    String(index)
                ) {
                    return;
                }

                const otherState =
                    dayState[otherIndex];

                if (
                    !otherState ||
                    !otherState.enabled ||
                    otherState.activity_type !==
                    'course'
                ) {
                    return;
                }

                const other =
                    getCurrentSessionData(
                        day,
                        otherIndex,
                        document.querySelector(
                            '.session-card[data-session-index="' +
                            otherIndex +
                            '"]'
                        )
                    );

                if (
                    !other ||
                    other.slot_id !==
                    current.slot_id
                ) {
                    return;
                }

                if (
                    current.professor_id &&
                    other.professor_id &&
                    current.professor_id ===
                    other.professor_id
                ) {
                    conflicts.push(
                        'This professor is already selected in another session at this time.'
                    );
                }

                if (
                    current.room_id &&
                    other.room_id &&
                    current.room_id ===
                    other.room_id
                ) {
                    conflicts.push(
                        'This classroom is already selected in another session at this time.'
                    );
                }

                const sameYear =
                    current.years.some(
                        function (year) {
                            return other.years.includes(
                                String(year)
                            );
                        }
                    );

                if (sameYear) {
                    conflicts.push(
                        'One or more selected year levels are already selected in another session at this time.'
                    );
                }
            });

        return [
            ...new Set(conflicts)
        ];
    }

    async function checkSessionConflict(
        day,
        index,
        card
    ) {

        if (!card) {
            return true;
        }

        const state =
            getDayState(day)[index];

        if (
            !state ||
            !state.enabled
        ) {

            clearSessionConflict(card);

            return true;
        }

        if (
            state.activity_type !==
            'course'
        ) {

            clearSessionConflict(card);

            return true;
        }

        const localConflicts =
            getLocalConflicts(
                day,
                index
            );

        if (
            localConflicts.length
        ) {

            showSessionConflict(
                card,
                '⚠ Schedule conflict: ' +
                localConflicts.join(' ')
            );

            return false;
        }

        const semester =
            document.getElementById(
                'semester'
            )?.value || '';

        const year =
            document.getElementById(
                'main_year'
            )?.value || '';

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

            const params =
                new URLSearchParams({

                    professor_id:
                        state.professor_id ||
                        '',

                    room_id:
                        state.room_id ||
                        '',

                    slot_id:
                        slotId,

                    day_of_week:
                        day,

                    semester:
                        semester,

                    year_levels:
                        JSON.stringify(years)
                });

            const response =
                await fetch(
                    "{{ route('hod.schedules.checkConflict') }}" +
                    "?" +
                    params.toString(),
                    {
                        method: 'GET',

                        headers: {
                            'Accept':
                                'application/json'
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

            if (
                requestId !==
                conflictCounter
            ) {
                return true;
            }

            const conflicts = [];

            if (
                data.professor_conflict
            ) {

                conflicts.push(
                    'This professor already has a schedule at this time.'
                );
            }

            if (
                data.classroom_conflict
            ) {

                conflicts.push(
                    'This classroom is already occupied at this time.'
                );
            }

            if (
                data.year_conflict ||
                data.time_slot_conflict
            ) {

                conflicts.push(
                    'One or more selected year levels already have a schedule at this time.'
                );
            }

            if (
                conflicts.length
            ) {

                showSessionConflict(
                    card,
                    '⚠ Schedule conflict: ' +
                    conflicts.join(' ')
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
                document.querySelectorAll(
                    '.session-card'
                )
            );

        let hasConflict =
            false;

        for (
            const card of cards
        ) {

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

        /*
         * Do NOT disable the Save button just because
         * every session is empty. An empty day/week is valid
         * as long as there is at least one configured session
         * somewhere in the weekly schedule.
         */
        if (saveWeeklyScheduleBtn) {

            saveWeeklyScheduleBtn.disabled =
                hasConflict;
        }

        return !hasConflict;
    }

    function showSessionConflict(
        card,
        message
    ) {

        card.classList.add(
            'has-conflict'
        );

        const box =
            card.querySelector(
                '.session-conflict'
            );

        if (box) {
            box.textContent =
                message;
        }
    }

    function clearSessionConflict(card) {

        card.classList.remove(
            'has-conflict'
        );

        const box =
            card.querySelector(
                '.session-conflict'
            );

        if (box) {
            box.textContent = '';
        }
    }


    function hasAnyConfiguredSessions() {

        return days.some(
            function (day) {
                return configuredSessionCount(day) > 0;
            }
        );
    }

    /* ============================================================
       BUILD FINAL SERVER INPUTS
    ============================================================ */

    function buildHiddenInputs() {

        scheduleHiddenInputs.innerHTML = '';

        days.forEach(function (day) {

            const state =
                getDayState(day);

            Object.keys(state)
                .sort(
                    function (a, b) {
                        return Number(a) -
                            Number(b);
                    }
                )
                .forEach(
                    function (index) {

                        const session =
                            state[index];

                        /*
                         * IMPORTANT:
                         * Disabled sessions are not submitted.
                         * This is what allows an entire day to be empty.
                         */
                        if (
                            !session ||
                            !session.enabled
                        ) {
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
                            session.activity_type ||
                            'course'
                        );

                        /*
                         * Special activity note
                         */
                        appendHidden(
                            `days[${day}][${index}][special_note]`,
                            session.special_note ||
                            ''
                        );

                        /*
                         * Course fields
                         *
                         * For Chapel/Break/Free/Other
                         * these will be empty.
                         */
                        appendHidden(
                            `days[${day}][${index}][course_id]`,
                            session.course_id ||
                            ''
                        );

                        appendHidden(
                            `days[${day}][${index}][professor_id]`,
                            session.professor_id ||
                            ''
                        );

                        appendHidden(
                            `days[${day}][${index}][room_id]`,
                            session.room_id ||
                            ''
                        );

                        /*
                         * Teaching mode only applies to course sessions.
                         */
                        if (
                            session.activity_type ===
                            'course'
                        ) {
                            appendHidden(
                                `days[${day}][${index}][teaching_mode]`,
                                session.teaching_mode ||
                                'offline'
                            );
                        }

                        /*
                         * Additional years only apply to courses.
                         */
                        if (
                            session.activity_type ===
                            'course'
                        ) {

                            (
                                session.combined_years ||
                                []
                            ).forEach(
                                function (year) {

                                    appendHidden(
                                        `days[${day}][${index}][combined_years][]`,
                                        year
                                    );
                                }
                            );
                        }
                    }
                );
        });
    }

    function appendHidden(
        name,
        value
    ) {

        const input =
            document.createElement(
                'input'
            );

        input.type =
            'hidden';

        input.name =
            name;

        input.value =
            value ?? '';

        scheduleHiddenInputs.appendChild(
            input
        );
    }

    /* ============================================================
       MAIN YEAR CHANGE
    ============================================================ */

    const mainYear =
        document.getElementById(
            'main_year'
        );

    /*
     * Keep the original approval logic:
     * - Main Year 1 → Foundation Year Department approval
     * - Main Years 2, 3, 4 → Academic Office + Department Head approval
     */
    function updateApprovalSection() {

        const approvalYear1 =
            document.getElementById(
                'approval-year-1'
            );

        const approvalYear234 =
            document.getElementById(
                'approval-year-234'
            );

        if (
            !mainYear ||
            !approvalYear1 ||
            !approvalYear234
        ) {
            return;
        }

        if (
            String(mainYear.value) ===
            '1'
        ) {

            approvalYear1.style.display =
                'block';

            approvalYear234.style.display =
                'none';

        } else {

            approvalYear1.style.display =
                'none';

            approvalYear234.style.display =
                'grid';
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

            if (
                !hasAnyConfiguredSessions()
            ) {


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

                        /*
                         * Disabled sessions and special
                         * activities do not require course data.
                         */
                        if (
                            !session ||
                            !session.enabled ||
                            session.activity_type !==
                            'course'
                        ) {
                            return;
                        }

                        if (
                            !session.course_id ||
                            !session.professor_id ||
                            !session.room_id
                        ) {

                            missingCourseData.push(
                                day +
                                ' — Session ' +
                                (
                                    Number(index) +
                                    1
                                )
                            );
                        }
                    });
            });

            if (
                missingCourseData.length
            ) {

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

            saveWeeklyScheduleBtn.disabled =
                true;

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
                document.getElementById(
                    'midterm_exam_start'
                );

            const midtermEnd =
                document.getElementById(
                    'midterm_exam_end'
                );

            const finalStart =
                document.getElementById(
                    'final_exam_start'
                );

            const finalEnd =
                document.getElementById(
                    'final_exam_end'
                );

            if (
                midtermStart &&
                midtermEnd
            ) {

                midtermEnd.value =
                    getExamEndDate(
                        midtermStart.value
                    );
            }

            if (
                finalStart &&
                finalEnd
            ) {

                finalEnd.value =
                    getExamEndDate(
                        finalStart.value
                    );
            }

            HTMLFormElement.prototype.submit.call(
                form
            );
        }
    );

    /* ============================================================
       LOAD OLD INPUT AFTER VALIDATION ERROR
    ============================================================ */

    function loadOldSchedule() {

        if (
            !oldSchedule ||
            typeof oldSchedule !==
            'object'
        ) {
            return;
        }

        days.forEach(function (day) {

            if (
                !oldSchedule[day] ||
                typeof oldSchedule[day] !==
                'object'
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

                    /*
                     * Existing old input is real schedule data,
                     * so it must remain enabled.
                     */
                    enabled: true,

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

                    teaching_mode:
                        oldSession.teaching_mode ||
                        'offline',

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

    function getExamEndDate(
        startDate
    ) {

        if (!startDate) {
            return '';
        }

        const date =
            new Date(
                startDate +
                'T00:00:00'
            );

        if (
            Number.isNaN(
                date.getTime()
            )
        ) {
            return '';
        }

        /* Exam period = start date + 4 weekdays (5 weekdays total). */
        let weekdaysAdded = 0;

        while (
            weekdaysAdded < 4
        ) {

            date.setDate(
                date.getDate() + 1
            );

            const dayNumber =
                date.getDay();

            if (
                dayNumber !== 0 &&
                dayNumber !== 6
            ) {
                weekdaysAdded++;
            }
        }

        return date
            .toISOString()
            .split('T')[0];
    }

    function setupExamDateRange(
        startId,
        endId,
        rangeId
    ) {

        const startInput =
            document.getElementById(
                startId
            );

        const endInput =
            document.getElementById(
                endId
            );

        const rangeText =
            document.getElementById(
                rangeId
            );

        if (
            !startInput ||
            !endInput
        ) {
            return;
        }

        function syncExamEndDate() {

            if (!startInput.value) {

                endInput.value = '';

                if (rangeText) {
                    rangeText.textContent =
                        '';
                }

                return;
            }

            const start =
                new Date(
                    startInput.value +
                    'T00:00:00'
                );

            if (
                Number.isNaN(
                    start.getTime()
                )
            ) {

                endInput.value = '';

                return;
            }

            const dayNumber =
                start.getDay();

            if (
                dayNumber === 0 ||
                dayNumber === 6
            ) {

                endInput.value = '';

                if (rangeText) {

                    rangeText.textContent =
                        '⚠ Please select a weekday.';
                }

                return;
            }

            const endDate =
                getExamEndDate(
                    startInput.value
                );

            endInput.value =
                endDate;

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
     * Default behavior:
     *
     * Every new session is shown but NOT selected.
     * The HOD enables only the sessions that are actually needed.
     *
     * This means:
     * Monday    → 4 sessions
     * Tuesday   → 2 sessions
     * Wednesday → 0 sessions
     * Thursday  → 3 sessions
     * Friday    → 1 session
     *
     * A completely empty day is valid.
     *
     * If old() data exists, that data is already loaded
     * into scheduleState and remains enabled.
     */
    renderCurrentDay();

    updateDayStatusUI();


    setTimeout(
        function () {
            checkAllConflicts();
        },
        100
    );
});
</script>

@endsection
