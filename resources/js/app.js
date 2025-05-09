// resources/js/app.js

import './bootstrap'; // Importa configuración inicial (axios, etc.)

// Importa Alpine y los plugins necesarios
import Alpine from 'alpinejs';
import intersect from '@alpinejs/intersect'; // Importa el plugin Intersect
import collapse from '@alpinejs/collapse';   // Importa el plugin Collapse
// resources/js/app.js  (archivo principal que ya importas con Vite)
import attachBubbleCTA from './bubble.js';
import registerForm from './components/registerForm'; // Importa tu componente
import adminCreateUserForm from './components/adminCreateUserForm'; // Ajusta la ruta si es necesario

attachBubbleCTA();          // autoinicializa todos los .bubble-cta

// Registra los plugins con Alpine ANTES de iniciar
Alpine.data('registerForm', registerForm);
Alpine.data('adminCreateUserForm', adminCreateUserForm);
Alpine.data('bubbleCTA', attachBubbleCTA); // Registra el componente de burbuja
Alpine.plugin(intersect);
Alpine.plugin(collapse);

// Haz Alpine global si lo necesitas (Breeze suele hacerlo)
window.Alpine = Alpine;

// Inicia Alpine
Alpine.start();

// Otro JS que Breeze haya añadido o que tú necesites...