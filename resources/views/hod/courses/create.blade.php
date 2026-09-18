@extends('layouts.hod_layout')

@section('title', 'Create Course')

@section('content')

<div class="hod-course-create-page">

    {{-- ============================================================
        PAGE HEADER
    ============================================================ --}}
    <div class="course-page-header">

        <a
            href="{{ route('hod.courses.index') }}"
            class="course-back-link"
        >
            <i class='bx bx-arrow-back'></i>
            Back to Courses
        </a>

        <div class="course-header-content">

            <div class="course-header-icon">
                <i class='bx bx-book-add'></i>
            </div>

            <div>
                <span class="course-header-label">
                    HoD • Academic Management
                </span>

                <h1>Create Course</h1>

                <p>
                    Add a new course to
                    <strong>{{ $department->department_name }}</strong>.
                </p>
            </div>

        </div>

    </div>


    {{-- ============================================================
        VALIDATION ALERT
    ============================================================ --}}
    @if ($errors->any())

        <div class="course-validation-alert">

            <div class="validation-alert-icon">
                <i class='bx bx-error-circle'></i>
            </div>

            <div class="validation-alert-content">

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
        CREATE COURSE FORM
    ============================================================ --}}
    <form
        method="POST"
        action="{{ route('hod.courses.store') }}"
        class="course-information-card"
    >

        @csrf

        {{-- ========================================================
            CARD HEADER
        ========================================================= --}}
        <div class="course-card-header">

            <div class="course-card-icon">
                <i class='bx bx-book-open'></i>
            </div>

            <div>
                <span class="course-section-label">
                    Course Details
                </span>

                <h2>Course Information</h2>

                <p>
                    Enter the basic information for the new course.
                </p>
            </div>

        </div>


        {{-- ========================================================
            COURSE FIELDS
        ========================================================= --}}
        <div class="course-fields-grid">

            {{-- Course Code --}}
            <div class="course-field-group">

                <label for="course_code">
                    Course Code
                    <span class="required-mark">*</span>
                </label>

                <div class="course-input-wrapper">

                    <i class='bx bx-hash course-input-icon'></i>

                    <input
                        type="text"
                        name="course_code"
                        id="course_code"
                        value="{{ old('course_code') }}"
                        placeholder="e.g. CS101"
                        maxlength="50"
                        autocomplete="off"
                        required
                    >

                </div>

                <small>
                    Use the official code assigned to the course.
                </small>

                @error('course_code')
                    <span class="course-field-error">
                        {{ $message }}
                    </span>
                @enderror

            </div>


            {{-- Course Name --}}
            <div class="course-field-group">

                <label for="course_name">
                    Course Name
                    <span class="required-mark">*</span>
                </label>

                <div class="course-input-wrapper">

                    <i class='bx bx-book course-input-icon'></i>

                    <input
                        type="text"
                        name="course_name"
                        id="course_name"
                        value="{{ old('course_name') }}"
                        placeholder="e.g. Database Management"
                        maxlength="255"
                        required
                    >

                </div>

                <small>
                    Enter the full official course name.
                </small>

                @error('course_name')
                    <span class="course-field-error">
                        {{ $message }}
                    </span>
                @enderror

            </div>


            {{-- Department --}}
            <div class="course-field-group course-field-full">

                <label for="department_display">
                    Department
                </label>

                <div class="course-readonly-department">

                    <div class="course-department-icon">
                        <i class='bx bx-building-house'></i>
                    </div>

                    <div class="course-department-details">

                        <span>
                            Assigned Department
                        </span>

                        <strong id="department_display">
                            {{ $department->department_name }}
                        </strong>

                    </div>

                    <div class="course-department-status">
                        <i class='bx bx-lock-alt'></i>
                        Automatic
                    </div>

                </div>

                <small>
                    The course will automatically belong to your department.
                </small>

            </div>


            {{-- Credits --}}
            <div class="course-field-group">

                <label for="credits">
                    Credits
                </label>

                <div class="course-input-wrapper">

                    <i class='bx bx-award course-input-icon'></i>

                    <input
                        type="number"
                        name="credits"
                        id="credits"
                        value="{{ old('credits') }}"
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
                    <span class="course-field-error">
                        {{ $message }}
                    </span>
                @enderror

            </div>


            {{-- Description --}}
            <div class="course-field-group course-field-full">

                <label for="description">
                    Course Description
                    <span class="optional-mark">(Optional)</span>
                </label>

                <div class="course-textarea-wrapper">

                    <textarea
                        name="description"
                        id="description"
                        rows="6"
                        maxlength="2000"
                        placeholder="Describe the course content, learning focus, or other useful information..."
                    >{{ old('description') }}</textarea>

                    <div class="course-textarea-footer">

                        <span>
                            Add useful information about this course.
                        </span>

                        <span id="descriptionCount">
                            0 / 2000
                        </span>

                    </div>

                </div>

                @error('description')
                    <span class="course-field-error">
                        {{ $message }}
                    </span>
                @enderror

            </div>

        </div>


        {{-- ========================================================
            FORM ACTIONS
        ========================================================= --}}
        <div class="course-form-actions">

            <a
                href="{{ route('hod.courses.index') }}"
                class="course-cancel-button"
            >
                <i class='bx bx-x'></i>
                Cancel
            </a>

            <button
                type="submit"
                class="course-submit-button"
                id="createCourseBtn"
            >
                <i class='bx bx-plus'></i>
                <span>Create Course</span>
            </button>

        </div>

    </form>

