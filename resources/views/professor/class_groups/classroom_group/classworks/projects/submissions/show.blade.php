@extends('layouts.prof_layout')

@section('content')


<style>
/* ============================================================
   GROUP / PROJECT SUBMISSION
   Clean project-yellow theme
   ============================================================ */

.project-submission-page {
    --yellow: #eab308;
    --yellow-dark: #a16207;
    --yellow-soft: #fefce8;
    --yellow-tint: rgba(234, 179, 8, 0.06);
    --yellow-border: #fde68a;

    --blue: #2563eb;
    --blue-soft: #eff6ff;
    --blue-border: #bfdbfe;

    --green: #16a34a;
    --green-soft: #f0fdf4;
    --green-border: #bbf7d0;

    --red: #dc2626;

    --text: #0f172a;
    --text2: #334155;
    --muted: #64748b;
    --light: #94a3b8;

    --border: #e2e8f0;
    --border-light: #edf2f7;
    --surface: #ffffff;
    --soft: #f8fafc;

    width: 100%;
    max-width: 1240px;
    margin: 0 auto;
    padding: 22px 24px 42px;
    color: var(--text);
}

.project-submission-page *,
.project-submission-page *::before,
.project-submission-page *::after {
    box-sizing: border-box;
}

/* ============================================================
   HEADER
   ============================================================ */

.ps-header {
    margin-bottom: 20px;
}

.ps-back {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    margin-bottom: 18px;
    color: var(--muted);
    font-size: 15px;
    font-weight: 700;
    text-decoration: none;
    transition: color .18s ease, transform .18s ease;
}

.ps-back i {
    font-size: 20px;
}

.ps-back:hover {
    color: var(--yellow-dark);
    transform: translateX(-3px);
}

.ps-title-row {
    display: flex;
    align-items: center;
    gap: 14px;
}

.ps-title-icon {
    width: 58px;
    height: 58px;
    flex: 0 0 58px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    border: 1px solid var(--yellow-border);
    border-radius: 16px;
    background: var(--yellow-soft);
    color: var(--yellow-dark);
    font-size: 26px;
}

.ps-type {
    display: block;
    margin-bottom: 4px;
    color: var(--yellow-dark);
    font-size: 12px;
    font-weight: 800;
    letter-spacing: .12em;
    text-transform: uppercase;
}

.ps-title-row h1 {
    margin: 0;
    color: var(--text);
    font-size: 31px;
    line-height: 1.15;
    font-weight: 800;
    letter-spacing: -.025em;
    overflow-wrap: anywhere;
}

.ps-subtitle {
    margin-top: 6px;
    color: var(--muted);
    font-size: 14px;
}

/* ============================================================
   TEAM SUMMARY
   ============================================================ */

.ps-team-summary {
    margin-top: 18px;
    padding: 14px 16px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 18px;
    border: 1px solid var(--border);
    border-radius: 15px;
    background: #fff;
    box-shadow: 0 5px 18px rgba(15, 23, 42, .045);
}

.ps-team-summary-main {
    display: flex;
    align-items: center;
    gap: 11px;
    min-width: 0;
}

.ps-team-summary-icon {
    width: 42px;
    height: 42px;
    flex: 0 0 42px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    border-radius: 11px;
    background: rgba(234, 179, 8, .14);
    color: var(--yellow-dark);
    font-size: 21px;
}

.ps-team-summary-copy {
    min-width: 0;
}

.ps-team-summary-copy span {
    display: block;
    margin-bottom: 2px;
    color: var(--yellow-dark);
    font-size: 10px;
    font-weight: 800;
    letter-spacing: .12em;
}

.ps-team-summary-copy strong {
    display: block;
    color: var(--text2);
    font-size: 15px;
    font-weight: 800;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
}

.ps-team-summary-stats {
    display: flex;
    align-items: center;
    gap: 18px;
}

.ps-team-summary-stats > div {
    min-width: 62px;
    padding-left: 16px;
    border-left: 1px solid var(--border-light);
}

.ps-team-summary-stats span {
    display: block;
    color: var(--muted);
    font-size: 9px;
    font-weight: 800;
    letter-spacing: .09em;
}

.ps-team-summary-stats strong {
    display: block;
    margin-top: 2px;
    color: var(--text2);
    font-size: 14px;
    font-weight: 800;
}

/* ============================================================
   ALERT
   ============================================================ */

.ps-alert {
    display: flex;
    align-items: center;
    gap: 8px;
    margin-bottom: 14px;
    padding: 11px 14px;
    border: 1px solid var(--green-border);
    border-radius: 10px;
    background: var(--green-soft);
    color: var(--green);
    font-size: 13px;
    font-weight: 700;
}

.ps-alert i {
    font-size: 17px;
}

/* ============================================================
   LAYOUT
   ============================================================ */

.ps-grid {
    display: grid;
    grid-template-columns: minmax(0, 1fr) 315px;
    gap: 18px;
    align-items: start;
}

.ps-main,
.ps-sidebar {
    display: flex;
    flex-direction: column;
    gap: 15px;
    min-width: 0;
}

.ps-sidebar {
    position: sticky;
    top: 14px;
}

/* ============================================================
   CARD
   ============================================================ */

.ps-card {
    overflow: hidden;
    border: 1px solid var(--border);
    border-radius: 17px;
    background: var(--surface);
    box-shadow: 0 5px 20px rgba(15, 23, 42, .045);
}

.ps-card-header {
    min-height: 54px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 12px;
    padding: 14px 18px;
    border-bottom: 1px solid var(--border-light);
}

.ps-card-header h2 {
    margin: 0;
    color: var(--text);
    font-size: 16px;
    font-weight: 800;
}

.ps-card-header h2::before {
    content: "";
    display: inline-block;
    width: 4px;
    height: 16px;
    margin-right: 9px;
    vertical-align: -3px;
    border-radius: 999px;
    background: var(--yellow);
}

.ps-card-body {
    padding: 18px;
}

/* ============================================================
   STATUS
   ============================================================ */

.ps-status {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 6px;
    flex-shrink: 0;
    padding: 6px 10px;
    border-radius: 999px;
    font-size: 11px;
    font-weight: 800;
}

.ps-status.submitted {
    color: var(--green);
    background: var(--green-soft);
}

.ps-status.draft {
    color: var(--muted);
    background: var(--soft);
}

.ps-status.graded {
    color: var(--blue);
    background: var(--blue-soft);
}

/* ============================================================
   SUBMISSION INFO
   ============================================================ */

.ps-submitter {
    display: flex;
    align-items: center;
    gap: 12px;
}

