<style>
    /* ============================================================
   CLASSWORK SHOW PAGE
   Used by:
   - Assignment Show
   - Material Show
   - Quiz Show
   - Exam Show
   ============================================================ */

    .classwork-show-page {
        width: 100%;
        max-width: 1200px;
        margin: 0 auto;
        padding: 30px 24px 50px;
    }


    /* ============================================================
   HEADER
   ============================================================ */

    .classwork-show-header {
        margin-bottom: 28px;
    }

    .classwork-back-btn {
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

    .classwork-back-btn i {
        font-size: 20px;
    }

    .classwork-back-btn:hover {
        color: var(--primary-color);
    }


    /* ============================================================
   CLASSWORK HEADING
   ============================================================ */

    .classwork-show-heading {
        display: flex;
        align-items: center;
        gap: 18px;
    }

    .classwork-show-icon {
        width: 58px;
        height: 58px;

        flex-shrink: 0;

        display: flex;
        align-items: center;
        justify-content: center;

        border-radius: 15px;

        font-size: 28px;
    }


    /* ============================================================
   EXAM ICON
   ============================================================ */

    .classwork-show-icon.exam {
        background-color: #fef3c7;
        color: #d97706;
    }


    /* ============================================================
   CLASSWORK TYPE
   ============================================================ */

    .classwork-show-type {
        display: inline-block;

        margin-bottom: 5px;

        font-size: 12px;
        font-weight: 700;

        letter-spacing: 0.08em;
    }

    .classwork-show-type.exam {
        color: #d97706;
    }


    /* ============================================================
   TITLE
   ============================================================ */

    .classwork-show-heading h1 {
        margin: 0;

        color: var(--text-color);

        font-size: 28px;
        font-weight: 700;
        line-height: 1.25;

        word-break: break-word;
    }


    /* ============================================================
   TOPIC
   ============================================================ */

    .classwork-show-topic {
        display: inline-flex;
        align-items: center;
        gap: 6px;

        margin-top: 8px;

        color: var(--text-secondary);

        font-size: 14px;
        font-weight: 500;
    }

    .classwork-show-topic i {
        font-size: 17px;
    }


    /* ============================================================
   MAIN GRID
   ============================================================ */

    .classwork-show-grid {
        display: grid;
        grid-template-columns: minmax(0, 1fr) 320px;

        gap: 24px;

        align-items: start;
    }

    .classwork-show-main {
        min-width: 0;
    }

    .classwork-show-sidebar {
        min-width: 0;

        display: flex;
        flex-direction: column;
        gap: 24px;
    }


    /* ============================================================
   DETAIL CARD
   ============================================================ */

    .classwork-detail-card {
        background-color: var(--card-color);

        border: 1px solid var(--border-color);
        border-radius: 16px;

        overflow: hidden;

        margin-bottom: 24px;
    }

    .classwork-show-sidebar .classwork-detail-card {
        margin-bottom: 0;
    }


    /* ============================================================
   CARD HEADER
   ============================================================ */

    .classwork-detail-card-header {
        display: flex;
        align-items: center;

        padding: 18px 22px;

        border-bottom: 1px solid var(--border-color);
    }

    .classwork-detail-card-header h2 {
        margin: 0;

        color: var(--text-color);

        font-size: 17px;
        font-weight: 700;
    }


    /* ============================================================
   DESCRIPTION
   ============================================================ */

    .classwork-description {
        padding: 22px;

        color: var(--text-secondary);

        font-size: 15px;
        line-height: 1.7;

        white-space: normal;
        overflow-wrap: anywhere;
    }

    .classwork-no-content {
        color: var(--text-muted);
        font-style: italic;
    }


    /* ============================================================
   STUDENT SUBMISSION SUMMARY
   ============================================================ */

    .submission-summary {
        display: flex;
        align-items: center;
        gap: 14px;

        padding: 20px 22px;

        border-bottom: 1px solid var(--border-color);
    }

    .submission-summary-icon {
        width: 44px;
        height: 44px;

        flex-shrink: 0;

        display: flex;
        align-items: center;
        justify-content: center;

        border-radius: 12px;

        background-color: var(--background-color);
        color: var(--text-secondary);

        font-size: 22px;
    }

    .submission-summary strong {
        display: block;

        margin-bottom: 3px;

        color: var(--text-color);

        font-size: 18px;
        font-weight: 700;
    }

    .submission-summary span {
        display: block;

        color: var(--text-secondary);

        font-size: 13px;
    }


    /* ============================================================
   SUBMISSION PLACEHOLDER
   ============================================================ */

    .submission-placeholder {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;

        padding: 40px 24px;

        text-align: center;
    }

    .submission-placeholder i {
        margin-bottom: 10px;

        color: var(--text-muted);

        font-size: 32px;
    }

    .submission-placeholder p {
        margin: 0;

        color: var(--text-muted);

        font-size: 14px;
        line-height: 1.5;
    }


    /* ============================================================
   INFORMATION LIST
   ============================================================ */

    .classwork-info-list {
        display: flex;
        flex-direction: column;
    }

    .classwork-info-item {
        display: flex;
        align-items: center;
        gap: 14px;

        padding: 17px 22px;

        border-bottom: 1px solid var(--border-color);
    }

    .classwork-info-item:last-child {
        border-bottom: none;
    }

    .classwork-info-item>i {
        width: 20px;

        flex-shrink: 0;

        color: var(--text-secondary);

        font-size: 20px;
    }

    .classwork-info-item>div {
        display: flex;
        flex-direction: column;
        gap: 3px;

        min-width: 0;
    }

    .classwork-info-item span {
        color: var(--text-secondary);

        font-size: 12px;
        font-weight: 500;
    }

    .classwork-info-item strong {
        color: var(--text-color);

        font-size: 14px;
        font-weight: 600;

        word-break: break-word;
    }

    /* ============================================================
   ATTACHED FILE
============================================================ */

    .classwork-file {
        display: flex;
        align-items: center;
        gap: 14px;

        padding: 18px 22px;
    }


    /* FILE ICON */

    .classwork-file-icon {
        width: 46px;
        height: 46px;

        flex-shrink: 0;

        display: flex;
        align-items: center;
        justify-content: center;

        border-radius: 10px;

        background-color: var(--background-color);
        color: var(--text-secondary);

        font-size: 23px;
    }


    /* FILE INFORMATION */

    .classwork-file-info {
        flex: 1;
        min-width: 0;

        display: flex;
        flex-direction: column;

        gap: 4px;
    }

    .classwork-file-info strong {
        color: var(--text-color);

        font-size: 14px;
        font-weight: 600;

        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }

    .classwork-file-info span {
        color: var(--text-secondary);

        font-size: 12px;
    }


    /* OPEN BUTTON */

    .classwork-file-open {
        flex-shrink: 0;

        display: inline-flex;
        align-items: center;
        justify-content: center;

        gap: 7px;

        padding: 8px 14px;

        border: 1px solid var(--border-color);
        border-radius: 9px;

        background-color: var(--background-color);

        color: var(--text-color);

        font-size: 13px;
        font-weight: 600;

        cursor: pointer;

        transition:
            background-color 0.2s ease,
            border-color 0.2s ease,
            color 0.2s ease,
            transform 0.2s ease;
    }

    .classwork-file-open i {
        font-size: 17px;
    }

    .classwork-file-open:hover {
        background-color: var(--card-hover-color, var(--background-color));

        border-color: var(--primary-color);

        color: var(--primary-color);

        transform: translateY(-1px);
    }


    /* ============================================================
   FILE PREVIEW MODAL
============================================================ */

    .file-preview-modal {
        position: fixed;
        inset: 0;

        z-index: 9999;

        display: none;

        align-items: center;
        justify-content: center;

        padding: 30px;

        background: rgba(0, 0, 0, 0.65);
    }

    .file-preview-modal.active {
        display: flex;
    }


    /* ============================================================
   MODAL CONTAINER
============================================================ */

    .file-preview-container {
        width: 100%;
        max-width: 1200px;
        height: 90vh;

        display: flex;
        flex-direction: column;

        overflow: hidden;

        background-color: var(--card-color);

        border: 1px solid var(--border-color);

        border-radius: 16px;

        box-shadow:
            0 20px 60px rgba(0, 0, 0, 0.3);
    }


    /* ============================================================
   MODAL HEADER
============================================================ */

    .file-preview-header {
        min-height: 60px;

        display: flex;
        align-items: center;
        justify-content: space-between;

        padding: 0 18px;

        background-color: var(--card-color);

        border-bottom: 1px solid var(--border-color);

        flex-shrink: 0;
    }


    /* MODAL TITLE */

    .file-preview-title {
        display: flex;
        align-items: center;

        gap: 10px;

        min-width: 0;

        color: var(--text-color);

        font-size: 15px;
        font-weight: 600;
    }

    .file-preview-title i {
        flex-shrink: 0;

        font-size: 21px;
    }


    /* ============================================================
   MODAL ACTIONS
============================================================ */

    .file-preview-actions {
        display: flex;
        align-items: center;

        gap: 6px;
    }

    .file-preview-action {
        width: 38px;
        height: 38px;

        display: flex;
        align-items: center;
        justify-content: center;

        border: none;
        border-radius: 8px;

        background-color: transparent;

        color: var(--text-color);

        cursor: pointer;

        transition:
            background-color 0.2s ease,
            color 0.2s ease,
            transform 0.2s ease;
    }

    .file-preview-action i {
        font-size: 21px;
    }

    .file-preview-action:hover {
        background-color: var(--background-color);

        color: var(--primary-color);

        transform: translateY(-1px);
    }


    /* ============================================================
   PREVIEW BODY
============================================================ */

    .file-preview-body {
        flex: 1;

        min-height: 0;

        background-color: #f4f4f4;
    }

    .file-preview-body iframe {
        width: 100%;
        height: 100%;

        display: block;

        border: none;
    }


    /* ============================================================
   PREVENT BACKGROUND SCROLL
============================================================ */

    body.modal-open {
        overflow: hidden;
    }


    /* ============================================================
   FULL SCREEN
============================================================ */

    .file-preview-container:fullscreen {
        width: 100vw;
        height: 100vh;

        max-width: none;

        border: none;
        border-radius: 0;
    }

    .file-preview-container:fullscreen .file-preview-header {
        border-radius: 0;
    }


    /* ============================================================
   STUDENT SUBMISSIONS
============================================================ */

    .submission-list {
        display: flex;
        flex-direction: column;
        gap: 12px;
        padding: 16px 20px 20px;
    }

    .submission-item {
        display: flex;
        align-items: center;
        gap: 14px;
        padding: 16px;
        border: 1px solid var(--border-color);
        border-radius: 12px;
        background: var(--card-color);
        transition:
            border-color 0.2s ease,
            background-color 0.2s ease,
            transform 0.2s ease;
    }

    .submission-item:hover {
        border-color: #d97706;
        background: var(--background-color);
        transform: translateY(-1px);
    }

    .submission-student-icon {
        width: 42px;
        height: 42px;
        min-width: 42px;
        flex-shrink: 0;

        display: flex;
        align-items: center;
        justify-content: center;

        border-radius: 50%;
        background: #f1f5f9;
        color: #64748b;
        font-size: 20px;
    }

    .submission-student-info {
        flex: 1;
        min-width: 0;

        display: flex;
        flex-direction: column;
        gap: 4px;
    }

    .submission-student-info strong {
        color: var(--text-color);
        font-size: 15px;
        font-weight: 600;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }

    .submission-student-info span {
        color: var(--text-secondary);
        font-size: 13px;
    }

    .submission-grade-status {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 6px 10px;
        border-radius: 8px;
        font-size: 12px;
        font-weight: 650;
        white-space: nowrap;
        flex-shrink: 0;
    }

    .submission-grade-status.graded {
        background: rgba(34, 197, 94, 0.10);
        color: #16a34a;
    }

    .submission-grade-status.graded i,
    .submission-grade-status.ungraded i {
        font-size: 15px;
    }

    .submission-grade-status.ungraded {
        background: rgba(245, 158, 11, 0.10);
        color: #d97706;
    }

    .submission-grade-score {
        margin-left: 4px;
        font-weight: 700;
    }

    .submission-view-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 7px;

        flex-shrink: 0;
        padding: 9px 14px;
        border-radius: 8px;

        background: var(--background-color);
        border: 1px solid var(--border-color);
        color: var(--text-color);

        text-decoration: none;
        font-size: 13px;
        font-weight: 600;

        transition:
            background-color 0.2s ease,
            border-color 0.2s ease,
            color 0.2s ease,
            transform 0.2s ease;
    }

    .submission-view-btn i {
        font-size: 17px;
    }

    .submission-view-btn:hover {
        background: #d97706;
        border-color: #d97706;
        color: #fff;
        transform: translateY(-1px);
    }

    @media (max-width: 700px) {
        .submission-list {
            padding: 14px 16px 16px;
        }

        .submission-item {
            align-items: flex-start;
            flex-wrap: wrap;
        }

        .submission-student-info {
            flex: 1;
        }

        .submission-grade-status {
            margin-left: 56px;
        }

        .submission-view-btn {
            margin-left: auto;
        }
    }

    /* ============================================================
   ATTACHMENT RESPONSIVE
============================================================ */

    @media (max-width: 650px) {

        .classwork-file {
            align-items: flex-start;

            padding: 16px 18px;
        }

        .classwork-file-icon {
            width: 42px;
            height: 42px;

            font-size: 21px;
        }

        .classwork-file-info strong {
            white-space: normal;
            overflow-wrap: anywhere;
        }

        .classwork-file-open {
            padding: 8px 11px;

            font-size: 12px;
        }

        .classwork-file-open i {
            font-size: 16px;
        }


        /* MODAL */

        .file-preview-modal {
            padding: 10px;
        }

        .file-preview-container {
            height: 95vh;

            border-radius: 10px;
        }

        .file-preview-header {
            min-height: 54px;

            padding: 0 12px;
        }

        .file-preview-title {
            font-size: 14px;
        }

        .file-preview-action {
            width: 36px;
            height: 36px;
        }

    }

    /* ============================================================
   ACTIONS
   ============================================================ */

    .classwork-action-btn {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;

        margin: 16px;

        padding: 11px 16px;

        background-color: var(--background-color);

        border: 1px solid var(--border-color);
        border-radius: 10px;

        color: var(--text-color);

        text-decoration: none;

        font-size: 14px;
        font-weight: 600;

        transition:
            background-color 0.2s ease,
            border-color 0.2s ease,
            color 0.2s ease,
            transform 0.2s ease;
    }

    .classwork-action-btn i {
        font-size: 18px;
    }

    .classwork-action-btn:hover {
        background-color: var(--card-hover-color, var(--background-color));
        border-color: var(--primary-color);
        color: var(--primary-color);

        transform: translateY(-1px);
    }

    /* ============================================================
   GOOGLE FORM
   ============================================================ */

    .exam-form-section {
        padding: 20px;
    }

    .exam-form-box {
        display: flex;
        align-items: center;
        gap: 15px;

        padding: 16px;

        border: 1px solid var(--border-color);
        border-radius: 12px;

        background-color: var(--card-color);
    }

    .exam-form-icon {
        width: 44px;
        height: 44px;

        flex-shrink: 0;

        display: flex;
        align-items: center;
        justify-content: center;

        border-radius: 10px;

        background-color: #fef3c7;
        color: #d97706;

        font-size: 21px;
    }

    .exam-form-info {
        flex: 1;

        display: flex;
        flex-direction: column;
        gap: 4px;
    }

    .exam-form-info strong {
        color: var(--text-color);

        font-size: 14px;
        font-weight: 650;
    }

    .exam-form-info span {
        color: var(--text-secondary);

        font-size: 12px;
        line-height: 1.5;
    }

    .exam-form-open {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 7px;

        padding: 10px 14px;

        border-radius: 9px;

        background-color: var(--button-color);
        color: #ffffff;

        font-size: 13px;
        font-weight: 600;

        text-decoration: none;

        transition:
            transform 0.2s ease,
            opacity 0.2s ease;
    }

    .exam-form-open:hover {
        opacity: 0.9;
        transform: translateY(-1px);
    }


    /* ============================================================
   GRADE STATUS
============================================================ */

