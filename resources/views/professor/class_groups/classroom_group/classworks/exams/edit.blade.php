@extends('layouts.prof_layout')

@section('title', 'Edit Exam')

@section('content')

<div class="exam-create-page">

    {{-- ============================================================
         BACK TO CLASSWORK
         ============================================================ --}}

    <a
        href="{{ route(
            'professor.class-groups.classroom-group.classwork',
            ['classGroup' => $classGroup->id]
        ) }}"
        class="exam-back-button"
    >

        <i class="bx bx-arrow-back"></i>

        <span>
            Back to Classwork
        </span>

    </a>


    {{-- ============================================================
         HEADER
         ============================================================ --}}

    <section class="exam-create-header">

        <div class="exam-create-header-content">

            <span class="exam-eyebrow">
                EDIT EXAM
            </span>

            <h1>
                Edit Exam
            </h1>

            <p>
                Update the exam for
                {{ $classGroup->group_name }}.
            </p>

        </div>


        <div class="exam-header-illustration">

            <div class="exam-illustration-circle"></div>

            <div class="exam-illustration-paper">

                <div class="exam-paper-line line-one"></div>

                <div class="exam-paper-line line-two"></div>

                <div class="exam-paper-line line-three"></div>

                <div class="exam-paper-check">
                    <i class="bx bx-check"></i>
                </div>

            </div>

            <div class="exam-illustration-icon exam-pencil">
                <i class="bx bx-edit"></i>
            </div>

            <div class="exam-illustration-icon exam-warning">
                <i class="bx bx-error-circle"></i>
            </div>

        </div>

    </section>


    {{-- ============================================================
         FORM
         ============================================================ --}}

    <section class="exam-form-card">

        <form
            action="{{ route(
                'professor.class-groups.exams.update',
                [
                    'classGroup' => $classGroup->id,
                    'exam' => $exam->id
                ]
            ) }}"
            method="POST"
            enctype="multipart/form-data"
        >

            @csrf

            @method('PUT')


            {{-- ====================================================
                 EXAM INFORMATION
                 ==================================================== --}}

            <div class="exam-form-section">

                <div class="exam-form-section-header">

                    <span class="exam-form-eyebrow">
                        EXAM INFORMATION
                    </span>

                    <h2>
                        Basic Information
                    </h2>

                </div>


                {{-- TITLE --}}

                <div class="exam-form-group">

                    <label for="title">
                        Exam Title
                    </label>

                    <input
                        type="text"
                        id="title"
                        name="title"
                        value="{{ old('title', $exam->title) }}"
                        placeholder="Enter exam title"
                        required
                    >

                    @error('title')
                        <span class="exam-form-error">
                            {{ $message }}
                        </span>
                    @enderror

                </div>


                {{-- DESCRIPTION --}}

                <div class="exam-form-group">

                    <label for="description">
                        Description
                    </label>

                    <textarea
                        id="description"
                        name="description"
                        rows="4"
                        placeholder="Enter exam instructions or description..."
                    >{{ old('description', $exam->description) }}</textarea>

                    @error('description')
                        <span class="exam-form-error">
                            {{ $message }}
                        </span>
                    @enderror

                </div>


                {{-- TOPIC --}}

                <div class="exam-form-group">

                    <label for="topic_id">

                        Topic

                        <span class="exam-optional-label">
                            Optional
                        </span>

                    </label>

                    <select
                        id="topic_id"
                        name="topic_id"
                    >

                        <option value="">
                            No topic
                        </option>

                        @foreach($classGroup->topics as $topic)

                            <option
                                value="{{ $topic->id }}"
                                @selected(
                                    old(
                                        'topic_id',
                                        $exam->topic_id
                                    ) == $topic->id
                                )
                            >
                                {{ $topic->topic_name }}
                            </option>

                        @endforeach

                    </select>

                    @error('topic_id')
                        <span class="exam-form-error">
                            {{ $message }}
                        </span>
                    @enderror

                </div>

            </div>


            {{-- ====================================================
                 EXAM SETTINGS
                 ==================================================== --}}

            <div class="exam-form-section">

                <div class="exam-form-section-header">

                    <span class="exam-form-eyebrow">
                        EXAM SETTINGS
                    </span>

                    <h2>
                        Schedule & Points
                    </h2>

                </div>


                <div class="exam-form-row">

                    {{-- DATE --}}

                    <div class="exam-form-group">

                        <label for="due_date">

                            Due Date

                            <span class="exam-optional-label">
                                Optional
                            </span>

                        </label>

                        <input
                            type="date"
                            id="due_date"
                            name="due_date"
                            value="{{ old(
                                'due_date',
                                optional($exam->due_date)->format('Y-m-d')
                            ) }}"
                        >

                        @error('due_date')
                            <span class="exam-form-error">
                                {{ $message }}
                            </span>
                        @enderror

                    </div>


                    {{-- TIME --}}

                    <div class="exam-form-group">

                        <label for="due_time">

                            Due Time

                            <span class="exam-optional-label">
                                Optional
                            </span>

                        </label>

                        <input
                            type="time"
                            id="due_time"
                            name="due_time"
                            value="{{ old(
                                'due_time',
                                $exam->due_time
                            ) }}"
                        >

                        @error('due_time')
                            <span class="exam-form-error">
                                {{ $message }}
                            </span>
                        @enderror

                    </div>

                </div>


                {{-- POINTS --}}

                <div class="exam-form-group">

                    <label for="points">

                        Points

                        <span class="exam-optional-label">
                            Optional
                        </span>

                    </label>

                    <input
                        type="number"
                        id="points"
                        name="points"
                        value="{{ old(
                            'points',
                            $exam->points
                        ) }}"
                        min="0"
                        step="0.01"
                        placeholder="e.g. 100"
                    >

                    @error('points')
                        <span class="exam-form-error">
                            {{ $message }}
                        </span>
                    @enderror

                </div>

            </div>


            {{-- ====================================================
                 ATTACHMENT
                 ==================================================== --}}

            <div class="exam-form-section">

                <div class="exam-form-section-header">

                    <span class="exam-form-eyebrow">
                        RESOURCES
                    </span>

                    <h2>
                        Attachment
                    </h2>

                </div>


                @if($exam->attachment)

                    <div class="exam-current-file">

                        <i class="bx bx-paperclip"></i>

                        <div>

                            <strong>
                                Current attachment
                            </strong>

                            <span>
                                {{ basename($exam->attachment) }}
                            </span>

                        </div>

                    </div>

                @endif


                <div class="exam-form-group">

                    <label for="attachment">

                        Replace Attachment

                        <span class="exam-optional-label">
                            Optional
                        </span>

                    </label>

                    <input
                        type="file"
                        id="attachment"
                        name="attachment"
                    >

                    <small class="exam-form-help">
                        Leave empty to keep the current attachment.
                    </small>

                    @error('attachment')
                        <span class="exam-form-error">
                            {{ $message }}
                        </span>
                    @enderror

                </div>

            </div>


            {{-- ====================================================
                 ACTIONS
                 ==================================================== --}}

            <div class="exam-form-actions">

                <a
                    href="{{ route(
                        'professor.class-groups.classroom-group.classwork',
                        ['classGroup' => $classGroup->id]
                    ) }}"
                    class="exam-cancel-button"
                >
                    Cancel
                </a>

                <button
                    type="submit"
                    class="exam-submit-button"
                >

                    <i class="bx bx-save"></i>

                    Update Exam

                </button>

            </div>

        </form>

    </section>

</div>

@endsection