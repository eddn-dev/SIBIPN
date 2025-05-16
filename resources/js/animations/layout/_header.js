// _header.js — Header contextual (sin efectos en links/botones)
import gsap from 'gsap';
import { ScrollTrigger } from 'gsap/ScrollTrigger';

if (!gsap.core.globals().ScrollTrigger) gsap.registerPlugin(ScrollTrigger); // docs GSAP v3 :contentReference[oaicite:0]{index=0}

export function initHeaderAnimations(lenisInstance = null) {
  const header = document.querySelector('header[data-animated]');
  if (!header) { console.warn('[Header] elemento no encontrado'); return () => {}; }

  /* 1 ▸ vidrio / blur al pasar 50 px ------------------------------------- */
  const toggleScrolled = () => header.classList.toggle('scrolled', scrollY > 50);
  toggleScrolled();                                          // estado inicial
  addEventListener('scroll', toggleScrolled, { passive: true });

  /* 2 ▸ barra de progreso (abajo) ---------------------------------------- */
  let bar = header.querySelector('.scroll-progress');
  if (!bar) {
    bar = document.createElement('span');
    bar.className = 'scroll-progress absolute left-0 bottom-0 h-0.5 w-full origin-left '
                  + 'scale-x-0 bg-white pointer-events-none';
    header.append(bar);                                      // ↓ al fondo
  }
  gsap.to(bar, { scaleX: 1, ease: 'none',
    scrollTrigger: { start: 0, end: 'max', scrub: .3 } });   // ejemplo oficial :contentReference[oaicite:1]{index=1}

  /* 3 ▸ hide / reveal según dirección de scroll -------------------------- */
  gsap.set(header, { yPercent: 0 });
  ScrollTrigger.create({
    start: 0, end: 'max',                                    // patrón foro GSAP :contentReference[oaicite:2]{index=2}
    onUpdate: self => {
      const hide = self.direction === 1 && self.scroll() > 150;
      gsap.to(header, {
        yPercent: hide ? -100 : 0,
        duration: hide ? .40 : .60,
        ease: 'power3.out'
      });
    }
  });

  /* 4 ▸ prefer-reduced-motion guard -------------------------------------- */
  gsap.matchMedia().add('(prefers-reduced-motion: reduce)', () => {          // guía GSAP :contentReference[oaicite:3]{index=3}
    ScrollTrigger.getAll().forEach(t => t.disable());
    gsap.set([header, bar], { clearProps: 'all' });
    removeEventListener('scroll', toggleScrolled);
    return () => {};
  });

  /* 5 ▸ sincronizar con Lenis (opcional) --------------------------------- */
  if (lenisInstance) lenisInstance.on('scroll', ScrollTrigger.update);

  /* destructor SPA -------------------------------------------------------- */
  return () => {
    ScrollTrigger.getAll().forEach(t => t.kill());
    removeEventListener('scroll', toggleScrolled);
  };
}
