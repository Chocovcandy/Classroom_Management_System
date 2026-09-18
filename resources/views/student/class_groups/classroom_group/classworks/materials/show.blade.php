<style>
/* ============================================================
   STUDENT MATERIAL SHOW PAGE
   Redesigned to match the Professor Material Show style
   ============================================================ */

.classwork-show-page {
    width: 100%;
    max-width: 1280px;
    margin: 0 auto;
    padding: 32px 28px 56px;
    box-sizing: border-box;
}

/* ============================================================
   HEADER
   ============================================================ */

.classwork-show-header {
    margin-bottom: 30px;
}

.classwork-back-btn {
    display: inline-flex;
    align-items: center;
    gap: 9px;

    margin-bottom: 24px;

    color: var(--text-secondary);
    text-decoration: none;

    font-size: 15px;
    font-weight: 650;

    transition: color 0.2s ease, transform 0.2s ease;
}

.classwork-back-btn i {
    font-size: 21px;
}

.classwork-back-btn:hover {
    color: var(--primary-color);
    transform: translateX(-2px);
}

/* ============================================================
   TITLE AREA
   ============================================================ */

.classwork-show-heading {
    display: flex;
    align-items: center;
    gap: 20px;
}

.classwork-show-icon {
    width: 66px;
    height: 66px;

    flex-shrink: 0;

    display: flex;
    align-items: center;
    justify-content: center;

    border-radius: 16px;

    font-size: 31px;
}

.classwork-show-icon.material {
    background: #e0f2fe;
    color: #0284c7;
}

.classwork-show-type {
    display: inline-block;

    margin-bottom: 6px;

    font-size: 13px;
    font-weight: 800;

    letter-spacing: 0.09em;
}

.classwork-show-type.material {
    color: #0284c7;
}

.classwork-show-heading h1 {
    margin: 0;

    color: var(--text-color);

    font-size: 31px;
    font-weight: 750;
    line-height: 1.25;

    word-break: break-word;
}

.classwork-show-topic {
    display: inline-flex;
    align-items: center;
    gap: 7px;

    margin-top: 9px;

    color: var(--text-secondary);

    font-size: 15px;
    font-weight: 550;
}

.classwork-show-topic i {
    font-size: 18px;
}

/* ============================================================
   MAIN GRID
   ============================================================ */

.classwork-show-grid {
    display: grid;
    grid-template-columns: minmax(0, 1fr) 340px;
    gap: 26px;
    align-items: start;
}

.classwork-show-main {
    min-width: 0;
}

.classwork-show-sidebar {
    min-width: 0;

    display: flex;
    flex-direction: column;
    gap: 22px;
}

/* ============================================================
   CARDS
   ============================================================ */

.classwork-detail-card,
.material-resources {
    background: var(--card-color);
    border: 1px solid var(--border-color);
    border-radius: 17px;
    overflow: hidden;
}

.classwork-detail-card {
    margin-bottom: 26px;
}

.classwork-show-sidebar .classwork-detail-card {
    margin-bottom: 0;
}

/* ============================================================
   CARD HEADER
   ============================================================ */

.classwork-detail-card-header {
    display: flex;
    align-items: center;
    gap: 10px;

    min-height: 62px;
    padding: 18px 24px;

    border-bottom: 1px solid var(--border-color);
}

.classwork-detail-card-header h2 {
    margin: 0;

    color: var(--text-color);

    font-size: 19px;
    font-weight: 750;
}

/* ============================================================
   DESCRIPTION
   ============================================================ */

.classwork-description {
    padding: 25px;

    color: var(--text-secondary);

    font-size: 16px;
    line-height: 1.75;

    overflow-wrap: anywhere;
}

.classwork-no-content {
    color: var(--text-muted);
    font-style: italic;
}

/* ============================================================
   RESOURCES
   ============================================================ */

.material-resources {
    margin-top: 26px;
    padding: 22px;
    overflow: visible;
}

.material-resources-header {
    display: flex;
    align-items: center;
    justify-content: space-between;

    margin-bottom: 16px;
}

