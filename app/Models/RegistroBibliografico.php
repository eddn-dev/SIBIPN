<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\DigitalItem;

class RegistroBibliografico extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'registros_bibliograficos';
    protected $primaryKey = 'idRegistro';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'titulo',
        'autor_principal',
        'autores_secundarios',
        'editorial',
        'anio_publicacion',
        'lugar_publicacion',
        'edicion',
        'isbn',
        'issn',
        'tipo_material',
        'resumen',
        'idioma',
        'temas_palabras_clave',
        'portada_url',
        'datos_marc',
        'es_digital',
    ];
    
    public function digitalItems(): HasMany
    {
        return $this->hasMany(DigitalItem::class, 'idRegistroBibliografico', 'idRegistro');
    }
}