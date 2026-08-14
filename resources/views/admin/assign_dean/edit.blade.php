<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Assign Dean</title>

    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 min-h-screen flex items-center justify-center p-6">

<div class="w-full max-w-xl bg-white rounded-2xl shadow-lg p-8">

    <!-- Title -->
    <h1 class="text-2xl font-semibold text-gray-800 mb-2">
        Assign Dean to Department
    </h1>

    <p class="text-sm text-gray-500 mb-6">
        Select a Dean and assign them to manage a department.
    </p>

    <!-- Success / Error Messages -->
    @if(session('success'))
        <div class="mb-4 p-3 bg-green-100 text-green-700 rounded-lg text-sm">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="mb-4 p-3 bg-red-100 text-red-700 rounded-lg text-sm">
            {{ session('error') }}
        </div>
    @endif
<h1>Manage {{ $dean->name }}</h1>

<form method="POST" action="{{ route('admin.assign_dean.update', $dean->id) }}">
    @csrf
    @method('PUT')

    @foreach($departments as $dept)
        <div>
            <label>
                <input type="checkbox"
                       name="department_ids[]"
                       value="{{ $dept->id }}"
                       {{ $dean->departments->contains($dept->id) ? 'checked' : '' }}>

                {{ $dept->department_name }}
            </label>
        </div>
    @endforeach

    <br>

    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
        Save
    </button>
</form>

<br>

<a href="{{ route('admin.assign_dean.index') }}" class="text-blue-600 hover:underline">
    ← Back to Dean List
</a>
</div>

</body>
</html>