<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f6f9;
            padding: 30px;
        }

        .container {
            max-width: 500px;
            margin: auto;
            background: white;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }

        h1 {
            text-align: center;
        }

        label {
            font-weight: bold;
        }

        input, select {
            width: 100%;
            padding: 8px;
            margin-top: 5px;
            margin-bottom: 15px;
        }

        .roles {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
        }

        .roles label {
            font-weight: normal;
        }

        button {
            width: 100%;
            padding: 10px;
            background: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
            background: #45a049;
        }
    </style>
</head>
<body>

<div class="container">
    <h1>Edit User</h1>

    <form method="POST" action="{{ route('admin.users.update', $user->id) }}">
        @csrf
        @method('PUT')

        <!-- Name -->
        <label>Name</label>
        <input type="text" name="name" value="{{ $user->name }}">

        <!-- Email -->
        <label>Email</label>
        <input type="email" name="email" value="{{ $user->email }}">

        <label>Roles</label>
        <div class="roles">
            @foreach($roles as $role)
                <label>
                    <input type="checkbox" name="role_ids[]"
                        value="{{ $role->id }}"
                        {{ $user->roles->contains($role->id) ? 'checked' : '' }}>
                    {{ $role->role_name }}
                </label>
            @endforeach
        </div>

        <!-- Department  -->
<label>Department</label>

<div class="roles">
    @foreach($departments as $department)
        <label>
            <input type="radio"
                   name="department_id"
                   value="{{ $department->id }}"
                   {{ ($user->department_id == $department->id) ? 'checked' : '' }}>
            {{ $department->department_name }}
        </label>
    @endforeach
</div>

        <button type="submit">Update User</button>
    </form>
</div>

</body>
</html>