.submission-grade-status {
    display: inline-flex;
    align-items: center;
    gap: 6px;

    padding: 6px 10px;

    border-radius: 8px;

    font-size: 12px;
    font-weight: 650;

    white-space: nowrap;
}

.submission-grade-status.graded {
    background: rgba(34, 197, 94, 0.10);
    color: #16a34a;
}

.submission-grade-status.graded i {
    font-size: 15px;
}

.submission-grade-status.ungraded {
    background: rgba(245, 158, 11, 0.10);
    color: #d97706;
}

.submission-grade-status.ungraded i {
    font-size: 15px;
}

.submission-grade-score {
    margin-left: 4px;
    font-weight: 700;
}
    @media (max-width: 600px) {

        .exam-form-box {
            align-items: flex-start;
            flex-wrap: wrap;
        }

        .exam-form-open {
            width: 100%;
        }
    }

    /* ============================================================
   EXAM ACTION BUTTON
   ============================================================ */

    .classwork-show-icon.exam+div .classwork-show-type.exam {
        color: #d97706;
    }



    /* ============================================================
   RESPONSIVE
   ============================================================ */

    @media (max-width: 900px) {

        .classwork-show-grid {
            grid-template-columns: 1fr;
        }

        .classwork-show-sidebar {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 20px;
        }

        .classwork-show-sidebar .classwork-detail-card {
            margin-bottom: 0;
        }
    }


    @media (max-width: 650px) {

        .classwork-show-page {
            padding: 20px 16px 40px;
        }

        .classwork-show-heading {
            align-items: flex-start;
            gap: 14px;
        }

        .classwork-show-icon {
            width: 48px;
            height: 48px;

            border-radius: 12px;

            font-size: 23px;
        }

        .classwork-show-heading h1 {
            font-size: 22px;
        }

        .classwork-show-type {
            font-size: 11px;
        }

        .classwork-show-topic {
            font-size: 13px;
        }

        .classwork-show-sidebar {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        .classwork-detail-card-header {
            padding: 16px 18px;
        }

        .classwork-detail-card-header h2 {
            font-size: 16px;
        }

        .classwork-description {
            padding: 18px;

            font-size: 14px;
        }

        .submission-summary {
            padding: 17px 18px;
        }

        .classwork-info-item {
            padding: 15px 18px;
        }

        .classwork-action-btn {
            margin: 14px;
        }
    }


    /* ============================================================
   DARK MODE
   ============================================================ */

    [data-theme="dark"] .classwork-show-icon.exam {
        background-color: rgba(217, 119, 6, 0.15);
        color: #f59e0b;
    }

    [data-theme="dark"] .classwork-show-type.exam {
        color: #f59e0b;
    }
</style>
@extends('layouts.prof_layout')

@section('title', 'Exam')

@section('content')

<div class="classwork-show-page">

    {{-- HEADER --}}

    <div class="classwork-show-header">


        <a
            href="{{
                $returnTo === 'marks'
                    ? route(
                        'professor.class-groups.marks',
                        $classGroup
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
            }}"
            class="classwork-back-btn">

            <i class="bx bx-arrow-back"></i>

            {{ $returnTo === 'marks'
                ? 'Back to Marks'
                : ($returnTo === 'classwork'
                    ? 'Back to Classwork'
                    : 'Back to Stream'
                )
            }}

        </a>

        <div class="classwork-show-heading">

            <div class="classwork-show-icon exam">
                <i class="bx bx-edit-alt"></i>
            </div>

            <div>

                <span class="classwork-show-type exam">
                    EXAM
                </span>

                <h1>
                    {{ $exam->title }}
                </h1>

                @if($exam->topic)

                <div class="classwork-show-topic">

                    <i class="bx bx-folder"></i>

                    {{ $exam->topic->topic_name }}

                </div>

                @endif

            </div>

        </div>

    </div>


    <div class="classwork-show-grid">

        <div class="classwork-show-main">

            {{-- DESCRIPTION --}}

            <section class="classwork-detail-card">

                <div class="classwork-detail-card-header">

                    <h2>
                        Exam Instructions
                    </h2>

                </div>

                <div class="classwork-description">

                    @if($exam->description)

                    {!! nl2br(e($exam->description)) !!}

                    @else

                    <span class="classwork-no-content">
                        No description provided.
                    </span>

                    @endif

                </div>

            </section>

            {{-- ====================================================
     GOOGLE FORM
===================================================== --}}

            @if($exam->google_form_url)

            <section class="classwork-detail-card">

                <div class="classwork-detail-card-header">
                    <h2>
                        Exam Form
                    </h2>
                </div>

                <div class="exam-form-section">

                    <div class="exam-form-box">

                        <div class="exam-form-icon">
                            <i class="bx bx-link-external"></i>
                        </div>

                        <div class="exam-form-info">

                            <strong>
                                Google Form Exam
                            </strong>

                            <span>
                                Open the exam form and complete all required questions.
                            </span>

                        </div>

                        <a
                            href="{{ $exam->google_form_url }}"
                            target="_blank"
                            rel="noopener noreferrer"
                            class="exam-form-open">
                            <i class="bx bx-link-external"></i>
                            Open Exam
                        </a>

                    </div>

                </div>

            </section>

            @endif
            {{-- ============================================================
                ATTACHED FILES
            ============================================================ --}}

            @if($exam->attachment || $exam->resources->count())

            <section class="classwork-detail-card">

                <div class="classwork-detail-card-header">
                    <h2>
                        Attached Files
                    </h2>
                </div>

                {{-- LEGACY SINGLE ATTACHMENT --}}
                @if($exam->attachment)

                <div class="classwork-file">

                    <div class="classwork-file-icon">
                        <i class="bx bx-file"></i>
                    </div>

                    <div class="classwork-file-info">
                        <strong>
                            {{ basename($exam->attachment) }}
                        </strong>

                        <span>
                            Exam attachment
                        </span>
                    </div>

                    <button
                        type="button"
                        class="classwork-file-open exam-file-open"
                        data-file-url="{{ asset('storage/' . $exam->attachment) }}"
                        data-file-title="{{ basename($exam->attachment) }}">
                        <i class="bx bx-show"></i>
                        Open
                    </button>

                </div>

                @endif

                {{-- MULTIPLE RESOURCE FILES --}}
                @foreach($exam->resources as $resource)

                @if($resource->file_path)

                <div class="classwork-file">

                    <div class="classwork-file-icon">
                        <i class="bx bx-file"></i>
                    </div>

                    <div class="classwork-file-info">
                        <strong>
                            {{ $resource->file_name ?: $resource->title }}
                        </strong>

                        <span>
                            Exam attachment
                        </span>
                    </div>

                    <button
                        type="button"
                        class="classwork-file-open exam-file-open"
                        data-file-url="{{ asset('storage/' . $resource->file_path) }}"
                        data-file-title="{{ $resource->file_name ?: $resource->title }}">
                        <i class="bx bx-show"></i>
                        Open
                    </button>

                </div>

                @endif

                @endforeach

            </section>

            @endif



