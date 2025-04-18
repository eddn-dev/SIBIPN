{{-- resources/views/welcome.blade.php --}}
{{-- Extiende el layout principal que contiene header y footer --}}
@extends('layouts.app') {{-- Asegúrate que el nombre del layout sea correcto --}}

{{-- Define el título específico para esta página --}}
@section('title', 'Bienvenido a SIBIPN - Sistema Integral de Bibliotecas IPN')

{{-- Inicia la sección de contenido principal --}}
@section('content')

    {{-- 1. Sección Principal (Hero) - Mantiene texto blanco sobre overlay oscuro --}}
    <section class="relative bg-ipn-guinda text-white h-[70vh] min-h-[500px] flex items-center justify-center overflow-hidden">
        <div class="absolute inset-0 bg-cover bg-center z-0" style="background-image: url('images/hero.jpg');"></div>
        <div class="absolute inset-0 bg-ipn-guinda opacity-75 z-10"></div>
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 text-center relative z-20"
             x-data="{ loaded: false }" x-init="() => { setTimeout(() => loaded = true, 100) }">
            <h1 class="text-4xl sm:text-5xl md:text-6xl font-teko font-bold mb-4 text-white transition-all duration-700 ease-out" {{-- Asegurado: text-white --}}
                :class="loaded ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-4'">
                Sistema Integral de Bibliotecas IPN
            </h1>
            <p class="text-lg sm:text-xl md:text-2xl font-sans mb-8 max-w-3xl mx-auto text-white transition-all duration-700 ease-out delay-150" {{-- Asegurado: text-white --}}
               :class="loaded ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-4'">
                Tu acceso unificado al conocimiento politécnico. Busca, descubre y aprende con todos los recursos a tu alcance.
            </p>
            <div class="space-x-4 transition-all duration-700 ease-out delay-300"
                 :class="loaded ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-4'">
                <a href="/login" class="bg-white text-ipn-guinda hover:bg-ipn-gray-light px-6 py-3 rounded-md text-lg font-medium transition duration-300 ease-in-out transform hover:scale-105 shadow-lg">
                    Iniciar Sesión
                </a>
                <a href="/buscar" class="bg-transparent border-2 border-white text-white hover:bg-white hover:text-ipn-guinda px-6 py-3 rounded-md text-lg font-medium transition duration-300 ease-in-out transform hover:scale-105 shadow-lg">
                    Ir a SIBIPN
                </a>
            </div>
        </div>
    </section>

    {{-- 2. Sección Características Clave - Fondo Blanco, Texto Oscuro --}}
    <section class="py-16 lg:py-24 bg-white">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-3xl lg:text-4xl font-teko font-bold text-center text-ipn-guinda mb-12">¿Qué puedes hacer en SIBIPN?</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8 lg:gap-12">
                {{-- Card 1 --}}
                <div x-data="{ shown: false }" x-intersect:enter.full.once="shown = true"
                     class="bg-white p-6 rounded-lg shadow-lg border border-gray-200 text-center transition-all duration-700 ease-out" {{-- Borde más sutil --}}
                     :class="shown ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-5'">
                    <svg class="h-12 w-12 mx-auto mb-4 text-ipn-guinda" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    <h3 class="text-xl font-roboto font-semibold mb-2 text-ipn-gray-dark">Búsqueda Unificada</h3> {{-- Asegurado: text-ipn-gray-dark --}}
                    <p class="text-ipn-gray font-sans">Encuentra libros físicos, tesis, artículos y recursos digitales de todas las bibliotecas IPN en un solo lugar.</p> {{-- Asegurado: text-ipn-gray --}}
                </div>
                {{-- Card 2 --}}
                 <div x-data="{ shown: false }" x-intersect:enter.full.once="shown = true"
                     class="bg-white p-6 rounded-lg shadow-lg border border-gray-200 text-center transition-all duration-700 ease-out delay-100"
                     :class="shown ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-5'">
                    <svg class="h-12 w-12 mx-auto mb-4 text-ipn-guinda" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path></svg>
                    <h3 class="text-xl font-roboto font-semibold mb-2 text-ipn-gray-dark">Acceso Digital Fácil</h3> {{-- Asegurado: text-ipn-gray-dark --}}
                    <p class="text-ipn-gray font-sans">Ingresa a bases de datos, revistas electrónicas y libros digitales con tus credenciales IPN (SSO).</p> {{-- Asegurado: text-ipn-gray --}}
                </div>
                {{-- Card 3 --}}
                 <div x-data="{ shown: false }" x-intersect:enter.full.once="shown = true"
                     class="bg-white p-6 rounded-lg shadow-lg border border-gray-200 text-center transition-all duration-700 ease-out delay-200"
                     :class="shown ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-5'">
                    <svg class="h-12 w-12 mx-auto mb-4 text-ipn-guinda" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    <h3 class="text-xl font-roboto font-semibold mb-2 text-ipn-gray-dark">Disponibilidad Real</h3> {{-- Asegurado: text-ipn-gray-dark --}}
                    <p class="text-ipn-gray font-sans">Verifica en tiempo real si un libro está disponible, prestado o en qué biblioteca se encuentra.</p> {{-- Asegurado: text-ipn-gray --}}
                </div>
                 {{-- Card 4 --}}
                 <div x-data="{ shown: false }" x-intersect:enter.full.once="shown = true"
                     class="bg-white p-6 rounded-lg shadow-lg border border-gray-200 text-center transition-all duration-700 ease-out delay-300"
                     :class="shown ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-5'">
                    <svg class="h-12 w-12 mx-auto mb-4 text-ipn-guinda" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="M12 14l9-5-9-5-9 5 9 5z"></path><path d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14zm-4 6v-7.5l4-2.222"></path></svg>
                    <h3 class="text-xl font-roboto font-semibold mb-2 text-ipn-gray-dark">Recursos de Aprendizaje</h3> {{-- Asegurado: text-ipn-gray-dark --}}
                    <p class="text-ipn-gray font-sans">Accede a tutoriales, guías y talleres para mejorar tus habilidades de investigación e información.</p> {{-- Asegurado: text-ipn-gray --}}
                </div>
                 {{-- Card 5 --}}
                 <div x-data="{ shown: false }" x-intersect:enter.full.once="shown = true"
                     class="bg-white p-6 rounded-lg shadow-lg border border-gray-200 text-center transition-all duration-700 ease-out delay-400"
                     :class="shown ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-5'">
                    <svg class="h-12 w-12 mx-auto mb-4 text-ipn-guinda" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                    <h3 class="text-xl font-roboto font-semibold mb-2 text-ipn-gray-dark">Comunidad y Foros</h3> {{-- Asegurado: text-ipn-gray-dark --}}
                    <p class="text-ipn-gray font-sans">Conéctate con otros politécnicos, discute temas académicos y forma grupos de estudio.</p> {{-- Asegurado: text-ipn-gray --}}
                </div>
                 {{-- Card 6 --}}
                 <div x-data="{ shown: false }" x-intersect:enter.full.once="shown = true"
                     class="bg-white p-6 rounded-lg shadow-lg border border-gray-200 text-center transition-all duration-700 ease-out delay-500"
                     :class="shown ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-5'">
                    <svg class="h-12 w-12 mx-auto mb-4 text-ipn-guinda" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                    <h3 class="text-xl font-roboto font-semibold mb-2 text-ipn-gray-dark">Tu Espacio Personal</h3> {{-- Asegurado: text-ipn-gray-dark --}}
                    <p class="text-ipn-gray font-sans">Gestiona tus préstamos, renovaciones, reservas, historial y listas de favoritos desde "Mi SIBIPN".</p> {{-- Asegurado: text-ipn-gray --}}
                </div>
            </div>
        </div>
    </section>

    {{-- 3. Sección Estadísticas (SIBIPN en Números) - Fondo Blanco, Texto Oscuro --}}
    <section class="py-16 lg:py-24 bg-white">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-3xl lg:text-4xl font-teko font-bold text-center text-ipn-guinda mb-12">SIBIPN en Números</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8 text-center">
                <div x-data="{ shown: false }" x-intersect:enter.half.once="shown = true"
                     class="transition-all duration-500 ease-out" :class="shown ? 'opacity-100 scale-100' : 'opacity-0 scale-90'">
                    <span class="block text-4xl lg:text-5xl font-teko font-bold text-ipn-guinda">1M+</span>
                    <span class="block mt-2 text-lg text-ipn-gray-dark">Recursos Disponibles</span> {{-- Asegurado: text-ipn-gray-dark --}}
                </div>
                 <div x-data="{ shown: false }" x-intersect:enter.half.once="shown = true"
                     class="transition-all duration-500 ease-out delay-100" :class="shown ? 'opacity-100 scale-100' : 'opacity-0 scale-90'">
                    <span class="block text-4xl lg:text-5xl font-teko font-bold text-ipn-guinda">50K+</span>
                    <span class="block mt-2 text-lg text-ipn-gray-dark">Usuarios Activos</span> {{-- Asegurado: text-ipn-gray-dark --}}
                </div>
                 <div x-data="{ shown: false }" x-intersect:enter.half.once="shown = true"
                     class="transition-all duration-500 ease-out delay-200" :class="shown ? 'opacity-100 scale-100' : 'opacity-0 scale-90'">
                    <span class="block text-4xl lg:text-5xl font-teko font-bold text-ipn-guinda">20+</span>
                    <span class="block mt-2 text-lg text-ipn-gray-dark">Bibliotecas Conectadas</span> {{-- Asegurado: text-ipn-gray-dark --}}
                </div>
                 <div x-data="{ shown: false }" x-intersect:enter.half.once="shown = true"
                     class="transition-all duration-500 ease-out delay-300" :class="shown ? 'opacity-100 scale-100' : 'opacity-0 scale-90'">
                    <span class="block text-4xl lg:text-5xl font-teko font-bold text-ipn-guinda">100+</span>
                    <span class="block mt-2 text-lg text-ipn-gray-dark">Foros y Grupos</span> {{-- Asegurado: text-ipn-gray-dark --}}
                </div>
            </div>
        </div>
    </section>

    {{-- 4. Sección Parallax 1 - Mantenida para contraste visual --}}
    <section class="relative bg-ipn-guinda-desat py-24 lg:py-32 bg-fixed bg-cover bg-center"
             style="background-image: url('images/parallax.jpg');">
         <div class="absolute inset-0 bg-ipn-guinda opacity-70"></div>
         <div class="container mx-auto px-4 sm:px-6 lg:px-8 text-center relative z-10">
             <h3 class="text-3xl lg:text-4xl font-roboto font-semibold text-white max-w-3xl mx-auto">Impulsando la investigación y el descubrimiento en el Instituto Politécnico Nacional.</h3> {{-- Mantenido: text-white --}}
         </div>
    </section>

    {{-- 5. Sección Noticias y Eventos - Fondo Blanco, Texto Oscuro --}}
    <section class="py-16 lg:py-24 bg-white">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-3xl lg:text-4xl font-teko font-bold text-center text-ipn-guinda mb-12">Noticias y Eventos</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                {{-- Card 1 --}}
                <div x-data="{ shown: false }" x-intersect:enter.full.once="shown = true"
                     class="bg-white rounded-lg shadow-lg border border-gray-200 overflow-hidden transition-all duration-700 ease-out hover:shadow-xl"
                     :class="shown ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-5'">
                    <img src="https://placehold.co/600x400/CCCCCC/333333?text=Imagen+Noticia" alt="[Imagen de Noticia o Evento]" class="w-full h-48 object-cover">
                    <div class="p-6">
                        <span class="text-sm text-ipn-gray">17 de Abril, 2025</span> {{-- Asegurado: text-ipn-gray --}}
                        <h3 class="text-xl font-roboto font-semibold mt-2 mb-3 text-ipn-gray-dark">Nuevo Taller: Búsqueda Efectiva en Bases de Datos</h3> {{-- Asegurado: text-ipn-gray-dark --}}
                        <p class="text-ipn-gray font-sans text-sm mb-4">Aprende estrategias avanzadas para encontrar la información que necesitas para tus investigaciones...</p> {{-- Asegurado: text-ipn-gray --}}
                        <a href="#" class="text-ipn-guinda hover:underline font-medium">Leer más &rarr;</a> {{-- Asegurado: text-ipn-guinda --}}
                    </div>
                </div>
                 {{-- Card 2 --}}
                 <div x-data="{ shown: false }" x-intersect:enter.full.once="shown = true"
                     class="bg-white rounded-lg shadow-lg border border-gray-200 overflow-hidden transition-all duration-700 ease-out delay-100 hover:shadow-xl"
                     :class="shown ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-5'">
                    <img src="https://placehold.co/600x400/CCCCCC/333333?text=Imagen+Noticia+2" alt="[Imagen de Noticia o Evento 2]" class="w-full h-48 object-cover">
                    <div class="p-6">
                        <span class="text-sm text-ipn-gray">15 de Abril, 2025</span> {{-- Asegurado: text-ipn-gray --}}
                        <h3 class="text-xl font-roboto font-semibold mt-2 mb-3 text-ipn-gray-dark">Presentación de Nuevos Recursos Digitales</h3> {{-- Asegurado: text-ipn-gray-dark --}}
                        <p class="text-ipn-gray font-sans text-sm mb-4">Descubre las últimas suscripciones y herramientas digitales disponibles para la comunidad politécnica...</p> {{-- Asegurado: text-ipn-gray --}}
                        <a href="#" class="text-ipn-guinda hover:underline font-medium">Leer más &rarr;</a> {{-- Asegurado: text-ipn-guinda --}}
                    </div>
                </div>
                 {{-- Card 3 --}}
                 <div x-data="{ shown: false }" x-intersect:enter.full.once="shown = true"
                     class="bg-white rounded-lg shadow-lg border border-gray-200 overflow-hidden transition-all duration-700 ease-out delay-200 hover:shadow-xl"
                     :class="shown ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-5'">
                    <img src="https://placehold.co/600x400/CCCCCC/333333?text=Imagen+Noticia+3" alt="[Imagen de Noticia o Evento 3]" class="w-full h-48 object-cover">
                    <div class="p-6">
                        <span class="text-sm text-ipn-gray">10 de Abril, 2025</span> {{-- Asegurado: text-ipn-gray --}}
                        <h3 class="text-xl font-roboto font-semibold mt-2 mb-3 text-ipn-gray-dark">Conferencia: El Futuro de las Bibliotecas Académicas</h3> {{-- Asegurado: text-ipn-gray-dark --}}
                        <p class="text-ipn-gray font-sans text-sm mb-4">Participa en la discusión sobre los retos y oportunidades que enfrentan las bibliotecas hoy...</p> {{-- Asegurado: text-ipn-gray --}}
                        <a href="#" class="text-ipn-guinda hover:underline font-medium">Leer más &rarr;</a> {{-- Asegurado: text-ipn-guinda --}}
                    </div>
                </div>
            </div>
            <div class="text-center mt-12">
                 <a href="/noticias" class="bg-ipn-guinda text-white hover:bg-ipn-guinda-desat px-6 py-3 rounded-md text-lg font-medium transition duration-300 ease-in-out shadow-md transform hover:scale-105">
                    Ver todas las Noticias
                </a>
            </div>
        </div>
    </section>

    {{-- 6. Sección Preguntas Frecuentes (FAQ) - Fondo Gris Claro, Texto Oscuro --}}
    <section class="py-16 lg:py-24 bg-ipn-gray-light">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-3xl lg:text-4xl font-teko font-bold text-center text-ipn-guinda mb-12">Preguntas Frecuentes</h2>
            <div class="max-w-3xl mx-auto space-y-4" x-data="{ openFaq: null }">
                {{-- FAQ Item 1 --}}
                <div class="border border-gray-300 rounded-lg overflow-hidden bg-white shadow-sm">
                    <button @click="openFaq = (openFaq === 1 ? null : 1)" class="w-full flex justify-between items-center p-4 text-left text-ipn-gray-dark hover:bg-gray-50 focus:outline-none">
                        <span class="text-lg font-roboto font-medium">¿Cómo accedo a los recursos digitales?</span> {{-- Asegurado: text-ipn-gray-dark --}}
                        <svg class="h-6 w-6 transform transition-transform duration-300 text-ipn-guinda" :class="{ 'rotate-180': openFaq === 1 }" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                    </button>
                    <div x-show="openFaq === 1" x-collapse x-cloak class="p-4 border-t border-gray-200">
                        <p class="text-ipn-gray-dark font-sans">Puedes acceder a todas las bases de datos, revistas y libros electrónicos suscritos por el IPN utilizando tu correo institucional y contraseña a través del sistema de autenticación única (SSO). Simplemente haz clic en el enlace del recurso digital y serás redirigido para iniciar sesión si aún no lo has hecho.</p> {{-- Asegurado: text-ipn-gray-dark --}}
                    </div>
                </div>
                {{-- FAQ Item 2 --}}
                <div class="border border-gray-300 rounded-lg overflow-hidden bg-white shadow-sm">
                     <button @click="openFaq = (openFaq === 2 ? null : 2)" class="w-full flex justify-between items-center p-4 text-left text-ipn-gray-dark hover:bg-gray-50 focus:outline-none">
                        <span class="text-lg font-roboto font-medium">¿Cómo renuevo mis préstamos?</span> {{-- Asegurado: text-ipn-gray-dark --}}
                        <svg class="h-6 w-6 transform transition-transform duration-300 text-ipn-guinda" :class="{ 'rotate-180': openFaq === 2 }" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                    </button>
                    <div x-show="openFaq === 2" x-collapse x-cloak class="p-4 border-t border-gray-200">
                        <p class="text-ipn-gray-dark font-sans">Inicia sesión en SIBIPN, ve a la sección "Mi SIBIPN" > "Mis Préstamos". Allí verás la lista de tus materiales prestados y un botón para renovar aquellos que sean elegibles según las políticas de circulación (si no tienen reservas pendientes y no has excedido el límite de renovaciones).</p> {{-- Asegurado: text-ipn-gray-dark --}}
                    </div>
                </div>
                 {{-- FAQ Item 3 --}}
                 <div class="border border-gray-300 rounded-lg overflow-hidden bg-white shadow-sm">
                     <button @click="openFaq = (openFaq === 3 ? null : 3)" class="w-full flex justify-between items-center p-4 text-left text-ipn-gray-dark hover:bg-gray-50 focus:outline-none">
                        <span class="text-lg font-roboto font-medium">¿Qué hago si olvidé mi contraseña?</span> {{-- Asegurado: text-ipn-gray-dark --}}
                        <svg class="h-6 w-6 transform transition-transform duration-300 text-ipn-guinda" :class="{ 'rotate-180': openFaq === 3 }" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                    </button>
                    <div x-show="openFaq === 3" x-collapse x-cloak class="p-4 border-t border-gray-200">
                        <p class="text-ipn-gray-dark font-sans">SIBIPN utiliza el sistema de autenticación del IPN. Si olvidaste tu contraseña institucional, debes seguir los procedimientos establecidos por la Dirección de Cómputo y Comunicaciones (DCyC) del IPN para recuperarla o restablecerla a través de sus plataformas oficiales.</p> {{-- Asegurado: text-ipn-gray-dark --}}
                    </div>
                </div>
                 {{-- Añadir más preguntas frecuentes aquí --}}
            </div>
        </div>
    </section>

    {{-- 7. Sección Parallax 2 - Mantenida para contraste visual --}}
    <section class="relative bg-ipn-guinda py-24 lg:py-32 bg-fixed bg-cover bg-center"
             style="background-image: url('images/parallax2.jpg');">
         <div class="absolute inset-0 bg-ipn-guinda opacity-80"></div>
         <div class="container mx-auto px-4 sm:px-6 lg:px-8 text-center relative z-10">
             <h3 class="text-3xl lg:text-4xl font-roboto font-semibold text-white max-w-3xl mx-auto">Innovación y tecnología al servicio de tu aprendizaje y desarrollo profesional.</h3> {{-- Mantenido: text-white --}}
         </div>
    </section>

    {{-- 8. Llamada a la Acción Final (CTA) - Fondo Gris Claro, Texto Oscuro --}}
    <section class="py-16 lg:py-24 bg-ipn-gray-light">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-3xl lg:text-4xl font-teko font-bold text-ipn-guinda mb-6">¿Listo para explorar SIBIPN?</h2> {{-- Asegurado: text-ipn-guinda --}}
            <p class="text-lg sm:text-xl text-ipn-gray-dark mb-8 max-w-2xl mx-auto">Accede ahora con tu cuenta politécnica o empieza a descubrir los recursos disponibles.</p> {{-- Asegurado: text-ipn-gray-dark --}}
            <div class="space-x-4">
                 <a href="/login" class="bg-ipn-guinda text-white hover:bg-ipn-guinda-desat px-8 py-3 rounded-md text-lg font-medium transition duration-300 ease-in-out transform hover:scale-105 shadow-lg">
                    Iniciar Sesión
                </a>
                <a href="/buscar" class="bg-white text-ipn-guinda border-2 border-ipn-guinda hover:bg-gray-50 px-8 py-3 rounded-md text-lg font-medium transition duration-300 ease-in-out transform hover:scale-105 shadow-lg">
                    Explorar Catálogo
                </a>
            </div>
        </div>
    </section>

@endsection
