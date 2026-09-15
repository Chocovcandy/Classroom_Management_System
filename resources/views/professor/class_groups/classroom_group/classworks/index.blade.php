<style>

/* ============================================================
   CLASSWORK PAGE
   ============================================================ */

.classwork-page {
    --material-color: #4f7df3;
    --material-soft: rgba(79, 125, 243, 0.10);

    --assignment-color: #22b07d;
    --assignment-soft: rgba(34, 176, 125, 0.10);

    --quiz-color: #9b5de5;
    --quiz-soft: rgba(155, 93, 229, 0.10);

    --exam-color: #e25555;
    --exam-soft: rgba(226, 85, 85, 0.10);

    --project-color: #f59e0b;
    --project-soft: rgba(245, 158, 11, 0.10);

    --topic-color: #3b82f6;
    --topic-soft: rgba(59, 130, 246, 0.09);

    --classwork-date-color: var(--secondary-text-color);

    width: 100%;
    min-height: 100%;
    box-sizing: border-box;
}

.dark-mode .classwork-page {
    --material-color: #7fa3ff;
    --material-soft: rgba(127, 163, 255, 0.14);

    --assignment-color: #55d6a5;
    --assignment-soft: rgba(85, 214, 165, 0.14);

    --quiz-color: #c18af2;
    --quiz-soft: rgba(193, 138, 242, 0.14);

    --exam-color: #ff8d8d;
    --exam-soft: rgba(255, 141, 141, 0.14);

    --project-color: #fbbf24;
    --project-soft: rgba(251, 191, 36, 0.14);

    --topic-color: #8fa8ff;
    --topic-soft: rgba(143, 168, 255, 0.14);

    --classwork-date-color: var(--secondary-text-color);
}


/* ============================================================
   HEADER
   ============================================================ */

.classwork-header-row {
    display: grid;
    grid-template-columns: minmax(0, 1fr) 250px;
    gap: 12px;

    width: calc(100% - 10px);
    margin-top: 8px;

    box-sizing: border-box;
}

.classwork-header {
    position: relative;

    display: flex;
    align-items: center;
    justify-content: space-between;

    min-height: 170px;
    padding: 22px 26px;

    overflow: hidden;
    box-sizing: border-box;

    background-color: var(--card-color);
    border: 1px solid var(--border-color);
    border-radius: 15px;
}

.classwork-header-content {
    position: relative;
    z-index: 2;
    min-width: 0;
}

.classwork-eyebrow {
    display: block;
    margin-bottom: 6px;

    color: var(--button-color);

    font-size: 10px;
    font-weight: 800;
    letter-spacing: 1.2px;
}

.classwork-header h1 {
    margin: 0;

    color: var(--heading-color);

    font-size: 25px;
    font-weight: 800;
    line-height: 1.25;
}

.classwork-header p {
    max-width: 520px;
    margin: 7px 0 0;

    color: var(--secondary-text-color);

    font-size: 13px;
    line-height: 1.5;
}


/* ============================================================
   HEADER ILLUSTRATION
   ============================================================ */

.classwork-header-illustration {
    position: relative;

    display: flex;
    align-items: center;
    justify-content: center;

    width: 175px;
    height: 125px;

    margin-left: 20px;
    flex-shrink: 0;
}

.classwork-illustration-circle {
    position: absolute;

    width: 105px;
    height: 105px;

    background-color: var(--topic-soft);

    border: 1px solid var(--primary-border);
    border-radius: 50%;
}

.classwork-document {
    position: relative;
    z-index: 2;

    display: flex;
    flex-direction: column;

    width: 72px;
    height: 88px;

    padding: 18px 13px;

    box-sizing: border-box;

    background-color: var(--card-color);
    border: 1px solid var(--border-color);
    border-radius: 10px;

    box-shadow: 0 8px 20px var(--shadow-color);

    transform: rotate(2deg);
    animation: classworkDocumentFloat 4s ease-in-out infinite;
}

.document-line {
    width: 100%;
    height: 5px;

    margin-bottom: 8px;

    background-color: var(--border-color);
    border-radius: 5px;
}

.document-line-one {
    width: 70%;
}

.document-line-two {
    width: 90%;
}

.document-line-three {
    width: 55%;
}

.document-check {
    display: flex;
    align-items: center;
    justify-content: center;

    width: 22px;
    height: 22px;

    margin-top: auto;

    color: var(--assignment-color);
    background-color: var(--assignment-soft);

    border-radius: 6px;

    font-size: 14px;
}

.classwork-illustration-icon {
    position: absolute;
    z-index: 3;

    display: flex;
    align-items: center;
    justify-content: center;

    width: 34px;
    height: 34px;

    background-color: var(--card-color);
    border: 1px solid var(--border-color);
    border-radius: 9px;

    box-shadow: 0 5px 15px var(--shadow-color);

    font-size: 17px;
}

.illustration-book {
    top: 5px;
    right: 17px;

    color: var(--material-color);

    transform: rotate(8deg);
    animation: classworkBookFloat 3.2s ease-in-out infinite;
}

.illustration-assignment {
    bottom: 8px;
    left: 18px;

    color: var(--assignment-color);

    transform: rotate(-7deg);
    animation: classworkAssignmentFloat 3.5s ease-in-out infinite;
}

.illustration-pencil {
    top: 30px;
    left: 6px;

    color: var(--quiz-color);

    transform: rotate(-12deg);
    animation: classworkPencilFloat 3.8s ease-in-out infinite;
}

.illustration-check {
    right: 2px;
    bottom: 15px;

    color: var(--exam-color);

    transform: rotate(6deg);
    animation: classworkCheckFloat 3.4s ease-in-out infinite;
}

@keyframes classworkDocumentFloat {
    0%, 100% {
        transform: translateY(0) rotate(2deg);
    }

    50% {
        transform: translateY(-4px) rotate(-1deg);
    }
}

@keyframes classworkBookFloat {
    0%, 100% {
        transform: translateY(0) rotate(8deg);
    }

    50% {
        transform: translateY(-5px) rotate(3deg);
    }
}

@keyframes classworkAssignmentFloat {
    0%, 100% {
        transform: translateY(0) rotate(-7deg);
    }

    50% {
        transform: translateY(4px) rotate(-3deg);
    }
}

@keyframes classworkPencilFloat {
    0%, 100% {
        transform: translateY(0) rotate(-12deg);
    }

    50% {
        transform: translateY(-4px) rotate(-7deg);
    }
}

@keyframes classworkCheckFloat {
    0%, 100% {
        transform: translateY(0) rotate(6deg);
    }

    50% {
        transform: translateY(4px) rotate(2deg);
    }
}


/* ============================================================
   HEADER ACTIONS
   ============================================================ */

.classwork-header-actions {
    display: flex;
    flex-direction: column;
    gap: 10px;
}

.classwork-header-action {
    display: flex;
    align-items: center;
    gap: 10px;

    width: 100%;
    min-height: 80px;

    padding: 13px;

    box-sizing: border-box;

    color: var(--heading-color);
    background-color: var(--card-color);

    border: 1px solid var(--border-color);
    border-radius: 12px;

    font-family: inherit;
    font-size: 13px;
    font-weight: 700;

    text-align: left;
    text-decoration: none;

    cursor: pointer;

    transition:
        color 0.2s ease,
        background-color 0.2s ease,
        border-color 0.2s ease,
        transform 0.2s ease;
}

.classwork-header-action > i:first-child {
    display: flex;
    align-items: center;
    justify-content: center;

    width: 39px;
    height: 39px;

    flex-shrink: 0;

    border-radius: 9px;

    font-size: 19px;
}

.classwork-header-action:nth-child(1) > i:first-child {
    color: var(--topic-color);
    background-color: var(--topic-soft);
}

.classwork-header-action:nth-child(2) > i:first-child {
    color: var(--assignment-color);
    background-color: var(--assignment-soft);
}

.classwork-header-action span {
    flex: 1;
    min-width: 0;
}

.classwork-header-action .action-arrow {
    color: var(--secondary-text-color);
    font-size: 17px;
    transition: transform 0.2s ease;
}

.classwork-header-action:hover {
    border-color: var(--primary-border);
    transform: translateY(-2px);
}

.classwork-header-action:hover .action-arrow {
    color: var(--button-color);
    transform: translateX(3px);
}


/* ============================================================
   FILTER
   ============================================================ */

.classwork-filter {
    display: flex;
    align-items: center;
    gap: 7px;

    width: calc(100% - 10px);

    margin-top: 14px;
    padding: 4px;

    box-sizing: border-box;

    overflow-x: auto;
    scrollbar-width: none;
}

.classwork-filter::-webkit-scrollbar {
    display: none;
}

.classwork-filter-item {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 7px;

    min-width: 88px;
    height: 37px;

    padding: 0 13px;

    flex-shrink: 0;

    color: var(--secondary-text-color);
    background-color: transparent;

    border: 1px solid transparent;
    border-radius: 9px;

    font-family: inherit;
    font-size: 11px;
    font-weight: 700;

    cursor: pointer;

    transition:
        color 0.2s ease,
        background-color 0.2s ease,
        border-color 0.2s ease;
}

.classwork-filter-item i {
    font-size: 16px;
}

.classwork-filter-item:hover {
    color: var(--heading-color);
    background-color: var(--surface-hover);
}

.classwork-filter-item.active {
    color: var(--button-color);
    background-color: var(--card-color);
    border-color: var(--border-color);
    box-shadow: 0 2px 7px var(--shadow-color);
}


/* ============================================================
   CONTENT
   ============================================================ */

.classwork-content {
    display: flex;
    flex-direction: column;
    gap: 12px;

    width: calc(100% - 10px);

    margin-top: 10px;
    padding-bottom: 30px;

    box-sizing: border-box;
}


/* ============================================================
   TOPIC
   ============================================================ */

.classwork-topic {
    width: 100%;

    background-color: var(--card-color);

    border: 1px solid var(--border-color);
    border-radius: 13px;

    overflow: hidden;

    transition:
        border-color 0.2s ease,
        box-shadow 0.2s ease;
}

.classwork-topic:hover {
    border-color: var(--primary-border);
}


/* ============================================================
   TOPIC HEADER
   ============================================================ */

