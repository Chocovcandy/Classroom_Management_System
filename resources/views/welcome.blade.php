<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Classroom Management System</title>

    <!-- Tailwind CDN (quick setup) -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 min-h-screen flex items-center justify-center">

    <div class="bg-white shadow-lg rounded-2xl p-10 w-full max-w-md text-center">

        <h1 class="text-2xl font-bold text-gray-800 mb-4">
            Classroom Management System
        </h1>

        <p class="text-gray-500 mb-6">
            Manage users, departments, and schedules efficiently.
        </p>

        @guest
        <div class="flex flex-col gap-3">
            <a href="{{ route('login') }}"
                class="bg-blue-600 text-white py-2 rounded-lg hover:bg-blue-700 transition">
                Login
            </a>

            @if (Route::has('register'))
            <a href="{{ route('register') }}"
                class="border border-gray-300 py-2 rounded-lg hover:bg-gray-100 transition">
                Register (Student)
            </a>
            @endif
        </div>
        @endguest

        @auth
        <div class="space-y-4">
            <p class="text-gray-700">
                Welcome, <span class="font-semibold">{{ auth()->user()->name }}</span>
            </p>

            @php
            $role = auth()->user()->roles->first()->role_name ?? null;
            @endphp

            @if ($role === 'Admin')
            <a href="{{ route('admin.dashboard') }}" class="block bg-green-600 text-white py-2 rounded-lg">Go to Dashboard</a>

            @elseif ($role === 'Dean')
            <a href="{{ route('dean.dashboard') }}" class="block bg-green-600 text-white py-2 rounded-lg">Go to Dashboard</a>

            @elseif ($role === 'HoD')
            <a href="{{ route('hod.dashboard') }}" class="block bg-green-600 text-white py-2 rounded-lg">Go to Dashboard</a>

            @elseif ($role === 'Professor')
            <a href="{{ route('professor.dashboard') }}" class="block bg-green-600 text-white py-2 rounded-lg">Go to Dashboard</a>

            @elseif ($role === 'Student')
            <a href="{{ route('student.dashboard') }}" class="block bg-green-600 text-white py-2 rounded-lg">Go to Dashboard</a>
            @endif

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit"
                    class="w-full border border-red-400 text-red-600 py-2 rounded-lg hover:bg-red-50 transition">
                    Logout
                </button>
            </form>
        </div>
        @endauth

    </div>

</body>

</html>