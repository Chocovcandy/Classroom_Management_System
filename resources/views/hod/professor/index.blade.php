@extends('layouts.hod_layout')

@section('title', 'Professors')

@section('content')

<div class="professors-page">

    {{-- ================= PAGE HEADER ================= --}}
    <div class="professors-header">

        <div class="professors-header-content">

            <span class="page-eyebrow">
                Academic Management
            </span>

            <h1>Professors</h1>

            <p>
                View professors assigned to your department and check their information.
            </p>

        </div>

        <div class="professors-header-icon">
                    <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M6 2c-1.10457 0-2 .89543-2 2v4c0 .55228.44772 1 1 1s1-.44772 1-1V4h12v7h-2c-.5523 0-1 .4477-1 1v2h-1c-.5523 0-1 .4477-1 1s.4477 1 1 1h5c.5523 0 1-.4477 1-1V3.85714C20 2.98529 19.3667 2 18.268 2H6Z" />
                        <path d="M6 11.5C6 9.567 7.567 8 9.5 8S13 9.567 13 11.5 11.433 15 9.5 15 6 13.433 6 11.5ZM4 20c0-2.2091 1.79086-4 4-4h3c2.2091 0 4 1.7909 4 4 0 1.1046-.8954 2-2 2H6c-1.10457 0-2-.8954-2-2Z" />
                    </svg>
        </div>

    </div>




    {{-- ================= PROFESSOR CARD ================= --}}
    <div class="professors-card">

        <div class="professors-card-header">

            <div>
                <span class="section-eyebrow">
                    Staff Directory
                </span>

                <h2>Professor List</h2>

                <p>
                    All professors assigned to your department.
                </p>
            </div>

            <div class="professor-count">
                <span class="count-dot"></span>
                {{ $professors->total() }} Professors
            </div>

        </div>


        {{-- ================= SEARCH BAR ================= --}}
        <div class="professors-toolbar">

            <div class="professor-search-box">

                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke-width="1.8"
                    stroke="currentColor"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="m21 21-4.35-4.35m1.35-5.65
                        a7 7 0 1 1-14 0 7 7 0 0 1 14 0Z"
                    />
                </svg>

                <input
                    type="text"
                    id="professorSearch"
                    placeholder="Search professor name, email, or department..."
                    autocomplete="off"
                >

            </div>

            <div class="professor-toolbar-label">
                <span class="toolbar-dot"></span>
                Department Professors
            </div>

        </div>


        {{-- ================= TABLE ================= --}}
        <div class="professors-table-wrapper">

            <table class="professors-table">

                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Professor</th>
                        <th>Email</th>
                        <th>Department</th>
                        <th>Action</th>
                    </tr>
                </thead>

                <tbody id="professorTableBody">

                    @forelse ($professors as $professor)

                        @php
                            $departmentName = $professor->departments
                                ->pluck('department_name')
                                ->join(', ') ?: 'N/A';
                        @endphp

                        <tr class="professor-row">

                            {{-- Number --}}
                            <td class="professor-number">
                                {{ $professors->firstItem() + $loop->index }}
                            </td>


                            {{-- Professor --}}
                            <td>

                                <div class="professor-user">

                                    <div class="professor-avatar">

                                        @if ($professor->profile_image)

                                            <img
                                                src="{{ asset('storage/' . $professor->profile_image) }}"
                                                alt="{{ $professor->name }}"
                                            >

                                        @else

                                            <span>
                                                {{ strtoupper(substr($professor->name, 0, 1)) }}
                                            </span>

                                        @endif

                                    </div>

                                    <div class="professor-name-wrapper">

                                        <span class="professor-name">
                                            {{ $professor->name }}
                                        </span>

                                        <span class="professor-role">
                                            Professor
                                        </span>

                                    </div>

                                </div>

                            </td>


                            {{-- Email --}}
                            <td>

                                <span class="professor-email">
                                    {{ $professor->email }}
                                </span>

                            </td>


                            {{-- Department --}}
                            <td>

                                <span class="department-badge">
                                    <span class="department-badge-dot"></span>
                                    {{ $departmentName }}
                                </span>

                            </td>


                            {{-- Action --}}
                            <td>

                                <button
                                    type="button"
                                    class="view-professor-btn"
                                    data-name="{{ $professor->name }}"
                                    data-email="{{ $professor->email }}"
                                    data-department="{{ $departmentName }}"
                                >

                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                        stroke-width="1.8"
                                        stroke="currentColor"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            d="M2.036 12.322a1.012 1.012 0 0 1 0-.644
                                            C3.423 7.51 7.36 5 12 5
                                            c4.638 0 8.573 2.51 9.963 6.678
                                            .07.21.07.434 0 .644
                                            C20.573 16.49 16.638 19 12 19
                                            c-4.64 0-8.577-2.51-9.964-6.678Z"
                                        />

                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"
                                        />
                                    </svg>

                                    View Details

                                </button>

                            </td>

                        </tr>

                    @empty

                        <tr>
                            <td colspan="5">

                                <div class="empty-professors">

                                    <div class="empty-professors-icon">
                                        <svg
                                            xmlns="http://www.w3.org/2000/svg"
                                            fill="none"
                                            viewBox="0 0 24 24"
                                            stroke-width="1.6"
                                            stroke="currentColor"
                                        >
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                d="M15 19.128a9.38 9.38 0 0 0 2.625.372
                                                9.337 9.337 0 0 0 4.121-.952
                                                4.125 4.125 0 0 0-7.533-2.493
                                                M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07
                                                M15 19.128v.106A12.318 12.318 0 0 1 8.624 21
                                                c-2.331 0-4.512-.645-6.374-1.766
                                                l-.001-.109a6.375 6.375 0 0 1 11.964-3.07
                                                M12 6.375a3.375 3.375 0 1 1-6.75 0
                                                3.375 3.375 0 0 1 6.75 0Z"
                                            />
                                        </svg>
                                    </div>

                                    <h3>No Professors Found</h3>

                                    <p>
                                        There are no professors assigned to your department yet.
                                    </p>

                                </div>

                            </td>
                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>


        {{-- Search Empty State --}}
        <div
            id="searchEmptyState"
            class="search-empty-state"
            style="display: none;"
        >
            <div class="search-empty-icon">
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke-width="1.8"
                    stroke="currentColor"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="m21 21-4.35-4.35m1.35-5.65
                        a7 7 0 1 1-14 0 7 7 0 0 1 14 0Z"
                    />
                </svg>
            </div>

            <h3>No matching professors</h3>

            <p>
                Try searching with another name, email, or department.
            </p>
        </div>


        {{-- ================= PAGINATION ================= --}}
        @if ($professors->hasPages())

            <div class="professors-pagination">
                {{ $professors->links() }}
            </div>

        @endif

    </div>

