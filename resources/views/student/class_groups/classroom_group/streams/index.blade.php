<style>
/*
|--------------------------------------------------------------------------
| STUDENT CLASSROOM STYLES
|--------------------------------------------------------------------------
| Same visual styling as the original classroom stylesheet.
| Component class names are namespaced with "student-" so they do not
| collide with the Professor classroom CSS.
|
| Global state classes intentionally kept unchanged:
| - .active
| - .dark-mode
|--------------------------------------------------------------------------
*/

/* ============================================================
   CLASSROOM PAGE
   ============================================================ */

.student-classroom-page {
    display: flex;
    flex-direction: column;

    width: 100%;
    min-height: 100%;


}

/* ============================================================
   CLASSROOM NAVIGATION
   ============================================================ */

.student-classroom-nav {
    display: flex;

    align-items: center;

    gap: 8px;

    width: calc(100% - 10px);

    min-height: 60px;

    margin-right: 5px;
 

    padding: 8px 10px;

    box-sizing: border-box;
    overflow-x: auto;

    scrollbar-width: none;
}

.student-classroom-nav::-webkit-scrollbar {
    display: none;
}


/* ============================================================
   NAVIGATION ITEM
   ============================================================ */

.student-classroom-nav-item {
    position: relative;

    display: inline-flex;

    align-items: center;
    justify-content: center;

    gap: 8px;

    min-width: 150px;
    height: 42px;

    padding: 0 14px;

    flex-shrink: 0;

    color: var(--secondary-text-color);

    background-color: var(--card-color);

    border: 1px solid var(--border-color);

    border-radius: 10px;

    text-decoration: none;

    font-size: 13px;
    font-weight: 600;

    white-space: nowrap;

    transition:
        color 0.2s ease,
        background-color 0.2s ease,
        border-color 0.2s ease;
}


/* ============================================================
   ICON
   ============================================================ */

.student-classroom-nav-item i {
    font-size: 17px;
}

/* ============================================================
   HOVER — ONLY INACTIVE ITEMS
   ============================================================ */

.student-classroom-nav-item:not(.active):hover {

    color: var(--third-text-color);

    background-color: var(--primary-color);

    border-color: var(--primary-color);

    border-radius: 10px;

}


/* ============================================================
   ACTIVE
   ============================================================ */

.student-classroom-nav-item.active {

    color: var(--button-color);

}


/* ============================================================
   ACTIVE INDICATOR
   ============================================================ */

.student-classroom-nav-item.active::after {

    content: "";

    position: absolute;

    left: 14px;

    right: 14px;

    bottom: 0;

    height: 3px;

    background-color: var(--button-color);

    border-radius: 3px 3px 0 0;

}
/* ============================================================
   CLASSROOM CONTENT
   ============================================================ */

.student-classroom-content {
    flex: 1;

    min-height: 0;

    width: 100%;

    padding: 5px 8px 25px 0;

    box-sizing: border-box;
}



/* ============================================================
   WELCOME + ACTIONS ROW
   ============================================================ */

.student-classroom-welcome-row {

    display: grid;

    grid-template-columns:
        minmax(0, 1fr)
        240px;

    gap: 10px;

    width: calc(100% - 10px);

    box-sizing: border-box;

}


/* ============================================================
   WELCOME CARD
   ============================================================ */

.student-classroom-welcome {

    width: 100%;

    min-height: 100px;

    box-sizing: border-box;

    background-color: var(--card-color);

    border: 1px solid var(--border-color);

    border-radius: 15px;

    overflow: hidden;

}


/* ============================================================
   WELCOME LABEL
   ============================================================ */

.student-classroom-welcome-label {

    display: block;

    margin-bottom: 7px;

    color: var(--button-color);

    font-size: 10px;

    font-weight: 800;

    letter-spacing: 1.2px;

    text-transform: uppercase;

}


/* ============================================================
   WELCOME TITLE
   ============================================================ */

.student-classroom-welcome-main h1 {

    margin: 0;

    color: var(--heading-color);

    font-size: 25px;

    font-weight: 800;

    line-height: 1.25;

}


/* ============================================================
   WELCOME COURSE
   ============================================================ */

.student-classroom-welcome-main p {

    margin: 7px 0 0;

    color: var(--secondary-text-color);

    font-size: 13px;

    line-height: 1.5;

}
/* ============================================================
   WELCOME MAIN
   ============================================================ */
.student-classroom-welcome-main {
    display: flex;
    align-items: center;
    justify-content: space-between;

    width: 100%;
    min-height: 80px;

    padding: 5px 15px;
    box-sizing: border-box;
}


/* ============================================================
   WELCOME TEXT
   ============================================================ */
.student-classroom-welcome-text {
    display: flex;
    flex-direction: column;
    align-items: flex-start;

    min-width: 0;
}


/* ============================================================
   CLASSROOM WELCOME ILLUSTRATION
   ============================================================ */
.student-classroom-welcome-illustration {
    position: relative;

    display: flex;
    align-items: center;
    justify-content: center;

    width: 95px;
    height: 70px;

    margin-left: 10px;
    flex-shrink: 0;

    --classroom-blue: #4f7cff;
    --classroom-blue-soft: #fff;

    --classroom-green: #48b982;
    --classroom-green-soft: #fff;

    --classroom-yellow: #e9b94f;
    --classroom-yellow-soft: #fff;

    --classroom-pink: #e58ab5;
    --classroom-pink-soft: #fff;
}


/* ============================================================
   SOFT BACKGROUND CIRCLE
   ============================================================ */

.student-classroom-welcome-illustration::before {

    content: "";

    position: absolute;

    width: 105px;
    height: 105px;

    background-color:
        var(--classroom-blue-soft);

    color: var(--border-color);

    border:
        1px solid var(--classroom-blue);

    border-radius: 50%;

}


/* ============================================================
   PROFESSOR
   ============================================================ */

.student-welcome-professor {

    position: absolute;

    z-index: 3;

    left: 18px;
    bottom: 15px;

    display: flex;

    align-items: center;
    justify-content: center;

    width: 42px;
    height: 42px;

    color:
        var(--classroom-green);

    background-color:
        var(--classroom-green-soft);

    border:
        1px solid var(--border-color);
    border-radius: 50%;

    box-shadow:
        0 5px 15px var(--shadow-color);

    font-size: 18px;

    transform:
        rotate(-7deg);

    animation:
        classroomProfessorFloat 3.5s ease-in-out infinite;

}


/* ============================================================
   MAIN CLASSROOM BOARD
   ============================================================ */

.student-welcome-board {

    position: relative;

    z-index: 2;

    display: flex;

    align-items: center;
    justify-content: center;

    width: 72px;
    height: 72px;

    color:
        var(--classroom-blue);

    background-color:
        var(--card-color);

    border:
        1px solid var(--border-color);

    border-radius: 12px;

    box-shadow:
        0 8px 20px var(--shadow-color);

    font-size: 31px;

    transform:
        rotate(2deg);

    animation:
        classroomBoardFloat 4s ease-in-out infinite;

}


