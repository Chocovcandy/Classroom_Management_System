@extends('layouts.prof_layout')

@section('title', $classGroup->group_name)

@section('content')

<div class="classroom-page">

    {{-- ============================================================
         CLASSROOM NAVIGATION
    ============================================================= --}}
    @include('professor.class_groups.classroom_group.navigation')


    {{-- ============================================================
         PAGE CONTENT
    ============================================================= --}}
    <main class="classroom-content">


        {{-- ========================================================
             WELCOME + CLASSROOM ACTIONS
        ========================================================= --}}
        <div class="classroom-welcome-row">


            {{-- ====================================================
                 WELCOME CARD
            ===================================================== --}}
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
                                    id="classCodeValue">
                                    {{ $classGroup->group_code }}
                                </strong>

                            </div>


                            <div class="classroom-code-actions">

                                {{-- COPY CLASS CODE --}}
                                <button
                                    type="button"
                                    class="classroom-code-button"
                                    id="copyClassCode"
                                    title="Copy class code"
                                    aria-label="Copy class code">
                                    <i class="bx bx-copy"></i>

                                    <span class="copy-feedback">
                                        Copied!
                                    </span>
                                </button>


                                {{-- DISPLAY LARGE CLASS CODE --}}
                                <button
                                    type="button"
                                    class="classroom-code-button"
                                    id="displayClassCode"
                                    title="Display class code"
                                    aria-label="Display class code">
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
                                viewBox="0 0 24 24">
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
                                viewBox="0 0 24 24">
                                <path d="m21.45 8.61-9-4.5a1 1 0 0 0-.89 0l-6 3-3 1.5-1 .5a1 1 0 0 0-.55.89v6h2v-5.38l2 1v3.83c0 2.06 3.12 4.56 7 4.56s7-2.49 7-4.56v-3.83l2.45-1.22c.34-.17.55-.52.55-.89s-.21-.72-.55-.89Zm-15 .29L12 6.12l6.76 3.38L12 12.88 5.24 9.5l1.21-.61ZM17 15.45c0 .76-2.11 2.56-5 2.56s-5-1.79-5-2.56v-2.83l4.55 2.28c.14.07.29.11.45.11L17 12.62z"></path>
                            </svg>
                        </div>

                    </div>

                </div>

            </section>


            {{-- ====================================================
                 CLASSROOM ACTIONS
            ===================================================== --}}
            <div class="classroom-welcome-actions">


                {{-- CLASS INFORMATION --}}
                <button
                    type="button"
                    class="classroom-welcome-action"
                    id="openClassInformation">
                    <i class="bx bx-info-circle"></i>

                    <span>
                        Class Information
                    </span>

                    <i class="bx bx-chevron-right action-arrow"></i>
                </button>


                {{-- CREATE ANNOUNCEMENT --}}
                <button
                    type="button"
                    class="classroom-welcome-action"
                    id="openAnnouncementModal">
                    <i class="bx bx-edit"></i>

                    <span>
                        Announcement
                    </span>

                    <i class="bx bx-chevron-right action-arrow"></i>
                </button>

            </div>

        </div>


        {{-- ============================================================
             MAIN STREAM
        ============================================================= --}}
        <div class="classroom-main-layout">

            <section class="classroom-stream">

    <style>
        /* ============================================================
           STREAM CONTENT ONLY
           Light card style to match the rest of the classroom.
           No dark background is used here.
           ============================================================ */

        .stream-content-redesign {
            width: 100%;
        }

        .stream-content-redesign .classroom-stream-card {
            overflow: hidden;
            border: 1px solid #e6eaf0;
            border-radius: 16px;
            background: #ffffff;
            box-shadow: 0 4px 16px rgba(15, 23, 42, 0.035);
        }

        /* ------------------------------------------------------------
           ACTIVITY ROW
           ------------------------------------------------------------ */

        .stream-content-redesign .stream-item {
            position: relative;
            display: flex;
            align-items: flex-start;
            gap: 16px;
            min-height: 86px;
            padding: 18px 20px;
            border-bottom: 1px solid #eef1f5;
            background: #ffffff;
            transition: background-color .18s ease;
        }

        .stream-content-redesign .stream-item:last-child {
            border-bottom: 0;
        }

        .stream-content-redesign .stream-item:hover {
            background: #fafcff;
        }

        /* Small type indicator */
        .stream-content-redesign .stream-item::before {
            position: absolute;
            top: 15px;
            bottom: 15px;
            left: 0;
            width: 3px;
            border-radius: 0 3px 3px 0;
            background: #cbd5e1;
            content: "";
        }

        .stream-content-redesign .stream-item-announcement::before {
            background: #f97316;
        }

        .stream-content-redesign .stream-item-material::before {
            background: #3b82f6;
        }

        .stream-content-redesign .stream-item-assignment::before {
            background: #6366f1;
        }

        .stream-content-redesign .stream-item-quiz::before {
            background: #f59e0b;
        }

        .stream-content-redesign .stream-item-exam::before {
            background: #ef4444;
        }

        .stream-content-redesign .stream-item-project::before {
            background: #eab308;
        }

        /* ------------------------------------------------------------
           ICON
           ------------------------------------------------------------ */

        .stream-content-redesign .stream-item-icon {
            display: grid;
            place-items: center;
            width: 44px;
            height: 44px;
            flex: 0 0 44px;
            margin-top: 1px;
            border-radius: 12px;
            background: #f3f6fa;
            color: #64748b;
            font-size: 20px;
        }

        .stream-content-redesign .stream-item-announcement .stream-item-icon {
            background: #fff7ed;
            color: #ea580c;
        }

        .stream-content-redesign .stream-item-material .stream-item-icon {
            background: #eff6ff;
            color: #2563eb;
        }

        .stream-content-redesign .stream-item-assignment .stream-item-icon {
            background: #eef2ff;
            color: #4f46e5;
        }

        .stream-content-redesign .stream-item-quiz .stream-item-icon {
            background: #fff8e8;
            color: #d97706;
        }

        .stream-content-redesign .stream-item-exam .stream-item-icon {
            background: #fef2f2;
            color: #dc2626;
        }

        /* Project = yellow */
        .stream-content-redesign .stream-item-project .stream-item-icon {
            background: #fff8d6;
            color: #a16207;
        }

        /* ------------------------------------------------------------
           CONTENT
           ------------------------------------------------------------ */

        .stream-content-redesign .stream-item-content {
            min-width: 0;
            flex: 1;
            padding-right: 8px;
        }

        .stream-content-redesign .stream-item-posted {
            margin: 0 0 5px;
            color: #7a8697;
            font-size: 12px;
            line-height: 1.45;
        }

        .stream-content-redesign .stream-item-posted strong {
            color: #334155;
            font-weight: 700;
        }

        .stream-content-redesign .stream-item-time {
            color: #a0a9b7;
        }

        .stream-content-redesign .stream-item-title {
            margin: 0;
            color: #18212f;
            font-size: 15px;
            font-weight: 700;
            line-height: 1.4;
        }

        .stream-content-redesign .stream-item-content-link {
            display: block;
            color: inherit;
            text-decoration: none;
        }

        .stream-content-redesign .stream-item-content-link:hover .stream-item-title {
            color: #2563eb;
        }

        .stream-content-redesign .stream-item-project .stream-item-content-link:hover .stream-item-title {
            color: #a16207;
        }

        /* Topic */
        .stream-content-redesign .stream-item-topic {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            margin-top: 8px;
            padding: 4px 8px;
            border: 1px solid #e6eaf0;
            border-radius: 7px;
            background: #f8fafc;
            color: #64748b;
            font-size: 10px;
            font-weight: 650;
        }

        .stream-content-redesign .stream-item-topic i {
            font-size: 12px;
        }

        /* Project metadata */
        .stream-content-redesign .stream-project-meta {
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            gap: 7px;
            margin-top: 8px;
        }

        .stream-content-redesign .stream-project-badge,
        .stream-content-redesign .stream-project-type {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            padding: 4px 8px;
            border-radius: 7px;
            font-size: 10px;
            font-weight: 700;
        }

        .stream-content-redesign .stream-project-badge {
            background: #fff8d6;
            color: #946f00;
        }

        .stream-content-redesign .stream-project-type {
            border: 1px solid #e6eaf0;
            background: #f8fafc;
            color: #64748b;
        }

        .stream-content-redesign .stream-project-badge i,
        .stream-content-redesign .stream-project-type i {
            font-size: 12px;
        }

        /* Announcement */
        .stream-content-redesign .stream-announcement-text {
            max-width: 760px;
            margin: 6px 0 0;
            color: #64748b;
            font-size: 12px;
            line-height: 1.65;
            display: -webkit-box;
            overflow: hidden;
            -webkit-box-orient: vertical;
            -webkit-line-clamp: 3;
        }

        /* ------------------------------------------------------------
           THREE DOT MENU
           ------------------------------------------------------------ */

        .stream-content-redesign .stream-item-options {
            position: relative;
            flex: 0 0 auto;
            margin-left: auto;
        }

        .stream-content-redesign .stream-item-menu {
            display: grid;
            place-items: center;
            width: 32px;
            height: 32px;
            border: 0;
            border-radius: 9px;
            background: transparent;
            color: #9aa5b4;
            cursor: pointer;
            transition: background-color .18s ease, color .18s ease;
        }

        .stream-content-redesign .stream-item-menu:hover,
        .stream-content-redesign .stream-item-options.show .stream-item-menu {
            background: #f1f5f9;
            color: #334155;
        }

        .stream-content-redesign .stream-options-menu {
            z-index: 20;
            min-width: 140px;
            overflow: hidden;
            border: 1px solid #e2e8f0;
            border-radius: 10px;
            background: #ffffff;
            box-shadow: 0 12px 28px rgba(15, 23, 42, .12);
        }

        .stream-content-redesign .stream-options-item {
            display: flex;
            align-items: center;
            gap: 8px;
            width: 100%;
            padding: 9px 11px;
            border: 0;
            background: transparent;
            color: #475569;
            font-size: 12px;
            font-weight: 650;
            text-decoration: none;
            cursor: pointer;
        }

        .stream-content-redesign .stream-options-item:hover {
            background: #f8fafc;
            color: #0f172a;
        }

        .stream-content-redesign .stream-options-delete {
            color: #dc2626;
        }

        /* ------------------------------------------------------------
           EMPTY STATE
           ------------------------------------------------------------ */

        .stream-content-redesign .classroom-stream-empty {
            padding: 55px 24px;
            text-align: center;
            background: #ffffff;
        }

        .stream-content-redesign .classroom-stream-empty-icon {
            display: grid;
            place-items: center;
            width: 46px;
            height: 46px;
            margin: 0 auto 12px;
            border-radius: 12px;
            background: #f4f6f9;
            color: #a0a9b7;
            font-size: 21px;
        }

        .stream-content-redesign .classroom-stream-empty h3 {
            margin: 0;
            color: #334155;
            font-size: 14px;
            font-weight: 700;
        }

        .stream-content-redesign .classroom-stream-empty p {
            max-width: 460px;
            margin: 6px auto 0;
            color: #94a3b8;
            font-size: 12px;
            line-height: 1.6;
        }

        @media (max-width: 700px) {
            .stream-content-redesign .stream-item {
                gap: 11px;
                min-height: 0;
                padding: 15px 13px;
            }

            .stream-content-redesign .stream-item::before {
                top: 13px;
                bottom: 13px;
            }

            .stream-content-redesign .stream-item-icon {
                width: 38px;
                height: 38px;
                flex-basis: 38px;
                border-radius: 10px;
                font-size: 18px;
            }

            .stream-content-redesign .stream-item-posted {
                font-size: 11px;
            }

            .stream-content-redesign .stream-item-title {
                font-size: 14px;
            }
        }
    </style>

    <div class="stream-content-redesign">

        <div class="classroom-stream-card">

            @forelse ($streamItems as $streamItem)

                @php

                    $type = $streamItem['type'];
                    $item = $streamItem['item'] ?? null;

                    $icon = match ($type) {

                        'announcement' => 'bx-bell',
                        'material' => 'bx-file',
                        'assignment' => 'bx-task',
                        'quiz' => 'bx-help-circle',
                        'exam' => 'bx-edit-alt',
                        'project' => 'bx-briefcase-alt-2',

                        default => 'bx-news',
                    };

                    $action = match ($type) {

                        'announcement' => 'posted an announcement',
                        'material' => 'posted a material',
                        'assignment' => 'posted an assignment',
                        'quiz' => 'posted a quiz',
                        'exam' => 'posted an exam',
                        'project' => 'posted a project',

                        default => 'posted an activity',
                    };

                    $topic = null;

                    if ($item && isset($item->topic)) {
                        $topic = $item->topic;
                    }

                    $detailRoute = match ($type) {

                        'material' => route(
                            'professor.class-groups.materials.show',
                            [
                                'classGroup' => $classGroup->id,
                                'material' => $item->id,
                            ]
                        ),

                        'assignment' => route(
                            'professor.class-groups.assignments.show',
                            [
                                'classGroup' => $classGroup->id,
                                'assignment' => $item->id,
                            ]
                        ),

                        'quiz' => route(
                            'professor.class-groups.quizzes.show',
                            [
                                'classGroup' => $classGroup->id,
                                'quiz' => $item->id,
                            ]
                        ),

                        'exam' => route(
                            'professor.class-groups.exams.show',
                            [
                                'classGroup' => $classGroup->id,
                                'exam' => $item->id,
                            ]
                        ),

                        'project' => route(
                            'professor.classworks.projects.show',
                            [
                                'classGroupId' => $classGroup->id,
                                'projectId' => $item->id,
                            ]
                        ),

                        default => null,
                    };

                @endphp

                <article
                    class="stream-item stream-item-{{ $type }}"
                    data-type="{{ $type }}">

                    <div class="stream-item-icon">
                        <i class="bx {{ $icon }}"></i>
                    </div>

                    <div class="stream-item-content">

                        <p class="stream-item-posted">
                            <strong>{{ $streamItem['posted_by'] }}</strong>
                            {{ $action }}
                            <span class="stream-item-time">
                                · {{ $streamItem['created_at']->diffForHumans() }}
                            </span>
                        </p>

                        @if ($type === 'announcement')

                            <div class="stream-announcement-content">

                                <h3 class="stream-item-title">
                                    {{ $streamItem['title'] }}
                                </h3>

                                @if (!empty($item->content))
                                    <p class="stream-announcement-text">
                                        {{ $item->content }}
                                    </p>
                                @endif

                            </div>

                        @else

                            @if ($detailRoute)

                                <a
                                    href="{{ $detailRoute }}"
                                    class="stream-item-content-link">

                                    <h3 class="stream-item-title">
                                        {{ $streamItem['title'] }}
                                    </h3>

                                    @if ($topic)
                                        <div class="stream-item-topic">
                                            <i class="bx bx-folder"></i>
                                            <span>{{ $topic->topic_name }}</span>
                                        </div>
                                    @endif

                                    @if ($type === 'project')

                                        <div class="stream-project-meta">

                                            <span class="stream-project-badge">
                                                <i class="bx bx-briefcase-alt-2"></i>
                                                Project
                                            </span>

                                            <span class="stream-project-type">
                                                <i class="bx bx-group"></i>
                                                {{ ucfirst($item->project_type ?? 'individual') }}
                                            </span>

                                        </div>

                                    @endif

                                </a>

                            @else

                                <h3 class="stream-item-title">
                                    {{ $streamItem['title'] }}
                                </h3>

                            @endif

                        @endif

                    </div>

                    @if (
                        $item &&
                        $item->user_id === Auth::id() &&
                        in_array($type, [
                            'announcement',
                            'material',
                            'assignment',
                            'quiz',
                            'exam',
                            'project',
                        ])
                    )

                        <div class="stream-item-options">

                            <button
                                type="button"
                                class="stream-item-menu"
                                aria-label="More options">
                                <i class="bx bx-dots-vertical-rounded"></i>
                            </button>

                            <div class="stream-options-menu">

                                @if ($type === 'announcement')

                                    <a
                                        href="{{ route(
                                            'professor.class-groups.announcements.edit',
                                            [
                                                'classGroup' => $classGroup,
                                                'announcement' => $item,
                                            ]
                                        ) }}"
                                        class="stream-options-item">
                                        <i class="bx bx-edit"></i>
                                        <span>Edit</span>
                                    </a>

                                @elseif ($type === 'material')

                                    <a
                                        href="{{ route(
                                            'professor.class-groups.materials.edit',
                                            [
                                                'classGroup' => $classGroup,
                                                'material' => $item,
                                                'return_to' => 'stream',
                                            ]
                                        ) }}"
                                        class="stream-options-item">
                                        <i class="bx bx-edit"></i>
                                        <span>Edit</span>
                                    </a>

                                @elseif ($type === 'assignment')

                                    <a
                                        href="{{ route(
                                            'professor.class-groups.assignments.edit',
                                            [
                                                'classGroup' => $classGroup,
                                                'assignment' => $item,
                                                'return_to' => 'stream',
                                            ]
                                        ) }}"
                                        class="stream-options-item">
                                        <i class="bx bx-edit"></i>
                                        <span>Edit</span>
                                    </a>

                                @elseif ($type === 'quiz')

                                    <a
                                        href="{{ route(
                                            'professor.class-groups.quizzes.edit',
                                            [
                                                'classGroup' => $classGroup,
                                                'quiz' => $item,
                                                'return_to' => 'stream',
                                            ]
                                        ) }}"
                                        class="stream-options-item">
                                        <i class="bx bx-edit"></i>
                                        <span>Edit</span>
                                    </a>

                                @elseif ($type === 'exam')

                                    <a
                                        href="{{ route(
                                            'professor.class-groups.exams.edit',
                                            [
                                                'classGroup' => $classGroup,
                                                'exam' => $item,
                                                'return_to' => 'stream',
                                            ]
                                        ) }}"
                                        class="stream-options-item">
                                        <i class="bx bx-edit"></i>
                                        <span>Edit</span>
                                    </a>

                                @elseif ($type === 'project')

                                    <a
                                        href="{{ route(
                                            'professor.classworks.projects.edit',
                                            [
                                                'classGroupId' => $classGroup->id,
                                                'projectId' => $item->id,
                                            ]
                                        ) }}"
                                        class="stream-options-item">
                                        <i class="bx bx-edit"></i>
                                        <span>Edit</span>
                                    </a>

                                @endif

                                @if ($type === 'announcement')

                                    <form
                                        action="{{ route(
                                            'professor.class-groups.announcements.destroy',
                                            [
                                                'classGroup' => $classGroup,
                                                'announcement' => $item,
                                            ]
                                        ) }}"
                                        method="POST"
                                        class="stream-options-form"
                                        onsubmit="return confirm(
                                            'Are you sure you want to delete this announcement?'
                                        )">
                                        @csrf
                                        @method('DELETE')

                                        <button
                                            type="submit"
                                            class="stream-options-item stream-options-delete">
                                            <i class="bx bx-trash"></i>
                                            <span>Delete</span>
                                        </button>
                                    </form>

                                @elseif ($type === 'material')

                                    <form
                                        action="{{ route(
                                            'professor.class-groups.materials.destroy',
                                            [
                                                'classGroup' => $classGroup,
                                                'material' => $item,
                                            ]
                                        ) }}"
                                        method="POST"
                                        class="stream-options-form"
                                        onsubmit="return confirm(
                                            'Are you sure you want to delete this material?'
                                        )">
                                        @csrf
                                        @method('DELETE')

                                        <button
                                            type="submit"
                                            class="stream-options-item stream-options-delete">
                                            <i class="bx bx-trash"></i>
                                            <span>Delete</span>
                                        </button>
                                    </form>

                                @elseif ($type === 'assignment')

                                    <form
                                        action="{{ route(
                                            'professor.class-groups.assignments.destroy',
                                            [
                                                'classGroup' => $classGroup,
                                                'assignment' => $item,
                                            ]
                                        ) }}"
                                        method="POST"
                                        class="stream-options-form"
                                        onsubmit="return confirm(
                                            'Are you sure you want to delete this assignment?'
                                        )">
                                        @csrf
                                        @method('DELETE')

                                        <button
                                            type="submit"
                                            class="stream-options-item stream-options-delete">
                                            <i class="bx bx-trash"></i>
                                            <span>Delete</span>
                                        </button>
                                    </form>

                                @elseif ($type === 'quiz')

                                    <form
                                        action="{{ route(
                                            'professor.class-groups.quizzes.destroy',
                                            [
                                                'classGroup' => $classGroup,
                                                'quiz' => $item,
                                            ]
                                        ) }}"
                                        method="POST"
                                        class="stream-options-form"
                                        onsubmit="return confirm(
                                            'Are you sure you want to delete this quiz?'
                                        )">
                                        @csrf
                                        @method('DELETE')

                                        <button
                                            type="submit"
                                            class="stream-options-item stream-options-delete">
                                            <i class="bx bx-trash"></i>
                                            <span>Delete</span>
                                        </button>
                                    </form>

                                @elseif ($type === 'exam')

                                    <form
                                        action="{{ route(
                                            'professor.class-groups.exams.destroy',
                                            [
                                                'classGroup' => $classGroup,
                                                'exam' => $item,
                                            ]
                                        ) }}"
                                        method="POST"
                                        class="stream-options-form"
                                        onsubmit="return confirm(
                                            'Are you sure you want to delete this exam?'
                                        )">
                                        @csrf
                                        @method('DELETE')

                                        <button
                                            type="submit"
                                            class="stream-options-item stream-options-delete">
                                            <i class="bx bx-trash"></i>
                                            <span>Delete</span>
                                        </button>
                                    </form>

                                @elseif ($type === 'project')

                                    <form
                                        action="{{ route(
                                            'professor.classworks.projects.destroy',
                                            [
                                                'classGroupId' => $classGroup->id,
                                                'projectId' => $item->id,
                                            ]
                                        ) }}"
                                        method="POST"
                                        class="stream-options-form"
                                        onsubmit="return confirm(
                                            'Are you sure you want to delete this project?'
                                        )">
                                        @csrf
                                        @method('DELETE')

                                        <button
                                            type="submit"
                                            class="stream-options-item stream-options-delete">
                                            <i class="bx bx-trash"></i>
                                            <span>Delete</span>
                                        </button>
                                    </form>

                                @endif

                            </div>
                        </div>

                    @endif

                </article>

            @empty

                <div class="classroom-stream-empty">

                    <div class="classroom-stream-empty-icon">
                        <i class="bx bx-news"></i>
                    </div>

                    <h3>
                        No activity yet
                    </h3>

                    <p>
                        Announcements, materials, assignments, quizzes,
                        exams, and projects will appear here.
                    </p>

                </div>

            @endforelse

        </div>

    </div>

