
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'Professor Panel')</title>
    <!-- NOTE : THESE 2 IS ONLY CALL FOR ONCE  -->
    <!--CSS for admin -->
    @vite('resources/css/web.css')
    <!-- javascript for darkmode -->
    @vite('resources/js/app.js')

    <!-- BOXICON -->
<link
    href="https://cdn.jsdelivr.net/npm/boxicons@2.1.4/css/boxicons.min.css"
    rel="stylesheet"
>

</head>
    <style>
        /* ============================================================
           PROFILE INITIAL
        ============================================================ */

        .profile-initial {
            display: flex;
            align-items: center;
            justify-content: center;

            flex-shrink: 0;

            background: #4f8ef7;
            color: #ffffff;

            font-weight: 700;
            text-transform: uppercase;
        }

        .img-profile.profile-initial {
            width: 44px;
            height: 44px;

            border-radius: 50%;

            font-size: 18px;
        }

        .menu-profile-img.profile-initial {
            width: 58px;
            height: 58px;

            border-radius: 50%;

            font-size: 24px;
        }

        .dark .profile-initial,
        .dark-mode .profile-initial {
            background: #7189ff;
            color: #ffffff;
        }
    </style>
<body>

    <div class="app-shell">
        <header class="topbar">
            <!-- leftside -->

            <div class="topbar-left">
                <!-- logo -->
                <a href="{{ route('professor.dashboard') }}">
                    <img
                        src="{{ asset('images/logo.png') }}"
                        alt="logo"
                        class="topbar-logo">

                </a>
            </div>

            <!-- rightside -->
            <div class="topbar-right">


                <!-- Theme Toggle    -->
                <div class="theme-switch">

                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="theme-icon">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 3v2.25m6.364.386-1.591 1.591M21 12h-2.25m-.386 6.364-1.591-1.591M12 18.75V21m-4.773-4.227-1.591 1.591M5.25 12H3m4.227-4.773L5.636 5.636M15.75 12a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0Z" />
                    </svg>


                    <label class="switch-btn">
                        <input type="checkbox" id="darkmode">
                        <span class="switch-slider">
                            <span class="switch-thumb"></span>
                        </span>
                    </label>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="theme-icon">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21.752 15.002A9.72 9.72 0 0 1 18 15.75c-5.385 0-9.75-4.365-9.75-9.75 0-1.33.266-2.597.748-3.752A9.753 9.753 0 0 0 3 11.25C3 16.635 7.365 21 12.75 21a9.753 9.753 0 0 0 9.002-5.998Z" />
                    </svg>



                </div>
<!-- ====================================================
     PROFILE DROPDOWN
==================================================== -->

@php
    $currentUser = auth()->user();

    $userInitial = strtoupper(
        substr($currentUser->name ?? 'U', 0, 1)
    );
@endphp


<div class="profile-dropdown">

    <div class="profile">

        <!-- Profile Initial -->
        <div class="img-profile profile-initial">
            {{ $userInitial }}
        </div>


        <div class="profile-text">

            <p class="profile-text-name">
                {{ $currentUser->name }}
            </p>

            <p class="profile-text-role">
                Professor
            </p>

        </div>


        <!-- Dropdown Arrow -->
        <svg
            xmlns="http://www.w3.org/2000/svg"
            width="24"
            height="24"
            viewBox="0 0 24 24"
            fill="none"
            stroke="currentColor"
            stroke-width="2"
            stroke-linecap="round"
            stroke-linejoin="round"
            class="lucide lucide-chevron-down"
        >
            <path d="m6 9 6 6 6-6" />
        </svg>

    </div>


    <!-- ==================================================
         PROFILE MENU
    ================================================== -->

    <div class="profile-menu">

        <div class="profile-menu-header">

            <!-- Profile Initial -->
            <div class="menu-profile-img profile-initial">
                {{ $userInitial }}
            </div>


            <h3>
                {{ $currentUser->name }}
            </h3>

            <p>
                {{ $currentUser->email }}
            </p>

            <span class="role-badge">
                Student
            </span>

        </div>


        <div class="profile-menu-divider"></div>


        <!-- ==================================================
             LOGOUT
        ================================================== -->

        <form
            method="POST"
            action="{{ route('logout') }}"
        >

            @csrf

            <button type="submit">

                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    width="24"
                    height="24"
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="2"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    class="lucide lucide-log-out"
                >
                    <path d="m16 17 5-5-5-5" />
                    <path d="M21 12H9" />
                    <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4" />
                </svg>

                Logout

            </button>

        </form>

    </div>

