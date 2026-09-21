@extends('layouts.prof_layout')

@section('title', 'Create Quiz')

@section('content')

<style>
/* ============================================================
   QUIZ CREATE PAGE
   Self-contained styling
   ============================================================ */

.quiz-create-page {
--quiz-purple: #7c3aed;
--quiz-purple-dark: #6d28d9;
--quiz-purple-light: #f5f3ff;
--quiz-purple-border: #ddd6fe;
    --quiz-text: #172033;
    --quiz-text-secondary: #64748b;
    --quiz-text-muted: #94a3b8;

    --quiz-border: #e2e8f0;
    --quiz-border-light: #edf1f5;

    --quiz-bg: #f7f9fc;
    --quiz-card: #ffffff;

    --quiz-green: #16a34a;
    --quiz-green-light: #f0fdf4;

    --quiz-danger: #dc2626;
    --quiz-danger-light: #fef2f2;

    min-height: calc(100vh - 70px);
    background: var(--quiz-bg);
    color: var(--quiz-text);

    font-family: inherit;
    font-size: 15px;

    padding-bottom: 50px;
}


/* ============================================================
   HEADER
   ============================================================ */

.quiz-create-header {
    background: transparent;
    border: 0;
}

.quiz-header-inner {
    width: min(1420px, calc(100% - 48px));
    margin: 0 auto;

    min-height: auto;
    padding: 34px 0 4px;

    display: flex;
    align-items: center;
    justify-content: space-between;

    gap: 30px;
}

.quiz-header-main {
    display: flex;
    align-items: center;
    gap: 18px;
    min-width: 0;
}

.quiz-back-btn {
    width: 44px;
    height: 44px;

    flex: 0 0 44px;

    display: flex;
    align-items: center;
    justify-content: center;

    border: 1px solid var(--quiz-border);
    border-radius: 12px;

    background: #ffffff;
    color: #475569;

    text-decoration: none;

    font-size: 21px;

    transition:
        background .2s ease,
        color .2s ease,
        border-color .2s ease,
        transform .2s ease;
}

.quiz-back-btn:hover {
    background: var(--quiz-purple-light);
    color: var(--quiz-purple);
    border-color: var(--quiz-purple-border);
    transform: translateX(-2px);
}

.quiz-header-label {
    display: block;

    margin-bottom: 5px;

    color: var(--quiz-text-secondary);

    font-size: 13px;
    font-weight: 600;

    letter-spacing: .02em;
}

.quiz-title-row {
    display: flex;
    align-items: center;
    gap: 11px;
}

.quiz-title-mark {
    width: 5px;
    height: 31px;

    border-radius: 999px;

    background: var(--quiz-purple);
}

.quiz-header-title {
    margin: 0;

    color: var(--quiz-text);

    font-size: 34px;
    line-height: 1.15;
    font-weight: 750;

    letter-spacing: -.02em;
}

.quiz-header-subtitle {
    margin: 8px 0 0;

    color: var(--quiz-text-secondary);

    font-size: 16px;
    line-height: 1.5;
}

.quiz-header-badge {
    display: inline-flex;
    align-items: center;
    gap: 7px;

    padding: 9px 14px;

    border: 1px solid var(--quiz-purple-border);
    border-radius: 999px;

    background: var(--quiz-purple-light);
    color: var(--quiz-purple-dark);

    font-size: 13px;
    font-weight: 700;

    white-space: nowrap;
}

.quiz-header-badge i {
    font-size: 18px;
}


/* ============================================================
   MAIN LAYOUT
   ============================================================ */

.quiz-create-layout {
    width: min(1420px, calc(100% - 48px));
    margin: 22px auto 0;

    display: grid;
    grid-template-columns: minmax(0, 1fr) 340px;

    align-items: start;
    gap: 26px;
}

.quiz-create-main {
    min-width: 0;
}


/* ============================================================
   FORM SECTIONS
   ============================================================ */

.quiz-section {
    margin-bottom: 22px;

    overflow: hidden;

    background: var(--quiz-card);

    border: 1px solid var(--quiz-border);
    border-radius: 16px;

    box-shadow:
        0 2px 8px rgba(15, 23, 42, .035);
}

