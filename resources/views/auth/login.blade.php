<x-guest-layout>

    <div class="login-page">

        <div class="login-container">

            {{-- Left Login Panel --}}
            <section class="login-panel">

                <div class="login-panel-content">

                    {{-- University Logo --}}
                    <div class="login-logo-wrapper">
                        <img
                            src="{{ asset('images/logo.png') }}"
                            alt="Life University Logo"
                            class="login-logo"
                        >
                    </div>

                    {{-- Heading --}}
                    <div class="login-heading">
                        <h1>Welcome Back</h1>

                        <p>
                            Sign in to your Life University account
                        </p>
                    </div>

                    {{-- Session Status --}}
                    @if (session('status'))
                        <div class="login-status">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{-- Login Form --}}
                    <form
                        method="POST"
                        action="{{ route('login') }}"
                        class="login-form"
                    >
                        @csrf

                        {{-- Email --}}
                        <div class="form-group">

                            <label for="email">
                                Email Address
                            </label>

                            <div class="input-wrapper">

                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    width="19"
                                    height="19"
                                    viewBox="0 0 24 24"
                                    fill="none"
                                    stroke="currentColor"
                                    stroke-width="1.8"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                >
                                    <rect
                                        x="3"
                                        y="5"
                                        width="18"
                                        height="14"
                                        rx="2"
                                    />

                                    <polyline points="3 7 12 13 21 7"/>
                                </svg>

                                <input
                                    id="email"
                                    type="email"
                                    name="email"
                                    value="{{ old('email') }}"
                                    placeholder="Enter your email address"
                                    required
                                    autofocus
                                    autocomplete="username"
                                >

                            </div>

                            @error('email')
                                <span class="input-error">
                                    {{ $message }}
                                </span>
                            @enderror

                        </div>

                        {{-- Password --}}
                        <div class="form-group">

                            <label for="password">
                                Password
                            </label>

                            <div class="input-wrapper">

                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    width="19"
                                    height="19"
                                    viewBox="0 0 24 24"
                                    fill="none"
                                    stroke="currentColor"
                                    stroke-width="1.8"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                >
                                    <rect
                                        x="5"
                                        y="10"
                                        width="14"
                                        height="11"
                                        rx="2"
                                    />

                                    <path d="M8 10V7a4 4 0 0 1 8 0v3"/>
                                </svg>

                                <input
                                    id="password"
                                    type="password"
                                    name="password"
                                    placeholder="Enter your password"
                                    required
                                    autocomplete="current-password"
                                >

                                <button
                                    type="button"
                                    class="password-toggle"
                                    id="passwordToggle"
                                    aria-label="Show password"
                                >
                                    <svg
                                        id="eyeIcon"
                                        xmlns="http://www.w3.org/2000/svg"
                                        width="19"
                                        height="19"
                                        viewBox="0 0 24 24"
                                        fill="none"
                                        stroke="currentColor"
                                        stroke-width="1.8"
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                    >
                                        <path d="M2 12s3-7 10-7 10 7 10 7-3 7-10 7-10-7-10-7z"/>
                                        <circle cx="12" cy="12" r="3"/>
                                    </svg>
                                </button>

                            </div>

                            @error('password')
                                <span class="input-error">
                                    {{ $message }}
                                </span>
                            @enderror

                        </div>

                        {{-- Remember / Forgot Password --}}
                        <div class="login-options">

                            <label class="remember-label">

                                <input
                                    type="checkbox"
                                    name="remember"
                                >

                                <span>Remember me</span>

                            </label>

                            @if (Route::has('password.request'))
                                <a href="{{ route('password.request') }}">
                                    Forgot password?
                                </a>
                            @endif

                        </div>

                        {{-- Login Button --}}
                        <button
                            type="submit"
                            class="login-button"
                        >
                            <span>Log in</span>

                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                width="20"
                                height="20"
                                viewBox="0 0 24 24"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="2"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                            >
                                <line
                                    x1="5"
                                    y1="12"
                                    x2="19"
                                    y2="12"
                                />

                                <polyline points="12 5 19 12 12 19"/>
                            </svg>
                        </button>

                    </form>

                    {{-- Divider --}}
                    <div class="login-divider">
                        <span></span>
                        <strong>OR</strong>
                        <span></span>
                    </div>

                    {{-- Register --}}
                    @if (Route::has('register'))
                        <p class="register-text">

                            Don't have an account?

                            <a href="{{ route('register') }}">
                                Sign Up
                            </a>

                        </p>
                    @endif

                </div>

            </section>

            {{-- Right Illustration Panel --}}
            <section class="illustration-panel">

                <div class="illustration-content">

                    <div class="illustration-brand">
                        LIFE UNIVERSITY
                        <span></span>
                    </div>

                    <h2>
                        Empowering<br>
                        Your Future
                    </h2>

                    <p class="illustration-subtitle">
                        Learn&nbsp;&nbsp;·&nbsp;&nbsp;
                        Collaborate&nbsp;&nbsp;·&nbsp;&nbsp;
                        Achieve
                    </p>

                    <div class="illustration-image-wrapper">

                        <img
                            src="{{ asset('images/login.svg') }}"
                            alt="Students learning at Life University"
                            class="illustration-image"
                        >

                    </div>

                    <p class="illustration-quote">
                        “A Brighter Tomorrow Starts Here”
                    </p>

                    <div class="illustration-line"></div>

                </div>

            </section>

        </div>

    </div>

    <style>
        /* ========================================
           Global
        ======================================== */

        * {
            box-sizing: border-box;
        }

        html,
        body {
            margin: 0;
            min-height: 100%;
        }

        body {
            font-family: "Figtree", sans-serif;
            background: #f2f6fd;
            color: #172554;
        }

        /* ========================================
           Main Page
        ======================================== */

        .login-page {
            width: 100%;
            height: 100vh;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 18px;
            overflow: hidden;
            background:
                radial-gradient(
                    circle at top left,
                    rgba(219, 234, 254, 0.85),
                    transparent 40%
                ),
                #f2f6fd;
        }

        .login-container {
            width: 100%;
            max-width: 1180px;
            height: calc(100vh - 36px);
            max-height: 760px;
            min-height: 0;
            display: grid;
            grid-template-columns: 1fr 1fr;
            overflow: hidden;
            border-radius: 24px;
            background: #ffffff;
            box-shadow: 0 25px 70px rgba(30, 64, 175, 0.13);
        }

        /* ========================================
           Left Login Panel
        ======================================== */

        .login-panel {
            min-height: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 28px 55px;
            background: #ffffff;
        }

        .login-panel-content {
            width: 100%;
            max-width: 440px;
        }

        /* ========================================
           Logo
        ======================================== */

        .login-logo-wrapper {
            display: flex;
            justify-content: center;
            margin-bottom: 20px;
        }

        .login-logo {
            display: block;
            width: 190px;
            max-width: 100%;
            height: auto;
            object-fit: contain;
        }

        /* ========================================
           Heading
        ======================================== */

        .login-heading {
            margin-bottom: 23px;
            text-align: center;
        }

        .login-heading h1 {
            margin: 0;
            color: #172554;
            font-size: 34px;
            font-weight: 800;
            line-height: 1.15;
            letter-spacing: -0.8px;
        }

        .login-heading p {
            margin: 10px 0 0;
            color: #7183a1;
            font-size: 15px;
            line-height: 1.5;
        }

        /* ========================================
           Session Status
        ======================================== */

        .login-status {
            margin-bottom: 18px;
            padding: 11px 14px;
            border: 1px solid #bbf7d0;
            border-radius: 10px;
            background: #f0fdf4;
            color: #166534;
            font-size: 13px;
        }

        /* ========================================
           Form
        ======================================== */

        .login-form {
            width: 100%;
        }

        .form-group {
            margin-bottom: 18px;
        }

        .form-group label {
            display: block;
            margin-bottom: 7px;
            color: #172554;
            font-size: 14px;
            font-weight: 700;
        }

        .input-wrapper {
            position: relative;
            display: flex;
            align-items: center;
        }

        .input-wrapper > svg {
            position: absolute;
            left: 16px;
            color: #7183a1;
            pointer-events: none;
        }

        .input-wrapper input {
            width: 100%;
            height: 50px;
            padding: 0 52px;
            border: 1px solid #dce5f1;
            border-radius: 11px;
            outline: none;
            background: #ffffff;
            color: #172554;
            font-size: 14px;
            transition:
                border-color 0.2s ease,
                box-shadow 0.2s ease,
                background 0.2s ease;
        }

        .input-wrapper input::placeholder {
            color: #8a9ab4;
        }

        .input-wrapper input:focus {
            border-color: #3978ed;
            background: #ffffff;
            box-shadow: 0 0 0 4px rgba(59, 130, 246, 0.12);
        }

        .input-wrapper:focus-within > svg {
            color: #2563eb;
        }

        /* ========================================
           Password Toggle
        ======================================== */

        .password-toggle {
            position: absolute;
            right: 13px;
            display: flex;
            align-items: center;
            justify-content: center;
            width: 30px;
            height: 30px;
            padding: 0;
            border: none;
            background: transparent;
            color: #7183a1;
            cursor: pointer;
        }

        .password-toggle:hover {
            color: #2563eb;
        }

        .password-toggle:focus-visible {
            outline: 2px solid #2563eb;
            outline-offset: 2px;
            border-radius: 5px;
        }

        /* ========================================
           Validation Error
        ======================================== */

        .input-error {
            display: block;
            margin-top: 6px;
            color: #dc2626;
            font-size: 12px;
        }

        /* ========================================
           Remember and Forgot Password
        ======================================== */

        .login-options {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 15px;
            margin: 3px 0 20px;
            font-size: 13px;
        }

        .remember-label {
            display: flex;
            align-items: center;
            gap: 8px;
            color: #526582;
            cursor: pointer;
        }

        .remember-label input {
            width: 17px;
            height: 17px;
            accent-color: #2563eb;
            cursor: pointer;
        }

        .login-options a,
        .register-text a {
            color: #2563eb;
            font-weight: 700;
            text-decoration: none;
        }

        .login-options a:hover,
        .register-text a:hover {
            text-decoration: underline;
        }

        /* ========================================
           Login Button
        ======================================== */

        .login-button {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 16px;
            width: 100%;
            height: 52px;
            border: none;
            border-radius: 11px;
            background: linear-gradient(135deg, #2563eb, #397cf0);
            color: #ffffff;
            font-size: 15px;
            font-weight: 800;
            cursor: pointer;
            box-shadow: 0 8px 20px rgba(37, 99, 235, 0.2);
            transition:
                transform 0.2s ease,
                box-shadow 0.2s ease,
                background 0.2s ease;
        }

        .login-button:hover {
            background: linear-gradient(135deg, #1d4ed8, #2563eb);
            box-shadow: 0 11px 25px rgba(37, 99, 235, 0.28);
            transform: translateY(-1px);
        }

        .login-button:active {
            transform: translateY(0);
        }

        .login-button:focus-visible {
            outline: 3px solid rgba(37, 99, 235, 0.3);
            outline-offset: 3px;
        }

        /* ========================================
           Divider
        ======================================== */

        .login-divider {
            display: flex;
            align-items: center;
            gap: 15px;
            margin: 22px 0 18px;
        }

        .login-divider span {
            flex: 1;
            height: 1px;
            background: #e2e8f0;
        }

        .login-divider strong {
            color: #94a3b8;
            font-size: 12px;
            font-weight: 600;
        }

        /* ========================================
           Register Text
        ======================================== */

        .register-text {
            margin: 0;
            text-align: center;
            color: #8a9ab4;
            font-size: 14px;
        }

        /* ========================================
           Right Illustration Panel
        ======================================== */

        .illustration-panel {
            position: relative;
            min-height: 0;
            overflow: hidden;
            background:
                radial-gradient(
                    circle at 100% 0%,
                    rgba(147, 197, 253, 0.35),
                    transparent 35%
                ),
                linear-gradient(145deg, #145ddd, #3185f3);
            color: #ffffff;
        }

        .illustration-panel::before {
            content: "";
            position: absolute;
            top: -90px;
            right: -120px;
            width: 420px;
            height: 420px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.08);
        }

        .illustration-panel::after {
            content: "";
            position: absolute;
            bottom: -150px;
            left: -120px;
            width: 480px;
            height: 480px;
            border-radius: 50%;
            background: rgba(0, 44, 160, 0.18);
        }

        .illustration-content {
            position: relative;
            z-index: 1;
            display: flex;
            flex-direction: column;
            justify-content: center;
            height: 100%;
            min-height: 0;
            padding: 35px 50px;
            text-align: center;
        }

        .illustration-brand {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 14px;
            color: rgba(255, 255, 255, 0.8);
            font-size: 13px;
            font-weight: 600;
            letter-spacing: 3px;
        }

        .illustration-brand span {
            width: 42px;
            height: 2px;
            background: rgba(255, 255, 255, 0.65);
        }

        .illustration-content h2 {
            margin: 22px 0 10px;
            font-size: 40px;
            font-weight: 800;
            line-height: 1.08;
            letter-spacing: -0.8px;
        }

        .illustration-subtitle {
            margin: 0;
            color: rgba(255, 255, 255, 0.72);
            font-size: 15px;
        }

        .illustration-image-wrapper {
            display: flex;
            align-items: center;
            justify-content: center;
            flex: 1;
            min-height: 0;
            height: 245px;
            margin: 18px 0;
        }

        .illustration-image {
            display: block;
            width: 100%;
            max-width: 390px;
            max-height: 285px;
            object-fit: contain;
        }

        .illustration-quote {
            margin: 0;
            color: rgba(255, 255, 255, 0.8);
            font-size: 14px;
            font-style: italic;
        }

        .illustration-line {
            width: 45px;
            height: 2px;
            margin: 16px auto 0;
            background: rgba(255, 255, 255, 0.6);
        }

        /* ========================================
           Short Laptop Screens
        ======================================== */

        @media (max-height: 750px) and (min-width: 1001px) {

            .login-page {
                padding: 12px;
            }

            .login-container {
                height: calc(100vh - 24px);
            }

            .login-panel {
                padding: 20px 42px;
            }

            .login-logo-wrapper {
                margin-bottom: 12px;
            }

            .login-logo {
                width: 165px;
            }

            .login-heading {
                margin-bottom: 18px;
            }

            .login-heading h1 {
                font-size: 30px;
            }

            .login-heading p {
                margin-top: 7px;
                font-size: 14px;
            }

            .form-group {
                margin-bottom: 13px;
            }

            .form-group label {
                margin-bottom: 5px;
                font-size: 13px;
            }

            .input-wrapper input {
                height: 46px;
            }

            .login-options {
                margin-bottom: 15px;
            }

            .login-button {
                height: 48px;
            }

            .login-divider {
                margin: 17px 0 13px;
            }

            .illustration-content {
                padding: 25px 40px;
            }

            .illustration-content h2 {
                margin-top: 17px;
                font-size: 34px;
            }

            .illustration-image-wrapper {
                height: 190px;
                margin: 12px 0;
            }

            .illustration-image {
                max-height: 215px;
            }
        }

        /* ========================================
           Tablet
        ======================================== */

        @media (max-width: 1000px) {

            .login-page {
                height: auto;
                min-height: 100vh;
                padding: 20px;
                overflow: visible;
            }

            .login-container {
                height: auto;
                max-height: none;
                max-width: 600px;
                grid-template-columns: 1fr;
            }

            .illustration-panel {
                display: none;
            }

            .login-panel {
                padding: 45px;
            }

            .login-logo {
                width: 190px;
            }
        }

        /* ========================================
           Mobile
        ======================================== */

        @media (max-width: 600px) {

            .login-page {
                padding: 12px;
            }

            .login-container {
                border-radius: 18px;
            }

            .login-panel {
                padding: 32px 22px 36px;
            }

            .login-logo {
                width: 175px;
            }

            .login-heading h1 {
                font-size: 29px;
            }

            .login-heading p {
                font-size: 14px;
            }

            .login-options {
                align-items: flex-start;
                flex-wrap: wrap;
            }

            .login-button {
                height: 51px;
            }
        }
    </style>

    <script>
        document.addEventListener("DOMContentLoaded", function () {

            const passwordInput =
                document.getElementById("password");

            const passwordToggle =
                document.getElementById("passwordToggle");

            const eyeIcon =
                document.getElementById("eyeIcon");

            if (!passwordInput || !passwordToggle || !eyeIcon) {
                return;
            }

            passwordToggle.addEventListener("click", function () {

                const showingPassword =
                    passwordInput.type === "password";

                passwordInput.type = showingPassword
                    ? "text"
                    : "password";

                passwordToggle.setAttribute(
                    "aria-label",
                    showingPassword
                        ? "Hide password"
                        : "Show password"
                );

                eyeIcon.innerHTML = showingPassword
                    ? `
                        <path d="M3 3l18 18"/>
                        <path d="M10.6 10.6a2 2 0 0 0 2.8 2.8"/>
                        <path d="M9.9 4.2A10.8 10.8 0 0 1 12 4c7 0 10 8 10 8a18.5 18.5 0 0 1-3.1 4.4"/>
                        <path d="M6.6 6.6C3.7 8.5 2 12 2 12s3 8 10 8a10.8 10.8 0 0 0 4.1-.8"/>
                    `
                    : `
                        <path d="M2 12s3-7 10-7 10 7 10 7-3 7-10 7-10-7-10-7z"/>
                        <circle cx="12" cy="12" r="3"/>
                    `;

            });

        });
    </script>

</x-guest-layout>