</div>

            </div>

        </header>

        <div class="layout">
            <!-- sidebar  -->

<!-- ============================================================
     PROFESSOR SIDEBAR
============================================================ -->

<aside class="sidebar open" id="sidebar">

    <!-- ========================================================
         SIDEBAR TOGGLE BUTTON
    ======================================================== -->

    <button
        type="button"
        id="sidebarToggle"
        class="sidebar-toggle"
        aria-label="Close sidebar"
        aria-expanded="true"
    >
        <i class="bx bx-chevron-left"></i>
    </button>


    <!-- ========================================================
         SIDEBAR NAVIGATION
    ======================================================== -->

    <ul class="sidebar-menu">


        <!-- ====================================================
             DASHBOARD
        ==================================================== -->

        <li>
            <a
                href="{{ route('professor.dashboard') }}"
                class="sidebar-link {{ request()->routeIs('professor.dashboard') ? 'active' : '' }}"
            >

                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    width="512"
                    height="512"
                    fill="currentColor"
                    viewBox="0 0 24 24"
                >
                    <path d="M20 3h-6c-.55 0-1 .45-1 1v8c0 .55.45 1 1 1h6c.55 0 1-.45 1-1V4c0-.55-.45-1-1-1m-1 8h-4V5h4zm-9-8H4c-.55 0-1 .45-1 1v4c0 .55.45 1 1 1h6c.55 0 1-.45 1-1V4c0-.55-.45-1-1-1M9 7H5V5h4zm11 8h-6c-.55 0-1 .45-1 1v4c0 .55.45 1 1 1h6c.55 0 1-.45 1-1v-4c0-.55-.45-1-1-1m-1 4h-4v-2h4zm-9-8H4c-.55 0-1 .45-1 1v8c0 .55.45 1 1 1h6c.55 0 1-.45 1-1v-8c0-.55-.45-1-1-1m-1 8H5v-6h4z"></path>
                </svg>

                <span class="sidebar-text">
                    Dashboard
                </span>

            </a>
        </li>


        <!-- ====================================================
             SCHEDULE
        ==================================================== -->

        <li>
            <a
                href="{{ route('professor.schedule.index') }}"
                class="sidebar-link {{ request()->routeIs('professor.schedule.*') ? 'active' : '' }}"
            >

                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    width="24"
                    height="24"
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="2.25"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                >
                    <path d="M21.42 10.922a1 1 0 0 0-.019-1.838L12.83 5.18a2 2 0 0 0-1.66 0L2.6 9.08a1 1 0 0 0 0 1.832l8.57 3.908a2 2 0 0 0 1.66 0z" />
                    <path d="M22 10v6" />
                    <path d="M6 12.5V16a6 3 0 0 0 12 0v-3.5" />
                </svg>

                <span class="sidebar-text">
                    Schedule
                </span>

            </a>
        </li>


        <!-- ====================================================
             CLASSROOM COURSES
        ==================================================== -->

        <li>
            <a
                href="{{ route('professor.class-groups.index') }}"
                class="sidebar-link {{ request()->routeIs('professor.class-groups.*') ? 'active' : '' }}"
            >

                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    width="24"
                    height="24"
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="2"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                >
                    <path d="M10 2v8l3-3 3 3V2" />
                    <path d="M4 19.5v-15A2.5 2.5 0 0 1 6.5 2H19a1 1 0 0 1 1 1v18a1 1 0 0 1-1 1H6.5a2.5 2.5 0 0 0 0-5H20" />
                </svg>

                <span class="sidebar-text">
                    Classroom Courses
                </span>

            </a>
        </li>


    </ul>

</aside>

            <main class="main-content">
                @yield('content')
            </main>
        </div>
    </div>


</body>

</html>