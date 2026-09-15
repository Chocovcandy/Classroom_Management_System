```blade
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

    margin-bottom: 4px;

    font-size: 12px;
    font-weight: 700;

    letter-spacing: 1px;

    color: #64748b;
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

    box-shadow:
        0 5px 20px rgba(15, 23, 42, 0.05);
}


/* =========================================================
   FORM
========================================================= */

.material-form-group {
    margin-bottom: 20px;
}

.material-form-group > label {
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

    box-shadow:
        0 0 0 3px rgba(100, 116, 139, 0.12);
}


/* =========================================================
   FILE COUNT
========================================================= */

.material-file-count {
    display: flex;
    align-items: center;

    gap: 8px;

    margin-bottom: 12px;

    font-size: 13px;

    color: #64748b;
}

.material-file-count strong {
    color: #334155;
}


/* =========================================================
   CURRENT FILES
========================================================= */

.material-files-list {
    display: flex;

    flex-direction: column;

    gap: 10px;
}

.material-current-file {
    display: flex;

    align-items: center;

    gap: 12px;

    padding: 12px 14px;

    border: 1px solid #e2e8f0;

    border-radius: 10px;

    background: #f8fafc;
}

.material-current-file-icon {
    width: 38px;
    height: 38px;

    flex-shrink: 0;

    display: flex;

    align-items: center;

    justify-content: center;

    border-radius: 8px;

    background: #e2e8f0;

    color: #475569;
}

.material-current-file-info {
    flex: 1;

    min-width: 0;
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
   DELETE FILE BUTTON
========================================================= */

.material-delete-file-btn {
    width: 36px;
    height: 36px;

    flex-shrink: 0;

    display: flex;

    align-items: center;

    justify-content: center;

    border: 1px solid #fecaca;

    border-radius: 8px;

    background: #fff7f7;

    color: #dc2626;

    cursor: pointer;

    transition: 0.2s ease;
}

.material-delete-file-btn:hover {
    background: #fee2e2;

    border-color: #fca5a5;

    color: #b91c1c;
}

.material-delete-file-btn i {
    font-size: 18px;
}


/* =========================================================
   NO FILES
========================================================= */

.material-no-files {
    padding: 18px;

    border: 1px dashed #cbd5e1;

    border-radius: 10px;

    text-align: center;

    background: #f8fafc;

    color: #64748b;

    font-size: 13px;
}


/* =========================================================
   ADD MORE FILES
========================================================= */

.material-add-files {
    margin-top: 24px;

    padding-top: 24px;

    border-top: 1px solid #e2e8f0;
}

.material-add-files > label {
    display: block;

    margin-bottom: 8px;

    font-size: 14px;

    font-weight: 700;

    color: #334155;
}

.material-upload-box {
    border: 2px dashed #cbd5e1;

    border-radius: 12px;

    padding: 20px;

    background: #f8fafc;

    transition: 0.2s ease;
}

.material-upload-box:hover {
    border-color: #94a3b8;

    background: #f1f5f9;
}

.material-upload-box input[type="file"] {
    width: 100%;
}


/* =========================================================
   UPLOAD HELP
========================================================= */

.material-upload-help {
    display: block;

    margin-top: 8px;

    font-size: 12px;

    color: #64748b;
}


/* =========================================================
   SELECTED NEW FILES
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

    align-items: center;

    justify-content: space-between;

    margin-bottom: 10px;

    font-size: 13px;

    color: #334155;
}

.selected-files-header strong {
    font-weight: 700;
}

.selected-files-header span {
    font-size: 12px;

    color: #64748b;
}

.selected-files-list {
    display: flex;

    flex-direction: column;

    gap: 8px;
}

.selected-file-item {
    display: flex;

    align-items: center;

    gap: 12px;

    padding: 11px 12px;

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
}

.selected-file-icon i {
    font-size: 18px;
}

.selected-file-info {
    flex: 1;

    min-width: 0;
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

    font-size: 12px;

    color: #64748b;
}


/* =========================================================
   REMOVE SELECTED NEW FILE
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

    .material-current-file {
        align-items: flex-start;
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
            href="{{ $returnTo === 'classwork'
                ? route(
                    'professor.class-groups.classroom-group.classwork',
                    $classGroup
                )
                : route(
                    'professor.class-groups.classroom-group',
                    $classGroup
                )
            }}"
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
         MAIN UPDATE FORM
    ====================================================== --}}

    <div class="material-edit-card">

        <form
            action="{{ route(
                'professor.class-groups.materials.update',
                [
                    'classGroup' => $classGroup,
                    'material' => $material,
                ]
            ) }}"
            method="POST"
            enctype="multipart/form-data"
            id="material-update-form"
        >

            @csrf

            @method('PUT')


            {{-- =================================================
                 RETURN LOCATION
            ================================================== --}}

<input
    type="hidden"
    name="return_to"
    value="{{ $returnTo }}"
>

<input
    type="hidden"
    name="origin"
    value="{{ $origin }}"
>


            {{-- =================================================
                 TITLE
            ================================================== --}}

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


            {{-- =================================================
                 DESCRIPTION
            ================================================== --}}

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


            {{-- =================================================
                 CURRENT FILES
            ================================================== --}}

            <div class="material-form-group">

                <label>
                    Current Files
                </label>


                <div class="material-file-count">

                    <i class="bx bx-file"></i>

                    <span>

                        <strong>
                            {{ $material->resources->count() }}
                        </strong>

                        {{ $material->resources->count() === 1
                            ? 'file'
                            : 'files'
                        }}

                        attached to this material.

                    </span>

                </div>


                @if ($material->resources->count() > 0)

                    <div class="material-files-list">

                        @foreach ($material->resources as $resource)

                            <div
                                class="material-current-file"
                            >

                                {{-- =================================================
                                     FILE ICON
                                ================================================== --}}

                                <div class="material-current-file-icon">

                                    @php

                                        $extension = strtolower(
                                            pathinfo(
                                                $resource->file_name
                                                    ?? $resource->title,
                                                PATHINFO_EXTENSION
                                            )
                                        );

                                        $icon = match ($extension) {

                                            'pdf'
                                                => 'bxs-file-pdf',

                                            'doc',
                                            'docx'
                                                => 'bxs-file-doc',

                                            'xls',
                                            'xlsx'
                                                => 'bx-spreadsheet',

                                            'ppt',
                                            'pptx'
                                                => 'bxs-file',

                                            'jpg',
                                            'jpeg',
                                            'png',
                                            'gif',
                                            'webp'
                                                => 'bxs-file-image',

                                            'mp4',
                                            'mov',
                                            'avi',
                                            'mkv'
                                                => 'bxs-video',

                                            'mp3',
                                            'wav',
                                            'm4a'
                                                => 'bxs-music',

                                            'zip',
                                            'rar',
                                            '7z'
                                                => 'bxs-file-archive',

                                            default
                                                => 'bx-file'
                                        };

                                    @endphp


                                    <i
                                        class="bx {{ $icon }}"
                                    ></i>

                                </div>


                                {{-- =================================================
                                     FILE INFORMATION
                                ================================================== --}}

                                <div
                                    class="material-current-file-info"
                                >

                                    <strong>
                                        {{ $resource->file_name
                                            ?? $resource->title
                                        }}
                                    </strong>

                                    <span>

                                        @if ($resource->file_size)

                                            {{ number_format(
                                                $resource->file_size / 1024 / 1024,
                                                2
                                            ) }}

                                            MB

                                        @else

                                            Unknown size

                                        @endif


                                        @if ($resource->mime_type)

                                            · {{ $resource->mime_type }}

                                        @endif

                                    </span>

                                </div>


                                {{-- =================================================
                                     DELETE EXISTING FILE
                                ================================================== --}}

                                <button
                                    type="button"
                                    class="material-delete-file-btn"
                                    data-delete-url="{{ route(
                                        'professor.class-groups.materials.resources.destroy',
                                        [
                                            'classGroup' => $classGroup,
                                            'material' => $material,
                                            'resource' => $resource,
                                        ]
                                    ) }}"
                                    title="Delete file"
                                >

                                    <i class="bx bx-trash"></i>

                                </button>

                            </div>

                        @endforeach

                    </div>

                @else

                    <div class="material-no-files">

                        <i class="bx bx-file"></i>

                        No files attached to this material.

                    </div>

                @endif

            </div>


            {{-- =================================================
                 ADD MORE FILES
            ================================================== --}}

            <div class="material-add-files">

                <label for="files">
                    Add More Files
                </label>


                <div class="material-upload-box">

                    <input
                        id="files"
                        type="file"
                        name="files[]"
                        multiple
                    >


                    <span class="material-upload-help">

                        Select one or multiple files.

                        You can remove a selected file before
                        submitting.

                        Maximum 10 new files, 50 MB per file.

                    </span>

                </div>


                {{-- =================================================
                     SELECTED NEW FILES
                ================================================== --}}

                <div
                    id="selected-files"
                    class="selected-files"
                >

                    <div class="selected-files-header">

                        <strong>
                            Selected Files
                        </strong>

                        <span id="selected-files-count">
                            0 files
                        </span>

                    </div>


                    <div
                        id="selected-files-list"
                        class="selected-files-list"
                    >
                    </div>

                </div>


                @error('files')

                    <div class="material-error">
                        {{ $message }}
                    </div>

                @enderror


                @error('files.*')

                    <div class="material-error">
                        {{ $message }}
                    </div>

                @enderror

            </div>


            {{-- =================================================
                 ACTIONS
            ================================================== --}}

            <div class="material-form-footer">

                @if ($returnTo === 'show')

                    <a
                        href="{{ route(
                            'professor.class-groups.materials.show',
                            [
                                'classGroup' => $classGroup,
                                'material' => $material,
                                'return_to' => $returnTo,
                            ]
                        ) }}"
                        class="material-cancel-btn"
                    >
                        Cancel
                    </a>

                @elseif ($returnTo === 'classwork')

                    <a
                        href="{{ route(
                            'professor.class-groups.classroom-group.classwork',
                            $classGroup
                        ) }}"
                        class="material-cancel-btn"
                    >
                        Cancel
                    </a>

                @else

                    <a
                        href="{{ route(
                            'professor.class-groups.classroom-group',
                            $classGroup
                        ) }}"
                        class="material-cancel-btn"
                    >
                        Cancel
                    </a>

                @endif


                <button
                    type="submit"
                    class="material-update-btn"
                >
                    <i class="bx bx-save"></i>
                    Update Material
                </button>

            </div>

        </form>


        {{-- =====================================================
             SEPARATE RESOURCE DELETE FORM
             
             IMPORTANT:
             This form is outside the main update form.
             Only ONE exists on this page.
        ====================================================== --}}

        <form
            id="resource-delete-form"
            method="POST"
            style="display: none;"
        >

            @csrf

            @method('DELETE')

        </form>

    </div>

</div>


{{-- =========================================================
     JAVASCRIPT
========================================================= --}}

<script>

document.addEventListener('DOMContentLoaded', function () {


    /*
    |--------------------------------------------------------------------------
    | EXISTING RESOURCE DELETE
    |--------------------------------------------------------------------------
    */

    const deleteForm =
        document.getElementById(
            'resource-delete-form'
        );


    const deleteButtons =
        document.querySelectorAll(
            '.material-delete-file-btn'
        );


    if (deleteForm) {

        deleteButtons.forEach(function (button) {

            button.addEventListener(
                'click',
                function () {

                    const deleteUrl =
                        this.dataset.deleteUrl;


                    if (!deleteUrl) {

                        console.error(
                            'Delete URL is missing.'
                        );

                        return;
                    }


                    const confirmed =
                        confirm(
                            'Are you sure you want to delete this file?'
                        );


                    if (!confirmed) {
                        return;
                    }


                    deleteForm.action =
                        deleteUrl;


                    deleteForm.submit();

                }
            );

        });

    }


    /*
    |--------------------------------------------------------------------------
    | NEW FILE SELECTION
    |--------------------------------------------------------------------------
    */

    const fileInput =
        document.getElementById('files');


    const selectedFilesContainer =
        document.getElementById(
            'selected-files'
        );


    const selectedFilesList =
        document.getElementById(
            'selected-files-list'
        );


    const selectedFilesCount =
        document.getElementById(
            'selected-files-count'
        );


    if (
        !fileInput ||
        !selectedFilesContainer ||
        !selectedFilesList ||
        !selectedFilesCount
    ) {
        return;
    }


    /*
    |--------------------------------------------------------------------------
    | Keep our own list of selected files.
    |--------------------------------------------------------------------------
    */

    let selectedFiles = [];


    /*
    |--------------------------------------------------------------------------
    | User selects files
    |--------------------------------------------------------------------------
    */

    fileInput.addEventListener(
        'change',
        function () {

            const newlySelectedFiles =
                Array.from(this.files);


            /*
            |--------------------------------------------------------------------------
            | Add newly selected files
            |--------------------------------------------------------------------------
            */

            newlySelectedFiles.forEach(
                function (file) {

                    const duplicate =
                        selectedFiles.some(
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

                        selectedFiles.push(
                            file
                        );

                    }

                }
            );


            updateFileInput();

            renderSelectedFiles();

        }
    );


    /*
    |--------------------------------------------------------------------------
    | Render selected files
    |--------------------------------------------------------------------------
    */

    function renderSelectedFiles() {

        selectedFilesList.innerHTML = '';


        /*
        |--------------------------------------------------------------------------
        | No files selected
        |--------------------------------------------------------------------------
        */

        if (selectedFiles.length === 0) {

            selectedFilesContainer.classList.remove(
                'has-files'
            );

            selectedFilesCount.textContent =
                '0 files';

            return;

        }


        /*
        |--------------------------------------------------------------------------
        | Show selected file area
        |--------------------------------------------------------------------------
        */

        selectedFilesContainer.classList.add(
            'has-files'
        );


        selectedFilesCount.textContent =
            selectedFiles.length === 1
                ? '1 file'
                : selectedFiles.length + ' files';


        /*
        |--------------------------------------------------------------------------
        | Display every selected file
        |--------------------------------------------------------------------------
        */

        selectedFiles.forEach(
            function (file, index) {

                const fileItem =
                    document.createElement(
                        'div'
                    );

                fileItem.className =
                    'selected-file-item';


                /*
                |--------------------------------------------------------------------------
                | File icon
                |--------------------------------------------------------------------------
                */

                const iconContainer =
                    document.createElement(
                        'div'
                    );

                iconContainer.className =
                    'selected-file-icon';


                const icon =
                    document.createElement(
                        'i'
                    );

                icon.className =
                    getFileIcon(
                        file.name
                    );


                iconContainer.appendChild(
                    icon
                );


                /*
                |--------------------------------------------------------------------------
                | File information
                |--------------------------------------------------------------------------
                */

                const fileInfo =
                    document.createElement(
                        'div'
                    );

                fileInfo.className =
                    'selected-file-info';


                const fileName =
                    document.createElement(
                        'strong'
                    );

                fileName.className =
                    'selected-file-name';

                fileName.textContent =
                    file.name;


                const fileSize =
                    document.createElement(
                        'span'
                    );

                fileSize.className =
                    'selected-file-size';

                fileSize.textContent =
                    formatFileSize(
                        file.size
                    );


                fileInfo.appendChild(
                    fileName
                );

                fileInfo.appendChild(
                    fileSize
                );


                /*
                |--------------------------------------------------------------------------
                | Remove button
                |--------------------------------------------------------------------------
                */

                const removeButton =
                    document.createElement(
                        'button'
                    );

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

                        removeSelectedFile(
                            index
                        );

                    }
                );


                /*
                |--------------------------------------------------------------------------
                | Build file row
                |--------------------------------------------------------------------------
                */

                fileItem.appendChild(
                    iconContainer
                );

                fileItem.appendChild(
                    fileInfo
                );

                fileItem.appendChild(
                    removeButton
                );


                selectedFilesList.appendChild(
                    fileItem
                );

            }
        );

    }


    /*
    |--------------------------------------------------------------------------
    | Remove selected new file
    |--------------------------------------------------------------------------
    */

    function removeSelectedFile(index) {

        selectedFiles.splice(
            index,
            1
        );


        updateFileInput();

        renderSelectedFiles();

    }


    /*
    |--------------------------------------------------------------------------
    | Update real file input
    |--------------------------------------------------------------------------
    |
    | This is important.
    |
    | We don't just hide the file from the preview.
    | We actually remove it from the FileList so Laravel
    | will not receive that file when the form is submitted.
    |
    */

    function updateFileInput() {

        const dataTransfer =
            new DataTransfer();


        selectedFiles.forEach(
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
            return 'bx bx-spreadsheet';
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
    | File size
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


        const unitIndex =
            Math.floor(
                Math.log(bytes) /
                Math.log(1024)
            );


        return (
            bytes /
            Math.pow(
                1024,
                unitIndex
            )
        ).toFixed(2)
        + ' '
        + units[unitIndex];

    }

});

</script>

@endsection
```
