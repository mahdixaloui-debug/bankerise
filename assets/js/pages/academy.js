/* ═══ BANKERISE PARTNER ACADEMY — Interactive course tracker ═══
 * - Enrol → Download (generates PDF with jsPDF) → Mark as Complete
 * - Persists state per browser via localStorage
 * - Updates global progress bar + per-track progress + certificate unlock
 */
(function () {
  const STORAGE_KEY = 'bankerise.academy.v1';

  /* ── 1. Course catalogue (single source of truth, used to render and to generate PDFs) ── */
  const COURSES = {
    /* TRACK 1 — Become a Partner */
    'p1': { track: 'partner', code: 'P-101', title: 'Bankerise Partner Program 101',
      tagline: 'Why partner with Bankerise, who the program is for, and the benefits at every tier.',
      duration: '45 min', modules: 4,
      content: [
        { h: '1. Why Bankerise needs partners', p: 'Bankerise is a B2B digital banking platform deployed across 26+ countries. We grow through three partner profiles: banking decision-makers, IT integrators, and local resellers. Partners extend our delivery footprint, localise pricing, and accelerate sales cycles in regulated markets.' },
        { h: '2. Three partner profiles', p: 'Decision Maker — drives modernisation inside an FI. IT Manager — owns integration & operations. Local Partner / Integrator — runs sales and delivery in a specific region.' },
        { h: '3. Tier overview (Bronze / Silver / Gold)', p: 'Bronze — entry level, certifications + portal access. Silver — sandbox, lead-sharing, technical certification. Gold — dedicated partner manager, joint go-to-market, revenue share.' },
        { h: '4. Mutual commitments', p: 'Bankerise commits to enablement, leads, technical support, and co-marketing. Partners commit to certification, deal registration, and minimum yearly volume per tier.' }
      ]},
    'p2': { track: 'partner', code: 'P-110', title: 'Choosing Your Tier — Bronze, Silver or Gold',
      tagline: 'A decision framework to pick the tier that matches your team size, market and ambition.',
      duration: '30 min', modules: 3,
      content: [
        { h: '1. Tier comparison matrix', p: 'Bronze: portal + academy + leads-by-referral. Silver: + sandbox + technical certification + co-selling. Gold: + dedicated PAM + roadmap input + protected territory + revenue share.' },
        { h: '2. Investment vs return', p: 'Bronze: low investment, lead-by-lead revenue. Silver: 1–2 certified consultants, regional pipeline. Gold: dedicated practice (5+ FTE), strategic accounts, higher margin.' },
        { h: '3. Upgrade path', p: 'Most partners start Bronze, hit Silver in 6–9 months after first deal, and reach Gold after sustained delivery quality and territory growth.' }
      ]},
    'p3': { track: 'partner', code: 'P-120', title: 'Onboarding & Legal Setup',
      tagline: 'From application to credentials — paperwork, MoU, NDAs and how long each step takes.',
      duration: '40 min', modules: 4,
      content: [
        { h: '1. Application checklist', p: 'Company KYC, ID of signatories, target market, existing banking customers, and your proposed tier.' },
        { h: '2. Mutual NDA', p: 'Signed before sandbox access. Bilingual EN/FR template available in the partner portal.' },
        { h: '3. Partner MoU', p: 'Defines territory, exclusivity (Gold only), commercials, certification SLAs, and brand usage.' },
        { h: '4. Credentials & first login', p: 'Within 3–5 business days of signed MoU you receive a partner ID, temporary password, and a link to /partners/login.' }
      ]},

    /* TRACK 2 — Use Bankerise */
    'u1': { track: 'use', code: 'U-201', title: 'Bankerise Platform Architecture',
      tagline: 'Modules, services, data flow — the mental model every consultant needs day one.',
      duration: '55 min', modules: 5,
      content: [
        { h: '1. The five core modules', p: 'Onboarding, Lending, Omnichannel, Analytics & CRM, Partner Portal. Each is independently deployable and shares one customer data layer.' },
        { h: '2. Service architecture', p: 'Stateless microservices behind a unified API gateway, event bus for cross-module signals (Kafka-compatible), and a tenant-aware data isolation layer.' },
        { h: '3. Data flow', p: 'A KYC event in Onboarding triggers profile creation in CRM, eligibility checks in Lending, and a welcome journey in Omnichannel — driven by configuration, not code.' },
        { h: '4. Multi-tenancy', p: 'A single Bankerise instance can serve multiple banks (or a bank with multiple brands) with isolated data, branding, and configuration.' },
        { h: '5. Deployment topology', p: 'On-prem, private cloud (AWS/Azure/GCP) or Bankerise-managed SaaS. Reference Terraform modules ship with the partner kit.' }
      ]},
    'u2': { track: 'use', code: 'U-210', title: 'Configuring the Banking Modules',
      tagline: 'Walk through configuration — products, rules, channels — without writing a line of code.',
      duration: '60 min', modules: 6,
      content: [
        { h: '1. Product catalogue', p: 'Define account types, loan products, and fees through the admin console. Versioned, no downtime to publish.' },
        { h: '2. Workflow designer', p: 'Drag-and-drop flow builder for KYC, loan approval, transfers. Conditions, approvals, parallel branches, escalations.' },
        { h: '3. Channel binding', p: 'Bind one workflow to mobile, internet banking, branch tablet — same logic, channel-aware UX.' },
        { h: '4. Compliance per jurisdiction', p: 'Region packs ship MEA / EU / SSA defaults. Override via tenant settings.' },
        { h: '5. Risk-based MFA', p: 'Configure policy: location, amount, device — escalate to OTP, push or biometric.' },
        { h: '6. Publishing & rollback', p: 'Stage → UAT → Production with one click. Every change is versioned and reversible.' }
      ]},
    'u3': { track: 'use', code: 'U-220', title: 'API Integration Basics',
      tagline: 'Authenticate, call core APIs, subscribe to webhooks. The minimum viable integration.',
      duration: '50 min', modules: 5,
      content: [
        { h: '1. Auth model', p: 'OAuth 2.0 client-credentials for server-to-server. Per-tenant API keys with scoped permissions. Rotate via portal.' },
        { h: '2. Core API surface', p: 'REST + JSON. Resources: customers, accounts, loans, transactions, journeys. OpenAPI spec downloadable from /developers.' },
        { h: '3. Webhooks', p: 'Subscribe to events (loan.approved, account.opened, kyc.completed). Signed payloads, retry with exponential back-off, dead-letter queue.' },
        { h: '4. SDKs', p: 'Java, .NET, Node, Python. All maintained, all versioned, all in the partner kit.' },
        { h: '5. Sandbox', p: 'A full Bankerise tenant pre-loaded with demo data. Reset to baseline whenever you like.' }
      ]},

    /* TRACK 3 — Sell Bankerise */
    's1': { track: 'sell', code: 'S-301', title: 'The Bankerise Pitch',
      tagline: 'A 3-minute story that lands with bank executives — from problem to proof.',
      duration: '35 min', modules: 4,
      content: [
        { h: '1. The opening hook', p: 'Open with a sharp number: "60% faster onboarding, 3× loan-approval speed, 26 countries live." Then ask: "What does that unlock for your bank?"' },
        { h: '2. The three-act story', p: 'Act 1 — the digital banking pressure. Act 2 — why typical solutions fail (silos, custom code, slow time-to-market). Act 3 — Bankerise as one configurable platform.' },
        { h: '3. The proof', p: 'Reference customers: UIB, QIIB, Coris Bank, Dukhan Bank, Oman Arab Bank. Numbers, not adjectives.' },
        { h: '4. The close', p: 'Ask for a 60-minute discovery call with their tech + business sponsor — not a demo, a discovery.' }
      ]},
    's2': { track: 'sell', code: 'S-310', title: 'Live Demo Walkthrough',
      tagline: 'A 25-minute scripted demo that shows onboarding, lending and analytics — in that order.',
      duration: '50 min', modules: 5,
      content: [
        { h: '1. Set the scene', p: 'Open with the Atlas Bank demo tenant. Two personas: Aïcha (customer), Karim (relationship manager).' },
        { h: '2. Onboarding (5 min)', p: 'Aïcha opens an account from her phone — eKYC, biometric, account live. Highlight: zero paper, zero branch visit.' },
        { h: '3. Lending (7 min)', p: 'Aïcha applies for a personal loan. Pre-scored, decisioned in 90 seconds, money in account. Highlight: configurable scoring, multi-product engine.' },
        { h: '4. Omnichannel + RM view (5 min)', p: 'Switch to Karim. He sees Aïcha\'s context across channels and offers a top-up loan — same engine, branch-side.' },
        { h: '5. Close on analytics (3 min)', p: 'Show the live dashboard: every event from the demo flowing in real-time. Tie back to "configure, not code".' }
      ]},
    's3': { track: 'sell', code: 'S-320', title: 'Handling Objections & Closing',
      tagline: 'The 8 objections you will hear in MEA and how to answer each in under 60 seconds.',
      duration: '40 min', modules: 4,
      content: [
        { h: '1. "We have a core banking system already"', p: 'Bankerise sits ABOVE the core. We orchestrate journeys; the core stays the system of record. We integrate to T24, Flexcube, Finacle.' },
        { h: '2. "Too expensive"', p: 'Reframe to total cost of ownership: avoided custom dev, retired legacy, faster time-to-market. Reference customer ROI within 18 months.' },
        { h: '3. "We need full source code / on-prem"', p: 'Both supported. On-prem deployment + escrow + quarterly source updates available at Gold-tier engagements.' },
        { h: '4. "Compliance / data residency"', p: 'Region packs (MEA, EU, SSA) ship with local compliance defaults. Data residency controlled per tenant.' }
      ]}
  };

  const TRACKS = {
    partner: { id: 'partner', name: 'Become a Partner',  color: '#4DB8CD', courses: ['p1','p2','p3'] },
    use:     { id: 'use',     name: 'Use Bankerise',     color: '#766CFF', courses: ['u1','u2','u3'] },
    sell:    { id: 'sell',    name: 'Sell Bankerise',    color: '#4799D1', courses: ['s1','s2','s3'] }
  };

  /* ── 2. State management (localStorage) ── */
  function loadState() {
    try { return JSON.parse(localStorage.getItem(STORAGE_KEY)) || {}; } catch (e) { return {}; }
  }
  function saveState(s) { localStorage.setItem(STORAGE_KEY, JSON.stringify(s)); }
  let state = loadState();

  function getCourseState(id) {
    return state[id] || { enrolled: false, downloaded: false, completed: false };
  }
  function setCourseState(id, patch) {
    state[id] = { ...getCourseState(id), ...patch };
    saveState(state);
  }

  /* ── 3. PDF generation (loads jsPDF lazily on first download) ── */
  let jsPDFReady = null;
  function loadJsPDF() {
    if (jsPDFReady) return jsPDFReady;
    jsPDFReady = new Promise((resolve, reject) => {
      if (window.jspdf) return resolve(window.jspdf);
      const s = document.createElement('script');
      s.src = 'https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js';
      s.onload = () => resolve(window.jspdf);
      s.onerror = reject;
      document.head.appendChild(s);
    });
    return jsPDFReady;
  }

  async function downloadCoursePDF(courseId) {
    const course = COURSES[courseId];
    const track = TRACKS[course.track];
    const lib = await loadJsPDF();
    const doc = new lib.jsPDF({ unit: 'pt', format: 'a4' });
    const W = doc.internal.pageSize.getWidth();
    let y = 60;

    /* Cover */
    doc.setFillColor(13, 15, 28); doc.rect(0, 0, W, 200, 'F');
    const [r,g,b] = hexToRgb(track.color);
    doc.setFillColor(r,g,b); doc.rect(0, 200, W, 4, 'F');
    doc.setTextColor(255,255,255); doc.setFont('helvetica','bold'); doc.setFontSize(10);
    doc.text('BANKERISE PARTNER ACADEMY', 50, 60);
    doc.setTextColor(r,g,b); doc.setFontSize(11);
    doc.text(track.name.toUpperCase() + '  ·  ' + course.code, 50, 90);
    doc.setTextColor(255,255,255); doc.setFontSize(24);
    splitText(doc, course.title, 50, 130, W - 100, 28);
    doc.setTextColor(180,180,200); doc.setFont('helvetica','normal'); doc.setFontSize(11);
    splitText(doc, course.tagline, 50, 175, W - 100, 14);

    /* Body */
    y = 250;
    doc.setTextColor(40,40,40);
    course.content.forEach(section => {
      if (y > 720) { doc.addPage(); y = 60; }
      doc.setFont('helvetica','bold'); doc.setFontSize(13); doc.setTextColor(r,g,b);
      doc.text(section.h, 50, y); y += 18;
      doc.setFont('helvetica','normal'); doc.setFontSize(11); doc.setTextColor(50,50,50);
      const lines = doc.splitTextToSize(section.p, W - 100);
      lines.forEach(line => { if (y > 760) { doc.addPage(); y = 60; } doc.text(line, 50, y); y += 16; });
      y += 12;
    });

    /* Footer note on every page */
    const pages = doc.internal.getNumberOfPages();
    for (let i = 1; i <= pages; i++) {
      doc.setPage(i);
      doc.setFontSize(8); doc.setTextColor(120,120,140);
      doc.text('© Bankerise Partner Academy  ·  ' + course.code + '  ·  Page ' + i + ' / ' + pages,
               50, doc.internal.pageSize.getHeight() - 25);
    }

    doc.save(`bankerise-${course.code}-${slugify(course.title)}.pdf`);
  }

  function hexToRgb(hex) {
    const m = hex.replace('#','').match(/.{2}/g);
    return [parseInt(m[0],16), parseInt(m[1],16), parseInt(m[2],16)];
  }
  function splitText(doc, text, x, y, maxW, lineH) {
    const lines = doc.splitTextToSize(text, maxW);
    lines.forEach((l, i) => doc.text(l, x, y + i * lineH));
  }
  function slugify(s) { return s.toLowerCase().replace(/[^a-z0-9]+/g,'-').replace(/^-|-$/g,''); }

  /* ── 4. Render UI updates ── */
  function statusFor(id) {
    const cs = getCourseState(id);
    if (cs.completed) return 'completed';
    if (cs.downloaded) return 'downloaded';
    if (cs.enrolled) return 'enrolled';
    return 'idle';
  }

  function renderCourseCard(card) {
    const id = card.dataset.courseId;
    const cs = getCourseState(id);
    const status = statusFor(id);

    card.dataset.status = status;
    const stateLabel = card.querySelector('[data-state-label]');
    const enrollBtn  = card.querySelector('[data-action="enroll"]');
    const downloadBtn= card.querySelector('[data-action="download"]');
    const completeBtn= card.querySelector('[data-action="complete"]');
    const checkIcon  = card.querySelector('[data-check]');

    enrollBtn.classList.toggle('hidden', cs.enrolled);
    downloadBtn.classList.toggle('hidden', !cs.enrolled || cs.completed);
    completeBtn.classList.toggle('hidden', !cs.downloaded || cs.completed);
    if (checkIcon) checkIcon.classList.toggle('opacity-100', cs.completed);

    if (stateLabel) {
      stateLabel.textContent = ({
        idle:       'Not started',
        enrolled:   'Enrolled · ready to download',
        downloaded: 'Downloaded · pending completion',
        completed:  'Completed ✓'
      })[status];
    }
  }

  function renderAll() {
    document.querySelectorAll('[data-course-id]').forEach(renderCourseCard);
    renderProgress();
    renderTrackProgress();
  }

  function renderProgress() {
    const ids = Object.keys(COURSES);
    const total = ids.length;
    const done = ids.filter(i => getCourseState(i).completed).length;
    const pct = Math.round((done / total) * 100);
    const bar = document.getElementById('academyProgressBar');
    const txt = document.getElementById('academyProgressText');
    const big = document.getElementById('academyProgressBig');
    if (bar) bar.style.width = pct + '%';
    if (txt) txt.textContent = `${done} of ${total} courses completed`;
    if (big) big.textContent = pct + '%';

    const certBlock = document.getElementById('academyCertificate');
    if (certBlock) certBlock.classList.toggle('is-unlocked', done === total);
  }

  function renderTrackProgress() {
    Object.values(TRACKS).forEach(t => {
      const completed = t.courses.filter(c => getCourseState(c).completed).length;
      const wrap = document.querySelector(`[data-track-id="${t.id}"]`);
      if (!wrap) return;
      const bar = wrap.querySelector('[data-track-bar]');
      const lbl = wrap.querySelector('[data-track-label]');
      const badge = wrap.querySelector('[data-track-badge]');
      const pct = (completed / t.courses.length) * 100;
      if (bar) bar.style.width = pct + '%';
      if (lbl) lbl.textContent = `${completed} / ${t.courses.length}`;
      if (badge) badge.classList.toggle('is-earned', completed === t.courses.length);
    });
  }

  /* ── 5. Wire events ── */
  document.addEventListener('click', async (e) => {
    const btn = e.target.closest('[data-action]');
    if (!btn) return;
    const card = btn.closest('[data-course-id]');
    if (!card) return;
    const id = card.dataset.courseId;
    const action = btn.dataset.action;

    if (action === 'enroll') {
      setCourseState(id, { enrolled: true });
      flash(card, 'Enrolled');
    } else if (action === 'download') {
      btn.disabled = true;
      const original = btn.innerHTML;
      btn.innerHTML = '<span class="spinner"></span> Generating…';
      try {
        await downloadCoursePDF(id);
        setCourseState(id, { downloaded: true });
        flash(card, 'Downloaded');
      } catch (err) {
        alert('Could not generate the PDF. Check your connection and try again.');
      } finally {
        btn.disabled = false;
        btn.innerHTML = original;
      }
    } else if (action === 'complete') {
      setCourseState(id, { completed: true });
      flash(card, 'Completed!');
      confettiBurst(card);
    } else if (action === 'reset') {
      if (confirm('Reset your academy progress? This clears every course state on this device.')) {
        state = {}; saveState(state); renderAll();
      }
    }
    renderAll();
  });

  function flash(card, msg) {
    const t = document.createElement('div');
    t.className = 'academy-toast';
    t.textContent = msg;
    card.appendChild(t);
    requestAnimationFrame(() => t.classList.add('is-in'));
    setTimeout(() => { t.classList.remove('is-in'); setTimeout(() => t.remove(), 400); }, 1400);
  }

  function confettiBurst(card) {
    const colors = ['#4DB8CD','#766CFF','#4799D1','#4ade80','#f59e0b'];
    for (let i = 0; i < 18; i++) {
      const p = document.createElement('span');
      p.className = 'academy-confetti';
      p.style.background = colors[i % colors.length];
      p.style.setProperty('--dx', (Math.random() - .5) * 200 + 'px');
      p.style.setProperty('--dy', -Math.random() * 220 - 60 + 'px');
      p.style.setProperty('--rot', Math.random() * 720 + 'deg');
      card.appendChild(p);
      setTimeout(() => p.remove(), 1200);
    }
  }

  /* ── 6. Init ── */
  document.addEventListener('DOMContentLoaded', renderAll);
  if (document.readyState !== 'loading') renderAll();
})();