</section>

        </main>


    {{-- ============================================================
         CLASS INFORMATION MODAL
    ============================================================= --}}
    <div
        class="classroom-info-modal"
        id="classroomInfoModal"
        aria-hidden="true">

        <div
            class="classroom-info-modal-overlay"
            id="classroomInfoModalOverlay"></div>


        <div
            class="classroom-info-dialog"
            role="dialog"
            aria-modal="true"
            aria-labelledby="classroomInfoTitle">

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
                    aria-label="Close">
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
                    id="cancelClassroomInfo">
                    Close
                </button>


                <a
                    href="{{ route(
                        'professor.class-groups.edit',
                        ['classGroup' => $classGroup->id]
                    ) }}"
                    class="classroom-info-edit">
                    <i class="bx bx-edit"></i>
                    Edit Class
                </a>

            </div>

        </div>

    </div>


    {{-- ============================================================
         CREATE ANNOUNCEMENT MODAL
    ============================================================= --}}
    <div
        class="classroom-announcement-modal"
        id="announcementModal"
        aria-hidden="true">

        <div
            class="classroom-announcement-overlay"
            id="announcementModalOverlay"></div>


        <div
            class="classroom-announcement-dialog"
            role="dialog"
            aria-modal="true"
            aria-labelledby="announcementModalTitle">

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
                    aria-label="Close announcement">
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
                class="classroom-announcement-form">

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
                        required>

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
                        required>{{ old('content') }}</textarea>

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
                        id="cancelAnnouncementModal">
                        Cancel
                    </button>


                    <button
                        type="submit"
                        class="classroom-announcement-submit">
                        <i class="bx bx-send"></i>
                        Post Announcement
                    </button>

                </div>

            </form>

        </div>

    </div>


    {{-- ============================================================
         CLASS CODE DISPLAY
    ============================================================= --}}
    <div
        class="class-code-overlay"
        id="classCodeOverlay"
        aria-hidden="true">

        <div class="class-code-display">


            <button
                type="button"
                class="class-code-display-close"
                id="closeClassCode"
                aria-label="Close class code display">
                <i class="bx bx-x"></i>
            </button>


            <span class="class-code-display-label">
                CLASS CODE
            </span>


            <strong
                class="class-code-display-value"
                id="displayClassCodeValue">
                {{ $classGroup->group_code }}
            </strong>


            <p class="class-code-display-help">
                Students can use this code to join the class.
            </p>

        </div>

    </div>