.material-resources-header h3 {
    display: flex;
    align-items: center;
    gap: 9px;

    margin: 0;

    color: var(--text-color);

    font-size: 19px;
    font-weight: 750;
}

.material-resources-header h3 i {
    color: var(--primary-color);
    font-size: 22px;
}

.material-resources-header > span {
    color: var(--text-secondary);
    font-size: 14px;
    font-weight: 550;
}

/* ============================================================
   RESOURCE ITEM
   ============================================================ */

.material-resource-item {
    display: flex;
    align-items: center;
    gap: 16px;

    padding: 17px 18px;
    margin-bottom: 11px;

    background: var(--card-color);

    border: 1px solid var(--border-color);
    border-radius: 13px;

    transition:
        border-color 0.2s ease,
        box-shadow 0.2s ease,
        transform 0.2s ease;
}

.material-resource-item:last-child {
    margin-bottom: 0;
}

.material-resource-item:hover {
    border-color: rgba(59, 130, 246, 0.35);
    box-shadow: 0 5px 16px rgba(0, 0, 0, 0.06);
    transform: translateY(-1px);
}

/* ============================================================
   RESOURCE ICON
   ============================================================ */

.material-resource-icon {
    width: 50px;
    height: 50px;

    display: flex;
    align-items: center;
    justify-content: center;

    flex-shrink: 0;

    border-radius: 12px;

    background: rgba(59, 130, 246, 0.10);
    color: #3b82f6;
}

.material-resource-icon i {
    font-size: 26px;
}

/* ============================================================
   RESOURCE INFORMATION
   ============================================================ */

.material-resource-info {
    flex: 1;
    min-width: 0;

    display: flex;
    flex-direction: column;
    gap: 5px;
}

.material-resource-info strong {
    overflow: hidden;

    color: var(--text-color);

    font-size: 15px;
    font-weight: 700;

    text-overflow: ellipsis;
    white-space: nowrap;
}

.material-resource-info span {
    color: var(--text-secondary);
    font-size: 13px;
}

/* ============================================================
   RESOURCE ACTIONS
   ============================================================ */

.material-resource-actions {
    display: flex;
    align-items: center;
    gap: 9px;

    flex-shrink: 0;
}

.material-resource-open,
.material-resource-download {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 7px;

    min-height: 40px;
    padding: 0 14px;

    border-radius: 9px;

    font-size: 14px;
    font-weight: 650;

    text-decoration: none;
    cursor: pointer;

    transition:
        background-color 0.2s ease,
        border-color 0.2s ease,
        color 0.2s ease,
        transform 0.2s ease;
}

.material-resource-open {
    border: 1px solid var(--border-color);
    background: var(--card-color);
    color: var(--text-color);
}

.material-resource-open:hover {
    border-color: var(--primary-color);
    color: var(--primary-color);
    transform: translateY(-1px);
}

.material-resource-download {
    border: 1px solid var(--primary-color);
    background: var(--primary-color);
    color: #fff;
}

.material-resource-download:hover {
    opacity: 0.92;
    color: #fff;
    transform: translateY(-1px);
}

.material-resource-open i,
.material-resource-download i {
    font-size: 18px;
}

/* ============================================================
   EMPTY RESOURCES
   ============================================================ */

.material-no-resources {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;

    padding: 42px 24px;

    text-align: center;

    border: 1px dashed var(--border-color);
    border-radius: 12px;

    background: var(--background-color);
}

.material-no-resources i {
    margin-bottom: 11px;

    color: var(--text-muted);
    font-size: 40px;
}

.material-no-resources p {
    margin: 0;

    color: var(--text-secondary);
    font-size: 15px;
}

/* ============================================================
   INFORMATION SIDEBAR
   ============================================================ */

.classwork-info-list {
    display: flex;
    flex-direction: column;
}

.classwork-info-item {
    display: flex;
    align-items: center;
    gap: 15px;

    padding: 19px 23px;

    border-bottom: 1px solid var(--border-color);
}

.classwork-info-item:last-child {
    border-bottom: none;
}

