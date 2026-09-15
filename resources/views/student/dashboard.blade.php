@extends('layouts.student_layout')

@section('title', 'Student Dashboard')

@section('content')

<div class="student-dashboard">

    {{-- =========================================================
         WELCOME CARD
         ========================================================= --}}

    <div class="welcome-card">

        <div class="welcome-text">

            <h1>
                Welcome Back, {{ Auth::user()->name }}!
            </h1>

            <p>
                LET'S STUDY!!
            </p>

        </div>

        <div class="welcome-img-container">
            <div id="welcome-animation"></div>
        </div>

    </div>


    {{-- =========================================================
         DASHBOARD CONTENT
         ========================================================= --}}

    <div class="student-dashboard-grid">


        {{-- =====================================================
             LEFT COLUMN
        ====================================================== --}}

        <main class="student-main">


            {{-- =================================================
                 COURSES HEADER
            ================================================== --}}

            <div class="section-heading">

                <div>

                    <span class="section-eyebrow">
                        ACADEMIC
                    </span>

                    <h2>
                        My Courses
                    </h2>

                    <p>
                        Continue learning from your enrolled courses.
                    </p>

                </div>

                <div class="course-total">

                    <i class="bx bx-book"></i>

                    <span>
                        {{ $totalCourses ?? 0 }} Courses
                    </span>

                </div>

            </div>


            {{-- =================================================
                 COURSES
            ================================================== --}}

            <div class="student-courses-grid">

                @forelse($classGroups as $classGroup)

                    <article class="student-course-card">


                        {{-- TOP --}}

                        <div class="course-top">

                            <span class="course-code">

                                {{ $classGroup->course_code ?? 'COURSE' }}

                            </span>

                            <span class="course-semester">

                                {{ $classGroup->semester ?? 'Semester 1' }}

                            </span>

                        </div>


                        {{-- ICON --}}

                        <div class="course-main-icon">

                            <i class="bx bx-book-open"></i>

                        </div>


                        {{-- COURSE INFO --}}

                        <div class="course-details">

                            <h3>
                                {{ $classGroup->group_name }}
                            </h3>

                            <p>

                                <i class="bx bx-buildings"></i>

                                {{ $classGroup->department->name ?? 'Computer Science' }}

                            </p>

                        </div>


                        {{-- PROFESSOR --}}

                        <div class="course-professor">

                            <div class="professor-avatar">

                                <i class="bx bx-user"></i>

                            </div>

                            <div>

                                <span>
                                    INSTRUCTOR
                                </span>

                                <strong>

                                    {{ $classGroup->professor->name ?? 'Professor' }}

                                </strong>

                            </div>

                        </div>


                        {{-- FOOTER --}}

                        <div class="course-bottom">

                            <div class="student-count">

                                <i class="bx bx-group"></i>

                                <span>
                                    {{ $classGroup->students_count ?? 0 }}
                                    Students
                                </span>

                            </div>


                            {{-- WORKING COURSE LINK --}}

                            <a
                                href="{{ route(
                                    'student.class-groups.classroom-group',
                                    ['classGroup' => $classGroup->id]
                                ) }}"
                                class="view-course-btn"
                            >

                                <span>
                                    View Course
                                </span>

                                <i class="bx bx-right-arrow-alt"></i>

                            </a>

                        </div>

                    </article>

                @empty

                    <div class="no-courses">

                        <div class="no-courses-icon">

                            <i class="bx bx-book-open"></i>

                        </div>

                        <h3>
                            No Courses Yet
                        </h3>

                        <p>
                            You are not enrolled in any courses yet.
                        </p>

                    </div>

                @endforelse

            </div>

        </main>


        {{-- =====================================================
             RIGHT COLUMN
        ====================================================== --}}

        <aside class="student-sidebar">


            {{-- =================================================
                 ACADEMIC OVERVIEW
            ================================================== --}}

        <div class="overview-card">

            <div class="overview-header">
                <h2>Today's Summary</h2>
                <span class="overview-eyebrow">{{ now()->format('M j') }}</span>
            </div>

            <div class="overview-content">

                <div class="overview-item" data-stat="classes">

                    <div class="overview-item-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" />
                        </svg>
                    </div>

                    <div class="overview-item-text">
                        <span class="overview-item-name">New Classes</span>
                        <span class="overview-item-description">Published today</span>
                    </div>

                    <span class="overview-item-value">
                        <!-- add controller here to display new classes -->
                        8
                    </span>
                </div>

                <div class="overview-item" data-stat="students">

                    <div class="overview-item-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 2.994v2.25m10.5-2.25v2.25m-14.252 13.5V7.491a2.25 2.25 0 0 1 2.25-2.25h13.5a2.25 2.25 0 0 1 2.25 2.25v11.251m-18 0a2.25 2.25 0 0 0 2.25 2.25h13.5a2.25 2.25 0 0 0 2.25-2.25m-18 0v-7.5a2.25 2.25 0 0 1 2.25-2.25h13.5a2.25 2.25 0 0 1 2.25 2.25v7.5m-6.75-6h2.25m-9 2.25h4.5m.002-2.25h.005v.006H12v-.006Zm-.001 4.5h.006v.006h-.006v-.005Zm-2.25.001h.005v.006H9.75v-.006Zm-2.25 0h.005v.005h-.006v-.005Zm6.75-2.247h.005v.005h-.005v-.005Zm0 2.247h.006v.006h-.006v-.006Zm2.25-2.248h.006V15H16.5v-.005Z" />
                        </svg>
                    </div>

                    <div class="overview-item-text">
                        <span class="overview-item-name">New Students</span>
                        <span class="overview-item-description">Registered today</span>
                    </div>

                    <span class="overview-item-value">
                        <!-- add controller here to display new students -->
                        6
                    </span>
                </div>

                <div class="overview-item" data-stat="announcements">

                    <div class="overview-item-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                            <path fill-rule="evenodd" d="M18.458 3.11A1 1 0 0 1 19 4v16a1 1 0 0 1-1.581.814L12 16.944V7.056l5.419-3.87a1 1 0 0 1 1.039-.076ZM22 12c0 1.48-.804 2.773-2 3.465v-6.93c1.196.692 2 1.984 2 3.465ZM10 8H4a1 1 0 0 0-1 1v6a1 1 0 0 0 1 1h6V8Zm0 9H5v3a1 1 0 0 0 1 1h3a1 1 0 0 0 1-1v-3Z" clip-rule="evenodd" />
                        </svg>
                    </div>

                    <div class="overview-item-text">
                        <span class="overview-item-name">New Announcements</span>
                        <span class="overview-item-description">Published today</span>
                    </div>

                    <span class="overview-item-value">
                        <!-- add controller here to display new announcements -->
                        8
                    </span>
                </div>

            </div>

            <div class="quick-action">
                <h2>Quick Actions</h2>

                <div class="quick-action-buttons">
                    <a href="{{ route('admin.users.index') }}" class="quick-action-button">
                        + Materials
                    </a>
                    <a href="#" class="quick-action-button">
                        + Announcements
                    </a>
                </div>
            </div>

        </div>


            {{-- =================================================
                 RECENT ACTIVITY
            ================================================== --}}

            <div class="recent-card">

                <div class="recent-header">

                    <div>

                        <span>
                            ACTIVITY
                        </span>

                        <h2>
                            Recent Activity
                        </h2>

                    </div>

                    <div class="recent-icon">

                        <i class="bx bx-time-five"></i>

                    </div>

                </div>


                {{-- FILTER --}}

                <div class="activity-filter">

                    <button
                        type="button"
                        class="activity-filter-btn active"
                        data-filter="all"
                    >
                        All
                    </button>

                    <button
                        type="button"
                        class="activity-filter-btn"
                        data-filter="assignment"
                    >
                        Assignments
                    </button>

                    <button
                        type="button"
                        class="activity-filter-btn"
                        data-filter="material"
                    >
                        Materials
                    </button>

                    <button
                        type="button"
                        class="activity-filter-btn"
                        data-filter="announcement"
                    >
                        Announcements
                    </button>

                </div>


                {{-- ACTIVITY LIST --}}

                <div class="activity-list">


                    {{-- ASSIGNMENT --}}

                    <div
                        class="activity-item"
                        data-type="assignment"
                    >

                        <div class="activity-item-icon">

                            <i class="bx bx-task"></i>

                        </div>

                        <div class="activity-content">

                            <h4>
                                No new assignments
                            </h4>

                            <p>
                                Your assignments will appear here.
                            </p>

                        </div>

                        <span class="activity-date">
                            --
                        </span>

                    </div>


                    {{-- MATERIAL --}}

                    <div
                        class="activity-item"
                        data-type="material"
                    >

                        <div class="activity-item-icon">

                            <i class="bx bx-file"></i>

                        </div>

                        <div class="activity-content">

                            <h4>
                                No new materials
                            </h4>

                            <p>
                                New learning materials will appear here.
                            </p>

                        </div>

                        <span class="activity-date">
                            --
                        </span>

                    </div>


                    {{-- ANNOUNCEMENT --}}

                    <div
                        class="activity-item"
                        data-type="announcement"
                    >

                        <div class="activity-item-icon">

                            <i class="bx bx-megaphone"></i>

                        </div>

                        <div class="activity-content">

                            <h4>
                                No announcements
                            </h4>

                            <p>
                                Class announcements will appear here.
                            </p>

                        </div>

                        <span class="activity-date">
                            --
                        </span>

                    </div>

                </div>

            </div>

        </aside>

    </div>

