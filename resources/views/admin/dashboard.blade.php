<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>

    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen">

<div class="max-w-3xl mx-auto mt-10 bg-white p-8 rounded-xl shadow">

    <!-- Header -->
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-xl font-bold text-gray-800">
            Admin Dashboard
        </h1>

        <!-- Logout -->
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit"
                class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">
                Logout
            </button>
        </form>
    </div>

    <!-- Welcome -->
    <p class="text-gray-600 mb-6">
        Welcome, <span class="font-semibold">{{ auth()->user()->name }}</span>
    </p>

    <!-- Actions -->
    <div class="flex flex-col gap-4">

        <a href="{{ route('admin.users.index') }}"
           class="block bg-blue-600 text-white text-center py-3 rounded-lg hover:bg-blue-700">
            Manage Users
        </a>

        <a href="{{ route('admin.departments.index') }}"
           class="block bg-green-600 text-white text-center py-3 rounded-lg hover:bg-green-700">
            Manage Departments
        </a>

        <a href="{{ route('admin.department.assignments') }}"
           class="block bg-purple-600 text-white text-center py-3 rounded-lg hover:bg-purple-700">
            Assign Departments
        </a>

    </div>

</div>

</body>
</html>