.classwork-info-item > i {
    width: 42px;
    height: 42px;

    display: flex;
    align-items: center;
    justify-content: center;

    flex-shrink: 0;

    border-radius: 11px;

    background: var(--background-color);
    color: var(--primary-color);

    font-size: 21px;
}

.classwork-info-item > div {
    min-width: 0;

    display: flex;
    flex-direction: column;
    gap: 4px;
}

.classwork-info-item span {
    color: var(--text-secondary);

    font-size: 12px;
    font-weight: 700;

    letter-spacing: 0.04em;
    text-transform: uppercase;
}

.classwork-info-item strong {
    color: var(--text-color);

    font-size: 15px;
    font-weight: 700;
}

/* ============================================================
   PREVIEW MODAL
   ============================================================ */

.material-preview-modal {
    position: fixed;
    inset: 0;

    display: none;
    align-items: center;
    justify-content: center;

    width: 100%;
    height: 100%;

    z-index: 9999;
    padding: 22px;
    box-sizing: border-box;
}

.material-preview-modal.active {
    display: flex;
}

.material-preview-overlay {
    position: absolute;
    inset: 0;

    width: 100%;
    height: 100%;

    background: rgba(15, 23, 42, 0.74);
    backdrop-filter: blur(5px);
}

.material-preview-container {
    position: relative;
    z-index: 1;

    width: min(1200px, 100%);
    height: min(850px, calc(100vh - 44px));

    display: flex;
    flex-direction: column;

    overflow: hidden;

    background: var(--card-color);
    border: 1px solid var(--border-color);
    border-radius: 18px;

    box-shadow: 0 25px 80px rgba(0, 0, 0, 0.28);
}

.material-preview-header {
    display: flex;
    align-items: center;
    justify-content: space-between;

    gap: 18px;

    min-height: 68px;
    padding: 14px 20px;

    background: var(--card-color);
    border-bottom: 1px solid var(--border-color);

    flex-shrink: 0;
}

.material-preview-title {
    display: flex;
    align-items: center;

    gap: 11px;
    min-width: 0;

    color: var(--text-color);

    font-size: 16px;
    font-weight: 700;
}

.material-preview-title i {
    color: var(--primary-color);
    font-size: 23px;
    flex-shrink: 0;
}

#materialPreviewTitle {
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
}

.material-preview-actions {
    display: flex;
    align-items: center;
    gap: 7px;
    flex-shrink: 0;
}

.material-preview-btn {
    width: 40px;
    height: 40px;

    display: flex;
    align-items: center;
    justify-content: center;

    padding: 0;

    border: none;
    border-radius: 9px;

    background: transparent;
    color: var(--text-color);

    cursor: pointer;

    font-size: 22px;

    transition:
        background-color 0.2s ease,
        color 0.2s ease,
        transform 0.2s ease;
}

.material-preview-btn:hover {
    background: var(--background-color);
}

.material-preview-btn:active {
    transform: scale(0.95);
}

.material-preview-btn.close:hover {
    background: #fee2e2;
    color: #dc2626;
}

.material-preview-body {
    position: relative;

    flex: 1;
    min-height: 0;

    display: flex;
    align-items: center;
    justify-content: center;

    background: #f1f5f9;

    overflow: hidden;
}

.material-preview-frame {
    width: 100%;
    height: 100%;

    display: block;

    border: none;
    background: #fff;
}

.material-preview-image-wrapper {
    width: 100%;
    height: 100%;

    display: flex;
    align-items: center;
    justify-content: center;

    padding: 32px;

    overflow: auto;
    box-sizing: border-box;
}

.material-preview-image {
    display: block;

    max-width: 100%;
    max-height: 100%;

    width: auto;
    height: auto;

    object-fit: contain;

    border-radius: 9px;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
}

.material-preview-video {
    display: block;

    width: 100%;
    height: 100%;

    max-width: 1200px;
    max-height: 100%;

    object-fit: contain;
    background: #000;
}

.material-preview-audio-wrapper {
    width: min(680px, 90%);

    padding: 42px;

    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;

    gap: 26px;

    background: #fff;

    border: 1px solid #e5e7eb;
    border-radius: 17px;

    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
}

