<style>
/* ============================================================
   STUDENT QUIZ SHOW
   Designed to visually match the Professor Quiz Show
   while keeping all student-only submission functionality.
   ============================================================ */

.classwork-show-page {
    width: 100%;
    max-width: 1280px;
    margin: 0 auto;
    padding: 32px 28px 56px;
}

/* HEADER */
.classwork-show-header {
    margin-bottom: 32px;
}

.classwork-back-btn {
    display: inline-flex;
    align-items: center;
    gap: 9px;
    margin-bottom: 26px;
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
    color: var(--primary-color);
    transform: translateX(-3px);
}

/* HEADING */
.classwork-show-heading {
    display: flex;
    align-items: center;
    gap: 19px;
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

.classwork-show-icon.quiz {
    background: rgba(139, 92, 246, .12);
    color: #8b5cf6;
}

.classwork-show-type {
    display: block;
    margin-bottom: 6px;
    color: #8b5cf6;
    font-size: 12px;
    font-weight: 800;
    letter-spacing: 1.1px;
}

.classwork-show-heading h1 {
    margin: 0;
    color: var(--text-color);
    font-size: 32px;
    line-height: 1.25;
    font-weight: 750;
    word-break: break-word;
}

.classwork-show-topic {
    display: inline-flex;
    align-items: center;
    gap: 7px;
    margin-top: 9px;
    color: var(--text-secondary);
    font-size: 15px;
    font-weight: 500;
}

.classwork-show-topic i {
    font-size: 17px;
}

/* MAIN GRID */
.classwork-show-grid {
    display: grid;
    grid-template-columns: minmax(0, 1fr) 340px;
    gap: 26px;
    align-items: start;
}

.classwork-show-main,
.classwork-show-sidebar {
    min-width: 0;
}

.classwork-show-sidebar {
    display: flex;
    flex-direction: column;
    gap: 20px;
}

/* CARDS */
.classwork-detail-card {
    background: var(--card-color);
    border: 1px solid var(--border-color);
    border-radius: 17px;
    overflow: hidden;
    margin-bottom: 22px;
}

.classwork-show-sidebar .classwork-detail-card {
    margin-bottom: 0;
}

.classwork-detail-card-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 12px;
    padding: 20px 22px;
    border-bottom: 1px solid var(--border-color);
}

.classwork-detail-card-header h2 {
    margin: 0;
    color: var(--text-color);
    font-size: 19px;
    line-height: 1.35;
    font-weight: 700;
}

.classwork-detail-card-header h2 i {
    margin-right: 6px;
    color: #8b5cf6;
}

/* DESCRIPTION */
.classwork-description {
    padding: 24px 22px;
    color: var(--text-secondary);
    font-size: 16px;
    line-height: 1.8;
    min-height: 90px;
    overflow-wrap: anywhere;
}

.classwork-no-content {
    color: var(--text-muted);
    font-style: italic;
}

/* GOOGLE FORM */
.quiz-form-section {
    padding: 22px;
}

.quiz-form-box {
    display: flex;
    align-items: center;
    gap: 16px;
    padding: 18px;
    background: var(--background-color);
    border: 1px solid var(--border-color);
    border-radius: 13px;
}

.quiz-form-icon {
    width: 50px;
    height: 50px;
    flex-shrink: 0;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 11px;
    background: rgba(139, 92, 246, .12);
    color: #8b5cf6;
    font-size: 25px;
}

.quiz-form-info {
    min-width: 0;
    flex: 1;
    display: flex;
    flex-direction: column;
    gap: 5px;
}

.quiz-form-info strong {
    color: var(--text-color);
    font-size: 16px;
    font-weight: 700;
}

.quiz-form-info span {
    color: var(--text-secondary);
    font-size: 13px;
    line-height: 1.5;
}

.quiz-form-open {
    flex-shrink: 0;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    min-height: 42px;
    padding: 0 17px;
    background: var(--card-color);
    border: 1px solid #c4b5fd;
    border-radius: 9px;
    color: #6d28d9;
    text-decoration: none;
    font-size: 14px;
    font-weight: 700;
    transition: background-color .2s ease, border-color .2s ease,
                color .2s ease, transform .2s ease, box-shadow .2s ease;
}

.quiz-form-open i {
    font-size: 18px;
}

.quiz-form-open:hover {
    background: #8b5cf6;
    border-color: #8b5cf6;
    color: #fff;
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(139, 92, 246, .2);
}

/* SUBMISSION STATUS */
.quiz-submission-status {
    margin: 22px;
    padding: 19px;
    background: var(--background-color);
    border: 1px solid var(--border-color);
    border-radius: 13px;
}

.quiz-submission-status-content {
    display: flex;
    align-items: center;
    gap: 15px;
}

