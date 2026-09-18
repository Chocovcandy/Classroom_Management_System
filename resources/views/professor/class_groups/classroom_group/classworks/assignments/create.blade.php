@extends('layouts.prof_layout')

@section('title', 'Create Assignment')

@section('content')

<style>
    :root {
        --a-green: #16a34a;
        --a-green-dark: #15803d;
        --a-green-soft: #f0fdf4;
        --a-green-border: #bbf7d0;
        --blue: #2563eb;
        --blue-dark: #1d4ed8;
        --blue-soft: #eff6ff;
        --blue-border: #bfdbfe;
        --text: #0f172a;
        --text-2: #334155;
        --muted: #64748b;
        --light: #94a3b8;
        --border: #e2e8f0;
        --border-light: #edf2f7;
        --surface: #fff;
        --soft: #f8fafc;
        --danger: #dc2626;
        --danger-soft: #fef2f2;
        --danger-border: #fecaca;
        --shadow: 0 6px 24px rgba(15, 23, 42, .055);
        --small-shadow: 0 2px 8px rgba(15, 23, 42, .045);
    }

    .assignment-create-page {
        width: 100%;
        max-width: 1240px;
        margin: 0 auto;
        padding: 30px 26px 60px
    }

    .assignment-create-page *,
    .assignment-create-page *:before,
    .assignment-create-page *:after {
        box-sizing: border-box
    }

    .assignment-create-header {
        margin-bottom: 24px
    }

    .assignment-header-inner {
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        gap: 24px
    }

    .assignment-header-main {
        display: flex;
        align-items: flex-start;
        gap: 14px;
        min-width: 0
    }

    .assignment-back-btn {
        width: 42px;
        height: 42px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        flex: 0 0 42px;
        border: 1px solid var(--border);
        border-radius: 11px;
        background: #fff;
        color: var(--muted);
        text-decoration: none;
        box-shadow: var(--small-shadow);
        transition: .18s
    }

    .assignment-back-btn:hover {
        color: var(--blue-dark);
        border-color: var(--blue-border);
        background: var(--blue-soft);
        transform: translateX(-2px)
    }

    .assignment-header-label {
        display: block;
        margin-bottom: 7px;
        color: var(--muted);
        font-size: 11px;
        font-weight: 800;
        letter-spacing: .14em;
        text-transform: uppercase
    }

    .assignment-title-row {
        display: flex;
        align-items: center;
        gap: 10px
    }

    .assignment-title-mark {
        width: 7px;
        height: 34px;
        flex: 0 0 7px;
        border-radius: 999px;
        background: var(--a-green)
    }

    .assignment-header-title {
        margin: 0;
        color: var(--text);
        font-size: 30px;
        line-height: 1.15;
        font-weight: 800;
        letter-spacing: -.035em
    }

    .assignment-header-subtitle {
        margin: 8px 0 0 17px;
        color: var(--muted);
        font-size: 14px;
        line-height: 1.5
    }

    .assignment-header-badge {
        display: inline-flex;
        align-items: center;
        gap: 7px;
        flex: 0 0 auto;
        padding: 8px 12px;
        border: 1px solid var(--a-green-border);
        border-radius: 999px;
        background: var(--a-green-soft);
        color: var(--a-green-dark);
        font-size: 11px;
        font-weight: 800
    }

    .assignment-create-layout {
        display: grid;
        grid-template-columns: minmax(0, 1fr) 315px;
        align-items: start;
        gap: 22px
    }

    .assignment-create-main,
    .assignment-create-sidebar {
        min-width: 0
    }

    .assignment-section {
        overflow: hidden;
        margin-bottom: 18px;
        border: 1px solid var(--border);
        border-radius: 18px;
        background: #fff;
        box-shadow: var(--shadow)
    }

    .assignment-section-header {
        display: flex;
        align-items: center;
        gap: 13px;
        padding: 19px 22px;
        border-bottom: 1px solid var(--border-light)
    }

    .assignment-section-icon {
        width: 40px;
        height: 40px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        flex: 0 0 40px;
        border: 1px solid var(--a-green-border);
        border-radius: 11px;
        background: var(--a-green-soft);
        color: var(--a-green);
        font-size: 20px
    }

    .assignment-section-heading {
        min-width: 0
    }

    .assignment-section-heading h2 {
        margin: 0;
        color: var(--text);
        font-size: 16px;
        line-height: 1.25;
        font-weight: 800
    }

    .assignment-section-heading p {
        margin: 4px 0 0;
        color: var(--muted);
        font-size: 12px;
        line-height: 1.45
    }

    .assignment-section-body {
        padding: 23px
    }

    .assignment-form-group {
        margin: 0 0 20px
    }

    .assignment-form-group:last-child {
        margin-bottom: 0
    }

    .assignment-form-row {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 16px
    }

    .assignment-field-label {
        display: flex;
        align-items: center;
        flex-wrap: wrap;
        gap: 6px;
        margin: 0 0 8px;
        color: var(--text-2);
        font-size: 13px;
        font-weight: 750
    }

    .assignment-required {
        color: #ef4444
    }

    .assignment-optional {
        padding: 2px 6px;
        border-radius: 5px;
        background: var(--soft);
        color: var(--light);
        font-size: 10px;
        font-weight: 700
    }

    .assignment-input,
    .assignment-select,
    .assignment-textarea {
        width: 100%;
        border: 1px solid #cbd5e1;
        border-radius: 11px;
        outline: none;
        background: #fff;
        color: var(--text);
        font-family: inherit;
        font-size: 14px;
        transition: .18s
    }

    .assignment-input,
    .assignment-select {
        height: 45px;
        padding: 0 13px
    }

    .assignment-textarea {
        min-height: 155px;
        padding: 13px;
        resize: vertical;
        line-height: 1.6
    }

    .assignment-input::placeholder,
    .assignment-textarea::placeholder {
        color: #a8b3c2
    }

    .assignment-input:hover,
    .assignment-select:hover,
    .assignment-textarea:hover {
        border-color: #94a3b8
    }

    .assignment-input:focus,
    .assignment-select:focus,
    .assignment-textarea:focus {
        border-color: #60a5fa;
        box-shadow: 0 0 0 3px rgba(59, 130, 246, .11)
    }

    .assignment-help {
        display: flex;
        gap: 5px;
        margin-top: 7px;
        color: var(--light);
        font-size: 11px;
        line-height: 1.5
    }

    .assignment-help i {
        color: var(--blue);
        font-size: 14px
    }

    .assignment-error {
        display: flex;
        gap: 6px;
        margin-top: 7px;
        color: var(--danger);
        font-size: 12px;
        line-height: 1.45;
        font-weight: 600
    }

    .assignment-error:before {
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
        font-weight: 800
    }

    .assignment-points-wrap {
        display: flex
    }

    .assignment-points-wrap .assignment-input {
        border-radius: 11px 0 0 11px
    }

    .assignment-points-unit {
        min-width: 65px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 0 12px;
        border: 1px solid #cbd5e1;
        border-left: 0;
        border-radius: 0 11px 11px 0;
        background: var(--soft);
        color: var(--muted);
        font-size: 12px;
        font-weight: 750
    }

    .assignment-google-box {
        padding: 16px;
        border: 1px solid var(--blue-border);
        border-radius: 13px;
        background: #f8fbff
    }

    .assignment-google-heading {
        display: flex;
        align-items: center;
        gap: 10px;
        margin-bottom: 13px
    }

    .assignment-google-icon {
        width: 35px;
        height: 35px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        flex: 0 0 35px;
        border-radius: 9px;
        background: #fff;
        color: var(--blue);
        box-shadow: var(--small-shadow);
        font-size: 18px
    }

    .assignment-google-heading strong {
        display: block;
        color: var(--text-2);
        font-size: 13px;
        font-weight: 800
    }

    .assignment-google-heading span {
        display: block;
        margin-top: 2px;
        color: var(--light);
        font-size: 10px;
        line-height: 1.4
    }