.ps-avatar {
    width: 46px;
    height: 46px;
    flex: 0 0 46px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    border: 1px solid var(--yellow-border);
    border-radius: 12px;
    background: var(--yellow-soft);
    color: var(--yellow-dark);
    font-size: 20px;
}

.ps-submitter-info {
    min-width: 0;
}

.ps-submitter-info strong {
    display: block;
    color: var(--text);
    font-size: 15px;
    font-weight: 800;
    overflow-wrap: anywhere;
}

.ps-submitter-info span {
    display: block;
    margin-top: 3px;
    color: var(--muted);
    font-size: 12px;
}

/* ============================================================
   TEAM CARD
   ============================================================ */

.ps-team-card {
    border-color: var(--border);
}

.ps-team-card .ps-card-header {
    background: #fff;
}

.ps-team-grid {
    display: grid;
    grid-template-columns: repeat(2, minmax(0, 1fr));
    gap: 10px;
}

.ps-member {
    display: flex;
    align-items: center;
    gap: 10px;
    min-width: 0;
    padding: 11px;
    border: 1px solid var(--border);
    border-radius: 12px;
    background: var(--soft);
    transition: border-color .18s ease, background-color .18s ease, transform .18s ease;
}

.ps-member:hover {
    border-color: var(--border);
    background: #fff;
    transform: translateY(-1px);
}

.ps-member-avatar {
    width: 38px;
    height: 38px;
    flex: 0 0 38px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    border-radius: 10px;
    background: #fff;
    color: var(--muted);
    font-size: 17px;
}

.ps-member-info {
    min-width: 0;
    flex: 1;
}

.ps-member-info strong {
    display: block;
    color: var(--text2);
    font-size: 12px;
    font-weight: 800;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
}

.ps-member-info span {
    display: block;
    margin-top: 2px;
    color: var(--muted);
    font-size: 10px;
}

.ps-role {
    display: inline-flex;
    align-items: center;
    padding: 4px 7px;
    border-radius: 7px;
    background: var(--yellow-soft);
    color: var(--yellow-dark);
    font-size: 9px;
    font-weight: 800;
    text-transform: uppercase;
}

/* ============================================================
   FILES
   ============================================================ */

.ps-files {
    display: flex;
    flex-direction: column;
    gap: 9px;
}

.ps-file {
    display: flex;
    align-items: center;
    gap: 10px;
    min-width: 0;
    padding: 11px;
    border: 1px solid var(--border);
    border-radius: 12px;
    background: var(--soft);
    transition: border-color .18s ease, background-color .18s ease, transform .18s ease;
}

.ps-file:hover {
    border-color: var(--border);
    background: #fff;
    transform: translateY(-1px);
}

.ps-file-icon {
    width: 40px;
    height: 40px;
    flex: 0 0 40px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    border: 1px solid var(--yellow-border);
    border-radius: 10px;
    background: var(--yellow-soft);
    color: var(--yellow-dark);
    font-size: 18px;
}

.ps-file-info {
    min-width: 0;
    flex: 1;
}

.ps-file-info strong {
    display: block;
    color: var(--text2);
    font-size: 13px;
    font-weight: 750;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
}

.ps-file-info span {
    display: block;
    margin-top: 2px;
    color: var(--light);
    font-size: 10px;
}

.ps-file-actions {
    display: flex;
    align-items: center;
    gap: 6px;
    flex-shrink: 0;
}

.ps-file-btn {
    min-height: 33px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 5px;
    padding: 0 10px;
    border: 1px solid var(--blue-border);
    border-radius: 8px;
    background: #fff;
    color: var(--blue);
    text-decoration: none;
    font-size: 11px;
    font-weight: 800;
    cursor: pointer;
    transition: background-color .18s ease, transform .18s ease;
}

.ps-file-btn:hover {
    background: var(--blue-soft);
    transform: translateY(-1px);
}

.ps-file-btn i {
    font-size: 16px;
}

.ps-empty {
    min-height: 115px;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    padding: 22px;
    border: 1px dashed var(--border);
    border-radius: 11px;
    background: var(--soft);
    text-align: center;
}

.ps-empty i {
    margin-bottom: 7px;
    color: var(--light);
    font-size: 27px;
}

.ps-empty p {
    margin: 0;
    color: var(--muted);
    font-size: 12px;
}

/* ============================================================
   PROJECT DETAILS
   ============================================================ */

.ps-info-list {
    display: flex;
    flex-direction: column;
}

.ps-info-item {
    display: flex;
    align-items: center;
    gap: 10px;
    padding: 12px 16px;
    border-bottom: 1px solid var(--border-light);
}

.ps-info-item:last-child {
    border-bottom: 0;
}

.ps-info-icon {
    width: 34px;
    height: 34px;
    flex: 0 0 34px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    border-radius: 9px;
    background: var(--yellow-soft);
    color: var(--yellow-dark);
    font-size: 16px;
}

.ps-info-item div {
    min-width: 0;
}

.ps-info-item span {
    display: block;
    color: var(--muted);
    font-size: 10px;
}

.ps-info-item strong {
    display: block;
    margin-top: 1px;
    color: var(--text2);
    font-size: 13px;
    font-weight: 800;
    overflow-wrap: anywhere;
}

/* ============================================================
   GRADE TEAM CARD
   ============================================================ */

.ps-grade-team-card {
    border-color: var(--border);
    box-shadow: 0 8px 24px rgba(15, 23, 42, .05);
}

.ps-grade-team-card .ps-card-header {
    background: #fff;
}

.ps-grade-mode {
    display: grid;
    grid-template-columns: repeat(2, minmax(0, 1fr));
    gap: 9px;
    margin-bottom: 14px;
}

.ps-grade-mode-option {
    position: relative;
}

.ps-grade-mode-option input {
    position: absolute;
    opacity: 0;
    pointer-events: none;
}

.ps-grade-mode-label {
    display: flex;
    align-items: flex-start;
    gap: 9px;
    min-height: 78px;
    padding: 11px;
    border: 1px solid var(--border);
    border-radius: 11px;
    background: var(--surface);
    cursor: pointer;
    transition: border-color .18s ease, background-color .18s ease, box-shadow .18s ease;
}

.ps-grade-mode-label:hover {
    border-color: var(--border);
}

.ps-grade-mode-option input:checked + .ps-grade-mode-label {
    border-color: var(--yellow);
    background: var(--yellow-soft);
    box-shadow: 0 0 0 2px rgba(234,179,8,.08);
}

.ps-grade-mode-icon {
    width: 34px;
    height: 34px;
    flex: 0 0 34px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    border-radius: 9px;
    background: var(--soft);
    color: var(--muted);
    font-size: 17px;
}

