<style>
/* =========================================================
   STUDENT CLASS GROUPS PAGE
   Unique prefix: student-class-group-
========================================================= */

.student-class-group-page {
    width: 100%;
    max-width: 1220px;
    margin: 0 auto;
    padding: 28px 26px 42px;
    box-sizing: border-box;
    color: #1e293b;
}

/* =========================================================
   PAGE HEADER
========================================================= */

.student-class-group-header {
    display: flex;
    align-items: flex-end;
    justify-content: space-between;
    gap: 28px;
    margin-bottom: 30px;
}

.student-class-group-header-text {
    min-width: 0;
}

.student-class-group-eyebrow {
    display: inline-flex;
    align-items: center;
    margin-bottom: 8px;
    color: #64748b;
    font-size: 12px;
    font-weight: 700;
    letter-spacing: 0.09em;
    text-transform: uppercase;
}

.student-class-group-title {
    margin: 0;
    color: #172033;
    font-size: clamp(28px, 3vw, 38px);
    font-weight: 800;
    line-height: 1.15;
    letter-spacing: -0.8px;
}

.student-class-group-description {
    max-width: 520px;
    margin: 12px 0 0;
    color: #64748b;
    font-size: 14px;
    line-height: 1.7;
}

.student-class-group-header-actions {
    display: flex;
    align-items: center;
    justify-content: flex-end;
    gap: 12px;
    flex-shrink: 0;
}

/* =========================================================
   CLASS SUMMARY
========================================================= */

.student-class-group-summary {
    display: inline-flex;
    align-items: center;
    gap: 9px;
    min-height: 44px;
    padding: 0 15px;
    border: 1px solid #e2e8f0;
    border-radius: 13px;
    background: #ffffff;
    box-shadow: 0 5px 16px rgba(15, 23, 42, 0.035);
}

.student-class-group-summary-number {
    color: #2563eb;
    font-size: 19px;
    font-weight: 800;
    line-height: 1;
}

.student-class-group-summary-label {
    color: #64748b;
    font-size: 13px;
    font-weight: 600;
}

/* =========================================================
   JOIN CLASS BUTTON
========================================================= */

.student-class-group-join-button {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    min-height: 44px;
    padding: 0 17px;
    border: 1px solid #2563eb;
    border-radius: 13px;
    background: #2563eb;
    color: #ffffff;
    font-size: 13px;
    font-weight: 700;
    text-decoration: none;
    box-shadow: 0 7px 16px rgba(37, 99, 235, 0.18);
    transition:
        background 0.2s ease,
        border-color 0.2s ease,
        transform 0.2s ease,
        box-shadow 0.2s ease;
}

.student-class-group-join-button i {
    font-size: 18px;
}

.student-class-group-join-button:hover {
    background: #1d4ed8;
    border-color: #1d4ed8;
    color: #ffffff;
    transform: translateY(-2px);
    box-shadow: 0 10px 20px rgba(37, 99, 235, 0.24);
}

/* =========================================================
   CLASS GROUP GRID
========================================================= */

.student-class-group-grid {
    display: grid;
    grid-template-columns: repeat(3, minmax(0, 1fr));
    gap: 20px;
    align-items: stretch;
}

/* =========================================================
   CLASS GROUP CARD
========================================================= */

.student-class-group-card {
    position: relative;
    display: flex;
    flex-direction: column;
    min-width: 0;
    overflow: hidden;
    padding: 21px;
    border: 1px solid #e2e8f0;
    border-radius: 19px;
    background: #ffffff;
    box-shadow: 0 8px 24px rgba(15, 23, 42, 0.045);
    transition:
        transform 0.22s ease,
        border-color 0.22s ease,
        box-shadow 0.22s ease;
}

.student-class-group-card::before {
    content: "";
    position: absolute;
    top: 0;
    right: 0;
    left: 0;
    height: 4px;
    background: linear-gradient(
        90deg,
        #2563eb 0%,
        #60a5fa 50%,
        #a78bfa 100%
    );
}

.student-class-group-card:hover {
    border-color: #cbd5e1;
    transform: translateY(-4px);
    box-shadow: 0 15px 32px rgba(15, 23, 42, 0.085);
}

/* =========================================================
   CARD TOP
========================================================= */

.student-class-group-card-top {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 10px;
    margin-bottom: 21px;
}

.student-class-group-course-code {
    display: inline-flex;
    align-items: center;
    min-height: 28px;
    padding: 0 10px;
    border-radius: 8px;
    background: #eff6ff;
    color: #2563eb;
    font-size: 11px;
    font-weight: 800;
    letter-spacing: 0.045em;
    white-space: nowrap;
}

.student-class-group-status {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    min-height: 27px;
    padding: 0 9px;
    border-radius: 999px;
    font-size: 11px;
    font-weight: 700;
    white-space: nowrap;
}

.student-class-group-status-dot {
    width: 6px;
    height: 6px;
    border-radius: 50%;
    background: currentColor;
}

.student-class-group-status-active {
    background: #ecfdf5;
    color: #15803d;
}

.student-class-group-status-inactive {
    background: #f1f5f9;
    color: #64748b;
}

