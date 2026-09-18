@extends('layouts.prof_layout')

@section('title', 'Edit Assignment')

@section('content')

<style>
/* ============================================================
   ASSIGNMENT EDIT — COMPLETE REDESIGN
   Website primary colour: BLUE
   Assignment accent: GREEN (used only for assignment actions)
   ============================================================ */

.assignment-edit-page {
    --ae-green:#16a34a;
    --ae-green-dark:#15803d;
    --ae-green-soft:#f0fdf4;
    --ae-green-light:#dcfce7;
    --ae-green-border:#bbf7d0;
    --ae-blue:#2563eb;
    --ae-blue-dark:#1d4ed8;
    --ae-blue-soft:#eff6ff;
    --ae-blue-border:#bfdbfe;
    --ae-text:#0f172a;
    --ae-text-2:#334155;
    --ae-muted:#64748b;
    --ae-light:#94a3b8;
    --ae-border:#e2e8f0;
    --ae-border-light:#edf2f7;
    --ae-surface:#fff;
    --ae-soft:#f8fafc;
    --ae-danger:#dc2626;
    --ae-danger-soft:#fef2f2;
    --ae-danger-border:#fecaca;
    --ae-radius:18px;
    --ae-shadow:0 7px 26px rgba(15,23,42,.055);

    width:100%;
    max-width:1240px;
    margin:0 auto;
    padding:30px 26px 60px;
    color:var(--ae-text);
}

.assignment-edit-page *, .assignment-edit-page *::before, .assignment-edit-page *::after { box-sizing:border-box; }

/* Header */
.assignment-edit-header {
    display:flex; align-items:flex-start; justify-content:space-between; gap:24px;
    margin-bottom:24px;
}
.assignment-edit-header-main { display:flex; align-items:flex-start; gap:14px; min-width:0; }
.assignment-back-button {
    width:44px; height:44px; flex:0 0 44px;
    display:inline-flex; align-items:center; justify-content:center;
    border:1px solid var(--ae-border); border-radius:12px;
    background:#fff; color:#475569; text-decoration:none;
    box-shadow:0 3px 10px rgba(15,23,42,.05); transition:.18s ease;
}
.assignment-back-button:hover {
    color:var(--ae-blue-dark); border-color:var(--ae-blue-border);
    background:var(--ae-blue-soft); transform:translateX(-2px);
}
.back-arrow { font-size:23px; line-height:1; font-weight:500; }
.assignment-eyebrow {
    margin:0 0 6px; color:var(--ae-muted); font-size:11px; font-weight:800;
    letter-spacing:.14em; text-transform:uppercase;
}
.assignment-edit-header h1 {
    margin:0; color:var(--ae-text); font-size:30px; line-height:1.15;
    font-weight:800; letter-spacing:-.035em;
}
.assignment-edit-header-subtitle { margin:8px 0 0; color:var(--ae-muted); font-size:14px; line-height:1.55; }
.assignment-header-badge {
    display:inline-flex; align-items:center; gap:7px; flex:0 0 auto;
    padding:8px 12px; border:1px solid var(--ae-green-border); border-radius:999px;
    background:var(--ae-green-soft); color:var(--ae-green-dark); font-size:11px;
    font-weight:800; white-space:nowrap;
}
.assignment-header-badge i { font-size:15px; }

/* Layout */
.assignment-edit-layout { display:grid; grid-template-columns:minmax(0,1fr) 310px; align-items:start; gap:22px; }
.assignment-edit-main, .assignment-edit-sidebar { min-width:0; }

/* Sections */
.assignment-section {
    overflow:hidden; margin-bottom:18px; border:1px solid var(--ae-border);
    border-radius:var(--ae-radius); background:var(--ae-surface); box-shadow:var(--ae-shadow);
}
.assignment-section:last-child { margin-bottom:0; }
.assignment-section-header {
    display:flex; align-items:center; gap:13px; padding:19px 22px;
    border-bottom:1px solid var(--ae-border-light); background:#fff;
}
.assignment-section-icon {
    width:40px; height:40px; flex:0 0 40px; display:inline-flex;
    align-items:center; justify-content:center; border:1px solid var(--ae-green-border);
    border-radius:11px; background:var(--ae-green-soft); color:var(--ae-green); font-size:20px;
}
.assignment-section-title { min-width:0; }
.assignment-section-title h2 { margin:0; color:var(--ae-text); font-size:16px; line-height:1.25; font-weight:800; }
.assignment-section-title p { margin:4px 0 0; color:var(--ae-muted); font-size:12px; line-height:1.45; }
.assignment-section-body { padding:23px; }