</div>


<style>

/* ============================================================
   PAGE
============================================================ */

.hod-course-create-page {
    width: min(1100px, calc(100% - 44px));
    margin: 0 auto;
    padding: 30px 0 60px;
    color: #172033;
}


/* ============================================================
   PAGE HEADER
============================================================ */

.course-page-header {
    margin-bottom: 25px;
}

.course-back-link {
    display: inline-flex;
    align-items: center;
    gap: 7px;
    margin-bottom: 20px;
    color: #64748b;
    font-size: 13px;
    font-weight: 750;
    text-decoration: none;
}

.course-back-link i {
    font-size: 19px;
}

.course-back-link:hover {
    color: #2563eb;
}

.course-header-content {
    display: flex;
    align-items: center;
    gap: 17px;
}

.course-header-icon {
    width: 62px;
    height: 62px;
    flex: 0 0 auto;
    display: grid;
    place-items: center;
    border-radius: 18px;
    background: #dbeafe;
    color: #2563eb;
    font-size: 29px;
}

.course-header-label {
    display: block;
    margin-bottom: 5px;
    color: #64748b;
    font-size: 11px;
    font-weight: 850;
    letter-spacing: .08em;
    text-transform: uppercase;
}

.course-header-content h1 {
    margin: 0;
    color: #172033;
    font-size: clamp(28px, 4vw, 38px);
    font-weight: 850;
    line-height: 1.1;
    letter-spacing: -.035em;
}

.course-header-content p {
    margin: 8px 0 0;
    color: #64748b;
    font-size: 14px;
    line-height: 1.5;
}

.course-header-content p strong {
    color: #334155;
}


/* ============================================================
   VALIDATION ALERT
============================================================ */

.course-validation-alert {
    display: flex;
    align-items: flex-start;
    gap: 12px;
    margin-bottom: 22px;
    padding: 16px 18px;
    border: 1px solid #fecdd3;
    border-radius: 14px;
    background: #fff1f2;
    color: #9f1239;
}

.validation-alert-icon {
    flex: 0 0 auto;
    font-size: 23px;
    line-height: 1;
}

.validation-alert-content {
    min-width: 0;
}

.validation-alert-content strong {
    display: block;
    margin-bottom: 5px;
    font-size: 13px;
}

.validation-alert-content ul {
    margin: 0;
    padding-left: 18px;
    font-size: 12px;
    line-height: 1.7;
}


/* ============================================================
   MAIN CARD
============================================================ */

.course-information-card {
    padding: 30px;
    border: 1px solid #e2e8f0;
    border-radius: 22px;
    background: #ffffff;
    box-shadow: 0 12px 35px rgba(15, 23, 42, .055);
}


/* ============================================================
   CARD HEADER
============================================================ */

.course-card-header {
    display: flex;
    align-items: flex-start;
    gap: 13px;
    margin-bottom: 28px;
    padding-bottom: 23px;
    border-bottom: 1px solid #edf1f6;
}

.course-card-icon {
    width: 45px;
    height: 45px;
    flex: 0 0 auto;
    display: grid;
    place-items: center;
    border-radius: 13px;
    background: #dbeafe;
    color: #2563eb;
    font-size: 21px;
}

