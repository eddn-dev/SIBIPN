<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Usuario; // Cambiado de User a Usuario
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
// Quitamos Hash si no lo usamos directamente aquí (el mutator lo usa)
// use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Log; // Añadido para depuración opcional
use Illuminate\Support\Str;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class NewPasswordController extends Controller
{
    /**
     * Display the password reset view.
     */
    public function create(Request $request): View
    {
        // Usa la vista personalizada que creamos
        return view('auth.reset-password', ['request' => $request]);
    }

    /**
     * Handle an incoming new password request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        // 1. Validar usando 'email'
        $request->validate([
            'token' => ['required'],
            'email' => ['required', 'email'], // Tu campo
            'password' => ['required', 'confirmed', Rules\Password::defaults()], // Validación de Breeze
        ]);

        // 2. Intentar resetear la contraseña
        // Pasamos 'email' con la clave 'email' que espera el Broker
        // OJO: Si el PasswordBroker sigue fallando al BUSCAR el usuario con email aquí,
        // podríamos necesitar pasar ['email' => $request->email] como en PasswordResetLinkController
        // Pero probemos primero asumiendo que el token + email son suficientes.
        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            // El callback ahora recibe nuestro modelo Usuario
            function (Usuario $usuario) use ($request) {
                Log::info('RESET PW CALLBACK: Actualizando contraseña para usuario ID: ' . $usuario->idUsuario);
                Log::info('RESET PW CALLBACK: Hash ANTES de asignar: ' . $usuario->passwordHash);

                // --- CAMBIO CLAVE: Asignación directa para asegurar ejecución del mutator ---
                $usuario->password = $request->password;
                $usuario->setRememberToken(Str::random(60)); // Método estándar para remember_token
                // --- FIN CAMBIO CLAVE ---

                Log::info('RESET PW CALLBACK: Hash DESPUÉS de asignar (antes de save): ' . $usuario->passwordHash); // Verifica si el hash cambió aquí
                $usuario->save();
                Log::info('RESET PW CALLBACK: Usuario guardado.');

                // Dispara el evento de que la contraseña fue reseteada
                event(new PasswordReset($usuario));
            }
        );

        // 3. Redirigir según el resultado
        return $status == Password::PASSWORD_RESET
                    // Si éxito, redirige a login con mensaje de éxito
                    ? redirect()->route('login')->with('status', __($status))
                    // Si falla (ej. token inválido, email no coincide), regresa con error
                    : back()->withInput($request->only('email'))
                          ->withErrors(['email' => __($status)]); // Asociamos error al campo correcto
    }
}
