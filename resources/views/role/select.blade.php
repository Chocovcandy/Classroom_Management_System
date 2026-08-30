
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Select Role</title>

    <link rel="stylesheet" href="{{ asset('assets/css/role_selection.css') }}">

    <link
    rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">

</head>

<style>

/* =========================================================
   ROLE SELECTION PAGE
   ========================================================= */

:root {
    --primary: #2563eb;
    --primary-dark: #1d4ed8;

    --text-primary: #172033;
    --text-secondary: #64748b;

    --border: #e2e8f0;

    --background: #f5f7fb;
    --white: #ffffff;

    --selected-background: #eff6ff;

    --shadow:
        0 20px 50px rgba(15, 23, 42, 0.10);
}


/* =========================================================
   RESET
   ========================================================= */

* {
    box-sizing: border-box;
}

body {
    margin: 0;

    min-height: 100vh;

    font-family:
        Inter,
        -apple-system,
        BlinkMacSystemFont,
        "Segoe UI",
        sans-serif;

    background:
        radial-gradient(
            circle at top left,
            #dbeafe 0,
            transparent 35%
        ),
        var(--background);

    color: var(--text-primary);
}


/* =========================================================
   PAGE
   ========================================================= */

.role-page {

    min-height: 100vh;

    display: flex;

    align-items: center;
    justify-content: center;

    padding: 40px 20px;
}


/* =========================================================
   MAIN CARD
   ========================================================= */

.role-card {

    width: 100%;

    max-width: 620px;

    padding: 42px;

    background: var(--white);

    border: 1px solid rgba(226, 232, 240, 0.8);

    border-radius: 28px;

    box-shadow: var(--shadow);
}


/* =========================================================
   HEADER
   ========================================================= */

.role-header {

    text-align: center;

    margin-bottom: 32px;
}


.school-logo {

    width: 72px;
    height: 72px;

    margin: 0 auto 20px;

    display: flex;

    align-items: center;
    justify-content: center;
}


.school-logo img {

    width: 100%;
    height: 100%;

    object-fit: contain;
}


.role-label {

    display: inline-block;

    margin-bottom: 10px;

    color: var(--primary);

    font-size: 12px;

    font-weight: 700;

    letter-spacing: 1.5px;
}


.role-header h1 {

    margin: 0;

    font-size: 30px;

    font-weight: 750;

    letter-spacing: -0.5px;
}


.role-header p {

    max-width: 450px;

    margin: 12px auto 0;

    color: var(--text-secondary);

    font-size: 15px;

    line-height: 1.6;
}


/* =========================================================
   ROLE OPTIONS
   ========================================================= */

.role-options {

    display: flex;

    flex-direction: column;

    gap: 12px;
}


/* =========================================================
   ROLE OPTION
   ========================================================= */

.role-option {

    position: relative;

    display: block;

    cursor: pointer;
}


/* Hide the actual radio button */

.role-option input {

    position: absolute;

    opacity: 0;

    pointer-events: none;
}


/* =========================================================
   ROLE OPTION CONTENT
   ========================================================= */

.role-option-content {

    display: flex;

    align-items: center;

    gap: 16px;

    padding: 16px 18px;

    border: 1px solid var(--border);

    border-radius: 16px;

    background: var(--white);

    transition:
        border-color 0.2s ease,
        background-color 0.2s ease,
        transform 0.2s ease,
        box-shadow 0.2s ease;
}


/* Hover */

.role-option:hover .role-option-content {

    border-color: #93c5fd;

    background: #f8fbff;

    transform: translateY(-1px);
}


/* =========================================================
   SELECTED ROLE
   ========================================================= */

.role-option input:checked + .role-option-content {

    border-color: var(--primary);

    background: var(--selected-background);

    box-shadow:
        0 0 0 3px rgba(37, 99, 235, 0.08);
}


/* =========================================================
   ROLE ICON
   ========================================================= */