</div>



{{-- =============================================================
     BLUE STUDENT DASHBOARD CSS
============================================================= --}}

<style>

/* =============================================================
   MAIN
============================================================= */

.student-dashboard {

    width: 100%;

    max-width: 1550px;

    margin: 0 auto;

    padding: 25px 30px 45px;

    box-sizing: border-box;

}


/* =============================================================
   GRID
============================================================= */

.student-dashboard-grid {

    display: grid;

    grid-template-columns: minmax(0, 1.7fr) minmax(330px, .85fr);

    gap: 24px;

    margin-top: 25px;

}


.student-main {

    min-width: 0;

}


.student-sidebar {

    min-width: 0;

    display: flex;

    flex-direction: column;

    gap: 20px;

}


/* =============================================================
   SECTION HEADING
============================================================= */

.section-heading {

    display: flex;

    align-items: flex-end;

    justify-content: space-between;

    margin-bottom: 18px;

}


.section-eyebrow {

    display: block;

    color: #2563eb;

    font-size: 10px;

    font-weight: 800;

    letter-spacing: 1.7px;

    margin-bottom: 5px;

}


.section-heading h2 {

    margin: 0;

    color: #172554;

    font-size: 24px;

    font-weight: 750;

}


.section-heading p {

    margin: 5px 0 0;

    color: #64748b;

    font-size: 12px;

}