/* Form */
.assignment-form-group { margin-bottom:20px; }
.assignment-form-group:last-child { margin-bottom:0; }
.assignment-form-row { display:grid; grid-template-columns:1fr 1fr; gap:16px; }
.assignment-form-group label {
    display:flex; align-items:center; flex-wrap:wrap; gap:6px; margin-bottom:8px;
    color:var(--ae-text-2); font-size:13px; font-weight:750;
}
.assignment-required { color:#ef4444; font-weight:800; }
.assignment-optional {
    padding:2px 6px; border-radius:5px; background:var(--ae-soft); color:var(--ae-light);
    font-size:10px; font-weight:700;
}
.assignment-form-group input:not([type="file"]), .assignment-form-group textarea, .assignment-form-group select {
    width:100%; border:1px solid #cbd5e1; border-radius:11px; outline:none;
    background:#fff; color:var(--ae-text); font-family:inherit; font-size:14px;
    transition:border-color .18s ease, box-shadow .18s ease, background .18s ease;
}
.assignment-form-group input:not([type="file"]), .assignment-form-group select { height:45px; padding:0 13px; }
.assignment-form-group textarea { min-height:155px; padding:13px; resize:vertical; line-height:1.6; }
.assignment-form-group input:not([type="file"]):hover, .assignment-form-group textarea:hover, .assignment-form-group select:hover { border-color:#94a3b8; }
.assignment-form-group input:not([type="file"]):focus, .assignment-form-group textarea:focus, .assignment-form-group select:focus {
    border-color:#60a5fa; box-shadow:0 0 0 3px rgba(59,130,246,.11);
}
.assignment-help { display:block; margin-top:7px; color:var(--ae-light); font-size:11px; line-height:1.5; }
.assignment-help i { color:var(--ae-blue); margin-right:4px; }
.assignment-error {
    display:flex; gap:6px; align-items:flex-start; margin-top:7px; color:var(--ae-danger);
    font-size:12px; line-height:1.45; font-weight:600;
}
.assignment-error::before {
    content:'!'; width:15px; height:15px; flex:0 0 15px; display:inline-flex;
    align-items:center; justify-content:center; border-radius:50%; background:#fee2e2; font-size:9px; font-weight:800;
}

/* Points */
.assignment-form-group input#points { border-top-right-radius:0; border-bottom-right-radius:0; }
.assignment-points-unit {
    min-width:62px; height:45px; display:inline-flex; align-items:center; justify-content:center;
    padding:0 12px; border:1px solid #cbd5e1; border-left:0; border-radius:0 11px 11px 0;
    background:var(--ae-soft); color:var(--ae-muted); font-size:12px; font-weight:750;
}

/* Google form */
.assignment-google-form-box {
    padding:16px; border:1px solid var(--ae-blue-border); border-radius:13px; background:#f8fbff;
}
.assignment-google-form-label-row { display:flex; align-items:center; gap:10px; margin-bottom:13px; }
.assignment-google-form-icon {
    width:35px; height:35px; display:inline-flex; align-items:center; justify-content:center;
    flex:0 0 35px; border-radius:9px; background:#fff; color:var(--ae-blue); box-shadow:2px 4px 10px rgba(15,23,42,.05); font-size:18px;
}
.assignment-google-form-label-row strong { display:block; color:var(--ae-text-2); font-size:13px; font-weight:800; }
.assignment-google-form-label-row span { display:block; margin-top:2px; color:var(--ae-light); font-size:10px; }

/* Attachments */
.assignment-attachments-list { display:flex; flex-direction:column; gap:9px; }
.assignment-attachment {
    display:flex; align-items:center; gap:12px; min-width:0; padding:12px;
    border:1px solid var(--ae-border); border-radius:12px; background:var(--ae-soft); transition:.18s ease;
}
.assignment-attachment:hover { border-color:#cbd5e1; background:#f1f5f9; transform:translateY(-1px); }
.assignment-attachment-icon {
    width:40px; height:40px; flex:0 0 40px; display:inline-flex; align-items:center; justify-content:center;
    border:1px solid var(--ae-green-border); border-radius:10px; background:var(--ae-green-soft);
    color:var(--ae-green); font-size:19px;
}
.assignment-attachment-info { min-width:0; flex:1; }
.assignment-attachment-info strong {
    display:block; overflow:hidden; color:var(--ae-text-2); font-size:13px; font-weight:700;
    text-overflow:ellipsis; white-space:nowrap;
}
.assignment-attachment-info span { display:block; margin-top:3px; color:var(--ae-light); font-size:10px; }
.assignment-resource-delete {
    width:35px; height:35px; flex:0 0 35px; display:inline-flex; align-items:center; justify-content:center;
    border:1px solid var(--ae-danger-border); border-radius:9px; background:#fff; color:var(--ae-danger);
    cursor:pointer; transition:.18s ease;
}
.assignment-resource-delete:hover { background:var(--ae-danger-soft); border-color:#fca5a5; }
.assignment-empty {
    min-height:140px; display:flex; flex-direction:column; align-items:center; justify-content:center;
    padding:24px; border:1px dashed #cbd5e1; border-radius:12px; background:var(--ae-soft);
    color:var(--ae-muted); font-size:12px; line-height:1.5; text-align:center;
}
.assignment-empty i {
    width:40px; height:40px; display:inline-flex; align-items:center; justify-content:center;
    margin-bottom:8px; border-radius:10px; background:#fff; color:var(--ae-light); font-size:20px; box-shadow:var(--ae-shadow);
}

/* Upload */
.assignment-upload-area {
    position:relative; display:block; padding:25px 20px; border:1.5px dashed var(--ae-green-border);
    border-radius:14px; background:var(--ae-green-soft); text-align:center; cursor:pointer;
    transition:.18s ease;
}
.assignment-upload-area:hover, .assignment-upload-area.is-dragging {
    border-color:var(--ae-green); background:#ecfdf5; transform:translateY(-1px);
}
.assignment-upload-icon {
    width:48px; height:48px; display:inline-flex; align-items:center; justify-content:center; margin-bottom:10px;
    border:1px solid var(--ae-green-border); border-radius:13px; background:#fff; color:var(--ae-green);
    box-shadow:var(--ae-shadow); font-size:22px;
}
.assignment-upload-area strong { display:block; color:var(--ae-text-2); font-size:13px; font-weight:800; }
.assignment-upload-area > span { display:block; margin-top:5px; color:var(--ae-light); font-size:11px; line-height:1.5; }
.assignment-upload-area input[type="file"] {
    width:100%; margin-top:13px; padding:9px; border:1px solid #cbd5e1; border-radius:9px;
    background:#fff; font-family:inherit; font-size:12px; cursor:pointer;
}
.assignment-selected-files { display:flex; flex-direction:column; gap:8px; margin-top:12px; }
.assignment-selected-file {
    display:flex; align-items:center; gap:10px; min-width:0; padding:10px 11px;
    border:1px solid var(--ae-green-border); border-radius:10px; background:#fbfffc;
}
.assignment-selected-file > i { flex:0 0 auto; color:var(--ae-green); font-size:19px; }
.assignment-selected-file span { min-width:0; flex:1; overflow:hidden; color:var(--ae-text-2); font-size:12px; font-weight:650; text-overflow:ellipsis; white-space:nowrap; }
.assignment-selected-file small { flex:0 0 auto; color:var(--ae-light); font-size:10px; }
.assignment-new-file-remove {
    width:29px; height:29px; flex:0 0 29px; display:inline-flex; align-items:center; justify-content:center;
    border:0; border-radius:8px; background:var(--ae-danger-soft); color:var(--ae-danger); cursor:pointer; transition:.18s ease;
}
.assignment-new-file-remove:hover { background:#fee2e2; }

/* Sidebar */
.assignment-sidebar-card {
    position:sticky; top:20px; overflow:hidden; border:1px solid var(--ae-border);
    border-radius:var(--ae-radius); background:#fff; box-shadow:var(--ae-shadow);
}
.assignment-sidebar-header {
    display:flex; align-items:center; gap:10px; padding:19px 18px; border-bottom:1px solid var(--ae-border-light);
}
.assignment-sidebar-header h3 { margin:0; color:var(--ae-text); font-size:14px; font-weight:800; }
.assignment-sidebar-header p { margin:4px 0 0; color:var(--ae-light); font-size:10px; line-height:1.45; }
.assignment-sidebar-body { padding:8px 18px 16px; }
.assignment-summary-row {
    display:grid; grid-template-columns:88px minmax(0,1fr); gap:12px; padding:13px 0;
    border-bottom:1px solid #f1f5f9;
}
.assignment-summary-row:last-child { border-bottom:0; }
.assignment-summary-label { color:var(--ae-muted); font-size:10px; line-height:1.45; }
.assignment-summary-value {
    min-width:0; overflow-wrap:anywhere; color:var(--ae-text-2); font-size:11px; line-height:1.45;
    font-weight:750; text-align:right;
}
.assignment-actions { padding:16px 18px 18px; border-top:1px solid var(--ae-border-light); background:#fcfdff; }
.assignment-save-button, .assignment-cancel-button {
    width:100%; height:43px; display:inline-flex; align-items:center; justify-content:center; gap:7px;
    border-radius:10px; font-family:inherit; font-size:12px; font-weight:800; text-decoration:none; cursor:pointer; transition:.18s ease;
}
.assignment-save-button {
    border:1px solid var(--ae-green); background:var(--ae-green); color:#fff;
    box-shadow:0 5px 12px rgba(22,163,74,.16);
}
.assignment-save-button:hover { border-color:var(--ae-green-dark); background:var(--ae-green-dark); transform:translateY(-1px); }
.assignment-save-button i { font-size:17px; }
.assignment-cancel-button { margin-top:9px; border:1px solid #cbd5e1; background:#fff; color:var(--ae-text-2); }
.assignment-cancel-button:hover { border-color:#94a3b8; background:var(--ae-soft); }

/* Focus */
.assignment-edit-page button:focus-visible, .assignment-edit-page a:focus-visible, .assignment-edit-page input:focus-visible, .assignment-edit-page select:focus-visible, .assignment-edit-page textarea:focus-visible {
    outline:3px solid rgba(37,99,235,.14); outline-offset:2px;
}

/* Responsive */
@media (max-width:1000px) {
    .assignment-edit-layout { grid-template-columns:minmax(0,1fr) 280px; gap:17px; }
    .assignment-edit-header h1 { font-size:27px; }
}
@media (max-width:820px) {
    .assignment-edit-layout { grid-template-columns:1fr; }
    .assignment-sidebar-card { position:static; }
    .assignment-actions { display:grid; grid-template-columns:1fr 1fr; gap:9px; }
    .assignment-cancel-button { margin-top:0; }
}
@media (max-width:620px) {
    .assignment-edit-page { padding:20px 14px 42px; }
    .assignment-edit-header { margin-bottom:18px; }
    .assignment-edit-header-main { gap:11px; }
    .assignment-header-badge { display:none; }
    .assignment-edit-header h1 { font-size:24px; }
    .assignment-edit-header-subtitle { font-size:12px; }
    .assignment-form-row { grid-template-columns:1fr; gap:0; }
    .assignment-section { margin-bottom:14px; border-radius:14px; }
    .assignment-section-header { padding:16px; }
    .assignment-section-body { padding:17px; }
    .assignment-section-icon { width:35px; height:35px; flex-basis:35px; font-size:17px; }
    .assignment-section-title h2 { font-size:14px; }
    .assignment-section-title p { font-size:11px; }
    .assignment-actions { grid-template-columns:1fr; }
    .assignment-summary-row { grid-template-columns:78px minmax(0,1fr); }
    .assignment-upload-area { padding:22px 15px; }
    .assignment-attachment { align-items:flex-start; }
    .assignment-resource-delete { margin-left:auto; }
}


/* ============================================================
   ASSIGNMENT EDIT — DARK MODE
   Uses the existing website .dark-mode class.
   ============================================================ */

.dark-mode .assignment-edit-page {
    --ae-green:#49d5a7;
    --ae-green-dark:#62e0b5;
    --ae-green-soft:rgba(73,213,167,.12);
    --ae-green-light:rgba(73,213,167,.18);
    --ae-green-border:rgba(73,213,167,.34);

    --ae-blue:#6d76ff;
    --ae-blue-dark:#8990ff;
    --ae-blue-soft:rgba(109,118,255,.12);
    --ae-blue-border:rgba(109,118,255,.34);

    --ae-text:#f4f5ff;
    --ae-text-2:#e6e8f7;
    --ae-muted:#a1a4cc;
    --ae-light:#9295bd;

    --ae-border:#2b2e52;
    --ae-border-light:#252847;
    --ae-surface:#171933;
    --ae-soft:#1c1e3a;

    --ae-danger:#ff8d8d;
    --ae-danger-soft:rgba(255,141,141,.12);
    --ae-danger-border:rgba(255,141,141,.30);

    --ae-shadow:0 8px 28px rgba(0,0,10,.28);

    color:var(--ae-text);
    color-scheme:dark;
}

/* Header */

.dark-mode .assignment-edit-page .assignment-back-button {
    border-color:var(--ae-border);
    background:var(--ae-surface);
    color:var(--ae-light);
    box-shadow:0 3px 10px rgba(0,0,10,.22);
}

.dark-mode .assignment-edit-page .assignment-back-button:hover {
    color:var(--ae-blue-dark);
    border-color:var(--ae-blue-border);
    background:var(--ae-blue-soft);
}

.dark-mode .assignment-edit-page .assignment-eyebrow,
.dark-mode .assignment-edit-page .assignment-edit-header-subtitle {
    color:var(--ae-muted);
}

.dark-mode .assignment-edit-page .assignment-edit-header h1 {
    color:var(--ae-text);
}

.dark-mode .assignment-edit-page .assignment-header-badge {
    border-color:var(--ae-green-border);
    background:var(--ae-green-soft);
    color:var(--ae-green-dark);
}

/* Cards / sections */

.dark-mode .assignment-edit-page .assignment-section,
.dark-mode .assignment-edit-page .assignment-sidebar-card {
    border-color:var(--ae-border);
    background:var(--ae-surface);
    box-shadow:var(--ae-shadow);
}

.dark-mode .assignment-edit-page .assignment-section-header {
    border-color:var(--ae-border-light);
    background:var(--ae-surface);
}

.dark-mode .assignment-edit-page .assignment-section-title h2,
.dark-mode .assignment-edit-page .assignment-sidebar-header h3 {
    color:var(--ae-text);
}

.dark-mode .assignment-edit-page .assignment-section-title p,
.dark-mode .assignment-edit-page .assignment-sidebar-header p {
    color:var(--ae-muted);
}

.dark-mode .assignment-edit-page .assignment-section-icon {
    border-color:var(--ae-green-border);
    background:var(--ae-green-soft);
    color:var(--ae-green);
}

/* Form */

.dark-mode .assignment-edit-page .assignment-form-group label {
    color:var(--ae-text-2);
}

.dark-mode .assignment-edit-page .assignment-optional {
    background:#242648;
    color:var(--ae-light);
}

.dark-mode .assignment-edit-page .assignment-form-group input:not([type="file"]),
.dark-mode .assignment-edit-page .assignment-form-group textarea,
.dark-mode .assignment-edit-page .assignment-form-group select {
    border-color:#3a3e68;
    background:#12142a;
    color:var(--ae-text);
}

.dark-mode .assignment-edit-page .assignment-form-group input:not([type="file"])::placeholder,
.dark-mode .assignment-edit-page .assignment-form-group textarea::placeholder {
    color:#6f72a0;
}

.dark-mode .assignment-edit-page .assignment-form-group input:not([type="file"]):hover,
.dark-mode .assignment-edit-page .assignment-form-group textarea:hover,
.dark-mode .assignment-edit-page .assignment-form-group select:hover {
    border-color:#565b8d;
}

.dark-mode .assignment-edit-page .assignment-form-group input:not([type="file"]):focus,
.dark-mode .assignment-edit-page .assignment-form-group textarea:focus,
.dark-mode .assignment-edit-page .assignment-form-group select:focus {
    border-color:var(--ae-blue);
    box-shadow:0 0 0 3px rgba(109,118,255,.16);
}

.dark-mode .assignment-edit-page .assignment-help {
    color:var(--ae-light);
}

.dark-mode .assignment-edit-page .assignment-help i {
    color:var(--ae-blue);
}

.dark-mode .assignment-edit-page .assignment-error {
    color:var(--ae-danger);
}

.dark-mode .assignment-edit-page .assignment-error::before {
    background:rgba(255,141,141,.16);
}

/* Points */

.dark-mode .assignment-edit-page .assignment-points-unit {
    border-color:#3a3e68;
    background:#1c1e3a;
    color:var(--ae-muted);
}

/* Google Form */

.dark-mode .assignment-edit-page .assignment-google-form-box {
    border-color:var(--ae-blue-border);
    background:rgba(109,118,255,.07);
}

.dark-mode .assignment-edit-page .assignment-google-form-icon {
    background:#171933;
    color:var(--ae-blue);
    box-shadow:0 3px 10px rgba(0,0,10,.22);
}

.dark-mode .assignment-edit-page .assignment-google-form-label-row strong {
    color:var(--ae-text-2);
}

.dark-mode .assignment-edit-page .assignment-google-form-label-row span {
    color:var(--ae-light);
}

/* Existing attachments */

.dark-mode .assignment-edit-page .assignment-attachment {
    border-color:var(--ae-border);
    background:#12142a;
}

.dark-mode .assignment-edit-page .assignment-attachment:hover {
    border-color:#565b8d;
    background:#1c1e3a;
}

.dark-mode .assignment-edit-page .assignment-attachment-icon {
    border-color:var(--ae-green-border);
    background:var(--ae-green-soft);
    color:var(--ae-green);
}

.dark-mode .assignment-edit-page .assignment-attachment-info strong {
    color:var(--ae-text-2);
}

.dark-mode .assignment-edit-page .assignment-attachment-info span {
    color:var(--ae-light);
}

.dark-mode .assignment-edit-page .assignment-resource-delete {
    border-color:var(--ae-danger-border);
    background:#171933;
    color:var(--ae-danger);
}

.dark-mode .assignment-edit-page .assignment-resource-delete:hover {
    border-color:rgba(255,141,141,.45);
    background:var(--ae-danger-soft);
}

.dark-mode .assignment-edit-page .assignment-empty {
    border-color:#3a3e68;
    background:#12142a;
    color:var(--ae-muted);
}

.dark-mode .assignment-edit-page .assignment-empty i {
    background:#171933;
    color:var(--ae-light);
    box-shadow:0 4px 12px rgba(0,0,10,.20);
}

/* Upload */

.dark-mode .assignment-edit-page .assignment-upload-area {
    border-color:var(--ae-green-border);
    background:var(--ae-green-soft);
}

.dark-mode .assignment-edit-page .assignment-upload-area:hover,
.dark-mode .assignment-edit-page .assignment-upload-area.is-dragging {
    border-color:var(--ae-green);
    background:rgba(73,213,167,.17);
}

.dark-mode .assignment-edit-page .assignment-upload-icon {
    border-color:var(--ae-green-border);
    background:#171933;
    color:var(--ae-green);
    box-shadow:0 4px 12px rgba(0,0,10,.20);
}

.dark-mode .assignment-edit-page .assignment-upload-area strong {
    color:var(--ae-text-2);
}

.dark-mode .assignment-edit-page .assignment-upload-area > span {
    color:var(--ae-light);
}

.dark-mode .assignment-edit-page .assignment-upload-area input[type="file"] {
    border-color:#3a3e68;
    background:#12142a;
    color:var(--ae-text-2);
}

/* Selected new files */

.dark-mode .assignment-edit-page .assignment-selected-file {
    border-color:var(--ae-green-border);
    background:rgba(73,213,167,.06);
}

.dark-mode .assignment-edit-page .assignment-selected-file > i {
    color:var(--ae-green);
}

.dark-mode .assignment-edit-page .assignment-selected-file span {
    color:var(--ae-text-2);
}

.dark-mode .assignment-edit-page .assignment-selected-file small {
    color:var(--ae-light);
}

.dark-mode .assignment-edit-page .assignment-new-file-remove {
    background:var(--ae-danger-soft);
    color:var(--ae-danger);
}

.dark-mode .assignment-edit-page .assignment-new-file-remove:hover {
    background:rgba(255,141,141,.20);
}

/* Sidebar */

.dark-mode .assignment-edit-page .assignment-sidebar-header {
    border-color:var(--ae-border-light);
}

.dark-mode .assignment-edit-page .assignment-summary-row {
    border-color:var(--ae-border-light);
}

.dark-mode .assignment-edit-page .assignment-summary-label {
    color:var(--ae-muted);
}

.dark-mode .assignment-edit-page .assignment-summary-value {
    color:var(--ae-text-2);
}

.dark-mode .assignment-edit-page .assignment-actions {
    border-color:var(--ae-border-light);
    background:#12142a;
}

/* Buttons */

.dark-mode .assignment-edit-page .assignment-save-button {
    border-color:var(--ae-green);
    background:var(--ae-green);
    color:#08130f;
    box-shadow:0 5px 14px rgba(73,213,167,.14);
}

.dark-mode .assignment-edit-page .assignment-save-button:hover {
    border-color:var(--ae-green-dark);
    background:var(--ae-green-dark);
}

.dark-mode .assignment-edit-page .assignment-cancel-button {
    border-color:#3a3e68;
    background:#171933;
    color:var(--ae-text-2);
}

.dark-mode .assignment-edit-page .assignment-cancel-button:hover {
    border-color:#565b8d;
    background:#1c1e3a;
}

/* Focus */

.dark-mode .assignment-edit-page button:focus-visible,
.dark-mode .assignment-edit-page a:focus-visible,
.dark-mode .assignment-edit-page input:focus-visible,
.dark-mode .assignment-edit-page select:focus-visible,
.dark-mode .assignment-edit-page textarea:focus-visible {
    outline-color:rgba(109,118,255,.24);
}

</style>

@php
    $backUrl = $returnTo === 'marks'
        ? route('professor.class-groups.marks', $classGroup)
        : ($returnTo === 'show'
            ? route('professor.class-groups.assignments.show', [
                'classGroup' => $classGroup,
                'assignment' => $assignment,
                'return_to' => $origin,
            ])
            : ($returnTo === 'classwork'
                ? route('professor.class-groups.classroom-group.classwork', $classGroup)
                : route('professor.class-groups.classroom-group', $classGroup)
            )
        );

    $backLabel = $returnTo === 'marks'
        ? 'Back to Marks'
        : ($returnTo === 'show'
            ? 'Back to Assignment'
            : ($returnTo === 'classwork'
                ? 'Back to Classwork'
                : 'Back to Stream'
            )
        );

@endphp

<div class="assignment-edit-page">

    {{-- ============================================================
         HEADER
         ============================================================ --}}

    <header class="assignment-edit-header">

        <div class="assignment-edit-header-main">

            <a href="{{ $backUrl }}"
               class="assignment-back-button"
               title="{{ $backLabel }}">
                <span class="back-arrow">←</span>
            </a>

            <div>
                <p class="assignment-eyebrow">
                    {{ $classGroup->group_name }}
                </p>

                <h1>Edit Assignment</h1>

                <p class="assignment-edit-header-subtitle">
                    Update the assignment details, grading settings, and learning materials.
                </p>
            </div>

        </div>

        <span class="assignment-header-badge">
            <i class="bx bx-edit-alt"></i>
            Professor
        </span>

    </header>


    <div class="assignment-edit-layout">

        {{-- ========================================================
             MAIN FORM
             ======================================================== --}}

        <main class="assignment-edit-main">

            <form
                id="assignment-update-form"
                action="{{ route(
                    'professor.class-groups.assignments.update',
                    [
                        'classGroup' => $classGroup,
                        'assignment' => $assignment,
                    ]
                ) }}"
                method="POST"
                enctype="multipart/form-data">

                @csrf
                @method('PUT')

                <input type="hidden" name="return_to" value="{{ $returnTo }}">
                <input type="hidden" name="origin" value="{{ $origin }}">


                {{-- ==================================================
                     ASSIGNMENT DETAILS
                     ================================================== --}}

                <section class="assignment-section">

                    <div class="assignment-section-header">

                        <div class="assignment-section-icon">
                            <i class="bx bx-file-blank"></i>
                        </div>

                        <div class="assignment-section-title">
                            <h2>Assignment Details</h2>
                            <p>Set the title, instructions, and topic.</p>
                        </div>

                    </div>

                    <div class="assignment-section-body">

                        <div class="assignment-form-group">

                            <label for="assignment-title">
                                Assignment Title
                                <span class="assignment-required">*</span>
                            </label>

                            <input
                                id="assignment-title"
                                type="text"
                                name="title"
                                value="{{ old('title', $assignment->title) }}"
                                placeholder="e.g. Database Design Project"
                                maxlength="255"
                                required>

                            @error('title')
                                <div class="assignment-error">{{ $message }}</div>
                            @enderror

                        </div>


                        <div class="assignment-form-group">

                            <label for="assignment-description">
                                Instructions
                            </label>

                            <textarea
                                id="assignment-description"
                                name="description"
                                placeholder="Explain what students need to complete...">{{ old('description', $assignment->description) }}</textarea>

                            @error('description')
                                <div class="assignment-error">{{ $message }}</div>
                            @enderror

                        </div>


                        <div class="assignment-form-group">

                            <label for="assignment-topic">
                                Topic
                                <span class="assignment-optional">Optional</span>
                            </label>

                            <select id="assignment-topic" name="topic_id">

                                <option value="">No topic</option>

                                @foreach($classGroup->topics as $topic)
                                    <option
                                        value="{{ $topic->id }}"
                                        {{ old('topic_id', $assignment->topic_id) == $topic->id ? 'selected' : '' }}>
                                        {{ $topic->topic_name }}
                                    </option>
                                @endforeach

                            </select>

                            <span class="assignment-help">
                                Organize this assignment under one of your classroom topics.
                            </span>

                            @error('topic_id')
                                <div class="assignment-error">{{ $message }}</div>
                            @enderror

                        </div>

                    </div>

                </section>


                {{-- ==================================================
                     DUE DATE + GRADING
                     ================================================== --}}

                <section class="assignment-section">

                    <div class="assignment-section-header">

                        <div class="assignment-section-icon">
                            <i class="bx bx-calendar-check"></i>
                        </div>

                        <div class="assignment-section-title">
                            <h2>Schedule & Grading</h2>
                            <p>Control when the assignment is due and how many points it is worth.</p>
                        </div>

                    </div>

                    <div class="assignment-section-body">

                        <div class="assignment-form-row">

                            <div class="assignment-form-group">

                                <label for="assignment-due-date">
                                    Due Date
                                    <span class="assignment-required">*</span>
                                </label>

                                <input
                                    id="assignment-due-date"
                                    type="date"
                                    name="due_date"
                                    value="{{ old(
                                        'due_date',
                                        $assignment->due_date
                                            ? \Carbon\Carbon::parse($assignment->due_date)->format('Y-m-d')
                                            : ''
                                    ) }}"
                                    required>

                                @error('due_date')
                                    <div class="assignment-error">{{ $message }}</div>
                                @enderror

                            </div>


                            <div class="assignment-form-group">

                                <label for="assignment-due-time">
                                    Due Time
                                    <span class="assignment-optional">Optional</span>
                                </label>

                                <input
                                    id="assignment-due-time"
                                    type="time"
                                    name="due_time"
                                    value="{{ old(
                                        'due_time',
                                        $assignment->due_time
                                            ? \Carbon\Carbon::parse($assignment->due_time)->format('H:i')
                                            : ''
                                    ) }}">

                                @error('due_time')
                                    <div class="assignment-error">{{ $message }}</div>
                                @enderror

                            </div>

                        </div>


                        <div class="assignment-form-group" style="margin-top: 18px;">

                            <label for="points">
                                Total Points
                            </label>

                            <div style="display:flex;align-items:stretch;">
                                <input
                                    type="number"
                                    id="points"
                                    name="points"
                                    value="{{ old('points', (int) ($assignment->points ?? 100)) }}"
                                    min="0"
                                    step="1"
                                    placeholder="100"
                                    style="border-top-right-radius:0;border-bottom-right-radius:0;">
                                <span class="assignment-points-unit">Points</span>
                            </div>

                            <span class="assignment-help">
                                This is the maximum score students can receive for this assignment.
                            </span>

                            @error('points')
                                <div class="assignment-error">{{ $message }}</div>
                            @enderror

                        </div>

                    </div>

                </section>


                {{-- ==================================================
                     GOOGLE FORM
                     ================================================== --}}

                <section class="assignment-section">

                    <div class="assignment-section-header">

                        <div class="assignment-section-icon">
                            <i class="bx bx-link-external"></i>
                        </div>

                        <div class="assignment-section-title">
                            <h2>Online Submission</h2>
                            <p>Optionally connect a Google Form for student responses.</p>
                        </div>

                    </div>

                    <div class="assignment-section-body">

                        <div class="assignment-form-group">

                            <label for="google_form_url">
                                Google Form URL
                                <span class="assignment-optional">Optional</span>
                            </label>

                            <input
                                type="url"
                                id="google_form_url"
                                name="google_form_url"
                                value="{{ old('google_form_url', $assignment->google_form_url) }}"
                                placeholder="https://forms.google.com/...">

                            <span class="assignment-help">
                                Add a Google Form when students need to submit answers through Google Forms.
                            </span>

                            @error('google_form_url')
                                <div class="assignment-error">{{ $message }}</div>
                            @enderror

                        </div>

                    </div>

                </section>


                {{-- ==================================================
                     CURRENT ATTACHMENTS
                     ================================================== --}}

                <section class="assignment-section">

                    <div class="assignment-section-header">

                        <div class="assignment-section-icon">
                            <i class="bx bx-paperclip"></i>
                        </div>

                        <div class="assignment-section-title">
                            <h2>Attachments</h2>
                            <p>Manage files already attached to this assignment.</p>
                        </div>

                    </div>

                    <div class="assignment-section-body">

                        @if($assignment->resources->isNotEmpty())

                            <div class="assignment-attachments-list">

                                @foreach($assignment->resources as $resource)

                                    <div class="assignment-attachment">

                                        <div class="assignment-attachment-icon">
                                            <i class="bx bx-file"></i>
                                        </div>

                                        <div class="assignment-attachment-info">

                                            <strong>
                                                {{ $resource->file_name ?? $resource->title }}
                                            </strong>

                                            <span>
                                                @if($resource->file_size)
                                                    {{ number_format($resource->file_size / 1024, 1) }} KB
                                                @else
                                                    Assignment attachment
                                                @endif
                                            </span>

                                        </div>

                                        <button
                                            type="button"
                                            class="assignment-resource-delete"
                                            data-delete-url="{{ route(
                                                'professor.class-groups.assignments.resources.destroy',
                                                [
                                                    'classGroup' => $classGroup,
                                                    'assignment' => $assignment,
                                                    'resource' => $resource,
                                                ]
                                            ) }}"
                                            title="Delete attachment">

                                            <i class="bx bx-trash"></i>

                                        </button>

                                    </div>

                                @endforeach

                            </div>

                        @else

                            <div class="assignment-empty">
                                <i class="bx bx-file-blank"></i>
                                <br>
                                No files are currently attached to this assignment.
                            </div>

                        @endif

                    </div>

                </section>


                {{-- ==================================================
                     ADD NEW ATTACHMENTS
                     ================================================== --}}

                <section class="assignment-section">

                    <div class="assignment-section-header">

                        <div class="assignment-section-icon">
                            <i class="bx bx-cloud-upload"></i>
                        </div>

                        <div class="assignment-section-title">
                            <h2>Add Files</h2>
                            <p>Add additional learning materials or assignment resources.</p>
                        </div>

                    </div>

                    <div class="assignment-section-body">

                        <div class="assignment-upload-area">

                            <div class="assignment-upload-icon">
                                <i class="bx bx-cloud-upload"></i>
                            </div>

                            <strong>Select files to attach</strong>

                            <span>
                                You can select multiple files. Maximum 10 files, 100 MB per file.
                            </span>

  <input
    id="assignment-files"
    type="file"
    name="attachments[]"
    multiple>
                        </div>

                        <div id="assignment-selected-files"
                             class="assignment-selected-files"></div>

                        @error('files')
                            <div class="assignment-error">{{ $message }}</div>
                        @enderror

                        @error('files.*')
                            <div class="assignment-error">{{ $message }}</div>
                        @enderror

                    </div>

                </section>

            </form>

        </main>


        {{-- ========================================================
             SIDEBAR
             ======================================================== --}}

        <aside class="assignment-edit-sidebar">

            <div class="assignment-sidebar-card">

                <div class="assignment-sidebar-header">
                    <h3>Assignment Summary</h3>
                    <p>Review the important settings before saving.</p>
                </div>

                <div class="assignment-sidebar-body">

                    <div class="assignment-summary-row">
                        <span class="assignment-summary-label">Class</span>
                        <span class="assignment-summary-value">
                            {{ $classGroup->group_name }}
                        </span>
                    </div>

                    <div class="assignment-summary-row">
                        <span class="assignment-summary-label">Topic</span>
                        <span class="assignment-summary-value">
                            {{ $assignment->topic?->topic_name ?? 'No topic' }}
                        </span>
                    </div>

                    <div class="assignment-summary-row">
                        <span class="assignment-summary-label">Points</span>
                        <span class="assignment-summary-value">
                            {{ old('points', (int) ($assignment->points ?? 100)) }}
                        </span>
                    </div>

                    <div class="assignment-summary-row">
                        <span class="assignment-summary-label">Attachments</span>
                        <span class="assignment-summary-value">
                            {{ $assignment->resources->count() }}
                        </span>
                    </div>

                    <div class="assignment-summary-row">
                        <span class="assignment-summary-label">Google Form</span>
                        <span class="assignment-summary-value">
                            {{ $assignment->google_form_url ? 'Connected' : 'Not connected' }}
                        </span>
                    </div>

                </div>


                <div class="assignment-actions">

                    <button
                        type="submit"
                        form="assignment-update-form"
                        class="assignment-save-button">

                        <i class="bx bx-save"></i>
                        Save Changes

                    </button>

                    <a href="{{ $backUrl }}"
                       class="assignment-cancel-button">
                        {{ $backLabel }}
                    </a>


                    {{-- Keep this area available for your existing assignment
                         delete route if/when the controller/view exposes it. --}}

                </div>

            </div>

        </aside>

    </div>

