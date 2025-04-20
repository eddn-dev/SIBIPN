{{-- resources/views/components/button/secondary.blade.php --}}
@props(['href' => null, 'type' => 'submit'])

@php
    $isLink = isset($href);
    $tag    = $isLink ? 'a' : 'button';
@endphp

{{-- Renderiza directamente el botón, sin wrappers ni elementos de efecto halo --}}
<{{ $tag }}
    {{ $isLink ? "href=$href" : "type=$type" }}
    {{-- Aplica clases base y la clase específica 'btn-secondary'. NO incluye 'bubble-cta' --}}
    {{ $attributes->class('btn-base btn-secondary') }}>

    {{-- Contenido visible simple --}}
    <span class="flex items-center gap-2">
        {{ $slot }}
    </span>
</{{ $tag }}>