<style>
/* ============================================================
   EXAM SHOW PAGE
   Clean layout based on Assignment Show
   Red is used only for exam identity
   ============================================================ */

.classwork-show-page {
    --exam-red: #dc2626;
    --exam-red-dark: #b91c1c;
    --exam-red-soft: #fef2f2;
    --exam-red-light: #fee2e2;
    --exam-red-border: #fecaca;

    --exam-blue: #2563eb;
    --exam-blue-dark: #1d4ed8;
    --exam-blue-soft: #eff6ff;
    --exam-blue-border: #bfdbfe;

    --exam-green: #16a34a;
    --exam-green-soft: #f0fdf4;
    --exam-green-border: #bbf7d0;

    --exam-warning: #d97706;
    --exam-warning-soft: #fffbeb;

    --exam-text: #0f172a;
    --exam-text-2: #334155;
    --exam-muted: #64748b;
    --exam-light: #94a3b8;

    --exam-border: #e2e8f0;
    --exam-border-light: #edf2f7;
    --exam-surface: #ffffff;
    --exam-soft: #f8fafc;

    --exam-shadow: 0 6px 24px rgba(15, 23, 42, 0.055);
    --exam-small-shadow: 0 2px 8px rgba(15, 23, 42, 0.045);
    --exam-radius: 18px;

    width: 100%;
    max-width: 1320px;
    margin: 0 auto;
    padding: 24px 30px 42px;

    color: var(--exam-text);
}

/* ============================================================
   RESET
   ============================================================ */

.classwork-show-page *,
.classwork-show-page *::before,
.classwork-show-page *::after {
    box-sizing: border-box;
}

.classwork-show-page a {
    -webkit-tap-highlight-color: transparent;
}

.classwork-show-page button,
.classwork-show-page a {
    font-family: inherit;
}

/* ============================================================
   HEADER
   ============================================================ */

.classwork-show-header {
    margin-bottom: 24px;
}

.classwork-back-btn {
    width: fit-content !important;
    min-width: 0;

    display: inline-flex;
    align-items: center;
    justify-content: flex-start;
    gap: 8px;

    margin: 0 0 20px;
    padding: 0 !important;

    border: 0 !important;
    border-radius: 9px;

    background: transparent !important;
    color: var(--exam-muted);

    text-decoration: none;
    box-shadow: none !important;

    font-size: 14px;
    font-weight: 750;
    line-height: 1;
    white-space: nowrap;

    transition:
        color 0.18s ease,
        transform 0.18s ease;
}

.classwork-back-btn:hover {
    color: var(--exam-blue);
    transform: translateX(-3px);
}

.classwork-back-btn i {
    flex: 0 0 auto;
    font-size: 21px;
}

/* ============================================================
   EXAM HEADING
   ============================================================ */

.classwork-show-heading {
    display: flex;
    align-items: center;
    gap: 16px;
    min-width: 0;
}

.classwork-show-icon {
    width: 60px;
    height: 60px;
    flex: 0 0 60px;

    display: inline-flex;
    align-items: center;
    justify-content: center;

    border: 1px solid var(--exam-red-border);
    border-radius: 16px;

    background: var(--exam-red-soft);
    color: var(--exam-red);

    font-size: 28px;
}

.classwork-show-type {
    display: block;
    margin: 0 0 5px;

    color: var(--exam-red-dark);

    font-size: 11px;
    font-weight: 850;
    letter-spacing: 0.14em;
    text-transform: uppercase;
}

.classwork-show-heading h1 {
    margin: 0;

    color: var(--exam-text);

    font-size: 31px;
    line-height: 1.15;
    font-weight: 850;
    letter-spacing: -0.03em;

    overflow-wrap: anywhere;
}

.classwork-show-topic {
    display: inline-flex;
    align-items: center;
    gap: 6px;

    margin-top: 7px;

    color: var(--exam-muted);
    font-size: 13px;
    font-weight: 600;
}

.classwork-show-topic i {
    color: var(--exam-blue);
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
    display: flex;
    flex-direction: column;
    gap: 18px;
    min-width: 0;
}

.classwork-show-sidebar {
    display: flex;
    flex-direction: column;
    gap: 18px;

    position: sticky;
    top: 20px;
}

/* ============================================================
   CARDS
   ============================================================ */

.classwork-detail-card {
    overflow: hidden;
    min-width: 0;

    border: 1px solid var(--exam-border);
    border-radius: var(--exam-radius);

    background: var(--exam-surface);
    box-shadow: var(--exam-shadow);
}

.classwork-detail-card-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 12px;

    min-height: 62px;
    padding: 16px 23px;

    border-bottom: 1px solid var(--exam-border-light);
    background: var(--exam-surface);
}

