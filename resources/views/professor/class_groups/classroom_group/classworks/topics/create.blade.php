@extends('layouts.prof_layout')

@section('content')

<style>

/* ============================================================
   CREATE TOPIC PAGE
   Clean style matching Assignment / Exam / Quiz pages
   ============================================================ */

.topic-page {

    --topic-blue: #2563eb;
    --topic-blue-dark: #1d4ed8;
    --topic-blue-soft: #eff6ff;
    --topic-blue-border: #bfdbfe;

    --topic-text: #0f172a;
    --topic-text-secondary: #334155;
    --topic-muted: #64748b;
    --topic-light: #94a3b8;

    --topic-border: #e2e8f0;
    --topic-border-light: #edf2f7;

    --topic-surface: #ffffff;
    --topic-soft: #f8fafc;

    --topic-danger: #dc2626;

    --topic-shadow:
        0 6px 24px rgba(15, 23, 42, .055);

    --topic-small-shadow:
        0 2px 8px rgba(15, 23, 42, .045);


    width: 100%;
    max-width: 980px;

    margin: 0 auto;

    padding: 30px 26px 60px;

    box-sizing: border-box;
}


.topic-page *,
.topic-page *::before,
.topic-page *::after {
    box-sizing: border-box;
}


/* ============================================================
   HEADER
   ============================================================ */

.topic-header {
    margin-bottom: 22px;
}


.topic-header-top {
    display: flex;
    align-items: flex-start;

    gap: 14px;
}


/* ============================================================
   BACK BUTTON
   ============================================================ */

.topic-back-btn {

    width: 44px;
    height: 44px;

    display: inline-flex;
    align-items: center;
    justify-content: center;

    flex: 0 0 44px;

    border: 1px solid var(--topic-border);

    border-radius: 11px;

    background: var(--topic-surface);

    color: var(--topic-muted);

    text-decoration: none;

    box-shadow: var(--topic-small-shadow);

    transition:
        color .18s ease,
        border-color .18s ease,
        background-color .18s ease,
        transform .18s ease;
}


.topic-back-btn i {
    font-size: 22px;
}


.topic-back-btn:hover {

    color: var(--topic-blue);

    border-color: var(--topic-blue-border);

    background: var(--topic-blue-soft);

    transform: translateX(-2px);
}


/* ============================================================
   HEADER CONTENT
   ============================================================ */

.topic-header-content {
    min-width: 0;
}


.topic-class-name {

    display: block;

    margin-bottom: 7px;

    color: var(--topic-muted);

    font-size: 13px;

    line-height: 1.4;

    font-weight: 800;

    letter-spacing: .08em;

    text-transform: uppercase;
}


.topic-title-row {

    display: flex;
    align-items: center;

    gap: 10px;
}


.topic-title-mark {

    width: 7px;
    height: 38px;

    flex: 0 0 7px;

    border-radius: 999px;

    background: var(--topic-blue);
}


.topic-header h1 {

    margin: 0;

    color: var(--topic-text);

    font-size: 36px;

    line-height: 1.15;

    font-weight: 800;

    letter-spacing: -.035em;
}


.topic-header p {

    margin: 9px 0 0 17px;

    color: var(--topic-muted);

    font-size: 16px;

    line-height: 1.6;

    font-weight: 500;
}


/* ============================================================
   MAIN CARD
   ============================================================ */

.topic-card {

    overflow: hidden;

    border:
        1px solid var(--topic-border);

    border-radius: 18px;

    background:
        var(--topic-surface);

    box-shadow:
        var(--topic-shadow);
}


/* ============================================================
   CARD HEADER
   ============================================================ */

.topic-card-header {

    display: flex;
    align-items: center;

    gap: 13px;

    padding: 21px 24px;

    border-bottom:
        1px solid var(--topic-border-light);
}


.topic-card-icon {

    width: 44px;
    height: 44px;

    display: inline-flex;
    align-items: center;
    justify-content: center;

    flex: 0 0 44px;

    border:
        1px solid var(--topic-blue-border);

    border-radius: 11px;

    background:
        var(--topic-blue-soft);

    color:
        var(--topic-blue);

    font-size: 22px;
}


.topic-card-heading {
    min-width: 0;
}


.topic-card-heading h2 {

    margin: 0;

    color: var(--topic-text);

    font-size: 20px;

    line-height: 1.3;

    font-weight: 800;
}


.topic-card-heading p {

    margin: 4px 0 0;

    color: var(--topic-muted);

    font-size: 14px;

    line-height: 1.5;
}


/* ============================================================
   FORM BODY
   ============================================================ */

