@extends('layouts.prof_layout')

@section('title', 'Create Material')

@section('content')

<style>
    :root {
        --m-blue: #2563eb;
        --m-blue-dark: #1d4ed8;
        --m-blue-soft: #eff6ff;
        --m-blue-border: #bfdbfe;
        --m-text: #0f172a;
        --m-text-2: #334155;
        --m-muted: #64748b;
        --m-light: #94a3b8;
        --m-border: #e2e8f0;
        --m-border-light: #edf2f7;
        --m-surface: #ffffff;
        --m-soft: #f8fafc;
        --m-danger: #dc2626;
        --m-danger-soft: #fef2f2;
        --m-shadow: 0 6px 24px rgba(15, 23, 42, .055);
        --m-small-shadow: 0 2px 8px rgba(15, 23, 42, .045);
    }

    .material-create-page {
        width: 100%;
        max-width: 1240px;
        margin: 0 auto;
        padding: 30px 26px 60px;
    }

    .material-create-page *,
    .material-create-page *::before,
    .material-create-page *::after {
        box-sizing: border-box;
    }

    /* =========================================================
       HEADER
    ========================================================= */

    .material-create-header {
        margin-bottom: 24px;
    }

    .material-header-inner {
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        gap: 24px;
    }

    .material-header-main {
        display: flex;
        align-items: flex-start;
        gap: 14px;
        min-width: 0;
    }

    .material-back-btn {
        width: 42px;
        height: 42px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        flex: 0 0 42px;
        border: 1px solid var(--m-border);
        border-radius: 11px;
        background: #fff;
        color: var(--m-muted);
        text-decoration: none;
        box-shadow: var(--m-small-shadow);
        transition: .18s ease;
    }

    .material-back-btn:hover {
        color: var(--m-blue-dark);
        border-color: var(--m-blue-border);
        background: var(--m-blue-soft);
        transform: translateX(-2px);
    }

    .material-header-label {
        display: block;
        margin-bottom: 7px;
        color: var(--m-muted);
        font-size: 11px;
        font-weight: 800;
        letter-spacing: .14em;
        text-transform: uppercase;
    }

    .material-title-row {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .material-title-mark {
        width: 7px;
        height: 34px;
        flex: 0 0 7px;
        border-radius: 999px;
        background: var(--m-blue);
    }

    .material-header-title {
        margin: 0;
        color: var(--m-text);
        font-size: 30px;
        line-height: 1.15;
        font-weight: 800;
        letter-spacing: -.035em;
    }

    .material-header-subtitle {
        margin: 8px 0 0 17px;
        color: var(--m-muted);
        font-size: 14px;
        line-height: 1.5;
    }

    .material-header-badge {
        display: inline-flex;
        align-items: center;
        gap: 7px;
        flex: 0 0 auto;
        padding: 8px 12px;
        border: 1px solid var(--m-blue-border);
        border-radius: 999px;
        background: var(--m-blue-soft);
        color: var(--m-blue-dark);
        font-size: 11px;
        font-weight: 800;
    }

    /* =========================================================
       LAYOUT
    ========================================================= */

    .material-create-layout {
        display: grid;
        grid-template-columns: minmax(0, 1fr) 315px;
        align-items: start;
        gap: 22px;
    }

    .material-create-main,
    .material-create-sidebar {
        min-width: 0;
    }

    /* =========================================================
       SECTIONS
    ========================================================= */

    .material-section {
        overflow: hidden;
        margin-bottom: 18px;
        border: 1px solid var(--m-border);
        border-radius: 18px;
        background: var(--m-surface);
        box-shadow: var(--m-shadow);
    }

    .material-section-header {
        display: flex;
        align-items: center;
        gap: 13px;
        padding: 19px 22px;
        border-bottom: 1px solid var(--m-border-light);
    }

    .material-section-icon {
        width: 40px;
        height: 40px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        flex: 0 0 40px;
        border: 1px solid var(--m-blue-border);
        border-radius: 11px;
        background: var(--m-blue-soft);
        color: var(--m-blue);
        font-size: 20px;
    }

    .material-section-heading {
        min-width: 0;
    }

    .material-section-heading h2 {
        margin: 0;
        color: var(--m-text);
        font-size: 16px;
        line-height: 1.25;
        font-weight: 800;
    }

    .material-section-heading p {
        margin: 4px 0 0;
        color: var(--m-muted);
        font-size: 12px;
        line-height: 1.45;
    }

    .material-section-body {
        padding: 23px;
    }

    /* =========================================================
       FIELDS
    ========================================================= */

    .material-form-group {
        margin: 0 0 20px;
    }

    .material-form-group:last-child {
        margin-bottom: 0;
    }

    .material-field-label {
        display: flex;
        align-items: center;
        flex-wrap: wrap;
        gap: 6px;
        margin: 0 0 8px;
        color: var(--m-text-2);
        font-size: 13px;
        font-weight: 750;
    }

    .material-required {
        color: #ef4444;
    }

    .material-optional {
        padding: 2px 6px;
        border-radius: 5px;
        background: var(--m-soft);
        color: var(--m-light);
        font-size: 10px;
        font-weight: 700;
    }

    .material-input,
    .material-select,
    .material-textarea {
        width: 100%;
        border: 1px solid #cbd5e1;
        border-radius: 11px;
        outline: none;
        background: #fff;
        color: var(--m-text);
        font-family: inherit;
        font-size: 14px;
        transition: .18s ease;
    }

    .material-input,
    .material-select {
        height: 45px;
        padding: 0 13px;
    }

    .material-textarea {
        min-height: 155px;
        padding: 13px;
        resize: vertical;
        line-height: 1.6;
    }

    .material-input::placeholder,
    .material-textarea::placeholder {
        color: #a8b3c2;
    }

    .material-input:hover,
    .material-select:hover,
    .material-textarea:hover {
        border-color: #94a3b8;
    }

    .material-input:focus,
    .material-select:focus,
    .material-textarea:focus {
        border-color: #60a5fa;
        box-shadow: 0 0 0 3px rgba(59, 130, 246, .11);
    }

    .material-help {
        display: flex;
        gap: 5px;
        margin-top: 7px;
        color: var(--m-light);
        font-size: 11px;
        line-height: 1.5;
    }

    .material-help i {
        color: var(--m-blue);
        font-size: 14px;
    }

    .material-error {
        display: flex;
        gap: 6px;
        margin-top: 7px;
        color: var(--m-danger);
        font-size: 12px;
        line-height: 1.45;
        font-weight: 600;
    }

    .material-error::before {
        content: "!";
        width: 15px;
        height: 15px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        flex: 0 0 15px;
        border-radius: 50%;
        background: #fee2e2;
        font-size: 9px;
        font-weight: 800;
    }

    .material-form-row {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 16px;
    }

    /* =========================================================
       FILE UPLOAD
    ========================================================= */

    .material-upload-area {
        display: block;
        width: 100%;
        position: relative;
        padding: 27px 20px;
        border: 1.5px dashed var(--m-blue-border);
        border-radius: 14px;
        background: var(--m-blue-soft);
        text-align: center;
        cursor: pointer;
        transition: .18s ease;
    }

    .material-upload-area:hover,
    .material-upload-area.is-dragging {
        border-color: var(--m-blue);
        background: #eaf2ff;
        transform: translateY(-1px);
    }

    .material-upload-icon {
        width: 49px;
        height: 49px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 10px;
        border: 1px solid var(--m-blue-border);
        border-radius: 13px;
        background: #fff;
        color: var(--m-blue);
        box-shadow: var(--m-small-shadow);
        font-size: 22px;
    }

    .material-upload-title {
        display: block;
        color: var(--m-text-2);
        font-size: 13px;
        font-weight: 800;
    }

    .material-upload-subtitle {
        display: block;
        max-width: 520px;
        margin: 5px auto 0;
        color: var(--m-light);
        font-size: 11px;
        line-height: 1.5;
    }

    .material-upload-button {
        height: 34px;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        margin-top: 13px;
        padding: 0 12px;
        border: 1px solid var(--m-blue-border);
        border-radius: 8px;
        background: #fff;
        color: var(--m-blue-dark);
        font-size: 11px;
        font-weight: 750;
        pointer-events: none;
    }

    .material-upload-input {
        position: absolute;
        width: 1px;
        height: 1px;
        opacity: 0;
        pointer-events: none;
    }

    /* =========================================================
       SELECTED FILES
    ========================================================= */

    .material-selected-header {
        display: none;
        align-items: center;
        justify-content: space-between;
        margin: 15px 0 9px;
    }

    .material-selected-header.is-visible {
        display: flex;
    }

    .material-selected-heading {
        color: var(--m-text-2);
        font-size: 12px;
        font-weight: 800;
    }

    .material-selected-count {
        min-width: 22px;
        height: 22px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 0 7px;
        border-radius: 999px;
        background: var(--m-blue-soft);
        color: var(--m-blue-dark);
        font-size: 10px;
        font-weight: 800;
    }

    .material-file-list {
        display: flex;
        flex-direction: column;
        gap: 8px;
    }

    .material-file-item {
        display: flex;
        align-items: center;
        gap: 10px;
        min-width: 0;
        padding: 10px 11px;
        border: 1px solid var(--m-border);
        border-radius: 10px;
        background: #fff;
        animation: materialFileIn .18s ease;
    }

    @keyframes materialFileIn {
        from { opacity: 0; transform: translateY(-3px); }
        to { opacity: 1; transform: none; }
    }

    .material-file-icon {
        width: 32px;
        height: 32px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        flex: 0 0 32px;
        border-radius: 8px;
        background: var(--m-blue-soft);
        color: var(--m-blue);
        font-size: 16px;
    }

    .material-file-info {
        min-width: 0;
        flex: 1;
    }

    .material-file-name {
        display: block;
        overflow: hidden;
        color: var(--m-text-2);
        font-size: 12px;
        font-weight: 650;
        text-overflow: ellipsis;
        white-space: nowrap;
    }

    .material-file-size {
        display: block;
        margin-top: 2px;
        color: var(--m-light);
        font-size: 10px;
    }

    .material-file-remove {
        width: 29px;
        height: 29px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        flex: 0 0 29px;
        border: 0;
        border-radius: 8px;
        background: var(--m-danger-soft);
        color: var(--m-danger);
        cursor: pointer;
        transition: .18s ease;
    }

    .material-file-remove:hover {
        background: #fee2e2;
    }

    /* =========================================================
       SIDEBAR
    ========================================================= */

    .material-sidebar-card {
        position: sticky;
        top: 20px;
        overflow: hidden;
        border: 1px solid var(--m-border);
        border-radius: 18px;
        background: #fff;
        box-shadow: var(--m-shadow);
    }

    .material-sidebar-header {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 19px 18px;
        border-bottom: 1px solid var(--m-border-light);
    }

    .material-sidebar-header-icon {
        width: 35px;
        height: 35px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        flex: 0 0 35px;
        border-radius: 9px;
        background: var(--m-blue-soft);
        color: var(--m-blue);
        font-size: 17px;
    }

    .material-sidebar-header h3 {
        margin: 0;
        color: var(--m-text);
        font-size: 14px;
        font-weight: 800;
    }

    .material-sidebar-header p {
        margin: 3px 0 0;
        color: var(--m-light);
        font-size: 10px;
    }

    .material-sidebar-body {
        padding: 8px 18px 17px;
    }

    .material-summary-row {
        display: grid;
        grid-template-columns: 82px minmax(0, 1fr);
        gap: 12px;
        padding: 13px 0;
        border-bottom: 1px solid #f1f5f9;
    }

    .material-summary-label {
        color: var(--m-muted);
        font-size: 10px;
    }

    .material-summary-value {
        min-width: 0;
        overflow-wrap: anywhere;
        color: var(--m-text-2);
        font-size: 11px;
        line-height: 1.45;
        font-weight: 750;
        text-align: right;
    }

    .material-summary-value.is-material {
        color: var(--m-blue-dark);
    }

    .material-sidebar-help {
        margin: 0 18px 17px;
        padding: 13px;
        border: 1px solid var(--m-blue-border);
        border-radius: 10px;
        background: var(--m-blue-soft);
    }

    .material-sidebar-help-title {
        display: flex;
        align-items: center;
        gap: 6px;
        margin-bottom: 7px;
        color: #1e40af;
        font-size: 11px;
        font-weight: 800;
    }

    .material-sidebar-help ul {
        margin: 0;
        padding-left: 17px;
        color: #475569;
        font-size: 10px;
        line-height: 1.65;
    }

    .material-sidebar-help li::marker {
        color: var(--m-blue);
    }

    .material-actions {
        display: grid;
        grid-template-columns: 1fr 1.25fr;
        gap: 9px;
        padding: 16px 18px 18px;
        border-top: 1px solid var(--m-border-light);
        background: #fcfdff;
    }

    .material-cancel-btn,
    .material-submit-btn {
        min-width: 0;
        height: 43px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 7px;
        border-radius: 10px;
        font-family: inherit;
        font-size: 12px;
        font-weight: 800;
        text-decoration: none;
        cursor: pointer;
        transition: .18s ease;
    }

    .material-cancel-btn {
        border: 1px solid #cbd5e1;
        background: #fff;
        color: var(--m-text-2);
    }

    .material-cancel-btn:hover {
        border-color: #94a3b8;
        background: var(--m-soft);
    }

    .material-submit-btn {
        border: 1px solid var(--m-blue);
        background: var(--m-blue);
        color: #fff;
        box-shadow: 0 5px 12px rgba(37, 99, 235, .16);
    }

    .material-submit-btn:hover {
        border-color: var(--m-blue-dark);
        background: var(--m-blue-dark);
        transform: translateY(-1px);
    }

    .material-create-page button:focus-visible,
    .material-create-page a:focus-visible,
    .material-create-page input:focus-visible,
    .material-create-page select:focus-visible,
    .material-create-page textarea:focus-visible {
        outline: 3px solid rgba(37, 99, 235, .14);
        outline-offset: 2px;
    }

    /* =========================================================
       RESPONSIVE
    ========================================================= */

    @media (max-width: 1000px) {
        .material-create-layout {
            grid-template-columns: minmax(0, 1fr) 280px;
        }

        .material-header-title {
            font-size: 27px;
        }
    }

    @media (max-width: 820px) {
        .material-create-layout {
            grid-template-columns: 1fr;
        }

        .material-sidebar-card {
            position: static;
        }
    }

    @media (max-width: 620px) {
        .material-create-page {
            padding: 20px 14px 42px;
        }

        .material-header-inner {
            display: block;
        }

        .material-header-badge {
            display: none;
        }

        .material-back-btn {
            width: 39px;
            height: 39px;
            flex-basis: 39px;
        }

        .material-title-mark {
            width: 5px;
            height: 28px;
            flex-basis: 5px;
        }

        .material-header-title {
            font-size: 24px;
        }

        .material-header-subtitle {
            margin-left: 15px;
            font-size: 12px;
        }

        .material-section {
            margin-bottom: 14px;
            border-radius: 14px;
        }

        .material-section-header {
            padding: 16px;
        }

        .material-section-body {
            padding: 17px;
        }

        .material-section-icon {
            width: 35px;
            height: 35px;
            flex-basis: 35px;
            font-size: 17px;
        }

        .material-section-heading h2 {
            font-size: 14px;
        }

        .material-section-heading p {
            font-size: 11px;
        }

        .material-form-row {
            grid-template-columns: 1fr;
            gap: 0;
        }

        .material-form-row .material-form-group {
            margin-bottom: 20px;
        }

        .material-form-row .material-form-group:last-child {
            margin-bottom: 0;
        }

        .material-actions {
            grid-template-columns: 1fr;
        }

        .material-summary-row {
            grid-template-columns: 76px minmax(0, 1fr);
        }

        .material-upload-area {
            padding: 22px 15px;
        }
    }

    /* =========================================================
       DARK MODE
    ========================================================= */

    .dark-mode .material-create-page {
        --m-blue: #6ea1ff;
        --m-blue-dark: #8ab4ff;
        --m-blue-soft: rgba(110, 161, 255, .12);
        --m-blue-border: rgba(110, 161, 255, .34);
        --m-text: #f4f5ff;
        --m-text-2: #e6e8f7;
        --m-muted: #a1a4cc;
        --m-light: #9295bd;
        --m-border: #2b2e52;
        --m-border-light: #252847;
        --m-surface: #171933;
        --m-soft: #1c1e3a;
        --m-danger: #ff8d8d;
        --m-danger-soft: rgba(255, 141, 141, .12);
        --m-shadow: 0 8px 28px rgba(0, 0, 10, .28);
        --m-small-shadow: 0 2px 10px rgba(0, 0, 10, .20);
        color-scheme: dark;
    }

    .dark-mode .material-create-page .material-section,
    .dark-mode .material-create-page .material-sidebar-card {
        background: var(--m-surface);
        border-color: var(--m-border);
        box-shadow: var(--m-shadow);
    }

    .dark-mode .material-create-page .material-back-btn {
        border-color: var(--m-border);
        background: var(--m-surface);
        color: var(--m-light);
        box-shadow: var(--m-small-shadow);
    }

    .dark-mode .material-create-page .material-back-btn:hover {
        color: var(--m-blue-dark);
        border-color: var(--m-blue-border);
        background: var(--m-blue-soft);
    }

    .dark-mode .material-create-page .material-header-label,
    .dark-mode .material-create-page .material-header-subtitle,
    .dark-mode .material-create-page .material-section-heading p,
    .dark-mode .material-create-page .material-help,
    .dark-mode .material-create-page .material-sidebar-header p,
    .dark-mode .material-create-page .material-summary-label,
    .dark-mode .material-create-page .material-upload-subtitle,
    .dark-mode .material-create-page .material-file-size {
        color: var(--m-muted);
    }

    .dark-mode .material-create-page .material-header-title,
    .dark-mode .material-create-page .material-section-heading h2,
    .dark-mode .material-create-page .material-sidebar-header h3 {
        color: var(--m-text);
    }

    .dark-mode .material-create-page .material-section-header,
    .dark-mode .material-create-page .material-sidebar-header {
        border-color: var(--m-border-light);
    }

    .dark-mode .material-create-page .material-input,
    .dark-mode .material-create-page .material-select,
    .dark-mode .material-create-page .material-textarea {
        border-color: #3a3e68;
        background: #12142a;
        color: var(--m-text);
    }

    .dark-mode .material-create-page .material-input::placeholder,
    .dark-mode .material-create-page .material-textarea::placeholder {
        color: #6f72a0;
    }

    .dark-mode .material-create-page .material-input:hover,
    .dark-mode .material-create-page .material-select:hover,
    .dark-mode .material-create-page .material-textarea:hover {
        border-color: #565b8d;
    }

    .dark-mode .material-create-page .material-input:focus,
    .dark-mode .material-create-page .material-select:focus,
    .dark-mode .material-create-page .material-textarea:focus {
        border-color: var(--m-blue);
        box-shadow: 0 0 0 3px rgba(110, 161, 255, .16);
    }

    .dark-mode .material-create-page .material-field-label,
    .dark-mode .material-create-page .material-selected-heading {
        color: var(--m-text-2);
    }

    .dark-mode .material-create-page .material-optional {
        background: #242648;
        color: var(--m-light);
    }

    .dark-mode .material-create-page .material-upload-area {
        border-color: var(--m-blue-border);
        background: var(--m-blue-soft);
    }

    .dark-mode .material-create-page .material-upload-area:hover,
    .dark-mode .material-create-page .material-upload-area.is-dragging {
        border-color: var(--m-blue);
        background: rgba(110, 161, 255, .17);
    }

    .dark-mode .material-create-page .material-upload-icon,
    .dark-mode .material-create-page .material-upload-button {
        border-color: var(--m-blue-border);
        background: #171933;
        color: var(--m-blue-dark);
        box-shadow: var(--m-small-shadow);
    }

    .dark-mode .material-create-page .material-upload-title,
    .dark-mode .material-create-page .material-file-name {
        color: var(--m-text-2);
    }

    .dark-mode .material-create-page .material-selected-count,
    .dark-mode .material-create-page .material-file-icon {
        background: var(--m-blue-soft);
        color: var(--m-blue);
    }

    .dark-mode .material-create-page .material-file-item {
        border-color: var(--m-border);
        background: #12142a;
    }

    .dark-mode .material-create-page .material-sidebar-help {
        border-color: var(--m-blue-border);
        background: rgba(110, 161, 255, .08);
    }

    .dark-mode .material-create-page .material-sidebar-help-title {
        color: var(--m-blue-dark);
    }

    .dark-mode .material-create-page .material-sidebar-help ul {
        color: #a1a4cc;
    }

    .dark-mode .material-create-page .material-actions {
        border-color: var(--m-border-light);
        background: #12142a;
    }

    .dark-mode .material-create-page .material-cancel-btn {
        border-color: #3a3e68;
        background: #171933;
        color: var(--m-text-2);
    }

    .dark-mode .material-create-page .material-cancel-btn:hover {
        border-color: #565b8d;
        background: #1c1e3a;
    }

    .dark-mode .material-create-page .material-submit-btn {
        border-color: var(--m-blue);
        background: var(--m-blue);
        color: #09152c;
        box-shadow: 0 5px 14px rgba(110, 161, 255, .14);
    }

    .dark-mode .material-create-page .material-submit-btn:hover {
        border-color: var(--m-blue-dark);
        background: var(--m-blue-dark);
    }
</style>

<div class="material-create-page">

    {{-- ============================================================
         PAGE HEADER
    ============================================================= --}}

    <header class="material-create-header">
        <div class="material-header-inner">

            <div class="material-header-main">

                <a
                    href="{{ route(
                        'professor.class-groups.classroom-group.classwork',
                        ['classGroup' => $classGroup->id]
                    ) }}"
                    class="material-back-btn"
                    title="Back to Classwork"
                >
                    <i class="bx bx-arrow-back"></i>
                </a>

                <div>
                    <span class="material-header-label">
                        {{ $classGroup->group_name }}
                    </span>

                    <div class="material-title-row">
                        <span class="material-title-mark"></span>
                        <h1 class="material-header-title">
                            Create Material
                        </h1>
                    </div>

                    <p class="material-header-subtitle">
                        Share learning materials and resources with your students.
                    </p>
                </div>

            </div>

            <span class="material-header-badge">
                <i class="bx bx-book-open"></i>
                Material
            </span>

        </div>
    </header>


    <div class="material-create-layout">

        <main class="material-create-main">

            <form
                id="material-create-form"
                action="{{ route(
                    'professor.class-groups.materials.store',
                    $classGroup
                ) }}"
                method="POST"
                enctype="multipart/form-data"
            >

                @csrf

                <input
                    type="hidden"
                    name="return_to"
                    value="{{ request('return_to', 'stream') }}"
                >

                {{-- ====================================================
                     MATERIAL DETAILS
                ===================================================== --}}

                <section class="material-section">

                    <div class="material-section-header">
                        <div class="material-section-icon">
                            <i class="bx bx-file-blank"></i>
                        </div>

                        <div class="material-section-heading">
                            <h2>Material Details</h2>
                            <p>Set the title, topic, and description for your resource.</p>
                        </div>
                    </div>

                    <div class="material-section-body">

                        <div class="material-form-group">
                            <label class="material-field-label" for="title">
                                Material Title
                                <span class="material-required">*</span>
                            </label>

                            <input
                                class="material-input"
                                type="text"
                                id="title"
                                name="title"
                                value="{{ old('title') }}"
                                placeholder="e.g. Database Design Lecture"
                                maxlength="255"
                                required
                            >

                            @error('title')
                                <div class="material-error">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="material-form-group">
                            <label class="material-field-label" for="topic_id">
                                Topic
                                <span class="material-optional">Optional</span>
                            </label>

                            <select
                                class="material-select"
                                id="topic_id"
                                name="topic_id"
                            >
                                <option value="">No Topic</option>

                                @foreach($topics as $topic)
                                    <option
                                        value="{{ $topic->id }}"
                                        {{ old('topic_id') == $topic->id ? 'selected' : '' }}
                                    >
                                        {{ $topic->topic_name }}
                                    </option>
                                @endforeach
                            </select>

                            <span class="material-help">
                                <i class="bx bx-info-circle"></i>
                                Organize this material under one of your classroom topics.
                            </span>

                            @error('topic_id')
                                <div class="material-error">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="material-form-group">
                            <label class="material-field-label" for="description">
                                Description
                                <span class="material-optional">Optional</span>
                            </label>

                            <textarea
                                class="material-textarea"
                                id="description"
                                name="description"
                                placeholder="Add notes or instructions for your students..."
                            >{{ old('description') }}</textarea>

                            @error('description')
                                <div class="material-error">{{ $message }}</div>
                            @enderror
                        </div>

                    </div>
                </section>


                {{-- ====================================================
                     FILES
                ===================================================== --}}

                <section class="material-section">

                    <div class="material-section-header">
                        <div class="material-section-icon">
                            <i class="bx bx-paperclip"></i>
                        </div>

                        <div class="material-section-heading">
                            <h2>Material Files</h2>
                            <p>Upload one or more documents, images, videos, or other resources.</p>
                        </div>
                    </div>

                    <div class="material-section-body">

                        <label class="material-upload-area" for="files">

                            <div class="material-upload-icon">
                                <i class="bx bx-cloud-upload"></i>
                            </div>

                            <strong class="material-upload-title">
                                Select files to upload
                            </strong>

                            <span class="material-upload-subtitle">
                                Choose multiple learning materials at once.
                                Maximum 50 MB per file.
                            </span>

                            <span class="material-upload-button">
                                <i class="bx bx-folder-open"></i>
                                Choose Files
                            </span>

                            <input
                                class="material-upload-input"
                                type="file"
                                id="files"
                                name="files[]"
                                multiple
                                required
                            >

                        </label>

                        <div
                            id="selectedFiles"
                            class="material-selected-files"
                        >
                            <div
                                id="selectedFilesHeader"
                                class="material-selected-header"
                            >
                                <span class="material-selected-heading">
                                    Selected Files
                                </span>

                                <span
                                    id="selectedFilesCount"
                                    class="material-selected-count"
                                >
                                    0
                                </span>
                            </div>

                            <div
                                id="selectedFileList"
                                class="material-file-list"
                            ></div>
                        </div>

                        @error('files')
                            <div class="material-error">{{ $message }}</div>
                        @enderror

                        @error('files.*')
                            <div class="material-error">{{ $message }}</div>
                        @enderror

                        <small class="material-help" style="margin-top: 12px;">
                            <i class="bx bx-info-circle"></i>
                            Maximum 10 files, 50 MB per file.
                        </small>

                    </div>
                </section>

            </form>

        </main>


        {{-- ====================================================
             SIDEBAR
        ===================================================== --}}

        <aside class="material-create-sidebar">

            <div class="material-sidebar-card">

                <div class="material-sidebar-header">

                    <div class="material-sidebar-header-icon">
                        <i class="bx bx-book-open"></i>
                    </div>

                    <div>
                        <h3>Material Summary</h3>
                        <p>Review the important information before uploading.</p>
                    </div>

                </div>

                <div class="material-sidebar-body">

                    <div class="material-summary-row">
                        <span class="material-summary-label">Class</span>
                        <span class="material-summary-value">
                            {{ $classGroup->group_name }}
                        </span>
                    </div>

                    <div class="material-summary-row">
                        <span class="material-summary-label">Topic</span>
                        <span class="material-summary-value">
                            Select in form
                        </span>
                    </div>

                    <div class="material-summary-row">
                        <span class="material-summary-label">Files</span>
                        <span
                            id="material-sidebar-file-count"
                            class="material-summary-value is-material"
                        >
                            0 files
                        </span>
                    </div>

                </div>

                <div class="material-sidebar-help">

                    <div class="material-sidebar-help-title">
                        <i class="bx bx-info-circle"></i>
                        Before uploading
                    </div>

                    <ul>
                        <li>Give the material a clear title.</li>
                        <li>Choose a topic when needed.</li>
                        <li>Add a short description for students.</li>
                        <li>Check your files before uploading.</li>
                    </ul>

                </div>

                <div class="material-actions">

                    <a
                        href="{{ route(
                            'professor.class-groups.classroom-group.classwork',
                            ['classGroup' => $classGroup->id]
                        ) }}"
                        class="material-cancel-btn"
                    >
                        Cancel
                    </a>

                    <button
                        type="submit"
                        form="material-create-form"
                        class="material-submit-btn"
                    >
                        <i class="bx bx-upload"></i>
                        Upload Material
                    </button>

                </div>

            </div>

        </aside>

    </div>