.classwork-detail-card-header h2 {
    margin: 0;

    color: var(--exam-text);

    font-size: 16px;
    line-height: 1.25;
    font-weight: 850;
}

.classwork-detail-card-header h2::before {
    content: "";

    display: inline-block;
    width: 4px;
    height: 18px;

    margin-right: 10px;
    vertical-align: -3px;

    border-radius: 999px;
    background: var(--exam-red);
}

/* ============================================================
   DESCRIPTION
   ============================================================ */

.classwork-description {
    min-height: 100px;
    padding: 22px 24px;

    color: var(--exam-text-2);
    font-size: 15px;
    line-height: 1.8;

    overflow-wrap: anywhere;
}

.classwork-no-content {
    color: var(--exam-muted);
    font-style: italic;
}

/* ============================================================
   EXAM FORM
   ============================================================ */

.exam-form-section {
    padding: 18px 23px 21px;
}

.exam-form-box {
    display: flex;
    align-items: center;
    gap: 14px;

    padding: 14px;

    border: 1px solid var(--exam-blue-border);
    border-radius: 13px;

    background: var(--exam-blue-soft);
}

.exam-form-icon {
    width: 46px;
    height: 46px;
    flex: 0 0 46px;

    display: inline-flex;
    align-items: center;
    justify-content: center;

    border: 1px solid var(--exam-blue-border);
    border-radius: 11px;

    background: #ffffff;
    color: var(--exam-blue);
    box-shadow: var(--exam-small-shadow);

    font-size: 21px;
}

.exam-form-info {
    min-width: 0;
    flex: 1;

    display: flex;
    flex-direction: column;
    gap: 4px;
}

.exam-form-info strong {
    color: var(--exam-text-2);
    font-size: 14px;
    font-weight: 850;
}

.exam-form-info span {
    color: var(--exam-muted);
    font-size: 12px;
    line-height: 1.5;
}

.exam-form-open {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 6px;

    min-height: 40px;
    padding: 0 14px;

    border: 1px solid var(--exam-blue);
    border-radius: 9px;

    background: var(--exam-blue);
    color: #ffffff;

    text-decoration: none;
    font-size: 12px;
    font-weight: 850;
    white-space: nowrap;

    transition: 0.18s ease;
}

.exam-form-open:hover {
    border-color: var(--exam-blue-dark);
    background: var(--exam-blue-dark);
}

/* ============================================================
   ATTACHMENTS
   ============================================================ */

.classwork-files {
    display: flex;
    flex-direction: column;
    gap: 9px;

    padding: 17px 23px 20px;
}

.classwork-file {
    display: flex;
    align-items: center;
    gap: 13px;

    min-width: 0;
    padding: 12px;

    border: 1px solid var(--exam-border);
    border-radius: 12px;

    background: var(--exam-soft);

    transition: 0.18s ease;
}

.classwork-file:hover {
    border-color: var(--exam-blue-border);
    background: var(--exam-blue-soft);
}

.classwork-file-icon {
    width: 44px;
    height: 44px;
    flex: 0 0 44px;

    display: inline-flex;
    align-items: center;
    justify-content: center;

    border: 1px solid var(--exam-red-border);
    border-radius: 10px;

    background: var(--exam-red-soft);
    color: var(--exam-red);

    font-size: 20px;
}

.classwork-file-info {
    min-width: 0;
    flex: 1;

    display: flex;
    flex-direction: column;
    gap: 4px;
}

.classwork-file-info strong {
    display: block;
    overflow: hidden;

    color: var(--exam-text-2);

    font-size: 13px;
    font-weight: 800;

    text-overflow: ellipsis;
    white-space: nowrap;
}

.classwork-file-info span {
    display: block;
    color: var(--exam-light);
    font-size: 11px;
}

.classwork-file-open {
    min-height: 37px;

    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 6px;

    flex: 0 0 auto;
    padding: 0 12px;

    border: 1px solid var(--exam-blue-border);
    border-radius: 9px;

    background: var(--exam-surface);
    color: var(--exam-blue);

    font-size: 11px;
    font-weight: 850;
    cursor: pointer;
    text-decoration: none;

    transition: 0.18s ease;
}

.classwork-file-open:hover {
    border-color: var(--exam-blue);
    background: var(--exam-blue-soft);
    color: var(--exam-blue-dark);
}

.classwork-file-open i {
    font-size: 16px;
}

.classwork-no-files,
.submission-placeholder {
    min-height: 130px;

    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;

    margin: 16px 23px 20px;
    padding: 22px;

    border: 1px dashed var(--exam-border);
    border-radius: 12px;

    background: var(--exam-soft);
    text-align: center;
}

.classwork-no-files i,
.submission-placeholder i {
    margin-bottom: 8px;
    color: var(--exam-light);
    font-size: 28px;
}

