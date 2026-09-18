@extends('layouts.admin_layout')

@section('title', 'User Management')

@section('content')

<div class="users-page">

    {{-- =====================================================
         BACK TO DASHBOARD
    ====================================================== --}}

    <div class="top-dashboard-link">

        <a href="{{ route('admin.dashboard') }}">

            <svg
                viewBox="0 0 24 24"
                fill="none"
                stroke="currentColor"
                stroke-width="2"
                stroke-linecap="round"
                stroke-linejoin="round"
            >
                <path d="m15 18-6-6 6-6"></path>
            </svg>

            Back to Dashboard

        </a>

    </div>


    {{-- =====================================================
         PAGE HEADER
    ====================================================== --}}

    <div class="users-header">

        <div class="users-header-content">

            <span class="users-eyebrow">
                ADMINISTRATION
            </span>

            <h1>
                User Management
            </h1>

            <p>
                Manage users, roles, and department assignments
                across the university system.
            </p>

        </div>


        <div class="users-header-actions">

            <a
                href="{{ route('admin.users.create') }}"
                class="users-create-button"
            >

                <span class="users-create-icon">

                    <svg
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="2"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                    >
                        <path d="M12 5v14"></path>
                        <path d="M5 12h14"></path>
                    </svg>

                </span>

                Create User

            </a>

        </div>

    </div>


    {{-- =====================================================
     SUCCESS MESSAGE
====================================================== --}}

@if(session('success'))

    <div class="user-success-message">

        <div class="user-success-icon">
            <svg
                viewBox="0 0 24 24"
                fill="none"
                stroke="currentColor"
                stroke-width="2"
                stroke-linecap="round"
                stroke-linejoin="round"
            >
                <path d="M20 6 9 17l-5-5"></path>
            </svg>
        </div>

        <div class="user-success-content">

            <strong>
                Success
            </strong>

            <span>
                {{ session('success') }}
            </span>

        </div>

        <button
            type="button"
            class="user-success-close"
            onclick="this.parentElement.remove()"
            aria-label="Close message"
        >
            <svg
                viewBox="0 0 24 24"
                fill="none"
                stroke="currentColor"
                stroke-width="2"
                stroke-linecap="round"
                stroke-linejoin="round"
            >
                <path d="M6 6l12 12"></path>
                <path d="M18 6 6 18"></path>
            </svg>
        </button>

    </div>

