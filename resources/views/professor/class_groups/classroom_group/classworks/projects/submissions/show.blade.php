@extends('layouts.prof_layout')

@section('content')
<style>
    .project-submission-page {
        --yellow: #eab308;
        --yellow-dark: #a16207;
        --yellow-soft: #fefce8;
        --yellow-border: #fde68a;
        --blue: #2563eb;
        --blue-soft: #eff6ff;
        --blue-border: #bfdbfe;
        --green: #16a34a;
        --green-soft: #f0fdf4;
        --green-border: #bbf7d0;
        --red: #dc2626;
        --text: #0f172a;
        --text2: #334155;
        --muted: #64748b;
        --light: #94a3b8;
        --border: #e2e8f0;
        --border-light: #edf2f7;
        --surface: #fff;
        --soft: #f8fafc;
        width: 100%;
        max-width: 1240px;
        margin: 0 auto;
        padding: 18px 24px 40px;
        color: var(--text)
    }

    .project-submission-page * {
        box-sizing: border-box
    }

    .ps-header {
        margin-bottom: 18px
    }

    .ps-back {
        display: inline-flex;
        align-items: center;
        gap: 7px;
        margin-bottom: 15px;
        color: var(--muted);
        text-decoration: none;
        font-size: 13px;
        font-weight: 700;
        transition: .18s
    }

    .ps-back:hover {
        color: var(--yellow-dark);
        transform: translateX(-2px)
    }

    .ps-title-row {
        display: flex;
        align-items: center;
        gap: 13px
    }

    .ps-title-icon {
        width: 52px;
        height: 52px;
        flex: 0 0 52px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border: 1px solid var(--yellow-border);
        border-radius: 14px;
        background: var(--yellow-soft);
        color: var(--yellow-dark);
        font-size: 24px
    }

    .ps-type {
        display: block;
        margin-bottom: 3px;
        color: var(--yellow-dark);
        font-size: 10px;
        font-weight: 800;
        letter-spacing: .13em;
        text-transform: uppercase
    }

    .ps-title-row h1 {
        margin: 0;
        font-size: 27px;
        line-height: 1.12;
        font-weight: 800;
        letter-spacing: -.025em;
        overflow-wrap: anywhere
    }

    .ps-subtitle {
        margin-top: 5px;
        color: var(--muted);
        font-size: 11px
    }

    .ps-alert {
        display: flex;
        align-items: center;
        gap: 7px;
        margin-bottom: 14px;
        padding: 11px 14px;
        border: 1px solid var(--green-border);
        border-radius: 10px;
        background: var(--green-soft);
        color: var(--green);
        font-size: 11px;
        font-weight: 700
    }

    .ps-grid {
        display: grid;
        grid-template-columns: minmax(0, 1fr) 300px;
        gap: 18px;
        align-items: start
    }

    .ps-main,
    .ps-sidebar {
        display: flex;
        flex-direction: column;
        gap: 14px;
        min-width: 0
    }

    .ps-sidebar {
        position: sticky;
        top: 14px
    }

    .ps-card {
        overflow: hidden;
        border: 1px solid var(--border);
        border-radius: 17px;
        background: var(--surface);
        box-shadow: 0 5px 20px rgba(15, 23, 42, .045)
    }

    .ps-card-header {
        min-height: 53px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 10px;
        padding: 13px 20px;
        border-bottom: 1px solid var(--border-light)
    }

    .ps-card-header h2 {
        margin: 0;
        font-size: 14px;
        font-weight: 800
    }

    .ps-card-header h2:before {
        content: "";
        display: inline-block;
        width: 4px;
        height: 15px;
        margin-right: 8px;
        vertical-align: -3px;
        border-radius: 999px;
        background: var(--yellow)
    }

    .ps-card-body {
        padding: 18px 20px
    }

    .ps-status {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        padding: 6px 9px;
        border-radius: 8px;
        font-size: 10px;
        font-weight: 800
    }

    .ps-status.submitted {
        color: var(--green);
        background: var(--green-soft)
    }

    .ps-status.draft {
        color: var(--muted);
        background: var(--soft)
    }

    .ps-status.graded {
        color: var(--blue);
        background: var(--blue-soft)
    }

    .ps-submitter {
        display: flex;
        align-items: center;
        gap: 12px
    }

    .ps-avatar {
        width: 42px;
        height: 42px;
        flex: 0 0 42px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border: 1px solid var(--yellow-border);
        border-radius: 11px;
        background: var(--yellow-soft);
        color: var(--yellow-dark);
        font-size: 19px
    }

    .ps-submitter-info {
        min-width: 0;
        flex: 1
    }

    .ps-submitter-info strong {
        display: block;
        color: var(--text);
        font-size: 13px;
        font-weight: 800
    }

    .ps-submitter-info span {
        display: block;
        margin-top: 2px;
        color: var(--muted);
        font-size: 10px
    }

    .ps-info-list {
        display: flex;
        flex-direction: column
    }

    .ps-info-item {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 12px 16px;
        border-bottom: 1px solid var(--border-light)
    }

    .ps-info-item:last-child {
        border-bottom: 0
    }

    .ps-info-icon {
        width: 33px;
        height: 33px;
        flex: 0 0 33px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 8px;
        background: var(--yellow-soft);
        color: var(--yellow-dark);
        font-size: 16px
    }

    .ps-info-item div {
        min-width: 0
    }

    .ps-info-item span {
        display: block;
        color: var(--muted);
        font-size: 9px
    }

    .ps-info-item strong {
        display: block;
        margin-top: 1px;
        color: var(--text2);
        font-size: 12px;
        font-weight: 800;
        overflow-wrap: anywhere
    }

    .ps-files {
        display: flex;
        flex-direction: column;
        gap: 8px
    }

    .ps-file {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 10px;
        border: 1px solid var(--border);
        border-radius: 11px;
        background: var(--soft)
    }

    .ps-file-icon {
        width: 38px;
        height: 38px;
        flex: 0 0 38px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border: 1px solid var(--yellow-border);
        border-radius: 9px;
        background: var(--yellow-soft);
        color: var(--yellow-dark);
        font-size: 17px
    }

    .ps-file-info {
        min-width: 0;
        flex: 1
    }

    .ps-file-info strong {
        display: block;
        overflow: hidden;
        color: var(--text2);
        font-size: 11px;
        font-weight: 750;
        text-overflow: ellipsis;
        white-space: nowrap
    }

    .ps-file-info span {
        display: block;
        margin-top: 2px;
        color: var(--light);
        font-size: 9px
    }

    .ps-file-actions {
        display: flex;
        gap: 5px
    }

    .ps-file-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 4px;
        min-height: 32px;
        padding: 0 9px;
        border: 1px solid var(--blue-border);
        border-radius: 8px;
        background: #fff;
        color: var(--blue);
        text-decoration: none;
        font-size: 9px;
        font-weight: 800;
        white-space: nowrap;
        cursor: pointer
    }

    .ps-file-btn:hover {
        background: var(--blue-soft)
    }

    .ps-empty {
        min-height: 100px;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        padding: 20px;
        border: 1px dashed var(--border);
        border-radius: 11px;
        background: var(--soft);
        text-align: center
    }

    .ps-empty i {
        margin-bottom: 6px;
        color: var(--light);
        font-size: 24px
    }

    .ps-empty p {
        margin: 0;
        color: var(--muted);
        font-size: 11px
    }

    .ps-team-grid {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 10px
    }

    .ps-member {
        display: flex;
        align-items: center;
        gap: 10px;
        min-width: 0;
        padding: 11px;
        border: 1px solid var(--border);
        border-radius: 11px;
        background: var(--soft)
    }

    .ps-member-avatar {
        width: 36px;
        height: 36px;
        flex: 0 0 36px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 9px;
        background: #fff;
        color: var(--muted);
        font-size: 16px
    }

    .ps-member-info {
        min-width: 0;
        flex: 1
    }

    .ps-member-info strong {
        display: block;
        overflow: hidden;
        color: var(--text2);
        font-size: 11px;
        font-weight: 800;
        text-overflow: ellipsis;
        white-space: nowrap
    }

    .ps-member-info span {
        display: block;
        margin-top: 2px;
        color: var(--muted);
        font-size: 9px
    }

    .ps-role {
        display: inline-flex;
        padding: 4px 6px;
        border-radius: 6px;
        background: var(--yellow-soft);
        color: var(--yellow-dark);
        font-size: 8px;
        font-weight: 800;
        text-transform: uppercase;
        white-space: nowrap
    }

    .ps-grade-box {
        padding: 15px;
        border: 1px solid var(--yellow-border);
        border-radius: 12px;
        background: var(--yellow-soft)
    }

    .ps-grade-current {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 12px;
        margin-bottom: 14px
    }

    .ps-grade-current span {
        color: var(--muted);
        font-size: 10px
    }

    .ps-grade-current strong {
        color: var(--yellow-dark);
        font-size: 22px;
        font-weight: 850
    }

    .ps-form-group {
        margin-bottom: 12px
    }

    .ps-form-label {
        display: block;
        margin-bottom: 6px;
        color: var(--text2);
        font-size: 10px;
        font-weight: 800
    }

    .ps-input,
    .ps-textarea {
        width: 100%;
        border: 1px solid var(--border);
        border-radius: 9px;
        background: #fff;
        color: var(--text);
        font-family: inherit;
        font-size: 12px;
        outline: none
    }

    .ps-input {
        height: 40px;
        padding: 0 11px
    }

    .ps-textarea {
        min-height: 85px;
        padding: 10px 11px;
        resize: vertical
    }

    .ps-input:focus,
    .ps-textarea:focus {
        border-color: var(--yellow);
        box-shadow: 0 0 0 3px rgba(234, 179, 8, .12)
    }

    .ps-error {
        margin-top: 5px;
        color: var(--red);
        font-size: 9px
    }

    .ps-btn {
        width: 100%;
        min-height: 40px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 7px;
        border: 1px solid transparent;
        border-radius: 9px;
        cursor: pointer;
        font-family: inherit;
        font-size: 11px;
        font-weight: 800;
        transition: .18s
    }

    .ps-btn-yellow {
        background: var(--yellow);
        border-color: var(--yellow);
        color: #fff
    }

    .ps-btn-yellow:hover {
        background: var(--yellow-dark);
        border-color: var(--yellow-dark)
    }

    .ps-btn-blue {
        background: var(--blue);
        border-color: var(--blue);
        color: #fff
    }

    .ps-btn-blue:hover {
        background: #1d4ed8
    }

    .ps-grade-member {
        display: grid;
        grid-template-columns: minmax(0, 1fr) 110px;
        gap: 9px;
        align-items: end;
        margin-bottom: 10px;
        padding: 10px;
        border: 1px solid var(--border);
        border-radius: 10px;
        background: var(--soft)
    }

    .ps-grade-member-name {
        min-width: 0
    }

    .ps-grade-member-name strong {
        display: block;
        overflow: hidden;
        color: var(--text2);
        font-size: 11px;
        font-weight: 800;
        text-overflow: ellipsis;
        white-space: nowrap
    }

    .ps-grade-member-name span {
        display: block;
        margin-top: 2px;
        color: var(--muted);
        font-size: 9px
    }

    .ps-grade-member .ps-form-group {
        margin: 0
    }

    .ps-modal {
        position: fixed;
        inset: 0;
        z-index: 9999;
        display: none;
        align-items: center;
        justify-content: center;
        padding: 20px;
        background: rgba(2, 6, 23, .76)
    }

    .ps-modal.active {
        display: flex
    }

    .ps-modal-container {
        width: min(1200px, 100%);
        height: min(850px, 90vh);
        display: flex;
        flex-direction: column;
        overflow: hidden;
        border-radius: 14px;
        background: #fff;
        box-shadow: 0 24px 70px rgba(0, 0, 0, .35)
    }

    .ps-modal-header {
        min-height: 54px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 0 14px;
        border-bottom: 1px solid var(--border)
    }

    .ps-modal-title {
        display: flex;
        align-items: center;
        gap: 8px;
        min-width: 0;
        color: var(--text2);
        font-size: 12px;
        font-weight: 800
    }

    .ps-modal-title i {
        color: var(--yellow-dark);
        font-size: 18px
    }

    .ps-modal-close {
        width: 34px;
        height: 34px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border: 1px solid var(--border);
        border-radius: 8px;
        background: transparent;
        color: var(--muted);
        cursor: pointer;
        font-size: 18px
    }

    .ps-modal-body {
        flex: 1;
        min-height: 0;
        background: #171717
    }

    .ps-modal-body iframe {
        width: 100%;
        height: 100%;
        border: 0;
        background: #fff
    }

    .dark-mode .project-submission-page {
        --yellow: #facc15;
        --yellow-dark: #fde047;
        --yellow-soft: rgba(250, 204, 21, .10);
        --yellow-border: rgba(250, 204, 21, .30);
        --blue: #7c83ff;
        --blue-soft: rgba(124, 131, 255, .12);
        --blue-border: rgba(124, 131, 255, .30);
        --green: #49d5a7;
        --green-soft: rgba(73, 213, 167, .10);
        --green-border: rgba(73, 213, 167, .30);
        --text: #f4f5ff;
        --text2: #e6e8f7;
        --muted: #a1a4cc;
        --light: #9295bd;
        --border: #2b2e52;
        --border-light: #252847;
        --surface: #171933;
        --soft: #12142a;
        color: var(--text);
        color-scheme: dark
    }

    .dark-mode .project-submission-page .ps-input,
    .dark-mode .project-submission-page .ps-textarea {
        background: var(--surface);
        color: var(--text);
        border-color: var(--border)
    }

    .dark-mode .project-submission-page .ps-member-avatar,
    .dark-mode .project-submission-page .ps-file-btn {
        background: var(--surface)
    }

    .dark-mode .project-submission-page .ps-modal-container {
        background: var(--surface)
    }

    /* ============================================================
   TEAM GRADING MODE SWITCHER
   ============================================================ */

    .ps-grade-mode {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 10px;
        margin-bottom: 14px;
    }

    .ps-grade-mode-option {
        position: relative;
    }

    .ps-grade-mode-option input {
        position: absolute;
        opacity: 0;
        pointer-events: none;
    }

    .ps-grade-mode-label {
        display: flex;
        align-items: flex-start;
        gap: 10px;
        min-height: 82px;
        padding: 12px;
        border: 1px solid var(--border);
        border-radius: 11px;
        background: var(--surface);
        cursor: pointer;
        transition: .18s ease;
    }

    .ps-grade-mode-label:hover {
        border-color: var(--yellow-border);
    }

    .ps-grade-mode-option input:checked+.ps-grade-mode-label {
        border-color: var(--yellow);
        background: var(--yellow-soft);
        box-shadow: 0 0 0 2px rgba(234, 179, 8, .10);
    }

    .ps-grade-mode-icon {
        width: 34px;
        height: 34px;
        flex: 0 0 34px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 9px;
        background: var(--soft);
        color: var(--muted);
        font-size: 17px;
    }

    .ps-grade-mode-option input:checked+.ps-grade-mode-label .ps-grade-mode-icon {
        background: var(--yellow);
        color: #fff;
    }

    .ps-grade-mode-copy {
        min-width: 0;
    }

    .ps-grade-mode-copy strong {
        display: block;
        color: var(--text2);
        font-size: 11px;
        font-weight: 800;
    }

    .ps-grade-mode-copy span {
        display: block;
        margin-top: 3px;
        color: var(--muted);
        font-size: 9px;
        line-height: 1.45;
    }

    .ps-grade-panel {
        display: none;
    }

    .ps-grade-panel.is-active {
        display: block;
    }

    .ps-grade-panel-heading {
        margin-bottom: 10px;
    }

    .ps-grade-panel-heading strong {
        display: block;
        color: var(--text2);
        font-size: 11px;
        font-weight: 800;
    }

    .ps-grade-panel-heading span {
        display: block;
        margin-top: 3px;
        color: var(--muted);
        font-size: 9px;
    }


    /* ============================================================
   DARK MODE
   ============================================================ */

    .dark-mode .project-submission-page .ps-grade-mode-label {
        background: var(--surface);
    }

    .dark-mode .project-submission-page .ps-grade-mode-option input:checked+.ps-grade-mode-label {
        background: var(--yellow-soft);
    }

    /* ============================================================
   GRADED VIEW
   ============================================================ */

    .ps-graded-view {
        display: flex;
        flex-direction: column;
        gap: 12px;
    }

    .ps-graded-score {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 15px;
        padding: 14px;
        border: 1px solid var(--yellow-border);
        border-radius: 11px;
        background: var(--yellow-soft);
    }

    .ps-graded-score-label {
        color: var(--muted);
        font-size: 10px;
        font-weight: 700;
    }

    .ps-graded-score-value {
        color: var(--yellow-dark);
        font-size: 24px;
        font-weight: 850;
    }

    .ps-graded-feedback {
        padding: 12px 14px;
        border: 1px solid var(--border);
        border-radius: 10px;
        background: var(--soft);
    }

    .ps-graded-feedback-label {
        display: block;
        margin-bottom: 5px;
        color: var(--muted);
        font-size: 9px;
        font-weight: 800;
    }

    .ps-graded-feedback-text {
        color: var(--text2);
        font-size: 11px;
        line-height: 1.5;
        white-space: pre-wrap;
    }

    .ps-edit-grade-btn {
        width: 100%;
        min-height: 40px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 7px;
        border: 1px solid var(--blue-border);
        border-radius: 9px;
        background: var(--blue-soft);
        color: var(--blue);
        cursor: pointer;
        font-family: inherit;
        font-size: 11px;
        font-weight: 800;
        transition: .18s;
    }

    .ps-edit-grade-btn:hover {
        background: var(--blue);
        color: #fff;
    }

    .ps-manual-graded-list {
        display: flex;
        flex-direction: column;
        gap: 8px;
    }

    .ps-manual-graded-item {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 10px;
        padding: 11px 12px;
        border: 1px solid var(--border);
        border-radius: 10px;
        background: var(--soft);
    }

    .ps-manual-graded-student {
        min-width: 0;
    }

    .ps-manual-graded-student strong {
        display: block;
        overflow: hidden;
        color: var(--text2);
        font-size: 11px;
        font-weight: 800;
        text-overflow: ellipsis;
        white-space: nowrap;
    }

    .ps-manual-graded-student span {
        display: block;
        margin-top: 2px;
        color: var(--muted);
        font-size: 9px;
    }

    .ps-manual-graded-score {
        flex: 0 0 auto;
        color: var(--yellow-dark);
        font-size: 15px;
        font-weight: 850;
    }

    .ps-grade-edit-panel {
        display: none;
    }

    .ps-grade-edit-panel.is-active {
        display: block;
    }

    /* ============================================================
   MOBILE
   ============================================================ */

    @media(max-width:650px) {

        .ps-grade-mode {
            grid-template-columns: 1fr;
        }
    }

    @media(max-width:900px) {
        .ps-grid {
            grid-template-columns: 1fr
        }

        .ps-sidebar {
            position: static
        }
    }

    @media(max-width:650px) {
        .project-submission-page {
            padding: 16px
        }

        .ps-title-row h1 {
            font-size: 23px
        }

        .ps-team-grid {
            grid-template-columns: 1fr
        }

        .ps-file {
            align-items: flex-start;
            flex-wrap: wrap
        }

        .ps-file-actions {
            width: 100%
        }

        .ps-file-btn {
            flex: 1
        }

        .ps-grade-member {
            grid-template-columns: 1fr
        }
    }
