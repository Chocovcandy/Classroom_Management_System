<style>
    /* ============================================================
   PROFESSOR CLASSROOM — STUDENTS
   ============================================================ */


/* ============================================================
   PAGE WRAPPER
   ============================================================ */

.classroom-students {

    width: 100%;
    max-width: 100%;

    box-sizing: border-box;

}


/* ============================================================
   PAGE HEADER
   ============================================================ */

.students-header {

    display: flex;

    align-items: center;
    justify-content: space-between;

    width: 100%;

    min-height: 150px;

    padding: 28px 32px;

    box-sizing: border-box;

    background-color: var(--card-color);

    border: 1px solid var(--border-color);

    border-radius: 16px;

    box-shadow:
        0 4px 14px var(--shadow-color);

    margin-bottom: 14px;

}


.students-header-content {

    display: flex;

    flex-direction: column;

}


.students-label {

    margin-bottom: 5px;

    color: var(--primary-color);

    font-size: 11px;

    font-weight: 700;

    letter-spacing: 1.4px;

}


.students-header h1 {

    margin: 0;

    color: var(--text-color);

    font-size: 28px;

    line-height: 1.15;

    font-weight: 700;

}


.students-header p {

    margin: 7px 0 0;

    color: var(--muted-text-color);

    font-size: 14px;

}


/* ============================================================
   HEADER ICON
   ============================================================ */

.students-header-icon {

    display: flex;

    align-items: center;
    justify-content: center;

    width: 64px;
    height: 64px;

    color: var(--primary-color);

    background-color: var(--primary-soft);

    border: 1px solid var(--primary-border);

    border-radius: 14px;

    font-size: 30px;

}


/* ============================================================
   SUMMARY CARD
   ============================================================ */

.students-summary {

    display: flex;

    align-items: center;

    gap: 14px;

    width: 100%;

    padding: 18px 22px;

    box-sizing: border-box;

    background-color: var(--card-color);

    border: 1px solid var(--border-color);

    border-radius: 14px;

    box-shadow:
        0 3px 10px var(--shadow-color);

    margin-bottom: 14px;

}


.students-summary-icon {

    display: flex;

    align-items: center;
    justify-content: center;

    width: 44px;
    height: 44px;

    flex-shrink: 0;

    color: var(--primary-color);

    background-color: var(--primary-soft);

    border: 1px solid var(--primary-border);

    border-radius: 11px;

    font-size: 20px;

}


.students-summary > div:last-child {

    display: flex;

    flex-direction: column;

    gap: 2px;

}


.students-summary span {

    color: var(--muted-text-color);

    font-size: 10px;

    font-weight: 700;

    letter-spacing: 1px;

}


.students-summary strong {

    color: var(--text-color);

    font-size: 22px;

    line-height: 1.1;

}


/* ============================================================
   STUDENTS CARD
   ============================================================ */

.students-card {

    width: 100%;

    background-color: var(--card-color);

    border: 1px solid var(--border-color);

    border-radius: 16px;

    box-shadow:
        0 4px 14px var(--shadow-color);

    overflow: hidden;

}


/* ============================================================
   STUDENTS CARD HEADER
   ============================================================ */

.students-card-header {

    display: flex;

    align-items: center;
    justify-content: space-between;

    padding: 20px 24px;

    border-bottom: 1px solid var(--border-color);

}


.section-label {

    display: block;

    margin-bottom: 3px;

    color: var(--primary-color);

    font-size: 10px;

    font-weight: 700;

    letter-spacing: 1.2px;

}


.students-card-header h2 {

    margin: 0;

    color: var(--text-color);

    font-size: 20px;

    font-weight: 700;

}


.section-icon {

    display: flex;

    align-items: center;
    justify-content: center;

    width: 38px;
    height: 38px;

    color: var(--primary-color);

    background-color: var(--primary-soft);

    border-radius: 10px;

    font-size: 20px;

}


/* ============================================================
   STUDENT LIST
   ============================================================ */

.student-list {

    display: flex;

    flex-direction: column;

}


/* ============================================================
   STUDENT ROW
   ============================================================ */

.student-row {

    display: flex;

    align-items: center;

    min-height: 76px;

    padding: 12px 18px;

    box-sizing: border-box;

    border-bottom: 1px solid var(--border-color);

    transition:
        background-color 0.2s ease,
        transform 0.2s ease;

}


.student-row:last-child {

    border-bottom: none;

}


.student-row:hover {

    background-color: var(--hover-color);

}


/* ============================================================
   STUDENT AVATAR
   ============================================================ */

.student-avatar {

    display: flex;

    align-items: center;
    justify-content: center;

    width: 46px;
    height: 46px;

    flex-shrink: 0;

    margin-right: 14px;

    overflow: hidden;

    color: var(--primary-color);

    background-color: var(--primary-soft);

    border: 1px solid var(--primary-border);

    border-radius: 50%;

    font-size: 17px;

    font-weight: 700;

}


.student-avatar img {

    width: 100%;
    height: 100%;

    object-fit: cover;

}


/* ============================================================
   STUDENT INFORMATION
   ============================================================ */

.student-info {

    display: flex;

    flex-direction: column;

    min-width: 0;

    flex: 1;

}


.student-info h3 {

    margin: 0;

    overflow: hidden;

    color: var(--text-color);

    font-size: 15px;

    font-weight: 650;

    text-overflow: ellipsis;

    white-space: nowrap;

}


.student-info p {

    margin: 3px 0 0;

    overflow: hidden;

    color: var(--muted-text-color);

    font-size: 13px;

    text-overflow: ellipsis;

    white-space: nowrap;

}


/* ============================================================
   ENROLLMENT STATUS
   ============================================================ */

.student-status {

    margin-right: 16px;

}


