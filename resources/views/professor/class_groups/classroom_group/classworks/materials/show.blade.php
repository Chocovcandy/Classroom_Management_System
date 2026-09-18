@extends('layouts.prof_layout')

@section('content')

<style>
    /* =========================================================
       MATERIAL SHOW PAGE
    ========================================================= */

    .material-page {
        width: 100%;
        max-width: 1500px;
        margin: 0 auto;
        padding: 30px 32px 50px;
        color: var(--text-color, #1f2937);
    }

    .material-topbar {
        display: flex;
        align-items: flex-start;
        gap: 16px;
        margin-bottom: 28px;
    }

    .material-back {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 44px;
        height: 44px;
        flex-shrink: 0;
        border: 1px solid var(--border-color, #e5e7eb);
        border-radius: 13px;
        background: var(--card-color, #ffffff);
        color: var(--text-color, #374151);
        text-decoration: none;
        transition: 0.2s ease;
    }

    .material-back:hover {
        color: #2563eb;
        border-color: #93c5fd;
        background: #eff6ff;
        transform: translateX(-3px);
    }

    .material-heading {
        min-width: 0;
        flex: 1;
    }

    .material-heading-label {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        margin-bottom: 8px;
        padding: 6px 11px;
        border-radius: 999px;
        background: #eff6ff;
        color: #2563eb;
        font-size: 0.72rem;
        font-weight: 800;
        letter-spacing: 0.7px;
        text-transform: uppercase;
    }

    .material-heading h1 {
        margin: 0;
        color: var(--text-color, #111827);
        font-size: clamp(1.5rem, 2.5vw, 2.15rem);
        font-weight: 800;
        line-height: 1.25;
        overflow-wrap: anywhere;
    }

    .material-topic {
        display: flex;
        align-items: center;
        gap: 7px;
        margin-top: 10px;
        color: var(--text-secondary, #6b7280);
        font-size: 0.92rem;
        font-weight: 600;
    }

    .material-topic i {
        color: #2563eb;
    }

    .material-heading-icon {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 58px;
        height: 58px;
        flex-shrink: 0;
        border-radius: 18px;
        background: linear-gradient(145deg, #2563eb, #60a5fa);
        color: #ffffff;
        font-size: 1.65rem;
        box-shadow: 0 10px 25px rgba(37, 99, 235, 0.2);
    }

    .material-layout {
        display: grid;
        grid-template-columns: minmax(0, 1fr) 310px;
        gap: 24px;
        align-items: start;
    }

    .material-main,
    .material-sidebar {
        min-width: 0;
    }

    .material-main {
        display: flex;
        flex-direction: column;
        gap: 22px;
    }

    .material-sidebar {
        display: flex;
        flex-direction: column;
        gap: 20px;
    }

    .material-card {
        min-width: 0;
        padding: 25px;
        border: 1px solid var(--border-color, #e5e7eb);
        border-radius: 20px;
        background: var(--card-color, #ffffff);
        box-shadow: 0 8px 25px rgba(15, 23, 42, 0.045);
    }

    .material-card-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 14px;
        margin-bottom: 20px;
        padding-bottom: 16px;
        border-bottom: 1px solid var(--border-color, #e5e7eb);
    }

    .material-card-header h2,
    .material-card-header h3 {
        display: flex;
        align-items: center;
        gap: 9px;
        margin: 0;
        color: var(--text-color, #111827);
        font-size: 1.08rem;
        font-weight: 800;
    }

    .material-card-header h2 i,
    .material-card-header h3 i {
        color: #2563eb;
        font-size: 1.2rem;
    }

    .material-card-header span {
        color: var(--text-secondary, #6b7280);
        font-size: 0.8rem;
        font-weight: 700;
    }

    .material-description {
        color: var(--text-color, #374151);
        font-size: 0.98rem;
        font-weight: 500;
        line-height: 1.85;
        overflow-wrap: anywhere;
    }

    .material-description p {
        margin: 0 0 14px;
    }

    .material-description p:last-child {
        margin-bottom: 0;
    }

    .material-empty {
        padding: 28px 18px;
        border: 1px dashed var(--border-color, #d1d5db);
        border-radius: 14px;
        background: var(--background-color, #f9fafb);
        color: var(--text-muted, #9ca3af);
        text-align: center;
        font-size: 0.9rem;
        font-weight: 600;
    }

    .material-empty i {
        display: block;
        margin-bottom: 8px;
        font-size: 2rem;
    }

    .resource-list {
        display: flex;
        flex-direction: column;
        gap: 12px;
    }

    .resource-item {
        display: flex;
        align-items: center;
        gap: 14px;
        min-width: 0;
        padding: 15px;
        border: 1px solid var(--border-color, #e5e7eb);
        border-radius: 15px;
        background: var(--card-color, #ffffff);
        transition: 0.2s ease;
    }

.resource-item:hover {
    border-color: #93c5fd;
    background: #f8fbff;
}
    .resource-icon {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 46px;
        height: 46px;
        flex-shrink: 0;
        border-radius: 13px;
        background: #eff6ff;
        color: #2563eb;
        font-size: 1.2rem;
    }

    .resource-info {
        min-width: 0;
        flex: 1;
    }

    .resource-info strong {
        display: block;
        margin: 0;
        color: var(--text-color, #1f2937);
        font-size: 0.94rem;
        font-weight: 800;
        line-height: 1.45;
        overflow-wrap: anywhere;
    }

    .resource-info span {
        display: block;
        margin-top: 5px;
        color: var(--text-secondary, #6b7280);
        font-size: 0.78rem;
        font-weight: 600;
    }

    .resource-actions {
        display: flex;
        align-items: center;
        justify-content: flex-end;
        flex-wrap: wrap;
        gap: 8px;
        flex-shrink: 0;
    }

    .resource-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 6px;
        min-height: 36px;
        padding: 8px 12px;
        border: 1px solid #bfdbfe;
        border-radius: 10px;
        background: #eff6ff;
        color: #2563eb;
        font-size: 0.78rem;
        font-weight: 800;
        text-decoration: none;
        cursor: pointer;
        transition: 0.2s ease;
    }

    .resource-btn:hover {
        border-color: #2563eb;
        background: #2563eb;
        color: #ffffff;
    }

    .resource-btn.download {
        border-color: #d1d5db;
        background: var(--card-color, #ffffff);
        color: var(--text-color, #374151);
    }

    .resource-btn.download:hover {
        border-color: #2563eb;
        background: #eff6ff;
        color: #2563eb;
    }

    .info-list {
        display: flex;
        flex-direction: column;
        gap: 18px;
    }

    .info-item {
        display: flex;
        align-items: flex-start;
        gap: 12px;
    }

    .info-icon {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 38px;
        height: 38px;
        flex-shrink: 0;
        border-radius: 11px;
        background: #f3f4f6;
        color: #6b7280;
        font-size: 1.1rem;
    }

    .info-content {
        min-width: 0;
        flex: 1;
    }

    .info-content span {
        display: block;
        margin-bottom: 4px;
        color: var(--text-muted, #9ca3af);
        font-size: 0.73rem;
        font-weight: 800;
        letter-spacing: 0.5px;
        text-transform: uppercase;
    }

    .info-content strong {
        display: block;
        color: var(--text-color, #374151);
        font-size: 0.9rem;
        font-weight: 750;
        line-height: 1.5;
    }

    .edit-material-btn {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        width: 100%;
        min-height: 45px;
        padding: 11px 15px;
        border-radius: 12px;
        background: #2563eb;
        color: #ffffff;
        font-size: 0.86rem;
        font-weight: 800;
        text-decoration: none;
        transition: 0.2s ease;
    }

    .edit-material-btn:hover {
        background: #1d4ed8;
        color: #ffffff;
        transform: translateY(-1px);
    }

    /* =========================================================
       PREVIEW MODAL
    ========================================================= */

    .material-modal {
        position: fixed;
        inset: 0;
        z-index: 9999;
        display: none;
        align-items: center;
        justify-content: center;
        padding: 22px;
    }

    .material-modal.active {
        display: flex;
    }

    .material-modal-overlay {
        position: absolute;
        inset: 0;
        background: rgba(15, 23, 42, 0.74);
        backdrop-filter: blur(5px);
    }

    .material-modal-container {
        position: relative;
        z-index: 1;
        display: flex;
        flex-direction: column;
        width: min(1100px, 100%);
        height: min(850px, calc(100vh - 44px));
        overflow: hidden;
        border-radius: 20px;
        background: var(--card-color, #ffffff);
        box-shadow: 0 25px 80px rgba(0, 0, 0, 0.28);
    }

    .material-modal-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 15px;
        min-height: 70px;
        padding: 15px 22px;
        border-bottom: 1px solid var(--border-color, #e5e7eb);
    }

    .material-modal-title {
        display: flex;
        align-items: center;
        gap: 10px;
        min-width: 0;
        color: var(--text-color, #111827);
        font-size: 1rem;
        font-weight: 800;
    }

    .material-modal-title i {
        color: #2563eb;
        font-size: 1.3rem;
    }

    .material-modal-title span {
        overflow-wrap: anywhere;
    }

    .material-modal-actions {
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .modal-icon-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 38px;
        height: 38px;
        border: 1px solid var(--border-color, #e5e7eb);
        border-radius: 10px;
        background: var(--background-color, #f9fafb);
        color: var(--text-secondary, #6b7280);
        cursor: pointer;
        transition: 0.2s ease;
    }

    .modal-icon-btn:hover {
        border-color: #93c5fd;
        background: #eff6ff;
        color: #2563eb;
    }

    .modal-icon-btn.close:hover {
        border-color: #fecaca;
        background: #fee2e2;
        color: #dc2626;
    }

    .material-modal-body {
        flex: 1;
        min-height: 0;
        overflow: auto;
        background: #f3f4f6;
    }

    .preview-frame {
        display: block;
        width: 100%;
        height: 100%;
        min-height: 500px;
        border: 0;
        background: #ffffff;
    }

    .preview-image-wrapper {
        display: flex;
        align-items: center;
        justify-content: center;
        min-height: 100%;
        padding: 25px;
    }

    .preview-image {
        display: block;
        max-width: 100%;
        max-height: 100%;
        object-fit: contain;
        border-radius: 8px;
    }

    .preview-video {
        display: block;
        width: 100%;
        max-height: 100%;
        background: #000000;
    }

    .preview-audio-wrapper {
        display: flex;
        align-items: center;
        justify-content: center;
        min-height: 300px;
        padding: 30px;
    }

    .preview-audio-wrapper audio {
        width: min(600px, 100%);
    }

    .preview-unavailable {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        min-height: 300px;
        padding: 35px;
        text-align: center;
        color: #6b7280;
    }

    .preview-unavailable i {
        margin-bottom: 12px;
        color: #9ca3af;
        font-size: 3rem;
    }

    .preview-unavailable h3 {
        margin: 0 0 8px;
        color: #374151;
        font-size: 1.1rem;
    }

    .preview-unavailable p {
        margin: 0 0 18px;
        font-size: 0.9rem;
    }

    body.modal-open {
        overflow: hidden;
    }

    .material-modal.fullscreen .material-modal-container {
        width: 100%;
        height: 100%;
        border-radius: 0;
    }

    /* =========================================================
       DARK MODE
    ========================================================= */

    .dark .material-heading-label {
        background: rgba(59, 130, 246, 0.15);
        color: #93c5fd;
    }

    .dark .resource-item:hover {
        border-color: #3b82f6;
        background: rgba(59, 130, 246, 0.08);
    }

    .dark .resource-icon {
        background: rgba(59, 130, 246, 0.15);
        color: #93c5fd;
    }

    .dark .resource-btn {
        background: rgba(59, 130, 246, 0.15);
        border-color: rgba(96, 165, 250, 0.35);
        color: #93c5fd;
    }

    .dark .resource-btn:hover {
        background: #2563eb;
        color: #ffffff;
    }

    .dark .info-icon {
        background: rgba(156, 163, 175, 0.12);
        color: #9ca3af;
    }

    .dark .material-modal-body {
        background: #111827;
    }

    /* =========================================================
       RESPONSIVE
    ========================================================= */

    @media (max-width: 1050px) {
        .material-layout {
            grid-template-columns: minmax(0, 1fr) 280px;
            gap: 18px;
        }

        .material-card {
            padding: 22px;
        }
    }

    @media (max-width: 850px) {
        .material-page {
            padding: 24px 20px 40px;
        }

        .material-layout {
            grid-template-columns: 1fr;
        }

        .material-sidebar {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            align-items: start;
        }
    }

    @media (max-width: 620px) {
        .material-page {
            padding: 18px 14px 30px;
        }

        .material-topbar {
            gap: 11px;
            margin-bottom: 23px;
        }

        .material-back {
            width: 39px;
            height: 39px;
            border-radius: 11px;
        }

        .material-heading-icon {
            width: 48px;
            height: 48px;
            border-radius: 14px;
            font-size: 1.3rem;
        }

        .material-heading h1 {
            font-size: 1.35rem;
        }

        .material-topic {
            font-size: 0.82rem;
        }

        .material-card {
            padding: 18px;
            border-radius: 16px;
        }

        .material-card-header {
            align-items: flex-start;
            margin-bottom: 16px;
            padding-bottom: 14px;
        }

        .material-card-header h2,
        .material-card-header h3 {
            font-size: 0.98rem;
        }

        .material-description {
            font-size: 0.9rem;
            line-height: 1.75;
        }

        .material-sidebar {
            display: flex;
        }

        .resource-item {
            align-items: flex-start;
            gap: 10px;
            padding: 12px;
        }

        .resource-icon {
            width: 39px;
            height: 39px;
            border-radius: 11px;
            font-size: 1rem;
        }

        .resource-info strong {
            font-size: 0.84rem;
        }

        .resource-info span {
            font-size: 0.72rem;
        }

        .resource-actions {
            flex-direction: column;
            align-items: stretch;
        }

        .resource-btn {
            min-height: 32px;
            padding: 7px 9px;
            font-size: 0.7rem;
        }

        .material-modal {
            padding: 0;
        }

        .material-modal-container {
            width: 100%;
            height: 100%;
            border-radius: 0;
        }

        .material-modal-header {
            min-height: 62px;
            padding: 13px 15px;
        }

        .material-modal-title {
            font-size: 0.88rem;
        }

        .preview-frame {
            min-height: 400px;
        }
    }

    @media (max-width: 400px) {
        .material-heading h1 {
            font-size: 1.2rem;
        }

        .material-heading-label {
            font-size: 0.64rem;
        }

        .resource-btn span {
            display: none;
        }
    }
    /* =========================================================
   DARK MODE — FILE / RESOURCE HOVER
   ========================================================= */

html.dark .resource-item,
body.dark .resource-item,
.dark-mode .resource-item {
    background: #111329;
    border-color: #292d4d;
}

html.dark .resource-item:hover,
body.dark .resource-item:hover,
.dark-mode .resource-item:hover {
    background: #171a35;
    border-color: #3b82f6;
}

/* File name */
html.dark .resource-info strong,
body.dark .resource-info strong,
.dark-mode .resource-info strong {
    color: #ffffff;
}

/* File type + size */
html.dark .resource-info span,
body.dark .resource-info span,
.dark-mode .resource-info span {
    color: #aeb6c8;
}

/* Download button */
html.dark .resource-btn.download,
body.dark .resource-btn.download,
.dark-mode .resource-btn.download {
    background: #111329;
    border-color: #34385a;
    color: #ffffff;
}

html.dark .resource-btn.download:hover,
body.dark .resource-btn.download:hover,
.dark-mode .resource-btn.download:hover {
    background: #1d4ed8;
    border-color: #3b82f6;
    color: #ffffff;
}

/* Open button */
html.dark .resource-btn,
body.dark .resource-btn,
.dark-mode .resource-btn {
    color: #93c5fd;
}

html.dark .resource-btn:hover,
body.dark .resource-btn:hover,
.dark-mode .resource-btn:hover {
    background: #2563eb;
    border-color: #3b82f6;
    color: #ffffff;
}
</style>

<div class="material-page">

    {{-- HEADER --}}
    <div class="material-topbar">

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
            class="material-back"
            title="Back">

            <i class="bx bx-arrow-back"></i>
        </a>

        <div class="material-heading">

            <span class="material-heading-label">
                <i class="bx bx-book-open"></i>
                Material
            </span>

            <h1>{{ $material->title }}</h1>

            @if($material->topic)
                <div class="material-topic">
                    <i class="bx bx-folder"></i>
                    {{ $material->topic->topic_name }}
                </div>
            @endif

        </div>

        <div class="material-heading-icon">
            <i class="bx bx-book-open"></i>
        </div>

    </div>

    {{-- MAIN CONTENT --}}
    <div class="material-layout">

        {{-- LEFT CONTENT --}}
        <main class="material-main">

            {{-- DESCRIPTION --}}
            <section class="material-card">

                <div class="material-card-header">
                    <h2>
                        <i class="bx bx-align-left"></i>
                        Description
                    </h2>
                </div>

                <div class="material-description">

                    @if($material->description)

                        {!! nl2br(e($material->description)) !!}

                    @else

                        <div class="material-empty">
                            <i class="bx bx-file-blank"></i>
                            No description provided.
                        </div>

                    @endif

                </div>

            </section>

            {{-- ATTACHED RESOURCES --}}
            <section class="material-card">

                <div class="material-card-header">

                    <h2>
                        <i class="bx bx-paperclip"></i>
                        Attached Resources
                    </h2>

                    <span>
                        {{ $material->resources->count() }}
                        {{ $material->resources->count() === 1 ? 'file' : 'files' }}
                    </span>

                </div>

                <div class="resource-list">

                    @forelse($material->resources as $resource)

                        @php
                            $extension = strtolower(
                                pathinfo($resource->file_name, PATHINFO_EXTENSION)
                            );

                            $fileUrl = asset(
                                'storage/' . ltrim($resource->file_path, '/')
                            );

                            $fileSize = $resource->file_size
                                ? number_format(
                                    $resource->file_size / 1024 / 1024,
                                    2
                                ) . ' MB'
                                : 'Unknown size';

                            $previewable = in_array($extension, [
                                'pdf',
                                'jpg',
                                'jpeg',
                                'png',
                                'gif',
                                'webp',
                                'mp4',
                                'webm',
                                'mov',
                                'mp3',
                                'wav',
                                'ogg',
                                'm4a'
                            ]);
                        @endphp

                        <div class="resource-item">

                            <div class="resource-icon">

                                @if(in_array($extension, [
                                    'jpg',
                                    'jpeg',
                                    'png',
                                    'gif',
                                    'webp'
                                ]))

                                    <i class="bx bx-image"></i>

                                @elseif($extension === 'pdf')

                                    <i class="bx bxs-file-pdf"></i>

                                @elseif(in_array($extension, ['doc', 'docx']))

                                    <i class="bx bxs-file-doc"></i>

                                @elseif(in_array($extension, ['xls', 'xlsx', 'csv']))

                                    <i class="bx bxs-file"></i>

                                @elseif(in_array($extension, ['ppt', 'pptx']))

                                    <i class="bx bxs-slideshow"></i>

                                @elseif(in_array($extension, [
                                    'mp4',
                                    'webm',
                                    'mov',
                                    'avi'
                                ]))

                                    <i class="bx bx-video"></i>

                                @elseif(in_array($extension, [
                                    'mp3',
                                    'wav',
                                    'ogg',
                                    'm4a'
                                ]))

                                    <i class="bx bx-music"></i>

                                @elseif($extension === 'zip')

                                    <i class="bx bxs-file-archive"></i>

                                @else

                                    <i class="bx bx-file"></i>

                                @endif

                            </div>

                            <div class="resource-info">

                                <strong>
                                    {{ $resource->file_name }}
                                </strong>

                                <span>
                                    {{ strtoupper($extension ?: 'FILE') }}
                                    ·
                                    {{ $fileSize }}
                                </span>

                            </div>

                            <div class="resource-actions">

                                @if($previewable)

                                    <button
                                        type="button"
                                        class="resource-btn"
                                        data-preview-url="{{ $fileUrl }}"
                                        data-preview-extension="{{ $extension }}"
                                        data-preview-name="{{ $resource->file_name }}">

                                        <i class="bx bx-show"></i>
                                        <span>Open</span>
                                    </button>

                                @endif

                                <a
                                    href="{{ $fileUrl }}"
                                    class="resource-btn download"
                                    download="{{ $resource->file_name }}">

                                    <i class="bx bx-download"></i>
                                    <span>Download</span>

                                </a>

                            </div>

                        </div>

                    @empty

                        <div class="material-empty">
                            <i class="bx bx-file-blank"></i>
                            No resources attached to this material.
                        </div>

                    @endforelse

                </div>

            </section>

        </main>

        {{-- SIDEBAR --}}
        <aside class="material-sidebar">

            {{-- INFORMATION --}}
            <section class="material-card">

                <div class="material-card-header">
                    <h3>
                        <i class="bx bx-info-circle"></i>
                        Information
                    </h3>
                </div>

                <div class="info-list">

                    <div class="info-item">

                        <div class="info-icon">
                            <i class="bx bx-calendar"></i>
                        </div>

                        <div class="info-content">
                            <span>Posted Date</span>
                            <strong>
                                {{ $material->created_at->format('M d, Y') }}
                            </strong>
                        </div>

                    </div>

                    <div class="info-item">

                        <div class="info-icon">
                            <i class="bx bx-time"></i>
                        </div>

                        <div class="info-content">
                            <span>Posted Time</span>
                            <strong>
                                {{ $material->created_at->format('h:i A') }}
                            </strong>
                        </div>

                    </div>

                </div>

            </section>

            {{-- ACTIONS --}}
            <section class="material-card">

                <div class="material-card-header">
                    <h3>
                        <i class="bx bx-slider-alt"></i>
                        Actions
                    </h3>
                </div>

                <a
                    href="{{ route(
                        'professor.class-groups.materials.edit',
                        [
                            'classGroup' => $classGroup->id,
                            'material' => $material->id,
                            'return_to' => 'show',
                            'origin' => $returnTo,
                        ]
                    ) }}"
                    class="edit-material-btn">

                    <i class="bx bx-edit"></i>
                    Edit Material

                </a>

            </section>

        </aside>

    </div>

</div>

{{-- PREVIEW MODAL --}}
<div
    class="material-modal"
    id="materialPreviewModal"
    aria-hidden="true">

    <div
        class="material-modal-overlay"
        id="materialPreviewOverlay">
    </div>

    <div class="material-modal-container">

        <div class="material-modal-header">

            <div class="material-modal-title">

                <i class="bx bx-file" id="materialPreviewIcon"></i>

                <span id="materialPreviewTitle">
                    {{ $material->title }}
                </span>

            </div>

            <div class="material-modal-actions">

                <button
                    type="button"
                    class="modal-icon-btn"
                    id="materialFullscreenBtn"
                    title="Full Screen"
                    aria-label="Full Screen">

                    <i class="bx bx-fullscreen"></i>

                </button>

                <button
                    type="button"
                    class="modal-icon-btn close"
                    id="closeMaterialBtn"
                    title="Close"
                    aria-label="Close">

                    <i class="bx bx-x"></i>

                </button>

            </div>

        </div>

        <div
            class="material-modal-body"
            id="materialPreviewBody">
        </div>

    </div>

</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {

        const modal = document.getElementById('materialPreviewModal');
        const overlay = document.getElementById('materialPreviewOverlay');
        const closeBtn = document.getElementById('closeMaterialBtn');
        const fullscreenBtn = document.getElementById('materialFullscreenBtn');
        const previewBody = document.getElementById('materialPreviewBody');
        const previewTitle = document.getElementById('materialPreviewTitle');
        const previewIcon = document.getElementById('materialPreviewIcon');

        if (
            !modal ||
            !overlay ||
            !closeBtn ||
            !fullscreenBtn ||
            !previewBody
        ) {
            return;
        }

        function updateFullscreenIcon() {

            const icon = fullscreenBtn.querySelector('i');

            if (modal.classList.contains('fullscreen')) {

                icon.className = 'bx bx-exit-fullscreen';

                fullscreenBtn.setAttribute(
                    'aria-label',
                    'Exit Full Screen'
                );

                fullscreenBtn.setAttribute(
                    'title',
                    'Exit Full Screen'
                );

            } else {

                icon.className = 'bx bx-fullscreen';

                fullscreenBtn.setAttribute(
                    'aria-label',
                    'Full Screen'
                );

                fullscreenBtn.setAttribute(
                    'title',
                    'Full Screen'
                );

            }
        }

        function openPreview(fileUrl, extension, fileName) {

            previewBody.innerHTML = '';
            previewTitle.textContent = fileName;

            extension = extension.toLowerCase();

            if (extension === 'pdf') {

                previewIcon.className = 'bx bxs-file-pdf';

                const iframe = document.createElement('iframe');

                iframe.src = fileUrl;
                iframe.title = fileName;
                iframe.className = 'preview-frame';

                previewBody.appendChild(iframe);

            } else if ([
                'jpg',
                'jpeg',
                'png',
                'gif',
                'webp'
            ].includes(extension)) {

                previewIcon.className = 'bx bx-image';

                const wrapper = document.createElement('div');
                wrapper.className = 'preview-image-wrapper';

                const image = document.createElement('img');

                image.src = fileUrl;
                image.alt = fileName;
                image.className = 'preview-image';

                wrapper.appendChild(image);
                previewBody.appendChild(wrapper);

            } else if ([
                'mp4',
                'webm',
                'mov'
            ].includes(extension)) {

                previewIcon.className = 'bx bx-video';

                const video = document.createElement('video');

                video.src = fileUrl;
                video.controls = true;
                video.className = 'preview-video';

                previewBody.appendChild(video);

            } else if ([
                'mp3',
                'wav',
                'ogg',
                'm4a'
            ].includes(extension)) {

                previewIcon.className = 'bx bx-music';

                const wrapper = document.createElement('div');
                wrapper.className = 'preview-audio-wrapper';

                const audio = document.createElement('audio');

                audio.src = fileUrl;
                audio.controls = true;

                wrapper.appendChild(audio);
                previewBody.appendChild(wrapper);

            } else {

                previewIcon.className = 'bx bx-file';

                const wrapper = document.createElement('div');
                wrapper.className = 'preview-unavailable';

                wrapper.innerHTML = `
                    <i class="bx bx-file"></i>
                    <h3>Preview not available</h3>
                    <p>This file type cannot be previewed in the browser.</p>
                    <a
                        href="${fileUrl}"
                        target="_blank"
                        rel="noopener noreferrer"
                        class="resource-btn">
                        <i class="bx bx-download"></i>
                        Open / Download File
                    </a>
                `;

                previewBody.appendChild(wrapper);
            }

            modal.classList.add('active');
            modal.setAttribute('aria-hidden', 'false');
            document.body.classList.add('modal-open');
        }

        function closePreview() {

            modal.classList.remove('active');
            modal.classList.remove('fullscreen');
            modal.setAttribute('aria-hidden', 'true');

            previewBody.innerHTML = '';
            document.body.classList.remove('modal-open');

            updateFullscreenIcon();
        }

        document
            .querySelectorAll('[data-preview-url]')
            .forEach(function (button) {

                button.addEventListener('click', function () {

                    openPreview(
                        this.dataset.previewUrl,
                        this.dataset.previewExtension,
                        this.dataset.previewName
                    );

                });

            });

        closeBtn.addEventListener('click', closePreview);
        overlay.addEventListener('click', closePreview);

        fullscreenBtn.addEventListener('click', function () {

            modal.classList.toggle('fullscreen');
            updateFullscreenIcon();

        });

        document.addEventListener('keydown', function (event) {

            if (
                event.key === 'Escape' &&
                modal.classList.contains('active')
            ) {

                if (modal.classList.contains('fullscreen')) {

                    modal.classList.remove('fullscreen');
                    updateFullscreenIcon();

                } else {

                    closePreview();

                }

            }

        });

    });
</script>

@endsection