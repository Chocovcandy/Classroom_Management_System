<style>
/* ============================================================
   ASSIGNMENT SHOW PAGE
   Compact layout + fixed back button + consistent colours
   ============================================================ */

.classwork-show-page {
    --as-green:#16a34a;
    --as-green-dark:#15803d;
    --as-green-soft:#f0fdf4;
    --as-green-light:#dcfce7;
    --as-green-border:#bbf7d0;

    --as-blue:#2563eb;
    --as-blue-dark:#1d4ed8;
    --as-blue-soft:#eff6ff;
    --as-blue-border:#bfdbfe;

    --as-text:#0f172a;
    --as-text-2:#334155;
    --as-muted:#64748b;
    --as-light:#94a3b8;

    --as-border:#e2e8f0;
    --as-border-light:#edf2f7;
    --as-surface:#ffffff;
    --as-soft:#f8fafc;

    --as-warning:#d97706;
    --as-warning-soft:#fffbeb;

    --as-shadow:0 5px 20px rgba(15,23,42,.045);
    --as-small-shadow:0 2px 8px rgba(15,23,42,.045);
    --as-radius:17px;

    width:100%;
    max-width:1240px;
    margin:0 auto;
    padding:18px 24px 34px;
    color:var(--as-text);
}

.classwork-show-page *,
.classwork-show-page *::before,
.classwork-show-page *::after {
    box-sizing:border-box;
}

/* ============================================================
   HEADER
   ============================================================ */

.classwork-show-header {
    margin-bottom:17px;
}

/* FIX: back button is now a normal horizontal button.
   It will never wrap the text into two lines. */
.classwork-back-btn {
    width:auto !important;
    min-width:0;
    height:38px;
    display:inline-flex;
    align-items:center;
    justify-content:flex-start;
    gap:7px;
    margin:0 0 15px;
    padding:0 !important;
    border:0 !important;
    border-radius:9px;
    background:transparent !important;
    color:#64748b;
    text-decoration:none;
    box-shadow:none !important;
    font-size:13px;
    font-weight:700;
    line-height:1;
    white-space:nowrap;
    transition:color .18s ease, transform .18s ease;
}

.classwork-back-btn:hover {
    color:var(--as-blue);
    transform:translateX(-2px);
}

.classwork-back-btn i {
    flex:0 0 auto;
    font-size:20px;
}

/* Assignment heading */

.classwork-show-heading {
    display:flex;
    align-items:center;
    gap:13px;
    min-width:0;
}

.classwork-show-icon {
    width:52px;
    height:52px;
    flex:0 0 52px;
    display:inline-flex;
    align-items:center;
    justify-content:center;
    border:1px solid var(--as-green-border);
    border-radius:14px;
    background:var(--as-green-soft);
    color:var(--as-green);
    font-size:24px;
}

.classwork-show-type {
    display:block;
    margin:0 0 3px;
    color:var(--as-green-dark);
    font-size:10px;
    font-weight:800;
    letter-spacing:.13em;
    text-transform:uppercase;
}

.classwork-show-heading h1 {
    margin:0;
    color:var(--as-text);
    font-size:27px;
    line-height:1.12;
    font-weight:800;
    letter-spacing:-.025em;
    overflow-wrap:anywhere;
}

.classwork-show-topic {
    display:inline-flex;
    align-items:center;
    gap:5px;
    margin-top:5px;
    color:var(--as-muted);
    font-size:11px;
}

.classwork-show-topic i {
    color:var(--as-blue);
    font-size:14px;
}

/* ============================================================
   MAIN GRID
   ============================================================ */

.classwork-show-grid {
    display:grid;
    grid-template-columns:minmax(0,1fr) 300px;
    gap:18px;
    align-items:start;
}

.classwork-show-main {
    display:flex;
    flex-direction:column;
    gap:14px;
    min-width:0;
}

.classwork-show-sidebar {
    display:flex;
    flex-direction:column;
    gap:14px;
    position:sticky;
    top:14px;
}

/* ============================================================
   CARDS
   ============================================================ */

.classwork-detail-card {
    overflow:hidden;
    min-width:0;
    border:1px solid var(--as-border);
    border-radius:var(--as-radius);
    background:var(--as-surface);
    box-shadow:var(--as-shadow);
}

.classwork-detail-card-header {
    display:flex;
    align-items:center;
    justify-content:space-between;
    gap:10px;
    min-height:53px;
    padding:13px 20px;
    border-bottom:1px solid var(--as-border-light);
    background:var(--as-surface);
}

.classwork-detail-card-header h2 {
    margin:0;
    color:var(--as-text);
    font-size:14px;
    line-height:1.2;
    font-weight:800;
}

.classwork-detail-card-header h2::before {
    content:"";
    display:inline-block;
    width:4px;
    height:15px;
    margin-right:8px;
    vertical-align:-3px;
    border-radius:999px;
    background:var(--as-green);
}

/* ============================================================
   DESCRIPTION
   ============================================================ */

.classwork-description {
    min-height:76px;
    padding:17px 20px;
    color:var(--as-text-2);
    font-size:13px;
    line-height:1.65;
    overflow-wrap:anywhere;
}

.classwork-no-content {
    color:var(--as-muted);
    font-style:italic;
}

/* ============================================================
   GOOGLE FORM
   ============================================================ */

.assignment-form-section {
    padding:13px 20px 15px;
}

.assignment-form-box {
    display:flex;
    align-items:center;
    gap:11px;
    padding:11px;
    border:1px solid var(--as-blue-border);
    border-radius:11px;
    background:var(--as-blue-soft);
}

.assignment-form-icon {
    width:39px;
    height:39px;
    flex:0 0 39px;
    display:inline-flex;
    align-items:center;
    justify-content:center;
    border:1px solid var(--as-blue-border);
    border-radius:9px;
    background:#fff;
    color:var(--as-blue);
    box-shadow:var(--as-small-shadow);
    font-size:18px;
}

.assignment-form-info {
    min-width:0;
    flex:1;
    display:flex;
    flex-direction:column;
    gap:2px;
}

.assignment-form-info strong {
    color:var(--as-text-2);
    font-size:12px;
    font-weight:800;
}

.assignment-form-info span {
    color:var(--as-muted);
    font-size:10px;
    line-height:1.4;
}

.assignment-form-open {
    display:inline-flex;
    align-items:center;
    justify-content:center;
    gap:5px;
    min-height:35px;
    padding:0 11px;
    border:1px solid var(--as-blue);
    border-radius:8px;
    background:var(--as-blue);
    color:#fff;
    text-decoration:none;
    font-size:10px;
    font-weight:800;
    white-space:nowrap;
    transition:.18s ease;
}

.assignment-form-open:hover {
    border-color:var(--as-blue-dark);
    background:var(--as-blue-dark);
}

/* ============================================================
   ATTACHMENTS
   ============================================================ */

.classwork-files {
    display:flex;
    flex-direction:column;
    gap:7px;
    padding:12px 20px 14px;
}

.classwork-file {
    display:flex;
    align-items:center;
    gap:10px;
    min-width:0;
    padding:9px 10px;
    border:1px solid var(--as-border);
    border-radius:11px;
    background:var(--as-soft);
    transition:.18s ease;
}

.classwork-file:hover {
    border-color:var(--as-blue-border);
    background:var(--as-blue-soft);
}

.classwork-file-icon {
    width:38px;
    height:38px;
    flex:0 0 38px;
    display:inline-flex;
    align-items:center;
    justify-content:center;
    border:1px solid var(--as-green-border);
    border-radius:9px;
    background:var(--as-green-soft);
    color:var(--as-green);
    font-size:17px;
}

.classwork-file-info {
    min-width:0;
    flex:1;
    display:flex;
    flex-direction:column;
    gap:2px;
}

