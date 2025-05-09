{{-- resources/views/admin/roles/index.blade.php --}}
@extends('layouts.admin') {{-- Asegúrate que este layout exista y funcione --}}

@section('title', 'Gestión de Roles y Permisos - Admin SIBIPN')

@section('content')
<div class="text-ipn-gray-lighten"> {{-- Asume que el layout aplica el fondo oscuro general --}}

    {{-- Encabezado --}}
    <div class="mb-8">
        <h1 class="text-3xl lg:text-4xl font-teko font-bold text-white">Gestión de Roles y Permisos</h1>
        <p class="text-ipn-gray-lighten/90 mt-1">
            Los roles administrativos son predefinidos. Aquí puedes editar los permisos asociados a cada rol.
        </p>
        {{-- No hay botón de "Crear Rol" según la regla de negocio --}}
    </div>

    {{-- *** INICIO: Bloques de Mensajes Flash *** --}}
    {{-- Mensaje de éxito --}}
    @if (session('success'))
        <div class="bg-green-900/20 border border-green-500/30 text-green-200 px-4 py-3 rounded-lg relative mb-6 text-sm" role="alert">
            <strong class="font-bold">¡Éxito!</strong>
            <span class="block sm:inline ml-1">{{ session('success') }}</span>
            {{-- Botón opcional para cerrar el mensaje --}}
            <button type="button" class="absolute top-0 bottom-0 right-0 px-4 py-3" onclick="this.parentElement.style.display='none';">
                <svg class="fill-current h-5 w-5 text-green-300/70 hover:text-green-200" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><title>Cerrar</title><path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z"/></svg>
            </button>
        </div>
    @endif
    {{-- Mensaje de advertencia --}}
     @if (session('warning'))
         <div class="bg-yellow-900/20 border border-yellow-500/30 text-yellow-200 px-4 py-3 rounded-lg relative mb-6 text-sm" role="alert">
            <strong class="font-bold">Advertencia:</strong>
            <span class="block sm:inline ml-1">{{ session('warning') }}</span>
             <button type="button" class="absolute top-0 bottom-0 right-0 px-4 py-3" onclick="this.parentElement.style.display='none';">
                <svg class="fill-current h-5 w-5 text-yellow-300/70 hover:text-yellow-200" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><title>Cerrar</title><path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z"/></svg>
            </button>
        </div>
    @endif
    {{-- Mensaje de error --}}
     @if (session('error'))
         <div class="bg-red-900/20 border border-red-500/30 text-red-200 px-4 py-3 rounded-lg relative mb-6 text-sm" role="alert">
            <strong class="font-bold">Error:</strong>
            <span class="block sm:inline ml-1">{{ session('error') }}</span>
             <button type="button" class="absolute top-0 bottom-0 right-0 px-4 py-3" onclick="this.parentElement.style.display='none';">
                <svg class="fill-current h-5 w-5 text-red-300/70 hover:text-red-200" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><title>Cerrar</title><path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z"/></svg>
            </button>
        </div>
    @endif
    {{-- *** FIN: Bloques de Mensajes Flash *** --}}


    {{-- Contenedor Principal Glassmorphism - **Quitado padding extra, añadido overflow-hidden** --}}
    <div class="bg-white/5 backdrop-blur-lg rounded-xl shadow-lg border border-white/10 overflow-hidden">
        {{-- **Añadido div para scroll si es necesario** --}}
        <div class="overflow-x-auto">
            {{-- Tabla de Roles --}}
            <table class="min-w-full divide-y divide-white/10">
                {{-- **Thead con estilo de fondo como en users/index** --}}
                <thead class="bg-white/5">
                    <tr>
                        {{-- **Th con clases de users/index** --}}
                        <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-ipn-gray-lighten uppercase tracking-wider">Nombre del Rol</th>
                        <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-ipn-gray-lighten uppercase tracking-wider">Descripción</th>
                        {{-- Añadido conteo de usuarios --}}
                        <th scope="col" class="px-4 py-3 text-center text-xs font-medium text-ipn-gray-lighten uppercase tracking-wider">Usuarios</th>
                        <th scope="col" class="relative px-4 py-3 text-right text-xs font-medium text-ipn-gray-lighten uppercase tracking-wider"> {{-- Ajustado text-right --}}
                            <span class="sr-only">Acciones</span>
                            Acciones
                        </th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-white/5">
                    @forelse ($roles as $rol)
                        {{-- **Tr con hover como en users/index** --}}
                        <tr class="hover:bg-white/5 transition-colors duration-150">
                            {{-- **Td con padding y estilo base de users/index** --}}
                            <td class="px-4 py-3 whitespace-nowrap text-sm font-medium text-white">{{ $rol->nombreRol }}</td>
                            {{-- Descripción: ajustado padding, mantenido whitespace-normal --}}
                            <td class="px-4 py-3 whitespace-normal text-sm text-ipn-gray-lighten max-w-xs break-words">{{ $rol->descripcion ?? '-' }}</td>
                             {{-- Conteo de usuarios --}}
                             <td class="px-4 py-3 whitespace-nowrap text-center text-sm text-ipn-gray-lighten">{{ $rol->usuarios_count ?? 0 }}</td> {{-- Asume withCount('usuarios') en el controlador --}}
                            {{-- Acciones: ajustado padding y estilos base --}}
                            <td class="px-4 py-3 whitespace-nowrap text-right text-sm font-medium">
                                {{-- Enlace para Editar Permisos (estilo ya corregido) --}}
                                <a href="{{ route('admin.roles.edit', $rol->id) }}" class="text-ipn-gray-lighten hover:text-white font-medium hover:underline focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-ipn-guinda-dark focus:ring-white rounded">
                                    Editar Permisos<span class="sr-only">, {{ $rol->nombreRol }}</span>
                                </a>
                                {{-- No hay botón de Eliminar Rol según lógica actual --}}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            {{-- **Td con padding de users/index** --}}
                            <td colspan="4" class="px-4 py-12 text-center text-sm text-ipn-gray-lighten"> {{-- Ajustado colspan y padding/texto --}}
                                No se encontraron roles administrativos. Considera ejecutar los seeders.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div> {{-- Fin div overflow-x-auto --}}

        {{-- Paginación (Si se implementara) --}}
        {{-- @if ($roles instanceof \Illuminate\Contracts\Pagination\Paginator && $roles->hasPages())
             <div class="bg-white/5 px-4 py-3 border-t border-white/10 text-xs text-ipn-gray-lighten">
                 {{ $roles->links('vendor.pagination.tailwind-dark') }}
             </div>
         @endif --}}

    </div> {{-- Fin Contenedor Principal --}}
</div>
@endsection

