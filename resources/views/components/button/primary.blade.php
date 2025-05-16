{{-- resources/views/components/button/ripple.blade.php --}}
@props(['href' => null, 'type' => 'submit'])
@php($tag = $href ? 'a' : 'button')
<{{ $tag }}
    {{ $href ? "href=$href" : "type=$type" }}
    {{ $attributes->class('btn-ripple') }}>
    <span class="btn-label flex items-center gap-2 relative z-10">
        {{ $slot }}
    </span>
</{{ $tag }}>
