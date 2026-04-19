<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>
</head>
<body>

<h1>Edit User</h1>

<form method="POST" action="{{ route('admin.users.update', $user->id) }}">
    @csrf
    @method('PUT')

    <!-- Name -->
    <label>Name</label><br>
    <input type="text" name="name" value="{{ $user->name }}"><br><br>

    <!-- Email -->
    <label>Email</label><br>
    <input type="email" name="email" value="{{ $user->email }}"><br><br>

    <!-- Role -->
    <label>Role</label><br>
    <select name="role_id">
        @foreach($roles as $role)
            <option value="{{ $role->id }}"
                {{ $user->roles->first()?->id == $role->id ? 'selected' : '' }}>
                {{ $role->role_name }}
            </option>
        @endforeach
    </select>
    <br><br>

    <!-- Department -->
    <label>Department</label><br>
    <select name="department_id">
        <option value="">-- None --</option>
        @foreach($departments as $department)
            <option value="{{ $department->id }}"
                {{ $user->department_id == $department->id ? 'selected' : '' }}>
                {{ $department->department_name }}
            </option>
        @endforeach
    </select>
    <br><br>

    <button type="submit">Update</button>
</form>

</body>
</html>