@extends('layouts.hod_layout')

@section('title', 'HOD Dashboard')

@section('content')

<div class="dashboard-container">

    <!---------------- Left side of the main content of the dashboard ---------------->
    <div class="dashboard-left">

        <!-- ======================== Welcome Card ======================== -->
        <div class="welcome-card">

            <div class="welcome-text">

                <h1>
                    Welcome Back, {{ Auth::user()->name }}!
                </h1>

                <p>
                    Manage your department's students, academic staff,
                    classes, schedules, and activities.
                </p>

            </div>

            <div class="welcome-img-container">
                <div id="welcome-animation"></div>
            </div>

        </div>


        <!-- ======================= Statistic Cards ======================= -->
        <div class="stat-container">

            <!-- ================= FIRST CARD ================= -->
            <!-- Department Students -->

            <a href="#"
                class="stat-card">

                <div class="stat-icon">
                    <svg class="w-6 h-6 text-gray-800 dark:text-white"
                        aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg"
                        width="24"
                        height="24"
                        fill="currentColor"
                        viewBox="0 0 24 24">

                        <path fill-rule="evenodd"
                            d="M12 6a3.5 3.5 0 1 0 0 7 3.5 3.5 0 0 0 0-7Zm-1.5 8a4 4 0 0 0-4 4 2 2 0 0 0 2 2h7a2 2 0 0 0 2-2 4 4 0 0 0-4-4h-3Zm6.82-3.096a5.51 5.51 0 0 0-2.797-6.293 3.5 3.5 0 1 1 2.796 6.292ZM19.5 18h.5a2 2 0 0 0-2-2 4 4 0 0 0-4-4h-1.1a5.503 5.503 0 0 1-.471.762A5.998 5.998 0 0 1 19.5 18ZM4 7.5a3.5 3.5 0 0 1 5.477-2.889 5.5 5.5 0 0 0-2.796 6.293A3.501 3.501 0 0 1 4 7.5ZM7.1 12H6a4 4 0 0 0-4 4 2 2 0 0 0 2 2h.5a5.998 5.998 0 0 1 3.071-5.238A5.505 5.505 0 0 1 7.1 12Z"
                            clip-rule="evenodd" />

                    </svg>
                </div>

                <div class="stat-info">

                    <span class="stat-value">
                        {{ $departmentStudents ?? 0 }}
                    </span>

                    <span class="stat-title">
                        Department
                        <br>
                        Students
                    </span>

                </div>

            </a>


            <!-- ================= SECOND CARD ================= -->
            <!-- Department Academic Staff -->

            <a href="#"
                class="stat-card">

                <div class="stat-icon">

                    <svg class="w-6 h-6 text-gray-800 dark:text-white"
                        aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg"
                        width="24"
                        height="24"
                        fill="currentColor"
                        viewBox="0 0 24 24">

                        <path d="M6 2c-1.10457 0-2 .89543-2 2v4c0 .55228.44772 1 1 1s1-.44772 1-1V4h12v7h-2c-.5523 0-1 .4477-1 1v2h-1c-.5523 0-1 .4477-1 1s.4477 1 1 1h5c.5523 0 2-.9 2-2V3.85714C20 2.98529 19.3667 2 18.268 2H6Z" />
                        <path d="M6 11.5C6 9.567 7.567 8 9.5 8S13 9.567 13 11.5 11.433 15 9.5 15 6 13.433 6 11.5ZM4 20c0-2.2091 1.79086-4 4-4h3c2.2091 0 4 1.7909 4 4 0 1.1046-.8954 2-2 2H6c-1.10457 0-2-.8954-2-2Z" />

                    </svg>

                </div>

                <div class="stat-info">

                    <span class="stat-value">
                        {{ $departmentProfessors ?? 0 }}
                    </span>

                    <span class="stat-title">
                        Department
                        <br>
                        Professor
                    </span>

                </div>

            </a>


            <!-- ================= THIRD CARD ================= -->
            <!-- Classes / Courses -->

            <a href="#"
                class="stat-card">

                <div class="stat-icon">

                    <svg class="w-6 h-6 text-gray-800 dark:text-white"
                        aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg"
                        width="24"
                        height="24"
                        fill="currentColor"
                        viewBox="0 0 24 24">

                        <path fill-rule="evenodd"
                            d="M4 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v16a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V4Zm4 0a1 1 0 0 0-1 1v2a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V5a1 1 0 0 0-1-1H8Zm0 7a1 1 0 1 0 0 2h8a1 1 0 0 0 0-2H8Zm0 4a1 1 0 1 0 0 2h5a1 1 0 0 0 0-2H8Z"
                            clip-rule="evenodd" />

                    </svg>

                </div>

                <div class="stat-info">

                    <span class="stat-value">
                        {{ $departmentClasses ?? 0 }}
                    </span>

                    <span class="stat-title">
                        Department
                        <br>
                        Classes
                    </span>

                </div>

            </a>


            <!-- ================= FOURTH CARD ================= -->
            <!-- Announcements -->

            <a href="#"
                class="stat-card">

                <div class="stat-icon">

                    <svg class="w-6 h-6 text-gray-800 dark:text-white"
                        aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg"
                        width="24"
                        height="24"
                        fill="currentColor"
                        viewBox="0 0 24 24">

                        <path fill-rule="evenodd"
                            d="M18.458 3.11A1 1 0 0 1 19 4v16a1 1 0 0 1-1.581.814L12 16.944V7.056l5.419-3.87a1 1 0 0 1 1.039-.076ZM22 12c0 1.48-.804 2.773-2 3.465v-6.93c1.196.692 2 1.984 2 3.465ZM10 8H4a1 1 0 0 0-1 1v6a1 1 0 0 0 1 1h6V8Zm0 9H5v3a1 1 0 0 0 1 1h3a1 1 0 0 0 1-1v-3Z"
                            clip-rule="evenodd" />

                    </svg>

                </div>

                <div class="stat-info">

                    <span class="stat-value">
                        {{ $departmentAnnouncements ?? 0 }}
                    </span>

                    <span class="stat-title">
                        Department
                        <br>
                        Announcements
                    </span>

                </div>

            </a>

        </div>