.classwork-topic-header {
    display: flex;
    align-items: center;
    justify-content: space-between;

    min-height: 68px;

    padding: 10px 12px 10px 15px;

    box-sizing: border-box;

    cursor: pointer;

    transition: background-color 0.2s ease;
}

.classwork-topic-header:hover {
    background-color: var(--surface-color);
}

.classwork-topic-info {
    display: flex;
    align-items: center;
    gap: 12px;

    min-width: 0;
}

.classwork-topic-icon {
    display: flex;
    align-items: center;
    justify-content: center;

    width: 39px;
    height: 39px;

    flex-shrink: 0;

    color: var(--topic-color);
    background-color: var(--topic-soft);

    border: 1px solid var(--primary-border);
    border-radius: 10px;

    font-size: 19px;
}

.classwork-topic-icon.no-topic {
    color: var(--secondary-text-color);
    background-color: var(--surface-color);
    border-color: var(--border-color);
}

.classwork-topic-text {
    min-width: 0;
}

.classwork-topic-text h2 {
    margin: 0;

    color: var(--heading-color);

    font-size: 15px;
    font-weight: 800;
    line-height: 1.3;

    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}

.classwork-topic-text p {
    margin: 3px 0 0;

    color: var(--secondary-text-color);

    font-size: 10px;
    line-height: 1.4;

    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}


/* ============================================================
   TOPIC ACTIONS
   ============================================================ */

.classwork-topic-actions {
    display: flex;
    align-items: center;
    gap: 3px;

    flex-shrink: 0;
    margin-left: 12px;
}

.classwork-topic-toggle,
.classwork-topic-menu {
    display: flex;
    align-items: center;
    justify-content: center;

    width: 34px;
    height: 34px;

    padding: 0;

    color: var(--secondary-text-color);
    background-color: transparent;

    border: 1px solid transparent;
    border-radius: 8px;

    font-family: inherit;
    text-decoration: none;

    cursor: pointer;

    transition:
        color 0.2s ease,
        background-color 0.2s ease,
        border-color 0.2s ease;
}

.classwork-topic-toggle i {
    font-size: 20px;
}

.classwork-topic-menu i {
    font-size: 19px;
}

.classwork-topic-toggle:hover,
.classwork-topic-menu:hover {
    color: var(--heading-color);
    background-color: var(--surface-hover);
    border-color: var(--border-color);
}


/* ============================================================
   TOPIC OPTIONS DROPDOWN
   ============================================================ */

.classwork-topic-options {
    position: relative;
    flex-shrink: 0;
}

.classwork-topic-options-dropdown {
    position: absolute;
    top: calc(100% + 5px);
    right: 0;
    z-index: 100;

    min-width: 125px;
    padding: 5px;

    background-color: var(--card-color);
    border: 1px solid var(--border-color);
    border-radius: 10px;
    box-shadow: 0 10px 25px var(--shadow-color);

    opacity: 0;
    visibility: hidden;
    pointer-events: none;

    transform: translateY(-4px);

    transition:
        opacity 0.15s ease,
        visibility 0.15s ease,
        transform 0.15s ease;
}

.classwork-topic-options.show .classwork-topic-options-dropdown {
    opacity: 1;
    visibility: visible;
    pointer-events: auto;
    transform: translateY(0);
}

.classwork-topic-option {
    display: flex;
    align-items: center;
    gap: 8px;

    width: 100%;
    min-height: 33px;
    padding: 0 9px;

    color: var(--heading-color);
    background-color: transparent;

    border: 0;
    border-radius: 7px;

    font-family: inherit;
    font-size: 11px;
    font-weight: 600;

    text-align: left;
    cursor: pointer;
}

.classwork-topic-option:hover {
    background-color: var(--surface-hover);
}

.classwork-topic-option i {
    font-size: 15px;
}

.classwork-topic-option.delete {
    color: #dc5c5c;
}

.classwork-topic-option.delete:hover {
    color: #c84747;
    background-color: rgba(220, 92, 92, 0.08);
}


/* ============================================================
   TOPIC DELETE MODAL
   ============================================================ */

.topic-delete-modal {
    position: fixed;
    inset: 0;
    z-index: 1300;

    display: flex;
    align-items: center;
    justify-content: center;

    padding: 20px;
    box-sizing: border-box;

    opacity: 0;
    visibility: hidden;
    pointer-events: none;

    transition:
        opacity 0.2s ease,
        visibility 0.2s ease;
}

.topic-delete-modal.show {
    opacity: 1;
    visibility: visible;
    pointer-events: auto;
}

.topic-delete-modal-overlay {
    position: absolute;
    inset: 0;
    background-color: rgba(0, 0, 0, 0.45);
    backdrop-filter: blur(3px);
}

.topic-delete-dialog {
    position: relative;
    z-index: 2;

    width: 100%;
    max-width: 520px;

    padding: 0;
    box-sizing: border-box;

    background-color: var(--card-color);
    border: 1px solid var(--border-color);
    border-radius: 17px;
    box-shadow: 0 20px 50px var(--shadow-color);

    transform: translateY(10px) scale(0.98);
    transition: transform 0.2s ease;
}

.topic-delete-modal.show .topic-delete-dialog {
    transform: translateY(0) scale(1);
}

.topic-delete-header {
    display: flex;
    align-items: flex-start;
    justify-content: space-between;
    gap: 18px;

    padding: 23px 24px 18px;
    border-bottom: 1px solid var(--border-color);
}

.topic-delete-header-content {
    min-width: 0;
}

.topic-delete-eyebrow {
    display: block;
    margin-bottom: 5px;
    color: #dc5c5c;
    font-size: 9px;
    font-weight: 800;
    letter-spacing: 1.3px;
}

.topic-delete-header h2 {
    margin: 0 0 5px;
    color: var(--heading-color);
    font-size: 19px;
    font-weight: 800;
}

.topic-delete-header p {
    margin: 0;
    color: var(--secondary-text-color);
    font-size: 11px;
    line-height: 1.5;
}

.topic-delete-close {
    display: flex;
    align-items: center;
    justify-content: center;

    width: 35px;
    height: 35px;
    flex-shrink: 0;
    padding: 0;

    color: var(--secondary-text-color);
    background-color: transparent;
    border: 1px solid var(--border-color);
    border-radius: 9px;
    cursor: pointer;
}

.topic-delete-close:hover {
    color: var(--heading-color);
    background-color: var(--surface-hover);
}

.topic-delete-body {
    padding: 20px 24px 8px;
}

.topic-delete-option {
    display: block;
    margin-bottom: 10px;
    cursor: pointer;
}

.topic-delete-option input {
    position: absolute;
    opacity: 0;
    pointer-events: none;
}

.topic-delete-option-content {
    display: flex;
    align-items: flex-start;
    gap: 11px;

    padding: 13px;
    border: 1px solid var(--border-color);
    border-radius: 11px;
    background-color: var(--surface-color);

    transition:
        border-color 0.2s ease,
        background-color 0.2s ease;
}

.topic-delete-option:hover .topic-delete-option-content {
    border-color: var(--primary-border);
}

.topic-delete-option input:checked + .topic-delete-option-content {
    border-color: var(--button-color);
    background-color: var(--topic-soft);
}

.topic-delete-option-icon {
    display: flex;
    align-items: center;
    justify-content: center;

    width: 36px;
    height: 36px;
    flex-shrink: 0;

    color: var(--topic-color);
    background-color: var(--topic-soft);
    border-radius: 9px;
    font-size: 17px;
}

.topic-delete-option-danger .topic-delete-option-icon {
    color: #dc5c5c;
    background-color: rgba(220, 92, 92, 0.10);
}

.topic-delete-option-text {
    min-width: 0;
}

.topic-delete-option-text strong {
    display: block;
    margin-bottom: 3px;
    color: var(--heading-color);
    font-size: 12px;
    font-weight: 800;
}

.topic-delete-option-text span {
    display: block;
    color: var(--secondary-text-color);
    font-size: 10px;
    line-height: 1.5;
}

.topic-delete-footer {
    display: flex;
    justify-content: flex-end;
    gap: 8px;
    padding: 14px 24px 21px;
}

.topic-delete-button {
    min-width: 90px;
    min-height: 36px;
    padding: 0 14px;

    border-radius: 9px;
    font-family: inherit;
    font-size: 11px;
    font-weight: 700;
    cursor: pointer;
}

.topic-delete-button.cancel {
    color: var(--heading-color);
    background-color: transparent;
    border: 1px solid var(--border-color);
}

.topic-delete-button.cancel:hover {
    background-color: var(--surface-hover);
}

.topic-delete-button.confirm {
    color: #ffffff;
    background-color: #dc5c5c;
    border: 1px solid #dc5c5c;
}

.topic-delete-button.confirm:hover {
    background-color: #c84747;
    border-color: #c84747;
}

@media (max-width: 600px) {
    .topic-delete-modal {
        padding: 12px;
    }

    .topic-delete-header {
        padding: 20px;
    }

    .topic-delete-body {
        padding: 18px 20px 6px;
    }

    .topic-delete-footer {
        padding: 12px 20px 18px;
    }
}


/* ============================================================
   CLASSWORK ITEMS
   ============================================================ */

.classwork-topic-items {
    padding: 0 10px 10px;
}

.classwork-item {
    position: relative;

    display: flex;
    align-items: center;

    min-height: 64px;

    padding: 8px 8px 8px 10px;

    box-sizing: border-box;

    border-top: 1px solid var(--border-color);

    transition:
        background-color 0.2s ease,
        padding-left 0.2s ease;
}

.classwork-item:hover {
    background-color: var(--surface-color);
    padding-left: 13px;
}


/* ============================================================
   ITEM ICON
   ============================================================ */

.classwork-item-icon {
    display: flex;
    align-items: center;
    justify-content: center;

    width: 38px;
    height: 38px;

    margin-right: 12px;

    flex-shrink: 0;

    border-radius: 10px;

    font-size: 18px;
}

.classwork-item-icon.material {
    color: var(--material-color);
    background-color: var(--material-soft);
}

.classwork-item-icon.assignment {
    color: var(--assignment-color);
    background-color: var(--assignment-soft);
}

.classwork-item-icon.quiz {
    color: var(--quiz-color);
    background-color: var(--quiz-soft);
}

