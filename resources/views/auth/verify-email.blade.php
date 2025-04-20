{{-- resources/views/auth/verify-email.blade.php --}}
@extends('layouts.auth')

@section('title', 'Verificar Correo Electrónico – SIBIPN')

@section('content')
<div class="min-h-screen flex flex-col md:flex-row bg-ipn-gray-light">

    {{-- Imagen lateral --}}
    <div class="relative md:w-1/2 w-full h-40 sm:h-56 md:h-auto">
        <img src="{{ asset('images/hero.jpg') }}" alt="Verificación SIBIPN"
             class="absolute inset-0 w-full h-full object-cover brightness-75">
        <div class="absolute inset-0 bg-ipn-guinda opacity-60"></div>
    </div>

    {{-- Tarjeta principal --}}
    <div class="flex flex-1 items-center justify-center p-6 sm:p-8 md:p-12 bg-white">
        <div class="w-full max-w-md space-y-8">

            {{-- Encabezado --}}
            <div class="text-center">
                {{-- Icono de Email --}}
                <svg class="mx-auto h-12 w-12 text-ipn-guinda" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 0 1-2.25 2.25h-15a2.25 2.25 0 0 1-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25m19.5 0v.243a2.25 2.25 0 0 1-1.07 1.916l-7.5 4.615a2.25 2.25 0 0 1-2.36 0L3.32 8.91a2.25 2.25 0 0 1-1.07-1.916V6.75" />
                </svg>
                <h2 class="mt-6 text-2xl font-teko font-bold text-ipn-guinda">
                    Verifica tu correo electrónico
                </h2>
                <p class="mt-1 text-sm text-ipn-gray max-w-xs mx-auto">
                    Revisa tu bandeja de entrada (y spam) y haz clic en el enlace que te enviamos para activar tu cuenta.
                </p>
            </div>

            {{-- Aviso de reenvío --}}
            @if (session('status') == 'verification-link-sent')
                <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 text-sm" role="alert">
                    <p class="font-bold">¡Enviado!</p>
                    <p>Se envió un nuevo enlace de verificación a tu correo electrónico.</p>
                </div>
            @endif

            {{-- Botón para reenviar enlace --}}
            <form method="POST" action="{{ route('verification.send') }}">
                @csrf
                {{-- Aplicando clases estándar --}}
                <button type="submit" class="btn-base btn-auth-primary w-full text-base">
                    Reenviar correo de verificación
                </button>
            </form>

            {{-- Logout --}}
            <form method="POST" action="{{ route('logout') }}" class="text-center mt-4">
                @csrf
                <button type="submit"
                        class="text-sm text-ipn-gray hover:text-ipn-guinda hover:underline focus:outline-none focus:ring-2 focus:ring-offset-1 focus:ring-ipn-guinda rounded">
                    Cerrar sesión
                </button>
            </form>

        </div>
    </div>
</div>
@endsection
