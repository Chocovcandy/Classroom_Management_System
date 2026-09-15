<style>
/* ============================================================
   PROJECT SHOW PAGE
   Based on Assignment Show layout
   Project concept: yellow / amber
   ============================================================ */

.classwork-show-page {
    --project-yellow: #f59e0b;
    --project-yellow-dark: #d97706;
    --project-yellow-soft: #fffbeb;
    --project-yellow-light: #fef3c7;
    --project-yellow-border: #fde68a;

    --project-blue: #2563eb;
    --project-blue-dark: #1d4ed8;
    --project-blue-soft: #eff6ff;
    --project-blue-border: #bfdbfe;

    --project-text: #0f172a;
    --project-text-2: #334155;
    --project-muted: #64748b;
    --project-light: #94a3b8;

    --project-border: #e2e8f0;
    --project-border-light: #edf2f7;
    --project-surface: #ffffff;
    --project-soft: #f8fafc;

    --project-shadow: 0 5px 20px rgba(15,23,42,.045);
    --project-small-shadow: 0 2px 8px rgba(15,23,42,.045);
    --project-radius: 17px;

    width: 100%;
    max-width: 1240px;
    margin: 0 auto;
    padding: 18px 24px 34px;
    color: var(--project-text);
}

.classwork-show-page *,
.classwork-show-page *::before,
.classwork-show-page *::after {
    box-sizing: border-box;
}

/* ============================================================
   HEADER
   ============================================================ */

.classwork-show-header {
    margin-bottom: 17px;
}

.classwork-back-btn {
    width: auto !important;
    min-width: 0;
    height: 38px;
    display: inline-flex;
    align-items: center;
    justify-content: flex-start;
    gap: 7px;
    margin: 0 0 15px;
    padding: 0 !important;
    border: 0 !important;
    border-radius: 9px;
    background: transparent !important;
    color: #64748b;
    text-decoration: none;
    box-shadow: none !important;
    font-size: 13px;
    font-weight: 700;
    line-height: 1;
    white-space: nowrap;
    transition: color .18s ease, transform .18s ease;
}

.classwork-back-btn:hover {
    color: var(--project-yellow-dark);
    transform: translateX(-2px);
}

.classwork-back-btn i {
    flex: 0 0 auto;
    font-size: 20px;
}

.classwork-show-heading {
    display: flex;
    align-items: center;
    gap: 13px;
    min-width: 0;
}

.classwork-show-icon {
    width: 52px;
    height: 52px;
    flex: 0 0 52px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    border: 1px solid var(--project-yellow-border);
    border-radius: 14px;
    background: var(--project-yellow-soft);
    color: var(--project-yellow);
    font-size: 24px;
}

.classwork-show-type {
    display: block;
    margin: 0 0 3px;
    color: var(--project-yellow-dark);
    font-size: 10px;
    font-weight: 800;
    letter-spacing: .13em;
    text-transform: uppercase;
}

.classwork-show-heading h1 {
    margin: 0;
    color: var(--project-text);
    font-size: 27px;
    line-height: 1.12;
    font-weight: 800;
    letter-spacing: -.025em;
    overflow-wrap: anywhere;
}

.classwork-show-topic {
    display: inline-flex;
    align-items: center;
    gap: 5px;
    margin-top: 5px;
    color: var(--project-muted);
    font-size: 11px;
}

.classwork-show-topic i {
    color: var(--project-blue);
    font-size: 14px;
}

/* ============================================================
   MAIN GRID
   ============================================================ */

.classwork-show-grid {
    display: grid;
    grid-template-columns: minmax(0, 1fr) 300px;
    gap: 18px;
    align-items: start;
}

.classwork-show-main {
    display: flex;
    flex-direction: column;
    gap: 14px;
    min-width: 0;
}

.classwork-show-sidebar {
    display: flex;
    flex-direction: column;
    gap: 14px;
    position: sticky;
    top: 14px;
}

/* ============================================================
   CARDS
   ============================================================ */

.classwork-detail-card {
    overflow: hidden;
    min-width: 0;
    border: 1px solid var(--project-border);
    border-radius: var(--project-radius);
    background: var(--project-surface);
    box-shadow: var(--project-shadow);
}

.classwork-detail-card-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 10px;
    min-height: 53px;
    padding: 13px 20px;
    border-bottom: 1px solid var(--project-border-light);
    background: var(--project-surface);
}

.classwork-detail-card-header h2 {
    margin: 0;
    color: var(--project-text);
    font-size: 14px;
    line-height: 1.2;
    font-weight: 800;
}

.classwork-detail-card-header h2::before {
    content: "";
    display: inline-block;
    width: 4px;
    height: 15px;
    margin-right: 8px;
    vertical-align: -3px;
    border-radius: 999px;
    background: var(--project-yellow);
}

/* ============================================================
   DESCRIPTION
   ============================================================ */

.classwork-description {
    min-height: 76px;
    padding: 17px 20px;
    color: var(--project-text-2);
    font-size: 13px;
    line-height: 1.65;
    overflow-wrap: anywhere;
}

.classwork-no-content {
    color: var(--project-muted);
    font-style: italic;
}

/* ============================================================
   PROJECT TYPE
   ============================================================ */

.project-type-section {
    padding: 13px 20px 15px;
}

.project-type-box {
    display: flex;
    align-items: center;
    gap: 11px;
    padding: 11px;
    border: 1px solid var(--project-yellow-border);
    border-radius: 11px;
    background: var(--project-yellow-soft);
}

.project-type-icon {
    width: 39px;
    height: 39px;
    flex: 0 0 39px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    border: 1px solid var(--project-yellow-border);
    border-radius: 9px;
    background: #fff;
    color: var(--project-yellow);
    box-shadow: var(--project-small-shadow);
    font-size: 18px;
}

.project-type-info {
    min-width: 0;
    flex: 1;
    display: flex;
    flex-direction: column;
    gap: 2px;
}

.project-type-info strong {
    color: var(--project-text-2);
    font-size: 12px;
    font-weight: 800;
}

.project-type-info span {
    color: var(--project-muted);
    font-size: 10px;
    line-height: 1.4;
}

/* ============================================================
   ATTACHMENTS
   ============================================================ */

.classwork-files {
    display: flex;
    flex-direction: column;
    gap: 7px;
    padding: 12px 20px 14px;
}

.classwork-file {
    display: flex;
    align-items: center;
    gap: 10px;
    min-width: 0;
    padding: 9px 10px;
    border: 1px solid var(--project-border);
    border-radius: 11px;
    background: var(--project-soft);
    transition: .18s ease;
}

.classwork-file:hover {
    border-color: var(--project-yellow-border);
    background: var(--project-yellow-soft);
}

.classwork-file-icon {
    width: 38px;
    height: 38px;
    flex: 0 0 38px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    border: 1px solid var(--project-yellow-border);
    border-radius: 9px;
    background: var(--project-yellow-soft);
    color: var(--project-yellow);
    font-size: 17px;
}