.classwork-item-icon.exam {
    color: var(--exam-color);
    background-color: var(--exam-soft);
}

.classwork-item-icon.project {
    color: var(--project-color);
    background-color: var(--project-soft);
}


/* ============================================================
   ITEM CONTENT
   ============================================================ */

.classwork-item-content {
    min-width: 0;
    flex: 1;
}

.classwork-item-content h3 {
    margin: 0;

    color: var(--heading-color);

    font-size: 13px;
    font-weight: 700;
    line-height: 1.35;

    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}

.classwork-item-content p {
    display: flex;
    align-items: center;
    gap: 6px;

    margin: 4px 0 0;

    font-size: 10px;
    line-height: 1.3;
}

.classwork-item-type {
    font-weight: 700;
}

.classwork-item-type.material {
    color: var(--material-color);
}

.classwork-item-type.assignment {
    color: var(--assignment-color);
}

.classwork-item-type.quiz {
    color: var(--quiz-color);
}

.classwork-item-type.exam {
    color: var(--exam-color);
}

.classwork-item-type.project {
    color: var(--project-color);
}

.classwork-item-separator {
    color: var(--border-color);
}

.classwork-item-date {
    color: var(--classwork-date-color);
    font-weight: 500;
}


/* ============================================================
   ITEM MENU
   ============================================================ */

.classwork-item-menu {
    display: flex;
    align-items: center;
    justify-content: center;

    width: 32px;
    height: 32px;

    margin-left: 8px;
    padding: 0;

    flex-shrink: 0;

    color: var(--secondary-text-color);
    background-color: transparent;

    border: 1px solid transparent;
    border-radius: 8px;

    cursor: pointer;

    transition:
        color 0.2s ease,
        background-color 0.2s ease,
        border-color 0.2s ease;
}

.classwork-item-menu i {
    font-size: 18px;
}

.classwork-item-menu:hover {
    color: var(--heading-color);
    background-color: var(--surface-hover);
    border-color: var(--border-color);
}

.classwork-item-options {
    position: relative;
    flex-shrink: 0;
    margin-left: 8px;
}

.classwork-item-options-dropdown {
    position: absolute;
    top: calc(100% + 5px);
    right: 0;
    z-index: 100;
    min-width: 125px;
    padding: 5px;

    background-color: var(--card-color);
    border: 1px solid var(--border-color);
    border-radius: 10px;
    box-shadow: 0 10px 25px var(--shadow-color);

    opacity: 0;
    visibility: hidden;
    pointer-events: none;

    transform: translateY(-4px);

    transition:
        opacity 0.15s ease,
        visibility 0.15s ease,
        transform 0.15s ease;
}

.classwork-item-options.show .classwork-item-options-dropdown {
    opacity: 1;
    visibility: visible;
    pointer-events: auto;
    transform: translateY(0);
}

.classwork-item-option {
    display: flex;
    align-items: center;
    gap: 8px;

    width: 100%;
    min-height: 33px;
    padding: 0 9px;

    color: var(--heading-color);
    background-color: transparent;

    border: 0;
    border-radius: 7px;

    font-family: inherit;
    font-size: 11px;
    font-weight: 600;

    text-align: left;
    cursor: pointer;
}

.classwork-item-option:hover {
    background-color: var(--surface-hover);
}

.classwork-item-option i {
    font-size: 15px;
}

.classwork-item-option.delete {
    color: #dc5c5c;
}

.classwork-item-option.delete:hover {
    color: #c84747;
    background-color: rgba(220, 92, 92, 0.08);
}



/* ============================================================
   EMPTY TOPIC
   ============================================================ */

.classwork-topic-empty {
    display: flex;
    align-items: center;
    gap: 8px;

    min-height: 48px;

    padding: 8px 10px;

    color: var(--secondary-text-color);

    font-size: 11px;
}

.classwork-topic-empty i {
    color: var(--topic-color);
    font-size: 17px;
}


/* ============================================================
   EMPTY PAGE
   ============================================================ */

.classwork-empty {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;

    min-height: 260px;

    padding: 30px;

    box-sizing: border-box;

    text-align: center;

    background-color: var(--card-color);

    border: 1px solid var(--border-color);
    border-radius: 14px;
}

.classwork-empty-icon {
    display: flex;
    align-items: center;
    justify-content: center;

    width: 52px;
    height: 52px;

    margin-bottom: 12px;

    color: var(--topic-color);
    background-color: var(--topic-soft);

    border-radius: 13px;

    font-size: 26px;
}

.classwork-empty h2 {
    margin: 0;

    color: var(--heading-color);

    font-size: 17px;
    font-weight: 800;
}

.classwork-empty p {
    max-width: 420px;

    margin: 7px 0 0;

    color: var(--secondary-text-color);

    font-size: 12px;
    line-height: 1.6;
}


/* ============================================================
   CREATE CLASSWORK MODAL
   ============================================================ */

.classwork-modal {
    position: fixed;
    inset: 0;

    z-index: 1200;

    display: flex;
    align-items: center;
    justify-content: center;

    padding: 20px;

    box-sizing: border-box;

    opacity: 0;
    visibility: hidden;
    pointer-events: none;

    transition:
        opacity 0.2s ease,
        visibility 0.2s ease;
}

.classwork-modal.show {
    opacity: 1;
    visibility: visible;
    pointer-events: auto;
}

.classwork-modal-overlay {
    position: absolute;
    inset: 0;

    background-color: rgba(0, 0, 0, 0.45);

    backdrop-filter: blur(3px);
}

.classwork-modal-dialog {
    position: relative;
    z-index: 2;

    width: 100%;
    max-width: 620px;

    max-height: calc(100vh - 40px);

    overflow-y: auto;

    padding: 0;

    box-sizing: border-box;

    background-color: var(--card-color);

    border: 1px solid var(--border-color);
    border-radius: 17px;

    box-shadow: 0 20px 50px var(--shadow-color);

    transform: translateY(10px) scale(0.98);

    transition: transform 0.2s ease;
}

.classwork-modal.show .classwork-modal-dialog {
    transform: translateY(0) scale(1);
}


/* ============================================================
   MODAL HEADER
   ============================================================ */

.classwork-modal-header {
    display: flex;
    align-items: flex-start;
    justify-content: space-between;

    gap: 20px;

    padding: 24px 25px 20px;

    border-bottom: 1px solid var(--border-color);
}

.classwork-modal-header > div {
    min-width: 0;
}

.classwork-modal-eyebrow {
    display: block;

    margin-bottom: 5px;

    color: var(--button-color);

    font-size: 9px;
    font-weight: 800;
    letter-spacing: 1.3px;
}

.classwork-modal-header h2 {
    margin: 0 0 5px;

    color: var(--heading-color);

    font-size: 20px;
    font-weight: 800;
}

.classwork-modal-header p {
    margin: 0;

    color: var(--secondary-text-color);

    font-size: 11px;
    line-height: 1.5;
}

.classwork-modal-close {
    display: flex;
    align-items: center;
    justify-content: center;

    width: 35px;
    height: 35px;

    flex-shrink: 0;

    padding: 0;

    color: var(--secondary-text-color);
    background-color: transparent;

    border: 1px solid var(--border-color);
    border-radius: 9px;

    cursor: pointer;

    transition:
        color 0.2s ease,
        background-color 0.2s ease;
}

.classwork-modal-close i {
    font-size: 20px;
}

.classwork-modal-close:hover {
    color: var(--heading-color);
    background-color: var(--surface-hover);
}


/* ============================================================
   CLASSWORK TYPE GRID
   ============================================================ */

.classwork-type-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 10px;

    padding: 20px 25px 25px;
}

.classwork-type-card {
    display: flex;
    align-items: center;
    gap: 11px;

    min-height: 100px;

    padding: 13px;

    box-sizing: border-box;

    color: var(--heading-color);
    background-color: var(--surface-color);

    border: 1px solid var(--border-color);
    border-radius: 11px;

    text-decoration: none;

    transition:
        border-color 0.2s ease,
        background-color 0.2s ease,
        transform 0.2s ease;
}

.classwork-type-card:hover {
    background-color: var(--card-color);
    transform: translateY(-2px);
}

.classwork-type-card.material:hover {
    border-color: var(--material-color);
}

.classwork-type-card.assignment:hover {
    border-color: var(--assignment-color);
}

.classwork-type-card.quiz:hover {
    border-color: var(--quiz-color);
}

.classwork-type-card.exam:hover {
    border-color: var(--exam-color);
}

.classwork-type-card.project:hover {
    border-color: var(--project-color);
}

.classwork-type-icon {
    display: flex;
    align-items: center;
    justify-content: center;

    width: 40px;
    height: 40px;

    flex-shrink: 0;

    border-radius: 10px;

    font-size: 19px;
}

.classwork-type-icon.material {
    color: var(--material-color);
    background-color: var(--material-soft);
}

.classwork-type-icon.assignment {
    color: var(--assignment-color);
    background-color: var(--assignment-soft);
}

.classwork-type-icon.quiz {
    color: var(--quiz-color);
    background-color: var(--quiz-soft);
}

.classwork-type-icon.exam {
    color: var(--exam-color);
    background-color: var(--exam-soft);
}

.classwork-type-icon.project {
    color: var(--project-color);
    background-color: var(--project-soft);
}

.classwork-type-content {
    display: flex;
    flex-direction: column;
    gap: 3px;

    min-width: 0;
    flex: 1;
}

.classwork-type-content strong {
    color: var(--heading-color);

    font-size: 13px;
    font-weight: 800;
}

.classwork-type-content small {
    color: var(--secondary-text-color);

    font-size: 10px;
    line-height: 1.45;
}

.classwork-type-arrow {
    flex-shrink: 0;

    color: var(--secondary-text-color);

    font-size: 17px;

    transition:
        color 0.2s ease,
        transform 0.2s ease;
}

.classwork-type-card:hover .classwork-type-arrow {
    color: var(--heading-color);
    transform: translateX(3px);
}


/* ============================================================
   RESPONSIVE
   ============================================================ */

@media (max-width: 800px) {

    .classwork-header-row {
        grid-template-columns: 1fr;
    }

    .classwork-header-actions {
        display: grid;
        grid-template-columns: 1fr 1fr;
    }

    .classwork-header-action {
        min-height: 65px;
    }
}