.material-preview-audio-wrapper::before {
    content: "♪";

    width: 86px;
    height: 86px;

    display: flex;
    align-items: center;
    justify-content: center;

    border-radius: 50%;

    background: #f3f4f6;

    font-size: 43px;
}

.material-preview-audio-wrapper audio {
    width: 100%;
}

.material-preview-unavailable {
    width: min(520px, 90%);

    padding: 48px 38px;

    text-align: center;

    background: #fff;

    border: 1px solid #e5e7eb;
    border-radius: 17px;

    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.06);
}

.material-preview-unavailable > i {
    margin-bottom: 16px;

    color: #6b7280;
    font-size: 60px;
}

.material-preview-unavailable h3 {
    margin: 0 0 9px;

    color: #1f2937;

    font-size: 20px;
    font-weight: 700;
}

.material-preview-unavailable p {
    margin: 0 0 26px;

    color: #6b7280;

    font-size: 15px;
    line-height: 1.6;
}

.material-preview-download {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 8px;

    padding: 11px 19px;

    border-radius: 9px;

    background: var(--primary-color);
    color: #fff;

    text-decoration: none;

    font-size: 14px;
    font-weight: 700;
}

.material-preview-download:hover {
    opacity: 0.9;
    color: #fff;
}

/* ============================================================
   FULLSCREEN
   ============================================================ */

.material-preview-modal.fullscreen {
    padding: 0;
}

.material-preview-modal.fullscreen .material-preview-overlay {
    background: #000;
}

.material-preview-modal.fullscreen .material-preview-container {
    width: 100vw;
    height: 100vh;

    max-width: none;
    max-height: none;

    border-radius: 0;
    border: none;
}

/* ============================================================
   BODY LOCK
   ============================================================ */

body.modal-open {
    overflow: hidden;
}

/* ============================================================
   RESPONSIVE
   ============================================================ */

@media (max-width: 1000px) {
    .classwork-show-grid {
        grid-template-columns: 1fr;
    }

    .classwork-show-sidebar {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 22px;
    }
}

@media (max-width: 700px) {
    .classwork-show-page {
        padding: 24px 18px 45px;
    }

    .classwork-show-heading {
        align-items: flex-start;
        gap: 15px;
    }

    .classwork-show-icon {
        width: 58px;
        height: 58px;
        border-radius: 14px;
        font-size: 27px;
    }

    .classwork-show-heading h1 {
        font-size: 26px;
    }

    .classwork-show-topic {
        font-size: 14px;
    }

    .classwork-show-sidebar {
        display: flex;
        flex-direction: column;
        gap: 20px;
    }

    .material-resource-item {
        align-items: flex-start;
        flex-wrap: wrap;
    }

    .material-resource-actions {
        width: 100%;
        margin-left: 66px;
    }

    .material-resource-open,
    .material-resource-download {
        flex: 1;
    }

    .material-preview-container {
        width: 96vw;
        height: 92vh;
        border-radius: 13px;
    }

    .material-preview-header {
        min-height: 58px;
        padding: 10px 13px;
    }

    .material-preview-title {
        font-size: 14px;
    }

    .material-preview-btn {
        width: 36px;
        height: 36px;
    }

    .material-preview-image-wrapper {
        padding: 16px;
    }
}

