
<section class="relative py-16 bg-ipn-gray-light"> {{-- Fondo claro --}}
    <div class="relative z-10 container mx-auto px-4 sm:px-6 lg:px-8">

        {{-- Título ajustado para fondo claro y consistencia --}}
        <h2 class="text-4xl lg:text-6xl font-teko font-bold text-left text-ipn-guinda mb-4">
            Eventos y Noticias
        </h2>
        <p class="text-left text-lg text-ipn-gray-dark max-w-3xl mb-12 lg:mb-16">
            Mantente al día con nuestras actividades, talleres y noticias más relevantes. ¡No te lo pierdas!
        </p>

        {{-- Grid original (3 columnas en lg) --}}
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 lg:gap-8">

            {{-- Tarjeta 1 (Estilo con overlay se mantiene) --}}
            <div class="group relative rounded-xl overflow-hidden shadow-lg hover:shadow-2xl transition-shadow duration-300 ease-in-out min-h-[380px] flex flex-col">
                {{-- Imagen como Fondo --}}
                <img src="https://placehold.co/600x400/A98895/333333?text=Evento+1"
                     alt="Evento 1"
                     class="absolute inset-0 w-full h-full object-cover transition-transform duration-300 ease-in-out group-hover:scale-105"
                     onerror="this.onerror=null; this.src='https://placehold.co/600x400/cccccc/333333?text=Error';" loading="lazy">
                {{-- Overlay con Gradiente y Contenido (Texto blanco funciona bien aquí) --}}
                <div class="relative mt-auto p-5 z-10 bg-gradient-to-t from-black/85 via-black/60 to-transparent text-white">
                    <span class="block text-sm text-ipn-gray-lighten opacity-90 mb-1">25 de Abr 2025 · 10:00 h</span>
                    <h3 class="text-xl font-roboto font-semibold mt-1 mb-3 text-white">
                        Webinar: Gestores Bibliográficos
                    </h3>
                    <p class="text-sm font-sans text-ipn-gray-lighten mb-4 line-clamp-3">
                        Descubre cómo Zotero y Mendeley pueden organizar tu investigación y facilitar la creación de citas y bibliografías académicas.
                    </p>
                    <a href="#" class="inline-block font-semibold text-sm text-white hover:text-ipn-gray-lighten transition-colors duration-200 group-hover:translate-x-1 transform ease-in-out duration-200">
                        Más información &rarr;
                    </a>
                </div>
            </div>

            {{-- Tarjeta 2 (Estilo con overlay se mantiene) --}}
            <div class="group relative rounded-xl overflow-hidden shadow-lg hover:shadow-2xl transition-shadow duration-300 ease-in-out min-h-[380px] flex flex-col">
                <img src="https://placehold.co/600x400/8C6F7D/FFFFFF?text=Noticia+1"
                     alt="Noticia Destacada"
                     class="absolute inset-0 w-full h-full object-cover transition-transform duration-300 ease-in-out group-hover:scale-105"
                     onerror="this.onerror=null; this.src='https://placehold.co/600x400/cccccc/333333?text=Error';" loading="lazy">
                <div class="relative mt-auto p-5 z-10 bg-gradient-to-t from-black/85 via-black/60 to-transparent text-white">
                    <span class="block text-sm text-ipn-gray-lighten opacity-90 mb-1">Noticias SIBIPN · 18 Abr 2025</span>
                    <h3 class="text-xl font-roboto font-semibold mt-1 mb-3 text-white">
                        Nuevas Bases de Datos Disponibles
                    </h3>
                    <p class="text-sm font-sans text-ipn-gray-lighten mb-4 line-clamp-3">
                        Explora las últimas incorporaciones a nuestra Biblioteca Digital, incluyendo acceso a Scopus y Web of Science para toda la comunidad politécnica.
                    </p>
                    <a href="#" class="inline-block font-semibold text-sm text-white hover:text-ipn-gray-lighten transition-colors duration-200 group-hover:translate-x-1 transform ease-in-out duration-200">
                        Leer más &rarr;
                    </a>
                </div>
            </div>

            {{-- Tarjeta 3 (Estilo con overlay se mantiene) --}}
            <div class="group relative rounded-xl overflow-hidden shadow-lg hover:shadow-2xl transition-shadow duration-300 ease-in-out min-h-[380px] flex flex-col">
                <img src="https://placehold.co/600x400/6F5663/FFFFFF?text=Evento+2"
                     alt="Taller Presencial"
                     class="absolute inset-0 w-full h-full object-cover transition-transform duration-300 ease-in-out group-hover:scale-105"
                     onerror="this.onerror=null; this.src='https://placehold.co/600x400/cccccc/333333?text=Error';" loading="lazy">
                <div class="relative mt-auto p-5 z-10 bg-gradient-to-t from-black/85 via-black/60 to-transparent text-white">
                    <span class="block text-sm text-ipn-gray-lighten opacity-90 mb-1">10 May 2025 · Biblioteca Central</span>
                    <h3 class="text-xl font-roboto font-semibold mt-1 mb-3 text-white">
                        Taller: Búsqueda Efectiva de Información
                    </h3>
                    <p class="text-sm font-sans text-ipn-gray-lighten mb-4 line-clamp-3">
                        Mejora tus habilidades de investigación aprendiendo estrategias avanzadas para encontrar información relevante en nuestras bases de datos y catálogo.
                    </p>
                    <a href="#" class="inline-block font-semibold text-sm text-white hover:text-ipn-gray-lighten transition-colors duration-200 group-hover:translate-x-1 transform ease-in-out duration-200">
                        Inscribirse &rarr;
                    </a>
                </div>
            </div>

        </div> {{-- Fin del grid --}}

        {{-- CTA “Ver todo” (se mantiene igual, el botón primario funciona bien en fondo claro) --}}
        <div class="text-center mt-12 lg:mt-16">
            <x-button.secondary href="/noticias" class="px-10">
                Ver todo
            </x-button.secondary>
        </div>

    </div>
</section>