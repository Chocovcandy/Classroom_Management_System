@extends('layouts.admin_layout')

@section('title', 'Departments')

@section('content')

<div class="department-page">

    <!-- Header -->
    <div class="department-header">

        <div class="department-header-content">


            <h1>Departments Management</h1>

            <p>
                Manage university departments, update information,
                and maintain department records.
            </p>

            <a href="{{ route('admin.departments.create') }}"
                class="add-department-btn">


                <span>Create Department</span>

            </a>

        </div>

        <div class="department-illustration">
            <div id="department-animation"></div>
        </div>

    </div>


    <!-- Toolbar -->
    <div class="table-toolbar">

        <div class="table-controls">

            {{-- Search --}}
            <form method="GET"
                action="{{ route('admin.departments.index') }}"
                class="table-search">

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
                    action="{{ route('admin.departments.index') }}"
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



    <!-- Department Table -->
    <div class="department-table-wrapper">

        <table class="department-table">

            <thead>
                <tr>
                    <th>ID</th>
                    <th>Department</th>
                    <th>Description</th>
                    <th>Created</th>
                    <th>Action</th>
                </tr>
            </thead>

     <tbody>

                @forelse($departments as $department)

                <tr>

                    <td class="department-id">
                        #{{ str_pad($department->id, 2, '0', STR_PAD_LEFT) }}
                    </td>

                    <td>
                        <div class="department-name">

                            <div class="department-icon">
                                <svg xmlns="http://www.w3.org/2000/svg"
                                    width="24"
                                    height="24"
                                    viewBox="0 0 24 24"
                                    fill="none"
                                    stroke="currentColor"
                                    stroke-width="2"
                                    stroke-linecap="round"
                                    stroke-linejoin="round">

                                    <path d="M12 10h.01" />
                                    <path d="M12 14h.01" />
                                    <path d="M12 6h.01" />
                                    <path d="M16 10h.01" />
                                    <path d="M16 14h.01" />
                                    <path d="M16 6h.01" />
                                    <path d="M8 10h.01" />
                                    <path d="M8 14h.01" />
                                    <path d="M8 6h.01" />
                                    <path d="M9 22v-3a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v3" />
                                    <rect x="4" y="2" width="16" height="20" rx="2" />

                                </svg>
                            </div>

                            <div class="department-name-text">
                                <h3>{{ $department->department_name }}</h3>
                                <span>Department</span>
                            </div>

                        </div>
                    </td>

                    <td class="department-description">
                        {{ $department->description }}
                    </td>

                    <td class="department-date">
                        {{ $department->created_at->format('M d, Y') }}
                    </td>

                    <td>
                        <div class="table-actions">

                            <a href="{{ route('admin.departments.edit', $department->id) }}"
                                class="action-btn edit-btn">

                                <!-- Edit icon -->
                                <svg xmlns="http://www.w3.org/2000/svg"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke-width="1.5"
                                    stroke="currentColor">

                                    <path stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />

                                </svg>

                                <small>Edit</small>

                            </a>

                            <form action="{{ route('admin.departments.destroy', $department->id) }}"
                                method="POST">

                                @csrf
                                @method('DELETE')

                                <button type="submit"
                                    class="action-btn delete-btn">

                                    <!-- Delete icon -->
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                        stroke-width="1.5"
                                        stroke="currentColor">

                                        <path stroke-linecap="round"
                                            stroke-linejoin="round"
                                            d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />

                                    </svg>

                                    <small>Delete</small>

                                </button>

                            </form>

                        </div>
                    </td>

                </tr>

                @empty
            <!-- /* WHEN USERS SEARCH IS NOT FOUND WE SHOW THIS MESSAGE */ -->
                    <tr>
                        <td colspan="6" class="table-empty">

                            <div class="table-empty-content">

                                <div class="table-empty-icon">
                                    
                                </div>

                                <h3>No department found</h3>

                                <p>
                                    There are no departments matching
                                    the selected filter.
                                </p>

                            </div>

                        </td>
                    </tr>
                @endforelse

            </tbody>

        </table>

    </div>


    <!-- Pagination -->
    <div class="pagination-wrapper">

        {{ $departments->appends(request()->query())->links('vendor.pagination.custom') }}
    </div>

</div>

<!-- for animation -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bodymovin/5.12.2/lottie.min.js"></script>

<script>
    lottie.loadAnimation({
        container: document.getElementById('department-animation'),
        renderer: 'svg',
        loop: true,
        autoplay: true,
        path: "{{ asset('animations/department.json') }}"
    });
</script>
@endsection