.ps-grade-mode-option input:checked + .ps-grade-mode-label .ps-grade-mode-icon {
    background: var(--yellow);
    color: #fff;
}

.ps-grade-mode-copy {
    min-width: 0;
}

.ps-grade-mode-copy strong {
    display: block;
    color: var(--text2);
    font-size: 12px;
    font-weight: 800;
}

.ps-grade-mode-copy span {
    display: block;
    margin-top: 3px;
    color: var(--muted);
    font-size: 10px;
    line-height: 1.45;
}

.ps-grade-panel,
.ps-grade-edit-panel {
    display: none;
}

.ps-grade-panel.is-active,
.ps-grade-edit-panel.is-active {
    display: block;
}

.ps-grade-box {
    padding: 14px;
    border: 1px solid var(--border);
    border-radius: 12px;
    background: var(--yellow-soft);
}

.ps-grade-current {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 12px;
    margin-bottom: 14px;
}

.ps-grade-current span {
    color: var(--muted);
    font-size: 11px;
}

.ps-grade-current strong {
    color: var(--yellow-dark);
    font-size: 22px;
    font-weight: 850;
    text-align: right;
}

.ps-form-group {
    margin-bottom: 12px;
}

.ps-form-label {
    display: block;
    margin-bottom: 6px;
    color: var(--text2);
    font-size: 11px;
    font-weight: 800;
}

.ps-input,
.ps-textarea {
    width: 100%;
    border: 1px solid var(--border);
    border-radius: 9px;
    background: #fff;
    color: var(--text);
    font-family: inherit;
    font-size: 13px;
    outline: none;
    transition: border-color .18s ease, box-shadow .18s ease;
}

.ps-input {
    height: 40px;
    padding: 0 11px;
}

.ps-textarea {
    min-height: 86px;
    padding: 10px 11px;
    resize: vertical;
}

.ps-input:focus,
.ps-textarea:focus {
    border-color: var(--yellow);
    box-shadow: 0 0 0 3px rgba(234,179,8,.12);
}

.ps-error {
    margin-top: 5px;
    color: var(--red);
    font-size: 10px;
}

.ps-btn {
    width: 100%;
    min-height: 41px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 7px;
    border: 1px solid transparent;
    border-radius: 9px;
    cursor: pointer;
    font-family: inherit;
    font-size: 12px;
    font-weight: 800;
    transition: background-color .18s ease, transform .18s ease, box-shadow .18s ease;
}

.ps-btn-yellow {
    background: var(--yellow);
    border-color: var(--yellow);
    color: #fff;
}

.ps-btn-yellow:hover {
    background: var(--yellow-dark);
    border-color: var(--yellow-dark);
    transform: translateY(-1px);
    box-shadow: 0 6px 15px rgba(234,179,8,.20);
}

.ps-btn-blue {
    background: var(--blue);
    border-color: var(--blue);
    color: #fff;
}

.ps-btn-blue:hover {
    background: #1d4ed8;
    transform: translateY(-1px);
}

/* Graded team result */
.ps-graded-view {
    display: flex;
    flex-direction: column;
    gap: 10px;
}

.ps-graded-score {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 12px;
    padding: 14px;
    border: 1px solid var(--border);
    border-radius: 11px;
    background: var(--yellow-soft);
}

.ps-graded-score-label {
    color: var(--muted);
    font-size: 10px;
    font-weight: 800;
    text-transform: uppercase;
}

.ps-graded-score-value {
    color: var(--yellow-dark);
    font-size: 25px;
    font-weight: 850;
}

.ps-graded-feedback {
    padding: 12px 14px;
    border: 1px solid var(--border);
    border-radius: 10px;
    background: var(--soft);
}

.ps-graded-feedback-label {
    display: block;
    margin-bottom: 5px;
    color: var(--muted);
    font-size: 10px;
    font-weight: 800;
}

.ps-graded-feedback-text {
    color: var(--text2);
    font-size: 12px;
    line-height: 1.55;
    white-space: pre-wrap;
}

.ps-edit-grade-btn {
    width: 100%;
    min-height: 40px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 7px;
    border: 1px solid var(--blue-border);
    border-radius: 9px;
    background: var(--blue-soft);
    color: var(--blue);
    cursor: pointer;
    font-family: inherit;
    font-size: 12px;
    font-weight: 800;
    transition: background-color .18s ease, color .18s ease, transform .18s ease;
}

.ps-edit-grade-btn:hover {
    background: var(--blue);
    color: #fff;
    transform: translateY(-1px);
}

/* Manual graded list */
.ps-manual-graded-list {
    display: flex;
    flex-direction: column;
    gap: 8px;
}

.ps-manual-graded-item {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 10px;
    padding: 11px 12px;
    border: 1px solid var(--border);
    border-radius: 10px;
    background: var(--soft);
}

.ps-manual-graded-student {
    min-width: 0;
}

.ps-manual-graded-student strong {
    display: block;
    color: var(--text2);
    font-size: 12px;
    font-weight: 800;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
}

.ps-manual-graded-student span {
    display: block;
    margin-top: 2px;
    color: var(--muted);
    font-size: 10px;
}

.ps-manual-graded-score {
    flex: 0 0 auto;
    color: var(--yellow-dark);
    font-size: 16px;
    font-weight: 850;
}

.ps-grade-panel-heading {
    margin-bottom: 10px;
}

.ps-grade-panel-heading strong {
    display: block;
    color: var(--text2);
    font-size: 12px;
    font-weight: 800;
}

.ps-grade-panel-heading span {
    display: block;
    margin-top: 3px;
    color: var(--muted);
    font-size: 10px;
}

/* ============================================================
   FILE VIEWER MODAL
   ============================================================ */

.ps-modal {
    position: fixed;
    inset: 0;
    z-index: 9999;
    display: none;
    align-items: center;
    justify-content: center;
    padding: 22px;
    background: rgba(2, 6, 23, .78);
    backdrop-filter: blur(3px);
    -webkit-backdrop-filter: blur(3px);
}

.ps-modal.active {
    display: flex;
}

.ps-modal-container {
    position: relative;
    width: min(1200px, 100%);
    height: min(850px, 92vh);
    display: flex;
    flex-direction: column;
    overflow: hidden;
    border: 1px solid rgba(255,255,255,.08);
    border-radius: 15px;
    background: #fff;
    box-shadow: 0 24px 70px rgba(0,0,0,.35);
}

.ps-modal.fullscreen {
    padding: 0;
    align-items: stretch;
    justify-content: stretch;
}

.ps-modal.fullscreen .ps-modal-container {
    width: 100vw;
    height: 100vh;
    max-width: none;
    max-height: none;
    border-radius: 0;
}

