/* resources/js/animations/landing/_stats.js */
export function initStatsAnimations(gsap, lenis = null) {
  if (!gsap?.utils) return console.error('[Stats] gsapInstance inválido');
  const ScrollTrigger = gsap.core?.globals?.().ScrollTrigger || window.ScrollTrigger;
  if (!ScrollTrigger) return console.error('[Stats] Falta ScrollTrigger');

  const section = document.querySelector('#stats-section');
  if (!section) return;

  const track   = section.querySelector('.stats-track');
  const slides  = gsap.utils.toArray('.stat-slide');
  const counts  = gsap.utils.toArray('.stat-count');
  const title   = document.querySelector('#stats-title');
  const dots    = gsap.utils.toArray('#stats-dots li');

  /* ─── 0 ▸ fade-in del título ─────────────────────────────────────────── */
  gsap.from(title, { opacity: 0, y: -20, duration: .8, ease: 'power2.out',
                     scrollTrigger: { trigger: section, start: 'top 85%' }});

  /* ─── 1 ▸ pasillo horizontal (pin) ───────────────────────────────────── */
  const scrollTL = gsap.to(track, {
    x: () => -(track.scrollWidth - section.clientWidth),
    ease: 'none',
    scrollTrigger: {
      trigger: section,
      start: 'top top',
      end: () => `+=${track.scrollWidth - section.clientWidth}`,
      scrub: true,
      pin: true,
      anticipatePin: 1,
      invalidateOnRefresh: true,
      onUpdate: self => highlightDot(self.progress),
    }
  });

  function highlightDot(progress) {
    const idx = Math.round(progress * (slides.length - 1));
    dots.forEach((d, i) =>
      d.style.backgroundColor = i === idx ? 'var(--color-ipn-guinda)' : 'rgba(90,18,54,.3)');
  }

  /* ─── 2 ▸ llegada de cada slide (scale + blur) ───────────────────────── */
  slides.forEach(slide => {
    const wrapper = slide.querySelector('.stat-slide-content-wrapper');
    const context = slide.querySelector('.stat-context-info');

    gsap.fromTo(wrapper,
      { scale: .85, opacity: .25, filter: 'blur(4px)' },
      {
        scale: 1, opacity: 1, filter: 'blur(0px)',
        ease: 'power1.out',
        scrollTrigger: {
          trigger: slide,
          containerAnimation: scrollTL,
          start: 'left 75%',
          end: 'center center',
          scrub: true,
        }
      });

    /* contexto descriptivo ------------------------------------------------ */
    gsap.fromTo(context,
      { opacity: 0, y: 30 },
      {
        opacity: 1, y: 0,
        ease: 'circ.out',
        scrollTrigger: {
          trigger: slide,
          containerAnimation: scrollTL,
          start: 'left center+=10%',
          end: 'center center-=10%',
          scrub: .5,
        }
      });
  });

  /* ─── 3 ▸ contadores + pulso final ───────────────────────────────────── */
  counts.forEach(el => {
    const target = +el.dataset.target || 0;
    const suffix = el.dataset.suffix || '';

    gsap.fromTo(el, { innerText: 0 }, {
      innerText: target,
      scrollTrigger: {
        trigger: el.parentElement,
        containerAnimation: scrollTL,
        start: 'left center',
        end: 'center center',
        scrub: true,
        onLeave: () => pulse(el),
      },
      snap: { innerText: 1 },
      ease: 'none',
      onUpdate() {
        el.innerText = Number(el.innerText).toLocaleString('es-MX') + suffix;
      }
    });

    function pulse(element) {
      gsap.fromTo(element, { scale: 1 }, {
        scale: 1.08,
        duration: .25,
        yoyo: true,
        repeat: 1,
        ease: 'power1.inOut'
      });
    }
  });

  /* ─── 4 ▸ prefers-reduced-motion & Lenis sync ────────────────────────── */
  gsap.matchMedia().add('(prefers-reduced-motion: reduce)', () => {
    ScrollTrigger.getAll().forEach(t => t.kill());
    gsap.set([track, slides, counts], { clearProps: 'all' });
  });

  if (lenis && ScrollTrigger.update) lenis.on('scroll', ScrollTrigger.update);
}
