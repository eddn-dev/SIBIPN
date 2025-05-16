/*  resources/js/animations/landing/_parallax.js
    Parallax + zoom-tilt reutilizable
    — Configura cada sección con data-attributes:

    <section class="parallax-section"
             data-speed="0.55"        <!-- fondo translate ratio   -->
             data-overlay="0.25"      <!-- overlay translate ratio -->
             data-scale="1.15"        <!-- zoom final              -->
             data-rotate="3"          <!-- rotación final (grados) -->
             data-float="true"        <!-- texto flotante sí/no    -->
             data-inview="70">        <!-- % entrada texto         -->
*/

import gsap from "gsap";
import { ScrollTrigger } from "gsap/ScrollTrigger";
gsap.registerPlugin(ScrollTrigger);

export function initParallaxSections(lenis = null) {
  const sections = gsap.utils.toArray(".parallax-section");
  if (!sections.length) return;

  sections.forEach(section => {
    /* ---------- 1 · lectura de atributos -------------------------- */
    const speed     = parseFloat(section.dataset.speed   ?? 0.5);   // 0-1
    const overSpd   = parseFloat(section.dataset.overlay ?? 0.3);   // 0-1
    const scaleVal  = parseFloat(section.dataset.scale   ?? 1.1);   // ≥1
    const rotVal    = parseFloat(section.dataset.rotate  ?? 0);     // deg
    const floatTxt  = section.dataset.float === "true";
    const inView    = parseInt(section.dataset.inview ?? 75);       // %

    const bg      = section.querySelector(".parallax-bg-main");
    const overlay = section.querySelector(".parallax-overlay");
    const words   = gsap.utils.toArray(section.querySelectorAll(".parallax-text span"));

    /* ---------- 2 · fondo principal ------------------------------- */
    if (bg) {
      gsap.set(bg, { willChange: "transform" });

      gsap.to(bg, {
        y: () => -(bg.offsetHeight - section.offsetHeight) * speed,
        scale: scaleVal,
        rotation: rotVal,
        transformOrigin: "center center",
        ease: "none",
        scrollTrigger: {
          trigger: section,
          start: "top bottom",
          end: "bottom top",
          scrub: true,
          invalidateOnRefresh: true
        }
      });
    }

    /* ---------- 3 · overlay (opcional) ---------------------------- */
    if (overlay) {
      gsap.set(overlay, { willChange: "transform" });

      gsap.to(overlay, {
        y: () => -(overlay.offsetHeight - section.offsetHeight) * overSpd,
        ease: "none",
        scrollTrigger: {
          trigger: section,
          start: "top bottom",
          end: "bottom top",
          scrub: true,
          invalidateOnRefresh: true
        }
      });
    }

    /* ---------- 4 · texto ---------------------------------------- */
    if (words.length) {
      /* entrada */
      gsap.from(words, {
        y: 60,
        opacity: 0,
        rotationX: -45,
        scale: 0.9,
        stagger: 0.05,
        duration: 0.7,
        ease: "expo.out",
        scrollTrigger: {
          trigger: section,
          start: `top ${inView}%`,
          end: "+=200",
          toggleActions: "play none none reverse"
        }
      });

      /* flotación sutil */
      if (floatTxt) {
        const float = () =>
          gsap.to(words, {
            y: -4,
            stagger: { each: 0.03, from: "random" },
            repeat: -1,
            yoyo: true,
            duration: 2.2,
            ease: "sine.inOut"
          });

        ScrollTrigger.create({
          trigger: section,
          start: "top 60%",
          end: "bottom 40%",
          onEnter: float,
          onEnterBack: float,
          onLeave: () => gsap.killTweensOf(words),
          onLeaveBack: () => gsap.killTweensOf(words)
        });
      }
    }
  });

  /* ---------- 5 · Lenis sync + accesibilidad --------------------- */
  if (lenis) lenis.on("scroll", ScrollTrigger.update);

  gsap.matchMedia().add("(prefers-reduced-motion: reduce)", () => {
    ScrollTrigger.getAll().forEach(st => st.kill());
  });
}
