<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create User</title>

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
            background: #2196F3;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
            background: #1976D2;
        }
    </style>
</head>
<body>

<div class="container">
    <h1>Create User</h1>

    <form method="POST" action="{{ route('admin.users.store') }}">
        @csrf


        <label>Name</label>
        <input name="name" placeholder="Name">


        <label>Email</label>
        <input name="email" placeholder="Email">


        <label>Password</label>
        <input name="password" type="password" placeholder="Password">

        <!-- ROLES (MULTI) -->
        <label>Roles</label>
        <div class="roles">
            @foreach($roles as $role)
                <label>
                    <input type="checkbox" name="role_ids[]" value="{{ $role->id }}">
                    {{ $role->role_name }}
                </label>
            @endforeach
        </div>


        <!-- DEPARTMENT -->

      <label>Department</label>

<div class="roles">
    @foreach($departments as $department)
        <label>
            <input type="checkbox"
                   name="department_id"
                   value="{{ $department->id }}"
                   {{ ($user->department_id == $department->id) ? 'checked' : '' }}>
            {{ $department->department_name }}
        </label>
    @endforeach
</div>

        <button type="submit">Create User</button>
    </form>
</div>

</body>
</html>