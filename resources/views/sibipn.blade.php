{{-- resources/views/dashboard.blade.php --}}
@extends('layouts.app')

@section('title', 'Mi SIBIPN - Dashboard')

@section('content')
{{-- Contenedor principal con fondo de imagen + overlay + blur --}}
<div class="relative min-h-[calc(100vh-128px)] py-12 bg-gray-900 text-gray-300 overflow-hidden"> {{-- Base oscura --}}
    {{-- Capa de Fondo: Imagen + Blur + Overlay --}}
    <div class="absolute inset-0 z-0">
        {{-- Asegúrate que la ruta 'images/hero.jpg' sea correcta --}}
        <img src="{{ asset('images/hero.jpg') }}" alt="Fondo Biblioteca" class="object-cover w-full h-full opacity-20 blur-lg"> {{-- Ajusta opacidad y blur --}}
        {{-- Overlay oscuro gradiente --}}
        <div class="absolute inset-0 bg-gradient-to-b from-ipn-guinda-desat/50 via-ipn-gray-dark/70 to-gray-900"></div>
    </div>

    {{-- Contenido del dashboard (encima del fondo) --}}
    <div class="relative z-10 container mx-auto px-4 sm:px-6 lg:px-8">

        {{-- Saludo Personalizado --}}
        <h1 class="text-3xl lg:text-4xl font-teko font-bold text-white mb-8">
            ¡Bienvenido, Eduardo Politécnico!
        </h1>

        {{-- Layout Principal del Dashboard --}}
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

            {{-- Columna Principal --}}
            <div class="lg:col-span-2 space-y-8">

                {{-- Sección Préstamos Activos --}}
                <section class="bg-gray-800/80 backdrop-blur-sm p-6 rounded-lg shadow-lg border border-gray-700/50"> {{-- Fondo tarjeta --}}
                    <h2 class="text-xl font-roboto font-semibold text-white mb-5">Mis Préstamos Activos</h2>

                    {{-- Item Préstamo Normal --}}
                    <div class="bg-gray-800/60 rounded-md p-4 mb-4 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 border border-gray-700">
                        <div class="flex-grow">
                            <h3 class="font-semibold text-ipn-gray-light">Cálculo Vectorial Avanzado (Placeholder)</h3>
                            <p class="text-sm text-gray-400">Vence el {{ \Carbon\Carbon::today()->addDays(10)->isoFormat('LL') }}</p>
                            <p class="text-xs text-gray-500 mt-1">Prestado el: {{ \Carbon\Carbon::today()->subDays(5)->isoFormat('LL') }} | Ejemplar: 123456789 (Placeholder)</p>
                        </div>
                        <div class="flex-shrink-0">
                            <form method="POST" action="#"> @csrf @method('PUT')
                                {{-- Usando componente primario --}}
                                <x-button.primary type="submit" class="text-sm !px-4 !py-1">
                                    Renovar
                                </x-button.primary>
                            </form>
                        </div>
                    </div>

                    {{-- Item Próximo a Vencer --}}
                    <div class="bg-gray-800/60 rounded-md p-4 mb-4 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 border border-yellow-600/80 border-l-4 border-l-yellow-500">
                        <div class="flex-grow">
                            <h3 class="font-semibold text-ipn-gray-light">Introducción a la Termodinámica (Placeholder)</h3>
                            <p class="text-sm text-yellow-400 font-medium">Vence en 2 día(s)</p>
                            <p class="text-xs text-gray-500 mt-1">Prestado el: {{ \Carbon\Carbon::today()->subDays(12)->isoFormat('LL') }} | Ejemplar: 987654321 (Placeholder)</p>
                        </div>
                        <div class="flex-shrink-0">
                             <span class="text-xs text-yellow-400 italic">¡Renovar pronto!</span>
                        </div>
                    </div>

                     {{-- Item Vencido --}}
                    <div class="bg-gray-800/60 rounded-md p-4 mb-4 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 border border-red-600/80 border-l-4 border-l-red-500">
                        <div class="flex-grow">
                            <h3 class="font-semibold text-ipn-gray-light">Redes Neuronales Convolucionales (Placeholder)</h3>
                            <p class="text-sm text-red-400 font-semibold">Vencido hace 3 día(s)</p>
                            <p class="text-xs text-gray-500 mt-1">Prestado el: {{ \Carbon\Carbon::today()->subDays(18)->isoFormat('LL') }} | Ejemplar: ABC123XYZ (Placeholder)</p>
                        </div>
                        <div class="flex-shrink-0">
                             <span class="text-xs text-red-400 italic font-semibold">¡Devolver ya!</span>
                        </div>
                    </div>

                    {{-- Enlace a sección completa --}}
                    <div class="mt-6 text-right">
                        <a href="#" class="text-sm font-medium text-ipn-guinda hover:text-ipn-guinda-desat hover:underline">
                            Ver todos mis préstamos &rarr;
                        </a>
                    </div>
                </section>
            </div>

            {{-- Columna Lateral --}}
            <div class="lg:col-span-1 space-y-6">

                {{-- Alerta de Multas Pendientes --}}
                <div class="bg-red-800/90 border border-red-700 text-red-100 p-4 rounded-lg shadow-md" role="alert">
                    <div class="flex items-center mb-2">
                         <svg class="h-6 w-6 mr-2 text-red-300" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 3.75h.008v.008H12v-.008Z" /></svg>
                        <p class="font-bold text-red-100">Multas Pendientes</p>
                    </div>
                    <p class="text-sm mb-3">
                        Tienes 2 multa(s) pendiente(s) por un total de
                        <span class="font-semibold text-white">$75.00 MXN</span>.
                    </p>
                    {{-- Usando componente secundario, estilizado como enlace-botón --}}
                    <x-button.secondary href="#" class="text-sm !py-1 !px-3 !bg-red-600/80 !border-transparent !text-red-100 hover:!bg-red-500/80 hover:!text-white !shadow-none hover:!scale-100 hover:!underline">
                        Ver detalles y Pagar &rarr;
                    </x-button.secondary>
                </div>

                 {{-- Alerta de Reservas Disponibles --}}
                <div class="bg-green-800/90 border border-green-700 text-green-100 p-4 rounded-lg shadow-md" role="alert">
                     <div class="flex items-center mb-2">
                         <svg class="h-6 w-6 mr-2 text-green-300" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" /></svg>
                        <p class="font-bold text-green-100">Reservas Listas</p>
                    </div>
                    <p class="text-sm mb-3">
                        Tienes 1 reserva(s) lista(s) para recoger en biblioteca.
                    </p>
                     {{-- Usando componente secundario, estilizado como enlace-botón --}}
                    <x-button.secondary href="#" class="text-sm !py-1 !px-3 !bg-green-600/80 !border-transparent !text-green-100 hover:!bg-green-500/80 hover:!text-white !shadow-none hover:!scale-100 hover:!underline">
                        Ver mis reservas &rarr;
                    </x-button.secondary>
                </div>

                {{-- Accesos Rápidos --}}
                {{-- Tarjeta con fondo oscuro --}}
                <div class="bg-gray-800/80 backdrop-blur-sm p-6 rounded-lg shadow-lg border border-gray-700/50">
                     <h3 class="text-lg font-roboto font-semibold text-white mb-4">Accesos Rápidos</h3>
                     <div class="space-y-3">
                         {{-- Usando componente secundario, estilizado como enlace de lista --}}
                         <x-button.secondary href="/buscar" class="w-full !justify-start !p-3 !bg-gray-700/50 hover:!bg-gray-700/80 !border-transparent !text-ipn-gray-light hover:!text-white !shadow-none hover:!scale-100 group">
                             <svg class="h-5 w-5 text-ipn-guinda mr-3 group-hover:text-ipn-guinda-desat" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                             <span class="text-sm font-medium">Buscar en Catálogo</span>
                         </x-button.secondary>
                         <x-button.secondary href="#" class="w-full !justify-start !p-3 !bg-gray-700/50 hover:!bg-gray-700/80 !border-transparent !text-ipn-gray-light hover:!text-white !shadow-none hover:!scale-100 group">
                              <svg class="h-5 w-5 text-ipn-guinda mr-3 group-hover:text-ipn-guinda-desat" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 0 0 6 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 0 1 6 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 0 1 6-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0 0 18 18a8.967 8.967 0 0 0-6 2.292m0-14.25v14.25" /></svg>
                             <span class="text-sm font-medium">Mi Historial de Préstamos</span>
                         </x-button.secondary>
                         <x-button.secondary href="{{ route('profile.edit') }}" class="w-full !justify-start !p-3 !bg-gray-700/50 hover:!bg-gray-700/80 !border-transparent !text-ipn-gray-light hover:!text-white !shadow-none hover:!scale-100 group">
                             <svg class="h-5 w-5 text-ipn-guinda mr-3 group-hover:text-ipn-guinda-desat" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M10.343 3.94c.09-.542.56-.94 1.11-.94h1.093c.55 0 1.02.398 1.11.94l.149.894c.07.424.384.764.78.93.398.164.855.142 1.205-.108l.737-.527c.48-.342 1.12-.301 1.54.117l.732.732c.42.42.46.97.117 1.54l-.527.737c-.25.35-.272.806-.108 1.204.165.397.505.71.93.78l.893.15c.543.09.94.56.94 1.11v1.093c0 .55-.397 1.02-.94 1.11l-.893.15c-.425.07-.765.383-.93.78-.164.398-.142.854.108 1.204l.527.738c.342.48.302 1.12-.118 1.54l-.732.732c-.42-.42-.97.46-1.54.117l-.737-.527c-.35-.25-.806-.272-1.204-.108-.397.165-.71.505-.78.93l-.15.893c-.09.543-.56.94-1.11.94h-1.093c-.55 0-1.02-.397-1.11-.94l-.149-.893c-.07-.424-.384-.765-.78-.93-.398-.165-.854-.142-1.205.108l-.738.527c-.48.343-1.12.302-1.54-.118l-.732-.732c-.42-.42-.46-.97-.117-1.54l.527-.738c.25-.35.273-.806.108-1.204-.165-.397-.506-.71-.93-.78l-.894-.15c-.542-.09-.94-.56-.94-1.11v-1.093c0-.55.398-1.02.94-1.11l.894-.15c.424-.07.765-.383.93-.78.165-.398.142-.854-.108-1.204l-.527-.738c-.343-.48-.302-1.12.117-1.54l.732-.732c.42-.42.97-.46 1.54-.117l.737.527c.35.25.807.272 1.204.108.397-.165.71-.505-.78.93l.15-.893Z" /><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" /></svg>
                             <span class="text-sm font-medium text-ipn-gray-light group-hover:text-white">Mi Perfil y Preferencias</span>
                         </x-button.secondary>
                     </div>
                </div>

                 {{-- Integración Aprende/Comunidad --}}
                 <div class="bg-gray-800/80 backdrop-blur-sm p-6 rounded-lg shadow-lg border border-gray-700/50">
                     <h3 class="text-lg font-roboto font-semibold text-white mb-4">Explora Más</h3>
                      <div class="space-y-3">
                           <x-button.secondary href="/aprende" class="w-full !justify-start !p-3 !bg-gray-700/50 hover:!bg-gray-700/80 !border-transparent !text-ipn-gray-light hover:!text-white !shadow-none hover:!scale-100 group">
                             <svg class="h-5 w-5 text-ipn-guinda mr-3 group-hover:text-ipn-guinda-desat" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 0 0 6 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 0 1 6 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 0 1 6-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0 0 18 18a8.967 8.967 0 0 0-6 2.292m0-14.25v14.25" /></svg>
                             <span class="text-sm font-medium">Aprende en SIBIPN</span>
                           </x-button.secondary>
                          <x-button.secondary href="/comunidad" class="w-full !justify-start !p-3 !bg-gray-700/50 hover:!bg-gray-700/80 !border-transparent !text-ipn-gray-light hover:!text-white !shadow-none hover:!scale-100 group">
                             <svg class="h-5 w-5 text-ipn-guinda mr-3 group-hover:text-ipn-guinda-desat" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                             <span class="text-sm font-medium">Comunidad SIBIPN</span>
                           </x-button.secondary>
                      </div>
                 </div>

            </div> {{-- Fin Columna Lateral --}}

        </div> {{-- Fin Grid Principal --}}

    </div> {{-- Fin Container --}}
</div> {{-- Fin Div Fondo --}}
@endsection
