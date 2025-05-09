<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Usuario;
use App\Models\UnidadAcademica;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str; // Para UUID
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        $unidadesAcademicas = UnidadAcademica::orderBy('nombre')->get();
        return view('auth.register', compact('unidadesAcademicas'));
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        // Validación actualizada para 3 pasos y nuevos campos de nombre
        $request->validate([
            // Paso 1
            'nombre'              => ['required', 'string', 'max:100'],
            'p_apellido'          => ['required', 'string', 'max:100'],
            's_apellido'          => ['nullable', 'string', 'max:100'], // Opcional
            'boleta'              => ['required', 'string', 'max:10', 'unique:'.Usuario::class],
            'categoriaUsuario'    => ['required', 'string', 'in:AlumnoBachillerato,AlumnoLicenciatura,AlumnoPosgrado,Investigador,Docente,Administrativo,Externo'], // Incluye todas las opciones del select
            'idUnidadAcademica'   => ['required', 'string', 'exists:UnidadAcademica,idUnidadAcademica'], // Asegúrate que la tabla/columna exista

            // Paso 3 (implícito, ya que se envía todo junto)
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.Usuario::class.',email'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        // Creación del Usuario actualizada
        $usuario = Usuario::create([
            'id'                  => Str::uuid(), // Genera UUID
            'nombre'              => $request->nombre,
            'p_apellido'          => $request->p_apellido,
            's_apellido'          => $request->s_apellido, // Puede ser null
            'boleta'              => $request->boleta,
            'email'               => $request->email,
            'idUnidadAcademica'   => $request->idUnidadAcademica,
            'categoriaUsuario'    => $request->categoriaUsuario,
            'password'            => $request->password, // El cast 'hashed' en el modelo se encarga
            'estadoUsuario'       => 'PendienteConfirmacion', // Estado inicial
        ]);

        // Dispara el evento Registered (para enviar email de verificación, etc.)
        event(new Registered($usuario));

        // Loguea al nuevo usuario
        Auth::login($usuario);

        return redirect(route('sibipn', absolute: false));
    }
}