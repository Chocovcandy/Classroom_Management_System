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


            <div class="min-h-screen bg-slate-50">

                    <!-- Right -->
                    <div class="w-full max-w-md bg-white rounded-3xl border border-gray-200 shadow-xl p-10">

                        @guest

                            <div class="mt-10 space-y-4">

                                <a href="{{ route('login') }}"
                                    class="flex items-center justify-center rounded-xl bg-blue-600 py-3 font-semibold text-white shadow-lg hover:bg-blue-700 hover:shadow-xl transition duration-300">

                                    Login
                                </a>
                                @if (Route::has('register'))

                                    <a href="{{ route('register') }}"
                                        class="flex items-center justify-center rounded-xl border border-gray-300 bg-white py-3 font-semibold text-gray-700 hover:bg-gray-50 transition duration-300">

                                        Register as Student

                                    </a>

                                @endif

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

                                    <span
                                        class="inline-flex mt-2 rounded-full bg-blue-100 px-3 py-1 text-sm font-medium text-blue-700">

                                        {{ $role }}

                                    </span>

                                </div>

                                <!-- Dashboard Button -->

                                @if ($role === 'Admin')
                                <a href="{{ route('admin.dashboard') }}" @elseif ($role === 'Dean') 
                                href="{{ route('dean.dashboard') }}" @elseif ($role === 'HoD') 
                                    href="{{ route('hod.dashboard') }}" @elseif ($role === 'Professor') 
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