.classwork-file-info strong {
    display:block;
    overflow:hidden;
    color:var(--as-text-2);
    font-size:11px;
    font-weight:750;
    text-overflow:ellipsis;
    white-space:nowrap;
}

.classwork-file-info span {
    display:block;
    color:var(--as-light);
    font-size:9px;
}

.classwork-file-open {
    min-height:33px;
    display:inline-flex;
    align-items:center;
    justify-content:center;
    gap:5px;
    flex:0 0 auto;
    padding:0 10px;
    border:1px solid var(--as-blue-border);
    border-radius:8px;
    background:var(--as-surface);
    color:var(--as-blue);
    font-size:10px;
    font-weight:800;
    cursor:pointer;
    text-decoration:none;
    transition:.18s ease;
}

.classwork-file-open:hover {
    border-color:var(--as-blue);
    background:var(--as-blue-soft);
    color:var(--as-blue-dark);
}

.classwork-file-open i {
    font-size:15px;
}

.classwork-no-files,
.submission-placeholder {
    min-height:105px;
    display:flex;
    flex-direction:column;
    align-items:center;
    justify-content:center;
    margin:12px 20px 14px;
    padding:18px;
    border:1px dashed var(--as-border);
    border-radius:11px;
    background:var(--as-soft);
    text-align:center;
}

.classwork-no-files i,
.submission-placeholder i {
    margin-bottom:6px;
    color:var(--as-light);
    font-size:23px;
}

.classwork-no-files p,
.submission-placeholder p {
    margin:0;
    color:var(--as-muted);
    font-size:11px;
}

/* ============================================================
   STUDENT SUBMISSIONS
   ============================================================ */

.submission-summary {
    display:flex;
    align-items:center;
    gap:11px;
    margin:12px 20px 0;
    padding:10px 12px;
    border:1px solid var(--as-blue-border);
    border-radius:11px;
    background:var(--as-blue-soft);
}

.submission-summary-icon {
    width:39px;
    height:39px;
    flex:0 0 39px;
    display:inline-flex;
    align-items:center;
    justify-content:center;
    border-radius:9px;
    background:#fff;
    color:var(--as-blue);
    box-shadow:var(--as-small-shadow);
    font-size:19px;
}

.submission-summary > div:last-child {
    min-width:0;
    display:flex;
    flex-direction:column;
    gap:1px;
}

.submission-summary strong {
    color:var(--as-text);
    font-size:15px;
    font-weight:800;
}

.submission-summary span {
    color:var(--as-muted);
    font-size:10px;
}

.submission-list {
    display:flex;
    flex-direction:column;
    gap:6px;
    margin:10px 20px 14px;
}

.submission-item {
    display:flex;
    align-items:center;
    gap:9px;
    min-width:0;
    padding:8px 9px;
    border:1px solid var(--as-border);
    border-radius:10px;
    background:var(--as-soft);
    transition:.18s ease;
}

.submission-item:hover {
    border-color:var(--as-blue-border);
    background:var(--as-blue-soft);
}

.submission-student-icon {
    width:34px;
    height:34px;
    flex:0 0 34px;
    display:inline-flex;
    align-items:center;
    justify-content:center;
    border:1px solid var(--as-border);
    border-radius:50%;
    background:var(--as-surface);
    color:var(--as-muted);
    font-size:16px;
}

.submission-student-info {
    min-width:0;
    flex:1;
    display:flex;
    flex-direction:column;
    gap:2px;
}

.submission-student-info strong {
    overflow:hidden;
    color:var(--as-text-2);
    font-size:11px;
    font-weight:750;
    text-overflow:ellipsis;
    white-space:nowrap;
}

.submission-student-info span {
    color:var(--as-light);
    font-size:9px;
}

.submission-grade-status {
    display:inline-flex;
    align-items:center;
    gap:4px;
    flex:0 0 auto;
    padding:5px 7px;
    border-radius:7px;
    font-size:9px;
    font-weight:800;
    white-space:nowrap;
}

.submission-grade-status.graded {
    background:var(--as-green-soft);
    color:var(--as-green-dark);
}

.submission-grade-status.ungraded {
    background:var(--as-warning-soft);
    color:var(--as-warning);
}

.submission-grade-status i {
    font-size:13px;
}

.submission-grade-score {
    margin-left:1px;
    font-weight:800;
}

/* ============================================================
   STUDENT SUBMISSIONS
   ============================================================ */

.submission-summary {
    display:flex;
    align-items:center;
    gap:13px;
    margin:14px 20px 0;
    padding:13px 15px;
    border:1px solid var(--as-blue-border);
    border-radius:12px;
    background:var(--as-blue-soft);
}

.submission-summary-icon {
    width:42px;
    height:42px;
    flex:0 0 42px;
    display:inline-flex;
    align-items:center;
    justify-content:center;
    border:1px solid var(--as-blue-border);
    border-radius:10px;
    background:var(--as-surface);
    color:var(--as-blue);
    box-shadow:var(--as-small-shadow);
    font-size:20px;
}

.submission-summary > div:last-child {
    min-width:0;
    display:flex;
    flex-direction:column;
    gap:3px;
}

.submission-summary strong {
    color:var(--as-text);
    font-size:17px;
    line-height:1.1;
    font-weight:800;
}

.submission-summary span {
    color:var(--as-muted);
    font-size:11px;
    line-height:1.3;
}


/* ============================================================
   SUBMISSION LIST
   ============================================================ */

.submission-list {
    display:flex;
    flex-direction:column;
    gap:9px;
    margin:13px 20px 17px;
}


/* ============================================================
   SUBMISSION ITEM
   ============================================================ */

.submission-item {
    display:flex;
    align-items:center;
    gap:12px;
    min-width:0;
    padding:12px;
    border:1px solid var(--as-border);
    border-radius:12px;
    background:var(--as-soft);
    transition:
        border-color .18s ease,
        background .18s ease,
        box-shadow .18s ease,
        transform .18s ease;
}

.submission-item:hover {
    border-color:var(--as-blue-border);
    background:var(--as-blue-soft);
    box-shadow:var(--as-small-shadow);
    transform:translateY(-1px);
}


/* ============================================================
   STUDENT ICON
   ============================================================ */

.submission-student-icon {
    width:40px;
    height:40px;
    flex:0 0 40px;
    display:inline-flex;
    align-items:center;
    justify-content:center;
    border:1px solid var(--as-blue-border);
    border-radius:50%;
    background:var(--as-surface);
    color:var(--as-blue);
    font-size:18px;
}


/* ============================================================
   STUDENT INFORMATION
   ============================================================ */

.submission-student-info {
    min-width:0;
    flex:1;
    display:flex;
    flex-direction:column;
    gap:3px;
}

.submission-student-info strong {
    display:block;
    overflow:hidden;
    color:var(--as-text);
    font-size:13px;
    line-height:1.3;
    font-weight:800;
    text-overflow:ellipsis;
    white-space:nowrap;
}

.submission-student-info span {
    display:flex;
    align-items:center;
    gap:4px;
    color:var(--as-muted);
    font-size:10px;
    line-height:1.3;
}

.submission-student-info span::before {
    content:"";
    width:5px;
    height:5px;
    flex:0 0 5px;
    border-radius:50%;
    background:var(--as-blue);
}


/* ============================================================
   GRADE STATUS
   ============================================================ */

.submission-grade-status {
    display:inline-flex;
    align-items:center;
    justify-content:center;
    gap:5px;
    flex:0 0 auto;
    min-height:29px;
    padding:0 9px;
    border-radius:8px;
    font-size:10px;
    font-weight:800;
    white-space:nowrap;
}

.submission-grade-status.graded {
    border:1px solid var(--as-green-border);
    background:var(--as-green-soft);
    color:var(--as-green-dark);
}

