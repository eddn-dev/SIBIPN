{{-- resources/views/auth/reset-password.blade.php --}}
@extends('layouts.app')

@section('title', 'Restablecer Contraseña - SIBIPN')

@section('content')
<div class="min-h-[calc(100vh-128px)] flex items-center justify-center bg-ipn-gray-light py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md w-full space-y-8 bg-white p-8 sm:p-10 rounded-xl shadow-xl border border-gray-200">
         <div>
            <img class="mx-auto h-12 w-auto" src="{{ asset('images/logo_sibipn.svg') }}" alt="SIBIPN">
            <h2 class="mt-6 text-center text-3xl font-teko font-bold text-ipn-guinda">
                Restablecer Contraseña
            </h2>
            <p class="mt-2 text-center text-sm text-ipn-gray">
                Elige una nueva contraseña segura para tu cuenta.
            </p>
        </div>

        <form method="POST" action="{{ route('password.store') }}" class="mt-8 space-y-6"> {{-- password.store es el nombre de ruta de Breeze --}}
            @csrf

            <input type="hidden" name="token" value="{{ $request->route('token') }}">

            <div>
                <label for="correoInstitucional" class="block text-sm font-medium text-ipn-gray-dark">Correo Institucional</label>
                 {{-- Usamos el email de la URL como valor por defecto, pero el name es correoInstitucional --}}
                <input id="correoInstitucional" class="mt-1 appearance-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-ipn-gray-dark rounded-md focus:outline-none focus:ring-ipn-guinda focus:border-ipn-guinda sm:text-sm @error('correoInstitucional') border-red-500 @enderror @error('email') border-red-500 @enderror"
                       type="email" name="correoInstitucional" value="{{ old('correoInstitucional', $request->email) }}" required autofocus placeholder="usuario@ipn.mx / @alumno.ipn.mx" />
                @error('correoInstitucional')
                    <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                @enderror
                 {{-- Muestra error genérico si el controlador lo devuelve asociado a 'email' por error --}}
                 @error('email')
                    <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mt-4">
                <label for="password" class="block text-sm font-medium text-ipn-gray-dark">Nueva Contraseña</label>
                <input id="password" class="mt-1 appearance-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-ipn-gray-dark rounded-md focus:outline-none focus:ring-ipn-guinda focus:border-ipn-guinda sm:text-sm @error('password') border-red-500 @enderror"
                       type="password" name="password" required autocomplete="new-password" placeholder="Mínimo 8 caracteres">
                @error('password')
                    <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mt-4">
                <label for="password_confirmation" class="block text-sm font-medium text-ipn-gray-dark">Confirmar Nueva Contraseña</label>
                <input id="password_confirmation" class="mt-1 appearance-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-ipn-gray-dark rounded-md focus:outline-none focus:ring-ipn-guinda focus:border-ipn-guinda sm:text-sm"
                       type="password" name="password_confirmation" required autocomplete="new-password" placeholder="Repite la nueva contraseña">
            </div>

            <div class="flex items-center justify-end mt-4">
                <button type="submit"
                        class="group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-ipn-guinda hover:bg-ipn-guinda-desat focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-ipn-guinda transition duration-150 ease-in-out">
                    Restablecer Contraseña
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