.classwork-file-info {
    min-width: 0;
    flex: 1;
    display: flex;
    flex-direction: column;
    gap: 2px;
}

.classwork-file-info strong {
    display: block;
    overflow: hidden;
    color: var(--project-text-2);
    font-size: 11px;
    font-weight: 750;
    text-overflow: ellipsis;
    white-space: nowrap;
}

.classwork-file-info span {
    display: block;
    color: var(--project-light);
    font-size: 9px;
}

.classwork-file-open {
    min-height: 33px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 5px;
    flex: 0 0 auto;
    padding: 0 10px;
    border: 1px solid var(--project-blue-border);
    border-radius: 8px;
    background: var(--project-surface);
    color: var(--project-blue);
    font-size: 10px;
    font-weight: 800;
    cursor: pointer;
    text-decoration: none;
    transition: .18s ease;
}

.classwork-file-open:hover {
    border-color: var(--project-blue);
    background: var(--project-blue-soft);
    color: var(--project-blue-dark);
}

.classwork-file-open i {
    font-size: 15px;
}

.classwork-no-files {
    min-height: 105px;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    margin: 12px 20px 14px;
    padding: 18px;
    border: 1px dashed var(--project-border);
    border-radius: 11px;
    background: var(--project-soft);
    text-align: center;
}

.classwork-no-files i {
    margin-bottom: 6px;
    color: var(--project-light);
    font-size: 23px;
}

.classwork-no-files p {
    margin: 0;
    color: var(--project-muted);
    font-size: 11px;
}

/* ============================================================
   SIDEBAR
   ============================================================ */

.classwork-info-list {
    display: flex;
    flex-direction: column;
}

.classwork-info-item {
    display: flex;
    align-items: center;
    gap: 10px;
    padding: 12px 16px;
    border-bottom: 1px solid var(--project-border-light);
}

.classwork-info-item:last-child {
    border-bottom: 0;
}

.classwork-info-item > i {
    width: 33px;
    height: 33px;
    flex: 0 0 33px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    border-radius: 8px;
    background: var(--project-blue-soft);
    color: var(--project-blue);
    font-size: 16px;
}

.classwork-info-item.project-type-info-item > i {
    background: var(--project-yellow-soft);
    color: var(--project-yellow);
}

.classwork-info-item > div {
    min-width: 0;
    display: flex;
    flex-direction: column;
    gap: 1px;
}

.classwork-info-item span {
    color: var(--project-muted);
    font-size: 9px;
}

.classwork-info-item strong {
    color: var(--project-text-2);
    font-size: 12px;
    font-weight: 800;
    overflow-wrap: anywhere;
}

/* ============================================================
   ACTIONS
   ============================================================ */

.classwork-action-btn {
    display: flex;
    align-items: center;
    justify-content: flex-start;
    gap: 8px;
    min-height: 40px;
    margin: 12px 16px 15px;
    padding: 0 12px;
    border: 1px solid var(--project-yellow-border);
    border-radius: 9px;
    background: var(--project-yellow-soft);
    color: var(--project-yellow-dark);
    text-decoration: none;
    font-size: 11px;
    font-weight: 800;
    transition: .18s ease;
}

.classwork-action-btn:hover {
    border-color: var(--project-yellow);
    background: var(--project-yellow-light);
}

.classwork-action-btn i {
    font-size: 16px;
}

/* ============================================================
   FILE VIEWER
   ============================================================ */

.project-viewer-modal {
    position: fixed;
    inset: 0;
    z-index: 9999;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 20px;
    background: rgba(2, 6, 23, .76);
    opacity: 0;
    visibility: hidden;
    pointer-events: none;
    transition: opacity .2s ease, visibility .2s ease;
}

.project-viewer-modal.active {
    opacity: 1;
    visibility: visible;
    pointer-events: auto;
}

.project-viewer-container {
    width: min(1200px, 100%);
    height: min(850px, 90vh);
    display: flex;
    flex-direction: column;
    overflow: hidden;
    border: 1px solid var(--project-border);
    border-radius: 14px;
    background: var(--project-surface);
    box-shadow: 0 24px 70px rgba(0, 0, 0, .35);
}

.project-viewer-header {
    min-height: 54px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 12px;
    padding: 0 14px;
    border-bottom: 1px solid var(--project-border);
    background: var(--project-surface);
}

.project-viewer-title {
    min-width: 0;
    display: flex;
    align-items: center;
    gap: 8px;
    color: var(--project-text-2);
    font-size: 12px;
    font-weight: 750;
}

.project-viewer-title i {
    color: var(--project-yellow);
    font-size: 18px;
}

.project-viewer-title span {
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
}

.project-viewer-actions {
    display: flex;
    align-items: center;
    gap: 5px;
}

.project-viewer-btn {
    width: 34px;
    height: 34px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    padding: 0;
    border: 1px solid var(--project-border);
    border-radius: 8px;
    background: transparent;
    color: var(--project-muted);
    cursor: pointer;
    transition: .18s ease;
}

.project-viewer-btn:hover {
    border-color: var(--project-blue);
    background: var(--project-blue-soft);
    color: var(--project-text);
}

.project-viewer-btn.close:hover {
    border-color: #ef4444;
    color: #ef4444;
}

.project-viewer-btn i {
    font-size: 18px;
}

.project-viewer-body {
    flex: 1;
    min-height: 0;
    background: #171717;
}

.project-viewer-body iframe {
    display: block;
    width: 100%;
    height: 100%;
    border: 0;
    background: #fff;
}

.project-viewer-container:fullscreen {
    width: 100vw;
    height: 100vh;
    border: 0;
    border-radius: 0;
}

/* ============================================================
   FOCUS
   ============================================================ */

.classwork-show-page button:focus-visible,
.classwork-show-page a:focus-visible {
    outline: 3px solid rgba(245, 158, 11, .18);
    outline-offset: 2px;
}

/* ============================================================
   DARK MODE
   ============================================================ */

.dark-mode .classwork-show-page {
    --project-yellow: #fbbf24;
    --project-yellow-dark: #fcd34d;
    --project-yellow-soft: rgba(251, 191, 36, .12);
    --project-yellow-light: rgba(251, 191, 36, .18);
    --project-yellow-border: rgba(251, 191, 36, .34);

    --project-blue: #6d76ff;
    --project-blue-dark: #8990ff;
    --project-blue-soft: rgba(109, 118, 255, .12);
    --project-blue-border: rgba(109, 118, 255, .34);

    --project-text: #f4f5ff;
    --project-text-2: #e6e8f7;
    --project-muted: #a1a4cc;
    --project-light: #9295bd;

    --project-border: #2b2e52;
    --project-border-light: #252847;
    --project-surface: #171933;
    --project-soft: #12142a;

    --project-shadow: 0 7px 24px rgba(0, 0, 10, .25);
    --project-small-shadow: 0 2px 8px rgba(0, 0, 10, .18);

    color: var(--project-text);
    color-scheme: dark;
}