/* =========================================================
   CARD CONTENT
========================================================= */

.student-class-group-card-content {
    flex: 1;
}

.student-class-group-card-title {
    margin: 0;
    color: #172033;
    font-size: 20px;
    font-weight: 800;
    line-height: 1.3;
    letter-spacing: -0.3px;
    overflow-wrap: anywhere;
}

.student-class-group-card-course {
    margin: 8px 0 0;
    color: #475569;
    font-size: 13px;
    font-weight: 700;
    line-height: 1.5;
    overflow-wrap: anywhere;
}

.student-class-group-card-description {
    display: -webkit-box;
    overflow: hidden;
    margin: 13px 0 0;
    color: #64748b;
    font-size: 13px;
    line-height: 1.7;
    -webkit-box-orient: vertical;
    -webkit-line-clamp: 3;
}

/* =========================================================
   CARD DIVIDER
========================================================= */

.student-class-group-card-divider {
    height: 1px;
    margin: 22px 0 18px;
    background: #edf2f7;
}

/* =========================================================
   PROFESSOR INFO
========================================================= */

.student-class-group-professor {
    display: flex;
    align-items: center;
    gap: 9px;
    min-width: 0;
    margin-bottom: 20px;
}

.student-class-group-professor-icon {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 35px;
    height: 35px;
    flex-shrink: 0;
    border-radius: 10px;
    background: #f1f5f9;
    color: #64748b;
}

.student-class-group-professor-icon i {
    font-size: 18px;
}

.student-class-group-professor-content {
    display: flex;
    flex-direction: column;
    min-width: 0;
    gap: 3px;
}

.student-class-group-professor-content strong {
    overflow: hidden;
    color: #1e293b;
    font-size: 15px;
    font-weight: 800;
    line-height: 1.2;
    text-overflow: ellipsis;
    white-space: nowrap;
}

.student-class-group-professor-content span {
    color: #94a3b8;
    font-size: 10px;
    font-weight: 700;
    line-height: 1.2;
}

/* =========================================================
   OPEN CLASS BUTTON
========================================================= */

.student-class-group-open-button {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 12px;
    width: 100%;
    min-height: 42px;
    padding: 0 13px 0 15px;
    box-sizing: border-box;
    border: 1px solid #dbeafe;
    border-radius: 11px;
    background: #f8fbff;
    color: #2563eb;
    font-size: 12px;
    font-weight: 800;
    text-decoration: none;
    transition:
        background 0.2s ease,
        border-color 0.2s ease,
        color 0.2s ease,
        transform 0.2s ease;
}

.student-class-group-open-button i {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 25px;
    height: 25px;
    border-radius: 7px;
    background: #dbeafe;
    color: #2563eb;
    font-size: 17px;
    transition: transform 0.2s ease;
}

.student-class-group-open-button:hover {
    border-color: #bfdbfe;
    background: #eff6ff;
    color: #1d4ed8;
    transform: translateY(-1px);
}

.student-class-group-open-button:hover i {
    transform: translateX(3px);
}

/* =========================================================
   EMPTY STATE
========================================================= */

.student-class-group-empty {
    position: relative;
    grid-column: 1 / -1;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    min-height: 330px;
    padding: 45px 25px;
    overflow: hidden;
    border: 1px dashed #cbd5e1;
    border-radius: 20px;
    background: #ffffff;
    text-align: center;
}

.student-class-group-empty::before,
.student-class-group-empty::after {
    content: "";
    position: absolute;
    border: 1px solid #dbeafe;
    border-radius: 50%;
    pointer-events: none;
}

.student-class-group-empty::before {
    top: -75px;
    left: -55px;
    width: 190px;
    height: 190px;
}

.student-class-group-empty::after {
    right: -80px;
    bottom: -90px;
    width: 230px;
    height: 230px;
}

.student-class-group-empty-icon {
    position: relative;
    z-index: 1;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 70px;
    height: 70px;
    margin-bottom: 18px;
    border-radius: 20px;
    background: #eff6ff;
    color: #2563eb;
}

.student-class-group-empty-icon i {
    font-size: 32px;
}

.student-class-group-empty-title {
    position: relative;
    z-index: 1;
    margin: 0;
    color: #1e293b;
    font-size: 22px;
    font-weight: 800;
}

.student-class-group-empty-description {
    position: relative;
    z-index: 1;
    max-width: 380px;
    margin: 10px 0 22px;
    color: #64748b;
    font-size: 13px;
    line-height: 1.7;
}

.student-class-group-empty-button {
    position: relative;
    z-index: 1;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    min-height: 40px;
    padding: 0 15px;
    border-radius: 10px;
    background: #2563eb;
    color: #ffffff;
    font-size: 12px;
    font-weight: 700;
    text-decoration: none;
    transition:
        background 0.2s ease,
        transform 0.2s ease;
}

.student-class-group-empty-button:hover {
    background: #1d4ed8;
    color: #ffffff;
    transform: translateY(-2px);
}

/* =========================================================
   RESPONSIVE
========================================================= */

@media (max-width: 1100px) {
    .student-class-group-grid {
        grid-template-columns: repeat(2, minmax(0, 1fr));
    }
}