.quiz-submission-status-icon {
    width: 48px;
    height: 48px;
    flex-shrink: 0;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 11px;
    font-size: 24px;
}

.quiz-submission-status-icon.pending {
    background: rgba(245, 158, 11, .12);
    color: #f59e0b;
}

.quiz-submission-status-icon.submitted {
    background: rgba(16, 185, 129, .12);
    color: #10b981;
}

.quiz-submission-status-info {
    display: flex;
    flex-direction: column;
    gap: 5px;
}

.quiz-submission-status-info strong {
    color: var(--text-color);
    font-size: 16px;
    font-weight: 700;
}

.quiz-submission-status-info span {
    color: var(--text-secondary);
    font-size: 13px;
}

/* SUBMISSION FORM */
.quiz-submission-form {
    padding: 0 22px 22px;
}

/* GOOGLE FORM REMINDER */
.quiz-form-reminder {
    display: flex;
    align-items: center;
    gap: 14px;
    margin-bottom: 20px;
    padding: 15px 16px;
    background: rgba(139, 92, 246, .07);
    border: 1px solid rgba(139, 92, 246, .18);
    border-radius: 11px;
}

.quiz-form-reminder-icon {
    width: 40px;
    height: 40px;
    flex-shrink: 0;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 9px;
    background: rgba(139, 92, 246, .12);
    color: #8b5cf6;
    font-size: 20px;
}

.quiz-form-reminder-info {
    min-width: 0;
    flex: 1;
    display: flex;
    flex-direction: column;
    gap: 4px;
}

.quiz-form-reminder-info strong {
    color: var(--text-color);
    font-size: 14px;
    font-weight: 700;
}

.quiz-form-reminder-info span {
    color: var(--text-secondary);
    font-size: 12px;
    line-height: 1.55;
}

.quiz-form-reminder .quiz-form-open {
    min-height: 38px;
    padding: 0 13px;
}

/* FILE UPLOAD */
.quiz-file-submission {
    padding: 18px;
    background: var(--background-color);
    border: 1px solid var(--border-color);
    border-radius: 13px;
}

.quiz-file-submission-header {
    display: flex;
    align-items: center;
    gap: 10px;
    margin-bottom: 15px;
}

.quiz-file-submission-header > div {
    display: flex;
    flex-direction: column;
    gap: 4px;
}

.quiz-file-submission-header strong {
    color: var(--text-color);
    font-size: 16px;
    font-weight: 700;
}

.quiz-file-submission-header span {
    color: var(--text-secondary);
    font-size: 12px;
    line-height: 1.5;
}

/* UPLOAD AREA */
.quiz-upload-area {
    display: flex;
    align-items: center;
    gap: 15px;
    padding: 17px;
    background: var(--card-color);
    border: 1px dashed var(--border-color);
    border-radius: 11px;
    cursor: pointer;
    transition: border-color .2s ease, background-color .2s ease,
                box-shadow .2s ease;
}

.quiz-upload-area:hover {
    border-color: #8b5cf6;
    background: rgba(139, 92, 246, .04);
    box-shadow: 0 3px 10px rgba(139, 92, 246, .08);
}

.quiz-upload-icon {
    width: 46px;
    height: 46px;
    flex-shrink: 0;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 10px;
    background: rgba(139, 92, 246, .10);
    color: #8b5cf6;
    font-size: 23px;
}

.quiz-upload-content {
    min-width: 0;
    display: flex;
    flex-direction: column;
    gap: 4px;
}

.quiz-upload-content strong {
    color: var(--text-color);
    font-size: 14px;
    font-weight: 700;
}

.quiz-upload-content span {
    color: var(--text-secondary);
    font-size: 12px;
}

/* SELECTED FILES */
.quiz-selected-files {
    margin-top: 13px;
    display: flex;
    flex-direction: column;
    gap: 8px;
}

.quiz-selected-file {
    display: flex;
    align-items: center;
    gap: 11px;
    padding: 10px 12px;
    background: var(--card-color);
    border: 1px solid var(--border-color);
    border-radius: 9px;
}

.quiz-selected-file i {
    flex-shrink: 0;
    color: #8b5cf6;
    font-size: 18px;
}

.quiz-selected-file span {
    min-width: 0;
    flex: 1;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
    color: var(--text-color);
    font-size: 12px;
}

.quiz-selected-file-size {
    flex-shrink: 0;
    color: var(--text-muted);
    font-size: 11px !important;
}

/* SUBMITTED FILES */
.quiz-submission-files {
    margin-top: 18px;
    padding-top: 17px;
    border-top: 1px solid var(--border-color);
}

.quiz-submission-files-title {
    display: flex;
    align-items: center;
    gap: 8px;
    margin-bottom: 11px;
    color: var(--text-color);
    font-size: 13px;
    font-weight: 700;
}