.quiz-section-header {
    display: flex;
    align-items: center;

    gap: 14px;

    padding: 21px 24px;

    border-bottom: 1px solid var(--quiz-border-light);
}

.quiz-section-icon {
    width: 42px;
    height: 42px;

    flex: 0 0 42px;

    display: flex;
    align-items: center;
    justify-content: center;

    border-radius: 12px;

    background: var(--quiz-purple-light);
    color: var(--quiz-purple);

    font-size: 21px;
}

.quiz-section-heading {
    min-width: 0;
}

.quiz-section-heading h2 {
    margin: 0;

    color: var(--quiz-text);

    font-size: 19px;
    line-height: 1.3;
    font-weight: 700;
}

.quiz-section-heading p {
    margin: 4px 0 0;

    color: var(--quiz-text-secondary);

    font-size: 14px;
    line-height: 1.45;
}

.quiz-section-body {
    padding: 24px;
}


/* ============================================================
   FORM
   ============================================================ */

.quiz-form-group {
    margin-bottom: 22px;
}

.quiz-form-group:last-child {
    margin-bottom: 0;
}

.quiz-form-row {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 18px;
}

.quiz-field-label {
    display: flex;
    align-items: center;
    gap: 7px;

    margin-bottom: 8px;

    color: var(--quiz-text);

    font-size: 15px;
    line-height: 1.4;
    font-weight: 650;
}

.quiz-optional {
    display: inline-flex;
    align-items: center;

    padding: 3px 7px;

    border-radius: 6px;

    background: #f1f5f9;
    color: #64748b;

    font-size: 11px;
    font-weight: 600;
}

.quiz-input,
.quiz-select,
.quiz-textarea {
    width: 100%;

    box-sizing: border-box;

    border: 1px solid #d8e0ea;
    border-radius: 10px;

    background: #ffffff;
    color: var(--quiz-text);

    font-family: inherit;
    font-size: 16px;

    outline: none;

    transition:
        border-color .2s ease,
        box-shadow .2s ease,
        background .2s ease;
}

.quiz-input,
.quiz-select {
    height: 50px;
    padding: 0 14px;
}

.quiz-textarea {
    min-height: 145px;

    padding: 13px 14px;

    resize: vertical;

    line-height: 1.7;
}

.quiz-input::placeholder,
.quiz-textarea::placeholder {
    color: #a3afbf;
}

.quiz-input:hover,
.quiz-select:hover,
.quiz-textarea:hover {
    border-color: #b9c5d4;
}

.quiz-input:focus,
.quiz-select:focus,
.quiz-textarea:focus {
    border-color: var(--quiz-purple);

    box-shadow:
        0 0 0 3px rgba(124, 58, 237, .10);
}

.quiz-help {
    display: flex;
    align-items: flex-start;
    gap: 6px;

    margin-top: 8px;

    color: var(--quiz-text-secondary);

    font-size: 13px;
    line-height: 1.5;
}

.quiz-help i {
    flex: 0 0 auto;

    margin-top: 2px;

    color: var(--quiz-purple);

    font-size: 16px;
}

.quiz-error {
    display: block;

    margin-top: 7px;

    color: var(--quiz-danger);

    font-size: 14px;
    line-height: 1.4;
}


/* ============================================================
   GOOGLE FORM
   ============================================================ */

.quiz-google-box {
    padding: 18px;

    border: 1px solid var(--quiz-purple-border);
    border-radius: 13px;

    background: #f8fbff;
}

.quiz-google-heading {
    display: flex;
    align-items: center;

    gap: 12px;

    margin-bottom: 20px;
}

.quiz-google-icon {
    width: 42px;
    height: 42px;

    flex: 0 0 42px;

    display: flex;
    align-items: center;
    justify-content: center;

    border-radius: 11px;

    background: #ffffff;
    color: var(--quiz-purple);

    border: 1px solid var(--quiz-purple-border);

    font-size: 20px;
}

.quiz-google-heading strong {
    display: block;

    color: var(--quiz-text);

    font-size: 16px;
    font-weight: 700;
}

