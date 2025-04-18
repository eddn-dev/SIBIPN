<?php
namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        // Si tuvieras políticas, mapea aquí tus modelos a policies
    ];

    public function boot(): void
    {
        $this->registerPolicies();
    }
}
