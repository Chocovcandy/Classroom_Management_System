@extends('layouts.student_layout')

@section('title', 'Project')

@section('content')

@php
    $returnTo = request('return_to', 'classwork');

    /*
    |--------------------------------------------------------------------------
    | Grade / feedback display
    |--------------------------------------------------------------------------
    |
    | Individual project:
    |   score + feedback come from ProjectSubmission.
    |
    | Team project:
    |   the student's individual grade is stored in ProjectSubmissionGrade.
    |   When an individual grade is not available, fall back to the common
    |   team score / feedback stored on ProjectSubmission.
    |
    */
    $memberGrade = null;

    if ($project->project_type === 'team' && $submission) {
        $memberGrade = $submission->grades
            ->firstWhere('student_id', auth()->id());
    }

    $studentScore = $submission?->score;
    $studentFeedback = $submission?->feedback;
    $gradedAt = $submission?->graded_at;
    $gradeLabel = 'Your Grade';

    if ($project->project_type === 'team' && $memberGrade) {
        if ($memberGrade->score !== null) {
            $studentScore = $memberGrade->score;
        }

        if ($memberGrade->feedback) {
            $studentFeedback = $memberGrade->feedback;
        }

        if ($memberGrade->graded_at) {
            $gradedAt = $memberGrade->graded_at;
        }

        if ($memberGrade->score !== null || $memberGrade->feedback || $memberGrade->graded_at) {
            $gradeLabel = 'Your Grade';
        }
    } elseif ($project->project_type === 'team' && $submission?->score !== null) {
        $gradeLabel = 'Team Grade';
    }

    $projectPoints = (float) ($project->points ?? 0);
    $scoreValue = $studentScore !== null ? (float) $studentScore : null;
    $percentage = ($scoreValue !== null && $projectPoints > 0)
        ? ($scoreValue / $projectPoints) * 100
        : 0;

    /*
    |--------------------------------------------------------------------------
    | Team submission role
    |--------------------------------------------------------------------------
    |
    | Team project:
    |   leader = primary submitter
    |   backup = may submit when leader is unavailable
    |   member = cannot submit the final project
    |
    */
    $currentStudentRole = null;

    if ($project->project_type === 'team' && $projectGroup) {
        $currentStudentRole = $projectGroup->members
            ->firstWhere('user_id', auth()->id())
            ?->role;
    }

    $canManageTeamSubmission = $project->project_type !== 'team'
        || in_array($currentStudentRole, ['leader', 'backup'], true);
@endphp


