@extends('layouts.admin_layout')

@section('title', 'User Management')

@section('content')

<div class="users-page">

    {{-- Header --}}
    <div class="users-header">

        <div class="users-header-content">
            <span class="users-eyebrow">Administration</span>

            <h1>User Management</h1>

            <p>
                Manage users, roles, and department assignments
                across the university system.
            </p>
        </div>

        <div class="users-header-actions">
            <a href="{{ route('admin.users.create') }}" class="users-create-button">
                <span class="users-create-icon">+</span>
                Create User
            </a>
        </div>

    </div>




            {{-- Toolbar --}}
        <div class="table-toolbar">

            <div class="table-controls">

                {{-- Search --}}
                <form method="GET"
                    action="{{ route('admin.users.index') }}"
                    class="table-search">

                    @if(request('role'))
                    <input type="hidden" name="role" value="{{ request('role') }}">
                    @endif

                    @foreach(request('roles', []) as $role)
                    <input type="hidden" name="roles[]" value="{{ $role }}">
                    @endforeach

                    @if(request('sort'))
                    <input type="hidden" name="sort" value="{{ request('sort') }}">
                    @endif

                    <div class="table-search-wrapper">

                        <svg class="table-search-icon"
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="2">
                            <circle cx="11" cy="11" r="7"></circle>
                            <line x1="16.5" y1="16.5" x2="21" y2="21"></line>
                        </svg>

                        <input type="text"
                            name="search"
                            value="{{ request('search') }}"
                            placeholder="Search users...">

                    </div>

                </form>


                {{-- Filter --}}
                <div class="table-control-dropdown">

                    <button type="button"
                        class="table-control-button"
                        id="filter-button">

                        <svg viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="2">
                            <line x1="4" y1="6" x2="20" y2="6"></line>
                            <line x1="7" y1="12" x2="17" y2="12"></line>
                            <line x1="10" y1="18" x2="14" y2="18"></line>
                        </svg>

                        Filter

                    </button>


                    <form method="GET"
                        action="{{ route('admin.users.index') }}"
                        class="table-dropdown-panel"
                        id="filter-panel">

                        @if(request('search'))
                        <input type="hidden" name="search" value="{{ request('search') }}">
                        @endif

                        @if(request('role'))
                        <input type="hidden" name="role" value="{{ request('role') }}">
                        @endif

                        @if(request('sort'))
                        <input type="hidden" name="sort" value="{{ request('sort') }}">
                        @endif


                        <div class="table-dropdown-header">
                            <h3>Filter Users</h3>
                            <p>Select one or more roles.</p>
                        </div>


                        <div class="table-dropdown-section">

                            <span class="table-dropdown-label">
                                Roles
                            </span>

                            <div class="table-role-options">

                                @php
                                $filterRoles = [
                                'Admin',
                                'Dean',
                                'HoD',
                                'Professor',
                                'Student',
                                ];
                                @endphp

                                @foreach($filterRoles as $role)

                                <label class="table-role-option">

                                    <input type="checkbox"
                                        name="roles[]"
                                        value="{{ $role }}"
                                        {{ in_array($role, request()->input('roles', [])) ? 'checked' : '' }}>

                                    <span>{{ $role }}</span>

                                </label>

                                @endforeach

                            </div>

                        </div>


                        <div class="table-dropdown-actions">

                            <a href="{{ route('admin.users.index', array_filter([
                                'search' => request('search'),
                                'role' => request('role'),
                                'sort' => request('sort'),
                            ])) }}"
                                class="table-dropdown-clear">
                                Clear
                            </a>

                            <button type="submit" class="table-dropdown-apply">
                                Apply Filter
                            </button>

                        </div>

                    </form>

                </div>


                {{-- Sort by --}}
                <div class="table-control-dropdown">

                    <button type="button"
                        class="table-control-button"
                        id="sort-button">

                        <svg viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="2">
                            <path d="M8 6h13"></path>
                            <path d="M8 12h10"></path>
                            <path d="M8 18h7"></path>
                            <path d="M3 6l2-2 2 2"></path>
                            <path d="M5 4v16"></path>
                        </svg>

                        Sort By

                    </button>


                    <form method="GET"
                        action="{{ route('admin.users.index') }}"
                        class="table-dropdown-panel sort-panel"
                        id="sort-panel">

                        @if(request('search'))
                        <input type="hidden" name="search" value="{{ request('search') }}">
                        @endif

                        @if(request('role'))
                        <input type="hidden" name="role" value="{{ request('role') }}">
                        @endif

                        @foreach(request('roles', []) as $role)
                        <input type="hidden" name="roles[]" value="{{ $role }}">
                        @endforeach


                        <div class="table-dropdown-header">
                            <h3>Sort Users</h3>
                            <p>Choose how users are ordered.</p>
                        </div>


                        <div class="table-sort-options">

                            @foreach([
                            'name_asc' => 'Name A–Z',
                            'name_desc' => 'Name Z–A',
                            'newest' => 'Newest first',
                            'oldest' => 'Oldest first',
                            ] as $value => $label)

                            <label class="table-sort-option">

                                <input type="radio"
                                    name="sort"
                                    value="{{ $value }}"
                                    {{ request('sort') === $value ? 'checked' : '' }}>

                                <span>{{ $label }}</span>

                            </label>

                            @endforeach

                        </div>


                        <div class="table-dropdown-actions">

                            <a href="{{ route('admin.users.index', array_filter([
                            'search' => request('search'),
                            'sort' => request('sort'),
                        ])) }}"
                                class="table-dropdown-clear">
                                Clear
                            </a>

                            <button type="submit" class="table-dropdown-apply">
                                Apply Sort
                            </button>

                        </div>

                    </form>

                </div>

            </div>

        </div>

        
    {{-- Users Card --}}
    <div class="users-card">




        {{-- Quick Filters --}}
        @php
        $quickFilters = [
        '' => 'All',
        'Admin' => 'Admin',
        'academic_staff' => 'Academic Staff',
        'Dean' => 'Dean',
        'HoD' => 'HoD',
        'Professor' => 'Professor',
        'Student' => 'Student',
        ];
        @endphp

        <div class="quick-filters">

            @foreach($quickFilters as $value => $label)

            <a href="{{ route('admin.users.index', array_filter([
                    'role'   => $value,
                    'search' => request('search'),
                    'sort'   => request('sort'),
                ])) }}"
                class="quick-filter {{ request('role', '') === $value ? 'active' : '' }}">

                {{ $label }}

            </a>

            @endforeach

        </div>


        {{-- Users Table --}}
        @php
        $roleStyles = [
        'Admin' => 'role-admin',
        'Dean' => 'role-dean',
        'HoD' => 'role-hod',
        'Professor' => 'role-professor',
        'Student' => 'role-student',
        ];
        @endphp

        <div class="users-table-wrapper">

            <table class="users-table">

                <thead>
                    <tr>
                        <th class="users-id-heading">ID</th>
                        <th class="users-profile-heading">Profile</th>
                        <th>User</th>
                        <th>Role</th>
                        <th>Department</th>
                        <th class="users-action-heading">Actions</th>
                    </tr>
                </thead>


                <tbody>

                    @forelse($users as $user)

                    <tr>

                        {{-- ID --}}
                        <td class="users-id">
                            {{ $user->id }}
                        </td>


                        {{-- Profile --}}
                        <td class="users-profile">

                            <div class="user-avatar">

                                @if($user->profile_image)

                                <img src="{{ asset('storage/' . $user->profile_image) }}"
                                    alt="{{ $user->name }}">

                                @else

                                <span>
                                    {{ strtoupper(substr($user->name, 0, 1)) }}
                                </span>

                                @endif

                            </div>

                        </td>


                        {{-- User --}}
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


                        {{-- Roles --}}
                        <td>

                            <div class="user-roles">

                                @forelse($user->roles as $role)

                                <span class="user-role {{ $roleStyles[$role->role_name] ?? 'role-default' }}">
                                    {{ $role->role_name }}
                                </span>

                                @empty

                                <span class="empty-value">
                                    No role
                                </span>

                                @endforelse

                            </div>

                        </td>


                        {{-- Department --}}
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


                        {{-- Actions --}}
                        <td class="users-actions">

                            @if(!$user->isStudent())

                            <a href="{{ route('admin.users.edit', $user->id) }}"
                                class="user-action-edit">
                                Edit
                            </a>

                            @endif


                            @if(!$user->roles->contains('role_name', 'Admin'))

                            <form method="POST"
                                action="{{ route('admin.users.destroy', $user->id) }}"
                                class="user-delete-form"
                                onsubmit="return confirm('This action will permanently delete this user. Continue?')">

                                @csrf
                                @method('DELETE')

                                <button type="submit" class="user-action-delete">
                                    Delete
                                </button>

                            </form>

                            @endif

                        </td>

                    </tr>

                    @empty

                    <tr>
                        <td colspan="6" class="table-empty">

                            <div class="table-empty-content">

                                <div class="table-empty-icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-user-round-x-icon lucide-user-round-x">
                                        <path d="M2 21a8 8 0 0 1 11.873-7" />
                                        <circle cx="10" cy="8" r="5" />
                                        <path d="m17 17 5 5" />
                                        <path d="m22 17-5 5" />
                                    </svg>
                                </div>

                                <h3>No users found</h3>

                                <p>
                                    There are no users matching
                                    the selected filter.
                                </p>

                            </div>

                        </td>
                    </tr>

                    @endforelse

                </tbody>

            </table>

        </div>


        {{-- Pagination --}}
        @if($users->hasPages())

        <!-- Pagination -->
        <div class="pagination-wrapper">

            {{ $users->appends(request()->query())->links('vendor.pagination.custom') }}
        </div>

        @endif


        {{-- Footer Actions --}}
        <div class="users-footer">

            <a href="{{ route('admin.assign_dean.index') }}"
                class="users-secondary-button">
                Assign Dean Department
            </a>

            <a href="{{ route('admin.dashboard') }}"
                class="users-back-button">
                ← Back to Dashboard
            </a>

        </div>

    </div>

</div>

@endsection