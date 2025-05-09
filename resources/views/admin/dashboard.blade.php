{{-- resources/views/admin/dashboard.blade.php --}}
@extends('layouts.admin')

@section('title', 'Admin Dashboard - SIBIPN')

@section('content')
{{-- El fondo con imagen y blur ahora viene del layout --}}
<div class="text-ipn-gray-lighten">

    {{-- Encabezado del Dashboard --}}
    <div class="mb-10">
        {{-- Saludo y Título --}}
        <h1 class="text-3xl lg:text-4xl font-teko font-bold text-white">
            Bienvenido al Panel de Administración, {{ Auth::user()->nombre ?? 'Admin' }}!
        </h1>
        <p class="text-ipn-gray-lighten/90 mt-1">Resumen general y accesos rápidos del sistema SIBIPN.</p>
    </div>

    {{-- Sección de Estadísticas Clave (Mejorada) --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-12">

        {{-- Tarjeta Glass: Total Usuarios --}}
        <a href="{{ route('admin.users.index') }}" class="block bg-white/5 backdrop-blur-lg rounded-xl shadow-lg border border-white/10 p-5 group hover:bg-white/10 transition-colors duration-200">
            <div class="flex items-center space-x-4">
                <div class="flex-shrink-0 text-ipn-gray-lighten/80 p-2">
                    <svg class="h-7 w-7" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 0 0 2.625.372m-10.75 0a9.38 9.38 0 0 1 2.625-.372M12 11.25a5.25 5.25 0 0 1-5.25-.372M12 11.25a5.25 5.25 0 0 0 5.25-.372M12 11.25v9.75M12 11.25a5.25 5.25 0 0 1 5.25-.372M12 11.25a5.25 5.25 0 0 0-5.25-.372M12 11.25v9.75m0-9.75a5.25 5.25 0 0 0-5.25-.372M12 11.25a5.25 5.25 0 0 1 5.25-.372M12 11.25v9.75M7.875 15a9.375 9.375 0 0 0 8.25 0M12 21a9.375 9.375 0 0 0-8.25-6m16.5 0a9.375 9.375 0 0 0-8.25 6M12 3.75a3.75 3.75 0 0 0-3.75 3.75v1.125a3.75 3.75 0 0 0 3.75 3.75m0-8.625a3.75 3.75 0 0 1 3.75 3.75v1.125a3.75 3.75 0 0 1-3.75 3.75m0-8.625v8.625" /></svg>
                </div>
                <div>
                    <p class="text-xs font-medium text-ipn-gray-lighten/70 uppercase tracking-wider">Total Usuarios</p>
                    <p class="text-2xl font-semibold text-white">--</p>
                </div>
            </div>
            {{-- Indicador de tendencia (Placeholder) --}}
            <p class="text-xs text-green-400 mt-1">+5% vs mes anterior</p>
        </a>

        {{-- Tarjeta Glass: Roles Definidos --}}
        <a href="{{ route('admin.roles.index') }}" class="block bg-white/5 backdrop-blur-lg rounded-xl shadow-lg border border-white/10 p-5 group hover:bg-white/10 transition-colors duration-200">
             <div class="flex items-center space-x-4">
                 <div class="flex-shrink-0 text-ipn-gray-lighten/80 p-2">
                    <svg class="h-7 w-7" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" /></svg>
                 </div>
                 <div>
                    <p class="text-xs font-medium text-ipn-gray-lighten/70 uppercase tracking-wider">Roles Admin</p>
                    <p class="text-2xl font-semibold text-white">--</p>
                </div>
            </div>
             {{-- No necesita tendencia usualmente --}}
             <p class="text-xs text-gray-500 mt-1 invisible">Placeholder</p> {{-- Para alinear altura --}}
        </a>

        {{-- Tarjeta Glass: Préstamos Activos --}}
         <div class="bg-white/5 backdrop-blur-lg rounded-xl shadow-lg border border-white/10 p-5 flex items-center space-x-4"> {{-- No es un enlace directo --}}
             <div class="flex-shrink-0 text-ipn-gray-lighten/80 p-2">
                <svg class="h-7 w-7" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 0 0 6 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 0 1 6 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 0 1 6-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0 0 18 18a8.967 8.967 0 0 0-6 2.292m0-14.25v14.25" /></svg>
             </div>
             <div>
                <p class="text-xs font-medium text-ipn-gray-lighten/70 uppercase tracking-wider">Préstamos Activos</p>
                <p class="text-2xl font-semibold text-white">--</p>
            </div>
        </div>

        {{-- Tarjeta Glass: Nuevos Registros (Hoy) --}}
         <div class="bg-white/5 backdrop-blur-lg rounded-xl shadow-lg border border-white/10 p-5 flex items-center space-x-4"> {{-- No es un enlace directo --}}
             <div class="flex-shrink-0 text-ipn-gray-lighten/80 p-2">
                 <svg class="h-7 w-7" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M19 7.5v3m0 0v3m0-3h3m-3 0h-3m-2.25-4.125a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0ZM3 19.235v-.11a6.375 6.375 0 0 1 12.75 0v.109A12.318 12.318 0 0 1 9.374 21c-2.331 0-4.512-.645-6.374-1.766Z" /></svg>
             </div>
             <div>
                <p class="text-xs font-medium text-ipn-gray-lighten/70 uppercase tracking-wider">Nuevos Registros</p>
                <p class="text-2xl font-semibold text-white">--</p>
            </div>
        </div>
    </div>

    {{-- Layout Principal (2 columnas: Acciones/Actividad + Accesos Rápidos) --}}
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

        {{-- Columna Principal (2/3) --}}
        <div class="lg:col-span-2 space-y-8">

            {{-- NUEVO: Sección Tareas Pendientes --}}
            <section class="bg-white/5 backdrop-blur-lg p-6 rounded-xl shadow-lg border border-white/10">
                <h2 class="text-xl font-roboto font-semibold text-white mb-4">Tareas Pendientes</h2>
                <div class="space-y-3">
                    {{-- Placeholder Tarea 1 --}}
                    <div class="flex items-center justify-between bg-white/5 p-3 rounded-md border border-white/10 hover:bg-white/10">
                        <div class="flex items-center space-x-3">
                             <svg class="h-5 w-5 text-yellow-400 flex-shrink-0" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M14.857 17.082a23.848 23.848 0 0 0 5.454-1.31A8.967 8.967 0 0 1 18 9.75V9A6 6 0 0 0 6 9v.75a8.967 8.967 0 0 1-2.312 6.022c1.733.64 3.56 1.017 5.455 1.31m5.714 0a24.255 24.255 0 0 1-5.714 0m5.714 0a3 3 0 1 1-5.714 0" /></svg>
                             <p class="text-sm text-ipn-gray-lighten">3 Usuarios pendientes de verificación</p>
                        </div>
                        <a href="#" class="text-xs font-medium text-ipn-guinda-light hover:text-ipn-gray-lighten hover:underline">Gestionar &rarr;</a>
                    </div>
                     {{-- Placeholder Tarea 2 --}}
                    <div class="flex items-center justify-between bg-white/5 p-3 rounded-md border border-white/10 hover:bg-white/10">
                         <div class="flex items-center space-x-3">
                             <svg class="h-5 w-5 text-blue-400 flex-shrink-0" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M8.25 18.75a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m3 0h6m-9 0H3.375a1.125 1.125 0 0 1-1.125-1.125V14.25m17.25 4.5a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m3 0h1.125c.621 0 1.125-.504 1.125-1.125V14.25m-17.25 4.5V6.75a1.125 1.125 0 0 1 1.125-1.125h12.75c.621 0 1.125.504 1.125 1.125v9.75M3.75 6.75h16.5M3.75 6.75c0-1.125.9-2.025 2-2.025h10.5c1.1 0 2 .9 2 2.025v.105c0 .718-.375 1.375-.94 1.745l-4.25 2.75a.75.75 0 0 1-.82 0l-4.25-2.75A1.875 1.875 0 0 1 3.75 6.855V6.75Z" /></svg>
                             <p class="text-sm text-ipn-gray-lighten">1 Sugerencia de compra nueva</p>
                        </div>
                        <a href="#" class="text-xs font-medium text-ipn-guinda-light hover:text-ipn-gray-lighten hover:underline">Revisar &rarr;</a>
                    </div>
                    {{-- Más tareas placeholder... --}}
                </div>
            </section>

            {{-- NUEVO: Sección Actividad Reciente --}}
            <section class="bg-white/5 backdrop-blur-lg p-6 rounded-xl shadow-lg border border-white/10">
                <h2 class="text-xl font-roboto font-semibold text-white mb-4">Actividad Reciente</h2>
                <ul class="space-y-4">
                    {{-- Placeholder Actividad 1 --}}
                    <li class="flex items-start space-x-3">
                        <div class="flex-shrink-0 w-5 h-5 mt-0.5 text-green-400">
                             <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M19 7.5v3m0 0v3m0-3h3m-3 0h-3m-2.25-4.125a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0ZM3 19.235v-.11a6.375 6.375 0 0 1 12.75 0v.109A12.318 12.318 0 0 1 9.374 21c-2.331 0-4.512-.645-6.374-1.766Z" /></svg>
                        </div>
                        <p class="text-sm text-ipn-gray-lighten">
                            Nuevo usuario registrado: <span class="font-medium text-white">Ana García López</span> (AlumnoLicenciatura).
                            <span class="block text-xs text-gray-400">Hace 5 minutos</span>
                        </p>
                    </li>
                     {{-- Placeholder Actividad 2 --}}
                     <li class="flex items-start space-x-3">
                        <div class="flex-shrink-0 w-5 h-5 mt-0.5 text-blue-400">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 0 0 6 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 0 1 6 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 0 1 6-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0 0 18 18a8.967 8.967 0 0 0-6 2.292m0-14.25v14.25" /></svg>
                        </div>
                        <p class="text-sm text-ipn-gray-lighten">
                            Préstamo realizado: <span class="font-medium text-white">"Inteligencia Artificial Moderna"</span> por <span class="font-medium text-white">Juan Pérez</span>.
                            <span class="block text-xs text-gray-400">Hace 1 hora</span>
                        </p>
                    </li>
                     {{-- Placeholder Actividad 3 --}}
                     <li class="flex items-start space-x-3">
                        <div class="flex-shrink-0 w-5 h-5 mt-0.5 text-purple-400">
                           <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M8.625 12a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm0 0H8.25m4.125 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm0 0H12m4.125 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm0 0h-.375M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" /></svg>
                        </div>
                        <p class="text-sm text-ipn-gray-lighten">
                            Nuevo post en foro: <span class="font-medium text-white">"Dudas sobre Préstamo Interbibliotecario"</span>.
                             <span class="block text-xs text-gray-400">Hace 2 horas</span>
                        </p>
                    </li>
                </ul>
                 <div class="mt-5 text-right">
                    <a href="#" class="text-xs font-medium text-ipn-guinda-light hover:text-ipn-gray-lighten hover:underline">Ver toda la actividad &rarr;</a>
                </div>
            </section>

        </div>

        {{-- Columna Lateral (1/3) --}}
        <div class="lg:col-span-1 space-y-8">

            {{-- Sección Accesos Rápidos (Mejorada) --}}
            <div class="bg-white/5 backdrop-blur-lg p-6 rounded-xl shadow-lg border border-white/10">
                <h3 class="text-lg font-roboto font-semibold text-white mb-4">Accesos Rápidos</h3>
                <div class="grid grid-cols-2 gap-4">
                    {{-- Enlace Glass: Gestionar Usuarios --}}
                    <a href="{{ route('admin.users.index') }}" class="flex flex-col items-center justify-center bg-white/5 backdrop-blur-lg rounded-lg shadow-md hover:shadow-lg border border-white/10 p-4 text-center group transition-all duration-200 hover:bg-white/10 hover:border-white/20 aspect-square">
                        <div class="text-ipn-guinda-light group-hover:text-ipn-gray-lighten transition-colors w-8 h-8 mb-2">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 0 0 2.625.372m-10.75 0a9.38 9.38 0 0 1 2.625-.372M12 11.25a5.25 5.25 0 0 1-5.25-.372M12 11.25a5.25 5.25 0 0 0 5.25-.372M12 11.25v9.75M12 11.25a5.25 5.25 0 0 1 5.25-.372M12 11.25a5.25 5.25 0 0 0-5.25-.372M12 11.25v9.75m0-9.75a5.25 5.25 0 0 0-5.25-.372M12 11.25a5.25 5.25 0 0 1 5.25-.372M12 11.25v9.75M7.875 15a9.375 9.375 0 0 0 8.25 0M12 21a9.375 9.375 0 0 0-8.25-6m16.5 0a9.375 9.375 0 0 0-8.25 6M12 3.75a3.75 3.75 0 0 0-3.75 3.75v1.125a3.75 3.75 0 0 0 3.75 3.75m0-8.625a3.75 3.75 0 0 1 3.75 3.75v1.125a3.75 3.75 0 0 1-3.75 3.75m0-8.625v8.625" /></svg>
                        </div>
                        <p class="text-xs font-semibold text-ipn-gray-lighten group-hover:text-white transition-colors">Usuarios</p>
                    </a>
                     {{-- Enlace Glass: Gestionar Roles --}}
                    <a href="{{ route('admin.roles.index') }}" class="flex flex-col items-center justify-center bg-white/5 backdrop-blur-lg rounded-lg shadow-md hover:shadow-lg border border-white/10 p-4 text-center group transition-all duration-200 hover:bg-white/10 hover:border-white/20 aspect-square">
                        <div class="text-ipn-guinda-light group-hover:text-ipn-gray-lighten transition-colors w-8 h-8 mb-2">
                             <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" /></svg>
                        </div>
                        <p class="text-xs font-semibold text-ipn-gray-lighten group-hover:text-white transition-colors">Roles</p>
                    </a>
                     {{-- Enlace Glass: Configuración --}}
                    <a href="{{ route('admin.settings.edit') }}" class="flex flex-col items-center justify-center bg-white/5 backdrop-blur-lg rounded-lg shadow-md hover:shadow-lg border border-white/10 p-4 text-center group transition-all duration-200 hover:bg-white/10 hover:border-white/20 aspect-square">
                        <div class="text-ipn-guinda-light group-hover:text-ipn-gray-lighten transition-colors w-8 h-8 mb-2">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M10.343 3.94c.09-.542.56-.94 1.11-.94h1.093c.55 0 1.02.398 1.11.94l.149.894c.07.424.384.764.78.93.398.164.855.142 1.205-.108l.737-.527c.48-.342 1.12-.301 1.54.117l.732.732c.42.42.46.97.117 1.54l-.527.737c-.25.35-.272.806-.108 1.204.165.397.505.71.93.78l.893.15c.543.09.94.56.94 1.11v1.093c0 .55-.397 1.02-.94 1.11l-.893.15c-.425.07-.765.383-.93.78-.164.398-.142.854.108 1.204l.527.738c.342.48.302 1.12-.118 1.54l-.732.732c-.42-.42-.97.46-1.54.117l-.737-.527c-.35-.25-.806-.272-1.204-.108-.397.165-.71.505-.78.93l-.15.893c-.09.543-.56.94-1.11.94h-1.093c-.55 0-1.02-.397-1.11-.94l-.149-.893c-.07-.424-.384-.765-.78-.93-.398-.165-.854-.142-1.205.108l-.738.527c-.48.343-1.12.302-1.54-.118l-.732-.732c-.42-.42-.46-.97-.117-1.54l.527-.738c.25-.35.273-.806.108-1.204-.165-.397-.506-.71-.93-.78l-.894-.15c-.542-.09-.94-.56-.94-1.11v-1.093c0-.55.398-1.02.94-1.11l.894-.15c.424-.07.765-.383.93-.78.165-.398.142-.854-.108-1.204l-.527-.738c-.343-.48-.302-1.12.117-1.54l.732-.732c.42-.42.97-.46 1.54-.117l.737.527c.35.25.807.272 1.204.108.397-.165.71-.505-.78.93l.15-.893Z" /><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" /></svg>
                        </div>
                        <p class="text-xs font-semibold text-ipn-gray-lighten group-hover:text-white transition-colors">Configuración</p>
                    </a>
                    {{-- Enlace Glass: Reportes --}}
                    <a href="#" {{-- route('admin.reports.index') --}}
                       class="flex flex-col items-center justify-center bg-white/5 backdrop-blur-lg rounded-lg shadow-md hover:shadow-lg border border-white/10 p-4 text-center group transition-all duration-200 hover:bg-white/10 hover:border-white/20 aspect-square">
                        <div class="text-ipn-guinda-light group-hover:text-ipn-gray-lighten transition-colors w-8 h-8 mb-2">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 3v11.25A2.25 2.25 0 0 0 6 16.5h2.25M3.75 3h-1.5m1.5 0h16.5m0 0h1.5m-1.5 0v11.25A2.25 2.25 0 0 1 18 16.5h-2.25m-7.5 0h7.5m-7.5 0-1 3m8.5-3 1 3m0 0 .5 1.5m-.5-1.5h-9.5m0 0-.5 1.5M6 11.25h1.5m8.25-1.5V3.75M6 11.25a1.5 1.5 0 0 1-1.5-1.5V3.75a1.5 1.5 0 0 1 1.5-1.5h1.5" /></svg>
                        </div>
                        <p class="text-xs font-semibold text-ipn-gray-lighten group-hover:text-white transition-colors">Reportes</p>
                    </a>
                    {{-- Añade más accesos rápidos --}}
                </div>
            </div>

        </div> {{-- Fin Columna Lateral --}}

    </div> {{-- Fin Grid Principal --}}

</div> {{-- Fin Contenedor Dashboard --}}
@endsection

