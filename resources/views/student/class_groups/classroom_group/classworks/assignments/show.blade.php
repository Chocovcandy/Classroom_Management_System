<style>
    /* ============================================================
   STUDENT ASSIGNMENT SHOW PAGE
============================================================ */

    .classwork-show-page {
        width: 100%;
        max-width: 1200px;
        margin: 0 auto;
        padding: 30px;
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
        font-weight: 600;

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
   HEADER HEADING
============================================================ */

    .classwork-show-heading {
        display: flex;
        align-items: center;
        gap: 18px;
    }

    .classwork-show-icon {
        width: 62px;
        height: 62px;

        display: flex;
        align-items: center;
        justify-content: center;

        flex-shrink: 0;

        border-radius: 16px;

        font-size: 28px;
    }

    .classwork-show-icon.assignment {
        background: rgba(99, 102, 241, 0.12);
        color: #6366f1;
    }

    .classwork-show-type {
        display: block;

        margin-bottom: 4px;

        font-size: 11px;
        font-weight: 700;

        letter-spacing: 0.08em;
    }

    .classwork-show-type.assignment {
        color: #6366f1;
    }

    .classwork-show-heading h1 {
        margin: 0;

        color: var(--text-color);

        font-size: 30px;
        font-weight: 700;

        line-height: 1.25;
    }

    .classwork-show-topic {
        display: inline-flex;
        align-items: center;
        gap: 6px;

        margin-top: 7px;

        color: var(--text-secondary);

        font-size: 13px;
    }

    .classwork-show-topic i {
        font-size: 16px;
    }


    /* ============================================================
   MAIN GRID
============================================================ */

    .classwork-show-grid {
        display: grid;

        grid-template-columns: minmax(0, 1fr) 330px;

        gap: 24px;

        align-items: start;
    }


    /* ============================================================
   MAIN CONTENT
============================================================ */

    .classwork-show-main {
        display: flex;
        flex-direction: column;
        gap: 24px;
    }


    /* ============================================================
   DETAIL CARD
============================================================ */

    .classwork-detail-card {
        background: var(--card-color);

        border: 1px solid var(--border-color);
        border-radius: 16px;

        overflow: hidden;

        box-shadow:
            0 3px 12px rgba(0, 0, 0, 0.035);
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
   DESCRIPTION / INSTRUCTIONS
============================================================ */

    .classwork-description {
        padding: 22px 20px;

        color: var(--text-color);

        font-size: 14px;
        line-height: 1.75;

        min-height: 100px;
    }

    .classwork-description:empty::before {
        content: "No instructions provided.";

        color: var(--text-secondary);

        font-style: italic;
    }

    .classwork-no-content {
        color: var(--text-secondary);
        font-style: italic;
    }


    /* ============================================================
   ATTACHED FILES
============================================================ */

    .classwork-files {
        display: flex;
        flex-direction: column;
        gap: 10px;

        padding: 16px 20px 20px;
    }

    .classwork-file {
        display: flex;
        align-items: center;
        gap: 15px;

        padding: 14px;

        border: 1px solid var(--border-color);
        border-radius: 12px;

        background: var(--card-color);

        min-width: 0;

        transition:
            border-color 0.2s ease,
            background-color 0.2s ease;
    }

    .classwork-file:hover {
        background: var(--background-color);
        border-color: var(--primary-color);
    }


    /* ============================================================
   FILE ICON
============================================================ */

    .classwork-file-icon {
        width: 48px;
        height: 48px;
        min-width: 48px;

        display: flex;
        align-items: center;
        justify-content: center;

        border-radius: 10px;

        background: #f1f5f9;
        color: #475569;

        font-size: 24px;
    }

    .classwork-file-icon.assignment {
        background: rgba(99, 102, 241, 0.12);
        color: #6366f1;
    }


    /* ============================================================
   FILE INFORMATION
============================================================ */

    .classwork-file-info {
        flex: 1;
        min-width: 0;

        display: flex;
        flex-direction: column;
        gap: 4px;
    }

    .classwork-file-info strong {
        display: block;

        font-size: 15px;
        font-weight: 600;

        color: var(--text-color);

        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }

    .classwork-file-info span {
        display: block;

        font-size: 13px;

        color: var(--muted-text);
    }


    /* ============================================================
   OPEN BUTTON
============================================================ */

    .classwork-file-open {
        display: inline-flex;
        align-items: center;
        justify-content: center;

        gap: 7px;

        padding: 9px 16px;

        border: 1px solid var(--border-color);
        border-radius: 9px;

        background: var(--card-color);
        color: var(--text-color);

        font-size: 14px;
        font-weight: 600;

        cursor: pointer;

        text-decoration: none;

        transition:
            background-color 0.2s ease,
            border-color 0.2s ease,
            color 0.2s ease,
            transform 0.2s ease;
    }

    .classwork-file-open:hover {
        background: var(--background-color);

        border-color: var(--primary-color);

        color: var(--primary-color);

        transform: translateY(-1px);
    }

    .classwork-file-open i {
        font-size: 18px;
    }


    /* ============================================================
   NO FILES
============================================================ */

    .classwork-no-files {
        margin: 0 20px 20px;

        padding: 28px 20px;

        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;

        text-align: center;

        border: 1px dashed var(--border-color);
        border-radius: 12px;

        background: var(--background-color);
    }

    .classwork-no-files i {
        margin-bottom: 8px;

        color: var(--text-secondary);

        font-size: 26px;
    }

    .classwork-no-files p {
        margin: 0;

        color: var(--text-secondary);

        font-size: 13px;
    }


    /* ============================================================
   YOUR SUBMISSION
============================================================ */

    .submission-summary {
        display: flex;
        align-items: center;
        gap: 14px;

        padding: 20px;
    }

    .submission-summary-icon {
        width: 46px;
        height: 46px;

        display: flex;
        align-items: center;
        justify-content: center;

        flex-shrink: 0;

        border-radius: 12px;

        background: rgba(99, 102, 241, 0.10);
        color: #6366f1;

        font-size: 22px;
    }

    .submission-summary>div:last-child {
        display: flex;
        flex-direction: column;
        gap: 3px;
    }

    .submission-summary strong {
        color: var(--text-color);

        font-size: 18px;
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
        margin: 0 20px 20px;

        padding: 28px 20px;

        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;

        text-align: center;

        border: 1px dashed var(--border-color);
        border-radius: 12px;

        background: var(--background-color);
    }

    .submission-placeholder i {
        margin-bottom: 8px;

        color: var(--text-secondary);

        font-size: 26px;
    }

    .submission-placeholder p {
        margin: 0;

        color: var(--text-secondary);

        font-size: 13px;
    }


    /* ============================================================
   SUBMITTED FILES
============================================================ */

    .submission-files {
        display: flex;
        flex-direction: column;
        gap: 10px;

        padding: 0 20px 20px;
    }

    .submission-file {
        display: flex;
        align-items: center;
        gap: 14px;

        padding: 12px 14px;

        border: 1px solid var(--border-color);
        border-radius: 10px;

        background: var(--card-color);

        min-width: 0;

        transition:
            border-color 0.2s ease,
            background-color 0.2s ease;
    }

    .submission-file:hover {
        background: var(--background-color);
        border-color: var(--primary-color);
    }

    .submission-file-icon {
        width: 40px;
        height: 40px;

        display: flex;
        align-items: center;
        justify-content: center;

        flex-shrink: 0;

        border-radius: 9px;

        background: rgba(99, 102, 241, 0.10);
        color: #6366f1;

        font-size: 20px;
    }

    .submission-file-info {
        flex: 1;
        min-width: 0;

        display: flex;
        flex-direction: column;
        gap: 3px;
    }

    .submission-file-info strong {
        color: var(--text-color);

        font-size: 14px;
        font-weight: 600;

        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }

    .submission-file-info span {
        color: var(--muted-text);

        font-size: 12px;
    }


    /* ============================================================
   GRADE / FEEDBACK
============================================================ */

    .submission-result {
        margin: 0 20px 20px;

        padding: 16px;

        border: 1px solid var(--border-color);
        border-radius: 12px;

        background: var(--background-color);
    }

    .submission-result-item {
        display: flex;
        align-items: flex-start;
        gap: 10px;

        padding: 10px 0;
    }

    .submission-result-item:first-child {
        padding-top: 0;
    }

    .submission-result-item:last-child {
        padding-bottom: 0;
    }

    .submission-result-item+.submission-result-item {
        border-top: 1px solid var(--border-color);
    }

    .submission-result-item i {
        margin-top: 2px;

        color: var(--primary-color);

        font-size: 18px;
    }

    .submission-result-item>div {
        display: flex;
        flex-direction: column;
        gap: 3px;
    }

    .submission-result-item span {
        color: var(--text-secondary);

        font-size: 12px;
    }

    .submission-result-item strong {
        color: var(--text-color);

        font-size: 14px;
        font-weight: 650;
    }

    .submission-feedback {
        color: var(--text-color);

        font-size: 13px;

        line-height: 1.6;
    }


    /* ============================================================
   SUBMISSION UPLOAD
============================================================ */

    .submission-upload {
        padding: 20px;
    }

    .submission-upload-form {
        display: flex;
        flex-direction: column;
        gap: 16px;
    }

    .submission-upload-label {
        display: flex;
        align-items: center;
        gap: 8px;

        color: var(--text-color);

        font-size: 14px;
        font-weight: 600;
    }

    .submission-upload-label i {
        color: var(--primary-color);

        font-size: 18px;
    }


    /* ============================================================
   FILE INPUT
============================================================ */

    .submission-file-input {
        width: 100%;

        padding: 12px;

        border: 1px solid var(--border-color);
        border-radius: 10px;

        background: var(--background-color);
        color: var(--text-color);

        font-size: 13px;

        cursor: pointer;

        transition:
            border-color 0.2s ease,
            background-color 0.2s ease;
    }

    .submission-file-input:hover {
        border-color: var(--primary-color);
    }

    .submission-file-input:focus {
        outline: none;

        border-color: var(--primary-color);

        box-shadow:
            0 0 0 3px rgba(99, 102, 241, 0.10);
    }


    /* ============================================================
   SUBMIT BUTTON
============================================================ */

    .submission-submit-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;

        gap: 8px;

        min-height: 44px;

        padding: 10px 18px;

        border: 1px solid var(--primary-color);
        border-radius: 10px;

        background: var(--primary-color);
        color: white;

        font-size: 14px;
        font-weight: 600;

        cursor: pointer;

        transition:
            background-color 0.2s ease,
            border-color 0.2s ease,
            transform 0.2s ease,
            box-shadow 0.2s ease;
    }

    .submission-submit-btn:hover {
        transform: translateY(-1px);

        box-shadow:
            0 4px 12px rgba(99, 102, 241, 0.20);
    }

    .submission-submit-btn i {
        font-size: 18px;
    }


    /* ============================================================
   SIDEBAR
============================================================ */

    .classwork-show-sidebar {
        display: flex;
        flex-direction: column;
        gap: 24px;

        position: sticky;
        top: 20px;
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
        width: 36px;
        height: 36px;

        display: flex;
        align-items: center;
        justify-content: center;

        flex-shrink: 0;

        border-radius: 9px;

        background: var(--background-color);

        color: var(--text-secondary);

        font-size: 18px;
    }

    .classwork-info-item>div {
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
        font-weight: 650;
    }


    /* ============================================================
   SUBMISSION STATUS
============================================================ */

    .submission-status {
        display: flex;
        align-items: center;
        gap: 10px;

        padding: 16px 20px;
    }

    .submission-status-icon {
        width: 36px;
        height: 36px;

        display: flex;
        align-items: center;
        justify-content: center;

        flex-shrink: 0;

        border-radius: 9px;

        background: rgba(99, 102, 241, 0.10);
        color: #6366f1;

        font-size: 18px;
    }

    .submission-status-content {
        display: flex;
        flex-direction: column;
        gap: 3px;
    }

    .submission-status-content span {
        color: var(--text-secondary);

        font-size: 12px;
    }

    .submission-status-content strong {
        color: var(--text-color);

        font-size: 14px;
        font-weight: 650;
    }


    /* ============================================================
   ACTION BUTTON
============================================================ */

    .classwork-show-sidebar .classwork-detail-card:last-child {
        overflow: visible;
    }

    .classwork-action-btn {
        display: flex;
        align-items: center;
        gap: 10px;

        margin: 14px 20px 20px;

        min-height: 44px;

        padding: 10px 15px;

        border: 1px solid var(--border-color);
        border-radius: 10px;

        background: transparent;

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
        background: var(--background-color);

        border-color: var(--primary-color);

        color: var(--primary-color);

        transform: translateY(-1px);
    }


    /* ============================================================
   FILE VIEWER MODAL
============================================================ */

    .material-viewer-modal {
        position: fixed;
        inset: 0;

        z-index: 9999;

        display: flex;
        align-items: center;
        justify-content: center;

        padding: 30px;

        background: rgba(0, 0, 0, 0.72);

        opacity: 0;
        visibility: hidden;

        pointer-events: none;

        transition:
            opacity 0.2s ease,
            visibility 0.2s ease;
    }


    /* ============================================================
   ACTIVE MODAL
============================================================ */

    .material-viewer-modal.active {
        opacity: 1;
        visibility: visible;

        pointer-events: auto;
    }


    /* ============================================================
   VIEWER CONTAINER
============================================================ */

    .material-viewer-container {
        width: min(1200px, 100%);
        height: min(850px, 90vh);

        display: flex;
        flex-direction: column;

        background: var(--card-color);

        border: 1px solid var(--border-color);
        border-radius: 14px;

        overflow: hidden;

        box-shadow:
            0 20px 60px rgba(0, 0, 0, 0.3);
    }


    /* ============================================================
   MODAL HEADER
============================================================ */

    .material-viewer-header {
        min-height: 60px;

        display: flex;
        align-items: center;
        justify-content: space-between;

        padding: 0 18px;

        background: var(--card-color);

        border-bottom: 1px solid var(--border-color);
    }


    /* ============================================================
   MODAL TITLE
============================================================ */

    .material-viewer-title {
        display: flex;
        align-items: center;

        gap: 10px;

        min-width: 0;

        color: var(--text-color);

        font-size: 14px;
        font-weight: 650;
    }

    .material-viewer-title i {
        font-size: 20px;

        color: var(--primary-color);
    }

    .material-viewer-title span {
        overflow: hidden;

        text-overflow: ellipsis;

        white-space: nowrap;
    }


    /* ============================================================
   MODAL ACTIONS
============================================================ */

    .material-viewer-actions {
        display: flex;
        align-items: center;

        gap: 6px;
    }

    .material-viewer-btn {
        width: 38px;
        height: 38px;

        display: flex;
        align-items: center;
        justify-content: center;

        padding: 0;

        border: 1px solid var(--border-color);
        border-radius: 8px;

        background: transparent;

        color: var(--text-secondary);

        cursor: pointer;

        transition:
            background-color 0.2s ease,
            color 0.2s ease,
            border-color 0.2s ease;
    }

    .material-viewer-btn:hover {
        background: var(--background-color);

        color: var(--text-color);

        border-color: var(--primary-color);
    }

    .material-viewer-btn.close:hover {
        color: #ef4444;
    }

    .material-viewer-btn i {
        font-size: 20px;
    }


    /* ============================================================
   FILE VIEWER BODY
============================================================ */

    .material-viewer-body {
        flex: 1;

        min-height: 0;

        background: #1a1a1a;
    }

    .material-viewer-body iframe {
        display: block;

        width: 100%;
        height: 100%;

        border: none;

        background: white;
    }


    /* ============================================================
   BODY LOCK
============================================================ */

    body.material-modal-open {
        overflow: hidden;
    }


    /* ============================================================
   BROWSER FULLSCREEN
============================================================ */

    .material-viewer-container:fullscreen {
        width: 100vw;
        height: 100vh;

        border-radius: 0;

        border: none;
    }

    /* ============================================================
   STUDENT SUBMISSION
   ============================================================ */

    .student-submission-card {
        overflow: hidden;
    }


    /* ============================================================
   SUBMISSION STATUS
   ============================================================ */

    .student-submission-status {
        display: flex;
        align-items: center;
        gap: 14px;

        padding: 16px;

        border-radius: 10px;

        background: var(--surface-color);
    }


    .student-submission-status-icon {
        display: flex;
        align-items: center;
        justify-content: center;

        width: 42px;
        height: 42px;

        flex-shrink: 0;

        border-radius: 50%;

        background: var(--student-soft);
        color: var(--student-color);
    }


    .student-submission-status-icon i {
        font-size: 22px;
    }


    .student-submission-status-content {
        display: flex;
        flex-direction: column;
        gap: 3px;
    }


    .student-submission-status-content strong {
        color: var(--heading-color);

        font-size: 14px;
        font-weight: 600;
    }


    .student-submission-status-content span {
        color: var(--activity-description);

        font-size: 12px;
    }


    /* ============================================================
   SUBMITTED FILES
   ============================================================ */

    .student-submission-files {
        margin-top: 20px;
    }


    .student-submission-files-title {
        display: flex;
        align-items: center;
        gap: 7px;

        margin-bottom: 10px;

        color: var(--heading-color);

        font-size: 13px;
        font-weight: 600;
    }


    .student-submission-files-title i {
        font-size: 17px;
    }


    .student-submission-file-list {
        display: flex;
        flex-direction: column;
        gap: 8px;
    }


    .student-submission-file {
        display: flex;
        align-items: center;
        gap: 11px;

        padding: 11px 13px;

        border: 1px solid var(--border-color);
        border-radius: 9px;

        background: var(--card-color);
    }


    .student-submission-file-icon {
        display: flex;
        align-items: center;
        justify-content: center;

        width: 34px;
        height: 34px;

        flex-shrink: 0;

        border-radius: 7px;

        background: var(--student-soft);
        color: var(--student-color);
    }


    .student-submission-file-icon i {
        font-size: 18px;
    }


    .student-submission-file-info {
        min-width: 0;

        display: flex;
        flex-direction: column;
        gap: 2px;
    }


    .student-submission-file-info strong {
        overflow: hidden;

        color: var(--heading-color);

        font-size: 13px;
        font-weight: 500;

        text-overflow: ellipsis;
        white-space: nowrap;
    }


    .student-submission-file-info span {
        color: var(--activity-description);

        font-size: 11px;
    }


    /* ============================================================
   UPLOAD AREA
   ============================================================ */

    .student-submission-upload {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;

        min-height: 190px;

        padding: 25px;

        border: 1.5px dashed var(--border-color);
        border-radius: 12px;

        background: var(--surface-color);

        text-align: center;

        cursor: pointer;

        transition:
            border-color 0.2s ease,
            background-color 0.2s ease;
    }


    .student-submission-upload:hover {
        border-color: var(--student-color);
        background-color: var(--surface-hover);
    }


    .student-submission-upload-icon {
        display: flex;
        align-items: center;
        justify-content: center;

        width: 52px;
        height: 52px;

        margin-bottom: 12px;

        border-radius: 50%;

        background: var(--student-soft);
        color: var(--student-color);
    }


    .student-submission-upload-icon i {
        font-size: 25px;
    }


    .student-submission-upload-content {
        display: flex;
        flex-direction: column;
        gap: 4px;

        margin-bottom: 15px;
    }


    .student-submission-upload-content strong {
        color: var(--heading-color);

        font-size: 14px;
        font-weight: 600;
    }


    .student-submission-upload-content span {
        color: var(--activity-description);

        font-size: 12px;
    }


    /* ============================================================
   BROWSE BUTTON
   ============================================================ */

    .student-submission-browse-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 7px;

        padding: 8px 14px;

        border: 1px solid var(--border-color);
        border-radius: 7px;

        background: var(--card-color);
        color: var(--heading-color);

        font-size: 12px;
        font-weight: 500;

        cursor: pointer;

        transition:
            background-color 0.2s ease,
            border-color 0.2s ease;
    }


    .student-submission-browse-btn:hover {
        border-color: var(--student-color);
    }


    .student-submission-browse-btn i {
        font-size: 16px;
    }


    /* ============================================================
   SELECTED FILES
   ============================================================ */

    .student-submission-selected {
        margin-top: 16px;
    }


    .student-submission-selected-header {
        display: flex;
        align-items: center;
        justify-content: space-between;

        margin-bottom: 9px;

        color: var(--heading-color);

        font-size: 12px;
        font-weight: 600;
    }


    .student-submission-selected-header span:last-child {
        color: var(--activity-description);

        font-weight: 400;
    }


    .student-submission-selected-list {
        display: flex;
        flex-direction: column;
        gap: 7px;
    }


    .student-submission-selected-file {
        display: flex;
        align-items: center;
        gap: 10px;

        padding: 9px 11px;

        border: 1px solid var(--border-color);
        border-radius: 8px;

        background: var(--card-color);
    }


    .student-submission-selected-file-icon {
        color: var(--student-color);

        font-size: 18px;
    }


    .student-submission-selected-file-name {
        flex: 1;
        min-width: 0;

        overflow: hidden;

        color: var(--heading-color);

        font-size: 12px;

        text-overflow: ellipsis;
        white-space: nowrap;
    }


    .student-submission-remove-file {
        display: flex;
        align-items: center;
        justify-content: center;

        width: 27px;
        height: 27px;

        flex-shrink: 0;

        border: none;
        border-radius: 6px;

        background: transparent;
        color: var(--activity-description);

        cursor: pointer;

        transition:
            color 0.2s ease,
            background-color 0.2s ease;
    }


    .student-submission-remove-file:hover {
        background-color: var(--surface-hover);
        color: var(--danger-color);
    }


    .student-submission-remove-file i {
        font-size: 17px;
    }


    /* ============================================================
   SUBMIT ACTION
   ============================================================ */

    .student-submission-actions {
        display: flex;
        justify-content: flex-end;

        margin-top: 18px;
    }


    .student-submission-submit-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;

        min-width: 170px;

        padding: 10px 17px;

        border: none;
        border-radius: 8px;

        background: var(--student-color);
        color: white;

        font-size: 13px;
        font-weight: 600;

        cursor: pointer;

        transition:
            opacity 0.2s ease,
            transform 0.2s ease;
    }


    .student-submission-submit-btn:hover:not(:disabled) {
        opacity: 0.9;

        transform: translateY(-1px);
    }


    .student-submission-submit-btn:disabled {
        opacity: 0.45;

        cursor: not-allowed;
    }


    .student-submission-submit-btn i {
        font-size: 17px;
    }

    .student-submission-cancel-btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 8px;

    padding: 11px 16px;

    background: transparent;

    border: 1px solid #ef4444;
    border-radius: 10px;

    color: #ef4444;

    font-size: 13px;
    font-weight: 600;

    cursor: pointer;

    transition:
        background-color 0.2s ease,
        color 0.2s ease,
        transform 0.2s ease;
}

