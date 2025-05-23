@extends('layouts.admin')

@section('title', 'Nuevo Registro - Cat\xC3\xA1logo')

@section('content')
<div class="text-ipn-gray-lighten max-w-3xl mx-auto">
    <h1 class="text-3xl lg:text-4xl font-teko font-bold text-white mb-6">Nuevo Registro</h1>
    <form action="{{ route('admin.catalog.store') }}" method="POST" class="space-y-6">
        @csrf
        @include('admin.catalog._form')
    </form>
</div>
@endsection