.role-icon {

    width: 48px;
    height: 48px;

    flex-shrink: 0;

    display: flex;

    align-items: center;
    justify-content: center;

    border-radius: 13px;

    background: #f1f5f9;

    color: #475569;

    font-size: 23px;

    transition:
        background-color 0.2s ease,
        color 0.2s ease;
}


.role-option:hover .role-icon {

    background: #dbeafe;

    color: var(--primary);
}


.role-option input:checked + .role-option-content .role-icon {

    background: #dbeafe;

    color: var(--primary);
}


/* =========================================================
   ROLE INFORMATION
   ========================================================= */

.role-info {

    flex: 1;

    min-width: 0;
}


.role-info h3 {

    margin: 0;

    font-size: 16px;

    font-weight: 700;

    color: var(--text-primary);
}


.role-info p {

    margin: 4px 0 0;

    color: var(--text-secondary);

    font-size: 13px;

    line-height: 1.5;
}


/* =========================================================
   CUSTOM RADIO
   ========================================================= */

.role-radio {

    width: 22px;
    height: 22px;

    flex-shrink: 0;

    display: flex;

    align-items: center;
    justify-content: center;

    border: 2px solid #cbd5e1;

    border-radius: 50%;

    transition:
        border-color 0.2s ease;
}


.role-radio span {

    width: 10px;
    height: 10px;

    border-radius: 50%;

    background: transparent;

    transition:
        background-color 0.2s ease,
        transform 0.2s ease;
}


.role-option input:checked + .role-option-content .role-radio {

    border-color: var(--primary);
}


.role-option input:checked + .role-option-content .role-radio span {

    background: var(--primary);

    transform: scale(1);
}


/* =========================================================
   CONTINUE BUTTON
   ========================================================= */

.continue-button {

    width: 100%;

    margin-top: 24px;

    padding: 15px 20px;

    display: flex;

    align-items: center;
    justify-content: center;

    gap: 8px;

    border: none;

    border-radius: 14px;

    background: var(--primary);

    color: white;

    font-size: 15px;

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
        0 8px 20px rgba(37, 99, 235, 0.25);
}


.continue-button i {

    font-size: 20px;

    transition:
        transform 0.2s ease;
}


.continue-button:hover i {

    transform: translateX(3px);
}


/* =========================================================
   FOOTER
   ========================================================= */

.role-footer {

    margin-top: 20px;

    text-align: center;
}


.role-footer p {

    margin: 0;

    color: #94a3b8;

    font-size: 12px;
}


/* =========================================================
   RESPONSIVE
   ========================================================= */

@media (max-width: 640px) {

    .role-card {

        padding: 28px 20px;

        border-radius: 22px;
    }


    .role-header h1 {

        font-size: 26px;
    }


    .role-option-content {

        padding: 14px;
    }


    .role-icon {

        width: 42px;
        height: 42px;

        font-size: 20px;
    }


    .role-info p {

        font-size: 12px;
    }

}

</style>


<body>

    <div class="role-page">

        <div class="role-card">

            <!-- ================= HEADER ================= -->

            <div class="role-header">

                <div class="school-logo">

                    <img
                        src="{{ asset('assets/img/Life_circle_blue_LG.png') }}"
                        alt="Life University Logo"
                    >

                </div>


                <span class="role-label">
                    ACCOUNT SETUP
                </span>


                <h1>
                    Select Your Role
                </h1>


                <p>
                    Choose the role that best describes your position
                    in the university.
                </p>

            </div>


            <!-- ================= ROLE FORM ================= -->

            <form method="POST" action="{{ route('role.select.store') }}">

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


                                <div class="role-radio">

                                    <span></span>

                                </div>

                            </div>

                        </label>

                    @endforeach

                </div>


                <!-- ================= CONTINUE ================= -->

                <button type="submit" class="continue-button">

                    <span>
                        Continue
                    </span>

                    <i class='bx bx-right-arrow-alt'></i>

                </button>

            </form>


            <!-- ================= FOOTER ================= -->

            <div class="role-footer">

                <p>
                    You can continue after selecting one role.
                </p>

            </div>

        </div>

    </div>


</body>

</html>

