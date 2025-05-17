@extends('layouts.admin')

@section('title', 'Editar Ejemplar')

@section('content')
<div class="text-ipn-gray-lighten max-w-3xl mx-auto">
    <h1 class="text-3xl lg:text-4xl font-teko font-bold text-white mb-6">Editar Ejemplar</h1>
    <form action="{{ route('admin.items.update', $item) }}" method="POST" class="space-y-6">
        @csrf
        @method('PUT')
        @include('admin.items._form', ['item' => $item])
    </form>
</div>
@endsection