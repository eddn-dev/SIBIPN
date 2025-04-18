{{-- resources/views/components/layout/header.blade.php --}}
<header x-data="{ isOpen: false, userMenuOpen: false }" class="bg-ipn-guinda shadow-md sticky top-0 z-40">
    {{-- Hidden logout form --}}
    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
        @csrf
    </form>

    <nav class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-16">
            {{-- Sección Izquierda: Logos y Título --}}
            <div class="flex items-center">
                <a href="{{ url('/') }}" class="flex-shrink-0 flex items-center space-x-2">
                    <img src="{{ asset('images/logo_sibipn_blanco.svg') }}"
                         alt="Logotipo SIBIPN"
                         class="h-8 w-auto">
                    <span class="font-teko text-2xl font-bold text-white sm:inline">
                        SIB-IPN
                    </span>
                </a>
            </div>

            {{-- Sección Central: Navegación Principal (Desktop) --}}
            <div class="hidden lg:flex lg:items-center lg:space-x-4">
                <a href="/buscar" class="text-ipn-gray-light hover:text-white px-3 py-2 rounded-md text-sm font-medium">
                    Catálogo
                </a>
                <a href="/aprende" class="text-ipn-gray-light hover:text-white px-3 py-2 rounded-md text-sm font-medium">
                    Aprende en SIBIPN
                </a>
                <a href="/comunidad" class="text-ipn-gray-light hover:text-white px-3 py-2 rounded-md text-sm font-medium">
                    Comunidad SIBIPN
                </a>
                <a href="/bibliotecas" class="text-ipn-gray-light hover:text-white px-3 py-2 rounded-md text-sm font-medium">
                    Bibliotecas
                </a>
                <a href="/ayuda" class="text-ipn-gray-light hover:text-white px-3 py-2 rounded-md text-sm font-medium">
                    Ayuda
                </a>
            </div>

            {{-- Sección Derecha: Acceso/Usuario y Menú Móvil --}}
            <div class="flex items-center">
                {{-- Usuario (Desktop) --}}
                <div class="hidden lg:block ml-4 relative">
                    @guest
                        <a href="{{ route('login') }}"
                           class="bg-white text-ipn-guinda hover:bg-ipn-gray-light px-4 py-2 rounded-md text-sm font-medium border border-ipn-guinda">
                            Ingresar
                        </a>
                    @endguest

                    @auth
                        <div x-data="{ userMenuOpen: false }" class="relative">
                            <button @click="userMenuOpen = !userMenuOpen"
                                    @keydown.escape.window="userMenuOpen = false"
                                    type="button"
                                    class="flex items-center text-sm rounded-full text-white focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-ipn-guinda focus:ring-white"
                                    id="user-menu-button"
                                    aria-expanded="false"
                                    aria-haspopup="true">
                                <span class="sr-only">Abrir menú de usuario</span>
                                <span class="inline-flex items-center justify-center h-8 w-8 rounded-full bg-ipn-guinda-desat ring-1 ring-white">
                                    <span class="text-sm font-medium text-white">
                                        {{ Str::substr(Auth::user()->name, 0, 1) }}
                                    </span>
                                </span>
                                <span class="ml-2 hidden md:inline">{{ Auth::user()->name }}</span>
                                <svg class="ml-1 h-5 w-5 text-ipn-gray-light" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                          d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                          clip-rule="evenodd" />
                                </svg>
                            </button>

                            <div x-show="userMenuOpen"
                                 x-transition:enter="transition ease-out duration-100"
                                 x-transition:enter-start="transform opacity-0 scale-95"
                                 x-transition:enter-end="transform opacity-100 scale-100"
                                 x-transition:leave="transition ease-in duration-75"
                                 x-transition:leave-start="transform opacity-100 scale-100"
                                 x-transition:leave-end="transform opacity-0 scale-95"
                                 @click.away="userMenuOpen = false"
                                 class="origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-lg py-1 bg-white ring-1 ring-black ring-opacity-5"
                                 role="menu"
                                 aria-orientation="vertical"
                                 aria-labelledby="user-menu-button">
                                <a href="/mi-sibipn"
                                   class="block px-4 py-2 text-sm text-ipn-gray-dark hover:bg-ipn-gray-light"
                                   role="menuitem">
                                    Mi SIBIPN
                                </a>
                                <a href="/mi-sibipn/prestamos"
                                   class="block px-4 py-2 text-sm text-ipn-gray-dark hover:bg-ipn-gray-light"
                                   role="menuitem">
                                    Mis Préstamos
                                </a>
                                <a href="/mi-sibipn/reservas"
                                   class="block px-4 py-2 text-sm text-ipn-gray-dark hover:bg-ipn-gray-light"
                                   role="menuitem">
                                    Mis Reservas
                                </a>
                                <hr class="border-ipn-gray-light my-1">
                                <a href="#"
                                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                                   class="block px-4 py-2 text-sm text-ipn-gray-dark hover:bg-ipn-gray-light"
                                   role="menuitem">
                                    Cerrar Sesión
                                </a>
                            </div>
                        </div>
                    @endauth
                </div>

                {{-- Menú Móvil --}}
                <div class="ml-2 -mr-2 flex items-center lg:hidden">
                    <button @click="isOpen = !isOpen"
                            type="button"
                            class="inline-flex items-center justify-center p-2 rounded-md text-ipn-gray-light hover:text-white hover:bg-ipn-guinda-desat focus:outline-none focus:ring-2 focus:ring-inset focus:ring-white"
                            aria-controls="mobile-menu"
                            aria-expanded="false">
                        <span class="sr-only">Abrir menú principal</span>
                        <svg x-show="!isOpen" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                        <svg x-show="isOpen" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>

            {{-- Panel Menú Móvil --}}
            <div x-show="isOpen"
                 x-transition:enter="transition ease-out duration-200"
                 x-transition:enter-start="opacity-0 scale-95"
                 x-transition:enter-end="opacity-100 scale-100"
                 x-transition:leave="transition ease-in duration-150"
                 x-transition:leave-start="opacity-100 scale-100"
                 x-transition:leave-end="opacity-0 scale-95"
                 class="lg:hidden absolute top-16 inset-x-0 p-2 transition transform origin-top-right z-30"
                 id="mobile-menu">
                <div class="rounded-lg shadow-lg ring-1 ring-black ring-opacity-5 bg-white divide-y-2 divide-ipn-gray-light">
                    <div class="pt-5 pb-6 px-5 space-y-1">
                        <a href="/buscar"
                           class="block px-3 py-2 rounded-md text-base font-medium text-ipn-gray-dark hover:text-ipn-guinda hover:bg-ipn-gray-light">
                            Catálogo
                        </a>
                        <a href="/aprende"
                           class="block px-3 py-2 rounded-md text-base font-medium text-ipn-gray-dark hover:text-ipn-guinda hover:bg-ipn-gray-light">
                            Aprende en SIBIPN
                        </a>
                        <a href="/comunidad"
                           class="block px-3 py-2 rounded-md text-base font-medium text-ipn-gray-dark hover:text-ipn-guinda hover:bg-ipn-gray-light">
                            Comunidad SIBIPN
                        </a>
                        <a href="/bibliotecas"
                           class="block px-3 py-2 rounded-md text-base font-medium text-ipn-gray-dark hover:text-ipn-guinda hover:bg-ipn-gray-light">
                            Bibliotecas
                        </a>
                        <a href="/ayuda"
                           class="block px-3 py-2 rounded-md text-base font-medium text-ipn-gray-dark hover:text-ipn-guinda hover:bg-ipn-gray-light">
                            Ayuda
                        </a>
                    </div>
                    <div class="pt-4 pb-3 px-5">
                        @guest
                            <div class="mt-3">
                                <a href="{{ route('login') }}"
                                   class="w-full flex items-center justify-center px-4 py-2 rounded-md text-base font-medium text-white bg-ipn-guinda hover:bg-ipn-guinda-desat">
                                    Ingresar
                                </a>
                            </div>
                        @endguest
                        @auth
                            <div class="flex items-center space-x-3 mb-3">
                                <span class="inline-flex items-center justify-center h-10 w-10 rounded-full bg-ipn-guinda-desat ring-1 ring-ipn-guinda">
                                    <span class="text-sm font-medium text-white">
                                        {{ Str::substr(Auth::user()->name, 0, 1) }}
                                    </span>
                                </span>
                                <div>
                                    <div class="text-base font-medium text-ipn-gray-dark">{{ Auth::user()->name }}</div>
                                    <div class="text-sm font-medium text-ipn-gray">{{ Auth::user()->correoInstitucional }}</div>
                                </div>
                            </div>
                            <a href="#"
                               onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                               class="block px-3 py-2 rounded-md text-base font-medium text-ipn-gray-dark hover:text-ipn-guinda hover:bg-ipn-gray-light">
                                Cerrar Sesión
                            </a>
                        @endauth
                    </div>
                </div>
            </div>
        </div>
    </nav>
</header>
