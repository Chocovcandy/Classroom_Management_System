@extends('layouts.prof_layout')

@section('title', 'Manage Student Teams')

@php
    $returnTo = request('return_to', 'classwork');

    $groups = $project->groups
        ->sortBy('group_number')
        ->values();

    $totalTeams = $groups->count();

    $totalAssigned = $groups->sum(
        fn ($group) => $group->members->count()
    );

    $totalLeaders = $groups->sum(
        fn ($group) => $group->members
            ->where('role', 'leader')
            ->count()
    );

    $totalBackups = $groups->sum(
        fn ($group) => $group->members
            ->where('role', 'backup')
            ->count()
    );

    $projectUrl = route(
        'professor.classworks.projects.show',
        [
            'classGroupId' => $classGroup->id,
            'projectId' => $project->id,
            'return_to' => $returnTo,
        ]
    );
@endphp

@section('content')

<style>
    /*
    |--------------------------------------------------------------------------
    | PROJECT TEAM MANAGEMENT
    |--------------------------------------------------------------------------
    | This stylesheet is intentionally scoped to #projectTeamManager.
    | It does NOT use generic .btn, .modal, .form-control, etc.
    | This prevents layout.css / dark-mode.css from hiding the buttons.
    |--------------------------------------------------------------------------
    */

    #projectTeamManager {
        --pt-page: #f5f7fb;
        --pt-white: #ffffff;
        --pt-soft: #fafbfc;
        --pt-border: #e4e8ee;
        --pt-border-soft: #eef1f4;

        --pt-heading: #202532;
        --pt-text: #3f4653;
        --pt-muted: #7c8695;

        --pt-blue: #355cff;
        --pt-blue-hover: #2b4bdf;
        --pt-blue-soft: #eef2ff;

        --pt-yellow: #d4a000;
        --pt-yellow-soft: #fff8dc;
        --pt-yellow-border: #efd77c;

        --pt-green: #16834b;
        --pt-green-soft: #edf9f2;

        --pt-red: #d83e49;
        --pt-red-hover: #b92f39;
        --pt-red-soft: #fff1f2;

        width: 100%;
        min-height: 100%;
        padding: 30px 26px 60px;
        background: var(--pt-page);
        color: var(--pt-text);
    }

    #projectTeamManager,
    #projectTeamManager * {
        box-sizing: border-box;
    }

    #projectTeamManager .pt-page {
        width: 100%;
        max-width: 1500px;
        margin: 0 auto;
    }

    /* ============================================================
       HEADER
       ============================================================ */

    #projectTeamManager .pt-header {
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        gap: 20px;
        margin-bottom: 17px;
    }

    #projectTeamManager .pt-header-left {
        min-width: 0;
    }

    #projectTeamManager .pt-back {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        margin-bottom: 10px;
        color: var(--pt-muted);
        font-size: 16px;
        font-weight: 700;
        text-decoration: none;
    }

    #projectTeamManager .pt-back:hover {
        color: var(--pt-blue);
    }

    #projectTeamManager .pt-kicker {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        color: #68758a;
        font-size: 19px;
        font-weight: 800;
        letter-spacing: .1em;
        text-transform: uppercase;
    }

    #projectTeamManager .pt-kicker::before {
        content: "";
        width: 6px;
        height: 6px;
        border-radius: 50%;
        background: var(--pt-yellow);
    }

    #projectTeamManager .pt-title {
        margin: 4px 0 0;
        color: var(--pt-heading);
        font-size: 34px;
        line-height: 1.18;
        font-weight: 800;
        letter-spacing: -.025em;
    }

    #projectTeamManager .pt-description {
        max-width: 720px;
        margin: 7px 0 0;
        color: var(--pt-muted);
        font-size: 17px;
        line-height: 1.6;
    }

    #projectTeamManager .pt-header-tools {
        display: flex;
        align-items: center;
        gap: 8px;
        flex-shrink: 0;
    }

    #projectTeamManager .pt-course {
        display: inline-flex;
        align-items: center;
        gap: 7px;
        min-height: 38px;
        padding: 0 11px;
        border: 1px solid var(--pt-border);
        border-radius: 9px;
        background: #fff;
        color: #5c6777;
        font-size: 14px;
        font-weight: 750;
    }

    #projectTeamManager .pt-course i {
        color: var(--pt-blue);
        font-size: 17px;
    }

    #projectTeamManager .pt-primary-action {
        display: inline-flex !important;
        align-items: center !important;
        justify-content: center !important;
        gap: 6px !important;
        min-height: 46px !important;
        padding: 0 12px !important;
        border: 1px solid var(--pt-blue) !important;
        border-radius: 9px !important;
        background: var(--pt-blue) !important;
        color: #fff !important;
        font-family: inherit !important;
        font-size: 15px !important;
        font-weight: 800 !important;
        opacity: 1 !important;
        visibility: visible !important;
        cursor: pointer !important;
    }

    #projectTeamManager .pt-primary-action:hover {
        border-color: var(--pt-blue-hover) !important;
        background: var(--pt-blue-hover) !important;
        color: #fff !important;
    }

    /* ============================================================
       PROJECT CARD
       ============================================================ */

    #projectTeamManager .pt-project-card {
        position: relative;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 18px;
        overflow: hidden;
        min-height: 100px;
        margin-bottom: 13px;
        padding: 20px 22px 20px 24px;
        border: 1px solid var(--pt-border);
        border-radius: 13px;
        background: #fff;
        box-shadow: 0 2px 12px rgba(25, 35, 55, .03);
    }

    #projectTeamManager .pt-project-card::before {
        content: "";
        position: absolute;
        left: 0;
        top: 12px;
        bottom: 12px;
        width: 3px;
        border-radius: 0 3px 3px 0;
        background: var(--pt-yellow);
    }

    #projectTeamManager .pt-project-main {
        display: flex;
        align-items: center;
        gap: 11px;
        min-width: 0;
    }

    #projectTeamManager .pt-project-icon {
        width: 50px;
        height: 50px;
        display: grid;
        place-items: center;
        flex: 0 0 50px;
        border: 1px solid var(--pt-yellow-border);
        border-radius: 10px;
        background: var(--pt-yellow-soft);
        color: var(--pt-yellow);
        font-size: 24px;
    }

    #projectTeamManager .pt-project-copy {
        min-width: 0;
    }

    #projectTeamManager .pt-project-label {
        display: block;
        margin-bottom: 3px;
        color: #9aa2ae;
        font-size: 13px;
        font-weight: 800;
        letter-spacing: .08em;
        text-transform: uppercase;
    }

    #projectTeamManager .pt-project-title {
        display: block;
        overflow: hidden;
        color: var(--pt-heading);
        font-size: 20px;
        font-weight: 800;
        text-overflow: ellipsis;
        white-space: nowrap;
    }

    #projectTeamManager .pt-project-badge {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        min-height: 28px;
        padding: 0 9px;
        border: 1px solid var(--pt-yellow-border);
        border-radius: 999px;
        background: var(--pt-yellow-soft);
        color: #997300;
        font-size: 11px;
        font-weight: 800;
    }

    /* ============================================================
       SUMMARY
       ============================================================ */

    #projectTeamManager .pt-summary {
        display: grid;
        grid-template-columns: repeat(4, minmax(0, 1fr));
        gap: 11px;
        margin-bottom: 15px;
    }

    #projectTeamManager .pt-summary-card {
        display: flex;
        align-items: center;
        gap: 10px;
        min-height: 88px;
        padding: 15px 17px;
        border: 1px solid var(--pt-border);
        border-radius: 11px;
        background: #fff;
        box-shadow: 0 2px 9px rgba(25, 35, 55, .025);
    }

    #projectTeamManager .pt-summary-icon {
        width: 42px;
        height: 42px;
        display: grid;
        place-items: center;
        flex: 0 0 42px;
        border-radius: 9px;
        background: #f3f5f8;
        color: #667180;
        font-size: 21px;
    }

    #projectTeamManager .pt-summary-icon.blue {
        background: var(--pt-blue-soft);
        color: var(--pt-blue);
    }

    #projectTeamManager .pt-summary-icon.yellow {
        background: var(--pt-yellow-soft);
        color: var(--pt-yellow);
    }

    #projectTeamManager .pt-summary-icon.green {
        background: var(--pt-green-soft);
        color: var(--pt-green);
    }

    #projectTeamManager .pt-summary-label {
        display: block;
        margin-bottom: 3px;
        color: var(--pt-muted);
        font-size: 13px;
        font-weight: 700;
    }

    #projectTeamManager .pt-summary-value {
        display: block;
        color: var(--pt-heading);
        font-size: 26px;
        line-height: 1;
        font-weight: 800;
    }

    /* ============================================================
       TEAMS PANEL
       ============================================================ */

    #projectTeamManager .pt-panel {
        overflow: hidden;
        border: 1px solid var(--pt-border);
        border-radius: 13px;
        background: #fff;
        box-shadow: 0 3px 14px rgba(25, 35, 55, .03);
    }

    #projectTeamManager .pt-panel-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 15px;
        min-height: 72px;
        padding: 14px 20px;
        border-bottom: 1px solid var(--pt-border);
    }

    #projectTeamManager .pt-panel-heading {
        display: flex;
        align-items: center;
        gap: 9px;
        min-width: 0;
    }

    #projectTeamManager .pt-panel-icon {
        width: 34px;
        height: 34px;
        display: grid;
        place-items: center;
        flex: 0 0 34px;
        border-radius: 8px;
        background: #f3f5f8;
        color: #606c7b;
        font-size: 18px;
    }

    #projectTeamManager .pt-panel-heading h2 {
        margin: 0;
        color: var(--pt-heading);
        font-size: 21px;
        font-weight: 800;
    }

    #projectTeamManager .pt-panel-heading p {
        margin: 3px 0 0;
        color: #98a1ae;
        font-size: 13px;
    }

    #projectTeamManager .pt-panel-count {
        min-height: 27px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 0 9px;
        border: 1px solid var(--pt-border);
        border-radius: 999px;
        background: #fafbfc;
        color: #687383;
        font-size: 11px;
        font-weight: 800;
    }

    #projectTeamManager .pt-team-grid {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 11px;
        padding: 16px;
        background: #f8f9fb;
    }

    /* ============================================================
       TEAM CARD
       ============================================================ */

    #projectTeamManager .pt-team-card {
        position: relative;
        min-width: 0;
        border: 1px solid var(--pt-border);
        border-radius: 11px;
        background: #fff;
        transition: .18s ease;
    }

    #projectTeamManager .pt-team-card:hover {
        border-color: #d6dce4;
        box-shadow: 0 8px 20px rgba(25, 35, 55, .05);
        transform: translateY(-1px);
    }

    #projectTeamManager .pt-team-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 10px;
        padding: 14px 16px;
        border-bottom: 1px solid var(--pt-border-soft);
    }

    #projectTeamManager .pt-team-heading {
        display: flex;
        align-items: center;
        gap: 9px;
        min-width: 0;
    }

    #projectTeamManager .pt-team-number {
        width: 38px;
        height: 38px;
        display: grid;
        place-items: center;
        flex: 0 0 38px;
        border: 1px solid #d8dff8;
        border-radius: 8px;
        background: #f6f8ff;
        color: var(--pt-blue);
        font-size: 12px;
        font-weight: 900;
    }

    #projectTeamManager .pt-team-copy {
        min-width: 0;
    }

    #projectTeamManager .pt-team-name {
        display: block;
        overflow: hidden;
        color: #343a47;
        font-size: 16px;
        font-weight: 800;
        text-overflow: ellipsis;
        white-space: nowrap;
    }

    #projectTeamManager .pt-team-count {
        display: block;
        margin-top: 2px;
        color: #9aa2ae;
        font-size: 12px;
    }

    /* Team menu */
    #projectTeamManager .pt-menu-wrap {
        position: relative;
        flex-shrink: 0;
    }

    #projectTeamManager .pt-menu-button {
        width: 34px !important;
        height: 34px !important;
        display: grid !important;
        place-items: center !important;
        padding: 0 !important;
        border: 1px solid transparent !important;
        border-radius: 7px !important;
        background: transparent !important;
        color: #818a98 !important;
        font-size: 21px !important;
        cursor: pointer !important;
    }

    #projectTeamManager .pt-menu-button:hover,
    #projectTeamManager .pt-menu-button.open {
        border-color: var(--pt-border) !important;
        background: #f7f8fa !important;
        color: var(--pt-blue) !important;
    }

    #projectTeamManager .pt-menu {
        position: absolute;
        z-index: 100;
        top: calc(100% + 5px);
        right: 0;
        display: none;
        width: 205px;
        padding: 5px;
        border: 1px solid var(--pt-border);
        border-radius: 9px;
        background: #fff;
        box-shadow: 0 15px 32px rgba(20, 30, 48, .14);
    }

    #projectTeamManager .pt-menu.open {
        display: block;
    }

    #projectTeamManager .pt-menu-item,
    #projectTeamManager .pt-menu button,
    #projectTeamManager .pt-menu a {
        width: 100%;
        min-height: 32px;
        display: flex !important;
        align-items: center !important;
        gap: 7px !important;
        padding: 0 8px !important;
        border: 0 !important;
        border-radius: 6px !important;
        background: transparent !important;
        color: #596474 !important;
        font-family: inherit !important;
        font-size: 11px !important;
        font-weight: 700 !important;
        text-align: left !important;
        text-decoration: none !important;
        cursor: pointer !important;
    }

    #projectTeamManager .pt-menu-item:hover,
    #projectTeamManager .pt-menu button:hover,
    #projectTeamManager .pt-menu a:hover {
        background: #f5f7fa !important;
        color: var(--pt-blue) !important;
    }

    #projectTeamManager .pt-menu .danger:hover {
        background: var(--pt-red-soft) !important;
        color: var(--pt-red) !important;
    }

    #projectTeamManager .pt-menu i {
        width: 15px;
        text-align: center;
        font-size: 15px;
    }

    /* ============================================================
       MEMBERS
       ============================================================ */

    #projectTeamManager .pt-members {
        padding: 2px 12px 5px;
    }

    #projectTeamManager .pt-member {
        display: flex;
        align-items: center;
        gap: 8px;
        min-width: 0;
        padding: 11px 0;
        border-bottom: 1px solid #f1f3f6;
    }

    #projectTeamManager .pt-member:last-child {
        border-bottom: 0;
    }

    #projectTeamManager .pt-avatar {
        width: 38px;
        height: 38px;
        display: grid;
        place-items: center;
        overflow: hidden;
        flex: 0 0 38px;
        border: 1px solid #e3e7ec;
        border-radius: 50%;
        background: #f3f5f7;
        color: #697382;
        font-size: 11px;
        font-weight: 800;
    }

    #projectTeamManager .pt-avatar img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    #projectTeamManager .pt-member-info {
        min-width: 0;
        flex: 1;
    }

    #projectTeamManager .pt-member-name {
        display: block;
        overflow: hidden;
        color: #424955;
        font-size: 14px;
        font-weight: 700;
        text-overflow: ellipsis;
        white-space: nowrap;
    }

    #projectTeamManager .pt-member-role {
        display: inline-flex;
        align-items: center;
        gap: 4px;
        margin-top: 2px;
        font-size: 12px;
        font-weight: 750;
    }

    #projectTeamManager .pt-member-role.leader {
        color: #9c7500;
    }

    #projectTeamManager .pt-member-role.backup {
        color: #596bb8;
    }

    #projectTeamManager .pt-member-role.member {
        color: #8d96a3;
    }

    #projectTeamManager .pt-member-action-wrap {
        position: relative;
        flex-shrink: 0;
    }

    #projectTeamManager .pt-member-menu-button {
        width: 31px !important;
        height: 31px !important;
        display: grid !important;
        place-items: center !important;
        padding: 0 !important;
        border: 1px solid transparent !important;
        border-radius: 6px !important;
        background: transparent !important;
        color: #9aa2ad !important;
        font-size: 19px !important;
        cursor: pointer !important;
    }

    #projectTeamManager .pt-member-menu-button:hover,
    #projectTeamManager .pt-member-menu-button.open {
        border-color: var(--pt-border) !important;
        background: #f7f8fa !important;
        color: var(--pt-blue) !important;
    }

    #projectTeamManager .pt-member-menu {
        position: absolute;
        z-index: 120;
        top: calc(100% + 4px);
        right: 0;
        display: none;
        width: 195px;
        padding: 5px;
        border: 1px solid var(--pt-border);
        border-radius: 9px;
        background: #fff;
        box-shadow: 0 13px 30px rgba(20, 30, 48, .14);
    }

    #projectTeamManager .pt-member-menu.open {
        display: block;
    }

    #projectTeamManager .pt-member-menu button {
        width: 100% !important;
        min-height: 37px !important;
        display: flex !important;
        align-items: center !important;
        gap: 7px !important;
        padding: 0 8px !important;
        border: 0 !important;
        border-radius: 6px !important;
        background: transparent !important;
        color: #596474 !important;
        font-family: inherit !important;
        font-size: 13px !important;
        font-weight: 700 !important;
        text-align: left !important;
        cursor: pointer !important;
    }

    #projectTeamManager .pt-member-menu button:hover {
        background: #f5f7fa !important;
        color: var(--pt-blue) !important;
    }

    #projectTeamManager .pt-member-menu button.danger:hover {
        background: var(--pt-red-soft) !important;
        color: var(--pt-red) !important;
    }

    #projectTeamManager .pt-member-menu i {
        width: 15px;
        text-align: center;
        font-size: 15px;
    }

    /* ============================================================
       TEAM FOOTER
       ============================================================ */

    #projectTeamManager .pt-team-footer {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 10px;
        min-height: 44px;
        padding: 7px 12px;
        border-top: 1px solid var(--pt-border-soft);
        border-radius: 0 0 11px 11px;
        background: #fbfcfd;
    }

    #projectTeamManager .pt-ready {
        display: inline-flex;
        align-items: center;
        gap: 4px;
        color: var(--pt-green);
        font-size: 14px;
        font-weight: 800;
    }

    #projectTeamManager .pt-ready i {
        font-size: 13px;
    }

    #projectTeamManager .pt-view {
        display: inline-flex;
        align-items: center;
        gap: 4px;
        color: var(--pt-blue);
        font-size: 12px;
        font-weight: 800;
        text-decoration: none;
    }

    /* ============================================================
       EMPTY STATES
       ============================================================ */

    #projectTeamManager .pt-empty {
        padding: 44px 20px;
        text-align: center;
    }

    #projectTeamManager .pt-empty-icon {
        width: 49px;
        height: 49px;
        display: grid;
        place-items: center;
        margin: 0 auto 11px;
        border: 1px solid var(--pt-border);
        border-radius: 13px;
        background: #f7f8fa;
        color: #a0a8b3;
        font-size: 23px;
    }

    #projectTeamManager .pt-empty h3 {
        margin: 0;
        color: #4b5360;
        font-size: 15px;
        font-weight: 800;
    }

    #projectTeamManager .pt-empty p {
        max-width: 430px;
        margin: 5px auto 0;
        color: #99a1ad;
        font-size: 12px;
        line-height: 1.55;
    }

    #projectTeamManager .pt-empty-action {
        display: inline-flex !important;
        align-items: center !important;
        justify-content: center !important;
        gap: 5px !important;
        min-height: 31px !important;
        margin-top: 12px !important;
        padding: 0 10px !important;
        border: 1px solid #cdd8ff !important;
        border-radius: 7px !important;
        background: #fff !important;
        color: var(--pt-blue) !important;
        font-family: inherit !important;
        font-size: 11px !important;
        font-weight: 800 !important;
        cursor: pointer !important;
    }

    /* ============================================================
       UNASSIGNED
       ============================================================ */

    #projectTeamManager .pt-unassigned {
        overflow: hidden;
        margin-top: 10px;
        border: 1px solid var(--pt-border);
        border-radius: 13px;
        background: #fff;
        box-shadow: 0 2px 12px rgba(25, 35, 55, .025);

      
    }

    #projectTeamManager .pt-unassigned-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 10px;
        padding: 15px 20px;
        border-bottom: 1px solid var(--pt-border);
    }

    #projectTeamManager .pt-unassigned-title {
        display: flex;
        align-items: center;
        gap: 9px;
    }

    #projectTeamManager .pt-unassigned-icon {
        width: 31px;
        height: 31px;
        display: grid;
        place-items: center;
        border-radius: 8px;
        background: #f3f5f7;
        color: #687382;
        font-size: 17px;
    }

    #projectTeamManager .pt-unassigned-title h2 {
        margin: 0;
        color: var(--pt-heading);
        font-size: 16px;
        font-weight: 800;
    }

    #projectTeamManager .pt-unassigned-title p {
        margin: 2px 0 0;
        color: #9aa2ae;
        font-size: 12px;
    }

    #projectTeamManager .pt-unassigned-count {
        min-width: 26px;
        height: 26px;
        display: grid;
        place-items: center;
        border-radius: 50%;
        background: #f2f4f7;
        color: #687383;
        font-size: 11px;
        font-weight: 800;
    }

    #projectTeamManager .pt-unassigned-list {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 0 20px;
        padding: 2px 16px 5px;
        margin-bottom: 10px
    }

    #projectTeamManager .pt-unassigned-row {
        display: flex;
        align-items: center;
        gap: 10px;
        min-width: 0;
        padding: 10px 0;
        border-bottom: 1px solid #f1f3f6;
    }

    #projectTeamManager .pt-assign {
        display: inline-flex !important;
        align-items: center !important;
        justify-content: center !important;
        gap: 5px !important;
        min-height: 27px !important;
        padding: 0 8px !important;
        border: 1px solid #cdd8ff !important;
        border-radius: 7px !important;
        background: #fff !important;
        color: var(--pt-blue) !important;
        font-family: inherit !important;
        font-size: 10px !important;
        font-weight: 800 !important;
        cursor: pointer !important;
    }

    /* ============================================================
       MODAL SYSTEM
       ============================================================ */

    #projectTeamManager .pt-modal {
        position: fixed;
        inset: 0;
        z-index: 99999;
        display: none;
        align-items: center;
        justify-content: center;
        padding: 24px;
        background: rgba(28, 36, 50, .42);
        backdrop-filter: blur(3px);
    }

    #projectTeamManager .pt-modal.show {
        display: flex;
    }

    #projectTeamManager .pt-modal-dialog {
        width: 100%;
        max-width: 760px;
        max-height: calc(100vh - 32px);
        overflow: auto;
        border: 1px solid #dfe4eb;
        border-radius: 18px;
        background: #fff;
        box-shadow: 0 25px 70px rgba(25, 35, 50, .20);
        animation: ptModalIn .16s ease;
    }

    @keyframes ptModalIn {
        from {
            opacity: 0;
            transform: translateY(7px) scale(.99);
        }

        to {
            opacity: 1;
            transform: translateY(0) scale(1);
        }
    }

    #projectTeamManager .pt-modal-header {
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        gap: 14px;
        padding: 30px 32px 22px;
    }

    #projectTeamManager .pt-modal-heading {
        display: flex;
        align-items: flex-start;
        gap: 10px;
        min-width: 0;
    }

    #projectTeamManager .pt-modal-icon {
        width: 50px;
        height: 50px;
        display: grid;
        place-items: center;
        flex: 0 0 50px;
        border-radius: 9px;
        background: var(--pt-blue-soft);
        color: var(--pt-blue);
        font-size: 25px;
    }

    #projectTeamManager .pt-modal-title {
        margin: 0;
        color: var(--pt-heading);
        font-size: 27px;
        font-weight: 800;
    }

    #projectTeamManager .pt-modal-description {
        margin: 4px 0 0;
        color: #8993a1;
        font-size: 17px;
        line-height: 1.55;
    }

    #projectTeamManager .pt-close {
        width: 44px !important;
        height: 44px !important;
        display: grid !important;
        place-items: center !important;
        padding: 0 !important;
        border: 0 !important;
        border-radius: 7px !important;
        background: transparent !important;
        color: #7c8694 !important;
        font-size: 27px !important;
        cursor: pointer !important;
    }

    #projectTeamManager .pt-close:hover {
        background: #f3f5f7 !important;
        color: #303744 !important;
    }

    #projectTeamManager .pt-modal-body {
        padding: 10px 32px 32px;
    }

    #projectTeamManager .pt-context {
        display: flex;
        align-items: center;
        gap: 9px;
        margin-bottom: 13px;
        padding: 14px 16px;
        border: 1px solid var(--pt-border);
        border-radius: 10px;
        background: #fafbfc;
    }

    #projectTeamManager .pt-context-icon {
        width: 40px;
        height: 40px;
        display: grid;
        place-items: center;
        flex: 0 0 40px;
        border-radius: 7px;
        background: #f0f3f6;
        color: #697584;
        font-size: 19px;
    }

    #projectTeamManager .pt-context-label {
        display: block;
        margin-bottom: 1px;
        color: #a0a8b3;
        font-size: 12px;
        font-weight: 800;
        letter-spacing: .08em;
        text-transform: uppercase;
    }

    #projectTeamManager .pt-context-value {
        display: block;
        overflow: hidden;
        color: #3e4652;
        font-size: 15px;
        font-weight: 800;
        text-overflow: ellipsis;
        white-space: nowrap;
    }

    #projectTeamManager .pt-stepbar {
        display: flex;
        align-items: center;
        gap: 9px;
        margin-bottom: 18px;
        padding: 13px 16px;
        border: 1px solid var(--pt-border);
        border-radius: 9px;
        background: #fafbfc;
    }

    #projectTeamManager .pt-step {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        color: #74808f;
        font-size: 12px;
        font-weight: 800;
        white-space: nowrap;
    }

    #projectTeamManager .pt-step-number {
        width: 30px;
        height: 30px;
        display: grid;
        place-items: center;
        flex: 0 0 30px;
        border-radius: 50%;
        background: #e7ebef;
        color: #66717f;
        font-size: 12px;
    }

    #projectTeamManager .pt-step.active .pt-step-number {
        background: var(--pt-blue);
        color: #fff;
    }

    #projectTeamManager .pt-step-divider {
        flex: 1;
        height: 1px;
        background: #dfe4ea;
    }

    #projectTeamManager .pt-field-card {
        padding: 18px;
        border: 1px solid var(--pt-border);
        border-radius: 11px;
        background: #fff;
    }

    #projectTeamManager .pt-field-card + .pt-field-card {
        margin-top: 10px;
    }

    #projectTeamManager .pt-field-heading {
        display: flex;
        align-items: center;
        gap: 7px;
        margin-bottom: 8px;
    }

    #projectTeamManager .pt-field-icon {
        width: 36px;
        height: 36px;
        display: grid;
        place-items: center;
        border-radius: 6px;
        background: var(--pt-blue-soft);
        color: var(--pt-blue);
        font-size: 18px;
    }

    #projectTeamManager .pt-field-title {
        margin: 0;
        color: #3d4551;
        font-size: 15px;
        font-weight: 800;
    }

    #projectTeamManager .pt-field-description {
        margin: 1px 0 0;
        color: #9aa3af;
        font-size: 12px;
    }

    #projectTeamManager .pt-input,
    #projectTeamManager .pt-select {
        width: 100% !important;
        min-height: 50px !important;
        padding: 0 14px !important;
        border: 1px solid #d2d8e0 !important;
        border-radius: 8px !important;
        outline: none !important;
        background: #fff !important;
        color: #303744 !important;
        font-family: inherit !important;
        font-size: 15px !important;
    }

    #projectTeamManager .pt-input:focus,
    #projectTeamManager .pt-select:focus {
        border-color: #9eafff !important;
        box-shadow: 0 0 0 3px rgba(53, 92, 255, .08) !important;
    }

    #projectTeamManager .pt-help {
        margin-top: 6px;
        color: #99a1ad;
        font-size: 12px;
        line-height: 1.5;
    }

    #projectTeamManager .pt-modal-footer {
        display: flex;
        justify-content: flex-end;
        gap: 8px;
        padding: 20px 32px 24px;
        border-top: 1px solid var(--pt-border);
        background: #fbfcfd;
    }

    /*
    |--------------------------------------------------------------------------
    | VERY IMPORTANT
    | Modal buttons are isolated from every generic button class.
    | These declarations intentionally use !important.
    |--------------------------------------------------------------------------
    */

    #projectTeamManager .pt-modal-button {
        display: inline-flex !important;
        align-items: center !important;
        justify-content: center !important;
        gap: 6px !important;

        min-width: 128px !important;
        min-height: 52px !important;
        padding: 0 20px !important;

        border: 1px solid #d2d8e0 !important;
        border-radius: 8px !important;

        background: #ffffff !important;
        color: #505b69 !important;

        font-family: inherit !important;
        font-size: 14px !important;
        font-weight: 800 !important;
        line-height: 1 !important;

        opacity: 1 !important;
        visibility: visible !important;
        text-indent: 0 !important;

        cursor: pointer !important;
        box-shadow: none !important;
    }

    #projectTeamManager .pt-modal-button:hover {
        background: #f5f7f9 !important;
        color: #303744 !important;
    }

    #projectTeamManager .pt-modal-button.primary {
        min-width: 150px !important;
        border-color: #355cff !important;
        background: #355cff !important;
        color: #ffffff !important;
        box-shadow: 0 4px 12px rgba(53, 92, 255, .18) !important;
    }

    #projectTeamManager .pt-modal-button.primary:hover {
        border-color: #2948d8 !important;
        background: #2948d8 !important;
        color: #ffffff !important;
    }

    #projectTeamManager .pt-modal-button.danger {
        min-width: 138px !important;
        border-color: #d83e49 !important;
        background: #d83e49 !important;
        color: #ffffff !important;
        box-shadow: 0 4px 12px rgba(216, 62, 73, .14) !important;
    }

    #projectTeamManager .pt-modal-button.danger:hover {
        border-color: #b92f39 !important;
        background: #b92f39 !important;
        color: #ffffff !important;
    }

    /* ============================================================
       RESPONSIVE
       ============================================================ */

    @media (max-width: 1050px) {
        #projectTeamManager .pt-summary {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }

        #projectTeamManager .pt-team-grid {
            grid-template-columns: 1fr;
        }
    }

    @media (max-width: 720px) {
        #projectTeamManager {
            padding: 18px 13px 38px;
        }

        #projectTeamManager .pt-header {
            flex-direction: column;
        }

        #projectTeamManager .pt-header-tools {
            width: 100%;
            flex-wrap: wrap;
        }

        #projectTeamManager .pt-course {
            flex: 1;
        }

        #projectTeamManager .pt-project-card {
            align-items: flex-start;
            flex-direction: column;
        }

        #projectTeamManager .pt-project-badge {
            align-self: flex-start;
        }

        #projectTeamManager .pt-panel-header {
            align-items: flex-start;
            flex-direction: column;
        }

        #projectTeamManager .pt-unassigned-list {
            grid-template-columns: 1fr;
        }
    }

    @media (max-width: 520px) {
        #projectTeamManager .pt-title {
            font-size: 27px;
        }

        #projectTeamManager .pt-summary {
            grid-template-columns: 1fr;
        }

        #projectTeamManager .pt-stepbar {
            align-items: flex-start;
            flex-direction: column;
        }

        #projectTeamManager .pt-step-divider {
            width: 24px;
            flex: 0 0 auto;
        }

        #projectTeamManager .pt-modal {
            padding: 8px;
        }

        #projectTeamManager .pt-modal-dialog {
            max-width: 100%;
            max-height: calc(100vh - 20px);
        }

        #projectTeamManager .pt-modal-header,
        #projectTeamManager .pt-modal-body {
            padding-left: 18px;
            padding-right: 18px;
        }

        #projectTeamManager .pt-modal-footer {
            padding-left: 18px;
            padding-right: 18px;
        }

        #projectTeamManager .pt-modal-footer {
            flex-wrap: wrap;
        }

        #projectTeamManager .pt-modal-button {
            flex: 1;
        }
    }