@media (max-width: 500px) {
    .classwork-show-page {
        padding: 20px 14px 38px;
    }

    .classwork-back-btn {
        margin-bottom: 20px;
        font-size: 14px;
    }

    .classwork-show-heading {
        gap: 12px;
    }

    .classwork-show-icon {
        width: 50px;
        height: 50px;
        border-radius: 12px;
        font-size: 23px;
    }

    .classwork-show-type {
        font-size: 11px;
    }

    .classwork-show-heading h1 {
        font-size: 22px;
    }

    .classwork-show-topic {
        margin-top: 7px;
        font-size: 13px;
    }

    .classwork-detail-card-header {
        min-height: 56px;
        padding: 15px 17px;
    }

    .classwork-detail-card-header h2 {
        font-size: 17px;
    }

    .classwork-description {
        padding: 18px;
        font-size: 14px;
    }

    .material-resources {
        padding: 17px;
    }

    .material-resources-header h3 {
        font-size: 17px;
    }

    .material-resources-header > span {
        font-size: 12px;
    }

    .material-resource-item {
        padding: 14px;
        gap: 12px;
    }

    .material-resource-icon {
        width: 44px;
        height: 44px;
    }

    .material-resource-icon i {
        font-size: 23px;
    }

    .material-resource-info strong {
        font-size: 14px;
    }

    .material-resource-info span {
        font-size: 12px;
    }

    .material-resource-actions {
        margin-left: 56px;
        gap: 7px;
    }

    .material-resource-open,
    .material-resource-download {
        min-height: 38px;
        padding: 0 10px;
        font-size: 12px;
    }

    .classwork-info-item {
        padding: 16px 18px;
    }

    .material-preview-modal {
        padding: 0;
    }

    .material-preview-container {
        width: 100vw;
        height: 100vh;
        border-radius: 0;
    }

    .material-preview-title {
        max-width: 65%;
    }

    .material-preview-actions {
        gap: 3px;
    }

    .material-preview-btn {
        width: 34px;
        height: 34px;
        font-size: 20px;
    }

    .material-preview-audio-wrapper {
        padding: 25px 18px;
    }

    .material-preview-unavailable {
        padding: 35px 20px;
    }
}

/* ============================================================
   DARK MODE
   ============================================================ */

[data-theme="dark"] .classwork-show-icon.material {
    background-color: rgba(2, 132, 199, 0.15);
    color: #38bdf8;
}

[data-theme="dark"] .classwork-show-type.material {
    color: #38bdf8;
}

[data-theme="dark"] .material-resource-icon {
    background: rgba(59, 130, 246, 0.14);
    color: #7fa3ff;
}

[data-theme="dark"] .material-resource-item {
    background: var(--card-color);
}

[data-theme="dark"] .material-preview-audio-wrapper,
[data-theme="dark"] .material-preview-unavailable {
    background: var(--card-color);
    border-color: var(--border-color);
}

[data-theme="dark"] .material-preview-unavailable h3 {
    color: var(--text-color);
}

[data-theme="dark"] .material-preview-unavailable p {
    color: var(--text-secondary);
}
</style>
@extends('layouts.student_layout')

@php
use Illuminate\Support\Facades\Storage;
@endphp

@section('content')

<div class="classwork-show-page">

    {{-- ============================================================
        HEADER
    ============================================================ --}}