.assignment-upload-area{
    display:block;
    width:100%;
    position:relative;
    padding:25px 20px;
        border: 1.5px dashed var(--a-green-border);
        border-radius: 14px;
        background: var(--a-green-soft);
        text-align: center;
        cursor: pointer;
        transition: .18s
    }

    .assignment-upload-area:hover,
    .assignment-upload-area.is-dragging {
        border-color: var(--a-green);
        background: #ecfdf5;
        transform: translateY(-1px)
    }

    .assignment-upload-icon {
        width: 48px;
        height: 48px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 10px;
        border: 1px solid var(--a-green-border);
        border-radius: 13px;
        background: #fff;
        color: var(--a-green);
        box-shadow: var(--small-shadow);
        font-size: 22px
    }

    .assignment-upload-title {
        display: block;
        color: var(--text-2);
        font-size: 13px;
        font-weight: 800
    }

    .assignment-upload-subtitle {
        display: block;
        max-width: 500px;
        margin: 5px auto 0;
        color: var(--light);
        font-size: 11px;
        line-height: 1.5
    }

    .assignment-upload-button {
        height: 34px;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        margin-top: 13px;
        padding: 0 12px;
        border: 1px solid var(--a-green-border);
        border-radius: 8px;
        background: #fff;
        color: var(--a-green-dark);
        font-size: 11px;
        font-weight: 750;
        pointer-events: none
    }

    .assignment-upload-input {
        position: absolute;
        width: 1px;
        height: 1px;
        opacity: 0;
        pointer-events: none
    }

    .assignment-selected-header {
        display: none;
        align-items: center;
        justify-content: space-between;
        margin: 15px 0 9px
    }

    .assignment-selected-header.is-visible {
        display: flex
    }

    .assignment-selected-heading {
        color: var(--text-2);
        font-size: 12px;
        font-weight: 800
    }

    .assignment-selected-count {
        min-width: 22px;
        height: 22px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 0 7px;
        border-radius: 999px;
        background: var(--a-green-soft);
        color: var(--a-green-dark);
        font-size: 10px;
        font-weight: 800
    }

    .assignment-file-list {
        display: flex;
        flex-direction: column;
        gap: 8px
    }

    .assignment-file-item {
        display: flex;
        align-items: center;
        gap: 10px;
        min-width: 0;
        padding: 10px 11px;
        border: 1px solid var(--border);
        border-radius: 10px;
        background: #fff;
        animation: fileIn .18s ease
    }

    @keyframes fileIn {
        from {
            opacity: 0;
            transform: translateY(-3px)
        }

        to {
            opacity: 1;
            transform: none
        }
    }

    .assignment-file-icon {
        width: 32px;
        height: 32px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        flex: 0 0 32px;
        border-radius: 8px;
        background: var(--a-green-soft);
        color: var(--a-green);
        font-size: 16px
    }

    .assignment-file-info {
        min-width: 0;
        flex: 1
    }

    .assignment-file-name {
        display: block;
        overflow: hidden;
        color: var(--text-2);
        font-size: 12px;
        font-weight: 650;
        text-overflow: ellipsis;
        white-space: nowrap
    }

    .assignment-file-size {
        display: block;
        margin-top: 2px;
        color: var(--light);
        font-size: 10px
    }

    .assignment-file-remove {
        width: 29px;
        height: 29px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        flex: 0 0 29px;
        border: 0;
        border-radius: 8px;
        background: var(--danger-soft);
        color: var(--danger);
        cursor: pointer;
        transition: .18s
    }

    .assignment-file-remove:hover {
        background: #fee2e2
    }

    .assignment-sidebar-card {
        position: sticky;
        top: 20px;
        overflow: hidden;
        border: 1px solid var(--border);
        border-radius: 18px;
        background: #fff;
        box-shadow: var(--shadow)
    }

    .assignment-sidebar-header {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 19px 18px;
        border-bottom: 1px solid var(--border-light)
    }

    .assignment-sidebar-header-icon {
        width: 35px;
        height: 35px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        flex: 0 0 35px;
        border-radius: 9px;
        background: var(--a-green-soft);
        color: var(--a-green);
        font-size: 17px
    }

    .assignment-sidebar-header h3 {
        margin: 0;
        color: var(--text);
        font-size: 14px;
        font-weight: 800
    }

    .assignment-sidebar-header p {
        margin: 3px 0 0;
        color: var(--light);
        font-size: 10px
    }

    .assignment-sidebar-body {
        padding: 8px 18px 17px
    }

    .assignment-summary-row {
        display: grid;
        grid-template-columns: 82px minmax(0, 1fr);
        gap: 12px;
        padding: 13px 0;
        border-bottom: 1px solid #f1f5f9
    }

    .assignment-summary-label {
        color: var(--muted);
        font-size: 10px
    }

    .assignment-summary-value {
        min-width: 0;
        overflow-wrap: anywhere;
        color: var(--text-2);
        font-size: 11px;
        line-height: 1.45;
        font-weight: 750;
        text-align: right
    }

    .assignment-summary-value.is-assignment {
        color: var(--a-green-dark)
    }

    .assignment-sidebar-help {
        margin: 0 18px 17px;
        padding: 13px;
        border: 1px solid var(--blue-border);
        border-radius: 10px;
        background: var(--blue-soft)
    }

    .assignment-sidebar-help-title {
        display: flex;
        align-items: center;
        gap: 6px;
        margin-bottom: 7px;
        color: #1e40af;
        font-size: 11px;
        font-weight: 800
    }

    .assignment-sidebar-help ul {
        margin: 0;
        padding-left: 17px;
        color: #475569;
        font-size: 10px;
        line-height: 1.65
    }

    .assignment-sidebar-help li::marker {
        color: var(--blue)
    }

    .assignment-actions {
        display: grid;
        grid-template-columns: 1fr 1.25fr;
        gap: 9px;
        padding: 16px 18px 18px;
        border-top: 1px solid var(--border-light);
        background: #fcfdff
    }

    .assignment-cancel-btn,
    .assignment-submit-btn {
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
        transition: .18s
    }

    .assignment-cancel-btn {
        border: 1px solid #cbd5e1;
        background: #fff;
        color: var(--text-2)
    }

    .assignment-cancel-btn:hover {
        border-color: #94a3b8;
        background: var(--soft)
    }

    .assignment-submit-btn {
        border: 1px solid var(--a-green);
        background: var(--a-green);
        color: #fff;
        box-shadow: 0 5px 12px rgba(22, 163, 74, .16)
    }

    .assignment-submit-btn:hover {
        border-color: var(--a-green-dark);
        background: var(--a-green-dark);
        transform: translateY(-1px)
    }

    .assignment-create-page button:focus-visible,
    .assignment-create-page a:focus-visible,
    .assignment-create-page input:focus-visible,
    .assignment-create-page select:focus-visible,
    .assignment-create-page textarea:focus-visible {
        outline: 3px solid rgba(37, 99, 235, .14);
        outline-offset: 2px
    }

    @media(max-width:1000px) {
        .assignment-create-layout {
            grid-template-columns: minmax(0, 1fr) 280px
        }

        .assignment-header-title {
            font-size: 27px
        }
    }

    @media(max-width:820px) {
        .assignment-create-layout {
            grid-template-columns: 1fr
        }

        .assignment-sidebar-card {
            position: static
        }
    }

    @media(max-width:620px) {
        .assignment-create-page {
            padding: 20px 14px 42px
        }

        .assignment-header-inner {
            display: block
        }

        .assignment-header-badge {
            display: none
        }

        .assignment-back-btn {
            width: 39px;
            height: 39px;
            flex-basis: 39px
        }

        .assignment-title-mark {
            width: 5px;
            height: 28px;
            flex-basis: 5px
        }

        .assignment-header-title {
            font-size: 24px
        }

        .assignment-header-subtitle {
            margin-left: 15px;
            font-size: 12px
        }

        .assignment-section {
            margin-bottom: 14px;
            border-radius: 14px
        }

        .assignment-section-header {
            padding: 16px
        }

        .assignment-section-body {
            padding: 17px
        }

        .assignment-section-icon {
            width: 35px;
            height: 35px;
            flex-basis: 35px;
            font-size: 17px
        }

        .assignment-section-heading h2 {
            font-size: 14px
        }

        .assignment-section-heading p {
            font-size: 11px
        }

        .assignment-form-row {
            grid-template-columns: 1fr;
            gap: 0
        }

        .assignment-form-row .assignment-form-group {
            margin-bottom: 20px
        }

        .assignment-form-row .assignment-form-group:last-child {
            margin-bottom: 0
        }

        .assignment-actions {
            grid-template-columns: 1fr
        }

        .assignment-summary-row {
            grid-template-columns: 76px minmax(0, 1fr)
        }

        .assignment-upload-area {
            padding: 22px 15px
        }
    }


    /* ============================================================
       DARK MODE
       Uses the existing .dark-mode class from the website theme.
       ============================================================ */

    .dark-mode .assignment-create-page {
        --a-green: #49d5a7;
        --a-green-dark: #62e0b5;
        --a-green-soft: rgba(73, 213, 167, .12);
        --a-green-border: rgba(73, 213, 167, .34);

        --blue: #6d76ff;
        --blue-dark: #8990ff;
        --blue-soft: rgba(109, 118, 255, .12);
        --blue-border: rgba(109, 118, 255, .34);

        --text: #f4f5ff;
        --text-2: #e6e8f7;
        --muted: #a1a4cc;
        --light: #9295bd;

        --border: #2b2e52;
        --border-light: #252847;
        --surface: #171933;
        --soft: #1c1e3a;

        --danger: #ff8d8d;
        --danger-soft: rgba(255, 141, 141, .12);
        --danger-border: rgba(255, 141, 141, .30);

        --shadow: 0 8px 28px rgba(0, 0, 10, .28);
        --small-shadow: 0 2px 10px rgba(0, 0, 10, .20);

        color-scheme: dark;
    }

    .dark-mode .assignment-create-page .assignment-section,
    .dark-mode .assignment-create-page .assignment-sidebar-card {
        background: var(--surface);
        border-color: var(--border);
        box-shadow: var(--shadow);
    }

    .dark-mode .assignment-create-page .assignment-back-btn {
        border-color: var(--border);
        background: var(--surface);
        color: var(--light);
        box-shadow: var(--small-shadow);
    }

    .dark-mode .assignment-create-page .assignment-back-btn:hover {
        color: var(--blue-dark);
        border-color: var(--blue-border);
        background: var(--blue-soft);
    }

    .dark-mode .assignment-create-page .assignment-header-label,
    .dark-mode .assignment-create-page .assignment-header-subtitle,
    .dark-mode .assignment-create-page .assignment-section-heading p,
    .dark-mode .assignment-create-page .assignment-help,
    .dark-mode .assignment-create-page .assignment-sidebar-header p,
    .dark-mode .assignment-create-page .assignment-summary-label,
    .dark-mode .assignment-create-page .assignment-upload-subtitle,
    .dark-mode .assignment-create-page .assignment-file-size {
        color: var(--muted);
    }

    .dark-mode .assignment-create-page .assignment-header-title,
    .dark-mode .assignment-create-page .assignment-section-heading h2,
    .dark-mode .assignment-create-page .assignment-sidebar-header h3 {
        color: var(--text);
    }

    .dark-mode .assignment-create-page .assignment-header-badge {
        border-color: var(--a-green-border);
        background: var(--a-green-soft);
        color: var(--a-green-dark);
    }

    .dark-mode .assignment-create-page .assignment-section-header,
    .dark-mode .assignment-create-page .assignment-sidebar-header {
        border-color: var(--border-light);
    }

    .dark-mode .assignment-create-page .assignment-input,
    .dark-mode .assignment-create-page .assignment-select,
    .dark-mode .assignment-create-page .assignment-textarea {
        border-color: #3a3e68;
        background: #12142a;
        color: var(--text);
    }

    .dark-mode .assignment-create-page .assignment-input::placeholder,
    .dark-mode .assignment-create-page .assignment-textarea::placeholder {
        color: #6f72a0;
    }

    .dark-mode .assignment-create-page .assignment-input:hover,
    .dark-mode .assignment-create-page .assignment-select:hover,
    .dark-mode .assignment-create-page .assignment-textarea:hover {
        border-color: #565b8d;
    }

    .dark-mode .assignment-create-page .assignment-input:focus,
    .dark-mode .assignment-create-page .assignment-select:focus,
    .dark-mode .assignment-create-page .assignment-textarea:focus {
        border-color: var(--blue);
        box-shadow: 0 0 0 3px rgba(109, 118, 255, .16);
    }

    .dark-mode .assignment-create-page .assignment-field-label {
        color: var(--text-2);
    }

    .dark-mode .assignment-create-page .assignment-optional {
        background: #242648;
        color: var(--light);
    }

    .dark-mode .assignment-create-page .assignment-points-unit {
        border-color: #3a3e68;
        background: #1c1e3a;
        color: var(--muted);
    }

    .dark-mode .assignment-create-page .assignment-google-box {
        border-color: var(--blue-border);
        background: rgba(109, 118, 255, .07);
    }

    .dark-mode .assignment-create-page .assignment-google-icon {
        background: #171933;
        color: var(--blue-dark);
        box-shadow: var(--small-shadow);
    }

    .dark-mode .assignment-create-page .assignment-google-heading strong {
        color: var(--text-2);
    }

    .dark-mode .assignment-create-page .assignment-google-heading span {
        color: var(--light);
    }

    .dark-mode .assignment-create-page .assignment-upload-area {
        border-color: var(--a-green-border);
        background: var(--a-green-soft);
    }

    .dark-mode .assignment-create-page .assignment-upload-area:hover,
    .dark-mode .assignment-create-page .assignment-upload-area.is-dragging {
        border-color: var(--a-green);
        background: rgba(73, 213, 167, .17);
    }

    .dark-mode .assignment-create-page .assignment-upload-icon {
        border-color: var(--a-green-border);
        background: #171933;
        color: var(--a-green);
        box-shadow: var(--small-shadow);
    }

    .dark-mode .assignment-create-page .assignment-upload-title {
        color: var(--text-2);
    }

    .dark-mode .assignment-create-page .assignment-upload-button {
        border-color: var(--a-green-border);
        background: #171933;
        color: var(--a-green-dark);
    }

    .dark-mode .assignment-create-page .assignment-selected-heading {
        color: var(--text-2);
    }

    .dark-mode .assignment-create-page .assignment-selected-count {
        background: var(--a-green-soft);
        color: var(--a-green-dark);
    }

    .dark-mode .assignment-create-page .assignment-file-item {
        border-color: var(--border);
        background: #12142a;
    }

    .dark-mode .assignment-create-page .assignment-file-icon {
        background: var(--a-green-soft);
        color: var(--a-green);
    }

    .dark-mode .assignment-create-page .assignment-file-name {
        color: var(--text-2);
    }

    .dark-mode .assignment-create-page .assignment-file-remove {
        background: var(--danger-soft);
        color: var(--danger);
    }

    .dark-mode .assignment-create-page .assignment-file-remove:hover {
        background: rgba(255, 141, 141, .20);
    }

    .dark-mode .assignment-create-page .assignment-summary-row {
        border-color: var(--border-light);
    }

    .dark-mode .assignment-create-page .assignment-summary-value {
        color: var(--text-2);
    }

    .dark-mode .assignment-create-page .assignment-summary-value.is-assignment {
        color: var(--a-green-dark);
    }

    .dark-mode .assignment-create-page .assignment-sidebar-help {
        border-color: var(--blue-border);
        background: rgba(109, 118, 255, .08);
    }

    .dark-mode .assignment-create-page .assignment-sidebar-help-title {
        color: var(--blue-dark);
    }

    .dark-mode .assignment-create-page .assignment-sidebar-help ul {
        color: #a1a4cc;
    }

    .dark-mode .assignment-create-page .assignment-actions {
        border-color: var(--border-light);
        background: #12142a;
    }

    .dark-mode .assignment-create-page .assignment-cancel-btn {
        border-color: #3a3e68;
        background: #171933;
        color: var(--text-2);
    }

    .dark-mode .assignment-create-page .assignment-cancel-btn:hover {
        border-color: #565b8d;
        background: #1c1e3a;
    }

    .dark-mode .assignment-create-page .assignment-submit-btn {
        border-color: var(--a-green);
        background: var(--a-green);
        color: #08130f;
        box-shadow: 0 5px 14px rgba(73, 213, 167, .14);
    }

    .dark-mode .assignment-create-page .assignment-submit-btn:hover {
        border-color: var(--a-green-dark);
        background: var(--a-green-dark);
    }

    .dark-mode .assignment-create-page .assignment-error {
        color: var(--danger);
    }

    .dark-mode .assignment-create-page .assignment-error:before {
        background: rgba(255, 141, 141, .16);
    }

    .dark-mode .assignment-create-page button:focus-visible,
    .dark-mode .assignment-create-page a:focus-visible,
    .dark-mode .assignment-create-page input:focus-visible,
    .dark-mode .assignment-create-page select:focus-visible,
    .dark-mode .assignment-create-page textarea:focus-visible {
        outline-color: rgba(109, 118, 255, .24);
    }

    /* Mobile keeps the same stacked behavior as the existing design. */
    @media(max-width:620px) {
        .dark-mode .assignment-create-page .assignment-header-badge {
            display: none;
            margin-left: 0;
        }
    }
    