.quiz-google-heading span {
    display: block;

    margin-top: 3px;

    color: var(--quiz-text-secondary);

    font-size: 13px;
    line-height: 1.45;
}


/* ============================================================
   UPLOAD AREA
   ============================================================ */

.quiz-upload-area {
    position: relative;

    min-height: 220px;

    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;

    padding: 30px;

    border: 1.5px dashed #b8c7da;
    border-radius: 14px;

    background: #fbfcfe;

    text-align: center;

    cursor: pointer;

    transition:
        border-color .2s ease,
        background .2s ease,
        box-shadow .2s ease;
}

.quiz-upload-area:hover {
    border-color: var(--quiz-purple);

    background: #f8fbff;

    box-shadow:
        0 4px 16px rgba(124, 58, 237, .06);
}

.quiz-upload-icon {
    width: 58px;
    height: 58px;

    display: flex;
    align-items: center;
    justify-content: center;

    margin-bottom: 13px;

    border-radius: 15px;

    background: var(--quiz-purple-light);
    color: var(--quiz-purple);

    font-size: 29px;
}

.quiz-upload-title {
    display: block;

    color: var(--quiz-text);

    font-size: 16px;
    font-weight: 700;
}

.quiz-upload-subtitle {
    max-width: 500px;

    display: block;

    margin-top: 6px;

    color: var(--quiz-text-secondary);

    font-size: 13px;
    line-height: 1.55;
}

.quiz-upload-button {
    display: inline-flex;
    align-items: center;
    gap: 7px;

    margin-top: 16px;

    padding: 9px 14px;

    border-radius: 9px;

    background: var(--quiz-purple);
    color: #ffffff;

    font-size: 14px;
    font-weight: 650;

    transition: background .2s ease;
}

.quiz-upload-area:hover .quiz-upload-button {
    background: var(--quiz-purple-dark);
}

.quiz-upload-input {
    position: absolute;

    width: 1px;
    height: 1px;

    opacity: 0;

    pointer-events: none;
}


/* ============================================================
   SELECTED FILES
   ============================================================ */

.quiz-selected-files {
    display: flex;
    flex-direction: column;
    gap: 9px;

    margin-top: 14px;
}

.quiz-selected-file {
    display: flex;
    align-items: center;

    gap: 11px;

    padding: 12px 13px;

    border: 1px solid var(--quiz-border);
    border-radius: 10px;

    background: #ffffff;
}

.quiz-selected-file > i {
    width: 36px;
    height: 36px;

    flex: 0 0 36px;

    display: flex;
    align-items: center;
    justify-content: center;

    border-radius: 9px;

    background: var(--quiz-purple-light);
    color: var(--quiz-purple);

    font-size: 19px;
}

.quiz-selected-file-info {
    min-width: 0;
    flex: 1;
}

.quiz-selected-file-info strong {
    display: block;

    overflow: hidden;

    color: var(--quiz-text);

    font-size: 14px;
    font-weight: 650;

    text-overflow: ellipsis;
    white-space: nowrap;
}

.quiz-selected-file-info span {
    display: block;

    margin-top: 2px;

    color: var(--quiz-text-muted);

    font-size: 12px;
}

.quiz-selected-file-remove {
    width: 34px;
    height: 34px;

    flex: 0 0 34px;

    display: flex;
    align-items: center;
    justify-content: center;

    border: 0;
    border-radius: 8px;

    background: var(--quiz-danger-light);
    color: var(--quiz-danger);

    cursor: pointer;

    font-size: 17px;

    transition:
        background .2s ease,
        color .2s ease;
}

.quiz-selected-file-remove:hover {
    background: #fee2e2;
    color: #b91c1c;
}


/* ============================================================
   SIDEBAR
   ============================================================ */

.quiz-create-sidebar {
    position: sticky;
    top: 20px;

    min-width: 0;
}

.quiz-sidebar-card {
    overflow: hidden;

    background: #ffffff;

    border: 1px solid var(--quiz-border);
    border-radius: 16px;

    box-shadow:
        0 2px 8px rgba(15, 23, 42, .035);
}

