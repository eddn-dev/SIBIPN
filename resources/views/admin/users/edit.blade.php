{{-- resources/views/admin/users/edit.blade.php --}}
@extends('layouts.admin')

@section('title', 'Editar Usuario - Admin SIBIPN')

@section('content')
<div class="text-ipn-gray-lighten" x-data="userEditForm({ initialPassword: '' })"> {{-- AlpineJS para manejo de contraseña --}}

    {{-- Encabezado --}}
    <div class="mb-8">
        <h1 class="text-3xl lg:text-4xl font-teko font-bold text-white">Editar Usuario</h1>
        <p class="text-ipn-gray-lighten/90 mt-1">Modificando perfil de: <span class="font-semibold text-white">{{ $user->nombreCompleto }}</span></p>
        {{-- Mostrar si es Staff --}}
        @if($isStaff)
        <span class="inline-block bg-ipn-guinda text-white text-xs font-semibold px-2 py-0.5 rounded mt-2">USUARIO STAFF</span>
        @endif
    </div>

    {{-- Contenedor Principal Glassmorphism --}}
    <div class="bg-white/5 backdrop-blur-lg rounded-xl shadow-lg border border-white/10 p-6 sm:p-8">

        {{-- Formulario de Edición (con ID) --}}
        <form method="POST" action="{{ route('admin.users.update', $user) }}" id="update-user-form" class="space-y-6">
            @csrf
            @method('PUT')

            {{-- Sección de Información (Solo Lectura) --}}
            <div class="mb-8 border-b border-white/10 pb-6">
                <h3 class="text-lg font-semibold text-white mb-4">Información del Usuario</h3>
                <dl class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-x-6 gap-y-4">
                    {{-- Campos de solo lectura ... (sin cambios) --}}
                    <div><dt class="text-sm font-medium text-ipn-gray-lighten/70">Nombre Completo</dt><dd class="mt-1 text-sm text-white">{{ $user->nombreCompleto }}</dd></div>
                    <div><dt class="text-sm font-medium text-ipn-gray-lighten/70">Correo Electrónico</dt><dd class="mt-1 text-sm text-white">{{ $user->email }}</dd></div>
                    <div><dt class="text-sm font-medium text-ipn-gray-lighten/70">Boleta / No. Empleado</dt><dd class="mt-1 text-sm text-white">{{ $user->boleta }}</dd></div>
                    <div><dt class="text-sm font-medium text-ipn-gray-lighten/70">Categoría</dt><dd class="mt-1 text-sm text-white">{{ $user->categoriaUsuario }}</dd></div>
                    <div><dt class="text-sm font-medium text-ipn-gray-lighten/70">Unidad Académica</dt><dd class="mt-1 text-sm text-white">{{ $user->unidadAcademica->nombre ?? 'N/A' }}</dd></div>
                    <div><dt class="text-sm font-medium text-ipn-gray-lighten/70">Fecha de Registro</dt><dd class="mt-1 text-sm text-white">{{ $user->created_at->isoFormat('LLLL') }}</dd></div>
                    <div><dt class="text-sm font-medium text-ipn-gray-lighten/70">Email Verificado</dt><dd class="mt-1 text-sm text-white">@if($user->email_verified_at) Sí ({{ $user->email_verified_at->diffForHumans() }}) @else <span class="text-yellow-400">No</span> @endif</dd></div>
                     {{-- Mostrar Rol Actual (si tiene) --}}
                     @if($user->rol)
                     <div><dt class="text-sm font-medium text-ipn-gray-lighten/70">Rol Actual</dt><dd class="mt-1 text-sm text-white">{{ $user->rol->nombreRol }}</dd></div>
                     @endif
                     {{-- Mostrar Estado Actual --}}
                     <div><dt class="text-sm font-medium text-ipn-gray-lighten/70">Estado Actual</dt><dd class="mt-1 text-sm text-white">{{ $user->estadoUsuario }}</dd></div>
                </dl>
            </div>

            {{-- Sección de Edición Condicional --}}
            <div>
                 <h3 class="text-lg font-semibold text-white mb-4">Modificar Usuario</h3>
                 <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                    {{-- Rol Administrativo (Solo editable para Staff) --}}
                    @if($isStaff)
                        <div>
                            <label for="idRolAdmin" class="block text-sm font-medium text-ipn-gray-lighten mb-1">Asignar Rol Administrativo</label>
                            <select id="idRolAdmin" name="idRolAdmin" class="sib-input-admin @error('idRolAdmin') border-red-500 focus:ring-red-500 @enderror">
                                <option value="">-- Quitar Rol Administrativo --</option>
                                @foreach ($roles as $rol)
                                    <option value="{{ $rol->id }}" {{ old('idRolAdmin', $user->idRolAdmin) == $rol->id ? 'selected' : '' }}>
                                        {{ $rol->nombreRol }}
                                    </option>
                                @endforeach
                            </select>
                            @error('idRolAdmin')<p class="text-red-400 text-xs mt-1">{{ $message }}</p>@enderror
                            <p class="mt-1 text-xs text-ipn-gray-lighten/70">Selecciona el rol o déjalo en blanco para quitarlo.</p>
                        </div>
                    @else
                        {{-- No mostrar para usuarios públicos --}}
                    @endif

                    {{-- Estado del Usuario (Solo editable para Públicos) --}}
                    @if(!$isStaff)
                        <div>
                            <label for="estadoUsuario" class="block text-sm font-medium text-ipn-gray-lighten mb-1">Cambiar Estado de la Cuenta <span class="text-red-400">*</span></label>
                            @if(count($estadosPosibles) > 1)
                                <select id="estadoUsuario" name="estadoUsuario" required
                                        class="sib-input-admin @error('estadoUsuario') border-red-500 focus:ring-red-500 @enderror">
                                    @foreach ($estadosPosibles as $estado)
                                        <option value="{{ $estado }}" {{ old('estadoUsuario', $user->estadoUsuario) == $estado ? 'selected' : '' }}>
                                            {{ $estado }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('estadoUsuario')<p class="text-red-400 text-xs mt-1">{{ $message }}</p>@enderror
                                <p class="mt-1 text-xs text-ipn-gray-lighten/70">Selecciona el estado deseado.</p>
                            @else
                                <input type="text" disabled value="{{ $user->estadoUsuario }}" class="sib-input-admin"> {{-- Aplicar clase sib-input-admin también a deshabilitados --}}
                                @if(!$user->email_verified_at)
                                     <p class="mt-1 text-xs text-ipn-gray-lighten/70">El usuario debe confirmar su correo para activar la cuenta.</p>
                                @endif
                                <input type="hidden" name="estadoUsuario" value="{{ $user->estadoUsuario }}">
                            @endif
                        </div>
                    @else
                         {{-- No mostrar para usuarios staff --}}
                    @endif

                 </div> {{-- Fin grid --}}
            </div> {{-- Fin Sección Edición Condicional --}}

            {{-- Input oculto para la nueva contraseña (se llena con AlpineJS) --}}
            <input type="hidden" name="new_password" :value="generatedNewPassword">

        </form> {{-- Fin del formulario principal de actualización --}}


        {{-- Sección Generar Nueva Contraseña (Solo para Staff) --}}
        @if($isStaff)
        <div class="border-t border-white/10 pt-6 mt-6">
             <h3 class="text-lg font-semibold text-white mb-4">Generar Nueva Contraseña</h3>
             <p class="text-sm text-ipn-gray-lighten/80 mb-4">
                 Genera una nueva contraseña segura para este usuario staff. La contraseña actual no es necesaria.
                 <strong class="text-yellow-400">Asegúrate de copiar la nueva contraseña antes de guardar los cambios del formulario principal.</strong>
             </p>
             <div class="flex flex-col sm:flex-row items-center gap-4">
                 {{-- Botón Generar --}}
                 {{-- ** CORRECCIÓN AQUÍ: Usar clase de componente btn-secondary ** --}}
                 <button type="button" @click="generateAndShowNewPassword(16)" class="btn-base btn-secondary">
                     Generar Contraseña
                 </button>
                 {{-- Campo Display Contraseña --}}
                 <div class="relative w-full">
                     <input type="text" id="generated_new_password_display" x-model="generatedNewPassword" readonly
                            placeholder="Aquí aparecerá la nueva contraseña..."
                            class="sib-input-admin font-mono !text-yellow-300 !bg-black/20 pr-10 w-full">
                      {{-- Botón Copiar (aparece si hay contraseña) --}}
                     <button type="button" x-show="generatedNewPassword" @click="copyNewPassword" title="Copiar contraseña" class="absolute inset-y-0 right-0 flex items-center pr-3 text-gray-400 hover:text-white">
                         {{-- Icono Copiar --}}
                         <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 17.25v3.375c0 .621-.504 1.125-1.125 1.125h-9.75a1.125 1.125 0 0 1-1.125-1.125V7.875c0-.621.504-1.125 1.125-1.125H6.75a9.06 9.06 0 0 1 1.5.124m7.5 10.376h3.375c.621 0 1.125-.504 1.125-1.125V11.25c0-4.46-3.243-8.161-7.5-8.876a9.06 9.06 0 0 0-1.5-.124H9.375c-.621 0-1.125.504-1.125 1.125v3.5m7.5 10.375H9.375a1.125 1.125 0 0 1-1.125-1.125v-9.25m9.75 0h-3.375c-.621 0-1.125.504-1.125 1.125v6.125c0 .621.504 1.125 1.125 1.125h3.375c.621 0 1.125-.504 1.125-1.125V7.875c0-.621-.504-1.125-1.125-1.125Z" /></svg>
                     </button>
                 </div>
             </div>
             <p class="mt-2 text-xs text-ipn-gray-lighten/70" x-show="copySuccessMsg" x-transition>¡Contraseña copiada!</p>
             <p class="mt-2 text-xs text-red-400" x-show="copyErrorMsg" x-transition>Error al copiar.</p>
        </div>
        @endif

        {{-- Sección de Botones de Acción (Fuera del form de update) --}}
        <div class="flex flex-col sm:flex-row items-center justify-between pt-6 border-t border-white/10 mt-8">
            {{-- Botón Eliminar (En su propio formulario) --}}
            <div>
                @can('eliminar-usuarios')
                    <form method="POST" action="{{ route('admin.users.destroy', $user) }}" onsubmit="return confirm('¿Estás seguro de que deseas eliminar a este usuario? Esta acción no se puede deshacer.');">
                        @csrf
                        @method('DELETE')
                        {{-- ** CORRECCIÓN AQUÍ: Usar clase de componente btn-danger ** --}}
                        <button type="submit" class="btn-base btn-danger"
                                {{ Auth::id() === $user->id ? 'disabled' : '' }} >
                            Eliminar Usuario
                        </button>
                         @if(Auth::id() === $user->id)
                             <p class="text-xs text-red-400 mt-1">No puedes eliminar tu propia cuenta.</p>
                         @endif
                    </form>
                @endcan
            </div>

            {{-- Botones Guardar y Cancelar --}}
            <div class="flex items-center space-x-4 mt-4 sm:mt-0">
                 {{-- ** CORRECCIÓN AQUÍ: Usar clase de componente btn-secondary para el enlace Cancelar ** --}}
                <a href="{{ route('admin.users.index') }}" class="btn-base btn-secondary">
                    Cancelar
                </a>
                {{-- Botón Guardar usa clases correctas --}}
                <button type="submit" form="update-user-form" class="btn-base btn-auth-primary">
                    Guardar Cambios
                </button>
            </div>
        </div>

    </div> {{-- Fin Contenedor Principal Glassmorphism --}}

</div> {{-- Fin AlpineJS x-data --}}

{{-- Script AlpineJS para esta vista --}}
@push('scripts')
<script>
    function userEditForm(config) {
        return {
            generatedNewPassword: config.initialPassword || '',
            copySuccessMsg: false,
            copyErrorMsg: false,

            generateAndShowNewPassword(length = 16) {
                const chars = 'abcdefghijkmnopqrstuvwxyzABCDEFGHJKLMNPQRSTUVWXYZ23456789!@#$%^&*()_+~`-=';
                let password = '';
                for (let i = 0; i < length; i++) {
                    password += chars.charAt(Math.floor(Math.random() * chars.length));
                }
                this.generatedNewPassword = password;
                this.copySuccessMsg = false;
                this.copyErrorMsg = false;
                const hiddenInput = document.querySelector('input[name="new_password"]');
                if (hiddenInput) {
                    hiddenInput.value = this.generatedNewPassword;
                }
            },

            copyNewPassword() {
                if (!this.generatedNewPassword) return;
                navigator.clipboard.writeText(this.generatedNewPassword).then(() => {
                    this.copySuccessMsg = true;
                    this.copyErrorMsg = false;
                    setTimeout(() => this.copySuccessMsg = false, 2000);
                }).catch(err => {
                    console.error('Error al copiar la contraseña: ', err);
                    this.copyErrorMsg = true;
                    this.copySuccessMsg = false;
                     setTimeout(() => this.copyErrorMsg = false, 3000);
                });
            }
        }
    }
</script>
@endpush

@endsection
