{{-- resources/views/auth/login.blade.php --}}
@extends('layouts.auth')

@section('title', 'Iniciar Sesión - SIBIPN')

@section('content')
<div class="min-h-screen flex flex-col md:flex-row bg-ipn-gray-light">
    {{-- Izquierda: Imagen --}}
    <div class="relative md:w-1/2 w-full h-40 sm:h-56 md:h-auto">
        {{-- Es mejor usar URLs absolutas o el helper asset() para imágenes --}}
        <img src="{{ asset('images/hero.jpg') }}"
             alt="Acceso SIBIPN"
             class="absolute inset-0 w-full h-full object-cover brightness-75">
        <div class="absolute inset-0 bg-ipn-guinda opacity-60"></div>
    </div>

    {{-- Derecha: Formulario --}}
    <div class="flex flex-1 items-center justify-center bg-white p-6 sm:p-8 md:p-12">
        <div class="w-full max-w-md space-y-8">
            {{-- Encabezado --}}
            <div class="text-center">
                {{-- Asegúrate que la ruta al logo sea correcta --}}
                <img src="{{ asset('images/logo_sibipn.svg') }}" alt="Logo SIBIPN" class="mx-auto h-10 mb-4">
                <h2 class="text-2xl font-teko font-bold text-ipn-guinda">Iniciar Sesión</h2>
                <p class="mt-1 text-sm text-ipn-gray">Usa tu correo institucional y contraseña</p>
            </div>

            {{-- Errores globales --}}
            @if ($errors->has('email') || $errors->has('correoInstitucional'))
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative text-sm" role="alert">
                    <strong class="font-bold">Error:</strong>
                    <span class="block sm:inline">{{ $errors->first('email') ?: $errors->first('correoInstitucional') }}</span>
                </div>
            @endif


            <form method="POST" action="{{ route('login') }}" class="space-y-6">
                @csrf

                {{-- Correo Institucional --}}
                <div>
                    <label for="email" class="block text-sm font-medium text-ipn-gray-dark mb-1">Correo Institucional</label>
                    <input id="email"
                           name="email"
                           type="email"
                           autocomplete="email"
                           required
                           value="{{ old('email') }}"
                           placeholder="nombre@ipn.mx"
                           {{-- Usamos la clase .sib-input definida en CSS --}}
                           class="sib-input @error('email') border-red-500 focus:ring-red-500 @enderror @error('correoInstitucional') border-red-500 focus:ring-red-500 @enderror">
                </div>

                {{-- Contraseña --}}
                <div>
                    <label for="password" class="block text-sm font-medium text-ipn-gray-dark mb-1">Contraseña</label>
                    <input id="password"
                           name="password"
                           type="password"
                           autocomplete="current-password"
                           required
                           placeholder="••••••••"
                           class="sib-input @error('password') border-red-500 focus:ring-red-500 @enderror">
                    @error('password')
                      {{-- Muestra error específico de contraseña si existe --}}
                      <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Recordarme / Olvidé --}}
                <div class="flex items-center justify-between">
                    <label class="inline-flex items-center text-sm text-ipn-gray-dark cursor-pointer">
                        <input type="checkbox"
                               name="remember"
                               class="h-4 w-4 text-ipn-guinda border-gray-300 rounded focus:ring-ipn-guinda"
                               {{ old('remember') ? 'checked' : '' }}>
                        <span class="ml-2">Recordarme</span>
                    </label>
                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}"
                           class="text-sm text-ipn-guinda hover:underline focus:outline-none focus:ring-2 focus:ring-offset-1 focus:ring-ipn-guinda rounded">
                            Olvidé mi contraseña
                        </a>
                    @endif
                </div>

                {{-- Botón de Envío --}}
                <div>
                    {{-- Aplicamos las clases btn-base y btn-auth-primary directamente --}}
                    <button type="submit"
                            class="btn-base btn-auth-primary w-full text-base"> {{-- Ajustado tamaño texto --}}
                        Iniciar Sesión
                    </button>
                </div>
            </form>

            {{-- Enlace a registro --}}
            <p class="mt-6 text-center text-sm text-ipn-gray-dark">
                ¿No tienes cuenta?
                <a href="{{ route('register') }}" class="font-medium text-ipn-guinda hover:underline focus:outline-none focus:ring-2 focus:ring-offset-1 focus:ring-ipn-guinda rounded">
                    Regístrate aquí
                </a>
            </p>
        </div>
    </div>
</div>
@endsection
