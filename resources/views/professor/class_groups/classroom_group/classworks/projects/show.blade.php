<style>
    /* ============================================================
   PROJECT MODAL SCROLL LOCK
============================================================ */

body.material-modal-open {
    overflow: hidden;
}


/* ============================================================
   PROJECT VIEWER BUTTONS
============================================================ */

.project-viewer-actions {
    display: flex;
    align-items: center;
    gap: 8px;
    flex-shrink: 0;
}

.project-viewer-btn {
    width: 42px;
    height: 42px;

    display: inline-flex;
    align-items: center;
    justify-content: center;

    padding: 0;

    border: 1px solid var(--project-border);
    border-radius: 9px;

    background: var(--project-surface);
    color: var(--project-muted);

    cursor: pointer;

    transition:
        background-color .18s ease,
        border-color .18s ease,
        color .18s ease,
        transform .18s ease;
}

.project-viewer-btn:hover {
    border-color: var(--project-blue-border);
    background: var(--project-blue-soft);
    color: var(--project-blue);

    transform: translateY(-1px);
}

.project-viewer-btn i {
    font-size: 21px;
}


/* ============================================================
   CLOSE BUTTON
============================================================ */

.project-viewer-btn.close:hover {
    border-color: #fca5a5;
    background: #fef2f2;
    color: #dc2626;
}


/* ============================================================
   FULLSCREEN CONTAINER
============================================================ */

.project-viewer-container:fullscreen {
    width: 100vw;
    height: 100vh;

    border: 0;
    border-radius: 0;

    box-shadow: none;
}


/* ============================================================
   MOBILE
============================================================ */

@media (max-width: 600px) {

    .project-viewer-modal {
        padding: 0;
    }

    .project-viewer-container {
        width: 100%;
        height: 100%;
        border-radius: 0;
    }

    .project-viewer-header {
        min-height: 58px;
        padding: 0 12px;
    }

    .project-viewer-btn {
        width: 40px;
        height: 40px;
    }

    .project-viewer-title {
        font-size: 15px;
    }

}

/* ============================================================
   PROJECT SHOW PAGE
   Minimal + Larger Typography
   ============================================================ */

.classwork-show-page {

    /* ========================================================
       SMALL PROJECT ACCENT
       ======================================================== */

    --project-accent: #f59e0b;
    --project-accent-dark: #b77900;
    --project-accent-soft: #fff4c2;
    --project-accent-border: #facc15;


    /* ========================================================
       BLUE INTERACTION
       ======================================================== */

    --project-blue: #2563eb;
    --project-blue-dark: #1d4ed8;
    --project-blue-soft: #eff6ff;
    --project-blue-border: #bfdbfe;


    /* ========================================================
       TEXT
       ======================================================== */

    --project-text: #0f172a;
    --project-text-2: #334155;
    --project-muted: #64748b;
    --project-light: #94a3b8;


    /* ========================================================
       SURFACE
       ======================================================== */

    --project-border: #e2e8f0;
    --project-border-light: #edf2f7;

    --project-surface: #ffffff;
    --project-soft: #f8fafc;


    /* ========================================================
       SHADOW
       ======================================================== */

    --project-shadow:
        0 4px 18px rgba(15, 23, 42, .045);

    --project-small-shadow:
        0 2px 7px rgba(15, 23, 42, .035);


    width: 100%;
    max-width: 1240px;

    margin: 0 auto;

    padding: 0 20px;

    color:
        var(--project-text);
}


.classwork-show-page *,
.classwork-show-page *::before,
.classwork-show-page *::after {

    box-sizing:
        border-box;
}


/* ============================================================
   HEADER
   ============================================================ */

.classwork-show-header {

    margin-bottom:
        24px;
}


/* ============================================================
   BACK BUTTON
   ============================================================ */

.classwork-back-btn {

    width:
        auto !important;

    min-width:
        0;

    height:
        42px;

    display:
        inline-flex;

    align-items:
        center;

    justify-content:
        flex-start;

    gap:
        8px;

    margin:
        0 0 17px;

    padding:
        0 !important;

    border:
        0 !important;

    background:
        transparent !important;

    color:
        var(--project-muted);

    text-decoration:
        none;

    box-shadow:
        none !important;

    font-size:
        15px;

    font-weight:
        700;

    line-height:
        1;

    white-space:
        nowrap;

    transition:
        color .18s ease,
        transform .18s ease;
}


.classwork-back-btn:hover {

    color:
        var(--project-blue);

    transform:
        translateX(-2px);
}


.classwork-back-btn i {

    font-size:
        21px;
}


/* ============================================================
   PROJECT HEADER
   ============================================================ */

.classwork-show-heading {

    display:
        flex;

    align-items:
        center;

    gap:
        15px;

    min-width:
        0;
}


.classwork-show-icon {

    width:
        58px;

    height:
        58px;

    flex:
        0 0 58px;

    display:
        inline-flex;

    align-items:
        center;

    justify-content:
        center;

    border:
        1px solid
        var(--project-accent-border);

    border-radius:
        15px;

    background:
        var(--project-accent-soft);

    color:
        var(--project-accent);

    font-size:
        27px;
}


.classwork-show-type {

    display:
        block;

    margin:
        0 0 5px;

    color:
        var(--project-accent-dark);

    font-size:
        12px;

    font-weight:
        800;

    letter-spacing:
        .12em;

    text-transform:
        uppercase;
}


.classwork-show-heading h1 {

    margin:
        0;

    color:
        var(--project-text);

    font-size:
        32px;

    line-height:
        1.15;

    font-weight:
        800;

    letter-spacing:
        -.03em;

    overflow-wrap:
        anywhere;
}


.classwork-show-topic {

    display:
        inline-flex;

    align-items:
        center;

    gap:
        6px;

    margin-top:
        7px;

    color:
        var(--project-muted);

    font-size:
        14px;

    font-weight:
        600;
}


