<style>
    /* ============================================================
   STREAM EDIT PAGE
============================================================ */

.stream-edit-page {
    width: 100%;
    max-width: 1100px;
    margin: 0 auto;
    padding: 30px 30px 60px;
}


/* ============================================================
   HEADER
============================================================ */

.stream-edit-header {
    margin-bottom: 28px;
}

.stream-edit-back {
    display: inline-flex;
    align-items: center;
    gap: 8px;

    margin-bottom: 24px;

    color: var(--text-secondary);
    text-decoration: none;

    font-size: 14px;
    font-weight: 600;

    transition:
        color 0.2s ease,
        transform 0.2s ease;
}

.stream-edit-back i {
    font-size: 20px;
}

.stream-edit-back:hover {
    color: var(--primary-color);
    transform: translateX(-2px);
}


/* ============================================================
   HEADING
============================================================ */

.stream-edit-heading {
    display: flex;
    align-items: center;
    gap: 18px;
}

.stream-edit-icon {
    width: 58px;
    height: 58px;

    display: flex;
    align-items: center;
    justify-content: center;

    flex-shrink: 0;

    border-radius: 15px;

    background: var(--primary-color);
    color: #fff;

    font-size: 27px;
}

.stream-edit-eyebrow {
    display: block;

    margin-bottom: 4px;

    color: var(--primary-color);

    font-size: 12px;
    font-weight: 700;

    letter-spacing: 0.08em;
}

.stream-edit-heading h1 {
    margin: 0;

    color: var(--text-color);

    font-size: 28px;
    font-weight: 700;
}

.stream-edit-heading p {
    margin: 5px 0 0;

    color: var(--text-secondary);

    font-size: 14px;
}


/* ============================================================
   FORM CARD
============================================================ */

.stream-edit-card {
    width: 100%;

    background: var(--card-color);

    border: 1px solid var(--border-color);
    border-radius: 18px;

    padding: 30px;

    box-shadow: var(--card-shadow, 0 4px 18px rgba(0, 0, 0, 0.04));
}


/* ============================================================
   FORM GROUP
============================================================ */

.stream-edit-form-group {
    margin-bottom: 24px;
}

.stream-edit-form-group:last-of-type {
    margin-bottom: 0;
}

.stream-edit-form-group > label {
    display: block;

    margin-bottom: 8px;

    color: var(--text-color);

    font-size: 14px;
    font-weight: 650;
}

.stream-edit-form-group > label span {
    color: #dc2626;
}


/* ============================================================
   INPUT / TEXTAREA
============================================================ */

.stream-edit-form-group input,
.stream-edit-form-group textarea {
    width: 100%;

    padding: 12px 14px;

    background: var(--background-color);

    border: 1px solid var(--border-color);
    border-radius: 10px;

    color: var(--text-color);

    font-family: inherit;
    font-size: 14px;

    outline: none;

    transition:
        border-color 0.2s ease,
        box-shadow 0.2s ease,
        background-color 0.2s ease;
}

.stream-edit-form-group input {
    height: 46px;
}

.stream-edit-form-group textarea {
    min-height: 140px;

    resize: vertical;

    line-height: 1.6;
}

.stream-edit-form-group input::placeholder,
.stream-edit-form-group textarea::placeholder {
    color: var(--text-secondary);
    opacity: 0.7;
}

.stream-edit-form-group input:focus,
.stream-edit-form-group textarea:focus {
    border-color: var(--primary-color);

    box-shadow: 0 0 0 3px rgba(0, 0, 0, 0.05);
}


/* ============================================================
   COURSE INFORMATION
============================================================ */

.stream-edit-course {
    display: flex;
    align-items: center;
    gap: 13px;

    min-height: 70px;

    padding: 12px 14px;

    background: var(--background-color);

    border: 1px solid var(--border-color);
    border-radius: 10px;
}

.stream-edit-course-icon {
    width: 42px;
    height: 42px;

    display: flex;
    align-items: center;
    justify-content: center;

    flex-shrink: 0;

    border-radius: 10px;

    background: var(--primary-color);
    color: #fff;

    font-size: 19px;
}

.stream-edit-course div:last-child {
    display: flex;
    flex-direction: column;
    gap: 3px;
}

.stream-edit-course span {
    color: var(--text-secondary);

    font-size: 12px;
}

.stream-edit-course strong {
    color: var(--text-color);

    font-size: 14px;
}


/* ============================================================
   CLASS CODE
============================================================ */

