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

        <div class="auth-choice-container">

            <div class="auth-choice-header">
                <span class="auth-choice-label">CLASSROOM MANAGEMENT</span>

                <h1>Welcome</h1>

                <p>
                    Sign in or create an account to access your classroom dashboard.
                </p>
            </div>


            <div class="auth-choice-grid">

                <!-- Login -->
                <div class="auth-choice-card">

                    <div class="auth-choice-icon login-icon">
                        <i class="ri-login-box-line"></i>
                    </div>

                    <div class="auth-choice-content">

                        <h2>Login</h2>

                        <p>
                            Access your account using the credentials
                            provided by your institution.
                        </p>

                        <a href="{{ route('login') }}" class="auth-choice-btn login-btn">
                            Continue to Login
                            <i class="ri-arrow-right-line"></i>
                        </a>

                    </div>

                </div>


                <!-- Student Register -->
                @if (Route::has('register'))

                    <div class="auth-choice-card">

                        <div class="auth-choice-icon student-icon">
                            <i class="ri-user-add-line"></i>
                        </div>

                        <div class="auth-choice-content">

                            <h2>Register as a Student</h2>

                            <p>
                                Create your student account and start
                                using the classroom management system.
                            </p>

                            <a href="{{ route('register') }}"
                               class="auth-choice-btn student-btn">

                                Create Student Account
                                <i class="ri-arrow-right-line"></i>

                            </a>

                        </div>

                    </div>

                @endif

            </div>

        </div>

    @endguest




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