.classwork-show-topic i {

    color:
        var(--project-blue);

    font-size:
        16px;
}


/* ============================================================
   MAIN GRID
   ============================================================ */

.classwork-show-grid {

    display:
        grid;

    grid-template-columns:
        minmax(0, 1fr) 310px;

    gap:
        22px;

    align-items:
        start;
}


.classwork-show-main {

    display:
        flex;

    flex-direction:
        column;

    gap:
        16px;

    min-width:
        0;
}


.classwork-show-sidebar {

    display:
        flex;

    flex-direction:
        column;

    gap:
        16px;

    position:
        sticky;

    top:
        18px;
}


/* ============================================================
   CARDS
   ============================================================ */

.classwork-detail-card {

    overflow:
        hidden;

    min-width:
        0;

    border:
        1px solid
        var(--project-border);

    border-radius:
        16px;

    background:
        var(--project-surface);

    box-shadow:
        var(--project-shadow);
}


/* ============================================================
   CARD HEADER
   ============================================================ */

.classwork-detail-card-header {

    display:
        flex;

    align-items:
        center;

    justify-content:
        space-between;

    gap:
        12px;

    min-height:
        60px;

    padding:
        16px 21px;

    border-bottom:
        1px solid
        var(--project-border-light);

    background:
        var(--project-surface);
}


.classwork-detail-card-header h2 {

    margin:
        0;

    color:
        var(--project-text);

    font-size:
        17px;

    line-height:
        1.3;

    font-weight:
        800;
}


.classwork-detail-card-header h2::before {

    content:
        "";

    display:
        inline-block;

    width:
        4px;

    height:
        18px;

    margin-right:
        9px;

    vertical-align:
        -3px;

    border-radius:
        999px;

    background:
        var(--project-accent);
}


/* ============================================================
   DESCRIPTION
   ============================================================ */

.classwork-description {

    min-height:
        90px;

    padding:
        20px 21px;

    color:
        var(--project-text-2);

    font-size:
        15px;

    line-height:
        1.75;

    overflow-wrap:
        anywhere;
}


.classwork-no-content {

    color:
        var(--project-muted);

    font-style:
        italic;
}


/* ============================================================
   PROJECT TYPE
   Minimal amber accent
   ============================================================ */

.project-type-section {

    padding:
        16px 21px 18px;
}


.project-type-box {

    display:
        flex;

    align-items:
        center;

    gap:
        13px;

    padding:
        13px;

    border:
        1px solid
        var(--project-border);

    border-radius:
        12px;

    background:
        var(--project-soft);
}


.project-type-icon {

    width:
        44px;

    height:
        44px;

    flex:
        0 0 44px;

    display:
        inline-flex;

    align-items:
        center;

    justify-content:
        center;

    border:
        1px solid
        var(--project-accent-border);

    border-radius:
        10px;

    background:
        var(--project-accent-soft);

    color:
        var(--project-accent);

    font-size:
        20px;
}


.project-type-info {

    min-width:
        0;

    flex:
        1;

    display:
        flex;

    flex-direction:
        column;

    gap:
        3px;
}


.project-type-info strong {

    color:
        var(--project-text-2);

    font-size:
        14px;

    font-weight:
        800;
}


.project-type-info span {

    color:
        var(--project-muted);

    font-size:
        13px;

    line-height:
        1.5;
}


/* ============================================================
   FILES
   ============================================================ */

.classwork-files {

    display:
        flex;

    flex-direction:
        column;

    gap:
        8px;

    padding:
        14px 21px 18px;
}


.classwork-file {

    display:
        flex;

    align-items:
        center;

    gap:
        12px;

    min-width:
        0;

    padding:
        11px 12px;

    border:
        1px solid
        var(--project-border);

    border-radius:
        11px;

    background:
        var(--project-soft);

    transition:
        border-color .18s ease,
        background-color .18s ease;
}


.classwork-file:hover {

    border-color:
        var(--project-blue-border);

    background:
        var(--project-blue-soft);
}


.classwork-file-icon {

    width:
        42px;

    height:
        42px;

    flex:
        0 0 42px;

    display:
        inline-flex;

    align-items:
        center;

    justify-content:
        center;

    border:
        1px solid
        var(--project-border);

    border-radius:
        10px;

    background:
        var(--project-surface);

    color:
        var(--project-blue);

    font-size:
        20px;
}


.classwork-file-info {

    min-width:
        0;

    flex:
        1;

    display:
        flex;

    flex-direction:
        column;

    gap:
        3px;
}


.classwork-file-info strong {

    display:
        block;

    overflow:
        hidden;

    color:
        var(--project-text-2);

    font-size:
        14px;

    font-weight:
        750;

    text-overflow:
        ellipsis;

    white-space:
        nowrap;
}


.classwork-file-info span {

    display:
        block;

    color:
        var(--project-muted);

    font-size:
        12px;
}


.classwork-file-open {

    min-height:
        38px;

    display:
        inline-flex;

    align-items:
        center;

    justify-content:
        center;

    gap:
        6px;

    flex:
        0 0 auto;

    padding:
        0 12px;

    border:
        1px solid
        var(--project-blue-border);

    border-radius:
        8px;

    background:
        var(--project-surface);

    color:
        var(--project-blue);

    font-size:
        12px;

    font-weight:
        800;

    cursor:
        pointer;

    text-decoration:
        none;

    transition:
        background-color .18s ease,
        border-color .18s ease,
        color .18s ease,
        transform .18s ease;
}


.classwork-file-open:hover {

    border-color:
        var(--project-blue);

    background:
        var(--project-blue-soft);

    color:
        var(--project-blue-dark);

    transform:
        translateY(-1px);
}


.classwork-file-open i {

    font-size:
        16px;
}


/* ============================================================
   NO FILES
   ============================================================ */

