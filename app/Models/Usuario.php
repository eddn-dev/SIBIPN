<?php namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Auth\Passwords\CanResetPassword as ResetPasswordTrait;
use Illuminate\Contracts\Auth\CanResetPassword;
use Illuminate\Auth\MustVerifyEmail as MustVerifyEmailTrait;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use App\Notifications\VerifyEmailNotification;

class Usuario extends Authenticatable implements MustVerifyEmail, CanResetPassword
{
    use Notifiable, MustVerifyEmailTrait, ResetPasswordTrait;

    protected $table = 'Usuario';
    protected $primaryKey = 'idUsuario';
    public $incrementing = false;
    protected $keyType = 'string';

    const CREATED_AT = 'fechaRegistro';
    const UPDATED_AT = 'fechaUltimoAcceso';

    protected $fillable = [
        'idUsuario',
        'boleta',
        'correoInstitucional',
        'nombreCompleto',
        'idUnidadAcademica',
        'password',            // añade esto
        'categoriaUsuario',
        'estadoUsuario',
        'idRolAdmin',
    ];    

    protected $hidden = ['passwordHash'];

    // Laravel busca "password" por defecto, así que lo redirigimos a passwordHash
    public function getAuthPassword()
    {
        return $this->passwordHash;
    }

    // Mutator para que al asignar usuario->password se hashee automáticamente
    public function setPasswordAttribute($password)
    {
        $this->attributes['passwordHash'] = Hash::make($password);
    }

    // Para verificación de email y reset de contraseña
    public function getEmailForVerification()
    {
        return $this->correoInstitucional;
    }

    public function getEmailForPasswordReset()
    {
        return $this->correoInstitucional;
    }

    // Relaciones
    public function unidadAcademica()
    {
        return $this->belongsTo(UnidadAcademica::class, 'idUnidadAcademica');
    }

    public function rol()
    {
        return $this->belongsTo(RolAdmin::class, 'idRolAdmin');
    }

    public function routeNotificationForMail($notification = null): string
    {
        // Devuelve el valor del campo que contiene la dirección de correo electrónico.
        return $this->correoInstitucional;
    }

    public function sendEmailVerificationNotification()
    {
        $this->notify(new VerifyEmailNotification);
    }
}
