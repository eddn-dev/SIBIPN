<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\RegistroBibliografico;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Gate;

class CatalogController extends Controller
{
    /**
     * Display a listing of bibliographic records.
     */
    public function index(Request $request): View
    {
        Gate::authorize('gestionar-registros-bib');

        $query = RegistroBibliografico::query()->orderBy('titulo');

        if ($search = $request->input('search')) {
            $query->where('titulo', 'like', "%{$search}%")
                  ->orWhere('autor_principal', 'like', "%{$search}%");
        }

        $records = $query->paginate(15)->withQueryString();

        return view('admin.catalog.index', compact('records'));
    }

    /**
     * Show the form for creating a new record.
     */
    public function create(): View
    {
        Gate::authorize('gestionar-registros-bib');

        return view('admin.catalog.create');
    }

    /**
     * Store a newly created record in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        Gate::authorize('gestionar-registros-bib');

        $validated = $request->validate([
            'titulo' => ['required', 'string', 'max:255'],
            'autor_principal' => ['nullable', 'string', 'max:255'],
            'anio_publicacion' => ['nullable', 'digits:4'],
            'isbn' => ['nullable', 'string', 'max:20'],
            'issn' => ['nullable', 'string', 'max:20'],
            'tipo_material' => ['required', 'in:Libro,Tesis,Revista,Articulo,Audiovisual,RecursoElectronico,Otro'],
        ]);

        RegistroBibliografico::create($validated);

        return redirect()->route('admin.catalog.index')->with('success', 'Registro creado correctamente.');
    }

    /**
     * Show the form for editing the specified record.
     */
    public function edit(RegistroBibliografico $catalog): View
    {
        Gate::authorize('gestionar-registros-bib');

        return view('admin.catalog.edit', ['record' => $catalog]);
    }

    /**
     * Update the specified record in storage.
     */
    public function update(Request $request, RegistroBibliografico $catalog): RedirectResponse
    {
        Gate::authorize('gestionar-registros-bib');

        $validated = $request->validate([
            'titulo' => ['required', 'string', 'max:255'],
            'autor_principal' => ['nullable', 'string', 'max:255'],
            'anio_publicacion' => ['nullable', 'digits:4'],
            'isbn' => ['nullable', 'string', 'max:20'],
            'issn' => ['nullable', 'string', 'max:20'],
            'tipo_material' => ['required', 'in:Libro,Tesis,Revista,Articulo,Audiovisual,RecursoElectronico,Otro'],
        ]);

        $catalog->update($validated);

        return redirect()->route('admin.catalog.index')->with('success', 'Registro actualizado correctamente.');
    }

    /**
     * Remove the specified record from storage.
     */
    public function destroy(RegistroBibliografico $catalog): RedirectResponse
    {
        Gate::authorize('gestionar-registros-bib');

        $catalog->delete();

        return redirect()->route('admin.catalog.index')->with('success', 'Registro eliminado correctamente.');
    }
}