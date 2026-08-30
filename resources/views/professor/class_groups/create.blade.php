<style>
    /* ============================================================
   PROFESSOR — CREATE CLASS
   ============================================================ */


/* ============================================================
   PAGE
   ============================================================ */

.create-class-page {

    width: 100%;
    box-sizing: border-box;

}


/* ============================================================
   HEADER
   ============================================================ */

.create-class-header {

    display: flex;

    align-items: center;
    justify-content: space-between;

    width: 100%;

    min-height: 145px;

    padding: 26px 30px;

    box-sizing: border-box;

    background-color: var(--card-color);

    border: 1px solid var(--border-color);

    border-radius: 16px;

    box-shadow:
        0 4px 14px var(--shadow-color);

    margin-bottom: 16px;

}


.create-class-header-text {

    display: flex;

    flex-direction: column;

}


.create-class-eyebrow {

    margin-bottom: 5px;

    color: var(--primary-color);

    font-size: 10px;

    font-weight: 700;

    letter-spacing: 1.3px;

}


.create-class-header h1 {

    margin: 0;

    color: var(--text-color);

    font-size: 28px;

    font-weight: 700;

    line-height: 1.15;

}


.create-class-header p {

    margin: 7px 0 0;

    color: var(--muted-text-color);

    font-size: 14px;

}


/* ============================================================
   HEADER ICON
   ============================================================ */

.create-class-header-icon {

    display: flex;

    align-items: center;
    justify-content: center;

    width: 64px;
    height: 64px;

    color: var(--primary-color);

    background-color: var(--primary-soft);

    border: 1px solid var(--primary-border);

    border-radius: 15px;

    font-size: 30px;

}


/* ============================================================
   FORM CARD
   ============================================================ */

.create-class-card {

    width: 100%;

    box-sizing: border-box;

    background-color: var(--card-color);

    border: 1px solid var(--border-color);

    border-radius: 16px;

    box-shadow:
        0 4px 14px var(--shadow-color);

    overflow: hidden;

}


/* ============================================================
   CARD HEADER
   ============================================================ */

.create-class-card-header {

    display: flex;

    align-items: center;
    justify-content: space-between;

    padding: 22px 26px;

    border-bottom: 1px solid var(--border-color);

}


.create-class-section-label {

    display: block;

    margin-bottom: 4px;

    color: var(--primary-color);

    font-size: 10px;

    font-weight: 700;

    letter-spacing: 1.2px;

}


.create-class-card-header h2 {

    margin: 0;

    color: var(--text-color);

    font-size: 20px;

    font-weight: 700;

}


.create-class-card-header p {

    margin: 5px 0 0;

    color: var(--muted-text-color);

    font-size: 13px;

}


.create-class-card-icon {

    display: flex;

    align-items: center;
    justify-content: center;

    width: 42px;
    height: 42px;

    color: var(--primary-color);

    background-color: var(--primary-soft);

    border-radius: 11px;

    font-size: 21px;

}


/* ============================================================
   FORM
   ============================================================ */

.create-class-form {

    padding: 26px;

}


/* ============================================================
   FORM GROUP
   ============================================================ */

.create-class-form-group {

    margin-bottom: 22px;

}


.create-class-form-group label {

    display: block;

    margin-bottom: 8px;

    color: var(--text-color);

    font-size: 13px;

    font-weight: 600;

}


.create-class-form-group .required {

    color: var(--primary-color);

}


.create-class-form-group .optional {

    margin-left: 5px;

    color: var(--muted-text-color);

    font-size: 11px;

    font-weight: 400;

}


/* ============================================================
   INPUT WRAPPER
   ============================================================ */

.create-class-input-wrapper {

    position: relative;

    display: flex;

    align-items: center;

}


.create-class-input-wrapper > i {

    position: absolute;

    left: 14px;

    z-index: 1;

    color: var(--muted-text-color);

    font-size: 18px;

    pointer-events: none;

}


/* ============================================================
   INPUT + SELECT
   ============================================================ */

.create-class-input-wrapper input,
.create-class-input-wrapper select {

    width: 100%;

    height: 46px;

    padding: 0 14px 0 43px;

    box-sizing: border-box;

    color: var(--text-color);

    background-color: var(--input-color);

    border: 1px solid var(--border-color);

    border-radius: 10px;

    outline: none;

    font-family: inherit;

    font-size: 13px;

    transition:
        border-color 0.2s ease,
        box-shadow 0.2s ease,
        background-color 0.2s ease;

}


.create-class-input-wrapper input::placeholder {

    color: var(--muted-text-color);

}


.create-class-input-wrapper input:focus,
.create-class-input-wrapper select:focus {

    border-color: var(--primary-color);

    box-shadow:
        0 0 0 3px var(--primary-soft);

}


