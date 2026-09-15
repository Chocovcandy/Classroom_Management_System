<style>
    /* ============================================================
   CLASSWORK SHOW PAGE
   MATERIAL
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
        margin-bottom: 28px;
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

        transition: color 0.2s ease;
    }

    .classwork-back-btn i {
        font-size: 20px;
    }

    .classwork-back-btn:hover {
        color: var(--primary-color);
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

        border-radius: 15px;

        font-size: 28px;
    }


    /* ============================================================
   MATERIAL ICON
   ============================================================ */

    .classwork-show-icon.material {
        background-color: #e0f2fe;
        color: #0284c7;
    }


    /* ============================================================
   CLASSWORK TYPE
   ============================================================ */

    .classwork-show-type {
        display: inline-block;

        margin-bottom: 5px;

        font-size: 12px;
        font-weight: 700;

        letter-spacing: 0.08em;
    }

    .classwork-show-type.material {
        color: #0284c7;
    }


    /* ============================================================
   TITLE
   ============================================================ */

    .classwork-show-heading h1 {
        margin: 0;

        color: var(--text-color);

        font-size: 28px;
        font-weight: 700;
        line-height: 1.25;

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

        font-size: 14px;
        font-weight: 500;
    }

    .classwork-show-topic i {
        font-size: 17px;
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
        min-width: 0;

        display: flex;
        flex-direction: column;
        gap: 24px;
    }


    /* ============================================================
   DETAIL CARD
   ============================================================ */

    .classwork-detail-card {
        margin-bottom: 24px;

        background-color: var(--card-color);

        border: 1px solid var(--border-color);
        border-radius: 16px;

        overflow: hidden;
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

        padding: 18px 22px;

        border-bottom: 1px solid var(--border-color);
    }

    .classwork-detail-card-header h2 {
        margin: 0;

        color: var(--text-color);

        font-size: 17px;
        font-weight: 700;
    }


    /* ============================================================
   DESCRIPTION
   ============================================================ */

    .classwork-description {
        padding: 22px;

        color: var(--text-secondary);

        font-size: 15px;
        line-height: 1.7;

        overflow-wrap: anywhere;
    }

    .classwork-no-content {
        color: var(--text-muted);

        font-style: italic;
    }


    /* ============================================================
   ATTACHED MATERIAL
   ============================================================ */

    .classwork-file {
        display: flex;
        align-items: center;
        gap: 15px;

        padding: 20px 22px;
    }


    /* FILE ICON */

    .classwork-file-icon {
        width: 48px;
        height: 48px;

        flex-shrink: 0;

        display: flex;
        align-items: center;
        justify-content: center;

        border-radius: 12px;

        background-color: #e0f2fe;
        color: #0284c7;

        font-size: 24px;
    }


    /* FILE INFORMATION */

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

        word-break: break-all;
    }

    .classwork-file-info span {
        color: var(--text-secondary);

        font-size: 13px;
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
        gap: 14px;

        padding: 17px 22px;

        border-bottom: 1px solid var(--border-color);
    }

    .classwork-info-item:last-child {
        border-bottom: none;
    }

    .classwork-info-item>i {
        width: 20px;

        flex-shrink: 0;

        color: var(--text-secondary);

        font-size: 20px;
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
        font-weight: 500;
    }

    .classwork-info-item strong {
        color: var(--text-color);

        font-size: 14px;
        font-weight: 600;
    }


    /* ============================================================
   ACTION BUTTON
   ============================================================ */

    .classwork-action-btn {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;

        margin: 16px;

        padding: 11px 16px;

        background-color: var(--background-color);

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
        border-color: var(--primary-color);

        color: var(--primary-color);

        transform: translateY(-1px);
    }

    /* ============================================================
   ATTACHED MATERIAL
============================================================ */

    .classwork-file {
        display: flex;
        align-items: center;
        gap: 15px;

        padding: 16px;

        border: 1px solid var(--border-color);
        border-radius: 12px;

        background: var(--card-color);
    }

    .classwork-file-icon {
        width: 46px;
        height: 46px;

        flex-shrink: 0;

        display: flex;
        align-items: center;
        justify-content: center;

        border-radius: 10px;

        background: rgba(59, 130, 246, 0.1);
        color: #3b82f6;

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
        font-size: 14px;
        font-weight: 600;

        color: var(--text-color);

        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }

    .classwork-file-info span {
        font-size: 12px;
        color: var(--muted-text-color);
    }


    /* ============================================================
   OPEN MATERIAL BUTTON
============================================================ */

    .classwork-file-open {
        flex-shrink: 0;

        display: inline-flex;
        align-items: center;
        justify-content: center;

        gap: 7px;

        padding: 9px 14px;

        border: 1px solid var(--border-color);
        border-radius: 9px;

        background: var(--background-color);
        color: var(--text-color);

        cursor: pointer;

        font-size: 13px;
        font-weight: 600;

        transition:
            background-color 0.2s ease,
            border-color 0.2s ease,
            color 0.2s ease;
    }


    .classwork-file-open:hover {
        border-color: var(--primary-color);
        color: var(--primary-color);
    }


    .classwork-file-open i {
        font-size: 17px;
    }

    /* ============================================================
   MATERIAL PREVIEW MODAL
============================================================ */

    .material-preview-modal {
        position: fixed;
        inset: 0;

        z-index: 9999;

        display: flex;
        align-items: center;
        justify-content: center;

        padding: 30px;

        visibility: hidden;
        opacity: 0;

        transition:
            opacity 0.2s ease,
            visibility 0.2s ease;
    }


    /* ============================================================
   ACTIVE MODAL
============================================================ */

    .material-preview-modal.active {
        visibility: visible;
        opacity: 1;
    }


    /* ============================================================
   OVERLAY
============================================================ */

    .material-preview-overlay {
        position: absolute;
        inset: 0;

        background: rgba(0, 0, 0, 0.65);

        backdrop-filter: blur(3px);
    }


    /* ============================================================
   MODAL CONTAINER
============================================================ */

    .material-preview-container {
        position: relative;

        z-index: 1;

        width: min(1200px, 100%);
        height: min(850px, 90vh);

        display: flex;
        flex-direction: column;

        overflow: hidden;

        background: var(--card-color);

        border: 1px solid var(--border-color);
        border-radius: 16px;

        box-shadow:
            0 25px 60px rgba(0, 0, 0, 0.25);

        transform: scale(0.96);

        transition: transform 0.2s ease;
    }

    .material-preview-modal.active .material-preview-container {
        transform: scale(1);
    }


    /* ============================================================
   MODAL HEADER
============================================================ */

    .material-preview-header {
        min-height: 60px;

        display: flex;
        align-items: center;
        justify-content: space-between;

        gap: 15px;

        padding: 12px 18px;

        border-bottom: 1px solid var(--border-color);

        background: var(--card-color);
    }


    /* ============================================================
   TITLE
============================================================ */

    .material-preview-title {
        min-width: 0;

        display: flex;
        align-items: center;

        gap: 10px;
    }

    .material-preview-title i {
        flex-shrink: 0;

        font-size: 22px;

        color: var(--primary-color);
    }

    .material-preview-title span {
        overflow: hidden;

        text-overflow: ellipsis;
        white-space: nowrap;

        font-size: 14px;
        font-weight: 600;

        color: var(--text-color);
    }


    /* ============================================================
   CLOSE BUTTON
============================================================ */

    .material-preview-close {
        width: 38px;
        height: 38px;

        flex-shrink: 0;

        display: flex;
        align-items: center;
        justify-content: center;

        border: none;
        border-radius: 8px;

        background: transparent;

        color: var(--text-color);

        cursor: pointer;

        font-size: 24px;

        transition:
            background 0.2s ease,
            color 0.2s ease;
    }

    .material-preview-close:hover {
        background: var(--background-color);
    }


    /* ============================================================
   MODAL BODY
============================================================ */

    .material-preview-body {
        flex: 1;

        min-height: 0;

        background: #f1f1f1;
    }


    /* ============================================================
   PDF
============================================================ */

    .material-preview-frame {
        display: block;

        width: 100%;
        height: 100%;

        border: none;
    }


    /* ============================================================
   IMAGE
============================================================ */

    .material-preview-image-wrapper {
        width: 100%;
        height: 100%;

        display: flex;
        align-items: center;
        justify-content: center;

        padding: 30px;

        overflow: auto;
    }

    .material-preview-image {
        max-width: 100%;
        max-height: 100%;

        object-fit: contain;

        border-radius: 8px;
    }


    /* ============================================================
   FILE TYPE NOT SUPPORTED
============================================================ */

    .material-preview-unavailable {
        width: 100%;
        height: 100%;

        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;

        text-align: center;

        padding: 30px;
    }

    .material-preview-unavailable>i {
        margin-bottom: 15px;

        font-size: 60px;

        color: var(--muted-text-color);
    }

    .material-preview-unavailable h3 {
        margin: 0 0 8px;

        color: var(--text-color);

        font-size: 18px;
    }

    .material-preview-unavailable p {
        margin: 0 0 20px;

        color: var(--muted-text-color);

        font-size: 13px;
    }


    /* ============================================================
   DOWNLOAD BUTTON
============================================================ */

    .material-preview-download {
        display: inline-flex;
        align-items: center;
        gap: 8px;

        padding: 10px 16px;

        border-radius: 8px;

        background: var(--primary-color);
        color: #fff;

        text-decoration: none;

        font-size: 13px;
        font-weight: 600;
    }

    .material-preview-download:hover {
        opacity: 0.9;
    }


    /* ============================================================
   PREVENT PAGE SCROLL
============================================================ */

    body.modal-open {
        overflow: hidden;
    }

    /* ============================================================
   MODAL HEADER ACTIONS
============================================================ */

    .material-preview-actions {
        display: flex;
        align-items: center;
        gap: 6px;
    }


    /* ============================================================
   MODAL BUTTON
============================================================ */

    .material-preview-btn {
        width: 38px;
        height: 38px;

        display: flex;
        align-items: center;
        justify-content: center;

        border: none;
        border-radius: 8px;

        background: transparent;
        color: var(--text-color);

        cursor: pointer;

        font-size: 20px;

        transition:
            background-color 0.2s ease,
            color 0.2s ease;
    }


    .material-preview-btn:hover {
        background: var(--background-color);
    }


    .material-preview-btn.close:hover {
        background: #fee2e2;
        color: #dc2626;
    }

    /* ============================================================
   FULLSCREEN MODAL
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
    }


/* ============================================================
   MATERIAL RESOURCES
   ============================================================ */