.course-total {

    display: flex;

    align-items: center;

    gap: 7px;

    padding: 8px 12px;

    background: #eff6ff;

    border: 1px solid #dbeafe;

    border-radius: 8px;

    color: #2563eb;

    font-size: 11px;

    font-weight: 700;

}


.course-total i {

    font-size: 15px;

}


/* =============================================================
   COURSE GRID
============================================================= */

.student-courses-grid {

    display: grid;

    grid-template-columns: repeat(2, minmax(0, 1fr));

    gap: 17px;

}


/* =============================================================
   COURSE CARD
============================================================= */

.student-course-card {

    position: relative;

    overflow: hidden;

    padding: 19px;

    background: #ffffff;

    border: 1px solid #dbeafe;

    border-radius: 15px;

    box-shadow: 0 5px 18px rgba(37, 99, 235, .06);

    transition: all .22s ease;

}


.student-course-card::before {

    content: "";

    position: absolute;

    top: 0;

    left: 0;

    width: 100%;

    height: 4px;

    background: linear-gradient(
        90deg,
        #2563eb,
        #60a5fa
    );

}


.student-course-card:hover {

    transform: translateY(-4px);

    border-color: #93c5fd;

    box-shadow: 0 12px 28px rgba(37, 99, 235, .12);

}