/* ============================================================
   FINAL PROJECT TEAM MANAGEMENT REDESIGN
   Clean blue layout + stronger yellow project accent
   Keeps the existing Blade structure, routes, forms and JavaScript.
   ============================================================ */

#projectTeamManager {
    --pt-page: #f6f8fc;
    --pt-white: #ffffff;
    --pt-soft: #fbfcff;
    --pt-border: #e2e8f2;
    --pt-border-soft: #edf1f7;

    --pt-heading: #26344d;
    --pt-text: #526078;
    --pt-muted: #8490a5;

    --pt-blue: #2f63e8;
    --pt-blue-hover: #2453ce;
    --pt-blue-soft: #edf3ff;

    --pt-yellow: #eab308;
    --pt-yellow-soft: #fff8d9;
    --pt-yellow-border: #f6d66b;

    --pt-green: #15966a;
    --pt-green-soft: #eafaf2;

    --pt-red: #dc4654;
    --pt-red-hover: #bd3442;
    --pt-red-soft: #fff0f2;

    padding: 26px 28px 54px;
    background: var(--pt-page);
    color: var(--pt-text);
}

#projectTeamManager .pt-page {
    max-width: 1440px;
}

#projectTeamManager .pt-header {
    align-items: center;
    gap: 24px;
    margin-bottom: 22px;
}

