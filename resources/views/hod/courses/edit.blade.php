
@extends('layouts.hod_layout')

@section('title', 'Edit Course')

@section('content')

<div class="hod-course-edit-page">

    {{-- ============================================================
        PAGE HEADER
    ============================================================ --}}

    <div class="course-edit-header">

        <a
            href="{{ route('hod.courses.index') }}"
            class="back-link"
        >
            <i class='bx bx-left-arrow-alt'></i>
            Back to Courses
        </a>

        <div class="course-edit-title-row">

            <div class="course-edit-icon">
                <i class='bx bx-edit-alt'></i>
            </div>

            <div>

                <span class="edit-eyebrow">
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
        SINGLE COURSE FORM CARD
    ============================================================ --}}

    <form
        method="POST"
        action="{{ route('hod.courses.update', $course) }}"
        class="course-edit-form"
    >

        @csrf
        @method('PUT')


        <section class="course-information-card">

            {{-- CARD HEADER --}}

            <div class="form-card-heading">

                <div class="form-section-icon">
                    <i class='bx bx-book-open'></i>
                </div>

                <div>

                    <span class="section-kicker">
                        Course Details
                    </span>

                    <h2>Course Information</h2>

                    <p>
                        Update the academic information and description
                        for this course.
                    </p>

                </div>

            </div>


            {{-- ====================================================
                BASIC COURSE INFORMATION
            ==================================================== --}}

            <div class="form-fields-grid">


                {{-- COURSE CODE --}}

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


                {{-- COURSE NAME --}}

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


                {{-- DEPARTMENT --}}

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


                {{-- CREDITS --}}

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


            {{-- ====================================================
                DESCRIPTION — INSIDE THE SAME CARD
            ==================================================== --}}

            <div class="description-section">

                <div class="description-heading">

                    <div class="description-icon">
                        <i class='bx bx-detail'></i>
                    </div>

                    <div>

                        <span class="section-kicker">
                            Course Overview
                        </span>

                        <h3>Description</h3>

                        <p>
                            Explain what this course covers.
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
    rows="6"
    maxlength="2000"
    placeholder="Describe the course content, learning focus, or other useful information..."
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

            </div>


            {{-- ====================================================
                ACTIONS — INSIDE THE SAME CARD
            ==================================================== --}}

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


        </section>

    </form>

</div>


<style>

/* ============================================================
   PAGE
   ============================================================ */

.hod-course-edit-page {

    width: min(1100px, calc(100% - 40px));

    margin: 0 auto;

    padding: 30px 0 65px;

    color: #172033;

}


/* ============================================================
   HEADER
   ============================================================ */

.course-edit-header {

    margin-bottom: 25px;

}

.back-link {

    display: inline-flex;

    align-items: center;

    gap: 6px;

    margin-bottom: 20px;

    color: #64748b;

    text-decoration: none;

    font-size: 13px;

    font-weight: 700;

}

.back-link:hover {

    color: #4f46e5;

}

.back-link i {

    font-size: 19px;

}

.course-edit-title-row {

    display: flex;

    align-items: center;

    gap: 17px;

}

.course-edit-icon {

    width: 62px;

    height: 62px;

    flex: 0 0 auto;

    display: grid;

    place-items: center;

    border-radius: 18px;

    background: #eef2ff;

    color: #4f46e5;

    font-size: 29px;

}

.edit-eyebrow {

    display: block;

    margin-bottom: 6px;

    color: #6366f1;

    font-size: 11px;

    font-weight: 800;

    letter-spacing: .08em;

    text-transform: uppercase;

}

.course-edit-title-row h1 {

    margin: 0;

    color: #111827;

    font-size: clamp(28px, 4vw, 38px);

    line-height: 1.1;

    font-weight: 850;

    letter-spacing: -.035em;

}

.course-edit-title-row p {

    margin: 8px 0 0;

    color: #64748b;

    font-size: 14px;

    line-height: 1.5;

}

.course-edit-title-row p strong {

    color: #475569;

}

.editing-course-badge {

    display: inline-flex;

    align-items: center;

    gap: 6px;

    margin-top: 10px;

    padding: 6px 10px;

    border-radius: 999px;

    background: #eef2ff;

    border: 1px solid #e0e7ff;

    color: #4f46e5;

    font-size: 11px;

    font-weight: 800;

}


/* ============================================================
   ALERT
   ============================================================ */

.course-form-alert {

    display: flex;

    align-items: flex-start;

    gap: 12px;

    margin-bottom: 22px;

    padding: 16px 18px;

    border: 1px solid #fecdd3;

    border-radius: 15px;

    background: #fff1f2;

    color: #9f1239;

}

.alert-icon {

    flex: 0 0 auto;

    font-size: 22px;

}

.course-form-alert strong {

    display: block;

    margin-bottom: 5px;

    font-size: 13px;

}

.course-form-alert ul {

    margin: 0;

    padding-left: 18px;

    font-size: 12px;

    line-height: 1.7;

}