</div>


{{-- ================= PROFESSOR DETAILS MODAL ================= --}}
<div
    id="professorModal"
    class="professor-modal"
    aria-hidden="true"
>

    <div
        class="professor-modal-content"
        role="dialog"
        aria-modal="true"
        aria-labelledby="modalProfessorTitle"
    >

        <div class="professor-modal-header">

            <div>

                <span class="modal-eyebrow">
                    Professor Information
                </span>

                <h2 id="modalProfessorTitle">
                    Professor Details
                </h2>

            </div>

            <button
                type="button"
                class="modal-close"
                id="closeProfessorModal"
                aria-label="Close modal"
            >
                &times;
            </button>

        </div>


        <div class="professor-modal-body">

            <div class="professor-detail-item">

                <div class="professor-detail-icon">
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke-width="1.8"
                        stroke="currentColor"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M15.75 6a3.75 3.75 0 1 1-7.5 0
                            3.75 3.75 0 0 1 7.5 0ZM4.501 20.118
                            a7.5 7.5 0 0 1 14.998 0
                            A17.933 17.933 0 0 1 12 21.75
                            c-2.676 0-5.216-.584-7.499-1.632Z"
                        />
                    </svg>
                </div>

                <div class="professor-detail-text">

                    <span class="professor-detail-label">
                        Full Name
                    </span>

                    <span
                        id="modalProfessorName"
                        class="professor-detail-value"
                    >
                        N/A
                    </span>

                </div>

            </div>


            <div class="professor-detail-item">

                <div class="professor-detail-icon">
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke-width="1.8"
                        stroke="currentColor"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M21.75 6.75v10.5
                            a2.25 2.25 0 0 1-2.25 2.25h-15
                            a2.25 2.25 0 0 1-2.25-2.25V6.75
                            m19.5 0A2.25 2.25 0 0 0 19.5 4.5h-15
                            a2.25 2.25 0 0 0-2.25 2.25
                            m19.5 0v.243a2.25 2.25 0 0 1-1.07 1.916
                            l-7.5 4.615a2.25 2.25 0 0 1-2.36 0
                            l-7.5-4.615A2.25 2.25 0 0 1 2.25 6.993V6.75"
                        />
                    </svg>
                </div>

                <div class="professor-detail-text">

                    <span class="professor-detail-label">
                        Email Address
                    </span>

                    <span
                        id="modalProfessorEmail"
                        class="professor-detail-value"
                    >
                        N/A
                    </span>

                </div>

            </div>


            <div class="professor-detail-item">

                <div class="professor-detail-icon">
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke-width="1.8"
                        stroke="currentColor"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M3.75 21h16.5M4.5 3h15
                            A1.5 1.5 0 0 1 21 4.5V21H3V4.5
                            A1.5 1.5 0 0 1 4.5 3ZM8.25 7.5h1.5
                            m-1.5 3h1.5m4.5-3h1.5m-1.5 3h1.5
                            M8.25 21v-4.5h7.5V21"
                        />
                    </svg>
                </div>

                <div class="professor-detail-text">

                    <span class="professor-detail-label">
                        Department
                    </span>

                    <span
                        id="modalProfessorDepartment"
                        class="professor-detail-value"
                    >
                        N/A
                    </span>

                </div>

            </div>

        </div>


        <div class="professor-modal-footer">

            <button
                type="button"
                class="modal-done-btn"
                id="modalDoneButton"
            >
                Close
            </button>

        </div>

    </div>