@media (max-width: 600px) {

    .classwork-header {
        min-height: 145px;
        padding: 20px;
    }

    .classwork-header-illustration {
        width: 120px;
        height: 100px;
        margin-left: 10px;
    }

    .classwork-illustration-circle {
        width: 85px;
        height: 85px;
    }

    .classwork-header h1 {
        font-size: 22px;
    }

    .classwork-header p {
        font-size: 12px;
    }

    .classwork-type-grid {
        grid-template-columns: 1fr;
    }

    .classwork-modal {
        padding: 12px;
    }

    .classwork-modal-dialog {
        max-height: calc(100vh - 24px);
    }

    .classwork-modal-header {
        padding: 20px;
    }

    .classwork-type-grid {
        padding: 17px 20px 20px;
    }
}


@media (max-width: 480px) {

    .classwork-header-illustration {
        display: none;
    }

    .classwork-header-actions {
        grid-template-columns: 1fr;
    }

    .classwork-filter-item {
        min-width: 78px;
        padding: 0 10px;
    }

    .classwork-topic-header {
        min-height: 62px;
        padding-left: 11px;
    }

    .classwork-topic-icon {
        width: 35px;
        height: 35px;
    }

    .classwork-topic-text h2 {
        font-size: 14px;
    }

    .classwork-item {
        min-height: 60px;
    }

    .classwork-item-icon {
        width: 35px;
        height: 35px;
        margin-right: 9px;
    }

    .classwork-item-content h3 {
        font-size: 12px;
    }

    .classwork-item-content p {
        font-size: 9px;
    }
}

</style>

@extends('layouts.prof_layout')

@section('title', 'Classwork')

@section('content')

