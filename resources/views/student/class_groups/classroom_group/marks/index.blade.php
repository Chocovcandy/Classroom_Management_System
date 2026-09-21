<style>
    /* ============================================================
   PAGE
============================================================ */

    .professor-marks-page {
        width: 100%;
        max-width: 1500px;
        margin: 0 auto;
        padding: 0 20px;
        box-sizing: border-box;
    }


    /* ============================================================
   HEADER
============================================================ */

    .marks-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 24px;
        margin-bottom: 28px;
    }

    .marks-header-left {
        display: flex;
        align-items: center;
        gap: 17px;
    }

    .marks-header-icon {
        width: 62px;
        height: 62px;

        display: flex;
        align-items: center;
        justify-content: center;

        flex-shrink: 0;

        border-radius: 17px;

        background: rgba(99, 102, 241, 0.10);
        color: #6366f1;

        font-size: 29px;
    }

    .marks-kicker {
        display: block;
        margin-bottom: 5px;

        color: var(--primary-color);

        font-size: 11px;
        font-weight: 750;

        text-transform: uppercase;
        letter-spacing: 0.07em;
    }

    .marks-header-left h1 {
        margin: 0;

        color: var(--text-color);

        font-size: 34px;
        line-height: 1.15;
        font-weight: 750;
    }

    .marks-header-left p {
        margin: 6px 0 0;

        color: var(--text-secondary);

        font-size: 15px;
    }

    .marks-header-count {
        display: flex;
        align-items: baseline;
        gap: 7px;

        padding: 13px 17px;

        border: 1px solid var(--border-color);
        border-radius: 13px;

        background: var(--card-color);
    }

    .marks-header-count strong {
        color: var(--text-color);
        font-size: 23px;
    }

    .marks-header-count span {
        color: var(--text-secondary);
        font-size: 13px;
    }


    /* ============================================================
   SEARCH
============================================================ */

    .marks-toolbar {
        margin-bottom: 23px;
    }

    .marks-search {
        position: relative;

        width: 390px;
        max-width: 100%;
    }

    .marks-search>i {
        position: absolute;

        top: 50%;
        left: 15px;

        transform: translateY(-50%);

        color: var(--text-secondary);

        font-size: 20px;

        pointer-events: none;
    }

    .marks-search input {
        width: 100%;
        height: 48px;

        padding: 0 43px;

        border: 1px solid var(--border-color);
        border-radius: 11px;

        background: var(--card-color);
        color: var(--text-color);

        outline: none;

        box-sizing: border-box;

        font-size: 14px;
    }

    .marks-search input::placeholder {
        color: var(--text-secondary);
    }

    .marks-search input:focus {
        border-color: rgba(99, 102, 241, 0.45);

        box-shadow:
            0 0 0 4px rgba(99, 102, 241, 0.07);
    }

    .marks-search button {
        position: absolute;

        top: 50%;
        right: 9px;

        transform: translateY(-50%);

        width: 29px;
        height: 29px;

        display: inline-flex;
        align-items: center;
        justify-content: center;

        border: 0;
        border-radius: 7px;

        background: transparent;
        color: var(--text-secondary);

        cursor: pointer;

        font-size: 19px;
    }

    .marks-search button:hover {
        background: rgba(99, 102, 241, 0.08);
        color: var(--text-color);
    }


    /* ============================================================
   SECTION
============================================================ */

    .marks-section-heading {
        display: flex;
        align-items: center;
        justify-content: space-between;

        gap: 20px;

        margin-bottom: 13px;
    }

    .marks-section-heading-right {
        display: flex;
        align-items: center;
        justify-content: flex-end;

        gap: 22px;

        min-width: 0;
    }

    .marks-section-heading h2 {
        margin: 0;

        color: var(--text-color);

        font-size: 21px;
        font-weight: 720;
    }

    .marks-classwork-count {
        color: var(--text-secondary);
        font-size: 13px;
    }


    /* ============================================================
   TABLE WRAPPER
============================================================ */

    .gradebook-wrapper {
        overflow: hidden;

        border: 1px solid var(--border-color);
        border-radius: 15px;

        background: var(--card-color);
    }

    .gradebook-scroll {
        max-width: 100%;
        max-height: 680px;

        overflow: auto;
    }

    .gradebook-scroll::-webkit-scrollbar {
        width: 9px;
        height: 9px;
    }

    .gradebook-scroll::-webkit-scrollbar-track {
        background: transparent;
    }

    .gradebook-scroll::-webkit-scrollbar-thumb {
        border-radius: 10px;
        background: rgba(100, 116, 139, 0.25);
    }

    .gradebook-scroll::-webkit-scrollbar-thumb:hover {
        background: rgba(100, 116, 139, 0.4);
    }

    .marks-table {
        width: max-content;
        min-width: 100%;

        border-collapse: separate;
        border-spacing: 0;

        table-layout: fixed;
    }

    .marks-table th,
    .marks-table td {
        border-right: 1px solid var(--border-color);
        border-bottom: 1px solid var(--border-color);

        box-sizing: border-box;
    }

    .marks-table tr>*:last-child {
        border-right: 0;
    }

    .marks-table tbody tr:last-child td {
        border-bottom: 0;
    }


    /* ============================================================
   STUDENT COLUMN
============================================================ */

    .student-column,
    .student-name-cell {
        position: sticky;
        left: 0;

        width: 235px;
        min-width: 235px;

        background: var(--card-color);
    }

    .student-column {
        top: 0;
        z-index: 8;

        height: 108px;

        padding: 0 17px;

        color: var(--text-color);

        text-align: left;
        vertical-align: middle;

        font-size: 14px;
        font-weight: 750;

        text-transform: uppercase;
        letter-spacing: 0.025em;
    }

    .student-name-cell {
        z-index: 5;

        padding: 0 17px;

        vertical-align: middle;
    }

    .student-info {
        display: flex;
        align-items: center;

        gap: 12px;
    }

    .student-info strong {
        overflow: hidden;

        color: var(--text-color);

        font-size: 14px;
        font-weight: 650;

        text-overflow: ellipsis;
        white-space: nowrap;
    }

    .student-avatar {
        width: 40px;
        height: 40px;

        display: flex;
        align-items: center;
        justify-content: center;

        flex-shrink: 0;

        overflow: hidden;

        border-radius: 50%;

        background: #f1f5f9;
        color: #64748b;

        font-size: 19px;
    }

    .student-avatar img {
        width: 100%;
        height: 100%;

        display: block;

        object-fit: cover;
    }


    /* ============================================================
   CLASSWORK COLUMNS
============================================================ */

    .classwork-column {
        position: sticky;
        top: 0;

        z-index: 6;

        width: 185px;
        min-width: 185px;

        height: 108px;

        padding: 12px;

        background: var(--card-color);

        vertical-align: top;
    }

    .classwork-column.assignment {
        border-top: 4px solid #22c55e;
    }

    .classwork-column.quiz {
        border-top: 4px solid #8b5cf6;
    }

    .classwork-column.exam {
        border-top: 4px solid #ef4444;
    }

    .classwork-header {
        position: relative;

        display: flex;
        align-items: flex-start;

        gap: 9px;

        min-width: 0;
    }


    /* ============================================================
   CLASSWORK ICON
============================================================ */

    .classwork-icon {
        width: 35px;
        height: 35px;

        display: flex;
        align-items: center;
        justify-content: center;

        flex-shrink: 0;

        border-radius: 9px;

        font-size: 17px;
    }

    .classwork-icon.assignment {
        background: #eefbf2;
        color: #15803d;
    }

    .classwork-icon.quiz {
        background: #f5efff;
        color: #7c3aed;
    }

    .classwork-icon.exam {
        background: #fcebeb;
        color: #e0443a;
    }

    .classwork-column.project {
        border-top: 4px solid #eab308;
    }

    .classwork-icon.project {
        background: #fef9c3;
        color: #ca8a04;
    }

    .marks-cell.project {
        background: rgba(234, 179, 8, 0.025);
    }

    .marks-cell.project .mark-edit-trigger:hover {
        background: rgba(234, 179, 8, 0.10);
    }

    .marks-cell.project .mark-score {
        color: var(--text-color);
    }

    .marks-cell.project .mark-edit-trigger:hover .mark-score {
        color: #ca8a04;
    }


    /* ============================================================
   PROJECT TEAM BADGE
============================================================ */

    .project-team-badge {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 6px;
        flex: 0 0 auto;
        width: fit-content;
        margin: 0;
        padding: 6px 10px;
        border: 1px solid rgba(234, 179, 8, 0.32);
        border-radius: 8px;
        background: #fff9d9;
        color: #a16207;
        font-size: 13px;
        font-weight: 800;
        line-height: 1;
        white-space: nowrap;
    }

    .project-team-badge i {
        font-size: 15px;
    }

    .project-team-missing {
        margin: 0;
    }

    /* Team + grade/status stay on ONE row */
    .marks-cell.project .mark-edit-trigger {
        flex-direction: row;
        align-items: center;
        justify-content: center;
        gap: 8px;
        flex-wrap: nowrap;
        width: 100%;
    }

    .marks-cell.project .mark-edit-trigger .project-team-badge {
        flex-shrink: 0;
    }

    .marks-cell.project .mark-edit-trigger .cell-status {
        margin: 0;
        white-space: nowrap;
    }

    .marks-cell.project .mark-edit-trigger .mark-score-display {
        margin: 0;
        flex: 0 0 auto;
    }

    .marks-cell.project > .project-team-missing + .cell-status {
        display: inline-flex;
        vertical-align: middle;
        margin-left: 8px;
    }

    .project-team-status-row {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        flex-wrap: nowrap;
        width: 100%;
    }

    .project-team-status-row .cell-status {
        margin: 0;
        white-space: nowrap;
    }


    /* ============================================================
   CLASSWORK TEXT
============================================================ */

    .classwork-header-text {
        min-width: 0;

        flex: 1;

        padding-right: 25px;
    }

    .classwork-header-text {
        min-width: 0;
        flex: 1;
        padding-right: 25px;
    }

    .classwork-header-text .classwork-type {
        display: block;
        margin-bottom: 5px;

        overflow: hidden;

        font-size: 10px;
        font-weight: 800;
        line-height: 1.2;

        letter-spacing: .06em;
        text-transform: uppercase;

        text-overflow: ellipsis;
        white-space: nowrap;
    }

    .classwork-header-text .classwork-type.assignment {
        color: #16a34a;
    }

    .classwork-header-text .classwork-type.quiz {
        color: #7c3aed;
    }

    .classwork-header-text .classwork-type.exam {
        color: #dc2626;
    }

    .classwork-header-text .classwork-type.project {
        color: #ca8a04;
    }

    .classwork-header-text strong {
        display: block;

        overflow: hidden;

        color: var(--text-color);

        font-size: 13px;
        font-weight: 720;

        line-height: 1.35;

        text-overflow: ellipsis;
        white-space: nowrap;
    }


    /* ============================================================
   THREE DOT BUTTON
============================================================ */

    .classwork-menu {
        position: absolute;

        top: -2px;
        right: -3px;

        z-index: 20;
    }

    .classwork-menu-button {
        width: 31px;
        height: 31px;

        display: flex;
        align-items: center;
        justify-content: center;

        border: 0;
        border-radius: 8px;

        background: transparent;
        color: var(--text-secondary);

        cursor: pointer;

        font-size: 21px;

        transition:
            background 0.18s ease,
            color 0.18s ease,
            transform 0.18s ease;
    }

    .classwork-menu-button:hover,
    .classwork-menu-button[aria-expanded="true"] {
        background: rgba(99, 102, 241, 0.09);
        color: var(--text-color);
    }


    /* ============================================================
   DROPDOWN
============================================================ */

    .classwork-dropdown {
        position: absolute;

        top: calc(100% + 7px);
        right: 0;

        width: 215px;

        padding: 7px;

        border: 1px solid var(--border-color);
        border-radius: 11px;

        background: var(--card-color);

        box-shadow:
            0 12px 35px rgba(15, 23, 42, 0.13);

        opacity: 0;
        visibility: hidden;

        transform: translateY(-5px) scale(0.98);

        transform-origin: top right;

        transition:
            opacity 0.16s ease,
            visibility 0.16s ease,
            transform 0.16s ease;
    }

    .classwork-menu.open .classwork-dropdown {
        opacity: 1;
        visibility: visible;

        transform: translateY(0) scale(1);
    }

    .classwork-action {
        width: 100%;

        display: flex;
        align-items: center;

        gap: 11px;

        padding: 10px 11px;

        border: 0;
        border-radius: 7px;

        background: transparent;

        color: var(--text-color);

        text-align: left;

        font-size: 13px;
        font-weight: 550;

        cursor: pointer;

        transition:
            background 0.15s ease,
            color 0.15s ease;
    }

    .classwork-action i {
        width: 18px;

        color: var(--text-secondary);

        font-size: 17px;

        text-align: center;
    }

    .classwork-action:hover {
        background: rgba(99, 102, 241, 0.07);
    }

    .classwork-action:hover i {
        color: var(--primary-color);
    }

    .classwork-action.danger {
        color: #dc2626;
    }

    .classwork-action.danger i {
        color: #dc2626;
    }

    .classwork-action.danger:hover {
        background: rgba(239, 68, 68, 0.07);
    }

    .classwork-menu-divider {
        height: 1px;

        margin: 5px 4px;

        background: var(--border-color);
    }


    /* ============================================================
   MARK CELLS
============================================================ */

    .student-row {
        height: 68px;
    }

    .student-row:hover>td {
        background: rgba(99, 102, 241, 0.025);
    }

    .student-row:hover>.student-name-cell {
        background: var(--card-color);
    }

    .marks-cell {
        width: 185px;
        min-width: 185px;

        padding: 7px;

        text-align: center;
        vertical-align: middle;

        background: var(--card-color);
    }

    .marks-cell.assignment {
        background: rgba(34, 197, 94, 0.018);
    }

    .marks-cell.quiz {
        background: rgba(139, 92, 246, 0.018);
    }

    .marks-cell.exam {
        background: rgba(239, 68, 68, 0.018);
    }

    .mark-edit-trigger {
        width: 100%;
        min-height: 54px;
        padding: 5px 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        border: 0;
        border-radius: 9px;
        background: transparent;
        color: inherit;
        cursor: pointer;
        transition: background .18s ease, transform .18s ease;
    }

    .mark-edit-trigger:hover {
        background: rgba(99, 102, 241, .055);
    }

    .marks-cell.assignment .mark-edit-trigger:hover {
        background: rgba(34, 197, 94, .07);
    }

    .marks-cell.quiz .mark-edit-trigger:hover {
        background: rgba(139, 92, 246, .07);
    }

    .marks-cell.exam .mark-edit-trigger:hover {
        background: rgba(239, 68, 68, .07);
    }

    .marks-cell.assignment .mark-edit-trigger:hover .mark-score {
        color: #15803d;
    }

    .marks-cell.quiz .mark-edit-trigger:hover .mark-score {
        color: #7c3aed;
    }

    .marks-cell.exam .mark-edit-trigger:hover .mark-score {
        color: #e0443a;
    }

    .mark-edit-trigger:active {
        transform: scale(.985);
    }

    .mark-edit-trigger:focus-visible {
        outline: 2px solid rgba(99, 102, 241, .45);
        outline-offset: 1px;
    }

    .mark-score-display {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        gap: 4px;
    }

    .mark-score-main {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 4px;
    }

    .mark-score {
        display: inline-block;
        color: var(--text-color);
        font-size: 14px;
        font-weight: 750;
        transition: color .18s ease;
    }

    .mark-score-divider {
        color: var(--text-secondary);
        font-size: 13px;
        font-weight: 500;
    }

    .mark-score-max {
        color: var(--text-secondary);
        font-size: 13px;
        font-weight: 600;
    }

    .mark-edit-icon {
        margin-left: 4px;
        color: var(--text-secondary);
        font-size: 13px;
        opacity: .45;
        transition: color .18s ease, opacity .18s ease, transform .18s ease;
    }

    .mark-edit-trigger:hover .mark-edit-icon {
        color: var(--primary-color);
        opacity: 1;
        transform: scale(1.08);
    }

    .mark-edit-trigger:hover .mark-score {
        color: var(--primary-color);
    }

    .mark-percentage {
        display: block;

        margin-top: 4px;

        color: var(--text-secondary);

        font-size: 11px;
        font-weight: 550;
    }


    /* ============================================================
   STATUS
============================================================ */

    .cell-status {
        display: inline-flex;

        align-items: center;
        justify-content: center;

        min-height: 29px;

        padding: 0 10px;

        border-radius: 7px;

        font-size: 11px;
        font-weight: 650;
    }

    .cell-status.pending {
        background: rgba(239, 68, 68, 0.07);
        color: #b91c1c;
    }

    .cell-status.missing {
        background: rgba(245, 158, 11, 0.08);
        color: #b45309;
    }


    /* ============================================================
   LEGEND
============================================================ */

    .marks-legend {
        display: flex;
        align-items: center;
        justify-content: flex-end;

        flex-wrap: nowrap;

        gap: 18px;

        margin: 0;
        padding: 0;

        white-space: nowrap;
    }

    .marks-legend span {
        display: inline-flex;
        align-items: center;

        gap: 7px;

        flex: 0 0 auto;

        color: var(--text-secondary);

        font-size: 11px;

        white-space: nowrap;
    }

    .legend-dot {
        width: 8px;
        height: 8px;

        flex: 0 0 8px;

        border-radius: 50%;
    }

    .legend-dot.graded {
        background: #10b981;
    }

    .legend-dot.pending {
        background: #ef4444;
    }

    .legend-dot.missing {
        background: #f59e0b;
    }


    /* ============================================================
   SEARCH EMPTY
============================================================ */

    .marks-search-empty {
        padding: 45px 20px;

        text-align: center;
    }

    .marks-search-empty i {
        display: block;

        margin-bottom: 9px;

        color: var(--text-secondary);

        font-size: 28px;
    }

    .marks-search-empty h3 {
        margin: 0 0 6px;

        color: var(--text-color);

        font-size: 17px;
    }

    .marks-search-empty p,
    .marks-empty-state p {
        margin: 0;

        color: var(--text-secondary);

        font-size: 12px;
    }


    /* ============================================================
   EMPTY STATE
============================================================ */

    .marks-empty-state {
        padding: 55px 20px;

        border: 1px dashed var(--border-color);
        border-radius: 15px;

        background: var(--card-color);

        text-align: center;
    }

    .marks-empty-icon {
        width: 58px;
        height: 58px;

        display: flex;
        align-items: center;
        justify-content: center;

        margin: 0 auto 13px;

        border-radius: 15px;

        background: rgba(99, 102, 241, 0.08);
        color: var(--primary-color);

        font-size: 26px;
    }

    .marks-empty-state h3 {
        margin: 0 0 7px;

        color: var(--text-color);

        font-size: 19px;
    }


    /* ============================================================
   GRADE ALL MODAL
============================================================ */

    /* ============================================================
   INDIVIDUAL GRADE MODAL
============================================================ */
    .single-grade-modal {
        position: fixed;
        inset: 0;
        z-index: 9999;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 20px;
    }

    .single-grade-modal[hidden] {
        display: none;
    }

    .single-grade-overlay {
        position: absolute;
        inset: 0;
        background: rgba(15, 23, 42, .48);
        backdrop-filter: blur(3px);
    }

    .single-grade-dialog {
        position: relative;
        z-index: 1;
        width: min(100%, 520px);
        max-height: calc(100vh - 40px);
        overflow-y: auto;
        background: var(--card-color);
        border: 1px solid var(--border-color);
        border-radius: 18px;
        box-shadow: 0 24px 70px rgba(15, 23, 42, .18);
        animation: singleGradeSlideIn .2s ease;
    }

    .single-grade-header {
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        gap: 16px;
        padding: 22px;
        border-bottom: 1px solid var(--border-color);
    }

    .single-grade-header-left {
        display: flex;
        align-items: center;
        gap: 13px;
        min-width: 0;
    }

    .single-grade-icon {
        width: 44px;
        height: 44px;
        flex: 0 0 44px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 12px;
        background: rgba(99, 102, 241, .09);
        color: #6366f1;
        font-size: 21px;
    }

    .single-grade-kicker {
        display: block;
        margin-bottom: 3px;
        color: var(--text-secondary);
        font-size: 10px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: .08em;
    }

    .single-grade-header h2 {
        margin: 0;
        color: var(--text-color);
        font-size: 18px;
        font-weight: 750;
    }

    .single-grade-header p {
        margin: 3px 0 0;
        color: var(--text-secondary);
        font-size: 12px;
    }

    .single-grade-close {
        width: 34px;
        height: 34px;
        flex: 0 0 34px;
        display: flex;
        align-items: center;
        justify-content: center;
        border: 0;
        border-radius: 9px;
        background: transparent;
        color: var(--text-secondary);
        cursor: pointer;
        font-size: 20px;
    }

    .single-grade-close:hover {
        background: rgba(99, 102, 241, .07);
        color: var(--text-color);
    }

    .single-grade-classwork {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 16px;
        margin: 18px 22px 0;
        padding: 12px 14px;
        border: 1px solid var(--border-color);
        border-radius: 11px;
    }

    .single-grade-classwork span {
        color: var(--text-secondary);
        font-size: 11px;
    }

    .single-grade-classwork strong {
        max-width: 70%;
        overflow: hidden;
        color: var(--text-color);
        font-size: 12px;
        text-overflow: ellipsis;
        white-space: nowrap;
    }

    #singleGradeForm {
        padding: 20px 22px 22px;
    }

    .single-grade-field {
        margin-bottom: 18px;
    }

    .single-grade-field label {
        display: block;
        margin-bottom: 7px;
        color: var(--text-color);
        font-size: 12px;
        font-weight: 700;
    }

    .single-grade-field label span {
        color: var(--text-secondary);
        font-weight: 500;
    }

    .single-grade-score-wrap {
        display: flex;
        align-items: center;
        gap: 9px;
    }

    .single-grade-score-wrap input,
    .single-grade-field textarea {
        width: 100%;
        box-sizing: border-box;
        border: 1px solid var(--border-color);
        border-radius: 10px;
        background: var(--background-color, var(--card-color));
        color: var(--text-color);
        outline: none;
        transition: border-color .18s ease, box-shadow .18s ease;
    }

    .single-grade-score-wrap input {
        height: 44px;
        padding: 0 13px;
        font-size: 14px;
        font-weight: 650;
    }

    .single-grade-field textarea {
        min-height: 100px;
        padding: 11px 13px;
        resize: vertical;
        font: inherit;
        font-size: 12px;
    }

    .single-grade-score-wrap input:focus,
    .single-grade-field textarea:focus {
        border-color: #6366f1;
        box-shadow: 0 0 0 3px rgba(99, 102, 241, .10);
    }

    .single-grade-score-wrap>span {
        flex: 0 0 auto;
        color: var(--text-secondary);
        font-size: 13px;
    }

    .single-grade-score-wrap>span strong {
        color: var(--text-color);
    }

    .single-grade-actions {
        display: flex;
        justify-content: flex-end;
        gap: 9px;
        padding-top: 3px;
    }

    .single-grade-cancel,
    .single-grade-save {
        min-height: 40px;
        padding: 0 15px;
        border-radius: 9px;
        font-size: 12px;
        font-weight: 700;
        cursor: pointer;
    }

    .single-grade-cancel {
        border: 1px solid var(--border-color);
        background: transparent;
        color: var(--text-secondary);
    }

    .single-grade-save {
        display: inline-flex;
        align-items: center;
        gap: 7px;
        border: 0;
        background: #6366f1;
        color: #fff;
    }

    .mark-edit-trigger {
        width: 100%;
        min-height: 54px;
        padding: 4px 6px;
        border: 0;
        border-radius: 9px;
        background: transparent;
        color: inherit;
        cursor: pointer;
        transition: background .18s ease;
    }

    .mark-edit-trigger:hover {
        background: rgba(99, 102, 241, .055);
    }

    .mark-edit-trigger:focus-visible {
        outline: 2px solid rgba(99, 102, 241, .45);
        outline-offset: 1px;
    }

    @keyframes singleGradeSlideIn {
        from {
            opacity: 0;
            transform: translateY(8px) scale(.985);
        }

        to {
            opacity: 1;
            transform: translateY(0) scale(1);
        }
    }

    .grade-all-modal {
        position: fixed;
        inset: 0;
        z-index: 9999;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 20px;
        box-sizing: border-box;
    }

    .grade-all-modal[hidden] {
        display: none;
    }

    .grade-all-overlay {
        position: absolute;
        inset: 0;
        background: rgba(15, 23, 42, .48);
        backdrop-filter: blur(5px);
    }

    .grade-all-dialog {
        position: relative;
        z-index: 1;
        width: min(560px, 100%);
        max-height: calc(100vh - 40px);
        overflow: hidden;
        border: 1px solid var(--border-color);
        border-radius: 20px;
        background: var(--card-color);
        box-shadow: 0 28px 80px rgba(15, 23, 42, .24);
        animation: gradeAllModalIn .2s ease;
    }

    @keyframes gradeAllModalIn {
        from {
            opacity: 0;
            transform: translateY(10px) scale(.98);
        }

        to {
            opacity: 1;
            transform: translateY(0) scale(1);
        }
    }

    .grade-all-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 16px;
        padding: 20px 22px;
        border-bottom: 1px solid var(--border-color);
    }

    .grade-all-header-left {
        display: flex;
        align-items: center;
        gap: 13px;
        min-width: 0;
    }

    .grade-all-icon {
        width: 46px;
        height: 46px;
        flex: 0 0 46px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 13px;
        background: #eefbf2;
        color: #15803d;
        font-size: 22px;
    }

    .grade-all-kicker {
        display: block;
        margin-bottom: 3px;
        color: var(--primary-color);
        font-size: 10px;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: .08em;
    }

    .grade-all-header h2 {
        margin: 0;
        color: var(--text-color);
        font-size: 21px;
        font-weight: 750;
        line-height: 1.2;
    }

    .grade-all-header p {
        margin: 4px 0 0;
        color: var(--text-secondary);
        font-size: 12px;
    }

    .grade-all-close {
        width: 36px;
        height: 36px;
        flex: 0 0 36px;
        display: flex;
        align-items: center;
        justify-content: center;
        border: 0;
        border-radius: 10px;
        background: transparent;
        color: var(--text-secondary);
        cursor: pointer;
        font-size: 21px;
    }

    .grade-all-close:hover {
        background: #f1f5f9;
        color: var(--text-color);
    }

    .grade-all-info {
        display: grid;
        grid-template-columns: 1.5fr 1fr 1fr;
        gap: 0;
        margin: 16px 22px 0;
        overflow: hidden;
        border: 1px solid var(--border-color);
        border-radius: 13px;
        background: var(--card-color);
    }

    .grade-all-info-item {
        min-width: 0;
        padding: 13px 14px;
        border-right: 1px solid var(--border-color);
    }

    .grade-all-info-item:last-child {
        border-right: 0;
    }

    .grade-all-info-item span {
        display: block;
        margin-bottom: 5px;
        color: var(--text-secondary);
        font-size: 10px;
        font-weight: 650;
    }

    .grade-all-info-item strong {
        display: block;
        overflow: hidden;
        color: var(--text-color);
        font-size: 13px;
        font-weight: 750;
        text-overflow: ellipsis;
        white-space: nowrap;
    }

    #gradeAllForm {
        display: flex;
        flex-direction: column;
    }

    .grade-all-content {
        padding: 25px 22px 20px;
    }

    .grade-all-main-icon {
        width: 54px;
        height: 54px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 13px;
        border-radius: 15px;
        background: #f1f5f9;
        color: var(--primary-color);
        font-size: 26px;
    }

    .grade-all-content h3 {
        margin: 0 0 6px;
        color: var(--text-color);
        text-align: center;
        font-size: 17px;
        font-weight: 750;
    }

    .grade-all-content > p {
        max-width: 410px;
        margin: 0 auto 22px;
        color: var(--text-secondary);
        text-align: center;
        font-size: 12px;
        line-height: 1.6;
    }

    .grade-all-single-score {
        max-width: 330px;
        margin: 0 auto;
    }

    .grade-all-single-score label {
        display: block;
        margin-bottom: 8px;
        color: var(--text-color);
        text-align: left;
        font-size: 12px;
        font-weight: 700;
    }

    .grade-all-score-input-wrap {
        display: flex;
        align-items: center;
        gap: 10px;
        width: 100%;
    }

    .grade-all-score-input {
        width: 100%;
        height: 54px;
        padding: 0 16px;
        box-sizing: border-box;

        border: 1.5px solid var(--border-color);
        border-radius: 12px;

        background: var(--card-color);
        color: var(--text-color);

        outline: none;

        text-align: left;
        font-family: inherit;
        font-size: 20px;
        font-weight: 700;

        transition:
            border-color .18s ease,
            box-shadow .18s ease,
            background .18s ease;
    }

    .grade-all-score-input::placeholder {
        color: var(--text-secondary);
        opacity: .6;
        font-weight: 500;
    }

    .grade-all-score-input:hover {
        border-color: rgba(99, 102, 241, .45);
    }

    .grade-all-score-input:focus {
        border-color: var(--primary-color);
        box-shadow: 0 0 0 4px rgba(99, 102, 241, .10);
    }

    .grade-all-score-input::-webkit-inner-spin-button,
    .grade-all-score-input::-webkit-outer-spin-button {
        opacity: 1;
    }

    .grade-all-score-input-wrap > span {
        flex: 0 0 auto;
        display: inline-flex;
        align-items: center;
        gap: 4px;
        color: var(--text-secondary);
        font-size: 14px;
        font-weight: 600;
        white-space: nowrap;
    }

    .grade-all-score-input-wrap > span strong {
        color: var(--text-color);
        font-size: 15px;
        font-weight: 750;
    }

    .grade-all-notice {
        max-width: 430px;
        display: flex;
        align-items: center;
        gap: 8px;
        margin: 18px auto 0;
        padding: 10px 12px;
        border: 1px solid var(--border-color);
        border-radius: 10px;
        background: var(--card-color);
        color: var(--text-secondary);
        font-size: 11px;
        line-height: 1.5;
    }

    .grade-all-notice i {
        flex-shrink: 0;
        color: var(--primary-color);
        font-size: 16px;
    }

    .grade-all-footer {
        display: flex;
        justify-content: flex-end;
        gap: 9px;
        padding: 15px 22px 20px;
        border-top: 1px solid var(--border-color);
    }

    .grade-all-cancel,
    .grade-all-save {
        min-height: 40px;
        padding: 0 15px;
        border-radius: 9px;
        font-size: 12px;
        font-weight: 700;
        cursor: pointer;
    }

    .grade-all-cancel {
        border: 1px solid var(--border-color);
        background: transparent;
        color: var(--text-secondary);
    }

    .grade-all-cancel:hover {
        background: #f8fafc;
        color: var(--text-color);
    }

    .grade-all-save {
        display: inline-flex;
        align-items: center;
        gap: 7px;
        border: 0;
        background: var(--primary-color);
        color: #fff;
        transition: opacity .18s ease, transform .18s ease;
    }

    .grade-all-save:hover:not(:disabled) {
        opacity: .92;
        transform: translateY(-1px);
    }

    .grade-all-save:disabled {
        opacity: .45;
        cursor: not-allowed;
    }

    body.grade-all-modal-open {
        overflow: hidden;
    }

    @media (max-width: 800px) {

        .professor-marks-page {
            padding: 24px 18px 40px;
        }

        .marks-header {
            align-items: flex-start;
        }

        .marks-header-icon {
            width: 54px;
            height: 54px;

            font-size: 25px;
        }

        .marks-header-left h1 {
            font-size: 29px;
        }

        .marks-header-left p {
            font-size: 13px;
        }

        .marks-header-count {
            padding: 10px 13px;
        }

        .marks-header-count strong {
            font-size: 19px;
        }

        .marks-header-count span {
            font-size: 11px;
        }

        .marks-search {
            width: 100%;
        }

        .student-column,
        .student-name-cell {
            width: 190px;
            min-width: 190px;
        }

        .classwork-column,
        .marks-cell {
            width: 165px;
            min-width: 165px;
        }

    }


    @media (max-width: 600px) {

        .marks-header {
            flex-direction: column;
        }

        .marks-header-count {
            align-self: flex-start;
        }

        .marks-section-heading {
            align-items: flex-start;
            flex-direction: column;
            gap: 10px;
        }

        .marks-section-heading-right {
            width: 100%;
            justify-content: space-between;
            gap: 15px;
        }

        .marks-legend {
            justify-content: flex-start;
            flex-wrap: nowrap;
            overflow-x: auto;
            min-width: 0;
        }

    }


    /* ============================================================
   REDUCED MOTION
============================================================ */

    @media (prefers-reduced-motion: reduce) {

        .classwork-dropdown,
        .classwork-menu-button,
        .classwork-action {
            transition: none;
        }

    }