.material-resources {
    margin-top: 24px;
}

.material-resources-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-bottom: 14px;
}

.material-resources-header h3 {
    display: flex;
    align-items: center;
    gap: 8px;
    margin: 0;
    font-size: 16px;
    font-weight: 600;
}

.material-resources-header h3 i {
    font-size: 20px;
}

.material-resources-header > span {
    font-size: 13px;
    color: #6b7280;
}


/* ============================================================
   RESOURCE ITEM
   ============================================================ */

.material-resource-item {
    display: flex;
    align-items: center;
    gap: 14px;

    padding: 14px 16px;
    margin-bottom: 10px;

    background: #fff;

    border: 1px solid #e5e7eb;
    border-radius: 10px;

    transition:
        border-color 0.2s ease,
        box-shadow 0.2s ease;
}

.material-resource-item:hover {
    border-color: #d1d5db;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
}


/* ============================================================
   FILE ICON
   ============================================================ */

.material-resource-icon {
    width: 44px;
    height: 44px;

    display: flex;
    align-items: center;
    justify-content: center;

    flex-shrink: 0;

    border-radius: 9px;

    background: #f3f4f6;
}

.material-resource-icon i {
    font-size: 23px;
}


/* ============================================================
   FILE INFORMATION
   ============================================================ */

