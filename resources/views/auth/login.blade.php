{{-- resources/views/auth/login.blade.php --}}
{{-- Reemplaza TODO el contenido de este archivo con este código --}}

@extends('layouts.app') {{-- Usa tu layout principal --}}

@section('title', 'Iniciar Sesión - SIBIPN')

@section('content')
<div class="min-h-[calc(100vh-128px)] flex items-center justify-center bg-ipn-gray-light py-12 px-4 sm:px-6 lg:px-8"> {{-- Ajusta min-h si tu header/footer tienen altura diferente --}}
    <div class="max-w-md w-full space-y-8 bg-white p-8 sm:p-10 rounded-xl shadow-xl border border-gray-200">
        {{-- Encabezado del Formulario --}}
        <div>
            {{-- Logo Opcional --}}
            <img class="mx-auto h-12 w-auto" src="{{ asset('images/logo_sibipn.svg') }}" alt="SIBIPN">
            <h2 class="mt-6 text-center text-3xl font-teko font-bold text-ipn-guinda">
                Iniciar Sesión en SIBIPN
            </h2>
            <p class="mt-2 text-center text-sm text-ipn-gray">
                Usa tu correo institucional y contraseña.
            </p>
        </div>

        {{-- Formulario de Login --}}
        <form class="mt-8 space-y-6" method="POST" action="{{ route('login') }}">
            @csrf {{-- Protección CSRF --}}

            {{-- Mensaje de Error General (Credenciales inválidas / Cuenta inactiva) --}}
            {{-- Este error se asocia a 'correoInstitucional' en el AuthenticatedSessionController adaptado --}}
            @error('correoInstitucional')
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                    <span class="block sm:inline">{{ $message }}</span>
                </div>
            @enderror
            {{-- También muestra el error genérico de 'email' si Breeze no fue adaptado y usa ese campo --}}
             @error('email')
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                    <span class="block sm:inline">{{ $message }}</span>
                </div>
            @enderror


            <input type="hidden" name="remember" value="true"> {{-- Simplificación, el checkbox controlará --}}

            <div class="rounded-md shadow-sm -space-y-px">
                {{-- Campo Correo Institucional --}}
                <div>
                    <label for="correoInstitucional" class="sr-only">Correo Institucional</label>
                    <input id="correoInstitucional" name="correoInstitucional" type="email" autocomplete="email" required
                           value="{{ old('correoInstitucional', old('email')) }}" {{-- Usa old() para ambos posibles nombres --}}
                           class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-ipn-gray-dark rounded-t-md focus:outline-none focus:ring-ipn-guinda focus:border-ipn-guinda focus:z-10 sm:text-sm @error('correoInstitucional') border-red-500 @enderror @error('email') border-red-500 @enderror"
                           placeholder="Correo Institucional (@ipn.mx / @alumno.ipn.mx)">
                </div>

                {{-- Campo Contraseña --}}
                <div>
                    <label for="password" class="sr-only">Contraseña</label>
                    <input id="password" name="password" type="password" autocomplete="current-password" required
                           class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-ipn-gray-dark rounded-b-md focus:outline-none focus:ring-ipn-guinda focus:border-ipn-guinda focus:z-10 sm:text-sm @error('password') border-red-500 @enderror"
                           placeholder="Contraseña">
                     @error('password') {{-- Error específico de validación de contraseña --}}
                        <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            {{-- Opciones: Recordarme y Olvidé Contraseña --}}
            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <input id="remember" name="remember" type="checkbox" value="1" {{ old('remember') ? 'checked' : '' }}
                           class="h-4 w-4 text-ipn-guinda focus:ring-ipn-guinda border-gray-300 rounded">
                    <label for="remember" class="ml-2 block text-sm text-ipn-gray-dark">
                        Recordarme
                    </label>
                </div>

                <div class="text-sm">
                    {{-- Asegúrate que la ruta 'password.request' exista (Breeze la crea) --}}
                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" class="font-medium text-ipn-guinda hover:underline">
                            ¿Olvidaste tu contraseña?
                        </a>
                    @endif
                </div>
            </div>

            {{-- Botón de Envío --}}
            <div>
                <button type="submit"
                        class="group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-ipn-guinda hover:bg-ipn-guinda-desat focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-ipn-guinda transition duration-150 ease-in-out">
                    <span class="absolute left-0 inset-y-0 flex items-center pl-3">
                        <svg class="h-5 w-5 text-ipn-guinda-desat group-hover:text-ipn-guinda" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                            <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd" />
                        </svg>
                    </span>
                    Iniciar Sesión
                </button>
            </div>
        </form>

         {{-- Enlace a Registro --}}
         <div class="text-sm text-center">
            <p class="text-ipn-gray">¿No tienes una cuenta?
                {{-- Asegúrate que la ruta 'register' exista (Breeze la crea) --}}
                @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="font-medium text-ipn-guinda hover:underline">
                        Regístrate aquí
                    </a>
                @endif
            </p>
        </div>
    </div>
</div>
@endsection