</style>


@extends('layouts.prof_layout')

@section('title', 'Marks')

@section('content')

@php
$totalStudents = $students->count();

$totalAssignments = $assignments->count();
$totalQuizzes = $quizzes->count();
$totalExams = $exams->count();
$totalProjects = $projects->count();

$totalClassworks =
$totalAssignments +
$totalQuizzes +
$totalExams +
$totalProjects;

$formatNumber = function ($number) {
return rtrim(
rtrim(number_format((float) $number, 2), '0'),
'.'
);
};
@endphp


<div class="professor-marks-page">

    {{-- ============================================================
         CLASSROOM NAVIGATION
    ============================================================= --}}
    @include('professor.class_groups.classroom_group.navigation')

    {{-- ============================================================
       HEADER
    ============================================================ --}}

    <div class="marks-header">

        <div class="marks-header-left">

            <div class="marks-header-icon">
                <i class="bx bx-bar-chart-alt-2"></i>
            </div>

            <div class="marks-header-content">

                <span class="marks-kicker">
                    Gradebook
                </span>

                <h1>Marks</h1>

                <p>
                    {{ $classGroup->group_name ?? 'Classroom' }}
                </p>

            </div>

        </div>


        <div class="marks-header-count">

            <strong>
                {{ $totalStudents }}
            </strong>

            <span>
                {{ $totalStudents === 1 ? 'Student' : 'Students' }}
            </span>

        </div>

    </div>


    {{-- ============================================================
       SEARCH
    ============================================================ --}}

    <div class="marks-toolbar">

        <div class="marks-search">

            <i class="bx bx-search"></i>

            <input
                type="text"
                id="marksStudentSearch"
                placeholder="Search student..."
                autocomplete="off">

            <button
                type="button"
                id="clearMarksSearch"
                hidden
                aria-label="Clear search">
                <i class="bx bx-x"></i>
            </button>

        </div>

    </div>


    {{-- ============================================================
       GRADEBOOK
    ============================================================ --}}

    @if($totalStudents > 0 && $totalClassworks > 0)

    <section class="marks-gradebook-section">


        {{-- ====================================================
               SECTION HEADER
            ==================================================== --}}

        <div class="marks-section-heading">

            <div>

                <span class="marks-kicker">
                    Gradebook
                </span>

                <h2>
                    Student marks
                </h2>

            </div>

            <div class="marks-section-heading-right">

                <span class="marks-classwork-count">
                    {{ $totalClassworks }}
                    {{ $totalClassworks === 1
                            ? 'classwork'
                            : 'classworks'
                        }}
                </span>

                <div class="marks-legend">

                    <span>
                        <i class="legend-dot graded"></i>
                        Graded
                    </span>

                    <span>
                        <i class="legend-dot pending"></i>
                        Not Graded
                    </span>

                    <span>
                        <i class="legend-dot missing"></i>
                        Missing
                    </span>

                </div>

            </div>

        </div>


        {{-- ====================================================
               GRADEBOOK TABLE
            ==================================================== --}}

        <div class="gradebook-wrapper">

            <div class="gradebook-scroll">

                <table class="marks-table">

                    <thead>

                        <tr>

                            {{-- STUDENT --}}

                            <th class="student-column">

                                <span>
                                    Student
                                </span>

                            </th>


                            {{-- =================================================
                                   ASSIGNMENTS
                                ================================================= --}}

                            @foreach($assignments as $assignment)

                            <th class="classwork-column assignment">

                                <div class="classwork-header">

                                    <div class="classwork-icon assignment">
                                        <i class="bx bx-task"></i>
                                    </div>


                                    <div class="classwork-header-text">

                                        <span class="classwork-type assignment">
                                            Assignment
                                        </span>

                                        <strong
                                            title="{{ $assignment->title }}">
                                            {{ $assignment->title }}
                                        </strong>

                                    </div>
                                    {{-- THREE DOT MENU --}}
                                    <div class="classwork-menu">

                                        <button
                                            type="button"
                                            class="classwork-menu-button"
                                            aria-label="Assignment actions"
                                            aria-expanded="false">
                                            <i class="bx bx-dots-vertical-rounded"></i>
                                        </button>

                                        <div class="classwork-dropdown">

                                            {{-- EDIT --}}
                                            <a
                                                href="{{ route(
                'professor.class-groups.assignments.edit',
                [
                    'classGroup' => $classGroup->id,
                    'assignment' => $assignment->id,
                    'return_to' => 'marks',
                ]
            ) }}"
                                                class="classwork-action">
                                                <i class="bx bx-edit"></i>
                                                <span>Edit</span>
                                            </a>

                                            {{-- GRADE ALL --}}
                                            <button
                                                type="button"
                                                class="classwork-action"
                                                data-grade-all
                                                data-grade-type="assignment"
                                                data-grade-title="{{ $assignment->title }}"
                                                data-grade-points="{{ $assignment->points }}"
                                                data-grade-url="{{ route(
        'professor.class-groups.assignments.grade-all',
        [
            'classGroup' => $classGroup->id,
            'assignment' => $assignment->id,
        ]
    ) }}"
                                                data-submissions-id="assignment-submissions-{{ $assignment->id }}">
                                                <i class="bx bx-check-double"></i>
                                                <span>Grade All</span>
                                            </button>

                                            {{-- GRADE AS COMPLETE --}}
                                            <form
                                                method="POST"
                                                action="{{ route(
                'professor.class-groups.assignments.grade-complete',
                [
                    'classGroup' => $classGroup->id,
                    'assignment' => $assignment->id,
                ]
            ) }}"
                                                onsubmit="return confirm(
                'Give full marks to all students who submitted this assignment?'
            );">
                                                @csrf

                                                <button
                                                    type="submit"
                                                    class="classwork-action">
                                                    <i class="bx bx-check-circle"></i>
                                                    <span>Grade as Complete</span>
                                                </button>
                                            </form>

                                            <div class="classwork-menu-divider"></div>

                                            {{-- DELETE --}}
                                            <form
                                                method="POST"
                                                action="{{ route(
                'professor.class-groups.assignments.destroy',
                [
                    'classGroup' => $classGroup->id,
                    'assignment' => $assignment->id,
                ]
            ) }}"
                                                onsubmit="return confirm(
                'Are you sure you want to delete this assignment?'
            );">
                                                @csrf
                                                @method('DELETE')

                                                <button
                                                    type="submit"
                                                    class="classwork-action danger">
                                                    <i class="bx bx-trash"></i>
                                                    <span>Delete</span>
                                                </button>
                                            </form>

                                        </div>

                                    </div>

                                </div>

                            </th>

                            @endforeach


                            {{-- =================================================
                                   QUIZZES
                                ================================================= --}}

                            @foreach($quizzes as $quiz)

                            <th class="classwork-column quiz">

                                <div class="classwork-header">

                                    <div class="classwork-icon quiz">
                                        <i class="bx bx-help-circle"></i>
                                    </div>


                                    <div class="classwork-header-text">

                                        <span class="classwork-type quiz">
                                            Quiz
                                        </span>

                                        <strong
                                            title="{{ $quiz->title }}">
                                            {{ $quiz->title }}
                                        </strong>

                                    </div>


                                    {{-- THREE DOT MENU --}}
                                    <div class="classwork-menu">
                                        <button
                                            type="button"
                                            class="classwork-menu-button"
                                            aria-label="Quiz actions"
                                            aria-expanded="false">
                                            <i class="bx bx-dots-vertical-rounded"></i>
                                        </button>

                                        <div class="classwork-dropdown">

                                            {{-- EDIT --}}
                                            <a
                                                href="{{ route(
                                                        'professor.class-groups.quizzes.edit',
                                                        [
                                                            'classGroup' => $classGroup->id,
                                                            'quiz' => $quiz->id,
                                                            'return_to' => 'marks'
                                                        ]
                                                    ) }}"
                                                class="classwork-action">
                                                <i class="bx bx-edit"></i>
                                                <span>Edit</span>
                                            </a>


                                            {{-- GRADE ALL --}}
                                            <button
                                                type="button"
                                                class="classwork-action"
                                                data-grade-all
                                                data-grade-type="quiz"
                                                data-grade-title="{{ $quiz->title }}"
                                                data-grade-points="{{ $quiz->points }}"
                                                data-grade-url="{{ route(
                                                        'professor.class-groups.quizzes.grade-all',
                                                        [
                                                            'classGroup' => $classGroup->id,
                                                            'quiz' => $quiz->id,
                                                        ]
                                                    ) }}"
                                                data-submissions-id="quiz-submissions-{{ $quiz->id }}">
                                                <i class="bx bx-check-double"></i>
                                                <span>Grade All</span>
                                            </button>


                                            {{-- GRADE AS COMPLETE --}}
                                            <form
                                                method="POST"
                                                action="{{ route(
                                                        'professor.class-groups.quizzes.grade-complete',
                                                        [
                                                            'classGroup' => $classGroup->id,
                                                            'quiz' => $quiz->id,
                                                        ]
                                                    ) }}"
                                                onsubmit="return confirm(
                                                        'Give full marks to all students who submitted this quiz?'
                                                    );">
                                                @csrf

                                                <button
                                                    type="submit"
                                                    class="classwork-action">
                                                    <i class="bx bx-check-circle"></i>
                                                    <span>Grade as Complete</span>
                                                </button>
                                            </form>


                                            <div class="classwork-menu-divider"></div>


                                            {{-- DELETE --}}
                                            <form
                                                method="POST"
                                                action="{{ route(
                                                        'professor.class-groups.quizzes.destroy',
                                                        [
                                                            'classGroup' => $classGroup->id,
                                                            'quiz' => $quiz->id,
                                                        ]
                                                    ) }}"
                                                onsubmit="return confirm(
                                                        'Are you sure you want to delete this quiz?'
                                                    );">
                                                @csrf
                                                @method('DELETE')

                                                <button
                                                    type="submit"
                                                    class="classwork-action danger">
                                                    <i class="bx bx-trash"></i>
                                                    <span>Delete</span>
                                                </button>
                                            </form>

                                        </div>

                                    </div>

                            </th>

                            @endforeach


                            {{-- =================================================
                                   EXAMS
                                ================================================= --}}

                            @foreach($exams as $exam)

                            <th class="classwork-column exam">

                                <div class="classwork-header">

                                    <div class="classwork-icon exam">
                                        <i class="bx bx-edit"></i>
                                    </div>


                                    <div class="classwork-header-text">

                                        <span class="classwork-type exam">
                                            Exam
                                        </span>

                                        <strong
                                            title="{{ $exam->title }}">
                                            {{ $exam->title }}
                                        </strong>

                                    </div>


                                    {{-- THREE DOT MENU --}}
                                    <div class="classwork-menu">
                                        <button
                                            type="button"
                                            class="classwork-menu-button"
                                            aria-label="Exam actions"
                                            aria-expanded="false">
                                            <i class="bx bx-dots-vertical-rounded"></i>
                                        </button>

                                        <div class="classwork-dropdown">

                                            {{-- EDIT --}}
                                            <a
                                                href="{{ route(
                                                            'professor.class-groups.exams.edit',
                                                            [
                                                                'classGroup' => $classGroup->id,
                                                                'exam' => $exam->id,
                                                                'return_to' => 'marks'
                                                            ]
                                                        ) }}"
                                                class="classwork-action">
                                                <i class="bx bx-edit"></i>
                                                <span>Edit</span>
                                            </a>


                                            {{-- GRADE ALL --}}
                                            <button
                                                type="button"
                                                class="classwork-action"
                                                data-grade-all
                                                data-grade-type="exam"
                                                data-grade-title="{{ $exam->title }}"
                                                data-grade-points="{{ $exam->points }}"
                                                data-grade-url="{{ route(
                                                            'professor.class-groups.exams.grade-all',
                                                            [
                                                                'classGroup' => $classGroup->id,
                                                                'exam' => $exam->id,
                                                            ]
                                                        ) }}"
                                                data-submissions-id="exam-submissions-{{ $exam->id }}">
                                                <i class="bx bx-check-double"></i>
                                                <span>Grade All</span>
                                            </button>


                                            {{-- GRADE AS COMPLETE --}}
                                            <form
                                                method="POST"
                                                action="{{ route(
                                                            'professor.class-groups.exams.grade-complete',
                                                            [
                                                                'classGroup' => $classGroup->id,
                                                                'exam' => $exam->id,
                                                            ]
                                                        ) }}"
                                                onsubmit="return confirm(
                                                            'Give full marks to all students who submitted this exam?'
                                                        );">
                                                @csrf

                                                <button
                                                    type="submit"
                                                    class="classwork-action">
                                                    <i class="bx bx-check-circle"></i>
                                                    <span>Grade as Complete</span>
                                                </button>
                                            </form>


                                            <div class="classwork-menu-divider"></div>


                                            {{-- DELETE --}}
                                            <form
                                                method="POST"
                                                action="{{ route(
                                                            'professor.class-groups.exams.destroy',
                                                            [
                                                                'classGroup' => $classGroup->id,
                                                                'exam' => $exam->id,
                                                            ]
                                                        ) }}"
                                                onsubmit="return confirm(
                                                            'Are you sure you want to delete this exam?'
                                                        );">
                                                @csrf
                                                @method('DELETE')

                                                <button
                                                    type="submit"
                                                    class="classwork-action danger">
                                                    <i class="bx bx-trash"></i>
                                                    <span>Delete</span>
                                                </button>
                                            </form>

                                        </div>

                                    </div>

                            </th>

                            @endforeach

                            {{-- =================================================
                                   PROJECTS
                                ================================================= --}}

                            @foreach($projects as $project)

                            <th class="classwork-column project">

                                <div class="classwork-header">

                                    <div class="classwork-icon project">
                                        <i class="bx bx-folder-open"></i>
                                    </div>

                                    <div class="classwork-header-text">

                                        <span class="classwork-type project">
                                            Project
                                        </span>

                                        <strong
                                            title="{{ $project->title }}">
                                            {{ $project->title }}
                                        </strong>

                                    </div>

                                    {{-- THREE DOT MENU --}}
                                    <div class="classwork-menu">

                                        <button
                                            type="button"
                                            class="classwork-menu-button"
                                            aria-label="Project actions"
                                            aria-expanded="false">
                                            <i class="bx bx-dots-vertical-rounded"></i>
                                        </button>

                                        <div class="classwork-dropdown">

                                            {{-- EDIT --}}
                                            <a
                                                href="{{ route(
                                                    'professor.classworks.projects.edit',
                                                    [
                                                        'classGroupId' => $classGroup->id,
                                                        'projectId' => $project->id,
                                                        'return_to' => 'marks'
                                                    ]
                                                ) }}"
                                                class="classwork-action">
                                                <i class="bx bx-edit"></i>
                                                <span>Edit</span>
                                            </a>

                                            @if($project->project_type === 'team')

                                            {{-- GRADE ALL TEAMS --}}
                                            <button
                                                type="button"
                                                class="classwork-action"
                                                data-grade-all
                                                data-grade-type="project"
                                                data-grade-title="{{ $project->title }}"
                                                data-grade-points="{{ $project->points }}"
                                                data-grade-url="{{ route(
                                                    'professor.classworks.projects.submissions.grade-all-teams',
                                                    [
                                                        'classGroup' => $classGroup->id,
                                                        'project' => $project->id
                                                    ]
                                                ) }}"
                                                data-submissions-id="project-submissions-{{ $project->id }}">
                                                <i class="bx bx-check-double"></i>
                                                <span>Grade All Teams</span>
                                            </button>

                                            {{-- GRADE AS COMPLETE --}}
                                            <form
                                                method="POST"
                                                action="{{ route(
                                                    'professor.classworks.projects.submissions.grade-as-complete',
                                                    [
                                                        'classGroupId' => $classGroup->id,
                                                        'projectId' => $project->id
                                                    ]
                                                ) }}"
                                                onsubmit="return confirm(
                                                    'Give full marks to all submitted teams for this project?'
                                                );">
                                                @csrf

                                                <button
                                                    type="submit"
                                                    class="classwork-action">
                                                    <i class="bx bx-check-circle"></i>
                                                    <span>Grade as Complete</span>
                                                </button>
                                            </form>

                                            @endif

                                            <div class="classwork-menu-divider"></div>

                                            {{-- DELETE --}}
                                            <form
                                                method="POST"
                                                action="{{ route(
                                                    'professor.classworks.projects.destroy',
                                                    [
                                                        'classGroupId' => $classGroup->id,
                                                        'projectId' => $project->id
                                                    ]
                                                ) }}"
                                                onsubmit="return confirm(
                                                    'Are you sure you want to delete this project?'
                                                );">
                                                @csrf
                                                @method('DELETE')

                                                <button
                                                    type="submit"
                                                    class="classwork-action danger">
                                                    <i class="bx bx-trash"></i>
                                                    <span>Delete</span>
                                                </button>
                                            </form>

                                        </div>

                                    </div>

                                </div>

                            </th>

                            @endforeach


                        </tr>

                    </thead>


                    {{-- ========================================================
                           STUDENT ROWS
                        ========================================================= --}}

                    <tbody>

                        @foreach($students as $student)

                        <tr
                            class="student-row"
                            data-student-name="{{ strtolower($student->name ?? '') }}">

                            {{-- STUDENT NAME --}}

                            <td class="student-name-cell">

                                <div class="student-info">

                                    <div class="student-avatar">

                                        @if($student->profile_image)

                                        <img
                                            src="{{ asset('storage/' . $student->profile_image) }}"
                                            alt="{{ $student->name }}">

                                        @else

                                        <i class="bx bx-user"></i>

                                        @endif

                                    </div>


                                    <strong>
                                        {{ $student->name ?? 'Unknown Student' }}
                                    </strong>

                                </div>

                            </td>


                            {{-- =================================================
                                       ASSIGNMENTS
                                    ================================================= --}}

                            @foreach($assignments as $assignment)

                            @php

                            $submission =
                            $assignment->submissions
                            ->firstWhere(
                            'student_id',
                            $student->id
                            );

                            $graded =
                            $submission &&
                            $submission->score !== null;

                            $submitted =
                            $submission &&
                            $submission->submitted_at !== null;

                            $points =
                            (float) ($assignment->points ?? 0);

                            @endphp


                            <td class="marks-cell assignment">

                                @if($submission && $submitted)

                                <button
                                    type="button"
                                    class="mark-edit-trigger"
                                    data-edit-grade
                                    data-grade-type="assignment"
                                    data-grade-title="{{ $assignment->title }}"
                                    data-grade-student="{{ $student->name }}"
                                    data-grade-points="{{ $points }}"
                                    data-grade-score="{{ $submission->score }}"
                                    data-grade-feedback="{{ $submission->feedback ?? '' }}"
                                    data-grade-url="{{ route(
                                                        'professor.class-groups.assignments.submissions.grade',
                                                        [
                                                            'classGroup' => $classGroup->id,
                                                            'assignment' => $assignment->id,
                                                            'submission' => $submission->id,
                                                        ]
                                                    ) }}">
                                    @if($graded)
                                    <div class="mark-score-display">
                                        <div class="mark-score-main">
                                            <strong class="mark-score">
                                                {{ $formatNumber($submission->score) }}
                                            </strong>
                                            <span class="mark-score-divider">/</span>
                                            <span class="mark-score-max">
                                                {{ $formatNumber($points) }}
                                            </span>
                                            <i class="bx bx-edit-alt mark-edit-icon" aria-hidden="true"></i>
                                        </div>

                                    @if($points > 0)
                                    <span class="mark-percentage">
                                        {{ rtrim(rtrim(number_format(((float) $submission->score / $points) * 100, 1), '0'), '.') }}%
                                    </span>
                                    @endif
                                        </div>
                                    @else
                                    <span class="cell-status pending">
                                        Not Graded
                                    </span>
                                    @endif
                                </button>

                                @else

                                <span class="cell-status missing">
                                    Missing
                                </span>

                                @endif

                            </td>

                            @endforeach


                            {{-- =================================================
                                       QUIZZES
                                    ================================================= --}}

                            @foreach($quizzes as $quiz)

                            @php

                            $submission =
                            $quiz->submissions
                            ->firstWhere(
                            'student_id',
                            $student->id
                            );

                            $graded =
                            $submission &&
                            $submission->score !== null;

                            $submitted =
                            $submission &&
                            $submission->submitted_at !== null;

                            $points =
                            (float) ($quiz->points ?? 0);

                            @endphp


                            <td class="marks-cell quiz">

                                @if($submission && $submitted)

                                <button
                                    type="button"
                                    class="mark-edit-trigger"
                                    data-edit-grade
                                    data-grade-type="quiz"
                                    data-grade-title="{{ $quiz->title }}"
                                    data-grade-student="{{ $student->name }}"
                                    data-grade-points="{{ $points }}"
                                    data-grade-score="{{ $submission->score }}"
                                    data-grade-feedback="{{ $submission->feedback ?? '' }}"
                                    data-grade-url="{{ route(
                                                        'professor.class-groups.quizzes.submissions.grade',
                                                        [
                                                            'classGroup' => $classGroup->id,
                                                            'quiz' => $quiz->id,
                                                            'submission' => $submission->id,
                                                        ]
                                                    ) }}">
                                    @if($graded)
                                    <div class="mark-score-display">
                                        <div class="mark-score-main">
                                            <strong class="mark-score">
                                                {{ $formatNumber($submission->score) }}
                                            </strong>
                                            <span class="mark-score-divider">/</span>
                                            <span class="mark-score-max">
                                                {{ $formatNumber($points) }}
                                            </span>
                                            <i class="bx bx-edit-alt mark-edit-icon" aria-hidden="true"></i>
                                        </div>

                                    @if($points > 0)
                                    <span class="mark-percentage">
                                        {{ rtrim(rtrim(number_format(((float) $submission->score / $points) * 100, 1), '0'), '.') }}%
                                    </span>
                                    @endif
                                        </div>
                                    @else
                                    <span class="cell-status pending">
                                        Not Graded
                                    </span>
                                    @endif
                                </button>

                                @else

                                <span class="cell-status missing">
                                    Missing
                                </span>

                                @endif

                            </td>

                            @endforeach


                            {{-- =================================================
                                       EXAMS
                                    ================================================= --}}

                            @foreach($exams as $exam)

                            @php

                            $submission =
                            $exam->submissions
                            ->firstWhere(
                            'student_id',
                            $student->id
                            );

                            $graded =
                            $submission &&
                            $submission->score !== null;

                            $submitted =
                            $submission &&
                            $submission->submitted_at !== null;

                            $points =
                            (float) ($exam->points ?? 0);

                            @endphp


                            <td class="marks-cell exam">

                                @if($submission && $submitted)

                                <button
                                    type="button"
                                    class="mark-edit-trigger"
                                    data-edit-grade
                                    data-grade-type="exam"
                                    data-grade-title="{{ $exam->title }}"
                                    data-grade-student="{{ $student->name }}"
                                    data-grade-points="{{ $points }}"
                                    data-grade-score="{{ $submission->score }}"
                                    data-grade-feedback="{{ $submission->feedback ?? '' }}"
                                    data-grade-url="{{ route(
                                                        'professor.class-groups.exams.submissions.grade',
                                                        [
                                                            'classGroup' => $classGroup->id,
                                                            'exam' => $exam->id,
                                                            'submission' => $submission->id,
                                                        ]
                                                    ) }}">
                                    @if($graded)
                                    <div class="mark-score-display">
                                        <div class="mark-score-main">
                                            <strong class="mark-score">
                                                {{ $formatNumber($submission->score) }}
                                            </strong>
                                            <span class="mark-score-divider">/</span>
                                            <span class="mark-score-max">
                                                {{ $formatNumber($points) }}
                                            </span>
                                            <i class="bx bx-edit-alt mark-edit-icon" aria-hidden="true"></i>
                                        </div>

                                    @if($points > 0)
                                    <span class="mark-percentage">
                                        {{ rtrim(rtrim(number_format(((float) $submission->score / $points) * 100, 1), '0'), '.') }}%
                                    </span>
                                    @endif
                                        </div>
                                    @else
                                    <span class="cell-status pending">
                                        Not Graded
                                    </span>
                                    @endif
                                </button>

                                @else

                                <span class="cell-status missing">
                                    Missing
                                </span>

                                @endif

                            </td>

                            @endforeach

                            {{-- =================================================
                                       PROJECTS
                                    ================================================= --}}

                            @foreach($projects as $project)

                            @php
                            $submission =
                                $project->submissions
                                    ->whereNotNull('submitted_at')
                                    ->filter(function ($item) use ($student, $project) {
                                        if ($project->project_type === 'team') {
                                            return $item->project_group_id &&
                                                $item->projectGroup &&
                                                $item->projectGroup->members
                                                    ->contains('user_id', $student->id);
                                        }

                                        return (int) $item->student_id === (int) $student->id;
                                    })
                                    ->sortByDesc('submitted_at')
                                    ->first();

                            $points =
                                (float) ($project->points ?? 0);

                            // For team projects, find the team this student belongs to
                            // even when the student has not submitted yet.
                            $studentProjectGroup = null;

                            if ($project->project_type === 'team') {
                                $studentProjectGroup = $project->groups()
                                    ->whereHas('members', function ($query) use ($student) {
                                        $query->where('user_id', $student->id);
                                    })
                                    ->first();
                            }

                            $teamName = null;

                            if ($studentProjectGroup) {
                                $teamName = $studentProjectGroup->group_name
                                    ?? $studentProjectGroup->name
                                    ?? ('Team ' . $studentProjectGroup->id);
                            }

                            $grade = null;

                            if ($submission) {
                                if ($project->project_type === 'team') {
                                    $grade = $submission->grades
                                        ->firstWhere('student_id', $student->id);
                                } else {
                                    $grade = $submission;
                                }
                            }

                            $score =
                                $grade && $grade->score !== null
                                    ? (float) $grade->score
                                    : null;

                            $graded = $submission && $score !== null;

                            @endphp

                            <td class="marks-cell project">

                                @if($submission)

                                    <button
                                        type="button"
                                        class="mark-edit-trigger"
                                        data-edit-grade
                                        data-grade-type="project"
                                        data-grade-title="{{ $project->title }}"
                                        data-grade-student="{{ $student->name }}"
                                        data-grade-points="{{ $points }}"
                                        data-grade-score="{{ $score ?? '' }}"
                                        data-grade-feedback="{{ $grade->feedback ?? $submission->feedback ?? '' }}"
                                        data-grade-url="{{ route(
                                            'professor.classworks.projects.submissions.grade',
                                            [
                                                'classGroupId' => $classGroup->id,
                                                'projectId' => $project->id,
                                                'submissionId' => $submission->id
                                            ]
                                        ) }}">

                                        @if($graded)

                                        @if($teamName)
                                            <div class="project-team-badge">
                                                <i class="bx bx-group"></i>
                                                <span>{{ $teamName }}</span>
                                            </div>
                                        @endif

                                        <div class="mark-score-display">

                                            <div class="mark-score-main">

                                                <strong class="mark-score">
                                                    {{ $formatNumber($score) }}
                                                </strong>

                                                <span class="mark-score-divider">/</span>

                                                <span class="mark-score-max">
                                                    {{ $formatNumber($points) }}
                                                </span>

                                                <i
                                                    class="bx bx-edit-alt mark-edit-icon"
                                                    aria-hidden="true"></i>

                                            </div>

                                            @if($points > 0)
                                            <span class="mark-percentage">
                                                {{ rtrim(rtrim(number_format(($score / $points) * 100, 1), '0'), '.') }}%
                                            </span>
                                            @endif

                                        </div>

                                        @else

                                        @if($teamName)
                                            <div class="project-team-badge">
                                                <i class="bx bx-group"></i>
                                                <span>{{ $teamName }}</span>
                                            </div>
                                        @endif

                                        <span class="cell-status pending">
                                            Not Graded
                                        </span>

                                        @endif

                                    </button>

                                @else

                                    <div class="project-team-status-row">
                                        @if($teamName)
                                            <div class="project-team-badge project-team-missing">
                                                <i class="bx bx-group"></i>
                                                <span>{{ $teamName }}</span>
                                            </div>
                                        @endif

                                        <span class="cell-status missing">
                                            Missing
                                        </span>
                                    </div>

                                @endif

                            </td>

                            @endforeach


                        </tr>

                        @endforeach

                    </tbody>

                </table>

            </div>

        </div>


        {{-- SEARCH EMPTY --}}

        <div
            class="marks-search-empty"
            id="marksSearchEmpty"
            hidden>

            <i class="bx bx-search-alt"></i>

            <h3>
                No student found
            </h3>

            <p>
                Try another student name.
            </p>

        </div>

    </section>


    @elseif($totalStudents === 0)

    {{-- ========================================================
           NO STUDENTS
        ========================================================= --}}

    <div class="marks-empty-state">

        <div class="marks-empty-icon">
            <i class="bx bx-group"></i>
        </div>

        <h3>
            No students yet
        </h3>

        <p>
            Students enrolled in this classroom will appear here.
        </p>

    </div>


    @else

    {{-- ========================================================
           NO CLASSWORK
        ========================================================= --}}

    <div class="marks-empty-state">

        <div class="marks-empty-icon">
            <i class="bx bx-book-open"></i>
        </div>

        <h3>
            No classwork yet
        </h3>

        <p>
            Assignments, quizzes, exams, and projects will appear here once created.
        </p>

    </div>

    @endif

