    <style>

        
        /* =========================================================
   DAY STATUS
   ========================================================= */

        .day-option {
            position: relative;
            min-height: 76px;
            padding: 13px 16px;

            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            gap: 4px;

            border-radius: 14px;
            transition:
                background 0.18s ease,
                border-color 0.18s ease,
                box-shadow 0.18s ease,
                transform 0.18s ease;
        }

        /* ---------------------------------------------------------
   NOT SCHEDULED / AVAILABLE
   --------------------------------------------------------- */

        .day-option.available {
            background: #f8fafc;
            border: 1px solid #dbe2ea;
            color: #475569;
        }

        .day-option.available:hover {
            background: #f1f5f9;
            border-color: #94a3b8;
            transform: translateY(-2px);
            box-shadow: 0 6px 14px rgba(15, 23, 42, 0.07);
        }

        .available-status {
            color: #94a3b8;
        }

        /* ---------------------------------------------------------
   SCHEDULED
   --------------------------------------------------------- */

        .day-option.scheduled {
            background: #ecfdf5;
            border: 1.5px solid #86efac;
            color: #166534;

            box-shadow:
                0 4px 12px rgba(22, 101, 52, 0.08);
        }

        .day-option.scheduled:hover {
            background: #dcfce7;
            border-color: #4ade80;
            transform: translateY(-2px);

            box-shadow:
                0 8px 18px rgba(22, 101, 52, 0.12);
        }

        .scheduled-status {
            color: #16a34a;
            font-weight: 800;
        }

        /* ---------------------------------------------------------
   STATUS TEXT
   --------------------------------------------------------- */

        .day-status {
            font-size: 10px;
            font-weight: 800;
            letter-spacing: 0.04em;
            text-transform: uppercase;
        }

        /* ---------------------------------------------------------
   SELECTED DAY
   --------------------------------------------------------- */

        .day-option.active {
            background: #1e293b;
            border-color: #1e293b;
            color: #ffffff;

            box-shadow:
                0 7px 18px rgba(15, 23, 42, 0.18);
        }

        .day-option.active .available-status {
            color: #cbd5e1;
        }

        /* Selected + scheduled */
        .day-option.active.scheduled {
            background: #166534;
            border-color: #166534;
            color: #ffffff;

            box-shadow:
                0 8px 20px rgba(22, 101, 52, 0.22);
        }

        .day-option.active.scheduled .scheduled-status {
            color: #bbf7d0;
        }

        .schedule-day-action {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 16px;
            margin: 16px 0;
            padding: 14px 16px;
            background: #fff7f7;
            border: 1px solid #fee2e2;
            border-radius: 10px;
        }

        .schedule-day-action-info {
            min-width: 0;
        }

        .schedule-day-action-info strong {
            display: block;
            color: #334155;
            font-size: 13px;
        }

        .schedule-day-action-info span {
            display: block;
            margin-top: 3px;
            color: #94a3b8;
            font-size: 11px;
        }

        .schedule-day-action form {
            margin: 0;
            flex-shrink: 0;
        }

        .btn-delete-entire {
            border: none;
            background: #7f1d1d;
            color: #fff;
            padding: 10px 16px;
            border-radius: 8px;
            font-weight: 700;
            cursor: pointer;
            white-space: nowrap;
        }

        .btn-delete-entire:hover {
            background: #991b1b;
        }

        .btn-delete-entire-disabled {
            opacity: .55;
            cursor: not-allowed;
        }

        .session-unavailable-row {
            background: #f8fafc;
        }

        .session-unavailable-cell {
            text-align: center;
            vertical-align: middle;
        }

        .session-unavailable {
            display: inline-flex;
            flex-direction: column;
            align-items: center;
            gap: 4px;
            padding: 12px 18px;
            border: 1px dashed #cbd5e1;
            border-radius: 10px;
            background: #f8fafc;
        }

        .session-unavailable strong {
            color: #64748b;
            font-size: 14px;
        }

        .session-unavailable span {
            color: #94a3b8;
            font-size: 12px;
        }
    </style>

    {{-- =========================================================
    PAGE STYLES
    ========================================================== --}}
    <style>
        /* ---------------------------------------------------------
           PAGE
        --------------------------------------------------------- */

        .schedule-page {
            max-width: 1280px;
            margin: 0 auto;
            padding: 32px 24px 60px;
        }


        .page-topbar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 30px;
            margin-bottom: 28px;
            padding: 24px 26px;

            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 16px;

            box-shadow: 0 4px 18px rgba(15, 23, 42, 0.05);
        }


        /* ---------------------------------------------------------
   TITLE AREA
--------------------------------------------------------- */

        .page-title-area {
            min-width: 0;
        }

        .page-eyebrow {
            display: flex;
            align-items: center;
            gap: 8px;

            margin-bottom: 7px;

            color: #2563eb;
            font-size: 11px;
            font-weight: 800;
            letter-spacing: 0.09em;
            text-transform: uppercase;
        }

        .eyebrow-line {
            width: 24px;
            height: 3px;

            border-radius: 999px;
            background: #2563eb;
        }


        .page-title-area h1 {
            margin: 0;

            color: #0f172a;
            font-size: 30px;
            line-height: 1.2;
            font-weight: 800;
            letter-spacing: -0.025em;
        }


        /* ---------------------------------------------------------
   DEPARTMENT
--------------------------------------------------------- */

        .department-info {
            display: inline-flex;
            align-items: center;
            gap: 7px;

            margin-top: 10px;
            padding: 6px 10px;

            color: #475569;
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 7px;

            font-size: 13px;
            font-weight: 600;
        }

        .department-icon {
            display: flex;
            align-items: center;
            justify-content: center;

            width: 18px;
            height: 18px;

            color: #2563eb;
            font-size: 14px;
        }


        /* ---------------------------------------------------------
   ACTION BUTTONS
--------------------------------------------------------- */

        .page-actions {
            display: flex;
            align-items: center;
            justify-content: flex-end;
            gap: 9px;

            flex-shrink: 0;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;

            min-height: 42px;
            padding: 10px 15px;

            border-radius: 9px;
            border: 1px solid transparent;

            font-size: 13px;
            font-weight: 700;

            text-decoration: none;
            white-space: nowrap;

            transition:
                background 0.2s ease,
                border-color 0.2s ease,
                box-shadow 0.2s ease,
                transform 0.2s ease;
        }


        /* Create Schedule */

        .btn-primary {
            color: #ffffff;
            background: #2563eb;

            box-shadow: 0 3px 8px rgba(37, 99, 235, 0.18);
        }

        .btn-primary:hover {
            background: #1d4ed8;
            box-shadow: 0 5px 12px rgba(37, 99, 235, 0.22);
            transform: translateY(-1px);
        }


        /* Export */

        .btn-secondary {
            color: #334155;
            background: #ffffff;
            border-color: #dbe2ea;
        }

        .btn-secondary:hover {
            color: #1e293b;
            background: #f8fafc;
            border-color: #cbd5e1;
        }


        /* Icons */

        .btn-icon {
            display: inline-flex;
            align-items: center;
            justify-content: center;

            width: 18px;
            height: 18px;

            font-size: 19px;
            line-height: 1;
            font-weight: 400;
        }

        .export-icon {
            display: inline-flex;
            align-items: center;
            justify-content: center;

            width: 18px;
            height: 18px;

            font-size: 18px;
            line-height: 1;
        }


        /* ---------------------------------------------------------
   MOBILE
--------------------------------------------------------- */

        @media (max-width: 800px) {

            .page-topbar {
                align-items: flex-start;
                flex-direction: column;
                gap: 20px;
            }

            .page-title-area {
                width: 100%;
            }

            .page-actions {
                width: 100%;
                justify-content: stretch;
            }

            .page-actions .btn {
                flex: 1;
            }

        }


        @media (max-width: 480px) {

            .page-topbar {
                padding: 20px;
                border-radius: 14px;
            }

            .page-title-area h1 {
                font-size: 25px;
            }

            .department-info {
                font-size: 12px;
            }

            .page-actions {
                display: grid;
                grid-template-columns: 1fr;
            }

            .page-actions .btn {
                width: 100%;
            }

        }


        /* =========================
   SCHEDULE HEADER
========================= */

        .schedule-header {
            text-align: center;
            padding: 28px 20px 20px;
            color: #111827;
        }

        .schedule-university {
            font-size: 24px;
            font-weight: 800;
            letter-spacing: 0.04em;
            margin-bottom: 5px;
        }

        .schedule-college {
            font-size: 17px;
            font-weight: 700;
            margin-bottom: 3px;
        }

        .schedule-department {
            font-size: 16px;
            font-weight: 600;
            margin-bottom: 3px;
        }

        .schedule-promotion,
        .schedule-academic {
            font-size: 15px;
            font-weight: 500;
            margin-top: 2px;
        }

        /* ---------------------------------------------------------
           BUTTONS
        --------------------------------------------------------- */

        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            min-height: 42px;
            padding: 10px 16px;
            border-radius: 9px;
            text-decoration: none;
            font-size: 14px;
            font-weight: 700;
            border: 1px solid transparent;
            transition: all .2s ease;
            cursor: pointer;
        }

        .btn-primary {
            background: #2563eb;
            color: #fff;
            box-shadow: 0 2px 5px rgba(37, 99, 235, .18);
        }

        .btn-primary:hover {
            background: #1d4ed8;
            transform: translateY(-1px);
        }

        .btn-secondary {
            background: #fff;
            color: #334155;
            border-color: #dbe2ea;
        }

        .btn-secondary:hover {
            background: #f8fafc;
            border-color: #cbd5e1;
        }

        .btn-icon {
            font-size: 19px;
            line-height: 1;
            font-weight: 400;
        }

        .export-icon {
            font-size: 18px;
            line-height: 1;
        }


        /* ---------------------------------------------------------
           ALERTS
        --------------------------------------------------------- */

        .alert {
            display: flex;
            align-items: flex-start;
            gap: 12px;
            padding: 14px 16px;
            border-radius: 10px;
            margin-bottom: 20px;
        }

        .alert-icon {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 24px;
            height: 24px;
            flex-shrink: 0;
            border-radius: 50%;
            font-size: 13px;
            font-weight: 800;
        }

        .alert strong {
            display: block;
            font-size: 14px;
        }

        .alert p {
            margin: 3px 0 0;
            font-size: 13px;
        }

        .alert-success {
            background: #f0fdf4;
            border: 1px solid #bbf7d0;
            color: #166534;
        }

        .alert-success .alert-icon {
            background: #dcfce7;
        }

        .alert-error {
            background: #fef2f2;
            border: 1px solid #fecaca;
            color: #991b1b;
        }

        .alert-error .alert-icon {
            background: #fee2e2;
        }

        .alert-error ul {
            margin: 6px 0 0;
            padding-left: 18px;
        }

        .alert-error li {
            margin-bottom: 3px;
            font-size: 13px;
        }


        /* ---------------------------------------------------------
           CONTROL CARD
        --------------------------------------------------------- */

        .schedule-controls {
            background: #fff;
            border: 1px solid #e2e8f0;
            border-radius: 16px;
            box-shadow: 0 4px 18px rgba(15, 23, 42, .05);
            margin-bottom: 28px;
            overflow: hidden;
        }

        .controls-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 20px;
            padding: 22px 24px;
            border-bottom: 1px solid #eef2f7;
        }

        .controls-header h2 {
            margin: 0;
            color: #0f172a;
            font-size: 18px;
            font-weight: 800;
        }

        .controls-header p {
            margin: 4px 0 0;
            color: #64748b;
            font-size: 13px;
        }

        .current-selection {
            display: flex;
            flex-direction: column;
            align-items: flex-end;
            gap: 3px;
            padding: 9px 13px;
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 9px;
            white-space: nowrap;
        }

        .current-selection span {
            color: #94a3b8;
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: .05em;
        }

        .current-selection strong {
            color: #1e293b;
            font-size: 13px;
        }

        .current-selection strong span {
            display: inline;
            margin: 0 4px;
            color: #94a3b8;
            font-size: inherit;
            font-weight: inherit;
            text-transform: none;
            letter-spacing: normal;
        }


        /* ---------------------------------------------------------
           FILTER GRID
        --------------------------------------------------------- */

        .filter-grid {
            display: grid;
            grid-template-columns: minmax(250px, .8fr) minmax(400px, 1.6fr);
            gap: 0;
        }

        .filter-section {
            padding: 24px;
        }

        .filter-section+.filter-section {
            border-left: 1px solid #eef2f7;
        }

        .filter-label {
            display: flex;
            align-items: center;
            gap: 11px;
            margin-bottom: 16px;
        }

        .step-number {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 28px;
            height: 28px;
            flex-shrink: 0;
            border-radius: 8px;
            background: #eff6ff;
            color: #2563eb;
            font-size: 12px;
            font-weight: 800;
        }

        .filter-label strong {
            display: block;
            color: #1e293b;
            font-size: 14px;
            font-weight: 800;
        }

        .filter-label small {
            display: block;
            margin-top: 2px;
            color: #94a3b8;
            font-size: 11px;
        }


        /* ---------------------------------------------------------
           YEAR OPTIONS
        --------------------------------------------------------- */

        .year-options {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 8px;
        }

        .year-option {
            position: relative;
            display: flex;
            align-items: center;
            gap: 9px;
            min-height: 48px;
            padding: 8px 11px;
            border: 1px solid #dbe2ea;
            border-radius: 9px;
            background: #fff;
            color: #475569;
            text-decoration: none;
            font-size: 13px;
            font-weight: 700;
            transition: all .2s ease;
        }

        .year-option:hover {
            border-color: #93c5fd;
            background: #f8fbff;
            color: #1d4ed8;
        }

        .year-option.active {
            border-color: #2563eb;
            background: #2563eb;
            color: #fff;
            box-shadow: 0 3px 8px rgba(37, 99, 235, .2);
        }

        .year-number {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 28px;
            height: 28px;
            border-radius: 7px;
            background: #f1f5f9;
            color: #475569;
            font-size: 12px;
            font-weight: 800;
        }

        .year-option.active .year-number {
            background: rgba(255, 255, 255, .18);
            color: #fff;
        }


        /* ---------------------------------------------------------
           DAY OPTIONS
        --------------------------------------------------------- */

        .day-options {
            display: grid;
            grid-template-columns: repeat(5, minmax(0, 1fr));
            gap: 8px;
        }

        .day-option {
            position: relative;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            min-height: 64px;
            padding: 8px 5px;
            border: 1px solid #dbe2ea;
            border-radius: 9px;
            background: #fff;
            color: #475569;
            text-decoration: none;
            transition: all .2s ease;
        }

        .day-option:hover {
            border-color: #94a3b8;
            background: #f8fafc;
        }

        .day-option.active {
            border-color: #0f172a;
            background: #0f172a;
            color: #fff;
            box-shadow: 0 3px 8px rgba(15, 23, 42, .15);
        }

        .day-short {
            display: none;
            font-size: 12px;
            font-weight: 800;
            text-transform: uppercase;
        }

        .day-full {
            font-size: 12px;
            font-weight: 700;
        }

        .selected-check {
            position: absolute;
            top: 5px;
            right: 6px;
            font-size: 10px;
            font-weight: 800;
        }


        /* ---------------------------------------------------------
           RESULT SECTION
        --------------------------------------------------------- */

        .schedule-result {
            background: #fff;
            border: 1px solid #e2e8f0;
            border-radius: 16px;
            box-shadow: 0 4px 18px rgba(15, 23, 42, .05);
            overflow: hidden;
        }

        .result-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
            padding: 20px 24px;
            border-bottom: 1px solid #eef2f7;
        }

        .result-title {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .result-icon {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 42px;
            height: 42px;
            flex-shrink: 0;
            background: #eff6ff;
            border-radius: 10px;
            font-size: 20px;
        }

        .result-label {
            color: #64748b;
            font-size: 11px;
            font-weight: 700;
            letter-spacing: .06em;
            text-transform: uppercase;
        }

        .result-title h2 {
            display: inline;
            margin: 2px 0 0;
            color: #0f172a;
            font-size: 19px;
            font-weight: 800;
        }

        .result-title p {
            display: inline;
            margin: 0 0 0 8px;
            color: #64748b;
            font-size: 14px;
        }

        .schedule-count {
            padding: 6px 10px;
            border-radius: 999px;
            background: #f1f5f9;
            color: #475569;
            font-size: 12px;
            font-weight: 700;
        }


        /* ---------------------------------------------------------
           TABLE
        --------------------------------------------------------- */

        .schedule-table-wrapper {
            width: 100%;
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
        }

        .schedule-table {
            width: 100%;
            min-width: 1050px;
            border-collapse: collapse;
        }

        .schedule-table thead {
            background: #f8fafc;
        }

        .schedule-table th {
            padding: 13px 16px;
            border-bottom: 1px solid #e2e8f0;
            color: #64748b;
            text-align: left;
            font-size: 11px;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: .05em;
            white-space: nowrap;
        }

        .schedule-table td {
            padding: 15px 16px;
            border-bottom: 1px solid #eef2f7;
            color: #334155;
            font-size: 13px;
            vertical-align: middle;
        }

        .schedule-table tbody tr {
            transition: background .15s ease;
        }

        .schedule-table tbody tr:hover {
            background: #f8fafc;
        }

        .schedule-table tbody tr:last-child td {
            border-bottom: none;
        }

        .time-cell {
            white-space: nowrap;
        }

        .time-cell strong {
            display: block;
            color: #0f172a;
            font-size: 13px;
        }

        .time-cell span {
            color: #94a3b8;
            font-size: 11px;
        }

        .course-cell {
            min-width: 180px;
            color: #0f172a !important;
            font-weight: 700;
        }

        .year-badges {
            display: flex;
            flex-wrap: wrap;
            gap: 5px;
        }

        .year-badge {
            display: inline-flex;
            align-items: center;
            padding: 4px 8px;
            border-radius: 999px;
            background: #eff6ff;
            color: #1d4ed8;
            font-size: 11px;
            font-weight: 700;
            white-space: nowrap;
        }

        .semester-text {
            color: #64748b;
            font-size: 11px;
            font-weight: 700;
            white-space: nowrap;
        }


        /* ---------------------------------------------------------
           STATUS
        --------------------------------------------------------- */

        .status-badge {
            display: inline-flex;
            align-items: center;
            padding: 5px 9px;
            border-radius: 999px;
            background: #f1f5f9;
            color: #475569;
            font-size: 11px;
            font-weight: 700;
            white-space: nowrap;
        }

        .status-active {
            background: #ecfdf5;
            color: #047857;
        }

        .status-inactive {
            background: #fef2f2;
            color: #b91c1c;
        }


        /* ---------------------------------------------------------
           ACTIONS
        --------------------------------------------------------- */

        .schedule-actions-cell {
            display: flex;
            align-items: center;
            gap: 6px;
            white-space: nowrap;
        }

        .schedule-actions-cell form {
            margin: 0;
        }

        .btn-edit,
        .btn-delete {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-height: 32px;
            padding: 6px 10px;
            border: none;
            border-radius: 7px;
            font-size: 12px;
            font-weight: 700;
            text-decoration: none;
            cursor: pointer;
            transition: all .15s ease;
        }

        .btn-edit {
            background: #f1f5f9;
            color: #334155;
        }

        .btn-edit:hover {
            background: #e2e8f0;
        }

        .btn-delete {
            background: #fef2f2;
            color: #dc2626;
        }

        .btn-delete:hover {
            background: #fee2e2;
        }


        /* ---------------------------------------------------------
           EMPTY STATE
        --------------------------------------------------------- */

        .empty-schedule {
            padding: 60px 24px;
            text-align: center;
        }

        .empty-icon {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 58px;
            height: 58px;
            margin: 0 auto 16px;
            border-radius: 14px;
            background: #f1f5f9;
            font-size: 27px;
        }

        .empty-schedule h3 {
            margin: 0;
            color: #0f172a;
            font-size: 19px;
            font-weight: 800;
        }

        .empty-schedule p {
            max-width: 420px;
            margin: 7px auto 20px;
            color: #64748b;
            font-size: 13px;
        }

        .empty-create-btn {
            display: inline-flex;
        }


        /* ---------------------------------------------------------
           RESPONSIVE
        --------------------------------------------------------- */

        @media (max-width: 900px) {

            .page-topbar {
                align-items: flex-start;
                flex-direction: column;
            }

            .page-actions {
                width: 100%;
            }

            .page-actions .btn {
                flex: 1;
            }

            .filter-grid {
                grid-template-columns: 1fr;
            }

            .filter-section+.filter-section {
                border-top: 1px solid #eef2f7;
                border-left: none;
            }

            .year-options {
                grid-template-columns: repeat(4, minmax(0, 1fr));
            }

        }


        @media (max-width: 640px) {

            .schedule-page {
                padding: 24px 14px 45px;
            }

            .page-title-area h1 {
                font-size: 26px;
            }

            .page-actions {
                display: grid;
                grid-template-columns: 1fr;
            }

            .page-actions .btn {
                width: 100%;
            }

            .controls-header {
                align-items: flex-start;
                flex-direction: column;
                padding: 18px;
            }

            .current-selection {
                width: 100%;
                align-items: flex-start;
                box-sizing: border-box;
            }

            .filter-section {
                padding: 18px;
            }

            .year-options {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }

            .day-options {
                grid-template-columns: repeat(5, minmax(0, 1fr));
                gap: 5px;
            }

            .day-option {
                min-height: 56px;
            }

            .day-full {
                display: none;
            }

            .day-short {
                display: block;
            }

            .selected-check {
                top: 4px;
                right: 5px;
            }

            .result-header {
                align-items: flex-start;
                padding: 18px;
            }

            .result-title {
                align-items: flex-start;
            }

            .result-title h2 {
                display: block;
            }

            .result-title p {
                display: block;
                margin: 2px 0 0;
            }

            .schedule-day-action {
                align-items: stretch;
                flex-direction: column;
            }

            .schedule-day-action form,
            .btn-delete-entire {
                width: 100%;
            }

            .schedule-table {
                min-width: 1000px;
            }

            .schedule-actions-cell {
                flex-direction: column;
                align-items: stretch;
            }

            .btn-edit,
            .btn-delete {
                min-width: 58px;
            }

        }

        /* =========================================================
           HOD SCHEDULE DASHBOARD — LIGHT UI REFRESH
        ========================================================== */
        body {
            background: #f8fafc !important;
        }

        .schedule-page {
            max-width: 1240px !important;
            padding-top: 30px !important;
            color: #1e293b;
        }

        .schedule-header {
            padding: 28px 24px !important;
            background: linear-gradient(180deg, #ffffff 0%, #fafbff 100%) !important;
            border-bottom: 1px solid #e8ebf2 !important;
        }

        .schedule-university {
            color: #334155 !important;
        }

        .schedule-college,
        .schedule-department,
        .schedule-promotion,
        .schedule-academic {
            color: #64748b !important;
        }

        .page-topbar {
            background: #fff !important;
            border-color: #e7eaf2 !important;
            border-radius: 20px !important;
            box-shadow: 0 10px 28px rgba(30, 41, 59, .055) !important;
        }

        .page-eyebrow {
            color: #6366f1 !important;
        }

        .eyebrow-line {
            background: #818cf8 !important;
        }

        .page-title-area h1 {
            color: #172033 !important;
        }

        .department-info {
            color: #64748b !important;
        }

        .btn-primary {
            background: #6366f1 !important;
            border-color: #6366f1 !important;
            box-shadow: 0 7px 16px rgba(99, 102, 241, .18) !important;
        }

        .btn-primary:hover {
            background: #4f46e5 !important;
        }

        .btn-export {
            background: #fff !important;
            color: #475569 !important;
            border-color: #dfe4ee !important;
        }

        .schedule-controls {
            background: #fff !important;
            border-color: #e7eaf2 !important;
            border-radius: 20px !important;
            box-shadow: 0 10px 28px rgba(30, 41, 59, .05) !important;
        }

        .controls-header {
            background: #fafbff !important;
            border-bottom-color: #edf0f5 !important;
        }

        .controls-header h2 {
            color: #1e293b !important;
        }

        .controls-header p,
        .current-selection span {
            color: #64748b !important;
        }

        .current-selection {
            background: #f1f3ff !important;
            border-color: #e0e4ff !important;
        }

        .current-selection strong {
            color: #4f46e5 !important;
        }

        .step-number {
            background: #eef2ff !important;
            color: #4f46e5 !important;
        }

        .filter-section {
            background: #fff !important;
        }

        .year-option,
        .day-option {
            background: #fff !important;
            border-color: #e2e7ef !important;
            color: #64748b !important;
        }

        .year-option:hover,
        .day-option:hover {
            background: #f8f8ff !important;
            border-color: #cfd2f7 !important;
            color: #4f46e5 !important;
        }

        .year-option.active,
        .day-option.active {
            background: #6366f1 !important;
            border-color: #6366f1 !important;
            color: #fff !important;
            box-shadow: 0 7px 15px rgba(99, 102, 241, .18) !important;
        }

        .year-option.active .year-number {
            background: rgba(255, 255, 255, .18) !important;
            color: #fff !important;
        }

        .schedule-table-card,
        .table-card,
        .schedule-results {
            background: #fff !important;
            border-color: #e7eaf2 !important;
            border-radius: 18px !important;
            box-shadow: 0 9px 25px rgba(30, 41, 59, .045) !important;
        }

        table thead th {
            background: #f8f9fc !important;
            color: #64748b !important;
            border-bottom-color: #e6e9ef !important;
        }

        table tbody td {
            border-bottom-color: #edf0f4 !important;
            color: #334155 !important;
        }

        .btn-edit {
            background: #eef2ff !important;
            color: #4f46e5 !important;
            border-color: #e0e7ff !important;
        }

        .btn-edit:hover {
            background: #e0e7ff !important;
        }

        .btn-delete {
            background: #fff1f2 !important;
            color: #e11d48 !important;
            border-color: #ffe4e6 !important;
        }

        .empty-icon {
            background: #f1f3ff !important;
            color: #6366f1 !important;
        }

        .empty-schedule h3 {
            color: #1e293b !important;
        }

        .alert-success {
            background: #f0fdf4 !important;
            border-color: #dcfce7 !important;
            color: #166534 !important;
        }

        .alert-error {
            background: #fff7f7 !important;
            border-color: #fee2e2 !important;
        }

        @media (max-width: 640px) {
            .schedule-header {
                padding: 22px 16px !important;
            }

            .page-topbar {
                border-radius: 16px !important;
            }
        }
    </style>
























