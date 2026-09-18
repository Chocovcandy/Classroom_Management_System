@extends('layouts.prof_layout')

@section('title', 'Student Submission')

@section('content')
@php
    $origin = request('origin', 'stream');
@endphp
<div class="student-submission-page">

    {{-- ============================================================
       HEADER
    ============================================================= --}}

    <div class="student-submission-header">

        {{-- BACK TO ASSIGNMENT --}}
<a href="{{ route('professor.class-groups.assignments.show', [
    'classGroup' => $classGroup->id,
    'assignment' => $assignment->id,
    'return_to' => $origin,
]) }}" class="student-submission-back">
    <i class="bx bx-arrow-back"></i>
    Back to Assignment
</a>


        {{-- ASSIGNMENT HEADER --}}
        <div class="student-submission-heading">

            <div class="student-submission-assignment-icon">
                <i class="bx bx-task"></i>
            </div>

            <div class="student-submission-heading-content">

                <span class="student-submission-type">
                    STUDENT SUBMISSION
                </span>

                <h1>
                    {{ $assignment->title }}
                </h1>

                @if($assignment->topic)

                    <div class="student-submission-topic">
                        <i class="bx bx-folder"></i>
                        {{ $assignment->topic->name }}
                    </div>

                @endif

            </div>

        </div>

    </div>


    {{-- ============================================================
       STUDENT INFORMATION
    ============================================================= --}}

    <section class="student-submission-card">

        <div class="student-submission-card-header">
            <h2>Student Information</h2>
        </div>


        <div class="student-information">

            {{-- AVATAR --}}
            <div class="student-avatar">
                <i class="bx bx-user"></i>
            </div>


            {{-- STUDENT DETAILS --}}
            <div class="student-details">

                <strong>
                    {{ $submission->student->name ?? 'Unknown Student' }}
                </strong>

                @if($submission->student->email ?? null)

                    <span>
                        {{ $submission->student->email }}
                    </span>

                @endif

                <span>
                    Submitted
                    {{ $submission->submitted_at?->format('M d, Y \a\t h:i A') }}
                </span>

            </div>

        </div>

    </section>


    {{-- ============================================================
       SUBMITTED WORK
    ============================================================= --}}

    <section class="student-submission-card">

        <div class="student-submission-card-header">

            <h2>
                Submitted Work
            </h2>

            <span class="submission-file-count">
                {{ $submission->resources->count() }}
                {{ $submission->resources->count() === 1 ? 'file' : 'files' }}
            </span>

        </div>


        @if($submission->resources->isNotEmpty())

            <div class="submission-files">

                @foreach($submission->resources as $resource)

                    <div class="submission-file">

                        {{-- FILE ICON --}}
                        <div class="submission-file-icon">
                            <i class="bx bx-file"></i>
                        </div>


                        {{-- FILE INFORMATION --}}
                        <div class="submission-file-info">

                            <strong>
                                {{ $resource->file_name ?? $resource->title }}
                            </strong>

                            @if($resource->file_size)

                                <span>
                                    {{ number_format($resource->file_size / 1024, 1) }} KB
                                </span>

                            @endif

                        </div>


                        {{-- FILE ACTIONS --}}
                        <div class="submission-file-actions">

                            {{-- VIEW --}}
                            @php
                                $fileName = $resource->file_name ?? $resource->title ?? 'Submitted File';
                                $extension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
                                $viewUrl = route(
                                    'professor.class-groups.assignments.submissions.resources.view',
                                    [
                                        'classGroup' => $classGroup->id,
                                        'assignment' => $assignment->id,
                                        'submission' => $submission->id,
                                        'resource' => $resource->id,
                                    ]
                                );
                            @endphp

                            @if(in_array($extension, [
                                'pdf',
                                'jpg',
                                'jpeg',
                                'png',
                                'gif',
                                'webp',
                                'mp4',
                                'webm',
                                'mov',
                                'avi',
                                'mp3',
                                'wav',
                                'ogg',
                                'm4a'
                            ]))
                                <button
                                    type="button"
                                    class="submission-file-btn"
                                    data-view-url="{{ $viewUrl }}"
                                    data-extension="{{ $extension }}"
                                    data-file-name="{{ $fileName }}"
                                    onclick="openSubmissionPreview(
                                        this.dataset.viewUrl,
                                        this.dataset.extension,
                                        this.dataset.fileName
                                    )"
                                >
                                    <i class="bx bx-show"></i>
                                    View
                                </button>
                            @endif


                            {{-- DOWNLOAD --}}
                            <a
                                href="{{ route(
                                    'professor.class-groups.assignments.submissions.resources.download',
                                    [
                                        'classGroup' => $classGroup->id,
                                        'assignment' => $assignment->id,
                                        'submission' => $submission->id,
                                        'resource' => $resource->id,
                                    ]
                                ) }}"
                                class="submission-file-btn"
                            >
                                <i class="bx bx-download"></i>
                                Download
                            </a>

                        </div>

                    </div>

                @endforeach

            </div>

        @else

            <div class="submission-empty">

                <i class="bx bx-file-blank"></i>

                <p>
                    This student did not attach any files.
                </p>

            </div>

        @endif

    </section>


    {{-- ============================================================
       MARK
       GRADING SUMMARY + MODAL
    ============================================================= --}}

    <section class="student-submission-card mark-card">

        <div class="student-submission-card-header">

            <h2>Mark</h2>

            @if($submission->graded_at)
                <span class="mark-status">
                    <i class="bx bx-check-circle"></i>
                    Graded
                </span>
            @endif

        </div>


        {{-- GRADING SUMMARY --}}
        <div class="mark-summary">

            <div class="mark-summary-left">

                <div class="mark-summary-icon">
                    <i class="bx bx-award"></i>
                </div>

                <div class="mark-summary-content">

                    @if($submission->score !== null)

                        <strong>
                            {{ rtrim(rtrim(number_format($submission->score, 2), '0'), '.') }}
                            /
                            {{ rtrim(rtrim(number_format($assignment->points, 2), '0'), '.') }}
                        </strong>

                        <span>
                            {{ $assignment->points > 0
                                ? number_format(($submission->score / $assignment->points) * 100, 1)
                                : '0.0'
                            }}%
                        </span>

                    @else

                        <h4>Not grade yet </h4>

                        <span>Give this student a mark and optional feedback.</span>

                    @endif

                </div>

            </div>


            <button
                type="button"
                class="open-grade-modal-btn"
                id="openGradeModal"
            >
                <i class="bx bx-edit"></i>

                {{ $submission->score !== null
                    ? 'Edit Grade'
                    : 'Mark Student'
                }}
            </button>

        </div>


        {{-- FEEDBACK PREVIEW --}}
        @if($submission->score !== null && $submission->feedback)

            <div class="mark-feedback-preview">

                <div class="mark-feedback-label">
                    <i class="bx bx-message-rounded-detail"></i>
                    Feedback
                </div>

                <p>{{ $submission->feedback }}</p>

            </div>

        @endif


        {{-- LAST GRADED INFORMATION --}}
        @if($submission->graded_at)

            <div class="graded-info">

                <i class="bx bx-time-five"></i>

                <span>
                    Last graded
                    {{ $submission->graded_at->format('M d, Y \a\t h:i A') }}
                </span>

            </div>

        @endif

    </section>


    {{-- ============================================================
       GRADE MODAL
    ============================================================= --}}

    <div
        class="grade-modal"
        id="gradeModal"
        aria-hidden="true"
    >

        <div
            class="grade-modal-overlay"
            id="gradeModalOverlay"
        ></div>


        <div
            class="grade-modal-dialog"
            role="dialog"
            aria-modal="true"
            aria-labelledby="gradeModalTitle"
        >

            <div class="grade-modal-header">

                <div class="grade-modal-title">

                    <div class="grade-modal-icon">
                        <i class="bx bx-edit"></i>
                    </div>

                    <div>
                        <h2 id="gradeModalTitle">
                            {{ $submission->score !== null
                                ? 'Edit Grade'
                                : 'Mark Student'
                            }}
                        </h2>

                        <p>
                            {{ $submission->student->name ?? 'Student' }}
                        </p>
                    </div>

                </div>


                <button
                    type="button"
                    class="grade-modal-close"
                    id="closeGradeModal"
                    aria-label="Close"
                >
                    <i class="bx bx-x"></i>
                </button>

            </div>


            <form
                action="{{ route('professor.class-groups.assignments.submissions.grade', [
                    'classGroup' => $classGroup->id,
                    'assignment' => $assignment->id,
                    'submission' => $submission->id,
                ]) }}"
                method="POST"
                class="grading-form"
            >

                @csrf

                <div class="grading-field">

                    <label for="score">
                        Score
                    </label>

                    <div class="score-input-wrapper">

                        <input
                            type="number"
                            name="score"
                            id="score"
                            min="0"
                            max="{{ $assignment->points }}"
                            step="0.01"
                            value="{{ old('score', $submission->score) }}"
                            placeholder="Enter score"
                            required
                        >

                        <span>
                            /
                            {{ rtrim(rtrim(number_format($assignment->points, 2), '0'), '.') }}
                        </span>

                    </div>

                    @error('score')
                        <small class="grading-error">
                            {{ $message }}
                        </small>
                    @enderror

                </div>


                <div class="grading-field">

                    <label for="feedback">
                        Feedback
                        <span>(optional)</span>
                    </label>

                    <textarea
                        name="feedback"
                        id="feedback"
                        rows="5"
                        placeholder="Write feedback for this student..."
                    >{{ old('feedback', $submission->feedback) }}</textarea>

                    @error('feedback')
                        <small class="grading-error">
                            {{ $message }}
                        </small>
                    @enderror

                </div>


                <div class="grading-actions">

                    <button
                        type="button"
                        class="cancel-grade-btn"
                        id="cancelGradeModal"
                    >
                        Cancel
                    </button>

                    <button
                        type="submit"
                        class="save-grade-btn"
                    >
                        <i class="bx bx-save"></i>

                        {{ $submission->score !== null
                            ? 'Update Grade'
                            : 'Save Grade'
                        }}
                    </button>

                </div>

            </form>

        </div>

    </div>


