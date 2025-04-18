<?php
namespace App\Providers;

use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
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
