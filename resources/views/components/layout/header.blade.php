{{-- resources/views/components/layout/header.blade.php --}}
@php
    $isHome = request()->is('/');
@endphp

<header
    x-data="{
        isOpen: false,
        userMenuOpen: false,
        scrolled: {{ $isHome ? 'false' : 'true' }}
    }"
    x-init="
        @if($isHome)
            window.addEventListener('scroll', () => {
                scrolled = window.pageYOffset > 80
            })
        @endif
    "
    {{-- posición condicional: fixed en home, sticky en otras --}}
    class="{{ $isHome ? 'fixed inset-x-0 top-0 z-50' : 'sticky top-0 z-50' }} transition-colors duration-300"
    {{-- colores según scrolled --}}
    :class="scrolled
      ? 'bg-white text-ipn-gray-dark shadow-md'
      : 'bg-transparent text-white'"
>
    {{-- Logout form --}}
    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">@csrf</form>

    <nav class="container mx-auto px-4 sm:px-6 lg:px-8 flex items-center justify-between h-16">
        {{-- Logo --}}
        <a href="{{ url('/') }}"
           class="flex items-center space-x-2 transition-colors duration-300"
           :class="scrolled ? 'text-ipn-gray-dark' : 'text-white'">
            <img
                :src="scrolled
                  ? '{{ asset('images/logo_sibipn.svg') }}'
                  : '{{ asset('images/logo_sibipn_blanco.svg') }}'"
                alt="SIBIPN"
                class="h-8 w-auto transition-opacity duration-300"
            >
            <span class="font-teko text-2xl font-bold transition-colors duration-300"
                  :class="scrolled ? 'text-ipn-gray-dark' : 'text-white'">
                SIB‑IPN
            </span>
        </a>

        {{-- Enlaces desktop --}}
        <div class="hidden lg:flex lg:space-x-6">
            @foreach([
                ['url'=>'/buscar','label'=>'Catálogo'],
                ['url'=>'/aprende','label'=>'Aprende'],
                ['url'=>'/comunidad','label'=>'Comunidad'],
                ['url'=>'/bibliotecas','label'=>'Bibliotecas'],
                ['url'=>'/ayuda','label'=>'Ayuda'],
            ] as $link)
                <a href="{{ $link['url'] }}"
                   class="px-3 py-2 rounded-md text-sm font-medium transition-colors duration-300"
                   :class="scrolled
                     ? 'text-ipn-gray-dark hover:text-ipn-guinda'
                     : 'text-white hover:text-gray-200'">
                    {{ $link['label'] }}
                </a>
            @endforeach
        </div>

        {{-- Auth desktop --}}
        <div class="flex items-center">
            <div class="hidden lg:block">
                @guest
                    <a href="{{ route('login') }}"
                       class="px-4 py-2 rounded-md text-sm font-medium border transition-colors duration-300"
                       :class="scrolled
                         ? 'border-ipn-guinda bg-ipn-guinda text-white hover:bg-ipn-guinda-desat'
                         : 'border-white bg-white text-ipn-guinda hover:bg-gray-100'">
                        Ingresar
                    </a>
                @endguest

                @auth
                    <div class="relative inline-block ml-4">
                        <button @click="userMenuOpen = !userMenuOpen"
                                @keydown.escape.window="userMenuOpen = false"
                                class="flex items-center space-x-2 text-sm rounded-md focus:outline-none transition-colors duration-300"
                                :class="scrolled ? 'text-ipn-gray-dark' : 'text-white'">
                            <span class="inline-flex items-center justify-center h-8 w-8 rounded-full bg-ipn-guinda-desat ring-1 ring-current">
                                {{ Str::substr(Auth::user()->name, 0, 1) }}
                            </span>
                            <span>{{ Auth::user()->name }}</span>
                            <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                      d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1
                                      0 111.414 1.414l-4 4a1 1 0 01-1.414
                                      0l-4-4a1 1 0 010-1.414z"
                                      clip-rule="evenodd"/>
                            </svg>
                        </button>
                        <div x-show="userMenuOpen"
                             x-transition:enter="transition ease-out duration-100"
                             x-transition:leave="transition ease-in duration-75"
                             @click.away="userMenuOpen = false"
                             class="origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5"
                             role="menu"
                        >
                            <a href="/mi-sibipn" class="block px-4 py-2 text-sm text-ipn-gray-dark hover:bg-gray-100" role="menuitem">Mi SIBIPN</a>
                            <a href="/mi-sibipn/prestamos" class="block px-4 py-2 text-sm text-ipn-gray-dark hover:bg-gray-100" role="menuitem">Mis Préstamos</a>
                            <a href="/mi-sibipn/reservas" class="block px-4 py-2 text-sm text-ipn-gray-dark hover:bg-gray-100" role="menuitem">Mis Reservas</a>
                            <div class="border-t border-ipn-gray-light my-1"></div>
                            <a href="#"
                               onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                               class="block px-4 py-2 text-sm text-ipn-gray-dark hover:bg-gray-100"
                               role="menuitem">Cerrar Sesión</a>
                        </div>
                    </div>
                @endauth
            </div>

            {{-- Botón móvil --}}
            <div class="lg:hidden ml-4">
                <button @click="isOpen = !isOpen"
                        class="p-2 rounded-md focus:outline-none transition-colors duration-300"
                        :class="scrolled ? 'text-ipn-gray-dark' : 'text-white'">
                    <svg x-show="!isOpen" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                    <svg x-show="isOpen" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
        </div>
    </nav>

    {{-- Menú móvil --}}
    <div
        x-show="isOpen"
        x-transition:enter="transition ease-out duration-200"
        x-transition:leave="transition ease-in duration-150"
        class="{{ $isHome ? 'fixed' : 'sticky' }} inset-x-0 top-16 bg-white shadow-md lg:hidden z-40"
    >
        <div class="px-4 py-6 space-y-4">
            <a href="/buscar" class="block text-ipn-gray-dark hover:text-ipn-guinda">Catálogo</a>
            <a href="/aprende" class="block text-ipn-gray-dark hover:text-ipn-guinda">Aprende</a>
            <a href="/comunidad" class="block text-ipn-gray-dark hover:text-ipn-guinda">Comunidad</a>
            <a href="/bibliotecas" class="block text-ipn-gray-dark hover:text-ipn-guinda">Bibliotecas</a>
            <a href="/ayuda" class="block text-ipn-gray-dark hover:text-ipn-guinda">Ayuda</a>
            @guest
                <a href="{{ route('login') }}" class="block mt-4 px-4 py-2 bg-ipn-guinda text-white text-center rounded-md">Ingresar</a>
            @endguest
            @auth
                <div class="mt-4 border-t border-ipn-gray-light pt-4">
                    <a href="#"
                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                       class="block px-4 py-2 text-ipn-gray-dark hover:text-ipn-guinda">Cerrar Sesión</a>
                </div>
            @endauth
        </div>
    </div>
</header>
