{{-- resources/views/auth/login.blade.php --}}
@extends('layouts.auth')

@section('title', 'Iniciar Sesión - SIBIPN')

@section('content')
<div class="min-h-screen flex flex-col md:flex-row bg-ipn-gray-light">
    {{-- Izquierda: Imagen (Sin cambios) --}}
    <div class="relative md:w-1/2 w-full h-40 sm:h-56 md:h-auto">
        {{-- Es mejor usar URLs absolutas o el helper asset() para imágenes --}}
        <img src="{{ asset('images/hero.jpg') }}"
             alt="Acceso SIBIPN"
             class="absolute inset-0 w-full h-full object-cover brightness-75">
        {{-- Capa de superposición guinda --}}
        <div class="absolute inset-0 bg-ipn-guinda opacity-60"></div>
    </div>

    {{-- Derecha: Formulario (Modificado para fondo oscuro) --}}
    {{-- Cambiamos bg-white por bg-ipn-guinda-dark --}}
    <div class="flex flex-1 items-center justify-center bg-gradient-to-b from-ipn-guinda-dark to-ipn-guinda
     p-6 sm:p-8 md:p-12">
        <div class="w-full max-w-md space-y-8">
            {{-- Encabezado --}}
            <div class="text-center">
                {{-- Asegúrate que la ruta al logo sea correcta. Considera una versión clara del SVG si no contrasta bien. --}}
                <img src="{{ asset('images/logo_sibipn.svg') }}" alt="Logo SIBIPN" class="mx-auto h-10 mb-4">
                {{-- Cambiamos color de texto a blanco para contraste --}}
                <h2 class="text-2xl font-teko font-bold text-white">Iniciar Sesión</h2>
                {{-- Cambiamos color de texto a un gris claro --}}
                <p class="mt-1 text-sm text-ipn-gray-light">Usa tu correo institucional y contraseña</p>
            </div>

            {{-- Errores globales --}}
            {{-- Modificamos el estilo de error para fondo oscuro --}}
            @if ($errors->has('email') || $errors->has('correoInstitucional'))
                {{-- Usamos texto rojo más claro para mejor visibilidad en fondo oscuro --}}
                <div class="text-red-300 px-4 py-3 rounded relative text-sm" role="alert">
                    <strong class="font-bold text-red-300">Error:</strong>
                    <span class="block sm:inline">{{ $errors->first('email') ?: $errors->first('correoInstitucional') }}</span>
                </div>
            @endif


            <form method="POST" action="{{ route('login') }}" class="space-y-6">
                @csrf

                {{-- Correo Institucional --}}
                <div>
                    {{-- Cambiamos color de label a gris claro --}}
                    <label for="email" class="block text-sm font-medium text-ipn-gray-light mb-1">Correo Institucional</label>
                    <input id="email"
                           name="email"
                           type="email"
                           autocomplete="email"
                           required
                           value="{{ old('email') }}"
                           placeholder="nombre@ipn.mx"
                           {{-- Añadimos clases para estilo oscuro: fondo semitransparente, borde claro, texto blanco, placeholder claro, focus dorado --}}
                           {{-- Idealmente, refactorizar la clase .sib-input en CSS para manejar variantes dark: --}}
                           class="sib-input w-full rounded-md border-white/20 bg-white/10 px-3 py-2 text-white shadow-sm ring-1 ring-inset ring-white/10 placeholder:text-gray-400 focus:border-ipn-oro focus:outline-none focus:ring-2 focus:ring-inset focus:ring-ipn-oro sm:text-sm sm:leading-6 @error('email') border-red-400 focus:ring-red-400 @enderror @error('correoInstitucional') border-red-400 focus:ring-red-400 @enderror">
                           {{-- Nota: Ajustamos el color de borde/ring de error para mejor visibilidad en oscuro (e.g., de red-500 a red-400) --}}
                </div>

                {{-- Contraseña --}}
                <div>
                    {{-- Cambiamos color de label a gris claro --}}
                    <label for="password" class="block text-sm font-medium text-ipn-gray-light mb-1">Contraseña</label>
                    <input id="password"
                           name="password"
                           type="password"
                           autocomplete="current-password"
                           required
                           placeholder="••••••••"
                           {{-- Aplicamos las mismas clases de estilo oscuro que al email --}}
                           class="sib-input w-full rounded-md border-white/20 bg-white/10 px-3 py-2 text-white shadow-sm ring-1 ring-inset ring-white/10 placeholder:text-gray-400 focus:border-ipn-oro focus:outline-none focus:ring-2 focus:ring-inset focus:ring-ipn-oro sm:text-sm sm:leading-6 @error('password') border-red-400 focus:ring-red-400 @enderror">
                           {{-- Nota: Ajustamos el color de borde/ring de error para mejor visibilidad en oscuro (e.g., de red-500 a red-400) --}}
                    @error('password')
                      {{-- Muestra error específico de contraseña si existe, con color rojo claro --}}
                      <p class="mt-1 text-xs text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Recordarme / Olvidé --}}
                <div class="flex items-center justify-between">
                    {{-- Cambiamos color de texto a gris claro --}}
                    <label class="inline-flex items-center text-sm text-ipn-gray-light cursor-pointer">
                        <input type="checkbox"
                               name="remember"
                               {{-- Ajustamos colores del checkbox para tema oscuro: check dorado, borde claro, focus dorado --}}
                               class="h-4 w-4 rounded border-white/30 bg-transparent text-ipn-oro focus:ring-2 focus:ring-ipn-oro focus:ring-offset-2 focus:ring-offset-ipn-guinda-dark"
                               {{ old('remember') ? 'checked' : '' }}>
                        <span class="ml-2">Recordarme</span>
                    </label>
                    @if (Route::has('password.request'))
                        {{-- Verificación: Cambiamos color de enlace a dorado, ajustamos focus ring y offset --}}
                        <a href="{{ route('password.request') }}"
                           class="text-sm font-medium text-ipn-oro hover:text-ipn-oro/80 hover:underline focus:outline-none focus:ring-2 focus:ring-ipn-oro focus:ring-offset-2 focus:ring-offset-ipn-guinda-dark rounded">
                            Olvidé mi contraseña
                        </a>
                        {{-- Nota: Asegurado text-ipn-oro, hover:text-ipn-oro/80, y focus:ring-offset-ipn-guinda-dark --}}
                    @endif
                </div>

                {{-- Botón de Envío (Sin cambios en clases, según instrucción) --}}
                <div>
                    {{-- Las clases btn-base y btn-auth-primary se mantienen --}}
                    {{-- Asegúrate que estas clases funcionen bien en fondo oscuro o ajústalas globalmente --}}
                    <button type="submit"
                            class="btn-primary w-full text-base"> {{-- Ajustado tamaño texto --}}
                        Iniciar Sesión
                    </button>
                </div>
            </form>

            {{-- Enlace a registro --}}
            {{-- Cambiamos color de texto principal a gris claro y enlace a dorado --}}
            <p class="mt-6 text-center text-sm text-ipn-gray-light">
                ¿No tienes cuenta?
                <a href="{{ route('register') }}" class="font-medium text-ipn-oro hover:text-ipn-oro/80 hover:underline focus:outline-none focus:ring-2 focus:ring-ipn-oro focus:ring-offset-2 focus:ring-offset-ipn-guinda-dark rounded">
                    Regístrate aquí
                </a>
                {{-- Nota: Asegurado text-ipn-oro, hover:text-ipn-oro/80, y focus:ring-offset-ipn-guinda-dark --}}
            </p>
        </div>
    </div>
</div>
@endsection