</style>

<div class="project-submission-page">
    @if(session('success'))
    <div class="ps-alert"><i class="bx bx-check-circle"></i>{{ session('success') }}</div>
    @endif

    <div class="ps-header">
                <a
                    href="{{ route('professor.classworks.projects.show', [
                        'classGroupId' => $classGroup->id,
                        'projectId' => $project->id,
                            'return_to' => $returnTo,
                    ]) }}"
                    class="ps-back"
                >
                    <i class="bx bx-arrow-back"></i>
                    Back to Project
                </a>        <div class="ps-title-row">
            <div class="ps-title-icon"><i class="bx {{ $project->project_type === 'team' ? 'bx-group' : 'bx-task' }}"></i></div>
            <div>
                <span class="ps-type">Project Submission</span>
                <h1>{{ $project->title }}</h1>
                <div class="ps-subtitle">{{ $project->project_type === 'team' ? 'Team project submission' : 'Individual project submission' }}</div>
            </div>
        </div>
    </div>

    <div class="ps-grid">
        <main class="ps-main">

            <section class="ps-card">
                <div class="ps-card-header">
                    <h2>Submission Information</h2>
                    @if($submission->score !== null || $submission->grades->whereNotNull('score')->isNotEmpty())
                    <span class="ps-status graded"><i class="bx bx-check-circle"></i>Graded</span>
                    @elseif($submission->submitted_at)
                    <span class="ps-status submitted"><i class="bx bx-check"></i>Submitted</span>
                    @else
                    <span class="ps-status draft"><i class="bx bx-time-five"></i>Draft</span>
                    @endif
                </div>
                <div class="ps-card-body">
                    <div class="ps-submitter">
                        <div class="ps-avatar"><i class="bx bx-user"></i></div>
                        <div class="ps-submitter-info">
                            <strong>{{ $submission->student->name ?? 'Unknown Student' }}</strong>
                            <span>Submitted {{ $submission->submitted_at ? $submission->submitted_at->format('M d, Y \a\t h:i A') : 'Not submitted yet' }}</span>
                        </div>
                    </div>
                </div>
            </section>

            @if($project->project_type === 'team' && $submission->projectGroup)
            @php
            $team = $submission->projectGroup;
            $leader = $team->members->firstWhere('role','leader');
            $backup = $team->members->firstWhere('role','backup');
            @endphp
            <section class="ps-card">
                <div class="ps-card-header">
                    <h2>{{ $team->group_name }}</h2><span class="ps-status submitted">Team {{ $team->group_number }}</span>
                </div>
                <div class="ps-card-body">
                    <div class="ps-team-grid">
                        @foreach($team->members as $member)
                        <div class="ps-member">
                            <div class="ps-member-avatar"><i class="bx bx-user"></i></div>
                            <div class="ps-member-info">
                                <strong>{{ $member->user->name ?? 'Unknown Student' }}</strong>
                                <span>{{ $member->role === 'leader' ? 'Team Leader' : ($member->role === 'backup' ? 'Backup Submitter' : 'Team Member') }}</span>
                            </div>
                            @if($member->role === 'leader')<span class="ps-role">Leader</span>@elseif($member->role === 'backup')<span class="ps-role">Backup</span>@endif
                        </div>
                        @endforeach
                    </div>
                </div>
            </section>
            @endif

            <section class="ps-card">
                <div class="ps-card-header">
                    <h2>Submitted Files</h2>
                </div>
                <div class="ps-card-body">
                    @if($submission->resources->isNotEmpty())
                    <div class="ps-files">
                        @foreach($submission->resources as $resource)
                        <div class="ps-file">
                            <div class="ps-file-icon"><i class="bx bx-file"></i></div>
                            <div class="ps-file-info">
                                <strong>{{ $resource->file_name ?? $resource->title }}</strong>
                                <span>{{ $resource->file_size ? number_format($resource->file_size / 1024,1).' KB' : 'Submitted file' }}</span>
                            </div>
                            <div class="ps-file-actions">
                                <button
                                    type="button"
                                    class="ps-file-btn"
                                    data-file-url="{{ route('professor.classworks.projects.submissions.resources.view', [
                                                'classGroupId' => $classGroup->id,
                                                'projectId' => $project->id,
                                                'submissionId' => $submission->id,
                                                'resourceId' => $resource->id,
                                            ]) }}"
                                    data-file-name="{{ $resource->file_name ?? $resource->title }}"
                                    onclick="openProjectSubmissionFile(this.dataset.fileUrl, this.dataset.fileName)">
                                    <i class="bx bx-show"></i>
                                    View
                                </button>
                                <a href="{{ route('professor.classworks.projects.submissions.resources.download',['classGroupId'=>$classGroup->id,'projectId'=>$project->id,'submissionId'=>$submission->id,'resourceId'=>$resource->id]) }}" class="ps-file-btn"><i class="bx bx-download"></i>Download</a>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    @else
                    <div class="ps-empty"><i class="bx bx-file"></i>
                        <p>No files were submitted.</p>
                    </div>
                    @endif
                </div>
            </section>

            @if($project->project_type === 'individual')
            <section class="ps-card">
                <div class="ps-card-header">
                    <h2>Grade Submission</h2>
                </div>
                <div class="ps-card-body">
                    <div class="ps-grade-box">
                        <div class="ps-grade-current">
                            <span>Current Grade</span>
                            <strong>{{ $submission->score !== null ? rtrim(rtrim(number_format($submission->score,2),'0'),'.') : '—' }} / {{ rtrim(rtrim(number_format($project->points,2),'0'),'.') }}</strong>
                        </div>
                        <form method="POST" action="{{ route('professor.classworks.projects.submissions.grade',['classGroupId'=>$classGroup->id,'projectId'=>$project->id,'submissionId'=>$submission->id]) }}">
                            @csrf @method('PUT')
                            <div class="ps-form-group"><label class="ps-form-label">Score</label><input type="number" name="score" class="ps-input" min="0" max="{{ $project->points }}" step="0.01" value="{{ old('score',$submission->score) }}" required>@error('score')<div class="ps-error">{{ $message }}</div>@enderror</div>
                            <div class="ps-form-group"><label class="ps-form-label">Feedback</label><textarea name="feedback" class="ps-textarea" placeholder="Write feedback for the student...">{{ old('feedback',$submission->feedback) }}</textarea>@error('feedback')<div class="ps-error">{{ $message }}</div>@enderror</div>
                            <button type="submit" class="ps-btn ps-btn-yellow"><i class="bx bx-check"></i>Save Grade</button>
                        </form>
                    </div>
                </div>
            </section>
            @endif

        </main>

        <aside class="ps-sidebar">
            <section class="ps-card">
                <div class="ps-card-header">
                    <h2>Project Details</h2>
                </div>
                <div class="ps-info-list">
                    <div class="ps-info-item">
                        <div class="ps-info-icon"><i class="bx bx-star"></i></div>
                        <div><span>Points</span><strong>{{ rtrim(rtrim(number_format($project->points,2),'0'),'.') }}</strong></div>
                    </div>
                    <div class="ps-info-item">
                        <div class="ps-info-icon"><i class="bx bx-category"></i></div>
                        <div><span>Project Type</span><strong>{{ $project->project_type === 'team' ? 'Team Project' : 'Individual Project' }}</strong></div>
                    </div>
                    @if($project->due_date)<div class="ps-info-item">
                        <div class="ps-info-icon"><i class="bx bx-calendar"></i></div>
                        <div><span>Due Date</span><strong>{{ $project->due_date->format('M d, Y') }}</strong></div>
                    </div>@endif
                    @if($project->due_time)<div class="ps-info-item">
                        <div class="ps-info-icon"><i class="bx bx-time"></i></div>
                        <div><span>Due Time</span><strong>{{ \Carbon\Carbon::parse($project->due_time)->format('h:i A') }}</strong></div>
                    </div>@endif
                    <div class="ps-info-item">
                        <div class="ps-info-icon"><i class="bx bx-check-circle"></i></div>
                        <div><span>Submission Status</span><strong>{{ $submission->submitted_at ? 'Submitted' : 'Draft' }}</strong></div>
                    </div>
                </div>
            </section>
            @if($project->project_type === 'team' && $submission->projectGroup)

            @php
            $memberGradeMap = $submission->grades->keyBy('student_id');

            $teamScores = $submission->grades
            ->whereNotNull('score')
            ->pluck('score')
            ->unique()
            ->values();

            $sameTeamScore = $teamScores->count() === 1
            ? $teamScores->first()
            : null;

            $teamFeedback = $submission->grades
            ->pluck('feedback')
            ->filter(fn($feedback) => filled($feedback))
            ->first();

            $manualGradesComplete = $team->members->count() > 0
            && $team->members->every(function ($member) use ($memberGradeMap) {
            return $memberGradeMap->get($member->user_id)?->score !== null;
            });

            $isTeamGraded = $sameTeamScore !== null;

            @endphp

            <section class="ps-card">

                <div class="ps-card-header">
                    <h2>Grade Team</h2>
                </div>

                <div class="ps-card-body">

                    {{-- ============================================================
             GRADING MODE
        ============================================================= --}}

                    <div class="ps-grade-mode">

                        <div class="ps-grade-mode-option">

                            <input
                                type="radio"
                                id="gradeModeTeam"
                                name="grade_mode"
                                value="team"
                                {{ $isTeamGraded ? 'checked' : (!$manualGradesComplete ? 'checked' : '') }}>

                            <label
                                for="gradeModeTeam"
                                class="ps-grade-mode-label">

                                <span class="ps-grade-mode-icon">
                                    <i class="bx bx-group"></i>
                                </span>

                                <span class="ps-grade-mode-copy">
                                    <strong>Grade by Team</strong>
                                    <span>
                                        Give every member the same score.
                                    </span>
                                </span>

                            </label>

                        </div>


                        <div class="ps-grade-mode-option">

                            <input
                                type="radio"
                                id="gradeModeManual"
                                name="grade_mode"
                                value="manual"
                                {{ !$isTeamGraded && $manualGradesComplete ? 'checked' : '' }}>

                            <label
                                for="gradeModeManual"
                                class="ps-grade-mode-label">

                                <span class="ps-grade-mode-icon">
                                    <i class="bx bx-edit"></i>
                                </span>

                                <span class="ps-grade-mode-copy">
                                    <strong>Grade Manually</strong>
                                    <span>
                                        Give each student a different score.
                                    </span>
                                </span>

                            </label>

                        </div>

                    </div>


                    {{-- ============================================================
             GRADE BY TEAM
        ============================================================= --}}

                    <div
                        id="gradeByTeamPanel"
                        class="ps-grade-panel {{ $isTeamGraded ? 'is-active' : (!$manualGradesComplete ? 'is-active' : '') }}">

                        {{-- ==================== GRADED VIEW ==================== --}}

                        <div
                            id="teamGradedView"
                            class="ps-grade-edit-panel {{ $isTeamGraded ? 'is-active' : '' }}">

                            <div class="ps-graded-view">

                                <div class="ps-graded-score">

                                    <div>
                                        <span class="ps-graded-score-label">
                                            Team Grade
                                        </span>
                                    </div>

                                    <div class="ps-graded-score-value">

                                        {{
                                rtrim(
                                    rtrim(
                                        number_format($sameTeamScore ?? 0, 2),
                                        '0'
                                    ),
                                    '.'
                                )
                            }}

                                        /

                                        {{
                                rtrim(
                                    rtrim(
                                        number_format($project->points, 2),
                                        '0'
                                    ),
                                    '.'
                                )
                            }}

                                    </div>

                                </div>


                                <div class="ps-graded-feedback">

                                    <span class="ps-graded-feedback-label">
                                        Feedback
                                    </span>

                                    <div class="ps-graded-feedback-text">
                                        {{ $teamFeedback ?: 'No feedback provided.' }}
                                    </div>

                                </div>


                                <button
                                    type="button"
                                    class="ps-edit-grade-btn"
                                    id="editTeamGradeButton">
                                    <i class="bx bx-edit"></i>
                                    Edit Score & Feedback
                                </button>

                            </div>

                        </div>


                        {{-- ==================== EDIT FORM ==================== --}}

                        <div
                            id="teamGradeEditPanel"
                            class="ps-grade-edit-panel {{ $isTeamGraded ? '' : 'is-active' }}">

                            <div class="ps-grade-box">

                                <div class="ps-grade-current">

                                    <span>
                                        Same score for every team member
                                    </span>

                                    <strong>
                                        {{
                                $sameTeamScore !== null
                                    ? rtrim(
                                        rtrim(
                                            number_format(
                                                $sameTeamScore,
                                                2
                                            ),
                                            '0'
                                        ),
                                        '.'
                                    )
                                    : '—'
                            }}

                                        /

                                        {{
                                rtrim(
                                    rtrim(
                                        number_format(
                                            $project->points,
                                            2
                                        ),
                                        '0'
                                    ),
                                    '.'
                                )
                            }}
                                    </strong>

                                </div>


                                <form
                                    method="POST"
                                    action="{{ route(
                            'professor.classworks.projects.submissions.grade-team',
                            [
                                'classGroupId' => $classGroup->id,
                                'projectId' => $project->id,
                                'submissionId' => $submission->id
                            ]
                        ) }}">

                                    @csrf
                                    @method('PUT')


                                    <div class="ps-form-group">

                                        <label class="ps-form-label">
                                            Team Score
                                        </label>

                                        <input
                                            type="number"
                                            name="score"
                                            class="ps-input"
                                            min="0"
                                            max="{{ $project->points }}"
                                            step="0.01"
                                            value="{{ old('score', $sameTeamScore) }}"
                                            required>

                                        @error('score')
                                        <div class="ps-error">
                                            {{ $message }}
                                        </div>
                                        @enderror

                                    </div>


                                    <div class="ps-form-group">

                                        <label class="ps-form-label">
                                            Feedback
                                        </label>

                                        <textarea
                                            name="feedback"
                                            class="ps-textarea"
                                            placeholder="Feedback for the whole team...">{{ old('feedback', $teamFeedback) }}</textarea>

                                    </div>


                                    <button
                                        type="submit"
                                        class="ps-btn ps-btn-yellow">
                                        <i class="bx bx-check"></i>
                                        Save Grade
                                    </button>

                                </form>

                            </div>

                        </div>

                    </div>


                    {{-- ============================================================
             MANUAL GRADING
        ============================================================= --}}

                    <div
                        id="gradeManuallyPanel"
                        class="ps-grade-panel {{ !$isTeamGraded && $manualGradesComplete ? 'is-active' : '' }}">

                        {{-- ==================== GRADED VIEW ==================== --}}

                        <div
                            id="manualGradedView"
                            class="ps-grade-edit-panel {{ $manualGradesComplete ? 'is-active' : '' }}">

                            <div class="ps-manual-graded-list">

                                @foreach($team->members as $member)

                                @php
                                $existingGrade =
                                $memberGradeMap->get(
                                $member->user_id
                                );
                                @endphp

                                <div class="ps-manual-graded-item">

                                    <div class="ps-manual-graded-student">

                                        <strong>
                                            {{ $member->user->name ?? 'Unknown Student' }}
                                        </strong>

                                        <span>
                                            {{
                                        $member->role === 'leader'
                                            ? 'Team Leader'
                                            : (
                                                $member->role === 'backup'
                                                    ? 'Backup Submitter'
                                                    : 'Team Member'
                                            )
                                    }}
                                        </span>

                                    </div>

                                    <div class="ps-manual-graded-score">

                                        {{
                                    $existingGrade?->score !== null
                                        ? rtrim(
                                            rtrim(
                                                number_format(
                                                    $existingGrade->score,
                                                    2
                                                ),
                                                '0'
                                            ),
                                            '.'
                                        )
                                        : '—'
                                }}

                                        /

                                        {{
                                    rtrim(
                                        rtrim(
                                            number_format(
                                                $project->points,
                                                2
                                            ),
                                            '0'
                                        ),
                                        '.'
                                    )
                                }}

                                    </div>

                                </div>

                                @endforeach

                            </div>


                            <div style="margin-top:12px;">

                                <button
                                    type="button"
                                    class="ps-edit-grade-btn"
                                    id="editManualGradeButton">
                                    <i class="bx bx-edit"></i>
                                    Edit Grades & Feedback
                                </button>

                            </div>

                        </div>


                        {{-- ==================== EDIT FORM ==================== --}}

                        <div
                            id="manualGradeEditPanel"
                            class="ps-grade-edit-panel {{ !$manualGradesComplete ? 'is-active' : '' }}">

                            <div class="ps-grade-panel-heading">

                                <strong>
                                    Grade Each Student
                                </strong>

                                <span>
                                    Each team member can receive a different score.
                                </span>

                            </div>


                            <form
                                method="POST"
                                action="{{ route(
                        'professor.classworks.projects.submissions.grade-members',
                        [
                            'classGroupId' => $classGroup->id,
                            'projectId' => $project->id,
                            'submissionId' => $submission->id
                        ]
                    ) }}">

                                @csrf
                                @method('PUT')


                                @foreach($team->members as $member)

                                @php
                                $existingGrade =
                                $memberGradeMap->get(
                                $member->user_id
                                );
                                @endphp


                                <div class="ps-grade-member">

                                    <div class="ps-grade-member-name">

                                        <strong>
                                            {{ $member->user->name ?? 'Unknown Student' }}
                                        </strong>

                                        <span>
                                            {{
                                        $member->role === 'leader'
                                            ? 'Team Leader'
                                            : (
                                                $member->role === 'backup'
                                                    ? 'Backup Submitter'
                                                    : 'Team Member'
                                            )
                                    }}
                                        </span>

                                    </div>


                                    <div class="ps-form-group">

                                        <label class="ps-form-label">
                                            Score
                                        </label>

                                        <input
                                            type="number"
                                            name="grades[{{ $member->user_id }}][score]"
                                            class="ps-input"
                                            min="0"
                                            max="{{ $project->points }}"
                                            step="0.01"
                                            value="{{ old(
                                        'grades.' . $member->user_id . '.score',
                                        $existingGrade?->score
                                    ) }}"
                                            required>

                                    </div>

                                </div>


                                <div class="ps-form-group">

                                    <label class="ps-form-label">
                                        Feedback for
                                        {{ $member->user->name ?? 'student' }}
                                    </label>

                                    <textarea
                                        name="grades[{{ $member->user_id }}][feedback]"
                                        class="ps-textarea"
                                        placeholder="Optional feedback...">{{ old(
                                'grades.' . $member->user_id . '.feedback',
                                $existingGrade?->feedback
                            ) }}</textarea>

                                </div>

                                @endforeach


                                <button
                                    type="submit"
                                    class="ps-btn ps-btn-blue">
                                    <i class="bx bx-check"></i>
                                    Save Member Grades
                                </button>

                            </form>

                        </div>

                    </div>

                </div>

            </section>

            @endif
        </aside>
    </div>
