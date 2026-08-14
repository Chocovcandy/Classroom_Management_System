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

<div class="min-h-screen bg-slate-50 flex items-center justify-center px-6 py-12">

    <div class="w-full max-w-4xl">

        <!-- Header -->
        <div class="text-center mb-10">
            <h1 class="text-4xl font-bold text-gray-900">
                Welcome
            </h1>

            <p class="mt-3 text-gray-500 text-lg">
                Choose how you want to continue.
            </p>
        </div>


        @guest

            <!-- Login / Register Options -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                <!-- Login Card -->
                <div
                    class="bg-white rounded-3xl border border-gray-200 shadow-lg p-8
                           hover:shadow-xl hover:-translate-y-1 transition duration-300">

                    <div
                        class="mx-auto flex h-16 w-16 items-center justify-center
                               rounded-2xl bg-blue-100 text-blue-600 text-2xl">
                        🔐
                    </div>

                    <div class="text-center mt-6">

                        <h2 class="text-2xl font-bold text-gray-900">
                            Login
                        </h2>

                        <p class="mt-3 text-gray-500 leading-relaxed">
                            For professors, deans, and administrators
                            with school-provided accounts.
                        </p>

                    </div>

                    <a href="{{ route('login') }}"
                        class="mt-8 flex items-center justify-center rounded-xl
                               bg-blue-600 py-3.5 font-semibold text-white
                               shadow-lg hover:bg-blue-700 hover:shadow-xl
                               transition duration-300">

                        Login

                    </a>

                </div>


                <!-- Student Register Card -->
                @if (Route::has('register'))

                    <div
                        class="bg-white rounded-3xl border border-gray-200 shadow-lg p-8
                               hover:shadow-xl hover:-translate-y-1 transition duration-300">

                        <div
                            class="mx-auto flex h-16 w-16 items-center justify-center
                                   rounded-2xl bg-emerald-100 text-emerald-600 text-2xl">
                            🎓
                        </div>

                        <div class="text-center mt-6">

                            <h2 class="text-2xl font-bold text-gray-900">
                                Register as a Student
                            </h2>

                            <p class="mt-3 text-gray-500 leading-relaxed">
                                Create your own student account
                                and get started with the system.
                            </p>

                        </div>

                        <a href="{{ route('register') }}"
                            class="mt-8 flex items-center justify-center rounded-xl
                                   border-2 border-emerald-600
                                   py-3.5 font-semibold text-emerald-600
                                   hover:bg-emerald-600 hover:text-white
                                   transition duration-300">

                            Register as Student

                        </a>

                    </div>

                @endif

            </div>

        @endguest


        @auth

            @php
                $role = auth()->user()->roles->first()->role_name ?? 'User';
            @endphp

            <div class="max-w-md mx-auto">

                <!-- User Card -->
                <div class="rounded-3xl bg-white border border-gray-200
                            shadow-xl p-8 text-center">

                    <div
                        class="mx-auto flex h-16 w-16 items-center justify-center
                               rounded-full bg-blue-100 text-blue-700
                               font-bold text-xl">

                        {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}

                    </div>

                    <h3 class="mt-4 text-xl font-semibold text-gray-900">
                        {{ auth()->user()->name }}
                    </h3>

                    <span
                        class="inline-flex mt-2 rounded-full bg-blue-100
                               px-3 py-1 text-sm font-medium text-blue-700">

                        {{ $role }}

                    </span>

                </div>


                <!-- Dashboard Button -->
                @if ($role === 'Admin')
                    <a href="{{ route('admin.dashboard') }}"
                @elseif ($role === 'Dean')
                    href="{{ route('dean.dashboard') }}"
                @elseif ($role === 'HoD')
                    href="{{ route('hod.dashboard') }}"
                @elseif ($role === 'Professor')
                    href="{{ route('professor.dashboard') }}"
                @elseif ($role === 'Student')
                    href="{{ route('student.dashboard') }}"
                @endif

                    class="mt-6 flex justify-center rounded-xl
                           bg-emerald-600 py-3 font-semibold text-white
                           shadow-lg hover:bg-emerald-700 transition">

                    Go to Dashboard

                </a>


                <!-- Logout -->
                <form method="POST" action="{{ route('logout') }}" class="mt-4">

                    @csrf

                    <button type="submit"
                        class="w-full rounded-xl border border-red-300
                               py-3 font-medium text-red-600
                               hover:bg-red-50 transition">

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