.quiz-submission-files-title i {
    color: #8b5cf6;
    font-size: 17px;
}

.quiz-submission-file-list {
    display: flex;
    flex-direction: column;
    gap: 8px;
}

.quiz-submission-file {
    display: flex;
    align-items: center;
    gap: 11px;
    padding: 11px 12px;
    background: var(--card-color);
    border: 1px solid var(--border-color);
    border-radius: 9px;
}

.quiz-submission-file-icon {
    width: 32px;
    height: 32px;
    flex-shrink: 0;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 7px;
    background: rgba(59, 130, 246, .10);
    color: var(--primary-color);
    font-size: 17px;
}

.quiz-submission-file-info {
    min-width: 0;
    flex: 1;
    display: flex;
    flex-direction: column;
    gap: 3px;
}

.quiz-submission-file-info strong {
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
    color: var(--text-color);
    font-size: 12px;
    font-weight: 600;
}

.quiz-submission-file-info span {
    color: var(--text-muted);
    font-size: 11px;
}

/* GRADE / FEEDBACK */
.quiz-submission-result {
    margin: 20px 0 0;
    padding: 17px;
    background: var(--card-color);
    border: 1px solid var(--border-color);
    border-radius: 12px;
}

.quiz-submission-result-item {
    display: flex;
    align-items: flex-start;
    gap: 11px;
    padding: 11px 0;
}

.quiz-submission-result-item:first-child {
    padding-top: 0;
}

.quiz-submission-result-item:last-child {
    padding-bottom: 0;
}

.quiz-submission-result-item + .quiz-submission-result-item {
    border-top: 1px solid var(--border-color);
}

.quiz-submission-result-item > i {
    margin-top: 2px;
    color: #8b5cf6;
    font-size: 19px;
    flex-shrink: 0;
}

.quiz-submission-result-content {
    display: flex;
    flex-direction: column;
    gap: 4px;
    min-width: 0;
}

.quiz-submission-result-content span {
    color: var(--text-secondary);
    font-size: 13px;
}

.quiz-submission-result-content strong {
    color: var(--text-color);
    font-size: 18px;
    font-weight: 750;
}

.quiz-submission-result-content small {
    color: var(--text-secondary);
    font-size: 12px;
}

.quiz-submission-feedback {
    color: var(--text-color);
    font-size: 14px;
    line-height: 1.65;
    overflow-wrap: anywhere;
}

/* FINAL SUBMIT */
.quiz-final-submit {
    margin-top: 18px;
}

.quiz-submit-button {
    width: 100%;
    min-height: 46px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 9px;
    padding: 0 18px;
    background: #8b5cf6;
    border: 1px solid #8b5cf6;
    border-radius: 10px;
    color: #fff;
    font-size: 15px;
    font-weight: 700;
    cursor: pointer;
    transition: background-color .2s ease, border-color .2s ease,
                transform .2s ease, box-shadow .2s ease;
}

.quiz-submit-button i {
    font-size: 19px;
}

.quiz-submit-button:hover {
    background: #7c3aed;
    border-color: #7c3aed;
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(139, 92, 246, .22);
}

.quiz-submit-note {
    margin: 10px 0 0;
    color: var(--text-muted);
    text-align: center;
    font-size: 12px;
    line-height: 1.55;
}

/* CANCEL */
.quiz-cancel-wrapper {
    margin: 20px 22px 22px;
}

.quiz-cancel-button {
    width: 100%;
    min-height: 43px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 9px;
    padding: 0 16px;
    background: transparent;
    border: 1px solid rgba(220, 38, 38, .28);
    border-radius: 9px;
    color: #dc2626;
    font-size: 14px;
    font-weight: 700;
    cursor: pointer;
    transition: background-color .2s ease, border-color .2s ease,
                color .2s ease, transform .2s ease;
}

.quiz-cancel-button i {
    font-size: 18px;
}

.quiz-cancel-button:hover {
    background: rgba(220, 38, 38, .08);
    border-color: #dc2626;
    transform: translateY(-1px);
}

.quiz-cancel-button:disabled,
.quiz-cancel-button.disabled {
    opacity: .55;
    cursor: not-allowed;
    transform: none;
}

.quiz-cancel-button:disabled:hover,
.quiz-cancel-button.disabled:hover {
    background: transparent;
    transform: none;
}

.quiz-cancel-note {
    margin: 10px 0 0;
    color: var(--text-muted);
    text-align: center;
    font-size: 12px;
    line-height: 1.55;
}

.quiz-cancel-note.expired {
    color: #dc2626;
}

