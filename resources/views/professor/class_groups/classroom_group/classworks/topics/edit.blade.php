@extends('layouts.prof_layout')

@section('title', 'Edit Topic')

@section('content')

<style>
/* ============================================================
   EDIT TOPIC PAGE
   ============================================================ */

.topic-edit-page {
    width: 100%;
    max-width: 900px;
    margin: 0 auto;
    padding: 15px 0 50px;
}

.topic-edit-card {
    background-color: var(--card-color);
    border: 1px solid var(--border-color);
    border-radius: 16px;
    box-shadow: 0 8px 24px var(--shadow-color);
    overflow: hidden;
}

.topic-edit-header {
    display: flex;
    align-items: center;
    gap: 13px;
    padding: 22px 24px;
    border-bottom: 1px solid var(--border-color);
}

.topic-edit-header-icon {
    display: flex;
    align-items: center;
    justify-content: center;

    width: 44px;
    height: 44px;
    flex-shrink: 0;

    color: var(--topic-color, var(--button-color));
    background-color: var(--topic-soft, rgba(59, 130, 246, 0.09));

    border: 1px solid var(--primary-border);
    border-radius: 11px;

    font-size: 20px;
}

.topic-edit-header-text {
    min-width: 0;
}

.topic-edit-header h1 {
    margin: 0;

    color: var(--heading-color);

    font-size: 20px;
    font-weight: 800;
    line-height: 1.3;
}

.topic-edit-header p {
    margin: 4px 0 0;

    color: var(--secondary-text-color);

    font-size: 11px;
    line-height: 1.5;
}

.topic-edit-form {
    padding: 24px;
}

.topic-edit-field {
    margin-bottom: 20px;
}

.topic-edit-field:last-of-type {
    margin-bottom: 0;
}

.topic-edit-label {
    display: block;
    margin-bottom: 7px;

    color: var(--heading-color);

    font-size: 12px;
    font-weight: 700;
}

.topic-edit-input,
.topic-edit-textarea {
    width: 100%;
    box-sizing: border-box;

    color: var(--heading-color);
    background-color: var(--surface-color);

    border: 1px solid var(--border-color);
    border-radius: 10px;

    font-family: inherit;
    font-size: 12px;

    outline: none;

    transition:
        border-color 0.2s ease,
        box-shadow 0.2s ease,
        background-color 0.2s ease;
}

.topic-edit-input {
    height: 44px;
    padding: 0 13px;
}

.topic-edit-textarea {
    min-height: 130px;
    padding: 12px 13px;
    resize: vertical;
    line-height: 1.5;
}

.topic-edit-input:focus,
.topic-edit-textarea:focus {
    border-color: var(--button-color);
    box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.08);
}

.topic-edit-input::placeholder,
.topic-edit-textarea::placeholder {
    color: var(--secondary-text-color);
}

.topic-edit-error {
    margin-top: 6px;

    color: #dc5c5c;

    font-size: 10px;
    line-height: 1.4;
}

.topic-edit-actions {
    display: flex;
    justify-content: flex-end;
    gap: 9px;

    margin-top: 25px;
    padding-top: 20px;

    border-top: 1px solid var(--border-color);
}

.topic-edit-btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 7px;

    min-width: 105px;
    height: 40px;

    padding: 0 15px;

    border-radius: 9px;

    font-family: inherit;
    font-size: 11px;
    font-weight: 700;

    text-decoration: none;
    cursor: pointer;

    transition:
        background-color 0.2s ease,
        border-color 0.2s ease,
        color 0.2s ease,
        transform 0.2s ease;
}

.topic-edit-btn:hover {
    transform: translateY(-1px);
}

.topic-edit-btn.cancel {
    color: var(--secondary-text-color);
    background-color: transparent;

    border: 1px solid var(--border-color);
}

.topic-edit-btn.cancel:hover {
    color: var(--heading-color);
    background-color: var(--surface-hover);
}

.topic-edit-btn.save {
    color: #ffffff;
    background-color: var(--button-color);

    border: 1px solid var(--button-color);
}

.topic-edit-btn.save:hover {
    filter: brightness(0.96);
}

@media (max-width: 600px) {
    .topic-edit-page {
        padding-top: 8px;
    }

    .topic-edit-header {
        padding: 19px;
    }

    .topic-edit-form {
        padding: 19px;
    }

    .topic-edit-actions {
        flex-direction: column-reverse;
    }

    .topic-edit-btn {
        width: 100%;
    }
}
</style>

<div class="topic-edit-page">

            <a
            href="{{ route(
                'professor.class-groups.classroom-group.classwork',
                ['classGroup' => $classGroup->id]
            ) }}"
            class="topic-edit-btn cancel"
        >
            <i class="bx bx-arrow-back"></i>
            Back to Classwork
        </a>

    <section class="topic-edit-card">


        <header class="topic-edit-header">

            <div class="topic-edit-header-icon">
                <i class="bx bx-folder"></i>
            </div>

            <div class="topic-edit-header-text">

                <h1>Edit Topic</h1>

                <p>
                    Update the topic information for
                    {{ $classGroup->group_name }}.
                </p>

            </div>

        </header>


        <form
            action="{{ route(
                'professor.class-groups.classroom-group.classwork.topics.update',
                [
                    'classGroup' => $classGroup->id,
                    'topic' => $topic->id,
                ]
            ) }}"
            method="POST"
            class="topic-edit-form"
        >

            @csrf
            @method('PUT')


            {{-- TOPIC NAME --}}
            <div class="topic-edit-field">

                <label
                    for="topic_name"
                    class="topic-edit-label"
                >
                    Topic Name
                </label>

                <input
                    type="text"
                    id="topic_name"
                    name="topic_name"
                    class="topic-edit-input"
                    value="{{ old('topic_name', $topic->topic_name) }}"
                    placeholder="Enter topic name"
                    maxlength="255"
                    required
                >

                @error('topic_name')
                    <div class="topic-edit-error">
                        {{ $message }}
                    </div>
                @enderror

            </div>


            {{-- DESCRIPTION --}}
            <div class="topic-edit-field">

                <label
                    for="description"
                    class="topic-edit-label"
                >
                    Description
                </label>

                <textarea
                    id="description"
                    name="description"
                    class="topic-edit-textarea"
                    placeholder="Add a description for this topic..."
                    maxlength="1000"
                >{{ old('description', $topic->description) }}</textarea>

                @error('description')
                    <div class="topic-edit-error">
                        {{ $message }}
                    </div>
                @enderror

            </div>


            {{-- ACTIONS --}}
            <div class="topic-edit-actions">

                <a
                    href="{{ route(
                        'professor.class-groups.classroom-group.classwork',
                        ['classGroup' => $classGroup->id]
                    ) }}"
                    class="topic-edit-btn cancel"
                >
                    <i class="bx bx-arrow-back"></i>
                    Cancel
                </a>

                <button
                    type="submit"
                    class="topic-edit-btn save"
                >
                    <i class="bx bx-save"></i>
                    Save Changes
                </button>

            </div>

        </form>

    </section>

</div>

@endsection