.classwork-no-files {

    min-height:
        120px;

    display:
        flex;

    flex-direction:
        column;

    align-items:
        center;

    justify-content:
        center;

    margin:
        14px 21px 18px;

    padding:
        20px;

    border:
        1px dashed
        var(--project-border);

    border-radius:
        11px;

    background:
        var(--project-soft);

    text-align:
        center;
}


.classwork-no-files i {

    margin-bottom:
        7px;

    color:
        var(--project-light);

    font-size:
        27px;
}


.classwork-no-files p {

    margin:
        0;

    color:
        var(--project-muted);

    font-size:
        13px;
}


/* ============================================================
   SIDEBAR INFO
   ============================================================ */

.classwork-info-list {

    display:
        flex;

    flex-direction:
        column;
}


.classwork-info-item {

    display:
        flex;

    align-items:
        center;

    gap:
        11px;

    padding:
        14px 17px;

    border-bottom:
        1px solid
        var(--project-border-light);
}


.classwork-info-item:last-child {
    border-bottom:
        0;
}


.classwork-info-item > i {

    width:
        36px;

    height:
        36px;

    flex:
        0 0 36px;

    display:
        inline-flex;

    align-items:
        center;

    justify-content:
        center;

    border-radius:
        9px;

    background:
        var(--project-blue-soft);

    color:
        var(--project-blue);

    font-size:
        18px;
}


.classwork-info-item.project-type-info-item > i {

    background:
        var(--project-accent-soft);

    color:
        var(--project-accent);
}


.classwork-info-item > div {

    min-width:
        0;

    display:
        flex;

    flex-direction:
        column;

    gap:
        2px;
}


.classwork-info-item span {

    color:
        var(--project-muted);

    font-size:
        11px;
}


.classwork-info-item strong {

    color:
        var(--project-text-2);

    font-size:
        14px;

    font-weight:
        800;

    overflow-wrap:
        anywhere;
}


/* ============================================================
   SIDEBAR ACTION
   Blue instead of yellow
   ============================================================ */

.classwork-action-btn {
    display: flex;
    align-items: center;
    justify-content: flex-start;
    gap: 9px;

    min-height: 44px;
    margin: 14px 17px 17px;
    padding: 0 13px;

    border: 1px solid var(--project-accent-border);
    border-radius: 9px;

    background: var(--project-accent-soft);
    color: var(--project-accent-dark);

    text-decoration: none;
    font-size: 13px;
    font-weight: 800;

    transition:
        background-color .18s ease,
        border-color .18s ease,
        transform .18s ease;
}

.classwork-action-btn:hover {
    border-color: var(--project-accent-dark);
    background: var(--project-accent-dark);
    color: #ffffff;
    transform: translateY(-1px);
}
.classwork-action-btn i {

    font-size:
        17px;
}


/* ============================================================
   PROJECT TEAMS
   ============================================================ */

.project-teams-section {

    padding:
        17px 21px 21px;
}


.project-teams-summary {

    display:
        flex;

    align-items:
        center;

    justify-content:
        space-between;

    gap:
        14px;

    margin-bottom:
        16px;

    padding:
        14px;

    border:
        1px solid
        var(--project-border);

    border-radius:
        12px;

    background:
        var(--project-soft);
}


.project-teams-summary-left {

    display:
        flex;

    align-items:
        center;

    gap:
        11px;

    min-width:
        0;
}


.project-teams-summary-icon {

    width:
        42px;

    height:
        42px;

    flex:
        0 0 42px;

    display:
        inline-flex;

    align-items:
        center;

    justify-content:
        center;

    border-radius:
        10px;

    background:
        var(--project-accent-soft);

    color:
        var(--project-accent);

    font-size:
        20px;
}


.project-teams-summary-info {

    display:
        flex;

    flex-direction:
        column;

    gap:
        3px;
}


.project-teams-summary-info strong {

    color:
        var(--project-text-2);

    font-size:
        14px;

    font-weight:
        800;
}


.project-teams-summary-info span {

    color:
        var(--project-muted);

    font-size:
        12px;

    line-height:
        1.45;
}


.project-teams-count {

    flex:
        0 0 auto;

    padding:
        7px 10px;

    border:
        1px solid
        var(--project-border);

    border-radius:
        8px;

    background:
        var(--project-surface);

    color:
        var(--project-text-2);

    font-size:
        12px;

    font-weight:
        800;

    white-space:
        nowrap;
}


/* ============================================================
   MANAGE TEAMS
   ============================================================ */

.project-teams-manage {

    display:
        flex;

    align-items:
        center;

    justify-content:
        space-between;

    gap:
        15px;

    margin-bottom:
        16px;

    padding:
        14px;

    border:
        1px solid
        var(--project-border);

    border-radius:
        12px;

    background:
        var(--project-surface);

    box-shadow:
        var(--project-small-shadow);
}


.project-teams-manage-info {

    display:
        flex;

    align-items:
        center;

    gap:
        11px;

    min-width:
        0;
}


.project-teams-manage-icon {

    width:
        40px;

    height:
        40px;

    flex:
        0 0 40px;

    display:
        inline-flex;

    align-items:
        center;

    justify-content:
        center;

    border-radius:
        9px;

    background:
        var(--project-blue-soft);

    color:
        var(--project-blue);

    font-size:
        19px;
}


.project-teams-manage-info > div:last-child {

    display:
        flex;

    flex-direction:
        column;

    gap:
        3px;
}


.project-teams-manage-info strong {

    color:
        var(--project-text);

    font-size:
        13px;

    font-weight:
        800;
}


.project-teams-manage-info span {

    color:
        var(--project-muted);

    font-size:
        11px;

    line-height:
        1.5;
}


