@extends('layouts.hod_layout')

@section('title', 'Courses')

@section('content')
<div class="hod-courses-page">

    {{-- ============================================================
        HEADER
    ============================================================ --}}
    <div class="courses-header">
        <div class="courses-header-left">
            <div class="courses-icon">
                <i class='bx bx-book-open'></i>
            </div>

            <div>
                <span class="courses-eyebrow">HoD • Academic Management</span>

                <h1>Courses</h1>

                <p>
                    Manage the courses offered by
                    <strong>{{ $department->department_name }}</strong>.
                </p>
            </div>
        </div>

        <a href="{{ route('hod.courses.create') }}" class="create-course-btn">
            <i class='bx bx-plus'></i>
            <span>Create Course</span>
        </a>
    </div>


    {{-- ============================================================
        SUCCESS MESSAGE
    ============================================================ --}}
    @if (session('success'))
        <div class="course-alert success">
            <div class="course-alert-icon">
                <i class='bx bx-check-circle'></i>
            </div>

            <div>
                <strong>Success</strong>
                <span>{{ session('success') }}</span>
            </div>
        </div>
    @endif


    {{-- ============================================================
        STAT CARDS
    ============================================================ --}}
    <div class="course-stats">

        <div class="course-stat-card stat-blue">
            <div class="stat-icon">
                <i class='bx bx-book'></i>
            </div>

            <div class="stat-content">
                <span>Total Courses</span>
                <strong>{{ $courses->total() }}</strong>
            </div>
        </div>

        <div class="course-stat-card stat-purple">
            <div class="stat-icon">
                <i class='bx bx-building-house'></i>
            </div>

            <div class="stat-content">
                <span>Department</span>
                <strong>{{ $department->department_name }}</strong>
            </div>
        </div>

        <div class="course-stat-card stat-yellow">
            <div class="stat-icon">
                <i class='bx bx-time-five'></i>
            </div>

            <div class="stat-content">
                <span>Showing</span>
                <strong>
                    {{ $courses->firstItem() ?? 0 }}–{{ $courses->lastItem() ?? 0 }}
                </strong>
            </div>
        </div>

    </div>


    {{-- ============================================================
        MAIN COURSE PANEL
    ============================================================ --}}
    <div class="courses-panel">

        <div class="courses-panel-top">

            <div>
                <span class="panel-kicker">Course Directory</span>
                <h2>Course List</h2>
                <p>
                    View and manage courses assigned to your department.
                </p>
            </div>

            <div class="course-count-badge">
                <i class='bx bx-layer'></i>
                {{ $courses->total() }} course{{ $courses->total() === 1 ? '' : 's' }}
            </div>

        </div>


        {{-- ========================================================
            SEARCH
        ========================================================= --}}
        <form method="GET" action="{{ route('hod.courses.index') }}" class="course-toolbar">

            <div class="course-search">
                <i class='bx bx-search'></i>

                <input
                    type="text"
                    name="search"
                    value="{{ request('search') }}"
                    placeholder="Search by course code or course name..."
                    autocomplete="off"
                >
            </div>

            @if (request('search'))
                <a href="{{ route('hod.courses.index') }}" class="clear-search-btn">
                    <i class='bx bx-x'></i>
                    Clear
                </a>
            @endif

            <button type="submit" class="search-btn">
                <i class='bx bx-search'></i>
                Search
            </button>

        </form>


        {{-- ========================================================
            COURSE LIST
        ========================================================= --}}
        @if ($courses->count())

            <div class="course-list">

                @foreach ($courses as $course)

                    <article class="course-card">

                        <div class="course-card-accent"></div>

                        <div class="course-main">

                            <div class="course-code-box">
                                <span>{{ $course->course_code }}</span>
                            </div>

                            <div class="course-information">

                                <div class="course-title-row">
                                    <h3>{{ $course->course_name }}</h3>

                                    <span class="course-status">
                                        Active
                                    </span>
                                </div>

                                <p class="course-description">
                                    {{ $course->description ?: 'No description provided.' }}
                                </p>

                                <div class="course-meta">

                                    <span>
                                        <i class='bx bx-building'></i>
                                        {{ $department->department_name }}
                                    </span>

                                    <span>
                                        <i class='bx bx-award'></i>
                                        {{ $course->credits ?? 0 }}
                                        credit{{ ($course->credits ?? 0) == 1 ? '' : 's' }}
                                    </span>

                                    <span>
                                        <i class='bx bx-calendar'></i>
                                        Created {{ $course->created_at?->format('M d, Y') }}
                                    </span>

                                </div>

                            </div>

                        </div>


                        {{-- =================================================
                            ACTIONS
                        ================================================== --}}
                        <div class="course-actions">

                            <a
                                href="{{ route('hod.courses.edit', $course) }}"
                                class="course-action edit-action"
                                title="Edit course"
                            >
                                <i class='bx bx-edit-alt'></i>
                                <span>Edit</span>
                            </a>

                            <form
                                method="POST"
                                action="{{ route('hod.courses.destroy', $course) }}"
                                class="delete-course-form"
                            >
                                @csrf
                                @method('DELETE')

                                <button
                                    type="button"
                                    class="course-action delete-action delete-course-btn"
                                    title="Delete course"
                                    data-course-name="{{ $course->course_code }} - {{ $course->course_name }}"
                                >
                                    <i class='bx bx-trash'></i>
                                    <span>Delete</span>
                                </button>
                            </form>

                        </div>

                    </article>

                @endforeach

            </div>


            {{-- ========================================================
                PAGINATION
            ========================================================= --}}
            @if ($courses->hasPages())
                <div class="course-pagination">
                    {{ $courses->withQueryString()->links() }}
                </div>
            @endif

        @else

            {{-- ========================================================
                EMPTY STATE
            ========================================================= --}}
            <div class="course-empty">

                <div class="empty-illustration">
                    <div class="empty-circle circle-one"></div>
                    <div class="empty-circle circle-two"></div>

                    <div class="empty-book">
                        <i class='bx bx-book-open'></i>
                    </div>
                </div>

                @if (request('search'))

                    <h3>No courses found</h3>

                    <p>
                        We couldn't find a course matching
                        <strong>"{{ request('search') }}"</strong>.
                    </p>

                    <a
                        href="{{ route('hod.courses.index') }}"
                        class="empty-secondary-btn"
                    >
                        <i class='bx bx-refresh'></i>
                        Clear Search
                    </a>

                @else

                    <h3>No courses yet</h3>

                    <p>
                        Start building your department's course list by creating
                        the first course.
                    </p>

                    <a
                        href="{{ route('hod.courses.create') }}"
                        class="empty-primary-btn"
                    >
                        <i class='bx bx-plus'></i>
                        Create First Course
                    </a>

                @endif

            </div>

        @endif

    </div>