#projectTeamManager .pt-back {
    margin-bottom: 12px;
    color: #7d8ba1;
    font-size: 16px;
    font-weight: 750;
}

#projectTeamManager .pt-back i {
    color: var(--pt-blue);
    font-size: 19px;
}

#projectTeamManager .pt-kicker {
    color: var(--pt-blue);
    font-size: 14px;
    font-weight: 850;
    letter-spacing: .12em;
}

#projectTeamManager .pt-kicker::before {
    width: 7px;
    height: 7px;
    background: var(--pt-yellow);
    box-shadow: 0 0 0 4px rgba(234, 179, 8, .12);
}

#projectTeamManager .pt-title {
    margin-top: 7px;
    color: var(--pt-heading);
    font-size: clamp(30px, 3vw, 40px);
    line-height: 1.15;
    font-weight: 850;
    letter-spacing: -.035em;
}

#projectTeamManager .pt-description {
    max-width: 680px;
    margin-top: 10px;
    color: #8290a6;
    font-size: 17px;
    line-height: 1.65;
}

#projectTeamManager .pt-header-tools {
    gap: 10px;
}

#projectTeamManager .pt-course {
    min-height: 44px;
    padding: 0 14px;
    border-color: var(--pt-border);
    border-radius: 12px;
    background: var(--pt-white);
    color: #65738b;
    font-size: 14px;
    box-shadow: 0 3px 12px rgba(39, 56, 85, .035);
}

#projectTeamManager .pt-course i {
    color: var(--pt-blue);
}

#projectTeamManager .pt-primary-action {
    min-height: 44px !important;
    padding: 0 16px !important;
    border-radius: 12px !important;
    background: var(--pt-blue) !important;
    border-color: var(--pt-blue) !important;
    font-size: 15px !important;
    box-shadow: 0 7px 16px rgba(47, 99, 232, .16);
}

#projectTeamManager .pt-primary-action:hover {
    background: var(--pt-blue-hover) !important;
    border-color: var(--pt-blue-hover) !important;
    transform: translateY(-1px);
}

#projectTeamManager .pt-project-card {
    min-height: 108px;
    margin-bottom: 16px;
    padding: 22px 24px 22px 27px;
    border-radius: 17px;
    border-color: var(--pt-border);
    background: var(--pt-white);
    box-shadow: 0 5px 20px rgba(39, 56, 85, .045);
}

#projectTeamManager .pt-project-card::before {
    top: 18px;
    bottom: 18px;
    width: 5px;
    background: var(--pt-yellow);
}

#projectTeamManager .pt-project-main {
    gap: 14px;
}

#projectTeamManager .pt-project-icon {
    width: 56px;
    height: 56px;
    flex-basis: 56px;
    border-radius: 16px;
    border-color: var(--pt-yellow-border);
    background: linear-gradient(135deg, #fffbe8 0%, #fff1ad 100%);
    color: #d49a00;
    font-size: 27px;
    box-shadow: 0 5px 14px rgba(234, 179, 8, .12);
}

#projectTeamManager .pt-project-label {
    margin-bottom: 5px;
    color: #9aa6b8;
    font-size: 13px;
}

#projectTeamManager .pt-project-title {
    color: var(--pt-heading);
    font-size: 22px;
    font-weight: 850;
}

#projectTeamManager .pt-project-badge {
    min-height: 31px;
    padding: 0 11px;
    border-color: var(--pt-yellow-border);
    background: var(--pt-yellow-soft);
    color: #b78300;
    font-size: 12px;
}

#projectTeamManager .pt-summary {
    gap: 14px;
    margin-bottom: 18px;
}

#projectTeamManager .pt-summary-card {
    min-height: 104px;
    gap: 13px;
    padding: 18px 20px;
    border-radius: 15px;
    border-color: var(--pt-border);
    background: var(--pt-white);
    box-shadow: 0 4px 15px rgba(39, 56, 85, .035);
}