@endif


    {{-- =====================================================
         TOOLBAR
    ====================================================== --}}

    <div class="users-toolbar">

        <div class="toolbar-left">


            {{-- =================================================
                 SEARCH
            ================================================== --}}

            <form
                method="GET"
                action="{{ route('admin.users.index') }}"
                class="users-search-form"
            >

                @if(request('role'))

                    <input
                        type="hidden"
                        name="role"
                        value="{{ request('role') }}"
                    >

                @endif


                @foreach(request('roles', []) as $role)

                    <input
                        type="hidden"
                        name="roles[]"
                        value="{{ $role }}"
                    >

                @endforeach


                @if(request('sort'))

                    <input
                        type="hidden"
                        name="sort"
                        value="{{ request('sort') }}"
                    >

                @endif


                <div class="users-search-box">

                    <svg
                        class="search-icon"
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="2"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                    >
                        <circle cx="11" cy="11" r="7"></circle>
                        <path d="m16 16 5 5"></path>
                    </svg>


                    <input
                        type="text"
                        name="search"
                        value="{{ request('search') }}"
                        placeholder="Search users..."
                    >


                    @if(request('search'))

                        <a
                            href="{{ route('admin.users.index', array_filter([
                                'role' => request('role'),
                                'sort' => request('sort'),
                                'roles' => request('roles', []),
                            ])) }}"
                            class="clear-search"
                            aria-label="Clear search"
                        >

                            <svg
                                viewBox="0 0 24 24"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="2"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                            >
                                <path d="M6 6l12 12"></path>
                                <path d="M18 6 6 18"></path>
                            </svg>

                        </a>

                    @endif

                </div>

            </form>



            {{-- =================================================
                 FILTER
            ================================================== --}}

            <div class="users-dropdown">

                <button
                    type="button"
                    class="toolbar-button"
                    id="filter-button"
                >

                    <svg
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="2"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                    >
                        <path d="M4 6h16"></path>
                        <path d="M7 12h10"></path>
                        <path d="M10 18h4"></path>
                    </svg>

                    Filter

                    @if(count(request('roles', [])) > 0)

                        <span class="toolbar-count">
                            {{ count(request('roles', [])) }}
                        </span>

                    @endif

                    <svg
                        class="dropdown-chevron"
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="2"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                    >
                        <path d="m6 9 6 6 6-6"></path>
                    </svg>

                </button>


                <form
                    method="GET"
                    action="{{ route('admin.users.index') }}"
                    class="users-dropdown-panel"
                    id="filter-panel"
                >

                    @if(request('search'))

                        <input
                            type="hidden"
                            name="search"
                            value="{{ request('search') }}"
                        >

                    @endif


                    @if(request('role'))

                        <input
                            type="hidden"
                            name="role"
                            value="{{ request('role') }}"
                        >

                    @endif


                    @if(request('sort'))

                        <input
                            type="hidden"
                            name="sort"
                            value="{{ request('sort') }}"
                        >

                    @endif


                    <div class="dropdown-heading">

                        <h3>
                            Filter Users
                        </h3>

                        <p>
                            Select one or more roles.
                        </p>

                    </div>


                    <div class="dropdown-section">

                        <span class="dropdown-label">
                            Roles
                        </span>

                        @php

                            $filterRoles = [
                                'Admin',
             
                                'HoD',
                                'Professor',
                                'Student',
                            ];

                        @endphp


                        <div class="filter-role-list">

                            @foreach($filterRoles as $role)

                                <label class="filter-role-option">

                                    <input
                                        type="checkbox"
                                        name="roles[]"
                                        value="{{ $role }}"
                                        {{ in_array($role, request()->input('roles', [])) ? 'checked' : '' }}
                                    >

                                    <span class="custom-checkbox"></span>

                                    <span>
                                        {{ $role }}
                                    </span>

                                </label>

                            @endforeach

                        </div>

                    </div>


                    <div class="dropdown-actions">

                        <a
                            href="{{ route('admin.users.index', array_filter([
                                'search' => request('search'),
                                'role' => request('role'),
                                'sort' => request('sort'),
                            ])) }}"
                            class="dropdown-clear"
                        >
                            Clear
                        </a>


                        <button
                            type="submit"
                            class="dropdown-apply"
                        >
                            Apply Filter
                        </button>

                    </div>

                </form>

            </div>



            {{-- =================================================
                 SORT
            ================================================== --}}

            <div class="users-dropdown">

                <button
                    type="button"
                    class="toolbar-button"
                    id="sort-button"
                >

                    <svg
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="2"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                    >
                        <path d="M8 6h13"></path>
                        <path d="M8 12h10"></path>
                        <path d="M8 18h7"></path>
                        <path d="m3 6 2-2 2 2"></path>
                        <path d="M5 4v16"></path>
                    </svg>

                    Sort By

                    <svg
                        class="dropdown-chevron"
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="2"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                    >
                        <path d="m6 9 6 6 6-6"></path>
                    </svg>

                </button>


                <form
                    method="GET"
                    action="{{ route('admin.users.index') }}"
                    class="users-dropdown-panel sort-panel"
                    id="sort-panel"
                >

                    @if(request('search'))

                        <input
                            type="hidden"
                            name="search"
                            value="{{ request('search') }}"
                        >

                    @endif


                    @if(request('role'))

                        <input
                            type="hidden"
                            name="role"
                            value="{{ request('role') }}"
                        >

                    @endif


                    @foreach(request('roles', []) as $role)

                        <input
                            type="hidden"
                            name="roles[]"
                            value="{{ $role }}"
                        >

                    @endforeach


                    <div class="dropdown-heading">

                        <h3>
                            Sort Users
                        </h3>

                        <p>
                            Choose how users are ordered.
                        </p>

                    </div>


                    <div class="sort-options">

                        @foreach([
                            'name_asc' => 'Name A–Z',
                            'name_desc' => 'Name Z–A',
                            'newest' => 'Newest first',
                            'oldest' => 'Oldest first',
                        ] as $value => $label)

                            <label class="sort-option">

                                <input
                                    type="radio"
                                    name="sort"
                                    value="{{ $value }}"
                                    {{ request('sort') === $value ? 'checked' : '' }}
                                >

                                <span class="custom-radio"></span>

                                <span>
                                    {{ $label }}
                                </span>

                            </label>

                        @endforeach

                    </div>


                    <div class="dropdown-actions">

                        <a
                            href="{{ route('admin.users.index', array_filter([
                                'search' => request('search'),
                                'role' => request('role'),
                            ])) }}"
                            class="dropdown-clear"
                        >
                            Clear
                        </a>


                        <button
                            type="submit"
                            class="dropdown-apply"
                        >
                            Apply Sort
                        </button>

                    </div>

                </form>

            </div>

        </div>


        <div class="toolbar-right">

            <span class="users-result-label">
                User Directory
            </span>

        </div>

    </div>



    {{-- =====================================================
         USERS CARD
    ====================================================== --}}

    <div class="users-card">


        {{-- =================================================
             QUICK ROLE FILTERS
        ================================================== --}}

        @php

            $quickFilters = [
                '' => 'All',
                'Admin' => 'Admin',
                'academic_staff' => 'Academic Staff',
                'HoD' => 'HoD',
                'Professor' => 'Professor',
                'Student' => 'Student',
            ];

        @endphp


        <div class="quick-filters">

            @foreach($quickFilters as $value => $label)

                <a
                    href="{{ route('admin.users.index', array_filter([
                        'role' => $value,
                        'search' => request('search'),
                        'sort' => request('sort'),
                    ])) }}"
                    class="quick-filter {{ request('role', '') === $value ? 'active' : '' }}"
                >
                    {{ $label }}
                </a>

            @endforeach

        </div>



        {{-- =================================================
             USERS TABLE
        ================================================== --}}

        @php

            $roleStyles = [
                'Admin' => 'role-admin',
                'HoD' => 'role-hod',
                'Professor' => 'role-professor',
                'Student' => 'role-student',
            ];

        @endphp


        <div class="users-table-wrapper">

            <table class="users-table">

                <thead>

                    <tr>

                        <th class="users-id-heading">
                            ID
                        </th>

                        <th class="users-profile-heading">
                            Profile
                        </th>

                        <th>
                            User
                        </th>

                        <th>
                            Role
                        </th>

                        <th>
                            Department
                        </th>

                        <th class="users-action-heading">
                            Actions
                        </th>

                    </tr>

                </thead>


                <tbody>

                    @forelse($users as $user)

                        <tr>


                            {{-- ID --}}

                            <td class="users-id">

                                <span class="id-badge">
                                    #{{ $user->id }}
                                </span>

                            </td>



                            {{-- PROFILE --}}

                            <td class="users-profile">

                                <div class="user-avatar">

                                    @if($user->profile_image)

                                        <img
                                            src="{{ asset('storage/' . $user->profile_image) }}"
                                            alt="{{ $user->name }}"
                                        >

                                    @else

                                        <span>
                                            {{ strtoupper(substr($user->name, 0, 1)) }}
                                        </span>

                                    @endif

                                </div>

                            </td>



                            {{-- USER INFORMATION --}}

                            <td>

                                <div class="user-details">

                                    <span class="user-name">
                                        {{ $user->name }}
                                    </span>

                                    <span class="user-email">
                                        {{ $user->email }}
                                    </span>

                                </div>

                            </td>



                            {{-- ROLES --}}

                            <td>

                                <div class="user-roles">

                                    @forelse($user->roles as $role)

                                        <span
                                            class="user-role {{ $roleStyles[$role->role_name] ?? 'role-default' }}"
                                        >
                                            {{ $role->role_name }}
                                        </span>

                                    @empty

                                        <span class="empty-value">
                                            No role
                                        </span>

                                    @endforelse

                                </div>

                            </td>



                            {{-- DEPARTMENT --}}

                            <td>

                                @if($user->departments->isEmpty())

                                    <span class="empty-value">
                                        No department
                                    </span>

                                @else

                                    <div class="user-departments">

                                        {{ $user->departments->pluck('department_name')->join(', ') }}

                                    </div>

                                @endif

                            </td>



                            {{-- ACTIONS --}}

                            <td class="users-actions">


                                @if(!$user->isStudent())

                                    <a
                                        href="{{ route('admin.users.edit', $user->id) }}"
                                        class="user-action-edit"
                                    >

                                        <svg
                                            viewBox="0 0 24 24"
                                            fill="none"
                                            stroke="currentColor"
                                            stroke-width="2"
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                        >
                                            <path d="M12 20h9"></path>
                                            <path d="M16.5 3.5a2.1 2.1 0 0 1 3 3L7 19l-4 1 1-4Z"></path>
                                        </svg>

                                        Edit

                                    </a>

                                @endif



                                @if(!$user->roles->contains('role_name', 'Admin'))

                                    <form
                                        method="POST"
                                        action="{{ route('admin.users.destroy', $user->id) }}"
                                        class="user-delete-form"
                                        onsubmit="return confirm('This action will permanently delete this user. Continue?')"
                                    >

                                        @csrf

                                        @method('DELETE')


                                        <button
                                            type="submit"
                                            class="user-action-delete"
                                        >

                                            <svg
                                                viewBox="0 0 24 24"
                                                fill="none"
                                                stroke="currentColor"
                                                stroke-width="2"
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                            >
                                                <path d="M3 6h18"></path>
                                                <path d="M8 6V4h8v2"></path>
                                                <path d="M19 6l-1 14H6L5 6"></path>
                                                <path d="M10 11v5"></path>
                                                <path d="M14 11v5"></path>
                                            </svg>

                                            Delete

                                        </button>

                                    </form>

                                @endif

                            </td>

                        </tr>


                    @empty

                        <tr>

                            <td
                                colspan="6"
                                class="table-empty"
                            >

                                <div class="table-empty-content">

                                    <div class="table-empty-icon">

                                        <svg
                                            viewBox="0 0 24 24"
                                            fill="none"
                                            stroke="currentColor"
                                            stroke-width="1.7"
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                        >
                                            <circle cx="9" cy="8" r="4"></circle>
                                            <path d="M2 21a7 7 0 0 1 14 0"></path>
                                            <path d="m17 16 5 5"></path>
                                            <path d="m22 16-5 5"></path>
                                        </svg>

                                    </div>


                                    <h3>
                                        No users found
                                    </h3>


                                    <p>
                                        There are no users matching
                                        the selected filter.
                                    </p>


                                    <a
                                        href="{{ route('admin.users.index') }}"
                                        class="empty-reset-button"
                                    >
                                        Clear Filters
                                    </a>

                                </div>

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>



        {{-- =================================================
             PAGINATION - LEFT SIDE
        ================================================== --}}

        @if($users->hasPages())

            <div class="pagination-wrapper">

                {{ $users->appends(request()->query())->links('vendor.pagination.custom') }}

            </div>

        @endif


    </div>

