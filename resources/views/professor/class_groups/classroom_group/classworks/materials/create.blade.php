@extends('layouts.prof_layout')

@section('content')

<style>

/* =========================================================
   PAGE
========================================================= */

.classwork-form-page {
    max-width: 900px;
    margin: 0 auto;
    padding: 30px;
}


/* =========================================================
   HEADER
========================================================= */

.classwork-form-header {
    display: flex;
    align-items: center;
    gap: 18px;
    margin-bottom: 25px;
}

.classwork-form-back {
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

.classwork-form-back:hover {
    background: #e2e8f0;
}

.classwork-form-heading {
    display: flex;
    align-items: center;
    gap: 14px;
}

.classwork-form-icon {
    width: 48px;
    height: 48px;

    border-radius: 12px;

    display: flex;
    align-items: center;
    justify-content: center;

    background: #f1f5f9;
    color: #334155;

    font-size: 22px;
}

.classwork-form-eyebrow {
    display: block;

    font-size: 12px;
    font-weight: 700;

    letter-spacing: 1px;

    color: #64748b;

    margin-bottom: 4px;
}

.classwork-form-heading h1 {
    margin: 0;

    font-size: 25px;

    color: #0f172a;
}

.classwork-form-heading p {
    margin: 4px 0 0;

    font-size: 14px;

    color: #64748b;
}


/* =========================================================
   FORM CARD
========================================================= */

.classwork-form-card {
    background: #ffffff;

    border: 1px solid #e2e8f0;

    border-radius: 16px;

    padding: 28px;

    box-shadow:
        0 5px 20px rgba(15, 23, 42, 0.05);
}


/* =========================================================
   FORM GROUP
========================================================= */

.form-group,
.material-form-group {
    margin-bottom: 20px;
}

.form-group label,
.material-form-group label {
    display: block;

    margin-bottom: 8px;

    font-size: 14px;
    font-weight: 700;

    color: #334155;
}

.form-group label span,
.material-form-group label span {
    color: #dc2626;
}

.form-group input,
.form-group textarea,
.material-form-input {
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

.form-group textarea {
    resize: vertical;
}

.form-group input:focus,
.form-group textarea:focus,
.material-form-input:focus {
    border-color: #64748b;

    box-shadow:
        0 0 0 3px rgba(100, 116, 139, 0.12);
}


/* =========================================================
   FILE UPLOAD
========================================================= */

.file-upload-box {
    position: relative;

    border: 2px dashed #cbd5e1;

    border-radius: 12px;

    padding: 28px;

    text-align: center;

    background: #f8fafc;

    transition: 0.2s ease;

    cursor: pointer;
}

.file-upload-box:hover {
    border-color: #94a3b8;

    background: #f1f5f9;
}

.file-upload-box input[type="file"] {
    position: absolute;

    inset: 0;

    width: 100%;
    height: 100%;

    opacity: 0;

    cursor: pointer;

    padding: 0;

    border: 0;
}

.file-upload-content {
    pointer-events: none;

    display: flex;

    flex-direction: column;

    align-items: center;

    gap: 7px;
}

.file-upload-content i {
    font-size: 34px;

    color: #64748b;
}

.file-upload-content strong {
    font-size: 14px;

    color: #334155;
}

.file-upload-content span {
    font-size: 12px;

    color: #64748b;
}


/* =========================================================
   SELECTED FILES
========================================================= */

.selected-files {
    display: none;

    margin-top: 14px;
}

.selected-files.has-files {
    display: block;
}

.selected-files-header {
    display: flex;

    justify-content: space-between;

    align-items: center;

    margin-bottom: 8px;
}

.selected-files-title {
    font-size: 13px;

    font-weight: 700;

    color: #334155;
}

.selected-files-count {
    font-size: 12px;

    color: #64748b;
}

.selected-file-list {
    display: flex;

    flex-direction: column;

    gap: 8px;
}

.selected-file-item {
    display: flex;

    align-items: center;

    gap: 12px;

    padding: 11px 13px;

    border: 1px solid #e2e8f0;

    border-radius: 10px;

    background: #f8fafc;
}

.selected-file-icon {
    width: 36px;
    height: 36px;

    flex-shrink: 0;

    display: flex;

    align-items: center;

    justify-content: center;

    border-radius: 8px;

    background: #e2e8f0;

    color: #475569;

    font-size: 18px;
}

.selected-file-info {
    min-width: 0;

    flex: 1;
}

.selected-file-name {
    display: block;

    font-size: 13px;

    font-weight: 600;

    color: #334155;

    overflow: hidden;

    text-overflow: ellipsis;

    white-space: nowrap;
}

.selected-file-size {
    display: block;

    margin-top: 3px;

    font-size: 11px;

    color: #64748b;
}


/* =========================================================
   REMOVE SELECTED FILE
========================================================= */

.selected-file-remove {
    width: 32px;
    height: 32px;

    flex-shrink: 0;

    display: flex;

    align-items: center;

    justify-content: center;

    border: none;

    border-radius: 8px;

    background: #fee2e2;

    color: #dc2626;

    cursor: pointer;

    transition: 0.2s ease;
}

.selected-file-remove:hover {
    background: #fecaca;

    color: #b91c1c;
}

.selected-file-remove i {
    font-size: 17px;
}


/* =========================================================
   ERRORS / HELP
========================================================= */

.material-error,
.form-error {
    display: block;

    margin-top: 6px;

    font-size: 12px;

    color: #dc2626;
}

.form-help {
    display: block;

    margin-top: 8px;

    font-size: 12px;

    color: #64748b;
}


/* =========================================================
   ACTIONS
========================================================= */

.classwork-form-actions {
    display: flex;

    justify-content: flex-end;

    gap: 10px;

    padding-top: 20px;

    margin-top: 25px;

    border-top: 1px solid #e2e8f0;
}

.classwork-form-cancel,
.classwork-form-submit {
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

.classwork-form-cancel {
    background: #f1f5f9;

    color: #475569;
}

.classwork-form-cancel:hover {
    background: #e2e8f0;
}

.classwork-form-submit {
    background: #334155;

    color: #ffffff;
}

.classwork-form-submit:hover {
    background: #1e293b;
}


/* =========================================================
   RESPONSIVE
========================================================= */

@media (max-width: 700px) {

    .classwork-form-page {
        padding: 20px;
    }

    .classwork-form-card {
        padding: 20px;
    }

    .classwork-form-actions {
        flex-direction: column;
    }

    .classwork-form-cancel,
    .classwork-form-submit {
        width: 100%;
    }
}

</style>

<div class="classwork-form-page">

```
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


        {{-- =================================================
             RETURN LOCATION
        ================================================== --}}

        <input
            type="hidden"
            name="return_to"
            value="{{ request('return_to', 'stream') }}"
        >


        {{-- =================================================
             TITLE
        ================================================== --}}

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


        {{-- =================================================
             TOPIC
        ================================================== --}}

        <div class="material-form-group">

            <label for="topic_id">
                Topic
            </label>

            <select
                name="topic_id"
                id="topic_id"
                class="material-form-input"
            >

                <option value="">
                    No Topic
                </option>

                @foreach($topics as $topic)

                    <option
                        value="{{ $topic->id }}"
                        {{ old('topic_id') == $topic->id
                            ? 'selected'
                            : ''
                        }}
                    >
                        {{ $topic->topic_name }}
                    </option>

                @endforeach

            </select>

            @error('topic_id')

                <span class="material-form-error">
                    {{ $message }}
                </span>

            @enderror

        </div>


        {{-- =================================================
             DESCRIPTION
        ================================================== --}}

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


        {{-- =================================================
             MULTIPLE FILE UPLOAD
        ================================================== --}}

        <div class="form-group">

            <label for="files">

                Material Files

                <span>*</span>

            </label>


            <div class="file-upload-box">

                <input
                    type="file"
                    id="files"
                    name="files[]"
                    multiple
                    required
                >


                <div class="file-upload-content">

                    <i class="bx bx-cloud-upload"></i>

                    <strong>
                        Choose files
                    </strong>

                    <span>
                        Select multiple learning materials at once.
                    </span>

                </div>

            </div>


            {{-- =================================================
                 SELECTED FILES
            ================================================== --}}

            <div
                id="selectedFiles"
                class="selected-files"
            >

                <div class="selected-files-header">

                    <span class="selected-files-title">
                        Selected Files
                    </span>

                    <span
                        id="selectedFilesCount"
                        class="selected-files-count"
                    >
                        0 files
                    </span>

                </div>


                <div
                    id="selectedFileList"
                    class="selected-file-list"
                >
                </div>

            </div>


            @error('files')

                <small class="form-error">
                    {{ $message }}
                </small>

            @enderror


            @error('files.*')

                <small class="form-error">
                    {{ $message }}
                </small>

            @enderror


            <small class="form-help">
                Maximum 10 files, 50 MB per file.
            </small>

        </div>


        {{-- =================================================
             ACTIONS
        ================================================== --}}

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
```

</div>

{{-- ============================================================
FILE PREVIEW + REMOVE JAVASCRIPT
============================================================= --}}

<script>

document.addEventListener('DOMContentLoaded', function () {


    const fileInput =
        document.getElementById('files');


    const selectedFiles =
        document.getElementById('selectedFiles');


    const selectedFileList =
        document.getElementById('selectedFileList');


    const selectedFilesCount =
        document.getElementById('selectedFilesCount');


    if (
        !fileInput ||
        !selectedFiles ||
        !selectedFileList ||
        !selectedFilesCount
    ) {
        return;
    }


    /*
    |--------------------------------------------------------------------------
    | Keep our own selected file list.
    |--------------------------------------------------------------------------
    */

    let selectedFilesArray = [];


    /*
    |--------------------------------------------------------------------------
    | File selection
    |--------------------------------------------------------------------------
    */

    fileInput.addEventListener(
        'change',
        function () {

            const newFiles =
                Array.from(this.files);


            /*
            |--------------------------------------------------------------------------
            | Add new files without duplicates.
            |--------------------------------------------------------------------------
            */

            newFiles.forEach(function (file) {

                const duplicate =
                    selectedFilesArray.some(
                        function (existingFile) {

                            return (
                                existingFile.name === file.name &&
                                existingFile.size === file.size &&
                                existingFile.lastModified ===
                                    file.lastModified
                            );

                        }
                    );


                if (!duplicate) {

                    selectedFilesArray.push(file);

                }

            });


            updateFileInput();

            renderSelectedFiles();

        }
    );


    /*
    |--------------------------------------------------------------------------
    | Render selected files.
    |--------------------------------------------------------------------------
    */

    function renderSelectedFiles() {

        selectedFileList.innerHTML = '';


        if (selectedFilesArray.length === 0) {

            selectedFiles.classList.remove(
                'has-files'
            );

            selectedFilesCount.textContent =
                '0 files';

            return;

        }


        selectedFiles.classList.add(
            'has-files'
        );


        selectedFilesCount.textContent =
            selectedFilesArray.length === 1
                ? '1 file'
                : selectedFilesArray.length + ' files';


        selectedFilesArray.forEach(
            function (file, index) {

                const item =
                    document.createElement('div');

                item.className =
                    'selected-file-item';


                /*
                |--------------------------------------------------------------------------
                | File icon
                |--------------------------------------------------------------------------
                */

                const iconContainer =
                    document.createElement('div');

                iconContainer.className =
                    'selected-file-icon';


                const icon =
                    document.createElement('i');

                icon.className =
                    getFileIcon(file.name);


                iconContainer.appendChild(icon);


                /*
                |--------------------------------------------------------------------------
                | File information
                |--------------------------------------------------------------------------
                */

                const info =
                    document.createElement('div');

                info.className =
                    'selected-file-info';


                const name =
                    document.createElement('span');

                name.className =
                    'selected-file-name';

                name.textContent =
                    file.name;


                const size =
                    document.createElement('span');

                size.className =
                    'selected-file-size';

                size.textContent =
                    formatFileSize(file.size);


                info.appendChild(name);

                info.appendChild(size);


                /*
                |--------------------------------------------------------------------------
                | Remove button
                |--------------------------------------------------------------------------
                */

                const removeButton =
                    document.createElement('button');

                removeButton.type =
                    'button';

                removeButton.className =
                    'selected-file-remove';

                removeButton.title =
                    'Remove selected file';

                removeButton.innerHTML =
                    '<i class="bx bx-x"></i>';


                removeButton.addEventListener(
                    'click',
                    function () {

                        removeSelectedFile(index);

                    }
                );


                /*
                |--------------------------------------------------------------------------
                | Build file row
                |--------------------------------------------------------------------------
                */

                item.appendChild(
                    iconContainer
                );

                item.appendChild(
                    info
                );

                item.appendChild(
                    removeButton
                );


                selectedFileList.appendChild(
                    item
                );

            }
        );

    }


    /*
    |--------------------------------------------------------------------------
    | Remove selected file
    |--------------------------------------------------------------------------
    */

    function removeSelectedFile(index) {

        selectedFilesArray.splice(
            index,
            1
        );


        updateFileInput();

        renderSelectedFiles();

    }


    /*
    |--------------------------------------------------------------------------
    | Update actual input FileList.
    |--------------------------------------------------------------------------
    |
    | This makes the removal real.
    | The removed file will NOT be sent to Laravel.
    |
    */

    function updateFileInput() {

        const dataTransfer =
            new DataTransfer();


        selectedFilesArray.forEach(
            function (file) {

                dataTransfer.items.add(
                    file
                );

            }
        );


        fileInput.files =
            dataTransfer.files;

    }


    /*
    |--------------------------------------------------------------------------
    | File icon
    |--------------------------------------------------------------------------
    */

    function getFileIcon(fileName) {

        const extension =
            fileName
                .split('.')
                .pop()
                .toLowerCase();


        if (extension === 'pdf') {
            return 'bx bxs-file-pdf';
        }


        if (
            extension === 'doc' ||
            extension === 'docx'
        ) {
            return 'bx bxs-file-doc';
        }


        if (
            extension === 'xls' ||
            extension === 'xlsx'
        ) {
            return 'bx bxs-file';
        }


        if (
            extension === 'ppt' ||
            extension === 'pptx'
        ) {
            return 'bx bxs-file';
        }


        if (
            extension === 'jpg' ||
            extension === 'jpeg' ||
            extension === 'png' ||
            extension === 'gif' ||
            extension === 'webp'
        ) {
            return 'bx bxs-image';
        }


        if (
            extension === 'mp4' ||
            extension === 'mov' ||
            extension === 'avi' ||
            extension === 'mkv'
        ) {
            return 'bx bxs-video';
        }


        if (
            extension === 'mp3' ||
            extension === 'wav' ||
            extension === 'm4a'
        ) {
            return 'bx bxs-music';
        }


        if (
            extension === 'zip' ||
            extension === 'rar' ||
            extension === '7z'
        ) {
            return 'bx bxs-file-archive';
        }


        return 'bx bxs-file';

    }


    /*
    |--------------------------------------------------------------------------
    | Format file size
    |--------------------------------------------------------------------------
    */

    function formatFileSize(bytes) {

        if (bytes === 0) {
            return '0 Bytes';
        }


        const units = [
            'Bytes',
            'KB',
            'MB',
            'GB'
        ];


        const index =
            Math.floor(
                Math.log(bytes) /
                Math.log(1024)
            );


        return (
            bytes /
            Math.pow(
                1024,
                index
            )
        ).toFixed(2)
        + ' '
        + units[index];

    }

});

</script>

@endsection

