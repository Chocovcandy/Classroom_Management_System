<style>
    /* ============================================================
   CLASSWORK SHOW PAGE
   Shared by:
   - Assignment
   - Material
   - Quiz
   - Exam
   ============================================================ */

    .classwork-show-page {
        width: 100%;
        max-width: 1200px;
        margin: 0 auto;
        padding: 30px 24px 50px;
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
        gap: 8px;

        margin-bottom: 24px;

        color: var(--text-secondary);
        text-decoration: none;

        font-size: 14px;
        font-weight: 500;

        transition:
            color 0.2s ease,
            transform 0.2s ease;
    }

    .classwork-back-btn i {
        font-size: 20px;
    }

    .classwork-back-btn:hover {
        color: var(--primary-color);
        transform: translateX(-3px);
    }


    /* ============================================================
   HEADING
   ============================================================ */

    .classwork-show-heading {
        display: flex;
        align-items: center;
        gap: 18px;
    }

    .classwork-show-icon {
        width: 58px;
        height: 58px;

        flex-shrink: 0;

        display: flex;
        align-items: center;
        justify-content: center;

        border-radius: 14px;

        font-size: 28px;
    }

    .classwork-show-icon.material {
        background: rgba(59, 130, 246, 0.12);
        color: #3b82f6;
    }

    .classwork-show-icon.assignment {
        background: rgba(16, 185, 129, 0.12);
        color: #10b981;
    }

    .classwork-show-icon.quiz {
        background: rgba(139, 92, 246, 0.12);
        color: #8b5cf6;
    }

    .classwork-show-icon.exam {
        background: rgba(239, 68, 68, 0.12);
        color: #ef4444;
    }


    /* ============================================================
   TYPE LABEL
   ============================================================ */

    .classwork-show-type {
        display: block;

        margin-bottom: 5px;

        font-size: 11px;
        font-weight: 700;
        letter-spacing: 1px;
    }

    .classwork-show-type.material {
        color: #3b82f6;
    }

    .classwork-show-type.assignment {
        color: #10b981;
    }

    .classwork-show-type.quiz {
        color: #8b5cf6;
    }

    .classwork-show-type.exam {
        color: #ef4444;
    }


    /* ============================================================
   TITLE
   ============================================================ */

    .classwork-show-heading h1 {
        margin: 0;

        color: var(--text-color);

        font-size: 30px;
        line-height: 1.25;
        font-weight: 700;

        word-break: break-word;
    }


    /* ============================================================
   TOPIC
   ============================================================ */

    .classwork-show-topic {
        display: inline-flex;
        align-items: center;
        gap: 6px;

        margin-top: 8px;

        color: var(--text-secondary);

        font-size: 13px;
        font-weight: 500;
    }

    .classwork-show-topic i {
        font-size: 16px;
    }


    /* ============================================================
   MAIN GRID
   ============================================================ */

    .classwork-show-grid {
        display: grid;
        grid-template-columns: minmax(0, 1fr) 320px;
        gap: 24px;

        align-items: start;
    }

    .classwork-show-main {
        min-width: 0;
    }

    .classwork-show-sidebar {
        display: flex;
        flex-direction: column;
        gap: 20px;

        min-width: 0;
    }


    /* ============================================================
   DETAIL CARD
   ============================================================ */

    .classwork-detail-card {
        background: var(--card-color);

        border: 1px solid var(--border-color);
        border-radius: 16px;

        overflow: hidden;

        margin-bottom: 20px;
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
        justify-content: space-between;

        padding: 18px 20px;

        border-bottom: 1px solid var(--border-color);
    }

    .classwork-detail-card-header h2 {
        margin: 0;

        color: var(--text-color);

        font-size: 16px;
        font-weight: 650;
    }


    /* ============================================================
   DESCRIPTION
   ============================================================ */

    .classwork-description {
        padding: 22px 20px;

        color: var(--text-secondary);

        font-size: 14px;
        line-height: 1.75;

        min-height: 80px;

        overflow-wrap: anywhere;
    }

    .classwork-no-content {
        color: var(--text-muted);

        font-style: italic;
    }


    /* ============================================================
   SUBMISSION SUMMARY
   ============================================================ */

    .submission-summary {
        display: flex;
        align-items: center;
        gap: 14px;

        margin: 20px;

        padding: 16px;

        background: var(--background-color);

        border: 1px solid var(--border-color);
        border-radius: 12px;
    }

    .submission-summary-icon {
        width: 42px;
        height: 42px;

        flex-shrink: 0;

        display: flex;
        align-items: center;
        justify-content: center;

        border-radius: 10px;

        background: rgba(59, 130, 246, 0.12);
        color: var(--primary-color);

        font-size: 21px;
    }

    .submission-summary div:last-child {
        display: flex;
        flex-direction: column;
        gap: 3px;
    }

    .submission-summary strong {
        color: var(--text-color);

        font-size: 16px;
        font-weight: 700;
    }

    .submission-summary span {
        color: var(--text-secondary);

        font-size: 12px;
    }


    /* ============================================================
   SUBMISSION PLACEHOLDER
   ============================================================ */

    .submission-placeholder {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;

        padding: 35px 20px;

        text-align: center;

        border-top: 1px solid var(--border-color);
    }

    .submission-placeholder i {
        margin-bottom: 10px;

        color: var(--text-muted);

        font-size: 30px;
    }

    .submission-placeholder p {
        margin: 0;

        color: var(--text-secondary);

        font-size: 13px;
    }


    /* ============================================================
   FILE / ATTACHMENT
   ============================================================ */

    .classwork-file {
        display: flex;
        align-items: center;
        gap: 14px;

        margin: 20px;
        padding: 15px;

        background: var(--background-color);

        border: 1px solid var(--border-color);
        border-radius: 12px;
    }

    .classwork-file-icon {
        width: 45px;
        height: 45px;

        flex-shrink: 0;

        display: flex;
        align-items: center;
        justify-content: center;

        border-radius: 10px;

        background: rgba(59, 130, 246, 0.12);
        color: #3b82f6;

        font-size: 23px;
    }

    .classwork-file-info {
        min-width: 0;

        display: flex;
        flex-direction: column;
        gap: 4px;
    }

    .classwork-file-info strong {
        color: var(--text-color);

        font-size: 14px;
        font-weight: 600;

        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }

    .classwork-file-info span {
        color: var(--text-secondary);

        font-size: 12px;
    }


    /* ============================================================
   INFORMATION LIST
   ============================================================ */

    .classwork-info-list {
        display: flex;
        flex-direction: column;
    }

    .classwork-info-item {
        display: flex;
        align-items: center;
        gap: 13px;

        padding: 16px 20px;

        border-bottom: 1px solid var(--border-color);
    }

    .classwork-info-item:last-child {
        border-bottom: none;
    }

    .classwork-info-item>i {
        width: 20px;

        flex-shrink: 0;

        color: var(--text-secondary);

        font-size: 19px;
    }

    .classwork-info-item>div {
        min-width: 0;

        display: flex;
        flex-direction: column;
        gap: 3px;
    }

    .classwork-info-item span {
        color: var(--text-secondary);

        font-size: 12px;
    }

    .classwork-info-item strong {
        color: var(--text-color);

        font-size: 14px;
        font-weight: 600;
    }


    /* ============================================================
   ACTIONS
   ============================================================ */

    .classwork-action-btn {
        display: flex;
        align-items: center;
        gap: 10px;

        margin: 15px 20px 20px;
        padding: 12px 15px;

        background: var(--background-color);

        border: 1px solid var(--border-color);
        border-radius: 10px;

        color: var(--text-color);
        text-decoration: none;

        font-size: 14px;
        font-weight: 600;

        transition:
            background-color 0.2s ease,
            border-color 0.2s ease,
            color 0.2s ease,
            transform 0.2s ease;
    }

    .classwork-action-btn i {
        font-size: 18px;
    }

    .classwork-action-btn:hover {
        background: var(--hover-color, rgba(0, 0, 0, 0.04));
        border-color: var(--primary-color);
        color: var(--primary-color);

        transform: translateY(-1px);
    }


    /* ============================================================
   TYPE-SPECIFIC ACTION BUTTONS
   ============================================================ */

    .classwork-action-btn.material:hover {
        border-color: #3b82f6;
        color: #3b82f6;
    }

    .classwork-action-btn.assignment:hover {
        border-color: #10b981;
        color: #10b981;
    }

    .classwork-action-btn.quiz:hover {
        border-color: #8b5cf6;
        color: #8b5cf6;
    }

    .classwork-action-btn.exam:hover {
        border-color: #ef4444;
        color: #ef4444;
    }

    /* ============================================================
   ATTACHED FILE
============================================================ */

    .classwork-file {
        display: flex;
        align-items: center;
        gap: 14px;

        padding: 16px;

        background: var(--background-color);
        border: 1px solid var(--border-color);
        border-radius: 12px;

        transition: border-color 0.2s ease,
            box-shadow 0.2s ease;
    }

    /* ============================================================
   MULTIPLE ATTACHED FILES
============================================================ */

    .classwork-detail-card .classwork-file+.classwork-file {
        margin-top: 10px;
    }

    .classwork-file:hover {
        border-color: var(--primary-color);
        box-shadow: 0 4px 14px rgba(0, 0, 0, 0.06);
    }


    /* ============================================================
   FILE ICON
============================================================ */

    .classwork-file-icon {
        width: 46px;
        height: 46px;

        flex-shrink: 0;

        display: flex;
        align-items: center;
        justify-content: center;

        border-radius: 10px;

        background: rgba(59, 130, 246, 0.1);
    }

    .classwork-file-icon i {
        font-size: 24px;
        color: var(--primary-color);
    }


    /* ============================================================
   FILE INFORMATION
============================================================ */

    .classwork-file-info {
        min-width: 0;

        flex: 1;

        display: flex;
        flex-direction: column;

        gap: 4px;
    }

    .classwork-file-info strong {
        font-size: 14px;
        font-weight: 600;

        color: var(--text-color);

        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }

    .classwork-file-info span {
        font-size: 12px;

        color: var(--text-muted);
    }


    /* ============================================================
   OPEN BUTTON
============================================================ */

    .classwork-file-open {
        flex-shrink: 0;

        display: inline-flex;
        align-items: center;
        justify-content: center;

        gap: 7px;

        padding: 9px 15px;

        border: 1px solid var(--border-color);
        border-radius: 8px;

        background: var(--card-color);

        color: var(--text-color);

        font-size: 13px;
        font-weight: 600;

        cursor: pointer;

        transition:
            background-color 0.2s ease,
            border-color 0.2s ease,
            color 0.2s ease,
            transform 0.2s ease,
            box-shadow 0.2s ease;
    }

    .classwork-file-open i {
        font-size: 17px;
    }


    /* Hover */

    .classwork-file-open:hover {
        background: var(--primary-color);

        border-color: var(--primary-color);

        color: #fff;

        transform: translateY(-1px);

        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    }


    /* Click */

    .classwork-file-open:active {
        transform: translateY(0);
    }


    /* ============================================================
   FILE PREVIEW MODAL
============================================================ */

    .file-preview-modal {
        position: fixed;

        inset: 0;

        z-index: 9999;

        display: none;

        align-items: center;
        justify-content: center;
    }

    .file-preview-modal.active {
        display: flex;
    }


    /* ============================================================
   MODAL OVERLAY
============================================================ */

    .file-preview-overlay {
        position: absolute;

        inset: 0;

        background: rgba(0, 0, 0, 0.75);

        backdrop-filter: blur(4px);
    }


    /* ============================================================
   MODAL CONTAINER
============================================================ */

    .file-preview-container {
        position: relative;

        z-index: 2;

        width: 92%;
        height: 90%;

        display: flex;
        flex-direction: column;

        overflow: hidden;

        background: var(--card-color);

        border-radius: 16px;

        box-shadow:
            0 25px 70px rgba(0, 0, 0, 0.35);
    }


    /* ============================================================
   MODAL HEADER
============================================================ */

    .file-preview-header {
        min-height: 62px;

        padding: 0 16px 0 20px;

        display: flex;
        align-items: center;
        justify-content: space-between;

        gap: 15px;

        background: var(--card-color);

        border-bottom: 1px solid var(--border-color);
    }


    /* ============================================================
   MODAL FILE TITLE
============================================================ */

    .file-preview-title {
        min-width: 0;

        display: flex;
        align-items: center;

        gap: 10px;
    }

    .file-preview-title i {
        flex-shrink: 0;

        font-size: 21px;

        color: var(--primary-color);
    }

    .file-preview-title span {
        max-width: 500px;

        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;

        font-size: 14px;
        font-weight: 600;

        color: var(--text-color);
    }


    /* ============================================================
   MODAL ACTIONS
============================================================ */

    .file-preview-actions {
        display: flex;
        align-items: center;

        gap: 5px;
    }


    /* ============================================================
   MODAL ACTION BUTTONS
============================================================ */

    .file-preview-btn {
        width: 38px;
        height: 38px;

        display: flex;
        align-items: center;
        justify-content: center;

        border: none;
        border-radius: 8px;

        background: transparent;

        color: var(--text-color);

        font-size: 20px;

        cursor: pointer;

        transition:
            background-color 0.2s ease,
            color 0.2s ease,
            transform 0.2s ease;
    }

    .file-preview-btn:hover {
        background: var(--hover-color);

        transform: translateY(-1px);
    }


    /* Close button */

    .file-preview-btn.close:hover {
        background: rgba(220, 38, 38, 0.1);

        color: #dc2626;
    }


    /* ============================================================
   PREVIEW BODY
============================================================ */

    .file-preview-body {
        flex: 1;

        min-height: 0;

        background: #525252;
    }

    .file-preview-body iframe {
        width: 100%;
        height: 100%;

        display: block;

        border: none;
    }


    /* ============================================================
   PREVENT PAGE SCROLL
============================================================ */

    body.modal-open {
        overflow: hidden;
    }


    /* ============================================================
   FULLSCREEN
============================================================ */

    .file-preview-container:fullscreen {
        width: 100%;
        height: 100%;

        border-radius: 0;

        box-shadow: none;
    }

    .file-preview-container:fullscreen .file-preview-header {
        min-height: 60px;
    }


    /* ============================================================
   GOOGLE FORM QUIZ
============================================================ */

    .google-form-section {
        margin-top: 20px;
    }

    .google-form-box {
        padding: 25px 20px;
        text-align: center;
    }

    .google-form-box>i {
        display: block;
        font-size: 38px;
        margin-bottom: 12px;
    }

    .google-form-box p {
        margin: 0 0 18px;
        color: var(--text-secondary);
        font-size: 14px;
    }

    .google-form-open {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;

        padding: 10px 18px;

        border-radius: 8px;

        text-decoration: none;

        font-size: 14px;
        font-weight: 600;

        transition: all 0.2s ease;
    }

    .google-form-open:hover {
        transform: translateY(-1px);
    }


    /* ============================================================
   QUIZ STUDENT SUBMISSIONS
============================================================ */