{{-- ============================================================
     SCHEDULE MANAGEMENT
============================================================ --}}

<section class="schedule-management-section">

    {{-- Section Header --}}
    <div class="schedule-section-header">

        <div class="schedule-section-heading">
            <span class="schedule-section-eyebrow">
                ACADEMIC TOOLS
            </span>

            <h2 class="schedule-section-title">
                Schedule Management
            </h2>

            <p class="schedule-section-description">
                Create and manage class schedules for your department.
            </p>
        </div>

    </div>


    {{-- Schedule Action Cards --}}
    <div class="schedule-action-grid">

        {{-- Create Schedule Card --}}
        <article class="schedule-action-card create-schedule-card">

            <div class="schedule-card-top">

                <div class="schedule-action-icon create-icon">
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        width="26"
                        height="26"
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="2"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                    >
                        <rect
                            x="3"
                            y="4"
                            width="18"
                            height="18"
                            rx="2"
                            ry="2"
                        />

                        <line x1="16" y1="2" x2="16" y2="6"/>
                        <line x1="8" y1="2" x2="8" y2="6"/>
                        <line x1="3" y1="10" x2="21" y2="10"/>

                        <line x1="12" y1="14" x2="12" y2="18"/>
                        <line x1="10" y1="16" x2="14" y2="16"/>
                    </svg>
                </div>

                <span class="schedule-card-label">
                    CREATE
                </span>

            </div>


            <div class="schedule-card-content">

                <h3 class="schedule-card-title">
                    Create Schedule
                </h3>

                <p class="schedule-card-description">
                    Create a new schedule with courses, professors,
                    classrooms, sessions, and year levels.
                </p>

            </div>


            <div class="schedule-card-footer">

                <a
                    href="{{ route('hod.schedules.create') }}"
                    class="schedule-action-button create-button"
                >
                    <span>Create Schedule</span>

                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        width="19"
                        height="19"
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="2"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                    >
                        <line x1="5" y1="12" x2="19" y2="12"/>
                        <polyline points="12 5 19 12 12 19"/>
                    </svg>
                </a>

            </div>

        </article>



        {{-- Manage Schedules Card --}}
        <article class="schedule-action-card manage-schedule-card">

            <div class="schedule-card-top">

                <div class="schedule-action-icon manage-icon">
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        width="26"
                        height="26"
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="2"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                    >
                        <rect
                            x="3"
                            y="4"
                            width="18"
                            height="18"
                            rx="2"
                            ry="2"
                        />

                        <line x1="16" y1="2" x2="16" y2="6"/>
                        <line x1="8" y1="2" x2="8" y2="6"/>
                        <line x1="3" y1="10" x2="21" y2="10"/>

                        <polyline points="9 16 11 18 15 14"/>
                    </svg>
                </div>

                <span class="schedule-card-label">
                    MANAGE
                </span>

            </div>


            <div class="schedule-card-content">

                <h3 class="schedule-card-title">
                    Manage Schedules
                </h3>

                <p class="schedule-card-description">
                    View, edit, delete, publish, and export your
                    department schedules as DOCX documents.
                </p>

            </div>


            <div class="schedule-card-footer">

                <a
                    href="{{ route('hod.schedules.index') }}"
                    class="schedule-action-button manage-button"
                >
                    <span>View Schedules</span>

                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        width="19"
                        height="19"
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="2"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                    >
                        <line x1="5" y1="12" x2="19" y2="12"/>
                        <polyline points="12 5 19 12 12 19"/>
                    </svg>
                </a>

            </div>

        </article>

    </div>

