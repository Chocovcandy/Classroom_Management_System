

<style>

/* ============================================================
   QUIZ EDIT PAGE
============================================================ */

.classwork-form-page {
    width: 100%;
    max-width: 1100px;
    margin: 0 auto;
    padding: 30px 24px 50px;
}


/* ============================================================
   HEADER
============================================================ */

.classwork-form-header {
    margin-bottom: 28px;
}

.classwork-form-back {
    display: inline-flex;
    align-items: center;
    gap: 8px;

    margin-bottom: 24px;

    color: var(--text-secondary);
    text-decoration: none;

    font-size: 14px;
    font-weight: 600;

    transition: color 0.2s ease;
}

.classwork-form-back:hover {
    color: var(--text-color);
}

.classwork-form-back i {
    font-size: 20px;
}

.classwork-form-heading {
    display: flex;
    align-items: center;
    gap: 18px;
}

.classwork-form-icon {
    width: 58px;
    height: 58px;

    display: flex;
    align-items: center;
    justify-content: center;

    flex-shrink: 0;

    border-radius: 15px;

    background: rgba(124, 58, 237, 0.12);
    color: #7c3aed;
}

.classwork-form-icon i {
    font-size: 28px;
}

.classwork-form-eyebrow {
    display: block;

    margin-bottom: 4px;

    font-size: 12px;
    font-weight: 700;
    letter-spacing: 1.2px;

    color: var(--text-secondary);
}

.classwork-form-heading h1 {
    margin: 0;

    font-size: 30px;
    font-weight: 700;

    color: var(--text-color);
}

.classwork-form-heading p {
    margin: 5px 0 0;

    color: var(--text-secondary);

    font-size: 14px;
}


/* ============================================================
   FORM CARD
============================================================ */

.classwork-form-card {
    background: var(--card-color);

    border: 1px solid var(--border-color);
    border-radius: 18px;

    padding: 30px;

    box-shadow:
        0 8px 25px rgba(0, 0, 0, 0.04);
}


/* ============================================================
   FORM GROUP
============================================================ */

.form-group {
    margin-bottom: 22px;
}

.form-group label {
    display: block;

    margin-bottom: 8px;

    font-size: 14px;
    font-weight: 650;

    color: var(--text-color);
}

.form-group label span {
    color: #dc2626;
}

.form-group input,
.form-group select,
.form-group textarea {
    width: 100%;

    padding: 12px 14px;

    border: 1px solid var(--border-color);
    border-radius: 10px;

    background: var(--background-color);
    color: var(--text-color);

    font-family: inherit;
    font-size: 14px;

    outline: none;

    transition:
        border-color 0.2s ease,
        box-shadow 0.2s ease;

    box-sizing: border-box;
}

.form-group input:focus,
.form-group select:focus,
.form-group textarea:focus {
    border-color: #7c3aed;

    box-shadow:
        0 0 0 3px rgba(124, 58, 237, 0.10);
}

.form-group textarea {
    resize: vertical;
    min-height: 140px;
}

.form-group input::placeholder,
.form-group textarea::placeholder {
    color: var(--text-secondary);
    opacity: 0.7;
}


/* ============================================================
   TWO COLUMN ROW
============================================================ */

.form-row {
    display: grid;

    grid-template-columns: 1fr 1fr;

    gap: 18px;
}


/* ============================================================
   ERROR
============================================================ */

.form-error {
    display: block;

    margin-top: 7px;

    font-size: 12px;

    color: #dc2626;
}


/* ============================================================
   FILE ATTACHMENTS
============================================================ */

.quiz-attachment-group {
    width: 100%;
    margin-top: 28px;
}

.quiz-attachment-label {
    display: block;

    margin-bottom: 12px;

    font-size: 15px;
    font-weight: 700;

    color: var(--text-color);
}


/* ============================================================
   ATTACHMENT SECTION
============================================================ */