.submission-grade-status.ungraded {
    border:1px solid #fde68a;
    background:var(--as-warning-soft);
    color:var(--as-warning);
}

.submission-grade-status i {
    font-size:14px;
}

.submission-grade-score {
    margin-left:2px;
    font-weight:800;
}


/* ============================================================
   VIEW SUBMISSION BUTTON
   ============================================================ */

.submission-view-btn {
    display:inline-flex;
    align-items:center;
    justify-content:center;
    gap:6px;
    flex:0 0 auto;
    min-height:35px;
    padding:0 12px;
    border:1px solid var(--as-blue);
    border-radius:8px;
    background:var(--as-blue);
    color:#fff;
    text-decoration:none;
    font-size:10px;
    font-weight:800;
    line-height:1;
    white-space:nowrap;
    transition:
        background .18s ease,
        border-color .18s ease,
        transform .18s ease,
        box-shadow .18s ease;
}

.submission-view-btn:hover {
    border-color:var(--as-blue-dark);
    background:var(--as-blue-dark);
    color:#fff;
    box-shadow:0 4px 12px rgba(37,99,235,.18);
    transform:translateY(-1px);
}

.submission-view-btn i {
    font-size:15px;
}


/* ============================================================
   EMPTY SUBMISSION STATE
   ============================================================ */

.submission-placeholder {
    min-height:125px;
    display:flex;
    flex-direction:column;
    align-items:center;
    justify-content:center;
    margin:14px 20px 17px;
    padding:20px;
    border:1px dashed var(--as-border);
    border-radius:12px;
    background:var(--as-soft);
    text-align:center;
}

.submission-placeholder i {
    margin-bottom:8px;
    color:var(--as-light);
    font-size:28px;
}

.submission-placeholder p {
    margin:0;
    color:var(--as-muted);
    font-size:11px;
    line-height:1.4;
}

/* ============================================================
   SIDEBAR
   ============================================================ */

.classwork-info-list {
    display:flex;
    flex-direction:column;
}

.classwork-info-item {
    display:flex;
    align-items:center;
    gap:10px;
    padding:12px 16px;
    border-bottom:1px solid var(--as-border-light);
}

.classwork-info-item:last-child {
    border-bottom:0;
}

.classwork-info-item > i {
    width:33px;
    height:33px;
    flex:0 0 33px;
    display:inline-flex;
    align-items:center;
    justify-content:center;
    border-radius:8px;
    background:var(--as-blue-soft);
    color:var(--as-blue);
    font-size:16px;
}

.classwork-info-item > div {
    min-width:0;
    display:flex;
    flex-direction:column;
    gap:1px;
}

.classwork-info-item span {
    color:var(--as-muted);
    font-size:9px;
}

.classwork-info-item strong {
    color:var(--as-text-2);
    font-size:12px;
    font-weight:800;
    overflow-wrap:anywhere;
}

/* ============================================================
   ACTIONS
   ============================================================ */

.classwork-action-btn {
    display:flex;
    align-items:center;
    justify-content:flex-start;
    gap:8px;
    min-height:40px;
    margin:12px 16px 15px;
    padding:0 12px;
    border:1px solid var(--as-green-border);
    border-radius:9px;
    background:var(--as-green-soft);
    color:var(--as-green-dark);
    text-decoration:none;
    font-size:11px;
    font-weight:800;
    transition:.18s ease;
}

.classwork-action-btn:hover {
    border-color:var(--as-green);
    background:var(--as-green-light);
}

.classwork-action-btn i {
    font-size:16px;
}

/* ============================================================
   FILE VIEWER
   ============================================================ */

.material-viewer-modal {
    position:fixed;
    inset:0;
    z-index:9999;
    display:flex;
    align-items:center;
    justify-content:center;
    padding:20px;
    background:rgba(2,6,23,.76);
    opacity:0;
    visibility:hidden;
    pointer-events:none;
    transition:opacity .2s ease, visibility .2s ease;
}

.material-viewer-modal.active {
    opacity:1;
    visibility:visible;
    pointer-events:auto;
}

.material-viewer-container {
    width:min(1200px,100%);
    height:min(850px,90vh);
    display:flex;
    flex-direction:column;
    overflow:hidden;
    border:1px solid var(--as-border);
    border-radius:14px;
    background:var(--as-surface);
    box-shadow:0 24px 70px rgba(0,0,0,.35);
}

.material-viewer-header {
    min-height:54px;
    display:flex;
    align-items:center;
    justify-content:space-between;
    gap:12px;
    padding:0 14px;
    border-bottom:1px solid var(--as-border);
    background:var(--as-surface);
}

.material-viewer-title {
    min-width:0;
    display:flex;
    align-items:center;
    gap:8px;
    color:var(--as-text-2);
    font-size:12px;
    font-weight:750;
}

.material-viewer-title i {
    color:var(--as-blue);
    font-size:18px;
}

.material-viewer-title span {
    overflow:hidden;
    text-overflow:ellipsis;
    white-space:nowrap;
}

.material-viewer-actions {
    display:flex;
    align-items:center;
    gap:5px;
}

.material-viewer-btn {
    width:34px;
    height:34px;
    display:inline-flex;
    align-items:center;
    justify-content:center;
    padding:0;
    border:1px solid var(--as-border);
    border-radius:8px;
    background:transparent;
    color:var(--as-muted);
    cursor:pointer;
    transition:.18s ease;
}

.material-viewer-btn:hover {
    border-color:var(--as-blue);
    background:var(--as-blue-soft);
    color:var(--as-text);
}

.material-viewer-btn.close:hover {
    border-color:#ef4444;
    color:#ef4444;
}

.material-viewer-btn i {
    font-size:18px;
}

.material-viewer-body {
    flex:1;
    min-height:0;
    background:#171717;
}

.material-viewer-body iframe {
    display:block;
    width:100%;
    height:100%;
    border:0;
    background:#fff;
}

.material-viewer-container:fullscreen {
    width:100vw;
    height:100vh;
    border:0;
    border-radius:0;
}

/* ============================================================
   FOCUS
   ============================================================ */

.classwork-show-page button:focus-visible,
.classwork-show-page a:focus-visible {
    outline:3px solid rgba(37,99,235,.16);
    outline-offset:2px;
}

.classwork-show-page a.submission-view-btn {
    all:unset !important;

    width:auto !important;
    min-width:0 !important;
    min-height:35px !important;
    height:35px !important;

    box-sizing:border-box !important;

    display:inline-flex !important;
    align-items:center !important;
    justify-content:center !important;
    gap:6px !important;

    flex:0 0 auto !important;

    padding:0 13px !important;
    margin:0 !important;

    border:1px solid var(--as-blue) !important;
    border-radius:8px !important;

    background:var(--as-surface) !important;
    color:var(--as-blue) !important;

    font-family:inherit !important;
    font-size:11px !important;
    font-weight:800 !important;
    line-height:1 !important;

    text-align:center !important;
    text-decoration:none !important;

    white-space:nowrap !important;
    cursor:pointer !important;

    box-shadow:none !important;

    transition:
        background .18s ease,
        border-color .18s ease,
        color .18s ease,
        transform .18s ease !important;
}


/* ICON */

.classwork-show-page a.submission-view-btn i {
    display:inline-flex !important;
    width:auto !important;
    height:auto !important;

    margin:0 !important;
    padding:0 !important;

    color:var(--as-blue) !important;
    font-size:15px !important;
    line-height:1 !important;
}


/* TEXT */

.classwork-show-page a.submission-view-btn span {
    display:inline !important;
    margin:0 !important;
    padding:0 !important;

    color:var(--as-blue) !important;
    font-size:11px !important;
    font-weight:800 !important;
}


/* HOVER */