</section>

    </div>


    <!--------------- Right side of the main content of the dashboard ---------------->

    <div class="dashboard-right">


        <!-- ============================= Overview Card ============================= -->

        <div class="overview-card">

            <div class="overview-header">

                <h2>
                    Today's Summary
                </h2>

                <span class="overview-eyebrow">
                    {{ now()->format('M j') }}
                </span>

            </div>


            <div class="overview-content">

                <div class="overview-item" data-stat="classes">

                    <div class="overview-item-icon">
                        <svg xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke-width="2"
                            stroke="currentColor">

                            <path stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" />

                        </svg>
                    </div>

                    <div class="overview-item-text">

                        <span class="overview-item-name">
                            New Classes
                        </span>

                        <span class="overview-item-description">
                            Published today
                        </span>

                    </div>

                    <span class="overview-item-value">
                        {{ $newClassesToday ?? 0 }}
                    </span>

                </div>


                <div class="overview-item" data-stat="students">

                    <div class="overview-item-icon">

                        <svg xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke-width="2"
                            stroke="currentColor">

                            <path stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M6.75 2.994v2.25m10.5-2.25v2.25m-14.252 13.5V7.491a2.25 2.25 0 0 1 2.25-2.25h13.5a2.25 2.25 0 0 1 2.25 2.25v11.251m-18 0a2.25 2.25 0 0 0 2.25 2.25h13.5a2.25 2.25 0 0 0 2.25 2.25m-18 0v-7.5a2.25 2.25 0 0 1 2.25-2.25h13.5a2.25 2.25 0 0 1 2.25 2.25v7.5" />

                        </svg>

                    </div>

                    <div class="overview-item-text">

                        <span class="overview-item-name">
                            New Students
                        </span>

                        <span class="overview-item-description">
                            Registered today
                        </span>

                    </div>

                    <span class="overview-item-value">
                        {{ $newStudentsToday ?? 0 }}
                    </span>

                </div>


                <div class="overview-item" data-stat="announcements">

                    <div class="overview-item-icon">

                        <svg xmlns="http://www.w3.org/2000/svg"
                            fill="currentColor"
                            viewBox="0 0 24 24">

                            <path fill-rule="evenodd"
                                d="M18.458 3.11A1 1 0 0 1 19 4v16a1 1 0 0 1-1.581.814L12 16.944V7.056l5.419-3.87a1 1 0 0 1 1.039-.076ZM22 12c0 1.48-.804 2.773-2 3.465v-6.93c1.196.692 2 1.984 2 3.465ZM10 8H4a1 1 0 0 0-1 1v6a1 1 0 0 0 1 1h6V8Zm0 9H5v3a1 1 0 0 0 1 1h3a1 1 0 0 0 1-1v-3Z"
                                clip-rule="evenodd" />

                        </svg>

                    </div>

                    <div class="overview-item-text">

                        <span class="overview-item-name">
                            New Announcements
                        </span>

                        <span class="overview-item-description">
                            Published today
                        </span>

                    </div>

                    <span class="overview-item-value">
                        {{ $newAnnouncementsToday ?? 0 }}
                    </span>

                </div>

            </div>


            <div class="quick-action">

                <h2>
                    Quick Actions
                </h2>

                <div class="quick-action-buttons">

                    <a href="{{ route('hod.schedules.create') }}"
                        class="quick-action-button">
                        + Schedule
                    </a>

                    <a href="#"
                        class="quick-action-button">
                        + Announcements
                    </a>

                </div>

            </div>

        </div>


        <!-- ============================= Chart Card ============================= -->

        <div class="chart-card">

            <div class="chart-header">

                <h2>
                    Student Enrollment
                </h2>

                <p>
                    Number of students in your department by academic year
                </p>

            </div>


            <div class="chart-container">

                <canvas id="studentChart"></canvas>

            </div>

        </div>


    </div>

