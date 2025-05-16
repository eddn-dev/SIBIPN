// resources/js/animations/landing/_noticias.js
// Anima las tarjetas de la sección “Eventos y Noticias” replicando el
// comportamiento de “Recursos Destacados” + control de pointer-events.

import gsap from 'gsap';
import { ScrollTrigger } from 'gsap/ScrollTrigger';

if (!gsap.core.globals().ScrollTrigger) gsap.registerPlugin(ScrollTrigger);

/**
 * @param {Lenis|null|HTMLElement} arg1  – instancia Lenis o sección noticias
 * @param {HTMLElement|null}        arg2 – sección noticias si primero viene Lenis
 */
export function initNoticiasAnimations(arg1 = null, arg2 = null) {

  /* ─── normalizar argumentos ─────────────────────────────────────── */
  let lenisInstance, section;
  if (arg1 && typeof arg1.destroy === 'function') {
    lenisInstance = arg1;
    section       = arg2 || document.querySelector('#noticias-section');
  } else {
    section       = arg1 || document.querySelector('#noticias-section');
    lenisInstance = arg2;
  }
  if (!section) { console.warn('[Noticias] sección no encontrada'); return; }

  /* ─── obtener elementos ─────────────────────────────────────────── */
  const cards    = gsap.utils.toArray(section.querySelectorAll('.news-card'));
  const bgImgs   = cards.map(c => c.querySelector('.news-card-bg'));
  const overlays = cards.map(c => c.querySelector('.news-card-overlay'));
  const contents = cards.map(c => c.querySelector('.news-card-content'));

  /* ─── reduced-motion guard ──────────────────────────────────────── */
  const mm = gsap.matchMedia();
  mm.add('(prefers-reduced-motion: reduce)', () => {
    ScrollTrigger.getAll().forEach(st => st.kill());
    gsap.set(cards,     { clearProps: 'all' });
    gsap.set(bgImgs,    { clearProps: 'all' });
    gsap.set(overlays,  { clearProps: 'all' });
    gsap.set(contents,  { clearProps: 'all' });
    return () => {};
  });

  /* ─── animaciones normales ──────────────────────────────────────── */
  mm.add('(prefers-reduced-motion: no-preference)', () => {

    /* 1 ▸ reveal dependiente del scroll (scrub) + pointer-events —— */
    cards.forEach((card, idx) => {

      // estado inicial
      gsap.set(card, { opacity:0, y:80, scale:0.95, pointerEvents:'none' });

      const reveal = gsap.to(card, {
        opacity: 1,
        y: 0,
        scale: 1,
        ease: 'power2.out',
        scrollTrigger: {
          trigger: card,
          start: 'top 90%',          // comienza fuera de vista
          end:   'top 60%',          // termina cuando ya subió un poco
          scrub: true,
          onUpdate: self => {
            // habilita pointer-events sólo cuando el progreso ≥ 0.99
            card.style.pointerEvents = self.progress >= 0.99 ? 'auto' : 'none';
          }
        }
      });

    });

    /* 2 ▸ hover / focus (igual a Recursos) ———————————————————— */
    cards.forEach((card, i) => {
      const tlHover = gsap.timeline({
        paused: true,
        defaults: { duration: 0.35, ease: 'power1.out' }
      });

      tlHover
        .to(bgImgs[i],   { scale: 1.05 }, 0)               // Ken-Burns
        .to(overlays[i], { opacity: 0.65 }, 0)             // atenuar
        .to(contents[i], { y: -10 }, 0)                    // texto arriba
        .to(card,        { y:-6, boxShadow:'0 12px 28px rgba(0,0,0,.28),0 8px 10px rgba(0,0,0,.20)' }, 0);

      const enter = () => tlHover.play();
      const leave = () => tlHover.reverse();

      card.addEventListener('pointerenter', enter);
      card.addEventListener('pointerleave', leave);

      /* click bounce */
      card.addEventListener('pointerdown', () => {
        gsap.fromTo(card, { scale:1 }, {
          scale:0.96, duration:0.12, ease:'power2.out',
          onComplete: () => gsap.to(card, { scale:1, duration:0.35, ease:'elastic.out(1,0.3)' })
        });
      });
    });

    /* 3 ▸ Sincronizar con Lenis — (opcional) ———————————————— */
    if (lenisInstance) lenisInstance.on('scroll', ScrollTrigger.update);
  });
}
