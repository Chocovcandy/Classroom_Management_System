<style>

    /* ============================================================
   QUIZ CREATE / EDIT PAGE
   ============================================================ */


/* ============================================================
   PAGE
   ============================================================ */

.quiz-create-page {

    width: 100%;

    box-sizing: border-box;

}


/* ============================================================
   HEADER
   ============================================================ */

.quiz-create-header {

    display: flex;

    align-items: center;

    justify-content: space-between;

    gap: 30px;

    width: 100%;

    min-height: 170px;

    padding: 28px 32px;

    box-sizing: border-box;

    margin-bottom: 20px;

    background-color: var(--card-color);

    border: 1px solid var(--border-color);

    border-radius: 15px;

    overflow: hidden;

}


.quiz-create-header-content {

    display: flex;

    flex-direction: column;

    gap: 6px;

}


.quiz-eyebrow {

    display: inline-block;

    width: fit-content;

    color: var(--button-color);

    font-size: 10px;

    font-weight: 800;

    letter-spacing: 1.4px;

}


.quiz-create-header h1 {

    margin: 0;

    color: var(--heading-color);

    font-size: 25px;

    font-weight: 800;

    line-height: 1.2;

}


.quiz-create-header p {

    margin: 0;

    color: var(--secondary-text-color);

    font-size: 13px;

    line-height: 1.5;

}


/* ============================================================
   HEADER ICON
   ============================================================ */

.quiz-create-header-icon {

    display: flex;

    align-items: center;

    justify-content: center;

    width: 90px;

    height: 90px;

    flex-shrink: 0;

    color: var(--button-color);

    background-color: var(--hover-color);

    border: 1px solid var(--border-color);

    border-radius: 50%;

    font-size: 42px;

}


.quiz-create-header-icon i {

    animation: quizIconFloat 3s ease-in-out infinite;

}


@keyframes quizIconFloat {

    0%,
    100% {

        transform: translateY(0);

    }

    50% {

        transform: translateY(-5px);

    }

}


/* ============================================================
   FORM CARD
   ============================================================ */