.quiz-attachment-section {
    margin-top: 20px;
}

.quiz-form-label {
    display: block;

    margin-bottom: 10px;

    font-size: 14px;
    font-weight: 600;

    color: var(--text-color);
}


/* ============================================================
   CURRENT RESOURCE FILES
============================================================ */

.quiz-resource-list {
    display: flex;
    flex-direction: column;

    gap: 10px;
}

.quiz-resource-item {
    display: flex;
    align-items: center;

    gap: 12px;

    width: 100%;

    padding: 14px;

    border: 1px solid var(--border-color);
    border-radius: 12px;

    background: var(--card-color);

    box-sizing: border-box;
}

.quiz-resource-icon {
    width: 42px;
    height: 42px;

    display: flex;
    align-items: center;
    justify-content: center;

    flex-shrink: 0;

    border-radius: 10px;

    background: rgba(124, 58, 237, 0.10);
    color: #7c3aed;

    font-size: 21px;
}

.quiz-resource-info {
    min-width: 0;

    flex: 1;

    display: flex;
    flex-direction: column;

    gap: 4px;
}

.quiz-resource-info strong {
    display: block;

    font-size: 14px;
    font-weight: 600;

    color: var(--text-color);

    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
}

.quiz-resource-info span {
    font-size: 12px;

    color: var(--text-secondary);
}


/* ============================================================
   OPEN FILE BUTTON
============================================================ */

.quiz-file-view-btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;

    gap: 7px;

    flex-shrink: 0;

    padding: 9px 13px;

    border: 1px solid var(--border-color);
    border-radius: 8px;

    background: var(--card-color);
    color: var(--text-color);

    font-size: 13px;
    font-weight: 600;

    cursor: pointer;

    transition:
        background 0.2s ease,
        border-color 0.2s ease,
        transform 0.2s ease;
}

.quiz-file-view-btn:hover {
    background: var(--background-color);

    border-color: #7c3aed;

    color: #7c3aed;

    transform: translateY(-1px);
}

.quiz-file-view-btn i {
    font-size: 17px;
}


/* ============================================================
   REMOVE RESOURCE
============================================================ */

.quiz-resource-remove {
    display: inline-flex;
    align-items: center;

    gap: 6px;

    flex-shrink: 0;

    font-size: 12px;
    font-weight: 600;

    color: #dc2626;

    cursor: pointer;
}

.quiz-resource-remove input {
    width: 15px;
    height: 15px;

    margin: 0;

    accent-color: #dc2626;

    cursor: pointer;
}


/* ============================================================
   HELP TEXT
============================================================ */

.quiz-form-help {
    display: block;

    margin-top: 8px;

    font-size: 12px;

    color: var(--text-secondary);
}


/* ============================================================
   ADD NEW FILES
============================================================ */

.quiz-file-upload-box {
    position: relative;

    min-height: 150px;

    display: flex;
    align-items: center;
    justify-content: center;

    padding: 24px;

    border: 2px dashed var(--border-color);
    border-radius: 12px;

    background: var(--card-color);

    cursor: pointer;

    transition:
        border-color 0.2s ease,
        background 0.2s ease;

    box-sizing: border-box;
}

.quiz-file-upload-box:hover {
    background: var(--background-color);

    border-color: #7c3aed;
}

.quiz-file-upload-box input[type="file"] {
    position: absolute;

    inset: 0;

    width: 100%;
    height: 100%;

    opacity: 0;

    cursor: pointer;
}

.quiz-file-upload-content {
    display: flex;
    flex-direction: column;

    align-items: center;

    text-align: center;

    gap: 7px;

    pointer-events: none;
}

.quiz-file-upload-content i {
    font-size: 34px;

    color: #7c3aed;
}

.quiz-file-upload-content strong {
    font-size: 14px;

    color: var(--text-color);
}

.quiz-file-upload-content span {
    max-width: 450px;

    font-size: 12px;
    line-height: 1.5;

    color: var(--text-secondary);
}


