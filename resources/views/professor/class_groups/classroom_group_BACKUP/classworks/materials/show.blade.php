@extends('layouts.prof_layout')

@section('content')

<div class="classwork-show-page">

    {{-- ============================================================
        HEADER
    ============================================================ --}}

    <div class="classwork-show-header">

        <a
            href="{{ route(
                'professor.class-groups.classroom-group.classwork',
                $classGroup
            ) }}"
            class="classwork-back-btn"
        >
            <i class="bx bx-arrow-back"></i>
            Back to Classwork
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

        {{-- MAIN CONTENT --}}
        <div class="classwork-show-main">

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


            {{-- ATTACHMENT INFORMATION --}}

            <section class="classwork-detail-card">

                <div class="classwork-detail-card-header">

                    <h2>
                        Attached Material
                    </h2>

                </div>

                <div class="classwork-file">

                    <div class="classwork-file-icon">
                        <i class="bx bx-file"></i>
                    </div>

                    <div class="classwork-file-info">

                        <strong>
                            {{ basename($material->file_path) }}
                        </strong>

                        <span>
                            Material attachment
                        </span>

                    </div>

                </div>

            </section>

        </div>


        {{-- SIDEBAR --}}
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
                            <span>Posted</span>

                            <strong>
                                {{ $material->created_at->format('M d, Y') }}
                            </strong>
                        </div>

                    </div>

                    <div class="classwork-info-item">

                        <i class="bx bx-time"></i>

                        <div>
                            <span>Time</span>

                            <strong>
                                {{ $material->created_at->format('h:i A') }}
                            </strong>
                        </div>

                    </div>

                </div>

            </section>


            {{-- ACTIONS --}}

            <section class="classwork-detail-card">

                <div class="classwork-detail-card-header">
                    <h2>
                        Actions
                    </h2>
                </div>

                <a
                    href="{{ route(
                        'professor.class-groups.materials.edit',
                        [
                            'classGroup' => $classGroup->id,
                            'material' => $material->id
                        ]
                    ) }}"
                    class="classwork-action-btn"
                >
                    <i class="bx bx-edit"></i>
                    Edit Material
                </a>

            </section>

        </aside>

    </div>

</div>

@endsection