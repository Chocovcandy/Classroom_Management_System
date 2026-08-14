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
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
        }

        label {
            font-weight: bold;
        }

        input,
        select {
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

            @if(!$user->roles->pluck('role_name')->contains('Admin'))
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
            @endif

            <label>Old Password</label>
            <input type="password" name="password" placeholder="Please Type the old password"

            <label>New Password (optional)</label>
            <input type="password" name="password" placeholder="Leave blank if you don't want to change the password">

            <label>Confirm Password</label>
            <input type="password" name="password_confirmation" placeholder="Confirm new password">

            <!-- admin is not allowed to edit department of users here  -->



            <button type="submit">Update User</button>
        </form>

        <a href="{{ route('admin.users.index') }}" class="text-blue-600 hover:underline">
            ← Back to users List
        </a>
    </div>


</body>

</html>