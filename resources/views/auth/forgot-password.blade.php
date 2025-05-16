{{-- resources/views/auth/forgot-password.blade.php --}}
@extends('layouts.auth')

@section('title', 'Recuperar contraseña – SIBIPN')

@section('content')
<div class="min-h-screen flex flex-col md:flex-row bg-ipn-gray-light">

    {{-- Imagen lateral (sin cambios) --}}
    <div class="relative md:w-1/2 w-full h-40 sm:h-56 md:h-auto">
        <img src="{{ asset('images/hero.jpg') }}" alt="Recuperar Contraseña SIBIPN"
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
                    Recuperar contraseña
                </h2>
                 {{-- Texto en gris claro --}}
                <p class="mt-1 text-sm text-ipn-gray-light">
                    Ingresa tu correo institucional y te enviaremos un enlace para restablecerla.
                </p>
            </div>

            {{-- Mensaje de estado (éxito al enviar enlace) - Adaptado para fondo oscuro --}}
            @if (session('status'))
                 {{-- Fondo semitransparente, borde y texto verdes claros --}}
                <div class="bg-green-500/10 border-l-4 border-green-400 text-green-300 p-4 text-sm rounded" role="alert">
                    {{ session('status') }}
                </div>
            @endif

            {{-- Formulario --}}
            <form method="POST" action="{{ route('password.email') }}" class="space-y-6">
                @csrf

                {{-- Correo Electrónico --}}
                <div>
                    {{-- Label en gris claro, asterisco en rojo claro --}}
                    <label for="email" class="block text-sm font-medium text-ipn-gray-light mb-1">Correo institucional <span class="text-red-400">*</span></label>
                    {{-- Input usa .sib-input. Error usa rojo claro. --}}
                    <input id="email" type="email"
                           name="email"
                           value="{{ old('email') }}"
                           required autofocus
                           autocomplete="username"
                           placeholder="usuario@ipn.mx"
                           class="sib-input @error('email') border-red-400 focus:ring-red-400 @enderror">
                    @error('email')
                        {{-- Mensaje de error en rojo claro --}}
                        <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Botón (Clases sin cambios) --}}
                <button type="submit" class="btn-primary w-full text-base">
                    Enviar enlace de recuperación
                </button>
            </form>

            {{-- Enlace regreso a login --}}
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