.project-teams-manage-btn {

    display:
        inline-flex;

    align-items:
        center;

    justify-content:
        center;

    gap:
        6px;

    flex:
        0 0 auto;

    min-height:
        38px;

    padding:
        0 12px;

    border:
        1px solid
        var(--project-blue-border);

    border-radius:
        8px;

    background:
        var(--project-blue-soft);

    color:
        var(--project-blue-dark);

    font-size:
        12px;

    font-weight:
        800;

    text-decoration:
        none;

    transition:
        background-color .18s ease,
        border-color .18s ease,
        color .18s ease,
        transform .18s ease;
}


.project-teams-manage-btn:hover {

    border-color:
        var(--project-blue);

    background:
        var(--project-blue);

    color:
        #ffffff;

    transform:
        translateY(-1px);
}


.project-teams-manage-btn i {

    font-size:
        16px;
}


/* ============================================================
   EMPTY TEAMS
   ============================================================ */

.project-teams-empty {

    display:
        flex;

    flex-direction:
        column;

    align-items:
        center;

    justify-content:
        center;

    padding:
        32px 22px;

    border:
        1px dashed
        var(--project-border);

    border-radius:
        12px;

    background:
        var(--project-soft);

    text-align:
        center;
}


.project-teams-empty-icon {

    width:
        46px;

    height:
        46px;

    display:
        inline-flex;

    align-items:
        center;

    justify-content:
        center;

    margin-bottom:
        9px;

    border-radius:
        10px;

    background:
        var(--project-blue-soft);

    color:
        var(--project-blue);

    font-size:
        22px;
}


.project-teams-empty strong {

    margin-bottom:
        4px;

    color:
        var(--project-text);

    font-size:
        14px;

    font-weight:
        800;
}


.project-teams-empty span {

    max-width:
        460px;

    color:
        var(--project-muted);

    font-size:
        12px;

    line-height:
        1.6;
}


/* ============================================================
   TEAM GRID
   ============================================================ */

.project-teams-grid {

    display:
        grid;

    grid-template-columns:
        repeat(2, minmax(0, 1fr));

    gap:
        14px;
}


/* ============================================================
   TEAM CARD
   ============================================================ */

.project-team-card {

    overflow:
        hidden;

    border:
        1px solid
        var(--project-border);

    border-radius:
        13px;

    background:
        var(--project-surface);

    box-shadow:
        var(--project-small-shadow);
}


/* ============================================================
   TEAM HEADER
   ============================================================ */

.project-team-header {

    display:
        flex;

    align-items:
        center;

    justify-content:
        space-between;

    gap:
        10px;

    min-height:
        54px;

    padding:
        11px 13px;

    border-bottom:
        1px solid
        var(--project-border-light);

    background:
        var(--project-soft);
}


.project-team-title {

    display:
        flex;

    align-items:
        center;

    gap:
        9px;

    min-width:
        0;
}


.project-team-title-icon {

    width:
        34px;

    height:
        34px;

    flex:
        0 0 34px;

    display:
        inline-flex;

    align-items:
        center;

    justify-content:
        center;

    border-radius:
        8px;

    background:
        var(--project-accent-soft);

    color:
        var(--project-accent);

    font-size:
        17px;
}


.project-team-title strong {

    color:
        var(--project-text);

    font-size:
        14px;

    font-weight:
        800;
}


.project-team-member-count {

    flex:
        0 0 auto;

    padding:
        5px 8px;

    border:
        1px solid
        var(--project-border);

    border-radius:
        7px;

    background:
        var(--project-surface);

    color:
        var(--project-muted);

    font-size:
        10px;

    font-weight:
        750;
}


/* ============================================================
   TEAM MEMBERS
   ============================================================ */

.project-team-members {

    display:
        flex;

    flex-direction:
        column;
}


.project-team-member {

    display:
        flex;

    align-items:
        center;

    gap:
        10px;

    min-width:
        0;

    padding:
        10px 13px;

    border-bottom:
        1px solid
        var(--project-border-light);
}


.project-team-member:last-child {

    border-bottom:
        0;
}


.project-team-avatar {

    width:
        36px;

    height:
        36px;

    flex:
        0 0 36px;

    overflow:
        hidden;

    display:
        inline-flex;

    align-items:
        center;

    justify-content:
        center;

    border-radius:
        50%;

    background:
        var(--project-blue-soft);

    color:
        var(--project-blue-dark);

    font-size:
        13px;

    font-weight:
        800;
}


.project-team-avatar img {

    width:
        100%;

    height:
        100%;

    display:
        block;

    object-fit:
        cover;
}


.project-team-member-info {

    min-width:
        0;

    flex:
        1;

    display:
        flex;

    flex-direction:
        column;

    gap:
        2px;
}


.project-team-member-info strong {

    overflow:
        hidden;

    color:
        var(--project-text-2);

    font-size:
        12px;

    font-weight:
        750;

    text-overflow:
        ellipsis;

    white-space:
        nowrap;
}


.project-team-member-info span {

    color:
        var(--project-muted);

    font-size:
        10px;
}


/* ============================================================
   TEAM ROLE BADGES
   ============================================================ */

.project-team-role {

    flex:
        0 0 auto;

    padding:
        5px 8px;

    border-radius:
        6px;

    font-size:
        9px;

    font-weight:
        800;

    white-space:
        nowrap;
}


.project-team-role.leader {

    border:
        1px solid
        var(--project-accent-border);

    background:
        var(--project-accent-soft);

    color:
        var(--project-accent-dark);
}


.project-team-role.backup {

    border:
        1px solid
        var(--project-blue-border);

    background:
        var(--project-blue-soft);

    color:
        var(--project-blue);
}


.project-team-role.member {

    background:
        var(--project-soft);

    color:
        var(--project-muted);
}


/* ============================================================
   EMPTY TEAM
   ============================================================ */

.project-team-empty {

    padding:
        24px 15px;

    text-align:
        center;
}


.project-team-empty i {

    display:
        block;

    margin-bottom:
        6px;

    color:
        var(--project-light);

    font-size:
        24px;
}


.project-team-empty span {

    color:
        var(--project-muted);

    font-size:
        11px;
}


