<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'User Panel')</title>

    <!-- NOTE : THESE 2 IS ONLY CALL FOR ONCE -->
    <!-- CSS for admin -->
    @vite('resources/css/web.css')

    <!-- javascript for darkmode -->
    @vite('resources/js/app.js')

    <link
        href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css"
        rel="stylesheet"
    >

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

</head>

<body>

    @php
        $currentUser = auth()->user();

        $userInitial = mb_strtoupper(
            mb_substr(trim($currentUser->name ?? 'U'), 0, 1)
        );
    @endphp

    <div class="app-shell">

        <header class="topbar">

            <!-- ========================================================
                 LEFT SIDE
            ======================================================== -->

            <div class="topbar-left">

                <!-- logo -->
                <a href="{{ route('admin.dashboard') }}">

                    <img
                        src="{{ asset('images/logo.png') }}"
                        alt="logo"
                        class="topbar-logo"
                    >

                </a>

            </div>


            <!-- ========================================================
                 RIGHT SIDE
            ======================================================== -->

            <div class="topbar-right">


                <!-- ====================================================
                     THEME TOGGLE
                ==================================================== -->

                <div class="theme-switch">

                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke-width="1.5"
                        stroke="currentColor"
                        class="theme-icon"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M12 3v2.25m6.364.386-1.591 1.591M21 12h-2.25m-.386 6.364-1.591-1.591M12 18.75V21m-4.773-4.227-1.591 1.591M5.25 12H3m4.227-4.773L5.636 5.636M15.75 12a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0Z"
                        />
                    </svg>


                    <label class="switch-btn">

                        <input
                            type="checkbox"
                            id="darkmode"
                        >

                        <span class="switch-slider">
                            <span class="switch-thumb"></span>
                        </span>

                    </label>


                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke-width="1.5"
                        stroke="currentColor"
                        class="theme-icon"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M21.752 15.002A9.72 9.72 0 0 1 18 15.75c-5.385 0-9.75-4.365-9.75-9.75 0-1.33.266-2.597.748-3.752A9.753 9.753 0 0 0 3 11.25C3 16.635 7.365 21 12.75 21a9.753 9.753 0 0 0 9.002-5.998Z"
                        />
                    </svg>

                </div>


                <!-- ====================================================
                     PROFILE DROPDOWN
                ==================================================== -->

                <div class="profile-dropdown">

                    <div class="profile">


                        <!-- ==================================================
                             USER PROFILE IMAGE / INITIAL
                        ================================================== -->

                        @if ($currentUser->profile_image)

                            <img
                                src="{{ asset('storage/' . $currentUser->profile_image) }}"
                                alt="{{ $currentUser->name }}"
                                class="img-profile"
                            >

                        @else

                            <div class="img-profile profile-initial">
                                {{ $userInitial }}
                            </div>

                        @endif


                        <div class="profile-text">

                            <p class="profile-text-name">
                                {{ $currentUser->name }}
                            </p>

                            <p class="profile-text-role">
                                {{ $currentUser->roles()->first()->name ?? 'No Role' }}
                            </p>

                        </div>


                        <!-- Dropdown arrow -->

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
                            class="lucide lucide-chevron-down-icon lucide-chevron-down"
                        >
                            <path d="m6 9 6 6 6-6" />
                        </svg>

                    </div>


                    <!-- ==================================================
                         PROFILE MENU
                    ================================================== -->

                    <div class="profile-menu">

                        <div class="profile-menu-header">


                            <!-- ==================================================
                                 MENU PROFILE IMAGE / INITIAL
                            ================================================== -->

                            @if ($currentUser->profile_image)

                                <img
                                    src="{{ asset('storage/' . $currentUser->profile_image) }}"
                                    alt="{{ $currentUser->name }}"
                                    class="menu-profile-img"
                                >

                            @else

                                <div class="menu-profile-img profile-initial">
                                    {{ $userInitial }}
                                </div>

                            @endif


                            <h3>
                                {{ $currentUser->name }}
                            </h3>

                            <p>
                                {{ $currentUser->email }}
                            </p>

                            <span class="role-badge">
                                {{ $currentUser->roles()->first()->name ?? 'No Role' }}
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
                                    class="lucide lucide-log-out-icon lucide-log-out"
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


        <!-- ============================================================
             MAIN LAYOUT
        ============================================================ -->

        <div class="layout">


            <!-- ========================================================
                 SIDEBAR
            ======================================================== -->
