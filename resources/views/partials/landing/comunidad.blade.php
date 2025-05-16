{{-- resources/views/partials/landing/comunidad.blade.php --}}
<section id="comunidad-section"
         class="relative separator-sup-der py-16 lg:py-24 bg-ipn-guinda text-white overflow-hidden">
  <div class="container relative z-10 mx-auto px-4 sm:px-6 lg:px-8">

    {{-- ========= BLOQUE 1  texto izq · img der ======================= --}}
    <div id="comunidad-bloque-1"
         class="grid grid-cols-1 md:grid-cols-2 gap-12 lg:gap-16 items-center">

      {{-- Texto ------------------------------------------------------- --}}
      <div id="comunidad-bloque1-texto" class="text-left order-1">
        <h2 id="comunidad-titulo1"
            class="text-4xl lg:text-5xl font-teko font-bold mb-6 leading-tight">
          <span>Más</span> <span>que</span> <span>una</span> <span>Biblioteca:</span>
          <span>Una</span> <span>Comunidad</span> <span>Politécnica</span>
        </h2>

        <p id="comunidad-parrafo1"
           class="text-lg sm:text-xl mb-8 text-ipn-gray-lighten max-w-xl">
          SIBIPN es tu espacio para conectar, compartir y crecer…
        </p>

        <ul id="comunidad-features1" class="space-y-4 mb-10">

          {{-- 1 · Foros temáticos --}}
          <li class="feature-item flex items-center gap-3">
            <div class="feature-icon w-6 h-6 text-ipn-gray-lighten opacity-90">
              <svg class="w-6 h-6" aria-hidden="true">
                <use xlink:href="#icon-chat"></use>
              </svg>
            </div>
            <span class="feature-text text-lg text-ipn-gray-lighten">
              Foros temáticos y ayuda mutua.
            </span>
          </li>

          {{-- 2 · Intercambio de recursos --}}
          <li class="feature-item flex items-center gap-3">
            <div class="feature-icon w-6 h-6 text-ipn-gray-lighten opacity-90">
              <svg class="w-6 h-6" aria-hidden="true">
                <use xlink:href="#icon-share"></use>
              </svg>
            </div>
            <span class="feature-text text-lg text-ipn-gray-lighten">
              Intercambio de apuntes y recursos.
            </span>
          </li>

          {{-- 3 · Grupos de estudio --}}
          <li class="feature-item flex items-center gap-3">
            <div class="feature-icon w-6 h-6 text-ipn-gray-lighten opacity-90">
              <svg class="w-6 h-6" aria-hidden="true">
                <use xlink:href="#icon-users"></use>
              </svg>
            </div>
            <span class="feature-text text-lg text-ipn-gray-lighten">
              Grupos de estudio y colaboración.
            </span>
          </li>
        </ul>
      </div>

      {{-- Imagen ------------------------------------------------------ --}}
      <div id="comunidad-bloque1-imagen"
           class="flex justify-center md:justify-end order-2">
        <img src="{{ asset('images/comunidad.jpeg') }}"
             alt="Comunidad politécnica conectada"
             class="comunidad-imagen rounded-xl shadow-2xl object-cover
                    w-full max-w-md lg:max-w-lg aspect-[6/5] will-change-transform"
             loading="lazy">
      </div>
    </div>

    {{-- ========== SEPARADOR con flare ================================ --}}
    <div id="comunidad-separador"
         class="my-16 lg:my-24 h-px bg-ipn-guinda-light/30 relative overflow-hidden">
      <span class="com-sep-flare absolute left-0 top-0 h-full w-6
                   bg-white/80 opacity-0"></span>
    </div>

    {{-- ========= BLOQUE 2  img izq · texto der ====================== --}}
    <div id="comunidad-bloque-2"
         class="grid grid-cols-1 md:grid-cols-2 gap-12 lg:gap-16 items-center">

      {{-- Imagen ------------------------------------------------------ --}}
      <div id="comunidad-bloque2-imagen"
           class="flex justify-center md:justify-start order-1">
        <img src="{{ asset('images/colaboracion.jpg') }}"
             alt="Colaboración estudiantil"
             class="comunidad-imagen rounded-xl shadow-2xl object-cover
                    w-full max-w-md lg:max-w-lg aspect-[6/5] will-change-transform"
             loading="lazy">
      </div>

      {{-- Texto ------------------------------------------------------- --}}
      <div id="comunidad-bloque2-texto" class="text-left order-2">
        <h3 id="comunidad-titulo2"
            class="text-3xl lg:text-4xl font-teko font-bold mb-6 leading-tight">
          <span>Construye</span> <span>Conocimiento</span>
          <span>en</span> <span>Conjunto</span>
        </h3>

        <p id="comunidad-parrafo2"
           class="text-lg sm:text-xl mb-8 text-ipn-gray-lighten max-w-xl">
          Encuentra compañeros con intereses similares…
        </p>

        <ul id="comunidad-features2" class="space-y-4 mb-10">

          {{-- 1 · Ideas innovadoras --}}
          <li class="feature-item flex items-center gap-3">
            <div class="feature-icon w-6 h-6 text-ipn-gray-lighten opacity-90">
              <svg class="w-6 h-6" aria-hidden="true">
                <use xlink:href="#icon-lighbulb"></use>
              </svg>
            </div>
            <span class="feature-text text-lg text-ipn-gray-lighten">
              Genera ideas innovadoras.
            </span>
          </li>

          {{-- 2 · Presentación de avances --}}
          <li class="feature-item flex items-center gap-3">
            <div class="feature-icon w-6 h-6 text-ipn-gray-lighten opacity-90">
              <svg class="w-6 h-6" aria-hidden="true">
                <use xlink:href="#icon-assesment"></use>
              </svg>
            </div>
            <span class="feature-text text-lg text-ipn-gray-lighten">
              Presenta y discute avances.
            </span>
          </li>

          {{-- 3 · Tutoría de compañeros --}}
          <li class="feature-item flex items-center gap-3">
            <div class="feature-icon w-6 h-6 text-ipn-gray-lighten opacity-90">
              <svg class="w-6 h-6" aria-hidden="true">
                <use xlink:href="#icon-graduation-cap"></use>
              </svg>
            </div>
            <span class="feature-text text-lg text-ipn-gray-lighten">
              Recibe tutoría de compañeros.
            </span>
          </li>
        </ul>
      </div>
    </div>
  </div>
</section>