</div>


{{-- ============================================================
   GRADE ALL DATA
============================================================ --}}

{{-- ASSIGNMENTS --}}
@foreach($assignments as $assignment)
    @php
        $submittedCount = $assignment->submissions
            ->whereNotNull('submitted_at')
            ->count();
    @endphp

    <script
        type="application/json"
        id="assignment-submissions-{{ $assignment->id }}">
        @json(['count' => $submittedCount])
    </script>
@endforeach


{{-- QUIZZES --}}
@foreach($quizzes as $quiz)
    @php
        $submittedCount = $quiz->submissions
            ->whereNotNull('submitted_at')
            ->count();
    @endphp

    <script
        type="application/json"
        id="quiz-submissions-{{ $quiz->id }}">
        @json(['count' => $submittedCount])
    </script>
@endforeach


{{-- EXAMS --}}
@foreach($exams as $exam)
    @php
        $submittedCount = $exam->submissions
            ->whereNotNull('submitted_at')
            ->count();
    @endphp

    <script
        type="application/json"
        id="exam-submissions-{{ $exam->id }}">
        @json(['count' => $submittedCount])
    </script>
@endforeach


{{-- PROJECTS --}}
@foreach($projects as $project)
    @php
        $submittedCount = $project->submissions
            ->whereNotNull('submitted_at')
            ->count();
    @endphp

    <script
        type="application/json"
        id="project-submissions-{{ $project->id }}">
        @json(['count' => $submittedCount])
    </script>
