@extends('layouts.prof_layout')

@section('title', 'Team Details')

@section('content')

<style>
    /* ============================================================
       TEAM SHOW PAGE
       ============================================================ */

    .team-show-page {
        width: 100%;
        max-width: 1200px;
        margin: 0 auto;
        padding: 30px 24px 60px;
    }

    /* ============================================================
       HEADER
       ============================================================ */

    .team-show-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 20px;
        margin-bottom: 24px;
    }

    .team-show-header-left {
        display: flex;
        align-items: center;
        gap: 15px;
        min-width: 0;
    }

    .team-show-icon {
        width: 54px;
        height: 54px;
        min-width: 54px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 15px;
        background: #fef3c7;
        color: #d97706;
        font-size: 25px;
    }

    .team-show-kicker {
        display: block;
        margin-bottom: 4px;
        color: #b45309;
        font-size: 11px;
        font-weight: 800;
        letter-spacing: 1.1px;
        text-transform: uppercase;
    }

    .team-show-header h1 {
        margin: 0;
        color: #111827;
        font-size: 27px;
        font-weight: 750;
        line-height: 1.2;
    }

    .team-show-header p {
        margin: 5px 0 0;
        color: #6b7280;
        font-size: 14px;
    }

    .team-show-back {
        display: inline-flex;
        align-items: center;
        gap: 7px;
        flex-shrink: 0;
        padding: 10px 15px;
        border: 1px solid #e5e7eb;
        border-radius: 10px;
        background: #ffffff;
        color: #4b5563;
        text-decoration: none;
        font-size: 13px;
        font-weight: 650;
        transition: .2s ease;
    }

    .team-show-back:hover {
        border-color: #d1d5db;
        color: #111827;
        transform: translateY(-1px);
    }

    /* ============================================================
       SUMMARY
       ============================================================ */

    .team-summary-grid {
        display: grid;
        grid-template-columns: 1.5fr 1fr 1fr;
        gap: 16px;
        margin-bottom: 20px;
    }

    .team-summary-card {
        padding: 20px;
        border: 1px solid #e5e7eb;
        border-radius: 15px;
        background: #ffffff;
        box-shadow: 0 3px 14px rgba(0, 0, 0, .035);
    }

    .team-summary-label {
        display: block;
        margin-bottom: 7px;
        color: #9ca3af;
        font-size: 10px;
        font-weight: 800;
        letter-spacing: 1px;
        text-transform: uppercase;
    }

    .team-summary-value {
        color: #111827;
        font-size: 17px;
        font-weight: 700;
        line-height: 1.4;
    }

    .team-summary-value small {
        color: #6b7280;
        font-size: 12px;
        font-weight: 500;
    }

    /* ============================================================
       TEAM CARD
       ============================================================ */

    .team-card {
        overflow: hidden;
        border: 1px solid #e5e7eb;
        border-radius: 18px;
        background: #ffffff;
        box-shadow: 0 5px 18px rgba(0, 0, 0, .035);
    }

    .team-card-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 18px;
        padding: 22px 24px;
        border-bottom: 1px solid #eef2f7;
        background: #ffffff;
    }

    .team-card-title {
        display: flex;
        align-items: center;
        gap: 13px;
        min-width: 0;
    }

    .team-number {
        width: 44px;
        height: 44px;
        min-width: 44px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 12px;
        background: rgba(245, 158, 11, .13);
        color: #b77900;
        font-size: 17px;
        font-weight: 800;
    }

    .team-card-title h2 {
        margin: 0;
        color: #111827;
        font-size: 19px;
        font-weight: 800;
    }

    .team-card-title p {
        margin: 3px 0 0;
        color: #6b7280;
        font-size: 12px;
    }

    .team-status {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 7px 10px;
        border-radius: 20px;
        background: #fef3c7;
        color: #92400e;
        font-size: 11px;
        font-weight: 700;
        white-space: nowrap;
    }

    /* ============================================================
       TEAM RESPONSIBILITIES
       ============================================================ */

    .team-responsibilities {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 14px;
        padding: 20px 24px;
        border-bottom: 1px solid #eef2f7;
        background: #fafafa;
    }

    .responsibility-card {
        display: flex;
        align-items: center;
        gap: 12px;
        min-width: 0;
        padding: 14px;
        border: 1px solid #e5e7eb;
        border-radius: 12px;
        background: #ffffff;
    }

    .responsibility-icon {
        width: 38px;
        height: 38px;
        min-width: 38px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 10px;
        background: #fef3c7;
        color: #d97706;
        font-size: 18px;
    }

    .responsibility-info {
        min-width: 0;
    }

    .responsibility-label {
        display: block;
        margin-bottom: 3px;
        color: #9ca3af;
        font-size: 9px;
        font-weight: 800;
        letter-spacing: .8px;
        text-transform: uppercase;
    }

    .responsibility-name {
        display: block;
        overflow: hidden;
        color: #374151;
        font-size: 13px;
        font-weight: 700;
        white-space: nowrap;
        text-overflow: ellipsis;
    }

    /* ============================================================
       MEMBERS
       ============================================================ */

    .team-members-section {
        padding: 24px;
    }

    .team-members-heading {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 15px;
        margin-bottom: 17px;
    }

    .team-members-heading h3 {
        margin: 0;
        color: #111827;
        font-size: 17px;
        font-weight: 750;
    }

    .team-members-count {
        padding: 5px 9px;
        border-radius: 20px;
        background: #f3f4f6;
        color: #4b5563;
        font-size: 11px;
        font-weight: 700;
    }

    .team-members-list {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 10px;
    }

    .team-member {
        display: flex;
        align-items: center;
        gap: 12px;
        min-width: 0;
        padding: 13px;
        border: 1px solid #eef2f7;
        border-radius: 12px;
        background: #fafafa;
        transition: .2s ease;
    }

    .team-member:hover {
        border-color: #e5e7eb;
        transform: translateY(-1px);
    }

    .team-member-avatar {
        width: 42px;
        height: 42px;
        min-width: 42px;
        overflow: hidden;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        background: #fef3c7;
        color: #b77900;
        font-size: 14px;
        font-weight: 800;
    }

    .team-member-avatar img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .team-member-info {
        min-width: 0;
        flex: 1;
    }

    .team-member-name {
        display: block;
        overflow: hidden;
        margin-bottom: 5px;
        color: #374151;
        font-size: 13px;
        font-weight: 700;
        white-space: nowrap;
        text-overflow: ellipsis;
    }

    .team-member-role {
        display: inline-flex;
        align-items: center;
        gap: 4px;
        padding: 3px 7px;
        border-radius: 6px;
        font-size: 10px;
        font-weight: 700;
    }

    .team-member-role.leader {
        background: rgba(245, 158, 11, .13);
        color: #b77900;
    }

    .team-member-role.backup {
        background: rgba(100, 116, 139, .10);
        color: #64748b;
    }

    .team-member-role.member {
        background: #f3f4f6;
        color: #6b7280;
    }

    /* ============================================================
       EMPTY STATE
       ============================================================ */

    .team-empty {
        padding: 50px 20px;
        text-align: center;
        color: #9ca3af;
    }

    .team-empty i {
        display: block;
        margin-bottom: 10px;
        font-size: 38px;
    }

    .team-empty p {
        margin: 0;
        font-size: 13px;
    }

    /* ============================================================
       FOOTER NOTE
       ============================================================ */

    .team-card-footer {
        display: flex;
        align-items: center;
        gap: 8px;
        padding: 14px 24px;
        border-top: 1px solid #eef2f7;
        background: #fffbeb;
        color: #6b7280;
        font-size: 12px;
    }

    .team-card-footer i {
        color: #d97706;
        font-size: 17px;
    }

    /* ============================================================
       DARK MODE
       ============================================================ */

    body.dark-mode .team-show-header h1,
    body.dark-mode .team-summary-value,
    body.dark-mode .team-card-title h2,
    body.dark-mode .team-members-heading h3,
    body.dark-mode .team-member-name {
        color: #f3f4f6;
    }

    body.dark-mode .team-show-header p,
    body.dark-mode .team-summary-value small,
    body.dark-mode .team-card-title p,
    body.dark-mode .responsibility-label {
        color: #9ca3af;
    }

    body.dark-mode .team-show-back,
    body.dark-mode .team-summary-card,
    body.dark-mode .team-card,
    body.dark-mode .team-card-header,
    body.dark-mode .responsibility-card {
        border-color: #374151;
        background: #1f2937;
    }

    body.dark-mode .team-show-back {
        color: #d1d5db;
    }

    body.dark-mode .team-show-back:hover {
        color: #ffffff;
        border-color: #4b5563;
    }

    body.dark-mode .team-responsibilities {
        border-color: #374151;
        background: #111827;
    }

    body.dark-mode .team-member {
        border-color: #374151;
        background: #111827;
    }

    body.dark-mode .team-member:hover {
        border-color: #4b5563;
    }

    body.dark-mode .team-member-name {
        color: #e5e7eb;
    }

    body.dark-mode .team-member-role.member,
    body.dark-mode .team-members-count {
        background: #374151;
        color: #d1d5db;
    }

    body.dark-mode .team-card-footer {
        border-color: #374151;
        background: rgba(245, 158, 11, .06);
    }

    /* ============================================================
       RESPONSIVE
       ============================================================ */

    @media (max-width: 850px) {
        .team-summary-grid {
            grid-template-columns: 1fr;
        }

        .team-members-list {
            grid-template-columns: 1fr;
        }
    }

    @media (max-width: 650px) {
        .team-show-page {
            padding: 20px 15px 40px;
        }

        .team-show-header {
            align-items: flex-start;
            flex-direction: column;
        }

        .team-show-back {
            width: 100%;
            justify-content: center;
        }

        .team-responsibilities {
            grid-template-columns: 1fr;
        }

        .team-card-header {
            align-items: flex-start;
            flex-direction: column;
            padding: 18px;
        }

        .team-members-section {
            padding: 18px;
        }

        .team-card-footer {
            padding: 13px 18px;
        }
    }

    @media (max-width: 430px) {
        .team-show-header-left {
            align-items: flex-start;
        }

        .team-show-icon {
            width: 46px;
            height: 46px;
            min-width: 46px;
            font-size: 21px;
        }

        .team-show-header h1 {
            font-size: 23px;
        }

        .team-responsibilities {
            padding: 16px;
        }
    }
