<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>

    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen">

<div class="max-w-3xl mx-auto mt-10 bg-white p-8 rounded-xl shadow">

    <!-- Header -->
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-xl font-bold text-gray-800">
            Professor Dashboard
        </h1>

        <!-- Logout -->
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit"
                class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">
                Logout
            </button>
        </form>
    </div>

    <!-- Welcome -->
    <p class="text-gray-600 mb-6">
        Welcome, <span class="font-semibold">{{ auth()->user()->name }}</span>
    </p>

   
    
<p>
            LOG OUT when you're done testing.cuz system will remember you. if you dont logout and go back or close the browser and reopen it, you will still see the logged-in user that you previous login with.
            So if you want to test other users, make sure to log out first.</p>
    </div>

</div>

</body>
</html>