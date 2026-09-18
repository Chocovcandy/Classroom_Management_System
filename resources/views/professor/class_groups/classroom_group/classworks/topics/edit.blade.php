@extends('layouts.prof_layout')

@section('title', 'Edit Topic')

@section('content')

<style>

/* ============================================================
   EDIT TOPIC PAGE
   Matches Create Topic design
   ============================================================ */

.topic-edit-page {

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


.topic-edit-page *,
.topic-edit-page *::before,
.topic-edit-page *::after {
    box-sizing: border-box;
}


/* ============================================================
   HEADER
   ============================================================ */

.topic-edit-top {

    display: flex;
    align-items: flex-start;

    gap: 14px;

    margin-bottom: 22px;
}


/* ============================================================
   BACK BUTTON
   ============================================================ */

.topic-edit-back {

    width: 44px;
    height: 44px;

    display: inline-flex;
    align-items: center;
    justify-content: center;

    flex: 0 0 44px;

    border:
        1px solid var(--topic-border);

    border-radius: 11px;

    background:
        var(--topic-surface);

    color:
        var(--topic-muted);

    text-decoration: none;

    box-shadow:
        var(--topic-small-shadow);

    transition:
        color .18s ease,
        border-color .18s ease,
        background-color .18s ease,
        transform .18s ease;
}


.topic-edit-back i {
    font-size: 22px;
}


.topic-edit-back:hover {

    color:
        var(--topic-blue);

    border-color:
        var(--topic-blue-border);

    background:
        var(--topic-blue-soft);

    transform:
        translateX(-2px);
}


/* ============================================================
   HEADER CONTENT
   ============================================================ */

.topic-edit-header-content {
    min-width: 0;
}


.topic-edit-class {

    display: block;

    margin-bottom: 7px;

    color:
        var(--topic-muted);

    font-size: 13px;

    line-height: 1.4;

    font-weight: 800;

    letter-spacing: .08em;

    text-transform: uppercase;
}


.topic-edit-title-row {

    display: flex;
    align-items: center;

    gap: 10px;
}


.topic-edit-title-mark {

    width: 7px;
    height: 38px;

    flex: 0 0 7px;

    border-radius: 999px;

    background:
        var(--topic-blue);
}


.topic-edit-main-title {

    margin: 0;

    color:
        var(--topic-text);

    font-size: 36px;

    line-height: 1.15;

    font-weight: 800;

    letter-spacing: -.035em;
}


.topic-edit-subtitle {

    margin: 9px 0 0 17px;

    color:
        var(--topic-muted);

    font-size: 16px;

    line-height: 1.6;

    font-weight: 500;
}


/* ============================================================
   MAIN CARD
   ============================================================ */

.topic-edit-card {

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

.topic-edit-card-header {

    display: flex;
    align-items: center;

    gap: 13px;

    padding: 21px 24px;

    border-bottom:
        1px solid var(--topic-border-light);
}


.topic-edit-card-icon {

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


.topic-edit-card-heading {
    min-width: 0;
}


.topic-edit-card-heading h2 {

    margin: 0;

    color:
        var(--topic-text);

    font-size: 20px;

    line-height: 1.3;

    font-weight: 800;
}


.topic-edit-card-heading p {

    margin: 4px 0 0;

    color:
        var(--topic-muted);

    font-size: 14px;

    line-height: 1.5;
}


/* ============================================================
   FORM
   ============================================================ */

.topic-edit-form {
    padding: 28px 24px;
}


/* ============================================================
   FORM GROUP
   ============================================================ */

.topic-edit-field {

    margin-bottom: 23px;
}


.topic-edit-field:last-child {
    margin-bottom: 0;
}


/* ============================================================
   LABEL
   ============================================================ */

.topic-edit-label {

    display: flex;
    align-items: center;

    gap: 6px;

    margin: 0 0 9px;

    color:
        var(--topic-text-secondary);

    font-size: 15px;

    line-height: 1.4;

    font-weight: 750;
}


.topic-edit-required {

    color:
        var(--topic-danger);

    font-size: 14px;

    font-weight: 800;
}


/* ============================================================
   INPUT / TEXTAREA
   ============================================================ */

.topic-edit-input,
.topic-edit-textarea {

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


.topic-edit-input {

    height: 52px;

    padding:
        0 15px;
}


.topic-edit-textarea {

    min-height: 155px;

    padding:
        14px 15px;

    resize: vertical;

    line-height: 1.7;
}


/* ============================================================
   PLACEHOLDER
   ============================================================ */

.topic-edit-input::placeholder,
.topic-edit-textarea::placeholder {

    color:
        #a8b3c2;

    opacity: 1;
}


/* ============================================================
   HOVER
   ============================================================ */

.topic-edit-input:hover,
.topic-edit-textarea:hover {

    border-color:
        #94a3b8;
}


/* ============================================================
   FOCUS
   ============================================================ */

.topic-edit-input:focus,
.topic-edit-textarea:focus {

    border-color:
        var(--topic-blue);

    box-shadow:
        0 0 0 4px rgba(37, 99, 235, .10);
}


/* ============================================================
   HELP TEXT
   ============================================================ */

.topic-edit-help {

    display: flex;
    align-items: flex-start;

    gap: 6px;

    margin-top: 8px;

    color:
        var(--topic-muted);

    font-size: 13px;

    line-height: 1.55;
}


.topic-edit-help i {

    flex-shrink: 0;

    margin-top: 2px;

    color:
        var(--topic-blue);

    font-size: 16px;
}


/* ============================================================
   ERROR
   ============================================================ */

.topic-edit-error {

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
   ACTIONS
   ============================================================ */

.topic-edit-actions {

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

.topic-edit-btn {

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


.topic-edit-btn:hover {
    transform: translateY(-1px);
}


.topic-edit-btn i {
    font-size: 18px;
}


/* ============================================================
   CANCEL
   Neutral
   ============================================================ */

.topic-edit-btn.cancel {

    border:
        1px solid var(--topic-border);

    background:
        var(--topic-surface);

    color:
        var(--topic-text-secondary);
}


.topic-edit-btn.cancel:hover {

    background:
        var(--topic-soft);

    border-color:
        #cbd5e1;

    color:
        var(--topic-text);
}


/* ============================================================
   SAVE CHANGES
   Blue accent
   ============================================================ */

.topic-edit-btn.save {

    border:
        1px solid var(--topic-blue);

    background:
        var(--topic-blue);

    color:
        #ffffff;

    box-shadow:
        0 5px 12px rgba(37, 99, 235, .17);
}


.topic-edit-btn.save:hover {

    border-color:
        var(--topic-blue-dark);

    background:
        var(--topic-blue-dark);

    box-shadow:
        0 7px 17px rgba(37, 99, 235, .21);
}


.topic-edit-btn.save:active {

    transform:
        translateY(0);
}


/* ============================================================
   FOCUS VISIBLE
   ============================================================ */

.topic-edit-page button:focus-visible,
.topic-edit-page a:focus-visible,
.topic-edit-page input:focus-visible,
.topic-edit-page textarea:focus-visible {

    outline:
        3px solid rgba(37, 99, 235, .14);

    outline-offset:
        2px;
}


/* ============================================================
   RESPONSIVE
   ============================================================ */

@media (max-width: 700px) {

    .topic-edit-page {

        padding:
            22px 16px 45px;
    }


    .topic-edit-main-title {

        font-size:
            30px;
    }


    .topic-edit-subtitle {

        font-size:
            14px;
    }


    .topic-edit-card-header {

        padding:
            18px;
    }


    .topic-edit-form {

        padding:
            22px 18px;
    }


    .topic-edit-actions {

        padding:
            17px 18px 19px;
    }
}


@media (max-width: 520px) {

    .topic-edit-top {

        gap:
            10px;
    }


    .topic-edit-back {

        width:
            40px;

        height:
            40px;

        flex-basis:
            40px;
    }


    .topic-edit-back i {

        font-size:
            20px;
    }


    .topic-edit-class {

        font-size:
            11px;
    }


    .topic-edit-title-row {

        gap:
            8px;
    }


    .topic-edit-title-mark {

        width:
            5px;

        height:
            31px;

        flex-basis:
            5px;
    }


    .topic-edit-main-title {

        font-size:
            27px;
    }


    .topic-edit-subtitle {

        margin-left:
            13px;

        font-size:
            13px;
    }


    .topic-edit-card {

        border-radius:
            14px;
    }


    .topic-edit-card-header {

        padding:
            16px;
    }


    .topic-edit-card-icon {

        width:
            39px;

        height:
            39px;

        flex-basis:
            39px;

        font-size:
            19px;
    }


    .topic-edit-card-heading h2 {

        font-size:
            18px;
    }


    .topic-edit-card-heading p {

        font-size:
            12px;
    }


    .topic-edit-form {

        padding:
            20px 16px;
    }


    .topic-edit-label {

        font-size:
            14px;
    }


    .topic-edit-input,
    .topic-edit-textarea {

        font-size:
            15px;
    }


    .topic-edit-actions {

        display:
            grid;

        grid-template-columns:
            1fr 1fr;

        padding:
            15px 16px 17px;
    }


    .topic-edit-btn {

        width:
            100%;

        padding:
            0 12px;
    }
}


/* ============================================================
   DARK MODE
   ============================================================ */

.dark-mode .topic-edit-page {

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

.dark-mode .topic-edit-page .topic-edit-card {

    background:
        var(--topic-surface);

    border-color:
        var(--topic-border);

    box-shadow:
        var(--topic-shadow);
}


/* ============================================================
   DARK MODE BACK
   ============================================================ */

.dark-mode .topic-edit-page .topic-edit-back {

    background:
        var(--topic-surface);

    border-color:
        var(--topic-border);

    color:
        var(--topic-muted);
}


.dark-mode .topic-edit-page .topic-edit-back:hover {

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

.dark-mode .topic-edit-page .topic-edit-input,
.dark-mode .topic-edit-page .topic-edit-textarea {

    background:
        #111226;

    border-color:
        #3b3e61;

    color:
        var(--topic-text);
}


.dark-mode .topic-edit-page .topic-edit-input::placeholder,
.dark-mode .topic-edit-page .topic-edit-textarea::placeholder {

    color:
        #73769e;
}


.dark-mode .topic-edit-page .topic-edit-input:hover,
.dark-mode .topic-edit-page .topic-edit-textarea:hover {

    border-color:
        #575b82;
}


.dark-mode .topic-edit-page .topic-edit-input:focus,
.dark-mode .topic-edit-page .topic-edit-textarea:focus {

    border-color:
        var(--topic-blue);

    box-shadow:
        0 0 0 4px rgba(125, 162, 255, .14);
}


/* ============================================================
   DARK MODE ACTIONS
   ============================================================ */

.dark-mode .topic-edit-page .topic-edit-actions {

    background:
        #111226;

    border-color:
        var(--topic-border-light);
}


.dark-mode .topic-edit-page .topic-edit-btn.cancel {

    background:
        var(--topic-surface);

    border-color:
        #3b3e61;

    color:
        var(--topic-text-secondary);
}


.dark-mode .topic-edit-page .topic-edit-btn.cancel:hover {

    background:
        var(--topic-soft);

    border-color:
        #575b82;
}


/* ============================================================
   DARK MODE SAVE BUTTON
   ============================================================ */

.dark-mode .topic-edit-page .topic-edit-btn.save {

    background:
        var(--topic-blue);

    border-color:
        var(--topic-blue);

    color:
        #ffffff;
}

</style>


<div class="topic-edit-page">


    {{-- ========================================================
         HEADER
    ========================================================= --}}

    <div class="topic-edit-top">


        {{-- BACK --}}

        <a
            href="{{ route(
                'professor.class-groups.classroom-group.classwork',
                ['classGroup' => $classGroup->id]
            ) }}"
            class="topic-edit-back"
            title="Back to Classwork"
        >

            <i class="bx bx-arrow-back"></i>

        </a>


        {{-- HEADER CONTENT --}}

        <div class="topic-edit-header-content">

            <span class="topic-edit-class">
                {{ $classGroup->group_name }}
            </span>


            <div class="topic-edit-title-row">

                <span class="topic-edit-title-mark"></span>

                <h1 class="topic-edit-main-title">
                    Edit Topic
                </h1>

            </div>


            <p class="topic-edit-subtitle">
                Update the topic information for your class.
            </p>

        </div>

    </div>


    {{-- ========================================================
         EDIT CARD
    ========================================================= --}}

    <section class="topic-edit-card">


        {{-- CARD HEADER --}}

        <header class="topic-edit-card-header">

            <div class="topic-edit-card-icon">

                <i class="bx bx-folder"></i>

            </div>


            <div class="topic-edit-card-heading">

                <h2>
                    Topic Information
                </h2>

                <p>
                    Update the topic name and description below.
                </p>

            </div>

        </header>


        {{-- ==================================================
             FORM
        ================================================== --}}

        <form
            action="{{ route(
                'professor.class-groups.classroom-group.classwork.topics.update',
                [
                    'classGroup' => $classGroup->id,
                    'topic' => $topic->id,
                ]
            ) }}"
            method="POST"
        >

            @csrf

            @method('PUT')


            <div class="topic-edit-form">


                {{-- ==================================================
                     TOPIC NAME
                ================================================== --}}

                <div class="topic-edit-field">

                    <label
                        for="topic_name"
                        class="topic-edit-label"
                    >

                        Topic Name

                        <span class="topic-edit-required">
                            *
                        </span>

                    </label>


                    <input
                        type="text"
                        id="topic_name"
                        name="topic_name"
                        class="topic-edit-input"
                        value="{{ old('topic_name', $topic->topic_name) }}"
                        placeholder="Enter topic name"
                        maxlength="255"
                        required
                    >


                    @error('topic_name')

                        <div class="topic-edit-error">

                            <i class="bx bx-error-circle"></i>

                            {{ $message }}

                        </div>

                    @enderror

                </div>


                {{-- ==================================================
                     DESCRIPTION
                ================================================== --}}

                <div class="topic-edit-field">

                    <label
                        for="description"
                        class="topic-edit-label"
                    >
                        Description
                    </label>


                    <textarea
                        id="description"
                        name="description"
                        class="topic-edit-textarea"
                        placeholder="Add a description for this topic..."
                        maxlength="1000"
                    >{{ old('description', $topic->description) }}</textarea>


                    <span class="topic-edit-help">

                        <i class="bx bx-info-circle"></i>

                        Add a short description to help students understand
                        what classwork belongs to this topic.

                    </span>


                    @error('description')

                        <div class="topic-edit-error">

                            <i class="bx bx-error-circle"></i>

                            {{ $message }}

                        </div>

                    @enderror

                </div>


            </div>


            {{-- ==================================================
                 ACTIONS
            ================================================== --}}

            <div class="topic-edit-actions">


                <a
                    href="{{ route(
                        'professor.class-groups.classroom-group.classwork',
                        ['classGroup' => $classGroup->id]
                    ) }}"
                    class="topic-edit-btn cancel"
                >

                    <i class="bx bx-x"></i>

                    Cancel

                </a>


                <button
                    type="submit"
                    class="topic-edit-btn save"
                >

                    <i class="bx bx-save"></i>

                    Save Changes

                </button>


            </div>

        </form>

    </section>

</div>

@endsection