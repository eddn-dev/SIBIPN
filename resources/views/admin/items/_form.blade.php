@php $isEdit = isset($item); @endphp
<div class="space-y-4">
    <div>
        <label class="block text-sm font-medium text-ipn-gray-lighten mb-1">Registro Bibliográfico</label>
        <select name="idRegistroBibliografico" class="sib-input-admin" required>
            @foreach($records as $id => $title)
                <option value="{{ $id }}" @selected(old('idRegistroBibliografico', $item->idRegistroBibliografico ?? '') == $id)>{{ $title }}</option>
            @endforeach
        </select>
    </div>
    <div>
        <label class="block text-sm font-medium text-ipn-gray-lighten mb-1">Biblioteca</label>
        <select name="idBiblioteca" class="sib-input-admin" required> 
            @foreach($libraries as $id => $name)
                <option value="{{ $id }}" @selected(old('idBiblioteca', $item->idBiblioteca ?? '') == $id)>{{ $name }}</option>
            @endforeach
        </select>
    </div>
    <div>
        <label class="block text-sm font-medium text-ipn-gray-lighten mb-1">Código de Barras</label>
        <input type="text" name="codigo_barras" value="{{ old('codigo_barras', $item->codigo_barras ?? '') }}" class="sib-input-admin" required>        
    </div>
    <div>
        <label class="block text-sm font-medium text-ipn-gray-lighten mb-1">Estado</label>
        @php $estados = ['Disponible','Prestado','EnProceso','EnReparacion','Extraviado','Retirado','Reservado','NoAptoPrestamo']; @endphp
        <select name="estado_ejemplar" class="sib-input-admin" required>
            @foreach($estados as $estado)
                <option value="{{ $estado }}" @selected(old('estado_ejemplar', $item->estado_ejemplar ?? 'EnProceso') == $estado)>{{ $estado }}</option>
            @endforeach
        </select>
    </div>
    <div>
        <label class="block text-sm font-medium text-ipn-gray-lighten mb-1">Ubicación Específica</label>
        <input type="text" name="ubicacion_especifica" value="{{ old('ubicacion_especifica', $item->ubicacion_especifica ?? '') }}" class="sib-input-admin">
    </div>
</div>
<div class="mt-6">
    <button type="submit" class="btn-primary">{{ $isEdit ? 'Actualizar' : 'Crear' }}</button>
    <a href="{{ route('admin.items.index') }}" class="btn-secondary ml-3">Cancelar</a>
</div>