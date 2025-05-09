{{-- resources/views/partials/landing/hero.blade.php --}}

<section class="relative min-h-screen flex flex-col items-center justify-center text-white overflow-hidden">
    {{-- Contenedor del Mosaico (Grid) --}}
    <div class="absolute inset-0 grid grid-cols-3 sm:grid-cols-4 lg:grid-cols-5 grid-rows-3 sm:grid-rows-2 gap-1 sm:gap-2 transform scale-110 blur-sm brightness-75">
        {{-- Imágenes del Mosaico (Usa asset() para URLs correctas) --}}
        {{-- Nota: Reemplaza 'images/heroX.jpg' con tus rutas reales o placeholders --}}
        <div class="bg-cover bg-center" style="background-image: url('{{ asset('images/hero.jpg') }}');"></div>
        <div class="col-span-1 sm:col-span-2 bg-cover bg-center" style="background-image: url('{{ asset('images/hero2.jpg') }}');"></div>
        <div class="bg-cover bg-center" style="background-image: url('{{ asset('images/hero3.jpg') }}');"></div>
        <div class="hidden lg:block bg-cover bg-center" style="background-image: url('{{ asset('images/hero4.jpg') }}');"></div>
        <div class="bg-cover bg-center" style="background-image: url('{{ asset('images/hero5.jpg') }}');"></div>
        <div class="hidden sm:block bg-cover bg-center" style="background-image: url('{{ asset('images/hero6.jpg') }}');"></div>
        <div class="col-span-1 sm:col-span-2 lg:col-span-3 bg-cover bg-center" style="background-image: url('{{ asset('images/hero7.jpg') }}');"></div>
        <div class="bg-cover bg-center" style="background-image: url('{{ asset('images/hero8.jpg') }}');"></div>
        <div class="hidden lg:block bg-cover bg-center" style="background-image: url('{{ asset('images/hero9.jpg') }}');"></div>
    </div>
    {{-- Overlay semi-transparente --}}
    <div class="absolute inset-0 bg-ipn-guinda opacity-70 z-10"></div>

    {{-- Contenido Superpuesto --}}
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 text-center relative z-20 pt-24 pb-12">
        {{-- Título y Subtítulo (Sin cambios) --}}
        <h1 class="text-5xl sm:text-6xl md:text-7xl lg:text-8xl font-teko font-bold uppercase tracking-tight mb-6"
            x-data="{ loaded: false }" x-init="() => { setTimeout(() => loaded = true, 100) }"
            :class="loaded ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-4'"
            style="transition: all 0.7s cubic-bezier(0.25, 0.46, 0.45, 0.94);">
            Explora. Investiga. Innova.
        </h1>
        <p class="text-lg sm:text-xl font-sans mb-10 max-w-2xl mx-auto text-ipn-gray-light"
           x-data="{ loaded: false }" x-init="() => { setTimeout(() => loaded = true, 300) }"
           :class="loaded ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-4'"
           style="transition: all 0.7s cubic-bezier(0.25, 0.46, 0.45, 0.94) 0.15s;">
            El Sistema Integral de Bibliotecas del IPN: tu puerta de acceso al conocimiento politécnico.
        </p>

        {{-- Buscador Prominente (Sin cambios) --}}
        <div class="max-w-2xl mx-auto mb-10" x-data="{ searchTerm: '', suggestions: [], focused: false }">
            <form action="/buscar" method="GET" class="relative">
                <input type="search" name="q" id="search-landing" x-model="searchTerm" @focus="focused = true" @blur="setTimeout(() => focused = false, 150)"
                       placeholder="Buscar libros, artículos, tesis, autores..."
                       class="w-full pl-6 pr-12 py-4 text-lg text-ipn-gray-dark rounded-full border-2 border-transparent focus:outline-none focus:border-ipn-gray focus:ring-2 focus:ring-ipn-gray-light focus:ring-opacity-50 shadow-lg placeholder-ipn-gray"
                       autocomplete="off">
                <button type="submit" aria-label="Buscar" class="absolute top-0 right-0 h-full px-5 text-ipn-guinda hover:text-ipn-gray-light transition-colors duration-200 flex items-center">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                </button>
            </form>
        </div>

        {{-- === INICIO: Lógica Condicional para Botones === --}}
        <div class="mt-10 flex flex-col sm:flex-row items-center justify-center gap-4">

            @guest {{-- Mostrar si el usuario NO está autenticado --}}
                {{-- Botón Primario (Iniciar Sesión) --}}
                <x-button.primary href="{{ route('login') }}" class="w-full sm:w-auto text-lg">
                    Iniciar Sesión
                </x-button.primary>

                {{-- Botón Secundario (Crear Cuenta) --}}
                <x-button.secondary href="{{ route('register') }}" class="w-full sm:w-auto text-lg">
                    Crear Cuenta
                </x-button.secondary>
            @endguest

            @auth {{-- Mostrar si el usuario SÍ está autenticado --}}
                 {{-- Mensaje de Bienvenida (Opcional) --}}
                 {{-- Asume que tu modelo User/Usuario tiene un atributo 'nombre' --}}
                <p class="text-lg text-ipn-gray-lighten mb-4 sm:mb-0 sm:mr-6">
                    ¡Hola de nuevo, {{ Auth::user()->nombre }}!
                </p>

                 {{-- Botón Principal para usuario logueado --}}
                 {{-- Cambia 'sibipn.index' por la ruta a tu panel de usuario si es diferente --}}
                 <x-button.primary href="{{ route('sibipn') }}" class="w-full sm:w-auto text-lg">
                    Ir a Mi SIBIPN
                 </x-button.primary>
            @endauth

        </div>
         {{-- === FIN: Lógica Condicional para Botones === --}}

    </div>
</section>