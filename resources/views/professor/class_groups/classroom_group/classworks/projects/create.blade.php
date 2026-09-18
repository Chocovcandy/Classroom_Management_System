@extends('layouts.prof_layout')

@section('title', 'Create Project')

@section('content')


<style>
    /* ============================================================
   PROJECT CREATE PAGE
   Design concept follows Assignment Create:
   - Blue = system/navigation/interactions
   - Yellow = Project identity
   - Red = validation/destructive only
   ============================================================ */
    .project-create-page {
        --p-yellow: #eab308;
        --p-yellow-dark: #a16207;
        --p-yellow-soft: #fefce8;
        --p-yellow-light: #fef9c3;
        --p-yellow-border: #fde68a;

        --p-blue: #2563eb;
        --p-blue-dark: #1d4ed8;
        --p-blue-soft: #eff6ff;
        --p-blue-border: #bfdbfe;

        --p-text: #0f172a;
        --p-text-2: #334155;
        --p-muted: #64748b;
        --p-light: #94a3b8;
        --p-border: #e2e8f0;
        --p-border-light: #edf2f7;
        --p-surface: #fff;
        --p-soft: #f8fafc;

        --p-danger: #dc2626;
        --p-danger-soft: #fef2f2;
        --p-danger-border: #fecaca;

        --p-shadow: 0 6px 24px rgba(15, 23, 42, .055);
        --p-small-shadow: 0 2px 8px rgba(15, 23, 42, .045);

        width: 100%;
        max-width: 1240px;
        margin: 0 auto;
        padding: 30px 26px 60px;
        color: var(--p-text);
    }

    .project-create-page *,
    .project-create-page *::before,
    .project-create-page *::after {
        box-sizing: border-box
    }

    /* HEADER */
    .project-page-header {
        margin-bottom: 24px
    }

    .project-back-link {
        width: 42px;
        height: 42px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        margin: 0 0 16px;
        border: 1px solid var(--p-border);
        border-radius: 11px;
        background: #fff;
        color: var(--p-muted);
        text-decoration: none;
        box-shadow: var(--p-small-shadow);
        transition: .18s ease;
    }

    .project-back-link span {
        display: none
    }

    .project-back-link i {
        font-size: 21px;
        line-height: 1
    }

    .project-back-link:hover {
        color: var(--p-blue-dark);
        border-color: var(--p-blue-border);
        background: var(--p-blue-soft);
        transform: translateX(-2px);
    }

    .project-header-row {
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        gap: 24px;
    }

    .project-header-main {
        min-width: 0
    }

    .project-header-label {
        margin-bottom: 7px;
        color: var(--p-yellow-dark);
        font-size: 11px;
        font-weight: 800;
        letter-spacing: .14em;
        text-transform: uppercase;
    }

    .project-page-title {
        margin: 0;
        color: var(--p-text);
        font-size: 30px;
        line-height: 1.15;
        font-weight: 800;
        letter-spacing: -.035em;
    }

    .project-page-subtitle {
        margin: 8px 0 0;
        color: var(--p-muted);
        font-size: 14px;
        line-height: 1.5;
    }

    .project-class-badge {
        display: inline-flex;
        align-items: center;
        gap: 7px;
        flex: 0 0 auto;
        margin-left: auto;
        padding: 8px 12px;
        border: 1px solid var(--p-blue-border);
        border-radius: 999px;
        background: var(--p-blue-soft);
        color: var(--p-blue-dark);
        font-size: 11px;
        font-weight: 800;
    }

    .project-class-badge i {
        font-size: 15px
    }

    /* ALERT */
    .project-alert {
        display: flex;
        gap: 10px;
        margin-bottom: 18px;
        padding: 13px 15px;
        border: 1px solid var(--p-danger-border);
        border-radius: 12px;
        background: var(--p-danger-soft);
        color: var(--p-danger);
        font-size: 12px;
        line-height: 1.5;
    }

    .project-alert>i {
        font-size: 18px;
        flex: 0 0 auto
    }

    .project-alert strong {
        display: block;
        margin-bottom: 3px
    }

    .project-alert ul {
        margin: 0;
        padding-left: 17px
    }

    /* LAYOUT */
    .project-create-grid {
        display: grid;
        grid-template-columns: minmax(0, 1fr) 315px;
        align-items: start;
        gap: 22px;
    }

    .project-main-column,
    .project-sidebar {
        min-width: 0
    }

    /* SECTIONS */
    .project-section-card {
        overflow: hidden;
        margin-bottom: 18px;
        border: 1px solid var(--p-border);
        border-radius: 18px;
        background: #fff;
        box-shadow: var(--p-shadow);
    }

    .project-section-heading {
        display: flex;
        align-items: center;
        gap: 13px;
        padding: 19px 22px;
        border-bottom: 1px solid var(--p-border-light);
    }

    .project-section-icon {
        width: 40px;
        height: 40px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        flex: 0 0 40px;
        border: 1px solid var(--p-yellow-border);
        border-radius: 11px;
        background: var(--p-yellow-soft);
        color: var(--p-yellow-dark);
        font-size: 20px;
    }

    .project-section-heading>div:last-child {
        min-width: 0
    }

    .project-section-heading h2 {
        margin: 0;
        color: var(--p-text);
        font-size: 16px;
        line-height: 1.25;
        font-weight: 800;
    }

    .project-section-heading p {
        margin: 4px 0 0;
        color: var(--p-muted);
        font-size: 12px;
        line-height: 1.45;
    }

    .project-form-group {
        margin: 0 0 20px
    }

    .project-form-group:last-child {
        margin-bottom: 0
    }

    .project-form-row {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 16px;
        padding: 23px 23px 0;
    }

    .project-section-card>.project-form-group,
    .project-section-card>.project-type-grid,
    .project-section-card>.project-upload-area,
    .project-section-card>.project-file-list,
    .project-section-card>.project-error,
    .project-section-card>.project-help-text {
        margin-left: 23px;
        margin-right: 23px;
    }

    .project-section-card>.project-form-group {
        margin-bottom: 20px
    }

    .project-section-card>.project-form-group:first-of-type {
        margin-top: 23px
    }

    .project-section-card>.project-form-group:last-of-type {
        margin-bottom: 23px
    }

    .project-section-card>.project-type-grid {
        margin-top: 23px;
        margin-bottom: 23px
    }

    .project-section-card>.project-upload-area {
        margin-top: 23px
    }

    .project-form-label {
        display: flex;
        align-items: center;
        flex-wrap: wrap;
        gap: 6px;
        margin: 0 0 8px;
        color: var(--p-text-2);
        font-size: 13px;
        font-weight: 750;
    }

    .project-required {
        color: #ef4444
    }

    .project-input,
    .project-select,
    .project-textarea {
        width: 100%;
        border: 1px solid #cbd5e1;
        border-radius: 11px;
        outline: none;
        background: #fff;
        color: var(--p-text);
        font-family: inherit;
        font-size: 14px;
        transition: .18s;
    }

    .project-input,
    .project-select {
        height: 45px;
        padding: 0 13px
    }

    .project-textarea {
        min-height: 155px;
        padding: 13px;
        resize: vertical;
        line-height: 1.6
    }

    .project-input::placeholder,
    .project-textarea::placeholder {
        color: #a8b3c2
    }

    .project-input:hover,
    .project-select:hover,
    .project-textarea:hover {
        border-color: #94a3b8
    }

    .project-input:focus,
    .project-select:focus,
    .project-textarea:focus {
        border-color: #60a5fa;
        box-shadow: 0 0 0 3px rgba(59, 130, 246, .11)
    }

    .project-help-text {
        display: flex;
        gap: 5px;
        margin-top: 7px;
        color: var(--p-light);
        font-size: 11px;
        line-height: 1.5;
    }

    .project-help-text::before {
        content: 'ⓘ';
        color: var(--p-blue);
        font-size: 12px
    }

    .project-error {
        display: flex;
        gap: 6px;
        margin-top: 7px;
        color: var(--p-danger);
        font-size: 12px;
        line-height: 1.45;
        font-weight: 600;
    }

    .project-error::before {
        content: '!';
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

    /* PROJECT TYPE */
    .project-type-grid {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 12px
    }

    .project-type-option {
        position: relative
    }

    .project-type-radio {
        position: absolute;
        width: 1px;
        height: 1px;
        opacity: 0;
        pointer-events: none;
    }

    .project-type-label {
        display: flex;
        align-items: flex-start;
        gap: 12px;
        min-height: 105px;
        padding: 16px;
        border: 1px solid var(--p-border);
        border-radius: 13px;
        background: #fff;
        cursor: pointer;
        transition: .18s ease;
    }

    .project-type-label:hover {
        border-color: var(--p-yellow-border);
        background: var(--p-yellow-soft)
    }

    .project-type-radio:checked+.project-type-label {
        border-color: var(--p-yellow);
        background: var(--p-yellow-soft);
        box-shadow: 0 0 0 3px rgba(234, 179, 8, .10);
    }

    .project-type-icon {
        width: 38px;
        height: 38px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        flex: 0 0 38px;
        border: 1px solid var(--p-yellow-border);
        border-radius: 10px;
        background: #fff;
        color: var(--p-yellow-dark);
        font-size: 19px;
    }

    .project-type-content {
        min-width: 0
    }

    .project-type-title {
        margin: 0;
        color: var(--p-text-2);
        font-size: 13px;
        font-weight: 800
    }

    .project-type-description {
        margin: 5px 0 0;
        color: var(--p-muted);
        font-size: 11px;
        line-height: 1.5
    }


    /* ============================================================
   STUDENT GROUPING
   ============================================================ */
    .project-grouping-card {
        display: none;
    }

    .project-grouping-card.is-visible {
        display: block;
    }

    .project-grouping-intro {
        margin: 20px 23px 0;
        padding: 13px 14px;
        border: 1px solid var(--p-blue-border);
        border-radius: 11px;
        background: var(--p-blue-soft);
        color: var(--p-text-2);
        font-size: 11px;
        line-height: 1.55;
    }

    .project-grouping-intro strong {
        color: var(--p-blue-dark);
    }

    .project-grouping-methods {
        display: grid;
        grid-template-columns: repeat(3, minmax(0, 1fr));
        gap: 11px;
        margin: 18px 23px 0;
    }

    .project-grouping-method {
        position: relative;
    }

    .project-grouping-method input {
        position: absolute;
        width: 1px;
        height: 1px;
        opacity: 0;
        pointer-events: none;
    }

    .project-grouping-method label {
        display: flex;
        flex-direction: column;
        gap: 9px;
        min-height: 142px;
        padding: 15px;
        border: 1px solid var(--p-border);
        border-radius: 13px;
        background: var(--p-surface);
        cursor: pointer;
        transition: .18s ease;
    }

    .project-grouping-method label:hover {
        border-color: var(--p-blue-border);
        background: var(--p-blue-soft);
        transform: translateY(-1px);
    }

    .project-grouping-method input:checked+label {
        border-color: var(--p-blue);
        background: var(--p-blue-soft);
        box-shadow: 0 0 0 3px rgba(37, 99, 235, .09);
    }

    .project-grouping-method-icon {
        width: 38px;
        height: 38px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border: 1px solid var(--p-blue-border);
        border-radius: 10px;
        background: var(--p-surface);
        color: var(--p-blue);
        font-size: 19px;
    }

    .project-grouping-method-title {
        color: var(--p-text-2);
        font-size: 12px;
        font-weight: 800;
    }

    .project-grouping-method-description {
        color: var(--p-muted);
        font-size: 10px;
        line-height: 1.5;
    }

    .project-group-count-row {
        display: grid;
        grid-template-columns: minmax(0, 1fr) 170px;
        align-items: end;
        gap: 16px;
        margin: 18px 23px 0;
        padding-bottom: 23px;
    }

    .project-group-count-control {
        min-width: 0;
    }

    .project-group-count-control .project-form-group {
        margin: 0;
    }

    .project-group-count-select {
        width: 100%;
        height: 45px;
        padding: 0 13px;
        border: 1px solid #cbd5e1;
        border-radius: 11px;
        outline: none;
        background: #fff;
        color: var(--p-text);
        font-family: inherit;
        font-size: 14px;
        transition: .18s;
    }

    .project-group-count-select:hover {
        border-color: #94a3b8;
    }

    .project-group-count-select:focus {
        border-color: #60a5fa;
        box-shadow: 0 0 0 3px rgba(59, 130, 246, .11);
    }

    .project-generate-groups-btn {
        height: 45px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 7px;
        border: 1px solid var(--p-blue);
        border-radius: 11px;
        background: var(--p-blue);
        color: #fff;
        font-family: inherit;
        font-size: 12px;
        font-weight: 800;
        cursor: pointer;
        transition: .18s ease;
    }

    .project-generate-groups-btn:hover {
        border-color: var(--p-blue-dark);
        background: var(--p-blue-dark);
        transform: translateY(-1px);
    }

    .project-generate-groups-btn.is-loading {
        pointer-events: none;
        opacity: .72;
    }

    .project-generate-groups-btn.is-loading i {
        animation: projectGroupSpin .8s linear infinite;
    }

    @keyframes projectGroupSpin {
        to {
            transform: rotate(360deg);
        }
    }

    .project-grouping-status {
        display: none;
        margin: 0 23px 18px;
        padding: 11px 13px;
        border: 1px solid var(--p-yellow-border);
        border-radius: 10px;
        background: var(--p-yellow-soft);
        color: var(--p-yellow-dark);
        font-size: 11px;
        line-height: 1.5;
    }

    .project-grouping-status.is-visible {
        display: block;
    }

    .project-groups-preview {
        margin: 0 23px 18px;
        border: 1px solid var(--p-border);
        border-radius: 14px;
        background: var(--p-soft);
        overflow: hidden;
    }

    .project-groups-preview[hidden] {
        display: none;
    }

    .project-groups-preview-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 16px;
        padding: 16px;
        border-bottom: 1px solid var(--p-border);
    }

    .project-groups-preview-eyebrow {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        margin-bottom: 4px;
        color: var(--p-blue);
        font-size: 9px;
        font-weight: 800;
        letter-spacing: .08em;
        text-transform: uppercase;
    }

    .project-groups-preview-header h3 {
        margin: 0;
        color: var(--p-text);
        font-size: 15px;
        font-weight: 800;
    }

    .project-groups-preview-header p {
        margin: 4px 0 0;
        color: var(--p-muted);
        font-size: 10px;
    }

    .project-groups-preview-count {
        padding: 7px 10px;
        border: 1px solid var(--p-blue-border);
        border-radius: 999px;
        background: var(--p-blue-soft);
        color: var(--p-blue-dark);
        font-size: 10px;
        font-weight: 800;
        white-space: nowrap;
    }

    .project-groups-preview-grid {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 12px;
        padding: 16px;
    }

    .project-preview-team {
        overflow: hidden;
        border: 1px solid var(--p-border);
        border-radius: 13px;
        background: var(--p-surface);
    }

    .project-preview-team-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 10px;
        padding: 12px 13px;
        border-bottom: 1px solid var(--p-border-light);
    }

    .project-preview-team-title {
        display: flex;
        align-items: center;
        gap: 8px;
        min-width: 0;
    }

    .project-preview-team-icon {
        width: 32px;
        height: 32px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        flex: 0 0 32px;
        border-radius: 9px;
        background: var(--p-blue-soft);
        color: var(--p-blue);
        font-size: 16px;
    }

    .project-preview-team-title strong {
        overflow: hidden;
        color: var(--p-text);
        font-size: 12px;
        font-weight: 800;
        text-overflow: ellipsis;
        white-space: nowrap;
    }

    .project-preview-team-count {
        color: var(--p-muted);
        font-size: 9px;
        font-weight: 700;
        white-space: nowrap;
    }

    .project-preview-members {
        display: flex;
        flex-direction: column;
    }

    .project-preview-member {
        display: flex;
        align-items: center;
        gap: 9px;
        min-width: 0;
        padding: 9px 13px;
        border-bottom: 1px solid var(--p-border-light);
    }

    .project-preview-member:last-child {
        border-bottom: 0;
    }

    .project-preview-avatar {
        width: 30px;
        height: 30px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        flex: 0 0 30px;
        overflow: hidden;
        border-radius: 50%;
        background: var(--p-blue-soft);
        color: var(--p-blue);
        font-size: 10px;
        font-weight: 800;
    }

    .project-preview-avatar img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .project-preview-member-info {
        min-width: 0;
        flex: 1;
    }

    .project-preview-member-name {
        display: block;
        overflow: hidden;
        color: var(--p-text-2);
        font-size: 11px;
        font-weight: 700;
        text-overflow: ellipsis;
        white-space: nowrap;
    }

    .project-preview-member-performance {
        display: block;
        margin-top: 2px;
        color: var(--p-muted);
        font-size: 9px;
    }

    .project-preview-role {
        flex: 0 0 auto;
        height: 28px;
        padding: 0 7px;
        border: 1px solid var(--p-border);
        border-radius: 8px;
        background: var(--p-surface);
        color: var(--p-text-2);
        font-family: inherit;
        font-size: 9px;
        font-weight: 700;
        outline: none;
    }

    .project-preview-role:focus {
        border-color: var(--p-blue);
        box-shadow: 0 0 0 2px rgba(37, 99, 235, .10);
    }

    .project-preview-average {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 10px;
        padding: 10px 13px;
        border-top: 1px solid var(--p-border-light);
        background: var(--p-soft);
    }

    .project-preview-average span {
        color: var(--p-muted);
        font-size: 9px;
    }

    .project-preview-average strong {
        color: var(--p-text-2);
        font-size: 10px;
        font-weight: 800;
    }

    .project-groups-preview-footer {
        display: flex;
        align-items: flex-start;
        gap: 7px;
        padding: 11px 16px;
        border-top: 1px solid var(--p-border);
        background: var(--p-blue-soft);
        color: var(--p-muted);
        font-size: 9px;
        line-height: 1.5;
    }

    .project-groups-preview-footer i {
        flex: 0 0 auto;
        margin-top: 1px;
        color: var(--p-blue);
        font-size: 13px;
    }

    .project-grouping-note {
        display: flex;
        gap: 6px;
        margin: 0 23px 23px;
        color: var(--p-light);
        font-size: 10px;
        line-height: 1.5;
    }

    .project-grouping-note i {
        flex: 0 0 auto;
        margin-top: 1px;
        color: var(--p-blue);
        font-size: 13px;
    }


    /* MANUAL STUDENT ASSIGNMENT */
    .project-manual-assignment {
        display: none;
        margin: 0 23px 18px;
        border: 1px solid var(--p-border);
        border-radius: 14px;
        background: var(--p-soft);
        overflow: hidden;
    }

    .project-manual-assignment.is-visible {
        display: block;
    }

    .project-manual-assignment-header {
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        gap: 12px;
        padding: 14px 15px;
        border-bottom: 1px solid var(--p-border);
    }

    .project-manual-assignment-header h3 {
        margin: 0;
        color: var(--p-text);
        font-size: 13px;
        font-weight: 800;
    }

    .project-manual-assignment-header p {
        margin: 4px 0 0;
        color: var(--p-muted);
        font-size: 10px;
        line-height: 1.45;
    }

    .project-manual-student-list {
        display: flex;
        flex-direction: column;
    }

    .project-manual-student-row {
        display: grid;
        grid-template-columns: 38px minmax(0, 1fr) 150px;
        align-items: center;
        gap: 10px;
        padding: 10px 14px;
        border-bottom: 1px solid var(--p-border-light);
    }

    .project-manual-student-row:last-child {
        border-bottom: 0;
    }

    .project-manual-avatar {
        width: 30px;
        height: 30px;
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
        border-radius: 50%;
        background: var(--p-blue-soft);
        color: var(--p-blue);
        font-size: 10px;
        font-weight: 800;
    }

    .project-manual-avatar img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .project-manual-student-info {
        min-width: 0;
    }

    .project-manual-student-name {
        display: block;
        overflow: hidden;
        color: var(--p-text-2);
        font-size: 11px;
        font-weight: 700;
        text-overflow: ellipsis;
        white-space: nowrap;
    }

    .project-manual-student-help {
        display: block;
        margin-top: 2px;
        color: var(--p-light);
        font-size: 9px;
    }

    .project-manual-team-select {
        width: 100%;
        height: 34px;
        padding: 0 8px;
        border: 1px solid #cbd5e1;
        border-radius: 9px;
        background: #fff;
        color: var(--p-text-2);
        font: 700 10px inherit;
        outline: none;
    }

    .project-manual-team-select:focus {
        border-color: var(--p-blue);
        box-shadow: 0 0 0 3px rgba(37, 99, 235, .10);
    }

    @media(max-width:620px) {
        .project-manual-assignment {
            margin-left: 17px;
            margin-right: 17px;
        }

        .project-manual-student-row {
            grid-template-columns: 34px minmax(0, 1fr);
        }

        .project-manual-team-select {
            grid-column: 2;
        }
    }

    /* MANUAL TEAM BUILDER */
    .project-manual-builder { display:none; margin:0 23px 18px; border:1px solid var(--p-border); border-radius:14px; background:var(--p-soft); overflow:hidden; }
    .project-manual-builder.is-visible { display:block; }
    .project-manual-builder-header { display:flex; align-items:flex-start; justify-content:space-between; gap:12px; padding:14px 15px; border-bottom:1px solid var(--p-border); }
    .project-manual-builder-header h3 { margin:0; color:var(--p-text); font-size:13px; font-weight:800; }
    .project-manual-builder-header p { margin:4px 0 0; color:var(--p-muted); font-size:10px; line-height:1.45; }
    .project-manual-team-grid { display:grid; grid-template-columns:repeat(2,minmax(0,1fr)); gap:12px; padding:16px; }
    .project-manual-team { overflow:hidden; border:1px solid var(--p-border); border-radius:12px; background:var(--p-surface); }
    .project-manual-team-head { display:flex; align-items:center; justify-content:space-between; gap:10px; padding:11px 12px; border-bottom:1px solid var(--p-border-light); }
    .project-manual-team-head strong { color:var(--p-text); font-size:11px; font-weight:800; }
    .project-manual-team-count { color:var(--p-muted); font-size:9px; font-weight:700; }
    .project-manual-team-body { padding:10px 12px; min-height:84px; }
    .project-manual-student-list { display:flex; flex-direction:column; gap:6px; margin-bottom:9px; }
    .project-manual-student-row { display:flex; align-items:center; gap:8px; padding:7px 8px; border:1px solid var(--p-border-light); border-radius:9px; background:var(--p-soft); }
    .project-manual-student-row span { min-width:0; flex:1; overflow:hidden; color:var(--p-text-2); font-size:10px; font-weight:700; text-overflow:ellipsis; white-space:nowrap; }
    .project-manual-remove-student { width:25px; height:25px; display:inline-flex; align-items:center; justify-content:center; flex:0 0 25px; border:0; border-radius:7px; background:var(--p-danger-soft); color:var(--p-danger); cursor:pointer; }
    .project-manual-add-btn { width:100%; height:34px; display:inline-flex; align-items:center; justify-content:center; gap:6px; border:1px dashed var(--p-blue-border); border-radius:8px; background:var(--p-blue-soft); color:var(--p-blue); font-family:inherit; font-size:10px; font-weight:800; cursor:pointer; }
    .project-manual-empty { color:var(--p-light); font-size:10px; text-align:center; padding:8px 0 10px; }
    .project-manual-unassigned { padding:11px 16px; border-top:1px solid var(--p-border); background:var(--p-surface); color:var(--p-muted); font-size:10px; }
    .project-manual-unassigned strong { color:var(--p-text-2); }

    .project-student-picker {
        position:fixed;
        inset:0;
        z-index:9999;
        display:none;
        align-items:center;
        justify-content:center;
        padding:24px;
        background:rgba(15,23,42,.42);
    }
    .project-student-picker.is-open { display:flex; }
    .project-student-picker-dialog {
        width:min(600px,100%);
        max-height:min(720px,90vh);
        display:flex;
        flex-direction:column;
        border:1px solid #dbe2ea;
        border-radius:18px;
        background:#fff;
        box-shadow:0 24px 70px rgba(15,23,42,.28);
        overflow:hidden;
    }
    .project-student-picker-header { display:flex; align-items:flex-start; justify-content:space-between; gap:12px; padding:17px 18px; border-bottom:1px solid var(--p-border); }
    .project-student-picker-header h3 { margin:0; color:var(--p-text); font-size:15px; font-weight:800; }
    .project-student-picker-header p { margin:4px 0 0; color:var(--p-muted); font-size:10px; }
    .project-student-picker-close { width:34px; height:34px; display:inline-flex; align-items:center; justify-content:center; border:1px solid var(--p-border); border-radius:9px; background:var(--p-soft); color:var(--p-muted); cursor:pointer; }
    .project-student-picker-list { padding:12px 16px; overflow:auto; background:#fff; }
    .project-student-picker-option { display:flex; align-items:center; gap:10px; padding:9px 8px; border-radius:9px; cursor:pointer; }
    .project-student-picker-option:hover { background:var(--p-soft); }
    .project-student-picker-option.is-disabled { opacity:.45; cursor:not-allowed; }
    .project-student-picker-option input { width:15px; height:15px; accent-color:var(--p-blue); }
    .project-student-picker-avatar { width:30px; height:30px; display:inline-flex; align-items:center; justify-content:center; overflow:hidden; flex:0 0 30px; border-radius:50%; background:var(--p-blue-soft); color:var(--p-blue); font-size:9px; font-weight:800; }
    .project-student-picker-avatar img { width:100%; height:100%; object-fit:cover; }
    .project-student-picker-name { min-width:0; color:var(--p-text-2); font-size:11px; font-weight:700; overflow:hidden; text-overflow:ellipsis; white-space:nowrap; }
    .project-student-picker-selected { margin-left:auto; color:var(--p-blue); font-size:9px; font-weight:800; white-space:nowrap; }
    .project-student-picker-footer { display:flex; justify-content:flex-end; gap:8px; padding:14px 16px; border-top:1px solid #e2e8f0; background:#f8fafc; }
    .project-student-picker-cancel,.project-student-picker-add { height:36px; padding:0 13px; border-radius:9px; font-family:inherit; font-size:10px; font-weight:800; cursor:pointer; }
    .project-student-picker-cancel { border:1px solid var(--p-border); background:var(--p-surface); color:var(--p-text-2); }
    .project-student-picker-add { border:1px solid #2563eb !important; background:#2563eb !important; color:#ffffff !important; min-width:120px; opacity:1 !important; display:inline-flex; align-items:center; justify-content:center; }
    .project-student-picker-add:hover { background:#1d4ed8 !important; border-color:#1d4ed8 !important; color:#ffffff !important; }
    .dark-mode .project-create-page .project-manual-builder { border-color:var(--p-border); background:#12142a; }
    .dark-mode .project-create-page .project-manual-builder-header, .dark-mode .project-create-page .project-manual-unassigned { border-color:var(--p-border); }
    .dark-mode .project-create-page .project-manual-team { border-color:var(--p-border); background:#171933; }
    .dark-mode .project-create-page .project-manual-student-row { border-color:var(--p-border-light); background:#12142a; }
    .dark-mode .project-create-page .project-manual-add-btn { border-color:var(--p-blue-border); background:var(--p-blue-soft); }
    .dark-mode .project-create-page .project-student-picker { background:rgba(4,7,20,.62); }
    .dark-mode .project-create-page .project-student-picker-dialog { border-color:var(--p-border); background:#171933; }
    .dark-mode .project-create-page .project-student-picker-close, .dark-mode .project-create-page .project-student-picker-cancel { border-color:var(--p-border); background:#12142a; color:var(--p-text-2); }
    @media(max-width:820px){ .project-manual-team-grid{grid-template-columns:1fr;} }
    @media(max-width:620px){ .project-manual-builder{margin-left:17px;margin-right:17px;} }

    /* DARK MODE - GROUPING */
    .dark-mode .project-create-page .project-grouping-intro {
        border-color: var(--p-blue-border);
        background: var(--p-blue-soft);
        color: var(--p-text-2);
    }

    .dark-mode .project-create-page .project-grouping-method label {
        border-color: var(--p-border);
        background: #12142a;
    }

    .dark-mode .project-create-page .project-grouping-method label:hover,
    .dark-mode .project-create-page .project-grouping-method input:checked+label {
        border-color: var(--p-blue);
        background: var(--p-blue-soft);
    }

    .dark-mode .project-create-page .project-grouping-method-icon {
        border-color: var(--p-blue-border);
        background: #171933;
        color: var(--p-blue-dark);
    }

    .dark-mode .project-create-page .project-group-count-select {
        border-color: #3a3e68;
        background: #12142a;
        color: var(--p-text);
    }

    .dark-mode .project-create-page .project-grouping-status {
        border-color: var(--p-yellow-border);
        background: var(--p-yellow-soft);
        color: var(--p-yellow-dark);
    }

    .dark-mode .project-create-page .project-groups-preview {
        border-color: var(--p-border);
        background: #12142a;
    }

    .dark-mode .project-create-page .project-groups-preview-header,
    .dark-mode .project-create-page .project-preview-team-header,
    .dark-mode .project-create-page .project-preview-member,
    .dark-mode .project-create-page .project-preview-average,
    .dark-mode .project-create-page .project-groups-preview-footer {
        border-color: var(--p-border);
    }

    .dark-mode .project-create-page .project-preview-team {
        border-color: var(--p-border);
        background: #171933;
    }

    .dark-mode .project-create-page .project-preview-team-title strong,
    .dark-mode .project-create-page .project-preview-member-name {
        color: var(--p-text-2);
    }

    .dark-mode .project-create-page .project-preview-role {
        border-color: #3a3e68;
        background: #12142a;
        color: var(--p-text-2);
    }

    .dark-mode .project-create-page .project-preview-average {
        background: #12142a;
    }

    @media(max-width:820px) {
        .project-grouping-methods {
            grid-template-columns: 1fr;
        }

        .project-group-count-row {
            grid-template-columns: 1fr;
        }

        .project-groups-preview-grid {
            grid-template-columns: 1fr;
        }
    }

    @media(max-width:620px) {

        .project-grouping-intro,
        .project-grouping-methods,
        .project-group-count-row,
        .project-grouping-note,
        .project-grouping-status,
        .project-groups-preview {
            margin-left: 17px;
            margin-right: 17px;
        }

        .project-group-count-row {
            padding-bottom: 17px;
        }

        .project-grouping-note,
        .project-grouping-status {
            margin-bottom: 17px;
        }

        .project-groups-preview-header {
            align-items: flex-start;
            flex-direction: column;
        }
    }

    @media(max-width:480px) {
        .project-groups-preview-grid {
            padding: 10px;
        }

        .project-preview-member {
            padding: 8px 10px;
        }

        .project-preview-role {
            width: 92px;
            font-size: 8px;
        }
    }

    /* UPLOAD */
    .project-upload-area {
        position: relative;
        padding: 25px 20px;
        border: 1.5px dashed var(--p-yellow-border);
        border-radius: 14px;
        background: var(--p-yellow-soft);
        text-align: center;
        cursor: pointer;
        transition: .18s;
    }

    .project-upload-area:hover,
    .project-upload-area.is-dragging {
        border-color: var(--p-yellow);
        background: #fffbea;
        transform: translateY(-1px)
    }

    .project-file-input {
        position: absolute;
        width: 1px;
        height: 1px;
        opacity: 0;
        pointer-events: none
    }

    .project-upload-content {
        display: block;
        cursor: pointer
    }

    .project-upload-icon {
        width: 48px;
        height: 48px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 10px;
        border: 1px solid var(--p-yellow-border);
        border-radius: 13px;
        background: #fff;
        color: var(--p-yellow-dark);
        box-shadow: var(--p-small-shadow);
        font-size: 22px;
    }

    .project-upload-title {
        margin: 0;
        color: var(--p-text-2);
        font-size: 13px;
        font-weight: 800
    }

    .project-upload-title span {
        color: var(--p-blue);
        font-weight: 800
    }

    .project-upload-description {
        max-width: 500px;
        margin: 5px auto 0;
        color: var(--p-light);
        font-size: 11px;
        line-height: 1.5
    }

    .project-file-list {
        display: flex;
        flex-direction: column;
        gap: 8px;
        margin-top: 15px;
        margin-bottom: 23px
    }

    .project-file-item {
        display: flex;
        align-items: center;
        gap: 10px;
        min-width: 0;
        padding: 10px 11px;
        border: 1px solid var(--p-border);
        border-radius: 10px;
        background: #fff;
    }

    .project-file-icon {
        width: 32px;
        height: 32px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        flex: 0 0 32px;
        border-radius: 8px;
        background: var(--p-yellow-soft);
        color: var(--p-yellow-dark);
        font-size: 16px;
    }

    .project-file-info {
        min-width: 0;
        flex: 1
    }

    .project-file-name {
        display: block;
        overflow: hidden;
        color: var(--p-text-2);
        font-size: 12px;
        font-weight: 650;
        text-overflow: ellipsis;
        white-space: nowrap
    }

    .project-file-size {
        display: block;
        margin-top: 2px;
        color: var(--p-light);
        font-size: 10px
    }

    .project-file-remove {
        width: 29px;
        height: 29px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        flex: 0 0 29px;
        border: 0;
        border-radius: 8px;
        background: var(--p-danger-soft);
        color: var(--p-danger);
        cursor: pointer;
        transition: .18s
    }

    .project-file-remove:hover {
        background: #fee2e2
    }

    /* SIDEBAR */
    .project-summary-card {
        position: sticky;
        top: 20px;
        overflow: hidden;
        border: 1px solid var(--p-border);
        border-radius: 18px;
        background: #fff;
        box-shadow: var(--p-shadow)
    }

    .project-summary-header {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 19px 18px;
        border-bottom: 1px solid var(--p-border-light)
    }

    .project-summary-icon {
        width: 35px;
        height: 35px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        flex: 0 0 35px;
        border-radius: 9px;
        background: var(--p-yellow-soft);
        color: var(--p-yellow-dark);
        font-size: 17px
    }

    .project-summary-header h2 {
        margin: 0;
        color: var(--p-text);
        font-size: 14px;
        font-weight: 800
    }

    .project-summary-list {
        padding: 8px 18px 17px
    }

    .project-summary-item {
        display: grid;
        grid-template-columns: 82px minmax(0, 1fr);
        gap: 12px;
        padding: 13px 0;
        border-bottom: 1px solid #f1f5f9;
    }

    .project-summary-item:last-child {
        border-bottom: 0
    }

    .project-summary-label {
        color: var(--p-muted);
        font-size: 10px
    }

    .project-summary-value {
        min-width: 0;
        overflow-wrap: anywhere;
        color: var(--p-text-2);
        font-size: 11px;
        line-height: 1.45;
        font-weight: 750;
        text-align: right
    }

    .project-summary-muted {
        color: var(--p-light)
    }

    .project-summary-value.project-summary-yellow {
        color: var(--p-yellow-dark)
    }

    .project-help-card {
        margin: 0 18px 17px;
        padding: 13px;
        border: 1px solid var(--p-yellow-border);
        border-radius: 10px;
        background: var(--p-yellow-soft)
    }

    .project-help-card-title {
        display: flex;
        align-items: center;
        gap: 6px;
        margin-bottom: 7px;
        color: var(--p-yellow-dark);
        font-size: 11px;
        font-weight: 800
    }

    .project-help-card-title i {
        font-size: 14px
    }

    .project-help-card p {
        margin: 0;
        color: #57534e;
        font-size: 10px;
        line-height: 1.65
    }

    /* ACTIONS INSIDE SUMMARY CARD */
    .project-actions {
        display: grid;
        grid-template-columns: 1fr 1.25fr;
        gap: 9px;
        padding: 16px 18px 18px;
        border-top: 1px solid var(--p-border-light);
        background: #fcfdff
    }

    .project-cancel-btn,
    .project-btn {
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

    .project-cancel-btn {
        border: 1px solid #cbd5e1;
        background: #fff;
        color: var(--p-text-2)
    }

    .project-cancel-btn:hover {
        border-color: #94a3b8;
        background: var(--p-soft)
    }

    .project-btn-primary {
        border: 1px solid var(--p-yellow);
        background: var(--p-yellow);
        color: #422006;
        box-shadow: 0 5px 12px rgba(234, 179, 8, .16)
    }

    .project-btn-primary:hover {
        border-color: #ca8a04;
        background: #ca8a04;
        transform: translateY(-1px)
    }

    .project-create-page button:focus-visible,
    .project-create-page a:focus-visible,
    .project-create-page input:focus-visible,
    .project-create-page select:focus-visible,
    .project-create-page textarea:focus-visible {
        outline: 3px solid rgba(37, 99, 235, .14);
        outline-offset: 2px
    }

    /* DARK MODE */
    .dark-mode .project-create-page {
        --p-yellow: #facc15;
        --p-yellow-dark: #fde047;
        --p-yellow-soft: rgba(250, 204, 21, .11);
        --p-yellow-light: rgba(250, 204, 21, .16);
        --p-yellow-border: rgba(250, 204, 21, .34);
        --p-blue: #6d76ff;
        --p-blue-dark: #8990ff;
        --p-blue-soft: rgba(109, 118, 255, .12);
        --p-blue-border: rgba(109, 118, 255, .34);
        --p-text: #f4f5ff;
        --p-text-2: #e6e8f7;
        --p-muted: #a1a4cc;
        --p-light: #9295bd;
        --p-border: #2b2e52;
        --p-border-light: #252847;
        --p-surface: #171933;
        --p-soft: #1c1e3a;
        --p-danger: #ff8d8d;
        --p-danger-soft: rgba(255, 141, 141, .12);
        --p-danger-border: rgba(255, 141, 141, .30);
        --p-shadow: 0 8px 28px rgba(0, 0, 10, .28);
        --p-small-shadow: 0 2px 10px rgba(0, 0, 10, .20);
        color-scheme: dark;
    }

    .dark-mode .project-create-page .project-section-card,
    .dark-mode .project-create-page .project-summary-card {
        background: var(--p-surface);
        border-color: var(--p-border);
        box-shadow: var(--p-shadow)
    }

    .dark-mode .project-create-page .project-back-link {
        border-color: var(--p-border);
        background: var(--p-surface);
        color: var(--p-light)
    }

    .dark-mode .project-create-page .project-back-link:hover {
        border-color: var(--p-blue-border);
        background: var(--p-blue-soft);
        color: var(--p-blue-dark)
    }

    .dark-mode .project-create-page .project-page-title,
    .dark-mode .project-create-page .project-section-heading h2,
    .dark-mode .project-create-page .project-summary-header h2 {
        color: var(--p-text)
    }

    .dark-mode .project-create-page .project-header-label {
        color: var(--p-yellow-dark)
    }

    .dark-mode .project-create-page .project-page-subtitle,
    .dark-mode .project-create-page .project-section-heading p,
    .dark-mode .project-create-page .project-help-text,
    .dark-mode .project-create-page .project-summary-label,
    .dark-mode .project-create-page .project-upload-description,
    .dark-mode .project-create-page .project-file-size {
        color: var(--p-muted)
    }

    .dark-mode .project-create-page .project-class-badge {
        border-color: var(--p-blue-border);
        background: var(--p-blue-soft);
        color: var(--p-blue-dark)
    }

    .dark-mode .project-create-page .project-section-heading,
    .dark-mode .project-create-page .project-summary-header {
        border-color: var(--p-border-light)
    }

    .dark-mode .project-create-page .project-input,
    .dark-mode .project-create-page .project-select,
    .dark-mode .project-create-page .project-textarea {
        border-color: #3a3e68;
        background: #12142a;
        color: var(--p-text)
    }

    .dark-mode .project-create-page .project-input::placeholder,
    .dark-mode .project-create-page .project-textarea::placeholder {
        color: #6f72a0
    }

    .dark-mode .project-create-page .project-input:hover,
    .dark-mode .project-create-page .project-select:hover,
    .dark-mode .project-create-page .project-textarea:hover {
        border-color: #565b8d
    }

    .dark-mode .project-create-page .project-input:focus,
    .dark-mode .project-create-page .project-select:focus,
    .dark-mode .project-create-page .project-textarea:focus {
        border-color: var(--p-blue);
        box-shadow: 0 0 0 3px rgba(109, 118, 255, .16)
    }

    .dark-mode .project-create-page .project-form-label {
        color: var(--p-text-2)
    }

    .dark-mode .project-create-page .project-type-label {
        border-color: var(--p-border);
        background: #12142a
    }

    .dark-mode .project-create-page .project-type-label:hover,
    .dark-mode .project-create-page .project-type-radio:checked+.project-type-label {
        border-color: var(--p-yellow);
        background: var(--p-yellow-soft)
    }

    .dark-mode .project-create-page .project-type-title {
        color: var(--p-text-2)
    }

    .dark-mode .project-create-page .project-type-description {
        color: var(--p-muted)
    }

    .dark-mode .project-create-page .project-type-icon {
        border-color: var(--p-yellow-border);
        background: #171933;
        color: var(--p-yellow-dark)
    }

    .dark-mode .project-create-page .project-upload-area {
        border-color: var(--p-yellow-border);
        background: var(--p-yellow-soft)
    }

    .dark-mode .project-create-page .project-upload-area:hover,
    .dark-mode .project-create-page .project-upload-area.is-dragging {
        border-color: var(--p-yellow);
        background: rgba(250, 204, 21, .16)
    }

    .dark-mode .project-create-page .project-upload-icon {
        border-color: var(--p-yellow-border);
        background: #171933;
        color: var(--p-yellow-dark);
        box-shadow: var(--p-small-shadow)
    }

    .dark-mode .project-create-page .project-upload-title {
        color: var(--p-text-2)
    }

    .dark-mode .project-create-page .project-file-item {
        border-color: var(--p-border);
        background: #12142a
    }

    .dark-mode .project-create-page .project-file-icon {
        background: var(--p-yellow-soft);
        color: var(--p-yellow-dark)
    }

    .dark-mode .project-create-page .project-file-name {
        color: var(--p-text-2)
    }

    .dark-mode .project-create-page .project-summary-item {
        border-color: var(--p-border-light)
    }

    .dark-mode .project-create-page .project-summary-value {
        color: var(--p-text-2)
    }

    .dark-mode .project-create-page .project-summary-muted {
        color: var(--p-light)
    }

    .dark-mode .project-create-page .project-summary-value.project-summary-yellow {
        color: var(--p-yellow-dark)
    }

    .dark-mode .project-create-page .project-help-card {
        border-color: var(--p-yellow-border);
        background: var(--p-yellow-soft)
    }

    .dark-mode .project-create-page .project-help-card-title {
        color: var(--p-yellow-dark)
    }

    .dark-mode .project-create-page .project-help-card p {
        color: #b9b5a3
    }

    .dark-mode .project-create-page .project-actions {
        border-color: var(--p-border-light);
        background: #12142a
    }

    .dark-mode .project-create-page .project-cancel-btn {
        border-color: #3a3e68;
        background: #171933;
        color: var(--p-text-2)
    }

    .dark-mode .project-create-page .project-cancel-btn:hover {
        border-color: #565b8d;
        background: #1c1e3a
    }

    .dark-mode .project-create-page .project-btn-primary {
        border-color: var(--p-yellow);
        background: var(--p-yellow);
        color: #302000;
        box-shadow: 0 5px 14px rgba(250, 204, 21, .12)
    }

    .dark-mode .project-create-page .project-btn-primary:hover {
        border-color: #eab308;
        background: #eab308
    }

    @media(max-width:1000px) {
        .project-create-grid {
            grid-template-columns: minmax(0, 1fr) 280px
        }

        .project-page-title {
            font-size: 27px
        }
    }

    @media(max-width:820px) {
        .project-create-grid {
            grid-template-columns: 1fr
        }

        .project-summary-card {
            position: static
        }
    }

    @media(max-width:620px) {
        .project-create-page {
            padding: 20px 14px 42px
        }

        .project-header-row {
            display: block
        }

        .project-class-badge {
            display: none
        }

        .project-back-link {
            width: 39px;
            height: 39px;
            margin-bottom: 14px
        }

        .project-page-title {
            font-size: 24px
        }

        .project-page-subtitle {
            font-size: 12px
        }

        .project-section-card {
            margin-bottom: 14px;
            border-radius: 14px
        }

        .project-section-heading {
            padding: 16px
        }

        .project-section-heading h2 {
            font-size: 14px
        }

        .project-section-heading p {
            font-size: 11px
        }

        .project-section-icon {
            width: 35px;
            height: 35px;
            flex-basis: 35px;
            font-size: 17px
        }

        .project-section-card>.project-form-group,
        .project-section-card>.project-type-grid,
        .project-section-card>.project-upload-area,
        .project-section-card>.project-file-list,
        .project-section-card>.project-error,
        .project-section-card>.project-help-text {
            margin-left: 17px;
            margin-right: 17px
        }

        .project-section-card>.project-form-group:first-of-type {
            margin-top: 17px
        }

        .project-section-card>.project-form-group:last-of-type {
            margin-bottom: 17px
        }

        .project-form-row {
            grid-template-columns: 1fr;
            gap: 0;
            padding: 17px 17px 0
        }

        .project-type-grid {
            grid-template-columns: 1fr
        }

        .project-actions {
            grid-template-columns: 1fr
        }
    }

    
</style>



<div class="project-create-page">

    {{-- ============================================================
         HEADER
         ============================================================ --}}

    <div class="project-page-header">

        <a
            href="{{ route(
        'professor.class-groups.classroom-group.classwork',
        ['classGroup' => $classGroup->id]
    ) }}"
            class="project-back-link"
            title="Back to Classwork">
            <i class="bx bx-arrow-back"></i>
            <span>Back to Classwork</span>
        </a>

        <div class="project-header-row">

            <div class="project-header-main">

                <div class="project-header-label">
                    Create Project
                </div>

                <h1 class="project-page-title">
                    Create a new project
                </h1>

                <p class="project-page-subtitle">
                    Add project instructions, schedule, grading information,
                    and optional supporting files.
                </p>

            </div>

            <div class="project-class-badge">
                <i class="bx bx-chalkboard"></i>

                <span>
                    {{ $classGroup->course->course_name ?? $classGroup->group_name }}
                </span>
            </div>

        </div>

    </div>


    {{-- ============================================================
         VALIDATION ERRORS
         ============================================================ --}}

    @if ($errors->any())

    <div class="project-alert">

        <i class="bx bx-error-circle"></i>

        <div>
            <strong>Please fix the following:</strong>

            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>

    </div>

    @endif


    {{-- ============================================================
         FORM
         ============================================================ --}}

    <form
        method="POST"
        action="{{ route('professor.classworks.projects.store', $classGroup->id) }}"
        enctype="multipart/form-data"
        id="projectCreateForm">
        @csrf

        <div class="project-create-grid">

            {{-- ====================================================
                 MAIN COLUMN
                 ==================================================== --}}

            <div class="project-main-column">

                {{-- ==================================================
                     PROJECT DETAILS
                     ================================================== --}}

                <div class="project-section-card">

                    <div class="project-section-heading">

                        <div class="project-section-icon">
                            <i class="bx bx-file"></i>
                        </div>

                        <div>
                            <h2>Project Details</h2>

                            <p>
                                Provide the main information students will see.
                            </p>
                        </div>

                    </div>


                    {{-- PROJECT TITLE --}}

                    <div class="project-form-group">

                        <label
                            for="title"
                            class="project-form-label">
                            Project Title
                            <span class="project-required">*</span>
                        </label>

                        <input
                            type="text"
                            id="title"
                            name="title"
                            class="project-input @error('title') error @enderror"
                            value="{{ old('title') }}"
                            placeholder="e.g. Database Management System Project"
                            maxlength="255"
                            required>

                        @error('title')
                        <div class="project-error">
                            {{ $message }}
                        </div>
                        @enderror

                    </div>


                    {{-- DESCRIPTION --}}

                    <div class="project-form-group">

                        <label
                            for="description"
                            class="project-form-label">
                            Instructions
                        </label>

                        <textarea
                            id="description"
                            name="description"
                            class="project-textarea @error('description') error @enderror"
                            placeholder="Explain what students need to do, project requirements, deliverables, and any important instructions...">{{ old('description') }}</textarea>

                        @error('description')
                        <div class="project-error">
                            {{ $message }}
                        </div>
                        @enderror

                        <div class="project-help-text">
                            Give students enough information to understand
                            what they need to complete.
                        </div>

                    </div>


                    {{-- TOPIC --}}

                    <div class="project-form-group">

                        <label
                            for="topic_id"
                            class="project-form-label">
                            Topic
                        </label>

                        <select
                            id="topic_id"
                            name="topic_id"
                            class="project-select @error('topic_id') error @enderror">

                            <option value="">
                                No topic
                            </option>

                            @foreach ($classGroup->topics as $topic)

                            <option
                                value="{{ $topic->id }}"
                                @selected(old('topic_id')==$topic->id)
                                >
                                {{ $topic->topic_name }}
                            </option>

                            @endforeach

                        </select>

                        @error('topic_id')
                        <div class="project-error">
                            {{ $message }}
                        </div>
                        @enderror

                        <div class="project-help-text">
                            You can organize this project under a classwork topic.
                        </div>

                    </div>

                </div>


                {{-- ==================================================
                     PROJECT TYPE
                     ================================================== --}}

                <div class="project-section-card">

                    <div class="project-section-heading">

                        <div class="project-section-icon">
                            <i class="bx bx-group"></i>
                        </div>

                        <div>
                            <h2>Project Type</h2>

                            <p>
                                Choose whether students complete this project
                                individually or as a team.
                            </p>
                        </div>

                    </div>


                    <div class="project-type-grid">

                        {{-- INDIVIDUAL --}}

                        <div class="project-type-option">

                            <input
                                type="radio"
                                id="project_type_individual"
                                name="project_type"
                                value="individual"
                                class="project-type-radio"
                                @checked(old('project_type', 'individual' )==='individual' )>

                            <label
                                for="project_type_individual"
                                class="project-type-label">

                                <div class="project-type-icon">
                                    <i class="bx bx-user"></i>
                                </div>

                                <div class="project-type-content">

                                    <h3 class="project-type-title">
                                        Individual Project
                                    </h3>

                                    <p class="project-type-description">
                                        Each student completes and submits
                                        their own project.
                                    </p>

                                </div>

                            </label>

                        </div>


                        {{-- TEAM --}}

                        <div class="project-type-option">

                            <input
                                type="radio"
                                id="project_type_team"
                                name="project_type"
                                value="team"
                                class="project-type-radio"
                                @checked(old('project_type')==='team' )>

                            <label
                                for="project_type_team"
                                class="project-type-label">

                                <div class="project-type-icon">
                                    <i class="bx bx-group"></i>
                                </div>

                                <div class="project-type-content">

                                    <h3 class="project-type-title">
                                        Team Project
                                    </h3>

                                    <p class="project-type-description">
                                        Students will work together as a team.
                                        Grouping can be configured later.
                                    </p>

                                </div>

                            </label>

                        </div>

                    </div>

                    @error('project_type')
                    <div class="project-error">
                        {{ $message }}
                    </div>
                    @enderror

                </div>



                {{-- ==================================================
                     STUDENT GROUPING
                     ================================================== --}}

                <div
                    class="project-section-card project-grouping-card"
                    id="projectGroupingCard"
                    aria-hidden="true">

                    <div class="project-section-heading">
                        <div class="project-section-icon">
                            <i class="bx bx-group"></i>
                        </div>

                        <div>
                            <h2>Student Grouping</h2>
                            <p>
                                Organize enrolled students into teams for this project.
                            </p>
                        </div>
                    </div>

                    <div class="project-grouping-intro">
                        <strong>Team Project selected.</strong>
                        Choose a grouping method and the number of teams.
                        Generate a preview, review the members and roles, then create the project.
                    </div>

                    <div class="project-grouping-methods">

                        <div class="project-grouping-method">
                            <input
                                type="radio"
                                id="grouping_method_manual"
                                name="grouping_method_ui"
                                value="manual"
                                @checked(old('grouping_method_ui', 'manual' )==='manual' )>
                            <label for="grouping_method_manual">
                                <span class="project-grouping-method-icon">
                                    <i class="bx bx-user-plus"></i>
                                </span>
                                <span>
                                    <strong class="project-grouping-method-title">Manual</strong>
                                    <span class="project-grouping-method-description">
                                        Choose which students belong to each team yourself.
                                    </span>
                                </span>
                            </label>
                        </div>

                        <div class="project-grouping-method">
                            <input
                                type="radio"
                                id="grouping_method_random"
                                name="grouping_method_ui"
                                value="random"
                                @checked(old('grouping_method_ui')==='random' )>
                            <label for="grouping_method_random">
                                <span class="project-grouping-method-icon">
                                    <i class="bx bx-shuffle"></i>
                                </span>
                                <span>
                                    <strong class="project-grouping-method-title">Random</strong>
                                    <span class="project-grouping-method-description">
                                        Distribute enrolled students randomly across the teams.
                                    </span>
                                </span>
                            </label>
                        </div>

                        <div class="project-grouping-method">
                            <input
                                type="radio"
                                id="grouping_method_balanced"
                                name="grouping_method_ui"
                                value="balanced"
                                @checked(old('grouping_method_ui')==='balanced' )>
                            <label for="grouping_method_balanced">
                                <span class="project-grouping-method-icon">
                                    <i class="bx bx-bar-chart-alt-2"></i>
                                </span>
                                <span>
                                    <strong class="project-grouping-method-title">Balanced</strong>
                                    <span class="project-grouping-method-description">
                                        Create teams with similar course performance levels.
                                    </span>
                                </span>
                            </label>
                        </div>

                    </div>

                    <div class="project-group-count-row">
                        <div class="project-group-count-control">
                            <div class="project-form-group">
                                <label for="group_count_ui" class="project-form-label">
                                    Number of Groups
                                </label>

                                <select id="group_count_ui" class="project-group-count-select">
                                    @for($i = 2; $i <= 10; $i++)
                                        <option value="{{ $i }}" @selected(old('group_count_ui', 4)==$i)>
                                        {{ $i }} {{ $i === 1 ? 'Group' : 'Groups' }}
                                        </option>
                                        @endfor
                                </select>
                            </div>
                        </div>

                        <button
                            type="button"
                            class="project-generate-groups-btn"
                            id="generateGroupsPreview">
                            <i class="bx bx-layer-plus"></i>
                            <span>Generate Groups</span>
                        </button>
                    </div>

                    <div class="project-manual-builder" id="projectManualBuilder">
                        <div class="project-manual-builder-header">
                            <div>
                                <h3>Build Your Teams</h3>
                                <p>Create empty teams, then add students to each team.</p>
                            </div>
                            <span class="project-groups-preview-count" id="projectManualUnassignedBadge">0 unassigned</span>
                        </div>

                        <div class="project-manual-team-grid" id="projectManualTeamGrid"></div>

                        <div class="project-manual-unassigned" id="projectManualUnassignedText">
                            <strong>0 students</strong> are unassigned.
                        </div>
                    </div>

<div class="project-grouping-status" id="projectGroupingStatus"></div>

                    <div class="project-groups-preview" id="projectGroupsPreview" hidden>

                        <div class="project-groups-preview-header">
                            <div>
                                <span class="project-groups-preview-eyebrow">
                                    <i class="bx bx-group"></i>
                                    Group Preview
                                </span>
                                <h3>Generated Teams</h3>
                                <p>Review the teams and roles before creating the project.</p>
                            </div>

                            <div class="project-groups-preview-count" id="projectGroupsPreviewCount">
                                0 Teams
                            </div>
                        </div>

                        <div class="project-groups-preview-grid" id="projectGroupsPreviewGrid"></div>

                        <div class="project-groups-preview-footer">
                            <i class="bx bx-info-circle"></i>
                            <span>
                                Performance is used only by Balanced grouping. Students without performance data are not treated as zero.
                            </span>
                        </div>
                    </div>

                    <div class="project-grouping-note">
                        <i class="bx bx-info-circle"></i>
                        <span>
                            Generating groups creates a preview only. Teams are saved when you click Create Project.
                        </span>
                    </div>

                </div>


                {{-- ==================================================
                     SCHEDULE & GRADING
                     ================================================== --}}

                <div class="project-section-card">

                    <div class="project-section-heading">

                        <div class="project-section-icon">
                            <i class="bx bx-calendar-check"></i>
                        </div>

                        <div>
                            <h2>Schedule & Grading</h2>

                            <p>
                                Set the deadline and total points for this project.
                            </p>
                        </div>

                    </div>


                    <div class="project-form-row">

                        {{-- DUE DATE --}}

                        <div class="project-form-group">

                            <label
                                for="due_date"
                                class="project-form-label">
                                Due Date
                            </label>

                            <input
                                type="date"
                                id="due_date"
                                name="due_date"
                                class="project-input @error('due_date') error @enderror"
                                value="{{ old('due_date') }}">

                            @error('due_date')
                            <div class="project-error">
                                {{ $message }}
                            </div>
                            @enderror

                        </div>


                        {{-- DUE TIME --}}

                        <div class="project-form-group">

                            <label
                                for="due_time"
                                class="project-form-label">
                                Due Time
                            </label>

                            <input
                                type="time"
                                id="due_time"
                                name="due_time"
                                class="project-input @error('due_time') error @enderror"
                                value="{{ old('due_time') }}">

                            @error('due_time')
                            <div class="project-error">
                                {{ $message }}
                            </div>
                            @enderror

                        </div>

                    </div>


                    {{-- POINTS --}}

                    <div class="project-form-group">

                        <label
                            for="points"
                            class="project-form-label">
                            Total Points
                            <span class="project-required">*</span>
                        </label>

                        <input
                            type="number"
                            id="points"
                            name="points"
                            class="project-input @error('points') error @enderror"
                            value="{{ old('points', 100) }}"
                            min="0"
                            max="99999999"
                            step="0.01"
                            required>

                        @error('points')
                        <div class="project-error">
                            {{ $message }}
                        </div>
                        @enderror

                        <div class="project-help-text">
                            The maximum score students can receive for this project.
                        </div>

                    </div>

                </div>


                {{-- ==================================================
                     ATTACHMENTS
                     ================================================== --}}

                <div class="project-section-card">

                    <div class="project-section-heading">

                        <div class="project-section-icon">
                            <i class="bx bx-paperclip"></i>
                        </div>

                        <div>
                            <h2>Attachments</h2>

                            <p>
                                Add files that students may need for the project.
                            </p>
                        </div>

                    </div>


                    <div
                        class="project-upload-area"
                        id="projectUploadArea">

                        <input
                            type="file"
                            id="attachments"
                            name="attachments[]"
                            class="project-file-input"
                            multiple>

                        <label
                            for="attachments"
                            class="project-upload-content">

                            <div class="project-upload-icon">
                                <i class="bx bx-cloud-upload"></i>
                            </div>

                            <p class="project-upload-title">
                                Drag & drop files here or
                                <span>browse</span>
                            </p>

                            <p class="project-upload-description">
                                You can select multiple files.
                                Maximum 100 MB per file.
                            </p>

                        </label>

                    </div>


                    <div
                        class="project-file-list"
                        id="projectFileList"></div>

                    @error('attachments')
                    <div class="project-error">
                        {{ $message }}
                    </div>
                    @enderror

                    @error('attachments.*')
                    <div class="project-error">
                        {{ $message }}
                    </div>
                    @enderror

                </div>


                {{-- ==================================================
                     ACTIONS
                     ================================================== --}}



            </div>


            {{-- ====================================================
                 SIDEBAR
                 ==================================================== --}}

            <aside class="project-sidebar">

                <div class="project-summary-card">

                    <div class="project-summary-header">

                        <div class="project-summary-icon">
                            <i class="bx bx-list-check"></i>
                        </div>

                        <h2>Project Summary</h2>

                    </div>


                    <div class="project-summary-list">

                        {{-- CLASS --}}

                        <div class="project-summary-item">

                            <span class="project-summary-label">
                                Class
                            </span>

                            <span
                                class="project-summary-value"
                                title="{{ $classGroup->course->course_name ?? $classGroup->group_name }}">
                                {{ $classGroup->course->course_name ?? $classGroup->group_name }}
                            </span>

                        </div>


                        {{-- TITLE --}}

                        <div class="project-summary-item">

                            <span class="project-summary-label">
                                Title
                            </span>

                            <span
                                class="project-summary-value project-summary-muted"
                                id="summaryTitle"
                                title="Not set">
                                Not set
                            </span>

                        </div>


                        {{-- TOPIC --}}

                        <div class="project-summary-item">

                            <span class="project-summary-label">
                                Topic
                            </span>

                            <span
                                class="project-summary-value project-summary-muted"
                                id="summaryTopic">
                                No topic
                            </span>

                        </div>


                        {{-- TYPE --}}

                        <div class="project-summary-item">

                            <span class="project-summary-label">
                                Type
                            </span>

                            <span
                                class="project-summary-value"
                                id="summaryType">
                                Individual
                            </span>

                        </div>


                        {{-- POINTS --}}

                        <div class="project-summary-item">

                            <span class="project-summary-label">
                                Points
                            </span>

                            <span
                                class="project-summary-value"
                                id="summaryPoints">
                                100
                            </span>

                        </div>


                        {{-- ATTACHMENTS --}}

                        <div class="project-summary-item">

                            <span class="project-summary-label">
                                Attachments
                            </span>

                            <span
                                class="project-summary-value"
                                id="summaryFiles">
                                0 files
                            </span>

                        </div>

                    </div>



                    <div class="project-help-card">

                        <div class="project-help-card-title">
                            <i class="bx bx-info-circle"></i>
                            <span>Good to know</span>
                        </div>

                        <p>
                            Team Project only determines that the project
                            will use teams. Student grouping will be configured
                            separately in the next stage.
                        </p>

                    </div>

                    <div class="project-actions">

                        <a
                            href="{{ route(
                            'professor.class-groups.classroom-group.classwork',
                            ['classGroup' => $classGroup->id]
                        ) }}"
                            class="project-cancel-btn">
                            Cancel
                        </a>

                        <button
                            type="submit"
                            class="project-btn project-btn-primary">
                            <i class="bx bx-plus"></i>
                            Create Project
                        </button>

                    </div>
                </div>






            </aside>

        </div>

    </form>

</div>


<!-- Manual student picker -->
<div class="project-student-picker" id="projectStudentPicker" aria-hidden="true">
    <div class="project-student-picker-dialog" role="dialog" aria-modal="true" aria-labelledby="projectStudentPickerTitle">
        <div class="project-student-picker-header">
            <div>
                <h3 id="projectStudentPickerTitle">Add Students</h3>
                <p id="projectStudentPickerSubtitle">Select students for this team.</p>
            </div>
            <button type="button" class="project-student-picker-close" id="projectStudentPickerClose" aria-label="Close">
                <i class="bx bx-x"></i>
            </button>
        </div>
        <div class="project-student-picker-list" id="projectStudentPickerList"></div>
        <div class="project-student-picker-footer">
            <button type="button" class="project-student-picker-cancel" id="projectStudentPickerCancel">Cancel</button>
            <button type="button" class="project-student-picker-add" id="projectStudentPickerAdd">Save Students</button>
        </div>
    </div>
</div>

@php
    // Use the students already attached to this class group.
    // This keeps Manual in sync with the same enrolled-student roster
    // used throughout the classroom and avoids another relationship query.
    $groupingStudents = $classGroup->students
        ->sortBy('name')
        ->map(function ($student) {
            return [
                'user_id' => $student->id,
                'name' => $student->name,
                'profile_image' => $student->profile_image ?? null,
            ];
        })
        ->values()
        ->all();
@endphp

<div
    id="projectGroupingStudentData"
    data-students='{{ json_encode($groupingStudents, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_AMP | JSON_HEX_QUOT) }}'
    hidden></div>

<script>
document.addEventListener('DOMContentLoaded', function () {

    /* ============================================================
       ELEMENTS
       ============================================================ */

    const titleInput =
        document.getElementById('title');

    const topicSelect =
        document.getElementById('topic_id');

    const pointsInput =
        document.getElementById('points');

    const summaryTitle =
        document.getElementById('summaryTitle');

    const summaryTopic =
        document.getElementById('summaryTopic');

    const summaryType =
        document.getElementById('summaryType');

    const summaryPoints =
        document.getElementById('summaryPoints');

    const summaryFiles =
        document.getElementById('summaryFiles');

    const fileInput =
        document.getElementById('attachments');

    const uploadArea =
        document.getElementById('projectUploadArea');

    const fileList =
        document.getElementById('projectFileList');

    const projectCreateForm =
        document.getElementById('projectCreateForm');

    const projectGroupingCard =
        document.getElementById('projectGroupingCard');

    const generateGroupsButton =
        document.getElementById('generateGroupsPreview');

    const projectGroupingStatus =
        document.getElementById('projectGroupingStatus');

    const projectGroupsPreview =
        document.getElementById('projectGroupsPreview');

    const projectGroupsPreviewGrid =
        document.getElementById('projectGroupsPreviewGrid');

    const projectGroupsPreviewCount =
        document.getElementById('projectGroupsPreviewCount');

    const groupCountSelect =
        document.getElementById('group_count_ui');

    const projectManualBuilder =
        document.getElementById('projectManualBuilder');

    const projectManualTeamGrid =
        document.getElementById('projectManualTeamGrid');

    const projectManualUnassignedBadge =
        document.getElementById('projectManualUnassignedBadge');

    const projectManualUnassignedText =
        document.getElementById('projectManualUnassignedText');

    const projectStudentPicker =
        document.getElementById('projectStudentPicker');

    const projectStudentPickerList =
        document.getElementById('projectStudentPickerList');

    const projectStudentPickerTitle =
        document.getElementById('projectStudentPickerTitle');

    const projectStudentPickerSubtitle =
        document.getElementById('projectStudentPickerSubtitle');

    const projectStudentPickerClose =
        document.getElementById('projectStudentPickerClose');

    const projectStudentPickerCancel =
        document.getElementById('projectStudentPickerCancel');

    const projectStudentPickerAdd =
        document.getElementById('projectStudentPickerAdd');


    /* ============================================================
       FILE MANAGEMENT
       ============================================================ */

    let selectedFiles = [];


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

        const index = Math.floor(
            Math.log(bytes) / Math.log(1024)
        );

        return (
            parseFloat(
                (
                    bytes /
                    Math.pow(1024, index)
                ).toFixed(2)
            ) +
            ' ' +
            units[index]
        );
    }


    function escapeHtml(value) {

        return String(value ?? '')
            .replace(/&/g, '&amp;')
            .replace(/</g, '&lt;')
            .replace(/>/g, '&gt;')
            .replace(/"/g, '&quot;')
            .replace(/'/g, '&#039;');
    }


    function syncInputFiles() {

        if (!fileInput) {
            return;
        }

        const dataTransfer =
            new DataTransfer();

        selectedFiles.forEach(function (file) {
            dataTransfer.items.add(file);
        });

        fileInput.files =
            dataTransfer.files;
    }


    function renderFiles() {

        if (!fileList) {
            return;
        }

        fileList.innerHTML = '';


        selectedFiles.forEach(
            function (file, index) {

                const item =
                    document.createElement('div');

                item.className =
                    'project-file-item';

                item.innerHTML = `
                    <div class="project-file-icon">
                        <i class="bx bx-file"></i>
                    </div>

                    <div class="project-file-info">

                        <p
                            class="project-file-name"
                            title="${escapeHtml(file.name)}"
                        >
                            ${escapeHtml(file.name)}
                        </p>

                        <p class="project-file-size">
                            ${formatFileSize(file.size)}
                        </p>

                    </div>

                    <button
                        type="button"
                        class="project-file-remove"
                        data-index="${index}"
                        aria-label="Remove ${escapeHtml(file.name)}"
                    >
                        <i class="bx bx-x"></i>
                    </button>
                `;

                fileList.appendChild(item);
            }
        );


        if (summaryFiles) {

            summaryFiles.textContent =
                selectedFiles.length +
                (
                    selectedFiles.length === 1
                        ? ' file'
                        : ' files'
                );
        }


        syncInputFiles();
    }


    function addFiles(files) {

        Array.from(files || []).forEach(
            function (file) {

                const exists =
                    selectedFiles.some(
                        function (existingFile) {

                            return (
                                existingFile.name ===
                                    file.name &&

                                existingFile.size ===
                                    file.size &&

                                existingFile.lastModified ===
                                    file.lastModified
                            );
                        }
                    );

                if (!exists) {
                    selectedFiles.push(file);
                }
            }
        );

        renderFiles();
    }


    if (fileInput) {

        fileInput.addEventListener(
            'change',
            function () {
                addFiles(this.files);
            }
        );
    }


    if (fileList) {

        fileList.addEventListener(
            'click',
            function (event) {

                const removeButton =
                    event.target.closest(
                        '.project-file-remove'
                    );

                if (!removeButton) {
                    return;
                }

                const index =
                    Number(
                        removeButton.dataset.index
                    );

                selectedFiles.splice(
                    index,
                    1
                );

                renderFiles();
            }
        );
    }


    if (uploadArea) {

        uploadArea.addEventListener(
            'dragover',
            function (event) {

                event.preventDefault();

                uploadArea.classList.add(
                    'drag-over'
                );
            }
        );


        uploadArea.addEventListener(
            'dragleave',
            function () {

                uploadArea.classList.remove(
                    'drag-over'
                );
            }
        );


        uploadArea.addEventListener(
            'drop',
            function (event) {

                event.preventDefault();

                uploadArea.classList.remove(
                    'drag-over'
                );

                addFiles(
                    event.dataTransfer.files
                );
            }
        );
    }


    /* ============================================================
       SUMMARY
       ============================================================ */

    function updateTitleSummary() {

        if (!titleInput || !summaryTitle) {
            return;
        }

        const title =
            titleInput.value.trim();

        if (title.length > 0) {

            summaryTitle.textContent =
                title;

            summaryTitle.classList.remove(
                'project-summary-muted'
            );

            summaryTitle.title =
                title;

        } else {

            summaryTitle.textContent =
                'Not set';

            summaryTitle.classList.add(
                'project-summary-muted'
            );

            summaryTitle.title =
                'Not set';
        }
    }


    function updateTopicSummary() {

        if (!topicSelect || !summaryTopic) {
            return;
        }

        const selectedOption =
            topicSelect.options[
                topicSelect.selectedIndex
            ];


        if (
            topicSelect.value &&
            selectedOption
        ) {

            summaryTopic.textContent =
                selectedOption.textContent.trim();

            summaryTopic.classList.remove(
                'project-summary-muted'
            );

        } else {

            summaryTopic.textContent =
                'No topic';

            summaryTopic.classList.add(
                'project-summary-muted'
            );
        }
    }


    function updateTypeSummary() {

        if (!summaryType) {
            return;
        }

        const selectedType =
            document.querySelector(
                'input[name="project_type"]:checked'
            );


        if (!selectedType) {

            summaryType.textContent =
                'Individual';

            return;
        }


        summaryType.textContent =
            selectedType.value === 'team'
                ? 'Team Project'
                : 'Individual';
    }


    function updatePointsSummary() {

        if (!pointsInput || !summaryPoints) {
            return;
        }

        const points =
            pointsInput.value.trim();

        summaryPoints.textContent =
            points !== ''
                ? points
                : '0';
    }


    if (titleInput) {

        titleInput.addEventListener(
            'input',
            updateTitleSummary
        );
    }


    if (topicSelect) {

        topicSelect.addEventListener(
            'change',
            updateTopicSummary
        );
    }


    if (pointsInput) {

        pointsInput.addEventListener(
            'input',
            updatePointsSummary
        );
    }


    /* ============================================================
       GROUP FORM HELPERS
       ============================================================ */

    function clearGeneratedGroupInputs() {

        document
            .querySelectorAll(
                '.project-generated-group-input'
            )
            .forEach(function (input) {
                input.remove();
            });
    }


    function addGeneratedGroupInput(
        name,
        value
    ) {

        if (!projectCreateForm) {
            return;
        }

        const input =
            document.createElement('input');

        input.type =
            'hidden';

        input.name =
            name;

        input.value =
            value ?? '';

        input.className =
            'project-generated-group-input';

        projectCreateForm.appendChild(
            input
        );
    }


    function syncGroupsToForm(groups) {

        clearGeneratedGroupInputs();

        (
            groups || []
        ).forEach(
            function (group, groupIndex) {

                addGeneratedGroupInput(
                    `groups[${groupIndex}][group_number]`,
                    group.group_number ??
                    groupIndex + 1
                );

                addGeneratedGroupInput(
                    `groups[${groupIndex}][group_name]`,
                    group.group_name ??
                    `Team ${groupIndex + 1}`
                );


                (
                    group.members || []
                ).forEach(
                    function (
                        member,
                        memberIndex
                    ) {

                        addGeneratedGroupInput(
                            `groups[${groupIndex}][members][${memberIndex}][user_id]`,
                            member.user_id ??
                            member.id ??
                            member.user?.id
                        );

                        addGeneratedGroupInput(
                            `groups[${groupIndex}][members][${memberIndex}][role]`,
                            member.role ||
                            'member'
                        );
                    }
                );
            }
        );
    }


    /* ============================================================
       MEMBER HELPERS
       ============================================================ */

    function getMemberId(member) {

        return (
            member?.user_id ??
            member?.id ??
            member?.user?.id ??
            ''
        );
    }


    function getMemberName(member) {

        return (
            member?.name ||
            member?.user_name ||
            member?.user?.name ||
            'Student'
        );
    }


    function getMemberImage(member) {

        return (
            member?.profile_image ||
            member?.user?.profile_image ||
            null
        );
    }


    function getMemberPerformance(member) {

        const value =
            member?.performance ??
            member?.average ??
            member?.performance_average ??
            null;

        return (
            value === null ||
            value === ''
        )
            ? null
            : Number(value);
    }


    function getInitial(name) {

        return name
            ? name.trim()
                .charAt(0)
                .toUpperCase()
            : '?';
    }


    /* ============================================================
       NORMALIZE GROUPS
       ============================================================ */

    function normalizeGroups(groups) {

        return (groups || []).map(
            function (group, index) {

                return {

                    group_number:
                        group.group_number ??
                        index + 1,

                    group_name:
                        group.group_name ??
                        `Team ${index + 1}`,

                    average:
                        group.average ??
                        group.group_average ??
                        null,

                    members:
                        (
                            group.members || []
                        ).map(
                            function (member) {

                                return {

                                    ...member,

                                    user_id:
                                        getMemberId(
                                            member
                                        ),

                                    name:
                                        getMemberName(
                                            member
                                        ),

                                    profile_image:
                                        getMemberImage(
                                            member
                                        ),

                                    performance:
                                        getMemberPerformance(
                                            member
                                        ),

                                    role:
                                        member.role ||
                                        'member'
                                };
                            }
                        )
                };
            }
        );
    }


    /* ============================================================
       DEFAULT TEAM ROLES
       ============================================================ */

    function applyDefaultRoles(groups) {

        return (
            groups || []
        ).map(
            function (group) {

                const members =
                    group.members || [];


                let leaderFound =
                    false;


                members.forEach(
                    function (member) {

                        if (
                            member.role ===
                            'leader'
                        ) {

                            if (leaderFound) {
                                member.role =
                                    'member';
                            } else {
                                leaderFound =
                                    true;
                            }
                        }
                    }
                );


                let backupFound =
                    false;


                members.forEach(
                    function (member) {

                        if (
                            member.role ===
                            'backup'
                        ) {

                            if (backupFound) {

                                member.role =
                                    'member';

                            } else {

                                backupFound =
                                    true;
                            }
                        }
                    }
                );


                if (
                    members.length > 0 &&
                    !leaderFound
                ) {

                    members[0].role =
                        'leader';
                }


                if (
                    members.length > 1 &&
                    !backupFound
                ) {

                    const backupMember =
                        members.find(
                            function (member) {

                                return (
                                    member.role !==
                                    'leader'
                                );
                            }
                        );


                    if (backupMember) {

                        backupMember.role =
                            'backup';
                    }
                }


                return group;
            }
        );
    }


    /* ============================================================
       RENDER PREVIEW
       ============================================================ */

    function renderGroups(
        groups,
        options
    ) {

        if (
            !projectGroupsPreviewGrid ||
            !projectGroupsPreview
        ) {
            return;
        }


        const settings =
            options || {};


        const showPerformance =
            settings.showPerformance === true;


        projectGroupsPreviewGrid.innerHTML =
            '';


        if (projectGroupsPreviewCount) {

            projectGroupsPreviewCount.textContent =
                `${groups.length} ${
                    groups.length === 1
                        ? 'Team'
                        : 'Teams'
                }`;
        }


        (
            groups || []
        ).forEach(
            function (group) {

                const team =
                    document.createElement('div');

                team.className =
                    'project-preview-team';


                const members =
                    group.members || [];


                let membersHtml =
                    '';


                members.forEach(
                    function (member) {

                        const name =
                            getMemberName(
                                member
                            );

                        const image =
                            getMemberImage(
                                member
                            );

                        const performance =
                            getMemberPerformance(
                                member
                            );

                        const memberId =
                            getMemberId(
                                member
                            );

                        const role =
                            member.role ||
                            'member';


                        let imageHtml =
                            escapeHtml(
                                getInitial(
                                    name
                                )
                            );


                        if (image) {

                            imageHtml = `
                                <img
                                    src="/storage/${escapeHtml(image)}"
                                    alt="${escapeHtml(name)}"
                                >
                            `;
                        }


                        const performanceHtml =
                            showPerformance

                                ? `
                                    <span
                                        class="project-preview-member-performance"
                                    >
                                        ${
                                            performance !== null &&
                                            !Number.isNaN(
                                                performance
                                            )
                                                ? `${performance.toFixed(1)}% Performance`
                                                : 'No performance data'
                                        }
                                    </span>
                                `

                                : '';


                        membersHtml += `

                            <div
                                class="project-preview-member"
                            >

                                <div
                                    class="project-preview-avatar"
                                >
                                    ${imageHtml}
                                </div>


                                <div
                                    class="project-preview-member-info"
                                >

                                    <span
                                        class="project-preview-member-name"
                                        title="${escapeHtml(name)}"
                                    >
                                        ${escapeHtml(name)}
                                    </span>

                                    ${performanceHtml}

                                </div>


                                <select
                                    class="project-preview-role"
                                    data-group-number="${escapeHtml(group.group_number)}"
                                    data-member-id="${escapeHtml(memberId)}"
                                >

                                    <option
                                        value="member"
                                        ${role === 'member'
                                            ? 'selected'
                                            : ''}
                                    >
                                        Member
                                    </option>

                                    <option
                                        value="leader"
                                        ${role === 'leader'
                                            ? 'selected'
                                            : ''}
                                    >
                                        Leader
                                    </option>

                                    <option
                                        value="backup"
                                        ${role === 'backup'
                                            ? 'selected'
                                            : ''}
                                    >
                                        Backup
                                    </option>

                                </select>

                            </div>

                        `;
                    }
                );


                let averageBlock =
                    '';


                if (showPerformance) {

                    const average =
                        group.average === null ||
                        group.average === undefined
                            ? null
                            : Number(
                                group.average
                            );


                    const averageText =
                        average !== null &&
                        !Number.isNaN(average)
                            ? `${average.toFixed(1)}%`
                            : 'No data';


                    averageBlock = `
                        <div
                            class="project-preview-average"
                        >
                            <span>
                                Team Average
                            </span>

                            <strong>
                                ${averageText}
                            </strong>
                        </div>
                    `;
                }


                team.innerHTML = `

                    <div
                        class="project-preview-team-header"
                    >

                        <div
                            class="project-preview-team-title"
                        >

                            <div
                                class="project-preview-team-icon"
                            >
                                <i class="bx bx-group"></i>
                            </div>

                            <strong>
                                ${escapeHtml(
                                    group.group_name
                                )}
                            </strong>

                        </div>


                        <span
                            class="project-preview-team-count"
                        >
                            ${members.length}

                            ${
                                members.length === 1
                                    ? 'Member'
                                    : 'Members'
                            }
                        </span>

                    </div>


                    <div
                        class="project-preview-members"
                    >

                        ${
                            membersHtml ||

                            `
                                <div
                                    class="project-preview-member"
                                >
                                    <div
                                        class="project-preview-member-info"
                                    >
                                        <span
                                            class="project-preview-member-name"
                                        >
                                            No students assigned yet.
                                        </span>
                                    </div>
                                </div>
                            `
                        }

                    </div>


                    ${averageBlock}

                `;


                projectGroupsPreviewGrid.appendChild(
                    team
                );
            }
        );


        projectGroupsPreview.hidden =
            false;
    }


    /* ============================================================
       ROLE CHANGE
       ============================================================ */

    function updateGroupMemberRole(
        groupNumber,
        memberId,
        role
    ) {

        const groups =
            window.projectGeneratedGroups ||
            [];


        const group =
            groups.find(
                function (item) {

                    return (
                        String(
                            item.group_number
                        ) ===
                        String(
                            groupNumber
                        )
                    );
                }
            );


        if (!group) {
            return;
        }


        const member =
            (
                group.members || []
            ).find(
                function (item) {

                    return (
                        String(
                            getMemberId(item)
                        ) ===
                        String(memberId)
                    );
                }
            );


        if (!member) {
            return;
        }


        member.role =
            role;


        if (
            role === 'leader' ||
            role === 'backup'
        ) {

            (
                group.members || []
            ).forEach(
                function (item) {

                    if (
                        String(
                            getMemberId(item)
                        ) ===
                        String(memberId)
                    ) {
                        return;
                    }


                    if (
                        item.role ===
                        role
                    ) {

                        item.role =
                            'member';
                    }
                }
            );
        }


        syncGroupsToForm(
            groups
        );


        renderGroups(
            groups,
            {
                showPerformance:
                    document.querySelector(
                        'input[name="grouping_method_ui"]:checked'
                    )?.value ===
                    'balanced'
            }
        );
    }


    if (projectGroupsPreviewGrid) {

        projectGroupsPreviewGrid.addEventListener(
            'change',
            function (event) {

                const roleSelect =
                    event.target.closest(
                        '.project-preview-role'
                    );


                if (!roleSelect) {
                    return;
                }


                updateGroupMemberRole(
                    roleSelect.dataset.groupNumber,
                    roleSelect.dataset.memberId,
                    roleSelect.value
                );
            }
        );
    }


    /* ============================================================
       PROJECT TYPE
       ============================================================ */

    function updateGroupingVisibility() {

        if (!projectGroupingCard) {
            return;
        }


        const selectedType =
            document.querySelector(
                'input[name="project_type"]:checked'
            );


        const isTeamProject =
            selectedType &&
            selectedType.value ===
                'team';


        projectGroupingCard.classList.toggle(
            'is-visible',
            isTeamProject
        );


        projectGroupingCard.setAttribute(
            'aria-hidden',
            isTeamProject
                ? 'false'
                : 'true'
        );


        if (!isTeamProject) {

            clearGeneratedGroupInputs();

            window.projectGeneratedGroups =
                [];

            if (projectGroupsPreview) {
                projectGroupsPreview.hidden =
                    true;
            }

            if (projectGroupsPreviewGrid) {
                projectGroupsPreviewGrid.innerHTML =
                    '';
            }

            if (projectGroupingStatus) {
                projectGroupingStatus.classList.remove(
                    'is-visible'
                );
            }

            if (projectManualBuilder) {
                projectManualBuilder.classList.remove(
                    'is-visible'
                );
            }
        }
    }


    document
        .querySelectorAll(
            'input[name="project_type"]'
        )
        .forEach(
            function (radio) {

                radio.addEventListener(
                    'change',
                    function () {

                        updateTypeSummary();

                        updateGroupingVisibility();

                        updateGroupingControls();
                    }
                );
            }
        );


    /* ============================================================
       STUDENT DATA
       ============================================================ */

    const studentDataElement =
        document.getElementById(
            'projectGroupingStudentData'
        );


    let enrolledStudents =
        [];


    try {

        enrolledStudents =
            studentDataElement

                ? JSON.parse(
                    studentDataElement.dataset.students ||
                    '[]'
                )

                : [];

    } catch (error) {

        console.error(
            'Unable to read enrolled students:',
            error
        );

        enrolledStudents =
            [];
    }


    /* ============================================================
       MANUAL STATE
       ============================================================ */

    let activeManualTeamIndex =
        null;


    window.projectGeneratedGroups =
        [];


    function getAssignedStudentIds() {

        const ids =
            new Set();


        (
            window.projectGeneratedGroups ||
            []
        ).forEach(
            function (group) {

                (
                    group.members ||
                    []
                ).forEach(
                    function (member) {

                        ids.add(
                            String(
                                getMemberId(
                                    member
                                )
                            )
                        );
                    }
                );
            }
        );


        return ids;
    }


    /* ============================================================
       MANUAL → CREATE EMPTY GROUPS
       ============================================================ */

    function createEmptyManualGroups(
        groupCount
    ) {

        const groups =
            [];


        for (
            let index = 0;
            index < groupCount;
            index++
        ) {

            groups.push({

                group_number:
                    index + 1,

                group_name:
                    `Team ${index + 1}`,

                average:
                    null,

                members:
                    []
            });
        }


        window.projectGeneratedGroups =
            groups;


        clearGeneratedGroupInputs();


        if (projectGroupsPreview) {

            projectGroupsPreview.hidden =
                true;
        }


        if (projectGroupsPreviewGrid) {

            projectGroupsPreviewGrid.innerHTML =
                '';
        }


        renderManualBuilder();


        if (projectManualBuilder) {

            projectManualBuilder.classList.add(
                'is-visible'
            );
        }


        if (projectGroupingStatus) {

            projectGroupingStatus.classList.add(
                'is-visible'
            );

            projectGroupingStatus.textContent =
                'Empty teams created. Add students to each team.';
        }
    }


    /* ============================================================
       RENDER MANUAL BUILDER
       ============================================================ */

    function renderManualBuilder() {

        if (
            !projectManualBuilder ||
            !projectManualTeamGrid
        ) {
            return;
        }


        const groups =
            window.projectGeneratedGroups ||
            [];


        projectManualTeamGrid.innerHTML =
            '';


        if (!groups.length) {

            projectManualBuilder.classList.remove(
                'is-visible'
            );

            return;
        }


        const assignedIds =
            getAssignedStudentIds();


        const unassignedCount =
            Math.max(
                enrolledStudents.length -
                assignedIds.size,
                0
            );


        if (projectManualUnassignedBadge) {

            projectManualUnassignedBadge.textContent =
                `${unassignedCount} unassigned`;
        }


        if (projectManualUnassignedText) {

            projectManualUnassignedText.innerHTML =
                `
                    <strong>
                        ${unassignedCount}
                        ${
                            unassignedCount === 1
                                ? 'student'
                                : 'students'
                        }
                    </strong>
                    are unassigned.
                `;
        }


        groups.forEach(
            function (group, teamIndex) {

                const members =
                    group.members || [];


                const card =
                    document.createElement(
                        'div'
                    );


                card.className =
                    'project-manual-team';


                const memberRows =
                    members.map(
                        function (member) {

                            return `
                                <div
                                    class="project-manual-student-row"
                                >

                                    <span
                                        title="${escapeHtml(
                                            getMemberName(member)
                                        )}"
                                    >
                                        ${escapeHtml(
                                            getMemberName(member)
                                        )}
                                    </span>


                                    <button
                                        type="button"
                                        class="project-manual-remove-student"
                                        data-team-index="${teamIndex}"
                                        data-student-id="${escapeHtml(
                                            getMemberId(member)
                                        )}"
                                        title="Remove student"
                                    >
                                        <i class="bx bx-x"></i>
                                    </button>

                                </div>
                            `;
                        }
                    ).join('');


                card.innerHTML = `

                    <div
                        class="project-manual-team-head"
                    >

                        <strong>
                            ${escapeHtml(
                                group.group_name
                            )}
                        </strong>


                        <span
                            class="project-manual-team-count"
                        >
                            ${members.length}

                            ${
                                members.length === 1
                                    ? 'student'
                                    : 'students'
                            }

                        </span>

                    </div>


                    <div
                        class="project-manual-team-body"
                    >

                        <div
                            class="project-manual-student-list"
                        >

                            ${
                                memberRows ||

                                `
                                    <div
                                        class="project-manual-empty"
                                    >
                                        No students assigned yet.
                                    </div>
                                `
                            }

                        </div>


                        <button
                            type="button"
                            class="project-manual-add-btn"
                            data-team-index="${teamIndex}"
                        >
                            <i class="bx bx-user-plus"></i>
                            Add Students
                        </button>

                    </div>

                `;


                projectManualTeamGrid.appendChild(
                    card
                );
            }
        );


        projectManualTeamGrid
            .querySelectorAll(
                '.project-manual-add-btn'
            )
            .forEach(
                function (button) {

                    button.addEventListener(
                        'click',
                        function (event) {

                            event.preventDefault();


                            openStudentPicker(
                                Number(
                                    button.dataset.teamIndex
                                )
                            );
                        }
                    );
                }
            );


        projectManualTeamGrid
            .querySelectorAll(
                '.project-manual-remove-student'
            )
            .forEach(
                function (button) {

                    button.addEventListener(
                        'click',
                        function (event) {

                            event.preventDefault();


                            const teamIndex =
                                Number(
                                    button.dataset.teamIndex
                                );


                            const studentId =
                                String(
                                    button.dataset.studentId
                                );


                            const group =
                                window.projectGeneratedGroups[
                                    teamIndex
                                ];


                            if (!group) {
                                return;
                            }


                            group.members =
                                (
                                    group.members || []
                                ).filter(
                                    function (member) {

                                        return (
                                            String(
                                                getMemberId(
                                                    member
                                                )
                                            ) !==
                                            studentId
                                        );
                                    }
                                );


                            applyDefaultRoles([
                                group
                            ]);


                            renderManualBuilder();


                            syncGroupsToForm(
                                window.projectGeneratedGroups
                            );


                            renderGroups(
                                window.projectGeneratedGroups,
                                {
                                    showPerformance:
                                        false
                                }
                            );
                        }
                    );
                }
            );


        syncGroupsToForm(
            groups
        );
    }


    /* ============================================================
       OPEN STUDENT PICKER
       ============================================================ */

    function openStudentPicker(
        teamIndex
    ) {

        const group =
            window.projectGeneratedGroups[
                teamIndex
            ];


        if (
            !group ||
            !projectStudentPicker ||
            !projectStudentPickerList
        ) {
            return;
        }


        activeManualTeamIndex =
            teamIndex;


        if (projectStudentPickerTitle) {

            projectStudentPickerTitle.textContent =
                `Add Students to ${group.group_name}`;
        }


        if (projectStudentPickerSubtitle) {

            projectStudentPickerSubtitle.textContent =
                'Select students who are not assigned to another team.';
        }


        projectStudentPickerList.innerHTML =
            '';


        const assignedIds =
            getAssignedStudentIds();


        /*
         * Students in the current team
         * are allowed to remain checked.
         */
        (
            group.members || []
        ).forEach(
            function (member) {

                assignedIds.delete(
                    String(
                        getMemberId(
                            member
                        )
                    )
                );
            }
        );


        if (!enrolledStudents.length) {

            projectStudentPickerList.innerHTML =
                `
                    <div
                        class="project-manual-empty"
                    >
                        No students are enrolled in this classroom.
                    </div>
                `;

        } else {

            enrolledStudents.forEach(
                function (student) {

                    const studentId =
                        String(
                            student.user_id
                        );


                    const assignedElsewhere =
                        assignedIds.has(
                            studentId
                        );


                    const alreadyInCurrentTeam =
                        (
                            group.members || []
                        ).some(
                            function (member) {

                                return (
                                    String(
                                        getMemberId(
                                            member
                                        )
                                    ) ===
                                    studentId
                                );
                            }
                        );


                    const option =
                        document.createElement(
                            'label'
                        );


                    option.className =
                        'project-student-picker-option';


                    if (assignedElsewhere) {

                        option.classList.add(
                            'is-disabled'
                        );
                    }


                    const avatar =
                        student.profile_image

                            ? `
                                <img
                                    src="/storage/${escapeHtml(
                                        student.profile_image
                                    )}"
                                    alt="${escapeHtml(
                                        student.name
                                    )}"
                                >
                            `

                            : escapeHtml(
                                getInitial(
                                    student.name
                                )
                            );


                    option.innerHTML = `

                        <input
                            type="checkbox"
                            value="${escapeHtml(studentId)}"
                            data-student-id="${escapeHtml(studentId)}"
                            ${
                                alreadyInCurrentTeam
                                    ? 'checked'
                                    : ''
                            }
                        >

                        <span
                            class="project-student-picker-avatar"
                        >
                            ${avatar}
                        </span>

                        <span
                            class="project-student-picker-name"
                        >
                            ${escapeHtml(
                                student.name
                            )}
                        </span>

                    `;


                    const checkbox =
                        option.querySelector(
                            'input[type="checkbox"]'
                        );


                    if (checkbox) {

                        checkbox.disabled =
                            assignedElsewhere;
                    }


                    projectStudentPickerList.appendChild(
                        option
                    );
                }
            );
        }


        projectStudentPicker.classList.add(
            'is-open'
        );


        projectStudentPicker.setAttribute(
            'aria-hidden',
            'false'
        );
    }


    /* ============================================================
       CLOSE STUDENT PICKER
       ============================================================ */

    function closeStudentPicker() {

        if (projectStudentPicker) {

            projectStudentPicker.classList.remove(
                'is-open'
            );


            projectStudentPicker.setAttribute(
                'aria-hidden',
                'true'
            );
        }


        if (projectStudentPickerList) {

            projectStudentPickerList.innerHTML =
                '';
        }


        activeManualTeamIndex =
            null;
    }


    /* ============================================================
       SAVE STUDENTS
       ============================================================ */

    function saveStudentsToCurrentTeam() {

        if (
            activeManualTeamIndex === null ||
            activeManualTeamIndex === undefined
        ) {
            return;
        }


        const groups =
            window.projectGeneratedGroups ||
            [];


        const group =
            groups[
                activeManualTeamIndex
            ];


        if (
            !group ||
            !projectStudentPickerList
        ) {
            return;
        }


        const checkedInputs =
            Array.from(
                projectStudentPickerList
                    .querySelectorAll(
                        'input[type="checkbox"]:checked'
                    )
            );


        const selectedMembers =
            [];


        checkedInputs.forEach(
            function (input) {

                const studentId =
                    String(
                        input.dataset.studentId ||
                        input.value
                    );


                const student =
                    enrolledStudents.find(
                        function (item) {

                            return (
                                String(
                                    item.user_id
                                ) ===
                                studentId
                            );
                        }
                    );


                if (!student) {
                    return;
                }


                selectedMembers.push({

                    user_id:
                        student.user_id,

                    name:
                        student.name ||
                        'Student',

                    profile_image:
                        student.profile_image ||
                        null,

                    performance:
                        null,

                    role:
                        'member'
                });
            }
        );


        /*
         * Save the selected students
         * into the current team.
         */
        group.members =
            selectedMembers;


        /*
         * Automatically assign:
         * first = leader
         * second = backup
         */
        applyDefaultRoles([
            group
        ]);


        window.projectGeneratedGroups =
            groups;


        /*
         * Update form data.
         */
        syncGroupsToForm(
            groups
        );


        /*
         * Update the Manual builder.
         */
        renderManualBuilder();


        /*
         * Update preview.
         */
        renderGroups(
            groups,
            {
                showPerformance:
                    false
            }
        );


        /*
         * Show success message.
         */
        if (projectGroupingStatus) {

            projectGroupingStatus.classList.add(
                'is-visible'
            );

            projectGroupingStatus.textContent =
                `${selectedMembers.length} ${
                    selectedMembers.length === 1
                        ? 'student'
                        : 'students'
                } saved to ${group.group_name}.`;
        }


        /*
         * Close modal.
         */
        closeStudentPicker();
    }


    /* ============================================================
       SAVE BUTTON
       ============================================================ */

    if (projectStudentPickerAdd) {

        projectStudentPickerAdd.addEventListener(
            'click',
            function (event) {

                event.preventDefault();

                event.stopPropagation();

                saveStudentsToCurrentTeam();
            }
        );
    }


    /* ============================================================
       CLOSE MODAL
       ============================================================ */

    if (projectStudentPickerClose) {

        projectStudentPickerClose.addEventListener(
            'click',
            function (event) {

                event.preventDefault();

                closeStudentPicker();
            }
        );
    }


    if (projectStudentPickerCancel) {

        projectStudentPickerCancel.addEventListener(
            'click',
            function (event) {

                event.preventDefault();

                closeStudentPicker();
            }
        );
    }


    if (projectStudentPicker) {

        projectStudentPicker.addEventListener(
            'click',
            function (event) {

                if (
                    event.target ===
                    projectStudentPicker
                ) {
                    closeStudentPicker();
                }
            }
        );
    }


    document.addEventListener(
        'keydown',
        function (event) {

            if (
                event.key === 'Escape' &&
                projectStudentPicker &&
                projectStudentPicker.classList.contains(
                    'is-open'
                )
            ) {

                closeStudentPicker();
            }
        }
    );


    /* ============================================================
       RANDOM / BALANCED SERVER GENERATOR
       ============================================================ */

    function generateGroupsFromServer(
        method,
        groupCount
    ) {

        if (!generateGroupsButton) {
            return;
        }


        generateGroupsButton.classList.add(
            'is-loading'
        );


        const buttonText =
            generateGroupsButton.querySelector(
                'span'
            );


        if (buttonText) {

            buttonText.textContent =
                'Generating...';
        }


        if (projectGroupingStatus) {

            projectGroupingStatus.classList.add(
                'is-visible'
            );

            projectGroupingStatus.textContent =
                method === 'balanced'
                    ? 'Generating balanced teams. Please wait...'
                    : 'Generating random teams. Please wait...';
        }


        fetch(
            '{{ route("professor.classworks.projects.generate-groups", $classGroup->id) }}',
            {
                method:
                    'POST',

                headers: {

                    'Content-Type':
                        'application/json',

                    'Accept':
                        'application/json',

                    'X-CSRF-TOKEN':
                        document
                            .querySelector(
                                'meta[name="csrf-token"]'
                            )
                            ?.getAttribute(
                                'content'
                            ) ||
                        '{{ csrf_token() }}'
                },

                body:
                    JSON.stringify({

                        grouping_method:
                            method,

                        group_count:
                            groupCount
                    })
            }
        )
        .then(
            function (response) {

                return response
                    .json()
                    .then(
                        function (data) {

                            if (!response.ok) {

                                throw new Error(
                                    data.message ||
                                    `Unable to generate ${method} groups.`
                                );
                            }


                            return data;
                        }
                    );
            }
        )
        .then(
            function (data) {

                const groups =
                    normalizeGroups(
                        data.groups ||
                        data.data?.groups ||
                        []
                    );


                if (!groups.length) {

                    throw new Error(
                        'No groups were generated. Please make sure students are enrolled in this class.'
                    );
                }


                window.projectGeneratedGroups =
                    applyDefaultRoles(
                        groups
                    );


                if (projectManualBuilder) {

                    projectManualBuilder.classList.remove(
                        'is-visible'
                    );
                }


                syncGroupsToForm(
                    window.projectGeneratedGroups
                );


                renderGroups(
                    window.projectGeneratedGroups,
                    {
                        /*
                         * Random = no performance
                         * Balanced = performance
                         */
                        showPerformance:
                            method === 'balanced'
                    }
                );


                if (projectGroupingStatus) {

                    projectGroupingStatus.textContent =
                        `${
                            method === 'random'
                                ? 'Random'
                                : 'Balanced'
                        } grouping generated successfully. Review the teams and roles before creating the project.`;
                }
            }
        )
        .catch(
            function (error) {

                console.error(
                    `${method} grouping error:`,
                    error
                );


                clearGeneratedGroupInputs();


                window.projectGeneratedGroups =
                    [];


                if (projectGroupsPreview) {

                    projectGroupsPreview.hidden =
                        true;
                }


                if (projectGroupsPreviewGrid) {

                    projectGroupsPreviewGrid.innerHTML =
                        '';
                }


                if (projectGroupingStatus) {

                    projectGroupingStatus.classList.add(
                        'is-visible'
                    );

                    projectGroupingStatus.textContent =
                        error.message ||
                        `Something went wrong while generating the ${method} groups.`;
                }
            }
        )
        .finally(
            function () {

                generateGroupsButton.classList.remove(
                    'is-loading'
                );


                if (buttonText) {

                    const currentMethod =
                        document
                            .querySelector(
                                'input[name="grouping_method_ui"]:checked'
                            )
                            ?.value ||
                        'manual';


                    buttonText.textContent =
                        currentMethod === 'manual'
                            ? 'Create Empty Groups'
                            : 'Generate Groups';
                }
            }
        );
    }


    /* ============================================================
       GROUPING BUTTON TEXT
       ============================================================ */

    function updateGroupingControls() {

        if (!generateGroupsButton) {
            return;
        }


        const method =
            document
                .querySelector(
                    'input[name="grouping_method_ui"]:checked'
                )
                ?.value ||
            'manual';


        const buttonText =
            generateGroupsButton.querySelector(
                'span'
            );


        if (buttonText) {

            buttonText.textContent =
                method === 'manual'
                    ? 'Create Empty Groups'
                    : 'Generate Groups';
        }
    }


    /* ============================================================
       GROUPING METHOD CHANGE
       ============================================================ */

    document
        .querySelectorAll(
            'input[name="grouping_method_ui"]'
        )
        .forEach(
            function (radio) {

                radio.addEventListener(
                    'change',
                    function () {

                        clearGeneratedGroupInputs();

                        window.projectGeneratedGroups =
                            [];


                        if (projectGroupsPreview) {

                            projectGroupsPreview.hidden =
                                true;
                        }


                        if (projectGroupsPreviewGrid) {

                            projectGroupsPreviewGrid.innerHTML =
                                '';
                        }


                        if (projectGroupingStatus) {

                            projectGroupingStatus.classList.remove(
                                'is-visible'
                            );
                        }


                        if (projectManualBuilder) {

                            projectManualBuilder.classList.remove(
                                'is-visible'
                            );
                        }


                        updateGroupingControls();
                    }
                );
            }
        );


    /* ============================================================
       CREATE EMPTY / GENERATE GROUPS
       ============================================================ */

    if (generateGroupsButton) {

        generateGroupsButton.addEventListener(
            'click',
            function (event) {

                event.preventDefault();


                const method =
                    document
                        .querySelector(
                            'input[name="grouping_method_ui"]:checked'
                        )
                        ?.value ||
                    'manual';


                const groupCount =
                    groupCountSelect
                        ? Number(
                            groupCountSelect.value
                        )
                        : 4;


                /*
                 * MANUAL
                 *
                 * Only creates empty teams.
                 * Students are added through
                 * the popup.
                 */
                if (
                    method ===
                    'manual'
                ) {

                    createEmptyManualGroups(
                        groupCount
                    );


                    return;
                }


                /*
                 * RANDOM
                 * and
                 * BALANCED
                 *
                 * use the server generator.
                 */
                generateGroupsFromServer(
                    method,
                    groupCount
                );
            }
        );
    }


    /* ============================================================
       FORM SUBMIT VALIDATION
       ============================================================ */

    if (projectCreateForm) {

        projectCreateForm.addEventListener(
            'submit',
            function (event) {

                const selectedType =
                    document.querySelector(
                        'input[name="project_type"]:checked'
                    );


                /*
                 * Individual project.
                 */
                if (
                    !selectedType ||
                    selectedType.value !==
                        'team'
                ) {

                    clearGeneratedGroupInputs();

                    return;
                }


                const groups =
                    window.projectGeneratedGroups ||
                    [];


                const groupInputs =
                    document.querySelectorAll(
                        '.project-generated-group-input'
                    );


                /*
                 * Team project must have groups.
                 */
                if (
                    !groups.length ||
                    !groupInputs.length
                ) {

                    event.preventDefault();


                    if (projectGroupingStatus) {

                        projectGroupingStatus.classList.add(
                            'is-visible'
                        );

                        projectGroupingStatus.textContent =
                            'Please create or generate the student groups before creating a Team Project.';
                    }


                    projectGroupingCard?.scrollIntoView({
                        behavior:
                            'smooth',

                        block:
                            'center'
                    });


                    return;
                }


                const method =
                    document
                        .querySelector(
                            'input[name="grouping_method_ui"]:checked'
                        )
                        ?.value ||
                    'manual';


                /*
                 * Manual requires every
                 * enrolled student to be
                 * assigned to one team.
                 */
                if (
                    method ===
                        'manual' &&

                    getAssignedStudentIds()
                        .size !==
                        enrolledStudents.length
                ) {

                    event.preventDefault();


                    if (projectGroupingStatus) {

                        projectGroupingStatus.classList.add(
                            'is-visible'
                        );

                        projectGroupingStatus.textContent =
                            'Please assign every enrolled student to a team before creating the project.';
                    }


                    projectManualBuilder?.scrollIntoView({
                        behavior:
                            'smooth',

                        block:
                            'center'
                    });
                }
            }
        );
    }


    /* ============================================================
       INITIALIZE
       ============================================================ */

    updateTitleSummary();

    updateTopicSummary();

    updateTypeSummary();

    updatePointsSummary();

    renderFiles();

    updateGroupingVisibility();

    updateGroupingControls();

});
</script>

@endsection