</div>



{{-- ================================================================
    SUBMISSION FILE PREVIEW MODAL
================================================================= --}}

<div
    class="submission-preview-modal"
    id="submissionPreviewModal"
    aria-hidden="true"
>

    {{-- OVERLAY --}}
    <div
        class="submission-preview-overlay"
        id="submissionPreviewOverlay"
    ></div>


    {{-- MODAL CONTAINER --}}
    <div class="submission-preview-container">

        {{-- ========================================================
            MODAL HEADER
        ========================================================= --}}

        <div class="submission-preview-header">

            {{-- FILE TITLE --}}
            <div class="submission-preview-title">

                <i
                    class="bx bx-file"
                    id="submissionPreviewIcon"
                ></i>

                <span id="submissionPreviewTitle">
                    File Preview
                </span>

            </div>


            {{-- MODAL ACTIONS --}}
            <div class="submission-preview-actions">

                {{-- FULL SCREEN --}}
                <button
                    type="button"
                    class="submission-preview-btn"
                    id="submissionFullscreenBtn"
                    title="Full Screen"
                    aria-label="Full Screen"
                >
                    <i class="bx bx-fullscreen"></i>
                </button>


                {{-- CLOSE --}}
                <button
                    type="button"
                    class="submission-preview-btn close"
                    id="closeSubmissionBtn"
                    title="Close"
                    aria-label="Close"
                >
                    <i class="bx bx-x"></i>
                </button>

            </div>

        </div>


        {{-- ========================================================
            PREVIEW BODY
        ========================================================= --}}

        <div
            class="submission-preview-body"
            id="submissionPreviewBody"
        ></div>

    </div>