.dark-mode .classwork-show-page .classwork-back-btn {
    color: var(--project-muted);
}

.dark-mode .classwork-show-page .classwork-back-btn:hover {
    color: var(--project-yellow-dark);
}

.dark-mode .classwork-show-page .classwork-show-icon {
    border-color: var(--project-yellow-border);
    background: var(--project-yellow-soft);
    color: var(--project-yellow);
}

.dark-mode .classwork-show-page .classwork-show-type {
    color: var(--project-yellow-dark);
}

.dark-mode .classwork-show-page .classwork-show-heading h1,
.dark-mode .classwork-show-page .classwork-detail-card-header h2 {
    color: var(--project-text);
}

.dark-mode .classwork-show-page .classwork-show-topic {
    color: var(--project-muted);
}

.dark-mode .classwork-show-page .classwork-show-topic i {
    color: var(--project-blue);
}

.dark-mode .classwork-show-page .classwork-detail-card,
.dark-mode .classwork-show-page .classwork-detail-card-header {
    border-color: var(--project-border);
    background: var(--project-surface);
}

.dark-mode .classwork-show-page .classwork-description {
    color: var(--project-text-2);
}

.dark-mode .classwork-show-page .project-type-box {
    border-color: var(--project-yellow-border);
    background: rgba(251, 191, 36, .07);
}

.dark-mode .classwork-show-page .project-type-icon {
    border-color: var(--project-yellow-border);
    background: var(--project-surface);
    color: var(--project-yellow);
}

.dark-mode .classwork-show-page .project-type-info strong {
    color: var(--project-text-2);
}

.dark-mode .classwork-show-page .project-type-info span {
    color: var(--project-muted);
}

.dark-mode .classwork-show-page .classwork-file {
    border-color: var(--project-border);
    background: var(--project-soft);
}

.dark-mode .classwork-show-page .classwork-file:hover {
    border-color: var(--project-yellow-border);
    background: var(--project-yellow-soft);
}

.dark-mode .classwork-show-page .classwork-file-icon {
    border-color: var(--project-yellow-border);
    background: var(--project-yellow-soft);
    color: var(--project-yellow);
}

.dark-mode .classwork-show-page .classwork-file-info strong {
    color: var(--project-text-2);
}

.dark-mode .classwork-show-page .classwork-file-info span {
    color: var(--project-light);
}

.dark-mode .classwork-show-page .classwork-file-open {
    border-color: var(--project-blue-border);
    background: var(--project-surface);
    color: var(--project-blue-dark);
}

.dark-mode .classwork-show-page .classwork-no-files {
    border-color: #3a3e68;
    background: var(--project-soft);
}

.dark-mode .classwork-show-page .classwork-info-item {
    border-color: var(--project-border-light);
}

.dark-mode .classwork-show-page .classwork-info-item > i {
    background: var(--project-blue-soft);
    color: var(--project-blue);
}

.dark-mode .classwork-show-page .classwork-info-item.project-type-info-item > i {
    background: var(--project-yellow-soft);
    color: var(--project-yellow);
}

.dark-mode .classwork-show-page .classwork-info-item span {
    color: var(--project-muted);
}

.dark-mode .classwork-show-page .classwork-info-item strong {
    color: var(--project-text-2);
}

.dark-mode .classwork-show-page .classwork-action-btn {
    border-color: var(--project-yellow-border);
    background: var(--project-yellow-soft);
    color: var(--project-yellow-dark);
}

.dark-mode .classwork-show-page .project-viewer-container,
.dark-mode .classwork-show-page .project-viewer-header {
    border-color: var(--project-border);
    background: var(--project-surface);
}

.dark-mode .classwork-show-page .project-viewer-title {
    color: var(--project-text-2);
}

.dark-mode .classwork-show-page .project-viewer-btn {
    border-color: var(--project-border);
    color: var(--project-muted);
}

/* ============================================================
   PROJECT TEAMS
   ============================================================ */

.project-teams-section {
    padding: 14px 20px 18px;
}

.project-teams-summary {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 12px;
    margin-bottom: 14px;
    padding: 11px 13px;
    border: 1px solid var(--project-yellow-border);
    border-radius: 11px;
    background: var(--project-yellow-soft);
}

.project-teams-summary-left {
    display: flex;
    align-items: center;
    gap: 10px;
    min-width: 0;
}

.project-teams-summary-icon {
    width: 38px;
    height: 38px;
    flex: 0 0 38px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    border: 1px solid var(--project-yellow-border);
    border-radius: 9px;
    background: var(--project-surface);
    color: var(--project-yellow);
    font-size: 18px;
}

.project-teams-summary-info {
    display: flex;
    flex-direction: column;
    gap: 2px;
}

.project-teams-summary-info strong {
    color: var(--project-text-2);
    font-size: 12px;
    font-weight: 800;
}

.project-teams-summary-info span {
    color: var(--project-muted);
    font-size: 10px;
}

.project-teams-count {
    flex: 0 0 auto;
    padding: 6px 9px;
    border: 1px solid var(--project-yellow-border);
    border-radius: 7px;
    background: var(--project-surface);
    color: var(--project-yellow-dark);
    font-size: 10px;
    font-weight: 800;
    white-space: nowrap;
}


/* MANAGE STUDENT TEAMS */

.project-teams-manage {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 14px;
    margin-bottom: 14px;
    padding: 12px 14px;
    border: 1px solid var(--project-border);
    border-radius: 11px;
    background: var(--project-surface);
    box-shadow: var(--project-small-shadow);
}

.project-teams-manage-info {
    display: flex;
    align-items: center;
    gap: 10px;
    min-width: 0;
}

.project-teams-manage-icon {
    width: 36px;
    height: 36px;
    flex: 0 0 36px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    border-radius: 9px;
    background: var(--project-yellow-soft);
    color: var(--project-yellow);
    font-size: 18px;
}

.project-teams-manage-info > div:last-child {
    display: flex;
    flex-direction: column;
    gap: 2px;
}

.project-teams-manage-info strong {
    color: var(--project-text);
    font-size: 11px;
    font-weight: 800;
}

.project-teams-manage-info span {
    color: var(--project-muted);
    font-size: 9px;
    line-height: 1.5;
}

.project-teams-manage-btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 6px;
    flex: 0 0 auto;
    padding: 8px 11px;
    border: 1px solid var(--project-yellow-border);
    border-radius: 8px;
    background: var(--project-yellow-soft);
    color: var(--project-yellow-dark);
    font-size: 9px;
    font-weight: 800;
    text-decoration: none;
    transition:
        background .18s ease,
        border-color .18s ease,
        color .18s ease,
        transform .18s ease;
}

