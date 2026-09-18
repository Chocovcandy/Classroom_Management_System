@extends('layouts.prof_layout')

@section('title', 'Edit Announcement')

@section('content')

<style>
/* =========================================================
   EDIT ANNOUNCEMENT PAGE
========================================================= */

.announcement-edit-page {
    width: 100%;
    max-width: 820px;
    margin: 0 auto;
    padding: 28px 24px 40px;
    box-sizing: border-box;
}

/* =========================================================
   PAGE HEADER
========================================================= */

.announcement-edit-header {
    display: flex;
    align-items: center;
    gap: 16px;
    margin-bottom: 22px;
}

.announcement-back-btn {
    width: 42px;
    height: 42px;
    flex: 0 0 42px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    border-radius: 12px;
    border: 1px solid var(--border-color, #e2e8f0);
    background: var(--card-color, #ffffff);
    color: var(--secondary-text-color, #64748b);
    text-decoration: none;
    font-size: 19px;
    transition:
        background 0.2s ease,
        color 0.2s ease,
        border-color 0.2s ease,
        transform 0.2s ease;
}

.announcement-back-btn:hover {
    background: var(--hover-color, #f8fafc);
    color: var(--heading-color, #0f172a);
    border-color: #cbd5e1;
    transform: translateX(-2px);
}

.announcement-header-icon {
    width: 46px;
    height: 46px;
    flex: 0 0 46px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 13px;
    background: #fff7ed;
    color: #f97316;
    font-size: 22px;
}

.announcement-header-text {
    min-width: 0;
}

.announcement-header-label {
    display: block;
    margin-bottom: 3px;
    font-size: 12px;
    line-height: 1.2;
    font-weight: 700;
    letter-spacing: 0.7px;
    color: var(--secondary-text-color, #64748b);
    text-transform: uppercase;
}

.announcement-edit-header h2 {
    margin: 0;
    font-size: 26px;
    line-height: 1.25;
    font-weight: 750;
    color: var(--heading-color, #0f172a);
}

/* =========================================================
   MAIN CARD
========================================================= */

.announcement-edit-card {
    width: 100%;
    background: var(--card-color, #ffffff);
    border: 1px solid var(--border-color, #e2e8f0);
    border-radius: 18px;
    box-shadow: 0 4px 18px rgba(15, 23, 42, 0.045);
    overflow: hidden;
}

/* =========================================================
   FORM HEADER
========================================================= */

.announcement-form-header {
    padding: 22px 26px 18px;
    border-bottom: 1px solid var(--border-color, #e2e8f0);
}

.announcement-form-header-title {
    margin: 0 0 5px;
    font-size: 18px;
    line-height: 1.35;
    font-weight: 750;
    color: var(--heading-color, #0f172a);
}

.announcement-form-header-text {
    margin: 0;
    font-size: 13px;
    line-height: 1.5;
    color: var(--secondary-text-color, #64748b);
}

/* =========================================================
   FORM BODY
========================================================= */

.announcement-form-body {
    padding: 26px;
}

.announcement-form-group {
    margin-bottom: 23px;
}

.announcement-form-group:last-child {
    margin-bottom: 0;
}

.announcement-form-group label {
    display: block;
    margin-bottom: 8px;
    font-size: 14px;
    line-height: 1.4;
    font-weight: 700;
    color: var(--heading-color, #334155);
}

.announcement-field-hint {
    margin: -3px 0 9px;
    font-size: 12px;
    color: var(--secondary-text-color, #64748b);
}

/* =========================================================
   INPUTS
========================================================= */

.announcement-form-group input,
.announcement-form-group textarea {
    width: 100%;
    box-sizing: border-box;
    border: 1px solid #d5dce5;
    border-radius: 11px;
    background: var(--card-color, #ffffff);
    color: var(--heading-color, #0f172a);
    font-family: inherit;
    font-size: 14px;
    line-height: 1.5;
    outline: none;
    transition:
        border-color 0.2s ease,
        box-shadow 0.2s ease,
        background 0.2s ease;
}

.announcement-form-group input {
    height: 46px;
    padding: 0 14px;
}

.announcement-form-group textarea {
    min-height: 175px;
    padding: 13px 14px;
    resize: vertical;
}

.announcement-form-group input::placeholder,
.announcement-form-group textarea::placeholder {
    color: #94a3b8;
}

.announcement-form-group input:hover,
.announcement-form-group textarea:hover {
    border-color: #b8c2cf;
}

.announcement-form-group input:focus,
.announcement-form-group textarea:focus {
    border-color: var(--button-color, #3b82f6);
    box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.11);
}

/* =========================================================
   ERROR
========================================================= */

.announcement-error {
    display: flex;
    align-items: center;
    gap: 5px;
    margin-top: 7px;
    font-size: 12px;
    line-height: 1.4;
    font-weight: 600;
    color: #dc2626;
}

.announcement-error::before {
    content: "!";
    width: 15px;
    height: 15px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    flex: 0 0 15px;
    border-radius: 50%;
    background: #fee2e2;
    font-size: 10px;
    font-weight: 800;
}

/* =========================================================
   FORM FOOTER
========================================================= */

.announcement-form-footer {
    display: flex;
    align-items: center;
    justify-content: flex-end;
    gap: 10px;
    padding: 18px 26px;
    border-top: 1px solid var(--border-color, #e2e8f0);
    background: rgba(248, 250, 252, 0.65);
}

.announcement-cancel-btn,
.announcement-update-btn {
    min-height: 41px;
    padding: 0 16px;
    border-radius: 10px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 7px;
    font-family: inherit;
    font-size: 13px;
    font-weight: 700;
    text-decoration: none;
    cursor: pointer;
    transition:
        background 0.2s ease,
        border-color 0.2s ease,
        color 0.2s ease,
        transform 0.2s ease,
        box-shadow 0.2s ease;
}

/* Cancel */

.announcement-cancel-btn {
    border: 1px solid #dbe2ea;
    background: #ffffff;
    color: #475569;
}

.announcement-cancel-btn:hover {
    background: #f8fafc;
    border-color: #cbd5e1;
    color: #334155;
}

/* Update */

.announcement-update-btn {
    border: 1px solid var(--button-color, #3b82f6);
    background: var(--button-color, #3b82f6);
    color: #ffffff;
}

.announcement-update-btn:hover {
    filter: brightness(0.94);
    box-shadow: 0 4px 10px rgba(59, 130, 246, 0.18);
    transform: translateY(-1px);
}

.announcement-update-btn i {
    font-size: 17px;
}

/* =========================================================
   DARK MODE
========================================================= */

body.dark-mode .announcement-back-btn,
body.dark-mode .announcement-edit-card,
body.dark-mode .announcement-form-group input,
body.dark-mode .announcement-form-group textarea,
body.dark-mode .announcement-cancel-btn {
    background: var(--card-color, #1e293b);
}

body.dark-mode .announcement-header-icon {
    background: rgba(249, 115, 22, 0.12);
}

body.dark-mode .announcement-form-footer {
    background: rgba(15, 23, 42, 0.35);
}

body.dark-mode .announcement-form-group input,
body.dark-mode .announcement-form-group textarea,
body.dark-mode .announcement-cancel-btn {
    border-color: var(--border-color, #334155);
}

body.dark-mode .announcement-form-group input:hover,
body.dark-mode .announcement-form-group textarea:hover,
body.dark-mode .announcement-cancel-btn:hover {
    border-color: #475569;
}

/* =========================================================
   RESPONSIVE
========================================================= */

@media (max-width: 700px) {

    .announcement-edit-page {
        padding: 20px 16px 30px;
    }

    .announcement-edit-header {
        gap: 12px;
        margin-bottom: 18px;
    }

    .announcement-back-btn {
        width: 40px;
        height: 40px;
        flex-basis: 40px;
    }

    .announcement-header-icon {
        width: 42px;
        height: 42px;
        flex-basis: 42px;
        font-size: 20px;
    }

    .announcement-header-label {
        font-size: 11px;
    }

    .announcement-edit-header h2 {
        font-size: 22px;
    }

    .announcement-form-header {
        padding: 19px 20px 16px;
    }

    .announcement-form-body {
        padding: 20px;
    }

    .announcement-form-footer {
        padding: 16px 20px;
        flex-direction: column-reverse;
        align-items: stretch;
    }

    .announcement-cancel-btn,
    .announcement-update-btn {
        width: 100%;
    }
}

@media (max-width: 420px) {

    .announcement-edit-page {
        padding-left: 12px;
        padding-right: 12px;
    }

    .announcement-header-icon {
        display: none;
    }

    .announcement-edit-header h2 {
        font-size: 21px;
    }

    .announcement-form-body {
        padding: 18px;
    }

    .announcement-form-header {
        padding-left: 18px;
        padding-right: 18px;
    }

    .announcement-form-footer {
        padding-left: 18px;
        padding-right: 18px;
    }
}
</style>

<div class="announcement-edit-page">

{{-- =====================================================
     PAGE HEADER
====================================================== --}}

<div class="announcement-edit-header">

    <a
        href="{{ route(
            'professor.class-groups.classroom-group',
            $classGroup
        ) }}"
        class="announcement-back-btn"
        aria-label="Back to classroom"
    >
        <i class="bx bx-arrow-back"></i>
    </a>



    <div class="announcement-header-text">

        <span class="announcement-header-label">
            Class Announcement
        </span>

        <h2>
            Edit Announcement
        </h2>

    </div>

</div>


{{-- =====================================================
     EDIT CARD
====================================================== --}}

<div class="announcement-edit-card">

    {{-- FORM INTRODUCTION --}}

    <div class="announcement-form-header">

        <h3 class="announcement-form-header-title">
            Update your announcement
        </h3>

        <p class="announcement-form-header-text">
            Make changes to the announcement below and save them when you are finished.
        </p>

    </div>


    {{-- =================================================
         FORM
    ================================================== --}}

    <form
        action="{{ route(
            'professor.class-groups.announcements.update',
            [
                'classGroup' => $classGroup,
                'announcement' => $announcement
            ]
        ) }}"
        method="POST"
    >

        @csrf
        @method('PUT')


        <div class="announcement-form-body">

            {{-- TITLE --}}

            <div class="announcement-form-group">

                <label for="title">
                    Announcement Title
                </label>

                <div class="announcement-field-hint">
                    Give your announcement a clear and recognizable title.
                </div>

                <input
                    id="title"
                    type="text"
                    name="title"
                    value="{{ old(
                        'title',
                        $announcement->title
                    ) }}"
                    maxlength="255"
                    placeholder="Enter announcement title"
                    required
                >

                @error('title')
                    <div class="announcement-error">
                        {{ $message }}
                    </div>
                @enderror

            </div>


            {{-- CONTENT --}}

            <div class="announcement-form-group">

                <label for="content">
                    Announcement
                </label>

                <div class="announcement-field-hint">
                    Write the information you want your students to see.
                </div>

                <textarea
                    id="content"
                    name="content"
                    placeholder="Write your announcement here..."
                    required
                >{{ old(
                    'content',
                    $announcement->content
                ) }}</textarea>

                @error('content')
                    <div class="announcement-error">
                        {{ $message }}
                    </div>
                @enderror

            </div>

        </div>


        {{-- =================================================
             ACTIONS
        ================================================== --}}

        <div class="announcement-form-footer">

            <a
                href="{{ route(
                    'professor.class-groups.classroom-group',
                    $classGroup
                ) }}"
                class="announcement-cancel-btn"
            >
                Cancel
            </a>

            <button
                type="submit"
                class="announcement-update-btn"
            >
                <i class="bx bx-save"></i>
                Update Announcement
            </button>

        </div>

    </form>

</div>


</div>

@endsection
