{{-- resources/views/partials/landing/noticias.blade.php --}}
<section id="noticias-section" class="relative py-16 bg-ipn-gray-light">
  <div class="relative z-10 container mx-auto px-4 sm:px-6 lg:px-8">

      <h2 id="noticias-titulo"
          class="text-4xl lg:text-6xl font-teko font-bold text-left text-ipn-guinda mb-4">
        {{-- Cada palabra en un span para animación individual --}}
        <span>Eventos</span> <span>y</span> <span>Noticias</span>
      </h2>

      <p id="noticias-subtitulo"
         class="text-lg text-ipn-gray-dark max-w-3xl mb-12 lg:mb-16">
        Mantente al día con nuestras actividades, talleres y noticias más relevantes. ¡No te lo pierdas!
      </p>

      {{-- GRID de Noticias --}}
      <div id="noticias-grid"
           class="perspective-1000 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 lg:gap-8">

        {{-- INICIO DE TARJETA DE NOTICIA (Ejemplo, iterar con @foreach para datos reales) --}}
        {{-- Debes reemplazar este bloque con tu bucle @foreach y datos dinámicos --}}
        @php
            $noticiasItems = [
                [
                    'imagen' => 'https://placehold.co/600x400/A98895/333333?text=Evento+1',
                    'alt_imagen' => 'Webinar: Gestores Bibliográficos',
                    'fecha' => '25 Abr 2025 · 10:00 h',
                    'titulo' => 'Webinar: Gestores Bibliográficos',
                    'descripcion' => 'Descubre cómo Zotero y Mendeley pueden organizar tu investigación y facilitar la creación de citas y bibliografías académicas.',
                    'enlace_texto' => 'Más información',
                    'enlace_url' => '#'
                ],
                [
                    'imagen' => 'https://placehold.co/600x400/8C6F7D/FFFFFF?text=Noticia+1',
                    'alt_imagen' => 'Nuevas Bases de Datos Disponibles',
                    'fecha' => 'Noticias SIBIPN · 18 Abr 2025',
                    'titulo' => 'Nuevas Bases de Datos Disponibles',
                    'descripcion' => 'Explora las últimas incorporaciones a nuestra Biblioteca Digital, incluyendo acceso a Scopus y Web of Science para toda la comunidad politécnica.',
                    'enlace_texto' => 'Leer más',
                    'enlace_url' => '#'
                ],
                [
                    'imagen' => 'https://placehold.co/600x400/6F5663/FFFFFF?text=Evento+2',
                    'alt_imagen' => 'Taller: Búsqueda Efectiva de Información',
                    'fecha' => '10 May 2025 · Biblioteca Central',
                    'titulo' => 'Taller: Búsqueda Efectiva de Información',
                    'descripcion' => 'Mejora tus habilidades de investigación aprendiendo estrategias avanzadas para encontrar información relevante en nuestras bases de datos y catálogo.',
                    'enlace_texto' => 'Inscribirse',
                    'enlace_url' => '#'
                ]
            ];
        @endphp

        @foreach($noticiasItems as $item)
        <article class="news-card relative rounded-xl overflow-hidden shadow-lg
                       min-h-[380px] flex flex-col will-change-transform"
                 style="transform-style:preserve-3d;">
                 {{-- La propiedad 'group' de Tailwind se quita si GSAP maneja todo el hover --}}

          {{-- Imagen de fondo --}}
          <img  class="news-card-bg absolute inset-0 w-full h-full object-cover"
                src="{{ $item['imagen'] }}"
                alt="{{ $item['alt_imagen'] }}" loading="lazy"
                onerror="this.onerror=null;this.src='https://placehold.co/600x400/cccccc/333?text=Error+Imagen';" />

          {{-- Overlay gradiente para el contenido --}}
          <div class="news-card-overlay absolute inset-0 bg-gradient-to-t
                       from-black/85 via-black/60 to-transparent z-10"></div>

          {{-- Contenido textual de la tarjeta --}}
          <div class="news-card-content relative z-20 mt-auto p-5 text-white">
            <span class="news-card-date block text-sm text-ipn-gray-lighten opacity-90 mb-1">
              {{ $item['fecha'] }}
            </span>
            <h3 class="news-card-title text-xl font-roboto font-semibold mb-3">
              {{ $item['titulo'] }}
            </h3>
            <p class="news-card-description text-sm text-ipn-gray-lighten mb-4 line-clamp-3">
              {{ $item['descripcion'] }}
            </p>
            <a href="{{ $item['enlace_url'] }}"
               class="news-card-link inline-flex items-center gap-1 font-semibold text-sm text-white hover:text-ipn-gray-lighten">
              {{ $item['enlace_texto'] }} <span class="news-card-arrow inline-block">&rarr;</span>
              {{-- Se eliminaron las clases de transición de Tailwind de la flecha, GSAP las manejará --}}
            </a>
          </div>
        </article>
        @endforeach
        {{-- FIN DE TARJETA DE NOTICIA --}}

      </div>

      {{-- Botón "Ver todo" --}}
      <div id="noticias-cta-container" class="text-center mt-12 lg:mt-16">
        <x-button.primary id="noticias-ver-todo-btn"
                           href="/noticias">
          Ver todo
        </x-button.primary>
      </div>
  </div>
</section>