.quiz-submission-item {
    display: flex;
    align-items: center;
    gap: 14px;

    margin: 0 16px 10px;
    padding: 14px;

    background: var(--background-color);
    border: 1px solid var(--border-color);
    border-radius: 12px;

    transition:
        border-color 0.2s ease,
        box-shadow 0.2s ease,
        transform 0.2s ease;
}

.quiz-submission-item:hover {
    border-color: var(--primary-color);

    box-shadow:
        0 4px 14px rgba(0, 0, 0, 0.06);

    transform: translateY(-1px);
}


/* ============================================================
   STUDENT
============================================================ */

.quiz-submission-student {
    min-width: 0;

    flex: 1;

    display: flex;
    align-items: center;
    gap: 12px;
}


/* ============================================================
   AVATAR
============================================================ */

.quiz-submission-avatar {
    width: 42px;
    height: 42px;

    flex-shrink: 0;

    display: flex;
    align-items: center;
    justify-content: center;

    overflow: hidden;

    border-radius: 50%;

    background: rgba(139, 92, 246, 0.12);
    color: #8b5cf6;

    font-size: 19px;
}

.quiz-submission-avatar img {
    width: 100%;
    height: 100%;

    object-fit: cover;
}


/* ============================================================
   STUDENT INFORMATION
============================================================ */