/* ============================================================
   TEAM FOOTER
   ============================================================ */

.project-team-footer {

    display:
        flex;

    align-items:
        center;

    gap:
        8px;

    padding:
        10px 13px;

    border-top:
        1px solid
        var(--project-border-light);

    background:
        var(--project-soft);
}


.project-team-footer i {

    color:
        var(--project-accent);

    font-size:
        15px;
}


.project-team-footer span {

    color:
        var(--project-muted);

    font-size:
        10px;
}


.project-team-footer strong {

    color:
        var(--project-text-2);

    font-size:
        11px;

    font-weight:
        800;
}


.project-team-leader {

    min-width:
        0;

    flex:
        1;

    display:
        flex;

    align-items:
        center;

    gap:
        7px;
}


/* ============================================================
   VIEW TEAM BUTTON
   Blue
   ============================================================ */

.project-team-view-btn {

    flex:
        0 0 auto;

    display:
        inline-flex;

    align-items:
        center;

    justify-content:
        center;

    gap:
        5px;

    min-height:
        32px;

    padding:
        0 9px;

    border:
        1px solid
        var(--project-blue-border);

    border-radius:
        7px;

    background:
        var(--project-surface);

    color:
        var(--project-blue);

    text-decoration:
        none;

    font-size:
        10px;

    font-weight:
        800;

    white-space:
        nowrap;

    transition:
        .18s ease;
}


.project-team-view-btn:hover {

    border-color:
        var(--project-blue);

    background:
        var(--project-blue-soft);

    color:
        var(--project-blue-dark);
}


.project-team-view-btn i {

    font-size:
        14px;
}


/* ============================================================
   PROJECT SUBMISSIONS
   ============================================================ */

.project-submissions-section {

    padding:
        17px 21px 21px;
}


.project-submissions-summary {

    display:
        flex;

    align-items:
        center;

    justify-content:
        space-between;

    gap:
        14px;

    margin-bottom:
        14px;

    padding:
        13px;

    border:
        1px solid
        var(--project-border);

    border-radius:
        12px;

    background:
        var(--project-soft);
}


.project-submissions-summary-info {

    display:
        flex;

    align-items:
        center;

    gap:
        11px;

    min-width:
        0;
}


.project-submissions-summary-icon {

    width:
        42px;

    height:
        42px;

    flex:
        0 0 42px;

    display:
        inline-flex;

    align-items:
        center;

    justify-content:
        center;

    border-radius:
        10px;

    background:
        var(--project-blue-soft);

    color:
        var(--project-blue);

    font-size:
        20px;
}


.project-submissions-summary-text {

    min-width:
        0;

    display:
        flex;

    flex-direction:
        column;

    gap:
        3px;
}


.project-submissions-summary-text strong {

    color:
        var(--project-text-2);

    font-size:
        14px;

    font-weight:
        800;
}


.project-submissions-summary-text span {

    color:
        var(--project-muted);

    font-size:
        13px;
}


.project-submissions-count {

    flex:
        0 0 auto;

    padding:
        7px 10px;

    border:
        1px solid
        var(--project-border);

    border-radius:
        7px;

    background:
        var(--project-surface);

    color:
        var(--project-text-2);

    font-size:
        11px;

    font-weight:
        800;

    white-space:
        nowrap;
}


/* ============================================================
   SUBMISSION LIST
   ============================================================ */

.project-submission-list {

    display:
        flex;

    flex-direction:
        column;

    gap:
        8px;
}


.project-submission-item {

    display:
        flex;

    align-items:
        center;

    gap:
        11px;

    min-width:
        0;

    padding:
        11px 13px;

    border:
        1px solid
        var(--project-border);

    border-radius:
        11px;

    background:
        var(--project-surface);

    transition:
        border-color .18s ease,
        background-color .18s ease;
}


.project-submission-item:hover {

    border-color:
        var(--project-blue-border);

    background:
        var(--project-blue-soft);
}


.project-submission-icon {

    width:
        38px;

    height:
        38px;

    flex:
        0 0 38px;

    display:
        inline-flex;

    align-items:
        center;

    justify-content:
        center;

    border-radius:
        9px;

    background:
        var(--project-blue-soft);

    color:
        var(--project-blue);

    font-size:
        18px;
}


.project-submission-info {

    min-width:
        0;

    flex:
        1;

    display:
        flex;

    flex-direction:
        column;

    gap:
        3px;
}


.project-submission-info strong {

    overflow:
        hidden;

    color:
        var(--project-text-2);

    font-size:
        16px;

    font-weight:
        800;

    text-overflow:
        ellipsis;

    white-space:
        nowrap;
}


.project-submission-info span {

    color:
        var(--project-muted);

    font-size:
        13px;

    overflow-wrap:
        anywhere;
}


/* ============================================================
   SUBMISSION STATUS
   ============================================================ */

.project-submission-status {

    flex:
        0 0 auto;

    display:
        inline-flex;

    align-items:
        center;

    gap:
        4px;

    padding:
        6px 8px;

    border-radius:
        6px;

    background:
        var(--project-accent-soft);

    color:
        var(--project-accent-dark);

    font-size:
        12px;

    font-weight:
        800;

    white-space:
        nowrap;
}


.project-submission-status.graded {

    background:
        #ecfdf5;

    color:
        #059669;
}


/* ============================================================
   VIEW SUBMISSION
   ============================================================ */

.project-submission-view-btn {

    flex:
        0 0 auto;

    min-height:
        40px;

    display:
        inline-flex;

    align-items:
        center;

    justify-content:
        center;

    gap:
        5px;

    padding:
        0 10px;

    border:
        1px solid
        var(--project-blue-border);

    border-radius:
        7px;

    background:
        var(--project-surface);

    color:
        var(--project-blue);

    text-decoration:
        none;

    font-size:
        12px;

    font-weight:
        800;

    white-space:
        nowrap;

    transition:
        .18s ease;
}