#projectTeamManager .pt-summary-icon {
    width: 48px;
    height: 48px;
    flex-basis: 48px;
    border-radius: 14px;
    font-size: 24px;
}

#projectTeamManager .pt-summary-icon.blue {
    background: var(--pt-blue-soft);
    color: var(--pt-blue);
}

#projectTeamManager .pt-summary-icon.yellow {
    background: linear-gradient(135deg, #fffbe8, #fff1ad);
    color: #d49a00;
    border: 1px solid var(--pt-yellow-border);
}

#projectTeamManager .pt-summary-icon.green {
    background: var(--pt-green-soft);
    color: var(--pt-green);
}

#projectTeamManager .pt-summary-label {
    margin-bottom: 6px;
    color: #8490a5;
    font-size: 14px;
    font-weight: 750;
}

#projectTeamManager .pt-summary-value {
    color: var(--pt-heading);
    font-size: 31px;
    font-weight: 850;
}

#projectTeamManager .pt-panel,
#projectTeamManager .pt-unassigned {
    border-radius: 17px;
    border-color: var(--pt-border);
    background: var(--pt-white);
    box-shadow: 0 5px 20px rgba(39, 56, 85, .04);
}

#projectTeamManager .pt-panel-header {
    min-height: 82px;
    padding: 18px 23px;
    border-bottom-color: var(--pt-border);
}

#projectTeamManager .pt-panel-icon {
    width: 42px;
    height: 42px;
    flex-basis: 42px;
    border-radius: 12px;
    background: var(--pt-blue-soft);
    color: var(--pt-blue);
    font-size: 22px;
}

#projectTeamManager .pt-panel-heading {
    gap: 12px;
}

#projectTeamManager .pt-panel-heading h2 {
    color: var(--pt-heading);
    font-size: 22px;
    font-weight: 850;
}

#projectTeamManager .pt-panel-heading p {
    margin-top: 5px;
    color: #8b97aa;
    font-size: 14px;
}

#projectTeamManager .pt-panel-count {
    min-height: 31px;
    padding: 0 12px;
    border-color: var(--pt-border);
    background: #f7f9fc;
    color: #65738b;
    font-size: 13px;
}

#projectTeamManager .pt-team-grid {
    gap: 15px;
    padding: 18px;
    background: #f8faff;
}

#projectTeamManager .pt-team-card {
    border-radius: 15px;
    border-color: var(--pt-border);
    background: var(--pt-white);
    box-shadow: 0 3px 12px rgba(39, 56, 85, .025);
}

#projectTeamManager .pt-team-card:hover {
    border-color: #cbd7ed;
    box-shadow: 0 10px 24px rgba(39, 56, 85, .07);
    transform: translateY(-2px);
}

#projectTeamManager .pt-team-header {
    padding: 16px 18px;
    border-bottom-color: var(--pt-border-soft);
}

#projectTeamManager .pt-team-number {
    width: 42px;
    height: 42px;
    flex-basis: 42px;
    border-radius: 12px;
    border-color: var(--pt-yellow-border);
    background: var(--pt-yellow-soft);
    color: #c18b00;
    font-size: 14px;
}

#projectTeamManager .pt-team-name {
    color: var(--pt-heading);
    font-size: 17px;
    font-weight: 850;
}

#projectTeamManager .pt-team-count {
    margin-top: 4px;
    color: #8b97aa;
    font-size: 13px;
}

#projectTeamManager .pt-menu-button,
#projectTeamManager .pt-member-menu-button {
    border-radius: 9px !important;
    color: #8a97aa !important;
}

#projectTeamManager .pt-menu-button:hover,
#projectTeamManager .pt-menu-button.open,
#projectTeamManager .pt-member-menu-button:hover,
#projectTeamManager .pt-member-menu-button.open {
    border-color: #dce4f1 !important;
    background: var(--pt-blue-soft) !important;
    color: var(--pt-blue) !important;
}

#projectTeamManager .pt-members {
    padding: 3px 18px 6px;
}

#projectTeamManager .pt-member {
    gap: 11px;
    padding: 13px 0;
    border-bottom-color: #f0f3f8;
}

#projectTeamManager .pt-avatar {
    width: 42px;
    height: 42px;
    flex-basis: 42px;
    border-color: #e1e7f0;
    background: #f3f6fb;
    color: #718099;
    font-size: 13px;
}

#projectTeamManager .pt-member-name {
    color: #3b4961;
    font-size: 15px;
    font-weight: 800;
}

#projectTeamManager .pt-member-role {
    margin-top: 4px;
    font-size: 13px;
    font-weight: 750;
}

#projectTeamManager .pt-member-role.leader {
    color: #c08b00;
}

#projectTeamManager .pt-member-role.backup {
    color: #5d78c9;
}

#projectTeamManager .pt-member-role.member {
    color: #8b97aa;
}

#projectTeamManager .pt-team-footer {
    min-height: 49px;
    padding: 8px 18px;
    border-top-color: var(--pt-border-soft);
    border-radius: 0 0 15px 15px;
    background: #fbfcff;
}

#projectTeamManager .pt-ready {
    font-size: 14px;
}

#projectTeamManager .pt-view {
    font-size: 13px;
}

#projectTeamManager .pt-unassigned {
    margin-top: 16px;
}

#projectTeamManager .pt-unassigned-header {
    padding: 18px 23px;
    border-bottom-color: var(--pt-border);
}

#projectTeamManager .pt-unassigned-icon {
    width: 38px;
    height: 38px;
    border-radius: 11px;
    background: #f3f6fb;
    color: #718099;
    font-size: 20px;
}

#projectTeamManager .pt-unassigned-title h2 {
    color: var(--pt-heading);
    font-size: 19px;
}

#projectTeamManager .pt-unassigned-title p {
    margin-top: 4px;
    color: #8b97aa;
    font-size: 13px;
}

#projectTeamManager .pt-unassigned-count {
    width: 30px;
    height: 30px;
    background: var(--pt-yellow-soft);
    color: #b78300;
    border: 1px solid var(--pt-yellow-border);
    font-size: 13px;
}

#projectTeamManager .pt-unassigned-list {
    gap: 0 26px;
    padding: 4px 22px 8px;
}

#projectTeamManager .pt-unassigned-row {
    gap: 11px;
    padding: 12px 0;
    border-bottom-color: #f0f3f8;
}

#projectTeamManager .pt-assign {
    min-height: 31px !important;
    padding: 0 10px !important;
    border-radius: 8px !important;
    border-color: #cddcff !important;
    background: var(--pt-blue-soft) !important;
    color: var(--pt-blue) !important;
    font-size: 12px !important;
}

#projectTeamManager .pt-modal-dialog {
    border-radius: 20px;
    border-color: var(--pt-border);
}

#projectTeamManager .pt-modal-icon {
    border-radius: 13px;
    background: var(--pt-blue-soft);
    color: var(--pt-blue);
}

#projectTeamManager .pt-modal-title {
    color: var(--pt-heading);
    font-size: 29px;
    font-weight: 850;
}

#projectTeamManager .pt-modal-description {
    color: #8996aa;
    font-size: 16px;
}

#projectTeamManager .pt-field-card {
    border-radius: 13px;
    border-color: var(--pt-border);
    background: #fbfcff;
}

#projectTeamManager .pt-field-icon {
    border-radius: 10px;
    background: var(--pt-blue-soft);
    color: var(--pt-blue);
}

#projectTeamManager .pt-field-title {
    color: var(--pt-heading);
    font-size: 16px;
}

#projectTeamManager .pt-input,
#projectTeamManager .pt-select {
    min-height: 52px !important;
    border-radius: 10px !important;
    border-color: #d6dfec !important;
    font-size: 16px !important;
}

#projectTeamManager .pt-input:focus,
#projectTeamManager .pt-select:focus {
    border-color: #8eabff !important;
    box-shadow: 0 0 0 4px rgba(47, 99, 232, .09) !important;
}

#projectTeamManager .pt-modal-footer {
    background: #fbfcff;
    border-top-color: var(--pt-border);
}

#projectTeamManager .pt-modal-button {
    min-height: 48px !important;
    border-radius: 10px !important;
    font-size: 15px !important;
}

#projectTeamManager .pt-modal-button.primary {
    background: var(--pt-blue) !important;
    border-color: var(--pt-blue) !important;
}

#projectTeamManager .pt-modal-button.primary:hover {
    background: var(--pt-blue-hover) !important;
    border-color: var(--pt-blue-hover) !important;
}

.dark-mode #projectTeamManager {
    --pt-page: #111827;
    --pt-white: #1b2434;
    --pt-soft: #202b3e;
    --pt-border: #334158;
    --pt-border-soft: #2b374b;
    --pt-heading: #f2f5fb;
    --pt-text: #c5cfdf;
    --pt-muted: #91a0b7;
    --pt-blue: #82a5ff;
    --pt-blue-hover: #9bb8ff;
    --pt-blue-soft: rgba(130, 165, 255, .13);
    --pt-yellow: #fbbf24;
    --pt-yellow-soft: rgba(251, 191, 36, .14);
    --pt-yellow-border: rgba(251, 191, 36, .42);
    --pt-green-soft: rgba(21, 150, 106, .14);
    --pt-red-soft: rgba(220, 70, 84, .14);
}

.dark-mode #projectTeamManager .pt-project-icon,
.dark-mode #projectTeamManager .pt-summary-icon.yellow {
    background: rgba(251, 191, 36, .16);
    border-color: rgba(251, 191, 36, .42);
    color: #fcd34d;
}

.dark-mode #projectTeamManager .pt-team-grid {
    background: #151e2d;
}

.dark-mode #projectTeamManager .pt-team-number,
.dark-mode #projectTeamManager .pt-project-badge,
.dark-mode #projectTeamManager .pt-unassigned-count {
    background: rgba(251, 191, 36, .14);
    border-color: rgba(251, 191, 36, .42);
    color: #fcd34d;
}

.dark-mode #projectTeamManager .pt-team-name,
.dark-mode #projectTeamManager .pt-project-title,
.dark-mode #projectTeamManager .pt-panel-heading h2,
.dark-mode #projectTeamManager .pt-unassigned-title h2,
.dark-mode #projectTeamManager .pt-summary-value,
.dark-mode #projectTeamManager .pt-field-title,
.dark-mode #projectTeamManager .pt-modal-title {
    color: var(--pt-heading);
}

.dark-mode #projectTeamManager .pt-team-card,
.dark-mode #projectTeamManager .pt-project-card,
.dark-mode #projectTeamManager .pt-summary-card,
.dark-mode #projectTeamManager .pt-panel,
.dark-mode #projectTeamManager .pt-unassigned,
.dark-mode #projectTeamManager .pt-field-card,
.dark-mode #projectTeamManager .pt-course,
.dark-mode #projectTeamManager .pt-menu,
.dark-mode #projectTeamManager .pt-member-menu,
.dark-mode #projectTeamManager .pt-modal-dialog {
    background: var(--pt-white);
    border-color: var(--pt-border);
}

.dark-mode #projectTeamManager .pt-team-footer,
.dark-mode #projectTeamManager .pt-modal-footer {
    background: #202b3e;
    border-color: var(--pt-border);
}

.dark-mode #projectTeamManager .pt-input,
.dark-mode #projectTeamManager .pt-select {
    background: #202b3e !important;
    color: #f2f5fb !important;
    border-color: #43516a !important;
}

@media (max-width: 900px) {
    #projectTeamManager {
        padding: 22px 18px 42px;
    }

    #projectTeamManager .pt-header {
        align-items: flex-start;
        flex-direction: column;
    }

    #projectTeamManager .pt-header-tools {
        width: 100%;
        flex-wrap: wrap;
    }

    #projectTeamManager .pt-course {
        flex: 1;
    }
}