<style>
    /* ============================================================
       STUDENT PROJECT SHOW PAGE
       Assignment-style layout + Yellow Project theme
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
        transition: color .2s ease, transform .2s ease;
    }

    .classwork-back-btn i {
        font-size: 20px;
    }

    .classwork-back-btn:hover {
        color: #b8860b;
        transform: translateX(-3px);
    }

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
        background: rgba(234, 179, 8, .13);
        color: #b8860b;
        font-size: 28px;
    }

    .classwork-show-type {
        display: block;
        margin-bottom: 4px;
        color: #b8860b;
        font-size: 11px;
        font-weight: 700;
        letter-spacing: .08em;
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
        color: #b8860b;
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
        box-shadow: 0 3px 12px rgba(0, 0, 0, .035);
    }

    .classwork-detail-card-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 12px;
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
       DESCRIPTION
    ============================================================ */

    .classwork-description {
        padding: 22px 20px;
        color: var(--text-color);
        font-size: 14px;
        line-height: 1.75;
        min-height: 100px;
    }

    .classwork-no-content {
        color: var(--text-secondary);
        font-style: italic;
    }

    /* ============================================================
       ATTACHMENTS
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
        transition: border-color .2s ease, background-color .2s ease;
    }

    .classwork-file:hover {
        background: var(--background-color);
        border-color: #eab308;
    }

    .classwork-file-icon {
        width: 48px;
        height: 48px;
        min-width: 48px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 10px;
        background: rgba(234, 179, 8, .12);
        color: #b8860b;
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
        transition: background-color .2s ease, border-color .2s ease,
            color .2s ease, transform .2s ease;
    }

    .classwork-file-open:hover {
        background: rgba(234, 179, 8, .08);
        border-color: #eab308;
        color: #b8860b;
        transform: translateY(-1px);
    }

    .classwork-file-open i {
        font-size: 18px;
    }

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
       PROJECT TYPE
    ============================================================ */

    .project-type-section {
        padding: 20px;
    }

    .project-type-box {
        display: flex;
        align-items: center;
        gap: 13px;
        padding: 14px;
        border: 1px solid rgba(234, 179, 8, .30);
        border-radius: 12px;
        background: rgba(234, 179, 8, .07);
    }

    .project-type-icon {
        width: 42px;
        height: 42px;
        flex-shrink: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 11px;
        background: rgba(234, 179, 8, .15);
        color: #b8860b;
        font-size: 20px;
    }

    .project-type-info {
        min-width: 0;
        display: flex;
        flex-direction: column;
        gap: 3px;
    }

    .project-type-info strong {
        color: var(--text-color);
        font-size: 14px;
        font-weight: 650;
    }

    .project-type-info span {
        color: var(--text-secondary);
        font-size: 12px;
        line-height: 1.5;
    }

    /* ============================================================
       MY TEAM
    ============================================================ */

    .project-team-body {
        padding: 20px;
    }

    .project-team-summary {
        display: flex;
        align-items: center;
        gap: 13px;
        padding: 14px;
        margin-bottom: 15px;
        border: 1px solid rgba(234, 179, 8, .25);
        border-radius: 12px;
        background: rgba(234, 179, 8, .06);
    }

    .project-team-summary-icon {
        width: 42px;
        height: 42px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        border-radius: 11px;
        background: rgba(234, 179, 8, .14);
        color: #b8860b;
        font-size: 20px;
    }

    .project-team-summary-info {
        min-width: 0;
        display: flex;
        flex-direction: column;
        gap: 3px;
    }

    .project-team-summary-info strong {
        color: var(--text-color);
        font-size: 14px;
        font-weight: 700;
    }

    .project-team-summary-info span {
        color: var(--text-secondary);
        font-size: 12px;
    }

    .project-team-members {
        display: flex;
        flex-direction: column;
        gap: 9px;
    }

    .project-team-member {
        display: flex;
        align-items: center;
        gap: 11px;
        padding: 11px 12px;
        border: 1px solid var(--border-color);
        border-radius: 11px;
        min-width: 0;
    }

    .project-team-avatar {
        width: 37px;
        height: 37px;
        min-width: 37px;
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
        border-radius: 50%;
        background: rgba(234, 179, 8, .12);
        color: #b8860b;
        font-size: 13px;
        font-weight: 700;
    }

    .project-team-avatar img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .project-team-member-info {
        flex: 1;
        min-width: 0;
        display: flex;
        flex-direction: column;
        gap: 3px;
    }

    .project-team-member-info strong {
        color: var(--text-color);
        font-size: 13px;
        font-weight: 600;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }

    .project-team-member-info span {
        color: var(--text-secondary);
        font-size: 11px;
    }

    .project-team-role {
        padding: 5px 8px;
        border-radius: 7px;
        background: var(--background-color);
        color: var(--text-secondary);
        font-size: 10px;
        font-weight: 700;
        text-transform: capitalize;
        white-space: nowrap;
    }

    .project-team-role.leader {
        background: rgba(234, 179, 8, .15);
        color: #a67c00;
    }

    .project-team-role.backup {
        background: rgba(100, 116, 139, .12);
        color: #64748b;
    }

    .project-team-empty {
        padding: 28px 16px;
        text-align: center;
        color: var(--text-secondary);
        font-size: 13px;
    }

    /* ============================================================
       YOUR SUBMISSION
    ============================================================ */

    .student-submission-card {
        overflow: hidden;
    }

    .student-submission-status {
        display: flex;
        align-items: center;
        gap: 14px;
        margin: 20px;
        padding: 16px;
        border-radius: 10px;
    }

    .student-submission-status.submitted {
        background: rgba(22, 163, 74, .08);
        border: 1px solid rgba(34, 197, 94, .25);
    }

    .student-submission-status.not-submitted {
        background: rgba(234, 179, 8, .07);
        border: 1px solid rgba(234, 179, 8, .25);
    }

    .student-submission-status-icon {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 42px;
        height: 42px;
        flex-shrink: 0;
        border-radius: 50%;
        background: rgba(234, 179, 8, .12);
        color: #b8860b;
    }

    .submitted .student-submission-status-icon {
        background: rgba(34, 197, 94, .13);
        color: #16a34a;
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
        color: var(--text-color);
        font-size: 14px;
        font-weight: 650;
    }

    .student-submission-status-content span {
        color: var(--text-secondary);
        font-size: 12px;
    }

    /* ============================================================
       SUBMITTED FILES
    ============================================================ */

    .student-submission-files {
        margin: 0 20px 20px;
    }

    .student-submission-files-title {
        display: flex;
        align-items: center;
        gap: 7px;
        margin-bottom: 10px;
        color: var(--text-color);
        font-size: 13px;
        font-weight: 650;
    }

    .student-submission-files-title i {
        color: #b8860b;
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
        background: rgba(234, 179, 8, .10);
        color: #b8860b;
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
        color: var(--text-color);
        font-size: 13px;
        font-weight: 500;
        text-overflow: ellipsis;
        white-space: nowrap;
    }

    .student-submission-file-info span {
        color: var(--muted-text);
        font-size: 11px;
    }

    /* ============================================================
       GRADE / FEEDBACK
    ============================================================ */

    .submission-result {
        margin: 0 20px 20px;
        padding: 16px;
        border: 1px solid rgba(234, 179, 8, .30);
        border-radius: 12px;
        background: rgba(234, 179, 8, .06);
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

    .submission-result-item + .submission-result-item {
        border-top: 1px solid var(--border-color);
    }

    .submission-result-item > i {
        margin-top: 2px;
        color: #b8860b;
        font-size: 18px;
    }

    .submission-result-item > div {
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
       UPLOAD
    ============================================================ */

    .student-submission-upload {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        min-height: 190px;
        margin: 20px;
        padding: 25px;
        border: 1.5px dashed rgba(234, 179, 8, .45);
        border-radius: 12px;
        background: rgba(234, 179, 8, .05);
        text-align: center;
        cursor: pointer;
        transition: border-color .2s ease, background-color .2s ease;
    }

    .student-submission-upload:hover {
        border-color: #eab308;
        background: rgba(234, 179, 8, .08);
    }

    .student-submission-upload-icon {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 52px;
        height: 52px;
        margin-bottom: 12px;
        border-radius: 50%;
        background: rgba(234, 179, 8, .14);
        color: #b8860b;
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
        color: var(--text-color);
        font-size: 14px;
        font-weight: 600;
    }

    .student-submission-upload-content span {
        color: var(--text-secondary);
        font-size: 12px;
    }

    .student-submission-browse-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 7px;
        padding: 8px 14px;
        border: 1px solid var(--border-color);
        border-radius: 7px;
        background: var(--card-color);
        color: var(--text-color);
        font-size: 12px;
        font-weight: 500;
        cursor: pointer;
    }

    .student-submission-browse-btn:hover {
        border-color: #eab308;
        color: #b8860b;
    }

    .student-submission-selected {
        margin: 0 20px 20px;
    }

    .student-submission-selected-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 12px;
        margin-bottom: 9px;
        color: var(--text-color);
        font-size: 12px;
        font-weight: 600;
    }

    .student-submission-selected-header span:last-child {
        color: var(--text-secondary);
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
        color: #b8860b;
        font-size: 18px;
    }

    .student-submission-selected-file-name {
        flex: 1;
        min-width: 0;
        overflow: hidden;
        color: var(--text-color);
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
        color: var(--text-secondary);
        cursor: pointer;
    }

    .student-submission-remove-file:hover {
        background: rgba(239, 68, 68, .08);
        color: #ef4444;
    }

    .student-submission-remove-file i {
        font-size: 17px;
    }

    .student-submission-actions {
        display: flex;
        justify-content: flex-end;
        gap: 10px;
        margin: 0 20px 20px;
    }

    .student-submission-submit-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        min-width: 170px;
        min-height: 44px;
        padding: 10px 17px;
        border: 1px solid #eab308;
        border-radius: 10px;
        background: #eab308;
        color: #fff;
        font-size: 13px;
        font-weight: 650;
        cursor: pointer;
        transition: opacity .2s ease, transform .2s ease;
    }

    .student-submission-submit-btn:hover:not(:disabled) {
        opacity: .9;
        transform: translateY(-1px);
    }

    .student-submission-submit-btn:disabled {
        opacity: .45;
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
        padding: 10px 15px;
        border: 1px solid #ef4444;
        border-radius: 10px;
        background: transparent;
        color: #ef4444;
        font-size: 13px;
        font-weight: 600;
        cursor: pointer;
        transition: background-color .2s ease, color .2s ease,
            transform .2s ease;
    }

    .student-submission-cancel-btn:hover {
        background: #ef4444;
        color: #fff;
        transform: translateY(-1px);
    }

    /* ============================================================
       TEAM SUBMISSION ROLE NOTICE
    ============================================================ */

    .team-submission-role-notice {
        display: flex;
        align-items: flex-start;
        gap: 11px;
        margin: 0 20px 20px;
        padding: 13px 15px;
        border: 1px solid rgba(234, 179, 8, .24);
        border-radius: 11px;
        background: rgba(234, 179, 8, .06);
    }

    .team-submission-role-notice i {
        flex-shrink: 0;
        margin-top: 1px;
        color: #b8860b;
        font-size: 18px;
    }

    .team-submission-role-notice strong {
        display: block;
        margin-bottom: 3px;
        color: var(--text-color);
        font-size: 13px;
        font-weight: 650;
    }

    .team-submission-role-notice span {
        display: block;
        color: var(--text-secondary);
        font-size: 12px;
        line-height: 1.55;
    }

    .team-submission-member-notice {
        display: flex;
        align-items: flex-start;
        gap: 11px;
        margin: 0 20px 20px;
        padding: 14px 15px;
        border: 1px solid var(--border-color);
        border-radius: 11px;
        background: var(--background-color);
    }

    .team-submission-member-notice i {
        flex-shrink: 0;
        margin-top: 1px;
        color: var(--text-secondary);
        font-size: 18px;
    }

    .team-submission-member-notice strong {
        display: block;
        margin-bottom: 3px;
        color: var(--text-color);
        font-size: 13px;
        font-weight: 650;
    }

    .team-submission-member-notice span {
        display: block;
        color: var(--text-secondary);
        font-size: 12px;
        line-height: 1.55;
    }

    /* ============================================================
       ALERTS
    ============================================================ */

    .project-alert {
        display: flex;
        align-items: flex-start;
        gap: 9px;
        padding: 13px 15px;
        margin-bottom: 20px;
        border-radius: 11px;
        font-size: 13px;
    }

    .project-alert.success {
        background: rgba(22, 163, 74, .08);
        color: #15803d;
        border: 1px solid rgba(34, 197, 94, .25);
    }

    .project-alert.error {
        background: rgba(239, 68, 68, .08);
        color: #dc2626;
        border: 1px solid rgba(239, 68, 68, .22);
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

    .classwork-info-item > i {
        width: 36px;
        height: 36px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        border-radius: 9px;
        background: rgba(234, 179, 8, .08);
        color: #b8860b;
        font-size: 18px;
    }

    .classwork-info-item > div {
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

    .submission-status-sidebar {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 16px 20px;
    }

    .submission-status-sidebar > i {
        width: 36px;
        height: 36px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        border-radius: 9px;
        background: rgba(234, 179, 8, .10);
        color: #b8860b;
        font-size: 18px;
    }

    .submission-status-sidebar.submitted > i {
        background: rgba(34, 197, 94, .10);
        color: #16a34a;
    }

    .submission-status-sidebar > div {
        display: flex;
        flex-direction: column;
        gap: 3px;
    }

    .submission-status-sidebar span {
        color: var(--text-secondary);
        font-size: 12px;
    }

    .submission-status-sidebar strong {
        color: var(--text-color);
        font-size: 14px;
        font-weight: 650;
    }

    /* ============================================================
       FILE VIEWER MODAL
    ============================================================ */

    .project-viewer-modal {
        position: fixed;
        inset: 0;
        z-index: 9999;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 30px;
        background: rgba(0, 0, 0, .72);
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
        background: var(--card-color);
        border: 1px solid var(--border-color);
        border-radius: 14px;
        overflow: hidden;
        box-shadow: 0 20px 60px rgba(0, 0, 0, .3);
    }

    .project-viewer-header {
        min-height: 60px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 14px;
        padding: 0 18px;
        background: var(--card-color);
        border-bottom: 1px solid var(--border-color);
    }

    .project-viewer-title {
        min-width: 0;
        display: flex;
        align-items: center;
        gap: 10px;
        color: var(--text-color);
        font-size: 14px;
        font-weight: 650;
    }

    .project-viewer-title i {
        color: #b8860b;
        font-size: 20px;
    }

    .project-viewer-title span {
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }

    .project-viewer-actions {
        display: flex;
        align-items: center;
        gap: 6px;
    }

    .project-viewer-btn {
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
    }

    .project-viewer-btn:hover {
        background: var(--background-color);
        color: var(--text-color);
        border-color: #eab308;
    }

    .project-viewer-btn.close:hover {
        border-color: #ef4444;
        color: #ef4444;
    }

    .project-viewer-btn i {
        font-size: 20px;
    }

    .project-viewer-body {
        flex: 1;
        min-height: 0;
        background: #1a1a1a;
    }

    .project-viewer-body iframe {
        display: block;
        width: 100%;
        height: 100%;
        border: none;
        background: #fff;
    }

    body.project-modal-open {
        overflow: hidden;
    }

    .project-viewer-container:fullscreen {
        width: 100vw;
        height: 100vh;
        border-radius: 0;
        border: none;
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

        .classwork-files {
            padding: 14px 18px 18px;
        }

        .project-type-section,
        .project-team-body {
            padding: 18px;
        }

        .student-submission-status {
            margin: 18px;
        }

        .student-submission-files,
        .submission-result,
        .student-submission-selected {
            margin-left: 18px;
            margin-right: 18px;
        }

        .student-submission-upload {
            margin: 18px;
        }

        .student-submission-actions {
            margin-left: 18px;
            margin-right: 18px;
        }

        .team-submission-role-notice,
        .team-submission-member-notice {
            margin-left: 18px;
            margin-right: 18px;
        }

        .classwork-file {
            align-items: flex-start;
            flex-wrap: wrap;
        }

        .classwork-file-open {
            margin-left: 63px;
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

        .project-type-section,
        .project-team-body {
            padding: 16px;
        }

        .student-submission-status {
            margin: 16px;
            padding: 14px;
        }

        .student-submission-upload {
            margin: 16px;
            padding: 20px 16px;
        }

        .student-submission-actions {
            flex-direction: column-reverse;
            margin-left: 16px;
            margin-right: 16px;
        }

        .student-submission-submit-btn,
        .student-submission-cancel-btn {
            width: 100%;
        }

        .classwork-file-open {
            width: calc(100% - 63px);
            margin-left: 63px;
        }
    }
</style>

<div class="classwork-show-page">

    {{-- ============================================================
         ALERTS
    ============================================================= --}}

    @if(session('success'))
        <div class="project-alert success">
            <i class="bx bx-check-circle"></i>
            <span>{{ session('success') }}</span>
        </div>
    @endif

    @if(session('error'))
        <div class="project-alert error">
            <i class="bx bx-error-circle"></i>
            <span>{{ session('error') }}</span>
        </div>
    @endif

    @if($errors->any())
        <div class="project-alert error">
            <i class="bx bx-error-circle"></i>
            <div>
                @foreach($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
            </div>
        </div>
    @endif

    {{-- ============================================================
         HEADER
    ============================================================= --}}

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

            <div class="classwork-show-icon">
                <i class="bx bx-git-branch"></i>
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
                 PROJECT INSTRUCTIONS
            ===================================================== --}}

            <section class="classwork-detail-card">

                <div class="classwork-detail-card-header">
                    <h2>
                        Project Instructions
                    </h2>
                </div>

                <div class="classwork-description">
                    @if($project->description)
                        {!! nl2br(e($project->description)) !!}
                    @else
                        <span class="classwork-no-content">
                            No instructions provided.
                        </span>
                    @endif
                </div>

            </section>

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
                                    : 'Individual Project' }}
                            </strong>

                            <span>
                                {{ $project->project_type === 'team'
                                    ? 'Students complete this project together as a team.'
                                    : 'Each student completes this project individually.' }}
                            </span>
                        </div>

                    </div>
                </div>

            </section>

            {{-- ====================================================
                 MY TEAM
            ===================================================== --}}

            @if($project->project_type === 'team')
                <section class="classwork-detail-card">

                    <div class="classwork-detail-card-header">
                        <h2>
                            My Team
                        </h2>
                    </div>

                    <div class="project-team-body">

                        @if($projectGroup)

                            <div class="project-team-summary">
                                <div class="project-team-summary-icon">
                                    <i class="bx bx-group"></i>
                                </div>

                                <div class="project-team-summary-info">
                                    <strong>
                                        {{ $projectGroup->group_name }}
                                    </strong>

                                    <span>
                                        Team {{ $projectGroup->group_number }}
                                        · {{ $projectGroup->members->count() }}
                                        {{ $projectGroup->members->count() === 1 ? 'member' : 'members' }}
                                    </span>
                                </div>
                            </div>

                            <div class="project-team-members">
                                @foreach($projectGroup->members as $member)
                                    <div class="project-team-member">

                                        <div class="project-team-avatar">
                                            @if($member->user?->profile_image)
                                                <img
                                                    src="{{ asset('storage/' . $member->user->profile_image) }}"
                                                    alt="{{ $member->user->name }}"
                                                >
                                            @else
                                                {{ strtoupper(substr($member->user?->name ?? 'U', 0, 1)) }}
                                            @endif
                                        </div>

                                        <div class="project-team-member-info">
                                            <strong>
                                                {{ $member->user?->name ?? 'Unknown Student' }}

                                                @if($member->user_id === auth()->id())
                                                    <span style="color:#b8860b; font-size:10px;">
                                                        (You)
                                                    </span>
                                                @endif
                                            </strong>

                                            <span>Team member</span>
                                        </div>

                                        <span class="project-team-role {{ $member->role }}">
                                            {{ $member->role }}
                                        </span>

                                    </div>
                                @endforeach
                            </div>

                        @else
                            <div class="project-team-empty">
                                You have not been assigned to a team for this project yet.
                            </div>
                        @endif

                    </div>

                </section>
            @endif

            {{-- ====================================================
                 ATTACHMENTS
            ===================================================== --}}

            <section class="classwork-detail-card">

                <div class="classwork-detail-card-header">
                    <h2>
                        Attachments
                    </h2>

                    <span style="color:var(--text-secondary);font-size:12px;">
                        {{ $project->resources->count() }}
                        {{ $project->resources->count() === 1 ? 'file' : 'files' }}
                    </span>
                </div>

                @if($project->resources->isNotEmpty())
                    <div class="classwork-files">

                        @foreach($project->resources as $resource)
                            <div class="classwork-file">

                                <div class="classwork-file-icon">
                                    <i class="bx bx-file"></i>
                                </div>

                                <div class="classwork-file-info">
                                    <strong>
                                        {{ $resource->file_name ?? $resource->title }}
                                    </strong>

                                    <span>
                                        {{ $resource->file_size
                                            ? number_format($resource->file_size / 1024, 1) . ' KB'
                                            : 'Project attachment' }}
                                    </span>
                                </div>

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
                @else
                    <div class="classwork-no-files">
                        <i class="bx bx-file"></i>
                        <p>
                            No files attached to this project.
                        </p>
                    </div>
                @endif

            </section>

            {{-- ====================================================
                 YOUR SUBMISSION
            ===================================================== --}}

            <section class="classwork-detail-card student-submission-card">

                <div class="classwork-detail-card-header">
                    <h2>
                        Your Submission
                    </h2>
                </div>

                @if($submission && $submission->submitted_at)

                    {{-- SUBMITTED STATE --}}
                    <div class="student-submission-status submitted">

                        <div class="student-submission-status-icon">
                            <i class="bx bx-check"></i>
                        </div>

                        <div class="student-submission-status-content">
                            <strong>
                                Project submitted
                            </strong>

                            <span>
                                Submitted
                                {{ $submission->submitted_at->format('M d, Y \a\t h:i A') }}
                            </span>
                        </div>

                    </div>

                    {{-- SUBMITTED FILES --}}
                    @if($submission->resources->count())
                        <div class="student-submission-files">

                            <div class="student-submission-files-title">
                                <i class="bx bx-paperclip"></i>
                                <span>Your files</span>
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
                                                    {{ number_format($resource->file_size / 1024, 1) }} KB
                                                </span>
                                            @endif
                                        </div>

                                    </div>
                                @endforeach

                            </div>
                        </div>
                    @endif

                    {{-- GRADE / FEEDBACK --}}
                    @if(
                        $studentScore !== null ||
                        $studentFeedback ||
                        $gradedAt
                    )
                        <div class="submission-result">

                            @if($studentScore !== null)
                                <div class="submission-result-item">
                                    <i class="bx bx-star"></i>

                                    <div>
                                        <span>
                                            {{ $gradeLabel }}
                                        </span>

                                        <strong>
                                            {{ rtrim(rtrim(number_format($scoreValue, 2), '0'), '.') }}
                                            /
                                            {{ rtrim(rtrim(number_format($projectPoints, 2), '0'), '.') }}
                                            ({{ rtrim(rtrim(number_format($percentage, 2), '0'), '.') }}%)
                                        </strong>
                                    </div>
                                </div>
                            @endif

                            @if($studentFeedback)
                                <div class="submission-result-item">
                                    <i class="bx bx-message-detail"></i>

                                    <div>
                                        <span>
                                            Professor Feedback
                                        </span>

                                        <div class="submission-feedback">
                                            {!! nl2br(e($studentFeedback)) !!}
                                        </div>
                                    </div>
                                </div>
                            @endif

                            @if($gradedAt)
                                <div class="submission-result-item">
                                    <i class="bx bx-calendar-check"></i>

                                    <div>
                                        <span>
                                            Graded On
                                        </span>

                                        <strong>
                                            {{ $gradedAt->format('M d, Y \a\t h:i A') }}
                                        </strong>
                                    </div>
                                </div>
                            @endif

                        </div>
                    @endif

