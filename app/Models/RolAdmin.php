<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany; // Importar BelongsToMany

class RolAdmin extends Model
{
    /**
     * La tabla asociada con el modelo.
     */
    protected $table = 'rol_admin';

    /**
     * Indica si el modelo debe tener timestamps.
     */
    public $timestamps = false;

    /**
     * Los atributos que son asignables masivamente.
     */
    protected $fillable = [
        'id', // Añadido si usas IDs explícitos en el seeder
        'nombreRol',
        'descripcion',
        // 'permisos' // <-- ELIMINADO de fillable
    ];

    /**
     * Los atributos que deben ser casteados a tipos nativos.
     */
    protected $casts = [
    ];

    // --- Relaciones Eloquent ---

    /**
     * Define la relación "uno a muchos" con el modelo Usuario.
     * Un Rol puede tener muchos Usuarios.
     */
    public function usuarios(): HasMany
    {
        return $this->hasMany(Usuario::class, 'idRolAdmin', 'id');
    }

    /**
     * Define la relación "muchos a muchos" con el modelo Permission.
     * Un Rol puede tener muchos Permisos.
     */
    public function permissions(): BelongsToMany
    {
        // Tabla pivote: 'permission_role'
        // Clave foránea de este modelo en la tabla pivote: 'role_id'
        // Clave foránea del modelo relacionado en la tabla pivote: 'permission_id'
        return $this->belongsToMany(Permission::class, 'permission_role', 'role_id', 'permission_id');
    }
}
