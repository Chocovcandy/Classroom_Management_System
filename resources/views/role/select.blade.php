
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Select Role | Life University</title>

    <link rel="stylesheet"
          href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">

    <style>
        /* =====================================================
           ROOT
        ===================================================== */

        :root {
            --primary: #2563eb;
            --primary-dark: #1d4ed8;
            --primary-light: #eff6ff;
            --primary-soft: #dbeafe;

            --text: #172033;
            --muted: #64748b;
            --border: #e2e8f0;

            --background: #f5f7fb;
            --white: #ffffff;

            --radius: 22px;
        }

        /* =====================================================
           RESET
        ===================================================== */

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            min-height: 100vh;

            font-family:
                Inter,
                -apple-system,
                BlinkMacSystemFont,
                "Segoe UI",
                sans-serif;

            color: var(--text);
            background: var(--background);
        }

        button,
        input {
            font: inherit;
        }

        /* =====================================================
           PAGE
        ===================================================== */

        .role-page {
            min-height: 100vh;

            display: flex;
            align-items: center;
            justify-content: center;

            padding: 32px 20px;

            background:
                radial-gradient(
                    circle at 0% 0%,
                    #dbeafe 0,
                    transparent 32%
                ),
                radial-gradient(
                    circle at 100% 100%,
                    #e0e7ff 0,
                    transparent 28%
                ),
                var(--background);
        }

        /* =====================================================
           MAIN WRAPPER
        ===================================================== */

        .role-wrapper {
            width: 100%;
            max-width: 1080px;

            display: grid;
            grid-template-columns: 0.85fr 1.15fr;

            background: var(--white);

            border: 1px solid rgba(226, 232, 240, 0.8);

            border-radius: 28px;

            overflow: hidden;

            box-shadow:
                0 25px 70px rgba(15, 23, 42, 0.10);
        }

        /* =====================================================
           LEFT WELCOME PANEL
        ===================================================== */

        .welcome-panel {
            position: relative;

            display: flex;
            flex-direction: column;
            justify-content: space-between;

            padding: 48px 42px;

            color: white;

            background:
                radial-gradient(
                    circle at 100% 0%,
                    rgba(96, 165, 250, 0.35),
                    transparent 38%
                ),
                linear-gradient(
                    145deg,
                    #1d4ed8,
                    #2563eb 58%,
                    #1e40af
                );
        }

        .welcome-panel::after {
            content: "";

            position: absolute;

            width: 260px;
            height: 260px;

            right: -130px;
            bottom: -130px;

            border: 1px solid rgba(255,255,255,0.12);

            border-radius: 50%;

            pointer-events: none;
        }

        .welcome-content {
            position: relative;
            z-index: 1;
        }

        /* =====================================================
           UNIVERSITY BRAND
        ===================================================== */

        .university-brand {
            display: flex;
            align-items: center;
            gap: 12px;

            margin-bottom: 52px;
        }

        .brand-logo {
            width: 54px;
            height: 54px;

            display: flex;
            align-items: center;
            justify-content: center;

            background: white;

            border-radius: 14px;

            padding: 6px;
        }

        .brand-logo img {
            width: 100%;
            height: 100%;

            object-fit: contain;
        }

        .brand-text {
            display: flex;
            flex-direction: column;
            gap: 2px;
        }

        .brand-text strong {
            font-size: 15px;
            font-weight: 800;

            letter-spacing: 0.4px;
        }

        .brand-text span {
            font-size: 11px;

            color: rgba(255,255,255,0.75);

            letter-spacing: 1.4px;
        }

        /* =====================================================
           WELCOME TEXT
        ===================================================== */

        .welcome-label {
            display: inline-block;

            margin-bottom: 18px;

            font-size: 11px;
            font-weight: 800;

            letter-spacing: 2px;

            color: #bfdbfe;
        }

        .welcome-panel h1 {
            max-width: 340px;

            font-size: clamp(30px, 3vw, 42px);

            line-height: 1.18;

            font-weight: 800;

            letter-spacing: -1px;
        }

        .welcome-panel p {
            max-width: 330px;

            margin-top: 20px;

            color: rgba(255,255,255,0.78);

            font-size: 14px;

            line-height: 1.8;
        }

        /* =====================================================
           WELCOME ILLUSTRATION
        ===================================================== */

        .welcome-illustration {
            display: flex;

            align-items: center;
            justify-content: center;

            margin: 45px 0 35px;
        }

        .illustration-circle {
            width: 190px;
            height: 190px;

            display: flex;
            align-items: center;
            justify-content: center;

            background: rgba(255,255,255,0.10);

            border: 1px solid rgba(255,255,255,0.18);

            border-radius: 50%;
        }

        .illustration-circle i {
            font-size: 110px;

            color: white;
        }

        .welcome-footer {
            position: relative;
            z-index: 1;

            padding-top: 22px;

            border-top: 1px solid rgba(255,255,255,0.16);

            font-size: 12px;

            color: rgba(255,255,255,0.68);
        }

        /* =====================================================
           RIGHT FORM PANEL
        ===================================================== */

        .form-panel {
            padding: 52px 54px;

            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .form-header {
            margin-bottom: 34px;
        }

        .form-label {
            display: inline-block;

            margin-bottom: 12px;

            font-size: 11px;

            font-weight: 800;

            color: var(--primary);

            letter-spacing: 1.8px;
        }

        .form-header h2 {
            font-size: 30px;

            font-weight: 800;

            letter-spacing: -0.7px;

            color: var(--text);
        }

        .form-header p {
            max-width: 390px;

            margin-top: 10px;

            font-size: 14px;

            line-height: 1.7;

            color: var(--muted);
        }

        /* =====================================================
           ROLE OPTIONS
        ===================================================== */

        .role-options {
            display: flex;
            flex-direction: column;

            gap: 12px;
        }

        .role-option {
            display: block;

            cursor: pointer;
        }

        .role-option input {
            position: absolute;

            opacity: 0;

            pointer-events: none;
        }

        .role-option-content {
            display: flex;
            align-items: center;

            gap: 14px;

            padding: 16px;

            min-height: 82px;

            background: white;

            border: 1px solid var(--border);

            border-radius: 15px;

            transition:
                border-color 0.2s ease,
                background-color 0.2s ease,
                box-shadow 0.2s ease,
                transform 0.2s ease;
        }

        .role-option:hover .role-option-content {
            border-color: #93c5fd;

            background: #f8fbff;

            transform: translateY(-1px);
        }

        .role-option input:focus-visible
        + .role-option-content {
            outline: 3px solid rgba(37, 99, 235, 0.25);

            outline-offset: 2px;
        }

        .role-option input:checked
        + .role-option-content {
            border-color: var(--primary);

            background: var(--primary-light);

            box-shadow:
                0 0 0 3px rgba(37, 99, 235, 0.07);
        }

        /* =====================================================
           ROLE ICON
        ===================================================== */

        .role-icon {
            width: 48px;
            height: 48px;

            flex-shrink: 0;

            display: flex;
            align-items: center;
            justify-content: center;

            border-radius: 13px;

            background: #f1f5f9;

            color: #64748b;

            font-size: 24px;

            transition:
                background-color 0.2s ease,
                color 0.2s ease;
        }

        .role-option:hover .role-icon,
        .role-option input:checked
        + .role-option-content .role-icon {
            background: var(--primary-soft);

            color: var(--primary);
        }

        /* =====================================================
           ROLE TEXT
        ===================================================== */

        .role-info {
            flex: 1;
            min-width: 0;
        }

        .role-info h3 {
            font-size: 15px;

            font-weight: 750;

            color: var(--text);
        }

        .role-info p {
            margin-top: 5px;

            font-size: 12px;

            line-height: 1.5;

            color: var(--muted);
        }

        /* =====================================================
           CUSTOM RADIO
        ===================================================== */

        .role-radio {
            width: 21px;
            height: 21px;

            flex-shrink: 0;

            display: flex;
            align-items: center;
            justify-content: center;

            border: 2px solid #cbd5e1;

            border-radius: 50%;
        }

        .role-radio span {
            width: 9px;
            height: 9px;

            border-radius: 50%;

            background: transparent;

            transition: background-color 0.2s ease;
        }

        .role-option input:checked
        + .role-option-content .role-radio {
            border-color: var(--primary);
        }

        .role-option input:checked
        + .role-option-content .role-radio span {
            background: var(--primary);
        }

        /* =====================================================
           CONTINUE BUTTON
        ===================================================== */

        .continue-button {
            width: 100%;

            display: flex;
            align-items: center;
            justify-content: center;

            gap: 10px;

            margin-top: 26px;

            padding: 16px 20px;

            border: none;

            border-radius: 13px;

            background: var(--primary);

            color: white;

            font-size: 14px;

            font-weight: 700;

            cursor: pointer;

            transition:
                background-color 0.2s ease,
                transform 0.2s ease,
                box-shadow 0.2s ease;
        }

        .continue-button:hover {
            background: var(--primary-dark);

            transform: translateY(-1px);

            box-shadow:
                0 8px 20px rgba(37, 99, 235, 0.22);
        }

        .continue-button:focus-visible {
            outline: 3px solid rgba(37, 99, 235, 0.3);

            outline-offset: 3px;
        }

        .continue-button i {
            font-size: 20px;

            transition: transform 0.2s ease;
        }

        .continue-button:hover i {
            transform: translateX(4px);
        }

        /* =====================================================
           FORM FOOTER
        ===================================================== */

        .form-footer {
            display: flex;
            align-items: center;
            justify-content: center;

            gap: 7px;

            margin-top: 20px;

            font-size: 12px;

            color: #94a3b8;
        }

        .form-footer i {
            font-size: 15px;
        }

        /* =====================================================
           RESPONSIVE
        ===================================================== */

        @media (max-width: 850px) {

            .role-wrapper {
                grid-template-columns: 1fr;
                max-width: 560px;
            }

            .welcome-panel {
                padding: 35px;
            }

            .university-brand {
                margin-bottom: 32px;
            }

            .welcome-panel h1 {
                max-width: 500px;
                font-size: 32px;
            }

            .welcome-panel p {
                max-width: 500px;
            }

            .welcome-illustration {
                display: none;
            }

            .welcome-footer {
                margin-top: 35px;
            }

            .form-panel {
                padding: 35px;
            }
        }

        @media (max-width: 480px) {

            .role-page {
                padding: 15px;
            }

            .role-wrapper {
                border-radius: 22px;
            }

            .welcome-panel {
                padding: 28px 24px;
            }

            .welcome-panel h1 {
                font-size: 28px;
            }

            .form-panel {
                padding: 30px 22px;
            }

            .form-header h2 {
                font-size: 26px;
            }

            .role-option-content {
                padding: 13px;
            }

            .role-icon {
                width: 43px;
                height: 43px;

                font-size: 21px;
            }

            .role-info h3 {
                font-size: 14px;
            }

            .role-info p {
                font-size: 11px;
            }

            .role-radio {
                width: 19px;
                height: 19px;
            }
        }

        @media (prefers-reduced-motion: reduce) {

            *,
            *::before,
            *::after {
                transition-duration: 0.01ms !important;
            }
        }
    </style>
</head>

<body>

    <div class="role-page">

        <div class="role-wrapper">

            <!-- =================================================
                 LEFT WELCOME PANEL
            ================================================= -->

            <section class="welcome-panel">

                <div class="welcome-content">

                    <!-- University Brand -->

                    <div class="university-brand">

                        <div class="brand-logo">

                            <img
                                src="{{ asset('assets/img/Life_circle_blue_LG.png') }}"
                                alt="Life University Logo"
                            >

                        </div>

                        <div class="brand-text">

                            <strong>LIFE UNIVERSITY</strong>

                            <span>ACADEMIC MANAGEMENT SYSTEM</span>

                        </div>

                    </div>


                    <!-- Welcome Text -->

                    <span class="welcome-label">
                        WELCOME BACK
                    </span>

                    <h1>
                        One account.
                        <br>
                        Your university journey.
                    </h1>

                    <p>
                        Select your role to access the tools,
                        classes, and academic activities
                        designed for you.
                    </p>


                    <!-- Illustration -->

                    <div class="welcome-illustration">

                        <div class="illustration-circle">

                            <i class='bx bx-graduation'></i>

                        </div>

                    </div>

                </div>


                <!-- Footer -->

                <div class="welcome-footer">

                    <i class='bx bx-shield-check'></i>

                    Secure access to your academic workspace.

                </div>

            </section>


            <!-- =================================================
                 RIGHT ROLE FORM
            ================================================= -->

            <section class="form-panel">

                <!-- Header -->

                <div class="form-header">

                    <span class="form-label">
                        ACCOUNT SETUP
                    </span>

                    <h2>
                        Select Your Role
                    </h2>

                    <p>
                        Choose the role that best describes
                        your position in the university.
                    </p>

                </div>


                <!-- Role Form -->

                <form
                    method="POST"
                    action="{{ route('role.select.store') }}"
                >

                    @csrf


                    <div class="role-options">

                        @foreach($roles as $role)

                            <label class="role-option">

                                <input
                                    type="radio"
                                    name="role"
                                    value="{{ $role->role_name }}"
                                    required
                                >


                                <div class="role-option-content">

                                    <!-- Role Icon -->

                                    <div class="role-icon">

                                        @if($role->role_name === 'Admin')

                                            <i class='bx bx-shield-quarter'></i>

                                        @elseif($role->role_name === 'Dean')

                                            <i class='bx bx-buildings'></i>

                                        @elseif($role->role_name === 'HoD')

                                            <i class='bx bx-building-house'></i>

                                        @elseif($role->role_name === 'Professor')

                                            <i class='bx bx-book-reader'></i>

                                        @elseif($role->role_name === 'Student')

                                            <i class='bx bx-user'></i>

                                        @else

                                            <i class='bx bx-user-circle'></i>

                                        @endif

                                    </div>


                                    <!-- Role Information -->

                                    <div class="role-info">

                                        <h3>
                                            {{ $role->role_name }}
                                        </h3>

                                        <p>

                                            @if($role->role_name === 'Admin')

                                                Manage university-wide system settings and users.

                                            @elseif($role->role_name === 'Dean')

                                                Manage and oversee your department's academic activities.

                                            @elseif($role->role_name === 'HoD')

                                                Manage your department's classes and academic staff.

                                            @elseif($role->role_name === 'Professor')

                                                Manage your classes and support your students.

                                            @elseif($role->role_name === 'Student')

                                                Access your classes, learning materials, and activities.

                                            @else

                                                Access the system based on your assigned responsibilities.

                                            @endif

                                        </p>

                                    </div>


                                    <!-- Radio Indicator -->

                                    <div class="role-radio">

                                        <span></span>

                                    </div>

                                </div>

                            </label>

                        @endforeach

                    </div>


                    <!-- Continue -->

                    <button
                        type="submit"
                        class="continue-button"
                    >

                        <span>
                            Continue
                        </span>

                        <i class='bx bx-right-arrow-alt'></i>

                    </button>

                </form>


                <!-- Footer -->

                <div class="form-footer">

                    <i class='bx bx-lock-alt'></i>

                    <span>
                        Select one role to continue securely.
                    </span>

                </div>

            </section>

        </div>

    </div>

</body>

</html>