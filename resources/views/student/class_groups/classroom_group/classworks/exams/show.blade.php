<style>
/* ============================================================
   STUDENT EXAM SHOW
   Redesigned to match the Professor Exam Show
   Exam identity: RED
   Utility actions: BLUE
   ============================================================ */

.classwork-show-page {
    width: 100%;
    max-width: 1320px;
    margin: 0 auto;
    padding: 24px 30px 42px;

    --exam-red: #dc2626;
    --exam-red-dark: #b91c1c;
    --exam-soft: #fef2f2;
    --exam-light: #fee2e2;
    --exam-border: #fecaca;

    --blue: #2563eb;
    --blue-dark: #1d4ed8;
    --blue-soft: #eff6ff;
    --blue-border: #bfdbfe;

    --green: #16a34a;
    --green-soft: #f0fdf4;
    --green-border: #bbf7d0;

    --warning: #d97706;
    --warning-soft: #fffbeb;
    --warning-border: #fde68a;

    --text-color: var(--text-color, #111827);
    --text-secondary: var(--text-secondary, #6b7280);
    --text-muted: var(--text-muted, #9ca3af);
    --border-color: var(--border-color, #e5e7eb);
    --card-color: var(--card-color, #ffffff);
    --background-color: var(--background-color, #f8fafc);
}

/* ============================================================
   HEADER
   ============================================================ */

.classwork-show-header {
    margin-bottom: 28px;
}

.classwork-back-btn {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    margin-bottom: 24px;

    color: var(--text-secondary);
    text-decoration: none;

    font-size: 15px;
    font-weight: 600;

    transition: color .2s ease, transform .2s ease;
}

.classwork-back-btn i {
    font-size: 21px;
}

.classwork-back-btn:hover {
    color: var(--blue);
    transform: translateX(-2px);
}

.classwork-show-heading {
    display: flex;
    align-items: center;
    gap: 18px;
}

.classwork-show-icon {
    width: 60px;
    height: 60px;
    flex-shrink: 0;

    display: flex;
    align-items: center;
    justify-content: center;

    border-radius: 15px;
    font-size: 29px;
}

.classwork-show-icon.exam {
    background: var(--exam-soft);
    color: var(--exam-red);
}

.classwork-show-type {
    display: inline-block;
    margin-bottom: 5px;

    font-size: 13px;
    font-weight: 750;
    letter-spacing: .09em;
}

.classwork-show-type.exam {
    color: var(--exam-red);
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
    color: var(--blue);
    font-size: 18px;
}

/* ============================================================
   GRID
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
    min-width: 0;

    display: flex;
    flex-direction: column;
    gap: 24px;

    position: sticky;
    top: 24px;
}

/* ============================================================
   CARDS
   ============================================================ */

.classwork-detail-card {
    background: var(--card-color);
    border: 1px solid var(--border-color);
    border-radius: 18px;
    overflow: hidden;

    margin-bottom: 24px;

    box-shadow: 0 3px 14px rgba(15, 23, 42, .045);
}

.classwork-show-sidebar .classwork-detail-card {
    margin-bottom: 0;
}

.classwork-detail-card-header {
    min-height: 62px;

    display: flex;
    align-items: center;

    padding: 0 22px;

    border-bottom: 1px solid var(--border-color);
    position: relative;
}

.classwork-detail-card-header::before {
    content: "";
    width: 4px;
    height: 24px;

    margin-right: 12px;
    flex-shrink: 0;

    background: var(--exam-red);
    border-radius: 99px;
}

.classwork-detail-card-header h2 {
    margin: 0;
    color: var(--text-color);

    font-size: 18px;
    font-weight: 750;
}

/* ============================================================
   DESCRIPTION
   ============================================================ */

.classwork-description {
    padding: 24px;

    color: var(--text-secondary);
    font-size: 16px;
    line-height: 1.8;

    overflow-wrap: anywhere;
}

.classwork-no-content {
    color: var(--text-muted);
    font-style: italic;
}

/* ============================================================
   GOOGLE FORM
   ============================================================ */

.exam-form-section {
    padding: 20px 22px;
}

.exam-form-box {
    display: flex;
    align-items: center;
    gap: 15px;

    padding: 17px;

    background: var(--blue-soft);
    border: 1px solid var(--blue-border);
    border-radius: 13px;
}

.exam-form-icon {
    width: 48px;
    height: 48px;
    flex-shrink: 0;

    display: flex;
    align-items: center;
    justify-content: center;

    border-radius: 11px;

    background: #dbeafe;
    color: var(--blue);

    font-size: 23px;
}

.exam-form-info {
    min-width: 0;
    flex: 1;

    display: flex;
    flex-direction: column;
    gap: 4px;
}

.exam-form-info strong {
    color: var(--text-color);
    font-size: 15px;
    font-weight: 700;
}

.exam-form-info span {
    color: var(--text-secondary);
    font-size: 13px;
    line-height: 1.5;
}

.exam-form-open {
    flex-shrink: 0;

    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 7px;

    padding: 10px 16px;

    background: var(--blue);
    border: 1px solid var(--blue);
    border-radius: 9px;

    color: #fff;
    text-decoration: none;

    font-size: 13px;
    font-weight: 700;

    transition: background .2s ease, transform .2s ease, box-shadow .2s ease;
}

.exam-form-open i {
    font-size: 17px;
}

.exam-form-open:hover {
    background: var(--blue-dark);
    border-color: var(--blue-dark);
    color: #fff;
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(37, 99, 235, .18);
}

/* ============================================================
   ATTACHED FILES
   ============================================================ */

.classwork-file {
    display: flex;
    align-items: center;
    gap: 15px;

    padding: 18px 22px;

    border-bottom: 1px solid var(--border-color);
}

.classwork-file:last-child {
    border-bottom: 0;
}

.classwork-file-icon {
    width: 48px;
    height: 48px;
    flex-shrink: 0;

    display: flex;
    align-items: center;
    justify-content: center;

    border-radius: 11px;

    background: var(--exam-soft);
    color: var(--exam-red);

    font-size: 24px;
}

.classwork-file-info {
    flex: 1;
    min-width: 0;

    display: flex;
    flex-direction: column;
    gap: 4px;
}

.classwork-file-info strong {
    color: var(--text-color);
    font-size: 15px;
    font-weight: 650;

    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
}

.classwork-file-info span {
    color: var(--text-secondary);
    font-size: 13px;
}

.classwork-file-open {
    flex-shrink: 0;

    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 7px;

    padding: 9px 14px;

    border: 1px solid var(--blue-border);
    border-radius: 9px;

    background: #fff;
    color: var(--blue);

    font-size: 13px;
    font-weight: 650;
    cursor: pointer;

    transition: background .2s ease, border-color .2s ease, color .2s ease, transform .2s ease;
}

.classwork-file-open i {
    font-size: 17px;
}

.classwork-file-open:hover {
    background: var(--blue-soft);
    border-color: var(--blue);
    color: var(--blue-dark);
    transform: translateY(-1px);
}

.submission-placeholder {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;

    padding: 42px 24px;
    text-align: center;
}

.submission-placeholder i {
    margin-bottom: 10px;
    color: var(--text-muted);
    font-size: 35px;
}

.submission-placeholder p {
    margin: 0;
    color: var(--text-muted);
    font-size: 15px;
}

/* ============================================================
   SUBMISSION STATUS
   ============================================================ */

.exam-submission-status {
    padding: 21px 22px;
    border-bottom: 1px solid var(--border-color);
}

.exam-submission-status-content {
    display: flex;
    align-items: center;
    gap: 15px;
}

.exam-submission-status-icon {
    width: 48px;
    height: 48px;
    flex-shrink: 0;

    display: flex;
    align-items: center;
    justify-content: center;

    border-radius: 12px;
}

.exam-submission-status-icon.pending {
    background: var(--warning-soft);
    color: var(--warning);
}

.exam-submission-status-icon.submitted {
    background: var(--green-soft);
    color: var(--green);
}

.exam-submission-status-icon i {
    font-size: 25px;
}

.exam-submission-status-info {
    display: flex;
    flex-direction: column;
    gap: 4px;
}

.exam-submission-status-info strong {
    color: var(--text-color);
    font-size: 17px;
    font-weight: 750;
}

.exam-submission-status-info span {
    color: var(--text-secondary);
    font-size: 13px;
}

/* ============================================================
   GRADE / FEEDBACK
   ============================================================ */

.exam-submission-result {
    margin: 20px 22px;
    padding: 16px 17px;

    background: var(--blue-soft);
    border: 1px solid var(--blue-border);
    border-radius: 13px;
}

.exam-submission-result-item {
    display: flex;
    align-items: flex-start;
    gap: 11px;
    padding: 11px 0;
}

.exam-submission-result-item:first-child {
    padding-top: 0;
}

.exam-submission-result-item:last-child {
    padding-bottom: 0;
}

.exam-submission-result-item + .exam-submission-result-item {
    border-top: 1px solid var(--blue-border);
}

.exam-submission-result-item > i {
    margin-top: 2px;
    color: var(--blue);
    font-size: 19px;
    flex-shrink: 0;
}

.exam-submission-result-content {
    display: flex;
    flex-direction: column;
    gap: 4px;
    min-width: 0;
}

.exam-submission-result-content span {
    color: var(--text-secondary);
    font-size: 13px;
}

.exam-submission-result-content strong {
    color: var(--text-color);
    font-size: 18px;
    font-weight: 750;
}

.exam-submission-result-content small {
    color: var(--text-secondary);
    font-size: 12px;
}

.exam-submission-feedback {
    color: var(--text-color);
    font-size: 14px;
    line-height: 1.65;
    white-space: pre-wrap;
}

/* ============================================================
   SUBMITTED FILES
   ============================================================ */

.exam-submitted-files {
    margin-top: 18px;
    padding: 18px 22px 0;
    border-top: 1px solid var(--border-color);
}

.exam-submitted-files-title {
    display: flex;
    align-items: center;
    gap: 8px;

    margin-bottom: 11px;

    color: var(--text-color);
    font-size: 14px;
    font-weight: 700;
}

.exam-submitted-files-title i {
    color: var(--blue);
    font-size: 18px;
}

.exam-submitted-file-list {
    display: flex;
    flex-direction: column;
    gap: 8px;
}

.exam-submitted-file {
    display: flex;
    align-items: center;
    gap: 11px;

    padding: 11px 12px;

    background: var(--background-color);
    border: 1px solid var(--border-color);
    border-radius: 9px;
}

.exam-submitted-file-icon {
    width: 32px;
    height: 32px;
    flex-shrink: 0;

    display: flex;
    align-items: center;
    justify-content: center;

    border-radius: 8px;

    background: var(--exam-soft);
    color: var(--exam-red);

    font-size: 17px;
}

.exam-submitted-file-info {
    min-width: 0;
    flex: 1;

    display: flex;
    flex-direction: column;
    gap: 3px;
}

.exam-submitted-file-info strong {
    color: var(--text-color);
    font-size: 13px;
    font-weight: 650;

    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
}

.exam-submitted-file-info span {
    color: var(--text-muted);
    font-size: 11px;
}

/* ============================================================
   SUBMISSION FORM / UPLOAD
   ============================================================ */

.exam-submission-form {
    padding: 21px 22px;
}

.exam-form-reminder {
    display: flex;
    align-items: center;
    gap: 13px;

    margin-bottom: 18px;
    padding: 15px;

    background: var(--warning-soft);
    border: 1px solid var(--warning-border);
    border-radius: 11px;
}

.exam-form-reminder-icon {
    width: 40px;
    height: 40px;
    flex-shrink: 0;

    display: flex;
    align-items: center;
    justify-content: center;

    border-radius: 9px;

    background: #fef3c7;
    color: var(--warning);

    font-size: 20px;
}

.exam-form-reminder-info {
    min-width: 0;
    flex: 1;

    display: flex;
    flex-direction: column;
    gap: 3px;
}

.exam-form-reminder-info strong {
    color: var(--text-color);
    font-size: 14px;
    font-weight: 700;
}

.exam-form-reminder-info span {
    color: var(--text-secondary);
    font-size: 12px;
    line-height: 1.5;
}

.exam-file-submission {
    padding: 18px;

    background: var(--background-color);
    border: 1px solid var(--border-color);
    border-radius: 13px;
}

.exam-file-submission-header {
    margin-bottom: 14px;

    display: flex;
    flex-direction: column;
    gap: 3px;
}

.exam-file-submission-header strong {
    color: var(--text-color);
    font-size: 15px;
    font-weight: 700;
}

.exam-file-submission-header span {
    color: var(--text-secondary);
    font-size: 12px;
}

.exam-upload-area {
    display: flex;
    align-items: center;
    gap: 14px;

    padding: 17px;

    background: var(--card-color);
    border: 1.5px dashed var(--blue-border);
    border-radius: 11px;

    cursor: pointer;

    transition: border-color .2s ease, background .2s ease, box-shadow .2s ease;
}

.exam-upload-area:hover {
    border-color: var(--blue);
    background: var(--blue-soft);
    box-shadow: 0 4px 12px rgba(37, 99, 235, .08);
}

.exam-upload-icon {
    width: 46px;
    height: 46px;
    flex-shrink: 0;

    display: flex;
    align-items: center;
    justify-content: center;

    border-radius: 10px;

    background: var(--blue-soft);
    color: var(--blue);

    font-size: 23px;
}

.exam-upload-content {
    display: flex;
    flex-direction: column;
    gap: 4px;
    min-width: 0;
}

.exam-upload-content strong {
    color: var(--text-color);
    font-size: 14px;
    font-weight: 700;
}

.exam-upload-content span {
    color: var(--text-secondary);
    font-size: 12px;
}

.exam-selected-files {
    margin-top: 12px;

    display: flex;
    flex-direction: column;
    gap: 7px;
}

.exam-selected-file {
    display: flex;
    align-items: center;
    gap: 10px;

    padding: 10px 12px;

    background: var(--card-color);
    border: 1px solid var(--border-color);
    border-radius: 9px;
}

.exam-selected-file > i {
    flex-shrink: 0;
    color: var(--blue);
    font-size: 18px;
}

.exam-selected-file-name {
    min-width: 0;
    flex: 1;

    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;

    color: var(--text-color);
    font-size: 12px;
}

.exam-selected-file-size {
    flex-shrink: 0;
    color: var(--text-muted);
    font-size: 11px;
}

.exam-submit-wrapper {
    margin-top: 17px;
}

.exam-submit-button {
    width: 100%;

    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 8px;

    padding: 13px 17px;

    background: var(--exam-red);
    border: 1px solid var(--exam-red);
    border-radius: 10px;

    color: #fff;

    font-size: 15px;
    font-weight: 700;

    cursor: pointer;

    transition: background .2s ease, border-color .2s ease, transform .2s ease, box-shadow .2s ease;
}

.exam-submit-button i {
    font-size: 19px;
}

.exam-submit-button:hover {
    background: var(--exam-red-dark);
    border-color: var(--exam-red-dark);
    transform: translateY(-1px);
    box-shadow: 0 5px 14px rgba(220, 38, 38, .18);
}

.exam-submit-note {
    margin: 10px 0 0;

    color: var(--text-muted);
    text-align: center;

    font-size: 12px;
    line-height: 1.5;
}

/* ============================================================
   CANCEL
   ============================================================ */

.exam-cancel-wrapper {
    padding: 18px 22px 22px;
}

.exam-cancel-button {
    width: 100%;

    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 8px;

    padding: 11px 15px;

    background: transparent;
    border: 1px solid rgba(220, 38, 38, .30);
    border-radius: 9px;

    color: var(--exam-red);

    font-size: 13px;
    font-weight: 650;

    cursor: pointer;

    transition: background .2s ease, border-color .2s ease, transform .2s ease;
}

.exam-cancel-button:hover {
    background: var(--exam-soft);
    border-color: var(--exam-red);
    transform: translateY(-1px);
}

.exam-cancel-button:disabled {
    opacity: .55;
    cursor: not-allowed;
    transform: none;
}

.exam-cancel-button:disabled:hover {
    background: transparent;
    transform: none;
}

.exam-cancel-note {
    margin: 9px 0 0;

    color: var(--text-muted);
    text-align: center;

    font-size: 11px;
    line-height: 1.5;
}

.exam-cancel-note.expired {
    color: var(--exam-red);
}

/* ============================================================
   SIDEBAR INFORMATION
   ============================================================ */

.classwork-info-list {
    display: flex;
    flex-direction: column;
}

.classwork-info-item {
    display: flex;
    align-items: center;
    gap: 13px;

    padding: 17px 20px;

    border-bottom: 1px solid var(--border-color);
}

.classwork-info-item:last-child {
    border-bottom: none;
}

.classwork-info-item > i {
    width: 38px;
    height: 38px;
    flex-shrink: 0;

    display: flex;
    align-items: center;
    justify-content: center;

    border-radius: 9px;

    background: var(--blue-soft);
    color: var(--blue);

    font-size: 19px;
}

.classwork-info-item > div {
    display: flex;
    flex-direction: column;
    gap: 3px;
    min-width: 0;
}

.classwork-info-item span {
    color: var(--text-secondary);
    font-size: 12px;
    font-weight: 550;
}

.classwork-info-item strong {
    color: var(--text-color);
    font-size: 15px;
    font-weight: 700;
    word-break: break-word;
}

.classwork-info-item strong {
    overflow-wrap: anywhere;
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

    padding: 24px;

    background: rgba(15, 23, 42, .72);
    backdrop-filter: blur(3px);
}

.file-preview-modal.active {
    display: flex;
}

.file-preview-container {
    width: 100%;
    max-width: 1200px;
    height: 90vh;

    display: flex;
    flex-direction: column;

    overflow: hidden;

    background: var(--card-color);
    border: 1px solid var(--border-color);
    border-radius: 16px;

    box-shadow: 0 25px 70px rgba(0, 0, 0, .30);
}

.file-preview-header {
    min-height: 62px;

    display: flex;
    align-items: center;
    justify-content: space-between;

    padding: 0 18px;

    background: var(--card-color);
    border-bottom: 1px solid var(--border-color);

    flex-shrink: 0;
}

.file-preview-title {
    display: flex;
    align-items: center;
    gap: 10px;

    min-width: 0;

    color: var(--text-color);
    font-size: 15px;
    font-weight: 700;
}

.file-preview-title i {
    flex-shrink: 0;
    color: var(--exam-red);
    font-size: 21px;
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
    width: 39px;
    height: 39px;

    display: flex;
    align-items: center;
    justify-content: center;

    border: none;
    border-radius: 8px;

    background: transparent;
    color: var(--text-color);

    cursor: pointer;

    transition: background .2s ease, color .2s ease, transform .2s ease;
}

.file-preview-action i {
    font-size: 22px;
}

.file-preview-action:hover {
    background: var(--blue-soft);
    color: var(--blue);
    transform: translateY(-1px);
}

.file-preview-body {
    flex: 1;
    min-height: 0;
    background: #f4f4f4;
}

.file-preview-body iframe {
    width: 100%;
    height: 100%;
    display: block;
    border: none;
}

body.modal-open {
    overflow: hidden;
}

.file-preview-container:fullscreen {
    width: 100vw;
    height: 100vh;
    max-width: none;

    border: none;
    border-radius: 0;
}

/* ============================================================
   RESPONSIVE
   ============================================================ */

@media (max-width: 1050px) {
    .classwork-show-page {
        padding-left: 24px;
        padding-right: 24px;
    }

    .classwork-show-grid {
        grid-template-columns: minmax(0, 1fr) 290px;
        gap: 20px;
    }
}

@media (max-width: 900px) {
    .classwork-show-grid {
        grid-template-columns: 1fr;
    }

    .classwork-show-sidebar {
        position: static;

        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 20px;
    }

    .classwork-show-sidebar .classwork-detail-card {
        margin-bottom: 0;
    }
}

@media (max-width: 650px) {
    .classwork-show-page {
        padding: 20px 16px 38px;
    }

    .classwork-back-btn {
        margin-bottom: 20px;
        font-size: 14px;
    }

    .classwork-show-heading {
        align-items: flex-start;
        gap: 14px;
    }

    .classwork-show-icon {
        width: 50px;
        height: 50px;
        border-radius: 12px;
        font-size: 24px;
    }

    .classwork-show-heading h1 {
        font-size: 24px;
    }

    .classwork-show-type {
        font-size: 11px;
    }

    .classwork-show-topic {
        font-size: 13px;
    }

    .classwork-show-sidebar {
        display: flex;
        flex-direction: column;
        gap: 20px;
    }

    .classwork-detail-card-header {
        min-height: 58px;
        padding: 0 18px;
    }

    .classwork-detail-card-header h2 {
        font-size: 17px;
    }

    .classwork-description {
        padding: 19px 18px;
        font-size: 15px;
    }

    .classwork-file {
        align-items: flex-start;
        flex-wrap: wrap;
        padding: 16px 18px;
    }

    .classwork-file-info strong {
        white-space: normal;
        overflow-wrap: anywhere;
    }

    .classwork-file-open {
        width: 100%;
    }

    .exam-form-section {
        padding: 17px 18px;
    }

    .exam-form-box {
        align-items: flex-start;
        flex-wrap: wrap;
    }

    .exam-form-open {
        width: 100%;
    }

    .exam-submission-form {
        padding: 18px;
    }

    .exam-submission-status {
        padding: 18px;
    }

    .exam-submission-result {
        margin: 18px;
    }

    .exam-submitted-files {
        padding-left: 18px;
        padding-right: 18px;
    }

    .exam-cancel-wrapper {
        padding: 16px 18px 18px;
    }

    .file-preview-modal {
        padding: 10px;
    }

    .file-preview-container {
        height: 95vh;
        border-radius: 10px;
    }

    .file-preview-header {
        min-height: 55px;
        padding: 0 12px;
    }
}

@media (max-width: 520px) {
    .exam-upload-area {
        align-items: flex-start;
    }

    .exam-form-reminder {
        align-items: flex-start;
    }

    .exam-file-submission {
        padding: 14px;
    }

    .classwork-info-item {
        padding: 15px 18px;
    }

    .classwork-info-item > i {
        width: 35px;
        height: 35px;
        font-size: 18px;
    }
}

/* ============================================================
   DARK MODE
   ============================================================ */

[data-theme="dark"] .classwork-show-icon.exam {
    background: rgba(220, 38, 38, .15);
    color: #f87171;
}

[data-theme="dark"] .classwork-show-type.exam {
    color: #f87171;
}

[data-theme="dark"] .classwork-file-icon,
[data-theme="dark"] .exam-submitted-file-icon {
    background: rgba(220, 38, 38, .14);
    color: #f87171;
}

[data-theme="dark"] .exam-form-box {
    background: rgba(37, 99, 235, .10);
    border-color: rgba(96, 165, 250, .25);
}

[data-theme="dark"] .exam-form-icon {
    background: rgba(37, 99, 235, .15);
    color: #60a5fa;
}

[data-theme="dark"] .exam-upload-area:hover {
    background: rgba(37, 99, 235, .08);
}

[data-theme="dark"] .exam-submission-result {
    background: rgba(37, 99, 235, .09);
    border-color: rgba(96, 165, 250, .22);
}

/* ============================================================
   ALL CARDS — WHITE BACKGROUND
   ============================================================ */

/* Main cards */
.classwork-detail-card,
.file-preview-container,
.file-preview-header {
    background: #ffffff;
}

/* Inner card/box sections */
.exam-form-box,
.exam-submission-result,
.exam-file-submission,
.exam-upload-area,
.exam-selected-file,
.exam-submitted-file {
    background: #ffffff;
}

/* Keep the file preview area separate */
.file-preview-body {
    background: #f4f4f4;
}

/* Keep colored status/reminder areas */
.exam-form-reminder {
    background: var(--warning-soft);
}

/* Keep icon backgrounds colored */
.exam-form-icon {
    background: #dbeafe;
}

.exam-upload-icon {
    background: var(--blue-soft);
}

.exam-submission-status-icon.pending {
    background: var(--warning-soft);
}

.exam-submission-status-icon.submitted {
    background: var(--green-soft);
}

.classwork-file-icon,
.exam-submitted-file-icon {
    background: var(--exam-soft);
}

/* White card on hover — only border/accent changes */
.exam-upload-area:hover {
    background: #ffffff;
}
</style>


@extends('layouts.student_layout')

@section('title', 'Exam')

@section('content')



@php




/*
|--------------------------------------------------------------------------
| Submission state
|--------------------------------------------------------------------------
*/

$isSubmitted =
$submission &&
$submission->submitted_at;


/*
|--------------------------------------------------------------------------
| Calculate exam deadline
|--------------------------------------------------------------------------
*/

$isPastDue = false;

$dueAt = null;

if ($exam->due_date) {

$dueAt = \Carbon\Carbon::parse(
$exam->due_date
);

if ($exam->due_time) {

$dueAt->setTimeFromTimeString(
$exam->due_time
);

} else {

$dueAt->endOfDay();

}

$isPastDue =
now()->greaterThan($dueAt);
}

@endphp


<div class="classwork-show-page">


    {{-- ========================================================
         HEADER
    ========================================================= --}}

    <div class="classwork-show-header">


<a
    href="{{
        $returnTo === 'marks'
            ? route(
                'student.class-groups.marks',
                $classGroup
            )
            : ($returnTo === 'classwork'
                ? route(
                    'student.class-groups.classroom-group.classwork',
                    $classGroup
                )
                : route(
                    'student.class-groups.classroom-group',
                    $classGroup
                )
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


        <div class="classwork-show-heading">


            <div class="classwork-show-icon exam">

                <i class="bx bx-edit-alt"></i>

            </div>


            <div>

                <span class="classwork-show-type exam">
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



    {{-- ========================================================
         MAIN GRID
    ========================================================= --}}

    <div class="classwork-show-grid">


        {{-- ====================================================
             MAIN
        ===================================================== --}}

        <div class="classwork-show-main">


            {{-- ====================================================
                 EXAM INSTRUCTIONS
            ===================================================== --}}

            <section class="classwork-detail-card">

                <div class="classwork-detail-card-header">

                    <h2>
                        Exam Instructions
                    </h2>

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
===================================================== --}}

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

                            <strong>Google Form Exam</strong>

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
            ===================================================== --}}
{{-- ====================================================
     ATTACHED FILES
===================================================== --}}

@php
    $hasLegacyAttachment = !empty($exam->attachment);

    $fileResources = $exam->resources->filter(function ($resource) {
        return !empty($resource->file_path);
    });

    $hasAttachedFiles = $hasLegacyAttachment || $fileResources->isNotEmpty();
@endphp

@if($hasAttachedFiles)

    <section class="classwork-detail-card">

        <div class="classwork-detail-card-header">
            <h2>
                Attached Files
            </h2>
        </div>

        {{-- ==================================================
             LEGACY SINGLE ATTACHMENT
        =================================================== --}}

        @if($hasLegacyAttachment)

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
                    data-file-title="{{ basename($exam->attachment) }}"
                >
                    <i class="bx bx-show"></i>
                    Open
                </button>

            </div>

        @endif


        {{-- ==================================================
             RESOURCE FILES
        =================================================== --}}

        @foreach($fileResources as $resource)

            <div class="classwork-file">

                <div class="classwork-file-icon">
                    <i class="bx bx-file"></i>
                </div>

                <div class="classwork-file-info">

                    <strong>
                        {{ $resource->file_name ?: $resource->title }}
                    </strong>

                    <span>
                        @if($resource->file_size)

                            {{ number_format($resource->file_size / 1024, 1) }}
                            KB

                        @else

                            Exam attachment

                        @endif
                    </span>

                </div>

                <button
                    type="button"
                    class="classwork-file-open exam-file-open"
                    data-file-url="{{ asset('storage/' . $resource->file_path) }}"
                    data-file-title="{{ $resource->file_name ?: $resource->title }}"
                >
                    <i class="bx bx-show"></i>
                    Open
                </button>

            </div>

        @endforeach

    </section>

@endif


            {{-- ====================================================
                 MY SUBMISSION
            ===================================================== --}}

            <section class="classwork-detail-card">

                <div class="classwork-detail-card-header">

                    <h2>
                        My Submission
                    </h2>

                </div>


                {{-- ==================================================
                     SUBMITTED
                =================================================== --}}

                @if($isSubmitted)


                <div class="exam-submission-status">


                    <div class="exam-submission-status-content">


                        <div class="exam-submission-status-icon submitted">

                            <i class="bx bx-check-circle"></i>

                        </div>


                        <div class="exam-submission-status-info">

                            <strong>
                                Exam Submitted
                            </strong>

                            <span>
                                Submitted
                                {{ $submission->submitted_at->format('M d, Y \a\t h:i A') }}
                            </span>

                        </div>

                    </div>


                {{-- ==================================================
                     GRADE / FEEDBACK
                =================================================== --}}

                @if($submission->score !== null)

                @php
                    $examPoints = (float) ($exam->points ?? 0);
                    $examScore = (float) $submission->score;
                    $examPercentage = $examPoints > 0
                        ? ($examScore / $examPoints) * 100
                        : 0;
                @endphp

                <div class="exam-submission-result">

                    <div class="exam-submission-result-item">

                        <i class="bx bx-star"></i>

                        <div class="exam-submission-result-content">

                            <span>
                                Your Grade
                            </span>

                            <strong>
                                {{ rtrim(rtrim(number_format($examScore, 2), '0'), '.') }}
                                /
                                {{ rtrim(rtrim(number_format($examPoints, 2), '0'), '.') }}
                                ({{ rtrim(rtrim(number_format($examPercentage, 2), '0'), '.') }}%)
                            </strong>

                        </div>

                    </div>


                    @if($submission->feedback)

                    <div class="exam-submission-result-item">

                        <i class="bx bx-message-detail"></i>

                        <div class="exam-submission-result-content">

                            <span>
                                Professor Feedback
                            </span>

                            <div class="exam-submission-feedback">
                                {{ $submission->feedback }}
                            </div>

                        </div>

                    </div>

                    @endif


                    @if($submission->graded_at)

                    <div class="exam-submission-result-item">

                        <i class="bx bx-calendar-check"></i>

                        <div class="exam-submission-result-content">

                            <span>
                                Graded On
                            </span>

                            <small>
                                {{ $submission->graded_at->format('M d, Y 	 h:i A') }}
                            </small>

                        </div>

                    </div>

                    @endif

                </div>

                @endif



                    {{-- ==================================================
                             SUBMITTED FILES
                        =================================================== --}}

                    @if(
                    $submission->resources &&
                    $submission->resources->count()
                    )

                    <div class="exam-submitted-files">


                        <div class="exam-submitted-files-title">

                            <i class="bx bx-paperclip"></i>

                            Submitted Files

                        </div>


                        <div class="exam-submitted-file-list">


                            @foreach(
                            $submission->resources
                            as $resource
                            )

                            <div class="exam-submitted-file">


                                <div class="exam-submitted-file-icon">

                                    <i class="bx bx-file"></i>

                                </div>


                                <div class="exam-submitted-file-info">

                                    <strong>

                                        {{
                                                        $resource->file_name
                                                        ?? $resource->title
                                                        ?? basename($resource->file_path)
                                                    }}

                                    </strong>


                                    <span>

                                        @if($resource->file_size)

                                        {{
                                                            number_format(
                                                                $resource->file_size / 1024,
                                                                1
                                                            )
                                                        }}
                                        KB

                                        @else

                                        Submitted file

                                        @endif

                                    </span>

                                </div>

                            </div>

                            @endforeach

                        </div>

                    </div>

                    @endif

                </div>



                {{-- ==================================================
                         CANCEL SUBMISSION
                    =================================================== --}}

                <div class="exam-cancel-wrapper">


                    <form
                        action="{{ route(
                                'student.class-groups.exams.cancel',
                                [
                                    'classGroup' => $classGroup->id,
                                    'exam' => $exam->id,
                                ]
                            ) }}"
                        method="POST"
                        onsubmit="return confirm(
                                'Are you sure you want to cancel your submission?'
                            );">

                        @csrf

                        @method('DELETE')


                        <input
                            type="hidden"
                            name="return_to"
                            value="{{ $returnTo }}">


                        <button
                            type="submit"
                            class="exam-cancel-button"
                            {{ $isPastDue ? 'disabled' : '' }}>

                            <i class="bx bx-undo"></i>

                            Cancel Submission

                        </button>

                    </form>


                    @if($isPastDue)

                    <p class="exam-cancel-note expired">

                        The exam deadline has passed.
                        Your submission can no longer be cancelled.

                    </p>

                    @else

                    <p class="exam-cancel-note">

                        You can cancel your submission before the exam deadline.

                    </p>

                    @endif

                </div>


                {{-- ==================================================
                     NOT SUBMITTED
                =================================================== --}}

                @else


                <form
                    action="{{ route(
                            'student.class-groups.exams.submit',
                            [
                                'classGroup' => $classGroup->id,
                                'exam' => $exam->id,
                            ]
                        ) }}"
                    method="POST"
                    enctype="multipart/form-data"
                    class="exam-submission-form">

                    @csrf


                    <input
                        type="hidden"
                        name="return_to"
                        value="{{ $returnTo }}">


                    {{-- ==================================================
                             GOOGLE FORM REMINDER
                        =================================================== --}}

                    @if($exam->google_form_url)

                    <div class="exam-form-reminder">


                        <div class="exam-form-reminder-icon">

                            <i class="bx bx-info-circle"></i>

                        </div>


                        <div class="exam-form-reminder-info">

                            <strong>
                                Complete the Google Form first
                            </strong>

                            <span>
                                After completing the exam,
                                click "I Have Submitted" below.
                            </span>

                        </div>

                    </div>

                    @endif



                    {{-- ==================================================
                             FILE UPLOAD
                        =================================================== --}}

                    <div class="exam-file-submission">


                        <div class="exam-file-submission-header">

                            <strong>
                                Upload Your Work
                            </strong>

                            <span>
                                Add your answers, supporting work,
                                or additional files.
                            </span>

                        </div>


                        <label
                            for="examSubmissionFiles"
                            class="exam-upload-area">

                            <input
                                type="file"
                                name="attachments[]"
                                id="examSubmissionFiles"
                                multiple
                                hidden>


                            <div class="exam-upload-icon">

                                <i class="bx bx-cloud-upload"></i>

                            </div>


                            <div class="exam-upload-content">

                                <strong>
                                    Choose Files
                                </strong>

                                <span>
                                    You can select multiple files.
                                </span>

                            </div>

                        </label>


                        <div
                            id="examSelectedFiles"
                            class="exam-selected-files"
                            style="display: none;"></div>

                    </div>



                    {{-- ==================================================
                             FINAL SUBMIT
                        =================================================== --}}

                    <div class="exam-submit-wrapper">


                        <button
                            type="submit"
                            class="exam-submit-button">

                            <i class="bx bx-send"></i>


                            @if($exam->google_form_url)

                            I Have Submitted

                            @else

                            Submit Exam

                            @endif

                        </button>


                        <p class="exam-submit-note">

                            @if($exam->google_form_url)

                            Complete the Google Form first.
                            You may also upload additional work above.

                            @else

                            Upload your work and click Submit Exam.

                            @endif

                        </p>

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
                 EXAM DETAILS
            ===================================================== --}}

            <section class="classwork-detail-card">


                <div class="classwork-detail-card-header">

                    <h2>
                        Exam Details
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
                                {{ $exam->points ?? 0 }}
                            </strong>

                        </div>

                    </div>



                    {{-- DUE DATE --}}

                    @if($exam->due_date)

                    <div class="classwork-info-item">

                        <i class="bx bx-calendar"></i>

                        <div>

                            <span>
                                Due Date
                            </span>

                            <strong>
                                {{ \Carbon\Carbon::parse(
                                        $exam->due_date
                                    )->format('M d, Y') }}
                            </strong>

                        </div>

                    </div>

                    @endif



                    {{-- DUE TIME --}}

                    @if($exam->due_time)

                    <div class="classwork-info-item">

                        <i class="bx bx-time"></i>

                        <div>

                            <span>
                                Due Time
                            </span>

                            <strong>
                                {{ \Carbon\Carbon::parse(
                                        $exam->due_time
                                    )->format('h:i A') }}
                            </strong>

                        </div>

                    </div>

                    @endif

                </div>

            </section>



            {{-- ====================================================
                 SUBMISSION
            ===================================================== --}}

            <section class="classwork-detail-card">


                <div class="classwork-detail-card-header">

                    <h2>
                        Submission
                    </h2>

                </div>


                <div class="classwork-info-list">


                    {{-- STATUS --}}

                    <div class="classwork-info-item">

                        <i class="bx bx-check-circle"></i>

                        <div>

                            <span>
                                Status
                            </span>

                            <strong>

                                @if($isSubmitted)

                                Submitted

                                @else

                                Not Submitted

                                @endif

                            </strong>

                        </div>

                    </div>



                    {{-- SUBMITTED ON --}}

                    @if($isSubmitted)

                    <div class="classwork-info-item">

                        <i class="bx bx-calendar-check"></i>

                        <div>

                            <span>
                                Submitted On
                            </span>

                            <strong>
                                {{ $submission->submitted_at->format(
                                        'M d, Y'
                                    ) }}
                            </strong>

                        </div>

                    </div>

                    @endif


                    {{-- GRADE --}}

                    @if($isSubmitted && $submission->score !== null)

                    <div class="classwork-info-item">

                        <i class="bx bx-star"></i>

                        <div>

                            <span>
                                Grade
                            </span>

                            <strong>
                                {{ rtrim(rtrim(number_format($submission->score, 2), '0'), '.') }}
                                /
                                {{ rtrim(rtrim(number_format($exam->points ?? 0, 2), '0'), '.') }}
                            </strong>

                        </div>

                    </div>

                    @endif



                    {{-- DEADLINE --}}

                    @if($exam->due_date)

                    <div class="classwork-info-item">

                        <i class="bx bx-time-five"></i>

                        <div>

                            <span>
                                Deadline
                            </span>

                            <strong>

                                @if($isPastDue)

                                Past Due

                                @else

                                Open

                                @endif

                            </strong>

                        </div>

                    </div>

                    @endif

                </div>

            </section>

        </aside>

    </div>