{{-- CANCEL SUBMISSION --}}
@if(!$gradedAt)
    <div class="student-submission-actions">
        <form
            action="{{ route(
                'student.class-groups.projects.cancel',
                [
                    'classGroup' => $classGroup,
                    'project' => $project,
                ]
            ) }}"
            method="POST"
            onsubmit="return confirm('Are you sure you want to cancel your submission?');"
        >
            @csrf
            @method('DELETE')

            <input
                type="hidden"
                name="return_to"
                value="{{ $returnTo }}"
            >

            <button
                type="submit"
                class="student-submission-cancel-btn"
            >
                <i class="bx bx-undo"></i>
                Cancel Submission
            </button>
        </form>
    </div>
@endif

                @else

                    {{-- NOT SUBMITTED --}}
                    <div class="student-submission-status not-submitted">

                        <div class="student-submission-status-icon">
                            <i class="bx bx-upload"></i>
                        </div>

                        <div class="student-submission-status-content">
                            <strong>
                                Not Submitted
                            </strong>

                            <span>
                                Upload your project files below.
                            </span>
                        </div>

                    </div>

                    {{-- TEAM / SUBMISSION PERMISSION --}}
                    @if($project->project_type === 'team')

                        @if(!$projectGroup)

                            <div class="project-alert error" style="margin: 0 20px 20px;">
                                <i class="bx bx-group"></i>
                                <span>
                                    You have not been assigned to a team yet.
                                </span>
                            </div>

                        @elseif($currentStudentRole === 'leader')

                            <div class="team-submission-role-notice">
                                <i class="bx bx-user-check"></i>

                                <div>
                                    <strong>Team Leader — Primary Submitter</strong>
                                    <span>
                                        You are responsible for submitting the team's final project.
                                        The Backup Submitter can submit if you are unavailable.
                                    </span>
                                </div>
                            </div>

                        @elseif($currentStudentRole === 'backup')

                            <div class="team-submission-role-notice">
                                <i class="bx bx-shield-quarter"></i>

                                <div>
                                    <strong>Backup Submitter</strong>
                                    <span>
                                        You can submit the team's final project when the Team Leader
                                        is unavailable.
                                    </span>
                                </div>
                            </div>

                        @else

                            <div class="team-submission-member-notice">
                                <i class="bx bx-info-circle"></i>

                                <div>
                                    <strong>Team submission is handled by the Team Leader or Backup Submitter</strong>
                                    <span>
                                        You can help prepare the project, but you cannot submit the
                                        final project. If both responsible members are unavailable,
                                        the professor must intervene.
                                    </span>
                                </div>
                            </div>

                        @endif

                    @endif

                    {{-- UPLOAD FORM --}}
                    @if($project->project_type !== 'team' || ($projectGroup && $canManageTeamSubmission))

                        <form
                            method="POST"
                            action="{{ route(
                                'student.class-groups.projects.submit',
                                [
                                    'classGroup' => $classGroup,
                                    'project' => $project,
                                ]
                            ) }}"
                            enctype="multipart/form-data"
                            id="projectSubmissionForm"
                        >
                            @csrf

                            <input
                                type="hidden"
                                name="return_to"
                                value="{{ $returnTo }}"
                            >

                            <div
                                class="student-submission-upload"
                                id="submissionUploadArea"
                            >
                                <input
                                    type="file"
                                    name="attachments[]"
                                    id="submissionFiles"
                                    multiple
                                    hidden
                                >

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
                                    id="submissionBrowseBtn"
                                >
                                    <i class="bx bx-folder-open"></i>
                                    Choose Files
                                </button>
                            </div>

                            <div
                                class="student-submission-selected"
                                id="selectedSubmissionFiles"
                                style="display:none;"
                            >
                                <div class="student-submission-selected-header">
                                    <span>Selected files</span>
                                    <span id="selectedFileCount">0 files</span>
                                </div>

                                <div
                                    class="student-submission-selected-list"
                                    id="selectedFileList"
                                ></div>
                            </div>

                            <div class="student-submission-actions">
                                <button
                                    type="submit"
                                    class="student-submission-submit-btn"
                                    id="submissionSubmitBtn"
                                    disabled
                                >
                                    <i class="bx bx-send"></i>
                                    <span>Submit Project</span>
                                </button>
                            </div>
                        </form>

                    @endif

                @endif

            </section>

        </div>

        {{-- ========================================================
             SIDEBAR
        ========================================================= --}}

        <aside class="classwork-show-sidebar">

            {{-- ====================================================
                 PROJECT DETAILS
            ===================================================== --}}

            <section class="classwork-detail-card">

                <div class="classwork-detail-card-header">
                    <h2>
                        Project Details
                    </h2>
                </div>

                <div class="classwork-info-list">

                    {{-- PROJECT TYPE --}}
                    <div class="classwork-info-item">
                        <i class="bx bx-group"></i>

                        <div>
                            <span>Project Type</span>
                            <strong>
                                {{ $project->project_type === 'team'
                                    ? 'Team'
                                    : 'Individual' }}
                            </strong>
                        </div>
                    </div>

                    {{-- POINTS --}}
                    <div class="classwork-info-item">
                        <i class="bx bx-star"></i>

                        <div>
                            <span>Points</span>
                            <strong>
                                {{ rtrim(rtrim(number_format($projectPoints, 2), '0'), '.') }}
                            </strong>
                        </div>
                    </div>

                    {{-- DUE DATE --}}
                    @if($project->due_date)
                        <div class="classwork-info-item">
                            <i class="bx bx-calendar"></i>

                            <div>
                                <span>Due Date</span>
                                <strong>
                                    {{ \Carbon\Carbon::parse($project->due_date)->format('M d, Y') }}
                                </strong>
                            </div>
                        </div>
                    @endif

                    {{-- DUE TIME --}}
                    @if($project->due_time)
                        <div class="classwork-info-item">
                            <i class="bx bx-time"></i>

                            <div>
                                <span>Due Time</span>
                                <strong>
                                    {{ \Carbon\Carbon::parse($project->due_time)->format('h:i A') }}
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

                <div class="submission-status-sidebar {{ $submission && $submission->submitted_at ? 'submitted' : '' }}">

                    <i class="bx {{ $submission && $submission->submitted_at
                        ? 'bx-check-circle'
                        : 'bx-time-five' }}"></i>

                    <div>
                        <span>Status</span>
                        <strong>
                            {{ $submission && $submission->submitted_at
                                ? 'Submitted'
                                : 'Not Submitted' }}
                        </strong>
                    </div>

                </div>

                @if($studentScore !== null)
                    <div class="classwork-info-list">
                        <div class="classwork-info-item">
                            <i class="bx bx-star"></i>

                            <div>
                                <span>
                                    {{ $project->project_type === 'team' && $gradeLabel === 'Team Grade'
                                        ? 'Team Grade'
                                        : 'Grade' }}
                                </span>

                                <strong>
                                    {{ rtrim(rtrim(number_format($scoreValue, 2), '0'), '.') }}
                                    /
                                    {{ rtrim(rtrim(number_format($projectPoints, 2), '0'), '.') }}
                                </strong>
                            </div>
                        </div>
                    </div>
                @endif

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

        <div class="project-viewer-header">

            <div class="project-viewer-title">
                <i class="bx bx-file"></i>
                <span id="projectViewerTitle">
                    Project Attachment
                </span>
            </div>

            <div class="project-viewer-actions">

                <button
                    type="button"
                    class="project-viewer-btn"
                    onclick="toggleProjectFullscreen()"
                    title="Fullscreen"
                >
                    <i class="bx bx-fullscreen"></i>
                </button>

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

        <div class="project-viewer-body">
            <iframe
                id="projectViewerFrame"
                src=""
                frameborder="0"
            ></iframe>
        </div>

    </div>