.topic-form-body {

    padding: 28px 24px;
}


/* ============================================================
   FORM GROUP
   ============================================================ */

.topic-form-group {

    margin-bottom: 23px;
}


.topic-form-group:last-child {
    margin-bottom: 0;
}


/* ============================================================
   LABEL
   ============================================================ */

.topic-form-group label {

    display: flex;
    align-items: center;

    gap: 6px;

    margin: 0 0 9px;

    color: var(--topic-text-secondary);

    font-size: 15px;

    line-height: 1.4;

    font-weight: 750;
}


.topic-required {

    color: var(--topic-danger);

    font-size: 14px;

    font-weight: 800;
}


/* ============================================================
   INPUT / TEXTAREA
   ============================================================ */

.topic-form-group input,
.topic-form-group textarea {

    width: 100%;

    border:
        1px solid #cbd5e1;

    border-radius: 11px;

    outline: none;

    background:
        var(--topic-surface);

    color:
        var(--topic-text);

    font-family: inherit;

    font-size: 16px;

    font-weight: 500;

    transition:
        border-color .18s ease,
        box-shadow .18s ease,
        background-color .18s ease;
}


.topic-form-group input {

    height: 52px;

    padding:
        0 15px;
}


.topic-form-group textarea {

    min-height: 155px;

    padding:
        14px 15px;

    resize: vertical;

    line-height: 1.7;
}


/* ============================================================
   PLACEHOLDER
   ============================================================ */

.topic-form-group input::placeholder,
.topic-form-group textarea::placeholder {

    color: #a8b3c2;

    opacity: 1;
}


/* ============================================================
   HOVER
   ============================================================ */

.topic-form-group input:hover,
.topic-form-group textarea:hover {

    border-color:
        #94a3b8;
}


/* ============================================================
   FOCUS
   ============================================================ */

.topic-form-group input:focus,
.topic-form-group textarea:focus {

    border-color:
        var(--topic-blue);

    box-shadow:
        0 0 0 4px rgba(37, 99, 235, .10);
}


/* ============================================================
   HELP TEXT
   ============================================================ */

.topic-help {

    display: flex;
    align-items: flex-start;

    gap: 6px;

    margin-top: 8px;

    color:
        var(--topic-muted);

    font-size: 13px;

    line-height: 1.55;
}


.topic-help i {

    flex-shrink: 0;

    margin-top: 2px;

    color:
        var(--topic-blue);

    font-size: 16px;
}


/* ============================================================
   ERROR
   ============================================================ */

.topic-error {

    display: flex;
    align-items: center;

    gap: 6px;

    margin-top: 8px;

    color:
        var(--topic-danger);

    font-size: 13px;

    line-height: 1.5;

    font-weight: 600;
}


/* ============================================================
   FORM ACTIONS
   ============================================================ */

.topic-form-actions {

    display: flex;

    align-items: center;

    justify-content: flex-end;

    gap: 10px;

    padding:
        19px 24px 23px;

    border-top:
        1px solid var(--topic-border-light);

    background:
        #fcfdff;
}


/* ============================================================
   BUTTONS
   ============================================================ */

.topic-btn {

    min-height: 48px;

    display: inline-flex;

    align-items: center;

    justify-content: center;

    gap: 8px;

    padding:
        0 20px;

    border-radius: 10px;

    font-family: inherit;

    font-size: 14px;

    font-weight: 800;

    text-decoration: none;

    cursor: pointer;

    transition:
        transform .18s ease,
        background-color .18s ease,
        border-color .18s ease,
        color .18s ease,
        box-shadow .18s ease;
}


/* ============================================================
   CANCEL
   Neutral
   ============================================================ */

.topic-btn-secondary {

    border:
        1px solid var(--topic-border);

    background:
        var(--topic-surface);

    color:
        var(--topic-text-secondary);
}


.topic-btn-secondary:hover {

    background:
        var(--topic-soft);

    border-color:
        #cbd5e1;

    color:
        var(--topic-text);
}


/* ============================================================
   CREATE TOPIC
   Blue accent
   ============================================================ */

.topic-btn-primary {

    border:
        1px solid var(--topic-blue);

    background:
        var(--topic-blue);

    color:
        #ffffff;

    box-shadow:
        0 5px 12px rgba(37, 99, 235, .17);
}


.topic-btn-primary:hover {

    background:
        var(--topic-blue-dark);

    border-color:
        var(--topic-blue-dark);

    transform:
        translateY(-1px);

    box-shadow:
        0 7px 17px rgba(37, 99, 235, .21);
}