</div>

<style>

/* ============================================================
   STUDENT SUBMISSION PAGE
   Assignment theme: green accent, neutral base
   ============================================================ */

.student-submission-page {
    width: 100%;
    max-width: 1200px;
    margin: 0 auto;
    padding: 30px;
    box-sizing: border-box;
}

/* ============================================================
   HEADER
   ============================================================ */

.student-submission-header {
    margin-bottom: 30px;
}

/* ============================================================
   BACK BUTTON
   ============================================================ */

.student-submission-back {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    margin-bottom: 24px;
    color: var(--text-secondary);
    text-decoration: none;
    font-size: 14px;
    font-weight: 600;
    transition: color 0.2s ease, transform 0.2s ease;
}

.student-submission-back i {
    font-size: 20px;
}

.student-submission-back:hover {
    color: #16a34a;
    transform: translateX(-3px);
}

/* ============================================================
   ASSIGNMENT HEADING
   ============================================================ */

.student-submission-heading {
    display: flex;
    align-items: center;
    gap: 18px;
}

.student-submission-heading-content {
    min-width: 0;
}

.student-submission-assignment-icon {
    width: 62px;
    height: 62px;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
    border-radius: 16px;
    background: rgba(22, 163, 74, 0.11);
    color: #16a34a;
    font-size: 28px;
}

.student-submission-type {
    display: block;
    margin-bottom: 4px;
    color: #16a34a;
    font-size: 11px;
    font-weight: 700;
    letter-spacing: 0.08em;
}

.student-submission-heading h1 {
    margin: 0;
    color: var(--text-color);
    font-size: 30px;
    font-weight: 700;
    line-height: 1.25;
    word-break: break-word;
}

.student-submission-topic {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    margin-top: 7px;
    color: var(--text-secondary);
    font-size: 13px;
}

.student-submission-topic i {
    font-size: 16px;
    color: #16a34a;
}

/* ============================================================
   CARD
   ============================================================ */

.student-submission-card {
    position: relative;
    margin-bottom: 24px;
    background: var(--card-color);
    border: 1px solid var(--border-color);
    border-radius: 16px;
    overflow: hidden;
    box-shadow: 0 3px 14px rgba(0, 0, 0, 0.04);
}

/* ============================================================
   CARD HEADER
   ============================================================ */

.student-submission-card-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 16px;
    padding: 18px 20px;
    border-bottom: 1px solid var(--border-color);
}

.student-submission-card-header h2 {
    margin: 0;
    color: var(--text-color);
    font-size: 16px;
    font-weight: 650;
}

/* ============================================================
   STUDENT INFORMATION
   ============================================================ */

.student-information {
    display: flex;
    align-items: center;
    gap: 16px;
    padding: 20px;
}

.student-avatar {
    width: 52px;
    height: 52px;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
    overflow: hidden;
    border-radius: 50%;
    background: #f1f5f9;
    color: #64748b;
    font-size: 24px;
}

.student-avatar img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.student-details {
    min-width: 0;
    display: flex;
    flex-direction: column;
    gap: 4px;
}

.student-details strong {
    color: var(--text-color);
    font-size: 15px;
    font-weight: 650;
}

.student-details span {
    color: var(--text-secondary);
    font-size: 13px;
}

/* ============================================================
   FILE COUNT
   ============================================================ */

.submission-file-count {
    color: var(--text-secondary);
    font-size: 13px;
    font-weight: 500;
}

/* ============================================================
   SUBMITTED FILES
   ============================================================ */

.submission-files {
    display: flex;
    flex-direction: column;
    gap: 10px;
    padding: 16px 20px 20px;
}

.submission-file {
    display: flex;
    align-items: center;
    gap: 15px;
    padding: 14px;
    min-width: 0;
    border: 1px solid var(--border-color);
    border-radius: 12px;
    background: var(--card-color);
    transition: border-color 0.2s ease, background-color 0.2s ease, transform 0.2s ease;
}

.submission-file:hover {
    background: rgba(22, 163, 74, 0.025);
    border-color: rgba(22, 163, 74, 0.45);
    transform: translateY(-1px);
}

.submission-file-icon {
    width: 48px;
    height: 48px;
    min-width: 48px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 10px;
    background: #f1f5f9;
    color: #475569;
    font-size: 24px;
}

.submission-file-info {
    flex: 1;
    min-width: 0;
    display: flex;
    flex-direction: column;
    gap: 4px;
}

.submission-file-info strong {
    display: block;
    overflow: hidden;
    color: var(--text-color);
    font-size: 15px;
    font-weight: 500;
    text-overflow: ellipsis;
    white-space: nowrap;
}

.submission-file-info span {
    color: var(--text-secondary);
    font-size: 12px;
}

.submission-file-actions {
    display: flex;
    align-items: center;
    gap: 8px;
    flex-shrink: 0;
}

/* ============================================================
   FILE BUTTON
   ============================================================ */

