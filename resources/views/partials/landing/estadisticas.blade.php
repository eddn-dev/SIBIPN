{{-- resources/views/components/sections/stats.blade.php --}}
<section id="stats-section"
         class="relative h-[100vh] overflow-hidden bg-ipn-gray-light">

  {{-- Título + indicador --}}
  <header class="absolute top-8 inset-x-0 flex flex-col items-center z-20">
    <h2 class="text-5xl lg:text-7xl font-teko font-bold text-ipn-guinda mb-2
               opacity-0" id="stats-title">
      SIBIPN en Números
    </h2>

    {{-- Indicador de progreso (4 puntos) --}}
    <ul id="stats-dots" class="flex gap-3">
      @for ($i = 0; $i < 4; $i++)
        <li class="w-2.5 h-2.5 rounded-full bg-ipn-guinda/30"></li>
      @endfor
    </ul>
  </header>

  {{-- Pista horizontal ---------------------------------------------------- --}}
  <div class="stats-track flex w-[400vw] h-full">

    {{-- === 1 · Recursos === --}}
    <article class="stat-slide w-screen h-full flex flex-col justify-center
                    items-center px-6 sm:px-10 space-y-3 md:space-y-4 relative
                    overflow-hidden">
      <div class="stat-slide-content-wrapper text-center">
        <div class="stat-icon-wrapper w-14 h-14 md:w-16 md:h-16 text-ipn-guinda mb-2 mx-auto">
            <svg class="w-full h-full"><use href="#icon-doc" /></svg>
        </div>

        <span class="stat-count block text-6xl md:text-7xl lg:text-8xl
                     font-teko font-bold text-ipn-guinda"
              data-target="1000000" data-suffix=" M+">0</span>
        <p class="stat-title text-xl md:text-2xl font-roboto font-medium text-ipn-gray-dark">
          Recursos Disponibles
        </p>

        <div class="stat-context-info opacity-0 max-w-md mx-auto mt-4">
          <p class="stat-context-text text-base text-ipn-gray-dark/80 leading-relaxed">
            Acceso a una vasta colección que impulsa la investigación y el aprendizaje
            en todas las áreas del conocimiento politécnico.
          </p>
          <a href="/buscar"
             class="stat-micro-cta inline-block mt-3 text-sm text-ipn-guinda
                    hover:text-ipn-guinda-light font-semibold transition-colors
                    duration-200 group">
            Explorar Catálogo
            <span class="inline-block transition-transform duration-200
                         ease-in-out group-hover:translate-x-1">&rarr;</span>
          </a>
        </div>
      </div>
    </article>

    {{-- === 2 · Usuarios === --}}
    <article class="stat-slide w-screen h-full flex flex-col justify-center
                    items-center px-6 sm:px-10 space-y-3 md:space-y-4 relative">
      <div class="stat-slide-content-wrapper text-center">
        <div class="stat-icon-wrapper w-14 h-14 md:w-16 md:h-16 text-ipn-guinda mb-2 mx-auto">
          <svg class="w-full h-full"><use href="#icon-user" /></svg>
        </div>
        <span class="stat-count block text-6xl md:text-7xl lg:text-8xl font-teko
                     font-bold text-ipn-guinda"
              data-target="50000" data-suffix=" K+">0</span>
        <p class="stat-title text-xl md:text-2xl font-roboto font-medium text-ipn-gray-dark">
          Usuarios Activos
        </p>

        <div class="stat-context-info opacity-0 max-w-md mx-auto mt-4">
          <p class="stat-context-text text-base text-ipn-gray-dark/80 leading-relaxed">
            Cada día miles de politécnicos consultan, colaboran y comparten conocimiento
            en la plataforma.
          </p>
          <a href="/comunidad" class="stat-micro-cta inline-block mt-3 text-sm text-ipn-guinda
                    hover:text-ipn-guinda-light font-semibold transition-colors duration-200 group">
            Conoce la comunidad <span class="inline-block transition-transform
                    duration-200 ease-in-out group-hover:translate-x-1">&rarr;</span>
          </a>
        </div>
      </div>
    </article>

    {{-- === 3 · Bibliotecas === --}}
    <article class="stat-slide w-screen h-full flex flex-col justify-center
                    items-center px-6 sm:px-10 space-y-3 md:space-y-4 relative">
      <div class="stat-slide-content-wrapper text-center">
        <div class="stat-icon-wrapper w-14 h-14 md:w-16 md:h-16 text-ipn-guinda mb-2 mx-auto">
          <svg class="w-full h-full"><use href="#icon-home" /></svg>
        </div>
        <span class="stat-count block text-6xl md:text-7xl lg:text-8xl font-teko
                     font-bold text-ipn-guinda"
              data-target="20" data-suffix="+">0</span>
        <p class="stat-title text-xl md:text-2xl font-roboto font-medium text-ipn-gray-dark">
          Bibliotecas Conectadas
        </p>

        <div class="stat-context-info opacity-0 max-w-md mx-auto mt-4">
          <p class="stat-context-text text-base text-ipn-gray-dark/80 leading-relaxed">
            Una red que integra catálogos físicos y digitales para acercar la información
            a toda la comunidad IPN.
          </p>
          <a href="/bibliotecas" class="stat-micro-cta inline-block mt-3 text-sm text-ipn-guinda
                    hover:text-ipn-guinda-light font-semibold transition-colors duration-200 group">
            Ver mapa <span class="inline-block transition-transform
                    duration-200 ease-in-out group-hover:translate-x-1">&rarr;</span>
          </a>
        </div>
      </div>
    </article>

    {{-- === 4 · Foros === --}}
    <article class="stat-slide w-screen h-full flex flex-col justify-center
                    items-center px-6 sm:px-10 space-y-3 md:space-y-4 relative">
      <div class="stat-slide-content-wrapper text-center">
        <div class="stat-icon-wrapper w-14 h-14 md:w-16 md:h-16 text-ipn-guinda mb-2 mx-auto">
          <svg class="w-full h-full"><use href="#icon-chat" /></svg>
        </div>
        <span class="stat-count block text-6xl md:text-7xl lg:text-8xl font-teko
                     font-bold text-ipn-guinda"
              data-target="100" data-suffix="+">0</span>
        <p class="stat-title text-xl md:text-2xl font-roboto font-medium text-ipn-gray-dark">
          Foros y Grupos
        </p>

        <div class="stat-context-info opacity-0 max-w-md mx-auto mt-4">
          <p class="stat-context-text text-base text-ipn-gray-dark/80 leading-relaxed">
            Espacios de discusión para compartir hallazgos, resolver dudas y crear redes
            de colaboración.
          </p>
          <a href="/comunidad#foros" class="stat-micro-cta inline-block mt-3 text-sm text-ipn-guinda
                    hover:text-ipn-guinda-light font-semibold transition-colors duration-200 group">
            Explorar foros <span class="inline-block transition-transform
                    duration-200 ease-in-out group-hover:translate-x-1">&rarr;</span>
          </a>
        </div>
      </div>
    </article>

  </div>
</section>
