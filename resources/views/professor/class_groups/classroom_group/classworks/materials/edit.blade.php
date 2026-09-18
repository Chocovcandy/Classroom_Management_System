@extends('layouts.prof_layout')

@section('title', 'Edit Material')

@section('content')

@php
    $backUrl = $returnTo === 'show'
        ? route('professor.class-groups.materials.show', [
            'classGroup' => $classGroup,
            'material' => $material,
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
        );

    $backLabel = $returnTo === 'show'
        ? 'Back to Material'
        : ($returnTo === 'classwork'
            ? 'Back to Classwork'
            : 'Back to Stream'
        );
@endphp


<style>
/* =========================================================
   MATERIAL EDIT PAGE
   ========================================================= */

.material-edit-page {
    width: 100%;
    max-width: 1100px;
    margin: 0 auto;
    padding: 32px 28px 50px;
    box-sizing: border-box;
    color: #0f172a;
}


/* =========================================================
   HEADER
   ========================================================= */

.material-edit-header {
    display: flex;
    align-items: center;
    gap: 16px;
    margin-bottom: 26px;
}

.material-back-btn {
    width: 44px;
    height: 44px;
    flex-shrink: 0;

    display: inline-flex;
    align-items: center;
    justify-content: center;

    border: 1px solid #dbe3ef;
    border-radius: 12px;

    background: #ffffff;
    color: #334155;

    text-decoration: none;
    box-shadow: 0 3px 10px rgba(15, 23, 42, 0.05);

    transition:
        background 0.2s ease,
        border-color 0.2s ease,
        color 0.2s ease,
        transform 0.2s ease;
}

.material-back-btn i {
    font-size: 22px;
}

.material-back-btn:hover {
    background: #eff6ff;
    border-color: #93c5fd;
    color: #2563eb;
    transform: translateX(-2px);
}

.material-header-label {
    display: block;
    margin-bottom: 6px;

    color: #64748b;
    font-size: 12px;
    font-weight: 800;
    letter-spacing: 1.4px;
    text-transform: uppercase;
}

.material-edit-header h2 {
    margin: 0;

    color: #0f172a;
    font-size: 30px;
    font-weight: 800;
    line-height: 1.2;
}


/* =========================================================
   MAIN CARD
   ========================================================= */

.material-edit-card {
    width: 100%;
    overflow: visible;
    box-sizing: border-box;

    background: #ffffff;
    border: 1px solid #e2e8f0;
    border-radius: 20px;

    padding: 34px;

    box-shadow:
        0 12px 35px rgba(15, 23, 42, 0.06);
}


/* =========================================================
   FORM GROUP
   ========================================================= */

.material-form-group {
    margin-bottom: 28px;
}

.material-form-group > label,
.material-add-files > label {
    display: block;
    margin-bottom: 10px;

    color: #1e293b;
    font-size: 15px;
    font-weight: 800;
}

.material-form-group input:not([type="hidden"]),
.material-form-group textarea {
    width: 100%;
    box-sizing: border-box;

    border: 1px solid #cbd5e1;
    border-radius: 12px;

    background: #ffffff;
    color: #0f172a;

    padding: 14px 16px;

    font-family: inherit;
    font-size: 15px;
    line-height: 1.5;

    outline: none;

    transition:
        border-color 0.2s ease,
        box-shadow 0.2s ease,
        background 0.2s ease,
        color 0.2s ease;
}

.material-form-group input:not([type="hidden"]):hover,
.material-form-group textarea:hover {
    border-color: #94a3b8;
}

.material-form-group input:not([type="hidden"]):focus,
.material-form-group textarea:focus {
    border-color: #3b82f6;
    background: #ffffff;

    box-shadow:
        0 0 0 4px rgba(59, 130, 246, 0.12);
}

.material-form-group textarea {
    min-height: 155px;
    resize: vertical;
}


/* =========================================================
   FILE COUNT
   ========================================================= */

.material-file-count {
    display: flex;
    align-items: center;
    gap: 9px;

    margin-bottom: 14px;
    padding: 12px 14px;

    border: 1px solid #dbeafe;
    border-radius: 11px;

    background: #eff6ff;
    color: #475569;

    font-size: 14px;
    line-height: 1.5;
}

.material-file-count i {
    flex-shrink: 0;
    color: #2563eb;
    font-size: 20px;
}

.material-file-count strong {
    color: #1d4ed8;
    font-weight: 800;
}


/* =========================================================
   CURRENT FILES
   ========================================================= */

.material-files-list {
    display: flex;
    flex-direction: column;
    gap: 12px;
}

.material-current-file {
    position: relative;
    z-index: 1;

    display: flex;
    align-items: center;
    gap: 14px;

    min-width: 0;

    padding: 15px 16px;

    border: 1px solid #e2e8f0;
    border-radius: 14px;

    background: #f8fafc;

    transition:
        border-color 0.2s ease,
        background 0.2s ease,
        transform 0.2s ease;
}

.material-current-file:hover {
    border-color: #bfdbfe;
    background: #f8fbff;
    transform: translateY(-1px);
}

.material-current-file-icon {
    width: 46px;
    height: 46px;
    flex-shrink: 0;

    display: flex;
    align-items: center;
    justify-content: center;

    border: 1px solid #dbeafe;
    border-radius: 12px;

    background: #eff6ff;
    color: #2563eb;
}

.material-current-file-icon i {
    font-size: 24px;
}

.material-current-file-info {
    flex: 1;
    min-width: 0;
}

.material-current-file-info strong {
    display: block;

    overflow-wrap: anywhere;

    color: #1e293b;
    font-size: 14px;
    font-weight: 800;
    line-height: 1.45;
}

.material-current-file-info span {
    display: block;
    margin-top: 5px;

    overflow-wrap: anywhere;

    color: #64748b;
    font-size: 13px;
    line-height: 1.4;
}


/* =========================================================
   DELETE CURRENT FILE
   ========================================================= */

.material-delete-file-btn {
    position: relative;
    z-index: 5;

    width: 38px;
    height: 38px;
    flex-shrink: 0;

    display: inline-flex;
    align-items: center;
    justify-content: center;

    border: 1px solid #fecaca;
    border-radius: 10px;

    background: #fff1f2;
    color: #dc2626;

    cursor: pointer;

    transition:
        background 0.2s ease,
        border-color 0.2s ease,
        color 0.2s ease,
        transform 0.2s ease;
}

.material-delete-file-btn i {
    font-size: 19px;
}

.material-delete-file-btn:hover {
    background: #fee2e2;
    border-color: #fca5a5;
    color: #b91c1c;
    transform: scale(1.05);
}


/* =========================================================
   EMPTY FILE STATE
   ========================================================= */

.material-no-files {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    gap: 8px;

    min-height: 130px;
    padding: 22px;

    border: 1px dashed #cbd5e1;
    border-radius: 14px;

    background: #f8fafc;
    color: #64748b;

    text-align: center;
    font-size: 14px;
}

.material-no-files i {
    color: #94a3b8;
    font-size: 32px;
}


/* =========================================================
   ADD MORE FILES
   ========================================================= */

.material-add-files {
    margin-top: 30px;
    padding-top: 28px;

    border-top: 1px solid #e2e8f0;
}

.material-add-files > label {
    margin-bottom: 12px;
}


/* =========================================================
   UPLOAD BOX
   ========================================================= */

.material-upload-box {
    padding: 24px;

    border: 2px dashed #bfdbfe;
    border-radius: 16px;

    background: #f8fbff;

    transition:
        border-color 0.2s ease,
        background 0.2s ease,
        box-shadow 0.2s ease;
}

.material-upload-box:hover {
    border-color: #60a5fa;
    background: #eff6ff;
}

.material-upload-box:focus-within {
    border-color: #3b82f6;

    box-shadow:
        0 0 0 4px rgba(59, 130, 246, 0.10);
}

.material-upload-box input[type="file"] {
    display: block;

    width: 100%;
    box-sizing: border-box;

    color: #475569;
    font-family: inherit;
    font-size: 14px;

    cursor: pointer;
}

.material-upload-box input[type="file"]::file-selector-button {
    margin-right: 12px;
    padding: 10px 15px;

    border: 1px solid #bfdbfe;
    border-radius: 9px;

    background: #dbeafe;
    color: #1d4ed8;

    font-family: inherit;
    font-size: 13px;
    font-weight: 800;

    cursor: pointer;

    transition:
        background 0.2s ease,
        border-color 0.2s ease,
        color 0.2s ease;
}

.material-upload-box input[type="file"]::file-selector-button:hover {
    background: #bfdbfe;
    border-color: #93c5fd;
    color: #1e40af;
}

.material-upload-help {
    display: block;

    margin-top: 12px;

    color: #64748b;
    font-size: 13px;
    line-height: 1.6;
}


/* =========================================================
   SELECTED NEW FILES
   ========================================================= */

.selected-files {
    display: none;
    margin-top: 18px;
}

.selected-files.has-files {
    display: block;
}

.selected-files-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 12px;

    margin-bottom: 12px;

    color: #1e293b;
    font-size: 14px;
}

