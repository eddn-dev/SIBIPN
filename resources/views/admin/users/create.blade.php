{{-- resources/views/admin/users/create.blade.php --}}
@extends('layouts.admin')

@section('title', 'Crear Nuevo Usuario Staff - Admin SIBIPN') {{-- Título ajustado --}}

@section('content')
<div class="text-ipn-gray-lighten">

    {{-- Encabezado --}}
    <div class="mb-8">
        <h1 class="text-3xl lg:text-4xl font-teko font-bold text-white">Crear Nuevo Usuario Staff</h1> {{-- Título ajustado --}}
        <p class="text-ipn-gray-lighten/90 mt-1">Completa los datos. La cuenta se creará como 'Administrativo', 'Activa' y 'Verificada'. La contraseña generada debe copiarse.</p> {{-- Descripción ajustada --}}
    </div>

    {{-- x-data llama al componente Alpine registrado globalmente en app.js --}}
    {{-- Pasa todos los valores old() y props necesarios --}}
    <div x-data="adminCreateUserForm({
            oldNombre: '{{ old('nombre', '') }}',
            oldPApellido: '{{ old('p_apellido', '') }}',
            oldSApellido: '{{ old('s_apellido', '') }}',
            oldBoleta: '{{ old('boleta', '') }}',
            oldEmail: '{{ old('email', '') }}',
            oldIdUnidadAcademica: '{{ old('idUnidadAcademica', '') }}',
            // REMOVIDO: oldCategoriaUsuario: '{{ old('categoriaUsuario', '') }}',
            oldIdRolAdmin: '{{ old('idRolAdmin', '') }}',
            // REMOVIDO: oldEstadoUsuario: '{{ old('estadoUsuario', 'Activo') }}', // Default 'Activo'
            initialPassword: '{{ Str::random(16) }}', // Genera una contraseña inicial segura
            csrfToken: '{{ csrf_token() }}',
            checkFieldRoute: '{{ route('auth.checkField') }}'
           })">
        <form method="POST" action="{{ route('admin.users.store') }}" class="space-y-6 bg-white/5 backdrop-blur-lg rounded-xl shadow-lg border border-white/10 p-6 sm:p-8">
            @csrf

            {{-- Datos Personales --}}
            <fieldset class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <legend class="text-lg font-semibold text-white mb-4 col-span-full border-b border-white/10 pb-2">Datos Personales</legend>
                <div>
                    <label for="nombre" class="block text-sm font-medium text-ipn-gray-lighten mb-1">Nombre(s) <span class="text-red-400">*</span></label>
                    <input type="text" id="nombre" name="nombre" required x-model="nombre"
                           class="sib-input-admin @error('nombre') border-red-500 focus:ring-red-500 @enderror">
                    @error('nombre')<p class="text-red-400 text-xs mt-1">{{ $message }}</p>@enderror
                </div>
                <div>
                    <label for="p_apellido" class="block text-sm font-medium text-ipn-gray-lighten mb-1">Primer Apellido <span class="text-red-400">*</span></label>
                    <input type="text" id="p_apellido" name="p_apellido" required x-model="p_apellido"
                           class="sib-input-admin @error('p_apellido') border-red-500 focus:ring-red-500 @enderror">
                    @error('p_apellido')<p class="text-red-400 text-xs mt-1">{{ $message }}</p>@enderror
                </div>
                <div>
                    <label for="s_apellido" class="block text-sm font-medium text-ipn-gray-lighten mb-1">Segundo Apellido</label>
                    <input type="text" id="s_apellido" name="s_apellido" x-model="s_apellido"
                           class="sib-input-admin @error('s_apellido') border-red-500 focus:ring-red-500 @enderror">
                    @error('s_apellido')<p class="text-red-400 text-xs mt-1">{{ $message }}</p>@enderror
                </div>
            </fieldset>

             {{-- Datos Institucionales y de Cuenta --}}
             <fieldset class="grid grid-cols-1 md:grid-cols-3 gap-6 border-t border-white/10 pt-6">
                <legend class="text-lg font-semibold text-white mb-4 col-span-full pb-2">Datos Institucionales y de Cuenta</legend>
                {{-- Boleta con Validación Async --}}
                <div>
                    <label for="boleta" class="block text-sm font-medium text-ipn-gray-lighten mb-1">Boleta / No. Emp. <span class="text-red-400">*</span></label>
                    <input type="text" id="boleta" name="boleta" required maxlength="10"
                           x-model="boleta"
                           @input.debounce.500ms="handleBoletaInput()"
                           class="sib-input-admin @error('boleta') !border-red-500 @enderror"
                           :class="{ '!border-red-500 focus:!ring-red-500': boletaExists === true || boletaErrorMessage.includes('inválido'), '!border-green-500 focus:!ring-green-500': boletaExists === false && boleta.length >= 10 && !boletaErrorMessage.includes('inválido') }">
                    <div class="mt-1 text-xs h-4">
                        <span x-show="boletaChecking" class="text-ipn-gray-lighten animate-pulse">Verificando...</span>
                        <span x-show="boletaErrorMessage" x-text="boletaErrorMessage" class="text-red-400"></span>
                        <span x-show="boletaExists === false && boleta.length >= 10 && !boletaErrorMessage.includes('inválido')" class="text-green-400">Boleta disponible.</span>
                    </div>
                    @error('boleta')<p class="text-red-400 text-xs mt-1">{{ $message }}</p>@enderror
                </div>
                {{-- Email con Validación Async --}}
                <div>
                    <label for="email" class="block text-sm font-medium text-ipn-gray-lighten mb-1">Correo Electrónico <span class="text-red-400">*</span></label>
                    <input type="email" id="email" name="email" required
                           x-model="email"
                           @input.debounce.500ms="checkEmail()"
                           class="sib-input-admin @error('email') !border-red-500 @enderror"
                           :class="{ '!border-red-500 focus:!ring-red-500': emailExists === true || emailErrorMessage.includes('inválido'), '!border-green-500 focus:!ring-green-500': emailExists === false && email !== '' && !emailErrorMessage.includes('inválido') }">
                    <div class="mt-1 text-xs h-4">
                        <span x-show="emailChecking" class="text-ipn-gray-lighten animate-pulse">Verificando...</span>
                        <span x-show="emailErrorMessage" x-text="emailErrorMessage" class="text-red-400"></span>
                        <span x-show="emailExists === false && email !== '' && !emailErrorMessage.includes('inválido')" class="text-green-400">Correo disponible.</span>
                    </div>
                    @error('email')<p class="text-red-400 text-xs mt-1">{{ $message }}</p>@enderror
                </div>
                {{-- Select Unidad Académica --}}
                <div>
                    <label for="idUnidadAcademica" class="block text-sm font-medium text-ipn-gray-lighten mb-1">Unidad Académica <span class="text-red-400">*</span></label>
                    <select id="idUnidadAcademica" name="idUnidadAcademica" required x-model="idUnidadAcademica"
                           class="sib-input-admin @error('idUnidadAcademica') border-red-500 focus:ring-red-500 @enderror">
                        <option value="" disabled>Selecciona...</option>
                        {{-- Asegúrate que $unidadesAcademicas se pase desde el Controller --}}
                        @isset($unidadesAcademicas)
                            @foreach ($unidadesAcademicas as $unidad)
                                <option value="{{ $unidad->idUnidadAcademica }}" {{ old('idUnidadAcademica') == $unidad->idUnidadAcademica ? 'selected' : '' }}>{{ $unidad->nombre }}</option>
                            @endforeach
                        @endisset
                    </select>
                    @error('idUnidadAcademica')<p class="text-red-400 text-xs mt-1">{{ $message }}</p>@enderror
                </div>

                {{-- CAMPO REMOVIDO: Select Categoría Usuario --}}
                {{--
                <div>
                    <label for="categoriaUsuario" class="block text-sm font-medium text-ipn-gray-lighten mb-1">Categoría Usuario <span class="text-red-400">*</span></label>
                    <select id="categoriaUsuario" name="categoriaUsuario" required x-model="categoriaUsuario"
                            class="sib-input-admin @error('categoriaUsuario') border-red-500 focus:ring-red-500 @enderror">
                        <option value="" disabled>Selecciona...</option>
                        @isset($categoriasPosibles)
                            @foreach ($categoriasPosibles as $categoria)
                                @php ... @endphp <option ...></option>
                            @endforeach
                        @endisset
                    </select>
                    @error('categoriaUsuario')<p class="text-red-400 text-xs mt-1">{{ $message }}</p>@enderror
                </div>
                --}}

                {{-- Select Rol Admin (Este se mantiene) --}}
                <div>
                    <label for="idRolAdmin" class="block text-sm font-medium text-ipn-gray-lighten mb-1">Rol Administrativo</label>
                    <select id="idRolAdmin" name="idRolAdmin" x-model="idRolAdmin"
                            class="sib-input-admin @error('idRolAdmin') border-red-500 focus:ring-red-500 @enderror">
                        <option value="">-- Sin Rol Asignado --</option>
                        {{-- Asegúrate que $roles se pase desde el Controller --}}
                        @isset($roles)
                            @foreach ($roles as $rol)
                                <option value="{{ $rol->id }}" {{ old('idRolAdmin') == $rol->id ? 'selected' : '' }}>{{ $rol->nombreRol }}</option>
                            @endforeach
                        @endisset
                    </select>
                    @error('idRolAdmin')<p class="text-red-400 text-xs mt-1">{{ $message }}</p>@enderror
                </div>

                {{-- CAMPO REMOVIDO: Select Estado Inicial --}}
                {{--
                <div>
                    <label for="estadoUsuario" class="block text-sm font-medium text-ipn-gray-lighten mb-1">Estado Inicial <span class="text-red-400">*</span></label>
                    <select id="estadoUsuario" name="estadoUsuario" required x-model="estadoUsuario"
                           class="sib-input-admin @error('estadoUsuario') border-red-500 focus:ring-red-500 @enderror">
                        @isset($estadosPosibles)
                            @foreach ($estadosPosibles as $estado)
                                <option ...>{{ $estado }}</option>
                            @endforeach
                        @endisset
                    </select>
                    @error('estadoUsuario')<p class="text-red-400 text-xs mt-1">{{ $message }}</p>@enderror
                </div>
                --}}

                {{-- Campo Contraseña Generada (se mantiene) --}}
                <div class="md:col-span-3">
                    <label for="generated_password_display" class="block text-sm font-medium text-ipn-gray-lighten mb-1">Contraseña Generada</label>
                    <div class="relative">
                        <input type="text" id="generated_password_display" x-model="generatedPassword" readonly
                                class="sib-input-admin font-mono !text-yellow-300 !bg-black/20 pr-20">
                        <div class="absolute inset-y-0 right-0 flex items-center pr-3 space-x-2">
                            {{-- Botón Copiar --}}
                            <button type="button" @click="copyPassword" title="Copiar contraseña" class="p-1 text-gray-400 hover:text-white focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-ipn-guinda-dark focus:ring-white rounded">
                                <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 17.25v3.375c0 .621-.504 1.125-1.125 1.125h-9.75a1.125 1.125 0 0 1-1.125-1.125V7.875c0-.621.504-1.125 1.125-1.125H6.75a9.06 9.06 0 0 1 1.5.124m7.5 10.376h3.375c.621 0 1.125-.504 1.125-1.125V11.25c0-4.46-3.243-8.161-7.5-8.876a9.06 9.06 0 0 0-1.5-.124H9.375c-.621 0-1.125.504-1.125 1.125v3.5m7.5 10.375H9.375a1.125 1.125 0 0 1-1.125-1.125v-9.25m9.75 0h-3.375c-.621 0-1.125.504-1.125 1.125v6.125c0 .621.504 1.125 1.125 1.125h3.375c.621 0 1.125-.504 1.125-1.125V7.875c0-.621-.504-1.125-1.125-1.125Z" /></svg>
                            </button>
                            {{-- Botón Regenerar --}}
                            <button type="button" @click="generatePassword(16)" title="Generar nueva contraseña" class="p-1 text-gray-400 hover:text-white focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-ipn-guinda-dark focus:ring-white rounded">
                                <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0 3.181 3.183a8.25 8.25 0 0 0 13.803-3.7M4.031 9.865a8.25 8.25 0 0 1 13.803-3.7l3.181 3.182m0-4.991v4.99" /></svg>
                            </button>
                        </div>
                    </div>
                    <p class="mt-1 text-xs text-ipn-gray-lighten/70">Copia la contraseña antes de guardar. Se enviará hasheada.</p>
                </div>

                {{-- Campos ocultos para enviar la contraseña generada (se mantienen) --}}
                <input type="hidden" name="password" :value="generatedPassword">
                <input type="hidden" name="password_confirmation" :value="generatedPassword">

             </fieldset>

             {{-- Botones de Acción --}}
             <div class="flex items-center justify-end space-x-4 pt-5 border-t border-white/10 mt-6">
                <a href="{{ route('admin.users.index') }}" class="btn-base btn-secondary !text-ipn-gray-lighten !border-ipn-gray-lighten/50 hover:!bg-white/5">
                    Cancelar
                </a>
                {{-- Botón Crear Usuario con :disabled y :class --}}
                <button type="submit" class="btn-base btn-auth-primary"
                        :disabled="!isFormValid()"
                        :class="{'opacity-50 cursor-not-allowed': !isFormValid()}">
                    Crear Usuario Staff
                </button>
            </div>

        </form>
    </div>
</div>

@endsection