/* ============================================================
   SMALL FLOATING ICONS
   ============================================================ */

.student-welcome-illustration-small {

    position: absolute;

    z-index: 3;

    display: flex;

    align-items: center;
    justify-content: center;

    width: 34px;
    height: 34px;

    background-color:
        var(--card-color);

    border-radius: 9px;

    box-shadow:
        0 5px 15px var(--shadow-color);

    font-size: 17px;

}


/* ============================================================
   BOOK — YELLOW
   ============================================================ */

.student-small-one {

    top: 5px;
    right: 17px;

    color:
        var(--classroom-yellow);

    border:
        1px solid var(--border-color);

    background-color:
        var(--classroom-yellow-soft);

    transform:
        rotate(8deg);

    animation:
        classroomBookFloat 3.2s ease-in-out infinite;

}


/* ============================================================
   GRADUATION — PINK
   ============================================================ */

.student-small-two {

    right: 2px;
    bottom: 15px;

    color:
        var(--classroom-pink);

      border:
        1px solid var(--border-color);

    background-color:
        var(--classroom-pink-soft);

    transform:
        rotate(6deg);

    animation:
        classroomGraduationFloat 3.4s ease-in-out infinite;

}
.student-stream-item-project .student-stream-item-icon {
    color: var(--button-color);
    background-color: var(--hover-color);
}

/* ============================================================
   PROFESSOR ANIMATION
   ============================================================ */

@keyframes classroomProfessorFloat {

    0%,
    100% {

        transform:
            translateY(0)
            rotate(-7deg);

    }

    50% {

        transform:
            translateY(4px)
            rotate(-3deg);

    }

}


/* ============================================================
   BOARD ANIMATION
   ============================================================ */

@keyframes classroomBoardFloat {

    0%,
    100% {

        transform:
            translateY(0)
            rotate(2deg);

    }

    50% {

        transform:
            translateY(-4px)
            rotate(-1deg);

    }

}


/* ============================================================
   BOOK ANIMATION
   ============================================================ */

@keyframes classroomBookFloat {

    0%,
    100% {

        transform:
            translateY(0)
            rotate(8deg);

    }

    50% {

        transform:
            translateY(-5px)
            rotate(3deg);

    }

}


/* ============================================================
   GRADUATION ANIMATION
   ============================================================ */

@keyframes classroomGraduationFloat {

    0%,
    100% {

        transform:
            translateY(0)
            rotate(6deg);

    }

    50% {

        transform:
            translateY(4px)
            rotate(2deg);

    }

}


/* ============================================================
   DARK MODE
   ============================================================ */

.dark-mode .student-classroom-welcome-illustration {

    --classroom-blue: #82a4ff;
    --classroom-blue-soft: #202b46;

    --classroom-green: #6bd29c;
    --classroom-green-soft: #1d382b;

    --classroom-yellow: #f1ca68;
    --classroom-yellow-soft: #3b321e;

    --classroom-pink: #efa4c5;
    --classroom-pink-soft: #3b2732;

}
/* ============================================================
   CLASS CODE BOX
   ============================================================ */

.student-classroom-code {

    display: flex;

    align-items: center;

    justify-content: space-between;

    width: fit-content;

    min-width: 230px;

    margin-top: 16px;

    padding: 10px 10px 10px 14px;

    box-sizing: border-box;

    background-color: var(--hover-color);

    border: 1px solid var(--border-color);

    border-radius: 10px;

}


/* ============================================================
   CLASS CODE INFORMATION
   ============================================================ */

.student-classroom-code-info {

    display: flex;

    flex-direction: column;

    gap: 4px;

    min-width: 0;

}


.student-classroom-code-label {

    color: var(--secondary-text-color);

    font-size: 10px;

    font-weight: 800;

    letter-spacing: 1px;

    text-transform: uppercase;

}


.student-classroom-code-value {

    color: var(--button-color);

    font-size: 18px;

    font-weight: 800;

    letter-spacing: 2px;

    line-height: 1.2;

    user-select: text;

}


/* ============================================================
   CLASS CODE ACTIONS
   ============================================================ */

.student-classroom-code-actions {

    display: flex;

    align-items: center;

    gap: 5px;

    margin-left: 16px;

}


/* ============================================================
   CLASS CODE BUTTON
   ============================================================ */

.student-classroom-code-button {

    position: relative;

    display: flex;

    align-items: center;

    justify-content: center;

    width: 34px;

    height: 34px;

    flex-shrink: 0;

    color: var(--secondary-text-color);

    background-color: var(--card-color);

    border: 1px solid var(--border-color);

    border-radius: 8px;

    font-family: inherit;

    cursor: pointer;

    transition:
        color 0.2s ease,
        background-color 0.2s ease,
        border-color 0.2s ease;

}


.student-classroom-code-button:hover {

    color: var(--button-color);

    background-color: var(--card-color);

    border-color: var(--button-color);

}


.student-classroom-code-button i {

    font-size: 16px;

}


/* ============================================================
   COPY FEEDBACK
   ============================================================ */

.student-copy-feedback {

    position: absolute;

    left: 50%;

    bottom: calc(100% + 7px);

    transform:
        translateX(-50%)
        translateY(3px);

    padding: 4px 7px;

    color: var(--third-text-color);

    background-color: var(--primary-color);

    border-radius: 5px;

    font-size: 9px;

    font-weight: 700;

    white-space: nowrap;

    opacity: 0;

    visibility: hidden;

    pointer-events: none;

    transition:
        opacity 0.2s ease,
        transform 0.2s ease;

}


.student-classroom-code-button.copied .student-copy-feedback {

    opacity: 1;

    visibility: visible;

    transform:
        translateX(-50%)
        translateY(0);

}


/* ============================================================
   RIGHT-SIDE ACTIONS
   ============================================================ */

.student-classroom-welcome-actions {

    display: flex;

    flex-direction: column;

    gap: 10px;

    width: 100%;

}


/* ============================================================
   ACTION CARD
   ============================================================ */

.student-classroom-welcome-action {

    display: flex;

    align-items: center;

    gap: 10px;

    width: 100%;

    flex: 1;

    padding: 14px;

    box-sizing: border-box;

    color: var(--heading-color);

    background-color: var(--card-color);

    border: 1px solid var(--border-color);

    border-radius: 12px;

    font-family: inherit;

    font-size: 13px;

    font-weight: 700;

    text-align: left;

    cursor: pointer;

    transition:
        color 0.2s ease,
        background-color 0.2s ease,
        border-color 0.2s ease,
        transform 0.2s ease;

}


/* ============================================================
   ACTION ICON
   ============================================================ */

.student-classroom-welcome-action > i:first-child {

    display: flex;

    align-items: center;

    justify-content: center;

    width: 40px;

    height: 40px;

    flex-shrink: 0;

    color: var(--button-color);

    background-color: var(--hover-color);

    border-radius: 9px;

    font-size: 19px;

}