</style>

@php
    $returnTo = request('return_to', 'classwork');
@endphp

<div class="team-show-page">

    {{-- ============================================================
         HEADER
    ============================================================= --}}

    <div class="team-show-header">

        <div class="team-show-header-left">

            <div class="team-show-icon">
                <i class="bx bx-group"></i>
            </div>

            <div>
                <span class="team-show-kicker">
                    Project Team
                </span>

                <h1>
                    {{ $group->group_name }}
                </h1>

                <p>
                    View the members and responsibilities of this team.
                </p>
            </div>

        </div>

<a
    href="{{ route(
        'professor.classworks.projects.show',
        [
            'classGroupId' => $classGroup->id,
            'projectId' => $project->id,
            'return_to' => $returnTo,
        ]
    ) }}"
    class="team-show-back"
>
    <i class="bx bx-arrow-back"></i>
    Back to Project
</a>

    </div>


    {{-- ============================================================
         SUMMARY
    ============================================================= --}}

    <div class="team-summary-grid">

        <div class="team-summary-card">

            <span class="team-summary-label">
                Project
            </span>

            <div class="team-summary-value">
                {{ $project->title }}
            </div>

        </div>


        <div class="team-summary-card">

            <span class="team-summary-label">
                Team
            </span>

            <div class="team-summary-value">
                Team {{ $group->group_number }}
            </div>

        </div>


        <div class="team-summary-card">

            <span class="team-summary-label">
                Members
            </span>

            <div class="team-summary-value">
                {{ $group->members->count() }}
                <small>
                    {{ $group->members->count() === 1 ? 'student' : 'students' }}
                </small>
            </div>

        </div>

    </div>


    {{-- ============================================================
         TEAM CARD
    ============================================================= --}}

    <section class="team-card">

        {{-- ========================================================
             TEAM HEADER
        ========================================================= --}}

        <div class="team-card-header">

            <div class="team-card-title">

                <div class="team-number">
                    {{ $group->group_number }}
                </div>

                <div>

                    <h2>
                        {{ $group->group_name }}
                    </h2>

                    <p>
                        {{ $group->members->count() }}
                        {{ $group->members->count() === 1 ? 'member' : 'members' }}
                        assigned to this project team.
                    </p>

                </div>

            </div>

            <span class="team-status">
                <i class="bx bx-check-circle"></i>
                Team Assigned
            </span>

        </div>


        {{-- ========================================================
             LEADER / BACKUP
        ========================================================= --}}

        @php
            $leader = $group->members->firstWhere('role', 'leader');
            $backup = $group->members->firstWhere('role', 'backup');
        @endphp

        <div class="team-responsibilities">

            <div class="responsibility-card">

                <div class="responsibility-icon">
                    <i class="bx bxs-crown"></i>
                </div>

                <div class="responsibility-info">

                    <span class="responsibility-label">
                        Team Leader
                    </span>

                    <span class="responsibility-name">
                        {{ $leader?->user?->name ?? 'Not assigned' }}
                    </span>

                </div>

            </div>


            <div class="responsibility-card">

                <div class="responsibility-icon">
                    <i class="bx bx-shield-quarter"></i>
                </div>

                <div class="responsibility-info">

                    <span class="responsibility-label">
                        Backup Submitter
                    </span>

                    <span class="responsibility-name">
                        {{ $backup?->user?->name ?? 'Not assigned' }}
                    </span>

                </div>

            </div>

        </div>


        {{-- ========================================================
             MEMBERS
        ========================================================= --}}

        <div class="team-members-section">

            <div class="team-members-heading">

                <h3>
                    Team Members
                </h3>

                <span class="team-members-count">
                    {{ $group->members->count() }}
                    {{ $group->members->count() === 1 ? 'Member' : 'Members' }}
                </span>

            </div>


            @if($group->members->isNotEmpty())

                <div class="team-members-list">

                    @foreach($group->members as $member)

                        @php
                            $student = $member->user;
                            $role = $member->role ?? 'member';
                        @endphp

                        <div class="team-member">

                            <div class="team-member-avatar">

                                @if($student?->profile_image)

                                    <img
                                        src="{{ asset('storage/' . $student->profile_image) }}"
                                        alt="{{ $student->name }}"
                                    >

                                @elseif($student)

                                    <span>
                                        {{ strtoupper(substr($student->name, 0, 1)) }}
                                    </span>

                                @else

                                    <i class="bx bx-user"></i>

                                @endif

                            </div>


                            <div class="team-member-info">

                                <span class="team-member-name">
                                    {{ $student?->name ?? 'Unknown Student' }}
                                </span>


                                @if($role === 'leader')

                                    <span class="team-member-role leader">
                                        <i class="bx bxs-crown"></i>
                                        Team Leader
                                    </span>

                                @elseif($role === 'backup')

                                    <span class="team-member-role backup">
                                        <i class="bx bx-shield-quarter"></i>
                                        Backup Submitter
                                    </span>

                                @else

                                    <span class="team-member-role member">
                                        <i class="bx bx-user"></i>
                                        Member
                                    </span>

                                @endif

                            </div>

                        </div>

                    @endforeach

                </div>

            @else

                <div class="team-empty">

                    <i class="bx bx-group"></i>

                    <p>
                        No students have been assigned to this team yet.
                    </p>

                </div>

            @endif

        </div>


        {{-- ========================================================
             FOOTER
        ========================================================= --}}

        <div class="team-card-footer">

            <i class="bx bx-info-circle"></i>

            <span>
                The team leader is the primary student responsible for the final project submission.
                The backup submitter can submit if the leader is unavailable.
            </span>

        </div>

    </section>

</div>

@endsection