/* ATTACHED FILES */
.classwork-file {
    display: flex;
    align-items: center;
    gap: 15px;
    margin: 20px 22px;
    padding: 16px;
    background: var(--background-color);
    border: 1px solid var(--border-color);
    border-radius: 12px;
    transition: border-color .2s ease, box-shadow .2s ease;
}

.classwork-file + .classwork-file {
    margin-top: -10px;
}

.classwork-file:hover {
    border-color: #8b5cf6;
    box-shadow: 0 4px 14px rgba(0, 0, 0, .06);
}

.classwork-file-icon {
    width: 50px;
    height: 50px;
    flex-shrink: 0;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 11px;
    background: rgba(139, 92, 246, .10);
    color: #8b5cf6;
    font-size: 25px;
}

.classwork-file-info {
    min-width: 0;
    flex: 1;
    display: flex;
    flex-direction: column;
    gap: 5px;
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
    color: var(--text-muted);
    font-size: 12px;
}

.classwork-file-open {
    flex-shrink: 0;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    min-height: 40px;
    padding: 0 15px;
    background: var(--card-color);
    border: 1px solid #c4b5fd;
    border-radius: 9px;
    color: #6d28d9;
    font-size: 13px;
    font-weight: 700;
    cursor: pointer;
    transition: background-color .2s ease, border-color .2s ease,
                color .2s ease, transform .2s ease, box-shadow .2s ease;
}

.classwork-file-open i {
    font-size: 17px;
}

.classwork-file-open:hover {
    background: #8b5cf6;
    border-color: #8b5cf6;
    color: #fff;
    transform: translateY(-1px);
    box-shadow: 0 4px 10px rgba(139, 92, 246, .18);
}

/* INFORMATION */
.classwork-info-list {
    display: flex;
    flex-direction: column;
}

.classwork-info-item {
    display: flex;
    align-items: center;
    gap: 14px;
    padding: 18px 22px;
    border-bottom: 1px solid var(--border-color);
}

.classwork-info-item:last-child {
    border-bottom: none;
}

.classwork-info-item > i {
    width: 22px;
    flex-shrink: 0;
    color: var(--text-secondary);
    font-size: 20px;
}

.classwork-info-item > div {
    min-width: 0;
    display: flex;
    flex-direction: column;
    gap: 4px;
}

.classwork-info-item span {
    color: var(--text-secondary);
    font-size: 13px;
}

.classwork-info-item strong {
    color: var(--text-color);
    font-size: 15px;
    font-weight: 650;
}

/* PLACEHOLDER */
.submission-placeholder {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    padding: 40px 22px;
    text-align: center;
    border-top: 1px solid var(--border-color);
}

.submission-placeholder i {
    margin-bottom: 11px;
    color: var(--text-muted);
    font-size: 32px;
}

.submission-placeholder p {
    margin: 0;
    color: var(--text-secondary);
    font-size: 14px;
}

/* PREVIEW MODAL */
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

.file-preview-overlay {
    position: absolute;
    inset: 0;
    background: rgba(0, 0, 0, .75);
    backdrop-filter: blur(4px);
}

.file-preview-container {
    position: relative;
    z-index: 2;
    width: 92%;
    height: 90%;
    display: flex;
    flex-direction: column;
    overflow: hidden;
    background: var(--card-color);
    border-radius: 17px;
    box-shadow: 0 25px 70px rgba(0, 0, 0, .35);
}

.file-preview-header {
    min-height: 66px;
    padding: 0 18px 0 22px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 15px;
    background: var(--card-color);
    border-bottom: 1px solid var(--border-color);
}

.file-preview-title {
    min-width: 0;
    display: flex;
    align-items: center;
    gap: 11px;
}

.file-preview-title i {
    flex-shrink: 0;
    font-size: 22px;
    color: #8b5cf6;
}

.file-preview-title span {
    max-width: 600px;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
    font-size: 15px;
    font-weight: 650;
    color: var(--text-color);
}

.file-preview-actions {
    display: flex;
    align-items: center;
    gap: 5px;
}

.file-preview-btn {
    width: 40px;
    height: 40px;
    display: flex;
    align-items: center;
    justify-content: center;
    border: none;
    border-radius: 9px;
    background: transparent;
    color: var(--text-color);
    font-size: 21px;
    cursor: pointer;
    transition: background-color .2s ease, color .2s ease,
                transform .2s ease;
}

.file-preview-btn:hover {
    background: var(--hover-color);
    transform: translateY(-1px);
}

.file-preview-btn.close:hover {
    background: rgba(220, 38, 38, .1);
    color: #dc2626;
}

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

body.modal-open {
    overflow: hidden;
}

.file-preview-container:fullscreen {
    width: 100%;
    height: 100%;
    border-radius: 0;
    box-shadow: none;
}

.file-preview-container:fullscreen .file-preview-header {
    min-height: 62px;
}