.ps-modal-header {
    min-height: 58px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 14px;
    padding: 0 14px 0 17px;
    border-bottom: 1px solid var(--border);
    background: #fff;
    flex-shrink: 0;
}

.ps-modal-title {
    display: flex;
    align-items: center;
    gap: 9px;
    min-width: 0;
    color: var(--text2);
    font-size: 14px;
    font-weight: 800;
}

.ps-modal-title i {
    flex: 0 0 auto;
    color: var(--yellow-dark);
    font-size: 19px;
}

.ps-modal-title span {
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
}

.ps-modal-actions {
    display: flex;
    align-items: center;
    gap: 6px;
    flex-shrink: 0;
}

.ps-modal-action {
    width: 36px;
    height: 36px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    border: 1px solid var(--border);
    border-radius: 9px;
    background: #fff;
    color: var(--muted);
    cursor: pointer;
    transition: background-color .18s ease, border-color .18s ease, color .18s ease, transform .18s ease;
}

.ps-modal-action i {
    font-size: 19px;
}

.ps-modal-action:hover {
    border-color: var(--yellow-border);
    background: var(--yellow-soft);
    color: var(--yellow-dark);
    transform: translateY(-1px);
}

.ps-modal-close:hover {
    border-color: #fecaca;
    background: #fef2f2;
    color: #dc2626;
}

.ps-modal-body {
    flex: 1;
    min-height: 0;
    background: #171717;
}

.ps-modal-body iframe {
    width: 100%;
    height: 100%;
    display: block;
    border: 0;
    background: #fff;
}

/* ============================================================
   DARK MODE
   ============================================================ */

.dark-mode .project-submission-page {
    --yellow: #facc15;
    --yellow-dark: #fde047;
    --yellow-soft: rgba(250,204,21,.10);
    --yellow-tint: rgba(250,204,21,.06);
    --yellow-border: rgba(250,204,21,.30);

    --blue: #7c83ff;
    --blue-soft: rgba(124,131,255,.12);
    --blue-border: rgba(124,131,255,.30);

    --green: #49d5a7;
    --green-soft: rgba(73,213,167,.10);
    --green-border: rgba(73,213,167,.30);

    --text: #f4f5ff;
    --text2: #e6e8f7;
    --muted: #a1a4cc;
    --light: #9295bd;
    --border: #2b2e52;
    --border-light: #252847;
    --surface: #171933;
    --soft: #12142a;

    color: var(--text);
}

.dark-mode .project-submission-page .ps-team-summary {
    background: var(--surface);
}

.dark-mode .project-submission-page .ps-file-btn,
.dark-mode .project-submission-page .ps-modal-header,
.dark-mode .project-submission-page .ps-modal-action,
.dark-mode .project-submission-page .ps-input,
.dark-mode .project-submission-page .ps-textarea,
.dark-mode .project-submission-page .ps-member-avatar,
.dark-mode .project-submission-page .ps-file {
    background: var(--surface);
    color: var(--text);
}

.dark-mode .project-submission-page .ps-modal-container {
    background: var(--surface);
}

/* ============================================================
   RESPONSIVE
   ============================================================ */

@media (max-width: 980px) {
    .ps-grid {
        grid-template-columns: 1fr;
    }

    .ps-sidebar {
        position: static;
    }
}

@media (max-width: 700px) {
    .project-submission-page {
        padding: 18px 16px 34px;
    }

    .ps-title-icon {
        width: 52px;
        height: 52px;
        flex-basis: 52px;
        font-size: 23px;
    }

    .ps-title-row h1 {
        font-size: 26px;
    }

    .ps-team-summary {
        align-items: flex-start;
        flex-direction: column;
    }

    .ps-team-summary-stats {
        width: 100%;
        justify-content: space-between;
    }

    .ps-team-summary-stats > div {
        flex: 1;
    }

    .ps-team-grid {
        grid-template-columns: 1fr;
    }

    .ps-file {
        align-items: flex-start;
        flex-wrap: wrap;
    }

    .ps-file-actions {
        width: 100%;
        padding-left: 50px;
    }

    .ps-file-btn {
        flex: 1;
    }

    .ps-grade-mode {
        grid-template-columns: 1fr;
    }

    .ps-modal {
        padding: 10px;
    }

    .ps-modal-container {
        height: 94vh;
        border-radius: 13px;
    }
}

@media (max-width: 480px) {
    .project-submission-page {
        padding: 16px 14px 28px;
    }

    .ps-header {
        margin-bottom: 18px;
    }

    .ps-back {
        margin-bottom: 16px;
        font-size: 14px;
    }

    .ps-title-row {
        align-items: flex-start;
        gap: 11px;
    }

    .ps-title-icon {
        width: 46px;
        height: 46px;
        flex-basis: 46px;
        border-radius: 12px;
        font-size: 20px;
    }

    .ps-type {
        font-size: 11px;
    }

    .ps-title-row h1 {
        font-size: 22px;
    }

    .ps-subtitle {
        font-size: 12px;
    }

    .ps-team-summary {
        padding: 13px;
    }

    .ps-team-summary-stats {
        gap: 6px;
    }

    .ps-team-summary-stats > div {
        padding-left: 9px;
        min-width: 0;
    }

    .ps-card {
        border-radius: 14px;
    }

    .ps-card-header {
        padding: 15px;
    }

    .ps-card-header h2 {
        font-size: 15px;
    }

    .ps-card-body {
        padding: 15px;
    }

    .ps-info-item {
        padding: 11px 14px;
    }

    .ps-member {
        padding: 10px;
    }

    .ps-file-actions {
        padding-left: 0;
    }

    .ps-graded-score-value {
        font-size: 22px;
    }

    .ps-grade-current {
        align-items: flex-start;
        flex-direction: column;
        gap: 3px;
    }

    .ps-grade-current strong {
        text-align: left;
    }

    .ps-modal {
        padding: 0;
    }

    .ps-modal-container {
        width: 100vw;
        height: 100vh;
        border-radius: 0;
    }

    .ps-modal-header {
        min-height: 54px;
        padding: 0 10px 0 12px;
    }

    .ps-modal-action {
        width: 34px;
        height: 34px;
    }
}
</style>

@php
    // Preserve where the professor entered this submission.
    // Stream    -> stream
    // Classwork -> classwork
    $returnTo = request(
        'return_to',
        request('origin', 'stream')
    );

    if (!in_array($returnTo, ['stream', 'classwork'], true)) {
        $returnTo = 'stream';
    }
