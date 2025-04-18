<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RolAdmin extends Model
{
    protected $table = 'RolAdmin';
    protected $primaryKey = 'idRolAdmin';
    public $timestamps = false;

    protected $fillable = [
        'nombreRol', 'descripcion', 'permisos'
    ];

    protected $casts = [
        'permisos' => 'array',
    ];

    public function administradores()
    {
        return $this->hasMany(Usuario::class, 'idRolAdmin');
    }
}
