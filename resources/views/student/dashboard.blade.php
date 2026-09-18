
@extends('layouts.student_layout')

@section('title', 'Student Dashboard')

@section('content')

<div class="dashboard-container">

    {{-- =====================================================
         DASHBOARD LEFT
    ====================================================== --}}

    <div class="dashboard-left">


        {{-- =================================================
             WELCOME CARD
        ================================================== --}}

        <div class="welcome-card">

            <div class="welcome-text">

                <h1>
                    Welcome Back, {{ Auth::user()->name }}!
                </h1>

                <p>
Keep track of your classes, assignments,
and learning activities.
                </p>

            </div>

            <div class="welcome-img-container">

                <div id="welcome-animation"></div>

            </div>

        </div>



        {{-- =================================================
             ACADEMIC FEATURES
        ================================================== --}}

        <section class="academic-overview">


            {{-- SECTION HEADER --}}

            <div class="academic-overview-header">

                <span class="academic-label">
                    ACADEMIC
                </span>

                <h2>
                  Your Learning Workspace
                </h2>

                <p>
                   Access your classes and student schedule.
                </p>

            </div>



            {{-- =================================================
                 FEATURE CARDS
            ================================================== --}}

            <div class="academic-content-grid">


                {{-- =================================================
                     CLASS GROUPS CARD
                ================================================== --}}

                <div class="academic-feature-card">


                    {{-- HEADER --}}

                    <div class="academic-feature-header">

                        <span class="academic-feature-label">
                            ACADEMIC
                        </span>

                        <h2>
                            Class Groups
                        </h2>

                        <p>
                            View your enrolled classes.
                        </p>

                    </div>



                    {{-- ICON --}}

                    <div class="academic-feature-icon">

                        <i class="bx bx-group"></i>

                    </div>



                    {{-- CONTENT --}}

                    <h3>
                        My Class Groups
                    </h3>

                    <p class="academic-feature-description">

                       View your enrolled classes and access
your classroom activities in one place.

                    </p>



                    {{-- FEATURES --}}

                    <div class="academic-feature-items">

                        <div>

                            <i class="bx bx-check-circle"></i>

                            <span>
                                View enrolled classes
                            </span>

                        </div>

                        <div>

                            <i class="bx bx-check-circle"></i>

                            <span>
                                Access classroom materials
                            </span>

                        </div>

                        <div>
    <i class="bx bx-check-circle"></i>
    <span>View assignments and announcements</span>
</div>
                    </div>



                    {{-- BUTTON --}}

                    <a
                        href="{{ route('student.class-groups.index') }}"
                        class="academic-feature-button"
                    >

                        <i class="bx bx-grid-alt"></i>

                        <span>
                            View My Classes
                        </span>

                        <i class="bx bx-right-arrow-alt"></i>

                    </a>


                </div>



                {{-- =================================================
                     MY SCHEDULE CARD
                ================================================== --}}

                <div class="academic-feature-card">


                    {{-- HEADER --}}

                    <div class="academic-feature-header">

                        <span class="academic-feature-label">
                            ACADEMIC
                        </span>

                        <h2>
                            My Schedule
                        </h2>

                        <p>
                           Stay organized with your department timetable.
                        </p>

                    </div>



                    {{-- ICON --}}

                    <div class="academic-feature-icon">

                        <i class="bx bx-calendar-alt"></i>

                    </div>



                    {{-- CONTENT --}}

                    <h3>
                        Class Schedule
                    </h3>

                    <p class="academic-feature-description">

                   View your courses, classrooms,
and class times in one place.

                    </p>



                    {{-- FEATURES --}}

                    <div class="academic-feature-items">

                        <div>

                            <i class="bx bx-check-circle"></i>

                            <span>
                                View class timetable
                            </span>

                        </div>

                        <div>

                            <i class="bx bx-check-circle"></i>

                            <span>
                                Check class days and times
                            </span>

                        </div>

                        <div>

                            <i class="bx bx-check-circle"></i>

                            <span>
                                View your classrooms
                            </span>

                        </div>

                    </div>



                    {{-- BUTTON --}}

                    <a
                        href="{{ route('student.schedules.index') }}"
                        class="academic-feature-button"
                    >

                        <i class="bx bx-calendar-check"></i>

                        <span>
                            Open My Schedule
                        </span>

                        <i class="bx bx-right-arrow-alt"></i>

                    </a>


                </div>


            </div>

        </section>


    </div>

</div>



{{-- =========================================================
     LOTTIE ANIMATION
========================================================= --}}

<script src="https://cdnjs.cloudflare.com/ajax/libs/bodymovin/5.12.2/lottie.min.js"></script>

<script>

    document.addEventListener('DOMContentLoaded', function () {

        const welcomeAnimation =
            document.getElementById('welcome-animation');

        if (welcomeAnimation && typeof lottie !== 'undefined') {

            lottie.loadAnimation({

                container: welcomeAnimation,

                renderer: 'svg',

                loop: true,

                autoplay: true,

                path: "{{ asset('animations/welcome.json') }}"

            });

        }

    });

</script>



{{-- =========================================================
     ACADEMIC FEATURE CARD STYLES
========================================================= --}}