.project-submission-view-btn:hover {

    border-color:
        var(--project-blue);

    background:
        var(--project-blue-soft);
}


/* ============================================================
   FILE VIEWER MODAL
   Keep the viewer mostly neutral
   ============================================================ */

.project-viewer-modal {

    position:
        fixed;

    inset:
        0;

    z-index:
        9999;

    display:
        flex;

    align-items:
        center;

    justify-content:
        center;

    padding:
        20px;

    background:
        #ffffff;

    opacity:
        0;

    visibility:
        hidden;

    pointer-events:
        none;

    transition:
        opacity .2s ease,
        visibility .2s ease;
}


.project-viewer-modal.active {

    opacity:
        1;

    visibility:
        visible;

    pointer-events:
        auto;
}


.project-viewer-container {

    width:
        min(1200px, 100%);

    height:
        min(850px, 90vh);

    display:
        flex;

    flex-direction:
        column;

    overflow:
        hidden;

    border:
        1px solid
        var(--project-border);

    border-radius:
        14px;

    background:
        var(--project-surface);

    box-shadow:
        0 24px 70px
        rgba(0, 0, 0, .35);
}


.project-viewer-header {

    min-height:
        60px;

    display:
        flex;

    align-items:
        center;

    justify-content:
        space-between;

    gap:
        12px;

    padding:
        0 16px;

    border-bottom:
        1px solid
        var(--project-border);

    background:
        var(--project-surface);
}


.project-viewer-title {

    min-width:
        0;

    display:
        flex;

    align-items:
        center;

    gap:
        9px;

    color:
        var(--project-text-2);

    font-size:
        18px;

    font-weight:
        750;
}


.project-viewer-title i {

    color:
        var(--project-blue);

    font-size:
        22px;
}


.project-viewer-title span {

    overflow:
        hidden;

    text-overflow:
        ellipsis;

    white-space:
        nowrap;
}


.project-viewer-actions {

    display:
        flex;

    align-items:
        center;

    gap:
        6px;
}


.project-viewer-btn {

    width:
        40px;

    height:
        40px;

    display:
        inline-flex;

    align-items:
        center;

    justify-content:
        center;

    padding:
        0;

    border:
        1px solid
        var(--project-border);

    border-radius:
        8px;

    background:
        transparent;

    color:
        var(--project-muted);

    cursor:
        pointer;

    transition:
        .18s ease;
}


.project-viewer-btn:hover {

    border-color:
        var(--project-blue-border);

    background:
        var(--project-blue-soft);

    color:
        var(--project-blue);
}


.project-viewer-btn.close:hover {

    border-color:
        #fecaca;

    background:
        #fef2f2;

    color:
        #dc2626;
}


.project-viewer-btn i {

    font-size:
        19px;
}


.project-viewer-body {

    flex:
        1;

    min-height:
        0;

    background:
        #f3f4f6;
}


.project-viewer-body iframe {

    display:
        block;

    width:
        100%;

    height:
        100%;

    border:
        0;

    background:
        #ffffff;
}


.project-viewer-container:fullscreen {

    width:
        100vw;

    height:
        100vh;

    border:
        0;

    border-radius:
        0;
}


/* ============================================================
   FOCUS
   ============================================================ */

.classwork-show-page button:focus-visible,
.classwork-show-page a:focus-visible {

    outline:
        3px solid
        rgba(37, 99, 235, .14);

    outline-offset:
        2px;
}


/* ============================================================
   DARK MODE
   ============================================================ */

.dark-mode .classwork-show-page {

    --project-accent:
        #fbbf24;

    --project-accent-dark:
        #fcd34d;

    --project-accent-soft:
        rgba(251, 191, 36, .16);

    --project-accent-border:
        rgba(251, 191, 36, .45);


    --project-blue:
        #7da2ff;

    --project-blue-dark:
        #9ab4ff;

    --project-blue-soft:
        rgba(125, 162, 255, .10);

    --project-blue-border:
        rgba(125, 162, 255, .28);


    --project-text:
        #f5f5ff;

    --project-text-2:
        #e7e8f7;

    --project-muted:
        #a4a6c5;

    --project-light:
        #9294b5;


    --project-border:
        #2d3050;

    --project-border-light:
        #272a45;


    --project-surface:
        #171932;

    --project-soft:
        #12142a;


    --project-shadow:
        0 7px 24px rgba(0, 0, 10, .25);

    --project-small-shadow:
        0 2px 9px rgba(0, 0, 10, .18);

    color:
        var(--project-text);
}


/* ============================================================
   DARK CARDS
   ============================================================ */

.dark-mode .classwork-show-page
.classwork-detail-card,

.dark-mode .classwork-show-page
.classwork-detail-card-header,

.dark-mode .classwork-show-page
.project-team-card,

.dark-mode .classwork-show-page
.project-teams-manage,

.dark-mode .classwork-show-page
.project-submission-item {

    background:
        var(--project-surface);

    border-color:
        var(--project-border);
}


/* ============================================================
   DARK TEXT
   ============================================================ */

.dark-mode .classwork-show-page
.classwork-show-heading h1,

.dark-mode .classwork-show-page
.classwork-detail-card-header h2,

.dark-mode .classwork-show-page
.project-team-title strong,

.dark-mode .classwork-show-page
.project-submission-info strong {

    color:
        var(--project-text);
}


/* ============================================================
   DARK PROJECT TYPE
   ============================================================ */

.dark-mode .classwork-show-page
.project-type-box,

.dark-mode .classwork-show-page
.project-teams-summary {

    background:
        var(--project-soft);

    border-color:
        var(--project-border);
}


/* ============================================================
   DARK FILES
   ============================================================ */

.dark-mode .classwork-show-page
.classwork-file {

    background:
        var(--project-soft);

    border-color:
        var(--project-border);
}


.dark-mode .classwork-show-page
.classwork-file:hover {

    background:
        var(--project-blue-soft);

    border-color:
        var(--project-blue-border);
}


