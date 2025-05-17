@php $isEdit = isset($item); @endphp
<div class="space-y-4">
    <div>
        <label class="block text-sm font-medium text-ipn-gray-lighten">Registro Bibliográfico</label>
        <select name="idRegistroBibliografico" class="mt-1 w-full rounded bg-ipn-gray-dark border border-white/10 text-white" required>
            @foreach($records as $id => $title)
                <option value="{{ $id }}" @selected(old('idRegistroBibliografico', $item->idRegistroBibliografico ?? '') == $id)>{{ $title }}</option>
            @endforeach
        </select>
    </div>
    <div>
        <label class="block text-sm font-medium text-ipn-gray-lighten">Biblioteca</label>
        <select name="idBiblioteca" class="mt-1 w-full rounded bg-ipn-gray-dark border border-white/10 text-white" required>
            @foreach($libraries as $id => $name)
                <option value="{{ $id }}" @selected(old('idBiblioteca', $item->idBiblioteca ?? '') == $id)>{{ $name }}</option>
            @endforeach
        </select>
    </div>
    <div>
        <label class="block text-sm font-medium text-ipn-gray-lighten">Código de Barras</label>
        <input type="text" name="codigo_barras" value="{{ old('codigo_barras', $item->codigo_barras ?? '') }}" class="mt-1 w-full rounded bg-ipn-gray-dark border border-white/10 text-white" required>
    </div>
    <div>
        <label class="block text-sm font-medium text-ipn-gray-lighten">Estado</label>
        @php $estados = ['Disponible','Prestado','EnProceso','EnReparacion','Extraviado','Retirado','Reservado','NoAptoPrestamo']; @endphp
        <select name="estado_ejemplar" class="mt-1 w-full rounded bg-ipn-gray-dark border border-white/10 text-white" required>
            @foreach($estados as $estado)
                <option value="{{ $estado }}" @selected(old('estado_ejemplar', $item->estado_ejemplar ?? 'EnProceso') == $estado)>{{ $estado }}</option>
            @endforeach
        </select>
    </div>
    <div>
        <label class="block text-sm font-medium text-ipn-gray-lighten">Ubicación Específica</label>
        <input type="text" name="ubicacion_especifica" value="{{ old('ubicacion_especifica', $item->ubicacion_especifica ?? '') }}" class="mt-1 w-full rounded bg-ipn-gray-dark border border-white/10 text-white">
    </div>
</div>
<div class="mt-6">
    <button type="submit" class="bg-ipn-guinda-light px-4 py-2 text-white rounded hover:bg-ipn-guinda">{{ $isEdit ? 'Actualizar' : 'Crear' }}</button>
    <a href="{{ route('admin.items.index') }}" class="ml-3 text-ipn-gray-lighten hover:text-white">Cancelar</a>
</div>