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

<<<<<<< Updated upstream
        input {
            width: 100%;
            padding: 8px;
=======
        input, select {
            width: 100%;padding: 8px;
>>>>>>> Stashed changes
            margin-top: 5px;
            margin-bottom: 15px;
        }

        .roles {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin-bottom: 15px;
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

        .error {
            color: red;
            font-size: 13px;
            margin-bottom: 10px;
        }
    </style>
</head>

<body>

<div class="container">
    <h1>Create User</h1>

    <!-- if not use entype the image will not be uploaded -->
    <form method="POST" action="{{ route('admin.users.store') }}" enctype="multipart/form-data"> 
        @csrf

        <!-- Name --> 
         <!-- why we use old('...') in each of the input fields?
         becuz it detect if there input filed was filled or not if not it will say the filed is empty. the data is required than we can go and refilled the input data.
         and one more thing if we dont used it there's nothing to detech the input filled and when you accidently press enter it will refresh the page and 
         all the data that you input gone and we have to input it again. which is time consuming.if we used it and we accidently press enter it will refresh the page but the data that we inputed 
         will still there and we can just go and press submit again without inputing the data again. so it save us time and make sure that we fill all the data that we need to fill.
         in short use it to detech if each of all the data are inputed or not. and if not it gonna warn us that we havent filled them all yet. -->
        <label>Name</label>
        <input name="name" value="{{ old('name') }}" placeholder="Name">

        @error('name')
            <div class="error">{{ $message }}</div>
        @enderror

        <!-- Email -->
        <label>Email</label>
        <input name="email" value="{{ old('email') }}" placeholder="Email">

        @error('email')
            <div class="error">{{ $message }}</div>
        @enderror

        <!-- Password -->
        <label>Password</label>
        <input name="password" type="password" placeholder="Password">

        @error('password')
            <div class="error">{{ $message }}</div>
        @enderror

        <!-- ROLES -->
        <label>Roles</label>
        <div class="roles">
            @foreach($roles as $role)
                <label>
                    <input type="checkbox"
                           name="role_ids[]"
                           value="{{ $role->id }}"
                           {{ in_array($role->id, old('role_ids', [])) ? 'checked' : '' }}>
                    {{ $role->role_name }}
                </label>
            @endforeach
        </div>

     <label>Profile Image</label>
        <input type="file" name="profile_image" accept="image/*" >

<<<<<<< Updated upstream
        @error('role_ids')
            <div class="error">{{ $message }}</div>
        @enderror
=======
        <!-- DEPARTMENT -->

      <label>Department</label>

<div class="roles">
    @foreach($departments as $department)
        <label>
            <input type="checkbox"
                   name="department_ids[]"
                   value="{{ $department->id }}"
                   {{ ($user->department_id == $department->id) ? 'checked' : '' }}>
            {{ $department->department_name }}
        </label>
    @endforeach
</div>
>>>>>>> Stashed changes

        <button type="submit">Create User</button>
    </form>

    <a href="{{ route('admin.users.index') }}">
        ← Back to users List
    </a>
</div>

</body>
</html>