/* DARK MODE */
[data-theme="dark"] .quiz-form-open:hover,
[data-theme="dark"] .classwork-file-open:hover {
    color: #fff;
}

/* RESPONSIVE */
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

@media (max-width: 768px) {
    .classwork-file {
        align-items: flex-start;
    }

    .quiz-form-box {
        align-items: flex-start;
    }

    .file-preview-container {
        width: 96%;
        height: 94%;
        border-radius: 13px;
    }

    .file-preview-title span {
        max-width: 300px;
    }
}

@media (max-width: 650px) {
    .classwork-show-page {
        padding: 22px 16px 42px;
    }

    .classwork-show-header {
        margin-bottom: 26px;
    }

    .classwork-show-heading {
        align-items: flex-start;
        gap: 14px;
    }

    .classwork-show-icon {
        width: 54px;
        height: 54px;
        border-radius: 13px;
        font-size: 25px;
    }

    .classwork-show-heading h1 {
        font-size: 25px;
    }

    .classwork-show-topic {
        font-size: 13px;
    }

    .classwork-show-grid {
        gap: 17px;
    }

    .classwork-detail-card {
        border-radius: 14px;
        margin-bottom: 17px;
    }

    .classwork-show-sidebar {
        display: flex;
        flex-direction: column;
        gap: 17px;
    }

    .classwork-detail-card-header {
        padding: 17px;
    }

    .classwork-detail-card-header h2 {
        font-size: 17px;
    }

    .classwork-description {
        padding: 19px 17px;
        font-size: 15px;
    }

    .quiz-form-section {
        padding: 17px;
    }

    .quiz-form-box {
        flex-wrap: wrap;
    }

    .quiz-form-open {
        width: 100%;
    }

    .quiz-submission-status {
        margin: 17px;
    }

    .quiz-submission-form {
        padding: 0 17px 17px;
    }

    .quiz-cancel-wrapper {
        margin-left: 17px;
        margin-right: 17px;
    }

    .classwork-file {
        margin: 17px;
    }

    .classwork-info-item {
        padding: 16px 17px;
    }
}

@media (max-width: 520px) {
    .classwork-file {
        flex-wrap: wrap;
    }

    .classwork-file-info {
        max-width: calc(100% - 65px);
    }

    .classwork-file-open {
        width: 100%;
    }

    .quiz-form-reminder {
        align-items: flex-start;
        flex-wrap: wrap;
    }

    .quiz-form-reminder .quiz-form-open {
        width: 100%;
    }

    .quiz-upload-area {
        align-items: flex-start;
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
        max-width: 170px;
    }
}
</style>


@extends('layouts.student_layout')

@section('title', 'Quiz')

@section('content')

@php

/*
|--------------------------------------------------------------------------
| Submission state
|--------------------------------------------------------------------------
*/

$isSubmitted = $submission && $submission->submitted_at;

/*
|--------------------------------------------------------------------------
| Due time
|--------------------------------------------------------------------------
*/

$isPastDue = false;
$dueAt = null;