.project-teams-manage-btn i {
    font-size: 15px;
}

.project-teams-manage-btn:hover {
    background: var(--project-yellow);
    border-color: var(--project-yellow);
    color: #ffffff;
    transform: translateY(-1px);
}


/* EMPTY PROJECT TEAMS */

.project-teams-empty {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    padding: 28px 20px;
    border: 1px dashed var(--project-border);
    border-radius: 11px;
    background: var(--project-soft);
    text-align: center;
}

.project-teams-empty-icon {
    width: 42px;
    height: 42px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    margin-bottom: 8px;
    border-radius: 10px;
    background: var(--project-yellow-soft);
    color: var(--project-yellow);
    font-size: 20px;
}

.project-teams-empty strong {
    margin-bottom: 3px;
    color: var(--project-text);
    font-size: 11px;
    font-weight: 800;
}

.project-teams-empty span {
    max-width: 420px;
    color: var(--project-muted);
    font-size: 9px;
    line-height: 1.6;
}


/* TEAM GRID */

.project-teams-grid {
    display: grid;
    grid-template-columns: repeat(2, minmax(0, 1fr));
    gap: 12px;
}


/* TEAM CARD */

.project-team-card {
    overflow: hidden;
    border: 1px solid var(--project-border);
    border-radius: 13px;
    background: var(--project-surface);
    box-shadow: var(--project-small-shadow);
}

.project-team-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 10px;
    min-height: 49px;
    padding: 10px 12px;
    border-bottom: 1px solid var(--project-border-light);
    background: var(--project-soft);
}

.project-team-title {
    display: flex;
    align-items: center;
    gap: 8px;
    min-width: 0;
}

.project-team-title-icon {
    width: 31px;
    height: 31px;
    flex: 0 0 31px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    border-radius: 8px;
    background: var(--project-yellow-soft);
    color: var(--project-yellow);
    font-size: 15px;
}

.project-team-title strong {
    color: var(--project-text);
    font-size: 12px;
    font-weight: 800;
}

.project-team-member-count {
    flex: 0 0 auto;
    padding: 5px 8px;
    border-radius: 7px;
    background: var(--project-surface);
    color: var(--project-muted);
    font-size: 9px;
    font-weight: 750;
}


/* TEAM MEMBERS */

.project-team-members {
    display: flex;
    flex-direction: column;
}

.project-team-member {
    display: flex;
    align-items: center;
    gap: 9px;
    min-width: 0;
    padding: 9px 12px;
    border-bottom: 1px solid var(--project-border-light);
}

.project-team-member:last-child {
    border-bottom: 0;
}

.project-team-avatar {
    width: 31px;
    height: 31px;
    flex: 0 0 31px;
    overflow: hidden;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    border-radius: 50%;
    background: var(--project-yellow-soft);
    color: var(--project-yellow-dark);
    font-size: 12px;
    font-weight: 800;
}

.project-team-avatar img {
    width: 100%;
    height: 100%;
    display: block;
    object-fit: cover;
}

.project-team-member-info {
    min-width: 0;
    flex: 1;
    display: flex;
    flex-direction: column;
    gap: 2px;
}

.project-team-member-info strong {
    overflow: hidden;
    color: var(--project-text-2);
    font-size: 10px;
    font-weight: 750;
    text-overflow: ellipsis;
    white-space: nowrap;
}

.project-team-member-info span {
    color: var(--project-muted);
    font-size: 8px;
}

.project-team-role {
    flex: 0 0 auto;
    padding: 4px 7px;
    border-radius: 6px;
    font-size: 8px;
    font-weight: 800;
    white-space: nowrap;
}

.project-team-role.leader {
    border: 1px solid var(--project-yellow-border);
    background: var(--project-yellow-soft);
    color: var(--project-yellow-dark);
}

.project-team-role.backup {
    border: 1px solid var(--project-blue-border);
    background: var(--project-blue-soft);
    color: var(--project-blue);
}

.project-team-role.member {
    background: var(--project-soft);
    color: var(--project-muted);
}


/* EMPTY TEAM */

.project-team-empty {
    padding: 20px 12px;
    text-align: center;
}

.project-team-empty i {
    display: block;
    margin-bottom: 5px;
    color: var(--project-light);
    font-size: 21px;
}

.project-team-empty span {
    color: var(--project-muted);
    font-size: 9px;
}


/* TEAM FOOTER */

.project-team-footer {
    display: flex;
    align-items: center;
    gap: 7px;
    padding: 9px 12px;
    border-top: 1px solid var(--project-border-light);
    background: var(--project-soft);
}

.project-team-footer i {
    color: var(--project-yellow);
    font-size: 14px;
}

.project-team-footer span {
    color: var(--project-muted);
    font-size: 8px;
}

.project-team-footer strong {
    color: var(--project-text-2);
    font-size: 9px;
    font-weight: 800;
}


.project-team-leader {
    min-width: 0;
    flex: 1;
    display: flex;
    align-items: center;
    gap: 7px;
}

.project-team-view-btn {
    flex: 0 0 auto;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 4px;
    min-height: 29px;
    padding: 0 9px;
    border: 1px solid var(--project-yellow-border);
    border-radius: 7px;
    background: var(--project-surface);
    color: var(--project-yellow-dark);
    text-decoration: none;
    font-size: 8px;
    font-weight: 800;
    white-space: nowrap;
    transition: .18s ease;
}

.project-team-view-btn:hover {
    border-color: var(--project-yellow);
    background: var(--project-yellow-soft);
    color: var(--project-yellow-dark);
}

.project-team-view-btn i {
    font-size: 13px;
}



/* DARK MODE */

.dark-mode .classwork-show-page .project-teams-manage {
    border-color: var(--project-border);
    background: var(--project-surface);
}

.dark-mode .classwork-show-page .project-teams-manage-info strong {
    color: var(--project-text-2);
}

.dark-mode .classwork-show-page .project-teams-manage-btn {
    border-color: var(--project-yellow-border);
    background: var(--project-yellow-soft);
    color: var(--project-yellow);
}

.dark-mode .classwork-show-page .project-teams-manage-btn:hover {
    background: var(--project-yellow);
    color: #ffffff;
}

.dark-mode .classwork-show-page .project-teams-empty {
    border-color: var(--project-border);
    background: var(--project-soft);
}

.dark-mode .classwork-show-page .project-teams-empty strong {
    color: var(--project-text-2);
}

.dark-mode .classwork-show-page .project-teams-summary {
    border-color: var(--project-yellow-border);
    background: rgba(251, 191, 36, .07);
}

.dark-mode .classwork-show-page .project-teams-summary-icon,
.dark-mode .classwork-show-page .project-teams-count {
    border-color: var(--project-yellow-border);
    background: var(--project-surface);
}

.dark-mode .classwork-show-page .project-team-card {
    border-color: var(--project-border);
    background: var(--project-surface);
}