</div>


{{-- ================================================================
     PAGE JAVASCRIPT
================================================================ --}}
<script>
    document.addEventListener('DOMContentLoaded', function() {


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

            if (!classroomInfoModal) {
                return;
            }

            classroomInfoModal.classList.add('show');

            classroomInfoModal.setAttribute(
                'aria-hidden',
                'false'
            );

            document.body.style.overflow = 'hidden';
        }


        function closeClassInfo() {

            if (!classroomInfoModal) {
                return;
            }

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
           CREATE ANNOUNCEMENT MODAL
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

            if (!announcementModal) {
                return;
            }

            announcementModal.classList.add('show');

            announcementModal.setAttribute(
                'aria-hidden',
                'false'
            );

            document.body.style.overflow = 'hidden';
        }


        function closeAnnouncement() {

            if (!announcementModal) {
                return;
            }

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
           THREE-DOT MENUS
        ============================================================ */

        const optionContainers =
            document.querySelectorAll('.stream-item-options');


        optionContainers.forEach(function(container) {

            const button =
                container.querySelector('.stream-item-menu');

            if (!button) {
                return;
            }


            button.addEventListener(
                'click',
                function(event) {

                    event.preventDefault();
                    event.stopPropagation();


                    optionContainers.forEach(
                        function(otherContainer) {

                            if (otherContainer !== container) {

                                otherContainer.classList.remove(
                                    'show'
                                );

                            }

                        }
                    );


                    container.classList.toggle('show');

                }
            );

        });


        /* Close three-dot menus when clicking elsewhere */
        document.addEventListener(
            'click',
            function() {

                optionContainers.forEach(
                    function(container) {

                        container.classList.remove('show');

                    }
                );

            }
        );


        /* Prevent menu clicks from closing the menu immediately */
        optionContainers.forEach(
            function(container) {

                const menu =
                    container.querySelector('.stream-options-menu');

                if (!menu) {
                    return;
                }

                menu.addEventListener(
                    'click',
                    function(event) {

                        event.stopPropagation();

                    }
                );

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
                function() {

                    const code =
                        classCodeValue.textContent.trim();


                    if (
                        !navigator.clipboard ||
                        !navigator.clipboard.writeText
                    ) {

                        console.error(
                            'Clipboard API is not available.'
                        );

                        return;

                    }


                    navigator.clipboard
                        .writeText(code)
                        .then(function() {

                            copyClassCode.classList.add(
                                'copied'
                            );


                            setTimeout(
                                function() {

                                    copyClassCode.classList.remove(
                                        'copied'
                                    );

                                },
                                1500
                            );

                        })
                        .catch(function(error) {

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
                function() {

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

            if (!classCodeOverlay) {
                return;
            }

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
                function(event) {

                    if (
                        event.target === classCodeOverlay
                    ) {

                        closeClassCodeDisplay();

                    }

                }
            );

        }


        /* ============================================================
           ESCAPE KEY
        ============================================================ */

        document.addEventListener(
            'keydown',
            function(event) {

                if (event.key !== 'Escape') {
                    return;
                }


                if (
                    classroomInfoModal &&
                    classroomInfoModal.classList.contains('show')
                ) {

                    closeClassInfo();

                }


                if (
                    announcementModal &&
                    announcementModal.classList.contains('show')
                ) {

                    closeAnnouncement();

                }


                if (
                    classCodeOverlay &&
                    classCodeOverlay.classList.contains('show')
                ) {

                    closeClassCodeDisplay();

                }


                optionContainers.forEach(
                    function(container) {

                        container.classList.remove(
                            'show'
                        );

                    }
                );

            }
        );

    });
</script>

@endsection