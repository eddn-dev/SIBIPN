{{-- resources/views/components/button/secondary.blade.php --}}
@props(['href' => null, 'type' => 'submit'])

@php
    $isLink = isset($href);
    $tag    = $isLink ? 'a' : 'button';
@endphp

{{-- Renderiza directamente el botón, sin wrappers ni elementos de efecto halo --}}
<{{ $tag }}
    {{ $isLink ? "href=$href" : "type=$type" }}
    {{ $attributes->class('btn-base btn-secondary') }}>

    {{-- Contenido visible simple --}}
    <span class="flex items-center gap-2">
        {{ $slot }}
    </span>
</{{ $tag }}>