/* ============================================================
   SELECTED NEW FILES
============================================================ */

.quiz-new-files-preview {
    display: none;

    flex-direction: column;

    gap: 8px;

    margin-top: 12px;
}

.quiz-new-file-preview {
    display: flex;
    align-items: center;

    gap: 12px;

    width: 100%;

    padding: 12px 14px;

    border: 1px solid var(--border-color);
    border-radius: 10px;

    background: var(--background-color);

    box-sizing: border-box;
}

.quiz-new-file-preview > i {
    width: 38px;
    height: 38px;

    display: flex;
    align-items: center;
    justify-content: center;

    flex-shrink: 0;

    border-radius: 9px;

    background: rgba(124, 58, 237, 0.10);
    color: #7c3aed;

    font-size: 20px;
}

.quiz-new-file-preview-info {
    min-width: 0;

    flex: 1;

    display: flex;
    flex-direction: column;

    gap: 3px;
}

.quiz-new-file-preview-info strong {
    display: block;

    font-size: 13px;
    font-weight: 600;

    color: var(--text-color);

    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
}

.quiz-new-file-preview-info span {
    font-size: 11px;

    color: var(--text-secondary);
}


/* ============================================================
   CURRENT FILE EMPTY STATE
============================================================ */

.quiz-no-files {
    display: flex;
    align-items: center;

    gap: 10px;

    padding: 14px 16px;

    border: 1px dashed var(--border-color);
    border-radius: 12px;

    background: var(--background-color);

    color: var(--text-secondary);

    font-size: 13px;
}

.quiz-no-files i {
    font-size: 19px;
}


/* ============================================================
   FILE PREVIEW MODAL
============================================================ */

.quiz-file-modal {
    position: fixed;

    inset: 0;

    z-index: 9999;

    display: none;
}

.quiz-file-modal.active {
    display: block;
}

.quiz-file-modal-overlay {
    position: absolute;

    inset: 0;

    background: rgba(0, 0, 0, 0.75);
}

.quiz-file-modal-container {
    position: relative;

    z-index: 2;

    width: min(1200px, 94vw);
    height: min(850px, 92vh);

    margin: 4vh auto;

    display: flex;
    flex-direction: column;

    overflow: hidden;

    background: #ffffff;

    border-radius: 14px;

    box-shadow:
        0 25px 60px rgba(0, 0, 0, 0.35);
}

.quiz-file-modal-header {
    min-height: 58px;

    display: flex;
    align-items: center;
    justify-content: space-between;

    padding: 0 16px;

    border-bottom: 1px solid #e5e7eb;

    background: #ffffff;
}

.quiz-file-modal-title {
    display: flex;
    align-items: center;

    gap: 9px;

    font-size: 14px;
    font-weight: 600;

    color: #1f2937;
}

.quiz-file-modal-title i {
    font-size: 20px;
}

.quiz-file-modal-actions {
    display: flex;
    align-items: center;

    gap: 6px;
}

.quiz-modal-icon-btn {
    width: 38px;
    height: 38px;

    display: flex;
    align-items: center;
    justify-content: center;

    border: none;
    border-radius: 8px;

    background: transparent;
    color: #4b5563;

    font-size: 21px;

    cursor: pointer;

    transition:
        background 0.2s ease,
        color 0.2s ease;
}

.quiz-modal-icon-btn:hover {
    background: #f3f4f6;

    color: #111827;
}

.quiz-file-modal-body {
    flex: 1;

    min-height: 0;

    background: #f3f4f6;
}

.quiz-file-modal-body iframe {
    width: 100%;
    height: 100%;

    display: block;

    border: none;

    background: #ffffff;
}

body.quiz-modal-open {
    overflow: hidden;
}


/* ============================================================
   FULLSCREEN
============================================================ */

.quiz-file-modal-container:fullscreen {
    width: 100vw;
    height: 100vh;

    margin: 0;

    border-radius: 0;
}