<div class="classwork-page">

    @include('professor.class_groups.classroom_group.navigation')

    {{-- ============================================================
         CLASSWORK HEADER
         ============================================================ --}}

    <div class="classwork-header-row">

        <section class="classwork-header">

            <div class="classwork-header-content">

                <span class="classwork-eyebrow">
                    CLASSWORK
                </span>

                <h1>Classwork</h1>

                <p>
                    Manage and organize learning materials and activities
                    for {{ $classGroup->group_name }}.
                </p>

            </div>

            <div class="classwork-header-illustration">

                <div class="classwork-illustration-circle"></div>

                <div class="classwork-illustration-icon illustration-book">
                    <i class="bx bx-book-open"></i>
                </div>

                <div class="classwork-illustration-icon illustration-assignment">
                    <i class="bx bx-task"></i>
                </div>

                <div class="classwork-illustration-icon illustration-pencil">
                    <i class="bx bx-edit"></i>
                </div>

                <div class="classwork-illustration-icon illustration-check">
                    <i class="bx bx-check-circle"></i>
                </div>

                <div class="classwork-document">
                    <div class="document-line document-line-one"></div>
                    <div class="document-line document-line-two"></div>
                    <div class="document-line document-line-three"></div>

                    <div class="document-check">
                        <i class="bx bx-check"></i>
                    </div>
                </div>

            </div>

        </section>


        <div class="classwork-header-actions">

            <button
                type="button"
                class="classwork-header-action"
                id="openClassworkModal"
            >
                <i class="bx bx-plus-circle"></i>

                <span>Create Classwork</span>

                <i class="bx bx-chevron-right action-arrow"></i>
            </button>


            <a
                href="{{ route(
                    'professor.class-groups.classroom-group.classwork.topics.create',
                    ['classGroup' => $classGroup->id]
                ) }}"
                class="classwork-header-action"
            >
                <i class="bx bx-folder-plus"></i>

                <span>Create Topic</span>

                <i class="bx bx-chevron-right action-arrow"></i>
            </a>

        </div>

    </div>


    {{-- ============================================================
         FILTER
         ============================================================ --}}

    <nav class="classwork-filter">

        <button
            type="button"
            class="classwork-filter-item active"
            data-filter="all"
        >
            <i class="bx bx-grid-alt"></i>
            <span>All</span>
        </button>

        <button
            type="button"
            class="classwork-filter-item"
            data-filter="materials"
        >
            <i class="bx bx-book-open"></i>
            <span>Materials</span>
        </button>

        <button
            type="button"
            class="classwork-filter-item"
            data-filter="assignments"
        >
            <i class="bx bx-task"></i>
            <span>Assignments</span>
        </button>

        <button
            type="button"
            class="classwork-filter-item"
            data-filter="quiz"
        >
            <i class="bx bx-help-circle"></i>
            <span>Quiz</span>
        </button>

        <button
            type="button"
            class="classwork-filter-item"
            data-filter="exam"
        >
            <i class="bx bx-edit"></i>
            <span>Exam</span>
        </button>

        <button
            type="button"
            class="classwork-filter-item"
            data-filter="project"
        >
            <i class="bx bx-group"></i>
            <span>Project</span>
        </button>

    </nav>


    {{-- ============================================================
         CLASSWORK CONTENT
         ============================================================ --}}

    <main class="classwork-content">

        {{-- ========================================================
             TOPICS
             ======================================================== --}}

        @foreach($classGroup->topics as $topic)

            @php
                $hasClasswork =
                    $topic->materials->count() ||
                    $topic->assignments->count() ||
                    $topic->quizzes->count() ||
                    $topic->exams->count() ||
                    $topic->projects->count();
            @endphp

            <section class="classwork-topic">

                {{-- TOPIC HEADER --}}

                <div
                    class="classwork-topic-header"
                    data-topic-toggle
                >

                    <div class="classwork-topic-info">

                        <div class="classwork-topic-icon">
                            <i class="bx bx-folder"></i>
                        </div>

                        <div class="classwork-topic-text">

                            <h2>
                                {{ $topic->topic_name }}
                            </h2>

                            @if($topic->description)
                                <p>
                                    {{ $topic->description }}
                                </p>
                            @endif

                        </div>

                    </div>


                    <div class="classwork-topic-actions">

                        <button
                            type="button"
                            class="classwork-topic-toggle"
                            aria-label="Toggle topic"
                            aria-expanded="true"
                        >
                            <i class="bx bx-chevron-up"></i>
                        </button>

                        <span class="classwork-topic-options">

                            <button
                                type="button"
                                class="classwork-topic-menu classwork-topic-options-button"
                                aria-label="Topic options"
                                data-edit-url="{{ route(
                                    'professor.class-groups.classroom-group.classwork.topics.edit',
                                    [
                                        'classGroup' => $classGroup->id,
                                        'topic' => $topic->id,
                                    ]
                                ) }}"
                                data-delete-url="{{ route(
                                    'professor.class-groups.classroom-group.classwork.topics.destroy',
                                    [
                                        'classGroup' => $classGroup->id,
                                        'topic' => $topic->id,
                                    ]
                                ) }}"
                                data-topic-name="{{ $topic->topic_name }}"
                                data-classwork-count="{{ $topic->materials->count() + $topic->assignments->count() + $topic->quizzes->count() + $topic->exams->count() + $topic->projects->count() }}"
                            >
                                <i class="bx bx-dots-vertical-rounded"></i>
                            </button>

                            <span class="classwork-topic-options-dropdown">

                                <button
                                    type="button"
                                    class="classwork-topic-option"
                                    data-action="edit"
                                >
                                    <i class="bx bx-edit"></i>
                                    <span>Edit</span>
                                </button>

                                <button
                                    type="button"
                                    class="classwork-topic-option delete"
                                    data-action="delete"
                                >
                                    <i class="bx bx-trash"></i>
                                    <span>Delete</span>
                                </button>

                            </span>

                        </span>

                    </div>

                </div>


            {{-- CLASSWORK INSIDE TOPIC --}}
            <div class="classwork-topic-items">

                {{-- MATERIALS --}}
                @foreach($topic->materials as $material)
                <a
                    href="{{ route(
                        'professor.class-groups.materials.show',
                        [
                            'classGroup' => $classGroup->id,
                            'material' => $material->id,
                            'return_to' => 'classwork',
                        ]
                    ) }}"
                    class="classwork-item material"
                    data-classwork-type="materials"
                >

                        <div class="classwork-item-icon material">
                            <i class="bx bx-book-open"></i>
                        </div>

                        <div class="classwork-item-content">

                            <h3>
                                {{ $material->title }}
                            </h3>

                            <p>
                                <span class="classwork-item-type material">
                                    Material
                                </span>

                                <span class="classwork-item-separator">
                                    •
                                </span>

                                <span class="classwork-item-date">
                                    {{ $material->created_at->format('M d, Y') }}
                                </span>
                            </p>

                        </div>

                        <span
                            class="classwork-item-options"
                        >
                            <button
                                type="button"
                                class="classwork-item-menu classwork-item-options-button"
                                aria-label="Material options"
                                data-edit-url="{{ route(
                                    'professor.class-groups.materials.edit',
                                    [
                                        'classGroup' => $classGroup,
                                        'material' => $material,
                                        'return_to' => 'classwork',
                                    ]
                                ) }}"
                                data-delete-url="{{ route(
                                    'professor.class-groups.materials.destroy',
                                    [
                                        'classGroup' => $classGroup,
                                        'material' => $material,
                                    ]
                                ) }}"
                            >
                                <i class="bx bx-dots-vertical-rounded"></i>
                            </button>

                            <span class="classwork-item-options-dropdown">

                                <button
                                    type="button"
                                    class="classwork-item-option"
                                    data-action="edit"
                                >
                                    <i class="bx bx-edit"></i>
                                    <span>Edit</span>
                                </button>

                                <button
                                    type="button"
                                    class="classwork-item-option delete"
                                    data-action="delete"
                                >
                                    <i class="bx bx-trash"></i>
                                    <span>Delete</span>
                                </button>

                            </span>
                        </span>

                    </a>

                @endforeach


                {{-- ASSIGNMENTS --}}
                @foreach($topic->assignments as $assignment)


                                        <a
                    href="{{ route(
                        'professor.class-groups.assignments.show',
                        [
                            'classGroup' => $classGroup->id,
                            'assignment' => $assignment->id,
                            'return_to' => 'classwork',
                        ]
                    ) }}"
                    class="classwork-item assignment"
                    data-classwork-type="assignments"
                >

                        <div class="classwork-item-icon assignment">
                            <i class="bx bx-task"></i>
                        </div>

                        <div class="classwork-item-content">

                            <h3>
                                {{ $assignment->title }}
                            </h3>

                            <p>
                                <span class="classwork-item-type assignment">
                                    Assignment
                                </span>

                                <span class="classwork-item-separator">
                                    •
                                </span>

                                <span class="classwork-item-date">
                                    {{ $assignment->created_at->format('M d, Y') }}
                                </span>
                            </p>

                        </div>

                        <span
                            class="classwork-item-options"
                        >
                            <button
                                type="button"
                                class="classwork-item-menu classwork-item-options-button"
                                aria-label="Assignment options"
                                data-edit-url="{{ route(
                                    'professor.class-groups.assignments.edit',
                                    [
                                        'classGroup' => $classGroup,
                                        'assignment' => $assignment,
                                        'return_to' => 'classwork',
                                    ]
                                ) }}"
                                data-delete-url="{{ route(
                                    'professor.class-groups.assignments.destroy',
                                    [
                                        'classGroup' => $classGroup,
                                        'assignment' => $assignment,
                                    ]
                                ) }}"
                            >
                                <i class="bx bx-dots-vertical-rounded"></i>
                            </button>

                            <span class="classwork-item-options-dropdown">

                                <button
                                    type="button"
                                    class="classwork-item-option"
                                    data-action="edit"
                                >
                                    <i class="bx bx-edit"></i>
                                    <span>Edit</span>
                                </button>

                                <button
                                    type="button"
                                    class="classwork-item-option delete"
                                    data-action="delete"
                                >
                                    <i class="bx bx-trash"></i>
                                    <span>Delete</span>
                                </button>

                            </span>
                        </span>

                    </a>

                @endforeach


                {{-- QUIZZES --}}

                @foreach($topic->quizzes as $quiz)

                    <a
                        href="{{ route(
                            'professor.class-groups.quizzes.show',
                            [
                                'classGroup' => $classGroup->id,
                                'quiz' => $quiz->id,
                                'return_to' => 'classwork',
                            ]
                        ) }}"
                        class="classwork-item quiz"
                        data-classwork-type="quiz"
                    >

                        <div class="classwork-item-icon quiz">

                            <i class="bx bx-help-circle"></i>

                        </div>


                        <div class="classwork-item-content">

                            <h3>
                                {{ $quiz->title }}
                            </h3>

                            <p>

                                <span class="classwork-item-type quiz">
                                    Quiz
                                </span>

                                <span class="classwork-item-separator">
                                    •
                                </span>

                                <span class="classwork-item-date">
                                    {{ $quiz->created_at->format('M d, Y') }}
                                </span>

                            </p>

                        </div>


                        <span class="classwork-item-options">

                            <button
                                type="button"
                                class="classwork-item-menu classwork-item-options-button"
                                aria-label="Quiz options"

                                data-edit-url="{{ route(
                                    'professor.class-groups.quizzes.edit',
                                    [
                                        'classGroup' => $classGroup,
                                        'quiz' => $quiz,
                                        'return_to' => 'classwork',
                                    ]
                                ) }}"

                                data-delete-url="{{ route(
                                    'professor.class-groups.quizzes.destroy',
                                    [
                                        'classGroup' => $classGroup,
                                        'quiz' => $quiz,
                                    ]
                                ) }}"
                            >

                                <i class="bx bx-dots-vertical-rounded"></i>

                            </button>


                            <span class="classwork-item-options-dropdown">

                                <button
                                    type="button"
                                    class="classwork-item-option"
                                    data-action="edit"
                                >

                                    <i class="bx bx-edit"></i>

                                    <span>
                                        Edit
                                    </span>

                                </button>


                                <button
                                    type="button"
                                    class="classwork-item-option delete"
                                    data-action="delete"
                                >

                                    <i class="bx bx-trash"></i>

                                    <span>
                                        Delete
                                    </span>

                                </button>

                            </span>

                        </span>

                    </a>

                @endforeach


                {{-- EXAMS --}}
                @foreach($topic->exams as $exam)

                <a
                    href="{{ route(
                        'professor.class-groups.exams.show',
                        [
                            'classGroup' => $classGroup->id,
                            'exam' => $exam->id,
                            'return_to' => 'classwork',
                        ]
                    ) }}"
                    class="classwork-item exam"
                    data-classwork-type="exam"
                >

                        <div class="classwork-item-icon exam">
                            <i class="bx bx-edit-alt"></i>
                        </div>

                        <div class="classwork-item-content">

                            <h3>
                                {{ $exam->title }}
                            </h3>

                            <p>
                                <span class="classwork-item-type exam">
                                    Exam
                                </span>

                                <span class="classwork-item-separator">
                                    •
                                </span>

                                <span class="classwork-item-date">
                                    {{ $exam->created_at->format('M d, Y') }}
                                </span>
                            </p>

                        </div>

                        <span class="classwork-item-options">

                            <button
                                type="button"
                                class="classwork-item-menu classwork-item-options-button"
                                aria-label="Exam options"

                                data-edit-url="{{ route(
                                    'professor.class-groups.exams.edit',
                                    [
                                        'classGroup' => $classGroup,
                                        'exam' => $exam,
                                        'return_to' => 'classwork',
                                    ]
                                ) }}"

                                data-delete-url="{{ route(
                                    'professor.class-groups.exams.destroy',
                                    [
                                        'classGroup' => $classGroup,
                                        'exam' => $exam,
                                    ]
                                ) }}"
                            >

                                <i class="bx bx-dots-vertical-rounded"></i>

                            </button>


                            <span class="classwork-item-options-dropdown">

                                <button
                                    type="button"
                                    class="classwork-item-option"
                                    data-action="edit"
                                >

                                    <i class="bx bx-edit"></i>

                                    <span>
                                        Edit
                                    </span>

                                </button>


                                <button
                                    type="button"
                                    class="classwork-item-option delete"
                                    data-action="delete"
                                >

                                    <i class="bx bx-trash"></i>

                                    <span>
                                        Delete
                                    </span>

                                </button>

                            </span>

                        </span>

                    </a>

                @endforeach


                {{-- PROJECTS --}}
                @foreach($topic->projects as $project)

                        <a
                            href="{{ route(
                                'professor.classworks.projects.show',
                                [
                                    'classGroupId' => $classGroup->id,
                                    'projectId' => $project->id,
                                    'return_to' => 'classwork',
                                ]
                            ) }}"
                            class="classwork-item project"
                            data-classwork-type="project"
                        >

                        <div class="classwork-item-icon project">
                            <i class="bx bx-group"></i>
                        </div>

                        <div class="classwork-item-content">

                            <h3>
                                {{ $project->title }}
                            </h3>

                            <p>
                                <span class="classwork-item-type project">
                                    Project
                                </span>

                                <span class="classwork-item-separator">
                                    •
                                </span>

                                <span class="classwork-item-date">
                                    {{ $project->created_at->format('M d, Y') }}
                                </span>
                            </p>

                        </div>

                        <span class="classwork-item-options">

                            <button
                                type="button"
                                class="classwork-item-menu classwork-item-options-button"
                                aria-label="Project options"

                                data-edit-url="{{ route(
                                    'professor.classworks.projects.edit',
                                    [
                                        'classGroupId' => $classGroup->id,
                                        'projectId' => $project->id,
                                        'return_to' => 'show',
                                        'origin' => 'classwork',
                                    ]
                                ) }}"

                                data-delete-url="{{ route(
                                    'professor.classworks.projects.destroy',
                                    [
                                        'classGroupId' => $classGroup->id,
                                        'projectId' => $project->id,
                                    ]
                                ) }}"
                            >

                                <i class="bx bx-dots-vertical-rounded"></i>

                            </button>

                            <span class="classwork-item-options-dropdown">

                                <button
                                    type="button"
                                    class="classwork-item-option"
                                    data-action="edit"
                                >

                                    <i class="bx bx-edit"></i>

                                    <span>
                                        Edit
                                    </span>

                                </button>

                                <button
                                    type="button"
                                    class="classwork-item-option delete"
                                    data-action="delete"
                                >

                                    <i class="bx bx-trash"></i>

                                    <span>
                                        Delete
                                    </span>

                                </button>

                            </span>

                        </span>

                    </a>

                @endforeach


                @if(!$hasClasswork)

                    <div class="classwork-topic-empty">

                        <i class="bx bx-folder-open"></i>

                        <span>
                            No classwork in this topic yet.
                        </span>

                    </div>

                @endif

            </div>

            </section>

        @endforeach


        {{-- ========================================================

        if classworks has no topic 
             ======================================================== --}}

        @php

            $noTopicMaterials = $classGroup->materials
                ->whereNull('topic_id');

            $noTopicAssignments = $classGroup->assignments
                ->whereNull('topic_id');

            $noTopicQuizzes = $classGroup->quizzes
                ->whereNull('topic_id');

            $noTopicExams = $classGroup->exams
                ->whereNull('topic_id');

            /*
             * Projects are loaded separately so the existing
             * Classwork controller does not need to be changed.
             */
            $noTopicProjects = \App\Models\Project::where(
                'class_group_id',
                $classGroup->id
            )
                ->whereNull('topic_id')
                ->latest()
                ->get();

            $hasNoTopicClasswork =
                $noTopicMaterials->count() ||
                $noTopicAssignments->count() ||
                $noTopicQuizzes->count() ||
                $noTopicExams->count() ||
                $noTopicProjects->count();

        @endphp


        @if($hasNoTopicClasswork)

            <section class="classwork-topic classwork-no-topic">

                <div
                    class="classwork-topic-header"
                    data-topic-toggle
                >

                    <div class="classwork-topic-info">

                        <div class="classwork-topic-icon no-topic">
                            <i class="bx bx-folder-minus"></i>
                        </div>

                        <div class="classwork-topic-text">

                            <h2>No topic</h2>

                            <p>
                                Classwork not assigned to a topic
                            </p>

                        </div>

                    </div>

                    <div class="classwork-topic-actions">

                        <button
                            type="button"
                            class="classwork-topic-toggle"
                            aria-label="Toggle no topic"
                            aria-expanded="true"
                        >
                            <i class="bx bx-chevron-up"></i>
                        </button>

                    </div>

                </div>


                <div class="classwork-topic-items">

                    {{-- MATERIALS --}}
                    @foreach($noTopicMaterials as $material)

                        <a
                            href="{{ route(
                                'professor.class-groups.materials.show',
                                [
                                    'classGroup' => $classGroup->id,
                                    'material' => $material->id,
                                    'return_to' => 'classwork',
                                ]
                            ) }}"
                            class="classwork-item material"
                            data-classwork-type="materials"
                        >

                            <div class="classwork-item-icon material">
                                <i class="bx bx-book-open"></i>
                            </div>

                            <div class="classwork-item-content">

                                <h3>
                                    {{ $material->title }}
                                </h3>

                                <p>

                                    <span class="classwork-item-type material">
                                        Material
                                    </span>

                                    <span class="classwork-item-separator">
                                        •
                                    </span>

                                    <span class="classwork-item-date">
                                        {{ $material->created_at->format('M d, Y') }}
                                    </span>

                                </p>

                            </div>

                            <span
                            class="classwork-item-options"
                        >
                            <button
                                type="button"
                                class="classwork-item-menu classwork-item-options-button"
                                aria-label="Material options"
                                data-edit-url="{{ route(
                                    'professor.class-groups.materials.edit',
                                    [
                                        'classGroup' => $classGroup,
                                        'material' => $material,
                                        'return_to' => 'classwork',
                                    ]
                                ) }}"
                                data-delete-url="{{ route(
                                    'professor.class-groups.materials.destroy',
                                    [
                                        'classGroup' => $classGroup,
                                        'material' => $material,
                                    ]
                                ) }}"
                            >
                                <i class="bx bx-dots-vertical-rounded"></i>
                            </button>

                            <span class="classwork-item-options-dropdown">

                                <button
                                    type="button"
                                    class="classwork-item-option"
                                    data-action="edit"
                                >
                                    <i class="bx bx-edit"></i>
                                    <span>Edit</span>
                                </button>

                                <button
                                    type="button"
                                    class="classwork-item-option delete"
                                    data-action="delete"
                                >
                                    <i class="bx bx-trash"></i>
                                    <span>Delete</span>
                                </button>

                            </span>
                        </span>

                        </a>

                    @endforeach


                    {{-- ASSIGNMENTS --}}
                    @foreach($noTopicAssignments as $assignment)

                        <a
                            href="{{ route(
                                'professor.class-groups.assignments.show',
                                [
                                    'classGroup' => $classGroup->id,
                                    'assignment' => $assignment->id,
                                    'return_to' => 'classwork',
                                ]
                            ) }}"
                            class="classwork-item assignment"
                            data-classwork-type="assignments"
                        >

                            <div class="classwork-item-icon assignment">
                                <i class="bx bx-task"></i>
                            </div>

                            <div class="classwork-item-content">

                                <h3>
                                    {{ $assignment->title }}
                                </h3>

                                <p>

                                    <span class="classwork-item-type assignment">
                                        Assignment
                                    </span>

                                    <span class="classwork-item-separator">
                                        •
                                    </span>

                                    <span class="classwork-item-date">
                                        {{ $assignment->created_at->format('M d, Y') }}
                                    </span>

                                </p>

                            </div>

                            <span
                            class="classwork-item-options"
                        >
                            <button
                                type="button"
                                class="classwork-item-menu classwork-item-options-button"
                                aria-label="Assignment options"
                                data-edit-url="{{ route(
                                    'professor.class-groups.assignments.edit',
                                    [
                                        'classGroup' => $classGroup,
                                        'assignment' => $assignment,
                                        'return_to' => 'classwork',
                                    ]
                                ) }}"
                                data-delete-url="{{ route(
                                    'professor.class-groups.assignments.destroy',
                                    [
                                        'classGroup' => $classGroup,
                                        'assignment' => $assignment,
                                    ]
                                ) }}"
                            >
                                <i class="bx bx-dots-vertical-rounded"></i>
                            </button>

                            <span class="classwork-item-options-dropdown">

                                <button
                                    type="button"
                                    class="classwork-item-option"
                                    data-action="edit"
                                >
                                    <i class="bx bx-edit"></i>
                                    <span>Edit</span>
                                </button>

                                <button
                                    type="button"
                                    class="classwork-item-option delete"
                                    data-action="delete"
                                >
                                    <i class="bx bx-trash"></i>
                                    <span>Delete</span>
                                </button>

                            </span>
                        </span>

                        </a>

                    @endforeach

                    {{-- QUIZZES --}}

                    @foreach($noTopicQuizzes as $quiz)

                        <a
                            href="{{ route(
                                'professor.class-groups.quizzes.show',
                                [
                                    'classGroup' => $classGroup->id,
                                    'quiz' => $quiz->id,
                                    'return_to' => 'classwork',
                                ]
                            ) }}"
                            class="classwork-item quiz"
                            data-classwork-type="quiz"
                        >

                            <div class="classwork-item-icon quiz">
                                <i class="bx bx-help-circle"></i>
                            </div>


                            <div class="classwork-item-content">

                                <h3>
                                    {{ $quiz->title }}
                                </h3>

                                <p>

                                    <span class="classwork-item-type quiz">
                                        Quiz
                                    </span>

                                    <span class="classwork-item-separator">
                                        •
                                    </span>

                                    <span class="classwork-item-date">
                                        {{ $quiz->created_at->format('M d, Y') }}
                                    </span>

                                </p>

                            </div>


                            {{-- ====================================================
                                QUIZ OPTIONS
                            ===================================================== --}}

                            <span class="classwork-item-options">

                                <button
                                    type="button"
                                    class="classwork-item-menu classwork-item-options-button"
                                    aria-label="Quiz options"

                                    data-edit-url="{{ route(
                                        'professor.class-groups.quizzes.edit',
                                        [
                                            'classGroup' => $classGroup,
                                            'quiz' => $quiz,
                                            'return_to' => 'classwork',
                                        ]
                                    ) }}"

                                    data-delete-url="{{ route(
                                        'professor.class-groups.quizzes.destroy',
                                        [
                                            'classGroup' => $classGroup,
                                            'quiz' => $quiz,
                                        ]
                                    ) }}"
                                >

                                    <i class="bx bx-dots-vertical-rounded"></i>

                                </button>


                                <span class="classwork-item-options-dropdown">

                                    {{-- EDIT --}}

                                    <button
                                        type="button"
                                        class="classwork-item-option"
                                        data-action="edit"
                                    >

                                        <i class="bx bx-edit"></i>

                                        <span>
                                            Edit
                                        </span>

                                    </button>


                                    {{-- DELETE --}}

                                    <button
                                        type="button"
                                        class="classwork-item-option delete"
                                        data-action="delete"
                                    >

                                        <i class="bx bx-trash"></i>

                                        <span>
                                            Delete
                                        </span>

                                    </button>

                                </span>

                            </span>

                        </a>

                    @endforeach


                    {{-- EXAMS --}}
                    @foreach($noTopicExams as $exam)

                        <a
                            href="{{ route(
                                'professor.class-groups.exams.show',
                                [
                                    'classGroup' => $classGroup->id,
                                    'exam' => $exam->id,
                                    'return_to' => 'classwork',
                                ]
                            ) }}"
                            class="classwork-item exam"
                            data-classwork-type="exam"
                        >

                            <div class="classwork-item-icon exam">
                                <i class="bx bx-edit-alt"></i>
                            </div>

                            <div class="classwork-item-content">

                                <h3>
                                    {{ $exam->title }}
                                </h3>

                                <p>

                                    <span class="classwork-item-type exam">
                                        Exam
                                    </span>

                                    <span class="classwork-item-separator">
                                        •
                                    </span>

                                    <span class="classwork-item-date">
                                        {{ $exam->created_at->format('M d, Y') }}
                                    </span>

                                </p>

                            </div>

                            <span class="classwork-item-options">

                                <button
                                    type="button"
                                    class="classwork-item-menu classwork-item-options-button"
                                    aria-label="Exam options"

                                    data-edit-url="{{ route(
                                        'professor.class-groups.exams.edit',
                                        [
                                            'classGroup' => $classGroup,
                                            'exam' => $exam,
                                            'return_to' => 'classwork',
                                        ]
                                    ) }}"

                                    data-delete-url="{{ route(
                                        'professor.class-groups.exams.destroy',
                                        [
                                            'classGroup' => $classGroup,
                                            'exam' => $exam,
                                        ]
                                    ) }}"
                                >

                                    <i class="bx bx-dots-vertical-rounded"></i>

                                </button>


                                <span class="classwork-item-options-dropdown">

                                    <button
                                        type="button"
                                        class="classwork-item-option"
                                        data-action="edit"
                                    >

                                        <i class="bx bx-edit"></i>

                                        <span>
                                            Edit
                                        </span>

                                    </button>


                                    <button
                                        type="button"
                                        class="classwork-item-option delete"
                                        data-action="delete"
                                    >

                                        <i class="bx bx-trash"></i>

                                        <span>
                                            Delete
                                        </span>

                                    </button>

                                </span>

                            </span>

                        </a>

                    @endforeach


                    {{-- PROJECTS --}}
                    @foreach($noTopicProjects as $project)

                        <a
                            href="{{ route(
                                'professor.classworks.projects.show',
                                [
                                    'classGroupId' => $classGroup->id,
                                    'projectId' => $project->id,
                                    'return_to' => 'classwork',
                                ]
                            ) }}"
                            class="classwork-item project"
                            data-classwork-type="project"
                        >

                            <div class="classwork-item-icon project">
                                <i class="bx bx-group"></i>
                            </div>

                            <div class="classwork-item-content">

                                <h3>
                                    {{ $project->title }}
                                </h3>

                                <p>
                                    <span class="classwork-item-type project">
                                        Project
                                    </span>

                                    <span class="classwork-item-separator">
                                        •
                                    </span>

                                    <span class="classwork-item-date">
                                        {{ $project->created_at->format('M d, Y') }}
                                    </span>
                                </p>

                            </div>

                            <span class="classwork-item-options">

                                <button
                                    type="button"
                                    class="classwork-item-menu classwork-item-options-button"
                                    aria-label="Project options"

                                    data-edit-url="{{ route(
                                        'professor.classworks.projects.edit',
                                        [
                                            'classGroupId' => $classGroup->id,
                                            'projectId' => $project->id,
                                            'return_to' => 'show',
                                            'origin' => 'classwork',
                                        ]
                                    ) }}"

                                    data-delete-url="{{ route(
                                        'professor.classworks.projects.destroy',
                                        [
                                            'classGroupId' => $classGroup->id,
                                            'projectId' => $project->id,
                                        ]
                                    ) }}"
                                >

                                    <i class="bx bx-dots-vertical-rounded"></i>

                                </button>

                                <span class="classwork-item-options-dropdown">

                                    <button
                                        type="button"
                                        class="classwork-item-option"
                                        data-action="edit"
                                    >

                                        <i class="bx bx-edit"></i>

                                        <span>
                                            Edit
                                        </span>

                                    </button>

                                    <button
                                        type="button"
                                        class="classwork-item-option delete"
                                        data-action="delete"
                                    >

                                        <i class="bx bx-trash"></i>

                                        <span>
                                            Delete
                                        </span>

                                    </button>

                                </span>

                            </span>

                        </a>

                    @endforeach

                </div>

            </section>

        @endif


        {{-- ========================================================
             EMPTY STATE
             ======================================================== --}}

        @if(
            $classGroup->topics->count() === 0 &&
            !$hasNoTopicClasswork
        )

            <div class="classwork-empty">

                <div class="classwork-empty-icon">
                    <i class="bx bx-book-open"></i>
                </div>

                <h2>No classwork yet</h2>

                <p>
                    Create an assignment, material, quiz, or exam
                    to start building your classwork.
                </p>

            </div>

        @endif

    </main>


    {{-- ============================================================
         TOPIC DELETE MODAL
         ============================================================ --}}

    <div
        class="topic-delete-modal"
        id="topicDeleteModal"
        aria-hidden="true"
    >

        <div
            class="topic-delete-modal-overlay"
            id="topicDeleteModalOverlay"
        ></div>

        <div
            class="topic-delete-dialog"
            role="dialog"
            aria-modal="true"
            aria-labelledby="topicDeleteModalTitle"
        >

            <div class="topic-delete-header">

                <div class="topic-delete-header-content">

                    <span class="topic-delete-eyebrow">
                        DELETE TOPIC
                    </span>

                    <h2 id="topicDeleteModalTitle">
                        Delete topic?
                    </h2>

                    <p id="topicDeleteDescription">
                        Choose what should happen to the classwork inside this topic.
                    </p>

                </div>

                <button
                    type="button"
                    class="topic-delete-close"
                    id="topicDeleteClose"
                    aria-label="Close delete topic modal"
                >
                    <i class="bx bx-x"></i>
                </button>

            </div>

            <form
                id="topicDeleteForm"
                method="POST"
            >

                @csrf
                @method('DELETE')

                <div class="topic-delete-body">

                    <label class="topic-delete-option">

                        <input
                            type="radio"
                            name="delete_option"
                            value="topic_only"
                            checked
                        >

                        <span class="topic-delete-option-content">

                            <span class="topic-delete-option-icon">
                                <i class="bx bx-folder-minus"></i>
                            </span>

                            <span class="topic-delete-option-text">
                                <strong>
                                    Delete topic only
                                </strong>

                                <span>
                                    Keep all classwork and move it to No Topic.
                                </span>
                            </span>

                        </span>

                    </label>

                    <label class="topic-delete-option topic-delete-option-danger">

                        <input
                            type="radio"
                            name="delete_option"
                            value="topic_and_classwork"
                        >

                        <span class="topic-delete-option-content">

                            <span class="topic-delete-option-icon">
                                <i class="bx bx-trash"></i>
                            </span>

                            <span class="topic-delete-option-text">
                                <strong>
                                    Delete topic and all classwork
                                </strong>

                                <span>
                                    Permanently delete the topic and every classwork item inside it.
                                </span>
                            </span>

                        </span>

                    </label>

                </div>

                <div class="topic-delete-footer">

                    <button
                        type="button"
                        class="topic-delete-button cancel"
                        id="topicDeleteCancel"
                    >
                        Cancel
                    </button>

                    <button
                        type="submit"
                        class="topic-delete-button confirm"
                    >
                        Delete
                    </button>

                </div>

            </form>

        </div>

    </div>


    {{-- ============================================================
         CREATE CLASSWORK MODAL
         ============================================================ --}}

    <div
        class="classwork-modal"
        id="classworkModal"
        aria-hidden="true"
    >

        <div
            class="classwork-modal-overlay"
            id="classworkModalOverlay"
        ></div>

        <div
            class="classwork-modal-dialog"
            role="dialog"
            aria-modal="true"
            aria-labelledby="classworkModalTitle"
        >

            <div class="classwork-modal-header">

                <div>

                    <span class="classwork-modal-eyebrow">
                        CREATE
                    </span>

                    <h2 id="classworkModalTitle">
                        Create Classwork
                    </h2>

                    <p>
                        Choose what you would like to create for
                        {{ $classGroup->group_name }}.
                    </p>

                </div>

                <button
                    type="button"
                    class="classwork-modal-close"
                    id="closeClassworkModal"
                    aria-label="Close"
                >
                    <i class="bx bx-x"></i>
                </button>

            </div>


            <div class="classwork-type-grid">

                {{-- MATERIAL --}}

                <a
                    href="{{ route(
                        'professor.class-groups.materials.create',
                        ['classGroup' => $classGroup->id]
                    ) }}"
                    class="classwork-type-card material"
                >

                    <span class="classwork-type-icon material">
                        <i class="bx bx-book-open"></i>
                    </span>

                    <span class="classwork-type-content">

                        <strong>Material</strong>

                        <small>
                            Share books, files, links, or other
                            learning resources.
                        </small>

                    </span>

                    <i class="bx bx-chevron-right classwork-type-arrow"></i>

                </a>


                {{-- ASSIGNMENT --}}

                <a
                    href="{{ route(
                        'professor.class-groups.assignments.create',
                        ['classGroup' => $classGroup->id]
                    ) }}"
                    class="classwork-type-card assignment"
                >

                    <span class="classwork-type-icon assignment">
                        <i class="bx bx-task"></i>
                    </span>

                    <span class="classwork-type-content">

                        <strong>Assignment</strong>

                        <small>
                            Give students work with a deadline
                            and points.
                        </small>

                    </span>

                    <i class="bx bx-chevron-right classwork-type-arrow"></i>

                </a>


                {{-- QUIZ --}}

                <a
                    href="{{ route(
                        'professor.class-groups.quizzes.create',
                        ['classGroup' => $classGroup->id]
                    ) }}"
                    class="classwork-type-card quiz"
                >

                    <span class="classwork-type-icon quiz">
                        <i class="bx bx-help-circle"></i>
                    </span>

                    <span class="classwork-type-content">

                        <strong>Quiz</strong>

                        <small>
                            Create questions to check students'
                            understanding.
                        </small>

                    </span>

                    <i class="bx bx-chevron-right classwork-type-arrow"></i>

                </a>


                {{-- EXAM --}}

                <a
                    href="{{ route(
                        'professor.class-groups.exams.create',
                        ['classGroup' => $classGroup->id]
                    ) }}"
                    class="classwork-type-card exam"
                >

                    <span class="classwork-type-icon exam">
                        <i class="bx bx-edit"></i>
                    </span>

                    <span class="classwork-type-content">

                        <strong>Exam</strong>

                        <small>
                            Create a larger assessment covering
                            multiple topics.
                        </small>

                    </span>

                    <i class="bx bx-chevron-right classwork-type-arrow"></i>

                </a>


                {{-- PROJECT --}}

                <a
                    href="{{ route(
                        'professor.classworks.projects.create',
                        ['classGroupId' => $classGroup->id]
                    ) }}"
                    class="classwork-type-card project"
                >

                    <span class="classwork-type-icon project">
                        <i class="bx bx-group"></i>
                    </span>

                    <span class="classwork-type-content">

                        <strong>Project</strong>

                        <small>
                            Create an individual or team project for students.
                        </small>

                    </span>

                    <i class="bx bx-chevron-right classwork-type-arrow"></i>

                </a>

            </div>

        </div>

    </div>

