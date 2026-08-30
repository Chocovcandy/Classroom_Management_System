@extends('layouts.prof_layout')

@section('title', 'Edit Assignment')

@section('content')

<style>
    /* ============================================================
   ASSIGNMENT EDIT PAGE
============================================================ */

    .assignment-edit-page {
        max-width: 900px;
        margin: 0 auto;
        padding: 30px 20px 50px;
    }


    /* ============================================================
   HEADER
============================================================ */

    .assignment-create-header {
        display: flex;
        align-items: center;
        gap: 18px;
        margin-bottom: 28px;
    }

    .assignment-create-header-left {
        display: flex;
        align-items: center;
        gap: 16px;
    }

    .assignment-back-button {
        width: 42px;
        height: 42px;

        display: flex;
        align-items: center;
        justify-content: center;

        border-radius: 10px;

        background: #f1f5f9;
        color: #334155;

        text-decoration: none;

        transition: all 0.2s ease;
    }

    .assignment-back-button:hover {
        background: #e2e8f0;
        color: #0f172a;
        transform: translateX(-2px);
    }

    .assignment-header-label {
        display: block;

        font-size: 12px;
        font-weight: 700;

        letter-spacing: 1.2px;

        color: #64748b;

        margin-bottom: 4px;
    }

    .assignment-create-header h1 {
        margin: 0;

        font-size: 26px;
        font-weight: 700;

        color: #0f172a;
    }

    .assignment-create-header p {
        margin: 5px 0 0;

        color: #64748b;
        font-size: 14px;
    }


    /* ============================================================
   CARD
============================================================ */

    .assignment-create-card {
        background: #ffffff;

        border: 1px solid #e2e8f0;

        border-radius: 16px;

        box-shadow: 0 5px 20px rgba(15, 23, 42, 0.06);

        overflow: hidden;
    }


    /* ============================================================
   CARD HEADER
============================================================ */

    .assignment-card-header {
        padding: 24px 28px;

        border-bottom: 1px solid #e2e8f0;
    }

    .assignment-card-header h2 {
        margin: 0;

        font-size: 19px;
        font-weight: 700;

        color: #0f172a;
    }

    .assignment-card-header p {
        margin: 6px 0 0;

        font-size: 14px;

        color: #64748b;
    }


    /* ============================================================
   FORM
============================================================ */

    .assignment-create-form {
        padding: 28px;
    }

    .assignment-form-group {
        margin-bottom: 22px;
    }

    .assignment-form-group label {
        display: block;

        margin-bottom: 8px;

        font-size: 14px;
        font-weight: 600;

        color: #334155;
    }

    .assignment-form-group input,
    .assignment-form-group textarea {
        width: 100%;

        box-sizing: border-box;

        border: 1px solid #cbd5e1;

        border-radius: 9px;

        background: #ffffff;

        color: #0f172a;

        font-family: inherit;
        font-size: 14px;

        outline: none;

        transition:
            border-color 0.2s ease,
            box-shadow 0.2s ease;
    }

    .assignment-form-group input {
        height: 44px;
        padding: 0 13px;
    }

    .assignment-form-group textarea {
        min-height: 130px;

        padding: 12px 13px;

        resize: vertical;
    }

    .assignment-form-group input:focus,
    .assignment-form-group textarea:focus {
        border-color: #6366f1;

        box-shadow:
            0 0 0 3px rgba(99, 102, 241, 0.10);
    }


    /* ============================================================
   TWO COLUMN ROW
============================================================ */

    .assignment-form-row {
        display: grid;

        grid-template-columns: 1fr 1fr;

        gap: 18px;
    }


    /* ============================================================
   FILE
============================================================ */

    .assignment-current-file {
        display: flex;

        align-items: center;

        gap: 12px;

        padding: 12px 14px;

        margin-bottom: 10px;

        border: 1px solid #e2e8f0;

        border-radius: 9px;

        background: #f8fafc;
    }

    .assignment-current-file-icon {
        width: 36px;
        height: 36px;

        display: flex;

        align-items: center;
        justify-content: center;

        border-radius: 8px;

        background: #eef2ff;
        color: #4f46e5;

        flex-shrink: 0;
    }

    .assignment-current-file-info {
        min-width: 0;
    }

    .assignment-current-file-info strong {
        display: block;

        font-size: 13px;

        color: #334155;

        overflow: hidden;

        text-overflow: ellipsis;

        white-space: nowrap;
    }

    .assignment-current-file-info span {
        display: block;

        margin-top: 2px;

        font-size: 12px;

        color: #64748b;
    }

    .assignment-file-note {
        display: block;

        margin-top: 7px;

        font-size: 12px;

        color: #64748b;
    }


    /* ============================================================
   ERROR
============================================================ */

    .assignment-error {
        margin-top: 6px;

        font-size: 12px;

        color: #dc2626;
    }


    /* ============================================================
   FORM FOOTER
============================================================ */

    .assignment-form-footer {
        display: flex;

        align-items: center;
        justify-content: space-between;

        gap: 12px;

        padding-top: 8px;

        margin-top: 10px;

        border-top: 1px solid #e2e8f0;
    }

    .assignment-form-actions {
        display: flex;

        align-items: center;

        gap: 10px;
    }


    /* ============================================================
   BUTTONS
============================================================ */

    .assignment-cancel-button,
    .assignment-update-button {
        height: 40px;

        padding: 0 16px;

        display: inline-flex;

        align-items: center;
        justify-content: center;

        gap: 7px;

        border-radius: 8px;

        font-family: inherit;

        font-size: 13px;
        font-weight: 600;

        text-decoration: none;

        cursor: pointer;

        transition: all 0.2s ease;
    }

    .assignment-cancel-button {
        border: 1px solid #cbd5e1;

        background: #ffffff;

        color: #475569;
    }

    .assignment-cancel-button:hover {
        background: #f8fafc;

        border-color: #94a3b8;
    }

    .assignment-update-button {
        border: 1px solid #4f46e5;

        background: #4f46e5;

        color: #ffffff;
    }

    .assignment-update-button:hover {
        background: #4338ca;

        border-color: #4338ca;
    }


    /* ============================================================
   DELETE BUTTON
============================================================ */

    .assignment-delete-form {
        margin: 0;
    }

    .assignment-delete-button {
        height: 40px;

        padding: 0 14px;

        display: inline-flex;

        align-items: center;
        justify-content: center;

        gap: 7px;

        border: 1px solid #fecaca;

        border-radius: 8px;

        background: #fff7f7;

        color: #dc2626;

        font-family: inherit;

        font-size: 13px;
        font-weight: 600;

        cursor: pointer;

        transition: all 0.2s ease;
    }

    .assignment-delete-button:hover {
        background: #fee2e2;

        border-color: #fca5a5;

        color: #b91c1c;
    }


    /* ============================================================
   RESPONSIVE
============================================================ */

    @media (max-width: 700px) {

        .assignment-edit-page {
            padding: 20px 14px 40px;
        }

        .assignment-form-row {
            grid-template-columns: 1fr;
            gap: 0;
        }

        .assignment-create-form {
            padding: 20px;
        }

        .assignment-card-header {
            padding: 20px;
        }

        .assignment-form-footer {
            align-items: stretch;

            flex-direction: column;
        }

        .assignment-form-actions {
            width: 100%;
        }

        .assignment-cancel-button,
        .assignment-update-button {
            flex: 1;
        }

        .assignment-delete-form {
            width: 100%;
        }

        .assignment-delete-button {
            width: 100%;
        }
    }
