@php
    $isEdit = isset($record);
    $autoresSec = old('autores_secundarios', $record->autores_secundarios ?? '');
    $autoresArray = $autoresSec ? explode(';', $autoresSec) : [];
@endphp
<div class="space-y-4" x-data="adminCatalogForm({ autores: @js($autoresArray) })">
    <div>
        <label class="block text-sm font-medium text-ipn-gray-lighten mb-1">T\xC3\xADtulo</label>
        <input type="text" name="titulo" value="{{ old('titulo', $record->titulo ?? '') }}" class="sib-input-admin" required>
    </div>
    <div>
        <label class="block text-sm font-medium text-ipn-gray-lighten mb-1">Autor Principal</label>
        <input type="text" name="autor_principal" value="{{ old('autor_principal', $record->autor_principal ?? '') }}" class="sib-input-admin">
    </div>
    <div>
        <label class="block text-sm font-medium text-ipn-gray-lighten mb-1">Autores Secundarios</label>
        <div class="flex items-center space-x-2 mt-1">
            <input x-model="nuevoAutor" @keydown.enter.prevent="addAutor" type="text" class="flex-grow sib-input-admin">
            <button type="button" @click="addAutor" class="btn-primary px-3 py-1">Agregar</button>
        </div>
        <ul class="mt-2 space-y-1">
            <template x-for="(autor, index) in autores" :key="index">
                <li class="flex items-center justify-between bg-ipn-gray-dark/50 px-2 py-1 rounded">
                    <span x-text="autor" class="text-sm"></span>
                    <button type="button" @click="removeAutor(index)" class="text-red-400 hover:text-red-200">&times;</button>
                </li>
            </template>
        </ul>
        <input type="hidden" id="autores_secundarios" name="autores_secundarios">
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-4">
        <div>
            <label class="block text-sm font-medium text-ipn-gray-lighten mb-1">A\xC3\xB1o</label>
            <input type="text" name="anio_publicacion" value="{{ old('anio_publicacion', $record->anio_publicacion ?? '') }}" class="sib-input-admin">
        </div>
        <div>
            <label class="block text-sm font-medium text-ipn-gray-lighten mb-1">ISBN</label>
            <input type="text" name="isbn" value="{{ old('isbn', $record->isbn ?? '') }}" class="sib-input-admin">
        </div>
        <div>
            <label class="block text-sm font-medium text-ipn-gray-lighten mb-1">ISSN</label>
            <input type="text" name="issn" value="{{ old('issn', $record->issn ?? '') }}" class="sib-input-admin">
        </div>
    </div>
    <div>
        <label class="block text-sm font-medium text-ipn-gray-lighten mb-1">Tipo de Material <span class='text-red-400'>*</span></label>
        <select name="tipo_material" class="sib-input-admin" required>
            @php
                $tipos = ['Libro','Tesis','Revista','Articulo','Audiovisual','RecursoElectronico','Otro'];
            @endphp
            @foreach($tipos as $tipo)
                <option value="{{ $tipo }}" @selected(old('tipo_material', $record->tipo_material ?? '') == $tipo)>{{ $tipo }}</option>
            @endforeach
        </select>
    </div>
</div>
<div class="mt-6">
    <button type="submit" class="btn-primary">{{ $isEdit ? 'Actualizar' : 'Crear' }}</button>
    <a href="{{ route('admin.catalog.index') }}" class="btn-secondary ml-3">Cancelar</a>
</div>