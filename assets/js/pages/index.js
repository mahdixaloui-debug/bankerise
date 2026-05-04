/* ═══ INDEX PAGE — Platform Scroll-Story Controller ═══ */

(function () {
  const track = document.getElementById('platformTrack');
  if (!track) return;
  const panels = track.querySelectorAll('.platform-panel');
  const medias = track.querySelectorAll('.platform-media');
  const dots = track.querySelectorAll('.platform-step-dot');
  const total = 5;
  let current = 0;

  const isMobile = () => window.matchMedia('(max-width: 900px)').matches;

  function setActive(i) {
    if (i < 0) i = total - 1;
    if (i >= total) i = 0;
    if (i === current) return;
    current = i;
    panels.forEach((p, idx) => p.classList.toggle('is-active', idx === i));
    medias.forEach((m, idx) => m.classList.toggle('is-active', idx === i));
    dots.forEach((d, idx) => d.classList.toggle('is-active', idx === i));
  }

  /* ── Desktop: scroll-driven ── */
  function onScroll() {
    if (isMobile()) return;
    const rect = track.getBoundingClientRect();
    const vh = window.innerHeight;
    const scrolled = -rect.top;
    const scrollable = rect.height - vh;
    if (scrollable <= 0) return;
    const progress = Math.max(0, Math.min(1, scrolled / scrollable));
    const idx = Math.min(total - 1, Math.floor(progress * total));
    setActive(idx);
  }

  let ticking = false;
  window.addEventListener('scroll', () => {
    if (!ticking) {
      requestAnimationFrame(() => { onScroll(); ticking = false; });
      ticking = true;
    }
  }, { passive: true });

  /* ── Dots: click to navigate (mobile = swap only, desktop = scroll-to) ── */
  dots.forEach((d, idx) => {
    d.addEventListener('click', () => {
      if (isMobile()) {
        setActive(idx);
        return;
      }
      const rect = track.getBoundingClientRect();
      const vh = window.innerHeight;
      const scrollable = rect.height - vh;
      const y = window.scrollY + rect.top + (scrollable * (idx / total)) + 20;
      window.scrollTo({ top: y, behavior: 'smooth' });
    });
  });

  /* ── Mobile: swipe left/right on the media wrap ── */
  const mediaWrap = document.getElementById('platformMediaWrap');
  if (mediaWrap) {
    let startX = 0, startY = 0, tracking = false;
    mediaWrap.addEventListener('touchstart', (e) => {
      if (!isMobile() || e.touches.length !== 1) return;
      startX = e.touches[0].clientX;
      startY = e.touches[0].clientY;
      tracking = true;
    }, { passive: true });
    mediaWrap.addEventListener('touchend', (e) => {
      if (!tracking) return;
      tracking = false;
      const t = e.changedTouches[0];
      const dx = t.clientX - startX;
      const dy = t.clientY - startY;
      if (Math.abs(dx) > 40 && Math.abs(dx) > Math.abs(dy)) {
        setActive(current + (dx < 0 ? 1 : -1));
      }
    }, { passive: true });
  }

  /* ── Mobile: auto-advance every 5s, pause on user interaction ── */
  let autoTimer = null;
  let userInteracted = false;
  function startAuto() {
    if (!isMobile() || userInteracted || autoTimer) return;
    autoTimer = setInterval(() => setActive(current + 1), 5000);
  }
  function stopAuto() {
    if (autoTimer) { clearInterval(autoTimer); autoTimer = null; }
  }
  ['touchstart', 'click'].forEach(ev =>
    track.addEventListener(ev, () => { userInteracted = true; stopAuto(); }, { passive: true })
  );
  window.addEventListener('resize', () => {
    stopAuto();
    if (!userInteracted) startAuto();
  });

  onScroll();
  startAuto();
})();
