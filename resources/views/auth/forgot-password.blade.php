{{-- resources/views/auth/forgot-password.blade.php --}}
@extends('layouts.auth')

@section('title', 'Recuperar contraseña – SIBIPN')

@section('content')
<div class="min-h-screen flex flex-col md:flex-row bg-ipn-gray-light">

    {{-- Imagen lateral ---------------------------------------------------- --}}
    <div class="relative md:w-1/2 w-full h-40 sm:h-56 md:h-auto">
        <img src="{{ asset('images/hero.jpg') }}" alt="SIBIPN"
             class="absolute inset-0 w-full h-full object-cover brightness-75">
        <div class="absolute inset-0 bg-ipn-guinda opacity-60"></div>
    </div>

    {{-- Tarjeta principal ------------------------------------------------- --}}
    <div class="flex flex-1 items-center justify-center p-6 bg-white">
        <div class="w-full max-w-md space-y-8">

            {{-- Encabezado --}}
            <div class="text-center">
                <img src="{{ asset('images/logo_sibipn.svg') }}" alt="SIBIPN" class="mx-auto h-10 mb-4">
                <h2 class="text-2xl font-teko font-bold text-ipn-guinda">
                    Recuperar contraseña
                </h2>
                <p class="mt-1 text-sm text-ipn-gray">
                    Ingresa tu correo institucional y te enviaremos un enlace para restablecerla.
                </p>
            </div>

            {{-- Mensaje de estado --}}
            @if (session('status'))
                <div class="bg-green-50 text-green-800 border border-green-200 px-4 py-3 rounded-lg text-sm">
                    {{ session('status') }}
                </div>
            @endif

            {{-- Formulario --}}
            <form method="POST" action="{{ route('password.email') }}" class="space-y-6">
                @csrf

                <div>
                    <label class="block text-sm font-medium text-ipn-gray-dark">Correo institucional</label>
                    <input type="email"
                           name="email"
                           value="{{ old('email') }}"
                           required
                           placeholder="usuario@ipn.mx"
                           class="sib-input @error('email') border-red-500 focus:ring-red-500 @enderror">
                    @error('email')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <button type="submit" class="btn-pill btn-primary w-full">
                    Enviar enlace de recuperación
                </button>
            </form>

            {{-- Enlace regreso --}}
            <p class="text-center text-sm text-ipn-gray mt-6">
                <a href="{{ route('login') }}" class="text-ipn-guinda hover:underline">
                    Volver a iniciar sesión
                </a>
            </p>
        </div>
    </div>
</div>
@endsection