/* ============================================================
   ACTION TEXT
   ============================================================ */

.student-classroom-welcome-action span {

    flex: 1;

    min-width: 0;

    color: var(--heading-color);

    font-size: 13px;

    font-weight: 700;

    transition:
        transform 0.2s ease,
        color 0.2s ease;

}


/* ============================================================
   ACTION ARROW
   ============================================================ */

.student-classroom-welcome-action .student-action-arrow {

    flex-shrink: 0;

    color: var(--secondary-text-color);

    font-size: 16px;

    transition:
        transform 0.2s ease,
        color 0.2s ease;

}


/* ============================================================
   ACTION HOVER
   ============================================================ */

.student-classroom-welcome-action:hover {

    color: var(--third-text-color);

    background-color: var(--primary-color);

    border-color: var(--primary-color);

    transform: translateY(-2px);

}


.student-classroom-welcome-action:hover > i:first-child {

    color: var(--third-text-color);

    background-color: transparent;

}


.student-classroom-welcome-action:hover span {

    transform: translateY(-2px);

    color: var(--third-text-color);

}


.student-classroom-welcome-action:hover .student-action-arrow {

    color: var(--third-text-color);

    transform: translateX(3px);

}


/* ============================================================
   WELCOME RESPONSIVE
   ============================================================ */

@media (max-width: 750px) {

    .student-classroom-welcome-row {

        grid-template-columns: 1fr;

    }

}


@media (max-width: 550px) {

    .student-classroom-welcome-main {

        padding: 20px;

    }

    .student-classroom-welcome-illustration {

        display: none;

    }

}

/* ============================================================
   CLASS CODE DISPLAY OVERLAY
   ============================================================ */

.student-class-code-overlay {

    position: fixed;

    inset: 0;

    z-index: 9999;

    display: flex;

    align-items: center;

    justify-content: center;

    padding: 30px;

    box-sizing: border-box;

    background-color: rgba(0, 0, 0, 0.75);

    opacity: 0;

    visibility: hidden;

    pointer-events: none;

    transition:
        opacity 0.25s ease,
        visibility 0.25s ease;

}


/* ============================================================
   OPEN STATE
   ============================================================ */

.student-class-code-overlay.show {

    opacity: 1;

    visibility: visible;

    pointer-events: auto;

}


/* ============================================================
   DISPLAY CARD
   ============================================================ */

.student-class-code-display {

    position: relative;

    display: flex;

    flex-direction: column;

    align-items: center;

    justify-content: center;

    width: min(850px, 90vw);

    min-height: 420px;

    padding: 50px;

    box-sizing: border-box;

    background-color: var(--card-color);

    border: 1px solid var(--border-color);

    border-radius: 20px;

    text-align: center;

    transform: scale(0.95);

    transition: transform 0.25s ease;

}


.student-class-code-overlay.show .student-class-code-display {

    transform: scale(1);

}


/* ============================================================
   DISPLAY LABEL
   ============================================================ */

.student-class-code-display-label {

    margin-bottom: 20px;

    color: var(--secondary-text-color);

    font-size: 14px;

    font-weight: 800;

    letter-spacing: 3px;

    text-transform: uppercase;

}


/* ============================================================
   LARGE CLASS CODE
   ============================================================ */

.student-class-code-display-value {

    color: var(--button-color);

    font-size: clamp(70px, 12vw, 150px);

    font-weight: 900;

    letter-spacing: 10px;

    line-height: 1;

    user-select: text;

}


/* ============================================================
   DISPLAY HELP TEXT
   ============================================================ */

.student-class-code-display-help {

    margin: 25px 0 0;

    color: var(--secondary-text-color);

    font-size: 14px;

}


/* ============================================================
   CLOSE BUTTON
   ============================================================ */

.student-class-code-display-close {

    position: absolute;

    top: 18px;

    right: 18px;

    display: flex;

    align-items: center;

    justify-content: center;

    width: 40px;

    height: 40px;

    color: var(--secondary-text-color);

    background-color: var(--hover-color);

    border: 1px solid var(--border-color);

    border-radius: 10px;

    font-family: inherit;

    cursor: pointer;

    transition:
        color 0.2s ease,
        background-color 0.2s ease,
        border-color 0.2s ease;

}


.student-class-code-display-close:hover {

    color: var(--third-text-color);

    background-color: var(--primary-color);

    border-color: var(--primary-color);

}


.student-class-code-display-close i {

    font-size: 21px;

}

/* ============================================================
   CLASSROOM MAIN LAYOUT
   ============================================================ */

.student-classroom-main-layout {
    display: grid;

    grid-template-columns: minmax(0, 1fr);

    width: calc(100% - 10px);

    margin-top: 16px;

    box-sizing: border-box;
}


/* ============================================================
   STREAM
   Exact Professor Stream content styling
   adapted for the Student page.
   ============================================================ */

.student-classroom-stream {
    width: 100%;
    min-width: 0;
}

/* The reference Professor Stream uses separate activity cards. */
.stream-content-redesign {
    width: 100%;
}

.stream-content-redesign .classroom-stream-card {
    display: flex;
    flex-direction: column;
    gap: 12px;
    width: 100%;
    overflow: visible;
    border: 0;
    border-radius: 0;
    background: transparent;
    box-shadow: none;
}

.stream-content-redesign .stream-item {
    position: relative;
    display: flex;
    align-items: flex-start;
    gap: 17px;
    width: 100%;
    min-height: 160px;
    padding: 28px 22px 24px 30px;
    box-sizing: border-box;
    border: 1px solid #dfe5ed;
    border-radius: 16px;
    background: #ffffff;
    transition: background-color .18s ease, border-color .18s ease,
                box-shadow .18s ease;
}

.stream-content-redesign .stream-item::before {
    position: absolute;
    top: 22px;
    bottom: 22px;
    left: 0;
    width: 4px;
    border-radius: 0 4px 4px 0;
    background: #cbd5e1;
    content: '';
}

