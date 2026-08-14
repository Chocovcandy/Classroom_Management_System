<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--=============== BOXICONS ===============-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">

    <link rel="stylesheet" href="/assets/css/login_style.css">
    <link rel="stylesheet" href="/assets/css/welcome_style.css">

    <title>Classroom Management System</title>

    <!-- Tailwind CDN (quick setup) -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>

<div class="auth-choice-page">

    @guest

        <div class="auth-choice-container">

            <div class="auth-choice-header">
                <span class="auth-choice-label">CLASSROOM MANAGEMENT</span>

                <h1>Welcome</h1>

                <p>
                    Sign in or create an account to access your classroom dashboard.
                </p>
            </div>


            <div class="auth-choice-grid">

                <!-- Login -->
                <div class="auth-choice-card">

                    <div class="auth-choice-icon login-icon">
                        <i class="ri-login-box-line"></i>
                    </div>

                    <div class="auth-choice-content">

                        <h2>Login</h2>

                        <p>
                            Access your account using the credentials
                            provided by your institution.
                        </p>

                        <a href="{{ route('login') }}" class="auth-choice-btn login-btn">
                            Continue to Login
                            <i class="ri-arrow-right-line"></i>
                        </a>

                    </div>

                </div>


                <!-- Student Register -->
                @if (Route::has('register'))

                    <div class="auth-choice-card">

                        <div class="auth-choice-icon student-icon">
                            <i class="ri-user-add-line"></i>
                        </div>

                        <div class="auth-choice-content">

                            <h2>Register as a Student</h2>

                            <p>
                                Create your student account and start
                                using the classroom management system.
                            </p>

                            <a href="{{ route('register') }}"
                               class="auth-choice-btn student-btn">

                                Create Student Account
                                <i class="ri-arrow-right-line"></i>

                            </a>

                        </div>

                    </div>

                @endif

            </div>

        </div>

    @endguest


    @auth

        <!-- Keep your existing @auth code here -->

    @endauth

</div>


    </div>


</body>

</html>