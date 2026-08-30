
@extends('layouts.hod_layout')

@section('title', 'Dean Dashboard')

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
                    classes, and activities.
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
                            d="M12 6a3.5 3.5 0 1 0 0 7 3.5 3.5 0 0 0 0-7Zm-1.5 8a4 4 0 0 0-4 4 2 2 0 0 0 2 2h7a2 2 0 0 0 2-2 4 4 0 0 0-4-4h-3Zm6.82-3.096a5.51 5.51 0 0 0-2.797-6.293 3.5 3.5 0 1 1 2.796 6.292ZM19.5 18h.5a2 2 0 0 0 2-2 4 4 0 0 0-4-4h-1.1a5.503 5.503 0 0 1-.471.762A5.998 5.998 0 0 1 19.5 18ZM4 7.5a3.5 3.5 0 0 1 5.477-2.889 5.5 5.5 0 0 0-2.796 6.293A3.501 3.501 0 0 1 4 7.5ZM7.1 12H6a4 4 0 0 0-4 4 2 2 0 0 0 2 2h.5a5.998 5.998 0 0 1 3.071-5.238A5.505 5.505 0 0 1 7.1 12Z"
                            clip-rule="evenodd" />

                    </svg>

                </div>


                <div class="stat-info">

                    <span class="stat-value">
          
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

                     <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M6 2c-1.10457 0-2 .89543-2 2v4c0 .55228.44772 1 1 1s1-.44772 1-1V4h12v7h-2c-.5523 0-1 .4477-1 1v2h-1c-.5523 0-1 .4477-1 1s.4477 1 1 1h5c.5523 0 1-.4477 1-1V3.85714C20 2.98529 19.3667 2 18.268 2H6Z" />
                        <path d="M6 11.5C6 9.567 7.567 8 9.5 8S13 9.567 13 11.5 11.433 15 9.5 15 6 13.433 6 11.5ZM4 20c0-2.2091 1.79086-4 4-4h3c2.2091 0 4 1.7909 4 4 0 1.1046-.8954 2-2 2H6c-1.10457 0-2-.8954-2-2Z" />
                    </svg>

                </div>


                <div class="stat-info">

                    <span class="stat-value">
                   
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
                            d="M4 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v16a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V4Zm4 0a1 1 0 0 0-1 1v2a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V5a1 1 0 0 0-1-1H8Zm0 7a1 1 0 1 0 0 2h8a1 1 0 1 0 0-2H8Zm0 4a1 1 0 1 0 0 2h5a1 1 0 1 0 0-2H8Z"
                            clip-rule="evenodd" />

                    </svg>

                </div>


                <div class="stat-info">

                    <span class="stat-value">

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

                    </span>

                    <span class="stat-title">
                        Department 
                        <br>
                        Announcements
                    </span>

                </div>

            </a>


        </div>


        <!-- ====================== Activity Card ====================== -->

        <div class="activity-card">

            <div class="activity-header">
                <h2>Recent Activity</h2>
            </div>


            <div class="activity-filter">

                <button class="active" data-filter="all">
                    All
                </button>

                <button data-filter="hod">
                   HoD
                </button>

                <button data-filter="professor">
                    Professor
                </button>

                <button data-filter="students">
                    Students
                </button>

                <button data-filter="students">
                    Schedule
                </button>

                <button data-filter="announcements">
                    Announcements
                </button>

            </div>











        </div>

    </div>



    <!--------------- Right side of the main content of the dashboard ---------------->

    <div class="dashboard-right">


        <!-- ============================= Overview Card ============================= -->

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

    lottie.loadAnimation({

        container: document.getElementById('welcome-animation'),

        renderer: 'svg',

        loop: true,

        autoplay: true,

        path: "{{ asset('animations/welcome.json') }}"

    });

</script>


@endsection

