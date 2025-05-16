{{-- resources/views/auth/confirm-password.blade.php --}}
{{-- Asumiendo que usas un layout similar a los otros de auth --}}
@extends('layouts.auth')

@section('title', 'Confirmar Contraseña – SIBIPN')

@section('content')
<div class="min-h-screen flex flex-col md:flex-row bg-ipn-gray-light">

    {{-- Imagen lateral (sin cambios) --}}
    <div class="relative md:w-1/2 w-full h-40 sm:h-56 md:h-auto">
        <img src="{{ asset('images/hero.jpg') }}" alt="Confirmación SIBIPN"
             class="absolute inset-0 w-full h-full object-cover brightness-75">
        <div class="absolute inset-0 bg-ipn-guinda opacity-60"></div>
    </div>

    {{-- Tarjeta principal --}}
    {{-- Cambiamos bg-white por bg-ipn-guinda-dark --}}
    <div class="flex flex-1 items-center justify-center p-6 sm:p-8 md:p-12 bg-ipn-guinda-dark">
        <div class="w-full max-w-md space-y-6"> {{-- Reducido space-y --}}

             {{-- Encabezado --}}
            <div class="text-center">
                 {{-- Icono - Cambiado a color blanco --}}
                 <svg class="mx-auto h-12 w-12 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                     <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 1 0-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 0 0 2.25-2.25v-6.75a2.25 2.25 0 0 0-2.25-2.25H6.75a2.25 2.25 0 0 0-2.25 2.25v6.75a2.25 2.25 0 0 0 2.25 2.25Z" />
                 </svg>
                 {{-- Título - Cambiado a color blanco --}}
                 <h2 class="mt-4 text-2xl font-teko font-bold text-white">
                     Confirmar Contraseña
                 </h2>
                  {{-- Texto - Cambiado a color gris claro --}}
                 <p class="mt-1 text-sm text-ipn-gray-light">
                     Esta es un área segura. Por favor, confirma tu contraseña antes de continuar.
                 </p>
            </div>

            <form method="POST" action="{{ route('password.confirm') }}">
                @csrf

                {{-- Contraseña --}}
                <div>
                    {{-- Label en gris claro, asterisco en rojo claro --}}
                    <label for="password" class="block text-sm font-medium text-ipn-gray-light mb-1">Contraseña <span class="text-red-400">*</span></label>
                    {{-- Input usa .sib-input. Error usa rojo claro. --}}
                    <input id="password" class="sib-input @error('password') border-red-400 focus:ring-red-400 @enderror"
                           type="password"
                           name="password"
                           required autocomplete="current-password"
                           placeholder="••••••••">
                    @error('password')
                         {{-- Mensaje de error en rojo claro --}}
                        <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex justify-end mt-4">
                    {{-- Botón (Clases sin cambios) --}}
                    <button type="submit" class="btn-primary text-sm"> {{-- Tamaño texto ajustado --}}
                        Confirmar
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