.course-section-label {
    display: block;
    margin-bottom: 4px;
    color: #94a3b8;
    font-size: 10px;
    font-weight: 850;
    letter-spacing: .09em;
    text-transform: uppercase;
}

.course-card-header h2 {
    margin: 0;
    color: #1e293b;
    font-size: 22px;
    font-weight: 850;
    letter-spacing: -.025em;
}

.course-card-header p {
    margin: 6px 0 0;
    color: #64748b;
    font-size: 13px;
    line-height: 1.5;
}


/* ============================================================
   FIELDS GRID
============================================================ */

.course-fields-grid {
    display: grid;
    grid-template-columns: repeat(2, minmax(0, 1fr));
    gap: 23px 22px;
}

.course-field-full {
    grid-column: 1 / -1;
}

.course-field-group {
    min-width: 0;
}

.course-field-group label {
    display: flex;
    align-items: center;
    gap: 5px;
    margin-bottom: 8px;
    color: #334155;
    font-size: 13px;
    font-weight: 800;
}

.required-mark {
    color: #ef4444;
}

.optional-mark {
    color: #94a3b8;
    font-size: 11px;
    font-weight: 600;
}

.course-field-group small {
    display: block;
    margin-top: 7px;
    color: #94a3b8;
    font-size: 11px;
    line-height: 1.5;
}

.course-field-error {
    display: block;
    margin-top: 7px;
    color: #e11d48;
    font-size: 11px;
    font-weight: 700;
}


/* ============================================================
   INPUTS
============================================================ */

.course-input-wrapper {
    position: relative;
}

.course-input-icon {
    position: absolute;
    top: 50%;
    left: 15px;
    transform: translateY(-50%);
    color: #94a3b8;
    font-size: 19px;
    pointer-events: none;
}

.course-input-wrapper input,
.course-textarea-wrapper textarea {
    width: 100%;
    border: 1px solid #dbe2ea;
    border-radius: 13px;
    outline: none;
    background: #ffffff;
    color: #172033;
    font: inherit;
    transition: border-color .18s ease, box-shadow .18s ease;
}

.course-input-wrapper input {
    min-height: 49px;
    padding: 11px 14px 11px 44px;
    font-size: 13px;
}

.course-input-wrapper input::placeholder,
.course-textarea-wrapper textarea::placeholder {
    color: #a0aabd;
}

.course-input-wrapper input:hover,
.course-textarea-wrapper textarea:hover {
    border-color: #cbd5e1;
}

.course-input-wrapper input:focus,
.course-textarea-wrapper textarea:focus {
    border-color: #60a5fa;
    box-shadow: 0 0 0 4px rgba(37, 99, 235, .09);
}


/* ============================================================
   READONLY DEPARTMENT
============================================================ */

.course-readonly-department {
    display: flex;
    align-items: center;
    gap: 12px;
    min-height: 67px;
    padding: 11px 13px;
    border: 1px solid #dbe3ed;
    border-radius: 14px;
    background: #f8fafc;
}

.course-department-icon {
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

.course-department-details {
    min-width: 0;
    flex: 1;
}

.course-department-details span {
    display: block;
    margin-bottom: 3px;
    color: #94a3b8;
    font-size: 10px;
    font-weight: 800;
    letter-spacing: .06em;
    text-transform: uppercase;
}

.course-department-details strong {
    display: block;
    overflow: hidden;
    color: #334155;
    font-size: 13px;
    font-weight: 850;
    text-overflow: ellipsis;
    white-space: nowrap;
}

.course-department-status {
    display: inline-flex;
    align-items: center;
    gap: 5px;
    padding: 7px 10px;
    border: 1px solid #e2e8f0;
    border-radius: 999px;
    background: #ffffff;
    color: #94a3b8;
    font-size: 10px;
    font-weight: 800;
    white-space: nowrap;
}

.course-department-status i {
    font-size: 13px;
}


/* ============================================================
   DESCRIPTION
============================================================ */

.course-textarea-wrapper {
    overflow: hidden;
    border: 1px solid #dbe2ea;
    border-radius: 14px;
    background: #ffffff;
}

.course-textarea-wrapper textarea {
    display: block;
    min-height: 155px;
    padding: 14px 15px;
    border: 0;
    border-radius: 0;
    resize: vertical;
    font-size: 13px;
    line-height: 1.65;
}

.course-textarea-wrapper:focus-within {
    border-color: #60a5fa;
    box-shadow: 0 0 0 4px rgba(37, 99, 235, .09);
}

.course-textarea-footer {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 15px;
    padding: 10px 13px;
    border-top: 1px solid #edf1f6;
    background: #fbfdff;
    color: #94a3b8;
    font-size: 10px;
}

#descriptionCount {
    flex: 0 0 auto;
    font-weight: 750;
}