</div>

<div id="projectSubmissionViewer" class="ps-modal">
    <div class="ps-modal-container">
        <div class="ps-modal-header">
            <div class="ps-modal-title"><i class="bx bx-file"></i><span id="projectSubmissionViewerTitle">Submitted File</span></div><button type="button" class="ps-modal-close" onclick="closeProjectSubmissionFile()"><i class="bx bx-x"></i></button>
        </div>
        <div class="ps-modal-body"><iframe id="projectSubmissionViewerFrame" src="" frameborder="0"></iframe></div>
    </div>
</div>

<script>
    function openProjectSubmissionFile(fileUrl, fileName) {
        const modal = document.getElementById('projectSubmissionViewer'),
            iframe = document.getElementById('projectSubmissionViewerFrame'),
            title = document.getElementById('projectSubmissionViewerTitle');
        if (!modal || !iframe) return;
        iframe.src = fileUrl;
        if (title) title.textContent = fileName || 'Submitted File';
        modal.classList.add('active');
        document.body.style.overflow = 'hidden';
    }

    function closeProjectSubmissionFile() {
        const modal = document.getElementById('projectSubmissionViewer'),
            iframe = document.getElementById('projectSubmissionViewerFrame');
        if (!modal || !iframe) return;
        iframe.src = '';
        modal.classList.remove('active');
        document.body.style.overflow = '';
    }
    document.addEventListener('keydown', e => {
        if (e.key === 'Escape') closeProjectSubmissionFile();
    });
    document.getElementById('projectSubmissionViewer')?.addEventListener('click', function(e) {
        if (e.target === this) closeProjectSubmissionFile();
    });

    /* ============================================================
   TEAM GRADING MODE
   ============================================================ */

    const gradeModeTeam =
        document.getElementById('gradeModeTeam');

    const gradeModeManual =
        document.getElementById('gradeModeManual');

    const gradeByTeamPanel =
        document.getElementById('gradeByTeamPanel');

    const gradeManuallyPanel =
        document.getElementById('gradeManuallyPanel');


    function updateGradeMode() {

        const selectedMode =
            document.querySelector(
                'input[name="grade_mode"]:checked'
            )?.value;


        if (!gradeByTeamPanel ||
            !gradeManuallyPanel) {
            return;
        }


        if (selectedMode === 'manual') {

            gradeByTeamPanel.classList.remove(
                'is-active'
            );

            gradeManuallyPanel.classList.add(
                'is-active'
            );

        } else {

            gradeManuallyPanel.classList.remove(
                'is-active'
            );

            gradeByTeamPanel.classList.add(
                'is-active'
            );
        }
    }


    if (gradeModeTeam) {

        gradeModeTeam.addEventListener(
            'change',
            updateGradeMode
        );
    }


    if (gradeModeManual) {

        gradeModeManual.addEventListener(
            'change',
            updateGradeMode
        );
    }


    updateGradeMode();

    /* ============================================================
       EDIT TEAM / MANUAL GRADE
       ============================================================ */

    const editTeamGradeButton =
        document.getElementById('editTeamGradeButton');

    const teamGradedView =
        document.getElementById('teamGradedView');

    const teamGradeEditPanel =
        document.getElementById('teamGradeEditPanel');


    if (editTeamGradeButton) {
        editTeamGradeButton.addEventListener('click', function() {

            teamGradedView?.classList.remove('is-active');

            teamGradeEditPanel?.classList.add('is-active');

        });
    }


    const editManualGradeButton =
        document.getElementById('editManualGradeButton');

    const manualGradedView =
        document.getElementById('manualGradedView');

    const manualGradeEditPanel =
        document.getElementById('manualGradeEditPanel');


    if (editManualGradeButton) {
        editManualGradeButton.addEventListener('click', function() {

            manualGradedView?.classList.remove('is-active');

            manualGradeEditPanel?.classList.add('is-active');

        });
    }
</script>
@endsection