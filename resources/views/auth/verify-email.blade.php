<x-guest-layout>

    <div class="verify-page">

        {{-- Left Side --}}
        <div class="verify-left">

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
                <span class="welcome-badge">ACCOUNT VERIFICATION</span>

                <h1>One more step to get started.</h1>

                <p>
                    Verify your email address to keep your account secure
                    and access all features of the Classroom Management System.
                </p>

                <div class="verification-points">
                    <div class="verification-point">
                        <span>✓</span>
                        <p>Confirm your email address</p>
                    </div>

                    <div class="verification-point">
                        <span>✓</span>
                        <p>Protect your account</p>
                    </div>

                    <div class="verification-point">
                        <span>✓</span>
                        <p>Access your classroom dashboard</p>
                    </div>
                </div>
            </div>

            <div class="left-footer">
                © {{ date('Y') }} Life University. All rights reserved.
            </div>

        </div>


        {{-- Right Side --}}
        <div class="verify-right">

            <div class="verify-card">

                {{-- Mobile Logo --}}
                <div class="mobile-brand">
                    <img
                        src="{{ asset('images/logo.png') }}"
                        alt="Life University Logo"
                    >
                </div>

                <div class="verify-icon">
                    ✉
                </div>

                <div class="verify-heading">
                    <h1>Verify Your Email</h1>

                    <p>
                        Thanks for signing up! Before getting started,
                        please verify your email address by clicking the
                        link we just emailed to you.
                    </p>
                </div>


                {{-- Success Message --}}
                @if (session('status') == 'verification-link-sent')

                    <div class="success-message">
                        <span class="success-icon">✓</span>

                        <p>
                            A new verification link has been sent to the
                            email address you provided during registration.
                        </p>
                    </div>

                @endif


                {{-- Resend Verification Email --}}
                <form
                    method="POST"
                    action="{{ route('verification.send') }}"
                    class="verification-form"
                >
                    @csrf

                    <button type="submit" class="resend-button">
                        Resend Verification Email
                        <span>→</span>
                    </button>
                </form>


                {{-- Logout --}}
                <form
                    method="POST"
                    action="{{ route('logout') }}"
                    class="logout-form"
                >
                    @csrf

                    <button type="submit" class="logout-button">
                        <span>↪</span>
                        Log Out
                    </button>
                </form>

                <div class="verify-note">
                    <span>💡</span>
                    <p>
                        If you cannot find the email, please check your
                        spam or junk folder.
                    </p>
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

        .verify-page {
            min-height: 100vh;
            display: flex;
            background: #f5f8fc;
        }

        /*
        |--------------------------------------------------------------------------
        | Left Side
        |--------------------------------------------------------------------------
        */

        .verify-left {
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

        .verify-left::before {
            content: "";
            position: absolute;
            width: 420px;
            height: 420px;
            right: -180px;
            bottom: -180px;
            border: 65px solid rgba(255, 255, 255, 0.08);
            border-radius: 50%;
        }

        .verify-left::after {
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
            padding: 7px;
            border-radius: 14px;
            background: white;
        }

        .brand h2 {
            margin: 0;
            font-size: 22px;
            font-weight: 800;
            letter-spacing: -0.5px;
        }

        .brand p {
            margin: 5px 0 0;
            color: rgba(255, 255, 255, 0.78);
            font-size: 12px;
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
            max-width: 430px;
            margin: 0;
            font-size: clamp(36px, 4vw, 58px);
            line-height: 1.08;
            letter-spacing: -2px;
            font-weight: 800;
        }

        .welcome-content > p {
            max-width: 420px;
            margin: 25px 0 0;
            color: rgba(255, 255, 255, 0.82);
            font-size: 15px;
            line-height: 1.8;
        }

        .verification-points {
            display: flex;
            flex-direction: column;
            gap: 15px;
            margin-top: 32px;
        }

        .verification-point {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .verification-point span {
            display: grid;
            place-items: center;
            width: 23px;
            height: 23px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.18);
            font-size: 12px;
            font-weight: 800;
        }

        .verification-point p {
            margin: 0;
            color: rgba(255, 255, 255, 0.92);
            font-size: 14px;
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

        .verify-right {
            width: 52%;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 40px 55px;
            background: #ffffff;
        }

        .verify-card {
            width: 100%;
            max-width: 465px;
        }

        .mobile-brand {
            display: none;
        }

        .verify-icon {
            display: grid;
            place-items: center;
            width: 64px;
            height: 64px;
            margin-bottom: 25px;
            border-radius: 18px;
            background: #eaf1ff;
            color: var(--primary-blue);
            font-size: 29px;
        }

        .verify-heading {
            margin-bottom: 28px;
        }

        .verify-heading h1 {
            margin: 0;
            color: #172033;
            font-size: 34px;
            font-weight: 800;
            letter-spacing: -1px;
        }

        .verify-heading p {
            margin: 14px 0 0;
            color: var(--text-muted);
            font-size: 14px;
            line-height: 1.8;
        }

        .success-message {
            display: flex;
            align-items: flex-start;
            gap: 12px;
            margin-bottom: 25px;
            padding: 15px 16px;
            border: 1px solid #bbf7d0;
            border-radius: 12px;
            background: #f0fdf4;
        }

        .success-icon {
            display: grid;
            place-items: center;
            flex: 0 0 auto;
            width: 22px;
            height: 22px;
            border-radius: 50%;
            background: #16a34a;
            color: white;
            font-size: 12px;
            font-weight: 800;
        }

        .success-message p {
            margin: 0;
            color: #166534;
            font-size: 13px;
            line-height: 1.6;
        }

        .verification-form {
            width: 100%;
        }

        .resend-button {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 15px;
            width: 100%;
            height: 56px;
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

        .resend-button span {
            font-size: 20px;
            transition: transform 0.2s ease;
        }

        .resend-button:hover {
            background: var(--primary-dark);
            transform: translateY(-1px);
        }

        .resend-button:hover span {
            transform: translateX(4px);
        }

        .logout-form {
            margin-top: 18px;
            text-align: center;
        }

        .logout-button {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            padding: 8px 12px;
            border: none;
            background: transparent;
            color: #64748b;
            cursor: pointer;
            font-size: 13px;
            font-weight: 650;
            transition: 0.2s ease;
        }

        .logout-button:hover {
            color: #dc2626;
        }

        .logout-button span {
            font-size: 17px;
        }

        .verify-note {
            display: flex;
            align-items: flex-start;
            gap: 10px;
            margin-top: 30px;
            padding: 15px 16px;
            border: 1px solid #e4eaf2;
            border-radius: 12px;
            background: #f8fafc;
        }

        .verify-note span {
            font-size: 16px;
        }

        .verify-note p {
            margin: 0;
            color: #718096;
            font-size: 12px;
            line-height: 1.6;
        }

        /*
        |--------------------------------------------------------------------------
        | Responsive
        |--------------------------------------------------------------------------
        */

        @media (max-width: 1050px) {
            .verify-left {
                padding: 40px;
            }

            .verify-right {
                padding: 35px;
            }

            .welcome-content h1 {
                font-size: 42px;
            }
        }

        @media (max-width: 800px) {
            .verify-page {
                display: block;
            }

            .verify-left {
                display: none;
            }

            .verify-right {
                width: 100%;
                min-height: 100vh;
                padding: 35px 22px;
                align-items: flex-start;
            }

            .verify-card {
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

            .verify-icon {
                margin-left: auto;
                margin-right: auto;
            }

            .verify-heading {
                text-align: center;
            }

            .verify-heading h1 {
                font-size: 30px;
            }
        }

        @media (max-width: 420px) {
            .verify-right {
                padding: 28px 18px;
            }

            .verify-heading h1 {
                font-size: 27px;
            }
        }
    </style>

</x-guest-layout>