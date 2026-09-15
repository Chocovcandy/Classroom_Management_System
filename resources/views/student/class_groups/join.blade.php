<style>
    /* =========================================================
   JOIN CLASS PAGE
========================================================= */

.join-class-container {
    width: 100%;
    display: flex;
    justify-content: center;
    padding: 20px 0 60px;
}


/* =========================================================
   JOIN CLASS CARD
========================================================= */

.join-class-card {
    width: 100%;
    max-width: 620px;
    background: var(--bg-card, #ffffff);
    border: 1px solid var(--border-color, #e5e7eb);
    border-radius: 18px;
    padding: 42px;
    text-align: center;
    box-shadow: 0 8px 30px rgba(0, 0, 0, 0.06);
}


/* =========================================================
   ICON
========================================================= */

.join-class-icon {
    width: 70px;
    height: 70px;
    margin: 0 auto 20px;

    display: flex;
    align-items: center;
    justify-content: center;

    border-radius: 18px;

    background: #eef2ff;
    color: #4f46e5;

    font-size: 34px;
}


.join-class-card h2 {
    margin: 0 0 10px;

    font-size: 26px;
    font-weight: 700;

    color: var(--text-primary, #111827);
}


.join-class-description {
    max-width: 470px;
    margin: 0 auto 30px;

    font-size: 15px;
    line-height: 1.6;

    color: var(--text-secondary, #6b7280);
}


/* =========================================================
   FORM
========================================================= */

.join-class-form {
    width: 100%;
    text-align: left;
}


.join-form-group {
    display: flex;
    flex-direction: column;
    gap: 8px;
}


.join-form-group label {
    font-size: 14px;
    font-weight: 600;

    color: var(--text-primary, #111827);
}


.join-form-group input {
    width: 100%;
    height: 52px;

    padding: 0 16px;

    border: 1px solid var(--border-color, #d1d5db);
    border-radius: 10px;

    background: var(--bg-input, #ffffff);

    color: var(--text-primary, #111827);

    font-size: 16px;

    outline: none;

    transition:
        border-color 0.2s ease,
        box-shadow 0.2s ease;
}


.join-form-group input::placeholder {
    color: #9ca3af;
}


.join-form-group input:focus {
    border-color: #4f46e5;

    box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.12);
}


.join-form-group small {
    font-size: 12px;
    color: var(--text-secondary, #6b7280);
}


/* =========================================================
   JOIN BUTTON
========================================================= */

.join-submit-btn {
    width: 100%;
    height: 52px;

    margin-top: 24px;

    display: flex;
    align-items: center;
    justify-content: center;
    gap: 8px;

    border: none;
    border-radius: 10px;

    background: #4f46e5;
    color: #ffffff;

    font-size: 15px;
    font-weight: 600;

    cursor: pointer;

    transition:
        transform 0.2s ease,
        box-shadow 0.2s ease,
        opacity 0.2s ease;
}


.join-submit-btn:hover {
    transform: translateY(-1px);

    box-shadow: 0 6px 16px rgba(79, 70, 229, 0.22);
}


.join-submit-btn:active {
    transform: translateY(0);
}


.join-submit-btn i {
    font-size: 20px;
}


/* =========================================================
   ALERTS
========================================================= */

.join-alert {
    width: 100%;

    display: flex;
    align-items: flex-start;
    gap: 10px;

    margin-bottom: 20px;

    padding: 13px 15px;

    border-radius: 10px;

    text-align: left;

    font-size: 14px;
    line-height: 1.5;
}


/* SUCCESS */

.join-alert-success {
    background: #ecfdf5;
    border: 1px solid #a7f3d0;
    color: #047857;
}


.join-alert-success i {
    font-size: 20px;
    margin-top: 1px;
}


/* ERROR */

.join-alert-error {
    background: #fef2f2;
    border: 1px solid #fecaca;
    color: #b91c1c;
}


.join-alert-error i {
    font-size: 20px;
    margin-top: 1px;
}


.join-alert-error p {
    margin: 0;
}


.join-alert-error p + p {
    margin-top: 4px;
}


/* =========================================================
   RESPONSIVE
========================================================= */

@media (max-width: 768px) {

    .join-class-container {
        padding: 10px 0 40px;
    }

    .join-class-card {
        padding: 30px 24px;
        border-radius: 15px;
    }

    .join-class-card h2 {
        font-size: 23px;
    }

}


@media (max-width: 480px) {

    .join-class-card {
        padding: 25px 18px;
    }

    .join-class-icon {
        width: 60px;
        height: 60px;
        font-size: 28px;
    }

}
</style>
@extends('layouts.student_layout')

@section('content')

<div class="cg-page">

    {{-- =====================================================
         PAGE HEADER
    ====================================================== --}}

    <div class="cg-header">

        <div class="cg-header-text">

            <span class="cg-eyebrow">
                Student Dashboard
            </span>

            <h1>
                Join a Class
            </h1>

            <p>
                Enter the class code provided by your professor.
            </p>

        </div>

        <div class="cg-header-actions">

            <a
                href="{{ route('student.class-groups.index') }}"
                class="cg-create-btn"
            >
                <i class="bx bx-arrow-back"></i>

                <span>
                    Back to Classes
                </span>
            </a>

        </div>

    </div>


    {{-- =====================================================
         JOIN CLASS CARD
    ====================================================== --}}

    <div class="join-class-container">

        <div class="join-class-card">

            <div class="join-class-icon">
                <i class="bx bx-group"></i>
            </div>

            <h2>
                Join Your Class
            </h2>

            <p class="join-class-description">
                Ask your professor for the class code and enter it below
                to join the class.
            </p>


            {{-- SUCCESS MESSAGE --}}

            @if (session('success'))

                <div class="join-alert join-alert-success">
                    <i class="bx bx-check-circle"></i>

                    <span>
                        {{ session('success') }}
                    </span>
                </div>

            @endif


            {{-- ERROR MESSAGE --}}

            @if ($errors->any())

                <div class="join-alert join-alert-error">

                    <i class="bx bx-error-circle"></i>

                    <div>

                        @foreach ($errors->all() as $error)

                            <p>
                                {{ $error }}
                            </p>

                        @endforeach

                    </div>

                </div>

            @endif


            {{-- JOIN FORM --}}

            <form
                action="{{ route('student.class-groups.join.store') }}"
                method="POST"
                class="join-class-form"
            >

                @csrf

                <div class="join-form-group">

                    <label for="group_code">
                        Class Code
                    </label>

                    <input
                        type="text"
                        id="group_code"
                        name="group_code"
                        value="{{ old('group_code') }}"
                        placeholder="Enter class code"
                        maxlength="20"
                        autocomplete="off"
                        required
                    >

                    <small>
                        Example: ABC123
                    </small>

                </div>


                <button
                    type="submit"
                    class="join-submit-btn"
                >

                    <i class="bx bx-log-in"></i>

                    Join Class

                </button>

            </form>

        </div>

    </div>

</div>

@endsection