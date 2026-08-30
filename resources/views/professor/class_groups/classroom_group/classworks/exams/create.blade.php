<style>
    /* ============================================================
   EXAM CREATE / EDIT PAGE
   ============================================================ */


/* ============================================================
   PAGE
   ============================================================ */

.exam-create-page {
    width: 100%;
    box-sizing: border-box;
}


/* ============================================================
   BACK BUTTON
   ============================================================ */

.exam-back-button {
    display: inline-flex;
    align-items: center;
    gap: 7px;

    width: fit-content;

    margin-bottom: 15px;
    padding: 9px 13px;

    color: var(--secondary-text-color);
    background-color: var(--card-color);

    border: 1px solid var(--border-color);
    border-radius: 9px;

    font-size: 12px;
    font-weight: 700;

    text-decoration: none;

    transition:
        color 0.2s ease,
        background-color 0.2s ease,
        border-color 0.2s ease,
        transform 0.2s ease;
}

.exam-back-button i {
    font-size: 16px;
}

.exam-back-button:hover {
    color: var(--button-color);

    background-color: var(--hover-color);

    border-color: var(--button-color);

    transform: translateX(-2px);
}


/* ============================================================
   HEADER
   ============================================================ */

.exam-create-header {
    position: relative;

    display: flex;
    align-items: center;
    justify-content: space-between;

    gap: 30px;

    width: 100%;
    min-height: 175px;

    padding: 28px 32px;

    margin-bottom: 20px;

    box-sizing: border-box;

    background-color: var(--card-color);

    border: 1px solid var(--border-color);
    border-radius: 15px;

    overflow: hidden;
}

.exam-create-header-content {
    display: flex;
    flex-direction: column;
    gap: 6px;

    position: relative;
    z-index: 2;
}

.exam-eyebrow {
    display: inline-block;

    width: fit-content;

    color: var(--button-color);

    font-size: 10px;
    font-weight: 800;

    letter-spacing: 1.4px;
}

.exam-create-header h1 {
    margin: 0;

    color: var(--heading-color);

    font-size: 25px;
    font-weight: 800;

    line-height: 1.2;
}

.exam-create-header p {
    margin: 0;

    color: var(--secondary-text-color);

    font-size: 13px;

    line-height: 1.5;
}


/* ============================================================
   HEADER ILLUSTRATION
   ============================================================ */

.exam-header-illustration {
    position: relative;

    width: 180px;
    height: 135px;

    flex-shrink: 0;
}

.exam-illustration-circle {
    position: absolute;

    width: 115px;
    height: 115px;

    top: 10px;
    left: 35px;

    background-color: var(--hover-color);

    border: 1px solid var(--border-color);

    border-radius: 50%;
}


/* ============================================================
   PAPER
   ============================================================ */

.exam-illustration-paper {
    position: absolute;

    z-index: 2;

    top: 20px;
    left: 55px;

    width: 72px;
    height: 90px;

    box-sizing: border-box;

    padding: 17px 12px;

    background-color: var(--card-color);

    border: 1px solid var(--border-color);

    border-radius: 7px;

    box-shadow:
        0 8px 18px rgba(0, 0, 0, 0.08);

    transform: rotate(-5deg);
}

.exam-paper-line {
    height: 4px;

    margin-bottom: 9px;

    background-color: var(--border-color);

    border-radius: 4px;
}

.exam-paper-line.line-one {
    width: 70%;
}

.exam-paper-line.line-two {
    width: 90%;
}

.exam-paper-line.line-three {
    width: 55%;
}

.exam-paper-check {
    display: flex;

    align-items: center;
    justify-content: center;

    width: 22px;
    height: 22px;

    margin-top: 3px;

    color: var(--button-color);

    background-color: var(--hover-color);

    border-radius: 50%;

    font-size: 14px;
}


/* ============================================================
   FLOATING ICONS
   ============================================================ */

.exam-illustration-icon {
    position: absolute;

    z-index: 3;

    display: flex;

    align-items: center;
    justify-content: center;

    width: 32px;
    height: 32px;

    color: var(--button-color);

    background-color: var(--card-color);

    border: 1px solid var(--border-color);

    border-radius: 9px;

    box-shadow:
        0 5px 12px rgba(0, 0, 0, 0.07);

    font-size: 17px;
}