</style>


<div class="assignment-create-page">

    <header class="assignment-create-header">
        <div class="assignment-header-inner">

            <div class="assignment-header-main">

<a href="{{ route(
    'professor.class-groups.classroom-group.classwork',
    ['classGroup' => $classGroup->id]
) }}"
   class="assignment-back-btn"
   title="Back to Classwork">

    <i class="bx bx-arrow-back"></i>

</a>

                <div>
                    <span class="assignment-header-label">
                        {{ $classGroup->group_name }}
                    </span>

                    <div class="assignment-title-row">
                        <span class="assignment-title-mark"></span>
                        <h1 class="assignment-header-title">
                            Create Assignment
                        </h1>
                    </div>

                    <p class="assignment-header-subtitle">
                        Create a new assignment and provide everything your students need.
                    </p>
                </div>

            </div>

            <span class="assignment-header-badge">
                <i class="bx bx-task"></i>
                Assignment
            </span>

        </div>
    </header>


    <div class="assignment-create-layout">

        <main class="assignment-create-main">

            <form id="assignment-create-form"
                action="{{ route(
                      'professor.class-groups.assignments.store',
                      $classGroup
                  ) }}"
                method="POST"
                enctype="multipart/form-data"
                class="assignment-form">

                @csrf


                {{-- ASSIGNMENT DETAILS --}}
                <section class="assignment-section">

                    <div class="assignment-section-header">
                        <div class="assignment-section-icon">
                            <i class="bx bx-file-blank"></i>
                        </div>

                        <div class="assignment-section-heading">
                            <h2>Assignment Details</h2>
                            <p>Set the title, instructions, and classroom topic.</p>
                        </div>
                    </div>

                    <div class="assignment-section-body">

                        <div class="assignment-form-group">
                            <label class="assignment-field-label" for="title">
                                Assignment Title
                                <span class="assignment-required">*</span>
                            </label>

                            <input class="assignment-input"
                                type="text"
                                id="title"
                                name="title"
                                value="{{ old('title') }}"
                                placeholder="e.g. Database Design Project"
                                maxlength="255"
                                required>

                            @error('title')
                            <div class="assignment-error">{{ $message }}</div>
                            @enderror
                        </div>


                        <div class="assignment-form-group">
                            <label class="assignment-field-label" for="description">
                                Instructions
                            </label>

                            <textarea class="assignment-textarea"
                                id="description"
                                name="description"
                                placeholder="Explain what students need to complete...">{{ old('description') }}</textarea>

                            @error('description')
                            <div class="assignment-error">{{ $message }}</div>
                            @enderror
                        </div>


                        <div class="assignment-form-group">
                            <label class="assignment-field-label" for="topic_id">
                                Topic
                                <span class="assignment-optional">Optional</span>
                            </label>

                            <select class="assignment-select"
                                id="topic_id"
                                name="topic_id">

                                <option value="">No topic</option>

                                @foreach($classGroup->topics as $topic)
                                <option value="{{ $topic->id }}"
                                    {{ old('topic_id') == $topic->id ? 'selected' : '' }}>
                                    {{ $topic->topic_name }}
                                </option>
                                @endforeach

                            </select>

                            <span class="assignment-help">
                                <i class="bx bx-info-circle"></i>
                                Organize this assignment under one of your classroom topics.
                            </span>

                            @error('topic_id')
                            <div class="assignment-error">{{ $message }}</div>
                            @enderror
                        </div>

                    </div>
                </section>


                {{-- SCHEDULE & GRADING --}}
                <section class="assignment-section">

                    <div class="assignment-section-header">
                        <div class="assignment-section-icon">
                            <i class="bx bx-calendar-check"></i>
                        </div>

                        <div class="assignment-section-heading">
                            <h2>Schedule & Grading</h2>
                            <p>Set the deadline and maximum score for this assignment.</p>
                        </div>
                    </div>

                    <div class="assignment-section-body">

                        <div class="assignment-form-row">

                            <div class="assignment-form-group">
                                <label class="assignment-field-label" for="due_date">
                                    Due Date
                                    <span class="assignment-required">*</span>
                                </label>

                                <input class="assignment-input"
                                    type="date"
                                    id="due_date"
                                    name="due_date"
                                    value="{{ old('due_date') }}"
                                    required>

                                @error('due_date')
                                <div class="assignment-error">{{ $message }}</div>
                                @enderror
                            </div>


                            <div class="assignment-form-group">
                                <label class="assignment-field-label" for="due_time">
                                    Due Time
                                    <span class="assignment-optional">Optional</span>
                                </label>

                                <input class="assignment-input"
                                    type="time"
                                    id="due_time"
                                    name="due_time"
                                    value="{{ old('due_time') }}">

                                @error('due_time')
                                <div class="assignment-error">{{ $message }}</div>
                                @enderror
                            </div>

                        </div>


                        <div class="assignment-form-group" style="margin-top:18px;">

                            <label class="assignment-field-label" for="points">
                                Total Points
                            </label>

                            <div class="assignment-points-wrap">
                                <input class="assignment-input"
                                    type="number"
                                    id="points"
                                    name="points"
                                    value="{{ old('points', 100) }}"
                                    min="0"
                                    step="1"
                                    placeholder="100">

                                <span class="assignment-points-unit">
                                    Points
                                </span>
                            </div>

                            <span class="assignment-help">
                                <i class="bx bx-info-circle"></i>
                                This is the maximum score students can receive for this assignment.
                            </span>

                            @error('points')
                            <div class="assignment-error">{{ $message }}</div>
                            @enderror

                        </div>

                    </div>
                </section>


                {{-- ONLINE SUBMISSION --}}
                <section class="assignment-section">

                    <div class="assignment-section-header">
                        <div class="assignment-section-icon">
                            <i class="bx bx-link-external"></i>
                        </div>

                        <div class="assignment-section-heading">
                            <h2>Online Submission</h2>
                            <p>Optionally connect a Google Form for student responses.</p>
                        </div>
                    </div>

                    <div class="assignment-section-body">

                        <div class="assignment-google-box">

                            <div class="assignment-google-heading">

                                <div class="assignment-google-icon">
                                    <i class="bx bx-link"></i>
                                </div>

                                <div>
                                    <strong>Google Form</strong>
                                    <span>
                                        Students can use the form as an additional submission method.
                                    </span>
                                </div>

                            </div>

                            <div class="assignment-form-group">

                                <label class="assignment-field-label" for="google_form_url">
                                    Google Form URL
                                    <span class="assignment-optional">Optional</span>
                                </label>

                                <input class="assignment-input"
                                    type="url"
                                    id="google_form_url"
                                    name="google_form_url"
                                    value="{{ old('google_form_url') }}"
                                    placeholder="https://forms.google.com/...">

                                <span class="assignment-help">
                                    <i class="bx bx-info-circle"></i>
                                    Leave this empty if students should submit directly through the classroom.
                                </span>

                                @error('google_form_url')
                                <div class="assignment-error">{{ $message }}</div>
                                @enderror

                            </div>

                        </div>

                    </div>
                </section>


                {{-- ATTACHMENTS --}}
                <section class="assignment-section">

                    <div class="assignment-section-header">
                        <div class="assignment-section-icon">
                            <i class="bx bx-paperclip"></i>
                        </div>

                        <div class="assignment-section-heading">
                            <h2>Attachments</h2>
                            <p>Add documents, instructions, examples, or other assignment resources.</p>
                        </div>
                    </div>

                    <div class="assignment-section-body">

                        <label class="assignment-upload-area" for="attachments">

                            <div class="assignment-upload-icon">
                                <i class="bx bx-cloud-upload"></i>
                            </div>

                            <strong class="assignment-upload-title">
                                Select files to attach
                            </strong>

                            <span class="assignment-upload-subtitle">
                                Choose one or more files to include with this assignment.
                                Maximum 50 MB per file.
                            </span>

                            <span class="assignment-upload-button">
                                <i class="bx bx-folder-open"></i>
                                Choose Files
                            </span>

                            <input class="assignment-upload-input"
                                type="file"
                                id="attachments"
                                name="attachments[]"
                                multiple>

                        </label>


                        <div id="assignment-selected-header"
                            class="assignment-selected-header">

                            <span class="assignment-selected-heading">
                                Selected files
                            </span>

                            <span id="assignment-selected-count"
                                class="assignment-selected-count">
                                0
                            </span>

                        </div>


                        <div id="assignment-file-list"
                            class="assignment-file-list"></div>


                        @error('attachments')
                        <div class="assignment-error">{{ $message }}</div>
                        @enderror

                        @error('attachments.*')
                        <div class="assignment-error">{{ $message }}</div>
                        @enderror

                    </div>
                </section>

            </form>

        </main>


        {{-- SIDEBAR --}}
        <aside class="assignment-create-sidebar">

            <div class="assignment-sidebar-card">

                <div class="assignment-sidebar-header">

                    <div class="assignment-sidebar-header-icon">
                        <i class="bx bx-task"></i>
                    </div>

                    <div>
                        <h3>Assignment Summary</h3>
                        <p>Review the important settings before creating.</p>
                    </div>

                </div>


                <div class="assignment-sidebar-body">

                    <div class="assignment-summary-row">
                        <span class="assignment-summary-label">Class</span>
                        <span class="assignment-summary-value">
                            {{ $classGroup->group_name }}
                        </span>
                    </div>

                    <div class="assignment-summary-row">
                        <span class="assignment-summary-label">Topic</span>
                        <span class="assignment-summary-value">
                            Select in form
                        </span>
                    </div>

                    <div class="assignment-summary-row">
                        <span class="assignment-summary-label">Points</span>
                        <span id="assignment-sidebar-points"
                            class="assignment-summary-value is-assignment">
                            100 Points
                        </span>
                    </div>

                    <div class="assignment-summary-row">
                        <span class="assignment-summary-label">Attachments</span>
                        <span id="assignment-sidebar-file-count"
                            class="assignment-summary-value">
                            0 files
                        </span>
                    </div>

                    <div class="assignment-summary-row">
                        <span class="assignment-summary-label">Google Form</span>
                        <span id="assignment-sidebar-google-status"
                            class="assignment-summary-value">
                            Not connected
                        </span>
                    </div>

                </div>


                <div class="assignment-sidebar-help">

                    <div class="assignment-sidebar-help-title">
                        <i class="bx bx-info-circle"></i>
                        Before creating
                    </div>

                    <ul>
                        <li>Give the assignment a clear title.</li>
                        <li>Explain what students need to complete.</li>
                        <li>Set the correct due date and points.</li>
                        <li>Add supporting files if needed.</li>
                    </ul>

                </div>


                <div class="assignment-actions">

                    <a href="{{ route(
                        'professor.class-groups.classroom-group.classwork',
                        ['classGroup' => $classGroup->id]
                    ) }}"
                        class="assignment-cancel-btn">
                        Cancel
                    </a>

                    <button type="submit"
                        form="assignment-create-form"
                        class="assignment-submit-btn">
                        <i class="bx bx-send"></i>
                        Create Assignment
                    </button>

                </div>

            </div>

        </aside>

    </div>