.quiz-sidebar-header {
    display: flex;
    align-items: center;

    gap: 12px;

    padding: 20px;

    border-bottom: 1px solid var(--quiz-border-light);
}

.quiz-sidebar-header-icon {
    width: 40px;
    height: 40px;

    flex: 0 0 40px;

    display: flex;
    align-items: center;
    justify-content: center;

    border-radius: 11px;

    background: var(--quiz-purple-light);
    color: var(--quiz-purple);

    font-size: 20px;
}

.quiz-sidebar-header h3 {
    margin: 0;

    color: var(--quiz-text);

    font-size: 17px;
    font-weight: 700;
}

.quiz-sidebar-header p {
    margin: 3px 0 0;

    color: var(--quiz-text-secondary);

    font-size: 13px;
    line-height: 1.4;
}

.quiz-sidebar-body {
    padding: 8px 20px 16px;
}

.quiz-summary-row {
    display: flex;
    align-items: flex-start;
    justify-content: space-between;

    gap: 18px;

    padding: 14px 0;

    border-bottom: 1px solid var(--quiz-border-light);
}

.quiz-summary-row:last-child {
    border-bottom: 0;
}

.quiz-summary-label {
    color: var(--quiz-text-secondary);

    font-size: 13px;
    font-weight: 550;
}

.quiz-summary-value {
    max-width: 175px;

    color: var(--quiz-text);

    font-size: 14px;
    font-weight: 650;

    text-align: right;

    overflow-wrap: anywhere;
}

.quiz-sidebar-help {
    margin: 4px 20px 20px;

    padding: 15px;

    border-radius: 11px;

    background: #f8fafc;

    border: 1px solid var(--quiz-border-light);
}

.quiz-sidebar-help-title {
    display: flex;
    align-items: center;
    gap: 7px;

    margin-bottom: 9px;

    color: var(--quiz-text);

    font-size: 14px;
    font-weight: 700;
}

.quiz-sidebar-help-title i {
    color: var(--quiz-purple);
    font-size: 17px;
}

.quiz-sidebar-help ul {
    margin: 0;
    padding-left: 19px;
}

.quiz-sidebar-help li {
    margin-bottom: 6px;

    color: var(--quiz-text-secondary);

    font-size: 13px;
    line-height: 1.45;
}

.quiz-sidebar-help li:last-child {
    margin-bottom: 0;
}


/* ============================================================
   ACTIONS
   ============================================================ */

.quiz-actions {
    display: grid;
    grid-template-columns: 1fr 1.35fr;

    gap: 10px;

    padding: 18px 20px;

    border-top: 1px solid var(--quiz-border-light);
}

.quiz-cancel-button,
.quiz-submit-button {
    min-height: 46px;

    display: inline-flex;
    align-items: center;
    justify-content: center;

    gap: 7px;

    padding: 0 15px;

    border-radius: 10px;

    font-family: inherit;
    font-size: 14px;
    font-weight: 700;

    text-decoration: none;

    cursor: pointer;

    transition:
        background .2s ease,
        border-color .2s ease,
        color .2s ease,
        transform .2s ease;
}

.quiz-cancel-button {
    border: 1px solid var(--quiz-border);

    background: #ffffff;
    color: #475569;
}

.quiz-cancel-button:hover {
    border-color: #cbd5e1;

    background: #f8fafc;

    color: var(--quiz-text);
}

.quiz-submit-button {
    border: 1px solid var(--quiz-purple);

    background: var(--quiz-purple);
    color: #ffffff;
}

.quiz-submit-button:hover {
    background: var(--quiz-purple-dark);
    border-color: var(--quiz-purple-dark);

    transform: translateY(-1px);
}

.quiz-submit-button i {
    font-size: 18px;
}


/* ============================================================
   RESPONSIVE
   ============================================================ */

@media (max-width: 1050px) {

    .quiz-create-layout {
        grid-template-columns: 1fr;
    }

    .quiz-create-sidebar {
        position: static;
    }

    .quiz-sidebar-card {
        max-width: none;
    }
}