@endphp
<div class="project-submission-page team-submission-page">
    @if(session('success'))
    <div class="ps-alert"><i class="bx bx-check-circle"></i>{{ session('success') }}</div>
    @endif

    <div class="ps-header">
<a
    class="ps-back"
    href="{{ route('professor.classworks.projects.show', [
        'classGroupId' => $classGroup->id,
        'projectId' => $project->id,
        'return_to' => $returnTo,
    ]) }}"
>
    <i class="bx bx-arrow-back"></i>
    Back to Project
</a>
      <div class="ps-title-row">
            <div class="ps-title-icon"><i class="bx {{ $project->project_type === 'team' ? 'bx-group' : 'bx-task' }}"></i></div>
            <div>
                <span class="ps-type">Project Submission</span>
                <h1>{{ $project->title }}</h1>
                <div class="ps-subtitle">{{ $project->project_type === 'team' ? 'Team project submission' : 'Individual project submission' }}</div>
            </div>
        </div>

        @if($project->project_type === 'team' && $submission->projectGroup)
            <div class="ps-team-summary">
                <div class="ps-team-summary-main">
                    <div class="ps-team-summary-icon">
                        <i class="bx bx-group"></i>
                    </div>
                    <div class="ps-team-summary-copy">
                        <span>TEAM SUBMISSION</span>
                        <strong>{{ $submission->projectGroup->group_name }}</strong>
                    </div>
                </div>

                <div class="ps-team-summary-stats">
                    <div>
                        <span>TEAM</span>
                        <strong>{{ $submission->projectGroup->group_number }}</strong>
                    </div>
                    <div>
                        <span>MEMBERS</span>
                        <strong>{{ $submission->projectGroup->members->count() }}</strong>
                    </div>
                    <div>
                        <span>POINTS</span>
                        <strong>{{ rtrim(rtrim(number_format($project->points, 2), '0'), '.') }}</strong>
                    </div>
                </div>
            </div>
        @endif
    </div>

    <div class="ps-grid">
        <main class="ps-main">

            <section class="ps-card">
                <div class="ps-card-header">
                    <h2>Submission Information</h2>
                    @if($submission->score !== null || $submission->grades->whereNotNull('score')->isNotEmpty())
                    <span class="ps-status graded"><i class="bx bx-check-circle"></i>Graded</span>
                    @elseif($submission->submitted_at)
                    <span class="ps-status submitted"><i class="bx bx-check"></i>Submitted</span>
                    @else
                    <span class="ps-status draft"><i class="bx bx-time-five"></i>Draft</span>
                    @endif
                </div>
                <div class="ps-card-body">
                    <div class="ps-submitter">
                        <div class="ps-avatar"><i class="bx bx-user"></i></div>
                        <div class="ps-submitter-info">
                            <strong>{{ $submission->student->name ?? 'Unknown Student' }}</strong>
                            <span>Submitted {{ $submission->submitted_at ? $submission->submitted_at->format('M d, Y \a\t h:i A') : 'Not submitted yet' }}</span>
                        </div>
                    </div>
                </div>
            </section>

            @if($project->project_type === 'team' && $submission->projectGroup)
            @php
            $team = $submission->projectGroup;
            $leader = $team->members->firstWhere('role','leader');
            $backup = $team->members->firstWhere('role','backup');
            @endphp
            <section class="ps-card ps-team-card">
                <div class="ps-card-header">
                    <h2>{{ $team->group_name }}</h2><span class="ps-status submitted">Team {{ $team->group_number }}</span>
                </div>
                <div class="ps-card-body">
                    <div class="ps-team-grid">
                        @foreach($team->members as $member)
                        <div class="ps-member">
                            <div class="ps-member-avatar"><i class="bx bx-user"></i></div>
                            <div class="ps-member-info">
                                <strong>{{ $member->user->name ?? 'Unknown Student' }}</strong>
                                <span>{{ $member->role === 'leader' ? 'Team Leader' : ($member->role === 'backup' ? 'Backup Submitter' : 'Team Member') }}</span>
                            </div>
                            @if($member->role === 'leader')<span class="ps-role">Leader</span>@elseif($member->role === 'backup')<span class="ps-role">Backup</span>@endif
                        </div>
                        @endforeach
                    </div>
                </div>
            </section>
            @endif

            <section class="ps-card">
                <div class="ps-card-header">
                    <h2>Submitted Files</h2>
                </div>
                <div class="ps-card-body">
                    @if($submission->resources->isNotEmpty())
                    <div class="ps-files">
                        @foreach($submission->resources as $resource)
                        <div class="ps-file">
                            <div class="ps-file-icon"><i class="bx bx-file"></i></div>
                            <div class="ps-file-info">
                                <strong>{{ $resource->file_name ?? $resource->title }}</strong>
                                <span>{{ $resource->file_size ? number_format($resource->file_size / 1024,1).' KB' : 'Submitted file' }}</span>
                            </div>
                            <div class="ps-file-actions">
                                <button
                                    type="button"
                                    class="ps-file-btn"
                                    data-file-url="{{ route('professor.classworks.projects.submissions.resources.view', [
                                                'classGroupId' => $classGroup->id,
                                                'projectId' => $project->id,
                                                'submissionId' => $submission->id,
                                                'resourceId' => $resource->id,
                                            ]) }}"
                                    data-file-name="{{ $resource->file_name ?? $resource->title }}"
                                    onclick="openProjectSubmissionFile(this.dataset.fileUrl, this.dataset.fileName)">
                                    <i class="bx bx-show"></i>
                                    View
                                </button>
                                <a href="{{ route('professor.classworks.projects.submissions.resources.download',['classGroupId'=>$classGroup->id,'projectId'=>$project->id,'submissionId'=>$submission->id,'resourceId'=>$resource->id]) }}" class="ps-file-btn"><i class="bx bx-download"></i>Download</a>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    @else
                    <div class="ps-empty"><i class="bx bx-file"></i>
                        <p>No files were submitted.</p>
                    </div>
                    @endif
                </div>
            </section>

            @if($project->project_type === 'team' && $submission->projectGroup)

            @php
            $memberGradeMap = $submission->grades->keyBy('student_id');

            $teamScores = $submission->grades
            ->whereNotNull('score')
            ->pluck('score')
            ->unique()
            ->values();

            $sameTeamScore = $teamScores->count() === 1
            ? $teamScores->first()
            : null;

            $teamFeedback = $submission->grades
            ->pluck('feedback')
            ->filter(fn($feedback) => filled($feedback))
            ->first();

            $manualGradesComplete = $team->members->count() > 0
            && $team->members->every(function ($member) use ($memberGradeMap) {
            return $memberGradeMap->get($member->user_id)?->score !== null;
            });

            $isTeamGraded = $sameTeamScore !== null;

            @endphp

            <section class="ps-card ps-grade-team-card ps-grade-team-left">

                <div class="ps-card-header">
                    <h2>Grade Team</h2>
                </div>

                <div class="ps-card-body">

                    {{-- ============================================================
             GRADING MODE
        ============================================================= --}}

                    <div class="ps-grade-mode">

                        <div class="ps-grade-mode-option">

                            <input
                                type="radio"
                                id="gradeModeTeam"
                                name="grade_mode"
                                value="team"
                                {{ $isTeamGraded ? 'checked' : (!$manualGradesComplete ? 'checked' : '') }}>

                            <label
                                for="gradeModeTeam"
                                class="ps-grade-mode-label">

                                <span class="ps-grade-mode-icon">
                                    <i class="bx bx-group"></i>
                                </span>

                                <span class="ps-grade-mode-copy">
                                    <strong>Grade by Team</strong>
                                    <span>
                                        Give every member the same score.
                                    </span>
                                </span>

                            </label>

                        </div>


                        <div class="ps-grade-mode-option">

                            <input
                                type="radio"
                                id="gradeModeManual"
                                name="grade_mode"
                                value="manual"
                                {{ !$isTeamGraded && $manualGradesComplete ? 'checked' : '' }}>

                            <label
                                for="gradeModeManual"
                                class="ps-grade-mode-label">

                                <span class="ps-grade-mode-icon">
                                    <i class="bx bx-edit"></i>
                                </span>

                                <span class="ps-grade-mode-copy">
                                    <strong>Grade Manually</strong>
                                    <span>
                                        Give each student a different score.
                                    </span>
                                </span>

                            </label>

                        </div>

                    </div>


                    {{-- ============================================================
             GRADE BY TEAM
        ============================================================= --}}

                    <div
                        id="gradeByTeamPanel"
                        class="ps-grade-panel {{ $isTeamGraded ? 'is-active' : (!$manualGradesComplete ? 'is-active' : '') }}">

                        {{-- ==================== GRADED VIEW ==================== --}}

                        <div
                            id="teamGradedView"
                            class="ps-grade-edit-panel {{ $isTeamGraded ? 'is-active' : '' }}">

                            <div class="ps-graded-view">

                                <div class="ps-graded-score">

                                    <div>
                                        <span class="ps-graded-score-label">
                                            Team Grade
                                        </span>
                                    </div>

                                    <div class="ps-graded-score-value">

                                        {{
                                rtrim(
                                    rtrim(
                                        number_format($sameTeamScore ?? 0, 2),
                                        '0'
                                    ),
                                    '.'
                                )
                            }}

                                        /

                                        {{
                                rtrim(
                                    rtrim(
                                        number_format($project->points, 2),
                                        '0'
                                    ),
                                    '.'
                                )
                            }}

                                    </div>

                                </div>


                                <div class="ps-graded-feedback">

                                    <span class="ps-graded-feedback-label">
                                        Feedback
                                    </span>

                                    <div class="ps-graded-feedback-text">
                                        {{ $teamFeedback ?: 'No feedback provided.' }}
                                    </div>

                                </div>


                                <button
                                    type="button"
                                    class="ps-edit-grade-btn"
                                    id="editTeamGradeButton">
                                    <i class="bx bx-edit"></i>
                                    Edit Score & Feedback
                                </button>

                            </div>

                        </div>


                        {{-- ==================== EDIT FORM ==================== --}}

                        <div
                            id="teamGradeEditPanel"
                            class="ps-grade-edit-panel {{ $isTeamGraded ? '' : 'is-active' }}">

                            <div class="ps-grade-box">

                                <div class="ps-grade-current">

                                    <span>
                                        Same score for every team member
                                    </span>

                                    <strong>
                                        {{
                                $sameTeamScore !== null
                                    ? rtrim(
                                        rtrim(
                                            number_format(
                                                $sameTeamScore,
                                                2
                                            ),
                                            '0'
                                        ),
                                        '.'
                                    )
                                    : '—'
                            }}

                                        /

                                        {{
                                rtrim(
                                    rtrim(
                                        number_format(
                                            $project->points,
                                            2
                                        ),
                                        '0'
                                    ),
                                    '.'
                                )
                            }}
                                    </strong>

                                </div>


                                <form
                                    method="POST"
                                    action="{{ route(
                            'professor.classworks.projects.submissions.grade-team',
                            [
                                'classGroupId' => $classGroup->id,
                                'projectId' => $project->id,
                                'submissionId' => $submission->id
                            ]
                        ) }}">

                                    
                                    <input type="hidden" name="return_to" value="{{ $returnTo }}">
                                    @csrf
                                    @method('PUT')


                                    <div class="ps-form-group">

                                        <label class="ps-form-label">
                                            Team Score
                                        </label>

                                        <input
                                            type="number"
                                            name="score"
                                            class="ps-input"
                                            min="0"
                                            max="{{ $project->points }}"
                                            step="0.01"
                                            value="{{ old('score', $sameTeamScore) }}"
                                            required>

                                        @error('score')
                                        <div class="ps-error">
                                            {{ $message }}
                                        </div>
                                        @enderror

                                    </div>


                                    <div class="ps-form-group">

                                        <label class="ps-form-label">
                                            Feedback
                                        </label>

                                        <textarea
                                            name="feedback"
                                            class="ps-textarea"
                                            placeholder="Feedback for the whole team...">{{ old('feedback', $teamFeedback) }}</textarea>

                                    </div>


                                    <button
                                        type="submit"
                                        class="ps-btn ps-btn-yellow">
                                        <i class="bx bx-check"></i>
                                        Save Grade
                                    </button>

                                </form>

                            </div>

                        </div>

                    </div>


                    {{-- ============================================================
             MANUAL GRADING
        ============================================================= --}}

                    <div
                        id="gradeManuallyPanel"
                        class="ps-grade-panel {{ !$isTeamGraded && $manualGradesComplete ? 'is-active' : '' }}">

                        {{-- ==================== GRADED VIEW ==================== --}}

                        <div
                            id="manualGradedView"
                            class="ps-grade-edit-panel {{ $manualGradesComplete ? 'is-active' : '' }}">

                            <div class="ps-manual-graded-list">

                                @foreach($team->members as $member)

                                @php
                                $existingGrade =
                                $memberGradeMap->get(
                                $member->user_id
                                );
                                @endphp

                                <div class="ps-manual-graded-item">

                                    <div class="ps-manual-graded-student">

                                        <strong>
                                            {{ $member->user->name ?? 'Unknown Student' }}
                                        </strong>

                                        <span>
                                            {{
                                        $member->role === 'leader'
                                            ? 'Team Leader'
                                            : (
                                                $member->role === 'backup'
                                                    ? 'Backup Submitter'
                                                    : 'Team Member'
                                            )
                                    }}
                                        </span>

                                    </div>

                                    <div class="ps-manual-graded-score">

                                        {{
                                    $existingGrade?->score !== null
                                        ? rtrim(
                                            rtrim(
                                                number_format(
                                                    $existingGrade->score,
                                                    2
                                                ),
                                                '0'
                                            ),
                                            '.'
                                        )
                                        : '—'
                                }}

                                        /

                                        {{
                                    rtrim(
                                        rtrim(
                                            number_format(
                                                $project->points,
                                                2
                                            ),
                                            '0'
                                        ),
                                        '.'
                                    )
                                }}

                                    </div>

                                </div>

                                @endforeach

                            </div>


                            <div style="margin-top:12px;">

                                <button
                                    type="button"
                                    class="ps-edit-grade-btn"
                                    id="editManualGradeButton">
                                    <i class="bx bx-edit"></i>
                                    Edit Grades & Feedback
                                </button>

                            </div>

                        </div>


                        {{-- ==================== EDIT FORM ==================== --}}

                        <div
                            id="manualGradeEditPanel"
                            class="ps-grade-edit-panel {{ !$manualGradesComplete ? 'is-active' : '' }}">

                            <div class="ps-grade-panel-heading">

                                <strong>
                                    Grade Each Student
                                </strong>

                                <span>
                                    Each team member can receive a different score.
                                </span>

                            </div>


                            <form
                                method="POST"
                                action="{{ route(
                        'professor.classworks.projects.submissions.grade-members',
                        [
                            'classGroupId' => $classGroup->id,
                            'projectId' => $project->id,
                            'submissionId' => $submission->id
                        ]
                    ) }}">

                                
                                    <input type="hidden" name="return_to" value="{{ $returnTo }}">
                                    @csrf
                                @method('PUT')


                                @foreach($team->members as $member)

                                @php
                                $existingGrade =
                                $memberGradeMap->get(
                                $member->user_id
                                );
                                @endphp


                                <div class="ps-grade-member">

                                    <div class="ps-grade-member-name">

                                        <strong>
                                            {{ $member->user->name ?? 'Unknown Student' }}
                                        </strong>

                                        <span>
                                            {{
                                        $member->role === 'leader'
                                            ? 'Team Leader'
                                            : (
                                                $member->role === 'backup'
                                                    ? 'Backup Submitter'
                                                    : 'Team Member'
                                            )
                                    }}
                                        </span>

                                    </div>


                                    <div class="ps-form-group">

                                        <label class="ps-form-label">
                                            Score
                                        </label>

                                        <input
                                            type="number"
                                            name="grades[{{ $member->user_id }}][score]"
                                            class="ps-input"
                                            min="0"
                                            max="{{ $project->points }}"
                                            step="0.01"
                                            value="{{ old(
                                        'grades.' . $member->user_id . '.score',
                                        $existingGrade?->score
                                    ) }}"
                                            required>

                                    </div>

                                </div>


                                <div class="ps-form-group">

                                    <label class="ps-form-label">
                                        Feedback for
                                        {{ $member->user->name ?? 'student' }}
                                    </label>

                                    <textarea
                                        name="grades[{{ $member->user_id }}][feedback]"
                                        class="ps-textarea"
                                        placeholder="Optional feedback...">{{ old(
                                'grades.' . $member->user_id . '.feedback',
                                $existingGrade?->feedback
                            ) }}</textarea>

                                </div>

                                @endforeach


                                <button
                                    type="submit"
                                    class="ps-btn ps-btn-blue">
                                    <i class="bx bx-check"></i>
                                    Save Member Grades
                                </button>

                            </form>

                        </div>

                    </div>

                </div>

            </section>

            @endif

            @if($project->project_type === 'individual')
            <section class="ps-card">
                <div class="ps-card-header">
                    <h2>Grade Submission</h2>
                </div>
                <div class="ps-card-body">
                    <div class="ps-grade-box">
                        <div class="ps-grade-current">
                            <span>Current Grade</span>
                            <strong>{{ $submission->score !== null ? rtrim(rtrim(number_format($submission->score,2),'0'),'.') : '—' }} / {{ rtrim(rtrim(number_format($project->points,2),'0'),'.') }}</strong>
                        </div>
                        <form method="POST" action="{{ route('professor.classworks.projects.submissions.grade',['classGroupId'=>$classGroup->id,'projectId'=>$project->id,'submissionId'=>$submission->id]) }}">
                            @csrf
                            <input type="hidden" name="return_to" value="{{ $returnTo }}">
                            @method('PUT')
                            <div class="ps-form-group"><label class="ps-form-label">Score</label><input type="number" name="score" class="ps-input" min="0" max="{{ $project->points }}" step="0.01" value="{{ old('score',$submission->score) }}" required>@error('score')<div class="ps-error">{{ $message }}</div>@enderror</div>
                            <div class="ps-form-group"><label class="ps-form-label">Feedback</label><textarea name="feedback" class="ps-textarea" placeholder="Write feedback for the student...">{{ old('feedback',$submission->feedback) }}</textarea>@error('feedback')<div class="ps-error">{{ $message }}</div>@enderror</div>
                            <button type="submit" class="ps-btn ps-btn-yellow"><i class="bx bx-check"></i>Save Grade</button>
                        </form>
                    </div>
                </div>
            </section>
            @endif

        </main>

        <aside class="ps-sidebar">
            <section class="ps-card">
                <div class="ps-card-header">
                    <h2>Project Details</h2>
                </div>
                <div class="ps-info-list">
                    <div class="ps-info-item">
                        <div class="ps-info-icon"><i class="bx bx-star"></i></div>
                        <div><span>Points</span><strong>{{ rtrim(rtrim(number_format($project->points,2),'0'),'.') }}</strong></div>
                    </div>
                    <div class="ps-info-item">
                        <div class="ps-info-icon"><i class="bx bx-category"></i></div>
                        <div><span>Project Type</span><strong>{{ $project->project_type === 'team' ? 'Team Project' : 'Individual Project' }}</strong></div>
                    </div>
                    @if($project->due_date)<div class="ps-info-item">
                        <div class="ps-info-icon"><i class="bx bx-calendar"></i></div>
                        <div><span>Due Date</span><strong>{{ $project->due_date->format('M d, Y') }}</strong></div>
                    </div>@endif
                    @if($project->due_time)<div class="ps-info-item">
                        <div class="ps-info-icon"><i class="bx bx-time"></i></div>
                        <div><span>Due Time</span><strong>{{ \Carbon\Carbon::parse($project->due_time)->format('h:i A') }}</strong></div>
                    </div>@endif
                    <div class="ps-info-item">
                        <div class="ps-info-icon"><i class="bx bx-check-circle"></i></div>
                        <div><span>Submission Status</span><strong>{{ $submission->submitted_at ? 'Submitted' : 'Draft' }}</strong></div>
                    </div>
                </div>
            </section>
        </aside>
    </div>
