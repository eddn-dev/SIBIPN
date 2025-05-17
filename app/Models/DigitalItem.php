<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DigitalItem extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'digital_items';
    protected $primaryKey = 'idDigital';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'idRegistroBibliografico',
        'archivo_path',
        'mime_type',
        'es_publico',
    ];

    public function registroBibliografico(): BelongsTo
    {
        return $this->belongsTo(RegistroBibliografico::class, 'idRegistroBibliografico', 'idRegistro');
    }
}