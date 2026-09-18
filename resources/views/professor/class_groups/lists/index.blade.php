<style>
    /* =========================================================
   PROFESSOR CLASS GROUPS PAGE
   Unique prefix: prof-class-group-
========================================================= */

.prof-class-group-page {
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

.prof-class-group-header {
    display: flex;
    align-items: flex-end;
    justify-content: space-between;
    gap: 28px;
    margin-bottom: 30px;
}

.prof-class-group-header-text {
    min-width: 0;
}

.prof-class-group-eyebrow {
    display: inline-flex;
    align-items: center;
    margin-bottom: 8px;
    color: #64748b;
    font-size: 12px;
    font-weight: 700;
    letter-spacing: 0.09em;
    text-transform: uppercase;
}

.prof-class-group-title {
    margin: 0;
    color: #172033;
    font-size: clamp(28px, 3vw, 38px);
    font-weight: 800;
    line-height: 1.15;
    letter-spacing: -0.8px;
}

.prof-class-group-description {
    max-width: 520px;
    margin: 12px 0 0;
    color: #64748b;
    font-size: 14px;
    line-height: 1.7;
}

.prof-class-group-header-actions {
    display: flex;
    align-items: center;
    justify-content: flex-end;
    gap: 12px;
    flex-shrink: 0;
}


/* =========================================================
   CLASS SUMMARY
========================================================= */

.prof-class-group-summary {
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

.prof-class-group-summary-number {
    color: #2563eb;
    font-size: 19px;
    font-weight: 800;
    line-height: 1;
}

.prof-class-group-summary-label {
    color: #64748b;
    font-size: 13px;
    font-weight: 600;
}


/* =========================================================
   CREATE CLASS BUTTON
========================================================= */

.prof-class-group-create-button {
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

.prof-class-group-create-button i {
    font-size: 18px;
}

.prof-class-group-create-button:hover {
    background: #1d4ed8;
    border-color: #1d4ed8;
    color: #ffffff;
    transform: translateY(-2px);
    box-shadow: 0 10px 20px rgba(37, 99, 235, 0.24);
}


/* =========================================================
   CLASS GROUP GRID
========================================================= */

.prof-class-group-grid {
    display: grid;
    grid-template-columns: repeat(3, minmax(0, 1fr));
    gap: 20px;
    align-items: stretch;
}


/* =========================================================
   CLASS GROUP CARD
========================================================= */

.prof-class-group-card {
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

.prof-class-group-card::before {
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

.prof-class-group-card:hover {
    border-color: #cbd5e1;
    transform: translateY(-4px);
    box-shadow: 0 15px 32px rgba(15, 23, 42, 0.085);
}


/* =========================================================
   CARD TOP
========================================================= */

.prof-class-group-card-top {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 10px;
    margin-bottom: 21px;
}

.prof-class-group-course-code {
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

.prof-class-group-status {
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

.prof-class-group-status-dot {
    width: 6px;
    height: 6px;
    border-radius: 50%;
    background: currentColor;
}

.prof-class-group-status-active {
    background: #ecfdf5;
    color: #15803d;
}

.prof-class-group-status-inactive {
    background: #f1f5f9;
    color: #64748b;
}


/* =========================================================
   CARD CONTENT
========================================================= */

.prof-class-group-card-content {
    flex: 1;
}

.prof-class-group-card-title {
    margin: 0;
    color: #172033;
    font-size: 20px;
    font-weight: 800;
    line-height: 1.3;
    letter-spacing: -0.3px;
    overflow-wrap: anywhere;
}

.prof-class-group-card-course {
    margin: 8px 0 0;
    color: #475569;
    font-size: 13px;
    font-weight: 700;
    line-height: 1.5;
    overflow-wrap: anywhere;
}

.prof-class-group-card-description {
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

.prof-class-group-card-divider {
    height: 1px;
    margin: 22px 0 18px;
    background: #edf2f7;
}


/* =========================================================
   CARD STATS
========================================================= */

.prof-class-group-card-stats {
    display: grid;
    grid-template-columns: repeat(2, minmax(0, 1fr));
    gap: 12px;
    margin-bottom: 20px;
}

.prof-class-group-stat {
    display: flex;
    align-items: center;
    gap: 9px;
    min-width: 0;
}

.prof-class-group-stat-icon {
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

.prof-class-group-stat-icon i {
    font-size: 18px;
}

.prof-class-group-stat-content {
    display: flex;
    flex-direction: column;
    min-width: 0;
    gap: 3px;
}

.prof-class-group-stat-content strong {
    overflow: hidden;
    color: #1e293b;
    font-size: 15px;
    font-weight: 800;
    line-height: 1.2;
    text-overflow: ellipsis;
    white-space: nowrap;
}

.prof-class-group-stat-content span {
    color: #94a3b8;
    font-size: 10px;
    font-weight: 700;
    line-height: 1.2;
}

.prof-class-group-code {
    max-width: 100%;
    color: #2563eb !important;
    font-size: 12px !important;
}


/* =========================================================
   OPEN CLASS BUTTON
========================================================= */

.prof-class-group-open-button {
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

.prof-class-group-open-button i {
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

.prof-class-group-open-button:hover {
    border-color: #bfdbfe;
    background: #eff6ff;
    color: #1d4ed8;
    transform: translateY(-1px);
}

.prof-class-group-open-button:hover i {
    transform: translateX(3px);
}


/* =========================================================
   EMPTY STATE
========================================================= */

.prof-class-group-empty {
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

.prof-class-group-empty::before,
.prof-class-group-empty::after {
    content: "";
    position: absolute;
    border: 1px solid #dbeafe;
    border-radius: 50%;
    pointer-events: none;
}

.prof-class-group-empty::before {
    top: -75px;
    left: -55px;
    width: 190px;
    height: 190px;
}

.prof-class-group-empty::after {
    right: -80px;
    bottom: -90px;
    width: 230px;
    height: 230px;
}

.prof-class-group-empty-icon {
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

.prof-class-group-empty-icon i {
    font-size: 32px;
}

.prof-class-group-empty-title {
    position: relative;
    z-index: 1;
    margin: 0;
    color: #1e293b;
    font-size: 22px;
    font-weight: 800;
}

.prof-class-group-empty-description {
    position: relative;
    z-index: 1;
    max-width: 380px;
    margin: 10px 0 22px;
    color: #64748b;
    font-size: 13px;
    line-height: 1.7;
}

.prof-class-group-empty-button {
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

.prof-class-group-empty-button:hover {
    background: #1d4ed8;
    color: #ffffff;
    transform: translateY(-2px);
}


/* =========================================================
   RESPONSIVE DESIGN
========================================================= */

@media (max-width: 1100px) {
    .prof-class-group-grid {
        grid-template-columns: repeat(2, minmax(0, 1fr));
    }
}

@media (max-width: 820px) {
    .prof-class-group-page {
        padding: 24px 20px 35px;
    }

    .prof-class-group-header {
        align-items: flex-start;
        flex-direction: column;
        gap: 20px;
    }

    .prof-class-group-header-actions {
        width: 100%;
        justify-content: space-between;
    }

    .prof-class-group-title {
        font-size: 32px;
    }
}

@media (max-width: 600px) {
    .prof-class-group-page {
        padding: 20px 15px 30px;
    }

    .prof-class-group-grid {
        grid-template-columns: 1fr;
        gap: 16px;
    }

    .prof-class-group-card {
        padding: 19px;
    }

    .prof-class-group-header-actions {
        align-items: stretch;
        flex-direction: column;
    }

    .prof-class-group-summary,
    .prof-class-group-create-button {
        justify-content: center;
        width: 100%;
        box-sizing: border-box;
    }

    .prof-class-group-title {
        font-size: 29px;
    }

    .prof-class-group-description {
        font-size: 13px;
    }
}

@media (max-width: 390px) {
    .prof-class-group-card-top {
        align-items: flex-start;
        flex-direction: column;
    }

    .prof-class-group-card-stats {
        gap: 8px;
    }

    .prof-class-group-stat {
        gap: 7px;
    }

    .prof-class-group-stat-icon {
        width: 32px;
        height: 32px;
    }

    .prof-class-group-stat-content strong {
        font-size: 14px;
    }
}


/* =========================================================
   OPTIONAL DARK MODE
========================================================= */

body.dark-mode .prof-class-group-page,
body.dark .prof-class-group-page,
body[data-theme="dark"] .prof-class-group-page {
    color: #e2e8f0;
}

body.dark-mode .prof-class-group-title,
body.dark .prof-class-group-title,
body[data-theme="dark"] .prof-class-group-title {
    color: #f8fafc;
}

body.dark-mode .prof-class-group-description,
body.dark .prof-class-group-description,
body[data-theme="dark"] .prof-class-group-description,
body.dark-mode .prof-class-group-eyebrow,
body.dark .prof-class-group-eyebrow,
body[data-theme="dark"] .prof-class-group-eyebrow {
    color: #94a3b8;
}

body.dark-mode .prof-class-group-summary,
body.dark .prof-class-group-summary,
body[data-theme="dark"] .prof-class-group-summary,
body.dark-mode .prof-class-group-card,
body.dark .prof-class-group-card,
body[data-theme="dark"] .prof-class-group-card,
body.dark-mode .prof-class-group-empty,
body.dark .prof-class-group-empty,
body[data-theme="dark"] .prof-class-group-empty {
    border-color: #334155;
    background: #111827;
    box-shadow: none;
}

body.dark-mode .prof-class-group-card-title,
body.dark .prof-class-group-card-title,
body[data-theme="dark"] .prof-class-group-card-title,
body.dark-mode .prof-class-group-stat-content strong,
body.dark .prof-class-group-stat-content strong,
body[data-theme="dark"] .prof-class-group-stat-content strong,
body.dark-mode .prof-class-group-empty-title,
body.dark .prof-class-group-empty-title,
body[data-theme="dark"] .prof-class-group-empty-title {
    color: #f8fafc;
}

body.dark-mode .prof-class-group-card-course,
body.dark .prof-class-group-card-course,
body[data-theme="dark"] .prof-class-group-card-course {
    color: #cbd5e1;
}

body.dark-mode .prof-class-group-card-description,
body.dark .prof-class-group-card-description,
body[data-theme="dark"] .prof-class-group-card-description,
body.dark-mode .prof-class-group-empty-description,
body.dark .prof-class-group-empty-description,
body[data-theme="dark"] .prof-class-group-empty-description {
    color: #94a3b8;
}

body.dark-mode .prof-class-group-card-divider,
body.dark .prof-class-group-card-divider,
body[data-theme="dark"] .prof-class-group-card-divider {
    background: #334155;
}

body.dark-mode .prof-class-group-stat-icon,
body.dark .prof-class-group-stat-icon,
body[data-theme="dark"] .prof-class-group-stat-icon {
    background: #1e293b;
    color: #94a3b8;
}

body.dark-mode .prof-class-group-open-button,
body.dark .prof-class-group-open-button,
body[data-theme="dark"] .prof-class-group-open-button {
    border-color: #1e40af;
    background: #172554;
    color: #93c5fd;
}

body.dark-mode .prof-class-group-open-button i,
body.dark .prof-class-group-open-button i,
body[data-theme="dark"] .prof-class-group-open-button i {
    background: #1e3a8a;
    color: #bfdbfe;
}

body.dark-mode .prof-class-group-empty,
body.dark .prof-class-group-empty,
body[data-theme="dark"] .prof-class-group-empty {
    border-color: #475569;
}

body.dark-mode .prof-class-group-empty-icon,
body.dark .prof-class-group-empty-icon,
body[data-theme="dark"] .prof-class-group-empty-icon {
    background: #172554;
    color: #93c5fd;
}
</style>
@extends('layouts.prof_layout')

@section('content')

<div class="prof-class-group-page">

    {{-- =====================================================
         PAGE HEADER
    ====================================================== --}}

    <div class="prof-class-group-header">

        <div class="prof-class-group-header-text">

            <span class="prof-class-group-eyebrow">
                Professor Dashboard
            </span>

            <h1 class="prof-class-group-title">
                My Class Groups
            </h1>

            <p class="prof-class-group-description">
                Manage and access the classes you are teaching.
            </p>

        </div>

        <div class="prof-class-group-header-actions">

            {{-- CLASS COUNT --}}
            <div class="prof-class-group-summary">

                <strong class="prof-class-group-summary-number">
                    {{ $classGroups->count() }}
                </strong>

                <span class="prof-class-group-summary-label">
                    {{ $classGroups->count() === 1 ? 'Class' : 'Classes' }}
                </span>

            </div>

            {{-- CREATE CLASS BUTTON --}}
            <a
                href="{{ route('professor.class-groups.create') }}"
                class="prof-class-group-create-button"
            >

                <i class="bx bx-plus"></i>

                <span>
                    Create Class
                </span>

            </a>

        </div>

    </div>


    {{-- =====================================================
         CLASS GROUP GRID
    ====================================================== --}}

    <div class="prof-class-group-grid">

        @forelse ($classGroups as $classGroup)

            @php
                $classStatus = strtolower((string) ($classGroup->status ?? 'inactive'));

                $classStatusLabel = ucfirst(
                    str_replace('_', ' ', $classStatus)
                );

                $classStudentCount = $classGroup->students->count();
            @endphp

            <div class="prof-class-group-card">

                {{-- CARD TOP --}}
                <div class="prof-class-group-card-top">

                    <span class="prof-class-group-course-code">
                        {{ $classGroup->course->course_code }}
                    </span>

                    <span
                        class="
                            prof-class-group-status
                            {{ $classStatus === 'active'
                                ? 'prof-class-group-status-active'
                                : 'prof-class-group-status-inactive'
                            }}
                        "
                    >

                        <span class="prof-class-group-status-dot"></span>

                        {{ $classStatusLabel }}

                    </span>

                </div>


                {{-- CARD CONTENT --}}
                <div class="prof-class-group-card-content">

                    <h2 class="prof-class-group-card-title">
                        {{ $classGroup->group_name }}
                    </h2>

                    <p class="prof-class-group-card-course">
                        {{ $classGroup->course->course_name }}
                    </p>

                    <p class="prof-class-group-card-description">
                        {{ $classGroup->description ?? 'No description available.' }}
                    </p>

                </div>


                {{-- CARD DIVIDER --}}
                <div class="prof-class-group-card-divider"></div>


                {{-- CARD STATS --}}
                <div class="prof-class-group-card-stats">

                    <div class="prof-class-group-stat">

                        <span class="prof-class-group-stat-icon">
                            <i class="bx bx-group"></i>
                        </span>

                        <div class="prof-class-group-stat-content">

                            <strong>
                                {{ $classStudentCount }}
                            </strong>

                            <span>
                                Students
                            </span>

                        </div>

                    </div>


                    <div class="prof-class-group-stat">

                        <span class="prof-class-group-stat-icon">
                            <i class="bx bx-purchase-tag"></i>
                        </span>

                        <div class="prof-class-group-stat-content">

                            <strong class="prof-class-group-code">
                                {{ $classGroup->group_code }}
                            </strong>

                            <span>
                                Class Code
                            </span>

                        </div>

                    </div>

                </div>


                {{-- OPEN CLASS BUTTON --}}
                <a
                    href="{{ route(
                        'professor.class-groups.classroom-group',
                        ['classGroup' => $classGroup->id]
                    ) }}"
                    class="prof-class-group-open-button"
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

            <div class="prof-class-group-empty">

                <div class="prof-class-group-empty-icon">
                    <i class="bx bx-book-open"></i>
                </div>

                <h2 class="prof-class-group-empty-title">
                    No Class Groups
                </h2>

                <p class="prof-class-group-empty-description">
                    You currently don't have any class groups assigned to you.
                </p>

                <a
                    href="{{ route('professor.class-groups.create') }}"
                    class="prof-class-group-empty-button"
                >

                    <i class="bx bx-plus"></i>

                    Create Your First Class

                </a>

            </div>

        @endforelse

    </div>

</div>

@endsection