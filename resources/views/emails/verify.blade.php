@component('mail::layout')

{{-- Cabecera con Logos --}}
@slot('header')
@component('mail::header', ['url' => config('app.url')])
<div style="text-align: center; padding: 10px 0;">
    {{-- Logos con URLs absolutas y estilos inline básicos --}}
    <img src="{{ asset('images/logo_sibipn.svg') }}" alt="{{ config('app.name', 'SIBIPN') }} Logo" style="height: 45px; width: auto; display: inline-block; margin-right: 20px; vertical-align: middle;">
    <img src="{{ asset('images/logo_ipn.svg') }}" alt="IPN Logo" style="height: 45px; width: auto; display: inline-block; vertical-align: middle;">
</div>
@endcomponent
@endslot

{{-- Cuerpo del mensaje --}}
# ¡Hola!

¡Gracias por registrarte en **{{ config('app.name', 'SIBIPN') }}**! Estamos emocionados de tenerte como parte de la comunidad politécnica que accede al conocimiento de forma unificada.

Para completar tu registro y empezar a disfrutar de todos los beneficios del sistema (como guardar favoritos, ver tu historial, participar en foros y más), por favor verifica tu dirección de correo electrónico haciendo clic en el botón de abajo:

{{-- Botón de Acción --}}
{{-- Asegúrate de haber personalizado el color 'primary' en tu CSS theme (default.css) para que sea guinda --}}
@component('mail::button', ['url' => $url, 'color' => 'primary'])
Verificar Correo Electrónico
@endcomponent

**¿Qué puedes hacer en SIBIPN?**
* Realizar búsquedas unificadas en todas las bibliotecas del IPN.
* Acceder a miles de recursos digitales (libros, artículos, bases de datos).
* Consultar la disponibilidad de materiales físicos en tiempo real.
* Utilizar recursos de aprendizaje y participar en talleres.
* Conectar con otros usuarios en la comunidad.

Si no creaste esta cuenta, puedes ignorar este mensaje de forma segura.

Saludos cordiales,<br>
El equipo de {{ config('app.name', 'SIBIPN') }}

{{-- Subcopy con el enlace como fallback --}}
@slot('subcopy')
@component('mail::subcopy')
Si tienes problemas haciendo clic en el botón "Verificar Correo Electrónico", copia y pega la siguiente URL en tu navegador web:
<span style="display: block; word-break: break-all; font-size: 0.9em; margin-top: 5px;">
    <a href="{{ $url }}" style="color: #5A1236; text-decoration: none;">{{ $url }}</a>
</span>
@endcomponent
@endslot

{{-- Pie de Página --}}
@slot('footer')
@component('mail::footer')
© {{ date('Y') }} {{ config('app.name', 'SIBIPN') }}. Instituto Politécnico Nacional. Todos los derechos reservados.
<br>
<a href="{{ url('/ayuda') }}" style="color: #999999; text-decoration: none; font-size: 0.8em;">Centro de Ayuda</a> | <a href="{{ url('/privacidad') }}" style="color: #999999; text-decoration: none; font-size: 0.8em;">Aviso de Privacidad</a>
@endcomponent
@endslot

@endcomponent