.classwork-no-files p,
.submission-placeholder p {
    margin: 0;
    color: var(--exam-muted);
    font-size: 13px;
}

/* ============================================================
   SUBMISSION SUMMARY
   ============================================================ */

.submission-summary {
    display: flex;
    align-items: center;
    gap: 14px;

    margin: 16px 23px 0;
    padding: 14px;

    border: 1px solid var(--exam-blue-border);
    border-radius: 13px;

    background: var(--exam-blue-soft);
}

.submission-summary-icon {
    width: 46px;
    height: 46px;
    flex: 0 0 46px;

    display: inline-flex;
    align-items: center;
    justify-content: center;

    border-radius: 11px;

    background: #ffffff;
    color: var(--exam-blue);
    box-shadow: var(--exam-small-shadow);

    font-size: 22px;
}

.submission-summary > div:last-child {
    min-width: 0;

    display: flex;
    flex-direction: column;
    gap: 3px;
}

.submission-summary strong {
    color: var(--exam-text);
    font-size: 19px;
    font-weight: 850;
}

.submission-summary span {
    color: var(--exam-muted);
    font-size: 12px;
}

/* ============================================================
   SUBMISSION LIST
   ============================================================ */

.submission-list {
    display: flex;
    flex-direction: column;
    gap: 9px;

    margin: 14px 23px 20px;
}

.submission-item {
    display: flex;
    align-items: center;
    gap: 12px;

    min-width: 0;
    padding: 11px;

    border: 1px solid var(--exam-border);
    border-radius: 12px;

    background: var(--exam-soft);

    transition: 0.18s ease;
}

.submission-item:hover {
    border-color: var(--exam-blue-border);
    background: var(--exam-blue-soft);
}

.submission-student-icon {
    width: 40px;
    height: 40px;
    flex: 0 0 40px;

    display: inline-flex;
    align-items: center;
    justify-content: center;

    border: 1px solid var(--exam-border);
    border-radius: 50%;

    background: var(--exam-surface);
    color: var(--exam-muted);

    font-size: 19px;
}

.submission-student-info {
    min-width: 0;
    flex: 1;

    display: flex;
    flex-direction: column;
    gap: 4px;
}

.submission-student-info strong {
    overflow: hidden;

    color: var(--exam-text-2);

    font-size: 13px;
    font-weight: 800;

    text-overflow: ellipsis;
    white-space: nowrap;
}

.submission-student-info span {
    color: var(--exam-light);
    font-size: 11px;
}

.submission-grade-status {
    display: inline-flex;
    align-items: center;
    gap: 5px;

    flex: 0 0 auto;
    padding: 6px 9px;

    border-radius: 8px;

    font-size: 10px;
    font-weight: 850;
    white-space: nowrap;
}

.submission-grade-status.graded {
    background: var(--exam-green-soft);
    color: var(--exam-green);
}

.submission-grade-status.ungraded {
    background: var(--exam-warning-soft);
    color: var(--exam-warning);
}

.submission-grade-status i {
    font-size: 14px;
}

.submission-grade-score {
    margin-left: 2px;
    font-weight: 850;
}

.submission-view-btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 5px;

    flex: 0 0 auto;
    min-height: 35px;
    padding: 0 11px;

    border: 1px solid var(--exam-blue-border);
    border-radius: 8px;

    background: var(--exam-surface);
    color: var(--exam-blue);

    text-decoration: none;

    font-size: 10px;
    font-weight: 850;
    white-space: nowrap;

    transition: 0.18s ease;
}

.submission-view-btn:hover {
    border-color: var(--exam-blue);
    background: var(--exam-blue-soft);
    color: var(--exam-blue-dark);
}

.submission-view-btn i {
    font-size: 15px;
}

/* ============================================================
   SIDEBAR DETAILS
   ============================================================ */

.classwork-info-list {
    display: flex;
    flex-direction: column;
}

.classwork-info-item {
    display: flex;
    align-items: center;
    gap: 12px;

    padding: 15px 18px;

    border-bottom: 1px solid var(--exam-border-light);
}

.classwork-info-item:last-child {
    border-bottom: 0;
}

.classwork-info-item > i {
    width: 38px;
    height: 38px;
    flex: 0 0 38px;

    display: inline-flex;
    align-items: center;
    justify-content: center;

    border-radius: 10px;

    background: var(--exam-blue-soft);
    color: var(--exam-blue);

    font-size: 18px;
}

.classwork-info-item > div {
    min-width: 0;

    display: flex;
    flex-direction: column;
    gap: 3px;
}

.classwork-info-item span {
    color: var(--exam-muted);
    font-size: 11px;
}

.classwork-info-item strong {
    color: var(--exam-text-2);
    font-size: 14px;
    font-weight: 850;
    overflow-wrap: anywhere;
}

