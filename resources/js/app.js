// resources/js/app.js
import './bootstrap';

import Alpine   from 'alpinejs';
import intersect from '@alpinejs/intersect';
import collapse  from '@alpinejs/collapse';

import attachBubbleCTA     from './bubble.js';
import registerForm        from './components/registerForm';
import adminCreateUserForm from './components/adminCreateUserForm';
import adminCatalogForm   from './components/adminCatalogForm';

import Lenis  from 'lenis';
import gsap   from 'gsap';
import { ScrollTrigger } from 'gsap/ScrollTrigger';
import { CSSPlugin } from "gsap/CSSPlugin";
import { initHeroAnimations } from './animations/landing/_hero.js';
import { initRecursosAnimations } from './animations/landing/_recursos.js';
import { initServiciosAnimations } from './animations/landing/_servicios.js';
import { initParallaxSections } from './animations/landing/_parallax.js'; // << NUEVA IMPORTACIÓN
import { initComunidadAnimations } from '@/animations/landing/_comunidad';
import { initNoticiasAnimations } from '@/animations/landing/_noticias';
import { initHeaderAnimations } from '@/animations/layout/_header.js';
import { initStatsAnimations } from '@/animations/landing/_stats.js';
import { initCtaFinal } from './animations/landing/_ctaFinal.js';
import initBurstCTA from "./animations/burstButton";

// ---------- Lenis + GSAP ----------
gsap.registerPlugin(ScrollTrigger);
gsap.registerPlugin(CSSPlugin);

const lenis = new Lenis({
  duration: 1.2,
  lerp    : 0.08,
  smooth  : true,
  smoothTouch: false,
  touchMultiplier: 2,
});
lenis.on('scroll', ScrollTrigger.update);
gsap.ticker.add(t => lenis.raf(t * 1000));
gsap.ticker.lagSmoothing(0);

// ---------- Alpine ----------
Alpine.data('registerForm',      registerForm);
Alpine.data('adminCreateUserForm', adminCreateUserForm);
Alpine.data('adminCatalogForm',   adminCatalogForm);
Alpine.data('bubbleCTA',         attachBubbleCTA);

Alpine.plugin(intersect);
Alpine.plugin(collapse);

window.Alpine = Alpine;
Alpine.start();

// ---------- Arranque de animaciones ----------
document.addEventListener('DOMContentLoaded', () => {
    console.log('DOM completamente cargado y parseado.');

    if (typeof attachBubbleCTA === 'function') {
        attachBubbleCTA();
    } else {
        console.error('attachBubbleCTA no es una función.');
    }

    if (typeof initHeroAnimations === 'function') {
        initHeroAnimations(undefined, lenis);
    } else {
        console.error('initHeroAnimations no es una función.');
    }

    if (typeof initRecursosAnimations === 'function') {
        initRecursosAnimations(gsap, lenis);
    } else {
        console.error('initRecursosAnimations no es una función.');
    }

    if (typeof initServiciosAnimations === 'function') {
        initServiciosAnimations(gsap, lenis);
    } else {
        console.error('initServiciosAnimations no es una función.');
    }

    if (typeof initParallaxSections === 'function') { // << NUEVA LLAMADA
        initParallaxSections(lenis);
    } else {
        console.error('initParallaxSections no es una función.');
    }
    if (typeof initComunidadAnimations === 'function') {
        initComunidadAnimations(lenis);
    }
    if (typeof initNoticiasAnimations === 'function') {
        initNoticiasAnimations(lenis);
    } 
    if (typeof initHeaderAnimations === 'function') {
        initHeaderAnimations(lenis);
    }
    if (typeof initStatsAnimations === 'function') {
        initStatsAnimations(gsap, lenis);
    } else {
        console.error('initStatsAnimations no es una función.');
    }
    if (typeof initCtaFinal === 'function') {
        initCtaFinal(gsap, lenis);
    } else {
        console.error('initCtaFinal no es una función.');
    }
    if (typeof initBurstCTA === 'function') {
        initBurstCTA(gsap, '.btn-ripple, .btn-ripple-secondary');
    } else {
        console.error('initBurstCTA no es una función.');
    }
});