.topic-btn-primary:active {

    transform:
        translateY(0);
}


.topic-btn i {
    font-size: 18px;
}


/* ============================================================
   FOCUS VISIBLE
   ============================================================ */

.topic-page button:focus-visible,
.topic-page a:focus-visible,
.topic-page input:focus-visible,
.topic-page textarea:focus-visible {

    outline:
        3px solid rgba(37, 99, 235, .14);

    outline-offset: 2px;
}


/* ============================================================
   RESPONSIVE
   ============================================================ */

@media (max-width: 700px) {

    .topic-page {

        padding:
            22px 16px 45px;
    }


    .topic-header h1 {

        font-size:
            30px;
    }


    .topic-header p {

        font-size:
            14px;
    }


    .topic-card-header {

        padding:
            18px;
    }


    .topic-form-body {

        padding:
            22px 18px;
    }


    .topic-form-actions {

        padding:
            17px 18px 19px;
    }
}


@media (max-width: 520px) {

    .topic-header-top {

        gap:
            10px;
    }


    .topic-back-btn {

        width:
            40px;

        height:
            40px;

        flex-basis:
            40px;
    }


    .topic-back-btn i {

        font-size:
            20px;
    }


    .topic-class-name {

        font-size:
            11px;
    }


    .topic-title-row {

        gap:
            8px;
    }


    .topic-title-mark {

        width:
            5px;

        height:
            31px;

        flex-basis:
            5px;
    }


    .topic-header h1 {

        font-size:
            27px;
    }


    .topic-header p {

        margin-left:
            13px;

        font-size:
            13px;
    }


    .topic-card {

        border-radius:
            14px;
    }


    .topic-card-header {

        padding:
            16px;
    }


    .topic-card-icon {

        width:
            39px;

        height:
            39px;

        flex-basis:
            39px;

        font-size:
            19px;
    }


    .topic-card-heading h2 {

        font-size:
            18px;
    }


    .topic-card-heading p {

        font-size:
            12px;
    }


    .topic-form-body {

        padding:
            20px 16px;
    }


    .topic-form-group label {

        font-size:
            14px;
    }


    .topic-form-group input,
    .topic-form-group textarea {

        font-size:
            15px;
    }


    .topic-form-actions {

        display:
            grid;

        grid-template-columns:
            1fr 1fr;

        padding:
            15px 16px 17px;
    }


    .topic-btn {

        width:
            100%;

        padding:
            0 12px;
    }
}


/* ============================================================
   DARK MODE
   ============================================================ */

.dark-mode .topic-page {

    --topic-blue:
        #7da2ff;

    --topic-blue-dark:
        #91adff;

    --topic-blue-soft:
        rgba(125, 162, 255, .11);

    --topic-blue-border:
        rgba(125, 162, 255, .30);


    --topic-text:
        #f5f5ff;

    --topic-text-secondary:
        #e7e8f7;

    --topic-muted:
        #a4a6c5;

    --topic-light:
        #9294b5;


    --topic-border:
        #2d3050;

    --topic-border-light:
        #272a45;


    --topic-surface:
        #171932;

    --topic-soft:
        #1d1f3a;


    --topic-shadow:
        0 8px 28px rgba(0, 0, 10, .28);

    --topic-small-shadow:
        0 2px 10px rgba(0, 0, 10, .20);
}


/* ============================================================
   DARK MODE CARD
   ============================================================ */

.dark-mode .topic-page .topic-card {

    background:
        var(--topic-surface);

    border-color:
        var(--topic-border);

    box-shadow:
        var(--topic-shadow);
}


/* ============================================================
   DARK MODE BACK BUTTON
   ============================================================ */

.dark-mode .topic-page .topic-back-btn {

    background:
        var(--topic-surface);

    border-color:
        var(--topic-border);

    color:
        var(--topic-muted);
}


.dark-mode .topic-page .topic-back-btn:hover {

    background:
        var(--topic-blue-soft);

    border-color:
        var(--topic-blue-border);

    color:
        var(--topic-blue);
}


/* ============================================================
   DARK MODE INPUTS
   ============================================================ */

.dark-mode .topic-page .topic-form-group input,
.dark-mode .topic-page .topic-form-group textarea {

    background:
        #111226;

    border-color:
        #3b3e61;

    color:
        var(--topic-text);
}


.dark-mode .topic-page .topic-form-group input::placeholder,
.dark-mode .topic-page .topic-form-group textarea::placeholder {

    color:
        #73769e;
}


.dark-mode .topic-page .topic-form-group input:hover,
.dark-mode .topic-page .topic-form-group textarea:hover {

    border-color:
        #575b82;
}


