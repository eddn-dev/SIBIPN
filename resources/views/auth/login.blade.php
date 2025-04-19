@extends('layouts.auth')

@section('title', 'Iniciar Sesión - SIBIPN')

@section('content')
<div class="min-h-screen flex flex-col md:flex-row bg-ipn-gray-light">
  {{-- Izquierda: Imagen --}}
  <div class="relative md:w-1/2 w-full h-40 sm:h-56 md:h-auto">
    <img src="{{ asset('images/hero.jpg') }}"
         alt="SIBIPN"
         class="absolute inset-0 w-full h-full object-cover brightness-75">
    <div class="absolute inset-0 bg-ipn-guinda opacity-60"></div>
  </div>

  {{-- Derecha: Formulario --}}
  <div class="flex flex-1 items-center justify-center bg-white p-6">
    <div class="w-full max-w-md space-y-8">
      {{-- Encabezado --}}
      <div class="text-center">
        <img src="{{ asset('images/logo_sibipn.svg') }}" alt="SIBIPN" class="mx-auto h-10 mb-4">
        <h2 class="text-2xl font-teko font-bold text-ipn-guinda">Iniciar Sesión</h2>
        <p class="mt-1 text-sm text-ipn-gray">Usa tu correo institucional y contraseña</p>
      </div>

      {{-- Errores globales --}}
      @error('correoInstitucional')
        <p class="text-red-600 text-sm text-center">{{ $message }}</p>
      @enderror
      @error('email')
        <p class="text-red-600 text-sm text-center">{{ $message }}</p>
      @enderror

      <form method="POST" action="{{ route('login') }}" class="space-y-6">
        @csrf

        {{-- Correo Institucional --}}
        <div>
          <label for="email" class="block text-sm font-medium text-ipn-gray-dark">Correo Institucional</label>
          <input id="email"
                 name="email"
                 type="email"
                 autocomplete="email"
                 required
                 value="{{ old('email') }}"
                 placeholder="nombre@ipn.mx"
                 class="sib-input @error('correoInstitucional') border-red-500 focus:ring-red-500 @enderror @error('email') border-red-500 focus:ring-red-500 @enderror">
        </div>

        {{-- Contraseña --}}
        <div>
          <label for="password" class="block text-sm font-medium text-ipn-gray-dark">Contraseña</label>
          <input id="password"
                 name="password"
                 type="password"
                 autocomplete="current-password"
                 required
                 placeholder="••••••••"
                 class="sib-input @error('password') border-red-500 focus:ring-red-500 @enderror">
          @error('password')
            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
          @enderror
        </div>

        {{-- Recordarme / Olvidé --}}
        <div class="flex items-center justify-between">
          <label class="inline-flex items-center text-sm text-ipn-gray-dark">
            <input type="checkbox"
                   name="remember"
                   class="h-4 w-4 text-ipn-guinda border-gray-300 rounded"
                   {{ old('remember') ? 'checked' : '' }}>
            <span class="ml-2">Recordarme</span>
          </label>
          @if (Route::has('password.request'))
            <a href="{{ route('password.request') }}"
               class="text-sm text-ipn-guinda hover:underline">
              Olvidé mi contraseña
            </a>
          @endif
        </div>

        {{-- Botón --}}
        <div>
          <button type="submit"
                  class="w-full py-3 text-white font-medium rounded-full bg-gradient-to-r from-ipn-guinda to-ipn-guinda-desat hover:from-ipn-guinda-desat hover:to-ipn-guinda focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-ipn-guinda transition-transform transform hover:scale-105">
            Iniciar Sesión
          </button>
        </div>
      </form>

      {{-- Enlace a registro --}}
      <p class="mt-6 text-center text-sm text-ipn-gray-dark">
        ¿No tienes cuenta?
        <a href="{{ route('register') }}" class="font-medium text-ipn-guinda hover:underline">
          Regístrate aquí
        </a>
      </p>
    </div>
  </div>
</div>
@endsection