.exam-pencil {
    top: 9px;
    right: 24px;

    transform: rotate(8deg);

    animation: examFloatOne 3s ease-in-out infinite;
}

.exam-warning {
    right: 7px;
    bottom: 17px;

    transform: rotate(-8deg);

    animation: examFloatTwo 3.4s ease-in-out infinite;
}


/* ============================================================
   ILLUSTRATION ANIMATION
   ============================================================ */

@keyframes examFloatOne {
    0%,
    100% {
        transform:
            translateY(0)
            rotate(8deg);
    }

    50% {
        transform:
            translateY(-5px)
            rotate(8deg);
    }
}

@keyframes examFloatTwo {
    0%,
    100% {
        transform:
            translateY(0)
            rotate(-8deg);
    }

    50% {
        transform:
            translateY(5px)
            rotate(-8deg);
    }
}


/* ============================================================
   FORM CARD
   ============================================================ */

.exam-form-card {
    width: 100%;

    box-sizing: border-box;

    padding: 24px;

    background-color: var(--card-color);

    border: 1px solid var(--border-color);

    border-radius: 15px;
}


/* ============================================================
   FORM SECTION
   ============================================================ */

.exam-form-section {
    padding-bottom: 24px;

    margin-bottom: 24px;

    border-bottom: 1px solid var(--border-color);
}

.exam-form-section:last-of-type {
    padding-bottom: 0;

    margin-bottom: 0;

    border-bottom: none;
}

.exam-form-section-header {
    margin-bottom: 20px;
}

.exam-form-eyebrow {
    display: block;

    margin-bottom: 4px;

    color: var(--button-color);

    font-size: 9px;
    font-weight: 800;

    letter-spacing: 1.2px;
}

.exam-form-section-header h2 {
    margin: 0;

    color: var(--heading-color);

    font-size: 17px;
    font-weight: 800;
}


/* ============================================================
   FORM GROUP
   ============================================================ */

.exam-form-group {
    display: flex;
    flex-direction: column;

    gap: 7px;

    margin-bottom: 18px;
}

.exam-form-group:last-child {
    margin-bottom: 0;
}


/* ============================================================
   LABEL
   ============================================================ */

.exam-form-group label {
    display: flex;
    align-items: center;

    gap: 7px;

    color: var(--heading-color);

    font-size: 12px;
    font-weight: 700;
}

.exam-optional-label {
    color: var(--secondary-text-color);

    font-size: 10px;
    font-weight: 500;
}


/* ============================================================
   INPUT / TEXTAREA / SELECT
   ============================================================ */

.exam-form-group input,
.exam-form-group textarea,
.exam-form-group select {
    width: 100%;

    box-sizing: border-box;

    padding: 11px 13px;

    color: var(--heading-color);

    background-color: var(--card-color);

    border: 1px solid var(--border-color);

    border-radius: 9px;

    outline: none;

    font-family: inherit;

    font-size: 12px;

    transition:
        border-color 0.2s ease,
        box-shadow 0.2s ease;
}

.exam-form-group input {
    height: 42px;
}

.exam-form-group textarea {
    min-height: 105px;

    resize: vertical;

    line-height: 1.5;
}

.exam-form-group select {
    height: 42px;

    cursor: pointer;
}

.exam-form-group input::placeholder,
.exam-form-group textarea::placeholder {
    color: var(--secondary-text-color);

    opacity: 0.65;
}

.exam-form-group input:focus,
.exam-form-group textarea:focus,
.exam-form-group select:focus {
    border-color: var(--button-color);

    box-shadow:
        0 0 0 3px rgba(0, 0, 0, 0.04);
}


/* ============================================================
   DATE / TIME
   ============================================================ */

.exam-form-row {
    display: grid;

    grid-template-columns: 1fr 1fr;

    gap: 15px;
}


/* ============================================================
   ATTACHMENT
   ============================================================ */

.exam-form-group input[type="file"] {
    height: auto;

    padding: 9px 11px;

    cursor: pointer;
}