</div>

<div id="projectSubmissionViewer" class="ps-modal" aria-hidden="true">
    <div class="ps-modal-container" role="dialog" aria-modal="true" aria-labelledby="projectSubmissionViewerTitle">
        <div class="ps-modal-header">
            <div class="ps-modal-title">
                <i class="bx bx-file"></i>
                <span id="projectSubmissionViewerTitle">Submitted File</span>
            </div>

            <div class="ps-modal-actions">
                <button
                    type="button"
                    class="ps-modal-action"
                    id="projectSubmissionViewerFullscreen"
                    title="Fullscreen"
                    aria-label="Fullscreen"
                    onclick="toggleProjectSubmissionFullscreen()"
                >
                    <i class="bx bx-fullscreen"></i>
                </button>

                <button
                    type="button"
                    class="ps-modal-action ps-modal-close"
                    id="projectSubmissionViewerClose"
                    title="Close"
                    aria-label="Close"
                    onclick="closeProjectSubmissionFile()"
                >
                    <i class="bx bx-x"></i>
                </button>
            </div>
        </div>

        <div class="ps-modal-body">
            <iframe id="projectSubmissionViewerFrame" src="" frameborder="0"></iframe>
        </div>
    </div>
</div>

<script>
    function openProjectSubmissionFile(fileUrl, fileName) {
        const modal = document.getElementById('projectSubmissionViewer');
        const iframe = document.getElementById('projectSubmissionViewerFrame');
        const title = document.getElementById('projectSubmissionViewerTitle');

        if (!modal || !iframe) return;

        iframe.src = fileUrl;
        if (title) title.textContent = fileName || 'Submitted File';

        modal.classList.add('active');
        modal.setAttribute('aria-hidden', 'false');
        document.body.style.overflow = 'hidden';

        updateProjectSubmissionFullscreenButton(false);
    }

    function closeProjectSubmissionFile() {
        const modal = document.getElementById('projectSubmissionViewer');
        const iframe = document.getElementById('projectSubmissionViewerFrame');

        if (!modal || !iframe) return;

        iframe.src = '';
        modal.classList.remove('active', 'fullscreen');
        modal.setAttribute('aria-hidden', 'true');
        document.body.style.overflow = '';

        updateProjectSubmissionFullscreenButton(false);
    }

    function toggleProjectSubmissionFullscreen() {
        const modal = document.getElementById('projectSubmissionViewer');
        if (!modal) return;

        const isFullscreen = modal.classList.toggle('fullscreen');
        updateProjectSubmissionFullscreenButton(isFullscreen);
    }

    function updateProjectSubmissionFullscreenButton(isFullscreen) {
        const button = document.getElementById('projectSubmissionViewerFullscreen');
        if (!button) return;

        const icon = button.querySelector('i');

        if (icon) {
            icon.className = isFullscreen
                ? 'bx bx-exit-fullscreen'
                : 'bx bx-fullscreen';
        }

        button.title = isFullscreen ? 'Exit Fullscreen' : 'Fullscreen';
        button.setAttribute(
            'aria-label',
            isFullscreen ? 'Exit Fullscreen' : 'Fullscreen'
        );
    }

    document.getElementById('projectSubmissionViewerClose')
        ?.addEventListener('click', closeProjectSubmissionFile);

    document.getElementById('projectSubmissionViewer')
        ?.addEventListener('click', function (event) {
            if (event.target === this) {
                closeProjectSubmissionFile();
            }
        });

    document.addEventListener('keydown', function (event) {
        const modal = document.getElementById('projectSubmissionViewer');

        if (!modal || !modal.classList.contains('active')) {
            return;
        }

        if (event.key === 'Escape') {
            if (modal.classList.contains('fullscreen')) {
                modal.classList.remove('fullscreen');
                updateProjectSubmissionFullscreenButton(false);
                return;
            }

            closeProjectSubmissionFile();
        }
    });

    /* ============================================================
   TEAM GRADING MODE
   ============================================================ */

    const gradeModeTeam =
        document.getElementById('gradeModeTeam');

    const gradeModeManual =
        document.getElementById('gradeModeManual');

    const gradeByTeamPanel =
        document.getElementById('gradeByTeamPanel');

    const gradeManuallyPanel =
        document.getElementById('gradeManuallyPanel');


    function updateGradeMode() {

        const selectedMode =
            document.querySelector(
                'input[name="grade_mode"]:checked'
            )?.value;


        if (!gradeByTeamPanel ||
            !gradeManuallyPanel) {
            return;
        }


        if (selectedMode === 'manual') {

            gradeByTeamPanel.classList.remove(
                'is-active'
            );

            gradeManuallyPanel.classList.add(
                'is-active'
            );

        } else {

            gradeManuallyPanel.classList.remove(
                'is-active'
            );

            gradeByTeamPanel.classList.add(
                'is-active'
            );
        }
    }


    if (gradeModeTeam) {

        gradeModeTeam.addEventListener(
            'change',
            updateGradeMode
        );
    }


    if (gradeModeManual) {

        gradeModeManual.addEventListener(
            'change',
            updateGradeMode
        );
    }


    updateGradeMode();

    /* ============================================================
       EDIT TEAM / MANUAL GRADE
       ============================================================ */

    const editTeamGradeButton =
        document.getElementById('editTeamGradeButton');

    const teamGradedView =
        document.getElementById('teamGradedView');

    const teamGradeEditPanel =
        document.getElementById('teamGradeEditPanel');


    if (editTeamGradeButton) {
        editTeamGradeButton.addEventListener('click', function() {

            teamGradedView?.classList.remove('is-active');

            teamGradeEditPanel?.classList.add('is-active');

        });
    }


    const editManualGradeButton =
        document.getElementById('editManualGradeButton');

    const manualGradedView =
        document.getElementById('manualGradedView');

    const manualGradeEditPanel =
        document.getElementById('manualGradeEditPanel');


    if (editManualGradeButton) {
        editManualGradeButton.addEventListener('click', function() {

            manualGradedView?.classList.remove('is-active');

            manualGradeEditPanel?.classList.add('is-active');

        });
    }
</script>
@endsection