@media (max-width: 600px) {
    #projectTeamManager {
        padding: 17px 12px 32px;
    }

    #projectTeamManager .pt-title {
        font-size: 30px;
    }

    #projectTeamManager .pt-description {
        font-size: 16px;
    }

    #projectTeamManager .pt-project-card {
        align-items: flex-start;
        gap: 14px;
        padding: 19px 18px 19px 22px;
    }

    #projectTeamManager .pt-project-title {
        font-size: 19px;
        white-space: normal;
    }

    #projectTeamManager .pt-summary {
        grid-template-columns: repeat(2, minmax(0, 1fr));
    }

    #projectTeamManager .pt-summary-card {
        min-height: 92px;
        padding: 14px;
    }

    #projectTeamManager .pt-summary-icon {
        width: 40px;
        height: 40px;
        flex-basis: 40px;
        font-size: 21px;
    }

    #projectTeamManager .pt-summary-value {
        font-size: 27px;
    }

    #projectTeamManager .pt-panel-header,
    #projectTeamManager .pt-unassigned-header {
        padding: 16px;
    }

    #projectTeamManager .pt-team-grid {
        padding: 12px;
    }

    #projectTeamManager .pt-modal-header {
        padding: 23px 20px 18px;
    }

    #projectTeamManager .pt-modal-body {
        padding: 8px 20px 22px;
    }

    #projectTeamManager .pt-modal-footer {
        padding: 16px 20px 20px;
    }
}

@media (max-width: 420px) {
    #projectTeamManager .pt-summary {
        grid-template-columns: 1fr;
    }

    #projectTeamManager .pt-header-tools {
        flex-direction: column;
        align-items: stretch;
    }

    #projectTeamManager .pt-course,
    #projectTeamManager .pt-primary-action {
        width: 100%;
        justify-content: center;
    }
}


/* ============================================================
   FINAL DROPDOWN OVERLAY FIX
   Use a portal-to-body when a 3-dot menu opens. This completely
   removes the menu from grid/card overflow and stacking contexts.
   ============================================================ */

#projectTeamManager .pt-panel,
#projectTeamManager .pt-team-grid {
    overflow: visible !important;
}

/* Open owner above nearby content while the menu is being opened. */
#projectTeamManager .pt-team-card.menu-open {
    position: relative !important;
    z-index: 5000 !important;
    transform: none !important;
}

#projectTeamManager .pt-member {
    position: relative;
}

#projectTeamManager .pt-member.menu-open {
    z-index: 6000 !important;
}

#projectTeamManager .pt-menu-button.open,
#projectTeamManager .pt-member-menu-button.open {
    position: relative;
    z-index: 12000 !important;
}

/* ------------------------------------------------------------
   PORTALED MENUS
   These menus are moved directly under <body> when opened.
   ------------------------------------------------------------ */

body > .pt-menu.pt-menu-portal,
body > .pt-member-menu.pt-member-menu-portal {
    position: fixed !important;
    display: block !important;
    z-index: 2147483000 !important;

    top: 0;
    left: 0;

    margin: 0 !important;
    padding: 5px !important;

    box-sizing: border-box !important;

    overflow-x: hidden !important;
    overflow-y: auto !important;

    visibility: visible !important;
    opacity: 1 !important;
}

/* Team menu dimensions */
body > .pt-menu.pt-menu-portal {
    width: 205px !important;
    max-height: min(320px, calc(100vh - 24px)) !important;

    border: 1px solid #e2e8f2;
    border-radius: 10px;
    background: #ffffff;

    box-shadow:
        0 18px 42px rgba(20, 30, 48, .18);
}

/* Member menu dimensions */
body > .pt-member-menu.pt-member-menu-portal {
    width: 195px !important;
    max-height: min(320px, calc(100vh - 24px)) !important;

    border: 1px solid #e2e8f2;
    border-radius: 10px;
    background: #ffffff;

    box-shadow:
        0 18px 42px rgba(20, 30, 48, .18);
}

/* Menu item styles when outside #projectTeamManager */
body > .pt-menu.pt-menu-portal .pt-menu-item,
body > .pt-menu.pt-menu-portal button,
body > .pt-menu.pt-menu-portal a,
body > .pt-member-menu.pt-member-menu-portal button {
    width: 100% !important;
    min-height: 37px !important;

    display: flex !important;
    align-items: center !important;
    gap: 8px !important;

    margin: 0 !important;
    padding: 0 9px !important;

    border: 0 !important;
    border-radius: 7px !important;

    background: transparent !important;
    color: #596474 !important;

    font-family: inherit !important;
    font-size: 13px !important;
    font-weight: 700 !important;

    text-align: left !important;
    text-decoration: none !important;

    cursor: pointer !important;
}

body > .pt-menu.pt-menu-portal .pt-menu-item:hover,
body > .pt-menu.pt-menu-portal button:hover,
body > .pt-menu.pt-menu-portal a:hover,
body > .pt-member-menu.pt-member-menu-portal button:hover {
    background: #f4f7fb !important;
    color: #2f63e8 !important;
}

body > .pt-menu.pt-menu-portal .danger:hover,
body > .pt-member-menu.pt-member-menu-portal button.danger:hover {
    background: #fff0f2 !important;
    color: #dc4654 !important;
}

body > .pt-menu.pt-menu-portal i,
body > .pt-member-menu.pt-member-menu-portal i {
    width: 17px !important;
    flex: 0 0 17px !important;
    text-align: center !important;
    font-size: 17px !important;
}

/* Dark mode portal menus */
body.dark-mode > .pt-menu.pt-menu-portal,
body.dark-mode > .pt-member-menu.pt-member-menu-portal {
    border-color: #334158;
    background: #1b2434;

    box-shadow:
        0 20px 45px rgba(0, 0, 0, .42);
}

body.dark-mode > .pt-menu.pt-menu-portal .pt-menu-item,
body.dark-mode > .pt-menu.pt-menu-portal button,
body.dark-mode > .pt-menu.pt-menu-portal a,
body.dark-mode > .pt-member-menu.pt-member-menu-portal button {
    color: #c5cfdf !important;
}

body.dark-mode > .pt-menu.pt-menu-portal .pt-menu-item:hover,
body.dark-mode > .pt-menu.pt-menu-portal button:hover,
body.dark-mode > .pt-menu.pt-menu-portal a:hover,
body.dark-mode > .pt-member-menu.pt-member-menu-portal button:hover {
    background: #253149 !important;
    color: #9bb8ff !important;
}

body.dark-mode > .pt-menu.pt-menu-portal .danger:hover,
body.dark-mode > .pt-member-menu.pt-member-menu-portal button.danger:hover {
    background: rgba(220, 70, 84, .16) !important;
    color: #ff8b96 !important;
}

</style>


<div id="projectTeamManager">

    <div class="pt-page">

        {{-- ========================================================
             HEADER
        ========================================================= --}}
        <header class="pt-header">

            <div class="pt-header-left">

                <a
                    href="{{ $projectUrl }}"
                    class="pt-back"
                >
                    <i class="bx bx-arrow-back"></i>
                    Back to Project
                </a>

                <h1 class="pt-title">
                    Manage Student Teams
                </h1>

                <p class="pt-description">
                    Organize students into teams and manage
                    members, roles, and responsibilities.
                </p>

            </div>


            <div class="pt-header-tools">



                <button
                    type="button"
                    class="pt-primary-action"
                    id="openCreateTeam"
                >
                    <i class="bx bx-plus"></i>
                    Create Team
                </button>

            </div>

        </header>


        {{-- ========================================================
             PROJECT
        ========================================================= --}}
        <section class="pt-project-card">

            <div class="pt-project-main">

                <div class="pt-project-icon">
                    <i class="bx bx-briefcase-alt-2"></i>
                </div>

                <div class="pt-project-copy">

                    <span class="pt-project-label">
                        Project
                    </span>

                    <span
                        class="pt-project-title"
                        title="{{ $project->title }}"
                    >
                        {{ $project->title }}
                    </span>

                </div>

            </div>


            <span class="pt-project-badge">
                <i class="bx bx-group"></i>
                Team Project
            </span>

        </section>





        {{-- ========================================================
             TEAMS
        ========================================================= --}}
        <section class="pt-panel">

            <div class="pt-panel-header">

                <div class="pt-panel-heading">

                    <div class="pt-panel-icon">
                        <i class="bx bx-network-chart"></i>
                    </div>

                    <div>
                        <h2>
                            Project Teams
                        </h2>

                        <p>
                            Manage team members and assignments.
                        </p>
                    </div>

                </div>


                <span class="pt-panel-count">
                    {{ $totalTeams }}
                    {{ $totalTeams === 1 ? 'Team' : 'Teams' }}
                </span>

            </div>


            @if($groups->isNotEmpty())

                <div class="pt-team-grid">

                    @foreach($groups as $group)

                        @php
                            $members = $group->members->sortBy(function ($member) {
                                return match ($member->role) {
                                    'leader' => 1,
                                    'backup' => 2,
                                    default => 3,
                                };
                            });
                        @endphp


                        <article class="pt-team-card">

                            {{-- TEAM HEADER --}}
                            <div class="pt-team-header">

                                <div class="pt-team-heading">

                                    <div class="pt-team-number">
                                        {{ $group->group_number }}
                                    </div>

                                    <div class="pt-team-copy">

                                        <span
                                            class="pt-team-name"
                                            title="{{ $group->group_name }}"
                                        >
                                            {{ $group->group_name }}
                                        </span>

                                        <span class="pt-team-count">
                                            {{ $members->count() }}
                                            {{ $members->count() === 1 ? 'student' : 'students' }}
                                        </span>

                                    </div>

                                </div>


                                {{-- TEAM ACTIONS --}}
                                <div class="pt-menu-wrap">

                                    <button
                                        type="button"
                                        class="pt-menu-button"
                                        data-team-menu-button
                                        aria-label="Team actions"
                                    >
                                        <i class="bx bx-dots-vertical-rounded"></i>
                                    </button>


                                    <div class="pt-menu">

                                        <button
                                            type="button"
                                            class="pt-menu-item"
                                            data-action="add-student"
                                            data-url="{{ route(
                                                'professor.classworks.projects.groups.members.add',
                                                [
                                                    'classGroupId' => $classGroup->id,
                                                    'projectId' => $project->id,
                                                    'groupId' => $group->id,
                                                ]
                                            ) }}"
                                            data-team-name="{{ $group->group_name }}"
                                        >
                                            <i class="bx bx-user-plus"></i>
                                            Add Student
                                        </button>


                                        <button
                                            type="button"
                                            class="pt-menu-item"
                                            data-action="rename-team"
                                            data-url="{{ route(
                                                'professor.classworks.projects.groups.rename',
                                                [
                                                    'classGroupId' => $classGroup->id,
                                                    'projectId' => $project->id,
                                                    'groupId' => $group->id,
                                                ]
                                            ) }}"
                                            data-team-name="{{ $group->group_name }}"
                                        >
                                            <i class="bx bx-edit-alt"></i>
                                            Rename Team
                                        </button>





                                        @if($members->isEmpty())

                                            <button
                                                type="button"
                                                class="pt-menu-item danger"
                                                data-action="delete-team"
                                                data-url="{{ route(
                                                    'professor.classworks.projects.groups.delete',
                                                    [
                                                        'classGroupId' => $classGroup->id,
                                                        'projectId' => $project->id,
                                                        'groupId' => $group->id,
                                                    ]
                                                ) }}"
                                                data-team-name="{{ $group->group_name }}"
                                            >
                                                <i class="bx bx-trash"></i>
                                                Delete Team
                                            </button>

                                        @endif

                                    </div>

                                </div>

                            </div>


                            {{-- TEAM MEMBERS --}}
                            <div class="pt-members">

                                @forelse($members as $member)

                                    @php
                                        $student = $member->user;

                                        $initial = $student
                                            ? strtoupper(substr($student->name, 0, 1))
                                            : '?';

                                        $roleLabel = match ($member->role) {
                                            'leader' => 'Team Leader',
                                            'backup' => 'Backup Submitter',
                                            default => 'Team Member',
                                        };
                                    @endphp


                                    <div class="pt-member">

                                        <div class="pt-avatar">

                                            @if($student?->profile_image)

                                                <img
                                                    src="{{ asset(
                                                        'storage/' .
                                                        $student->profile_image
                                                    ) }}"
                                                    alt="{{ $student->name }}"
                                                >

                                            @else

                                                {{ $initial }}

                                            @endif

                                        </div>


                                        <div class="pt-member-info">

                                            <span
                                                class="pt-member-name"
                                                title="{{ $student?->name ?? 'Unknown Student' }}"
                                            >
                                                {{ $student?->name ?? 'Unknown Student' }}
                                            </span>


                                            @if($member->role === 'leader')

                                                <span class="pt-member-role leader">
                                                    <i class="bx bxs-crown"></i>
                                                    {{ $roleLabel }}
                                                </span>

                                            @elseif($member->role === 'backup')

                                                <span class="pt-member-role backup">
                                                    <i class="bx bx-shield-quarter"></i>
                                                    {{ $roleLabel }}
                                                </span>

                                            @else

                                                <span class="pt-member-role member">
                                                    <i class="bx bx-user"></i>
                                                    {{ $roleLabel }}
                                                </span>

                                            @endif

                                        </div>


                                        {{-- MEMBER ACTIONS --}}
                                        <div class="pt-member-action-wrap">

                                            <button
                                                type="button"
                                                class="pt-member-menu-button"
                                                data-member-menu-button
                                                aria-label="Student actions"
                                            >
                                                <i class="bx bx-dots-vertical-rounded"></i>
                                            </button>


                                            <div class="pt-member-menu">

                                                <button
                                                    type="button"
                                                    data-action="change-role"
                                                    data-url="{{ route(
                                                        'professor.classworks.projects.groups.members.role',
                                                        [
                                                            'classGroupId' => $classGroup->id,
                                                            'projectId' => $project->id,
                                                            'groupId' => $group->id,
                                                            'memberId' => $member->id,
                                                        ]
                                                    ) }}"
                                                    data-role="{{ $member->role }}"
                                                    data-student-name="{{ $student?->name ?? 'Student' }}"
                                                >
                                                    <i class="bx bx-user-check"></i>
                                                    Change Role
                                                </button>


                                                <button
                                                    type="button"
                                                    data-action="move-student"
                                                    data-url="{{ route(
                                                        'professor.classworks.projects.groups.members.move',
                                                        [
                                                            'classGroupId' => $classGroup->id,
                                                            'projectId' => $project->id,
                                                            'groupId' => $group->id,
                                                            'memberId' => $member->id,
                                                        ]
                                                    ) }}"
                                                    data-student-name="{{ $student?->name ?? 'Student' }}"
                                                    data-current-group="{{ $group->id }}"
                                                >
                                                    <i class="bx bx-transfer"></i>
                                                    Move to Another Team
                                                </button>


                                                <button
                                                    type="button"
                                                    class="danger"
                                                    data-action="remove-student"
                                                    data-url="{{ route(
                                                        'professor.classworks.projects.groups.members.remove',
                                                        [
                                                            'classGroupId' => $classGroup->id,
                                                            'projectId' => $project->id,
                                                            'groupId' => $group->id,
                                                            'memberId' => $member->id,
                                                        ]
                                                    ) }}"
                                                    data-student-name="{{ $student?->name ?? 'Student' }}"
                                                >
                                                    <i class="bx bx-user-minus"></i>
                                                    Remove from Team
                                                </button>

                                            </div>

                                        </div>

                                    </div>


                                @empty

                                    <div class="pt-empty">

                                        <div class="pt-empty-icon">
                                            <i class="bx bx-user-x"></i>
                                        </div>

                                        <h3>
                                            No students assigned
                                        </h3>

                                        <p>
                                            Add an enrolled student to this team.
                                        </p>

                                        <button
                                            type="button"
                                            class="pt-empty-action"
                                            data-action="add-student"
                                            data-url="{{ route(
                                                'professor.classworks.projects.groups.members.add',
                                                [
                                                    'classGroupId' => $classGroup->id,
                                                    'projectId' => $project->id,
                                                    'groupId' => $group->id,
                                                ]
                                            ) }}"
                                            data-team-name="{{ $group->group_name }}"
                                        >
                                            <i class="bx bx-user-plus"></i>
                                            Add Student
                                        </button>

                                    </div>

                                @endforelse

                            </div>


                            {{-- FOOTER --}}
                            <div class="pt-team-footer">

                                <span class="pt-ready">
                                    <i class="bx bx-check-circle"></i>
                                    Team ready
                                </span>



                            </div>

                        </article>

                    @endforeach

                </div>

            @else

                <div class="pt-empty">

                    <div class="pt-empty-icon">
                        <i class="bx bx-group"></i>
                    </div>

                    <h3>
                        No teams created yet
                    </h3>

                    <p>
                        Create a team first, then start assigning students.
                    </p>

                    <button
                        type="button"
                        class="pt-empty-action"
                        id="openCreateTeamEmpty"
                    >
                        <i class="bx bx-plus"></i>
                        Create Team
                    </button>

                </div>

            @endif

        </section>


        {{-- ========================================================
             UNASSIGNED STUDENTS
        ========================================================= --}}
        @if(isset($unassignedStudents) && $unassignedStudents->isNotEmpty())

            <section class="pt-unassigned">

                <div class="pt-unassigned-header">

                    <div class="pt-unassigned-title">

                        <div class="pt-unassigned-icon">
                            <i class="bx bx-user-plus"></i>
                        </div>

                        <div>
                            <h2>
                                Unassigned Students
                            </h2>

                            <p>
                                Students enrolled in this class without a team.
                            </p>
                        </div>

                    </div>


                    <span class="pt-unassigned-count">
                        {{ $unassignedStudents->count() }}
                    </span>

                </div>


                <div class="pt-unassigned-list">

                    @foreach($unassignedStudents as $student)

                        @php
                            $initial = strtoupper(
                                substr($student->name, 0, 1)
                            );
                        @endphp


                        <div class="pt-unassigned-row">

                            <div class="pt-avatar">

                                @if($student->profile_image)

                                    <img
                                        src="{{ asset(
                                            'storage/' .
                                            $student->profile_image
                                        ) }}"
                                        alt="{{ $student->name }}"
                                    >

                                @else

                                    {{ $initial }}

                                @endif

                            </div>


                            <div class="pt-member-info">

                                <span class="pt-member-name">
                                    {{ $student->name }}
                                </span>

                                <span class="pt-member-role member">
                                    <i class="bx bx-user"></i>
                                    Not assigned
                                </span>

                            </div>


                        </div>

                    @endforeach

                </div>

            </section>

        @endif

    </div>




