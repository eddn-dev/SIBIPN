@extends('layouts.admin')

@section('title', 'Nuevo Ejemplar')

@section('content')
<div class="text-ipn-gray-lighten max-w-3xl mx-auto">
    <h1 class="text-3xl lg:text-4xl font-teko font-bold text-white mb-6">Nuevo Ejemplar</h1>
    <form action="{{ route('admin.items.store') }}" method="POST" class="space-y-6">
        @csrf
        @include('admin.items._form')
    </form>
</div>
@endsection