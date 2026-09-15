@extends('layouts.admin_layout')

@section('title', 'Create User')

@section('content')

<div class="admin-user-create-page">

    <form
        method="POST"
        action="{{ route('admin.users.store') }}"
        class="user-create-form"
    >

        @csrf


        {{-- =====================================================
             PAGE HEADER
        ====================================================== --}}

        <div class="user-create-header">

            <a
                href="{{ route('admin.users.index') }}"
                class="back-link"
            >
                <i class='bx bx-left-arrow-alt'></i>
                <span>Back to Users</span>
            </a>


            <div class="user-header-main">

                <div class="user-title-row">

                    <div class="user-title-icon">
                        <i class='bx bx-user-plus'></i>
                    </div>

                    <div>

                        <span class="page-eyebrow">
                            USER MANAGEMENT
                        </span>

                        <h1>Create New User</h1>

                        <p>
                            Add a new user account and assign the appropriate role.
                        </p>

                    </div>

                </div>


                {{-- Top Actions --}}
                <div class="user-header-actions">

                    <a
                        href="{{ route('admin.users.index') }}"
                        class="cancel-button"
                    >
                        <i class='bx bx-x'></i>
                        Cancel
                    </a>

                    <button
                        type="submit"
                        class="submit-button"
                    >
                        <i class='bx bx-user-plus'></i>
                        Create User
                    </button>

                </div>

            </div>

        </div>



        {{-- =====================================================
             VALIDATION ERRORS
        ====================================================== --}}

        @if ($errors->any())

            <div class="user-form-alert">

                <div class="alert-icon">
                    <i class='bx bx-error-circle'></i>
                </div>

                <div>

                    <strong>
                        Please check the form
                    </strong>

                    <ul>

                        @foreach ($errors->all() as $error)

                            <li>
                                {{ $error }}
                            </li>

                        @endforeach

                    </ul>

                </div>

            </div>

        @endif



        {{-- =====================================================
             BASIC INFORMATION
        ====================================================== --}}

        <div class="user-form-card">

            <div class="form-card-heading">

                <div class="section-icon blue">
                    <i class='bx bx-user'></i>
                </div>

                <div>

                    <span class="section-kicker">
                        ACCOUNT DETAILS
                    </span>

                    <h2>
                        Basic Information
                    </h2>

                    <p>
                        Enter the user's personal account information.
                    </p>

                </div>

            </div>


            <div class="form-fields-grid">


                {{-- Full Name --}}
                <div class="field-group">

                    <label for="name">
                        Full Name <span>*</span>
                    </label>

                    <div class="field-shell">

                        <i class='bx bx-user'></i>

                        <input
                            type="text"
                            id="name"
                            name="name"
                            value="{{ old('name') }}"
                            placeholder="Enter full name"
                            required
                        >

                    </div>

                    @error('name')

                        <small class="field-error">
                            {{ $message }}
                        </small>

                    @enderror

                </div>



                {{-- Email --}}
                <div class="field-group">

                    <label for="email">
                        Email Address <span>*</span>
                    </label>

                    <div class="field-shell">

                        <i class='bx bx-envelope'></i>

                        <input
                            type="email"
                            id="email"
                            name="email"
                            value="{{ old('email') }}"
                            placeholder="Enter email address"
                            required
                        >

                    </div>

                    @error('email')

                        <small class="field-error">
                            {{ $message }}
                        </small>

                    @enderror

                </div>



                {{-- Password --}}
                <div class="field-group full-width">

                    <label for="password">
                        Password <span>*</span>
                    </label>

                    <div class="field-shell">

                        <i class='bx bx-lock-alt'></i>

                        <input
                            type="password"
                            id="password"
                            name="password"
                            placeholder="Create a secure password"
                            required
                        >

                        <button
                            type="button"
                            class="password-toggle"
                            onclick="togglePassword()"
                            aria-label="Show or hide password"
                        >
                            <i
                                class='bx bx-show'
                                id="passwordIcon"
                            ></i>
                        </button>

                    </div>

                    @error('password')

                        <small class="field-error">
                            {{ $message }}
                        </small>

                    @enderror

                </div>

            </div>

        </div>



        {{-- =====================================================
             ACCESS AND ROLES
        ====================================================== --}}

        <div class="user-form-card">

            <div class="form-card-heading">

                <div class="section-icon purple">
                    <i class='bx bx-shield-quarter'></i>
                </div>

                <div>

                    <span class="section-kicker">
                        ACCESS CONTROL
                    </span>

                    <h2>
                        Access & Roles
                    </h2>

                    <p>
                        Choose the user's role and access permissions.
                    </p>

                </div>

            </div>



            <div class="field-group">

                <label>
                    Assign Role <span>*</span>
                </label>


                <div class="roles-grid">

                    @foreach ($roles as $role)

                        <label class="role-option">

                            <input
                                type="checkbox"
                                name="role_ids[]"
                                value="{{ $role->id }}"
                                {{ in_array($role->id, old('role_ids', [])) ? 'checked' : '' }}
                            >

                            <span class="role-option-content">

                                <span class="role-option-icon">
                                    <i class='bx bx-shield'></i>
                                </span>

                                <span class="role-option-text">

                                    <strong>
                                        {{ $role->role_name }}
                                    </strong>

                                    <small>
                                        Assign this access role
                                    </small>

                                </span>

                                <span class="role-check">
                                    <i class='bx bx-check'></i>
                                </span>

                            </span>

                        </label>

                    @endforeach

                </div>


                @error('role_ids')

                    <small class="field-error">
                        {{ $message }}
                    </small>

                @enderror


                @error('role_ids.*')

                    <small class="field-error">
                        {{ $message }}
                    </small>

                @enderror

            </div>

        </div>



        {{-- =====================================================
             INFORMATION SUMMARY
        ====================================================== --}}

        <div class="user-summary-card">

            <div class="summary-icon">
                <i class='bx bx-info-circle'></i>
            </div>

            <div>

                <strong>
                    Before creating this user
                </strong>

                <p>
                    Make sure the information is correct and the selected
                    role matches the user's responsibilities.
                </p>

            </div>

        </div>



    </form>

