@extends('layouts.hod_layout')

@section('title', 'Edit Course')

@section('content')
<div class="hod-course-create-page">

    {{-- ============================================================
        PAGE HEADER
    ============================================================ --}}
    <div class="course-create-header">

        <div class="course-create-heading">
            <a
                href="{{ route('hod.courses.index') }}"
                class="back-link"
            >
                <i class='bx bx-left-arrow-alt'></i>
                Back to Courses
            </a>

            <div class="course-create-title-row">
                <div class="course-create-icon">
                    <i class='bx bx-edit-alt'></i>
                </div>

                <div>
                    <span class="create-eyebrow">
                        HoD • Academic Management
                    </span>

                    <h1>Edit Course</h1>

                    <p>
                        Update the information for
                        <strong>{{ $course->course_name }}</strong>.
                    </p>

                    <div class="editing-course-badge">
                        <i class='bx bx-edit'></i>
                        Editing {{ $course->course_code }}
                    </div>
                </div>
            </div>
        </div>

    </div>


    {{-- ============================================================
        VALIDATION ERRORS
    ============================================================ --}}
    @if ($errors->any())

        <div class="course-form-alert">
            <div class="alert-icon">
                <i class='bx bx-error-circle'></i>
            </div>

            <div>
                <strong>Please check the form.</strong>

                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>

    @endif


    {{-- ============================================================
        FORM
    ============================================================ --}}
    <form
        method="POST"
        action="{{ route('hod.courses.update', $course) }}"
        class="course-create-form"
    >

        @csrf
        @method('PUT')


        {{-- ========================================================
            COURSE INFORMATION
        ========================================================= --}}
        <section class="course-form-card">

            <div class="form-card-heading">

                <div class="form-section-icon blue">
                    <i class='bx bx-book-open'></i>
                </div>

                <div>
                    <span class="section-kicker">Course Details</span>

                    <h2>Course Information</h2>

                    <p>
                        Enter the basic academic information for this course.
                    </p>
                </div>

            </div>


            <div class="form-fields-grid">

                {{-- Course Code --}}
                <div class="field-group">

                    <label for="course_code">
                        Course Code
                        <span>*</span>
                    </label>

                    <div class="field-shell">

                        <i class='bx bx-hash field-icon'></i>

                        <input
                            type="text"
                            name="course_code"
                            id="course_code"
                            value="{{ old('course_code', $course->course_code) }}"
                            placeholder="e.g. CS101"
                            maxlength="50"
                            required
                            autocomplete="off"
                        >

                    </div>

                    <small>
                        Use the official code assigned to the course.
                    </small>

                    @error('course_code')
                        <span class="field-error">
                            {{ $message }}
                        </span>
                    @enderror

                </div>


                {{-- Course Name --}}
                <div class="field-group">

                    <label for="course_name">
                        Course Name
                        <span>*</span>
                    </label>

                    <div class="field-shell">

                        <i class='bx bx-book field-icon'></i>

                        <input
                            type="text"
                            name="course_name"
                            id="course_name"
                            value="{{ old('course_name', $course->course_name) }}"
                            placeholder="e.g. Database Management"
                            maxlength="255"
                            required
                        >

                    </div>

                    <small>
                        Enter the full official course name.
                    </small>

                    @error('course_name')
                        <span class="field-error">
                            {{ $message }}
                        </span>
                    @enderror

                </div>


                {{-- Department --}}
                <div class="field-group field-full">

                    <label for="department_display">
                        Department
                    </label>

                    <div class="readonly-department">

                        <div class="readonly-department-icon">
                            <i class='bx bx-building-house'></i>
                        </div>

                        <div>
                            <span class="readonly-label">
                                Assigned Department
                            </span>

                            <strong id="department_display">
                                {{ $department->department_name }}
                            </strong>
                        </div>

                        <span class="department-lock">
                            <i class='bx bx-lock-alt'></i>
                            Automatic
                        </span>

                    </div>

                    <small>
                        The course is automatically assigned to your department.
                    </small>

                </div>


                {{-- Credits --}}
                <div class="field-group">

                    <label for="credits">
                        Credits
                    </label>

                    <div class="field-shell">

                        <i class='bx bx-award field-icon'></i>

                        <input
                            type="number"
                            name="credits"
                            id="credits"
                            value="{{ old('credits', $course->credits) }}"
                            placeholder="e.g. 3"
                            min="0"
                            max="20"
                            step="1"
                        >

                    </div>

                    <small>
                        Optional. Enter the number of academic credits.
                    </small>

                    @error('credits')
                        <span class="field-error">
                            {{ $message }}
                        </span>
                    @enderror

                </div>

            </div>

        </section>


        {{-- ========================================================
            DESCRIPTION
        ========================================================= --}}
        <section class="course-form-card description-card">

            <div class="form-card-heading">

                <div class="form-section-icon yellow">
                    <i class='bx bx-detail'></i>
                </div>

                <div>
                    <span class="section-kicker">Course Overview</span>

                    <h2>Description</h2>

                    <p>
                        Add a short description that explains what the course covers.
                    </p>
                </div>

            </div>


            <div class="field-group">

                <label for="description">
                    Course Description
                    <span>*</span>
                </label>

                <div class="textarea-shell">

                    <textarea
                        name="description"
                        id="description"
                        rows="7"
                        placeholder="Describe the course content, learning focus, or other useful information..."
                        required
                    >{{ old('description', $course->description) }}</textarea>

                    <div class="textarea-footer">
                        <span>
                            Keep the description clear and useful for academic records.
                        </span>

                        <span id="descriptionCount">
                            0 / 2000
                        </span>
                    </div>

                </div>

                @error('description')
                    <span class="field-error">
                        {{ $message }}
                    </span>
                @enderror

            </div>

        </section>


        {{-- ========================================================
            SUMMARY
        ========================================================= --}}
        <section class="course-summary-card">

            <div class="summary-icon">
                <i class='bx bx-check-shield'></i>
            </div>

            <div class="summary-copy">

                <span class="section-kicker">
                    Before You Save
                </span>

                <h2>Updated Course Summary</h2>

                <p>
                    Review the changes below. Saving will update this course for your department.
                </p>

                <div class="summary-preview">

                    <div class="summary-item">
                        <span>Code</span>
                        <strong id="summaryCode">
                            {{ old('course_code', $course->course_code) ?: 'Not entered' }}
                        </strong>
                    </div>

                    <div class="summary-divider"></div>

                    <div class="summary-item">
                        <span>Name</span>
                        <strong id="summaryName">
                            {{ old('course_name', $course->course_name) ?: 'Not entered' }}
                        </strong>
                    </div>

                    <div class="summary-divider"></div>

                    <div class="summary-item">
                        <span>Credits</span>
                        <strong id="summaryCredits">
                            {{ old('credits', $course->credits) ?: '—' }}
                        </strong>
                    </div>

                </div>

            </div>

        </section>


        {{-- ========================================================
            ACTIONS
        ========================================================= --}}
        <div class="course-form-actions">

            <a
                href="{{ route('hod.courses.index') }}"
                class="course-cancel-btn"
            >
                <i class='bx bx-x'></i>
                Cancel
            </a>

            <button
                type="submit"
                class="course-submit-btn"
                id="updateCourseBtn"
            >
                <i class='bx bx-save'></i>
                <span>Save Changes</span>
            </button>

        </div>

    </form>

