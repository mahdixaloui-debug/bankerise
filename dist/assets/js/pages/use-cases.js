/* ============================================
   Bankerise — Use Cases Carousel Module
   Filter by audience + Marquee auto-scroll
   ============================================ */

(function () {
  'use strict';

  /* ── Use-case data ─────────────────────────── */
  var useCases = [
    {
      id: 'coris-digital-banking',
      audience: 'clevel',
      accent: '#4DB8CD',
      client: { abbr: 'CG', name: 'Coris Group', region: 'West Africa' },
      title: 'Redefining Banking of Tomorrow through Strategic Partnership',
      excerpt: 'How Coris Group and Bankerise partnered to build a next-generation digital banking experience across multiple West African markets, accelerating financial inclusion at scale.',
      metrics: [
        { value: '8', suffix: 'M+', label: 'Customers' },
        { value: '10', suffix: '+', label: 'Countries' }
      ],
      tags: ['Digital Strategy', 'Partnership', 'Scale'],
      link: 'use-cases/?case=coris-digital-banking'
    },
    {
      id: 'sme-credit-ai',
      audience: 'tech',
      accent: '#766CFF',
      client: { abbr: 'AI', name: 'AI Credit Engine', region: 'Global' },
      title: 'Empowering SME Credit Decisioning with Responsible AI',
      excerpt: 'Leveraging AI to reduce manual credit assessment tasks, speed up risk scoring for small and medium enterprises, and ensure full regulatory compliance across jurisdictions.',
      metrics: [
        { value: '60', suffix: '%', label: 'Faster Scoring' },
        { value: '3', suffix: 'x', label: 'Throughput' }
      ],
      tags: ['AI / ML', 'Credit Risk', 'Compliance'],
      link: 'use-cases/?case=sme-credit-ai'
    },
    {
      id: 'mobile-banking-ux',
      audience: 'clevel',
      accent: '#4DB8CD',
      client: { abbr: 'UX', name: 'Mobile-First Banking', region: 'MENA & Africa' },
      title: 'Ultra-Connected Customers Expect Banking at Their Fingertips',
      excerpt: 'The future of banking lies in digital transformation. How leading institutions are meeting the demands of hyper-connected customers while preserving human touchpoints.',
      metrics: [
        { value: '85', suffix: '%', label: 'Mobile Adoption' },
        { value: '4.8', suffix: '★', label: 'App Rating' }
      ],
      tags: ['Mobile UX', 'Digital Channels', 'CX'],
      link: 'use-cases/?case=mobile-banking-ux'
    },
    {
      id: 'africa-positioning',
      audience: 'partner',
      accent: '#34D399',
      client: { abbr: 'PG', name: 'Proxym Group', region: 'Pan-Africa' },
      title: 'Strengthening Strategic Positioning Across the African Continent',
      excerpt: 'How Bankerise expanded its footprint across Africa, supporting financial institutions in their digital transformation with localized deployment and domain expertise.',
      metrics: [
        { value: '20', suffix: '+', label: 'Countries' },
        { value: '50', suffix: '+', label: 'Deployments' }
      ],
      tags: ['Market Expansion', 'Africa', 'Localization'],
      link: 'use-cases/?case=africa-positioning'
    },
    {
      id: 'digital-transformation-2025',
      audience: 'tech',
      accent: '#766CFF',
      client: { abbr: 'DT', name: 'Digital Platform', region: 'Global' },
      title: 'Accelerating User-Centric Digital Transformation in 2025',
      excerpt: 'A forward look at how Bankerise is enabling financial institutions to build user-centered digital products using modern delivery methodologies and composable architecture.',
      metrics: [
        { value: '40', suffix: '%', label: 'Faster TTM' },
        { value: '99.9', suffix: '%', label: 'Uptime' }
      ],
      tags: ['Architecture', 'Composable', 'DevOps'],
      link: 'use-cases/?case=digital-transformation-2025'
    },
    {
      id: 'customer-onboarding',
      audience: 'clevel',
      accent: '#4DB8CD',
      client: { abbr: 'KY', name: 'Digital Onboarding', region: 'MENA' },
      title: 'Overcoming Customer Onboarding Challenges in Banking',
      excerpt: 'From manual document submission to AI-powered eKYC in under 4 minutes. How banks are conquering drop-off rates and regulatory complexity with Bankerise Digital Onboarding.',
      metrics: [
        { value: '87', suffix: '%', label: 'Completion' },
        { value: '4', suffix: 'min', label: 'Avg. Time' }
      ],
      tags: ['eKYC', 'Onboarding', 'Compliance'],
      link: 'use-cases/?case=customer-onboarding'
    },
    {
      id: 'check-digitization',
      audience: 'tech',
      accent: '#766CFF',
      client: { abbr: 'BS', name: 'BSIC Sénégal', region: 'West Africa' },
      title: 'Digitizing Check Clearing with AI-Powered MICR & OCR',
      excerpt: 'Eliminating paper-based check clearing across 12 branches with real-time MICR/OCR scanning, automated validation, and same-day BCEAO-compliant digital settlement.',
      metrics: [
        { value: '92', suffix: '%', label: 'Paper Cut' },
        { value: '$180', suffix: 'K', label: 'Savings/Yr' }
      ],
      tags: ['MICR/OCR', 'Check Processing', 'Automation'],
      link: 'use-cases/?case=check-digitization'
    },
    {
      id: 'proxy-payments',
      audience: 'clevel',
      accent: '#4DB8CD',
      client: { abbr: 'DB', name: 'Dukhan Bank', region: 'Qatar' },
      title: 'Instant Transfers via Phone Number & QR Code Proxy',
      excerpt: 'Replacing IBAN-based transfers with phone and QR proxy payments, reducing error rates from 8.3% to 0.3% and driving 4x growth in P2P transaction volume.',
      metrics: [
        { value: '340', suffix: 'K', label: 'Monthly Txns' },
        { value: '<2', suffix: 's', label: 'Settlement' }
      ],
      tags: ['Proxy Pay', 'QR Code', 'FAWRI+'],
      link: 'use-cases/?case=proxy-payments'
    },
    {
      id: 'group-banking-tontines',
      audience: 'partner',
      accent: '#34D399',
      client: { abbr: 'AC', name: 'ADI Consumer Finance', region: 'Côte d\'Ivoire' },
      title: 'Digitizing Tontines & Group Savings Circles at Scale',
      excerpt: 'Bringing the $12B informal tontine market into formal banking with digital group finance, mobile money integration, and automated contribution scheduling.',
      metrics: [
        { value: '8.4', suffix: 'K', label: 'Active Groups' },
        { value: '34', suffix: 'K', label: 'New Accounts' }
      ],
      tags: ['Group Finance', 'Mobile Money', 'Inclusion'],
      link: 'use-cases/?case=group-banking-tontines'
    },
    {
      id: 'multi-country-platform',
      audience: 'partner',
      accent: '#34D399',
      client: { abbr: 'BG', name: 'BGFI Bank', region: 'Pan-Africa · 11 Countries' },
      title: 'Unified Digital Platform Across 11 Countries & Regulators',
      excerpt: 'A single multi-tenant Bankerise deployment powering check clearing, proxy payments, and mobile banking across 11 African countries with country-specific regulatory adapters.',
      metrics: [
        { value: '1.2', suffix: 'M', label: 'Users' },
        { value: '45', suffix: '%', label: 'Ops Cost Cut' }
      ],
      tags: ['Multi-Tenant', 'Pan-Africa', 'Unified'],
      link: 'use-cases/?case=multi-country-platform'
    },
    {
      id: 'digital-lending',
      audience: 'tech',
      accent: '#766CFF',
      client: { abbr: 'DL', name: 'Digital Lending', region: 'MENA' },
      title: 'Transforming Lending into a Seamless Digital Experience',
      excerpt: 'End-to-end digital loan origination with automated scoring, e-signature workflows, and real-time disbursement — reducing approval cycles from days to minutes.',
      metrics: [
        { value: '15', suffix: 'min', label: 'Avg. Approval' },
        { value: '3', suffix: 'x', label: 'Volume Growth' }
      ],
      tags: ['Lending', 'E-Signature', 'Automation'],
      link: 'use-cases/?case=digital-lending'
    },
    {
      id: 'omnichannel-banking',
      audience: 'clevel',
      accent: '#4DB8CD',
      client: { abbr: 'OC', name: 'Omnichannel Suite', region: 'Global' },
      title: 'Seamless Banking Across Every Channel and Touchpoint',
      excerpt: 'Delivering a consistent customer experience across mobile, web, branch, and agent channels with unified session management and real-time data synchronization.',
      metrics: [
        { value: '4', suffix: '', label: 'Channels' },
        { value: '60', suffix: '%', label: 'Digital Shift' }
      ],
      tags: ['Omnichannel', 'Branch', 'Unified CX'],
      link: 'use-cases/?case=omnichannel-banking'
    }
  ];

  /* ── Audience badge HTML ────────────────────── */
  var audienceMap = {
    clevel: {
      label: 'Bank Decision Makers',
      cls: 'uc-audience-badge--clevel',
      icon: '<svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>'
    },
    tech: {
      label: 'Technology & Product',
      cls: 'uc-audience-badge--tech',
      icon: '<svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"/></svg>'
    },
    partner: {
      label: 'Partner Ecosystem',
      cls: 'uc-audience-badge--partner',
      icon: '<svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>'
    }
  };

  /* ── Build single card HTML ────────────────── */
  function buildCard(uc) {
    var aud = audienceMap[uc.audience];
    var metricsHTML = '';
    uc.metrics.forEach(function (m) {
      metricsHTML += '<div class="uc-card-metric">'
        + '<span class="uc-card-metric-val">' + m.value + m.suffix + '</span>'
        + '<span class="uc-card-metric-label">' + m.label + '</span>'
        + '</div>';
    });

    var tagsHTML = '';
    uc.tags.forEach(function (t) {
      tagsHTML += '<span class="uc-card-tag">' + t + '</span>';
    });

    return '<div class="uc-card" data-uc-audience="' + uc.audience + '" style="--card-accent:' + uc.accent + '">'
      + '<span class="uc-audience-badge ' + aud.cls + '">' + aud.icon + ' ' + aud.label + '</span>'
      + '<div class="uc-card-client">'
      +   '<div class="uc-card-client-logo">' + uc.client.abbr + '</div>'
      +   '<div><div class="uc-card-client-name">' + uc.client.name + '</div>'
      +   '<div class="uc-card-client-region">' + uc.client.region + '</div></div>'
      + '</div>'
      + '<h3 class="uc-card-title">' + uc.title + '</h3>'
      + '<p class="uc-card-excerpt">' + uc.excerpt + '</p>'
      + '<div class="uc-card-metrics">' + metricsHTML + '</div>'
      + '<div class="uc-card-tags">' + tagsHTML + '</div>'
      + '<a href="' + uc.link + '" class="uc-card-link">'
      +   'Read Full Case'
      +   '<svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/></svg>'
      + '</a>'
      + '</div>';
  }

  /* ── Render cards into marquee ──────────────── */
  function renderMarquee(filterAudience) {
    var track = document.getElementById('uc-marquee-track');
    if (!track) return;

    var filtered = filterAudience === 'all'
      ? useCases
      : useCases.filter(function (uc) { return uc.audience === filterAudience; });

    /* Need enough cards for seamless loop — duplicate the set */
    var html = '';
    /* First set */
    filtered.forEach(function (uc) { html += buildCard(uc); });
    /* Duplicate set for seamless loop */
    filtered.forEach(function (uc) { html += buildCard(uc); });

    track.innerHTML = html;

    /* Reset animation by briefly removing the class */
    track.classList.remove('uc-marquee-animate');
    /* Force reflow */
    void track.offsetWidth;

    /* Adjust speed based on card count: ~4s per card for smoothness */
    var speed = Math.max(filtered.length * 4.5, 20);
    track.style.setProperty('--marquee-speed', speed + 's');
    track.classList.add('uc-marquee-animate');
  }

  /* ── Initialize ────────────────────────────── */
  document.addEventListener('DOMContentLoaded', function () {
    renderMarquee('all');
    initFilters();
    initParticles();
    initHoverPause();
  });

  /* ── Hover + Touch: pause marquee ─────────── */
  function initHoverPause() {
    var wrap = document.querySelector('.uc-marquee-wrap');
    if (!wrap) return;

    var track = document.getElementById('uc-marquee-track');

    /* Mouse hover — pause/resume */
    wrap.addEventListener('mouseenter', function () {
      if (track) track.style.animationPlayState = 'paused';
    });
    wrap.addEventListener('mouseleave', function () {
      if (track) track.style.animationPlayState = '';
    });

    /* Touch — pause, then resume after 2s */
    wrap.addEventListener('touchstart', function () {
      if (track) track.style.animationPlayState = 'paused';
    }, { passive: true });
    wrap.addEventListener('touchend', function () {
      if (track) {
        setTimeout(function () { track.style.animationPlayState = ''; }, 2000);
      }
    }, { passive: true });
  }

  /* ── Filter buttons ────────────────────────── */
  function initFilters() {
    var buttons = document.querySelectorAll('[data-uc-filter]');
    buttons.forEach(function (btn) {
      btn.addEventListener('click', function () {
        buttons.forEach(function (b) { b.classList.remove('active'); });
        btn.classList.add('active');
        renderMarquee(btn.getAttribute('data-uc-filter'));
      });
    });
  }

  /* ── Particle Canvas (unchanged) ───────────── */
  function initParticles() {
    var canvas = document.getElementById('uc-particles-canvas');
    if (!canvas) return;

    var ctx = canvas.getContext('2d');
    var particles = [];
    var particleCount = 35;
    var colors = ['#4DB8CD', '#766CFF', '#4799D1', '#4C4E89', '#34D399'];
    var animId;

    function resize() {
      var section = canvas.parentElement;
      canvas.width = section.offsetWidth;
      canvas.height = section.offsetHeight;
    }

    function createParticle() {
      return {
        x: Math.random() * canvas.width,
        y: Math.random() * canvas.height,
        size: Math.random() * 2 + 0.5,
        speedX: (Math.random() - 0.5) * 0.25,
        speedY: (Math.random() - 0.5) * 0.25,
        opacity: Math.random() * 0.4 + 0.1,
        color: colors[Math.floor(Math.random() * colors.length)],
        pulse: Math.random() * Math.PI * 2,
        pulseSpeed: Math.random() * 0.02 + 0.005
      };
    }

    function init() {
      resize();
      particles = [];
      for (var i = 0; i < particleCount; i++) {
        particles.push(createParticle());
      }
    }

    function drawParticle(p) {
      p.pulse += p.pulseSpeed;
      var alpha = p.opacity * (0.5 + 0.5 * Math.sin(p.pulse));
      ctx.beginPath();
      ctx.arc(p.x, p.y, p.size, 0, Math.PI * 2);
      ctx.fillStyle = p.color;
      ctx.globalAlpha = alpha;
      ctx.fill();
      ctx.globalAlpha = 1;
    }

    function connectParticles() {
      for (var i = 0; i < particles.length; i++) {
        for (var j = i + 1; j < particles.length; j++) {
          var dx = particles[i].x - particles[j].x;
          var dy = particles[i].y - particles[j].y;
          var dist = Math.sqrt(dx * dx + dy * dy);
          if (dist < 140) {
            ctx.beginPath();
            ctx.moveTo(particles[i].x, particles[i].y);
            ctx.lineTo(particles[j].x, particles[j].y);
            ctx.strokeStyle = particles[i].color;
            ctx.globalAlpha = 0.025 * (1 - dist / 140);
            ctx.lineWidth = 0.5;
            ctx.stroke();
            ctx.globalAlpha = 1;
          }
        }
      }
    }

    function animate() {
      ctx.clearRect(0, 0, canvas.width, canvas.height);
      particles.forEach(function (p) {
        p.x += p.speedX;
        p.y += p.speedY;
        if (p.x < 0) p.x = canvas.width;
        if (p.x > canvas.width) p.x = 0;
        if (p.y < 0) p.y = canvas.height;
        if (p.y > canvas.height) p.y = 0;
        drawParticle(p);
      });
      connectParticles();
      animId = requestAnimationFrame(animate);
    }

    var observer = new IntersectionObserver(function (entries) {
      entries.forEach(function (entry) {
        if (entry.isIntersecting) {
          if (!animId) animate();
        } else {
          if (animId) {
            cancelAnimationFrame(animId);
            animId = null;
          }
        }
      });
    }, { threshold: 0 });

    var section = document.getElementById('use-cases-section');
    if (section) observer.observe(section);

    init();
    window.addEventListener('resize', resize);
  }

})();