.quiz-submission-student-info {
    min-width: 0;

    display: flex;
    flex-direction: column;

    gap: 4px;
}

.quiz-submission-student-info strong {
    color: var(--text-color);

    font-size: 13px;
    font-weight: 600;

    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
}

.quiz-submission-student-info span {
    color: var(--text-secondary);

    font-size: 11px;
}


/* ============================================================
   STATUS
============================================================ */

.quiz-submission-status {
    flex-shrink: 0;
}

.quiz-submission-status-badge {
    display: inline-flex;
    align-items: center;
    gap: 5px;

    padding: 6px 9px;

    border-radius: 7px;

    font-size: 10px;
    font-weight: 600;
}

.quiz-submission-status-badge i {
    font-size: 13px;
}

.quiz-submission-status-badge.submitted {
    background: rgba(16, 185, 129, 0.10);
    color: #10b981;
}


/* ============================================================
   VIEW SUBMISSION BUTTON
============================================================ */

.quiz-submission-view {
    flex-shrink: 0;

    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 6px;

    padding: 9px 12px;

    background: var(--card-color);

    border: 1px solid var(--border-color);
    border-radius: 8px;

    color: var(--text-color);

    text-decoration: none;

    font-size: 11px;
    font-weight: 600;

    transition:
        background-color 0.2s ease,
        border-color 0.2s ease,
        color 0.2s ease,
        transform 0.2s ease;
}