{{-- ================================================================
     CREATE TEAM MODAL
================================================================ --}}
<div class="pt-modal" id="createTeamModal" aria-hidden="true">

    <div class="pt-modal-dialog">

        <div class="pt-modal-header">

            <div class="pt-modal-heading">

                <div class="pt-modal-icon">
                    <i class="bx bx-group"></i>
                </div>

                <div>
                    <h3 class="pt-modal-title">
                        Create Team
                    </h3>

                    <p class="pt-modal-description">
                        Create a new team for this project.
                    </p>
                </div>

            </div>


            <button
                type="button"
                class="pt-close"
                data-close-modal
                aria-label="Close"
            >
                <i class="bx bx-x"></i>
            </button>

        </div>


        <form
            method="POST"
            action="{{ route(
                'professor.classworks.projects.groups.create',
                [
                    'classGroupId' => $classGroup->id,
                    'projectId' => $project->id,
                ]
            ) }}"
        >

            @csrf

            <div class="pt-modal-body">

                <div class="pt-field-card">

                    <div class="pt-field-heading">

                        <div class="pt-field-icon">
                            <i class="bx bx-group"></i>
                        </div>

                        <div>
                            <h4 class="pt-field-title">
                                Team Name
                            </h4>

                            <p class="pt-field-description">
                                Give the new team a clear name.
                            </p>
                        </div>

                    </div>


                    <input
                        type="text"
                        name="group_name"
                        class="pt-input"
                        placeholder="e.g. Team Alpha"
                        maxlength="255"
                        required
                    >

                </div>

            </div>


            <div class="pt-modal-footer">

                <button
                    type="button"
                    class="pt-modal-button"
                    data-close-modal
                >
                    Cancel
                </button>


                <button
                    type="submit"
                    class="pt-modal-button primary"
                >
                    <i class="bx bx-plus"></i>
                    Create Team
                </button>

            </div>

        </form>

    </div>

</div>


{{-- ================================================================
     ADD STUDENT MODAL
================================================================ --}}
<div class="pt-modal" id="addStudentModal" aria-hidden="true">

    <div class="pt-modal-dialog">

        <div class="pt-modal-header">

            <div class="pt-modal-heading">

                <div class="pt-modal-icon">
                    <i class="bx bx-user-plus"></i>
                </div>

                <div>
                    <h3 class="pt-modal-title">
                        Add Student
                    </h3>

                    <p
                        class="pt-modal-description"
                        id="addStudentDescription"
                    >
                        Add an enrolled student to this project team.
                    </p>
                </div>

            </div>


            <button
                type="button"
                class="pt-close"
                data-close-modal
            >
                <i class="bx bx-x"></i>
            </button>

        </div>


        <form method="POST" id="addStudentForm">

            @csrf

            <div class="pt-modal-body">

                <div class="pt-stepbar">

                    <div class="pt-step active">
                        <span class="pt-step-number">1</span>
                        Student
                    </div>

                    <div class="pt-step-divider"></div>

                    <div class="pt-step active">
                        <span class="pt-step-number">2</span>
                        Role
                    </div>

                    <div class="pt-step-divider"></div>

                    <div class="pt-step active">
                        <span class="pt-step-number">3</span>
                        Add
                    </div>

                </div>


                <div class="pt-context">

                    <div class="pt-context-icon">
                        <i class="bx bx-group"></i>
                    </div>

                    <div style="min-width:0;">

                        <span class="pt-context-label">
                            Team
                        </span>

                        <span
                            class="pt-context-value"
                            id="addStudentTeamName"
                        >
                            Select a team
                        </span>

                    </div>

                </div>


                <div class="pt-field-card">

                    <div class="pt-field-heading">

                        <div class="pt-field-icon">
                            <i class="bx bx-user"></i>
                        </div>

                        <div>
                            <h4 class="pt-field-title">
                                Student
                            </h4>

                            <p class="pt-field-description">
                                Select an enrolled student.
                            </p>
                        </div>

                    </div>


                    <select
                        name="user_id"
                        id="addStudentId"
                        class="pt-select"
                        required
                    >
                        <option value="">
                            Select a student
                        </option>

                        @if(isset($unassignedStudents))

                            @foreach($unassignedStudents as $student)

                                <option value="{{ $student->id }}">
                                    {{ $student->name }}
                                </option>

                            @endforeach

                        @endif

                    </select>

                </div>


                <div class="pt-field-card">

                    <div class="pt-field-heading">

                        <div class="pt-field-icon">
                            <i class="bx bx-user-check"></i>
                        </div>

                        <div>
                            <h4 class="pt-field-title">
                                Team Role
                            </h4>

                            <p class="pt-field-description">
                                Choose the student's responsibility.
                            </p>
                        </div>

                    </div>


                    <select
                        name="role"
                        id="addStudentRole"
                        class="pt-select"
                        required
                    >
                        <option value="member">
                            Team Member
                        </option>

                        <option value="leader">
                            Team Leader
                        </option>

                        <option value="backup">
                            Backup Submitter
                        </option>

                    </select>


                    <p class="pt-help">
                        A team can have one leader and one backup submitter.
                    </p>

                </div>

            </div>


            <div class="pt-modal-footer">

                <button
                    type="button"
                    class="pt-modal-button"
                    data-close-modal
                >
                    Cancel
                </button>


                <button
                    type="submit"
                    class="pt-modal-button primary"
                >
                    <i class="bx bx-user-plus"></i>
                    Add Student
                </button>

            </div>

        </form>

    </div>

</div>


{{-- ================================================================
     RENAME TEAM MODAL
================================================================ --}}
<div class="pt-modal" id="renameTeamModal" aria-hidden="true">

    <div class="pt-modal-dialog">

        <div class="pt-modal-header">

            <div class="pt-modal-heading">

                <div class="pt-modal-icon">
                    <i class="bx bx-edit-alt"></i>
                </div>

                <div>
                    <h3 class="pt-modal-title">
                        Rename Team
                    </h3>

                    <p class="pt-modal-description">
                        Update the name of this team.
                    </p>
                </div>

            </div>


            <button
                type="button"
                class="pt-close"
                data-close-modal
            >
                <i class="bx bx-x"></i>
            </button>

        </div>


        <form method="POST" id="renameTeamForm">

            @csrf
            @method('PUT')

            <div class="pt-modal-body">

                <div class="pt-field-card">

                    <div class="pt-field-heading">

                        <div class="pt-field-icon">
                            <i class="bx bx-group"></i>
                        </div>

                        <div>
                            <h4 class="pt-field-title">
                                Team Name
                            </h4>

                            <p class="pt-field-description">
                                Enter the new team name.
                            </p>
                        </div>

                    </div>


                    <input
                        type="text"
                        name="group_name"
                        id="renameTeamName"
                        class="pt-input"
                        maxlength="255"
                        required
                    >

                </div>

            </div>


            <div class="pt-modal-footer">

                <button
                    type="button"
                    class="pt-modal-button"
                    data-close-modal
                >
                    Cancel
                </button>


                <button
                    type="submit"
                    class="pt-modal-button primary"
                >
                    <i class="bx bx-save"></i>
                    Save Changes
                </button>

            </div>

        </form>

    </div>

