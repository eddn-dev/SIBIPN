{{-- resources/views/auth/reset-password.blade.php --}}
@extends('layouts.auth')

@section('title', 'Restablecer contraseña – SIBIPN')

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
                    Restablecer contraseña
                </h2>
                <p class="mt-1 text-sm text-ipn-gray">
                    Elige una nueva contraseña segura para tu cuenta.
                </p>
            </div>

            {{-- Errores generales (token incorrecto, correo no válido, etc.) --}}
            @error('email')
                <div class="bg-red-50 border border-red-300 text-red-700 px-4 py-3 rounded-lg text-sm">
                    {{ $message }}
                </div>
            @enderror

            {{-- Formulario --}}
            <form method="POST" action="{{ route('password.store') }}" class="space-y-6">
                @csrf

                {{-- token que llega en la URL --}}
                <input type="hidden" name="token" value="{{ $request->route('token') }}">

                {{-- correo oculto (Breeze espera “email”) --}}
                <input type="hidden" name="email" value="{{ $request->email ?? old('email') }}">

                {{-- Nueva contraseña --}}
                <div>
                    <label class="block text-sm font-medium text-ipn-gray-dark">Nueva contraseña</label>
                    <input type="password"
                           name="password"
                           required
                           placeholder="Mínimo 8 caracteres"
                           class="sib-input @error('password') border-red-500 focus:ring-red-500 @enderror">
                    @error('password')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Confirmación --}}
                <div>
                    <label class="block text-sm font-medium text-ipn-gray-dark">Confirmar contraseña</label>
                    <input type="password"
                           name="password_confirmation"
                           required
                           placeholder="Repite la contraseña"
                           class="sib-input">
                </div>

                {{-- Botón --}}
                <button type="submit" class="btn-pill btn-primary w-full">
                    Restablecer contraseña
                </button>
            </form>

            {{-- Enlace a login --}}
            <p class="text-center text-sm text-ipn-gray mt-6">
                <a href="{{ route('login') }}" class="text-ipn-guinda hover:underline">
                    Volver a iniciar sesión
                </a>
            </p>
        </div>
    </div>
</div>
@endsection
