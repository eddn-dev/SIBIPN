<?php
// bootstrap/app.php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
// Importa tu middleware (asegúrate que el namespace sea correcto)
use App\Http\Middleware\CheckAdminRole;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
        // Si Breeze cargó auth.php aquí o vía Service Provider, está bien
    )
    ->withMiddleware(function (Middleware $middleware) {
        // --- AÑADIR ESTA SECCIÓN PARA REGISTRAR TU ALIAS ---
        $middleware->alias([
            'admin' => CheckAdminRole::class, // <-- La línea clave
            // Puedes añadir otros alias aquí si los necesitas en el futuro
            // 'verified' => \Illuminate\Auth\Middleware\EnsureEmailIsVerified::class, // (Este ya suele estar registrado por defecto o por Breeze)
        ]);
        // ----------------------------------------------------

        // Aquí puedes añadir otros tipos de middleware si es necesario
        // $middleware->web(...)
        // $middleware->api(...)
        // $middleware->priority(...)

    })
    ->withExceptions(function (Exceptions $exceptions) {
        // Configuración del manejo de excepciones
    })->create();
