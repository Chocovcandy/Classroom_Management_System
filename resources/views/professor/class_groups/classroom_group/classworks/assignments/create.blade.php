@extends('layouts.prof_layout')

@section('title', 'Create Assignment')

@section('content')

<div class="assignment-create-page">

    {{-- =====================================================
         HEADER
    ====================================================== --}}

    <div class="assignment-create-header">

        <div class="assignment-header-left">

            {{-- BACK TO CLASSwork page--}}

            <a
                href="{{ route(
                    'professor.class-groups.classroom-group.classwork',
                    ['classGroup' => $classGroup->id]
                ) }}"
                class="assignment-back-btn"
            >
                <i class="fa-solid fa-arrow-left"></i>
            </a>


            <div>

                <span class="assignment-header-label">
                    CLASSROOM
                </span>

                <h2>
                    Create Assignment
                </h2>

                <p>
                    {{ $classGroup->group_name }}
                </p>

            </div>

        </div>

    </div>


    {{-- =====================================================
         FORM CARD
    ====================================================== --}}

    <div class="assignment-create-container">

        <div class="assignment-create-card">


            {{-- =================================================
                 CARD HEADER
            ================================================== --}}

            <div class="assignment-card-header">

                <div class="assignment-card-icon">

                    <i class="bx bx-task"></i>

                </div>

                <div>

                    <h3>
                        New Assignment
                    </h3>

                    <p>
                        Create an assignment for your students.
                    </p>

                </div>

            </div>


            {{-- =================================================
                 FORM
            ================================================== --}}

            <form
                action="{{ route(
                    'professor.class-groups.assignments.store',
                    $classGroup
                ) }}"
                method="POST"
                enctype="multipart/form-data"
                class="assignment-form"
            >

                @csrf


                {{-- =================================================
                     TITLE
                ================================================== --}}

                <div class="assignment-form-group">

                    <label for="title">
                        Assignment Title
                        <span>*</span>
                    </label>

                    <input
                        type="text"
                        id="title"
                        name="title"
                        value="{{ old('title') }}"
                        placeholder="Enter assignment title..."
                        maxlength="255"
                        required
                    >

                    @error('title')

                        <div class="assignment-error">
                            {{ $message }}
                        </div>

                    @enderror

                </div>


                {{-- =================================================
                     DESCRIPTION
                ================================================== --}}

                <div class="assignment-form-group">

                    <label for="description">
                        Instructions
                        <span>*</span>
                    </label>

                    <textarea
                        id="description"
                        name="description"
                        rows="7"
                        placeholder="Write the assignment instructions..."
                        required
                    >{{ old('description') }}</textarea>

                    @error('description')

                        <div class="assignment-error">
                            {{ $message }}
                        </div>

                    @enderror

                </div>


                {{-- =================================================
                    TOPIC
                ================================================== --}}

            <div class="assignment-form-group">

                <label for="topic_id">
                    Topic
                    <span>*</span>
                </label>

                <select
                    id="topic_id"
                    name="topic_id"
                    required
                >

                    <option value="">
                        Select a topic
                    </option>

                    @foreach($classGroup->topics as $topic)

                        <option
                            value="{{ $topic->id }}"
                            {{ old('topic_id') == $topic->id ? 'selected' : '' }}
                        >
                            {{ $topic->topic_name }}
                        </option>

                    @endforeach

                </select>

                @error('topic_id')

                    <div class="assignment-error">
                        {{ $message }}
                    </div>

                @enderror

            </div>


                {{-- =================================================
                     DUE DATE + TIME
                ================================================== --}}

                <div class="assignment-form-row">


                    {{-- DUE DATE --}}

                    <div class="assignment-form-group">

                        <label for="due_date">
                            Due Date
                            <span>*</span>
                        </label>

                        <input
                            type="date"
                            id="due_date"
                            name="due_date"
                            value="{{ old('due_date') }}"
                            required
                        >

                        @error('due_date')

                            <div class="assignment-error">
                                {{ $message }}
                            </div>

                        @enderror

                    </div>


                    {{-- DUE TIME --}}

                    <div class="assignment-form-group">

                        <label for="due_time">
                            Due Time
                        </label>

                        <input
                            type="time"
                            id="due_time"
                            name="due_time"
                            value="{{ old('due_time') }}"
                        >

                        @error('due_time')

                            <div class="assignment-error">
                                {{ $message }}
                            </div>

                        @enderror

                    </div>

                </div>


                {{-- =================================================
                     POINTS
                ================================================== --}}

                <div class="assignment-form-group">

                    <label for="points">
                        Points
                    </label>

                    <input
                        type="number"
                        id="points"
                        name="points"
                        value="{{ old('points', 100) }}"
                        min="0"
                        placeholder="100"
                    >

                    <small>
                        Leave this as 100 if you want the default
                        assignment score.
                    </small>

                    @error('points')

                        <div class="assignment-error">
                            {{ $message }}
                        </div>

                    @enderror

                </div>


                {{-- =================================================
                     ATTACHMENT
                ================================================== --}}

                <div class="assignment-form-group">

                    <label for="attachment">
                        Attachment
                    </label>

                    <div class="assignment-file-upload">

                        <input
                            type="file"
                            id="attachment"
                            name="attachment"
                        >

                        <label
                            for="attachment"
                            class="assignment-file-label"
                        >

                            <i class="bx bx-cloud-upload"></i>

                            <span>
                                Choose a file
                            </span>

                        </label>

                    </div>

                    <small>
                        Maximum file size: 10 MB.
                    </small>

                    @error('attachment')

                        <div class="assignment-error">
                            {{ $message }}
                        </div>

                    @enderror

                </div>


                {{-- =================================================
                     ACTIONS
                ================================================== --}}

                <div class="assignment-form-footer">

                    {{-- CANCEL --}}

                    <a
                        href="{{ route(
                    'professor.class-groups.classroom-group.classwork',
                    ['classGroup' => $classGroup->id]
                ) }}"
                        class="assignment-cancel-btn"
                    >
                        Cancel
                    </a>


                    {{-- CREATE --}}

                    <button
                        type="submit"
                        class="assignment-submit-btn"
                    >

                        <i class="bx bx-send"></i>

                        Create Assignment

                    </button>

                </div>

            </form>

        </div>

    </div>

</div>


{{-- ============================================================
     OPTIONAL FILE NAME SCRIPT
============================================================ --}}

<script>

document.addEventListener('DOMContentLoaded', function () {

    const fileInput =
        document.getElementById('attachment');

    const fileLabel =
        document.querySelector(
            '.assignment-file-label span'
        );


    if (fileInput && fileLabel) {

        fileInput.addEventListener(
            'change',
            function () {

                if (this.files.length > 0) {

                    fileLabel.textContent =
                        this.files[0].name;

                } else {

                    fileLabel.textContent =
                        'Choose a file';

                }

            }
        );

    }

});

</script>

@endsection