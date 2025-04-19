// resources/js/bubble.js
export default function attachBubbleCTA(sel = '.bubble-cta') {
  document.querySelectorAll(sel).forEach(btn => {

    /* elementos ───────────────────────────────────── */
    const track = btn.querySelector('.bubble-track');      // disco
    const halo  = btn.closest('.bubble-box')?.querySelector('.bubble-halo');

    if (!track || !halo) return;                           // sin piezas → skip

    const D    = track.offsetWidth;   // 120 px
    const OVER = D / 3;               // desborde permitido
    let width  = btn.offsetWidth;     // ancho del botón (refrescable)
    let timer  = null;                // para el auto‑return
    let easing = '.5s ease';         // transición estándar

    const clamp = (v, min, max) => Math.max(min, Math.min(v, max));

    /* util: aplica “left” con/ sin transición */
    const setLeft = (px, withAnim = true) => {
      track.style.transition = withAnim ? `left ${easing}` : 'none';
      track.style.left       = `${px}px`;
    };

    /* ----------------------------------------------------------------
       ❶  posición por defecto  – pegado a la derecha
       ---------------------------------------------------------------*/
    const snapRight = (withAnim = false) => {
      width = btn.offsetWidth;
      const x = width - D + OVER;           // orilla derecha
      setLeft(x, withAnim);
      halo.style.transition = withAnim ? `opacity ${easing}` : 'none';
      halo.style.opacity    = '1';
      halo.style.transform  = 'scaleX(-1)'; // gradiente mira al centro
    };

    /* ----------------------------------------------------------------
       ❷  seguir al cursor (latencia ≈ 0 ms una vez “llegó”)
       ---------------------------------------------------------------*/
    function follow(e) {
      clearTimeout(timer);                  // cancela auto‑return
      const rect = btn.getBoundingClientRect();
      width      = rect.width;

      /* disco ------------------------------------------------------ */
      const rawX = e.clientX - rect.left - D / 2;
      const x    = clamp(rawX, -OVER, width - D + OVER);

      /* ─ si el disco todavía no está “en destino” usamos transición
           (primer cuadro) ; al segundo follow ya estaremos pegados y
           la transición se quita para que el arrastre sea 1:1 ───── */
      const needsAnim = track.style.left === '' ||
                        Math.abs(parseFloat(track.style.left) - x) > 4;
      setLeft(x, needsAnim);
      if (!needsAnim) track.style.transition = 'none';

      /* halo ------------------------------------------------------- */
      const center  = x + D / 2;            // centro del disco
      const delta   = Math.abs(center - width / 2);
      const dead    = 0.35 * (width / 2);   // 35 % “zona muerta”
      const span    = width / 2 - dead;
      const factor  = delta <= dead ? 0 : (delta - dead) / span;

      halo.style.opacity   = factor;
      halo.style.transform = center < width / 2 ? 'scaleX(1)' : 'scaleX(-1)';
    }

    /* ----------------------------------------------------------------
       ❸  al salir: se pega al borde y, si pasa 2 s, vuelve a la derecha
       ---------------------------------------------------------------*/
    function slideOut() {
      clearTimeout(timer);

      const center = track.offsetLeft + D / 2;
      const target = center < width / 2 ? -OVER : width - D + OVER;

      setLeft(target, true);

      halo.style.transition = `opacity ${easing}`;
      halo.style.opacity    = '1';
      halo.style.transform  = target < 0 ? 'scaleX(1)' : 'scaleX(-1)';

      timer = setTimeout(() => snapRight(true), 2000);
    }

    /* listeners ───────────────────────────────────── */
    btn.addEventListener('mousemove', follow, { passive: true });
    btn.addEventListener('mouseleave', slideOut);
    btn.addEventListener('mouseenter', () => clearTimeout(timer));

    /* posición inicial ─ sin animación */
    requestAnimationFrame(() => snapRight(false));
  });
}
