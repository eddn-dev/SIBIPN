{{-- resources/views/auth/forgot-password.blade.php --}}
@extends('layouts.auth')

@section('title', 'Recuperar contraseña – SIBIPN')

@section('content')
<div class="min-h-screen flex flex-col md:flex-row bg-ipn-gray-light">

    {{-- Imagen lateral --}}
    <div class="relative md:w-1/2 w-full h-40 sm:h-56 md:h-auto">
        <img src="{{ asset('images/hero.jpg') }}" alt="Recuperar Contraseña SIBIPN"
             class="absolute inset-0 w-full h-full object-cover brightness-75">
        <div class="absolute inset-0 bg-ipn-guinda opacity-60"></div>
    </div>

    {{-- Tarjeta principal --}}
    <div class="flex flex-1 items-center justify-center p-6 sm:p-8 md:p-12 bg-white">
        <div class="w-full max-w-md space-y-8">

            {{-- Encabezado --}}
            <div class="text-center">
                <img src="{{ asset('images/logo_sibipn.svg') }}" alt="Logo SIBIPN" class="mx-auto h-10 mb-4">
                <h2 class="text-2xl font-teko font-bold text-ipn-guinda">
                    Recuperar contraseña
                </h2>
                <p class="mt-1 text-sm text-ipn-gray">
                    Ingresa tu correo institucional y te enviaremos un enlace para restablecerla.
                </p>
            </div>

            {{-- Mensaje de estado (éxito al enviar enlace) --}}
            @if (session('status'))
                <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 text-sm" role="alert">
                    {{ session('status') }}
                </div>
            @endif

            {{-- Formulario --}}
            <form method="POST" action="{{ route('password.email') }}" class="space-y-6">
                @csrf

                {{-- Correo Electrónico --}}
                <div>
                    <label for="email" class="block text-sm font-medium text-ipn-gray-dark mb-1">Correo institucional <span class="text-red-500">*</span></label>
                    <input id="email" type="email"
                           name="email"
                           value="{{ old('email') }}"
                           required autofocus
                           autocomplete="username"
                           placeholder="usuario@ipn.mx"
                           class="sib-input @error('email') border-red-500 focus:ring-red-500 @enderror">
                    @error('email')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Botón: Aplicando clases estándar --}}
                <button type="submit" class="btn-base btn-auth-primary w-full text-base">
                    Enviar enlace de recuperación
                </button>
            </form>

            {{-- Enlace regreso a login --}}
            <p class="text-center text-sm text-ipn-gray mt-6">
                <a href="{{ route('login') }}" class="font-medium text-ipn-guinda hover:underline focus:outline-none focus:ring-2 focus:ring-offset-1 focus:ring-ipn-guinda rounded">
                    Volver a iniciar sesión
                </a>
            </p>
        </div>
    </div>
</div>
@endsection