.submission-file-btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 6px;
    min-height: 36px;
    padding: 7px 12px;
    border: 1px solid var(--border-color);
    border-radius: 8px;
    background: var(--card-color);
    color: var(--text-color);
    font-family: inherit;
    font-size: 13px;
    font-weight: 600;
    text-decoration: none;
    cursor: pointer;
    transition: background-color 0.2s ease, border-color 0.2s ease, color 0.2s ease, transform 0.2s ease;
}

.submission-file-btn:hover {
    background: rgba(22, 163, 74, 0.07);
    border-color: #16a34a;
    color: #16a34a;
    transform: translateY(-1px);
}

.submission-file-btn i {
    font-size: 17px;
}

/* ============================================================
   EMPTY STATE
   ============================================================ */

.submission-empty {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    padding: 40px 20px;
    text-align: center;
}

.submission-empty i {
    margin-bottom: 10px;
    color: var(--text-secondary);
    font-size: 32px;
}

.submission-empty p {
    margin: 0;
    color: var(--text-secondary);
    font-size: 13px;
}

/* ============================================================
   MARK CARD
   ============================================================ */

.student-submission-card.mark-card {
    border: 1px solid rgba(22, 163, 74, 0.28);
    box-shadow: 0 8px 24px rgba(22, 163, 74, 0.07);
}

.student-submission-card.mark-card::before {
    content: "";
    display: block;
    height: 4px;
    background: #16a34a;
}

.mark-card .student-submission-card-header {
    padding: 18px 20px;
    background: linear-gradient(
        180deg,
        rgba(22, 163, 74, 0.045),
        transparent
    );
}

.mark-card .student-submission-card-header h2 {
    font-size: 17px;
}

/* ============================================================
   GRADED STATUS
   ============================================================ */

.mark-status {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    padding: 6px 10px;
    border-radius: 20px;
    color: #15803d;
    background: #f0fdf4;
    font-size: 12px;
    font-weight: 600;
}

.mark-status i {
    font-size: 15px;
}

/* ============================================================
   MARK SUMMARY
   ============================================================ */

.mark-summary {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 20px;
    margin: 18px 20px 0;
    padding: 18px;
    border: 1px solid rgba(22, 163, 74, 0.18);
    border-radius: 14px;
    background: rgba(22, 163, 74, 0.035);
}

.mark-summary-left {
    display: flex;
    align-items: center;
    gap: 14px;
    min-width: 0;
}

.mark-summary-icon {
    width: 54px;
    height: 54px;
    min-width: 54px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 13px;
    background: rgba(22, 163, 74, 0.12);
    color: #16a34a;
    font-size: 25px;
}

.mark-summary-content {
    min-width: 0;
    display: flex;
    flex-direction: column;
    gap: 4px;
}

.mark-summary-content strong {
    color: #15803d;
    font-size: 28px;
    font-weight: 750;
    line-height: 1.1;
}

.mark-summary-content span {
    color: var(--text-secondary);
    font-size: 13px;
}

/* ============================================================
   GRADE BUTTON
   ============================================================ */

.open-grade-modal-btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    min-height: 42px;
    padding: 0 16px;
    border: 1px solid #16a34a;
    border-radius: 9px;
    background: #16a34a;
    color: #fff;
    font-family: inherit;
    font-size: 13px;
    font-weight: 650;
    cursor: pointer;
    transition: background-color 0.2s ease, border-color 0.2s ease, transform 0.2s ease, box-shadow 0.2s ease;
}

.open-grade-modal-btn:hover {
    background: #15803d;
    border-color: #15803d;
    transform: translateY(-1px);
    box-shadow: 0 5px 14px rgba(22, 163, 74, 0.20);
}

.open-grade-modal-btn i {
    font-size: 17px;
}

/* ============================================================
   FEEDBACK PREVIEW
   ============================================================ */

.mark-feedback-preview {
    margin: 16px 20px 0;
    padding: 13px 14px;
    border-left: 3px solid #16a34a;
    border-radius: 0 10px 10px 0;
    background: var(--background-color);
}

.mark-feedback-label {
    display: flex;
    align-items: center;
    gap: 7px;
    margin-bottom: 6px;
    color: var(--text-color);
    font-size: 12px;
    font-weight: 650;
}

.mark-feedback-label i {
    color: #16a34a;
    font-size: 16px;
}

.mark-feedback-preview p {
    margin: 0;
    color: var(--text-secondary);
    font-size: 13px;
    line-height: 1.55;
    white-space: pre-wrap;
    word-break: break-word;
}

/* ============================================================
   GRADED INFORMATION
   ============================================================ */

.graded-info {
    display: flex;
    align-items: center;
    gap: 8px;
    margin: 16px 20px 18px;
    padding: 10px 12px;
    border-radius: 9px;
    background: #f8fafc;
    color: var(--text-secondary);
    font-size: 13px;
}

.graded-info i {
    color: #16a34a;
    font-size: 17px;
}

/* ============================================================
   GRADE MODAL
   ============================================================ */

.grade-modal {
    position: fixed;
    inset: 0;
    z-index: 9999;
    display: none;
    align-items: center;
    justify-content: center;
    padding: 20px;
    box-sizing: border-box;
}

.grade-modal.is-open {
    display: flex;
}

.grade-modal-overlay {
    position: absolute;
    inset: 0;
    background: rgba(15, 23, 42, 0.48);
    backdrop-filter: blur(3px);
    -webkit-backdrop-filter: blur(3px);
    animation: gradeModalFadeIn 0.2s ease;
}

.grade-modal-dialog {
    position: relative;
    z-index: 1;
    width: 100%;
    max-width: 520px;
    max-height: calc(100vh - 40px);
    overflow-y: auto;
    background: var(--card-color);
    border: 1px solid var(--border-color);
    border-radius: 16px;
    box-shadow: 0 20px 60px rgba(0, 0, 0, 0.18);
    animation: gradeModalSlideIn 0.22s ease;
}

