@props(['href' => null, 'type' => 'submit'])

@php
    $isLink = isset($href);
    $tag    = $isLink ? 'a' : 'button';
@endphp

<span class="bubble-box">
    <span class="bubble-halo"></span>

    <{{ $tag }}
        {{ $isLink ? "href=$href" : "type=$type" }}
        {{ $attributes->class('btn-base btn-secondary bubble-cta') }}>

        <span class="bubble-track">
            <span class="bubble-core"></span>
        </span>

        <span class="relative z-10 flex items-center gap-2">
            {{ $slot }}
        </span>
    </{{ $tag }}>
</span>