@media (max-width: 720px) {

    .quiz-header-inner {
        width: min(100% - 30px, 1420px);

        min-height: auto;

        align-items: flex-start;

        padding: 24px 0 4px;
    }

    .quiz-header-badge {
        display: none;
    }

    .quiz-create-layout {
        width: min(100% - 30px, 1420px);

        margin-top: 18px;
    }

    .quiz-header-title {
        font-size: 28px;
    }

    .quiz-header-subtitle {
        font-size: 14px;
    }

    .quiz-section-header {
        padding: 18px;
    }

    .quiz-section-body {
        padding: 18px;
    }

    .quiz-form-row {
        grid-template-columns: 1fr;
        gap: 0;
    }
}


@media (max-width: 500px) {

    .quiz-create-page {
        padding-bottom: 25px;
    }

    .quiz-header-main {
        gap: 12px;
    }

    .quiz-back-btn {
        width: 40px;
        height: 40px;
        flex-basis: 40px;
    }

    .quiz-header-label {
        font-size: 12px;
    }

    .quiz-header-title {
        font-size: 25px;
    }

    .quiz-header-subtitle {
        font-size: 13px;
    }

    .quiz-title-mark {
        height: 26px;
        width: 4px;
    }

    .quiz-section {
        border-radius: 13px;
    }

    .quiz-section-header {
        gap: 11px;
    }

    .quiz-section-icon {
        width: 38px;
        height: 38px;
        flex-basis: 38px;
        font-size: 19px;
    }

    .quiz-section-heading h2 {
        font-size: 17px;
    }

    .quiz-section-heading p {
        font-size: 13px;
    }

    .quiz-input,
    .quiz-select {
        height: 48px;
    }

    .quiz-actions {
        grid-template-columns: 1fr;
    }

    .quiz-upload-area {
        min-height: 190px;
        padding: 24px 15px;
    }
}
</style>


