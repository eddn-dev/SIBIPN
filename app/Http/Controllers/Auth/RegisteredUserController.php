<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Usuario; // Cambiado de User a Usuario
use App\Models\UnidadAcademica; // Necesario para el formulario
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str; // Para generar UUID
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     * Modificado para pasar las Unidades Académicas a la vista.
     */
    public function create(): View
    {
        // Obtenemos las unidades académicas para el <select> del formulario
        $unidadesAcademicas = UnidadAcademica::orderBy('nombre')->get();
        // Retornamos la vista de registro de Breeze (que reemplazaste con la tuya)
        // y le pasamos la variable $unidadesAcademicas.
        return view('auth.register', compact('unidadesAcademicas'));
    }

    /**
     * Handle an incoming registration request.
     * Modificado para validar y crear el modelo Usuario con campos personalizados.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        // 1. Validación adaptada a los campos de SIBIPN
        $request->validate([
            // 'name' => ['required', 'string', 'max:255'], // Campo original de Breeze (reemplazado)
            'nombreCompleto'      => ['required', 'string', 'max:255'], // Tu campo
            'boleta'              => ['required', 'string', 'max:10', 'unique:'.Usuario::class], // Tu campo, validación unique
            // 'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class], // Campo original de Breeze (reemplazado)
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.Usuario::class.',email'], // Tu campo, validación unique
            'idUnidadAcademica'   => ['required', 'string', 'exists:UnidadAcademica,idUnidadAcademica'], // Tu campo, validación exists
            'categoriaUsuario'    => ['required', 'string', 'in:AlumnoLicenciatura,AlumnoPosgrado,Investigador,Docente,Administrativo,Externo'], // Tu campo
            'password'            => ['required', 'confirmed', Rules\Password::defaults()], // Validación de contraseña de Breeze (usa reglas por defecto seguras)
        ]);

        // 2. Creación del Usuario adaptada
        $usuario = Usuario::create([
            'id'           => Str::uuid(), // Genera UUID para tu PK
            'nombreCompleto'      => $request->nombreCompleto,
            'boleta'              => $request->boleta,
            'email' => $request->email,
            'idUnidadAcademica'   => $request->idUnidadAcademica,
            'categoriaUsuario'    => $request->categoriaUsuario,
            // 'password'            => Hash::make($request->password), // Opción 1: Hashear aquí si NO usas el mutator en el modelo
            'password'            => $request->password, // Opción 2 (Recomendada): Pasar la contraseña en texto plano y dejar que el mutator setPasswordAttribute en tu modelo Usuario haga el hash
            'estadoUsuario'       => 'PendienteConfirmacion', // Estado inicial
        ]);

        event(new Registered($usuario));

        // 4. Loguea al nuevo usuario
        Auth::login($usuario);

        // 5. Redirige (Breeze por defecto redirige a RouteServiceProvider::HOME,
        //    que usualmente es /dashboard. Laravel manejará la redirección a
        //    'verification.notice' si el usuario no está verificado y la ruta
        //    destino requiere el middleware 'verified')
        return redirect(route('dashboard', absolute: false));
    }
}