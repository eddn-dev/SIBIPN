{{-- resources/views/auth/verify-email.blade.php --}}
{{-- Reemplaza TODO el contenido de este archivo con este código --}}

@extends('layouts.app') {{-- Usa tu layout principal --}}

@section('title', 'Verificar Correo Electrónico - SIBIPN')

@section('content')
<div class="min-h-[calc(100vh-128px)] flex items-center justify-center bg-ipn-gray-light py-12 px-4 sm:px-6 lg:px-8"> {{-- Contenedor centrado --}}
    <div class="max-w-md w-full space-y-8 bg-white p-8 sm:p-10 rounded-xl shadow-xl border border-gray-200">

        {{-- Icono y Título --}}
        <div class="text-center">
            {{-- Icono de Correo --}}
            <svg class="mx-auto h-12 w-12 text-ipn-guinda" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 0 1-2.25 2.25h-15a2.25 2.25 0 0 1-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25m19.5 0v.243a2.25 2.25 0 0 1-1.07 1.916l-7.5 4.615a2.25 2.25 0 0 1-2.36 0L3.32 8.91a2.25 2.25 0 0 1-1.07-1.916V6.75" />
            </svg>
            <h2 class="mt-6 text-3xl font-teko font-bold text-ipn-guinda">
                Verifica tu Dirección de Correo
            </h2>
        </div>

        {{-- Mensaje de Éxito (si se reenvió el correo) --}}
        {{-- Buscamos la clave 'resent' que usa el trait VerifiesEmails/Controlador de Breeze --}}
        @if (session('resent') || session('status') == 'verification-link-sent') {{-- Cubre ambos casos --}}
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 px-4 py-3 rounded relative" role="alert">
                <strong class="font-bold block sm:inline">¡Enlace enviado!</strong>
                <span class="block sm:inline">Se ha enviado un nuevo enlace de verificación a tu dirección de correo electrónico. Revisa tu bandeja de entrada y spam.</span>
            </div>
        @endif

        {{-- Instrucciones --}}
        <div class="text-center text-sm text-ipn-gray-dark space-y-2">
             <p>
                ¡Gracias por registrarte! Hemos enviado un enlace de verificación a tu correo electrónico.
             </p>
             <p>
                 Por favor, revisa tu bandeja de entrada (y la carpeta de spam/correo no deseado) y haz clic en el enlace para activar tu cuenta.
            </p>
            <p class="font-medium">
                Si no recibiste el correo, puedes solicitar otro:
            </p>
        </div>

        {{-- Formulario para Reenviar --}}
        {{-- Acción actualizada a 'verification.send' que es la ruta nombrada por Breeze --}}
        <form class="mt-6" method="POST" action="{{ route('verification.send') }}">
            @csrf
            <button type="submit"
                    class="group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-ipn-guinda hover:bg-ipn-guinda-desat focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-ipn-guinda transition duration-150 ease-in-out">
                Reenviar Correo de Verificación
            </button>
        </form>

        {{-- Enlace de Logout --}}
        <div class="text-center text-sm mt-6">
             <form method="POST" action="{{ route('logout') }}" class="inline">
                 @csrf
                 <button type="submit" class="font-medium text-ipn-gray hover:text-ipn-guinda hover:underline focus:outline-none">
                     Cerrar sesión
                 </button>
             </form>
        </div>

    </div>
</div>
@endsection