<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest; // Importa nuestro LoginRequest adaptado
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        // Usa la vista personalizada que ya configuramos
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse // Inyecta nuestro LoginRequest adaptado
    {
        // La validación y el intento de autenticación ocurren en LoginRequest->authenticate()
        $request->authenticate();

        // Regenera la sesión (buena práctica)
        $request->session()->regenerate();

        // Redirige al destino previsto (usualmente 'dashboard')
        return redirect()->intended(route('sibipn', absolute: false));
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        // Redirige a la página principal después del logout
        return redirect('/');
    }
}
