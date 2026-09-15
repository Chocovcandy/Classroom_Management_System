@extends('layouts.prof_layout')

@section('title', 'Edit Announcement')

@section('content')

<style>

/* =========================================================
   ANNOUNCEMENT EDIT PAGE
========================================================= */

.announcement-edit-page {
    max-width: 900px;
    margin: 0 auto;
    padding: 30px;
}


/* =========================================================
   HEADER
========================================================= */

.announcement-edit-header {
    display: flex;
    align-items: center;
    gap: 18px;
    margin-bottom: 25px;
}

.announcement-back-btn {
    width: 42px;
    height: 42px;
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    text-decoration: none;
    background: #f1f5f9;
    color: #334155;
    transition: 0.2s ease;
}

.announcement-back-btn:hover {
    background: #e2e8f0;
}

.announcement-header-label {
    display: block;
    font-size: 12px;
    font-weight: 700;
    letter-spacing: 1px;
    color: #64748b;
    margin-bottom: 4px;
}

.announcement-edit-header h2 {
    margin: 0;
    font-size: 25px;
    color: #0f172a;
}


/* =========================================================
   CARD
========================================================= */

.announcement-edit-card {
    background: #ffffff;
    border: 1px solid #e2e8f0;
    border-radius: 16px;
    padding: 28px;
    box-shadow: 0 5px 20px rgba(15, 23, 42, 0.05);
}


/* =========================================================
   FORM
========================================================= */

.announcement-form-group {
    margin-bottom: 20px;
}

.announcement-form-group label {
    display: block;
    margin-bottom: 8px;
    font-size: 14px;
    font-weight: 700;
    color: #334155;
}

.announcement-form-group input,
.announcement-form-group textarea {
    width: 100%;
    box-sizing: border-box;
    border: 1px solid #cbd5e1;
    border-radius: 10px;
    padding: 12px 14px;
    font-family: inherit;
    font-size: 14px;
    color: #0f172a;
    background: #ffffff;
    outline: none;
    transition: 0.2s ease;
}

.announcement-form-group textarea {
    min-height: 160px;
    resize: vertical;
}

.announcement-form-group input:focus,
.announcement-form-group textarea:focus {
    border-color: #64748b;
    box-shadow: 0 0 0 3px rgba(100, 116, 139, 0.12);
}


/* =========================================================
   ERROR
========================================================= */

.announcement-error {
    margin-top: 6px;
    font-size: 12px;
    color: #dc2626;
}


/* =========================================================
   ACTIONS
========================================================= */

.announcement-form-footer {
    display: flex;
    justify-content: flex-end;
    gap: 10px;
    padding-top: 20px;
    margin-top: 25px;
    border-top: 1px solid #e2e8f0;
}

.announcement-cancel-btn,
.announcement-update-btn {
    height: 40px;
    padding: 0 16px;
    border-radius: 9px;
    border: none;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 7px;
    font-size: 13px;
    font-weight: 700;
    text-decoration: none;
    cursor: pointer;
}

.announcement-cancel-btn {
    background: #f1f5f9;
    color: #475569;
}

.announcement-cancel-btn:hover {
    background: #e2e8f0;
}

.announcement-update-btn {
    background: #334155;
    color: #ffffff;
}

.announcement-update-btn:hover {
    background: #1e293b;
}


/* =========================================================
   RESPONSIVE
========================================================= */

@media (max-width: 700px) {

    .announcement-edit-page {
        padding: 20px;
    }

    .announcement-edit-card {
        padding: 20px;
    }

    .announcement-form-footer {
        flex-direction: column;
    }

    .announcement-cancel-btn,
    .announcement-update-btn {
        width: 100%;
    }

}

</style>


<div class="announcement-edit-page">

    {{-- =====================================================
         HEADER
    ====================================================== --}}

    <div class="announcement-edit-header">

        <a
            href="{{ route(
                'professor.class-groups.classroom-group',
                $classGroup
            ) }}"
            class="announcement-back-btn"
        >
            <i class="bx bx-arrow-back"></i>
        </a>

        <div>

            <span class="announcement-header-label">
                CLASS ANNOUNCEMENT
            </span>

            <h2>
                Edit Announcement
            </h2>

        </div>

    </div>


    {{-- =====================================================
         FORM
    ====================================================== --}}

    <div class="announcement-edit-card">

        <form
            action="{{ route(
                'professor.class-groups.announcements.update',
                [
                    'classGroup' => $classGroup,
                    'announcement' => $announcement
                ]
            ) }}"
            method="POST"
        >

            @csrf
            @method('PUT')


            {{-- TITLE --}}

            <div class="announcement-form-group">

                <label for="title">
                    Announcement Title
                </label>

                <input
                    id="title"
                    type="text"
                    name="title"
                    value="{{ old(
                        'title',
                        $announcement->title
                    ) }}"
                    maxlength="255"
                    required
                >

                @error('title')
                    <div class="announcement-error">
                        {{ $message }}
                    </div>
                @enderror

            </div>


            {{-- CONTENT --}}

            <div class="announcement-form-group">

                <label for="content">
                    Announcement
                </label>

                <textarea
                    id="content"
                    name="content"
                    required
                >{{ old(
                    'content',
                    $announcement->content
                ) }}</textarea>

                @error('content')
                    <div class="announcement-error">
                        {{ $message }}
                    </div>
                @enderror

            </div>


            {{-- ACTIONS --}}

            <div class="announcement-form-footer">

                <a
                    href="{{ route(
                        'professor.class-groups.classroom-group',
                        $classGroup
                    ) }}"
                    class="announcement-cancel-btn"
                >
                    Cancel
                </a>

                <button
                    type="submit"
                    class="announcement-update-btn"
                >
                    <i class="bx bx-save"></i>
                    Update Announcement
                </button>

            </div>

        </form>

    </div>

</div>

@endsection