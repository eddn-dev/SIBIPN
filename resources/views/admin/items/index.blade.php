@extends('layouts.admin')

@section('title', 'Ejemplares - Admin')

@section('content')
<div class="text-ipn-gray-lighten">
    <div class="flex flex-col sm:flex-row justify-between items-start mb-6">
        <div>
            <h1 class="text-3xl lg:text-4xl font-teko font-bold text-white">Ejemplares</h1>
            <p class="text-ipn-gray-lighten/90 mt-1">Listado de copias físicas registradas.</p>
        </div>
        <a href="{{ route('admin.items.create') }}" class="btn-primary mt-4 sm:mt-0 whitespace-nowrap inline-flex items-center">
            <svg class="h-5 w-5 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" /></svg>
            Agregar Ejemplar
        </a>
    </div>

    @if(session('success'))
        <div class="bg-green-900/20 border border-green-500/30 text-green-200 px-4 py-3 rounded-lg relative mb-6 text-sm" role="alert">
            <strong class="font-bold">¡Éxito!</strong>
            <span class="block sm:inline ml-1">{{ session('success') }}</span>
            <button type="button" class="absolute top-0 bottom-0 right-0 px-4 py-3" onclick="this.parentElement.style.display='none';">
                <svg class="fill-current h-5 w-5 text-green-300/70 hover:text-green-200" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><title>Cerrar</title><path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z"/></svg>
            </button>
        </div>
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