</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {

        const fileInput = document.getElementById('files');
        const selectedFiles = document.getElementById('selectedFiles');
        const selectedHeader = document.getElementById('selectedFilesHeader');
        const selectedFileList = document.getElementById('selectedFileList');
        const selectedFilesCount = document.getElementById('selectedFilesCount');
        const sidebarFileCount = document.getElementById('material-sidebar-file-count');
        const uploadArea = document.querySelector('.material-upload-area');

        if (!fileInput || !selectedFiles || !selectedFileList || !selectedFilesCount) {
            return;
        }

        let selectedFilesArray = [];

        fileInput.addEventListener('change', function () {
            const newFiles = Array.from(this.files);

            newFiles.forEach(function (file) {
                const duplicate = selectedFilesArray.some(function (existingFile) {
                    return existingFile.name === file.name &&
                        existingFile.size === file.size &&
                        existingFile.lastModified === file.lastModified;
                });

                if (!duplicate) {
                    selectedFilesArray.push(file);
                }
            });

            updateFileInput();
            renderSelectedFiles();
        });

        if (uploadArea && fileInput) {
            ['dragenter', 'dragover'].forEach(function (eventName) {
                uploadArea.addEventListener(eventName, function (event) {
                    event.preventDefault();
                    event.stopPropagation();
                    uploadArea.classList.add('is-dragging');
                });
            });

            ['dragleave', 'drop'].forEach(function (eventName) {
                uploadArea.addEventListener(eventName, function (event) {
                    event.preventDefault();
                    event.stopPropagation();
                    uploadArea.classList.remove('is-dragging');
                });
            });

            uploadArea.addEventListener('drop', function (event) {
                Array.from(event.dataTransfer.files).forEach(function (file) {
                    const duplicate = selectedFilesArray.some(function (existingFile) {
                        return existingFile.name === file.name &&
                            existingFile.size === file.size &&
                            existingFile.lastModified === file.lastModified;
                    });

                    if (!duplicate) {
                        selectedFilesArray.push(file);
                    }
                });

                updateFileInput();
                renderSelectedFiles();
            });
        }

        function updateFileInput() {
            const dataTransfer = new DataTransfer();

            selectedFilesArray.forEach(function (file) {
                dataTransfer.items.add(file);
            });

            fileInput.files = dataTransfer.files;
        }

        function renderSelectedFiles() {
            selectedFileList.innerHTML = '';

            if (selectedFilesArray.length === 0) {
                if (selectedHeader) {
                    selectedHeader.classList.remove('is-visible');
                }

                selectedFilesCount.textContent = '0';

                if (sidebarFileCount) {
                    sidebarFileCount.textContent = '0 files';
                }

                return;
            }

            if (selectedHeader) {
                selectedHeader.classList.add('is-visible');
            }

            selectedFilesCount.textContent = selectedFilesArray.length;

            if (sidebarFileCount) {
                sidebarFileCount.textContent =
                    selectedFilesArray.length +
                    (selectedFilesArray.length === 1 ? ' file' : ' files');
            }

            selectedFilesArray.forEach(function (file, index) {
                const item = document.createElement('div');
                item.className = 'material-file-item';

                const iconContainer = document.createElement('div');
                iconContainer.className = 'material-file-icon';

                const icon = document.createElement('i');
                icon.className = getFileIcon(file.name);
                iconContainer.appendChild(icon);

                const info = document.createElement('div');
                info.className = 'material-file-info';

                const name = document.createElement('span');
                name.className = 'material-file-name';
                name.textContent = file.name;

                const size = document.createElement('small');
                size.className = 'material-file-size';
                size.textContent = formatFileSize(file.size);

                info.appendChild(name);
                info.appendChild(size);

                const removeButton = document.createElement('button');
                removeButton.type = 'button';
                removeButton.className = 'material-file-remove';
                removeButton.title = 'Remove selected file';
                removeButton.setAttribute('aria-label', 'Remove ' + file.name);
                removeButton.innerHTML = '<i class="bx bx-x"></i>';

                removeButton.addEventListener('click', function () {
                    selectedFilesArray.splice(index, 1);
                    updateFileInput();
                    renderSelectedFiles();
                });

                item.appendChild(iconContainer);
                item.appendChild(info);
                item.appendChild(removeButton);

                selectedFileList.appendChild(item);
            });
        }

        function getFileIcon(fileName) {
            const extension = fileName.split('.').pop().toLowerCase();

            if (extension === 'pdf') return 'bx bxs-file-pdf';
            if (extension === 'doc' || extension === 'docx') return 'bx bxs-file-doc';
            if (extension === 'xls' || extension === 'xlsx') return 'bx bxs-file';
            if (extension === 'ppt' || extension === 'pptx') return 'bx bxs-file';
            if (['jpg', 'jpeg', 'png', 'gif', 'webp'].includes(extension)) return 'bx bxs-image';
            if (['mp4', 'mov', 'avi', 'mkv'].includes(extension)) return 'bx bxs-video';
            if (['mp3', 'wav', 'm4a'].includes(extension)) return 'bx bxs-music';
            if (['zip', 'rar', '7z'].includes(extension)) return 'bx bxs-file-archive';

            return 'bx bxs-file';
        }

        function formatFileSize(bytes) {
            if (bytes === 0) return '0 Bytes';

            const units = ['Bytes', 'KB', 'MB', 'GB'];
            const index = Math.floor(Math.log(bytes) / Math.log(1024));

            return (
                bytes / Math.pow(1024, index)
            ).toFixed(2) + ' ' + units[index];
        }
    });
</script>

@endsection
