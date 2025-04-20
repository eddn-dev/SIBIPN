{{-- resources/views/welcome.blade.php --}}
@extends('layouts.app') {{-- Usa tu layout principal --}}

@section('title', 'SIBIPN - Explora. Investiga. Innova.') {{-- Título más alineado al concepto --}}

@section('content')

    @include('partials.landing.hero') {{-- Sección de héroe con el título y el botón de inicio --}}
    @include('partials.landing.recursos') {{-- Sección de características destacadas --}}
    @include('partials.landing.servicios') {{-- Sección de investigación --}}
    @include('partials.landing.parallax1') {{-- Sección de servicios --}}
    @include('partials.landing.comunidad') {{-- Sección de parallax --}}
    @include('partials.landing.parallax2') {{-- Sección de comunidad --}}
    @include('partials.landing.noticias') {{-- Sección de estadísticas --}}
    @include('partials.landing.estadisticas') {{-- Sección de nosotros --}}
    @include('partials.landing.parallax3') {{-- Sección de noticias --}}
    @include('partials.landing.ctafinal') {{-- Sección de contacto --}}
@endsection