</div>


<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>


<!-- Lottie -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bodymovin/5.12.2/lottie.min.js"></script>


<script>

    document.addEventListener('DOMContentLoaded', function () {

        const welcomeAnimation = document.getElementById('welcome-animation');

        if (welcomeAnimation && typeof lottie !== 'undefined') {

            lottie.loadAnimation({
                container: welcomeAnimation,
                renderer: 'svg',
                loop: true,
                autoplay: true,
                path: "{{ asset('animations/welcome.json') }}"
            });

        }

    });

</script>


<style>
/* ============================================================
   SCHEDULE MANAGEMENT SECTION
============================================================ */

.schedule-management-section {
    width: 100%;
    min-width: 0;
    margin-top: 30px;
    box-sizing: border-box;
}


/* ============================================================
   SECTION HEADER
============================================================ */

.schedule-section-header {
    width: 100%;
    margin-bottom: 18px;
}

.schedule-section-heading {
    min-width: 0;
}

.schedule-section-eyebrow {
    display: inline-block;
    margin-bottom: 6px;

    color: var(--primary-color);
    font-size: 12px;
    font-weight: 800;
    letter-spacing: 0.12em;
    text-transform: uppercase;
}

.schedule-section-title {
    margin: 0;

    color: var(--heading-color);
    font-size: 24px;
    font-weight: 800;
    line-height: 1.25;
    letter-spacing: -0.035em;
}

.schedule-section-description {
    margin: 7px 0 0;

    color: var(--secondary-text-color);
    font-size: 14px;
    line-height: 1.5;
}


/* ============================================================
   ACTION GRID
============================================================ */

.schedule-action-grid {
    display: grid;
    grid-template-columns: repeat(2, minmax(0, 1fr));
    gap: 18px;

    width: 100%;
    min-width: 0;
}


/* ============================================================
   ACTION CARD
============================================================ */

.schedule-action-card {
    display: flex;
    flex-direction: column;

    min-width: 0;
    min-height: 205px;
    padding: 22px;

    background: var(--card-color);
    border: 1px solid var(--border-color);
    border-radius: 18px;

    box-sizing: border-box;
    overflow: hidden;

    transition:
        border-color 0.2s ease,
        box-shadow 0.2s ease;
}

.schedule-action-card:hover {
    border-color: var(--primary-color);
    box-shadow: 0 8px 22px rgba(30, 64, 175, 0.08);
}


/* ============================================================
   CARD TOP
============================================================ */

.schedule-card-top {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 12px;

    margin-bottom: 18px;
}

.schedule-action-icon {
    display: flex;
    align-items: center;
    justify-content: center;

    width: 48px;
    height: 48px;

    border-radius: 14px;
    flex-shrink: 0;
}

.schedule-action-icon svg {
    width: 25px;
    height: 25px;
}


/* Create icon */

.create-icon {
    color: #6366f1;
    background: #eef2ff;
}


/* Manage icon */

.manage-icon {
    color: #0891b2;
    background: #e0f7fa;
}


/* ============================================================
   CARD LABEL
============================================================ */

.schedule-card-label {
    padding: 6px 10px;

    border-radius: 999px;

    color: var(--secondary-text-color);
    background: var(--background-color);

    font-size: 10px;
    font-weight: 800;
    letter-spacing: 0.08em;
    white-space: nowrap;
}


/* ============================================================
   CARD CONTENT
============================================================ */

.schedule-card-content {
    flex: 1;
    min-width: 0;
}

.schedule-card-title {
    margin: 0 0 8px;

    color: var(--heading-color);
    font-size: 19px;
    font-weight: 800;
    line-height: 1.3;
    letter-spacing: -0.025em;
}

