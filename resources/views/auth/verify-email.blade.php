{{-- resources/views/auth/verify-email.blade.php --}}
@extends('layouts.auth')

@section('title', 'Verificar Correo Electrónico – SIBIPN')

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
                <svg class="mx-auto h-12 w-12 text-ipn-guinda"
                     xmlns="http://www.w3.org/2000/svg" fill="none"
                     viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M21.75 6.75v10.5a2.25 2.25 0 0 1-2.25 2.25h-15a2.25 2.25 0 0 1-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25m19.5 0v.243a2.25 2.25 0 0 1-1.07 1.916l-7.5 4.615a2.25 2.25 0 0 1-2.36 0L3.32 8.91a2.25 2.25 0 0 1-1.07-1.916V6.75" />
                </svg>
                <h2 class="mt-6 text-2xl font-teko font-bold text-ipn-guinda">
                    Verifica tu correo electrónico
                </h2>
                <p class="mt-1 text-sm text-ipn-gray">
                    Revisa tu bandeja de entrada y haz clic en el enlace que te enviamos.
                </p>
            </div>

            {{-- Aviso de reenvío --}}
            @if (session('resent') || session('status') === 'verification-link-sent')
                <div class="bg-green-50 text-green-800 border border-green-200 px-4 py-3 rounded-lg text-sm">
                    Se envió un nuevo enlace de verificación. Si no lo ves, revisa tu carpeta de spam.
                </div>
            @endif

            {{-- Botón para reenviar enlace --}}
            <form class="space-y-4" method="POST" action="{{ route('verification.send') }}">
                @csrf
                <button type="submit" class="btn-pill btn-primary w-full">
                    Reenviar correo de verificación
                </button>
            </form>

            {{-- Logout --}}
            <form method="POST" action="{{ route('logout') }}" class="text-center">
                @csrf
                <button type="submit"
                        class="text-sm text-ipn-gray hover:text-ipn-guinda hover:underline">
                    Cerrar sesión
                </button>
            </form>

        </div>
    </div>
</div>
@endsection