</div>

<script>
    /* ============================================================
       PROJECT FILE VIEWER
    ============================================================ */

    function openProjectFile(fileUrl, fileName) {
        const modal = document.getElementById('projectViewerModal');
        const iframe = document.getElementById('projectViewerFrame');
        const title = document.getElementById('projectViewerTitle');

        if (!modal || !iframe) {
            return;
        }

        if (title) {
            title.textContent = fileName || 'Project Attachment';
        }

        iframe.src = fileUrl;
        modal.classList.add('active');
        document.body.classList.add('project-modal-open');
    }

    function closeProjectModal() {
        const modal = document.getElementById('projectViewerModal');
        const iframe = document.getElementById('projectViewerFrame');

        if (!modal || !iframe) {
            return;
        }

        iframe.src = '';
        modal.classList.remove('active');
        document.body.classList.remove('project-modal-open');

        if (document.fullscreenElement) {
            document.exitFullscreen();
        }
    }

    function toggleProjectFullscreen() {
        const container = document.querySelector(
            '#projectViewerModal .project-viewer-container'
        );

        if (!container) {
            return;
        }

        if (!document.fullscreenElement) {
            container.requestFullscreen().catch(function(error) {
                console.error('Fullscreen failed:', error);
            });
        } else {
            document.exitFullscreen();
        }
    }

    const projectModal = document.getElementById('projectViewerModal');

    if (projectModal) {
        projectModal.addEventListener('click', function(event) {
            if (event.target === projectModal) {
                closeProjectModal();
            }
        });
    }

    document.addEventListener('keydown', function(event) {
        if (event.key !== 'Escape') {
            return;
        }

        if (document.fullscreenElement) {
            return;
        }

        const modal = document.getElementById('projectViewerModal');

        if (modal && modal.classList.contains('active')) {
            closeProjectModal();
        }
    });