.exam-form-group input[type="file"]::file-selector-button {
    margin-right: 10px;

    padding: 7px 11px;

    color: var(--heading-color);

    background-color: var(--hover-color);

    border: 1px solid var(--border-color);

    border-radius: 7px;

    font-family: inherit;

    font-size: 11px;
    font-weight: 600;

    cursor: pointer;

    transition:
        background-color 0.2s ease,
        border-color 0.2s ease;
}

.exam-form-group input[type="file"]::file-selector-button:hover {
    background-color: var(--card-color);

    border-color: var(--button-color);
}

.exam-form-help {
    color: var(--secondary-text-color);

    font-size: 10px;

    line-height: 1.4;
}


/* ============================================================
   CURRENT ATTACHMENT
   ============================================================ */

.exam-current-file {
    display: flex;
    align-items: center;

    gap: 11px;

    margin-bottom: 18px;

    padding: 12px 14px;

    background-color: var(--hover-color);

    border: 1px solid var(--border-color);

    border-radius: 9px;
}

.exam-current-file > i {
    display: flex;
    align-items: center;
    justify-content: center;

    width: 34px;
    height: 34px;

    flex-shrink: 0;

    color: var(--button-color);

    background-color: var(--card-color);

    border-radius: 8px;

    font-size: 17px;
}

.exam-current-file div {
    display: flex;
    flex-direction: column;

    gap: 2px;

    min-width: 0;
}

.exam-current-file strong {
    color: var(--heading-color);

    font-size: 11px;
}

.exam-current-file span {
    color: var(--secondary-text-color);

    max-width: 100%;

    overflow: hidden;

    text-overflow: ellipsis;

    white-space: nowrap;

    font-size: 10px;
}


/* ============================================================
   VALIDATION ERROR
   ============================================================ */

.exam-form-error {
    color: #dc2626;

    font-size: 10px;

    line-height: 1.4;
}


/* ============================================================
   ACTIONS
   ============================================================ */

.exam-form-actions {
    display: flex;

    align-items: center;
    justify-content: flex-end;

    gap: 10px;

    padding-top: 22px;
}


/* ============================================================
   CANCEL
   ============================================================ */

.exam-cancel-button {
    display: inline-flex;

    align-items: center;
    justify-content: center;

    min-width: 80px;
    height: 40px;

    padding: 0 15px;

    box-sizing: border-box;

    color: var(--secondary-text-color);

    background-color: transparent;

    border: 1px solid var(--border-color);

    border-radius: 9px;

    font-size: 12px;
    font-weight: 700;

    text-decoration: none;

    transition:
        color 0.2s ease,
        background-color 0.2s ease,
        border-color 0.2s ease;
}

.exam-cancel-button:hover {
    color: var(--heading-color);

    background-color: var(--hover-color);

    border-color: var(--border-color);
}


/* ============================================================
   SUBMIT
   ============================================================ */

.exam-submit-button {
    display: inline-flex;

    align-items: center;
    justify-content: center;

    gap: 7px;

    min-width: 120px;
    height: 40px;

    padding: 0 17px;

    box-sizing: border-box;

    color: #ffffff;

    background-color: var(--button-color);

    border: 1px solid var(--button-color);

    border-radius: 9px;

    font-family: inherit;

    font-size: 12px;
    font-weight: 700;

    cursor: pointer;

    transition:
        transform 0.2s ease,
        box-shadow 0.2s ease;
}

.exam-submit-button i {
    font-size: 16px;
}

.exam-submit-button:hover {
    transform: translateY(-1px);

    box-shadow:
        0 5px 14px rgba(0, 0, 0, 0.12);
}

.exam-submit-button:active {
    transform: translateY(0);
}


/* ============================================================
   RESPONSIVE
   ============================================================ */

@media (max-width: 700px) {

    .exam-create-header {
        min-height: auto;

        padding: 22px;
    }

    .exam-header-illustration {
        width: 140px;
        height: 115px;
    }

    .exam-illustration-circle {
        width: 95px;
        height: 95px;

        left: 20px;
    }

    .exam-illustration-paper {
        left: 40px;
    }

    .exam-form-card {
        padding: 20px;
    }

    .exam-form-row {
        grid-template-columns: 1fr;

        gap: 0;
    }
}