<div class="quiz-create-page">

    {{-- ============================================================
         HEADER
    ============================================================= --}}

    <header class="quiz-create-header">

        <div class="quiz-header-inner">

            <div class="quiz-header-main">

                <a
                    href="{{ route(
                        'professor.class-groups.classroom-group.classwork',
                        ['classGroup' => $classGroup->id]
                    ) }}"
                    class="quiz-back-btn"
                    title="Back to Classwork"
                >
                    <i class="bx bx-arrow-back"></i>
                </a>

                <div>

                    <span class="quiz-header-label">
                        {{ $classGroup->group_name }}
                    </span>

                    <div class="quiz-title-row">

                        <span class="quiz-title-mark"></span>

                        <h1 class="quiz-header-title">
                            Create Quiz
                        </h1>

                    </div>

                    <p class="quiz-header-subtitle">
                        Create a quiz and provide everything your students need.
                    </p>

                </div>

            </div>

        </div>

    </header>


    {{-- ============================================================
         MAIN LAYOUT
    ============================================================= --}}

    <div class="quiz-create-layout">

        <main class="quiz-create-main">

            <form
                id="quiz-create-form"
                action="{{ route(
                    'professor.class-groups.quizzes.store',
                    ['classGroup' => $classGroup->id]
                ) }}"
                method="POST"
                enctype="multipart/form-data"
            >

                @csrf


                {{-- ====================================================
                     QUIZ DETAILS
                ===================================================== --}}

                <section class="quiz-section">

                    <div class="quiz-section-header">

                        <div class="quiz-section-icon">
                            <i class="bx bx-file-blank"></i>
                        </div>

                        <div class="quiz-section-heading">
                            <h2>Quiz Details</h2>
                            <p>
                                Set the title, instructions, and classroom topic.
                            </p>
                        </div>

                    </div>


                    <div class="quiz-section-body">

                        {{-- Quiz Title --}}
                        <div class="quiz-form-group">

                            <label
                                class="quiz-field-label"
                                for="title"
                            >
                                Quiz Title
                            </label>

                            <input
                                class="quiz-input"
                                type="text"
                                id="title"
                                name="title"
                                value="{{ old('title') }}"
                                placeholder="e.g. Week 3 Database Quiz"
                                required
                            >

                            @error('title')
                                <span class="quiz-error">
                                    {{ $message }}
                                </span>
                            @enderror

                        </div>


                        {{-- Instructions --}}
                        <div class="quiz-form-group">

                            <label
                                class="quiz-field-label"
                                for="description"
                            >
                                Instructions
                            </label>

                            <textarea
                                class="quiz-textarea"
                                id="description"
                                name="description"
                                placeholder="Explain the quiz or provide instructions for your students..."
                            >{{ old('description') }}</textarea>

                            @error('description')
                                <span class="quiz-error">
                                    {{ $message }}
                                </span>
                            @enderror

                        </div>


                        {{-- Topic --}}
                        <div class="quiz-form-group">

                            <label
                                class="quiz-field-label"
                                for="topic_id"
                            >
                                Topic

                                <span class="quiz-optional">
                                    Optional
                                </span>
                            </label>

                            <select
                                class="quiz-select"
                                id="topic_id"
                                name="topic_id"
                            >

                                <option value="">
                                    No topic
                                </option>

                                @foreach($classGroup->topics as $topic)

                                    <option
                                        value="{{ $topic->id }}"
                                        @selected(old('topic_id') == $topic->id)
                                    >
                                        {{ $topic->topic_name }}
                                    </option>

                                @endforeach

                            </select>

                            <span class="quiz-help">
                                <i class="bx bx-info-circle"></i>

                                <span>
                                    Organize this quiz under one of your classroom topics.
                                </span>
                            </span>

                            @error('topic_id')
                                <span class="quiz-error">
                                    {{ $message }}
                                </span>
                            @enderror

                        </div>

                    </div>

                </section>


                {{-- ====================================================
                     SCHEDULE & POINTS
                ===================================================== --}}

                <section class="quiz-section">

                    <div class="quiz-section-header">

                        <div class="quiz-section-icon">
                            <i class="bx bx-calendar-check"></i>
                        </div>

                        <div class="quiz-section-heading">
                            <h2>Schedule & Points</h2>
                            <p>
                                Set the deadline and maximum score for this quiz.
                            </p>
                        </div>

                    </div>


                    <div class="quiz-section-body">

                        <div class="quiz-form-row">

                            {{-- Due Date --}}
                            <div class="quiz-form-group">

                                <label
                                    class="quiz-field-label"
                                    for="due_date"
                                >
                                    Due Date

                                    <span class="quiz-optional">
                                        Optional
                                    </span>
                                </label>

                                <input
                                    class="quiz-input"
                                    type="date"
                                    id="due_date"
                                    name="due_date"
                                    value="{{ old('due_date') }}"
                                >

                                @error('due_date')
                                    <span class="quiz-error">
                                        {{ $message }}
                                    </span>
                                @enderror

                            </div>


                            {{-- Due Time --}}
                            <div class="quiz-form-group">

                                <label
                                    class="quiz-field-label"
                                    for="due_time"
                                >
                                    Due Time

                                    <span class="quiz-optional">
                                        Optional
                                    </span>
                                </label>

                                <input
                                    class="quiz-input"
                                    type="time"
                                    id="due_time"
                                    name="due_time"
                                    value="{{ old('due_time') }}"
                                >

                                @error('due_time')
                                    <span class="quiz-error">
                                        {{ $message }}
                                    </span>
                                @enderror

                            </div>

                        </div>


                        {{-- Points --}}
                        <div class="quiz-form-group">

                            <label
                                class="quiz-field-label"
                                for="points"
                            >
                                Points

                                <span class="quiz-optional">
                                    Optional
                                </span>
                            </label>

                            <input
                                class="quiz-input"
                                type="number"
                                id="points"
                                name="points"
                                value="{{ old('points') }}"
                                min="0"
                                step="0.01"
                                placeholder="e.g. 20"
                            >

                            @error('points')
                                <span class="quiz-error">
                                    {{ $message }}
                                </span>
                            @enderror

                        </div>

                    </div>

                </section>


                {{-- ====================================================
                     GOOGLE FORM
                ===================================================== --}}

                <section class="quiz-section">

                    <div class="quiz-section-header">

                        <div class="quiz-section-icon">
                            <i class="bx bx-link-external"></i>
                        </div>

                        <div class="quiz-section-heading">
                            <h2>Online Submission</h2>
                            <p>
                                Optionally connect a Google Form for quiz responses.
                            </p>
                        </div>

                    </div>


                    <div class="quiz-section-body">

                        <div class="quiz-google-box">

                            <div class="quiz-google-heading">

                                <div class="quiz-google-icon">
                                    <i class="bx bx-link"></i>
                                </div>

                                <div>

                                    <strong>
                                        Google Form
                                    </strong>

                                    <span>
                                        Students can use the form as an additional way to take the quiz.
                                    </span>

                                </div>

                            </div>


                            <div class="quiz-form-group">

                                <label
                                    class="quiz-field-label"
                                    for="google_form_url"
                                >
                                    Google Form URL

                                    <span class="quiz-optional">
                                        Optional
                                    </span>
                                </label>

                                <input
                                    class="quiz-input"
                                    type="url"
                                    id="google_form_url"
                                    name="google_form_url"
                                    value="{{ old('google_form_url') }}"
                                    placeholder="https://docs.google.com/forms/..."
                                >

                                <span class="quiz-help">
                                    <i class="bx bx-info-circle"></i>

                                    <span>
                                        Paste the Google Form link that students will use to take this quiz.
                                    </span>
                                </span>

                                @error('google_form_url')
                                    <span class="quiz-error">
                                        {{ $message }}
                                    </span>
                                @enderror

                            </div>

                        </div>

                    </div>

                </section>


                {{-- ====================================================
                     ATTACHMENTS
                ===================================================== --}}

                <section class="quiz-section">

                    <div class="quiz-section-header">

                        <div class="quiz-section-icon">
                            <i class="bx bx-paperclip"></i>
                        </div>

                        <div class="quiz-section-heading">
                            <h2>Attachments</h2>
                            <p>
                                Add instructions, reference files, or other quiz resources.
                            </p>
                        </div>

                    </div>


                    <div class="quiz-section-body">

                        <label
                            class="quiz-upload-area"
                            for="attachments"
                        >

                            <div class="quiz-upload-icon">
                                <i class="bx bx-cloud-upload"></i>
                            </div>

                            <strong class="quiz-upload-title">
                                Select files to attach
                            </strong>

                            <span class="quiz-upload-subtitle">
                                Upload one or multiple PDFs, documents, slides,
                                or other quiz-related materials.
                                Maximum 100 MB per file.
                            </span>

                            <span class="quiz-upload-button">
                                <i class="bx bx-folder-open"></i>
                                Choose Files
                            </span>

                            <input
                                class="quiz-upload-input"
                                type="file"
                                id="attachments"
                                name="attachments[]"
                                multiple
                            >

                        </label>


                        <div
                            id="quiz-selected-files"
                            class="quiz-selected-files"
                            style="display: none;"
                        ></div>


                        @error('attachments')
                            <span class="quiz-error">
                                {{ $message }}
                            </span>
                        @enderror

                        @error('attachments.*')
                            <span class="quiz-error">
                                {{ $message }}
                            </span>
                        @enderror

                    </div>

                </section>

            </form>

        </main>


        {{-- ============================================================
             SIDEBAR
        ============================================================= --}}

        <aside class="quiz-create-sidebar">

            <div class="quiz-sidebar-card">

                {{-- Sidebar Header --}}
                <div class="quiz-sidebar-header">

                    <div class="quiz-sidebar-header-icon">
                        <i class="bx bx-help-circle"></i>
                    </div>

                    <div>
                        <h3>Quiz Summary</h3>

                        <p>
                            Review the important settings before creating.
                        </p>
                    </div>

                </div>


                {{-- Summary --}}
                <div class="quiz-sidebar-body">

                    <div class="quiz-summary-row">

                        <span class="quiz-summary-label">
                            Class
                        </span>

                        <span class="quiz-summary-value">
                            {{ $classGroup->group_name }}
                        </span>

                    </div>


                    <div class="quiz-summary-row">

                        <span class="quiz-summary-label">
                            Topic
                        </span>

                        <span class="quiz-summary-value">
                            Select in form
                        </span>

                    </div>


                    <div class="quiz-summary-row">

                        <span class="quiz-summary-label">
                            Due Date
                        </span>

                        <span class="quiz-summary-value">
                            Set in form
                        </span>

                    </div>


                    <div class="quiz-summary-row">

                        <span class="quiz-summary-label">
                            Points
                        </span>

                        <span class="quiz-summary-value">
                            Set in form
                        </span>

                    </div>


                    <div class="quiz-summary-row">

                        <span class="quiz-summary-label">
                            Attachments
                        </span>

                        <span class="quiz-summary-value">
                            Selected below
                        </span>

                    </div>

                </div>


                {{-- Help --}}
                <div class="quiz-sidebar-help">

                    <div class="quiz-sidebar-help-title">

                        <i class="bx bx-info-circle"></i>

                        Before creating

                    </div>

                    <ul>

                        <li>
                            Give the quiz a clear title.
                        </li>

                        <li>
                            Explain the quiz instructions.
                        </li>

                        <li>
                            Set the correct due date and points.
                        </li>

                        <li>
                            Add supporting files when needed.
                        </li>

                    </ul>

                </div>


                {{-- Actions --}}
                <div class="quiz-actions">

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
                        form="quiz-create-form"
                        class="quiz-submit-button"
                    >
                        <i class="bx bx-plus"></i>
                        Create Quiz
                    </button>

                </div>

            </div>

        </aside>

    </div>