.stream-content-redesign .stream-item-announcement::before { background: #f97316; }
.stream-content-redesign .stream-item-material::before { background: #3b82f6; }
.stream-content-redesign .stream-item-assignment::before { background: #6366f1; }
.stream-content-redesign .stream-item-quiz::before { background: #f59e0b; }
.stream-content-redesign .stream-item-exam::before { background: #ef4444; }
.stream-content-redesign .stream-item-project::before { background: #eab308; }

.stream-content-redesign .stream-item:hover {
    background: #ffffff;
    border-color: #d7dee8;
    box-shadow: 0 8px 24px rgba(15, 23, 42, .055);
}

.stream-content-redesign .stream-item-icon {
    position: relative;
    display: grid;
    place-items: center;
    width: 65px;
    height: 65px;
    flex: 0 0 65px;
    margin-top: 0;
    border-radius: 17px;
    background: #f3f6fa;
    color: #64748b;
    font-size: 28px;
}

.stream-content-redesign .stream-item-announcement .stream-item-icon {
    background: #fff7ed;
    color: #ea580c;
}

.stream-content-redesign .stream-item-material .stream-item-icon {
    background: #eff6ff;
    color: #2563eb;
}

.stream-content-redesign .stream-item-assignment .stream-item-icon {
    background: #eef2ff;
    color: #4f46e5;
}

.stream-content-redesign .stream-item-quiz .stream-item-icon {
    background: #fff8e8;
    color: #d97706;
}

.stream-content-redesign .stream-item-exam .stream-item-icon {
    background: #fef2f2;
    color: #dc2626;
}

.stream-content-redesign .stream-item-project .stream-item-icon {
    background: #fff8d6;
    color: #a16207;
}

.stream-content-redesign .stream-item-content {
    min-width: 0;
    flex: 1;
    padding-right: 8px;
}

.stream-content-redesign .stream-item-posted {
    margin: 0 0 7px;
    color: #7a8697;
    font-size: 14px;
    line-height: 1.45;
}

.stream-content-redesign .stream-item-posted strong {
    color: #334155;
    font-weight: 800;
}

.stream-content-redesign .stream-item-time {
    color: #9aa5b4;
}

.stream-content-redesign .stream-type-badge {
    display: none;
}

.stream-content-redesign .stream-modern-body {
    margin-top: 0;
}

.stream-content-redesign .stream-item-title,
.stream-content-redesign .stream-modern-title-row .stream-item-title {
    margin: 0;
    color: #1f2937;
    font-size: 21px;
    font-weight: 800;
    line-height: 1.25;
    letter-spacing: -.015em;
}

.stream-content-redesign .stream-item-content-link {
    display: block;
    color: inherit;
    text-decoration: none;
}

.stream-content-redesign .stream-modern-link {
    margin-top: 0;
    padding: 0;
    border-radius: 0;
}

.stream-content-redesign .stream-modern-link:hover {
    background: transparent;
}

.stream-content-redesign .stream-modern-title-row {
    display: block;
}

.stream-content-redesign .stream-modern-arrow {
    display: none;
}

.stream-content-redesign .stream-item-topic {
    display: inline-flex;
    align-items: center;
    gap: 5px;
    margin-top: 16px;
    padding: 5px 9px;
    border: 1px solid #e3e8ef;
    border-radius: 8px;
    background: #f8fafc;
    color: #64748b;
    font-size: 11px;
    font-weight: 700;
}

.stream-content-redesign .stream-project-meta {
    display: flex;
    flex-wrap: wrap;
    align-items: center;
    gap: 9px;
    margin-top: 16px;
}

.stream-content-redesign .stream-project-badge,
.stream-content-redesign .stream-project-type {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    min-height: 30px;
    padding: 5px 10px;
    border-radius: 9px;
    font-size: 12px;
    font-weight: 800;
}

.stream-content-redesign .stream-project-badge {
    background: #fff7c8;
    color: #946f00;
}

.stream-content-redesign .stream-project-type {
    border: 1px solid #e2e8f0;
    background: #f8fafc;
    color: #64748b;
}

.stream-content-redesign .stream-project-badge i,
.stream-content-redesign .stream-project-type i,
.stream-content-redesign .stream-item-topic i {
    font-size: 14px;
}

.stream-content-redesign .stream-announcement-text {
    max-width: 760px;
    margin: 12px 0 0;
    color: #64748b;
    font-size: 14px;
    line-height: 1.7;
    display: -webkit-box;
    overflow: hidden;
    -webkit-box-orient: vertical;
    -webkit-line-clamp: 3;
}

/* ============================================================
   STUDENT STREAM ACTION INDICATOR
   Visual only; no professor edit/delete actions are exposed.
   ============================================================ */

.stream-content-redesign .stream-item-student-menu {
    display: grid;
    place-items: center;
    width: 34px;
    height: 34px;
    flex: 0 0 34px;
    margin-left: auto;
    border: 0;
    border-radius: 10px;
    background: transparent;
    color: #94a3b8;
    font-size: 19px;
}

/* ============================================================
   EMPTY
   ============================================================ */

.stream-content-redesign .classroom-stream-empty {
    padding: 55px 24px;
    text-align: center;
    border: 1px solid #dfe5ed;
    border-radius: 16px;
    background: #ffffff;
}

.stream-content-redesign .classroom-stream-empty-icon {
    display: grid;
    place-items: center;
    width: 50px;
    height: 50px;
    margin: 0 auto 13px;
    border-radius: 15px;
    background: #f8fafc;
    color: #94a3b8;
    font-size: 22px;
}

.stream-content-redesign .classroom-stream-empty h3 {
    margin: 0;
    color: #334155;
    font-size: 15px;
    font-weight: 700;
}

.stream-content-redesign .classroom-stream-empty p {
    max-width: 460px;
    margin: 7px auto 0;
    color: #94a3b8;
    font-size: 12px;
    line-height: 1.6;
}

/* ============================================================
   DARK MODE
   ============================================================ */

.dark-mode .stream-content-redesign .stream-item {
    border-color: rgba(148, 163, 184, .18);
    background: var(--card-color);
}

.dark-mode .stream-content-redesign .stream-item:hover {
    background: var(--card-color);
    border-color: rgba(148, 163, 184, .28);
}

.dark-mode .stream-content-redesign .stream-item-posted {
    color: #94a3b8;
}

.dark-mode .stream-content-redesign .stream-item-posted strong {
    color: #f8fafc;
}

.dark-mode .stream-content-redesign .stream-item-time {
    color: #7f8da3;
}

.dark-mode .stream-content-redesign .stream-item-title,
.dark-mode .stream-content-redesign .stream-modern-title-row .stream-item-title {
    color: #f8fafc;
}

.dark-mode .stream-content-redesign .stream-item-topic,
.dark-mode .stream-content-redesign .stream-project-type {
    background: #202b3d;
    border-color: rgba(148, 163, 184, .16);
    color: #aab7ca;
}

.dark-mode .stream-content-redesign .stream-project-badge {
    background: #3b321e;
    color: #f1ca68;
}

.dark-mode .stream-content-redesign .stream-announcement-text {
    color: #94a3b8;
}

.dark-mode .stream-content-redesign .classroom-stream-empty {
    background: var(--card-color);
    border-color: rgba(148, 163, 184, .18);
}

.dark-mode .stream-content-redesign .classroom-stream-empty h3 {
    color: #f8fafc;
}

.dark-mode .stream-content-redesign .classroom-stream-empty p {
    color: #94a3b8;
}

@media (max-width: 700px) {

    .stream-content-redesign .classroom-stream-card {
        gap: 10px;
    }

    .stream-content-redesign .stream-item {
        gap: 12px;
        min-height: 0;
        padding: 20px 15px 20px 20px;
        border-radius: 14px;
    }

    .stream-content-redesign .stream-item::before {
        top: 18px;
        bottom: 18px;
        width: 3px;
    }

    .stream-content-redesign .stream-item-icon {
        width: 48px;
        height: 48px;
        flex-basis: 48px;
        border-radius: 13px;
        font-size: 22px;
    }

    .stream-content-redesign .stream-item-posted {
        font-size: 12px;
    }

    .stream-content-redesign .stream-item-title,
    .stream-content-redesign .stream-modern-title-row .stream-item-title {
        font-size: 17px;
    }

    .stream-content-redesign .stream-project-meta {
        margin-top: 12px;
    }
}


/* ============================================================
   CLASS INFORMATION MODAL
   ============================================================ */

.student-classroom-info-modal {
    position: fixed;
    inset: 0;

    z-index: 1000;

    display: flex;
    align-items: center;
    justify-content: center;

    padding: 20px;

    box-sizing: border-box;

    visibility: hidden;
    opacity: 0;

    transition:
        opacity 0.2s ease,
        visibility 0.2s ease;
}


/* ============================================================
   SHOW MODAL
   ============================================================ */

.student-classroom-info-modal.show {
    visibility: visible;
    opacity: 1;
}


/* ============================================================
   OVERLAY
   ============================================================ */

.student-classroom-info-modal-overlay {
    position: absolute;
    inset: 0;

    background-color: rgba(0, 0, 0, 0.45);

    backdrop-filter: blur(3px);
}


/* ============================================================
   DIALOG
   ============================================================ */

.student-classroom-info-dialog {
    position: relative;
    z-index: 2;

    width: 100%;
    max-width: 520px;

    max-height: calc(100vh - 40px);

    overflow: hidden;

    background-color: var(--card-color);

    border: 1px solid var(--border-color);

    border-radius: 16px;

    box-shadow:
        0 20px 50px rgba(0, 0, 0, 0.18);

    transform: translateY(10px) scale(0.98);

    transition:
        transform 0.2s ease;
}

.student-classroom-info-modal.show .student-classroom-info-dialog {
    transform: translateY(0) scale(1);
}


/* ============================================================
   HEADER
   ============================================================ */

.student-classroom-info-header {
    display: flex;
    align-items: flex-start;
    justify-content: space-between;

    gap: 20px;

    padding: 24px 25px 20px;

    border-bottom: 1px solid var(--border-color);
}

.student-classroom-info-header > div {
    min-width: 0;
}

.student-classroom-info-eyebrow {
    display: block;

    margin-bottom: 5px;

    color: var(--button-color);

    font-size: 9px;
    font-weight: 800;

    letter-spacing: 1.3px;
}

.student-classroom-info-header h2 {
    margin: 0 0 5px;

    color: var(--heading-color);

    font-size: 20px;
    font-weight: 800;

    line-height: 1.25;

    word-break: break-word;
}

.student-classroom-info-header p {
    margin: 0;

    color: var(--secondary-text-color);

    font-size: 11px;

    line-height: 1.5;
}


/* ============================================================
   CLOSE BUTTON
   ============================================================ */

.student-classroom-info-close {
    display: flex;
    align-items: center;
    justify-content: center;

    flex-shrink: 0;

    width: 34px;
    height: 34px;

    padding: 0;

    color: var(--secondary-text-color);

    background-color: transparent;

    border: 1px solid var(--border-color);

    border-radius: 9px;

    cursor: pointer;

    transition:
        color 0.2s ease,
        background-color 0.2s ease,
        border-color 0.2s ease;
}

.student-classroom-info-close i {
    font-size: 19px;
}

.student-classroom-info-close:hover {
    color: var(--heading-color);

    background-color: var(--hover-color);

    border-color: var(--border-color);
}


/* ============================================================
   BODY
   ============================================================ */

.student-classroom-info-body {
    display: flex;
    flex-direction: column;

    gap: 0;

    max-height: 420px;

    overflow-y: auto;
}


/* ============================================================
   INFORMATION ITEM
   ============================================================ */

.student-classroom-info-item {
    display: flex;
    flex-direction: column;

    gap: 5px;

    padding: 15px 25px;

    border-bottom: 1px solid var(--border-color);
}

.student-classroom-info-item:last-child {
    border-bottom: none;
}

.student-classroom-info-label {
    color: var(--secondary-text-color);

    font-size: 9px;
    font-weight: 800;

    letter-spacing: 1px;
}

.student-classroom-info-item strong {
    color: var(--heading-color);

    font-size: 13px;
    font-weight: 700;

    line-height: 1.4;

    word-break: break-word;
}


/* ============================================================
   DESCRIPTION
   ============================================================ */

.student-classroom-info-description p {
    margin: 0;

    color: var(--secondary-text-color);

    font-size: 12px;

    line-height: 1.6;

    white-space: pre-line;
}


/* ============================================================
   ACTIONS
   ============================================================ */

.student-classroom-info-actions {
    display: flex;
    align-items: center;
    justify-content: flex-end;

    gap: 10px;

    padding: 17px 25px;

    background-color: var(--card-color);

    border-top: 1px solid var(--border-color);
}


/* ============================================================
   CLOSE / CANCEL
   ============================================================ */

.student-classroom-info-cancel {
    display: inline-flex;
    align-items: center;
    justify-content: center;

    height: 38px;

    padding: 0 15px;

    color: var(--secondary-text-color);

    background-color: transparent;

    border: 1px solid var(--border-color);

    border-radius: 9px;

    font-family: inherit;

    font-size: 11px;
    font-weight: 700;

    cursor: pointer;

    transition:
        color 0.2s ease,
        background-color 0.2s ease,
        border-color 0.2s ease;
}

.student-classroom-info-cancel:hover {
    color: var(--heading-color);

    background-color: var(--hover-color);
}


/* ============================================================
   EDIT BUTTON
   ============================================================ */

.student-classroom-info-edit {
    display: inline-flex;
    align-items: center;
    justify-content: center;

    gap: 7px;

    height: 38px;

    padding: 0 16px;

    box-sizing: border-box;

    color: var(--button-text-color);

    background-color: var(--button-color);

    border: 1px solid var(--button-color);

    border-radius: 9px;

    font-size: 11px;
    font-weight: 700;

    text-decoration: none;

    transition:
        transform 0.2s ease,
        box-shadow 0.2s ease;
}

.student-classroom-info-edit i {
    font-size: 15px;
}

.student-classroom-info-edit:hover {
    color: var(--button-text-color);

    transform: translateY(-1px);

    box-shadow:
        0 5px 14px rgba(0, 0, 0, 0.12);
}


/* ============================================================
   MOBILE
   ============================================================ */

@media (max-width: 600px) {

    .student-classroom-info-modal {
        padding: 12px;
    }

    .student-classroom-info-dialog {
        max-height: calc(100vh - 24px);

        border-radius: 14px;
    }

    .student-classroom-info-header {
        padding: 20px;
    }

    .student-classroom-info-item {
        padding: 14px 20px;
    }

    .student-classroom-info-actions {
        padding: 15px 20px;
    }

    .student-classroom-info-cancel,
    .student-classroom-info-edit {
        flex: 1;
    }
}

/* ============================================================
   ANNOUNCEMENT MODAL
   ============================================================ */

.student-classroom-announcement-modal {
    position: fixed;
    inset: 0;

    z-index: 1100;

    display: flex;
    align-items: center;
    justify-content: center;

    padding: 20px;

    box-sizing: border-box;

    visibility: hidden;
    opacity: 0;

    transition:
        opacity 0.2s ease,
        visibility 0.2s ease;
}


/* ============================================================
   SHOW
   ============================================================ */

.student-classroom-announcement-modal.show {
    visibility: visible;
    opacity: 1;
}


/* ============================================================
   OVERLAY
   ============================================================ */

.student-classroom-announcement-overlay {
    position: absolute;
    inset: 0;

    background-color: rgba(0, 0, 0, 0.45);

    backdrop-filter: blur(3px);
}


/* ============================================================
   DIALOG
   ============================================================ */

.student-classroom-announcement-dialog {
    position: relative;
    z-index: 2;

    width: 100%;
    max-width: 560px;

    max-height: calc(100vh - 40px);

    overflow-y: auto;

    background-color: var(--card-color);

    border: 1px solid var(--border-color);

    border-radius: 16px;

    box-shadow:
        0 20px 50px rgba(0, 0, 0, 0.18);

    transform: translateY(10px) scale(0.98);

    transition:
        transform 0.2s ease;
}

.student-classroom-announcement-modal.show
.student-classroom-announcement-dialog {
    transform: translateY(0) scale(1);
}


/* ============================================================
   HEADER
   ============================================================ */

.student-classroom-announcement-header {
    display: flex;
    align-items: flex-start;
    justify-content: space-between;

    gap: 20px;

    padding: 24px 25px 20px;

    border-bottom: 1px solid var(--border-color);
}

.student-classroom-announcement-header > div {
    min-width: 0;
}

.student-classroom-announcement-eyebrow {
    display: block;

    margin-bottom: 5px;

    color: var(--button-color);

    font-size: 9px;
    font-weight: 800;

    letter-spacing: 1.3px;
}

.student-classroom-announcement-header h2 {
    margin: 0 0 5px;

    color: var(--heading-color);

    font-size: 20px;
    font-weight: 800;

    line-height: 1.3;
}

.student-classroom-announcement-header p {
    margin: 0;

    color: var(--secondary-text-color);

    font-size: 11px;

    line-height: 1.5;
}


/* ============================================================
   CLOSE BUTTON
   ============================================================ */

.student-classroom-announcement-close {
    display: flex;
    align-items: center;
    justify-content: center;

    width: 34px;
    height: 34px;

    flex-shrink: 0;

    padding: 0;

    color: var(--secondary-text-color);

    background-color: transparent;

    border: 1px solid var(--border-color);

    border-radius: 9px;

    cursor: pointer;

    transition:
        color 0.2s ease,
        background-color 0.2s ease,
        border-color 0.2s ease;
}

.student-classroom-announcement-close i {
    font-size: 19px;
}

.student-classroom-announcement-close:hover {
    color: var(--heading-color);

    background-color: var(--hover-color);

    border-color: var(--border-color);
}


/* ============================================================
   FORM
   ============================================================ */

.student-classroom-announcement-form {
    padding: 24px 25px 25px;
}


/* ============================================================
   FORM GROUP
   ============================================================ */

.student-classroom-announcement-form-group {
    margin-bottom: 20px;
}

.student-classroom-announcement-form-group label {
    display: block;

    margin-bottom: 7px;

    color: var(--heading-color);

    font-size: 12px;
    font-weight: 700;
}

.student-classroom-announcement-form-group label span {
    color: var(--danger-color);
}


/* ============================================================
   INPUT / TEXTAREA
   ============================================================ */

.student-classroom-announcement-form-group input,
.student-classroom-announcement-form-group textarea {
    width: 100%;

    box-sizing: border-box;

    padding: 11px 13px;

    color: var(--heading-color);

    background-color: var(--card-color);

    border: 1px solid var(--border-color);

    border-radius: 9px;

    outline: none;

    font-family: inherit;
    font-size: 13px;

    transition:
        border-color 0.2s ease,
        box-shadow 0.2s ease;
}

.student-classroom-announcement-form-group input {
    height: 42px;
}

.student-classroom-announcement-form-group textarea {
    min-height: 135px;

    resize: vertical;

    line-height: 1.6;
}

.student-classroom-announcement-form-group input::placeholder,
.student-classroom-announcement-form-group textarea::placeholder {
    color: var(--secondary-text-color);

    opacity: 0.65;
}

.student-classroom-announcement-form-group input:focus,
.student-classroom-announcement-form-group textarea:focus {
    border-color: var(--button-color);

    box-shadow:
        0 0 0 3px var(--focus-ring-color);
}


/* ============================================================
   ERROR
   ============================================================ */

.student-classroom-announcement-error {
    display: block;

    margin-top: 6px;

    color: var(--danger-color);

    font-size: 11px;
}


/* ============================================================
   ACTIONS
   ============================================================ */

.student-classroom-announcement-actions {
    display: flex;
    align-items: center;
    justify-content: flex-end;

    gap: 10px;

    padding-top: 20px;

    border-top: 1px solid var(--border-color);
}


/* ============================================================
   CANCEL
   ============================================================ */

.student-classroom-announcement-cancel {
    min-height: 38px;

    padding: 0 15px;

    color: var(--secondary-text-color);

    background-color: transparent;

    border: 1px solid var(--border-color);

    border-radius: 9px;

    font-family: inherit;
    font-size: 12px;
    font-weight: 700;

    cursor: pointer;

    transition:
        color 0.2s ease,
        background-color 0.2s ease;
}

.student-classroom-announcement-cancel:hover {
    color: var(--heading-color);

    background-color: var(--hover-color);
}


/* ============================================================
   SUBMIT
   ============================================================ */

.student-classroom-announcement-submit {
    display: inline-flex;
    align-items: center;
    justify-content: center;

    gap: 7px;

    min-height: 38px;

    padding: 0 16px;

    color: var(--button-text-color);

    background-color: var(--button-color);

    border: 1px solid var(--button-color);

    border-radius: 9px;

    font-family: inherit;
    font-size: 12px;
    font-weight: 700;

    cursor: pointer;

    transition:
        transform 0.2s ease,
        box-shadow 0.2s ease;
}

.student-classroom-announcement-submit i {
    font-size: 15px;
}

.student-classroom-announcement-submit:hover {
    transform: translateY(-1px);

    box-shadow:
        0 5px 14px rgba(0, 0, 0, 0.12);
}


/* ============================================================
   MOBILE
   ============================================================ */

@media (max-width: 600px) {

    .student-classroom-announcement-modal {
        padding: 12px;
    }

    .student-classroom-announcement-dialog {
        max-height: calc(100vh - 24px);

        border-radius: 14px;
    }

    .student-classroom-announcement-header {
        padding: 20px;
    }

    .student-classroom-announcement-form {
        padding: 20px;
    }

    .student-classroom-announcement-actions {
        flex-direction: column-reverse;

        align-items: stretch;
    }

    .student-classroom-announcement-cancel,
    .student-classroom-announcement-submit {
        width: 100%;
    }

}
</style>
@extends('layouts.student_layout')

@section('title', $classGroup->group_name)

@section('content')

<div class="classroom-page">

    {{-- ============================================================
         CLASSROOM NAVIGATION
    ============================================================= --}}
    @include('student.class_groups.classroom_group.navigation')


    {{-- ============================================================
         PAGE CONTENT
    ============================================================= --}}
    <main class="classroom-content">


        {{-- ========================================================
             WELCOME + CLASSROOM ACTIONS
        ========================================================= --}}
        <div class="classroom-welcome-row">


            {{-- ====================================================
                 WELCOME CARD
            ===================================================== --}}
            <section class="classroom-welcome">

                <div class="classroom-welcome-main">


                    {{-- WELCOME TEXT --}}
            <div class="classroom-welcome-main">

                {{-- WELCOME TEXT --}}
                <div class="classroom-welcome-text">

                    <span class="classroom-welcome-label">
                        CLASSROOM
                    </span>

                    <h1>
                        Welcome to {{ $classGroup->group_name }}
                    </h1>

                    <p>
                        {{ $classGroup->course->course_name }}
                    </p>

                </div>


                {{-- =================================================
                    ILLUSTRATION
                ================================================== --}}
                <div class="classroom-welcome-illustration">

                    <div class="welcome-professor">

                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            width="24"
                            height="24"
                            fill="currentColor"
                            viewBox="0 0 24 24">

                            <path
                                d="m3.6 8.8 2.93-2.2c.52-.39 1.16-.6 1.8-.6H9v6.53c0 2.38-1.32 4.51-3.45 5.58l.89 1.79a8.19 8.19 0 0 0 4.55-7.37V6h4v11.32a2.68 2.68 0 0 0 5.28.65l.68-2.72-1.94-.49-.68 2.72c-.08.31-.35.52-.66.52a.68.68 0 0 1-.68-.68V6h4V4H8.32c-1.07 0-2.14.35-3 1L2.39 7.2l1.2 1.6Z">
                            </path>

                        </svg>

                    </div>


                    <div class="welcome-board">
                        <i class="bx bx-chalkboard"></i>
                    </div>


                    <div class="welcome-illustration-small small-one">
                        <i class="bx bx-book-open"></i>
                    </div>


                    <div class="welcome-illustration-small small-two">

                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            width="24"
                            height="24"
                            fill="currentColor"
                            viewBox="0 0 24 24">

                            <path
                                d="m21.45 8.61-9-4.5a1 1 0 0 0-.89 0l-6 3-3 1.5-1 .5a1 1 0 0 0-.55.89v6h2v-5.38l2 1v3.83c0 2.06 3.12 4.56 7 4.56s7-2.49 7-4.56v-3.83l2.45-1.22c.34-.17.55-.52.55-.89s-.21-.72-.55-.89Zm-15 .29L12 6.12l6.76 3.38L12 12.88 5.24 9.5l1.21-.61ZM17 15.45c0 .76-2.11 2.56-5 2.56s-5-1.79-5-2.56v-2.83l4.55 2.28c.14.07.29.11.45.11L17 12.62z">
                            </path>

                        </svg>

                    </div>

                </div>

            </div>

            </section>


            {{-- ====================================================
                 STUDENT CLASSROOM ACTIONS
            ===================================================== --}}
            <div class="classroom-welcome-actions">

                {{-- CLASS INFORMATION --}}
                <button
                    type="button"
                    class="classroom-welcome-action"
                    id="openClassInformation">

                    <i class="bx bx-info-circle"></i>

                    <span>
                        Class Information
                    </span>

                    <i class="bx bx-chevron-right action-arrow"></i>

                </button>

            </div>

        </div>


        {{-- ============================================================
             MAIN STREAM
        ============================================================= --}}
        <div class="classroom-main-layout">

            <section class="classroom-stream">


                {{-- ====================================================
                     STREAM HEADER
                ===================================================== --}}
                <div class="classroom-section-header">

                    <div>

                        <span class="classroom-section-label">
                            CLASSROOM
                        </span>

                        <h2>
                            Stream
                        </h2>

                    </div>

                </div>


{{-- ====================================================
     STREAM CONTENT
===================================================== --}}
<div class="stream-content-redesign">

    <div class="classroom-stream-card">

        @forelse ($streamItems as $streamItem)

            @php

                $type = $streamItem['type'];
                $item = $streamItem['item'] ?? null;

                $icon = match ($type) {
                    'announcement' => 'bx-bell',
                    'material' => 'bx-file',
                    'assignment' => 'bx-task',
                    'quiz' => 'bx-help-circle',
                    'exam' => 'bx-edit-alt',
                    'project' => 'bx-briefcase-alt-2',
                    default => 'bx-news',
                };

                $action = match ($type) {
                    'announcement' => 'posted an announcement',
                    'material' => 'posted a material',
                    'assignment' => 'posted an assignment',
                    'quiz' => 'posted a quiz',
                    'exam' => 'posted an exam',
                    'project' => 'posted a project',
                    default => 'posted an activity',
                };

                $topic = null;

                if ($item && isset($item->topic)) {
                    $topic = $item->topic;
                }

                $detailRoute = match ($type) {

                    'material' => route(
                        'student.class-groups.materials.show',
                        [
                            'classGroup' => $classGroup->id,
                            'material' => $item->id,
                            'return_to' => 'stream',
                        ]
                    ),

                    'assignment' => route(
                        'student.class-groups.assignments.show',
                        [
                            'classGroup' => $classGroup->id,
                            'assignment' => $item->id,
                            'return_to' => 'stream',
                        ]
                    ),

                    'quiz' => route(
                        'student.class-groups.quizzes.show',
                        [
                            'classGroup' => $classGroup->id,
                            'quiz' => $item->id,
                            'return_to' => 'stream',
                        ]
                    ),

                    'exam' => route(
                        'student.class-groups.exams.show',
                        [
                            'classGroup' => $classGroup->id,
                            'exam' => $item->id,
                            'return_to' => 'stream',
                        ]
                    ),

                    'project' => route(
                        'student.class-groups.projects.show',
                        [
                            'classGroup' => $classGroup->id,
                            'project' => $item->id,
                            'return_to' => 'stream',
                        ]
                    ),

                    default => null,
                };

            @endphp


            <article
                class="stream-item stream-item-{{ $type }}"
                data-type="{{ $type }}"
            >

                {{-- TYPE ICON --}}
                <div class="stream-item-icon">
                    <i class="bx {{ $icon }}"></i>
                </div>


                {{-- CONTENT --}}
                <div class="stream-item-content">

                    <p class="stream-item-posted">

                        <strong>
                            {{ $streamItem['posted_by'] }}
                        </strong>

                        {{ $action }}

                        <span class="stream-item-time">
                            · {{ $streamItem['created_at']->diffForHumans() }}
                        </span>

                    </p>


                    {{-- ANNOUNCEMENT --}}
                    @if ($type === 'announcement')

                        <div class="stream-modern-body">

                            <h3 class="stream-item-title">
                                {{ $streamItem['title'] }}
                            </h3>

                            @if (!empty($item->content))

                                <p class="stream-announcement-text">
                                    {{ $item->content }}
                                </p>

                            @endif

                        </div>

                    {{-- CLASSWORK --}}
                    @else

                        @if ($detailRoute)

                            <a
                                href="{{ $detailRoute }}"
                                class="stream-item-content-link stream-modern-link"
                            >

                                <div class="stream-modern-title-row">

                                    <h3 class="stream-item-title">
                                        {{ $streamItem['title'] }}
                                    </h3>

                                </div>


                                @if ($topic)

                                    <span class="stream-item-topic">

                                        <i class="bx bx-folder"></i>

                                        {{ $topic->topic_name }}

                                    </span>

                                @endif


                                @if ($type === 'project')

                                    <div class="stream-project-meta">

                                        <span class="stream-project-badge">
                                            <i class="bx bx-briefcase-alt-2"></i>
                                            Project
                                        </span>

                                        <span class="stream-project-type">
                                            <i class="bx bx-group"></i>
                                            {{ ucfirst($item->project_type ?? 'individual') }}
                                        </span>

                                    </div>

                                @endif

                            </a>

                        @else

                            <h3 class="stream-item-title">
                                {{ $streamItem['title'] }}
                            </h3>

                        @endif

                    @endif

                </div>

            </article>

        @empty

            <div class="classroom-stream-empty">

                <div class="classroom-stream-empty-icon">
                    <i class="bx bx-news"></i>
                </div>

                <h3>
                    No activity yet
                </h3>

                <p>
                    Announcements, materials, assignments,
                    quizzes, exams, and projects will appear here.
                </p>

            </div>

        @endforelse

    </div>

</div>

            </section>

        </div>

    </main>


    {{-- ============================================================
         CLASS INFORMATION MODAL
    ============================================================= --}}
    <div
        class="classroom-info-modal"
        id="classroomInfoModal"
        aria-hidden="true">


        {{-- OVERLAY --}}
        <div
            class="classroom-info-modal-overlay"
            id="classroomInfoModalOverlay">
        </div>


        {{-- DIALOG --}}
        <div
            class="classroom-info-dialog"
            role="dialog"
            aria-modal="true"
            aria-labelledby="classroomInfoTitle">


            {{-- ====================================================
                 HEADER
            ===================================================== --}}
            <div class="classroom-info-header">

                <div>

                    <span class="classroom-info-eyebrow">
                        CLASS INFORMATION
                    </span>

                    <h2 id="classroomInfoTitle">
                        {{ $classGroup->group_name }}
                    </h2>

                    <p>
                        View information about this class.
                    </p>

                </div>


                <button
                    type="button"
                    class="classroom-info-close"
                    id="closeClassroomInfo"
                    aria-label="Close">

                    <i class="bx bx-x"></i>

                </button>

            </div>


            {{-- ====================================================
                 BODY
            ===================================================== --}}
            <div class="classroom-info-body">


                {{-- CLASS NAME --}}
                <div class="classroom-info-item">

                    <span class="classroom-info-label">
                        CLASS NAME
                    </span>

                    <strong>
                        {{ $classGroup->group_name }}
                    </strong>

                </div>


                {{-- COURSE --}}
                <div class="classroom-info-item">

                    <span class="classroom-info-label">
                        COURSE
                    </span>

                    <strong>
                        {{ $classGroup->course->course_name }}
                    </strong>

                </div>


                {{-- PROFESSOR --}}
                <div class="classroom-info-item">

                    <span class="classroom-info-label">
                        PROFESSOR
                    </span>

                    <strong>
                        {{ $classGroup->professor->name ?? 'N/A' }}
                    </strong>

                </div>


                {{-- DESCRIPTION --}}
                <div class="classroom-info-item classroom-info-description">

                    <span class="classroom-info-label">
                        DESCRIPTION
                    </span>

                    <p>
                        {{ $classGroup->description ?: 'No description provided.' }}
                    </p>

                </div>

            </div>


            {{-- ====================================================
                 ACTIONS
            ===================================================== --}}
            <div class="classroom-info-actions">

                <button
                    type="button"
                    class="classroom-info-cancel"
                    id="cancelClassroomInfo">

                    Close

                </button>

            </div>

        </div>

    </div>


    {{-- ================================================================
     PAGE JAVASCRIPT
================================================================ --}}
<script>

document.addEventListener('DOMContentLoaded', function () {


    /* ============================================================
       CLASS INFORMATION MODAL
    ============================================================ */

    const openClassInformation =
        document.getElementById('openClassInformation');

    const classroomInfoModal =
        document.getElementById('classroomInfoModal');

    const classroomInfoModalOverlay =
        document.getElementById('classroomInfoModalOverlay');

    const closeClassroomInfo =
        document.getElementById('closeClassroomInfo');

    const cancelClassroomInfo =
        document.getElementById('cancelClassroomInfo');


    function openClassInfo() {

        if (!classroomInfoModal) {
            return;
        }

        classroomInfoModal.classList.add('show');

        classroomInfoModal.setAttribute(
            'aria-hidden',
            'false'
        );

        document.body.style.overflow = 'hidden';
    }


    function closeClassInfo() {

        if (!classroomInfoModal) {
            return;
        }

        classroomInfoModal.classList.remove('show');

        classroomInfoModal.setAttribute(
            'aria-hidden',
            'true'
        );

        document.body.style.overflow = '';
    }


    if (openClassInformation) {

        openClassInformation.addEventListener(
            'click',
            openClassInfo
        );

    }


    if (closeClassroomInfo) {

        closeClassroomInfo.addEventListener(
            'click',
            closeClassInfo
        );

    }


    if (cancelClassroomInfo) {

        cancelClassroomInfo.addEventListener(
            'click',
            closeClassInfo
        );

    }


    if (classroomInfoModalOverlay) {

        classroomInfoModalOverlay.addEventListener(
            'click',
            closeClassInfo
        );

    }



    /* ============================================================
       ESCAPE KEY
    ============================================================ */

    document.addEventListener(
        'keydown',
        function (event) {

            if (event.key !== 'Escape') {
                return;
            }


            if (
                classroomInfoModal &&
                classroomInfoModal.classList.contains('show')
            ) {

                closeClassInfo();

            }

        }
    );

});

</script>

@endsection