.selected-files-header strong {
    font-weight: 800;
}

.selected-files-header span {
    color: #64748b;
    font-size: 13px;
}

.selected-files-list {
    display: flex;
    flex-direction: column;
    gap: 10px;
}


/* =========================================================
   SELECTED FILE ITEM
   ========================================================= */

.selected-file-item {
    display: flex;
    align-items: center;
    gap: 12px;

    min-width: 0;

    padding: 13px 14px;

    border: 1px solid #bbf7d0;
    border-radius: 13px;

    background: #f0fdf4;

    transition:
        background 0.2s ease,
        border-color 0.2s ease,
        transform 0.2s ease;
}

.selected-file-item:hover {
    background: #ecfdf5;
    border-color: #86efac;
    transform: translateY(-1px);
}

.selected-file-icon {
    width: 42px;
    height: 42px;
    flex-shrink: 0;

    display: flex;
    align-items: center;
    justify-content: center;

    border: 1px solid #bbf7d0;
    border-radius: 11px;

    background: #dcfce7;
    color: #16a34a;
}

.selected-file-icon i {
    color: #16a34a;
    font-size: 22px;
}

.selected-file-info {
    flex: 1;
    min-width: 0;
}

.selected-file-name {
    display: block;

    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;

    color: #166534;
    font-size: 14px;
    font-weight: 800;
}

