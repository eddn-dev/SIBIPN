{{-- resources/views/components/layout/aside-admin.blade.php --}}
{{-- Navegación principal del Sidebar con enlaces condicionales por permisos --}}

<nav class="flex-grow py-6 px-4 overflow-y-auto">
    <ul class="space-y-1">
        {{-- Dashboard: Requiere acceso general al panel --}}
        @can('acceder-panel-admin')
            <li>
                <a href="{{ route('admin.dashboard') }}" class="flex items-center px-3 py-2 rounded-md text-sm font-medium transition-colors duration-150 {{ request()->routeIs('admin.dashboard') ? 'bg-white/10 text-white' : 'text-ipn-gray-lighten hover:text-white hover:bg-white/5' }}">
                    {{-- Icono Dashboard --}}
                    <svg class="mr-3 h-5 w-5 flex-shrink-0" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6A2.25 2.25 0 0 1 6 3.75h2.25A2.25 2.25 0 0 1 10.5 6v2.25a2.25 2.25 0 0 1-2.25 2.25H6a2.25 2.25 0 0 1-2.25-2.25V6ZM3.75 15.75A2.25 2.25 0 0 1 6 13.5h2.25a2.25 2.25 0 0 1 2.25 2.25V18a2.25 2.25 0 0 1-2.25 2.25H6A2.25 2.25 0 0 1 3.75 18v-2.25ZM13.5 6a2.25 2.25 0 0 1 2.25-2.25H18A2.25 2.25 0 0 1 20.25 6v2.25A2.25 2.25 0 0 1 18 10.5h-2.25a2.25 2.25 0 0 1-2.25-2.25V6ZM13.5 15.75a2.25 2.25 0 0 1 2.25-2.25H18a2.25 2.25 0 0 1 2.25 2.25V18A2.25 2.25 0 0 1 18 20.25h-2.25A2.25 2.25 0 0 1 13.5 18v-2.25Z" /></svg>
                    Dashboard
                </a>
            </li>
        @endcan

        {{-- Separador --}}
        <li class="pt-2"><span class="px-3 text-xs font-semibold uppercase tracking-wider text-ipn-gray-lighten/60">Gestión General</span></li>

        {{-- Gestión de Usuarios: Requiere permiso 'ver-usuarios-basico' o 'gestionar-usuarios' --}}
        @canany(['ver-usuarios-basico', 'gestionar-usuarios'])
            <li>
                <a href="{{ route('admin.users.index') }}" class="flex items-center px-3 py-2 rounded-md text-sm font-medium transition-colors duration-150 {{ request()->routeIs('admin.users.*') ? 'bg-white/10 text-white' : 'text-ipn-gray-lighten hover:text-white hover:bg-white/5' }}">
                    {{-- Icono Usuarios --}}
                    <svg class="mr-3 h-5 w-5 flex-shrink-0" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 0 0 2.625.372m-10.75 0a9.38 9.38 0 0 1 2.625-.372M12 11.25a5.25 5.25 0 0 1-5.25-.372M12 11.25a5.25 5.25 0 0 0 5.25-.372M12 11.25v9.75M12 11.25a5.25 5.25 0 0 1 5.25-.372M12 11.25a5.25 5.25 0 0 0-5.25-.372M12 11.25v9.75m0-9.75a5.25 5.25 0 0 0-5.25-.372M12 11.25a5.25 5.25 0 0 1 5.25-.372M12 11.25v9.75M7.875 15a9.375 9.375 0 0 0 8.25 0M12 21a9.375 9.375 0 0 0-8.25-6m16.5 0a9.375 9.375 0 0 0-8.25 6M12 3.75a3.75 3.75 0 0 0-3.75 3.75v1.125a3.75 3.75 0 0 0 3.75 3.75m0-8.625a3.75 3.75 0 0 1 3.75 3.75v1.125a3.75 3.75 0 0 1-3.75 3.75m0-8.625v8.625" /></svg>
                    Usuarios
                </a>
            </li>
        @endcanany

        {{-- Gestión de Roles: Requiere permiso 'gestionar-roles' --}}
         @can('gestionar-roles')
             <li>
                 <a href="{{ route('admin.roles.index') }}" class="flex items-center px-3 py-2 rounded-md text-sm font-medium transition-colors duration-150 {{ request()->routeIs('admin.roles.*') ? 'bg-white/10 text-white' : 'text-ipn-gray-lighten hover:text-white hover:bg-white/5' }}">
                     {{-- Icono Roles --}}
                     <svg class="mr-3 h-5 w-5 flex-shrink-0" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M18 18.72a9.094 9.094 0 0 0 3.741-.479 3 3 0 0 0-4.682-2.72m.94 3.198.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0 1 12 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 0 1 6 18.719m12 0a5.971 5.971 0 0 0-.94-3.197m0 0A5.995 5.995 0 0 0 12 12.75a5.995 5.995 0 0 0-5.06-3.198M15 9.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" /></svg>
                     Roles y Permisos
                 </a>
             </li>
         @endcan

        {{-- Separador --}}
        <li class="pt-4"><span class="px-3 text-xs font-semibold uppercase tracking-wider text-ipn-gray-lighten/60">Módulos Biblioteca</span></li>

        {{-- Gestión Catálogo: Requiere algún permiso de catálogo --}}
        @canany(['gestionar-registros-bib', 'gestionar-items', 'gestionar-autoridades', 'participar-inventario', 'importar-exportar-registros-bib'])
            <li>
                {{-- Enlace a la sección principal del catálogo --}}
                <a href="{{ route('admin.catalog.index') }}" class="flex items-center px-3 py-2 rounded-md text-sm font-medium transition-colors duration-150 {{ request()->routeIs(['admin.catalog.*', 'admin.items.*', 'admin.authorities.*', 'admin.inventory.*']) ? 'bg-white/10 text-white' : 'text-ipn-gray-lighten hover:text-white hover:bg-white/5' }}">
                    {{-- Icono Catálogo --}}
                    <svg class="mr-3 h-5 w-5 flex-shrink-0" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 0 0 6 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 0 1 6 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 0 1 6-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0 0 18 18a8.967 8.967 0 0 0-6 2.292m0-14.25v14.25" /></svg>
                    Catálogo
                </a>
            </li>
            @can('gestionar-items')
                <li>
                    <a href="{{ route('admin.items.index') }}" class="flex items-center px-3 py-2 rounded-md text-sm font-medium transition-colors duration-150 {{ request()->routeIs('admin.items.*') ? 'bg-white/10 text-white' : 'text-ipn-gray-lighten hover:text-white hover:bg-white/5' }}">
                        {{-- Icono Items --}}
                        <svg class="mr-3 h-5 w-5 flex-shrink-0" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M19 5v14H5V5h14ZM5 7h14" /></svg>
                        Ejemplares
                    </a>
                </li>
            @endcan
        @endcanany

         {{-- Circulación: Requiere algún permiso de circulación --}}
         @canany(['realizar-prestamo', 'registrar-devolucion', 'realizar-renovacion', 'gestionar-reservas', 'registrar-prestamo-especial', 'gestionar-prestamo-interbib'])
             <li>
                 {{-- Enlace a la sección principal de circulación --}}
                 <a href="{{ route('admin.circulation.index') }}" class="flex items-center px-3 py-2 rounded-md text-sm font-medium transition-colors duration-150 {{ request()->routeIs(['admin.circulation.*', 'admin.loans.*', 'admin.holds.*', 'admin.interlibrary-loans.*']) ? 'bg-white/10 text-white' : 'text-ipn-gray-lighten hover:text-white hover:bg-white/5' }}">
                    {{-- Icono Circulación --}}
                    <svg class="mr-3 h-5 w-5 flex-shrink-0" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0 3.181 3.183a8.25 8.25 0 0 0 13.803-3.7M4.031 9.865a8.25 8.25 0 0 1 13.803-3.7l3.181 3.182m0-4.991v4.99" /></svg>
                    Circulación
                 </a>
             </li>
         @endcanany

        {{-- Multas y Tarifas: Requiere algún permiso de multas --}}
        @canany(['registrar-pago-multa', 'ver-multas-usuario', 'condonar-multa', 'registrar-multa-manual'])
            <li>
                <a href="{{ route('admin.fines.index') }}" class="flex items-center px-3 py-2 rounded-md text-sm font-medium transition-colors duration-150 {{ request()->routeIs('admin.fines.*') ? 'bg-white/10 text-white' : 'text-ipn-gray-lighten hover:text-white hover:bg-white/5' }}">
                    {{-- Icono Multas --}}
                    <svg class="mr-3 h-5 w-5 flex-shrink-0" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18.75a60.07 60.07 0 0 1 15.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 0 1 3 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125h-.375m1.5-1.5H21a.75.75 0 0 0-.75.75v.75m0 0H3.75m0 0h-.375a1.125 1.125 0 0 1-1.125-1.125V6.375m0 9.75v-.75a.75.75 0 0 0-.75-.75H2.25m9.75-12h.008v.008H12v-.008ZM12 15h.008v.008H12V15Zm0 2.25h.008v.008H12v-.008ZM9.75 15h.008v.008H9.75V15Zm0 2.25h.008v.008H9.75v-.008ZM7.5 15h.008v.008H7.5V15Zm0 2.25h.008v.008H7.5v-.008Zm6.75-4.5h.008v.008h-.008v-.008Zm0 2.25h.008v.008h-.008V15Zm0 2.25h.008v.008h-.008v-.008Zm2.25-4.5h.008v.008H16.5v-.008Zm0 2.25h.008v.008H16.5V15Z" /></svg>
                    Multas y Tarifas
                </a>
            </li>
        @endcanany

        {{-- Adquisiciones: Requiere algún permiso de adquisiciones --}}
        @canany(['gestionar-proveedores', 'gestionar-ordenes-compra', 'gestionar-presupuestos', 'registrar-recepcion-adq'])
            <li>
                {{-- *** ENLACE CORREGIDO *** --}}
                {{-- Enlace a la sección principal de adquisiciones (usando el nombre de ruta correcto) --}}
                <a href="{{ route('admin.vendors.index') }}" {{-- Usa admin.vendors.index --}}
                   class="flex items-center px-3 py-2 rounded-md text-sm font-medium transition-colors duration-150 {{ request()->routeIs(['admin.vendors.*', 'admin.orders.*', 'admin.budgets.*', 'admin.acquisitions.receiving.*']) ? 'bg-white/10 text-white' : 'text-ipn-gray-lighten hover:text-white hover:bg-white/5' }}">
                    {{-- Icono Adquisiciones --}}
                    <svg class="mr-3 h-5 w-5 flex-shrink-0" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 0 0-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 0 0-16.536-1.84M7.5 14.25 5.106 5.272M6 20.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Zm12.75 0a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Z" /></svg>
                    Adquisiciones
                </a>
            </li>
        @endcanany

        {{-- Donaciones: Requiere permiso 'gestionar-donaciones' --}}
        @can('gestionar-donaciones')
            <li>
                <a href="{{ route('admin.donations.index') }}" class="flex items-center px-3 py-2 rounded-md text-sm font-medium transition-colors duration-150 {{ request()->routeIs('admin.donations.*') ? 'bg-white/10 text-white' : 'text-ipn-gray-lighten hover:text-white hover:bg-white/5' }}">
                    {{-- Icono Donaciones --}}
                    <svg class="mr-3 h-5 w-5 flex-shrink-0" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M21 11.25v8.25a1.5 1.5 0 0 1-1.5 1.5H5.25a1.5 1.5 0 0 1-1.5-1.5v-8.25M12 4.875A3.375 3.375 0 0 0 12 8.25v3.75m0 0A3.375 3.375 0 0 0 15.375 12h.008v.008h-.008V12m-6.75 0h.008v.008h-.008V12m5.625 0A3.375 3.375 0 0 1 12 15.375v-1.5m0 0v1.5m0-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m3.75 9.75A3.375 3.375 0 0 1 12 18.375v-1.5m3.375 3.375h.008v.008h-.008v-.008Zm-3.375 0h.008v.008h-.008v-.008Zm-3.375 0h.008v.008h-.008v-.008Z" /></svg>
                    Donaciones
                </a>
            </li>
        @endcan

        {{-- Separador --}}
        <li class="pt-4"><span class="px-3 text-xs font-semibold uppercase tracking-wider text-ipn-gray-lighten/60">Plataforma</span></li>

        {{-- Formación: Requiere algún permiso de formación --}}
        @canany(['gestionar-contenido-formativo', 'gestionar-categorias-formativas', 'gestionar-eventos-formativos', 'gestionar-inscripciones-formacion', 'gestionar-evaluaciones-formacion', 'ver-progreso-formacion', 'emitir-certificados-formacion'])
            <li>
                {{-- Enlace a la sección principal de CMS/Formación --}}
                <a href="{{ route('admin.cms.contents.index') }}" {{-- Ejemplo: ir a contenidos por defecto --}}
                   class="flex items-center px-3 py-2 rounded-md text-sm font-medium transition-colors duration-150 {{ request()->routeIs('admin.cms.*') ? 'bg-white/10 text-white' : 'text-ipn-gray-lighten hover:text-white hover:bg-white/5' }}">
                    {{-- Icono Formación --}}
                    <svg class="mr-3 h-5 w-5 flex-shrink-0" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path d="M12 14l9-5-9-5-9 5 9 5z" /><path d="M12 14l6.16-3.422a12.083 12.083 0 0 1 .665 6.479A11.952 11.952 0 0 0 12 20.055a11.952 11.952 0 0 0-6.824-2.998 12.078 12.078 0 0 1 .665-6.479L12 14z" /><path stroke-linecap="round" stroke-linejoin="round" d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 0 1 .665 6.479A11.952 11.952 0 0 0 12 20.055a11.952 11.952 0 0 0-6.824-2.998 12.078 12.078 0 0 1 .665-6.479L12 14zm-4 6v-7.5l4-2.222" /></svg>
                    Formación (CMS)
                </a>
            </li>
        @endcanany

        {{-- Comunidad: Requiere algún permiso de comunidad --}}
        @canany(['gestionar-foros', 'moderar-posts-comunidad', 'gestionar-grupos-comunidad', 'gestionar-miembros-grupo-comunidad', 'atender-reportes-comunidad'])
            <li>
                 {{-- Enlace a la sección principal de Comunidad --}}
                <a href="{{ route('admin.community.forums.index') }}" {{-- Ejemplo: ir a foros por defecto --}}
                   class="flex items-center px-3 py-2 rounded-md text-sm font-medium transition-colors duration-150 {{ request()->routeIs('admin.community.*') ? 'bg-white/10 text-white' : 'text-ipn-gray-lighten hover:text-white hover:bg-white/5' }}">
                    {{-- Icono Comunidad --}}
                    <svg class="mr-3 h-5 w-5 flex-shrink-0" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M8.625 12a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm0 0H8.25m4.125 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm0 0H12m4.125 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm0 0h-.375M21 12c0 4.556-3.04 8.25-7.5 8.25S6 16.556 6 12c0-4.556 3.04-8.25 7.5-8.25S21 7.444 21 12Z" /></svg>
                    Comunidad
                </a>
            </li>
        @endcanany

        {{-- Reportes: Requiere permiso 'ver-reportes' --}}
        @can('ver-reportes')
            <li>
                <a href="{{ route('admin.reports.index') }}" class="flex items-center px-3 py-2 rounded-md text-sm font-medium transition-colors duration-150 {{ request()->routeIs('admin.reports.*') ? 'bg-white/10 text-white' : 'text-ipn-gray-lighten hover:text-white hover:bg-white/5' }}">
                    {{-- Icono Reportes --}}
                    <svg class="mr-3 h-5 w-5 flex-shrink-0" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 3v11.25A2.25 2.25 0 0 0 6 16.5h2.25M3.75 3h-1.5m1.5 0h16.5m0 0h1.5m-1.5 0v11.25A2.25 2.25 0 0 1 18 16.5h-2.25m-7.5 0h7.5m-7.5 0-1 3m8.5-3 1 3m0 0 .5 1.5m-.5-1.5h-9.5m0 0-.5 1.5M9 11.25v1.5M12 9v3.75m3-6v6" /></svg>
                    Reportes
                </a>
            </li>
        @endcan

        {{-- Configuración: Requiere permiso 'gestionar-configuracion-general' o específicos --}}
        @canany(['gestionar-configuracion-general', 'gestionar-bibliotecas', 'gestionar-politicas-circulacion', 'gestionar-ubicaciones', 'gestionar-parametros'])
            <li>
                 {{-- Enlace a la sección principal de Configuración --}}
                <a href="{{ route('admin.settings.index') }}" {{-- Apunta a la ruta index del grupo settings --}}
                   class="flex items-center px-3 py-2 rounded-md text-sm font-medium transition-colors duration-150 {{ request()->routeIs('admin.settings.*') ? 'bg-white/10 text-white' : 'text-ipn-gray-lighten hover:text-white hover:bg-white/5' }}">
                    {{-- Icono Configuración --}}
                    <svg class="mr-3 h-5 w-5 flex-shrink-0" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M10.343 3.94c.09-.542.56-.94 1.11-.94h1.093c.55 0 1.02.398 1.11.94l.149.894c.07.424.384.764.78.93.398.164.855.142 1.205-.108l.737-.527c.48-.342 1.12-.301 1.54.117l.732.732c.42.42.46.97.117 1.54l-.527.737c-.25.35-.272.806-.108 1.204.165.397.505.71.93.78l.893.15c.543.09.94.56.94 1.11v1.093c0 .55-.397 1.02-.94 1.11l-.893.15c-.425.07-.765.383-.93.78-.164.398-.142.854.108 1.204l.527.738c.342.48.302 1.12-.118 1.54l-.732.732c-.42-.42-.97.46-1.54.117l-.737-.527c-.35-.25-.806-.272-1.204-.108-.397.165-.71.505-.78.93l-.15.893c-.09.543-.56.94-1.11.94h-1.093c-.55 0-1.02-.397-1.11-.94l-.149-.893c-.07-.424-.384-.765-.78-.93-.398-.165-.854-.142-1.205.108l-.738.527c-.48.343-1.12.302-1.54-.118l-.732-.732c-.42-.42-.46-.97-.117-1.54l.527-.738c.25-.35.273-.806.108-1.204-.165-.397-.506-.71-.93-.78l-.894-.15c-.542-.09-.94-.56-.94-1.11v-1.093c0-.55.398-1.02.94-1.11l.894-.15c.424-.07.765-.383.93-.78.165-.398.142-.854-.108-1.204l-.527-.738c-.343-.48-.302-1.12.117-1.54l.732-.732c.42-.42.97-.46 1.54-.117l.737.527c.35.25.807.272 1.204.108.397-.165.71-.505-.78.93l.15-.893Z" /><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" /></svg>
                    Configuración
                </a>
            </li>
        @endcanany

    </ul>
</nav>
