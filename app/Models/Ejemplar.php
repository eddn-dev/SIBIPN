<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Ejemplar extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'ejemplares';
    protected $primaryKey = 'idEjemplar';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'idRegistroBibliografico',
        'idBiblioteca',
        'codigo_barras',
        'signatura_topografica',
        'ubicacion_especifica',
        'estado_ejemplar',
        'notas_internas',
        'es_donacion',
        'fecha_adquisicion',
    ];

    public function registroBibliografico(): BelongsTo
    {
        return $this->belongsTo(RegistroBibliografico::class, 'idRegistroBibliografico', 'idRegistro');
    }

    public function biblioteca(): BelongsTo
    {
        return $this->belongsTo(Biblioteca::class, 'idBiblioteca', 'idBiblioteca');
    }
}