.stream-edit-code-wrapper {
    position: relative;
}

.stream-edit-code-wrapper input {
    padding-right: 100px;

    color: var(--text-secondary);

    cursor: not-allowed;
}

.stream-edit-code-status {
    position: absolute;

    top: 50%;
    right: 12px;

    transform: translateY(-50%);

    display: inline-flex;
    align-items: center;
    gap: 5px;

    padding: 5px 9px;

    border-radius: 7px;

    background: var(--border-color);

    color: var(--text-secondary);

    font-size: 11px;
    font-weight: 600;
}

.stream-edit-code-status i {
    font-size: 14px;
}


/* ============================================================
   HELP TEXT
============================================================ */

.stream-edit-help {
    display: block;

    margin-top: 7px;

    color: var(--text-secondary);

    font-size: 12px;
    line-height: 1.5;
}


/* ============================================================
   STATUS
============================================================ */

.stream-edit-status {
    display: flex;
    align-items: center;
    gap: 12px;

    padding: 14px;

    background: var(--background-color);

    border: 1px solid var(--border-color);
    border-radius: 10px;
}

.stream-edit-status-dot {
    width: 10px;
    height: 10px;

    flex-shrink: 0;

    border-radius: 50%;

    background: #22c55e;

    box-shadow: 0 0 0 4px rgba(34, 197, 94, 0.12);
}

.stream-edit-status div {
    display: flex;
    flex-direction: column;
    gap: 3px;
}

.stream-edit-status strong {
    color: var(--text-color);

    font-size: 14px;
}

.stream-edit-status small {
    color: var(--text-secondary);

    font-size: 12px;
}


/* ============================================================
   ERRORS
============================================================ */

.stream-edit-error {
    display: block;

    margin-top: 7px;

    color: #dc2626;

    font-size: 12px;
}


/* ============================================================
   ACTIONS
============================================================ */

.stream-edit-actions {
    display: flex;
    align-items: center;
    justify-content: flex-end;
    gap: 12px;

    margin-top: 30px;
    padding-top: 24px;

    border-top: 1px solid var(--border-color);
}


/* ============================================================
   CANCEL BUTTON
============================================================ */

.stream-edit-cancel {
    display: inline-flex;
    align-items: center;
    justify-content: center;

    min-width: 100px;
    height: 44px;

    padding: 0 18px;

    border: 1px solid var(--border-color);
    border-radius: 10px;

    background: transparent;

    color: var(--text-secondary);

    text-decoration: none;

    font-size: 14px;
    font-weight: 600;

    transition:
        background-color 0.2s ease,
        color 0.2s ease,
        border-color 0.2s ease;
}

.stream-edit-cancel:hover {
    background: var(--background-color);

    color: var(--text-color);
}


/* ============================================================
   SAVE BUTTON
============================================================ */

.stream-edit-submit {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 8px;

    min-width: 140px;
    height: 44px;

    padding: 0 20px;

    border: none;
    border-radius: 10px;

    background: var(--primary-color);
    color: #fff;

    font-family: inherit;
    font-size: 14px;
    font-weight: 600;

    cursor: pointer;

    transition:
        transform 0.2s ease,
        opacity 0.2s ease,
        box-shadow 0.2s ease;
}

.stream-edit-submit i {
    font-size: 18px;
}

.stream-edit-submit:hover {
    opacity: 0.9;

    transform: translateY(-1px);

    box-shadow: 0 5px 14px rgba(0, 0, 0, 0.12);
}

.stream-edit-submit:active {
    transform: translateY(0);
}


/* ============================================================
   RESPONSIVE
============================================================ */

@media (max-width: 768px) {

    .stream-edit-page {
        padding: 22px 18px 40px;
    }

    .stream-edit-heading {
        align-items: flex-start;
    }

    .stream-edit-icon {
        width: 50px;
        height: 50px;

        font-size: 23px;
    }

    .stream-edit-heading h1 {
        font-size: 24px;
    }

    .stream-edit-card {
        padding: 22px;
        border-radius: 15px;
    }

    .stream-edit-actions {
        flex-direction: column-reverse;
        align-items: stretch;
    }

    .stream-edit-cancel,
    .stream-edit-submit {
        width: 100%;
    }
}


