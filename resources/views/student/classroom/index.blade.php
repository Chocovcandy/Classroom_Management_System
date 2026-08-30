@extends('layouts.student_layout')

@section('title', $classGroup->group_name)

@section('content')

<div class="student-classroom">

    {{-- =====================================================
         HEADER
    ====================================================== --}}

    <div class="student-classroom-header">

        <div class="header-left">

            <span class="header-label">
                CLASSROOM
            </span>

            <h1>
                {{ $classGroup->group_name }}
            </h1>

            <p>
                Course classroom and learning materials
            </p>

        </div>

        <div class="header-icon">
            <i class="bx bx-book-open"></i>
        </div>

    </div>


    {{-- =====================================================
         NAVIGATION
    ====================================================== --}}

    <div class="classroom-tabs">

        <a href="#announcements" class="classroom-tab active">
            <i class="bx bx-megaphone"></i>
            Announcements
        </a>

        <a href="#materials" class="classroom-tab">
            <i class="bx bx-file"></i>
            Materials
        </a>

        <a href="#assignments" class="classroom-tab">
            <i class="bx bx-task"></i>
            Assignments
        </a>

    </div>


    {{-- =====================================================
         ANNOUNCEMENTS
    ====================================================== --}}

    <section
        id="announcements"
        class="student-section"
    >

        <div class="section-header">

            <div>

                <span class="section-label">
                    CLASS STREAM
                </span>

                <h2>
                    Announcements
                </h2>

            </div>

            <i class="bx bx-megaphone section-icon"></i>

        </div>


        @forelse($classGroup->announcements as $announcement)

            <article class="announcement-card">

                <div class="announcement-icon">
                    <i class="bx bx-megaphone"></i>
                </div>

                <div class="announcement-content">

                    <div class="announcement-top">

                        <h3>
                            {{ $announcement->title }}
                        </h3>

                        <span>
                            {{ $announcement->created_at->format('M d, Y') }}
                        </span>

                    </div>

                    <p>
                        {{ $announcement->content }}
                    </p>

                </div>

            </article>

        @empty

            <div class="empty-state">

                <i class="bx bx-megaphone"></i>

                <h3>
                    No announcements
                </h3>

                <p>
                    Your professor has not posted any announcements yet.
                </p>

            </div>

        @endforelse

    </section>


    {{-- =====================================================
         MATERIALS
    ====================================================== --}}

    <section
        id="materials"
        class="student-section"
    >

        <div class="section-header">

            <div>

                <span class="section-label">
                    LEARNING RESOURCES
                </span>

                <h2>
                    Materials
                </h2>

            </div>

            <i class="bx bx-file section-icon"></i>

        </div>


        @forelse($classGroup->materials as $material)

            <article class="resource-card">

                <div class="resource-icon">
                    <i class="bx bx-file"></i>
                </div>


                <div class="resource-content">

                    <h3>
                        {{ $material->title }}
                    </h3>

                    @if($material->description)

                        <p>
                            {{ $material->description }}
                        </p>

                    @endif

                    <span>
                        Added
                        {{ $material->created_at->format('M d, Y') }}
                    </span>

                </div>


                <a
                    href="{{ route('professor.class-groups.materials.download', $material) }}"
                    class="resource-button"
                >

                    <i class="bx bx-download"></i>

                    Download

                </a>

            </article>

        @empty

            <div class="empty-state">

                <i class="bx bx-file"></i>

                <h3>
                    No materials
                </h3>

                <p>
                    Your professor has not uploaded any materials yet.
                </p>

            </div>

        @endforelse

    </section>


    {{-- =====================================================
         ASSIGNMENTS
    ====================================================== --}}

    <section
        id="assignments"
        class="student-section"
    >

        <div class="section-header">

            <div>

                <span class="section-label">
                    COURSE WORK
                </span>

                <h2>
                    Assignments
                </h2>

            </div>

            <i class="bx bx-task section-icon"></i>

        </div>


        @forelse($classGroup->assignments as $assignment)

            <article class="resource-card assignment-card">

                <div class="resource-icon">
                    <i class="bx bx-task"></i>
                </div>


                <div class="resource-content">

                    <h3>
                        {{ $assignment->title }}
                    </h3>


                    @if($assignment->description)

                        <p>
                            {{ $assignment->description }}
                        </p>

                    @endif


                    @if($assignment->due_date)

                        <span class="due-date">

                            <i class="bx bx-time"></i>

                            Due:
                            {{ \Carbon\Carbon::parse($assignment->due_date)->format('M d, Y') }}

                        </span>

                    @endif

                </div>


                <a
                    href="#"
                    class="resource-button"
                >

                    <i class="bx bx-right-arrow-alt"></i>

                    View

                </a>

            </article>

        @empty

            <div class="empty-state">

                <i class="bx bx-task"></i>

                <h3>
                    No assignments
                </h3>

                <p>
                    Your professor has not created any assignments yet.
                </p>

            </div>

        @endforelse

    </section>

</div>


{{-- =====================================================
     CSS
====================================================== --}}

<style>

.student-classroom {
    width: 100%;
    max-width: 1500px;

    margin: 0 auto;

    padding: 28px 38px 40px;

    box-sizing: border-box;
}


/* =====================================================
   HEADER
===================================================== */

.student-classroom-header {

    min-height: 190px;

    padding: 32px 38px;

    display: flex;
    align-items: center;
    justify-content: space-between;

    border-radius: 18px;

    margin-bottom: 20px;

    background: linear-gradient(
        135deg,
        #1f2937,
        #374151
    );

    color: white;

    box-sizing: border-box;
}

.header-label {

    display: block;

    font-size: 11px;

    font-weight: 700;

    letter-spacing: 1.5px;

    opacity: .65;

    margin-bottom: 8px;
}

