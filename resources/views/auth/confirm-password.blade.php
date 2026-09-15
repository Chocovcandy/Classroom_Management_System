<x-guest-layout>

    <div class="confirm-page">

        <div class="confirm-container">

            {{-- Left Confirmation Panel --}}
            <section class="confirm-panel">

                <div class="confirm-content">

                    {{-- Logo --}}
                    <div class="confirm-logo-wrapper">
                        <img
                            src="{{ asset('images/logo.png') }}"
                            alt="Life University Logo"
                            class="confirm-logo"
                        >
                    </div>

                    {{-- Heading --}}
                    <div class="confirm-heading">
                        <h1>Confirm Password</h1>

                        <p>
                            Please confirm your password to continue
                            to this secure area.
                        </p>
                    </div>

                    {{-- Form --}}
                    <form
                        method="POST"
                        action="{{ route('password.confirm') }}"
                        class="confirm-form"
                    >
                        @csrf

                        {{-- Password --}}
                        <div class="confirm-field">

                            <label for="password">
                                Password
                            </label>

                            <div class="confirm-input-wrapper">

                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 24 24"
                                    fill="none"
                                    stroke="currentColor"
                                    stroke-width="1.8"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    class="confirm-input-icon"
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
                                    autofocus
                                    autocomplete="current-password"
                                >

                                <button
                                    type="button"
                                    class="confirm-password-toggle"
                                    id="passwordToggle"
                                    aria-label="Show password"
                                >
                                    <svg
                                        id="passwordEyeIcon"
                                        xmlns="http://www.w3.org/2000/svg"
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
                                <span class="confirm-error">
                                    {{ $message }}
                                </span>
                            @enderror

                        </div>

                        {{-- Confirm Button --}}
                        <button
                            type="submit"
                            class="confirm-button"
                        >
                            <span>Confirm Password</span>

                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 24 24"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="2"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                            >
                                <path d="M12 3l7 4v5c0 4.5-3 7.5-7 9-4-1.5-7-4.5-7-9V7l7-4z"/>
                                <polyline points="9 12 11 14 15 10"/>
                            </svg>
                        </button>

                    </form>

                    {{-- Back to Login --}}
                    <div class="confirm-back">

                        <a href="{{ route('login') }}">

                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 24 24"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="2"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                            >
                                <polyline points="15 18 9 12 15 6"/>
                            </svg>

                            Back to Login

                        </a>

                    </div>

                </div>

            </section>

            {{-- Right Illustration Panel --}}
            <section class="confirm-illustration-panel">

                <div class="confirm-illustration-content">

                    <div class="confirm-university-name">
                        LIFE UNIVERSITY
                    </div>

                    <h2>
                        Your Security
                        <span>Comes First</span>
                    </h2>

                    <p class="confirm-description">
                        Keep your account safe by confirming
                        your password before continuing.
                    </p>

                    <div class="confirm-image-wrapper">

                        <img
                            src="{{ asset('images/login.svg') }}"
                            alt="Secure account illustration"
                            class="confirm-image"
                        >

                    </div>

                    <div class="confirm-quote">

                        <span class="confirm-quote-mark">“</span>

                        <p>
                            A secure account helps protect
                            your learning journey.
                        </p>

                    </div>

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

        .confirm-page {
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

        .confirm-container {
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
           Left Panel
        ======================================== */

        .confirm-panel {
            min-height: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 28px 55px;
            background: #ffffff;
        }

        .confirm-content {
            width: 100%;
            max-width: 440px;
        }

        /* ========================================
           Logo
        ======================================== */

        .confirm-logo-wrapper {
            display: flex;
            justify-content: center;
            margin-bottom: 20px;
        }

        .confirm-logo {
            display: block;
            width: 190px;
            max-width: 100%;
            height: auto;
            object-fit: contain;
        }

        /* ========================================
           Heading
        ======================================== */

        .confirm-heading {
            margin-bottom: 24px;
            text-align: center;
        }

        .confirm-heading h1 {
            margin: 0;
            color: #172554;
            font-size: 34px;
            font-weight: 800;
            line-height: 1.15;
            letter-spacing: -0.8px;
        }

        .confirm-heading p {
            max-width: 390px;
            margin: 10px auto 0;
            color: #7183a1;
            font-size: 15px;
            line-height: 1.55;
        }

        /* ========================================
           Form
        ======================================== */

        .confirm-form {
            width: 100%;
        }

        .confirm-field {
            margin-bottom: 20px;
        }

        .confirm-field label {
            display: block;
            margin-bottom: 7px;
            color: #172554;
            font-size: 14px;
            font-weight: 700;
        }

        .confirm-input-wrapper {
            position: relative;
            display: flex;
            align-items: center;
        }

        .confirm-input-icon {
            position: absolute;
            left: 16px;
            width: 20px;
            height: 20px;
            color: #7183a1;
            pointer-events: none;
        }

        .confirm-input-wrapper input {
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

        .confirm-input-wrapper input::placeholder {
            color: #8a9ab4;
        }

        .confirm-input-wrapper input:focus {
            border-color: #3978ed;
            background: #ffffff;
            box-shadow: 0 0 0 4px rgba(59, 130, 246, 0.12);
        }

        .confirm-input-wrapper:focus-within .confirm-input-icon {
            color: #2563eb;
        }

        /* ========================================
           Password Toggle
        ======================================== */

        .confirm-password-toggle {
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

        .confirm-password-toggle:hover {
            color: #2563eb;
        }

        .confirm-password-toggle:focus-visible {
            outline: 2px solid #2563eb;
            outline-offset: 2px;
            border-radius: 5px;
        }

        .confirm-password-toggle svg {
            width: 19px;
            height: 19px;
        }

        /* ========================================
           Error
        ======================================== */

        .confirm-error {
            display: block;
            margin-top: 6px;
            color: #dc2626;
            font-size: 12px;
        }

        /* ========================================
           Confirm Button
        ======================================== */

        .confirm-button {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 13px;
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

        .confirm-button svg {
            width: 20px;
            height: 20px;
        }

        .confirm-button:hover {
            background: linear-gradient(135deg, #1d4ed8, #2563eb);
            box-shadow: 0 11px 25px rgba(37, 99, 235, 0.28);
            transform: translateY(-1px);
        }

        .confirm-button:active {
            transform: translateY(0);
        }

        .confirm-button:focus-visible {
            outline: 3px solid rgba(37, 99, 235, 0.3);
            outline-offset: 3px;
        }

        /* ========================================
           Back Link
        ======================================== */

        .confirm-back {
            margin-top: 22px;
            text-align: center;
        }

        .confirm-back a {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            color: #2563eb;
            font-size: 14px;
            font-weight: 700;
            text-decoration: none;
        }

        .confirm-back a:hover {
            color: #1d4ed8;
            text-decoration: underline;
        }

        .confirm-back svg {
            width: 17px;
            height: 17px;
        }

        /* ========================================
           Right Illustration Panel
        ======================================== */

        .confirm-illustration-panel {
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

        .confirm-illustration-panel::before {
            content: "";
            position: absolute;
            top: -90px;
            right: -120px;
            width: 420px;
            height: 420px;
            border: 1px solid rgba(255, 255, 255, 0.16);
            border-radius: 50%;
        }

        .confirm-illustration-panel::after {
            content: "";
            position: absolute;
            bottom: -150px;
            left: -120px;
            width: 480px;
            height: 480px;
            border: 1px solid rgba(255, 255, 255, 0.12);
            border-radius: 50%;
        }

        .confirm-illustration-content {
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

        .confirm-university-name {
            color: rgba(255, 255, 255, 0.8);
            font-size: 13px;
            font-weight: 700;
            letter-spacing: 3px;
        }

        .confirm-illustration-content h2 {
            margin: 22px 0 10px;
            font-size: 40px;
            font-weight: 800;
            line-height: 1.08;
            letter-spacing: -0.8px;
        }

        .confirm-illustration-content h2 span {
            display: block;
            color: #bfdbfe;
        }

        .confirm-description {
            max-width: 350px;
            margin: 0 auto;
            color: rgba(255, 255, 255, 0.76);
            font-size: 15px;
            line-height: 1.6;
        }

        .confirm-image-wrapper {
            display: flex;
            align-items: center;
            justify-content: center;
            flex: 1;
            min-height: 0;
            height: 245px;
            margin: 18px 0;
        }

        .confirm-image {
            display: block;
            width: 100%;
            max-width: 390px;
            max-height: 285px;
            object-fit: contain;
        }

        /* ========================================
           Quote
        ======================================== */

        .confirm-quote {
            max-width: 370px;
            margin: 0 auto;
            padding: 15px 22px;
            border: 1px solid rgba(255, 255, 255, 0.18);
            border-radius: 14px;
            background: rgba(255, 255, 255, 0.09);
            backdrop-filter: blur(8px);
        }

        .confirm-quote-mark {
            display: block;
            height: 18px;
            color: #bfdbfe;
            font-size: 32px;
            font-weight: 800;
            line-height: 1;
        }

        .confirm-quote p {
            margin: 5px 0 0;
            color: rgba(255, 255, 255, 0.88);
            font-size: 13px;
            line-height: 1.55;
        }

        /* ========================================
           Short Laptop Screens
        ======================================== */

        @media (max-height: 750px) and (min-width: 1001px) {

            .confirm-page {
                padding: 12px;
            }

            .confirm-container {
                height: calc(100vh - 24px);
            }

            .confirm-panel {
                padding: 20px 42px;
            }

            .confirm-logo-wrapper {
                margin-bottom: 12px;
            }

            .confirm-logo {
                width: 165px;
            }

            .confirm-heading {
                margin-bottom: 18px;
            }

            .confirm-heading h1 {
                font-size: 30px;
            }

            .confirm-heading p {
                margin-top: 7px;
                font-size: 14px;
            }

            .confirm-field {
                margin-bottom: 14px;
            }

            .confirm-field label {
                margin-bottom: 5px;
                font-size: 13px;
            }

            .confirm-input-wrapper input {
                height: 46px;
            }

            .confirm-button {
                height: 48px;
            }

            .confirm-back {
                margin-top: 16px;
            }

            .confirm-illustration-content {
                padding: 25px 40px;
            }

            .confirm-illustration-content h2 {
                margin-top: 17px;
                font-size: 34px;
            }

            .confirm-description {
                font-size: 14px;
            }

            .confirm-image-wrapper {
                height: 190px;
                margin: 12px 0;
            }

            .confirm-image {
                max-height: 215px;
            }

            .confirm-quote {
                padding: 12px 18px;
            }

            .confirm-quote p {
                font-size: 12px;
            }
        }

        /* ========================================
           Tablet
        ======================================== */

        @media (max-width: 1000px) {

            .confirm-page {
                height: auto;
                min-height: 100vh;
                padding: 20px;
                overflow: visible;
            }

            .confirm-container {
                height: auto;
                max-height: none;
                max-width: 600px;
                grid-template-columns: 1fr;
            }

            .confirm-illustration-panel {
                display: none;
            }

            .confirm-panel {
                padding: 45px;
            }

            .confirm-logo {
                width: 190px;
            }
        }

        /* ========================================
           Mobile
        ======================================== */

        @media (max-width: 600px) {

            .confirm-page {
                padding: 12px;
            }

            .confirm-container {
                border-radius: 18px;
            }

            .confirm-panel {
                padding: 32px 22px 36px;
            }

            .confirm-logo {
                width: 175px;
            }

            .confirm-heading h1 {
                font-size: 29px;
            }

            .confirm-heading p {
                font-size: 14px;
            }

            .confirm-button {
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

            const passwordEyeIcon =
                document.getElementById("passwordEyeIcon");

            if (
                !passwordInput ||
                !passwordToggle ||
                !passwordEyeIcon
            ) {
                return;
            }

            passwordToggle.addEventListener("click", function () {

                const isPassword =
                    passwordInput.type === "password";

                passwordInput.type = isPassword
                    ? "text"
                    : "password";

                passwordToggle.setAttribute(
                    "aria-label",
                    isPassword
                        ? "Hide password"
                        : "Show password"
                );

                passwordEyeIcon.innerHTML = isPassword
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