/* =============================================================
   COURSE TOP
============================================================= */

.course-top {

    display: flex;

    align-items: center;

    justify-content: space-between;

    gap: 10px;

}


.course-code {

    color: #1d4ed8;

    font-size: 10px;

    font-weight: 800;

    letter-spacing: 1px;

}


.course-semester {

    padding: 5px 8px;

    background: #eff6ff;

    color: #3b82f6;

    border-radius: 6px;

    font-size: 9px;

    font-weight: 700;

}


/* =============================================================
   COURSE ICON
============================================================= */

.course-main-icon {

    width: 48px;

    height: 48px;

    display: flex;

    align-items: center;

    justify-content: center;

    margin: 17px 0 14px;

    border-radius: 12px;

    background: linear-gradient(
        135deg,
        #2563eb,
        #3b82f6
    );

    color: white;

    font-size: 22px;

    box-shadow: 0 7px 16px rgba(37, 99, 235, .2);

}


.course-main-icon i {

    font-size: 22px;

}


/* =============================================================
   COURSE DETAILS
============================================================= */

.course-details h3 {

    margin: 0;

    min-height: 42px;

    color: #172554;

    font-size: 15px;

    line-height: 1.4;

    font-weight: 700;

}


.course-details p {

    display: flex;

    align-items: center;

    gap: 5px;

    margin: 7px 0 0;

    color: #64748b;

    font-size: 11px;

}


.course-details p i {

    color: #3b82f6;

    font-size: 14px;

}


/* =============================================================
   PROFESSOR
============================================================= */

.course-professor {

    display: flex;

    align-items: center;

    gap: 9px;

    margin-top: 17px;

    padding-top: 13px;

    border-top: 1px solid #eef2ff;

}


.professor-avatar {

    width: 32px;

    height: 32px;

    display: flex;

    align-items: center;

    justify-content: center;

    border-radius: 9px;

    background: #eff6ff;

    color: #2563eb;

}


.professor-avatar i {

    font-size: 16px;

}


.course-professor div:last-child {

    display: flex;

    flex-direction: column;

}


.course-professor span {

    color: #94a3b8;

    font-size: 8px;

    font-weight: 800;

    letter-spacing: .8px;

}


.course-professor strong {

    margin-top: 2px;

    color: #334155;

    font-size: 10px;

}


/* =============================================================
   COURSE BOTTOM
============================================================= */

.course-bottom {

    display: flex;

    align-items: center;

    justify-content: space-between;

    gap: 10px;

    margin-top: 15px;

}


.student-count {

    display: flex;

    align-items: center;

    gap: 5px;

    color: #64748b;

    font-size: 10px;

}


.student-count i {

    color: #3b82f6;

    font-size: 15px;

}


/* =============================================================
   VIEW COURSE BUTTON
============================================================= */

.view-course-btn {

    display: inline-flex;

    align-items: center;

    gap: 5px;

    padding: 8px 11px;

    border-radius: 8px;

    background: #2563eb;

    color: #ffffff;

    text-decoration: none;

    font-size: 10px;

    font-weight: 700;

    transition: all .2s ease;

}


.view-course-btn:hover {

    background: #1d4ed8;

    color: #ffffff;

    transform: translateX(2px);

}


.view-course-btn i {

    font-size: 14px;

}


