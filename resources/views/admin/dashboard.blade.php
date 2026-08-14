@extends('layouts.admin_layout')

@section('title', 'Dashboard')

@section('content')

<div class="dashboard-container">

    <!---------------- Left side of the main content of the dashboard=---------------->
    <div class="dashboard-left">

        <!--========================welcome card ======================================-->
        <div class="welcome-card">

            <div class="welcome-text">
                <h1>Welcome Back, {{ Auth::user()->name }}!</h1>

                <p>
                    Manage your users, departments, and system activities.
                </p>
            </div>

            <div class="welcome-img-container">
                <div id="welcome-animation"></div>
            </div>

        </div>

        <!-- =======================statistic card================================ -->
        <div class="stat-container">


            <!-- first card -->
            <a href="{{ route('admin.users.index', ['role' => 'Student']) }}" class="stat-card">

                <div class="stat-icon">

                    <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                        <path fill-rule="evenodd" d="M12 6a3.5 3.5 0 1 0 0 7 3.5 3.5 0 0 0 0-7Zm-1.5 8a4 4 0 0 0-4 4 2 2 0 0 0 2 2h7a2 2 0 0 0 2-2 4 4 0 0 0-4-4h-3Zm6.82-3.096a5.51 5.51 0 0 0-2.797-6.293 3.5 3.5 0 1 1 2.796 6.292ZM19.5 18h.5a2 2 0 0 0 2-2 4 4 0 0 0-4-4h-1.1a5.503 5.503 0 0 1-.471.762A5.998 5.998 0 0 1 19.5 18ZM4 7.5a3.5 3.5 0 0 1 5.477-2.889 5.5 5.5 0 0 0-2.796 6.293A3.501 3.501 0 0 1 4 7.5ZM7.1 12H6a4 4 0 0 0-4 4 2 2 0 0 0 2 2h.5a5.998 5.998 0 0 1 3.071-5.238A5.505 5.505 0 0 1 7.1 12Z" clip-rule="evenodd" />
                    </svg>

                </div>


                <div class="stat-info">

                    <span class="stat-value">
                        {{ $totalStudents }}
                    </span>

                    <span class="stat-title">
                        Total Students
                    </span>

                </div>

            </a>



            <!-- second card -->

            <!-- // NOTICE : academic_staff is not a real role in db, why we do this? cuz we want to group 
                // Dean, HoD , and prof call them by group (acedemic_staff) in order to show admin after they click "total Academic staff" on the dashboard.
                // Then the controller only group the Dean, HOd and prof under the name (academic staff). 
                // after than the controller group them (Dean , HoD ,and prof) in one page so that admin see all the academic staff.  -->
            <a href="{{ route('admin.users.index' ,['role' => 'academic_staff']) }}" class="stat-card">


                <div class="stat-icon">
                    <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M6 2c-1.10457 0-2 .89543-2 2v4c0 .55228.44772 1 1 1s1-.44772 1-1V4h12v7h-2c-.5523 0-1 .4477-1 1v2h-1c-.5523 0-1 .4477-1 1s.4477 1 1 1h5c.5523 0 1-.4477 1-1V3.85714C20 2.98529 19.3667 2 18.268 2H6Z" />
                        <path d="M6 11.5C6 9.567 7.567 8 9.5 8S13 9.567 13 11.5 11.433 15 9.5 15 6 13.433 6 11.5ZM4 20c0-2.2091 1.79086-4 4-4h3c2.2091 0 4 1.7909 4 4 0 1.1046-.8954 2-2 2H6c-1.10457 0-2-.8954-2-2Z" />
                    </svg>

                </div>


                <div class="stat-info">

                    <span class="stat-value">
                        {{ $totalAcademics }}
                    </span>

                    <span class="stat-title">
                        Total Academic Staff
                    </span>

                </div>


            </a>



            <!-- third card -->
            <a href="{{ route('admin.departments.index') }}" class="stat-card">


                <div class="stat-icon">

                    <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                        <path fill-rule="evenodd" d="M15 4c0-.55228.4477-1 1-1h4c.5523 0 1 .44772 1 1v3c0 .55228-.4477 1-1 1h-4v13H8V7.86853l-1.44532.96352c-.45952.30635-1.08039.18218-1.38675-.27735-.30635-.45953-.18217-1.0804.27735-1.38675l6.00002-4c.3359-.22393.7735-.22393 1.1094 0L15 4.79816V4Zm-5 8c0-.5523.4477-1 1-1h2c.5523 0 1 .4477 1 1s-.4477 1-1 1h-2c-.5523 0-1-.4477-1-1Zm1-4c-.5523 0-1 .44772-1 1s.4477 1 1 1h2c.5523 0 1-.44772 1-1s-.4477-1-1-1h-2Z" clip-rule="evenodd" />
                        <path d="M18 9.00011 17.9843 9h.0296L18 9.00011ZM6 10.5237l-2.27075.6386C3.29797 11.2836 3 11.677 3 12.125V20c0 .5523.44772 1 1 1h2V10.5237Zm14.2707.6386L18 10.5237V21h2c.5523 0 1-.4477 1-1v-7.875c0-.448-.298-.8414-.7293-.9627Z" />
                    </svg>

                </div>


                <div class="stat-info">

                    <span class="stat-value">
                        {{ $totalDepartments }}
                    </span>

                    <span class="stat-title">
                        Total Departments
                    </span>

                </div>


            </a>



            <!-- fourth card -->
            <a href="#" class="stat-card">


                <div class="stat-icon">

                    <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                        <path fill-rule="evenodd" d="M18.458 3.11A1 1 0 0 1 19 4v16a1 1 0 0 1-1.581.814L12 16.944V7.056l5.419-3.87a1 1 0 0 1 1.039-.076ZM22 12c0 1.48-.804 2.773-2 3.465v-6.93c1.196.692 2 1.984 2 3.465ZM10 8H4a1 1 0 0 0-1 1v6a1 1 0 0 0 1 1h6V8Zm0 9H5v3a1 1 0 0 0 1 1h3a1 1 0 0 0 1-1v-3Z" clip-rule="evenodd" />
                    </svg>

                </div>


                <div class="stat-info">

                    <span class="stat-value">
                        10
                    </span>

                    <span class="stat-title">
                        Total Announcements
                    </span>

                </div>


            </a>


        </div>

        <!--====================== activity card====================== -->
        <div class="activity-card">

            <div class="activity-header">
                <h2>Recent Activity</h2>
            </div>

            <div class="activity-filter">

                <!-- why are we put the data-filter ? cuz we want to filter the activities based on their type. and we will use it in JS -->
                <button class="active" data-filter="all">
                    All
                </button>

                <button data-filter="academics">
                    Academic Staffs
                </button>

                <button data-filter="departments">
                    Departments
                </button>

                <button data-filter="announcements">
                    Announcements
                </button>

            </div>

            <!-- list of recent activities   -->

            <!-- need an controller to show each records and a little js by the datataype -->
            <!-- ALL List combine in here but we only show thw 5 most recent  -->
            <div class="activity-list" data-type="all">

                @foreach($recentActivities as $activity)

                <div class="activity-item">

                    <div class="profile-image-container">

                        {{-- Academic Staff --}}
                        @if($activity['type'] === 'academic')

                        @if($activity['profile_image'])

                        <img
                            src="{{ asset('storage/' . $activity['profile_image']) }}"
                            alt="Profile Image"
                            class="user-profile-image">

                        @else

                        {{-- Default profile icon --}}
                        <svg xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke-width="2.25"
                            stroke="currentColor"
                            class="default-profile-icon">

                            <path stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M15.75 6a3.75 3.75 0 11-7.5 0
                                   3.75 3.75 0 017.5 0z
                                   M4.501 20.118a7.5 7.5 0 0114.998 0
                                   A17.933 17.933 0 0112 21.75
                                   c-2.676 0-5.216-.584-7.499-1.632z" />

                        </svg>

                        @endif


                        {{-- Department icon is there any recent department was created --}}
                        @elseif($activity['type'] === 'department')

                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-building-icon lucide-building">
                            <path d="M12 10h.01" />
                            <path d="M12 14h.01" />
                            <path d="M12 6h.01" />
                            <path d="M16 10h.01" />
                            <path d="M16 14h.01" />
                            <path d="M16 6h.01" />
                            <path d="M8 10h.01" />
                            <path d="M8 14h.01" />
                            <path d="M8 6h.01" />
                            <path d="M9 22v-3a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v3" />
                            <rect x="4" y="2" width="16" height="20" rx="2" />
                        </svg>

                        {{-- Announcement icon is there any recent annoucement was created --}}
                        @elseif($activity['type'] === 'announcement')

                        <svg xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke-width="2"
                            stroke="currentColor"
                            class="activity-icon">

                            <path stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M10.5 6.75L15.75 3v18l-5.25-3.75
                               M15.75 6.75h2.25a3 3 0 013 3v4.5
                               a3 3 0 01-3 3h-2.25
                               M10.5 6.75H5.25
                               A2.25 2.25 0 003 9v6
                               a2.25 2.25 0 002.25 2.25h5.25
                               M7.5 17.25l1.5 3h3l-1.5-3" />

                        </svg>

                        @endif

                    </div>


                    <div class="activity-info">

                        <span class="activity-title">
                            {{ $activity['name'] }}
                            {{ $activity['action'] }}
                        </span>

                        <span class="activity-subtitle">
                            {{ $activity['created_at']->format('F j, Y, g:i a') }}
                        </span>

                    </div>


                    <span class="activity-time">
                        {{ $activity['created_at']->diffForHumans() }}
                    </span>

                </div>

                @endforeach

            </div>

            <!-- academic staff list (DEAN, PROFESSOR , HOD) -->
            <div class="activity-list hidden" data-type="academics">

                @foreach ( $recentAcademics as $user )
                <div class="activity-item">

                    <!-- for profile image and icon -->
                    <div class="profile-image-container">
                        @if($user->profile_image)
                        <img src="{{ asset('storage/' . $user->profile_image) }}"
                            alt="Profile Image"
                            class="user-profile-image">
                        @else
                        <svg xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke-width="2"
                            stroke="currentColor"
                            class="default-profile-icon">
                            <path stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                        </svg>
                        @endif
                    </div>

                    <!-- for activity info and time -->
                    <div class="activity-info">

                        <span class="activity-title">

                            <!-- look up user that logged in name  -->
                            {{ $user->name }} created a new account
                        </span>

                        <span class="activity-subtitle">
                            <!-- look up for date user that just created an account -->
                            {{ $user->created_at->format('F j, Y, g:i a') }}
                        </span>

                    </div>

                    <span class="activity-time">
                        <!-- look up for time user that just created an account -->
                        {{ $user->created_at->diffForHumans() }}
                    </span>

                </div>

                @endforeach

            </div>

            <!-- department list -->

            <!-- why we adding another one ? cuz we want to filter the activities based on their type and instead on showing 3 tables
            we are displaying only one table but we still can have multiple lists table inside only one table by filtering it. 
            and we will use it in JS. 
            this below is hidden as default it will display when useers click on its filter-->
            <div class="activity-list hidden" data-type="departments">

                @foreach($recentDepartments as $department)

                <div class="activity-item">

                    <div class="profile-image-container">

                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-building-icon lucide-building">
                            <path d="M12 10h.01" />
                            <path d="M12 14h.01" />
                            <path d="M12 6h.01" />
                            <path d="M16 10h.01" />
                            <path d="M16 14h.01" />
                            <path d="M16 6h.01" />
                            <path d="M8 10h.01" />
                            <path d="M8 14h.01" />
                            <path d="M8 6h.01" />
                            <path d="M9 22v-3a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v3" />
                            <rect x="4" y="2" width="16" height="20" rx="2" />
                        </svg>

                    </div>


                    <div class="activity-info">

                        <span class="activity-title">
                            {{ $department->department_name }} department created
                        </span>


                        <span class="activity-subtitle">
                            {{ $department->created_at->format('F j, Y, g:i a') }}
                        </span>

                    </div>


                    <span class="activity-time">
                        {{ $department->created_at->diffForHumans() }}
                    </span>

                </div>

                @endforeach

            </div>

            <!-- annoucement list -->
            <div class="activity-list hidden" data-type="announcements">

                <div class="empty-state">
                    No announcements yet.
                </div>

            </div>


        </div>

    </div>



    <!--------------- Right side of the main content of the dashboard-------------------------- -->
    <div class="dashboard-right">

        <!-- =============================overview card ===========================-->
        <div class="overview-card">

            <div class="overview-header">
                <h2>Today's Summary</h2>
            </div>

            <div class="overview-content">

                <div class="overview-item">



                    <div class="overview-item-icon">

                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" />

                        </svg>
                    </div>


                    <div class="overview-item-text">
                        <span class="overview-item-name">
                            New Users
                        </span>

                        <span class="overview-item-description">
                            Registered today :
                        </span>

                    </div>


                    <span class="overview-item-value">
                        <!-- add controller here to display new user -->
                        8
                    </span>
                </div>

                <div class="overview-item">
                    <div class="overview-item-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-building-icon lucide-building">
                            <path d="M12 10h.01" />
                            <path d="M12 14h.01" />
                            <path d="M12 6h.01" />
                            <path d="M16 10h.01" />
                            <path d="M16 14h.01" />
                            <path d="M16 6h.01" />
                            <path d="M8 10h.01" />
                            <path d="M8 14h.01" />
                            <path d="M8 6h.01" />
                            <path d="M9 22v-3a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v3" />
                            <rect x="4" y="2" width="16" height="20" rx="2" />
                        </svg>

                    </div>

                    <div class="overview-item-text">

                        <span class="overview-item-name">
                            New Departments
                        </span>


                        <span class="overview-item-description">
                            Add today :
                        </span>
                    </div>


                    <span class="overview-item-value">
                        6
                    </span>

                </div>

                <div class="overview-item">
                    <div class="overview-item-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 2.994v2.25m10.5-2.25v2.25m-14.252 13.5V7.491a2.25 2.25 0 0 1 2.25-2.25h13.5a2.25 2.25 0 0 1 2.25 2.25v11.251m-18 0a2.25 2.25 0 0 0 2.25 2.25h13.5a2.25 2.25 0 0 0 2.25-2.25m-18 0v-7.5a2.25 2.25 0 0 1 2.25-2.25h13.5a2.25 2.25 0 0 1 2.25 2.25v7.5m-6.75-6h2.25m-9 2.25h4.5m.002-2.25h.005v.006H12v-.006Zm-.001 4.5h.006v.006h-.006v-.005Zm-2.25.001h.005v.006H9.75v-.006Zm-2.25 0h.005v.005h-.006v-.005Zm6.75-2.247h.005v.005h-.005v-.005Zm0 2.247h.006v.006h-.006v-.006Zm2.25-2.248h.006V15H16.5v-.005Z" />
                        </svg>

                    </div>

                    <div class="overview-item-text">
                        <span class="overview-item-name">
                            New announcements
                        </span>

                        <span class="overview-item-description">
                            Published today :
                        </span>

                    </div>
                    <span class="overview-item-value">
                        <!-- add controller here to display new announcement -->
                        8
                    </span>
                </div>



            </div>

            <div class="quick-action">
                <h2>Quick Actions</h2>

                <div class="quick-action-buttons">
                    <a href="{{ route('admin.users.index') }}" class="quick-action-button">
                        + Users
                    </a>
                    <a href="{{ route('admin.departments.index') }}" class="quick-action-button">
                        + Departments
                    </a>
                    <a href="#" class="quick-action-button">
                        + Announcements
                    </a>
                </div>

            </div>

        </div>


        <!-- =============================chart card============================= -->
        <!-- Student Enrollment Graph -->
        <!-- add js to this  -->
        <div class="chart-card">

            <div class="chart-header">
                <h2>Student Enrollment</h2>
                <p>Number of students by academic year</p>
            </div>


            <div class="chart-container">
                <canvas id="studentChart"></canvas>
            </div>


        </div>
    </div>



</div>
<!-- script for -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>


<!-- for animation -->
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