if ($quiz->due_date) {

$dueAt = \Carbon\Carbon::parse($quiz->due_date);

if ($quiz->due_time) {
$dueAt->setTimeFromTimeString($quiz->due_time);
} else {
$dueAt->endOfDay();
}

$isPastDue = now()->greaterThan($dueAt);
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


    {{-- ========================================================
         MAIN GRID
    ========================================================= --}}

    <div class="classwork-show-grid">


        {{-- ====================================================
             MAIN CONTENT
        ===================================================== --}}

        <div class="classwork-show-main">


            {{-- ====================================================
                 QUIZ INSTRUCTIONS
            ===================================================== --}}

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



            {{-- ====================================================
                 GOOGLE FORM
            ===================================================== --}}

            @if($quiz->google_form_url)

            <section class="classwork-detail-card">

                <div class="classwork-detail-card-header">

                    <h2>
                        Quiz Form
                    </h2>

                </div>


                <div class="quiz-form-section">

                    <div class="quiz-form-box">

                        <div class="quiz-form-icon">

                            <i class="bx bx-link-external"></i>

                        </div>


                        <div class="quiz-form-info">

                            <strong>
                                Google Form Quiz
                            </strong>

                            <span>
                                Open the quiz form and complete all required questions.
                            </span>

                        </div>


                        <a
                            href="{{ $quiz->google_form_url }}"
                            target="_blank"
                            rel="noopener noreferrer"
                            class="quiz-form-open">

                            <i class="bx bx-link-external"></i>

                            Open Quiz

                        </a>

                    </div>

                </div>

            </section>

            @endif


            {{-- ====================================================
                 ATTACHED MATERIAL
            ===================================================== --}}

            @php
                $quizResources = $quiz->resources
                    ? $quiz->resources->filter(fn ($resource) => !empty($resource->file_path))
                    : collect();

                $hasQuizMaterial =
                    !empty($quiz->attachment) ||
                    $quizResources->isNotEmpty();
            @endphp

            @if($hasQuizMaterial)

            <section class="classwork-detail-card">

                <div class="classwork-detail-card-header">

                    <h2>
                        Attached Material
                    </h2>

                </div>


                {{-- ==================================================
                     LEGACY ATTACHMENT
                =================================================== --}}

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



                {{-- ==================================================
                     MULTIPLE RESOURCES
                =================================================== --}}

                @foreach($quizResources as $resource)

                <div class="classwork-file">

                    <div class="classwork-file-icon">

                        <i class="bx bx-file"></i>

                    </div>


                    <div class="classwork-file-info">

                        <strong>

                            {{
                                    $resource->file_name
                                    ?? $resource->title
                                    ?? basename($resource->file_path)
                                }}

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
                        data-file-title="{{
                                    $resource->file_name
                                    ?? $resource->title
                                    ?? basename($resource->file_path)
                                }}">

                        <i class="bx bx-show"></i>

                        Open

                    </button>

                    @endif

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


                @if($isSubmitted)

                {{-- SUBMITTED --}}

                <div class="quiz-submission-status">

                    <div class="quiz-submission-status-content">

                        <div class="quiz-submission-status-icon submitted">
                            <i class="bx bx-check"></i>
                        </div>

                        <div class="quiz-submission-status-info">

                            <strong>
                                Quiz Submitted
                            </strong>

                            <span>
                                Submitted
                                {{ $submission->submitted_at->format('M d, Y \a\t h:i A') }}
                            </span>

                        </div>

                    </div>


                    {{-- SUBMITTED FILES --}}

                    {{-- GRADE / FEEDBACK --}}
                    @if($submission->score !== null)

                    @php
                        $quizPoints = (float) ($quiz->points ?? 0);
                        $quizScore = (float) $submission->score;
                        $quizPercentage = $quizPoints > 0
                            ? ($quizScore / $quizPoints) * 100
                            : 0;
                    @endphp

                    <div class="quiz-submission-result">

                        <div class="quiz-submission-result-item">
                            <i class="bx bx-star"></i>
                            <div class="quiz-submission-result-content">
                                <span>Your Grade</span>
                                <strong>
                                    {{ rtrim(rtrim(number_format($quizScore, 2), '0'), '.') }}
                                    /
                                    {{ rtrim(rtrim(number_format($quizPoints, 2), '0'), '.') }}
                                    ({{ rtrim(rtrim(number_format($quizPercentage, 2), '0'), '.') }}%)
                                </strong>
                            </div>
                        </div>

                        @if($submission->feedback)
                        <div class="quiz-submission-result-item">
                            <i class="bx bx-message-detail"></i>
                            <div class="quiz-submission-result-content">
                                <span>Professor Feedback</span>
                                <div class="quiz-submission-feedback">
                                    {{ $submission->feedback }}
                                </div>
                            </div>
                        </div>
                        @endif

                        @if($submission->graded_at)
                        <div class="quiz-submission-result-item">
                            <i class="bx bx-calendar-check"></i>
                            <div class="quiz-submission-result-content">
                                <span>Graded On</span>
                                <small>
                                    {{ $submission->graded_at->format('M d, Y \a\t h:i A') }}
                                </small>
                            </div>
                        </div>
                        @endif

                    </div>

                    @endif

                    @php
                        $submittedFiles = $submission->resources
                            ? $submission->resources->filter(fn ($resource) => !empty($resource->file_path))
                            : collect();
                    @endphp

                    @if($submittedFiles->isNotEmpty())

                    <div class="quiz-submission-files">

                        <div class="quiz-submission-files-title">

                            <i class="bx bx-paperclip"></i>

                            Submitted Files

                        </div>


                        <div class="quiz-submission-file-list">

                            @foreach($submittedFiles as $resource)

                            <div class="quiz-submission-file">

                                <div class="quiz-submission-file-icon">
                                    <i class="bx bx-file"></i>
                                </div>


                                <div class="quiz-submission-file-info">

                                    <strong>
                                        {{
                                            $resource->file_name
                                            ?? $resource->title
                                            ?? basename($resource->file_path)
                                        }}
                                    </strong>


                                    <span>

                                        @if($resource->file_size)

                                        {{ number_format($resource->file_size / 1024, 1) }}
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


                {{-- CANCEL SUBMISSION --}}

                <div class="quiz-cancel-wrapper">

                    <form
                        action="{{ route(
                    'student.class-groups.quizzes.cancel',
                    [
                        'classGroup' => $classGroup->id,
                        'quiz' => $quiz->id,
                    ]
                ) }}"
                        method="POST"
                        onsubmit="return confirm('Are you sure you want to cancel your submission?');">

                        @csrf

                        @method('DELETE')

                        <input
                            type="hidden"
                            name="return_to"
                            value="{{ $returnTo }}">


                        <button
                            type="submit"
                            class="quiz-cancel-button {{ $isPastDue ? 'disabled' : '' }}"
                            {{ $isPastDue ? 'disabled' : '' }}>

                            <i class="bx bx-undo"></i>

                            Cancel Submission

                        </button>

                    </form>


                    @if($isPastDue)

                    <p class="quiz-cancel-note expired">
                        The quiz deadline has passed.
                        Your submission can no longer be cancelled.
                    </p>

                    @else

                    <p class="quiz-cancel-note">
                        You can cancel your submission before the quiz deadline.
                    </p>

                    @endif

                </div>


                @else

                {{-- NOT SUBMITTED --}}

                <form
                    action="{{ route(
                'student.class-groups.quizzes.submit',
                [
                    'classGroup' => $classGroup->id,
                    'quiz' => $quiz->id,
                ]
            ) }}"
                    method="POST"
                    enctype="multipart/form-data"
                    class="quiz-submission-form">

                    @csrf

                    <input
                        type="hidden"
                        name="return_to"
                        value="{{ $returnTo }}">


                    {{-- GOOGLE FORM MESSAGE --}}

                    @if($quiz->google_form_url)

                    <div class="quiz-form-reminder">

                        <div class="quiz-form-reminder-icon">

                            <i class="bx bx-info-circle"></i>

                        </div>


                        <div class="quiz-form-reminder-info">

                            <strong>
                                Complete the Google Form first
                            </strong>

                            <span>
                                After completing the quiz, click
                                "I Have Submitted" below.
                            </span>

                        </div>

                    </div>

                    @endif


                    {{-- FILE UPLOAD --}}

                    <div class="quiz-file-submission">

                        <div class="quiz-file-submission-header">

                            <div>

                                <strong>
                                    Upload Your Work
                                </strong>

                                <span>
                                    Add any answers, supporting work, or additional files.
                                    If not applicable, you can leave this empty.
                                </span>

                            </div>

                        </div>


                        <label
                            for="quizSubmissionFiles"
                            class="quiz-upload-area">

                            <input
                                type="file"
                                name="attachments[]"
                                id="quizSubmissionFiles"
                                multiple
                                hidden>


                            <div class="quiz-upload-icon">

                                <i class="bx bx-cloud-upload"></i>

                            </div>


                            <div class="quiz-upload-content">

                                <strong>
                                    Choose Files
                                </strong>

                                <span>
                                    You can select multiple files.
                                </span>

                            </div>

                        </label>


                        <div
                            id="quizSelectedFiles"
                            class="quiz-selected-files"
                            style="display: none;"></div>

                    </div>


                    {{-- FINAL SUBMIT BUTTON --}}

                    <div class="quiz-final-submit">

                        <button
                            type="submit"
                            class="quiz-submit-button">

                            <i class="bx bx-send"></i>

                            @if($quiz->google_form_url)

                            I Have Submitted

                            @else

                            Submit Quiz

                            @endif

                        </button>


                        <p class="quiz-submit-note">

                            @if($quiz->google_form_url)

                            Complete the Google Form first.
                            You may also upload additional work above.

                            @else

                            Upload your work and click Submit Quiz.

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
                 QUIZ DETAILS
            ===================================================== --}}

            <section class="classwork-detail-card">

                <div class="classwork-detail-card-header">

                    <h2>
                        Quiz Details
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
                                {{ $quiz->points ?? 0 }}
                            </strong>

                        </div>

                    </div>



                    {{-- DUE DATE --}}

                    @if($quiz->due_date)

                    <div class="classwork-info-item">

                        <i class="bx bx-calendar"></i>

                        <div>

                            <span>
                                Due Date
                            </span>

                            <strong>
                                {{ \Carbon\Carbon::parse($quiz->due_date)->format('M d, Y') }}
                            </strong>

                        </div>

                    </div>

                    @endif



                    {{-- DUE TIME --}}

                    @if($quiz->due_time)

                    <div class="classwork-info-item">

                        <i class="bx bx-time"></i>

                        <div>

                            <span>
                                Due Time
                            </span>

                            <strong>
                                {{ \Carbon\Carbon::parse($quiz->due_time)->format('h:i A') }}
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



                    {{-- SUBMITTED DATE --}}

                    @if($isSubmitted)

                    <div class="classwork-info-item">

                        <i class="bx bx-calendar-check"></i>

                        <div>

                            <span>
                                Submitted On
                            </span>

                            <strong>
                                {{ $submission->submitted_at->format('M d, Y') }}
                            </strong>

                        </div>

                    </div>

                    @endif



                    {{-- GRADE --}}
                    @if($isSubmitted && $submission->score !== null)

                    <div class="classwork-info-item">
                        <i class="bx bx-star"></i>
                        <div>
                            <span>Grade</span>
                            <strong>
                                {{ rtrim(rtrim(number_format($submission->score, 2), '0'), '.') }}
                                /
                                {{ rtrim(rtrim(number_format($quiz->points ?? 0, 2), '0'), '.') }}
                            </strong>
                        </div>
                    </div>

                    @endif


                    {{-- DEADLINE STATUS --}}

                    @if($quiz->due_date)

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
     FILE PREVIEW MODAL
