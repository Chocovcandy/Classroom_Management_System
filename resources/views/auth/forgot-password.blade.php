<x-guest-layout>

    <div class="forgot-page">

        <div class="forgot-container">

            {{-- Left Form Panel --}}
            <div class="forgot-panel">

                <div class="forgot-content">

                    {{-- Logo --}}
                    <div class="forgot-logo-wrapper">
                        <img
                            src="{{ asset('images/logo.png') }}"
                            alt="Life University Logo"
                            class="forgot-logo"
                        >
                    </div>

                    {{-- Heading --}}
                    <div class="forgot-heading">
                        <h1>Forgot Password?</h1>

                        <p>
                            No worries! Enter your email address and
                            we will send you a link to reset your password.
                        </p>
                    </div>

                    {{-- Session Status --}}
                    <x-auth-session-status
                        class="forgot-status"
                        :status="session('status')"
                    />

                    {{-- Forgot Password Form --}}
                    <form
                        method="POST"
                        action="{{ route('password.email') }}"
                        class="forgot-form"
                    >
                        @csrf

                        {{-- Email Address --}}
                        <div class="forgot-field">

                            <label for="email">
                                Email Address
                            </label>

                            <div class="forgot-input-wrapper">

                                <svg
                                    class="forgot-input-icon"
                                    xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 24 24"
                                    fill="none"
                                    stroke="currentColor"
                                    stroke-width="1.8"
                                >
                                    <path
                                        d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2Z"
                                    />

                                    <path d="m22 6-10 7L2 6" />
                                </svg>

                                <input
                                    id="email"
                                    type="email"
                                    name="email"
                                    value="{{ old('email') }}"
                                    placeholder="Enter your email address"
                                    required
                                    autofocus
                                    autocomplete="email"
                                >

                            </div>

                            <x-input-error
                                :messages="$errors->get('email')"
                                class="forgot-error"
                            />

                        </div>

                        {{-- Submit Button --}}
                        <button
                            type="submit"
                            class="forgot-button"
                        >
                            <span>Email Password Reset Link</span>

                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 24 24"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="2"
                            >
                                <path d="M5 12h14" />
                                <path d="m12 5 7 7-7 7" />
                            </svg>
                        </button>

                    </form>

                    {{-- Back to Login --}}
                    <div class="forgot-back">

                        <a href="{{ route('login') }}">

                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 24 24"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="2"
                            >
                                <path d="m15 18-6-6 6-6" />
                            </svg>

                            Back to Login

                        </a>

                    </div>

                </div>

            </div>

            {{-- Right Illustration Panel --}}
            <div class="forgot-illustration-panel">

                <div class="forgot-illustration-content">

                    <div class="forgot-university-name">
                        LIFE UNIVERSITY
                    </div>

                    <h2>
                        Secure Your
                        <span>Account</span>
                    </h2>

                    <p>
                        Protect your account and get back to
                        your university journey with ease.
                    </p>

                    <div class="forgot-image-wrapper">
                        <img
                            src="{{ asset('images/login.svg') }}"
                            alt="Password recovery illustration"
                            class="forgot-image"
                        >
                    </div>

                    <div class="forgot-quote">
                        <span class="quote-mark">“</span>

                        <p>
                            Your account security is our priority.
                            We are here to help you every step of the way.
                        </p>
                    </div>

                </div>

            </div>

        </div>

    </div>

    <style>
        /* ========================================
           Forgot Password Page
        ======================================== */

        .forgot-page {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 30px;
            background: #f4f7fc;
            font-family: "Inter", "Segoe UI", sans-serif;
        }

        .forgot-container {
            width: 100%;
            max-width: 1180px;
            min-height: 680px;
            display: grid;
            grid-template-columns: 1fr 1fr;
            overflow: hidden;
            background: #ffffff;
            border-radius: 28px;
            box-shadow: 0 20px 60px rgba(30, 64, 175, 0.12);
        }

        /* ========================================
           Left Panel
        ======================================== */

        .forgot-panel {
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 55px 70px;
            background: #ffffff;
        }

        .forgot-content {
            width: 100%;
            max-width: 420px;
        }

