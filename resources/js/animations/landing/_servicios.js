/**
 *  Scroll-linked animaciones para “Servicios Bibliotecarios”
 *  – sin dependencias temporales – compatible con Lenis + GSAP 3.x
 */
export function initServiciosAnimations(gsapInstance, lenisInstance) {
  if (!gsapInstance || !gsapInstance.utils) {
    console.error('[Servicios] gsapInstance no válido.');
    return;
  }

  // Asegurarse de que el plugin esté disponible
  const ScrollTrigger = gsapInstance.core?.globals?.().ScrollTrigger || window.ScrollTrigger;
  if (!ScrollTrigger) {
    console.error('[Servicios] ScrollTrigger no está cargado/registrado.');
    return;
  }

  const section = document.querySelector('#servicios-section');
  if (!section) return;

  const items = gsapInstance.utils.toArray('.service-item');

  /* ---- reveal dependiente de scroll (scrub) --------------------------- */
  const mm = gsapInstance.matchMedia();
  mm.add('(prefers-reduced-motion: no-preference)', () => {
    items.forEach(item => {
      gsapInstance.fromTo(item,
        { opacity: 0, x: -50 },
        {
          opacity: 1,
          x: 0,
          ease: 'none',
          scrollTrigger: {
            trigger: item,
            start: 'top 85%',
            end: 'top 60%',
            scrub: true,
          }
        });
    });

    /*  Sincronizar con Lenis sólo si ambos existen ---------------------- */
    if (lenisInstance && typeof ScrollTrigger.update === 'function') {
      lenisInstance.on('scroll', ScrollTrigger.update);
    }
  });

  /* ---- hover micro-interacciones (se conserva) ------------------------ */
  items.forEach(item => {
    const iconBox = item.querySelector('.service-icon-container');
    const iconSvg = item.querySelector('.service-icon-svg');
    const title   = item.querySelector('.service-title');
    const arrow   = item.querySelector('.service-arrow');

    const css = getComputedStyle(document.documentElement);
    const base = css.getPropertyValue('--color-ipn-guinda').trim()       || '#5A1236';
    const light = css.getPropertyValue('--color-ipn-guinda-light').trim()|| '#7A2A4D';

    const tl = gsapInstance.timeline({ paused:true, defaults:{duration:.3, ease:'sine.inOut'}});
    if (iconBox) tl.to(iconBox, { color: light }, 0);
    if (iconSvg) tl.to(iconSvg, { rotate:12, scale:1.18, transformOrigin:'center' }, 0);
    if (title)   tl.to(title,   { color: light }, 0);
    if (arrow)   tl.to(arrow,   { x:5 }, 0);

    item.addEventListener('mouseenter', () => tl.play());
    item.addEventListener('mouseleave', () => tl.reverse());
  });

  /* ---- reduced motion: limpia triggers y estilos ---------------------- */
  mm.add('(prefers-reduced-motion: reduce)', () => {
    ScrollTrigger.getAll().forEach(t => t.kill());
    gsapInstance.set(items, { clearProps: 'all' });
  });
}