.selected-file-size {
    display: block;
    margin-top: 4px;

    color: #4d7c0f;
    font-size: 13px;
}


/* =========================================================
   REMOVE SELECTED FILE
   ========================================================= */

.selected-file-remove {
    width: 34px;
    height: 34px;
    flex-shrink: 0;

    display: inline-flex;
    align-items: center;
    justify-content: center;

    border: 1px solid #fecaca;
    border-radius: 9px;

    background: #fff1f2;
    color: #dc2626;

    cursor: pointer;

    transition:
        background 0.2s ease,
        border-color 0.2s ease,
        color 0.2s ease,
        transform 0.2s ease;
}

.selected-file-remove i {
    font-size: 18px;
}

.selected-file-remove:hover {
    background: #fee2e2;
    border-color: #fca5a5;
    color: #b91c1c;
    transform: scale(1.05);
}


/* =========================================================
   VALIDATION ERROR
   ========================================================= */

.material-error {
    display: flex;
    align-items: flex-start;
    gap: 7px;

    margin-top: 8px;

    color: #dc2626;
    font-size: 13px;
    font-weight: 600;
    line-height: 1.5;
}

.material-error::before {
    content: "!";

    width: 17px;
    height: 17px;
    flex-shrink: 0;

    display: inline-flex;
    align-items: center;
    justify-content: center;

    margin-top: 1px;

    border-radius: 50%;

    background: #fee2e2;
    color: #b91c1c;

    font-size: 11px;
    font-weight: 900;
}


/* =========================================================
   FORM FOOTER
   ========================================================= */

.material-form-footer {
    display: flex;
    align-items: center;
    justify-content: flex-end;
    gap: 12px;

    margin-top: 32px;
    padding-top: 24px;

    border-top: 1px solid #e2e8f0;
}

.material-cancel-btn,
.material-update-btn {
    min-height: 44px;

    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 8px;

    padding: 0 20px;

    border-radius: 11px;

    font-family: inherit;
    font-size: 14px;
    font-weight: 800;

    text-decoration: none;
    cursor: pointer;

    transition:
        background 0.2s ease,
        border-color 0.2s ease,
        color 0.2s ease,
        transform 0.2s ease,
        box-shadow 0.2s ease;
}

.material-cancel-btn {
    border: 1px solid #cbd5e1;
    background: #ffffff;
    color: #475569;
}

.material-cancel-btn:hover {
    border-color: #94a3b8;
    background: #f8fafc;
    color: #1e293b;
}

.material-update-btn {
    border: 1px solid #2563eb;
    background: #2563eb;
    color: #ffffff;

    box-shadow:
        0 5px 14px rgba(37, 99, 235, 0.20);
}

.material-update-btn:hover {
    border-color: #1d4ed8;
    background: #1d4ed8;
    color: #ffffff;

    transform: translateY(-1px);

    box-shadow:
        0 7px 18px rgba(37, 99, 235, 0.28);
}

.material-cancel-btn i,
.material-update-btn i {
    font-size: 18px;
}


/* =========================================================
   ACCESSIBILITY
   ========================================================= */