</div>


{{-- ================= PAGE STYLE ================= --}}
<style>

    .professors-page {
        width: 100%;
        max-width: 1500px;
        margin: 0 auto;
        padding: 10px 18px 18px;
        color: var(--text-primary, #172033);
    }

    .professors-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 25px;
        margin-bottom: 25px;
        padding: 30px 34px;
        border: 1px solid var(--border-color, #e7ebf3);
        border-radius: 24px;
        background:
  
            var(--card-bg, #ffffff);
        box-shadow: 0 10px 35px rgba(30, 64, 175, .06);
    }

    .professors-header-content {
        min-width: 0;
    }

    .page-eyebrow,
    .section-eyebrow,
    .modal-eyebrow {
        display: inline-block;
        margin-bottom: 8px;
        color: #2563eb;
        font-size: 11px;
        font-weight: 800;
        letter-spacing: 1.5px;
        text-transform: uppercase;
    }

    .professors-header h1 {
        margin: 0;
        color: var(--text-primary, #172033);
        font-size: clamp(28px, 4vw, 40px);
        font-weight: 800;
        letter-spacing: -1px;
    }

    .professors-header p {
        max-width: 620px;
        margin: 10px 0 0;
        color: var(--text-secondary, #718096);
        font-size: 14px;
        line-height: 1.7;
    }

    .professors-header-icon {
        display: flex;
        align-items: center;
        justify-content: center;
        flex: 0 0 90px;
        width: 90px;
        height: 90px;
        color: #2563eb;
        border-radius: 24px;
        background: rgba(37, 99, 235, .12);
    }

    .professors-header-icon svg {
        width: 48px;
        height: 48px;
    }


    /* ================= STATS ================= */

    .professor-stats {
        display: grid;
        grid-template-columns: repeat(3, minmax(0, 1fr));
        gap: 18px;
        margin-bottom: 25px;
    }

    .professor-stat-card {
        display: flex;
        align-items: center;
        gap: 16px;
        min-width: 0;
        padding: 22px;
        border: 1px solid var(--border-color, #e7ebf3);
        border-radius: 20px;
        background: var(--card-bg, #ffffff);
        box-shadow: 0 8px 25px rgba(15, 23, 42, .035);
    }

    .professor-stat-icon {
        display: flex;
        align-items: center;
        justify-content: center;
        flex: 0 0 54px;
        width: 54px;
        height: 54px;
        border-radius: 16px;
    }

    .professor-stat-icon svg {
        width: 27px;
        height: 27px;
    }

    .professor-stat-icon.blue {
        color: #2563eb;
        background: rgba(37, 99, 235, .12);
    }

    .professor-stat-icon.green {
        color: #16a34a;
        background: rgba(22, 163, 74, .12);
    }

    .professor-stat-icon.purple {
        color: #7c3aed;
        background: rgba(124, 58, 237, .12);
    }

    .professor-stat-content {
        min-width: 0;
    }

    .professor-stat-content span {
        display: block;
        margin-bottom: 5px;
        color: var(--text-secondary, #718096);
        font-size: 12px;
        font-weight: 600;
    }

    .professor-stat-content strong {
        display: block;
        color: var(--text-primary, #172033);
        font-size: 28px;
        font-weight: 800;
        line-height: 1;
    }


    /* ================= MAIN CARD ================= */

    .professors-card {
        overflow: hidden;
        border: 1px solid var(--border-color, #e7ebf3);
        border-radius: 24px;
        background: var(--card-bg, #ffffff);
        box-shadow: 0 10px 35px rgba(15, 23, 42, .045);
    }

    .professors-card-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 20px;
        padding: 30px 32px 25px;
        border-bottom: 1px solid var(--border-color, #e7ebf3);
    }

    .professors-card-header h2 {
        margin: 0;
        color: var(--text-primary, #172033);
        font-size: 24px;
        font-weight: 800;
        letter-spacing: -.5px;
    }

    .professors-card-header p {
        margin: 7px 0 0;
        color: var(--text-secondary, #718096);
        font-size: 13px;
    }

    .professor-count {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 10px 15px;
        color: #2563eb;
        border: 1px solid rgba(37, 99, 235, .16);
        border-radius: 999px;
        background: rgba(37, 99, 235, .08);
        font-size: 12px;
        font-weight: 800;
        white-space: nowrap;
    }

    .count-dot,
    .toolbar-dot,
    .department-badge-dot {
        width: 7px;
        height: 7px;
        border-radius: 50%;
        background: currentColor;
    }


    /* ================= TOOLBAR ================= */

    .professors-toolbar {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 18px;
        padding: 22px 32px;
        background: var(--surface-secondary, #f8fafc);
        border-bottom: 1px solid var(--border-color, #e7ebf3);
    }

    .professor-search-box {
        position: relative;
        width: min(100%, 520px);
    }

    .professor-search-box svg {
        position: absolute;
        top: 50%;
        left: 16px;
        width: 19px;
        height: 19px;
        color: #94a3b8;
        transform: translateY(-50%);
        pointer-events: none;
    }

    .professor-search-box input {
        width: 100%;
        height: 46px;
        padding: 0 18px 0 47px;
        color: var(--text-primary, #172033);
        border: 1px solid var(--border-color, #dce3ee);
        border-radius: 13px;
        outline: none;
        background: var(--card-bg, #ffffff);
        font-size: 13px;
        transition: .2s ease;
    }

    .professor-search-box input:focus {
        border-color: #2563eb;
        box-shadow: 0 0 0 4px rgba(37, 99, 235, .10);
    }

    .professor-toolbar-label {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        color: var(--text-secondary, #64748b);
        font-size: 12px;
        font-weight: 700;
        white-space: nowrap;
    }

    .professor-toolbar-label .toolbar-dot {
        color: #16a34a;
    }


    /* ================= TABLE ================= */

    .professors-table-wrapper {
        width: 100%;
        overflow-x: auto;
    }

    .professors-table {
        width: 100%;
        min-width: 850px;
        border-collapse: collapse;
    }

    .professors-table thead {
        background: var(--surface-secondary, #f8fafc);
    }

    .professors-table th {
        padding: 17px 22px;
        color: var(--text-secondary, #64748b);
        border-bottom: 1px solid var(--border-color, #e7ebf3);
        font-size: 11px;
        font-weight: 800;
        letter-spacing: .7px;
        text-align: left;
        text-transform: uppercase;
    }

    .professors-table td {
        padding: 20px 22px;
        color: var(--text-primary, #172033);
        border-bottom: 1px solid var(--border-color, #edf1f6);
        font-size: 13px;
        vertical-align: middle;
    }

    .professors-table tbody tr {
        transition: background .2s ease;
    }

    .professors-table tbody tr:hover {
        background: rgba(37, 99, 235, .035);
    }

    .professors-table tbody tr:last-child td {
        border-bottom: none;
    }

    .professor-number {
        width: 65px;
        color: var(--text-secondary, #94a3b8) !important;
        font-size: 12px !important;
        font-weight: 700;
    }

    .professor-user {
        display: flex;
        align-items: center;
        gap: 13px;
        min-width: 210px;
    }

    .professor-avatar {
        display: flex;
        align-items: center;
        justify-content: center;
        flex: 0 0 46px;
        width: 46px;
        height: 46px;
        overflow: hidden;
        color: #2563eb;
        border: 1px solid rgba(37, 99, 235, .15);
        border-radius: 15px;
        background: rgba(37, 99, 235, .10);
        font-size: 17px;
        font-weight: 800;
    }

    .professor-avatar img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .professor-name-wrapper {
        display: flex;
        flex-direction: column;
        gap: 4px;
        min-width: 0;
    }

    .professor-name {
        color: var(--text-primary, #172033);
        font-size: 14px;
        font-weight: 800;
    }

    .professor-role {
        color: var(--text-secondary, #94a3b8);
        font-size: 11px;
        font-weight: 600;
    }

    .professor-email {
        color: var(--text-secondary, #64748b);
        font-size: 13px;
    }

    .department-badge {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        max-width: 260px;
        padding: 8px 11px;
        color: #2563eb;
        border-radius: 10px;
        background: rgba(37, 99, 235, .09);
        font-size: 11px;
        font-weight: 800;
    }

    .view-professor-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        padding: 10px 13px;
        color: #2563eb;
        border: 1px solid rgba(37, 99, 235, .18);
        border-radius: 10px;
        background: rgba(37, 99, 235, .07);
        cursor: pointer;
        font-size: 12px;
        font-weight: 800;
        transition: .2s ease;
    }

    .view-professor-btn svg {
        width: 17px;
        height: 17px;
    }

    .view-professor-btn:hover {
        color: #ffffff;
        border-color: #2563eb;
        background: #2563eb;
        transform: translateY(-1px);
    }


    /* ================= EMPTY STATES ================= */

    .empty-professors,
    .search-empty-state {
        padding: 65px 25px;
        text-align: center;
    }

    .empty-professors-icon,
    .search-empty-icon {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 70px;
        height: 70px;
        margin: 0 auto 18px;
        color: #2563eb;
        border-radius: 22px;
        background: rgba(37, 99, 235, .10);
    }

    .empty-professors-icon svg,
    .search-empty-icon svg {
        width: 35px;
        height: 35px;
    }

    .empty-professors h3,
    .search-empty-state h3 {
        margin: 0 0 8px;
        color: var(--text-primary, #172033);
        font-size: 18px;
        font-weight: 800;
    }

    .empty-professors p,
    .search-empty-state p {
        margin: 0;
        color: var(--text-secondary, #718096);
        font-size: 13px;
    }


    /* ================= PAGINATION ================= */

    .professors-pagination {
        padding: 22px 30px;
        border-top: 1px solid var(--border-color, #e7ebf3);
    }

    .professors-pagination nav {
        display: flex;
        justify-content: center;
    }

    .professors-pagination svg {
        width: 18px;
        height: 18px;
    }


    /* ================= MODAL ================= */

    .professor-modal {
        position: fixed;
        inset: 0;
        z-index: 9999;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 20px;
        background: rgba(15, 23, 42, .58);
        opacity: 0;
        visibility: hidden;
        transition: .2s ease;
    }

    .professor-modal.active {
        opacity: 1;
        visibility: visible;
    }

    .professor-modal-content {
        width: min(100%, 500px);
        overflow: hidden;
        border: 1px solid var(--border-color, #e7ebf3);
        border-radius: 24px;
        background: var(--card-bg, #ffffff);
        box-shadow: 0 25px 80px rgba(15, 23, 42, .25);
        transform: translateY(15px) scale(.98);
        transition: .2s ease;
    }

    .professor-modal.active .professor-modal-content {
        transform: translateY(0) scale(1);
    }

    .professor-modal-header {
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        gap: 20px;
        padding: 27px 30px;
        border-bottom: 1px solid var(--border-color, #e7ebf3);
    }

    .professor-modal-header h2 {
        margin: 0;
        color: var(--text-primary, #172033);
        font-size: 24px;
        font-weight: 800;
    }

    .modal-close {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 36px;
        height: 36px;
        color: var(--text-secondary, #64748b);
        border: 1px solid var(--border-color, #e7ebf3);
        border-radius: 11px;
        background: transparent;
        cursor: pointer;
        font-size: 25px;
        line-height: 1;
        transition: .2s ease;
    }

    .modal-close:hover {
        color: #ef4444;
        border-color: rgba(239, 68, 68, .2);
        background: rgba(239, 68, 68, .08);
    }

    .professor-modal-body {
        display: flex;
        flex-direction: column;
        gap: 15px;
        padding: 27px 30px;
    }

    .professor-detail-item {
        display: flex;
        align-items: center;
        gap: 15px;
        padding: 15px;
        border: 1px solid var(--border-color, #e7ebf3);
        border-radius: 15px;
        background: var(--surface-secondary, #f8fafc);
    }

    .professor-detail-icon {
        display: flex;
        align-items: center;
        justify-content: center;
        flex: 0 0 43px;
        width: 43px;
        height: 43px;
        color: #2563eb;
        border-radius: 13px;
        background: rgba(37, 99, 235, .10);
    }

    .professor-detail-icon svg {
        width: 22px;
        height: 22px;
    }

    .professor-detail-text {
        display: flex;
        flex-direction: column;
        gap: 5px;
        min-width: 0;
    }

    .professor-detail-label {
        color: var(--text-secondary, #94a3b8);
        font-size: 11px;
        font-weight: 800;
        letter-spacing: .6px;
        text-transform: uppercase;
    }

    .professor-detail-value {
        overflow-wrap: anywhere;
        color: var(--text-primary, #172033);
        font-size: 14px;
        font-weight: 700;
    }

    .professor-modal-footer {
        display: flex;
        justify-content: flex-end;
        padding: 20px 30px;
        border-top: 1px solid var(--border-color, #e7ebf3);
    }

    .modal-done-btn {
        padding: 12px 24px;
        color: #ffffff;
        border: none;
        border-radius: 11px;
        background: #2563eb;
        cursor: pointer;
        font-size: 13px;
        font-weight: 800;
        transition: .2s ease;
    }

    .modal-done-btn:hover {
        background: #1d4ed8;
        transform: translateY(-1px);
    }

    body.modal-open {
        overflow: hidden;
    }


    /* ================= RESPONSIVE ================= */

    @media (max-width: 900px) {

        .professor-stats {
            grid-template-columns: 1fr;
        }

        .professors-toolbar {
            align-items: stretch;
            flex-direction: column;
        }

        .professor-search-box {
            width: 100%;
        }

        .professor-toolbar-label {
            align-self: flex-start;
        }

    }

    @media (max-width: 650px) {

        .professors-page {
            padding: 5px 10px 25px;
        }

        .professors-header {
            align-items: flex-start;
            padding: 24px;
        }

        .professors-header-icon {
            flex-basis: 62px;
            width: 62px;
            height: 62px;
            border-radius: 18px;
        }

        .professors-header-icon svg {
            width: 34px;
            height: 34px;
        }

        .professors-card-header {
            align-items: flex-start;
            flex-direction: column;
            padding: 24px;
        }

        .professors-toolbar {
            padding: 18px 24px;
        }

        .professor-modal-header,
        .professor-modal-body,
        .professor-modal-footer {
            padding-left: 22px;
            padding-right: 22px;
        }

    }

</style>


{{-- ================= PAGE SCRIPT ================= --}}
<script>

    document.addEventListener('DOMContentLoaded', function () {

        const modal = document.getElementById('professorModal');

        const modalName = document.getElementById('modalProfessorName');

        const modalEmail = document.getElementById('modalProfessorEmail');

        const modalDepartment =
            document.getElementById('modalProfessorDepartment');

        const closeModalButton =
            document.getElementById('closeProfessorModal');

        const doneButton =
            document.getElementById('modalDoneButton');

        const viewButtons =
            document.querySelectorAll('.view-professor-btn');

        const searchInput =
            document.getElementById('professorSearch');

        const professorRows =
            document.querySelectorAll('.professor-row');

        const searchEmptyState =
            document.getElementById('searchEmptyState');


        function openProfessorModal(button) {

            modalName.textContent =
                button.dataset.name || 'N/A';

            modalEmail.textContent =
                button.dataset.email || 'N/A';

            modalDepartment.textContent =
                button.dataset.department || 'N/A';

            modal.classList.add('active');

            modal.setAttribute('aria-hidden', 'false');

            document.body.classList.add('modal-open');

        }


        function closeProfessorModal() {

            modal.classList.remove('active');

            modal.setAttribute('aria-hidden', 'true');

            document.body.classList.remove('modal-open');

        }


        viewButtons.forEach(function (button) {

            button.addEventListener('click', function () {
                openProfessorModal(button);
            });

        });


        closeModalButton.addEventListener('click', closeProfessorModal);

        doneButton.addEventListener('click', closeProfessorModal);


        modal.addEventListener('click', function (event) {

            if (event.target === modal) {
                closeProfessorModal();
            }

        });


        document.addEventListener('keydown', function (event) {

            if (event.key === 'Escape' && modal.classList.contains('active')) {
                closeProfessorModal();
            }

        });


        searchInput.addEventListener('input', function () {

            const searchValue =
                searchInput.value.toLowerCase().trim();

            let visibleRows = 0;

            professorRows.forEach(function (row) {

                const rowText =
                    row.textContent.toLowerCase();

                const isMatched =
                    rowText.includes(searchValue);

                row.style.display =
                    isMatched ? '' : 'none';

                if (isMatched) {
                    visibleRows++;
                }

            });

            searchEmptyState.style.display =
                visibleRows === 0 && searchValue !== ''
                    ? 'block'
                    : 'none';

        });

    });

</script>

@endsection