/* ============================================================
   ACTIONS
   ============================================================ */

.classwork-action-btn {
    display: flex;
    align-items: center;
    justify-content: flex-start;
    gap: 10px;

    min-height: 46px;
    margin: 16px 18px 19px;
    padding: 0 14px;

    border: 1px solid var(--exam-red-border);
    border-radius: 10px;

    background: var(--exam-red-soft);
    color: var(--exam-red-dark);

    text-decoration: none;

    font-size: 13px;
    font-weight: 850;

    transition: 0.18s ease;
}

.classwork-action-btn:hover {
    border-color: var(--exam-red);
    background: var(--exam-red-light);
    color: var(--exam-red-dark);
}

.classwork-action-btn i {
    font-size: 18px;
}

/* ============================================================
   FILE PREVIEW MODAL
   ============================================================ */

.file-preview-modal {
    position: fixed;
    inset: 0;
    z-index: 9999;

    display: flex;
    align-items: center;
    justify-content: center;

    padding: 20px;

    background: rgba(2, 6, 23, 0.76);

    opacity: 0;
    visibility: hidden;
    pointer-events: none;

    transition:
        opacity 0.2s ease,
        visibility 0.2s ease;
}

.file-preview-modal.active {
    opacity: 1;
    visibility: visible;
    pointer-events: auto;
}

.file-preview-container {
    width: min(1200px, 100%);
    height: min(850px, 90vh);

    display: flex;
    flex-direction: column;

    overflow: hidden;

    border: 1px solid var(--exam-border);
    border-radius: 15px;

    background: var(--exam-surface);
    box-shadow: 0 24px 70px rgba(0, 0, 0, 0.35);
}

.file-preview-header {
    min-height: 60px;

    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 12px;

    padding: 0 17px;

    border-bottom: 1px solid var(--exam-border);
    background: var(--exam-surface);
}

.file-preview-title {
    min-width: 0;

    display: flex;
    align-items: center;
    gap: 9px;

    color: var(--exam-text-2);
    font-size: 14px;
    font-weight: 800;
}

.file-preview-title i {
    color: var(--exam-red);
    font-size: 20px;
}

.file-preview-title span {
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
}

.file-preview-actions {
    display: flex;
    align-items: center;
    gap: 6px;
}

.file-preview-action {
    width: 38px;
    height: 38px;

    display: inline-flex;
    align-items: center;
    justify-content: center;

    padding: 0;

    border: 1px solid var(--exam-border);
    border-radius: 9px;

    background: transparent;
    color: var(--exam-muted);

    cursor: pointer;
    transition: 0.18s ease;
}

.file-preview-action:hover {
    border-color: var(--exam-blue);
    background: var(--exam-blue-soft);
    color: var(--exam-text);
}

.file-preview-action.close:hover {
    border-color: var(--exam-red);
    color: var(--exam-red);
}

.file-preview-action i {
    font-size: 20px;
}

.file-preview-body {
    flex: 1;
    min-height: 0;

    background: #171717;
}

.file-preview-body iframe {
    display: block;

    width: 100%;
    height: 100%;

    border: 0;
    background: #ffffff;
}

.file-preview-container:fullscreen {
    width: 100vw;
    height: 100vh;

    border: 0;
    border-radius: 0;
}

body.modal-open {
    overflow: hidden;
}

/* ============================================================
   FOCUS
   ============================================================ */

.classwork-show-page button:focus-visible,
.classwork-show-page a:focus-visible {
    outline: 3px solid rgba(37, 99, 235, 0.2);
    outline-offset: 3px;
}

/* ============================================================
   RESPONSIVE TABLET
   ============================================================ */

@media (max-width: 1050px) {
    .classwork-show-page {
        padding: 23px 24px 40px;
    }

    .classwork-show-grid {
        grid-template-columns: minmax(0, 1fr) 285px;
        gap: 18px;
    }

    .classwork-show-heading h1 {
        font-size: 28px;
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
        gap: 18px;

        position: static;
    }
}