<div class="classwork-show-header">

    <a
        href="{{ $returnTo === 'classwork'
                ? route(
                    'student.class-groups.classroom-group.classwork',
                    ['classGroup' => $classGroup->id]
                )
                : route(
                    'student.class-groups.classroom-group',
                    ['classGroup' => $classGroup->id]
                )
            }}"
        class="classwork-back-btn">
            <i class="bx bx-arrow-back"></i>

            {{ $returnTo === 'classwork'
                    ? 'Back to Classwork'
                    : 'Back to Stream'
                }}

        </a>


        <div class="classwork-show-heading">

            <div class="classwork-show-icon material">
                <i class="bx bx-book-open"></i>
            </div>

            <div>

                <span class="classwork-show-type material">
                    MATERIAL
                </span>

                <h1>
                    {{ $material->title }}
                </h1>

                @if($material->topic)

                    <div class="classwork-show-topic">

                        <i class="bx bx-folder"></i>

                        {{ $material->topic->topic_name }}

                    </div>

                @endif

            </div>

        </div>

    </div>


    {{-- ============================================================
        CONTENT
    ============================================================ --}}

    <div class="classwork-show-grid">

        {{-- ========================================================
            MAIN CONTENT
        ======================================================== --}}

        <div class="classwork-show-main">

            {{-- DESCRIPTION --}}

            <section class="classwork-detail-card">

                <div class="classwork-detail-card-header">

                    <h2>
                        Description
                    </h2>

                </div>

                <div class="classwork-description">

                    @if($material->description)

                        {!! nl2br(e($material->description)) !!}

                    @else

                        <span class="classwork-no-content">
                            No description provided.
                        </span>

                    @endif

                </div>

            </section>


            {{-- ====================================================
                ATTACHED RESOURCES
            ==================================================== --}}

            <div class="material-resources">

                <div class="material-resources-header">

                    <h3>
                        <i class="bx bx-paperclip"></i>
                        Attached Resources
                    </h3>

                    <span>

                        {{ $material->resources->count() }}

                        {{ $material->resources->count() === 1
                            ? 'file'
                            : 'files'
                        }}

                    </span>

                </div>


                @forelse($material->resources as $resource)

                    @php

                        $extension = strtolower(
                            pathinfo(
                                $resource->file_name,
                                PATHINFO_EXTENSION
                            )
                        );

                        $fileUrl = Storage::disk('public')->url(
                            $resource->file_path
                        );

                        $fileSize = $resource->file_size
                            ? number_format(
                                $resource->file_size / 1024 / 1024,
                                2
                            ) . ' MB'
                            : 'Unknown size';

                    @endphp


                    <div class="material-resource-item">

                        {{-- =================================================
                            FILE ICON
                        ================================================== --}}

                        <div class="material-resource-icon">

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

                            @elseif(in_array($extension, [
                                'doc',
                                'docx'
                            ]))

                                <i class="bx bxs-file-doc"></i>

                            @elseif(in_array($extension, [
                                'xls',
                                'xlsx',
                                'csv'
                            ]))

                                <i class="bx bxs-file"></i>

                            @elseif(in_array($extension, [
                                'ppt',
                                'pptx'
                            ]))

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


                        {{-- =================================================
                            FILE INFORMATION
                        ================================================== --}}

                        <div class="material-resource-info">

                            <strong>
                                {{ $resource->file_name }}
                            </strong>

                            <span>

                                {{ strtoupper($extension) }}

                                ·

                                {{ $fileSize }}

                            </span>

                        </div>


                        {{-- =================================================
                            ACTIONS
                        ================================================== --}}

                        <div class="material-resource-actions">

                            {{-- OPEN / PREVIEW --}}

                            @if(in_array($extension, [
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
                            ]))

                                <button
                                    type="button"
                                    class="material-resource-open"
                                    onclick="openResourcePreview(
                                        '{{ $fileUrl }}',
                                        '{{ $extension }}',
                                        '{{ addslashes($resource->file_name) }}'
                                    )">

                                    <i class="bx bx-show"></i>

                                    Open

                                </button>

                            @endif


                            {{-- DOWNLOAD --}}

                            <a
                                href="{{ route(
                                    'student.class-groups.materials.download',
                                    [
                                        'classGroup' => $classGroup->id,
                                        'material' => $material->id,
                                        'resource' => $resource->id,
                                    ]
                                ) }}"
                                class="material-resource-download">

                                <i class="bx bx-download"></i>

                                Download

                            </a>

                        </div>

                    </div>


                @empty

                    <div class="material-no-resources">

                        <i class="bx bx-file-blank"></i>

                        <p>
                            No resources attached to this material.
                        </p>

                    </div>

                @endforelse

            </div>

        </div>


        {{-- ========================================================
            SIDEBAR
        ======================================================== --}}

        <aside class="classwork-show-sidebar">

            <section class="classwork-detail-card">

                <div class="classwork-detail-card-header">

                    <h2>
                        Information
                    </h2>

                </div>


                <div class="classwork-info-list">

                    <div class="classwork-info-item">

                        <i class="bx bx-calendar"></i>

                        <div>

                            <span>
                                Posted
                            </span>

                            <strong>
                                {{ $material->created_at->format('M d, Y') }}
                            </strong>

                        </div>

                    </div>


                    <div class="classwork-info-item">

                        <i class="bx bx-time"></i>

                        <div>

                            <span>
                                Time
                            </span>

                            <strong>
                                {{ $material->created_at->format('h:i A') }}
                            </strong>

                        </div>

                    </div>

                </div>

            </section>

        </aside>

    </div>


    {{-- ============================================================
        MATERIAL PREVIEW MODAL
    ============================================================ --}}

    <div
        class="material-preview-modal"
        id="materialPreviewModal"
        aria-hidden="true">

        {{-- OVERLAY --}}

        <div
            class="material-preview-overlay"
            id="materialPreviewOverlay">
        </div>


        {{-- MODAL CONTAINER --}}

        <div class="material-preview-container">

            <div class="material-preview-header">

                <div class="material-preview-title">

                    <i
                        class="bx bx-file"
                        id="materialPreviewIcon">
                    </i>

                    <span id="materialPreviewTitle">
                        {{ $material->title }}
                    </span>

                </div>


                <div class="material-preview-actions">

                    {{-- FULL SCREEN --}}

                    <button
                        type="button"
                        class="material-preview-btn"
                        id="materialFullscreenBtn"
                        title="Full Screen"
                        aria-label="Full Screen">

                        <i class="bx bx-fullscreen"></i>

                    </button>


                    {{-- CLOSE --}}

                    <button
                        type="button"
                        class="material-preview-btn close"
                        id="closeMaterialBtn"
                        title="Close"
                        aria-label="Close">

                        <i class="bx bx-x"></i>

                    </button>

                </div>

            </div>


            {{-- FILE PREVIEW --}}

            <div
                class="material-preview-body"
                id="materialPreviewBody">
            </div>

        </div>

    </div>

