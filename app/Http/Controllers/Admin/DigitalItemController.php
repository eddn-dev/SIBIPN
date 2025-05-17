<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DigitalItem;
use App\Models\RegistroBibliografico;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;

class DigitalItemController extends Controller
{
    public function store(Request $request, RegistroBibliografico $catalog): RedirectResponse
    {
        Gate::authorize('gestionar-registros-bib');

        $validated = $request->validate([
            'archivo' => ['required', 'file'],
            'es_publico' => ['nullable', 'boolean'],
        ]);

        $disk = $request->boolean('es_publico') ? 'public' : 'local';
        $path = $request->file('archivo')->store('digital_items', $disk);

        DigitalItem::create([
            'idRegistroBibliografico' => $catalog->idRegistro,
            'archivo_path' => $path,
            'mime_type' => $request->file('archivo')->getClientMimeType(),
            'es_publico' => $request->boolean('es_publico'),
        ]);

        return back()->with('success', 'Archivo subido correctamente.');
    }

    public function destroy(DigitalItem $digitalItem): RedirectResponse
    {
        Gate::authorize('gestionar-registros-bib');

        $disk = $digitalItem->es_publico ? 'public' : 'local';
        Storage::disk($disk)->delete($digitalItem->archivo_path);
        $digitalItem->delete();

        return back()->with('success', 'Archivo eliminado correctamente.');
    }
}