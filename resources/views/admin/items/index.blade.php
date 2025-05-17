@extends('layouts.admin')

@section('title', 'Ejemplares - Admin')

@section('content')
<div class="text-ipn-gray-lighten">
    <div class="mb-8">
        <h1 class="text-3xl lg:text-4xl font-teko font-bold text-white">Ejemplares</h1>
        <a href="{{ route('admin.items.create') }}" class="mt-4 inline-block bg-ipn-guinda-light px-4 py-2 text-sm text-white rounded hover:bg-ipn-guinda">Agregar Ejemplar</a>
    </div>

    @if(session('success'))
        <div class="bg-green-900/20 border border-green-500/30 text-green-200 px-4 py-3 rounded-lg mb-6 text-sm" role="alert">{{ session('success') }}</div>
    @endif

    <div class="bg-white/5 backdrop-blur-lg rounded-xl shadow-lg border border-white/10 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-white/10">
                <thead class="bg-white/5">
                    <tr>
                        <th class="px-4 py-3 text-left text-xs font-medium text-ipn-gray-lighten uppercase tracking-wider">Código de Barras</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-ipn-gray-lighten uppercase tracking-wider">Estado</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-ipn-gray-lighten uppercase tracking-wider">Biblioteca</th>
                        <th class="px-4 py-3 text-right text-xs font-medium text-ipn-gray-lighten uppercase tracking-wider">Acciones</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-white/5">
                    @foreach ($items as $item)
                    <tr class="hover:bg-white/5 transition-colors duration-150">
                        <td class="px-4 py-3 text-sm text-white">{{ $item->codigo_barras }}</td>
                        <td class="px-4 py-3 text-sm text-ipn-gray-lighten">{{ $item->estado_ejemplar }}</td>
                        <td class="px-4 py-3 text-sm text-ipn-gray-lighten">{{ $item->biblioteca->nombre ?? '-' }}</td>
                        <td class="px-4 py-3 text-right text-sm">
                            <a href="{{ route('admin.items.edit', $item) }}" class="text-ipn-gray-lighten hover:text-white font-medium hover:underline">Editar</a>
                            <form action="{{ route('admin.items.destroy', $item) }}" method="POST" class="inline" onsubmit="return confirm('¿Eliminar ejemplar?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="ml-3 text-red-400 hover:text-red-200 font-medium">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @if ($items->hasPages())
            <div class="bg-white/5 px-4 py-3 border-t border-white/10 text-xs text-ipn-gray-lighten">
                {{ $items->links('vendor.pagination.tailwind-dark') }}
            </div>
        @endif
    </div>
</div>
@endsection