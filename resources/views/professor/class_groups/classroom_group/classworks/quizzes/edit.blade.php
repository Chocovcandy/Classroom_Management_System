@extends('layouts.prof_layout')

@section('title', 'Edit Quiz')

@section('content')

<div class="quiz-create-page">

    {{-- ============================================================
         BACK TO CLASSWORK
         ============================================================ --}}

    <a
        href="{{ route(
            'professor.class-groups.classroom-group.classwork',
            ['classGroup' => $classGroup->id]
        ) }}"
        class="back-button"
    >

        <i class="bx bx-arrow-back"></i>

        <span>
            Back to Classwork
        </span>

    </a>


    {{-- ============================================================
         HEADER
         ============================================================ --}}

    <section class="quiz-create-header">

        <div class="quiz-create-header-content">

            <span class="quiz-eyebrow">
                EDIT QUIZ
            </span>

            <h1>
                Edit Quiz
            </h1>

            <p>
                Update the quiz for
                {{ $classGroup->group_name }}.
            </p>

        </div>


        {{-- HEADER ICON --}}

        <div class="quiz-create-header-icon">

            <i class="bx bx-edit"></i>

        </div>

    </section>


    {{-- ============================================================
         FORM CARD
         ============================================================ --}}

    <section class="quiz-form-card">

        <form
            action="{{ route(
                'professor.class-groups.quizzes.update',
                [
                    'classGroup' => $classGroup->id,
                    'quiz' => $quiz->id
                ]
            ) }}"
            method="POST"
        >

            @csrf

            @method('PUT')


            {{-- ====================================================
                 QUIZ INFORMATION
                 ==================================================== --}}

            <div class="quiz-form-section">

                <div class="quiz-form-section-header">

                    <div>

                        <span class="quiz-form-eyebrow">
                            QUIZ INFORMATION
                        </span>

                        <h2>
                            Basic Information
                        </h2>

                    </div>

                </div>


                {{-- TITLE --}}

                <div class="form-group">

                    <label for="title">
                        Quiz Title
                    </label>

                    <input
                        type="text"
                        id="title"
                        name="title"
                        value="{{ old('title', $quiz->title) }}"
                        placeholder="Enter quiz title"
                        required
                    >

                    @error('title')

                        <span class="form-error">
                            {{ $message }}
                        </span>

                    @enderror

                </div>


                {{-- DESCRIPTION --}}

                <div class="form-group">

                    <label for="description">
                        Description
                    </label>

                    <textarea
                        id="description"
                        name="description"
                        rows="4"
                        placeholder="Describe the quiz or provide instructions..."
                    >{{ old('description', $quiz->description) }}</textarea>

                    @error('description')

                        <span class="form-error">
                            {{ $message }}
                        </span>

                    @enderror

                </div>


                {{-- TOPIC --}}

                <div class="form-group">

                    <label for="topic_id">

                        Topic

                        <span class="optional-label">
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
                                        $quiz->topic_id
                                    ) == $topic->id
                                )
                            >
                                {{ $topic->topic_name }}
                            </option>

                        @endforeach

                    </select>

                    @error('topic_id')

                        <span class="form-error">
                            {{ $message }}
                        </span>

                    @enderror

                </div>

            </div>


            {{-- ====================================================
                 QUIZ SETTINGS
                 ==================================================== --}}

            <div class="quiz-form-section">

                <div class="quiz-form-section-header">

                    <div>

                        <span class="quiz-form-eyebrow">
                            QUIZ SETTINGS
                        </span>

                        <h2>
                            Schedule & Points
                        </h2>

                    </div>

                </div>


                {{-- DATE + TIME --}}

                <div class="form-row">

                    {{-- DUE DATE --}}

                    <div class="form-group">

                        <label for="due_date">

                            Due Date

                            <span class="optional-label">
                                Optional
                            </span>

                        </label>

                        <input
                            type="date"
                            id="due_date"
                            name="due_date"
                            value="{{ old(
                                'due_date',
                                optional($quiz->due_date)->format('Y-m-d')
                            ) }}"
                        >

                        @error('due_date')

                            <span class="form-error">
                                {{ $message }}
                            </span>

                        @enderror

                    </div>


                    {{-- DUE TIME --}}

                    <div class="form-group">

                        <label for="due_time">

                            Due Time

                            <span class="optional-label">
                                Optional
                            </span>

                        </label>

                        <input
                            type="time"
                            id="due_time"
                            name="due_time"
                            value="{{ old(
                                'due_time',
                                $quiz->due_time
                            ) }}"
                        >

                        @error('due_time')

                            <span class="form-error">
                                {{ $message }}
                            </span>

                        @enderror

                    </div>

                </div>


                {{-- POINTS --}}

                <div class="form-group">

                    <label for="points">

                        Points

                        <span class="optional-label">
                            Optional
                        </span>

                    </label>

                    <input
                        type="number"
                        id="points"
                        name="points"
                        value="{{ old(
                            'points',
                            $quiz->points
                        ) }}"
                        min="0"
                        step="0.01"
                        placeholder="e.g. 20"
                    >

                    @error('points')

                        <span class="form-error">
                            {{ $message }}
                        </span>

                    @enderror

                </div>

            </div>


            {{-- ====================================================
                 FORM ACTIONS
                 ==================================================== --}}

            <div class="quiz-form-actions">

                <a
                    href="{{ route(
                        'professor.class-groups.classroom-group.classwork',
                        ['classGroup' => $classGroup->id]
                    ) }}"
                    class="quiz-cancel-button"
                >
                    Cancel
                </a>


                <button
                    type="submit"
                    class="quiz-submit-button"
                >

                    <i class="bx bx-save"></i>

                    Update Quiz

                </button>

            </div>

        </form>

    </section>

</div>

@endsection