{{-- resources/views/auth/register.blade.php --}}
{{-- Reemplaza TODO el contenido de este archivo con este código --}}

@extends('layouts.app') {{-- Usa tu layout principal --}}

@section('title', 'Registro - SIBIPN')

@section('content')
<div class="min-h-[calc(100vh-128px)] flex items-center justify-center bg-ipn-gray-light py-12 px-4 sm:px-6 lg:px-8"> {{-- Contenedor centrado --}}
    {{-- Ajusta max-w-lg o max-w-xl según el ancho deseado para el formulario más largo --}}
    <div class="max-w-lg w-full space-y-8 bg-white p-8 sm:p-10 rounded-xl shadow-xl border border-gray-200">
        {{-- Encabezado del Formulario --}}
        <div>
            {{-- Logo SIBIPN --}}
            <img class="mx-auto h-12 w-auto" src="{{ asset('images/logo_sibipn.svg') }}" alt="SIBIPN">
            <h2 class="mt-6 text-center text-3xl font-teko font-bold text-ipn-guinda">
                Crear Cuenta en SIBIPN
            </h2>
            <p class="mt-2 text-center text-sm text-ipn-gray">
                Completa tus datos para registrarte.
            </p>
        </div>

        {{-- Formulario de Registro --}}
        {{-- La ruta 'register' ahora apunta al RegisteredUserController@store de Breeze --}}
        <form class="mt-8 space-y-6" method="POST" action="{{ route('register') }}">
            @csrf {{-- Protección CSRF --}}

            {{-- Campo Nombre Completo --}}
            <div>
                <label for="nombreCompleto" class="block text-sm font-medium text-ipn-gray-dark">Nombre Completo</label>
                <input id="nombreCompleto" name="nombreCompleto" type="text" autocomplete="name" required
                       value="{{ old('nombreCompleto') }}"
                       class="mt-1 appearance-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-ipn-gray-dark rounded-md focus:outline-none focus:ring-ipn-guinda focus:border-ipn-guinda sm:text-sm @error('nombreCompleto') border-red-500 @enderror"
                       placeholder="Nombre(s) Apellido Paterno Apellido Materno">
                @error('nombreCompleto')
                    <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Campo Boleta / No. Empleado --}}
            <div>
                <label for="boleta" class="block text-sm font-medium text-ipn-gray-dark">Boleta / Número de Empleado</label>
                <input id="boleta" name="boleta" type="text" required
                       value="{{ old('boleta') }}"
                       class="mt-1 appearance-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-ipn-gray-dark rounded-md focus:outline-none focus:ring-ipn-guinda focus:border-ipn-guinda sm:text-sm @error('boleta') border-red-500 @enderror"
                       placeholder="Ej: 2020XXXXXX o 123456">
                @error('boleta')
                    <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Campo Correo Institucional --}}
            <div>
                {{-- El controlador de Breeze validará 'email' por defecto, necesitarás adaptar el controlador o cambiar el name aquí a 'email' y mantener la label/placeholder como 'Correo Institucional' --}}
                {{-- Opción 1 (Recomendada): Adaptar el controlador para validar 'correoInstitucional' --}}
                <label for="correoInstitucional" class="block text-sm font-medium text-ipn-gray-dark">Correo Institucional</label>
                <input id="correoInstitucional" name="correoInstitucional" type="email" autocomplete="email" required
                       value="{{ old('correoInstitucional') }}"
                       class="mt-1 appearance-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-ipn-gray-dark rounded-md focus:outline-none focus:ring-ipn-guinda focus:border-ipn-guinda sm:text-sm @error('correoInstitucional') border-red-500 @enderror @error('email') border-red-500 @enderror" {{-- Añadido @error('email') por si acaso --}}
                       placeholder="usuario@ipn.mx o usuario@alumno.ipn.mx">
                @error('correoInstitucional')
                    <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                @enderror
                 @error('email') {{-- Error por si el controlador aún usa 'email' --}}
                    <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                @enderror
                 {{-- Opción 2: Usar name="email" aquí y adaptar el controlador para guardar en 'correoInstitucional' --}}
                 {{--
                 <label for="email" class="block text-sm font-medium text-ipn-gray-dark">Correo Institucional</label>
                 <input id="email" name="email" type="email" autocomplete="email" required
                        value="{{ old('email') }}"
                        class="mt-1 ... @error('email') border-red-500 @enderror"
                        placeholder="usuario@ipn.mx o usuario@alumno.ipn.mx">
                 @error('email') ... @enderror
                 --}}
            </div>

            {{-- Campo Unidad Académica --}}
            <div>
                <label for="idUnidadAcademica" class="block text-sm font-medium text-ipn-gray-dark">Unidad Académica / Dependencia</label>
                 {{-- Asegúrate de pasar $unidadesAcademicas desde RegisteredUserController@create --}}
                <select id="idUnidadAcademica" name="idUnidadAcademica" required
                        class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-ipn-guinda focus:border-ipn-guinda sm:text-sm rounded-md @error('idUnidadAcademica') border-red-500 @enderror">
                    <option value="" disabled {{ old('idUnidadAcademica') ? '' : 'selected' }}>Selecciona tu Unidad Académica</option>
                    @isset($unidadesAcademicas)
                        @foreach($unidadesAcademicas as $unidad)
                            <option value="{{ $unidad->idUnidadAcademica }}" {{ old('idUnidadAcademica') == $unidad->idUnidadAcademica ? 'selected' : '' }}>
                                {{ $unidad->nombre }} {{ $unidad->siglas ? '('.$unidad->siglas.')' : '' }}
                            </option>
                        @endforeach
                    @else
                         <option value="" disabled>Error: No se cargaron las unidades académicas.</option>
                    @endisset
                </select>
                 @error('idUnidadAcademica')
                    <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                @enderror
            </div>

             {{-- Campo Categoría de Usuario --}}
            <div>
                <label for="categoriaUsuario" class="block text-sm font-medium text-ipn-gray-dark">Categoría</label>
                <select id="categoriaUsuario" name="categoriaUsuario" required
                        class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-ipn-guinda focus:border-ipn-guinda sm:text-sm rounded-md @error('categoriaUsuario') border-red-500 @enderror">
                    <option value="" disabled {{ old('categoriaUsuario') ? '' : 'selected' }}>Selecciona tu categoría</option>
                    <option value="AlumnoLicenciatura" {{ old('categoriaUsuario') == 'AlumnoLicenciatura' ? 'selected' : '' }}>Alumno Licenciatura</option>
                    <option value="AlumnoPosgrado" {{ old('categoriaUsuario') == 'AlumnoPosgrado' ? 'selected' : '' }}>Alumno Posgrado</option>
                    <option value="Investigador" {{ old('categoriaUsuario') == 'Investigador' ? 'selected' : '' }}>Investigador</option>
                    <option value="Docente" {{ old('categoriaUsuario') == 'Docente' ? 'selected' : '' }}>Docente</option>
                    <option value="Administrativo" {{ old('categoriaUsuario') == 'Administrativo' ? 'selected' : '' }}>Personal Administrativo (PAAE)</option>
                    <option value="Externo" {{ old('categoriaUsuario') == 'Externo' ? 'selected' : '' }}>Usuario Externo</option>
                </select>
                 @error('categoriaUsuario')
                    <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Campo Contraseña --}}
            <div>
                <label for="password" class="block text-sm font-medium text-ipn-gray-dark">Contraseña</label>
                <input id="password" name="password" type="password" autocomplete="new-password" required
                       class="mt-1 appearance-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-ipn-gray-dark rounded-md focus:outline-none focus:ring-ipn-guinda focus:border-ipn-guinda sm:text-sm @error('password') border-red-500 @enderror"
                       placeholder="Mínimo 8 caracteres">
                 @error('password')
                    <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Campo Confirmar Contraseña --}}
            <div>
                <label for="password_confirmation" class="block text-sm font-medium text-ipn-gray-dark">Confirmar Contraseña</label>
                <input id="password_confirmation" name="password_confirmation" type="password" autocomplete="new-password" required
                       class="mt-1 appearance-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-ipn-gray-dark rounded-md focus:outline-none focus:ring-ipn-guinda focus:border-ipn-guinda sm:text-sm"
                       placeholder="Repite la contraseña">
                {{-- El error de confirmación usualmente se muestra bajo el campo 'password' --}}
            </div>

            {{-- Botón de Envío --}}
            <div>
                <button type="submit"
                        class="group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-ipn-guinda hover:bg-ipn-guinda-desat focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-ipn-guinda transition duration-150 ease-in-out">
                    Registrarse
                </button>
            </div>
        </form>

         {{-- Enlace a Login --}}
         <div class="text-sm text-center">
            <p class="text-ipn-gray">¿Ya tienes una cuenta?
                {{-- La ruta 'login' la crea Breeze --}}
                @if (Route::has('login'))
                    <a href="{{ route('login') }}" class="font-medium text-ipn-guinda hover:underline">
                        Inicia sesión aquí
                    </a>
                @endif
            </p>
        </div>
    </div>
</div>
@endsection