.student-submission-cancel-btn i {
    font-size: 18px;
}

.student-submission-cancel-btn:hover {
    background: #ef4444;
    color: #fff;
    transform: translateY(-1px);
}

    /* ============================================================
   RESPONSIVE
============================================================ */

    @media (max-width: 900px) {

        .classwork-show-grid {
            grid-template-columns: 1fr;
        }

        .classwork-show-sidebar {
            position: static;
        }
    }


    @media (max-width: 700px) {

        .classwork-show-page {
            padding: 22px 18px 40px;
        }

        .classwork-show-heading {
            align-items: flex-start;
            gap: 13px;
        }

        .classwork-show-icon {
            width: 52px;
            height: 52px;

            border-radius: 13px;

            font-size: 23px;
        }

        .classwork-show-heading h1 {
            font-size: 24px;
        }

        .classwork-detail-card-header {
            padding: 16px 18px;
        }

        .classwork-description {
            padding: 18px;
        }

        .submission-summary {
            padding: 18px;
        }

        .submission-placeholder {
            margin: 0 18px 18px;
        }

        .submission-files {
            padding: 0 18px 18px;
        }

        .submission-result {
            margin: 0 18px 18px;
        }

        .submission-upload {
            padding: 18px;
        }

        .classwork-file {
            align-items: flex-start;
        }

        .classwork-file-open {
            padding: 8px 12px;

            font-size: 13px;
        }
    }


    @media (max-width: 480px) {

        .classwork-show-page {
            padding: 18px 14px 30px;
        }

        .classwork-back-btn {
            margin-bottom: 18px;
        }

        .classwork-show-icon {
            width: 46px;
            height: 46px;

            font-size: 20px;
        }

        .classwork-show-heading h1 {
            font-size: 21px;
        }

        .classwork-show-type {
            font-size: 10px;
        }

        .classwork-show-topic {
            font-size: 12px;
        }

        .classwork-detail-card {
            border-radius: 13px;
        }

        .classwork-detail-card-header h2 {
            font-size: 15px;
        }

        .classwork-info-item {
            padding: 14px 16px;
        }

        .submission-status {
            padding: 14px 16px;
        }

        .classwork-action-btn {
            margin: 12px 16px 16px;
        }

        .classwork-file {
            gap: 10px;
            padding: 12px;
        }

        .classwork-file-icon {
            width: 42px;
            height: 42px;

            min-width: 42px;

            font-size: 20px;
        }

        .classwork-file-info strong {
            font-size: 13px;
        }

        .classwork-file-info span {
            font-size: 12px;
        }

        .classwork-file-open {
            padding: 7px 10px;
        }

        .submission-file {
            gap: 10px;
            padding: 10px 12px;
        }

        .submission-file-icon {
            width: 38px;
            height: 38px;

            font-size: 18px;
        }

        .submission-file-info strong {
            font-size: 13px;
        }

        .submission-file-info span {
            font-size: 11px;
        }

        .submission-result {
            padding: 13px;
        }

        .submission-upload {
            padding: 16px;
        }

        .submission-submit-btn {
            width: 100%;
        }
    }


    /* ============================================================
   DARK MODE FRIENDLY
============================================================ */

    @media (prefers-color-scheme: dark) {

        .classwork-show-icon.assignment {
            background: rgba(99, 102, 241, 0.18);
        }

        .submission-summary-icon {
            background: rgba(99, 102, 241, 0.16);
        }

        .submission-status-icon {
            background: rgba(99, 102, 241, 0.16);
        }

        .submission-file-icon {
            background: rgba(99, 102, 241, 0.16);
        }
    }
