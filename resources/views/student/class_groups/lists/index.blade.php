<style>
    /* ============================================================
   STUDENT CLASS GROUPS PAGE
   ============================================================ */

    .cg-page {
        width: 100%;
        box-sizing: border-box;
    }


    /* ============================================================
   PAGE HEADER
   ============================================================ */

    .cg-header {
        display: flex;
        align-items: flex-end;
        justify-content: space-between;
        gap: 30px;

        width: 100%;
        margin-bottom: 28px;
    }

    .cg-header-text {
        min-width: 0;
    }

    .cg-eyebrow {
        display: inline-block;

        margin-bottom: 7px;

        font-size: 12px;
        font-weight: 700;
        letter-spacing: 1.2px;
        text-transform: uppercase;

        color: var(--primary-color);
    }

    .cg-header h1 {
        margin: 0;

        font-size: 30px;
        font-weight: 700;
        line-height: 1.2;

        color: var(--text-color);
    }

    .cg-header p {
        margin: 8px 0 0;

        font-size: 14px;
        line-height: 1.6;

        color: var(--muted-text-color);
    }


    /* ============================================================
   JOIN CLASS BUTTON
   ============================================================ */

    .cg-join-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;

        flex-shrink: 0;

        padding: 11px 17px;

        border: 1px solid var(--primary-color);
        border-radius: 10px;

        background-color: var(--primary-color);
        color: #ffffff;

        font-family: inherit;
        font-size: 13px;
        font-weight: 600;

        cursor: pointer;

        transition:
            background-color 0.2s ease,
            border-color 0.2s ease,
            transform 0.2s ease,
            box-shadow 0.2s ease;
    }

    .cg-join-btn i {
        font-size: 17px;
    }

    .cg-join-btn:hover {
        transform: translateY(-1px);

        box-shadow: 0 6px 16px var(--shadow-color);
    }

    .cg-join-btn:active {
        transform: translateY(0);
    }


    /* ============================================================
   SUMMARY
   ============================================================ */

    .cg-summary {
        display: flex;

        margin-bottom: 22px;
    }

    .cg-summary-card {
        display: flex;
        align-items: center;
        gap: 12px;

        min-width: 150px;

        padding: 12px 16px;

        background-color: var(--card-color);
        border: 1px solid var(--border-color);
        border-radius: 12px;

        box-shadow: 0 4px 14px var(--shadow-color);
    }

    .cg-summary-icon {
        display: flex;
        align-items: center;
        justify-content: center;

        width: 38px;
        height: 38px;

        flex-shrink: 0;

        background-color: var(--primary-soft);
        color: var(--primary-color);

        border-radius: 9px;

        font-size: 18px;
    }

    .cg-summary-card>div:last-child {
        display: flex;
        flex-direction: column;
        gap: 2px;
    }

    .cg-summary-card strong {
        font-size: 18px;
        font-weight: 700;

        color: var(--text-color);
    }

    .cg-summary-card span {
        font-size: 11px;
        font-weight: 500;

        color: var(--muted-text-color);
    }


    /* ============================================================
   CLASS GROUP GRID
   ============================================================ */

    .cg-grid {
        display: grid;

        grid-template-columns: repeat(auto-fill,
                minmax(300px, 1fr));

        gap: 20px;

        width: 100%;
    }


    /* ============================================================
   CLASS GROUP CARD
   ============================================================ */

    .cg-card {
        position: relative;

        display: flex;
        flex-direction: column;

        min-width: 0;
        min-height: 340px;

        padding: 20px;

        box-sizing: border-box;

        background-color: var(--card-color);

        border: 1px solid var(--border-color);
        border-radius: 15px;

        box-shadow: 0 5px 18px var(--shadow-color);

        overflow: hidden;

        transition:
            transform 0.2s ease,
            box-shadow 0.2s ease,
            border-color 0.2s ease;
    }


    /* TOP ACCENT */

    .cg-card::before {
        content: "";

        position: absolute;

        top: 0;
        left: 0;

        width: 100%;
        height: 4px;

        background: linear-gradient(90deg,
                var(--primary-color),
                var(--secondary-color));
    }

    .cg-card:hover {
        transform: translateY(-3px);

        box-shadow: 0 10px 25px var(--shadow-color);
    }


    /* ============================================================
   CARD TOP
   ============================================================ */

    .cg-card-top {
        display: flex;
        align-items: center;
        justify-content: space-between;

        gap: 10px;

        margin-bottom: 16px;
    }


    /* ============================================================
   COURSE CODE
   ============================================================ */

    .cg-code-tag {
        display: inline-flex;
        align-items: center;

        padding: 5px 9px;

        background-color: var(--primary-soft);
        color: var(--primary-color);

        border-radius: 7px;

        font-size: 11px;
        font-weight: 700;
        letter-spacing: 0.4px;
    }


    /* ============================================================
   STATUS
   ============================================================ */

    .cg-status {
        display: inline-flex;
        align-items: center;
        gap: 6px;

        font-size: 11px;
        font-weight: 600;
    }

    .cg-status i {
        display: block;

        width: 6px;
        height: 6px;

        border-radius: 50%;
    }

    .cg-status-active {
        color: var(--success-color);
    }

    .cg-status-active i {
        background-color: var(--success-color);
    }

    .cg-status-inactive {
        color: var(--muted-text-color);
    }

    .cg-status-inactive i {
        background-color: var(--muted-text-color);
    }


    /* ============================================================
   CARD TITLE
   ============================================================ */

    .cg-card-title {
        margin: 0;

        font-size: 20px;
        font-weight: 700;
        line-height: 1.35;

        color: var(--text-color);
    }


    /* ============================================================
   COURSE NAME
   ============================================================ */

    .cg-card-subtitle {
        margin: 5px 0 0;

        font-size: 13px;
        font-weight: 500;

        color: var(--primary-color);
    }


    /* ============================================================
   DESCRIPTION
   ============================================================ */

    .cg-card-desc {
        margin: 12px 0 0;

        min-height: 42px;

        font-size: 13px;
        line-height: 1.6;

        color: var(--muted-text-color);

        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;

        overflow: hidden;
    }


    /* ============================================================
   DIVIDER
   ============================================================ */

    .cg-card-divider {
        width: 100%;
        height: 1px;

        margin: 18px 0;

        background-color: var(--border-color);
    }


    /* ============================================================
   CARD STATS
   ============================================================ */

    .cg-card-stats {
        display: grid;

        grid-template-columns: 1fr 1fr;

        gap: 12px;

        margin-bottom: 18px;
    }

    .cg-mini-stat {
        display: flex;
        align-items: center;

        gap: 9px;

        min-width: 0;
    }

    .cg-mini-stat-icon {
        display: flex;
        align-items: center;
        justify-content: center;

        width: 32px;
        height: 32px;

        flex-shrink: 0;

        background-color: var(--primary-soft);
        color: var(--primary-color);

        border-radius: 8px;

        font-size: 15px;
    }

    .cg-mini-stat>div {
        display: flex;
        flex-direction: column;

        min-width: 0;
    }

    .cg-mini-stat strong {
        max-width: 100%;

        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;

        font-size: 12px;
        font-weight: 600;

        color: var(--text-color);
    }

    .cg-mini-stat span {
        margin-top: 2px;

        font-size: 10px;

        color: var(--muted-text-color);
    }

    .cg-mini-stat .cg-code {
        font-size: 11px;
        letter-spacing: 0.3px;
    }


    /* ============================================================
   OPEN CLASSROOM BUTTON
   ============================================================ */

    .cg-open-btn {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 7px;

        width: 100%;

        margin-top: auto;

        padding: 10px 14px;

        box-sizing: border-box;

        background-color: var(--primary-soft);
        color: var(--primary-color);

        border: 1px solid var(--primary-border);
        border-radius: 9px;

        font-size: 12px;
        font-weight: 600;

        text-decoration: none;

        transition:
            background-color 0.2s ease,
            color 0.2s ease,
            transform 0.2s ease;
    }

    .cg-open-btn i {
        font-size: 17px;

        transition: transform 0.2s ease;
    }

    .cg-open-btn:hover {
        background-color: var(--primary-color);
        color: #ffffff;
    }

    .cg-open-btn:hover i {
        transform: translateX(3px);
    }


    /* ============================================================
   EMPTY STATE
   ============================================================ */

    .cg-empty {
        grid-column: 1 / -1;

        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;

        min-height: 300px;

        padding: 40px 20px;

        text-align: center;

        background-color: var(--card-color);

        border: 1px dashed var(--border-color);
        border-radius: 15px;
    }

    .cg-empty-icon {
        display: flex;
        align-items: center;
        justify-content: center;

        width: 64px;
        height: 64px;

        margin-bottom: 15px;

        background-color: var(--primary-soft);
        color: var(--primary-color);

        border-radius: 15px;

        font-size: 28px;
    }

    .cg-empty h2 {
        margin: 0;

        font-size: 19px;
        font-weight: 700;

        color: var(--text-color);
    }

    .cg-empty p {
        max-width: 400px;

        margin: 8px 0 18px;

        font-size: 13px;
        line-height: 1.6;

        color: var(--muted-text-color);
    }

    .cg-empty-join-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 7px;

        padding: 10px 15px;

        background-color: var(--primary-color);
        color: #ffffff;

        border: 1px solid var(--primary-color);
        border-radius: 9px;

        font-family: inherit;
        font-size: 12px;
        font-weight: 600;

        cursor: pointer;

        transition:
            transform 0.2s ease,
            box-shadow 0.2s ease;
    }

    .cg-empty-join-btn:hover {
        transform: translateY(-1px);

        box-shadow: 0 6px 15px var(--shadow-color);
    }


    /* ============================================================
   JOIN CLASS MODAL
   ============================================================ */

    .join-modal-overlay {
        position: fixed;

        inset: 0;

        z-index: 1000;

        display: flex;
        align-items: center;
        justify-content: center;

        padding: 20px;

        box-sizing: border-box;

        background-color: rgba(0, 0, 0, 0.45);

        opacity: 0;
        visibility: hidden;

        transition:
            opacity 0.2s ease,
            visibility 0.2s ease;
    }

    .join-modal-overlay.active {
        opacity: 1;
        visibility: visible;
    }


    /* ============================================================
   MODAL
   ============================================================ */

    .join-modal {
        width: 100%;
        max-width: 450px;

        background-color: var(--card-color);

        border: 1px solid var(--border-color);
        border-radius: 16px;

        box-shadow: 0 20px 50px rgba(0, 0, 0, 0.18);

        transform: translateY(12px) scale(0.98);

        transition: transform 0.2s ease;
    }

    .join-modal-overlay.active .join-modal {
        transform: translateY(0) scale(1);
    }


    /* ============================================================
   MODAL HEADER
   ============================================================ */

    .join-modal-header {
        display: flex;
        align-items: flex-start;
        justify-content: space-between;

        gap: 20px;

        padding: 22px 22px 18px;

        border-bottom: 1px solid var(--border-color);
    }

    .join-modal-eyebrow {
        display: block;

        margin-bottom: 6px;

        font-size: 10px;
        font-weight: 700;
        letter-spacing: 1px;

        color: var(--primary-color);
    }

    .join-modal-header h2 {
        margin: 0;

        font-size: 21px;
        font-weight: 700;

        color: var(--text-color);
    }

    .join-modal-header p {
        margin: 6px 0 0;

        font-size: 12px;
        line-height: 1.5;

        color: var(--muted-text-color);
    }


    /* ============================================================
   MODAL CLOSE BUTTON
   ============================================================ */

    .join-modal-close {
        display: flex;
        align-items: center;
        justify-content: center;

        width: 32px;
        height: 32px;

        flex-shrink: 0;

        border: 0;
        border-radius: 8px;

        background-color: var(--background-color);
        color: var(--muted-text-color);

        font-size: 19px;

        cursor: pointer;

        transition:
            background-color 0.2s ease,
            color 0.2s ease;
    }

    .join-modal-close:hover {
        background-color: var(--primary-soft);
        color: var(--primary-color);
    }


    /* ============================================================
   JOIN FORM
   ============================================================ */

    .join-class-form {
        padding: 22px;
    }


    /* ============================================================
   CODE FIELD
   ============================================================ */

    .join-code-field {
        display: flex;
        flex-direction: column;
    }

    .join-code-field label {
        margin-bottom: 8px;

        font-size: 12px;
        font-weight: 600;

        color: var(--text-color);
    }

    .join-code-field input {
        width: 100%;

        padding: 12px 13px;

        box-sizing: border-box;

        background-color: var(--background-color);

        border: 1px solid var(--border-color);
        border-radius: 9px;

        outline: none;

        color: var(--text-color);

        font-family: inherit;
        font-size: 14px;
        font-weight: 500;

        letter-spacing: 0.5px;

        transition:
            border-color 0.2s ease,
            box-shadow 0.2s ease;
    }

    .join-code-field input::placeholder {
        color: var(--muted-text-color);

        font-weight: 400;
    }

    .join-code-field input:focus {
        border-color: var(--primary-color);

        box-shadow:
            0 0 0 3px var(--primary-soft);
    }

    .join-code-field>span {
        margin-top: 7px;

        font-size: 10px;
        line-height: 1.5;

        color: var(--muted-text-color);
    }


    /* ============================================================
   MODAL ACTIONS
   ============================================================ */

    .join-modal-actions {
        display: flex;
        justify-content: flex-end;

        gap: 9px;

        margin-top: 22px;
    }

    .join-cancel-btn,
    .join-submit-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 7px;

        padding: 10px 15px;

        border-radius: 9px;

        font-family: inherit;
        font-size: 12px;
        font-weight: 600;

        cursor: pointer;

        transition:
            background-color 0.2s ease,
            color 0.2s ease,
            transform 0.2s ease;
    }

    .join-cancel-btn {
        background-color: var(--background-color);
        color: var(--muted-text-color);

        border: 1px solid var(--border-color);
    }

    .join-cancel-btn:hover {
        color: var(--text-color);
        background-color: var(--border-color);
    }

    .join-submit-btn {
        background-color: var(--primary-color);
        color: #ffffff;

        border: 1px solid var(--primary-color);
    }

    .join-submit-btn:hover {
        transform: translateY(-1px);

        box-shadow: 0 5px 14px var(--shadow-color);
    }

    .join-submit-btn i {
        font-size: 15px;
    }


    /* ============================================================
   PREVENT BACKGROUND SCROLL
   ============================================================ */

    body.modal-open {
        overflow: hidden;
    }


    /* ============================================================
   RESPONSIVE
   ============================================================ */

    @media (max-width: 850px) {

        .cg-grid {
            grid-template-columns: repeat(2,
                    minmax(0, 1fr));
        }

    }


    @media (max-width: 650px) {

        .cg-header {
            align-items: flex-start;
            flex-direction: column;

            gap: 18px;
        }

        .cg-join-btn {
            width: 100%;
        }

        .cg-grid {
            grid-template-columns: 1fr;
        }

        .cg-card-stats {
            grid-template-columns: 1fr;
        }

    }


    @media (max-width: 450px) {

        .cg-header h1 {
            font-size: 25px;
        }

        .cg-card {
            padding: 17px;
        }

        .join-modal-overlay {
            padding: 12px;
        }

        .join-modal-header,
        .join-class-form {
            padding-left: 18px;
            padding-right: 18px;
        }

        .join-modal-actions {
            flex-direction: column-reverse;
        }

        .join-cancel-btn,
        .join-submit-btn {
            width: 100%;
        }

    }
