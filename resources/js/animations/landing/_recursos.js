/*  _recursos.js  —  Scroll-linked animaciones para “Recursos Destacados”
    · entrada revelada por scroll (scrub)   · hover Ken-Burns + sombra
    · feedback de clic                      · accesible (prefers-reduced-motion)
    · sincronizable con Lenis
---------------------------------------------------------------------------- */

export function initRecursosAnimations(gsapInstance, lenisInstance = null) {
  if (!gsapInstance || !gsapInstance.utils) {
    console.error('[Recursos] gsapInstance no válido.');
    return () => {};
  }

  const ScrollTrigger = gsapInstance.core?.globals?.().ScrollTrigger || window.ScrollTrigger;
  if (!ScrollTrigger) {
    console.error('[Recursos] ScrollTrigger no está cargado o registrado.');
    return () => {};
  }

  const section = document.querySelector('#recursos-section');
  if (!section) { console.warn('[Recursos] sección no encontrada'); return () => {}; }

  /* ─── targets ────────────────────────────────────────────────────────── */
  const cards     = gsapInstance.utils.toArray(section.querySelectorAll('.rc-card'));
  const bgImgs    = cards.map(c => c.querySelector('.rc-card-bg'));
  const overlays  = cards.map(c => c.querySelector('.rc-card-overlay'));
  const contents  = cards.map(c => c.querySelector('.rc-card-content'));

  /* ─── 1 · reveal scroll-dependiente (scrub) ──────────────────────────── */
  const mm = gsapInstance.matchMedia();

  mm.add('(prefers-reduced-motion: no-preference)', () => {
    cards.forEach(card => {
      gsapInstance.fromTo(card,
        { opacity: 0, y: 80 },
        {
          opacity: 1,
          y: 0,
          ease: 'none',
          scrollTrigger: {
            trigger : card,
            start   : 'top 90%',
            end     : 'top 60%',
            scrub   : true,              // ligado al scroll (no duration)
            // markers: true,            // -- descomenta para debug
          }
        });
    });

    /* sync con Lenis sólo si existe y ScrollTrigger expone update */
    if (lenisInstance && typeof ScrollTrigger.update === 'function') {
      lenisInstance.on('scroll', ScrollTrigger.update);
    }
  });

  /* ─── 2 · Hover / focus  (Ken-Burns + sombra) ───────────────────────── */
  cards.forEach((card, i) => {
    const tlHover = gsapInstance.timeline({
      paused   : true,
      defaults : { ease:'power1.out', duration: .35 }
    });

    tlHover
      .to(bgImgs[i],   { scale: 1.05 }, 0)
      .to(overlays[i], { opacity: 0.65 }, 0)
      .to(contents[i], { y: -10 }, 0)
      .to(card,        { boxShadow: '0 10px 30px rgba(0,0,0,.35)' }, 0);

    card.addEventListener('pointerenter', () => tlHover.play());
    card.addEventListener('pointerleave', () => tlHover.reverse());

    /* feedback de clic (mini-rebote) */
    card.addEventListener('pointerdown', () => {
      gsapInstance.fromTo(card,
        { scale: 1 },
        { scale: 0.96, duration: 0.12, ease:'power2.out',
          onComplete: () => gsapInstance.to(card,
            { scale:1, duration:.35, ease:'elastic.out(1,0.3)' }) });
    });
  });

  /* ─── 3 · Reduced-motion: limpiar y mostrar instantáneo ─────────────── */
  mm.add('(prefers-reduced-motion: reduce)', () => {
    ScrollTrigger.getAll().forEach(t => t.kill());
    gsapInstance.set(cards, { clearProps:'all' });
  });

  /* ─── 4 · Destructor para SPA / Livewire ────────────────────────────── */
  return () => {
    ScrollTrigger.getAll().forEach(t => t.kill());
    cards.forEach(card => {
      card.onmouseenter = card.onmouseleave = card.onpointerdown = null;
    });
  };
}
