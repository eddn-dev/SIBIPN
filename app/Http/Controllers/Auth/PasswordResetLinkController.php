<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password; // Facade para el PasswordBroker
use Illuminate\View\View;

class PasswordResetLinkController extends Controller
{
    /**
     * Display the password reset link request view.
     */
    public function create(): View
    {
        // Usa la vista personalizada que creamos
        return view('auth.forgot-password');
    }

    /**
     * Handle an incoming password reset link request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        // 1. Validar usando 'email'
        $request->validate([
            'email' => ['required', 'email'], // Validamos nuestro campo
        ]);

        // 2. Intentar enviar el enlace usando el nombre de columna correcto como clave
        // Al pasar ['email' => $value], EloquentUserProvider
        // debería generar la consulta WHERE `email` = $value.
        $status = Password::sendResetLink(
            $request->only('email') // <-- Cambio Clave: Pasar solo el campo real
        );

        // 3. Redirigir con el estado
        return $status == Password::RESET_LINK_SENT
                    // Si se envió, regresa con mensaje de éxito
                    ? back()->with('status', __($status))
                    // Si falló (ej. email no encontrado), regresa con error y el input
                    : back()->withInput($request->only('email')) // <-- Devolvemos el input correcto
                          ->withErrors(['email' => __($status)]); // <-- Asociamos error al campo correcto
    }
}