============================================================ --}}

<div
    id="quizPreviewModal"
    class="file-preview-modal">

    {{-- DARK OVERLAY --}}

    <div class="file-preview-overlay"></div>


    {{-- MODAL CONTAINER --}}

    <div class="file-preview-container">


        {{-- HEADER --}}

        <div class="file-preview-header">


            <div class="file-preview-title">

                <i class="bx bx-file"></i>

                <span>
                    Quiz Attachment
                </span>

            </div>


            <div class="file-preview-actions">


                {{-- FULLSCREEN --}}

                <button
                    type="button"
                    id="quizFullscreenBtn"
                    class="file-preview-btn"
                    title="Full Screen">

                    <i class="bx bx-fullscreen"></i>

                </button>


                {{-- CLOSE --}}

                <button
                    type="button"
                    id="closeQuizPreview"
                    class="file-preview-btn close"
                    title="Close">

                    <i class="bx bx-x"></i>

                </button>

            </div>

        </div>


        {{-- PREVIEW BODY --}}

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


        /* ============================================================
           FILE UPLOAD PREVIEW
        ============================================================ */

        const submissionFilesInput =
            document.getElementById('quizSubmissionFiles');

        const selectedFilesContainer =
            document.getElementById('quizSelectedFiles');


        if (submissionFilesInput && selectedFilesContainer) {

            submissionFilesInput.addEventListener(
                'change',
                function() {

                    selectedFilesContainer.innerHTML = '';


                    if (!this.files.length) {

                        selectedFilesContainer.style.display = 'none';

                        return;

                    }


                    selectedFilesContainer.style.display = 'flex';


                    Array.from(this.files).forEach(function(file) {

                        const fileItem =
                            document.createElement('div');

                        fileItem.className =
                            'quiz-selected-file';


                        const icon =
                            document.createElement('i');

                        icon.className =
                            'bx bx-file';


                        const name =
                            document.createElement('span');

                        name.textContent =
                            file.name;


                        const size =
                            document.createElement('span');

                        size.className =
                            'quiz-selected-file-size';


                        const fileSizeKB =
                            file.size / 1024;


                        if (fileSizeKB >= 1024) {

                            size.textContent =
                                (fileSizeKB / 1024).toFixed(1) + ' MB';

                        } else {

                            size.textContent =
                                fileSizeKB.toFixed(1) + ' KB';

                        }


                        fileItem.appendChild(icon);

                        fileItem.appendChild(name);

                        fileItem.appendChild(size);


                        selectedFilesContainer.appendChild(
                            fileItem
                        );

                    });

                }
            );

        }



        /* ============================================================
           FILE PREVIEW MODAL
        ============================================================ */

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


        /* ============================================================
           SAFETY CHECK
        ============================================================ */

        if (
            !modal ||
            !closeBtn ||
            !fullscreenBtn ||
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
                        'Quiz Attachment';


                    if (!fileUrl) {

                        return;

                    }


                    preview.src =
                        fileUrl;


                    if (previewTitle) {

                        previewTitle.textContent =
                            fileTitle;

                    }


                    modal.classList.add('active');

                    document.body.classList.add(
                        'modal-open'
                    );

                }
            );

        });



        /* ============================================================
           CLOSE MODAL
        ============================================================ */

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



        /* ============================================================
           CLICK OVERLAY
        ============================================================ */

        modal.addEventListener(
            'click',
            function(event) {

                if (
                    event.target.classList.contains(
                        'file-preview-overlay'
                    )
                ) {

                    closeQuizPreview();

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

                    closeQuizPreview();

                }

            }
        );



        /* ============================================================
           FULLSCREEN
        ============================================================ */

        fullscreenBtn.addEventListener(
            'click',
            function() {

                if (!document.fullscreenElement) {

                    if (container.requestFullscreen) {

                        container.requestFullscreen();

                    }

                } else {

                    if (document.exitFullscreen) {

                        document.exitFullscreen();

                    }

                }

            }
        );

    });
</script>

@endsection