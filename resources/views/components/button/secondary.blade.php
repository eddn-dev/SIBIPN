{{-- resources/views/components/button/secondary.blade.php --}}
@props(['href' => null, 'type' => 'submit'])

@php
    $isLink = isset($href);
    $tag    = $isLink ? 'a' : 'button';
@endphp

<{{ $tag }}
    {{ $isLink ? "href=$href" : "type=$type" }}
    {{ $attributes->class('btn-ripple-secondary') }}>

    <span class="btn-label flex items-center gap-2 relative z-10">
        {{ $slot }}
    </span>
</{{ $tag }}>
