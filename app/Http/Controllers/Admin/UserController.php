<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Usuario;
use App\Models\RolAdmin;
use App\Models\UnidadAcademica;
use App\Http\Requests\UpdateUserRequest; // <-- USAREMOS EL FORM REQUEST
use Illuminate\Http\Request; // <-- Request se puede quitar si solo usamos Form Request
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash; // Importar Hash para hashing explícito
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException; // Necesario para validaciones manuales si se mantienen

class UserController extends Controller
{
    /**
     * Categoría designada para usuarios del staff administrativo.
     * @var string
     */
    protected $staffCategory = 'Administrativo';

    /**
     * Lista base de todos los estados posibles de usuario.
     * Se filtrará en el método edit según el contexto.
     * @var array
     */
    protected $baseEstadosPosibles = ['Activo', 'Inactivo', 'Suspendido', 'PendienteConfirmacion'];

    /**
     * Lista de todas las categorías posibles de usuario.
     * @var array
     */
    protected $categoriasPosibles = ['AlumnoBachillerato', 'AlumnoLicenciatura', 'AlumnoPosgrado', 'Investigador', 'Docente', 'Administrativo', 'Externo'];

    /**
     * Muestra una lista paginada de usuarios con filtros y búsqueda.
     *
     * @param Request $request
     * @return View
     */
    public function index(Request $request): View
    {
        // Autorizar vista de usuarios
        Gate::authorize('ver-usuarios-basico'); // Cambiado a permiso más específico si existe

        // Obtener datos para filtros
        $roles = RolAdmin::orderBy('nombreRol')->pluck('nombreRol', 'id');
        $unidadesAcademicas = UnidadAcademica::orderBy('nombre')->pluck('nombre', 'idUnidadAcademica');

        // Query base de usuarios con relaciones precargadas
        $query = Usuario::query()
                         ->with(['rol', 'unidadAcademica'])
                         ->orderBy('p_apellido')->orderBy('s_apellido')->orderBy('nombre'); // Orden más natural

        // --- Aplicar Búsqueda ---
        if ($request->filled('search')) {
            $searchTerm = trim($request->input('search'));
            $query->where(function ($q) use ($searchTerm) {
                $q->where('nombre', 'LIKE', "%{$searchTerm}%")
                  ->orWhere('p_apellido', 'LIKE', "%{$searchTerm}%")
                  ->orWhere('s_apellido', 'LIKE', "%{$searchTerm}%")
                  ->orWhere('email', 'LIKE', "%{$searchTerm}%")
                  ->orWhere('boleta', 'LIKE', "%{$searchTerm}%");
            });
        }

        // --- Aplicar Filtros ---
        if ($request->filled('role')) {
             if ($request->input('role') === 'null') { // Filtrar usuarios sin rol
                 $query->whereNull('idRolAdmin');
             } elseif(ctype_digit($request->input('role'))) { // Filtrar por ID de rol específico
                 $query->where('idRolAdmin', $request->input('role'));
             }
        }
        if ($request->filled('status') && in_array($request->input('status'), $this->baseEstadosPosibles)) {
            $query->where('estadoUsuario', $request->input('status'));
        }
        if ($request->filled('category') && in_array($request->input('category'), $this->categoriasPosibles)) {
            $query->where('categoriaUsuario', $request->input('category'));
        }
        if ($request->filled('unit') && $unidadesAcademicas->has($request->input('unit'))) {
            $query->where('idUnidadAcademica', $request->input('unit'));
        }

        // Paginar resultados manteniendo los query strings de filtros/búsqueda
        $usuarios = $query->paginate(15)->withQueryString();

        // Devolver vista con datos necesarios
        return view('admin.users.index', [
            'usuarios' => $usuarios,
            'roles' => $roles,
            'estadosPosibles' => $this->baseEstadosPosibles, // Para select de filtro
            'categoriasPosibles' => $this->categoriasPosibles, // Para select de filtro
            'unidadesAcademicas' => $unidadesAcademicas // Para select de filtro
        ]);
    }

    /**
     * Muestra el formulario para crear un nuevo usuario (Staff).
     *
     * @return View
     */
    public function create(): View
    {
        // Autorizar creación (o gestión general)
        Gate::authorize('crear-usuarios'); // Permiso específico

        // Datos necesarios para los selects del formulario
        $roles = RolAdmin::orderBy('nombreRol')->get();
        $unidadesAcademicas = UnidadAcademica::orderBy('nombre')->get();

        // Devolver vista de creación
        return view('admin.users.create', [
            'roles' => $roles,
            'unidadesAcademicas' => $unidadesAcademicas,
        ]);
    }