</style>
@extends('layouts.student_layout')

@section('content')

<div class="cg-page">

    {{-- =====================================================
         PAGE HEADER
    ====================================================== --}}
    <div class="cg-header">

        <div class="cg-header-text">

            <span class="cg-eyebrow">
                Student Dashboard
            </span>

            <h1>
                My Class Groups
            </h1>

            <p>
                View the classes you have joined and access your classrooms.
            </p>

        </div>


        {{-- JOIN CLASS BUTTON --}}
        <button
            type="button"
            class="cg-join-btn"
            id="openJoinModal">
            <i class="bx bx-plus"></i>
            Join Class
        </button>

    </div>


    {{-- =====================================================
         CLASS SUMMARY
    ====================================================== --}}
    <div class="cg-summary">

        <div class="cg-summary-card">

            <div class="cg-summary-icon">
                <i class="bx bx-book-open"></i>
            </div>

            <div>
                <strong>
                    {{ $classGroups->count() }}
                </strong>

                <span>
                    {{ $classGroups->count() === 1 ? 'Class' : 'Classes' }}
                </span>
            </div>

        </div>

    </div>


    {{-- =====================================================
         CLASS GROUP GRID
    ====================================================== --}}
    <div class="cg-grid">

        @forelse ($classGroups as $classGroup)

        <div class="cg-card">

            {{-- TOP --}}
            <div class="cg-card-top">

                <span class="cg-code-tag">
                    {{ $classGroup->course->course_code ?? 'COURSE' }}
                </span>

                <span class="cg-status
                        {{ $classGroup->status === 'active'
                            ? 'cg-status-active'
                            : 'cg-status-inactive' }}">

                    <i></i>

                    {{ ucfirst($classGroup->status) }}

                </span>

            </div>


            {{-- CLASS NAME --}}
            <h2 class="cg-card-title">
                {{ $classGroup->group_name }}
            </h2>


            {{-- COURSE --}}
            <p class="cg-card-subtitle">
                {{ $classGroup->course->course_name ?? 'Course' }}
            </p>


            {{-- DESCRIPTION --}}
            <p class="cg-card-desc">

                {{ $classGroup->description
                        ?? 'No description available.' }}

            </p>


            <div class="cg-card-divider"></div>


            {{-- =================================================
                     CLASS INFORMATION
                ================================================== --}}
            <div class="cg-card-stats">

                {{-- PROFESSOR --}}
                <div class="cg-mini-stat">

                    <span class="cg-mini-stat-icon">
                        <i class="bx bx-user"></i>
                    </span>

                    <div>

                        <strong>
                            {{ $classGroup->professor->name ?? 'Professor' }}
                        </strong>

                        <span>
                            Professor
                        </span>

                    </div>

                </div>


                {{-- CLASS CODE --}}
                <div class="cg-mini-stat">

                    <span class="cg-mini-stat-icon">
                        <i class="bx bx-key"></i>
                    </span>

                    <div>

                        <strong class="cg-code">
                            {{ $classGroup->group_code }}
                        </strong>

                        <span>
                            Class Code
                        </span>

                    </div>

                </div>

            </div>


            {{-- =================================================
                     OPEN CLASSROOM
                ================================================== --}}
            <a
                href="{{ route(
                        'student.class-groups.classroom',
                        ['classGroup' => $classGroup->id]
                    ) }}"
                class="cg-open-btn">

                Open Classroom

                <i class="bx bx-right-arrow-alt"></i>

            </a>

        </div>

        @empty

        {{-- =================================================
                 EMPTY STATE
            ================================================== --}}
        <div class="cg-empty">

            <div class="cg-empty-icon">

                <i class="bx bx-book-open"></i>

            </div>

            <h2>
                No Class Groups
            </h2>

            <p>
                You haven't joined any classes yet.
            </p>

            <button
                type="button"
                class="cg-empty-join-btn"
                id="openJoinModalEmpty">
                <i class="bx bx-plus"></i>
                Join a Class
            </button>

        </div>

        @endforelse

    </div>