</div>

@endsection


<script>

document.addEventListener('DOMContentLoaded', function () {

    const modal =
        document.getElementById('materialPreviewModal');

    const closeBtn =
        document.getElementById('closeMaterialBtn');

    const overlay =
        document.getElementById('materialPreviewOverlay');

    const fullscreenBtn =
        document.getElementById('materialFullscreenBtn');

    const previewBody =
        document.getElementById('materialPreviewBody');

    const previewTitle =
        document.getElementById('materialPreviewTitle');

    const previewIcon =
        document.getElementById('materialPreviewIcon');


    /*
    |--------------------------------------------------------------------------
    | SAFETY CHECK
    |--------------------------------------------------------------------------
    */

    if (
        !modal ||
        !closeBtn ||
        !overlay ||
        !fullscreenBtn ||
        !previewBody
    ) {
        return;
    }


    /*
    |--------------------------------------------------------------------------
    | OPEN RESOURCE
    |--------------------------------------------------------------------------
    */

    window.openResourcePreview = function (
        fileUrl,
        extension,
        fileName
    ) {

        previewTitle.textContent = fileName;

        previewBody.innerHTML = '';

        extension = extension.toLowerCase();


        /*
        |--------------------------------------------------------------------------
        | PDF
        |--------------------------------------------------------------------------
        */

        if (extension === 'pdf') {

            previewIcon.className =
                'bx bxs-file-pdf';


            const iframe =
                document.createElement('iframe');

            iframe.src = fileUrl;

            iframe.title = fileName;

            iframe.className =
                'material-preview-frame';

            previewBody.appendChild(iframe);

        }


        /*
        |--------------------------------------------------------------------------
        | IMAGES
        |--------------------------------------------------------------------------
        */

        else if ([
            'jpg',
            'jpeg',
            'png',
            'gif',
            'webp'
        ].includes(extension)) {

            previewIcon.className =
                'bx bx-image';


            const wrapper =
                document.createElement('div');

            wrapper.className =
                'material-preview-image-wrapper';


            const image =
                document.createElement('img');

            image.src = fileUrl;

            image.alt = fileName;

            image.className =
                'material-preview-image';


            wrapper.appendChild(image);

            previewBody.appendChild(wrapper);

        }


        /*
        |--------------------------------------------------------------------------
        | VIDEO
        |--------------------------------------------------------------------------
        */

        else if ([
            'mp4',
            'webm',
            'mov'
        ].includes(extension)) {

            previewIcon.className =
                'bx bx-video';


            const video =
                document.createElement('video');

            video.src = fileUrl;

            video.controls = true;

            video.autoplay = false;

            video.className =
                'material-preview-video';


            previewBody.appendChild(video);

        }


        /*
        |--------------------------------------------------------------------------
        | AUDIO
        |--------------------------------------------------------------------------
        */

        else if ([
            'mp3',
            'wav',
            'ogg',
            'm4a'
        ].includes(extension)) {

            previewIcon.className =
                'bx bx-music';


            const wrapper =
                document.createElement('div');

            wrapper.className =
                'material-preview-audio-wrapper';


            const audio =
                document.createElement('audio');

            audio.src = fileUrl;

            audio.controls = true;


            wrapper.appendChild(audio);

            previewBody.appendChild(wrapper);

        }


        /*
        |--------------------------------------------------------------------------
        | UNSUPPORTED FILE
        |--------------------------------------------------------------------------
        */

        else {

            previewIcon.className =
                'bx bx-file';


            previewBody.innerHTML = `

                <div class="material-preview-unavailable">

                    <i class="bx bx-file"></i>

                    <h3>
                        Preview not available
                    </h3>

                    <p>
                        This file type cannot be previewed
                        in the browser.
                    </p>

                    <a
                        href="${fileUrl}"
                        target="_blank"
                        rel="noopener noreferrer"
                        class="material-preview-download">

                        <i class="bx bx-download"></i>

                        Open / Download File

                    </a>

                </div>

            `;

        }


        /*
        |--------------------------------------------------------------------------
        | SHOW MODAL
        |--------------------------------------------------------------------------
        */

        modal.classList.add('active');

        modal.setAttribute(
            'aria-hidden',
            'false'
        );

        document.body.classList.add(
            'modal-open'
        );

    };


    /*
    |--------------------------------------------------------------------------
    | CLOSE MODAL
    |--------------------------------------------------------------------------
    */

    function closeMaterialModal() {

        modal.classList.remove('active');

        modal.classList.remove('fullscreen');

        modal.setAttribute(
            'aria-hidden',
            'true'
        );

        document.body.classList.remove(
            'modal-open'
        );


        // Stop video/audio when closing

        previewBody.innerHTML = '';

        updateFullscreenIcon();

    }


    /*
    |--------------------------------------------------------------------------
    | FULL SCREEN
    |--------------------------------------------------------------------------
    */

    function toggleFullscreen() {

        modal.classList.toggle(
            'fullscreen'
        );

        updateFullscreenIcon();

    }


    /*
    |--------------------------------------------------------------------------
    | FULLSCREEN ICON
    |--------------------------------------------------------------------------
    */

    function updateFullscreenIcon() {

        const icon =
            fullscreenBtn.querySelector('i');


        if (
            modal.classList.contains(
                'fullscreen'
            )
        ) {

            icon.className =
                'bx bx-exit-fullscreen';

            fullscreenBtn.setAttribute(
                'title',
                'Exit Full Screen'
            );

            fullscreenBtn.setAttribute(
                'aria-label',
                'Exit Full Screen'
            );

        } else {

            icon.className =
                'bx bx-fullscreen';

            fullscreenBtn.setAttribute(
                'title',
                'Full Screen'
            );

            fullscreenBtn.setAttribute(
                'aria-label',
                'Full Screen'
            );

        }

    }


    /*
    |--------------------------------------------------------------------------
    | BUTTON EVENTS
    |--------------------------------------------------------------------------
    */

    closeBtn.addEventListener(
        'click',
        closeMaterialModal
    );


    overlay.addEventListener(
        'click',
        closeMaterialModal
    );


    fullscreenBtn.addEventListener(
        'click',
        toggleFullscreen
    );


    /*
    |--------------------------------------------------------------------------
    | ESC KEY
    |--------------------------------------------------------------------------
    */

    document.addEventListener(
        'keydown',
        function (event) {

            if (
                event.key === 'Escape' &&
                modal.classList.contains('active')
            ) {

                if (
                    modal.classList.contains(
                        'fullscreen'
                    )
                ) {

                    modal.classList.remove(
                        'fullscreen'
                    );

                    updateFullscreenIcon();

                } else {

                    closeMaterialModal();

                }

            }

        }
    );

});

</script>