</div>


<script>
    document.addEventListener('DOMContentLoaded', function() {

        const fileInput = document.getElementById('attachments');
        const fileList = document.getElementById('assignment-file-list');
        const selectedHeader = document.getElementById('assignment-selected-header');
        const selectedCount = document.getElementById('assignment-selected-count');
        const sidebarFileCount = document.getElementById('assignment-sidebar-file-count');
        const uploadArea = document.querySelector('.assignment-upload-area');

        const pointsInput = document.getElementById('points');
        const pointsSummary = document.getElementById('assignment-sidebar-points');

        const googleInput = document.getElementById('google_form_url');
        const googleStatus = document.getElementById('assignment-sidebar-google-status');

        let selectedFiles = [];


        /* ============================================================
           FILE SELECTION
           ============================================================ */

        if (fileInput) {

            fileInput.addEventListener('change', function() {

                Array.from(this.files).forEach(function(file) {

                    const duplicate = selectedFiles.some(function(existing) {
                        return existing.name === file.name &&
                            existing.size === file.size &&
                            existing.lastModified === file.lastModified;
                    });

                    if (!duplicate) {
                        selectedFiles.push(file);
                    }

                });

                syncFileInput();
                renderFiles();

            });

        }


        /* ============================================================
           DRAG & DROP
           ============================================================ */

        if (uploadArea && fileInput) {

            ['dragenter', 'dragover'].forEach(function(eventName) {

                uploadArea.addEventListener(eventName, function(event) {

                    event.preventDefault();
                    event.stopPropagation();
                    uploadArea.classList.add('is-dragging');

                });

            });


            ['dragleave', 'drop'].forEach(function(eventName) {

                uploadArea.addEventListener(eventName, function(event) {

                    event.preventDefault();
                    event.stopPropagation();
                    uploadArea.classList.remove('is-dragging');

                });

            });


            uploadArea.addEventListener('drop', function(event) {

                Array.from(event.dataTransfer.files).forEach(function(file) {

                    const duplicate = selectedFiles.some(function(existing) {
                        return existing.name === file.name &&
                            existing.size === file.size &&
                            existing.lastModified === file.lastModified;
                    });

                    if (!duplicate) {
                        selectedFiles.push(file);
                    }

                });

                syncFileInput();
                renderFiles();

            });

        }


        /* ============================================================
           KEEP REAL INPUT IN SYNC
           ============================================================ */

        function syncFileInput() {

            if (!fileInput) return;

            const dataTransfer = new DataTransfer();

            selectedFiles.forEach(function(file) {
                dataTransfer.items.add(file);
            });

            fileInput.files = dataTransfer.files;

        }


        /* ============================================================
           DISPLAY FILES
           ============================================================ */

        function renderFiles() {

            if (!fileList) return;

            fileList.innerHTML = '';

            if (selectedHeader) {
                selectedHeader.classList.toggle(
                    'is-visible',
                    selectedFiles.length > 0
                );
            }

            if (selectedCount) {
                selectedCount.textContent = selectedFiles.length;
            }

            if (sidebarFileCount) {
                sidebarFileCount.textContent =
                    selectedFiles.length +
                    (selectedFiles.length === 1 ? ' file' : ' files');
            }


            selectedFiles.forEach(function(file, index) {

                const row = document.createElement('div');
                row.className = 'assignment-file-item';

                const iconWrap = document.createElement('div');
                iconWrap.className = 'assignment-file-icon';

                const icon = document.createElement('i');
                icon.className = 'bx bx-file';

                const info = document.createElement('div');
                info.className = 'assignment-file-info';

                const name = document.createElement('span');
                name.className = 'assignment-file-name';
                name.textContent = file.name;

                const size = document.createElement('small');
                size.className = 'assignment-file-size';
                size.textContent = formatFileSize(file.size);

                const remove = document.createElement('button');
                remove.type = 'button';
                remove.className = 'assignment-file-remove';
                remove.title = 'Remove file';
                remove.setAttribute('aria-label', 'Remove ' + file.name);
                remove.innerHTML = '<i class="bx bx-x"></i>';

                remove.addEventListener('click', function() {

                    selectedFiles.splice(index, 1);

                    syncFileInput();
                    renderFiles();

                });

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
           FILE SIZE
           ============================================================ */

        function formatFileSize(bytes) {

            if (bytes === 0) return '0 Bytes';

            const units = ['Bytes', 'KB', 'MB', 'GB'];

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
           LIVE POINTS SUMMARY
           ============================================================ */

        if (pointsInput && pointsSummary) {

            function updatePoints() {

                const value = pointsInput.value.trim() || '0';

                pointsSummary.textContent = value + ' Points';

            }

            pointsInput.addEventListener('input', updatePoints);
            updatePoints();

        }


        /* ============================================================
           LIVE GOOGLE FORM STATUS
           ============================================================ */

        if (googleInput && googleStatus) {

            function updateGoogleStatus() {

                if (googleInput.value.trim() !== '') {

                    googleStatus.textContent = 'Connected';
                    googleStatus.classList.add('is-assignment');

                } else {

                    googleStatus.textContent = 'Not connected';
                    googleStatus.classList.remove('is-assignment');

                }

            }

            googleInput.addEventListener('input', updateGoogleStatus);
            updateGoogleStatus();

        }

    });
</script>

@endsection