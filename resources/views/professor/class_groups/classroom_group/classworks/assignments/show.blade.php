

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

.submission-view-btn {
    display:inline-flex;
    align-items:center;
    justify-content:center;
    gap:4px;
    flex:0 0 auto;
    min-height:31px;
    padding:0 9px;
    border:1px solid var(--as-blue-border);
    border-radius:7px;
    background:var(--as-surface);
    color:var(--as-blue);
    text-decoration:none;
    font-size:9px;
    font-weight:800;
    white-space:nowrap;
    transition:.18s ease;
}

.submission-view-btn:hover {
    border-color:var(--as-blue);
    background:var(--as-blue-soft);
    color:var(--as-blue-dark);
}

.submission-view-btn i {
    font-size:14px;
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
            class="classwork-back-btn">
            <i class="bx bx-arrow-back"></i>

            {{ $returnTo === 'classwork'
                ? 'Back to Classwork'
                : 'Back to Stream'
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
     GOOGLE FORM
===================================================== --}}

            @if($assignment->google_form_url)

            <section class="classwork-detail-card">

                <div class="classwork-detail-card-header">
                    <h2>
                        Assignment Form
                    </h2>
                </div>

                <div class="assignment-form-section">

                    <div class="assignment-form-box">

                        <div class="assignment-form-icon">
                            <i class="bx bx-link-external"></i>
                        </div>

                        <div class="assignment-form-info">

                            <strong>
                                Google Form Assignment
                            </strong>

                            <span>
                                Open the assignment form and complete all required questions.
                            </span>

                        </div>

                        <a
                            href="{{ $assignment->google_form_url }}"
                            target="_blank"
                            rel="noopener noreferrer"
                            class="assignment-form-open">
                            <i class="bx bx-link-external"></i>
                            Open Assignment
                        </a>

                    </div>

                </div>

            </section>

            @endif

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
                                            ? number_format($resource->file_size / 1024, 1) . ' KB'
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
                STUDENT SUBMISSIONS
            ===================================================== --}}
            <section class="classwork-detail-card">

                <div class="classwork-detail-card-header">
                    <h2>Student Submissions</h2>
                </div>

                @php
                $submittedCount = $assignment->submissions->count();
                $totalStudents = $classGroup->students->count();
                @endphp

                {{-- Submission Summary --}}
                <div class="submission-summary">

                    <div class="submission-summary-icon">
                        <i class="bx bx-group"></i>
                    </div>

                    <div>
                        <strong>
                            {{ $submittedCount }} / {{ $totalStudents }}
                        </strong>

                        <span>Students submitted</span>
                    </div>

                </div>


                {{-- Submitted Students --}}
                @if($assignment->submissions->isNotEmpty())

                <div class="submission-list">

                    @foreach($assignment->submissions as $submission)
                    <div class="submission-item">

                        {{-- ========================================================
         STUDENT ICON
    ========================================================= --}}

                        <div class="submission-student-icon">
                            <i class="bx bx-user"></i>
                        </div>


                        {{-- ========================================================
         STUDENT INFORMATION
    ========================================================= --}}

                        <div class="submission-student-info">

                            <strong>
                                {{ $submission->student->name ?? 'Unknown Student' }}
                            </strong>

                            <span>
                                Submitted
                                {{ $submission->submitted_at?->format('M d, Y \a\t h:i A') }}
                            </span>

                        </div>


                        {{-- ========================================================
         GRADE STATUS
    ========================================================= --}}

                        @if($submission->score !== null)

                        <span class="submission-grade-status graded">

                            <i class="bx bx-check-circle"></i>

                            Graded

                            <span class="submission-grade-score">
                                {{ rtrim(rtrim(number_format($submission->score, 2), '0'), '.') }}
                                /
                                {{ rtrim(rtrim(number_format($assignment->points, 2), '0'), '.') }}
                            </span>

                        </span>

                        @else

                        <span class="submission-grade-status ungraded">

                            <i class="bx bx-time-five"></i>

                            Ungraded

                        </span>

                        @endif


                        {{-- ========================================================
         VIEW SUBMISSION
    ========================================================= --}}

                        <a
                            href="{{ route('professor.class-groups.assignments.submissions.show', [
            'classGroup' => $classGroup->id,
            'assignment' => $assignment->id,
            'submission' => $submission->id,
        ]) }}"
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
                        No students have submitted this assignment yet.
                    </p>

                </div>

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
                ACTIONS
            ===================================================== --}}

            <section class="classwork-detail-card">

                <div class="classwork-detail-card-header">

                    <h2>
                        Actions
                    </h2>

                </div>


                {{-- EDIT ASSIGNMENT --}}

                <a
                    href="{{ route(
                        'professor.class-groups.assignments.edit',
                        [
                            'classGroup' => $classGroup->id,
                            'assignment' => $assignment->id,
                            'return_to' => 'show',
                            'origin' => $returnTo,
                        ]
                    ) }}"
                    class="classwork-action-btn">

                    <i class="bx bx-edit"></i>

                    Edit Assignment

                </a>

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


        {{-- ========================================================
            MODAL HEADER
        ========================================================= --}}

        <div class="material-viewer-header">

            <div class="material-viewer-title">

                <i class="bx bx-file"></i>

                <span id="assignmentViewerTitle">
                    Assignment Attachment
                </span>

            </div>


            <div class="material-viewer-actions">


                {{-- FULLSCREEN --}}

                <button
                    type="button"
                    class="material-viewer-btn"
                    onclick="toggleAssignmentFullscreen()"
                    title="Fullscreen">
                    <i class="bx bx-fullscreen"></i>
                </button>


                {{-- CLOSE --}}

                <button
                    type="button"
                    class="material-viewer-btn close"
                    onclick="closeAssignmentModal()"
                    title="Close">
                    <i class="bx bx-x"></i>
                </button>

            </div>

        </div>


        {{-- ========================================================
            FILE VIEWER
        ========================================================= --}}

        <div class="material-viewer-body">

            <iframe
                id="assignmentViewerFrame"
                src=""
                frameborder="0"></iframe>

        </div>

    </div>

</div>



{{-- ================================================================
    MODAL JAVASCRIPT
================================================================= --}}

<script>
    /*
    |--------------------------------------------------------------------------
    | Open assignment file
    |--------------------------------------------------------------------------
    */

    function openAssignmentFile(fileUrl, fileName) {

        const modal =
            document.getElementById(
                'assignmentViewerModal'
            );

        const iframe =
            document.getElementById(
                'assignmentViewerFrame'
            );

        const title =
            document.getElementById(
                'assignmentViewerTitle'
            );


        if (!modal || !iframe) {

            console.error(
                'Assignment viewer modal or iframe not found.'
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
                'Assignment Attachment';

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

    function closeAssignmentModal() {

        const modal =
            document.getElementById(
                'assignmentViewerModal'
            );

        const iframe =
            document.getElementById(
                'assignmentViewerFrame'
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


    /*
    |--------------------------------------------------------------------------
    | Click outside viewer
    |--------------------------------------------------------------------------
    */

    const assignmentModal =
        document.getElementById(
            'assignmentViewerModal'
        );


    if (assignmentModal) {

        assignmentModal.addEventListener(
            'click',
            function(event) {

                if (
                    event.target ===
                    assignmentModal
                ) {

                    closeAssignmentModal();

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
                    'assignmentViewerModal'
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

                closeAssignmentModal();

            }

        }
    );
</script>

@endsection