</div>



<style>

/* =========================================================
   PAGE
========================================================= */

.users-page {
    width: 100%;
    max-width: 1380px;
    margin: 0 auto;
    padding: 20px 28px 30px;
    color: #172033;
}


/* =========================================================
   TOP DASHBOARD LINK
========================================================= */

.top-dashboard-link {
    display: flex;
    align-items: center;
    margin-bottom: 18px;
}

.top-dashboard-link a {
    display: inline-flex;
    align-items: center;
    gap: 7px;
    color: #64748b;
    font-size: 13px;
    font-weight: 800;
    text-decoration: none;
    transition: color 0.2s ease;
}

.top-dashboard-link a:hover {
    color: #2563eb;
}

.top-dashboard-link svg {
    width: 18px;
    height: 18px;
}


/* =========================================================
   HEADER
========================================================= */

.users-header {
    display: flex;
    align-items: flex-end;
    justify-content: space-between;
    gap: 24px;
    margin-bottom: 22px;
}

.users-header-content {
    min-width: 0;
}

.users-eyebrow {
    display: block;
    margin-bottom: 7px;
    color: #2563eb;
    font-size: 11px;
    font-weight: 800;
    letter-spacing: 1.6px;
}

.users-header h1 {
    margin: 0;
    color: #172033;
    font-size: 31px;
    font-weight: 800;
    letter-spacing: -0.8px;
}

.users-header p {
    max-width: 620px;
    margin: 7px 0 0;
    color: #64748b;
    font-size: 14px;
    line-height: 1.6;
}