.grade-modal-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 16px;
    padding: 18px 20px;
    border-bottom: 1px solid var(--border-color);
}

.grade-modal-title {
    display: flex;
    align-items: center;
    gap: 12px;
    min-width: 0;
}

.grade-modal-icon {
    width: 42px;
    height: 42px;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
    border-radius: 10px;
    background: rgba(22, 163, 74, 0.11);
    color: #16a34a;
    font-size: 20px;
}

.grade-modal-title h2 {
    margin: 0 0 3px;
    color: var(--text-color);
    font-size: 17px;
    font-weight: 650;
}

.grade-modal-title p {
    margin: 0;
    overflow: hidden;
    color: var(--text-secondary);
    font-size: 12px;
    text-overflow: ellipsis;
    white-space: nowrap;
}

.grade-modal-close {
    width: 36px;
    height: 36px;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
    padding: 0;
    border: none;
    border-radius: 8px;
    background: transparent;
    color: var(--text-secondary);
    font-size: 22px;
    cursor: pointer;
    transition: background-color 0.2s ease, color 0.2s ease;
}

.grade-modal-close:hover {
    background: #f1f5f9;
    color: var(--text-color);
}

/* ============================================================
   GRADING FORM
   ============================================================ */

.grade-modal .grading-form {
    display: flex;
    flex-direction: column;
    gap: 22px;
    padding: 20px;
}

.grading-field {
    display: flex;
    flex-direction: column;
    gap: 8px;
}

.grading-field label {
    color: var(--text-color);
    font-size: 14px;
    font-weight: 600;
}

.grading-field label span {
    color: var(--text-secondary);
    font-weight: 400;
}

.score-input-wrapper {
    display: flex;
    align-items: center;
    gap: 10px;
    max-width: 240px;
}

.score-input-wrapper input {
    width: 150px;
    height: 46px;
    padding: 0 14px;
    box-sizing: border-box;
    border: 1px solid var(--border-color);
    border-radius: 8px;
    background: var(--card-color);
    color: var(--text-color);
    font-family: inherit;
    font-size: 15px;
    outline: none;
    transition: border-color 0.2s ease, box-shadow 0.2s ease;
}

.score-input-wrapper input:focus {
    border-color: #16a34a;
    box-shadow: 0 0 0 3px rgba(22, 163, 74, 0.10);
}

.score-input-wrapper span {
    color: var(--text-secondary);
    font-size: 15px;
    font-weight: 600;
}

.grading-field textarea {
    width: 100%;
    min-height: 120px;
    padding: 13px 14px;
    box-sizing: border-box;
    border: 1px solid var(--border-color);
    border-radius: 8px;
    background: var(--card-color);
    color: var(--text-color);
    font-family: inherit;
    font-size: 14px;
    resize: vertical;
    outline: none;
    transition: border-color 0.2s ease, box-shadow 0.2s ease;
}

.grading-field textarea:focus {
    border-color: #16a34a;
    box-shadow: 0 0 0 3px rgba(22, 163, 74, 0.10);
}

.grading-field textarea::placeholder {
    color: var(--text-secondary);
}

.grading-error {
    color: #dc2626;
    font-size: 13px;
}

/* ============================================================
   MODAL ACTIONS
   ============================================================ */

.grade-modal .grading-actions {
    display: flex;
    align-items: center;
    justify-content: flex-end;
    gap: 10px;
    margin-top: 2px;
}

.cancel-grade-btn,
.save-grade-btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    min-height: 42px;
    border-radius: 8px;
    font-family: inherit;
    font-size: 14px;
    font-weight: 600;
    cursor: pointer;
    transition: background-color 0.2s ease, border-color 0.2s ease, color 0.2s ease, transform 0.2s ease;
}

.cancel-grade-btn {
    padding: 0 16px;
    border: 1px solid var(--border-color);
    background: var(--card-color);
    color: var(--text-color);
}

.cancel-grade-btn:hover {
    background: var(--background-color);
    border-color: #16a34a;
    color: #15803d;
}

.save-grade-btn {
    padding: 0 18px;
    border: 1px solid #16a34a;
    background: #16a34a;
    color: #fff;
}

.save-grade-btn:hover {
    background: #15803d;
    border-color: #15803d;
    transform: translateY(-1px);
}

.save-grade-btn:active {
    transform: translateY(0);
}

.save-grade-btn i {
    font-size: 17px;
}

/* ============================================================
   MODAL ANIMATIONS
   ============================================================ */

@keyframes gradeModalFadeIn {
    from {
        opacity: 0;
    }

    to {
        opacity: 1;
    }
}

@keyframes gradeModalSlideIn {
    from {
        opacity: 0;
        transform: translateY(12px) scale(0.98);
    }

    to {
        opacity: 1;
        transform: translateY(0) scale(1);
    }
}

/* ============================================================
   RESPONSIVE — TABLET
   ============================================================ */

@media (max-width: 700px) {

    .student-submission-page {
        padding: 24px 18px 40px;
    }

    .student-submission-heading {
        align-items: flex-start;
    }

    .student-submission-assignment-icon {
        width: 54px;
        height: 54px;
        border-radius: 14px;
        font-size: 24px;
    }

    .student-submission-heading h1 {
        font-size: 25px;
    }

    .submission-file {
        align-items: flex-start;
        flex-wrap: wrap;
    }

    .submission-file-info {
        flex: 1;
    }

    .submission-file-actions {
        width: 100%;
        margin-left: 63px;
    }

    .submission-file-btn {
        flex: 1;
    }
}

