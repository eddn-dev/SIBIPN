{{-- resources/views/partials/landing/hero.blade.php --}}
<section id="hero-section"
         class="relative min-h-screen flex flex-col items-center justify-center text-white overflow-hidden">

    {{-- 1. Mosaico ---------------------------------------------------------------- --}}
    <div id="hero-mosaic-container"
         class="absolute inset-0 grid grid-cols-3 sm:grid-cols-4 lg:grid-cols-5
                grid-rows-3 sm:grid-rows-2 gap-1 sm:gap-2 transform scale-110 blur-sm brightness-75">
        @php($imgs = ['hero','hero2','hero3','hero4','hero5','hero6','hero7','hero8','hero9'])
        @foreach ($imgs as $i => $file)
            <div
              class="hero-mosaic-tile {{ in_array($i,[3,8]) ? 'hidden lg:block' : '' }}
                                     {{ $i==5 ? 'hidden sm:block' : '' }}
                                     {{ $i==1 ? 'col-span-1 sm:col-span-2' : '' }}
                                     {{ $i==6 ? 'col-span-1 sm:col-span-2 lg:col-span-3' : '' }}
                                     bg-cover bg-center"
              style="background-image:url('{{ asset("images/$file.jpg") }}')">
            </div>
        @endforeach
    </div>

    {{-- 2. Overlay ---------------------------------------------------------------- --}}
    <div id="hero-overlay"
         class="absolute inset-0 bg-ipn-guinda opacity-70 z-10 pointer-events-none"
         style="transform:scale(1.05); will-change:transform;"></div>

    {{-- 3. Contenido -------------------------------------------------------------- --}}
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 text-center relative z-20 pt-24 pb-12">
        <h1 id="hero-main-title"
            class="text-5xl sm:text-6xl md:text-7xl lg:text-8xl font-teko font-bold uppercase tracking-tight mb-6">
            <span>Explora.</span> <span>Investiga.</span> <span>Innova.</span>
        </h1>

        <p id="hero-subtitle"
           class="text-lg sm:text-xl font-sans mb-10 max-w-2xl mx-auto text-ipn-gray-light">
           El Sistema Integral de Bibliotecas del IPN: tu puerta de acceso al conocimiento politécnico.
        </p>

        {{-- Buscador --}}
    <div id="hero-search-form"
        class="max-w-2xl mx-auto mb-10"
        x-data="{ searchTerm:'', suggestions:[], focused:false }">

        <form action="/buscar" method="GET" class="relative">

            <input  type="search" name="q" id="search-landing"
                    x-model="searchTerm"
                    @focus="focused=true" @blur="setTimeout(()=>focused=false,150)"
                    placeholder="Buscar libros, artículos, tesis, autores…"

                    class="peer w-full rounded-full px-6 py-4 text-lg
                        bg-white/10 backdrop-blur-md shadow-lg transition
                        border border-transparent text-white placeholder-white/60

                        hover:bg-white/15
                        focus:bg-white/10 focus:outline-none
                        focus:border-[var(--color-ipn-oro)]
                        focus:ring-2 focus:ring-[var(--color-ipn-oro)]
                        focus:placeholder-white/70"
                    autocomplete="off" />

            <button type="submit" aria-label="Buscar"
                    class="absolute inset-y-0 right-0 flex items-center px-5
                        text-white/80 transition-colors
                        hover:text-white">

            {{-- icono lupa cambia a ipn-oro cuando el input está en focus --}}
            <svg class="w-6 h-6
                        peer-focus:text-[var(--color-ipn-oro)]"
                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
            </svg>
            </button>

        </form>
    </div>

        {{-- Mensaje de búsqueda --}}


        {{-- Botones CTA --}}
        <div id="hero-buttons-container"
             class="mt-10 flex flex-col sm:flex-row flex-wrap items-center justify-center gap-4">
            @guest
                <x-button.primary   href="{{ route('login') }}"    class="sm:w-auto text-lg">Iniciar Sesión</x-button.primary>
                <x-button.secondary href="{{ route('register') }}" class="sm:w-auto text-lg">
                    Crear Cuenta
                </x-button.secondary>
            @endguest
            @auth
                <x-button.primary href="{{ route('sibipn') }}" class="w-full sm:w-auto text-lg">Ir a Mi SIBIPN</x-button.primary>
            @endauth
        </div>
    </div>
</section>
 