.schedule-card-description {
    max-width: 440px;
    margin: 0;

    color: var(--secondary-text-color);
    font-size: 13px;
    line-height: 1.65;
}


/* ============================================================
   CARD FOOTER
============================================================ */

.schedule-card-footer {
    display: flex;
    align-items: center;

    margin-top: 22px;
}


/* ============================================================
   ACTION BUTTON
============================================================ */

.schedule-action-button {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 10px;

    min-height: 42px;
    padding: 11px 17px;

    border: 1px solid transparent;
    border-radius: 10px;

    font-size: 13px;
    font-weight: 800;
    line-height: 1;
    text-decoration: none;
    white-space: nowrap;

    transition:
        background-color 0.2s ease,
        color 0.2s ease,
        border-color 0.2s ease,
        transform 0.2s ease;
}

.schedule-action-button svg {
    width: 17px;
    height: 17px;
    flex-shrink: 0;
}

.schedule-action-button:hover {
    transform: translateY(-1px);
}

.schedule-action-button:active {
    transform: translateY(0);
}

.schedule-action-button:focus-visible {
    outline: 2px solid var(--primary-color);
    outline-offset: 3px;
}


/* Create button */

.create-button {
    color: #ffffff;
    background: var(--primary-color);
}

.create-button:hover {
    color: #ffffff;
    background: var(--primary2-color);
}


/* Manage button */

.manage-button {
    color: #087f9c;
    background: #e0f7fa;
    border-color: #b8edf4;
}

.manage-button:hover {
    color: #075985;
    background: #c9f3f8;
    border-color: #8edee9;
}


/* ============================================================
   DARK MODE
============================================================ */

.dark .schedule-action-card,
.dark-mode .schedule-action-card {
    background: var(--card-color);
    border-color: var(--border-color);
}

.dark .schedule-action-card:hover,
.dark-mode .schedule-action-card:hover {
    border-color: var(--primary-color);
    box-shadow: 0 8px 22px rgba(0, 0, 0, 0.18);
}

.dark .create-icon,
.dark-mode .create-icon {
    color: #a5b4fc;
    background: rgba(99, 102, 241, 0.16);
}

.dark .manage-icon,
.dark-mode .manage-icon {
    color: #67e8f9;
    background: rgba(6, 182, 212, 0.15);
}

.dark .schedule-card-label,
.dark-mode .schedule-card-label {
    background: var(--background-color);
    color: var(--secondary-text-color);
}

.dark .manage-button,
.dark-mode .manage-button {
    color: #67e8f9;
    background: rgba(6, 182, 212, 0.14);
    border-color: rgba(6, 182, 212, 0.28);
}

.dark .manage-button:hover,
.dark-mode .manage-button:hover {
    color: #cffafe;
    background: rgba(6, 182, 212, 0.24);
    border-color: rgba(6, 182, 212, 0.4);
}


/* ============================================================
   RESPONSIVE DESIGN
============================================================ */

@media (max-width: 1100px) {

    .schedule-action-grid {
        gap: 14px;
    }

    .schedule-action-card {
        padding: 19px;
    }

    .schedule-card-title {
        font-size: 18px;
    }

    .schedule-card-description {
        font-size: 12px;
    }

}


@media (max-width: 850px) {

    .schedule-action-grid {
        grid-template-columns: 1fr;
    }

    .schedule-action-card {
        min-height: 190px;
    }

}


@media (max-width: 600px) {

    .schedule-management-section {
        margin-top: 24px;
    }

    .schedule-section-title {
        font-size: 21px;
    }

    .schedule-section-description {
        font-size: 13px;
    }

    .schedule-action-card {
        padding: 18px;
        border-radius: 16px;
    }

    .schedule-card-top {
        margin-bottom: 15px;
    }

    .schedule-action-icon {
        width: 44px;
        height: 44px;
        border-radius: 12px;
    }

    .schedule-action-icon svg {
        width: 23px;
        height: 23px;
    }

    .schedule-card-title {
        font-size: 17px;
    }

    .schedule-card-description {
        font-size: 12px;
        line-height: 1.55;
    }

    .schedule-card-footer {
        margin-top: 18px;
    }

    .schedule-action-button {
        width: 100%;
        min-height: 42px;
        font-size: 12px;
    }

}

</style>

@endsection
