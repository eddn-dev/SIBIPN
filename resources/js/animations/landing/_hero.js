// ---------------------------------------------------------------------------
//  animations/hero/_hero.js  ·  SIB-IPN Hero Animations
//    · Mosaico escalonado + reveal                        · Parallax mouse
//    · Entrada express título / subtítulo / buscador / CTA· Parallax scroll
// ---------------------------------------------------------------------------

import Lenis from 'lenis';
import gsap  from 'gsap';
import { ScrollTrigger } from 'gsap/ScrollTrigger';

// ——— Asegura plugin ScrollTrigger ————————————————————————————————
if (!gsap.core.globals().ScrollTrigger) {
  gsap.registerPlugin(ScrollTrigger);
}

export function initHeroAnimations(
  section      = document.querySelector('#hero-section'),
  lenisInstance = null,
) {
  if (!section) {
    console.warn('[Hero] #hero-section no encontrado'); 
    return () => {};
  }

  // ——— 1 · Selectores ————————————————————————————————————————
  const $ = (sel, root = section) => root.querySelector(sel);
  const mosaicContainer     = $('#hero-mosaic-container');
  const mosaicTiles         = gsap.utils.toArray(section.querySelectorAll('.hero-mosaic-tile'));
  const overlay             = $('#hero-overlay');
  const titleWords          = gsap.utils.toArray(section.querySelectorAll('#hero-main-title span'));
  const subtitle            = $('#hero-subtitle');
  const searchForm          = $('#hero-search-form');
  const ctaButtons          = gsap.utils.toArray(section.querySelectorAll('#hero-buttons-container > *'));

  // ——— 2 · Lenis + ticker GSAP ————————————————————————————————
  const lenis = lenisInstance ?? new Lenis({
    duration: 1.1,
    lerp    : 0.08,
    smooth  : true,
    smoothTouch: false,
    touchMultiplier: 2,
  });
  lenis.on('scroll', ScrollTrigger.update);
  gsap.ticker.add(t => lenis.raf(t * 1000));
  gsap.ticker.lagSmoothing(0);

  // ——— 3 · Timeline de entrada ——————————————————————————————
  const introTL = gsap.timeline({ defaults: { ease: 'power2.out' } });

  /* 3.1  Mosaico — piezas y revelado filtro */
  introTL.from(mosaicTiles, {
    opacity : 0,
    scale   : 0.9,
    duration: 0.7,
    stagger : 0.05,
  }, 0)
  .to(mosaicContainer, {
    filter  : 'blur(0px) brightness(100%)',
    duration: 1.0,
    ease    : 'power1.inOut',
  }, 0.25);

  /* 3.2  Overlay – fade-in rápido (sin moverlo jamás) */
  if (overlay) {
    overlay.style.opacity = 0;
    introTL.to(overlay, { opacity: 0.7, duration: 0.8 }, 0.15);
  }

  /* 3.3  Título palabra-por-palabra */
  introTL.from(titleWords, {
    y       : 70,
    opacity : 0,
    duration: 0.6,
    stagger : 0.15,
    ease    : 'power3.out',
  }, '-=0.15');

  /* 3.4  Subtítulo – entra casi pegado al título */
  introTL.from(subtitle, {
    y       : 35,
    opacity : 0,
    duration: 0.5,
  }, '-=0.40');                     // solapa más

  /* 3.5  Buscador – zoom leve */
  introTL.from(searchForm, {
    opacity : 0,
    scale   : 0.9,
    duration: 0.55,
    ease    : 'back.out(1.3)',
  }, '-=0.35');

  /* 3.6  CTA buttons – ambos a la vez con micro-stagger */
  introTL.from(ctaButtons, {
    opacity    : 0,
    scale      : 0.6,
    duration   : 0.5,
    stagger    : 0.07,
    ease       : 'back.out(1.6)',
    clearProps : 'transform,opacity',
  }, '-=0.30');

  // ——— 4 · Parallax mouse (solo mosaico) ————————————————
  const handleMouse = e => {
    const { left, top, width, height } = section.getBoundingClientRect();
    const xN = (e.clientX - left - width / 2)  / (width  / 2);
    const yN = (e.clientY - top  - height / 2) / (height / 2);

    mosaicTiles.forEach((tile, i) => {
      const f = (i % 3 + 1) * 0.02;           // profundidad variable
      gsap.to(tile, {
        x       : xN * 50 * f,
        y       : yN * 30 * f,
        rotation: xN * 4  * f,
        duration: 0.5,
        ease    : 'power1.out',
      });
    });
  };
  section.addEventListener('pointermove', handleMouse);
  section.addEventListener('pointerleave', () =>
    gsap.to(mosaicTiles, { x:0, y:0, rotation:0, duration:0.7, ease:'elastic.out(1,0.5)' })
  );

  // ——— 5 · Parallax scroll (mosaico solo) ————————————————
  if (mosaicContainer) {
    gsap.to(mosaicContainer, {
      yPercent : -25,
      ease     : 'none',
      scrollTrigger: {
        trigger : section,
        start   : 'top top',
        end     : 'bottom top',
        scrub   : true,
        invalidateOnRefresh:true,
      },
    });
  }

  // ——— 6 · Destructor (para SPA / Livewire) ————————————————
  return () => {
    section.removeEventListener('pointermove', handleMouse);
    ScrollTrigger.getAll().forEach(st => st.kill());
    introTL.kill();
    if (!lenisInstance) lenis.destroy();
  };
}
