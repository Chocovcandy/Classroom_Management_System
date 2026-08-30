@extends('layouts.prof_layout')

@section('content')

<div class="cg-page">

    {{-- =====================================================
         PAGE HEADER
    ====================================================== --}}

{{-- =====================================================
     PAGE HEADER
====================================================== --}}

<div class="cg-header">

    <div class="cg-header-text">

        <span class="cg-eyebrow">
            Professor Dashboard
        </span>

        <h1>
            My Class Groups
        </h1>

        <p>
            Manage and access the classes you are teaching.
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


        {{-- CREATE CLASS BUTTON --}}

        <a
            href="{{ route('professor.class-groups.create') }}"
            class="cg-create-btn"
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

    <div class="cg-grid">

        @forelse ($classGroups as $classGroup)

            <div class="cg-card">

                {{-- Top accent bar is pure CSS, no markup needed --}}

                <div class="cg-card-top">
                    <span class="cg-code-tag">{{ $classGroup->course->course_code }}</span>

                    <span class="cg-status {{ $classGroup->status === 'active' ? 'cg-status-active' : 'cg-status-inactive' }}">
                        <i></i>
                        {{ ucfirst($classGroup->status) }}
                    </span>
                </div>

                <h2 class="cg-card-title">{{ $classGroup->group_name }}</h2>
                <p class="cg-card-subtitle">{{ $classGroup->course->course_name }}</p>

                <p class="cg-card-desc">
                    {{ $classGroup->description ?? 'No description available.' }}
                </p>

                <div class="cg-card-divider"></div>

                <div class="cg-card-stats">

                    <div class="cg-mini-stat">
                        <span class="cg-mini-stat-icon">&#128101;</span>
                        <div>
                            <strong>{{ $classGroup->students->count() }}</strong>
                            <span>Students</span>
                        </div>
                    </div>

                    <div class="cg-mini-stat">
                        <span class="cg-mini-stat-icon">&#127991;</span>
                        <div>
                            <strong class="cg-code">{{ $classGroup->group_code }}</strong>
                            <span>Class Code</span>
                        </div>
                    </div>

                </div>

    <a href="{{ route(
        'professor.class-groups.classroom-group',
        ['classGroup' => $classGroup->id]
    ) }}"
    class="cg-open-btn">

        Open Class Group

        <i class="bx bx-right-arrow-alt"></i>

    </a>

            </div>

        @empty

            {{-- =================================================
                 EMPTY STATE
            ================================================== --}}

            <div class="cg-empty">
                <div class="cg-empty-icon">&#128218;</div>
                <h2>No Class Groups</h2>
                <p>You currently don't have any class groups assigned to you.</p>
            </div>

        @endforelse

    </div>

</div>

@endsection