.quiz-submission-view i {
    font-size: 15px;
}

.quiz-submission-view:hover {
    background: #8b5cf6;

    border-color: #8b5cf6;

    color: #fff;

    transform: translateY(-1px);
}

/* ============================================================
   STUDENT SUBMISSIONS
============================================================ */

.submission-list {
    display: flex;
    flex-direction: column;

    gap: 12px;

    margin-top: 18px;
}


/* ============================================================
   SUBMISSION ITEM
============================================================ */

.submission-item {
    display: flex;
    align-items: center;

    gap: 14px;

    margin: 0 16px;

    padding: 16px;

    border: 1px solid var(--border-color);

    border-radius: 12px;

    background: var(--card-color);

    transition:
        border-color 0.2s ease,
        box-shadow 0.2s ease,
        transform 0.2s ease;
}

.submission-item:hover {

    border-color: var(--primary-color);

    box-shadow:
        0 4px 14px rgba(0, 0, 0, 0.06);

    transform: translateY(-1px);
}


/* ============================================================
   STUDENT ICON
============================================================ */

.submission-student-icon {
    width: 42px;
    height: 42px;

    flex-shrink: 0;

    display: flex;
    align-items: center;
    justify-content: center;

    overflow: hidden;

    border-radius: 50%;

    background: rgba(139, 92, 246, 0.12);

    color: #8b5cf6;

    font-size: 20px;
}

