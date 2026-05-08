/* ============================================
   Bankerise — Partners Preview JS
   Spotlight + scroll reveal
   ============================================ */
(function(){
'use strict';

document.addEventListener('DOMContentLoaded', function(){
  initSpotlight();
  initReveal();
});

/* ── Cursor-tracking Spotlight ─────────────── */
function initSpotlight(){
  document.querySelectorAll('.pp-card').forEach(function(card){
    var spot = card.querySelector('.pp-card-spotlight');
    if(!spot) return;
    card.addEventListener('mousemove', function(e){
      var r = card.getBoundingClientRect();
      var x = e.clientX - r.left;
      var y = e.clientY - r.top;
      spot.style.background =
        'radial-gradient(300px circle at '+x+'px '+y+'px, rgba(69,212,197,0.08), transparent 60%)';
    });
    card.addEventListener('mouseleave', function(){
      spot.style.background = '';
    });
  });
}

/* ── Scroll Reveal ─────────────────────────── */
function initReveal(){
  var els = document.querySelectorAll('.pp-card, .pp-header, .pp-bottom');
  if(!els.length) return;
  var obs = new IntersectionObserver(function(entries){
    entries.forEach(function(en){
      if(en.isIntersecting){
        en.target.classList.add('visible');
        obs.unobserve(en.target);
      }
    });
  }, { threshold: 0.15 });
  els.forEach(function(el, i){
    if(el.classList.contains('pp-card')){
      el.style.transitionDelay = (i * 0.12)+'s';
    }
    obs.observe(el);
  });
}

})();
