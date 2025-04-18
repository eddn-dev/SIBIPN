<?php

namespace App\Models;

// Traits y Clases Necesarias
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Auth\Passwords\CanResetPassword as CanResetPasswordTrait; // Renombrado para claridad
use Illuminate\Contracts\Auth\CanResetPassword;
use Illuminate\Auth\MustVerifyEmail as MustVerifyEmailTrait; // Renombrado para claridad
use Illuminate\Database\Eloquent\Concerns\HasUuids; // Trait para manejar UUIDs automáticamente
use Illuminate\Support\Facades\Hash;

// Notificación Personalizada (asegúrate que el namespace sea correcto)
use App\Notifications\VerifyEmailNotification;

class Usuario extends Authenticatable implements MustVerifyEmail, CanResetPassword
{
    // Traits usados
    use Notifiable,
        MustVerifyEmailTrait,
        CanResetPasswordTrait,
        HasUuids; // <--- Añadido para generación automática de UUID en 'id'

    /**
     * La tabla asociada con el modelo.
     * @var string
     */
    protected $table = 'usuarios'; // <-- Nombre de tabla corregido

    /**
     * La clave primaria para el modelo.
     * @var string
     */
    protected $primaryKey = 'id'; // <-- Clave primaria estándar 'id'

    /**
     * Indica si la clave primaria es auto-incremental.
     * @var bool
     */
    public $incrementing = false; // <-- Correcto para UUIDs

    /**
     * El tipo de dato de la clave primaria.
     * @var string
     */
    protected $keyType = 'string'; // <-- Correcto para UUIDs

    /**
     * Nombre personalizado para la columna "created_at".
     * @var string|null
     */
    const CREATED_AT = 'fechaRegistro'; // <-- Mantenido según tu migración

    /**
     * Nombre personalizado para la columna "updated_at".
     * @var string|null
     */
    const UPDATED_AT = 'fechaUltimoAcceso'; // <-- Mantenido según tu migración

    /**
     * Los atributos que son asignables masivamente.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        // 'id' no se incluye aquí, se genera automáticamente
        'nombreCompleto',
        'boleta',
        'email', // <-- Usamos 'email'
        'password', // <-- Usamos 'password' (el hash se guarda aquí vía mutator)
        'idUnidadAcademica',
        'categoriaUsuario',
        'estadoUsuario',
        'idRolAdmin',
        'email_verified_at', // Añadido para que MustVerifyEmail funcione correctamente
        'fechaRegistro', // Si usas timestamps personalizados
        'fechaUltimoAcceso', // Si usas timestamps personalizados
    ];

    /**
     * Los atributos que deben ocultarse para las serializaciones.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password', // <-- Ocultamos 'password' (contiene el hash)
        'remember_token',
    ];

    /**
     * Los atributos que deben ser casteados.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'id' => 'string', // <-- Castear el ID a string es buena práctica con UUIDs
        'email_verified_at' => 'datetime',
        'fechaRegistro' => 'datetime', // Castear timestamps personalizados
        'fechaUltimoAcceso' => 'datetime', // Castear timestamps personalizados
        // Si usaras timestamps por defecto:
        // 'created_at' => 'datetime',
        // 'updated_at' => 'datetime',
        'password' => 'hashed', // <-- Casteo estándar para el campo de contraseña hasheada
    ];

    /**
     * Mutator para hashear la contraseña automáticamente al asignarla.
     * Ahora opera sobre el atributo 'password'.
     */
    public function setPasswordAttribute($password)
    {
        // Hashea solo si se proporciona una contraseña (evita hashear null en actualizaciones)
        if (!empty($password)) {
             $this->attributes['password'] = Hash::make($password);
        }
    }

    /**
     * Send the email verification notification.
     * Sobrescribimos para usar nuestra notificación personalizada.
     *
     * @return void
     */
    public function sendEmailVerificationNotification()
    {
        $this->notify(new VerifyEmailNotification); // <-- Usa tu notificación personalizada
    }


    // --- MÉTODOS OBSOLETOS ELIMINADOS ---
    // Ya no son necesarios porque usamos los nombres de columna estándar 'id', 'email', 'password'
    // y el trait Notifiable encuentra 'email' automáticamente.
    // public function getAuthPassword() { ... }
    // public function getEmailForVerification() { ... }
    // public function getEmailForPasswordReset() { ... }
    // public function routeNotificationForMail($notification = null): string { ... }
    // --- FIN MÉTODOS OBSOLETOS ---


    // --- Relaciones Eloquent ---

    /**
     * Obtiene la unidad académica a la que pertenece el usuario.
     */
    public function unidadAcademica()
    {
        // Asegúrate que el modelo UnidadAcademica exista y la FK sea correcta
        return $this->belongsTo(UnidadAcademica::class, 'idUnidadAcademica', 'idUnidadAcademica');
    }

    /**
     * Obtiene el rol administrativo del usuario (si tiene).
     */
    public function rol()
    {
        // Asegúrate que el modelo RolAdmin exista, apunte a la tabla 'rol_admin'
        // y use 'id' como PK. La FK aquí es 'idRolAdmin'.
        return $this->belongsTo(RolAdmin::class, 'idRolAdmin', 'id');
    }
}
