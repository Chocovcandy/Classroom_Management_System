<x-guest-layout>

    <div class="register-page">

        <div class="register-container">

            {{-- Left Register Panel --}}
            <section class="register-panel">

                <div class="register-content">

                    {{-- Logo --}}
                    <div class="register-logo-wrapper">
                        <img
                            src="{{ asset('images/logo.png') }}"
                            alt="Life University Logo"
                            class="register-logo"
                        >
                    </div>

                    {{-- Heading --}}
                    <div class="register-heading">
                        <h1>Create Account</h1>

                        <p>
                            Join Life University and start your journey
                        </p>
                    </div>

                    {{-- Register Form --}}
                    <form
                        method="POST"
                        action="{{ route('register') }}"
                        class="register-form"
                    >
                        @csrf

                        {{-- Name --}}
                        <div class="register-field">

                            <label for="name">
                                Full Name
                            </label>

                            <div class="register-input-wrapper">

                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 24 24"
                                    fill="none"
                                    stroke="currentColor"
                                    stroke-width="1.8"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    class="register-input-icon"
                                >
                                    <path d="M20 21a8 8 0 0 0-16 0"/>

                                    <circle
                                        cx="12"
                                        cy="7"
                                        r="4"
                                    />
                                </svg>

                                <input
                                    id="name"
                                    type="text"
                                    name="name"
                                    value="{{ old('name') }}"
                                    placeholder="Enter your full name"
                                    required
                                    autofocus
                                    autocomplete="name"
                                >

                            </div>

                            @error('name')
                                <span class="register-error">
                                    {{ $message }}
                                </span>
                            @enderror

                        </div>

                        {{-- Email --}}
{{-- Email --}}
<div class="register-field">

    <label for="email">
        University Email Address
    </label>

    <div class="register-input-wrapper">

        <svg
            xmlns="http://www.w3.org/2000/svg"
            viewBox="0 0 24 24"
            fill="none"
            stroke="currentColor"
            stroke-width="1.8"
            stroke-linecap="round"
            stroke-linejoin="round"
            class="register-input-icon"
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
            placeholder="Enter your university email"
            required
            autocomplete="username"
        >

    </div>

    <button
        type="button"
        id="universityEmailSuggestion"
        class="university-email-suggestion"
        hidden
    ></button>

    <p class="register-input-hint">
        Only emails ending with @lifeun.edu.kh are allowed.
    </p>

    @error('email')
        <span class="register-error">
            {{ $message }}
        </span>
    @enderror