</style>


<div class="assignment-edit-page">


    {{-- =====================================================
         HEADER
    ====================================================== --}}

    <div class="assignment-create-header">

        <div class="assignment-create-header-left">

            {{-- BACK TO CLASSROOM --}}

            <a
                href="{{ route(
                    'professor.class-groups.classroom-group',
                    $classGroup
                ) }}"
                class="assignment-back-button">
                <i class="fa-solid fa-arrow-left"></i>
            </a>


            <div>

                <span class="assignment-header-label">
                    CLASSROOM
                </span>

                <h1>
                    Edit Assignment
                </h1>

                <p>
                    {{ $classGroup->group_name }}
                </p>

            </div>

        </div>

    </div>



    {{-- =====================================================
         CARD
    ====================================================== --}}

    <div class="assignment-create-card">


        {{-- =================================================
             CARD HEADER
        ================================================== --}}

        <div class="assignment-card-header">

            <h2>
                Assignment Details
            </h2>

            <p>
                Update the assignment information below.
            </p>

        </div>



        {{-- =================================================
             FORM
        ================================================== --}}

        <form
            action="{{ route(
                'professor.class-groups.assignments.update',
                [
                    'classGroup' => $classGroup,
                    'assignment' => $assignment
                ]
            ) }}"
            method="POST"
            enctype="multipart/form-data"
            class="assignment-create-form">

            @csrf

            @method('PUT')


            {{-- =================================================
                 TITLE
            ================================================== --}}

            <div class="assignment-form-group">

                <label for="assignment-title">
                    Assignment Title
                </label>

                <input
                    id="assignment-title"
                    type="text"
                    name="title"
                    value="{{ old('title', $assignment->title) }}"
                    placeholder="Enter assignment title..."
                    maxlength="255"
                    required>

                @error('title')

                <div class="assignment-error">
                    {{ $message }}
                </div>

                @enderror

            </div>



            {{-- =================================================
                 DESCRIPTION
            ================================================== --}}

            <div class="assignment-form-group">

                <label for="assignment-description">
                    Instructions
                </label>

                <textarea
                    id="assignment-description"
                    name="description"
                    placeholder="Write assignment instructions..."
                    required>{{ old('description', $assignment->description) }}</textarea>

                @error('description')

                <div class="assignment-error">
                    {{ $message }}
                </div>

                @enderror

            </div>



            {{-- =================================================
                 DUE DATE + TIME
            ================================================== --}}

            <div class="assignment-form-row">


                {{-- DUE DATE --}}

                <div class="assignment-form-group">

                    <label for="assignment-due-date">
                        Due Date
                    </label>

                    <input
                        id="assignment-due-date"
                        type="date"
                        name="due_date"
                        value="{{ old(
                            'due_date',
                            $assignment->due_date
                                ? \Carbon\Carbon::parse($assignment->due_date)->format('Y-m-d')
                                : ''
                        ) }}"
                        required>

                    @error('due_date')

                    <div class="assignment-error">
                        {{ $message }}
                    </div>

                    @enderror

                </div>



                {{-- DUE TIME --}}

                <div class="assignment-form-group">

                    <label for="assignment-due-time">
                        Due Time
                    </label>

                    <input
                        id="assignment-due-time"
                        type="time"
                        name="due_time"
                        value="{{ old(
                            'due_time',
                            $assignment->due_time
                                ? \Carbon\Carbon::parse($assignment->due_time)->format('H:i')
                                : ''
                        ) }}">

                    @error('due_time')

                    <div class="assignment-error">
                        {{ $message }}
                    </div>

                    @enderror

                </div>

            </div>



            {{-- =================================================
                 POINTS
            ================================================== --}}

            <div class="assignment-form-group">

                <label for="assignment-points">
                    Points
                </label>

                <input
                    id="assignment-points"
                    type="number"
                    name="points"
                    value="{{ old(
                        'points',
                        $assignment->points ?? 100
                    ) }}"
                    min="0"
                    placeholder="100">

                @error('points')

                <div class="assignment-error">
                    {{ $message }}
                </div>

                @enderror

            </div>



            {{-- =================================================
                 CURRENT ATTACHMENT
            ================================================== --}}

            @if ($assignment->attachment)

            <div class="assignment-form-group">

                <label>
                    Current Attachment
                </label>


                <div class="assignment-current-file">

                    <div class="assignment-current-file-icon">

                        <i class="bx bx-paperclip"></i>

                    </div>


                    <div class="assignment-current-file-info">

                        <strong>
                            {{ basename($assignment->attachment) }}
                        </strong>

                        <span>
                            Current assignment attachment
                        </span>

                    </div>

                </div>


                <span class="assignment-file-note">
                    Upload a new file below to replace the current attachment.
                </span>

            </div>

            @endif



            {{-- =================================================
                 NEW ATTACHMENT
            ================================================== --}}

            <div class="assignment-form-group">

                <label for="assignment-attachment">
                    {{ $assignment->attachment ? 'Replace Attachment' : 'Attachment' }}
                </label>

                <input
                    id="assignment-attachment"
                    type="file"
                    name="attachment">

                <span class="assignment-file-note">
                    Maximum file size: 10 MB.
                </span>

                @error('attachment')

                <div class="assignment-error">
                    {{ $message }}
                </div>

                @enderror

            </div>



            {{-- =================================================
                 FOOTER
            ================================================== --}}

            <div class="assignment-form-footer">


                {{-- DELETE --}}

                <form
                    action="{{ route(
                        'professor.class-groups.assignments.destroy',
                        [
                            'classGroup' => $classGroup,
                            'assignment' => $assignment
                        ]
                    ) }}"
                    method="POST"
                    class="assignment-delete-form"
                    onsubmit="return confirm('Are you sure you want to delete this assignment?');">

                    @csrf

                    @method('DELETE')

                    <button
                        type="submit"
                        class="assignment-delete-button">
                        <i class="bx bx-trash"></i>
                        Delete
                    </button>

                </form>



                {{-- UPDATE / CANCEL --}}

                <div class="assignment-form-actions">

                    <a
                        href="{{ route(
                            'professor.class-groups.classroom-group',
                            $classGroup
                        ) }}"
                        class="assignment-cancel-button">
                        Cancel
                    </a>


                    <button
                        type="submit"
                        class="assignment-update-button">
                        <i class="bx bx-save"></i>
                        Save Changes
                    </button>

                </div>

            </div>

        </form>

    </div>

</div>

@endsection