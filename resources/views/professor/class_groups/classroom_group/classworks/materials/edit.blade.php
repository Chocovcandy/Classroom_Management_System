@extends('layouts.prof_layout')

@section('title', 'Edit Material')

@section('content')

<style>

/* =========================================================
   MATERIAL EDIT PAGE
========================================================= */

.material-edit-page {
    max-width: 900px;
    margin: 0 auto;
    padding: 30px;
}


/* =========================================================
   HEADER
========================================================= */

.material-edit-header {
    display: flex;
    align-items: center;
    gap: 18px;
    margin-bottom: 25px;
}

.material-back-btn {
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

.material-back-btn:hover {
    background: #e2e8f0;
}

.material-header-label {
    display: block;
    font-size: 12px;
    font-weight: 700;
    letter-spacing: 1px;
    color: #64748b;
    margin-bottom: 4px;
}

.material-edit-header h2 {
    margin: 0;
    font-size: 25px;
    color: #0f172a;
}


/* =========================================================
   CARD
========================================================= */

.material-edit-card {
    background: #ffffff;
    border: 1px solid #e2e8f0;
    border-radius: 16px;
    padding: 28px;
    box-shadow: 0 5px 20px rgba(15, 23, 42, 0.05);
}


/* =========================================================
   FORM
========================================================= */

.material-form-group {
    margin-bottom: 20px;
}

.material-form-group label {
    display: block;
    margin-bottom: 8px;
    font-size: 14px;
    font-weight: 700;
    color: #334155;
}

.material-form-group input,
.material-form-group textarea {
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
}

.material-form-group textarea {
    min-height: 140px;
    resize: vertical;
}

.material-form-group input:focus,
.material-form-group textarea:focus {
    border-color: #64748b;
    box-shadow: 0 0 0 3px rgba(100, 116, 139, 0.12);
}


/* =========================================================
   CURRENT FILE
========================================================= */

.material-current-file {
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 12px 14px;
    margin-bottom: 12px;
    border: 1px solid #e2e8f0;
    border-radius: 10px;
    background: #f8fafc;
}

.material-current-file-icon {
    width: 36px;
    height: 36px;
    flex-shrink: 0;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 8px;
    background: #e2e8f0;
    color: #475569;
}

.material-current-file-info strong {
    display: block;
    font-size: 13px;
    color: #334155;
    word-break: break-word;
}

.material-current-file-info span {
    display: block;
    margin-top: 3px;
    font-size: 12px;
    color: #64748b;
}


/* =========================================================
   ERROR
========================================================= */

.material-error {
    margin-top: 6px;
    font-size: 12px;
    color: #dc2626;
}


/* =========================================================
   ACTIONS
========================================================= */

.material-form-footer {
    display: flex;
    justify-content: flex-end;
    gap: 10px;
    padding-top: 20px;
    margin-top: 25px;
    border-top: 1px solid #e2e8f0;
}

.material-cancel-btn,
.material-update-btn {
    height: 40px;
    padding: 0 16px;
    border: none;
    border-radius: 9px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 7px;
    font-size: 13px;
    font-weight: 700;
    text-decoration: none;
    cursor: pointer;
}

.material-cancel-btn {
    background: #f1f5f9;
    color: #475569;
}

.material-cancel-btn:hover {
    background: #e2e8f0;
}

.material-update-btn {
    background: #334155;
    color: #ffffff;
}

.material-update-btn:hover {
    background: #1e293b;
}


/* =========================================================
   RESPONSIVE
========================================================= */

@media (max-width: 700px) {

    .material-edit-page {
        padding: 20px;
    }

    .material-edit-card {
        padding: 20px;
    }

    .material-form-footer {
        flex-direction: column;
    }

    .material-cancel-btn,
    .material-update-btn {
        width: 100%;
    }

}

</style>


<div class="material-edit-page">

    {{-- =====================================================
         HEADER
    ====================================================== --}}

    <div class="material-edit-header">

        <a
            href="{{ route(
                'professor.class-groups.classroom-group',
                $classGroup
            ) }}"
            class="material-back-btn"
        >
            <i class="bx bx-arrow-back"></i>
        </a>

        <div>

            <span class="material-header-label">
                LEARNING MATERIAL
            </span>

            <h2>
                Edit Material
            </h2>

        </div>

    </div>


    {{-- =====================================================
         FORM
    ====================================================== --}}

    <div class="material-edit-card">

        <form
            action="{{ route(
                'professor.class-groups.materials.update',
                [
                    'classGroup' => $classGroup,
                    'material' => $material
                ]
            ) }}"
            method="POST"
            enctype="multipart/form-data"
        >

            @csrf
            @method('PUT')


            {{-- TITLE --}}

            <div class="material-form-group">

                <label for="title">
                    Material Title
                </label>

                <input
                    id="title"
                    type="text"
                    name="title"
                    value="{{ old(
                        'title',
                        $material->title
                    ) }}"
                    required
                >

                @error('title')
                    <div class="material-error">
                        {{ $message }}
                    </div>
                @enderror

            </div>


            {{-- DESCRIPTION --}}

            <div class="material-form-group">

                <label for="description">
                    Description
                </label>

                <textarea
                    id="description"
                    name="description"
                >{{ old(
                    'description',
                    $material->description
                ) }}</textarea>

                @error('description')
                    <div class="material-error">
                        {{ $message }}
                    </div>
                @enderror

            </div>


            {{-- CURRENT FILE --}}

            @if ($material->file_path)

                <div class="material-form-group">

                    <label>
                        Current File
                    </label>

                    <div class="material-current-file">

                        <div class="material-current-file-icon">
                            <i class="bx bx-file"></i>
                        </div>

                        <div class="material-current-file-info">

                            <strong>
                                {{ $material->file_name }}
                            </strong>

                            <span>
                                Upload a new file below to replace it.
                            </span>

                        </div>

                    </div>

                </div>

            @endif


            {{-- NEW FILE --}}

            <div class="material-form-group">

                <label for="file">
                    {{ $material->file_path
                        ? 'Replace File'
                        : 'File'
                    }}
                </label>

                <input
                    id="file"
                    type="file"
                    name="file"
                >

                @error('file')
                    <div class="material-error">
                        {{ $message }}
                    </div>
                @enderror

            </div>


            {{-- ACTIONS --}}

            <div class="material-form-footer">

                <a
                    href="{{ route(
                        'professor.class-groups.classroom-group',
                        $classGroup
                    ) }}"
                    class="material-cancel-btn"
                >
                    Cancel
                </a>

                <button
                    type="submit"
                    class="material-update-btn"
                >
                    <i class="bx bx-save"></i>
                    Update Material
                </button>

            </div>

        </form>

    </div>

</div>

@endsection