</div>



{{-- ============================================================
     EXAM FILE PREVIEW MODAL
============================================================ --}}

<div
    id="examPreviewModal"
    class="file-preview-modal"
    aria-hidden="true">


    <div class="file-preview-container">


        {{-- MODAL HEADER --}}

        <div class="file-preview-header">


            <div class="file-preview-title">

                <i class="bx bx-file"></i>

                <span id="examPreviewTitle">
                    Exam Attachment
                </span>

            </div>


            <div class="file-preview-actions">


                {{-- FULLSCREEN --}}

                <button
                    type="button"
                    id="examFullscreenBtn"
                    class="file-preview-action"
                    title="Full Screen">

                    <i class="bx bx-fullscreen"></i>

                </button>


                {{-- CLOSE --}}

                <button
                    type="button"
                    id="closeExamPreview"
                    class="file-preview-action"
                    title="Close">

                    <i class="bx bx-x"></i>

                </button>

            </div>

        </div>



        {{-- FILE PREVIEW --}}

        <div class="file-preview-body">

            <iframe
                id="examPreviewFrame"
                src=""
                frameborder="0"></iframe>

        </div>

    </div>

</div>



<script>
    document.addEventListener('DOMContentLoaded', function() {


        /* ============================================================
           FILE UPLOAD DISPLAY
        ============================================================ */

        const submissionFilesInput =
            document.getElementById(
                'examSubmissionFiles'
            );

        const selectedFilesContainer =
            document.getElementById(
                'examSelectedFiles'
            );


        if (
            submissionFilesInput &&
            selectedFilesContainer
        ) {

            submissionFilesInput.addEventListener(
                'change',
                function() {


                    selectedFilesContainer.innerHTML = '';


                    if (!this.files.length) {

                        selectedFilesContainer.style.display =
                            'none';

                        return;

                    }


                    selectedFilesContainer.style.display =
                        'flex';


                    Array.from(this.files).forEach(
                        function(file) {


                            const fileItem =
                                document.createElement('div');

                            fileItem.className =
                                'exam-selected-file';


                            const icon =
                                document.createElement('i');

                            icon.className =
                                'bx bx-file';


                            const name =
                                document.createElement('span');

                            name.className =
                                'exam-selected-file-name';

                            name.textContent =
                                file.name;


                            const size =
                                document.createElement('span');

                            size.className =
                                'exam-selected-file-size';


                            const sizeKB =
                                file.size / 1024;


                            if (sizeKB >= 1024) {

                                size.textContent =
                                    (sizeKB / 1024).toFixed(1) +
                                    ' MB';

                            } else {

                                size.textContent =
                                    sizeKB.toFixed(1) +
                                    ' KB';

                            }


                            fileItem.appendChild(icon);

                            fileItem.appendChild(name);

                            fileItem.appendChild(size);


                            selectedFilesContainer.appendChild(
                                fileItem
                            );

                        }
                    );

                }
            );

        }



        /* ============================================================
           FILE PREVIEW MODAL
        ============================================================ */

        const modal =
            document.getElementById(
                'examPreviewModal'
            );

        const fileButtons =
            document.querySelectorAll(
                '.exam-file-open'
            );

        const closeBtn =
            document.getElementById(
                'closeExamPreview'
            );

        const fullscreenBtn =
            document.getElementById(
                'examFullscreenBtn'
            );

        const preview =
            document.getElementById(
                'examPreviewFrame'
            );

        const previewTitle =
            document.getElementById(
                'examPreviewTitle'
            );

        const container =
            document.querySelector(
                '#examPreviewModal .file-preview-container'
            );


        if (
            !modal ||
            !preview ||
            !container
        ) {
            return;
        }



        /* ============================================================
           OPEN FILE
        ============================================================ */

        fileButtons.forEach(function(button) {

            button.addEventListener(
                'click',
                function() {


                    const fileUrl =
                        this.dataset.fileUrl;

                    const fileTitle =
                        this.dataset.fileTitle ||
                        'Exam Attachment';


                    if (!fileUrl) {
                        return;
                    }


                    preview.src =
                        fileUrl;


                    if (previewTitle) {

                        previewTitle.textContent =
                            fileTitle;

                    }


                    modal.classList.add(
                        'active'
                    );

                    modal.setAttribute(
                        'aria-hidden',
                        'false'
                    );

                    document.body.classList.add(
                        'modal-open'
                    );

                }
            );

        });



        /* ============================================================
           CLOSE MODAL
        ============================================================ */

        async function closeExamPreview() {


            if (document.fullscreenElement) {

                try {

                    await document.exitFullscreen();

                } catch (error) {

                    console.error(
                        'Could not exit fullscreen:',
                        error
                    );

                }

            }


            modal.classList.remove(
                'active'
            );

            modal.setAttribute(
                'aria-hidden',
                'true'
            );

            preview.src = '';


            document.body.classList.remove(
                'modal-open'
            );


            if (previewTitle) {

                previewTitle.textContent =
                    'Exam Attachment';

            }

        }



        /* ============================================================
           CLOSE BUTTON
        ============================================================ */

        if (closeBtn) {

            closeBtn.addEventListener(
                'click',
                closeExamPreview
            );

        }



        /* ============================================================
           CLICK OUTSIDE
        ============================================================ */

        modal.addEventListener(
            'click',
            function(event) {

                if (
                    event.target === modal
                ) {

                    closeExamPreview();

                }

            }
        );



        /* ============================================================
           ESC KEY
        ============================================================ */

        document.addEventListener(
            'keydown',
            function(event) {

                if (
                    event.key === 'Escape' &&
                    modal.classList.contains('active')
                ) {

                    closeExamPreview();

                }

            }
        );



        /* ============================================================
           FULLSCREEN
        ============================================================ */

        if (fullscreenBtn) {

            fullscreenBtn.addEventListener(
                'click',
                async function() {

                    try {

                        if (
                            !document.fullscreenElement
                        ) {

                            await container.requestFullscreen();

                        } else {

                            await document.exitFullscreen();

                        }

                    } catch (error) {

                        console.error(
                            'Fullscreen error:',
                            error
                        );

                    }

                }
            );

        }



        /* ============================================================
           FULLSCREEN CHANGE
        ============================================================ */

        document.addEventListener(
            'fullscreenchange',
            function() {

                /*
                 * ESC exits fullscreen first.
                 * The preview modal stays open.
                 */

                if (
                    !document.fullscreenElement &&
                    modal.classList.contains('active')
                ) {

                    // Keep modal open.

                }

            }
        );

    });
</script>

@endsection