{{-- resources/views/admin/roles/edit.blade.php --}}
@extends('layouts.admin') {{-- Asegúrate que este layout exista y funcione --}}

@section('title', 'Editar Permisos: ' . $role->nombreRol . ' - Admin SIBIPN')

@section('content')
<div class="text-ipn-gray-lighten"> {{-- Asume que el layout aplica el fondo oscuro general --}}

    {{-- Encabezado --}}
    <div class="mb-8">
        <h1 class="text-3xl lg:text-4xl font-teko font-bold text-white">Editar Permisos del Rol</h1>
        <p class="text-ipn-gray-lighten/90 mt-1">
            Modificando permisos para el rol: <span class="font-semibold text-white">{{ $role->nombreRol }}</span>
        </p>
        <p class="text-sm text-ipn-gray-lighten/70 mt-1">{{ $role->descripcion }}</p>
    </div>

    {{-- Formulario de Edición --}}
    <form method="POST" action="{{ route('admin.roles.update', $role->id) }}"> {{-- Usar $role->id para la ruta --}}
        @csrf
        @method('PUT')

        {{-- Contenedor Principal Glassmorphism --}}
        <div class="bg-white/5 backdrop-blur-lg rounded-xl shadow-lg border border-white/10 p-6 sm:p-8">

            {{-- Manejo de errores generales del formulario --}}
            @if ($errors->any())
                <div class="mb-6 bg-red-800/50 border border-red-700 text-red-200 px-4 py-3 rounded-lg relative" role="alert">
                    <strong class="font-bold">¡Error de Validación!</strong>
                    <ul class="mt-2 list-disc list-inside text-sm">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="absolute top-0 bottom-0 right-0 px-4 py-3" onclick="this.parentElement.style.display='none';">
                        <svg class="fill-current h-6 w-6 text-red-300" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><title>Cerrar</title><path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z"/></svg>
                    </button>
                </div>
            @endif

             {{-- Mensaje de éxito/advertencia de la sesión --}}
             @if (session('success'))
                <div class="mb-6 bg-green-800/50 border border-green-700 text-green-200 px-4 py-3 rounded-lg relative" role="alert">
                    {{ session('success') }}
                     <button type="button" class="absolute top-0 bottom-0 right-0 px-4 py-3" onclick="this.parentElement.style.display='none';">
                        <svg class="fill-current h-6 w-6 text-green-300" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><title>Cerrar</title><path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z"/></svg>
                    </button>
                </div>
            @endif
             @if (session('warning'))
                 <div class="mb-6 bg-yellow-800/50 border border-yellow-700 text-yellow-200 px-4 py-3 rounded-lg relative" role="alert">
                    {{ session('warning') }}
                     <button type="button" class="absolute top-0 bottom-0 right-0 px-4 py-3" onclick="this.parentElement.style.display='none';">
                        <svg class="fill-current h-6 w-6 text-yellow-300" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><title>Cerrar</title><path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z"/></svg>
                    </button>
                </div>
            @endif
             @if (session('error'))
                 <div class="mb-6 bg-red-800/50 border border-red-700 text-red-200 px-4 py-3 rounded-lg relative" role="alert">
                    {{ session('error') }}
                     <button type="button" class="absolute top-0 bottom-0 right-0 px-4 py-3" onclick="this.parentElement.style.display='none';">
                        <svg class="fill-current h-6 w-6 text-red-300" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><title>Cerrar</title><path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z"/></svg>
                    </button>
                </div>
            @endif

            {{-- Lógica Condicional Principal --}}
            @if($isSystemAdmin)
                {{-- Mensaje para el Rol Administrador del Sistema --}}
                <div class="bg-ipn-guinda/30 border border-ipn-guinda-light text-ipn-guinda-light px-4 py-3 rounded relative" role="alert">
                    <strong class="font-bold">Rol Protegido:</strong>
                    <span class="block sm:inline"> Los permisos del rol '{{ $role->nombreRol }}' no son editables. Este rol siempre tiene acceso completo (`*`).</span>
                </div>
            @else
                {{-- Mostrar Checkboxes de Permisos para otros roles --}}
                {{-- Iterar sobre los grupos de permisos --}}
                @forelse ($availablePermissionsGrouped as $groupName => $permissionsInGroup)
                    <fieldset class="mb-8 border-b border-white/10 pb-6 last:border-b-0 last:pb-0 last:mb-0">
                        <legend class="text-lg font-semibold text-white mb-4">{{ $groupName ?? 'Otros Permisos' }}</legend>
                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-x-6 gap-y-4">
                            {{-- Iterar sobre los permisos dentro del grupo --}}
                            @foreach ($permissionsInGroup as $permission)
                                <div class="relative flex items-start">
                                    <div class="flex h-6 items-center">
                                        {{-- *** CAMBIOS AQUÍ *** --}}
                                        <input id="perm_{{ $permission->id }}"
                                               name="permission_ids[]" {{-- Nombre del array para IDs --}}
                                               value="{{ $permission->id }}" {{-- Valor es el ID del permiso --}}
                                               type="checkbox"
                                               class="h-4 w-4 rounded border-gray-500 bg-white/10 text-ipn-oro focus:ring-ipn-oro focus:ring-offset-ipn-guinda-dark/50 cursor-pointer"
                                               {{-- Marcar si el ID del permiso está en el array de IDs asignados --}}
                                               @checked(in_array($permission->id, $assignedPermissionIds))>
                                    </div>
                                    <div class="ml-3 text-sm leading-6">
                                        <label for="perm_{{ $permission->id }}" class="font-medium text-white cursor-pointer">{{ $permission->name }}</label>
                                        @if($permission->description)
                                        <p class="text-ipn-gray-lighten/70 text-xs">{{ $permission->description }}</p>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </fieldset>
                @empty
                    <p class="text-center text-ipn-gray-lighten py-4">No hay permisos configurables definidos en el sistema (aparte del permiso global '*').</p>
                @endforelse
            @endif


            {{-- Botones de Acción --}}
            <div class="flex items-center justify-end space-x-4 pt-5 mt-6 {{ $isSystemAdmin ? '' : 'border-t border-white/10' }}">
                 {{-- Enlace Cancelar/Volver --}}
                <a href="{{ route('admin.roles.index') }}" class="btn-base btn-secondary">
                    {{ $isSystemAdmin ? 'Volver' : 'Cancelar' }}
                </a>
                 {{-- Botón Guardar --}}
                <button type="submit" class="btn-base btn-auth-primary" @if($isSystemAdmin) disabled title="Los permisos de este rol no se pueden modificar" @endif>
                    Guardar Permisos
                </button>
            </div>
            @if($isSystemAdmin)
            <p class="text-right text-xs text-yellow-400 mt-2">El rol '{{ $role->nombreRol }}' está protegido y no se puede modificar.</p>
            @endif

        </div> {{-- Fin Contenedor Principal --}}
    </form>

</div>
@endsection
