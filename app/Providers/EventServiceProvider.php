<?php
namespace App\Providers;

use App\Models\Usuario;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Events\Verified;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{

    /**
     * El mapeo de eventos a los listeners.
     *
     * @var array
     */
    protected $listen = [
        Verified::class => [
            // Listener que actualiza el estado del usuario al ser verificado
            \App\Listeners\UpdateUserStatusOnVerification::class,
        ],
    ];

    // Evita que el framework registre por defecto el listener
    protected function configureEmailVerification(): void
    {
        // Intencionalmente vacío
    }

    public function boot(): void
    {
        parent::boot();

        // Si quieres registrar manualmente:
        // $this->listen[Registered::class][] = SendEmailVerificationNotification::class;
    }
}
