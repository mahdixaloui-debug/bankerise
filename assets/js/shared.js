/* ============================================
   Bankerise — Shared JavaScript
   Navbar Logic, Scroll Reveals, Counters
   ============================================ */

(function () {
  'use strict';

  // ─── INITIALIZE ON DOM READY ─────────────────
  document.addEventListener('DOMContentLoaded', function () {
    initNavbar();
    initScrollReveal();
    initCounters();
    highlightActiveNav();
  });

  // ─── NAVBAR LOGIC ───────────────────────────
  function initNavbar() {
    const nav = document.querySelector('.navbar-glass');
    if (!nav) return;

    // Scroll effect
    function onScroll() {
      if (window.scrollY > 50) {
        nav.classList.add('scrolled');
      } else {
        nav.classList.remove('scrolled');
      }
    }
    window.addEventListener('scroll', onScroll, { passive: true });
    onScroll();

    // Desktop dropdowns
    document.querySelectorAll('[data-dropdown]').forEach(function (dropdown) {
      const btn = dropdown.querySelector('button');
      const menu = dropdown.querySelector('.nav-dropdown');
      if (!btn || !menu) return;

      let timeout;
      dropdown.addEventListener('mouseenter', function () {
        clearTimeout(timeout);
        menu.classList.add('open');
        btn.setAttribute('aria-expanded', 'true');
      });
      dropdown.addEventListener('mouseleave', function () {
        timeout = setTimeout(function () {
          menu.classList.remove('open');
          btn.setAttribute('aria-expanded', 'false');
        }, 150);
      });

      // Keyboard accessibility
      btn.addEventListener('keydown', function (e) {
        if (e.key === 'Enter' || e.key === ' ') {
          e.preventDefault();
          const isOpen = menu.classList.contains('open');
          menu.classList.toggle('open');
          btn.setAttribute('aria-expanded', String(!isOpen));
        }
      });
    });

    // Desktop submenus (Solutions flyout)
    document.querySelectorAll('[data-submenu]').forEach(function (submenu) {
      const trigger = submenu.querySelector('a');
      const flyout = submenu.querySelector('.nav-submenu');
      if (!trigger || !flyout) return;

      let subTimeout;
      submenu.addEventListener('mouseenter', function () {
        clearTimeout(subTimeout);
        flyout.classList.add('open');
      });
      submenu.addEventListener('mouseleave', function () {
        subTimeout = setTimeout(function () {
          flyout.classList.remove('open');
        }, 150);
      });
      // Prevent the "Solutions" trigger from navigating
      trigger.addEventListener('click', function (e) {
        e.preventDefault();
      });
    });

    // Mobile menu
    const mobileBtn = document.getElementById('mobile-menu-btn');
    const mobileClose = document.getElementById('mobile-menu-close');
    const mobileMenu = document.getElementById('mobile-menu');
    if (mobileBtn && mobileMenu) {
      mobileBtn.addEventListener('click', function () {
        mobileMenu.classList.add('open');
        mobileMenu.setAttribute('aria-hidden', 'false');
        mobileBtn.setAttribute('aria-expanded', 'true');
        document.body.style.overflow = 'hidden';
      });
    }
    if (mobileClose && mobileMenu) {
      mobileClose.addEventListener('click', function () {
        mobileMenu.classList.remove('open');
        mobileMenu.setAttribute('aria-hidden', 'true');
        if (mobileBtn) mobileBtn.setAttribute('aria-expanded', 'false');
        document.body.style.overflow = '';
      });
    }

    // Mobile accordions
    document.querySelectorAll('.mobile-accordion > button').forEach(function (btn) {
      btn.addEventListener('click', function () {
        const content = btn.nextElementSibling;
        const chevron = btn.querySelector('svg');
        const isOpen = content.style.maxHeight && content.style.maxHeight !== '0px';
        if (isOpen) {
          content.style.maxHeight = '0px';
          if (chevron) chevron.style.transform = 'rotate(0deg)';
        } else {
          content.style.maxHeight = content.scrollHeight + 'px';
          if (chevron) chevron.style.transform = 'rotate(180deg)';
        }
      });
    });

    // Close dropdowns on click outside
    document.addEventListener('click', function (e) {
      document.querySelectorAll('[data-dropdown]').forEach(function (dropdown) {
        if (!dropdown.contains(e.target)) {
          const menu = dropdown.querySelector('.nav-dropdown');
          const btn = dropdown.querySelector('button');
          if (menu) menu.classList.remove('open');
          if (btn) btn.setAttribute('aria-expanded', 'false');
        }
      });
    });
  }

  // ─── ACTIVE NAV HIGHLIGHT ───────────────────
  function highlightActiveNav() {
    const currentPath = window.location.pathname;
    document.querySelectorAll('.nav-link').forEach(function (link) {
      const href = link.getAttribute('href');
      if (!href) return;
      // Match the page name
      const linkPage = href.split('/').pop().split('#')[0];
      const currentPage = currentPath.split('/').pop().split('#')[0] || 'index.php';
      if (linkPage === currentPage) {
        link.classList.remove('text-gray-400');
        link.classList.add('text-white');
      }
    });
  }

  // ─── SCROLL REVEAL ──────────────────────────
  function initScrollReveal() {
    var elements = document.querySelectorAll('[data-animate]');
    if (!elements.length) return;

    var observer = new IntersectionObserver(function (entries) {
      entries.forEach(function (entry) {
        if (entry.isIntersecting) {
          entry.target.classList.add('animate-in');
          observer.unobserve(entry.target);
        }
      });
    }, { threshold: 0.1, rootMargin: '0px 0px -50px 0px' });

    elements.forEach(function (el) { observer.observe(el); });
  }

  // ─── COUNTER ANIMATION ──────────────────────
  function initCounters() {
    var counters = document.querySelectorAll('[data-count]');
    if (!counters.length) return;

    var observer = new IntersectionObserver(function (entries) {
      entries.forEach(function (entry) {
        if (entry.isIntersecting) {
          animateCounter(entry.target);
          observer.unobserve(entry.target);
        }
      });
    }, { threshold: 0.3 });

    counters.forEach(function (el) { observer.observe(el); });
  }

  function animateCounter(element) {
    var target = parseFloat(element.getAttribute('data-count'));
    var suffix = element.getAttribute('data-suffix') || '';
    var prefix = element.getAttribute('data-prefix') || '';
    var decimals = (target % 1 !== 0) ? 1 : 0;
    var duration = 2000;
    var startTime = null;

    function easeOutQuart(t) {
      return 1 - Math.pow(1 - t, 4);
    }

    function step(timestamp) {
      if (!startTime) startTime = timestamp;
      var progress = Math.min((timestamp - startTime) / duration, 1);
      var easedProgress = easeOutQuart(progress);
      var current = easedProgress * target;

      if (decimals > 0) {
        element.textContent = prefix + current.toFixed(decimals) + suffix;
      } else {
        element.textContent = prefix + Math.floor(current) + suffix;
      }

      if (progress < 1) {
        requestAnimationFrame(step);
      } else {
        element.textContent = prefix + target + suffix;
      }
    }

    requestAnimationFrame(step);
  }

  // ─── TAB SYSTEM ─────────────────────────────
  window.initTabs = function (containerSelector) {
    var container = document.querySelector(containerSelector);
    if (!container) return;

    var buttons = container.querySelectorAll('.tab-btn');
    var contents = container.querySelectorAll('.tab-content');

    buttons.forEach(function (btn) {
      btn.addEventListener('click', function () {
        var target = btn.getAttribute('data-tab');

        buttons.forEach(function (b) { b.classList.remove('active'); });
        btn.classList.add('active');

        contents.forEach(function (c) {
          c.classList.remove('active');
          if (c.getAttribute('data-tab-content') === target) {
            c.classList.add('active');
          }
        });
      });
    });
  };

  // ─── ACCORDION SYSTEM ───────────────────────
  window.initAccordion = function (containerSelector) {
    var container = document.querySelector(containerSelector);
    if (!container) return;

    container.querySelectorAll('.accordion-trigger').forEach(function (trigger) {
      trigger.addEventListener('click', function () {
        var item = trigger.closest('.accordion-item');
        var wasActive = item.classList.contains('active');

        // Close all
        container.querySelectorAll('.accordion-item').forEach(function (i) {
          i.classList.remove('active');
        });

        // Toggle clicked
        if (!wasActive) {
          item.classList.add('active');
        }
      });
    });
  };

})();
