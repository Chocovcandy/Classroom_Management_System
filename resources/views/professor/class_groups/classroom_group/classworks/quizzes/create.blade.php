@extends('layouts.prof_layout')

@section('title', 'Create Quiz')

@section('content')

<style>

/* ============================================================
   BIGGER TEXT — PROJECT CREATE PAGE
   Applies to all text, including dropdowns
   ============================================================ */

/* Main page text */
.project-create-page {
    font-size: 15px;
}

/* Header */
.project-create-page .project-header-label {
    font-size: 13px;
}

.project-create-page .project-page-title {
    font-size: 34px;
}

.project-create-page .project-page-subtitle {
    font-size: 16px;
}

/* Class badge */
.project-create-page .project-class-badge {
    font-size: 13px;
}

/* Alert messages */
.project-create-page .project-alert {
    font-size: 14px;
}

.project-create-page .project-alert strong {
    font-size: 15px;
}

/* Section headings */
.project-create-page .project-section-heading h2 {
    font-size: 19px;
}

.project-create-page .project-section-heading p {
    font-size: 14px;
}

/* Form labels */
.project-create-page .project-form-label {
    font-size: 15px;
}

/* Inputs, textareas, and ALL dropdowns */
.project-create-page .project-input,
.project-create-page .project-select,
.project-create-page .project-textarea,
.project-create-page .project-group-count-select,
.project-create-page .project-manual-team-select,
.project-create-page .project-preview-role {
    font-size: 16px;
}

/* Input sizes */
.project-create-page .project-input,
.project-create-page .project-select,
.project-create-page .project-group-count-select {
    height: 50px;
}

/* Textarea */
.project-create-page .project-textarea {
    font-size: 16px;
    line-height: 1.7;
}

/* Help text */
.project-create-page .project-help-text {
    font-size: 13px;
}

/* Error messages */
.project-create-page .project-error {
    font-size: 14px;
}

/* Project type cards */
.project-create-page .project-type-title {
    font-size: 16px;
}

.project-create-page .project-type-description {
    font-size: 14px;
}

/* Grouping methods */
.project-create-page .project-grouping-intro {
    font-size: 14px;
}

.project-create-page .project-grouping-method-title {
    font-size: 15px;
}

.project-create-page .project-grouping-method-description {
    font-size: 13px;
}

/* Generate groups button */
.project-create-page .project-generate-groups-btn {
    font-size: 14px;
}

/* Grouping status */
.project-create-page .project-grouping-status {
    font-size: 13px;
}

/* Group preview */
.project-create-page .project-groups-preview-eyebrow {
    font-size: 12px;
}

.project-create-page .project-groups-preview-header h3 {
    font-size: 18px;
}

.project-create-page .project-groups-preview-header p {
    font-size: 13px;
}

.project-create-page .project-groups-preview-count {
    font-size: 13px;
}

/* Team cards */
.project-create-page .project-preview-team-title strong {
    font-size: 15px;
}

.project-create-page .project-preview-team-count {
    font-size: 12px;
}

.project-create-page .project-preview-member-name {
    font-size: 14px;
}

.project-create-page .project-preview-member-performance {
    font-size: 12px;
}

.project-create-page .project-preview-role {
    font-size: 13px;
}

/* Average score */
.project-create-page .project-preview-average span {
    font-size: 13px;
}

.project-create-page .project-preview-average strong {
    font-size: 14px;
}

/* Grouping notes */
.project-create-page .project-grouping-note {
    font-size: 13px;
}

.project-create-page .project-groups-preview-footer {
    font-size: 13px;
}

/* Manual team builder */
.project-create-page .project-manual-builder-header h3 {
    font-size: 17px;
}

.project-create-page .project-manual-builder-header p {
    font-size: 13px;
}

.project-create-page .project-manual-team-head strong {
    font-size: 14px;
}

.project-create-page .project-manual-team-count {
    font-size: 12px;
}

.project-create-page .project-manual-student-row span {
    font-size: 13px;
}

.project-create-page .project-manual-add-btn {
    font-size: 13px;
}

.project-create-page .project-manual-empty {
    font-size: 13px;
}

.project-create-page .project-manual-unassigned {
    font-size: 13px;
}

