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
    {{-- Cambiamos bg-white por bg-ipn-guinda-dark --}}
    <div class="flex flex-1 items-center justify-center p-6 sm:p-8 md:p-12 bg-gradient-to-b from-ipn-guinda-dark to-ipn-guinda">
        <div class="w-full max-w-md flex flex-col h-full">

            <div> {{-- Contenedor para el contenido superior --}}
                {{-- Encabezado, Barra de progreso, Indicación obligatorios --}}
                <div class="text-center mb-6">
                    {{-- Considerar versión clara del logo si no contrasta bien --}}
                    <img src="{{ asset('images/logo_sibipn.svg') }}" alt="Logo SIBIPN" class="mx-auto h-10 mb-4">
                    {{-- Cambiamos color de título a blanco --}}
                    <h2 class="text-2xl font-teko font-bold text-white">Crear Cuenta</h2>
                    {{-- Cambiamos color de texto a gris claro --}}
                    <p class="text-sm text-ipn-gray-light">
                        Paso <span x-text="step"></span> de <span x-text="maxStep"></span>: Completa tus datos
                    </p>
                </div>
                {{-- Barra de progreso adaptada a tema oscuro --}}
                <div class="flex items-center mb-4">
                    <template x-for="n in maxStep" :key="n">
                        <div class="flex-1 mx-1">
                            {{-- Fondo de barra más claro, color de progreso ipn-oro --}}
                            <div class="h-1.5 bg-white/20 rounded-full overflow-hidden">
                                <div :class="step >= n ? 'bg-ipn-oro' : 'bg-white/20'" class="h-full transition-all duration-500 ease-out" :style="step === n ? 'width: 50%' : (step > n ? 'width: 100%' : 'width: 0%')"></div>
                            </div>
                        </div>
                    </template>
                </div>
                 {{-- Cambiamos color de texto a gris claro y asterisco a rojo claro --}}
                <p class="text-xs text-ipn-gray-light text-center mb-6">Los campos marcados con <span class="text-red-400 font-bold">*</span> son obligatorios.</p>
            </div>

            {{-- Formulario: Añadido @submit="handleSubmit" --}}
            <form method="POST" action="{{ route('register') }}" @submit="handleSubmit" class="flex flex-col flex-grow space-y-6">
                @csrf

                {{-- Contenedor de pasos --}}
                <div class="relative min-h-[300px] overflow-hidden flex-grow">

                    {{-- === PASO 1: Nombre y Apellidos === --}}
                    <div x-show="step === 1" x-transition class="absolute w-full space-y-4 px-1" x-cloak>
                         {{-- Título de paso en color oro --}}
                        <h3 class="text-lg font-semibold text-ipn-oro -mb-1">Datos Personales</h3>
                        <div>
                            {{-- Label en gris claro, asterisco en rojo claro --}}
                            <label for="nombre" class="block text-sm font-medium text-ipn-gray-light mb-1">Nombre(s) <span class="text-red-400">*</span></label>
                            {{-- Input usa .sib-input (ya estilizado para oscuro). Error usa rojo claro. --}}
                            <input id="nombre" name="nombre" type="text" required x-model="nombre" placeholder="Tu(s) nombre(s)" class="sib-input @error('nombre') border-red-400 focus:ring-red-400 @enderror">
                            @error('nombre')<p class="text-red-400 text-xs mt-1">{{ $message }}</p>@enderror
                        </div>
                        <div>
                            <label for="p_apellido" class="block text-sm font-medium text-ipn-gray-light mb-1">Primer Apellido <span class="text-red-400">*</span></label>
                            <input id="p_apellido" name="p_apellido" type="text" required x-model="p_apellido" placeholder="Tu primer apellido" class="sib-input @error('p_apellido') border-red-400 focus:ring-red-400 @enderror">
                            @error('p_apellido')<p class="text-red-400 text-xs mt-1">{{ $message }}</p>@enderror
                        </div>
                        <div>
                            {{-- Texto opcional en gris claro --}}
                            <label for="s_apellido" class="block text-sm font-medium text-ipn-gray-light mb-1">Segundo Apellido <span class="text-xs text-ipn-gray-light">(Opcional)</span></label>
                            <input id="s_apellido" name="s_apellido" type="text" x-model="s_apellido" placeholder="Tu segundo apellido" class="sib-input @error('s_apellido') border-red-400 focus:ring-red-400 @enderror">
                            @error('s_apellido')<p class="text-red-400 text-xs mt-1">{{ $message }}</p>@enderror
                        </div>
                    </div>

                    {{-- === PASO 2: Datos Escolares/Institucionales === --}}
                    <div x-show="step === 2" x-transition class="absolute w-full space-y-4 px-1" x-cloak>
                        <h3 class="text-lg font-semibold text-ipn-oro -mb-1">Datos Institucionales</h3>
                        <div>
                            <label for="boleta" class="block text-sm font-medium text-ipn-gray-light mb-1">Boleta / No. Empleado <span class="text-red-400">*</span></label>
                            {{-- Input usa .sib-input. Clases condicionales Alpine usan rojo/verde claro. --}}
                            <input id="boleta" name="boleta" type="text" required x-model="boleta" @blur="checkBoleta()" @input.debounce.500ms="handleBoletaInput()" placeholder="Identificador único IPN" class="sib-input @error('boleta') border-red-400 focus:ring-red-400 @enderror" :class="{ 'border-red-400 focus:ring-red-400': boletaExists === true, 'border-green-500 focus:ring-green-500': boletaExists === false && boleta !== '' }">
                             {{-- Mensajes de estado con colores adaptados --}}
                            <div class="mt-1 text-xs h-4">
                                <span x-show="boletaChecking" class="text-ipn-gray-light">Verificando...</span>
                                <span x-show="boletaErrorMessage" x-text="boletaErrorMessage" class="text-red-400"></span>
                                <span x-show="boletaExists === false && boleta !== ''" class="text-green-400">Boleta disponible.</span>
                            </div>
                            @error('boleta')<p class="text-red-400 text-xs mt-1">{{ $message }}</p>@enderror
                        </div>
                        <div>
                            <label for="categoriaUsuario" class="block text-sm font-medium text-ipn-gray-light mb-1">Categoría <span class="text-red-400">*</span></label>
                            {{-- Select usa .sib-input. Asegúrate que .sib-input maneje selects o añade estilos específicos si es necesario --}}
                            <select id="categoriaUsuario" name="categoriaUsuario" required x-model="categoriaUsuario" class="sib-input @error('categoriaUsuario') border-red-400 focus:ring-red-400 @enderror">
                                <option value="" disabled>Selecciona categoría</option>
                                @foreach(['AlumnoBachillerato'=>'Alumno Bachillerato', 'AlumnoLicenciatura'=>'Alumno Licenciatura', 'AlumnoPosgrado'=>'Alumno Posgrado', 'Investigador'=>'Investigador', 'Docente'=>'Docente', 'Administrativo'=>'Personal Administrativo', 'Externo'=>'Usuario Externo'] as $val => $label)
                                    {{-- Las opciones necesitan estilo si .sib-input no las cubre --}}
                                    <option value="{{ $val }}" class="text-black">{{ $label }}</option> {{-- Temporal: texto negro para opciones --}}
                                @endforeach
                            </select>
                            @error('categoriaUsuario')<p class="text-red-400 text-xs mt-1">{{ $message }}</p>@enderror
                        </div>
                        <div>
                            <label for="idUnidadAcademica" class="block text-sm font-medium text-ipn-gray-light mb-1">Unidad Académica <span class="text-red-400">*</span></label>
                            <select id="idUnidadAcademica" name="idUnidadAcademica" required x-model="idUnidadAcademica" class="sib-input @error('idUnidadAcademica') border-red-400 focus:ring-red-400 @enderror">
                                <option value="" disabled>Selecciona unidad</option>
                                @isset($unidadesAcademicas)
                                    @foreach($unidadesAcademicas as $u)
                                        <option value="{{ $u->idUnidadAcademica }}" class="text-black">{{ $u->nombre }}</option> {{-- Temporal: texto negro para opciones --}}
                                    @endforeach
                                @endisset
                            </select>
                            @error('idUnidadAcademica')<p class="text-red-400 text-xs mt-1">{{ $message }}</p>@enderror
                        </div>
                    </div>

                    {{-- === PASO 3: Datos de Cuenta === --}}
                    <div x-show="step === 3" x-transition class="absolute w-full space-y-4 px-1" x-cloak>
                        <h3 class="text-lg font-semibold text-ipn-oro -mb-1">Datos de la Cuenta</h3>
                        <div>
                            <label for="email" class="block text-sm font-medium text-ipn-gray-light mb-1">Correo Institucional <span class="text-red-400">*</span></label>
                            <input id="email" name="email" type="email" required x-model="email" @blur="checkEmail()" @input.debounce.500ms="checkEmail()" placeholder="usuario@ipn.mx" class="sib-input @error('email') border-red-400 focus:ring-red-400 @enderror" :class="{ 'border-red-400 focus:ring-red-400': emailExists === true, 'border-green-500 focus:ring-green-500': emailExists === false && email !== '' }">
                            <div class="mt-1 text-xs h-4">
                                <span x-show="emailChecking" class="text-ipn-gray-light">Verificando...</span>
                                <span x-show="emailErrorMessage" x-text="emailErrorMessage" class="text-red-400"></span>
                                <span x-show="emailExists === false && email !== ''" class="text-green-400">Correo disponible.</span>
                            </div>
                            @error('email')<p class="text-red-400 text-xs mt-1">{{ $message }}</p>@enderror
                        </div>
                        <div>
                            <label for="password" class="block text-sm font-medium text-ipn-gray-light mb-1">Contraseña <span class="text-red-400">*</span></label>
                            <input id="password" name="password" type="password" required x-model="password" placeholder="Mín. 8 caracteres" class="sib-input @error('password') border-red-400 focus:ring-red-400 @enderror">
                            @error('password')<p class="text-red-400 text-xs mt-1">{{ $message }}</p>@enderror
                        </div>
                        <div>
                            <label for="password_confirmation" class="block text-sm font-medium text-ipn-gray-light mb-1">Confirmar Contraseña <span class="text-red-400">*</span></label>
                            <input id="password_confirmation" name="password_confirmation" type="password" required x-model="password_confirmation" placeholder="Repite la contraseña" class="sib-input" :class="{'border-red-400 focus:ring-red-400': password && password_confirmation && password !== password_confirmation}">
                            {{-- Mensaje de error de coincidencia en rojo claro --}}
                            <p x-show="password && password_confirmation && password !== password_confirmation" class="text-red-400 text-xs mt-1">Las contraseñas no coinciden.</p>
                        </div>
                    </div>

                </div> {{-- Fin del contenedor de pasos --}}

                {{-- Navegación y Envío (Botones sin cambios de clase) --}}
                {{-- Asegúrate que las clases btn-* funcionen bien en fondo oscuro --}}
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
            {{-- Texto en gris claro, enlace en oro, focus adaptado --}}
            <p class="mt-8 text-center text-sm text-ipn-gray-light">
                ¿Ya tienes cuenta?
                <a href="{{ route('login') }}" class="font-medium text-ipn-oro hover:text-ipn-oro/80 hover:underline focus:outline-none focus:ring-2 focus:ring-ipn-oro focus:ring-offset-2 focus:ring-offset-ipn-guinda-dark rounded">
                    Inicia Sesión
                </a>
            </p>

        </div> {{-- Fin w-full --}}
    </div> {{-- Fin Formulario --}}

</div> {{-- Fin min-h-screen --}}
@endsection