{{-- ====================================================
    STUDENT SUBMISSIONS
===================================================== --}}

<section class="classwork-detail-card">

    <div class="classwork-detail-card-header">
        <h2>
            Student Submissions
        </h2>
    </div>

    @php
        $submittedCount = $exam->submissions->count();
        $totalStudents = $classGroup->students->count();
    @endphp


    {{-- SUBMISSION SUMMARY --}}
    <div class="submission-summary">

        <div class="submission-summary-icon">
            <i class="bx bx-group"></i>
        </div>

        <div>
            <strong>
                {{ $submittedCount }} / {{ $totalStudents }}
            </strong>

            <span>
                Students submitted
            </span>
        </div>

    </div>


    {{-- SUBMITTED STUDENTS --}}
    @if($exam->submissions->isNotEmpty())

        <div class="submission-list">

            @foreach($exam->submissions as $submission)

                <div class="submission-item">

                    {{-- STUDENT ICON --}}
                    <div class="submission-student-icon">
                        <i class="bx bx-user"></i>
                    </div>


                    {{-- STUDENT INFORMATION --}}
                    <div class="submission-student-info">

                        <strong>
                            {{ $submission->student->name ?? 'Unknown Student' }}
                        </strong>

                        <span>
                            Submitted
                            {{ $submission->submitted_at
                                ? $submission->submitted_at->format('M d, Y \a\t h:i A')
                                : 'Not submitted'
                            }}
                        </span>

                    </div>


                    {{-- GRADE STATUS --}}
                    @if($submission->score !== null)

                        <span class="submission-grade-status graded">

                            <i class="bx bx-check-circle"></i>

                            Graded

                            <span class="submission-grade-score">
                                {{ rtrim(rtrim(number_format($submission->score, 2), '0'), '.') }}
                                /
                                {{ rtrim(rtrim(number_format($exam->points, 2), '0'), '.') }}
                            </span>

                        </span>

                    @else

                        <span class="submission-grade-status ungraded">

                            <i class="bx bx-time-five"></i>

                            Ungraded

                        </span>

                    @endif


                    {{-- VIEW SUBMISSION --}}
                    <a
                        href="{{ route(
                            'professor.class-groups.exams.submissions.show',
                            [
                                'classGroup' => $classGroup->id,
                                'exam' => $exam->id,
                                'submission' => $submission->id,
                            ]
                        ) }}"
                        class="submission-view-btn"
                    >

                        <i class="bx bx-show"></i>

                        View Submission

                    </a>

                </div>

            @endforeach

        </div>

    @else

        <div class="submission-placeholder">

            <i class="bx bx-time-five"></i>

            <p>
                No students have submitted this exam yet.
            </p>

        </div>

    @endif

