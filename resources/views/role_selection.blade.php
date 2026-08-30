<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Classroom Management System</title>


    <!-- ========================================================= BOXICONS ========================================================= -->
    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">

    <link
        rel="stylesheet"
        href="{{ asset('assets/css/role_selection.css') }}">

    <link
        rel="stylesheet"
        href="{{ asset('assets/css/welcome_style.css') }}">

    <script src="https://cdn.tailwindcss.com"></script>

</head>


<body>

<div class="auth-choice-page">


    <!-- ==============================GUEST USER ========================================================= -->

    @guest

        <div class="auth-choice-layout">


            <!-- ================= LEFT SIDE ================= -->

            <div class="auth-brand">

                <img
                    src="{{ asset('assets/img/Life_circle_blue_LG.png') }}"
                    alt="School Logo"
                    class="auth-school-logo"
                >


                <div class="img_svg8">

                    <x-icons.form />

                </div>

            </div>

            <!-- ================= RIGHT SIDE ================= -->

            <div class="auth-options">


                <!-- Header -->

                <div class="auth-options-header">

                    <span>
                        GET STARTED
                    </span>


                    <h2>
                        How would you like to continue?
                    </h2>


                    <p style="margin-top: 15px">

                        Choose an option below to access
                        the Classroom Management System.

                    </p>

                </div>



                <!-- =======================================LOG IN================================================= -->

                <a href="{{ route('login') }}"class="auth-option-card" style="margin-bottom: 30px">

                    <!-- Icon -->

                    <div class="auth-option-icon login-icon">

                        <i class="bx bx-log-in"></i>

                    </div>


                    <!-- Information -->

                    <div class="auth-option-info">

                        <span class="auth-option-label">
                            I ALREADY HAVE AN ACCOUNT
                        </span>


                        <h3>
                            Login
                        </h3>
                        <p>

                            For professors, deans, and administrators
                            with school-provided credentials.

                        </p>

                    </div>


                    <!-- Arrow -->

                    <i class="bx bx-right-arrow-alt auth-option-arrow"></i>

                </a>



                <!-- ====================================REGISTER ================================================= -->

                @if (Route::has('register'))

                    <a href="{{ route('register') }}" class="auth-option-card">

                        <!-- Icon -->

                        <div class="auth-option-icon student-icon">

                            <i class="bx bx-user-plus"></i>

                        </div>


                        <!-- Information -->

                        <div class="auth-option-info">

                            <span class="auth-option-label">
                                I'M A STUDENT
                            </span>


                            <h3>
                                Register as a Student
                            </h3>


                            <p>

                                Create your student account
                                to get started.

                            </p>

                        </div>


                        <!-- Arrow -->

                        <i class="bx bx-right-arrow-alt auth-option-arrow"></i>

                    </a>

                @endif


            </div>

        </div>

    @endguest



    <!-- =========================================================
         AUTHENTICATED USER
         ========================================================= -->

    @auth

        @php

            $role = auth()->user()->roles->first()->role_name ?? 'User';

        @endphp


        <div class="mt-8 w-full max-w-md mx-auto">


            <!-- =================================================
                 WELCOME BACK CARD
                 ================================================= -->

            <div class="rounded-3xl bg-white border border-slate-200 shadow-xl p-7">


                <!-- ================= USER HEADER ================= -->

                <div class="flex items-center gap-4">


                    <!-- Avatar -->

                    <div class="flex h-16 w-16 shrink-0 items-center justify-center rounded-2xl bg-blue-100 text-blue-700 font-bold text-2xl" >

                        {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}

                    </div>



                    <!-- User Information -->

                    <div class="min-w-0">

                        <p class="text-sm font-medium text-slate-500">

                            Welcome back

                        </p>


                        <h3 class="mt-1 text-xl font-bold text-slate-900 truncate">

                            {{ auth()->user()->name }}

                        </h3>


                        <span class="inline-flex mt-1 rounded-full bg-blue-50 px-3 py-1 text-xs font-semibold text-blue-700">

                            {{ $role }}

                        </span>

                    </div>

                </div>



                <!-- ================= DIVIDER ================= -->

                <div class="my-6 border-t border-slate-100"></div>



                <!-- ================= MESSAGE ================= -->

                <div class="mb-5">

                    <h4 class="text-base font-semibold text-slate-800">

                        Continue where you left off

                    </h4>


                    <p class="mt-1 text-sm leading-6 text-slate-500">

                        You're already signed in.
                        Go back to your dashboard to continue
                        managing your classroom.

                    </p>

                </div>



                <!-- ==========================DASHBOARD BUTTO ================================================= -->

                @if ($role === 'Admin')

                    <a
                        href="{{ route('admin.dashboard') }}"
                        class="group flex w-full items-center justify-between rounded-2xl bg-blue-600 px-5 py-4 font-semibold text-white shadow-lg shadow-blue-600/20 transition duration-200 hover:bg-blue-700 hover:shadow-xl"
                    >

                @elseif ($role === 'Dean')

                    <a
                        href="{{ route('dean.dashboard') }}"
                        class="group flex w-full items-center justify-between rounded-2xl bg-blue-600 px-5 py-4 font-semibold text-white shadow-lg shadow-blue-600/20 transition duration-200 hover:bg-blue-700 hover:shadow-xl"
                    >

                @elseif ($role === 'HoD')

                    <a
                        href="{{ route('hod.dashboard') }}"
                        class="group flex w-full items-center justify-between rounded-2xl bg-blue-600 px-5 py-4 font-semibold text-white shadow-lg shadow-blue-600/20 transition duration-200 hover:bg-blue-700 hover:shadow-xl"
                    >

                @elseif ($role === 'Professor')

                    <a
                        href="{{ route('professor.dashboard') }}"
                        class="group flex w-full items-center justify-between rounded-2xl bg-blue-600 px-5 py-4 font-semibold text-white shadow-lg shadow-blue-600/20 transition duration-200 hover:bg-blue-700 hover:shadow-xl"
                    >

                @elseif ($role === 'Student')

                    <a
                        href="{{ route('student.dashboard') }}"
                        class="group flex w-full items-center justify-between rounded-2xl bg-blue-600 px-5 py-4 font-semibold text-white shadow-lg shadow-blue-600/20 transition duration-200 hover:bg-blue-700 hover:shadow-xl"
                    >

                @endif


                    <!-- Dashboard Icon + Text -->

                    <div class="flex items-center gap-3">


                        <!-- Icon -->

                        <div
                            class="flex h-10 w-10 items-center justify-center rounded-xl bg-white/15"
                        >

                            <i class="bx bx-home-alt-2 text-xl"></i>

                        </div>


                        <!-- Text -->

                        <div class="text-left">

                            <span class="block text-sm font-semibold">

                                Go to Dashboard

                            </span>


                            <span class="block text-xs font-normal text-blue-100">

                                Open your workspace

                            </span>

                        </div>

                    </div>



                    <!-- Arrow -->

                    <i
                        class="bx bx-right-arrow-alt text-2xl transition-transform duration-200 group-hover:translate-x-1"
                    ></i>


                </a>



                <!-- =================================================
                     LOGOUT
                     ================================================= -->

                <form
                    method="POST"
                    action="{{ route('logout') }}"
                    class="mt-3"
                >

                    @csrf


                    <button
                        type="submit"
                        class="group flex w-full items-center justify-center gap-2 rounded-2xl border border-slate-200 bg-slate-50 px-5 py-3.5 font-medium text-slate-600 transition duration-200 hover:border-red-200 hover:bg-red-50 hover:text-red-600"
                    >

                        <i
                            class="bx bx-log-out text-lg transition-transform duration-200 group-hover:-translate-x-0.5"
                        ></i>


                        Sign out

                    </button>

                </form>


            </div>

        </div>

    @endauth


</div>


</body>

</html>