</div>


{{-- ================================================================
     CHANGE ROLE MODAL
================================================================ --}}
<div class="pt-modal" id="changeRoleModal" aria-hidden="true">

    <div class="pt-modal-dialog">

        <div class="pt-modal-header">

            <div class="pt-modal-heading">

                <div class="pt-modal-icon">
                    <i class="bx bx-user-check"></i>
                </div>

                <div>
                    <h3 class="pt-modal-title">
                        Change Student Role
                    </h3>

                    <p
                        class="pt-modal-description"
                        id="changeRoleDescription"
                    >
                        Choose a new role for this student.
                    </p>
                </div>

            </div>


            <button
                type="button"
                class="pt-close"
                data-close-modal
            >
                <i class="bx bx-x"></i>
            </button>

        </div>


        <form method="POST" id="changeRoleForm">

            @csrf
            @method('PUT')

            <div class="pt-modal-body">

                <div class="pt-field-card">

                    <div class="pt-field-heading">

                        <div class="pt-field-icon">
                            <i class="bx bx-shield"></i>
                        </div>

                        <div>
                            <h4 class="pt-field-title">
                                Team Role
                            </h4>

                            <p class="pt-field-description">
                                Select the new responsibility.
                            </p>
                        </div>

                    </div>


                    <select
                        name="role"
                        id="changeRoleValue"
                        class="pt-select"
                        required
                    >
                        <option value="member">
                            Team Member
                        </option>

                        <option value="leader">
                            Team Leader
                        </option>

                        <option value="backup">
                            Backup Submitter
                        </option>

                    </select>

                </div>

            </div>


            <div class="pt-modal-footer">

                <button
                    type="button"
                    class="pt-modal-button"
                    data-close-modal
                >
                    Cancel
                </button>


                <button
                    type="submit"
                    class="pt-modal-button primary"
                >
                    <i class="bx bx-save"></i>
                    Update Role
                </button>

            </div>

        </form>

    </div>

</div>


{{-- ================================================================
     MOVE STUDENT MODAL
================================================================ --}}
<div class="pt-modal" id="moveStudentModal" aria-hidden="true">

    <div class="pt-modal-dialog">

        <div class="pt-modal-header">

            <div class="pt-modal-heading">

                <div class="pt-modal-icon">
                    <i class="bx bx-transfer"></i>
                </div>

                <div>
                    <h3 class="pt-modal-title">
                        Move Student
                    </h3>

                    <p
                        class="pt-modal-description"
                        id="moveStudentDescription"
                    >
                        Move this student to another team.
                    </p>
                </div>

            </div>


            <button
                type="button"
                class="pt-close"
                data-close-modal
            >
                <i class="bx bx-x"></i>
            </button>

        </div>


        <form method="POST" id="moveStudentForm">

            @csrf
            @method('PUT')

            <div class="pt-modal-body">

                <div class="pt-context">

                    <div class="pt-context-icon">
                        <i class="bx bx-group"></i>
                    </div>

                    <div style="min-width:0;">

                        <span class="pt-context-label">
                            Current Team
                        </span>

                        <span
                            class="pt-context-value"
                            id="moveCurrentTeam"
                        >
                            Current team
                        </span>

                    </div>

                </div>


                <div class="pt-field-card">

                    <div class="pt-field-heading">

                        <div class="pt-field-icon">
                            <i class="bx bx-transfer"></i>
                        </div>

                        <div>
                            <h4 class="pt-field-title">
                                Destination Team
                            </h4>

                            <p class="pt-field-description">
                                Choose the team this student should join.
                            </p>
                        </div>

                    </div>


                    <select
                        name="project_group_id"
                        id="moveDestination"
                        class="pt-select"
                        required
                    >
                        <option value="">
                            Select a team
                        </option>

                        @foreach($groups as $group)

                            <option value="{{ $group->id }}">
                                {{ $group->group_name }}
                            </option>

                        @endforeach

                    </select>

                </div>

            </div>


            <div class="pt-modal-footer">

                <button
                    type="button"
                    class="pt-modal-button"
                    data-close-modal
                >
                    Cancel
                </button>


                <button
                    type="submit"
                    class="pt-modal-button primary"
                >
                    <i class="bx bx-transfer"></i>
                    Move Student
                </button>

            </div>

        </form>

    </div>

</div>


{{-- ================================================================
     REMOVE STUDENT MODAL
================================================================ --}}
<div class="pt-modal" id="removeStudentModal" aria-hidden="true">

    <div class="pt-modal-dialog">

        <div class="pt-modal-header">

            <div class="pt-modal-heading">

                <div
                    class="pt-modal-icon"
                    style="background:#fff1f2 !important;color:#d83e49 !important;"
                >
                    <i class="bx bx-user-minus"></i>
                </div>

                <div>
                    <h3 class="pt-modal-title">
                        Remove Student
                    </h3>

                    <p
                        class="pt-modal-description"
                        id="removeStudentDescription"
                    >
                        Remove this student from the team?
                    </p>
                </div>

            </div>


            <button
                type="button"
                class="pt-close"
                data-close-modal
            >
                <i class="bx bx-x"></i>
            </button>

        </div>


        <form method="POST" id="removeStudentForm">

            @csrf
            @method('DELETE')

            <div class="pt-modal-body">

                <div
                    class="pt-context"
                    style="background:#fffafb !important;border-color:#f0d9dd !important;"
                >

                    <div
                        class="pt-context-icon"
                        style="background:#fff1f2 !important;color:#d83e49 !important;"
                    >
                        <i class="bx bx-user"></i>
                    </div>

                    <div style="min-width:0;">

                        <span class="pt-context-label">
                            Student
                        </span>

                        <span
                            class="pt-context-value"
                            id="removeStudentName"
                        >
                            Student
                        </span>

                    </div>

                </div>


                <p style="
                    margin:0;
                    color:#7e8794;
                    font-size:10px;
                    line-height:1.6;
                ">
                    This student will become unassigned from the project.
                    You can add them to another team later.
                </p>

            </div>


            <div class="pt-modal-footer">

                <button
                    type="button"
                    class="pt-modal-button"
                    data-close-modal
                >
                    Cancel
                </button>


                <button
                    type="submit"
                    class="pt-modal-button danger"
                >
                    <i class="bx bx-user-minus"></i>
                    Remove Student
                </button>

            </div>

        </form>

    </div>

</div>


{{-- ================================================================
     DELETE TEAM MODAL
================================================================ --}}
<div class="pt-modal" id="deleteTeamModal" aria-hidden="true">

    <div class="pt-modal-dialog">

        <div class="pt-modal-header">

            <div class="pt-modal-heading">

                <div
                    class="pt-modal-icon"
                    style="background:#fff1f2 !important;color:#d83e49 !important;"
                >
                    <i class="bx bx-trash"></i>
                </div>

                <div>
                    <h3 class="pt-modal-title">
                        Delete Team
                    </h3>

                    <p
                        class="pt-modal-description"
                        id="deleteTeamDescription"
                    >
                        Delete this team?
                    </p>
                </div>

            </div>


            <button
                type="button"
                class="pt-close"
                data-close-modal
            >
                <i class="bx bx-x"></i>
            </button>

        </div>


        <form method="POST" id="deleteTeamForm">

            @csrf
            @method('DELETE')

            <div class="pt-modal-body">

                <p style="
                    margin:0;
                    color:#7e8794;
                    font-size:10px;
                    line-height:1.6;
                ">
                    Only an empty team can be deleted.
                    This action cannot be undone.
                </p>

            </div>


            <div class="pt-modal-footer">

                <button
                    type="button"
                    class="pt-modal-button"
                    data-close-modal
                >
                    Cancel
                </button>


                <button
                    type="submit"
                    class="pt-modal-button danger"
                >
                    <i class="bx bx-trash"></i>
                    Delete Team
                </button>

            </div>

        </form>

    </div>

</div>