</style>

@extends('layouts.student_layout')

@section('title', 'Assignment')

@section('content')

<div class="classwork-show-page">

    {{-- ============================================================
        HEADER
    ============================================================= --}}

    <div class="classwork-show-header">

        {{-- BACK BUTTON --}}
<a
    href="{{
        $returnTo === 'marks'
            ? route('student.class-groups.marks', $classGroup)
            : ($returnTo === 'classwork'
                ? route('student.class-groups.classroom-group.classwork', $classGroup)
                : route('student.class-groups.classroom-group', $classGroup)
            )
    }}"
    class="classwork-back-btn"
>
    <i class="bx bx-arrow-back"></i>

    {{
        $returnTo === 'marks'
            ? 'Back to Marks'
            : ($returnTo === 'classwork'
                ? 'Back to Classwork'
                : 'Back to Stream'
            )
    }}
</a>


        {{-- ASSIGNMENT HEADER --}}

        <div class="classwork-show-heading">

            <div class="classwork-show-icon assignment">
                <i class="bx bx-task"></i>
            </div>

            <div>

                <span class="classwork-show-type assignment">
                    ASSIGNMENT
                </span>

                <h1>
                    {{ $assignment->title }}
                </h1>

                @if($assignment->topic)

                <div class="classwork-show-topic">

                    <i class="bx bx-folder"></i>

                    {{ $assignment->topic->topic_name }}

                </div>

                @endif

            </div>

        </div>

    </div>


    {{-- ============================================================
        CONTENT
    ============================================================= --}}

    <div class="classwork-show-grid">


        {{-- ========================================================
            MAIN CONTENT
        ========================================================= --}}

        <div class="classwork-show-main">


            {{-- ====================================================
                DESCRIPTION
            ===================================================== --}}

            <section class="classwork-detail-card">

                <div class="classwork-detail-card-header">

                    <h2>
                        Assignment Instructions
                    </h2>

                </div>


                <div class="classwork-description">

                    @if($assignment->description)

                    {!! nl2br(e($assignment->description)) !!}

                    @else

                    <span class="classwork-no-content">
                        No instructions provided.
                    </span>

                    @endif

                </div>

            </section>



            {{-- ====================================================
                ATTACHED FILES
            ===================================================== --}}

            <section class="classwork-detail-card">

                <div class="classwork-detail-card-header">

                    <h2>
                        Attachments
                    </h2>

                </div>


                @if($assignment->resources->isNotEmpty())

                <div class="classwork-files">

                    @foreach($assignment->resources as $resource)

                    <div class="classwork-file">

                        {{-- FILE ICON --}}

                        <div class="classwork-file-icon assignment">

                            <i class="bx bx-file"></i>

                        </div>


                        {{-- FILE INFORMATION --}}

                        <div class="classwork-file-info">

                            <strong>
                                {{ $resource->file_name ?? $resource->title }}
                            </strong>

                            <span>

                                {{ $resource->file_size
                                            ? number_format(
                                                $resource->file_size / 1024,
                                                1
                                            ) . ' KB'
                                            : 'Assignment attachment'
                                        }}

                            </span>

                        </div>


                        {{-- OPEN FILE --}}

                        @if($resource->file_path)

                        <button
                            type="button"
                            class="classwork-file-open"
                            data-file-url="{{ asset('storage/' . $resource->file_path) }}"
                            data-file-name="{{ $resource->file_name ?? $resource->title }}"
                            onclick="openAssignmentFile(
                                            this.dataset.fileUrl,
                                            this.dataset.fileName
                                        )">

                            <i class="bx bx-show"></i>

                            Open

                        </button>

                        @endif

                    </div>

                    @endforeach

                </div>

                @else

                <div class="classwork-no-files">

                    <i class="bx bx-file"></i>

                    <p>
                        No files attached to this assignment.
                    </p>

                </div>

                @endif

            </section>



            {{-- ====================================================
     STUDENT SUBMISSION
===================================================== --}}

            <section class="classwork-detail-card student-submission-card">

                <div class="classwork-detail-card-header">

                    <h2>
                        Your Submission
                    </h2>

                </div>


                @if($submission && $submission->submitted_at)

                {{-- ====================================================
             SUBMITTED STATE
        ===================================================== --}}

                <div class="student-submission-status submitted">

                    <div class="student-submission-status-icon">

                        <i class="bx bx-check"></i>

                    </div>


                    <div class="student-submission-status-content">

                        <strong>
                            Assignment submitted
                        </strong>

                        <span>

                            Submitted
                            {{ $submission->submitted_at->format('M d, Y \a\t h:i A') }}

                        </span>

                    </div>

                </div>


                {{-- ====================================================
             SUBMITTED FILES
        ===================================================== --}}

                @if($submission->resources->count())

                <div class="student-submission-files">

                    <div class="student-submission-files-title">

                        <i class="bx bx-paperclip"></i>

                        <span>
                            Your files
                        </span>

                    </div>


                    <div class="student-submission-file-list">

                        @foreach($submission->resources as $resource)

                        <div class="student-submission-file">

                            <div class="student-submission-file-icon">

                                <i class="bx bx-file"></i>

                            </div>


                            <div class="student-submission-file-info">

                                <strong>
                                    {{ $resource->file_name ?? $resource->title }}
                                </strong>

                                @if($resource->file_size)

                                <span>
                                    {{ number_format($resource->file_size / 1024, 1) }}
                                    KB
                                </span>

                                @endif

                            </div>

                        </div>

                        @endforeach

                    </div>

                </div>

                @endif


                {{-- ====================================================
             GRADE / FEEDBACK
        ===================================================== --}}

                @if($submission && $submission->score !== null)

                @php
                    $assignmentPoints = (float) ($assignment->points ?? 0);
                    $studentScore = (float) $submission->score;
                    $percentage = $assignmentPoints > 0
                        ? ($studentScore / $assignmentPoints) * 100
                        : 0;
                @endphp

                <div class="submission-result">

                    <div class="submission-result-item">

                        <i class="bx bx-star"></i>

                        <div>

                            <span>
                                Your Grade
                            </span>

                            <strong>
                                {{ rtrim(rtrim(number_format($studentScore, 2), '0'), '.') }}
                                /
                                {{ rtrim(rtrim(number_format($assignmentPoints, 2), '0'), '.') }}
                                ({{ rtrim(rtrim(number_format($percentage, 2), '0'), '.') }}%)
                            </strong>

                        </div>

                    </div>


                    @if($submission->feedback)

                    <div class="submission-result-item">

                        <i class="bx bx-message-detail"></i>

                        <div>

                            <span>
                                Professor Feedback
                            </span>

                            <div class="submission-feedback">
                                {!! nl2br(e($submission->feedback)) !!}
                            </div>

                        </div>

                    </div>

                    @endif


                    @if($submission->graded_at)

                    <div class="submission-result-item">

                        <i class="bx bx-calendar-check"></i>

                        <div>

                            <span>
                                Graded On
                            </span>

                            <strong>
                                {{ $submission->graded_at->format('M d, Y \a\t h:i A') }}
                            </strong>

                        </div>

                    </div>

                    @endif

                </div>

                @endif


                {{-- ====================================================
             CANCEL SUBMISSION
        ===================================================== --}}

                <div class="student-submission-actions">

                    <form
                        action="{{ route(
                    'student.class-groups.assignments.cancel',
                    [
                        'classGroup' => $classGroup->id,
                        'assignment' => $assignment->id,
                    ]
                ) }}"
                        method="POST"
                        onsubmit="return confirm(
                    'Are you sure you want to cancel your submission?'
                )">

                        @csrf

                        @method('DELETE')

                        <input
                            type="hidden"
                            name="return_to"
                            value="{{ $returnTo }}">

                        <button
                            type="submit"
                            class="student-submission-cancel-btn">

                            <i class="bx bx-undo"></i>

                            Cancel Submission

                        </button>

                    </form>

                </div>


                @else

                {{-- ====================================================
             NOT SUBMITTED
        ===================================================== --}}

                <form
                    action="{{ route(
                'student.class-groups.assignments.submit',
                [
                    'classGroup' => $classGroup->id,
                    'assignment' => $assignment->id,
                ]
            ) }}"
                    method="POST"
                    enctype="multipart/form-data"
                    id="assignmentSubmissionForm">

                    @csrf


                    {{-- ====================================================
                 UPLOAD AREA
            ===================================================== --}}

                    <div
                        class="student-submission-upload"
                        id="submissionUploadArea">

                        <input
                            type="file"
                            name="attachments[]"
                            id="submissionFiles"
                            multiple
                            hidden>


                        <div class="student-submission-upload-icon">

                            <i class="bx bx-cloud-upload"></i>

                        </div>


                        <div class="student-submission-upload-content">

                            <strong>
                                Add your files
                            </strong>

                            <span>
                                Click here to choose files from your device
                            </span>

                        </div>


                        <button
                            type="button"
                            class="student-submission-browse-btn"
                            id="submissionBrowseBtn">

                            <i class="bx bx-folder-open"></i>

                            Choose Files

                        </button>

                    </div>


                    {{-- ====================================================
                 SELECTED FILES
            ===================================================== --}}

                    <div
                        class="student-submission-selected"
                        id="selectedSubmissionFiles"
                        style="display: none;">

                        <div class="student-submission-selected-header">

                            <span>
                                Selected files
                            </span>

                            <span id="selectedFileCount">
                                0 files
                            </span>

                        </div>


                        <div
                            class="student-submission-selected-list"
                            id="selectedFileList">
                        </div>

                    </div>


                    {{-- ====================================================
                 SUBMIT BUTTON
            ===================================================== --}}

                    <div class="student-submission-actions">

                        <button
                            type="submit"
                            class="student-submission-submit-btn"
                            id="submissionSubmitBtn"
                            disabled>

                            <i class="bx bx-send"></i>

                            <span>
                                Submit Assignment
                            </span>

                        </button>

                    </div>

                </form>

                @endif

            </section>

        </div>



        {{-- ========================================================
            SIDEBAR
        ========================================================= --}}

        <aside class="classwork-show-sidebar">


            {{-- ====================================================
                ASSIGNMENT INFORMATION
            ===================================================== --}}

            <section class="classwork-detail-card">

                <div class="classwork-detail-card-header">

                    <h2>
                        Assignment Details
                    </h2>

                </div>


                <div class="classwork-info-list">


                    {{-- POINTS --}}

                    <div class="classwork-info-item">

                        <i class="bx bx-star"></i>

                        <div>

                            <span>
                                Points
                            </span>

                            <strong>
                                {{ $assignment->points ?? 0 }}
                            </strong>

                        </div>

                    </div>



                    {{-- DUE DATE --}}

                    @if($assignment->due_date)

                    <div class="classwork-info-item">

                        <i class="bx bx-calendar"></i>

                        <div>

                            <span>
                                Due Date
                            </span>

                            <strong>
                                {{ \Carbon\Carbon::parse(
                                        $assignment->due_date
                                    )->format('M d, Y') }}
                            </strong>

                        </div>

                    </div>

                    @endif



                    {{-- DUE TIME --}}

                    @if($assignment->due_time)

                    <div class="classwork-info-item">

                        <i class="bx bx-time"></i>

                        <div>

                            <span>
                                Due Time
                            </span>

                            <strong>
                                {{ \Carbon\Carbon::parse(
                                        $assignment->due_time
                                    )->format('h:i A') }}
                            </strong>

                        </div>

                    </div>

                    @endif

                </div>

            </section>



            {{-- ====================================================
                SUBMISSION STATUS
            ===================================================== --}}

            <section class="classwork-detail-card">

                <div class="classwork-detail-card-header">

                    <h2>
                        Submission Status
                    </h2>

                </div>


                <div class="classwork-info-list">

                    <div class="classwork-info-item">

                        <i class="bx
                            {{ $submission && $submission->submitted_at
                                ? 'bx-check-circle'
                                : 'bx-time-five'
                            }}"></i>

                        <div>

                            <span>
                                Status
                            </span>

                            <strong>

                                {{ $submission && $submission->submitted_at
                                    ? 'Submitted'
                                    : 'Not Submitted'
                                }}

                            </strong>

                        </div>

                    </div>


                    @if($submission && $submission->score !== null)

                    <div class="classwork-info-item">

                        <i class="bx bx-star"></i>

                        <div>

                            <span>
                                Grade
                            </span>

                            <strong>
                                {{ rtrim(rtrim(number_format($submission->score, 2), '0'), '.') }} /
                                {{ rtrim(rtrim(number_format($assignment->points ?? 0, 2), '0'), '.') }}
                            </strong>

                        </div>

                    </div>

                    @endif

                </div>

            </section>

        </aside>

    </div>

