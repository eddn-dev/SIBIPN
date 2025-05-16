{{-- resources/views/partials/landing/recursos.blade.php --}}
<section id="recursos-section" class="relative py-16 bg-white">
  <div class="container mx-auto px-4 sm:px-6 lg:px-8">
    <h2 class="text-4xl lg:text-6xl font-teko font-bold text-left text-ipn-guinda mb-4">
      Recursos Destacados
    </h2>
    <p class="text-left text-lg text-ipn-gray-dark max-w-3xl mb-12 lg:mb-16">
      Accede rápidamente a las herramientas y colecciones esenciales que el SIBIPN pone a tu disposición para potenciar tu investigación y aprendizaje.
    </p>

    {{-- Grid ----------------------------------------------------------------- --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 lg:gap-8">

      {{-- Catálogo ----------------------------------------------------------- --}}
      <a href="/buscar"
         class="rc-card group relative rounded-xl overflow-hidden shadow-lg transition-shadow duration-300 ease-in-out min-h-[320px] flex flex-col md:col-span-1">
        <div class="rc-card-bg absolute inset-0 bg-cover bg-center"
             style="background-image:url('{{ asset('images/catalogo.jpg') }}')"></div>

        <div class="rc-card-overlay absolute inset-0 bg-gradient-to-t from-black/80 via-black/60 to-transparent"></div>

        <div class="rc-card-content relative mt-auto p-6 z-10 text-white">
          <h3 class="text-xl font-roboto font-semibold mb-2">Catálogo en Línea</h3>
          <p class="text-sm text-ipn-gray-light mb-4 line-clamp-3">
            Accede a millones de registros bibliográficos de toda la red politécnica.
          </p>
          <span class="inline-block font-semibold text-sm">
            Explorar Catálogo &rarr;
          </span>
        </div>
      </a>

      {{-- Biblioteca Digital -------------------------------------------------- --}}
      <a href="#"
         class="rc-card group relative rounded-xl overflow-hidden shadow-lg transition-shadow duration-300 ease-in-out min-h-[320px] flex flex-col md:col-span-2">
        <div class="rc-card-bg absolute inset-0 bg-cover bg-center"
             style="background-image:url('{{ asset('images/biblioteca-digital.jpg') }}')"></div>
        <div class="rc-card-overlay absolute inset-0 bg-gradient-to-t from-black/80 via-black/60 to-transparent"></div>
        <div class="rc-card-content relative mt-auto p-6 z-10 text-white">
          <h3 class="text-xl font-roboto font-semibold mb-2">Biblioteca Digital</h3>
          <p class="text-sm text-ipn-gray-light mb-4 line-clamp-3">
            Consulta miles de libros electrónicos y revistas científicas suscritas por el IPN.
          </p>
          <span class="inline-block font-semibold text-sm">
            Acceder Ahora &rarr;
          </span>
        </div>
      </a>

      {{-- Repositorio --------------------------------------------------------- --}}
      <a href="#"
         class="rc-card group relative rounded-xl overflow-hidden shadow-lg transition-shadow duration-300 ease-in-out min-h-[320px] flex flex-col md:col-span-2">
        <div class="rc-card-bg absolute inset-0 bg-cover bg-center"
             style="background-image:url('{{ asset('images/repositorio.jpg') }}')"></div>
        <div class="rc-card-overlay absolute inset-0 bg-gradient-to-t from-black/80 via-black/60 to-transparent"></div>
        <div class="rc-card-content relative mt-auto p-6 z-10 text-white">
          <h3 class="text-xl font-roboto font-semibold mb-2">Repositorio Institucional</h3>
          <p class="text-sm text-ipn-gray-light mb-4 line-clamp-3">
            Descubre tesis doctorales, artículos y la producción científica del IPN.
          </p>
          <span class="inline-block font-semibold text-sm">
            Consultar Repositorio &rarr;
          </span>
        </div>
      </a>

      {{-- Guías --------------------------------------------------------------- --}}
      <a href="/aprende"
         class="rc-card group relative rounded-xl overflow-hidden shadow-lg transition-shadow duration-300 ease-in-out min-h-[320px] flex flex-col md:col-span-1">
        <div class="rc-card-bg absolute inset-0 bg-cover bg-center"
             style="background-image:url('{{ asset('images/guias.jpg') }}')"></div>
        <div class="rc-card-overlay absolute inset-0 bg-gradient-to-t from-black/80 via-black/60 to-transparent"></div>
        <div class="rc-card-content relative mt-auto p-6 z-10 text-white">
          <h3 class="text-xl font-roboto font-semibold mb-2">Guías y Tutoriales</h3>
          <p class="text-sm text-ipn-gray-light mb-4 line-clamp-3">
            Aprende a aprovechar bases de datos, gestores bibliográficos y más.
          </p>
          <span class="inline-block font-semibold text-sm">
            Ver Guías &rarr;
          </span>
        </div>
      </a>

    </div>
  </div>
</section>
