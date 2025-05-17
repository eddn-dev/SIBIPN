<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Ejemplar;
use App\Models\RegistroBibliografico;
use App\Models\Biblioteca;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class ItemController extends Controller
{
    /**
     * Display a listing of items.
     */
    public function index(): View
    {
        Gate::authorize('gestionar-items');

        $items = Ejemplar::with(['biblioteca'])
            ->orderBy('codigo_barras')
            ->paginate(15);

        return view('admin.items.index', compact('items'));
    }

    /**
     * Show the form for creating a new item.
     */
    public function create(): View
    {
        Gate::authorize('gestionar-items');

        $records = RegistroBibliografico::orderBy('titulo')->pluck('titulo', 'idRegistro');
        $libraries = Biblioteca::orderBy('nombre')->pluck('nombre', 'idBiblioteca');

        return view('admin.items.create', compact('records', 'libraries'));
    }

    /**
     * Store a newly created item in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        Gate::authorize('gestionar-items');

        $validated = $request->validate([
            'idRegistroBibliografico' => ['required', 'uuid', 'exists:registros_bibliograficos,idRegistro'],
            'idBiblioteca' => ['required', 'string', 'exists:bibliotecas,idBiblioteca'],
            'codigo_barras' => ['required', 'string', 'max:100', 'unique:ejemplares,codigo_barras'],
            'estado_ejemplar' => ['required', 'in:Disponible,Prestado,EnProceso,EnReparacion,Extraviado,Retirado,Reservado,NoAptoPrestamo'],
            'ubicacion_especifica' => ['nullable', 'string', 'max:255'],
        ]);

        Ejemplar::create($validated);

        return redirect()->route('admin.items.index')->with('success', 'Ejemplar creado correctamente.');
    }

    /**
     * Show the form for editing the specified item.
     */
    public function edit(Ejemplar $item): View
    {
        Gate::authorize('gestionar-items');

        $records = RegistroBibliografico::orderBy('titulo')->pluck('titulo', 'idRegistro');
        $libraries = Biblioteca::orderBy('nombre')->pluck('nombre', 'idBiblioteca');

        return view('admin.items.edit', compact('item', 'records', 'libraries'));
    }

    /**
     * Update the specified item in storage.
     */
    public function update(Request $request, Ejemplar $item): RedirectResponse
    {
        Gate::authorize('gestionar-items');

        $validated = $request->validate([
            'idRegistroBibliografico' => ['required', 'uuid', 'exists:registros_bibliograficos,idRegistro'],
            'idBiblioteca' => ['required', 'string', 'exists:bibliotecas,idBiblioteca'],
            'codigo_barras' => ['required', 'string', 'max:100', 'unique:ejemplares,codigo_barras,' . $item->idEjemplar . ',idEjemplar'],
            'estado_ejemplar' => ['required', 'in:Disponible,Prestado,EnProceso,EnReparacion,Extraviado,Retirado,Reservado,NoAptoPrestamo'],
            'ubicacion_especifica' => ['nullable', 'string', 'max:255'],
        ]);

        $item->update($validated);

        return redirect()->route('admin.items.index')->with('success', 'Ejemplar actualizado correctamente.');
    }

    /**
     * Remove the specified item from storage.
     */
    public function destroy(Ejemplar $item): RedirectResponse
    {
        Gate::authorize('gestionar-items');

        $item->delete();

        return redirect()->route('admin.items.index')->with('success', 'Ejemplar eliminado correctamente.');
    }
}