.classwork-show-page a.submission-view-btn:hover {
    border-color:var(--as-blue-dark) !important;
    background:var(--as-blue-soft) !important;
    color:var(--as-blue-dark) !important;

    text-decoration:none !important;
    box-shadow:none !important;

    transform:translateY(-1px) !important;
}

.classwork-show-page a.submission-view-btn:hover i,
.classwork-show-page a.submission-view-btn:hover span {
    color:var(--as-blue-dark) !important;
}


/* VISITED / FOCUS */

.classwork-show-page a.submission-view-btn:visited,
.classwork-show-page a.submission-view-btn:focus,
.classwork-show-page a.submission-view-btn:active {
    color:var(--as-blue) !important;
    text-decoration:none !important;
}


/* MOBILE */

@media (max-width:700px) {
    .classwork-show-page a.submission-view-btn {
        width:100% !important;
    }
}

/* ============================================================
   DARK MODE
   ============================================================ */

.dark-mode .classwork-show-page {
    --as-green:#49d5a7;
    --as-green-dark:#62e0b5;
    --as-green-soft:rgba(73,213,167,.12);
    --as-green-light:rgba(73,213,167,.18);
    --as-green-border:rgba(73,213,167,.34);

    --as-blue:#6d76ff;
    --as-blue-dark:#8990ff;
    --as-blue-soft:rgba(109,118,255,.12);
    --as-blue-border:rgba(109,118,255,.34);

    --as-text:#f4f5ff;
    --as-text-2:#e6e8f7;
    --as-muted:#a1a4cc;
    --as-light:#9295bd;

    --as-border:#2b2e52;
    --as-border-light:#252847;
    --as-surface:#171933;
    --as-soft:#12142a;

    --as-warning:#f2c361;
    --as-warning-soft:rgba(242,195,97,.12);

    --as-shadow:0 7px 24px rgba(0,0,10,.25);
    --as-small-shadow:0 2px 8px rgba(0,0,10,.18);

    color:var(--as-text);
    color-scheme:dark;
}

.dark-mode .classwork-show-page .classwork-back-btn {
    color:var(--as-muted);
}

.dark-mode .classwork-show-page .classwork-back-btn:hover {
    color:var(--as-blue-dark);
}

.dark-mode .classwork-show-page .classwork-show-icon {
    border-color:var(--as-green-border);
    background:var(--as-green-soft);
    color:var(--as-green);
}

.dark-mode .classwork-show-page .classwork-show-type {
    color:var(--as-green-dark);
}

.dark-mode .classwork-show-page .classwork-show-heading h1,
.dark-mode .classwork-show-page .classwork-detail-card-header h2 {
    color:var(--as-text);
}

.dark-mode .classwork-show-page .classwork-show-topic {
    color:var(--as-muted);
}

.dark-mode .classwork-show-page .classwork-show-topic i {
    color:var(--as-blue);
}

.dark-mode .classwork-show-page .classwork-detail-card,
.dark-mode .classwork-show-page .classwork-detail-card-header {
    border-color:var(--as-border);
    background:var(--as-surface);
}

.dark-mode .classwork-show-page .classwork-description {
    color:var(--as-text-2);
}

.dark-mode .classwork-show-page .assignment-form-box {
    border-color:var(--as-blue-border);
    background:rgba(109,118,255,.07);
}

.dark-mode .classwork-show-page .assignment-form-icon {
    border-color:var(--as-blue-border);
    background:var(--as-surface);
    color:var(--as-blue);
}

.dark-mode .classwork-show-page .assignment-form-info strong {
    color:var(--as-text-2);
}

.dark-mode .classwork-show-page .assignment-form-info span {
    color:var(--as-muted);
}

.dark-mode .classwork-show-page .assignment-form-open {
    border-color:var(--as-blue);
    background:var(--as-blue);
    color:#fff;
}

.dark-mode .classwork-show-page .classwork-file {
    border-color:var(--as-border);
    background:var(--as-soft);
}

.dark-mode .classwork-show-page .classwork-file:hover {
    border-color:var(--as-blue-border);
    background:var(--as-blue-soft);
}

.dark-mode .classwork-show-page .classwork-file-icon {
    border-color:var(--as-green-border);
    background:var(--as-green-soft);
    color:var(--as-green);
}

.dark-mode .classwork-show-page .classwork-file-info strong {
    color:var(--as-text-2);
}

.dark-mode .classwork-show-page .classwork-file-info span {
    color:var(--as-light);
}

.dark-mode .classwork-show-page .classwork-file-open {
    border-color:var(--as-blue-border);
    background:var(--as-surface);
    color:var(--as-blue-dark);
}

.dark-mode .classwork-show-page .classwork-no-files,
.dark-mode .classwork-show-page .submission-placeholder {
    border-color:#3a3e68;
    background:var(--as-soft);
}

.dark-mode .classwork-show-page .submission-summary {
    border-color:var(--as-blue-border);
    background:rgba(109,118,255,.08);
}

.dark-mode .classwork-show-page .submission-summary-icon {
    background:var(--as-surface);
    color:var(--as-blue);
}

.dark-mode .classwork-show-page .submission-summary strong {
    color:var(--as-text);
}

.dark-mode .classwork-show-page .submission-item {
    border-color:var(--as-border);
    background:var(--as-soft);
}

.dark-mode .classwork-show-page .submission-item:hover {
    border-color:var(--as-blue-border);
    background:var(--as-blue-soft);
}

.dark-mode .classwork-show-page .submission-student-icon {
    border-color:var(--as-border);
    background:var(--as-surface);
    color:var(--as-muted);
}

.dark-mode .classwork-show-page .submission-student-info strong {
    color:var(--as-text-2);
}

.dark-mode .classwork-show-page .submission-student-info span {
    color:var(--as-light);
}

.dark-mode .classwork-show-page .submission-grade-status.graded {
    background:rgba(73,213,167,.12);
    color:var(--as-green-dark);
}

.dark-mode .classwork-show-page .submission-grade-status.ungraded {
    background:var(--as-warning-soft);
    color:var(--as-warning);
}

.dark-mode .classwork-show-page .submission-view-btn {
    border-color:var(--as-blue-border);
    background:var(--as-surface);
    color:var(--as-blue-dark);
}

.dark-mode .classwork-show-page .classwork-info-item {
    border-color:var(--as-border-light);
}

.dark-mode .classwork-show-page .classwork-info-item > i {
    background:var(--as-blue-soft);
    color:var(--as-blue);
}

.dark-mode .classwork-show-page .classwork-info-item span {
    color:var(--as-muted);
}

.dark-mode .classwork-show-page .classwork-info-item strong {
    color:var(--as-text-2);
}

.dark-mode .classwork-show-page .classwork-action-btn {
    border-color:var(--as-green-border);
    background:var(--as-green-soft);
    color:var(--as-green-dark);
}

.dark-mode .classwork-show-page .material-viewer-container,
.dark-mode .classwork-show-page .material-viewer-header {
    border-color:var(--as-border);
    background:var(--as-surface);
}

.dark-mode .classwork-show-page .material-viewer-title {
    color:var(--as-text-2);
}

.dark-mode .classwork-show-page .material-viewer-btn {
    border-color:var(--as-border);
    color:var(--as-muted);
}

/* ============================================================
   RESPONSIVE
   ============================================================ */

@media (max-width:1000px) {
    .classwork-show-grid {
        grid-template-columns:minmax(0,1fr) 275px;
        gap:15px;
    }
}

@media (max-width:900px) {
    .classwork-show-grid {
        grid-template-columns:1fr;
    }

    .classwork-show-sidebar {
        position:static;
    }
}

