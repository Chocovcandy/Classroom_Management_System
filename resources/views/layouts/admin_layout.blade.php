<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'Admin Panel')</title>
    <!-- NOTE : THESE 2 IS ONLY CALL FOR ONCE  -->
    <!--CSS for admin -->
    @vite('resources/css/web.css')
    <!-- javascript for darkmode -->
    @vite('resources/js/app.js')
</head>

<body>

    <div class="app-shell">
        <header class="topbar">
            <!-- leftside -->

            <div class="topbar-left">
                <!-- logo -->
                <a href="{{ route('admin.dashboard') }}">
                    <img
                        src="{{ asset('images/logo.png') }}"
                        alt="logo"
                        class="topbar-logo">

                </a>
            </div>

            <!-- rightside -->
            <div class="topbar-right">
                <!-- Icon For top bar-->
                <div class="topbar-icon">
                    <!-- languages icon -->
                    <a href="#" class="icon-btn">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-language">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M9 6.371c0 4.418 -2.239 6.629 -5 6.629" />
                            <path d="M4 6.371h7" />
                            <path d="M5 9c0 2.144 2.252 3.908 6 4" />
                            <path d="M12 20l4 -9l4 9" />
                            <path d="M19.1 18h-6.2" />
                            <path d="M6.694 3l.793 .582" />
                        </svg>
                    </a>
                    <!-- notification icon  -->
                    <a href="#" class="icon-btn">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-bell-ringing">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M10 5a2 2 0 0 1 4 0a7 7 0 0 1 4 6v3a4 4 0 0 0 2 3h-16a4 4 0 0 0 2 -3v-3a7 7 0 0 1 4 -6" />
                            <path d="M9 17v1a3 3 0 0 0 6 0v-1" />
                            <path d="M21 6.727a11.05 11.05 0 0 0 -2.794 -3.727" />
                            <path d="M3 6.727a11.05 11.05 0 0 1 2.792 -3.727" />
                        </svg>
                    </a>
                </div>

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


                <div class="profile-dropdown">

                    <div class="profile">

                        <img
                            src="{{ asset('images/profile.png') }}"
                            alt="profile"
                            class="img-profile">

                        <div class="profile-text">
                            <p class="profile-text-name">
                                {{ auth()->user()->name }}
                            </p>

                            <p class="profile-text-role">
                                {{ auth()->user()->roles()->first()->name ?? 'No Role' }}
                            </p>
                        </div>

                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-chevron-down-icon lucide-chevron-down">
                            <path d="m6 9 6 6 6-6" />
                        </svg>

                    </div>

                    <!-- drop down for profile info and log out option  -->

                    <div class="profile-menu">

                        <div class="profile-menu-header">

                            <img
                                src="{{ asset('images/profile.png') }}"
                                alt="profile"
                                class="menu-profile-img">

                            <h3>{{ auth()->user()->name }}</h3>

                            <p>{{ auth()->user()->email }}</p>

                            <span class="role-badge">
                                {{ auth()->user()->roles()->first()->name ?? 'No Role' }}

                        </div>

                        <div class="profile-menu-divider"></div>

                        <a href="#">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-user-round-cog-icon lucide-user-round-cog">
                                <path d="m14.305 19.53.923-.382" />
                                <path d="m15.228 16.852-.923-.383" />
                                <path d="m16.852 15.228-.383-.923" />
                                <path d="m16.852 20.772-.383.924" />
                                <path d="m19.148 15.228.383-.923" />
                                <path d="m19.53 21.696-.382-.924" />
                                <path d="M2 21a8 8 0 0 1 10.434-7.62" />
                                <path d="m20.772 16.852.924-.383" />
                                <path d="m20.772 19.148.924.383" />
                                <circle cx="10" cy="8" r="5" />
                                <circle cx="18" cy="18" r="3" />
                            </svg>
                            Account Settings
                        </a>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <button type="submit">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-log-out-icon lucide-log-out">
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
            <aside class="sidebar closed" id="sidebar">
                <ul class="sidebar-menu">
                    <li><a href="{{ route('admin.dashboard') }}" class="sidebar-link" id="sidebarlinks">
                            <svg xmlns="http://www.w3.org/2000/svg" width="512" height="512"
                                fill="currentColor" viewBox="0 0 24 24">
                                <path d="M20 3h-6c-.55 0-1 .45-1 1v8c0 .55.45 1 1 1h6c.55 0 1-.45 1-1V4c0-.55-.45-1-1-1m-1 8h-4V5h4zm-9-8H4c-.55 0-1 .45-1 1v4c0 .55.45 1 1 1h6c.55 0 1-.45 1-1V4c0-.55-.45-1-1-1M9 7H5V5h4zm11 8h-6c-.55 0-1 .45-1 1v4c0 .55.45 1 1 1h6c.55 0 1-.45 1-1v-4c0-.55-.45-1-1-1m-1 4h-4v-2h4zm-9-8H4c-.55 0-1 .45-1 1v8c0 .55.45 1 1 1h6c.55 0 1-.45 1-1v-8c0-.55-.45-1-1-1m-1 8H5v-6h4z"></path>
                            </svg>
                            <!-- use span to move text and controllable by css and js -->
                            <span class="sidebar-text">
                                Dashboard
                            </span>
                        </a>
                    </li>
                    <li><a href="{{ route('admin.users.index') }}" class="sidebar-link" id="sidebarlinks">
                            <svg xmlns="http://www.w3.org/2000/svg" width="512" height="512"
                                fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 11c1.71 0 3-1.29 3-3s-1.29-3-3-3-3 1.29-3 3 1.29 3 3 3m0-4c.6 0 1 .4 1 1s-.4 1-1 1-1-.4-1-1 .4-1 1-1m1 5h-2c-2.76 0-5 2.24-5 5v.5c0 .83.67 1.5 1.5 1.5h9c.83 0 1.5-.67 1.5-1.5V17c0-2.76-2.24-5-5-5m-5 5c0-1.65 1.35-3 3-3h2c1.65 0 3 1.35 3 3zm-1.5-6c.47 0 .9-.12 1.27-.33a5.03 5.03 0 0 1-.42-4.52C7.09 6.06 6.8 6 6.5 6 5.06 6 4 7.06 4 8.5S5.06 11 6.5 11m-.39 1H5.5C3.57 12 2 13.57 2 15.5v1c0 .28.22.5.5.5H4c0-1.96.81-3.73 2.11-5m11.39-1c1.44 0 2.5-1.06 2.5-2.5S18.94 6 17.5 6c-.31 0-.59.06-.85.15a5.03 5.03 0 0 1-.42 4.52c.37.21.79.33 1.27.33m1 1h-.61A6.97 6.97 0 0 1 20 17h1.5c.28 0 .5-.22.5-.5v-1c0-1.93-1.57-3.5-3.5-3.5"></path>
                            </svg>
                            <span class="sidebar-text">
                                Users
                            </span>
                        </a>
                    </li>
                    <li><a href="{{ route('admin.departments.index') }}" class="sidebar-link" id="sidebarlinks">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.25" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-graduation-cap-icon lucide-graduation-cap">
                                <path d="M21.42 10.922a1 1 0 0 0-.019-1.838L12.83 5.18a2 2 0 0 0-1.66 0L2.6 9.08a1 1 0 0 0 0 1.832l8.57 3.908a2 2 0 0 0 1.66 0z" />
                                <path d="M22 10v6" />
                                <path d="M6 12.5V16a6 3 0 0 0 12 0v-3.5" />
                            </svg>
                            <span class="sidebar-text">
                                Departments
                            </span>
                        </a></li>

                    <li><a href="#" class="sidebar-link" id="sidebarlinks">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M10.34 15.84c-.688-.06-1.386-.09-2.09-.09H7.5a4.5 4.5 0 1 1 0-9h.75c.704 0 1.402-.03 2.09-.09m0 9.18c.253.962.584 1.892.985 2.783.247.55.06 1.21-.463 1.511l-.657.38c-.551.318-1.26.117-1.527-.461a20.845 20.845 0 0 1-1.44-4.282m3.102.069a18.03 18.03 0 0 1-.59-4.59c0-1.586.205-3.124.59-4.59m0 9.18a23.848 23.848 0 0 1 8.835 2.535M10.34 6.66a23.847 23.847 0 0 0 8.835-2.535m0 0A23.74 23.74 0 0 0 18.795 3m.38 1.125a23.91 23.91 0 0 1 1.014 5.395m-1.014 8.855c-.118.38-.245.754-.38 1.125m.38-1.125a23.91 23.91 0 0 0 1.014-5.395m0-3.46c.495.413.811 1.035.811 1.73 0 .695-.316 1.317-.811 1.73m0-3.46a24.347 24.347 0 0 1 0 3.46" />
                            </svg>

                            <span class="sidebar-text">
                                Announcements
                            </span>
                        </a></li>


                    <li class="bottom-sidebar"><a href="#" class="sidebar-link" id="sidebarlinks">
                            <svg xmlns="http://www.w3.org/2000/svg" width="512" height="512"
                                fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 8c-2.21 0-4 1.79-4 4s1.79 4 4 4 4-1.79 4-4-1.79-4-4-4m0 6c-1.08 0-2-.92-2-2s.92-2 2-2 2 .92 2 2-.92 2-2 2"></path>
                                <path d="m20.42 13.4-.51-.29c.05-.37.08-.74.08-1.11s-.03-.74-.08-1.11l.51-.29c.96-.55 1.28-1.78.73-2.73l-1-1.73a2.006 2.006 0 0 0-2.73-.73l-.53.31c-.58-.46-1.22-.83-1.9-1.11v-.6c0-1.1-.9-2-2-2h-2c-1.1 0-2 .9-2 2v.6c-.67.28-1.31.66-1.9 1.11l-.53-.31c-.96-.55-2.18-.22-2.73.73l-1 1.73c-.55.96-.22 2.18.73 2.73l.51.29c-.05.37-.08.74-.08 1.11s.03.74.08 1.11l-.51.29c-.96.55-1.28 1.78-.73 2.73l1 1.73c.55.95 1.77 1.28 2.73.73l.53-.31c.58.46 1.22.83 1.9 1.11v.6c0 1.1.9 2 2 2h2c1.1 0 2-.9 2-2v-.6a8.7 8.7 0 0 0 1.9-1.11l.53.31c.95.55 2.18.22 2.73-.73l1-1.73c.55-.96.22-2.18-.73-2.73m-2.59-2.78c.11.45.17.92.17 1.38s-.06.92-.17 1.38a1 1 0 0 0 .47 1.11l1.12.65-1 1.73-1.14-.66c-.38-.22-.87-.16-1.19.14-.68.65-1.51 1.13-2.38 1.4-.42.13-.71.52-.71.96v1.3h-2v-1.3c0-.44-.29-.83-.71-.96-.88-.27-1.7-.75-2.38-1.4a1.01 1.01 0 0 0-1.19-.15l-1.14.66-1-1.73 1.12-.65c.39-.22.58-.68.47-1.11-.11-.45-.17-.92-.17-1.38s.06-.93.17-1.38A1 1 0 0 0 5.7 9.5l-1.12-.65 1-1.73 1.14.66c.38.22.87.16 1.19-.14.68-.65 1.51-1.13 2.38-1.4.42-.13.71-.52.71-.96v-1.3h2v1.3c0 .44.29.83.71.96.88.27 1.7.75 2.38 1.4.32.31.81.36 1.19.14l1.14-.66 1 1.73-1.12.65c-.39.22-.58.68-.47 1.11Z"></path>
                            </svg>
                            <span class="sidebar-text">
                                Settings
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