</div>

                        {{-- Password --}}
                        <div class="register-field">

                            <label for="password">
                                Password
                            </label>

                            <div class="register-input-wrapper">

                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 24 24"
                                    fill="none"
                                    stroke="currentColor"
                                    stroke-width="1.8"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    class="register-input-icon"
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
                                    placeholder="Create a password"
                                    required
                                    autocomplete="new-password"
                                >

                                <button
                                    type="button"
                                    class="register-password-toggle"
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
                                <span class="register-error">
                                    {{ $message }}
                                </span>
                            @enderror

                        </div>

                        {{-- Confirm Password --}}
                        <div class="register-field">

                            <label for="password_confirmation">
                                Confirm Password
                            </label>

                            <div class="register-input-wrapper">

                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 24 24"
                                    fill="none"
                                    stroke="currentColor"
                                    stroke-width="1.8"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    class="register-input-icon"
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
                                    id="password_confirmation"
                                    type="password"
                                    name="password_confirmation"
                                    placeholder="Confirm your password"
                                    required
                                    autocomplete="new-password"
                                >

                                <button
                                    type="button"
                                    class="register-password-toggle"
                                    id="confirmPasswordToggle"
                                    aria-label="Show confirm password"
                                >
                                    <svg
                                        id="confirmPasswordEyeIcon"
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

                            @error('password_confirmation')
                                <span class="register-error">
                                    {{ $message }}
                                </span>
                            @enderror

                        </div>

                        {{-- Register Button --}}
                        <button
                            type="submit"
                            class="register-button"
                        >
                            <span>Create Account</span>

                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 24 24"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="2"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                            >
                                <line x1="5" y1="12" x2="19" y2="12"/>
                                <polyline points="12 5 19 12 12 19"/>
                            </svg>
                        </button>

                    </form>

                    {{-- Login Link --}}
                    <p class="register-login-text">

                        Already have an account?

                        <a href="{{ route('login') }}">
                            Log in
                        </a>

                    </p>

                </div>

            </section>

            {{-- Right Illustration Panel --}}
            <section class="register-illustration-panel">

                <div class="register-illustration-content">

                    <div class="register-university-name">
                        LIFE UNIVERSITY
                    </div>

                    <h2>
                        Begin Your
                        <span>Bright Future</span>
                    </h2>

                    <p class="register-description">
                        Create your account and take the first step
                        toward achieving your dreams.
                    </p>

                    <div class="register-image-wrapper">

                        <img
                            src="{{ asset('images/login.svg') }}"
                            alt="Students learning at Life University"
                            class="register-image"
                        >

                    </div>

                    <div class="register-quote">

                        <span class="register-quote-mark">“</span>

                        <p>
                            Your future starts with one step.
                            Make it count.
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

        .register-page {
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

        .register-container {
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

        .register-panel {
            min-height: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 24px 55px;
            background: #ffffff;
        }

        .register-content {
            width: 100%;
            max-width: 440px;
        }

        /* ========================================
           Logo
        ======================================== */

/* ========================================
   Logo
======================================== */

.register-logo-wrapper {
    display: flex;
    justify-content: center;
    align-items: center;
    margin-bottom: 20px;
}

.register-logo-wrapper img {
    width: 350px;
    height: auto;
    display: block;
    object-fit: contain;
}
.register-input-hint {
    display: block;
    margin-top: 7px;
    color: #6b7280;
    font-size: 13px;
    font-weight: 500;
    line-height: 1.5;
}

.register-input-wrapper {
    position: relative;
    display: flex;
    align-items: center;
}

.register-input-wrapper input {
    width: 100%;
    padding-right: 125px;
}

.email-domain {
    position: absolute;
    right: 16px;
    color: #6b7280;
    font-size: 14px;
    font-weight: 600;
    pointer-events: none;
    white-space: nowrap;
}
.email-autocomplete-wrapper {
    position: relative;
    overflow: hidden;
}

/* Keep the ghost text aligned with the input */
.email-ghost-text {
    position: absolute;
    top: 50%;
    left: 52px;
    transform: translateY(-50%);
    z-index: 1;

    display: flex;
    align-items: center;

    color: #9ca3af;
    font-size: 16px;
    font-weight: 400;
    line-height: 1;
    white-space: pre;

    pointer-events: none;
}

/* The actual input stays above the ghost text */
.email-autocomplete-wrapper input {
    position: relative;
    z-index: 2;

    background: transparent;
}

/* Hide the suggestion when the user has not typed anything */
.email-domain-suggestion {
    color: #9ca3af;
}

/* Prevent the input background from hiding the ghost text */
.email-autocomplete-wrapper input:focus {
    background: transparent;
}
/* ========================================
   University Email Domain
======================================== */

.university-email-wrapper {
    position: relative;
    display: flex;
    align-items: center;
}

.university-email-wrapper input {
    width: 100%;
    padding-right: 145px !important;
}

.university-email-domain {
    position: absolute;
    top: 50%;
    right: 16px;
    transform: translateY(-50%);

    color: #8a9ab4;
    font-size: 13px;
    font-weight: 600;
    line-height: 1;

    white-space: nowrap;
    pointer-events: none;
}

@media (max-width: 600px) {
    .university-email-wrapper input {
        padding-right: 125px !important;
    }

    .university-email-domain {
        right: 13px;
        font-size: 11px;
    }
}
@media (max-width: 600px) {
    .email-ghost-text {
        left: 48px;
        font-size: 14px;
    }
}
@media (max-width: 480px) {
    .register-input-wrapper input {
        padding-right: 110px;
    }

    .email-domain {
        right: 12px;
        font-size: 12px;
    }
}


/* ========================================
   University Email Suggestion
======================================== */

.university-email-suggestion {
    display: block;
    width: fit-content;
    max-width: 100%;
    margin-top: 8px;
    padding: 8px 12px;

    border: 1px solid #bfdbfe;
    border-radius: 8px;

    background: #eff6ff;
    color: #2563eb;

    font-family: inherit;
    font-size: 13px;
    font-weight: 700;
    line-height: 1.4;
    text-align: left;

    cursor: pointer;
    transition:
        background 0.2s ease,
        border-color 0.2s ease,
        transform 0.2s ease;
}

.university-email-suggestion:hover {
    background: #dbeafe;
    border-color: #93c5fd;
    transform: translateY(-1px);
}

.university-email-suggestion:focus-visible {
    outline: 3px solid rgba(37, 99, 235, 0.25);
    outline-offset: 2px;
}

.university-email-suggestion[hidden] {
    display: none;
}

.register-input-hint {
    display: block;
    margin: 7px 0 0;

    color: #7183a1;
    font-size: 12px;
    font-weight: 500;
    line-height: 1.5;
}

        /* ========================================
           Heading
        ======================================== */

        .register-heading {
            margin-bottom: 20px;
            text-align: center;
        }

        .register-heading h1 {
            margin: 0;
            color: #172554;
            font-size: 34px;
            font-weight: 800;
            line-height: 1.15;
            letter-spacing: -0.8px;
        }

        .register-heading p {
            margin: 8px 0 0;
            color: #7183a1;
            font-size: 15px;
            line-height: 1.5;
        }

        /* ========================================
           Form
        ======================================== */

        .register-form {
            width: 100%;
        }

        .register-field {
            margin-bottom: 13px;
        }

        .register-field label {
            display: block;
            margin-bottom: 6px;
            color: #172554;
            font-size: 13px;
            font-weight: 700;
        }

        .register-input-wrapper {
            position: relative;
            display: flex;
            align-items: center;
        }

        .register-input-icon {
            position: absolute;
            left: 16px;
            width: 19px;
            height: 19px;
            color: #7183a1;
            pointer-events: none;
        }

        .register-input-wrapper input {
            width: 100%;
            height: 47px;
            padding: 0 50px;
            border: 1px solid #dce5f1;
            border-radius: 11px;
            outline: none;
            background: #ffffff;
            color: #172554;
            font-size: 13px;
            transition:
                border-color 0.2s ease,
                box-shadow 0.2s ease,
                background 0.2s ease;
        }

        .register-input-wrapper input::placeholder {
            color: #8a9ab4;
        }

        .register-input-wrapper input:focus {
            border-color: #3978ed;
            background: #ffffff;
            box-shadow: 0 0 0 4px rgba(59, 130, 246, 0.12);
        }

        .register-input-wrapper:focus-within .register-input-icon {
            color: #2563eb;
        }

        /* ========================================
           Password Toggle
        ======================================== */

        .register-password-toggle {
            position: absolute;
            right: 12px;
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

        .register-password-toggle:hover {
            color: #2563eb;
        }

        .register-password-toggle:focus-visible {
            outline: 2px solid #2563eb;
            outline-offset: 2px;
            border-radius: 5px;
        }

        .register-password-toggle svg {
            width: 19px;
            height: 19px;
        }

        /* ========================================
           Errors
        ======================================== */

        .register-error {
            display: block;
            margin-top: 5px;
            color: #dc2626;
            font-size: 12px;
        }

        /* ========================================
           Register Button
        ======================================== */

        .register-button {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 14px;
            width: 100%;
            height: 49px;
            margin-top: 17px;
            border: none;
            border-radius: 11px;
            background: linear-gradient(135deg, #2563eb, #397cf0);
            color: #ffffff;
            font-size: 14px;
            font-weight: 800;
            cursor: pointer;
            box-shadow: 0 8px 20px rgba(37, 99, 235, 0.2);
            transition:
                transform 0.2s ease,
                box-shadow 0.2s ease,
                background 0.2s ease;
        }

        .register-button svg {
            width: 19px;
            height: 19px;
        }

        .register-button:hover {
            background: linear-gradient(135deg, #1d4ed8, #2563eb);
            box-shadow: 0 11px 25px rgba(37, 99, 235, 0.28);
            transform: translateY(-1px);
        }

        .register-button:active {
            transform: translateY(0);
        }

        .register-button:focus-visible {
            outline: 3px solid rgba(37, 99, 235, 0.3);
            outline-offset: 3px;
        }

        /* ========================================
           Login Link
        ======================================== */

        .register-login-text {
            margin: 18px 0 0;
            text-align: center;
            color: #8a9ab4;
            font-size: 13px;
        }

        .register-login-text a {
            color: #2563eb;
            font-weight: 700;
            text-decoration: none;
        }

        .register-login-text a:hover {
            text-decoration: underline;
        }

        /* ========================================
           Right Illustration Panel
        ======================================== */

        .register-illustration-panel {
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

        .register-illustration-panel::before {
            content: "";
            position: absolute;
            top: -90px;
            right: -120px;
            width: 420px;
            height: 420px;
            border: 1px solid rgba(255, 255, 255, 0.16);
            border-radius: 50%;
        }

        .register-illustration-panel::after {
            content: "";
            position: absolute;
            bottom: -150px;
            left: -120px;
            width: 480px;
            height: 480px;
            border: 1px solid rgba(255, 255, 255, 0.12);
            border-radius: 50%;
        }

        .register-illustration-content {
            position: relative;
            z-index: 1;
            display: flex;
            flex-direction: column;
            justify-content: center;
            height: 100%;
            min-height: 0;
            padding: 30px 50px;
            text-align: center;
        }

        .register-university-name {
            color: rgba(255, 255, 255, 0.8);
            font-size: 13px;
            font-weight: 700;
            letter-spacing: 3px;
        }

        .register-illustration-content h2 {
            margin: 20px 0 10px;
            font-size: 40px;
            font-weight: 800;
            line-height: 1.08;
            letter-spacing: -0.8px;
        }

        .register-illustration-content h2 span {
            display: block;
            color: #bfdbfe;
        }

        .register-description {
            max-width: 350px;
            margin: 0 auto;
            color: rgba(255, 255, 255, 0.76);
            font-size: 14px;
            line-height: 1.6;
        }

        .register-image-wrapper {
            display: flex;
            align-items: center;
            justify-content: center;
            flex: 1;
            min-height: 0;
            height: 235px;
            margin: 15px 0;
        }

        .register-image {
            display: block;
            width: 100%;
            max-width: 380px;
            max-height: 275px;
            object-fit: contain;
        }

        /* ========================================
           Quote
        ======================================== */

        .register-quote {
            max-width: 370px;
            margin: 0 auto;
            padding: 14px 22px;
            border: 1px solid rgba(255, 255, 255, 0.18);
            border-radius: 14px;
            background: rgba(255, 255, 255, 0.09);
            backdrop-filter: blur(8px);
        }

        .register-quote-mark {
            display: block;
            height: 18px;
            color: #bfdbfe;
            font-size: 32px;
            font-weight: 800;
            line-height: 1;
        }

        .register-quote p {
            margin: 5px 0 0;
            color: rgba(255, 255, 255, 0.88);
            font-size: 13px;
            line-height: 1.55;
        }

        /* ========================================
           Short Laptop Screens
        ======================================== */

        @media (max-height: 750px) and (min-width: 1001px) {

            .register-page {
                padding: 12px;
            }

            .register-container {
                height: calc(100vh - 24px);
            }

            .register-panel {
                padding: 18px 42px;
            }

            .register-logo-wrapper {
                margin-bottom: 9px;
            }

            .register-logo {
                width: 165px;
            }

            .register-heading {
                margin-bottom: 15px;
            }

            .register-heading h1 {
                font-size: 29px;
            }

            .register-heading p {
                margin-top: 6px;
                font-size: 13px;
            }

            .register-field {
                margin-bottom: 9px;
            }

            .register-field label {
                margin-bottom: 4px;
                font-size: 12px;
            }

            .register-input-wrapper input {
                height: 40px;
                font-size: 12px;
            }

            .register-input-icon {
                width: 17px;
                height: 17px;
            }

            .register-button {
                height: 44px;
                margin-top: 12px;
            }

            .register-login-text {
                margin-top: 12px;
                font-size: 12px;
            }

            .register-illustration-content {
                padding: 25px 40px;
            }

            .register-illustration-content h2 {
                margin-top: 17px;
                font-size: 34px;
            }

            .register-description {
                font-size: 13px;
            }

            .register-image-wrapper {
                height: 185px;
                margin: 12px 0;
            }

            .register-image {
                max-height: 210px;
            }

            .register-quote {
                padding: 12px 18px;
            }

            .register-quote p {
                font-size: 12px;
            }
        }

        /* ========================================
           Tablet
        ======================================== */

        @media (max-width: 1000px) {

            .register-page {
                height: auto;
                min-height: 100vh;
                padding: 20px;
                overflow: visible;
            }

            .register-container {
                height: auto;
                max-height: none;
                max-width: 600px;
                grid-template-columns: 1fr;
            }

            .register-illustration-panel {
                display: none;
            }

            .register-panel {
                padding: 45px;
            }

            .register-logo {
                width: 190px;
            }

            .register-field {
                margin-bottom: 16px;
            }

            .register-input-wrapper input {
                height: 50px;
            }

            .register-button {
                height: 52px;
            }
        }

        /* ========================================
           Mobile
        ======================================== */

        @media (max-width: 600px) {

            .register-page {
                padding: 12px;
            }

            .register-container {
                border-radius: 18px;
            }

            .register-panel {
                padding: 32px 22px 36px;
            }

            .register-logo {
                width: 175px;
            }

            .register-heading h1 {
                font-size: 29px;
            }

            .register-heading p {
                font-size: 14px;
            }

            .register-field {
                margin-bottom: 15px;
            }

            .register-input-wrapper input {
                height: 49px;
                font-size: 13px;
            }

            .register-button {
                height: 51px;
            }
        }
    </style>

<script>
    document.addEventListener("DOMContentLoaded", function () {

        /*
        |--------------------------------------------------------------------------
        | Password Toggle
        |--------------------------------------------------------------------------
        */

        function setupPasswordToggle(
            inputId,
            toggleId,
            iconId
        ) {
            const input = document.getElementById(inputId);
            const toggle = document.getElementById(toggleId);
            const icon = document.getElementById(iconId);

            if (!input || !toggle || !icon) {
                return;
            }

            toggle.addEventListener("click", function () {

                const isPassword = input.type === "password";

                input.type = isPassword
                    ? "text"
                    : "password";

                toggle.setAttribute(
                    "aria-label",
                    isPassword
                        ? "Hide password"
                        : "Show password"
                );

                icon.innerHTML = isPassword
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
        }

        setupPasswordToggle(
            "password",
            "passwordToggle",
            "passwordEyeIcon"
        );

        setupPasswordToggle(
            "password_confirmation",
            "confirmPasswordToggle",
            "confirmPasswordEyeIcon"
        );


        /*
        |--------------------------------------------------------------------------
        | University Email Suggestion
        |--------------------------------------------------------------------------
        */

        const emailInput = document.getElementById("email");
        const emailSuggestion = document.getElementById(
            "universityEmailSuggestion"
        );

        const universityDomain = "@life.edu.kh";

        if (!emailInput || !emailSuggestion) {
            return;
        }

        function updateEmailSuggestion() {

            const value = emailInput.value.trim();

            /*
             * Do not change the user's input.
             * Only display a suggestion when:
             * - The field is not empty
             * - The user has not typed @
             */
            if (
                value.length > 0 &&
                !value.includes("@")
            ) {
                emailSuggestion.textContent =
                    "Use " + value + universityDomain;

                emailSuggestion.hidden = false;
            } else {
                emailSuggestion.textContent = "";
                emailSuggestion.hidden = true;
            }
        }

        emailInput.addEventListener(
            "input",
            updateEmailSuggestion
        );

        emailInput.addEventListener(
            "blur",
            updateEmailSuggestion
        );

        emailSuggestion.addEventListener(
            "click",
            function () {

                const username = emailInput.value.trim();

                if (!username || username.includes("@")) {
                    return;
                }

                emailInput.value =
                    username + universityDomain;

                emailSuggestion.hidden = true;

                emailInput.focus();
            }
        );

        updateEmailSuggestion();

    });
</script>




</x-guest-layout>