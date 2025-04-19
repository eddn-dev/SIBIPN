<section class="relative py-16 lg:py-24 lg:pb-30 bg-ipn-guinda-dark text-white"> {{-- Mantiene clases originales --}}
    <div class="relative z-10 container mx-auto px-4 sm:px-6 lg:px-8">

        <h2 class="text-4xl lg:text-6xl font-teko font-bold text-center text-ipn-gray-light mb-4"> {{-- Aumentado mb para consistencia --}}
            Eventos y Noticias
        </h2>

        {{-- Grid original (3 columnas en lg) --}}
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 lg:gap-8">

            {{-- Tarjeta 1 (Nuevo formato) --}}
            <div class="group relative rounded-xl overflow-hidden shadow-lg hover:shadow-2xl transition-shadow duration-300 ease-in-out min-h-[380px] flex flex-col">
                {{-- Imagen como Fondo --}}
                <img src="https://placehold.co/600x400/A98895/333333?text=Evento+1" {{-- Placeholder con color similar a guinda claro --}}
                     alt="Evento 1"
                     class="absolute inset-0 w-full h-full object-cover transition-transform duration-300 ease-in-out group-hover:scale-105">
                {{-- Overlay con Gradiente y Contenido --}}
                <div class="relative mt-auto p-5 z-10 bg-gradient-to-t from-black/85 via-black/60 to-transparent text-white">
                     {{-- Fecha (color claro) --}}
                    <span class="block text-sm text-ipn-gray-light opacity-90 mb-1">25 de Abr 2025 · 10:00 h</span>
                     {{-- Título (color claro) --}}
                    <h3 class="text-xl font-roboto font-semibold mt-1 mb-3 text-white">
                        Webinar: Gestores Bibliográficos
                    </h3>
                     {{-- Descripción (color claro) --}}
                    <p class="text-sm font-sans text-ipn-gray-light mb-4 line-clamp-3"> {{-- line-clamp opcional --}}
                        Descubre cómo Zotero y Mendeley pueden organizar tu investigación y facilitar la creación de citas y bibliografías académicas.
                    </p>
                     {{-- Enlace (estilo unificado) --}}
                    <a href="#" class="inline-block font-semibold text-sm text-white hover:text-ipn-gray-lighten transition-colors duration-200 group-hover:translate-x-1 transform ease-in-out duration-200">
                        Más información &rarr;
                    </a>
                </div>
            </div>

            {{-- Tarjeta 2 (Nuevo formato) --}}
            <div class="group relative rounded-xl overflow-hidden shadow-lg hover:shadow-2xl transition-shadow duration-300 ease-in-out min-h-[380px] flex flex-col">
                 {{-- Imagen como Fondo --}}
                <img src="https://placehold.co/600x400/8C6F7D/FFFFFF?text=Noticia+1" {{-- Placeholder --}}
                     alt="Noticia Destacada"
                     class="absolute inset-0 w-full h-full object-cover transition-transform duration-300 ease-in-out group-hover:scale-105">
                 {{-- Overlay con Gradiente y Contenido --}}
                <div class="relative mt-auto p-5 z-10 bg-gradient-to-t from-black/85 via-black/60 to-transparent text-white">
                     {{-- Categoría/Fecha --}}
                    <span class="block text-sm text-ipn-gray-light opacity-90 mb-1">Noticias SIBIPN · 18 Abr 2025</span>
                     {{-- Título --}}
                    <h3 class="text-xl font-roboto font-semibold mt-1 mb-3 text-white">
                        Nuevas Bases de Datos Disponibles
                    </h3>
                     {{-- Descripción --}}
                    <p class="text-sm font-sans text-ipn-gray-light mb-4 line-clamp-3">
                        Explora las últimas incorporaciones a nuestra Biblioteca Digital, incluyendo acceso a Scopus y Web of Science para toda la comunidad politécnica.
                    </p>
                     {{-- Enlace --}}
                    <a href="#" class="inline-block font-semibold text-sm text-white hover:text-ipn-gray-lighten transition-colors duration-200 group-hover:translate-x-1 transform ease-in-out duration-200">
                        Leer más &rarr;
                    </a>
                </div>
            </div>

            {{-- Tarjeta 3 (Nuevo formato) --}}
            <div class="group relative rounded-xl overflow-hidden shadow-lg hover:shadow-2xl transition-shadow duration-300 ease-in-out min-h-[380px] flex flex-col">
                 {{-- Imagen como Fondo --}}
                <img src="https://placehold.co/600x400/6F5663/FFFFFF?text=Evento+2" {{-- Placeholder --}}
                     alt="Taller Presencial"
                     class="absolute inset-0 w-full h-full object-cover transition-transform duration-300 ease-in-out group-hover:scale-105">
                 {{-- Overlay con Gradiente y Contenido --}}
                <div class="relative mt-auto p-5 z-10 bg-gradient-to-t from-black/85 via-black/60 to-transparent text-white">
                     {{-- Fecha/Lugar --}}
                    <span class="block text-sm text-ipn-gray-light opacity-90 mb-1">10 May 2025 · Biblioteca Central</span>
                     {{-- Título --}}
                    <h3 class="text-xl font-roboto font-semibold mt-1 mb-3 text-white">
                        Taller: Búsqueda Efectiva de Información
                    </h3>
                     {{-- Descripción --}}
                    <p class="text-sm font-sans text-ipn-gray-light mb-4 line-clamp-3">
                        Mejora tus habilidades de investigación aprendiendo estrategias avanzadas para encontrar información relevante en nuestras bases de datos y catálogo.
                    </p>
                     {{-- Enlace --}}
                    <a href="#" class="inline-block font-semibold text-sm text-white hover:text-ipn-gray-lighten transition-colors duration-200 group-hover:translate-x-1 transform ease-in-out duration-200">
                        Inscribirse &rarr;
                    </a>
                </div>
            </div>

        </div> {{-- Fin del grid --}}

        {{-- CTA “Ver todo” (se mantiene igual) --}}
        <div class="text-center mt-12 lg:mt-16">
            <x-button.primary href="/noticias" class="px-10">
                Ver todo
            </x-button.primary>
        </div>

    </div>
</section>