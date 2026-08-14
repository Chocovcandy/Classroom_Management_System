
@extends('layouts.admin_layout')

@section('title', 'Create Department')

@section('content')

    <!-- Create Department Header -->
<div class="create-page">
    <div class="create-header">

        <div class="create-header-content">

            <span class="edit-eyebrow">
                Department Management
            </span>

            <h1>Create Department</h1>

            <p>
                Add a new academic department to the university system.
                Fill in the information below to create the department.
            </p>

        </div>

        <div class="create-illustration">
            <div id="department2-animation"></div>
        </div>

    </div>


    <!-- Department Form -->

    <div class="form-card">

        <h2 class="form-title">
            Department Information
        </h2>


        {{-- Success Message --}}

        @if(session('success'))

            <div class="form-message form-message-success">
                {{ session('success') }}
            </div>

        @endif


        {{-- Validation Errors --}}

        @if($errors->any())

            <div class="form-message form-message-error">

                <ul>

                    @foreach($errors->all() as $error)

                        <li>{{ $error }}</li>

                    @endforeach

                </ul>

            </div>

        @endif


        <form
            method="POST"
            action="{{ route('admin.departments.store') }}"
            class="form">

            @csrf


            <!-- Department Name -->

            <div class="form-group">

                <label
                    for="department_name"
                    class="form-label">

                    Department Name

                </label>

                <input
                    type="text"
                    id="department_name"
                    name="department_name"
                    class="form-input"
                    value="{{ old('department_name') }}"
                    required>

            </div>


            <!-- Description -->

            <div class="form-group">

                <label
                    for="description"
                    class="form-label">

                    Description

                    <span class="form-label-optional">
                        (optional)
                    </span>

                </label>

                <textarea
                    id="description"
                    name="description"
                    class="form-textarea">{{ old('description') }}</textarea>

            </div>


            <!-- Actions -->

            <div class="form-actions">

                <a
                    href="{{ route('admin.departments.index') }}"
                    class="form-cancel">

                    Cancel

                </a>

                <button
                    type="submit"
                    class="form-submit">

                    Create Department

                </button>

            </div>

        </form>

    </div>

</div>

<!-- for animation -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bodymovin/5.12.2/lottie.min.js"></script>

<script>
    lottie.loadAnimation({
        container: document.getElementById('department2-animation'),
        renderer: 'svg',
        loop: true,
        autoplay: true,
        path: "{{ asset('animations/department2.json') }}"
    });
</script>

@endsection

