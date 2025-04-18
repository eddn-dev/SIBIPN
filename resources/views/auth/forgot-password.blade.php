{{-- resources/views/auth/forgot-password.blade.php --}}
@extends('layouts.app')

@section('title', 'Recuperar Contraseña - SIBIPN')

@section('content')
<div class="min-h-[calc(100vh-128px)] flex items-center justify-center bg-ipn-gray-light py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md w-full space-y-8 bg-white p-8 sm:p-10 rounded-xl shadow-xl border border-gray-200">
        <div>
            <img class="mx-auto h-12 w-auto" src="{{ asset('images/logo_sibipn.svg') }}" alt="SIBIPN">
            <h2 class="mt-6 text-center text-3xl font-teko font-bold text-ipn-guinda">
                Recuperar Contraseña
            </h2>
            <p class="mt-2 text-center text-sm text-ipn-gray">
                ¿Olvidaste tu contraseña? No hay problema. Ingresa tu correo institucional y te enviaremos un enlace para que elijas una nueva.
            </p>
        </div>

        {{-- Muestra mensajes de éxito, como "Hemos enviado por correo electrónico el enlace para restablecer su contraseña." --}}
        @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-600 bg-green-100 border border-green-300 p-3 rounded-md">
                {{ session('status') }}
            </div>
        @endif


        <form method="POST" action="{{ route('password.email') }}" class="mt-8 space-y-6">
            @csrf

            <div>
                <label for="correoInstitucional" class="block text-sm font-medium text-ipn-gray-dark">Correo Institucional</label>
                <input id="correoInstitucional" class="mt-1 appearance-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-ipn-gray-dark rounded-md focus:outline-none focus:ring-ipn-guinda focus:border-ipn-guinda sm:text-sm @error('correoInstitucional') border-red-500 @enderror"
                       type="email" name="correoInstitucional" value="{{ old('correoInstitucional') }}" required autofocus placeholder="usuario@ipn.mx / @alumno.ipn.mx" />
                {{-- Muestra errores de validación o si el correo no existe --}}
                @error('correoInstitucional')
                    <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                @enderror
                 {{-- Muestra error genérico si el controlador lo devuelve asociado a 'email' por error --}}
                 @error('email')
                    <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex items-center justify-end">
                <button type="submit"
                        class="group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-ipn-guinda hover:bg-ipn-guinda-desat focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-ipn-guinda transition duration-150 ease-in-out">
                    Enviar Enlace de Recuperación
                </button>
            </div>
        </form>
         <div class="text-sm text-center mt-4">
            <a href="{{ route('login') }}" class="font-medium text-ipn-guinda hover:underline">
                Regresar a Inicio de Sesión
            </a>
        </div>
    </div>
</div>
@endsection