.submission-student-icon img {
    width: 100%;
    height: 100%;

    object-fit: cover;
}


/* ============================================================
   STUDENT INFORMATION
============================================================ */

.submission-student-info {
    flex: 1;

    min-width: 0;

    display: flex;
    flex-direction: column;

    gap: 4px;
}

.submission-student-info strong {

    color: var(--text-color);

    font-size: 15px;

    font-weight: 600;

    overflow: hidden;

    text-overflow: ellipsis;

    white-space: nowrap;
}

.submission-student-info span {

    color: var(--text-secondary);

    font-size: 13px;
}


/* ============================================================
   GRADING STATUS
============================================================ */

.submission-grade-status {

    display: inline-flex;

    align-items: center;

    gap: 6px;

    padding: 6px 10px;

    border-radius: 8px;

    font-size: 12px;

    font-weight: 650;

    white-space: nowrap;
}


/* ============================================================
   GRADED
============================================================ */

.submission-grade-status.graded {

    background: rgba(34, 197, 94, 0.10);

    color: #16a34a;
}

.submission-grade-status.graded i {

    font-size: 15px;
}


/* ============================================================
   UNGRADED
============================================================ */

.submission-grade-status.ungraded {

    background: rgba(245, 158, 11, 0.10);

    color: #d97706;
}

.submission-grade-status.ungraded i {

    font-size: 15px;
}


/* ============================================================
   SCORE
============================================================ */

.submission-grade-score {

    margin-left: 4px;

    font-weight: 700;
}


/* ============================================================
   VIEW SUBMISSION
============================================================ */

.submission-view-btn {

    display: inline-flex;

    align-items: center;
    justify-content: center;

    gap: 7px;

    flex-shrink: 0;

    padding: 9px 14px;

    border-radius: 8px;

    background: var(--background-color);

    border: 1px solid var(--border-color);

    color: var(--text-color);

    text-decoration: none;

    font-size: 13px;

    font-weight: 600;

    transition:
        background-color 0.2s ease,
        border-color 0.2s ease,
        color 0.2s ease,
        transform 0.2s ease;
}

.submission-view-btn i {

    font-size: 16px;
}

.submission-view-btn:hover {

    background: #8b5cf6;

    border-color: #8b5cf6;

    color: #fff;

    transform: translateY(-1px);
}
/* ============================================================
   MOBILE
============================================================ */

@media (max-width: 650px) {

    .quiz-submission-item {
        flex-wrap: wrap;
    }

    .quiz-submission-student {
        width: 100%;
    }

    .quiz-submission-status {
        margin-left: 54px;
    }

    .quiz-submission-view {
        margin-left: auto;
    }

}
    /* ============================================================
   RESPONSIVE
============================================================ */

    @media (max-width: 768px) {

        .classwork-file {
            align-items: flex-start;
        }

        .classwork-file-open {
            padding: 8px 12px;
        }

        .file-preview-container {
            width: 96%;
            height: 94%;

            border-radius: 12px;
        }

        .file-preview-title span {
            max-width: 250px;
        }
    }


    @media (max-width: 520px) {

        .classwork-file {
            flex-wrap: wrap;
        }

        .classwork-file-info {
            max-width: calc(100% - 60px);
        }

        .classwork-file-open {
            width: 100%;
        }

        .file-preview-container {
            width: 100%;
            height: 100%;

            border-radius: 0;
        }

        .file-preview-header {
            padding: 0 10px;
        }

        .file-preview-title span {
            max-width: 160px;
        }

    }

    /* ============================================================
   RESPONSIVE
   ============================================================ */

    @media (max-width: 900px) {

        .classwork-show-grid {
            grid-template-columns: 1fr;
        }

        .classwork-show-sidebar {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 20px;
        }

    }


    @media (max-width: 650px) {

        .classwork-show-page {
            padding: 20px 15px 40px;
        }

        .classwork-show-heading {
            align-items: flex-start;
        }

        .classwork-show-icon {
            width: 50px;
            height: 50px;

            border-radius: 12px;

            font-size: 24px;
        }

        .classwork-show-heading h1 {
            font-size: 23px;
        }

        .classwork-show-grid {
            gap: 16px;
        }

        .classwork-detail-card {
            border-radius: 13px;
        }

        .classwork-show-sidebar {
            display: flex;
            flex-direction: column;
            gap: 16px;
        }

        .classwork-detail-card-header {
            padding: 16px;
        }

        .classwork-description {
            padding: 18px 16px;
        }

        .submission-summary {
            margin: 16px;
        }

        .classwork-file {
            margin: 16px;
        }

    }


    /* ============================================================
   DARK MODE SUPPORT
   ============================================================ */

    [data-theme="dark"] .classwork-action-btn:hover {
        background: rgba(255, 255, 255, 0.05);
    }
