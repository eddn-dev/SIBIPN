{{-- resources/views/layouts/admin.blade.php --}}
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Admin - SIBIPN')</title>

    {{-- Fuentes --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&family=Roboto:wght@400;500;700&family=Teko:wght@400;700&display=swap" rel="stylesheet">

    {{-- Estilos y Scripts (Vite) --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')
</head>
<body class="font-sans antialiased bg-ipn-guinda-dark text-ipn-gray-lighten">
    @once
        <div style="display: none; position: absolute; width: 0; height: 0; overflow: hidden;">
            @php
                $spritePath = resource_path('icons/sprite.svg'); // Ajusta la ruta si es necesario
                if (file_exists($spritePath)) {
                    echo file_get_contents($spritePath);
                } else {
                    Log::error("Archivo de sprite SVG no encontrado en: " . $spritePath);
                    echo "";
                }
            @endphp
        </div>
    @endonce
    {{-- Contenedor Principal --}}
    {{-- Utilizamos Alpine.js para manejar la apertura/cierre del sidebar --}}
    {{-- Puedes usar Livewire o Vue.js si lo prefieres, pero aquí es solo HTML y Alpine.js --}}
    <div x-data="{ sidebarOpen: false }" class="relative min-h-screen bg-ipn-guinda-dark">

        {{-- Capa de Fondo: Imagen + Blur --}}
        <div class="absolute inset-0 z-0">
            <img src="{{ asset('images/hero.jpg') }}" alt="Fondo Admin"
                 class="object-cover w-full h-full opacity-15 blur-lg">
        </div>

        {{-- Formulario Logout --}}
        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">@csrf</form>

        {{-- Sidebar --}}
        <aside
            class="fixed inset-y-0 left-0 z-50 w-64 bg-ipn-guinda-dark/20 backdrop-blur-xl border-r border-white/10 text-ipn-gray-lighten shadow-lg
                   transform transition-transform duration-300 ease-in-out flex flex-col
                   -translate-x-full md:translate-x-0"
            :class="{ 'translate-x-0': sidebarOpen }"
            @click.away="sidebarOpen = false"
            >

            {{-- Logo en Sidebar --}}
            <div class="h-16 flex items-center justify-center flex-shrink-0 px-4 border-b border-white/10">
                 <a href="{{ route('admin.dashboard') }}" class="flex items-center space-x-2 text-white">
                    <img src="{{ asset('images/logo_sibipn_blanco.svg') }}" alt="SIBIPN Admin" class="h-8 w-auto">
                    <span class="font-teko text-2xl font-bold">
                        SIB‑IPN <span class="font-normal opacity-80">Admin</span>
                    </span>
                </a>
            </div>

            {{-- === INCLUYE EL COMPONENTE SIDEBAR === --}}
            <x-layout.aside-admin />
            {{-- ===================================== --}}


            {{-- Menú Usuario en Sidebar (Abajo) --}}
            <div class="mt-auto p-4 border-t border-white/10">
                 @auth
                    <div class="relative" x-data="{ userMenuOpen: false }">
                        <button @click="userMenuOpen = !userMenuOpen" class="flex items-center w-full text-left space-x-2 p-2 rounded-md hover:bg-white/5 transition-colors duration-150 focus:outline-none focus:ring-2 focus:ring-white/50">
                             <span class="inline-flex items-center justify-center h-8 w-8 rounded-full bg-ipn-guinda-light ring-1 ring-white/50 flex-shrink-0">
                                {{ Str::substr(Auth::user()->nombre ?? 'A', 0, 1) }}
                            </span>
                            <div class="flex-grow text-sm">
                                <span class="block font-medium text-white">{{ Auth::user()->nombre ?? 'Admin' }}</span>
                                <span class="block text-xs text-ipn-gray-lighten/80">{{ Auth::user()->rol->nombreRol ?? 'Rol no asignado' }}</span>
                            </div>
                            <svg class="h-5 w-5 text-gray-300 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"/></svg>
                        </button>
                        <div x-show="userMenuOpen" x-transition @click.away="userMenuOpen = false" class="origin-bottom-left absolute left-0 bottom-full mb-2 w-56 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 focus:outline-none" role="menu" aria-orientation="vertical" style="display: none;" x-cloak>
                            <a href="#" class="block px-4 py-2 text-sm text-ipn-gray-dark hover:bg-gray-100" role="menuitem">Mi Perfil (Admin)</a>
                            <div class="border-t border-gray-200 my-1"></div>
                            <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="block px-4 py-2 text-sm text-ipn-gray-dark hover:bg-gray-100" role="menuitem">Cerrar Sesión</a>
                        </div>
                    </div>
                @endauth
            </div>
        </aside>

        {{-- Overlay para cerrar sidebar en móvil --}}
        <div x-show="sidebarOpen" @click="sidebarOpen = false" class="fixed inset-0 bg-black/50 z-40 md:hidden" x-cloak></div>

        {{-- Contenedor del Contenido Principal --}}
        <div class="flex-1 flex flex-col">

            {{-- Barra Superior Mínima (Solo Móvil) --}}
            <div class="md:hidden sticky top-0 z-30 flex items-center justify-between px-4 sm:px-6 h-16 bg-ipn-guinda/90 backdrop-blur-md shadow-md text-white">
                <button @click.stop="sidebarOpen = !sidebarOpen" class="p-2 -ml-2 rounded-md focus:outline-none focus:ring-2 focus:ring-inset focus:ring-white">
                    <span class="sr-only">Abrir sidebar</span>
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
                </button>
                 <a href="{{ route('admin.dashboard') }}" class="flex items-center space-x-1">
                    <img src="{{ asset('images/logo_sibipn_blanco.svg') }}" alt="SIBIPN Admin" class="h-7 w-auto">
                     <span class="font-teko text-xl font-bold">Admin</span>
                </a>
                 <div class="w-8"></div>
            </div>

            {{-- Área de Contenido Principal --}}
            <main class="flex-grow p-6 lg:p-8 overflow-y-auto md:ml-64 relative z-10">
                @yield('content')
            </main>

        </div> {{-- Fin Contenedor Contenido Principal --}}

    </div> {{-- Fin Flex Container Principal --}}

    @stack('scripts')
</body>
</html>