.dark-mode .classwork-show-page
.classwork-file-icon {

    background:
        var(--project-surface);

    border-color:
        var(--project-border);

    color:
        var(--project-blue);
}


/* ============================================================
   DARK TEAM
   ============================================================ */

.dark-mode .classwork-show-page
.project-team-header,

.dark-mode .classwork-show-page
.project-team-footer {

    background:
        var(--project-soft);

    border-color:
        var(--project-border-light);
}


.dark-mode .classwork-show-page
.project-team-member {

    border-color:
        var(--project-border-light);
}


/* ============================================================
   DARK ACTIONS
   ============================================================ */

.dark-mode .classwork-show-page
.classwork-action-btn,

.dark-mode .classwork-show-page
.project-teams-manage-btn {

    background:
        var(--project-blue-soft);

    border-color:
        var(--project-blue-border);

    color:
        var(--project-blue-dark);
}


.dark-mode .classwork-show-page
.classwork-action-btn:hover,

.dark-mode .classwork-show-page
.project-teams-manage-btn:hover {

    background:
        var(--project-blue);

    border-color:
        var(--project-blue);

    color:
        #ffffff;
}


/* ============================================================
   DARK SUBMISSIONS
   ============================================================ */

.dark-mode .classwork-show-page
.project-submissions-summary {

    background:
        var(--project-soft);

    border-color:
        var(--project-border);
}


.dark-mode .classwork-show-page
.project-submission-item:hover {

    background:
        var(--project-blue-soft);

    border-color:
        var(--project-blue-border);
}

/* ============================================================
   RESPONSIVE
   ============================================================ */

@media (max-width: 1050px) {

    .classwork-show-grid {

        grid-template-columns:
            minmax(0, 1fr) 280px;

        gap:
            16px;
    }


    .classwork-show-heading h1 {

        font-size:
            30px;
    }
}


@media (max-width: 900px) {

    .classwork-show-grid {

        grid-template-columns:
            1fr;
    }


    .classwork-show-sidebar {

        position:
            static;
    }


    .project-teams-grid {

        grid-template-columns:
            repeat(2, minmax(0, 1fr));
    }
}


@media (max-width: 700px) {

    .classwork-show-page {

        padding:
            20px 16px 35px;
    }


    .classwork-show-heading {

        gap:
            12px;
    }


    .classwork-show-icon {

        width:
            50px;

        height:
            50px;

        flex-basis:
            50px;

        border-radius:
            13px;

        font-size:
            23px;
    }


    .classwork-show-heading h1 {

        font-size:
            26px;
    }


    .classwork-show-topic {

        font-size:
            13px;
    }


    .classwork-detail-card-header {

        min-height:
            56px;

        padding:
            15px 17px;
    }


    .classwork-detail-card-header h2 {

        font-size:
            16px;
    }


    .classwork-description {

        padding:
            18px;

        font-size:
            14px;
    }


    .project-type-section {

        padding:
            15px 17px 17px;
    }


    .classwork-files {

        padding:
            13px 17px 17px;
    }


    .classwork-file {

        align-items:
            flex-start;

        flex-wrap:
            wrap;
    }


    .classwork-file-open {

        width:
            100%;
    }


    .project-teams-section,
    .project-submissions-section {

        padding:
            15px 17px 18px;
    }


    .project-teams-grid {

        grid-template-columns:
            1fr;
    }


    .project-teams-manage {

        align-items:
            stretch;

        flex-direction:
            column;
    }


    .project-teams-manage-btn {

        width:
            100%;
    }


    .project-submission-item {

        align-items:
            flex-start;

        flex-wrap:
            wrap;
    }


    .project-submission-view-btn {

        width:
            100%;
    }
}


@media (max-width: 480px) {

    .classwork-show-page {

        padding:
            16px 13px 28px;
    }


    .classwork-back-btn {

        font-size:
            13px;
    }


    .classwork-show-icon {

        width:
            46px;

        height:
            46px;

        flex-basis:
            46px;

        font-size:
            21px;
    }


    .classwork-show-type {

        font-size:
            10px;
    }


    .classwork-show-heading h1 {

        font-size:
            23px;
    }


    .classwork-show-topic {

        font-size:
            12px;
    }


    .project-teams-summary,
    .project-submissions-summary {

        align-items:
            flex-start;

        flex-direction:
            column;
    }


    .project-teams-count,
    .project-submissions-count {

        align-self:
            flex-start;
    }


    .project-team-member {

        align-items:
            flex-start;
    }
}



/* ============================================================
   STRONGER YELLOW ACCENT
   ============================================================ */

