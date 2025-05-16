import gsap from 'gsap'
import { ScrollTrigger } from 'gsap/ScrollTrigger'
gsap.registerPlugin(ScrollTrigger)

export function initCtaFinal(gsapInst, lenis){
  const circle = document.querySelector('#cta-window')
  if (!circle) return

  /* === helper: radio necesario para cubrir toda la pantalla ========== */
  const fullRadius = () =>
    Math.hypot(window.innerWidth, window.innerHeight) / 2 + 24      // +24 px colchón

  /* círculo arranca diminuto */
  gsapInst.set(circle, { '--r': '0px' })

  const tl = gsapInst.timeline({
    scrollTrigger:{
      trigger:'#cta-final',
      start:'top top',
      end:'+=2500',
      scrub:1,
      pin:true,
      invalidateOnRefresh:true    // recalcula fullRadius en resize/orient.
    }
  })

  /* ① Círculo: 0 → fullRadius px ------------------------------------ */
  tl.to(circle,
        { '--r': () => `${fullRadius()}px`, ease:'power2.inOut' },
        0)

  /* ② Fade-in contenido --------------------------------------------- */
  tl.fromTo('#cta-headline',{autoAlpha:0,y:40},
            {autoAlpha:1,y:0,duration:.5,ease:'power2.out'}, .25)
    .fromTo('#cta-paragraph',{autoAlpha:0,y:40},
            {autoAlpha:1,y:0,duration:.5}, .4)
    .fromTo('#cta-buttons-container',{autoAlpha:0,y:40},
            {autoAlpha:1,y:0,duration:.5}, .55)

  /* ③ Reduced-motion fallback --------------------------------------- */
  gsapInst.matchMedia().add('(prefers-reduced-motion: reduce)', () => {
    ScrollTrigger.getAll().forEach(t => t.kill())
    gsapInst.set(['#cta-headline','#cta-paragraph','#cta-buttons-container'],
                 {autoAlpha:1,y:0})
    gsapInst.set(circle, { '--r': `${fullRadius()}px` })
  })

  lenis?.on('scroll', ScrollTrigger.update)
}
