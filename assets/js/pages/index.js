/* ═══ INDEX PAGE — Platform Scroll-Story Controller ═══ */

(function () {
  const track = document.getElementById('platformTrack');
  if (!track) return;
  const panels = track.querySelectorAll('.platform-panel');
  const medias = track.querySelectorAll('.platform-media');
  const dots = track.querySelectorAll('.platform-step-dot');
  const total = 5;
  let current = 0;

  function setActive(i) {
    if (i === current || i < 0 || i >= total) return;
    current = i;
    panels.forEach((p, idx) => p.classList.toggle('is-active', idx === i));
    medias.forEach((m, idx) => m.classList.toggle('is-active', idx === i));
    dots.forEach((d, idx) => d.classList.toggle('is-active', idx === i));
  }

  function onScroll() {
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

  dots.forEach((d, idx) => {
    d.addEventListener('click', () => {
      const rect = track.getBoundingClientRect();
      const vh = window.innerHeight;
      const scrollable = rect.height - vh;
      const y = window.scrollY + rect.top + (scrollable * (idx / total)) + 20;
      window.scrollTo({ top: y, behavior: 'smooth' });
    });
  });

  onScroll();
})();