@media (max-width: 820px) {
    .student-class-group-page {
        padding: 24px 20px 35px;
    }

    .student-class-group-header {
        align-items: flex-start;
        flex-direction: column;
        gap: 20px;
    }

    .student-class-group-header-actions {
        width: 100%;
        justify-content: space-between;
    }

    .student-class-group-title {
        font-size: 32px;
    }
}

@media (max-width: 600px) {
    .student-class-group-page {
        padding: 20px 15px 30px;
    }

    .student-class-group-grid {
        grid-template-columns: 1fr;
        gap: 16px;
    }

    .student-class-group-card {
        padding: 19px;
    }

    .student-class-group-header-actions {
        align-items: stretch;
        flex-direction: column;
    }

    .student-class-group-summary,
    .student-class-group-join-button {
        justify-content: center;
        width: 100%;
        box-sizing: border-box;
    }

    .student-class-group-title {
        font-size: 29px;
    }

    .student-class-group-description {
        font-size: 13px;
    }
}

@media (max-width: 390px) {
    .student-class-group-card-top {
        align-items: flex-start;
        flex-direction: column;
    }
}
</style>

@extends('layouts.student_layout')

@section('content')

<div class="student-class-group-page">


{{-- =====================================================
     PAGE HEADER
====================================================== --}}

<div class="student-class-group-header">

    <div class="student-class-group-header-text">

        <span class="student-class-group-eyebrow">
            Student Dashboard
        </span>

        <h1 class="student-class-group-title">
            My Class Groups
        </h1>

        <p class="student-class-group-description">
            Access and view the classes you have joined.
        </p>

    </div>

    <div class="student-class-group-header-actions">

        {{-- CLASS COUNT --}}
        <div class="student-class-group-summary">

            <strong class="student-class-group-summary-number">
                {{ $classGroups->count() }}
            </strong>

            <span class="student-class-group-summary-label">
                {{ $classGroups->count() === 1 ? 'Class' : 'Classes' }}
            </span>

        </div>

        {{-- JOIN CLASS BUTTON --}}
        <a
            href="{{ route('student.class-groups.join') }}"
            class="student-class-group-join-button"
        >
            <i class="bx bx-plus"></i>

            <span>
                Join Class
            </span>
        </a>

    </div>

</div>


{{-- =====================================================
     CLASS GROUP GRID
====================================================== --}}

<div class="student-class-group-grid">

    @forelse ($classGroups as $classGroup)

        @php
            $classStatus = strtolower(
                (string) ($classGroup->status ?? 'inactive')
            );

            $classStatusLabel = ucfirst(
                str_replace('_', ' ', $classStatus)
            );
        @endphp

        <div class="student-class-group-card">

            {{-- CARD TOP --}}
            <div class="student-class-group-card-top">

                <span class="student-class-group-course-code">
                    {{ $classGroup->course->course_code }}
                </span>

                <span
                    class="
                        student-class-group-status
                        {{ $classStatus === 'active'
                            ? 'student-class-group-status-active'
                            : 'student-class-group-status-inactive'
                        }}
                    "
                >

                    <span class="student-class-group-status-dot"></span>

                    {{ $classStatusLabel }}

                </span>

            </div>


            {{-- CARD CONTENT --}}
            <div class="student-class-group-card-content">

                <h2 class="student-class-group-card-title">
                    {{ $classGroup->group_name }}
                </h2>

                <p class="student-class-group-card-course">
                    {{ $classGroup->course->course_name }}
                </p>

                <p class="student-class-group-card-description">
                    {{ $classGroup->description ?? 'No description available.' }}
                </p>

            </div>


            {{-- CARD DIVIDER --}}
            <div class="student-class-group-card-divider"></div>


            {{-- PROFESSOR --}}
            <div class="student-class-group-professor">

                <span class="student-class-group-professor-icon">
                    <i class="bx bx-user"></i>
                </span>

                <div class="student-class-group-professor-content">

                    <strong>
                        {{ $classGroup->professor->name ?? 'Professor' }}
                    </strong>

                    <span>
                        Professor
                    </span>

                </div>

            </div>


            {{-- OPEN CLASS --}}
            <a
                href="{{ route(
                    'student.class-groups.classroom-group',
                    ['classGroup' => $classGroup->id]
                ) }}"
                class="student-class-group-open-button"
            >

                <span>
                    Open Class Group
                </span>

                <i class="bx bx-right-arrow-alt"></i>

            </a>

        </div>

    @empty

        {{-- =================================================
             EMPTY STATE
        ================================================== --}}

        <div class="student-class-group-empty">

            <div class="student-class-group-empty-icon">
                <i class="bx bx-book-open"></i>
            </div>

            <h2 class="student-class-group-empty-title">
                No Class Groups
            </h2>

            <p class="student-class-group-empty-description">
                You have not joined any class groups yet.
            </p>

            <a
                href="{{ route('student.class-groups.join') }}"
                class="student-class-group-empty-button"
            >

                <i class="bx bx-plus"></i>

                Join Your First Class

            </a>

        </div>

    @endforelse

</div>


</div>

@endsection