/* ============================================================
   RESPONSIVE — MOBILE
   ============================================================ */

@media (max-width: 480px) {

    .student-submission-page {
        padding: 18px 14px 30px;
    }

    .student-submission-header {
        margin-bottom: 24px;
    }

    .student-submission-back {
        margin-bottom: 18px;
    }

    .student-submission-heading {
        gap: 12px;
    }

    .student-submission-assignment-icon {
        width: 46px;
        height: 46px;
        border-radius: 12px;
        font-size: 20px;
    }

    .student-submission-type {
        font-size: 10px;
    }

    .student-submission-heading h1 {
        font-size: 21px;
    }

    .student-submission-topic {
        font-size: 12px;
    }

    .student-submission-card {
        border-radius: 13px;
        margin-bottom: 18px;
    }

    .student-submission-card-header {
        padding: 16px;
    }

    .student-submission-card-header h2 {
        font-size: 15px;
    }

    .student-information {
        padding: 16px;
    }

    .student-avatar {
        width: 46px;
        height: 46px;
        font-size: 21px;
    }

    .student-details strong {
        font-size: 14px;
    }

    .student-details span {
        font-size: 12px;
    }

    .submission-files {
        padding: 14px 16px 16px;
    }

    .submission-file {
        gap: 10px;
        padding: 12px;
    }

    .submission-file-icon {
        width: 42px;
        height: 42px;
        min-width: 42px;
        font-size: 21px;
    }

    .submission-file-info strong {
        font-size: 13px;
    }

    .submission-file-info span {
        font-size: 11px;
    }

    .submission-file-actions {
        width: 100%;
        margin-left: 0;
    }

    .submission-file-btn {
        min-height: 34px;
        padding: 7px 9px;
        font-size: 12px;
    }

    .submission-file-btn i {
        font-size: 16px;
    }

    .mark-summary {
        align-items: flex-start;
        flex-direction: column;
        margin: 14px 16px 0;
        padding: 15px;
    }

    .mark-summary-content strong {
        font-size: 24px;
    }

    .open-grade-modal-btn {
        width: 100%;
    }

    .mark-feedback-preview {
        margin: 14px 16px 0;
    }

    .graded-info {
        margin: 14px 16px 16px;
    }

    .grade-modal {
        padding: 12px;
    }

    .grade-modal-dialog {
        max-height: calc(100vh - 24px);
        border-radius: 14px;
    }

    .grade-modal-header {
        padding: 16px;
    }

    .grade-modal .grading-form {
        gap: 18px;
        padding: 16px;
    }

    .grade-modal .grading-actions {
        justify-content: stretch;
        flex-direction: column-reverse;
    }

    .cancel-grade-btn,
    .save-grade-btn {
        width: 100%;
    }

    .score-input-wrapper {
        max-width: none;
    }

    .score-input-wrapper input {
        flex: 1;
        width: auto;
    }
}


/* ============================================================
   SUBMISSION FILE PREVIEW MODAL
   Same fullscreen + close pattern as Quiz Submission
   Assignment accent: green
============================================================ */

.submission-preview-modal {
    position: fixed;
    inset: 0;
    z-index: 9999;
    display: flex;
    align-items: center;
    justify-content: center;
    width: 100%;
    height: 100%;
    padding: 30px;
    box-sizing: border-box;
    visibility: hidden;
    opacity: 0;
    transition:
        opacity 0.2s ease,
        visibility 0.2s ease;
}

.submission-preview-modal.active {
    visibility: visible;
    opacity: 1;
}

.submission-preview-overlay {
    position: absolute;
    inset: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.65);
    backdrop-filter: blur(3px);
    -webkit-backdrop-filter: blur(3px);
}

.submission-preview-container {
    position: relative;
    z-index: 1;
    width: min(1400px, 92vw);
    height: min(850px, 90vh);
    display: flex;
    flex-direction: column;
    overflow: hidden;
    background: var(--card-color);
    border: 1px solid var(--border-color);
    border-radius: 16px;
    box-shadow: 0 25px 60px rgba(0, 0, 0, 0.25);
    transform: scale(0.96);
    transition: transform 0.2s ease;
}

.submission-preview-modal.active .submission-preview-container {
    transform: scale(1);
}

.submission-preview-header {
    min-height: 60px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 20px;
    padding: 12px 18px;
    box-sizing: border-box;
    background: var(--card-color);
    border-bottom: 1px solid var(--border-color);
    flex-shrink: 0;
}

.submission-preview-title {
    min-width: 0;
    display: flex;
    align-items: center;
    gap: 10px;
    color: var(--text-color);
    font-size: 14px;
    font-weight: 600;
}

.submission-preview-title i {
    flex-shrink: 0;
    font-size: 22px;
    color: #16a34a;
}

#submissionPreviewTitle {
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
}

.submission-preview-actions {
    display: flex;
    align-items: center;
    gap: 6px;
    flex-shrink: 0;
}

.submission-preview-btn {
    width: 38px;
    height: 38px;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 0;
    border: none;
    border-radius: 8px;
    background: transparent;
    color: var(--text-color);
    cursor: pointer;
    transition:
        background-color 0.2s ease,
        color 0.2s ease,
        transform 0.2s ease;
}

.submission-preview-btn i {
    font-size: 21px;
}

.submission-preview-btn:hover {
    background: var(--background-color);
    color: #16a34a;
}

.submission-preview-btn:active {
    transform: scale(0.95);
}

.submission-preview-btn.close:hover {
    background: #fee2e2;
    color: #dc2626;
}

.submission-preview-body {
    position: relative;
    flex: 1;
    min-height: 0;
    display: flex;
    align-items: center;
    justify-content: center;
    background: #f1f5f9;
    overflow: hidden;
}

