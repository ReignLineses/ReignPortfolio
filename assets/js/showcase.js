/* ==========================================================
   REIGN – showcase.js: homepage project showcase, driven by events
   Scroll → moves the projects → fires "showcaseChange" → updates counter.
   Needs GSAP + ScrollTrigger (loaded from index.php).
   ========================================================== */
(function () {
    'use strict';

    /* ---------- Elements ---------- */
    const section = document.querySelector('[data-showcase]');
    if (!section) return;

    // Stay out of the way if motion is unwanted or GSAP didn't load (CSS shows a plain list).
    const reduceMotionQuery = window.matchMedia('(prefers-reduced-motion: reduce)');
    if (reduceMotionQuery.matches || typeof gsap === 'undefined' || typeof ScrollTrigger === 'undefined') return;

    // Unknown or legacy motion values use the zoom preset.
    const motionPresets = {
        zoom:    { inY: 40, outY: 25, inScale: 0.55, outScale: 0.55 },
    };
    const holdZone = 0.14;       // how long each project rests in the centre (0 – 0.3)
    const glideSeconds = 0.6;    // higher = floatier

    const items = Array.from(section.querySelectorAll('[data-showcase-item]')).map((element) => ({
        element,
        caption: element.querySelector('[data-caption]'),
        motion: motionPresets[element.dataset.motion] || motionPresets.zoom,
    }));
    const counter = section.querySelector('[data-current]');
    const lead = parseFloat(section.dataset.lead);
    const tail = parseFloat(section.dataset.tail);
    const totalSteps = (items.length - 1) + lead + tail;   // must match PHP's $steps

    /* ---------- State ---------- */
    const scrollState = { position: 0 };   // -lead … 0 … (items.length - 1)
    let activeIndex = -1;
    let scrollTrigger;

    /* ---------- Maths ---------- */
    const clamp01 = (value) => Math.min(1, Math.max(0, value));

    function progressToPosition(progress) {
        return Math.min(items.length - 1, progress * totalSteps - lead);
    }

    // Distance from centre, with a flat "hold" zone around 0.
    function applyHoldZone(distance) {
        const eased = Math.max(0, Math.abs(distance) - holdZone) / (1 - holdZone);
        return distance < 0 ? -eased : eased;
    }

    /* ---------- Drawing ---------- */
    function renderItem(item, index, position) {
        const distance = index - position;
        if (Math.abs(distance) > 2) {
            gsap.set(item.element, { opacity: 0 });
            return;
        }

        const eased = applyHoldZone(distance);
        const preset = item.motion;
        let yPercent, scale, opacity, zIndex;

        if (eased >= 0) {
            // Coming: lower, smaller, fading in, behind
            const t = Math.min(eased, 1.5);
            yPercent = preset.inY * t;
            scale = 1 - preset.inScale * t;
            opacity = clamp01(1 - eased * 1.2);
            zIndex = Math.round(100 - eased * 10);
        } else {
            // Passed: rises, grows toward the viewer, fades, in front
            const t = Math.min(-eased, 1.5);
            yPercent = -preset.outY * t;
            scale = 1 + preset.outScale * t;
            opacity = clamp01(1 - t * 1.5);
            zIndex = 200;
        }

        gsap.set(item.element, { yPercent, scale, opacity, zIndex });
        gsap.set(item.caption, { opacity: clamp01(1 - Math.abs(eased) * 2.2), y: eased * 24 });
    }

    function render(position) {
        items.forEach((item, index) => renderItem(item, index, position));

        const nearest = Math.min(items.length - 1, Math.max(0, Math.round(position)));
        if (nearest !== activeIndex) {
            activeIndex = nearest;
            section.dispatchEvent(new CustomEvent('showcaseChange', { detail: { index: nearest } }));
        }
    }

    /* ---------- Handlers ---------- */
    function handleShowcaseChange(event) {
        items.forEach((item, index) => item.element.classList.toggle('isActive', index === event.detail.index));
        if (counter) counter.textContent = String(event.detail.index + 1).padStart(2, '0');
    }

    function handleScrollUpdate(self) {
        gsap.to(scrollState, {
            position: progressToPosition(self.progress),
            duration: glideSeconds,
            ease: 'power3.out',
            overwrite: true,
            onUpdate: () => render(scrollState.position),
        });
    }

    function handleRefresh(self) {
        scrollState.position = progressToPosition(self.progress);
        render(scrollState.position);
    }

    // Tabbing onto a project's link scrolls the showcase to that project.
    function handleFocusIn(event) {
        const index = items.findIndex((item) => item.element.contains(event.target));
        if (index === -1 || index === activeIndex) return;

        const progress = (index + lead) / totalSteps;
        const top = scrollTrigger.start + progress * (scrollTrigger.end - scrollTrigger.start);
        window.scrollTo({ top, behavior: 'smooth' });
    }

    function handleMotionPreferenceChange() {
        location.reload();
    }

    function handleWindowLoad() {
        ScrollTrigger.refresh();
    }

    /* ---------- Events ---------- */
    gsap.registerPlugin(ScrollTrigger);
    ScrollTrigger.config({ ignoreMobileResize: true });
    section.classList.add('isImmersive');

    section.addEventListener('showcaseChange', handleShowcaseChange);
    section.addEventListener('focusin', handleFocusIn);
    reduceMotionQuery.addEventListener('change', handleMotionPreferenceChange);
    window.addEventListener('load', handleWindowLoad);

    scrollTrigger = ScrollTrigger.create({
        trigger: section,
        start: 'top top',
        end: 'bottom bottom',
        onUpdate: handleScrollUpdate,
        onRefresh: handleRefresh,
    });
    scrollState.position = progressToPosition(0);
    render(scrollState.position);
})();
