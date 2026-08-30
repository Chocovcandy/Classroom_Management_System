@extends('layouts.prof_layout')

@section('title', $classGroup->group_name)

@section('content')

<div class="classroom-page">

    {{-- =====================================================
         CLASSROOM NAVIGATION from a component 
    ====================================================== --}}
            @include('professor.class_groups.classroom_group.navigation')
  

    {{-- =====================================================
         PAGE CONTENT
    ====================================================== --}}

    <main class="classroom-content">


        {{-- =====================================================
             WELCOME + ACTIONS
        ====================================================== --}}

        <div class="classroom-welcome-row">


            {{-- WELCOME CARD --}}

            <section class="classroom-welcome">

                <div class="classroom-welcome-main">


                    {{-- WELCOME TEXT --}}

                    <div class="classroom-welcome-text">

                        <span class="classroom-welcome-label">
                            CLASSROOM
                        </span>

                        <h1>
                            Welcome to {{ $classGroup->group_name }}
                        </h1>

                        <p>
                            {{ $classGroup->course->course_name }}
                        </p>


                        {{-- CLASS CODE --}}

                        <div class="classroom-code">

                            <div class="classroom-code-info">

                                <span class="classroom-code-label">
                                    CLASS CODE
                                </span>

                                <strong
                                    class="classroom-code-value"
                                    id="classCodeValue"
                                >
                                    {{ $classGroup->group_code }}
                                </strong>

                            </div>


                            <div class="classroom-code-actions">

                                {{-- COPY --}}

                                <button
                                    type="button"
                                    class="classroom-code-button"
                                    id="copyClassCode"
                                    title="Copy class code"
                                    aria-label="Copy class code"
                                >

                                    <i class="bx bx-copy"></i>

                                    <span class="copy-feedback">
                                        Copied!
                                    </span>

                                </button>


                                {{-- DISPLAY LARGE --}}

                                <button
                                    type="button"
                                    class="classroom-code-button"
                                    id="displayClassCode"
                                    title="Display class code"
                                    aria-label="Display class code"
                                >

                                    <i class="bx bx-expand-alt"></i>

                                </button>

                            </div>

                        </div>

                    </div>


                    {{-- ILLUSTRATION --}}

                    <div class="classroom-welcome-illustration">

                        <div class="welcome-professor">

                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                width="24"
                                height="24"
                                fill="currentColor"
                                viewBox="0 0 24 24"
                            >
                                <path d="m3.6 8.8 2.93-2.2c.52-.39 1.16-.6 1.8-.6H9v6.53c0 2.38-1.32 4.51-3.45 5.58l.89 1.79a8.19 8.19 0 0 0 4.55-7.37V6h4v11.32a2.68 2.68 0 0 0 5.28.65l.68-2.72-1.94-.49-.68 2.72c-.08.31-.35.52-.66.52a.68.68 0 0 1-.68-.68V6h4V4H8.32c-1.07 0-2.14.35-3 1L2.39 7.2l1.2 1.6Z"></path>
                            </svg>

                        </div>


                        <div class="welcome-board">
                            <i class="bx bx-chalkboard"></i>
                        </div>


                        <div class="welcome-illustration-small small-one">
                            <i class="bx bx-book-open"></i>
                        </div>


                        <div class="welcome-illustration-small small-two">

                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                width="24"
                                height="24"
                                fill="currentColor"
                                viewBox="0 0 24 24"
                            >
                                <path d="m21.45 8.61-9-4.5a1 1 0 0 0-.89 0l-6 3-3 1.5-1 .5a1 1 0 0 0-.55.89v6h2v-5.38l2 1v3.83c0 2.06 3.12 4.56 7 4.56s7-2.49 7-4.56v-3.83l2.45-1.22c.34-.17.55-.52.55-.89s-.21-.72-.55-.89Zm-15 .29L12 6.12l6.76 3.38L12 12.88 5.24 9.5l1.21-.61ZM17 15.45c0 .76-2.11 2.56-5 2.56s-5-1.79-5-2.56v-2.83l4.55 2.28c.14.07.29.11.45.11L17 12.62z"></path>
                            </svg>

                        </div>

                    </div>

                </div>

            </section>


            {{-- CLASSROOM ACTIONS --}}

            <div class="classroom-welcome-actions">


                {{-- CLASS INFORMATION --}}

                <button
                    type="button"
                    class="classroom-welcome-action"
                    id="openClassInformation"
                >

                    <i class="bx bx-info-circle"></i>

                    <span>
                        Class Information
                    </span>

                    <i class="bx bx-chevron-right action-arrow"></i>

                </button>


                {{-- ANNOUNCEMENT --}}

                <button
                    type="button"
                    class="classroom-welcome-action"
                    id="openAnnouncementModal"
                >

                    <i class="bx bx-edit"></i>

                    <span>
                        Announcement
                    </span>

                    <i class="bx bx-chevron-right action-arrow"></i>

                </button>

            </div>

        </div>


        {{-- =====================================================
             MAIN CONTENT
        ====================================================== --}}

        <div class="classroom-main-layout">


            {{-- ============================================================
                STREAM
            ============================================================ --}}

            <section class="classroom-stream">

                {{-- ========================================================
                    STREAM HEADER
                ========================================================= --}}

                <div class="classroom-section-header">

                    <div>

                        <span class="classroom-section-label">
                            CLASSROOM
                        </span>

                        <h2>
                            Stream
                        </h2>

                    </div>

                </div>


                {{-- ========================================================
                    STREAM CONTENT
                ========================================================= --}}

                <div class="classroom-stream-card">

                    @forelse ($streamItems as $streamItem)

                        @php

                            $type = $streamItem['type'];

                            /*
                            |--------------------------------------------------------------------------
                            | Icon
                            |--------------------------------------------------------------------------
                            */

                            $icon = match ($type) {

                                'announcement' => 'bx-bell',

                                'material' => 'bx-file',

                                'assignment' => 'bx-task',

                                'quiz' => 'bx-help-circle',

                                'exam' => 'bx-edit-alt',

                                default => 'bx-news',

                            };


                            /*
                            |--------------------------------------------------------------------------
                            | Posted text
                            |--------------------------------------------------------------------------
                            */

                            $action = match ($type) {

                                'announcement' =>
                                    'posted an announcement',

                                'material' =>
                                    'posted a material',

                                'assignment' =>
                                    'posted an assignment',

                                'quiz' =>
                                    'posted a quiz',

                                'exam' =>
                                    'posted an exam',

                                default =>
                                    'posted an activity',

                            };


                            /*
                            |--------------------------------------------------------------------------
                            | Topic
                            |--------------------------------------------------------------------------
                            |
                            | We get the topic directly from the actual classwork model.
                            | Announcements normally don't have a topic.
                            |
                            */

                            $topic = null;

                            if (
                                isset($streamItem['item']) &&
                                isset($streamItem['item']->topic)
                            ) {

                                $topic = $streamItem['item']->topic;

                            }


                            /*
                            |--------------------------------------------------------------------------
                            | Detail Route
                            |--------------------------------------------------------------------------
                            */

                            $detailRoute = match ($type) {

                                'material' => route(
                                    'professor.class-groups.materials.show',
                                    [
                                        'classGroup' => $classGroup,
                                        'material' => $streamItem['item']
                                    ]
                                ),

                                'assignment' => route(
                                    'professor.class-groups.assignments.show',
                                    [
                                        'classGroup' => $classGroup,
                                        'assignment' => $streamItem['item']
                                    ]
                                ),

                                'quiz' => route(
                                    'professor.class-groups.quizzes.show',
                                    [
                                        'classGroup' => $classGroup,
                                        'quiz' => $streamItem['item']
                                    ]
                                ),

                                'exam' => route(
                                    'professor.class-groups.exams.show',
                                    [
                                        'classGroup' => $classGroup,
                                        'exam' => $streamItem['item']
                                    ]
                                ),

                                default => null,

                            };

                        @endphp


                {{-- ====================================================
                    STREAM ITEM
                ===================================================== --}}
                @php
                    $detailRoute = match ($type) {
                        'material' => route(
                            'professor.class-groups.materials.show',
                            [
                                'classGroup' => $classGroup->id,
                                'material' => $streamItem['item']->id,
                            ]
                        ),

                        'assignment' => route(
                            'professor.class-groups.assignments.show',
                            [
                                'classGroup' => $classGroup->id,
                                'assignment' => $streamItem['item']->id,
                            ]
                        ),

                        'quiz' => route(
                            'professor.class-groups.quizzes.show',
                            [
                                'classGroup' => $classGroup->id,
                                'quiz' => $streamItem['item']->id,
                            ]
                        ),

                        'exam' => route(
                            'professor.class-groups.exams.show',
                            [
                                'classGroup' => $classGroup->id,
                                'exam' => $streamItem['item']->id,
                            ]
                        ),

                        default => null,
                    };
                @endphp

                @if ($detailRoute)

                    <a
                        href="{{ $detailRoute }}"
                        class="stream-item-link"
                    >

                @endif

        <article
            class="stream-item stream-item-{{ $type }}"
        >

            {{-- ==================================================
                TYPE ICON
            =================================================== --}}
            <div class="stream-item-icon">
                <i class="bx {{ $icon }}"></i>
            </div>


            {{-- ==================================================
                CONTENT
            =================================================== --}}
            <div class="stream-item-content">

                {{-- ==================================================
                    POSTED INFORMATION
                =================================================== --}}
                <p class="stream-item-posted">

                    <strong>
                        {{ $streamItem['posted_by'] }}
                    </strong>

                    {{ $action }}

                    <span class="stream-item-time">
                        {{ $streamItem['created_at']->diffForHumans() }}
                    </span>

                </p>


                {{-- ==================================================
                    CLASSWORK TITLE
                =================================================== --}}
                <h3 class="stream-item-title">
                    {{ $streamItem['title'] }}
                </h3>


                {{-- ==================================================
                    TOPIC
                =================================================== --}}
                @if ($topic)

                    <div class="stream-item-topic">

                        <i class="bx bx-folder"></i>

                        <span>
                            {{ $topic->topic_name }}
                        </span>

                    </div>

                @endif

            </div>


            {{-- ==================================================
                MORE OPTIONS
            =================================================== --}}
            <button
                type="button"
                class="stream-item-menu"
                aria-label="More options"
                onclick="event.preventDefault(); event.stopPropagation();"
            >
                <i class="bx bx-dots-vertical-rounded"></i>
            </button>

        </article>