@media (max-width: 500px) {

    .exam-create-header {
        align-items: flex-start;
    }

    .exam-header-illustration {
        width: 75px;
        height: 75px;
    }

    .exam-illustration-circle {
        width: 65px;
        height: 65px;

        top: 0;
        left: 0;
    }

    .exam-illustration-paper {
        top: 5px;
        left: 8px;

        width: 45px;
        height: 58px;

        padding: 10px 7px;
    }

    .exam-paper-line {
        height: 3px;

        margin-bottom: 5px;
    }

    .exam-paper-check {
        width: 16px;
        height: 16px;

        font-size: 10px;
    }

    .exam-pencil {
        top: 0;
        right: 0;

        width: 25px;
        height: 25px;

        font-size: 13px;
    }

    .exam-warning {
        right: -2px;
        bottom: 0;

        width: 25px;
        height: 25px;

        font-size: 13px;
    }

    .exam-create-header h1 {
        font-size: 21px;
    }

    .exam-create-header p {
        font-size: 11px;
    }

    .exam-form-actions {
        flex-direction: column-reverse;

        align-items: stretch;
    }

    .exam-cancel-button,
    .exam-submit-button {
        width: 100%;
    }
}
</style>

@extends('layouts.prof_layout')

@section('title', 'Create Exam')

@section('content')

