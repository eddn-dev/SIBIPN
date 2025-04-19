{{-- resources/views/auth/register.blade.php --}}
@extends('layouts.auth')

@section('title', 'Registro - SIBIPN')

@section('content')
<div class="min-h-screen flex flex-col md:flex-row bg-ipn-gray-light"
     x-data="{ step: 1, maxStep: 2 }">

    {{-- Imagen lateral --}}
    <div class="relative md:w-1/2 w-full h-40 sm:h-56 md:h-auto">
        <img src="{{ asset('images/hero.jpg') }}" alt="SIBIPN"
             class="absolute inset-0 w-full h-full object-cover brightness-75">
        <div class="absolute inset-0 bg-ipn-guinda opacity-60"></div>
    </div>

    {{-- Formulario --}}
    <div class="flex flex-1 items-center justify-center p-6 bg-white">
        <div class="w-full max-w-md">

            {{-- Encabezado --}}
            <div class="text-center mb-6">
                <img src="{{ asset('images/logo_sibipn.svg') }}" alt="SIBIPN" class="mx-auto h-10 mb-4">
                <h2 class="text-2xl font-teko font-bold text-ipn-guinda">Crear&nbsp;Cuenta</h2>
                <p class="text-sm text-ipn-gray">Completa los pasos para registrarte</p>
            </div>

            {{-- Barra de progreso --}}
            <div class="flex items-center mb-6">
                <template x-for="n in maxStep" :key="n">
                    <div class="flex-1 mx-1">
                        <div class="h-1 bg-gray-200 rounded-full overflow-hidden">
                            <div :class="step>=n ? 'bg-ipn-guinda' : 'bg-gray-300'" class="h-full transition-all"></div>
                        </div>
                    </div>
                </template>
            </div>

            <form method="POST" action="{{ route('register') }}" class="space-y-6">
                @csrf

                {{-- Contenedor con altura fija para evitar desbordes --}}
                <div class="relative overflow-hidden h-[320px]">

                    {{-- === PASO 1 ================================================= --}}
                    <div  x-show="step===1"
                          x-transition:leave="transition-opacity duration-200"
                          x-transition:leave-start="opacity-100"
                          x-transition:leave-end="opacity-0"
                          x-transition:enter="transition-opacity duration-200 delay-200"
                          x-transition:enter-start="opacity-0"
                          x-transition:enter-end="opacity-100"
                          class="absolute inset-0 space-y-4 px-1">
                        

                        {{-- Nombre --}}
                        <div>
                            <label class="block text-sm font-medium text-ipn-gray-dark">Nombre Completo</label>
                            <input name="nombreCompleto" type="text" required
                                   value="{{ old('nombreCompleto') }}"
                                   placeholder="Nombre(s) Apellido"
                                   class="sib-input @error('nombreCompleto') border-red-500 focus:ring-red-500 @enderror">
                            @error('nombreCompleto')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                        </div>

                        {{-- Boleta --}}
                        <div>
                            <label class="block text-sm font-medium text-ipn-gray-dark">Boleta / No. Empleado</label>
                            <input name="boleta" type="text" required
                                   value="{{ old('boleta') }}"
                                   placeholder="2020XXXXXX"
                                   class="sib-input @error('boleta') border-red-500 focus:ring-red-500 @enderror">
                            @error('boleta')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                        </div>

                        {{-- Categoría --}}
                        <div>
                            <label class="block text-sm font-medium text-ipn-gray-dark">Categoría</label>
                            <select name="categoriaUsuario" required
                                    class="sib-input @error('categoriaUsuario') border-red-500 focus:ring-red-500 @enderror">
                                <option value="" disabled {{ old('categoriaUsuario')?'':'selected' }}>Selecciona categoría</option>
                                @foreach([
                                  'AlumnoBachillerato'=>'Alumno Bachillerato',
                                  'AlumnoLicenciatura'=>'Alumno Licenciatura',
                                  'AlumnoPosgrado'=>'Alumno Posgrado',
                                  'Investigador'=>'Investigador',
                                  'Docente'=>'Docente',
                                  'Administrativo'=>'Personal Administrativo',
                                  'Externo'=>'Usuario Externo'
                                ] as $val => $label)
                                  <option value="{{ $val }}" {{ old('categoriaUsuario')==$val?'selected':'' }}>
                                      {{ $label }}
                                  </option>
                                @endforeach
                            </select>
                            @error('categoriaUsuario')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                        </div>

                        {{-- Unidad --}}
                        <div>
                            <label class="block text-sm font-medium text-ipn-gray-dark">Unidad Académica</label>
                            <select name="idUnidadAcademica" required
                                    class="sib-input @error('idUnidadAcademica') border-red-500 focus:ring-red-500 @enderror">
                                <option value="" disabled {{ old('idUnidadAcademica')?'':'selected' }}>Selecciona unidad</option>
                                @foreach($unidadesAcademicas as $u)
                                    <option value="{{ $u->idUnidadAcademica }}"
                                            {{ old('idUnidadAcademica')==$u->idUnidadAcademica?'selected':'' }}>
                                        {{ $u->nombre }}
                                    </option>
                                @endforeach
                            </select>
                            @error('idUnidadAcademica')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                        </div>
                    </div>

                    {{-- === PASO 2 ================================================= --}}
                    <div  x-show="step===2"
                          x-transition:leave="transition-opacity duration-200"
                          x-transition:leave-start="opacity-100"
                          x-transition:leave-end="opacity-0"
                          x-transition:enter="transition-opacity duration-200 delay-200"
                          x-transition:enter-start="opacity-0"
                          x-transition:enter-end="opacity-100"
                          class="absolute inset-0 space-y-4 px-1"
                          x-cloak>

                        <h3 class="text-lg font-semibold text-ipn-guinda">Datos&nbsp;de&nbsp;la&nbsp;cuenta</h3>

                        {{-- Correo --}}
                        <div>
                            <label class="block text-sm font-medium text-ipn-gray-dark">Correo Institucional</label>
                            <input name="email" type="email" required
                                   value="{{ old('email') }}"
                                   placeholder="usuario@ipn.mx"
                                   class="sib-input @error('email') border-red-500 focus:ring-red-500 @enderror">
                            @error('email')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                        </div>

                        {{-- Contraseña --}}
                        <div>
                            <label class="block text-sm font-medium text-ipn-gray-dark">Contraseña</label>
                            <input name="password" type="password" required
                                   placeholder="Mín. 8 caracteres"
                                   class="sib-input @error('password') border-red-500 focus:ring-red-500 @enderror">
                            @error('password')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                        </div>

                        {{-- Confirmar --}}
                        <div>
                            <label class="block text-sm font-medium text-ipn-gray-dark">Confirmar Contraseña</label>
                            <input name="password_confirmation" type="password" required
                                   placeholder="Repite contraseña"
                                   class="sib-input">
                        </div>
                    </div>

                </div>

                {{-- Navegación --}}
                <div class="flex justify-between pt-4">
                    <button type="button" @click="step--"
                            x-show="step>1"
                            class="btn-pill btn-secondary"
                            x-cloak>
                        Anterior
                    </button>

                    <div class="ml-auto space-x-2">
                        <button type="button" @click="step++"
                                x-show="step<maxStep"
                                class="btn-pill btn-primary"
                                x-cloak>
                            Siguiente
                        </button>
                        <button type="submit"
                                x-show="step===maxStep"
                                class="btn-pill btn-primary"
                                x-cloak>
                            Finalizar
                        </button>
                    </div>
                </div>
            </form>

            {{-- Enlace a login --}}
            <p class="mt-6 text-center text-sm text-ipn-gray">
                ¿Ya tienes cuenta?
                <a href="{{ route('login') }}" class="text-ipn-guinda hover:underline">Inicia Sesión</a>
            </p>

        </div>
    </div>
</div>
@endsection
