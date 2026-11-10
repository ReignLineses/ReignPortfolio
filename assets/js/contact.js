/* REIGN – contact.js: contact form behaviour, driven by events */
(function () {
    'use strict';

    /* ---------- Elements ---------- */
    const form = document.querySelector('[data-contact-form]');
    if (!form) return;
    const button = form.querySelector('button[type="submit"]');

    /* ---------- Handlers ---------- */
    // Stop the browser sending when a field is empty or the email is wrong.
    function handleSubmit(event) {
        if (!form.checkValidity()) {
            event.preventDefault();
            form.reportValidity();
            return;
        }
        button.disabled = true;           // no double sends while the page reloads
        button.textContent = 'Sending…';
    }

    /* ---------- Events ---------- */
    form.addEventListener('submit', handleSubmit);
})();