.material-back-btn:focus-visible,
.material-delete-file-btn:focus-visible,
.selected-file-remove:focus-visible,
.material-cancel-btn:focus-visible,
.material-update-btn:focus-visible {
    outline: 3px solid rgba(59, 130, 246, 0.35);
    outline-offset: 3px;
}


/* =========================================================
   DARK MODE
   Assumes your main layout uses body.dark-mode
   ========================================================= */

body.dark-mode .material-edit-page {
    color: #f8fafc;
}


/* Header */

body.dark-mode .material-back-btn {
    border-color: #334155;
    background: #111827;
    color: #cbd5e1;

    box-shadow:
        0 4px 14px rgba(0, 0, 0, 0.18);
}

body.dark-mode .material-back-btn:hover {
    background: #172033;
    border-color: #3b82f6;
    color: #60a5fa;
}

body.dark-mode .material-header-label {
    color: #94a3b8;
}

body.dark-mode .material-edit-header h2 {
    color: #f8fafc;
}


/* Main card */

body.dark-mode .material-edit-card {
    background: #0f172a;
    border-color: #334155;

    box-shadow:
        0 14px 38px rgba(0, 0, 0, 0.24);
}


/* Labels */

body.dark-mode .material-form-group > label,
body.dark-mode .material-add-files > label {
    color: #e2e8f0;
}


/* Text inputs */

body.dark-mode .material-form-group input:not([type="hidden"]),
body.dark-mode .material-form-group textarea {
    border-color: #475569;
    background: #111827;
    color: #f8fafc;
}

body.dark-mode .material-form-group input:not([type="hidden"]):hover,
body.dark-mode .material-form-group textarea:hover {
    border-color: #64748b;
}

body.dark-mode .material-form-group input:not([type="hidden"]):focus,
body.dark-mode .material-form-group textarea:focus {
    border-color: #3b82f6;
    background: #111827;
    color: #ffffff;
}


/* Current file count */

body.dark-mode .material-file-count {
    border-color: #1e40af;
    background: #172554;
    color: #cbd5e1;
}

body.dark-mode .material-file-count i {
    color: #60a5fa;
}

body.dark-mode .material-file-count strong {
    color: #93c5fd;
}


/* Current files */

body.dark-mode .material-current-file {
    border-color: #334155;
    background: #111827;
}

body.dark-mode .material-current-file:hover {
    border-color: #3b82f6;
    background: #172033;
}

body.dark-mode .material-current-file-icon {
    border-color: #1e40af;
    background: #172554;
    color: #60a5fa;
}

body.dark-mode .material-current-file-icon i {
    color: #60a5fa;
}

body.dark-mode .material-current-file-info strong {
    color: #f1f5f9;
}

body.dark-mode .material-current-file-info span {
    color: #94a3b8;
}


/* Delete existing */

body.dark-mode .material-delete-file-btn {
    border-color: #7f1d1d;
    background: #3b1616;
    color: #f87171;
}

body.dark-mode .material-delete-file-btn:hover {
    border-color: #ef4444;
    background: #521b1b;
    color: #fca5a5;
}


/* No files */

body.dark-mode .material-no-files {
    border-color: #475569;
    background: #111827;
    color: #94a3b8;
}

body.dark-mode .material-no-files i {
    color: #64748b;
}


/* =========================================================
   DARK MODE — UPLOAD SECTION
   ========================================================= */

body.dark-mode .material-add-files {
    border-top-color: #334155;
}


/* Upload box */

body.dark-mode .material-upload-box {
    border-color: #334155;
    background: #111827;
}

body.dark-mode .material-upload-box:hover {
    border-color: #3b82f6;
    background: #172033;
}

body.dark-mode .material-upload-box:focus-within {
    border-color: #3b82f6;

    box-shadow:
        0 0 0 4px rgba(59, 130, 246, 0.12);
}


/* Native file input */

body.dark-mode .material-upload-box input[type="file"] {
    color: #cbd5e1;
}


/* File chooser button */

body.dark-mode .material-upload-box input[type="file"]::file-selector-button {
    border-color: #2563eb;
    background: #1e3a5f;
    color: #93c5fd;
}

body.dark-mode .material-upload-box input[type="file"]::file-selector-button:hover {
    border-color: #3b82f6;
    background: #1e40af;
    color: #ffffff;
}


/* Help text */

body.dark-mode .material-upload-help {
    color: #94a3b8;
}


/* =========================================================
   DARK MODE — SELECTED FILES
   Green is intentionally preserved for new files.
   ========================================================= */

body.dark-mode .selected-files-header {
    color: #f1f5f9;
}

body.dark-mode .selected-files-header span {
    color: #94a3b8;
}