.users-create-button {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 9px;
    min-height: 45px;
    padding: 0 17px;
    border-radius: 12px;
    background: linear-gradient(135deg, #2563eb, #4f46e5);
    color: #ffffff;
    font-size: 12px;
    font-weight: 800;
    text-decoration: none;
    box-shadow: 0 8px 18px rgba(37, 99, 235, 0.17);
    transition: all 0.2s ease;
}

.users-create-button:hover {
    transform: translateY(-1px);
    box-shadow: 0 11px 23px rgba(37, 99, 235, 0.24);
}

.users-create-icon {
    display: inline-flex;
    align-items: center;
    justify-content: center;
}

.users-create-icon svg {
    width: 18px;
    height: 18px;
}


/* =========================================================
   TOOLBAR
========================================================= */

.users-toolbar {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 16px;
    margin-bottom: 16px;
}

.toolbar-left {
    display: flex;
    align-items: center;
    flex-wrap: wrap;
    gap: 10px;
}

.users-search-form {
    margin: 0;
}

.users-search-box {
    position: relative;
    display: flex;
    align-items: center;
    width: 285px;
    height: 43px;
    border: 1px solid #e1e8f2;
    border-radius: 12px;
    background: #ffffff;
    transition: all 0.2s ease;
}

.users-search-box:focus-within {
    border-color: #3b82f6;
    box-shadow: 0 0 0 4px rgba(59, 130, 246, 0.09);
}

.search-icon {
    width: 18px;
    height: 18px;
    margin-left: 13px;
    flex-shrink: 0;
    color: #94a3b8;
}

.users-search-box input {
    width: 100%;
    height: 41px;
    min-width: 0;
    padding: 0 12px;
    border: 0;
    outline: none;
    background: transparent;
    color: #172033;
    font-family: inherit;
    font-size: 12px;
}

.users-search-box input::placeholder {
    color: #a0aec0;
}

.clear-search {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 28px;
    height: 28px;
    margin-right: 5px;
    border-radius: 8px;
    color: #94a3b8;
}

.clear-search:hover {
    background: #f1f5f9;
    color: #334155;
}

.clear-search svg {
    width: 15px;
    height: 15px;
}

.users-dropdown {
    position: relative;
}

.toolbar-button {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    height: 43px;
    padding: 0 13px;
    border: 1px solid #e1e8f2;
    border-radius: 12px;
    background: #ffffff;
    color: #475569;
    font-family: inherit;
    font-size: 12px;
    font-weight: 750;
    cursor: pointer;
    transition: all 0.2s ease;
}

.toolbar-button:hover,
.toolbar-button.active {
    border-color: #bfdbfe;
    background: #eff6ff;
    color: #2563eb;
}

.toolbar-button > svg {
    width: 17px;
    height: 17px;
}

.toolbar-button .dropdown-chevron {
    width: 14px;
    height: 14px;
}

.toolbar-count {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    min-width: 19px;
    height: 19px;
    padding: 0 5px;
    border-radius: 20px;
    background: #2563eb;
    color: #ffffff;
    font-size: 10px;
    font-weight: 800;
}

.users-dropdown-panel {
    position: absolute;
    top: calc(100% + 9px);
    left: 0;
    z-index: 50;
    display: none;
    width: 285px;
    padding: 17px;
    border: 1px solid #e2e8f0;
    border-radius: 16px;
    background: #ffffff;
    box-shadow: 0 18px 45px rgba(15, 23, 42, 0.13);
}

.users-dropdown-panel.open {
    display: block;
}

.sort-panel {
    width: 265px;
}

.dropdown-heading {
    padding-bottom: 13px;
    border-bottom: 1px solid #edf1f7;
}

.dropdown-heading h3 {
    margin: 0;
    color: #172033;
    font-size: 14px;
    font-weight: 800;
}

.dropdown-heading p {
    margin: 4px 0 0;
    color: #94a3b8;
    font-size: 11px;
}

.dropdown-section {
    padding: 15px 0;
}

.dropdown-label {
    display: block;
    margin-bottom: 10px;
    color: #64748b;
    font-size: 11px;
    font-weight: 800;
}

.filter-role-list,
.sort-options {
    display: flex;
    flex-direction: column;
    gap: 9px;
}

.filter-role-option,
.sort-option {
    display: flex;
    align-items: center;
    gap: 9px;
    color: #475569;
    font-size: 12px;
    cursor: pointer;
}

.filter-role-option input,
.sort-option input {
    position: absolute;
    opacity: 0;
    pointer-events: none;
}

.custom-checkbox,
.custom-radio {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 17px;
    height: 17px;
    flex-shrink: 0;
    border: 1px solid #cbd5e1;
    background: #ffffff;
    transition: all 0.2s ease;
}

.custom-checkbox {
    border-radius: 5px;
}

.custom-radio {
    border-radius: 50%;
}

.filter-role-option input:checked + .custom-checkbox {
    border-color: #2563eb;
    background: #2563eb;
}

.filter-role-option input:checked + .custom-checkbox::after {
    content: "";
    width: 8px;
    height: 4px;
    border-left: 2px solid #ffffff;
    border-bottom: 2px solid #ffffff;
    transform: rotate(-45deg) translateY(-1px);
}

.sort-option input:checked + .custom-radio {
    border: 5px solid #2563eb;
}

.dropdown-actions {
    display: flex;
    align-items: center;
    justify-content: flex-end;
    gap: 9px;
    padding-top: 13px;
    border-top: 1px solid #edf1f7;
}

.dropdown-clear {
    color: #64748b;
    font-size: 11px;
    font-weight: 750;
    text-decoration: none;
}

.dropdown-clear:hover {
    color: #2563eb;
}

.dropdown-apply {
    min-height: 34px;
    padding: 0 12px;
    border: 0;
    border-radius: 9px;
    background: #2563eb;
    color: #ffffff;
    font-family: inherit;
    font-size: 11px;
    font-weight: 750;
    cursor: pointer;
}

.dropdown-apply:hover {
    background: #1d4ed8;
}

.users-result-label {
    color: #94a3b8;
    font-size: 11px;
    font-weight: 700;
}


/* =========================================================
   USERS CARD
========================================================= */

.users-card {
    overflow: visible;
    border: 1px solid #e5ebf3;
    border-radius: 20px;
    background: #ffffff;
    box-shadow: 0 8px 28px rgba(15, 23, 42, 0.045);
}

.quick-filters {
    display: flex;
    align-items: center;
    gap: 10px;
    padding: 17px 20px;
    border-bottom: 1px solid #edf1f7;
    overflow-x: auto;
}


.quick-filter {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    min-height: 32px;
    padding: 0 13px;
    border-radius: 9px;
    color: #64748b;
    font-size: 11px;
    font-weight: 750;
    text-decoration: none;
    white-space: nowrap;
    transition: all 0.2s ease;
}

.quick-filter:hover {
    background: #eff6ff;
    color: #2563eb;
}

.quick-filter.active {
    background: #eff6ff;
    color: #2563eb;
}


/* =========================================================
   TABLE
========================================================= */

.users-table-wrapper {
    width: 100%;
    overflow-x: auto;
}

.users-table {
    width: 100%;
    min-width: 950px;
    border-collapse: collapse;
    text-align: left;
}

.users-table thead {
    background: #f8fafc;
}

.users-table th {
    padding: 14px 18px;
    border-bottom: 1px solid #e8eef5;
    color: #94a3b8;
    font-size: 10px;
    font-weight: 800;
    letter-spacing: 0.5px;
    text-transform: uppercase;
    white-space: nowrap;
}

.users-table td {
    padding: 16px 18px;
    border-bottom: 1px solid #edf1f7;
    vertical-align: middle;
}

.users-table tbody tr {
    transition: background 0.2s ease;
}

.users-table tbody tr:hover {
    background: #fbfdff;
}

.users-table tbody tr:last-child td {
    border-bottom: 0;
}

.users-id-heading,
.users-id {
    width: 70px;
}

.users-profile-heading,
.users-profile {
    width: 85px;
}

.users-action-heading {
    width: 165px;
}

.id-badge {
    display: inline-flex;
    align-items: center;
    min-height: 25px;
    padding: 0 8px;
    border-radius: 7px;
    background: #f1f5f9;
    color: #64748b;
    font-size: 10px;
    font-weight: 800;
}

.user-avatar {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 42px;
    height: 42px;
    overflow: hidden;
    border: 2px solid #eff6ff;
    border-radius: 13px;
    background: linear-gradient(135deg, #dbeafe, #e0e7ff);
    color: #2563eb;
    font-size: 15px;
    font-weight: 800;
}

.user-avatar img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.user-details {
    display: flex;
    flex-direction: column;
    gap: 4px;
}

.user-name {
    color: #334155;
    font-size: 13px;
    font-weight: 800;
}

.user-email {
    color: #94a3b8;
    font-size: 11px;
}

.user-roles {
    display: flex;
    flex-wrap: wrap;
    gap: 5px;
}

.user-role {
    display: inline-flex;
    align-items: center;
    min-height: 25px;
    padding: 0 9px;
    border-radius: 7px;
    font-size: 10px;
    font-weight: 800;
    white-space: nowrap;
}

.role-admin {
    background: #fee2e2;
    color: #b91c1c;
}

.role-hod {
    background: #f3e8ff;
    color: #7e22ce;
}

.role-professor {
    background: #dbeafe;
    color: #1d4ed8;
}

.role-student {
    background: #dcfce7;
    color: #15803d;
}

.role-default {
    background: #f1f5f9;
    color: #475569;
}

.user-departments {
    max-width: 220px;
    color: #475569;
    font-size: 11px;
    line-height: 1.6;
}

.empty-value {
    color: #a1acbb;
    font-size: 11px;
    font-style: italic;
}

.users-actions {
    display: flex;
    align-items: center;
    flex-wrap: wrap;
    gap: 7px;
}

.user-action-edit,
.user-action-delete {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 5px;
    min-height: 31px;
    padding: 0 10px;
    border-radius: 8px;
    font-family: inherit;
    font-size: 10px;
    font-weight: 800;
    text-decoration: none;
    cursor: pointer;
    transition: all 0.2s ease;
}

.user-action-edit {
    border: 1px solid #dbeafe;
    background: #eff6ff;
    color: #2563eb;
}

.user-action-edit:hover {
    background: #dbeafe;
    border-color: #bfdbfe;
}

.user-action-delete {
    border: 1px solid #fee2e2;
    background: #fff1f2;
    color: #dc2626;
}

.user-action-delete:hover {
    background: #fee2e2;
    border-color: #fecaca;
}

.user-action-edit svg,
.user-action-delete svg {
    width: 14px;
    height: 14px;
}

.user-delete-form {
    margin: 0;
}


/* =========================================================
   EMPTY STATE
========================================================= */

.table-empty {
    padding: 65px 20px !important;
}

.table-empty-content {
    display: flex;
    align-items: center;
    flex-direction: column;
    text-align: center;
}

.table-empty-icon {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 58px;
    height: 58px;
    margin-bottom: 14px;
    border-radius: 17px;
    background: #f1f5f9;
    color: #94a3b8;
}

.table-empty-icon svg {
    width: 29px;
    height: 29px;
}

.table-empty-content h3 {
    margin: 0;
    color: #334155;
    font-size: 16px;
    font-weight: 800;
}

.table-empty-content p {
    margin: 7px 0 15px;
    color: #94a3b8;
    font-size: 12px;
}

.empty-reset-button {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    min-height: 34px;
    padding: 0 13px;
    border-radius: 9px;
    background: #eff6ff;
    color: #2563eb;
    font-size: 11px;
    font-weight: 800;
    text-decoration: none;
}

.empty-reset-button:hover {
    background: #dbeafe;
}


/* =========================================================
   PAGINATION - LEFT
========================================================= */

.pagination-wrapper {
    display: flex;
    align-items: center;
    justify-content: flex-start;
    padding: 18px 22px;
    border-top: 1px solid #edf1f7;
}

/* =========================================================
   SUCCESS MESSAGE
========================================================= */

.user-success-message {
    display: flex;
    align-items: center;
    gap: 12px;
    margin-bottom: 16px;
    padding: 13px 15px;
    border: 1px solid #bbf7d0;
    border-radius: 13px;
    background: #f0fdf4;
    color: #166534;
}

.user-success-icon {
    width: 32px;
    height: 32px;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
    border-radius: 9px;
    background: #dcfce7;
    color: #16a34a;
}

.user-success-icon svg {
    width: 18px;
    height: 18px;
}

.user-success-content {
    display: flex;
    flex-direction: column;
    gap: 2px;
    min-width: 0;
    flex: 1;
}

.user-success-content strong {
    color: #166534;
    font-size: 12px;
    font-weight: 800;
}

.user-success-content span {
    color: #15803d;
    font-size: 12px;
    line-height: 1.4;
}

.user-success-close {
    width: 30px;
    height: 30px;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
    border: 0;
    border-radius: 8px;
    background: transparent;
    color: #65a30d;
    cursor: pointer;
}

.user-success-close:hover {
    background: #dcfce7;
    color: #166534;
}

.user-success-close svg {
    width: 16px;
    height: 16px;
}
.dark-mode .user-success-message {
    border-color: rgba(74, 222, 128, 0.25);
    background: rgba(74, 222, 128, 0.08);
}

.dark-mode .user-success-icon {
    background: rgba(74, 222, 128, 0.14);
    color: #4ade80;
}

.dark-mode .user-success-content strong {
    color: #86efac;
}

.dark-mode .user-success-content span {
    color: #bbf7d0;
}

.dark-mode .user-success-close {
    color: #86efac;
}

.dark-mode .user-success-close:hover {
    background: rgba(74, 222, 128, 0.12);
    color: #bbf7d0;
}

/* =========================================================
   RESPONSIVE
========================================================= */

@media (max-width: 850px) {

    .users-page {
        padding: 20px 16px 25px;
    }

    .users-header {
        align-items: flex-start;
        flex-direction: column;
        gap: 15px;
    }

    .users-header h1 {
        font-size: 27px;
    }

    .users-toolbar {
        align-items: flex-start;
        flex-direction: column;
    }

    .toolbar-right {
        display: none;
    }

}


@media (max-width: 560px) {

    .users-page {
        padding: 16px 12px 22px;
    }

    .users-header h1 {
        font-size: 24px;
    }

    .users-header p {
        font-size: 12px;
    }

    .users-create-button {
        width: 100%;
    }

    .toolbar-left {
        width: 100%;
    }

    .users-search-form {
        width: 100%;
    }

    .users-search-box {
        width: 100%;
    }

    .toolbar-button {
        flex: 1;
    }

    .users-dropdown {
        flex: 1;
    }

    .users-dropdown-panel {
        left: 0;
        max-width: calc(100vw - 35px);
    }

    .quick-filters {
        padding: 13px;
    }

    .users-card {
        border-radius: 16px;
    }

}

/* =========================================================
   USER INDEX / CREATE / EDIT DARK MODE
   Uses the colors from variable.css
========================================================= */

.dark-mode .users-header,
.dark-mode .users-card,
.dark-mode .create-header,
.dark-mode .edit-header,
.dark-mode .create-form-card,
.dark-mode .edit-form-card,
.dark-mode .form-card,
.dark-mode .user-form-card {
    background-color: var(--card-color);
    color: var(--text-color);
    border-color: var(--border-color);
}

/* Headings */
.dark-mode .users-header h1,
.dark-mode .users-header h2,
.dark-mode .users-header h3,
.dark-mode .create-header h1,
.dark-mode .edit-header h1,
.dark-mode .form-card h1,
.dark-mode .form-card h2,
.dark-mode .form-card h3 {
    color: var(--heading-color);
}

/* Descriptions and secondary text */
.dark-mode .users-header p,
.dark-mode .create-header p,
.dark-mode .edit-header p,
.dark-mode .form-card p,
.dark-mode .form-description {
    color: var(--secondary-text-color);
}

/* Toolbar */
.dark-mode .users-toolbar {
    background-color: var(--card-color);
    border-color: var(--border-color);
}

/* Table */
.dark-mode .users-table,
.dark-mode .users-table table {
    background-color: var(--card-color);
    color: var(--text-color);
}

.dark-mode .users-table thead,
.dark-mode .users-table th {
    background-color: var(--table-header-bg);
    color: #ffffff;
    border-color: var(--table-divider);
}

.dark-mode .users-table td {
    background-color: var(--card-color);
    color: var(--text-color);
    border-color: var(--table-divider);
}

.dark-mode .users-table tbody tr:hover td {
    background-color: var(--table-row-hover);
}

/* User name and email */
.dark-mode .user-name {
    color: var(--heading-color);
}

.dark-mode .user-email,
.dark-mode .user-department,
.dark-mode .user-details,
.dark-mode .empty-value {
    color: var(--secondary-text-color);
}

/* Avatar */
.dark-mode .user-avatar,
.dark-mode .avatar,
.dark-mode .profile-avatar {
    background-color: var(--surface-hover);
    color: var(--icon-color);
}

/* Form labels */
.dark-mode .create-form-card label,
.dark-mode .edit-form-card label,
.dark-mode .form-card label,
.dark-mode .user-form-card label {
    color: var(--text-color);
}

/* Inputs */
.dark-mode .create-form-card input,
.dark-mode .create-form-card select,
.dark-mode .create-form-card textarea,
.dark-mode .edit-form-card input,
.dark-mode .edit-form-card select,
.dark-mode .edit-form-card textarea,
.dark-mode .form-card input,
.dark-mode .form-card select,
.dark-mode .form-card textarea,
.dark-mode .user-form-card input,
.dark-mode .user-form-card select,
.dark-mode .user-form-card textarea {
    background-color: var(--surface-color);
    color: var(--text-color);
    border-color: var(--border-color);
}

/* Input placeholder */
.dark-mode .create-form-card input::placeholder,
.dark-mode .create-form-card textarea::placeholder,
.dark-mode .edit-form-card input::placeholder,
.dark-mode .edit-form-card textarea::placeholder,
.dark-mode .form-card input::placeholder,
.dark-mode .form-card textarea::placeholder {
    color: var(--placeholder-color);
}

/* Select dropdown options */
.dark-mode .create-form-card select option,
.dark-mode .edit-form-card select option,
.dark-mode .form-card select option {
    background-color: var(--card-color);
    color: var(--text-color);
}

/* Input focus */
.dark-mode .create-form-card input:focus,
.dark-mode .create-form-card select:focus,
.dark-mode .create-form-card textarea:focus,
.dark-mode .edit-form-card input:focus,
.dark-mode .edit-form-card select:focus,
.dark-mode .edit-form-card textarea:focus,
.dark-mode .form-card input:focus,
.dark-mode .form-card select:focus,
.dark-mode .form-card textarea:focus {
    background-color: var(--surface-color);
    color: var(--text-color);
    border-color: var(--primary-color);
    box-shadow: 0 0 0 3px var(--primary-light);
}

/* Input icons */
.dark-mode .input-icon,
.dark-mode .input-wrap i,
.dark-mode .input-wrap svg {
    color: var(--icon-color);
}

/* Back buttons */
.dark-mode .back-button,
.dark-mode .back-dashboard,
.dark-mode .users-back-button {
    background-color: var(--surface-color);
    color: var(--text-color);
    border-color: var(--border-color);
}

.dark-mode .back-button:hover,
.dark-mode .back-dashboard:hover,
.dark-mode .users-back-button:hover {
    background-color: var(--surface-hover);
    color: var(--heading-color);
}

/* Secondary buttons */
.dark-mode .secondary-button,
.dark-mode .users-secondary-button,
.dark-mode .form-button.secondary {
    background-color: var(--surface-color);
    color: var(--text-color);
    border-color: var(--border-color);
}

.dark-mode .secondary-button:hover,
.dark-mode .users-secondary-button:hover,
.dark-mode .form-button.secondary:hover {
    background-color: var(--surface-hover);
}

/* Edit and delete actions */
.dark-mode .edit-button,
.dark-mode .user-action-edit {
    color: var(--primary-color);
}

.dark-mode .edit-button:hover,
.dark-mode .user-action-edit:hover {
    background-color: var(--surface-hover);
}

.dark-mode .delete-button,
.dark-mode .user-action-delete {
    color: var(--danger-color);
}

.dark-mode .delete-button:hover,
.dark-mode .user-action-delete:hover {
    background-color: rgba(255, 141, 141, 0.12);
}

/* Pagination */
.dark-mode .pagination,
.dark-mode .table-pagination {
    background-color: var(--card-color);
    border-color: var(--border-color);
    color: var(--secondary-text-color);
}

.dark-mode .pagination a,
.dark-mode .pagination span,
.dark-mode .table-pagination a,
.dark-mode .table-pagination span {
    color: var(--secondary-text-color);
    background-color: transparent;
    border-color: var(--border-color);
}

.dark-mode .pagination a:hover,
.dark-mode .table-pagination a:hover {
    background-color: var(--surface-hover);
    color: var(--heading-color);
}

/* Active pagination */
.dark-mode .pagination .active span,
.dark-mode .table-pagination .active span {
    background-color: var(--primary-color);
    color: var(--button-text-color);
}

/* Error messages */
.dark-mode .error-message,
.dark-mode .invalid-feedback,
.dark-mode .text-danger {
    color: var(--danger-color);
}

/* Required star */
.dark-mode .required,
.dark-mode .required-mark {
    color: var(--danger-color);
}

/* Horizontal lines */
.dark-mode .users-card hr,
.dark-mode .create-form-card hr,
.dark-mode .edit-form-card hr,
.dark-mode .form-card hr {
    border-color: var(--border-color);
}
/* =========================================================
   COMPLETE USER INDEX DARK MODE FIX
========================================================= */

.dark-mode .users-page {
    color: var(--text-color);
}

/* Back to dashboard */
.dark-mode .top-dashboard-link a {
    color: var(--secondary-text-color);
}

.dark-mode .top-dashboard-link a:hover {
    color: var(--primary-color);
}

/* Header */
.dark-mode .users-header h1 {
    color: var(--heading-color);
}

.dark-mode .users-header p {
    color: var(--secondary-text-color);
}

/* Create user button */
.dark-mode .users-create-button {
    background: linear-gradient(
        135deg,
        var(--primary-color),
        var(--primary-hover)
    );
    color: var(--button-text-color);
}

/* Toolbar search */
.dark-mode .users-search-box {
    background-color: var(--surface-color);
    border-color: var(--border-color);
}

.dark-mode .users-search-box:focus-within {
    border-color: var(--primary-color);
    box-shadow: 0 0 0 4px var(--primary-light);
}

.dark-mode .search-icon {
    color: var(--icon-color);
}

.dark-mode .users-search-box input {
    background-color: transparent;
    color: var(--text-color);
}

.dark-mode .users-search-box input::placeholder {
    color: var(--placeholder-color);
}

.dark-mode .clear-search {
    color: var(--secondary-text-color);
}

.dark-mode .clear-search:hover {
    background-color: var(--surface-hover);
    color: var(--text-color);
}

/* Filter and sort buttons */
.dark-mode .toolbar-button {
    background-color: var(--surface-color);
    border-color: var(--border-color);
    color: var(--text-color);
}

.dark-mode .toolbar-button:hover,
.dark-mode .toolbar-button.active {
    background-color: var(--surface-hover);
    border-color: var(--primary-color);
    color: var(--primary-color);
}

.dark-mode .toolbar-count {
    background-color: var(--primary-color);
    color: var(--button-text-color);
}

/* Filter and sort dropdown panels */
.dark-mode .users-dropdown-panel {
    background-color: var(--card-color);
    border-color: var(--border-color);
    box-shadow: 0 18px 45px rgba(0, 0, 0, 0.35);
}

.dark-mode .dropdown-heading {
    border-bottom-color: var(--border-color);
}

.dark-mode .dropdown-heading h3 {
    color: var(--heading-color);
}

.dark-mode .dropdown-heading p {
    color: var(--secondary-text-color);
}

.dark-mode .dropdown-label {
    color: var(--secondary-text-color);
}

.dark-mode .filter-role-option,
.dark-mode .sort-option {
    color: var(--text-color);
}

/* Custom checkbox and radio */
.dark-mode .custom-checkbox,
.dark-mode .custom-radio {
    background-color: var(--surface-color);
    border-color: var(--border-color);
}

.dark-mode .filter-role-option input:checked + .custom-checkbox,
.dark-mode .sort-option input:checked + .custom-radio {
    background-color: var(--primary-color);
    border-color: var(--primary-color);
}

.dark-mode .filter-role-option input:checked + .custom-checkbox::after {
    border-color: #ffffff;
}

.dark-mode .dropdown-actions {
    border-top-color: var(--border-color);
}

.dark-mode .dropdown-clear {
    color: var(--secondary-text-color);
}

.dark-mode .dropdown-clear:hover {
    color: var(--primary-color);
}

.dark-mode .dropdown-apply {
    background-color: var(--primary-color);
    color: var(--button-text-color);
}

.dark-mode .dropdown-apply:hover {
    background-color: var(--primary-hover);
}

.dark-mode .users-result-label {
    color: var(--secondary-text-color);
}

/* Main users card */
.dark-mode .users-card {
    background-color: var(--card-color);
    border-color: var(--border-color);
    box-shadow: 0 8px 28px rgba(0, 0, 0, 0.25);
}

/* Quick filters */
.dark-mode .quick-filters {
    background-color: var(--card-color);
    border-bottom-color: var(--border-color);
}

.dark-mode .quick-filter {
    color: var(--secondary-text-color);
}

.dark-mode .quick-filter:hover {
    background-color: var(--primary-light);
    color: var(--primary-color);
}

.dark-mode .quick-filter.active {
    background-color: var(--primary-light);
    color: var(--primary-color);
}

/* Table */
.dark-mode .users-table {
    background-color: var(--card-color);
    color: var(--text-color);
}

.dark-mode .users-table thead {
    background-color: var(--table-header-bg);
}

.dark-mode .users-table th {
    background-color: var(--table-header-bg);
    color: #ffffff;
    border-bottom-color: var(--table-divider);
}

.dark-mode .users-table td {
    background-color: var(--card-color);
    color: var(--text-color);
    border-bottom-color: var(--table-divider);
}

.dark-mode .users-table tbody tr:hover,
.dark-mode .users-table tbody tr:hover td {
    background-color: var(--table-row-hover);
}

/* ID badge */
.dark-mode .id-badge {
    background-color: var(--surface-hover);
    color: var(--secondary-text-color);
}

/* Avatar */
.dark-mode .user-avatar {
    background: var(--surface-hover);
    border-color: var(--border-color);
    color: var(--primary-color);
}

/* User details */
.dark-mode .user-name {
    color: var(--heading-color);
}

.dark-mode .user-email {
    color: var(--secondary-text-color);
}

.dark-mode .user-departments {
    color: var(--text-color);
}

.dark-mode .empty-value {
    color: var(--secondary-text-color);
}

/* Role badges */
.dark-mode .role-admin {
    background-color: rgba(255, 141, 141, 0.16);
    color: var(--danger-color);
}

.dark-mode .role-hod {
    background-color: rgba(196, 181, 253, 0.16);
    color: #c4b5fd;
}

.dark-mode .role-professor {
    background-color: rgba(109, 118, 255, 0.18);
    color: var(--primary-hover);
}

.dark-mode .role-student {
    background-color: rgba(73, 213, 167, 0.16);
    color: var(--success-color);
}

.dark-mode .role-default {
    background-color: var(--surface-hover);
    color: var(--secondary-text-color);
}

/* Action buttons */
.dark-mode .user-action-edit {
    background-color: var(--primary-light);
    border-color: var(--primary-border);
    color: var(--primary-hover);
}

.dark-mode .user-action-edit:hover {
    background-color: var(--surface-hover);
    border-color: var(--primary-color);
}

.dark-mode .user-action-delete {
    background-color: rgba(255, 141, 141, 0.12);
    border-color: rgba(255, 141, 141, 0.25);
    color: var(--danger-color);
}

.dark-mode .user-action-delete:hover {
    background-color: rgba(255, 141, 141, 0.2);
    border-color: var(--danger-color);
}

/* Empty table state */
.dark-mode .table-empty-icon {
    background-color: var(--surface-hover);
    color: var(--icon-color);
}

.dark-mode .table-empty-content h3 {
    color: var(--heading-color);
}

.dark-mode .table-empty-content p {
    color: var(--secondary-text-color);
}

.dark-mode .empty-reset-button {
    background-color: var(--primary-light);
    color: var(--primary-hover);
}

.dark-mode .empty-reset-button:hover {
    background-color: var(--surface-hover);
}

/* Pagination */
.dark-mode .pagination-wrapper {
    background-color: var(--card-color);
    border-top-color: var(--border-color);
}

/* Laravel custom pagination */
.dark-mode .pagination-wrapper nav,
.dark-mode .pagination-wrapper ul {
    color: var(--text-color);
}

.dark-mode .pagination-wrapper a,
.dark-mode .pagination-wrapper span {
    background-color: transparent;
    color: var(--secondary-text-color);
    border-color: var(--border-color);
}

.dark-mode .pagination-wrapper a:hover {
    background-color: var(--surface-hover);
    color: var(--heading-color);
}

.dark-mode .pagination-wrapper .active span,
.dark-mode .pagination-wrapper [aria-current="page"] span {
    background-color: var(--primary-color);
    color: var(--button-text-color);
    border-color: var(--primary-color);
}

/* Force all table-related white backgrounds to use dark colors */
.dark-mode .users-card *,
.dark-mode .users-table-wrapper *,
.dark-mode .pagination-wrapper * {
    scrollbar-color: var(--border-color) var(--card-color);
}

</style>



<script>

document.addEventListener('DOMContentLoaded', function () {

    const filterButton = document.getElementById('filter-button');
    const filterPanel = document.getElementById('filter-panel');

    const sortButton = document.getElementById('sort-button');
    const sortPanel = document.getElementById('sort-panel');


    function closePanels() {

        filterPanel?.classList.remove('open');
        sortPanel?.classList.remove('open');

        filterButton?.classList.remove('active');
        sortButton?.classList.remove('active');

    }


    filterButton?.addEventListener('click', function (event) {

        event.stopPropagation();

        const isOpen = filterPanel.classList.contains('open');

        closePanels();

        if (!isOpen) {

            filterPanel.classList.add('open');
            filterButton.classList.add('active');

        }

    });


    sortButton?.addEventListener('click', function (event) {

        event.stopPropagation();

        const isOpen = sortPanel.classList.contains('open');

        closePanels();

        if (!isOpen) {

            sortPanel.classList.add('open');
            sortButton.classList.add('active');

        }

    });


    filterPanel?.addEventListener('click', function (event) {

        event.stopPropagation();

    });


    sortPanel?.addEventListener('click', function (event) {

        event.stopPropagation();

    });


    document.addEventListener('click', function () {

        closePanels();

    });

});

</script>

@endsection 