.student-classroom-header h1 {

    margin: 0;

    font-size: 30px;

    font-weight: 700;
}

.student-classroom-header p {

    margin: 8px 0 0;

    font-size: 14px;

    opacity: .7;
}

.header-icon {

    width: 70px;
    height: 70px;

    border-radius: 18px;

    display: flex;
    align-items: center;
    justify-content: center;

    background: rgba(255,255,255,.1);

    font-size: 34px;
}


/* =====================================================
   TABS
===================================================== */

.classroom-tabs {

    display: flex;

    gap: 8px;

    margin-bottom: 20px;

    padding: 5px;

    background: #f3f4f6;

    border-radius: 11px;

    width: fit-content;
}

.classroom-tab {

    display: inline-flex;

    align-items: center;

    gap: 7px;

    padding: 9px 15px;

    border-radius: 8px;

    color: #6b7280;

    text-decoration: none;

    font-size: 12px;

    font-weight: 600;

    transition: .2s;
}

.classroom-tab:hover {

    color: #111827;

    background: #e5e7eb;
}

.classroom-tab.active {

    color: #111827;

    background: white;

    box-shadow: 0 1px 4px rgba(0,0,0,.08);
}


/* =====================================================
   SECTION
===================================================== */

.student-section {

    background: white;

    border: 1px solid #e5e7eb;

    border-radius: 16px;

    padding: 24px;

    margin-bottom: 20px;

    box-shadow: 0 3px 12px rgba(0,0,0,.03);
}

.section-header {

    display: flex;

    align-items: center;

    justify-content: space-between;

    margin-bottom: 18px;
}

.section-label {

    display: block;

    font-size: 10px;

    font-weight: 700;

    letter-spacing: 1.2px;

    color: #9ca3af;

    margin-bottom: 4px;
}

.section-header h2 {

    margin: 0;

    font-size: 21px;

    color: #111827;
}

.section-icon {

    font-size: 25px;

    color: #9ca3af;
}


/* =====================================================
   ANNOUNCEMENT
===================================================== */

.announcement-card {

    display: flex;

    gap: 14px;

    padding: 17px;

    border: 1px solid #e5e7eb;

    border-radius: 11px;

    margin-bottom: 10px;
}

.announcement-icon {

    width: 42px;
    height: 42px;

    min-width: 42px;

    display: flex;
    align-items: center;
    justify-content: center;

    border-radius: 10px;

    background: #f3f4f6;

    color: #374151;

    font-size: 19px;
}

.announcement-content {

    flex: 1;
}

.announcement-top {

    display: flex;

    justify-content: space-between;

    gap: 15px;
}

.announcement-top h3 {

    margin: 0;

    font-size: 15px;

    color: #111827;
}

.announcement-top span {

    font-size: 11px;

    color: #9ca3af;

    white-space: nowrap;
}

.announcement-content p {

    margin: 7px 0 0;

    font-size: 13px;

    line-height: 1.6;

    color: #6b7280;
}


/* =====================================================
   RESOURCE
===================================================== */

.resource-card {

    display: flex;

    align-items: center;

    gap: 14px;

    padding: 15px;

    border: 1px solid #e5e7eb;

    border-radius: 11px;

    margin-bottom: 10px;

    transition: .2s;
}

.resource-card:hover {

    border-color: #d1d5db;

    box-shadow: 0 3px 10px rgba(0,0,0,.04);
}

.resource-icon {

    width: 44px;
    height: 44px;

    min-width: 44px;

    display: flex;
    align-items: center;
    justify-content: center;

    border-radius: 10px;

    background: #f3f4f6;

    color: #374151;

    font-size: 20px;
}

.resource-content {

    flex: 1;

    min-width: 0;
}

.resource-content h3 {

    margin: 0 0 4px;

    font-size: 15px;

    color: #111827;
}

.resource-content p {

    margin: 0 0 4px;

    font-size: 12px;

    color: #6b7280;
}

.resource-content span {

    font-size: 11px;

    color: #9ca3af;
}

.resource-button {

    display: inline-flex;

    align-items: center;
    justify-content: center;

    gap: 6px;

    padding: 8px 13px;

    border-radius: 8px;

    background: #f3f4f6;

    color: #374151;

    text-decoration: none;

    font-size: 12px;

    font-weight: 600;

    white-space: nowrap;

    transition: .2s;
}

.resource-button:hover {

    background: #e5e7eb;

    color: #111827;
}

.due-date {

    display: inline-flex;

    align-items: center;

    gap: 4px;
}


/* =====================================================
   EMPTY
===================================================== */

.empty-state {

    min-height: 130px;

    display: flex;

    flex-direction: column;

    align-items: center;

    justify-content: center;

    color: #9ca3af;

    text-align: center;
}

.empty-state i {

    font-size: 28px;

    margin-bottom: 7px;
}

.empty-state h3 {

    margin: 0 0 3px;

    font-size: 14px;

    color: #6b7280;
}

.empty-state p {

    margin: 0;

    font-size: 12px;
}


/* =====================================================
   RESPONSIVE
===================================================== */

@media(max-width: 700px) {

    .student-classroom {

        padding: 20px;
    }

    .student-classroom-header {

        padding: 25px;

    }

    .student-classroom-header h1 {

        font-size: 24px;
    }

    .header-icon {

        display: none;
    }

    .classroom-tabs {

        width: 100%;

        overflow-x: auto;
    }

    .classroom-tab {

        white-space: nowrap;
    }

    .resource-card {

        flex-wrap: wrap;

    }

    .resource-button {

        margin-left: 58px;
    }

    .announcement-top {

        flex-direction: column;

        gap: 3px;
    }

}

</style>

@endsection