.dark-mode .classwork-show-page .project-team-header,
.dark-mode .classwork-show-page .project-team-footer {
    border-color: var(--project-border-light);
    background: var(--project-soft);
}

.dark-mode .classwork-show-page .project-team-member {
    border-color: var(--project-border-light);
}

.dark-mode .classwork-show-page .project-team-title strong,
.dark-mode .classwork-show-page .project-team-member-info strong,
.dark-mode .classwork-show-page .project-team-footer strong {
    color: var(--project-text-2);
}

.dark-mode .classwork-show-page .project-team-member-info span,
.dark-mode .classwork-show-page .project-team-member-count,
.dark-mode .classwork-show-page .project-team-footer span {
    color: var(--project-muted);
}


.dark-mode .classwork-show-page .project-team-view-btn {
    border-color: var(--project-yellow-border);
    background: var(--project-surface);
    color: var(--project-yellow-dark);
}

.dark-mode .classwork-show-page .project-team-view-btn:hover {
    background: var(--project-yellow-soft);
}



/* RESPONSIVE */

@media (max-width: 700px) {

    .project-teams-manage {
        align-items: stretch;
        flex-direction: column;
    }

    .project-teams-manage-btn {
        width: 100%;
    }

    .project-teams-section {
        padding: 12px 17px 15px;
    }

    .project-teams-grid {
        grid-template-columns: 1fr;
    }

    .project-teams-summary {
        align-items: flex-start;
    }
}

@media (max-width: 480px) {

    .project-teams-summary {
        flex-direction: column;
    }

    .project-teams-count {
        align-self: flex-start;
    }
}

/* ============================================================
   RESPONSIVE
   ============================================================ */

@media (max-width: 1000px) {
    .classwork-show-grid {
        grid-template-columns: minmax(0, 1fr) 275px;
        gap: 15px;
    }
}

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
        padding: 18px 16px 30px;
    }

    .classwork-show-heading {
        gap: 11px;
    }

    .classwork-show-icon {
        width: 48px;
        height: 48px;
        flex-basis: 48px;
        border-radius: 12px;
        font-size: 22px;
    }

    .classwork-show-heading h1 {
        font-size: 23px;
    }

    .classwork-detail-card-header {
        min-height: 50px;
        padding: 13px 17px;
    }

    .classwork-description {
        padding: 16px 17px;
    }

    .project-type-section {
        padding: 12px 17px 14px;
    }

    .project-type-box {
        align-items: flex-start;
    }

    .classwork-file {
        align-items: flex-start;
        flex-wrap: wrap;
    }

    .classwork-file-open {
        width: 100%;
    }
}

@media (max-width: 480px) {
    .classwork-show-page {
        padding: 15px 13px 25px;
    }

    .classwork-back-btn {
        height: 36px;
        margin-bottom: 12px;
        font-size: 12px;
    }

    .classwork-show-icon {
        width: 44px;
        height: 44px;
        flex-basis: 44px;
        font-size: 20px;
    }

    .classwork-show-heading h1 {
        font-size: 20px;
    }
}

/* ============================================================
   PROJECT SUBMISSIONS
   ============================================================ */

.project-submissions-section {
    padding: 14px 20px 18px;
}

.project-submissions-summary {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 12px;
    margin-bottom: 12px;
    padding: 11px 13px;
    border: 1px solid var(--project-yellow-border);
    border-radius: 11px;
    background: var(--project-yellow-soft);
}

.project-submissions-summary-info {
    display: flex;
    align-items: center;
    gap: 10px;
    min-width: 0;
}

.project-submissions-summary-icon {
    width: 38px;
    height: 38px;
    flex: 0 0 38px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    border: 1px solid var(--project-yellow-border);
    border-radius: 9px;
    background: var(--project-surface);
    color: var(--project-yellow);
    font-size: 18px;
}

.project-submissions-summary-text {
    min-width: 0;
    display: flex;
    flex-direction: column;
    gap: 2px;
}

.project-submissions-summary-text strong {
    color: var(--project-text-2);
    font-size: 12px;
    font-weight: 800;
}

.project-submissions-summary-text span {
    color: var(--project-muted);
    font-size: 10px;
}

.project-submissions-count {
    flex: 0 0 auto;
    padding: 6px 9px;
    border: 1px solid var(--project-yellow-border);
    border-radius: 7px;
    background: var(--project-surface);
    color: var(--project-yellow-dark);
    font-size: 10px;
    font-weight: 800;
    white-space: nowrap;
}

.project-submission-list {
    display: flex;
    flex-direction: column;
    gap: 8px;
}

.project-submission-item {
    display: flex;
    align-items: center;
    gap: 11px;
    min-width: 0;
    padding: 10px 12px;
    border: 1px solid var(--project-border);
    border-radius: 11px;
    background: var(--project-surface);
    transition: .18s ease;
}

.project-submission-item:hover {
    border-color: var(--project-yellow-border);
    background: var(--project-yellow-soft);
}

.project-submission-icon {
    width: 36px;
    height: 36px;
    flex: 0 0 36px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    border-radius: 9px;
    background: var(--project-yellow-soft);
    color: var(--project-yellow);
    font-size: 17px;
}

.project-submission-info {
    min-width: 0;
    flex: 1;
    display: flex;
    flex-direction: column;
    gap: 3px;
}

.project-submission-info strong {
    overflow: hidden;
    color: var(--project-text-2);
    font-size: 11px;
    font-weight: 800;
    text-overflow: ellipsis;
    white-space: nowrap;
}

.project-submission-info span {
    color: var(--project-muted);
    font-size: 9px;
    overflow-wrap: anywhere;
}

.project-submission-status {
    flex: 0 0 auto;
    display: inline-flex;
    align-items: center;
    gap: 4px;
    padding: 5px 7px;
    border-radius: 6px;
    background: var(--project-blue-soft);
    color: var(--project-blue);
    font-size: 8px;
    font-weight: 800;
    white-space: nowrap;
}

.project-submission-status.graded {
    background: #ecfdf5;
    color: #059669;
}

.project-submission-view-btn {
    flex: 0 0 auto;
    min-height: 30px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 4px;
    padding: 0 9px;
    border: 1px solid var(--project-yellow-border);
    border-radius: 7px;
    background: var(--project-surface);
    color: var(--project-yellow-dark);
    text-decoration: none;
    font-size: 8px;
    font-weight: 800;
    white-space: nowrap;
    transition: .18s ease;
}

.project-submission-view-btn:hover {
    border-color: var(--project-yellow);
    background: var(--project-yellow-soft);
}

.dark-mode .classwork-show-page .project-submission-item {
    border-color: var(--project-border);
    background: var(--project-surface);
}

.dark-mode .classwork-show-page .project-submission-item:hover {
    border-color: var(--project-yellow-border);
    background: var(--project-yellow-soft);
}

