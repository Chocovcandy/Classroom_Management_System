<x-guest-layout>

    <div class="reset-page">

        {{-- Left Side --}}
        <div class="reset-left">

            <div class="brand">
                <img
                    src="{{ asset('images/logo.png') }}"
                    alt="Life University Logo"
                >

                <div>
                    <h2>Life University</h2>
                    <p>Classroom Management System</p>
                </div>
            </div>

            <div class="welcome-content">
                <span class="welcome-badge">SECURE ACCOUNT</span>

                <h1>Create a new password.</h1>

                <p>
                    Set a strong password to protect your account and
                    continue using the Classroom Management System.
                </p>

                <div class="security-items">
                    <div class="security-item">
                        <span class="security-icon">✓</span>
                        <span>Use a strong and secure password</span>
                    </div>

                    <div class="security-item">
                        <span class="security-icon">✓</span>
                        <span>Keep your account protected</span>
                    </div>

                    <div class="security-item">
                        <span class="security-icon">✓</span>
                        <span>Access your classroom securely</span>
                    </div>
                </div>
            </div>

            <div class="left-footer">
                © {{ date('Y') }} Life University. All rights reserved.
            </div>

        </div>


        {{-- Right Side --}}
        <div class="reset-right">

            <div class="reset-card">

                <div class="mobile-brand">
                    <img
                        src="{{ asset('images/logo.png') }}"
                        alt="Life University Logo"
                    >
                </div>

                <div class="form-heading">
                    <span class="form-icon">🔐</span>

                    <h1>Reset Password</h1>

                    <p>
                        Enter your email and create a new password for your account.
                    </p>
                </div>

                <form
                    method="POST"
                    action="{{ route('password.store') }}"
                    class="reset-form"
                >
                    @csrf

                    {{-- Password Reset Token --}}
                    <input
                        type="hidden"
                        name="token"
                        value="{{ $request->route('token') }}"
                    >

                    {{-- Email Address --}}
                    <div class="form-group">
                        <label for="email">Email Address</label>

                        <div class="input-wrapper">
                            <span class="input-icon">✉</span>

                            <input
                                id="email"
                                type="email"
                                name="email"
                                value="{{ old('email', $request->email) }}"
                                required
                                autofocus
                                autocomplete="username"
                                placeholder="Enter your email address"
                                class="@error('email') input-error @enderror"
                            >
                        </div>

                        @error('email')
                            <p class="error-message">{{ $message }}</p>
                        @enderror
                    </div>


                    {{-- Password --}}
                    <div class="form-group">
                        <label for="password">New Password</label>

                        <div class="input-wrapper">
                            <span class="input-icon">🔒</span>

                            <input
                                id="password"
                                type="password"
                                name="password"
                                required
                                autocomplete="new-password"
                                placeholder="Enter your new password"
                                class="@error('password') input-error @enderror"
                            >

                            <button
                                type="button"
                                class="password-toggle"
                                onclick="togglePassword('password', this)"
                                aria-label="Show password"
                            >
                                Show
                            </button>
                        </div>

                        @error('password')
                            <p class="error-message">{{ $message }}</p>
                        @enderror
                    </div>


                    {{-- Confirm Password --}}
                    <div class="form-group">
                        <label for="password_confirmation">
                            Confirm New Password
                        </label>

                        <div class="input-wrapper">
                            <span class="input-icon">🔒</span>

                            <input
                                id="password_confirmation"
                                type="password"
                                name="password_confirmation"
                                required
                                autocomplete="new-password"
                                placeholder="Confirm your new password"
                            >

                            <button
                                type="button"
                                class="password-toggle"
                                onclick="togglePassword('password_confirmation', this)"
                                aria-label="Show password"
                            >
                                Show
                            </button>
                        </div>

                        @error('password_confirmation')
                            <p class="error-message">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>


                    <button type="submit" class="reset-button">
                        Reset Password
                        <span>→</span>
                    </button>

                </form>

                <div class="back-login">
                    <a href="{{ route('login') }}">
                        <span>←</span>
                        Back to Login
                    </a>
                </div>

            </div>

        </div>

    </div>


    <style>
        :root {
            --primary-blue: #2563eb;
            --primary-dark: #1d4ed8;
            --text-dark: #172033;
            --text-muted: #718096;
            --border-color: #e4eaf2;
            --background: #f5f8fc;
        }

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            background: var(--background);
            font-family: "Inter", "Segoe UI", Arial, sans-serif;
            color: var(--text-dark);
        }

        .reset-page {
            min-height: 100vh;
            display: flex;
            background: #f5f8fc;
        }

        /*
        |--------------------------------------------------------------------------
        | Left Side
        |--------------------------------------------------------------------------
        */

        .reset-left {
            position: relative;
            width: 48%;
            min-height: 100vh;
            padding: 48px 65px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            overflow: hidden;
            color: white;
            background:
                linear-gradient(
                    145deg,
                    rgba(29, 78, 216, 0.98),
                    rgba(37, 99, 235, 0.92)
                );
        }

        .reset-left::before {
            content: "";
            position: absolute;
            width: 420px;
            height: 420px;
            right: -180px;
            bottom: -180px;
            border: 65px solid rgba(255, 255, 255, 0.08);
            border-radius: 50%;
        }

        .reset-left::after {
            content: "";
            position: absolute;
            width: 250px;
            height: 250px;
            left: -130px;
            top: 35%;
            border: 45px solid rgba(255, 255, 255, 0.06);
            border-radius: 50%;
        }

        .brand {
            position: relative;
            z-index: 2;
            display: flex;
            align-items: center;
            gap: 14px;
        }

        .brand img {
            width: 62px;
            height: 62px;
            object-fit: contain;
            background: white;
            padding: 7px;
            border-radius: 14px;
        }

        .brand h2 {
            margin: 0;
            font-size: 22px;
            font-weight: 750;
            letter-spacing: -0.5px;
        }

        .brand p {
            margin: 5px 0 0;
            font-size: 12px;
            color: rgba(255, 255, 255, 0.78);
        }

        .welcome-content {
            position: relative;
            z-index: 2;
            max-width: 470px;
            margin-top: -30px;
        }

        .welcome-badge {
            display: inline-block;
            margin-bottom: 22px;
            padding: 8px 13px;
            border: 1px solid rgba(255, 255, 255, 0.25);
            border-radius: 30px;
            background: rgba(255, 255, 255, 0.1);
            font-size: 11px;
            font-weight: 700;
            letter-spacing: 1.2px;
        }

        .welcome-content h1 {
            max-width: 420px;
            margin: 0;
            font-size: clamp(36px, 4vw, 58px);
            line-height: 1.08;
            letter-spacing: -2px;
            font-weight: 800;
        }

        .welcome-content p {
            max-width: 410px;
            margin: 25px 0 0;
            color: rgba(255, 255, 255, 0.82);
            font-size: 15px;
            line-height: 1.8;
        }

        .security-items {
            display: flex;
            flex-direction: column;
            gap: 15px;
            margin-top: 32px;
        }

        .security-item {
            display: flex;
            align-items: center;
            gap: 12px;
            color: rgba(255, 255, 255, 0.92);
            font-size: 14px;
        }

        .security-icon {
            display: grid;
            place-items: center;
            width: 23px;
            height: 23px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.18);
            color: white;
            font-size: 12px;
            font-weight: 800;
        }

        .left-footer {
            position: relative;
            z-index: 2;
            color: rgba(255, 255, 255, 0.62);
            font-size: 12px;
        }

        /*
        |--------------------------------------------------------------------------
        | Right Side
        |--------------------------------------------------------------------------
        */

        .reset-right {
            width: 52%;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 40px 55px;
            background: #ffffff;
        }

        .reset-card {
            width: 100%;
            max-width: 465px;
        }

        .mobile-brand {
            display: none;
        }

        .form-heading {
            margin-bottom: 32px;
        }

        .form-icon {
            display: grid;
            place-items: center;
            width: 54px;
            height: 54px;
            margin-bottom: 22px;
            border-radius: 16px;
            background: #eaf1ff;
            font-size: 25px;
        }

        .form-heading h1 {
            margin: 0;
            color: #172033;
            font-size: 34px;
            font-weight: 800;
            letter-spacing: -1px;
        }

        .form-heading p {
            margin: 12px 0 0;
            color: var(--text-muted);
            font-size: 14px;
            line-height: 1.7;
        }

        .reset-form {
            display: flex;
            flex-direction: column;
            gap: 22px;
        }

        .form-group {
            display: flex;
            flex-direction: column;
            gap: 9px;
        }

        .form-group label {
            color: #263449;
            font-size: 13px;
            font-weight: 700;
        }

        .input-wrapper {
            position: relative;
            display: flex;
            align-items: center;
        }

        .input-icon {
            position: absolute;
            left: 16px;
            color: #91a0b5;
            font-size: 16px;
            pointer-events: none;
        }

        .input-wrapper input {
            width: 100%;
            height: 54px;
            padding: 0 72px 0 46px;
            border: 1px solid var(--border-color);
            border-radius: 12px;
            outline: none;
            background: #fbfcfe;
            color: #172033;
            font-size: 14px;
            transition: 0.2s ease;
        }

        .input-wrapper input::placeholder {
            color: #a3afbf;
        }

        .input-wrapper input:focus {
            border-color: var(--primary-blue);
            background: white;
            box-shadow: 0 0 0 4px rgba(37, 99, 235, 0.09);
        }

        .input-wrapper input.input-error {
            border-color: #ef4444;
        }

        .password-toggle {
            position: absolute;
            right: 13px;
            border: 0;
            background: transparent;
            color: var(--primary-blue);
            cursor: pointer;
            font-size: 12px;
            font-weight: 700;
        }

        .password-toggle:hover {
            color: var(--primary-dark);
        }

        .error-message {
            margin: 0;
            color: #dc2626;
            font-size: 12px;
        }

        .reset-button {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 15px;
            width: 100%;
            height: 56px;
            margin-top: 5px;
            border: none;
            border-radius: 12px;
            background: var(--primary-blue);
            color: white;
            cursor: pointer;
            font-size: 14px;
            font-weight: 750;
            box-shadow: 0 9px 20px rgba(37, 99, 235, 0.2);
            transition: 0.2s ease;
        }

        .reset-button span {
            font-size: 20px;
            transition: transform 0.2s ease;
        }

        .reset-button:hover {
            background: var(--primary-dark);
            transform: translateY(-1px);
        }

        .reset-button:hover span {
            transform: translateX(4px);
        }

        .back-login {
            margin-top: 28px;
            text-align: center;
        }

        .back-login a {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            color: #64748b;
            text-decoration: none;
            font-size: 13px;
            font-weight: 650;
            transition: 0.2s ease;
        }

        .back-login a:hover {
            color: var(--primary-blue);
        }

        .back-login span {
            font-size: 17px;
        }

        /*
        |--------------------------------------------------------------------------
        | Responsive
        |--------------------------------------------------------------------------
        */

        @media (max-width: 1050px) {
            .reset-left {
                padding: 40px;
            }

            .reset-right {
                padding: 35px;
            }

            .welcome-content h1 {
                font-size: 42px;
            }
        }

        @media (max-width: 800px) {
            .reset-page {
                display: block;
            }

            .reset-left {
                display: none;
            }

            .reset-right {
                width: 100%;
                min-height: 100vh;
                padding: 35px 22px;
                align-items: flex-start;
            }

            .reset-card {
                max-width: 500px;
                margin: 0 auto;
            }

            .mobile-brand {
                display: flex;
                justify-content: center;
                margin-bottom: 35px;
            }

            .mobile-brand img {
                width: 82px;
                height: 82px;
                object-fit: contain;
            }

            .form-heading {
                text-align: center;
            }

            .form-icon {
                margin-left: auto;
                margin-right: auto;
            }

            .form-heading h1 {
                font-size: 30px;
            }
        }

        @media (max-width: 420px) {
            .reset-right {
                padding: 28px 18px;
            }

            .form-heading h1 {
                font-size: 27px;
            }

            .input-wrapper input {
                height: 52px;
            }
        }
    </style>


    <script>
        function togglePassword(inputId, button) {
            const input = document.getElementById(inputId);

            if (input.type === "password") {
                input.type = "text";
                button.textContent = "Hide";
                button.setAttribute("aria-label", "Hide password");
            } else {
                input.type = "password";
                button.textContent = "Show";
                button.setAttribute("aria-label", "Show password");
            }
        }
    </script>

</x-guest-layout>