.classwork-show-icon {
    background: linear-gradient(135deg, #fff4c2 0%, #fde68a 100%);
    border-color: #facc15;
    color: #b77900;
    box-shadow: 0 5px 14px rgba(234, 179, 8, .18);
}

.classwork-show-type {
    color: #b77900;
}

.project-type-icon,
.project-teams-summary-icon,
.project-team-title-icon {
    background: linear-gradient(135deg, #fff8d6 0%, #fef08a 100%);
    border-color: #facc15;
    color: #b77900;
}

.project-team-role.leader {
    background: #fef3c7;
    border-color: #facc15;
    color: #92400e;
}

.project-team-footer i {
    color: #eab308;
}

.dark-mode .classwork-show-page .classwork-show-icon {
    background: linear-gradient(135deg, rgba(251, 191, 36, .28), rgba(245, 158, 11, .16));
    border-color: #fbbf24;
    color: #fcd34d;
    box-shadow: 0 5px 16px rgba(251, 191, 36, .12);
}

.dark-mode .classwork-show-page .project-type-icon,
.dark-mode .classwork-show-page .project-teams-summary-icon,
.dark-mode .classwork-show-page .project-team-title-icon {
    background: rgba(251, 191, 36, .18);
    border-color: rgba(251, 191, 36, .5);
    color: #fcd34d;
}

.dark-mode .classwork-show-page .project-team-role.leader {
    background: rgba(251, 191, 36, .18);
    border-color: rgba(251, 191, 36, .5);
    color: #fde68a;
}

.dark-mode .classwork-show-page .project-team-footer i {
    color: #fbbf24;
}

</style>

@extends('layouts.prof_layout')

@section('content')
@php
    $returnTo = request('origin', request('return_to', 'stream'));
@endphp

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






    </div>

</section>

@endif


            {{-- ====================================================
                ATTACHED FILES
            ===================================================== --}}

            @php
                $fileResources = $project->resources->filter(function ($resource) {
                    return !empty($resource->file_path);
                });
            @endphp

            @if($fileResources->isNotEmpty())

            <section class="classwork-detail-card">

                <div class="classwork-detail-card-header">

                    <h2>
                        Attachments
                    </h2>

                </div>

                <div class="classwork-files">

                    @foreach($fileResources as $resource)

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
                                    : 'Project attachment'
                                }}
                            </span>

                        </div>

                        <button
                            type="button"
                            class="classwork-file-open"
                            data-file-url="{{ asset('storage/' . $resource->file_path) }}"
                            data-file-name="{{ $resource->file_name ?? $resource->title }}"
                        >
                            <i class="bx bx-show"></i>
                            Open
                        </button>

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
    PROJECT FILE VIEWER
================================================================= --}}

<div
    id="projectViewerModal"
    class="project-viewer-modal"
    aria-hidden="true"
    role="dialog"
    aria-modal="true"
>

    <div class="project-viewer-container">

        <div class="project-viewer-header">

            <div class="project-viewer-title">
                <i class="bx bx-file"></i>
                <span id="projectViewerTitle">Project Attachment</span>
            </div>

            <div class="project-viewer-actions">

                <button
                    type="button"
                    id="projectFullscreenBtn"
                    class="project-viewer-btn"
                    title="Fullscreen"
                    aria-label="Fullscreen"
                >
                    <i class="bx bx-fullscreen"></i>
                </button>

                <button
                    type="button"
                    id="closeProjectPreview"
                    class="project-viewer-btn close"
                    title="Close"
                    aria-label="Close"
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
                title="Project file preview"
            ></iframe>
        </div>

    </div>

</div>

<script>
document.addEventListener('DOMContentLoaded', function () {

    const modal = document.getElementById('projectViewerModal');
    const container = modal
        ? modal.querySelector('.project-viewer-container')
        : null;

    const iframe = document.getElementById('projectViewerFrame');
    const title = document.getElementById('projectViewerTitle');
    const fullscreenButton = document.getElementById('projectFullscreenBtn');
    const closeButton = document.getElementById('closeProjectPreview');
    const fileButtons = document.querySelectorAll('.classwork-file-open');

    if (!modal || !container || !iframe || !fullscreenButton || !closeButton) {
        console.error('Project file viewer elements were not found.');
        return;
    }

    function updateFullscreenButton() {
        const isFullscreen = document.fullscreenElement === container;

        fullscreenButton.innerHTML = isFullscreen
            ? '<i class="bx bx-exit-fullscreen"></i>'
            : '<i class="bx bx-fullscreen"></i>';

        fullscreenButton.title = isFullscreen
            ? 'Exit Fullscreen'
            : 'Fullscreen';

        fullscreenButton.setAttribute(
            'aria-label',
            isFullscreen
                ? 'Exit Fullscreen'
                : 'Fullscreen'
        );
    }

    function openProjectFile(fileUrl, fileName) {
        if (!fileUrl) {
            return;
        }

        if (title) {
            title.textContent = fileName || 'Project Attachment';
        }

        iframe.src = fileUrl;

        modal.classList.add('active');
        modal.setAttribute('aria-hidden', 'false');
        document.body.classList.add('material-modal-open');

        updateFullscreenButton();
    }

    async function closeProjectModal() {
        try {
            if (document.fullscreenElement === container) {
                await document.exitFullscreen();
            }
        } catch (error) {
            console.error('Could not exit fullscreen:', error);
        }

        iframe.src = '';
        modal.classList.remove('active');
        modal.setAttribute('aria-hidden', 'true');
        document.body.classList.remove('material-modal-open');

        if (title) {
            title.textContent = 'Project Attachment';
        }

        updateFullscreenButton();
    }

    async function toggleProjectFullscreen() {
        try {
            if (!document.fullscreenElement) {
                await container.requestFullscreen();
            } else if (document.fullscreenElement === container) {
                await document.exitFullscreen();
            }
        } catch (error) {
            console.error('Fullscreen failed:', error);
        }
    }

    fileButtons.forEach(function (button) {
        button.addEventListener('click', function (event) {
            event.preventDefault();

            openProjectFile(
                this.dataset.fileUrl,
                this.dataset.fileName
            );
        });
    });

    fullscreenButton.addEventListener('click', function (event) {
        event.preventDefault();
        event.stopPropagation();
        toggleProjectFullscreen();
    });

    closeButton.addEventListener('click', function (event) {
        event.preventDefault();
        event.stopPropagation();
        closeProjectModal();
    });

    modal.addEventListener('click', function (event) {
        if (event.target === modal) {
            closeProjectModal();
        }
    });

    document.addEventListener('keydown', function (event) {
        if (!modal.classList.contains('active')) {
            return;
        }

        if (event.key === 'Escape' && !document.fullscreenElement) {
            closeProjectModal();
        }
    });

    document.addEventListener('fullscreenchange', function () {
        updateFullscreenButton();
    });

    // Keep these functions available for any existing onclick calls elsewhere.
    window.openProjectFile = openProjectFile;
    window.closeProjectModal = closeProjectModal;
    window.toggleProjectFullscreen = toggleProjectFullscreen;

    updateFullscreenButton();
});
</script>

@endsection