.material-resource-info {
    flex: 1;
    min-width: 0;

    display: flex;
    flex-direction: column;
    gap: 4px;
}

.material-resource-info strong {
    overflow: hidden;

    font-size: 14px;
    font-weight: 600;

    color: #1f2937;

    text-overflow: ellipsis;
    white-space: nowrap;
}

.material-resource-info span {
    font-size: 12px;
    color: #6b7280;
}


/* ============================================================
   RESOURCE ACTIONS
   ============================================================ */

.material-resource-actions {
    display: flex;
    align-items: center;
    gap: 8px;

    flex-shrink: 0;
}

.material-resource-open,
.material-resource-download {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 6px;

    padding: 8px 12px;

    border-radius: 7px;

    font-size: 13px;
    font-weight: 500;

    text-decoration: none;

    cursor: pointer;

    transition:
        background 0.2s ease,
        color 0.2s ease;
}

.material-resource-open {
    border: 1px solid #e5e7eb;

    background: #fff;
    color: #374151;
}

.material-resource-open:hover {
    background: #f3f4f6;
}

.material-resource-download {
    border: 1px solid #e5e7eb;

    background: #f9fafb;
    color: #374151;
}

.material-resource-download:hover {
    background: #e5e7eb;
}

.material-resource-open i,
.material-resource-download i {
    font-size: 17px;
}


