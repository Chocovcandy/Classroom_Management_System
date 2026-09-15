{{-- ============================================================
     CLASSROOM NAVIGATION
     ============================================================ --}}

<nav class="classroom-nav">

    {{-- STREAM --}}
    <a
        href="{{ route(
            'student.class-groups.classroom-group',
            ['classGroup' => $classGroup->id]
        ) }}"
        class="classroom-nav-item {{ request()->routeIs('student.class-groups.classroom-group') ? 'active' : '' }}"
    >
        <i class="bx bx-home-alt"></i>

        <span>
            Stream
        </span>
    </a>


    {{-- CLASSWORK --}}
    <a
        href="{{ route(
            'student.class-groups.classroom-group.classwork',
            ['classGroup' => $classGroup->id]
        ) }}"
        class="classroom-nav-item {{ request()->routeIs('student.class-groups.classroom-group.classwork') ? 'active' : '' }}"
    >
        <i class="bx bx-book-open"></i>

        <span>
            Classwork
        </span>
    </a>


    {{-- MARKS --}}
{{-- MARKS --}}

<a
    href="{{ route(
        'student.class-groups.marks',
        ['classGroup' => $classGroup->id]
    ) }}"
    class="classroom-nav-item {{ request()->routeIs('student.class-groups.marks') ? 'active' : '' }}"
>
    <i class="bx bx-bar-chart-alt-2"></i>

    <span>
        Marks
    </span>
</a>



</nav>