@extends('layouts.admin_layout')

@section('title', 'Edit Department')

@section('content')

<div class="edit-page">

    {{-- =====================================================
         Edit Department Header
    ====================================================== --}}

    <div class="edit-header">

        <div class="edit-header-content">

            <span class="edit-eyebrow">
                Department Management
            </span>

            <h1>Edit Department</h1>

            <p>
                Update the information for this academic department.
                Make your changes below and save when you're finished.
            </p>

        </div>

        <div class="edit-header-illustration">
            <div id="department2-animation"></div>
        </div>

    </div>


    {{-- =====================================================
         Edit Form Card
    ====================================================== --}}

    <div class="edit-form-card">

        <div class="edit-form-heading">

            <div>
                <h2>Department Information</h2>

                <p>
                    Update the department details below.
                </p>
            </div>

        </div>


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


        {{-- =================================================
             Form
        ================================================== --}}

        <form
            method="POST"
            action="{{ route('admin.departments.update', $department->id) }}"
            class="edit-form"
        >

            @csrf
            @method('PUT')


            {{-- Department Name --}}

            <div class="edit-form-group">

                <label
                    for="department_name"
                    class="edit-form-label"
                >
                    Department Name
                </label>

                <input
                    type="text"
                    id="department_name"
                    name="department_name"
                    class="edit-form-input"
                    value="{{ old('department_name', $department->department_name) }}"
                    required
                >

            </div>


            {{-- Description --}}

            <div class="edit-form-group">

                <label
                    for="description"
                    class="edit-form-label"
                >
                    Description

                    <span class="edit-form-optional">
                        (optional)
                    </span>

                </label>

                <textarea
                    id="description"
                    name="description"
                    class="edit-form-textarea"
                >{{ old('description', $department->description) }}</textarea>

            </div>


            {{-- Actions --}}

            <div class="edit-form-actions">

                <a
                    href="{{ route('admin.departments.index') }}"
                    class="edit-cancel"
                >
                    Cancel
                </a>

                <button
                    type="submit"
                    class="edit-submit"
                >
                    Save Changes
                </button>

            </div>

        </form>

    </div>

</div>


{{-- =========================================================
     Lottie Animation
========================================================= --}}

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