@if ($detailRoute)

    </a>

@endif


                    @empty


                        {{-- ====================================================
                            EMPTY STREAM
                        ===================================================== --}}

                        <div class="classroom-stream-empty">

                            <div class="classroom-stream-empty-icon">

                                <i class="bx bx-news"></i>

                            </div>


                            <h3>
                                No activity yet
                            </h3>


                            <p>

                                Announcements, materials, assignments,
                                quizzes, and exams will appear here.

                            </p>

                        </div>


                    @endforelse

                </div>

            </section>

        </div>

    </main>


    {{-- =====================================================
         CLASS INFORMATION MODAL
    ====================================================== --}}

    <div
        class="classroom-info-modal"
        id="classroomInfoModal"
        aria-hidden="true"
    >

        <div
            class="classroom-info-modal-overlay"
            id="classroomInfoModalOverlay"
        ></div>


        <div
            class="classroom-info-dialog"
            role="dialog"
            aria-modal="true"
            aria-labelledby="classroomInfoTitle"
        >


            {{-- HEADER --}}

            <div class="classroom-info-header">

                <div>

                    <span class="classroom-info-eyebrow">
                        CLASS INFORMATION
                    </span>

                    <h2 id="classroomInfoTitle">
                        {{ $classGroup->group_name }}
                    </h2>

                    <p>
                        View information about this class.
                    </p>

                </div>


                <button
                    type="button"
                    class="classroom-info-close"
                    id="closeClassroomInfo"
                    aria-label="Close"
                >

                    <i class="bx bx-x"></i>

                </button>

            </div>


            {{-- BODY --}}

            <div class="classroom-info-body">


                <div class="classroom-info-item">

                    <span class="classroom-info-label">
                        CLASS NAME
                    </span>

                    <strong>
                        {{ $classGroup->group_name }}
                    </strong>

                </div>


                <div class="classroom-info-item">

                    <span class="classroom-info-label">
                        COURSE
                    </span>

                    <strong>
                        {{ $classGroup->course->course_name }}
                    </strong>

                </div>


                <div class="classroom-info-item">

                    <span class="classroom-info-label">
                        CLASS CODE
                    </span>

                    <strong>
                        {{ $classGroup->group_code }}
                    </strong>

                </div>


                <div class="classroom-info-item">

                    <span class="classroom-info-label">
                        PROFESSOR
                    </span>

                    <strong>
                        {{ $classGroup->professor->name ?? 'N/A' }}
                    </strong>

                </div>


                <div class="classroom-info-item classroom-info-description">

                    <span class="classroom-info-label">
                        DESCRIPTION
                    </span>

                    <p>
                        {{ $classGroup->description ?: 'No description provided.' }}
                    </p>

                </div>

            </div>


            {{-- ACTIONS --}}

            <div class="classroom-info-actions">

                <button
                    type="button"
                    class="classroom-info-cancel"
                    id="cancelClassroomInfo"
                >
                    Close
                </button>


                <a
                    href="{{ route(
                        'professor.class-groups.edit',
                        ['classGroup' => $classGroup->id]
                    ) }}"
                    class="classroom-info-edit"
                >

                    <i class="bx bx-edit"></i>

                    Edit Class

                </a>

            </div>

        </div>

    </div>


    {{-- =====================================================
         ANNOUNCEMENT MODAL
    ====================================================== --}}

    <div
        class="classroom-announcement-modal"
        id="announcementModal"
        aria-hidden="true"
    >

        <div
            class="classroom-announcement-overlay"
            id="announcementModalOverlay"
        ></div>


        <div
            class="classroom-announcement-dialog"
            role="dialog"
            aria-modal="true"
            aria-labelledby="announcementModalTitle"
        >


            {{-- HEADER --}}

            <div class="classroom-announcement-header">

                <div>

                    <span class="classroom-announcement-eyebrow">
                        CLASS ANNOUNCEMENT
                    </span>

                    <h2 id="announcementModalTitle">
                        Create Announcement
                    </h2>

                    <p>
                        Share an update with students in
                        {{ $classGroup->group_name }}.
                    </p>

                </div>


                <button
                    type="button"
                    class="classroom-announcement-close"
                    id="closeAnnouncementModal"
                    aria-label="Close announcement"
                >

                    <i class="bx bx-x"></i>

                </button>

            </div>


            {{-- FORM --}}

            <form
                method="POST"
                action="{{ route(
                    'professor.class-groups.announcements.store',
                    ['classGroup' => $classGroup->id]
                ) }}"
                class="classroom-announcement-form"
            >

                @csrf


                {{-- TITLE --}}

                <div class="classroom-announcement-form-group">

                    <label for="announcementTitle">

                        Title

                        <span>*</span>

                    </label>

                    <input
                        type="text"
                        id="announcementTitle"
                        name="title"
                        value="{{ old('title') }}"
                        placeholder="Enter announcement title"
                        required
                    >

                    @error('title')

                        <span class="classroom-announcement-error">
                            {{ $message }}
                        </span>

                    @enderror

                </div>


                {{-- MESSAGE --}}

                <div class="classroom-announcement-form-group">

                    <label for="announcementContent">

                        Message

                        <span>*</span>

                    </label>

                    <textarea
                        id="announcementContent"
                        name="content"
                        rows="6"
                        placeholder="Write your announcement..."
                        required
                    >{{ old('content') }}</textarea>

                    @error('content')

                        <span class="classroom-announcement-error">
                            {{ $message }}
                        </span>

                    @enderror

                </div>


                {{-- ACTIONS --}}

                <div class="classroom-announcement-actions">

                    <button
                        type="button"
                        class="classroom-announcement-cancel"
                        id="cancelAnnouncementModal"
                    >
                        Cancel
                    </button>


                    <button
                        type="submit"
                        class="classroom-announcement-submit"
                    >

                        <i class="bx bx-send"></i>

                        Post Announcement

                    </button>

                </div>

            </form>

        </div>

    </div>


    {{-- =====================================================
         CLASS CODE DISPLAY
    ====================================================== --}}

    <div
        class="class-code-overlay"
        id="classCodeOverlay"
        aria-hidden="true"
    >

        <div class="class-code-display">


            <button
                type="button"
                class="class-code-display-close"
                id="closeClassCode"
                aria-label="Close class code display"
            >

                <i class="bx bx-x"></i>

            </button>


            <span class="class-code-display-label">
                CLASS CODE
            </span>


            <strong
                class="class-code-display-value"
                id="displayClassCodeValue"
            >
                {{ $classGroup->group_code }}
            </strong>


            <p class="class-code-display-help">
                Students can use this code to join the class.
            </p>

        </div>

    </div>