</section>

        </div>




        {{-- SIDEBAR --}}

        <aside class="classwork-show-sidebar">

            <section class="classwork-detail-card">

                <div class="classwork-detail-card-header">

                    <h2>
                        Exam Details
                    </h2>

                </div>

                <div class="classwork-info-list">

                    <div class="classwork-info-item">

                        <i class="bx bx-star"></i>

                        <div>

                            <span>Points</span>

                            <strong>
                                {{ rtrim(rtrim(number_format($exam->points ?? 0, 2), '0'), '.') }}
                            </strong>

                        </div>

                    </div>


                    @if($exam->due_date)

                    <div class="classwork-info-item">

                        <i class="bx bx-calendar"></i>

                        <div>

                            <span>Due Date</span>

                            <strong>
                                {{ \Carbon\Carbon::parse($exam->due_date)->format('M d, Y') }}
                            </strong>

                        </div>

                    </div>

                    @endif


                    @if($exam->due_time)

                    <div class="classwork-info-item">

                        <i class="bx bx-time"></i>

                        <div>

                            <span>Due Time</span>

                            <strong>
                                {{ \Carbon\Carbon::parse($exam->due_time)->format('h:i A') }}
                            </strong>

                        </div>

                    </div>

                    @endif

                </div>

            </section>


            {{-- ACTIONS --}}

            <section class="classwork-detail-card">

                <div class="classwork-detail-card-header">

                    <h2>
                        Actions
                    </h2>

                </div>

                <a
                    href="{{ route(
                        'professor.class-groups.exams.edit',
                        [
                            'classGroup' => $classGroup->id,
                            'exam' => $exam->id,
                            'return_to' => 'show',
                            'origin' => $returnTo
                        ]
                    ) }}">
                    Edit Exam
                </a>

            </section>

        </aside>

    </div>

    {{-- ============================================================
    EXAM FILE PREVIEW MODAL
============================================================ --}}

    <div
        id="examPreviewModal"
        class="file-preview-modal"
        aria-hidden="true">

        <div class="file-preview-container">

            {{-- MODAL HEADER --}}
            <div class="file-preview-header">

                <div class="file-preview-title">

                    <i class="bx bx-file"></i>

                    <span id="examPreviewTitle">
                        Exam Attachment
                    </span>

                </div>


                <div class="file-preview-actions">

                    {{-- FULL SCREEN --}}
                    <button
                        type="button"
                        id="examFullscreenBtn"
                        class="file-preview-action"
                        title="Full Screen">

                        <i class="bx bx-fullscreen"></i>

                    </button>


                    {{-- CLOSE --}}
                    <button
                        type="button"
                        id="closeExamPreview"
                        class="file-preview-action"
                        title="Close">

                        <i class="bx bx-x"></i>

                    </button>

                </div>

            </div>


            {{-- FILE PREVIEW --}}
            <div class="file-preview-body">

                <iframe
                    id="examPreviewFrame"
                    src=""
                    frameborder="0"></iframe>

            </div>

        </div>

    </div>