@media (max-width: 650px) {
    .classwork-show-page {
        padding: 20px 16px 40px;
    }

    .classwork-show-header {
        margin-bottom: 20px;
    }

    .classwork-back-btn {
        margin-bottom: 17px;
        font-size: 13px;
    }

    .classwork-show-heading {
        align-items: flex-start;
        gap: 12px;
    }

    .classwork-show-icon {
        width: 50px;
        height: 50px;
        flex-basis: 50px;

        border-radius: 13px;
        font-size: 23px;
    }

    .classwork-show-type {
        font-size: 10px;
    }

    .classwork-show-heading h1 {
        font-size: 23px;
    }

    .classwork-show-topic {
        font-size: 12px;
    }

    .classwork-detail-card-header {
        min-height: 56px;
        padding: 14px 17px;
    }

    .classwork-detail-card-header h2 {
        font-size: 14px;
    }

    .classwork-description {
        padding: 18px;
        font-size: 13px;
        line-height: 1.7;
    }

    .classwork-files {
        padding: 14px 16px 17px;
    }

    .classwork-file {
        align-items: flex-start;
        gap: 10px;
    }

    .classwork-file-icon {
        width: 38px;
        height: 38px;
        flex-basis: 38px;
        font-size: 17px;
    }

    .classwork-file-info strong {
        white-space: normal;
        overflow-wrap: anywhere;
        font-size: 12px;
    }

    .classwork-file-info span {
        font-size: 10px;
    }

    .classwork-file-open {
        min-height: 34px;
        padding: 0 9px;
        font-size: 10px;
    }

    .exam-form-section {
        padding: 14px 16px 17px;
    }

    .exam-form-box {
        align-items: flex-start;
        flex-wrap: wrap;
        gap: 11px;
    }

    .exam-form-icon {
        width: 40px;
        height: 40px;
        flex-basis: 40px;
        font-size: 18px;
    }

    .exam-form-info strong {
        font-size: 12px;
    }

    .exam-form-info span {
        font-size: 11px;
    }

    .exam-form-open {
        width: 100%;
        min-height: 38px;
        font-size: 11px;
    }

    .submission-summary {
        margin-left: 16px;
        margin-right: 16px;
    }

    .submission-list {
        margin-left: 16px;
        margin-right: 16px;
    }

    .submission-item {
        align-items: flex-start;
        flex-wrap: wrap;
    }

    .submission-student-icon {
        width: 36px;
        height: 36px;
        flex-basis: 36px;
        font-size: 17px;
    }

    .submission-student-info strong {
        font-size: 12px;
    }

    .submission-student-info span {
        font-size: 10px;
    }

    .submission-grade-status {
        margin-left: 43px;
    }

    .submission-view-btn {
        margin-left: auto;
    }

    .classwork-show-sidebar {
        display: flex;
        flex-direction: column;
        gap: 14px;
    }

    .classwork-info-item {
        padding: 13px 16px;
    }

    .classwork-action-btn {
        margin: 14px 16px 17px;
        min-height: 42px;
        font-size: 12px;
    }

    .file-preview-modal {
        padding: 10px;
    }

    .file-preview-container {
        height: 95vh;
        border-radius: 10px;
    }

    .file-preview-header {
        min-height: 54px;
        padding: 0 10px;
    }

    .file-preview-title {
        font-size: 12px;
    }

    .file-preview-action {
        width: 34px;
        height: 34px;
    }
}

/* ============================================================
   DARK MODE
   ============================================================ */

.dark-mode .classwork-show-page {
    --exam-red: #f87171;
    --exam-red-dark: #fca5a5;
    --exam-red-soft: rgba(248, 113, 113, 0.12);
    --exam-red-light: rgba(248, 113, 113, 0.18);
    --exam-red-border: rgba(248, 113, 113, 0.34);

    --exam-blue: #818cf8;
    --exam-blue-dark: #a5b4fc;
    --exam-blue-soft: rgba(129, 140, 248, 0.12);
    --exam-blue-border: rgba(129, 140, 248, 0.34);

    --exam-green: #4ade80;
    --exam-green-soft: rgba(74, 222, 128, 0.12);
    --exam-green-border: rgba(74, 222, 128, 0.34);

    --exam-warning: #fbbf24;
    --exam-warning-soft: rgba(251, 191, 36, 0.12);

    --exam-text: #f8fafc;
    --exam-text-2: #e2e8f0;
    --exam-muted: #a1a1aa;
    --exam-light: #858595;

    --exam-border: #2b2e52;
    --exam-border-light: #252847;
    --exam-surface: #171933;
    --exam-soft: #12142a;

    --exam-shadow: 0 7px 24px rgba(0, 0, 10, 0.25);
    --exam-small-shadow: 0 2px 8px rgba(0, 0, 10, 0.18);

    color: var(--exam-text);
    color-scheme: dark;
}

.dark-mode .classwork-show-page .classwork-show-icon {
    border-color: var(--exam-red-border);
    background: var(--exam-red-soft);
    color: var(--exam-red);
}

.dark-mode .classwork-show-page .classwork-show-type {
    color: var(--exam-red-dark);
}

.dark-mode .classwork-show-page .classwork-detail-card,
.dark-mode .classwork-show-page .classwork-detail-card-header {
    border-color: var(--exam-border);
    background: var(--exam-surface);
}

.dark-mode .classwork-show-page .classwork-description {
    color: var(--exam-text-2);
}

