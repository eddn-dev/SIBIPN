<section id="cta-final"
         class="relative isolate flex flex-col items-center justify-center
                min-h-screen overflow-hidden bg-ipn-gray-light">  {{-- fondo base blanco --}}

  {{-- Círculo que crecerá hasta cubrir todo --}}
  <div id="cta-window"
       class="absolute inset-0 -z-10 bg-cta-gradient animate-gradient-pan
              clip-circle will-change-[clip-path]">
  </div>

  <div class="relative z-10 px-6 py-28 lg:py-40 text-center">
    <h2 id="cta-headline"
        class="font-teko font-bold text-6xl md:text-8xl text-ipn-oro drop-shadow-xl opacity-0">
        <span>Únete a la comunidad</span><br>
        <span>SIBIPN</span>
    </h2>

    <p id="cta-paragraph"
      class="mt-6 max-w-prose mx-auto text-center
              text-lg md:text-xl font-inter text-ipn-gray-light opacity-0">
      Conecta con miles de politécnicos, comparte recursos y lleva tu investigación al siguiente nivel.
    </p>

    {{-- Botones de llamada a la acción --}}
    <div id="cta-buttons-container"
         class="mt-10 flex flex-col sm:flex-row gap-4 items-center justify-center opacity-0">
      @guest
        <x-button.primary   href="{{ route('login') }}"    class="text-lg">Iniciar Sesión</x-button.primary>
        <x-button.secondary href="{{ route('register') }}" class="text-lg">Crear Cuenta</x-button.secondary>
      @endguest
      @auth
        <x-button.primary href="{{ route('sibipn') }}" class="text-lg">
          Ir a Mi SIBIPN
        </x-button.primary>
      @endauth
    </div>
  </div>
</section>