</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {

        const modal = document.getElementById('examPreviewModal');
        const fileButtons = document.querySelectorAll('.exam-file-open');
        const closeBtn = document.getElementById('closeExamPreview');
        const fullscreenBtn = document.getElementById('examFullscreenBtn');
        const preview = document.getElementById('examPreviewFrame');
        const previewTitle = document.getElementById('examPreviewTitle');
        const container = document.querySelector(
            '#examPreviewModal .file-preview-container'
        );


        /*
        |--------------------------------------------------------------------------
        | OPEN EXAM FILE
        |--------------------------------------------------------------------------
        */

        fileButtons.forEach(function(button) {

            button.addEventListener('click', function() {

                const fileUrl = this.dataset.fileUrl;
                const fileTitle = this.dataset.fileTitle;

                if (!fileUrl) {
                    return;
                }

                preview.src = fileUrl;

                if (previewTitle && fileTitle) {
                    previewTitle.textContent = fileTitle;
                }

                modal.classList.add('active');
                modal.setAttribute('aria-hidden', 'false');
                document.body.classList.add('modal-open');

            });

        });


        /*
        |--------------------------------------------------------------------------
        | CLOSE MODAL
        |--------------------------------------------------------------------------
        */

        async function closeExamPreview() {

            if (document.fullscreenElement) {

                try {
                    await document.exitFullscreen();
                } catch (error) {
                    console.error('Could not exit fullscreen:', error);
                }

            }

            modal.classList.remove('active');
            modal.setAttribute('aria-hidden', 'true');
            preview.src = '';
            document.body.classList.remove('modal-open');

            if (previewTitle) {
                previewTitle.textContent = 'Exam Attachment';
            }

        }


        /*
        |--------------------------------------------------------------------------
        | CLOSE BUTTON
        |--------------------------------------------------------------------------
        */

        if (closeBtn) {

            closeBtn.addEventListener('click', function() {
                closeExamPreview();
            });

        }


        /*
        |--------------------------------------------------------------------------
        | CLICK OUTSIDE MODAL
        |--------------------------------------------------------------------------
        */

        if (modal) {

            modal.addEventListener('click', function(event) {

                if (event.target === modal) {
                    closeExamPreview();
                }

            });

        }


        /*
        |--------------------------------------------------------------------------
        | FULL SCREEN
        |--------------------------------------------------------------------------
        */

        if (fullscreenBtn && container) {

            fullscreenBtn.addEventListener('click', async function() {

                try {

                    if (!document.fullscreenElement) {
                        await container.requestFullscreen();
                    } else {
                        await document.exitFullscreen();
                    }

                } catch (error) {
                    console.error('Fullscreen error:', error);
                }

            });

        }


        /*
        |--------------------------------------------------------------------------
        | HANDLE FULLSCREEN EXIT
        |--------------------------------------------------------------------------
        |
        | ESC exits fullscreen first. The modal remains open.
        |
        */

        document.addEventListener('fullscreenchange', function() {

            if (!document.fullscreenElement) {

                if (modal && modal.classList.contains('active')) {
                    // Keep the modal open.
                }

            }

        });

    });
</script>

@endsection