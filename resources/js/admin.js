// ============================================================
// ADMIN LAYOUT JAVASCRIPT
// ============================================================


// ============================================================
// DARK MODE TOGGLE
// ============================================================

const toggleBtn = document.getElementById("darkmode");

function enableDarkMode() {

    document.body.classList.add("dark-mode");

    if (toggleBtn) {
        toggleBtn.checked = true;
    }

    localStorage.setItem("theme", "dark");
}


function disableDarkMode() {

    document.body.classList.remove("dark-mode");

    if (toggleBtn) {
        toggleBtn.checked = false;
    }

    localStorage.setItem("theme", "light");
}


// Load saved theme
if (localStorage.getItem("theme") === "dark") {
    enableDarkMode();
} else {
    disableDarkMode();
}


// Dark mode switch
if (toggleBtn) {

    toggleBtn.addEventListener("change", () => {

        if (toggleBtn.checked) {
            enableDarkMode();
        } else {
            disableDarkMode();
        }

    });

}



// ============================================================
// PROFILE DROPDOWN
// ============================================================

const profile = document.querySelector(".profile");
const dropdown = document.querySelector(".profile-dropdown");


if (profile && dropdown) {

    profile.addEventListener("click", function (e) {

        e.stopPropagation();

        dropdown.classList.toggle("active");

    });


    document.addEventListener("click", function () {

        dropdown.classList.remove("active");

    });

}



// ============================================================
// SIDEBAR TOGGLE
// ============================================================

const sidebar = document.getElementById("sidebar");

let openTimer;
let closeTimer;


if (sidebar) {

    sidebar.addEventListener("mouseenter", () => {

        clearTimeout(closeTimer);

        openTimer = setTimeout(() => {

            sidebar.classList.remove("closed");
            sidebar.classList.add("open");

        }, 200);

    });


    sidebar.addEventListener("mouseleave", () => {

        clearTimeout(openTimer);

        closeTimer = setTimeout(() => {

            sidebar.classList.remove("open");
            sidebar.classList.add("closed");

        }, 500);

    });

}


// ============================================================
// Dropdown Toggle for Table Controls
// Filter and Sort are optional
// ============================================================

document.addEventListener('DOMContentLoaded', function () {

    const filterButton = document.getElementById('filter-button');
    const filterPanel = document.getElementById('filter-panel');

    const sortButton = document.getElementById('sort-button');
    const sortPanel = document.getElementById('sort-panel');


    // ========================================================
    // Filter
    // ========================================================

    if (filterButton && filterPanel) {

        filterButton.addEventListener('click', function (event) {

            event.stopPropagation();

            filterPanel.classList.toggle('show');

            if (sortPanel) {
                sortPanel.classList.remove('show');
            }

        });

    }


    // ========================================================
    // Sort
    // ========================================================

    if (sortButton && sortPanel) {

        sortButton.addEventListener('click', function (event) {

            event.stopPropagation();

            sortPanel.classList.toggle('show');

            if (filterPanel) {
                filterPanel.classList.remove('show');
            }

        });

    }


    // ========================================================
    // Close when clicking outside
    // ========================================================

    document.addEventListener('click', function (event) {

        if (
            filterButton &&
            filterPanel &&
            !filterButton.contains(event.target) &&
            !filterPanel.contains(event.target)
        ) {

            filterPanel.classList.remove('show');

        }


        if (
            sortButton &&
            sortPanel &&
            !sortButton.contains(event.target) &&
            !sortPanel.contains(event.target)
        ) {

            sortPanel.classList.remove('show');

        }

    });

});
// ============================================================
// DASHBOARD — STUDENT NUMBER CHART
// ============================================================

const ctx = document.getElementById("studentChart");


if (ctx) {

    new Chart(ctx, {

        type: "line",

        data: {

            labels: [
                "Year 1",
                "Year 2",
                "Year 3",
                "Year 4"
            ],

            datasets: [

                {
                    label: "Students",

                    data: [
                        320,
                        280,
                        240,
                        190
                    ],

                    borderWidth: 3,

                    tension: 0.4,

                    pointRadius: 6,

                    pointHoverRadius: 9,

                    pointBackgroundColor: "#4F8EF7",

                    pointBorderColor: "#ffffff",

                    pointBorderWidth: 3,

                    fill: true
                }

            ]

        },


        options: {

            responsive: true,

            maintainAspectRatio: false,

            plugins: {

                legend: {
                    display: false
                }

            },


            scales: {

                y: {
                    beginAtZero: true
                }

            }

        }

    });

}



// ============================================================
// DASHBOARD — ACTIVITY FILTER
// ============================================================

const filterButtons = document.querySelectorAll('.activity-filter button');
const activityLists = document.querySelectorAll('.activity-list');

filterButtons.forEach(button => {

    button.addEventListener('click', function () {

        const filter = this.dataset.filter;


        // Change active button
        filterButtons.forEach(btn => {
            btn.classList.remove('active');
        });

        this.classList.add('active');


        // Show only the selected list
        activityLists.forEach(list => {

            if (list.dataset.type === filter) {
                list.classList.remove('hidden');
            } else {
                list.classList.add('hidden');
            }

        });

    });

});