.dark-mode .classwork-show-page .project-submission-status.graded {
    background: rgba(16, 185, 129, .12);
    color: #34d399;
}

@media (max-width: 700px) {
    .project-submission-item {
        align-items: flex-start;
        flex-wrap: wrap;
    }

    .project-submission-view-btn {
        width: 100%;
    }
}

@media (max-width: 480px) {
    .project-submissions-summary {
        align-items: flex-start;
        flex-direction: column;
    }
}

</style>

@extends('layouts.prof_layout')

@section('content')


<div class="classwork-show-page">

    {{-- ============================================================
        HEADER
    ============================================================= --}}

    <div class="classwork-show-header">

        {{-- BACK BUTTON --}}

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
            class="classwork-back-btn"
            title="{{ $returnTo === 'classwork' ? 'Back to Classwork' : 'Back to Stream' }}"
        >
            <i class="bx bx-arrow-back"></i>

            {{ $returnTo === 'classwork'
                ? 'Back to Classwork'
                : 'Back to Stream'
            }}
        </a>


        {{-- PROJECT HEADER --}}

        <div class="classwork-show-heading">

            <div class="classwork-show-icon">
                <i class="bx bx-group"></i>
            </div>

            <div>

                <span class="classwork-show-type">
                    PROJECT
                </span>

                <h1>
                    {{ $project->title }}
                </h1>

                @if($project->topic)

                <div class="classwork-show-topic">
                    <i class="bx bx-folder"></i>

                    {{ $project->topic->topic_name }}
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

            @if($project->description)

            <section class="classwork-detail-card">

                <div class="classwork-detail-card-header">

                    <h2>
                        Project Instructions
                    </h2>

                </div>

                <div class="classwork-description">

                    {!! nl2br(e($project->description)) !!}

                </div>

            </section>

            @endif


            {{-- ====================================================
                PROJECT TYPE
            ===================================================== --}}

            <section class="classwork-detail-card">

                <div class="classwork-detail-card-header">

                    <h2>
                        Project Type
                    </h2>

                </div>

                <div class="project-type-section">

                    <div class="project-type-box">

                        <div class="project-type-icon">

                            @if($project->project_type === 'team')
                                <i class="bx bx-group"></i>
                            @else
                                <i class="bx bx-user"></i>
                            @endif

                        </div>

                        <div class="project-type-info">

                            <strong>
                                {{ $project->project_type === 'team'
                                    ? 'Team Project'
                                    : 'Individual Project'
                                }}
                            </strong>

                            <span>
                                {{ $project->project_type === 'team'
                                    ? 'Students will complete this project as a team.'
                                    : 'Each student completes this project individually.'
                                }}
                            </span>

                        </div>

                    </div>

                </div>

            </section>

            {{-- ====================================================
    PROJECT TEAMS
===================================================== --}}

@if($project->project_type === 'team')

<section class="classwork-detail-card">

    <div class="classwork-detail-card-header">

        <h2>
            Project Teams
        </h2>

        @if($project->groups->isNotEmpty())

            <span style="
                color: var(--project-muted);
                font-size: 9px;
                font-weight: 750;
            ">
                {{ $project->groups->count() }} Teams
            </span>

        @endif

    </div>


    <div class="project-teams-section">

            {{-- MANAGE STUDENT TEAMS --}}

            <div class="project-teams-manage">

                <div class="project-teams-manage-info">

                    <div class="project-teams-manage-icon">
                        <i class="bx bx-group"></i>
                    </div>

                    <div>
                        <strong>Manage Student Teams</strong>
                        <span>
                            Create teams, assign students, and manage team leaders.
                        </span>
                    </div>

                </div>

                <a
                    href="{{ route(
                        'professor.classworks.projects.groups.manage',
                        [
                            'classGroupId' => $classGroup->id,
                            'projectId' => $project->id,
                        ]
                    ) }}"
                    class="project-teams-manage-btn"
                >
                    <i class="bx bx-group"></i>
                    Manage Teams
                    <i class="bx bx-right-arrow-alt"></i>
                </a>

            </div>


            {{-- TEAM SUMMARY --}}

            <div class="project-teams-summary">

                <div class="project-teams-summary-left">

                    <div class="project-teams-summary-icon">
                        <i class="bx bx-group"></i>
                    </div>

                    <div class="project-teams-summary-info">

                        <strong>
                            {{ $project->groups->count() }} Project Teams
                        </strong>

                        <span>
                            Students have been assigned to teams for this project.
                        </span>

                    </div>

                </div>


                <div class="project-teams-count">

                    {{ $project->groups->sum(
                        fn($group) => $group->members->count()
                    ) }} Students

                </div>

            </div>


            {{-- TEAM GRID --}}

            @if($project->groups->isNotEmpty())

                <div class="project-teams-grid">

                @foreach($project->groups->sortBy('group_number') as $group)

                    <div class="project-team-card">

                        {{-- TEAM HEADER --}}

                        <div class="project-team-header">

                            <div class="project-team-title">

                                <div class="project-team-title-icon">
                                    <i class="bx bx-group"></i>
                                </div>

                                <strong>
                                    {{ $group->group_name }}
                                </strong>

                            </div>


                            <div class="project-team-member-count">

                                {{ $group->members->count() }}
                                {{ $group->members->count() === 1
                                    ? 'Member'
                                    : 'Members'
                                }}

                            </div>

                        </div>


                        {{-- MEMBERS --}}

                        <div class="project-team-members">

                            @forelse(
                                $group->members->sortBy(function ($member) {
                                    return match ($member->role) {
                                        'leader' => 1,
                                        'backup' => 2,
                                        default => 3,
                                    };
                                })
                                as $member
                            )

                                <div class="project-team-member">

                                    {{-- PROFILE IMAGE --}}

                                    <div class="project-team-avatar">

                                        @if(
                                            $member->user->profile_image
                                        )

                                            <img
                                                src="{{ asset(
                                                    'storage/' .
                                                    $member->user->profile_image
                                                ) }}"
                                                alt="{{ $member->user->name }}"
                                            >

                                        @else

                                            {{ strtoupper(
                                                substr(
                                                    $member->user->name,
                                                    0,
                                                    1
                                                )
                                            ) }}

                                        @endif

                                    </div>


                                    {{-- MEMBER INFORMATION --}}

                                    <div class="project-team-member-info">

                                        <strong>
                                            {{ $member->user->name }}
                                        </strong>

                                        <span>
                                            @if($member->role === 'leader')
                                                Team Leader
                                            @elseif($member->role === 'backup')
                                                Backup Submitter
                                            @else
                                                Team Member
                                            @endif
                                        </span>

                                    </div>


                                    {{-- ROLE BADGE --}}

                                    @if($member->role === 'leader')

                                        <span class="project-team-role leader">
                                            Leader
                                        </span>

                                    @elseif($member->role === 'backup')

                                        <span class="project-team-role backup">
                                            Backup
                                        </span>

                                    @else

                                        <span class="project-team-role member">
                                            Member
                                        </span>

                                    @endif

                                </div>

                            @empty

                                <div class="project-team-empty">

                                    <i class="bx bx-user-x"></i>

                                    <span>
                                        No students assigned to this team.
                                    </span>

                                </div>

                            @endforelse

                        </div>


                        {{-- TEAM FOOTER --}}

                        @php
                            $leader = $group->members
                                ->firstWhere('role', 'leader');
                        @endphp

                        <div class="project-team-footer">

                            <div class="project-team-leader">

                                <i class="bx bx-user-check"></i>

                                @if($leader)

                                    <span>
                                        Team Leader:
                                    </span>

                                    <strong>
                                        {{ $leader->user->name }}
                                    </strong>

                                @else

                                    <span>
                                        No team leader assigned
                                    </span>

                                @endif

                            </div>

                            <a
                                href="{{ route(
                                    'professor.classworks.projects.groups.show',
                                    [
                                        'classGroupId' => $classGroup->id,
                                        'projectId' => $project->id,
                                        'groupId' => $group->id,
                                    ]
                                ) }}"
                                class="project-team-view-btn"
                            >
                                View Team
                                <i class="bx bx-right-arrow-alt"></i>
                            </a>

                        </div>

                    </div>

                @endforeach

                </div>

            @else

                <div class="project-teams-empty">

                    <div class="project-teams-empty-icon">
                        <i class="bx bx-group"></i>
                    </div>

                    <strong>No teams created yet</strong>

                    <span>
                        Use Manage Teams to create teams and assign students
                        to this project.
                    </span>

                </div>

            @endif

    </div>