@media (max-width:700px) {
    .classwork-show-page {
        padding:18px 16px 30px;
    }

    .classwork-show-heading {
        gap:11px;
    }

    .classwork-show-icon {
        width:48px;
        height:48px;
        flex-basis:48px;
        border-radius:12px;
        font-size:22px;
    }

    .classwork-show-heading h1 {
        font-size:23px;
    }

    .classwork-detail-card-header {
        min-height:50px;
        padding:13px 17px;
    }

    .classwork-description {
        padding:16px 17px;
    }

    .assignment-form-section {
        padding:12px 17px 14px;
    }

    .assignment-form-box {
        align-items:flex-start;
        flex-wrap:wrap;
    }

    .assignment-form-open {
        width:100%;
    }

    .submission-summary {
        margin-left:17px;
        margin-right:17px;
    }

    .submission-list {
        margin-left:17px;
        margin-right:17px;
    }

    .submission-item {
        align-items:flex-start;
        flex-wrap:wrap;
    }

    .submission-grade-status {
        margin-left:auto;
    }

    .submission-view-btn {
        width:100%;
    }

    .classwork-file {
        align-items:flex-start;
        flex-wrap:wrap;
    }

    .classwork-file-open {
        width:100%;
    }
}

@media (max-width:480px) {
    .classwork-show-page {
        padding:15px 13px 25px;
    }

    .classwork-back-btn {
        height:36px;
        margin-bottom:12px;
        font-size:12px;
    }

    .classwork-show-icon {
        width:44px;
        height:44px;
        flex-basis:44px;
        font-size:20px;
    }

    .classwork-show-heading h1 {
        font-size:20px;
    }
}

/* ============================================================
   STUDENT SUBMISSION — STUDENT-ONLY COMPONENTS
   Uses the same compact visual system as the professor page.
   ============================================================ */

.student-submission-card {
    overflow:hidden;
}

.student-submission-status {
    display:flex;
    align-items:center;
    gap:11px;
    margin:12px 20px 0;
    padding:11px 13px;
    border:1px solid var(--as-green-border);
    border-radius:11px;
    background:var(--as-green-soft);
}

.student-submission-status-icon {
    width:39px;
    height:39px;
    flex:0 0 39px;
    display:inline-flex;
    align-items:center;
    justify-content:center;
    border-radius:9px;
    background:#fff;
    color:var(--as-green);
    box-shadow:var(--as-small-shadow);
    font-size:19px;
}

.student-submission-status-content {
    min-width:0;
    display:flex;
    flex-direction:column;
    gap:2px;
}

.student-submission-status-content strong {
    color:var(--as-text);
    font-size:14px;
    line-height:1.2;
    font-weight:800;
}

.student-submission-status-content span {
    color:var(--as-muted);
    font-size:10px;
    line-height:1.35;
}

.student-submission-files {
    margin:12px 20px 0;
}

.student-submission-files-title {
    display:flex;
    align-items:center;
    gap:6px;
    margin-bottom:7px;
    color:var(--as-text-2);
    font-size:11px;
    font-weight:800;
}

.student-submission-files-title i {
    color:var(--as-green);
    font-size:15px;
}

.student-submission-file-list {
    display:flex;
    flex-direction:column;
    gap:7px;
}

.student-submission-file {
    display:flex;
    align-items:center;
    gap:10px;
    min-width:0;
    padding:9px 10px;
    border:1px solid var(--as-border);
    border-radius:10px;
    background:var(--as-soft);
    transition:.18s ease;
}

.student-submission-file:hover {
    border-color:var(--as-blue-border);
    background:var(--as-blue-soft);
}

.student-submission-file-icon {
    width:36px;
    height:36px;
    flex:0 0 36px;
    display:inline-flex;
    align-items:center;
    justify-content:center;
    border:1px solid var(--as-green-border);
    border-radius:9px;
    background:var(--as-green-soft);
    color:var(--as-green);
    font-size:17px;
}

.student-submission-file-info {
    min-width:0;
    flex:1;
    display:flex;
    flex-direction:column;
    gap:2px;
}

.student-submission-file-info strong {
    display:block;
    overflow:hidden;
    color:var(--as-text-2);
    font-size:11px;
    font-weight:750;
    text-overflow:ellipsis;
    white-space:nowrap;
}

.student-submission-file-info span {
    color:var(--as-light);
    font-size:9px;
}

.submission-result {
    margin:12px 20px 0;
    padding:11px 13px;
    border:1px solid var(--as-green-border);
    border-radius:11px;
    background:var(--as-green-soft);
}

.submission-result-item {
    display:flex;
    align-items:flex-start;
    gap:9px;
    padding:8px 0;
}

.submission-result-item:first-child {
    padding-top:0;
}

.submission-result-item:last-child {
    padding-bottom:0;
}

.submission-result-item + .submission-result-item {
    border-top:1px solid var(--as-green-border);
}

.submission-result-item > i {
    margin-top:1px;
    color:var(--as-green);
    font-size:16px;
}

.submission-result-item > div {
    min-width:0;
    display:flex;
    flex-direction:column;
    gap:2px;
}

.submission-result-item span {
    color:var(--as-muted);
    font-size:9px;
    font-weight:700;
}

.submission-result-item strong {
    color:var(--as-text);
    font-size:12px;
    font-weight:800;
}

.submission-feedback {
    color:var(--as-text-2);
    font-size:11px;
    line-height:1.55;
    overflow-wrap:anywhere;
}

.student-submission-actions {
    display:flex;
    align-items:center;
    justify-content:flex-end;
    gap:8px;
    margin:12px 20px 15px;
}

.student-submission-actions form {
    margin:0;
}

.student-submission-cancel-btn,
.student-submission-submit-btn,
.student-submission-browse-btn {
    min-height:37px;
    display:inline-flex;
    align-items:center;
    justify-content:center;
    gap:6px;
    padding:0 12px;
    border-radius:8px;
    font-size:10px;
    font-weight:800;
    line-height:1;
    cursor:pointer;
    transition:.18s ease;
}

.student-submission-cancel-btn {
    border:1px solid #fecaca;
    background:#fff;
    color:#dc2626;
}

.student-submission-cancel-btn:hover {
    border-color:#ef4444;
    background:#fef2f2;
}

.student-submission-submit-btn {
    min-height:40px;
    padding:0 15px;
    border:1px solid var(--as-green);
    background:var(--as-green);
    color:#fff;
    box-shadow:0 3px 10px rgba(22,163,74,.12);
}

.student-submission-submit-btn:hover:not(:disabled) {
    border-color:var(--as-green-dark);
    background:var(--as-green-dark);
    transform:translateY(-1px);
}

.student-submission-submit-btn:disabled {
    opacity:.45;
    cursor:not-allowed;
    box-shadow:none;
}

.student-submission-submit-btn i,
.student-submission-cancel-btn i,
.student-submission-browse-btn i {
    font-size:15px;
}

.student-submission-upload {
    display:flex;
    align-items:center;
    gap:11px;
    margin:12px 20px 0;
    padding:12px;
    border:1px dashed var(--as-green-border);
    border-radius:11px;
    background:var(--as-green-soft);
    cursor:pointer;
    transition:.18s ease;
}

.student-submission-upload:hover {
    border-color:var(--as-green);
    background:var(--as-green-light);
}

.student-submission-upload-icon {
    width:40px;
    height:40px;
    flex:0 0 40px;
    display:inline-flex;
    align-items:center;
    justify-content:center;
    border:1px solid var(--as-green-border);
    border-radius:9px;
    background:#fff;
    color:var(--as-green);
    font-size:20px;
}

.student-submission-upload-content {
    min-width:0;
    flex:1;
    display:flex;
    flex-direction:column;
    gap:2px;
}

.student-submission-upload-content strong {
    color:var(--as-text-2);
    font-size:12px;
    font-weight:800;
}

.student-submission-upload-content span {
    color:var(--as-muted);
    font-size:9px;
}