@media (max-width: 480px) {

    .stream-edit-page {
        padding: 18px 14px 30px;
    }

    .stream-edit-heading {
        gap: 12px;
    }

    .stream-edit-icon {
        width: 44px;
        height: 44px;

        border-radius: 11px;

        font-size: 20px;
    }

    .stream-edit-heading h1 {
        font-size: 21px;
    }

    .stream-edit-heading p {
        font-size: 13px;
    }

    .stream-edit-card {
        padding: 18px;
    }

    .stream-edit-code-status {
        display: none;
    }

    .stream-edit-code-wrapper input {
        padding-right: 14px;
    }
}
</style>

@extends('layouts.prof_layout')

@section('content')

<div class="stream-edit-page">

    {{-- ============================================================
        PAGE HEADER
    ============================================================= --}}
    <div class="stream-edit-header">

        <a
            href="{{ route(
                'professor.class-groups.classroom-group',
                $classGroup
            ) }}"
            class="stream-edit-back"
        >
            <i class="bx bx-arrow-back"></i>
            Back to Stream
        </a>

        <div class="stream-edit-heading">

            <div class="stream-edit-icon">
                <i class="bx bx-edit"></i>
            </div>

            <div>
                <span class="stream-edit-eyebrow">
                    CLASSROOM
                </span>

                <h1>
                    Edit Class
                </h1>

                <p>
                    Update the information for this class.
                </p>
            </div>

        </div>

    </div>


    {{-- ============================================================
        FORM CARD
    ============================================================= --}}
    <div class="stream-edit-card">

        <form
            action="{{ route(
                'professor.class-groups.update',
                $classGroup
            ) }}"
            method="POST"
        >

            @csrf
            @method('PUT')


            {{-- ====================================================
                CLASS NAME
            ===================================================== --}}
            <div class="stream-edit-form-group">

                <label for="group_name">
                    Class Name
                    <span>*</span>
                </label>

                <input
                    type="text"
                    id="group_name"
                    name="group_name"
                    value="{{ old('group_name', $classGroup->group_name) }}"
                    placeholder="Enter class name"
                    required
                >

                @error('group_name')
                    <small class="stream-edit-error">
                        {{ $message }}
                    </small>
                @enderror

            </div>


            {{-- ====================================================
                COURSE
            ===================================================== --}}
            <div class="stream-edit-form-group">

                <label>
                    Course
                </label>

                <div class="stream-edit-course">

                    <div class="stream-edit-course-icon">
                        <i class="bx bx-book"></i>
                    </div>

                    <div>
                        <span>Course</span>

                        <strong>
                            {{ $classGroup->course->course_name }}
                        </strong>
                    </div>

                </div>

                <small class="stream-edit-help">
                    The course cannot be changed after the class is created.
                </small>

            </div>


            {{-- ====================================================
                CLASS CODE
            ===================================================== --}}
            <div class="stream-edit-form-group">

                <label>
                    Class Code
                </label>

                <div class="stream-edit-code-wrapper">

                    <input
                        type="text"
                        value="{{ $classGroup->group_code }}"
                        readonly
                    >

                    <span class="stream-edit-code-status">
                        <i class="bx bx-lock-alt"></i>
                        Fixed
                    </span>

                </div>

                <small class="stream-edit-help">
                    The class code is generated automatically and cannot be changed.
                </small>

            </div>


            {{-- ====================================================
                DESCRIPTION
            ===================================================== --}}
            <div class="stream-edit-form-group">

                <label for="description">
                    Description
                </label>

                <textarea
                    id="description"
                    name="description"
                    rows="6"
                    placeholder="Add a description for this class..."
                >{{ old('description', $classGroup->description) }}</textarea>

                @error('description')
                    <small class="stream-edit-error">
                        {{ $message }}
                    </small>
                @enderror

            </div>


            {{-- ====================================================
                STATUS
            ===================================================== --}}
            <div class="stream-edit-form-group">

                <label>
                    Class Status
                </label>

                <div class="stream-edit-status">

                    <span class="stream-edit-status-dot"></span>

                    <div>
                        <strong>
                            {{ ucfirst($classGroup->status) }}
                        </strong>

                        <small>
                            This class is currently active.
                        </small>
                    </div>

                </div>

            </div>


            {{-- ====================================================
                ACTIONS
            ===================================================== --}}
            <div class="stream-edit-actions">

                <a
                    href="{{ route(
                        'professor.class-groups.classroom-group',
                        $classGroup
                    ) }}"
                    class="stream-edit-cancel"
                >
                    Cancel
                </a>

                <button
                    type="submit"
                    class="stream-edit-submit"
                >
                    <i class="bx bx-save"></i>
                    Save Changes
                </button>

            </div>

        </form>

    </div>

</div>

@endsection