.dark-mode .classwork-show-page .exam-form-box {
    border-color: var(--exam-blue-border);
    background: var(--exam-blue-soft);
}

.dark-mode .classwork-show-page .exam-form-icon {
    border-color: var(--exam-blue-border);
    background: var(--exam-surface);
    color: var(--exam-blue);
}

.dark-mode .classwork-show-page .classwork-file {
    border-color: var(--exam-border);
    background: var(--exam-soft);
}

.dark-mode .classwork-show-page .classwork-file-icon {
    border-color: var(--exam-red-border);
    background: var(--exam-red-soft);
    color: var(--exam-red);
}

.dark-mode .classwork-show-page .classwork-file-open {
    border-color: var(--exam-blue-border);
    background: var(--exam-surface);
    color: var(--exam-blue-dark);
}

.dark-mode .classwork-show-page .submission-summary {
    border-color: var(--exam-blue-border);
    background: var(--exam-blue-soft);
}

.dark-mode .classwork-show-page .submission-summary-icon {
    background: var(--exam-surface);
    color: var(--exam-blue);
}

.dark-mode .classwork-show-page .submission-item {
    border-color: var(--exam-border);
    background: var(--exam-soft);
}

.dark-mode .classwork-show-page .submission-student-icon {
    border-color: var(--exam-border);
    background: var(--exam-surface);
    color: var(--exam-muted);
}

.dark-mode .classwork-show-page .file-preview-container,
.dark-mode .classwork-show-page .file-preview-header {
    border-color: var(--exam-border);
    background: var(--exam-surface);
}
</style>

@extends('layouts.prof_layout')

@section('title', 'Exam')

@section('content')
@php
    $returnTo = request('origin', request('return_to', 'stream'));
@endphp