</div>



{{-- ================================================================
    FILE VIEWER MODAL
================================================================= --}}

<div
    id="assignmentViewerModal"
    class="material-viewer-modal">

    <div class="material-viewer-container">

        <div class="material-viewer-header">

            <div class="material-viewer-title">

                <i class="bx bx-file"></i>

                <span id="assignmentViewerTitle">
                    Assignment Attachment
                </span>

            </div>


            <div class="material-viewer-actions">

                <button
                    type="button"
                    class="material-viewer-btn"
                    onclick="toggleAssignmentFullscreen()"
                    title="Fullscreen">
                    <i class="bx bx-fullscreen"></i>
                </button>


                <button
                    type="button"
                    class="material-viewer-btn close"
                    onclick="closeAssignmentModal()"
                    title="Close">
                    <i class="bx bx-x"></i>
                </button>

            </div>

        </div>


        <div class="material-viewer-body">

            <iframe
                id="assignmentViewerFrame"
                src=""
                frameborder="0"></iframe>

        </div>

    </div>

</div>



<script>
    function openAssignmentFile(fileUrl, fileName) {

        const modal =
            document.getElementById('assignmentViewerModal');

        const iframe =
            document.getElementById('assignmentViewerFrame');

        const title =
            document.getElementById('assignmentViewerTitle');


        if (!modal || !iframe) {
            return;
        }


        if (title) {
            title.textContent =
                fileName || 'Assignment Attachment';
        }


        iframe.src = fileUrl;

        modal.classList.add('active');

        document.body.classList.add(
            'material-modal-open'
        );
    }


    function closeAssignmentModal() {

        const modal =
            document.getElementById('assignmentViewerModal');

        const iframe =
            document.getElementById('assignmentViewerFrame');


        if (!modal || !iframe) {
            return;
        }


        iframe.src = '';

        modal.classList.remove('active');

        document.body.classList.remove(
            'material-modal-open'
        );


        if (document.fullscreenElement) {
            document.exitFullscreen();
        }
    }


    function toggleAssignmentFullscreen() {

        const container =
            document.querySelector(
                '#assignmentViewerModal .material-viewer-container'
            );


        if (!container) {
            return;
        }


        if (!document.fullscreenElement) {

            container
                .requestFullscreen()
                .catch(function(error) {

                    console.error(
                        'Fullscreen failed:',
                        error
                    );

                });

        } else {

            document.exitFullscreen();

        }
    }


    const assignmentModal =
        document.getElementById(
            'assignmentViewerModal'
        );


    if (assignmentModal) {

        assignmentModal.addEventListener(
            'click',
            function(event) {

                if (
                    event.target === assignmentModal
                ) {
                    closeAssignmentModal();
                }

            }
        );

    }


    document.addEventListener(
        'keydown',
        function(event) {

            if (event.key !== 'Escape') {
                return;
            }


            const modal =
                document.getElementById(
                    'assignmentViewerModal'
                );


            if (!modal) {
                return;
            }


            if (document.fullscreenElement) {
                return;
            }


            if (
                modal.classList.contains('active')
            ) {
                closeAssignmentModal();
            }

        }
    );