    /**
     * Guarda un nuevo usuario (Staff) en la base de datos.
     *
     * @param Request $request // Podría ser un CreateUserRequest si se crea
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse // Cambiar a CreateUserRequest si existe
    {
        // Autorizar creación/gestión
        Gate::authorize('crear-usuarios');

        // Validar datos de entrada (Idealmente mover a CreateUserRequest)
        $validated = $request->validate([
            'nombre' => ['required', 'string', 'max:100'],
            'p_apellido' => ['required', 'string', 'max:100'],
            's_apellido' => ['nullable', 'string', 'max:100'],
            'boleta' => ['required', 'string', 'max:10', 'unique:usuarios,boleta'],
            // Asegurar dominio @ipn.mx para creación desde admin
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:usuarios,email', 'regex:/^[^\s@]+@ipn\.mx$/i'],
            'idUnidadAcademica' => ['required', 'string', 'exists:UnidadAcademica,idUnidadAcademica'],
            'idRolAdmin' => ['nullable', 'integer', 'exists:rol_admin,id'],
            'password' => ['required', 'string', Password::min(16)], // Validar contraseña generada
        ]);

        // Crear usuario con valores por defecto para Staff
        try {
            $usuario = Usuario::create([
                'id' => Str::uuid(),
                'nombre' => $validated['nombre'],
                'p_apellido' => $validated['p_apellido'],
                's_apellido' => $validated['s_apellido'],
                'boleta' => $validated['boleta'],
                'email' => $validated['email'],
                'idUnidadAcademica' => $validated['idUnidadAcademica'],
                'categoriaUsuario' => $this->staffCategory, // Categoría Staff por defecto
                'idRolAdmin' => $validated['idRolAdmin'] ?? null,
                'estadoUsuario' => 'Activo', // Estado Activo por defecto
                'password' => $validated['password'], // El cast 'hashed' en el modelo se encarga (o usar Hash::make si no)
                'email_verified_at' => now(), // Verificado automáticamente
            ]);
        } catch (\Exception $e) {
             return redirect()->back()
                              ->with('error', 'Error al crear el usuario: ' . $e->getMessage())
                              ->withInput();
        }


        // Redirigir con mensaje de éxito
        return redirect()->route('admin.users.index')
                         ->with('success', "Usuario Staff {$usuario->nombreCompleto} creado correctamente como '{$this->staffCategory}' y 'Activo'. Asegúrate de haber copiado la contraseña.");
    }

     /**
      * Muestra los detalles de un usuario específico.
      * (Actualmente redirige a edit, implementar vista 'show' si se necesita)
      *
      * @param Usuario $user
      * @return View|RedirectResponse
      */
     public function show(Usuario $user): View|RedirectResponse
     {
         // Autorizar vista
         Gate::authorize('ver-usuarios-basico');
         // Cargar relaciones para mostrar info completa
         $user->load(['rol', 'unidadAcademica']);

         // TODO: Crear la vista 'admin.users.show' o mantener redirección
         // return view('admin.users.show', compact('user'));
          return redirect()->route('admin.users.edit', $user); // Redirección temporal
     }


    /**
     * Muestra el formulario para editar un usuario existente.
     * Pasa datos condicionales a la vista según si es Staff o Público.
     *
     * @param Usuario $user
     * @return View
     */
    public function edit(Usuario $user): View
    {
        // Autorizar edición/gestión
        Gate::authorize('gestionar-usuarios');

        // Datos necesarios para selects y mostrar información
        $roles = RolAdmin::orderBy('nombreRol')->get();
        $unidadesAcademicas = UnidadAcademica::orderBy('nombre')->get(); // Para mostrar

        // Determinar si el usuario es Staff
        $isStaff = $user->categoriaUsuario === $this->staffCategory;
        $estadosEditables = [];

        // Calcular los estados que se pueden seleccionar según las reglas de negocio
        if ($isStaff) {
            // Staff: El estado no se edita aquí, pasamos solo el actual
            $estadosEditables = [$user->estadoUsuario];
        } elseif ($user->estadoUsuario === 'PendienteConfirmacion') {
             // Público Pendiente: Puede quedarse Pendiente o pasar a Activo
            $estadosEditables = ['PendienteConfirmacion', 'Activo'];
        } elseif ($user->email_verified_at) {
            // Público Verificado: Puede ser Activo, Inactivo, Suspendido
            $estadosEditables = ['Activo', 'Inactivo', 'Suspendido'];
        } else {
            // Público No Verificado (y no Pendiente, caso raro): Solo estado actual
            $estadosEditables = [$user->estadoUsuario];
        }
         // Asegurar que el estado actual siempre esté en las opciones (para el selected)
         if (!in_array($user->estadoUsuario, $estadosEditables)) {
             array_unshift($estadosEditables, $user->estadoUsuario);
         }


        // Devolver vista de edición con todos los datos necesarios
        return view('admin.users.edit', [
            'user' => $user,
            'roles' => $roles, // Para select de rol (si es staff)
            'unidadesAcademicas' => $unidadesAcademicas, // Para mostrar info
            'estadosPosibles' => $estadosEditables, // Estados filtrados para el select (si es público)
            'categoriasPosibles' => $this->categoriasPosibles, // Para mostrar info
            'isStaff' => $isStaff // Flag para lógica condicional en la vista
        ]);
    }