.submission-preview-frame {
    width: 100%;
    height: 100%;
    display: block;
    border: none;
    background: #fff;
}

.submission-preview-image-wrapper {
    width: 100%;
    height: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 30px;
    box-sizing: border-box;
    overflow: auto;
}

.submission-preview-image {
    display: block;
    width: auto;
    height: auto;
    max-width: 100%;
    max-height: 100%;
    object-fit: contain;
    border-radius: 8px;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
}

.submission-preview-video {
    display: block;
    width: 100%;
    height: 100%;
    max-width: 1200px;
    max-height: 100%;
    object-fit: contain;
    background: #000;
}

.submission-preview-audio-wrapper {
    width: min(650px, 90%);
    padding: 40px;
    box-sizing: border-box;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    gap: 25px;
    background: var(--card-color);
    border: 1px solid var(--border-color);
    border-radius: 16px;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
}

.submission-preview-audio-wrapper::before {
    content: "♪";
    width: 80px;
    height: 80px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 50%;
    background: rgba(22, 163, 74, 0.10);
    color: #16a34a;
    font-size: 40px;
}

.submission-preview-audio-wrapper audio {
    width: 100%;
}

.submission-preview-unavailable {
    width: min(500px, 90%);
    padding: 45px 35px;
    box-sizing: border-box;
    text-align: center;
    background: var(--card-color);
    border: 1px solid var(--border-color);
    border-radius: 16px;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.06);
}

.submission-preview-unavailable > i {
    margin-bottom: 15px;
    font-size: 55px;
    color: var(--text-secondary);
}

.submission-preview-unavailable h3 {
    margin: 0 0 8px;
    color: var(--text-color);
    font-size: 18px;
    font-weight: 600;
}

.submission-preview-unavailable p {
    margin: 0 0 25px;
    color: var(--text-secondary);
    font-size: 14px;
    line-height: 1.6;
}

.submission-preview-download {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    padding: 10px 18px;
    border-radius: 8px;
    background: #16a34a;
    color: #fff;
    text-decoration: none;
    font-size: 14px;
    font-weight: 600;
}

.submission-preview-download:hover {
    background: #15803d;
    color: #fff;
}

.submission-preview-modal.fullscreen {
    padding: 0;
    align-items: stretch;
    justify-content: stretch;
}

.submission-preview-modal.fullscreen .submission-preview-overlay {
    background: #000;
}

.submission-preview-modal.fullscreen .submission-preview-container {
    width: 100vw;
    height: 100vh;
    max-width: none;
    max-height: none;
    border-radius: 0;
}

body.modal-open {
    overflow: hidden;
}

@media (max-width: 700px) {
    .submission-preview-modal {
        padding: 10px;
    }

    .submission-preview-container {
        width: 96vw;
        height: 92vh;
        border-radius: 12px;
    }

    .submission-preview-header {
        padding: 10px 12px;
    }

    .submission-preview-btn {
        width: 34px;
        height: 34px;
    }

    .submission-preview-image-wrapper {
        padding: 15px;
    }
}

@media (max-width: 480px) {
    .submission-preview-modal {
        padding: 0;
    }

    .submission-preview-container {
        width: 100vw;
        height: 100vh;
        border-radius: 0;
    }

    .submission-preview-header {
        min-height: 54px;
        padding: 10px 12px;
    }

    .submission-preview-title {
        font-size: 13px;
    }

    .submission-preview-btn {
        width: 34px;
        height: 34px;
    }

    .submission-preview-image-wrapper {
        padding: 15px;
    }

    .submission-preview-audio-wrapper {
        width: 92%;
        padding: 25px 20px;
    }

    .submission-preview-unavailable {
        padding: 35px 20px;
    }
}

</style>

<script>
document.addEventListener('DOMContentLoaded', function () {

    const modal = document.getElementById('gradeModal');
    const openButton = document.getElementById('openGradeModal');
    const closeButton = document.getElementById('closeGradeModal');
    const cancelButton = document.getElementById('cancelGradeModal');
    const overlay = document.getElementById('gradeModalOverlay');
    const scoreInput = document.getElementById('score');

    if (!modal || !openButton) {
        console.error('Grade modal elements were not found.');
        return;
    }

    function openModal() {
        modal.classList.add('is-open');
        modal.setAttribute('aria-hidden', 'false');
        document.body.style.overflow = 'hidden';

        if (scoreInput) {
            setTimeout(function () {
                scoreInput.focus();
            }, 100);
        }
    }

    function closeModal() {
        modal.classList.remove('is-open');
        modal.setAttribute('aria-hidden', 'true');
        document.body.style.overflow = '';
    }

    openButton.addEventListener('click', function (event) {
        event.preventDefault();
        openModal();
    });

    if (closeButton) {
        closeButton.addEventListener('click', closeModal);
    }

    if (cancelButton) {
        cancelButton.addEventListener('click', closeModal);
    }

    if (overlay) {
        overlay.addEventListener('click', closeModal);
    }

    document.addEventListener('keydown', function (event) {
        if (event.key === 'Escape' && modal.classList.contains('is-open')) {
            closeModal();
        }
    });

});
</script>


<script>

/* ============================================================
   SUBMISSION FILE PREVIEW
   Same fullscreen + close behavior as Quiz Submission
============================================================ */

