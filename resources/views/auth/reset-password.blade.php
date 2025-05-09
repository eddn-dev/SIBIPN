{{-- resources/views/auth/reset-password.blade.php --}}
@extends('layouts.auth')

@section('title', 'Restablecer contraseña – SIBIPN')

@section('content')
<div class="min-h-screen flex flex-col md:flex-row bg-ipn-gray-light">

    {{-- Imagen lateral (sin cambios) --}}
    <div class="relative md:w-1/2 w-full h-40 sm:h-56 md:h-auto">
        <img src="{{ asset('images/hero.jpg') }}" alt="SIBIPN"
             class="absolute inset-0 w-full h-full object-cover brightness-75">
        <div class="absolute inset-0 bg-ipn-guinda opacity-60"></div>
    </div>

    {{-- Tarjeta principal --}}
    {{-- Cambiamos bg-white por bg-ipn-guinda-dark --}}
    <div class="flex flex-1 items-center justify-center p-6 sm:p-8 md:p-12 bg-gradient-to-b from-ipn-guinda-dark to-ipn-guinda">
        <div class="w-full max-w-md space-y-8">

            {{-- Encabezado --}}
            <div class="text-center">
                 {{-- Considerar versión clara del logo si no contrasta bien --}}
                <img src="{{ asset('images/logo_sibipn.svg') }}" alt="Logo SIBIPN" class="mx-auto h-10 mb-4">
                {{-- Título en blanco --}}
                <h2 class="text-2xl font-teko font-bold text-white">
                    Restablecer contraseña
                </h2>
                 {{-- Texto en gris claro --}}
                <p class="mt-1 text-sm text-ipn-gray-light">
                    Elige una nueva contraseña segura para tu cuenta.
                </p>
            </div>

            {{-- Errores generales - Adaptado para fondo oscuro --}}
            @error('email')
                {{-- Usamos texto rojo claro, sin fondo ni borde explícito aquí --}}
                <div class="text-red-300 px-4 py-3 rounded relative text-sm" role="alert">
                    <span class="block sm:inline">{{ $message }}</span>
                </div>
            @enderror

            {{-- Formulario --}}
            <form method="POST" action="{{ route('password.store') }}" class="space-y-6">
                @csrf

                {{-- Token oculto --}}
                <input type="hidden" name="token" value="{{ $request->route('token') }}">

                {{-- Correo oculto --}}
                <input type="hidden" name="email" value="{{ $request->email ?? old('email') }}">

                {{-- Nueva contraseña --}}
                <div>
                    {{-- Label en gris claro, asterisco en rojo claro --}}
                    <label for="password" class="block text-sm font-medium text-ipn-gray-light mb-1">Nueva contraseña <span class="text-red-400">*</span></label>
                    {{-- Input usa .sib-input. Error usa rojo claro. --}}
                    <input id="password" type="password"
                           name="password"
                           required
                           autocomplete="new-password"
                           placeholder="Mínimo 8 caracteres"
                           class="sib-input @error('password') border-red-400 focus:ring-red-400 @enderror">
                    @error('password')
                        <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Confirmación --}}
                <div>
                    <label for="password_confirmation" class="block text-sm font-medium text-ipn-gray-light mb-1">Confirmar contraseña <span class="text-red-400">*</span></label>
                    <input id="password_confirmation" type="password"
                           name="password_confirmation"
                           required
                           autocomplete="new-password"
                           placeholder="Repite la contraseña"
                           class="sib-input">
                           {{-- El error de confirmación usualmente se muestra en el campo 'password' --}}
                </div>

                {{-- Botón (Clases sin cambios) --}}
                <button type="submit" class="btn-base btn-auth-primary w-full text-base">
                    Restablecer contraseña
                </button>
            </form>

            {{-- Enlace a login --}}
            {{-- Texto en gris claro, enlace en oro, focus adaptado --}}
            <p class="text-center text-sm text-ipn-gray-light mt-6">
                <a href="{{ route('login') }}" class="font-medium text-ipn-oro hover:text-ipn-oro/80 hover:underline focus:outline-none focus:ring-2 focus:ring-ipn-oro focus:ring-offset-2 focus:ring-offset-ipn-guinda-dark rounded">
                    Volver a iniciar sesión
                </a>
            </p>
        </div>
    </div>
</div>
@endsection