    /**
     * Actualiza un usuario existente en la base de datos.
     * UTILIZA UpdateUserRequest PARA VALIDACIÓN.
     *
     * @param UpdateUserRequest $request <-- Cambiado a Form Request
     * @param Usuario $user
     * @return RedirectResponse
     */
    public function update(UpdateUserRequest $request, Usuario $user): RedirectResponse
    {
        // La autorización y validación principal ocurren en UpdateUserRequest

        $validatedData = $request->validated(); // Obtener datos validados
        $isStaff = $user->categoriaUsuario === $this->staffCategory;

        // --- Preparar Datos para Actualizar ---
        $dataToUpdate = [];

        // 1. Asignar Rol (solo si es Staff)
        if ($isStaff) {
            // 'idRolAdmin' estará presente en $validatedData si pasó la validación (incluso si es null)
            $dataToUpdate['idRolAdmin'] = $validatedData['idRolAdmin'] ?? null;
        }

        // 2. Asignar Estado (solo si NO es Staff)
        if (!$isStaff) {
            $newState = $validatedData['estadoUsuario'];
            $wasPending = $user->estadoUsuario === 'PendienteConfirmacion';

            // Validaciones de lógica de negocio adicionales (opcional, podrían estar en FormRequest)
            if ($user->email_verified_at && $newState === 'PendienteConfirmacion') {
                 return redirect()->back()->withErrors(['estadoUsuario' => 'No se puede cambiar el estado a Pendiente para un usuario ya verificado.'])->withInput();
            }
             // No permitir activar si no estaba pendiente y no está verificado
            if (!$user->email_verified_at && $newState === 'Activo' && !$wasPending) {
                 return redirect()->back()->withErrors(['estadoUsuario' => 'No se puede activar una cuenta no verificada (a menos que se cambie desde Pendiente).'])->withInput();
            }

            $dataToUpdate['estadoUsuario'] = $newState;

            // Lógica de Auto-verificación al activar desde Pendiente
            if ($newState === 'Activo' && $wasPending && !$user->email_verified_at) {
                $dataToUpdate['email_verified_at'] = now();
            }
        }

        // 3. Asignar Nueva Contraseña (solo si es Staff y se proporcionó una)
        // $validatedData['new_password'] contendrá la contraseña si se envió y pasó la validación (min:8, etc.)
        // o será null si no se envió o se envió vacía (gracias a 'nullable' y prepareForValidation)
        if ($isStaff && !empty($validatedData['new_password'])) {
            $dataToUpdate['password'] = Hash::make($validatedData['new_password']);
        }

        // --- Aplicar Cambios y Guardar ---
        $passwordChanged = isset($dataToUpdate['password']); // Flag para mensaje
        if (!empty($dataToUpdate)) {
             try {
                // Usar update() para asignación masiva (respeta $fillable)
                $user->update($dataToUpdate);
            } catch (\Exception $e) {
                return redirect()->back()
                                 ->with('error', 'Error al actualizar el usuario: ' . $e->getMessage())
                                 ->withInput();
            }
        } else {
             // Si no hay nada que actualizar (raro, pero posible si solo se envía el form sin cambios)
             return redirect()->route('admin.users.index')->with('info', 'No se realizaron cambios en el usuario.');
        }

        // Determinar mensaje de éxito
        $message = "Usuario {$user->nombreCompleto} actualizado correctamente.";
        if ($passwordChanged) {
            $message .= " Se ha establecido una nueva contraseña.";
        }

        // Redirigir con mensaje
        return redirect()->route('admin.users.index')->with('success', $message);
    }


    /**
     * Elimina un usuario específico de la base de datos.
     *
     * @param Usuario $user
     * @return RedirectResponse
     */
    public function destroy(Usuario $user): RedirectResponse
    {
        // Autorizar eliminación
        Gate::authorize('eliminar-usuarios');

        // Prevenir auto-eliminación
        if (Auth::id() === $user->id) {
            return redirect()->route('admin.users.index')
                             ->with('error', 'No puedes eliminar tu propia cuenta de administrador.');
        }
        // TODO: Añadir lógica si se necesita prevenir eliminar al último Super Admin
        // Ejemplo: if ($user->rol->nombreRol === 'Administrador del Sistema' && Usuario::where('idRolAdmin', $user->idRolAdmin)->count() === 1) { ... }

         try {
            // Eliminar usuario (manejará SoftDeletes si está habilitado en el modelo)
            $user->delete();
        } catch (\Exception $e) {
             // Capturar errores, por ejemplo, si hay restricciones de FK que impiden borrar
             return redirect()->route('admin.users.index')
                              ->with('error', 'No se pudo eliminar el usuario. Es posible que tenga registros asociados (préstamos, etc.). Error: ' . $e->getMessage());
        }


        // Redirigir con mensaje
        return redirect()->route('admin.users.index')->with('success', 'Usuario eliminado correctamente.');
    }
}
