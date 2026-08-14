/*=============== SHOW MENU ===============*/
const showMenu = (toggleId, navId) => {
    const toggle = document.getElementById(toggleId);
    const nav = document.getElementById(navId);

    if (toggle && nav) {
        toggle.addEventListener('click', () => {
            nav.classList.toggle('show-menu');
        });
    }
};
showMenu('nav-toggle', 'nav-menu');


/*=============== REMOVE MENU MOBILE ===============*/
const navLink = document.querySelectorAll('.nav__link');

function linkAction() {
    const navMenu = document.getElementById('nav-menu');
    if (navMenu) {
        navMenu.classList.remove('show-menu');
    }
}
navLink.forEach(n => n.addEventListener('click', linkAction));


/*=============== SCROLL SECTIONS ACTIVE LINK ===============*/
const sections = document.querySelectorAll('section[id]');

function scrollActive() {
    const scrollY = window.pageYOffset;

    sections.forEach(current => {
        const sectionHeight = current.offsetHeight;
        const sectionTop = current.offsetTop - 50;
        const sectionId = current.getAttribute('id');

        const link = document.querySelector('.nav__menu a[href*=' + sectionId + ']');

        if (link) {
            if (scrollY > sectionTop && scrollY <= sectionTop + sectionHeight) {
                link.classList.add('active-link');
            } else {
                link.classList.remove('active-link');
            }
        }
    });
}
window.addEventListener('scroll', scrollActive);


/*=============== CHANGE BACKGROUND HEADER ===============*/
function scrollHeader() {
    const nav = document.getElementById('header');
    if (nav) {
        if (window.scrollY >= 80) {
            nav.classList.add('scroll-header');
        } else {
            nav.classList.remove('scroll-header');
        }
    }
}
window.addEventListener('scroll', scrollHeader);


/*=============== SHOW SCROLL UP ===============*/
function scrollUp() {
    const scrollUpBtn = document.getElementById('scroll-up');
    if (scrollUpBtn) {
        if (window.scrollY >= 560) {
            scrollUpBtn.classList.add('show-scroll');
        } else {
            scrollUpBtn.classList.remove('show-scroll');
        }
    }
}
window.addEventListener('scroll', scrollUp);


/*=============== DARK LIGHT THEME ===============*/
document.addEventListener("DOMContentLoaded", () => {

    const themeButton = document.getElementById('theme-button');
    const darkTheme = 'dark-theme';
    const iconTheme = 'bx-toggle-right';

    const selectedTheme = localStorage.getItem('selected-theme');
    const selectedIcon = localStorage.getItem('selected-icon');

    const getCurrentTheme = () =>
        document.body.classList.contains(darkTheme) ? 'dark' : 'light';

    const getCurrentIcon = () =>
        themeButton && themeButton.classList.contains(iconTheme)
            ? 'bx-toggle-left'
            : 'bx-toggle-right';

    // Apply saved theme
    if (selectedTheme) {
        document.body.classList[selectedTheme === 'dark' ? 'add' : 'remove'](darkTheme);

        if (themeButton) {
            themeButton.classList[selectedIcon === 'bx-toggle-left' ? 'add' : 'remove'](iconTheme);
        }
    }

    // Click event
    if (themeButton) {
        themeButton.addEventListener('click', () => {
            document.body.classList.toggle(darkTheme);
            themeButton.classList.toggle(iconTheme);

            localStorage.setItem('selected-theme', getCurrentTheme());
            localStorage.setItem('selected-icon', getCurrentIcon());
        });
    }

});