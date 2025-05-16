/* resources/js/animations/burstButton.js
   Refactor: el fondo toma --burstColor y texto/borde adoptan el bg inicial
*/
import { CSSPlugin } from 'gsap/CSSPlugin';

export default function initBurstCTA(gsap, sel = '.btn-ripple, .btn-ripple-secondary') {
  gsap.registerPlugin(CSSPlugin);
  if (matchMedia('(prefers-reduced-motion: reduce)').matches) return;

  document.querySelectorAll(sel).forEach(btn => {
    /* 1 ▸ span .burst — crea uno si no existe */
    let burst = btn.querySelector('.burst');
    if (!burst) {
      burst = document.createElement('span');
      burst.className = 'burst';
      btn.appendChild(burst);
    }

    /* 2 ▸ cachea colores originales la primera vez */
    if (!btn.dataset.origBg) {
      const cs = getComputedStyle(btn);
      btn.dataset.origBg     = cs.getPropertyValue('--bgColor').trim();
      btn.dataset.origBorder = cs.getPropertyValue('--borderCol').trim();
      btn.dataset.origText   = cs.getPropertyValue('--textCol').trim();
      btn.dataset.burstColor = cs.getPropertyValue('--burstColor').trim() // puede no existir
                               || cs.getPropertyValue('--borderCol').trim();
    }

    const cssVar = (p, v) => btn.style.setProperty(p, v);
    const R = (x, y, w, h) => Math.hypot(Math.max(x, w - x), Math.max(y, h - y)) * 1.05;

    let tl; // timeline activo

    /* 3 ▸ ENTER ---------------------------------------------------- */
    btn.addEventListener('pointerenter', e => {
      const { left, top, width, height } = btn.getBoundingClientRect();
      const x = e.clientX - left;
      const y = e.clientY - top;

      burst.style.setProperty('--x', `${x}px`);
      burst.style.setProperty('--y', `${y}px`);

      tl?.kill();
      tl = gsap.timeline()
        /* clip-path del círculo */
        .fromTo(burst,
          { clipPath: `circle(0px at ${x}px ${y}px)` },
          { clipPath: `circle(${R(x, y, width, height)}px at ${x}px ${y}px)`,
            ease: 'expo.out', duration: 0.5 })
        /* inversión de colores (en el mismo instante 0) */
        .to(btn, {
          '--bgColor'  : btn.dataset.burstColor,   // fondo = burst
          '--borderCol': btn.dataset.origBg,       // borde / texto = bg previo
          '--textCol'  : btn.dataset.origBg,
          duration: 0.15, ease: 'none'
        }, 0);
    });

    /* 4 ▸ MOVE opcional (mantener drift si lo usas) ---------------- */
    btn.addEventListener('pointermove', e => {
      const { left, top, width, height } = btn.getBoundingClientRect();
      cssVar('--bgX', `${((e.clientX - left) / width  * 60 + 20).toFixed(1)}%`);
      cssVar('--bgY', `${((e.clientY - top ) / height * 60 + 20).toFixed(1)}%`);
    });

    /* 5 ▸ LEAVE ---------------------------------------------------- */
    btn.addEventListener('pointerleave', e => {
      const { left, top, width, height } = btn.getBoundingClientRect();
      const x = e.clientX - left;
      const y = e.clientY - top;

      tl?.kill();
      tl = gsap.timeline()
        .fromTo(burst,
          { clipPath: `circle(${R(x, y, width, height)}px at ${x}px ${y}px)` },
          { clipPath: `circle(0px at ${x}px ${y}px)`,
            ease: 'expo.in', duration: 0.4 })
        /* restaurar colores originales */
        .to(btn, {
          '--bgColor'  : btn.dataset.origBg,
          '--borderCol': btn.dataset.origBorder,
          '--textCol'  : btn.dataset.origText,
          duration: 0.25, ease: 'none'
        }, 0);

      // recentra gradiente opcional
      gsap.to(btn, { '--bgX': '50%', '--bgY': '50%', duration: 0.1 });
    });
  });
}