</div>


<script>

document.addEventListener('DOMContentLoaded', function () {


    /* ============================================================
       CLASS INFORMATION MODAL
    ============================================================ */

    const openClassInformation =
        document.getElementById('openClassInformation');

    const classroomInfoModal =
        document.getElementById('classroomInfoModal');

    const classroomInfoModalOverlay =
        document.getElementById('classroomInfoModalOverlay');

    const closeClassroomInfo =
        document.getElementById('closeClassroomInfo');

    const cancelClassroomInfo =
        document.getElementById('cancelClassroomInfo');


    function openClassInfo() {

        if (!classroomInfoModal) return;

        classroomInfoModal.classList.add('show');

        classroomInfoModal.setAttribute(
            'aria-hidden',
            'false'
        );

        document.body.style.overflow = 'hidden';

    }


    function closeClassInfo() {

        if (!classroomInfoModal) return;

        classroomInfoModal.classList.remove('show');

        classroomInfoModal.setAttribute(
            'aria-hidden',
            'true'
        );

        document.body.style.overflow = '';

    }


    if (openClassInformation) {

        openClassInformation.addEventListener(
            'click',
            openClassInfo
        );

    }


    if (closeClassroomInfo) {

        closeClassroomInfo.addEventListener(
            'click',
            closeClassInfo
        );

    }


    if (cancelClassroomInfo) {

        cancelClassroomInfo.addEventListener(
            'click',
            closeClassInfo
        );

    }


    if (classroomInfoModalOverlay) {

        classroomInfoModalOverlay.addEventListener(
            'click',
            closeClassInfo
        );

    }


    /* ============================================================
       ANNOUNCEMENT MODAL
    ============================================================ */

    const openAnnouncementModal =
        document.getElementById('openAnnouncementModal');

    const announcementModal =
        document.getElementById('announcementModal');

    const announcementModalOverlay =
        document.getElementById('announcementModalOverlay');

    const closeAnnouncementModal =
        document.getElementById('closeAnnouncementModal');

    const cancelAnnouncementModal =
        document.getElementById('cancelAnnouncementModal');


    function openAnnouncement() {

        if (!announcementModal) return;

        announcementModal.classList.add('show');

        announcementModal.setAttribute(
            'aria-hidden',
            'false'
        );

        document.body.style.overflow = 'hidden';

    }


    function closeAnnouncement() {

        if (!announcementModal) return;

        announcementModal.classList.remove('show');

        announcementModal.setAttribute(
            'aria-hidden',
            'true'
        );

        document.body.style.overflow = '';

    }


    if (openAnnouncementModal) {

        openAnnouncementModal.addEventListener(
            'click',
            openAnnouncement
        );

    }


    if (closeAnnouncementModal) {

        closeAnnouncementModal.addEventListener(
            'click',
            closeAnnouncement
        );

    }


    if (cancelAnnouncementModal) {

        cancelAnnouncementModal.addEventListener(
            'click',
            closeAnnouncement
        );

    }


    if (announcementModalOverlay) {

        announcementModalOverlay.addEventListener(
            'click',
            closeAnnouncement
        );

    }


    /* ============================================================
       ESCAPE KEY
    ============================================================ */

    document.addEventListener(
        'keydown',
        function (event) {

            if (
                event.key === 'Escape' &&
                classroomInfoModal &&
                classroomInfoModal.classList.contains('show')
            ) {

                closeClassInfo();

            }


            if (
                event.key === 'Escape' &&
                announcementModal &&
                announcementModal.classList.contains('show')
            ) {

                closeAnnouncement();

            }


            if (
                event.key === 'Escape' &&
                classCodeOverlay &&
                classCodeOverlay.classList.contains('show')
            ) {

                closeClassCodeDisplay();

            }

        }
    );


    /* ============================================================
       CLASS CODE
    ============================================================ */

    const copyClassCode =
        document.getElementById('copyClassCode');

    const classCodeValue =
        document.getElementById('classCodeValue');

    const classCodeOverlay =
        document.getElementById('classCodeOverlay');

    const displayClassCode =
        document.getElementById('displayClassCode');

    const closeClassCode =
        document.getElementById('closeClassCode');


    /* ============================================================
       COPY CLASS CODE
    ============================================================ */

    if (copyClassCode && classCodeValue) {

        copyClassCode.addEventListener(
            'click',
            function () {

                const code =
                    classCodeValue.textContent.trim();

                navigator.clipboard
                    .writeText(code)
                    .then(function () {

                        copyClassCode.classList.add('copied');

                        setTimeout(
                            function () {

                                copyClassCode.classList.remove(
                                    'copied'
                                );

                            },
                            1500
                        );

                    })
                    .catch(function (error) {

                        console.error(
                            'Unable to copy class code:',
                            error
                        );

                    });

            }
        );

    }


    /* ============================================================
       DISPLAY LARGE CLASS CODE
    ============================================================ */

    if (displayClassCode && classCodeOverlay) {

        displayClassCode.addEventListener(
            'click',
            function () {

                classCodeOverlay.classList.add('show');

                classCodeOverlay.setAttribute(
                    'aria-hidden',
                    'false'
                );

                document.body.style.overflow = 'hidden';

            }
        );

    }


    /* ============================================================
       CLOSE LARGE CLASS CODE
    ============================================================ */

    function closeClassCodeDisplay() {

        if (!classCodeOverlay) return;

        classCodeOverlay.classList.remove('show');

        classCodeOverlay.setAttribute(
            'aria-hidden',
            'true'
        );

        document.body.style.overflow = '';

    }


    if (closeClassCode) {

        closeClassCode.addEventListener(
            'click',
            closeClassCodeDisplay
        );

    }


    if (classCodeOverlay) {

        classCodeOverlay.addEventListener(
            'click',
            function (event) {

                if (event.target === classCodeOverlay) {

                    closeClassCodeDisplay();

                }

            }
        );

    }

});

</script>

@endsection