/* ============================================================
   NO RESOURCES
   ============================================================ */

.material-no-resources {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;

    padding: 35px 20px;

    text-align: center;

    border: 1px dashed #d1d5db;
    border-radius: 10px;

    background: #f9fafb;
}

.material-no-resources i {
    margin-bottom: 10px;

    font-size: 35px;
    color: #9ca3af;
}

.material-no-resources p {
    margin: 0;

    font-size: 14px;
    color: #6b7280;
}


/* ============================================================
   RESOURCE PREVIEW MODAL
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
}

.material-preview-modal.active {
    display: flex;
}


/* ============================================================
   MODAL OVERLAY
   ============================================================ */

.material-preview-overlay {
    position: absolute;
    inset: 0;

    width: 100%;
    height: 100%;

    background: rgba(0, 0, 0, 0.65);
}


/* ============================================================
   MODAL CONTAINER
   ============================================================ */

.material-preview-container {
    position: relative;

    width: 92vw;
    height: 90vh;

    max-width: 1400px;

    display: flex;
    flex-direction: column;

    background: #fff;

    border-radius: 14px;

    overflow: hidden;

    z-index: 1;

    box-shadow: 0 20px 60px rgba(0, 0, 0, 0.25);
}


/* ============================================================
   PREVIEW HEADER
   ============================================================ */

.material-preview-header {
    display: flex;
    align-items: center;
    justify-content: space-between;

    gap: 20px;

    padding: 14px 18px;

    background: #fff;

    border-bottom: 1px solid #e5e7eb;

    flex-shrink: 0;
}

.material-preview-title {
    display: flex;
    align-items: center;

    gap: 10px;

    min-width: 0;

    font-size: 15px;
    font-weight: 600;

    color: #1f2937;
}

.material-preview-title i {
    font-size: 21px;

    flex-shrink: 0;
}

#materialPreviewTitle {
    overflow: hidden;

    text-overflow: ellipsis;
    white-space: nowrap;
}


/* ============================================================
   PREVIEW ACTION BUTTONS
   ============================================================ */

.material-preview-actions {
    display: flex;
    align-items: center;

    gap: 6px;

    flex-shrink: 0;
}

.material-preview-btn {
    width: 38px;
    height: 38px;

    display: flex;
    align-items: center;
    justify-content: center;

    padding: 0;

    border: none;
    border-radius: 8px;

    background: transparent;

    color: #4b5563;

    cursor: pointer;

    transition:
        background 0.2s ease,
        color 0.2s ease,
        transform 0.2s ease;
}

.material-preview-btn i {
    font-size: 21px;
}

.material-preview-btn:hover {
    background: #f3f4f6;
    color: #111827;
}

.material-preview-btn:active {
    transform: scale(0.95);
}

.material-preview-btn.close:hover {
    background: #fee2e2;
    color: #dc2626;
}


/* ============================================================
   PREVIEW BODY
   ============================================================ */

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


/* ============================================================
   PDF PREVIEW
   ============================================================ */

.material-preview-frame {
    width: 100%;
    height: 100%;

    border: none;

    display: block;

    background: #fff;
}


/* ============================================================
   IMAGE PREVIEW
   ============================================================ */

.material-preview-image-wrapper {
    width: 100%;
    height: 100%;

    display: flex;
    align-items: center;
    justify-content: center;

    padding: 30px;

    overflow: auto;
}

.material-preview-image {
    display: block;

    max-width: 100%;
    max-height: 100%;

    width: auto;
    height: auto;

    object-fit: contain;

    border-radius: 8px;

    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
}


/* ============================================================
   VIDEO PREVIEW
   ============================================================ */

.material-preview-video {
    display: block;

    width: 100%;
    height: 100%;

    max-width: 1200px;
    max-height: 100%;

    object-fit: contain;

    background: #000;
}


/* ============================================================
   AUDIO PREVIEW
   ============================================================ */

.material-preview-audio-wrapper {
    width: min(650px, 90%);

    padding: 40px;

    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;

    gap: 25px;

    background: #fff;

    border: 1px solid #e5e7eb;
    border-radius: 16px;

    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
}

.material-preview-audio-wrapper::before {
    content: "♪";

    width: 80px;
    height: 80px;

    display: flex;
    align-items: center;
    justify-content: center;

    border-radius: 50%;

    background: #f3f4f6;

    font-size: 40px;
}

