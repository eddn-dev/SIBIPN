@props(['href' => null, 'type' => 'submit'])

@php
    $isLink = isset($href);
    $tag    = $isLink ? 'a' : 'button';
@endphp

{{--  ⬚  WRAPPER «bubble‑box» → permite que el halo quede fuera del <a>  --}}
<span class="bubble-box">
    {{-- halo rectangular fijo detrás del botón --}}
    <span class="bubble-halo"></span>

    {{-- BOTÓN real ---------------------------------------------------- --}}
    <{{ $tag }}
        {{ $isLink ? "href=$href" : "type=$type" }}
        {{ $attributes->class('btn-base btn-primary bubble-cta') }}>

        {{-- disco luminoso (se mueve vía JS) --}}
        <span class="bubble-track">
            <span class="bubble-core"></span>
        </span>

        {{-- contenido visible --}}
        <span class="relative z-10 flex items-center gap-2">
            {{ $slot }}
        </span>
    </{{ $tag }}>
</span>