@endforeach

{{-- ============================================================
   GRADE ALL MODAL
============================================================ --}}

<div
    class="grade-all-modal"
    id="gradeAllModal"
    hidden>
    <div
        class="grade-all-overlay"
        data-close-grade-all></div>

    <div
        class="grade-all-dialog"
        role="dialog"
        aria-modal="true"
        aria-labelledby="gradeAllModalTitle">

        {{-- HEADER --}}
        <div class="grade-all-header">

            <div class="grade-all-header-left">

                <div class="grade-all-icon">
                    <i class="bx bx-check-double"></i>
                </div>

                <div>
                    <span class="grade-all-kicker">
                        Bulk Grading
                    </span>

                    <h2 id="gradeAllModalTitle">
                        Grade All
                    </h2>

                    <p id="gradeAllModalDescription">
                        Give the same mark to all submitted students.
                    </p>
                </div>

            </div>

            <button
                type="button"
                class="grade-all-close"
                data-close-grade-all
                aria-label="Close">
                <i class="bx bx-x"></i>
            </button>

        </div>


        {{-- INFORMATION --}}
        <div class="grade-all-info">

            <div class="grade-all-info-item">
                <span>Classwork</span>

                <strong id="gradeAllClassworkName">
                    —
                </strong>
            </div>


            <div class="grade-all-info-item">
                <span>Maximum Marks</span>

                <strong>
                    <span id="gradeAllPoints">0</span>
                    pts
                </strong>
            </div>


            <div class="grade-all-info-item">
                <span>Submitted</span>

                <strong>
                    <span id="gradeAllStudentCount">0</span>
                    <span id="gradeAllRecipientLabel">students</span>
                </strong>
            </div>

        </div>


        {{-- FORM --}}
        <form
            method="POST"
            id="gradeAllForm">

            @csrf


            <div class="grade-all-content">

                <div class="grade-all-main-icon">
                    <i class="bx bx-check-double"></i>
                </div>

                <h3 id="gradeAllContentTitle">
                    Give the same mark to all submitted students
                </h3>

                <p id="gradeAllContentDescription">
                    This score will be applied to every student
                    who submitted this classwork.
                </p>


                {{-- SINGLE SCORE INPUT --}}
                <div class="grade-all-single-score">

                    <label for="gradeAllScore">
                        Score for all students
                    </label>

                    <div class="grade-all-score-input-wrap">

                        <input
                            type="number"
                            id="gradeAllScore"
                            name="score"
                            min="0"
                            step="0.01"
                            inputmode="decimal"
                            placeholder="0"
                            required>

                        <span>
                            /
                            <strong id="gradeAllScoreMax">
                                0
                            </strong>
                        </span>

                    </div>

                </div>


                {{-- WARNING / DESCRIPTION --}}
                <div
                    class="grade-all-notice"
                    id="gradeAllNotice">
                    <i class="bx bx-info-circle"></i>

                    <span>
                        This score will be given to all submitted students.
                    </span>
                </div>

            </div>


            {{-- FOOTER --}}
            <div class="grade-all-footer">

                <button
                    type="button"
                    class="grade-all-cancel"
                    data-close-grade-all>
                    Cancel
                </button>


                <button
                    type="submit"
                    class="grade-all-save"
                    id="gradeAllSaveButton">
                    <i class="bx bx-save"></i>

                    <span>
                        Save Grades
                    </span>
                </button>

            </div>

        </form>

    </div>