</style>

@extends('layouts.prof_layout')

@section('content')

<div class="classwork-show-page">

    {{-- HEADER --}}

    <div class="classwork-show-header">

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
            class="classwork-back-btn">
            <i class="bx bx-arrow-back"></i>

            {{ $returnTo === 'classwork'
                    ? 'Back to Classwork'
                    : 'Back to Stream'
                }}
        </a>

        <div class="classwork-show-heading">

            <div class="classwork-show-icon quiz">
                <i class="bx bx-help-circle"></i>
            </div>

            <div>

                <span class="classwork-show-type quiz">
                    QUIZ
                </span>

                <h1>
                    {{ $quiz->title }}
                </h1>

                @if($quiz->topic)

                <div class="classwork-show-topic">

                    <i class="bx bx-folder"></i>

                    {{ $quiz->topic->topic_name }}

                </div>

                @endif

            </div>

        </div>

    </div>


    <div class="classwork-show-grid">

        <div class="classwork-show-main">

            {{-- DESCRIPTION --}}

            <section class="classwork-detail-card">

                <div class="classwork-detail-card-header">

                    <h2>
                        Quiz Instructions
                    </h2>

                </div>

                <div class="classwork-description">

                    @if($quiz->description)

                    {!! nl2br(e($quiz->description)) !!}

                    @else

                    <span class="classwork-no-content">
                        No description provided.
                    </span>

                    @endif

                </div>

            </section>

            {{-- GOOGLE FORM QUIZ --}}
            @if($quiz->google_form_url)
            <section class="classwork-detail-card google-form-section">

                <div class="classwork-detail-card-header">
                    <h2>
                        <i class="bx bx-link-external"></i>
                        Google Form Quiz
                    </h2>
                </div>

                <div class="google-form-box">

                    <i class="bx bxl-google"></i>

                    <p>
                        This quiz is provided through Google Forms.
                    </p>

                    <a
                        href="{{ $quiz->google_form_url }}"
                        target="_blank"
                        rel="noopener noreferrer"
                        class="google-form-open">
                        <i class="bx bx-link-external"></i>
                        Open Google Form
                    </a>

                </div>

            </section>
            @endif


            {{-- ============================================================
                ATTACHED MATERIAL
            ============================================================ --}}

            <section class="classwork-detail-card">

                <div class="classwork-detail-card-header">

                    <h2>
                        Attached Material
                    </h2>

                </div>


                {{-- ========================================================
                    LEGACY SINGLE ATTACHMENT
                ========================================================= --}}

                @if($quiz->attachment)

                <div class="classwork-file">

                    <div class="classwork-file-icon">

                        <i class="bx bx-file"></i>

                    </div>


                    <div class="classwork-file-info">

                        <strong>
                            {{ basename($quiz->attachment) }}
                        </strong>

                        <span>
                            Quiz attachment
                        </span>

                    </div>


                    <button
                        type="button"
                        class="classwork-file-open"
                        data-file-url="{{ asset('storage/' . $quiz->attachment) }}"
                        data-file-title="{{ basename($quiz->attachment) }}">
                        <i class="bx bx-show"></i>
                        Open
                    </button>

                </div>

                @endif


                {{-- ========================================================
                    RESOURCE FILES
                ========================================================= --}}

                @forelse($quiz->resources as $resource)

                <div class="classwork-file">

                    <div class="classwork-file-icon">

                        <i class="bx bx-file"></i>

                    </div>


                    <div class="classwork-file-info">

                        <strong>
                            {{ $resource->file_name ?? $resource->title }}
                        </strong>

                        <span>

                            @if($resource->file_size)

                            {{ number_format($resource->file_size / 1024, 1) }}
                            KB

                            @else

                            Quiz attachment

                            @endif

                        </span>

                    </div>


                    @if($resource->file_path)

                    <button
                        type="button"
                        class="classwork-file-open"
                        data-file-url="{{ asset('storage/' . $resource->file_path) }}"
                        data-file-title="{{ $resource->file_name ?? $resource->title }}">
                        <i class="bx bx-show"></i>
                        Open
                    </button>

                    @endif

                </div>

                @empty

                @if(!$quiz->attachment)

                <div class="submission-placeholder">

                    <i class="bx bx-file-blank"></i>

                    <p>
                        No attached material.
                    </p>

                </div>

                @endif

                @endforelse

            </section>