</div>


{{-- ============================================================
     JAVASCRIPT
     ============================================================ --}}

<script>
document.addEventListener('DOMContentLoaded', function () {

    /* ============================================================
       CLASSWORK FILTER
       ============================================================ */

    const filterButtons = document.querySelectorAll(
        '.classwork-filter-item'
    );

    const classworkItems = document.querySelectorAll(
        '.classwork-item'
    );


    filterButtons.forEach(function (button) {

        button.addEventListener('click', function () {

            const filter = this.dataset.filter;


            filterButtons.forEach(function (item) {
                item.classList.remove('active');
            });

            this.classList.add('active');


            classworkItems.forEach(function (item) {

                const type = item.dataset.classworkType;

                if (
                    filter === 'all' ||
                    filter === type
                ) {
                    item.style.display = '';
                } else {
                    item.style.display = 'none';
                }

            });


            document.querySelectorAll(
                '.classwork-topic'
            ).forEach(function (topic) {

                const items = topic.querySelectorAll(
                    '.classwork-item'
                );

                let hasVisibleItem = false;

                items.forEach(function (item) {

                    if (
                        item.style.display !== 'none'
                    ) {
                        hasVisibleItem = true;
                    }

                });


                if (hasVisibleItem) {
                    topic.style.display = '';
                } else {
                    topic.style.display = 'none';
                }

            });

        });

    });


    /* ============================================================
       TOPIC COLLAPSE / EXPAND
       ============================================================ */

    document.querySelectorAll(
        '[data-topic-toggle]'
    ).forEach(function (header) {

        header.addEventListener('click', function (event) {

            if (
                event.target.closest(
                    '.classwork-topic-menu'
                )
            ) {
                return;
            }


            const topic = this.closest(
                '.classwork-topic'
            );

            const items = topic.querySelector(
                '.classwork-topic-items'
            );

            const toggle = topic.querySelector(
                '.classwork-topic-toggle'
            );

            const icon = toggle.querySelector('i');


            const isOpen =
                toggle.getAttribute(
                    'aria-expanded'
                ) === 'true';


            if (isOpen) {

                items.style.display = 'none';

                toggle.setAttribute(
                    'aria-expanded',
                    'false'
                );

                icon.classList.remove(
                    'bx-chevron-up'
                );

                icon.classList.add(
                    'bx-chevron-down'
                );

            } else {

                items.style.display = '';

                toggle.setAttribute(
                    'aria-expanded',
                    'true'
                );

                icon.classList.remove(
                    'bx-chevron-down'
                );

                icon.classList.add(
                    'bx-chevron-up'
                );

            }

        });

    });

/* ============================================================
   CLASSWORK ITEM THREE DOT MENUS
   ============================================================ */

const classworkItemOptions =
    document.querySelectorAll(
        '.classwork-item-options'
    );

classworkItemOptions.forEach(function (container) {

    const menuButton =
        container.querySelector(
            '.classwork-item-options-button'
        );

    const editButton =
        container.querySelector(
            '[data-action="edit"]'
        );

    const deleteButton =
        container.querySelector(
            '[data-action="delete"]'
        );

    if (!menuButton) {
        return;
    }

    /*
    |--------------------------------------------------------------------------
    | OPEN / CLOSE MENU
    |--------------------------------------------------------------------------
    */
    menuButton.addEventListener(
        'click',
        function (event) {

            event.preventDefault();
            event.stopPropagation();

            classworkItemOptions.forEach(
                function (otherContainer) {

                    if (
                        otherContainer !== container
                    ) {
                        otherContainer.classList.remove(
                            'show'
                        );
                    }

                }
            );

            container.classList.toggle(
                'show'
            );
        }
    );


    /*
    |--------------------------------------------------------------------------
    | EDIT
    |--------------------------------------------------------------------------
    */
    if (editButton) {

        editButton.addEventListener(
            'click',
            function (event) {

                event.preventDefault();
                event.stopPropagation();

                const editUrl =
                    menuButton.dataset.editUrl;

                if (!editUrl) {
                    return;
                }

                /*
                | Go directly to Edit.
                | Do NOT follow the parent Show link.
                */
                window.location.assign(
                    editUrl
                );
            }
        );

    }


    /*
    |--------------------------------------------------------------------------
    | DELETE
    |--------------------------------------------------------------------------
    */
    if (deleteButton) {

        deleteButton.addEventListener(
            'click',
            function (event) {

                event.preventDefault();
                event.stopPropagation();

                const deleteUrl =
                    menuButton.dataset.deleteUrl;

                if (!deleteUrl) {
                    return;
                }

                const confirmed =
                    confirm(
                        'Are you sure you want to delete this item?'
                    );

                if (!confirmed) {
                    return;
                }

                const form =
                    document.createElement(
                        'form'
                    );

                form.method = 'POST';
                form.action = deleteUrl;
                form.style.display = 'none';


                /*
                | CSRF
                */
                const token =
                    document.createElement(
                        'input'
                    );

                token.type = 'hidden';
                token.name = '_token';
                token.value =
                    '{{ csrf_token() }}';


                /*
                | DELETE method
                */
                const method =
                    document.createElement(
                        'input'
                    );

                method.type = 'hidden';
                method.name = '_method';
                method.value = 'DELETE';


                /*
                | Return to Classwork
                */
                const returnTo =
                    document.createElement(
                        'input'
                    );

                returnTo.type = 'hidden';
                returnTo.name = 'return_to';
                returnTo.value = 'classwork';


                form.appendChild(token);
                form.appendChild(method);
                form.appendChild(returnTo);

                document.body.appendChild(
                    form
                );

                form.submit();
            }
        );

    }

});


/*
|--------------------------------------------------------------------------
| CLOSE ALL MENUS WHEN CLICKING OUTSIDE
|--------------------------------------------------------------------------
*/

document.addEventListener(
    'click',
    function () {

        classworkItemOptions.forEach(
            function (container) {

                container.classList.remove(
                    'show'
                );

            }
        );

    }
);


/*
|--------------------------------------------------------------------------
| PREVENT DROPDOWN CLICKS FROM CLOSING MENU
|--------------------------------------------------------------------------
*/

classworkItemOptions.forEach(
    function (container) {

        const dropdown =
            container.querySelector(
                '.classwork-item-options-dropdown'
            );

        if (!dropdown) {
            return;
        }

        dropdown.addEventListener(
            'click',
            function (event) {

                event.stopPropagation();

            }
        );

    }
);

    
    /* ============================================================
       CREATE CLASSWORK MODAL
       ============================================================ */

    const modal = document.getElementById(
        'classworkModal'
    );

    const openButton = document.getElementById(
        'openClassworkModal'
    );

    const closeButton = document.getElementById(
        'closeClassworkModal'
    );

    const overlay = document.getElementById(
        'classworkModalOverlay'
    );


    function openClassworkModal() {

        modal.classList.add('show');

        modal.setAttribute(
            'aria-hidden',
            'false'
        );

        document.body.style.overflow = 'hidden';

    }


    function closeClassworkModal() {

        modal.classList.remove('show');

        modal.setAttribute(
            'aria-hidden',
            'true'
        );

        document.body.style.overflow = '';

    }


    if (openButton) {
        openButton.addEventListener(
            'click',
            openClassworkModal
        );
    }


    if (closeButton) {
        closeButton.addEventListener(
            'click',
            closeClassworkModal
        );
    }


    if (overlay) {
        overlay.addEventListener(
            'click',
            closeClassworkModal
        );
    }


    document.addEventListener(
        'keydown',
        function (event) {

            if (
                event.key === 'Escape' &&
                modal.classList.contains('show')
            ) {
                closeClassworkModal();
            }

        }
    );


    /* ============================================================
       TOPIC THREE DOT MENUS
       ============================================================ */

    const topicOptions =
        document.querySelectorAll(
            '.classwork-topic-options'
        );

    const topicDeleteModal =
        document.getElementById(
            'topicDeleteModal'
        );

    const topicDeleteForm =
        document.getElementById(
            'topicDeleteForm'
        );

    const topicDeleteClose =
        document.getElementById(
            'topicDeleteClose'
        );

    const topicDeleteCancel =
        document.getElementById(
            'topicDeleteCancel'
        );

    const topicDeleteOverlay =
        document.getElementById(
            'topicDeleteModalOverlay'
        );

    const topicDeleteDescription =
        document.getElementById(
            'topicDeleteDescription'
        );


    function closeTopicDeleteModal() {

        if (!topicDeleteModal) {
            return;
        }

        topicDeleteModal.classList.remove(
            'show'
        );

        topicDeleteModal.setAttribute(
            'aria-hidden',
            'true'
        );

        document.body.style.overflow = '';

    }


    topicOptions.forEach(function (container) {

        const menuButton =
            container.querySelector(
                '.classwork-topic-options-button'
            );

        const editButton =
            container.querySelector(
                '[data-action="edit"]'
            );

        const deleteButton =
            container.querySelector(
                '[data-action="delete"]'
            );

        if (!menuButton) {
            return;
        }


        menuButton.addEventListener(
            'click',
            function (event) {

                event.preventDefault();
                event.stopPropagation();

                topicOptions.forEach(
                    function (otherContainer) {

                        if (
                            otherContainer !== container
                        ) {
                            otherContainer.classList.remove(
                                'show'
                            );
                        }

                    }
                );

                container.classList.toggle(
                    'show'
                );

            }
        );


        if (editButton) {

            editButton.addEventListener(
                'click',
                function (event) {

                    event.preventDefault();
                    event.stopPropagation();

                    const editUrl =
                        menuButton.dataset.editUrl;

                    if (!editUrl) {
                        return;
                    }

                    window.location.assign(
                        editUrl
                    );

                }
            );

        }


        if (deleteButton) {

            deleteButton.addEventListener(
                'click',
                function (event) {

                    event.preventDefault();
                    event.stopPropagation();

                    const deleteUrl =
                        menuButton.dataset.deleteUrl;

                    const topicName =
                        menuButton.dataset.topicName ||
                        'this topic';

                    const classworkCount =
                        Number(
                            menuButton.dataset.classworkCount || 0
                        );

                    if (
                        !deleteUrl ||
                        !topicDeleteModal ||
                        !topicDeleteForm
                    ) {
                        return;
                    }

                    topicDeleteForm.action = deleteUrl;

                    topicDeleteDescription.textContent =
                        classworkCount > 0
                            ? `"${topicName}" contains ${classworkCount} classwork item${classworkCount === 1 ? '' : 's'}. Choose what should happen next.`
                            : `"${topicName}" has no classwork items. Choose what should happen next.`;

                    const topicOnlyOption =
                        topicDeleteForm.querySelector(
                            'input[name="delete_option"][value="topic_only"]'
                        );

                    if (topicOnlyOption) {
                        topicOnlyOption.checked = true;
                    }

                    topicDeleteModal.classList.add(
                        'show'
                    );

                    topicDeleteModal.setAttribute(
                        'aria-hidden',
                        'false'
                    );

                    container.classList.remove(
                        'show'
                    );

                    document.body.style.overflow = 'hidden';

                }
            );

        }


        const dropdown =
            container.querySelector(
                '.classwork-topic-options-dropdown'
            );

        if (dropdown) {

            dropdown.addEventListener(
                'click',
                function (event) {
                    event.stopPropagation();
                }
            );

        }

    });


    document.addEventListener(
        'click',
        function () {

            topicOptions.forEach(
                function (container) {
                    container.classList.remove(
                        'show'
                    );
                }
            );

        }
    );


    if (topicDeleteClose) {
        topicDeleteClose.addEventListener(
            'click',
            closeTopicDeleteModal
        );
    }

    if (topicDeleteCancel) {
        topicDeleteCancel.addEventListener(
            'click',
            closeTopicDeleteModal
        );
    }

    if (topicDeleteOverlay) {
        topicDeleteOverlay.addEventListener(
            'click',
            closeTopicDeleteModal
        );
    }

    document.addEventListener(
        'keydown',
        function (event) {

            if (
                event.key === 'Escape' &&
                topicDeleteModal &&
                topicDeleteModal.classList.contains('show')
            ) {
                closeTopicDeleteModal();
            }

        }
    );
});
</script>

@endsection