.student-status span {

    display: inline-flex;

    align-items: center;

    gap: 6px;

    padding: 6px 10px;

    color: var(--success-color);

    background-color: var(--success-soft);

    border: 1px solid var(--success-border);

    border-radius: 20px;

    font-size: 11px;

    font-weight: 600;

}


.student-status span::before {

    content: "";

    width: 6px;
    height: 6px;

    background-color: var(--success-color);

    border-radius: 50%;

}


/* ============================================================
   THREE DOT MENU
   ============================================================ */

.student-menu {

    display: flex;

    align-items: center;
    justify-content: center;

    width: 34px;
    height: 34px;

    flex-shrink: 0;

    padding: 0;

    color: var(--muted-text-color);

    background-color: transparent;

    border: none;

    border-radius: 8px;

    cursor: pointer;

    font-size: 19px;

    transition:
        color 0.2s ease,
        background-color 0.2s ease;

}


.student-menu:hover {

    color: var(--text-color);

    background-color: var(--hover-color);

}


/* ============================================================
   EMPTY STATE
   ============================================================ */

.students-empty {

    display: flex;

    flex-direction: column;

    align-items: center;
    justify-content: center;

    min-height: 260px;

    padding: 40px 24px;

    text-align: center;

}


.students-empty-icon {

    display: flex;

    align-items: center;
    justify-content: center;

    width: 58px;
    height: 58px;

    margin-bottom: 14px;

    color: var(--primary-color);

    background-color: var(--primary-soft);

    border: 1px solid var(--primary-border);

    border-radius: 15px;

    font-size: 26px;

}


.students-empty h3 {

    margin: 0;

    color: var(--text-color);

    font-size: 17px;

}


.students-empty p {

    max-width: 380px;

    margin: 7px 0 0;

    color: var(--muted-text-color);

    font-size: 13px;

    line-height: 1.5;

}


/* ============================================================
   RESPONSIVE
   ============================================================ */

@media (max-width: 768px) {

    .students-header {

        min-height: 125px;

        padding: 22px;

    }


    .students-header h1 {

        font-size: 24px;

    }


    .students-header-icon {

        width: 52px;
        height: 52px;

        font-size: 24px;

    }


    .student-row {

        padding: 11px 14px;

    }


    .student-status {

        display: none;

    }

}


@media (max-width: 480px) {

    .students-header {

        padding: 18px;

    }


    .students-header-icon {

        display: none;

    }


    .students-summary {

        padding: 15px 18px;

    }


    .students-card-header {

        padding: 17px 18px;

    }


    .student-avatar {

        width: 40px;
        height: 40px;

        margin-right: 11px;

    }


    .student-info h3 {

        font-size: 14px;

    }


    .student-info p {

        font-size: 12px;

    }

}
</style>
@extends('layouts.prof_layout')

@section('title', 'Students')

@section('content')

<div class="classroom-students">


    {{-- =====================================================
         CLASSROOM NAVIGATION from a component 
    ====================================================== --}}
            @include('professor.class_groups.classroom_group.navigation')
    {{-- ============================================================
         PAGE HEADER
    ============================================================= --}}

    <div class="students-header">

        <div class="students-header-content">

            <span class="students-label">
                CLASSROOM
            </span>

            <h1>
                Students
            </h1>

            <p>
                Students enrolled in {{ $classGroup->group_name }}
            </p>

        </div>


        <div class="students-header-icon">
            <i class="bx bx-group"></i>
        </div>

    </div>


    {{-- ============================================================
         STUDENT SUMMARY
    ============================================================= --}}

    <div class="students-summary">

        <div class="students-summary-icon">
            <i class="bx bx-group"></i>
        </div>

        <div>

            <span>
                ENROLLED STUDENTS
            </span>

            <strong>
                {{ $classGroup->students->count() }}
            </strong>

        </div>

    </div>


    {{-- ============================================================
         STUDENT LIST
    ============================================================= --}}

    <section class="students-card">

        <div class="students-card-header">

            <div>

                <span class="section-label">
                    CLASS MEMBERS
                </span>

                <h2>
                    Students
                </h2>

            </div>

            <i class="bx bx-user section-icon"></i>

        </div>


        {{-- ========================================================
             STUDENTS
        ========================================================= --}}

        <div class="student-list">

            @forelse($classGroup->students as $student)

                <article class="student-row">

                    {{-- PROFILE IMAGE --}}

                    <div class="student-avatar">

                        @if($student->profile_image)

                            <img
                                src="{{ asset('storage/' . $student->profile_image) }}"
                                alt="{{ $student->name }}"
                            >

                        @else

                            <span>
                                {{ strtoupper(substr($student->name, 0, 1)) }}
                            </span>

                        @endif

                    </div>


                    {{-- STUDENT INFORMATION --}}

                    <div class="student-info">

                        <h3>
                            {{ $student->name }}
                        </h3>

                        <p>
                            {{ $student->email }}
                        </p>

                    </div>


                    {{-- STUDENT STATUS --}}

                    <div class="student-status">

                        <span>
                            Enrolled
                        </span>

                    </div>


                    {{-- MORE OPTIONS --}}

                    <button
                        type="button"
                        class="student-menu"
                        aria-label="More options"
                    >

                        <i class="bx bx-dots-vertical-rounded"></i>

                    </button>

                </article>

            @empty

                {{-- =================================================
                     EMPTY STATE
                ================================================== --}}

                <div class="students-empty">

                    <div class="students-empty-icon">

                        <i class="bx bx-group"></i>

                    </div>

                    <h3>
                        No students yet
                    </h3>

                    <p>
                        No students are currently enrolled in this classroom.
                    </p>

                </div>

            @endforelse

        </div>

    </section>

</div>

@endsection