{{-- resources/views/admin/users/index.blade.php --}}
@extends('layouts.admin')

@section('title', 'Gestionar Usuarios - Admin SIBIPN')

@section('content')
<div class="text-ipn-gray-lighten">

{{-- Encabezado y Botón Crear --}}
    <div class="flex flex-col sm:flex-row justify-between items-start mb-6">
        <div>
            <h1 class="text-3xl lg:text-4xl font-teko font-bold text-white">Gestionar Usuarios</h1>
            <p class="text-ipn-gray-lighten/90 mt-1">Ver, editar y gestionar usuarios del sistema.</p>
        </div>
        {{-- Botón Crear Usuario --}}
        @can('gestionar-usuarios') {{-- O 'crear-usuarios' --}}
            <a href="{{ route('admin.users.create') }}" class="btn-primary mt-4 sm:mt-0 whitespace-nowrap inline-flex items-center">
               <svg class="h-5 w-5 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" /></svg>
               Crear Usuario
            </a>
        @endcan
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


    {{-- Controles de Búsqueda y Filtro --}}
    <div class="mb-6 bg-white/5 backdrop-blur-lg rounded-xl shadow-lg border border-white/10 p-4">
        <form action="{{ route('admin.users.index') }}" method="GET" id="filter-form"> {{-- Añadido ID al form --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-4 items-end"> {{-- items-end para alinear botones --}}
                {{-- Búsqueda --}}
                <div class="sm:col-span-2 md:col-span-3 lg:col-span-2">
                    <label for="search" class="sr-only">Buscar</label>
                    <input type="search" name="search" id="search"
                           value="{{ request('search') }}"
                           placeholder="Buscar por nombre, email, boleta..."
                           class="sib-input-admin text-sm w-full">
                </div>
                {{-- Filtro Rol --}}
                <div>
                    <label for="role" class="sr-only">Filtrar por Rol</label>
                    <select name="role" id="role" class="sib-input-admin text-sm w-full">
                        <option value="">-- Rol Admin --</option>
                        {{-- Itera sobre los roles pasados desde el controller --}}
                        @foreach($roles as $id => $nombreRol)
                            <option value="{{ $id }}" {{ request('role') == $id ? 'selected' : '' }}>
                                {{ $nombreRol }}
                            </option>
                        @endforeach
                        <option value="null" {{ request('role') === 'null' ? 'selected' : '' }}>Sin Rol Asignado</option>
                    </select>
                </div>
                 {{-- Filtro Estado --}}
                 <div>
                    <label for="status" class="sr-only">Filtrar por Estado</label>
                    <select name="status" id="status" class="sib-input-admin text-sm w-full">
                        <option value="">-- Estado --</option>
                         {{-- Itera sobre los estados posibles --}}
                         @foreach($estadosPosibles as $estado)
                             <option value="{{ $estado }}" {{ request('status') == $estado ? 'selected' : '' }}>
                                 {{ $estado }}
                             </option>
                         @endforeach
                    </select>
                </div>
                {{-- Filtro Categoría --}}
                <div>
                    <label for="category" class="sr-only">Filtrar por Categoría</label>
                    <select name="category" id="category" class="sib-input-admin text-sm w-full">
                        <option value="">-- Categoría Usuario --</option>
                         {{-- Itera sobre las categorías posibles --}}
                         @foreach($categoriasPosibles as $categoria)
                            @php
                                $labelCategoria = match($categoria) {
                                    'AlumnoBachillerato' => 'Bachillerato',
                                    'AlumnoLicenciatura' => 'Licenciatura',
                                    'AlumnoPosgrado' => 'Posgrado',
                                    default => $categoria,
                                };
                            @endphp
                             <option value="{{ $categoria }}" {{ request('category') == $categoria ? 'selected' : '' }}>
                                 {{ $labelCategoria }}
                             </option>
                         @endforeach
                    </select>
                </div>
                 {{-- Filtro Unidad Académica --}}
                 <div>
                    <label for="unit" class="sr-only">Filtrar por Unidad</label>
                    <select name="unit" id="unit" class="sib-input-admin text-sm w-full">
                        <option value="">-- Unidad Académica --</option>
                        {{-- Itera sobre las unidades pasadas desde el controller --}}
                        @foreach($unidadesAcademicas as $idUnidad => $nombreUnidad)
                             <option value="{{ $idUnidad }}" {{ request('unit') == $idUnidad ? 'selected' : '' }}>
                                 {{ $nombreUnidad }}
                             </option>
                        @endforeach
                    </select>
                </div>

                {{-- Botones Aplicar y Limpiar Filtros --}}
                 <div class="flex space-x-2">
                     <button type="submit" class="btn-secondary">Filtrar</button>
                     {{-- Botón para limpiar filtros (redirige a la misma ruta sin parámetros) --}}
                     <a href="{{ route('admin.users.index') }}" class="btn-danger">Limpiar</a>
                 </div>
            </div>
        </form>
    </div>

    {{-- Tabla de Usuarios (Contenedor Glassmorphism) --}}
    <div class="bg-white/5 backdrop-blur-lg rounded-xl shadow-lg border border-white/10 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-white/10">
                <thead class="bg-white/5">
                    <tr>
                        {{-- Headers --}}
                        <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-ipn-gray-lighten uppercase tracking-wider">Usuario / Identificador</th>
                        <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-ipn-gray-lighten uppercase tracking-wider">Contacto / Registro</th>
                        <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-ipn-gray-lighten uppercase tracking-wider">Perfil Académico</th>
                        <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-ipn-gray-lighten uppercase tracking-wider">Rol Admin</th>
                        <th scope="col" class="px-4 py-3 text-center text-xs font-medium text-ipn-gray-lighten uppercase tracking-wider">Estado</th>
                        <th scope="col" class="relative px-4 py-3"><span class="sr-only">Acciones</span></th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-white/5">
                    @forelse ($usuarios as $usuario)
                        {{-- Filas de la tabla --}}
                        <tr class="hover:bg-white/5 transition-colors duration-150">
                            <td class="px-4 py-3 whitespace-nowrap"><div class="text-sm font-medium text-white">{{ $usuario->nombreCompleto }}</div><div class="text-xs text-gray-400">Boleta: {{ $usuario->boleta }}</div></td>
                            <td class="px-4 py-3 whitespace-nowrap"><div class="text-sm text-ipn-gray-lighten">{{ $usuario->email }}</div><div class="text-xs text-gray-400">Reg: {{ $usuario->created_at->isoFormat('ll') }}</div></td>
                            <td class="px-4 py-3 whitespace-nowrap"><div class="text-sm text-ipn-gray-lighten">{{ $usuario->categoriaUsuario }}</div><div class="text-xs text-gray-400 truncate max-w-[200px]" title="{{ $usuario->unidadAcademica->nombre ?? '' }}">{{ $usuario->unidadAcademica->nombre ?? 'N/A' }}</div></td>
                            <td class="px-4 py-3 whitespace-nowrap text-sm text-ipn-gray-lighten">{{ $usuario->rol->nombreRol ?? '--' }}</td>
                            <td class="px-4 py-3 whitespace-nowrap text-center"><span @class(['px-2 inline-flex text-xs leading-5 font-semibold rounded-full', 'bg-green-400/10 text-green-300' => $usuario->estadoUsuario === 'Activo', 'bg-yellow-400/10 text-yellow-300' => $usuario->estadoUsuario === 'PendienteConfirmacion', 'bg-red-500/10 text-red-400' => $usuario->estadoUsuario === 'Suspendido', 'bg-gray-500/10 text-gray-400' => $usuario->estadoUsuario === 'Inactivo'])>{{ $usuario->estadoUsuario }}</span></td>
                            <td class="px-4 py-3 whitespace-nowrap text-right text-sm font-medium">
                                @can('asignar-roles-usuarios')
                                    <a href="{{ route('admin.users.edit', $usuario) }}" class="text-ipn-gray-lighten hover:text-white font-medium hover:underline focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-ipn-guinda-dark focus:ring-white rounded">Editar</a>
                                @endcan
                                {{-- Espacio para botón Eliminar (si se añade) --}}
                                {{-- @can('eliminar-usuarios')
                                    <form action="{{ route('admin.users.destroy', $usuario) }}" method="POST" class="inline-block ml-2" onsubmit="return confirm('...')"> @csrf @method('DELETE') <button type="submit" class="text-red-400 hover:text-red-300">Eliminar</button></form>
                                @endcan --}}
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="6" class="px-6 py-12 text-center text-ipn-gray">No se encontraron usuarios que coincidan con los criterios.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Paginación --}}
        @if ($usuarios->hasPages())
        <div class="bg-white/5 px-4 py-3 border-t border-white/10 text-xs text-ipn-gray-lighten">
             {{ $usuarios->appends(request()->query())->links('vendor.pagination.tailwind-dark') }}
        </div>
        @endif
    </div>

</div>

@endsection