/* ============================================================
   SELECT
   ============================================================ */

.create-class-input-wrapper select {

    appearance: auto;

    cursor: pointer;

}


/* ============================================================
   TEXTAREA
   ============================================================ */

.create-class-textarea-wrapper {

    position: relative;

}


.create-class-textarea-wrapper > i {

    position: absolute;

    top: 14px;

    left: 14px;

    color: var(--muted-text-color);

    font-size: 18px;

    pointer-events: none;

}


.create-class-textarea-wrapper textarea {

    display: block;

    width: 100%;

    min-height: 120px;

    padding: 13px 14px 13px 43px;

    box-sizing: border-box;

    resize: vertical;

    color: var(--text-color);

    background-color: var(--input-color);

    border: 1px solid var(--border-color);

    border-radius: 10px;

    outline: none;

    font-family: inherit;

    font-size: 13px;

    line-height: 1.5;

    transition:
        border-color 0.2s ease,
        box-shadow 0.2s ease;

}


.create-class-textarea-wrapper textarea::placeholder {

    color: var(--muted-text-color);

}


.create-class-textarea-wrapper textarea:focus {

    border-color: var(--primary-color);

    box-shadow:
        0 0 0 3px var(--primary-soft);

}


/* ============================================================
   VALIDATION ERROR
   ============================================================ */

.create-class-error {

    display: block;

    margin-top: 6px;

    color: var(--danger-color);

    font-size: 11px;

}


/* ============================================================
   CLASS CODE INFORMATION
   ============================================================ */

.create-class-code-info {

    display: flex;

    align-items: flex-start;

    gap: 12px;

    margin-top: 4px;

    margin-bottom: 26px;

    padding: 14px 16px;

    box-sizing: border-box;

    background-color: var(--hover-color);

    border: 1px solid var(--border-color);

    border-radius: 11px;

}


.create-class-code-icon {

    display: flex;

    align-items: center;
    justify-content: center;

    width: 36px;
    height: 36px;

    flex-shrink: 0;

    color: var(--primary-color);

    background-color: var(--primary-soft);

    border: 1px solid var(--primary-border);

    border-radius: 9px;

    font-size: 18px;

}


.create-class-code-info strong {

    display: block;

    margin-bottom: 3px;

    color: var(--text-color);

    font-size: 12px;

}


.create-class-code-info p {

    margin: 0;

    color: var(--muted-text-color);

    font-size: 12px;

    line-height: 1.45;

}


/* ============================================================
   ACTIONS
   ============================================================ */

.create-class-actions {

    display: flex;

    align-items: center;
    justify-content: flex-end;

    gap: 10px;

    padding-top: 20px;

    border-top: 1px solid var(--border-color);

}


/* ============================================================
   CANCEL
   ============================================================ */

.create-class-cancel {

    display: inline-flex;

    align-items: center;
    justify-content: center;

    min-height: 42px;

    padding: 0 17px;

    box-sizing: border-box;

    color: var(--muted-text-color);

    background-color: transparent;

    border: 1px solid var(--border-color);

    border-radius: 10px;

    text-decoration: none;

    font-size: 13px;

    font-weight: 600;

    transition:
        color 0.2s ease,
        background-color 0.2s ease,
        border-color 0.2s ease;

}


.create-class-cancel:hover {

    color: var(--text-color);

    background-color: var(--hover-color);

    border-color: var(--border-color);

}


/* ============================================================
   CREATE BUTTON
   ============================================================ */

.create-class-submit {

    display: inline-flex;

    align-items: center;
    justify-content: center;

    gap: 7px;

    min-height: 42px;

    padding: 0 18px;

    box-sizing: border-box;

    color: var(--button-text-color);

    background-color: var(--primary-color);

    border: 1px solid var(--primary-color);

    border-radius: 10px;

    cursor: pointer;

    font-family: inherit;

    font-size: 13px;

    font-weight: 600;

    transition:
        transform 0.2s ease,
        opacity 0.2s ease,
        box-shadow 0.2s ease;

}


.create-class-submit i {

    font-size: 18px;

}


.create-class-submit:hover {

    opacity: 0.92;

    transform: translateY(-1px);

    box-shadow:
        0 5px 14px var(--shadow-color);

}


/* ============================================================
   RESPONSIVE
   ============================================================ */

@media (max-width: 700px) {

    .create-class-header {

        min-height: 125px;

        padding: 22px;

    }


    .create-class-header h1 {

        font-size: 24px;

    }


    .create-class-header-icon {

        width: 54px;
        height: 54px;

        font-size: 25px;

    }


    .create-class-form {

        padding: 20px;

    }


    .create-class-card-header {

        padding: 19px 20px;

    }

}