{{-- ============================================================
    STUDENT SUBMISSIONS
============================================================= --}}

<section class="classwork-detail-card">

    <div class="classwork-detail-card-header">

        <h2>
            Student Submissions
        </h2>

    </div>


    {{-- ========================================================
        SUBMISSION SUMMARY
    ========================================================= --}}

    <div class="submission-summary">

        <div class="submission-summary-icon">

            <i class="bx bx-group"></i>

        </div>

        @php
            $submittedCount = $quiz->submissions->count();
            $totalStudents = $classGroup->students->count();
        @endphp

        <div>

            <strong>
                {{ $submittedCount }} / {{ $totalStudents }}
            </strong>

            <span>
                Students submitted
            </span>

        </div>

    </div>


    {{-- ========================================================
        SUBMITTED STUDENTS
    ========================================================= --}}

    @if($quiz->submissions->isNotEmpty())

        <div class="submission-list">

            @foreach($quiz->submissions as $submission)

                <div class="submission-item">

                    {{-- ==================================================
                        STUDENT ICON
                    =================================================== --}}

                    <div class="submission-student-icon">

                        @if($submission->student?->profile_image)

                            <img
                                src="{{ asset('storage/' . $submission->student->profile_image) }}"
                                alt="{{ $submission->student->name }}"
                                style="
                                    width: 100%;
                                    height: 100%;
                                    object-fit: cover;
                                    border-radius: 50%;
                                "
                            >

                        @else

                            <i class="bx bx-user"></i>

                        @endif

                    </div>


                    {{-- ==================================================
                        STUDENT INFORMATION
                    =================================================== --}}

                    <div class="submission-student-info">

                        <strong>
                            {{ $submission->student->name ?? 'Unknown Student' }}
                        </strong>

                        <span>

                            Submitted

                            {{ $submission->submitted_at
                                ? $submission->submitted_at->format('M d, Y \a\t h:i A')
                                : 'Unknown'
                            }}

                        </span>

                    </div>


                    {{-- ==================================================
                        GRADE STATUS
                    =================================================== --}}

                    @if($submission->score !== null)

                        <span class="submission-grade-status graded">

                            <i class="bx bx-check-circle"></i>

                            Graded

                            <span class="submission-grade-score">

                                {{ rtrim(
                                    rtrim(
                                        number_format($submission->score, 2),
                                        '0'
                                    ),
                                    '.'
                                ) }}

                                /

                                {{ rtrim(
                                    rtrim(
                                        number_format($quiz->points, 2),
                                        '0'
                                    ),
                                    '.'
                                ) }}

                            </span>

                        </span>

                    @else

                        <span class="submission-grade-status ungraded">

                            <i class="bx bx-time-five"></i>

                            Ungraded

                        </span>

                    @endif


                    {{-- ==================================================
                        VIEW SUBMISSION
                    =================================================== --}}

                    <a
                        href="{{ route(
                            'professor.class-groups.quizzes.submissions.show',
                            [
                                'classGroup' => $classGroup->id,
                                'quiz' => $quiz->id,
                                'submission' => $submission->id,
                            ]
                        ) }}"
                        class="submission-view-btn"
                    >

                        <i class="bx bx-show"></i>

                        View Submission

                    </a>

                </div>

            @endforeach

        </div>

    @else

        <div class="submission-placeholder">

            <i class="bx bx-time-five"></i>

            <p>
                No students have submitted this quiz yet.
            </p>

        </div>

    @endif

