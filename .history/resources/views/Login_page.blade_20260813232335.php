<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--=============== BOXICONS ===============-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">

    <link rel="stylesheet" href="/assets/css/login_style.css">
    <link rel="stylesheet" href="/assets/css/welcome_style.css">

    <title>Classroom Management System</title>

    <!-- Tailwind CDN (quick setup) -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>
<div class="auth-choice-page">

    @guest

        <div class="auth-choice-layout">

            <!-- LEFT SIDE -->
            <div class="auth-brand">

    <img
        src="../assets/img/Life_circle_blue_LG.png"
        alt="School Logo"
        class="auth-school-logo"
    >

    <span class="auth-brand-label">
        CLASSROOM MANAGEMENT
    </span>

    <img
        src="../assets/img/classroom-illustration.svg"
        alt="Classroom Management Illustration"
        class="auth-illustration"
    >

</div>

            <!-- RIGHT SIDE -->
            <div class="auth-options">

                <div class="auth-options-header">

                    <span>GET STARTED</span>

                    <h2>
                        Choose how to continue
                    </h2>

                    <p>
                        Select the option that applies to you.
                    </p>

                </div>


                <!-- LOGIN -->
                <a href="{{ route('login') }}" class="auth-option-card">

                    <div class="auth-option-icon login-icon">
                        <i class="ri-login-box-line"></i>
                    </div>

                    <div class="auth-option-info">

                        <span class="auth-option-label">
                            EXISTING ACCOUNT
                        </span>

                        <h3>
                            Login
                        </h3>

                        <p>
                            For professors, deans, and administrators
                            with school-provided accounts.
                        </p>

                    </div>

                    <i class="ri-arrow-right-line auth-option-arrow"></i>

                </a>


                <!-- REGISTER -->
                @if (Route::has('register'))

                    <a href="{{ route('register') }}" class="auth-option-card">

                        <div class="auth-option-icon student-icon">
                            <i class="ri-user-add-line"></i>
                        </div>

                        <div class="auth-option-info">

                            <span class="auth-option-label">
                                NEW STUDENT
                            </span>

                            <h3>
                                Register as a Student
                            </h3>

                            <p>
                                Create your own student account
                                to access the classroom system.
                            </p>

                        </div>

                        <i class="ri-arrow-right-line auth-option-arrow"></i>

                    </a>

                @endif

            </div>

        </div>

    @endguest

</div>
        @auth
            @php
                $role = auth()->user()->roles->first()->role_name ?? 'User';
            @endphp
            <div class="mt-8">
                <!-- User Card -->
                <div class="rounded-2xl bg-slate-50 border border-slate-200 p-5 text-center">
                    <div
                        class="mx-auto flex h-14 w-14 items-center justify-center rounded-full bg-blue-100 text-blue-700 font-bold text-xl">

                        {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                    </div>

                    <h3 class="mt-4 text-xl font-semibold text-gray-900">
                        {{ auth()->user()->name }}
                    </h3>

                    <span class="inline-flex mt-2 rounded-full bg-blue-100 px-3 py-1 text-sm font-medium text-blue-700">
                        {{ $role }}
                    </span>

                </div>

                <!-- Dashboard Button -->

                @if ($role === 'Admin')
                <a href="{{ route('admin.dashboard') }}" @elseif ($role === 'Dean') href="{{ route('dean.dashboard') }}"
                @elseif ($role === 'HoD') href="{{ route('hod.dashboard') }}" @elseif ($role === 'Professor')
                    href="{{ route('professor.dashboard') }}" @elseif ($role === 'Student')
                    href="{{ route('student.dashboard') }}" @endif
                    class="mt-6 flex justify-center rounded-xl bg-emerald-600 py-3 font-semibold text-white shadow-lg hover:bg-emerald-700 transition">

                    Go to Dashboard

                </a>

                <form method="POST" action="{{ route('logout') }}" class="mt-4">
                    @csrf

                    <button type="submit"
                        class="w-full rounded-xl border border-red-300 py-3 font-medium text-red-600 hover:bg-red-50 transition">

                        Logout

                    </button>

                </form>

            </div>

        @endauth

    </div>
    </div>


    </div>


</body>

</html>