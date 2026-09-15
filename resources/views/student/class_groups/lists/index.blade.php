<styel>
    
</styel>

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
                My Class Groups
            </h1>

            <p>
                Access and view the classes you have joined.
            </p>

        </div>


        <div class="cg-header-actions">

            {{-- CLASS COUNT --}}

            <div class="cg-summary-chip">

                <strong>
                    {{ $classGroups->count() }}
                </strong>

                <span>
                    {{ $classGroups->count() === 1 ? 'Class' : 'Classes' }}
                </span>

            </div>


            {{-- JOIN CLASS BUTTON --}}

            <a
                href="{{ route('student.class-groups.join') }}"
                class="cg-create-btn"
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

    <div class="cg-grid">

        @forelse ($classGroups as $classGroup)

            <div class="cg-card">

                {{-- TOP --}}
                <div class="cg-card-top">

                    <span class="cg-code-tag">
                        {{ $classGroup->course->course_code }}
                    </span>

                    <span
                        class="cg-status
                        {{ $classGroup->status === 'active'
                            ? 'cg-status-active'
                            : 'cg-status-inactive' }}"
                    >

                        <i></i>

                        {{ ucfirst($classGroup->status) }}

                    </span>

                </div>


                {{-- CLASS NAME --}}

                <h2 class="cg-card-title">
                    {{ $classGroup->group_name }}
                </h2>


                {{-- COURSE --}}

                <p class="cg-card-subtitle">
                    {{ $classGroup->course->course_name }}
                </p>


                {{-- DESCRIPTION --}}

                <p class="cg-card-desc">

                    {{ $classGroup->description
                        ?? 'No description available.' }}

                </p>


                <div class="cg-card-divider"></div>


                {{-- STATS --}}

                <div class="cg-card-stats">

                    {{-- PROFESSOR --}}

                    <div class="cg-mini-stat">

                        <span class="cg-mini-stat-icon">
                            👨‍🏫
                        </span>

                        <div>

                            <strong>
                                {{ $classGroup->professor->name ?? 'Professor' }}
                            </strong>

                            <span>
                                Professor
                            </span>

                        </div>

                    </div>



                </div>


                {{-- OPEN CLASS --}}

                <a
                    href="{{ route(
                        'student.class-groups.classroom-group',
                        ['classGroup' => $classGroup->id]
                    ) }}"
                    class="cg-open-btn"
                >

                    Open Class Group

                    <i class="bx bx-right-arrow-alt"></i>

                </a>

            </div>


        @empty

            {{-- =================================================
                 EMPTY STATE
            ================================================== --}}

            <div class="cg-empty">

                <div class="cg-empty-icon">
                    📚
                </div>

                <h2>
                    No Class Groups
                </h2>

                <p>
                    You have not joined any class groups yet.
                </p>

                <a
                    href="{{ route('student.class-groups.join') }}"
                    class="cg-create-btn"
                >

                    <i class="bx bx-plus"></i>

                    Join Your First Class

                </a>

            </div>

        @endforelse

    </div>

</div>

@endsection