.dark-mode .topic-page .topic-form-group input:focus,
.dark-mode .topic-page .topic-form-group textarea:focus {

    border-color:
        var(--topic-blue);

    box-shadow:
        0 0 0 4px rgba(125, 162, 255, .14);
}


/* ============================================================
   DARK MODE ACTION AREA
   ============================================================ */

.dark-mode .topic-page .topic-form-actions {

    background:
        #111226;

    border-color:
        var(--topic-border-light);
}


.dark-mode .topic-page .topic-btn-secondary {

    background:
        var(--topic-surface);

    border-color:
        #3b3e61;

    color:
        var(--topic-text-secondary);
}


.dark-mode .topic-page .topic-btn-secondary:hover {

    background:
        var(--topic-soft);

    border-color:
        #575b82;
}


/* ============================================================
   DARK MODE PRIMARY BUTTON
   ============================================================ */

.dark-mode .topic-page .topic-btn-primary {

    background:
        var(--topic-blue);

    border-color:
        var(--topic-blue);

    color:
        #ffffff;
}

</style>


<div class="topic-page">

    {{-- ========================================================
         HEADER
    ========================================================= --}}

    <div class="topic-header">

        <div class="topic-header-top">

            {{-- BACK --}}

            <a
                href="{{ route(
                    'professor.class-groups.classroom-group.classwork',
                    $classGroup
                ) }}"
                class="topic-back-btn"
                title="Back to Classwork"
            >
                <i class="bx bx-arrow-back"></i>
            </a>


            {{-- HEADER CONTENT --}}

            <div class="topic-header-content">

                <span class="topic-class-name">
                    {{ $classGroup->group_name }}
                </span>


                <div class="topic-title-row">

                    <span class="topic-title-mark"></span>

                    <h1>
                        Create Topic
                    </h1>

                </div>


                <p>
                    Organize your classwork into a new topic.
                </p>

            </div>

        </div>

    </div>


    {{-- ========================================================
         TOPIC CARD
    ========================================================= --}}

    <div class="topic-card">


        {{-- CARD HEADER --}}

        <div class="topic-card-header">

            <div class="topic-card-icon">
                <i class="bx bx-folder-plus"></i>
            </div>


            <div class="topic-card-heading">

                <h2>
                    Topic Information
                </h2>

                <p>
                    Give your topic a clear name and optional description.
                </p>

            </div>

        </div>


        {{-- FORM --}}

        <form
            action="{{ route(
                'professor.class-groups.classroom-group.classwork.topics.store',
                $classGroup
            ) }}"
            method="POST"
        >

            @csrf


            {{-- FORM BODY --}}

            <div class="topic-form-body">


                {{-- TOPIC NAME --}}

                <div class="topic-form-group">

                    <label for="topic_name">

                        Topic Name

                        <span class="topic-required">
                            *
                        </span>

                    </label>


                    <input
                        type="text"
                        id="topic_name"
                        name="topic_name"
                        value="{{ old('topic_name') }}"
                        placeholder="e.g. Chapter 1 — Introduction"
                        maxlength="255"
                        required
                    >


                    @error('topic_name')

                        <span class="topic-error">
                            <i class="bx bx-error-circle"></i>
                            {{ $message }}
                        </span>

                    @enderror

                </div>


                {{-- DESCRIPTION --}}

                <div class="topic-form-group">

                    <label for="description">

                        Description

                    </label>


                    <textarea
                        id="description"
                        name="description"
                        rows="5"
                        placeholder="Optional description for this topic..."
                    >{{ old('description') }}</textarea>


                    <span class="topic-help">

                        <i class="bx bx-info-circle"></i>

                        Add a short description to help students understand
                        what classwork belongs to this topic.

                    </span>


                    @error('description')

                        <span class="topic-error">
                            <i class="bx bx-error-circle"></i>
                            {{ $message }}
                        </span>

                    @enderror

                </div>


            </div>


            {{-- ==================================================
                 ACTIONS
            ================================================== --}}

            <div class="topic-form-actions">


                <a
                    href="{{ route(
                        'professor.class-groups.classroom-group.classwork',
                        $classGroup
                    ) }}"
                    class="topic-btn topic-btn-secondary"
                >

                    <i class="bx bx-x"></i>

                    Cancel

                </a>


                <button
                    type="submit"
                    class="topic-btn topic-btn-primary"
                >

                    <i class="bx bx-plus"></i>

                    Create Topic

                </button>


            </div>

        </form>

    </div>

</div>

@endsection