</section>

@endif


            {{-- ====================================================
                ATTACHED FILES
            ===================================================== --}}

            @if($project->resources->isNotEmpty())

            <section class="classwork-detail-card">

                <div class="classwork-detail-card-header">

                    <h2>
                        Attachments
                    </h2>

                </div>

                <div class="classwork-files">

                    @foreach($project->resources as $resource)

                    <div class="classwork-file">

                        {{-- FILE ICON --}}

                        <div class="classwork-file-icon">

                            <i class="bx bx-file"></i>

                        </div>


                        {{-- FILE INFORMATION --}}

                        <div class="classwork-file-info">

                            <strong>
                                {{ $resource->file_name ?? $resource->title }}
                            </strong>

                            <span>

                                {{ $resource->file_size
                                    ? number_format($resource->file_size / 1024, 1) . ' KB'
                                    : 'Project attachment'
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
                            onclick="openProjectFile(
                                this.dataset.fileUrl,
                                this.dataset.fileName
                            )"
                        >
                            <i class="bx bx-show"></i>

                            Open
                        </button>

                        @endif


                    </div>

                    @endforeach

                </div>

            </section>

            @endif


            {{-- ====================================================
                PROJECT SUBMISSIONS
            ===================================================== --}}

 @php
    $submittedSubmissions = $project->submissions
        ->whereNotNull('submitted_at')
        ->sortByDesc('submitted_at');

    $submissionCount = $submittedSubmissions->count();
@endphp

<section class="classwork-detail-card">

    <div class="classwork-detail-card-header">
        <h2>
            {{ $project->project_type === 'team'
                ? 'Team Submissions'
                : 'Student Submissions' }}
        </h2>
    </div>

    <div class="project-submissions-section">

        <div class="project-submissions-summary">

            <div class="project-submissions-summary-info">

                <div class="project-submissions-summary-icon">
                    <i class="bx bx-upload"></i>
                </div>

                <div class="project-submissions-summary-text">

                    <strong>
                        {{ $submissionCount }}
                        {{ $submissionCount === 1 ? 'Submission' : 'Submissions' }}
                    </strong>

                    <span>
                        {{ $project->project_type === 'team'
                            ? 'Teams that have submitted their project.'
                            : 'Students that have submitted their project.' }}
                    </span>

                </div>

            </div>

            <div class="project-submissions-count">
                {{ $submissionCount }} Submitted
            </div>

        </div>


        @if($submittedSubmissions->isNotEmpty())

            <div class="project-submission-list">

                @foreach($submittedSubmissions as $submission)

                    @php
                        $isTeamSubmission = $project->project_type === 'team';

                        $displayName = $isTeamSubmission
                            ? ($submission->projectGroup?->group_name ?? 'Team Submission')
                            : ($submission->student?->name ?? 'Student Submission');

                        $submitterName = $submission->student?->name ?? 'Unknown student';

                        $isGraded = $isTeamSubmission
                            ? $submission->grades
                                ->whereNotNull('score')
                                ->isNotEmpty()
                            : !is_null($submission->score);
                    @endphp

                    <div class="project-submission-item">

                        <div class="project-submission-icon">
                            <i class="bx {{ $isTeamSubmission ? 'bx-group' : 'bx-user' }}"></i>
                        </div>

                        <div class="project-submission-info">

                            <strong>
                                {{ $displayName }}
                            </strong>

                            <span>
                                Submitted by {{ $submitterName }}

                                @if($submission->submitted_at)
                                    • {{ $submission->submitted_at->format('M d, Y h:i A') }}
                                @endif
                            </span>

                        </div>

                        <span class="project-submission-status {{ $isGraded ? 'graded' : '' }}">

                            <i class="bx {{ $isGraded ? 'bx-check-circle' : 'bx-time-five' }}"></i>

                            {{ $isGraded ? 'Graded' : 'Needs Grade' }}

                        </span>

                        <a
                            href="{{ route(
                                'professor.classworks.projects.submissions.show',
                                [
                                    'classGroupId' => $classGroup->id,
                                    'projectId' => $project->id,
                                    'submissionId' => $submission->id,
                                ]
                            ) }}"
                            class="project-submission-view-btn"
                        >
                            <i class="bx bx-show"></i>
                            View Submission
                        </a>

                    </div>

                @endforeach

            </div>

        @else

            {{-- No submissions yet --}}
            <div class="project-submissions-empty">

                <div class="project-submissions-empty-icon">
                    <i class="bx bx-inbox"></i>
                </div>

                <div class="project-submissions-empty-content">
                    <strong>No submissions yet</strong>

                    <span>
                        {{ $project->project_type === 'team'
                            ? 'No teams have submitted their project yet.'
                            : 'No students have submitted their project yet.' }}
                    </span>
                </div>

            </div>

        @endif

    </div>