</div>



{{-- =========================================================
     JOIN CLASS MODAL
========================================================= --}}

<div
    class="join-modal-overlay"
    id="joinClassModal">

    <div class="join-modal">

        {{-- MODAL HEADER --}}
        <div class="join-modal-header">

            <div>

                <span class="join-modal-eyebrow">
                    CLASSROOM
                </span>

                <h2>
                    Join a Class
                </h2>

                <p>
                    Enter the class code provided by your professor.
                </p>

            </div>


            <button
                type="button"
                class="join-modal-close"
                id="closeJoinModal">
                <i class="bx bx-x"></i>
            </button>

        </div>


        {{-- MODAL FORM --}}
        <form
            method="POST"
            action="{{ route('student.class-groups.join') }}"
            class="join-class-form">

            @csrf


            <div class="join-code-field">

                <label for="group_code">
                    Class Code
                </label>

                <input
                    type="text"
                    id="group_code"
                    name="group_code"
                    placeholder="Example: CLS-OE8EEI"
                    maxlength="20"
                    autocomplete="off"
                    required>

                <span>
                    Enter the code exactly as provided by your professor.
                </span>

            </div>


            {{-- FORM ACTIONS --}}
            <div class="join-modal-actions">

                <button
                    type="button"
                    class="join-cancel-btn"
                    id="cancelJoinModal">
                    Cancel
                </button>

                <button
                    type="submit"
                    class="join-submit-btn">
                    <i class="bx bx-log-in"></i>
                    Join Class
                </button>

            </div>

        </form>

    </div>

