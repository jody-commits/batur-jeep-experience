/**
 * main.js — Batur Jeep Experience
 * Public JS: Navbar scroll, AOS animations, Stats counter, Testimonials slider
 */

(function () {
    'use strict';

    /* ── DOM Ready ─────────────────────────────────────────── */
    document.addEventListener('DOMContentLoaded', function () {
        initNavbar();
        initAOS();
        initStatsCounter();
        initTestimonialsSlider();
        initScrollParallax();
    });


    /* ════════════════════════════════════════════════════════
       1. NAVBAR — Sticky + Transparent on hero, solid on scroll
    ════════════════════════════════════════════════════════ */
    function initNavbar() {
        var navbar     = document.getElementById('main-navbar');
        var hamburger  = document.getElementById('navbar-hamburger');
        var mobileMenu = document.getElementById('navbar-mobile-menu');

        if (!navbar) return;

        // Check if we are on hero page
        var heroSection = document.getElementById('hero-section');
        var isSolidPage = !heroSection;

        // Mark solid pages (no hero)
        if (isSolidPage) {
            navbar.classList.add('is-solid');
        }

        // Scroll handler
        function handleScroll() {
            if (isSolidPage) return; // always solid

            var scrollY = window.scrollY || window.pageYOffset;
            var threshold = window.innerHeight * 0.7;

            if (scrollY > threshold) {
                navbar.classList.add('is-scrolled');
            } else {
                navbar.classList.remove('is-scrolled');
            }
        }

        window.addEventListener('scroll', handleScroll, { passive: true });
        handleScroll(); // run on load

        // Hamburger toggle
        if (hamburger && mobileMenu) {
            hamburger.addEventListener('click', function () {
                var isOpen = mobileMenu.classList.contains('is-open');

                if (isOpen) {
                    mobileMenu.classList.remove('is-open');
                    hamburger.classList.remove('is-open');
                    hamburger.setAttribute('aria-expanded', 'false');
                    mobileMenu.setAttribute('aria-hidden', 'true');
                } else {
                    mobileMenu.classList.add('is-open');
                    hamburger.classList.add('is-open');
                    hamburger.setAttribute('aria-expanded', 'true');
                    mobileMenu.setAttribute('aria-hidden', 'false');
                }
            });

            // Close on link click
            var mobileLinks = mobileMenu.querySelectorAll('.navbar__mobile-link');
            mobileLinks.forEach(function (link) {
                link.addEventListener('click', function () {
                    mobileMenu.classList.remove('is-open');
                    hamburger.classList.remove('is-open');
                });
            });
        }
    }


    /* ════════════════════════════════════════════════════════
       2. SIMPLE AOS (Animate On Scroll) — Lightweight in-house
    ════════════════════════════════════════════════════════ */
    function initAOS() {
        var elements = document.querySelectorAll('[data-aos]');
        if (!elements.length) return;

        function checkAOS() {
            var windowHeight = window.innerHeight;
            elements.forEach(function (el) {
                if (el.classList.contains('aos-animated')) return;
                var rect = el.getBoundingClientRect();
                if (rect.top < windowHeight - 80) {
                    var delay = parseInt(el.getAttribute('data-delay') || 0);
                    setTimeout(function () {
                        el.classList.add('aos-animated');
                    }, delay);
                }
            });
        }

        window.addEventListener('scroll', checkAOS, { passive: true });
        window.addEventListener('resize', checkAOS, { passive: true });
        checkAOS(); // run immediately
    }


    /* ════════════════════════════════════════════════════════
       3. STATS COUNTER — Animate numbers on scroll
    ════════════════════════════════════════════════════════ */
    function initStatsCounter() {
        var counters = document.querySelectorAll('.stats-item__num[data-count]');
        if (!counters.length) return;

        var animated = false;

        function animateCounter(el) {
            var target   = parseFloat(el.getAttribute('data-count'));
            var decimal  = parseInt(el.getAttribute('data-decimal') || 0);
            var duration = 1800;
            var start    = null;

            function step(timestamp) {
                if (!start) start = timestamp;
                var progress = Math.min((timestamp - start) / duration, 1);
                // Ease out cubic
                var eased = 1 - Math.pow(1 - progress, 3);
                var current = eased * target;

                el.textContent = decimal > 0
                    ? current.toFixed(decimal)
                    : Math.floor(current).toString();

                if (progress < 1) {
                    requestAnimationFrame(step);
                } else {
                    el.textContent = decimal > 0 ? target.toFixed(decimal) : target.toString();
                }
            }

            requestAnimationFrame(step);
        }

        function checkCounters() {
            if (animated) return;
            var statsSection = document.getElementById('stats-section');
            if (!statsSection) return;

            var rect = statsSection.getBoundingClientRect();
            if (rect.top < window.innerHeight - 50) {
                animated = true;
                counters.forEach(function (el) {
                    animateCounter(el);
                });
                window.removeEventListener('scroll', checkCounters);
            }
        }

        window.addEventListener('scroll', checkCounters, { passive: true });
        checkCounters();
    }


    /* ════════════════════════════════════════════════════════
       4. TESTIMONIALS SLIDER — Drag & swipe enabled
    ════════════════════════════════════════════════════════ */
    function initTestimonialsSlider() {
        var track      = document.getElementById('testimonials-track');
        var prevBtn    = document.getElementById('testimonials-prev');
        var nextBtn    = document.getElementById('testimonials-next');
        var dotsWrap   = document.getElementById('testimonials-dots');
        var slider     = document.getElementById('testimonials-slider');

        if (!track || !prevBtn || !nextBtn) return;

        var cards      = track.querySelectorAll('.testimonial-card');
        var totalCards = cards.length;
        var current    = 0;
        var cardWidth  = 0;
        var gap        = 24;
        var visibleCount = 1;
        var maxIndex   = 0;

        // Drag state
        var isDragging  = false;
        var startX      = 0;
        var currentX    = 0;
        var dragOffsetX = 0;

        function calcLayout() {
            cardWidth = cards[0] ? cards[0].offsetWidth : 340;
            var sliderW = slider.offsetWidth;
            visibleCount = Math.max(1, Math.floor(sliderW / (cardWidth + gap)));
            maxIndex = Math.max(0, totalCards - visibleCount);
            if (current > maxIndex) current = maxIndex;
            renderDots();
            goTo(current, false);
        }

        function getOffset(index) {
            return -(index * (cardWidth + gap));
        }

        function goTo(index, animate) {
            if (typeof animate === 'undefined') animate = true;
            current = Math.max(0, Math.min(index, maxIndex));
            track.style.transition = animate ? 'transform 0.45s cubic-bezier(0.25,0.46,0.45,0.94)' : 'none';
            track.style.transform  = 'translateX(' + getOffset(current) + 'px)';
            updateDots();
            updateBtns();
        }

        function updateDots() {
            var dots = dotsWrap ? dotsWrap.querySelectorAll('.testimonials-dot') : [];
            dots.forEach(function (dot, i) {
                dot.classList.toggle('is-active', i === current);
            });
        }

        function updateBtns() {
            if (prevBtn) prevBtn.style.opacity = current <= 0 ? '0.4' : '1';
            if (nextBtn) nextBtn.style.opacity = current >= maxIndex ? '0.4' : '1';
        }

        function renderDots() {
            if (!dotsWrap) return;
            dotsWrap.innerHTML = '';
            var numDots = maxIndex + 1;
            for (var i = 0; i < numDots; i++) {
                var dot = document.createElement('button');
                dot.className = 'testimonials-dot' + (i === current ? ' is-active' : '');
                dot.setAttribute('aria-label', 'Go to testimonial ' + (i + 1));
                dot.dataset.index = i;
                dot.addEventListener('click', (function(idx) {
                    return function() { goTo(idx); };
                })(i));
                dotsWrap.appendChild(dot);
            }
        }

        // Buttons
        prevBtn.addEventListener('click', function () { goTo(current - 1); });
        nextBtn.addEventListener('click', function () { goTo(current + 1); });

        // Touch / drag
        function onDragStart(e) {
            isDragging = true;
            startX     = e.type === 'touchstart' ? e.touches[0].clientX : e.clientX;
            dragOffsetX = 0;
            track.style.transition = 'none';
        }
        function onDragMove(e) {
            if (!isDragging) return;
            currentX    = e.type === 'touchmove' ? e.touches[0].clientX : e.clientX;
            dragOffsetX = currentX - startX;
            track.style.transform = 'translateX(' + (getOffset(current) + dragOffsetX) + 'px)';
        }
        function onDragEnd() {
            if (!isDragging) return;
            isDragging = false;
            var threshold = cardWidth * 0.25;
            if (dragOffsetX < -threshold && current < maxIndex) {
                goTo(current + 1);
            } else if (dragOffsetX > threshold && current > 0) {
                goTo(current - 1);
            } else {
                goTo(current); // snap back
            }
        }

        if (slider) {
            slider.addEventListener('mousedown', onDragStart);
            window.addEventListener('mousemove', onDragMove);
            window.addEventListener('mouseup', onDragEnd);
            slider.addEventListener('touchstart', onDragStart, { passive: true });
            slider.addEventListener('touchmove', onDragMove, { passive: true });
            slider.addEventListener('touchend', onDragEnd);
        }

        // Auto-play
        var autoplay = setInterval(function () {
            if (!isDragging) {
                goTo(current >= maxIndex ? 0 : current + 1);
            }
        }, 5000);

        if (slider) {
            slider.addEventListener('mouseenter', function () { clearInterval(autoplay); });
        }

        // Init
        setTimeout(calcLayout, 50);
        window.addEventListener('resize', function () { calcLayout(); }, { passive: true });
    }


    /* ════════════════════════════════════════════════════════
       5. SUBTLE PARALLAX on hero
    ════════════════════════════════════════════════════════ */
    function initScrollParallax() {
        var heroBg = document.querySelector('.hero__bg');
        if (!heroBg) return;

        window.addEventListener('scroll', function () {
            var scrollY = window.scrollY || window.pageYOffset;
            var maxParallax = 80;
            var offset = Math.min(scrollY * 0.25, maxParallax);
            heroBg.style.transform = 'scale(1.1) translateY(' + offset + 'px)';
        }, { passive: true });
    }

})();