/* ============================================================
   ACTIONS
============================================================ */

.course-form-actions {
    display: flex;
    align-items: center;
    justify-content: flex-end;
    gap: 11px;
    margin-top: 30px;
    padding-top: 23px;
    border-top: 1px solid #edf1f6;
}

.course-cancel-button,
.course-submit-button {
    min-height: 47px;
    padding: 11px 18px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    border-radius: 12px;
    font-size: 13px;
    font-weight: 800;
    text-decoration: none;
    cursor: pointer;
}

.course-cancel-button {
    border: 1px solid #dbe2ea;
    background: #ffffff;
    color: #64748b;
}

.course-cancel-button:hover {
    border-color: #cbd5e1;
    color: #334155;
}

.course-submit-button {
    border: 1px solid #2563eb;
    background: #2563eb;
    color: #ffffff;
    box-shadow: 0 8px 18px rgba(37, 99, 235, .16);
    font: inherit;
}

.course-submit-button:hover {
    background: #1d4ed8;
    border-color: #1d4ed8;
}

.course-submit-button:disabled {
    opacity: .65;
    cursor: not-allowed;
}

.course-cancel-button i,
.course-submit-button i {
    font-size: 18px;
}


/* ============================================================
   RESPONSIVE
============================================================ */

@media (max-width: 760px) {

    .hod-course-create-page {
        width: min(100% - 26px, 680px);
        padding-top: 23px;
    }

    .course-information-card {
        padding: 23px;
    }

    .course-fields-grid {
        grid-template-columns: 1fr;
    }

    .course-field-full {
        grid-column: auto;
    }

    .course-header-content {
        align-items: flex-start;
    }

    .course-readonly-department {
        align-items: flex-start;
    }

}

@media (max-width: 560px) {

    .course-information-card {
        padding: 19px;
        border-radius: 18px;
    }

    .course-header-icon {
        width: 52px;
        height: 52px;
        border-radius: 15px;
        font-size: 24px;
    }

    .course-header-content h1 {
        font-size: 29px;
    }

    .course-header-content p {
        font-size: 12px;
    }

    .course-card-header h2 {
        font-size: 20px;
    }

    .course-form-actions {
        flex-direction: column-reverse;
        align-items: stretch;
    }

    .course-cancel-button,
    .course-submit-button {
        width: 100%;
    }

    .course-department-status {
        display: none;
    }

    .course-textarea-footer {
        align-items: flex-start;
        flex-direction: column;
        gap: 4px;
    }

}

</style>


<script>
document.addEventListener('DOMContentLoaded', function () {
    'use strict';

    const description = document.getElementById('description');
    const descriptionCount = document.getElementById('descriptionCount');

    const form = document.querySelector('.course-information-card');
    const submitButton = document.getElementById('createCourseBtn');


    /*
    |--------------------------------------------------------------------------
    | DESCRIPTION COUNTER
    |--------------------------------------------------------------------------
    */

    function updateDescriptionCount() {

        if (!description || !descriptionCount) {
            return;
        }

        const length = description.value.length;

        descriptionCount.textContent = `${length} / 2000`;

        if (length > 1800) {
            descriptionCount.style.color = '#e11d48';
        } else {
            descriptionCount.style.color = '';
        }
    }


    /*
    |--------------------------------------------------------------------------
    | SUBMIT STATE
    |--------------------------------------------------------------------------
    */

    form?.addEventListener('submit', function () {

        if (!submitButton) {
            return;
        }

        submitButton.disabled = true;

        submitButton.innerHTML = `
            <i class='bx bx-loader-alt bx-spin'></i>
            <span>Creating Course...</span>
        `;

    });


    /*
    |--------------------------------------------------------------------------
    | INITIAL STATE
    |--------------------------------------------------------------------------
    */

    description?.addEventListener(
        'input',
        updateDescriptionCount
    );

    updateDescriptionCount();

});
</script>

@endsection