/* =============================================================
   EMPTY COURSES
============================================================= */

.no-courses {

    grid-column: 1 / -1;

    padding: 60px 20px;

    text-align: center;

    border: 1px dashed #bfdbfe;

    border-radius: 15px;

    background: #f8fbff;

}


.no-courses-icon {

    width: 55px;

    height: 55px;

    display: flex;

    align-items: center;

    justify-content: center;

    margin: 0 auto 12px;

    border-radius: 14px;

    background: #dbeafe;

    color: #2563eb;

}


.no-courses-icon i {

    font-size: 24px;

}


.no-courses h3 {

    margin: 0;

    color: #1e3a8a;

    font-size: 15px;

}


.no-courses p {

    margin: 6px 0 0;

    color: #64748b;

    font-size: 11px;

}


/* =============================================================
   ACADEMIC CARD
============================================================= */

.academic-card,
.recent-card {

    background: #ffffff;

    border: 1px solid #dbeafe;

    border-radius: 15px;

    box-shadow: 0 5px 18px rgba(37, 99, 235, .05);

}


/* =============================================================
   ACADEMIC HEADER
============================================================= */

.academic-card-header {

    display: flex;

    align-items: center;

    justify-content: space-between;

    padding: 19px;

    border-bottom: 1px solid #eff6ff;

}


.academic-card-header span,
.recent-header span {

    display: block;

    margin-bottom: 4px;

    color: #3b82f6;

    font-size: 9px;

    font-weight: 800;

    letter-spacing: 1.5px;

}


.academic-card-header h2,
.recent-header h2 {

    margin: 0;

    color: #172554;

    font-size: 18px;

    font-weight: 750;

}


.academic-header-icon {

    width: 40px;

    height: 40px;

    display: flex;

    align-items: center;

    justify-content: center;

    border-radius: 10px;

    background: #2563eb;

    color: #ffffff;

}


.academic-header-icon i {

    font-size: 20px;

}


/* =============================================================
   ACADEMIC STATS
============================================================= */

.academic-stats {

    display: grid;

    grid-template-columns: 1fr 1fr;

}


.academic-stat {

    position: relative;

    display: flex;

    align-items: center;

    gap: 9px;

    padding: 14px;

    border-right: 1px solid #eff6ff;

    border-bottom: 1px solid #eff6ff;

    text-decoration: none;

    transition: .2s;

}


.academic-stat:hover {

    background: #f8fbff;

}


.academic-stat:nth-child(even) {

    border-right: none;

}


.stat-blue-icon {

    width: 34px;

    height: 34px;

    min-width: 34px;

    display: flex;

    align-items: center;

    justify-content: center;

    border-radius: 9px;

    background: #eff6ff;

    color: #2563eb;

}


.stat-blue-icon i {

    font-size: 16px;

}


.stat-text {

    display: flex;

    flex-direction: column;

}


.stat-text strong {

    color: #172554;

    font-size: 17px;

    line-height: 1;

}


.stat-text span {

    margin-top: 4px;

    color: #64748b;

    font-size: 9px;

}


.stat-arrow {

    margin-left: auto;

    color: #93c5fd;

    font-size: 15px;

}


/* =============================================================
   RECENT CARD
============================================================= */

.recent-card {

    padding: 19px;

}


.recent-header {

    display: flex;

    align-items: center;

    justify-content: space-between;

    margin-bottom: 15px;

}


.recent-icon {

    width: 35px;

    height: 35px;

    display: flex;

    align-items: center;

    justify-content: center;

    border-radius: 9px;

    background: #eff6ff;

    color: #2563eb;

}


.recent-icon i {

    font-size: 17px;

}


/* =============================================================
   ACTIVITY FILTER
============================================================= */

.activity-filter {

    display: flex;

    gap: 4px;

    padding: 4px;

    background: #eff6ff;

    border-radius: 8px;

    overflow-x: auto;

}