.quiz-file-modal-container:fullscreen
.quiz-file-modal-body {
    height: calc(100vh - 58px);
}


/* ============================================================
   FORM ACTIONS
============================================================ */

.classwork-form-actions {
    display: flex;
    align-items: center;
    justify-content: flex-end;

    gap: 12px;

    margin-top: 30px;
    padding-top: 22px;

    border-top: 1px solid var(--border-color);
}

.classwork-form-cancel {
    display: inline-flex;
    align-items: center;
    justify-content: center;

    min-height: 44px;

    padding: 0 18px;

    border: 1px solid var(--border-color);
    border-radius: 10px;

    color: var(--text-color);
    text-decoration: none;

    font-size: 14px;
    font-weight: 600;

    transition:
        background 0.2s ease,
        border-color 0.2s ease;
}

.classwork-form-cancel:hover {
    background: var(--background-color);
}

.classwork-form-submit {
    display: inline-flex;
    align-items: center;
    justify-content: center;

    gap: 8px;

    min-height: 44px;

    padding: 0 20px;

    border: none;
    border-radius: 10px;

    background: #7c3aed;
    color: white;

    font-size: 14px;
    font-weight: 650;

    cursor: pointer;

    box-shadow:
        0 5px 15px rgba(124, 58, 237, 0.20);

    transition:
        transform 0.2s ease,
        box-shadow 0.2s ease;
}

.classwork-form-submit:hover {
    transform: translateY(-1px);

    box-shadow:
        0 7px 18px rgba(124, 58, 237, 0.28);
}


/* ============================================================
   RESPONSIVE
============================================================ */

@media (max-width: 768px) {

    .quiz-resource-item {
        flex-wrap: wrap;
    }

    .quiz-resource-info {
        width: calc(100% - 60px);
    }

    .quiz-file-view-btn {
        width: 100%;
    }

    .quiz-resource-remove {
        margin-left: auto;
    }

    .quiz-file-modal-container {
        width: 100vw;
        height: 100vh;

        margin: 0;

        border-radius: 0;
    }
}


@media (max-width: 650px) {

    .classwork-form-page {
        padding: 20px 15px 40px;
    }

    .classwork-form-card {
        padding: 20px;
    }

    .classwork-form-heading {
        align-items: flex-start;
    }

    .classwork-form-heading h1 {
        font-size: 24px;
    }

    .form-row {
        grid-template-columns: 1fr;

        gap: 0;
    }

    .classwork-form-actions {
        flex-direction: column-reverse;

        align-items: stretch;
    }

    .classwork-form-cancel,
    .classwork-form-submit {
        width: 100%;
    }

    .quiz-resource-item {
        align-items: flex-start;
    }

    .quiz-resource-remove {
        width: 100%;
        margin-left: 0;
        padding-top: 4px;
    }
}

</style>
@extends('layouts.prof_layout')

@section('content')