/* ============================================================
   SINGLE CARD
   ============================================================ */

.course-information-card {

    padding: 30px;

    border: 1px solid #e2e8f0;

    border-radius: 22px;

    background: #ffffff;

    box-shadow: 0 10px 30px rgba(15, 23, 42, .045);

}


/* ============================================================
   CARD HEADER
   ============================================================ */

.form-card-heading {

    display: flex;

    align-items: flex-start;

    gap: 14px;

    margin-bottom: 28px;

}

.form-section-icon {

    width: 46px;

    height: 46px;

    flex: 0 0 auto;

    display: grid;

    place-items: center;

    border-radius: 14px;

    background: #dbeafe;

    color: #2563eb;

    font-size: 21px;

}

.section-kicker {

    display: block;

    margin-bottom: 5px;

    color: #94a3b8;

    font-size: 10px;

    font-weight: 850;

    letter-spacing: .1em;

    text-transform: uppercase;

}

.form-card-heading h2 {

    margin: 0;

    color: #1e293b;

    font-size: 22px;

    font-weight: 850;

    letter-spacing: -.025em;

}

.form-card-heading p {

    margin: 6px 0 0;

    color: #64748b;

    font-size: 13px;

    line-height: 1.55;

}


/* ============================================================
   FORM FIELDS
   ============================================================ */

.form-fields-grid {

    display: grid;

    grid-template-columns: repeat(2, minmax(0, 1fr));

    gap: 22px;

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

    margin-bottom: 8px;

    color: #334155;

    font-size: 13px;

    font-weight: 800;

}

.field-group label > span {

    color: #ef4444;

}

.field-group small {

    display: block;

    margin-top: 7px;

    color: #94a3b8;

    font-size: 11px;

    line-height: 1.5;

}

.field-error {

    display: block;

    margin-top: 7px;

    color: #e11d48;

    font-size: 11px;

    font-weight: 700;

}

.field-shell {

    position: relative;

}

.field-icon {

    position: absolute;

    top: 50%;

    left: 14px;

    transform: translateY(-50%);

    color: #94a3b8;

    font-size: 18px;

    pointer-events: none;

}

.field-shell input {

    width: 100%;

    min-height: 48px;

    padding: 11px 14px 11px 42px;

    border: 1px solid #dbe2ea;

    border-radius: 13px;

    background: #ffffff;

    color: #172033;

    outline: none;

    font: inherit;

    font-size: 13px;

}

.field-shell input::placeholder {

    color: #a0aabd;

}

.field-shell input:hover {

    border-color: #cbd5e1;

}

.field-shell input:focus {

    border-color: #818cf8;

    box-shadow: 0 0 0 4px rgba(99, 102, 241, .08);

}


/* ============================================================
   READONLY DEPARTMENT
   ============================================================ */

.readonly-department {

    display: flex;

    align-items: center;

    gap: 12px;

    min-height: 65px;

    padding: 11px 14px;

    border: 1px solid #e2e8f0;

    border-radius: 14px;

    background: #f8fafc;

}

.readonly-department-icon {

    width: 42px;

    height: 42px;

    flex: 0 0 auto;

    display: grid;

    place-items: center;

    border-radius: 12px;

    background: #ede9fe;

    color: #7c3aed;

    font-size: 20px;

}

.readonly-department > div:nth-child(2) {

    min-width: 0;

    flex: 1;

}

.readonly-label {

    display: block;

    margin-bottom: 3px;

    color: #94a3b8;

    font-size: 10px;

    font-weight: 800;

    letter-spacing: .07em;

    text-transform: uppercase;

}

.readonly-department strong {

    display: block;

    color: #334155;

    font-size: 13px;

    font-weight: 850;

}

.department-lock {

    display: inline-flex;

    align-items: center;

    gap: 5px;

    padding: 6px 9px;

    border-radius: 999px;

    background: #ffffff;

    border: 1px solid #e2e8f0;

    color: #94a3b8;

    font-size: 10px;

    font-weight: 800;

}


/* ============================================================
   DESCRIPTION INSIDE CARD
   ============================================================ */

.description-section {

    margin-top: 30px;

    padding-top: 27px;

    border-top: 1px solid #eef2f6;

}

.description-heading {

    display: flex;

    align-items: flex-start;

    gap: 12px;

    margin-bottom: 20px;

}

.description-icon {

    width: 42px;

    height: 42px;

    flex: 0 0 auto;

    display: grid;

    place-items: center;

    border-radius: 13px;

    background: #fef3c7;

    color: #d97706;

    font-size: 20px;

}

.description-heading h3 {

    margin: 0;

    color: #1e293b;

    font-size: 19px;

    font-weight: 850;

}

.description-heading p {

    margin: 5px 0 0;

    color: #64748b;

    font-size: 12px;

}

.textarea-shell {

    overflow: hidden;

    border: 1px solid #dbe2ea;

    border-radius: 14px;

    background: #ffffff;

}

