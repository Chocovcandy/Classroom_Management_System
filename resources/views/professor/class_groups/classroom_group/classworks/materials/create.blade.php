<style>
    /* ============================================================
   MATERIAL CREATE PAGE
   ============================================================ */

.classwork-form-page {
    width: 100%;
    max-width: 920px;
    margin: 0 auto;
    padding: 28px 24px 50px;
    box-sizing: border-box;
}


/* ============================================================
   PAGE HEADER
   ============================================================ */

.classwork-form-header {
    margin-bottom: 24px;
}

.classwork-form-back {
    display: inline-flex;
    align-items: center;
    gap: 7px;

    margin-bottom: 22px;

    color: var(--text-secondary);
    text-decoration: none;

    font-size: 14px;
    font-weight: 600;

    transition: color 0.2s ease;
}

.classwork-form-back:hover {
    color: var(--text-color);
}

.classwork-form-back i {
    font-size: 18px;
}


.classwork-form-heading {
    display: flex;
    align-items: center;
    gap: 16px;
}


.classwork-form-icon {
    width: 58px;
    height: 58px;

    flex-shrink: 0;

    display: flex;
    align-items: center;
    justify-content: center;

    border-radius: 16px;

    font-size: 27px;
}


.classwork-form-icon.material {
    background: #e8f7ef;
    color: #2f9e68;
}


.classwork-form-eyebrow {
    display: block;

    margin-bottom: 4px;

    color: #2f9e68;

    font-size: 11px;
    font-weight: 800;
    letter-spacing: 0.12em;
}


.classwork-form-heading h1 {
    margin: 0;

    color: var(--text-color);

    font-size: 28px;
    font-weight: 750;
    line-height: 1.2;
}


.classwork-form-heading p {
    margin: 6px 0 0;

    color: var(--text-secondary);

    font-size: 14px;
}


/* ============================================================
   FORM CARD
   ============================================================ */

.classwork-form-card {
    width: 100%;

    padding: 30px;

    background: var(--card-color);

    border: 1px solid var(--border-color);
    border-radius: 18px;

    box-sizing: border-box;
}


/* ============================================================
   FORM GROUP
   ============================================================ */

.form-group {
    margin-bottom: 24px;
}

.form-group:last-of-type {
    margin-bottom: 0;
}


.form-group label {
    display: block;

    margin-bottom: 9px;

    color: var(--text-color);

    font-size: 14px;
    font-weight: 700;
}

.form-group label span {
    color: #e05252;
}


/* ============================================================
   INPUTS
   ============================================================ */

.form-group input[type="text"],
.form-group textarea {
    width: 100%;

    padding: 12px 14px;

    box-sizing: border-box;

    background: var(--background-color);

    border: 1px solid var(--border-color);
    border-radius: 10px;

    color: var(--text-color);

    font-family: inherit;
    font-size: 14px;

    outline: none;

    transition:
        border-color 0.2s ease,
        box-shadow 0.2s ease;
}


.form-group input[type="text"] {
    height: 46px;
}


.form-group textarea {
    min-height: 145px;

    resize: vertical;

    line-height: 1.6;
}


.form-group input[type="text"]:focus,
.form-group textarea:focus {
    border-color: #2f9e68;

    box-shadow: 0 0 0 3px rgba(47, 158, 104, 0.12);
}


.form-group input::placeholder,
.form-group textarea::placeholder {
    color: var(--text-secondary);
    opacity: 0.7;
}


/* ============================================================
   FILE UPLOAD
   ============================================================ */

.file-upload-box {
    position: relative;

    min-height: 170px;

    display: flex;
    align-items: center;
    justify-content: center;

    box-sizing: border-box;

    background: var(--background-color);

    border: 1.5px dashed var(--border-color);
    border-radius: 14px;

    overflow: hidden;

    transition:
        border-color 0.2s ease,
        background-color 0.2s ease;
}


.file-upload-box:hover {
    border-color: #2f9e68;
    background: rgba(47, 158, 104, 0.025);
}


.file-upload-box input[type="file"] {
    position: absolute;

    inset: 0;

    width: 100%;
    height: 100%;

    opacity: 0;

    cursor: pointer;
}


.file-upload-content {
    display: flex;
    flex-direction: column;
    align-items: center;

    text-align: center;

    pointer-events: none;
}


.file-upload-content i {
    margin-bottom: 10px;

    color: #2f9e68;

    font-size: 38px;
}


.file-upload-content strong {
    margin-bottom: 5px;

    color: var(--text-color);

    font-size: 15px;
}


.file-upload-content span {
    max-width: 430px;

    color: var(--text-secondary);

    font-size: 13px;
    line-height: 1.5;
}


.form-help {
    display: block;

    margin-top: 8px;

    color: var(--text-secondary);

    font-size: 12px;
}


/* ============================================================
   VALIDATION ERROR
   ============================================================ */

.form-error {
    display: block;

    margin-top: 7px;

    color: #dc4c4c;

    font-size: 12px;
    font-weight: 600;
}