<div class="exam-create-page">

    {{-- ============================================================
         BACK TO CLASSWORK
         ============================================================ --}}

    <a
        href="{{ route(
            'professor.class-groups.classroom-group.classwork',
            ['classGroup' => $classGroup->id]
        ) }}"
        class="exam-back-button"
    >
        <i class="bx bx-arrow-back"></i>

        <span>
            Back to Classwork
        </span>
    </a>


    {{-- ============================================================
         HEADER
         ============================================================ --}}

    <section class="exam-create-header">

        <div class="exam-create-header-content">

            <span class="exam-eyebrow">
                CREATE EXAM
            </span>

            <h1>
                Create an Exam
            </h1>

            <p>
                Create an exam for
                {{ $classGroup->group_name }}.
            </p>

        </div>


        {{-- HEADER ILLUSTRATION --}}

        <div class="exam-header-illustration">

            <div class="exam-illustration-circle"></div>

            <div class="exam-illustration-paper">

                <div class="exam-paper-line line-one"></div>

                <div class="exam-paper-line line-two"></div>

                <div class="exam-paper-line line-three"></div>

                <div class="exam-paper-check">
                    <i class="bx bx-check"></i>
                </div>

            </div>

            <div class="exam-illustration-icon exam-pencil">
                <i class="bx bx-edit"></i>
            </div>

            <div class="exam-illustration-icon exam-warning">
                <i class="bx bx-error-circle"></i>
            </div>

        </div>

    </section>


    {{-- ============================================================
         FORM CARD
         ============================================================ --}}

    <section class="exam-form-card">

        <form
            action="{{ route(
                'professor.class-groups.exams.store',
                ['classGroup' => $classGroup->id]
            ) }}"
            method="POST"
            enctype="multipart/form-data"
        >

            @csrf


            {{-- ====================================================
                 EXAM INFORMATION
                 ==================================================== --}}

            <div class="exam-form-section">

                <div class="exam-form-section-header">

                    <span class="exam-form-eyebrow">
                        EXAM INFORMATION
                    </span>

                    <h2>
                        Basic Information
                    </h2>

                </div>


                {{-- TITLE --}}

                <div class="exam-form-group">

                    <label for="title">
                        Exam Title
                    </label>

                    <input
                        type="text"
                        id="title"
                        name="title"
                        value="{{ old('title') }}"
                        placeholder="Enter exam title"
                        required
                    >

                    @error('title')
                        <span class="exam-form-error">
                            {{ $message }}
                        </span>
                    @enderror

                </div>


                {{-- DESCRIPTION --}}

                <div class="exam-form-group">

                    <label for="description">
                        Description
                    </label>

                    <textarea
                        id="description"
                        name="description"
                        rows="4"
                        placeholder="Enter exam instructions or description..."
                    >{{ old('description') }}</textarea>

                    @error('description')
                        <span class="exam-form-error">
                            {{ $message }}
                        </span>
                    @enderror

                </div>


                {{-- TOPIC --}}

                <div class="exam-form-group">

                    <label for="topic_id">

                        Topic

                        <span class="exam-optional-label">
                            Optional
                        </span>

                    </label>

                    <select
                        id="topic_id"
                        name="topic_id"
                    >

                        <option value="">
                            No topic
                        </option>

                        @foreach($classGroup->topics as $topic)

                            <option
                                value="{{ $topic->id }}"
                                @selected(
                                    old('topic_id') == $topic->id
                                )
                            >
                                {{ $topic->topic_name }}
                            </option>

                        @endforeach

                    </select>

                    @error('topic_id')
                        <span class="exam-form-error">
                            {{ $message }}
                        </span>
                    @enderror

                </div>

            </div>


            {{-- ====================================================
                 EXAM SETTINGS
                 ==================================================== --}}

            <div class="exam-form-section">

                <div class="exam-form-section-header">

                    <span class="exam-form-eyebrow">
                        EXAM SETTINGS
                    </span>

                    <h2>
                        Schedule & Points
                    </h2>

                </div>


                <div class="exam-form-row">

                    {{-- DUE DATE --}}

                    <div class="exam-form-group">

                        <label for="due_date">

                            Due Date

                            <span class="exam-optional-label">
                                Optional
                            </span>

                        </label>

                        <input
                            type="date"
                            id="due_date"
                            name="due_date"
                            value="{{ old('due_date') }}"
                        >

                        @error('due_date')
                            <span class="exam-form-error">
                                {{ $message }}
                            </span>
                        @enderror

                    </div>


                    {{-- DUE TIME --}}

                    <div class="exam-form-group">

                        <label for="due_time">

                            Due Time

                            <span class="exam-optional-label">
                                Optional
                            </span>

                        </label>

                        <input
                            type="time"
                            id="due_time"
                            name="due_time"
                            value="{{ old('due_time') }}"
                        >

                        @error('due_time')
                            <span class="exam-form-error">
                                {{ $message }}
                            </span>
                        @enderror

                    </div>

                </div>


                {{-- POINTS --}}

                <div class="exam-form-group">

                    <label for="points">

                        Points

                        <span class="exam-optional-label">
                            Optional
                        </span>

                    </label>

                    <input
                        type="number"
                        id="points"
                        name="points"
                        value="{{ old('points') }}"
                        min="0"
                        step="0.01"
                        placeholder="e.g. 100"
                    >

                    @error('points')
                        <span class="exam-form-error">
                            {{ $message }}
                        </span>
                    @enderror

                </div>

            </div>


            {{-- ====================================================
                 ATTACHMENT
                 ==================================================== --}}

            <div class="exam-form-section">

                <div class="exam-form-section-header">

                    <span class="exam-form-eyebrow">
                        RESOURCES
                    </span>

                    <h2>
                        Attachment
                    </h2>

                </div>


                <div class="exam-form-group">

                    <label for="attachment">

                        Exam Attachment

                        <span class="exam-optional-label">
                            Optional
                        </span>

                    </label>

                    <input
                        type="file"
                        id="attachment"
                        name="attachment"
                    >

                    <small class="exam-form-help">
                        Attach instructions, reference material,
                        or another file related to the exam.
                    </small>

                    @error('attachment')
                        <span class="exam-form-error">
                            {{ $message }}
                        </span>
                    @enderror

                </div>

            </div>


            {{-- ====================================================
                 ACTIONS
                 ==================================================== --}}

            <div class="exam-form-actions">

                <a
                    href="{{ route(
                        'professor.class-groups.classroom-group.classwork',
                        ['classGroup' => $classGroup->id]
                    ) }}"
                    class="exam-cancel-button"
                >
                    Cancel
                </a>

                <button
                    type="submit"
                    class="exam-submit-button"
                >

                    <i class="bx bx-plus"></i>

                    Create Exam

                </button>

            </div>

        </form>

    </section>

</div>

@endsection