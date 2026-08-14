<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="/assets/css/style.css">

    <title>Classroom Management System</title>
</head>
<body>
        <div class="register-page">

    <nav class="navbar">
        <div class="logo">
            CMS
        </div>
    </nav>


    <main class="container">


        <section>

            <span class="badge">
                Classroom Management System
            </span>


            <h1 class="hero-title">
                Manage Your
                <span>University</span>
                Easily
            </h1>


            <p class="description">
                A modern platform for managing students,
                professors, classrooms, schedules and academic records.
            </p>


            <div class="features">

                <div class="feature">
                    Student Management
                </div>

                <div class="feature">
                    Professor Management
                </div>

                <div class="feature">
                    Schedule Management
                </div>

                <div class="feature">
                    Department Management
                </div>

            </div>

        </section>



        <section class="auth-card">


            <div class="icon-box">
                +
            </div>


            <h2 class="auth-title">
                Welcome
            </h2>


            <p class="auth-text">
                Sign in to access your dashboard.
            </p>


            <a href="{{ route('login') }}" class="btn btn-primary">
                Login
            </a>


            <a href="{{ route('register') }}" class="btn btn-outline">
                Register as Student
            </a>


        </section>


    </main>

</div>

</body>

</html>