</div>


<script>
document.addEventListener('DOMContentLoaded', function () {

    const fileInput = document.getElementById('attachments');
    const fileList = document.getElementById('quiz-selected-files');

    if (!fileInput || !fileList) {
        return;
    }


    let selectedFiles = [];


    /* ============================================================
       UPDATE REAL FILE INPUT
       ============================================================ */

    function updateFileInput() {

        const dataTransfer = new DataTransfer();

        selectedFiles.forEach(function (file) {
            dataTransfer.items.add(file);
        });

        fileInput.files = dataTransfer.files;
    }


    /* ============================================================
       DISPLAY SELECTED FILES
       ============================================================ */

    function renderSelectedFiles() {

        fileList.innerHTML = '';


        if (selectedFiles.length === 0) {

            fileList.style.display = 'none';

            return;
        }


        fileList.style.display = 'flex';


        selectedFiles.forEach(function (file, index) {

            const fileItem = document.createElement('div');

            fileItem.className = 'quiz-selected-file';


            /* File icon */
            const fileIcon = document.createElement('i');

            fileIcon.className = 'bx bx-file';


            /* File information */
            const fileInfo = document.createElement('div');

            fileInfo.className = 'quiz-selected-file-info';


            const fileName = document.createElement('strong');

            fileName.textContent = file.name;


            const fileSize = document.createElement('span');

            fileSize.textContent =
                (file.size / 1024 / 1024).toFixed(2) + ' MB';


            /* Remove button */
            const removeButton = document.createElement('button');

            removeButton.type = 'button';

            removeButton.className = 'quiz-selected-file-remove';

            removeButton.innerHTML = '<i class="bx bx-x"></i>';

            removeButton.title = 'Remove file';


            removeButton.addEventListener('click', function () {

                selectedFiles.splice(index, 1);

                updateFileInput();

                renderSelectedFiles();

            });


            fileInfo.appendChild(fileName);
            fileInfo.appendChild(fileSize);

            fileItem.appendChild(fileIcon);
            fileItem.appendChild(fileInfo);
            fileItem.appendChild(removeButton);

            fileList.appendChild(fileItem);

        });

    }


    /* ============================================================
       FILE SELECTION
       ============================================================ */

    fileInput.addEventListener('change', function () {

        const newFiles = Array.from(this.files);


        newFiles.forEach(function (file) {

            const duplicate = selectedFiles.some(function (existingFile) {

                return (
                    existingFile.name === file.name &&
                    existingFile.size === file.size &&
                    existingFile.lastModified === file.lastModified
                );

            });


            if (!duplicate) {
                selectedFiles.push(file);
            }

        });


        updateFileInput();

        renderSelectedFiles();

    });

});
</script>

@endsection

