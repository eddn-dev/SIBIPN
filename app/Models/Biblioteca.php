<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Biblioteca extends Model
{
    protected $table = 'bibliotecas';
    protected $primaryKey = 'idBiblioteca';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'idBiblioteca',
        'nombre',
        'direccion',
        'telefono',
        'horarios',
        'idUnidadAcademica',
        'url_mapa',
        'foto_url',
    ];

    public function unidadAcademica(): BelongsTo
    {
        return $this->belongsTo(UnidadAcademica::class, 'idUnidadAcademica', 'idUnidadAcademica');
    }

    public function ejemplares(): HasMany
    {
        return $this->hasMany(Ejemplar::class, 'idBiblioteca', 'idBiblioteca');
    }
}