body.dark-mode .selected-file-item {
    border-color: #166534;
    background: #12261d;
}

body.dark-mode .selected-file-item:hover {
    border-color: #22c55e;
    background: #153323;
}

body.dark-mode .selected-file-icon {
    border-color: #166534;
    background: #173d29;
    color: #4ade80;
}

body.dark-mode .selected-file-icon i {
    color: #4ade80;
}

body.dark-mode .selected-file-name {
    color: #bbf7d0;
}

body.dark-mode .selected-file-size {
    color: #86efac;
}


/* Remove selected */

body.dark-mode .selected-file-remove {
    border-color: #7f1d1d;
    background: #3b1616;
    color: #f87171;
}

body.dark-mode .selected-file-remove:hover {
    border-color: #ef4444;
    background: #521b1b;
    color: #fca5a5;
}


/* =========================================================
   DARK MODE — FOOTER
   ========================================================= */

body.dark-mode .material-form-footer {
    border-top-color: #334155;
}

body.dark-mode .material-cancel-btn {
    border-color: #475569;
    background: #111827;
    color: #cbd5e1;
}

body.dark-mode .material-cancel-btn:hover {
    border-color: #64748b;
    background: #1e293b;
    color: #f8fafc;
}


/* =========================================================
   DARK MODE — ERRORS
   ========================================================= */

body.dark-mode .material-error {
    color: #f87171;
}

body.dark-mode .material-error::before {
    background: #3b1616;
    color: #fca5a5;
}


/* =========================================================
   RESPONSIVE
   ========================================================= */

@media (max-width: 900px) {

    .material-edit-page {
        padding: 26px 20px 40px;
    }

    .material-edit-card {
        padding: 26px;
    }
}


@media (max-width: 650px) {

    .material-edit-page {
        padding: 20px 14px 35px;
    }

    .material-edit-header {
        gap: 12px;
        margin-bottom: 20px;
    }

    .material-back-btn {
        width: 40px;
        height: 40px;
    }

    .material-edit-header h2 {
        font-size: 25px;
    }

    .material-edit-card {
        padding: 20px 16px;
        border-radius: 16px;
    }

    .material-current-file {
        align-items: flex-start;
        padding: 13px;
    }

    .material-current-file-icon {
        width: 40px;
        height: 40px;
    }

    .material-current-file-icon i {
        font-size: 21px;
    }

    .material-current-file-info strong {
        font-size: 13px;
    }

    .material-current-file-info span {
        font-size: 12px;
    }

    .material-delete-file-btn {
        width: 34px;
        height: 34px;
    }

    .material-upload-box {
        padding: 17px;
    }

    .material-form-footer {
        flex-direction: column-reverse;
        align-items: stretch;
    }

    .material-cancel-btn,
    .material-update-btn {
        width: 100%;
    }
}


@media (max-width: 420px) {

    .material-edit-header h2 {
        font-size: 22px;
    }

    .material-header-label {
        font-size: 10px;
    }

    .material-current-file {
        gap: 10px;
    }

    .material-current-file-icon {
        width: 36px;
        height: 36px;
    }

    .material-current-file-icon i {
        font-size: 19px;
    }

    .material-delete-file-btn {
        width: 32px;
        height: 32px;
    }

    .material-file-count {
        align-items: flex-start;
        font-size: 13px;
    }

    .selected-file-item {
        gap: 9px;
        padding: 11px;
    }

    .selected-file-icon {
        width: 38px;
        height: 38px;
    }

    .selected-file-name {
        font-size: 13px;
    }

    .selected-file-size {
        font-size: 12px;
    }

    .selected-file-remove {
        width: 32px;
        height: 32px;
    }
}
</style>