</div>


{{-- ================================================================
     RESOURCE DELETE FORM
     ================================================================ --}}

<form
    id="assignment-resource-delete-form"
    method="POST"
    style="display:none;">

    @csrf
    @method('DELETE')

</form>


{{-- ================================================================
     JAVASCRIPT
     ================================================================ --}}

<script>
document.addEventListener('DOMContentLoaded', function () {

    const fileInput = document.getElementById('assignment-files');
    const fileList = document.getElementById('assignment-selected-files');

    let selectedFiles = [];

    /* ------------------------------------------------------------
       FILE SELECTION
       ------------------------------------------------------------ */

    if (fileInput) {

        fileInput.addEventListener('change', function () {

            const newFiles = Array.from(this.files);

            newFiles.forEach(function (file) {

                const duplicate = selectedFiles.some(function (existingFile) {

                    return (
                        existingFile.name === file.name &&
                        existingFile.size === file.size &&
                        existingFile.lastModified === file.lastModified
                    );

                });

                if (!duplicate) {
                    selectedFiles.push(file);
                }

            });

            updateFileInput();
            renderSelectedFiles();

        });

    }


    /* ------------------------------------------------------------
       REBUILD FILE INPUT
       ------------------------------------------------------------ */

    function updateFileInput() {

        if (!fileInput) return;

        const dataTransfer = new DataTransfer();

        selectedFiles.forEach(function (file) {
            dataTransfer.items.add(file);
        });

        fileInput.files = dataTransfer.files;

    }


    /* ------------------------------------------------------------
       RENDER SELECTED FILES
       ------------------------------------------------------------ */

    function renderSelectedFiles() {

        if (!fileList) return;

        fileList.innerHTML = '';

        selectedFiles.forEach(function (file, index) {

            const fileItem = document.createElement('div');
            fileItem.classList.add('assignment-selected-file');

            const icon = document.createElement('i');
            icon.className = 'bx bx-file';

            const name = document.createElement('span');
            name.textContent = file.name;

            const size = document.createElement('small');
            size.textContent = formatFileSize(file.size);

            const removeButton = document.createElement('button');
            removeButton.type = 'button';
            removeButton.classList.add('assignment-new-file-remove');
            removeButton.innerHTML = '<i class="bx bx-x"></i>';
            removeButton.title = 'Remove file';

            removeButton.addEventListener('click', function () {

                selectedFiles.splice(index, 1);

                updateFileInput();
                renderSelectedFiles();

            });

            fileItem.appendChild(icon);
            fileItem.appendChild(name);
            fileItem.appendChild(size);
            fileItem.appendChild(removeButton);

            fileList.appendChild(fileItem);

        });

    }


    /* ------------------------------------------------------------
       FILE SIZE
       ------------------------------------------------------------ */

    function formatFileSize(bytes) {

        if (bytes === 0) {
            return '0 Bytes';
        }

        const units = ['Bytes', 'KB', 'MB', 'GB'];

        const i = Math.floor(
            Math.log(bytes) / Math.log(1024)
        );

        return (
            parseFloat(
                (bytes / Math.pow(1024, i)).toFixed(2)
            ) +
            ' ' +
            units[i]
        );

    }


    /* ------------------------------------------------------------
       DELETE EXISTING RESOURCE
       ------------------------------------------------------------ */

    const deleteButtons = document.querySelectorAll(
        '.assignment-resource-delete'
    );

    const deleteForm = document.getElementById(
        'assignment-resource-delete-form'
    );

    deleteButtons.forEach(function (button) {

        button.addEventListener('click', function () {

            const deleteUrl = this.dataset.deleteUrl;

            if (!deleteUrl || !deleteForm) {
                return;
            }

            const confirmed = confirm(
                'Are you sure you want to delete this attachment?'
            );

            if (!confirmed) {
                return;
            }

            deleteForm.action = deleteUrl;
            deleteForm.submit();

        });

    });

});
</script>

@endsection