.textarea-shell textarea {

    display: block;

    width: 100%;

    min-height: 150px;

    padding: 15px;

    border: 0;

    outline: none;

    resize: vertical;

    color: #172033;

    background: #ffffff;

    font: inherit;

    font-size: 13px;

    line-height: 1.7;

}

.textarea-shell textarea::placeholder {

    color: #a0aabd;

}

.textarea-shell:focus-within {

    border-color: #818cf8;

    box-shadow: 0 0 0 4px rgba(99, 102, 241, .08);

}

.textarea-footer {

    display: flex;

    align-items: center;

    justify-content: space-between;

    gap: 15px;

    padding: 10px 13px;

    border-top: 1px solid #eef2f6;

    background: #fbfdff;

    color: #94a3b8;

    font-size: 10px;

}


/* ============================================================
   ACTIONS
   ============================================================ */

.course-form-actions {

    display: flex;

    align-items: center;

    justify-content: flex-end;

    gap: 10px;

    margin-top: 30px;

    padding-top: 25px;

    border-top: 1px solid #eef2f6;

}

.course-cancel-btn,

.course-submit-btn {

    min-height: 47px;

    padding: 11px 18px;

    border-radius: 12px;

    display: inline-flex;

    align-items: center;

    justify-content: center;

    gap: 8px;

    font-size: 13px;

    font-weight: 800;

    text-decoration: none;

    cursor: pointer;

}

.course-cancel-btn {

    border: 1px solid #dbe2ea;

    background: #ffffff;

    color: #64748b;

}

.course-cancel-btn:hover {

    color: #334155;

    border-color: #cbd5e1;

}

.course-submit-btn {

    border: 1px solid #6366f1;

    background: linear-gradient(135deg, #6366f1, #7c3aed);

    color: #ffffff;

    box-shadow: 0 8px 18px rgba(99, 102, 241, .14);

    font: inherit;

}

.course-submit-btn:hover {

    color: #ffffff;

}

.course-submit-btn:disabled {

    opacity: .6;

    cursor: not-allowed;

}

.course-submit-btn i,

.course-cancel-btn i {

    font-size: 17px;

}


/* ============================================================
   REMOVE ALL INTRO ANIMATIONS AND TRANSITIONS
   ============================================================ */

.hod-course-edit-page,
.hod-course-edit-page *,
.hod-course-edit-page *::before,
.hod-course-edit-page *::after {

    animation: none !important;

    transition: none !important;

}

.course-information-card::before,

.course-information-card::after,

.course-form-card::before,

.course-form-card::after,

.course-summary-card::before,

.course-summary-card::after {

    display: none !important;

}


/* ============================================================
   RESPONSIVE
   ============================================================ */

@media (max-width: 760px) {

    .hod-course-edit-page {

        width: min(100% - 24px, 680px);

        padding-top: 22px;

    }

    .form-fields-grid {

        grid-template-columns: 1fr;

    }

    .field-full {

        grid-column: auto;

    }

    .course-information-card {

        padding: 22px;

        border-radius: 18px;

    }

}

@media (max-width: 560px) {

    .course-edit-title-row {

        align-items: flex-start;

    }

    .course-edit-icon {

        width: 50px;

        height: 50px;

        font-size: 23px;

    }

    .course-edit-title-row h1 {

        font-size: 28px;

    }

    .course-information-card {

        padding: 18px;

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

        gap: 4px;

    }

    .course-form-actions {

        flex-direction: column-reverse;

        align-items: stretch;

    }

    .course-cancel-btn,

    .course-submit-btn {

        width: 100%;

    }

}

</style>


<script>

document.addEventListener('DOMContentLoaded', function () {

    'use strict';


    const description =
        document.getElementById('description');

    const descriptionCount =
        document.getElementById('descriptionCount');

    const form =
        document.querySelector('.course-edit-form');

    const submitButton =
        document.getElementById('updateCourseBtn');


    /* ============================================================
       DESCRIPTION CHARACTER COUNTER
    ============================================================ */

    function updateDescriptionCount() {

        if (!description || !descriptionCount) {
            return;
        }

        const length = description.value.length;

        descriptionCount.textContent =
            length + ' / 2000';

        if (length > 1800) {

            descriptionCount.style.color = '#e11d48';

        } else {

            descriptionCount.style.color = '';

        }

    }


    description?.addEventListener(
        'input',
        updateDescriptionCount
    );


    /* ============================================================
       SUBMIT STATE
    ============================================================ */

    form?.addEventListener('submit', function () {

        if (!submitButton) {
            return;
        }

        submitButton.disabled = true;

        submitButton.innerHTML = `
            <i class='bx bx-loader-alt bx-spin'></i>
            <span>Saving Changes...</span>
        `;

    });


    /* ============================================================
       INITIAL STATE
    ============================================================ */

    updateDescriptionCount();

});

</script>

@endsection