.material-preview-audio-wrapper audio {
    width: 100%;
}


/* ============================================================
   UNSUPPORTED FILE
   ============================================================ */

.material-preview-unavailable {
    width: min(500px, 90%);

    padding: 45px 35px;

    text-align: center;

    background: #fff;

    border: 1px solid #e5e7eb;

    border-radius: 16px;

    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.06);
}

.material-preview-unavailable > i {
    margin-bottom: 15px;

    font-size: 55px;

    color: #6b7280;
}

.material-preview-unavailable h3 {
    margin: 0 0 8px;

    font-size: 18px;
    font-weight: 600;

    color: #1f2937;
}

.material-preview-unavailable p {
    margin: 0 0 25px;

    font-size: 14px;
    line-height: 1.6;

    color: #6b7280;
}

.material-preview-download {
    display: inline-flex;

    align-items: center;
    justify-content: center;

    gap: 8px;

    padding: 10px 18px;

    border-radius: 8px;

    background: #111827;
    color: #fff;

    text-decoration: none;

    font-size: 14px;
    font-weight: 600;
}

.material-preview-download:hover {
    background: #374151;
    color: #fff;
}


/* ============================================================
   FULL SCREEN
   ============================================================ */

.material-preview-modal.fullscreen {
    align-items: stretch;
    justify-content: stretch;
}

.material-preview-modal.fullscreen
.material-preview-container {
    width: 100vw;
    height: 100vh;

    max-width: none;

    border-radius: 0;
}


/* ============================================================
   PREVENT BACKGROUND SCROLL
   ============================================================ */

body.modal-open {
    overflow: hidden;
}


/* ============================================================
   MOBILE
   ============================================================ */

@media (max-width: 768px) {

    .material-resource-item {
        align-items: flex-start;
        flex-wrap: wrap;
    }

    .material-resource-info {
        flex: 1;
    }

    .material-resource-actions {
        width: 100%;
        margin-left: 58px;
    }

    .material-resource-open,
    .material-resource-download {
        flex: 1;
    }

    .material-preview-container {
        width: 96vw;
        height: 92vh;

        border-radius: 10px;
    }

    .material-preview-header {
        padding: 10px 12px;
    }

    .material-preview-title {
        font-size: 14px;
    }

    .material-preview-btn {
        width: 34px;
        height: 34px;
    }

    .material-preview-image-wrapper {
        padding: 15px;
    }

    .material-preview-audio-wrapper {
        padding: 25px 20px;
    }

    .material-preview-unavailable {
        padding: 35px 20px;
    }
}

    /* ============================================================
   RESPONSIVE
   ============================================================ */

    @media (max-width: 768px) {

        .material-modal {
            padding: 10px;
        }

        .material-modal-container {
            width: 100%;
            height: 95vh;

            border-radius: 12px;
        }

        .material-modal-title {
            max-width: 65%;
        }

    }

    @media (max-width: 480px) {

        .material-modal {
            padding: 0;
        }

        .material-modal-container {
            width: 100vw;
            height: 100vh;

            border-radius: 0;
        }

    }

    /* ============================================================
   MOBILE
============================================================ */

    @media (max-width: 768px) {

        .material-preview-modal {
            padding: 10px;
        }

        .material-preview-container {
            height: 95vh;

            border-radius: 12px;
        }

        .material-preview-header {
            min-height: 54px;

            padding: 10px 12px;
        }

        .material-preview-image-wrapper {
            padding: 15px;
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
            padding: 20px 16px 40px;
        }

        .classwork-show-heading {
            align-items: flex-start;
            gap: 14px;
        }

        .classwork-show-icon {
            width: 48px;
            height: 48px;

            border-radius: 12px;

            font-size: 23px;
        }

        .classwork-show-heading h1 {
            font-size: 22px;
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
            padding: 16px 18px;
        }

        .classwork-detail-card-header h2 {
            font-size: 16px;
        }

        .classwork-description {
            padding: 18px;

            font-size: 14px;
        }

        .classwork-file {
            padding: 18px;
        }

        .classwork-file-icon {
            width: 44px;
            height: 44px;

            font-size: 21px;
        }

        .classwork-info-item {
            padding: 15px 18px;
        }

        .classwork-action-btn {
            margin: 14px;
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

    [data-theme="dark"] .classwork-file-icon {
        background-color: rgba(2, 132, 199, 0.15);
        color: #38bdf8;
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