/* ============================================================
   FORM ACTIONS
   ============================================================ */

.classwork-form-actions {
    display: flex;
    align-items: center;
    justify-content: flex-end;

    gap: 12px;

    margin-top: 30px;
    padding-top: 22px;

    border-top: 1px solid var(--border-color);
}


.classwork-form-cancel,
.classwork-form-submit {
    min-height: 44px;

    display: inline-flex;
    align-items: center;
    justify-content: center;

    gap: 8px;

    padding: 0 18px;

    border-radius: 10px;

    font-family: inherit;
    font-size: 14px;
    font-weight: 700;

    text-decoration: none;

    box-sizing: border-box;

    cursor: pointer;

    transition:
        transform 0.2s ease,
        background-color 0.2s ease,
        border-color 0.2s ease;
}


.classwork-form-cancel {
    color: var(--text-color);

    background: transparent;

    border: 1px solid var(--border-color);
}


.classwork-form-cancel:hover {
    background: var(--background-color);
}


.classwork-form-submit {
    border: 0;

    color: #fff;

    background: #2f9e68;
}


.classwork-form-submit:hover {
    background: #27875a;

    transform: translateY(-1px);
}


.classwork-form-submit i {
    font-size: 18px;
}


/* ============================================================
   RESPONSIVE
   ============================================================ */

@media (max-width: 700px) {

    .classwork-form-page {
        padding: 20px 16px 40px;
    }

    .classwork-form-card {
        padding: 22px;
    }

    .classwork-form-heading h1 {
        font-size: 24px;
    }

    .classwork-form-actions {
        flex-direction: column-reverse;
        align-items: stretch;
    }

    .classwork-form-cancel,
    .classwork-form-submit {
        width: 100%;
    }

}
</style>

@extends('layouts.prof_layout')

@section('content')

<div class="classwork-form-page">

    {{-- ============================================================
        PAGE HEADER
    ============================================================= --}}
    <div class="classwork-form-header">

        <a
            href="{{ route(
                'professor.class-groups.classroom-group.classwork',
                $classGroup
            ) }}"
            class="classwork-form-back"
        >
            <i class="bx bx-arrow-back"></i>
            Back to Classwork
        </a>

        <div class="classwork-form-heading">

            <div class="classwork-form-icon material">
                <i class="bx bx-book-open"></i>
            </div>

            <div>
                <span class="classwork-form-eyebrow">
                    CLASSWORK
                </span>

                <h1>
                    Add Material
                </h1>

                <p>
                    Share learning materials with your students.
                </p>
            </div>

        </div>

    </div>


    {{-- ============================================================
        FORM CARD
    ============================================================= --}}
    <div class="classwork-form-card">

        <form
            action="{{ route(
                'professor.class-groups.materials.store',
                $classGroup
            ) }}"
            method="POST"
            enctype="multipart/form-data"
        >

            @csrf


            {{-- ====================================================
                TITLE
            ===================================================== --}}
            <div class="form-group">

                <label for="title">
                    Material Title
                    <span>*</span>
                </label>

                <input
                    type="text"
                    id="title"
                    name="title"
                    value="{{ old('title') }}"
                    placeholder="Enter material title"
                    required
                >

                @error('title')
                    <small class="form-error">
                        {{ $message }}
                    </small>
                @enderror

            </div>


            {{-- ====================================================
                DESCRIPTION
            ===================================================== --}}
            <div class="form-group">

                <label for="description">
                    Description
                </label>

                <textarea
                    id="description"
                    name="description"
                    rows="6"
                    placeholder="Add a description or instructions for your students..."
                >{{ old('description') }}</textarea>

                @error('description')
                    <small class="form-error">
                        {{ $message }}
                    </small>
                @enderror

            </div>


            {{-- ====================================================
                FILE UPLOAD
            ===================================================== --}}
            <div class="form-group">

                <label for="file">
                    Material File
                    <span>*</span>
                </label>

                <div class="file-upload-box">

                    <input
                        type="file"
                        id="file"
                        name="file"
                        required
                    >

                    <div class="file-upload-content">

                        <i class="bx bx-cloud-upload"></i>

                        <strong>
                            Choose a file
                        </strong>

                        <span>
                            Upload PDF, documents, slides, or other
                            learning materials.
                        </span>

                    </div>

                </div>

                @error('file')
                    <small class="form-error">
                        {{ $message }}
                    </small>
                @enderror

                <small class="form-help">
                    Maximum file size: 50 MB
                </small>

            </div>


            {{-- ====================================================
                ACTIONS
            ===================================================== --}}
            <div class="classwork-form-actions">

                <a
                    href="{{ route(
                        'professor.class-groups.classroom-group.classwork',
                        $classGroup
                    ) }}"
                    class="classwork-form-cancel"
                >
                    Cancel
                </a>

                <button
                    type="submit"
                    class="classwork-form-submit material"
                >
                    <i class="bx bx-upload"></i>
                    Upload Material
                </button>

            </div>

        </form>

    </div>

</div>

@endsection