@media (max-width: 480px) {

    .create-class-header {

        padding: 18px;

    }


    .create-class-header-icon {

        display: none;

    }


    .create-class-card-header {

        padding: 18px;

    }


    .create-class-card-icon {

        display: none;

    }


    .create-class-form {

        padding: 18px;

    }


    .create-class-actions {

        flex-direction: column-reverse;

        align-items: stretch;

    }


    .create-class-cancel,
    .create-class-submit {

        width: 100%;

    }

}
</style>

@extends('layouts.prof_layout')

@section('content')

<div class="create-class-page">

    {{-- ============================================================
         PAGE HEADER
    ============================================================= --}}

    <div class="create-class-header">

        <div class="create-class-header-text">

            <span class="create-class-eyebrow">
                PROFESSOR DASHBOARD
            </span>

            <h1>
                Create Class
            </h1>

            <p>
                Create a new classroom for your students.
            </p>

        </div>


        <div class="create-class-header-icon">

            <i class="bx bx-chalkboard"></i>

        </div>

    </div>


    {{-- ============================================================
         FORM CARD
    ============================================================= --}}

    <div class="create-class-card">

        <div class="create-class-card-header">

            <div>

                <span class="create-class-section-label">
                    CLASS INFORMATION
                </span>

                <h2>
                    New Class
                </h2>

                <p>
                    Enter the basic information for your classroom.
                </p>

            </div>

            <div class="create-class-card-icon">

                <i class="bx bx-book-content"></i>

            </div>

        </div>


        {{-- ========================================================
             FORM
        ========================================================= --}}

        <form
            action="{{ route('professor.class-groups.store') }}"
            method="POST"
            class="create-class-form"
        >

            @csrf


            {{-- ====================================================
                 CLASS NAME
            ===================================================== --}}

            <div class="create-class-form-group">

                <label for="group_name">

                    Class Name

                    <span class="required">
                        *
                    </span>

                </label>

                <div class="create-class-input-wrapper">

                    <i class="bx bx-chalkboard"></i>

                    <input
                        type="text"
                        id="group_name"
                        name="group_name"
                        value="{{ old('group_name') }}"
                        placeholder="e.g. Web Development A"
                        required
                    >

                </div>

                @error('group_name')

                    <span class="create-class-error">
                        {{ $message }}
                    </span>

                @enderror

            </div>


            {{-- ====================================================
                 COURSE
            ===================================================== --}}

            <div class="create-class-form-group">

                <label for="course_id">

                    Course

                    <span class="required">
                        *
                    </span>

                </label>

                <div class="create-class-input-wrapper">

                    <i class="bx bx-book"></i>

                    <select
                        id="course_id"
                        name="course_id"
                        required
                    >

                        <option value="">
                            Select a course
                        </option>

                        @foreach($courses as $course)

                            <option
                                value="{{ $course->id }}"
                                @selected(old('course_id') == $course->id)
                            >
                                {{ $course->course_name }}
                            </option>

                        @endforeach

                    </select>

                </div>

                @error('course_id')

                    <span class="create-class-error">
                        {{ $message }}
                    </span>

                @enderror

            </div>


            {{-- ====================================================
                 DESCRIPTION
            ===================================================== --}}

            <div class="create-class-form-group">

                <label for="description">

                    Description

                    <span class="optional">
                        Optional
                    </span>

                </label>

                <div class="create-class-textarea-wrapper">

                    <i class="bx bx-align-left"></i>

                    <textarea
                        id="description"
                        name="description"
                        rows="5"
                        placeholder="Add a short description about this class..."
                    >{{ old('description') }}</textarea>

                </div>

                @error('description')

                    <span class="create-class-error">
                        {{ $message }}
                    </span>

                @enderror

            </div>


            {{-- ====================================================
                 CLASS CODE INFORMATION
            ===================================================== --}}

            <div class="create-class-code-info">

                <div class="create-class-code-icon">

                    <i class="bx bx-key"></i>

                </div>

                <div>

                    <strong>
                        Class code
                    </strong>

                    <p>
                        A unique class code will be generated automatically
                        after you create this class.
                    </p>

                </div>

            </div>


            {{-- ====================================================
                 ACTIONS
            ===================================================== --}}

            <div class="create-class-actions">

                <a
                    href="{{ route('professor.class-groups.index') }}"
                    class="create-class-cancel"
                >
                    Cancel
                </a>


                <button
                    type="submit"
                    class="create-class-submit"
                >

                    <i class="bx bx-plus"></i>

                    Create Class

                </button>

            </div>

        </form>

    </div>

</div>

@endsection