<div class="classwork-form-page">

    {{-- ============================================================
        HEADER
    ============================================================= --}}

    <div class="classwork-form-header">

        <a
            href="{{
                $returnTo === 'marks'
                    ? route(
                        'professor.class-groups.marks',
                        $classGroup
                    )
                    : ($returnTo === 'show'
                        ? route(
                            'professor.class-groups.quizzes.show',
                            [
                                'classGroup' => $classGroup,
                                'quiz' => $quiz,
                                'return_to' => $origin,
                            ]
                        )
                        : ($returnTo === 'classwork'
                            ? route(
                                'professor.class-groups.classroom-group.classwork',
                                $classGroup
                            )
                            : route(
                                'professor.class-groups.classroom-group',
                                $classGroup
                            )
                        )
                    )
            }}"
            class="classwork-form-back"
        >
            <i class="bx bx-arrow-back"></i>

            {{
                $returnTo === 'marks'
                    ? 'Back to Marks'
                    : ($returnTo === 'show'
                        ? 'Back to Quiz'
                        : ($returnTo === 'classwork'
                            ? 'Back to Classwork'
                            : 'Back to Stream'
                        )
                    )
            }}

        </a>


        <div class="classwork-form-heading">

            <div class="classwork-form-icon quiz">
                <i class="bx bx-help-circle"></i>
            </div>

            <div>

                <span class="classwork-form-eyebrow">
                    CLASSWORK
                </span>

                <h1>
                    Edit Quiz
                </h1>

                <p>
                    Update the quiz information.
                </p>

            </div>

        </div>

    </div>


    {{-- ============================================================
        FORM
    ============================================================= --}}

    <div class="classwork-form-card">

        <form
            action="{{ route(
                'professor.class-groups.quizzes.update',
                [
                    'classGroup' => $classGroup->id,
                    'quiz' => $quiz->id,
                ]
            ) }}"
            method="POST"
            enctype="multipart/form-data"
        >

            @csrf
            @method('PUT')


            {{-- ====================================================
                TITLE
            ===================================================== --}}

            <div class="form-group">

                <label for="title">
                    Quiz Title
                    <span>*</span>
                </label>

                <input
                    type="text"
                    id="title"
                    name="title"
                    value="{{ old('title', $quiz->title) }}"
                    placeholder="Enter quiz title"
                    required
                >

                @error('title')

                    <small class="form-error">
                        {{ $message }}
                    </small>

                @enderror

            </div>


            {{-- ====================================================
                TOPIC
            ===================================================== --}}

            <div class="form-group">

                <label for="topic_id">
                    Topic
                </label>

                <select
                    id="topic_id"
                    name="topic_id"
                >

                    <option value="">
                        No Topic
                    </option>

                    @foreach($topics as $topic)

                        <option
                            value="{{ $topic->id }}"
                            {{ old(
                                'topic_id',
                                $quiz->topic_id
                            ) == $topic->id
                                ? 'selected'
                                : ''
                            }}
                        >
                            {{ $topic->topic_name }}
                        </option>

                    @endforeach

                </select>

                @error('topic_id')

                    <small class="form-error">
                        {{ $message }}
                    </small>

                @enderror

            </div>


            {{-- ====================================================
                DESCRIPTION
            ===================================================== --}}

            <div class="form-group">

                <label for="description">
                    Description
                </label>

                <textarea
                    id="description"
                    name="description"
                    rows="6"
                    placeholder="Add quiz instructions..."
                >{{ old('description', $quiz->description) }}</textarea>

                @error('description')

                    <small class="form-error">
                        {{ $message }}
                    </small>

                @enderror

            </div>


            {{-- ====================================================
                DUE DATE + TIME
            ===================================================== --}}

            <div class="form-row">

                <div class="form-group">

                    <label for="due_date">
                        Due Date
                    </label>

                    <input
                        type="date"
                        id="due_date"
                        name="due_date"
                        value="{{ old(
                            'due_date',
                            $quiz->due_date
                                ? \Carbon\Carbon::parse(
                                    $quiz->due_date
                                )->format('Y-m-d')
                                : ''
                        ) }}"
                    >

                    @error('due_date')

                        <small class="form-error">
                            {{ $message }}
                        </small>

                    @enderror

                </div>


                <div class="form-group">

                    <label for="due_time">
                        Due Time
                    </label>

                    <input
                        type="time"
                        id="due_time"
                        name="due_time"
                        value="{{ old(
                            'due_time',
                            $quiz->due_time
                                ? \Carbon\Carbon::parse(
                                    $quiz->due_time
                                )->format('H:i')
                                : ''
                        ) }}"
                    >

                    @error('due_time')

                        <small class="form-error">
                            {{ $message }}
                        </small>

                    @enderror

                </div>

            </div>


            {{-- ====================================================
                POINTS
            ===================================================== --}}

            <div class="form-group">

                <label for="points">
                    Points
                </label>

                <input
                    type="number"
                    id="points"
                    name="points"
                    value="{{ old(
                        'points',
                        $quiz->points
                    ) }}"
                    min="0"
                    step="1"
                    placeholder="100"
                >

                @error('points')

                    <small class="form-error">
                        {{ $message }}
                    </small>

                @enderror

            </div>


            {{-- ====================================================
                GOOGLE FORM URL
            ===================================================== --}}

            <div class="form-group">

                <label for="google_form_url">

                    Google Form URL

                    <span class="optional-label">
                        Optional
                    </span>

                </label>

                <input
                    type="url"
                    id="google_form_url"
                    name="google_form_url"
                    value="{{ old(
                        'google_form_url',
                        $quiz->google_form_url
                    ) }}"
                    placeholder="https://docs.google.com/forms/..."
                >

                @error('google_form_url')

                    <span class="form-error">
                        {{ $message }}
                    </span>

                @enderror

                <small class="form-help">
                    Paste the Google Form link that students will use
                    to take this quiz.
                </small>

            </div>


            {{-- ====================================================
                FILE ATTACHMENTS
            ===================================================== --}}

            <div class="quiz-attachment-group">

                <label class="quiz-attachment-label">
                    File Attachments
                </label>


                {{-- ==================================================
                    LEGACY SINGLE ATTACHMENT
                =================================================== --}}

                @if($quiz->attachment)

                    <div class="quiz-attachment-section">

                        <label class="quiz-form-label">
                            Current Attachment
                        </label>

                        <div class="quiz-current-file">

                            <div class="quiz-current-file-icon">
                                <i class="bx bx-file"></i>
                            </div>

                            <div class="quiz-current-file-info">

                                <strong>
                                    {{ basename($quiz->attachment) }}
                                </strong>

                                <span>
                                    Current quiz attachment
                                </span>

                            </div>

                            <button
                                type="button"
                                class="quiz-file-view-btn"
                                data-file-url="{{ asset(
                                    'storage/' . $quiz->attachment
                                ) }}"
                            >
                                <i class="bx bx-show"></i>
                                Open File
                            </button>

                        </div>

                    </div>

                @endif


                {{-- ==================================================
                    CURRENT RESOURCE FILES
                =================================================== --}}

                @if($quiz->resources && $quiz->resources->count() > 0)

                    <div class="quiz-attachment-section">

                        <label class="quiz-form-label">
                            Current Files
                        </label>


                        <div class="quiz-resource-list">

                            @foreach($quiz->resources as $resource)

                                <div class="quiz-resource-item">

                                    <div class="quiz-resource-icon">
                                        <i class="bx bx-file"></i>
                                    </div>


                                    <div class="quiz-resource-info">

                                        <strong>
                                            {{ $resource->file_name
                                                ?? $resource->title
                                                ?? 'Unnamed File'
                                            }}
                                        </strong>

                                        <span>

                                            @if($resource->file_size)

                                                {{ number_format(
                                                    $resource->file_size / 1024,
                                                    1
                                                ) }}
                                                KB

                                            @else

                                                File

                                            @endif

                                        </span>

                                    </div>


                                    @if($resource->file_path)

                                        <button
                                            type="button"
                                            class="quiz-file-view-btn"
                                            data-file-url="{{ asset(
                                                'storage/' .
                                                $resource->file_path
                                            ) }}"
                                        >

                                            <i class="bx bx-show"></i>

                                            Open

                                        </button>

                                    @endif


                                    <label class="quiz-resource-remove">

                                        <input
                                            type="checkbox"
                                            name="remove_resources[]"
                                            value="{{ $resource->id }}"
                                        >

                                        <span>
                                            Remove
                                        </span>

                                    </label>

                                </div>

                            @endforeach

                        </div>


                        <small class="quiz-form-help">
                            Select Remove for any file you want to delete.
                        </small>

                    </div>

                @endif


                {{-- ==================================================
                    ADD NEW FILES
                =================================================== --}}

                <div class="quiz-attachment-section">

                    <label
                        for="files"
                        class="quiz-form-label"
                    >
                        Add New Files
                    </label>


                    <div class="quiz-file-upload-box">

                        <input
                            type="file"
                            id="files"
                            name="files[]"
                            multiple
                        >


                        <div class="quiz-file-upload-content">

                            <i class="bx bx-cloud-upload"></i>

                            <strong>
                                Choose files
                            </strong>

                            <span>
                                You can select multiple files
                                to attach to this quiz.
                            </span>

                        </div>

                    </div>


                    {{-- SELECTED NEW FILES --}}

                    <div
                        id="quiz-new-files-preview"
                        class="quiz-new-files-preview"
                        style="display: none;"
                    >
                    </div>


                    @error('files')

                        <small class="quiz-form-error">
                            {{ $message }}
                        </small>

                    @enderror


                    @error('files.*')

                        <small class="quiz-form-error">
                            {{ $message }}
                        </small>

                    @enderror


                    <small class="quiz-form-help">
                        Maximum file size: 100 MB per file.
                    </small>

                </div>

            </div>


            {{-- ====================================================
                ACTIONS
            ===================================================== --}}

            <div class="classwork-form-actions">

                <a
                    href="{{
                        $returnTo === 'marks'
                            ? route(
                                'professor.class-groups.marks',
                                $classGroup
                            )
                            : ($returnTo === 'show'
                                ? route(
                                    'professor.class-groups.quizzes.show',
                                    [
                                        'classGroup' => $classGroup,
                                        'quiz' => $quiz,
                                        'return_to' => $origin,
                                    ]
                                )
                                : ($returnTo === 'classwork'
                                    ? route(
                                        'professor.class-groups.classroom-group.classwork',
                                        $classGroup
                                    )
                                    : route(
                                        'professor.class-groups.classroom-group',
                                        $classGroup
                                    )
                                )
                            )
                    }}"
                    class="classwork-form-cancel"
                >
                    Cancel
                </a>


                <input
                    type="hidden"
                    name="return_to"
                    value="{{ $returnTo }}"
                >

                <input
                    type="hidden"
                    name="origin"
                    value="{{ $origin }}"
                >


                <button
                    type="submit"
                    class="classwork-form-submit quiz"
                >

                    <i class="bx bx-save"></i>

                    Save Changes

                </button>

            </div>

        </form>

    </div>