</div>


{{-- ================================================================
    DELETE CONFIRMATION MODAL
================================================================ --}}
<div id="deleteCourseModal" class="course-modal" aria-hidden="true">

    <div class="course-modal-backdrop"></div>

    <div
        class="course-modal-dialog"
        role="dialog"
        aria-modal="true"
        aria-labelledby="deleteCourseTitle"
    >

        <div class="modal-icon">
            <i class='bx bx-trash'></i>
        </div>

        <div class="modal-copy">
            <span class="modal-kicker">Delete Course</span>

            <h3 id="deleteCourseTitle">
                Are you sure?
            </h3>

            <p>
                You are about to delete
                <strong id="deleteCourseName"></strong>.
                This action cannot be undone.
            </p>
        </div>

        <div class="modal-actions">

            <button
                type="button"
                id="cancelDeleteCourse"
                class="modal-cancel"
            >
                Cancel
            </button>

            <button
                type="button"
                id="confirmDeleteCourse"
                class="modal-delete"
            >
                <i class='bx bx-trash'></i>
                Delete Course
            </button>

        </div>

    </div>
</div>


<style>
    /* ============================================================
       PAGE
    ============================================================ */

    .hod-courses-page {
        width: min(1220px, calc(100% - 40px));
        margin: 0 auto;
        padding: 34px 0 65px;
        color: #172033;
    }

    /* ============================================================
       HEADER
    ============================================================ */

    .courses-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 22px;
        margin-bottom: 25px;
        animation: courseFadeUp .5s ease both;
    }

    .courses-header-left {
        display: flex;
        align-items: center;
        gap: 16px;
        min-width: 0;
    }

    .courses-icon {
        width: 58px;
        height: 58px;
        flex: 0 0 auto;
        display: grid;
        place-items: center;
        border-radius: 18px;
        background: linear-gradient(135deg, #dbeafe, #ede9fe);
        color: #4f46e5;
        font-size: 28px;
        box-shadow: 0 12px 27px rgba(79, 70, 229, .11);
        animation: courseFloat 3.5s ease-in-out infinite;
    }

    .courses-eyebrow {
        display: block;
        margin-bottom: 5px;
        color: #6366f1;
        font-size: 11px;
        font-weight: 900;
        letter-spacing: .1em;
        text-transform: uppercase;
    }

    .courses-header h1 {
        margin: 0;
        color: #111827;
        font-size: clamp(29px, 4vw, 38px);
        line-height: 1.05;
        letter-spacing: -.035em;
        font-weight: 850;
    }

    .courses-header p {
        margin: 8px 0 0;
        color: #64748b;
        font-size: 14px;
        line-height: 1.5;
    }

    .courses-header p strong {
        color: #475569;
    }

    .create-course-btn {
        min-height: 45px;
        padding: 10px 15px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        border-radius: 13px;
        background: linear-gradient(135deg, #6366f1, #7c3aed);
        color: #ffffff;
        text-decoration: none;
        font-size: 12px;
        font-weight: 850;
        box-shadow: 0 11px 23px rgba(99, 102, 241, .18);
        transition: transform .18s ease, box-shadow .18s ease;
        white-space: nowrap;
    }

    .create-course-btn i {
        font-size: 17px;
    }

    .create-course-btn:hover {
        color: #ffffff;
        transform: translateY(-2px);
        box-shadow: 0 15px 28px rgba(99, 102, 241, .23);
    }

    /* ============================================================
   REMOVE BLUE LINE AROUND COURSE CARDS
   ============================================================ */

.course-card {
    border: 1px solid #e5eaf1 !important;
    border-top: 1px solid #e5eaf1 !important;
}

/* Remove any extra blue top border or outline */
.course-card::before {
    display: none !important;
}

/* Keep the purple accent only on the left */
.course-card-accent {
    position: absolute;
    top: 0;
    left: 0;
    bottom: 0;
    width: 4px;
    background: linear-gradient(180deg, #818cf8, #c4b5fd);
}

    /* ============================================================
       ALERT
    ============================================================ */

    .course-alert {
        display: flex;
        align-items: flex-start;
        gap: 11px;
        margin-bottom: 19px;
        padding: 14px 16px;
        border-radius: 14px;
        animation: courseFadeUp .4s ease both;
    }

    .course-alert.success {
        background: #ecfdf5;
        border: 1px solid #bbf7d0;
        color: #047857;
    }

    .course-alert-icon {
        font-size: 21px;
        line-height: 1;
    }

    .course-alert strong,
    .course-alert span {
        display: block;
    }

    .course-alert strong {
        margin-bottom: 2px;
        font-size: 12px;
    }

    .course-alert span {
        font-size: 12px;
    }

    /* ============================================================
       STATS
    ============================================================ */

    .course-stats {
        display: grid;
        grid-template-columns: 1fr 1fr 1fr;
        gap: 14px;
        margin-bottom: 20px;
    }

    .course-stat-card {
        position: relative;
        display: flex;
        align-items: center;
        gap: 12px;
        min-width: 0;
        padding: 17px;
        border-radius: 18px;
        border: 1px solid #e7ebf2;
        background: #ffffff;
        box-shadow: 0 8px 23px rgba(15, 23, 42, .045);
        overflow: hidden;
        animation: courseFadeUp .55s ease both;
        transition: transform .18s ease, box-shadow .18s ease;
    }

    .course-stat-card::after {
        content: "";
        position: absolute;
        right: -20px;
        bottom: -26px;
        width: 85px;
        height: 85px;
        border-radius: 50%;
        opacity: .55;
    }

    .course-stat-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 13px 28px rgba(15, 23, 42, .07);
    }

    .stat-blue::after {
        background: #dbeafe;
    }

    .stat-purple::after {
        background: #ede9fe;
    }

    .stat-yellow::after {
        background: #fef3c7;
    }

    .stat-icon {
        width: 43px;
        height: 43px;
        flex: 0 0 auto;
        display: grid;
        place-items: center;
        border-radius: 14px;
        font-size: 20px;
    }

    .stat-blue .stat-icon {
        background: #dbeafe;
        color: #2563eb;
    }

    .stat-purple .stat-icon {
        background: #ede9fe;
        color: #7c3aed;
    }

    .stat-yellow .stat-icon {
        background: #fef3c7;
        color: #d97706;
    }

    .stat-content {
        min-width: 0;
        position: relative;
        z-index: 1;
    }

    .stat-content span {
        display: block;
        margin-bottom: 3px;
        color: #94a3b8;
        font-size: 10px;
        font-weight: 850;
        letter-spacing: .07em;
        text-transform: uppercase;
    }

    .stat-content strong {
        display: block;
        max-width: 240px;
        color: #1e293b;
        font-size: 17px;
        font-weight: 850;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    /* ============================================================
       PANEL
    ============================================================ */

    .courses-panel {
        padding: 23px;
        border: 1px solid #e7ebf2;
        border-radius: 23px;
        background: #ffffff;
        box-shadow: 0 13px 35px rgba(15, 23, 42, .05);
        animation: courseFadeUp .65s ease both;
    }

    .courses-panel-top {
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        gap: 15px;
        margin-bottom: 18px;
    }

    .panel-kicker {
        display: block;
        margin-bottom: 3px;
        color: #a1aab8;
        font-size: 10px;
        font-weight: 900;
        letter-spacing: .1em;
        text-transform: uppercase;
    }

    .courses-panel-top h2 {
        margin: 0;
        color: #1e293b;
        font-size: 21px;
        letter-spacing: -.025em;
    }

    .courses-panel-top p {
        margin: 5px 0 0;
        color: #64748b;
        font-size: 12px;
    }

    .course-count-badge {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 8px 11px;
        border-radius: 999px;
        background: #f8fafc;
        border: 1px solid #e2e8f0;
        color: #475569;
        font-size: 10.5px;
        font-weight: 850;
        white-space: nowrap;
    }

    .course-count-badge i {
        font-size: 15px;
        color: #6366f1;
    }

    /* ============================================================
       TOOLBAR
    ============================================================ */

    .course-toolbar {
        display: flex;
        align-items: center;
        gap: 9px;
        margin-bottom: 18px;
    }

    .course-search {
        position: relative;
        flex: 1;
        min-width: 0;
    }

    .course-search > i {
        position: absolute;
        top: 50%;
        left: 13px;
        transform: translateY(-50%);
        color: #94a3b8;
        font-size: 17px;
        pointer-events: none;
    }

    .course-search input {
        width: 100%;
        min-height: 43px;
        padding: 10px 13px 10px 38px;
        border: 1px solid #dbe2ea;
        border-radius: 12px;
        background: #fbfdff;
        color: #172033;
        outline: none;
        font: inherit;
        font-size: 12px;
        transition: border-color .18s ease, box-shadow .18s ease;
    }

    .course-search input::placeholder {
        color: #a0aabd;
    }

    .course-search input:focus {
        border-color: #818cf8;
        box-shadow: 0 0 0 4px rgba(99, 102, 241, .08);
        background: #ffffff;
    }

    .search-btn,
    .clear-search-btn {
        min-height: 43px;
        padding: 9px 13px;
        border-radius: 12px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 6px;
        font-size: 11px;
        font-weight: 850;
        text-decoration: none;
        white-space: nowrap;
    }

    .search-btn {
        border: 1px solid #6366f1;
        background: #6366f1;
        color: #ffffff;
        cursor: pointer;
        font: inherit;
    }

    .search-btn:hover {
        background: #4f46e5;
    }

    .clear-search-btn {
        border: 1px solid #dbe2ea;
        background: #ffffff;
        color: #64748b;
    }

    .clear-search-btn:hover {
        color: #334155;
        border-color: #cbd5e1;
    }

    /* ============================================================
       COURSE LIST
    ============================================================ */

    .course-list {
        display: grid;
        gap: 13px;
    }

    .course-card {
        position: relative;
        display: flex;
        align-items: stretch;
        justify-content: space-between;
        gap: 17px;
        padding: 17px 18px 17px 20px;
        border: 1px solid #e5eaf1;
        border-radius: 18px;
        background: #ffffff;
        overflow: hidden;
        transition: transform .2s ease, box-shadow .2s ease, border-color .2s ease;
        animation: courseCardIn .35s ease both;
    }

    .course-card:hover {
        transform: translateY(-2px);
        border-color: #c7d2fe;
        box-shadow: 0 13px 27px rgba(15, 23, 42, .065);
    }

    .course-card-accent {
        position: absolute;
        top: 0;
        left: 0;
        bottom: 0;
        width: 4px;
        background: linear-gradient(180deg, #818cf8, #c4b5fd);
    }

    .course-main {
        display: flex;
        align-items: flex-start;
        gap: 14px;
        min-width: 0;
        flex: 1;
    }

    .course-code-box {
        width: 73px;
        min-height: 55px;
        flex: 0 0 auto;
        display: grid;
        place-items: center;
        padding: 8px;
        border-radius: 14px;
        background: #eef2ff;
        color: #4f46e5;
        text-align: center;
        font-size: 11px;
        font-weight: 900;
        line-height: 1.3;
        overflow-wrap: anywhere;
    }

    .course-information {
        min-width: 0;
        flex: 1;
    }

    .course-title-row {
        display: flex;
        align-items: center;
        gap: 8px;
        min-width: 0;
    }

    .course-title-row h3 {
        margin: 0;
        color: #1e293b;
        font-size: 15px;
        line-height: 1.35;
        font-weight: 850;
    }

    .course-status {
        display: inline-flex;
        align-items: center;
        flex: 0 0 auto;
        padding: 4px 7px;
        border-radius: 999px;
        background: #ecfdf5;
        color: #047857;
        font-size: 9px;
        font-weight: 850;
    }

    .course-description {
        margin: 6px 0 8px;
        color: #64748b;
        font-size: 11.5px;
        line-height: 1.55;
        display: -webkit-box;
        -webkit-box-orient: vertical;
        -webkit-line-clamp: 2;
        overflow: hidden;
    }

    .course-meta {
        display: flex;
        align-items: center;
        flex-wrap: wrap;
        gap: 8px 15px;
        color: #94a3b8;
        font-size: 9.8px;
        font-weight: 700;
    }

    .course-meta span {
        display: inline-flex;
        align-items: center;
        gap: 4px;
    }

    .course-meta i {
        color: #818cf8;
        font-size: 14px;
    }

    .course-actions {
        display: flex;
        align-items: center;
        gap: 7px;
        flex: 0 0 auto;
    }

    .course-action {
        min-height: 36px;
        padding: 8px 11px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 5px;
        border-radius: 10px;
        text-decoration: none;
        font-size: 10.5px;
        font-weight: 850;
        cursor: pointer;
        transition: transform .16s ease, background .16s ease, border-color .16s ease;
    }

    .course-action:hover {
        transform: translateY(-1px);
    }

    .edit-action {
        border: 1px solid #dbeafe;
        background: #eff6ff;
        color: #2563eb;
    }

    .edit-action:hover {
        color: #1d4ed8;
        background: #dbeafe;
    }

    .delete-action {
        border: 1px solid #fee2e2;
        background: #fff1f2;
        color: #e11d48;
        font: inherit;
    }

    .delete-action:hover {
        background: #ffe4e6;
    }

    /* ============================================================
       EMPTY
    ============================================================ */

    .course-empty {
        min-height: 330px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-direction: column;
        padding: 35px 20px;
        text-align: center;
    }

    .empty-illustration {
        position: relative;
        width: 100px;
        height: 85px;
        margin-bottom: 14px;
    }

    .empty-circle {
        position: absolute;
        border-radius: 50%;
        animation: emptyFloat 3s ease-in-out infinite;
    }

    .circle-one {
        width: 56px;
        height: 56px;
        top: 5px;
        left: 5px;
        background: #dbeafe;
    }

    .circle-two {
        width: 42px;
        height: 42px;
        right: 7px;
        bottom: 5px;
        background: #ede9fe;
        animation-delay: -.9s;
    }

    .empty-book {
        position: absolute;
        left: 29px;
        top: 18px;
        width: 46px;
        height: 46px;
        display: grid;
        place-items: center;
        border-radius: 15px;
        background: #ffffff;
        border: 1px solid #e7ebf2;
        box-shadow: 0 10px 21px rgba(15, 23, 42, .08);
        color: #6366f1;
        font-size: 22px;
    }

    .course-empty h3 {
        margin: 0;
        color: #1e293b;
        font-size: 18px;
        font-weight: 850;
    }

    .course-empty p {
        max-width: 480px;
        margin: 7px auto 15px;
        color: #64748b;
        font-size: 12px;
        line-height: 1.6;
    }

    .empty-primary-btn,
    .empty-secondary-btn {
        min-height: 41px;
        padding: 9px 13px;
        display: inline-flex;
        align-items: center;
        gap: 7px;
        border-radius: 11px;
        text-decoration: none;
        font-size: 11px;
        font-weight: 850;
    }

    .empty-primary-btn {
        background: #6366f1;
        color: #ffffff;
        box-shadow: 0 9px 20px rgba(99, 102, 241, .15);
    }

    .empty-primary-btn:hover {
        color: #ffffff;
        transform: translateY(-1px);
    }

    .empty-secondary-btn {
        background: #ffffff;
        border: 1px solid #dbe2ea;
        color: #475569;
    }

    /* ============================================================
       PAGINATION
    ============================================================ */

    .course-pagination {
        margin-top: 19px;
        display: flex;
        justify-content: center;
    }

    .course-pagination nav {
        display: inline-flex;
        align-items: center;
    }

    .course-pagination svg {
        width: 15px;
        height: 15px;
    }

    .course-pagination a,
    .course-pagination span {
        font-size: 11px !important;
    }

    /* ============================================================
       MODAL
    ============================================================ */

    .course-modal {
        position: fixed;
        inset: 0;
        z-index: 1000;
        display: none;
        align-items: center;
        justify-content: center;
        padding: 20px;
    }

    .course-modal.open {
        display: flex;
    }

    .course-modal-backdrop {
        position: absolute;
        inset: 0;
        background: rgba(15, 23, 42, .38);
        backdrop-filter: blur(4px);
        animation: modalBackdropIn .18s ease both;
    }

    .course-modal-dialog {
        position: relative;
        width: min(430px, 100%);
        padding: 25px;
        border-radius: 21px;
        background: #ffffff;
        border: 1px solid #e7ebf2;
        box-shadow: 0 24px 60px rgba(15, 23, 42, .18);
        animation: modalDialogIn .22s ease both;
    }

    .modal-icon {
        width: 48px;
        height: 48px;
        display: grid;
        place-items: center;
        margin-bottom: 13px;
        border-radius: 15px;
        background: #fff1f2;
        color: #e11d48;
        font-size: 21px;
    }

    .modal-kicker {
        display: block;
        margin-bottom: 3px;
        color: #94a3b8;
        font-size: 10px;
        font-weight: 900;
        letter-spacing: .09em;
        text-transform: uppercase;
    }

    .modal-copy h3 {
        margin: 0;
        color: #1e293b;
        font-size: 21px;
    }

    .modal-copy p {
        margin: 8px 0 0;
        color: #64748b;
        font-size: 12px;
        line-height: 1.6;
    }

    .modal-copy p strong {
        color: #334155;
    }

    .modal-actions {
        display: flex;
        justify-content: flex-end;
        gap: 9px;
        margin-top: 21px;
    }

    .modal-cancel,
    .modal-delete {
        min-height: 41px;
        padding: 9px 13px;
        border-radius: 11px;
        border: 1px solid transparent;
        font: inherit;
        font-size: 11px;
        font-weight: 850;
        cursor: pointer;
    }

    .modal-cancel {
        border-color: #dbe2ea;
        background: #ffffff;
        color: #475569;
    }

    .modal-delete {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        background: #e11d48;
        color: #ffffff;
    }

    .modal-delete:hover {
        background: #be123c;
    }

    /* ============================================================
   REMOVE ALL INTRO TRANSITIONS AND ANIMATIONS
   ============================================================ */

.hod-courses-page,
.hod-courses-page *,
.hod-courses-page *::before,
.hod-courses-page *::after {
    animation: none !important;
    transition: none !important;
}

/* Keep cards stable */
.course-card,
.course-stat-card,
.courses-panel,
.courses-header,
.course-alert {
    transform: none !important;
}

/* Remove hover movement */
.course-card:hover,
.course-stat-card:hover,
.create-course-btn:hover,
.course-action:hover {
    transform: none !important;
}

/* Remove the course accent line */
.course-card-accent {
    display: none !important;
}

/* Keep a clean, normal card border */
.course-card,
.course-card:hover {
    border: 1px solid #e5eaf1 !important;
    box-shadow: none !important;
}
    /* ============================================================
       ANIMATION
    ============================================================ */

    @keyframes courseFadeUp {
        from {
            opacity: 0;
            transform: translateY(9px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @keyframes courseCardIn {
        from {
            opacity: 0;
            transform: translateY(7px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @keyframes courseFloat {
        0%, 100% {
            transform: translateY(0);
        }

        50% {
            transform: translateY(-4px);
        }
    }

    @keyframes emptyFloat {
        0%, 100% {
            transform: translateY(0);
        }

        50% {
            transform: translateY(-5px);
        }
    }

    @keyframes modalBackdropIn {
        from { opacity: 0; }
        to { opacity: 1; }
    }

    @keyframes modalDialogIn {
        from {
            opacity: 0;
            transform: translateY(10px) scale(.98);
        }

        to {
            opacity: 1;
            transform: translateY(0) scale(1);
        }
    }

    /* ============================================================
       RESPONSIVE
    ============================================================ */

    @media (max-width: 980px) {
        .course-stats {
            grid-template-columns: 1fr 1fr;
        }

        .course-stats .stat-yellow {
            grid-column: span 2;
        }
    }

    @media (max-width: 760px) {
        .hod-courses-page {
            width: min(100% - 24px, 680px);
            padding-top: 22px;
        }

        .courses-header {
            align-items: flex-start;
            flex-direction: column;
        }

        .create-course-btn {
            width: 100%;
        }

        .course-stats {
            grid-template-columns: 1fr;
        }

        .course-stats .stat-yellow {
            grid-column: auto;
        }

        .courses-panel {
            padding: 18px;
        }

        .courses-panel-top {
            flex-direction: column;
        }

        .course-toolbar {
            flex-wrap: wrap;
        }

        .course-search {
            flex-basis: 100%;
        }

        .course-card {
            flex-direction: column;
        }

        .course-actions {
            justify-content: flex-end;
            padding-top: 3px;
            border-top: 1px solid #eef2f6;
        }

        .course-main {
            width: 100%;
        }
    }

    @media (max-width: 520px) {
        .courses-header-left {
            align-items: flex-start;
        }

        .courses-icon {
            width: 50px;
            height: 50px;
            border-radius: 15px;
            font-size: 23px;
        }

        .courses-header h1 {
            font-size: 28px;
        }

        .course-code-box {
            width: 64px;
        }

        .course-title-row {
            align-items: flex-start;
            flex-direction: column;
        }

        .course-action span {
            display: none;
        }

        .course-action {
            width: 36px;
            padding: 8px;
        }

        .modal-actions {
            flex-direction: column-reverse;
        }

        .modal-cancel,
        .modal-delete {
            width: 100%;
        }
    }
</style>


<script>
document.addEventListener('DOMContentLoaded', function () {
    'use strict';

    /* ============================================================
       DELETE COURSE MODAL
    ============================================================ */

    const modal =
        document.getElementById('deleteCourseModal');

    const deleteName =
        document.getElementById('deleteCourseName');

    const cancelButton =
        document.getElementById('cancelDeleteCourse');

    const confirmButton =
        document.getElementById('confirmDeleteCourse');

    const backdrop =
        modal?.querySelector('.course-modal-backdrop');

    let activeDeleteForm = null;

    function closeDeleteModal() {
        if (!modal) {
            return;
        }

        modal.classList.remove('open');
        modal.setAttribute('aria-hidden', 'true');
        activeDeleteForm = null;
    }

    document.querySelectorAll('.delete-course-btn')
        .forEach(function (button) {

            button.addEventListener('click', function () {

                const form =
                    button.closest('.delete-course-form');

                activeDeleteForm = form;

                if (deleteName) {
                    deleteName.textContent =
                        button.dataset.courseName || 'this course';
                }

                if (modal) {
                    modal.classList.add('open');
                    modal.setAttribute('aria-hidden', 'false');

                    setTimeout(function () {
                        cancelButton?.focus();
                    }, 0);
                }
            });
        });

    cancelButton?.addEventListener(
        'click',
        closeDeleteModal
    );

    backdrop?.addEventListener(
        'click',
        closeDeleteModal
    );

    confirmButton?.addEventListener(
        'click',
        function () {

            if (!activeDeleteForm) {
                return;
            }

            confirmButton.disabled = true;
            confirmButton.innerHTML = `
                <i class='bx bx-loader-alt bx-spin'></i>
                Deleting...
            `;

            activeDeleteForm.submit();
        }
    );

    document.addEventListener(
        'keydown',
        function (event) {

            if (
                event.key === 'Escape' &&
                modal?.classList.contains('open')
            ) {
                closeDeleteModal();
            }
        }
    );
});
</script>
@endsection
