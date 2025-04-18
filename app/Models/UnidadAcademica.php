<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UnidadAcademica extends Model
{
    protected $table = 'UnidadAcademica';
    protected $primaryKey = 'idUnidadAcademica';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;  // no tiene created_at / updated_at

    protected $fillable = [
        'idUnidadAcademica', 'nombre', 'siglas', 'fotografia'
    ];

    public function usuarios()
    {
        return $this->hasMany(Usuario::class, 'idUnidadAcademica');
    }
}