<script>
document.addEventListener('DOMContentLoaded', function () {

    /*
    |--------------------------------------------------------------------------
    | MODALS
    |--------------------------------------------------------------------------
    */

    const modals =
        document.querySelectorAll(
            '#projectTeamManager .pt-modal'
        );


    const createTeamModal =
        document.getElementById('createTeamModal');

    const addStudentModal =
        document.getElementById('addStudentModal');

    const renameTeamModal =
        document.getElementById('renameTeamModal');

    const changeRoleModal =
        document.getElementById('changeRoleModal');

    const moveStudentModal =
        document.getElementById('moveStudentModal');

    const removeStudentModal =
        document.getElementById('removeStudentModal');

    const deleteTeamModal =
        document.getElementById('deleteTeamModal');


    function openModal(modal) {

        if (!modal) {
            return;
        }

        closeAllMenus();

        modals.forEach(function (item) {
            item.classList.remove('show');
            item.setAttribute('aria-hidden', 'true');
        });

        modal.classList.add('show');
        modal.setAttribute('aria-hidden', 'false');

        document.body.style.overflow = 'hidden';
    }


    function closeModal(modal) {

        if (!modal) {
            return;
        }

        modal.classList.remove('show');
        modal.setAttribute('aria-hidden', 'true');

        if (
            !document.querySelector(
                '#projectTeamManager .pt-modal.show'
            )
        ) {
            document.body.style.overflow = '';
        }
    }


    function closeAllModals() {

        modals.forEach(function (modal) {
            modal.classList.remove('show');
            modal.setAttribute('aria-hidden', 'true');
        });

        document.body.style.overflow = '';
    }


    document
        .querySelectorAll(
            '#projectTeamManager [data-close-modal]'
        )
        .forEach(function (button) {

            button.addEventListener(
                'click',
                function () {
                    closeAllModals();
                }
            );

        });


    modals.forEach(function (modal) {

        modal.addEventListener(
            'click',
            function (event) {

                if (event.target === modal) {
                    closeModal(modal);
                }

            }
        );

    });


    /*
    |--------------------------------------------------------------------------
    | CREATE TEAM
    |--------------------------------------------------------------------------
    */

    const createButtons =
        document.querySelectorAll(
            '#openCreateTeam, #openCreateTeamEmpty'
        );


    createButtons.forEach(function (button) {

        button.addEventListener(
            'click',
            function () {
                openModal(createTeamModal);
            }
        );

    });


    /*
    |--------------------------------------------------------------------------
    | ADD STUDENT
    |--------------------------------------------------------------------------
    */

    document
        .querySelectorAll(
            '#projectTeamManager [data-action="add-student"]'
        )
        .forEach(function (button) {

            button.addEventListener(
                'click',
                function () {

                    const url =
                        button.dataset.url || '';

                    const teamName =
                        button.dataset.teamName ||
                        'Selected team';

                    const studentId =
                        button.dataset.studentId ||
                        '';


                    const form =
                        document.getElementById(
                            'addStudentForm'
                        );

                    if (form && url) {
                        form.action = url;
                    }


                    const teamNameElement =
                        document.getElementById(
                            'addStudentTeamName'
                        );

                    if (teamNameElement) {

                        teamNameElement.textContent =
                            teamName;

                    }


                    const description =
                        document.getElementById(
                            'addStudentDescription'
                        );

                    if (description) {

                        description.textContent =
                            'Add an enrolled student to ' +
                            teamName +
                            '.';

                    }


                    const studentSelect =
                        document.getElementById(
                            'addStudentId'
                        );

                    if (studentSelect) {

                        studentSelect.value =
                            studentId;

                    }


                    const roleSelect =
                        document.getElementById(
                            'addStudentRole'
                        );

                    if (roleSelect) {

                        roleSelect.value = 'member';

                    }


                    openModal(addStudentModal);

                }
            );

        });


    /*
    |--------------------------------------------------------------------------
    | RENAME TEAM
    |--------------------------------------------------------------------------
    */

    document
        .querySelectorAll(
            '#projectTeamManager [data-action="rename-team"]'
        )
        .forEach(function (button) {

            button.addEventListener(
                'click',
                function () {

                    const form =
                        document.getElementById(
                            'renameTeamForm'
                        );

                    if (
                        form &&
                        button.dataset.url
                    ) {
                        form.action =
                            button.dataset.url;
                    }


                    const input =
                        document.getElementById(
                            'renameTeamName'
                        );

                    if (input) {

                        input.value =
                            button.dataset.teamName ||
                            '';

                    }


                    openModal(renameTeamModal);


                    if (input) {

                        setTimeout(
                            function () {
                                input.focus();
                                input.select();
                            },
                            40
                        );

                    }

                }
            );

        });


    /*
    |--------------------------------------------------------------------------
    | CHANGE ROLE
    |--------------------------------------------------------------------------
    */

    document
        .querySelectorAll(
            '#projectTeamManager [data-action="change-role"]'
        )
        .forEach(function (button) {

            button.addEventListener(
                'click',
                function () {

                    const form =
                        document.getElementById(
                            'changeRoleForm'
                        );

                    if (
                        form &&
                        button.dataset.url
                    ) {
                        form.action =
                            button.dataset.url;
                    }


                    const roleSelect =
                        document.getElementById(
                            'changeRoleValue'
                        );

                    if (roleSelect) {

                        roleSelect.value =
                            button.dataset.role ||
                            'member';

                    }


                    const description =
                        document.getElementById(
                            'changeRoleDescription'
                        );

                    if (description) {

                        description.textContent =
                            'Choose a new role for ' +
                            (
                                button.dataset.studentName ||
                                'this student'
                            ) +
                            '.';

                    }


                    openModal(changeRoleModal);

                }
            );

        });


    /*
    |--------------------------------------------------------------------------
    | MOVE STUDENT
    |--------------------------------------------------------------------------
    */

    document
        .querySelectorAll(
            '#projectTeamManager [data-action="move-student"]'
        )
        .forEach(function (button) {

            button.addEventListener(
                'click',
                function () {

                    const form =
                        document.getElementById(
                            'moveStudentForm'
                        );

                    if (
                        form &&
                        button.dataset.url
                    ) {
                        form.action =
                            button.dataset.url;
                    }


                    const studentName =
                        button.dataset.studentName ||
                        'this student';

                    const currentGroupId =
                        button.dataset.currentGroup ||
                        '';


                    const description =
                        document.getElementById(
                            'moveStudentDescription'
                        );

                    if (description) {

                        description.textContent =
                            'Move ' +
                            studentName +
                            ' to another team.';

                    }


                    const currentTeam =
                        document.getElementById(
                            'moveCurrentTeam'
                        );

                    const destination =
                        document.getElementById(
                            'moveDestination'
                        );


                    if (destination) {

                        destination.value = '';

                        Array
                            .from(destination.options)
                            .forEach(function (option) {

                                option.disabled = false;

                                if (
                                    option.value &&
                                    String(option.value) ===
                                    String(currentGroupId)
                                ) {
                                    option.disabled = true;
                                }

                            });

                    }


                    if (currentTeam && destination) {

                        const currentOption =
                            Array
                                .from(destination.options)
                                .find(function (option) {

                                    return (
                                        String(option.value) ===
                                        String(currentGroupId)
                                    );

                                });


                        currentTeam.textContent =
                            currentOption
                                ? currentOption.textContent.trim()
                                : 'Current team';

                    }


                    openModal(moveStudentModal);

                }
            );

        });


    /*
    |--------------------------------------------------------------------------
    | REMOVE STUDENT
    |--------------------------------------------------------------------------
    */

    document
        .querySelectorAll(
            '#projectTeamManager [data-action="remove-student"]'
        )
        .forEach(function (button) {

            button.addEventListener(
                'click',
                function () {

                    const form =
                        document.getElementById(
                            'removeStudentForm'
                        );

                    if (
                        form &&
                        button.dataset.url
                    ) {
                        form.action =
                            button.dataset.url;
                    }


                    const studentName =
                        button.dataset.studentName ||
                        'Student';


                    const nameElement =
                        document.getElementById(
                            'removeStudentName'
                        );

                    if (nameElement) {

                        nameElement.textContent =
                            studentName;

                    }


                    const description =
                        document.getElementById(
                            'removeStudentDescription'
                        );

                    if (description) {

                        description.textContent =
                            'Remove ' +
                            studentName +
                            ' from the team?';

                    }


                    openModal(removeStudentModal);

                }
            );

        });


    /*
    |--------------------------------------------------------------------------
    | DELETE TEAM
    |--------------------------------------------------------------------------
    */

    document
        .querySelectorAll(
            '#projectTeamManager [data-action="delete-team"]'
        )
        .forEach(function (button) {

            button.addEventListener(
                'click',
                function () {

                    const form =
                        document.getElementById(
                            'deleteTeamForm'
                        );

                    if (
                        form &&
                        button.dataset.url
                    ) {
                        form.action =
                            button.dataset.url;
                    }


                    const description =
                        document.getElementById(
                            'deleteTeamDescription'
                        );

                    if (description) {

                        description.textContent =
                            'Delete "' +
                            (
                                button.dataset.teamName ||
                                'this team'
                            ) +
                            '"?';

                    }


                    openModal(deleteTeamModal);

                }
            );

        });


    /*
    |--------------------------------------------------------------------------
    | DROPDOWN MENUS
    |--------------------------------------------------------------------------
    */

    function closeAllMenus() {

        document
            .querySelectorAll(
                '#projectTeamManager .pt-menu, ' +
                '#projectTeamManager .pt-member-menu, ' +
                'body > .pt-menu.pt-menu-portal, ' +
                'body > .pt-member-menu.pt-member-menu-portal'
            )
            .forEach(function (menu) {

                menu.classList.remove('open');
                menu.classList.remove('open-up');

                restoreMenu(menu);

            });


        document
            .querySelectorAll(
                '#projectTeamManager .pt-menu-button, ' +
                '#projectTeamManager .pt-member-menu-button'
            )
            .forEach(function (button) {

                button.classList.remove('open');

            });


        document
            .querySelectorAll(
                '#projectTeamManager .pt-team-card.menu-open, ' +
                '#projectTeamManager .pt-member.menu-open'
            )
            .forEach(function (item) {

                item.classList.remove('menu-open');

            });

    }


    function restoreMenu(menu) {

        if (
            !menu ||
            menu.dataset.ptPortaled !== '1'
        ) {
            return;
        }

        const parent = menu._ptOriginalParent;
        const nextSibling = menu._ptOriginalNextSibling;

        if (parent) {

            if (
                nextSibling &&
                nextSibling.parentNode === parent
            ) {
                parent.insertBefore(
                    menu,
                    nextSibling
                );
            } else {
                parent.appendChild(menu);
            }

        }

        menu.dataset.ptPortaled = '0';
        menu.classList.remove('pt-menu-portal');
        menu.classList.remove('pt-member-menu-portal');

        menu.style.position = '';
        menu.style.left = '';
        menu.style.top = '';
        menu.style.right = '';
        menu.style.bottom = '';
        menu.style.width = '';
        menu.style.maxHeight = '';

        menu._ptOriginalParent = null;
        menu._ptOriginalNextSibling = null;

    }


    function portalMenu(menu) {

        if (
            !menu ||
            menu.dataset.ptPortaled === '1'
        ) {
            return;
        }

        menu._ptOriginalParent =
            menu.parentElement;

        menu._ptOriginalNextSibling =
            menu.nextElementSibling;

        menu.dataset.ptPortaled = '1';

        menu.classList.add(
            menu.classList.contains('pt-member-menu')
                ? 'pt-member-menu-portal'
                : 'pt-menu-portal'
        );

        document.body.appendChild(menu);

    }


    function positionPortalMenu(menu, button) {

        if (!menu || !button) {
            return;
        }

        requestAnimationFrame(function () {

            const buttonRect =
                button.getBoundingClientRect();

            const menuRect =
                menu.getBoundingClientRect();

            const viewportPadding = 10;
            const gap = 5;

            let left =
                buttonRect.right -
                menuRect.width;

            let top =
                buttonRect.bottom +
                gap;


            /* Keep the menu inside the viewport horizontally. */

            if (
                left <
                viewportPadding
            ) {
                left = viewportPadding;
            }

            if (
                left + menuRect.width >
                window.innerWidth - viewportPadding
            ) {
                left =
                    window.innerWidth -
                    menuRect.width -
                    viewportPadding;
            }


            /* Open upward when there is not enough room below. */

            if (
                top + menuRect.height >
                window.innerHeight -
                viewportPadding
            ) {

                top =
                    buttonRect.top -
                    menuRect.height -
                    gap;

                menu.classList.add(
                    'open-up'
                );

            } else {

                menu.classList.remove(
                    'open-up'
                );

            }


            /* If the menu is taller than the viewport, clamp it. */

            if (
                top <
                viewportPadding
            ) {
                top = viewportPadding;
            }

            if (
                top + menuRect.height >
                window.innerHeight -
                viewportPadding
            ) {
                top =
                    window.innerHeight -
                    menuRect.height -
                    viewportPadding;
            }


            menu.style.left =
                Math.round(left) + 'px';

            menu.style.top =
                Math.round(top) + 'px';

        });

    }


    function openPortalMenu(
        menu,
        button,
        owner
    ) {

        if (!menu || !button) {
            return;
        }

        closeAllMenus();

        if (owner) {
            owner.classList.add('menu-open');
        }

        button.classList.add('open');

        portalMenu(menu);

        menu.classList.add('open');

        positionPortalMenu(
            menu,
            button
        );

    }


    function repositionOpenPortalMenus() {

        document
            .querySelectorAll(
                'body > .pt-menu.pt-menu-portal.open, ' +
                'body > .pt-member-menu.pt-member-menu-portal.open'
            )
            .forEach(function (menu) {

                const buttonSelector =
                    menu.classList.contains(
                        'pt-member-menu-portal'
                    )
                        ? '#projectTeamManager [data-member-menu-button].open'
                        : '#projectTeamManager [data-team-menu-button].open';

                const button =
                    document.querySelector(
                        buttonSelector
                    );

                if (button) {

                    positionPortalMenu(
                        menu,
                        button
                    );

                }

            });

    }


    window.addEventListener(
        'resize',
        repositionOpenPortalMenus
    );

    window.addEventListener(
        'scroll',
        repositionOpenPortalMenus,
        true
    );


    document
        .querySelectorAll(
            '#projectTeamManager [data-team-menu-button]'
        )
        .forEach(function (button) {

            button.addEventListener(
                'click',
                function (event) {

                    event.preventDefault();
                    event.stopPropagation();


                    const wrap =
                        button.closest(
                            '.pt-menu-wrap'
                        );


                    const menu =
                        wrap
                            ? wrap.querySelector(
                                '.pt-menu'
                            )
                            : null;


                    const wasOpen =
                        menu &&
                        menu.classList.contains(
                            'open'
                        );


                    if (wasOpen) {

                        closeAllMenus();

                        return;

                    }


                    const card =
                        button.closest(
                            '.pt-team-card'
                        );


                    openPortalMenu(
                        menu,
                        button,
                        card
                    );

                }
            );

        });


    document
        .querySelectorAll(
            '#projectTeamManager [data-member-menu-button]'
        )
        .forEach(function (button) {

            button.addEventListener(
                'click',
                function (event) {

                    event.preventDefault();
                    event.stopPropagation();


                    const wrap =
                        button.closest(
                            '.pt-member-action-wrap'
                        );


                    const menu =
                        wrap
                            ? wrap.querySelector(
                                '.pt-member-menu'
                            )
                            : null;


                    const wasOpen =
                        menu &&
                        menu.classList.contains(
                            'open'
                        );


                    if (wasOpen) {

                        closeAllMenus();

                        return;

                    }


                    const member =
                        button.closest(
                            '.pt-member'
                        );


                    openPortalMenu(
                        menu,
                        button,
                        member
                    );

                }
            );

        });

    document.addEventListener(
        'click',
        function () {
            closeAllMenus();
        }
    );


    document.addEventListener(
        'click',
        function (event) {

            const menu =
                event.target.closest(
                    '.pt-menu, .pt-member-menu'
                );

            if (menu) {
                event.stopPropagation();
            }

        }
    );


    /*
    |--------------------------------------------------------------------------
    | ESCAPE
    |--------------------------------------------------------------------------
    */

    document.addEventListener(
        'keydown',
        function (event) {

            if (event.key === 'Escape') {

                closeAllModals();
                closeAllMenus();

            }

        }
    );

});
</script>

</div>

@endsection