<div class="classwork-show-page">

    {{-- ============================================================
        HEADER
    ============================================================ --}}

    <div class="classwork-show-header">

        <a
            href="{{
                $returnTo === 'marks'
                    ? route(
                        'professor.class-groups.marks',
                        $classGroup
                    )
                    : ($returnTo === 'classwork'
                        ? route(
                            'professor.class-groups.classroom-group.classwork',
                            $classGroup
                        )
                        : route(
                            'professor.class-groups.classroom-group',
                            $classGroup
                        )
                    )
            }}"
            class="classwork-back-btn">

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

        <div class="classwork-show-heading">

            <div class="classwork-show-icon">
                <i class="bx bx-edit-alt"></i>
            </div>

            <div>

                <span class="classwork-show-type">
                    EXAM
                </span>

                <h1>
                    {{ $exam->title }}
                </h1>

                @if($exam->topic)
                    <div class="classwork-show-topic">
                        <i class="bx bx-folder"></i>
                        {{ $exam->topic->topic_name }}
                    </div>
                @endif

            </div>

        </div>

    </div>

    {{-- ============================================================
        MAIN CONTENT
    ============================================================ --}}

    <div class="classwork-show-grid">

        <main class="classwork-show-main">

            {{-- ====================================================
                EXAM INSTRUCTIONS
            ==================================================== --}}

            <section class="classwork-detail-card">

                <div class="classwork-detail-card-header">
                    <h2>Exam Instructions</h2>
                </div>

                <div class="classwork-description">

                    @if($exam->description)

                        {!! nl2br(e($exam->description)) !!}

                    @else

                        <span class="classwork-no-content">
                            No description provided.
                        </span>

                    @endif

                </div>

            </section>

            {{-- ====================================================
                GOOGLE FORM
            ==================================================== --}}

            @if($exam->google_form_url)

                <section class="classwork-detail-card">

                    <div class="classwork-detail-card-header">
                        <h2>Exam Form</h2>
                    </div>

                    <div class="exam-form-section">

                        <div class="exam-form-box">

                            <div class="exam-form-icon">
                                <i class="bx bx-link-external"></i>
                            </div>

                            <div class="exam-form-info">

                                <strong>
                                    Google Form Exam
                                </strong>

                                <span>
                                    Open the exam form and complete all required questions.
                                </span>

                            </div>

                            <a
                                href="{{ $exam->google_form_url }}"
                                target="_blank"
                                rel="noopener noreferrer"
                                class="exam-form-open">

                                <i class="bx bx-link-external"></i>
                                Open Exam

                            </a>

                        </div>

                    </div>

                </section>

            @endif

            {{-- ====================================================
                ATTACHED FILES
            ==================================================== --}}

            @if($exam->attachment || $exam->resources->count())

                <section class="classwork-detail-card">

                    <div class="classwork-detail-card-header">
                        <h2>Attached Files</h2>
                    </div>

                    <div class="classwork-files">

                        {{-- SINGLE ATTACHMENT --}}

                        @if($exam->attachment)

                            <div class="classwork-file">

                                <div class="classwork-file-icon">
                                    <i class="bx bx-file"></i>
                                </div>

                                <div class="classwork-file-info">

                                    <strong>
                                        {{ basename($exam->attachment) }}
                                    </strong>

                                    <span>
                                        Exam attachment
                                    </span>

                                </div>

                                <button
                                    type="button"
                                    class="classwork-file-open exam-file-open"
                                    data-file-url="{{ asset('storage/' . $exam->attachment) }}"
                                    data-file-title="{{ basename($exam->attachment) }}">

                                    <i class="bx bx-show"></i>
                                    Open

                                </button>

                            </div>

                        @endif

                        {{-- MULTIPLE RESOURCE FILES --}}

                        @foreach($exam->resources as $resource)

                            @if($resource->file_path)

                                <div class="classwork-file">

                                    <div class="classwork-file-icon">
                                        <i class="bx bx-file"></i>
                                    </div>

                                    <div class="classwork-file-info">

                                        <strong>
                                            {{ $resource->file_name ?: $resource->title }}
                                        </strong>

                                        <span>
                                            Exam attachment
                                        </span>

                                    </div>

                                    <button
                                        type="button"
                                        class="classwork-file-open exam-file-open"
                                        data-file-url="{{ asset('storage/' . $resource->file_path) }}"
                                        data-file-title="{{ $resource->file_name ?: $resource->title }}">

                                        <i class="bx bx-show"></i>
                                        Open

                                    </button>

                                </div>

                            @endif

                        @endforeach

                    </div>

                </section>

            @endif

            {{-- ====================================================
                STUDENT SUBMISSIONS
            ==================================================== --}}

            <section class="classwork-detail-card">

                <div class="classwork-detail-card-header">
                    <h2>Student Submissions</h2>
                </div>

                @php
                    $submittedCount = $exam->submissions->count();
                    $totalStudents = $classGroup->students->count();
                @endphp

                <div class="submission-summary">

                    <div class="submission-summary-icon">
                        <i class="bx bx-group"></i>
                    </div>

                    <div>

                        <strong>
                            {{ $submittedCount }} / {{ $totalStudents }}
                        </strong>

                        <span>
                            Students submitted
                        </span>

                    </div>

                </div>

                @if($exam->submissions->isNotEmpty())

                    <div class="submission-list">

                        @foreach($exam->submissions as $submission)

                            <div class="submission-item">

                                <div class="submission-student-icon">
                                    <i class="bx bx-user"></i>
                                </div>

                                <div class="submission-student-info">

                                    <strong>
                                        {{ $submission->student->name ?? 'Unknown Student' }}
                                    </strong>

                                    <span>

                                        Submitted
                                        {{
                                            $submission->submitted_at
                                                ? $submission->submitted_at->format('M d, Y \a\t h:i A')
                                                : 'Not submitted'
                                        }}

                                    </span>

                                </div>

                                @if($submission->score !== null)

                                    <span class="submission-grade-status graded">

                                        <i class="bx bx-check-circle"></i>
                                        Graded

                                        <span class="submission-grade-score">

                                            {{
                                                rtrim(
                                                    rtrim(
                                                        number_format($submission->score, 2),
                                                        '0'
                                                    ),
                                                    '.'
                                                )
                                            }}

                                            /

                                            {{
                                                rtrim(
                                                    rtrim(
                                                        number_format($exam->points, 2),
                                                        '0'
                                                    ),
                                                    '.'
                                                )
                                            }}

                                        </span>

                                    </span>

                                @else

                                    <span class="submission-grade-status ungraded">

                                        <i class="bx bx-time-five"></i>
                                        Ungraded

                                    </span>

                                @endif
