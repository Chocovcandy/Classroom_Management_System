@extends('layouts.prof_layout')

@section('title', 'Create Exam')

@section('content')

<style>
    :root {
        /* Exam accent */
        --e-red: #dc2626;
        --e-red-dark: #b91c1c;
        --e-red-soft: #fef2f2;
        --e-red-border: #fecaca;

        /* General UI blue */
        --e-blue: #2563eb;
        --e-blue-dark: #1d4ed8;
        --e-blue-soft: #eff6ff;
        --e-blue-border: #bfdbfe;

        --e-text: #0f172a;
        --e-text-2: #334155;
        --e-muted: #64748b;
        --e-light: #94a3b8;

        --e-border: #e2e8f0;
        --e-border-light: #edf2f7;

        --e-surface: #ffffff;
        --e-soft: #f8fafc;

        --e-danger: #dc2626;
        --e-danger-soft: #fef2f2;
        --e-danger-border: #fecaca;

        --e-shadow: 0 6px 24px rgba(15, 23, 42, .055);
        --e-small-shadow: 0 2px 8px rgba(15, 23, 42, .045);
    }

    /* ============================================================
       PAGE
       ============================================================ */

    .exam-create-page {
        width: 100%;
        max-width: 1240px;
        margin: 0 auto;
        padding: 30px 26px 60px;
    }

    .exam-create-page *,
    .exam-create-page *::before,
    .exam-create-page *::after {
        box-sizing: border-box;
    }


    /* ============================================================
       HEADER
       ============================================================ */

    .exam-create-header {
        margin-bottom: 24px;
    }

    .exam-header-inner {
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        gap: 24px;
    }

    .exam-header-main {
        display: flex;
        align-items: flex-start;
        gap: 14px;
        min-width: 0;
    }

    .exam-back-btn {
        width: 42px;
        height: 42px;

        display: inline-flex;
        align-items: center;
        justify-content: center;

        flex: 0 0 42px;

        border: 1px solid var(--e-border);
        border-radius: 11px;

        background: var(--e-surface);
        color: var(--e-muted);

        text-decoration: none;

        box-shadow: var(--e-small-shadow);

        transition: .18s ease;
    }

    .exam-back-btn i {
        font-size: 22px;
    }

    .exam-back-btn:hover {
        color: var(--e-red-dark);
        border-color: var(--e-red-border);
        background: var(--e-red-soft);
        transform: translateX(-2px);
    }

    .exam-header-label {
        display: block;

        margin-bottom: 7px;

        color: var(--e-muted);

        font-size: 13px;
        line-height: 1.4;
        font-weight: 800;

        letter-spacing: .04em;
    }

    .exam-title-row {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .exam-title-mark {
        width: 7px;
        height: 36px;

        flex: 0 0 7px;

        border-radius: 999px;

        background: var(--e-red);
    }

    .exam-header-title {
        margin: 0;

        color: var(--e-text);

        font-size: 32px;
        line-height: 1.15;
        font-weight: 800;

        letter-spacing: -.035em;
    }

    .exam-header-subtitle {
        margin: 9px 0 0 17px;

        color: var(--e-muted);

        font-size: 15px;
        line-height: 1.55;
    }

    .exam-header-badge {
        display: inline-flex;
        align-items: center;
        gap: 7px;

        flex: 0 0 auto;

        padding: 9px 13px;

        border: 1px solid var(--e-red-border);
        border-radius: 999px;

        background: var(--e-red-soft);
        color: var(--e-red-dark);

        font-size: 12px;
        font-weight: 800;
    }

    .exam-header-badge i {
        font-size: 17px;
    }


    /* ============================================================
       MAIN LAYOUT
       ============================================================ */

    .exam-create-layout {
        display: grid;
        grid-template-columns: minmax(0, 1fr) 315px;

        align-items: start;

        gap: 22px;
    }

    .exam-create-main,
    .exam-create-sidebar {
        min-width: 0;
    }


    /* ============================================================
       SECTION CARDS
       ============================================================ */

    .exam-section {
        overflow: hidden;

        margin-bottom: 18px;

        border: 1px solid var(--e-border);
        border-radius: 18px;

        background: var(--e-surface);

        box-shadow: var(--e-shadow);
    }

    .exam-section-header {
        display: flex;
        align-items: center;

        gap: 13px;

        padding: 20px 22px;

        border-bottom: 1px solid var(--e-border-light);
    }

    .exam-section-icon {
        width: 42px;
        height: 42px;

        display: inline-flex;
        align-items: center;
        justify-content: center;

        flex: 0 0 42px;

        border: 1px solid var(--e-red-border);
        border-radius: 11px;

        background: var(--e-red-soft);
        color: var(--e-red);

        font-size: 21px;
    }

    .exam-section-heading {
        min-width: 0;
    }

    .exam-section-heading h2 {
        margin: 0;

        color: var(--e-text);

        font-size: 18px;
        line-height: 1.25;
        font-weight: 800;
    }

    .exam-section-heading p {
        margin: 4px 0 0;

        color: var(--e-muted);

        font-size: 13px;
        line-height: 1.5;
    }

    .exam-section-body {
        padding: 24px;
    }


    /* ============================================================
       FORM
       ============================================================ */

    .exam-form-group {
        margin: 0 0 21px;
    }

    .exam-form-group:last-child {
        margin-bottom: 0;
    }

    .exam-form-row {
        display: grid;

        grid-template-columns:
            repeat(2, minmax(0, 1fr));

        gap: 17px;
    }

    .exam-field-label {
        display: flex;
        align-items: center;
        flex-wrap: wrap;

        gap: 7px;

        margin: 0 0 8px;

        color: var(--e-text-2);

        font-size: 14px;
        line-height: 1.4;
        font-weight: 750;
    }

    .exam-required {
        color: #ef4444;
        font-size: 14px;
        font-weight: 800;
    }

    .exam-optional {
        padding: 3px 7px;

        border-radius: 5px;

        background: var(--e-soft);
        color: var(--e-light);

        font-size: 11px;
        line-height: 1.2;
        font-weight: 700;
    }

    .exam-input,
    .exam-select,
    .exam-textarea {
        width: 100%;

        border: 1px solid #cbd5e1;
        border-radius: 11px;

        outline: none;

        background: var(--e-surface);
        color: var(--e-text);

        font-family: inherit;
        font-size: 15px;

        transition:
            border-color .18s ease,
            box-shadow .18s ease,
            background .18s ease;
    }

    .exam-input,
    .exam-select {
        height: 49px;
        padding: 0 14px;
    }

    .exam-textarea {
        min-height: 150px;

        padding: 14px;

        resize: vertical;

        line-height: 1.65;
    }

    .exam-input::placeholder,
    .exam-textarea::placeholder {
        color: #a8b3c2;
    }

    .exam-input:hover,
    .exam-select:hover,
    .exam-textarea:hover {
        border-color: #94a3b8;
    }

    .exam-input:focus,
    .exam-select:focus,
    .exam-textarea:focus {
        border-color: #60a5fa;

        box-shadow:
            0 0 0 3px rgba(37, 99, 235, .11);
    }

    .exam-help {
        display: flex;
        align-items: flex-start;

        gap: 5px;

        margin-top: 7px;

        color: var(--e-light);

        font-size: 12px;
        line-height: 1.5;
    }

    .exam-help i {
        color: var(--e-blue);

        font-size: 15px;

        margin-top: 1px;
    }

    .exam-error {
        display: flex;
        align-items: center;

        gap: 6px;

        margin-top: 7px;

        color: var(--e-danger);

        font-size: 12px;
        line-height: 1.45;
        font-weight: 600;
    }

    .exam-error::before {
        content: "!";

        width: 16px;
        height: 16px;

        display: inline-flex;
        align-items: center;
        justify-content: center;

        flex: 0 0 16px;

        border-radius: 50%;

        background: #fee2e2;

        font-size: 9px;
        font-weight: 800;
    }


    /* ============================================================
       POINTS
       ============================================================ */

    .exam-points-wrap {
        display: flex;
        width: 100%;
    }

    .exam-points-wrap .exam-input {
        border-radius: 11px 0 0 11px;
    }

    .exam-points-unit {
        min-width: 80px;

        display: inline-flex;
        align-items: center;
        justify-content: center;

        padding: 0 13px;

        border: 1px solid #cbd5e1;
        border-left: 0;

        border-radius: 0 11px 11px 0;

        background: var(--e-soft);
        color: var(--e-muted);

        font-size: 13px;
        font-weight: 750;
    }


    /* ============================================================
       GOOGLE FORM
       ============================================================ */

    .exam-google-box {
        padding: 18px;

        border: 1px solid var(--e-blue-border);
        border-radius: 13px;

        background: #f8fbff;
    }

    .exam-google-heading {
        display: flex;
        align-items: center;

        gap: 11px;

        margin-bottom: 14px;
    }

    .exam-google-icon {
        width: 38px;
        height: 38px;

        display: inline-flex;
        align-items: center;
        justify-content: center;

        flex: 0 0 38px;

        border-radius: 9px;

        background: #ffffff;
        color: var(--e-blue);

        box-shadow: var(--e-small-shadow);

        font-size: 20px;
    }

    .exam-google-heading strong {
        display: block;

        color: var(--e-text-2);

        font-size: 14px;
        line-height: 1.3;
        font-weight: 800;
    }

    .exam-google-heading span {
        display: block;

        margin-top: 3px;

        color: var(--e-light);

        font-size: 11px;
        line-height: 1.45;
    }


    /* ============================================================
       UPLOAD
       ============================================================ */

    .exam-upload-area {
        display: block;

        width: 100%;

        position: relative;

        padding: 28px 20px;

        border: 1.5px dashed var(--e-red-border);
        border-radius: 14px;

        background: var(--e-red-soft);

        text-align: center;

        cursor: pointer;

        transition:
            border-color .18s ease,
            background .18s ease,
            transform .18s ease;
    }

    .exam-upload-area:hover,
    .exam-upload-area.is-dragging {
        border-color: var(--e-red);

        background: #fee8e8;

        transform: translateY(-1px);
    }

    .exam-upload-icon {
        width: 52px;
        height: 52px;

        display: inline-flex;
        align-items: center;
        justify-content: center;

        margin-bottom: 11px;

        border: 1px solid var(--e-red-border);
        border-radius: 13px;

        background: #ffffff;
        color: var(--e-red);

        box-shadow: var(--e-small-shadow);

        font-size: 24px;
    }

    .exam-upload-title {
        display: block;

        color: var(--e-text-2);

        font-size: 14px;
        line-height: 1.35;
        font-weight: 800;
    }

    .exam-upload-subtitle {
        display: block;

        max-width: 540px;

        margin: 6px auto 0;

        color: var(--e-light);

        font-size: 12px;
        line-height: 1.55;
    }

    .exam-upload-button {
        height: 36px;

        display: inline-flex;
        align-items: center;

        gap: 6px;

        margin-top: 14px;

        padding: 0 13px;

        border: 1px solid var(--e-red-border);
        border-radius: 8px;

        background: #ffffff;
        color: var(--e-red-dark);

        font-size: 12px;
        font-weight: 750;

        pointer-events: none;
    }

    .exam-upload-input {
        position: absolute;

        width: 1px;
        height: 1px;

        opacity: 0;

        pointer-events: none;
    }


    /* ============================================================
       SELECTED FILES
       ============================================================ */

    .exam-selected-header {
        display: none;

        align-items: center;
        justify-content: space-between;

        margin: 16px 0 10px;
    }

    .exam-selected-header.is-visible {
        display: flex;
    }

    .exam-selected-heading {
        color: var(--e-text-2);

        font-size: 13px;
        font-weight: 800;
    }

    .exam-selected-count {
        min-width: 23px;
        height: 23px;

        display: inline-flex;
        align-items: center;
        justify-content: center;

        padding: 0 7px;

        border-radius: 999px;

        background: var(--e-red-soft);
        color: var(--e-red-dark);

        font-size: 11px;
        font-weight: 800;
    }

    .exam-file-list {
        display: flex;
        flex-direction: column;

        gap: 8px;
    }

    .exam-file-item {
        display: flex;
        align-items: center;

        gap: 11px;

        min-width: 0;

        padding: 11px 12px;

        border: 1px solid var(--e-border);
        border-radius: 10px;

        background: var(--e-surface);

        animation: examFileIn .18s ease;
    }

    @keyframes examFileIn {
        from {
            opacity: 0;
            transform: translateY(-3px);
        }

        to {
            opacity: 1;
            transform: none;
        }
    }

    .exam-file-icon {
        width: 34px;
        height: 34px;

        display: inline-flex;
        align-items: center;
        justify-content: center;

        flex: 0 0 34px;

        border-radius: 8px;

        background: var(--e-red-soft);
        color: var(--e-red);

        font-size: 17px;
    }

    .exam-file-info {
        min-width: 0;
        flex: 1;
    }

    .exam-file-name {
        display: block;

        overflow: hidden;

        color: var(--e-text-2);

        font-size: 13px;
        line-height: 1.35;
        font-weight: 650;

        text-overflow: ellipsis;
        white-space: nowrap;
    }

    .exam-file-size {
        display: block;

        margin-top: 2px;

        color: var(--e-light);

        font-size: 11px;
    }

    .exam-file-remove {
        width: 30px;
        height: 30px;

        display: inline-flex;
        align-items: center;
        justify-content: center;

        flex: 0 0 30px;

        border: 0;
        border-radius: 8px;

        background: var(--e-danger-soft);
        color: var(--e-danger);

        cursor: pointer;

        transition: .18s ease;
    }

    .exam-file-remove:hover {
        background: #fee2e2;
    }


    /* ============================================================
       SIDEBAR
       ============================================================ */

    .exam-sidebar-card {
        position: sticky;
        top: 20px;

        overflow: hidden;

        border: 1px solid var(--e-border);
        border-radius: 18px;

        background: var(--e-surface);

        box-shadow: var(--e-shadow);
    }

    .exam-sidebar-header {
        display: flex;
        align-items: center;

        gap: 10px;

        padding: 20px 18px;

        border-bottom: 1px solid var(--e-border-light);
    }

    .exam-sidebar-header-icon {
        width: 36px;
        height: 36px;

        display: inline-flex;
        align-items: center;
        justify-content: center;

        flex: 0 0 36px;

        border-radius: 9px;

        background: var(--e-red-soft);
        color: var(--e-red);

        font-size: 18px;
    }

    .exam-sidebar-header h3 {
        margin: 0;

        color: var(--e-text);

        font-size: 15px;
        line-height: 1.3;
        font-weight: 800;
    }

    .exam-sidebar-header p {
        margin: 3px 0 0;

        color: var(--e-light);

        font-size: 11px;
        line-height: 1.4;
    }

    .exam-sidebar-body {
        padding: 8px 18px 17px;
    }

    .exam-summary-row {
        display: grid;

        grid-template-columns: 82px minmax(0, 1fr);

        gap: 12px;

        padding: 14px 0;

        border-bottom: 1px solid #f1f5f9;
    }

    .exam-summary-label {
        color: var(--e-muted);

        font-size: 11px;
        line-height: 1.4;
    }

    .exam-summary-value {
        min-width: 0;

        overflow-wrap: anywhere;

        color: var(--e-text-2);

        font-size: 12px;
        line-height: 1.45;
        font-weight: 750;

        text-align: right;
    }

    .exam-summary-value.is-exam {
        color: var(--e-red-dark);
        font-weight: 800;
    }


    /* ============================================================
       SIDEBAR HELP
       ============================================================ */

    .exam-sidebar-help {
        margin: 0 18px 17px;

        padding: 14px;

        border: 1px solid var(--e-blue-border);
        border-radius: 10px;

        background: var(--e-blue-soft);
    }

    .exam-sidebar-help-title {
        display: flex;
        align-items: center;

        gap: 6px;

        margin-bottom: 8px;

        color: #1e40af;

        font-size: 12px;
        font-weight: 800;
    }

    .exam-sidebar-help-title i {
        font-size: 15px;
    }

    .exam-sidebar-help ul {
        margin: 0;

        padding-left: 17px;

        color: #475569;

        font-size: 11px;
        line-height: 1.7;
    }

    .exam-sidebar-help li::marker {
        color: var(--e-blue);
    }


    /* ============================================================
       ACTIONS
       ============================================================ */

    .exam-actions {
        display: grid;

        grid-template-columns: 1fr 1.25fr;

        gap: 9px;

        padding: 17px 18px 18px;

        border-top: 1px solid var(--e-border-light);

        background: #fcfdff;
    }

    .exam-cancel-btn,
    .exam-submit-btn {
        min-width: 0;

        height: 45px;

        display: inline-flex;
        align-items: center;
        justify-content: center;

        gap: 7px;

        border-radius: 10px;

        font-family: inherit;
        font-size: 13px;
        font-weight: 800;

        text-decoration: none;

        cursor: pointer;

        transition: .18s ease;
    }

    .exam-cancel-btn {
        border: 1px solid #cbd5e1;

        background: #ffffff;
        color: var(--e-text-2);
    }

    .exam-cancel-btn:hover {
        border-color: #94a3b8;
        background: var(--e-soft);
    }

    .exam-submit-btn {
        border: 1px solid var(--e-red);

        background: var(--e-red);
        color: #ffffff;

        box-shadow:
            0 5px 12px rgba(220, 38, 38, .16);
    }

    .exam-submit-btn:hover {
        border-color: var(--e-red-dark);

        background: var(--e-red-dark);

        transform: translateY(-1px);
    }

    .exam-submit-btn i {
        font-size: 17px;
    }


    /* ============================================================
       FOCUS
       ============================================================ */

    .exam-create-page button:focus-visible,
    .exam-create-page a:focus-visible,
    .exam-create-page input:focus-visible,
    .exam-create-page select:focus-visible,
    .exam-create-page textarea:focus-visible {
        outline: 3px solid rgba(37, 99, 235, .14);
        outline-offset: 2px;
    }


    /* ============================================================
       RESPONSIVE
       ============================================================ */

    @media (max-width: 1000px) {

        .exam-create-layout {
            grid-template-columns:
                minmax(0, 1fr) 280px;
        }

        .exam-header-title {
            font-size: 29px;
        }
    }


    @media (max-width: 820px) {

        .exam-create-layout {
            grid-template-columns: 1fr;
        }

        .exam-sidebar-card {
            position: static;
        }
    }


    @media (max-width: 620px) {

        .exam-create-page {
            padding: 20px 14px 42px;
        }

        .exam-header-inner {
            display: block;
        }

        .exam-header-badge {
            display: none;
        }

        .exam-back-btn {
            width: 39px;
            height: 39px;

            flex-basis: 39px;
        }

        .exam-title-mark {
            width: 5px;
            height: 30px;

            flex-basis: 5px;
        }

        .exam-header-title {
            font-size: 25px;
        }

        .exam-header-subtitle {
            margin-left: 15px;
            font-size: 13px;
        }

        .exam-section {
            margin-bottom: 14px;
            border-radius: 14px;
        }

        .exam-section-header {
            padding: 17px;
        }

        .exam-section-body {
            padding: 18px;
        }

        .exam-section-icon {
            width: 37px;
            height: 37px;

            flex-basis: 37px;

            font-size: 18px;
        }

        .exam-section-heading h2 {
            font-size: 16px;
        }

        .exam-section-heading p {
            font-size: 12px;
        }

        .exam-form-row {
            grid-template-columns: 1fr;
            gap: 0;
        }

        .exam-form-row .exam-form-group {
            margin-bottom: 21px;
        }

        .exam-form-row .exam-form-group:last-child {
            margin-bottom: 0;
        }

        .exam-actions {
            grid-template-columns: 1fr;
        }

        .exam-summary-row {
            grid-template-columns:
                76px minmax(0, 1fr);
        }

        .exam-upload-area {
            padding: 23px 15px;
        }
    }


    /* ============================================================
       DARK MODE
       ============================================================ */

    .dark-mode .exam-create-page {
        --e-red: #f87171;
        --e-red-dark: #fca5a5;
        --e-red-soft: rgba(248, 113, 113, .12);
        --e-red-border: rgba(248, 113, 113, .34);

        --e-blue: #6d9aff;
        --e-blue-dark: #8badff;
        --e-blue-soft: rgba(109, 154, 255, .12);
        --e-blue-border: rgba(109, 154, 255, .34);

        --e-text: #f4f5ff;
        --e-text-2: #e6e8f7;
        --e-muted: #a1a4cc;
        --e-light: #9295bd;

        --e-border: #2b2e52;
        --e-border-light: #252847;

        --e-surface: #171933;
        --e-soft: #1c1e3a;

        --e-shadow: 0 8px 28px rgba(0, 0, 10, .28);
        --e-small-shadow: 0 2px 10px rgba(0, 0, 10, .20);

        color-scheme: dark;
    }

    .dark-mode .exam-create-page .exam-section,
    .dark-mode .exam-create-page .exam-sidebar-card {
        background: var(--e-surface);
        border-color: var(--e-border);
        box-shadow: var(--e-shadow);
    }

    .dark-mode .exam-create-page .exam-back-btn {
        border-color: var(--e-border);
        background: var(--e-surface);
        color: var(--e-light);
    }

    .dark-mode .exam-create-page .exam-back-btn:hover {
        border-color: var(--e-blue-border);
        background: var(--e-blue-soft);
        color: var(--e-blue-dark);
    }

    .dark-mode .exam-create-page .exam-header-label,
    .dark-mode .exam-create-page .exam-header-subtitle,
    .dark-mode .exam-create-page .exam-section-heading p,
    .dark-mode .exam-create-page .exam-help,
    .dark-mode .exam-create-page .exam-sidebar-header p,
    .dark-mode .exam-create-page .exam-summary-label,
    .dark-mode .exam-create-page .exam-upload-subtitle,
    .dark-mode .exam-create-page .exam-file-size {
        color: var(--e-muted);
    }

    .dark-mode .exam-create-page .exam-header-title,
    .dark-mode .exam-create-page .exam-section-heading h2,
    .dark-mode .exam-create-page .exam-sidebar-header h3 {
        color: var(--e-text);
    }

    .dark-mode .exam-create-page .exam-field-label {
        color: var(--e-text-2);
    }

    .dark-mode .exam-create-page .exam-optional {
        background: #242648;
        color: var(--e-light);
    }

    .dark-mode .exam-create-page .exam-input,
    .dark-mode .exam-create-page .exam-select,
    .dark-mode .exam-create-page .exam-textarea {
        border-color: #3a3e68;
        background: #12142a;
        color: var(--e-text);
    }

    .dark-mode .exam-create-page .exam-input::placeholder,
    .dark-mode .exam-create-page .exam-textarea::placeholder {
        color: #6f72a0;
    }

    .dark-mode .exam-create-page .exam-input:hover,
    .dark-mode .exam-create-page .exam-select:hover,
    .dark-mode .exam-create-page .exam-textarea:hover {
        border-color: #565b8d;
    }

    .dark-mode .exam-create-page .exam-input:focus,
    .dark-mode .exam-create-page .exam-select:focus,
    .dark-mode .exam-create-page .exam-textarea:focus {
        border-color: var(--e-blue);
        box-shadow:
            0 0 0 3px rgba(109, 154, 255, .16);
    }

    .dark-mode .exam-create-page .exam-points-unit {
        border-color: #3a3e68;
        background: #1c1e3a;
        color: var(--e-muted);
    }

    .dark-mode .exam-create-page .exam-google-box {
        border-color: var(--e-blue-border);
        background: rgba(109, 154, 255, .07);
    }

    .dark-mode .exam-create-page .exam-google-icon {
        background: #171933;
        color: var(--e-blue-dark);
    }

    .dark-mode .exam-create-page .exam-google-heading strong {
        color: var(--e-text-2);
    }

    .dark-mode .exam-create-page .exam-google-heading span {
        color: var(--e-light);
    }

    .dark-mode .exam-create-page .exam-upload-area {
        border-color: var(--e-blue-border);
        background: var(--e-blue-soft);
    }

    .dark-mode .exam-create-page .exam-upload-area:hover,
    .dark-mode .exam-create-page .exam-upload-area.is-dragging {
        border-color: var(--e-blue);
        background: rgba(109, 154, 255, .17);
    }

    .dark-mode .exam-create-page .exam-upload-icon,
    .dark-mode .exam-create-page .exam-upload-button {
        border-color: var(--e-blue-border);
        background: #171933;
        color: var(--e-blue-dark);
    }

    .dark-mode .exam-create-page .exam-upload-title,
    .dark-mode .exam-create-page .exam-selected-heading,
    .dark-mode .exam-create-page .exam-file-name {
        color: var(--e-text-2);
    }

    .dark-mode .exam-create-page .exam-selected-count {
        background: var(--e-blue-soft);
        color: var(--e-blue-dark);
    }

    .dark-mode .exam-create-page .exam-file-item {
        border-color: var(--e-border);
        background: #12142a;
    }

    .dark-mode .exam-create-page .exam-file-icon {
        background: var(--e-blue-soft);
        color: var(--e-blue);
    }

    .dark-mode .exam-create-page .exam-sidebar-help {
        border-color: var(--e-blue-border);
        background: rgba(109, 154, 255, .08);
    }

    .dark-mode .exam-create-page .exam-sidebar-help-title {
        color: var(--e-blue-dark);
    }

    .dark-mode .exam-create-page .exam-sidebar-help ul {
        color: #a1a4cc;
    }

    .dark-mode .exam-create-page .exam-actions {
        border-color: var(--e-border-light);
        background: #12142a;
    }

    .dark-mode .exam-create-page .exam-cancel-btn {
        border-color: #3a3e68;
        background: #171933;
        color: var(--e-text-2);
    }

    .dark-mode .exam-create-page .exam-cancel-btn:hover {
        border-color: #565b8d;
        background: #1c1e3a;
    }

    .dark-mode .exam-create-page .exam-back-btn:hover {
        border-color: var(--e-red-border);
        background: var(--e-red-soft);
        color: var(--e-red-dark);
    }

    .dark-mode .exam-create-page .exam-title-mark {
        background: var(--e-red);
    }

    .dark-mode .exam-create-page .exam-header-badge {
        border-color: var(--e-red-border);
        background: var(--e-red-soft);
        color: var(--e-red-dark);
    }

    .dark-mode .exam-create-page .exam-section-icon {
        border-color: var(--e-red-border);
        background: var(--e-red-soft);
        color: var(--e-red);
    }

    .dark-mode .exam-create-page .exam-upload-area {
        border-color: var(--e-red-border);
        background: var(--e-red-soft);
    }

    .dark-mode .exam-create-page .exam-upload-area:hover,
    .dark-mode .exam-create-page .exam-upload-area.is-dragging {
        border-color: var(--e-red);
        background: rgba(248, 113, 113, .17);
    }

    .dark-mode .exam-create-page .exam-upload-icon,
    .dark-mode .exam-create-page .exam-upload-button {
        border-color: var(--e-red-border);
        background: var(--e-surface);
        color: var(--e-red-dark);
    }

    .dark-mode .exam-create-page .exam-selected-count {
        background: var(--e-red-soft);
        color: var(--e-red-dark);
    }

    .dark-mode .exam-create-page .exam-file-icon {
        background: var(--e-red-soft);
        color: var(--e-red);
    }

    .dark-mode .exam-create-page .exam-sidebar-header-icon {
        background: var(--e-red-soft);
        color: var(--e-red);
    }

    .dark-mode .exam-create-page .exam-submit-btn {
        border-color: var(--e-red);
        background: var(--e-red);
        color: #ffffff;
    }
</style>


<div class="exam-create-page">

    {{-- ============================================================
         HEADER
         ============================================================ --}}

    <header class="exam-create-header">

        <div class="exam-header-inner">

            <div class="exam-header-main">

                <a href="{{ route(
                    'professor.class-groups.classroom-group.classwork',
                    ['classGroup' => $classGroup->id]
                ) }}"
                   class="exam-back-btn"
                   title="Back to Classwork">

                    <i class="bx bx-arrow-back"></i>

                </a>


                <div>

                    <span class="exam-header-label">
                        {{ $classGroup->group_name }}
                    </span>


                    <div class="exam-title-row">

                        <span class="exam-title-mark"></span>

                        <h1 class="exam-header-title">
                            Create Exam
                        </h1>

                    </div>


                    <p class="exam-header-subtitle">
                        Create a new exam and provide everything your students need.
                    </p>

                </div>

            </div>


            <span class="exam-header-badge">

                <i class="bx bx-file"></i>

                Exam

            </span>

        </div>

    </header>



    {{-- ============================================================
         MAIN LAYOUT
         ============================================================ --}}

    <div class="exam-create-layout">

        <main class="exam-create-main">

            <form id="exam-create-form"
                  action="{{ route(
                      'professor.class-groups.exams.store',
                      ['classGroup' => $classGroup->id]
                  ) }}"
                  method="POST"
                  enctype="multipart/form-data">

                @csrf


                {{-- ====================================================
                     EXAM DETAILS
                     ==================================================== --}}

                <section class="exam-section">

                    <div class="exam-section-header">

                        <div class="exam-section-icon">
                            <i class="bx bx-file"></i>
                        </div>


                        <div class="exam-section-heading">

                            <h2>
                                Exam Details
                            </h2>

                            <p>
                                Set the title, instructions, and classroom topic.
                            </p>

                        </div>

                    </div>


                    <div class="exam-section-body">

                        {{-- TITLE --}}

                        <div class="exam-form-group">

                            <label class="exam-field-label"
                                   for="title">

                                Exam Title

                                <span class="exam-required">
                                    *
                                </span>

                            </label>


                            <input class="exam-input"
                                   type="text"
                                   id="title"
                                   name="title"
                                   value="{{ old('title') }}"
                                   placeholder="e.g. Database Systems Final Exam"
                                   maxlength="255"
                                   required>


                            @error('title')

                                <div class="exam-error">
                                    {{ $message }}
                                </div>

                            @enderror

                        </div>


                        {{-- DESCRIPTION --}}

                        <div class="exam-form-group">

                            <label class="exam-field-label"
                                   for="description">

                                Instructions

                            </label>


                            <textarea class="exam-textarea"
                                      id="description"
                                      name="description"
                                      placeholder="Explain the exam instructions, requirements, or rules...">{{ old('description') }}</textarea>


                            @error('description')

                                <div class="exam-error">
                                    {{ $message }}
                                </div>

                            @enderror

                        </div>


                        {{-- TOPIC --}}

                        <div class="exam-form-group">

                            <label class="exam-field-label"
                                   for="topic_id">

                                Topic

                                <span class="exam-optional">
                                    Optional
                                </span>

                            </label>


                            <select class="exam-select"
                                    id="topic_id"
                                    name="topic_id">

                                <option value="">
                                    No topic
                                </option>


                                @foreach($classGroup->topics as $topic)

                                    <option value="{{ $topic->id }}"
                                        {{ old('topic_id') == $topic->id ? 'selected' : '' }}>

                                        {{ $topic->topic_name }}

                                    </option>

                                @endforeach

                            </select>


                            <span class="exam-help">

                                <i class="bx bx-info-circle"></i>

                                Organize this exam under one of your classroom topics.

                            </span>


                            @error('topic_id')

                                <div class="exam-error">
                                    {{ $message }}
                                </div>

                            @enderror

                        </div>

                    </div>

                </section>



                {{-- ====================================================
                     SCHEDULE & GRADING
                     ==================================================== --}}

                <section class="exam-section">

                    <div class="exam-section-header">

                        <div class="exam-section-icon">
                            <i class="bx bx-calendar-check"></i>
                        </div>


                        <div class="exam-section-heading">

                            <h2>
                                Schedule & Grading
                            </h2>

                            <p>
                                Set the deadline and maximum score for this exam.
                            </p>

                        </div>

                    </div>


                    <div class="exam-section-body">

                        <div class="exam-form-row">

                            {{-- DUE DATE --}}

                            <div class="exam-form-group">

                                <label class="exam-field-label"
                                       for="due_date">

                                    Due Date

                                    <span class="exam-optional">
                                        Optional
                                    </span>

                                </label>


                                <input class="exam-input"
                                       type="date"
                                       id="due_date"
                                       name="due_date"
                                       value="{{ old('due_date') }}">


                                @error('due_date')

                                    <div class="exam-error">
                                        {{ $message }}
                                    </div>

                                @enderror

                            </div>


                            {{-- DUE TIME --}}

                            <div class="exam-form-group">

                                <label class="exam-field-label"
                                       for="due_time">

                                    Due Time

                                    <span class="exam-optional">
                                        Optional
                                    </span>

                                </label>


                                <input class="exam-input"
                                       type="time"
                                       id="due_time"
                                       name="due_time"
                                       value="{{ old('due_time') }}">


                                @error('due_time')

                                    <div class="exam-error">
                                        {{ $message }}
                                    </div>

                                @enderror

                            </div>

                        </div>


                        {{-- POINTS --}}

                        <div class="exam-form-group"
                             style="margin-top: 19px;">

                            <label class="exam-field-label"
                                   for="points">

                                Total Points

                                <span class="exam-optional">
                                    Optional
                                </span>

                            </label>


                            <div class="exam-points-wrap">

                                <input class="exam-input"
                                       type="number"
                                       id="points"
                                       name="points"
                                       value="{{ old('points') }}"
                                       min="0"
                                       step="0.01"
                                       placeholder="100">


                                <span class="exam-points-unit">
                                    Points
                                </span>

                            </div>


                            <span class="exam-help">

                                <i class="bx bx-info-circle"></i>

                                This is the maximum score students can receive for this exam.

                            </span>


                            @error('points')

                                <div class="exam-error">
                                    {{ $message }}
                                </div>

                            @enderror

                        </div>

                    </div>

                </section>



                {{-- ====================================================
                     ONLINE SUBMISSION
                     ==================================================== --}}

                <section class="exam-section">

                    <div class="exam-section-header">

                        <div class="exam-section-icon">
                            <i class="bx bx-link-external"></i>
                        </div>


                        <div class="exam-section-heading">

                            <h2>
                                Online Submission
                            </h2>

                            <p>
                                Optionally connect a Google Form for student responses.
                            </p>

                        </div>

                    </div>


                    <div class="exam-section-body">

                        <div class="exam-google-box">

                            <div class="exam-google-heading">

                                <div class="exam-google-icon">
                                    <i class="bx bx-link"></i>
                                </div>


                                <div>

                                    <strong>
                                        Google Form
                                    </strong>

                                    <span>
                                        Students can use the form as an additional exam submission method.
                                    </span>

                                </div>

                            </div>


                            <div class="exam-form-group">

                                <label class="exam-field-label"
                                       for="google_form_url">

                                    Google Form URL

                                    <span class="exam-optional">
                                        Optional
                                    </span>

                                </label>


                                <input class="exam-input"
                                       type="url"
                                       id="google_form_url"
                                       name="google_form_url"
                                       value="{{ old('google_form_url') }}"
                                       placeholder="https://forms.google.com/...">


                                <span class="exam-help">

                                    <i class="bx bx-info-circle"></i>

                                    Leave this empty if students should complete the exam directly through the classroom.

                                </span>


                                @error('google_form_url')

                                    <div class="exam-error">
                                        {{ $message }}
                                    </div>

                                @enderror

                            </div>

                        </div>

                    </div>

                </section>



                {{-- ====================================================
                     ATTACHMENTS
                     ==================================================== --}}

                <section class="exam-section">

                    <div class="exam-section-header">

                        <div class="exam-section-icon">
                            <i class="bx bx-paperclip"></i>
                        </div>


                        <div class="exam-section-heading">

                            <h2>
                                Attachments
                            </h2>

                            <p>
                                Add exam papers, instructions, references, or other exam resources.
                            </p>

                        </div>

                    </div>


                    <div class="exam-section-body">

                        <label class="exam-upload-area"
                               for="attachments">

                            <div class="exam-upload-icon">
                                <i class="bx bx-cloud-upload"></i>
                            </div>


                            <strong class="exam-upload-title">
                                Select files to attach
                            </strong>


                            <span class="exam-upload-subtitle">
                                Choose one or more files to include with this exam.
                                Maximum 100 MB per file.
                            </span>


                            <span class="exam-upload-button">

                                <i class="bx bx-folder-open"></i>

                                Choose Files

                            </span>


                            <input class="exam-upload-input"
                                   type="file"
                                   id="attachments"
                                   name="attachments[]"
                                   multiple>

                        </label>


                        <div id="exam-selected-header"
                             class="exam-selected-header">

                            <span class="exam-selected-heading">
                                Selected files
                            </span>


                            <span id="exam-selected-count"
                                  class="exam-selected-count">

                                0

                            </span>

                        </div>


                        <div id="exam-file-list"
                             class="exam-file-list">
                        </div>


                        @error('attachments')

                            <div class="exam-error">
                                {{ $message }}
                            </div>

                        @enderror


                        @error('attachments.*')

                            <div class="exam-error">
                                {{ $message }}
                            </div>

                        @enderror

                    </div>

                </section>

            </form>

        </main>



        {{-- ============================================================
             SIDEBAR
             ============================================================ --}}

        <aside class="exam-create-sidebar">

            <div class="exam-sidebar-card">

                <div class="exam-sidebar-header">

                    <div class="exam-sidebar-header-icon">
                        <i class="bx bx-file"></i>
                    </div>


                    <div>

                        <h3>
                            Exam Summary
                        </h3>

                        <p>
                            Review the important settings before creating.
                        </p>

                    </div>

                </div>


                <div class="exam-sidebar-body">

                    {{-- CLASS --}}

                    <div class="exam-summary-row">

                        <span class="exam-summary-label">
                            Class
                        </span>


                        <span class="exam-summary-value">
                            {{ $classGroup->group_name }}
                        </span>

                    </div>


                    {{-- TOPIC --}}

                    <div class="exam-summary-row">

                        <span class="exam-summary-label">
                            Topic
                        </span>


                        <span id="exam-sidebar-topic"
                              class="exam-summary-value">

                            No topic

                        </span>

                    </div>


                    {{-- POINTS --}}

                    <div class="exam-summary-row">

                        <span class="exam-summary-label">
                            Points
                        </span>


                        <span id="exam-sidebar-points"
                              class="exam-summary-value is-exam">

                            0 Points

                        </span>

                    </div>


                    {{-- DUE DATE --}}

                    <div class="exam-summary-row">

                        <span class="exam-summary-label">
                            Due Date
                        </span>


                        <span id="exam-sidebar-date"
                              class="exam-summary-value">

                            Not set

                        </span>

                    </div>


                    {{-- DUE TIME --}}

                    <div class="exam-summary-row">

                        <span class="exam-summary-label">
                            Due Time
                        </span>


                        <span id="exam-sidebar-time"
                              class="exam-summary-value">

                            Not set

                        </span>

                    </div>


                    {{-- ATTACHMENTS --}}

                    <div class="exam-summary-row">

                        <span class="exam-summary-label">
                            Attachments
                        </span>


                        <span id="exam-sidebar-file-count"
                              class="exam-summary-value">

                            0 files

                        </span>

                    </div>


                    {{-- GOOGLE FORM --}}

                    <div class="exam-summary-row">

                        <span class="exam-summary-label">
                            Google Form
                        </span>


                        <span id="exam-sidebar-google-status"
                              class="exam-summary-value">

                            Not connected

                        </span>

                    </div>

                </div>



                {{-- HELP --}}

                <div class="exam-sidebar-help">

                    <div class="exam-sidebar-help-title">

                        <i class="bx bx-info-circle"></i>

                        Before creating

                    </div>


                    <ul>

                        <li>
                            Give the exam a clear title.
                        </li>

                        <li>
                            Explain the exam instructions clearly.
                        </li>

                        <li>
                            Set the correct due date and points.
                        </li>

                        <li>
                            Add supporting files if needed.
                        </li>

                    </ul>

                </div>



                {{-- ACTIONS --}}

                <div class="exam-actions">

                    <a href="{{ route(
                        'professor.class-groups.classroom-group.classwork',
                        ['classGroup' => $classGroup->id]
                    ) }}"
                       class="exam-cancel-btn">

                        Cancel

                    </a>


                    <button type="submit"
                            form="exam-create-form"
                            class="exam-submit-btn">

                        <i class="bx bx-plus"></i>

                        Create Exam

                    </button>

                </div>

            </div>

        </aside>

    </div>