.student-submission-browse-btn {
    flex:0 0 auto;
    border:1px solid var(--as-blue);
    background:#fff;
    color:var(--as-blue);
}

.student-submission-browse-btn:hover {
    border-color:var(--as-blue-dark);
    background:var(--as-blue-soft);
    color:var(--as-blue-dark);
}

.student-submission-selected {
    margin:10px 20px 0;
    padding:10px;
    border:1px solid var(--as-border);
    border-radius:11px;
    background:var(--as-soft);
}

.student-submission-selected-header {
    display:flex;
    align-items:center;
    justify-content:space-between;
    gap:10px;
    margin-bottom:7px;
    color:var(--as-text-2);
    font-size:10px;
    font-weight:800;
}

.student-submission-selected-header span:last-child {
    color:var(--as-muted);
    font-weight:700;
}

.student-submission-selected-list {
    display:flex;
    flex-direction:column;
    gap:6px;
}

.student-submission-selected-file {
    display:flex;
    align-items:center;
    gap:8px;
    min-width:0;
    padding:7px 8px;
    border:1px solid var(--as-border);
    border-radius:8px;
    background:#fff;
}

.student-submission-selected-file-icon {
    width:30px;
    height:30px;
    flex:0 0 30px;
    display:inline-flex;
    align-items:center;
    justify-content:center;
    border-radius:7px;
    background:var(--as-green-soft);
    color:var(--as-green);
    font-size:14px;
}

.student-submission-selected-file-name {
    min-width:0;
    flex:1;
    overflow:hidden;
    color:var(--as-text-2);
    font-size:10px;
    font-weight:700;
    text-overflow:ellipsis;
    white-space:nowrap;
}

.student-submission-remove-file {
    width:28px;
    height:28px;
    flex:0 0 28px;
    display:inline-flex;
    align-items:center;
    justify-content:center;
    border:1px solid #fecaca;
    border-radius:7px;
    background:#fff;
    color:#dc2626;
    cursor:pointer;
    transition:.18s ease;
}

.student-submission-remove-file:hover {
    border-color:#ef4444;
    background:#fef2f2;
}

.student-submission-remove-file i {
    font-size:15px;
}

/* Keep file/form actions blue outlined, as requested. */
.classwork-file-open {
    border-color:var(--as-blue-border);
    background:var(--as-surface);
    color:var(--as-blue);
}

.classwork-file-open:hover {
    border-color:var(--as-blue);
    background:var(--as-blue-soft);
    color:var(--as-blue-dark);
}

/* ============================================================
   RESPONSIVE STUDENT SUBMISSION
   ============================================================ */

@media (max-width:900px) {
    .classwork-show-grid {
        grid-template-columns:1fr;
    }

    .classwork-show-sidebar {
        position:static;
    }
}

@media (max-width:600px) {
    .classwork-show-page {
        padding:15px 12px 25px;
    }

    .classwork-show-heading h1 {
        font-size:23px;
    }

    .classwork-show-grid {
        gap:12px;
    }

    .classwork-detail-card-header {
        padding:12px 15px;
    }

    .classwork-description {
        padding:15px;
        font-size:12px;
    }

    .classwork-files {
        padding:10px 15px 12px;
    }

    .classwork-file {
        align-items:flex-start;
        flex-wrap:wrap;
    }

    .classwork-file-info {
        min-width:calc(100% - 48px);
    }

    .classwork-file-open {
        margin-left:48px;
    }

    .student-submission-upload {
        align-items:flex-start;
        flex-wrap:wrap;
        margin-left:15px;
        margin-right:15px;
    }

    .student-submission-upload-content {
        width:calc(100% - 52px);
    }

    .student-submission-browse-btn {
        width:100%;
        margin-left:0;
    }

    .student-submission-actions {
        margin-left:15px;
        margin-right:15px;
    }

    .student-submission-actions form,
    .student-submission-submit-btn {
        width:100%;
    }

    .student-submission-actions form .student-submission-cancel-btn {
        width:100%;
    }

    .student-submission-files,
    .submission-result,
    .student-submission-selected {
        margin-left:15px;
        margin-right:15px;
    }
}

@media (max-width:420px) {
    .classwork-show-heading {
        align-items:flex-start;
    }

    .classwork-show-icon {
        width:46px;
        height:46px;
        flex-basis:46px;
        font-size:21px;
    }

    .classwork-show-heading h1 {
        font-size:20px;
    }

    .classwork-show-type {
        font-size:9px;
    }

    .classwork-back-btn {
        font-size:11px;
    }
}

</style>

<style>
/* ============================================================
   MORE NOTICEABLE SIZE INCREASE
   Same design/colors — text and cards are clearly bigger.
   ============================================================ */

.classwork-show-page {
    max-width: 1300px;
    padding: 22px 28px 42px;
}

.classwork-show-header {
    margin-bottom: 20px;
}

.classwork-back-btn {
    height: 40px;
    margin-bottom: 17px;
    font-size: 14px;
}

.classwork-back-btn i {
    font-size: 21px;
}

.classwork-show-heading {
    gap: 16px;
}

.classwork-show-icon {
    width: 60px;
    height: 60px;
    flex-basis: 60px;
    border-radius: 15px;
    font-size: 28px;
}

.classwork-show-type {
    margin-bottom: 4px;
    font-size: 11px;
}

.classwork-show-heading h1 {
    font-size: 31px;
    line-height: 1.18;
}

.classwork-show-topic {
    margin-top: 7px;
    font-size: 13px;
}

.classwork-show-topic i {
    font-size: 16px;
}

.classwork-show-grid {
    grid-template-columns: minmax(0, 1fr) 330px;
    gap: 22px;
}

.classwork-show-main,
.classwork-show-sidebar {
    gap: 18px;
}

.classwork-detail-card {
    border-radius: 19px;
}

.classwork-detail-card-header {
    min-height: 61px;
    padding: 15px 22px;
}

.classwork-detail-card-header h2 {
    font-size: 16px;
}

.classwork-detail-card-header h2::before {
    width: 4px;
    height: 17px;
    margin-right: 9px;
}

.classwork-description {
    min-height: 90px;
    padding: 20px 22px;
    font-size: 14.5px;
    line-height: 1.75;
}

.classwork-files {
    gap: 9px;
    padding: 15px 22px 18px;
}

.classwork-file {
    gap: 12px;
    padding: 12px;
    border-radius: 13px;
}

.classwork-file-icon {
    width: 43px;
    height: 43px;
    flex-basis: 43px;
    border-radius: 10px;
    font-size: 19px;
}

.classwork-file-info {
    gap: 3px;
}

.classwork-file-info strong {
    font-size: 13px;
}

.classwork-file-info span {
    font-size: 10.5px;
}

.classwork-file-open {
    min-height: 38px;
    padding: 0 13px;
    border-radius: 9px;
    font-size: 11.5px;
}

.classwork-file-open i {
    font-size: 17px;
}

.assignment-form-section {
    padding: 15px 22px 18px;
}

.assignment-form-box {
    gap: 13px;
    padding: 13px;
    border-radius: 13px;
}

.assignment-form-icon {
    width: 44px;
    height: 44px;
    flex-basis: 44px;
    border-radius: 10px;
    font-size: 20px;
}

.assignment-form-info strong {
    font-size: 14px;
}

.assignment-form-info span {
    font-size: 11px;
}

.assignment-form-open {
    min-height: 39px;
    padding: 0 14px;
    border-radius: 9px;
    font-size: 11.5px;
}

.attachment-count {
    min-height: 30px;
    padding: 5px 11px;
    font-size: 12px;
}

.student-submission-status {
    gap: 13px;
    margin: 14px 22px 0;
    padding: 13px 15px;
    border-radius: 13px;
}

.student-submission-status-icon {
    width: 44px;
    height: 44px;
    flex-basis: 44px;
    border-radius: 10px;
    font-size: 21px;
}