</section>

        </div>


        {{-- ========================================================
            SIDEBAR
        ========================================================= --}}

        <aside class="classwork-show-sidebar">


            {{-- ====================================================
                PROJECT INFORMATION
            ===================================================== --}}

            <section class="classwork-detail-card">

                <div class="classwork-detail-card-header">

                    <h2>
                        Project Details
                    </h2>

                </div>


                <div class="classwork-info-list">


                    {{-- PROJECT TYPE --}}

                    <div class="classwork-info-item project-type-info-item">

                        <i class="bx bx-group"></i>

                        <div>

                            <span>
                                Project Type
                            </span>

                            <strong>
                                {{ $project->project_type === 'team'
                                    ? 'Team'
                                    : 'Individual'
                                }}
                            </strong>

                        </div>

                    </div>


                    {{-- POINTS --}}

                    <div class="classwork-info-item">

                        <i class="bx bx-star"></i>

                        <div>

                            <span>
                                Points
                            </span>

                            <strong>
                                {{ $project->points ?? 0 }}
                            </strong>

                        </div>

                    </div>


                    {{-- DUE DATE --}}

                    @if($project->due_date)

                    <div class="classwork-info-item">

                        <i class="bx bx-calendar"></i>

                        <div>

                            <span>
                                Due Date
                            </span>

                            <strong>
                                {{ \Carbon\Carbon::parse(
                                    $project->due_date
                                )->format('M d, Y') }}
                            </strong>

                        </div>

                    </div>

                    @endif


                    {{-- DUE TIME --}}

                    @if($project->due_time)

                    <div class="classwork-info-item">

                        <i class="bx bx-time"></i>

                        <div>

                            <span>
                                Due Time
                            </span>

                            <strong>
                                {{ \Carbon\Carbon::parse(
                                    $project->due_time
                                )->format('h:i A') }}
                            </strong>

                        </div>

                    </div>

                    @endif

                </div>

            </section>


            {{-- ====================================================
                ACTIONS
            ===================================================== --}}

            <section class="classwork-detail-card">

                <div class="classwork-detail-card-header">

                    <h2>
                        Actions
                    </h2>

                </div>




                {{-- EDIT PROJECT --}}

                <a
                    href="{{ route(
                        'professor.classworks.projects.edit',
                        [
                            'classGroupId' => $classGroup->id,
                            'projectId' => $project->id,
                            'return_to' => 'show',
                            'origin' => $returnTo,
                        ]
                    ) }}"
                    class="classwork-action-btn"
                >
                    <i class="bx bx-edit"></i>

                    Edit Project
                </a>

            </section>

        </aside>

    </div>

</div>


{{-- ================================================================
    FILE VIEWER MODAL
================================================================= --}}

<div
    id="projectViewerModal"
    class="project-viewer-modal"
>

    <div class="project-viewer-container">


        {{-- ========================================================
            MODAL HEADER
        ========================================================= --}}

        <div class="project-viewer-header">

            <div class="project-viewer-title">

                <i class="bx bx-file"></i>

                <span id="projectViewerTitle">
                    Project Attachment
                </span>

            </div>


            <div class="project-viewer-actions">


                {{-- FULLSCREEN --}}

                <button
                    type="button"
                    class="project-viewer-btn"
                    onclick="toggleProjectFullscreen()"
                    title="Fullscreen"
                >
                    <i class="bx bx-fullscreen"></i>
                </button>


                {{-- CLOSE --}}

                <button
                    type="button"
                    class="project-viewer-btn close"
                    onclick="closeProjectModal()"
                    title="Close"
                >
                    <i class="bx bx-x"></i>
                </button>

            </div>

        </div>


        {{-- ========================================================
            FILE VIEWER
        ========================================================= --}}

        <div class="project-viewer-body">

            <iframe
                id="projectViewerFrame"
                src=""
                frameborder="0"
            ></iframe>

        </div>

    </div>

</div>


{{-- ================================================================
    MODAL JAVASCRIPT
================================================================= --}}

<script>

    /*
    |--------------------------------------------------------------------------
    | Open project file
    |--------------------------------------------------------------------------
    */

    function openProjectFile(fileUrl, fileName) {

        const modal =
            document.getElementById(
                'projectViewerModal'
            );

        const iframe =
            document.getElementById(
                'projectViewerFrame'
            );

        const title =
            document.getElementById(
                'projectViewerTitle'
            );


        if (!modal || !iframe) {

            console.error(
                'Project viewer modal or iframe not found.'
            );

            return;
        }


        /*
        |--------------------------------------------------------------------------
        | Set title
        |--------------------------------------------------------------------------
        */

        if (title) {

            title.textContent =
                fileName ||
                'Project Attachment';

        }


        /*
        |--------------------------------------------------------------------------
        | Load file
        |--------------------------------------------------------------------------
        */

        iframe.src = fileUrl;


        /*
        |--------------------------------------------------------------------------
        | Open modal
        |--------------------------------------------------------------------------
        */

        modal.classList.add('active');

        document.body.classList.add(
            'material-modal-open'
        );

    }


    /*
    |--------------------------------------------------------------------------
    | Close modal
    |--------------------------------------------------------------------------
    */

    function closeProjectModal() {

        const modal =
            document.getElementById(
                'projectViewerModal'
            );

        const iframe =
            document.getElementById(
                'projectViewerFrame'
            );


        if (!modal || !iframe) {

            return;

        }


        /*
        |--------------------------------------------------------------------------
        | Clear iframe
        |--------------------------------------------------------------------------
        */

        iframe.src = '';


        /*
        |--------------------------------------------------------------------------
        | Close modal
        |--------------------------------------------------------------------------
        */

        modal.classList.remove('active');

        document.body.classList.remove(
            'material-modal-open'
        );


        /*
        |--------------------------------------------------------------------------
        | Exit browser fullscreen if active
        |--------------------------------------------------------------------------
        */

        if (document.fullscreenElement) {

            document.exitFullscreen();

        }

    }


    /*
    |--------------------------------------------------------------------------
    | Toggle fullscreen
    |--------------------------------------------------------------------------
    */

    function toggleProjectFullscreen() {

        const container =
            document.querySelector(
                '#projectViewerModal .project-viewer-container'
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


    /*
    |--------------------------------------------------------------------------
    | Click outside viewer
    |--------------------------------------------------------------------------
    */

    const projectModal =
        document.getElementById(
            'projectViewerModal'
        );


    if (projectModal) {

        projectModal.addEventListener(
            'click',
            function(event) {

                if (
                    event.target ===
                    projectModal
                ) {

                    closeProjectModal();

                }

            }
        );

    }


    /*
    |--------------------------------------------------------------------------
    | ESC key
    |--------------------------------------------------------------------------
    */

    document.addEventListener(
        'keydown',
        function(event) {

            if (event.key !== 'Escape') {

                return;

            }


            const modal =
                document.getElementById(
                    'projectViewerModal'
                );


            if (!modal) {

                return;

            }


            /*
            | If browser fullscreen is active,
            | let the first ESC exit fullscreen.
            */

            if (document.fullscreenElement) {

                return;

            }


            if (
                modal.classList.contains(
                    'active'
                )
            ) {

                closeProjectModal();

            }

        }
    );

</script>

@endsection