<a
    href="{{ route(
        'professor.class-groups.exams.submissions.show',
        [
            'classGroup' => $classGroup->id,
            'exam' => $exam->id,
            'submission' => $submission->id,
            'origin' => $returnTo,
        ]
    ) }}"
    class="submission-view-btn">

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
                            No students have submitted this exam yet.
                        </p>

                    </div>

                @endif

            </section>

        </main>

        {{-- ========================================================
            SIDEBAR
        ======================================================== --}}

        <aside class="classwork-show-sidebar">

            {{-- EXAM DETAILS --}}

            <section class="classwork-detail-card">

                <div class="classwork-detail-card-header">
                    <h2>Exam Details</h2>
                </div>

                <div class="classwork-info-list">

                    <div class="classwork-info-item">

                        <i class="bx bx-star"></i>

                        <div>

                            <span>Points</span>

                            <strong>
                                {{
                                    rtrim(
                                        rtrim(
                                            number_format($exam->points ?? 0, 2),
                                            '0'
                                        ),
                                        '.'
                                    )
                                }}
                            </strong>

                        </div>

                    </div>

                    @if($exam->due_date)

                        <div class="classwork-info-item">

                            <i class="bx bx-calendar"></i>

                            <div>

                                <span>Due Date</span>

                                <strong>
                                    {{ \Carbon\Carbon::parse($exam->due_date)->format('M d, Y') }}
                                </strong>

                            </div>

                        </div>

                    @endif

                    @if($exam->due_time)

                        <div class="classwork-info-item">

                            <i class="bx bx-time"></i>

                            <div>

                                <span>Due Time</span>

                                <strong>
                                    {{ \Carbon\Carbon::parse($exam->due_time)->format('h:i A') }}
                                </strong>

                            </div>

                        </div>

                    @endif

                </div>

            </section>

            {{-- ACTIONS --}}

            <section class="classwork-detail-card">

                <div class="classwork-detail-card-header">
                    <h2>Actions</h2>
                </div>

                <a
                    href="{{ route(
                        'professor.class-groups.exams.edit',
                        [
                            'classGroup' => $classGroup->id,
                            'exam' => $exam->id,
                            'return_to' => 'show',
                            'origin' => $returnTo
                        ]
                    ) }}"
                    class="classwork-action-btn">

                    <i class="bx bx-edit"></i>
                    Edit Exam

                </a>

            </section>

        </aside>

    </div>

    {{-- ============================================================
        FILE PREVIEW MODAL
    ============================================================ --}}

    <div
        id="examPreviewModal"
        class="file-preview-modal"
        aria-hidden="true">

        <div class="file-preview-container">

            <div class="file-preview-header">

                <div class="file-preview-title">

                    <i class="bx bx-file"></i>

                    <span id="examPreviewTitle">
                        Exam Attachment
                    </span>

                </div>

                <div class="file-preview-actions">

                    <button
                        type="button"
                        id="examFullscreenBtn"
                        class="file-preview-action"
                        title="Full Screen">

                        <i class="bx bx-fullscreen"></i>

                    </button>

                    <button
                        type="button"
                        id="closeExamPreview"
                        class="file-preview-action close"
                        title="Close">

                        <i class="bx bx-x"></i>

                    </button>

                </div>

            </div>

            <div class="file-preview-body">

                <iframe
                    id="examPreviewFrame"
                    src=""
                    frameborder="0">
                </iframe>

            </div>

        </div>

    </div>

</div>

<script>
document.addEventListener('DOMContentLoaded', function () {

    const modal = document.getElementById('examPreviewModal');
    const fileButtons = document.querySelectorAll('.exam-file-open');
    const closeBtn = document.getElementById('closeExamPreview');
    const fullscreenBtn = document.getElementById('examFullscreenBtn');
    const preview = document.getElementById('examPreviewFrame');
    const previewTitle = document.getElementById('examPreviewTitle');

    const container = document.querySelector(
        '#examPreviewModal .file-preview-container'
    );

    function openExamPreview(fileUrl, fileTitle) {

        if (!fileUrl || !modal || !preview) {
            return;
        }

        preview.src = fileUrl;

        if (previewTitle) {
            previewTitle.textContent = fileTitle || 'Exam Attachment';
        }

        modal.classList.add('active');
        modal.setAttribute('aria-hidden', 'false');

        document.body.classList.add('modal-open');
    }

    async function closeExamPreview() {

        if (!modal || !preview) {
            return;
        }

        if (document.fullscreenElement) {
            try {
                await document.exitFullscreen();
            } catch (error) {
                console.error('Could not exit fullscreen:', error);
            }
        }

        modal.classList.remove('active');
        modal.setAttribute('aria-hidden', 'true');

        preview.src = '';

        document.body.classList.remove('modal-open');

        if (previewTitle) {
            previewTitle.textContent = 'Exam Attachment';
        }
    }

    fileButtons.forEach(function (button) {

        button.addEventListener('click', function () {

            openExamPreview(
                this.dataset.fileUrl,
                this.dataset.fileTitle
            );

        });

    });

    if (closeBtn) {
        closeBtn.addEventListener('click', closeExamPreview);
    }

    if (modal) {

        modal.addEventListener('click', function (event) {

            if (event.target === modal) {
                closeExamPreview();
            }

        });

    }

    if (fullscreenBtn && container) {

        fullscreenBtn.addEventListener('click', async function () {

            try {

                if (!document.fullscreenElement) {
                    await container.requestFullscreen();
                } else {
                    await document.exitFullscreen();
                }

            } catch (error) {
                console.error('Fullscreen error:', error);
            }

        });

    }

    document.addEventListener('keydown', function (event) {

        if (event.key === 'Escape' && modal.classList.contains('active')) {
            closeExamPreview();
        }

    });

});
</script>

@endsection