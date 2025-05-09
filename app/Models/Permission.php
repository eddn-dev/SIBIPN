<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany; // Importar BelongsToMany

class Permission extends Model
{
    /**
     * La tabla asociada con el modelo.
     * Laravel infiere 'permissions' si el nombre de la clase es 'Permission'.
     * protected $table = 'permissions'; // Opcional si sigue la convención
     */

    /**
     * Indica si el modelo debe tener timestamps.
     * Tu migración no los añade, así que false es correcto.
     */
    public $timestamps = false;

    /**
     * Los atributos que son asignables masivamente.
     */
    protected $fillable = [
        'name',
        'group',
        'description',
    ];

    // No hay casts necesarios por defecto para estos campos string/text

    // --- Relaciones Eloquent ---

    /**
     * Define la relación "muchos a muchos" con el modelo RolAdmin.
     * Un Permiso puede pertenecer a muchos Roles.
     */
    public function roles(): BelongsToMany
    {
        // Tabla pivote: 'permission_role'
        // Clave foránea de este modelo en la tabla pivote: 'permission_id'
        // Clave foránea del modelo relacionado en la tabla pivote: 'role_id'
        return $this->belongsToMany(RolAdmin::class, 'permission_role', 'permission_id', 'role_id');
    }
}
