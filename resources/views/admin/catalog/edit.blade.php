@extends('layouts.admin')

@section('title', 'Editar Registro - Cat\xC3\xA1logo')

@section('content')
<div class="text-ipn-gray-lighten max-w-3xl mx-auto">
    <h1 class="text-3xl lg:text-4xl font-teko font-bold text-white mb-6">Editar Registro</h1>
    <form action="{{ route('admin.catalog.update', $record) }}" method="POST" class="space-y-6 bg-white/5 backdrop-blur-lg rounded-xl shadow-lg border border-white/10 p-6 sm:p-8">
        @csrf
        @method('PUT')
        @include('admin.catalog._form', ['record' => $record])
    </form>
</div>
@endsection