/* Student picker popup */
.project-create-page .project-student-picker-header h3 {
    font-size: 19px;
}

.project-create-page .project-student-picker-header p {
    font-size: 13px;
}

.project-create-page .project-student-picker-name {
    font-size: 14px;
}

.project-create-page .project-student-picker-selected {
    font-size: 12px;
}

.project-create-page .project-student-picker-cancel,
.project-create-page .project-student-picker-add {
    font-size: 14px;
}

/* Upload area */
.project-create-page .project-upload-title {
    font-size: 16px;
}

.project-create-page .project-upload-description {
    font-size: 13px;
}

.project-create-page .project-file-name {
    font-size: 14px;
}

.project-create-page .project-file-size {
    font-size: 12px;
}

/* Sidebar summary */
.project-create-page .project-summary-header h2 {
    font-size: 17px;
}

.project-create-page .project-summary-label {
    font-size: 13px;
}

.project-create-page .project-summary-value {
    font-size: 14px;
}

.project-create-page .project-help-card-title {
    font-size: 14px;
}

.project-create-page .project-help-card p {
    font-size: 13px;
}

/* Buttons */
.project-create-page .project-cancel-btn,
.project-create-page .project-btn {
    font-size: 14px;
}

/* Keep mobile readable */
@media (max-width: 620px) {
    .project-create-page .project-page-title {
        font-size: 28px;
    }

    .project-create-page .project-section-heading h2 {
        font-size: 18px;
    }

    .project-create-page .project-input,
    .project-create-page .project-select,
    .project-create-page .project-textarea,
    .project-create-page .project-group-count-select {
        font-size: 16px;
    }
}
</style>

<div class="quiz-create-page">

    {{-- ============================================================
         HEADER
    ============================================================ --}}

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

            <span class="quiz-header-badge">
                <i class="bx bx-help-circle"></i>
                Quiz
            </span>

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
                            <p>Set the title, instructions, and classroom topic.</p>
                        </div>

                    </div>

                    <div class="quiz-section-body">

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
                                Organize this quiz under one of your classroom topics.
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
                     QUIZ SETTINGS
                ===================================================== --}}

                <section class="quiz-section">

                    <div class="quiz-section-header">

                        <div class="quiz-section-icon">
                            <i class="bx bx-calendar-check"></i>
                        </div>

                        <div class="quiz-section-heading">
                            <h2>Schedule & Points</h2>
                            <p>Set the deadline and maximum score for this quiz.</p>
                        </div>

                    </div>

                    <div class="quiz-section-body">

                        <div class="quiz-form-row">

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
                            <p>Optionally connect a Google Form for quiz responses.</p>
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
                                    Paste the Google Form link that students will use to take this quiz.
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
                            <p>Add instructions, reference files, or other quiz resources.</p>
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

                <div class="quiz-sidebar-header">

                    <div class="quiz-sidebar-header-icon">
                        <i class="bx bx-help-circle"></i>
                    </div>

                    <div>
                        <h3>Quiz Summary</h3>
                        <p>Review the important settings before creating.</p>
                    </div>

                </div>


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


                <div class="quiz-sidebar-help">

                    <div class="quiz-sidebar-help-title">
                        <i class="bx bx-info-circle"></i>
                        Before creating
                    </div>

                    <ul>
                        <li>Give the quiz a clear title.</li>
                        <li>Explain the quiz instructions.</li>
                        <li>Set the correct due date and points.</li>
                        <li>Add supporting files when needed.</li>
                    </ul>

                </div>


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

    function updateFileInput() {
        const dataTransfer = new DataTransfer();

        selectedFiles.forEach(function (file) {
            dataTransfer.items.add(file);
        });

        fileInput.files = dataTransfer.files;
    }

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

            const fileIcon = document.createElement('i');
            fileIcon.className = 'bx bx-file';

            const fileInfo = document.createElement('div');
            fileInfo.className = 'quiz-selected-file-info';

            const fileName = document.createElement('strong');
            fileName.textContent = file.name;

            const fileSize = document.createElement('span');
            fileSize.textContent =
                (file.size / 1024 / 1024).toFixed(2) + ' MB';

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