<div class="material-edit-page">

    {{-- =====================================================
         HEADER
    ====================================================== --}}

    <div class="material-edit-header">

        <a
            href="{{ $backUrl }}"
            class="material-back-btn"
            title="{{ $backLabel }}"
            aria-label="{{ $backLabel }}"
        >
            <i class="bx bx-arrow-back"></i>
        </a>

        <div>

            <span class="material-header-label">
                LEARNING MATERIAL
            </span>

            <h2>
                Edit Material
            </h2>

        </div>

    </div>


    {{-- =====================================================
         MAIN UPDATE FORM
    ====================================================== --}}

    <div class="material-edit-card">

        <form
            action="{{ route(
                'professor.class-groups.materials.update',
                [
                    'classGroup' => $classGroup,
                    'material' => $material,
                ]
            ) }}"
            method="POST"
            enctype="multipart/form-data"
            id="material-update-form"
        >

            @csrf
            @method('PUT')


            {{-- =================================================
                 RETURN LOCATION
            ================================================== --}}

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


            {{-- =================================================
                 TITLE
            ================================================== --}}

            <div class="material-form-group">

                <label for="title">
                    Material Title
                </label>

                <input
                    id="title"
                    type="text"
                    name="title"
                    value="{{ old('title', $material->title) }}"
                    required
                >

                @error('title')
                    <div class="material-error">
                        {{ $message }}
                    </div>
                @enderror

            </div>


            {{-- =================================================
                 DESCRIPTION
            ================================================== --}}

            <div class="material-form-group">

                <label for="description">
                    Description
                </label>

                <textarea
                    id="description"
                    name="description"
                >{{ old('description', $material->description) }}</textarea>

                @error('description')
                    <div class="material-error">
                        {{ $message }}
                    </div>
                @enderror

            </div>


            {{-- =================================================
                 CURRENT FILES
            ================================================== --}}

            <div class="material-form-group">

                <label>
                    Current Files
                </label>


                <div class="material-file-count">

                    <i class="bx bx-file"></i>

                    <span>

                        <strong>
                            {{ $material->resources->count() }}
                        </strong>

                        {{ $material->resources->count() === 1 ? 'file' : 'files' }}

                        attached to this material.

                    </span>

                </div>


                @if ($material->resources->count() > 0)

                    <div class="material-files-list">

                        @foreach ($material->resources as $resource)

                            <div class="material-current-file">

                                {{-- FILE ICON --}}

                                <div class="material-current-file-icon">

                                    @php

                                        $extension = strtolower(
                                            pathinfo(
                                                $resource->file_name ?? $resource->title,
                                                PATHINFO_EXTENSION
                                            )
                                        );

                                        $icon = match ($extension) {

                                            'pdf'
                                                => 'bxs-file-pdf',

                                            'doc',
                                            'docx'
                                                => 'bxs-file-doc',

                                            'xls',
                                            'xlsx'
                                                => 'bx-spreadsheet',

                                            'ppt',
                                            'pptx'
                                                => 'bxs-file',

                                            'jpg',
                                            'jpeg',
                                            'png',
                                            'gif',
                                            'webp'
                                                => 'bxs-file-image',

                                            'mp4',
                                            'mov',
                                            'avi',
                                            'mkv'
                                                => 'bxs-video',

                                            'mp3',
                                            'wav',
                                            'm4a'
                                                => 'bxs-music',

                                            'zip',
                                            'rar',
                                            '7z'
                                                => 'bxs-file-archive',

                                            default
                                                => 'bx-file'
                                        };

                                    @endphp

                                    <i class="bx {{ $icon }}"></i>

                                </div>


                                {{-- FILE INFORMATION --}}

                                <div class="material-current-file-info">

                                    <strong>
                                        {{ $resource->file_name ?? $resource->title }}
                                    </strong>

                                    <span>

                                        @if ($resource->file_size)

                                            {{ number_format(
                                                $resource->file_size / 1024 / 1024,
                                                2
                                            ) }}

                                            MB

                                        @else

                                            Unknown size

                                        @endif


                                        @if ($resource->mime_type)

                                            · {{ $resource->mime_type }}

                                        @endif

                                    </span>

                                </div>


                                {{-- DELETE EXISTING FILE --}}

                                <button
                                    type="button"
                                    class="material-delete-file-btn"
                                    data-delete-url="{{ route(
                                        'professor.class-groups.materials.resources.destroy',
                                        [
                                            'classGroup' => $classGroup,
                                            'material' => $material,
                                            'resource' => $resource,
                                        ]
                                    ) }}"
                                    title="Delete file"
                                    aria-label="Delete file"
                                >
                                    <i class="bx bx-trash"></i>
                                </button>

                            </div>

                        @endforeach

                    </div>

                @else

                    <div class="material-no-files">

                        <i class="bx bx-file"></i>

                        <span>
                            No files attached to this material.
                        </span>

                    </div>

                @endif

            </div>


            {{-- =================================================
                 ADD MORE FILES
            ================================================== --}}

            <div class="material-add-files">

                <label for="files">
                    Add More Files
                </label>


                <div class="material-upload-box">

                    <input
                        id="files"
                        type="file"
                        name="files[]"
                        multiple
                    >

                    <span class="material-upload-help">
                        Select one or multiple files.
                        You can remove a selected file before submitting.
                        Maximum 10 new files, 50 MB per file.
                    </span>

                </div>


                {{-- =================================================
                     SELECTED NEW FILES
                ================================================== --}}

                <div
                    id="selected-files"
                    class="selected-files"
                >

                    <div class="selected-files-header">

                        <strong>
                            Selected Files
                        </strong>

                        <span id="selected-files-count">
                            0 files
                        </span>

                    </div>


                    <div
                        id="selected-files-list"
                        class="selected-files-list"
                    ></div>

                </div>


                {{-- FILE VALIDATION ERROR --}}

                @error('files')
                    <div class="material-error">
                        {{ $message }}
                    </div>
                @enderror

                @error('files.*')
                    <div class="material-error">
                        {{ $message }}
                    </div>
                @enderror

            </div>


            {{-- =================================================
                 ACTIONS
            ================================================== --}}

            <div class="material-form-footer">

                @if ($returnTo === 'show')

                    <a
                        href="{{ route(
                            'professor.class-groups.materials.show',
                            [
                                'classGroup' => $classGroup,
                                'material' => $material,
                                'return_to' => $returnTo,
                            ]
                        ) }}"
                        class="material-cancel-btn"
                    >
                        <i class="bx bx-x"></i>
                        Cancel
                    </a>

                @elseif ($returnTo === 'classwork')

                    <a
                        href="{{ route(
                            'professor.class-groups.classroom-group.classwork',
                            $classGroup
                        ) }}"
                        class="material-cancel-btn"
                    >
                        <i class="bx bx-x"></i>
                        Cancel
                    </a>

                @else

                    <a
                        href="{{ route(
                            'professor.class-groups.classroom-group',
                            $classGroup
                        ) }}"
                        class="material-cancel-btn"
                    >
                        <i class="bx bx-x"></i>
                        Cancel
                    </a>

                @endif


                <button
                    type="submit"
                    class="material-update-btn"
                >
                    <i class="bx bx-save"></i>
                    Update Material
                </button>

            </div>

        </form>


        {{-- =====================================================
             SEPARATE RESOURCE DELETE FORM

             This form is outside the update form.
             Only ONE exists on this page.
        ====================================================== --}}

        <form
            id="resource-delete-form"
            method="POST"
            style="display: none;"
        >
            @csrf
            @method('DELETE')
        </form>

    </div>

