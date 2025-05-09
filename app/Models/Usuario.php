<?php

namespace App\Models;

// Traits y Clases Necesarias
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Auth\Passwords\CanResetPassword as CanResetPasswordTrait;
use Illuminate\Contracts\Auth\CanResetPassword;
use Illuminate\Auth\MustVerifyEmail as MustVerifyEmailTrait;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Relations\BelongsTo; // Importar BelongsTo
use Illuminate\Support\Facades\Hash;
use App\Notifications\VerifyEmailNotification;
// Asegúrate que los namespaces de RolAdmin y UnidadAcademica sean correctos
// use App\Models\RolAdmin;
// use App\Models\UnidadAcademica;

class Usuario extends Authenticatable implements MustVerifyEmail, CanResetPassword
{
    use Notifiable,
        MustVerifyEmailTrait,
        CanResetPasswordTrait,
        HasUuids; // Para UUIDs

    protected $table = 'usuarios';
    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'string';

    // Usando timestamps estándar de Laravel
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    protected $fillable = [
        // 'id', // UUID se genera automáticamente o en el código, no suele ser fillable
        'nombre',
        'p_apellido',
        's_apellido',
        'boleta',
        'email',
        'password',
        'idUnidadAcademica',
        'categoriaUsuario',
        'estadoUsuario',
        'idRolAdmin',
        'email_verified_at',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'id' => 'string',
        'email_verified_at' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'password' => 'hashed', // Laravel hashea automáticamente al asignar
    ];

    /**
     * Send the email verification notification.
     *
     * @return void
     */
    public function sendEmailVerificationNotification()
    {
        $this->notify(new VerifyEmailNotification); // Asegúrate que esta clase exista
    }

    // --- Relaciones Eloquent ---

    /**
     * Obtiene la unidad académica a la que pertenece el usuario.
     */
    public function unidadAcademica(): BelongsTo // Tipado de retorno añadido
    {
        // Asegúrate que el modelo UnidadAcademica exista y las claves sean correctas
        return $this->belongsTo(UnidadAcademica::class, 'idUnidadAcademica', 'idUnidadAcademica');
    }

    /**
     * Obtiene el rol administrativo asignado al usuario.
     */
    public function rol(): BelongsTo // Cambiado a 'rol' para consistencia con hasPermissionTo
    {
        return $this->belongsTo(RolAdmin::class, 'idRolAdmin', 'id');
    }

    // --- Accessors ---

    /**
     * Obtiene el nombre completo del usuario.
     */
    public function getNombreCompletoAttribute(): string
    {
        return trim($this->nombre . ' ' . $this->p_apellido . ' ' . $this->s_apellido);
    }

    // --- Métodos de Autorización ---

    /**
     * Verifica si el usuario es el Super Administrador (ID=1).
     * Usado específicamente por Gate::before si se necesita esa lógica explícita.
     *
     * @return bool
     */
    public function isSuperAdmin(): bool // Renombrado para claridad
    {
        // Verifica si el ID del rol asignado es 1 (o como identifiques al Super Admin)
        return $this->idRolAdmin === 1;
    }


    /**
     * Verifica si el usuario tiene asignado *algún* rol administrativo.
     * (Usado por el Gate 'acceder-panel-admin')
     *
     * @return bool
     */
    public function hasAdminRole(): bool
    {
        // Verifica simplemente si la columna idRolAdmin tiene un valor (no es null)
        return $this->idRolAdmin !== null;
    }

    /**
     * Verifica si el usuario tiene un permiso específico a través de su rol.
     * Utiliza la relación muchos-a-muchos definida en RolAdmin.
     *
     * @param string $permissionName El nombre del permiso a verificar (ej: 'usuarios:crud')
     * @return bool
     */
    public function hasPermissionTo(string $permissionName): bool
    {
        // 1. Verifica si el usuario tiene un rol asignado
        if (!$this->rol) {
            return false; // Si no tiene rol, no tiene permisos
        }

        // 2. Carga los permisos del rol si aún no están cargados (Eager Loading Optimization)
        // Usamos loadMissing para no recargar si ya existe
        $this->rol->loadMissing('permissions');

        // 3. Verifica si la colección de permisos del rol contiene el permiso '*' O el permiso específico
        // El método contains() de la colección es eficiente para esto.
        return $this->rol->permissions->contains('name', '*') ||
               $this->rol->permissions->contains('name', $permissionName);
    }
}
