{{-- resources/views/auth/register.blade.php --}}
@extends('layouts.auth')

@section('title', 'Registro - SIBIPN')

@section('content')
{{--
    Llamamos a nuestro componente Alpine 'registerForm' definido en JS.
    Le pasamos un objeto JSON con los valores iniciales necesarios:
    - Valores 'old()' para repoblar el formulario.
    - El token CSRF.
    - La URL para la verificación de campos.
--}}
<div class="min-h-screen flex flex-col md:flex-row bg-ipn-gray-light"
     x-data="registerForm({
        oldNombre:           '{{ old('nombre', '') }}',
        oldPApellido:        '{{ old('p_apellido', '') }}',
        oldSApellido:        '{{ old('s_apellido', '') }}',
        oldBoleta:           '{{ old('boleta', '') }}',
        oldCategoriaUsuario: '{{ old('categoriaUsuario', '') }}',
        oldIdUnidadAcademica:'{{ old('idUnidadAcademica', '') }}',
        oldEmail:            '{{ old('email', '') }}',
        csrfToken:           '{{ csrf_token() }}',
        checkFieldRoute:     '{{ route('auth.checkField') }}'
     })">

    {{-- Imagen lateral (sin cambios) --}}
    <div class="relative md:w-1/2 w-full h-40 sm:h-56 md:h-auto">
        <img src="{{ asset('images/hero.jpg') }}" alt="Registro SIBIPN"
             class="absolute inset-0 w-full h-full object-cover brightness-75">
        <div class="absolute inset-0 bg-ipn-guinda opacity-60"></div>
    </div>

    {{-- Formulario --}}
    <div class="flex flex-1 items-center justify-center p-6 sm:p-8 md:p-12 bg-white">
        <div class="w-full max-w-md flex flex-col h-full">

            <div> {{-- Contenedor para el contenido superior --}}
                {{-- Encabezado, Barra de progreso, Indicación obligatorios --}}
                 <div class="text-center mb-6">
                    <img src="{{ asset('images/logo_sibipn.svg') }}" alt="Logo SIBIPN" class="mx-auto h-10 mb-4">
                    <h2 class="text-2xl font-teko font-bold text-ipn-guinda">Crear Cuenta</h2>
                    <p class="text-sm text-ipn-gray">
                        Paso <span x-text="step"></span> de <span x-text="maxStep"></span>: Completa tus datos
                    </p>
                </div>
                <div class="flex items-center mb-4">
                    <template x-for="n in maxStep" :key="n">
                        <div class="flex-1 mx-1"><div class="h-1.5 bg-gray-200 rounded-full overflow-hidden"><div :class="step >= n ? 'bg-ipn-guinda' : 'bg-gray-300'" class="h-full transition-all duration-500 ease-out" :style="step === n ? 'width: 50%' : (step > n ? 'width: 100%' : 'width: 0%')"></div></div></div>
                    </template>
                </div>
                 <p class="text-xs text-ipn-gray text-center mb-6">Los campos marcados con <span class="text-red-500 font-bold">*</span> son obligatorios.</p>
            </div>

            {{-- Formulario: Añadido @submit="handleSubmit" --}}
            <form method="POST" action="{{ route('register') }}" @submit="handleSubmit" class="flex flex-col flex-grow space-y-6">
                @csrf

                {{-- Contenedor de pasos --}}
                {{-- Quitamos min-h aquí, dejamos que flex-grow maneje la altura --}}
                <div class="relative min-h-[300px] overflow-hidden flex-grow">

                    {{-- === PASO 1: Nombre y Apellidos === --}}
                    <div x-show="step === 1" x-transition class="absolute w-full space-y-4 px-1" x-cloak>
                         <h3 class="text-lg font-semibold text-ipn-guinda -mb-1">Datos Personales</h3>
                        {{-- Inputs (ahora solo usan x-model, la lógica está en JS) --}}
                        <div>
                            <label for="nombre" class="block text-sm font-medium text-ipn-gray-dark mb-1">Nombre(s) <span class="text-red-500">*</span></label>
                            <input id="nombre" name="nombre" type="text" required x-model="nombre" placeholder="Tu(s) nombre(s)" class="sib-input @error('nombre') border-red-500 focus:ring-red-500 @enderror">
                            @error('nombre')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                        </div>
                        <div>
                            <label for="p_apellido" class="block text-sm font-medium text-ipn-gray-dark mb-1">Primer Apellido <span class="text-red-500">*</span></label>
                            <input id="p_apellido" name="p_apellido" type="text" required x-model="p_apellido" placeholder="Tu primer apellido" class="sib-input @error('p_apellido') border-red-500 focus:ring-red-500 @enderror">
                            @error('p_apellido')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                        </div>
                        <div>
                            <label for="s_apellido" class="block text-sm font-medium text-ipn-gray-dark mb-1">Segundo Apellido <span class="text-xs text-ipn-gray">(Opcional)</span></label>
                            <input id="s_apellido" name="s_apellido" type="text" x-model="s_apellido" placeholder="Tu segundo apellido" class="sib-input @error('s_apellido') border-red-500 focus:ring-red-500 @enderror">
                            @error('s_apellido')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                        </div>
                    </div>

                    {{-- === PASO 2: Datos Escolares/Institucionales === --}}
                    <div x-show="step === 2" x-transition class="absolute w-full space-y-4 px-1" x-cloak>
                         <h3 class="text-lg font-semibold text-ipn-guinda -mb-1">Datos Institucionales</h3>
                         {{-- Inputs (ahora usan x-model y @blur llama a métodos del componente JS) --}}
                         <div>
                            <label for="boleta" class="block text-sm font-medium text-ipn-gray-dark mb-1">Boleta / No. Empleado <span class="text-red-500">*</span></label>
                            <input id="boleta" name="boleta" type="text" required x-model="boleta" @blur="checkBoleta()" @input.debounce.500ms="handleBoletaInput()" placeholder="Identificador único IPN" class="sib-input @error('boleta') border-red-500 focus:ring-red-500 @enderror" :class="{ 'border-red-500 focus:ring-red-500': boletaExists === true, 'border-green-500 focus:ring-green-500': boletaExists === false && boleta !== '' }">
                            <div class="mt-1 text-xs h-4">
                                <span x-show="boletaChecking" class="text-ipn-gray">Verificando...</span>
                                <span x-show="boletaErrorMessage" x-text="boletaErrorMessage" class="text-red-500"></span>
                                <span x-show="boletaExists === false && boleta !== ''" class="text-green-600">Boleta disponible.</span>
                            </div>
                            @error('boleta')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                        </div>
                        <div>
                            <label for="categoriaUsuario" class="block text-sm font-medium text-ipn-gray-dark mb-1">Categoría <span class="text-red-500">*</span></label>
                            <select id="categoriaUsuario" name="categoriaUsuario" required x-model="categoriaUsuario" class="sib-input @error('categoriaUsuario') border-red-500 focus:ring-red-500 @enderror">
                                <option value="" disabled>Selecciona categoría</option>
                                @foreach(['AlumnoBachillerato'=>'Alumno Bachillerato', 'AlumnoLicenciatura'=>'Alumno Licenciatura', 'AlumnoPosgrado'=>'Alumno Posgrado', 'Investigador'=>'Investigador', 'Docente'=>'Docente', 'Administrativo'=>'Personal Administrativo', 'Externo'=>'Usuario Externo'] as $val => $label)
                                    <option value="{{ $val }}">{{ $label }}</option>
                                @endforeach
                            </select>
                            @error('categoriaUsuario')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                        </div>
                        <div>
                            <label for="idUnidadAcademica" class="block text-sm font-medium text-ipn-gray-dark mb-1">Unidad Académica <span class="text-red-500">*</span></label>
                            <select id="idUnidadAcademica" name="idUnidadAcademica" required x-model="idUnidadAcademica" class="sib-input @error('idUnidadAcademica') border-red-500 focus:ring-red-500 @enderror">
                                <option value="" disabled>Selecciona unidad</option>
                                @isset($unidadesAcademicas)
                                    @foreach($unidadesAcademicas as $u)
                                        <option value="{{ $u->idUnidadAcademica }}">{{ $u->nombre }}</option>
                                    @endforeach
                                @endisset
                            </select>
                            @error('idUnidadAcademica')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                        </div>
                    </div>

                    {{-- === PASO 3: Datos de Cuenta === --}}
                    <div x-show="step === 3" x-transition class="absolute w-full space-y-4 px-1" x-cloak>
                        <h3 class="text-lg font-semibold text-ipn-guinda -mb-1">Datos de la Cuenta</h3>
                        {{-- Inputs (ahora usan x-model y @blur llama a métodos del componente JS) --}}
                         <div>
                            <label for="email" class="block text-sm font-medium text-ipn-gray-dark mb-1">Correo Institucional <span class="text-red-500">*</span></label>
                            <input id="email" name="email" type="email" required x-model="email" @blur="checkEmail()" @input.debounce.500ms="checkEmail()" placeholder="usuario@ipn.mx" class="sib-input @error('email') border-red-500 focus:ring-red-500 @enderror" :class="{ 'border-red-500 focus:ring-red-500': emailExists === true, 'border-green-500 focus:ring-green-500': emailExists === false && email !== '' }">
                            <div class="mt-1 text-xs h-4">
                                <span x-show="emailChecking" class="text-ipn-gray">Verificando...</span>
                                <span x-show="emailErrorMessage" x-text="emailErrorMessage" class="text-red-500"></span>
                                <span x-show="emailExists === false && email !== ''" class="text-green-600">Correo disponible.</span>
                            </div>
                            @error('email')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                        </div>
                        <div>
                            <label for="password" class="block text-sm font-medium text-ipn-gray-dark mb-1">Contraseña <span class="text-red-500">*</span></label>
                            <input id="password" name="password" type="password" required x-model="password" placeholder="Mín. 8 caracteres" class="sib-input @error('password') border-red-500 focus:ring-red-500 @enderror">
                            @error('password')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                        </div>
                        <div>
                            <label for="password_confirmation" class="block text-sm font-medium text-ipn-gray-dark mb-1">Confirmar Contraseña <span class="text-red-500">*</span></label>
                            <input id="password_confirmation" name="password_confirmation" type="password" required x-model="password_confirmation" placeholder="Repite la contraseña" class="sib-input" :class="{'border-red-500 focus:ring-red-500': password && password_confirmation && password !== password_confirmation}">
                            <p x-show="password && password_confirmation && password !== password_confirmation" class="text-red-500 text-xs mt-1">Las contraseñas no coinciden.</p>
                        </div>
                    </div>

                </div> {{-- Fin del contenedor de pasos --}}

                {{-- Navegación y Envío (sin cambios en la lógica de botones) --}}
                <div class="flex items-center justify-between pt-4 mt-auto">
                    <button type="button" @click="step--" class="btn-base btn-secondary" :class="step === 1 ? 'invisible' : ''">
                        &larr; Anterior
                    </button>
                    <button type="button" @click="step++" x-show="step < maxStep" :disabled="!isStepValid() || (step === 2 && boletaChecking)" class="btn-base btn-auth-primary ml-auto disabled:opacity-50 disabled:cursor-not-allowed" x-cloak>
                        Siguiente &rarr;
                    </button>
                    <button type="submit" x-show="step === maxStep" :disabled="!isStepValid() || emailChecking" class="btn-base btn-auth-primary ml-auto disabled:opacity-50 disabled:cursor-not-allowed" x-cloak>
                        Finalizar Registro
                    </button>
                </div>
            </form>

            {{-- Enlace a login --}}
            <p class="mt-8 text-center text-sm text-ipn-gray">
                ¿Ya tienes cuenta?
                <a href="{{ route('login') }}" class="font-medium text-ipn-guinda hover:underline focus:outline-none focus:ring-2 focus:ring-offset-1 focus:ring-ipn-guinda rounded">
                    Inicia Sesión
                </a>
            </p>

        </div> {{-- Fin w-full --}}
    </div> {{-- Fin Formulario --}}

     {{-- Token CSRF (Asegúrate que esté en el <head> de tu layout principal) --}}
     {{-- <meta name="csrf-token" content="{{ csrf_token() }}"> --}}

</div> {{-- Fin min-h-screen --}}
@endsection