<aside
    class="sidebar open"
    id="sidebar"
>

    <!-- SIDEBAR TOGGLE BUTTON -->

    <button
        type="button"
        id="sidebarToggle"
        class="sidebar-toggle"
        aria-label="Close sidebar"
    >
        <i class="bx bx-chevron-left"></i>
    </button>


                <ul class="sidebar-menu">


                    <!-- ==================================================
                         DASHBOARD
                    ================================================== -->

                    <li>

                        <a
                            href="{{ route('admin.dashboard') }}"
                             class="sidebar-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}"
                            id="sidebarlinks"
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


                    <!-- ==================================================
                         USERS
                    ================================================== -->

                    <li>

                        <a
                            href="{{ route('admin.users.index') }}"
                            class="sidebar-link {{ request()->routeIs('admin.users.*') ? 'active' : '' }}"
                            id="sidebarlinks"
                        >

                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                width="512"
                                height="512"
                                fill="currentColor"
                                viewBox="0 0 24 24"
                            >
                                <path d="M12 11c1.71 0 3-1.29 3-3s-1.29-3-3-3-3 1.29-3 3 1.29 3 3 3m0-4c.6 0 1 .4 1 1s-.4 1-1 1-1-.4-1-1 .4-1 1-1m1 5h-2c-2.76 0-5 2.24-5 5v.5c0 .83.67 1.5 1.5 1.5h9c.83 0 1.5-.67 1.5-1.5V17c0-2.76-2.24-5-5-5m-5 5c0-1.65 1.35-3 3-3h2c1.65 0 3 1.35 3 3zm-1.5-6c.47 0 .9-.12 1.27-.33a5.03 5.03 0 0 1-.42-4.52C7.09 6.06 6.8 6 6.5 6 5.06 6 4 7.06 4 8.5S5.06 11 6.5 11m-.39 1H5.5C3.57 12 2 13.57 2 15.5v1c0 .28.22.5.5.5H4c0-1.96.81-3.73 2.11-5m11.39-1c1.44 0 2.5-1.06 2.5-2.5S18.94 6 17.5 6c-.31 0-.59.06-.85.15a5.03 5.03 0 0 1-.42 4.52c.37.21.79.33 1.27.33m1 1h-.61A6.97 6.97 0 0 1 20 17h1.5c.28 0 .5-.22.5-.5v-1c0-1.93-1.57-3.5-3.5-3.5"></path>
                            </svg>

                            <span class="sidebar-text">
                                Users
                            </span>

                        </a>

                    </li>


                    <!-- ==================================================
                         DEPARTMENTS
                    ================================================== -->

                    <li>

                        <a
                            href="{{ route('admin.departments.index') }}"
                         class="sidebar-link {{ request()->routeIs('admin.departments.*') ? 'active' : '' }}"
                            id="sidebarlinks"
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
                                class="lucide lucide-graduation-cap-icon lucide-graduation-cap"
                            >
                                <path d="M21.42 10.922a1 1 0 0 0-.019-1.838L12.83 5.18a2 2 0 0 0-1.66 0L2.6 9.08a1 1 0 0 0 0 1.832l8.57 3.908a2 2 0 0 0 1.66 0z" />
                                <path d="M22 10v6" />
                                <path d="M6 12.5V16a6 3 0 0 0 12 0v-3.5" />
                            </svg>

                            <span class="sidebar-text">
                                Departments
                            </span>

                        </a>

                    </li>




                </ul>


</aside>




            <!-- ========================================================
                 MAIN CONTENT
            ======================================================== -->

            <main class="main-content">

                @yield('content')

            </main>

        </div>

    </div>

</body>

</html>