</div>



<script>
    document.addEventListener('DOMContentLoaded', function () {

        /* ============================================================
           ELEMENTS
           ============================================================ */

        const fileInput = document.getElementById('attachments');
        const fileList = document.getElementById('exam-file-list');

        const selectedHeader =
            document.getElementById('exam-selected-header');

        const selectedCount =
            document.getElementById('exam-selected-count');

        const sidebarFileCount =
            document.getElementById('exam-sidebar-file-count');

        const uploadArea =
            document.querySelector('.exam-upload-area');

        const pointsInput =
            document.getElementById('points');

        const pointsSummary =
            document.getElementById('exam-sidebar-points');

        const topicInput =
            document.getElementById('topic_id');

        const topicSummary =
            document.getElementById('exam-sidebar-topic');

        const dueDateInput =
            document.getElementById('due_date');

        const dueDateSummary =
            document.getElementById('exam-sidebar-date');

        const dueTimeInput =
            document.getElementById('due_time');

        const dueTimeSummary =
            document.getElementById('exam-sidebar-time');

        const googleInput =
            document.getElementById('google_form_url');

        const googleStatus =
            document.getElementById('exam-sidebar-google-status');


        let selectedFiles = [];


        /* ============================================================
           FILE INPUT
           ============================================================ */

        function syncFileInput() {

            if (!fileInput) {
                return;
            }

            const dataTransfer = new DataTransfer();

            selectedFiles.forEach(function (file) {
                dataTransfer.items.add(file);
            });

            fileInput.files = dataTransfer.files;
        }


        /* ============================================================
           FILE SIZE
           ============================================================ */

        function formatFileSize(bytes) {

            if (bytes === 0) {
                return '0 Bytes';
            }

            const units = [
                'Bytes',
                'KB',
                'MB',
                'GB'
            ];

            const i = Math.floor(
                Math.log(bytes) / Math.log(1024)
            );

            return (
                parseFloat(
                    (bytes / Math.pow(1024, i)).toFixed(2)
                ) +
                ' ' +
                units[i]
            );
        }


        /* ============================================================
           RENDER FILES
           ============================================================ */

        function renderFiles() {

            if (!fileList) {
                return;
            }

            fileList.innerHTML = '';


            if (selectedHeader) {

                selectedHeader.classList.toggle(
                    'is-visible',
                    selectedFiles.length > 0
                );

            }


            if (selectedCount) {

                selectedCount.textContent =
                    selectedFiles.length;

            }


            if (sidebarFileCount) {

                sidebarFileCount.textContent =
                    selectedFiles.length +
                    (
                        selectedFiles.length === 1
                            ? ' file'
                            : ' files'
                    );

            }


            selectedFiles.forEach(function (file, index) {

                const row =
                    document.createElement('div');

                row.className =
                    'exam-file-item';


                const iconWrap =
                    document.createElement('div');

                iconWrap.className =
                    'exam-file-icon';


                const icon =
                    document.createElement('i');

                icon.className =
                    'bx bx-file';


                const info =
                    document.createElement('div');

                info.className =
                    'exam-file-info';


                const name =
                    document.createElement('span');

                name.className =
                    'exam-file-name';

                name.textContent =
                    file.name;


                const size =
                    document.createElement('small');

                size.className =
                    'exam-file-size';

                size.textContent =
                    formatFileSize(file.size);


                const remove =
                    document.createElement('button');

                remove.type =
                    'button';

                remove.className =
                    'exam-file-remove';

                remove.title =
                    'Remove file';

                remove.setAttribute(
                    'aria-label',
                    'Remove ' + file.name
                );

                remove.innerHTML =
                    '<i class="bx bx-x"></i>';


                remove.addEventListener(
                    'click',
                    function () {

                        selectedFiles.splice(
                            index,
                            1
                        );

                        syncFileInput();

                        renderFiles();

                    }
                );


                iconWrap.appendChild(icon);

                info.appendChild(name);
                info.appendChild(size);

                row.appendChild(iconWrap);
                row.appendChild(info);
                row.appendChild(remove);

                fileList.appendChild(row);

            });

        }


        /* ============================================================
           ADD FILES
           ============================================================ */

        function addFiles(files) {

            Array.from(files).forEach(function (file) {

                const duplicate =
                    selectedFiles.some(
                        function (existing) {

                            return (
                                existing.name === file.name &&
                                existing.size === file.size &&
                                existing.lastModified === file.lastModified
                            );

                        }
                    );


                if (!duplicate) {

                    selectedFiles.push(file);

                }

            });


            syncFileInput();
            renderFiles();

        }


        /* ============================================================
           FILE CHANGE
           ============================================================ */

        if (fileInput) {

            fileInput.addEventListener(
                'change',
                function () {

                    addFiles(this.files);

                }
            );

        }


        /* ============================================================
           DRAG & DROP
           ============================================================ */

        if (uploadArea && fileInput) {

            ['dragenter', 'dragover'].forEach(
                function (eventName) {

                    uploadArea.addEventListener(
                        eventName,
                        function (event) {

                            event.preventDefault();
                            event.stopPropagation();

                            uploadArea.classList.add(
                                'is-dragging'
                            );

                        }
                    );

                }
            );


            ['dragleave', 'drop'].forEach(
                function (eventName) {

                    uploadArea.addEventListener(
                        eventName,
                        function (event) {

                            event.preventDefault();
                            event.stopPropagation();

                            uploadArea.classList.remove(
                                'is-dragging'
                            );

                        }
                    );

                }
            );


            uploadArea.addEventListener(
                'drop',
                function (event) {

                    if (
                        event.dataTransfer &&
                        event.dataTransfer.files
                    ) {

                        addFiles(
                            event.dataTransfer.files
                        );

                    }

                }
            );

        }


        /* ============================================================
           POINTS SUMMARY
           ============================================================ */

        if (pointsInput && pointsSummary) {

            function updatePoints() {

                const value =
                    pointsInput.value.trim() || '0';

                pointsSummary.textContent =
                    value + ' Points';

            }


            pointsInput.addEventListener(
                'input',
                updatePoints
            );

            updatePoints();

        }


        /* ============================================================
           TOPIC SUMMARY
           ============================================================ */

        if (topicInput && topicSummary) {

            function updateTopic() {

                if (
                    topicInput.value === ''
                ) {

                    topicSummary.textContent =
                        'No topic';

                    return;

                }


                const selectedOption =
                    topicInput.options[
                        topicInput.selectedIndex
                    ];


                topicSummary.textContent =
                    selectedOption
                        ? selectedOption.textContent.trim()
                        : 'No topic';

            }


            topicInput.addEventListener(
                'change',
                updateTopic
            );

            updateTopic();

        }


        /* ============================================================
           DUE DATE SUMMARY
           ============================================================ */

        if (dueDateInput && dueDateSummary) {

            function updateDueDate() {

                dueDateSummary.textContent =
                    dueDateInput.value.trim() !== ''
                        ? dueDateInput.value
                        : 'Not set';

            }


            dueDateInput.addEventListener(
                'change',
                updateDueDate
            );

            dueDateInput.addEventListener(
                'input',
                updateDueDate
            );

            updateDueDate();

        }


        /* ============================================================
           DUE TIME SUMMARY
           ============================================================ */

        if (dueTimeInput && dueTimeSummary) {

            function updateDueTime() {

                dueTimeSummary.textContent =
                    dueTimeInput.value.trim() !== ''
                        ? dueTimeInput.value
                        : 'Not set';

            }


            dueTimeInput.addEventListener(
                'change',
                updateDueTime
            );

            dueTimeInput.addEventListener(
                'input',
                updateDueTime
            );

            updateDueTime();

        }


        /* ============================================================
           GOOGLE FORM STATUS
           ============================================================ */

        if (googleInput && googleStatus) {

            function updateGoogleStatus() {

                if (
                    googleInput.value.trim() !== ''
                ) {

                    googleStatus.textContent =
                        'Connected';

                    googleStatus.classList.add(
                        'is-exam'
                    );

                } else {

                    googleStatus.textContent =
                        'Not connected';

                    googleStatus.classList.remove(
                        'is-exam'
                    );

                }

            }


            googleInput.addEventListener(
                'input',
                updateGoogleStatus
            );

            updateGoogleStatus();

        }

    });
</script>

@endsection