.quiz-form-card {

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

.quiz-form-section {

    padding-bottom: 24px;

    margin-bottom: 24px;

    border-bottom: 1px solid var(--border-color);

}


.quiz-form-section:last-of-type {

    padding-bottom: 0;

    margin-bottom: 0;

    border-bottom: none;

}


.quiz-form-section-header {

    display: flex;

    align-items: center;

    justify-content: space-between;

    margin-bottom: 20px;

}


.quiz-form-eyebrow {

    display: block;

    margin-bottom: 4px;

    color: var(--button-color);

    font-size: 9px;

    font-weight: 800;

    letter-spacing: 1.2px;

}


.quiz-form-section-header h2 {

    margin: 0;

    color: var(--heading-color);

    font-size: 17px;

    font-weight: 800;

}


/* ============================================================
   FORM GROUP
   ============================================================ */

.form-group {

    display: flex;

    flex-direction: column;

    gap: 7px;

    margin-bottom: 18px;

}


.form-group:last-child {

    margin-bottom: 0;

}


/* ============================================================
   LABEL
   ============================================================ */

.form-group label {

    display: flex;

    align-items: center;

    gap: 7px;

    color: var(--heading-color);

    font-size: 12px;

    font-weight: 700;

}


.optional-label {

    color: var(--secondary-text-color);

    font-size: 10px;

    font-weight: 500;

}


/* ============================================================
   INPUTS
   ============================================================ */

.form-group input,
.form-group textarea,
.form-group select {

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
        box-shadow 0.2s ease,
        background-color 0.2s ease;

}


.form-group input {

    height: 42px;

}


.form-group textarea {

    min-height: 105px;

    resize: vertical;

    line-height: 1.5;

}


.form-group select {

    height: 42px;

    cursor: pointer;

}


.form-group input::placeholder,
.form-group textarea::placeholder {

    color: var(--secondary-text-color);

    opacity: 0.65;

}


.form-group input:focus,
.form-group textarea:focus,
.form-group select:focus {

    border-color: var(--button-color);

    box-shadow:
        0 0 0 3px rgba(0, 0, 0, 0.04);

}


/* ============================================================
   DATE / TIME ROW
   ============================================================ */

.form-row {

    display: grid;

    grid-template-columns: 1fr 1fr;

    gap: 15px;

}

/* ============================================================
   ATTACHMENT
   ============================================================ */

.form-help {

    color: var(--secondary-text-color);

    font-size: 10px;

    line-height: 1.4;

}


.form-group input[type="file"] {

    height: auto;

    padding: 9px 11px;

    cursor: pointer;

}


.form-group input[type="file"]::file-selector-button {

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


.form-group input[type="file"]::file-selector-button:hover {

    background-color: var(--card-color);

    border-color: var(--button-color);

}
/* ============================================================
   VALIDATION ERROR
   ============================================================ */

.form-error {

    color: #dc2626;

    font-size: 10px;

    line-height: 1.4;

}


/* ============================================================
   FORM ACTIONS
   ============================================================ */

.quiz-form-actions {

    display: flex;

    align-items: center;

    justify-content: flex-end;

    gap: 10px;

    padding-top: 22px;

}


/* ============================================================
   CANCEL
   ============================================================ */

.quiz-cancel-button {

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


.quiz-cancel-button:hover {

    color: var(--heading-color);

    background-color: var(--hover-color);

    border-color: var(--border-color);

}


/* ============================================================
   SUBMIT BUTTON
   ============================================================ */

.quiz-submit-button {

    display: inline-flex;

    align-items: center;

    justify-content: center;

    gap: 7px;

    min-width: 125px;

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
        box-shadow 0.2s ease,
        opacity 0.2s ease;

}


.quiz-submit-button i {

    font-size: 16px;

}


.quiz-submit-button:hover {

    transform: translateY(-1px);

    box-shadow:
        0 5px 14px rgba(0, 0, 0, 0.12);

}


.quiz-submit-button:active {

    transform: translateY(0);

}


/* ============================================================
   BACK BUTTON
   ============================================================ */

.quiz-create-page .back-button {

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


.quiz-create-page .back-button i {

    font-size: 16px;

}


.quiz-create-page .back-button:hover {

    color: var(--button-color);

    background-color: var(--hover-color);

    border-color: var(--button-color);

    transform: translateX(-2px);

}


/* ============================================================
   RESPONSIVE
   ============================================================ */

@media (max-width: 700px) {

    .quiz-create-header {

        min-height: auto;

        padding: 22px;

    }


    .quiz-create-header-icon {

        width: 70px;

        height: 70px;

        font-size: 32px;

    }


    .quiz-form-card {

        padding: 20px;

    }


    .form-row {

        grid-template-columns: 1fr;

        gap: 0;

    }

}


@media (max-width: 500px) {

    .quiz-create-header {

        align-items: flex-start;

    }


    .quiz-create-header-icon {

        width: 55px;

        height: 55px;

        font-size: 25px;

    }


    .quiz-create-header h1 {

        font-size: 21px;

    }


    .quiz-create-header p {

        font-size: 11px;

    }


    .quiz-form-actions {

        flex-direction: column-reverse;

        align-items: stretch;

    }


    .quiz-cancel-button,
    .quiz-submit-button {

        width: 100%;

    }

}
</style>

@extends('layouts.prof_layout')

@section('title', 'Create Quiz')

@section('content')

<div class="quiz-create-page">

    {{-- ============================================================
         BACK TO CLASSWORK
         ============================================================ --}}

    <a
        href="{{ route(
            'professor.class-groups.classroom-group.classwork',
            ['classGroup' => $classGroup->id]
        ) }}"
        class="back-button"
    >

        <i class="bx bx-arrow-back"></i>

        <span>
            Back to Classwork
        </span>

    </a>


    {{-- ============================================================
         HEADER
         ============================================================ --}}

    <section class="quiz-create-header">

        <div class="quiz-create-header-content">

            <span class="quiz-eyebrow">
                CREATE QUIZ
            </span>

            <h1>
                Create a Quiz
            </h1>

            <p>
                Create a quiz for
                {{ $classGroup->group_name }}.
            </p>

        </div>


        {{-- HEADER ICON --}}

        <div class="quiz-create-header-icon">

            <i class="bx bx-help-circle"></i>

        </div>

    </section>


    {{-- ============================================================
         FORM CARD
         ============================================================ --}}

    <section class="quiz-form-card">

        <form
            action="{{ route(
                'professor.class-groups.quizzes.store',
                ['classGroup' => $classGroup->id]
            ) }}"
             method="POST"
    enctype="multipart/form-data"

        >

            @csrf


            {{-- ====================================================
                 QUIZ INFORMATION
                 ==================================================== --}}

            <div class="quiz-form-section">

                <div class="quiz-form-section-header">

                    <div>

                        <span class="quiz-form-eyebrow">
                            QUIZ INFORMATION
                        </span>

                        <h2>
                            Basic Information
                        </h2>

                    </div>

                </div>


                {{-- TITLE --}}

                <div class="form-group">

                    <label for="title">
                        Quiz Title
                    </label>

                    <input
                        type="text"
                        id="title"
                        name="title"
                        value="{{ old('title') }}"
                        placeholder="Enter quiz title"
                        required
                    >

                    @error('title')

                        <span class="form-error">
                            {{ $message }}
                        </span>

                    @enderror

                </div>


                {{-- DESCRIPTION --}}

                <div class="form-group">

                    <label for="description">
                        Description
                    </label>

                    <textarea
                        id="description"
                        name="description"
                        rows="4"
                        placeholder="Describe the quiz or provide instructions..."
                    >{{ old('description') }}</textarea>

                    @error('description')

                        <span class="form-error">
                            {{ $message }}
                        </span>

                    @enderror

                </div>


                {{-- TOPIC --}}

                <div class="form-group">

                    <label for="topic_id">

                        Topic

                        <span class="optional-label">
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

                        <span class="form-error">
                            {{ $message }}
                        </span>

                    @enderror

                </div>

            </div>


            {{-- ====================================================
                 QUIZ SETTINGS
                 ==================================================== --}}

            <div class="quiz-form-section">

                <div class="quiz-form-section-header">

                    <div>

                        <span class="quiz-form-eyebrow">
                            QUIZ SETTINGS
                        </span>

                        <h2>
                            Schedule & Points
                        </h2>

                    </div>

                </div>


                {{-- DATE + TIME --}}

                <div class="form-row">

                    {{-- DUE DATE --}}

                    <div class="form-group">

                        <label for="due_date">

                            Due Date

                            <span class="optional-label">
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

                            <span class="form-error">
                                {{ $message }}
                            </span>

                        @enderror

                    </div>


                    {{-- DUE TIME --}}

                    <div class="form-group">

                        <label for="due_time">

                            Due Time

                            <span class="optional-label">
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

                            <span class="form-error">
                                {{ $message }}
                            </span>

                        @enderror

                    </div>

                </div>


                {{-- POINTS --}}

                <div class="form-group">

                    <label for="points">

                        Points

                        <span class="optional-label">
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
                        placeholder="e.g. 20"
                    >

                    @error('points')

                        <span class="form-error">
                            {{ $message }}
                        </span>

                    @enderror

                </div>

                                {{-- ====================================================
                    ATTACHMENT
                    ==================================================== --}}

                <div class="form-group">

                    <label for="attachment">

                        Attachment

                        <span class="optional-label">
                            Optional
                        </span>

                    </label>

                    <input
                        type="file"
                        id="attachment"
                        name="attachment"
                    >

                    <small class="form-help">
                        Attach a file or resource related to this quiz.
                    </small>

                    @error('attachment')

                        <span class="form-error">
                            {{ $message }}
                        </span>

                    @enderror

                </div>

            </div>


            {{-- ====================================================
                 FORM ACTIONS
                 ==================================================== --}}

            <div class="quiz-form-actions">

                <a
                    href="{{ route(
                        'professor.class-groups.classroom-group.classwork',
                        ['classGroup' => $classGroup->id]
                    ) }}"
                    class="quiz-cancel-button"
                >
                    Cancel
                </a>


                <button
                    type="submit"
                    class="quiz-submit-button"
                >

                    <i class="bx bx-plus"></i>

                    Create Quiz

                </button>

            </div>

        </form>

    </section>

</div>

@endsection