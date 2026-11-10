/* REIGN – main.js: site-wide behaviour, driven by events */
(function () {
    'use strict';

    /* ---------- Elements ---------- */
    const header = document.querySelector('[data-header]');
    const navToggle = document.querySelector('[data-nav-toggle]');

    /* ---------- Actions ---------- */
    function setMenuOpen(isOpen) {
        document.body.classList.toggle('navOpen', isOpen);
        navToggle.setAttribute('aria-expanded', String(isOpen));
    }

    /* ---------- Handlers ---------- */
    function handleScroll() {
        header.classList.toggle('isScrolled', window.scrollY > 20);
    }

    function handleClick(event) {
        if (event.target.closest('[data-nav-toggle]')) {
            setMenuOpen(!document.body.classList.contains('navOpen'));
        } else if (event.target.closest('#siteNav a')) {
            setMenuOpen(false);
        }
    }

    function handleKeydown(event) {
        if (event.key === 'Escape') setMenuOpen(false);
    }

    /* ---------- Events ---------- */
    window.addEventListener('scroll', handleScroll, { passive: true });
    document.addEventListener('click', handleClick);
    document.addEventListener('keydown', handleKeydown);

    handleScroll();   // set the header state for the page's first paint
})();