.student-submission-status-content {
    gap: 3px;
}

.student-submission-status-content strong {
    font-size: 16px;
}

.student-submission-status-content span {
    font-size: 11px;
}

.student-submission-files {
    margin: 14px 22px 0;
}

.student-submission-files-title {
    gap: 7px;
    margin-bottom: 8px;
    font-size: 13px;
}

.student-submission-files-title i {
    font-size: 16px;
}

.student-submission-file-list {
    gap: 8px;
}

.student-submission-file {
    gap: 12px;
    padding: 11px 12px;
    border-radius: 12px;
}

.student-submission-file-icon {
    width: 40px;
    height: 40px;
    flex-basis: 40px;
    font-size: 19px;
}

.student-submission-file-info {
    gap: 3px;
}

.student-submission-file-info strong {
    font-size: 13px;
}

.student-submission-file-info span {
    font-size: 10.5px;
}

.submission-result {
    margin: 14px 22px 0;
    padding: 13px 15px;
    border-radius: 13px;
}

.submission-result-item {
    gap: 11px;
    padding: 10px 0;
}

.submission-result-item > i {
    font-size: 18px;
}

.submission-result-item span {
    font-size: 10.5px;
}

.submission-result-item strong {
    font-size: 13.5px;
}

.submission-feedback {
    font-size: 12.5px;
    line-height: 1.6;
}

.student-submission-upload {
    gap: 13px;
    margin: 14px 22px 0;
    padding: 14px;
    border-radius: 13px;
}

.student-submission-upload-icon {
    width: 45px;
    height: 45px;
    flex-basis: 45px;
    border-radius: 10px;
    font-size: 22px;
}

.student-submission-upload-content {
    gap: 3px;
}

.student-submission-upload-content strong {
    font-size: 14px;
}

.student-submission-upload-content span {
    font-size: 10.5px;
}

.student-submission-browse-btn {
    min-height: 40px;
    padding: 0 14px;
    border-radius: 9px;
    font-size: 11.5px;
}

.student-submission-selected {
    margin: 12px 22px 0;
    padding: 12px;
    border-radius: 12px;
}

.student-submission-selected-header {
    margin-bottom: 8px;
    font-size: 11.5px;
}

.student-submission-selected-file {
    gap: 9px;
    padding: 9px 10px;
    border-radius: 9px;
}

.student-submission-selected-file-icon {
    width: 32px;
    height: 32px;
    flex-basis: 32px;
    font-size: 15px;
}

.student-submission-selected-file-name {
    font-size: 11.5px;
}

.student-submission-remove-file {
    width: 30px;
    height: 30px;
    flex-basis: 30px;
}

.student-submission-actions {
    gap: 10px;
    margin: 14px 22px 17px;
}

.student-submission-cancel-btn,
.student-submission-submit-btn,
.student-submission-browse-btn {
    min-height: 41px;
    padding: 0 14px;
    font-size: 11.5px;
}

.student-submission-submit-btn {
    min-height: 43px;
}

.classwork-info-item {
    gap: 12px;
    padding: 14px 18px;
}

.classwork-info-item > i {
    width: 37px;
    height: 37px;
    flex-basis: 37px;
    border-radius: 9px;
    font-size: 18px;
}

.classwork-info-item > div {
    gap: 2px;
}

.classwork-info-item span {
    font-size: 10.5px;
}

.classwork-info-item strong {
    font-size: 13.5px;
}

@media (max-width: 900px) {
    .classwork-show-page {
        max-width: 100%;
        padding: 20px 22px 36px;
    }

    .classwork-show-grid {
        grid-template-columns: 1fr;
    }
}

@media (max-width: 600px) {
    .classwork-show-page {
        padding: 16px 13px 28px;
    }

    .classwork-show-heading h1 {
        font-size: 24px;
    }

    .classwork-show-icon {
        width: 50px;
        height: 50px;
        flex-basis: 50px;
        font-size: 23px;
    }

    .classwork-detail-card-header {
        min-height: 57px;
        padding: 13px 16px;
    }

    .classwork-description {
        padding: 17px 16px;
        font-size: 13px;
    }

    .classwork-files {
        padding-left: 16px;
        padding-right: 16px;
    }

    .student-submission-status,
    .student-submission-files,
    .submission-result,
    .student-submission-selected {
        margin-left: 16px;
        margin-right: 16px;
    }

    .student-submission-upload {
        margin-left: 16px;
        margin-right: 16px;
    }

    .student-submission-actions {
        margin-left: 16px;
        margin-right: 16px;
    }
}
</style>

<style>
/* Slight size increase — same design */
.classwork-show-page{max-width:1260px;padding:20px 26px 38px}
.classwork-show-grid{grid-template-columns:minmax(0,1fr) 315px;gap:20px}
.classwork-show-main,.classwork-show-sidebar{gap:16px}
.classwork-show-icon{width:56px;height:56px;flex-basis:56px;font-size:26px}
.classwork-show-heading h1{font-size:29px}
.classwork-show-type{font-size:10.5px}
.classwork-show-topic{font-size:12px}
.classwork-detail-card{border-radius:18px}
.classwork-detail-card-header{min-height:57px;padding:14px 21px}
.classwork-detail-card-header h2{font-size:15px}
.classwork-description{min-height:82px;padding:18px 21px;font-size:13.5px;line-height:1.7}
.classwork-files{gap:8px;padding:13px 21px 16px}
.classwork-file{gap:11px;padding:10px 11px;border-radius:12px}
.classwork-file-icon{width:40px;height:40px;flex-basis:40px;font-size:18px}
.classwork-file-info strong{font-size:12px}.classwork-file-info span{font-size:10px}
.classwork-file-open{min-height:35px;padding:0 11px;font-size:11px}.classwork-file-open i{font-size:16px}
.assignment-form-section{padding:14px 21px 16px}.assignment-form-box{gap:12px;padding:12px;border-radius:12px}
.assignment-form-icon{width:41px;height:41px;flex-basis:41px;font-size:19px}.assignment-form-info strong{font-size:13px}.assignment-form-info span{font-size:10.5px}.assignment-form-open{min-height:37px;padding:0 12px;font-size:11px}
.student-submission-status{gap:12px;margin:13px 21px 0;padding:12px 14px;border-radius:12px}.student-submission-status-icon{width:41px;height:41px;flex-basis:41px;font-size:20px}.student-submission-status-content strong{font-size:15px}.student-submission-status-content span{font-size:10.5px}
.student-submission-files{margin:13px 21px 0}.student-submission-files-title{font-size:12px}.student-submission-file{gap:11px;padding:10px 11px;border-radius:11px}.student-submission-file-icon{width:38px;height:38px;flex-basis:38px;font-size:18px}.student-submission-file-info strong{font-size:12px}.student-submission-file-info span{font-size:10px}
.submission-result{margin:13px 21px 0;padding:12px 14px;border-radius:12px}.submission-result-item{gap:10px;padding:9px 0}.submission-result-item>i{font-size:17px}.submission-result-item span{font-size:10px}.submission-result-item strong{font-size:13px}.submission-feedback{font-size:12px}
.student-submission-upload{gap:12px;margin:13px 21px 0;padding:13px;border-radius:12px}.student-submission-upload-icon{width:42px;height:42px;flex-basis:42px;font-size:21px}.student-submission-upload-content strong{font-size:13px}.student-submission-upload-content span{font-size:10px}.student-submission-browse-btn{min-height:38px;padding:0 13px;font-size:11px}
.student-submission-selected{margin:11px 21px 0;padding:11px}.student-submission-selected-header{font-size:11px}.student-submission-selected-file{padding:8px 9px}.student-submission-selected-file-name{font-size:11px}
.student-submission-actions{gap:9px;margin:13px 21px 16px}.student-submission-cancel-btn,.student-submission-submit-btn,.student-submission-browse-btn{min-height:39px;padding:0 13px;font-size:11px}
.classwork-info-item{gap:11px;padding:13px 17px}.classwork-info-item>i{width:35px;height:35px;flex-basis:35px;font-size:17px}.classwork-info-item span{font-size:10px}.classwork-info-item strong{font-size:13px}.attachment-count{min-height:28px;padding:4px 10px;font-size:11px}
@media(max-width:900px){.classwork-show-page{max-width:100%;padding:18px 20px 32px}.classwork-show-grid{grid-template-columns:1fr}}
@media(max-width:600px){.classwork-show-page{padding:15px 12px 25px}.classwork-show-heading h1{font-size:23px}.classwork-show-icon{width:48px;height:48px;flex-basis:48px;font-size:22px}.classwork-detail-card-header{padding:13px 15px}.classwork-description{padding:16px 15px;font-size:12.5px}}
</style>