.activity-filter-btn {

    border: none;

    padding: 7px 9px;

    border-radius: 6px;

    background: transparent;

    color: #64748b;

    font-family: inherit;

    font-size: 9px;

    font-weight: 700;

    white-space: nowrap;

    cursor: pointer;

    transition: .2s;

}


.activity-filter-btn:hover {

    color: #2563eb;

}


.activity-filter-btn.active {

    background: #2563eb;

    color: #ffffff;

}


/* =============================================================
   ACTIVITY LIST
============================================================= */

.activity-list {

    margin-top: 10px;

}


.activity-item {

    display: flex;

    align-items: center;

    gap: 9px;

    padding: 12px 0;

    border-bottom: 1px solid #eff6ff;

}


.activity-item:last-child {

    border-bottom: none;

}


.activity-item-icon {

    width: 34px;

    height: 34px;

    min-width: 34px;

    display: flex;

    align-items: center;

    justify-content: center;

    border-radius: 9px;

    background: #eff6ff;

    color: #2563eb;

}


.activity-item-icon i {

    font-size: 15px;

}


.activity-content {

    flex: 1;

    min-width: 0;

}


.activity-content h4 {

    margin: 0;

    color: #334155;

    font-size: 10px;

    font-weight: 700;

}


.activity-content p {

    margin: 3px 0 0;

    color: #94a3b8;

    font-size: 9px;

    line-height: 1.4;

}


.activity-date {

    color: #cbd5e1;

    font-size: 9px;

}


/* =============================================================
   RESPONSIVE
============================================================= */

@media(max-width: 1100px) {

    .student-dashboard-grid {

        grid-template-columns: 1fr;

    }

    .student-sidebar {

        display: grid;

        grid-template-columns: 1fr 1fr;

        align-items: start;

    }

}


@media(max-width: 850px) {

    .student-dashboard {

        padding: 20px;

    }

    .student-courses-grid {

        grid-template-columns: 1fr;

    }

    .student-sidebar {

        display: flex;

        flex-direction: column;

    }

}


@media(max-width: 550px) {

    .student-dashboard {

        padding: 15px;

    }

    .section-heading {

        align-items: flex-start;

        flex-direction: column;

        gap: 12px;

    }

    .course-total {

        align-self: flex-start;

    }

    .academic-stats {

        grid-template-columns: 1fr;

    }

    .academic-stat:nth-child(even) {

        border-right: 1px solid #eff6ff;

    }

}

</style>



{{-- =============================================================
     LOTTIE
============================================================= --}}

<script src="https://cdnjs.cloudflare.com/ajax/libs/bodymovin/5.12.2/lottie.min.js"></script>

<script>

    /*
    |--------------------------------------------------------------------------
    | WELCOME ANIMATION
    |--------------------------------------------------------------------------
    */

    lottie.loadAnimation({

        container: document.getElementById('welcome-animation'),

        renderer: 'svg',

        loop: true,

        autoplay: true,

        path: "{{ asset('animations/welcome.json') }}"

    });


    /*
    |--------------------------------------------------------------------------
    | ACTIVITY FILTER
    |--------------------------------------------------------------------------
    */

    document.addEventListener('DOMContentLoaded', function () {

        const buttons =
            document.querySelectorAll('.activity-filter-btn');

        const items =
            document.querySelectorAll('.activity-item');


        buttons.forEach(function (button) {

            button.addEventListener('click', function () {

                buttons.forEach(function (btn) {

                    btn.classList.remove('active');

                });

                button.classList.add('active');

                const filter =
                    button.getAttribute('data-filter');


                items.forEach(function (item) {

                    const type =
                        item.getAttribute('data-type');


                    if (
                        filter === 'all' ||
                        filter === type
                    ) {

                        item.style.display = 'flex';

                    } else {

                        item.style.display = 'none';

                    }

                });

            });

        });

    });

</script>


@endsection