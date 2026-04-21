<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Users</title>

    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen p-6">

<div class="max-w-4xl mx-auto bg-white p-6 rounded-xl shadow">

    <!-- Header -->
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-xl font-bold text-gray-800">Users</h1>

        <a href="{{ route('admin.users.create') }}"
           class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
            + Create User
        </a>
    </div>

    <!-- Table -->
    <table class="w-full border border-gray-200 rounded-lg overflow-hidden">
        <thead class="bg-gray-200 text-gray-700">
            <tr>
                <th class="p-3 text-left">ID</th>
                <th class="p-3 text-left">Name</th>
                <th class="p-3 text-left">Email</th>
                <th class="p-3 text-left">Role</th>
                <th class="p-3 text-left">Department</th>
                <th class="p-3 text-left">Actions</th>
            </tr>
        </thead>

        <tbody>
            @forelse($users as $user)
                <tr class="border-t hover:bg-gray-50">
                    <td class="p-3">{{ $user->id }}</td>
                    <td class="p-3">{{ $user->name }}</td>
                    <td class="p-3">{{ $user->email }}</td>

                    <td class="p-3">
                        {{ $user->roles->pluck('role_name')->join(', ') }}
                    </td>
                    <td class="p-3">
                        {{ $user->department?->department_name ?? 'No Department' }}

                    </td>

                    <td class="p-3 flex gap-2">

                        <!-- Edit -->
                        <a href="{{ route('admin.users.edit', $user->id) }}"
                           class="bg-yellow-400 text-white px-3 py-1 rounded hover:bg-yellow-500">
                            Edit
                        </a>

                        <!-- Delete -->
                        <form method="POST"
                              action="{{ route('admin.users.destroy', $user->id) }}"
                              onsubmit="return confirm('Delete this user?')">
                            @csrf
                            @method('DELETE')

                            <button type="submit"
                                class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600">
                                Delete
                            </button>
                        </form>

                    </td>
                                @foreach($user->deanDepartments as $dept)
                <span>{{ $dept->department_name }}</span>
            @endforeach

                </tr>
            @empty
                <tr>
                    <td colspan="5" class="p-4 text-center text-gray-500">
                        No users found.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

</div>

</body>
</html>