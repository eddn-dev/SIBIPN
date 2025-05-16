import gsap from 'gsap';
import { ScrollTrigger } from 'gsap/ScrollTrigger';

if (!gsap.core.globals().ScrollTrigger) gsap.registerPlugin(ScrollTrigger);

export function initComunidadAnimations(lenisInstance = null) {

  const mm = gsap.matchMedia();

  /* prefers-reduced-motion … idéntico */  /* -------------------------------- */
  mm.add('(prefers-reduced-motion: reduce)', () =>
    () => ScrollTrigger.getAll().forEach(st => st.kill())
  );

  mm.add('(prefers-reduced-motion: no-preference)', () => {

    /* ---------- Entrada global (empieza antes) ------------------------ */
    gsap.from('#comunidad-section', {
      opacity: 0,
      scale  : 0.98,
      filter : 'blur(8px)',
      duration: 1.2,
      ease: 'power3.out',
      scrollTrigger: {
        trigger:'#comunidad-section',
        start  :'top 92%',        // ← antes
      }
    });

    /* ---------- Helper títulos --------------------------------------- */
    const animateTitle = (sel, rot='rotationX') =>
      gsap.from(`${sel} span`, {
        opacity:0, y:70, [rot]:-40,
        transformOrigin:'center 70% -50',
        stagger:0.08, duration:0.8, ease:'expo.out',
        scrollTrigger:{ trigger:sel, start:'top 88%', once:true } // ← antes
      });

    /* ========== BLOQUE 1  (scrub) ==================================== */
    animateTitle('#comunidad-titulo1');

    const tl1 = gsap.timeline({
      defaults:{ ease:'power3.out' },
      scrollTrigger:{
        trigger:'#comunidad-bloque-1',
        start :'top 90%',         // ← antes
        end   :'bottom center',
        scrub : true
      }
    });

    tl1   /* ① imagen primero */
      .from('#comunidad-bloque1-imagen .comunidad-imagen',
            {opacity:0, x:140, scale:0.9, ease:'power4.out'})
      .from('#comunidad-parrafo1', {opacity:0, y:60}, '-=0.05')
      .from('#comunidad-features1 .feature-item',
            {opacity:0, x:-80, stagger:0.18}, '-=0.05')
      .from('#comunidad-features1 .feature-icon svg',
            {scale:0.2, opacity:0, rotate:-90, stagger:0.18,
             ease:'back.out(2.5)'}, '<');

    gsap.to('#comunidad-bloque1-imagen .comunidad-imagen',{
      yPercent:-8, ease:'none',
      scrollTrigger:{ trigger:'#comunidad-bloque-1',
        start:'top bottom', end:'bottom top', scrub:true, invalidateOnRefresh:true }
    });

    /* ---------- Separador igual ------------------------------------- */
    const sep = gsap.timeline({
      scrollTrigger:{ trigger:'#comunidad-separador', start:'top 95%', once:true }
    });
    sep.from('#comunidad-separador',
             {scaleX:0, transformOrigin:'center', duration:1, ease:'power2.inOut'})
       .from('.com-sep-flare',
             {opacity:1, x:'-50%', scaleX:0.1, duration:0.5, ease:'power1.in'}, 0.3)
       .to('.com-sep-flare', {opacity:0, duration:0.3}, 0.7);

    /* ========== BLOQUE 2  (scrub) ==================================== */
    animateTitle('#comunidad-titulo2','rotationY');

    const tl2 = gsap.timeline({
      defaults:{ ease:'power3.out' },
      scrollTrigger:{
        trigger:'#comunidad-bloque-2',
        start :'top 90%',         // ← antes
        end   :'bottom center',
        scrub : true
      }
    });

    tl2   /* ① imagen primero */
      .from('#comunidad-bloque2-imagen .comunidad-imagen',
            {opacity:0, x:-140, scale:1.1, ease:'power4.out'})
      .from('#comunidad-parrafo2', {opacity:0, x:60}, '-=0.05')
      .from('#comunidad-features2 .feature-item',
            {opacity:0, x:80, stagger:0.18}, '-=0.05')
      .from('#comunidad-features2 .feature-icon svg',
            {y:-60, opacity:0, stagger:0.18, ease:'bounce.out'}, '<');

    gsap.to('#comunidad-bloque2-imagen .comunidad-imagen',{
      yPercent:8, ease:'none',
      scrollTrigger:{ trigger:'#comunidad-bloque-2',
        start:'top bottom', end:'bottom top', scrub:true, invalidateOnRefresh:true }
    });

    /* ---------- Hover: imágenes (ambos bloques) ---------------------- */
    gsap.utils.toArray('.comunidad-imagen').forEach(img=>{
      const tlH = gsap.timeline({paused:true})
                      .to(img,{scale:1.03, boxShadow:'0 15px 35px rgba(0,0,0,.35)',
                               duration:0.35, ease:'sine.out'});
      img.addEventListener('pointerenter', ()=> tlH.play());
      img.addEventListener('pointerleave', ()=> tlH.reverse());
    });

    /* ---------- Hover: feature list (sin cambios) -------------------- */
    gsap.utils.toArray('.feature-item').forEach(it=>{
      const icon = it.querySelector('.feature-icon svg');
      const txt  = it.querySelector('.feature-text');
      it.addEventListener('pointerenter', ()=>{
        gsap.to(icon,{scale:1.3, rotate:15, color:'var(--ipn-oro)', duration:0.25});
        gsap.to(txt ,{x:3, duration:0.25});
      });
      it.addEventListener('pointerleave', ()=>{
        gsap.to(icon,{scale:1, rotate:0, color:'', duration:0.25});
        gsap.to(txt ,{x:0, duration:0.25});
      });
    });

    /* ---------- Lenis sync ------------------------------------------ */
    lenisInstance && lenisInstance.on('scroll', ScrollTrigger.update);
  });
}