<style>

/* =========================================================
   ACADEMIC OVERVIEW
========================================================= */

.academic-overview {

    width: 100%;

    margin-top: 18px;

}

.academic-overview-header {

    margin-bottom: 14px;

}

.academic-label {

    display: block;

    margin-bottom: 4px;

    color: #2563eb;

    font-size: 10px;

    font-weight: 800;

    letter-spacing: 1.4px;

}

.academic-overview-header h2 {

    margin: 0;

    color: #172033;

    font-size: 22px;

    font-weight: 800;

    line-height: 1.25;

}

.academic-overview-header p {

    margin: 5px 0 0;

    color: #64748b;

    font-size: 12px;

    line-height: 1.4;

}


/* =========================================================
   FEATURE GRID
========================================================= */

.academic-content-grid {

    display: grid;

    grid-template-columns:
        repeat(2, minmax(0, 1fr));

    gap: 16px;

    width: 100%;

    align-items: stretch;

}


/* =========================================================
   FEATURE CARD
========================================================= */

.academic-feature-card {

    display: flex;

    flex-direction: column;

    align-items: flex-start;

    min-width: 0;

    min-height: 0;

    padding: 22px;

    background: #ffffff;

    border: 1px solid #e5eaf2;

    border-radius: 16px;

    box-shadow:
        0 3px 12px rgba(15, 23, 42, 0.035);

}


/* =========================================================
   CARD HEADER
========================================================= */

.academic-feature-header {

    width: 100%;

    margin-bottom: 18px;

}

.academic-feature-label {

    display: block;

    margin-bottom: 6px;

    color: #2563eb;

    font-size: 10px;

    font-weight: 800;

    letter-spacing: 1.4px;

}

.academic-feature-header h2 {

    margin: 0;

    color: #172033;

    font-size: 23px;

    font-weight: 800;

    line-height: 1.25;

}

.academic-feature-header p {

    margin: 6px 0 0;

    color: #64748b;

    font-size: 12px;

    line-height: 1.4;

}


/* =========================================================
   ICON
========================================================= */

.academic-feature-icon {

    display: flex;

    align-items: center;

    justify-content: center;

    width: 56px;

    height: 56px;

    margin-bottom: 18px;

    color: #2563eb;

    background: #eff6ff;

    border-radius: 14px;

}

.academic-feature-icon i {

    font-size: 29px;

}


/* =========================================================
   FEATURE TITLE
========================================================= */

.academic-feature-card h3 {

    margin: 0;

    color: #172033;

    font-size: 20px;

    font-weight: 800;

    line-height: 1.3;

}


/* =========================================================
   DESCRIPTION
========================================================= */

.academic-feature-description {

    max-width: 560px;

    margin: 8px 0 0;

    color: #64748b;

    font-size: 12px;

    line-height: 1.6;

}


/* =========================================================
   FEATURE LIST
========================================================= */

.academic-feature-items {

    display: flex;

    flex-direction: column;

    gap: 10px;

    width: 100%;

    margin-top: 18px;

    padding-top: 16px;

    border-top: 1px solid #e5eaf2;

}

.academic-feature-items div {

    display: flex;

    align-items: center;

    gap: 9px;

    color: #334155;

    font-size: 12px;

    font-weight: 700;

    line-height: 1.4;

}

.academic-feature-items i {

    flex-shrink: 0;

    color: #2563eb;

    font-size: 17px;

}


/* =========================================================
   BLUE BUTTON
========================================================= */

.academic-feature-button {

    display: flex;

    align-items: center;

    justify-content: center;

    gap: 9px;

    width: 100%;

    margin-top: 20px;

    padding: 12px 14px;

    color: #ffffff;

    background: #2563eb;

    border: 1px solid #2563eb;

    border-radius: 9px;

    font-size: 12px;

    font-weight: 800;

    line-height: 1.3;

    text-decoration: none;

    transition:

        background 0.2s ease,

        transform 0.2s ease;

}

.academic-feature-button i {

    flex-shrink: 0;

    font-size: 17px;

}

.academic-feature-button span {

    text-align: center;

}

.academic-feature-button:hover {

    color: #ffffff;

    background: #1d4ed8;

    border-color: #1d4ed8;

    transform: translateY(-1px);

}


/* =========================================================
   RESPONSIVE
========================================================= */

@media (max-width: 1100px) {

    .academic-content-grid {

        gap: 14px;

    }

    .academic-feature-card {

        padding: 20px;

    }

    .academic-feature-header h2 {

        font-size: 21px;

    }

    .academic-feature-card h3 {

        font-size: 18px;

    }

}

@media (max-width: 850px) {

    .academic-content-grid {

        grid-template-columns: 1fr;

    }

}

@media (max-width: 520px) {

    .academic-feature-card {

        padding: 20px;

        border-radius: 14px;

    }

    .academic-feature-header h2 {

        font-size: 21px;

    }

    .academic-feature-card h3 {

        font-size: 19px;

    }

    .academic-feature-description {

        font-size: 12px;

    }

    .academic-feature-button {

        font-size: 12px;

        padding: 12px;

    }

}

</style>
@endsection