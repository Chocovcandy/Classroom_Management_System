@extends('layouts.prof_layout')

@section('content')

<style>
    /* Topic page styles */
</style>

<div class="topic-page">

    <div class="topic-header">
        <div>
            <a href="{{ route('professor.class-groups.classroom-group.classwork', $classGroup) }}"
               class="back-link">
                ← Back to Classwork
            </a>

            <h1>Create Topic</h1>
            <p>Organize your classwork into a new topic.</p>
        </div>
    </div>

    <div class="topic-card">

        <form action="{{ route('professor.class-groups.classroom-group.classwork.topics.store', $classGroup) }}"
              method="POST">

            @csrf

            <div class="form-group">
                <label for="topic_name">Topic name</label>

                <input
                    type="text"
                    id="topic_name"
                    name="topic_name"
                    value="{{ old('topic_name') }}"
                    placeholder="e.g. Chapter 1 — Introduction"
                    required
                >

                @error('topic_name')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="description">Description</label>

                <textarea
                    id="description"
                    name="description"
                    rows="5"
                    placeholder="Optional description for this topic..."
                >{{ old('description') }}</textarea>

                @error('description')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-actions">
                <a href="{{ route('professor.class-groups.classroom-group.classwork', $classGroup) }}"
                   class="btn btn-secondary">
                    Cancel
                </a>

                <button type="submit" class="btn btn-primary">
                    Create Topic
                </button>
            </div>

        </form>

    </div>

</div>

<style>
    .topic-page {
        max-width: 900px;
        margin: 0 auto;
        padding: 30px;
    }

    .topic-header {
        margin-bottom: 25px;
    }

    .back-link {
        display: inline-block;
        margin-bottom: 15px;
        color: var(--primary-color);
        text-decoration: none;
        font-size: 14px;
    }

    .topic-header h1 {
        margin: 0;
        font-size: 28px;
    }

    .topic-header p {
        margin-top: 8px;
        color: var(--text-muted);
    }

    .topic-card {
        background: var(--card-color);
        border: 1px solid var(--border-color);
        border-radius: 16px;
        padding: 30px;
    }

    .form-group {
        margin-bottom: 22px;
    }

    .form-group label {
        display: block;
        margin-bottom: 8px;
        font-weight: 600;
    }

    .form-group input,
    .form-group textarea {
        width: 100%;
        padding: 12px 14px;
        border: 1px solid var(--border-color);
        border-radius: 10px;
        background: var(--background-color);
        color: var(--text-color);
        font: inherit;
        box-sizing: border-box;
    }

    .form-group textarea {
        resize: vertical;
    }

    .form-group input:focus,
    .form-group textarea:focus {
        outline: none;
        border-color: var(--primary-color);
    }

    .error {
        display: block;
        margin-top: 6px;
        color: #dc2626;
        font-size: 13px;
    }

    .form-actions {
        display: flex;
        justify-content: flex-end;
        gap: 10px;
        margin-top: 30px;
    }

    .btn {
        display: inline-block;
        padding: 11px 18px;
        border-radius: 9px;
        text-decoration: none;
        border: none;
        cursor: pointer;
        font: inherit;
    }

    .btn-primary {
        background: var(--primary-color);
        color: white;
    }

    .btn-secondary {
        background: var(--background-color);
        color: var(--text-color);
        border: 1px solid var(--border-color);
    }
</style>

@endsection