</script>

<script>
    document.addEventListener('DOMContentLoaded', function() {

        const fileInput = document.getElementById('submissionFiles');
        const uploadArea = document.getElementById('submissionUploadArea');
        const browseButton = document.getElementById('submissionBrowseBtn');

        const selectedContainer =
            document.getElementById('selectedSubmissionFiles');

        const selectedFileList =
            document.getElementById('selectedFileList');

        const selectedFileCount =
            document.getElementById('selectedFileCount');

        const submitButton =
            document.getElementById('submissionSubmitBtn');


        if (!fileInput || !uploadArea) {
            return;
        }


        let selectedFiles = [];


        /* ========================================================
           OPEN FILE PICKER
        ======================================================== */

        browseButton.addEventListener('click', function(event) {

            event.stopPropagation();

            fileInput.click();

        });


        uploadArea.addEventListener('click', function(event) {

            if (
                event.target !== browseButton &&
                !browseButton.contains(event.target)
            ) {
                fileInput.click();
            }

        });


        /* ========================================================
           FILE SELECTION
        ======================================================== */

        fileInput.addEventListener('change', function() {

            const newFiles = Array.from(this.files);

            selectedFiles = [
                ...selectedFiles,
                ...newFiles
            ];

            updateFileList();

        });


        /* ========================================================
           UPDATE FILE LIST
        ======================================================== */

        function updateFileList() {

            selectedFileList.innerHTML = '';


            if (selectedFiles.length === 0) {

                selectedContainer.style.display = 'none';

                submitButton.disabled = true;

                return;
            }


            selectedContainer.style.display = 'block';

            submitButton.disabled = false;


            selectedFileCount.textContent =
                selectedFiles.length +
                (selectedFiles.length === 1 ? ' file' : ' files');


            selectedFiles.forEach(function(file, index) {

                const fileElement =
                    document.createElement('div');

                fileElement.className =
                    'student-submission-selected-file';


                fileElement.innerHTML = `

                <div class="student-submission-selected-file-icon">

                    <i class="bx bx-file"></i>

                </div>


                <div class="student-submission-selected-file-name"
                     title="${escapeHtml(file.name)}">

                    ${escapeHtml(file.name)}

                </div>


                <button
                    type="button"
                    class="student-submission-remove-file"
                    data-index="${index}"
                    title="Remove file"
                >

                    <i class="bx bx-x"></i>

                </button>

            `;


                selectedFileList.appendChild(fileElement);

            });


            attachRemoveEvents();

        }


        /* ========================================================
           REMOVE FILE
        ======================================================== */

        function attachRemoveEvents() {

            const removeButtons =
                document.querySelectorAll(
                    '.student-submission-remove-file'
                );


            removeButtons.forEach(function(button) {

                button.addEventListener('click', function() {

                    const index =
                        Number(this.dataset.index);


                    selectedFiles.splice(index, 1);


                    updateFileInput();

                    updateFileList();

                });

            });

        }


        /* ========================================================
           SYNC FILE INPUT
        ======================================================== */

        function updateFileInput() {

            const dataTransfer =
                new DataTransfer();


            selectedFiles.forEach(function(file) {

                dataTransfer.items.add(file);

            });


            fileInput.files =
                dataTransfer.files;

        }


        /* ========================================================
           ESCAPE HTML
        ======================================================== */

        function escapeHtml(value) {

            const div =
                document.createElement('div');

            div.textContent = value;

            return div.innerHTML;

        }

    });
</script>

@endsection