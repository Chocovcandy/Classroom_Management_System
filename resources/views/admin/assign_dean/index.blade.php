<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dean Management</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 min-h-screen p-6">

    <div class="max-w-5xl mx-auto bg-white rounded-2xl shadow p-8">

        <h1>Dean List</h1>

        @if(session('success'))
        <p style="color:green">{{ session('success') }}</p>
        @endif

        @forelse($deans as $dean)

        <div class="border p-5 rounded-xl mb-4 bg-gray-50">
            <h2 class="font-semibold">{{ $dean->name }}</h2>
            <p class="text-sm text-gray-500">{{ $dean->email }}</p>

            <p class="mt-2 text-sm">
                Departments:
                {{ $dean->departments->pluck('department_name')->join(', ') ?: 'None' }}
            </p>

            <a href="{{ route('admin.assign_dean.edit', $dean->id) }}"
                class="inline-block mt-3 bg-blue-600 text-white px-4 py-2 rounded">
                Manage
            </a>
        </div>

        @empty
        <div class="text-center text-gray-400 py-10">
            No Deans found.
        </div>
        @endforelse
        <a href="{{ route('admin.users.index') }}" class="text-blue-600 hover:underline">
            ← Back to users List
        </a>
    </div>



</body>

</html>