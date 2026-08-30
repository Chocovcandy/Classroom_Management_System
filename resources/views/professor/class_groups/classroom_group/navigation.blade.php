{{-- ============================================================
     CLASSROOM NAVIGATION
     ============================================================ --}}

<nav class="classroom-nav">

    {{-- STREAM --}}
    <a
        href="{{ route(
            'professor.class-groups.classroom-group',
            ['classGroup' => $classGroup->id]
        ) }}"
        class="classroom-nav-item {{ request()->routeIs('professor.class-groups.classroom-group') ? 'active' : '' }}"
    >
        <i class="bx bx-home-alt"></i>

        <span>
            Stream
        </span>
    </a>


    {{-- CLASSWORK --}}
    <a
        href="{{ route(
            'professor.class-groups.classroom-group.classwork',
            ['classGroup' => $classGroup->id]
        ) }}"
        class="classroom-nav-item {{ request()->routeIs('professor.class-groups.classroom-group.classwork') ? 'active' : '' }}"
    >
        <i class="bx bx-book-open"></i>

        <span>
            Classwork
        </span>
    </a>


    {{-- MARKS --}}
    <a
        href="#"
        class="classroom-nav-item"
    >
        <i class="bx bx-bar-chart-alt-2"></i>

        <span>
            Marks
        </span>
    </a>


    {{-- STUDENTS --}}
        <a
            href="{{ route('professor.class-groups.classroom-group.students', $classGroup) }}"
           class="classroom-nav-item {{ request()->routeIs('professor.class-groups.classroom-group.students') ? 'active' : '' }}"
        >
            <i class="bx bx-group"></i>
            Students
        </a>

</nav>