</div>


{{-- ============================================================
    FILE PREVIEW MODAL
============================================================= --}}

<div
    id="quizFileModal"
    class="quiz-file-modal"
    aria-hidden="true"
>

    <div class="quiz-file-modal-overlay"></div>


    <div class="quiz-file-modal-container">


        {{-- MODAL HEADER --}}

        <div class="quiz-file-modal-header">

            <div class="quiz-file-modal-title">

                <i class="bx bx-file"></i>

                <span>
                    File Preview
                </span>

            </div>


            <div class="quiz-file-modal-actions">

                <button
                    type="button"
                    id="quizFullscreenBtn"
                    class="quiz-modal-icon-btn"
                    title="Fullscreen"
                >
                    <i class="bx bx-fullscreen"></i>
                </button>


                <button
                    type="button"
                    id="quizCloseModalBtn"
                    class="quiz-modal-icon-btn"
                    title="Close"
                >
                    <i class="bx bx-x"></i>
                </button>

            </div>

        </div>


        {{-- MODAL BODY --}}

        <div class="quiz-file-modal-body">

            <iframe
                id="quizFileViewer"
                src=""
                title="Quiz attachment preview"
            ></iframe>

        </div>

    </div>

</div>


<script>

document.addEventListener('DOMContentLoaded', function () {


    /* ============================================================
       FILE PREVIEW MODAL
    ============================================================ */

    const modal =
        document.getElementById('quizFileModal');

    const viewer =
        document.getElementById('quizFileViewer');

    const closeBtn =
        document.getElementById('quizCloseModalBtn');

    const fullscreenBtn =
        document.getElementById('quizFullscreenBtn');

    const overlay =
        document.querySelector(
            '.quiz-file-modal-overlay'
        );


    const fileButtons =
        document.querySelectorAll(
            '.quiz-file-view-btn'
        );


    /* ============================================================
       OPEN FILE
    ============================================================ */

    fileButtons.forEach(function (button) {

        button.addEventListener('click', function () {

            const fileUrl =
                this.getAttribute('data-file-url');


            if (!fileUrl) {
                return;
            }


            viewer.src = fileUrl;


            modal.classList.add('active');

            modal.setAttribute(
                'aria-hidden',
                'false'
            );


            document.body.classList.add(
                'quiz-modal-open'
            );

        });

    });


    /* ============================================================
       CLOSE FILE MODAL
    ============================================================ */

    function closeQuizFileModal() {

        modal.classList.remove('active');

        modal.setAttribute(
            'aria-hidden',
            'true'
        );


        viewer.src = '';


        document.body.classList.remove(
            'quiz-modal-open'
        );

    }


    closeBtn.addEventListener(
        'click',
        closeQuizFileModal
    );


    overlay.addEventListener(
        'click',
        closeQuizFileModal
    );


    /* ============================================================
       FULLSCREEN
    ============================================================ */

    fullscreenBtn.addEventListener(
        'click',
        function () {

            const container =
                document.querySelector(
                    '.quiz-file-modal-container'
                );


            if (!document.fullscreenElement) {

                container
                    .requestFullscreen()
                    .catch(function (error) {

                        console.log(
                            'Fullscreen error:',
                            error
                        );

                    });

            } else {

                document.exitFullscreen();

            }

        }
    );


    /* ============================================================
       ESC KEY
    ============================================================ */

    document.addEventListener(
        'keydown',
        function (event) {

            if (
                event.key === 'Escape' &&
                modal.classList.contains('active')
            ) {

                closeQuizFileModal();

            }

        }
    );


    /* ============================================================
       SHOW SELECTED NEW FILES
    ============================================================ */

    const filesInput =
        document.getElementById('files');

    const newFilesPreview =
        document.getElementById(
            'quiz-new-files-preview'
        );


    if (
        filesInput &&
        newFilesPreview
    ) {

        filesInput.addEventListener(
            'change',
            function () {

                newFilesPreview.innerHTML = '';


                if (
                    !this.files ||
                    this.files.length === 0
                ) {

                    newFilesPreview.style.display =
                        'none';

                    return;

                }


                Array.from(this.files).forEach(
                    function (file) {

                        const fileItem =
                            document.createElement(
                                'div'
                            );

                        fileItem.className =
                            'quiz-new-file-preview';


                        const fileIcon =
                            document.createElement(
                                'i'
                            );

                        fileIcon.className =
                            'bx bx-file';


                        const fileInfo =
                            document.createElement(
                                'div'
                            );


                        const fileName =
                            document.createElement(
                                'strong'
                            );

                        fileName.textContent =
                            file.name;


                        const fileSize =
                            document.createElement(
                                'span'
                            );


                        fileSize.textContent =
                            (
                                file.size /
                                1024 /
                                1024
                            ).toFixed(2)
                            + ' MB';


                        fileInfo.appendChild(
                            fileName
                        );

                        fileInfo.appendChild(
                            fileSize
                        );


                        fileItem.appendChild(
                            fileIcon
                        );

                        fileItem.appendChild(
                            fileInfo
                        );


                        newFilesPreview.appendChild(
                            fileItem
                        );

                    }
                );


                newFilesPreview.style.display =
                    'flex';

            }
        );

    }

});

</script>

@endsection