.forgot-logo-wrapper {
    margin-bottom: 30px;
}

.forgot-logo {
    display: block;
    width: 190px;
    height: auto;
    object-fit: contain;
}

        .forgot-heading {
            margin-bottom: 30px;
        }

        .forgot-heading h1 {
            margin: 0 0 13px;
            color: #172554;
            font-size: 34px;
            font-weight: 750;
            line-height: 1.2;
            letter-spacing: -0.8px;
        }

        .forgot-heading p {
            max-width: 390px;
            margin: 0;
            color: #64748b;
            font-size: 15px;
            line-height: 1.8;
        }

        /* ========================================
           Session Status
        ======================================== */

        .forgot-status {
            margin-bottom: 20px;
            padding: 12px 15px;
            border: 1px solid #bbf7d0;
            border-radius: 10px;
            background: #f0fdf4;
            color: #166534;
            font-size: 13px;
        }

        /* ========================================
           Form
        ======================================== */

        .forgot-form {
            display: flex;
            flex-direction: column;
            gap: 24px;
        }

        .forgot-field {
            display: flex;
            flex-direction: column;
        }

        .forgot-field label {
            margin-bottom: 9px;
            color: #334155;
            font-size: 14px;
            font-weight: 650;
        }

        .forgot-input-wrapper {
            position: relative;
            display: flex;
            align-items: center;
        }

        .forgot-input-icon {
            position: absolute;
            left: 16px;
            width: 20px;
            height: 20px;
            color: #94a3b8;
            pointer-events: none;
        }

        .forgot-input-wrapper input {
            width: 100%;
            height: 54px;
            padding: 0 17px 0 49px;
            border: 1px solid #dbe3ef;
            border-radius: 12px;
            outline: none;
            background: #f8fafc;
            color: #172554;
            font-size: 14px;
            transition:
                border-color 0.2s ease,
                background 0.2s ease,
                box-shadow 0.2s ease;
        }

        .forgot-input-wrapper input::placeholder {
            color: #a0aec0;
        }

        .forgot-input-wrapper input:focus {
            border-color: #2563eb;
            background: #ffffff;
            box-shadow: 0 0 0 4px rgba(37, 99, 235, 0.1);
        }

        .forgot-input-wrapper:focus-within .forgot-input-icon {
            color: #2563eb;
        }

        .forgot-error {
            margin-top: 8px;
            color: #dc2626;
            font-size: 12px;
        }

        /* ========================================
           Submit Button
        ======================================== */

        .forgot-button {
            width: 100%;
            height: 54px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 12px;
            border: none;
            border-radius: 12px;
            background: #2563eb;
            color: #ffffff;
            cursor: pointer;
            font-size: 14px;
            font-weight: 700;
            box-shadow: 0 8px 20px rgba(37, 99, 235, 0.22);
            transition:
                background 0.2s ease,
                transform 0.2s ease,
                box-shadow 0.2s ease;
        }

        .forgot-button svg {
            width: 19px;
            height: 19px;
        }

        .forgot-button:hover {
            background: #1d4ed8;
            transform: translateY(-2px);
            box-shadow: 0 12px 25px rgba(37, 99, 235, 0.3);
        }

        .forgot-button:active {
            transform: translateY(0);
        }

        /* ========================================
           Back to Login
        ======================================== */

        .forgot-back {
            margin-top: 28px;
            text-align: center;
        }

        .forgot-back a {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            color: #2563eb;
            font-size: 14px;
            font-weight: 650;
            text-decoration: none;
            transition: color 0.2s ease;
        }

        .forgot-back a:hover {
            color: #1d4ed8;
            text-decoration: underline;
        }

        .forgot-back svg {
            width: 17px;
            height: 17px;
        }

        /* ========================================
           Right Illustration Panel
        ======================================== */

        .forgot-illustration-panel {
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            padding: 55px;
            background:
                radial-gradient(
                    circle at 80% 15%,
                    rgba(147, 197, 253, 0.3),
                    transparent 30%
                ),
                linear-gradient(
                    145deg,
                    #2563eb 0%,
                    #1d4ed8 48%,
                    #1e40af 100%
                );
        }

        .forgot-illustration-panel::before {
            content: "";
            position: absolute;
            width: 330px;
            height: 330px;
            top: -130px;
            right: -120px;
            border: 1px solid rgba(255, 255, 255, 0.18);
            border-radius: 50%;
        }

        .forgot-illustration-panel::after {
            content: "";
            position: absolute;
            width: 420px;
            height: 420px;
            bottom: -250px;
            left: -220px;
            border: 1px solid rgba(255, 255, 255, 0.15);
            border-radius: 50%;
        }

        .forgot-illustration-content {
            position: relative;
            z-index: 1;
            width: 100%;
            max-width: 440px;
            text-align: center;
            color: #ffffff;
        }

        .forgot-university-name {
            margin-bottom: 28px;
            color: rgba(255, 255, 255, 0.8);
            font-size: 13px;
            font-weight: 750;
            letter-spacing: 3px;
        }

        .forgot-illustration-content h2 {
            margin: 0;
            font-size: 42px;
            font-weight: 800;
            line-height: 1.18;
            letter-spacing: -1px;
        }

        .forgot-illustration-content h2 span {
            display: block;
            color: #bfdbfe;
        }

        .forgot-illustration-content > p {
            max-width: 350px;
            margin: 22px auto 0;
            color: rgba(255, 255, 255, 0.8);
            font-size: 15px;
            line-height: 1.8;
        }

        .forgot-image-wrapper {
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 245px;
            margin: 25px 0 20px;
        }

        .forgot-image {
            display: block;
            width: 100%;
            max-width: 330px;
            max-height: 270px;
            object-fit: contain;
        }

        .forgot-quote {
            position: relative;
            max-width: 360px;
            margin: 0 auto;
            padding: 20px 25px;
            border: 1px solid rgba(255, 255, 255, 0.18);
            border-radius: 15px;
            background: rgba(255, 255, 255, 0.09);
            backdrop-filter: blur(8px);
        }

        .quote-mark {
            display: block;
            height: 20px;
            color: #bfdbfe;
            font-size: 38px;
            font-weight: 800;
            line-height: 1;
        }

        .forgot-quote p {
            margin: 8px 0 0;
            color: rgba(255, 255, 255, 0.88);
            font-size: 13px;
            line-height: 1.7;
        }

        /* ========================================
           Responsive Design
        ======================================== */

        @media (max-width: 1000px) {
            .forgot-panel {
                padding: 45px;
            }

            .forgot-illustration-panel {
                padding: 40px;
            }

            .forgot-illustration-content h2 {
                font-size: 36px;
            }
        }

        @media (max-width: 780px) {
            .forgot-page {
                padding: 18px;
            }

            .forgot-container {
                max-width: 520px;
                min-height: auto;
                grid-template-columns: 1fr;
                border-radius: 22px;
            }

            .forgot-panel {
                padding: 40px 30px 45px;
            }

            .forgot-logo-wrapper {
                margin-bottom: 28px;
            }

            .forgot-heading h1 {
                font-size: 30px;
            }

            .forgot-illustration-panel {
                min-height: 430px;
                padding: 40px 25px;
            }

            .forgot-illustration-content h2 {
                font-size: 34px;
            }

            .forgot-image-wrapper {
                min-height: 170px;
                margin: 20px 0;
            }

            .forgot-image {
                max-width: 245px;
                max-height: 190px;
            }

            .forgot-quote {
                max-width: 330px;
            }
        }

        @media (max-width: 430px) {
            .forgot-page {
                padding: 10px;
            }

            .forgot-panel {
                padding: 32px 22px 38px;
            }

            .forgot-heading h1 {
                font-size: 28px;
            }

            .forgot-heading p {
                font-size: 14px;
            }

            .forgot-illustration-panel {
                min-height: 390px;
                padding: 35px 20px;
            }

            .forgot-illustration-content h2 {
                font-size: 30px;
            }

            .forgot-university-name {
                font-size: 11px;
                letter-spacing: 2px;
            }
        }
    </style>

</x-guest-layout>