</div>


<style>
    /* ============================================================
       PAGE
    ============================================================ */

    .hod-course-create-page {
        width: min(1000px, calc(100% - 40px));
        margin: 0 auto;
        padding: 30px 0 65px;
        color: #172033;
    }

    /* ============================================================
       HEADER
    ============================================================ */

    .course-create-header {
        margin-bottom: 24px;
        animation: courseCreateFadeUp .5s ease both;
    }

    .back-link {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        margin-bottom: 18px;
        color: #64748b;
        text-decoration: none;
        font-size: 11px;
        font-weight: 800;
        transition: color .18s ease, transform .18s ease;
    }

    .back-link:hover {
        color: #4f46e5;
        transform: translateX(-2px);
    }

    .back-link i {
        font-size: 16px;
    }

    .course-create-title-row {
        display: flex;
        align-items: center;
        gap: 16px;
    }

    .course-create-icon {
        width: 60px;
        height: 60px;
        flex: 0 0 auto;
        display: grid;
        place-items: center;
        border-radius: 19px;
        background: linear-gradient(135deg, #dbeafe, #ede9fe);
        color: #4f46e5;
        font-size: 28px;
        box-shadow: 0 13px 29px rgba(79, 70, 229, .11);
        animation: courseCreateFloat 3.5s ease-in-out infinite;
    }

    .create-eyebrow {
        display: block;
        margin-bottom: 5px;
        color: #6366f1;
        font-size: 11px;
        font-weight: 900;
        letter-spacing: .1em;
        text-transform: uppercase;
    }

    .course-create-title-row h1 {
        margin: 0;
        color: #111827;
        font-size: clamp(29px, 4vw, 38px);
        line-height: 1.05;
        letter-spacing: -.035em;
        font-weight: 850;
    }

    .course-create-title-row p {
        margin: 8px 0 0;
        color: #64748b;
        font-size: 13px;
        line-height: 1.5;
    }

    .course-create-title-row p strong {
        color: #475569;
    }

    .editing-course-badge {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        margin-top: 9px;
        padding: 5px 9px;
        border-radius: 999px;
        background: #eef2ff;
        border: 1px solid #e0e7ff;
        color: #4f46e5;
        font-size: 9.5px;
        font-weight: 850;
    }

    .editing-course-badge i {
        font-size: 13px;
    }

    /* ============================================================
       ALERT
    ============================================================ */

    .course-form-alert {
        display: flex;
        align-items: flex-start;
        gap: 11px;
        margin-bottom: 20px;
        padding: 14px 16px;
        border: 1px solid #fecdd3;
        border-radius: 15px;
        background: #fff1f2;
        color: #9f1239;
        animation: courseCreateFadeUp .4s ease both;
    }

    .alert-icon {
        flex: 0 0 auto;
        font-size: 21px;
        line-height: 1;
    }

    .course-form-alert strong {
        display: block;
        margin-bottom: 4px;
        font-size: 12px;
    }

    .course-form-alert ul {
        margin: 0;
        padding-left: 18px;
        font-size: 11px;
        line-height: 1.7;
    }

    /* ============================================================
       FORM CARDS
    ============================================================ */

    .course-form-card {
        margin-bottom: 20px;
        padding: 25px;
        border: 1px solid #e7ebf2;
        border-radius: 22px;
        background: #ffffff;
        box-shadow: 0 12px 34px rgba(15, 23, 42, .048);
        animation: courseCreateFadeUp .6s ease both;
    }

    .course-form-card::before,
    .course-summary-card::before {
        content: "";
        display: block;
        width: 120px;
        height: 3px;
        margin: -25px 0 21px -25px;
        border-radius: 0 0 999px 0;
        background: linear-gradient(90deg, #6366f1, #c4b5fd);
    }

    .description-card::before {
        background: linear-gradient(90deg, #f59e0b, #fde68a);
    }

    .form-card-heading {
        display: flex;
        align-items: flex-start;
        gap: 12px;
        margin-bottom: 21px;
    }

    .form-section-icon {
        width: 42px;
        height: 42px;
        flex: 0 0 auto;
        display: grid;
        place-items: center;
        border-radius: 13px;
        font-size: 19px;
    }

    .form-section-icon.blue {
        background: #dbeafe;
        color: #2563eb;
    }

    .form-section-icon.yellow {
        background: #fef3c7;
        color: #d97706;
    }

    .section-kicker {
        display: block;
        margin-bottom: 4px;
        color: #a1aab8;
        font-size: 10px;
        font-weight: 900;
        letter-spacing: .1em;
        text-transform: uppercase;
    }

    .form-card-heading h2,
    .course-summary-card h2 {
        margin: 0;
        color: #1e293b;
        font-size: 20px;
        letter-spacing: -.025em;
        font-weight: 850;
    }

    .form-card-heading p {
        margin: 5px 0 0;
        color: #64748b;
        font-size: 12px;
        line-height: 1.55;
    }

    /* ============================================================
       FORM FIELDS
    ============================================================ */

    .form-fields-grid {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 18px;
    }

    .field-full {
        grid-column: 1 / -1;
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
        font-size: 12px;
        font-weight: 850;
    }

    .field-group label > span {
        color: #ef4444;
    }

    .field-group small {
        display: block;
        margin-top: 6px;
        color: #94a3b8;
        font-size: 10.5px;
        line-height: 1.5;
    }

    .field-error {
        display: block;
        margin-top: 6px;
        color: #e11d48;
        font-size: 10.5px;
        font-weight: 700;
    }

    .field-shell {
        position: relative;
    }

    .field-icon {
        position: absolute;
        top: 50%;
        left: 13px;
        transform: translateY(-50%);
        color: #94a3b8;
        font-size: 17px;
        pointer-events: none;
    }

    .field-shell input,
    .textarea-shell textarea {
        width: 100%;
        border: 1px solid #dbe2ea;
        border-radius: 13px;
        background: #ffffff;
        color: #172033;
        outline: none;
        font: inherit;
        transition:
            border-color .18s ease,
            box-shadow .18s ease,
            background .18s ease;
    }

    .field-shell input {
        min-height: 45px;
        padding: 10px 13px 10px 39px;
        font-size: 12px;
    }

    .field-shell input::placeholder,
    .textarea-shell textarea::placeholder {
        color: #a0aabd;
    }

    .field-shell input:hover,
    .textarea-shell textarea:hover {
        border-color: #cbd5e1;
    }

    .field-shell input:focus,
    .textarea-shell textarea:focus {
        border-color: #818cf8;
        background: #ffffff;
        box-shadow: 0 0 0 4px rgba(99, 102, 241, .08);
    }

    /* ============================================================
       READONLY DEPARTMENT
    ============================================================ */

    .readonly-department {
        display: flex;
        align-items: center;
        gap: 11px;
        min-height: 63px;
        padding: 10px 12px;
        border: 1px solid #e2e8f0;
        border-radius: 14px;
        background: #f8fafc;
    }

    .readonly-department-icon {
        width: 39px;
        height: 39px;
        flex: 0 0 auto;
        display: grid;
        place-items: center;
        border-radius: 12px;
        background: #ede9fe;
        color: #7c3aed;
        font-size: 18px;
    }

    .readonly-department > div:nth-child(2) {
        min-width: 0;
        flex: 1;
    }

    .readonly-label {
        display: block;
        margin-bottom: 2px;
        color: #94a3b8;
        font-size: 9px;
        font-weight: 850;
        letter-spacing: .07em;
        text-transform: uppercase;
    }

    .readonly-department strong {
        display: block;
        color: #334155;
        font-size: 12px;
        font-weight: 850;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .department-lock {
        display: inline-flex;
        align-items: center;
        gap: 4px;
        padding: 6px 8px;
        border-radius: 999px;
        background: #ffffff;
        border: 1px solid #e2e8f0;
        color: #94a3b8;
        font-size: 9px;
        font-weight: 800;
        white-space: nowrap;
    }

    .department-lock i {
        font-size: 12px;
    }

    /* ============================================================
       TEXTAREA
    ============================================================ */

    .textarea-shell {
        border: 1px solid #dbe2ea;
        border-radius: 14px;
        overflow: hidden;
        background: #ffffff;
        transition: border-color .18s ease, box-shadow .18s ease;
    }

    .textarea-shell:focus-within {
        border-color: #818cf8;
        box-shadow: 0 0 0 4px rgba(99, 102, 241, .08);
    }

    .textarea-shell textarea {
        display: block;
        min-height: 145px;
        padding: 13px 14px;
        border: 0;
        border-radius: 0;
        resize: vertical;
        line-height: 1.6;
        font-size: 12px;
    }

    .textarea-footer {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 15px;
        padding: 9px 12px;
        border-top: 1px solid #eef2f6;
        background: #fbfdff;
        color: #94a3b8;
        font-size: 9.5px;
    }

    /* ============================================================
       SUMMARY
    ============================================================ */

    .course-summary-card {
        position: relative;
        display: flex;
        align-items: flex-start;
        gap: 14px;
        margin-bottom: 20px;
        padding: 25px;
        border: 1px solid #dbeafe;
        border-radius: 22px;
        background: linear-gradient(135deg, #f8fbff, #fcfaff);
        box-shadow: 0 11px 31px rgba(59, 130, 246, .045);
        animation: courseCreateFadeUp .7s ease both;
        overflow: hidden;
    }

    .course-summary-card::before {
        background: linear-gradient(90deg, #10b981, #a7f3d0);
    }

    .summary-icon {
        width: 44px;
        height: 44px;
        flex: 0 0 auto;
        display: grid;
        place-items: center;
        border-radius: 13px;
        background: #d1fae5;
        color: #059669;
        font-size: 19px;
    }

    .summary-copy {
        min-width: 0;
        flex: 1;
    }

    .summary-copy p {
        margin: 6px 0 13px;
        color: #64748b;
        font-size: 11px;
        line-height: 1.55;
    }

    .summary-preview {
        display: grid;
        grid-template-columns: 1fr auto 2fr auto 1fr;
        align-items: center;
        gap: 13px;
        padding: 12px 13px;
        border: 1px solid #e2e8f0;
        border-radius: 14px;
        background: rgba(255, 255, 255, .8);
    }

    .summary-item {
        min-width: 0;
    }

    .summary-item span {
        display: block;
        margin-bottom: 3px;
        color: #94a3b8;
        font-size: 8.5px;
        font-weight: 850;
        letter-spacing: .08em;
        text-transform: uppercase;
    }

    .summary-item strong {
        display: block;
        color: #334155;
        font-size: 11px;
        font-weight: 850;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .summary-divider {
        width: 1px;
        height: 28px;
        background: #e2e8f0;
    }

    /* ============================================================
       ACTIONS
    ============================================================ */

    .course-form-actions {
        display: flex;
        align-items: center;
        justify-content: flex-end;
        gap: 9px;
        padding-top: 2px;
        animation: courseCreateFadeUp .75s ease both;
    }

    .course-cancel-btn,
    .course-submit-btn {
        min-height: 45px;
        padding: 10px 15px;
        border-radius: 12px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 7px;
        font-size: 11px;
        font-weight: 850;
        text-decoration: none;
        cursor: pointer;
        transition:
            transform .18s ease,
            box-shadow .18s ease,
            background .18s ease;
    }

    .course-cancel-btn {
        border: 1px solid #dbe2ea;
        background: #ffffff;
        color: #64748b;
    }

    .course-submit-btn {
        border: 1px solid #6366f1;
        background: linear-gradient(135deg, #6366f1, #7c3aed);
        color: #ffffff;
        box-shadow: 0 10px 22px rgba(99, 102, 241, .16);
        font: inherit;
    }

    .course-cancel-btn:hover,
    .course-submit-btn:hover {
        transform: translateY(-2px);
    }

    .course-cancel-btn:hover {
        color: #334155;
        border-color: #cbd5e1;
    }

    .course-submit-btn:hover {
        color: #ffffff;
        box-shadow: 0 14px 28px rgba(99, 102, 241, .21);
    }

    .course-submit-btn:disabled {
        opacity: .6;
        cursor: not-allowed;
        transform: none;
    }

    .course-submit-btn i,
    .course-cancel-btn i {
        font-size: 16px;
    }

    /* ============================================================
       ANIMATION
    ============================================================ */

    @keyframes courseCreateFadeUp {
        from {
            opacity: 0;
            transform: translateY(9px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @keyframes courseCreateFloat {
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

    @media (max-width: 760px) {

        .hod-course-create-page {
            width: min(100% - 24px, 680px);
            padding-top: 22px;
        }

        .course-create-title-row {
            align-items: flex-start;
        }

        .form-fields-grid {
            grid-template-columns: 1fr;
        }

        .field-full {
            grid-column: auto;
        }

        .summary-preview {
            grid-template-columns: 1fr;
            gap: 9px;
        }

        .summary-divider {
            width: 100%;
            height: 1px;
        }
    }

    @media (max-width: 560px) {

        .course-form-card,
        .course-summary-card {
            padding: 19px;
            border-radius: 18px;
        }

        .course-form-card::before,
        .course-summary-card::before {
            margin-top: -19px;
            margin-left: -19px;
        }

        .course-create-icon {
            width: 51px;
            height: 51px;
            border-radius: 16px;
            font-size: 23px;
        }

        .course-create-title-row h1 {
            font-size: 28px;
        }

        .course-form-actions {
            flex-direction: column-reverse;
            align-items: stretch;
        }

        .course-cancel-btn,
        .course-submit-btn {
            width: 100%;
        }

        .readonly-department {
            align-items: flex-start;
        }

        .department-lock {
            display: none;
        }

        .textarea-footer {
            align-items: flex-start;
            flex-direction: column;
            gap: 3px;
        }
    }
</style>


<script>
document.addEventListener('DOMContentLoaded', function () {
    'use strict';

    const courseCode =
        document.getElementById('course_code');

    const courseName =
        document.getElementById('course_name');

    const credits =
        document.getElementById('credits');

    const description =
        document.getElementById('description');

    const summaryCode =
        document.getElementById('summaryCode');

    const summaryName =
        document.getElementById('summaryName');

    const summaryCredits =
        document.getElementById('summaryCredits');

    const descriptionCount =
        document.getElementById('descriptionCount');

    const form =
        document.querySelector('.course-create-form');

    const submitButton =
        document.getElementById('updateCourseBtn');


    /* ============================================================
       SUMMARY PREVIEW
    ============================================================ */

    function updateSummary() {

        if (summaryCode) {
            summaryCode.textContent =
                courseCode?.value.trim() || 'Not entered';
        }

        if (summaryName) {
            summaryName.textContent =
                courseName?.value.trim() || 'Not entered';
        }

        if (summaryCredits) {
            summaryCredits.textContent =
                credits?.value.trim() || '—';
        }
    }


    /* ============================================================
       DESCRIPTION COUNTER
    ============================================================ */

    function updateDescriptionCount() {

        if (!description || !descriptionCount) {
            return;
        }

        const length =
            description.value.length;

        descriptionCount.textContent =
            length + ' / 2000';

        if (length > 1800) {
            descriptionCount.style.color = '#e11d48';
        } else {
            descriptionCount.style.color = '';
        }
    }


    courseCode?.addEventListener(
        'input',
        updateSummary
    );

    courseName?.addEventListener(
        'input',
        updateSummary
    );

    credits?.addEventListener(
        'input',
        updateSummary
    );

    description?.addEventListener(
        'input',
        updateDescriptionCount
    );


    /* ============================================================
       SUBMIT STATE
    ============================================================ */

    form?.addEventListener(
        'submit',
        function () {

            if (!submitButton) {
                return;
            }

            submitButton.disabled = true;

            submitButton.innerHTML = `
                <i class='bx bx-loader-alt bx-spin'></i>
                <span>Saving Changes...</span>
            `;
        }
    );


    /* ============================================================
       INITIAL STATE
    ============================================================ */

    updateSummary();
    updateDescriptionCount();

});
</script>
@endsection