</div>



<style>

/* =========================================================
   PAGE
========================================================= */

.admin-user-create-page {
    width: 100%;
    max-width: 1180px;
    margin: 0 auto;
    padding: 18px 26px 28px;
}


/* =========================================================
   FORM
========================================================= */

.user-create-form {
    display: flex;
    flex-direction: column;
    gap: 14px;
}


/* =========================================================
   HEADER
========================================================= */

.user-create-header {
    margin-bottom: 4px;
}

.back-link {
    display: inline-flex;
    align-items: center;
    gap: 7px;
    margin-bottom: 14px;
    color: #64748b;
    text-decoration: none;
    font-size: 14px;
    font-weight: 700;
    transition: color 0.2s ease;
}

.back-link i {
    font-size: 21px;
}

.back-link:hover {
    color: #2563eb;
}

.user-header-main {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 24px;
}

.user-title-row {
    display: flex;
    align-items: center;
    gap: 14px;
    min-width: 0;
}

.user-title-icon {
    width: 56px;
    height: 56px;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
    border-radius: 17px;
    background: linear-gradient(135deg, #2563eb, #4f46e5);
    color: #ffffff;
    box-shadow: 0 10px 22px rgba(37, 99, 235, 0.17);
}

.user-title-icon i {
    font-size: 28px;
}

.page-eyebrow {
    display: block;
    margin-bottom: 5px;
    color: #2563eb;
    font-size: 11px;
    font-weight: 800;
    letter-spacing: 1.5px;
}

.user-title-row h1 {
    margin: 0;
    color: #172033;
    font-size: 29px;
    font-weight: 800;
    letter-spacing: -0.7px;
}

.user-title-row p {
    margin: 4px 0 0;
    color: #64748b;
    font-size: 14px;
}


/* =========================================================
   TOP ACTION BUTTONS
========================================================= */

.user-header-actions {
    display: flex;
    align-items: center;
    justify-content: flex-end;
    gap: 10px;
    flex-shrink: 0;
}

.cancel-button,
.submit-button {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 7px;
    min-height: 44px;
    padding: 0 17px;
    border-radius: 11px;
    font-family: inherit;
    font-size: 12px;
    font-weight: 750;
    text-decoration: none;
    cursor: pointer;
    transition: all 0.2s ease;
}

.cancel-button {
    border: 1px solid #e2e8f0;
    background: #ffffff;
    color: #64748b;
}

.cancel-button:hover {
    border-color: #cbd5e1;
    background: #f8fafc;
    color: #334155;
}

.submit-button {
    border: 0;
    background: linear-gradient(135deg, #2563eb, #4f46e5);
    color: #ffffff;
    box-shadow: 0 7px 16px rgba(37, 99, 235, 0.17);
}

.submit-button:hover {
    transform: translateY(-1px);
    box-shadow: 0 10px 21px rgba(37, 99, 235, 0.24);
}

.cancel-button i,
.submit-button i {
    font-size: 17px;
}


/* =========================================================
   VALIDATION ALERT
========================================================= */

.user-form-alert {
    display: flex;
    align-items: flex-start;
    gap: 12px;
    padding: 15px 18px;
    border: 1px solid #fecaca;
    border-radius: 15px;
    background: #fff1f2;
    color: #991b1b;
}

.alert-icon {
    width: 34px;
    height: 34px;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
    border-radius: 10px;
    background: #fee2e2;
    color: #dc2626;
}

.alert-icon i {
    font-size: 20px;
}

.user-form-alert strong {
    display: block;
    margin-bottom: 4px;
    font-size: 13px;
}

.user-form-alert ul {
    margin: 0;
    padding-left: 17px;
    font-size: 12px;
    line-height: 1.7;
}


/* =========================================================
   FORM CARDS
========================================================= */

.user-form-card {
    padding: 22px 26px;
    border: 1px solid #e8edf5;
    border-radius: 20px;
    background: #ffffff;
    box-shadow: 0 7px 25px rgba(15, 23, 42, 0.04);
}

.form-card-heading {
    display: flex;
    align-items: center;
    gap: 12px;
    margin-bottom: 20px;
    padding-bottom: 16px;
    border-bottom: 1px solid #edf1f7;
}

.section-icon {
    width: 42px;
    height: 42px;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
    border-radius: 13px;
}

.section-icon i {
    font-size: 22px;
}

.section-icon.blue {
    background: #eff6ff;
    color: #2563eb;
}

.section-icon.purple {
    background: #f5f3ff;
    color: #7c3aed;
}

.section-kicker {
    display: block;
    margin-bottom: 4px;
    color: #94a3b8;
    font-size: 10px;
    font-weight: 800;
    letter-spacing: 1.2px;
}

.form-card-heading h2 {
    margin: 0;
    color: #172033;
    font-size: 20px;
    font-weight: 800;
}

.form-card-heading p {
    margin: 3px 0 0;
    color: #64748b;
    font-size: 12px;
}


/* =========================================================
   INPUT FIELDS
========================================================= */

.form-fields-grid {
    display: grid;
    grid-template-columns: repeat(2, minmax(0, 1fr));
    gap: 17px 22px;
}

.field-group {
    min-width: 0;
}

.field-group.full-width {
    grid-column: 1 / -1;
}

.field-group label {
    display: flex;
    align-items: center;
    gap: 4px;
    margin-bottom: 6px;
    color: #334155;
    font-size: 13px;
    font-weight: 750;
}

.field-group label > span {
    color: #ef4444;
}

.field-shell {
    position: relative;
    display: flex;
    align-items: center;
    min-height: 48px;
    border: 1px solid #dce4ef;
    border-radius: 12px;
    background: #fbfcfe;
    transition:
        border-color 0.2s ease,
        box-shadow 0.2s ease,
        background 0.2s ease;
}

.field-shell:focus-within {
    border-color: #3b82f6;
    background: #ffffff;
    box-shadow: 0 0 0 4px rgba(59, 130, 246, 0.10);
}

.field-shell > i {
    margin-left: 14px;
    color: #94a3b8;
    font-size: 19px;
}

.field-shell input {
    width: 100%;
    min-width: 0;
    height: 46px;
    padding: 0 14px 0 12px;
    border: 0;
    outline: none;
    background: transparent;
    color: #172033;
    font-family: inherit;
    font-size: 13px;
}

.field-shell input::placeholder {
    color: #a5b1c2;
}

.password-toggle {
    width: 40px;
    height: 40px;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
    margin-right: 4px;
    border: 0;
    border-radius: 9px;
    background: transparent;
    color: #94a3b8;
    cursor: pointer;
    font-size: 20px;
}

.password-toggle:hover {
    background: #eff6ff;
    color: #2563eb;
}

.field-error {
    display: block;
    margin-top: 6px;
    color: #dc2626;
    font-size: 12px;
}


/* =========================================================
   ROLES - ONE ROW
========================================================= */

.roles-grid {
    display: grid;
    grid-template-columns: repeat(3, minmax(0, 1fr));
    gap: 12px;
}

.role-option {
    display: block;
    margin: 0 !important;
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
    gap: 9px;
    min-height: 68px;
    padding: 11px;
    border: 1px solid #e2e8f0;
    border-radius: 13px;
    background: #ffffff;
    transition: all 0.2s ease;
}

.role-option input:checked + .role-option-content {
    border-color: #3b82f6;
    background: #eff6ff;
    box-shadow: 0 0 0 2px rgba(59, 130, 246, 0.08);
}

.role-option-icon {
    width: 34px;
    height: 34px;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
    border-radius: 10px;
    background: #f1f5f9;
    color: #64748b;
}

.role-option input:checked + .role-option-content .role-option-icon {
    background: #dbeafe;
    color: #2563eb;
}

.role-option-icon i {
    font-size: 19px;
}

.role-option-text {
    display: flex;
    flex-direction: column;
    gap: 2px;
    min-width: 0;
    flex: 1;
}

.role-option-text strong {
    overflow: hidden;
    color: #334155;
    font-size: 12px;
    font-weight: 800;
    text-overflow: ellipsis;
    white-space: nowrap;
}

.role-option-text small {
    overflow: hidden;
    color: #94a3b8;
    font-size: 10px;
    text-overflow: ellipsis;
    white-space: nowrap;
}

.role-check {
    width: 20px;
    height: 20px;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
    border: 1px solid #cbd5e1;
    border-radius: 6px;
    background: #ffffff;
    color: transparent;
}

.role-option input:checked + .role-option-content .role-check {
    border-color: #2563eb;
    background: #2563eb;
    color: #ffffff;
}

.role-check i {
    font-size: 14px;
}


/* =========================================================
   SUMMARY
========================================================= */

.user-summary-card {
    display: flex;
    align-items: flex-start;
    gap: 11px;
    padding: 14px 18px;
    border: 1px solid #dbeafe;
    border-radius: 15px;
    background: #eff6ff;
}

.summary-icon {
    width: 32px;
    height: 32px;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
    border-radius: 10px;
    background: #dbeafe;
    color: #2563eb;
}

.summary-icon i {
    font-size: 18px;
}

.user-summary-card strong {
    display: block;
    margin-bottom: 3px;
    color: #1e40af;
    font-size: 13px;
}

.user-summary-card p {
    margin: 0;
    color: #3b82a8;
    font-size: 12px;
    line-height: 1.5;
}


/* =========================================================
   RESPONSIVE
========================================================= */

@media (max-width: 900px) {

    .user-header-main {
        align-items: flex-start;
        flex-direction: column;
        gap: 16px;
    }

    .user-header-actions {
        justify-content: flex-start;
    }

}


@media (max-width: 850px) {

    .roles-grid {
        grid-template-columns: repeat(2, minmax(0, 1fr));
    }

}


@media (max-width: 650px) {

    .admin-user-create-page {
        padding: 16px 14px 24px;
    }

    .user-title-row {
        align-items: flex-start;
    }

    .user-title-icon {
        width: 50px;
        height: 50px;
        border-radius: 15px;
    }

    .user-title-icon i {
        font-size: 25px;
    }

    .user-title-row h1 {
        font-size: 25px;
    }

    .user-title-row p {
        font-size: 12px;
        line-height: 1.5;
    }

    .user-form-card {
        padding: 20px 16px;
        border-radius: 18px;
    }

    .form-fields-grid {
        grid-template-columns: 1fr;
    }

    .field-group.full-width {
        grid-column: auto;
    }

    .roles-grid {
        grid-template-columns: 1fr;
    }

    .user-header-actions {
        width: 100%;
    }

    .user-header-actions .cancel-button,
    .user-header-actions .submit-button {
        flex: 1;
    }

}

</style>



<script>

function togglePassword() {

    const passwordInput = document.getElementById('password');
    const passwordIcon = document.getElementById('passwordIcon');

    if (passwordInput.type === 'password') {

        passwordInput.type = 'text';

        passwordIcon.classList.remove('bx-show');
        passwordIcon.classList.add('bx-hide');

    } else {

        passwordInput.type = 'password';

        passwordIcon.classList.remove('bx-hide');
        passwordIcon.classList.add('bx-show');

    }

}

</script>

@endsection