</div>

{{-- ============================================================
   INDIVIDUAL GRADE MODAL
============================================================ --}}
<div class="single-grade-modal" id="singleGradeModal" hidden>
    <div class="single-grade-overlay" data-close-single-grade></div>

    <div class="single-grade-dialog" role="dialog" aria-modal="true" aria-labelledby="singleGradeModalTitle">
        <div class="single-grade-header">
            <div class="single-grade-header-left">
                <div class="single-grade-icon"><i class="bx bx-edit"></i></div>
                <div>
                    <span class="single-grade-kicker" id="singleGradeType">Assignment</span>
                    <h2 id="singleGradeModalTitle">Edit Grade</h2>
                    <p id="singleGradeStudent">Student</p>
                </div>
            </div>
            <button type="button" class="single-grade-close" data-close-single-grade aria-label="Close">
                <i class="bx bx-x"></i>
            </button>
        </div>

        <div class="single-grade-classwork">
            <span>Classwork</span>
            <strong id="singleGradeClasswork">—</strong>
        </div>

        <form method="POST" id="singleGradeForm">
            @csrf
            <input type="hidden" name="return_to" id="singleGradeReturnTo" value="marks">
            <div class="single-grade-field">
                <label for="singleGradeScore">Score</label>
                <div class="single-grade-score-wrap">
                    <input type="number" name="score" id="singleGradeScore" min="0" step="0.01" required inputmode="decimal" placeholder="Enter score">
                    <span>/ <strong id="singleGradePoints">0</strong></span>
                </div>
            </div>

            <div class="single-grade-field">
                <label for="singleGradeFeedback">Feedback <span>(optional)</span></label>
                <textarea name="feedback" id="singleGradeFeedback" rows="4" placeholder="Write feedback for this student..."></textarea>
            </div>

            <div class="single-grade-actions">
                <button type="button" class="single-grade-cancel" data-close-single-grade>Cancel</button>
                <button type="submit" class="single-grade-save">
                    <i class="bx bx-save"></i>
                    <span id="singleGradeSaveText">Update Grade</span>
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {


        /* ============================================================
           STUDENT SEARCH
        ============================================================ */

        const searchInput =
            document.getElementById('marksStudentSearch');

        const clearButton =
            document.getElementById('clearMarksSearch');

        const rows =
            Array.from(
                document.querySelectorAll('.student-row')
            );

        const emptyState =
            document.getElementById('marksSearchEmpty');


        function applySearch() {

            const query =
                String(
                    searchInput ?
                    searchInput.value :
                    ''
                )
                .trim()
                .toLowerCase();


            let visibleRows = 0;


            rows.forEach(function(row) {

                const name =
                    String(
                        row.dataset.studentName || ''
                    ).toLowerCase();


                const show = !query ||
                    name.includes(query);


                row.hidden = !show;


                if (show) {
                    visibleRows++;
                }

            });


            if (emptyState) {

                emptyState.hidden =
                    visibleRows !== 0;

            }


            if (clearButton) {

                clearButton.hidden = !query;

            }

        }


        if (searchInput) {

            searchInput.addEventListener(
                'input',
                applySearch
            );

        }


        if (clearButton) {

            clearButton.addEventListener(
                'click',
                function() {

                    searchInput.value = '';

                    applySearch();

                    searchInput.focus();

                }
            );

        }


        /* ============================================================
           CLASSWORK THREE-DOT MENUS
        ============================================================ */

        const menus =
            Array.from(
                document.querySelectorAll('.classwork-menu')
            );


        function closeAllMenus(except = null) {

            menus.forEach(function(menu) {

                if (menu === except) {
                    return;
                }


                menu.classList.remove('open');


                const button =
                    menu.querySelector(
                        '.classwork-menu-button'
                    );


                if (button) {

                    button.setAttribute(
                        'aria-expanded',
                        'false'
                    );

                }

            });

        }


        menus.forEach(function(menu) {

            const button =
                menu.querySelector(
                    '.classwork-menu-button'
                );


            if (!button) {
                return;
            }


            button.addEventListener(
                'click',
                function(event) {

                    event.stopPropagation();


                    const isOpen =
                        menu.classList.contains('open');


                    closeAllMenus(menu);


                    menu.classList.toggle(
                        'open',
                        !isOpen
                    );


                    button.setAttribute(
                        'aria-expanded',
                        String(!isOpen)
                    );

                }
            );


            const dropdown =
                menu.querySelector(
                    '.classwork-dropdown'
                );


            if (dropdown) {

                dropdown.addEventListener(
                    'click',
                    function(event) {

                        event.stopPropagation();

                    }
                );

            }

        });


        /* ============================================================
           CLOSE WHEN CLICKING OUTSIDE
        ============================================================ */

        document.addEventListener(
            'click',
            function() {

                closeAllMenus();

            }
        );


        /* ============================================================
           INDIVIDUAL GRADE MODAL
        ============================================================ */
        const singleGradeModal = document.getElementById('singleGradeModal');
        const singleGradeForm = document.getElementById('singleGradeForm');
        const singleGradeScore = document.getElementById('singleGradeScore');
        const singleGradeFeedback = document.getElementById('singleGradeFeedback');
        const singleGradePoints = document.getElementById('singleGradePoints');
        const singleGradeClasswork = document.getElementById('singleGradeClasswork');
        const singleGradeStudent = document.getElementById('singleGradeStudent');
        const singleGradeType = document.getElementById('singleGradeType');
        let singleGradePreviousOverflow = '';

        function openSingleGradeModal(button) {
            if (!singleGradeModal || !singleGradeForm) return;
            closeAllMenus();
            const type = button.dataset.gradeType || 'classwork';
            const title = button.dataset.gradeTitle || 'Classwork';
            const student = button.dataset.gradeStudent || 'Student';
            const points = Number(button.dataset.gradePoints || 0);
            const score = button.dataset.gradeScore || '';
            const feedback = button.dataset.gradeFeedback || '';
            singleGradeForm.action = button.dataset.gradeUrl || '';
            singleGradeClasswork.textContent = title;
            singleGradeStudent.textContent = student;
            singleGradePoints.textContent = formatScore(points);
            singleGradeType.textContent = type.charAt(0).toUpperCase() + type.slice(1);
            singleGradeScore.max = points;
            singleGradeScore.value = formatScore(score);
            singleGradeFeedback.value = feedback;
            singleGradePreviousOverflow = document.body.style.overflow;
            document.body.style.overflow = 'hidden';
            singleGradeModal.hidden = false;
            window.setTimeout(() => {
                singleGradeScore.focus();
                singleGradeScore.select();
            }, 50);
        }

        function closeSingleGradeModal() {
            if (!singleGradeModal) return;
            singleGradeModal.hidden = true;
            document.body.style.overflow = singleGradePreviousOverflow;
        }

        document.querySelectorAll('[data-edit-grade]').forEach(function(button) {
            button.addEventListener('click', function(event) {
                event.preventDefault();
                event.stopPropagation();
                openSingleGradeModal(button);
            });
        });

        document.querySelectorAll('[data-close-single-grade]').forEach(function(element) {
            element.addEventListener('click', function(event) {
                event.preventDefault();
                closeSingleGradeModal();
            });
        });

        if (singleGradeForm) {
            singleGradeForm.addEventListener('submit', function(event) {
                const value = Number(singleGradeScore.value);
                const min = Number(singleGradeScore.min || 0);
                const max = Number(singleGradeScore.max || 0);
                if (singleGradeScore.value === '' || !Number.isFinite(value) || value < min || value > max) {
                    event.preventDefault();
                    singleGradeScore.focus();
                    singleGradeScore.reportValidity();
                }
            });
        }
        /* ============================================================
           GRADE ALL MODAL
        ============================================================ */

        const gradeAllModal =
            document.getElementById('gradeAllModal');

        const gradeAllForm =
            document.getElementById('gradeAllForm');

        const gradeAllClassworkName =
            document.getElementById('gradeAllClassworkName');

        const gradeAllPoints =
            document.getElementById('gradeAllPoints');

        const gradeAllScoreMax =
            document.getElementById('gradeAllScoreMax');

        const gradeAllStudentCount =
            document.getElementById('gradeAllStudentCount');

        const gradeAllRecipientLabel =
            document.getElementById('gradeAllRecipientLabel');

        const gradeAllContentTitle =
            document.getElementById('gradeAllContentTitle');

        const gradeAllContentDescription =
            document.getElementById('gradeAllContentDescription');

        const gradeAllDescription =
            document.getElementById('gradeAllModalDescription');

        const gradeAllScore =
            document.getElementById('gradeAllScore');

        const gradeAllSaveButton =
            document.getElementById('gradeAllSaveButton');

        let gradeAllPreviousOverflow = '';


        function formatScore(value) {

            if (
                value === null ||
                value === undefined ||
                value === ''
            ) {
                return '';
            }

            const number = Number(value);

            if (!Number.isFinite(number)) {
                return '';
            }

            return Number.isInteger(number) ?
                String(number) :
                String(number)
                .replace(/0+$/, '')
                .replace(/\.$/, '');
        }


        /*
        |--------------------------------------------------------------------------
        | OPEN GRADE ALL MODAL
        |--------------------------------------------------------------------------
        */

        function openGradeAllModal(button) {

            if (
                !gradeAllModal ||
                !gradeAllForm
            ) {
                return;
            }

            closeAllMenus();

            const type =
                button.dataset.gradeType || 'classwork';

            const title =
                button.dataset.gradeTitle || 'Classwork';

            const points =
                Number(button.dataset.gradePoints || 0);

            const submissionsId =
                button.dataset.submissionsId;

            const action =
                button.dataset.gradeUrl;

            const dataElement =
                document.getElementById(submissionsId);


            /*
            |--------------------------------------------------------------------------
            | GET SUBMITTED COUNT
            |--------------------------------------------------------------------------
            */

            let submittedCount = 0;

            if (dataElement) {

                try {

                    const data =
                        JSON.parse(
                            dataElement.textContent || '{}'
                        );

                    submittedCount =
                        Number(data.count || 0);

                } catch (error) {

                    console.error(
                        'Unable to read grade data.',
                        error
                    );

                }
            }


            /*
            |--------------------------------------------------------------------------
            | SET FORM ACTION
            |--------------------------------------------------------------------------
            */

            gradeAllForm.action =
                action || '';


            /*
            |--------------------------------------------------------------------------
            | SET CLASSWORK INFORMATION
            |--------------------------------------------------------------------------
            */

            gradeAllClassworkName.textContent =
                title;

            gradeAllPoints.textContent =
                formatScore(points);

            gradeAllScoreMax.textContent =
                formatScore(points);

            gradeAllStudentCount.textContent =
                String(submittedCount);


            /*
            |--------------------------------------------------------------------------
            | DESCRIPTION
            |--------------------------------------------------------------------------
            */

            const typeLabel =
                type.charAt(0).toUpperCase() +
                type.slice(1);

            const isProject =
                type.toLowerCase() === 'project';

            const recipientLabel =
                isProject ? 'teams' : 'students';

            gradeAllRecipientLabel.textContent =
                recipientLabel;

            gradeAllDescription.textContent =
                `Give the same mark to all submitted ${recipientLabel} in this ${typeLabel.toLowerCase()}.`;

            gradeAllContentTitle.textContent =
                `Give the same mark to all submitted ${recipientLabel}`;

            gradeAllContentDescription.textContent =
                `This score will be applied to every ${recipientLabel.slice(0, -1)} who submitted this classwork.`;


            /*
            |--------------------------------------------------------------------------
            | SCORE INPUT
            |--------------------------------------------------------------------------
            */

            gradeAllScore.value = '';

            gradeAllScore.min = '0';

            gradeAllScore.max =
                String(points);


            /*
            |--------------------------------------------------------------------------
            | SCORE INPUT
            |--------------------------------------------------------------------------
            |
            | IMPORTANT:
            | Do not disable the score field when submittedCount is 0.
            | The backend decides which submitted records can be graded.
            | The professor should always be able to enter a score.
            |
            |--------------------------------------------------------------------------
            */

            gradeAllScore.disabled = false;
            gradeAllSaveButton.disabled = false;
            gradeAllScore.placeholder = 'Enter score';


            /*
            |--------------------------------------------------------------------------
            | OPEN MODAL
            |--------------------------------------------------------------------------
            */

            gradeAllPreviousOverflow =
                document.body.style.overflow;

            document.body.classList.add(
                'grade-all-modal-open'
            );

            gradeAllModal.hidden = false;


            /*
            |--------------------------------------------------------------------------
            | FOCUS INPUT
            |--------------------------------------------------------------------------
            */

            if (gradeAllScore) {

                window.setTimeout(function() {

                    gradeAllScore.focus();
                    gradeAllScore.select();

                }, 50);

            }

        }


        /*
        |--------------------------------------------------------------------------
        | CLOSE GRADE ALL MODAL
        |--------------------------------------------------------------------------
        */

        function closeGradeAllModal() {

            if (!gradeAllModal) {
                return;
            }

            gradeAllModal.hidden = true;

            document.body.classList.remove(
                'grade-all-modal-open'
            );

            document.body.style.overflow =
                gradeAllPreviousOverflow;

        }


        /*
        |--------------------------------------------------------------------------
        | OPEN BUTTONS
        |--------------------------------------------------------------------------
        */

        document
            .querySelectorAll('[data-grade-all]')
            .forEach(function(button) {

                button.addEventListener(
                    'click',
                    function(event) {

                        event.preventDefault();

                        event.stopPropagation();

                        openGradeAllModal(button);

                    }
                );

            });


        /*
        |--------------------------------------------------------------------------
        | CLOSE BUTTONS
        |--------------------------------------------------------------------------
        */

        document
            .querySelectorAll('[data-close-grade-all]')
            .forEach(function(element) {

                element.addEventListener(
                    'click',
                    function(event) {

                        event.preventDefault();

                        closeGradeAllModal();

                    }
                );

            });


        /*
        |--------------------------------------------------------------------------
        | VALIDATE SINGLE SCORE
        |--------------------------------------------------------------------------
        */

        if (gradeAllForm) {

            gradeAllForm.addEventListener(
                'submit',
                function(event) {

                    const value =
                        Number(gradeAllScore.value);

                    const min =
                        Number(gradeAllScore.min || 0);

                    const max =
                        Number(gradeAllScore.max || 0);


                    if (
                        gradeAllScore.value === '' ||
                        !Number.isFinite(value) ||
                        value < min ||
                        value > max
                    ) {

                        event.preventDefault();

                        gradeAllScore.focus();

                        gradeAllScore.reportValidity();

                        return;

                    }

                }
            );

        }
        /* ============================================================
           CLOSE WITH ESCAPE
        ============================================================ */

        document.addEventListener(
            'keydown',
            function(event) {

                if (event.key === 'Escape') {

                    if (singleGradeModal && !singleGradeModal.hidden) {
                        closeSingleGradeModal();
                        return;
                    }

                    if (gradeAllModal && !gradeAllModal.hidden) {
                        closeGradeAllModal();
                        return;
                    }

                    closeAllMenus();

                }

            }
        );

    });
</script>

@endsection