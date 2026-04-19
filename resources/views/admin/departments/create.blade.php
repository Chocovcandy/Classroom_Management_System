<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Department</title>

    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">

<div class="bg-white p-8 rounded-xl shadow-md w-full max-w-md">

    <h2 class="text-xl font-bold mb-4 text-gray-800">Create Department</h2>

    {{-- Success Message --}}
    @if(session('success'))
        <div class="bg-green-100 text-green-700 p-2 mb-4 rounded">
            {{ session('success') }}
        </div>
    @endif

    {{-- Error Message --}}
    @if($errors->any())
        <div class="bg-red-100 text-red-700 p-2 mb-4 rounded">
            <ul>
                @foreach($errors->all() as $error)
                    <li>- {{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('admin.departments.store') }}">
        @csrf

        <!-- Department Name -->
        <label class="block mb-2 text-sm font-medium text-gray-700">
            Department Name
        </label>
        <input type="text" name="department_name"
               class="w-full border rounded-lg p-2 mb-4"
               required>

        <!-- Description -->
        <label class="block mb-2 text-sm font-medium text-gray-700">
            Description (optional)
        </label>
        <textarea name="description"
                  class="w-full border rounded-lg p-2 mb-4"></textarea>

        <!-- Submit -->
        <button type="submit"
                class="w-full bg-blue-600 text-white py-2 rounded-lg hover:bg-blue-700">
            Create Department
        </button>
    </form>

    <!-- Back -->
    <a href="{{ route('admin.departments.index') }}"
       class="block mt-4 text-center text-sm text-gray-500 hover:underline">
        Back to Departments
    </a>

</div>

</body>
</html>