document.addEventListener('DOMContentLoaded', function () {

    const modal =
        document.getElementById(
            'submissionPreviewModal'
        );

    const closeBtn =
        document.getElementById(
            'closeSubmissionBtn'
        );

    const overlay =
        document.getElementById(
            'submissionPreviewOverlay'
        );

    const fullscreenBtn =
        document.getElementById(
            'submissionFullscreenBtn'
        );

    const previewBody =
        document.getElementById(
            'submissionPreviewBody'
        );

    const previewTitle =
        document.getElementById(
            'submissionPreviewTitle'
        );

    const previewIcon =
        document.getElementById(
            'submissionPreviewIcon'
        );


    if (
        !modal ||
        !closeBtn ||
        !overlay ||
        !fullscreenBtn ||
        !previewBody ||
        !previewTitle ||
        !previewIcon
    ) {
        return;
    }


    window.openSubmissionPreview = function (
        fileUrl,
        extension,
        fileName
    ) {

        extension =
            String(extension || '').toLowerCase();

        previewTitle.textContent =
            fileName || 'File Preview';

        previewBody.innerHTML = '';


        /* PDF */
        if (extension === 'pdf') {

            previewIcon.className =
                'bx bxs-file-pdf';

            const iframe =
                document.createElement('iframe');

            iframe.src = fileUrl;

            iframe.title =
                fileName || 'PDF Preview';

            iframe.className =
                'submission-preview-frame';

            previewBody.appendChild(
                iframe
            );
        }


        /* IMAGE */
        else if ([
            'jpg',
            'jpeg',
            'png',
            'gif',
            'webp'
        ].includes(extension)) {

            previewIcon.className =
                'bx bx-image';

            const wrapper =
                document.createElement('div');

            wrapper.className =
                'submission-preview-image-wrapper';

            const image =
                document.createElement('img');

            image.src = fileUrl;

            image.alt =
                fileName || 'Image Preview';

            image.className =
                'submission-preview-image';

            wrapper.appendChild(image);

            previewBody.appendChild(wrapper);
        }


        /* VIDEO */
        else if ([
            'mp4',
            'webm',
            'mov',
            'avi'
        ].includes(extension)) {

            previewIcon.className =
                'bx bx-video';

            const video =
                document.createElement('video');

            video.src = fileUrl;
            video.controls = true;
            video.autoplay = false;
            video.className =
                'submission-preview-video';

            previewBody.appendChild(
                video
            );
        }


        /* AUDIO */
        else if ([
            'mp3',
            'wav',
            'ogg',
            'm4a'
        ].includes(extension)) {

            previewIcon.className =
                'bx bx-music';

            const wrapper =
                document.createElement('div');

            wrapper.className =
                'submission-preview-audio-wrapper';

            const audio =
                document.createElement('audio');

            audio.src = fileUrl;
            audio.controls = true;

            wrapper.appendChild(audio);

            previewBody.appendChild(
                wrapper
            );
        }


        /* UNSUPPORTED */
        else {

            previewIcon.className =
                'bx bx-file';

            const unavailable =
                document.createElement('div');

            unavailable.className =
                'submission-preview-unavailable';


            const icon =
                document.createElement('i');

            icon.className =
                'bx bx-file';

            unavailable.appendChild(
                icon
            );


            const heading =
                document.createElement('h3');

            heading.textContent =
                'Preview not available';

            unavailable.appendChild(
                heading
            );


            const paragraph =
                document.createElement('p');

            paragraph.textContent =
                'This file type cannot be previewed in the browser.';

            unavailable.appendChild(
                paragraph
            );


            const download =
                document.createElement('a');

            download.href = fileUrl;
            download.target = '_blank';
            download.rel =
                'noopener noreferrer';

            download.className =
                'submission-preview-download';

            download.innerHTML =
                '<i class="bx bx-download"></i> Open / Download File';

            unavailable.appendChild(
                download
            );

            previewBody.appendChild(
                unavailable
            );
        }


        modal.classList.add('active');

        modal.setAttribute(
            'aria-hidden',
            'false'
        );

        document.body.classList.add(
            'modal-open'
        );
    };


    function closeSubmissionModal() {

        modal.classList.remove(
            'active'
        );

        modal.classList.remove(
            'fullscreen'
        );

        modal.setAttribute(
            'aria-hidden',
            'true'
        );

        document.body.classList.remove(
            'modal-open'
        );

        previewBody.innerHTML = '';

        updateFullscreenIcon();
    }


    function toggleFullscreen() {

        modal.classList.toggle(
            'fullscreen'
        );

        updateFullscreenIcon();
    }


    function updateFullscreenIcon() {

        const icon =
            fullscreenBtn.querySelector('i');

        if (!icon) {
            return;
        }


        if (
            modal.classList.contains(
                'fullscreen'
            )
        ) {

            icon.className =
                'bx bx-exit-fullscreen';

            fullscreenBtn.setAttribute(
                'title',
                'Exit Full Screen'
            );

            fullscreenBtn.setAttribute(
                'aria-label',
                'Exit Full Screen'
            );

        } else {

            icon.className =
                'bx bx-fullscreen';

            fullscreenBtn.setAttribute(
                'title',
                'Full Screen'
            );

            fullscreenBtn.setAttribute(
                'aria-label',
                'Full Screen'
            );
        }
    }


    closeBtn.addEventListener(
        'click',
        closeSubmissionModal
    );

    overlay.addEventListener(
        'click',
        closeSubmissionModal
    );

    fullscreenBtn.addEventListener(
        'click',
        toggleFullscreen
    );


    document.addEventListener(
        'keydown',
        function (event) {

            if (
                event.key !== 'Escape' ||
                !modal.classList.contains(
                    'active'
                )
            ) {
                return;
            }


            if (
                modal.classList.contains(
                    'fullscreen'
                )
            ) {

                modal.classList.remove(
                    'fullscreen'
                );

                updateFullscreenIcon();

            } else {

                closeSubmissionModal();
            }
        }
    );

});

</script>

@endsection