</section>

        </div>


        {{-- SIDEBAR --}}

        <aside class="classwork-show-sidebar">

            <section class="classwork-detail-card">

                <div class="classwork-detail-card-header">

                    <h2>
                        Quiz Details
                    </h2>

                </div>

                <div class="classwork-info-list">

                    <div class="classwork-info-item">

                        <i class="bx bx-star"></i>

                        <div>

                            <span>Points</span>

                            <strong>
                                {{ $quiz->points ?? 0 }}
                            </strong>

                        </div>

                    </div>


                    @if($quiz->due_date)

                    <div class="classwork-info-item">

                        <i class="bx bx-calendar"></i>

                        <div>

                            <span>Due Date</span>

                            <strong>
                                {{ \Carbon\Carbon::parse($quiz->due_date)->format('M d, Y') }}
                            </strong>

                        </div>

                    </div>

                    @endif


                    @if($quiz->due_time)

                    <div class="classwork-info-item">

                        <i class="bx bx-time"></i>

                        <div>

                            <span>Due Time</span>

                            <strong>
                                {{ \Carbon\Carbon::parse($quiz->due_time)->format('h:i A') }}
                            </strong>

                        </div>

                    </div>

                    @endif

                </div>

            </section>


            <section class="classwork-detail-card">

                <div class="classwork-detail-card-header">

                    <h2>
                        Actions
                    </h2>

                </div>
                <a
                    href="{{ route(
                'professor.class-groups.quizzes.edit',
                [
                    'classGroup' => $classGroup->id,
                    'quiz' => $quiz->id,
                    'return_to' => 'show',
                       'origin' => $returnTo,
                ]
            ) }}"
                    class="classwork-action-btn quiz">
                    <i class="bx bx-edit"></i>
                    Edit Quiz
                </a>

            </section>

        </aside>

    </div>

</div>

{{-- ============================================================
    FILE PREVIEW MODAL
============================================================ --}}
<div id="quizPreviewModal" class="file-preview-modal">

    <div class="file-preview-container">

        {{-- MODAL HEADER --}}
        <div class="file-preview-header">

            <div class="file-preview-title">
                <i class="bx bx-file"></i>
                <span>Quiz Attachment</span>
            </div>

            <div class="file-preview-actions">

                {{-- FULL SCREEN --}}
                <button
                    type="button"
                    id="quizFullscreenBtn"
                    class="file-preview-action"
                    title="Full Screen">
                    <i class="bx bx-fullscreen"></i>
                </button>

                {{-- CLOSE --}}
                <button
                    type="button"
                    id="closeQuizPreview"
                    class="file-preview-action"
                    title="Close">
                    <i class="bx bx-x"></i>
                </button>

            </div>

        </div>


        {{-- FILE PREVIEW --}}
        <div class="file-preview-body">

            <iframe
                id="quizPreviewFrame"
                src=""
                frameborder="0"></iframe>

        </div>

    </div>

</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {

        const modal =
            document.getElementById('quizPreviewModal');

        const fileButtons =
            document.querySelectorAll('.classwork-file-open');

        const closeBtn =
            document.getElementById('closeQuizPreview');

        const fullscreenBtn =
            document.getElementById('quizFullscreenBtn');

        const preview =
            document.getElementById('quizPreviewFrame');

        const container =
            document.querySelector('.file-preview-container');

        const previewTitle =
            document.querySelector('.file-preview-title span');


        // ============================================================
        // OPEN FILE
        // ============================================================

        fileButtons.forEach(function(button) {

            button.addEventListener('click', function() {

                const fileUrl =
                    this.dataset.fileUrl;

                const fileTitle =
                    this.dataset.fileTitle ||
                    'Quiz Attachment';


                if (!fileUrl) {
                    return;
                }


                preview.src =
                    fileUrl;


                previewTitle.textContent =
                    fileTitle;


                modal.classList.add('active');

                document.body.classList.add(
                    'modal-open'
                );

            });

        });


        // ============================================================
        // CLOSE MODAL
        // ============================================================

        function closeQuizPreview() {

            modal.classList.remove('active');

            preview.src = '';

            document.body.classList.remove(
                'modal-open'
            );

        }


        closeBtn.addEventListener(
            'click',
            closeQuizPreview
        );


        // ============================================================
        // CLICK OUTSIDE MODAL
        // ============================================================

        modal.addEventListener('click', function(event) {

            if (event.target === modal) {

                closeQuizPreview();

            }

        });


        // ============================================================
        // ESC KEY
        // ============================================================

        document.addEventListener('keydown', function(event) {

            if (
                event.key === 'Escape' &&
                modal.classList.contains('active')
            ) {

                closeQuizPreview();

            }

        });


        // ============================================================
        // FULL SCREEN
        // ============================================================

        fullscreenBtn.addEventListener('click', function() {

            if (!document.fullscreenElement) {

                container.requestFullscreen();

            } else {

                document.exitFullscreen();

            }

        });

    });
</script>
@endsection