@extends('layouts.student_layout')

@section('title', 'Assignment')

@section('content')

@php

    $submission = $submission ?? null;
@endphp

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

            @if($assignment->resources && $assignment->resources->isNotEmpty())

            <section class="classwork-detail-card">

                <div class="classwork-detail-card-header">

                    <h2>
                        Attachments
                    </h2>

                    <span class="attachment-count">
                        {{ $assignment->resources->count() }}
                        {{ $assignment->resources->count() === 1 ? 'file' : 'files' }}
                    </span>

                </div>

                <div class="classwork-files">

                    @foreach($assignment->resources as $resource)

                    <div class="classwork-file">

                        <div class="classwork-file-icon assignment">
                            <i class="bx bx-file"></i>
                        </div>

                        <div class="classwork-file-info">

                            <strong>
                                {{ $resource->file_name ?? $resource->title }}
                            </strong>

                            <span>
                                {{ $resource->file_size
                                    ? number_format($resource->file_size / 1024, 1) . ' KB'
                                    : 'Assignment attachment'
                                }}
                            </span>

                        </div>

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

            </section>

            @endif



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

<style>
/* =========================================================
   EXTRA SIZE BOOST — Student Assignment Page
   ========================================================= */

.classwork-show-page {
    max-width: 1380px;
    padding: 28px 34px 48px;
}

.classwork-show-page .classwork-back-btn {
    min-height: 44px;
    padding: 10px 16px;
    font-size: 14px;
    border-radius: 11px;
}

.classwork-show-page .classwork-heading {
    gap: 18px;
    margin-bottom: 28px;
}

.classwork-show-page .classwork-heading-icon {
    width: 68px;
    height: 68px;
    border-radius: 17px;
}

.classwork-show-page .classwork-heading-icon i {
    font-size: 29px;
}

.classwork-show-page .classwork-heading h1 {
    font-size: 35px;
    line-height: 1.2;
    letter-spacing: -0.5px;
}

.classwork-show-page .classwork-heading p {
    margin-top: 7px;
    font-size: 16px;
    line-height: 1.55;
}

.classwork-show-page .classwork-content-grid {
    grid-template-columns: minmax(0, 1fr) 350px;
    gap: 25px;
}

.classwork-show-page .classwork-card {
    border-radius: 21px;
    margin-bottom: 22px;
}

.classwork-show-page .classwork-card-header {
    min-height: 67px;
    padding: 17px 23px;
}

.classwork-show-page .classwork-card-header h2 {
    font-size: 17px;
    line-height: 1.4;
}

.classwork-show-page .classwork-card-body {
    padding: 23px;
}

.classwork-show-page .classwork-description,
.classwork-show-page .assignment-description {
    font-size: 16px;
    line-height: 1.75;
}

.classwork-show-page .classwork-card-body p {
    font-size: 16px;
    line-height: 1.7;
}

.classwork-show-page .classwork-file-item,
.classwork-show-page .attachment-item {
    min-height: 68px;
    padding: 13px 16px;
    border-radius: 13px;
}

.classwork-show-page .classwork-file-name,
.classwork-show-page .attachment-name {
    font-size: 15px;
    line-height: 1.45;
}

.classwork-show-page .classwork-file-meta,
.classwork-show-page .attachment-meta {
    font-size: 13px;
}

.classwork-show-page .classwork-open-btn {
    min-height: 42px;
    padding: 9px 15px;
    font-size: 14px;
    border-radius: 10px;
}

.classwork-show-page .classwork-sidebar-card {
    border-radius: 21px;
}

.classwork-show-page .classwork-sidebar-card-header {
    min-height: 67px;
    padding: 17px 21px;
}

.classwork-show-page .classwork-sidebar-card-header h2 {
    font-size: 17px;
}

.classwork-show-page .classwork-detail-row {
    padding: 16px 0;
    gap: 14px;
}

.classwork-show-page .classwork-detail-icon {
    width: 43px;
    height: 43px;
    border-radius: 12px;
    font-size: 17px;
}

.classwork-show-page .classwork-detail-label {
    font-size: 13px;
    margin-bottom: 4px;
}

.classwork-show-page .classwork-detail-value {
    font-size: 16px;
    line-height: 1.45;
}

.classwork-show-page .submission-status {
    padding: 17px 18px;
    border-radius: 14px;
}

.classwork-show-page .submission-status-title {
    font-size: 16px;
}

.classwork-show-page .submission-status-meta,
.classwork-show-page .submission-date {
    font-size: 14px;
}

.classwork-show-page .submission-grade {
    font-size: 22px;
}

.classwork-show-page .feedback-text {
    font-size: 15px;
    line-height: 1.65;
}

.classwork-show-page input[type="file"],
.classwork-show-page input[type="text"],
.classwork-show-page input[type="number"],
.classwork-show-page textarea,
.classwork-show-page select {
    font-size: 15px;
}

.classwork-show-page .selected-file-item {
    padding: 13px 15px;
    border-radius: 12px;
}

.classwork-show-page .selected-file-item span {
    font-size: 14px;
}

.classwork-show-page .submit-assignment-btn,
.classwork-show-page button[type="submit"] {
    min-height: 48px;
    padding: 11px 20px;
    font-size: 15px;
    border-radius: 11px;
}

@media (max-width: 1000px) {
    .classwork-show-page {
        max-width: 100%;
        padding: 24px 25px 42px;
    }

    .classwork-show-page .classwork-content-grid {
        grid-template-columns: minmax(0, 1fr) 315px;
        gap: 20px;
    }

    .classwork-show-page .classwork-heading h1 {
        font-size: 32px;
    }
}

@media (max-width: 900px) {
    .classwork-show-page .classwork-content-grid {
        grid-template-columns: 1fr;
    }
}

@media (max-width: 700px) {
    .classwork-show-page {
        padding: 20px 17px 35px;
    }

    .classwork-show-page .classwork-heading {
        gap: 13px;
        margin-bottom: 21px;
    }

    .classwork-show-page .classwork-heading-icon {
        width: 58px;
        height: 58px;
    }

    .classwork-show-page .classwork-heading h1 {
        font-size: 28px;
    }

    .classwork-show-page .classwork-heading p {
        font-size: 14px;
    }

    .classwork-show-page .classwork-card-body {
        padding: 19px;
    }
}

@media (max-width: 480px) {
    .classwork-show-page {
        padding: 17px 13px 30px;
    }

    .classwork-show-page .classwork-heading h1 {
        font-size: 25px;
    }

    .classwork-show-page .classwork-card-header {
        padding: 15px 17px;
    }

    .classwork-show-page .classwork-card-body {
        padding: 17px;
    }

    .classwork-show-page .classwork-description,
    .classwork-show-page .assignment-description,
    .classwork-show-page .classwork-card-body p {
        font-size: 15px;
    }
}
</style>
