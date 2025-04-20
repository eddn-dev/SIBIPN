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
use Illuminate\Support\Facades\Hash;
use App\Notifications\VerifyEmailNotification; // Asegúrate que el namespace sea correcto

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
    // const CREATED_AT = 'fechaRegistro'; // Comentado
    // const UPDATED_AT = 'fechaUltimoAcceso'; // Comentado

    /**
     * Los atributos que son asignables masivamente.
     * @var array<int, string>
     */
    protected $fillable = [
        // 'id' se genera automáticamente
        'nombre',           // <--- Nuevo
        'p_apellido',       // <--- Nuevo
        's_apellido',       // <--- Nuevo
        // 'nombreCompleto', // <-- Eliminado
        'boleta',
        'email',
        'password',
        'idUnidadAcademica',
        'categoriaUsuario',
        'estadoUsuario',
        'idRolAdmin',
        'email_verified_at',
        // 'fechaRegistro', // Comentado
        // 'fechaUltimoAcceso', // Comentado
    ];

    /**
     * Los atributos que deben ocultarse para las serializaciones.
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Los atributos que deben ser casteados.
     * @var array<string, string>
     */
    protected $casts = [
        'id' => 'string',
        'email_verified_at' => 'datetime',
        'created_at' => 'datetime', // Casteo para timestamp estándar
        'updated_at' => 'datetime', // Casteo para timestamp estándar
        // 'fechaRegistro' => 'datetime', // Comentado
        // 'fechaUltimoAcceso' => 'datetime', // Comentado
        'password' => 'hashed', // Casteo estándar para hash
    ];
    
    public function sendEmailVerificationNotification()
    {
        $this->notify(new VerifyEmailNotification);
    }

    // --- Relaciones Eloquent ---

    /**
     * Obtiene la unidad académica a la que pertenece el usuario.
     */
    public function unidadAcademica()
    {
        return $this->belongsTo(UnidadAcademica::class, 'idUnidadAcademica', 'idUnidadAcademica');
    }

    /**
     * Obtiene el rol administrativo del usuario (si tiene).
     */
    public function rol()
    {
        return $this->belongsTo(RolAdmin::class, 'idRolAdmin', 'id');
    }

    /**
     * Accesor para obtener el nombre completo concatenado (opcional pero útil).
     */
    public function getNombreCompletoAttribute(): string
    {
        return trim($this->nombre . ' ' . $this->p_apellido . ' ' . $this->s_apellido);
    }
}