<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Select Role</title>
</head>
<body>
    <div class="container">
        <h2>Select Your Role</h2>

        <form method="POST" action="{{ route('role.select.store') }}">
            @csrf

            @foreach($roles as $role)
                <div>
                    <label>
                       <input type="radio" name="role" value="{{ $role->role_name }}" required>
                            {{ $role->role_name }}
                    </label>
                </div>
            @endforeach

            <button type="submit">Continue</button>
        </form>
    </div>
</body>
</html>