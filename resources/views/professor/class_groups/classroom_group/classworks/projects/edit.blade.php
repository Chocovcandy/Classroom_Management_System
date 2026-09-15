@extends('layouts.prof_layout')

@section('title', 'Edit Project')

@section('content')

@php
$returnTo = request('return_to', 'classwork');
$origin = request('origin', 'classwork');
@endphp

@php
$backUrl = $returnTo === 'marks'
? route('professor.class-groups.marks', $classGroup)

: ($returnTo === 'show'
? route('professor.classworks.projects.show', [
'classGroupId' => $classGroup->id,
'projectId' => $project->id,
'return_to' => $origin,
])

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
);

$backLabel = $returnTo === 'marks'
? 'Back to Marks'

: ($returnTo === 'show'
? 'Back to Project'

: ($returnTo === 'classwork'
? 'Back to Classwork'

: 'Back to Stream'
)
);
@endphp

<style>
    /* ============================================================
   PROJECT EDIT PAGE
   ============================================================ */

    .project-edit-page {
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

        --p-surface: #ffffff;
        --p-soft: #f8fafc;

        --p-danger: #dc2626;
        --p-danger-soft: #fef2f2;
        --p-danger-border: #fecaca;

        --p-shadow:
            0 8px 30px rgba(15, 23, 42, 0.06);

        --p-small-shadow:
            0 2px 10px rgba(15, 23, 42, 0.05);

        width: 100%;
        max-width: 1280px;

        margin: 0 auto;
        padding: 28px 28px 60px;

        color: var(--p-text);
    }


    /* ============================================================
   GLOBAL BOX SIZING
   ============================================================ */

    .project-edit-page *,
    .project-edit-page *::before,
    .project-edit-page *::after {
        box-sizing: border-box;
    }


    /* ============================================================
   HEADER
   ============================================================ */

    .project-page-header {
        margin-bottom: 24px;
    }

    .project-back-link {
        width: 42px;
        height: 42px;

        display: inline-flex;
        align-items: center;
        justify-content: center;

        margin-bottom: 16px;

        border: 1px solid var(--p-border);
        border-radius: 12px;

        background: var(--p-surface);
        color: var(--p-muted);

        text-decoration: none;

        box-shadow: var(--p-small-shadow);

        transition:
            background .18s ease,
            border-color .18s ease,
            color .18s ease,
            transform .18s ease;
    }

    .project-back-link:hover {
        background: var(--p-blue-soft);
        border-color: var(--p-blue-border);
        color: var(--p-blue-dark);

        transform: translateX(-2px);
    }

    .project-back-link i {
        font-size: 21px;
        line-height: 1;
    }

    .project-back-link span {
        display: none;
    }


    .project-header-row {
        display: flex;
        align-items: flex-start;
        justify-content: space-between;

        gap: 24px;
    }

    .project-header-main {
        min-width: 0;
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
        max-width: 700px;

        margin: 8px 0 0;

        color: var(--p-muted);

        font-size: 14px;
        line-height: 1.55;
    }

    .project-class-badge {
        display: inline-flex;
        align-items: center;

        gap: 7px;

        flex: 0 0 auto;

        margin-left: auto;
        padding: 8px 13px;

        border: 1px solid var(--p-blue-border);
        border-radius: 999px;

        background: var(--p-blue-soft);
        color: var(--p-blue-dark);

        font-size: 11px;
        font-weight: 800;
    }

    .project-class-badge i {
        font-size: 15px;
    }


    /* ============================================================
   ALERT
   ============================================================ */

    .project-alert {
        display: flex;
        gap: 10px;

        margin-bottom: 20px;
        padding: 14px 16px;

        border: 1px solid var(--p-danger-border);
        border-radius: 13px;

        background: var(--p-danger-soft);
        color: var(--p-danger);

        font-size: 12px;
        line-height: 1.55;
    }

    .project-alert>i {
        flex: 0 0 auto;

        margin-top: 1px;

        font-size: 18px;
    }

    .project-alert strong {
        display: block;

        margin-bottom: 3px;
    }

    .project-alert ul {
        margin: 0;
        padding-left: 17px;
    }


    /* ============================================================
   MAIN LAYOUT
   ============================================================ */

    .project-edit-grid {
        display: grid;

        grid-template-columns:
            minmax(0, 1fr) 320px;

        align-items: start;

        gap: 24px;
    }

    .project-main-column,
    .project-sidebar {
        min-width: 0;
    }


    /* ============================================================
   SECTION CARDS
   ============================================================ */

    .project-section-card {
        overflow: hidden;

        margin-bottom: 20px;

        border: 1px solid var(--p-border);
        border-radius: 18px;

        background: var(--p-surface);

        box-shadow: var(--p-shadow);
    }

    .project-section-heading {
        display: flex;
        align-items: center;

        gap: 13px;

        padding: 19px 22px;

        border-bottom: 1px solid var(--p-border-light);

        background: linear-gradient(to bottom,
                #ffffff,
                #fcfdff);
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
        min-width: 0;
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

    /* ============================================================
   BACK TO BUTTON
   ============================================================ */

    .classwork-form-back {
        display: inline-flex;
        align-items: center;
        gap: 8px;

        margin-bottom: 18px;
        padding: 9px 14px;

        border: 1px solid var(--p-border);
        border-radius: 10px;

        background: var(--p-surface);
        color: var(--p-muted);

        font-size: 12px;
        font-weight: 750;

        text-decoration: none;

        box-shadow: var(--p-small-shadow);

        transition:
            color .18s ease,
            background .18s ease,
            border-color .18s ease,
            transform .18s ease,
            box-shadow .18s ease;
    }

    .classwork-form-back i {
        font-size: 17px;
        line-height: 1;
    }

    .classwork-form-back:hover {
        color: var(--p-blue-dark);

        border-color: var(--p-blue-border);

        background: var(--p-blue-soft);

        transform: translateX(-2px);

        box-shadow:
            0 4px 12px rgba(37, 99, 235, .08);
    }

    .dark-mode .project-edit-page .classwork-form-back {
        border-color: var(--p-border);

        background: var(--p-surface);
        color: var(--p-light);
    }

    .dark-mode .project-edit-page .classwork-form-back:hover {
        border-color: var(--p-blue-border);

        background: var(--p-blue-soft);
        color: var(--p-blue-dark);
    }


    /* ============================================================
   FORM
   ============================================================ */

    .project-form-group {
        margin: 0 0 20px;
    }

    .project-form-group:last-child {
        margin-bottom: 0;
    }

    .project-form-row {
        display: grid;

        grid-template-columns:
            repeat(2, minmax(0, 1fr));

        gap: 17px;

        padding: 23px 23px 0;
    }

    .project-section-card>.project-form-group,
    .project-section-card>.project-type-grid,
    .project-section-card>.project-upload-area,
    .project-section-card>.project-existing-files,
    .project-section-card>.project-file-list,
    .project-section-card>.project-error,
    .project-section-card>.project-help-text {
        margin-left: 23px;
        margin-right: 23px;
    }

    .project-section-card>.project-form-group {
        margin-bottom: 20px;
    }

    .project-section-card>.project-form-group:first-of-type {
        margin-top: 23px;
    }

    .project-section-card>.project-form-group:last-of-type {
        margin-bottom: 23px;
    }

    .project-section-card>.project-type-grid {
        margin-top: 23px;
        margin-bottom: 23px;
    }

    .project-section-card>.project-upload-area {
        margin-top: 23px;
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
        color: #ef4444;
    }


    /* ============================================================
   INPUTS
   ============================================================ */

    .project-input,
    .project-select,
    .project-textarea {
        width: 100%;

        border: 1px solid #cbd5e1;
        border-radius: 11px;

        outline: none;

        background: #ffffff;
        color: var(--p-text);

        font-family: inherit;
        font-size: 14px;

        transition:
            border-color .18s ease,
            box-shadow .18s ease,
            background .18s ease;
    }

    .project-input,
    .project-select {
        height: 45px;

        padding: 0 13px;
    }

    .project-textarea {
        min-height: 155px;

        padding: 13px;

        resize: vertical;

        line-height: 1.6;
    }

    .project-input::placeholder,
    .project-textarea::placeholder {
        color: #a8b3c2;
    }

    .project-input:hover,
    .project-select:hover,
    .project-textarea:hover {
        border-color: #94a3b8;
    }

    .project-input:focus,
    .project-select:focus,
    .project-textarea:focus {
        border-color: #60a5fa;

        box-shadow:
            0 0 0 3px rgba(59, 130, 246, .11);
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

        font-size: 12px;
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


    /* ============================================================
   PROJECT TYPE
   ============================================================ */

    .project-type-grid {
        display: grid;

        grid-template-columns:
            repeat(2, minmax(0, 1fr));

        gap: 13px;
    }

    .project-type-option {
        position: relative;
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

        min-height: 108px;

        padding: 16px;

        border: 1px solid var(--p-border);
        border-radius: 14px;

        background: #ffffff;

        cursor: pointer;

        transition:
            border-color .18s ease,
            background .18s ease,
            box-shadow .18s ease,
            transform .18s ease;
    }

    .project-type-label:hover {
        border-color: var(--p-yellow-border);
        background: var(--p-yellow-soft);

        transform: translateY(-1px);
    }

    .project-type-radio:checked+.project-type-label {
        border-color: var(--p-yellow);

        background: var(--p-yellow-soft);

        box-shadow:
            0 0 0 3px rgba(234, 179, 8, .10),
            0 5px 15px rgba(234, 179, 8, .08);
    }

    .project-type-icon {
        width: 39px;
        height: 39px;

        display: inline-flex;
        align-items: center;
        justify-content: center;

        flex: 0 0 39px;

        border: 1px solid var(--p-yellow-border);
        border-radius: 10px;

        background: #ffffff;
        color: var(--p-yellow-dark);

        font-size: 19px;
    }

    .project-type-content {
        min-width: 0;
    }

    .project-type-title {
        margin: 0;

        color: var(--p-text-2);

        font-size: 13px;
        font-weight: 800;
    }

    .project-type-description {
        margin: 5px 0 0;

        color: var(--p-muted);

        font-size: 11px;
        line-height: 1.5;
    }


    /* ============================================================
   GROUPING
   ============================================================ */

    .project-grouping-card {
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

    .project-existing-groups {
        margin: 18px 23px 0;

        padding: 15px;

        border: 1px solid var(--p-border);
        border-radius: 14px;

        background: var(--p-soft);
    }

    .project-existing-groups-title {
        display: flex;
        align-items: center;

        gap: 7px;

        margin-bottom: 12px;

        color: var(--p-text);

        font-size: 12px;
        font-weight: 800;
    }

    .project-existing-groups-title i {
        color: var(--p-blue);

        font-size: 16px;
    }

    .project-existing-group-list {
        display: grid;

        grid-template-columns:
            repeat(2, minmax(0, 1fr));

        gap: 10px;
    }

    .project-existing-group {
        padding: 12px;

        border: 1px solid var(--p-border);
        border-radius: 11px;

        background: #ffffff;
    }

    .project-existing-group-header {
        display: flex;
        align-items: center;
        justify-content: space-between;

        gap: 10px;

        margin-bottom: 8px;
    }

    .project-existing-group-name {
        color: var(--p-text-2);

        font-size: 11px;
        font-weight: 800;
    }

    .project-existing-group-count {
        color: var(--p-muted);

        font-size: 9px;
        font-weight: 700;
    }

    .project-existing-member {
        display: flex;
        align-items: center;

        gap: 7px;

        padding: 6px 0;

        border-top: 1px solid var(--p-border-light);
    }

    .project-existing-member-avatar {
        width: 27px;
        height: 27px;

        display: flex;
        align-items: center;
        justify-content: center;

        overflow: hidden;

        flex: 0 0 27px;

        border-radius: 50%;

        background: var(--p-blue-soft);
        color: var(--p-blue);

        font-size: 9px;
        font-weight: 800;
    }

    .project-existing-member-avatar img {
        width: 100%;
        height: 100%;

        object-fit: cover;
    }

    .project-existing-member-name {
        min-width: 0;

        overflow: hidden;

        flex: 1;

        color: var(--p-text-2);

        font-size: 10px;
        font-weight: 650;

        text-overflow: ellipsis;
        white-space: nowrap;
    }

    .project-existing-member-role {
        color: var(--p-muted);

        font-size: 8px;
        font-weight: 700;

        text-transform: capitalize;
    }

    .project-grouping-note {
        display: flex;

        gap: 6px;

        margin: 15px 23px 23px;

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


    /* ============================================================
   ATTACHMENTS - UPLOAD
   ============================================================ */

    .project-upload-area {
        position: relative;

        padding: 26px 20px;

        border: 1.5px dashed var(--p-yellow-border);
        border-radius: 14px;

        background: var(--p-yellow-soft);

        text-align: center;

        cursor: pointer;

        transition:
            border-color .18s ease,
            background .18s ease,
            transform .18s ease;
    }

    .project-upload-area:hover,
    .project-upload-area.is-dragging {
        border-color: var(--p-yellow);

        background: #fffbea;

        transform: translateY(-1px);
    }

    .project-file-input {
        position: absolute;

        width: 1px;
        height: 1px;

        opacity: 0;

        pointer-events: none;
    }

    .project-upload-content {
        display: block;

        cursor: pointer;
    }

    .project-upload-icon {
        width: 50px;
        height: 50px;

        display: inline-flex;
        align-items: center;
        justify-content: center;

        margin-bottom: 10px;

        border: 1px solid var(--p-yellow-border);
        border-radius: 13px;

        background: #ffffff;
        color: var(--p-yellow-dark);

        box-shadow: var(--p-small-shadow);

        font-size: 22px;
    }

    .project-upload-title {
        margin: 0;

        color: var(--p-text-2);

        font-size: 13px;
        font-weight: 800;
    }

    .project-upload-title span {
        color: var(--p-blue);

        font-weight: 800;
    }

    .project-upload-description {
        max-width: 500px;

        margin: 5px auto 0;

        color: var(--p-light);

        font-size: 11px;
        line-height: 1.5;
    }


    /* ============================================================
   EXISTING FILES
   ============================================================ */

    .project-existing-files {
        margin-top: 15px;
    }

    .project-existing-files-header {
        display: flex;
        align-items: center;

        gap: 7px;

        margin-bottom: 8px;

        color: var(--p-text-2);

        font-size: 11px;
        font-weight: 800;
    }

    .project-existing-files-header i {
        color: var(--p-blue);

        font-size: 15px;
    }

    .project-existing-file {
        display: flex;
        align-items: center;

        gap: 10px;

        min-width: 0;

        margin-bottom: 8px;
        padding: 10px 11px;

        border: 1px solid var(--p-border);
        border-radius: 10px;

        background: #ffffff;

        transition:
            border-color .18s ease,
            background .18s ease;
    }

    .project-existing-file:hover {
        border-color: var(--p-blue-border);
        background: var(--p-blue-soft);
    }

    .project-existing-file-icon {
        width: 32px;
        height: 32px;

        display: inline-flex;
        align-items: center;
        justify-content: center;

        flex: 0 0 32px;

        border-radius: 8px;

        background: var(--p-blue-soft);
        color: var(--p-blue);

        font-size: 16px;
    }

    .project-existing-file-info {
        min-width: 0;
        flex: 1;
    }

    .project-existing-file-name {
        display: block;

        overflow: hidden;

        color: var(--p-text-2);

        font-size: 11px;
        font-weight: 700;

        text-overflow: ellipsis;
        white-space: nowrap;
    }

    .project-existing-file-label {
        display: block;

        margin-top: 2px;

        color: var(--p-light);

        font-size: 9px;
    }

    .project-existing-file-link {
        width: 30px;
        height: 30px;

        display: inline-flex;
        align-items: center;
        justify-content: center;

        flex: 0 0 30px;

        border: 1px solid var(--p-blue-border);
        border-radius: 8px;

        background: var(--p-blue-soft);
        color: var(--p-blue);

        text-decoration: none;

        transition: .18s ease;
    }

    .project-existing-file-link:hover {
        background: var(--p-blue);
        color: #ffffff;
    }


    /* ============================================================
   NEW FILE LIST
   ============================================================ */

    .project-file-list {
        display: flex;
        flex-direction: column;

        gap: 8px;

        margin-top: 15px;
        margin-bottom: 23px;
    }

    .project-file-item {
        display: flex;
        align-items: center;

        gap: 10px;

        min-width: 0;

        padding: 10px 11px;

        border: 1px solid var(--p-border);
        border-radius: 10px;

        background: #ffffff;
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
        flex: 1;
    }

    .project-file-name {
        display: block;

        overflow: hidden;

        margin: 0;

        color: var(--p-text-2);

        font-size: 12px;
        font-weight: 650;

        text-overflow: ellipsis;
        white-space: nowrap;
    }

    .project-file-size {
        display: block;

        margin: 2px 0 0;

        color: var(--p-light);

        font-size: 10px;
    }

    .project-file-remove {
        width: 30px;
        height: 30px;

        display: inline-flex;
        align-items: center;
        justify-content: center;

        flex: 0 0 30px;

        border: 0;
        border-radius: 8px;

        background: var(--p-danger-soft);
        color: var(--p-danger);

        cursor: pointer;

        transition: .18s ease;
    }

    .project-file-remove:hover {
        background: #fee2e2;

        transform: scale(1.04);
    }


    /* ============================================================
   SIDEBAR / SUMMARY
   ============================================================ */

    .project-summary-card {
        position: sticky;
        top: 20px;

        overflow: hidden;

        border: 1px solid var(--p-border);
        border-radius: 18px;

        background: var(--p-surface);

        box-shadow: var(--p-shadow);
    }

    .project-summary-header {
        display: flex;
        align-items: center;

        gap: 10px;

        padding: 19px 18px;

        border-bottom: 1px solid var(--p-border-light);

        background: linear-gradient(to bottom,
                #ffffff,
                #fcfdff);
    }

    .project-summary-icon {
        width: 36px;
        height: 36px;

        display: inline-flex;
        align-items: center;
        justify-content: center;

        flex: 0 0 36px;

        border: 1px solid var(--p-yellow-border);
        border-radius: 9px;

        background: var(--p-yellow-soft);
        color: var(--p-yellow-dark);

        font-size: 17px;
    }

    .project-summary-header h2 {
        margin: 0;

        color: var(--p-text);

        font-size: 14px;
        font-weight: 800;
    }

    .project-summary-list {
        padding: 8px 18px 14px;
    }

    .project-summary-item {
        display: grid;

        grid-template-columns:
            82px minmax(0, 1fr);

        gap: 12px;

        padding: 13px 0;

        border-bottom: 1px solid #f1f5f9;
    }

    .project-summary-item:last-child {
        border-bottom: 0;
    }

    .project-summary-label {
        color: var(--p-muted);

        font-size: 10px;
    }

    .project-summary-value {
        min-width: 0;

        overflow-wrap: anywhere;

        color: var(--p-text-2);

        font-size: 11px;
        line-height: 1.45;
        font-weight: 750;

        text-align: right;
    }

    .project-summary-muted {
        color: var(--p-light);
    }

    .project-summary-value.project-summary-yellow {
        color: var(--p-yellow-dark);
    }


    /* ============================================================
   HELP CARD
   ============================================================ */

    .project-help-card {
        margin: 0 18px 17px;

        padding: 13px;

        border: 1px solid var(--p-yellow-border);
        border-radius: 11px;

        background: var(--p-yellow-soft);
    }

    .project-help-card-title {
        display: flex;
        align-items: center;

        gap: 6px;

        margin-bottom: 7px;

        color: var(--p-yellow-dark);

        font-size: 11px;
        font-weight: 800;
    }

    .project-help-card-title i {
        font-size: 14px;
    }

    .project-help-card p {
        margin: 0;

        color: #57534e;

        font-size: 10px;
        line-height: 1.65;
    }


    /* ============================================================
   ACTION BUTTONS
   ============================================================ */

    .project-actions {
        display: grid;

        grid-template-columns:
            1fr 1.25fr;

        gap: 9px;

        padding: 16px 18px 18px;

        border-top: 1px solid var(--p-border-light);

        background: #fcfdff;
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

        transition:
            background .18s ease,
            border-color .18s ease,
            color .18s ease,
            transform .18s ease,
            box-shadow .18s ease;
    }

    .project-cancel-btn {
        border: 1px solid #cbd5e1;

        background: #ffffff;
        color: var(--p-text-2);
    }

    .project-cancel-btn:hover {
        border-color: #94a3b8;
        background: var(--p-soft);

        transform: translateY(-1px);
    }

    .project-btn-primary {
        border: 1px solid var(--p-yellow);

        background: var(--p-yellow);
        color: #422006;

        box-shadow:
            0 5px 14px rgba(234, 179, 8, .17);
    }

    .project-btn-primary:hover {
        border-color: #ca8a04;

        background: #ca8a04;

        transform: translateY(-1px);

        box-shadow:
            0 7px 17px rgba(234, 179, 8, .22);
    }


    /* ============================================================
   ACCESSIBILITY
   ============================================================ */

    .project-edit-page button:focus-visible,
    .project-edit-page a:focus-visible,
    .project-edit-page input:focus-visible,
    .project-edit-page select:focus-visible,
    .project-edit-page textarea:focus-visible {
        outline: 3px solid rgba(37, 99, 235, .14);
        outline-offset: 2px;
    }


    /* ============================================================
   DARK MODE
   ============================================================ */

    .dark-mode .project-edit-page {
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

        --p-shadow:
            0 8px 28px rgba(0, 0, 10, .28);

        --p-small-shadow:
            0 2px 10px rgba(0, 0, 10, .20);

        color-scheme: dark;
    }


    .dark-mode .project-edit-page .project-section-card,
    .dark-mode .project-edit-page .project-summary-card {
        background: var(--p-surface);
        border-color: var(--p-border);

        box-shadow: var(--p-shadow);
    }


    .dark-mode .project-edit-page .project-section-heading,
    .dark-mode .project-edit-page .project-summary-header {
        background: var(--p-surface);

        border-color: var(--p-border-light);
    }


    .dark-mode .project-edit-page .project-back-link {
        border-color: var(--p-border);

        background: var(--p-surface);
        color: var(--p-light);
    }

    .dark-mode .project-edit-page .project-back-link:hover {
        border-color: var(--p-blue-border);

        background: var(--p-blue-soft);
        color: var(--p-blue-dark);
    }


    .dark-mode .project-edit-page .project-page-title,
    .dark-mode .project-edit-page .project-section-heading h2,
    .dark-mode .project-edit-page .project-summary-header h2 {
        color: var(--p-text);
    }


    .dark-mode .project-edit-page .project-header-label {
        color: var(--p-yellow-dark);
    }


    .dark-mode .project-edit-page .project-page-subtitle,
    .dark-mode .project-edit-page .project-section-heading p,
    .dark-mode .project-edit-page .project-help-text,
    .dark-mode .project-edit-page .project-summary-label,
    .dark-mode .project-edit-page .project-upload-description,
    .dark-mode .project-edit-page .project-file-size,
    .dark-mode .project-edit-page .project-existing-file-label {
        color: var(--p-muted);
    }


    .dark-mode .project-edit-page .project-class-badge {
        border-color: var(--p-blue-border);

        background: var(--p-blue-soft);
        color: var(--p-blue-dark);
    }


    /* ============================================================
   DARK MODE - INPUTS
   ============================================================ */

    .dark-mode .project-edit-page .project-input,
    .dark-mode .project-edit-page .project-select,
    .dark-mode .project-edit-page .project-textarea {
        border-color: #3a3e68;

        background: #12142a;
        color: var(--p-text);
    }

    .dark-mode .project-edit-page .project-input::placeholder,
    .dark-mode .project-edit-page .project-textarea::placeholder {
        color: #6f72a0;
    }

    .dark-mode .project-edit-page .project-input:hover,
    .dark-mode .project-edit-page .project-select:hover,
    .dark-mode .project-edit-page .project-textarea:hover {
        border-color: #565b8d;
    }

    .dark-mode .project-edit-page .project-input:focus,
    .dark-mode .project-edit-page .project-select:focus,
    .dark-mode .project-edit-page .project-textarea:focus {
        border-color: var(--p-blue);

        box-shadow:
            0 0 0 3px rgba(109, 118, 255, .16);
    }

    .dark-mode .project-edit-page .project-form-label {
        color: var(--p-text-2);
    }


    /* ============================================================
   DARK MODE - PROJECT TYPE
   ============================================================ */

    .dark-mode .project-edit-page .project-type-label {
        border-color: var(--p-border);

        background: #12142a;
    }

    .dark-mode .project-edit-page .project-type-label:hover,
    .dark-mode .project-edit-page .project-type-radio:checked+.project-type-label {
        border-color: var(--p-yellow);

        background: var(--p-yellow-soft);
    }

    .dark-mode .project-edit-page .project-type-icon {
        border-color: var(--p-yellow-border);

        background: #171933;
        color: var(--p-yellow-dark);
    }

    .dark-mode .project-edit-page .project-type-title {
        color: var(--p-text-2);
    }

    .dark-mode .project-edit-page .project-type-description {
        color: var(--p-muted);
    }


    /* ============================================================
   DARK MODE - GROUPING
   ============================================================ */

    .dark-mode .project-edit-page .project-grouping-intro {
        border-color: var(--p-blue-border);

        background: var(--p-blue-soft);
        color: var(--p-text-2);
    }

    .dark-mode .project-edit-page .project-existing-groups {
        border-color: var(--p-border);

        background: #12142a;
    }

    .dark-mode .project-edit-page .project-existing-group {
        border-color: var(--p-border);

        background: #171933;
    }

    .dark-mode .project-edit-page .project-existing-member {
        border-color: var(--p-border-light);
    }


    /* ============================================================
   DARK MODE - UPLOADS
   ============================================================ */

    .dark-mode .project-edit-page .project-upload-area {
        border-color: var(--p-yellow-border);

        background: var(--p-yellow-soft);
    }

    .dark-mode .project-edit-page .project-upload-area:hover,
    .dark-mode .project-edit-page .project-upload-area.is-dragging {
        border-color: var(--p-yellow);

        background: rgba(250, 204, 21, .16);
    }

    .dark-mode .project-edit-page .project-upload-icon {
        border-color: var(--p-yellow-border);

        background: #171933;
        color: var(--p-yellow-dark);

        box-shadow: var(--p-small-shadow);
    }


    .dark-mode .project-edit-page .project-upload-title {
        color: var(--p-text-2);
    }


    .dark-mode .project-edit-page .project-existing-file,
    .dark-mode .project-edit-page .project-file-item {
        border-color: var(--p-border);

        background: #12142a;
    }

    .dark-mode .project-edit-page .project-existing-file:hover {
        border-color: var(--p-blue-border);

        background: var(--p-blue-soft);
    }

    .dark-mode .project-edit-page .project-existing-file-icon {
        background: var(--p-blue-soft);
        color: var(--p-blue-dark);
    }

    .dark-mode .project-edit-page .project-file-icon {
        background: var(--p-yellow-soft);
        color: var(--p-yellow-dark);
    }

    .dark-mode .project-edit-page .project-existing-file-name,
    .dark-mode .project-edit-page .project-file-name {
        color: var(--p-text-2);
    }


    /* ============================================================
   DARK MODE - SUMMARY
   ============================================================ */

    .dark-mode .project-edit-page .project-summary-item {
        border-color: var(--p-border-light);
    }

    .dark-mode .project-edit-page .project-summary-value {
        color: var(--p-text-2);
    }

    .dark-mode .project-edit-page .project-summary-muted {
        color: var(--p-light);
    }

    .dark-mode .project-edit-page .project-summary-value.project-summary-yellow {
        color: var(--p-yellow-dark);
    }


    .dark-mode .project-edit-page .project-help-card {
        border-color: var(--p-yellow-border);

        background: var(--p-yellow-soft);
    }

    .dark-mode .project-edit-page .project-help-card-title {
        color: var(--p-yellow-dark);
    }

    .dark-mode .project-edit-page .project-help-card p {
        color: #b9b5a3;
    }


    /* ============================================================
   DARK MODE - ACTIONS
   ============================================================ */

    .dark-mode .project-edit-page .project-actions {
        border-color: var(--p-border-light);

        background: #12142a;
    }

    .dark-mode .project-edit-page .project-cancel-btn {
        border-color: #3a3e68;

        background: #171933;
        color: var(--p-text-2);
    }

    .dark-mode .project-edit-page .project-cancel-btn:hover {
        border-color: #565b8d;

        background: #1c1e3a;
    }

    .dark-mode .project-edit-page .project-btn-primary {
        border-color: var(--p-yellow);

        background: var(--p-yellow);
        color: #302000;

        box-shadow:
            0 5px 14px rgba(250, 204, 21, .12);
    }

    .dark-mode .project-edit-page .project-btn-primary:hover {
        border-color: #eab308;

        background: #eab308;
    }


    /* ============================================================
   RESPONSIVE - TABLET
   ============================================================ */

    @media (max-width: 1050px) {

        .project-edit-grid {
            grid-template-columns:
                minmax(0, 1fr) 290px;

            gap: 20px;
        }

        .project-page-title {
            font-size: 27px;
        }
    }


    /* ============================================================
   RESPONSIVE - SMALL TABLET
   ============================================================ */

    @media (max-width: 850px) {

        .project-edit-grid {
            grid-template-columns: 1fr;
        }

        .project-summary-card {
            position: static;
        }

        .project-existing-group-list {
            grid-template-columns: 1fr;
        }
    }


    /* ============================================================
   RESPONSIVE - MOBILE
   ============================================================ */

    @media (max-width: 620px) {

        .project-edit-page {
            padding: 20px 14px 42px;
        }

        .project-header-row {
            display: block;
        }

        .project-class-badge {
            display: none;
        }

        .project-back-link {
            width: 39px;
            height: 39px;

            margin-bottom: 14px;
        }

        .project-page-title {
            font-size: 24px;
        }

        .project-page-subtitle {
            font-size: 12px;
        }

        .classwork-form-back {
            margin-bottom: 14px;
            padding: 8px 12px;

            font-size: 11px;
        }

        .classwork-form-back i {
            font-size: 16px;
        }

        /* Cards */

        .project-section-card {
            margin-bottom: 15px;

            border-radius: 14px;
        }

        .project-section-heading {
            padding: 16px;
        }

        .project-section-heading h2 {
            font-size: 14px;
        }

        .project-section-heading p {
            font-size: 11px;
        }

        .project-section-icon {
            width: 35px;
            height: 35px;

            flex-basis: 35px;

            font-size: 17px;
        }


        /* Form */

        .project-section-card>.project-form-group,
        .project-section-card>.project-type-grid,
        .project-section-card>.project-upload-area,
        .project-section-card>.project-existing-files,
        .project-section-card>.project-file-list,
        .project-section-card>.project-error,
        .project-section-card>.project-help-text {
            margin-left: 17px;
            margin-right: 17px;
        }

        .project-section-card>.project-form-group:first-of-type {
            margin-top: 17px;
        }

        .project-section-card>.project-form-group:last-of-type {
            margin-bottom: 17px;
        }

        .project-form-row {
            grid-template-columns: 1fr;

            gap: 0;

            padding: 17px 17px 0;
        }


        /* Project type */

        .project-type-grid {
            grid-template-columns: 1fr;
        }

        .project-type-label {
            min-height: 100px;
        }


        /* Grouping */

        .project-existing-groups {
            margin-left: 17px;
            margin-right: 17px;
        }

        .project-grouping-note {
            margin-left: 17px;
            margin-right: 17px;
        }


        /* Actions */

        .project-actions {
            grid-template-columns: 1fr;
        }
    }


    /* ============================================================
   VERY SMALL MOBILE
   ============================================================ */

    @media (max-width: 400px) {

        .project-edit-page {
            padding-left: 11px;
            padding-right: 11px;
        }

        .project-page-title {
            font-size: 22px;
        }

        .project-section-heading {
            gap: 10px;
        }

        .project-section-icon {
            width: 33px;
            height: 33px;

            flex-basis: 33px;

            font-size: 16px;
        }

        .project-summary-item {
            grid-template-columns:
                72px minmax(0, 1fr);

            gap: 8px;
        }

        .project-summary-value {
            font-size: 10px;
        }
    }
</style>


<div class="project-edit-page">


    {{-- ============================================================
     HEADER
     ============================================================ --}}

    <div class="project-page-header">

        <a
            href="{{ $backUrl }}"
            class="classwork-form-back">
            <i class="bx bx-arrow-back"></i>
            {{ $backLabel }}
        </a>


        <div class="project-header-row">

            <div class="project-header-main">

                <div class="project-header-label">
                    Edit Project
                </div>

                <h1 class="project-page-title">
                    Edit project
                </h1>

                <p class="project-page-subtitle">
                    Update project instructions, schedule, grading information,
                    and supporting files.
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

            <strong>
                Please fix the following:
            </strong>

            <ul>

                @foreach ($errors->all() as $error)

                <li>
                    {{ $error }}
                </li>

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
        action="{{ route(
        'professor.classworks.projects.update',
        [
            'classGroupId' => $classGroup->id,
            'projectId' => $project->id,
        ]
    ) }}"
        enctype="multipart/form-data"
        id="projectEditForm">

       @csrf
@method('PUT')

{{-- Preserve navigation state --}}
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

        <div class="project-edit-grid">


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

                            <h2>
                                Project Details
                            </h2>

                            <p>
                                Update the main information students will see.
                            </p>

                        </div>

                    </div>


                    {{-- PROJECT TITLE --}}

                    <div class="project-form-group">

                        <label
                            for="title"
                            class="project-form-label">
                            Project Title

                            <span class="project-required">
                                *
                            </span>
                        </label>


                        <input
                            type="text"
                            id="title"
                            name="title"
                            class="project-input @error('title') error @enderror"
                            value="{{ old('title', $project->title) }}"
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
                            placeholder="Explain what students need to do, project requirements, deliverables, and any important instructions...">{{ old('description', $project->description) }}</textarea>


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
                                @selected(
                                old('topic_id', $project->topic_id) == $topic->id
                                )
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

                            <h2>
                                Project Type
                            </h2>

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

                                @checked(
                                old( 'project_type' ,
                                $project->project_type
                            ) === 'individual'
                            )
                            >


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

                                @checked(
                                old( 'project_type' ,
                                $project->project_type
                            ) === 'team'
                            )
                            >


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
                                        Students work together using the
                                        project's existing groups.
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
                 STUDENT GROUPING INFORMATION
                 ================================================== --}}

                @if (
                $project->project_type === 'team' &&
                $project->groups &&
                $project->groups->count()
                )

                <div class="project-section-card">

                    <div class="project-section-heading">

                        <div class="project-section-icon">
                            <i class="bx bx-group"></i>
                        </div>

                        <div>

                            <h2>
                                Student Grouping
                            </h2>

                            <p>
                                Existing teams assigned to this project.
                            </p>

                        </div>

                    </div>


                    <div class="project-grouping-intro">

                        <strong>
                            Team Project.
                        </strong>

                        Existing student groups are shown below.
                        Group management is handled from the project page.

                    </div>


                    <div class="project-existing-groups">

                        <div class="project-existing-groups-title">

                            <i class="bx bx-group"></i>

                            <span>
                                Existing Groups
                            </span>

                        </div>


                        <div class="project-existing-group-list">

                            @foreach ($project->groups as $group)

                            <div class="project-existing-group">

                                <div class="project-existing-group-header">

                                    <span class="project-existing-group-name">

                                        {{ $group->group_name
                                                ?? 'Group ' . ($loop->iteration) }}

                                    </span>


                                    <span class="project-existing-group-count">

                                        {{ $group->members?->count() ?? 0 }}

                                        {{ ($group->members?->count() ?? 0) === 1
                                                ? 'member'
                                                : 'members'
                                            }}

                                    </span>

                                </div>


                                @if ($group->members && $group->members->count())

                                @foreach ($group->members as $member)

                                @php
                                $memberUser =
                                $member->user
                                ?? $member->student
                                ?? null;

                                $memberName =
                                $memberUser?->name
                                ?? $member->name
                                ?? 'Student';

                                $profileImage =
                                $memberUser?->profile_image
                                ?? null;
                                @endphp


                                <div class="project-existing-member">

                                    <div class="project-existing-member-avatar">

                                        @if ($profileImage)

                                        <img
                                            src="{{ asset('storage/' . $profileImage) }}"
                                            alt="{{ $memberName }}">

                                        @else

                                        {{ strtoupper(
                                                            substr(
                                                                $memberName,
                                                                0,
                                                                1
                                                            )
                                                        ) }}

                                        @endif

                                    </div>


                                    <span
                                        class="project-existing-member-name"
                                        title="{{ $memberName }}">
                                        {{ $memberName }}
                                    </span>


                                    @if (!empty($member->role))

                                    <span class="project-existing-member-role">
                                        {{ $member->role }}
                                    </span>

                                    @endif

                                </div>

                                @endforeach

                                @else

                                <div class="project-help-text">
                                    No members assigned to this group.
                                </div>

                                @endif

                            </div>

                            @endforeach

                        </div>

                    </div>


                    <div class="project-grouping-note">

                        <i class="bx bx-info-circle"></i>

                        <span>
                            Editing this project does not change the existing
                            student groups.
                        </span>

                    </div>

                </div>

                @endif


                {{-- ==================================================
                 SCHEDULE & GRADING
                 ================================================== --}}

                <div class="project-section-card">

                    <div class="project-section-heading">

                        <div class="project-section-icon">
                            <i class="bx bx-calendar-check"></i>
                        </div>

                        <div>

                            <h2>
                                Schedule & Grading
                            </h2>

                            <p>
                                Update the deadline and total points for this project.
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

                                value="{{ old(
                                'due_date',
                                optional($project->due_date)->format('Y-m-d')
                            ) }}">


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
                                value="{{ old(
            'due_time',
            $project->due_time
                ? \Carbon\Carbon::parse($project->due_time)->format('H:i')
                : ''
        ) }}">

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

                            <span class="project-required">
                                *
                            </span>
                        </label>

                        <input
                            type="number"
                            id="points"
                            name="points"
                            class="project-input @error('points') error @enderror"
                            value="{{ old('points', (int) $project->points) }}"
                            min="0"
                            max="99999999"
                            step="1"
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

                            <h2>
                                Attachments
                            </h2>

                            <p>
                                Keep existing files or add new supporting files.
                            </p>

                        </div>

                    </div>


                    {{-- EXISTING ATTACHMENTS --}}

                    @if ($project->resources->count())

                    <div class="project-existing-files">

                        <div class="project-existing-files-header">

                            <i class="bx bx-folder-open"></i>

                            <span>
                                Existing Attachments
                            </span>

                        </div>


                        @foreach ($project->resources as $resource)

                        @php
                        $resourceName =
                        $resource->title
                        ?? $resource->file_name
                        ?? basename(
                        $resource->file_path ?? ''
                        );
                        @endphp


                        <div class="project-existing-file">

                            <div class="project-existing-file-icon">

                                <i class="bx bx-file"></i>

                            </div>


                            <div class="project-existing-file-info">

                                <span
                                    class="project-existing-file-name"
                                    title="{{ $resourceName }}">
                                    {{ $resourceName }}
                                </span>


                                <span class="project-existing-file-label">
                                    Existing attachment
                                </span>

                            </div>


                            @if (
                            isset($resource->file_path) &&
                            $resource->file_path
                            )

                            <a
                                href="{{ asset(
                                            'storage/' . $resource->file_path
                                        ) }}"

                                target="_blank"

                                rel="noopener noreferrer"

                                class="project-existing-file-link"

                                title="Open attachment">
                                <i class="bx bx-link-external"></i>
                            </a>

                            @endif

                        </div>

                        @endforeach

                    </div>

                    @endif


                    {{-- NEW FILE UPLOAD --}}

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

                                Drag & drop new files here or

                                <span>
                                    browse
                                </span>

                            </p>


                            <p class="project-upload-description">

                                You can select multiple files.
                                Maximum 100 MB per file.

                            </p>

                        </label>

                    </div>


                    {{-- NEW FILE LIST --}}

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

            </div>


            {{-- ====================================================
             SIDEBAR
             ==================================================== --}}

            <aside class="project-sidebar">

                <div class="project-summary-card">


                    {{-- SUMMARY HEADER --}}

                    <div class="project-summary-header">

                        <div class="project-summary-icon">

                            <i class="bx bx-list-check"></i>

                        </div>


                        <h2>
                            Project Summary
                        </h2>

                    </div>


                    {{-- SUMMARY LIST --}}

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
                                class="project-summary-value"
                                id="summaryTitle"

                                title="{{ $project->title }}">
                                {{ $project->title }}
                            </span>

                        </div>


                        {{-- TOPIC --}}

                        <div class="project-summary-item">

                            <span class="project-summary-label">
                                Topic
                            </span>


                            <span
                                class="project-summary-value
                                {{ $project->topic_id
                                    ? ''
                                    : 'project-summary-muted'
                                }}"

                                id="summaryTopic">
                                {{ $project->topic?->topic_name ?? 'No topic' }}
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
                                {{ $project->project_type === 'team'
                                ? 'Team Project'
                                : 'Individual'
                            }}
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
                                {{ $project->points }}
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
                                {{ $project->resources->count() }}

                                {{ $project->resources->count() === 1
                                ? 'file'
                                : 'files'
                            }}
                            </span>

                        </div>

                    </div>


                    {{-- HELP CARD --}}

                    <div class="project-help-card">

                        <div class="project-help-card-title">

                            <i class="bx bx-info-circle"></i>

                            <span>
                                Editing this project
                            </span>

                        </div>


                        <p>

                            Changes to the project information will be saved
                            when you click Update Project.

                            @if ($project->project_type === 'team')
                            Existing student groups remain unchanged.
                            @endif

                        </p>

                    </div>


                    {{-- =================================================
                     ACTIONS INSIDE SUMMARY CARD
                     ================================================= --}}

                    <div class="project-actions">


                        {{-- CANCEL --}}

                        <a
                            href="{{ $backUrl }}"
                            class="project-cancel-btn">
                            Cancel
                        </a>


                        {{-- UPDATE --}}

                        <button
                            type="submit"
                            class="project-btn project-btn-primary">

                            <i class="bx bx-save"></i>

                            Update Project

                        </button>

                    </div>

                </div>

            </aside>

        </div>

    </form>
    ```

</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {

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


        let selectedFiles = [];


        /* ============================================================
           TITLE SUMMARY
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

                summaryTitle.title =
                    title;

                summaryTitle.classList.remove(
                    'project-summary-muted'
                );

            } else {

                summaryTitle.textContent =
                    'Not set';

                summaryTitle.title =
                    'Not set';

                summaryTitle.classList.add(
                    'project-summary-muted'
                );

            }
        }


        /* ============================================================
           TOPIC SUMMARY
           ============================================================ */

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


        /* ============================================================
           TYPE SUMMARY
           ============================================================ */

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
                selectedType.value === 'team' ?
                'Team Project' :
                'Individual';
        }


        /* ============================================================
           POINTS SUMMARY
           ============================================================ */

        function updatePointsSummary() {

            if (!pointsInput || !summaryPoints) {
                return;
            }

            const points =
                pointsInput.value.trim();


            summaryPoints.textContent =
                points !== '' ?
                points :
                '0';
        }


        /* ============================================================
           EXISTING + NEW ATTACHMENTS
           ============================================================ */

        const existingFiles =
            Number(
                "{{ $project->resources->count() }}"
            );


        function updateFileSummary() {

            if (!summaryFiles) {
                return;
            }

            const total =
                existingFiles +
                selectedFiles.length;


            summaryFiles.textContent =
                total +
                (
                    total === 1 ?
                    ' file' :
                    ' files'
                );
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


            const index =
                Math.floor(
                    Math.log(bytes) /
                    Math.log(1024)
                );


            return (
                parseFloat(
                    (
                        bytes /
                        Math.pow(
                            1024,
                            index
                        )
                    ).toFixed(2)
                ) +
                ' ' +
                units[index]
            );
        }


        /* ============================================================
           ESCAPE HTML
           ============================================================ */

        function escapeHtml(value) {

            return String(value ?? '')
                .replace(
                    /&/g,
                    '&amp;'
                )
                .replace(
                    /</g,
                    '&lt;'
                )
                .replace(
                    />/g,
                    '&gt;'
                )
                .replace(
                    /"/g,
                    '&quot;'
                )
                .replace(
                    /'/g,
                    '&#039;'
                );
        }


        /* ============================================================
           RENDER NEW FILES
           ============================================================ */

        function renderFiles() {

            if (!fileList) {
                return;
            }


            fileList.innerHTML = '';


            selectedFiles.forEach(
                function(file, index) {

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

                            ${formatFileSize(
                                file.size
                            )}

                        </p>

                    </div>


                    <button
                        type="button"

                        class="project-file-remove"

                        data-index="${index}"

                        aria-label="Remove ${escapeHtml(
                            file.name
                        )}"
                    >

                        <i class="bx bx-x"></i>

                    </button>

                `;


                    fileList.appendChild(item);

                }
            );


            updateFileSummary();

            syncInputFiles();
        }


        /* ============================================================
           SYNC FILE INPUT
           ============================================================ */

        function syncInputFiles() {

            if (!fileInput) {
                return;
            }


            try {

                const dataTransfer =
                    new DataTransfer();


                selectedFiles.forEach(
                    function(file) {

                        dataTransfer.items.add(
                            file
                        );

                    }
                );


                fileInput.files =
                    dataTransfer.files;

            } catch (error) {

                console.warn(
                    'Unable to sync selected files:',
                    error
                );

            }
        }


        /* ============================================================
           ADD FILES
           ============================================================ */

        function addFiles(files) {

            if (!files) {
                return;
            }


            Array.from(files).forEach(
                function(file) {

                    const exists =
                        selectedFiles.some(
                            function(existingFile) {

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

                        selectedFiles.push(
                            file
                        );

                    }

                }
            );


            renderFiles();
        }


        /* ============================================================
           FILE INPUT
           ============================================================ */

        if (fileInput) {

            fileInput.addEventListener(
                'change',
                function() {

                    addFiles(
                        this.files
                    );

                }
            );

        }


        /* ============================================================
           REMOVE NEW FILE
           ============================================================ */

        if (fileList) {

            fileList.addEventListener(
                'click',
                function(event) {

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


                    if (
                        Number.isNaN(index) ||
                        index < 0 ||
                        index >= selectedFiles.length
                    ) {
                        return;
                    }


                    selectedFiles.splice(
                        index,
                        1
                    );


                    renderFiles();

                }
            );

        }


        /* ============================================================
           DRAG & DROP
           ============================================================ */

        if (uploadArea) {

            uploadArea.addEventListener(
                'dragover',
                function(event) {

                    event.preventDefault();

                    uploadArea.classList.add(
                        'is-dragging'
                    );

                }
            );


            uploadArea.addEventListener(
                'dragleave',
                function() {

                    uploadArea.classList.remove(
                        'is-dragging'
                    );

                }
            );


            uploadArea.addEventListener(
                'drop',
                function(event) {

                    event.preventDefault();


                    uploadArea.classList.remove(
                        'is-dragging'
                    );


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
           LIVE SUMMARY EVENTS
           ============================================================ */

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


        document
            .querySelectorAll(
                'input[name="project_type"]'
            )
            .forEach(
                function(radio) {

                    radio.addEventListener(
                        'change',
                        updateTypeSummary
                    );

                }
            );


        /* ============================================================
           INITIAL STATE
           ============================================================ */

        updateTitleSummary();

        updateTopicSummary();

        updateTypeSummary();

        updatePointsSummary();

        updateFileSummary();

        renderFiles();

    });
</script>

@endsection