</script>

<script>
    /* ============================================================
       SUBMISSION FILE SELECTION
       Matches the Assignment show page behavior.
    ============================================================ */

    document.addEventListener('DOMContentLoaded', function() {
        const fileInput = document.getElementById('submissionFiles');
        const uploadArea = document.getElementById('submissionUploadArea');
        const browseButton = document.getElementById('submissionBrowseBtn');
        const selectedContainer = document.getElementById('selectedSubmissionFiles');
        const selectedFileList = document.getElementById('selectedFileList');
        const selectedFileCount = document.getElementById('selectedFileCount');
        const submitButton = document.getElementById('submissionSubmitBtn');

        if (!fileInput || !uploadArea || !browseButton || !selectedContainer ||
            !selectedFileList || !selectedFileCount || !submitButton) {
            return;
        }

        let selectedFiles = [];

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

        fileInput.addEventListener('change', function() {
            const newFiles = Array.from(this.files);

            selectedFiles = [
                ...selectedFiles,
                ...newFiles
            ];

            updateFileInput();
            updateFileList();
        });

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
                const fileElement = document.createElement('div');
                fileElement.className = 'student-submission-selected-file';

                fileElement.innerHTML = `
                    <div class="student-submission-selected-file-icon">
                        <i class="bx bx-file"></i>
                    </div>

                    <div
                        class="student-submission-selected-file-name"
                        title="${escapeHtml(file.name)}"
                    >
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

        function attachRemoveEvents() {
            const removeButtons = document.querySelectorAll(
                '.student-submission-remove-file'
            );

            removeButtons.forEach(function(button) {
                button.addEventListener('click', function() {
                    const index = Number(this.dataset.index);

                    selectedFiles.splice(index, 1);
                    updateFileInput();
                    updateFileList();
                });
            });
        }

        function updateFileInput() {
            const dataTransfer = new DataTransfer();

            selectedFiles.forEach(function(file) {
                dataTransfer.items.add(file);
            });

            fileInput.files = dataTransfer.files;
        }

        function escapeHtml(value) {
            const div = document.createElement('div');
            div.textContent = value;
            return div.innerHTML;
        }
    });
</script>

@endsection