</div>


{{-- =========================================================
     JAVASCRIPT
========================================================= --}}

<script>
document.addEventListener('DOMContentLoaded', function () {

    /* =========================================================
       EXISTING RESOURCE DELETE
    ========================================================= */

    const deleteForm = document.getElementById(
        'resource-delete-form'
    );

    const deleteButtons = document.querySelectorAll(
        '.material-delete-file-btn'
    );

    if (deleteForm) {

        deleteButtons.forEach(function (button) {

            button.addEventListener('click', function () {

                const deleteUrl = this.dataset.deleteUrl;

                if (!deleteUrl) {

                    console.error(
                        'Delete URL is missing.'
                    );

                    return;
                }


                const confirmed = confirm(
                    'Are you sure you want to delete this file?'
                );

                if (!confirmed) {
                    return;
                }


                deleteForm.action = deleteUrl;

                deleteForm.submit();

            });

        });

    }


    /* =========================================================
       NEW FILE SELECTION
    ========================================================= */

    const fileInput = document.getElementById('files');

    const selectedFilesContainer =
        document.getElementById('selected-files');

    const selectedFilesList =
        document.getElementById('selected-files-list');

    const selectedFilesCount =
        document.getElementById('selected-files-count');


    if (
        !fileInput ||
        !selectedFilesContainer ||
        !selectedFilesList ||
        !selectedFilesCount
    ) {
        return;
    }


    /* =========================================================
       OUR OWN SELECTED FILE LIST
    ========================================================= */

    let selectedFiles = [];


    /* =========================================================
       USER SELECTS FILES
    ========================================================= */

    fileInput.addEventListener('change', function () {

        const newlySelectedFiles =
            Array.from(this.files);


        newlySelectedFiles.forEach(function (file) {

            const duplicate = selectedFiles.some(
                function (existingFile) {

                    return (
                        existingFile.name === file.name &&
                        existingFile.size === file.size &&
                        existingFile.lastModified ===
                            file.lastModified
                    );

                }
            );


            if (!duplicate) {

                selectedFiles.push(file);

            }

        });


        updateFileInput();
        renderSelectedFiles();

    });


    /* =========================================================
       RENDER SELECTED FILES
    ========================================================= */

    function renderSelectedFiles() {

        selectedFilesList.innerHTML = '';


        if (selectedFiles.length === 0) {

            selectedFilesContainer.classList.remove(
                'has-files'
            );

            selectedFilesCount.textContent = '0 files';

            return;
        }


        selectedFilesContainer.classList.add(
            'has-files'
        );


        selectedFilesCount.textContent =
            selectedFiles.length === 1
                ? '1 file'
                : selectedFiles.length + ' files';


        selectedFiles.forEach(function (file, index) {

            /* -------------------------------------------------
               FILE ROW
            ------------------------------------------------- */

            const fileItem =
                document.createElement('div');

            fileItem.className =
                'selected-file-item';


            /* -------------------------------------------------
               FILE ICON
            ------------------------------------------------- */

            const iconContainer =
                document.createElement('div');

            iconContainer.className =
                'selected-file-icon';


            const icon =
                document.createElement('i');

            icon.className =
                getFileIcon(file.name);


            iconContainer.appendChild(icon);


            /* -------------------------------------------------
               FILE INFORMATION
            ------------------------------------------------- */

            const fileInfo =
                document.createElement('div');

            fileInfo.className =
                'selected-file-info';


            const fileName =
                document.createElement('strong');

            fileName.className =
                'selected-file-name';

            fileName.textContent =
                file.name;


            const fileSize =
                document.createElement('span');

            fileSize.className =
                'selected-file-size';

            fileSize.textContent =
                formatFileSize(file.size);


            fileInfo.appendChild(fileName);
            fileInfo.appendChild(fileSize);


            /* -------------------------------------------------
               REMOVE BUTTON
            ------------------------------------------------- */

            const removeButton =
                document.createElement('button');

            removeButton.type = 'button';

            removeButton.className =
                'selected-file-remove';

            removeButton.title =
                'Remove selected file';

            removeButton.setAttribute(
                'aria-label',
                'Remove selected file'
            );

            removeButton.innerHTML =
                '<i class="bx bx-x"></i>';


            removeButton.addEventListener(
                'click',
                function () {

                    removeSelectedFile(index);

                }
            );


            /* -------------------------------------------------
               BUILD ROW
            ------------------------------------------------- */

            fileItem.appendChild(
                iconContainer
            );

            fileItem.appendChild(
                fileInfo
            );

            fileItem.appendChild(
                removeButton
            );


            selectedFilesList.appendChild(
                fileItem
            );

        });

    }


    /* =========================================================
       REMOVE SELECTED NEW FILE
    ========================================================= */

    function removeSelectedFile(index) {

        selectedFiles.splice(index, 1);

        updateFileInput();

        renderSelectedFiles();

    }


    /* =========================================================
       UPDATE REAL FILE INPUT
    ========================================================= */

    function updateFileInput() {

        const dataTransfer =
            new DataTransfer();


        selectedFiles.forEach(function (file) {

            dataTransfer.items.add(file);

        });


        fileInput.files =
            dataTransfer.files;

    }


    /* =========================================================
       FILE ICON
    ========================================================= */

    function getFileIcon(fileName) {

        const extension =
            fileName
                .split('.')
                .pop()
                .toLowerCase();


        if (extension === 'pdf') {
            return 'bx bxs-file-pdf';
        }


        if (
            extension === 'doc' ||
            extension === 'docx'
        ) {
            return 'bx bxs-file-doc';
        }


        if (
            extension === 'xls' ||
            extension === 'xlsx'
        ) {
            return 'bx bx-spreadsheet';
        }


        if (
            extension === 'ppt' ||
            extension === 'pptx'
        ) {
            return 'bx bxs-file';
        }


        if (
            extension === 'jpg' ||
            extension === 'jpeg' ||
            extension === 'png' ||
            extension === 'gif' ||
            extension === 'webp'
        ) {
            return 'bx bxs-image';
        }


        if (
            extension === 'mp4' ||
            extension === 'mov' ||
            extension === 'avi' ||
            extension === 'mkv'
        ) {
            return 'bx bxs-video';
        }


        if (
            extension === 'mp3' ||
            extension === 'wav' ||
            extension === 'm4a'
        ) {
            return 'bx bxs-music';
        }


        if (
            extension === 'zip' ||
            extension === 'rar' ||
            extension === '7z'
        ) {
            return 'bx bxs-file-archive';
        }


        return 'bx bxs-file';

    }


    /* =========================================================
       FILE SIZE
    ========================================================= */

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


        const unitIndex =
            Math.floor(
                Math.log(bytes) /
                Math.log(1024)
            );


        return (
            bytes /
            Math.pow(
                1024,
                unitIndex
            )
        ).toFixed(2)
        + ' '
        + units[unitIndex];

    }

});
</script>

@endsection