</div>



{{-- =========================================================
     MODAL JAVASCRIPT
========================================================= --}}

<script>
    const joinModal = document.getElementById('joinClassModal');

    const openJoinModal = document.getElementById('openJoinModal');

    const openJoinModalEmpty =
        document.getElementById('openJoinModalEmpty');

    const closeJoinModal =
        document.getElementById('closeJoinModal');

    const cancelJoinModal =
        document.getElementById('cancelJoinModal');


    // =====================================================
    // OPEN MODAL
    // =====================================================

    function openModal() {

        joinModal.classList.add('active');

        document.body.classList.add('modal-open');

    }


    // =====================================================
    // CLOSE MODAL
    // =====================================================

    function closeModal() {

        joinModal.classList.remove('active');

        document.body.classList.remove('modal-open');

    }


    // =====================================================
    // OPEN BUTTON
    // =====================================================

    if (openJoinModal) {

        openJoinModal.addEventListener(
            'click',
            openModal
        );

    }


    // =====================================================
    // EMPTY STATE JOIN BUTTON
    // =====================================================

    if (openJoinModalEmpty) {

        openJoinModalEmpty.addEventListener(
            'click',
            openModal
        );

    }


    // =====================================================
    // CLOSE BUTTON
    // =====================================================

    closeJoinModal.addEventListener(
        'click',
        closeModal
    );


    // =====================================================
    // CANCEL BUTTON
    // =====================================================

    cancelJoinModal.addEventListener(
        'click',
        closeModal
    );


    // =====================================================
    // CLICK OUTSIDE MODAL
    // =====================================================

    joinModal.addEventListener(
        'click',
        function(event) {

            if (event.target === joinModal) {

                closeModal();

            }

        }
    );


    // =====================================================
    // ESCAPE KEY
    // =====================================================

    document.addEventListener(
        'keydown',
        function(event) {

            if (
                event.key === 'Escape' &&
                joinModal.classList.contains('active')
            ) {

                closeModal();

            }

        }
    );
</script>

@endsection